import os
import sys
import re

# Make sure we print utf-8
sys.stdout.reconfigure(encoding='utf-8')

try:
    import cv2
    import numpy as np
except ImportError:
    print("Error: OpenCV or NumPy is not installed. Please run: pip install opencv-python")
    sys.exit(1)

# Paths
base_dir = os.path.dirname(os.path.abspath(__file__))
teachers_dir = os.path.join(base_dir, 'img', 'teachers')
teachers_full_dir = os.path.join(teachers_dir, 'full')
raw_teachers_dir = os.path.join(teachers_dir, 'raw')

def process_full_portrait(filename):
    base_name = os.path.splitext(filename)[0]
    p_id = base_name.replace('-2', '')
    dest_filename = f"{p_id}.png"
    
    filepath = os.path.join(raw_teachers_dir, filename)
    os.makedirs(teachers_full_dir, exist_ok=True)
    dest_path = os.path.join(teachers_full_dir, dest_filename)
    
    img = cv2.imread(filepath)
    if img is None:
        print(f"  [!] Failed to read {filename}")
        return False
        
    H, W = img.shape[:2]
    
    # 1. Background Mask in HSV (Using the stable high-saturation threshold matching process_portraits.py)
    hsv = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)
    lower_blue = np.array([95, 75, 75])
    upper_blue = np.array([135, 255, 255])
    blue_mask = cv2.inRange(hsv, lower_blue, upper_blue)
    subject_mask = cv2.bitwise_not(blue_mask)
    
    # Apply morphological close to bridge tiny gaps in outline
    kernel_close = cv2.getStructuringElement(cv2.MORPH_ELLIPSE, (5, 5))
    subject_mask = cv2.morphologyEx(subject_mask, cv2.MORPH_CLOSE, kernel_close)
    
    # Fill any internal holes (reflections, badges) in the subject by drawing the largest contour filled
    contours, _ = cv2.findContours(subject_mask, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
    clean_subject_mask = np.zeros_like(subject_mask)
    cx = W // 2
    if contours:
        try:
            largest_contour = max(contours, key=cv2.contourArea)
            cv2.drawContours(clean_subject_mask, [largest_contour], -1, 255, -1)
            
            bx, by, bw, bh = cv2.boundingRect(largest_contour)
            cx = bx + bw // 2
        except Exception:
            clean_subject_mask = subject_mask
    else:
        clean_subject_mask = subject_mask

    # 2. Crop to 3:4 vertical aspect ratio (using full height H)
    target_w = int(H * 3 / 4)
    if target_w <= W:
        x1 = cx - target_w // 2
        x2 = x1 + target_w
        if x1 < 0:
            x2 -= x1
            x1 = 0
        if x2 > W:
            x1 -= (x2 - W)
            x2 = W
        crop_img = img[:, x1:x2]
        crop_mask_base = clean_subject_mask[:, x1:x2]
    else:
        target_h = int(W * 4 / 3)
        y1 = 0
        y2 = min(H, target_h)
        crop_img = img[y1:y2, :]
        crop_mask_base = clean_subject_mask[y1:y2, :]
        
    TARGET_W = 450
    TARGET_H = 600
    crop_resized = cv2.resize(crop_img, (TARGET_W, TARGET_H), interpolation=cv2.INTER_AREA)
    mask_resized = cv2.resize(crop_mask_base, (TARGET_W, TARGET_H), interpolation=cv2.INTER_NEAREST)
    
    # 3. Soft Matte Masking calculation on original channels (to ensure clean keying)
    b_ch, g_ch, r_ch = cv2.split(crop_resized.astype(float))
    blue_diff = b_ch - np.maximum(r_ch, g_ch)
    
    t1 = 15.0 # definitely subject (alpha = 1.0)
    t2 = 45.0 # definitely background (alpha = 0.0)
    
    soft_alpha = 1.0 - (blue_diff - t1) / (t2 - t1)
    soft_alpha = np.clip(soft_alpha, 0.0, 1.0)
    
    hsv_crop = cv2.cvtColor(crop_resized, cv2.COLOR_BGR2HSV)
    h_c = hsv_crop[:, :, 0]
    s_c = hsv_crop[:, :, 1]
    v_c = hsv_crop[:, :, 2]
    is_blue_color = (h_c >= 95) & (h_c <= 135) & (s_c >= 80) & (v_c >= 80)
    
    # Only allow alpha transparency on the outer transition band (trimap boundary)
    # We dilate the background region (255 - mask_resized) to get the border zone
    kernel_dil = cv2.getStructuringElement(cv2.MORPH_ELLIPSE, (7, 7))
    bg_dilated = cv2.dilate(255 - mask_resized, kernel_dil)
    
    alpha = np.ones_like(soft_alpha)
    # A pixel inside the teacher's suit/body cannot be transparent unless it's in the boundary zone
    is_bg_blue = is_blue_color & (bg_dilated == 255)
    alpha[is_bg_blue] = soft_alpha[is_bg_blue]
    alpha = cv2.GaussianBlur(alpha, (3, 3), 0)
    
    # 4. Safe Blue-Ratio Color Correction
    bg_sample_left = img[0:30, 0:30]
    bg_sample_right = img[0:30, W-30:W]
    bg_sample = np.vstack([bg_sample_left, bg_sample_right])
    bg_b, bg_g, bg_r = np.mean(bg_sample, axis=(0, 1))
        
    target_bg_ratio = 2.15
    current_bg_ratio = bg_b / bg_g if bg_g > 0 else 2.2
    s_b = np.clip(target_bg_ratio / current_bg_ratio, 0.80, 1.10)
    
    b_corr = np.clip(b_ch * s_b, 0, 255)
    crop_corrected = cv2.merge([b_corr, g_ch, r_ch]).astype(np.uint8)
    
    # 5. Skin Smoothing (Bilateral Filter + original blend)
    smoothed = cv2.bilateralFilter(crop_corrected, d=7, sigmaColor=35, sigmaSpace=35)
    crop_final = cv2.addWeighted(crop_corrected, 0.65, smoothed, 0.35, 0)
    
    # Combine soft alpha and binary mask
    final_alpha = (alpha * (mask_resized / 255.0) * 255.0).astype(np.uint8)
    
    # Convert BGR to BGRA and set the transparency channel
    bgra = cv2.cvtColor(crop_final, cv2.COLOR_BGR2BGRA)
    bgra[:, :, 3] = final_alpha
    bgra[final_alpha == 0, :3] = 0
    
    # Save the output file to the root assets folder
    cv2.imwrite(dest_path, bgra)
    
    # Also save to preview directory if it exists to ensure local server works
    preview_teachers_full_dir = os.path.join(base_dir, 'preview', 'img', 'teachers', 'full')
    if os.path.exists(os.path.dirname(preview_teachers_full_dir)):
        os.makedirs(preview_teachers_full_dir, exist_ok=True)
        preview_dest_path = os.path.join(preview_teachers_full_dir, dest_filename)
        cv2.imwrite(preview_dest_path, bgra)
        
    print(f"  [+] Processed full body: {filename} -> {os.path.basename(dest_path)}")
    return True

def main():
    print("=== Bulk Personnel Full Body Portrait Processor (Transparent Mode) ===")
    
    if not os.path.exists(teachers_dir):
        print(f"[!] Error: Teachers directory not found: {teachers_dir}")
        sys.exit(1)
        
    # Find all original image files ending with -2 in the raw directory
    raw_files = os.listdir(raw_teachers_dir)
    pattern = re.compile(r'^\d+-2\.(jpg|jpeg)$', re.IGNORECASE)
    target_files = [f for f in raw_files if pattern.match(f)]
    
    if not target_files:
        print("No original side-profile personnel images (ending with -2) found in raw/.")
        sys.exit(1)
        
    print(f"Processing {len(target_files)} full body transparent portraits...")
    
    success_count = 0
    for f in target_files:
        if process_full_portrait(f):
            success_count += 1
            
    print(f"\n[+] Finished processing {success_count}/{len(target_files)} full body portraits successfully.")

if __name__ == '__main__':
    main()
