<?php
$pageTitle = "ข้อมูลการรับสมัครเรียน | English Program (EP) CPW";
$currentPage = "admission";
$settings = json_decode(file_get_contents('data/db_site_settings.json'), true);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <?php include 'head.php'; ?>
</head>
<body class="bg-slate-50 text-slate-800 font-sans transition-colors duration-300 dark:bg-slate-900 dark:text-slate-100 min-h-screen flex flex-col">

    <?php include 'header.php'; ?>

    <!-- HEADER BANNER -->
    <header class="relative bg-slate-950 text-white py-24 px-4 overflow-hidden flex items-center justify-center bg-cover bg-center" style="background-image: url('https://app.cpw.ac.th/cpw_api_content/images/activities/2026-08/320260822162040/32026082216204020260824114424_685193.jpg');">
        <div class="absolute inset-0 bg-slate-950/75"></div>
        <div class="relative max-w-4xl mx-auto text-center space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-accent/10 border border-brand-accent/25 text-brand-accent text-xs font-bold font-english uppercase tracking-wider">
                Admissions Open
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-tight">
                <span class="lang-th">การรับสมัครนักเรียนใหม่</span>
                <span class="lang-en hidden">Admissions & Enrollments</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base font-normal max-w-2xl mx-auto leading-relaxed">
                <span class="lang-th">ข้อมูลหลักเกณฑ์การรับสมัคร ขั้นตอน และกำหนดการประจำปีการศึกษา 2570 โครงการฯ ภาคภาษาอังกฤษ (EP)</span>
                <span class="lang-en hidden">Admission guidelines, procedures, and official calendars for the academic year 2027.</span>
            </p>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-grow max-w-[1400px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 space-y-16">
        
        <!-- CALL-TO-ACTION & SYSTEM PORTAL LINK -->
        <section class="bg-gradient-to-br from-blue-900 via-indigo-950 to-slate-950 rounded-3xl p-6 sm:p-10 text-white shadow-xl border border-blue-500/20 relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                
                <div class="space-y-4 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs font-bold">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="lang-th">ระบบรับสมัครออนไลน์เปิดให้บริการแล้ว</span>
                        <span class="lang-en hidden">Online Admissions System is Now Active</span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-black tracking-tight leading-tight">
                        <span class="lang-th">สมัครเข้าเรียนโครงการฯ ภาคภาษาอังกฤษ (EP)</span>
                        <span class="lang-en hidden">Apply Online for English Program (EP)</span>
                    </h2>

                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed font-light">
                        <span class="lang-th">ผู้ปกครองสามารถกรอกข้อมูลสมัครเรียนผ่านระบบกลางของโรงเรียนชลประทานวิทยา พิมพ์ใบสมัคร และนำเอกสารหลักฐานตัวจริงมาแสดงในวันคัดเลือก/สัมภาษณ์</span>
                        <span class="lang-en hidden">Parents may submit applications via the central registration portal of Chonprathanwittaya School, print out application forms, and present official credentials on interview day.</span>
                    </p>

                    <!-- CAUTION NOTICE: EP VS ECP -->
                    <div class="p-4 bg-amber-500/10 border border-amber-400/30 rounded-2xl flex items-start gap-3">
                        <span class="text-xl flex-shrink-0">⚠️</span>
                        <div class="text-xs leading-relaxed text-amber-200">
                            <strong class="font-bold text-amber-300 block mb-0.5">
                                <span class="lang-th">ข้อสังเกตสำคัญในขั้นตอนเลือกหลักสูตร (ป้องกันความสับสน)</span>
                                <span class="lang-en hidden">Important Advisory on Program Selection</span>
                            </strong>
                            <span class="lang-th">
                                ในระบบรับสมัครออนไลน์ โปรดเลือกตัวเลือก <strong>"โครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ (English Program : EP)"</strong> 
                                <br><span class="text-amber-300/80 font-normal">*(ข้อควรระวัง: โครงการ EP จัดการเรียนการสอนเป็นภาษาอังกฤษในวิชาหลัก แตกต่างจากหลักสูตรอื่นของโรงเรียน)*</span>
                            </span>
                            <span class="lang-en hidden">
                                In the online portal, please specifically select <strong>"English Program (EP)"</strong>.
                                <br><span class="text-amber-300/80 font-normal">*(Note: English Program conducts core subjects in English by native/foreign teachers, distinct from other curriculums)*</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Button Cluster -->
                <div class="flex flex-col sm:flex-row lg:flex-col gap-3 w-full lg:w-auto flex-shrink-0">
                    <a href="https://www.cpw.ac.th/admission/register/index.php" target="_blank" class="px-6 py-4 bg-blue-600 hover:bg-blue-500 text-white rounded-2xl text-center font-bold text-sm sm:text-base shadow-lg shadow-blue-600/30 transition-all duration-200 flex items-center justify-center gap-2 group">
                        <span>📝</span>
                        <span class="lang-th">เข้าสู่ระบบรับสมัครออนไลน์</span>
                        <span class="lang-en hidden">Open Online Registration Portal</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>

                    <a href="#details-primary" class="px-6 py-3.5 bg-white/10 hover:bg-white/15 border border-white/15 text-white rounded-2xl text-center font-medium text-xs sm:text-sm transition text-slate-200 flex items-center justify-center gap-1.5">
                        <span>📋</span>
                        <span class="lang-th">ดูเอกสารที่ต้องเตรียม &amp; กำหนดการ</span>
                        <span class="lang-en hidden">Check Required Documents &amp; Dates</span>
                    </a>
                </div>

            </div>
        </section>
        
        <!-- INTRO & CALENDAR SELECTOR -->
        <section class="space-y-12">
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-500/10 text-brand-500 dark:text-blue-400 font-bold text-xs">
                    <span class="lang-th">ปีการศึกษา 2570 (Academic Year 2027)</span>
                    <span class="lang-en hidden">Academic Year 2027 (Admissions Open)</span>
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-950 dark:text-white tracking-tight">
                    <span class="lang-th">เลือกระดับชั้นเพื่อดูขั้นตอนและเอกสารที่ต้องใช้</span>
                    <span class="lang-en hidden">Select Level to View Procedures & Requirements</span>
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                    <span class="lang-th">*ข้อมูลกำหนดการรับสมัครนักเรียนใหม่ ประจำปีการศึกษา 2570 โครงการฯ ภาคภาษาอังกฤษ (EP)</span>
                    <span class="lang-en hidden">*Official admission procedures and schedules for Academic Year 2027, English Program (EP)</span>
                </p>
            </div>

            <!-- Grade Tabs Switcher Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Primary Card Button -->
                <button onclick="selectLevel('primary')" id="card-primary" class="text-left w-full border-2 border-brand-500 ring-2 ring-brand-500/10 rounded-3xl p-6 sm:p-8 space-y-4 bg-white dark:bg-slate-900 flex flex-col justify-between hover:shadow transition-all duration-300 focus:outline-none">
                    <div class="space-y-2 w-full">
                        <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400 bg-blue-100/50 dark:bg-blue-950/30 px-2.5 py-0.5 rounded">Primary School</span>
                        <h4 class="font-extrabold text-slate-900 dark:text-white text-lg">
                            <span class="lang-th">ประถมศึกษาปีที่ 1 (ป.1)</span>
                            <span class="lang-en hidden">Primary 1 (P.1)</span>
                        </h4>
                        <p class="text-xs text-slate-500">
                            <span class="lang-th">รับสมัครนักเรียนชั้นอนุบาล 3 และภายนอกเพื่อขึ้นชั้นประถมศึกษา</span>
                            <span class="lang-en hidden">Open for Kindergarten 3 graduates and external applicants.</span>
                        </p>
                        <span class="text-xs text-brand-500 dark:text-blue-400 font-bold block pt-2">
                            <span class="lang-th">คลิกตรวจสอบกำหนดการ &rarr;</span>
                            <span class="lang-en hidden">View Schedule & Criteria &rarr;</span>
                        </span>
                    </div>
                </button>

                <!-- Junior High Card Button -->
                <button onclick="selectLevel('junior')" id="card-junior" class="text-left w-full border-2 border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 space-y-4 bg-white dark:bg-slate-900 flex flex-col justify-between hover:shadow transition-all duration-300 focus:outline-none">
                    <div class="space-y-2 w-full">
                        <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-brand-accent bg-brand-accent/10 px-2.5 py-0.5 rounded">Junior High</span>
                        <h4 class="font-extrabold text-slate-900 dark:text-white text-lg">
                            <span class="lang-th">มัธยมศึกษาปีที่ 1 (ม.1)</span>
                            <span class="lang-en hidden">Junior High 1 (M.1)</span>
                        </h4>
                        <p class="text-xs text-slate-500">
                            <span class="lang-th">รับสมัครจบชั้น ป.6 เกรดเฉลี่ยสะสมไม่ต่ำกว่า 3.50 สอบประเมินคณิตศาสตร์ &amp; อังกฤษ</span>
                            <span class="lang-en hidden">P.6 graduates, GPA ≥ 3.50, examination in Math &amp; English.</span>
                        </p>
                        <span class="text-xs text-brand-accent font-bold block pt-2">
                            <span class="lang-th">คลิกตรวจสอบกำหนดการ &rarr;</span>
                            <span class="lang-en hidden">View Schedule & Criteria &rarr;</span>
                        </span>
                    </div>
                </button>

                <!-- Senior High Card Button -->
                <button onclick="selectLevel('senior')" id="card-senior" class="text-left w-full border-2 border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 space-y-4 bg-white dark:bg-slate-900 flex flex-col justify-between hover:shadow transition-all duration-300 focus:outline-none">
                    <div class="space-y-2 w-full">
                        <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-450 bg-emerald-100/50 dark:bg-emerald-950/30 px-2.5 py-0.5 rounded">Senior High</span>
                        <h4 class="font-extrabold text-slate-900 dark:text-white text-lg">
                            <span class="lang-th">มัธยมศึกษาปีที่ 4 (ม.4)</span>
                            <span class="lang-en hidden">Senior High 4 (M.4)</span>
                        </h4>
                        <p class="text-xs text-slate-500">
                            <span class="lang-th">รับสมัครจบชั้น ม.3 แผนวิทย์-คณิต และคณิต-อังกฤษ (จีน / ญี่ปุ่น)</span>
                            <span class="lang-en hidden">M.3 graduates, Sci-Math &amp; Math-Eng tracks (Chinese/Japanese electives).</span>
                        </p>
                        <span class="text-xs text-emerald-600 dark:text-emerald-400 font-bold block pt-2">
                            <span class="lang-th">คลิกตรวจสอบกำหนดการ &rarr;</span>
                            <span class="lang-en hidden">View Schedule & Criteria &rarr;</span>
                        </span>
                    </div>
                </button>
            </div>
        </section>

        <!-- DETAILS WRAPPER -->
        <section class="space-y-8">
            <div id="details-primary" class="space-y-8">
                <!-- G1 HEADER -->
                <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white flex items-center gap-2">
                        <span>🏫</span>
                        <span class="lang-th">การรับสมัครชั้นประถมศึกษาปีที่ 1 (ป.1)</span>
                        <span class="lang-en hidden">Primary 1 Admission (P.1)</span>
                    </h3>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <!-- Left: Admission calendars (7 Cols) -->
                    <div class="lg:col-span-7 space-y-6">
                        <h4 class="text-sm font-extrabold text-brand-500 dark:text-blue-400 uppercase tracking-wider">
                            <span class="lang-th">📅 ขั้นตอนและปฏิทินรับสมัคร</span>
                            <span class="lang-en hidden">📅 Admissions Timeline & Procedures</span>
                        </h4>
                        
                        <!-- Internal vs External subtabs display -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Internal Box -->
                            <div class="p-5 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl space-y-4">
                                <span class="px-2.5 py-0.5 rounded bg-blue-100 dark:bg-blue-950 text-blue-700 dark:text-blue-300 text-[10px] font-bold uppercase block w-max">
                                    <span class="lang-th">นักเรียนเก่า ช.ป.ว. (อนุบาล 3)</span>
                                    <span class="lang-en hidden">Current CPW Students (K.3)</span>
                                </span>
                                <ul class="space-y-3.5 text-xs text-slate-650 dark:text-slate-400">
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">ยื่นใบสมัครที่ครูประจำชั้น:</strong>
                                            <strong class="lang-en hidden">Submit application to Homeroom:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">3 - 10 พฤศจิกายน 2568</span>
                                                <span class="lang-en hidden">November 3 - 10, 2025</span>
                                            </span><br>
                                            <span class="text-[11px] text-slate-500">
                                                <span class="lang-th">(ไม่มีค่าธรรมเนียมใบสมัครสำหรับนักเรียนเดิม)</span>
                                                <span class="lang-en hidden">(No application fee for current CPW students)</span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">การสัมภาษณ์นักเรียน/ผู้ปกครอง:</strong>
                                            <strong class="lang-en hidden">Student & Parent Interview:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">17 - 21 พ.ย. 68 (รอบบ่าย 13.00 - 15.00 น.)</span>
                                                <span class="lang-en hidden">Nov 17 - 21, 2025 (Afternoon 13:00 - 15:00)</span>
                                            </span><br>
                                            <span class="text-[11px] text-slate-500">
                                                <span class="lang-th">อาคาร EP ชั้น 1 (แบ่งตามรอบประกาศรายชื่อ)</span>
                                                <span class="lang-en hidden">EP Bldg. 1st Fl. (As per schedule announcement)</span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">ประกาศผล &amp; ยืนยันสิทธิ์:</strong>
                                            <strong class="lang-en hidden">Results Announcement &amp; Confirmation:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">ประกาศผล: 26 พ.ย. 68 (ออนไลน์)</span>
                                                <span class="lang-en hidden">Results: Nov 26, 2025 (Online)</span>
                                            </span><br>
                                            <span class="text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold">
                                                <span class="lang-th">ยืนยันสิทธิ์รายงานตัวออนไลน์ (ไม่ต้องมาโรงเรียน)</span>
                                                <span class="lang-en hidden">Confirm admission online (No on-site trip required)</span>
                                            </span><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">ทำสัญญา &amp; มอบตัว: 13 ธันวาคม 2568</span>
                                                <span class="lang-en hidden">Contract &amp; Enrollment: Dec 13, 2025</span>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- External Box -->
                            <div class="p-5 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl space-y-4">
                                <span class="px-2.5 py-0.5 rounded bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-300 text-[10px] font-bold uppercase block w-max">
                                    <span class="lang-th">นักเรียนภายนอกโรงเรียนอื่น</span>
                                    <span class="lang-en hidden">External School Applicants</span>
                                </span>
                                <ul class="space-y-3.5 text-xs text-slate-650 dark:text-slate-400">
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">สมัครเรียนออนไลน์:</strong>
                                            <strong class="lang-en hidden">Online Application:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">1 - 12 พฤศจิกายน 2568</span>
                                                <span class="lang-en hidden">November 1 - 12, 2025</span>
                                            </span><br>
                                            <span class="text-[11px] text-slate-500">
                                                <span class="lang-th">ผ่านระบบกลาง CPW Register (ค่าสมัคร 300 บาท)</span>
                                                <span class="lang-en hidden">Via CPW Register portal (Fee: 300 THB)</span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">การสัมภาษณ์ &amp; ตรวจเอกสารตัวจริง:</strong>
                                            <strong class="lang-en hidden">Interview &amp; Document Verification:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">17 - 21 พ.ย. 68 (รอบเช้า 09.00 - 12.00 น.)</span>
                                                <span class="lang-en hidden">Nov 17 - 21, 2025 (Morning 09:00 - 12:00)</span>
                                            </span><br>
                                            <span class="text-[11px] text-amber-700 dark:text-amber-400 font-medium">
                                                <span class="lang-th">รับบัตรคิว 08.30 น. (นำสูติบัตร-ทะเบียนบ้านตัวจริงมาตรวจวันเดียวจบ)</span>
                                                <span class="lang-en hidden">Queue cards at 08:30 (Bring original certificates for one-stop verification)</span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">ประกาศผล &amp; ยืนยันสิทธิ์:</strong>
                                            <strong class="lang-en hidden">Results Announcement &amp; Confirmation:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">ประกาศผล: 26 พ.ย. 68 (ออนไลน์)</span>
                                                <span class="lang-en hidden">Results: Nov 26, 2025 (Online)</span>
                                            </span><br>
                                            <span class="text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold">
                                                <span class="lang-th">ยืนยันสิทธิ์รายงานตัวออนไลน์ (ไม่ต้องมาโรงเรียน)</span>
                                                <span class="lang-en hidden">Confirm admission online (No on-site trip required)</span>
                                            </span><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">ทำสัญญา &amp; มอบตัว: 13 ธันวาคม 2568</span>
                                                <span class="lang-en hidden">Contract &amp; Enrollment: Dec 13, 2025</span>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Stepper Details -->
                        <div class="border border-slate-200 dark:border-slate-800 rounded-xl p-5 bg-white dark:bg-slate-950 space-y-4">
                            <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block">
                                <span class="lang-th">📢 วิธีการประเมินเพื่อคัดเลือก (ป.1)</span>
                                <span class="lang-en hidden">📢 Selection Assessment Process (P.1)</span>
                            </span>
                            <ol class="list-decimal list-inside space-y-2 text-xs text-slate-600 dark:text-slate-400 font-light leading-relaxed">
                                <li>
                                    <strong class="lang-th">ประเมินทักษะการสื่อสารเด็ก:</strong>
                                    <strong class="lang-en hidden">Child Communication Skills:</strong>
                                    <span class="lang-th">สัมภาษณ์ความพร้อมด้านพฤติกรรมและการสื่อสารพื้นฐานทั้ง ภาษาไทย และ ภาษาอังกฤษ</span>
                                    <span class="lang-en hidden">Evaluate behavioral readiness and fundamental communication in both Thai and English.</span>
                                </li>
                                <li>
                                    <strong class="lang-th">สัมภาษณ์ทัศนคติผู้ปกครอง:</strong>
                                    <strong class="lang-en hidden">Parent Interview:</strong>
                                    <span class="lang-th">คุยทำความเข้าใจเกี่ยวกับกระบวนการเรียนการสอน แนวทางของหลักสูตร English Program (EP) เพื่อส่งเสริมเด็กให้ตรงกัน</span>
                                    <span class="lang-en hidden">Discussion regarding curriculum guidelines, English Program (EP) approach, and collaborative student support.</span>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <!-- Right: Requirements & documents checklist (5 Cols) -->
                    <div class="lg:col-span-5 space-y-6">
                        <h4 class="text-sm font-extrabold text-brand-accent uppercase tracking-wider">
                            <span class="lang-th">📋 คุณสมบัติและเอกสารสมัครเรียน</span>
                            <span class="lang-en hidden">📋 Qualifications & Documents</span>
                        </h4>
                        
                        <div class="p-6 bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-3xl space-y-4">
                            <div class="space-y-2 border-b border-slate-200 dark:border-slate-800 pb-4">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block">
                                    <span class="lang-th">คุณสมบัติผู้สมัคร:</span>
                                    <span class="lang-en hidden">Applicant Qualifications:</span>
                                </span>
                                <ul class="list-disc list-inside text-xs text-slate-600 dark:text-slate-450 space-y-1 font-light">
                                    <li>
                                        <span class="lang-th">กำลังศึกษาชั้นอนุบาล 3 (หรืออนุบาล 2 รร.รัฐบาล)</span>
                                        <span class="lang-en hidden">Currently studying in Kindergarten 3 (or K.2 government school)</span>
                                    </li>
                                    <li>
                                        <span class="lang-th">อ่านออก เขียนได้ และมีความพร้อมพัฒนาการตามวัย</span>
                                        <span class="lang-en hidden">Age-appropriate reading, writing, and developmental readiness</span>
                                    </li>
                                    <li>
                                        <span class="lang-th">สุขภาพร่างกายแข็งแรง สามารถช่วยเหลือตัวเองได้ดี</span>
                                        <span class="lang-en hidden">Good health and capable of self-care</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="space-y-2">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block">
                                    <span class="lang-th">เอกสารประกอบการสมัคร (เฉพาะนักเรียนภายนอก):</span>
                                    <span class="lang-en hidden">Required Documents (External Applicants):</span>
                                </span>
                                <ul class="list-none text-xs text-slate-600 dark:text-slate-450 space-y-2.5 font-light">
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">✓</span>
                                        <span class="lang-th">ใบสมัครพร้อมรูปถ่ายหน้าตรงขนาด 1 นิ้ว จำนวน 3 รูป</span>
                                        <span class="lang-en hidden">Application form with 3 passport-sized (1 inch) photos</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">✓</span>
                                        <span class="lang-th">สูติบัตรจริง พร้อมสำเนา 1 ฉบับ</span>
                                        <span class="lang-en hidden">Original birth certificate with 1 copy</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">✓</span>
                                        <span class="lang-th">ทะเบียนบ้าน บิดา มารดา และผู้สมัคร พร้อมสำเนา 1 ฉบับ</span>
                                        <span class="lang-en hidden">House registration copies of parents and applicant</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">✓</span>
                                        <span class="lang-th">ใบรับรองการศึกษาชั้นอนุบาล 3 จากโรงเรียนเดิม</span>
                                        <span class="lang-en hidden">Kindergarten 3 graduation certificate from previous school</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="details-junior" class="space-y-8 hidden">
                <!-- G7 HEADER -->
                <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white flex items-center gap-2">
                        <span>📘</span>
                        <span class="lang-th">การรับสมัครชั้นมัธยมศึกษาปีที่ 1 (ม.1)</span>
                        <span class="lang-en hidden">Junior High 1 Admission (M.1)</span>
                    </h3>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <!-- Left: Admission calendars (7 Cols) -->
                    <div class="lg:col-span-7 space-y-6">
                        <h4 class="text-sm font-extrabold text-brand-accent uppercase tracking-wider">
                            <span class="lang-th">📅 ขั้นตอนและปฏิทินรับสมัคร</span>
                            <span class="lang-en hidden">📅 Admissions Timeline & Procedures</span>
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Internal Box -->
                            <div class="p-5 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl space-y-4">
                                <span class="px-2.5 py-0.5 rounded bg-blue-100 dark:bg-blue-950 text-blue-700 dark:text-blue-300 text-[10px] font-bold uppercase block w-max">
                                    <span class="lang-th">นักเรียนเก่า ช.ป.ว. (ขึ้น ม.1)</span>
                                    <span class="lang-en hidden">Current CPW Students (to M.1)</span>
                                </span>
                                <ul class="space-y-3.5 text-xs text-slate-650 dark:text-slate-400">
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">สมัครกับครูประจำชั้น ป.6:</strong>
                                            <strong class="lang-en hidden">Submit to P.6 Homeroom:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">12 - 28 มกราคม 2569</span>
                                                <span class="lang-en hidden">January 12 - 28, 2026</span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">สอบข้อเขียนคัดเลือก:</strong>
                                            <strong class="lang-en hidden">Written Examination:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">เสาร์ที่ 7 กุมภาพันธ์ 2569</span>
                                                <span class="lang-en hidden">Saturday, February 7, 2026</span>
                                            </span><br>
                                            <span class="text-[10px] text-slate-450">
                                                <span class="lang-th">(คณิตศาสตร์ + อังกฤษ ณ อาคาร EP ชั้น 2)</span>
                                                <span class="lang-en hidden">(Math + English at EP Bldg. 2nd Fl.)</span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">ประกาศผล / มอบตัว:</strong>
                                            <strong class="lang-en hidden">Results Announcement & Enrollment:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">ผล: 11 ก.พ. 69 | มอบตัว: 14 ก.พ. 69</span>
                                                <span class="lang-en hidden">Results: Feb 11, 2026 | Enroll: Feb 14, 2026</span>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- External Box -->
                            <div class="p-5 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl space-y-4">
                                <span class="px-2.5 py-0.5 rounded bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-300 text-[10px] font-bold uppercase block w-max">
                                    <span class="lang-th">นักเรียนใหม่ต่างโรงเรียน</span>
                                    <span class="lang-en hidden">External School Applicants</span>
                                </span>
                                <ul class="space-y-3.5 text-xs text-slate-650 dark:text-slate-400">
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">สมัครผ่านระบบออนไลน์:</strong>
                                            <strong class="lang-en hidden">Online Application:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">12 - 30 มกราคม 2569</span>
                                                <span class="lang-en hidden">January 12 - 30, 2026</span>
                                            </span><br>
                                            <span class="text-[10px] text-slate-500">
                                                <span class="lang-th">(สแกนสมัครออนไลน์ / ไม่มีรับสมัครออนไซต์)</span>
                                                <span class="lang-en hidden">(Online only / No on-site registration)</span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">สอบคัดเลือกข้อเขียน:</strong>
                                            <strong class="lang-en hidden">Written Examination:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">เสาร์ที่ 7 กุมภาพันธ์ 2569</span>
                                                <span class="lang-en hidden">Saturday, February 7, 2026</span>
                                            </span><br>
                                            <span class="text-[10px] text-slate-450">
                                                <span class="lang-th">(09.00 - 12.00 น. อาคาร EP ชั้น 2)</span>
                                                <span class="lang-en hidden">(09:00 - 12:00 at EP Bldg. 2nd Fl.)</span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">ประกาศผล / มอบตัว:</strong>
                                            <strong class="lang-en hidden">Results Announcement & Enrollment:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">ผล: 11 ก.พ. 69 | มอบตัว: 14 ก.พ. 69</span>
                                                <span class="lang-en hidden">Results: Feb 11, 2026 | Enroll: Feb 14, 2026</span>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Stepper Details -->
                        <div class="border border-slate-200 dark:border-slate-800 rounded-xl p-5 bg-white dark:bg-slate-950 space-y-3">
                            <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block">
                                <span class="lang-th">📝 รายละเอียดและสัดส่วนคะแนนสอบข้อเขียน (ม.1)</span>
                                <span class="lang-en hidden">📝 Examination Details & Score Weighting (M.1)</span>
                            </span>
                            <ul class="list-disc list-inside space-y-1.5 text-xs text-slate-600 dark:text-slate-400 font-light">
                                <li>
                                    <strong class="lang-th">วิชาคณิตศาสตร์:</strong>
                                    <strong class="lang-en hidden">Mathematics:</strong>
                                    <span class="lang-th">50 คะแนน</span>
                                    <span class="lang-en hidden">50 points</span>
                                </li>
                                <li>
                                    <strong class="lang-th">วิชาภาษาอังกฤษ:</strong>
                                    <strong class="lang-en hidden">English:</strong>
                                    <span class="lang-th">100 คะแนน</span>
                                    <span class="lang-en hidden">100 points</span>
                                </li>
                                <li>
                                    <span class="lang-th"><strong>จำนวนรับนักเรียนใหม่ภายนอก:</strong> ประมาณ 30 คน (ค่าสมัครสอบ 300 บาท)</span>
                                    <span class="lang-en hidden"><strong>External Admission Quota:</strong> Approx. 30 seats (Application fee: 300 THB)</span>
                                </li>
                                <li class="text-brand-accent">
                                    <span class="lang-th"><strong>*สิทธิพิเศษเพิ่มเติม:</strong> ผู้สมัครที่มีผลคะแนนสอบวัดระดับภาษาอังกฤษ CEFR ตั้งแต่ระดับ A2 ขึ้นไป จะได้รับการพิจารณาเป็นกรณีพิเศษ</span>
                                    <span class="lang-en hidden"><strong>*Special Consideration:</strong> Applicants with CEFR English proficiency test score of A2 or higher will receive special consideration.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Right: Requirements & documents checklist (5 Cols) -->
                    <div class="lg:col-span-5 space-y-6">
                        <h4 class="text-sm font-extrabold text-brand-accent uppercase tracking-wider">
                            <span class="lang-th">📋 คุณสมบัติและเอกสารสมัครเรียน</span>
                            <span class="lang-en hidden">📋 Qualifications & Documents</span>
                        </h4>
                        
                        <div class="p-6 bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-3xl space-y-4">
                            <div class="space-y-2 border-b border-slate-200 dark:border-slate-800 pb-4">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block">
                                    <span class="lang-th">คุณสมบัติผู้สมัคร (นักเรียนใหม่):</span>
                                    <span class="lang-en hidden">Applicant Qualifications:</span>
                                </span>
                                <ul class="list-disc list-inside text-xs text-slate-600 dark:text-slate-450 space-y-1.5 font-light">
                                    <li>
                                        <span class="lang-th">กำลังศึกษาชั้น ป.6 รร.เอกชน หรือ รร.รัฐบาล</span>
                                        <span class="lang-en hidden">Currently in P.6 from private or public schools</span>
                                    </li>
                                    <li>
                                        <span class="lang-th">ผลการเรียนเฉลี่ยรวม ป.4 - ป.5 <span class="font-bold text-slate-900 dark:text-white">ไม่ต่ำกว่า 3.50</span></span>
                                        <span class="lang-en hidden">Cumulative GPA in P.4 - P.5 <span class="font-bold text-slate-900 dark:text-white">≥ 3.50</span></span>
                                    </li>
                                    <li>
                                        <span class="lang-th">ผลเกรดวิชาภาษาอังกฤษ ป.4 - ป.5 <span class="font-bold text-slate-900 dark:text-white">ไม่ต่ำกว่า 3.00</span></span>
                                        <span class="lang-en hidden">English subject grade in P.4 - P.5 <span class="font-bold text-slate-900 dark:text-white">≥ 3.00</span></span>
                                    </li>
                                    <li>
                                        <span class="lang-th">ความประพฤติเรียบร้อย สุขภาพแข็งแรง</span>
                                        <span class="lang-en hidden">Good conduct and healthy</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="space-y-2">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block">
                                    <span class="lang-th">เอกสารอัปโหลดสมัครสอบออนไลน์:</span>
                                    <span class="lang-en hidden">Online Upload Documents:</span>
                                </span>
                                <ul class="list-none text-xs text-slate-600 dark:text-slate-450 space-y-2.5 font-light">
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">✓</span>
                                        <span class="lang-th">รูปถ่าย 1 นิ้ว (ไฟล์ Upload File.JPG ถ่ายไม่เกิน 6 เดือน)</span>
                                        <span class="lang-en hidden">1-inch photo (JPG file taken within 6 months)</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">✓</span>
                                        <span class="lang-th">สมุดประจำตัว ป.4 - ป.5 (ไฟล์ PDF/JPG) พร้อมสำเนารับรอง</span>
                                        <span class="lang-en hidden">P.4 - P.5 report book (PDF/JPG certified copy)</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">✓</span>
                                        <span class="lang-th">ใบรับรองความประพฤติจากโรงเรียนเดิม</span>
                                        <span class="lang-en hidden">Conduct certificate from previous school</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">✓</span>
                                        <span class="lang-th">ผลสอบ CEFR (ถ้ามี)</span>
                                        <span class="lang-en hidden">CEFR test result (if available)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="details-senior" class="space-y-8 hidden">
                <!-- G10 HEADER -->
                <div class="border-b border-slate-100 dark:border-slate-800 pb-4">
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white flex items-center gap-2">
                        <span>📕</span>
                        <span class="lang-th">การรับสมัครชั้นมัธยมศึกษาปีที่ 4 (ม.4)</span>
                        <span class="lang-en hidden">Senior High 4 Admission (M.4)</span>
                    </h3>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <!-- Left: Admission calendars (7 Cols) -->
                    <div class="lg:col-span-7 space-y-6">
                        <h4 class="text-sm font-extrabold text-emerald-600 dark:text-emerald-450 uppercase tracking-wider">
                            <span class="lang-th">📅 ขั้นตอนและปฏิทินรับสมัคร</span>
                            <span class="lang-en hidden">📅 Admissions Timeline & Procedures</span>
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Internal Box -->
                            <div class="p-5 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl space-y-4">
                                <span class="px-2.5 py-0.5 rounded bg-blue-100 dark:bg-blue-950 text-blue-700 dark:text-blue-300 text-[10px] font-bold uppercase block w-max">
                                    <span class="lang-th">นักเรียนเก่า ช.ป.ว. (ขึ้น ม.4)</span>
                                    <span class="lang-en hidden">Current CPW Students (to M.4)</span>
                                </span>
                                <ul class="space-y-3.5 text-xs text-slate-650 dark:text-slate-400">
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">ยื่นใบสมัครที่ครูประจำชั้น ม.3:</strong>
                                            <strong class="lang-en hidden">Submit to M.3 Homeroom:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">12 - 28 มกราคม 2569</span>
                                                <span class="lang-en hidden">January 12 - 28, 2026</span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">สอบข้อเขียนคัดเลือกหลักสูตร:</strong>
                                            <strong class="lang-en hidden">Written Examination:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">เสาร์ที่ 7 กุมภาพันธ์ 2569</span>
                                                <span class="lang-en hidden">Saturday, February 7, 2026</span>
                                            </span><br>
                                            <span class="text-[10px] text-slate-450">
                                                <span class="lang-th">(คณิต + วิทย์ + อังกฤษ ณ อาคาร EP ชั้น 2)</span>
                                                <span class="lang-en hidden">(Math + Sci + English at EP Bldg. 2nd Fl.)</span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">ประกาศผล / มอบตัว:</strong>
                                            <strong class="lang-en hidden">Results Announcement & Enrollment:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">ผล: 11 ก.พ. 69 | มอบตัว: 14 ก.พ. 69</span>
                                                <span class="lang-en hidden">Results: Feb 11, 2026 | Enroll: Feb 14, 2026</span>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- External Box -->
                            <div class="p-5 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl space-y-4">
                                <span class="px-2.5 py-0.5 rounded bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-300 text-[10px] font-bold uppercase block w-max">
                                    <span class="lang-th">นักเรียนใหม่ต่างโรงเรียน</span>
                                    <span class="lang-en hidden">External School Applicants</span>
                                </span>
                                <ul class="space-y-3.5 text-xs text-slate-650 dark:text-slate-400">
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">สมัครผ่านระบบออนไลน์:</strong>
                                            <strong class="lang-en hidden">Online Application:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">12 - 30 มกราคม 2569</span>
                                                <span class="lang-en hidden">January 12 - 30, 2026</span>
                                            </span><br>
                                            <span class="text-[10px] text-slate-500">
                                                <span class="lang-th">(ผ่านระบบรับสมัคร/ไม่มีรับแบบออนไซต์)</span>
                                                <span class="lang-en hidden">(Online only / No on-site registration)</span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">สอบคัดเลือกข้อเขียน:</strong>
                                            <strong class="lang-en hidden">Written Examination:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">เสาร์ที่ 7 กุมภาพันธ์ 2569</span>
                                                <span class="lang-en hidden">Saturday, February 7, 2026</span>
                                            </span><br>
                                            <span class="text-[10px] text-slate-450">
                                                <span class="lang-th">(09.00 - 12.00 น. อาคาร EP ชั้น 2)</span>
                                                <span class="lang-en hidden">(09:00 - 12:00 at EP Bldg. 2nd Fl.)</span>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                        <div>
                                            <strong class="lang-th">ประกาศผล / มอบตัว:</strong>
                                            <strong class="lang-en hidden">Results Announcement & Enrollment:</strong><br>
                                            <span class="text-slate-900 dark:text-white font-bold">
                                                <span class="lang-th">ผล: 11 ก.พ. 69 | มอบตัว: 14 ก.พ. 69</span>
                                                <span class="lang-en hidden">Results: Feb 11, 2026 | Enroll: Feb 14, 2026</span>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Stepper Details -->
                        <div class="border border-slate-200 dark:border-slate-800 rounded-xl p-5 bg-white dark:bg-slate-950 space-y-4">
                            <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block">
                                <span class="lang-th">📝 สายการเรียนและจำนวนการเปิดรับสมัคร (ม.4)</span>
                                <span class="lang-en hidden">📝 Academic Tracks & Available Seats (M.4)</span>
                            </span>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                                <div class="p-3 bg-slate-50 dark:bg-slate-900 rounded-lg space-y-1">
                                    <strong class="lang-th">🧪 วิทยาศาสตร์ - คณิตศาสตร์</strong>
                                    <strong class="lang-en hidden">🧪 Science - Mathematics Track</strong>
                                    <p class="text-[11px] text-slate-500">
                                        <span class="lang-th">รับจำนวนจำกัดประมาณ <strong>30 คน</strong></span>
                                        <span class="lang-en hidden">Limited quota approx. <strong>30 seats</strong></span>
                                    </p>
                                </div>
                                <div class="p-3 bg-slate-50 dark:bg-slate-900 rounded-lg space-y-1">
                                    <strong class="lang-th">💼 คณิตศาสตร์ - ภาษาอังกฤษ</strong>
                                    <strong class="lang-en hidden">💼 Mathematics - English Track</strong>
                                    <p class="text-[11px] text-slate-500">
                                        <span class="lang-th">ศิลป์คำนวณ (เพิ่มเติม จีน / ญี่ปุ่น) รับประมาณ <strong>20 คน</strong></span>
                                        <span class="lang-en hidden">Arts-Math (Chinese / Japanese electives) approx. <strong>20 seats</strong></span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-[11px] text-slate-550 dark:text-slate-450 leading-relaxed space-y-1 pt-1">
                                <p>
                                    <span class="lang-th">• <strong>สัดส่วนคะแนนสอบ:</strong> คณิตศาสตร์ 50 คะแนน | วิทยาศาสตร์ 50 คะแนน | อังกฤษ 100 คะแนน</span>
                                    <span class="lang-en hidden">• <strong>Exam Score Weight:</strong> Mathematics 50 pts | Science 50 pts | English 100 pts</span>
                                </p>
                                <p class="text-emerald-600 dark:text-emerald-450 font-bold">
                                    <span class="lang-th">• ผู้สมัครมีผล CEFR ตั้งแต่ระดับ B1 ขึ้นไปจะได้รับการพิจารณาเป็นกรณีพิเศษ</span>
                                    <span class="lang-en hidden">• Applicants with CEFR test score of B1 or higher will receive special consideration.</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Requirements & documents checklist (5 Cols) -->
                    <div class="lg:col-span-5 space-y-6">
                        <h4 class="text-sm font-extrabold text-emerald-600 dark:text-emerald-450 uppercase tracking-wider">
                            <span class="lang-th">📋 คุณสมบัติและเอกสารสมัครเรียน</span>
                            <span class="lang-en hidden">📋 Qualifications & Documents</span>
                        </h4>
                        
                        <div class="p-6 bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-3xl space-y-4">
                            <div class="space-y-2 border-b border-slate-200 dark:border-slate-800 pb-4">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block">
                                    <span class="lang-th">คุณสมบัติผู้สมัคร (นักเรียนใหม่):</span>
                                    <span class="lang-en hidden">Applicant Qualifications:</span>
                                </span>
                                <ul class="list-disc list-inside text-xs text-slate-650 dark:text-slate-450 space-y-1.5 font-light">
                                    <li>
                                        <span class="lang-th">กำลังเรียนหรือจบชั้น ม.3 (หรือเทียบเท่า)</span>
                                        <span class="lang-en hidden">Currently studying in or graduated from M.3 (or equivalent)</span>
                                    </li>
                                    <li>
                                        <span class="lang-th">เกรดเฉลี่ยสะสม 5 ภาคเรียน <span class="font-bold text-slate-900 dark:text-white">ไม่ต่ำกว่า 3.00</span></span>
                                        <span class="lang-en hidden">5-semester cumulative GPA <span class="font-bold text-slate-900 dark:text-white">≥ 3.00</span></span>
                                    </li>
                                    <li>
                                        <span class="lang-th">เกรดเฉลี่ยวิชาคณิต, วิทย์, อังกฤษ <span class="font-bold text-slate-900 dark:text-white">ไม่ต่ำกว่า 3.00</span> (หรือร้อยละ 70)</span>
                                        <span class="lang-en hidden">GPA in Math, Science, English <span class="font-bold text-slate-900 dark:text-white">≥ 3.00</span> (or 70%)</span>
                                    </li>
                                    <li>
                                        <span class="lang-th">ประพฤติดี สุขภาพแข็งแรง</span>
                                        <span class="lang-en hidden">Good conduct and healthy</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="space-y-2">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block">
                                    <span class="lang-th">เอกสารอัปโหลดสมัครสอบออนไลน์:</span>
                                    <span class="lang-en hidden">Online Upload Documents:</span>
                                </span>
                                <ul class="list-none text-xs text-slate-650 dark:text-slate-450 space-y-2.5 font-light">
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">✓</span>
                                        <span class="lang-th">รูปถ่าย 1 นิ้ว (ไฟล์ Upload File.JPG ถ่ายไม่เกิน 6 เดือน)</span>
                                        <span class="lang-en hidden">1-inch photo (JPG file taken within 6 months)</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">✓</span>
                                        <span class="lang-th">ใบแสดงผลเกรดเฉลี่ย 5 ภาคเรียน ปพ.1 (ไฟล์ PDF/JPG)</span>
                                        <span class="lang-en hidden">5-semester official transcript (Por Phor 1, PDF/JPG)</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">✓</span>
                                        <span class="lang-th">ใบรับรองพฤติกรรมจากสถาบันเดิม</span>
                                        <span class="lang-en hidden">Conduct certificate from previous school</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 font-bold">✓</span>
                                        <span class="lang-th">ผลสอบวัดระดับภาษาอังกฤษ CEFR (ถ้ามี)</span>
                                        <span class="lang-en hidden">CEFR English test result (if available)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA & Contact channels -->
        <section class="space-y-8 pt-8 border-t border-slate-200 dark:border-slate-800">
            <div class="bg-gradient-to-br from-brand-500 to-brand-600 dark:from-slate-850 dark:to-slate-950 text-white rounded-3xl p-8 sm:p-12 flex flex-col md:flex-row items-center justify-between gap-8 shadow-xl relative overflow-hidden">
                <div class="space-y-4 max-w-xl relative z-10">
                    <h3 class="text-2xl sm:text-3xl font-black tracking-tight leading-tight">
                        <span class="lang-th">พร้อมสมัครเข้าศึกษาหรือยัง?</span>
                        <span class="lang-en hidden">Ready to Join Our Family?</span>
                    </h3>
                    <p class="text-slate-100 text-xs sm:text-sm font-light leading-relaxed">
                        <span class="lang-th">สมัครลงทะเบียนสอบคัดเลือกเข้าโครงการภาคภาษาอังกฤษ (EP) ได้ทางช่องทางออนไลน์หลักของโรงเรียนชลประทานวิทยา</span>
                        <span class="lang-en hidden">Apply for the official selection test to join our English Program today through our online portal.</span>
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 relative z-10 w-full md:w-auto">
                    <a href="https://www.cpw.ac.th/admission/register" target="_blank" class="px-8 py-4 bg-white text-brand-600 hover:bg-slate-100 rounded-xl text-sm font-black transition-all shadow-md text-center">
                        <span class="lang-th">👉 สมัครออนไลน์ได้ที่นี่</span>
                        <span class="lang-en hidden">👉 Apply Online Here</span>
                    </a>
                    <a href="contact.php" class="px-8 py-4 bg-brand-700/40 hover:bg-brand-700/60 border border-white/20 rounded-xl text-sm font-bold transition text-center">
                        <span class="lang-th">สอบถามข้อมูลเพิ่มเติม</span>
                        <span class="lang-en hidden">Contact Registrar</span>
                    </a>
                </div>
                <!-- Background decoration element -->
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs text-slate-500 dark:text-slate-400 p-2">
                <p>
                    <span class="lang-th">• <strong>คำแนะนำ:</strong> เอกสารอัปโหลดและรูปถ่ายทุกรายการต้องรับรองสำเนาถูกต้องให้ครบถ้วนในรูปแบบดิจิทัล (JPG/PDF) ขนาดไฟล์ต้องไม่เกินที่ระบบกำหนด</span>
                    <span class="lang-en hidden">• <strong>Instructions:</strong> All uploaded documents and photos must be properly certified digital copies (JPG/PDF) not exceeding system file size limits.</span>
                </p>
                <p>
                    <span class="lang-th">• <strong>ช่องทางโทรศัพท์:</strong> ติดต่อฝ่ายทะเบียนโครงการ EP ได้ที่ <strong>02-583-4047 ต่อ 118</strong> หรือ <strong>02-583-4854</strong> ในวันและเวลาราชการ (จันทร์ - ศุกร์ 08.30 - 16.00 น.)</span>
                    <span class="lang-en hidden">• <strong>Phone:</strong> Contact EP Registrar at <strong>02-583-4047 ext. 118</strong> or <strong>02-583-4854</strong> during official hours (Mon - Fri 08:30 - 16:00).</span>
                </p>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>

    <?php include 'login_modal.php'; ?>

    <script>
        function selectLevel(level) {
            // Remove active styles from all cards
            const levels = ['primary', 'junior', 'senior'];
            levels.forEach(lvl => {
                const card = document.getElementById(`card-${lvl}`);
                const detail = document.getElementById(`details-${lvl}`);
                
                if (card) {
                    card.className = "text-left w-full border-2 border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 space-y-4 bg-white dark:bg-slate-900 flex flex-col justify-between hover:shadow transition-all duration-300 focus:outline-none";
                }
                if (detail) {
                    detail.classList.add('hidden');
                }
            });

            // Set active class on selected card
            const selectedCard = document.getElementById(`card-${level}`);
            const selectedDetail = document.getElementById(`details-${level}`);
            
            let activeColorClass = "border-brand-500 ring-2 ring-brand-500/10";
            if (level === 'junior') {
                activeColorClass = "border-brand-accent ring-2 ring-brand-accent/10";
            } else if (level === 'senior') {
                activeColorClass = "border-emerald-500 ring-2 ring-emerald-500/10";
            }

            if (selectedCard) {
                selectedCard.className = `text-left w-full border-2 ${activeColorClass} rounded-3xl p-6 sm:p-8 space-y-4 bg-white dark:bg-slate-900 flex flex-col justify-between shadow transition-all duration-300 focus:outline-none`;
            }
            if (selectedDetail) {
                selectedDetail.classList.remove('hidden');
            }
        }
        
        // Initial setup
        window.addEventListener('DOMContentLoaded', () => {
            selectLevel('primary');
        });
    </script>

</body>
</html>
