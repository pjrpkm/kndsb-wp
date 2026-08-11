# KNDSB designsysteem

Dit child theme gebruikt twee lagen die niet door elkaar mogen lopen.

## 1. Client First: globale pagina-opbouw

Client First beheert breedte, horizontale gutters en verticale sectieruimte. Iedere pagina gebruikt zonder uitzondering deze volgorde:

```text
page-wrapper
└── main-wrapper
    └── section_[unieke-naam]
        └── padding-global
            └── container-[size]
                └── padding-section-[size]
                    └── component of inhoud
```

- `.page-wrapper`: buitenste wrapper rond header, main en footer.
- `.main-wrapper`: semantisch `<main>` met uitsluitend unieke pagina-inhoud.
- `section_[unieke-naam]`: herkenbare, unieke sectieclass met underscore.
- `.section`: een schermbrede sectie.
- `.padding-global`: uitsluitend de globale linker- en rechterruimte.
- `.container-small`, `.container-medium`, `.container-large`, `.container-wide`: inhoudsbreedte.
- `.padding-section-none`, `.padding-section-small`, `.padding-section-medium`, `.padding-section-large`: verticale ruimte.
- `.grid-2`, `.grid-3`, `.grid-4`: generieke rasters.

In Gutenberg gebruikt een editor hiervoor **KNDSB layoutsectie**. De editor vult een unieke sectienaam in en kiest achtergrond, container en verticale ruimte. Het blok genereert de volledige vaste hiërarchie. Voeg geen losse pagina-padding toe aan componenten.

## 2. BEM: componenten

Componenten hebben altijd een `kndsb-` namespace:

```css
.kndsb-post-card {}
.kndsb-post-card__title {}
.kndsb-post-card--featured {}
```

Een BEM-component beheert alleen zijn eigen interne presentatie. Een component mag daarom geen viewport-breakout, paginacontainer, globale gutter of sectiemarge instellen.

## Verplichte opbouw

```html
<div class="page-wrapper">
  <main class="main-wrapper">
  <section class="section_sport-program kndsb-layout-section kndsb-layout-section--white">
    <div class="padding-global">
      <div class="container-large">
        <div class="padding-section-medium">
          <!-- BEM-componenten -->
        </div>
      </div>
    </div>
  </section>
  </main>
</div>
```

## Gutenberg en frontend

- Een nieuw blok heeft `block.json`, `index.js`, `index.asset.php` en `style.css`.
- Dezelfde BEM-markup en stylesheet worden in editor en frontend gebruikt.
- Editor-CSS mag alleen WordPress-editorwrappers normaliseren; geen tweede ontwerp maken.
- Instelbare merkvarianten gebruiken uitsluitend de tokens uit `styles/variables.css`.
- Patronelementen worden met het layoutsectieblok opgebouwd, zodat een editor geen classes hoeft te typen.

## Niet toegestaan

- Presentatieselectors van Newspaper, TagDiv, WPBakery of Visual Composer.
- Vaste `1068px`-containers in component-CSS.
- `100vw`/negatieve viewportmarges in componenten.
- Per pagina dezelfde padding opnieuw definiëren.
- Kleuren buiten de centrale variabelen als er al een KNDSB-token bestaat.

## Migratieregel

Oude pagina-inhoud wordt niet stil overschreven. Vervang een oude shortcodepagina door het bijbehorende KNDSB-patroon, controleer editor en frontend, en verwijder daarna pas de oude shortcodes.

Bron voor de core structure: [Finsweet Client-First Core Structure](https://finsweet.com/client-first/docs/core-structure-strategy).


## 3. Reusable component contract (1.11+)

- Canonical component selectors live in `styles/components/` or in the component block's own `style.css`.
- Page styles under `template-parts/*` may compose components, but may not redefine their internals.
- New selectors use BEM: `.kndsb-component`, `.kndsb-component__element`, `.kndsb-component--modifier`.
- Legacy aliases may temporarily remain next to the canonical selector for already-saved Gutenberg content; new patterns must use the canonical BEM class.
- Layout is never encoded in a component. Use `padding-global`, `container-*`, `padding-section-*` and `grid-*`.
- Brand values come from `styles/variables.css`; semantic aliases come from `styles/settings.css`.

### Ownership

```text
styles/variables.css       raw design tokens
styles/settings.css        semantic design tokens
styles/client-first.css    page/layout primitives
styles/utilities.css       single-purpose utilities
styles/components/*        reusable BEM components
template-parts/*/*.css     section/page composition only
blocks/*/style.css         block-specific reusable component CSS
patterns/*.php             composition only; no CSS
```
