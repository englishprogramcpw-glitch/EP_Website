<?php
$pageTitle = "ติดต่อเรา | English Program (EP) CPW";
$currentPage = "contact";
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
    <header class="relative bg-slate-950 text-white py-24 px-4 overflow-hidden flex items-center justify-center bg-cover bg-center" style="background-image: url('img/ep_bot_lobby_bg.jpg');">
        <div class="absolute inset-0 bg-slate-950/70"></div>
        <div class="relative max-w-4xl mx-auto text-center space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-accent/10 border border-brand-accent/25 text-brand-accent text-xs font-bold font-english uppercase tracking-wider">
                Get In Touch
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-tight">
                <span class="lang-th">ติดต่อเรา (Contact Us)</span>
                <span class="lang-en hidden">Contact Us</span>
            </h1>
            <p class="text-slate-350 text-sm sm:text-base font-normal max-w-2xl mx-auto leading-relaxed">
                <span class="lang-th">สอบถามข้อมูลเพิ่มเติม แนะนำ ติชม หรือติดต่อแผนกงานต่างๆ ของโครงการฯ ภาคภาษาอังกฤษ (EP)</span>
                <span class="lang-en hidden">Ask questions, give feedback, or reach out to different departments of the EP program.</span>
            </p>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-grow max-w-[1400px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 space-y-16">
        
        <!-- SECTION 1: N°09 Split Layout (Left: school contact info, Right: Google Map) -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
            
            <!-- Left: School Contact Info -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-10 shadow-sm flex flex-col justify-between space-y-8">
                <div class="space-y-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-500/10 text-brand-500 dark:text-blue-400 font-bold text-xs">
                        <span class="lang-th">ช่องทางการติดต่อ</span>
                        <span class="lang-en hidden">Information</span>
                    </span>
                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        <span class="lang-th">สำนักงานโครงการฯ ภาคภาษาอังกฤษ (EP)</span>
                        <span class="lang-en hidden">EP Program Office</span>
                    </h3>
                </div>

                <!-- Details List -->
                <div class="space-y-6 text-xs sm:text-sm">
                    <!-- Location -->
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-850 flex items-center justify-center shrink-0 text-base">📍</div>
                        <div class="space-y-1">
                            <strong class="block text-slate-850 dark:text-slate-200 font-bold">
                                <span class="lang-th">สถานที่ตั้งโครงการ</span>
                                <span class="lang-en hidden">Location</span>
                            </strong>
                            <p class="text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                                <span class="lang-th"><?php echo $settings['contact']['address_th']; ?></span>
                                <span class="lang-en hidden"><?php echo $settings['contact']['address_en']; ?></span>
                            </p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-850 flex items-center justify-center shrink-0 text-base">📞</div>
                        <div class="space-y-1">
                            <strong class="block text-slate-850 dark:text-slate-200 font-bold">
                                <span class="lang-th">เบอร์โทรศัพท์</span>
                                <span class="lang-en hidden">Phone Number</span>
                            </strong>
                            <p class="text-slate-500 dark:text-slate-405 font-english font-light"><?php echo $settings['contact']['phone']; ?></p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-850 flex items-center justify-center shrink-0 text-base">✉️</div>
                        <div class="space-y-1">
                            <strong class="block text-slate-850 dark:text-slate-200 font-bold">
                                <span class="lang-th">อีเมลฝ่ายวิชาการ</span>
                                <span class="lang-en hidden">Email Address</span>
                            </strong>
                            <p class="text-slate-500 dark:text-slate-405 font-english font-light"><?php echo $settings['contact']['email']; ?></p>
                        </div>
                    </div>

                    <!-- Socials -->
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-850 flex items-center justify-center shrink-0 text-base">🌐</div>
                        <div class="space-y-1">
                            <strong class="block text-slate-850 dark:text-slate-200 font-bold">Facebook Page</strong>
                            <?php 
                            $fbVal = !empty($settings['contact']['facebook']) ? $settings['contact']['facebook'] : 'profile.php?id=100093686707861';
                            $fbUrl = (strpos($fbVal, 'http') === 0) ? $fbVal : 'https://www.facebook.com/' . ltrim($fbVal, '/');
                            ?>
                            <a href="<?php echo htmlspecialchars($fbUrl); ?>" target="_blank" class="text-brand-500 dark:text-blue-400 hover:text-brand-accent transition font-bold leading-none underline">English Program CPW</a>
                        </div>
                    </div>
                </div>

                <!-- Footnote (Working Hours) -->
                <div class="pt-6 border-t border-slate-100 dark:border-slate-850 text-xs text-slate-400 dark:text-slate-500 font-light flex items-center gap-2">
                    <span>⏰</span>
                    <span>
                        <span class="lang-th">จันทร์ - ศุกร์ 08:00 น. - 16:30 น. (ปิดวันหยุดราชการ)</span>
                        <span class="lang-en hidden">Mon - Fri 08:00 AM - 04:30 PM (Closed on holidays)</span>
                    </span>
                </div>
            </div>

            <!-- Right: Interactive Google Map with EP Building Locator (N°09 Split right) -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm min-h-[440px] relative flex flex-col justify-between">
                <iframe class="absolute inset-0 w-full h-full border-none z-0" src="https://maps.google.com/maps?q=VGX6%2B88R+Pak+Kret,+Nonthaburi&t=&z=18&ie=UTF8&iwloc=&output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                
                <!-- Top Floating Badge: Location Name -->
                <div class="relative z-10 m-3 self-start">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-950/90 backdrop-blur-md text-white text-xs font-bold shadow-lg border border-white/10">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>📍 อาคารโครงการฯ ภาคภาษาอังกฤษ (EP Building)</span>
                    </span>
                </div>

                <!-- Bottom Floating Action & Guide Card -->
                <div class="relative z-10 m-3 p-4 bg-slate-950/92 backdrop-blur-md rounded-2xl border border-white/10 text-white space-y-2.5 shadow-2xl">
                    <div class="flex items-start gap-2.5">
                        <span class="text-lg text-brand-accent shrink-0">🚗</span>
                        <div class="space-y-1">
                            <strong class="font-bold text-white text-xs block">จุดสังเกตตำแหน่งอาคารเรียน:</strong>
                            <p class="text-[11px] text-slate-200 leading-relaxed font-light">
                                <span class="lang-th"><?php echo isset($settings['contact']['building_guide_th']) ? $settings['contact']['building_guide_th'] : 'อาคารโครงการฯ ภาคภาษาอังกฤษ (EP) พิกัด Plus Code: VGX6+88R เข้าประตู 1 (ฝั่งถนนติวานนท์) ตรงเข้ามาผ่านวงเวียน จะพบอาคารรูปตัว U ของโครงการ EP'; ?></span>
                                <span class="lang-en hidden"><?php echo isset($settings['contact']['building_guide_en']) ? $settings['contact']['building_guide_en'] : 'English Program (EP) Building, Google Plus Code: VGX6+88R. Enter Gate 1 (Tiwanon Rd.) and proceed straight past the roundabout to the U-shaped EP Building.'; ?></span>
                            </p>
                        </div>
                    </div>
                    <div class="pt-2 flex items-center justify-between gap-3 border-t border-white/10">
                        <div class="space-y-0.5">
                            <span class="text-[10px] text-slate-400 block font-mono">Plus Code: VGX6+88R ปากเกร็ด นนทบุรี</span>
                            <span class="text-[9px] text-slate-500 block">พิกัด: 13.898281, 100.510813</span>
                        </div>
                        <a href="<?php echo isset($settings['contact']['map_url']) ? $settings['contact']['map_url'] : 'https://maps.google.com/?q=VGX6%2B88R+ตำบลบางตลาด+อำเภอปากเกร็ด+นนทบุรี'; ?>" target="_blank" class="px-3.5 py-2 bg-brand-500 hover:bg-brand-600 text-white text-xs font-bold rounded-xl transition shadow flex items-center gap-1.5 shrink-0">
                            <span>🧭</span>
                            <span class="lang-th">เปิดนำทาง GPS</span>
                            <span class="lang-en hidden">Get Directions</span>
                        </a>
                    </div>
                </div>
            </div>

        </section>

        <!-- SECTION 2: Clean Contact Form (Combined layout) -->
        <section class="max-w-3xl mx-auto">
            <form id="contactForm" onsubmit="handleContactSubmit(event)" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-10 shadow-sm space-y-6">
                <div class="space-y-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-accent/10 text-brand-accent font-bold text-xs">
                        <span class="lang-th">ส่งข้อความถึงเรา</span>
                        <span class="lang-en hidden">Message Us</span>
                    </span>
                    <h3 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                        <span class="lang-th">ส่งแบบฟอร์มการติดต่อ</span>
                        <span class="lang-en hidden">Send Us a Message</span>
                    </h3>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="block text-[10px] sm:text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                            <span class="lang-th">ชื่อ-นามสกุลของคุณ</span>
                            <span class="lang-en hidden">Your Full Name</span>
                        </label>
                        <input type="text" id="contactName" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 dark:bg-slate-950 dark:border-slate-850 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500/20 transition text-sm shadow-inner" placeholder="สมชาย ใจดี">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[10px] sm:text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                            <span class="lang-th">อีเมล หรือเบอร์โทรติดต่อ</span>
                            <span class="lang-en hidden">Email or Phone Number</span>
                        </label>
                        <input type="text" id="contactInfo" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 dark:bg-slate-950 dark:border-slate-850 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500/20 transition text-sm shadow-inner" placeholder="example@email.com หรือ 08x-xxx-xxxx">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] sm:text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        <span class="lang-th">หัวข้อติดต่อ</span>
                        <span class="lang-en hidden">Subject</span>
                    </label>
                    <select id="contactSubject" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 dark:bg-slate-950 dark:border-slate-850 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-brand-500 transition text-sm">
                        <!-- Loaded dynamically via JS -->
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] sm:text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        <span class="lang-th">รายละเอียดข้อความ</span>
                        <span class="lang-en hidden">Message Details</span>
                    </label>
                    <textarea id="contactMessage" required rows="4" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 dark:bg-slate-950 dark:border-slate-850 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500/20 transition text-sm shadow-inner" placeholder="พิมพ์ข้อความที่นี่..."></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold transition shadow-sm text-sm">
                    <span class="lang-th">ส่งข้อความติดต่อ</span>
                    <span class="lang-en hidden">Send Message</span>
                </button>
            </form>
        </section>
    </main>

    <?php include 'footer.php'; ?>

    <?php include 'login_modal.php'; ?>

    <!-- Contact Form Handler Local -->
    <script>
        const subjectTranslations = {
            th: [
                "สอบถามข้อมูลทั่วไป",
                "สอบถามเรื่องการรับสมัครเรียน",
                "ติดต่อเรื่องวิชาการ/การแนะแนว",
                "เรื่องร้องเรียนหรือส่งข้อเสนอแนะ"
            ],
            en: [
                "General Inquiries",
                "Admissions Inquiries",
                "Academic & Guidance Counseling",
                "Complaints & Suggestions"
            ]
        };

        function updateFormLanguage() {
            const currentLang = localStorage.getItem('ep_lang') || 'th';
            const isEn = currentLang === 'en';

            // Inputs Placeholder
            const nameInput = document.getElementById('contactName');
            if (nameInput) {
                nameInput.placeholder = isEn ? "Somchai Jaidee" : "สมชาย ใจดี";
            }
            const infoInput = document.getElementById('contactInfo');
            if (infoInput) {
                infoInput.placeholder = isEn ? "example@email.com or 08x-xxx-xxxx" : "example@email.com หรือ 08x-xxx-xxxx";
            }
            const messageInput = document.getElementById('contactMessage');
            if (messageInput) {
                messageInput.placeholder = isEn ? "Type your message here..." : "พิมพ์ข้อความที่นี่...";
            }

            // Dropdown option language
            const subjectSelect = document.getElementById('contactSubject');
            if (subjectSelect) {
                const activeIndex = Math.max(0, subjectSelect.selectedIndex);
                subjectSelect.innerHTML = '';
                const list = subjectTranslations[currentLang];
                list.forEach(item => {
                    const opt = document.createElement('option');
                    opt.value = item;
                    opt.textContent = item;
                    subjectSelect.appendChild(opt);
                });
                subjectSelect.selectedIndex = activeIndex;
            }

            // Map label text
            const mapLabel = document.getElementById('mapLabelText');
            if (mapLabel) {
                mapLabel.textContent = isEn ? "📍 Chonprathan Wittaya School Map" : "📍 แผนที่โรงเรียนชลประทานวิทยา";
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            updateFormLanguage();
        });

        window.addEventListener('languageChanged', () => {
            updateFormLanguage();
        });

        function handleContactSubmit(e) {
            e.preventDefault();
            const name = document.getElementById('contactName').value;
            const subject = document.getElementById('contactSubject').value;
            
            const currentLang = localStorage.getItem('ep_lang') || 'th';
            if (currentLang === 'en') {
                alert(`✅ Thank you, ${name}, for contacting us!\n\nSubject: ${subject}\nOur team has received your message and will respond as shortly as possible.`);
            } else {
                alert(`✅ ขอบคุณคุณ ${name} ที่ส่งข้อความถึงเรา!\n\nเรื่อง: ${subject}\nทางทีมงานได้รับข้อความและจะติดต่อกลับโดยเร็วที่สุดครับ`);
            }
            
            document.getElementById('contactForm').reset();
            updateFormLanguage();
        }
    </script>
</body>
</html>
