const fs = require('fs');
const path = require('path');

const logPath = 'C:\\Users\\tom_p\\.gemini\\antigravity-ide\\brain\\b77086d3-4962-4ab9-bfe4-111247e56a95\\.system_generated\\logs\\transcript.jsonl';

if (!fs.existsSync(logPath)) {
    console.error("Log file not found");
    process.exit(1);
}

const lines = fs.readFileSync(logPath, 'utf8').split('\n');
let indexPhpContent = null;

for (const line of lines) {
    if (!line.trim()) continue;
    try {
        const step = JSON.parse(line);
        // Look for model response or system message that has index.php view_file content
        if (step.type === 'VIEW_FILE' && step.tool_calls) {
             // Let's find index.php
             const hasIndexPhp = step.tool_calls.some(tc => tc.arguments && tc.arguments.AbsolutePath && tc.arguments.AbsolutePath.includes('index.php'));
             if (hasIndexPhp && step.content) {
                  indexPhpContent = step.content;
                  break;
             }
        }
        // Also check if there is content field with the lines
        if (step.content && step.content.includes('File Path:') && step.content.includes('index.php') && step.content.includes('1: <?php')) {
            indexPhpContent = step.content;
            break;
        }
    } catch (e) {
        // ignore JSON parse errors
    }
}

if (!indexPhpContent) {
    // If not found in JSON structures, search using regex in the raw log file
    const rawLog = fs.readFileSync(logPath, 'utf8');
    const match = rawLog.match(/1: <\?php[\s\S]*?574: <\/html>/);
    if (match) {
        indexPhpContent = match[0];
    }
}

if (!indexPhpContent) {
    console.error("Failed to find index.php original content in logs");
    process.exit(1);
}

// Extract lines and strip prefixes like "1: "
const rawLines = indexPhpContent.split('\n');
const cleanLines = [];

for (const rl of rawLines) {
    const m = rl.match(/^\s*(\d+):\s(.*)$/);
    if (m) {
        cleanLines.push(m[2]);
    } else if (rl.includes('<?php') && !rl.includes('1:')) {
        // Fallback for lines without line number prefixes if any
        cleanLines.push(rl);
    }
}

// Reconstruct file
let cleanContent = cleanLines.join('\n');
if (cleanContent.startsWith('Showing lines') || cleanContent.includes('Total Lines:')) {
    // just in case
}

// Write the restored index.php
fs.writeFileSync('index.php', cleanContent, 'utf8');
console.log("RESTORE SUCCESS: index.php restored to original clean state");
