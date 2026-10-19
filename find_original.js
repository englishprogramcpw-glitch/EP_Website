const fs = require('fs');
const path = require('path');

const logPath = 'C:\\Users\\tom_p\\.gemini\\antigravity-ide\\brain\\b77086d3-4962-4ab9-bfe4-111247e56a95\\.system_generated\\logs\\transcript.jsonl';
const logContent = fs.readFileSync(logPath, 'utf8');

console.log("Log length:", logContent.length);

// Split by JSON lines
const lines = logContent.split('\n');
console.log("Total JSON lines:", lines.length);

lines.forEach((l, idx) => {
    if (l.includes('index.php') && l.includes('1: <?php')) {
        console.log(`Line ${idx} matches! Length: ${l.length}`);
        
        try {
            const parsed = JSON.parse(l);
            console.log("Keys:", Object.keys(parsed));
            if (parsed.content) {
                console.log("Content length:", parsed.content.length);
                // Print a snippet of content to verify
                console.log("Snippet:\n", parsed.content.substring(0, 300));
                
                // Write to a temp file to verify
                fs.writeFileSync('restored_raw.txt', parsed.content, 'utf8');
                console.log("Saved content to restored_raw.txt");
            }
        } catch (e) {
            console.error(`Failed to parse line ${idx}:`, e.message);
        }
    }
});
