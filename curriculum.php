<?php
$pageTitle = "หลักสูตรที่เปิดสอน | English Program (EP) CPW";
$currentPage = "curriculum";
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <?php include 'head.php'; ?>
</head>
<body class="bg-slate-50 text-slate-800 font-sans transition-colors duration-300 dark:bg-slate-900 dark:text-slate-100 min-h-screen flex flex-col">

    <?php include 'header.php'; ?>

    <!-- HEADER BANNER WITH BACKGROUND IMAGE -->
    <header class="relative bg-slate-950 text-white py-24 px-4 overflow-hidden flex items-center justify-center bg-cover bg-center" style="background-image: url('https://app.cpw.ac.th/cpw_api_content/images/activities/2026-08/320260822162040/32026082216204020260824114421_290234.jpg');">
        <div class="absolute inset-0 bg-slate-950/70"></div>
        <div class="relative max-w-4xl mx-auto text-center space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-accent/10 border border-brand-accent/25 text-brand-accent text-xs font-bold font-english uppercase tracking-wider">
                Academic Programs
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-tight">
                <span class="lang-th">หลักสูตรที่เปิดสอน (Curriculum)</span>
                <span class="lang-en hidden">EP Curriculum</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base font-normal max-w-2xl mx-auto leading-relaxed">
                <span class="lang-th">รายละเอียดรายวิชาและกิจกรรมของแต่ละช่วงชั้น ตั้งแต่ชั้นประถมศึกษาปีที่ 1 ถึงมัธยมศึกษาปีที่ 6</span>
                <span class="lang-en hidden">Course details and curriculum activities for all levels from Primary (P.1) to Senior High (M.6).</span>
            </p>
        </div>
    </header>

    <!-- MAIN CONTENT (N°28 Master Detail Layout) -->
    <main class="flex-grow max-w-[1400px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- MASTER MENU (Left Sidebar) -->
            <div class="lg:col-span-3 flex flex-row overflow-x-auto lg:flex-col gap-2 pb-3 lg:pb-0 border-b lg:border-b-0 border-slate-200 dark:border-slate-800 shrink-0 select-none scrollbar-none">
                <button onclick="switchTab('tab-primary')" id="btn-tab-primary" class="w-auto lg:w-full text-left px-5 py-4 rounded-xl border font-bold text-xs sm:text-sm transition-all duration-200 whitespace-nowrap bg-brand-500 text-white border-brand-500 flex items-center gap-3 shrink-0">
                    <span class="text-base">🏫</span>
                    <div>
                        <span class="lang-th block">ประถมศึกษา (ป.1-6)</span>
                        <span class="lang-en block hidden">Primary (P.1-6)</span>
                    </div>
                </button>
                <button onclick="switchTab('tab-junior')" id="btn-tab-junior" class="w-auto lg:w-full text-left px-5 py-4 rounded-xl border font-bold text-xs sm:text-sm transition-all duration-200 whitespace-nowrap bg-white text-slate-700 border-slate-200 dark:bg-slate-900 dark:text-slate-300 dark:border-slate-800 flex items-center gap-3 shrink-0">
                    <span class="text-base">📘</span>
                    <div>
                        <span class="lang-th block">มัธยมศึกษาตอนต้น (ม.1-3)</span>
                        <span class="lang-en block hidden">Junior High (M.1-3)</span>
                    </div>
                </button>
                <button onclick="switchTab('tab-senior')" id="btn-tab-senior" class="w-auto lg:w-full text-left px-5 py-4 rounded-xl border font-bold text-xs sm:text-sm transition-all duration-200 whitespace-nowrap bg-white text-slate-700 border-slate-200 dark:bg-slate-900 dark:text-slate-300 dark:border-slate-800 flex items-center gap-3 shrink-0">
                    <span class="text-base">📕</span>
                    <div>
                        <span class="lang-th block">มัธยมศึกษาตอนปลาย (ม.4-6)</span>
                        <span class="lang-en block hidden">Senior High (M.4-6)</span>
                    </div>
                </button>
            </div>

            <!-- DETAIL CONTENT (Right Card Grid) -->
            <div class="lg:col-span-9">
                
                <!-- Primary School Tab Content -->
                <div id="tab-primary" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span>🏫</span>
                            <span class="lang-th">หลักสูตรระดับประถมศึกษา</span>
                            <span class="lang-en hidden">Primary School Curriculum</span>
                        </h3>
                        <span class="inline-flex items-center px-2.5 py-1 rounded bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 text-xs font-bold font-english uppercase">
                            <span class="lang-th">ป.1 - ป.6</span>
                            <span class="lang-en hidden">P.1 - P.6</span>
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                        <div class="md:col-span-7 space-y-4">
                            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                                <span class="lang-th">เน้นการปรับตัวเพื่อเสริมทักษะภาษาอังกฤษและปูพื้นฐานการคิดคำนวณและทักษะวิทยาศาสตร์ การเรียนรู้รายวิชาหลักด้วยครูต่างชาติเจ้าของภาษาควบคู่กับครูไทย (Teacher Assistant) เพื่อให้นักเรียนเข้าใจเนื้อหาอย่างถูกต้อง</span>
                                <span class="lang-en hidden">Focuses on early adaptation to improve English skills and lay foundations in mathematics and science. Core subjects are taught by native speaking foreign teachers alongside Thai teaching assistants to ensure conceptual clarity.</span>
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-850">
                                    <h4 class="font-bold text-brand-500 dark:text-blue-400 text-xs mb-2">
                                        <span class="lang-th">รายวิชาเรียนหลัก:</span>
                                        <span class="lang-en hidden">Core Subjects:</span>
                                    </h4>
                                    <ul class="text-[11px] space-y-1 text-slate-550 dark:text-slate-400 list-disc list-inside">
                                        <li><span class="lang-th">คณิตศาสตร์</span><span class="lang-en hidden">Mathematics</span></li>
                                        <li><span class="lang-th">วิทยาศาสตร์</span><span class="lang-en hidden">Science</span></li>
                                        <li><span class="lang-th">ภาษาอังกฤษ</span><span class="lang-en hidden">English</span></li>
                                        <li><span class="lang-th">คอมพิวเตอร์</span><span class="lang-en hidden">Computer</span></li>
                                    </ul>
                                </div>
                                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-850">
                                    <h4 class="font-bold text-brand-accent text-xs mb-2">
                                        <span class="lang-th">วิชาภาษาเพิ่มเติม:</span>
                                        <span class="lang-en hidden">Enrichment Languages:</span>
                                    </h4>
                                    <ul class="text-[11px] space-y-1 text-slate-550 dark:text-slate-400 list-disc list-inside">
                                        <li><span class="lang-th">การอ่านและเขียน</span><span class="lang-en hidden">Reading & Writing</span></li>
                                        <li><span class="lang-th">การฟังและพูด</span><span class="lang-en hidden">Listening & Speaking</span></li>
                                        <li><span class="lang-th">การออกเสียง (โฟนิกส์)</span><span class="lang-en hidden">Phonics</span></li>
                                        <li><span class="lang-th">ภาษาจีน</span><span class="lang-en hidden">Chinese</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-5">
                            <div class="h-56 w-full rounded-xl bg-cover bg-center shadow-sm" style="background-image: url('img/ep_classroom_p1.jpg');"></div>
                        </div>
                    </div>
                </div>

                <!-- Junior High School Tab Content -->
                <div id="tab-junior" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6 hidden">
                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span>📘</span>
                            <span class="lang-th">หลักสูตรระดับมัธยมศึกษาตอนต้น</span>
                            <span class="lang-en hidden">Junior High School Curriculum</span>
                        </h3>
                        <span class="inline-flex items-center px-2.5 py-1 rounded bg-pink-50 dark:bg-pink-950/40 text-brand-accent dark:text-pink-400 text-xs font-bold font-english uppercase">
                            <span class="lang-th">ม.1 - ม.3</span>
                            <span class="lang-en hidden">M.1 - M.3</span>
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                        <div class="md:col-span-7 space-y-4">
                            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                                <span class="lang-th">เน้นการปูพื้นฐานการวิเคราะห์ข้อมูล คณิตศาสตร์ วิทยาศาสตร์ และทักษะภาษาอังกฤษเพื่อการศึกษาต่อในระดับที่สูงขึ้น มุ่งส่งเสริมให้นักเรียนเรียนรู้ผ่านการทำกิจกรรมแบบบูรณาการและการทำงานเป็นทีม</span>
                                <span class="lang-en hidden">Focuses on laying a foundation in data analysis, mathematics, science, and academic English skills for higher education. Encourages integrated hands-on activities and collaborative teamwork.</span>
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-850">
                                    <h4 class="font-bold text-brand-500 dark:text-blue-400 text-xs mb-2">
                                        <span class="lang-th">รายวิชาเรียนหลัก:</span>
                                        <span class="lang-en hidden">Core Academic Subjects:</span>
                                    </h4>
                                    <ul class="text-[11px] space-y-1 text-slate-550 dark:text-slate-400 list-disc list-inside">
                                        <li><span class="lang-th">คณิตศาสตร์</span><span class="lang-en hidden">Mathematics</span></li>
                                        <li><span class="lang-th">วิทยาศาสตร์และปฏิบัติการทดลอง</span><span class="lang-en hidden">Science & Laboratory</span></li>
                                        <li><span class="lang-th">ภาษาอังกฤษเพื่อการสื่อสาร</span><span class="lang-en hidden">English Communication</span></li>
                                        <li><span class="lang-th">คอมพิวเตอร์และเทคโนโลยี</span><span class="lang-en hidden">Computers & Technology</span></li>
                                    </ul>
                                </div>
                                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-850">
                                    <h4 class="font-bold text-brand-accent text-xs mb-2">
                                        <span class="lang-th">กิจกรรมส่งเสริมทักษะ:</span>
                                        <span class="lang-en hidden">Enrichment Activities:</span>
                                    </h4>
                                    <ul class="text-[11px] space-y-1 text-slate-550 dark:text-slate-400 list-disc list-inside">
                                        <li><span class="lang-th">ค่ายภาษาอังกฤษ</span><span class="lang-en hidden">English Camp</span></li>
                                        <li><span class="lang-th">การประกวดร้องเพลงภาษาอังกฤษ</span><span class="lang-en hidden">English Singing Contest</span></li>
                                        <li><span class="lang-th">กิจกรรมสะเต็มศึกษา</span><span class="lang-en hidden">STEM Activities</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-5">
                            <div class="h-56 w-full rounded-xl bg-cover bg-center shadow-sm" style="background-image: url('img/ep_camp_activity.jpg');"></div>
                        </div>
                    </div>
                </div>

                <!-- Senior High School Tab Content -->
                <div id="tab-senior" class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6 hidden">
                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span>📕</span>
                            <span class="lang-th">หลักสูตรระดับมัธยมศึกษาตอนปลาย</span>
                            <span class="lang-en hidden">Senior High School Curriculum</span>
                        </h3>
                        <span class="inline-flex items-center px-2.5 py-1 rounded bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 text-xs font-bold font-english uppercase">
                            <span class="lang-th">ม.4 - ม.6</span>
                            <span class="lang-en hidden">M.4 - M.6</span>
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                        <div class="md:col-span-7 space-y-4">
                            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                                <span class="lang-th">หลักสูตรระดับมัธยมศึกษาตอนปลายจัดการเรียนการสอนแบบวิชาการเข้มข้นเพื่อพัฒนาทักษะเฉพาะทาง มีความพร้อมด้านการเรียนรู้ทั้งสายวิทยาศาสตร์-คณิตศาสตร์ และสายคณิตศาสตร์-ภาษาอังกฤษ (แบบเสริมภาษาจีนหรือภาษาญี่ปุ่น) มุ่งเตรียมความพร้อมเพื่อเข้าศึกษาต่อในระดับอุดมศึกษาและหลักสูตรนานาชาติ</span>
                                <span class="lang-en hidden">An intensive academic senior high curriculum to develop specialized skills with study tracks: Science-Math and Math-English (with elective Chinese or Japanese), preparing students for university and international degree programs.</span>
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-850">
                                    <h4 class="font-bold text-brand-500 dark:text-blue-400 text-xs mb-2">
                                        <span class="lang-th">รายวิชาเรียนหลักเชิงลึก:</span>
                                        <span class="lang-en hidden">Academic Track Subjects:</span>
                                    </h4>
                                    <ul class="text-[11px] space-y-1 text-slate-550 dark:text-slate-400 list-disc list-inside">
                                        <li><span class="lang-th">คณิตศาสตร์ขั้นสูงและแคลคูลัส</span><span class="lang-en hidden">Advanced Math & Calculus</span></li>
                                        <li><span class="lang-th">ฟิสิกส์ เคมี และชีววิทยา</span><span class="lang-en hidden">Physics, Chemistry & Biology</span></li>
                                        <li><span class="lang-th">การเขียนเชิงวิชาการและระเบียบวิธีวิจัย</span><span class="lang-en hidden">Academic Writing & Research</span></li>
                                    </ul>
                                </div>
                                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-850">
                                    <h4 class="font-bold text-brand-accent text-xs mb-2">
                                        <span class="lang-th">การวัดระดับและเป้าหมาย:</span>
                                        <span class="lang-en hidden">Targets & Testing:</span>
                                    </h4>
                                    <ul class="text-[11px] space-y-1 text-slate-550 dark:text-slate-400 list-disc list-inside">
                                        <li><span class="lang-th">อบรมและทดสอบวัดระดับไอเอล (IELTS 6.0+)</span><span class="lang-en hidden">IELTS Benchmark 6.0+ Preparation & Testing</span></li>
                                        <li><span class="lang-th">โครงงานวิทยาศาสตร์ระดับประเทศ</span><span class="lang-en hidden">National Science Projects</span></li>
                                        <li><span class="lang-th">แนะแนวศึกษาต่อต่างประเทศและหลักสูตรนานาชาติ</span><span class="lang-en hidden">Overseas & International University Guidance</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-5">
                            <div class="h-56 w-full rounded-xl bg-cover bg-center shadow-sm" style="background-image: url('https://app.cpw.ac.th/cpw_api_content/images/activities/3202606231647351449664451.JPG');"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <?php include 'login_modal.php'; ?>

    <!-- Script สำหรับหน้า Curriculum เท่านั้น -->
    <script>
        function switchTab(tabId) {
            const tabs = ['tab-primary', 'tab-junior', 'tab-senior'];
            tabs.forEach(id => {
                const content = document.getElementById(id);
                const btn = document.getElementById(`btn-${id}`);
                if (content) content.classList.add('hidden');
                if (btn) {
                    btn.className = "w-auto lg:w-full text-left px-5 py-4 rounded-xl border font-bold text-xs sm:text-sm transition-all duration-200 whitespace-nowrap bg-white text-slate-700 border-slate-200 dark:bg-slate-900 dark:text-slate-300 dark:border-slate-800 flex items-center gap-3 shrink-0";
                }
            });
            const activeContent = document.getElementById(tabId);
            const activeBtn = document.getElementById(`btn-${tabId}`);
            if (activeContent) activeContent.classList.remove('hidden');
            if (activeBtn) {
                activeBtn.className = "w-auto lg:w-full text-left px-5 py-4 rounded-xl border font-bold text-xs sm:text-sm transition-all duration-200 whitespace-nowrap bg-brand-500 text-white border-brand-500 flex items-center gap-3 shrink-0";
            }
        }

        // จัดการกับการเปลี่ยน Hash ของ URL เพื่อสลับแท็บอัตโนมัติ
        function checkHash() {
            const hash = window.location.hash;
            if (hash) {
                const cleanHash = hash.replace('#', '');
                const tabId = cleanHash.startsWith('tab-') ? cleanHash : 'tab-' + cleanHash;
                const tabs = ['tab-primary', 'tab-junior', 'tab-senior'];
                if (tabs.includes(tabId)) {
                    switchTab(tabId);
                    const switcher = document.getElementById('btn-' + tabId);
                    if (switcher) {
                        switcher.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            }
        }

        window.addEventListener('DOMContentLoaded', checkHash);
        window.addEventListener('hashchange', checkHash);
    </script>
</body>
</html>
