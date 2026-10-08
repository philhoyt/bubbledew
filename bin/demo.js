#!/usr/bin/env node
/* eslint-disable no-console -- CLI progress for npm run demo */
/**
 * Loads the demo content into the site bin/wp.sh reaches: imports
 * _playground/demo.xml with the WordPress Importer and then runs the same PHP the
 * Playground blueprint runs after its import (featured images, sticky post,
 * tagline, cleanup), read from _playground/blueprint.json so the two never drift.
 *
 * Usage:
 *   npm run demo            # import on top of whatever the site has
 *   npm run demo -- --clean # wipe the wp-env site first (wp-env only)
 */

const { execFileSync, spawnSync } = require("child_process");
const fs = require("fs");
const path = require("path");

const root = path.resolve(__dirname, "..");
const wp = path.join(root, "bin", "wp.sh");
const run = (args, opts = {}) => execFileSync(wp, args, { stdio: "inherit", cwd: root, ...opts });

if (process.argv.includes("--clean")) {
	console.log("Resetting the wp-env development site...");
	spawnSync("npx", ["--no-install", "wp-env", "clean", "development"], {
		stdio: "inherit",
		cwd: root,
	});
	run(["theme", "activate", "bubbledew"]);
}

console.log("Installing the WordPress Importer...");
run(["plugin", "install", "wordpress-importer", "--activate"]);

console.log("Importing _playground/demo.xml...");
run(["import", "_playground/demo.xml", "--authors=create"]);

const blueprint = JSON.parse(
	fs.readFileSync(path.join(root, "_playground", "blueprint.json"), "utf8")
);
const step = blueprint.steps.find((s) => s.step === "runPHP");
const options = blueprint.steps.find((s) => s.step === "setSiteOptions");
if (options) {
	for (const [key, value] of Object.entries(options.options)) {
		run(["option", "update", key, String(value)]);
	}
}
if (step) {
	// The blueprint bootstraps WordPress itself; eval-file already has it loaded.
	const code = step.code.replace("require_once 'wordpress/wp-load.php';", "");
	const file = path.join(root, ".demo-finish.php");
	fs.writeFileSync(file, code);
	try {
		console.log("Running the blueprint's finishing PHP...");
		run(["eval-file", ".demo-finish.php"]);
	} finally {
		fs.unlinkSync(file);
	}
}
run(["rewrite", "flush"]);
console.log("Demo content loaded.");
