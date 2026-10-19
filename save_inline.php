<?php
/**
 * save_inline.php - ระบบบันทึกข้อมูลหน้าเว็บโดยตรง (Visual In-Place Editor)
 * ponytail: ใช้ regex แทนที่คำในตัวแปรและรัน compile.js อัตโนมัติ
 */
header('Content-Type: application/json');

ini_set('display_errors', '0');

require_once __DIR__ . '/auth.php';

// 1. ตรวจสอบ CSRF Token จากคำขอ
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


$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);

if (!$input || !isset($input['file']) || !isset($input['edits'])) {
    echo json_encode(['success' => false, 'message' => 'ข้อมูลที่ส่งมาไม่สมบูรณ์']);
    exit;
}

$allowedFiles = ['index.php', 'about.php', 'curriculum.php', 'staff.php', 'contact.php', 'admission.php', 'fees.php', 'tour.php', 'awards.php'];
$fileName = basename($input['file']);

if (!in_array($fileName, $allowedFiles)) {
    echo json_encode(['success' => false, 'message' => 'ไฟล์นี้ไม่ได้รับอนุญาตให้แก้ไข']);
    exit;
}

$filePath = __DIR__ . '/' . $fileName;
if (!file_exists($filePath)) {
    echo json_encode(['success' => false, 'message' => 'ไม่พบไฟล์ที่เลือก']);
    exit;
}

$content = file_get_contents($filePath);
$updatedCount = 0;

// แยกแก้ไขบุคลากรออกไปจัดการที่ db_staff.json
$staffEdits = [];
foreach ($input['edits'] as $key => $newVal) {
    if (preg_match('/^staff_(\d+)_(.+)$/', $key, $matches)) {
        $staffEdits[] = [
            'index' => intval($matches[1]),
            'field' => $matches[2],
            'value' => $newVal
        ];
    }
}

if (!empty($staffEdits)) {
    $dbStaffPath = __DIR__ . '/data/db_staff.json';
    if (file_exists($dbStaffPath)) {
        $dbStaffContent = file_get_contents($dbStaffPath);
        $dbStaff = json_decode($dbStaffContent, true);
        if (is_array($dbStaff)) {
            foreach ($staffEdits as $edit) {
                $idx = $edit['index'];
                $field = $edit['field'];
                $val = $edit['value'];
                if ($field !== 'imageUrl') {
                    // ล้างแท็ก HTML และถอดรหัส HTML entities เพื่อเก็บเป็นข้อความดิบ
                    $val = html_entity_decode(strip_tags($val), ENT_QUOTES, 'UTF-8');
                }
                if (isset($dbStaff[$idx])) {
                    $dbStaff[$idx][$field] = $val;
                    $updatedCount++;
                }
            }
            file_put_contents($dbStaffPath, json_encode($dbStaff, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
    }
}

foreach ($input['edits'] as $key => $newVal) {
    // ข้ามคีย์ที่จัดเก็บใน JSON ไปแล้ว
    if (strpos($key, 'staff_') === 0) {
        continue;
    }

    // 1. ค้นหาแท็ก <img> ที่ต้องการแทนที่ src
    $imgPattern = "/<img\b[^>]*data-edit-id=['\"]" . preg_quote($key, '/') . "['\"][^>]*>/is";
    if (preg_match($imgPattern, $content)) {
        $content = preg_replace_callback($imgPattern, function($match) use ($newVal, &$updatedCount) {
            $replaced = preg_replace('/src=["\']([^"\']*)["\']/', 'src="' . htmlspecialchars($newVal, ENT_QUOTES) . '"', $match[0], 1, $count);
            if ($count > 0) $updatedCount++;
            return $replaced;
        }, $content);
        continue;
    }

    // 2. ค้นหาแท็กที่มีสไตล์พื้นหลัง background-image: url(...)
    $bgPattern = "/<[a-zA-Z0-9]+\b[^>]*data-edit-id=['\"]" . preg_quote($key, '/') . "['\"][^>]*>/is";
    if (preg_match($bgPattern, $content, $matchBgs) && preg_match('/url\([\'"]?([^\'")\s]*)[\'"]?\)/i', $matchBgs[0])) {
        $content = preg_replace_callback($bgPattern, function($match) use ($newVal, &$updatedCount) {
            $replaced = preg_replace('/url\([\'"]?([^\'")\s]*)[\'"]?\)/i', 'url(\'' . htmlspecialchars($newVal, ENT_QUOTES) . '\')', $match[0], 1, $count);
            if ($count > 0) $updatedCount++;
            return $replaced;
        }, $content);
        continue;
    }

    // 3. ค้นหาแท็กทั่วไปเพื่อแทนที่ innerHTML
    $tagPattern = "/(<([a-zA-Z0-9]+)[^>]*data-edit-id=['\"]" . preg_quote($key, '/') . "['\"][^>]*>)(.*?)(<\/\\2>)/is";
    if (preg_match($tagPattern, $content)) {
        $content = preg_replace_callback($tagPattern, function($match) use ($newVal, &$updatedCount) {
            $updatedCount++;
            return $match[1] . $newVal . $match[4];
        }, $content);
    }
}

if ($updatedCount > 0) {
    if (file_put_contents($filePath, $content) !== false) {
        // คอมไพล์หน้าพรีวิวโดยอัตโนมัติ
        exec('node compile.js 2>&1', $execOutput, $returnVar);
        echo json_encode([
            'success' => true, 
            'message' => "บันทึกข้อมูลสำเร็จ อัปเดตทั้งหมด $updatedCount จุด",
            'compile' => ($returnVar === 0)
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'บันทึกลงไฟล์ไม่สำเร็จ กรุณาตรวจสอบสิทธิ์การเขียนไฟล์']);
    }
} else {
    echo json_encode(['success' => true, 'message' => 'ไม่มีการเปลี่ยนแปลงข้อมูล']);
}
