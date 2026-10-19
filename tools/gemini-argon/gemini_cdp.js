import fs from 'fs';
import path from 'path';

/**
 * Gemini 4 Argon Native CDP Bridge
 * Direct Chrome DevTools Protocol automation for Google Gemini Web
 */

const CDP_PORT = process.env.CDP_PORT || 9222;
const CDP_BASE = `http://127.0.0.1:${CDP_PORT}`;

// Helper: Parse CLI Arguments
function parseArgs() {
    const args = process.argv.slice(2);
    const options = {
        prompt: '',
        promptFile: null,
        out: null,
        newChat: false,
        model: 'argon', // default target
        screenshot: null,
        exec: null,
        extractCode: true,
        auditFile: null,
        timeoutSec: 180
    };

    for (let i = 0; i < args.length; i++) {
        const arg = args[i];
        if (arg === '--out' || arg === '-o') {
            options.out = args[++i];
        } else if (arg === '--file' || arg === '-f') {
            options.promptFile = args[++i];
        } else if (arg === '--audit' || arg === '-a') {
            options.auditFile = args[++i];
            options.extractCode = false; // default to full report for audit
        } else if (arg === '--new-chat' || arg === '-n') {
            options.newChat = true;
        } else if (arg === '--model' || arg === '-m') {
            options.model = args[++i];
        } else if (arg === '--screenshot' || arg === '-s') {
            options.screenshot = args[++i];
        } else if (arg === '--exec' || arg === '-e') {
            options.exec = args[++i];
        } else if (arg === '--raw') {
            options.extractCode = false;
        } else if (!arg.startsWith('-') && !options.prompt) {
            options.prompt = arg;
        }
    }

    // Handle --audit
    if (options.auditFile && fs.existsSync(options.auditFile)) {
        const codeContent = fs.readFileSync(options.auditFile, 'utf-8');
        const filename = path.basename(options.auditFile);
        const ext = path.extname(options.auditFile).replace('.', '') || 'text';
        
        const userCustomInstruction = options.prompt ? `\nข้อกำหนดเพิ่มเติมจากผู้ใช้: ${options.prompt}\n` : '';

        options.prompt = `คุณคือ Senior Web Developer และ Security Auditor ผู้เชี่ยวชาญ
กรุณาช่วยตรวจสอบโค้ดไฟล์: ${filename} ของเว็บไซต์ "โครงการจัดการเรียนการสอนตามหลักสูตรกระทรวงศึกษาธิการเป็นภาษาอังกฤษ (English Program : EP) โรงเรียนชลประทานวิทยา" อย่างละเอียด:
${userCustomInstruction}
เกณฑ์การตรวจสอบ:
1. ความถูกต้องและข้อผิดพลาด (Syntax, Logic Bugs, Broken Links, Undefined Variables)
2. ความปลอดภัย (Security: XSS, SQL Injection, CSRF, Data Sanitization)
3. ประสิทธิภาพและมาตรฐานเว็บ (Performance, SEO, Responsive Tailwind/CSS, Semantic HTML)
4. กฎเหล็กประจำโครงการ EP (Institutional Guardrails):
   ❌ ห้ามใช้คำว่า "ห้องเรียนพิเศษ" โดยเด็ดขาด (EP ไม่ใช่ห้องเรียนพิเศษ)
   ❌ ห้ามใช้คำว่า "แผนการเรียน" โดยเด็ดขาด (EP ไม่ใช่แผนการเรียน)
   ❌ ห้ามนำชื่อ/ภาพ/กิจกรรมของ "ECP" (English for Communication) มาใช้โดยเด็ดขาด
   ✅ ชื่อทางการ: โครงการฯ ภาคภาษาอังกฤษ (English Program : EP)

[โค้ดของไฟล์ ${filename}]:
\`\`\`${ext}
${codeContent}
\`\`\`

กรุณารายงานผลอย่างละเอียดเป็นภาษาไทย โดยแบ่งเป็นหัวข้อ:
1. ภาพรวมและคะแนนคุณภาพโค้ด
2. รายการจุดบกพร่อง / จุดเสี่ยงความปลอดภัย (เรียงตามความรุนแรง)
3. ผลการตรวจสอบตามกฎเหล็กของโครงการ EP
4. โค้ดส่วนที่แนะนำให้ปรับปรุงพร้อมคำอธิบาย`;
    } else if (options.promptFile && fs.existsSync(options.promptFile)) {
        options.prompt = fs.readFileSync(options.promptFile, 'utf-8');
    }

    return options;
}

// Helper: Connect to Chrome Target via native WebSocket
async function getGeminiTab() {
    try {
        const res = await fetch(`${CDP_BASE}/json/list`);
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const tabs = await res.json();
        
        let geminiTab = tabs.find(t => t.url && t.url.includes('gemini.google.com'));
        if (!geminiTab) {
            console.log('🌐 ไม่พบแท็บ Gemini กำลังสร้างแท็บใหม่ที่ https://gemini.google.com/app ...');
            const newTabRes = await fetch(`${CDP_BASE}/json/new?https://gemini.google.com/app`, { method: 'PUT' });
            geminiTab = await newTabRes.json();
            // รอให้โหลดหน้าเว็บสักครู่
            await new Promise(r => setTimeout(r, 4000));
        }
        return geminiTab;
    } catch (err) {
        console.error(`❌ ไม่สามารถเชื่อมต่อ Chrome ได้ที่พอร์ต ${CDP_PORT}: ${err.message}`);
        console.error('👉 โปรดตรวจสอบว่าได้เปิด Chrome ด้วยคำสั่ง:');
        console.error(`   & "C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe" --remote-debugging-port=9222 --user-data-dir="C:\\ChromeGeminiProfile"`);
        process.exit(1);
    }
}

class CDPClient {
    constructor(wsUrl) {
        this.wsUrl = wsUrl;
        this.id = 1;
        this.handlers = new Map();
    }

    async connect() {
        return new Promise((resolve, reject) => {
            this.ws = new WebSocket(this.wsUrl);
            this.ws.onopen = () => resolve();
            this.ws.onerror = (err) => reject(err);
            this.ws.onmessage = (event) => {
                const data = JSON.parse(event.data);
                if (data.id && this.handlers.has(data.id)) {
                    const { resolve, reject } = this.handlers.get(data.id);
                    this.handlers.delete(data.id);
                    if (data.error) reject(data.error);
                    else resolve(data.result);
                }
            };
        });
    }

    send(method, params = {}) {
        return new Promise((resolve, reject) => {
            const msgId = this.id++;
            this.handlers.set(msgId, { resolve, reject });
            this.ws.send(JSON.stringify({ id: msgId, method, params }));
        });
    }

    async evaluate(expression) {
        const res = await this.send('Runtime.evaluate', {
            expression,
            returnByValue: true,
            awaitPromise: true
        });
        if (res.exceptionDetails) {
            throw new Error(res.exceptionDetails.text || 'Runtime.evaluate exception');
        }
        return res.result ? res.result.value : null;
    }

    close() {
        if (this.ws) {
            this.ws.close();
        }
    }
}

async function main() {
    const opts = parseArgs();

    if (!opts.prompt) {
        console.log(`
🚀 Gemini 4 Argon Native CDP Bridge
การใช้งาน:
  node gemini_cdp.js "ข้อความ Prompt ที่ต้องการสั่ง" [ตัวเลือก]

ตัวเลือก:
  --out, -o <ไฟล์>        บันทึกผลลัพธ์ (หรือโค้ด) ลงไฟล์ปลายทางทันที
  --file, -f <ไฟล์>       อ่าน Prompt จากไฟล์
  --new-chat, -n         เริ่มการสนทนาใหม่ (New Chat) เพื่อไม่ให้บริบทเก่าปน
  --model, -m <ชื่อ>      ตรวจสอบหรือเปลี่ยนโมเดล (ค่าเริ่มต้น: argon)
  --screenshot, -s <ไฟล์> จับภาพหน้าจอคำตอบของ Gemini เซฟเป็นรูปภาพ
  --raw                  ไม่สกัดโค้ด แต่ให้บันทึกคำตอบทั้งหมดเป็นข้อความดิบ
  --exec, -e <คำสั่ง>     รันคำสั่ง Terminal ตรวจสอบหลังได้ไฟล์ เช่น "php -l output.php"

ตัวอย่าง:
  node gemini_cdp.js "เขียนฟังก์ชัน PHP เชื่อมต่อ MySQL" --out db.php
  node gemini_cdp.js -f prompt.txt -o result.js -n
`);
        return;
    }

    console.log(`⚡ [Gemini CDP Bridge] กำลังค้นหาเซสชัน Chrome พอร์ต ${CDP_PORT}...`);
    const tab = await getGeminiTab();
    console.log(`🔗 เชื่อมต่อแท็บ: "${tab.title}" (${tab.id})`);

    const client = new CDPClient(tab.webSocketDebuggerUrl);
    await client.connect();

    try {
        // นำแท็บมาไว้ข้างหน้า
        await client.send('Page.bringToFront');

        // เริ่มแชตใหม่ถ้าเลือก --new-chat
        if (opts.newChat) {
            console.log('🔄 กำลังเปิดแชตใหม่ (New Chat)...');
            await client.evaluate(`(() => {
                const btn = document.querySelector('[data-test-id="new-chat-button"] button, [data-test-id="new-chat-button"]');
                if (btn) btn.click();
            })()`);
            await new Promise(r => setTimeout(r, 1200));
        }

        // ตรวจสอบและเลือกโหมด Argon
        const currentMode = await client.evaluate(`(() => {
            const btn = document.querySelector('[data-test-id="bard-mode-menu-button"]');
            return btn ? btn.innerText.trim() : null;
        })()`);

        if (currentMode) {
            console.log(`🧠 โหมดปัจจุบันของ Gemini: "${currentMode}"`);
            if (opts.model.toLowerCase().includes('argon') && !currentMode.includes('อาร์กอน') && !currentMode.includes('Argon')) {
                console.log('🔀 กำลังสลับไปใช้โมเดล "4 Argon"...');
                await client.evaluate(`(() => {
                    const btn = document.querySelector('[data-test-id="bard-mode-menu-button"]');
                    if (btn) btn.click();
                })()`);
                await new Promise(r => setTimeout(r, 600));

                await client.evaluate(`(() => {
                    const items = Array.from(document.querySelectorAll('[role="menuitem"], [role="option"], mat-option, .mat-mdc-menu-item'));
                    const argonItem = items.find(i => i.innerText.includes('Argon') || i.innerText.includes('อาร์กอน'));
                    if (argonItem) argonItem.click();
                })()`);
                await new Promise(r => setTimeout(r, 1000));
            }
        }

        // โฟกัสกล่องข้อความและป้อน Prompt
        console.log(`📝 กำลังป้อน Prompt เข้าสู่ระบบ (${opts.prompt.length} ตัวอักษร)...`);
        await client.evaluate(`(() => {
            const editor = document.querySelector('rich-textarea div.ql-editor');
            if (editor) {
                editor.focus();
                // เคลียร์ข้อความเก่า
                document.execCommand('selectAll', false, null);
                document.execCommand('delete', false, null);
            }
        })()`);

        if (opts.prompt.length > 300) {
            // ใช้ ClipboardEvent จำลองการ Paste เพื่อความเร็วระดับ millisecond กับข้อความยาวๆ
            await client.evaluate(`((text) => {
                const editor = document.querySelector('rich-textarea div.ql-editor');
                if (editor) {
                    editor.focus();
                    const dt = new DataTransfer();
                    dt.setData('text/plain', text);
                    const pasteEvent = new ClipboardEvent('paste', {
                        clipboardData: dt,
                        bubbles: true,
                        cancelable: true
                    });
                    editor.dispatchEvent(pasteEvent);
                }
            })(${JSON.stringify(opts.prompt)})`);
        } else {
            // ข้อความสั้นใช้ Input.insertText
            await client.send('Input.insertText', { text: opts.prompt });
        }
        await new Promise(r => setTimeout(r, 600));

        // ส่งข้อความ
        console.log('🚀 กำลังกดส่งข้อความ (Send)...');
        const sendResult = await client.evaluate(`(() => {
            const sendBtn = document.querySelector('button[aria-label*="ส่งข้อความ"], button[aria-label*="Send"]');
            if (sendBtn) {
                sendBtn.click();
                return { success: true };
            }
            return { success: false };
        })()`);

        if (!sendResult || !sendResult.success) {
            // ถ้าไม่เจอปุ่มส่ง ให้ลองกดปุ่ม Enter
            await client.send('Input.dispatchKeyEvent', { type: 'rawKeyDown', windowsVirtualKeyCode: 13 });
            await client.send('Input.dispatchKeyEvent', { type: 'keyUp', windowsVirtualKeyCode: 13 });
        }

        console.log('⏳ กำลังรอ Gemini 4 Argon วิเคราะห์และประมวลผลคำตอบ...');

        // รอจนคำตอบสร้างเสร็จ
        const startTime = Date.now();
        let isDone = false;
        let responseData = null;

        // รอให้เริ่มเจนเนอเรตก่อนอย่างน้อย 1.5 วินาที
        await new Promise(r => setTimeout(r, 1500));

        while (!isDone) {
            if ((Date.now() - startTime) > (opts.timeoutSec * 1000)) {
                throw new Error(`Timeout: รอการประมวลผลเกิน ${opts.timeoutSec} วินาที`);
            }

            await new Promise(r => setTimeout(r, 1000));

            const status = await client.evaluate(`(() => {
                const stopBtn = document.querySelector('button[aria-label*="หยุด"], button[aria-label*="Stop"]');
                const responses = document.querySelectorAll('message-content, .model-response-text');
                const lastResponse = responses.length ? responses[responses.length - 1] : null;

                if (!lastResponse) return { isGenerating: true, hasResponse: false };

                const codeBlocks = Array.from(lastResponse.querySelectorAll('pre code')).map(c => c.innerText);
                return {
                    isGenerating: !!stopBtn,
                    hasResponse: true,
                    fullText: lastResponse.innerText.trim(),
                    codeBlocks: codeBlocks
                };
            })()`);

            if (status && !status.isGenerating && status.hasResponse && status.fullText.length > 0) {
                isDone = true;
                responseData = status;
            } else {
                process.stdout.write('.');
            }
        }

        console.log('\n✨ Gemini 4 Argon ตอบกลับเรียบร้อยแล้ว!');

        // ถ่ายภาพหน้าจอถ้าต้องการหลักฐาน
        if (opts.screenshot) {
            console.log(`📸 กำลังแคปจอหลักฐานส่งออกไปที่: ${opts.screenshot}`);
            const screenshotRes = await client.send('Page.captureScreenshot', { format: 'png' });
            fs.writeFileSync(opts.screenshot, Buffer.from(screenshotRes.data, 'base64'));
        }

        // จัดการผลลัพธ์
        let outputContent = responseData.fullText;
        if (opts.extractCode && responseData.codeBlocks && responseData.codeBlocks.length > 0) {
            console.log(`📦 ตรวจพบโค้ดบล็อกจำนวน ${responseData.codeBlocks.length} ส่วน สกัดออกมาให้เรียบร้อย`);
            outputContent = responseData.codeBlocks.join('\n\n');
        }

        if (opts.out) {
            const outPath = path.resolve(opts.out);
            fs.mkdirSync(path.dirname(outPath), { recursive: true });
            fs.writeFileSync(outPath, outputContent, 'utf-8');
            console.log(`💾 เซฟผลลัพธ์ลงไฟล์เรียบร้อย: ${outPath}`);

            // รัน Terminal ตรวจสอบถ้ามีคำสั่ง --exec
            if (opts.exec) {
                console.log(`⚙️ กำลังรันคำสั่งตรวจสอบ: ${opts.exec}`);
                const { execSync } = await import('child_process');
                try {
                    const execOut = execSync(opts.exec, { encoding: 'utf-8' });
                    console.log(`[ผลการรันคำสั่ง]\n${execOut}`);
                } catch (e) {
                    console.error(`[ข้อผิดพลาดจากการรัน]\n${e.stdout || e.message}`);
                }
            }
        } else {
            console.log('\n--- [คำตอบจาก Gemini 4 Argon] ---');
            console.log(outputContent);
            console.log('--------------------------------\n');
        }

    } catch (err) {
        console.error('❌ เกิดข้อผิดพลาด:', err.message);
    } finally {
        client.close();
    }
}

main();
