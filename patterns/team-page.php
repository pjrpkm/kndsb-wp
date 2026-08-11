<?php
/**
 * Title: KNDSB teamsite
 * Slug: kndsb/team-page
 * Description: Teamsite volgens de vaste Client-First-hiërarchie.
 * Categories: kndsb
 * Keywords: team, futsal, programma, uitslagen, spelers
 * Inserter: true
 */
$team_placeholder = esc_url( get_stylesheet_directory_uri() . '/assets/images/sport-hero-placeholder.svg' );
?>
<!-- wp:kndsb/layout-section {"align":"full","sectionName":"team-hero","colorScheme":"white","containerSize":"wide","paddingSize":"none"} -->
<section class="wp-block-kndsb-layout-section alignfull section_team-hero kndsb-layout-section kndsb-layout-section--white"><div class="padding-global"><div class="container-wide"><div class="padding-section-none"><!-- wp:kndsb/team-hero {"title":"Oranje Doven Futsal O18","imageUrl":"<?php echo $team_placeholder; ?>","imageAlt":"Kies een teamfoto","contentPosition":"center"} /--></div></div></div></section>
<!-- /wp:kndsb/layout-section -->

<!-- wp:kndsb/layout-section {"align":"full","sectionName":"team-navigation","colorScheme":"blue","containerSize":"wide","paddingSize":"none"} -->
<section class="wp-block-kndsb-layout-section alignfull section_team-navigation kndsb-layout-section kndsb-layout-section--blue"><div class="padding-global"><div class="container-wide"><div class="padding-section-none"><!-- wp:kndsb/team-nav {"baseUrl":"/sporttakken/futsal/o18/","activeItem":"overview"} --><div class="wp-block-kndsb-team-nav kndsb-team-page__nav"><nav><ul class="kndsb-team-page__nav-list"><li class="is-active"><a href="/sporttakken/futsal/o18/overzicht/" aria-current="page">Overzicht</a></li><li><a href="/sporttakken/futsal/o18/programma/">Programma</a></li><li><a href="/sporttakken/futsal/o18/uitslagen/">Uitslagen</a></li><li><a href="/sporttakken/futsal/o18/spelers-staf/">Spelers &amp; staf</a></li><li><a href="/sporttakken/futsal/o18/info/">Info</a></li></ul></nav></div><!-- /wp:kndsb/team-nav --></div></div></div></section>
<!-- /wp:kndsb/layout-section -->

<!-- wp:kndsb/layout-section {"align":"full","sectionName":"team-featured","colorScheme":"orange","containerSize":"large","paddingSize":"small","paddingDirection":"top"} -->
<section class="wp-block-kndsb-layout-section alignfull section_team-featured kndsb-layout-section kndsb-layout-section--orange"><div class="padding-global"><div class="container-large"><div class="padding-section-small padding-top-only"><!-- wp:columns {"className":"kndsb-team-page__match-grid"} --><div class="wp-block-columns kndsb-team-page__match-grid"><!-- wp:column {"width":"64%"} --><div class="wp-block-column" style="flex-basis:64%"><!-- wp:kndsb/team-featured {"categoryId":0} /--></div><!-- /wp:column --><!-- wp:column {"width":"36%"} --><div class="wp-block-column" style="flex-basis:36%"><!-- wp:kndsb/team-program /--></div><!-- /wp:column --></div><!-- /wp:columns --></div></div></div></section>
<!-- /wp:kndsb/layout-section -->

<!-- wp:kndsb/layout-section {"align":"full","sectionName":"team-news","colorScheme":"blue","containerSize":"large","paddingSize":"medium"} -->
<section class="wp-block-kndsb-layout-section alignfull section_team-news kndsb-layout-section kndsb-layout-section--blue"><div class="padding-global"><div class="container-large"><div class="padding-section-medium kndsb-team-page__news"><!-- wp:heading {"level":2,"className":"kndsb-team-page__section-title"} --><h2 class="wp-block-heading kndsb-team-page__section-title">Teamnieuws</h2><!-- /wp:heading --><!-- wp:kndsb/news-row {"title":"Teamnieuws","categoryId":0,"postsToShow":3,"postOffset":1,"showExcerpt":true,"showReadMore":true,"loadMore":false} /--></div></div></div></section>
<!-- /wp:kndsb/layout-section -->

<!-- wp:kndsb/match-results {"title":"Uitslagen","colorScheme":"orange","align":"full"} /-->

<!-- wp:kndsb/layout-section {"align":"full","sectionName":"team-info","colorScheme":"white","containerSize":"large","paddingSize":"medium"} -->
<section class="wp-block-kndsb-layout-section alignfull section_team-info kndsb-layout-section kndsb-layout-section--white"><div class="padding-global"><div class="container-large"><div class="padding-section-medium"><!-- wp:columns {"className":"kndsb-team-page__content-grid"} --><div class="wp-block-columns kndsb-team-page__content-grid"><!-- wp:column --><div class="wp-block-column"><!-- wp:group {"anchor":"info","className":"kndsb-team-page__content-card"} --><div id="info" class="wp-block-group kndsb-team-page__content-card"><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">Teaminfo</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Contactgegevens, downloads en praktische informatie.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"kndsb-team-page__content-card"} --><div class="wp-block-group kndsb-team-page__content-card"><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">Over het team</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Informatie over selectie, begeleiding en doelstellingen.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div></div></section>
<!-- /wp:kndsb/layout-section -->
