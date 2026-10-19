<?php
if (!isset($currentPage)) {
    $currentPage = '';
}
?>
    <!-- NAVIGATION BAR -->
    <nav class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-slate-200/80 dark:bg-slate-950/90 dark:border-slate-800/80 transition-all duration-300">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo / Title -->
                <div class="flex items-center gap-3.5 cursor-pointer group" onclick="window.location.href='index.php'">
                    <img src="img/cpw_logo_en.png" alt="Chonprathanwittaya School" class="w-11 h-11 object-contain drop-shadow-sm group-hover:scale-105 transition-transform duration-300">
                    <div class="space-y-0.5">
                        <span class="font-black text-lg text-slate-900 dark:text-white tracking-wider block leading-none lang-th">โครงการฯ ภาคภาษาอังกฤษ</span>
                        <span class="font-black text-lg text-slate-900 dark:text-white tracking-wider block leading-none lang-en hidden">English Program</span>
                        <span class="text-[11px] font-medium text-slate-500 dark:text-slate-400 block leading-none">
                            <span class="lang-th">โรงเรียนชลประทานวิทยา</span>
                            <span class="lang-en hidden">Chonprathanwittaya School</span>
                        </span>
                    </div>
                </div>

                <!-- Desktop Nav Links -->
                <div class="hidden lg:flex items-center gap-4 xl:gap-8">
                    <div class="flex items-center gap-3 xl:gap-5 2xl:gap-6 text-[13px] xl:text-sm whitespace-nowrap">
                        <!-- Home -->
                        <a href="index.php" class="nav-link-sisb text-sm transition-colors duration-200 hover:text-brand-accent <?php echo ($currentPage == 'index') ? 'active font-bold text-brand-500 dark:text-blue-400' : 'font-semibold text-slate-600 dark:text-slate-300'; ?>">
                            <span class="lang-th">หน้าแรก</span>
                            <span class="lang-en hidden">Home</span>
                        </a>

                        <!-- About Us Dropdown -->
                        <?php $isAboutActive = ($currentPage == 'about' || $currentPage == 'staff'); ?>
                        <div class="relative group py-2">
                            <button class="flex items-center gap-1 nav-link-sisb text-sm transition-colors duration-200 hover:text-brand-accent <?php echo $isAboutActive ? 'active font-bold text-brand-500 dark:text-blue-400' : 'font-semibold text-slate-650 dark:text-slate-300'; ?> focus:outline-none">
                                <span class="lang-th">เกี่ยวกับเรา</span>
                                <span class="lang-en hidden">About Us</span>
                                <svg class="w-3 h-3 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-2 w-52 rounded-xl bg-white dark:bg-slate-950 border border-slate-200/80 dark:border-slate-800/80 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-2">
                                <a href="about.php" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:text-brand-500 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-blue-400 dark:hover:bg-slate-900/50">
                                    <span class="lang-th">ข้อมูลทั่วไปโครงการ EP</span>
                                    <span class="lang-en hidden">Overview & Vision</span>
                                </a>
                                <a href="staff.php" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:text-brand-500 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-blue-400 dark:hover:bg-slate-900/50">
                                    <span class="lang-th">คณะครูและบุคลากร</span>
                                    <span class="lang-en hidden">Teachers & Staff</span>
                                </a>
                            </div>
                        </div>

                        <!-- Curriculum Dropdown -->
                        <?php $isCurriculumActive = ($currentPage == 'curriculum'); ?>
                        <div class="relative group py-2">
                            <button class="flex items-center gap-1 nav-link-sisb text-sm transition-colors duration-200 hover:text-brand-accent <?php echo $isCurriculumActive ? 'active font-bold text-brand-500 dark:text-blue-400' : 'font-semibold text-slate-650 dark:text-slate-300'; ?> focus:outline-none">
                                <span class="lang-th">หลักสูตร</span>
                                <span class="lang-en hidden">Curriculum</span>
                                <svg class="w-3 h-3 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-2 w-64 rounded-xl bg-white dark:bg-slate-950 border border-slate-200/80 dark:border-slate-800/80 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-2">
                                <a href="curriculum.php#tab-primary" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:text-brand-500 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-blue-400 dark:hover:bg-slate-900/50">
                                    <span class="lang-th">ระดับประถมศึกษา (ป.1 - ป.6)</span>
                                    <span class="lang-en hidden">Primary School (P.1 - P.6)</span>
                                </a>
                                <a href="curriculum.php#tab-junior" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:text-brand-500 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-blue-400 dark:hover:bg-slate-900/50">
                                    <span class="lang-th">ระดับมัธยมศึกษาตอนต้น (ม.1 - ม.3)</span>
                                    <span class="lang-en hidden">Junior High (M.1 - M.3)</span>
                                </a>
                                <a href="curriculum.php#tab-senior" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:text-brand-500 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-blue-400 dark:hover:bg-slate-900/50">
                                    <span class="lang-th">ระดับมัธยมศึกษาตอนปลาย (ม.4 - ม.6)</span>
                                    <span class="lang-en hidden">Senior High (M.4 - M.6)</span>
                                </a>
                            </div>
                        </div>

                        <!-- Admissions Dropdown -->
                        <?php $isAdmissionsActive = ($currentPage == 'admission' || $currentPage == 'fees'); ?>
                        <div class="relative group py-2">
                            <button class="flex items-center gap-1 nav-link-sisb text-sm transition-colors duration-200 hover:text-brand-accent <?php echo $isAdmissionsActive ? 'active font-bold text-brand-500 dark:text-blue-400' : 'font-semibold text-slate-650 dark:text-slate-300'; ?> focus:outline-none">
                                <span class="lang-th">รับสมัครเรียน</span>
                                <span class="lang-en hidden">Admissions</span>
                                <svg class="w-3 h-3 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-2 w-60 rounded-xl bg-white dark:bg-slate-950 border border-slate-200/80 dark:border-slate-800/80 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-2">
                                <a href="admission.php" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:text-brand-500 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-blue-400 dark:hover:bg-slate-900/50">
                                    <span class="lang-th">เกณฑ์และขั้นตอนการสมัครเรียน</span>
                                    <span class="lang-en hidden">Process & Requirements</span>
                                </a>
                                <a href="fees.php" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:text-brand-500 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-blue-400 dark:hover:bg-slate-900/50">
                                    <span class="lang-th">อัตราค่าเล่าเรียน & ค่าธรรมเนียม</span>
                                    <span class="lang-en hidden">Tuition & Fees Breakdown</span>
                                </a>
                                <a href="tour.php" class="block px-4 py-2 text-xs font-bold text-brand-500 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-slate-900/50">
                                    <span class="lang-th">🏛️ นัดหมายเยี่ยมชมโครงการ (Campus Tour)</span>
                                    <span class="lang-en hidden">🏛️ Book a Campus Tour</span>
                                </a>
                            </div>
                        </div>

                                                <!-- News & Achievements Dropdown -->
                        <div class="relative group py-2">
                            <button class="flex items-center gap-1 nav-link-sisb text-sm transition-colors duration-200 hover:text-brand-accent <?php echo in_array($currentPage, ['awards', 'news']) ? 'active font-bold text-brand-500 dark:text-blue-400' : 'font-semibold text-slate-600 dark:text-slate-300'; ?> focus:outline-none">
                                <span class="lang-th">ผลงาน & ข่าวสาร</span>
                                <span class="lang-en hidden">Achievements & News</span>
                                <svg class="w-3 h-3 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-2 w-64 rounded-xl bg-white dark:bg-slate-950 border border-slate-200/80 dark:border-slate-800/80 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-2">
                                <a href="awards.php" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:text-brand-500 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-blue-400 dark:hover:bg-slate-900/50 <?php echo ($currentPage == 'awards') ? 'text-brand-500 font-bold dark:text-blue-400' : ''; ?>">
                                    <span class="lang-th">🏆 ทำเนียบเกียรติยศ (Hall of Fame)</span>
                                    <span class="lang-en hidden">🏆 EP Hall of Fame</span>
                                </a>
                                <a href="news.php" class="block px-4 py-2 text-xs font-bold text-slate-700 hover:text-brand-500 hover:bg-slate-50 dark:text-slate-300 dark:hover:text-blue-400 dark:hover:bg-slate-900/50 <?php echo ($currentPage == 'news') ? 'text-brand-500 font-bold dark:text-blue-400' : ''; ?>">
                                    <span class="lang-th">📰 ข่าวสาร & กิจกรรม</span>
                                    <span class="lang-en hidden">📰 News & Activities</span>
                                </a>
                            </div>
                        </div>

<!-- Contact -->
                        <a href="contact.php" class="nav-link-sisb text-sm transition-colors duration-200 hover:text-brand-accent <?php echo ($currentPage == 'contact') ? 'active font-bold text-brand-500 dark:text-blue-400' : 'font-semibold text-slate-600 dark:text-slate-300'; ?>">
                            <span class="lang-th">ติดต่อเรา</span>
                            <span class="lang-en hidden">Contact Us</span>
                        </a>
                    </div>
                    
                    <div class="h-5 w-px bg-slate-200 dark:bg-slate-800"></div>

                    <div class="flex items-center gap-4">
                        <!-- Language Switcher -->
                        <button onclick="toggleLanguage()" id="langSwitcherBtn" class="text-xs font-bold w-9 h-9 flex items-center justify-center bg-slate-100 hover:bg-slate-200 dark:bg-slate-900 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl transition-colors duration-200">EN</button>

                        <!-- Login Container -->
                        <div id="loginNavContainer"></div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex lg:hidden items-center gap-3">
                    <button onclick="toggleLanguage()" id="langSwitcherBtn" class="text-xs font-bold w-9 h-9 flex items-center justify-center bg-slate-100 hover:bg-slate-200 dark:bg-slate-900 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl transition-colors duration-200">EN</button>
                    <button onclick="toggleMobileMenu()" class="w-9 h-9 flex items-center justify-center rounded-xl text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-900 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Nav Links -->
        <div id="mobileMenu" class="hidden lg:hidden bg-white/95 backdrop-blur-md dark:bg-slate-950/95 border-b border-slate-200 dark:border-slate-800 px-4 py-4 space-y-2">
            <a href="index.php" class="block px-4 py-2.5 rounded-xl text-base transition <?php echo ($currentPage == 'index') ? 'font-bold bg-slate-100 text-slate-900 dark:bg-slate-900 dark:text-white' : 'font-semibold text-slate-700 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-900/50'; ?>">
                <span class="lang-th">หน้าแรก</span>
                <span class="lang-en hidden">Home</span>
            </a>
            
            <!-- About Us Group Mobile -->
            <div class="space-y-1 pt-1">
                <div class="px-4 py-1.5 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    <span class="lang-th">เกี่ยวกับเรา</span>
                    <span class="lang-en hidden">About Us</span>
                </div>
                <a href="about.php" class="block pl-8 pr-4 py-2 rounded-xl text-sm font-semibold text-slate-650 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-900/50 <?php echo ($currentPage == 'about') ? 'text-brand-500 font-bold dark:text-blue-400' : ''; ?>">
                    <span class="lang-th">ข้อมูลทั่วไปโครงการ EP</span>
                    <span class="lang-en hidden">Overview & Vision</span>
                </a>
                <a href="staff.php" class="block pl-8 pr-4 py-2 rounded-xl text-sm font-semibold text-slate-655 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-900/50 <?php echo ($currentPage == 'staff') ? 'text-brand-500 font-bold dark:text-blue-400' : ''; ?>">
                    <span class="lang-th">คณะครูและบุคลากร</span>
                    <span class="lang-en hidden">Teachers & Staff</span>
                </a>
            </div>

            <!-- Curriculum Group Mobile -->
            <div class="space-y-1 pt-1">
                <div class="px-4 py-1.5 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    <span class="lang-th">หลักสูตร</span>
                    <span class="lang-en hidden">Curriculum</span>
                </div>
                <a href="curriculum.php#tab-primary" onclick="toggleMobileMenu()" class="block pl-8 pr-4 py-2 rounded-xl text-sm font-semibold text-slate-650 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-900/50">
                    <span class="lang-th">ระดับประถมศึกษา (ป.1 - ป.6)</span>
                    <span class="lang-en hidden">Primary School (P.1 - P.6)</span>
                </a>
                <a href="curriculum.php#tab-junior" onclick="toggleMobileMenu()" class="block pl-8 pr-4 py-2 rounded-xl text-sm font-semibold text-slate-650 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-900/50">
                    <span class="lang-th">ระดับมัธยมศึกษาตอนต้น (ม.1 - ม.3)</span>
                    <span class="lang-en hidden">Junior High (M.1 - M.3)</span>
                </a>
                <a href="curriculum.php#tab-senior" onclick="toggleMobileMenu()" class="block pl-8 pr-4 py-2 rounded-xl text-sm font-semibold text-slate-650 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-900/50">
                    <span class="lang-th">ระดับมัธยมศึกษาตอนปลาย (ม.4 - ม.6)</span>
                    <span class="lang-en hidden">Senior High (M.4 - M.6)</span>
                </a>
            </div>

            <!-- Admissions Group Mobile -->
            <div class="space-y-1 pt-1">
                <div class="px-4 py-1.5 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    <span class="lang-th">การรับสมัคร</span>
                    <span class="lang-en hidden">Admissions</span>
                </div>
                <a href="admission.php" class="block pl-8 pr-4 py-2 rounded-xl text-sm font-semibold text-slate-650 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-900/50 <?php echo ($currentPage == 'admission') ? 'text-brand-500 font-bold dark:text-blue-400' : ''; ?>">
                    <span class="lang-th">เกณฑ์และขั้นตอนการสมัครเรียน</span>
                    <span class="lang-en hidden">Process & Requirements</span>
                </a>
                <a href="fees.php" class="block pl-8 pr-4 py-2 rounded-xl text-sm font-semibold text-slate-650 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-900/50 <?php echo ($currentPage == 'fees') ? 'text-brand-500 font-bold dark:text-blue-400' : ''; ?>">
                    <span class="lang-th">อัตราค่าเล่าเรียน & ค่าธรรมเนียม</span>
                    <span class="lang-en hidden">Tuition & Fees Breakdown</span>
                </a>
                <a href="tour.php" class="block pl-8 pr-4 py-2 rounded-xl text-sm font-bold text-brand-500 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-900/50 <?php echo ($currentPage == 'tour') ? 'bg-blue-50 dark:bg-slate-900' : ''; ?>">
                    <span class="lang-th">🏛️ นัดหมายเยี่ยมชมโครงการ (Campus Tour)</span>
                    <span class="lang-en hidden">🏛️ Book a Campus Tour</span>
                </a>
            </div>

                        <!-- Achievements & News Mobile Group -->
            <div class="space-y-1 pt-1">
                <div class="px-4 py-1.5 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    <span class="lang-th">ผลงาน & ข่าวสาร</span>
                    <span class="lang-en hidden">Achievements & News</span>
                </div>
                <a href="awards.php" onclick="toggleMobileMenu()" class="block pl-8 pr-4 py-2 rounded-xl text-sm font-semibold text-slate-650 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-900/50 <?php echo ($currentPage == 'awards') ? 'text-brand-500 font-bold dark:text-blue-400' : ''; ?>">
                    <span class="lang-th">🏆 ทำเนียบเกียรติยศ (Hall of Fame)</span>
                    <span class="lang-en hidden">🏆 EP Hall of Fame</span>
                </a>
                <a href="news.php" onclick="toggleMobileMenu()" class="block pl-8 pr-4 py-2 rounded-xl text-sm font-semibold text-slate-650 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-900/50 <?php echo ($currentPage == 'news') ? 'text-brand-500 font-bold dark:text-blue-400' : ''; ?>">
                    <span class="lang-th">📰 ข่าวสารและกิจกรรมประชาสัมพันธ์</span>
                    <span class="lang-en hidden">📰 News & Activities</span>
                </a>
            </div>

<!-- Contact -->
            <a href="contact.php" class="block px-4 py-2.5 rounded-xl text-base transition <?php echo ($currentPage == 'contact') ? 'font-bold bg-slate-100 text-slate-900 dark:bg-slate-900 dark:text-white' : 'font-semibold text-slate-700 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-900/50'; ?>">
                <span class="lang-th">ติดต่อเรา</span>
                <span class="lang-en hidden">Contact Us</span>
            </a>
            
            <div id="loginNavContainerMobile" class="pt-3 border-t border-slate-150 dark:border-slate-800"></div>
        </div>
    </nav>
