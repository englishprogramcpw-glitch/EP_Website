<?php
$pageTitle = "นัดหมายเข้าเยี่ยมชมโครงการ (Campus Tour) | English Program (EP) CPW";
$currentPage = "tour";
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
    <header class="relative bg-slate-950 text-white py-24 px-4 overflow-hidden flex items-center justify-center bg-cover bg-center" style="background-image: url('img/ep_cover_banner.jpg');">
        <div class="absolute inset-0 bg-slate-950/80"></div>
        <div class="relative max-w-4xl mx-auto text-center space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-accent/10 border border-brand-accent/25 text-brand-accent text-xs font-bold font-english uppercase tracking-wider">
                Personalized Campus Tour
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-tight">
                <span class="lang-th">นัดหมายเข้าเยี่ยมชมโครงการ EP</span>
                <span class="lang-en hidden">Book an EP Campus Tour</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base font-normal max-w-2xl mx-auto leading-relaxed">
                <span class="lang-th">สัมผัสบรรยากาศการเรียนรู้นานาชาติ ชมสิ่งอำนวยความสะดวก และพบปะพูดคุยกับหัวหน้าโครงการและทีมครูผู้สอน</span>
                <span class="lang-en hidden">Experience our vibrant bilingual learning environment, explore world-class facilities, and meet our faculty in person.</span>
            </p>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-grow max-w-[1400px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 space-y-16">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- LEFT COLUMN: Tour Information & Highlights (5 cols) -->
            <div class="lg:col-span-5 space-y-8">
                
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-sm space-y-6">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-500/10 text-brand-500 dark:text-blue-400 font-bold text-xs">
                        <span class="lang-th">การดูแลต้อนรับแบบส่วนบุคคล (VIP Tour)</span>
                        <span class="lang-en hidden">Personalized Experience</span>
                    </span>
                    <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">
                        <span class="lang-th">สิ่งที่คุณจะได้รับจากการเข้าชม</span>
                        <span class="lang-en hidden">What to Expect on Your Tour</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        <span class="lang-th">โครงการ EP ให้ความสำคัญกับการดูแลแบบรายบุคคล เพื่อให้ผู้ปกครองได้รับข้อมูลหลักสูตรที่ตรงกับความต้องการของบุตรหลานมากที่สุด</span>
                        <span class="lang-en hidden">We provide tailored 1-on-1 consultations to give you full insight into our programs and campus life.</span>
                    </p>

                    <!-- Highlights List -->
                    <div class="space-y-4 pt-2">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-blue-50 dark:bg-slate-800 text-blue-500 flex items-center justify-center shrink-0 text-xl font-bold">
                                🏫
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm">
                                    <span class="lang-th">ชมห้องเรียน & Lab ปฏิบัติการจริง</span>
                                    <span class="lang-en hidden">Explore Classrooms & Science Labs</span>
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                    <span class="lang-th">ห้องเรียนติดเครื่องปรับอากาศทุกห้อง, Smart Board, ห้องปฏิบัติการวิทยาศาสตร์ และห้องปฏิบัติการคอมพิวเตอร์</span>
                                    <span class="lang-en hidden">Air-conditioned classrooms, interactive smart boards, labs, and modern learning spaces.</span>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-amber-50 dark:bg-slate-800 text-amber-500 flex items-center justify-center shrink-0 text-xl font-bold">
                                👨‍🏫
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm">
                                    <span class="lang-th">ปรึกษาหลักสูตรกับหัวหน้าโครงการ</span>
                                    <span class="lang-en hidden">Consult with Head of EP</span>
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                    <span class="lang-th">รับคำแนะนำเรื่องสัดส่วนการสอนภาษาอังกฤษ คุณวุฒิครูต่างชาติ และแผนการเรียน ม.ปลาย สู่มหาวิทยาลัย</span>
                                    <span class="lang-en hidden">Direct guidance on bilingual curriculum, teacher qualifications, and academic pathways to university.</span>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-slate-800 text-emerald-500 flex items-center justify-center shrink-0 text-xl font-bold">
                                📋
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm">
                                    <span class="lang-th">ข้อมูลค่าธรรมเนียมและการสอบเข้า</span>
                                    <span class="lang-en hidden">Tuition & Admission Insights</span>
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                    <span class="lang-th">รับเอกสารค่าเทอมแจกแจงละเอียด ข้อกำหนดการสอบ และแนวข้อสอบเข้าเบื้องต้น</span>
                                    <span class="lang-en hidden">Detailed fee structures, examination formats, and enrollment timelines.</span>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-indigo-50 dark:bg-slate-800 text-indigo-500 flex items-center justify-center shrink-0 text-xl font-bold">
                                🛡️
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm">
                                    <span class="lang-th">ระบบความปลอดภัยและสุขอนามัย</span>
                                    <span class="lang-en hidden">Campus Safety & Student Welfare</span>
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                    <span class="lang-th">ระบบคัดกรองผู้มาติดต่อ แลกบัตรเข้า-ออก กล้อง CCTV ครอบคลุมทุกชั้น ห้องพยาบาล และการดูแลนักเรียนอย่างใกล้ชิด</span>
                                    <span class="lang-en hidden">Visitor screening, entry card access, comprehensive CCTV surveillance, and dedicated student health care.</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Important Notice -->
                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-750 text-xs text-slate-600 dark:text-slate-300 space-y-1">
                        <strong class="font-bold text-slate-900 dark:text-white block">📌 ข้อแนะนำในการเข้าชม:</strong>
                        <p class="leading-relaxed">
                            <span class="lang-th">เพื่อความปลอดภัยของนักเรียนและความพร้อมของผู้ต้อนรับ กรุณานัดหมายล่วงหน้าอย่างน้อย 1-2 วันทำการ เจ้าหน้าที่จะติดต่อยืนยันเวลานัดหมายผ่านทางโทรศัพท์หรือ LINE</span>
                            <span class="lang-en hidden">Please book at least 1-2 days in advance. Our team will contact you to confirm the appointment.</span>
                        </p>
                    </div>
                </div>

                <!-- Contact Mini Card -->
                <div class="bg-gradient-to-br from-brand-500 to-blue-700 text-white rounded-3xl p-6 shadow-md flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-xs font-semibold uppercase tracking-wider text-blue-200">สอบถามด่วน</span>
                        <h4 class="text-lg font-black">ต้องการนัดหมายด่วนทางโทรศัพท์?</h4>
                        <p class="text-xs text-blue-100"><?php echo $settings['contact']['phone'] ?? '02-583-7030'; ?></p>
                    </div>
                    <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $settings['contact']['phone'] ?? '025837030'); ?>" class="px-4 py-2.5 bg-white text-brand-500 rounded-2xl font-bold text-xs hover:bg-blue-50 transition shadow-sm shrink-0">
                        📞 โทรทันที
                    </a>
                </div>

            </div>

            <!-- RIGHT COLUMN: Booking Form (7 cols) -->
            <div class="lg:col-span-7">
                <?php
                $isTourOpen = !isset($settings['tour_booking']['enabled']) || $settings['tour_booking']['enabled'] !== false;
                $closedTitleTh = $settings['tour_booking']['closed_title_th'] ?? 'ระบบนัดหมายเข้าชมโครงการปิดรับชั่วคราว';
                $closedTitleEn = $settings['tour_booking']['closed_title_en'] ?? 'Campus Tour Booking Temporarily Closed';
                $closedMsgTh = $settings['tour_booking']['closed_msg_th'] ?? 'ขณะนี้ระบบนัดหมายเข้าชมโครงการฯ ปิดรับการลงทะเบียนชั่วคราว หากท่านต้องการสอบถามข้อมูลหรือนัดหมายเป็นกรณีพิเศษ กรุณาติดต่อสำนักงานโครงการ EP ผ่านทางโทรศัพท์';
                $closedMsgEn = $settings['tour_booking']['closed_msg_en'] ?? 'Campus tour requests are temporarily unavailable. For urgent inquiries or special arrangements, please contact the EP office directly.';
                ?>

                <?php if (!$isTourOpen): ?>
                <!-- CLOSED STATE BANNER -->
                <div class="bg-white dark:bg-slate-900 border border-amber-200 dark:border-amber-900/50 rounded-3xl p-8 sm:p-12 shadow-lg text-center space-y-6">
                    <div class="w-20 h-20 mx-auto rounded-3xl bg-amber-500/10 text-amber-500 flex items-center justify-center text-4xl shadow-inner">
                        🔒
                    </div>
                    <div class="space-y-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400 font-bold text-xs uppercase tracking-wider">
                            <span class="lang-th">ปิดรับลงทะเบียนชั่วคราว</span>
                            <span class="lang-en hidden">Temporarily Closed</span>
                        </span>
                        <h3 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                            <span class="lang-th"><?php echo htmlspecialchars($closedTitleTh); ?></span>
                            <span class="lang-en hidden"><?php echo htmlspecialchars($closedTitleEn); ?></span>
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 max-w-lg mx-auto leading-relaxed">
                            <span class="lang-th"><?php echo nl2br(htmlspecialchars($closedMsgTh)); ?></span>
                            <span class="lang-en hidden"><?php echo nl2br(htmlspecialchars($closedMsgEn)); ?></span>
                        </p>
                    </div>
                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
                        <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $settings['contact']['phone'] ?? '025835444'); ?>" class="w-full sm:w-auto px-6 py-3.5 bg-brand-500 hover:bg-brand-600 text-white rounded-2xl font-bold text-sm transition shadow-md shadow-brand-500/25 flex items-center justify-center gap-2">
                            <span>📞 โทรติดต่อสำนักงาน EP</span>
                        </a>
                        <a href="contact.php" class="w-full sm:w-auto px-6 py-3.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-750 text-slate-800 dark:text-slate-200 rounded-2xl font-bold text-sm transition flex items-center justify-center gap-2">
                            <span>💬 ดูช่องทางติดต่อทั้งหมด</span>
                        </a>
                    </div>
                </div>
                <?php else: ?>
                <!-- OPEN STATE FORM -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 sm:p-10 shadow-lg space-y-8">
                    
                    <div class="border-b border-slate-100 dark:border-slate-800 pb-6 space-y-2">
                        <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">
                            <span class="lang-th">แบบฟอร์มนัดหมายเข้าชมโครงการ</span>
                            <span class="lang-en hidden">Campus Visit Request Form</span>
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                            <span class="lang-th">กรุณากรอกข้อมูลด้านล่างให้ครบถ้วน เจ้าหน้าที่จะติดต่อกลับเพื่อยืนยันเวลานัดหมาย</span>
                            <span class="lang-en hidden">Please fill in the form below. Our admissions staff will get back to you shortly.</span>
                        </p>
                    </div>

                    <form id="tourBookingForm" onsubmit="handleTourSubmit(event)" class="space-y-6">
                        
                        <!-- Anti-spam Honeypot field (hidden from real humans) -->
                        <div style="display:none !important;" aria-hidden="true">
                            <input type="text" name="website_hp" tabindex="-1" autocomplete="off" value="">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                                    <span class="lang-th">ชื่อ-นามสกุล ผู้ปกครอง <span class="text-red-500">*</span></span>
                                    <span class="lang-en hidden">Parent's Full Name <span class="text-red-500">*</span></span>
                                </label>
                                <input type="text" name="parent_name" required placeholder="เช่น คุณสมศรี วรโชติ" class="w-full px-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                                    <span class="lang-th">เบอร์โทรศัพท์ติดต่อ <span class="text-red-500">*</span></span>
                                    <span class="lang-en hidden">Phone Number <span class="text-red-500">*</span></span>
                                </label>
                                <input type="tel" name="phone" required placeholder="เช่น 081-234-5678" class="w-full px-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition">
                            </div>
                        </div>

                        <!-- Line ID & Student Info -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                                    <span class="lang-th">LINE ID (สะดวกต่อการยืนยันเวลานัด)</span>
                                    <span class="lang-en hidden">LINE ID (For instant confirmation)</span>
                                </label>
                                <input type="text" name="line_id" placeholder="LINE ID ของผู้ปกครอง" class="w-full px-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                                    <span class="lang-th">ชื่อ-ชื่อเล่นนักเรียน</span>
                                    <span class="lang-en hidden">Student Name / Nickname</span>
                                </label>
                                <input type="text" name="student_name" placeholder="เช่น ด.ช. ภัทรพล (น้องมิกกี้)" class="w-full px-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition">
                            </div>
                        </div>

                        <!-- Target Grade -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                                <span class="lang-th">ระดับชั้นที่สนใจสมัครเรียน <span class="text-red-500">*</span></span>
                                <span class="lang-en hidden">Target Grade for Enrollment <span class="text-red-500">*</span></span>
                            </label>
                            <select name="target_grade" required class="w-full px-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition">
                                <option value="">-- เลือกระดับชั้น --</option>
                                <option value="อนุบาล 3 ขึ้น ประถมศึกษาปีที่ 1 (ป.1)">อนุบาล 3 ขึ้น ประถมศึกษาปีที่ 1 (ป.1)</option>
                                <option value="ประถมศึกษาตอนต้น (ป.2 - ป.3)">ประถมศึกษาตอนต้น (ป.2 - ป.3)</option>
                                <option value="ประถมศึกษาตอนปลาย (ป.4 - ป.6)">ประถมศึกษาตอนปลาย (ป.4 - ป.6)</option>
                                <option value="ประถม 6 ขึ้น มัธยมศึกษาปีที่ 1 (ม.1)">ประถม 6 ขึ้น มัธยมศึกษาปีที่ 1 (ม.1)</option>
                                <option value="มัธยมศึกษาตอนต้น (ม.2 - ม.3)">มัธยมศึกษาตอนต้น (ม.2 - ม.3)</option>
                                <option value="มัธยม 3 ขึ้น มัธยมศึกษาปีที่ 4 (ม.4)">มัธยม 3 ขึ้น มัธยมศึกษาปีที่ 4 (ม.4)</option>
                                <option value="มัธยมศึกษาตอนปลาย (ม.5 - ม.6)">มัธยมศึกษาตอนปลาย (ม.5 - ม.6)</option>
                            </select>
                        </div>

                        <!-- Date and Time Slots -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                                    <span class="lang-th">วันที่ต้องการเข้าชม (จันทร์ - ศุกร์) <span class="text-red-500">*</span></span>
                                    <span class="lang-en hidden">Preferred Visit Date <span class="text-red-500">*</span></span>
                                </label>
                                <input type="date" name="visit_date" id="visitDatePicker" required class="w-full px-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                                    <span class="lang-th">ช่วงเวลาที่สะดวก <span class="text-red-500">*</span></span>
                                    <span class="lang-en hidden">Preferred Time Slot <span class="text-red-500">*</span></span>
                                </label>
                                <select name="visit_time" required class="w-full px-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition">
                                    <option value="รอบเช้า (09:30 - 11:00 น.)">รอบเช้า (09:30 - 11:00 น.)</option>
                                    <option value="รอบบ่าย (13:30 - 15:00 น.)">รอบบ่าย (13:30 - 15:00 น.)</option>
                                    <option value="ช่วงเวลาอื่น (โปรดระบุในหมายเหตุ)">ช่วงเวลาอื่น (โปรดระบุในหมายเหตุ)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Special Interests / Notes -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                                <span class="lang-th">สิ่งที่ท่านสนใจเป็นพิเศษ หรือคำถามเพิ่มเติม</span>
                                <span class="lang-en hidden">Special Inquiries / Questions</span>
                            </label>
                            <textarea name="notes" rows="3" placeholder="เช่น สนใจดูห้องเรียนวิทยาศาสตร์, สอบถามเรื่องรถรับส่งนักเรียน, อยากปรึกษาหลักสูตรกับครูต่างชาติ" class="w-full px-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" id="submitTourBtn" class="w-full py-4 rounded-2xl bg-brand-500 hover:bg-brand-600 text-white font-bold text-base shadow-lg shadow-brand-500/25 hover:shadow-brand-500/40 transition-all duration-300 flex items-center justify-center gap-2">
                                <span>🏛️ ส่งคำขอนัดหมายเยี่ยมชม</span>
                            </button>
                        </div>

                    </form>
                </div>
                <?php endif; ?>
            </div>

        </div>

    </main>

    <!-- SUCCESS MODAL -->
    <div id="tourSuccessModal" class="fixed inset-0 z-50 overflow-y-auto hidden flex items-center justify-center p-4">
        <div onclick="closeTourModal()" class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm"></div>
        <div class="relative bg-white dark:bg-slate-900 rounded-3xl w-full max-w-md overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 p-8 text-center space-y-6">
            <div class="w-16 h-16 rounded-full bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-3xl mx-auto">
                🎉
            </div>
            <div class="space-y-2">
                <h3 class="text-2xl font-black text-slate-900 dark:text-white">ส่งคำขอนัดหมายสำเร็จ!</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    ระบบได้บันทึกคำขอของคุณเรียบร้อยแล้ว และส่งการแจ้งเตือนไปยังทีมบริหารและหัวหน้าโครงการ EP ทาง LINE
                </p>
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-750 text-xs text-left space-y-1 mt-4">
                    <span class="block font-bold text-slate-800 dark:text-slate-200">📞 ขั้นตอนถัดไป:</span>
                    <p class="text-slate-500 dark:text-slate-400">เจ้าหน้าที่จะติดต่อกลับทางโทรศัพท์หรือ LINE เพื่อยืนยันเวลานัดหมายและส่งแผนผังจุดจอดรถให้ท่านก่อนวันเข้าชมครับ</p>
                </div>
            </div>
            <button onclick="closeTourModal()" class="w-full py-3 bg-brand-500 text-white rounded-2xl font-bold text-sm hover:bg-brand-600 transition">
                เข้าใจแล้ว / ปิดหน้านี้
            </button>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- JAVASCRIPT FOR FORM HANDLING -->
    <script>
        // Set minimum date to tomorrow
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const yyyy = tomorrow.getFullYear();
        const mm = String(tomorrow.getMonth() + 1).padStart(2, '0');
        const dd = String(tomorrow.getDate()).padStart(2, '0');
        const minDateStr = `${yyyy}-${mm}-${dd}`;
        const picker = document.getElementById('visitDatePicker');
        if (picker) {
            picker.min = minDateStr;
        }

        async function handleTourSubmit(e) {
            e.preventDefault();
            const form = document.getElementById('tourBookingForm');
            const submitBtn = document.getElementById('submitTourBtn');
            const formData = new FormData(form);
            const payload = Object.fromEntries(formData.entries());

            submitBtn.disabled = true;
            submitBtn.innerHTML = `<span>⏳ กำลังบันทึกและส่งข้อมูล...</span>`;

            try {
                const res = await fetch('save_tour_booking.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const result = await res.json();

                if (result.success) {
                    form.reset();
                    document.getElementById('tourSuccessModal').classList.remove('hidden');
                } else {
                    alert('⚠️ ' + (result.error || 'เกิดข้อผิดพลาดในการส่งข้อมูล'));
                }
            } catch (err) {
                alert('⚠️ เกิดข้อผิดพลาดในการเชื่อมต่อเซิร์ฟเวอร์: ' + err.message);
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = `<span>🏛️ ส่งคำขอนัดหมายเยี่ยมชม</span>`;
            }
        }

        function closeTourModal() {
            document.getElementById('tourSuccessModal').classList.add('hidden');
        }
    </script>
</body>
</html>
