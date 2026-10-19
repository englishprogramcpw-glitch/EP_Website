<?php
/**
 * sync_session.php - ซิงค์สถานะการล็อกอินจำลองจากฝั่งไคลเอนต์ไปยังเซสชันฝั่งเซิร์ฟเวอร์ PHP
 */
header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);

if ($input && isset($input['action'])) {
    if ($input['action'] === 'login' && isset($input['user'])) {
        $_SESSION['ep_mock_user'] = [
            'username' => htmlspecialchars($input['user']['username'], ENT_QUOTES, 'UTF-8'),
            'name' => htmlspecialchars($input['user']['name'], ENT_QUOTES, 'UTF-8'),
            'role' => htmlspecialchars($input['user']['role'], ENT_QUOTES, 'UTF-8')
        ];
        echo json_encode(['success' => true, 'message' => 'ซิงค์เซสชันผู้ดูแลระบบฝั่งเซิร์ฟเวอร์สำเร็จ']);
        exit;
    } else if ($input['action'] === 'logout') {
        unset($_SESSION['ep_mock_user']);
        session_destroy();
        echo json_encode(['success' => true, 'message' => 'ออกจากระบบเซสชันฝั่งเซิร์ฟเวอร์สำเร็จ']);
        exit;
    }
}

echo json_encode(['success' => false, 'message' => 'คำขอไม่ถูกต้อง']);
