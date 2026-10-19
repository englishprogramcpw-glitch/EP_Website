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
raw_teachers_dir = os.path.join(teachers_dir, 'raw')

# Configurable Output Parameters
TARGET_SIZE = 400  # output image size (400x400 px)

def process_image(filename):
    base_name = os.path.splitext(filename)[0]
    if base_name.endswith('-2'):
        dest_filename = f"{base_name}.png"
    else:
        dest_filename = f"{base_name}-2.png"
    filepath = os.path.join(raw_teachers_dir, filename)
    dest_path = os.path.join(teachers_dir, dest_filename)
    
    img = cv2.imread(filepath)
    if img is None:
        print(f"  [!] Failed to read {filename}")
        return False
        
    H, W = img.shape[:2]
    
    # 1. Background Mask in HSV (used for subject & head detection)
    hsv = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)
    lower_blue = np.array([95, 80, 80])
    upper_blue = np.array([135, 255, 255])
    blue_mask = cv2.inRange(hsv, lower_blue, upper_blue)
    subject_mask = cv2.bitwise_not(blue_mask)
    
    # 2. Adaptive Centering using contours to locate the head
    contours, _ = cv2.findContours(subject_mask, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
    cx_crop = int(W * 0.46)
    cy_crop = int(H * 0.38)
    method_used = "Geometric Crop (Fallback)"
    
    if contours:
        try:
            largest_contour = max(contours, key=cv2.contourArea)
            bx, by, bw, bh = cv2.boundingRect(largest_contour)
            
            # Head is in the upper 45% of the bounding box
            head_y_limit = by + int(bh * 0.45)
            head_mask = subject_mask[by:head_y_limit, bx:bx+bw]
            
            # Calculate centroid of the head region
            M = cv2.moments(head_mask)
            if M["m00"] != 0:
                cx_crop = int(M["m10"] / M["m00"]) + bx
                cy_crop = int(M["m01"] / M["m00"]) + by
                method_used = "Adaptive Head Centered"
            else:
                cx_crop = bx + bw // 2
                cy_crop = by + int(bh * 0.22)
                method_used = "Bounding Box Centered"
        except Exception:
            pass
            
    # 3. Crop around Detected Head
    crop_size = int(W * 0.70)
    x1 = cx_crop - crop_size // 2
    y1 = cy_crop - crop_size // 2
    
    # Adjust crop boundaries
    x1_valid = max(0, x1)
    y1_valid = max(0, y1)
    x2_valid = min(W, x1 + crop_size)
    y2_valid = min(H, y1 + crop_size)
    
    crop = img[y1_valid:y2_valid, x1_valid:x2_valid]
    
    # Pad if crop went out of bounds to keep it square
    pad_left = max(0, -x1)
    pad_top = max(0, -y1)
    pad_right = max(0, (x1 + crop_size) - W)
    pad_bottom = max(0, (y1 + crop_size) - H)
    if pad_left > 0 or pad_top > 0 or pad_right > 0 or pad_bottom > 0:
        crop = cv2.copyMakeBorder(crop, pad_top, pad_bottom, pad_left, pad_right, borderType=cv2.BORDER_REPLICATE)
        
    crop_resized = cv2.resize(crop, (TARGET_SIZE, TARGET_SIZE), interpolation=cv2.INTER_AREA)
    
    # 4. Soft Matte Masking calculation on original channels (to ensure clean keying)
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
    is_blue_color = (h_c >= 90) & (h_c <= 140) & (s_c >= 50) & (v_c >= 40)
    
    alpha = np.ones_like(soft_alpha)
    alpha[is_blue_color] = soft_alpha[is_blue_color]
    alpha = cv2.GaussianBlur(alpha, (3, 3), 0)
    
    # 4.5 Auto Color Matching (Safe Blue-Ratio Scaling to remove blue color casts without altering skin warmth)
    # Sample background color from the top corners (immune to clothing/hair color interference)
    bg_sample_left = img[0:30, 0:30]
    bg_sample_right = img[0:30, W-30:W]
    bg_sample = np.vstack([bg_sample_left, bg_sample_right])
    bg_b, bg_g, bg_r = np.mean(bg_sample, axis=(0, 1))
        
    # Scale blue channel to align background ratio. Standard blue-to-green ratio is ~2.15 (slight warming).
    target_bg_ratio = 2.15
    current_bg_ratio = bg_b / bg_g if bg_g > 0 else 2.2
    s_b = np.clip(target_bg_ratio / current_bg_ratio, 0.80, 1.10)
    
    # Apply blue scaling only. Keep red and green channels untouched to prevent artificial orange casts.
    b_corr = np.clip(b_ch * s_b, 0, 255)
    crop_corrected = cv2.merge([b_corr, g_ch, r_ch]).astype(np.uint8)
    
    # 4.7 Skin Smoothing (Bilateral Filter + original blend)
    smoothed = cv2.bilateralFilter(crop_corrected, d=7, sigmaColor=35, sigmaSpace=35)
    crop_final = cv2.addWeighted(crop_corrected, 0.65, smoothed, 0.35, 0)
    
    # 5. Create Circular Transparency Mask
    mask_circle = np.zeros((TARGET_SIZE, TARGET_SIZE), dtype=np.uint8)
    radius = TARGET_SIZE // 2
    center = (radius, radius)
    cv2.circle(mask_circle, center, radius - 2, 255, -1)
    
    # Combine the subject mask (alpha) and the circle mask
    final_alpha = (alpha * (mask_circle / 255.0) * 255.0).astype(np.uint8)
    
    # Convert BGR to BGRA and set the transparency channel
    bgra = cv2.cvtColor(crop_final, cv2.COLOR_BGR2BGRA)
    bgra[:, :, 3] = final_alpha
    
    # STRICT CORNER & BACKGROUND REMOVAL: set BGR to 0 where alpha is 0
    bgra[final_alpha == 0, :3] = 0
    
    # Save the output file to the root assets folder
    cv2.imwrite(dest_path, bgra)
    
    # Also save to preview directory if it exists to ensure local server works
    preview_teachers_dir = os.path.join(base_dir, 'preview', 'img', 'teachers')
    if os.path.exists(preview_teachers_dir):
        preview_dest_path = os.path.join(preview_teachers_dir, dest_filename)
        cv2.imwrite(preview_dest_path, bgra)
        
    print(f"  [+] Processed {filename} -> {os.path.basename(dest_path)} ({method_used})")
    return True

def main():
    print("=== Bulk Personnel Portrait Processor (Transparent Mode) ===")
    
    if not os.path.exists(teachers_dir):
        print(f"[!] Error: Teachers directory not found: {teachers_dir}")
        sys.exit(1)
        
    # Ensure raw directory exists
    if not os.path.exists(raw_teachers_dir):
        print(f"[+] Creating raw directory: {raw_teachers_dir}")
        os.makedirs(raw_teachers_dir, exist_ok=True)
        
    # Auto-migrate existing raw files from teachers_dir to raw_teachers_dir
    pattern = re.compile(r'^\d+-2\.(jpg|jpeg)$', re.IGNORECASE)
    all_files = os.listdir(teachers_dir)
    migrated_count = 0
    for f in all_files:
        if pattern.match(f):
            src_path = os.path.join(teachers_dir, f)
            dest_path = os.path.join(raw_teachers_dir, f)
            try:
                os.rename(src_path, dest_path)
                migrated_count += 1
            except Exception as e:
                print(f"  [!] Failed to move {f} to raw/: {e}")
    if migrated_count > 0:
        print(f"[+] Automatically migrated {migrated_count} original images to raw/ folder.")
        
    # Find all original image files ending with -2 in the raw directory
    raw_files = os.listdir(raw_teachers_dir)
    target_files = [f for f in raw_files if pattern.match(f)]
    
    if not target_files:
        print("No original side-profile personnel images (ending with -2) found to process.")
        print("Place original side-profile portrait photos named with their IDs (e.g. 10158-2.jpg) in:")
        print(f"  {raw_teachers_dir}")
        sys.exit(1)
        
    print(f"Found {len(target_files)} side-profile images to process.")
    
    success_count = 0
    for f in target_files:
        if process_image(f):
            success_count += 1
            
    print(f"\n[+] Finished processing {success_count}/{len(target_files)} images successfully.")
    print("Processed images are saved as transparent '<personnelId>-2.png' files.")
    print("Background styling and borders are now handled dynamically via CSS.")

if __name__ == '__main__':
    main()
