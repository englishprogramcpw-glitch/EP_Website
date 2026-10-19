<?php
$pageTitle = "บุคลากรและคณะครู | English Program (EP) CPW";
$currentPage = "staff";
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <?php include 'head.php'; ?>
</head>
<body class="bg-slate-50 text-slate-800 font-sans transition-colors duration-300 dark:bg-slate-900 dark:text-slate-100 min-h-screen flex flex-col">

    <?php include 'header.php'; ?>

    <style>
        .avatar-primary {
            background: radial-gradient(circle at 35% 35%, #ff96c8 0%, #b43c70 100%) !important;
            border: 6px solid #2563eb !important;
        }
        .avatar-secondary {
            background: radial-gradient(circle at 35% 35%, #5ab4ff 0%, #1e5ab4 100%) !important;
            border: 6px solid #f050b4 !important;
        }
        .avatar-admin {
            background: radial-gradient(circle at 35% 35%, #dcb4ff 0%, #783cb4 100%) !important;
            border: 6px solid #ffffff !important;
        }
        .avatar-specialist {
            background: radial-gradient(circle at 35% 35%, #fde047 0%, #d97706 100%) !important;
            border: 6px solid #7c3aed !important;
        }
    </style>

    <!-- HEADER BANNER -->
    <header class="relative bg-slate-950 text-white py-24 px-4 overflow-hidden flex items-center justify-center bg-cover bg-center" style="background-image: url('img/ep_bot_lobby_bg.jpg');">
        <div class="absolute inset-0 bg-slate-950/70"></div>
        <div class="relative max-w-4xl mx-auto text-center space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-accent/10 border border-brand-accent/25 text-brand-accent text-xs font-bold font-english uppercase tracking-wider">
                EP Faculty & Administration
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-tight">
                <span class="lang-th">บุคลากรและคณะครู (EP Staff)</span>
                <span class="lang-en hidden">EP Staff & Teachers</span>
            </h1>
            <p class="text-slate-350 text-sm sm:text-base font-normal max-w-2xl mx-auto leading-relaxed">
                <span class="lang-th">คณะครูผู้สอนประจำหลักสูตร ครูประจำชั้น และหัวหน้าฝ่ายบริหารโครงการฯ ภาคภาษาอังกฤษ</span>
                <span class="lang-en hidden">Our active teaching faculty, homeroom teachers, and the English Program administrators.</span>
            </p>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-grow max-w-[1400px] w-full mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        <!-- Tab Navigation -->
        <div class="flex flex-wrap gap-2 mb-6 border-b border-slate-200 dark:border-slate-800 pb-0">
            <button onclick="switchTab('support')" id="tab-support"
                class="tab-btn px-5 py-3 text-xs sm:text-sm font-bold rounded-t-xl border border-b-0 border-slate-200 dark:border-slate-800 bg-brand-500 text-white -mb-px transition-all flex items-center gap-1.5">
                <span>💼</span>
                <span class="lang-th">ฝ่ายบริหาร</span>
                <span class="lang-en hidden">Administration</span>
            </button>
            <button onclick="switchTab('homeroom')" id="tab-homeroom"
                class="tab-btn px-5 py-3 text-xs sm:text-sm font-bold rounded-t-xl border border-b-0 border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all flex items-center gap-1.5">
                <span>🎓</span>
                <span class="lang-th">ครูประจำชั้น</span>
                <span class="lang-en hidden">Homeroom Advisors</span>
            </button>
            <button onclick="switchTab('foreign')" id="tab-foreign"
                class="tab-btn px-5 py-3 text-xs sm:text-sm font-bold rounded-t-xl border border-b-0 border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all flex items-center gap-1.5">
                <span>🌐</span>
                <span class="lang-th">ครูชาวต่างชาติ</span>
                <span class="lang-en hidden">Foreign Faculty</span>
            </button>
            <!-- ซ่อนแท็บอาจารย์พิเศษไว้ชั่วคราวระหว่างรอรวบรวมรูปถ่ายและข้อมูลวิชาสอนให้ครบถ้วน -->
            <button onclick="switchTab('specialist')" id="tab-specialist"
                class="hidden tab-btn px-5 py-3 text-xs sm:text-sm font-bold rounded-t-xl border border-b-0 border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all flex items-center gap-1.5">
                <span>🌟</span>
                <span class="lang-th">อาจารย์พิเศษและผู้เชี่ยวชาญ</span>
                <span class="lang-en hidden">Specialist & Visiting Faculty</span>
            </button>
        </div>

        <!-- Tab Description Banner -->
        <div id="tab-description-banner" class="mb-8 p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-blue-500/10 via-purple-500/5 to-transparent border border-blue-200/60 dark:border-blue-900/40">
            <!-- Dynamic Injection of Tab Info -->
        </div>

        <!-- Content Area -->
        <div id="teachers-grid">
            <!-- Dynamic Injection -->
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <?php include 'login_modal.php'; ?>

    <!-- Script สำหรับหน้า Staff เท่านั้น -->
    <script>
        // ข้อมูลบุคลากรจำลอง (จะอัปเดตอัตโนมัติหากมีข้อมูลใน DB)
        let TEACHERS_DATA = [
            // --- คณะผู้บริหารโครงการ (Project Administrators) ---
            {
                name: "นางปรารถนา วิเศษสุภมิตร",
                name_en: "Mrs. Pratana Wisetsupamitr",
                role: "หัวหน้าโครงการส่งเสริมความเป็นเลิศทางภาษาอังกฤษ (EP)",
                role_en: "Head of Chonprathan Wittaya EP",
                category: "admin",
                isForeign: false,
                classRoom: "สำนักงาน EP",
                classRoom_en: "EP Office",
                subjects: ["บริหารจัดการโครงการ (EP Administration)"],
                subjects_en: ["EP Administration"],
                imageUrl: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=300&auto=format&fit=crop&q=80"
            },
            {
                name: "นางพัชรา ทัศนวิจิตรวงศ์",
                name_en: "Mrs. Patchara Tassanavijitwong",
                role: "ที่ปรึกษาโครงการฯ EP",
                role_en: "EP Project Advisor",
                category: "admin",
                isForeign: false,
                classRoom: "สำนักงาน EP",
                classRoom_en: "EP Office",
                subjects: ["การให้คำปรึกษาด้านวิชาการ (Academic Advisory)"],
                subjects_en: ["Academic Advisory"],
                imageUrl: "https://images.unsplash.com/photo-1580489944761-15a19d654956?w=300&auto=format&fit=crop&q=80"
            },
            {
                name: "นายปิยะวัตร ประทุมชาติ",
                name_en: "Mr. Piyawat Pratumchat",
                role: "ผู้ช่วยหัวหน้าโครงการฯ และหัวหน้างานปกครอง",
                role_en: "Assistant EP Head & Head of Student Discipline",
                category: "admin",
                isForeign: false,
                classRoom: "สำนักงาน EP",
                classRoom_en: "EP Office",
                subjects: ["งานระเบียบวินัยและงานปกครอง (Student Discipline)"],
                subjects_en: ["Student Discipline & Welfare"],
                imageUrl: "https://images.unsplash.com/photo-1560250097-0b93528c311a?w=300&auto=format&fit=crop&q=80"
            },
            // --- คณะครูระดับประถมศึกษา (P.1 - P.6) ---
            {
                name: "ครูวิภา ศรีสุข",
                name_en: "Teacher Wipa Srisuk",
                role: "ครูประจำชั้นไทย",
                role_en: "Thai Advisor",
                category: "primary",
                isForeign: false,
                classRoom: "ห้องเรียน ป.1/14",
                classRoom_en: "Classroom P.1/14",
                subjects: ["สังคมศึกษาศาสนาและวัฒนธรรม", "ประวัติศาสตร์"],
                subjects_en: ["Social Studies, Religion, & Culture", "History"],
                imageUrl: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=300&auto=format&fit=crop&q=80"
            },
            {
                name: "Mr. Johnathan Smith",
                name_en: "Mr. Johnathan Smith",
                role: "ครูประจำชั้นต่างชาติ (Foreign Teacher)",
                role_en: "Foreign Advisor",
                category: "primary",
                isForeign: true,
                classRoom: "ห้องเรียน ป.1/14",
                classRoom_en: "Classroom P.1/14",
                subjects: ["Mathematics (คณิตศาสตร์)", "Science (วิทยาศาสตร์)"],
                subjects_en: ["Mathematics", "Science"],
                imageUrl: "https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=300&auto=format&fit=crop&q=80"
            },
            {
                name: "ครูสุดา ใจดี",
                name_en: "Teacher Suda Jaidee",
                role: "ครูประจำชั้นไทย",
                role_en: "Thai Advisor",
                category: "primary",
                isForeign: false,
                classRoom: "ห้องเรียน ป.1/15",
                classRoom_en: "Classroom P.1/15",
                subjects: ["ภาษาไทย", "ศิลปะและหัตถกรรม"],
                subjects_en: ["Thai Language", "Arts & Crafts"],
                imageUrl: "https://images.unsplash.com/photo-1554151228-14d9def656e4?w=300&auto=format&fit=crop&q=80"
            },
            {
                name: "Miss Emily Watson",
                name_en: "Miss Emily Watson",
                role: "ครูประจำชั้นต่างชาติ (Foreign Teacher)",
                role_en: "Foreign Advisor",
                category: "primary",
                isForeign: true,
                classRoom: "ห้องเรียน ป.1/15",
                classRoom_en: "Classroom P.1/15",
                subjects: ["English Reading & Writing", "Listening & Speaking", "Phonetics"],
                subjects_en: ["English Reading & Writing", "Listening & Speaking", "Phonetics"],
                imageUrl: "https://images.unsplash.com/photo-1594744803329-e58b31de215f?w=300&auto=format&fit=crop&q=80"
            },
            {
                name: "ครูอารีย์ รักเรียน",
                name_en: "Teacher Aree Rakrean",
                role: "ครูประจำชั้นไทย",
                role_en: "Thai Advisor",
                category: "primary",
                isForeign: false,
                classRoom: "ห้องเรียน ป.2/14",
                classRoom_en: "Classroom P.2/14",
                subjects: ["คณิตศาสตร์ (ไทย)", "การงานอาชีพ"],
                subjects_en: ["Mathematics (Thai)", "Occupational Works"],
                imageUrl: "https://images.unsplash.com/photo-1534751516642-a131fed10495?w=300&auto=format&fit=crop&q=80"
            },
            // --- คณะครูระดับมัธยมศึกษา (M.1 - M.6) ---
            {
                name: "ครูสมศักดิ์ รักเรียน",
                name_en: "Teacher Somsak Rakrean",
                role: "ครูประจำชั้นไทย",
                role_en: "Thai Advisor",
                category: "secondary",
                isForeign: false,
                classRoom: "ห้องเรียน ม.1/11",
                classRoom_en: "Classroom M.1/11",
                subjects: ["เทคโนโลยีและวิทยาการคำนวณ", "การงานอาชีพ"],
                subjects_en: ["Technology & Computing Science", "Occupational Works"],
                imageUrl: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&auto=format&fit=crop&q=80"
            },
            {
                name: "Mr. Michael Brown",
                name_en: "Mr. Michael Brown",
                role: "ครูประจำชั้นต่างชาติ (Foreign Teacher)",
                role_en: "Foreign Advisor",
                category: "secondary",
                isForeign: true,
                classRoom: "ห้องเรียน ม.1/11",
                classRoom_en: "Classroom M.1/11",
                subjects: ["Computer & IT (คอมพิวเตอร์)", "English (ภาษาอังกฤษ)"],
                subjects_en: ["Computer & IT", "English"],
                imageUrl: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&auto=format&fit=crop&q=80"
            },
            {
                name: "ครูจิราพร พรหมมา",
                name_en: "Teacher Jiraporn Promma",
                role: "ครูประจำชั้นไทย",
                role_en: "Thai Advisor",
                category: "secondary",
                isForeign: false,
                classRoom: "ห้องเรียน ม.4/11",
                classRoom_en: "Classroom M.4/11",
                subjects: ["คณิตศาสตร์เพิ่มเติม (คณิตศาสตร์ขั้นสูง)", "ฟิสิกส์"],
                subjects_en: ["Advanced Mathematics", "Physics"],
                imageUrl: "https://images.unsplash.com/photo-1567532939604-b6b5b0db2604?w=300&auto=format&fit=crop&q=80"
            }
        ];

        let activeTab = 'support';

        // Tab definitions — filter function decides who belongs to each tab
        const TABS = {
            support:    item => item.category === 'admin',
            homeroom:   item => !!item.role_homeroom && !item.isForeign && item.category !== 'foreign',
            foreign:    item => item.isForeign || item.category === 'foreign',
            specialist: item => !item.isForeign && item.category !== 'admin' && (item.personnelId && item.personnelId.startsWith('80')),
        };

        const TAB_DESCRIPTIONS = {
            support: {
                title_th: "คณะผู้บริหารและฝ่ายบริหารโครงการฯ",
                title_en: "Executive Committee & Administration",
                desc_th: "ผู้นำทางวิชาการและคณะกรรมการบริหารโครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ (EP)",
                desc_en: "Academic leadership and administrative committee of Chonprathanwittaya School English Program."
            },
            homeroom: {
                title_th: "คณะครูประจำชั้นระดับประถมศึกษาและมัธยมศึกษา",
                title_en: "Homeroom Advisors (Primary & Secondary)",
                desc_th: "ครูประจำชั้นชาวไทย ร่วมดูแลเอาใจใส่พัฒนาการ วินัย และความเป็นอยู่ของนักเรียนอย่างใกล้ชิดในทุกห้องเรียน",
                desc_en: "Dedicated Thai advisors providing close academic and personal mentorship for each classroom."
            },
            foreign: {
                title_th: "คณาจารย์ชาวต่างชาติ (Foreign Faculty & Native Speakers)",
                title_en: "Foreign Faculty & Native Speakers",
                desc_th: "อาจารย์เจ้าของภาษาและผู้เชี่ยวชาญภาษาอังกฤษ โดยความร่วมมือกับสถาบันภาษาและสยามคอมพิวเตอร์ เพื่อการเรียนรู้สองภาษาที่เปี่ยมคุณภาพ",
                desc_en: "Native English speakers and international educators in partnership with Siam Computer and academic language institutes."
            },
            specialist: {
                title_th: "อาจารย์พิเศษและผู้เชี่ยวชาญเฉพาะทาง (Specialist & Adjunct Faculty)",
                title_en: "Specialist & Visiting Faculty",
                desc_th: "คณาจารย์ผู้ทรงคุณวุฒิระดับปริญญาโท/อาจารย์มหาวิทยาลัย, เครือข่ายวิชาการ EP สามเสนวิทยาลัย และผู้เชี่ยวชาญภาษาจีน/สาขาเฉพาะทางที่ร่วมยกระดับวิชาการ",
                desc_en: "Distinguished adjunct faculty holding Master's degrees, university lecturers, Samsenwittayalai EP network educators, and Chinese language specialists."
            }
        };

        window.addEventListener('DOMContentLoaded', () => {
            renderSkeletons();
            updateTabDescription();
            getDbStaff(data => {
                if (data && data.length > 0) TEACHERS_DATA = data;
                setTimeout(() => {
                    renderTeachers();
                    if (window.ep_editor_enable) window.ep_editor_enable();
                }, 400);
            });
        });

        function updateTabDescription() {
            const banner = document.getElementById('tab-description-banner');
            if (!banner) return;
            const isEn = (localStorage.getItem('ep_lang') || 'th') === 'en';
            const info = TAB_DESCRIPTIONS[activeTab] || TAB_DESCRIPTIONS.support;
            banner.innerHTML = `
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <h2 class="text-sm sm:text-base font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                            <span>${info.title_th ? (isEn ? info.title_en : info.title_th) : ''}</span>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-1 leading-relaxed">
                            ${isEn ? info.desc_en : info.desc_th}
                        </p>
                    </div>
                </div>
            `;
        }

        function switchTab(tab) {
            activeTab = tab;
            updateTabDescription();
            ['support', 'homeroom', 'foreign', 'specialist'].forEach(t => {
                const btn = document.getElementById('tab-' + t);
                if (!btn) return;
                if (t === tab) {
                    btn.className = 'tab-btn px-5 py-3 text-xs sm:text-sm font-bold rounded-t-xl border border-b-0 border-slate-200 dark:border-slate-800 bg-brand-500 text-white -mb-px transition-all flex items-center gap-1.5';
                } else {
                    btn.className = 'tab-btn px-5 py-3 text-xs sm:text-sm font-bold rounded-t-xl border border-b-0 border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all flex items-center gap-1.5';
                }
            });
            renderTeachers();
        }

        function renderSkeletons() {
            const grid = document.getElementById('teachers-grid');
            if (!grid) return;
            grid.innerHTML = '';

            const isSupport = activeTab === 'support';
            const cols = isSupport
                ? 'grid-cols-2 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4'
                : (activeTab === 'homeroom' ? 'grid-cols-2 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6' : 'grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5');
            
            const gridEl = document.createElement('div');
            gridEl.className = 'grid ' + cols + ' gap-x-4 gap-y-7 w-full';
            
            const count = isSupport ? 4 : 12;
            const isExec = isSupport;
            
            for (let i = 0; i < count; i++) {
                const card = document.createElement('div');
                card.className = 'flex flex-col items-center text-center w-full animate-pulse';
                
                const frameClassStr = (isExec && i < 2)
                    ? 'w-full aspect-square max-w-[200px] mb-3'
                    : 'w-full aspect-square max-w-[180px] mb-3';
                
                card.innerHTML = 
                    '<div class="rounded-full bg-slate-200 dark:bg-slate-700/60 shadow-sm mx-auto ' + frameClassStr + '"></div>' +
                    '<div class="h-3.5 bg-slate-200 dark:bg-slate-700/60 rounded-md w-28 mx-auto mb-2"></div>' +
                    '<div class="h-3 bg-slate-200 dark:bg-slate-700/40 rounded-md w-20 mx-auto"></div>';
                gridEl.appendChild(card);
            }
            grid.appendChild(gridEl);
        }

        function renderTeachers() {
            const grid = document.getElementById('teachers-grid');
            if (!grid) return;
            grid.innerHTML = '';

            const isEn = (localStorage.getItem('ep_lang') || 'th') === 'en';
            const allItems = TEACHERS_DATA.map((item, idx) => ({ ...item, originalIndex: idx }));
            let items = allItems.filter(TABS[activeTab] || (() => true));

            // หากเป็นแท็บชาวต่างชาติ ให้แสดงเฉพาะท่านที่มีรูปถ่ายเรียบร้อย (ซ่อน default.jpg ชั่วคราวก่อนเปิดตัวช่วงปิดเทอม)
            if (activeTab === 'foreign') {
                items = items.filter(item => item.imageUrl && !item.imageUrl.includes('default.jpg'));
            }

            if (activeTab === 'homeroom') {
                // Sort Advisor tab strictly by classroom level, grade, and room!
                items.sort((a, b) => {
                    const getSortVal = role => {
                        if (!role) return [9, 9, 9];
                        const m = role.match(/([^\d\s\.\/])\.(\d+)\/(\d+)/);
                        if (m) {
                            const level = (m[1].charCodeAt(0) === 3611) ? 0 : 1;
                            const grade = parseInt(m[2]);
                            const room = parseInt(m[3]);
                            return [level, grade, room];
                        }
                        return [9, 9, 9];
                    };
                    const valA = getSortVal(a.role_homeroom);
                    const valB = getSortVal(b.role_homeroom);
                    if (valA[0] !== valB[0]) return valA[0] - valB[0];
                    if (valA[1] !== valB[1]) return valA[1] - valB[1];
                    return valA[2] - valB[2];
                });
            }

            const hasPhoto = item => item.imageUrl && !item.imageUrl.includes('default.jpg');

            // card size: larger for support, portrait grid for teachers
            const isSupport = activeTab === 'support';
            const cols = isSupport
                ? 'grid-cols-2 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4'
                : (activeTab === 'homeroom' ? 'grid-cols-2 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6' : 'grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5');
            
            const nameClass = 'font-bold text-slate-900 dark:text-white text-xs leading-tight mt-2';
            const roleClass = 'text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 leading-tight';
            const subClass = 'text-[10px] text-brand-500 dark:text-blue-400 font-semibold mt-0.5';

            if (items.length === 0) {
                grid.innerHTML = '<p class="text-center text-slate-400 py-20">' + (isEn ? 'No data' : 'ไม่มีข้อมูลในหมวดนี้') + '</p>';
                return;
            }

            function createCard(item, isExecCard) {
                const name = isEn && item.name_en ? item.name_en : item.name;
                
                // Show tab-specific roles
                let role = isEn && item.role_en ? item.role_en : item.role;
                let roleField = isEn ? 'role_en' : 'role';
                
                if (activeTab === 'homeroom' && item.role_homeroom) {
                    role = isEn && item.role_homeroom_en ? item.role_homeroom_en : item.role_homeroom;
                    roleField = isEn ? 'role_homeroom_en' : 'role_homeroom';
                } else if ((activeTab === 'foreign' || activeTab === 'specialist') && item.role_subject) {
                    role = isEn && item.role_subject_en ? item.role_subject_en : item.role_subject;
                    roleField = isEn ? 'role_subject_en' : 'role_subject';
                }
                
                const classRoom = isEn && item.classRoom_en ? item.classRoom_en : item.classRoom;
                const nameField = isEn ? 'name_en' : 'name';

                const hasRealPhoto = item.imageUrl && !item.imageUrl.includes('default.jpg');
                const sideUrl = hasRealPhoto && !item.imageUrl.startsWith('http')
                    ? item.imageUrl.replace(/(\.[^.]+)$/, '-2$1')
                    : (item.imageUrl || '');
                
                let imgHtml = '';
                if (hasRealPhoto) {
                    imgHtml = '<img src="' + sideUrl + '" onerror="this.onerror=null;this.src=\'' + item.imageUrl + '\';this.onerror=function(){this.style.display=\'none\';}" class="w-full h-full object-cover object-top" alt="' + name + '">';
                } else {
                    const icon = item.isForeign ? '🌐' : (activeTab === 'specialist' ? '🌟' : '🎓');
                    const badgeText = item.personnelId ? 'ID ' + item.personnelId : 'EP CPW';
                    imgHtml = '<div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-slate-100 via-slate-50 to-blue-50 dark:from-slate-800 dark:via-slate-850 dark:to-slate-900 text-slate-400 select-none">'
                        + '<span class="text-3xl sm:text-4xl filter drop-shadow-sm">' + icon + '</span>'
                        + '<span class="text-[9px] font-bold text-slate-500 dark:text-slate-400 mt-1 uppercase tracking-wider font-english">' + badgeText + '</span>'
                        + '</div>';
                }

                const currentNameClass = isExecCard
                    ? 'font-bold text-slate-900 dark:text-white text-base leading-tight mt-3'
                    : nameClass;
                const currentRoleClass = isExecCard
                    ? 'text-[13px] text-slate-500 dark:text-slate-400 mt-1.5 leading-tight'
                    : roleClass;

                const card = document.createElement('div');
                card.className = 'flex flex-col items-center text-center w-full';
                
                const frameClassStr = isExecCard
                    ? 'w-full aspect-square max-w-[200px]'
                    : 'w-full aspect-square max-w-[180px]';

                let themeClass = '';
                if (activeTab === 'support') {
                    themeClass = 'avatar-admin';
                } else if (activeTab === 'homeroom') {
                    const isPrimary = item.role_homeroom && item.role_homeroom.includes('ป.');
                    themeClass = isPrimary ? 'avatar-primary' : 'avatar-secondary';
                } else if (activeTab === 'foreign') {
                    themeClass = 'avatar-secondary';
                } else {
                    themeClass = 'avatar-specialist';
                }

                card.innerHTML =
                    '<div data-edit-id="staff_' + item.originalIndex + '_imageUrl" class="relative overflow-hidden rounded-full shadow-sm mx-auto ' + frameClassStr + ' ' + themeClass + '">'
                    + imgHtml
                    + '</div>'
                    + '<p data-edit-id="staff_' + item.originalIndex + '_' + nameField + '" class="' + currentNameClass + ' px-1">' + name + '</p>'
                    + '<p data-edit-id="staff_' + item.originalIndex + '_' + roleField + '" class="' + currentRoleClass + ' px-1">' + role + '</p>'
                    + (classRoom && item.category !== 'admin' && activeTab !== 'homeroom' && activeTab !== 'foreign' && activeTab !== 'specialist' ? '<p class="' + subClass + '">' + classRoom + '</p>' : '');
                return card;
            }

            if (isSupport) {
                // Separate top executives (Advisor 10997 and Head 10158 only)
                const executives = items.filter(item => 
                    item.personnelId === '10997' || item.personnelId === '10158' ||
                    (item.imageUrl && (item.imageUrl.includes('10997') || item.imageUrl.includes('10158')))
                );
                const restOfSupport = items.filter(item => !executives.includes(item));

                if (executives.length > 0) {
                    const execContainer = document.createElement('div');
                    execContainer.className = 'flex flex-col items-center mb-8 w-full';

                    const execGrid = document.createElement('div');
                    execGrid.className = 'grid grid-cols-2 gap-x-16 sm:gap-x-24 max-w-lg mx-auto';
                    executives.forEach(item => {
                        execGrid.appendChild(createCard(item, true));
                    });
                    execContainer.appendChild(execGrid);

                    const divider = document.createElement('div');
                    divider.className = 'w-full border-t border-slate-200 dark:border-slate-800 my-8';
                    execContainer.appendChild(divider);

                    grid.appendChild(execContainer);
                }

                if (restOfSupport.length > 0) {
                    const gridEl = document.createElement('div');
                    gridEl.className = 'grid ' + cols + ' gap-x-4 gap-y-7';
                    restOfSupport.forEach(item => {
                        gridEl.appendChild(createCard(item, false));
                    });
                    grid.appendChild(gridEl);
                }
            } else if (activeTab === 'homeroom') {
                const getIsPrimary = role => {
                    if (!role) return true;
                    return role.includes('ป.');
                };

                const primaryGroup = items.filter(item => getIsPrimary(item.role_homeroom));
                const secondaryGroup = items.filter(item => !getIsPrimary(item.role_homeroom));

                const renderGroup = (titleTh, titleEn, groupItems) => {
                    if (groupItems.length === 0) return;

                    const groupHeader = document.createElement('div');
                    groupHeader.className = 'w-full text-left mt-6 mb-4 border-b border-slate-200 dark:border-slate-800 pb-2 col-span-full';
                    groupHeader.innerHTML = '<h3 class="text-sm sm:text-base font-bold text-slate-800 dark:text-slate-200">' + (isEn ? titleEn : titleTh) + '</h3>';
                    grid.appendChild(groupHeader);

                    const groupGrid = document.createElement('div');
                    groupGrid.className = 'grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-x-4 gap-y-7 w-full mb-8 col-span-full';
                    
                    groupItems.forEach(item => {
                        groupGrid.appendChild(createCard(item, false));
                    });
                    grid.appendChild(groupGrid);
                };

                renderGroup('ระดับประถมศึกษา (ป.1 - ป.6)', 'Primary Education (P.1 - P.6)', primaryGroup);
                renderGroup('ระดับมัธยมศึกษา (ม.1 - ม.6)', 'Secondary Education (M.1 - M.6)', secondaryGroup);
            } else {
                // Foreign Faculty & Specialist/Part-Time Faculty
                const gridEl = document.createElement('div');
                gridEl.className = 'grid ' + cols + ' gap-x-4 gap-y-7';
                items.forEach(item => {
                    gridEl.appendChild(createCard(item, false));
                });
                grid.appendChild(gridEl);
            }

            if (window.ep_editor_is_active && window.ep_editor_is_active()) {
                if (window.ep_editor_enable) window.ep_editor_enable();
            }
        }

        window.addEventListener('languageChanged', () => {
            updateTabDescription();
            renderTeachers();
        });
    </script>
</body>
</html>
