<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
    exit;
}

$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

if (!$data) {
    $data = $_POST;
}

// 0.1 ป้องกันบอทสแปมด้วย Honeypot Field
if (!empty($data['website_hp'])) {
    // ตอบกลับว่าสำเร็จแบบเงียบๆ หลอกบอท โดยไม่บันทึกและไม่ส่ง LINE
    echo json_encode(['success' => true, 'message' => 'บันทึกข้อมูลเรียบร้อยแล้ว']);
    exit;
}

// 0.2 ป้องกันการส่งสแปมรัวๆ (Rate Limiting 5 ครั้งต่อ 10 นาที ต่อ IP)
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rateLimitFile = __DIR__ . '/data/.tour_rate_limit.json';
$now = time();
$window = 600; // 10 minutes
$maxAttempts = 5;

$rateData = file_exists($rateLimitFile) ? json_decode(file_get_contents($rateLimitFile), true) : [];
if (!is_array($rateData)) $rateData = [];

// ล้างข้อมูลไอพีที่หมดอายุ
foreach ($rateData as $k => $timestamps) {
    $rateData[$k] = array_filter($timestamps, function($t) use ($now, $window) {
        return ($now - $t) < $window;
    });
    if (empty($rateData[$k])) unset($rateData[$k]);
}

if (isset($rateData[$ip]) && count($rateData[$ip]) >= $maxAttempts) {
    http_response_code(429);
    echo json_encode(['success' => false, 'error' => 'มีการส่งคำขอบ่อยเกินไป กรุณารอสักครู่ (10 นาที) หรือติดต่อทางโทรศัพท์']);
    exit;
}

// 0.3 ตรวจสอบและทำความสะอาดข้อมูล (Input Sanitization & Length Limits)
$parentName   = htmlspecialchars(strip_tags(mb_substr(trim($data['parent_name'] ?? ''), 0, 100)));
$phone        = htmlspecialchars(strip_tags(mb_substr(trim($data['phone'] ?? ''), 0, 30)));
$lineId       = htmlspecialchars(strip_tags(mb_substr(trim($data['line_id'] ?? ''), 0, 60)));
$targetGrade  = htmlspecialchars(strip_tags(mb_substr(trim($data['target_grade'] ?? ''), 0, 50)));
$studentName  = htmlspecialchars(strip_tags(mb_substr(trim($data['student_name'] ?? ''), 0, 100)));
$visitDate    = htmlspecialchars(strip_tags(mb_substr(trim($data['visit_date'] ?? ''), 0, 20)));
$visitTime    = htmlspecialchars(strip_tags(mb_substr(trim($data['visit_time'] ?? ''), 0, 30)));
$notes        = htmlspecialchars(strip_tags(mb_substr(trim($data['notes'] ?? ''), 0, 500)));

// ตรวจสอบเบอร์โทรอย่างน้อย 9 หลัก
if (strlen(preg_replace('/[^0-9]/', '', $phone)) < 9) {
    echo json_encode(['success' => false, 'error' => 'กรุณากรอกเบอร์โทรศัพท์ที่ถูกต้อง (อย่างน้อย 9-10 หลัก)']);
    exit;
}

// บันทึกเวลาสำหรับ Rate Limit
$rateData[$ip][] = $now;
@file_put_contents($rateLimitFile, json_encode($rateData));

// 0.4 ตรวจสอบสถานะการเปิด/ปิดรับนัดหมายจาก Site Settings
$settingsFile = __DIR__ . '/data/db_site_settings.json';
if (file_exists($settingsFile)) {
    $settings = json_decode(file_get_contents($settingsFile), true);
    if (isset($settings['tour_booking']['enabled']) && $settings['tour_booking']['enabled'] === false) {
        $closedMsg = !empty($settings['tour_booking']['closed_msg_th']) 
            ? $settings['tour_booking']['closed_msg_th'] 
            : 'ระบบนัดหมายเข้าชมโครงการปิดรับชั่วคราว กรุณาติดต่อสำนักงานโดยตรง';
        echo json_encode(['success' => false, 'error' => $closedMsg]);
        exit;
    }
}

if (empty($parentName) || empty($phone) || empty($targetGrade) || empty($visitDate)) {
    echo json_encode(['success' => false, 'error' => 'กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน (ชื่อ, เบอร์โทร, ระดับชั้น, วันที่นัดหมาย)']);
    exit;
}

// 1. Save to JSON database
$dbFile = __DIR__ . '/data/db_tour_bookings.json';
$bookings = [];

if (file_exists($dbFile)) {
    $existing = json_decode(file_get_contents($dbFile), true);
    if (is_array($existing)) {
        $bookings = $existing;
    }
}

$newBooking = [
    'id'           => 'tour_' . time() . '_' . rand(100, 999),
    'created_at'   => date('Y-m-d H:i:s'),
    'parent_name'  => $parentName,
    'phone'        => $phone,
    'line_id'      => $lineId,
    'target_grade' => $targetGrade,
    'student_name' => $studentName,
    'visit_date'   => $visitDate,
    'visit_time'   => $visitTime,
    'notes'        => $notes,
    'status'       => 'PENDING'
];

array_unshift($bookings, $newBooking);
file_put_contents($dbFile, json_encode($bookings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// 2. Load Settings for LINE notification
$settingsFile = __DIR__ . '/data/db_site_settings.json';
$lineToken = getenv('LINE_CHANNEL_ACCESS_TOKEN');
$lineTarget = getenv('LINE_TARGET_ID');

if (file_exists($settingsFile)) {
    $settings = json_decode(file_get_contents($settingsFile), true);
    if (!empty($settings['notifications']['line_token'])) {
        $lineToken = $settings['notifications']['line_token'];
    }
    if (!empty($settings['notifications']['line_target'])) {
        $lineTarget = $settings['notifications']['line_target'];
    }
}

// 3. Send LINE Flex Message if configured
$lineSent = false;
if (!empty($lineToken) && !empty($lineTarget)) {
    $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
    $callUri = "tel:" . $cleanPhone;
    $lineChatUri = !empty($lineId) ? "https://line.me/R/ti/p/~" . urlencode($lineId) : $callUri;

    $flexMessage = [
        "type" => "flex",
        "altText" => "🏛️ นัดหมายเยี่ยมชมโรงเรียนใหม่: " . $parentName . " (" . $targetGrade . ")",
        "contents" => [
            "type" => "bubble",
            "size" => "mega",
            "header" => [
                "type" => "box",
                "layout" => "vertical",
                "backgroundColor" => "#0f172a",
                "paddingAll" => "20px",
                "contents" => [
                    [
                        "type" => "text",
                        "text" => "🏛️ คำขอนัดหมายเยี่ยมชมตึก EP",
                        "weight" => "bold",
                        "color" => "#38bdf8",
                        "size" => "sm"
                    ],
                    [
                        "type" => "text",
                        "text" => "Campus Tour Request",
                        "weight" => "bold",
                        "color" => "#ffffff",
                        "size" => "xl",
                        "margin" => "xs"
                    ]
                ]
            ],
            "body" => [
                "type" => "box",
                "layout" => "vertical",
                "paddingAll" => "20px",
                "contents" => [
                    [
                        "type" => "box",
                        "layout" => "vertical",
                        "margin" => "md",
                        "spacing" => "sm",
                        "contents" => [
                            [
                                "type" => "box",
                                "layout" => "baseline",
                                "spacing" => "sm",
                                "contents" => [
                                    ["type" => "text", "text" => "ผู้ปกครอง:", "color" => "#64748b", "size" => "sm", "flex" => 3],
                                    ["type" => "text", "text" => $parentName, "wrap" => true, "color" => "#0f172a", "size" => "sm", "flex" => 5, "weight" => "bold"]
                                ]
                            ],
                            [
                                "type" => "box",
                                "layout" => "baseline",
                                "spacing" => "sm",
                                "contents" => [
                                    ["type" => "text", "text" => "เบอร์โทร:", "color" => "#64748b", "size" => "sm", "flex" => 3],
                                    ["type" => "text", "text" => $phone, "wrap" => true, "color" => "#0284c7", "size" => "sm", "flex" => 5, "weight" => "bold"]
                                ]
                            ],
                            [
                                "type" => "box",
                                "layout" => "baseline",
                                "spacing" => "sm",
                                "contents" => [
                                    ["type" => "text", "text" => "ระดับชั้น:", "color" => "#64748b", "size" => "sm", "flex" => 3],
                                    ["type" => "text", "text" => $targetGrade, "wrap" => true, "color" => "#0f172a", "size" => "sm", "flex" => 5]
                                ]
                            ],
                            [
                                "type" => "box",
                                "layout" => "baseline",
                                "spacing" => "sm",
                                "contents" => [
                                    ["type" => "text", "text" => "วัน-เวลา:", "color" => "#64748b", "size" => "sm", "flex" => 3],
                                    ["type" => "text", "text" => $visitDate . " (" . $visitTime . ")", "wrap" => true, "color" => "#047857", "size" => "sm", "flex" => 5, "weight" => "bold"]
                                ]
                            ],
                            [
                                "type" => "box",
                                "layout" => "baseline",
                                "spacing" => "sm",
                                "contents" => [
                                    ["type" => "text", "text" => "สิ่งที่สนใจ:", "color" => "#64748b", "size" => "sm", "flex" => 3],
                                    ["type" => "text", "text" => !empty($notes) ? $notes : "-", "wrap" => true, "color" => "#334155", "size" => "xs", "flex" => 5]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            "footer" => [
                "type" => "box",
                "layout" => "vertical",
                "spacing" => "sm",
                "contents" => [
                    [
                        "type" => "button",
                        "style" => "primary",
                        "color" => "#0284c7",
                        "height" => "sm",
                        "action" => [
                            "type" => "uri",
                            "label" => "📞 โทรหาผู้ปกครองทันที",
                            "uri" => $callUri
                        ]
                    ],
                    [
                        "type" => "button",
                        "style" => "secondary",
                        "height" => "sm",
                        "action" => [
                            "type" => "uri",
                            "label" => "💬 ทัก LINE ผู้ปกครอง",
                            "uri" => $lineChatUri
                        ]
                    ]
                ]
            ]
        ]
    ];

    $payload = [
        "to" => $lineTarget,
        "messages" => [$flexMessage]
    ];

    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $lineToken
            ],
            'content' => json_encode($payload),
            'timeout' => 10,
            'ignore_errors' => true
        ]
    ];

    $context = stream_context_create($options);
    $response = @file_get_contents('https://api.line.me/v2/bot/message/push', false, $context);
    
    if ($response !== false) {
        $resData = json_decode($response, true);
        if (empty($resData['message'])) {
            $lineSent = true;
        } else {
            error_log('LINE API Response: ' . $response);
        }
    }
}

echo json_encode([
    'success'  => true,
    'message'  => 'บันทึกคำขอนัดหมายเรียบร้อยแล้ว เจ้าหน้าที่จะติดต่อกลับเพื่อยืนยันเวลานัดหมาย',
    'id'       => $newBooking['id'],
    'lineSent' => $lineSent
]);
