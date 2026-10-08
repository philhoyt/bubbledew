#!/usr/bin/env node
'use strict';
/* eslint-disable no-console -- CLI report for npm run check:test-content */

/**
 * Sweeps a site loaded with the WordPress.org Theme Unit Test content at a
 * phone and a desktop width, the way the theme review site shows it.
 *
 * For every URL it flags a page wider than the screen (and names the element
 * that forces the width), broken images, PHP notices in the markup, console
 * errors and unexpected HTTP statuses. On the posts the test content ships
 * for the purpose, it also checks what a block theme commonly misses: page
 * links on a classic paginated post, an empty Comments section on a
 * password-protected post, a [gallery] shortcode with no grid, and reply
 * indentation that leaves deep replies a sliver of a phone screen. Body text
 * that renders at a different size on a phone than on a desktop is reported
 * once for the whole site.
 *
 * Paths come from the site's sitemap (wp-sitemap.xml) plus the pages it does
 * not list: the second page of posts, a search with results and one without,
 * a year archive and a 404. Category and tag archives share one template, so
 * only the eight with the longest slugs per taxonomy are kept unless --all is
 * passed. Each URL loads in a fresh tab, so a late request from one page is
 * never reported against the next.
 *
 * Pass --theme=<slug> to stop before the sweep when the site runs a different
 * theme: wp-env instances of other projects can hold the same port.
 *
 * Usage:
 *   node bin/check-test-content.js http://localhost:8896 --theme=my-theme
 *   node bin/check-test-content.js http://localhost:8896 --paths=/,/about/
 *   node bin/check-test-content.js http://localhost:8896 --shots=plans/test-content-shots
 *   node bin/check-test-content.js http://localhost:8896 --json=plans/test-content.json --all
 *
 * --shots= saves screen-height PNG tiles of the posts that exercise classic
 * markup, comments and media, at both widths, for the review by eye.
 *
 * Needs puppeteer as a devDependency.
 */

const VIEWPORTS = [
	{ name: 'phone', width: 390, height: 844, isMobile: true },
	{ name: 'desktop', width: 1280, height: 900, isMobile: false },
];

const MISSING_PATH = '/this-page-does-not-exist-test-content/';
const EXTRA_PATHS = [ '/page/2/', '/?s=post', '/?s=zzzznotfound', '/2010/', MISSING_PATH ];
const ARCHIVES_PER_TAXONOMY = 8;
const CONCURRENCY = 4;
const MAX_TILES = 12;

// Slugs from the Theme Unit Test data whose posts exercise one thing each.
const CONTENT_CHECKS = {
	paginated: 'template-paginated',
	locked: 'template-password-protected',
	gallery: 'post-format-gallery',
	comments: 'template-comments',
};

// The deepest reply on the comments post may start at most this far across
// a phone screen; further in, its text column is too narrow to read.
const MAX_REPLY_INDENT = 0.4;

// Posts and pages captured by --shots for the review by eye.
const SHOT_SLUGS = [
	'markup-html-tags-and-formatting',
	'markup-image-alignment',
	'post-format-gallery',
	'template-comments',
	'template-paginated',
	'template-password-protected',
	'post-format-image-caption',
];

/**
 * Pulls the paths out of a sitemap or sitemap index, relative to the base URL.
 *
 * @param {string} xml     Sitemap XML.
 * @param {string} baseUrl Site origin, no trailing slash.
 * @return {{ sitemaps: string[], paths: string[] }} Child sitemap URLs and page paths.
 */
function parseSitemap( xml, baseUrl ) {
	const sitemaps = [];
	const paths = [];
	const isIndex = /<sitemapindex[\s>]/i.test( xml );

	for ( const match of xml.matchAll( /<loc>\s*([^<\s]+)\s*<\/loc>/gi ) ) {
		const loc = match[ 1 ].trim();
		if ( isIndex ) {
			sitemaps.push( loc );
		} else if ( loc.startsWith( baseUrl ) ) {
			paths.push( loc.slice( baseUrl.length ) || '/' );
		}
	}

	return { sitemaps, paths };
}

/**
 * Names the kind of content a core sitemap file lists, from its filename:
 * wp-sitemap-posts-page-1.xml is "page", wp-sitemap-taxonomies-post_tag-1.xml
 * is "post_tag", wp-sitemap-users-1.xml is "user".
 *
 * @param {string} url Child sitemap URL.
 * @return {string} Post type, taxonomy, "user", or "other".
 */
function sitemapType( url ) {
	const match = url.match( /wp-sitemap-(posts|taxonomies)-([a-z0-9_-]+?)-\d+\.xml/i );
	if ( match ) {
		return match[ 2 ];
	}
	return /wp-sitemap-users-\d+\.xml/i.test( url ) ? 'user' : 'other';
}

/**
 * Keeps the term archives with the longest slugs for each taxonomy; long
 * slugs are what break a layout, and every archive uses the same template.
 *
 * @param {{ type: string, path: string }[]} entries     Typed paths.
 * @param {string[]}                         taxonomies  Types to trim.
 * @param {number}                           perTaxonomy Archives kept per taxonomy.
 * @return {{ type: string, path: string }[]} Trimmed list, order otherwise kept.
 */
function trimArchives( entries, taxonomies, perTaxonomy ) {
	const keep = new Set();
	for ( const taxonomy of taxonomies ) {
		entries
			.filter( ( e ) => e.type === taxonomy )
			.sort( ( a, b ) => b.path.length - a.path.length )
			.slice( 0, perTaxonomy )
			.forEach( ( e ) => keep.add( e ) );
	}
	return entries.filter( ( e ) => ! taxonomies.includes( e.type ) || keep.has( e ) );
}

/**
 * Collects every path the sitemap index lists, typed by its sitemap, then
 * adds the pages no sitemap lists.
 *
 * @param {string}   baseUrl   Site origin.
 * @param {boolean}  all       Keep every term archive.
 * @param {Function} fetchText Fetches a URL and resolves its body, or null.
 * @return {Promise<{ type: string, path: string }[]>} Typed paths.
 */
async function collectPaths( baseUrl, all, fetchText ) {
	const index = await fetchText( `${ baseUrl }/wp-sitemap.xml` );
	if ( ! index ) {
		return [];
	}
	const seen = new Set();
	let entries = [];
	const { sitemaps, paths: direct } = parseSitemap( index, baseUrl );

	for ( const p of direct ) {
		seen.add( p );
		entries.push( { type: 'other', path: p } );
	}
	for ( const url of sitemaps ) {
		const xml = await fetchText( url );
		if ( ! xml ) {
			continue;
		}
		const type = sitemapType( url );
		for ( const p of parseSitemap( xml, baseUrl ).paths ) {
			if ( ! seen.has( p ) ) {
				seen.add( p );
				entries.push( { type, path: p } );
			}
		}
	}

	if ( ! all ) {
		entries = trimArchives( entries, [ 'category', 'post_tag' ], ARCHIVES_PER_TAXONOMY );
	}
	for ( const p of EXTRA_PATHS ) {
		if ( ! seen.has( p ) ) {
			entries.push( { type: p === MISSING_PATH ? '404' : 'extra', path: p } );
		}
	}
	return entries;
}

/**
 * Which content check, if any, applies to a path.
 *
 * @param {string} p Site-relative path.
 * @return {string|null} Key of CONTENT_CHECKS.
 */
function contentCheckFor( p ) {
	const slug = p.replace( /\/$/, '' ).split( '/' ).pop();
	for ( const [ key, value ] of Object.entries( CONTENT_CHECKS ) ) {
		if ( slug === value ) {
			return key;
		}
	}
	return null;
}

/**
 * Turns one page's measurements into findings.
 *
 * @param {Object} r Result of one load: path, type, viewport, status and the
 *                   measurements from inspectPage().
 * @return {string[]} Findings, empty when the page is clean.
 */
function findingsFor( r ) {
	const out = [];
	if ( r.error ) {
		return [ `did not load: ${ r.error }` ];
	}
	const expected = r.type === '404' ? 404 : 200;
	if ( r.status !== expected ) {
		out.push( `HTTP ${ r.status }, expected ${ expected }` );
	}
	if ( r.scrollWidth > r.vw + 1 ) {
		out.push( `page is ${ r.scrollWidth }px wide on a ${ r.vw }px screen` );
		r.forcing.forEach( ( f ) => out.push( `  forced by ${ f.el } "${ f.text }" (${ f.without }px without it)` ) );
	}
	r.brokenImages.forEach( ( src ) => out.push( `broken image ${ src }` ) );
	r.php.forEach( ( line ) => out.push( `PHP ${ line }` ) );
	if ( r.type !== '404' ) {
		r.consoleErrors.forEach( ( line ) => out.push( `console: ${ line }` ) );
	}
	if ( r.check === 'paginated' && ! r.pageLinks ) {
		out.push( 'classic <!--nextpage--> post has no page links; its later pages cannot be reached' );
	}
	if ( r.check === 'locked' && r.lockedForm && r.commentsVisible ) {
		out.push( 'password-protected post shows a Comments section with nothing in it' );
	}
	if ( r.check === 'comments' && r.vw < 700 && r.deepestReply > r.vw * MAX_REPLY_INDENT ) {
		out.push( `deepest reply starts ${ r.deepestReply }px into a ${ r.vw }px screen; reduce the reply indent on phones` );
	}
	if ( r.check === 'gallery' && r.gallery && r.gallery.perRow < 2 ) {
		out.push( `[gallery] shortcode shows one image per row (${ r.gallery.items } images); block themes get no gallery CSS` );
	}
	return out;
}

/**
 * Compares body text size across widths for the same path.
 *
 * @param {Object[]} results Loads of one path at every width.
 * @return {string|null} Finding, or null when the size does not change.
 */
function bodySizeFinding( results ) {
	const distinct = new Set( results.filter( ( r ) => r.bodySize ).map( ( r ) => r.bodySize ) );
	if ( distinct.size < 2 ) {
		return null;
	}
	const sizes = results.filter( ( r ) => r.bodySize ).map( ( r ) => `${ r.bodySize } at ${ r.vw }px` );
	return `body text changes size with the screen (${ sizes.join( ', ' ) }): give the body font size "fluid": false in theme.json`;
}

/**
 * Reads the active theme from a page's body classes (wp-theme-<slug>, plus
 * wp-child-theme-<slug> when a child theme is active).
 *
 * @param {string} html Page HTML.
 * @return {{ theme: string|null, child: string|null }} Theme slugs.
 */
function themeFromHtml( html ) {
	const body = html.match( /<body[^>]*\bclass="([^"]*)"/i );
	const classes = body ? body[ 1 ].split( /\s+/ ) : [];
	const find = ( prefix ) => {
		const hit = classes.find( ( c ) => c.startsWith( prefix ) );
		return hit ? hit.slice( prefix.length ) : null;
	};
	return { theme: find( 'wp-theme-' ), child: find( 'wp-child-theme-' ) };
}

function parseArgs( argv ) {
	const args = argv.filter( ( a ) => a.startsWith( '--' ) );
	const positional = argv.filter( ( a ) => ! a.startsWith( '--' ) );
	const get = ( name ) => {
		const hit = args.find( ( a ) => a.startsWith( `--${ name }=` ) );
		return hit ? hit.slice( name.length + 3 ) : null;
	};
	return {
		baseUrl: ( positional[ 0 ] || 'http://localhost:8896' ).replace( /\/$/, '' ),
		paths: get( 'paths' ) ? get( 'paths' ).split( ',' ) : null,
		shots: get( 'shots' ),
		json: get( 'json' ),
		theme: get( 'theme' ),
		all: args.includes( '--all' ),
	};
}

/**
 * Runs in the page. Measures overflow and its cause, broken images, PHP
 * notices, body text size and the content checks.
 *
 * @return {Object} Measurements.
 */
function inspectPage() {
	const root = document.documentElement;
	const vw = root.clientWidth;
	const describe = ( el ) => {
		const parts = [];
		for ( let n = el; n && n !== document.body && parts.length < 3; n = n.parentElement ) {
			const cls = typeof n.className === 'string' && n.className.trim() ? '.' + n.className.trim().split( /\s+/ ).slice( 0, 2 ).join( '.' ) : '';
			parts.unshift( n.tagName.toLowerCase() + cls );
		}
		return parts.join( ' > ' );
	};
	const shown = ( el ) => {
		const rect = el.getBoundingClientRect();
		return rect.width > 0 && rect.height > 0 && window.getComputedStyle( el ).visibility !== 'hidden';
	};
	const scrollWidth = root.scrollWidth;

	// What forces the page wide: hide elements deepest first and keep the ones
	// whose removal narrows it.
	const forcing = [];
	if ( scrollWidth > vw + 1 ) {
		for ( const el of [ ...document.querySelectorAll( 'body *' ) ].reverse() ) {
			if ( forcing.some( ( f ) => f.node.contains( el ) || el.contains( f.node ) ) ) {
				continue;
			}
			const before = el.style.display;
			el.style.display = 'none';
			const without = root.scrollWidth;
			el.style.display = before;
			if ( without < scrollWidth - 1 ) {
				const text = ( el.innerText || el.getAttribute( 'src' ) || '' ).trim().replace( /\s+/g, ' ' ).slice( 0, 60 );
				forcing.push( { node: el, el: describe( el ), text, without } );
			}
			if ( forcing.length >= 4 ) {
				break;
			}
		}
	}

	const brokenImages = [ ...document.images ]
		.filter( ( img ) => img.complete && ! img.naturalWidth && shown( img ) )
		.map( ( img ) => img.currentSrc || img.src )
		.slice( 0, 5 );
	const php = ( document.body.innerHTML.match( /<b>(Warning|Notice|Deprecated|Fatal error|Parse error)<\/b>:[^<]{0,160}/g ) || [] )
		.map( ( line ) => line.replace( /<\/?b>/g, '' ) )
		.slice( 0, 3 );

	const content = document.querySelector( '.wp-block-post-content, .entry-content' );
	const bodySize = content && content.querySelector( 'p' ) ? window.getComputedStyle( content.querySelector( 'p' ) ).fontSize : null;

	const comments = document.querySelector( '.wp-block-comments' );
	const gallery = document.querySelector( '.gallery' );
	let galleryInfo = null;
	if ( gallery ) {
		const tops = new Set( [ ...gallery.querySelectorAll( '.gallery-item' ) ].map( ( i ) => Math.round( i.getBoundingClientRect().top ) ) );
		const items = gallery.querySelectorAll( '.gallery-item' ).length;
		galleryInfo = { items, perRow: tops.size ? items / tops.size : 0 };
	}

	return {
		vw,
		scrollWidth,
		forcing: forcing.map( ( { node, ...rest } ) => rest ),
		brokenImages,
		php,
		bodySize,
		pageLinks: !! document.querySelector( '.post-nav-links, .page-links' ),
		lockedForm: !! document.querySelector( '.post-password-form' ),
		commentsVisible: !! comments && shown( comments ),
		gallery: galleryInfo,
		deepestReply: Math.max( 0, ...[ ...document.querySelectorAll( '.wp-block-comment-content, .comment-content' ) ].map( ( el ) => Math.round( el.getBoundingClientRect().left ) ) ),
	};
}

/**
 * Runs in the page. Starts every lazy image loading and waits for each one to
 * load or fail, so screenshots show them and a broken one is reported; a lazy
 * image below the first screen never loads when nothing scrolls.
 *
 * @return {Promise<void>} Resolves when every image has settled or 5s passed.
 */
function loadLazyImages() {
	const images = [ ...document.images ];
	images.forEach( ( img ) => {
		if ( img.loading === 'lazy' ) {
			img.loading = 'eager';
		}
	} );
	return Promise.all(
		images.map( ( img ) =>
			img.complete
				? null
				: new Promise( ( resolve ) => {
						img.addEventListener( 'load', resolve, { once: true } );
						img.addEventListener( 'error', resolve, { once: true } );
						setTimeout( resolve, 5000 );
				  } )
		)
	);
}

async function saveTiles( page, dir, label ) {
	const path = require( 'path' );
	const { width, height } = page.viewport();
	const total = await page.evaluate( () => document.documentElement.scrollHeight );
	const files = [];
	for ( let i = 0; i * height < total && i < MAX_TILES; i++ ) {
		const file = path.join( dir, `${ label }-${ String( i + 1 ).padStart( 2, '0' ) }.png` );
		await page.screenshot( { path: file, clip: { x: 0, y: i * height, width, height: Math.min( height, total - i * height ) }, captureBeyondViewport: true } );
		files.push( file );
	}
	return files;
}

async function main() {
	const fs = require( 'fs' );
	const puppeteer = require( 'puppeteer' );
	const opts = parseArgs( process.argv.slice( 2 ) );
	const { baseUrl } = opts;

	const fetchText = async ( url ) => {
		try {
			const res = await fetch( url );
			return res.ok ? await res.text() : null;
		} catch {
			return null;
		}
	};

	const active = themeFromHtml( ( await fetchText( `${ baseUrl }/` ) ) || '' );
	const running = active.child || active.theme;
	if ( opts.theme && running !== opts.theme ) {
		console.error( `${ baseUrl } runs the theme "${ running || 'unknown' }", not "${ opts.theme }". Another wp-env instance may hold the port; check docker ps.` );
		process.exit( 2 );
	}
	console.log( `Theme: ${ running || 'unknown (no wp-theme- body class)' }` );

	let entries;
	if ( opts.paths ) {
		entries = opts.paths.map( ( p ) => ( { type: p === MISSING_PATH ? '404' : 'other', path: p } ) );
	} else {
		entries = await collectPaths( baseUrl, opts.all, fetchText );
		if ( ! entries.length ) {
			console.error( `No sitemap at ${ baseUrl }/wp-sitemap.xml; pass --paths=/,/about/ or check the URL.` );
			process.exit( 2 );
		}
		const slugs = new Set( entries.map( ( e ) => e.path.replace( /\/$/, '' ).split( '/' ).pop() ) );
		const missing = Object.values( CONTENT_CHECKS ).filter( ( s ) => ! slugs.has( s ) );
		if ( missing.length ) {
			console.log( `Warning: no ${ missing.join( ', ' ) } in the sitemap. Is the Theme Unit Test content imported?\n` );
		}
	}
	if ( opts.shots ) {
		fs.mkdirSync( opts.shots, { recursive: true } );
	}

	const jobs = entries.flatMap( ( e ) => VIEWPORTS.map( ( v ) => ( { ...e, viewport: v, check: contentCheckFor( e.path ) } ) ) );
	console.log( `Checking ${ entries.length } paths on ${ baseUrl } at ${ VIEWPORTS.map( ( v ) => v.width + 'px' ).join( ' and ' ) }...\n` );

	// Ubuntu 24.04 runners block Chrome's unprivileged sandbox; the pages under
	// test are the site's own, so CI runs without it.
	const browser = await puppeteer.launch( { args: process.env.CI ? [ '--no-sandbox' ] : [] } );
	const results = [];
	const shots = [];
	const queue = [ ...jobs ];

	const worker = async () => {
		for ( let job = queue.shift(); job; job = queue.shift() ) {
			const page = await browser.newPage();
			const consoleErrors = [];
			page.on( 'console', ( m ) => m.type() === 'error' && consoleErrors.push( m.text().slice( 0, 160 ) ) );
			page.on( 'pageerror', ( e ) => consoleErrors.push( String( e ).slice( 0, 160 ) ) );
			const { viewport } = job;
			try {
				await page.setViewport( { width: viewport.width, height: viewport.height, isMobile: viewport.isMobile, hasTouch: viewport.isMobile } );
				const res = await page.goto( baseUrl + job.path, { waitUntil: 'networkidle2', timeout: 45000 } );
				await page.evaluate( () => document.fonts.ready );
				await page.evaluate( loadLazyImages );
				const measured = await page.evaluate( inspectPage );
				results.push( { ...job, viewport: viewport.name, status: res ? res.status() : 0, ...measured, consoleErrors: consoleErrors.slice( 0, 3 ) } );
				const slug = job.path.replace( /\/$/, '' ).split( '/' ).pop();
				if ( opts.shots && SHOT_SLUGS.includes( slug ) ) {
					shots.push( ...( await saveTiles( page, opts.shots, `${ slug }-${ viewport.width }` ) ) );
				}
			} catch ( error ) {
				results.push( { ...job, viewport: viewport.name, error: error.message.slice( 0, 200 ) } );
			}
			await page.close();
		}
	};
	await Promise.all( Array.from( { length: CONCURRENCY }, worker ) );
	await browser.close();

	if ( opts.json ) {
		fs.writeFileSync( opts.json, JSON.stringify( results, null, 1 ) );
	}

	let flagged = 0;
	const order = ( r ) => `${ r.path } ${ r.viewport }`;
	for ( const r of results.sort( ( a, b ) => order( a ).localeCompare( order( b ) ) ) ) {
		const findings = findingsFor( r );
		if ( findings.length ) {
			flagged += 1;
			console.log( `✗ ${ r.path } (${ r.viewport })` );
			findings.forEach( ( f ) => console.log( `    ${ f }` ) );
		}
	}

	const home = results.filter( ( r ) => r.path === entries.find( ( e ) => e.type === 'post' )?.path );
	const sizeFinding = bodySizeFinding( home.length ? home : results.filter( ( r ) => r.path === entries[ 0 ].path ) );
	if ( sizeFinding ) {
		flagged += 1;
		console.log( `✗ ${ sizeFinding }` );
	}

	if ( shots.length ) {
		console.log( `\nSaved ${ shots.length } screenshot tiles to ${ opts.shots } for the review by eye.` );
	}
	if ( flagged ) {
		console.error( `\n${ flagged } of ${ results.length } loads flagged.` );
		process.exit( 1 );
	}
	console.log( `\nAll ${ results.length } loads clean.` );
}

module.exports = { themeFromHtml, parseSitemap, sitemapType, trimArchives, collectPaths, contentCheckFor, findingsFor, bodySizeFinding, parseArgs };

if ( require.main === module ) {
	main().catch( ( error ) => {
		console.error( error.message );
		process.exit( 2 );
	} );
}
