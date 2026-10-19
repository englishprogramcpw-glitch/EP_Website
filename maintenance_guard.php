<?php
/**
 * maintenance_guard.php - ระบบตรวจสอบและปิดกั้นการเข้าถึงสาธารณะเมื่อเปิดโหมดปิดปรับปรุง
 * โครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ โรงเรียนชลประทานวิทยา
 */

require_once __DIR__ . '/auth.php';

function get_maintenance_config() {
    $file = __DIR__ . '/data/maintenance_config.json';
    if (!file_exists($file)) {
        return [
            'enabled' => false,
            'redirect_to_facebook' => true,
            'facebook_url' => 'https://www.facebook.com/profile.php?id=100093686707861',
            'title_th' => 'เว็บไซต์โครงการฯ ภาคภาษาอังกฤษ อยู่ระหว่างการปรับปรุงข้อมูล',
            'title_en' => 'English Program Website Under Maintenance',
            'message_th' => 'ขณะนี้เว็บไซต์อยู่ระหว่างการจัดเตรียมและตรวจทานความถูกต้องของข้อมูลตามมาตรฐานของโรงเรียนชลประทานวิทยา ขออภัยในความไม่สะดวก',
            'message_en' => 'Our website is currently undergoing content preparation and verification. We apologize for any inconvenience.',
            'allow_admin' => true,
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }
    $content = file_get_contents($file);
    $data = json_decode($content, true);
    return is_array($data) ? $data : ['enabled' => false];
}

function save_maintenance_config(array $config) {
    $file = __DIR__ . '/data/maintenance_config.json';
    $config['updated_at'] = date('Y-m-d H:i:s');
    return file_put_contents($file, json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX) !== false;
}

function check_maintenance_mode() {
    $scriptName = basename($_SERVER['SCRIPT_NAME'] ?? '');
    // หน้าและ API ที่อนุญาตให้ทำงานได้เสมอเพื่อการจัดการระบบ
    $bypassPages = [
        'admin.php', 
        'auth.php', 
        'auth_action.php', 
        'save_data.php', 
        'save_inline.php', 
        'run_sync.php', 
        'run_sync_news.php', 
        'run_sync_settings.php'
    ];
    
    if (in_array($scriptName, $bypassPages)) {
        return;
    }

    $config = get_maintenance_config();
    if (empty($config['enabled'])) {
        return; // เว็บไซต์เปิดใช้งานสาธารณะตามปกติ
    }

    // หากเป็นผู้ดูแลระบบที่ล็อกอินแล้ว อนุญาตให้เข้าชมหน้าเว็บจริงเพื่อตรวจทานเนื้อหาได้
    if (is_admin_logged_in()) {
        if (!defined('EP_ADMIN_PREVIEWING_MAINTENANCE')) {
            define('EP_ADMIN_PREVIEWING_MAINTENANCE', true);
        }
        return;
    }

    // สำหรับบุคคลภายนอก: ตรวจสอบว่าให้ส่งต่อไปยัง Facebook โดยตรงหรือไม่
    $redirectFb = !isset($config['redirect_to_facebook']) || $config['redirect_to_facebook'] !== false;
    $fbUrl = $config['facebook_url'] ?? 'https://www.facebook.com/profile.php?id=100093686707861';

    if ($redirectFb) {
        // ดีดคนทั่วไปส่งต่อไปยังหน้า Facebook Page เดิมทันที
        header('Location: ' . $fbUrl, true, 302);
        exit;
    }

    // หากไม่ส่งไป Facebook ให้แสดงหน้าแจ้งปิดปรับปรุงพร้อม HTTP 503
    http_response_code(503);
    header('Retry-After: 3600');
    header('X-Robots-Tag: noindex, nofollow', true);

    $titleTh = htmlspecialchars($config['title_th'] ?? 'เว็บไซต์โครงการฯ ภาคภาษาอังกฤษ อยู่ระหว่างการปรับปรุงข้อมูล', ENT_QUOTES, 'UTF-8');
    $titleEn = htmlspecialchars($config['title_en'] ?? 'English Program Website Under Maintenance', ENT_QUOTES, 'UTF-8');
    $messageTh = nl2br(htmlspecialchars($config['message_th'] ?? 'ขณะนี้เว็บไซต์อยู่ระหว่างการจัดเตรียมและตรวจทานความถูกต้องของข้อมูล', ENT_QUOTES, 'UTF-8'));
    $messageEn = nl2br(htmlspecialchars($config['message_en'] ?? 'Website is currently undergoing content preparation and verification.', ENT_QUOTES, 'UTF-8'));

    include __DIR__ . '/maintenance.php';
    exit;
}
