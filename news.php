<?php
$pageTitle = "News & Activities | Chonprathanwittaya School";
$currentPage = "news";
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <?php include 'head.php'; ?>
</head>
<body class="bg-slate-50 text-slate-800 font-sans transition-colors duration-300 dark:bg-slate-900 dark:text-slate-100 min-h-screen flex flex-col">

    <?php include 'header.php'; ?>

    <main class="flex-grow max-w-[1400px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 space-y-20">
        
        <!-- Header -->
        <div class="text-center space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-500/10 text-brand-500 dark:text-blue-400 font-bold text-xs uppercase tracking-wider">
                <span class="lang-th">อัปเดตข้อมูลสดใหม่</span>
                <span class="lang-en hidden">Real-time Sync</span>
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-950 dark:text-white tracking-tight">
                <span class="lang-th">ข่าวประกาศและกิจกรรมโครงการ EP</span>
                <span class="lang-en hidden">EP News & Activities</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm sm:text-base max-w-2xl mx-auto font-light leading-relaxed">
                <span class="lang-th">ติดตามข่าวประชาสัมพันธ์ จดหมายแจ้งผู้ปกครอง และประมวลภาพกิจกรรมต่างๆ ของหลักสูตรภาษาอังกฤษ (EP) โรงเรียนชลประทานวิทยา</span>
                <span class="lang-en hidden">Stay updated with official announcements, letters to parents, and activity photo galleries of the Chonprathanwittaya School English Program.</span>
            </p>
        </div>

        <!-- Tab Controls -->
        <div class="flex justify-center border-b border-slate-200 dark:border-slate-800">
            <nav class="flex space-x-8" aria-label="Tabs">
                <button onclick="switchTab('activities')" id="tab-activities" class="border-brand-500 text-brand-500 dark:border-blue-400 dark:text-blue-400 whitespace-nowrap py-4 px-1 border-b-2 font-bold text-base sm:text-lg transition-all focus:outline-none">
                    <i class="fa-regular fa-images mr-2"></i> 
                    <span class="lang-th">ภาพกิจกรรมโครงการ EP</span>
                    <span class="lang-en hidden">Activity Galleries</span>
                </button>
                <button onclick="switchTab('news')" id="tab-news" class="border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-350 whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-base sm:text-lg transition-all dark:text-slate-400 dark:hover:text-slate-300 focus:outline-none">
                    <i class="fa-regular fa-newspaper mr-2"></i> 
                    <span class="lang-th">ข่าวประชาสัมพันธ์ & ประกาศ</span>
                    <span class="lang-en hidden">Announcements</span>
                </button>
            </nav>
        </div>

        <!-- Activities Section -->
        <div id="section-activities" class="space-y-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-brand-500 dark:bg-blue-500 rounded-full"></span>
                    <span class="lang-th">อัลบั้มภาพกิจกรรมโครงการ EP</span>
                    <span class="lang-en hidden">EP Activity Galleries</span>
                    <span id="activities-count" class="bg-brand-500/10 text-brand-500 dark:text-blue-400 text-xs font-bold px-3 py-1 rounded-full ml-2">...</span>
                </h2>

                <!-- Academic Year Filter Buttons -->
                <div id="activities-year-filters" class="flex flex-wrap gap-2 text-xs sm:text-sm">
                    <!-- Dynamic injection of year filter pills -->
                </div>
            </div>
            
            <div id="activities-grid" class="columns-1 sm:columns-2 lg:columns-3 gap-6">
                <!-- Activity cards will be inserted here dynamically -->
                <div class="text-center py-12 text-slate-400 col-span-full">
                    <i class="fa-solid fa-spinner fa-spin text-3xl mb-3 text-brand-500"></i>
                    <p>กำลังดาวน์โหลดอัลบั้มกิจกรรมของ EP...</p>
                </div>
            </div>
        </div>

        <!-- News Section (Hidden by default) -->
        <div id="section-news" class="space-y-8 hidden">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-brand-500 dark:bg-blue-500 rounded-full"></span>
                    <span class="lang-th">ข่าวประชาสัมพันธ์และประกาศสำคัญ</span>
                    <span class="lang-en hidden">Recent Announcements</span>
                    <span id="news-count" class="bg-brand-500/10 text-brand-500 dark:text-blue-400 text-xs font-bold px-3 py-1 rounded-full ml-2">...</span>
                </h2>
                
                <!-- Category filters -->
                <div class="flex flex-wrap gap-2 text-xs sm:text-sm">
                    <button onclick="filterCategory('ทั้งหมด')" id="filter-all" class="px-4 py-1.5 rounded-full font-bold bg-brand-500 text-white shadow-sm transition">
                        <span class="lang-th">ทั้งหมด</span>
                        <span class="lang-en hidden">All</span>
                    </button>
                    <button onclick="filterCategory('รับสมัครเรียน')" id="filter-admissions" class="px-4 py-1.5 rounded-full font-bold bg-white text-slate-600 border border-slate-200 dark:bg-slate-900 dark:text-slate-300 dark:border-slate-800 transition hover:bg-slate-50 dark:hover:bg-slate-800">
                        <span class="lang-th">รับสมัครเรียน</span>
                        <span class="lang-en hidden">Admissions</span>
                    </button>
                    <button onclick="filterCategory('ผลงานนักเรียน')" id="filter-awards" class="px-4 py-1.5 rounded-full font-bold bg-white text-slate-600 border border-slate-200 dark:bg-slate-900 dark:text-slate-300 dark:border-slate-800 transition hover:bg-slate-50 dark:hover:bg-slate-800">
                        <span class="lang-th">ผลงานนักเรียน</span>
                        <span class="lang-en hidden">Achievements</span>
                    </button>
                    <button onclick="filterCategory('กิจกรรม')" id="filter-activities" class="px-4 py-1.5 rounded-full font-bold bg-white text-slate-600 border border-slate-200 dark:bg-slate-900 dark:text-slate-300 dark:border-slate-800 transition hover:bg-slate-50 dark:hover:bg-slate-800">
                        <span class="lang-th">กิจกรรม</span>
                        <span class="lang-en hidden">Activities</span>
                    </button>
                </div>
            </div>
            
            <div id="news-list" class="space-y-4">
                <!-- News items will be inserted here dynamically -->
                <div class="text-center py-12 text-slate-400">
                    <i class="fa-solid fa-spinner fa-spin text-3xl mb-3 text-brand-500"></i>
                    <p>กำลังดาวน์โหลดรายการประกาศของ EP...</p>
                </div>
            </div>
        </div>

        <!-- Live Sync Explain Card -->
        <div class="bg-brand-500/5 dark:bg-slate-900/50 rounded-3xl p-6 sm:p-8 border border-brand-500/10 flex gap-4 items-start">
            <span class="text-2xl mt-1 text-brand-500 dark:text-blue-400"><i class="fa-solid fa-cloud-arrow-down"></i></span>
            <div class="space-y-1.5">
                <h4 class="font-bold text-slate-900 dark:text-white text-sm sm:text-base">
                    <span class="lang-th">ระบบซิงก์ข้อมูลอัจฉริยะ (Seamless Sync):</span>
                    <span class="lang-en hidden">Seamless Information Synchronization:</span>
                </h4>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed font-light">
                    <span class="lang-th">ระบบจะทำการดึงข่าวประกาศของแผนก EP จากเว็บไซต์หลักโรงเรียนชลประทานวิทยาโดยตรง เพื่ออำนวยความสะดวกให้ฝ่ายบริหารลงประกาศเพียงจุดเดียว ข้อมูลจะอัปเดตและแสดงผลที่นี่โดยอัตโนมัติ พร้อมระบบเปิดรับชมรูปภาพการจัดกิจกรรมภายในเว็บไซต์โดยตรง (Native Popups) โดยไม่จำเป็นต้องนำผู้ใช้งานสลับออกไปยังเว็บหลักอีกต่อไป</span>
                    <span class="lang-en hidden">The system automatically synchronizes and filters Chonprathanwittaya School main website news database to display only EP related content. Administrators only need to publish once on the main site, and it automatically reflects here with clean inline photo lightboxes.</span>
                </p>
            </div>
        </div>
    </main>

    <!-- GALLERY MODAL (อัลบั้มรูปภาพกิจกรรมแบบแสดงภายในเว็ป) -->
    <div id="galleryModal" class="fixed inset-0 z-50 overflow-y-auto hidden p-4 flex items-center justify-center">
        <!-- Backdrop -->
        <div onclick="closeGalleryModal()" id="galleryModalBackdrop" class="absolute inset-0 bg-slate-950/60 dark:bg-slate-950/80 backdrop-blur-sm opacity-0 transition-opacity duration-200 ease-out"></div>
        
        <!-- Modal Card -->
        <div id="galleryModalCard" class="relative bg-white dark:bg-slate-900 rounded-3xl w-full max-w-5xl mx-auto my-4 overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 flex flex-col h-[90vh] z-10 transform scale-95 opacity-0 transition-all duration-200 ease-out">
            <!-- Header -->
            <div class="p-6 border-b border-slate-100 dark:border-slate-850 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                <div>
                    <h3 id="galleryModalTitle" class="text-xl font-bold text-slate-900 dark:text-white line-clamp-1"></h3>
                    <p id="galleryModalDate" class="text-xs text-slate-400"></p>
                </div>
                <button onclick="closeGalleryModal()" class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 flex items-center justify-center text-slate-605 dark:text-slate-300 font-bold transition">
                    &times;
                </button>
            </div>
            
            <!-- Scrollable Grid Wrapper -->
            <div class="p-6 overflow-y-auto flex-grow bg-slate-50/30 dark:bg-slate-900/10">
                <!-- Grid Container -->
                <div id="galleryModalGrid" class="columns-2 sm:columns-3 md:columns-4 gap-3">
                    <!-- Thumbnails will be injected here -->
                </div>
            </div>
            
            <!-- Footer -->
            <div class="p-6 border-t border-slate-100 dark:border-slate-850 bg-slate-50/50 dark:bg-slate-900/50 flex justify-between items-center gap-3">
                <span id="galleryModalCount" class="text-xs sm:text-sm text-slate-500"></span>
                <a id="galleryModalOriginalLink" href="#" target="_blank" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-750 text-slate-700 dark:text-slate-350 text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
                    <span class="lang-th">เปิดอัลบั้มจริงบนเว็บหลัก</span>
                    <span class="lang-en hidden">View Album on Main Site</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- LIGHTBOX OVERLAY -->
    <div id="lightboxOverlay" class="fixed inset-0 z-[60] bg-black/95 flex flex-col justify-between items-center p-4 hidden opacity-0 transition-opacity duration-200 ease-out">
        <!-- Close & Controls Header -->
        <div class="w-full flex justify-between items-center max-w-6xl text-white">
            <span id="lightboxIndex" class="text-xs sm:text-sm font-semibold text-slate-300"></span>
            <button onclick="closeLightbox()" class="text-white text-3xl font-bold hover:text-slate-300 transition w-12 h-12 flex items-center justify-center">
                &times;
            </button>
        </div>
        
        <!-- Image & Navigation Arrows -->
        <div class="relative w-full flex-grow flex items-center justify-center max-w-6xl">
            <!-- Left Arrow -->
            <button onclick="prevLightboxImage()" class="absolute left-2 z-10 text-white hover:text-slate-300 transition text-4xl w-12 h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20">
                &#10094;
            </button>
            
            <img id="lightboxImg" src="" alt="Fullscreen image" class="max-h-[75vh] max-w-full object-contain rounded-lg shadow-2xl transition-all duration-350">
            
            <!-- Right Arrow -->
            <button onclick="nextLightboxImage()" class="absolute right-2 z-10 text-white hover:text-slate-300 transition text-4xl w-12 h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20">
                &#10095;
            </button>
        </div>
        
        <!-- Caption/Footer -->
        <div class="w-full text-center text-slate-400 text-xs sm:text-sm py-4 max-w-3xl truncate" id="lightboxCaption">
        </div>
    </div>

    <!-- DETAIL MODAL for Announcements -->
    <div id="detailModal" class="fixed inset-0 z-50 overflow-y-auto hidden p-4 flex items-center justify-center">
        <!-- Backdrop -->
        <div onclick="closeModal()" id="detailModalBackdrop" class="absolute inset-0 bg-slate-950/60 dark:bg-slate-950/80 backdrop-blur-sm opacity-0 transition-opacity duration-200 ease-out"></div>
        
        <!-- Modal Card -->
        <div id="detailModalCard" class="relative bg-white dark:bg-slate-900 rounded-3xl w-full max-w-2xl mx-auto my-8 overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 z-10 transform scale-95 opacity-0 transition-all duration-200 ease-out">
            <button onclick="closeModal()" class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 font-bold transition">
                &times;
            </button>
            <div id="modalImage" class="h-64 w-full bg-cover bg-center hidden"></div>
            <div class="p-6 sm:p-8 space-y-4">
                <div class="flex items-center gap-3">
                    <span id="modalCategory" class="text-xs px-2.5 py-1 rounded-full bg-blue-100 dark:bg-slate-800 text-brand-600 dark:text-blue-400 font-bold"></span>
                    <span id="modalDate" class="text-xs text-slate-400 font-english"></span>
                </div>
                <h3 id="modalTitle" class="text-2xl font-extrabold text-slate-950 dark:text-white leading-snug"></h3>
                <p id="modalContent" class="text-slate-605 dark:text-slate-350 text-sm leading-relaxed whitespace-pre-wrap"></p>
            </div>
            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-950 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3">
                <a id="modalUrlBtn" href="#" target="_blank" class="px-5 py-2 rounded-xl bg-brand-500 hover:bg-brand-600 text-white text-sm font-bold transition hidden">
                    <span class="lang-th">เปิดอ่านประกาศเต็ม</span>
                    <span class="lang-en hidden">Open Full Announcement</span>
                </a>
                <button onclick="closeModal()" class="px-5 py-2 rounded-xl bg-slate-200 hover:bg-slate-350 dark:bg-slate-850 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-bold transition">
                    <span class="lang-th">ปิดหน้าต่างนี้</span>
                    <span class="lang-en hidden">Close Window</span>
                </button>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <?php include 'login_modal.php'; ?>

    <!-- Page Logic -->
    <script>
        let allActivities = [];
        let currentAlbumImages = [];
        let currentLightboxIndex = 0;
        let allAnnouncements = [];
        let activeCategory = 'ทั้งหมด';

        // Switch between Activities and News tab
        function switchTab(tab) {
            const tabAct = document.getElementById('tab-activities');
            const tabNews = document.getElementById('tab-news');
            const secAct = document.getElementById('section-activities');
            const secNews = document.getElementById('section-news');

            if (tab === 'activities') {
                tabAct.className = "border-brand-500 text-brand-500 dark:border-blue-400 dark:text-blue-400 whitespace-nowrap py-4 px-1 border-b-2 font-bold text-base sm:text-lg transition-all focus:outline-none";
                tabNews.className = "border-transparent text-slate-500 hover:text-slate-705 whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-base sm:text-lg transition-all dark:text-slate-400 dark:hover:text-slate-300 focus:outline-none";
                secAct.classList.remove('hidden');
                secNews.classList.add('hidden');
                // Lazy load activities when tab is first activated
                loadActivitiesData();
            } else {
                tabNews.className = "border-brand-500 text-brand-500 dark:border-blue-400 dark:text-blue-400 whitespace-nowrap py-4 px-1 border-b-2 font-bold text-base sm:text-lg transition-all focus:outline-none";
                tabAct.className = "border-transparent text-slate-500 hover:text-slate-705 whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-base sm:text-lg transition-all dark:text-slate-400 dark:hover:text-slate-300 focus:outline-none";
                secNews.classList.remove('hidden');
                secAct.classList.add('hidden');
            }
        }

        // Fetch and load database files
        let activitiesLoaded = false;

        function loadData() {
            // Always load news announcements
            getDbNews(function(list) {
                allAnnouncements = list;
                const loader = document.getElementById('news-list')?.querySelector('.text-center');
                if (loader) loader.classList.add('hidden');
                renderNews();
            });

            // Only load activities if on activities tab (lazy load)
            const urlParams = new URLSearchParams(window.location.search);
            const tabParam = urlParams.get('tab') || '';
            if (!tabParam || tabParam === 'activities') {
                loadActivitiesData();
            }
        }

        let activeActivityYear = 'all';

        // Parse date to comparable timestamp and academic year
        const THAI_MONTHS_MAP = {
            'มกราคม': 1, 'กุมภาพันธ์': 2, 'มีนาคม': 3, 'เมษายน': 4,
            'พฤษภาคม': 5, 'มิถุนายน': 6, 'กรกฎาคม': 7, 'สิงหาคม': 8,
            'กันยายน': 9, 'ตุลาคม': 10, 'พฤศจิกายน': 11, 'ธันวาคม': 12
        };

        function parseActivityDate(item) {
            let y = 0, mo = 1, d = 1;

            // Priority 1: public_key in URL (format: 3 + YYYY + MM + DD + ...)
            const m = (item.url || '').match(/public_key=3(\d{4})(\d{2})(\d{2})/);
            if (m) {
                let yr = parseInt(m[1]);
                mo = parseInt(m[2]);
                d = parseInt(m[3]);
                // If year is CE (e.g. 2026), convert to BE (2569)
                y = yr < 2400 ? yr + 543 : yr;
            } else {
                // Priority 2: Thai date string e.g. "12 ตุลาคม 2569"
                const parts = (item.date || '').trim().split(/\s+/);
                if (parts.length >= 3) {
                    d = parseInt(parts[0]) || 1;
                    mo = THAI_MONTHS_MAP[parts[1]] || 1;
                    let yr = parseInt(parts[2]) || 2569;
                    y = yr < 2400 ? yr + 543 : yr;
                }
            }

            if (!y) y = 2569;
            const timestamp = new Date(y - 543, mo - 1, d).getTime();
            // Thai Academic Year: May (month 5) to April next year
            const acadYear = mo >= 5 ? y : y - 1;
            return { timestamp, acadYear };
        }

        function loadActivitiesData() {
            if (activitiesLoaded) return;
            activitiesLoaded = true;
            fetch('data/db_activities.json?v=' + Date.now())
                .then(res => res.json())
                .then(list => {
                    // Enrich items with timestamp and academic year, and sort latest first
                    allActivities = list.map((item, originalIndex) => {
                        const parsed = parseActivityDate(item);
                        return {
                            ...item,
                            originalIndex,
                            timestamp: parsed.timestamp,
                            acadYear: parsed.acadYear
                        };
                    });

                    // Sort reverse-chronologically (newest first)
                    allActivities.sort((a, b) => b.timestamp - a.timestamp);

                    // Build Year Filter UI dynamically
                    renderActivityYearFilters();
                    renderActivities();
                })
                .catch(err => {
                    console.error("Failed to load activities database:", err);
                });
        }

        function renderActivityYearFilters() {
            const container = document.getElementById('activities-year-filters');
            if (!container) return;

            // Get unique academic years sorted descending
            const years = [...new Set(allActivities.map(a => a.acadYear))].sort((a, b) => b - a);
            const currentLang = localStorage.getItem('ep_lang') || 'th';
            const isEn = currentLang === 'en';

            let html = `
                <button onclick="filterActivityYear('all')" id="act-year-all"
                    class="px-3.5 py-1.5 rounded-full font-bold transition text-xs sm:text-sm ${activeActivityYear === 'all' ? 'bg-brand-500 text-white shadow-sm' : 'bg-white text-slate-600 border border-slate-200 dark:bg-slate-900 dark:text-slate-300 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800'}">
                    <span>${isEn ? 'All Years' : 'ทุกปีการศึกษา'}</span>
                </button>
            `;

            years.forEach((yr, idx) => {
                const isActive = activeActivityYear === String(yr);
                const badge = idx === 0 ? ` <span class="text-[10px] uppercase px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 ml-1 font-extrabold">${isEn ? 'Latest' : 'ล่าสุด'}</span>` : '';
                const yrLabel = isEn ? `AY ${yr - 543}` : `ปีการศึกษา ${yr}`;
                html += `
                    <button onclick="filterActivityYear('${yr}')" id="act-year-${yr}"
                        class="px-3.5 py-1.5 rounded-full font-bold transition text-xs sm:text-sm flex items-center ${isActive ? 'bg-brand-500 text-white shadow-sm' : 'bg-white text-slate-600 border border-slate-200 dark:bg-slate-900 dark:text-slate-300 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800'}">
                        <span>${yrLabel}</span>
                        ${badge}
                    </button>
                `;
            });

            container.innerHTML = html;
        }

        function filterActivityYear(year) {
            activeActivityYear = String(year);
            renderActivityYearFilters();
            renderActivities();
        }

        // Render activities to grid
        function renderActivities() {
            const grid = document.getElementById('activities-grid');
            if (!grid) return;
            grid.innerHTML = '';

            const currentLang = localStorage.getItem('ep_lang') || 'th';
            const isEn = currentLang === 'en';

            const filteredList = activeActivityYear === 'all'
                ? allActivities
                : allActivities.filter(a => String(a.acadYear) === activeActivityYear);

            const countEl = document.getElementById('activities-count');
            if (countEl) {
                countEl.textContent = isEn
                    ? `${filteredList.length} Albums`
                    : `${filteredList.length} อัลบั้ม`;
            }

            if (filteredList.length === 0) {
                grid.innerHTML = `
                    <div class="col-span-full text-center py-12 text-slate-450 dark:text-slate-400">
                        <i class="fa-regular fa-image text-3xl mb-3"></i>
                        <p class="lang-th">ไม่พบอัลบั้มภาพกิจกรรมของปีการศึกษานี้</p>
                        <p class="lang-en hidden">No activity albums found for this academic year.</p>
                    </div>
                `;
                return;
            }

            grid.innerHTML = filteredList.map(item => {
                const photoCountText = isEn ? 'Photos' : 'รูป';
                const viewText = isEn ? 'View Photos' : 'ดูภาพกิจกรรม';
                const fallbackImg = 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=800&auto=format&fit=crop&q=60';
                // Vary aspect ratios for masonry variety
                const aspects = ['aspect-[3/2]', 'aspect-[4/5]', 'aspect-[16/9]', 'aspect-[1/1]', 'aspect-[3/4]', 'aspect-[4/3]'];
                const aspect = aspects[item.originalIndex % aspects.length];

                return `
                    <div onclick="openGalleryModal(${item.originalIndex})"
                         class="group relative cursor-pointer rounded-3xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/80 dark:border-slate-800 transition-all duration-300 break-inside-avoid mb-6 ${aspect}">

                        <!-- Cover Image -->
                        <img src="${item.imageUrl || fallbackImg}"
                             alt="${item.title}"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             onerror="this.src='${fallbackImg}'">

                        <!-- Top-left: EP badge + Academic Year -->
                        <div class="absolute top-3 left-3 flex items-center gap-1.5">
                            <span class="bg-brand-500 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-sm">
                                EP Activity
                            </span>
                            <span class="bg-slate-900/75 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm font-english">
                                ${isEn ? `AY ${item.acadYear - 543}` : `ปีการศึกษา ${item.acadYear}`}
                            </span>
                        </div>

                        <!-- Top-right: photo count -->
                        <div class="absolute top-3 right-3">
                            <span class="bg-slate-950/70 backdrop-blur-sm text-white text-xs font-semibold px-2.5 py-1 rounded-full flex items-center gap-1">
                                <i class="fa-regular fa-image"></i> ${item.photoCount} ${photoCountText}
                            </span>
                        </div>

                        <!-- Bottom overlay: title + date + CTA -->
                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-slate-950/90 via-slate-950/55 to-transparent p-5 pt-12 translate-y-1 group-hover:translate-y-0 transition-transform duration-300">
                            <div class="text-[11px] text-white/65 flex items-center gap-1 mb-1 font-english">
                                <i class="fa-regular fa-calendar"></i> ${item.date}
                            </div>
                            <h3 class="text-sm sm:text-base font-bold text-white line-clamp-2 leading-snug mb-3">${item.title}</h3>
                            <div class="inline-flex items-center gap-1.5 bg-white/15 group-hover:bg-brand-500 text-white text-xs font-semibold py-1.5 px-3 rounded-lg transition-colors backdrop-blur-sm border border-white/20 group-hover:border-transparent">
                                <i class="fa-regular fa-images"></i> ${viewText}
                            </div>
                        </div>
                    </div>
                `;
            }).join('');


            // ponytail: removed redundant updateLanguageUI call to prevent infinite loop with languageChanged event
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

        // Render news to list
        function renderNews() {
            const container = document.getElementById('news-list');
            
            const currentLang = localStorage.getItem('ep_lang') || 'th';
            const isEn = currentLang === 'en';

            const filtered = allAnnouncements.filter(item => {
                if (activeCategory === 'ทั้งหมด') return true;
                return item.category === activeCategory;
            });

            const countEl = document.getElementById('news-count');
            if (countEl) {
                countEl.textContent = isEn
                    ? `${filtered.length} Announcements`
                    : `${filtered.length} ประกาศ`;
            }
            
            if (filtered.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-12 text-slate-450 dark:text-slate-400">
                        <i class="fa-regular fa-newspaper text-3xl mb-3"></i>
                        <p class="lang-th">ไม่พบข่าวประกาศของ EP ในหมวดหมู่นี้ในขณะนี้</p>
                        <p class="lang-en hidden">No announcements found in this category.</p>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = filtered.map(item => {
                const title = isEn && item.title_en ? item.title_en : item.title;
                const content = isEn && item.content_en ? item.content_en : item.content;
                const openText = isEn ? 'Open Announcement' : 'เปิดไฟล์ประกาศ';

                return `
                    <div onclick="openModal(allAnnouncements[${allAnnouncements.indexOf(item)}])" class="group bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-all flex flex-col md:flex-row justify-between items-start md:items-center gap-4 cursor-pointer">
                        <div class="space-y-2 max-w-3xl">
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="bg-brand-500/5 text-brand-500 dark:text-blue-400 text-xs font-semibold px-2.5 py-0.5 rounded-md border border-brand-500/10">
                                    ${getTranslatedCategory(item.category)}
                                </span>
                                <span class="text-xs text-slate-450 dark:text-slate-400 flex items-center gap-1 font-english">
                                    <i class="fa-regular fa-calendar"></i> ${item.date}
                                </span>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-slate-850 dark:text-white group-hover:text-brand-500 dark:group-hover:text-blue-400 transition-colors">
                                ${title}
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-light line-clamp-2">
                                ${content}
                            </p>
                        </div>
                        ${item.url ? `
                        <a href="${item.url}" target="_blank" onclick="event.stopPropagation()"
                           class="inline-flex items-center gap-1.5 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold py-2.5 px-5 rounded-xl transition-all shadow-sm flex-shrink-0 w-full md:w-auto justify-center">
                            <span>${openText}</span>
                            <i class="fa-solid fa-file-pdf"></i>
                        </a>` : ''}
                    </div>
                `;
            }).join('');

            // ponytail: removed redundant updateLanguageUI call to prevent infinite loop with languageChanged event
        }

        function filterCategory(category) {
            activeCategory = category;
            
            const filters = ['all', 'admissions', 'awards', 'activities'];
            const labels = ['ทั้งหมด', 'รับสมัครเรียน', 'ผลงานนักเรียน', 'กิจกรรม'];
            
            labels.forEach((lbl, idx) => {
                const btn = document.getElementById(`filter-${filters[idx]}`);
                if (btn) {
                    if (lbl === category) {
                        btn.className = "px-4 py-1.5 rounded-full font-bold bg-brand-500 text-white shadow-sm transition focus:outline-none";
                    } else {
                        btn.className = "px-4 py-1.5 rounded-full font-bold bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-800 transition hover:bg-slate-50 dark:hover:bg-slate-800 focus:outline-none";
                    }
                }
            });

            renderNews();
        }

        // --- Gallery Modal & Lightbox Logic ---
        function openGalleryModal(idx) {
            const album = allActivities[idx];
            if (!album) return;

            document.getElementById('galleryModalTitle').textContent = album.title;
            document.getElementById('galleryModalDate').textContent = album.date;
            
            const countText = localStorage.getItem('ep_lang') === 'en'
                ? `Total ${album.photoCount} photos`
                : `รูปภาพทั้งหมด ${album.photoCount} รูป`;
            document.getElementById('galleryModalCount').textContent = countText;

            const origLink = document.getElementById('galleryModalOriginalLink');
            if (origLink) {
                origLink.href = album.url;
            }

            const grid = document.getElementById('galleryModalGrid');
            grid.innerHTML = '';

            currentAlbumImages = album.images || [];

            if (currentAlbumImages.length === 0) {
                grid.innerHTML = `
                    <div class="col-span-full text-center py-12 text-slate-500 dark:text-slate-400">
                        <i class="fa-regular fa-image text-3xl mb-2"></i>
                        <p class="lang-th">ไม่มีรูปภาพในอัลบั้มนี้</p>
                        <p class="lang-en hidden">No images in this album.</p>
                    </div>
                `;
            } else {
                // Vary aspect ratios for masonry variety inside the album
                const aspects = ['aspect-[4/3]', 'aspect-[3/4]', 'aspect-[1/1]', 'aspect-[4/3]', 'aspect-[16/9]', 'aspect-[3/4]'];

                currentAlbumImages.forEach((imgUrl, imgIdx) => {
                    const thumbDiv = document.createElement('div');
                    const aspect = aspects[imgIdx % aspects.length];
                    thumbDiv.className = `group relative ${aspect} rounded-2xl overflow-hidden bg-slate-100 dark:bg-slate-800 cursor-pointer shadow-sm hover:shadow-lg transition duration-200 break-inside-avoid mb-3`;
                    thumbDiv.onclick = () => openLightbox(imgIdx);

                    thumbDiv.innerHTML = `
                        <img src="${imgUrl}" alt="Photo ${imgIdx + 1}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/25 transition-colors duration-200 flex items-center justify-center">
                            <span class="text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-200 drop-shadow-lg"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                        </div>
                        <span class="absolute bottom-2 right-2 bg-slate-950/60 text-white text-[10px] font-semibold px-1.5 py-0.5 rounded-md opacity-0 group-hover:opacity-100 transition-opacity">${imgIdx + 1}</span>
                    `;
                    grid.appendChild(thumbDiv);
                });
            }

            const modal = document.getElementById('galleryModal');
            const backdrop = document.getElementById('galleryModalBackdrop');
            const card = document.getElementById('galleryModalCard');
            if (modal && backdrop && card) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                    card.classList.remove('scale-95', 'opacity-0');
                    card.classList.add('scale-100', 'opacity-100');
                }, 10);
            }
            
            if (typeof updateLanguageUI === 'function') {
                updateLanguageUI();
            }
        }

        function closeGalleryModal() {
            const modal = document.getElementById('galleryModal');
            const backdrop = document.getElementById('galleryModalBackdrop');
            const card = document.getElementById('galleryModalCard');
            if (modal && backdrop && card) {
                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0');
                card.classList.remove('scale-100', 'opacity-100');
                card.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 200);
            }
        }

        // --- Fullscreen Lightbox Logic ---
        function openLightbox(imgIdx) {
            currentLightboxIndex = imgIdx;
            updateLightbox();
            const overlay = document.getElementById('lightboxOverlay');
            if (overlay) {
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.remove('opacity-0');
                    overlay.classList.add('opacity-100');
                }, 10);
            }
            document.addEventListener('keydown', handleLightboxKeydown);
        }

        function closeLightbox() {
            const overlay = document.getElementById('lightboxOverlay');
            if (overlay) {
                overlay.classList.remove('opacity-100');
                overlay.classList.add('opacity-0');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 200);
            }
            document.removeEventListener('keydown', handleLightboxKeydown);
        }

        function updateLightbox() {
            const imgUrl = currentAlbumImages[currentLightboxIndex];
            const imgEl = document.getElementById('lightboxImg');
            if (imgEl && imgUrl) {
                imgEl.src = imgUrl;
            }

            const total = currentAlbumImages.length;
            const indexText = `${currentLightboxIndex + 1} / ${total}`;
            document.getElementById('lightboxIndex').textContent = indexText;
            
            const albumTitle = document.getElementById('galleryModalTitle').textContent;
            document.getElementById('lightboxCaption').textContent = `${albumTitle} - รูปที่ ${currentLightboxIndex + 1}`;
        }

        function nextLightboxImage() {
            if (currentAlbumImages.length === 0) return;
            currentLightboxIndex = (currentLightboxIndex + 1) % currentAlbumImages.length;
            updateLightbox();
        }

        function prevLightboxImage() {
            if (currentAlbumImages.length === 0) return;
            currentLightboxIndex = (currentLightboxIndex - 1 + currentAlbumImages.length) % currentAlbumImages.length;
            updateLightbox();
        }

        function handleLightboxKeydown(e) {
            if (e.key === 'ArrowRight') {
                nextLightboxImage();
            } else if (e.key === 'ArrowLeft') {
                prevLightboxImage();
            } else if (e.key === 'Escape') {
                closeLightbox();
            }
        }

        // --- News Announcement Detail Modal ---
        function openModal(item) {
            const modal = document.getElementById('detailModal');
            const backdrop = document.getElementById('detailModalBackdrop');
            const card = document.getElementById('detailModalCard');
            const img = document.getElementById('modalImage');
            const cat = document.getElementById('modalCategory');
            const date = document.getElementById('modalDate');
            const title = document.getElementById('modalTitle');
            const content = document.getElementById('modalContent');
            const urlBtn = document.getElementById('modalUrlBtn');

            if (item.imageUrl) {
                img.style.backgroundImage = `url('${item.imageUrl}')`;
                img.classList.remove('hidden');
            } else {
                img.classList.add('hidden');
            }

            if (urlBtn) {
                if (item.url) {
                    urlBtn.href = item.url;
                    urlBtn.classList.remove('hidden');
                } else {
                    urlBtn.classList.add('hidden');
                }
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
            if (modal && backdrop && card) {
                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0');
                card.classList.remove('scale-100', 'opacity-100');
                card.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 200);
            }
        }

        window.addEventListener('languageChanged', () => {
            renderActivities(allActivities);
            renderNews();
        });

        // Initialize loading
        loadData();

        // Support routing via tab query parameter or hash
        const urlParams = new URLSearchParams(window.location.search);
        const tabParam = urlParams.get('tab') || window.location.hash.replace('#', '');
        if (tabParam === 'news' || tabParam === 'announcements') {
            switchTab('news');
        } else if (tabParam === 'activities') {
            switchTab('activities');
        }
    </script>
</body>
</html>
