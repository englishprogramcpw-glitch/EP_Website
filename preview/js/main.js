/**
 * =========================================================================
 * main.js - ระบบการทำงานส่วนกลางสำหรับเว็บหลักสูตรภาษาอังกฤษ (EP) CPW
 * =========================================================================
 * - รองรับระบบสลับภาษา (Bilingual TH/EN)
 * - กำหนดจุดเชื่อมต่อ API ฐานข้อมูลกลางของโรงเรียน (Central API Configuration)
 * - จำลองระบบฐานข้อมูลฝั่งไคลเอนต์ (LocalStorage Database) สำหรับใช้งานร่วมกับหน้าหลังบ้าน
 */

// --- 1. จุดเชื่อมต่อฐานข้อมูลกลางของโรงเรียน (API Configuration) ---
// เมื่อต้องการเชื่อมต่อฐานข้อมูลจริงของโรงเรียน ให้คุณครูหรือฝ่าย IT เปลี่ยน URL เหล่านี้เป็น API จริงของโรงเรียนได้เลยครับ
const CPW_API_CONFIG = {
    USE_REAL_API: false, // เปลี่ยนเป็น true เพื่อดึงข้อมูลจริงผ่าน HTTP Fetch
    ENDPOINTS: {
        NEWS: "https://api.cpw.ac.th/ep/news",          // API ดึงข่าวสารและดึงภาพจากอัลบั้มกลาง
        STAFF: "https://api.cpw.ac.th/ep/staff",        // API ดึงข้อมูลครูและวิชาที่สอน
        AUTH_LOGIN: "https://api.cpw.ac.th/auth/login"  // API สำหรับการเข้าสู่ระบบของโรงเรียน
    }
};

// กำหนดสถานะ Light Mode เป็นค่ามาตรฐาน
(function initTheme() {
    localStorage.removeItem('theme');
    document.documentElement.classList.remove('dark');
})();

// เรียกใช้งานเมื่อโครงสร้างหน้าเว็บ (DOM) โหลดเสร็จเรียบร้อย
window.addEventListener('DOMContentLoaded', () => {
    updateLoginState();
    updateLanguageUI();

    // จัดการการปิด Login Modal เมื่อคลิกนอกกรอบเนื้อหา
    const loginModal = document.getElementById('loginModal');
    if (loginModal) {
        loginModal.onclick = function(e) {
            if (e.target === this) {
                closeLoginModal();
            }
        };
    }
});

// --- 2. ระบบสลับภาษา (Bilingual Switcher) ---
function toggleLanguage() {
    const currentLang = localStorage.getItem('ep_lang') || 'th';
    const newLang = currentLang === 'th' ? 'en' : 'th';
    localStorage.setItem('ep_lang', newLang);
    updateLanguageUI();
}

function updateLanguageUI() {
    const currentLang = localStorage.getItem('ep_lang') || 'th';
    const isEn = currentLang === 'en';
    
    // Ponytail: toggle 'hidden' class natively on language elements
    document.querySelectorAll('.lang-th').forEach(el => el.classList.toggle('hidden', isEn));
    document.querySelectorAll('.lang-en').forEach(el => el.classList.toggle('hidden', !isEn));

    // อัปเดตปุ่มสวิตช์แสดงข้อความภาษาตรงข้าม
    document.querySelectorAll('#langSwitcherBtn').forEach(btn => {
        btn.innerText = isEn ? 'TH' : 'EN';
    });

    // แจ้งเตือนหน้าเว็บให้วาดส่วนเนื้อหาแบบไดนามิกใหม่เมื่อเปลี่ยนภาษา
    window.dispatchEvent(new Event('languageChanged'));
}

// --- 3. ปุ่มเมนูสไลด์บนมือถือ ---
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    if (menu) {
        menu.classList.toggle('hidden');
    }
}

// --- 5. การจำลองระบบล็อกอินและการเชื่อมต่อระบบหลังบ้าน (Mock Login & Auth) ---
function openLoginModal() {
    const modal = document.getElementById('loginModal');
    const backdrop = document.getElementById('loginModalBackdrop');
    const card = document.getElementById('loginModalCard');
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
}

function closeLoginModal() {
    const modal = document.getElementById('loginModal');
    const backdrop = document.getElementById('loginModalBackdrop');
    const card = document.getElementById('loginModalCard');
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

function executeLogin(usr, pass) {
    const isEn = (localStorage.getItem('ep_lang') || 'th') === 'en';
    if (CPW_API_CONFIG.USE_REAL_API) {
        fetch(CPW_API_CONFIG.ENDPOINTS.AUTH_LOGIN, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username: usr, password: pass })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                saveLoginSession(usr, data.displayName, data.role, data.displayNameEn);
            } else {
                alert(isEn ? "❌ Login failed: " + data.message : "❌ การเข้าสู่ระบบล้มเหลว: " + data.message);
            }
        })
        .catch(err => {
            console.error("API Error:", err);
            alert(isEn 
                ? "⚠️ Error connecting to school database (running simulation instead)"
                : "⚠️ เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูลโรงเรียน (กำลังรันโหมดจำลองแทน)");
            simulateLogin(usr, pass);
        });
    } else {
        simulateLogin(usr, pass);
    }
}

function simulateLogin(usr, pass) {
    const isEn = (localStorage.getItem('ep_lang') || 'th') === 'en';
    if (usr === '20038' && pass === '310735') {
        localStorage.setItem('ep_mock_user', JSON.stringify({
            username: usr,
            name: "คุณครูรหัส 20038",
            name_en: "Teacher ID 20038",
            role: "admin"
        }));
        closeLoginModal();
        alert(isEn 
            ? "🎉 CPW Staff Login Successful!\nNavigating to the Central Information System..."
            : "🎉 เข้าสู่ระบบบุคลากร CPW สำเร็จ!\nกำลังพาท่านไปยังระบบสารสนเทศกลาง...");
        updateLoginState();
        
        // เปิดหน้าเว็บส่วนตัวของโรงเรียนในแท็บใหม่
        window.open("https://center.cpw.ac.th/cpw_personal/index.php", "_blank");
        
        // เปลี่ยนหน้าเว็บ EP นี้ไปยังระบบหลังบ้านเพื่อใช้จัดการแก้ไขข้อมูล
        const targetPage = window.location.pathname.includes('preview/') ? 'admin.html' : 'admin.html';
        window.location.href = targetPage;
        return;
    }

    if (pass === '1234') {
        let displayName = "คุณครู EP";
        let displayNameEn = "EP Teacher";
        let role = "teacher";
        if (usr === 'student') {
            displayName = "นักเรียน EP";
            displayNameEn = "EP Student";
            role = "student";
        }
        if (usr === 'admin') {
            displayName = "ผู้ดูแลระบบ EP";
            displayNameEn = "EP Administrator";
            role = "admin";
        }
        saveLoginSession(usr, displayName, role, displayNameEn);
    } else {
        alert(isEn 
            ? "❌ Incorrect username or password!\n(Please use staff ID 20038 / 310735 or demo credentials admin / 1234)"
            : "❌ ข้อมูลผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!\n(กรุณาใช้รหัสบุคลากร 20038 / 310735 หรือ รหัสจำลอง admin / 1234)");
    }
}

function saveLoginSession(usr, displayName, role, displayNameEn) {
    const nameEn = displayNameEn || displayName;
    localStorage.setItem('ep_mock_user', JSON.stringify({
        username: usr,
        name: displayName,
        name_en: nameEn,
        role: role
    }));

    // ซิงค์เซสชันไปยัง PHP เซิร์ฟเวอร์หลังบ้าน
    fetch('sync_session.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            action: 'login',
            user: { username: usr, name: displayName, role: role }
        })
    })
    .then(() => {
        closeLoginModal();
        const isEn = (localStorage.getItem('ep_lang') || 'th') === 'en';
        alert(isEn 
            ? `🎉 Login Successful!\nWelcome: ${nameEn}`
            : `🎉 เข้าสู่ระบบสำเร็จ!\nยินดีต้อนรับ: ${displayName}`);
        updateLoginState();

        // หากเป็นแอดมิน ให้เปิดหน้าหลังบ้านอัตโนมัติ
        if (role === 'admin') {
            window.location.href = "admin.html";
        }
    })
    .catch(err => console.error('Failed to sync login session:', err));
}

function handleLogout() {
    localStorage.removeItem('ep_mock_user');
    
    // ล้างเซสชันฝั่ง PHP เซิร์ฟเวอร์หลังบ้าน
    fetch('sync_session.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'logout' })
    })
    .then(() => {
        const isEn = (localStorage.getItem('ep_lang') || 'th') === 'en';
        alert(isEn ? "👋 Logged out successfully" : "👋 ออกจากระบบเรียบร้อยแล้ว");
        updateLoginState();
        // ถ้าอยู่หน้า Admin ให้เด้งกลับหน้าแรก
        if (window.location.pathname.includes('admin.html') || window.location.pathname.includes('admin.html')) {
            window.location.href = window.location.pathname.includes('preview/') ? 'index.html' : 'index.html';
        }
    })
    .catch(err => console.error('Failed to sync logout session:', err));
}


function updateLoginState() {
    const userStr = localStorage.getItem('ep_mock_user');
    const desktopNav = document.getElementById('loginNavContainer');
    const mobileNav = document.getElementById('loginNavContainerMobile');

    if (userStr) {
        const user = JSON.parse(userStr);
        const adminBtnHtml = user.role === 'admin' 
            ? `<a href="admin.html" class="text-xs px-2.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition font-bold flex items-center gap-1 shadow-sm"><span class="lang-th">⚙️ หลังบ้าน</span><span class="lang-en hidden">⚙️ Admin</span></a>`
            : '';

        if (desktopNav) {
            desktopNav.innerHTML = `
                <div class="flex items-center gap-2">
                    ${adminBtnHtml}
                    <button onclick="handleLogout()" class="text-xs font-bold px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-650 rounded-lg transition dark:bg-red-950/40 dark:text-red-400 font-sans border border-red-200 dark:border-slate-800">
                        <span class="lang-th">ออกจากระบบ</span>
                        <span class="lang-en hidden">Logout</span>
                    </button>
                </div>
            `;
        }
        if (mobileNav) {
            mobileNav.innerHTML = `
                <div class="space-y-2 pt-2">
                    <div class="text-xs font-bold text-slate-500 dark:text-slate-400 text-center">
                        <span class="lang-th">👤 ${user.name}</span>
                        <span class="lang-en hidden">👤 ${user.name_en || user.name}</span>
                    </div>
                    <div class="flex gap-2">
                        ${user.role === 'admin' ? `<a href="admin.html" class="flex-1 text-center text-xs font-bold py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition"><span class="lang-th">⚙️ หลังบ้าน</span><span class="lang-en hidden">⚙️ Admin</span></a>` : ''}
                        <button onclick="handleLogout()" class="flex-1 text-center text-xs font-bold py-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition dark:bg-red-950/40 dark:text-red-400">
                            <span class="lang-th">ออกจากระบบ</span>
                            <span class="lang-en hidden">Logout</span>
                        </button>
                    </div>
                </div>
            `;
        }
    } else {
        if (desktopNav) {
            desktopNav.innerHTML = `
                <button onclick="openLoginModal()" class="text-sm font-semibold px-4 py-2 bg-brand-500 hover:bg-brand-600 text-white rounded-lg transition duration-200 font-sans">
                    <span class="lang-th">เข้าสู่ระบบ</span>
                    <span class="lang-en hidden">Login</span>
                </button>
            `;
        }
        if (mobileNav) {
            mobileNav.innerHTML = `
                <button onclick="openLoginModal(); toggleMobileMenu();" class="w-full text-center text-sm font-semibold py-2 bg-brand-500 hover:bg-brand-600 text-white rounded-lg transition font-sans">
                    <span class="lang-th">เข้าสู่ระบบ</span>
                    <span class="lang-en hidden">Login</span>
                </button>
            `;
        }
    }
    updateLanguageUI();
}

// --- 6. ฟังก์ชันจัดการฐานข้อมูลแบบไฟล์เดี่ยว (Flat-File JSON Database Manager) ---
function getDbNews(callback) {
    if (CPW_API_CONFIG.USE_REAL_API) {
        fetch(CPW_API_CONFIG.ENDPOINTS.NEWS)
            .then(res => res.json())
            .then(data => callback(data))
            .catch(err => {
                console.error(err);
                loadLocalOrFallbackNews(callback);
            });
    } else {
        // ดึงจากไฟล์ db_news.json บนเซิร์ฟเวอร์ก่อน
        fetch('data/db_news.json?v=' + Date.now())
            .then(res => {
                if (!res.ok) throw new Error("File not found on server");
                return res.json();
            })
            .then(data => {
                // บันทึกความจำลง localStorage สำรองไว้ด้วย
                localStorage.setItem('cpw_db_news', JSON.stringify(data));
                callback(data);
            })
            .catch(err => {
                // หากดึงไฟล์บนเซิร์ฟเวอร์ไม่สำเร็จ (เช่น รันพรีวิวเครื่องตัวเอง หรือไม่มีไฟล์) ให้ใช้สำรอง
                loadLocalOrFallbackNews(callback);
            });
    }
}

function loadLocalOrFallbackNews(callback) {
    const local = localStorage.getItem('cpw_db_news');
    if (local) {
        callback(JSON.parse(local));
        return;
    }
    // โหลด fallback จากไฟล์ news.js
    if (typeof ANNOUNCEMENTS_DATA !== 'undefined') {
        localStorage.setItem('cpw_db_news', JSON.stringify(ANNOUNCEMENTS_DATA));
        callback(ANNOUNCEMENTS_DATA);
    } else {
        callback([]);
    }
}

function saveDbNews(newsArray) {
    // 1. บันทึกสำรองในเบราว์เซอร์ LocalStorage
    localStorage.setItem('cpw_db_news', JSON.stringify(newsArray));
    
    // 2. บันทึกถาวรลงไฟล์เซิร์ฟเวอร์โดยเขียนผ่าน PHP (จะเวิร์คทันทีเมื่อรันบน Server จริง)
    fetch('save_data.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ type: 'news', data: newsArray })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            console.log("💾 บันทึกข้อมูลข่าวสารลงไฟล์ db_news.json บนเซิร์ฟเวอร์สำเร็จ!");
        } else {
            console.warn("⚠️ เซิร์ฟเวอร์ไม่รองรับการเขียนไฟล์: " + res.message);
        }
    })
    .catch(err => {
        console.warn("🔒 การบันทึกบนเซิร์ฟเวอร์จำลองขัดข้อง (ใช้งานบน Local preview ในเครื่องจะจำลองเก็บในเบราว์เซอร์แทน):", err);
    });
}

function getDbSlides(callback) {
    fetch('data/db_slides.json?v=' + Date.now())
        .then(res => {
            if (!res.ok) throw new Error("File not found on server");
            return res.json();
        })
        .then(data => {
            localStorage.setItem('cpw_db_slides_v2', JSON.stringify(data));
            callback(data);
        })
        .catch(err => {
            loadLocalOrFallbackSlides(callback);
        });
}

function loadLocalOrFallbackSlides(callback) {
    try {
        const old = localStorage.getItem('cpw_db_slides');
        if (old && (old.includes('cpw_api_content') || old.includes('admissions-2570'))) {
            localStorage.removeItem('cpw_db_slides');
            localStorage.removeItem('cpw_db_slides_v2');
        }
    } catch(e) {}
    const local = localStorage.getItem('cpw_db_slides_v2');
    if (local) {
        try {
            const parsed = JSON.parse(local);
            if (Array.isArray(parsed) && parsed.length > 0 && !JSON.stringify(parsed).includes('cpw_api_content')) {
                callback(parsed);
                return;
            }
        } catch(e) {}
    }
    const fallbackSlides = [
            {
                        "id": "ep-campus-tour",
                        "season": "tour",
                        "priority": 10,
                        "months": [
                                    8,
                                    9,
                                    10
                        ],
                        "imageUrl": "img/ep_cover_banner.jpg",
                        "badge": "🎉 กำลังเปิดลงทะเบียน: เยี่ยมชมโครงการ (Campus Tour 2026)",
                        "badge_en": "🎉 Registration Open: EP Campus Tour 2026",
                        "title": "ก้าวสู่อนาคตที่เหนือกว่า ด้วยการเรียนรู้สองภาษา",
                        "title_en": "Step into a Better Future with Bilingual Learning",
                        "description": "โครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ โรงเรียนชลประทานวิทยา มุ่งพัฒนาศักยภาพผู้เรียนสู่ระดับสากล",
                        "description_en": "Chonprathanwittaya School English Program fosters academic excellence and practical English skills to prepare students for global success.",
                        "btn1_text": "🚐 นัดหมายเยี่ยมชมโครงการ",
                        "btn1_text_en": "Book Campus Tour",
                        "btn1_link": "tour.php",
                        "btn2_text": "📖 ดูโครงสร้างหลักสูตร",
                        "btn2_text_en": "View Curriculum",
                        "btn2_link": "curriculum.php"
            },
            {
                        "id": "ep-admissions-open",
                        "season": "admissions",
                        "priority": 9,
                        "months": [
                                    10,
                                    11,
                                    12,
                                    1,
                                    2,
                                    3
                        ],
                        "imageUrl": "img/ep_openhouse_banner.jpg",
                        "badge": "📢 เปิดรับสมัครนักเรียนใหม่ ประจำปีการศึกษา 2570",
                        "badge_en": "📢 Admissions Open for Academic Year 2027",
                        "title": "เปิดรับสมัครนักเรียนใหม่ โครงการฯ ภาคภาษาอังกฤษ (EP)",
                        "title_en": "Admissions Open for English Program (EP)",
                        "description": "เปิดรับสมัครระดับชั้น ป.1, ม.1 และ ม.4 ประจำปีการศึกษา 2570 พร้อมระบบนัดหมายเข้าเยี่ยมชมอาคารเรียนล่วงหน้า",
                        "description_en": "Now accepting applications for Primary (G.1), Junior High (G.7), and Senior High (G.10) for Academic Year 2027 with personalized campus tours.",
                        "btn1_text": "📝 ระเบียบการ & สมัครเรียน",
                        "btn1_text_en": "Admissions & Process",
                        "btn1_link": "admission.php",
                        "btn2_text": "💰 ตรวจสอบค่าเล่าเรียน",
                        "btn2_text_en": "Check Tuition Fees",
                        "btn2_link": "fees.php"
            },
            {
                        "id": "ep-active-learning",
                        "season": "academic",
                        "priority": 8,
                        "months": [
                                    5,
                                    6,
                                    7,
                                    8,
                                    9,
                                    10,
                                    11,
                                    12,
                                    1,
                                    2
                        ],
                        "imageUrl": "img/ep_classroom_p1.jpg",
                        "badge": "🌟 บรรยากาศการเรียนรู้จริงกับครูเจ้าของภาษา",
                        "badge_en": "🌟 Authentic Learning with Native English Teachers",
                        "title": "การเรียนรู้ที่เปี่ยมด้วยความสุข กับครูเจ้าของภาษา (Native Speakers)",
                        "title_en": "Joyful Learning with Qualified Native English Speakers",
                        "description": "เรียนรู้อย่างเป็นธรรมชาติในห้องเรียนปรับอากาศพร้อมสื่อ Interactive Board ปลูกฝังทักษะภาษาตั้งแต่วัยประถมจนถึงมัธยมศึกษา",
                        "description_en": "Natural language acquisition in modern smart classrooms equipped with interactive boards, nurturing confidence from Primary through High School.",
                        "btn1_text": "📖 สำรวจหลักสูตร ป.1 - ม.6",
                        "btn1_text_en": "Explore Curriculum",
                        "btn1_link": "curriculum.php",
                        "btn2_text": "🏫 คณะครูและบุคลากร",
                        "btn2_text_en": "Teachers & Staff",
                        "btn2_link": "staff.php"
            },
            {
                        "id": "ep-english-camp",
                        "season": "camp",
                        "priority": 7,
                        "months": [
                                    6,
                                    7,
                                    8,
                                    9,
                                    10,
                                    11
                        ],
                        "imageUrl": "img/ep_camp_activity.jpg",
                        "badge": "⛺ ค่ายภาษาอังกฤษและกิจกรรมเสริมหลักสูตร (EP Camp)",
                        "badge_en": "⛺ English Program Camp & Experiential Learning",
                        "title": "เปิดโลกการเรียนรู้นอกห้องเรียน (EP English Camp & Field Trips)",
                        "title_en": "Experiential Learning: EP English Camp & Field Trips",
                        "description": "เสริมสร้างความกล้าแสดงออก ภาวะผู้นำ และมิตรภาพ ผ่านกิจกรรมค่ายภาษาอังกฤษและการทัศนศึกษาทั้งในและต่างประเทศ",
                        "description_en": "Fostering leadership, cross-cultural competence, and lasting friendships through immersive English camps and educational excursions.",
                        "btn1_text": "📰 ชมภาพกิจกรรมล่าสุด",
                        "btn1_text_en": "Latest Activities",
                        "btn1_link": "news.php",
                        "btn2_text": "🏆 ทำเนียบเกียรติยศนักเรียน",
                        "btn2_text_en": "Hall of Fame",
                        "btn2_link": "awards.php"
            }
];
    localStorage.setItem('cpw_db_slides_v2', JSON.stringify(fallbackSlides));
    callback(fallbackSlides);
    return;
}

function saveDbSlides(slidesArray) {
    localStorage.setItem('cpw_db_slides', JSON.stringify(slidesArray));
    fetch('save_data.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ type: 'slides', data: slidesArray })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            console.log("💾 บันทึกข้อมูลสไลด์ลงไฟล์ db_slides.json บนเซิร์ฟเวอร์สำเร็จ!");
        } else {
            console.warn("⚠️ เซิร์ฟเวอร์ไม่รองรับการเขียนไฟล์: " + res.message);
        }
    })
    .catch(err => {
        console.warn("🔒 การบันทึกสไลด์ขัดข้อง:", err);
    });
}

function getDbStaff(callback) {
    if (CPW_API_CONFIG.USE_REAL_API) {
        fetch(CPW_API_CONFIG.ENDPOINTS.STAFF)
            .then(res => res.json())
            .then(data => callback(data))
            .catch(err => {
                console.error(err);
                loadLocalOrFallbackStaff(callback);
            });
    } else {
        fetch('data/db_staff.json?v=' + Date.now())
            .then(res => {
                if (!res.ok) throw new Error("Staff file not found on server");
                return res.json();
            })
            .then(data => {
                localStorage.setItem('cpw_db_staff', JSON.stringify(data));
                callback(data);
            })
            .catch(err => {
                loadLocalOrFallbackStaff(callback);
            });
    }
}

function loadLocalOrFallbackStaff(callback) {
    const local = localStorage.getItem('cpw_db_staff');
    if (local) {
        callback(JSON.parse(local));
        return;
    }
    // โหลด fallback
    if (typeof TEACHERS_DATA !== 'undefined') {
        localStorage.setItem('cpw_db_staff', JSON.stringify(TEACHERS_DATA));
        callback(TEACHERS_DATA);
    } else {
        callback([]);
    }
}

function saveDbStaff(staffArray) {
    localStorage.setItem('cpw_db_staff', JSON.stringify(staffArray));
    fetch('save_data.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ type: 'staff', data: staffArray })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            console.log("💾 บันทึกข้อมูลบุคลากรลงไฟล์ db_staff.json สำเร็จ!");
        } else {
            console.warn("⚠️ เซิร์ฟเวอร์ไม่รองรับการเขียนไฟล์: " + res.message);
        }
    })
    .catch(err => {
        console.warn("🔒 การบันทึกบุคลากรขัดข้อง (ใช้สำรองใน localStorage แทน):", err);
    });
}

