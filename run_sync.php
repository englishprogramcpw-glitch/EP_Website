<?php
/**
 * run_sync.php - รันสคริปต์ซิงค์ข้อมูลบุคลากรจากเซิร์ฟเวอร์โรงเรียนโดยตรงผ่านหน้าบ้าน
 */
header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ตรวจสอบความปลอดภัยจำลอง (เฉพาะผู้สิทธิ์ admin)
if (!isset($_SESSION['ep_mock_user']) || $_SESSION['ep_mock_user']['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'คุณไม่มีสิทธิ์เข้าถึงส่วนนี้ (ต้องการสิทธิ์ผู้ดูแลระบบ)']);
    exit;
}

// อนุญาตให้รันเฉพาะจากเครื่องเซิร์ฟเวอร์ Localhost เท่านั้น
$allowedIps = ['127.0.0.1', '::1'];
if (!in_array($_SERVER['REMOTE_ADDR'] ?? '', $allowedIps)) {
    echo json_encode(['success' => false, 'message' => 'ปฏิเสธการเข้าถึง: อนุญาตให้รันคำสั่งซิงค์เฉพาะบนเครื่องโฮสต์ (Localhost) เท่านั้น']);
    exit;
}

// รันคำสั่งไพธอนพร้อมอาร์กิวเมนต์ --sync เพื่อบังคับซิงค์
exec("python sync_staff.py --sync 2>&1", $output, $return_var);

if ($return_var === 0) {
    echo json_encode([
        'success' => true,
        'message' => 'ซิงค์ข้อมูลและประมวลผลรูปภาพเสร็จสมบูรณ์!',
        'log' => $output
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'เกิดข้อผิดพลาดในการประมวลผลข้อมูล (รหัส: ' . $return_var . ')',
        'log' => $output
    ]);
}
