#!/usr/bin/env node
/* eslint-disable no-console -- CLI report for npm run check:contrast */
/**
 * Checks every colour preset (theme.json and styles/colors/*.json) against the
 * text pairs the theme relies on. Body text needs 7:1, everything else 4.5:1.
 * Pastels are used as pill, badge, button and sticky-note fills with ink text
 * on them, so each one is checked against the ink; the link colour is checked
 * on every surface it can land on.
 *
 * Usage: node bin/check-contrast.js
 */

const fs = require("fs");
const path = require("path");

const root = path.resolve(__dirname, "..");

const pairs = [
	["contrast", "base", 7, "body text on the page"],
	["contrast", "surface", 7, "body text on a card"],
	["contrast-dark", "base", 4.5, "meta text on the page"],
	["contrast-dark", "surface", 4.5, "meta text on a card"],
	["contrast-dark", "contrast-light", 4.5, "meta text on the tint"],
	["contrast", "primary", 4.5, "text on primary pills and buttons"],
	["contrast", "secondary", 4.5, "text on secondary pills"],
	["contrast", "tertiary", 4.5, "text on tertiary pills"],
	["contrast", "butter", 4.5, "text on the sticky note"],
	["contrast", "lavender", 4.5, "text on lavender pills"],
	["contrast", "pink", 4.5, "text on pink pills"],
	["link", "base", 4.5, "links on the page"],
	["link", "surface", 4.5, "links on a card"],
	["link", "contrast-light", 4.5, "links on the tint"],
	["link", "butter", 4.5, "links on the sticky note"],
	["contrast", "base", 3, "focus ring on the page"],
];

const luminance = (hex) => {
	const [r, g, b] = [1, 3, 5]
		.map((i) => parseInt(hex.slice(i, i + 2), 16) / 255)
		.map((v) => (v <= 0.03928 ? v / 12.92 : ((v + 0.055) / 1.055) ** 2.4));
	return 0.2126 * r + 0.7152 * g + 0.0722 * b;
};
const ratio = (a, b) =>
	(Math.max(luminance(a), luminance(b)) + 0.05) / (Math.min(luminance(a), luminance(b)) + 0.05);

const presets = [path.join(root, "theme.json")];
const dir = path.join(root, "styles", "colors");
if (fs.existsSync(dir)) {
	for (const file of fs.readdirSync(dir).sort()) {
		if (file.endsWith(".json")) {
			presets.push(path.join(dir, file));
		}
	}
}

let failures = 0;
for (const file of presets) {
	const json = JSON.parse(fs.readFileSync(file, "utf8"));
	const palette = Object.fromEntries(
		(json.settings?.color?.palette || []).map((c) => [c.slug, c.color.toLowerCase()])
	);
	console.log(`\n${json.title || "theme.json (default)"} (${path.relative(root, file)})`);
	for (const [fg, bg, min, use] of pairs) {
		if (!palette[fg] || !palette[bg]) {
			console.log(`  skip ${fg} on ${bg}: slug missing`);
			continue;
		}
		const value = ratio(palette[fg], palette[bg]);
		const ok = value >= min;
		if (!ok) {
			failures++;
		}
		console.log(`  ${ok ? "ok  " : "FAIL"} ${fg} on ${bg}: ${value.toFixed(2)} (min ${min}) ${use}`);
	}
}
console.log(failures ? `\n${failures} pair(s) below minimum.` : "\nAll pairs pass.");
process.exit(failures ? 1 : 0);
