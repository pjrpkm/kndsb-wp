<?php
/**
 * Title: KNDSB spelers en staf
 * Slug: kndsb/team-squad
 * Description: Aparte teampagina met teamfoto en bewerkbare spelers- en stafkaarten.
 * Categories: kndsb
 * Keywords: spelers, staf, selectie, teamfoto
 * Inserter: true
 */
$squad_placeholder = esc_url( get_stylesheet_directory_uri() . '/assets/images/sport-hero-placeholder.svg' );
?>
<!-- wp:kndsb/layout-section {"align":"full","sectionName":"team-squad-hero","colorScheme":"white","containerSize":"wide","paddingSize":"none"} -->
<section class="wp-block-kndsb-layout-section alignfull section_team-squad-hero kndsb-layout-section kndsb-layout-section--white"><div class="padding-global"><div class="container-wide"><div class="padding-section-none"><!-- wp:kndsb/team-hero {"title":"Spelers & staf","imageUrl":"<?php echo $squad_placeholder; ?>","imageAlt":"Teamfoto","overlayOpacity":25,"contentPosition":"center","className":"kndsb-team-squad__hero"} /--></div></div></div></section>
<!-- /wp:kndsb/layout-section -->

<!-- wp:kndsb/layout-section {"align":"full","sectionName":"team-squad","colorScheme":"white","containerSize":"large","paddingSize":"large"} -->
<section class="wp-block-kndsb-layout-section alignfull section_team-squad kndsb-layout-section kndsb-layout-section--white"><div class="padding-global"><div class="container-large"><div class="padding-section-large">

<!-- wp:group {"className":"kndsb-team-squad__section","layout":{"type":"default"}} -->
<div class="wp-block-group kndsb-team-squad__section">
<!-- wp:heading {"level":2,"className":"kndsb-team-squad__heading"} --><h2 class="wp-block-heading kndsb-team-squad__heading">Keepers</h2><!-- /wp:heading -->
<!-- wp:columns {"className":"kndsb-team-squad__grid"} --><div class="wp-block-columns kndsb-team-squad__grid">
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"kndsb-team-squad__card","layout":{"type":"default"}} --><div class="wp-block-group kndsb-team-squad__card"><!-- wp:image {"sizeSlug":"large"} --><figure class="wp-block-image size-large"><img src="<?php echo $squad_placeholder; ?>" alt="Portret speler"/></figure><!-- /wp:image --><!-- wp:heading {"level":3,"className":"kndsb-team-squad__name"} --><h3 class="wp-block-heading kndsb-team-squad__name">Voornaam Achternaam</h3><!-- /wp:heading --><!-- wp:paragraph {"className":"kndsb-team-squad__role"} --><p class="kndsb-team-squad__role">Keeper</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
</div><!-- /wp:columns -->

<!-- wp:heading {"level":2,"className":"kndsb-team-squad__heading"} --><h2 class="wp-block-heading kndsb-team-squad__heading">Veldspelers</h2><!-- /wp:heading -->
<!-- wp:columns {"className":"kndsb-team-squad__grid"} --><div class="wp-block-columns kndsb-team-squad__grid">
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"kndsb-team-squad__card","layout":{"type":"default"}} --><div class="wp-block-group kndsb-team-squad__card"><!-- wp:image {"sizeSlug":"large"} --><figure class="wp-block-image size-large"><img src="<?php echo $squad_placeholder; ?>" alt="Portret speler"/></figure><!-- /wp:image --><!-- wp:heading {"level":3,"className":"kndsb-team-squad__name"} --><h3 class="wp-block-heading kndsb-team-squad__name">Voornaam Achternaam</h3><!-- /wp:heading --><!-- wp:paragraph {"className":"kndsb-team-squad__role"} --><p class="kndsb-team-squad__role">Veldspeler</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
</div><!-- /wp:columns -->

<!-- wp:heading {"level":2,"className":"kndsb-team-squad__heading"} --><h2 class="wp-block-heading kndsb-team-squad__heading">Staf</h2><!-- /wp:heading -->
<!-- wp:columns {"className":"kndsb-team-squad__grid"} --><div class="wp-block-columns kndsb-team-squad__grid">
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"kndsb-team-squad__card","layout":{"type":"default"}} --><div class="wp-block-group kndsb-team-squad__card"><!-- wp:image {"sizeSlug":"large"} --><figure class="wp-block-image size-large"><img src="<?php echo $squad_placeholder; ?>" alt="Portret staflid"/></figure><!-- /wp:image --><!-- wp:heading {"level":3,"className":"kndsb-team-squad__name"} --><h3 class="wp-block-heading kndsb-team-squad__name">Voornaam Achternaam</h3><!-- /wp:heading --><!-- wp:paragraph {"className":"kndsb-team-squad__role"} --><p class="kndsb-team-squad__role">Bondscoach</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
</div><!-- /wp:columns -->
</div><!-- /wp:group -->

</div></div></div></section>
<!-- /wp:kndsb/layout-section -->
