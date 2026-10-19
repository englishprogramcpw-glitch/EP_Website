<?php
$pageTitle = "อัตราค่าเรียนและค่าธรรมเนียม | English Program (EP) CPW";
$currentPage = "fees";
$settings = json_decode(file_get_contents('data/db_site_settings.json'), true);

// Extract fees variables for convenience
$primary = $settings['fees']['primary'];
$junior = $settings['fees']['junior'];
$senior = $settings['fees']['senior'];

// Formatted values helper
function fmt($val) {
    if (empty($val) || $val === '-' || $val === '0') return '-';
    return number_format(floatval(str_replace(',', '', $val)));
}

// Convert string values to safe floats
function val($val) {
    if (empty($val) || $val === '-' || $val === '0') return 0.0;
    return floatval(str_replace(',', '', $val));
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <?php include 'head.php'; ?>
</head>
<body class="bg-slate-50 text-slate-800 font-sans transition-colors duration-300 dark:bg-slate-900 dark:text-slate-100 min-h-screen flex flex-col">

    <?php include 'header.php'; ?>

    <!-- HEADER BANNER -->
    <header class="relative bg-slate-950 text-white py-24 px-4 overflow-hidden flex items-center justify-center bg-cover bg-center" style="background-image: url('img/ep_cover_banner.jpg');">
        <div class="absolute inset-0 bg-slate-950/70"></div>
        <div class="relative max-w-4xl mx-auto text-center space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-accent/10 border border-brand-accent/25 text-brand-accent text-xs font-bold font-english uppercase tracking-wider">
                Tuition & Fees
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-tight">
                <span class="lang-th">ค่าเล่าเรียนและค่าธรรมเนียม</span>
                <span class="lang-en hidden">Tuition & Fees</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base font-normal max-w-2xl mx-auto leading-relaxed">
                <span class="lang-th">โครงสร้างอัตราค่าธรรมเนียมการศึกษารายเทอมและรายปีการศึกษาของโครงการฯ ภาคภาษาอังกฤษ (EP)</span>
                <span class="lang-en hidden">Clear structure of semester-based and annual educational program fees.</span>
            </p>
        </div>
    </header>

    <!-- MAIN CONTENT (N°01 Single Column Layout for Readability) -->
    <main class="flex-grow max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 space-y-16">
        
        <!-- SECTION 1: N°26 Pricing Table Grid -->
        <section class="space-y-12">
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-500/10 text-brand-500 dark:text-blue-400 font-bold text-xs">
                    <span class="lang-th">ค่าธรรมเนียมการเรียนประจำภาคเรียน</span>
                    <span class="lang-en hidden">Semester Tuition & Fees</span>
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-950 dark:text-white tracking-tight">
                    <span class="lang-th">เลือกระดับชั้นเพื่อเปรียบเทียบ เทอม 1 และ เทอม 2</span>
                    <span class="lang-en hidden">Compare Semester 1 & Semester 2 Fees</span>
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    <span class="lang-th">*อัตราค่าธรรมเนียมการศึกษา เทอม 1 จะรวมค่าบริการรายปีบางรายการ เช่น ค่าศูนย์การเรียนรู้ดาราศาสตร์</span>
                    <span class="lang-en hidden">*Semester 1 tuition fee includes certain annual service charges such as the Astronomy Center fee.</span>
                </p>
            </div>

            <!-- Pricing Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Primary Card Button -->
                <button onclick="selectLevel('primary')" id="card-primary" class="text-left w-full border-2 border-brand-500 ring-2 ring-brand-500/10 rounded-3xl p-6 sm:p-8 space-y-5 bg-white dark:bg-slate-900 flex flex-col justify-between hover:shadow transition-all duration-300 focus:outline-none">
                    <div class="space-y-4 w-full">
                        <span class="inline-block text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400 bg-blue-100/50 dark:bg-blue-950/30 px-2.5 py-1 rounded">Primary School</span>
                        <h4 class="font-extrabold text-slate-900 dark:text-white text-lg">
                            <span class="lang-th">ประถมศึกษา (ป.1-6)</span>
                            <span class="lang-en hidden">Primary School (P.1-6)</span>
                        </h4>
                        <div class="border-b border-slate-200 dark:border-slate-800 pb-4">
                            <div class="flex items-baseline gap-1">
                                <span class="text-xs text-slate-500 font-bold">
                                    <span class="lang-th">เทอม 1</span>
                                    <span class="lang-en hidden">Sem 1</span>
                                </span>
                                <span class="text-3xl font-black text-slate-900 dark:text-white font-english"><?php echo fmt(val($primary['tuition']) + val($primary['food']) + val($primary['astro'])); ?></span>
                                <span class="text-xs text-slate-500">
                                    <span class="lang-th">บาท</span>
                                    <span class="lang-en hidden">THB</span>
                                </span>
                            </div>
                            <span class="text-[10px] text-slate-450 block mt-1">
                                <span class="lang-th">เทอม 2 จ่าย <?php echo fmt(val($primary['tuition']) + val($primary['food'])); ?> บาท (รวมค่าเล่าเรียนและค่าอาหารกลางวัน)</span>
                                <span class="lang-en hidden">Sem 2: <?php echo fmt(val($primary['tuition']) + val($primary['food'])); ?> THB (Tuition & Lunch included)</span>
                            </span>
                        </div>
                        <span class="text-xs text-brand-500 dark:text-blue-400 font-bold block">
                            <span class="lang-th">คลิกดูรายละเอียดเทอม 1 &amp; 2 &rarr;</span>
                            <span class="lang-en hidden">View Semesters 1 &amp; 2 Details &rarr;</span>
                        </span>
                    </div>
                </button>

                <!-- Junior High Card Button -->
                <button onclick="selectLevel('junior')" id="card-junior" class="text-left w-full border-2 border-slate-200 dark:border-slate-855 rounded-3xl p-6 sm:p-8 space-y-5 bg-white dark:bg-slate-900 flex flex-col justify-between hover:shadow transition-all duration-300 focus:outline-none">
                    <div class="space-y-4 w-full">
                        <span class="inline-block text-xs font-bold uppercase tracking-wider text-brand-accent bg-brand-accent/10 px-2.5 py-1 rounded">Junior High</span>
                        <h4 class="font-extrabold text-slate-900 dark:text-white text-lg">
                            <span class="lang-th">มัธยมศึกษาตอนต้น (ม.1-3)</span>
                            <span class="lang-en hidden">Junior High (M.1-3)</span>
                        </h4>
                        <div class="border-b border-slate-200 dark:border-slate-800 pb-4">
                            <div class="flex items-baseline gap-1">
                                <span class="text-xs text-slate-500 font-bold">
                                    <span class="lang-th">เทอม 1</span>
                                    <span class="lang-en hidden">Sem 1</span>
                                </span>
                                <span class="text-3xl font-black text-slate-900 dark:text-white font-english"><?php echo fmt(val($junior['tuition']) + val($junior['astro'])); ?></span>
                                <span class="text-xs text-slate-500">
                                    <span class="lang-th">บาท</span>
                                    <span class="lang-en hidden">THB</span>
                                </span>
                            </div>
                            <span class="text-[10px] text-slate-455 block mt-1">
                                <span class="lang-th">เทอม 2 จ่าย <?php echo fmt($junior['tuition']); ?> บาท (เฉพาะค่าเล่าเรียน / ไม่บังคับอาหาร)</span>
                                <span class="lang-en hidden">Sem 2: <?php echo fmt($junior['tuition']); ?> THB (Tuition only / Lunch optional)</span>
                            </span>
                        </div>
                        <span class="text-xs text-brand-accent font-bold block">
                            <span class="lang-th">คลิกดูรายละเอียดเทอม 1 &amp; 2 &rarr;</span>
                            <span class="lang-en hidden">View Semesters 1 &amp; 2 Details &rarr;</span>
                        </span>
                    </div>
                </button>

                <!-- Senior High Card Button -->
                <button onclick="selectLevel('senior')" id="card-senior" class="text-left w-full border-2 border-slate-200 dark:border-slate-855 rounded-3xl p-6 sm:p-8 space-y-5 bg-white dark:bg-slate-900 flex flex-col justify-between hover:shadow transition-all duration-300 focus:outline-none">
                    <div class="space-y-4 w-full">
                        <span class="inline-block text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-450 bg-emerald-100/50 dark:bg-emerald-950/30 px-2.5 py-1 rounded">Senior High</span>
                        <h4 class="font-extrabold text-slate-900 dark:text-white text-lg">
                            <span class="lang-th">มัธยมศึกษาตอนปลาย (ม.4-6)</span>
                            <span class="lang-en hidden">Senior High (M.4-6)</span>
                        </h4>
                        <div class="border-b border-slate-200 dark:border-slate-800 pb-4">
                            <div class="flex items-baseline gap-1">
                                <span class="text-xs text-slate-500 font-bold">
                                    <span class="lang-th">เทอม 1</span>
                                    <span class="lang-en hidden">Sem 1</span>
                                </span>
                                <span class="text-3xl font-black text-slate-900 dark:text-white font-english"><?php echo fmt(val($senior['tuition']) + val($senior['astro'])); ?></span>
                                <span class="text-xs text-slate-500">
                                    <span class="lang-th">บาท</span>
                                    <span class="lang-en hidden">THB</span>
                                </span>
                            </div>
                            <span class="text-[10px] text-slate-455 block mt-1">
                                <span class="lang-th">เทอม 2 จ่าย <?php echo fmt($senior['tuition']); ?> บาท (เฉพาะค่าเล่าเรียน / ไม่บังคับอาหาร)</span>
                                <span class="lang-en hidden">Sem 2: <?php echo fmt($senior['tuition']); ?> THB (Tuition only / Lunch optional)</span>
                            </span>
                        </div>
                        <span class="text-xs text-emerald-600 dark:text-emerald-400 font-bold block">
                            <span class="lang-th">คลิกดูรายละเอียดเทอม 1 &amp; 2 &rarr;</span>
                            <span class="lang-en hidden">View Semesters 1 &amp; 2 Details &rarr;</span>
                        </span>
                    </div>
                </button>
            </div>
        </section>

        <!-- SECTION 2: Dynamic Fee details -->
        <section class="space-y-6">
            <div class="space-y-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-500/10 text-brand-500 dark:text-blue-400 font-bold text-xs">
                    <span class="lang-th">รายละเอียดอย่างละเอียดแยกตามเทอม</span>
                    <span class="lang-en hidden">Detailed Semester Breakdown</span>
                </span>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">เปรียบเทียบตารางค่าใช้จ่ายรายเทอม (Semester Comparison)</h3>
            </div>

            <!-- Detail Cards Container -->
            <div class="relative bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-10 shadow-sm">
                
                <!-- PRIMARY DETAILS -->
                <div id="details-primary" class="space-y-8">
                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span>🏫</span>
                            <span class="lang-th">รายละเอียดระดับประถมศึกษา (ป.1 - ป.6)</span>
                            <span class="lang-en hidden">Primary School Details (P.1 - P.6)</span>
                        </h4>
                        <span class="text-xs font-bold text-slate-450 font-english">Tuition & Food Total: <?php echo fmt((val($primary['tuition']) + val($primary['food'])) * 2 + val($primary['astro'])); ?> THB / Year</span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 text-xs sm:text-sm">
                        <!-- Left: Itemized table (7 Columns) -->
                        <div class="md:col-span-7 space-y-4">
                            <strong class="block text-brand-500 dark:text-blue-400 text-sm font-bold">
                                <span class="lang-th">📊 รายการเปรียบเทียบค่าธรรมเนียมคงที่รายเทอม</span>
                                <span class="lang-en hidden">📊 Semester Breakdown of Fixed Fees</span>
                            </strong>
                            <div class="border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm bg-white dark:bg-slate-950">
                                <table class="w-full text-left text-xs border-collapse">
                                    <thead>
                                        <tr class="bg-slate-50 dark:bg-slate-900 text-slate-700 dark:text-slate-300 font-bold border-b border-slate-200 dark:border-slate-800">
                                            <th class="px-4 py-3">
                                                <span class="lang-th">รายละเอียดค่าใช้จ่าย</span>
                                                <span class="lang-en hidden">Fee Description</span>
                                            </th>
                                            <th class="px-4 py-3 text-right">
                                                <span class="lang-th">ภาคเรียนที่ 1</span>
                                                <span class="lang-en hidden">Semester 1</span>
                                            </th>
                                            <th class="px-4 py-3 text-right">
                                                <span class="lang-th">ภาคเรียนที่ 2</span>
                                                <span class="lang-en hidden">Semester 2</span>
                                            </th>
                                            <th class="px-4 py-3 text-right bg-slate-100/50 dark:bg-slate-900/50">
                                                <span class="lang-th">รวมตลอดปี</span>
                                                <span class="lang-en hidden">Annual Total</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-600 dark:text-slate-400 font-medium">
                                        <tr>
                                            <td class="px-4 py-3 font-bold text-slate-800 dark:text-slate-200">
                                                <span class="lang-th">1. ค่าธรรมเนียมการศึกษา</span>
                                                <span class="lang-en hidden">1. Tuition Fee</span>
                                            </td>
                                            <td class="px-4 py-3 text-right font-english"><?php echo fmt($primary['tuition']); ?></td>
                                            <td class="px-4 py-3 text-right font-english"><?php echo fmt($primary['tuition']); ?></td>
                                            <td class="px-4 py-3 text-right font-english bg-slate-50/50 dark:bg-slate-950/30"><?php echo fmt(val($primary['tuition'])*2); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 font-bold text-slate-800 dark:text-slate-200">
                                                <span class="lang-th">2. ค่าอาหารกลางวัน</span>
                                                <span class="lang-en hidden">2. Lunch & Meals</span>
                                            </td>
                                            <td class="px-4 py-3 text-right font-english"><?php echo fmt($primary['food']); ?></td>
                                            <td class="px-4 py-3 text-right font-english"><?php echo fmt($primary['food']); ?></td>
                                            <td class="px-4 py-3 text-right font-english bg-slate-50/50 dark:bg-slate-950/30"><?php echo fmt(val($primary['food'])*2); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 font-bold text-slate-800 dark:text-slate-200">
                                                <span class="lang-th">3. ค่าศูนย์การเรียนรู้ดาราศาสตร์</span>
                                                <span class="lang-en hidden">3. Astronomy Learning Center</span>
                                            </td>
                                            <td class="px-4 py-3 text-right font-english"><?php echo fmt($primary['astro']); ?></td>
                                            <td class="px-4 py-3 text-right font-english">-</td>
                                            <td class="px-4 py-3 text-right font-english bg-slate-50/50 dark:bg-slate-950/30"><?php echo fmt($primary['astro']); ?></td>
                                        </tr>
                                        <tr class="bg-brand-500/5 text-brand-650 dark:text-blue-400 font-extrabold border-t-2 border-slate-200 dark:border-slate-800">
                                            <td class="px-4 py-3 text-sm">
                                                <span class="lang-th">ยอดรวมค่าธรรมเนียมต่อเทอม</span>
                                                <span class="lang-en hidden">Total per Semester</span>
                                            </td>
                                            <td class="px-4 py-3 text-right font-english text-slate-900 dark:text-white text-sm"><?php echo fmt(val($primary['tuition']) + val($primary['food']) + val($primary['astro'])); ?></td>
                                            <td class="px-4 py-3 text-right font-english text-slate-900 dark:text-white text-sm"><?php echo fmt(val($primary['tuition']) + val($primary['food'])); ?></td>
                                            <td class="px-4 py-3 text-right font-english bg-brand-500/10 text-brand-600 dark:text-blue-450 text-sm"><?php echo fmt((val($primary['tuition']) + val($primary['food'])) * 2 + val($primary['astro'])); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <strong class="block text-slate-800 dark:text-slate-200 text-xs font-bold pt-2">
                                <span class="lang-th">📋 สิ่งที่ได้รับเพิ่มเติม:</span>
                                <span class="lang-en hidden">📋 Additional Inclusions:</span>
                            </strong>
                            <ul class="space-y-2 text-slate-650 dark:text-slate-400 font-light leading-relaxed text-[11px] list-disc list-inside">
                                <li>
                                    <span class="lang-th">เรียนวิชาหลักในภาษาอังกฤษ (Math, Science, English, IT) โดยชาวต่างชาติเจ้าของภาษา</span>
                                    <span class="lang-en hidden">Core subjects taught in English (Math, Science, English, IT) by native/foreign speakers</span>
                                </li>
                                <li>
                                    <span class="lang-th">มีครูไทยช่วยประกบชั้นดูแลในห้องเรียนเพื่อช่วยเหลือนักเรียน</span>
                                    <span class="lang-en hidden">Thai co-teachers assisting in classrooms to nurture student growth</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Right: Textbooks & Uniforms (5 Columns) -->
                        <div class="md:col-span-5 space-y-4">
                            <strong class="block text-brand-accent text-sm font-bold">
                                <span class="lang-th">📚 แบบเรียนและเครื่องแบบนักเรียน</span>
                                <span class="lang-en hidden">📚 Textbooks & School Uniforms</span>
                            </strong>
                            
                            <!-- Textbooks Notice -->
                            <div class="p-4 bg-white dark:bg-slate-950 rounded-xl border border-slate-200 dark:border-slate-800 space-y-2 shadow-sm">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5">
                                    📖 
                                    <span class="lang-th">แบบเรียนและสมุด (ประมาณการ: 3,100 - 3,800 บาท / ปี)</span>
                                    <span class="lang-en hidden">Textbooks & Workbooks (Est: 3,100 - 3,800 THB / Year)</span>
                                </span>
                                <p class="text-[11px] text-slate-650 dark:text-slate-400 leading-relaxed font-light font-sans">
                                    <span class="lang-th">อัตราค่าแบบเรียนและสมุดในแต่ละระดับชั้นอาจมีการเปลี่ยนแปลงและไม่เท่ากันในแต่ละปีการศึกษา (อ้างอิงอัตราประมาณการขั้นต้นตามสถิติปีที่ผ่านมา) ขอให้ผู้ปกครองติดตามประกาศรายละเอียดและจัดเก็บอย่างเป็นทางการจากโครงการฯ ภาคภาษาอังกฤษ (EP) ก่อนเปิดภาคเรียน</span>
                                    <span class="lang-en hidden">Textbooks and workbook rates are subject to change and vary each academic year (estimated ranges are based on previous rates). Please wait for the official English Program announcement before the start of the semester.</span>
                                </p>
                            </div>

                            <!-- Uniforms Notice -->
                            <div class="p-4 bg-white dark:bg-slate-950 rounded-xl border border-slate-200 dark:border-slate-800 space-y-2 shadow-sm">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5">
                                    👕 
                                    <span class="lang-th">เครื่องแบบและชุดกิจกรรม (ประมาณการ: 1,500 - 3,000 บาท)</span>
                                    <span class="lang-en hidden">School Uniforms & Outfits (Est: 1,500 - 3,000 THB)</span>
                                </span>
                                <p class="text-[11px] text-slate-650 dark:text-slate-400 leading-relaxed font-light font-sans">
                                    <span class="lang-th">อัตราค่าเครื่องแบบนักเรียน ชุดพละ และชุดกิจกรรมพิเศษต่าง ๆ มีการเปลี่ยนแปลงตามขนาดและรูปแบบที่ซื้อจริง สามารถติดต่อสอบถามรายละเอียดราคาและจัดซื้อได้โดยตรงที่สหกรณ์ร้านค้าของโรงเรียนชลประทานวิทยา</span>
                                    <span class="lang-en hidden">Rates for school uniforms, physical education uniforms, and activity outfits vary depending on sizes and styles. Please check current prices and purchase directly at the school cooperative store.</span>
                                </p>
                            </div>
                            
                            <!-- Special Activities Note -->
                            <div class="p-3 bg-slate-50 dark:bg-slate-950 rounded-xl border border-slate-200 dark:border-slate-800 space-y-1 mt-2">
                                <span class="text-[11px] font-bold text-brand-500 block">✨ กิจกรรมเสริมพิเศษ (Special Activities)</span>
                                <p class="text-[10px] text-slate-650 dark:text-slate-400 leading-relaxed font-sans">
                                    <span class="lang-th">อาจมีค่าใช้จ่ายเพิ่มเติมสำหรับบางกิจกรรม เช่น กิจกรรมเข้าค่ายพักแรมต่างจังหวัด 3 วัน หรือหลักสูตรเรียนเสริมวันเสาร์ในระดับประถมศึกษา โปรดติดตามประกาศรายละเอียดจากทางโรงเรียนเป็นรายกิจกรรม</span>
                                    <span class="lang-en hidden">Additional fees may apply for specific activities such as a 3-day out-of-province camp or Saturday supplementary tutoring classes for Primary school. Please follow official school announcements.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- JUNIOR DETAILS -->
                <div id="details-junior" class="space-y-8 hidden">
                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span>📘</span>
                            <span class="lang-th">รายละเอียดระดับมัธยมศึกษาตอนต้น (ม.1 - ม.3)</span>
                            <span class="lang-en hidden">Junior High School Details (M.1 - M.3)</span>
                        </h4>
                        <span class="text-xs font-bold text-slate-450 font-english">Tuition Total: <?php echo fmt(val($junior['tuition']) * 2 + val($junior['astro'])); ?> THB / Year</span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 text-xs sm:text-sm">
                        <!-- Left: Itemized table & Inclusions (7 Columns) -->
                        <div class="md:col-span-7 space-y-4">
                            <strong class="block text-brand-500 dark:text-blue-400 text-sm font-bold">
                                <span class="lang-th">📊 รายการเปรียบเทียบค่าธรรมเนียมคงที่รายเทอม</span>
                                <span class="lang-en hidden">📊 Semester Fee Breakdown</span>
                            </strong>
                            <div class="border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm bg-white dark:bg-slate-950">
                                <table class="w-full text-left text-xs border-collapse">
                                    <thead>
                                        <tr class="bg-slate-50 dark:bg-slate-900 text-slate-700 dark:text-slate-300 font-bold border-b border-slate-200 dark:border-slate-800">
                                            <th class="px-4 py-3">
                                                <span class="lang-th">รายละเอียดค่าใช้จ่าย</span>
                                                <span class="lang-en hidden">Expense Item</span>
                                            </th>
                                            <th class="px-4 py-3 text-right">
                                                <span class="lang-th">ภาคเรียนที่ 1</span>
                                                <span class="lang-en hidden">Semester 1</span>
                                            </th>
                                            <th class="px-4 py-3 text-right">
                                                <span class="lang-th">ภาคเรียนที่ 2</span>
                                                <span class="lang-en hidden">Semester 2</span>
                                            </th>
                                            <th class="px-4 py-3 text-right bg-slate-100/50 dark:bg-slate-900/50">
                                                <span class="lang-th">รวมตลอดปี</span>
                                                <span class="lang-en hidden">Annual Total</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-600 dark:text-slate-400 font-medium">
                                        <tr>
                                            <td class="px-4 py-3 font-bold text-slate-800 dark:text-slate-200">
                                                <span class="lang-th">1. ค่าธรรมเนียมการศึกษา</span>
                                                <span class="lang-en hidden">1. Tuition Fee</span>
                                            </td>
                                            <td class="px-4 py-3 text-right font-english"><?php echo fmt($junior['tuition']); ?></td>
                                            <td class="px-4 py-3 text-right font-english"><?php echo fmt($junior['tuition']); ?></td>
                                            <td class="px-4 py-3 text-right font-english bg-slate-50/50 dark:bg-slate-950/30"><?php echo fmt(val($junior['tuition'])*2); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 font-bold text-slate-800 dark:text-slate-200">
                                                <span class="lang-th">2. ค่าศูนย์การเรียนรู้ดาราศาสตร์</span>
                                                <span class="lang-en hidden">2. Astronomy Learning Center</span>
                                            </td>
                                            <td class="px-4 py-3 text-right font-english"><?php echo fmt($junior['astro']); ?></td>
                                            <td class="px-4 py-3 text-right font-english">-</td>
                                            <td class="px-4 py-3 text-right font-english bg-slate-50/50 dark:bg-slate-950/30"><?php echo fmt($junior['astro']); ?></td>
                                        </tr>
                                        <tr class="bg-brand-accent/5 text-brand-accent font-extrabold border-t-2 border-slate-200 dark:border-slate-800">
                                            <td class="px-4 py-3 text-sm">
                                                <span class="lang-th">ยอดรวมค่าธรรมเนียมต่อเทอม</span>
                                                <span class="lang-en hidden">Total Fee Per Semester</span>
                                            </td>
                                            <td class="px-4 py-3 text-right font-english text-slate-900 dark:text-white text-sm"><?php echo fmt(val($junior['tuition']) + val($junior['astro'])); ?></td>
                                            <td class="px-4 py-3 text-right font-english text-slate-900 dark:text-white text-sm"><?php echo fmt(val($junior['tuition'])); ?></td>
                                            <td class="px-4 py-3 text-right font-english bg-brand-accent/10 text-brand-accent text-sm"><?php echo fmt(val($junior['tuition']) * 2 + val($junior['astro'])); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <strong class="block text-slate-800 dark:text-slate-200 text-xs font-bold pt-2">
                                <span class="lang-th">📋 สิ่งที่ได้รับเพิ่มเติม:</span>
                                <span class="lang-en hidden">📋 Included Features & Programs:</span>
                            </strong>
                            <ul class="space-y-2 text-slate-650 dark:text-slate-400 font-light leading-relaxed text-[11px] list-disc list-inside">
                                <li>
                                    <span class="lang-th">หลักสูตรวิทยาศาสตร์เชิงทดลองในห้องแล็บสะเต็ม (STEM Science Lab)</span>
                                    <span class="lang-en hidden">Hands-on STEM Science Laboratory curriculum</span>
                                </li>
                                <li>
                                    <span class="lang-th">การจัดค่ายกิจกรรมทักษะภาษาอังกฤษ (EP English Camp) และกิจกรรมวิชาการประจำปี</span>
                                    <span class="lang-en hidden">EP English Camp and annual academic enrichment symposiums</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Right: Textbooks & Uniforms (5 Columns) -->
                        <div class="md:col-span-5 space-y-4">
                            <strong class="block text-brand-accent text-sm font-bold">
                                <span class="lang-th">📚 แบบเรียนและเครื่องแบบนักเรียน</span>
                                <span class="lang-en hidden">📚 Textbooks & School Uniforms</span>
                            </strong>
                            
                            <!-- Textbooks Notice -->
                            <div class="p-4 bg-white dark:bg-slate-950 rounded-xl border border-slate-200 dark:border-slate-800 space-y-2 shadow-sm">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5">
                                    📖 
                                    <span class="lang-th">แบบเรียนและสมุด (ประมาณการ: 4,900 - 6,800 บาท / ปี)</span>
                                    <span class="lang-en hidden">Textbooks & Workbooks (Est: 4,900 - 6,800 THB / Year)</span>
                                </span>
                                <p class="text-[11px] text-slate-650 dark:text-slate-400 leading-relaxed font-light font-sans">
                                    <span class="lang-th">อัตราค่าแบบเรียนและสมุดในแต่ละระดับชั้นอาจมีการเปลี่ยนแปลงและไม่เท่ากันในแต่ละปีการศึกษา (อ้างอิงอัตราประมาณการขั้นต้นตามสถิติปีที่ผ่านมา) ขอให้ผู้ปกครองติดตามประกาศรายละเอียดและจัดเก็บอย่างเป็นทางการจากโครงการฯ ภาคภาษาอังกฤษ (EP) ก่อนเปิดภาคเรียน</span>
                                    <span class="lang-en hidden">Textbooks and workbook rates are subject to change and vary each academic year (estimated ranges are based on previous rates). Please wait for the official English Program announcement before the start of the semester.</span>
                                </p>
                            </div>

                            <!-- Uniforms Notice -->
                            <div class="p-4 bg-white dark:bg-slate-950 rounded-xl border border-slate-200 dark:border-slate-800 space-y-2 shadow-sm">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5">
                                    👕 
                                    <span class="lang-th">เครื่องแบบและชุดกิจกรรม (ประมาณการ: 1,500 - 3,000 บาท)</span>
                                    <span class="lang-en hidden">School Uniforms & Outfits (Est: 1,500 - 3,000 THB)</span>
                                </span>
                                <p class="text-[11px] text-slate-650 dark:text-slate-400 leading-relaxed font-light font-sans">
                                    <span class="lang-th">อัตราค่าเครื่องแบบนักเรียน ชุดพละ และชุดกิจกรรมพิเศษต่าง ๆ มีการเปลี่ยนแปลงตามขนาดและรูปแบบที่ซื้อจริง สามารถติดต่อสอบถามรายละเอียดราคาและจัดซื้อได้โดยตรงที่สหกรณ์ร้านค้าของโรงเรียนชลประทานวิทยา</span>
                                    <span class="lang-en hidden">Rates for school uniforms, physical education uniforms, and activity outfits vary depending on sizes and styles. Please check current prices and purchase directly at the school cooperative store.</span>
                                </p>
                            </div>
                            
                            <!-- Special Activities Note -->
                            <div class="p-3 bg-slate-50 dark:bg-slate-950 rounded-xl border border-slate-200 dark:border-slate-800 space-y-1 mt-2">
                                <span class="text-[11px] font-bold text-brand-accent block">
                                    <span class="lang-th">✨ กิจกรรมเสริมพิเศษ</span>
                                    <span class="lang-en hidden">✨ Special Activities</span>
                                </span>
                                <p class="text-[10px] text-slate-650 dark:text-slate-400 leading-relaxed font-sans">
                                    <span class="lang-th">อาจมีค่าใช้จ่ายเพิ่มเติมสำหรับบางกิจกรรม เช่น กิจกรรมเข้าค่ายพักแรมต่างจังหวัด 3 วัน หรือหลักสูตรเรียนเสริมวันเสาร์ในระดับมัธยมศึกษาตอนต้น โปรดติดตามประกาศรายละเอียดจากทางโรงเรียนเป็นรายกิจกรรม</span>
                                    <span class="lang-en hidden">Additional fees may apply for specific activities such as a 3-day out-of-province camp or Saturday supplementary tutoring classes for Junior High school. Please follow official school announcements.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SENIOR DETAILS -->
                <div id="details-senior" class="space-y-8 hidden">
                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-4">
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span>📕</span>
                            <span class="lang-th">รายละเอียดระดับมัธยมศึกษาตอนปลาย (ม.4 - ม.6)</span>
                            <span class="lang-en hidden">Senior High School Details (M.4 - M.6)</span>
                        </h4>
                        <span class="text-xs font-bold text-slate-450 font-english">Tuition Total: <?php echo fmt(val($senior['tuition']) * 2 + val($senior['astro'])); ?> THB / Year</span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 text-xs sm:text-sm">
                        <!-- Left: Itemized table (7 Columns) -->
                        <div class="md:col-span-7 space-y-4">
                            <strong class="block text-brand-500 dark:text-blue-400 text-sm font-bold">
                                <span class="lang-th">📊 รายการเปรียบเทียบค่าธรรมเนียมคงที่รายเทอม</span>
                                <span class="lang-en hidden">📊 Semester Fee Breakdown</span>
                            </strong>
                            <div class="border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm bg-white dark:bg-slate-950">
                                <table class="w-full text-left text-xs border-collapse">
                                    <thead>
                                        <tr class="bg-slate-50 dark:bg-slate-900 text-slate-700 dark:text-slate-300 font-bold border-b border-slate-200 dark:border-slate-800">
                                            <th class="px-4 py-3">
                                                <span class="lang-th">รายละเอียดค่าใช้จ่าย</span>
                                                <span class="lang-en hidden">Expense Item</span>
                                            </th>
                                            <th class="px-4 py-3 text-right">
                                                <span class="lang-th">ภาคเรียนที่ 1</span>
                                                <span class="lang-en hidden">Semester 1</span>
                                            </th>
                                            <th class="px-4 py-3 text-right">
                                                <span class="lang-th">ภาคเรียนที่ 2</span>
                                                <span class="lang-en hidden">Semester 2</span>
                                            </th>
                                            <th class="px-4 py-3 text-right bg-slate-100/50 dark:bg-slate-900/50">
                                                <span class="lang-th">รวมตลอดปี</span>
                                                <span class="lang-en hidden">Annual Total</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-600 dark:text-slate-400 font-medium">
                                        <tr>
                                            <td class="px-4 py-3 font-bold text-slate-800 dark:text-slate-200">
                                                <span class="lang-th">1. ค่าธรรมเนียมการศึกษา</span>
                                                <span class="lang-en hidden">1. Tuition Fee</span>
                                            </td>
                                            <td class="px-4 py-3 text-right font-english"><?php echo fmt($senior['tuition']); ?></td>
                                            <td class="px-4 py-3 text-right font-english"><?php echo fmt($senior['tuition']); ?></td>
                                            <td class="px-4 py-3 text-right font-english bg-slate-50/50 dark:bg-slate-950/30"><?php echo fmt(val($senior['tuition'])*2); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 font-bold text-slate-800 dark:text-slate-200">
                                                <span class="lang-th">2. ค่าศูนย์การเรียนรู้ดาราศาสตร์</span>
                                                <span class="lang-en hidden">2. Astronomy Learning Center</span>
                                            </td>
                                            <td class="px-4 py-3 text-right font-english"><?php echo fmt($senior['astro']); ?></td>
                                            <td class="px-4 py-3 text-right font-english">-</td>
                                            <td class="px-4 py-3 text-right font-english bg-slate-50/50 dark:bg-slate-950/30"><?php echo fmt($senior['astro']); ?></td>
                                        </tr>
                                        <tr class="bg-emerald-500/5 text-emerald-600 dark:text-emerald-450 font-extrabold border-t-2 border-slate-200 dark:border-slate-800">
                                            <td class="px-4 py-3 text-sm">
                                                <span class="lang-th">ยอดรวมค่าธรรมเนียมต่อเทอม</span>
                                                <span class="lang-en hidden">Total Fee Per Semester</span>
                                            </td>
                                            <td class="px-4 py-3 text-right font-english text-slate-900 dark:text-white text-sm"><?php echo fmt(val($senior['tuition']) + val($senior['astro'])); ?></td>
                                            <td class="px-4 py-3 text-right font-english text-slate-900 dark:text-white text-sm"><?php echo fmt(val($senior['tuition'])); ?></td>
                                            <td class="px-4 py-3 text-right font-english bg-emerald-500/10 text-emerald-600 dark:text-emerald-455 text-sm"><?php echo fmt(val($senior['tuition']) * 2 + val($senior['astro'])); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <strong class="block text-slate-800 dark:text-slate-200 text-xs font-bold pt-2">
                                <span class="lang-th">📋 สิ่งที่ได้รับเพิ่มเติม:</span>
                                <span class="lang-en hidden">📋 Included Features & Programs:</span>
                            </strong>
                            <ul class="space-y-2 text-slate-650 dark:text-slate-400 font-light leading-relaxed text-[11px] list-disc list-inside">
                                <li>
                                    <span class="lang-th">คอร์สเตรียมสอบวัดระดับ IELTS และอบรมเชิงวิชาการเพื่อยื่นเข้าศึกษาต่อหลักสูตรนานาชาติ</span>
                                    <span class="lang-en hidden">IELTS preparation courses and academic workshops for international university applications</span>
                                </li>
                                <li>
                                    <span class="lang-th">จัดเตรียมคอร์ส Roadshow และแนะแนวอาชีพ/สถาบันอุดมศึกษาชั้นนำ</span>
                                    <span class="lang-en hidden">Higher education roadshows and career guidance from leading universities</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Right: Textbooks & Uniforms (5 Columns) -->
                        <div class="md:col-span-5 space-y-4">
                            <strong class="block text-brand-accent text-sm font-bold">
                                <span class="lang-th">📚 แบบเรียนและเครื่องแบบนักเรียน</span>
                                <span class="lang-en hidden">📚 Textbooks & School Uniforms</span>
                            </strong>
                            
                            <!-- Textbooks Notice -->
                            <div class="p-4 bg-white dark:bg-slate-950 rounded-xl border border-slate-200 dark:border-slate-800 space-y-2 shadow-sm">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5">
                                    📖 
                                    <span class="lang-th">แบบเรียนและสมุด (ประมาณการ: 1,800 - 3,100 บาท / ปี)</span>
                                    <span class="lang-en hidden">Textbooks & Workbooks (Est: 1,800 - 3,100 THB / Year)</span>
                                </span>
                                <p class="text-[11px] text-slate-655 dark:text-slate-400 leading-relaxed font-light font-sans">
                                    <span class="lang-th">อัตราค่าแบบเรียนและสมุดในแต่ละระดับชั้นอาจมีการเปลี่ยนแปลงและไม่เท่ากันในแต่ละปีการศึกษา (ประมาณการขั้นต้นอ้างอิงจากข้อมูลสถิติมัธยมศึกษาปีที่ผ่านมา) ขอให้ผู้ปกครองติดตามประกาศรายละเอียดและจัดเก็บอย่างเป็นทางการจากโครงการฯ ภาคภาษาอังกฤษ (EP) ก่อนเปิดภาคเรียน ในบางรายวิชาครูผู้สอนอาจจัดเตรียมเอกสารทดแทนให้</span>
                                    <span class="lang-en hidden">Textbooks and workbook rates are subject to change and vary each academic year (estimates are based on previous years' statistics). Please wait for the official English Program announcement before the start of the semester. For some senior classes, tutoring hand-outs may be used.</span>
                                </p>
                            </div>

                            <!-- Uniforms Notice -->
                            <div class="p-4 bg-white dark:bg-slate-950 rounded-xl border border-slate-200 dark:border-slate-800 space-y-2 shadow-sm">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5">
                                    👕 
                                    <span class="lang-th">เครื่องแบบและชุดกิจกรรม (ประมาณการ: 1,500 - 3,000 บาท)</span>
                                    <span class="lang-en hidden">School Uniforms & Outfits (Est: 1,500 - 3,000 THB)</span>
                                </span>
                                <p class="text-[11px] text-slate-650 dark:text-slate-400 leading-relaxed font-light font-sans">
                                    <span class="lang-th">อัตราค่าเครื่องแบบนักเรียน ชุดพละ และชุดกิจกรรมพิเศษต่าง ๆ มีการเปลี่ยนแปลงตามขนาดและรูปแบบที่ซื้อจริง สามารถติดต่อสอบถามรายละเอียดราคาและจัดซื้อได้โดยตรงที่สหกรณ์ร้านค้าของโรงเรียนชลประทานวิทยา</span>
                                    <span class="lang-en hidden">Rates for school uniforms, physical education uniforms, and activity outfits vary depending on sizes and styles. Please check current prices and purchase directly at the school cooperative store.</span>
                                </p>
                            </div>
                            
                            <!-- Special Activities Note -->
                            <div class="p-3 bg-slate-50 dark:bg-slate-950 rounded-xl border border-slate-200 dark:border-slate-800 space-y-1 mt-2">
                                <span class="text-[11px] font-bold text-emerald-600 dark:text-emerald-450 block">✨ กิจกรรมเสริมพิเศษ (Special Activities)</span>
                                <p class="text-[10px] text-slate-650 dark:text-slate-400 leading-relaxed font-sans">
                                    <span class="lang-th">อาจมีค่าใช้จ่ายเพิ่มเติมสำหรับบางกิจกรรม เช่น กิจกรรมเข้าค่ายพักแรมต่างจังหวัด 3 วัน โปรดติดตามประกาศรายละเอียดจากทางโรงเรียนเป็นรายกิจกรรม</span>
                                    <span class="lang-en hidden">Additional fees may apply for specific activities such as a 3-day out-of-province camp. Please follow official school announcements.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- NOTICE: Incoming Students Summer Camp -->
        <div class="bg-amber-50/60 dark:bg-slate-900/40 border border-amber-200 dark:border-slate-800 rounded-3xl p-6 flex flex-col sm:flex-row gap-5 items-start shadow-sm">
            <div class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-950/40 flex items-center justify-center text-xl flex-shrink-0">⛺</div>
            <div class="space-y-2">
                <h4 class="text-sm font-extrabold text-amber-800 dark:text-amber-400 uppercase tracking-wider">
                    <span class="lang-th">ข้อมูลเพิ่มเติมสำหรับนักเรียนเข้าใหม่</span>
                    <span class="lang-en hidden">Notice for Newly Enrolled Students</span>
                </h4>
                <div class="text-xs sm:text-sm text-slate-650 dark:text-slate-350 leading-relaxed font-light space-y-1.5 font-sans">
                    <p>
                        <span class="lang-th">• <strong>ค่ายปรับพื้นฐาน (Foundation Camp)</strong>: สำหรับนักเรียนแรกเข้าใหม่ทุกคน มีค่าใช้จ่ายเพิ่มเติมจำนวน <strong>3,500 บาท</strong> เพื่อเตรียมความพร้อมในช่วงซัมเมอร์ก่อนเปิดภาคเรียนแรก</span>
                        <span class="lang-en hidden">• <strong>Foundation Camp</strong>: For all newly enrolled students, with an additional cost of <strong>3,500 THB</strong> during the summer before their first semester starts.</span>
                    </p>
                    <p>
                        <span class="lang-th">• <strong>ค่ายซัมเมอร์ Daycamp</strong>: กิจกรรมเรียนซัมเมอร์ 10 วันที่โรงเรียนในช่วงเดือนเมษายน มีอัตราค่าเรียน <strong>3,500 บาท</strong> เช่นกัน โดยจะไม่บังคับเข้าร่วมสำหรับนักเรียนชั้นปีถัดไปหลังจากผ่านการศึกษาในปีแรกแล้ว</span>
                        <span class="lang-en hidden">• <strong>Summer Daycamp</strong>: A 10-day summer course at the school in April, costing <strong>3,500 THB</strong>. Attendance is optional for students in subsequent years.</span>
                    </p>
                    <p class="pt-2 border-t border-amber-200/50 text-[10px] text-amber-800/80 dark:text-amber-500/80 font-bold space-y-1">
                        <span class="block">
                            <span class="lang-th">*หมายเหตุ: อัตราค่าเล่าเรียนและค่าธรรมเนียมการศึกษาของโรงเรียนอาจมีการปรับเปลี่ยนและไม่เท่ากันในแต่ละปีการศึกษา ขึ้นอยู่กับประกาศอย่างเป็นทางการของโรงเรียนชลประทานวิทยา</span>
                            <span class="lang-en hidden">*Note: Tuition rates and academic fees are subject to change and may vary from year to year in accordance with official announcements from Chonprathanwittaya School.</span>
                        </span>
                        <span class="block text-brand-accent">
                            <span class="lang-th">**นอกจากนี้ อาจมีค่าใช้จ่ายสำหรับกิจกรรมพิเศษหรือโครงการพัฒนาผู้เรียนอื่น ๆ เพิ่มเติมในระหว่างปีการศึกษา ซึ่งทางโครงการจะแจ้งรายละเอียดและจัดเก็บบริการเป็นรายกิจกรรมล่วงหน้า</span>
                            <span class="lang-en hidden">**Additionally, there may be extra fees for other student enrichment activities or special camps throughout the academic year, which will be announced and collected on a per-activity basis.</span>
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- SECTION 3: Payment Channels -->
        <section class="space-y-6 pt-4 border-t border-slate-250 dark:border-slate-800">
            <div class="space-y-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold text-xs">
                    <span class="lang-th">การชำระเงิน</span>
                    <span class="lang-en hidden">Payments</span>
                </span>
                <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white tracking-tight">
                    <span class="lang-th">ช่องทางการชำระเงินค่าธรรมเนียมการศึกษาและค่าธรรมเนียมอื่น</span>
                    <span class="lang-en hidden">Official Payment Channels</span>
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-stretch">
                <!-- Instructions List (Left Side - 7 Cols) -->
                <div class="md:col-span-7 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 space-y-6 shadow-sm flex flex-col justify-between">
                    <div class="space-y-5 text-xs sm:text-sm text-slate-650 dark:text-slate-355 leading-relaxed font-light font-sans">
                        <div class="space-y-2">
                            <strong class="text-slate-900 dark:text-white font-bold text-sm block">
                                <span class="lang-th">1. ชำระที่โรงเรียน (On-site Payment)</span>
                                <span class="lang-en hidden">1. On-site Payment at School</span>
                            </strong>
                            <ul class="list-disc list-inside space-y-1 pl-2">
                                <li>
                                    <span class="lang-th">ชำระเป็นเงินสด</span>
                                    <span class="lang-en hidden">Cash payment</span>
                                </li>
                                <li>
                                    <span class="lang-th">ชำระด้วยบัตรเครดิต (มีค่าธรรมเนียมบัตรเครดิตร้อยละ 2)</span>
                                    <span class="lang-en hidden">Credit card payment (2% credit card fee applies)</span>
                                </li>
                                <li>
                                    <span class="lang-th">ชำระด้วยบัตรเครดิตธนาคารกสิกรไทย (ผ่อนชำระ 3 เดือน ฟรีค่าธรรมเนียม, ผ่อนชำระ 6 เดือน คิดดอกเบี้ยร้อยละ 0.5)</span>
                                    <span class="lang-en hidden">Kasikornbank credit card (3-month installment 0% interest, 6-month installment 0.5% interest)</span>
                                </li>
                            </ul>
                        </div>
                        <div class="space-y-1">
                            <strong class="text-slate-900 dark:text-white font-bold text-sm block">
                                <span class="lang-th">2. ชำระผ่าน Application CPW School</span>
                                <span class="lang-en hidden">2. Payment via CPW School Mobile App</span>
                            </strong>
                            <p class="pl-2">
                                <span class="lang-th">ดาวน์โหลดแอปพลิเคชัน CPW School บนมือถือของท่านเพื่อเข้าตรวจสอบรายการแจ้งยอดและชำระออนไลน์ผ่านโมบายแบงก์กิ้งได้ทันที</span>
                                <span class="lang-en hidden">Download the CPW School application on your mobile device to view invoices and pay seamlessly via mobile banking.</span>
                            </p>
                        </div>
                        <div class="space-y-1">
                            <strong class="text-slate-900 dark:text-white font-bold text-sm block">
                                <span class="lang-th">3. ชำระผ่านเว็บไซต์ CPW Register</span>
                                <span class="lang-en hidden">3. Payment via CPW Register Website</span>
                            </strong>
                            <p class="pl-2">
                                <span class="lang-th">ล็อกอินเข้าระบบทางเว็บไซต์ลงทะเบียนเรียนหลักของโรงเรียน <a href="https://www.cpw.ac.th/cpw_register" target="_blank" class="text-brand-500 hover:text-brand-accent transition underline font-bold">www.cpw.ac.th/cpw_register</a> หรือสแกน QR Code ท้ายประกาศนี้</span>
                                <span class="lang-en hidden">Log in through the school's official registration portal at <a href="https://www.cpw.ac.th/cpw_register" target="_blank" class="text-brand-500 hover:text-brand-accent transition underline font-bold">www.cpw.ac.th/cpw_register</a> or scan the QR Code below.</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-2 w-full pt-4 border-t border-slate-100 dark:border-slate-800">
                        <a href="contact.php" class="px-4 py-2.5 bg-brand-500 hover:bg-brand-600 text-white rounded-lg text-xs font-bold transition shadow-sm text-center flex-1 sm:flex-none">
                            <span class="lang-th">ติดต่อฝ่ายธุรการการเงิน</span>
                            <span class="lang-en hidden">Contact Finance & Registrar</span>
                        </a>
                        <a href="https://app.cpw.ac.th/cpw_api_content/files/220260428081646207338436.pdf" target="_blank" class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-lg text-xs font-bold transition text-center flex-1 sm:flex-none">
                            <span class="lang-th">เปิดไฟล์เอกสารประกาศ (PDF)</span>
                            <span class="lang-en hidden">Official Announcement (PDF)</span>
                        </a>
                    </div>
                </div>

                <!-- QR Codes (Right Side - 5 Cols) -->
                <div class="md:col-span-5 bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-855 rounded-3xl p-6 sm:p-8 flex flex-col justify-center items-center gap-6 text-center">
                    <div class="space-y-1">
                        <strong class="block text-slate-800 dark:text-slate-200 text-xs sm:text-sm font-bold">
                            <span class="lang-th">สแกนเพื่อตรวจสอบประวัติและการชำระเงิน</span>
                            <span class="lang-en hidden">Scan to Verify Invoice & Payment</span>
                        </strong>
                        <p class="text-[10px] text-slate-400 font-light">
                            <span class="lang-th">QR Code สำหรับเชื่อมต่อไปยังระบบลงทะเบียนออนไลน์</span>
                            <span class="lang-en hidden">QR Code for quick access to the online registration system</span>
                        </p>
                    </div>
                    <div class="flex justify-center gap-4">
                        <div class="p-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl flex flex-col items-center gap-1.5 shadow-sm w-32">
                            <div class="w-20 h-20 bg-slate-200 dark:bg-slate-950 rounded flex items-center justify-center text-xl font-bold border border-slate-300 dark:border-slate-800 font-english">QR</div>
                            <span class="text-[9px] font-bold text-slate-500">CPW Register</span>
                        </div>
                        <div class="p-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl flex flex-col items-center gap-1.5 shadow-sm w-32">
                            <div class="w-20 h-20 bg-slate-200 dark:bg-slate-950 rounded flex items-center justify-center text-xl font-bold border border-slate-300 dark:border-slate-800 font-english">QR</div>
                            <span class="text-[9px] font-bold text-slate-500">
                                <span class="lang-th">วิธีการชำระเงิน</span>
                                <span class="lang-en hidden">Payment Guide</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>

    <?php include 'login_modal.php'; ?>

    <script>
        function selectLevel(level) {
            // Remove active classes from all cards
            const levels = ['primary', 'junior', 'senior'];
            levels.forEach(lvl => {
                const card = document.getElementById(`card-${lvl}`);
                const detail = document.getElementById(`details-${lvl}`);
                
                if (card) {
                    card.className = "text-left w-full border-2 border-slate-200 dark:border-slate-855 rounded-3xl p-6 sm:p-8 space-y-5 bg-white dark:bg-slate-900 flex flex-col justify-between hover:shadow transition-all duration-300 focus:outline-none";
                }
                if (detail) {
                    detail.classList.add('hidden');
                }
            });

            // Add active classes to selected card
            const selectedCard = document.getElementById(`card-${level}`);
            const selectedDetail = document.getElementById(`details-${level}`);
            
            let activeColorClass = "border-brand-500 ring-2 ring-brand-500/10";
            if (level === 'junior') {
                activeColorClass = "border-brand-accent ring-2 ring-brand-accent/10";
            } else if (level === 'senior') {
                activeColorClass = "border-emerald-500 ring-2 ring-emerald-500/10";
            }

            if (selectedCard) {
                selectedCard.className = `text-left w-full border-2 ${activeColorClass} rounded-3xl p-6 sm:p-8 space-y-5 bg-white dark:bg-slate-900 flex flex-col justify-between shadow transition-all duration-300 focus:outline-none`;
            }
            if (selectedDetail) {
                selectedDetail.classList.remove('hidden');
            }
        }

        function checkHash() {
            const hash = window.location.hash;
            if (hash) {
                const cleanHash = hash.replace('#', '');
                const levels = ['primary', 'junior', 'senior'];
                if (levels.includes(cleanHash)) {
                    selectLevel(cleanHash);
                    const card = document.getElementById('card-' + cleanHash);
                    if (card) {
                        card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            selectLevel('primary');
            checkHash();
        });
        window.addEventListener('hashchange', checkHash);
    </script>

</body>
</html>
