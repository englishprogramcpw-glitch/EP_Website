<?php
/**
 * auth.php - ระบบตรวจสอบสิทธิ์และความปลอดภัยของผู้ดูแลระบบ EP (Admin Authentication)
 * โครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ โรงเรียนชลประทานวิทยา
 */

defined('EP_SECURE_AUTH') or define('EP_SECURE_AUTH', true);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// สร้าง CSRF Token อัตโนมัติหากยังไม่มี
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

define('AUTH_CONFIG_FILE', __DIR__ . '/data/auth_config.php');

/**
 * โหลดหรือสร้างค่าคอนฟิกบัญชีผู้ดูแลระบบ
 */
function get_auth_config() {
    if (!file_exists(AUTH_CONFIG_FILE)) {
        // ค่าเริ่มต้นเมื่อขึ้นระบบครั้งแรก: admin / epadmin2026
        $defaultConfig = [
            'username' => 'admin',
            'password_plain_fallback' => 'epadmin2026',
            'name' => 'ผู้ดูแลระบบ EP (Admin)',
            'role' => 'admin',
            'must_change' => true,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        save_auth_config($defaultConfig);
        return $defaultConfig;
    }
    
    $config = include AUTH_CONFIG_FILE;
    if (!is_array($config)) {
        return [
            'username' => 'admin',
            'password_plain_fallback' => 'epadmin2026',
            'must_change' => true
        ];
    }
    return $config;
}

/**
 * บันทึกค่าคอนฟิกบัญชีผู้ดูแลระบบลงไฟล์ PHP ป้องกันการเปิดอ่านตรงจาก URL
 */
function save_auth_config(array $config) {
    $dir = dirname(AUTH_CONFIG_FILE);
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    
    $content = "<?php\n";
    $content .= "// ระบบจัดเก็บการยืนยันตัวตนผู้ดูแลระบบ EP (ห้ามลบหรือเปิดเผยไฟล์นี้)\n";
    $content .= "defined('EP_SECURE_AUTH') or die('Direct access denied');\n";
    $content .= "return " . var_export($config, true) . ";\n";
    
    return file_put_contents(AUTH_CONFIG_FILE, $content, LOCK_EX) !== false;
}

/**
 * ตรวจสอบว่าแอดมินล็อกอินอยู่หรือไม่
 */
function is_admin_logged_in() {
    if (empty($_SESSION['ep_admin_user']) || empty($_SESSION['ep_admin_user']['role'])) {
        return false;
    }
    
    // ตรวจสอบสถานะบทบาท
    if ($_SESSION['ep_admin_user']['role'] !== 'admin') {
        return false;
    }
    
    // ตรวจสอบ Session Timeout (ไม่มีความเคลื่อนไหวเกิน 4 ชั่วโมง)
    $maxLifetime = 14400;
    if (isset($_SESSION['ep_admin_user']['last_active'])) {
        if (time() - $_SESSION['ep_admin_user']['last_active'] > $maxLifetime) {
            admin_logout();
            return false;
        }
    }
    $_SESSION['ep_admin_user']['last_active'] = time();
    
    return true;
}

/**
 * ตรวจสอบความถูกต้องของการล็อกอิน (พร้อมระบบป้องกัน Brute-Force)
 */
function verify_admin_login($username, $password) {
    // 1. ตรวจสอบ Rate Limit (จำกัดการลองผิดไม่เกิน 5 ครั้งใน 10 นาที)
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['login_last_attempt'] = time();
    }
    
    // รีเซ็ตการนับหากเวลาผ่านไปเกิน 10 นาที (600 วินาที)
    if (time() - $_SESSION['login_last_attempt'] > 600) {
        $_SESSION['login_attempts'] = 0;
    }
    
    if ($_SESSION['login_attempts'] >= 5) {
        $remainingSec = 600 - (time() - $_SESSION['login_last_attempt']);
        $remainingMin = ceil($remainingSec / 60);
        return [
            'success' => false,
            'message' => "มีการลองรหัสผ่านผิดเกินกำหนด เพื่อความปลอดภัยโปรดรออีก {$remainingMin} นาที"
        ];
    }
    
    $config = get_auth_config();
    $targetUsername = $config['username'] ?? 'admin';
    
    $isUserMatch = ($username === $targetUsername);
    $isPassMatch = false;
    
    if ($isUserMatch) {
        if (!empty($config['password_hash']) && function_exists('password_verify') && password_verify($password, $config['password_hash'])) {
            $isPassMatch = true;
        } elseif (!empty($config['password_plain_fallback']) && $password === $config['password_plain_fallback']) {
            // อัปเกรดเป็น password_hash ทันทีอัตโนมัติ
            $isPassMatch = true;
            if (function_exists('password_hash')) {
                $config['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
                unset($config['password_plain_fallback']);
                save_auth_config($config);
            }
        }
    }
    
    if (!$isUserMatch || !$isPassMatch) {
        $_SESSION['login_attempts']++;
        $_SESSION['login_last_attempt'] = time();
        $left = max(0, 5 - $_SESSION['login_attempts']);
        return [
            'success' => false,
            'message' => "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง (เหลือโอกาสลองอีก {$left} ครั้ง)"
        ];
    }
    
    // ล็อกอินสำเร็จ: รีเซ็ตจำนวนครั้งที่ลองผิด
    $_SESSION['login_attempts'] = 0;
    if (function_exists('session_regenerate_id')) {
        @session_regenerate_id(true);
    }
    
    $_SESSION['ep_admin_user'] = [
        'username' => $config['username'],
        'name' => $config['name'] ?? 'ผู้ดูแลระบบ EP (Admin)',
        'role' => 'admin',
        'must_change' => !empty($config['must_change']),
        'login_time' => time(),
        'last_active' => time()
    ];
    
    // ตั้งค่าสำหรับ backward compatibility กับสคริปต์เดิม
    $_SESSION['ep_mock_user'] = $_SESSION['ep_admin_user'];
    
    return [
        'success' => true,
        'must_change' => !empty($config['must_change'])
    ];
}

/**
 * ออกจากระบบ
 */
function admin_logout() {
    unset($_SESSION['ep_admin_user']);
    unset($_SESSION['ep_mock_user']);
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    @session_destroy();
}

/**
 * เปลี่ยนรหัสผ่านผู้ดูแลระบบ
 */
function change_admin_password($currentPassword, $newPassword) {
    if (!is_admin_logged_in()) {
        return ['success' => false, 'message' => 'ไม่มีสิทธิ์ในการเปลี่ยนรหัสผ่าน'];
    }
    
    if (strlen($newPassword) < 6) {
        return ['success' => false, 'message' => 'รหัสผ่านใหม่ต้องมีความยาวอย่างน้อย 6 ตัวอักษร'];
    }
    
    $config = get_auth_config();
    $isCurrentValid = false;
    if (!empty($config['password_hash']) && function_exists('password_verify') && password_verify($currentPassword, $config['password_hash'])) {
        $isCurrentValid = true;
    } elseif (!empty($config['password_plain_fallback']) && $currentPassword === $config['password_plain_fallback']) {
        $isCurrentValid = true;
    }
    
    if (!$isCurrentValid) {
        return ['success' => false, 'message' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง'];
    }
    
    if (function_exists('password_hash')) {
        $config['password_hash'] = password_hash($newPassword, PASSWORD_DEFAULT);
        unset($config['password_plain_fallback']);
    } else {
        $config['password_plain_fallback'] = $newPassword;
    }
    
    $config['must_change'] = false;
    $config['updated_at'] = date('Y-m-d H:i:s');
    
    if (save_auth_config($config)) {
        $_SESSION['ep_admin_user']['must_change'] = false;
        if (isset($_SESSION['ep_mock_user'])) {
            $_SESSION['ep_mock_user']['must_change'] = false;
        }
        return ['success' => true, 'message' => 'เปลี่ยนรหัสผ่านสำเร็จเรียบร้อย'];
    }
    
    return ['success' => false, 'message' => 'ไม่สามารถบันทึกรหัสผ่านใหม่ได้'];
}
