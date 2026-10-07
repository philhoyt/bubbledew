# Bubbledew

A custom WordPress Site Editor theme.

A WordPress block theme for the Site Editor. Templates and parts under `templates/` and `parts/` are thin shells; the block markup lives in PHP patterns under `patterns/` so strings can be translated. See `CLAUDE.md` for the architecture notes.

## Requirements

- WordPress 6.6+
- PHP 7.4+
- Node.js 24
- Composer

## Getting started

```bash
npm install
composer install
npm run build
```

Then copy or symlink this folder into `wp-content/themes/bubbledew` and activate **Bubbledew**. `npm run wp-env:start` boots a local site with the theme already active if you prefer not to use an existing install.

## Development

| Command | Purpose |
| --- | --- |
| `npm run start` | Build `src/` into `dist/` and watch for changes |
| `npm run build` | Production build |
| `npm run lint:js`, `npm run lint:scss`, `npm run lint:php` | ESLint, Stylelint, PHP_CodeSniffer |
| `composer analyse` | PHPStan |
| `npm run validate:blocks` | Parse patterns, templates and parts with the core block registry |
| `npm run format` | Prettier |

## Releasing

Bump `Version` in `style.css` and `version` in `package.json` to the same value, then push a tag such as `v1.0.0`. `.github/workflows/release.yml` builds the theme, stages it through `.distignore`, and publishes `bubbledew.zip` on a GitHub release.

Once a release exists, `.github/blueprint.json` can open the theme in WordPress Playground: replace `OWNER/REPO` in its `installTheme` URL with this repository.

## License

GNU General Public License v2 or later.
