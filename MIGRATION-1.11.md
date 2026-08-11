# KNDSB 1.11 — Client First + BEM migration

This release starts the non-breaking architecture migration.

- Client First remains the only owner of page gutters, containers, section spacing and generic grids.
- BEM is the canonical naming system for reusable KNDSB components.
- The Spelers & staf pattern now outputs canonical `kndsb-team-squad__*` classes. Legacy player class aliases remain for saved content.
- Duplicate squad styling was removed from `team-page.css`; the reusable component has one source of truth in `styles/components/team-squad.css`.
- Footer overrides from `style.css` and historical patch layers were consolidated into one BEM component stylesheet.
- Brand orange remains `--kndsb-color-orange: #f37020`.
- Sport Card styling is intentionally untouched.

Next migration rule: move one component at a time; keep a compatibility alias when existing saved Gutenberg markup depends on an old class.


## 1.11.1 Logo grid
- Added reusable `kndsb/logo-grid` and `kndsb/logo-card` Gutenberg blocks.
- Added KNDSB patterns for Sponsoren and Fondsen using the same component.
- Logos preserve their native aspect ratio and are no longer clipped by a square/overflow container.

## 1.11.4
- Sponsor/fund logo cards now use a real 150px image canvas (up to 320px wide) instead of only max-height/max-width constraints, so logos render visibly larger while preserving aspect ratio.
- Reminder: WordPress block patterns are insertion templates. Changes to a registered pattern do not retroactively rewrite blocks already inserted on an existing page; reinsert the Sponsors pattern to receive the new Page Intro block.
