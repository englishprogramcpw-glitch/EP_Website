/**
 * editor.js - ไคลเอนต์ระบบ Visual In-Place Editor (โหมดแก้ไขสไตล์ Photoshop)
 * ponytail: ใช้ฟีเจอร์ contenteditable ดั้งเดิม และ window.prompt() แทน UI ซับซ้อน
 */
(function() {
    // ฟังก์ชันตรวจสอบสิทธิ์แอดมินอย่างเคร่งครัด
    function hasAdminAuth() {
        try {
            const user = JSON.parse(localStorage.getItem('ep_mock_user') || '{}');
            const sessionAuth = sessionStorage.getItem('ep_admin_logged_in') === 'true';
            // ในโหมด Static Preview ต้องมีทั้ง role admin และสถานะล็อกอินใน sessionStorage
            if (window.location.protocol === 'file:' || window.location.pathname.endsWith('.html')) {
                return user.role === 'admin' && sessionAuth;
            }
            return user.role === 'admin';
        } catch(e) {
            return false;
        }
    }

    if (!hasAdminAuth()) {
        const existingBar = document.getElementById('ep-editor-bar');
        if (existingBar) existingBar.remove();
        document.body.classList.remove('ep-editor-active');
        return;
    }

    // ตรวจจับการออกจากระบบจากแท็บอื่นหรือสคริปต์อื่นเพื่อทำลายแถบทันที
    window.addEventListener('storage', () => {
        if (!hasAdminAuth()) {
            const bar = document.getElementById('ep-editor-bar');
            if (bar) bar.remove();
            document.body.classList.remove('ep-editor-active');
            editMode = false;
        }
    });

    let editMode = false;
    let originalValues = {};
    let changes = {};

    // เพิ่ม editor.css เข้าในหน้าเว็บโดยอัตโนมัติ
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = 'css/editor.css';
    document.head.appendChild(link);

    window.addEventListener('DOMContentLoaded', () => {
        createEditorToolbar();
    });

    // สร้างแถบควบคุมลอยตัวด้านล่าง
    function createEditorToolbar() {
        const bar = document.createElement('div');
        bar.id = 'ep-editor-bar';
        bar.innerHTML = `
            <span style="color: #3b82f6; font-size: 16px;">🎨</span>
            <span>ระบบแก้ไขหน้าเว็บสด:</span>
            <button id="ep-btn-toggle" style="background-color: #3b82f6; color: white; padding: 4px 12px; border-radius: 9999px; border: none; font-size: 11px;">เปิดโหมดแก้ไข (OFF)</button>
            <button id="ep-btn-save" style="background-color: #10b981; color: white; padding: 4px 12px; border-radius: 9999px; border: none; font-size: 11px; display: none;">💾 บันทึกการแก้ไข</button>
        `;
        document.body.appendChild(bar);

        document.getElementById('ep-btn-toggle').addEventListener('click', toggleEditMode);
        document.getElementById('ep-btn-save').addEventListener('click', saveChanges);
    }

    // สลับโหมดแก้ไข
    function toggleEditMode() {
        editMode = !editMode;
        document.body.classList.toggle('ep-editor-active', editMode);

        const toggleBtn = document.getElementById('ep-btn-toggle');
        const saveBtn = document.getElementById('ep-btn-save');

        if (editMode) {
            toggleBtn.innerText = 'ปิดโหมดแก้ไข (ON)';
            toggleBtn.style.backgroundColor = '#ef4444';
            saveBtn.style.display = 'inline-block';
            enableEditing();
        } else {
            toggleBtn.innerText = 'เปิดโหมดแก้ไข (OFF)';
            toggleBtn.style.backgroundColor = '#3b82f6';
            saveBtn.style.display = 'none';
            disableEditing();
        }
    }

    // เปิดใช้งานตัวแก้ไขบนหน้าเว็บ
    function enableEditing() {
        const editables = document.querySelectorAll('[data-edit-id]');
        
        editables.forEach(el => {
            const id = el.getAttribute('data-edit-id');
            const isImg = el.tagName === 'IMG';
            const isBg = el.style.backgroundImage && el.style.backgroundImage.includes('url');

            // บันทึกค่าดั้งเดิมไว้กรณีต้องการยกเลิก
            if (!originalValues[id]) {
                originalValues[id] = isImg ? el.src : (isBg ? extractBgUrl(el) : el.innerHTML);
            }

            // แทรก badge แสดงประเภทเครื่องมือ
            let badge = el.querySelector('.ep-editor-badge');
            if (!badge) {
                badge = document.createElement('span');
                badge.className = 'ep-editor-badge';
                badge.innerText = isImg || isBg ? '🖼️ แก้ไขรูปภาพ' : '✏️ แก้ไขข้อความ';
                el.appendChild(badge);
            }

            if (isImg || isBg) {
                // ผูกอีเวนต์คลิกเพื่อเปิดกล่องใส่ลิงก์รูปภาพ
                el.onclick = (e) => {
                    if (!editMode) return;
                    e.preventDefault();
                    e.stopPropagation();

                    const currentUrl = isImg ? el.src : extractBgUrl(el);
                    const newUrl = window.prompt('🖼️ วางลิงก์รูปภาพใหม่ที่ต้องการเปลี่ยนที่นี่:', currentUrl);
                    
                    if (newUrl !== null && newUrl !== currentUrl) {
                        if (isImg) el.src = newUrl;
                        else el.style.backgroundImage = `url('${newUrl}')`;
                        
                        changes[id] = newUrl;
                        updateSaveButtonBadge();
                    }
                };
            } else {
                // เปิดโหมดพิมพ์แก้ไขข้อความสด
                el.contentEditable = 'true';
                
                // ดักจับการแก้ไข
                el.oninput = () => {
                    // ลบปุ่ม badge ออกชั่วคราวก่อนเพื่อไม่ให้เก็บเข้าไปในเนื้อหาที่บันทึก
                    const cleanHtml = el.innerHTML.replace(/<span class="ep-editor-badge"[\s\S]*?<\/span>/g, '').trim();
                    changes[id] = cleanHtml;
                    updateSaveButtonBadge();
                };
            }
        });
    }

    // ปิดโหมดแก้ไข
    function disableEditing() {
        const editables = document.querySelectorAll('[data-edit-id]');
        editables.forEach(el => {
            el.contentEditable = 'false';
            el.onclick = null;
            el.oninput = null;
            const badge = el.querySelector('.ep-editor-badge');
            if (badge) badge.remove();
        });
    }

    // อัปเดตแสดงจำนวนจุดที่แก้ไขแล้วบนปุ่มเซฟ
    function updateSaveButtonBadge() {
        const count = Object.keys(changes).length;
        const saveBtn = document.getElementById('ep-btn-save');
        if (count > 0) {
            saveBtn.innerText = `💾 บันทึกการแก้ไข (${count} จุดที่เปลี่ยน)`;
            saveBtn.style.backgroundColor = '#10b981';
        } else {
            saveBtn.innerText = `💾 บันทึกการแก้ไข`;
            saveBtn.style.backgroundColor = '#6b7280';
        }
    }

    // แยกเอาเฉพาะลิงก์ภาพจาก background-image: url(...)
    function extractBgUrl(el) {
        const bg = el.style.backgroundImage;
        return bg.replace(/url\(['"]?([^'"]*)['"]?\)/, '$1').trim();
    }

    // ส่งข้อมูลบันทึกลงเซิร์ฟเวอร์
    function saveChanges() {
        if (Object.keys(changes).length === 0) {
            alert('ไม่มีข้อมูลใดๆ ที่ได้รับการเปลี่ยนแปลง');
            return;
        }

        // ค้นหาชื่อไฟล์ปัจจุบันใน path
        let currentPageFile = window.location.pathname.split('/').pop() || 'index.php';
        if (currentPageFile.endsWith('.html')) {
            currentPageFile = currentPageFile.replace('.html', '.php');
        }

        if (confirm(`💾 ยืนยันการเซฟและเขียนทับข้อมูลลงในไฟล์ ${currentPageFile} ใช่หรือไม่?`)) {
            // ดักแกะเศษซากคลาสตัวเขียนออกก่อนส่งบันทึก
            const cleanChanges = {};
            for (let k in changes) {
                cleanChanges[k] = changes[k].replace(/<span class="ep-editor-badge"[\s\S]*?<\/span>/g, '').trim();
            }

            fetch('save_inline.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    file: currentPageFile,
                    edits: cleanChanges
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('✅ บันทึกและคอมไพล์เว็บไซต์เสร็จสมบูรณ์!');
                    changes = {};
                    location.reload();
                } else {
                    alert('❌ เกิดข้อผิดพลาด: ' + data.message);
                }
            })
            .catch(err => {
                console.error(err);
                
                // Fallback สำหรับการรันแบบ Static Preview (file:///)
                let hasStaffEdits = false;
                let localStaff = localStorage.getItem('cpw_db_staff');
                let staffArray = [];
                if (localStaff) {
                    try { staffArray = JSON.parse(localStaff); } catch(e) {}
                }
                if (!staffArray || staffArray.length === 0) {
                    if (typeof TEACHERS_DATA !== 'undefined') {
                        staffArray = JSON.parse(JSON.stringify(TEACHERS_DATA));
                    }
                }

                for (let k in cleanChanges) {
                    if (k.startsWith('staff_')) {
                        const parts = k.split('_');
                        const idx = parseInt(parts[1], 10);
                        const field = parts.slice(2).join('_');
                        if (staffArray && staffArray[idx]) {
                            let val = cleanChanges[k];
                            if (field !== 'imageUrl') {
                                val = val.replace(/<[^>]*>/g, '').trim();
                            }
                            staffArray[idx][field] = val;
                            hasStaffEdits = true;
                        }
                    }
                }

                if (hasStaffEdits) {
                    localStorage.setItem('cpw_db_staff', JSON.stringify(staffArray));
                    alert('✅ บันทึกข้อมูลบุคลากรลงเบราว์เซอร์ชั่วคราวสำเร็จ (โหมด Preview)!');
                    changes = {};
                    location.reload();
                } else {
                    alert('🔒 เกิดข้อผิดพลาดขณะบันทึกข้อมูล (เซิร์ฟเวอร์จำลองไม่รองรับการเขียนไฟล์จากหน้าเบราว์เซอร์ตรงๆ ให้รันบน PHP Local Server)');
                }
            });
        }
    }

    // Expose control functions globally for dynamic content re-rendering
    window.ep_editor_is_active = () => editMode;
    window.ep_editor_enable = enableEditing;
    window.ep_editor_disable = disableEditing;
})();
