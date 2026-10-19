<?php
$pageTitle = "ทำเนียบเกียรติยศและหมุดหมายความสำเร็จ (EP Hall of Fame) | English Program CPW";
$currentPage = "awards";

$awardsJsonPath = __DIR__ . '/data/db_awards.json';
$awardsData = file_exists($awardsJsonPath) ? json_decode(file_get_contents($awardsJsonPath), true) : null;
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <?php include 'head.php'; ?>
    <style>
        :root {
            --ease-out-craft: cubic-bezier(0.23, 1, 0.32, 1);
            --ease-in-out-craft: cubic-bezier(0.77, 0, 0.175, 1);
        }

        html { 
            scroll-behavior: smooth; 
            font-size: 17px; 
            -webkit-text-size-adjust: 100%;
        }

        /* 1. มาตรฐานการตัดคำภาษาไทยระดับโมเดิร์น (Modern Thai Typography & Word Breaking) */
        body, p, span, div, td, th, li, a {
            /* ใช้ word-break: normal เพื่อให้เบราว์เซอร์ตัดตามพจนานุกรมคำภาษาไทย ไม่ฉีกกลางพยางค์ */
            word-break: normal !important;
            line-break: normal !important;
            /* ตัดคำแบบฉุกเฉินเฉพาะคำที่ยาวเกินขอบกล่องจริง เช่น ลิงก์ URL ยาวๆ */
            overflow-wrap: break-word !important;
            /* จัดความยาวแต่ละบรรทัดให้พอดี ไม่ให้มีคำเดี่ยวตกไปบรรทัดใหม่ (No orphan words) */
            text-wrap: pretty;
        }

        /* 2. หัวข้อ หัวเรื่อง ให้บาลานซ์ความยาวบรรทัดอย่างสมมาตร */
        h1, h2, h3, h4, h5, h6, .text-balance {
            text-wrap: balance !important;
            word-break: normal !important;
            line-break: normal !important;
        }

        /* 3. ล็อกคำเฉพาะที่ไม่ควรตัดขึ้นบรรทัดใหม่เด็ดขาด (ชื่อ-สกุล, ชั้นเรียน, ป้ายรางวัล, วันที่) */
        .medal-badge, .badge, th, .btn-print-sar, #yearTabsNav button, 
        .view-switcher button, .whitespace-nowrap, .room-badge {
            word-break: keep-all !important;
            white-space: nowrap !important;
        }

        /* Scrollbars */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        .dark ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }

        /* Navigation & Card Hover Effects */
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
            background-color: #db2777;
            transition: width 0.2s var(--ease-out-craft);
        }
        .nav-link-sisb:hover::after, .nav-link-sisb.active::after {
            width: 100%;
        }

        .award-card, .card-hover-sisb {
            transition: transform 0.25s var(--ease-out-craft), box-shadow 0.25s var(--ease-out-craft), border-color 0.2s;
        }
        .award-card:hover, .card-hover-sisb:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px -10px rgba(124, 58, 237, 0.12);
        }

        .hero-slide {
            transition: opacity 500ms var(--ease-out-craft) !important;
        }

        .medal-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
        }

        /* 4. กฎสำหรับเครื่องพิมพ์ (Print CSS) */
        @media print {
            /* 1. ซ่อน UI เว็บไซต์ทั้งหมดอย่างเด็ดขาด (แถบเมนู, แบนเนอร์หัวเว็บ Hero Header, เนื้อหาหลัก, ท้ายเว็บ, วิดเจ็ตแชท, โมดอล) */
            body > :not(#officialSarPrintContainer),
            nav, section, main, footer, header,
            #ep-chat-widget, #photoModal, #awardDetailModal, #sarPrintModal,
            .btn-print-hide, .no-print, .hero-bg, #yearTabsNav, .filter-controls, .view-switcher {
                display: none !important;
                visibility: hidden !important;
                height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                overflow: hidden !important;
            }

            @page {
                size: A4 portrait;
                margin: 10mm 12mm 12mm 12mm;
            }

            html, body {
                background: #fff !important;
                color: #000 !important;
                font-family: 'Sarabun', 'Inter', sans-serif !important;
                font-size: 10pt !important;
                line-height: 1.35 !important;
                padding: 0 !important;
                margin: 0 !important;
                height: auto !important;
                min-height: 0 !important;
            }

            /* 2. แสดงเฉพาะเอกสารทางการสำหรับเข้าเล่ม SAR เท่านั้น */
            #officialSarPrintContainer {
                display: block !important;
                visibility: visible !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .sar-print-table {
                width: 100% !important;
                border-collapse: collapse !important;
                margin-top: 10px !important;
                margin-bottom: 14px !important;
            }

            .sar-print-table thead {
                display: table-header-group !important;
            }

            .sar-print-table tr {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            .sar-print-table th, .sar-print-table td {
                border: 1px solid #334155 !important;
                padding: 4px 6px !important;
                font-size: 8.5pt !important;
                color: #000 !important;
            }

            .sar-print-table th {
                background-color: #f1f5f9 !important;
                font-weight: 700 !important;
                text-align: center !important;
            }

            .page-break-before {
                page-break-before: always !important;
                break-before: always !important;
            }

            .page-break-avoid {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans transition-colors duration-300 dark:bg-slate-900 dark:text-slate-100 min-h-screen flex flex-col">

    <?php include 'header.php'; ?>

    <!-- HERO HEADER SECTION -->
    <section class="relative bg-gradient-to-b from-blue-950 via-slate-900 to-slate-900 text-white py-16 sm:py-20 overflow-hidden border-b border-slate-800">
        <div class="absolute inset-0 bg-[radial-gradient(#38bdf8_1px,transparent_1px)] [background-size:24px_24px] opacity-10 pointer-events-none"></div>
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-6 text-center">
            
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-500/15 border border-blue-400/30 text-blue-300 text-xs sm:text-sm font-bold tracking-wide">
                <span>🌟</span>
                <span class="lang-th">น้อมนำความเป็นไทย ใส่ใจวิชาการ เชี่ยวชาญสู่สากล</span>
                <span class="lang-en hidden">Thai Culture, Academic Excellence, Global Standard</span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight max-w-4xl mx-auto">
                <span class="lang-th">🏆 ทำเนียบเกียรติยศและสรุปเวทีสร้างชื่อเสียงนักเรียน EP</span>
                <span class="lang-en hidden">🏆 EP Hall of Fame & Student Achievements</span>
            </h1>

            <p class="text-sm sm:text-base text-slate-300 max-w-3xl mx-auto font-normal leading-relaxed">
                <span class="lang-th">โครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ (English Program : EP) โรงเรียนชลประทานวิทยา รวบรวมหมุดหมายความสำเร็จและเวทีสร้างชื่อเสียงระดับชาติและระดับนานาชาติ</span>
                <span class="lang-en hidden">Celebrating outstanding achievements and competition honors earned by our students across national and international arenas.</span>
            </p>

            <!-- Multi-Year Impact Ribbon -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 max-w-4xl mx-auto pt-6">
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-4 text-center">
                    <div class="text-2xl sm:text-3xl font-black text-amber-400">250+</div>
                    <div class="text-xs sm:text-sm font-medium text-slate-300 mt-1">
                        <span class="lang-th">รางวัลสะสม 3 ปีการศึกษา</span>
                        <span class="lang-en hidden">Total Awards (3 Yrs)</span>
                    </div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-4 text-center">
                    <div class="text-2xl sm:text-3xl font-black text-sky-400">27</div>
                    <div class="text-xs sm:text-sm font-medium text-slate-300 mt-1">
                        <span class="lang-th">🌍 เวทีระดับนานาชาติ</span>
                        <span class="lang-en hidden">International Honors</span>
                    </div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-4 text-center">
                    <div class="text-2xl sm:text-3xl font-black text-blue-400">163</div>
                    <div class="text-xs sm:text-sm font-medium text-slate-300 mt-1">
                        <span class="lang-th">🇹🇭 เวทีระดับประเทศ</span>
                        <span class="lang-en hidden">National Honors</span>
                    </div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-4 text-center">
                    <div class="text-2xl sm:text-3xl font-black text-emerald-400">45+</div>
                    <div class="text-xs sm:text-sm font-medium text-slate-300 mt-1">
                        <span class="lang-th">🥇 เหรียญทอง & ชนะเลิศ</span>
                        <span class="lang-en hidden">Gold & Champions</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- MAIN INTERACTIVE SECTION -->
    <main class="flex-grow max-w-[1400px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

        <!-- YEAR TABS BAR -->
        <div class="flex items-center justify-between flex-wrap gap-4 border-b border-slate-200 dark:border-slate-800 pb-4">
            <!-- Year Selector Tabs -->
            <div class="flex flex-wrap gap-2 sm:gap-3" id="yearTabsNav">
                <button onclick="switchYearTab('2569')" id="tabBtn-2569" class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all bg-brand-500 text-white shadow-md shadow-brand-500/20">
                    <span class="lang-th">ปีการศึกษา 2569 (ปัจจุบัน)</span>
                    <span class="lang-en hidden">A.Y. 2569 (Current)</span>
                </button>
                <button onclick="switchYearTab('2568')" id="tabBtn-2568" class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all bg-slate-100 hover:bg-slate-200 text-slate-700 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-300">
                    <span class="lang-th">ปีการศึกษา 2568 (สรุป 196 รางวัล)</span>
                    <span class="lang-en hidden">A.Y. 2568 (196 Awards)</span>
                </button>
                <button onclick="switchYearTab('2567')" id="tabBtn-2567" class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all bg-slate-100 hover:bg-slate-200 text-slate-700 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-300">
                    <span class="lang-th">ปีการศึกษา 2567 (20 รายการ)</span>
                    <span class="lang-en hidden">A.Y. 2567 (20 Records)</span>
                </button>
                <button onclick="switchYearTab('compare')" id="tabBtn-compare" class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all bg-purple-50 hover:bg-purple-100 text-purple-700 border border-purple-200 dark:bg-purple-950/30 dark:hover:bg-purple-900/40 dark:text-purple-300 dark:border-purple-800/40">
                    <span class="lang-th">📊 เปรียบเทียบ 3 ปีการศึกษา (SAR Matrix)</span>
                    <span class="lang-en hidden">📊 Multi-Year Comparison</span>
                </button>
            </div>

                        <!-- Official SAR Print Action Button -->
            <button onclick="printOfficialSARReport()" title="พิมพ์เอกสารรายงาน SAR ทางการพร้อมช่องลงลายมือชื่อสำหรับเข้าแฟ้มสารสนเทศ" class="btn-print-sar flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 hover:bg-black text-white dark:bg-slate-100 dark:hover:bg-white dark:text-slate-900 font-bold text-xs shadow-md transition-all hover:scale-[1.02] active:scale-[0.98] border border-slate-700/40 cursor-pointer">
                <span>🖨️</span>
                <span class="lang-th">พิมพ์รายงาน SAR เข้าเล่ม</span>
                <span class="lang-en hidden">Print SAR Report</span>
            </button>
            <!-- View Switcher (Cards vs Table) -->
            <div class="view-switcher flex items-center bg-slate-200/80 dark:bg-slate-800/80 p-1 rounded-xl">
                <button onclick="setViewMode('cards')" id="btnViewCards" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all bg-white dark:bg-slate-900 text-brand-500 dark:text-blue-400 shadow-sm">
                    <span>🎴</span>
                    <span class="lang-th">การ์ดภาพ</span>
                    <span class="lang-en hidden">Cards</span>
                </button>
                <button onclick="setViewMode('table')" id="btnViewTable" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all">
                    <span>📋</span>
                    <span class="lang-th">ตาราง SAR</span>
                    <span class="lang-en hidden">Table</span>
                </button>
            </div>
        </div>

        <!-- SEARCH & FILTER TOOLBAR (For 2569 & 2567) -->
        <div id="filterToolbar" class="filter-controls bg-white dark:bg-slate-950 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-4 shadow-sm flex flex-wrap gap-3 items-center justify-between">
            <div class="flex-1 min-w-[260px]">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">🔍</span>
                    <input type="text" id="searchInput" oninput="applyFilters()" placeholder="ค้นหาชื่อนักเรียน, เลขห้อง (เช่น ป.5/14, ม.6/11), รายการแข่ง, หรือสถานที่..." class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 text-slate-900 dark:text-white placeholder-slate-400">
                </div>
            </div>

            <div class="flex flex-wrap gap-2.5 items-center">
                <!-- Category Select -->
                <select id="categorySelect" onchange="applyFilters()" class="px-3.5 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-xs sm:text-sm font-medium text-slate-700 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="">🎯 ทุกหมวดหมู่ (All)</option>
                    <option value="วิชาการ">วิชาการ & ภาษา</option>
                    <option value="กีฬา">กีฬา</option>
                    <option value="ดนตรี">ดนตรี & ศิลปะ</option>
                    <option value="วิทยาศาสตร์">วิทยาศาสตร์</option>
                </select>

                <!-- Level Select -->
                <select id="levelSelect" onchange="applyFilters()" class="px-3.5 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-xs sm:text-sm font-medium text-slate-700 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="">🏆 ทุกระดับ (All Levels)</option>
                    <option value="นานาชาติ">🌍 ระดับนานาชาติ (International)</option>
                    <option value="ระดับประเทศ">🇹🇭 ระดับประเทศ (National)</option>
                    <option value="ระดับจังหวัด">🏢 ระดับจังหวัด / เขต (Provincial)</option>
                    <option value="สโมสร">🥋 สโมสร / เปิดกว้าง (Open/Club)</option>
                    <option value="ภายใน">🏛️ ภายในโครงการ EP (Internal)</option>
                </select>
            </div>
        </div>

        <!-- ACTIVE FILTER STATUS INDICATOR -->
        <div id="filterStatus" class="hidden flex items-center justify-between bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800/60 rounded-xl px-4 py-2.5 text-xs text-blue-800 dark:text-blue-300">
            <span id="filterStatusText">ผลการค้นหา</span>
            <button onclick="clearAllFilters()" class="font-bold underline hover:no-underline">↺ ล้างตัวกรองทั้งหมด</button>
        </div>

        <!-- CONTENT VIEWS WRAPPER -->
        
        <!-- 1. VISUAL CARDS GRID (Default View) -->
        <div id="cardsViewContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Cards will be populated dynamically by JavaScript -->
        </div>

        <!-- 2. SAR TABLE VIEW (Structured Report) -->
        <div id="tableViewContainer" class="hidden overflow-x-auto bg-white dark:bg-slate-950 border border-slate-200/80 dark:border-slate-800 rounded-2xl shadow-sm">
            <table class="w-full text-left text-xs sm:text-sm border-collapse">
                <thead>
                    <tr class="bg-slate-100 dark:bg-slate-900/80 border-b border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 uppercase font-bold text-[11px] tracking-wider">
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">ปีการศึกษา</th>
                        <th class="py-3 px-4">นักเรียน (ไทย / EN)</th>
                        <th class="py-3 px-4">ห้อง</th>
                        <th class="py-3 px-4">รายการแข่งขัน/กิจกรรม</th>
                        <th class="py-3 px-4">สถานที่ / เวที (Venue)</th>
                        <th class="py-3 px-4">ระดับ</th>
                        <th class="py-3 px-4">รางวัลที่ได้รับ</th>
                        <th class="py-3 px-4 btn-print-hide">หลักฐาน</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-slate-100 dark:divide-slate-800/60 text-slate-800 dark:text-slate-200">
                    <!-- Table rows populated dynamically -->
                </tbody>
            </table>
        </div>

        <!-- 3. YEAR 2568 SAR SUMMARY VIEW -->
        <div id="summary2568Container" class="hidden space-y-6">
            <div class="bg-white dark:bg-slate-950 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between flex-wrap gap-4 border-b border-slate-100 dark:border-slate-800 pb-4">
                    <div>
                        <span class="inline-block px-2.5 py-1 rounded-md bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-xs font-bold uppercase tracking-wider mb-1">Official SAR Summary Matrix</span>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white">
                            <span class="lang-th">สรุปผลงานและรางวัลนักเรียน ปีการศึกษา 2568 (รวม 196 รางวัล)</span>
                            <span class="lang-en hidden">Academic Year 2568 Honors Summary (196 Awards)</span>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">
                            จำแนกตาม 6 กลุ่มสาระการเรียนรู้และระดับการแข่งขัน สำหรับรายงานการประเมินตนเองของสถานศึกษา (SAR)
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-black text-brand-500 dark:text-blue-400">196</div>
                        <div class="text-xs text-slate-500">รางวัลสุทธิทั้งปี</div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm border-collapse">
                        <thead>
                            <tr class="bg-slate-100 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-bold text-xs uppercase">
                                <th class="py-3 px-4">กลุ่มสาระการเรียนรู้ / กิจกรรม</th>
                                <th class="py-3 px-4 text-center text-sky-600 dark:text-sky-400">🌍 นานาชาติ</th>
                                <th class="py-3 px-4 text-center text-amber-600 dark:text-amber-400">🇹🇭 ระดับประเทศ</th>
                                <th class="py-3 px-4 text-center text-purple-600 dark:text-purple-400">🏢 ระดับภาค</th>
                                <th class="py-3 px-4 text-center text-emerald-600 dark:text-emerald-400">📍 จังหวัด/พื้นที่</th>
                                <th class="py-3 px-4 text-right font-black text-slate-900 dark:text-white">ยอดรวมสุทธิ</th>
                            </tr>
                        </thead>
                        <tbody id="summary2568TableBody" class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-800 dark:text-slate-200">
                            <!-- Populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 4. MULTI-YEAR SAR COMPARISON MATRIX -->
        <div id="compareViewContainer" class="hidden space-y-6">
            <div class="bg-white dark:bg-slate-950 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-6 shadow-sm space-y-6">
                <div>
                    <span class="inline-block px-2.5 py-1 rounded-md bg-purple-500/10 text-purple-600 dark:text-purple-400 text-xs font-bold uppercase tracking-wider mb-1">Executive 3-Year Trend Analysis</span>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white">
                        <span class="lang-th">📊 สถิติเปรียบเทียบผลงานย้อนหลัง 3 ปีการศึกษา (2567 - 2569)</span>
                        <span class="lang-en hidden">Multi-Year Comparative Performance (2567 - 2569)</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">
                        แสดงพัฒนาการและความสำเร็จต่อเนื่องของนักเรียนโครงการฯ ภาคภาษาอังกฤษ โรงเรียนชลประทานวิทยา
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm border-collapse">
                        <thead>
                            <tr class="bg-slate-100 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 font-bold text-slate-700 dark:text-slate-300 text-xs">
                                <th class="py-3.5 px-4">ระดับการแข่งขัน (Level of Achievement)</th>
                                <th class="py-3.5 px-4 text-center bg-slate-50/80 dark:bg-slate-850">ปี 2567</th>
                                <th class="py-3.5 px-4 text-center bg-blue-50/50 dark:bg-blue-950/20 text-brand-500 dark:text-blue-400">ปี 2568</th>
                                <th class="py-3.5 px-4 text-center bg-emerald-50/50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 font-black">ปี 2569 (ปัจจุบัน)</th>
                                <th class="py-3.5 px-4 text-right font-black">ยอดรวม 3 ปี</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-800 dark:text-slate-200">
                            <tr>
                                <td class="py-3.5 px-4 font-bold flex items-center gap-2">
                                    <span>🌍</span> ระดับนานาชาติ (International)
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold">6</td>
                                <td class="py-3.5 px-4 text-center font-bold text-brand-500 dark:text-blue-400">12</td>
                                <td class="py-3.5 px-4 text-center font-bold text-emerald-600 dark:text-emerald-400">9</td>
                                <td class="py-3.5 px-4 text-right font-black text-sky-600 dark:text-sky-400">27 รายการ</td>
                            </tr>
                            <tr>
                                <td class="py-3.5 px-4 font-bold flex items-center gap-2">
                                    <span>🇹🇭</span> ระดับประเทศ (National)
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold">9</td>
                                <td class="py-3.5 px-4 text-center font-bold text-brand-500 dark:text-blue-400">148</td>
                                <td class="py-3.5 px-4 text-center font-bold text-emerald-600 dark:text-emerald-400">6</td>
                                <td class="py-3.5 px-4 text-right font-black text-blue-600 dark:text-blue-400">163 รายการ</td>
                            </tr>
                            <tr>
                                <td class="py-3.5 px-4 font-bold flex items-center gap-2">
                                    <span>🏢</span> ระดับภาค / เขตพื้นที่ (Regional / Area)
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold">-</td>
                                <td class="py-3.5 px-4 text-center font-bold text-brand-500 dark:text-blue-400">4</td>
                                <td class="py-3.5 px-4 text-center font-bold text-emerald-600 dark:text-emerald-400">-</td>
                                <td class="py-3.5 px-4 text-right font-black">4 รายการ</td>
                            </tr>
                            <tr>
                                <td class="py-3.5 px-4 font-bold flex items-center gap-2">
                                    <span>📍</span> ระดับจังหวัด / สโมสรเปิดกว้าง (Provincial / Open Club)
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold">3</td>
                                <td class="py-3.5 px-4 text-center font-bold text-brand-500 dark:text-blue-400">32</td>
                                <td class="py-3.5 px-4 text-center font-bold text-emerald-600 dark:text-emerald-400">20</td>
                                <td class="py-3.5 px-4 text-right font-black">55 รายการ</td>
                            </tr>
                            <tr>
                                <td class="py-3.5 px-4 font-bold flex items-center gap-2">
                                    <span>🏛️</span> ภายในโครงการ EP (Internal Honors)
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold">-</td>
                                <td class="py-3.5 px-4 text-center font-bold text-brand-500 dark:text-blue-400">-</td>
                                <td class="py-3.5 px-4 text-center font-bold text-emerald-600 dark:text-emerald-400">7</td>
                                <td class="py-3.5 px-4 text-right font-black text-purple-600 dark:text-purple-400">7 รายการ</td>
                            </tr>
                            <tr class="bg-slate-50 dark:bg-slate-900/60 font-black text-sm text-slate-900 dark:text-white">
                                <td class="py-4 px-4 font-black">ยอดรวมทั้งหมด (Total Annual Honors)</td>
                                <td class="py-4 px-4 text-center font-black">18</td>
                                <td class="py-4 px-4 text-center font-black text-brand-500 dark:text-blue-400">196</td>
                                <td class="py-4 px-4 text-center font-black text-emerald-600 dark:text-emerald-400">42</td>
                                <td class="py-4 px-4 text-right font-black text-amber-500 dark:text-amber-400 text-base">256 รายการ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <?php include 'footer.php'; ?>

    <!-- EMBEDDED REAL-TIME DATA & LOGIC -->
    <script>
        let AWARDS_DB = null;
        <?php
        if (!empty($awardsData)) {
            echo "AWARDS_DB = " . json_encode($awardsData, JSON_UNESCAPED_UNICODE) . ";\n";
        }
        ?>
        let currentYear = '2569';
        let currentView = 'cards';

        
        let activeRecordsList = [];

        function openAwardDetail(idx) {
            const r = activeRecordsList[idx];
            if (!r) return;

            const modal = document.getElementById('awardDetailModal');
            if (!modal) return;

            document.getElementById('modalDetailYear').innerText = `ปีการศึกษา ${r.academicYear || currentYear}`;
            document.getElementById('modalDetailLevel').innerText = r.level ? r.level.split(' ')[0] : 'ผลงานนักเรียน';
            
            document.getElementById('modalDetailStudentTh').innerText = r.studentNameTh || '-';
            document.getElementById('modalDetailStudentEn').innerText = (r.studentNameEn && r.studentNameEn !== '-') ? r.studentNameEn : '';
            document.getElementById('modalDetailRoom').innerText = r.room || 'EP';
            document.getElementById('modalDetailStudentId').innerText = (r.studentId && r.studentId !== '-') ? `รหัส: ${r.studentId}` : '';

            // Bind Student Portrait
            const portraitImg = document.getElementById('modalDetailStudentPortrait');
            const portraitFallback = document.getElementById('modalDetailStudentAvatarFallback');
            const avatarBox = document.getElementById('modalDetailStudentAvatarBox');
            if (avatarBox && portraitImg && portraitFallback) {
                if (r.studentId && r.studentId !== '-') {
                    avatarBox.classList.remove('hidden');
                    portraitImg.classList.remove('hidden');
                    portraitFallback.classList.add('hidden');
                    portraitImg.src = `img/students/${r.studentId}.jpg`;
                    portraitImg.onerror = function() {
                        this.onerror = null;
                        this.src = `https://app.cpw.ac.th/cpw_api_content/images/student/${r.studentId}.jpg`;
                        this.onerror = function() {
                            portraitImg.classList.add('hidden');
                            portraitFallback.classList.remove('hidden');
                            portraitFallback.innerText = 'EP';
                        };
                    };
                } else {
                    avatarBox.classList.remove('hidden');
                    portraitImg.classList.add('hidden');
                    portraitFallback.classList.remove('hidden');
                    portraitFallback.innerHTML = '<span style="font-size:16px;">👥</span><br><span style="font-size: 8px; line-height: 1;">คณะนักเรียน</span>';
                }
            }

            document.getElementById('modalDetailComp').innerText = r.competition || '-';
            document.getElementById('modalDetailVenue').innerText = r.venue || 'โรงเรียนชลประทานวิทยา';
            document.getElementById('modalDetailCategory').innerText = r.category || 'วิชาการและทักษะภาษา';
            document.getElementById('modalDetailMedal').innerText = r.medalsSummary || 'เกียรติบัตร / รางวัล';
            document.getElementById('modalDetailDate').innerText = r.dateFormatted || `ปีการศึกษา ${r.academicYear}`;
            document.getElementById('modalDetailScope').innerText = r.scope || r.level || '-';

            const imgBox = document.getElementById('modalDetailImageBox');
            const imgEl = document.getElementById('modalDetailImage');
            const noImgPlaceholder = document.getElementById('modalDetailNoImage');
            const zoomBtn = document.getElementById('modalDetailZoomBtn');

            if (r.imageUrl) {
                imgEl.src = r.imageUrl;
                imgBox.classList.remove('hidden');
                noImgPlaceholder.classList.add('hidden');
                zoomBtn.onclick = () => openPhotoModal(r.imageUrl, r.studentNameTh, r.competition);
            } else {
                imgBox.classList.add('hidden');
                noImgPlaceholder.classList.remove('hidden');
            }

            const refBtn = document.getElementById('modalDetailRefBtn');
            if (r.referenceUrl && r.referenceUrl !== '-') {
                refBtn.href = r.referenceUrl;
                refBtn.classList.remove('hidden');
            } else {
                refBtn.classList.add('hidden');
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeAwardDetail() {
            const modal = document.getElementById('awardDetailModal');
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        
        function printOfficialSARReport() {
            openSarPrintModal();
        }

        function openSarPrintModal() {
            const modal = document.getElementById('sarPrintModal');
            if (!modal) {
                generateOfficialSARPrintContent({ scope: 'external', showPhotos: true });
                setTimeout(() => window.print(), 150);
                return;
            }
            updateSarModalSummary();
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeSarPrintModal() {
            const modal = document.getElementById('sarPrintModal');
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function updateSarModalSummary() {
            if (!AWARDS_DB) return;
            const scopeEl = document.querySelector('input[name="sarScope"]:checked');
            const scope = scopeEl ? scopeEl.value : 'external';
            
            const countEl = document.getElementById('sarModalRecordCount');
            if (currentYear === '2568') {
                if (countEl) countEl.innerText = '196 รายการ (ภาพรวม 8 กลุ่มสาระฯ)';
                return;
            } else if (currentYear === 'compare') {
                if (countEl) countEl.innerText = 'สถิติภาพรวม 3 ปีการศึกษา';
                return;
            }

            let records = [];
            if (currentYear === '2569') records = AWARDS_DB.records2569 || [];
            else if (currentYear === '2567') records = AWARDS_DB.records2567 || [];

            let filtered = records;
            if (scope === 'external') {
                filtered = records.filter(r => !r.scope.includes('ภายใน') && !r.level.includes('ภายใน'));
            } else if (scope === 'internal') {
                filtered = records.filter(r => r.scope.includes('ภายใน') || r.level.includes('ภายใน'));
            }

            if (countEl) {
                countEl.innerText = `${filtered.length} รายการ`;
            }
        }

        function confirmAndExecuteSarPrint() {
            const scopeEl = document.querySelector('input[name="sarScope"]:checked');
            const scope = scopeEl ? scopeEl.value : 'external';
            const showPhotos = document.getElementById('sarShowPhotos') ? document.getElementById('sarShowPhotos').checked : true;

            closeSarPrintModal();

            generateOfficialSARPrintContent({ scope, showPhotos });

            setTimeout(() => {
                window.print();
            }, 200);
        }

        function generateOfficialSARPrintContent(options = {}) {
            const container = document.getElementById('officialSarPrintContainer');
            if (!container || !AWARDS_DB) return;

            const scope = options.scope || 'external';
            const showPhotos = (options.showPhotos !== undefined) ? options.showPhotos : true;

            const now = new Date();
            const thaiDate = now.toLocaleDateString('th-TH', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            let yearTitle = '';
            let scopeSubtitle = '';
            if (scope === 'external') scopeSubtitle = '(เฉพาะเวทีการแข่งขันภายนอกสถานศึกษา)';
            else if (scope === 'internal') scopeSubtitle = '(เฉพาะกิจกรรมและเวทีการแข่งขันภายในสถานศึกษา)';
            else scopeSubtitle = '(รวมทุกเวทีการแข่งขันทั้งภายในและภายนอกสถานศึกษา)';

            if (currentYear === '2569') yearTitle = `ปีการศึกษา 2569 (ภาคเรียนที่ 1) ${scopeSubtitle}`;
            else if (currentYear === '2568') yearTitle = 'ปีการศึกษา 2568 (สรุปภาพรวม 196 รางวัลภายนอกสถานศึกษา)';
            else if (currentYear === '2567') yearTitle = `ปีการศึกษา 2567 ${scopeSubtitle}`;
            else if (currentYear === 'compare') yearTitle = 'สรุปสถิติเปรียบเทียบ 3 ปีการศึกษา (2567 - 2569)';

            // Header block
            let html = `
                <div class="page-break-avoid border-b-2 border-slate-900 pb-3 mb-4 text-center">
                    <div style="display: flex; align-items: center; justify-content: center; gap: 16px; margin-bottom: 6px;">
                        <img src="img/cpw_logo_en.png" alt="CPW Logo" style="width: 52px; height: 52px; object-fit: contain;">
                        <div style="text-align: left;">
                            <div style="font-size: 13pt; font-weight: 800; color: #0f172a; line-height: 1.25;">
                                โครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ (English Program : EP)
                            </div>
                            <div style="font-size: 11pt; font-weight: 700; color: #1e293b; margin-top: 2px;">
                                โรงเรียนชลประทานวิทยา อำเภอปากเกร็ด จังหวัดนนทบุรี
                            </div>
                        </div>
                    </div>
                    <div style="font-size: 12pt; font-weight: 800; color: #1e3a8a; margin-top: 6px;">
                        รายงานข้อมูลสารสนเทศผลสัมฤทธิ์และเกียรติประวัติความสำเร็จของนักเรียน
                    </div>
                    <div style="font-size: 9.5pt; color: #475569; margin-top: 2px;">
                        เอกสารหลักฐานเชิงประจักษ์ประกอบรายงานการประเมินตนเองของสถานศึกษา (SAR) มาตรฐานที่ 1 ด้านคุณภาพของผู้เรียน
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 8.5pt; color: #334155; margin-top: 8px; border-top: 1px dashed #94a3b8; padding-top: 4px;">
                        <span><strong>ประจำ:</strong> ${yearTitle}</span>
                        <span><strong>วิสัยทัศน์:</strong> ${AWARDS_DB.vision || 'น้อมนำความเป็นไทย ใส่ใจวิชาการ เชี่ยวชาญสู่สากล'}</span>
                        <span><strong>วันที่จัดพิมพ์:</strong> ${thaiDate}</span>
                    </div>
                </div>
            `;

            // Section 1: Summary Matrix Table
            if (currentYear === '2568' || currentYear === 'compare') {
                const s = AWARDS_DB.summary2568 || {};
                const groups = s.groups || [];
                const totals = s.totals || {};

                html += `
                    <div class="page-break-avoid" style="margin-bottom: 12px;">
                        <div style="font-size: 10pt; font-weight: 700; color: #0f172a; margin-bottom: 4px;">
                            ตารางที่ 1: สรุปจำนวนรางวัลจำแนกตามกลุ่มสาระการเรียนรู้และระดับการแข่งขัน ประจำปีการศึกษา 2568
                        </div>
                        <table class="sar-print-table">
                            <thead>
                                <tr>
                                    <th style="width: 40%; text-align: left;">กลุ่มสาระการเรียนรู้ / กิจกรรม</th>
                                    <th style="width: 12%;">นานาชาติ</th>
                                    <th style="width: 12%;">ระดับชาติ</th>
                                    <th style="width: 12%;">ระดับภาค</th>
                                    <th style="width: 12%;">ระดับจังหวัด</th>
                                    <th style="width: 12%;">รวม (รางวัล)</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${groups.map(g => `
                                    <tr>
                                        <td style="font-weight: 600;">${g.subjectGroup}</td>
                                        <td style="text-align: center;">${g.international}</td>
                                        <td style="text-align: center;">${g.national}</td>
                                        <td style="text-align: center;">${g.regional}</td>
                                        <td style="text-align: center;">${g.provincial}</td>
                                        <td style="text-align: right; font-weight: 700;">${g.total}</td>
                                    </tr>
                                `).join('')}
                                <tr style="background-color: #f8fafc; font-weight: 800;">
                                    <td>${totals.subjectGroup || '📉 ยอดรวมรางวัลทั้งหมด'}</td>
                                    <td style="text-align: center;">${totals.international || 0}</td>
                                    <td style="text-align: center;">${totals.national || 0}</td>
                                    <td style="text-align: center;">${totals.regional || 0}</td>
                                    <td style="text-align: center;">${totals.provincial || 0}</td>
                                    <td style="text-align: right; font-size: 9.5pt;">${totals.total || 196} รางวัล</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;
            }

            // If 2569 or 2567: render summary breakdown by level and records table
            if (currentYear === '2569' || currentYear === '2567') {
                const rawRecords = currentYear === '2569' ? (AWARDS_DB.records2569 || []) : (AWARDS_DB.records2567 || []);
                
                let records = rawRecords;
                if (scope === 'external') {
                    records = rawRecords.filter(r => !r.scope.includes('ภายใน') && !r.level.includes('ภายใน'));
                } else if (scope === 'internal') {
                    records = rawRecords.filter(r => r.scope.includes('ภายใน') || r.level.includes('ภายใน'));
                }

                // Dynamic statistics calculation
                const intlCount = records.filter(r => r.level.includes('นานาชาติ')).length;
                const natCount = records.filter(r => r.level.includes('ประเทศ') || r.level.includes('National')).length;
                const provCount = records.filter(r => r.level.includes('จังหวัด') || r.level.includes('ภาค') || r.level.includes('สโมสร') || r.level.includes('Club')).length;
                const internalCount = records.filter(r => r.level.includes('ภายใน') || r.scope.includes('ภายใน')).length;

                html += `
                    <div class="page-break-avoid" style="margin-bottom: 12px;">
                        <div style="font-size: 10pt; font-weight: 700; color: #0f172a; margin-bottom: 4px;">
                            ตารางที่ 1: สรุปภาพรวมสถิติรางวัลและการแข่งขัน ประจำปีการศึกษา ${currentYear} ${scopeSubtitle}
                        </div>
                        <table class="sar-print-table">
                            <thead>
                                <tr>
                                    <th>ยอดรวมรางวัลทั้งหมด</th>
                                    <th>ระดับนานาชาติ</th>
                                    <th>ระดับประเทศ</th>
                                    <th>ระดับจังหวัด / สโมสร</th>
                                    <th>ภายในสถานศึกษา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align: center; font-weight: 700;">
                                    <td style="font-size: 10pt; color: #1e3a8a;">${records.length} รางวัล</td>
                                    <td>${intlCount}</td>
                                    <td>${natCount}</td>
                                    <td>${provCount}</td>
                                    <td>${internalCount}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="margin-top: 14px;">
                        <div style="font-size: 10pt; font-weight: 700; color: #0f172a; margin-bottom: 4px;">
                            ตารางที่ 2: ทะเบียนคุมผลงานนักเรียนและหลักฐานเชิงประจักษ์ (SAR Evidence Register) - ${records.length} รายการ
                        </div>
                        <table class="sar-print-table">
                            <thead>
                                <tr>
                                    <th style="width: 3%; text-align: center;">ที่</th>
                                    ${showPhotos ? '<th style="width: 7%; text-align: center; white-space: nowrap;">รูปถ่าย</th>' : ''}
                                    <th style="width: ${showPhotos ? '8%' : '9%'}; text-align: center; white-space: nowrap;">รหัส/ชั้น</th>
                                    <th style="width: ${showPhotos ? '20%' : '22%'}; text-align: left;">ชื่อ-สกุล นักเรียน</th>
                                    <th style="width: ${showPhotos ? '29%' : '32%'}; text-align: left;">รายการแข่งขัน / กิจกรรม</th>
                                    <th style="width: ${showPhotos ? '13%' : '15%'}; text-align: left;">สถานที่จัด / หน่วยงาน</th>
                                    <th style="width: 8%; text-align: center; white-space: nowrap;">ระดับ</th>
                                    <th style="width: ${showPhotos ? '12%' : '14%'}; text-align: center; white-space: nowrap;">รางวัลที่ได้รับ</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${records.map((r, i) => `
                                    <tr>
                                        <td style="text-align: center; font-family: monospace; font-size: 8pt;">${i + 1}</td>
                                        ${showPhotos ? `
                                            <td style="text-align: center; vertical-align: middle; padding: 2px;">
                                                ${r.studentId && r.studentId !== '-' ? `
                                                    <img src="img/students/${r.studentId}.jpg" 
                                                         alt="${r.studentNameTh}" 
                                                         onerror="this.onerror=null; this.src='https://app.cpw.ac.th/cpw_api_content/images/student/${r.studentId}.jpg'; this.onerror=function(){ this.style.display='none'; if(this.nextElementSibling) this.nextElementSibling.style.display='inline-flex'; };"
                                                         style="width: 32px; height: 42px; object-fit: cover; border-radius: 3px; border: 1px solid #94a3b8; display: inline-block; vertical-align: middle; background-color: #f8fafc;" />
                                                    <div style="display: none; width: 32px; height: 42px; background-color: #f1f5f9; border-radius: 3px; border: 1px dashed #cbd5e1; align-items: center; justify-content: center; font-size: 7.5pt; color: #64748b; margin: 0 auto;">EP</div>
                                                ` : `
                                                    <div style="width: 32px; height: 42px; background-color: #f8fafc; border-radius: 3px; border: 1px dashed #cbd5e1; display: inline-flex; align-items: center; justify-content: center; font-size: 7pt; color: #64748b; line-height: 1.1; margin: 0 auto; text-align: center;">คณะ<br>นักเรียน</div>
                                                `}
                                            </td>
                                        ` : ''}
                                        <td style="text-align: center; font-weight: 600;">${r.room}<br><span style="font-size: 7.5pt; color: #475569; font-family: monospace;">${r.studentId && r.studentId !== '-' ? r.studentId : ''}</span></td>
                                        <td>
                                            <div style="font-weight: 700; color: #0f172a; white-space: nowrap;">${r.studentNameTh}</div>
                                            <div style="font-size: 7.5pt; color: #475569;">${r.studentNameEn && r.studentNameEn !== '-' ? r.studentNameEn : ''}</div>
                                        </td>
                                        <td style="line-height: 1.25;">
                                            <div style="font-weight: 600;">${r.competition}</div>
                                            <div style="font-size: 7.5pt; color: #475569; margin-top: 1px;">สาขา: ${r.category}</div>
                                        </td>
                                        <td style="font-size: 8pt; color: #334155;">${r.venue}</td>
                                        <td style="text-align: center; font-size: 8pt; font-weight: 600;">${r.level.split(' ')[0]}</td>
                                        <td style="text-align: center; font-weight: 700; color: #0f172a; font-size: 8pt;">${r.medalsSummary}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                `;
            }

            // Section 3: Official Sign-off Block
            html += `
                <div class="page-break-avoid" style="margin-top: 24px; padding-top: 12px; border-top: 1px solid #cbd5e1;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; text-align: center; font-size: 8.5pt;">
                        <div>
                            <div style="color: #334155;">ข้อมูลถูกต้องตามบันทึกสารสนเทศฝ่ายวิชาการโครงการฯ</div>
                            <div style="margin-top: 45px; border-bottom: 1px dotted #64748b; width: 65%; margin-left: auto; margin-right: auto;"></div>
                            <div style="font-weight: 700; color: #0f172a; margin-top: 6px;">(นายกษิดิษ รุจาคม)</div>
                            <div style="color: #475569; font-size: 8pt;">เจ้าหน้าที่งานสารสนเทศและประชาสัมพันธ์</div>
                            <div style="color: #64748b; margin-top: 2px;">วันที่ ........ / .................... / ............</div>
                        </div>
                        <div>
                            <div style="color: #334155;">รับรองข้อมูลสำหรับประกอบรายงานการประเมินตนเอง (SAR)</div>
                            <div style="margin-top: 45px; border-bottom: 1px dotted #64748b; width: 65%; margin-left: auto; margin-right: auto;"></div>
                            <div style="font-weight: 700; color: #0f172a; margin-top: 6px;">(นางปรารถนา วิเศษสุภมิตร)</div>
                            <div style="color: #475569; font-size: 8pt;">หัวหน้าโครงการฯ ภาคภาษาอังกฤษ</div>
                            <div style="color: #64748b; margin-top: 2px;">วันที่ ........ / .................... / ............</div>
                        </div>
                    </div>
                </div>
            `;

            container.innerHTML = html;
        }

        // Auto regenerate print container on tab switch or before print
        window.addEventListener('beforeprint', () => {
            generateOfficialSARPrintContent();
        });

        function initAwardsPage() {
            if (!AWARDS_DB) return;
            renderCurrentYear();
            renderSummary2568Table();
        }

        window.addEventListener('DOMContentLoaded', () => {
            if (!AWARDS_DB) {
                fetch('data/db_awards.json')
                    .then(res => res.json())
                    .then(data => {
                        AWARDS_DB = data;
                        initAwardsPage();
                    })
                    .catch(err => {
                        console.error('Failed to load awards database:', err);
                    });
            } else {
                initAwardsPage();
            }
        });

        function switchYearTab(yearKey) {
            currentYear = yearKey;

            // Update Tab Buttons UI
            const tabKeys = ['2569', '2568', '2567', 'compare'];
            tabKeys.forEach(k => {
                const btn = document.getElementById(`tabBtn-${k}`);
                if (btn) {
                    if (k === yearKey) {
                        btn.className = "px-5 py-2.5 rounded-xl font-bold text-sm transition-all bg-brand-500 text-white shadow-md shadow-brand-500/20";
                    } else if (k === 'compare') {
                        btn.className = "px-5 py-2.5 rounded-xl font-bold text-sm transition-all bg-purple-50 hover:bg-purple-100 text-purple-700 border border-purple-200 dark:bg-purple-950/30 dark:hover:bg-purple-900/40 dark:text-purple-300 dark:border-purple-800/40";
                    } else {
                        btn.className = "px-5 py-2.5 rounded-xl font-bold text-sm transition-all bg-slate-100 hover:bg-slate-200 text-slate-700 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-300";
                    }
                }
            });

            // Toggle Containers
            const filterToolbar = document.getElementById('filterToolbar');
            const cardsView = document.getElementById('cardsViewContainer');
            const tableView = document.getElementById('tableViewContainer');
            const summary2568View = document.getElementById('summary2568Container');
            const compareView = document.getElementById('compareViewContainer');

            const viewSwitcher = document.querySelector('.view-switcher');

            if (yearKey === '2568') {
                if (viewSwitcher) viewSwitcher.classList.add('hidden');
                filterToolbar.classList.add('hidden');
                cardsView.classList.add('hidden');
                tableView.classList.add('hidden');
                summary2568View.classList.remove('hidden');
                compareView.classList.add('hidden');
            } else if (yearKey === 'compare') {
                if (viewSwitcher) viewSwitcher.classList.add('hidden');
                filterToolbar.classList.add('hidden');
                cardsView.classList.add('hidden');
                tableView.classList.add('hidden');
                summary2568View.classList.add('hidden');
                compareView.classList.remove('hidden');
            } else {
                if (viewSwitcher) viewSwitcher.classList.remove('hidden');
                filterToolbar.classList.remove('hidden');
                summary2568View.classList.add('hidden');
                compareView.classList.add('hidden');
                setViewMode(currentView);
                renderCurrentYear();
            }
        }

        function setViewMode(mode) {
            currentView = mode;
            const btnCards = document.getElementById('btnViewCards');
            const btnTable = document.getElementById('btnViewTable');
            const cardsContainer = document.getElementById('cardsViewContainer');
            const tableContainer = document.getElementById('tableViewContainer');
            const summary2568View = document.getElementById('summary2568Container');
            const compareView = document.getElementById('compareViewContainer');

            // If user clicks card/table while in 2568 or compare, auto switch to 2569
            if (currentYear === '2568' || currentYear === 'compare') {
                switchYearTab('2569');
                return;
            }

            if (mode === 'cards') {
                btnCards.className = "flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all bg-white dark:bg-slate-900 text-brand-500 dark:text-blue-400 shadow-sm";
                btnTable.className = "flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all";
                cardsContainer.classList.remove('hidden');
                tableContainer.classList.add('hidden');
            } else {
                btnTable.className = "flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all bg-white dark:bg-slate-900 text-brand-500 dark:text-blue-400 shadow-sm";
                btnCards.className = "flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all";
                cardsContainer.classList.add('hidden');
                tableContainer.classList.remove('hidden');
            }
        }

        function getCurrentRecords() {
            if (!AWARDS_DB) return [];
            if (currentYear === '2569') return AWARDS_DB.records2569 || [];
            if (currentYear === '2567') return AWARDS_DB.records2567 || [];
            return [];
        }

        function applyFilters() {
            const query = (document.getElementById('searchInput').value || '').toLowerCase().trim();
            const cat = document.getElementById('categorySelect').value;
            const level = document.getElementById('levelSelect').value;

            const allRecords = getCurrentRecords();
            const filtered = allRecords.filter(r => {
                const text = `${r.studentNameTh} ${r.studentNameEn} ${r.room} ${r.competition} ${r.venue} ${r.medalsSummary}`.toLowerCase();
                const matchQuery = !query || text.includes(query);
                const matchCat = !cat || r.category.includes(cat);
                const matchLevel = !level || r.level.includes(level);
                return matchQuery && matchCat && matchLevel;
            });

            // Status Indicator
            const statusDiv = document.getElementById('filterStatus');
            const statusText = document.getElementById('filterStatusText');
            if (query || cat || level) {
                statusDiv.classList.remove('hidden');
                statusText.innerText = `แสดงผลลัพธ์ ${filtered.length} จากทั้งหมด ${allRecords.length} รายการ`;
            } else {
                statusDiv.classList.add('hidden');
            }

            renderCards(filtered);
            renderTable(filtered);
        }

        function clearAllFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('categorySelect').value = '';
            document.getElementById('levelSelect').value = '';
            applyFilters();
        }

        function renderCurrentYear() {
            applyFilters();
        }

        function renderCards(records) {
            activeRecordsList = records;
            const container = document.getElementById('cardsViewContainer');
            if (records.length === 0) {
                container.innerHTML = `
                    <div class="col-span-full py-16 text-center text-slate-400 dark:text-slate-600 space-y-2">
                        <div class="text-4xl">🔍</div>
                        <div class="font-bold text-slate-600 dark:text-slate-300">ไม่พบรายการที่ตรงกับเงื่อนไขการค้นหา</div>
                        <div class="text-xs">ลองค้นหาด้วยคำอื่น หรือกดล้างตัวกรอง</div>
                    </div>
                `;
                return;
            }

            container.innerHTML = records.map((r, idx) => {
                const isIntl = r.level.includes('นานาชาติ');
                const isNat = r.level.includes('ระดับประเทศ');
                const isProv = r.level.includes('จังหวัด') || r.level.includes('ภาค');
                const isHost = r.level.includes('เครือข่าย');
                const isInternal = r.level.includes('ภายใน');

                let badgeColor = "bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 border-slate-200 dark:border-slate-700";
                if (isIntl) badgeColor = "bg-sky-50 text-sky-700 dark:bg-sky-950/80 dark:text-sky-300 border-sky-200 dark:border-sky-800";
                else if (isNat) badgeColor = "bg-amber-50 text-amber-700 dark:bg-amber-950/80 dark:text-amber-300 border-amber-200 dark:border-amber-800";
                else if (isHost) badgeColor = "bg-blue-50 text-blue-700 dark:bg-blue-950/80 dark:text-blue-300 border-blue-200 dark:border-blue-800";
                else if (isInternal) badgeColor = "bg-purple-50 text-purple-700 dark:bg-purple-950/80 dark:text-purple-300 border-purple-200 dark:border-purple-800";

                let medalBadge = '';
                if (r.gold > 0) medalBadge = `<span class="medal-badge bg-amber-100/90 text-amber-800 dark:bg-amber-900/80 dark:text-amber-300 shadow-sm">🥇 ${r.gold} ทอง</span>`;
                else if (r.silver > 0) medalBadge = `<span class="medal-badge bg-slate-200/90 text-slate-800 dark:bg-slate-700 dark:text-slate-200 shadow-sm">🥈 ${r.silver} เงิน</span>`;
                else if (r.bronze > 0) medalBadge = `<span class="medal-badge bg-orange-100/90 text-orange-800 dark:bg-orange-900/80 dark:text-orange-300 shadow-sm">🥉 ${r.bronze} ทองแดง</span>`;
                else if (r.trophy > 0) medalBadge = `<span class="medal-badge bg-blue-100/90 text-blue-800 dark:bg-blue-900/80 dark:text-blue-300 shadow-sm">🏆 ถ้วยรางวัล</span>`;
                else medalBadge = `<span class="medal-badge bg-purple-100/90 text-purple-800 dark:bg-purple-900/80 dark:text-purple-300 shadow-sm">📜 เกียรติบัตร</span>`;

                const safeName = (r.studentNameTh || '').replace(/'/g, "\\'");
                const safeComp = (r.competition || '').replace(/'/g, "\\'");

                return `
                    <div class="award-card bg-white dark:bg-slate-950 border border-slate-200/90 dark:border-slate-800/90 rounded-2xl overflow-hidden shadow-sm hover:shadow-md hover:border-brand-500/40 dark:hover:border-blue-500/40 flex flex-col justify-between">
                        
                        ${r.imageUrl ? `
                            <!-- Award Photo Banner -->
                            <div class="relative w-full aspect-[16/11] overflow-hidden bg-slate-100 dark:bg-slate-900 group cursor-pointer border-b border-slate-100 dark:border-slate-800/80" onclick="openPhotoModal('${r.imageUrl}', '${safeName}', '${safeComp}')">
                                <img src="${r.imageUrl}" alt="${r.studentNameTh}" loading="lazy" class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105" onerror="this.parentElement.style.display='none'">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-250 flex items-end justify-between p-3 text-white">
                                    <span class="text-[11px] font-bold bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-lg flex items-center gap-1">
                                        <span>🔍</span> <span>คลิกดูภาพขยาย</span>
                                    </span>
                                    <span class="text-xs font-semibold text-white/80">CPW EP</span>
                                </div>

                                <!-- Floating Badges on Image -->
                                <div class="absolute top-2.5 left-2.5 z-10">
                                    <span class="px-2 py-0.5 rounded-md text-[10px] sm:text-[11px] font-bold border backdrop-blur-md shadow-sm ${badgeColor}">
                                        ${r.level.split(' ')[0]}
                                    </span>
                                </div>
                                <div class="absolute top-2.5 right-2.5 z-10">
                                    ${medalBadge}
                                </div>
                            </div>
                        ` : `
                            <!-- Badge Header without photo -->
                            <div class="p-5 pb-0 flex items-center justify-between gap-2">
                                <span class="px-2.5 py-1 rounded-md text-[11px] font-bold border ${badgeColor}">
                                    ${r.level.split(' ')[0]}
                                </span>
                                ${medalBadge}
                            </div>
                        `}

                        <!-- Card Content Body -->
                        <div class="p-5 space-y-3 flex-1 flex flex-col justify-between">
                            <div class="space-y-2.5">
                                <!-- Student Info -->
                                <div>
                                    <div class="flex items-baseline justify-between gap-2">
                                        <h3 class="font-extrabold text-slate-900 dark:text-white text-base leading-snug">
                                            ${r.studentNameTh}
                                        </h3>
                                        <span class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-brand-500 dark:text-blue-400 font-bold text-xs whitespace-nowrap">
                                            ${r.room}
                                        </span>
                                    </div>
                                    <div class="text-xs text-slate-400 dark:text-slate-500 font-english mt-0.5 truncate">
                                        ${r.studentNameEn !== '-' ? r.studentNameEn : ''}
                                    </div>
                                </div>

                                <!-- Award & Competition Details -->
                                <div class="space-y-1.5 text-xs text-slate-600 dark:text-slate-300">
                                    <p class="font-semibold text-slate-800 dark:text-slate-200 line-clamp-2" title="${r.competition}">
                                        🎯 ${r.competition}
                                    </p>
                                    <p class="text-slate-500 dark:text-slate-400 flex items-center gap-1 line-clamp-1" title="${r.venue}">
                                        <span>📍</span> <span>${r.venue}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="border-t border-slate-100 dark:border-slate-800/80 pt-3 flex items-center justify-between text-xs mt-auto">
                                <span class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">
                                    ${r.dateFormatted || 'ปีการศึกษา ' + r.academicYear}
                                </span>
                                <div class="flex items-center gap-2">
                                        <button onclick="event.stopPropagation(); openAwardDetail(${idx})" class="px-2 py-1 rounded-md bg-brand-50 hover:bg-brand-100 text-brand-600 dark:bg-brand-950/60 dark:hover:bg-brand-900/60 dark:text-blue-300 font-bold text-[11px] transition-all">
                                            ดูรายละเอียด ↗
                                        </button>
                                    ${r.imageUrl ? `
                                        <button onclick="openPhotoModal('${r.imageUrl}', '${safeName}', '${safeComp}')" class="text-brand-500 dark:text-blue-400 font-bold hover:underline flex items-center gap-1 text-[11px]">
                                            <span>รูปถ่าย</span> <span>📷</span>
                                        </button>
                                    ` : ''}
                                    ${r.referenceUrl && r.referenceUrl !== '-' ? `
                                        <a href="${r.referenceUrl}" target="_blank" class="font-bold text-slate-500 dark:text-slate-400 hover:text-brand-500 dark:hover:text-blue-400 flex items-center gap-0.5 text-[11px]">
                                            <span>โพสต์</span> <span>↗</span>
                                        </a>
                                    ` : `
                                        <span class="text-slate-400 text-[11px]">บันทึกทางการ</span>
                                    `}
                                </div>
                            </div>
                        </div>

                    </div>
                `;
            }).join('');
        }

        function renderTable(records) {
            const tbody = document.getElementById('tableBody');
            if (records.length === 0) {
                tbody.innerHTML = `<tr><td colspan="9" class="py-10 text-center text-slate-400">ไม่พบรายการข้อมูล</td></tr>`;
                return;
            }

            tbody.innerHTML = records.map((r, i) => `
                <tr onclick="openAwardDetail(${i})" class="hover:bg-brand-50/50 dark:hover:bg-slate-900/80 transition-colors cursor-pointer group">
                    <td class="py-3 px-4 font-mono text-xs text-slate-400">${i + 1}</td>
                    <td class="py-3 px-4 font-bold text-xs">${r.academicYear}</td>
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-3">
                            ${r.studentId && r.studentId !== '-' ? `
                                <img src="img/students/${r.studentId}.jpg" 
                                     alt="${r.studentNameTh}" 
                                     onerror="this.onerror=null; this.src='https://app.cpw.ac.th/cpw_api_content/images/student/${r.studentId}.jpg'; this.onerror=function(){ this.style.display='none'; if(this.nextElementSibling) this.nextElementSibling.style.display='flex'; };"
                                     class="w-8 h-10 object-cover rounded-md border border-slate-200 dark:border-slate-700 shadow-sm flex-shrink-0 bg-slate-100 dark:bg-slate-800" />
                                <div class="hidden w-8 h-10 bg-slate-100 dark:bg-slate-800 rounded-md border border-dashed border-slate-300 dark:border-slate-700 items-center justify-center text-[10px] font-bold text-slate-400 flex-shrink-0">EP</div>
                            ` : `
                                <div class="w-8 h-10 bg-slate-100 dark:bg-slate-800 rounded-md border border-dashed border-slate-300 dark:border-slate-700 flex items-center justify-center text-[9px] font-bold text-slate-400 flex-shrink-0 text-center leading-tight">คณะ<br>นักเรียน</div>
                            `}
                            <div>
                                <div class="font-bold text-slate-900 dark:text-white whitespace-nowrap">${r.studentNameTh}</div>
                                <div class="text-[11px] text-slate-400">${r.studentNameEn && r.studentNameEn !== '-' ? r.studentNameEn : ''}</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4 font-bold text-xs text-brand-500 dark:text-blue-400 whitespace-nowrap">${r.room}</td>
                    <td class="py-3 px-4 max-w-xs leading-relaxed text-xs">${r.competition}</td>
                    <td class="py-3 px-4 text-xs text-slate-500 dark:text-slate-400 max-w-[220px] break-words leading-relaxed" title="${r.venue}">📍 ${r.venue}</td>
                    <td class="py-3 px-4 text-xs">
                        <span class="px-2 py-0.5 rounded text-[11px] font-bold ${r.level.includes('นานาชาติ') ? 'bg-sky-100 text-sky-800 dark:bg-sky-950 dark:text-sky-300' : r.level.includes('ประเทศ') ? 'bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300' : 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300'}">
                            ${r.level.split(' ')[0]}
                        </span>
                    </td>
                    <td class="py-3 px-4 font-semibold text-xs text-slate-800 dark:text-slate-200">${r.medalsSummary}</td>
                    <td class="py-3 px-4 btn-print-hide text-xs flex items-center gap-2">
                        <button onclick="event.stopPropagation(); openAwardDetail(${i})" class="px-2.5 py-1 rounded-lg bg-brand-50 hover:bg-brand-100 text-brand-600 dark:bg-brand-950/60 dark:text-blue-300 font-bold text-xs whitespace-nowrap">
                            ดูรายละเอียด ↗
                        </button>
                        ${r.referenceUrl && r.referenceUrl !== '-' ? `<a href="${r.referenceUrl}" target="_blank" onclick="event.stopPropagation()" class="text-slate-400 hover:text-brand-500 dark:hover:text-blue-400 text-xs">โพสต์ ↗</a>` : ''}
                    </td>
                </tr>
            `).join('');
        }

        function renderSummary2568Table() {
            if (!AWARDS_DB || !AWARDS_DB.summary2568) return;
            const groups = AWARDS_DB.summary2568.groups || [];
            const totals = AWARDS_DB.summary2568.totals || {};

            const tbody = document.getElementById('summary2568TableBody');
            tbody.innerHTML = groups.map(g => `
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/50">
                    <td class="py-3 px-4 font-bold text-slate-900 dark:text-white">${g.subjectGroup}</td>
                    <td class="py-3 px-4 text-center font-semibold text-sky-600 dark:text-sky-400">${g.international}</td>
                    <td class="py-3 px-4 text-center font-semibold text-amber-600 dark:text-amber-400">${g.national}</td>
                    <td class="py-3 px-4 text-center font-semibold text-purple-600 dark:text-purple-400">${g.regional}</td>
                    <td class="py-3 px-4 text-center font-semibold text-emerald-600 dark:text-emerald-400">${g.provincial}</td>
                    <td class="py-3 px-4 text-right font-black text-slate-900 dark:text-white">${g.total}</td>
                </tr>
            `).join('') + `
                <tr class="bg-slate-100 dark:bg-slate-900 font-black text-slate-900 dark:text-white border-t-2 border-slate-300 dark:border-slate-700">
                    <td class="py-3.5 px-4">${totals.subjectGroup}</td>
                    <td class="py-3.5 px-4 text-center text-sky-600 dark:text-sky-400 font-black">${totals.international}</td>
                    <td class="py-3.5 px-4 text-center text-amber-600 dark:text-amber-400 font-black">${totals.national}</td>
                    <td class="py-3.5 px-4 text-center text-purple-600 dark:text-purple-400 font-black">${totals.regional}</td>
                    <td class="py-3.5 px-4 text-center text-emerald-600 dark:text-emerald-400 font-black">${totals.provincial}</td>
                    <td class="py-3.5 px-4 text-right text-base text-brand-500 dark:text-blue-400 font-black">${totals.total} รางวัล</td>
                </tr>
            `;
        }

        // PHOTO MODAL LIGHTBOX LOGIC
        function openPhotoModal(imgUrl, name, comp) {
            const modal = document.getElementById('photoModal');
            const modalImg = document.getElementById('modalImage');
            const modalName = document.getElementById('modalStudentName');
            const modalComp = document.getElementById('modalCompetition');
            const modalBtn = document.getElementById('modalDownloadBtn');

            if (!modal || !modalImg) return;

            modalImg.src = imgUrl;
            modalName.innerText = name || 'ภาพบันทึกผลงานนักเรียน';
            modalComp.innerText = comp || '';
            if (modalBtn) modalBtn.href = imgUrl;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closePhotoModal(e) {
            const modal = document.getElementById('photoModal');
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') { closePhotoModal(); closeAwardDetail(); }
        });
    </script>

    <!-- PHOTO MODAL LIGHTBOX -->
    <div id="photoModal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-sm hidden items-center justify-center p-3 sm:p-6 transition-all duration-200" onclick="closePhotoModal(event)">
        <div class="relative max-w-4xl w-full max-h-[92vh] bg-slate-900 border border-slate-700/80 rounded-2xl overflow-hidden shadow-2xl flex flex-col" onclick="event.stopPropagation()">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 sm:px-6 border-b border-slate-800 text-white bg-slate-950/60">
                <div class="space-y-0.5 pr-4">
                    <h3 id="modalStudentName" class="font-extrabold text-base sm:text-lg text-white"></h3>
                    <p id="modalCompetition" class="text-xs text-slate-400 leading-snug break-words"></p>
                </div>
                <button onclick="closePhotoModal()" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center text-lg font-bold transition-all shadow-sm">
                    ✕
                </button>
            </div>

            <!-- Modal Image Body -->
            <div class="p-2 sm:p-4 flex items-center justify-center overflow-auto max-h-[72vh] bg-black/40">
                <img id="modalImage" src="" alt="ภาพผลงานนักเรียน" class="max-w-full max-h-[68vh] rounded-xl object-contain shadow-xl">
            </div>

            <!-- Modal Footer -->
            <div class="p-3.5 sm:px-6 border-t border-slate-800 flex items-center justify-between text-xs text-slate-400 bg-slate-950">
                <div class="flex items-center gap-1.5">
                    <span>📸</span>
                    <span class="font-medium">ภาพบันทึกทางการและหลักฐานผลการแข่งขัน</span>
                </div>
                <a id="modalDownloadBtn" href="" target="_blank" class="px-3.5 py-1.5 rounded-lg bg-brand-500 hover:bg-brand-600 text-white font-bold transition-all flex items-center gap-1.5 text-xs shadow-sm shadow-brand-500/20">
                    <span>เปิดภาพขนาดเต็ม</span> <span>↗</span>
                </a>
            </div>

        </div>
    </div>


    <!-- STUDENT AWARD DETAIL MODAL (หน้ารายละเอียดแต่ละรายการของเด็ก) -->
    <div id="awardDetailModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden items-center justify-center p-3 sm:p-6 transition-all duration-200" onclick="if(event.target === this) closeAwardDetail()">
        <div class="relative max-w-2xl w-full bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden max-h-[92vh] flex flex-col animate-in fade-in zoom-in-95 duration-200" onclick="event.stopPropagation()">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-5 py-4 sm:px-6 border-b border-slate-100 dark:border-slate-800 bg-slate-50/80 dark:bg-slate-950/60">
                <div class="flex items-center gap-2">
                    <span id="modalDetailYear" class="px-2.5 py-1 rounded-md text-xs font-black bg-brand-500 text-white shadow-sm shadow-brand-500/20"></span>
                    <span id="modalDetailLevel" class="px-2.5 py-1 rounded-md text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-950/80 dark:text-amber-300 border border-amber-200/60 dark:border-amber-800/40"></span>
                </div>
                <button onclick="closeAwardDetail()" class="w-8 h-8 rounded-full bg-slate-200 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 flex items-center justify-center text-sm font-bold transition-all">
                    ✕
                </button>
            </div>

            <!-- Modal Scrollable Content -->
            <div class="p-5 sm:p-6 overflow-y-auto space-y-5">
                
                <!-- Image Box (if available) -->
                <div id="modalDetailImageBox" class="relative rounded-2xl overflow-hidden bg-slate-950 border border-slate-200 dark:border-slate-800 shadow-inner group cursor-pointer max-h-72 flex items-center justify-center">
                    <img id="modalDetailImage" src="" alt="ภาพผลงาน" class="w-full h-full object-contain max-h-72">
                    <div id="modalDetailZoomBtn" class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="px-4 py-2 rounded-xl bg-black/70 backdrop-blur-md text-white font-bold text-xs flex items-center gap-2 shadow-lg">
                            <span>🔍</span> <span>คลิกเพื่อดูภาพขนาดใหญ่เต็มจอ</span>
                        </span>
                    </div>
                </div>

                <!-- Placeholder banner if no image -->
                <div id="modalDetailNoImage" class="p-6 rounded-2xl bg-gradient-to-br from-brand-50 to-indigo-50/50 dark:from-slate-800/60 dark:to-brand-950/20 border border-brand-100 dark:border-slate-700 text-center space-y-2 hidden">
                    <div class="text-4xl">🏆</div>
                    <div class="font-bold text-sm text-brand-900 dark:text-blue-200">บันทึกเกียรติประวัติทางการ (Official School Record)</div>
                    <div class="text-xs text-slate-500 dark:text-slate-400">รายการนี้ได้รับการรับรองตามมาตรฐานงานประกันคุณภาพการศึกษา (SAR)</div>
                </div>

                <!-- Student Identity Card -->
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 flex items-start justify-between gap-4">
                    <div class="space-y-1">
                        <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">นักเรียนผู้สร้างชื่อเสียง (Student Awardee)</div>
                        <h2 id="modalDetailStudentTh" class="text-lg sm:text-xl font-black text-slate-900 dark:text-white"></h2>
                        <div id="modalDetailStudentEn" class="text-xs font-semibold text-slate-500 dark:text-slate-400 font-english"></div>
                    </div>
                    <div class="text-right space-y-1">
                        <span id="modalDetailRoom" class="inline-block px-3 py-1 rounded-xl bg-brand-500 text-white font-black text-sm shadow-sm"></span>
                        <div id="modalDetailStudentId" class="text-[11px] font-mono text-slate-400"></div>
                    </div>
                </div>

                <!-- Award & Competition Details Grid -->
                <div class="space-y-3">
                    <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">รายละเอียดผลงานและการแข่งขัน</div>
                    
                    <!-- Competition Name -->
                    <div class="p-4 rounded-2xl bg-white dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/60 space-y-1">
                        <div class="text-xs text-slate-400 dark:text-slate-500">รายการแข่งขัน / กิจกรรม:</div>
                        <div id="modalDetailComp" class="font-extrabold text-slate-900 dark:text-white text-base leading-snug"></div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Medal / Award -->
                        <div class="p-3.5 rounded-xl bg-amber-50/60 dark:bg-amber-950/20 border border-amber-200/50 dark:border-amber-900/30">
                            <div class="text-[11px] text-amber-700 dark:text-amber-400 font-bold">รางวัลที่ได้รับ (Award):</div>
                            <div id="modalDetailMedal" class="font-extrabold text-slate-900 dark:text-white text-sm mt-0.5"></div>
                        </div>

                        <!-- Category -->
                        <div class="p-3.5 rounded-xl bg-purple-50/60 dark:bg-purple-950/20 border border-purple-200/50 dark:border-purple-900/30">
                            <div class="text-[11px] text-purple-700 dark:text-purple-400 font-bold">กลุ่มสาระ / สาขาวิชา:</div>
                            <div id="modalDetailCategory" class="font-bold text-slate-800 dark:text-slate-200 text-xs mt-0.5 break-words leading-relaxed"></div>
                        </div>

                        <!-- Venue / Organizer -->
                        <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-700/50">
                            <div class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">สถานที่จัด / หน่วยงาน:</div>
                            <div id="modalDetailVenue" class="font-semibold text-slate-800 dark:text-slate-200 text-xs mt-0.5"></div>
                        </div>

                        <!-- Date & Scope -->
                        <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-700/50">
                            <div class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">วันที่ประกาศผล / ขอบเขต:</div>
                            <div class="flex items-center gap-1.5 mt-0.5 text-xs font-semibold text-slate-800 dark:text-slate-200">
                                <span id="modalDetailDate"></span>
                                <span>•</span>
                                <span id="modalDetailScope" class="text-slate-500 dark:text-slate-400"></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="px-5 py-3.5 sm:px-6 border-t border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 flex items-center justify-between">
                <span class="text-xs text-slate-400 font-medium flex items-center gap-1">
                    <span>🏛️</span> <span>English Program CPW</span>
                </span>
                <div class="flex items-center gap-2">
                    <a id="modalDetailRefBtn" href="" target="_blank" class="px-4 py-2 rounded-xl bg-brand-50 hover:bg-brand-100 dark:bg-brand-950/40 dark:hover:bg-brand-900/50 text-brand-600 dark:text-blue-300 font-bold text-xs transition-all flex items-center gap-1.5 border border-brand-200/50 dark:border-brand-800/40 shadow-sm">
                        <span>เปิดดูโพสต์ต้นฉบับ</span> <span>↗</span>
                    </a>
                    <button onclick="closeAwardDetail()" class="px-4 py-2 rounded-xl bg-slate-200 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold text-xs transition-all">
                        ปิดหน้าต่าง
                    </button>
                </div>
            </div>

        </div>
    </div>


    
    <!-- SAR PRINT OPTIONS MODAL (หน้าต่างตั้งค่าก่อนพิมพ์รายงาน SAR) -->
    <div id="sarPrintModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden items-center justify-center p-4 transition-all duration-200" onclick="if(event.target === this) closeSarPrintModal()">
        <div class="relative max-w-lg w-full bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden flex flex-col animate-in fade-in zoom-in-95 duration-200" onclick="event.stopPropagation()">
            
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/80 dark:bg-slate-950/60">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-brand-500 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-brand-500/20">
                        🖨️
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 dark:text-white text-base">ตั้งค่าการพิมพ์รายงาน SAR เข้าเล่ม</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">เลือกขอบเขตผลงานและเกณฑ์การแสดงผลตามมาตรฐานประกันคุณภาพ</p>
                    </div>
                </div>
                <button onclick="closeSarPrintModal()" class="w-8 h-8 rounded-full bg-slate-200 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 flex items-center justify-center text-sm font-bold transition-all">
                    ✕
                </button>
            </div>

            <!-- Body Form -->
            <div class="p-6 space-y-5">
                
                <!-- Scope selection -->
                <div class="space-y-2.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                        ขอบเขตผลงานที่ต้องการพิมพ์ (Award Scope)
                    </label>
                    
                    <div class="space-y-2">
                        <!-- Option 1: External (Recommended) -->
                        <label class="flex items-start gap-3 p-3.5 rounded-2xl border-2 border-brand-500/80 bg-brand-50/50 dark:bg-brand-950/30 dark:border-brand-500/60 cursor-pointer transition-all hover:bg-brand-50/80">
                            <input type="radio" name="sarScope" value="external" checked onchange="updateSarModalSummary()" class="mt-1 w-4 h-4 text-brand-600 focus:ring-brand-500">
                            <div class="space-y-0.5 flex-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-sm text-slate-900 dark:text-white">เฉพาะเวทีภายนอกสถานศึกษา (External Only)</span>
                                    <span class="px-2 py-0.5 rounded-md bg-brand-500 text-white text-[10px] font-extrabold shadow-sm">⭐ แนะนำสำหรับ SAR</span>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">คัดเฉพาะเวทีนานาชาติ, ระดับชาติ, ระดับภาค และระดับจังหวัด (คัดกิจกรรมภายในออกตามเกณฑ์ สมศ./สพฐ.)</p>
                            </div>
                        </label>

                        <!-- Option 2: All -->
                        <label class="flex items-start gap-3 p-3.5 rounded-2xl border border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 cursor-pointer transition-all">
                            <input type="radio" name="sarScope" value="all" onchange="updateSarModalSummary()" class="mt-1 w-4 h-4 text-brand-600 focus:ring-brand-500">
                            <div class="space-y-0.5 flex-1">
                                <span class="font-bold text-sm text-slate-900 dark:text-white">รวมผลงานทั้งหมด (All Awards)</span>
                                <p class="text-xs text-slate-500 dark:text-slate-400">รวมทั้งเวทีแข่งขันภายนอกโรงเรียน และกิจกรรมทดสอบ/ส่งเสริมทักษะภายในโครงการ EP</p>
                            </div>
                        </label>

                        <!-- Option 3: Internal only -->
                        <label class="flex items-start gap-3 p-3.5 rounded-2xl border border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 cursor-pointer transition-all">
                            <input type="radio" name="sarScope" value="internal" onchange="updateSarModalSummary()" class="mt-1 w-4 h-4 text-brand-600 focus:ring-brand-500">
                            <div class="space-y-0.5 flex-1">
                                <span class="font-bold text-sm text-slate-900 dark:text-white">เฉพาะกิจกรรมภายในสถานศึกษา (Internal Only)</span>
                                <p class="text-xs text-slate-500 dark:text-slate-400">เฉพาะรางวัล Highest Score และเกียรติบัตรการแข่งขันทักษะภายในโครงการ EP</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Photo Option -->
                <div class="pt-2 border-t border-slate-100 dark:border-slate-800">
                    <label class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <input type="checkbox" id="sarShowPhotos" checked class="w-4 h-4 text-brand-600 rounded focus:ring-brand-500">
                        <div class="text-xs text-slate-700 dark:text-slate-300">
                            <span class="font-bold">แสดงคอลัมน์รูปถ่ายหน้าตรงนักเรียน</span> (Student Portrait Column)
                        </div>
                    </label>
                </div>

                <!-- Summary counter banner -->
                <div id="sarModalSummaryBanner" class="px-4 py-3 rounded-2xl bg-blue-50 dark:bg-slate-800/80 border border-blue-100 dark:border-slate-700 flex items-center justify-between text-xs">
                    <div class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
                        <span>📋</span> <span>จำนวนรายการที่จะจัดพิมพ์ในรายงาน:</span>
                    </div>
                    <span id="sarModalRecordCount" class="font-extrabold text-brand-600 dark:text-blue-400 text-sm">38 รายการ</span>
                </div>

            </div>

            <!-- Footer Actions -->
            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-950/80 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end gap-3">
                <button onclick="closeSarPrintModal()" class="px-4 py-2 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 font-bold text-xs transition-all">
                    ยกเลิก
                </button>
                <button onclick="confirmAndExecuteSarPrint()" class="px-5 py-2.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-black text-xs shadow-md shadow-brand-500/30 flex items-center gap-2 transition-all">
                    <span>🖨️ สั่งพิมพ์รายงาน (Print)</span>
                </button>
            </div>

        </div>
    </div>


    <!-- DEDICATED OFFICIAL SAR PRINT CONTAINER (แสดงเฉพาะตอนสั่งพิมพ์ / Print View) -->
    <div id="officialSarPrintContainer" class="hidden">
        <!-- Content dynamically generated by generateOfficialSARPrintContent() -->
    </div>

</body>
</html>
