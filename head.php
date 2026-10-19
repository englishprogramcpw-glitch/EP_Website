<?php
// ป้องกันการรั่วไหลของข้อมูลข้อผิดพลาด (Information Leakage) ไปยังหน้าจอเบราว์เซอร์ของผู้ใช้
ini_set('display_errors', '0');

require_once __DIR__ . '/maintenance_guard.php';
check_maintenance_mode();

// 1. เริ่ม Session และสร้าง CSRF Token สำหรับป้องกันการโจมตีข้ามโดเมน (CSRF)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// 2. ส่ง HTTP Security Headers เพื่อความปลอดภัยสูงสุด (HSTS, nosniff, frame protection, referrer policy)
header("Strict-Transport-Security: max-age=63072000; includeSubDomains", true);
header("X-Content-Type-Options: nosniff", true);
header("X-Frame-Options: SAMEORIGIN", true);
header("Referrer-Policy: strict-origin-when-cross-origin", true);

// กำหนดหัวข้อหน้าเว็บถ้าไม่มีการส่งมา
if (!isset($pageTitle)) {
    $pageTitle = "English Program (EP) CPW";
}
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>

    <?php if (defined('EP_ADMIN_PREVIEWING_MAINTENANCE')): ?>
    <meta name="robots" content="noindex, nofollow">
    <div class="bg-amber-500 text-slate-950 font-bold text-xs py-2 px-4 text-center sticky top-0 z-50 flex items-center justify-center gap-2 shadow-md">
        <span>🚧</span>
        <span>โหมดปิดปรับปรุงกำลังเปิดใช้งาน (บุคคลภายนอกจะเห็นหน้าแจ้งปิดปรับปรุง ไม่สามารถดูข้อมูลหน้านี้ได้)</span>
        <a href="admin.php" class="underline ml-2 bg-slate-950 text-white px-2.5 py-0.5 rounded-lg text-[11px] hover:bg-slate-800 transition">⚙️ ไปที่แผงควบคุมหลังบ้าน</a>
    </div>
    <?php endif; ?>

    <!-- CSRF Token สำหรับเรียกใช้ในการเซฟข้อมูล -->
    <script>
        window.csrfToken = "<?php echo $_SESSION['csrf_token']; ?>";
        // ดักจับการเรียกใช้ fetch เพื่อส่ง CSRF Token ไปใน Header ของคำขอแบบ AJAX โดยอัตโนมัติ
        (function() {
            const originalFetch = window.fetch;
            window.fetch = function(input, init) {
                if (typeof input === 'string' && (input.includes('save_data.php') || input.includes('save_inline.php') || input.includes('auth_action.php'))) {
                    init = init || {};
                    init.headers = init.headers || {};
                    init.headers['X-CSRF-Token'] = window.csrfToken;
                }
                return originalFetch(input, init);
            };
        })();
    </script>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Sarabun & Inter -->
    <link rel="stylesheet" href="css/typography.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Sarabun:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="js/main.js"></script>
    <script src="js/editor.js" defer></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Sarabun', 'Inter', 'sans-serif'],
                        english: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f5f3ff', // Light Purple (Card backgrounds or button hover)
                            100: '#ede9fe',
                            500: '#1e3a8a', // School Navy Blue (Primary Blue)
                            600: '#1e40af', // Mid Blue
                            700: '#1d4ed8', // Royal Blue
                            secondary: '#7c3aed', // EP Purple (Pink + Blue)
                            accent: '#db2777', // School Pink (Highlight Pink)
                            gold: '#db2777', // Replace gold highlight with School Pink
                        }
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --ease-out-craft: cubic-bezier(0.23, 1, 0.32, 1);
            --ease-in-out-craft: cubic-bezier(0.77, 0, 0.175, 1);
        }

        html { scroll-behavior: smooth; font-size: 17px; -webkit-text-size-adjust: 100%; }

        /* Bilingual Typography & Word Breaking (Thai & English) */
        body, p, span, div, td, th, li, a, label, dd, dt {
            word-break: normal !important;
            line-break: normal !important;
            overflow-wrap: break-word !important;
            text-wrap: pretty;
        }

        h1, h2, h3, h4, h5, h6, .text-balance, .hero-title {
            text-wrap: balance !important;
            word-break: normal !important;
            line-break: normal !important;
            hyphens: none !important;
        }

        .lang-en, [lang="en"], .font-english {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            word-break: normal !important;
            overflow-wrap: break-word !important;
            hyphens: manual;
        }

        .lang-th, [lang="th"], html[lang="th"] {
            font-family: 'Sarabun', -apple-system, BlinkMacSystemFont, sans-serif;
            word-break: normal !important;
            line-break: normal !important;
            hyphens: none !important;
        }

        .medal-badge, .badge, th, .btn-print-sar, #yearTabsNav button, 
        .view-switcher button, .whitespace-nowrap, .room-badge {
            word-break: keep-all !important;
            white-space: nowrap !important;
        }

        .thai-prefix, .name-prefix {
            display: inline-block;
            white-space: nowrap !important;
        }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        .dark ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }

        /* SISB-style Navigation Effects */
        .nav-link-sisb {
            position: relative;
            transition: color 0.2s var(--ease-out-craft);
        }
        .nav-link-sisb::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #db2777; /* School Pink Accent */
            transition: width 0.2s var(--ease-out-craft);
        }
        .nav-link-sisb:hover::after, .nav-link-sisb.active::after {
            width: 100%;
        }

        /* SISB-style Card Hover effects */
        .card-hover-sisb {
            transition: all 0.3s var(--ease-out-craft);
        }
        .card-hover-sisb:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px -10px rgba(124, 58, 237, 0.15); /* Purple shadow */
            border-color: rgba(219, 39, 119, 0.3); /* School Pink border */
        }

        /* Override Hero Slide transitions with custom ease-out and optimized timing */
        .hero-slide {
            transition: opacity 500ms var(--ease-out-craft) !important;
        }
    </style>
