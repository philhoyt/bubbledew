# Bubbledew

A whimsical pastel blog theme for the WordPress Site Editor: a narrow two-column feed of tilted cards with name-tag badges, single-column posts with speech-bubble comments, and Fredoka and Nunito bundled as local fonts.

The posts list sits in a 640px column on the left with a 300px sidebar on the right inside a 1080px shell. Templates and parts under `templates/` and `parts/` are thin shells; the block markup lives in PHP patterns under `patterns/` so strings can be translated. Everything is core blocks and `theme.json`. See `CLAUDE.md` for the architecture notes and `readme.txt` for the directory readme.

![Bubbledew home template](screenshot.png)

## Requirements

- WordPress 6.6+
- PHP 7.4+
- Node.js 24
- Composer

## Installation

```bash
npm install
composer install
npm run build
```

Then copy or symlink this folder into `wp-content/themes/bubbledew` and activate **Bubbledew**. `npm run wp-env:start` boots a local site (Docker) with the theme already active, and `npm run seed` fills it with test content.

## Usage

- **Block styles.** Eight ship as JSON partials under `styles/blocks/`: Card, Name tag, Pebble, Pills, Blob bullets, Speech bubble, Sticky note and Highlight. The patterns opt into them; switch any of them off per block from the Styles panel.
- **Presets.** Three colour presets (Sakura, Dusk, Seaside) under `styles/colors/` share the default palette's slugs, and a Nunito typography preset under `styles/typography/` swaps the Fredoka headings. Pick them under Styles in the Site Editor.
- **Sidebar.** A template part on the home, archive and search templates: about card, search, categories, sticky note and archives. Replace the about card's picture and text with your own.
- **Single posts.** Category pills, title, meta row, pebble featured image, content, tags, then an author card, a Keep reading list, previous and next links and the comments.
- **Patterns.** Keep reading, Posts grid, Links in bio and Sticky note are in the inserter.
- **Motion.** Cards tilt and lift on hover, the about card's picture bobs, and pages crossfade in browsers with cross-document view transitions. All of it switches off under the reduced-motion preference.
- **Demo content.** `npm run demo` imports the posts from `.github/demo.xml` into the wp-env site, the same content the Playground blueprint loads.

## Development

| Command                                                    | Purpose                                                                                                                                         |
| ---------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------- |
| `npm run start`                                            | Build `src/` into `dist/` and watch for changes                                                                                                 |
| `npm run build`                                            | Production build                                                                                                                                |
| `npm run lint:js`, `npm run lint:scss`, `npm run lint:php` | ESLint, Stylelint, PHP_CodeSniffer                                                                                                              |
| `composer analyse`                                         | PHPStan                                                                                                                                         |
| `npm run validate:blocks`                                  | Parse patterns, templates and parts with the core block registry                                                                                |
| `npm run test:smoke`, `npm run check:a11y`                 | Templates at desktop and phone widths; axe-core WCAG 2.1 A/AA                                                                                   |
| `npm run review:check`                                     | Theme Check on a `.distignore`-staged copy                                                                                                      |
| `npm run check:contrast`                                   | Every colour preset against the theme's text contrast pairs                                                                                     |
| `npm run demo`                                             | Import the demo posts from `.github/demo.xml` and finish them the way the Playground blueprint does (`-- --clean` resets the wp-env site first) |
| `npm run format`                                           | Prettier                                                                                                                                        |

## Releases

Bump `Version` in `style.css`, `Stable tag` in `readme.txt` and `version` in `package.json` to the same value, add a changelog entry to `readme.txt`, then push a `v`-prefixed tag:

```bash
git tag v1.2.0 && git push origin v1.2.0
```

`.github/workflows/release.yml` checks the tag against those three version strings, builds the theme, stages it through `.distignore`, zips it with a single `bubbledew/` root and attaches `bubbledew.zip` to a GitHub release. The theme directory takes that same zip as a manual upload.

Once a release exists, the theme can be tried in WordPress Playground without installing anything. `.github/blueprint.json` installs the latest release zip, imports the demo posts from `.github/demo.xml` and gives them pastel featured images:

[Open Bubbledew in Playground](https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/philhoyt/bubbledew/main/.github/blueprint.json)

## Limitations

- Badge and pill colours follow a block's position in its list, not its category.
- Squircle corners (`corner-shape`) render in Chromium; other browsers show plain rounded corners.
- No dark colour preset.

## License

GNU General Public License v2 or later.
