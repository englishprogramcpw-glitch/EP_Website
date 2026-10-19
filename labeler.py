import os
import sys
import json
import shutil
import urllib.parse
from http.server import SimpleHTTPRequestHandler, HTTPServer

# Make sure we print utf-8
sys.stdout.reconfigure(encoding='utf-8')

PORT = 8000
base_dir = os.path.dirname(os.path.abspath(__file__))
db_path = os.path.join(base_dir, 'data', 'db_staff.json')
temp_dir = os.path.join(base_dir, 'img', 'teachers', 'temp_crops')
teachers_dir = os.path.join(base_dir, 'img', 'teachers')

class LabelerHandler(SimpleHTTPRequestHandler):
    def __init__(self, *args, **kwargs):
        # Initialize SimpleHTTPRequestHandler which handles static files automatically
        super().__init__(*args, directory=base_dir, **kwargs)

    def do_GET(self):
        url = urllib.parse.urlparse(self.path)
        if url.path == '/api/crops':
            self.get_crops()
        elif url.path == '/api/staff':
            self.get_staff()
        else:
            super().do_GET()

    def do_POST(self):
        url = urllib.parse.urlparse(self.path)
        if url.path == '/api/save':
            self.post_save()
        elif url.path == '/api/rotate':
            self.post_rotate()
        elif url.path == '/api/delete':
            self.post_delete()
        else:
            self.send_error(404, "API endpoint not found")

    def get_crops(self):
        meta_path = os.path.join(temp_dir, 'crops.json')
        if not os.path.exists(meta_path):
            # Scan directory directly if crops.json doesn't exist
            if os.path.exists(temp_dir):
                files = sorted([f for f in os.listdir(temp_dir) if f.endswith('.png')])
                crops = [{'filename': f} for f in files]
            else:
                crops = []
        else:
            try:
                with open(meta_path, 'r', encoding='utf-8') as f:
                    crops = json.load(f)
            except Exception as e:
                crops = []
                
        # Filter only existing crop files
        valid_crops = []
        for c in crops:
            if os.path.exists(os.path.join(temp_dir, c['filename'])):
                valid_crops.append(c)
                
        self.send_json(valid_crops)

    def get_staff(self):
        if not os.path.exists(db_path):
            self.send_json([])
            return
        try:
            with open(db_path, 'r', encoding='utf-8') as f:
                staff = json.load(f)
            self.send_json(staff)
        except Exception as e:
            self.send_error(500, f"Error reading database: {e}")

    def post_save(self):
        content_length = int(self.headers['Content-Length'])
        post_data = self.rfile.read(content_length)
        try:
            data = json.loads(post_data.decode('utf-8'))
            crop_filename = data['crop_filename']
            personnel_id = data['personnel_id']
            
            src_path = os.path.join(temp_dir, crop_filename)
            # Use PNG extension since crops are transparent PNGs
            dest_filename = f"{personnel_id}.png"
            dest_path = os.path.join(teachers_dir, dest_filename)
            
            if not os.path.exists(src_path):
                self.send_error(400, "Crop file does not exist")
                return
                
            # Copy file to teachers folder
            shutil.copy2(src_path, dest_path)
            # Delete from temp crops folder
            os.remove(src_path)
            
            # Update db_staff.json
            if os.path.exists(db_path):
                with open(db_path, 'r', encoding='utf-8') as f:
                    staff_list = json.load(f)
                
                updated = False
                for member in staff_list:
                    if member.get('personnelId') == personnel_id:
                        # Update imageUrl
                        member['imageUrl'] = f"img/teachers/{dest_filename}"
                        updated = True
                        break
                
                if updated:
                    with open(db_path, 'w', encoding='utf-8') as f:
                        json.dump(staff_list, f, ensure_ascii=False, indent=2)
                        
            self.send_json({"status": "ok", "message": f"Saved {dest_filename}"})
        except Exception as e:
            self.send_error(500, f"Failed to save: {e}")

    def post_rotate(self):
        content_length = int(self.headers['Content-Length'])
        post_data = self.rfile.read(content_length)
        try:
            data = json.loads(post_data.decode('utf-8'))
            crop_filename = data['crop_filename']
            src_path = os.path.join(temp_dir, crop_filename)
            
            if not os.path.exists(src_path):
                self.send_error(400, "Crop file does not exist")
                return
                
            from PIL import Image
            with Image.open(src_path) as img:
                rotated = img.rotate(-90, expand=True) # rotate clockwise
                rotated.save(src_path)
                
            self.send_json({"status": "ok", "message": "Rotated successfully"})
        except Exception as e:
            self.send_error(500, f"Failed to rotate: {e}")

    def post_delete(self):
        content_length = int(self.headers['Content-Length'])
        post_data = self.rfile.read(content_length)
        try:
            data = json.loads(post_data.decode('utf-8'))
            crop_filename = data['crop_filename']
            src_path = os.path.join(temp_dir, crop_filename)
            
            if os.path.exists(src_path):
                os.remove(src_path)
                
            self.send_json({"status": "ok", "message": "Deleted successfully"})
        except Exception as e:
            self.send_error(500, f"Failed to delete: {e}")

    def send_json(self, data):
        self.send_response(200)
        self.send_header('Content-Type', 'application/json; charset=utf-8')
        self.send_header('Cache-Control', 'no-cache, no-store, must-revalidate')
        self.end_headers()
        self.wfile.write(json.dumps(data, ensure_ascii=False).encode('utf-8'))

def main():
    print(f"Starting local Labeling Server on http://localhost:{PORT} ...")
    print(f"Workspace path: {base_dir}")
    print("Press Ctrl+C to stop the server.")
    
    server = HTTPServer(('localhost', PORT), LabelerHandler)
    
    # Auto open browser
    try:
        import webbrowser
        webbrowser.open(f"http://localhost:{PORT}/labeler.html")
    except Exception:
        pass
        
    try:
        server.serve_forever()
    except KeyboardInterrupt:
        print("\nStopping server.")
        server.server_close()

if __name__ == '__main__':
    main()
