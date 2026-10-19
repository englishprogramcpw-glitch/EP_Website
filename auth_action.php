<?php
/**
 * auth_action.php - API จัดการความปลอดภัย รหัสผ่าน และโหมดปิดปรับปรุงเว็บไซต์ EP
 * โครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ โรงเรียนชลประทานวิทยา
 */
header('Content-Type: application/json; charset=UTF-8');
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/maintenance_guard.php';

// 1. ตรวจสอบ CSRF Token
$headers = function_exists('getallheaders') ? getallheaders() : [];
$csrfToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? $headers['X-CSRF-Token'] ?? $headers['x-csrf-token'] ?? '';
if (empty($_SESSION['csrf_token']) || $csrfToken !== $_SESSION['csrf_token']) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'การยืนยันความปลอดภัยล้มเหลว (CSRF Token Failed)']);
    exit;
}

// 2. ตรวจสอบสถานะการล็อกอิน
if (!is_admin_logged_in()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'กรุณาเข้าสู่ระบบผู้ดูแลระบบก่อนทำรายการ']);
    exit;
}

// 3. อ่านข้อมูลที่ส่งเข้ามา
$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?: $_POST;
$action = $data['action'] ?? '';

// เปลี่ยนรหัสผ่าน
if ($action === 'change_password') {
    $current = trim($data['current_password'] ?? '');
    $new = trim($data['new_password'] ?? '');
    $confirm = trim($data['confirm_password'] ?? '');
    
    if (empty($current) || empty($new) || empty($confirm)) {
        echo json_encode(['success' => false, 'message' => 'กรุณากรอกข้อมูลรหัสผ่านให้ครบทุกช่อง']);
        exit;
    }
    
    if ($new !== $confirm) {
        echo json_encode(['success' => false, 'message' => 'รหัสผ่านใหม่และการยืนยันรหัสผ่านไม่ตรงกัน']);
        exit;
    }
    
    $result = change_admin_password($current, $new);
    echo json_encode($result);
    exit;
}

// ดึงสถานะโหมดปิดปรับปรุง
if ($action === 'get_maintenance') {
    $config = get_maintenance_config();
    echo json_encode(['success' => true, 'config' => $config]);
    exit;
}

// เปิด/ปิด หรืออัปเดตข้อความโหมดปิดปรับปรุง
if ($action === 'toggle_maintenance') {
    $config = get_maintenance_config();
    if (isset($data['enabled'])) {
        $config['enabled'] = (bool)$data['enabled'];
    } else {
        $config['enabled'] = !$config['enabled'];
    }
    
    if (isset($data['redirect_to_facebook'])) $config['redirect_to_facebook'] = (bool)$data['redirect_to_facebook'];
    if (isset($data['facebook_url'])) $config['facebook_url'] = trim($data['facebook_url']);
    if (isset($data['title_th'])) $config['title_th'] = trim($data['title_th']);
    if (isset($data['title_en'])) $config['title_en'] = trim($data['title_en']);
    if (isset($data['message_th'])) $config['message_th'] = trim($data['message_th']);
    if (isset($data['message_en'])) $config['message_en'] = trim($data['message_en']);
    
    $saved = save_maintenance_config($config);
    if ($saved) {
        $statusText = $config['enabled'] ? 'เปิดโหมดปิดปรับปรุงแล้ว (บุคคลภายนอกจะไม่เห็นหน้าเว็บ)' : 'เปิดเว็บไซต์สู่สาธารณะแล้ว (ทุกคนสามารถเข้าชมได้)';
        echo json_encode(['success' => true, 'message' => $statusText, 'config' => $config]);
    } else {
        echo json_encode(['success' => false, 'message' => 'ไม่สามารถบันทึกการตั้งค่าได้']);
    }
    exit;
}

// ออกจากระบบ
if ($action === 'logout') {
    admin_logout();
    echo json_encode(['success' => true, 'message' => 'ออกจากระบบเรียบร้อยแล้ว']);
    exit;
}

echo json_encode(['success' => false, 'message' => 'คำสั่งไม่ถูกต้อง']);
