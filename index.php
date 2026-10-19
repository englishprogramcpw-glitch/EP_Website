<?php
$pageTitle = "English Program (EP) | Chonprathanwittaya School";
$currentPage = "index";
$settings = [];
if (file_exists('data/db_site_settings.json')) {
    $settings = json_decode(file_get_contents('data/db_site_settings.json'), true) ?: [];
}
$pageMedia = $settings['page_media'] ?? [];
$homePrimaryImg = !empty($pageMedia['home_primary_img']) ? $pageMedia['home_primary_img'] : 'img/ep_classroom_p1.jpg';
$homeJuniorImg = !empty($pageMedia['home_junior_img']) ? $pageMedia['home_junior_img'] : 'img/ep_camp_activity.jpg';
$homeSeniorImg = !empty($pageMedia['home_senior_img']) ? $pageMedia['home_senior_img'] : 'https://app.cpw.ac.th/cpw_api_content/images/activities/3202606231647351449664451.JPG';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <?php include 'head.php'; ?>
    <!-- นำเข้าไฟล์ข่าวสารประกาศและระบบงานแชร์ส่วนกลาง -->
    <script src="js/news.js"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans transition-colors duration-300 dark:bg-slate-900 dark:text-slate-100 min-h-screen flex flex-col">

    <?php include 'header.php'; ?>

    <!-- HERO SLIDER BANNER (N°21 Full Width Hero Layout) -->
    <section id="home" class="relative bg-slate-950 text-white overflow-hidden h-[540px] sm:h-[600px] flex items-center justify-center">
        <!-- Slides Wrapper -->
        <div id="hero-slides-container" class="absolute inset-0 w-full h-full">
            <!-- Slide 1 (Fallback / Init State) -->
            <div class="hero-slide absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out opacity-100 bg-cover bg-center" style="background-image: url('img/ep_cover_banner.jpg');">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/45 to-slate-950/30"></div>
                <div class="absolute inset-0 flex items-center justify-center px-4">
                    <div class="max-w-4xl mx-auto text-center space-y-6">
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-blue-500/25 border border-blue-400/40 text-blue-200 text-xs font-bold font-english uppercase tracking-wider shadow-sm">
                            <span class="lang-th">🎉 กำลังเปิดลงทะเบียน: เยี่ยมชมโครงการ (Campus Tour 2026)</span>
                            <span class="lang-en hidden">🎉 Registration Open: EP Campus Tour 2026</span>
                        </span>
                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black tracking-tight leading-[1.25] sm:leading-[1.2] drop-shadow-md [text-wrap:balance] max-w-3xl mx-auto">
                            <span class="lang-th">ก้าวสู่อนาคตที่เหนือกว่า ด้วยการเรียนรู้สองภาษา</span>
                            <span class="lang-en hidden">Step into a Better Future with Bilingual Learning</span>
                        </h1>
                        <p class="text-sm sm:text-base md:text-lg text-slate-100 max-w-2xl mx-auto font-normal leading-relaxed drop-shadow [text-wrap:pretty]">
                            <span class="lang-th">โครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ โรงเรียนชลประทานวิทยา มุ่งพัฒนาศักยภาพผู้เรียนสู่ระดับสากล</span>
                            <span class="lang-en hidden">Chonprathanwittaya School English Program fosters academic excellence and practical English skills to prepare students for global success.</span>
                        </p>
                        <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                            <a href="tour.php" class="px-6 py-3.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold shadow-lg shadow-brand-500/30 hover:scale-105 active:scale-95 transition-all duration-200 flex items-center gap-2">
                                <span>🚐</span>
                                <span class="lang-th">นัดหมายเข้าชมโครงการ</span>
                                <span class="lang-en hidden">Book Campus Tour</span>
                            </a>
                            <a href="curriculum.php" class="px-6 py-3.5 rounded-xl bg-slate-900/80 hover:bg-slate-800 text-white border border-white/20 font-bold backdrop-blur-sm hover:scale-105 active:scale-95 transition-all duration-200 flex items-center gap-2">
                                <span>📖</span>
                                <span class="lang-th">ดูโครงสร้างหลักสูตร</span>
                                <span class="lang-en hidden">View Curriculum</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider Navigation Controls -->
        <!-- Left Arrow -->
        <button onclick="prevSlide()" class="absolute left-6 z-20 w-12 h-12 rounded-full bg-slate-900/40 hover:bg-slate-900/60 border border-white/10 flex items-center justify-center text-white transition hover:scale-105 active:scale-95" aria-label="Previous Slide">
            &#10094;
        </button>
        <!-- Right Arrow -->
        <button onclick="nextSlide()" class="absolute right-6 z-20 w-12 h-12 rounded-full bg-slate-900/40 hover:bg-slate-900/60 border border-white/10 flex items-center justify-center text-white transition hover:scale-105 active:scale-95" aria-label="Next Slide">
            &#10095;
        </button>

        <!-- Slider Dots Indicator -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-2">
            <button onclick="goToSlide(0)" class="hero-dot w-2.5 h-2.5 rounded-full bg-white transition" aria-label="Go to slide 1"></button>
            <button onclick="goToSlide(1)" class="hero-dot w-2.5 h-2.5 rounded-full bg-white/40 transition" aria-label="Go to slide 2"></button>
            <button onclick="goToSlide(2)" class="hero-dot w-2.5 h-2.5 rounded-full bg-white/40 transition" aria-label="Go to slide 3"></button>
        </div>
    </section>

    <!-- MAIN CONTENT AREA (N°17 Landing Page Sections Layout) -->
    <main class="flex-grow max-w-[1400px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 space-y-24 sm:space-y-32">

        <!-- SECTION: CURRICULUM HIGHLIGHTS -->
        <section id="curriculum" class="scroll-mt-24 space-y-12">
            <div class="text-center max-w-2xl mx-auto space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-500/10 text-brand-500 dark:text-blue-400 font-bold text-xs">
                    <span class="lang-th">หลักสูตรเด่น</span>
                    <span class="lang-en hidden">Academic Programs</span>
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 dark:text-white tracking-tight leading-tight">
                    <span class="lang-th">โครงสร้างการเรียนการสอนโครงการฯ ภาคภาษาอังกฤษ</span>
                    <span class="lang-en hidden">Curriculum & Academic Structure</span>
                </h2>
                <p class="text-sm sm:text-base text-slate-500 dark:text-slate-400 font-light max-w-xl mx-auto">
                    <span class="lang-th">จัดการเรียนรู้สองภาษาอย่างเป็นระบบ ตั้งแต่ระดับประถมศึกษาถึงมัธยมศึกษาตอนปลาย</span>
                    <span class="lang-en hidden">Systematic bilingual education from Primary to Senior High School.</span>
                </p>
            </div>

            <!-- Cards Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Primary card -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-3xl overflow-hidden shadow-sm hover:shadow-md hover:border-slate-300 dark:hover:border-slate-700 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div data-edit-id="index_primary_card_img" class="h-48 w-full bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($homePrimaryImg); ?>');"></div>
                        <div class="p-6 sm:p-8 space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="text-xl">🏫</span>
                                <h3 class="font-bold text-slate-900 dark:text-white text-lg">
                                    <span class="lang-th">ระดับประถมศึกษา</span>
                                    <span class="lang-en hidden">Primary Education</span>
                                </h3>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                                <span class="lang-th" data-edit-id="index_primary_card_desc_th">เน้นการปรับตัวและเรียนรู้วิชาการขั้นต้นผ่านวิชาหลัก Mathematics, Science และ English บ่มเพาะพื้นฐานทางภาษาและระเบียบวินัยอย่างเป็นระบบ</span>
                                <span class="lang-en hidden" data-edit-id="index_primary_card_desc_en">Focuses on adjustment and foundational academic learning via core subjects (Mathematics, Science, and English) to systematically develop language skills.</span>
                            </p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-1 sm:px-8 sm:pb-8">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 text-xs font-bold font-english">
                            <span class="lang-th">ชั้น ป.1 - ป.6</span>
                            <span class="lang-en hidden">P.1 - P.6</span>
                        </span>
                    </div>
                </div>

                <!-- Junior card -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-3xl overflow-hidden shadow-sm hover:shadow-md hover:border-slate-300 dark:hover:border-slate-700 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div data-edit-id="index_junior_card_img" class="h-48 w-full bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($homeJuniorImg); ?>');"></div>
                        <div class="p-6 sm:p-8 space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="text-xl">📘</span>
                                <h3 class="font-bold text-slate-900 dark:text-white text-lg">
                                    <span class="lang-th">ระดับมัธยมศึกษาตอนต้น</span>
                                    <span class="lang-en hidden">Junior High School</span>
                                </h3>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                                <span class="lang-th" data-edit-id="index_junior_card_desc_th">เน้นการคิดวิเคราะห์ เวทีการแข่งขันวิชาการ บูรณาการสะเต็มศึกษาและการสื่อสารสองภาษาเพื่อเตรียมความพร้อมสู่ระดับสากล</span>
                                <span class="lang-en hidden" data-edit-id="index_junior_card_desc_en">Focuses on analysis, academic camps, STEM integration, and bilingual communication to prepare students for global readiness.</span>
                            </p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-1 sm:px-8 sm:pb-8">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-pink-50 dark:bg-pink-950/40 text-brand-accent dark:text-pink-400 text-xs font-bold font-english">
                            <span class="lang-th">ชั้น ม.1 - ม.3</span>
                            <span class="lang-en hidden">M.1 - M.3</span>
                        </span>
                    </div>
                </div>

                <!-- Senior card -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-3xl overflow-hidden shadow-sm hover:shadow-md hover:border-slate-300 dark:hover:border-slate-700 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div data-edit-id="index_senior_card_img" class="h-48 w-full bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($homeSeniorImg); ?>');"></div>
                        <div class="p-6 sm:p-8 space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="text-xl">📕</span>
                                <h3 class="font-bold text-slate-900 dark:text-white text-lg">
                                    <span class="lang-th">ระดับมัธยมศึกษาตอนปลาย</span>
                                    <span class="lang-en hidden">Senior High School</span>
                                </h3>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                                <span class="lang-th" data-edit-id="index_senior_card_desc_th">วิชาการเข้มข้น จัดการเรียนการสอนครอบคลุมทั้งวิทยาศาสตร์-คณิตศาสตร์ และคณิตศาสตร์-ภาษาอังกฤษ (เสริมภาษาจีนหรือญี่ปุ่น) มุ่งเตรียมความพร้อมสู่มหาวิทยาลัยชั้นนำและระดับสากล</span>
                                <span class="lang-en hidden" data-edit-id="index_senior_card_desc_en">Intensive academics featuring Science-Math and Math-English tracks (with Chinese/Japanese electives), preparing students for top universities and global readiness.</span>
                            </p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-1 sm:px-8 sm:pb-8">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 text-xs font-bold font-english">
                            <span class="lang-th">ชั้น ม.4 - ม.6</span>
                            <span class="lang-en hidden">M.4 - M.6</span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="text-center pt-4">
                <a href="curriculum.php" class="inline-flex items-center gap-1 text-sm font-bold text-brand-500 hover:text-brand-accent dark:text-blue-400 transition-colors">
                    <span class="lang-th">ดูรายละเอียดวิชาเรียนและโครงสร้างหลักสูตร <span>&rarr;</span></span>
                    <span class="lang-en hidden">View subject details and curriculum structures <span>&rarr;</span></span>
                </a>
            </div>
        </section>

        <!-- SECTION: GENERAL INFO & HISTORY -->
        <section id="about" class="scroll-mt-24 space-y-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Text Content -->
                <div class="space-y-6">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-500/10 text-brand-500 dark:text-blue-400 font-bold text-xs">
                        <span class="lang-th">ประวัติและวิสัยทัศน์</span>
                        <span class="lang-en hidden">History & Vision</span>
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 dark:text-white tracking-tight leading-tight">
                        <span class="lang-th" data-edit-id="index_about_heading_th">โครงการฯ ภาคภาษาอังกฤษ</span>
                        <span class="lang-en hidden" data-edit-id="index_about_heading_en">English Program (EP) Curriculum</span>
                    </h2>
                    <p class="text-slate-650 dark:text-slate-350 leading-relaxed text-sm sm:text-base font-light">
                        <span class="lang-th" data-edit-id="index_about_desc_th">โครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ (English Program : EP) โรงเรียนชลประทานวิทยา ส่งเสริมศักยภาพของผู้เรียนด้านการสื่อสารภาษาอังกฤษอย่างมีประสิทธิภาพ โดยเปิดทำการสอนครอบคลุม 3 ระดับชั้น คือประถมศึกษา (ตั้งแต่ปี 2559) มัธยมศึกษาตอนต้น (ตั้งแต่ปี 2561) และมัธยมศึกษาตอนปลาย (ตั้งแต่ปี 2563)</span>
                        <span class="lang-en hidden" data-edit-id="index_about_desc_en">Chonprathan Wittaya School English Program (EP) is an approved curriculum by the Ministry of Education that fosters learners' capability in English communication. Instruction spans across three levels: Primary (since 2016), Junior High (since 2018), and Senior High (since 2020).</span>
                    </p>
                    
                    <div class="border-l-4 border-brand-accent pl-5 py-2 space-y-1 bg-slate-50 dark:bg-slate-900/50 pr-4 rounded-r-xl">
                        <strong class="block font-bold text-xs sm:text-sm text-slate-900 dark:text-slate-200">
                            <span class="lang-th">🎯 วิสัยทัศน์โครงการ</span>
                            <span class="lang-en hidden">🎯 Project Vision</span>
                        </strong>
                        <span class="italic font-medium text-slate-700 dark:text-slate-300 text-sm">
                            <span class="lang-th" data-edit-id="index_about_vision_th">"น้อมนำความเป็นไทย ใส่ใจวิชาการ เชี่ยวชาญสู่สากล"</span>
                            <span class="lang-en hidden" data-edit-id="index_about_vision_en">"Thai Culture, Academic Excellence, Global Standard"</span>
                        </span>
                    </div>

                    <div class="pt-2">
                        <a href="about.php" class="inline-flex items-center gap-1 text-sm font-bold text-brand-500 hover:text-brand-accent dark:text-blue-400 transition-colors">
                            <span class="lang-th">อ่านประวัติและโครงสร้างบริหารทั้งหมด <span>&rarr;</span></span>
                            <span class="lang-en hidden">Read Full History & Executive Structure <span>&rarr;</span></span>
                        </a>
                    </div>
                </div>

                <!-- Graphic Showcase Box -->
                <div data-edit-id="index_about_box_bg" class="relative rounded-3xl p-8 sm:p-10 shadow-md overflow-hidden min-h-[360px] flex flex-col justify-end bg-cover bg-center" style="background-image: url('img/ep_cover_banner.jpg');">
                    <div class="absolute inset-0 bg-slate-950/75"></div>
                    <div class="relative z-10 space-y-4 text-white">
                        <span class="text-3xl block">🏫</span>
                        <h3 class="text-xl font-bold leading-snug">
                            <span class="lang-th" data-edit-id="index_about_box_heading_th">มุ่งพัฒนาคุณภาพสู่สากล</span>
                            <span class="lang-en hidden">Striving for Global Standards</span>
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-light">
                            <span class="lang-th" data-edit-id="index_about_box_desc_th">เราสร้างสรรค์สิ่งแวดล้อมให้เหมาะสมกับการเรียนรู้ภาษาอังกฤษอย่างเป็นธรรมชาติ เน้นการคิดวิเคราะห์ การทดลอง และบูรณาการสาระการเรียนรู้ที่จำเป็นสำหรับอนาคตของนักเรียนทุกคน</span>
                            <span class="lang-en hidden">We create a natural English learning environment focusing on analytical thinking, experimentation, and essential learning integrations for every student's future.</span>
                        </p>
                        <div class="text-[11px] font-semibold text-brand-accent font-english uppercase tracking-wider">
                             <span class="lang-th">โครงการฯ ภาคภาษาอังกฤษ โรงเรียนชลประทานวิทยา</span>
                             <span class="lang-en hidden">English Program, Chonprathan Wittaya School</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION: HALL OF FAME & STUDENT ACHIEVEMENTS SHOWCASE -->
        <section id="hall-of-fame" class="scroll-mt-24 space-y-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div class="space-y-3 max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400 font-bold text-xs uppercase tracking-wider">
                        🏆 Student Honors & Hall of Fame
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 dark:text-white tracking-tight leading-tight">
                        <span class="lang-th">หมุดหมายความสำเร็จและทำเนียบเกียรติยศ</span>
                        <span class="lang-en hidden">EP Hall of Fame & Student Achievements</span>
                    </h2>
                    <p class="text-slate-500 dark:text-slate-400 text-sm sm:text-base font-light leading-relaxed">
                        <span class="lang-th">ความภาคภูมิใจของลูกชลประทาน EP บนเวทีการแข่งขันระดับประเทศและระดับนานาชาติ สะท้อนความมุ่งมั่นสู่ความเป็นเลิศทั้งด้านวิชาการ ภาษา กีฬา และศิลปะ</span>
                        <span class="lang-en hidden">Celebrating outstanding competition honors earned by our English Program students across academic, language, athletic, and artistic arenas.</span>
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <a href="awards.php" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-brand-500 hover:bg-brand-600 text-white text-sm font-bold shadow-md hover:shadow-lg transition-all duration-200">
                        <span class="lang-th">ดูทำเนียบเกียรติยศทั้งหมด (Hall of Fame) ➔</span>
                        <span class="lang-en hidden">Explore Full Hall of Fame ➔</span>
                    </a>
                </div>
            </div>

            <!-- Impact Stat Counters -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm">
                    <div class="text-2xl sm:text-3xl font-black text-amber-500">250+</div>
                    <div class="text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1">
                        <span class="lang-th">รางวัลสะสม 3 ปีการศึกษา</span>
                        <span class="lang-en hidden">Total Multi-Year Awards</span>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm">
                    <div class="text-2xl sm:text-3xl font-black text-sky-500">27</div>
                    <div class="text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1">
                        <span class="lang-th">🌍 เวทีแข่งขันระดับนานาชาติ</span>
                        <span class="lang-en hidden">International Honors</span>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm">
                    <div class="text-2xl sm:text-3xl font-black text-blue-600 dark:text-blue-400">163</div>
                    <div class="text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1">
                        <span class="lang-th">🇹🇭 เวทีแข่งขันระดับประเทศ</span>
                        <span class="lang-en hidden">National Honors</span>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm">
                    <div class="text-2xl sm:text-3xl font-black text-emerald-500">45+</div>
                    <div class="text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1">
                        <span class="lang-th">🥇 เหรียญทอง & ชนะเลิศ</span>
                        <span class="lang-en hidden">Gold & Champions</span>
                    </div>
                </div>
            </div>

            <!-- Featured Champions Grid (4 Selected Top Honors) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1: AEON Japan -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all space-y-3 flex flex-col justify-between">
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-sky-50 text-sky-700 dark:bg-sky-950 dark:text-sky-300 border border-sky-200 dark:border-sky-800">
                                🌍 นานาชาติ
                            </span>
                            <span class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-brand-500 dark:text-blue-400 font-bold text-xs">
                                M.6/11
                            </span>
                        </div>
                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">
                            นางสาวณสุดา จำปาพันธ์
                        </h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2">
                            ตัวแทนประเทศไทย รายการ AEON Powered Youth Idea Contest 2026 ณ เมืองโอกินาวา ประเทศญี่ปุ่น
                        </p>
                    </div>
                    <div class="text-[11px] font-bold text-amber-600 dark:text-amber-400 pt-2 border-t border-slate-100 dark:border-slate-800">
                        🥇 ตัวแทนประเทศไทยสู่เวทีโลก
                    </div>
                </div>

                <!-- Card 2: IMGO Thailand -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all space-y-3 flex flex-col justify-between">
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-sky-50 text-sky-700 dark:bg-sky-950 dark:text-sky-300 border border-sky-200 dark:border-sky-800">
                                🌍 นานาชาติ
                            </span>
                            <span class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-brand-500 dark:text-blue-400 font-bold text-xs">
                                P.3/14
                            </span>
                        </div>
                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">
                            เด็กชายภาคิน ชินอุดมพร
                        </h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2">
                            การเเข่งขันอัจฉริยภาพคณิตศาสตร์โอลิมปิกนานาชาติ IMGO Thailand รุ่น Primary A
                        </p>
                    </div>
                    <div class="text-[11px] font-bold text-amber-600 dark:text-amber-400 pt-2 border-t border-slate-100 dark:border-slate-800">
                        🥇 เหรียญทองโอลิมปิกนานาชาติ
                    </div>
                </div>

                <!-- Card 3: Golf National -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all space-y-3 flex flex-col justify-between">
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-amber-50 text-amber-700 dark:bg-amber-950 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                                🇹🇭 ระดับประเทศ
                            </span>
                            <span class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-brand-500 dark:text-blue-400 font-bold text-xs">
                                P.4/15
                            </span>
                        </div>
                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">
                            เด็กหญิงวริศรา คูวุฒยานันท์
                        </h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2">
                            Chang Thailand Junior Golf Circuit 2026 สนามที่ 4 แรนโช ชาญวีร์ รีสอร์ต
                        </p>
                    </div>
                    <div class="text-[11px] font-bold text-amber-600 dark:text-amber-400 pt-2 border-t border-slate-100 dark:border-slate-800">
                        🥇 1 รางวัลชนะเลิศอันดับ 1
                    </div>
                </div>

                <!-- Card 4: Taekwondo Championship -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all space-y-3 flex flex-col justify-between">
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between">
                            <span class="px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-sky-50 text-sky-700 dark:bg-sky-950 dark:text-sky-300 border border-sky-200 dark:border-sky-800">
                                🌍 นานาชาติ
                            </span>
                            <span class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-brand-500 dark:text-blue-400 font-bold text-xs">
                                P.2/14
                            </span>
                        </div>
                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">
                            เด็กชายวายุพัฒน์ ขจรวงศ์วาณิช
                        </h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2">
                            The 9th Heroes Taekwondo International Championship 2026
                        </p>
                    </div>
                    <div class="text-[11px] font-bold text-amber-600 dark:text-amber-400 pt-2 border-t border-slate-100 dark:border-slate-800">
                        🥇 เหรียญทอง Poomsae & 🥈 เหรียญเงิน
                    </div>
                </div>
            </div>
        </section>

        <!-- BANNER: ADMISSIONS & FEES -->
        <section class="bg-slate-50 border border-slate-200/80 dark:bg-slate-900/20 dark:border-slate-800 rounded-3xl p-8 sm:p-10 relative overflow-hidden">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative z-10">
                <div class="space-y-2 max-w-3xl">
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-brand-accent/10 text-brand-accent text-xs font-bold font-english uppercase tracking-wider">
                        Admissions & Tuition Fees
                    </span>
                    <h3 class="text-2xl font-extrabold text-slate-950 dark:text-white leading-tight">
                        <span class="lang-th">อัตราค่าเล่าเรียนและรายละเอียดการรับสมัคร</span>
                        <span class="lang-en hidden">Admissions Details & Tuition Fees</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                        <span class="lang-th">ค่าเล่าเรียนเริ่มต้นที่ 37,000 บาท/ภาคเรียน (ระดับประถม) ไปจนถึง 42,000 บาท/ภาคเรียน (ระดับมัธยมปลาย) ดูรายละเอียดตารางค่าธรรมเนียมกิจกรรมและสิทธิพิเศษเพิ่มเติมได้ที่นี่</span>
                        <span class="lang-en hidden">Tuition fees start at 37,000 THB/semester (Primary) up to 42,000 THB/semester (Senior High). Click here to view activity fees and scholarship details.</span>
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 flex-shrink-0 w-full lg:w-auto">
                    <a href="fees.php" class="px-5 py-3 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold text-xs sm:text-sm text-center shadow-md transition duration-200">
                        <span class="lang-th">ตรวจสอบค่าเทอม</span>
                        <span class="lang-en hidden">Check Fees</span>
                    </a>
                    <a href="contact.php" class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-350 dark:bg-slate-850 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold text-xs sm:text-sm text-center transition duration-200">
                        <span class="lang-th">สอบถามการรับสมัคร</span>
                        <span class="lang-en hidden">Contact Admissions</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- SECTION: ADMINISTRATORS -->
        <section id="staff" class="scroll-mt-24 space-y-12">
            <div class="text-center max-w-2xl mx-auto space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-500/10 text-brand-500 dark:text-blue-400 font-bold text-xs">
                    <span class="lang-th">ฝ่ายบริหารโครงการ</span>
                    <span class="lang-en hidden">Administrators</span>
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 dark:text-white tracking-tight leading-tight">
                    <span class="lang-th">คณะผู้บริหารโครงการฯ ภาคภาษาอังกฤษ</span>
                    <span class="lang-en hidden">English Program Administrators</span>
                </h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm sm:text-base leading-relaxed max-w-xl mx-auto font-light">
                    <span class="lang-th">หัวหน้างานและที่ปรึกษาหลักสูตรภาษาอังกฤษที่คอยกำกับดูแลแผนการสอนและมาตรฐานวิชาการ</span>
                    <span class="lang-en hidden">Project heads and academic consultants supervising lesson planning, teaching methods, and curriculum quality.</span>
                </p>
            </div>

            <!-- Admins Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <!-- ADMIN 1 -->
                    <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-5 flex items-center gap-4 shadow-sm hover:shadow hover:border-slate-350 dark:hover:border-slate-700 transition-all duration-300">
                        <div class="relative w-16 h-16 rounded-xl overflow-hidden bg-gradient-to-b from-pink-50 to-purple-50 dark:from-pink-950/20 dark:to-purple-950/20 border border-pink-200 dark:border-purple-800 shadow-sm flex-shrink-0">
                            <img src="img/teachers/10997-2.png" class="w-full h-full object-cover rounded-xl" alt="Advisor" />
                        </div>
                        <div class="space-y-1 overflow-hidden">
                            <span class="inline-block text-[9px] px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-650 dark:text-slate-400 font-bold uppercase tracking-wider">Advisor</span>
                            <h4 class="font-extrabold text-slate-900 dark:text-white text-xs sm:text-sm truncate">
                                <span class="lang-th">นางพัชรา ทัศนวิจิตรวงศ์</span>
                                <span class="lang-en hidden">Mrs. Patchara Tassanavijitwong</span>
                            </h4>
                            <p class="text-[11px] text-slate-550 dark:text-slate-400 truncate leading-none">
                                <span class="lang-th">ที่ปรึกษาโครงการฯ ภาคภาษาอังกฤษ</span>
                                <span class="lang-en hidden">Advisor of English Program</span>
                            </p>
                        </div>
                    </div>    
                
                <!-- ADMIN 2 -->
                    <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-5 flex items-center gap-4 shadow-sm hover:shadow hover:border-slate-350 dark:hover:border-slate-700 transition-all duration-300">
                        <div class="relative w-16 h-16 rounded-xl overflow-hidden bg-gradient-to-b from-pink-50 to-purple-50 dark:from-pink-950/20 dark:to-purple-950/20 border border-pink-200 dark:border-purple-800 shadow-sm flex-shrink-0">
                            <img src="img/teachers/10158-2.png" class="w-full h-full object-cover rounded-xl" alt="Head" />
                        </div>
                        <div class="space-y-1 overflow-hidden">
                            <span class="inline-block text-[9px] px-2 py-0.5 rounded bg-brand-500/10 text-brand-500 font-bold uppercase tracking-wider">Project Head</span>
                            <h4 class="font-extrabold text-slate-900 dark:text-white text-xs sm:text-sm truncate">
                                <span class="lang-th">นางปรารถนา วิเศษสุภมิตร</span>
                                <span class="lang-en hidden">Mrs. Pratana Wisetsupamitr</span>
                            </h4>
                            <p class="text-[11px] text-slate-550 dark:text-slate-400 truncate leading-none">
                                <span class="lang-th">หัวหน้าโครงการฯ ภาคภาษาอังกฤษ</span>
                                <span class="lang-en hidden">Head of English Program</span>
                            </p>
                        </div>
                    </div>

                <!-- ADMIN 3 -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-2xl p-5 flex items-center gap-4 shadow-sm hover:shadow hover:border-slate-350 dark:hover:border-slate-700 transition-all duration-300">
                    <div class="relative w-16 h-16 rounded-xl overflow-hidden bg-gradient-to-b from-pink-50 to-purple-50 dark:from-pink-950/20 dark:to-purple-950/20 border border-pink-200 dark:border-purple-800 shadow-sm flex-shrink-0">
                        <img src="img/teachers/10092-2.png" class="w-full h-full object-cover rounded-xl" alt="Assistant Head" />
                    </div>
                    <div class="space-y-1 overflow-hidden">
                        <span class="inline-block text-[9px] px-2 py-0.5 rounded bg-pink-50 dark:bg-pink-950/30 text-brand-accent font-bold uppercase tracking-wider">Assistant Head</span>
                        <h4 class="font-extrabold text-slate-900 dark:text-white text-xs sm:text-sm truncate">
                            <span class="lang-th">นายปิยะวัตร ประทุมชาติ</span>
                            <span class="lang-en hidden">Mr. Piyawat Pratumchat</span>
                        </h4>
                        <p class="text-[11px] text-slate-550 dark:text-slate-400 truncate leading-none">
                            <span class="lang-th">ผู้ช่วยหัวหน้าโครงการฯ ภาคภาษาอังกฤษ</span>
                            <span class="lang-en hidden">Assistant Head of English Program</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center pt-4">
                <a href="staff.php" class="inline-flex items-center gap-1 text-sm font-bold text-brand-500 hover:text-brand-accent dark:text-blue-400 transition-colors">
                    <span class="lang-th">ดูรายชื่อคณะครูผู้สอนและครูต่างชาติทั้งหมด <span>&rarr;</span></span>
                    <span class="lang-en hidden">View all homeroom teachers and foreign instructors <span>&rarr;</span></span>
                </a>
            </div>
        </section>

        <!-- SECTION: ANNOUNCEMENTS & NEWS (Dynamic News Feed) -->
        <section id="announcements" class="scroll-mt-24 space-y-10">
            <div class="space-y-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-500/10 text-brand-500 dark:text-blue-400 font-bold text-xs">
                    <span class="lang-th">ข่าวสาร & ประกาศ</span>
                    <span class="lang-en hidden">News & Activities</span>
                </span>
                <h2 class="text-3xl font-extrabold text-slate-950 dark:text-white tracking-tight">
                    <span class="lang-th">ข่าวสารล่าสุดโครงการฯ ภาคภาษาอังกฤษ</span>
                    <span class="lang-en hidden">Latest News & Announcements</span>
                </h2>
            </div>
            
            <!-- Filters & Search Controls -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 border-b border-slate-200 dark:border-slate-800 pb-6">
                <!-- Category filters -->
                <div class="flex flex-wrap gap-2 text-xs sm:text-sm">
                    <button onclick="filterCategory('ทั้งหมด')" id="filter-all" class="px-4 py-2 rounded-xl font-bold bg-brand-500 text-white shadow-sm transition duration-200 focus:outline-none">
                        <span class="lang-th">ทั้งหมด</span>
                        <span class="lang-en hidden">All</span>
                    </button>
                    <button onclick="filterCategory('รับสมัครเรียน')" id="filter-admissions" class="px-4 py-2 rounded-xl font-bold bg-white text-slate-600 border border-slate-200 dark:bg-slate-900 dark:text-slate-350 dark:border-slate-800 transition duration-200 hover:bg-slate-50 dark:hover:bg-slate-800 focus:outline-none">
                        <span class="lang-th">รับสมัครเรียน</span>
                        <span class="lang-en hidden">Admissions</span>
                    </button>
                    <button onclick="filterCategory('ผลงานนักเรียน')" id="filter-awards" class="px-4 py-2 rounded-xl font-bold bg-white text-slate-600 border border-slate-200 dark:bg-slate-900 dark:text-slate-350 dark:border-slate-800 transition duration-200 hover:bg-slate-50 dark:hover:bg-slate-800 focus:outline-none">
                        <span class="lang-th">ผลงานนักเรียน</span>
                        <span class="lang-en hidden">Achievements</span>
                    </button>
                    <button onclick="filterCategory('กิจกรรม')" id="filter-activities" class="px-4 py-2 rounded-xl font-bold bg-white text-slate-600 border border-slate-200 dark:bg-slate-900 dark:text-slate-350 dark:border-slate-800 transition duration-200 hover:bg-slate-50 dark:hover:bg-slate-800 focus:outline-none">
                        <span class="lang-th">กิจกรรม</span>
                        <span class="lang-en hidden">Activities</span>
                    </button>
                </div>

                <!-- Interactive Search Controls -->
                <div class="flex items-center gap-2 w-full lg:w-80">
                    <div class="relative flex-grow">
                        <input type="text" id="news-search-input" oninput="handleSearchInput()" placeholder="ค้นหาประกาศ... / Search..." class="w-full pl-9 pr-4 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-xs sm:text-sm text-slate-850 dark:text-white transition duration-200 placeholder-slate-400 focus:outline-none">
                        <span class="absolute left-3 top-3 text-slate-400">🔍</span>
                    </div>
                    <button onclick="handleSearchInput()" class="px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white rounded-xl font-bold transition duration-200 text-xs sm:text-sm shadow-sm flex-shrink-0 focus:outline-none">
                        <span class="lang-th">ค้นหา</span>
                        <span class="lang-en hidden">Search</span>
                    </button>
                </div>
            </div>

            <!-- Loader Spinner -->
            <div id="news-loading" class="flex flex-col items-center justify-center py-16">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-brand-500 mb-3"></div>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    <span class="lang-th">กำลังโหลดข่าวประกาศล่าสุด...</span>
                    <span class="lang-en hidden">Loading latest announcements...</span>
                </p>
            </div>

            <!-- Search Results Layout List Container -->
            <div id="announcement-grid" class="space-y-3.5 hidden">
                <!-- Javascript will dynamically inject search results here -->
            </div>

            <!-- View All News Link -->
            <div class="text-center pt-4" id="view-all-news-container">
                <a href="news.php" class="inline-flex items-center gap-1.5 text-sm font-bold text-brand-500 hover:text-brand-accent dark:text-blue-400 transition-colors">
                    <span class="lang-th">ดูข่าวสารและประกาศทั้งหมด <span>&rarr;</span></span>
                    <span class="lang-en hidden">View all news & announcements <span>&rarr;</span></span>
                </a>
            </div>
        </section>

        <!-- SECTION: RECENT ACTIVITIES (Visual Gallery Grid) -->
        <section id="recent-activities" class="scroll-mt-24 space-y-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-slate-200 dark:border-slate-800 pb-5">
                <div class="space-y-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-500/10 text-brand-500 dark:text-blue-400 font-bold text-xs">
                        <span class="lang-th">ภาพกิจกรรมล่าสุด</span>
                        <span class="lang-en hidden">Recent Activity Gallery</span>
                    </span>
                    <h2 class="text-2xl font-extrabold text-slate-950 dark:text-white tracking-tight">
                        <span class="lang-th">บรรยากาศและกิจกรรมพัฒนาผู้เรียน EP</span>
                        <span class="lang-en hidden">EP Student Activities & Highlights</span>
                    </h2>
                </div>
                <div>
                    <a href="news.php?tab=activities" class="text-xs sm:text-sm font-bold text-brand-500 hover:text-brand-accent dark:text-blue-400 transition-colors flex items-center gap-1">
                        <span class="lang-th">ดูภาพกิจกรรมทั้งหมด <span>&rarr;</span></span>
                        <span class="lang-en hidden">View all activities <span>&rarr;</span></span>
                    </a>
                </div>
            </div>

            <!-- Loader Spinner for Activities -->
            <div id="activities-loading" class="flex flex-col items-center justify-center py-12">
                <div class="animate-spin rounded-full h-7 w-7 border-b-2 border-brand-500 mb-2.5"></div>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    <span class="lang-th">กำลังโหลดภาพกิจกรรม...</span>
                    <span class="lang-en hidden">Loading activities...</span>
                </p>
            </div>

            <!-- Activities Grid (3 Cards Highlight) -->
            <div id="activities-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 hidden">
                <!-- Javascript will dynamically inject 3 activity albums here -->
            </div>
        </section>

        <!-- SECTION: QUICK CONTACT (Condensed) -->
        <section id="contact-summary" class="scroll-mt-20 bg-slate-900 text-white rounded-3xl p-8 sm:p-12 relative overflow-hidden shadow-lg border border-slate-800">
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff04_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="space-y-4 max-w-xl">
                    <span class="text-3xl">📞</span>
                    <h3 class="text-2xl font-black">
                        <span class="lang-th">มีข้อสงสัยเพิ่มเติมเกี่ยวกับโครงการ?</span>
                        <span class="lang-en hidden">Have questions about the program?</span>
                    </h3>
                    <p class="text-slate-300 text-sm font-light leading-relaxed">
                        <span class="lang-th">ต้องการสอบถามขั้นตอนการรับสมัครเรียน ค่าธรรมเนียม หรือการเดินทาง คุณสามารถเปิดดูช่องทางการติดต่อ แผนที่สัญจร หรือเขียนฟอร์มฝากคำถามไว้ในระบบของเรา</span>
                        <span class="lang-en hidden">Want to ask about admissions procedures, fees, or transportation? You can view our contact channels, map, or leave your questions using our form.</span>
                    </p>
                </div>
                <div class="flex-shrink-0 flex items-center">
                    <a href="contact.php" class="px-6 py-3.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold transition shadow-lg text-sm">
                        <span class="lang-th">ติดต่อเรา / ส่งข้อความฝากไว้ <span>&rarr;</span></span>
                        <span class="lang-en hidden">Contact Us / Leave a Message <span>&rarr;</span></span>
                    </a>
                </div>
            </div>
        </section>

    </main>

    <?php include 'footer.php'; ?>

    <?php include 'login_modal.php'; ?>

    <!-- DETAIL MODAL & DYNAMIC NEWS LOADING SCRIPT -->
    <div id="detailModal" class="fixed inset-0 z-50 overflow-y-auto hidden flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div onclick="closeModal()" id="detailModalBackdrop" class="absolute inset-0 bg-slate-950/60 dark:bg-slate-950/80 backdrop-blur-sm opacity-0 transition-opacity duration-200 ease-out"></div>
        
        <!-- Modal Card -->
        <div id="detailModalCard" class="relative bg-white dark:bg-slate-900 rounded-3xl w-full max-w-2xl overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 z-10 transform scale-95 opacity-0 transition-all duration-200 ease-out">
            <!-- Close Button -->
            <button onclick="closeModal()" class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 font-bold transition">
                &times;
            </button>
            <!-- Image Area -->
            <div id="modalImage" class="h-64 w-full bg-cover bg-center"></div>
            <!-- Content Area -->
            <div class="p-6 sm:p-8 space-y-4">
                <div class="flex items-center gap-3">
                    <span id="modalCategory" class="text-xs px-2.5 py-1 rounded-full bg-blue-100 dark:bg-slate-800 text-brand-600 dark:text-blue-400 font-bold"></span>
                    <span id="modalDate" class="text-xs text-slate-400 font-english"></span>
                </div>
                <h3 id="modalTitle" class="text-2xl font-extrabold text-slate-950 dark:text-white leading-snug"></h3>
                <p id="modalContent" class="text-slate-600 dark:text-slate-350 text-sm leading-relaxed whitespace-pre-wrap"></p>
            </div>
            <!-- Footer Actions -->
            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-950 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                <button onclick="closeModal()" class="px-5 py-2 rounded-xl bg-slate-200 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-sm font-bold transition">
                    <span class="lang-th">ปิดหน้าต่างนี้</span>
                    <span class="lang-en hidden">Close Window</span>
                </button>
            </div>
        </div>
    </div>

    <!-- LOCAL LOGIC SCRIPT (ดึงประกาศมาโชว์ + ควบคุมสไลด์แบนเนอร์) -->
    <script>
        // --- Hero Slider Logic ---
        let currentSlide = 0;
        let slideInterval;
        // Clear any outdated slides cache from older versions
        try {
            const cached = localStorage.getItem('cpw_db_slides');
            if (cached && (cached.includes('cpw_api_content') || cached.includes('admissions-2570'))) {
                localStorage.removeItem('cpw_db_slides');
                localStorage.removeItem('cpw_db_slides_v2');
            }
        } catch(e) {}
        let allSlides = [
            {
                        "id": "ep-campus-tour",
                        "season": "tour",
                        "priority": 10,
                        "months": [
                                    8,
                                    9,
                                    10
                        ],
                        "imageUrl": "img/ep_cover_banner.jpg",
                        "badge": "🎉 กำลังเปิดลงทะเบียน: เยี่ยมชมโครงการ (Campus Tour 2026)",
                        "badge_en": "🎉 Registration Open: EP Campus Tour 2026",
                        "title": "ก้าวสู่อนาคตที่เหนือกว่า ด้วยการเรียนรู้สองภาษา",
                        "title_en": "Step into a Better Future with Bilingual Learning",
                        "description": "โครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ โรงเรียนชลประทานวิทยา มุ่งพัฒนาศักยภาพผู้เรียนสู่ระดับสากล",
                        "description_en": "Chonprathanwittaya School English Program fosters academic excellence and practical English skills to prepare students for global success.",
                        "btn1_text": "🚐 นัดหมายเยี่ยมชมโครงการ",
                        "btn1_text_en": "Book Campus Tour",
                        "btn1_link": "tour.php",
                        "btn2_text": "📖 ดูโครงสร้างหลักสูตร",
                        "btn2_text_en": "View Curriculum",
                        "btn2_link": "curriculum.php"
            },
            {
                        "id": "ep-admissions-open",
                        "season": "admissions",
                        "priority": 9,
                        "months": [
                                    10,
                                    11,
                                    12,
                                    1,
                                    2,
                                    3
                        ],
                        "imageUrl": "img/ep_openhouse_banner.jpg",
                        "badge": "📢 เปิดรับสมัครนักเรียนใหม่ ประจำปีการศึกษา 2570",
                        "badge_en": "📢 Admissions Open for Academic Year 2027",
                        "title": "เปิดรับสมัครนักเรียนใหม่ โครงการฯ ภาคภาษาอังกฤษ (EP)",
                        "title_en": "Admissions Open for English Program (EP)",
                        "description": "เปิดรับสมัครระดับชั้น ป.1, ม.1 และ ม.4 ประจำปีการศึกษา 2570 พร้อมระบบนัดหมายเข้าเยี่ยมชมอาคารเรียนล่วงหน้า",
                        "description_en": "Now accepting applications for Primary (G.1), Junior High (G.7), and Senior High (G.10) for Academic Year 2027 with personalized campus tours.",
                        "btn1_text": "📝 ระเบียบการ & สมัครเรียน",
                        "btn1_text_en": "Admissions & Process",
                        "btn1_link": "admission.php",
                        "btn2_text": "💰 ตรวจสอบค่าเล่าเรียน",
                        "btn2_text_en": "Check Tuition Fees",
                        "btn2_link": "fees.php"
            },
            {
                        "id": "ep-active-learning",
                        "season": "academic",
                        "priority": 8,
                        "months": [
                                    5,
                                    6,
                                    7,
                                    8,
                                    9,
                                    10,
                                    11,
                                    12,
                                    1,
                                    2
                        ],
                        "imageUrl": "img/ep_classroom_p1.jpg",
                        "badge": "🌟 บรรยากาศการเรียนรู้จริงกับครูเจ้าของภาษา",
                        "badge_en": "🌟 Authentic Learning with Native English Teachers",
                        "title": "การเรียนรู้ที่เปี่ยมด้วยความสุข กับครูเจ้าของภาษา (Native Speakers)",
                        "title_en": "Joyful Learning with Qualified Native English Speakers",
                        "description": "เรียนรู้อย่างเป็นธรรมชาติในห้องเรียนปรับอากาศพร้อมสื่อ Interactive Board ปลูกฝังทักษะภาษาตั้งแต่วัยประถมจนถึงมัธยมศึกษา",
                        "description_en": "Natural language acquisition in modern smart classrooms equipped with interactive boards, nurturing confidence from Primary through High School.",
                        "btn1_text": "📖 สำรวจหลักสูตร ป.1 - ม.6",
                        "btn1_text_en": "Explore Curriculum",
                        "btn1_link": "curriculum.php",
                        "btn2_text": "🏫 คณะครูและบุคลากร",
                        "btn2_text_en": "Teachers & Staff",
                        "btn2_link": "staff.php"
            },
            {
                        "id": "ep-english-camp",
                        "season": "camp",
                        "priority": 7,
                        "months": [
                                    6,
                                    7,
                                    8,
                                    9,
                                    10,
                                    11
                        ],
                        "imageUrl": "img/ep_camp_activity.jpg",
                        "badge": "⛺ ค่ายภาษาอังกฤษและกิจกรรมเสริมหลักสูตร (EP Camp)",
                        "badge_en": "⛺ English Program Camp & Experiential Learning",
                        "title": "เปิดโลกการเรียนรู้นอกห้องเรียน (EP English Camp & Field Trips)",
                        "title_en": "Experiential Learning: EP English Camp & Field Trips",
                        "description": "เสริมสร้างความกล้าแสดงออก ภาวะผู้นำ และมิตรภาพ ผ่านกิจกรรมค่ายภาษาอังกฤษและการทัศนศึกษาทั้งในและต่างประเทศ",
                        "description_en": "Fostering leadership, cross-cultural competence, and lasting friendships through immersive English camps and educational excursions.",
                        "btn1_text": "📰 ชมภาพกิจกรรมล่าสุด",
                        "btn1_text_en": "Latest Activities",
                        "btn1_link": "news.php",
                        "btn2_text": "🏆 ทำเนียบเกียรติยศนักเรียน",
                        "btn2_text_en": "Hall of Fame",
                        "btn2_link": "awards.php"
            }
];

        function getSlides() {
            return document.querySelectorAll('.hero-slide');
        }
        function getDots() {
            return document.querySelectorAll('.hero-dot');
        }

        function loadHeroSlides() {
            if (typeof getDbSlides === 'function') {
                getDbSlides(function(list) {
                    allSlides = list;
                    renderHeroSlides();
                });
            } else {
                resetSlideTimer();
            }
        }

        function renderHeroSlides() {
            const container = document.getElementById('hero-slides-container');
            const dotsContainer = document.querySelector('#home .flex.gap-2');
            if (!container || allSlides.length === 0) {
                resetSlideTimer();
                return;
            }

            // 🌟 Smart Seasonal & Priority Filter: คัดกรองและเรียงลำดับสไลด์ตามเดือนปัจจุบันและความสำคัญ
            const currentMonth = new Date().getMonth() + 1; // 1 - 12
            let activeSlides = allSlides.filter(s => !s.months || s.months.includes(currentMonth));
            if (activeSlides.length < 2) {
                activeSlides = allSlides; // Fallback to all if too few match
            }

            // จัดเรียงตาม Priority (ลำดับความสำคัญสูงสุดขึ้นก่อน)
            activeSlides.sort((a, b) => (b.priority || 5) - (a.priority || 5));
            activeSlides = activeSlides.slice(0, 5); // จำกัดสูงสุด 5 สไลด์เพื่อความลื่นไหล

            container.innerHTML = '';
            if (dotsContainer) dotsContainer.innerHTML = '';

            activeSlides.forEach((slide, idx) => {
                const slideDiv = document.createElement('div');
                slideDiv.className = `hero-slide absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out ${idx === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none'} bg-cover bg-center`;
                slideDiv.style.backgroundImage = `url('${slide.imageUrl}')`;
                
                const btn1Html = slide.btn1_text ? `
                    <a href="${slide.btn1_link}" class="px-5 py-2.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold shadow-lg transition duration-200">
                        <span class="lang-th">${slide.btn1_text}</span>
                        <span class="lang-en hidden">${slide.btn1_text_en || slide.btn1_text}</span>
                    </a>
                ` : '';

                const btn2Html = slide.btn2_text ? `
                    <a href="${slide.btn2_link}" class="px-5 py-2.5 rounded-xl bg-slate-900/80 hover:bg-slate-800 text-white border border-white/20 font-bold backdrop-blur-sm transition duration-200">
                        <span class="lang-th">${slide.btn2_text}</span>
                        <span class="lang-en hidden">${slide.btn2_text_en || slide.btn2_text}</span>
                    </a>
                ` : '';

                slideDiv.innerHTML = `
                    <!-- Sleek Crystal Clear Vignette Overlay (No blur for maximum sharpness) -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/45 to-slate-950/30"></div>
                    <div class="absolute inset-0 flex items-center justify-center px-4">
                        <div class="max-w-4xl mx-auto text-center space-y-6">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-500/20 border border-blue-400/40 text-blue-300 text-xs font-bold font-english uppercase tracking-wider shadow-sm">
                                <span class="lang-th">${slide.badge}</span>
                                <span class="lang-en hidden">${slide.badge_en || slide.badge}</span>
                            </span>
                            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black tracking-tight leading-[1.25] sm:leading-[1.2] drop-shadow-md [text-wrap:balance] max-w-3xl mx-auto">
                                <span class="lang-th">${slide.title}</span>
                                <span class="lang-en hidden">${slide.title_en || slide.title}</span>
                            </h1>
                            <p class="text-sm sm:text-base md:text-lg text-slate-100 max-w-2xl mx-auto font-normal leading-relaxed drop-shadow [text-wrap:pretty]">
                                <span class="lang-th">${slide.description}</span>
                                <span class="lang-en hidden">${slide.description_en || slide.description}</span>
                            </p>
                            <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                                ${btn1Html}
                                ${btn2Html}
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(slideDiv);

                if (dotsContainer) {
                    const dotBtn = document.createElement('button');
                    dotBtn.className = `hero-dot w-2.5 h-2.5 rounded-full ${idx === 0 ? 'bg-white' : 'bg-white/40'} transition`;
                    dotBtn.setAttribute('onclick', `goToSlide(${idx})`);
                    dotBtn.setAttribute('aria-label', `Go to slide ${idx + 1}`);
                    dotsContainer.appendChild(dotBtn);
                }
            });

            if (typeof updateLanguageUI === 'function') {
                updateLanguageUI();
            }

            resetSlideTimer();
        }

        function showSlide(index) {
            const slideElements = getSlides();
            const dotElements = getDots();
            if (slideElements.length === 0) return;
            
            if (index >= slideElements.length) currentSlide = 0;
            else if (index < 0) currentSlide = slideElements.length - 1;
            else currentSlide = index;

            slideElements.forEach((slide, i) => {
                if (i === currentSlide) {
                    slide.classList.remove('opacity-0', 'pointer-events-none');
                    slide.classList.add('opacity-100');
                } else {
                    slide.classList.remove('opacity-100');
                    slide.classList.add('opacity-0', 'pointer-events-none');
                }
            });

            dotElements.forEach((dot, i) => {
                if (i === currentSlide) {
                    dot.classList.remove('bg-white/40');
                    dot.classList.add('bg-white');
                } else {
                    dot.classList.remove('bg-white');
                    dot.classList.add('bg-white/40');
                }
            });
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
            resetSlideTimer();
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
            resetSlideTimer();
        }

        function goToSlide(index) {
            showSlide(index);
            resetSlideTimer();
        }

        function startSlideTimer() {
            slideInterval = setInterval(nextSlide, 6000); 
        }

        function resetSlideTimer() {
            clearInterval(slideInterval);
            startSlideTimer();
        }

        window.addEventListener('DOMContentLoaded', () => {
            loadHeroSlides();
        });

        // --- Announcements Logic ---
        let allAnnouncements = [];
        let activeCategory = 'ทั้งหมด';

        // โหลดข้อมูลประกาศและภาพกิจกรรมเมื่อเปิดหน้าแรก
        window.addEventListener('DOMContentLoaded', () => {
            loadAnnouncements();
            loadActivities();
        });

        function loadAnnouncements() {
            const loader = document.getElementById('news-loading');
            const grid = document.getElementById('announcement-grid');
            
            getDbNews(function(list) {
                allAnnouncements = list;
                if (loader) loader.classList.add('hidden');
                if (grid) grid.classList.remove('hidden');
                renderAnnouncements();
            });
        }

        const categoryTranslations = {
            'ทั้งหมด': { th: 'ทั้งหมด', en: 'All' },
            'รับสมัครเรียน': { th: 'รับสมัครเรียน', en: 'Admissions' },
            'ผลงานนักเรียน': { th: 'ผลงานนักเรียน', en: 'Awards' },
            'กิจกรรม': { th: 'กิจกรรม', en: 'Activities' }
        };
        function getTranslatedCategory(cat) {
            const currentLang = localStorage.getItem('ep_lang') || 'th';
            return (categoryTranslations[cat] && categoryTranslations[cat][currentLang]) || cat;
        }

        function handleSearchInput() {
            renderAnnouncements();
        }

        function renderAnnouncements() {
            const grid = document.getElementById('announcement-grid');
            if (!grid) return;
            
            grid.innerHTML = '';

            const currentLang = localStorage.getItem('ep_lang') || 'th';
            const isEn = currentLang === 'en';

            const searchInput = document.getElementById('news-search-input');
            const searchVal = searchInput ? searchInput.value.trim().toLowerCase() : '';

            const filtered = allAnnouncements.filter(item => {
                // 1. Category Filter
                const matchesCategory = activeCategory === 'ทั้งหมด' || item.category === activeCategory;
                if (!matchesCategory) return false;
                
                // 2. Search Text Filter
                if (searchVal) {
                    const title = (isEn && item.title_en ? item.title_en : item.title).toLowerCase();
                    const content = (isEn && item.content_en ? item.content_en : item.content).toLowerCase();
                    return title.includes(searchVal) || content.includes(searchVal);
                }
                return true;
            });

            if (filtered.length === 0) {
                const noNewsText = isEn 
                    ? '📭 No matching announcements found' 
                    : '📭 ไม่พบข่าวประกาศที่ตรงตามเงื่อนไขการค้นหา';
                grid.innerHTML = `
                    <div class="text-center py-12 text-slate-500 dark:text-slate-400">
                        ${noNewsText}
                    </div>
                `;
                return;
            }

            const maxHomeItems = 5;
            const itemsToRender = filtered.slice(0, maxHomeItems);

            itemsToRender.forEach((item, index) => {
                const row = document.createElement('div');
                // Clean minimalist list row for search results
                row.className = "group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 rounded-xl p-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 cursor-pointer hover:border-brand-accent/20 dark:hover:border-slate-700 hover:shadow-sm transition-all duration-300 relative pl-4 before:content-[''] before:absolute before:left-0 before:top-0 before:bottom-0 before:w-1 before:bg-brand-500 dark:before:bg-blue-500 before:rounded-l-xl before:scale-y-0 hover:before:scale-y-100 before:transition-transform before:duration-200";
                row.onclick = () => openModal(item);

                const title = isEn && item.title_en ? item.title_en : item.title;

                row.innerHTML = `
                    <div class="flex items-center gap-3 min-w-0 flex-grow">
                        <span class="px-2 py-0.5 rounded-md bg-brand-500/5 text-brand-500 dark:text-blue-400 font-bold border border-brand-500/10 text-xs flex-shrink-0">
                            ${getTranslatedCategory(item.category)}
                        </span>
                        <h3 class="font-extrabold text-slate-850 dark:text-white group-hover:text-brand-accent dark:group-hover:text-blue-400 transition-colors text-sm sm:text-base truncate">
                            ${title}
                        </h3>
                    </div>
                    <span class="text-slate-400 text-xs font-english flex-shrink-0 self-end sm:self-auto">${item.date}</span>
                `;
                grid.appendChild(row);
            });
        }

        function filterCategory(category) {
            activeCategory = category;
            
            const filters = ['all', 'admissions', 'awards', 'activities'];
            const labels = ['ทั้งหมด', 'รับสมัครเรียน', 'ผลงานนักเรียน', 'กิจกรรม'];
            
            labels.forEach((lbl, idx) => {
                const btn = document.getElementById(`filter-${filters[idx]}`);
                if (btn) {
                    if (lbl === category) {
                        btn.className = "px-4 py-1.5 rounded-full font-bold bg-brand-500 text-white shadow-sm transition";
                    } else {
                        btn.className = "px-4 py-1.5 rounded-full font-bold bg-white text-slate-600 border border-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-700 transition";
                    }
                }
            });

            renderAnnouncements();
        }

        // --- Detail Modal Controls ---
        function openModal(item) {
            const modal = document.getElementById('detailModal');
            const backdrop = document.getElementById('detailModalBackdrop');
            const card = document.getElementById('detailModalCard');
            const img = document.getElementById('modalImage');
            const cat = document.getElementById('modalCategory');
            const date = document.getElementById('modalDate');
            const title = document.getElementById('modalTitle');
            const content = document.getElementById('modalContent');

            if (item.imageUrl) {
                img.style.backgroundImage = `url('${item.imageUrl}')`;
                img.classList.remove('hidden');
            } else {
                img.classList.add('hidden');
            }

            const currentLang = localStorage.getItem('ep_lang') || 'th';
            const isEn = currentLang === 'en';

            cat.innerText = getTranslatedCategory(item.category);
            date.innerText = item.date;
            title.innerText = isEn && item.title_en ? item.title_en : item.title;
            content.innerText = isEn && item.content_en ? item.content_en : item.content;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                if (backdrop) {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                }
                if (card) {
                    card.classList.remove('scale-95', 'opacity-0');
                    card.classList.add('scale-100', 'opacity-100');
                }
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('detailModal');
            const backdrop = document.getElementById('detailModalBackdrop');
            const card = document.getElementById('detailModalCard');
            
            if (backdrop) {
                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0');
            }
            if (card) {
                card.classList.remove('scale-100', 'opacity-100');
                card.classList.add('scale-95', 'opacity-0');
            }
            
            setTimeout(() => {
                if (modal) modal.classList.add('hidden');
                document.body.style.overflow = '';
            }, 200);
        }

        // รีเฟรชข่าวสารและกิจกรรมทันทีเมื่อผู้ใช้เปลี่ยนภาษาที่แถบเมนูด้านบน
        window.addEventListener('languageChanged', () => {
            renderAnnouncements();
            renderActivities();
        });

        // --- Activities Logic ---
        let allActivities = [];
        function loadActivities() {
            const loader = document.getElementById('activities-loading');
            const grid = document.getElementById('activities-grid');
            
            fetch('data/db_activities.json?v=' + Date.now())
                .then(res => {
                    if (!res.ok) throw new Error("Activities file not found");
                    return res.json();
                })
                .then(list => {
                    allActivities = list;
                    if (loader) loader.classList.add('hidden');
                    if (grid) grid.classList.remove('hidden');
                    renderActivities();
                })
                .catch(err => {
                    console.error("Failed to load activities:", err);
                    if (loader) loader.classList.add('hidden');
                });
        }

        function renderActivities() {
            const grid = document.getElementById('activities-grid');
            if (!grid) return;
            grid.innerHTML = '';

            const currentLang = localStorage.getItem('ep_lang') || 'th';
            const isEn = currentLang === 'en';

            // Show top 3 recent albums
            const itemsToRender = allActivities.slice(0, 3);

            if (itemsToRender.length === 0) {
                grid.innerHTML = `
                    <div class="col-span-full text-center py-8 text-slate-500 dark:text-slate-400">
                        <span class="lang-th">ไม่มีกิจกรรมล่าสุดในขณะนี้</span>
                        <span class="lang-en hidden">No recent activities available.</span>
                    </div>
                `;
                return;
            }

            itemsToRender.forEach((item, index) => {
                const card = document.createElement('div');
                card.className = "group relative cursor-pointer rounded-2xl overflow-hidden shadow-sm hover:shadow-lg border border-slate-200/80 dark:border-slate-800 transition-all duration-300 aspect-[3/2] flex flex-col justify-end bg-slate-950";
                card.onclick = () => {
                    window.location.href = `news.php?tab=activities`;
                };

                const fallbackImg = 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=800&auto=format&fit=crop&q=60';
                const countText = isEn ? 'Photos' : 'รูป';

                card.innerHTML = `
                    <!-- Cover Image -->
                    <img src="${item.imageUrl || fallbackImg}"
                         alt="${item.title}"
                         class="absolute inset-0 w-full h-full object-cover opacity-95 group-hover:opacity-90 group-hover:scale-105 transition-all duration-500"
                         onerror="this.src='${fallbackImg}'">

                    <!-- Overlay Gradient (Softer and restricted to the bottom half) -->
                    <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-slate-950/80 to-transparent z-0"></div>

                    <!-- Top-right: photo count badge -->
                    <div class="absolute top-3 right-3 z-10">
                        <span class="bg-slate-950/70 backdrop-blur-sm text-white text-[10px] sm:text-xs font-semibold px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-full flex items-center gap-1 shadow-sm border border-white/10">
                            <i class="fa-regular fa-image"></i> ${item.photoCount} ${countText}
                        </span>
                    </div>

                    <!-- Bottom contents -->
                    <div class="relative z-10 p-4 sm:p-5 space-y-1.5 translate-y-1 group-hover:translate-y-0 transition-transform duration-300">
                        <span class="text-[10px] text-slate-350 flex items-center gap-1 font-english">
                            <i class="fa-regular fa-calendar"></i> ${item.date}
                        </span>
                        <h3 class="text-sm sm:text-base font-bold text-white line-clamp-2 leading-snug group-hover:text-brand-accent dark:group-hover:text-blue-400 transition-colors">
                            ${item.title}
                        </h3>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        function getFallbackAnnouncements() {
            return [
                {
                    date: "16/06/2026",
                    category: "รับสมัครเรียน",
                    title: "ประกาศรับสมัครนักเรียนใหม่ ปีการศึกษา 2569",
                    title_en: "Admission Announcement for New Students, Academic Year 2026",
                    content: "เปิดรับสมัครนักเรียนเข้าศึกษาต่อในระดับชั้นมัธยมศึกษาปีที่ 1 และ 4 (โครงการฯ ภาคภาษาอังกฤษ English Program) ประจำปีการศึกษา 2569",
                    content_en: "Applications are now open for new students in Grade 7 (M.1) and Grade 10 (M.4) for the English Program, Academic Year 2026.",
                    imageUrl: "https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=800&auto=format&fit=crop&q=60"
                }
            ];
        }
    </script>
</body>
</html>
