<?php
/**
 * save_data.php - ระบบจัดเก็บข้อมูลแบบไฟล์เดี่ยว (Flat-File Database)
 * =========================================================================
 * ทำงานในฝั่งเซิร์ฟเวอร์ PHP เพื่อเขียนบันทึกไฟล์ JSON ให้ทุกคนเห็นข้อมูลตรงกัน
 * โดยไม่ต้องพึ่งพาฐานข้อมูลภายนอกของโรงเรียน
 */

header('Content-Type: application/json');

ini_set('display_errors', '0');

require_once __DIR__ . '/auth.php';

// 1. ตรวจสอบ CSRF Token จากคำขอเพื่อป้องกันสคริปต์ข้ามโดเมนแอบบันทึกข้อมูล
$headers = function_exists('getallheaders') ? getallheaders() : [];
$csrfToken = isset($_SERVER['HTTP_X_CSRF_TOKEN']) ? $_SERVER['HTTP_X_CSRF_TOKEN'] : (isset($headers['X-CSRF-Token']) ? $headers['X-CSRF-Token'] : ($headers['x-csrf-token'] ?? ''));

if (empty($_SESSION['csrf_token']) || $csrfToken !== $_SESSION['csrf_token']) {
    http_response_code(403);
    echo json_encode([
        'success' => false,
        'message' => 'การเข้าถึงไม่ถูกต้อง: ล้มเหลวในการตรวจสอบโทเคนความปลอดภัย (CSRF Token Verification Failed)'
    ]);
    exit;
}

// 2. ตรวจสอบสิทธิ์ผู้ดูแลระบบที่ผ่านการยืนยันตัวตนแล้ว
if (!is_admin_logged_in()) {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'message' => 'ปฏิเสธการเข้าถึง: เฉพาะผู้ดูแลระบบที่ล็อกอินแล้วเท่านั้นที่สามารถทำการเขียนบันทึกข้อมูลได้ (Admin Session Required)'
    ]);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 0. จัดการอัปโหลดไฟล์รูปภาพ (Upload Media File)
    if (isset($_FILES['media_file'])) {
        $file = $_FILES['media_file'];
        if ($file['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์ (Error Code: ' . $file['error'] . ')']);
            exit;
        }

        // ตรวจสอบนามสกุลไฟล์
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        if (!in_array($ext, $allowedExts)) {
            echo json_encode(['success' => false, 'message' => 'อนุญาตเฉพาะไฟล์รูปภาพ (JPG, PNG, WEBP, GIF) เท่านั้น']);
            exit;
        }

        $uploadDir = __DIR__ . '/img/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newFileName = 'card_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $targetPath = $uploadDir . $newFileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // ซิงค์ไปยัง preview/img/uploads/
            $previewUploadDir = __DIR__ . '/preview/img/uploads/';
            if (!is_dir($previewUploadDir)) {
                @mkdir($previewUploadDir, 0777, true);
            }
            @copy($targetPath, $previewUploadDir . $newFileName);

            $relativeUrl = 'img/uploads/' . $newFileName;
            echo json_encode(['success' => true, 'url' => $relativeUrl, 'message' => 'อัปโหลดรูปภาพสำเร็จ']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'ไม่สามารถบันทึกไฟล์รูปภาพลงเซิร์ฟเวอร์ได้']);
            exit;
        }
    }

    // อ่านข้อมูลที่ส่งเข้ามาแบบ JSON
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);

    if (isset($input['type']) && isset($input['data'])) {
        $type = $input['type'];
        $data = $input['data'];

        // ป้องกันการแฮกระบบโดยเช็คประเภทข้อมูล
        if ($type === 'news') {
            $filePath = 'data/db_news.json';
            
            // บันทึกไฟล์ JSON
            $jsonString = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            if (file_put_contents($filePath, $jsonString) !== false) {
                echo json_encode(['success' => true, 'message' => 'บันทึกข้อมูลข่าวสารลงเซิร์ฟเวอร์สำเร็จ']);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'ไม่สามารถเขียนไฟล์ลงเซิร์ฟเวอร์ได้ กรุณาตรวจสอบสิทธิ์การเขียนไฟล์ (Write Permission)']);
                exit;
            }
        } else if ($type === 'staff') {
            $filePath = 'data/db_staff.json';
            
            // บันทึกไฟล์ JSON
            $jsonString = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            if (file_put_contents($filePath, $jsonString) !== false) {
                echo json_encode(['success' => true, 'message' => 'บันทึกข้อมูลบุคลากรลงเซิร์ฟเวอร์สำเร็จ']);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'ไม่สามารถเขียนไฟล์ลงเซิร์ฟเวอร์ได้ กรุณาตรวจสอบสิทธิ์การเขียนไฟล์ (Write Permission)']);
                exit;
            }
        } else if ($type === 'slides') {
            $filePath = 'data/db_slides.json';
            
            // บันทึกไฟล์ JSON
            $jsonString = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            if (file_put_contents($filePath, $jsonString) !== false) {
                echo json_encode(['success' => true, 'message' => 'บันทึกข้อมูลสไลด์ลงเซิร์ฟเวอร์สำเร็จ']);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'ไม่สามารถเขียนไฟล์ลงเซิร์ฟเวอร์ได้ กรุณาตรวจสอบสิทธิ์การเขียนไฟล์ (Write Permission)']);
                exit;
            }
        } else if ($type === 'site_settings') {
            $filePath = 'data/db_site_settings.json';
            
            // บันทึกไฟล์ JSON
            $jsonString = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            if (file_put_contents($filePath, $jsonString) !== false) {
                // ซิงค์ไปยัง preview/data/
                $previewFilePath = 'preview/data/db_site_settings.json';
                if (file_exists('preview/data')) {
                    @file_put_contents($previewFilePath, $jsonString);
                }
                // สั่งรัน compile.js อัตโนมัติในเบื้องหลัง
                @exec('node compile.js > nul 2>&1');

                echo json_encode(['success' => true, 'message' => 'บันทึกข้อมูลการตั้งค่าเว็บไซต์สำเร็จ']);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'ไม่สามารถเขียนไฟล์ลงเซิร์ฟเวอร์ได้']);
                exit;
            }
        }
    }
}

echo json_encode(['success' => false, 'message' => 'การร้องขอไม่ถูกต้อง (Invalid Request)']);
