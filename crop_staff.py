import os
import sys
import json
import shutil

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
temp_dir = os.path.join(base_dir, 'img', 'teachers', 'temp_crops')

def find_poster():
    # Look for poster.png or poster.jpg or poster.jpeg in base_dir
    for ext in ['.png', '.jpg', '.jpeg', '.PNG', '.JPG', '.JPEG']:
        path = os.path.join(base_dir, f"poster{ext}")
        if os.path.exists(path):
            return path
    return None

def main():
    print("=== Personnel Photo Cropper ===")
    
    poster_path = find_poster()
    if not poster_path:
        print("\n[!] Error: poster.png (or poster.jpg) not found in the current directory.")
        print("Please place the high-resolution poster image file in:")
        print(f"  {base_dir}\\poster.png")
        sys.exit(1)
        
    print(f"Loading poster image: {os.path.basename(poster_path)}")
    img = cv2.imread(poster_path)
    if img is None:
        print("[!] Error: Could not read the image file.")
        sys.exit(1)
        
    h, w, c = img.shape
    print(f"Image Resolution: {w}x{h} ({c} channels)")
    
    # Pre-processing for circle detection
    print("Pre-processing image...")
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    blurred = cv2.medianBlur(gray, 9)
    
    # Estimate circle sizes dynamically based on image width
    # In a typical grid, circle radius is around 1% to 4% of image width
    min_r = int(w * 0.008)
    max_r = int(w * 0.04)
    min_dist = int(min_r * 2.2) # circles shouldn't overlap
    
    print(f"Searching for circles with radius between {min_r} and {max_r} pixels...")
    
    # Hough Circle Transform
    # param2=35 is a good balance. If detecting too many/few, user can tweak it.
    circles = cv2.HoughCircles(
        blurred, 
        cv2.HOUGH_GRADIENT, 
        dp=1.2, 
        minDist=min_dist,
        param1=50, 
        param2=35, 
        minRadius=min_r, 
        maxRadius=max_r
    )
    
    if circles is None:
        print("[!] No circles detected. Try adjusting the parameters or check image quality.")
        sys.exit(1)
        
    circles = np.uint16(np.around(circles))
    detected_list = circles[0, :]
    total_detected = len(detected_list)
    print(f"Detected {total_detected} circles.")
    
    # Sort circles: Top-to-Bottom, Left-to-Right
    # We group circles into rows. If y-coordinates are within 1.2 * radius of each other, they are in the same row.
    avg_r = np.mean([c[2] for c in detected_list])
    row_tolerance = int(avg_r * 1.2)
    
    # Sort by Y first
    sorted_by_y = sorted(detected_list, key=lambda item: item[1])
    
    rows = []
    current_row = []
    
    for circle in sorted_by_y:
        x, y, r = circle
        if not current_row:
            current_row.append(circle)
        else:
            prev_y = current_row[-1][1]
            if abs(int(y) - int(prev_y)) < row_tolerance:
                current_row.append(circle)
            else:
                # Sort the completed row by X coordinate
                current_row.sort(key=lambda item: item[0])
                rows.append(current_row)
                current_row = [circle]
                
    if current_row:
        current_row.sort(key=lambda item: item[0])
        rows.append(current_row)
        
    # Flatten rows back to a single list of sorted circles
    sorted_circles = [circle for row in rows for circle in row]
    
    # Re-create temp folder
    if os.path.exists(temp_dir):
        shutil.rmtree(temp_dir)
    os.makedirs(temp_dir, exist_ok=True)
    
    crops_meta = []
    
    print("Cropping and masking circles...")
    for idx, circle in enumerate(sorted_circles):
        x, y, r = int(circle[0]), int(circle[1]), int(circle[2])
        
        # Add a small padding (5%) around the detected circle
        pad = int(r * 0.05)
        r_pad = r + pad
        
        # Define crop boundaries
        x1, y1 = max(0, x - r_pad), max(0, y - r_pad)
        x2, y2 = min(w, x + r_pad), min(h, y + r_pad)
        
        crop = img[y1:y2, x1:x2]
        if crop.size == 0:
            continue
            
        # Create a transparent mask for the circle
        ch, cw = crop.shape[:2]
        mask = np.zeros((ch, cw), dtype=np.uint8)
        cv2.circle(mask, (cw // 2, ch // 2), r, 255, -1)
        
        # Convert BGR crop to BGRA (adds alpha/transparency channel)
        crop_bgra = cv2.cvtColor(crop, cv2.COLOR_BGR2BGRA)
        crop_bgra[:, :, 3] = mask # Set alpha channel to our circular mask
        
        # Save cropped image
        filename = f"crop_{idx + 1:03d}.png"
        filepath = os.path.join(temp_dir, filename)
        cv2.imwrite(filepath, crop_bgra)
        
        crops_meta.append({
            'filename': filename,
            'original_x': x,
            'original_y': y,
            'original_r': r
        })
        
    # Write metadata JSON
    meta_path = os.path.join(temp_dir, 'crops.json')
    with open(meta_path, 'w', encoding='utf-8') as f:
        json.dump(crops_meta, f, ensure_ascii=False, indent=2)
        
    print(f"\n[+] Successfully cropped {len(crops_meta)} images.")
    print(f"Crops saved to: {temp_dir}")
    print(f"Metadata written to: {meta_path}")
    print("\nNext step: Run 'python labeler.py' to map the photos to staff members.")

if __name__ == '__main__':
    main()
