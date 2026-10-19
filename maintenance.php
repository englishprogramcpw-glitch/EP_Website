<?php
// maintenance.php - หน้าจอแจ้งปิดปรับปรุงเว็บไซต์สำหรับบุคคลภายนอก
if (!defined('EP_SECURE_AUTH')) {
    define('EP_SECURE_AUTH', true);
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?php echo $titleTh ?? 'เว็บไซต์โครงการฯ ภาคภาษาอังกฤษ อยู่ระหว่างการปรับปรุงข้อมูล'; ?> | EP CPW</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sarabun:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Sarabun', 'Inter', sans-serif; }
        .font-english { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col items-center justify-center p-4 selection:bg-pink-500 selection:text-white relative overflow-x-hidden">
    
    <!-- Background Ambient Glow -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-2xl bg-slate-900/90 border border-slate-800 rounded-3xl p-6 sm:p-10 shadow-2xl backdrop-blur-xl relative z-10 text-center space-y-8">
        
        <!-- Header & Logo -->
        <div class="flex flex-col items-center space-y-4">
            <div class="relative">
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-blue-700 via-indigo-600 to-purple-600 flex items-center justify-center text-white font-black text-3xl font-english shadow-xl shadow-indigo-600/30">
                    EP
                </div>
                <div class="absolute -bottom-2 -right-2 w-8 h-8 rounded-full bg-amber-500 text-slate-950 flex items-center justify-center text-base shadow-md font-bold">
                    🚧
                </div>
            </div>

            <div class="space-y-1.5">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-500/10 text-amber-400 border border-amber-500/30">
                    ระบบอยู่ระหว่างการจัดเตรียมข้อมูล • Under Preparation
                </span>
                <h1 class="text-xl sm:text-2xl font-black text-white tracking-wide">
                    <?php echo $titleTh ?? 'เว็บไซต์โครงการฯ ภาคภาษาอังกฤษ อยู่ระหว่างการปรับปรุงข้อมูล'; ?>
                </h1>
                <p class="text-xs sm:text-sm text-slate-400 font-medium">
                    <?php echo $titleEn ?? 'English Program Website Under Maintenance'; ?>
                </p>
            </div>
        </div>

        <!-- Description Box -->
        <div class="bg-slate-950/60 border border-slate-800/80 rounded-2xl p-5 text-left space-y-3">
            <div class="flex items-start gap-3">
                <span class="text-xl mt-0.5">📢</span>
                <div class="space-y-2 text-xs sm:text-sm text-slate-300 leading-relaxed">
                    <p>
                        <?php echo $messageTh ?? 'ขณะนี้เว็บไซต์อยู่ระหว่างการจัดเตรียมและตรวจทานความถูกต้องของข้อมูลตามมาตรฐานของโรงเรียนชลประทานวิทยา เพื่อให้ข้อมูลมีความถูกต้องและสมบูรณ์ที่สุดก่อนเปิดให้บริการ ขออภัยในความไม่สะดวก'; ?>
                    </p>
                    <p class="text-xs text-slate-400 italic">
                        <?php echo $messageEn ?? 'Our website is currently undergoing content preparation and verification according to school standards. We apologize for any inconvenience.'; ?>
                    </p>
                </div>
            </div>
            
            <div class="pt-3 border-t border-slate-800/80 text-[11px] text-slate-500 text-center">
                โครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ โรงเรียนชลประทานวิทยา<br>
                <span class="text-indigo-400 font-semibold">"น้อมนำความเป็นไทย ใส่ใจวิชาการ เชี่ยวชาญสู่สากล"</span>
            </div>
        </div>

        <!-- Official Contacts -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-left">
            <div class="bg-slate-950/40 border border-slate-800/60 rounded-xl p-3.5 space-y-1">
                <span class="text-xs text-slate-500 font-bold block">📞 ติดต่อสอบถาม</span>
                <a href="tel:025835444" class="text-xs font-semibold text-white hover:text-blue-400 transition">02-583-5444</a>
            </div>
            <div class="bg-slate-950/40 border border-slate-800/60 rounded-xl p-3.5 space-y-1">
                <span class="text-xs text-slate-500 font-bold block">✉️ อีเมลโครงการ</span>
                <a href="mailto:englishprogram@cpw.ac.th" class="text-xs font-semibold text-white hover:text-blue-400 transition truncate block" title="englishprogram@cpw.ac.th">englishprogram@cpw.ac.th</a>
            </div>
            <div class="bg-slate-950/40 border border-slate-800/60 rounded-xl p-3.5 space-y-1">
                <span class="text-xs text-slate-500 font-bold block">🌐 Facebook เพจ</span>
                <a href="https://www.facebook.com/profile.php?id=100093686707861" target="_blank" class="text-xs font-semibold text-white hover:text-blue-400 transition truncate block">EP CPW Facebook</a>
            </div>
        </div>

        <!-- Staff Entry Link -->
        <div class="pt-4 border-t border-slate-800/60 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-2">
            <span>© 2026 English Program, Chonprathan Wittaya School.</span>
            <a href="admin.php" class="text-slate-400 hover:text-white transition flex items-center gap-1.5 opacity-70 hover:opacity-100">
                <span>🔒</span>
                <span>สำหรับเจ้าหน้าที่โครงการ EP</span>
            </a>
        </div>

    </div>

</body>
</html>
