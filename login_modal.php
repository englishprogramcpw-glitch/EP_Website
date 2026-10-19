    <!-- LOGIN MODAL (สำหรับเชื่อมต่อไปยังระบบล็อกอินกลางของโรงเรียน) -->
    <div id="loginModal" class="fixed inset-0 z-50 overflow-y-auto hidden flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div onclick="closeLoginModal()" id="loginModalBackdrop" class="absolute inset-0 bg-slate-950/60 dark:bg-slate-950/80 backdrop-blur-sm opacity-0 transition-opacity duration-200 ease-out"></div>
        
        <!-- Modal Card -->
        <div id="loginModalCard" class="relative bg-white dark:bg-slate-900 rounded-3xl w-full max-w-md overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 p-6 sm:p-8 space-y-6 transform scale-95 opacity-0 transition-all duration-200 ease-out">
            <!-- Close Button -->
            <button onclick="closeLoginModal()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 dark:hover:text-white text-2xl font-bold transition">&times;</button>
            
            <div class="text-center space-y-2">
                <span class="text-3xl">🔑</span>
                <h3 class="text-2xl font-black text-slate-950 dark:text-white">
                    <span class="lang-th">เข้าสู่ระบบสารสนเทศกลาง</span>
                    <span class="lang-en hidden">Central Portal Login</span>
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    <span class="lang-th">เลือกบริการที่คุณต้องการเข้าใช้งานเพื่อเข้าสู่หน้าเว็บหลักของโรงเรียน</span>
                    <span class="lang-en hidden">Select the service you wish to access to enter the school's main portal.</span>
                </p>
            </div>

            <div class="space-y-4">
                <!-- 1. นักเรียน -->
                <a href="https://app.cpw.ac.th/cpw_register/login.html" target="_blank" class="block p-5 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 hover:bg-slate-100 dark:bg-slate-900 dark:hover:bg-slate-850 hover:border-brand-secondary transition-all duration-300 transform hover:-translate-y-1 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-brand-secondary/10 text-brand-secondary flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                            🎓
                        </div>
                        <div class="text-left">
                            <span class="block font-black text-slate-900 dark:text-white text-sm">
                                <span class="lang-th">ระบบทะเบียนนักเรียน (CPW Register)</span>
                                <span class="lang-en hidden">Student Registration System (CPW Register)</span>
                            </span>
                            <span class="block text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                                <span class="lang-th">สำหรับนักเรียนและผู้ปกครองเข้าดูงานทะเบียน</span>
                                <span class="lang-en hidden">For students and parents to view registrations and academic records</span>
                            </span>
                        </div>
                    </div>
                </a>

                <!-- 2. บุคลากร / ครู -->
                <a href="https://center.cpw.ac.th/cpw_personal/login.php" target="_blank" class="block p-5 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 hover:bg-slate-100 dark:bg-slate-900 dark:hover:bg-slate-850 hover:border-brand-500 dark:hover:border-blue-400 transition-all duration-300 transform hover:-translate-y-1 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-brand-500/10 text-brand-500 dark:text-blue-400 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                            👨‍🏫
                        </div>
                        <div class="text-left">
                            <span class="block font-black text-slate-900 dark:text-white text-sm">
                                <span class="lang-th">ระบบบุคลากร (CPW Personal)</span>
                                <span class="lang-en hidden">Staff Information System (CPW Personal)</span>
                            </span>
                            <span class="block text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                                <span class="lang-th">สำหรับครู เจ้าหน้าที่ และผู้บริหารโครงการ</span>
                                <span class="lang-en hidden">For teachers, staff, and program administrators</span>
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- สำหรับเจ้าหน้าที่ผู้ดูแลระบบโครงการ EP -->
            <div class="pt-4 border-t border-slate-100 dark:border-slate-800 text-center space-y-2">
                <span class="block text-[11px] text-slate-400">
                    <span class="lang-th">สำหรับครูและเจ้าหน้าที่ผู้ดูแลระบบโครงการ EP</span>
                    <span class="lang-en hidden">For teachers and EP program administrators</span>
                </span>
                <a href="admin.php" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-500 hover:text-brand-600 dark:text-blue-400 dark:hover:text-blue-300 underline">
                    <span>🔒</span>
                    <span class="lang-th">เข้าสู่ระบบจัดการข้อมูลหลังบ้าน (Admin Login)</span>
                    <span class="lang-en hidden">Access Admin Management Portal</span>
                </a>
            </div>
        </div>
    </div>
