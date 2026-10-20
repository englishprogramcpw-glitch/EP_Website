const fs = require('fs');
const path = require('path');

const srcDir = __dirname;
const destDir = path.join(__dirname, 'preview');

if (!fs.existsSync(destDir)) {
    fs.mkdirSync(destDir);
}

let settings = {};
const settingsPath = path.join(srcDir, 'data', 'db_site_settings.json');
if (fs.existsSync(settingsPath)) {
    try {
        settings = JSON.parse(fs.readFileSync(settingsPath, 'utf8'));
    } catch (e) {
        console.error('Error loading db_site_settings.json:', e);
    }
}

const phpFiles = ['index.php', 'about.php', 'curriculum.php', 'admission.php', 'staff.php', 'contact.php', 'admin.php', 'fees.php', 'news.php', 'tour.php', 'awards.php'];

function processPHPContent(fileContent, pageTitle, currentPage) {
    // 1. Resolve includes
    let content = fileContent;
    const includeRegex = /<\?php\s+include\s+'([^']+)';\s*\?>/g;
    
    content = content.replace(includeRegex, (match, includeFile) => {
        const includePath = path.join(srcDir, includeFile);
        if (fs.existsSync(includePath)) {
            let includeContent = fs.readFileSync(includePath, 'utf8');
            // Remove PHP opening block at the top if it only defines current page
            includeContent = includeContent.replace(/^\s*<\?php[\s\S]*?\?>/, '');
            return includeContent;
        }
        return `<!-- Include file not found: ${includeFile} -->`;
    });

    // 2. Evaluate title echo
    content = content.replace(/<\?php\s+echo\s+\$pageTitle;\s*\?>/g, pageTitle);

    // 3. Evaluate currentPage checks
    const ternaryRegex = /<\?php\s+echo\s+\(\$currentPage\s*==\s*'([^']+)'\)\s*\?\s*'([^']*)'\s*:\s*'([^']*)';\s*\?>/g;
    content = content.replace(ternaryRegex, (match, targetPage, activeVal, inactiveVal) => {
        return (currentPage === targetPage) ? activeVal : inactiveVal;
    });

    // 4. Resolve specific dynamic checks in navbar links
    const indexCheckRegex = /<\?php\s+echo\s+\(\$currentPage\s*==\s*'index'\)\s*\?\s*'([^']*)'\s*:\s*'([^']*)';\s*\?>/g;
    content = content.replace(indexCheckRegex, (match, activeVal, inactiveVal) => {
        return (currentPage === 'index') ? activeVal : inactiveVal;
    });

    // 4.5 Evaluate fees expressions for fees.php
    if (content.includes('$primary') || content.includes('$junior') || content.includes('$senior')) {
        content = evaluateFeesExpressions(content, settings);
    }

    // 4.6 Inject awardsData for awards.php
    if (content.includes('AWARDS_DB') && content.includes('$awardsData')) {
        const awardsPath = path.join(srcDir, 'data', 'db_awards.json');
        if (fs.existsSync(awardsPath)) {
            try {
                const awardsJson = fs.readFileSync(awardsPath, 'utf8');
                content = content.replace(/let\s+AWARDS_DB\s*=\s*null;\s*<\?php[\s\S]*?\?>/g, `let AWARDS_DB = ${awardsJson};`);
            } catch (e) {
                console.error('Error injecting db_awards.json in compile.js:', e);
            }
        }
    }

    // 4.7 Evaluate dynamic pageMedia images in index.php
    if (content.includes('$homePrimaryImg') || content.includes('$homeJuniorImg') || content.includes('$homeSeniorImg')) {
        const pageMedia = (settings && settings.page_media) || {};
        const pImg = pageMedia.home_primary_img || 'img/ep_classroom_p1.jpg';
        const jImg = pageMedia.home_junior_img || 'img/ep_camp_activity.jpg';
        const sImg = pageMedia.home_senior_img || 'https://app.cpw.ac.th/cpw_api_content/images/activities/3202606231647351449664451.JPG';
        
        content = content.replace(/<\?php\s+echo\s+htmlspecialchars\(\$homePrimaryImg\);\s*\?>/g, pImg);
        content = content.replace(/<\?php\s+echo\s+htmlspecialchars\(\$homeJuniorImg\);\s*\?>/g, jImg);
        content = content.replace(/<\?php\s+echo\s+htmlspecialchars\(\$homeSeniorImg\);\s*\?>/g, sImg);
    }

    // 4.8 Evaluate maintenance & security tags for admin.php
    const maintConfigPath = path.join(srcDir, 'data', 'maintenance_config.json');
    let isMaintActive = true;
    if (fs.existsSync(maintConfigPath)) {
        try {
            const mc = JSON.parse(fs.readFileSync(maintConfigPath, 'utf8'));
            isMaintActive = !!mc.enabled;
        } catch(e) {}
    }
    content = content.replace(/<\?php\s+echo\s+htmlspecialchars\(\$_SESSION\['csrf_token'\][\s\S]*?\?>/g, 'preview_csrf_token');
    content = content.replace(/<\?php\s+echo\s+!empty\(\$isMaintActive\)\s*\?\s*'1'\s*:\s*'0';\s*\?>/g, isMaintActive ? '1' : '0');
    // Generic resolver for all $isMaintActive ? 'A' : 'B' expressions
    content = content.replace(/<\?php\s+echo\s+\$isMaintActive\s*\?\s*['"]([\s\S]*?)['"]\s*:\s*['"]([\s\S]*?)['"];\s*\?>/g, (match, optA, optB) => {
        return isMaintActive ? optA : optB;
    });

    // Remove EP_ADMIN_PREVIEWING_MAINTENANCE banner from preview pages
    content = content.replace(/<\?php\s+if\s*\(defined\('EP_ADMIN_PREVIEWING_MAINTENANCE'\)\):\s*\?>[\s\S]*?<\?php\s+endif;\s*\?>/g, '');

    // Ensure admin cockpit view starts with 'hidden' in preview HTML
    content = content.replace(/id="admin-cockpit-view"\s+class="[^"]*"/g, 'id="admin-cockpit-view" class="hidden flex-grow flex flex-col"');

    // 5. Clean up any remaining php blocks
    content = content.replace(/<\?php[\s\S]*?\?>/g, '');

    // 6. Map .php URLs to .html URLs so local navigation works in preview (excluding external URLs)
    content = content.replace(/href="([^"]+)\.php([^"]*)"/g, (match, p1, p2) => {
        if (p1.startsWith('http://') || p1.startsWith('https://')) return match;
        return `href="${p1}.html${p2}"`;
    });
    content = content.replace(/window\.location\.href\s*=\s*"([^"]+)\.php([^"]*)"/g, (match, p1, p2) => {
        if (p1.startsWith('http://') || p1.startsWith('https://')) return match;
        return `window.location.href = "${p1}.html${p2}"`;
    });
    content = content.replace(/window\.location\.href\s*=\s*'([^']+)\.php([^']*)'/g, (match, p1, p2) => {
        if (p1.startsWith('http://') || p1.startsWith('https://')) return match;
        return `window.location.href = '${p1}.html${p2}'`;
    });
    content = content.replace(/window\.location\.pathname\.includes\('([^']+)\.php'\)/g, (match, p1) => {
        return `window.location.pathname.includes('${p1}.html')`;
    });

    return content;
}

function compile(silent = false) {
    if (!fs.existsSync(destDir)) {
        fs.mkdirSync(destDir, { recursive: true });
    }

    let currentSettings = {};
    if (fs.existsSync(settingsPath)) {
        try {
            currentSettings = JSON.parse(fs.readFileSync(settingsPath, 'utf8'));
        } catch (e) {
            console.error('Error loading db_site_settings.json:', e);
        }
    }

    phpFiles.forEach(file => {
        const filePath = path.join(srcDir, file);
        if (!fs.existsSync(filePath)) return;

        let fileContent = fs.readFileSync(filePath, 'utf8');

        // Extract variables defined at the top
        let pageTitle = "English Program (EP) CPW";
        let currentPage = "";

        const titleMatch = fileContent.match(/\$pageTitle\s*=\s*"([^"]+)"/);
        if (titleMatch) pageTitle = titleMatch[1];

        const currentMatch = fileContent.match(/\$currentPage\s*=\s*"([^"]+)"/);
        if (currentMatch) currentPage = currentMatch[1];

        // Remove the PHP variable block at the very top (preserve admin.php login screen)
        if (file === 'admin.php') {
            fileContent = fileContent.replace(/\$pageTitle\s*=\s*"[^"]+";?/g, '');
            fileContent = fileContent.replace(/<\?php\s*require_once[\s\S]*?verify_admin_login[\s\S]*?\?>/g, '');
        } else {
            fileContent = fileContent.replace(/<\?php[\s\S]*?\$pageTitle[\s\S]*?\?>/g, '');
            fileContent = fileContent.replace(/<\?php[\s\S]*?\$currentPage[\s\S]*?\?>/g, '');
        }

        const compiledContent = processPHPContent(fileContent, pageTitle, currentPage);
        
        const outputName = file.replace('.php', '.html');
        const outputPath = path.join(destDir, outputName);
        
        fs.writeFileSync(outputPath, compiledContent, 'utf8');
        if (!silent) console.log(`Generated: preview/${outputName}`);
    });

    // Ensure preview assets directories exist
    const previewCssDir = path.join(destDir, 'css');
    const previewJsDir = path.join(destDir, 'js');
    const previewDataDir = path.join(destDir, 'data');

    if (!fs.existsSync(previewCssDir)) fs.mkdirSync(previewCssDir, { recursive: true });
    if (!fs.existsSync(previewJsDir)) fs.mkdirSync(previewJsDir, { recursive: true });
    if (!fs.existsSync(previewDataDir)) fs.mkdirSync(previewDataDir, { recursive: true });

    // Copy assets to preview folder structure
    if (fs.existsSync(path.join(srcDir, 'js', 'news.js'))) {
        fs.copyFileSync(path.join(srcDir, 'js', 'news.js'), path.join(previewJsDir, 'news.js'));
    }
    if (fs.existsSync(path.join(srcDir, 'js', 'editor.js'))) {
        fs.copyFileSync(path.join(srcDir, 'js', 'editor.js'), path.join(previewJsDir, 'editor.js'));
    }
    if (fs.existsSync(path.join(srcDir, 'css', 'editor.css'))) {
        fs.copyFileSync(path.join(srcDir, 'css', 'editor.css'), path.join(previewCssDir, 'editor.css'));
    }

    if (fs.existsSync(path.join(srcDir, 'data', 'db_news.json'))) {
        fs.copyFileSync(path.join(srcDir, 'data', 'db_news.json'), path.join(previewDataDir, 'db_news.json'));
    }
    if (fs.existsSync(path.join(srcDir, 'data', 'db_staff.json'))) {
        fs.copyFileSync(path.join(srcDir, 'data', 'db_staff.json'), path.join(previewDataDir, 'db_staff.json'));
    }
    if (fs.existsSync(path.join(srcDir, 'data', 'db_slides.json'))) {
        fs.copyFileSync(path.join(srcDir, 'data', 'db_slides.json'), path.join(previewDataDir, 'db_slides.json'));
    }
    if (fs.existsSync(path.join(srcDir, 'data', 'db_site_settings.json'))) {
        fs.copyFileSync(path.join(srcDir, 'data', 'db_site_settings.json'), path.join(previewDataDir, 'db_site_settings.json'));
    }
    if (fs.existsSync(path.join(srcDir, 'data', 'db_awards.json'))) {
        fs.copyFileSync(path.join(srcDir, 'data', 'db_awards.json'), path.join(previewDataDir, 'db_awards.json'));
    }
    if (fs.existsSync(path.join(srcDir, 'data', 'db_tour_bookings.json'))) {
        fs.copyFileSync(path.join(srcDir, 'data', 'db_tour_bookings.json'), path.join(previewDataDir, 'db_tour_bookings.json'));
    }
    if (fs.existsSync(path.join(srcDir, 'data', 'maintenance_config.json'))) {
        fs.copyFileSync(path.join(srcDir, 'data', 'maintenance_config.json'), path.join(previewDataDir, 'maintenance_config.json'));
    }

    // Copy awards images to preview
    const previewAwardsImgDir = path.join(destDir, 'img', 'awards');
    if (!fs.existsSync(previewAwardsImgDir)) fs.mkdirSync(previewAwardsImgDir, { recursive: true });
    const srcAwardsImgDir = path.join(srcDir, 'img', 'awards');
    if (fs.existsSync(srcAwardsImgDir)) {
        fs.readdirSync(srcAwardsImgDir).forEach(file => {
            fs.copyFileSync(path.join(srcAwardsImgDir, file), path.join(previewAwardsImgDir, file));
        });
    }

    // Copy root img assets to preview/img
    const srcImgDir = path.join(srcDir, 'img');
    const destImgDir = path.join(destDir, 'img');
    if (!fs.existsSync(destImgDir)) fs.mkdirSync(destImgDir, { recursive: true });
    if (fs.existsSync(srcImgDir)) {
        fs.readdirSync(srcImgDir).forEach(file => {
            const fullSrc = path.join(srcImgDir, file);
            if (fs.statSync(fullSrc).isFile()) {
                fs.copyFileSync(fullSrc, path.join(destImgDir, file));
            }
        });
    }

    if (fs.existsSync(path.join(srcDir, 'js', 'main.js'))) {
        let mainJsContent = fs.readFileSync(path.join(srcDir, 'js', 'main.js'), 'utf8');
        mainJsContent = mainJsContent.replace(/(?<!\/cpw_personal\/)admin\.php/g, 'admin.html');
        mainJsContent = mainJsContent.replace(/(?<!\/cpw_personal\/)index\.php/g, 'index.html');
        fs.writeFileSync(path.join(previewJsDir, 'main.js'), mainJsContent, 'utf8');
    }

    if (!silent) console.log('Static preview build completed successfully!');
    return true;
}

if (require.main === module) {
    compile();
}

module.exports = { compile };

function evaluateFeesExpressions(content, settings) {
    if (!settings || !settings.fees) return content;
    
    const primary = settings.fees.primary;
    const junior = settings.fees.junior;
    const senior = settings.fees.senior;
    
    const val = (v) => {
        if (!v || v === '-' || v === '0') return 0;
        return parseFloat(String(v).replace(/,/g, ''));
    };
    
    const fmt = (v) => {
        if (!v || v === '-' || v === '0') return '-';
        return Number(val(v)).toLocaleString('en-US');
    };
    
    // Replace all PHP expressions with their evaluated static HTML
    return content.replace(/<\?php\s+echo\s+([^;]+);\s*\?>/g, (match, expr) => {
        if (!expr.includes('$primary') && !expr.includes('$junior') && !expr.includes('$senior')) {
            return match; // Safe fallback for other PHP tags
        }
        
        expr = expr.trim();
        
        let jsExpr = expr
            .replace(/\$primary\['([^']+)'\]/g, 'primary.$1')
            .replace(/\$junior\['([^']+)'\]/g, 'junior.$1')
            .replace(/\$senior\['([^']+)'\]/g, 'senior.$1')
            .replace(/val\(([^)]+)\)/g, 'val($1)')
            .replace(/fmt\(([^)]+)\)/g, 'fmt($1)');
        
        try {
            const result = new Function('primary', 'junior', 'senior', 'val', 'fmt', `return ${jsExpr}`)(
                primary, junior, senior, val, fmt
            );
            return result;
        } catch (e) {
            console.error(`Failed to evaluate expression: ${expr} (${jsExpr})`, e);
            return match;
        }
    });
}
