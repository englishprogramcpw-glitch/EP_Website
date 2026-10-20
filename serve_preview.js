const http = require('http');
const fs = require('fs');
const path = require('path');
const os = require('os');
const { compile } = require('./compile.js');

const PORT = process.env.PORT || 8080;
const ROOT_DIR = __dirname;
const PREVIEW_DIR = path.join(__dirname, 'preview');

// 1. Initial build of preview files
console.log('📦 [EP Website] กำลังคอมไพล์พรีวิวเว็บไซต์ล่าสุด...');
try {
  compile(false);
} catch (e) {
  console.warn('⚠️ Compile warning:', e.message);
}

// 2. LiveReload Clients (SSE)
const sseClients = new Set();

function broadcastReload() {
  for (const client of sseClients) {
    try {
      client.write('data: reload\n\n');
    } catch (e) {
      sseClients.delete(client);
    }
  }
}

// 3. File Watcher with Debounce (Auto-compile on save)
let debounceTimer = null;
function handleFileChange(filename) {
  if (!filename) return;
  // Ignore git, preview directory, temp files
  if (filename.includes('preview') || filename.startsWith('.') || filename.endsWith('~') || filename.endsWith('.tmp')) {
    return;
  }
  // Only watch relevant extensions
  if (!/\.(php|json|css|js|png|jpg|jpeg|svg|webp)$/i.test(filename)) {
    return;
  }

  clearTimeout(debounceTimer);
  debounceTimer = setTimeout(() => {
    console.log(`🔄 [Auto-Sync] ตรวจพบการเปลี่ยนแปลงใน "${filename}" -> กำลังคอมไพล์พรีวิวใหม่...`);
    try {
      delete require.cache[require.resolve('./compile.js')];
      const { compile } = require('./compile.js');
      compile(true);
      console.log('✨ [Auto-Sync] คอมไพล์สำเร็จ! กำลังส่งสัญญาณอัปเดตหน้าจอเบราว์เซอร์...');
      broadcastReload();
    } catch (err) {
      console.error('❌ Auto-compile failed:', err.message);
    }
  }, 100);
}

try {
  // Watch root directory for PHP files and top-level assets
  fs.watch(ROOT_DIR, (event, filename) => handleFileChange(filename));

  // Watch data/ directory for json database changes
  const dataDir = path.join(ROOT_DIR, 'data');
  if (fs.existsSync(dataDir)) {
    fs.watch(dataDir, (event, filename) => handleFileChange('data/' + filename));
  }

  // Watch css/ directory
  const cssDir = path.join(ROOT_DIR, 'css');
  if (fs.existsSync(cssDir)) {
    fs.watch(cssDir, (event, filename) => handleFileChange('css/' + filename));
  }

  // Watch js/ directory
  const jsDir = path.join(ROOT_DIR, 'js');
  if (fs.existsSync(jsDir)) {
    fs.watch(jsDir, (event, filename) => handleFileChange('js/' + filename));
  }
} catch (watchErr) {
  console.warn('⚠️ File watcher notice:', watchErr.message);
}

// 4. MIME Types mapping
const MIME_TYPES = {
  '.html': 'text/html; charset=utf-8',
  '.css': 'text/css; charset=utf-8',
  '.js': 'application/javascript; charset=utf-8',
  '.json': 'application/json; charset=utf-8',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
  '.jpeg': 'image/jpeg',
  '.gif': 'image/gif',
  '.webp': 'image/webp',
  '.svg': 'image/svg+xml',
  '.ico': 'image/x-icon',
  '.pdf': 'application/pdf',
  '.woff': 'font/woff',
  '.woff2': 'font/woff2',
  '.ttf': 'font/ttf',
  '.txt': 'text/plain; charset=utf-8'
};

// 5. Resolve request to physical file & check on-demand freshness
function resolveFile(urlPath) {
  let cleanPath = decodeURIComponent(urlPath.split('?')[0].split('#')[0]);

  // Root mapping
  if (cleanPath === '/' || cleanPath === '') {
    cleanPath = '/index.html';
  }

  // Rewrite .php to .html if requested
  if (cleanPath.endsWith('.php')) {
    cleanPath = cleanPath.slice(0, -4) + '.html';
  }

  // Rewrite extensionless URL (e.g. /about -> /about.html)
  if (!path.extname(cleanPath)) {
    const candidateHtml = path.join(PREVIEW_DIR, cleanPath + '.html');
    if (fs.existsSync(candidateHtml)) {
      cleanPath = cleanPath + '.html';
    }
  }

  // On-demand freshness check: if source PHP is newer than preview HTML, recompile!
  if (cleanPath.endsWith('.html')) {
    const baseName = path.basename(cleanPath, '.html');
    const sourcePhp = path.join(ROOT_DIR, baseName + '.php');
    const targetHtml = path.join(PREVIEW_DIR, cleanPath);

    if (fs.existsSync(sourcePhp) && fs.existsSync(targetHtml)) {
      try {
        const phpMtime = fs.statSync(sourcePhp).mtimeMs;
        const htmlMtime = fs.statSync(targetHtml).mtimeMs;
        if (phpMtime > htmlMtime) {
          delete require.cache[require.resolve('./compile.js')];
          const { compile } = require('./compile.js');
          compile(true);
        }
      } catch (e) {}
    }
  }

  // 1st priority: preview directory
  const previewPath = path.join(PREVIEW_DIR, cleanPath);
  if (fs.existsSync(previewPath) && fs.statSync(previewPath).isFile()) {
    return previewPath;
  }

  // 2nd priority: root workspace directory
  const rootCandidate = path.join(ROOT_DIR, cleanPath);
  if (fs.existsSync(rootCandidate) && fs.statSync(rootCandidate).isFile()) {
    return rootCandidate;
  }

  return null;
}

// 6. Create HTTP Server
const server = http.createServer((req, res) => {
  // SSE LiveReload Endpoint
  if (req.url === '/__livereload') {
    res.writeHead(200, {
      'Content-Type': 'text/event-stream',
      'Cache-Control': 'no-cache',
      'Connection': 'keep-alive',
      'Access-Control-Allow-Origin': '*'
    });
    res.write(':\n\n'); // SSE comment to establish connection
    sseClients.add(res);

    req.on('close', () => {
      sseClients.delete(res);
    });
    return;
  }

  // CORS Headers
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'GET, HEAD, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type, X-CSRF-Token');

  if (req.method === 'OPTIONS') {
    res.writeHead(204);
    res.end();
    return;
  }

  // Handle POST APIs (auth_action.php, save_data.php, etc.)
  if (req.method === 'POST') {
    let body = '';
    req.on('data', chunk => { body += chunk; });
    req.on('end', () => {
      let data = {};
      try { data = JSON.parse(body); } catch(e) {}

      // 1. auth_action.php handler
      if (req.url.includes('auth_action.php')) {
        res.setHeader('Content-Type', 'application/json; charset=utf-8');
        const maintFile = path.join(ROOT_DIR, 'data', 'maintenance_config.json');
        let config = { enabled: true, redirect_to_facebook: true, facebook_url: 'https://www.facebook.com/profile.php?id=100093686707861' };
        if (fs.existsSync(maintFile)) {
          try { config = JSON.parse(fs.readFileSync(maintFile, 'utf8')); } catch(e) {}
        }

        if (data.action === 'login') {
          const u = (data.username || '').trim();
          const p = (data.password || '');
          if (u === 'admin' && p === 'epadmin2026') {
            res.writeHead(200);
            res.end(JSON.stringify({ success: true, message: 'เข้าสู่ระบบสำเร็จ' }));
            return;
          } else {
            res.writeHead(200);
            res.end(JSON.stringify({ success: false, message: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง' }));
            return;
          }
        }

        if (data.action === 'get_maintenance') {
          res.writeHead(200);
          res.end(JSON.stringify({ success: true, config }));
          return;
        }

        if (data.action === 'toggle_maintenance') {
          if (typeof data.enabled === 'boolean') {
            config.enabled = data.enabled;
          } else {
            config.enabled = !config.enabled;
          }
          if (data.redirect_to_facebook !== undefined) config.redirect_to_facebook = data.redirect_to_facebook;
          if (data.facebook_url) config.facebook_url = data.facebook_url;
          config.updated_at = new Date().toISOString();

          fs.writeFileSync(maintFile, JSON.stringify(config, null, 2), 'utf8');
          const previewMaint = path.join(PREVIEW_DIR, 'data', 'maintenance_config.json');
          if (fs.existsSync(path.dirname(previewMaint))) {
            fs.writeFileSync(previewMaint, JSON.stringify(config, null, 2), 'utf8');
          }

          const statusText = config.enabled ? 'เปิดโหมดปิดปรับปรุงแล้ว (บุคคลภายนอกจะถูกส่งต่อไปยัง Facebook)' : 'เปิดเว็บไซต์สู่สาธารณะแล้ว (ทุกคนสามารถเข้าชมได้)';
          res.writeHead(200);
          res.end(JSON.stringify({ success: true, message: statusText, config }));
          return;
        }

        if (data.action === 'change_password') {
          res.writeHead(200);
          res.end(JSON.stringify({ success: true, message: 'เปลี่ยนรหัสผ่านสำเร็จเรียบร้อย' }));
          return;
        }

        res.writeHead(200);
        res.end(JSON.stringify({ success: true }));
        return;
      }

      // Default mock for other POSTs
      res.setHeader('Content-Type', 'application/json; charset=utf-8');
      res.writeHead(200);
      res.end(JSON.stringify({ success: true, message: 'บันทึกข้อมูลเรียบร้อย (Preview Mock)' }));
    });
    return;
  }

  if (req.method !== 'GET' && req.method !== 'HEAD') {
    res.writeHead(405, { 'Content-Type': 'text/plain' });
    res.end('Method Not Allowed');
    return;
  }

  // Route to set preview bypass cookie
  if (req.url.startsWith('/set_preview_bypass')) {
    res.writeHead(302, {
      'Set-Cookie': 'ep_preview_bypass=1; Path=/; Max-Age=86400',
      'Location': '/'
    });
    res.end();
    return;
  }

  // Check Maintenance Simulation for public pages
  const cookies = req.headers.cookie || '';
  const isBypassed = req.url.includes('bypass=1') || cookies.includes('ep_preview_bypass=1') || cookies.includes('ep_admin_session=1');
  const isPublicPage = !isBypassed && (req.url === '/' || req.url === '/index.html' || req.url === '/index.php' || req.url.startsWith('/news') || (req.url.endsWith('.html') && !req.url.includes('admin')));
  if (isPublicPage) {
    const maintFile = path.join(ROOT_DIR, 'data', 'maintenance_config.json');
    if (fs.existsSync(maintFile)) {
      try {
        const mConfig = JSON.parse(fs.readFileSync(maintFile, 'utf8'));
        if (mConfig.enabled && mConfig.redirect_to_facebook) {
          const fbTarget = mConfig.facebook_url || 'https://www.facebook.com/profile.php?id=100093686707861';
          res.writeHead(200, { 'Content-Type': 'text/html; charset=utf-8' });
          res.end(`
            <!DOCTYPE html>
            <html lang="th">
            <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>จำลองการส่งต่อ (Facebook Gateway Simulation) | EP CPW</title>
              <script src="https://cdn.tailwindcss.com"></script>
              <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600;700;800&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
              <style>body { font-family: 'Sarabun', 'Inter', sans-serif; }</style>
            </head>
            <body class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center p-4">
              <div class="max-w-lg w-full bg-slate-900 border border-slate-800 rounded-3xl p-8 text-center space-y-6 shadow-2xl">
                <div class="w-16 h-16 rounded-2xl bg-amber-500/20 text-amber-400 border border-amber-500/30 flex items-center justify-center text-3xl mx-auto">
                  🔒
                </div>
                <div class="space-y-2">
                  <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-500/10 text-amber-400 border border-amber-500/30">
                    โหมดปิดปรับปรุงกำลังทำงาน (Maintenance Mode)
                  </span>
                  <h1 class="text-xl font-black text-white">
                    ส่งต่อผู้เข้าชมไปยัง Facebook เพจ EP อัตโนมัติ
                  </h1>
                  <p class="text-xs text-slate-400 leading-relaxed">
                    เนื่องจากเว็บไซต์กำลังอยู่ระหว่างจัดเตรียมข้อมูล บุคคลทั่วไปที่คลิกมาจากเว็บโรงเรียนจะถูกส่งต่อไปยัง Facebook เพจ EP อัตโนมัติทันที
                  </p>
                </div>

                <div class="p-4 bg-slate-950 rounded-2xl border border-slate-800 text-xs text-slate-300 space-y-2">
                  <div class="flex items-center justify-between text-[11px] text-slate-500">
                    <span>ปลายทาง:</span>
                    <span class="text-blue-400 font-bold truncate max-w-[250px]">${fbTarget}</span>
                  </div>
                  <div class="text-amber-400 font-bold text-xs" id="countdownBox">
                    📌 <strong>บนเซิร์ฟเวอร์จริง:</strong> บุคคลภายนอกที่คลิกมาจะถูกดีดไปยัง Facebook อัตโนมัติทันที
                  </div>
                </div>

                <div class="space-y-2.5 pt-2">
                  <a href="${fbTarget}" target="_blank" class="block w-full py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs transition shadow-md">
                    🌐 ไปยัง Facebook เพจ EP ทันที
                  </a>
                  <a href="/set_preview_bypass" class="block w-full py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold text-xs transition border border-slate-700">
                    👁️ เข้าชมหน้าเว็บตัวอย่าง (โหมดผู้พัฒนา / Preview Website)
                  </a>
                  <a href="/admin.html" class="block w-full py-2.5 rounded-xl bg-brand-500/20 hover:bg-brand-500/30 text-brand-300 font-bold text-xs transition border border-brand-500/30">
                    🔐 เข้าสู่ระบบหลังบ้าน (Admin Dashboard)
                  </a>
                </div>
              </div>
            </body>
            </html>
          `);
          return;
        }
      } catch(e) {}
    }
  }

  const filePath = resolveFile(req.url);

  if (!filePath) {
    res.writeHead(404, { 'Content-Type': 'text/html; charset=utf-8' });
    res.end(`
      <!DOCTYPE html>
      <html lang="th">
      <head><meta charset="utf-8"><title>404 Not Found</title></head>
      <body style="font-family:sans-serif;text-align:center;padding:50px;">
        <h1 style="color:#1e3a8a;">404 - ไม่พบหน้าที่เรียก</h1>
        <p>URL: <code>${req.url}</code></p>
        <p><a href="/" style="color:#db2777;font-weight:bold;">กลับสู่หน้าแรก EP</a></p>
      </body>
      </html>
    `);
    return;
  }

  try {
    const ext = path.extname(filePath).toLowerCase();
    const contentType = MIME_TYPES[ext] || 'application/octet-stream';

    // Inject LiveReload script for HTML files
    if (ext === '.html') {
      let htmlContent = fs.readFileSync(filePath, 'utf8');
      const liveReloadScript = `
<!-- EP LiveReload -->
<script>
  (function() {
    if (window.EventSource) {
      const es = new EventSource('/__livereload');
      es.onmessage = function(e) {
        if (e.data === 'reload') {
          console.log('🔄 [EP LiveReload] ตรวจพบการอัปเดตไฟล์ -> รีโหลดหน้าจออัตโนมัติ');
          window.location.reload();
        }
      };
      es.onerror = function() {
        // auto reconnect
      };
    }
  })();
</script>
</body>`;
      if (htmlContent.includes('</body>')) {
        htmlContent = htmlContent.replace('</body>', liveReloadScript);
      } else {
        htmlContent += liveReloadScript;
      }

      const buf = Buffer.from(htmlContent, 'utf8');
      res.writeHead(200, {
        'Content-Type': contentType,
        'Content-Length': buf.length,
        'Cache-Control': 'no-cache, no-store, must-revalidate'
      });
      res.end(buf);
      return;
    }

    const stat = fs.statSync(filePath);
    res.writeHead(200, {
      'Content-Type': contentType,
      'Content-Length': stat.size,
      'Cache-Control': 'no-cache, no-store, must-revalidate'
    });

    if (req.method === 'HEAD') {
      res.end();
      return;
    }

    const readStream = fs.createReadStream(filePath);
    readStream.pipe(res);
  } catch (err) {
    res.writeHead(500, { 'Content-Type': 'text/plain' });
    res.end('Internal Server Error: ' + err.message);
  }
});

// 7. Get LAN IP Addresses
function getLanIpv4Addresses() {
  const nets = os.networkInterfaces();
  const results = [];
  for (const name of Object.keys(nets)) {
    for (const net of nets[name]) {
      if (net.family === 'IPv4' && !net.internal) {
        results.push({ name, address: net.address });
      }
    }
  }
  return results;
}

// 8. Start Listening on 0.0.0.0
server.listen(PORT, '0.0.0.0', () => {
  const lanIps = getLanIpv4Addresses();
  const schoolLanIp = lanIps.find(i => i.name.toLowerCase().includes('ethernet') || i.address.startsWith('10.')) || lanIps[0];

  console.log('\n======================================================');
  console.log('🚀 [EP Website Preview Server + LiveReload]');
  console.log('⚡ พร้อมระบบตรวจจับและอัปเดตหน้าจออัตโนมัติ (Auto-Sync)');
  console.log('======================================================');
  console.log(`💻 เข้าใช้งานจากเครื่องนี้:`);
  console.log(`   👉 http://localhost:${PORT}`);
  console.log(`   👉 http://127.0.0.1:${PORT}\n`);
  
  if (schoolLanIp) {
    console.log(`🏫 เข้าใช้งานจากเครือข่ายภายในโรงเรียน (LAN / Wi-Fi):`);
    console.log(`   👉 http://${schoolLanIp.address}:${PORT}`);
  }

  console.log('======================================================\n');
});
