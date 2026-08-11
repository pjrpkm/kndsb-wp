# KNDSB Newspaper Child

Een modulair WordPress-childtheme voor KNDSB. Nieuwe pagina’s gebruiken native Gutenberg, een Client-First-layoutlaag en BEM-componenten. Visual Composer, TagDiv-markup en Newspaper-presentatie zijn niet nodig voor gemigreerde pagina’s.

## Installatie

1. Laat het parent theme in de map `Newspaper` staan.
2. Upload en activeer dit childtheme.
3. Stel via WordPress een kernlogo en de menuplaatsen in.
4. Vervang oude shortcode-inhoud pagina voor pagina door de KNDSB-patronen.
5. Controleer de pagina in Gutenberg én aan de voorkant voordat de shortcodes worden verwijderd.

## Architectuur

- `styles/variables.css`: merk-, maat- en spacingtokens.
- `styles/client-first.css`: globale containers, gutters, sectieruimte en grids.
- `styles/utilities.css`: kleine, generieke helpers.
- `blocks/`: native Gutenberg-blokken; elk blok bevat eigen metadata, gedrag en BEM-styling.
- `template-parts/`: header, footer en paginacomponenten met bijbehorende CSS.
- `patterns/`: volledige, handmatig invoegbare paginastarters.
- `inc/`: registratie, assets, WordPress-data en migratiecontrole.
- `DESIGN-SYSTEM.md`: bindende ontwikkelregels voor vervolgwerk.

## Belangrijkste editorblok

**KNDSB layoutsectie** beheert voor iedere sectie:

- een verplichte unieke `section_[naam]`-class;
- achtergrond: wit, gebroken blauw-wit, blauw, oranje of rood;
- container: klein, middel, groot of breed;
- verticale ruimte: geen, klein, middel of groot.

Hierdoor hoeven editors geen classes of losse padding in te voeren. Het blok genereert altijd `section_ → padding-global → container-* → padding-section-* → content`. Componentblokken bepalen alleen hun eigen interne uiterlijk.

## Beschikbare paginapatronen

- KNDSB homepage
- KNDSB sporttakkenoverzicht
- KNDSB sporttakpagina
- KNDSB teamsite
- KNDSB spelers en staf

Patronen zijn uitgangspunten, geen gesynchroniseerde inhoud. Een editor kan onderdelen per sport of team verwijderen, verplaatsen en aanvullen.

## Updatebescherming

Eigen templates, PHP, CSS en blokken staan in het childtheme en worden niet overschreven door een Newspaper-update. Niet-gemigreerde berichten en archieven mogen tijdens de overgang nog de parent-stylesheet gebruiken. Schone pagina’s en de homepage krijgen uitsluitend het KNDSB-systeem.

## Ontwikkelregel

Client First bepaalt de pagina-opbouw; BEM bepaalt componenten. Voeg nooit vaste paginabreedtes, viewport-breakouts of globale pagina-padding toe aan een component. Zie [DESIGN-SYSTEM.md](DESIGN-SYSTEM.md).
