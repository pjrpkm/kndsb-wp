# Phase 1 architecture baseline

This baseline records the repository state before the block-first refactor. It is based on `main` commit `a691c8e` and the target architecture in `docs/architecture-refactor.md`.

Phase 1 deliberately makes no runtime changes. Existing `kndsb/*` block names, `block.json` metadata, BEM classes, classic templates, render callbacks and rendered markup remain unchanged.

## Current-to-target comparison

| Area | Current state | Target direction | Phase 1 action |
|---|---|---|---|
| Theme model | Classic Newspaper child theme with Gutenberg content | Keep the classic child theme; make blocks self-contained | Document only |
| Blocks | 29 flat `blocks/<slug>/` directories | Keep the flat layout and `kndsb/<slug>` identities | Record and verify contracts |
| Block CSS | 23 blocks own `style.css`; board blocks and `page-intro` use external CSS | Block-specific CSS belongs with its block | Defer moves to phase 2 |
| Dynamic rendering | Some blocks use local `render.php`; four callbacks remain in `inc/blocks.php` | Co-locate block-specific renderers | Defer migration |
| Global CSS | Broad global enqueue chain with page and component CSS | Only genuinely global assets remain global | No enqueue or CSS changes |
| Templates | Conventional hierarchy plus aliases/legacy implementations | Preserve hierarchy; audit database assignments before cleanup | Inventory only |
| Legacy | Newspaper/WPBakery compatibility is intentional | Isolate and later conditionally load | Preserve completely |
| Tooling | No repository-level automated contract gate | Add progressive lint, integration and visual checks | Add a non-runtime static check only |

## Gutenberg block contracts

The exact phase 1 `block.json` contents are protected by `docs/block-contracts.sha256`. The static checker also verifies that every folder maps to `kndsb/<folder>` and that every local metadata reference exists.

| Folder / block name | API | Attributes | Assets / renderer |
|---|---:|---|---|
| `board-documents` / `kndsb/board-documents` | 3 | `firstLabel`, `firstUrl`, `secondLabel`, `secondUrl` | `index.js`, `render.php`; CSS external |
| `board-intro` / `kndsb/board-intro` | 3 | `eyebrow`, `intro`, `title` | `index.js`, `render.php`; CSS external |
| `board-member` / `kndsb/board-member` | 3 | `imageId`, `imageUrl`, `name`, `role` | `index.js`, `render.php`; CSS external |
| `board-members` / `kndsb/board-members` | 3 | `title` | `index.js`; CSS external |
| `board-vacancy` / `kndsb/board-vacancy` | 3 | `description`, `imageId`, `imageUrl`, `linkLabel`, `linkUrl`, `role`, `title` | `index.js`, `render.php`; CSS external |
| `featured-grid` / `kndsb/featured-grid` | 2 | `categoryId`, `postsToShow` | `index.js`, `style.css`; callback in `inc/blocks.php` |
| `layout-section` / `kndsb/layout-section` | 2 | `colorScheme`, `containerSize`, `paddingDirection`, `paddingSize`, `sectionName` | `index.js`, `style.css` |
| `logo-card` / `kndsb/logo-card` | 2 | `imageAlt`, `imageId`, `imageUrl`, `name`, `url` | `index.js`, `style.css` |
| `logo-grid` / `kndsb/logo-grid` | 2 | None | `index.js`, `style.css` |
| `match-result` / `kndsb/match-result` | 2 | `awayScore`, `awayTeam`, `date`, `homeScore`, `homeTeam`, `imageAlt`, `imageId`, `imageUrl` | `index.js`, `style.css` |
| `match-results` / `kndsb/match-results` | 2 | `colorScheme`, `title` | `index.js`, `style.css`, `render.php` |
| `news-row` / `kndsb/news-row` | 2 | `accentColor`, `categoryId`, `linkText`, `linkUrl`, `loadMore`, `postOffset`, `postsToShow`, `showExcerpt`, `showReadMore`, `title` | `index.js`, `style.css`, `view.js`; callback in `inc/blocks.php` |
| `page-intro` / `kndsb/page-intro` | 3 | `eyebrow`, `intro`, `title` | `index.js`, `render.php`; CSS external |
| `posts-grid` / `kndsb/posts-grid` | 2 | `categoryId`, `columns`, `postsToShow`, `showDate`, `showExcerpt` | `index.js`, `style.css`; callback in `inc/blocks.php` |
| `section-heading` / `kndsb/section-heading` | 2 | `linkText`, `linkUrl`, `title` | `index.js`, `style.css` |
| `sport-card` / `kndsb/sport-card` | 2 | `imageAlt`, `imageId`, `imageUrl`, `title`, `url` | `index.js`, `style.css` |
| `sport-hero` / `kndsb/sport-hero` | 2 | `imageAlt`, `imageId`, `imageUrl`, `title` | `index.js`, `style.css` |
| `sport-program` / `kndsb/sport-program` | 2 | `buttonText`, `buttonUrl`, `colorScheme`, `title` | `index.js`, `style.css` |
| `sport-section` / `kndsb/sport-section` | 2 | `colorScheme`, `sectionType`, `title` | `index.js`, `style.css` |
| `sports-overview` / `kndsb/sports-overview` | 2 | None | `index.js`, `style.css`, `view.js` |
| `team-card` / `kndsb/team-card` | 2 | `imageAlt`, `imageId`, `imageUrl`, `title`, `url` | `index.js`, `style.css` |
| `team-featured` / `kndsb/team-featured` | 2 | `categoryId` | `index.js`, `style.css`; callback in `inc/blocks.php` |
| `team-hero` / `kndsb/team-hero` | 2 | `contentPosition`, `height`, `imageAlt`, `imageId`, `imageUrl`, `overlayOpacity`, `title` | `index.js`, `style.css`, `render.php` |
| `team-match-list` / `kndsb/team-match-list` | 2 | `mode`, `month`, `title` | `index.js`, `style.css` |
| `team-match` / `kndsb/team-match` | 2 | `awayLogoId`, `awayLogoUrl`, `awayTeam`, `buttonText`, `buttonUrl`, `competition`, `date`, `homeLogoId`, `homeLogoUrl`, `homeTeam`, `score`, `time`, `venue` | `index.js`, `style.css` |
| `team-nav` / `kndsb/team-nav` | 2 | `activeItem`, `baseUrl`, `showInfo`, `showOverview`, `showProgram`, `showResults`, `showSquad` | `index.js`, `style.css`, `view.js` |
| `team-overview` / `kndsb/team-overview` | 2 | `colorScheme`, `title` | `index.js`, `style.css`, `render.php` |
| `team-program-item` / `kndsb/team-program-item` | 2 | `awayLogoAlt`, `awayLogoId`, `awayLogoUrl`, `awayTeam`, `date`, `homeLogoAlt`, `homeLogoId`, `homeLogoUrl`, `homeTeam`, `time`, `url` | `index.js`, `style.css` |
| `team-program` / `kndsb/team-program` | 2 | `buttonText`, `buttonUrl`, `title` | `index.js`, `style.css` |

All blocks also retain their existing `supports` values and attribute definitions/defaults verbatim; the checksum baseline detects any change to them.

## Duplicate and inactive candidates

These files are inventoried, not deleted. “Inactive” means no reference was found in theme-controlled PHP/JS/CSS at this baseline; production database or plugin references remain unknown.

| Candidate | Evidence | Status / risk |
|---|---|---|
| `components/header/mobile-panel.php` | Byte-identical to `template-parts/header/mobile-panel.php`; `header.php` loads the latter | Exact duplicate, apparently inactive |
| `components/header/brand.php` and `navigation.php` | Differ from their `template-parts/header/` counterparts; `header.php` loads `template-parts` | Parallel migration copies; do not delete |
| `styles/components/header.css` | Differs from active `template-parts/header/header.css`; not enqueued by `inc/assets.php` | Apparently inactive migration copy |
| `styles/components/footer.css` | Differs from active `template-parts/footer/footer.css`; not enqueued | Apparently inactive migration copy |
| `styles/templates/home.css` | Differs from active `template-parts/home/home.css`; not enqueued | Apparently inactive migration copy |
| `styles/templates/sport-page.css` | Differs from active `template-parts/sport-page/sport-page.css`; not enqueued | Apparently inactive migration copy |
| `styles/legacy.css` | Differs from active `styles/newspaper-bridge.css`; not enqueued | Legacy consolidation candidate; runtime audit required |
| `nieuws-pagina.php`, `bestuur-pagina.php`, `page-templates/gutenberg.php` | Roles overlap with hierarchy/custom templates | Assignment/content audit required before changes |

No duplicate or questionable legacy file is removed in phase 1.

## Preserved compatibility boundaries

- No file under `blocks/`, `styles/`, `components/`, `template-parts/`, `page-templates/`, `patterns/`, `inc/` or the theme template root is moved or renamed.
- No `block.json`, CSS, JavaScript, PHP runtime file, template or pattern is edited.
- No saved Gutenberg content or WordPress database state is touched.
- Newspaper, TagDiv and WPBakery compatibility remains intact.

Run the baseline check from the repository root:

```bash
./scripts/check-block-contracts.sh
```
