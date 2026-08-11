<?php
/**
 * KNDSB block patterns.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

function kndsb_register_patterns() {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	register_block_pattern_category( 'kndsb', array( 'label' => __( 'KNDSB', 'kndsb' ) ) );

	register_block_pattern(
		'kndsb/hero',
		array(
			'title'      => __( 'KNDSB hero', 'kndsb' ),
			'categories' => array( 'kndsb' ),
			'content'    => '<!-- wp:kndsb/layout-section {"align":"full","sectionName":"hero","colorScheme":"blue","containerSize":"large","paddingSize":"large"} --><section class="wp-block-kndsb-layout-section alignfull section_hero kndsb-layout-section kndsb-layout-section--blue"><div class="padding-global"><div class="container-large"><div class="padding-section-large"><!-- wp:group {"className":"kndsb-hero","layout":{"type":"constrained"}} --><div class="wp-block-group kndsb-hero"><!-- wp:heading {"level":1,"className":"kndsb-hero__title"} --><h1 class="wp-block-heading kndsb-hero__title">Koninklijke Nederlandse Doven Sport Bond</h1><!-- /wp:heading --><!-- wp:paragraph {"className":"kndsb-hero__lead"} --><p class="kndsb-hero__lead">Sport verbindt. Ontdek wedstrijden, teams en het laatste nieuws.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div></div></div></section><!-- /wp:kndsb/layout-section -->',
		)
	);

	// Register the squad pattern explicitly as a fallback for Newspaper child-theme setups
	// where automatic /patterns discovery is not exposed in the inserter.
	if ( ! WP_Block_Patterns_Registry::get_instance()->is_registered( 'kndsb/team-squad' ) ) {
		$pattern_file = KNDSB_CHILD_PATH . 'patterns/team-squad.php';
		if ( file_exists( $pattern_file ) ) {
			ob_start();
			include $pattern_file;
			$pattern_content = ob_get_clean();
			register_block_pattern(
				'kndsb/team-squad',
				array(
					'title'       => __( 'KNDSB spelers en staf', 'kndsb' ),
					'description' => __( 'Teamfoto met bewerkbare spelers- en stafkaarten.', 'kndsb' ),
					'categories'  => array( 'kndsb' ),
					'keywords'    => array( 'spelers', 'staf', 'selectie', 'teamfoto' ),
					'content'     => $pattern_content,
				)
			);
		}
	}

	register_block_pattern(
		'kndsb/sponsors-logo-grid',
		array(
			'title'       => __( 'KNDSB sponsoren – logogrid', 'kndsb' ),
			'description' => __( 'Herbruikbare sectie met sponsoren in de KNDSB logogrid.', 'kndsb' ),
			'categories'  => array( 'kndsb' ),
			'keywords'    => array( 'sponsoren', 'partners', 'logo', 'grid' ),
			'content'     => '<!-- wp:kndsb/layout-section {"align":"full","sectionName":"sponsors","colorScheme":"white","containerSize":"large","paddingSize":"medium"} --><section class="wp-block-kndsb-layout-section alignfull section_sponsors kndsb-layout-section kndsb-layout-section--white"><div class="padding-global"><div class="container-large"><div class="padding-section-medium"><!-- wp:kndsb/page-intro {"eyebrow":"Organisatie","title":"Sponsoren","intro":"Wilt uw bedrijf de Koninklijke Nederlandse Doven Sport Bond ondersteunen? Neem gerust contact op via <a href=\"mailto:office@kndsb.nl\">office@kndsb.nl</a>."} /--><!-- wp:kndsb/section-heading {"title":"Sponsoren die KNDSB steunen"} /--><!-- wp:kndsb/logo-grid --><div class="wp-block-kndsb-logo-grid kndsb-logo-grid"><!-- wp:kndsb/logo-card {"name":"Girl Power Radio","url":"https://www.girlpowerradio.nl","imageUrl":"https://www.kndsb.nl/wp-content/uploads/sponsor-girlpower.jpg","imageAlt":"Girl Power Radio"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.girlpowerradio.nl" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/sponsor-girlpower.jpg" alt="Girl Power Radio" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Bayer Vastgoed","url":"https://www.bayervastgoed.nl/","imageUrl":"https://www.kndsb.nl/wp-content/uploads/bayer-vastgoed.jpg","imageAlt":"Bayer Vastgoed"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.bayervastgoed.nl/" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/bayer-vastgoed.jpg" alt="Bayer Vastgoed" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"ING Nederland","url":"https://www.ing.nl/de-ing/sponsoring","imageUrl":"https://www.kndsb.nl/wp-content/uploads/ing.jpg","imageAlt":"ING Nederland"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.ing.nl/de-ing/sponsoring" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/ing.jpg" alt="ING Nederland" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Jobstap","url":"https://www.jobstap.nl","imageUrl":"https://www.kndsb.nl/wp-content/uploads/sponsor-jobstap.jpg","imageAlt":"Jobstap"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.jobstap.nl" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/sponsor-jobstap.jpg" alt="Jobstap" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Reuzenaar","url":"https://www.reuzenaar.nl","imageUrl":"https://www.kndsb.nl/wp-content/uploads/sponsor-reuzenaar.jpg","imageAlt":"Reuzenaar"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.reuzenaar.nl" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/sponsor-reuzenaar.jpg" alt="Reuzenaar" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Lebo Vastgoed","url":"https://www.lebo.nu","imageUrl":"https://www.kndsb.nl/wp-content/uploads/sponsor-lebo.jpg","imageAlt":"Lebo Vastgoed"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.lebo.nu" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/sponsor-lebo.jpg" alt="Lebo Vastgoed" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"FM Group","url":"https://www.fmgroup.fm/nl/home","imageUrl":"https://www.kndsb.nl/wp-content/uploads/sponsor-fmgroup.jpg","imageAlt":"FM Group"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.fmgroup.fm/nl/home" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/sponsor-fmgroup.jpg" alt="FM Group" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Reggeborgh","url":"https://www.reggeborghfoundation.nl/","imageUrl":"https://www.kndsb.nl/wp-content/uploads/sponsor-reggeborgh.jpg","imageAlt":"Reggeborgh"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.reggeborghfoundation.nl/" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/sponsor-reggeborgh.jpg" alt="Reggeborgh" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Van Raam","url":"https://www.vanraam.com","imageUrl":"https://www.kndsb.nl/wp-content/uploads/sponsor-vanraam.jpg","imageAlt":"Van Raam"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.vanraam.com" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/sponsor-vanraam.jpg" alt="Van Raam" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Phonak","url":"https://www.phonak.com/nl","imageUrl":"https://www.kndsb.nl/wp-content/uploads/sponsor-phonak.jpg","imageAlt":"Phonak"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.phonak.com/nl" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/sponsor-phonak.jpg" alt="Phonak" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"TYD","url":"https://www.tyd.nl/","imageUrl":"https://www.kndsb.nl/wp-content/uploads/sponsor-tyd.jpg","imageAlt":"TYD"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.tyd.nl/" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/sponsor-tyd.jpg" alt="TYD" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Hettema-Service","url":"https://www.hettema-service.nl/","imageUrl":"https://www.kndsb.nl/wp-content/uploads/sponsor-hettema.jpg","imageAlt":"Hettema-Service"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.hettema-service.nl/" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/sponsor-hettema.jpg" alt="Hettema-Service" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --></div><!-- /wp:kndsb/logo-grid --><!-- wp:kndsb/section-heading {"title":"Fondsen die KNDSB steunen"} /--><!-- wp:kndsb/logo-grid --><div class="wp-block-kndsb-logo-grid kndsb-logo-grid"><!-- wp:kndsb/logo-card {"name":"Stichting Mazzel","url":"https://www.stichtingmazzel.nl/","imageUrl":"https://www.kndsb.nl/wp-content/uploads/mazzel.jpg","imageAlt":"Stichting Mazzel"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.stichtingmazzel.nl/" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/mazzel.jpg" alt="Stichting Mazzel" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Stichting Vrienden van Effatha","url":"https://www.vriendeneffatha.nl/","imageUrl":"https://www.kndsb.nl/wp-content/uploads/fonds-svv-effatha.jpg","imageAlt":"Stichting Vrienden van Effatha"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.vriendeneffatha.nl/" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/fonds-svv-effatha.jpg" alt="Stichting Vrienden van Effatha" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Hermusfonds","url":"https://www.kentalis.nl/over-kentalis/over-kentalis/het-hermusfonds","imageUrl":"https://www.kndsb.nl/wp-content/uploads/fonds-hermus.jpg","imageAlt":"Hermusfonds"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.kentalis.nl/over-kentalis/over-kentalis/het-hermusfonds" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/fonds-hermus.jpg" alt="Hermusfonds" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Pasman Stichting","url":"http://www.pasmanstichting.nl/","imageUrl":"https://www.kndsb.nl/wp-content/uploads/fonds-pasman.jpg","imageAlt":"Pasman Stichting"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="http://www.pasmanstichting.nl/" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/fonds-pasman.jpg" alt="Pasman Stichting" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Zabawas","url":"https://www.zabawas.nl","imageUrl":"https://www.kndsb.nl/wp-content/uploads/fonds-zabawas.jpg","imageAlt":"Zabawas"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.zabawas.nl" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/fonds-zabawas.jpg" alt="Zabawas" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Stichting \'t Groenland","url":"","imageUrl":"https://www.kndsb.nl/wp-content/uploads/fonds-groenland.jpg","imageAlt":"Stichting \'t Groenland"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><div class="kndsb-logo-card__link"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/fonds-groenland.jpg" alt="Stichting \'t Groenland" loading="lazy"></div></article><!-- /wp:kndsb/logo-card --></div><!-- /wp:kndsb/logo-grid --></div></div></div></section><!-- /wp:kndsb/layout-section -->',
		)
	);

	register_block_pattern(
		'kndsb/funds-logo-grid',
		array(
			'title'       => __( 'KNDSB fondsen – logogrid', 'kndsb' ),
			'description' => __( 'Herbruikbare sectie met fondsen in dezelfde KNDSB logogrid.', 'kndsb' ),
			'categories'  => array( 'kndsb' ),
			'keywords'    => array( 'fondsen', 'partners', 'logo', 'grid' ),
			'content'     => '<!-- wp:kndsb/layout-section {"align":"full","sectionName":"funds","colorScheme":"white","containerSize":"large","paddingSize":"medium"} --><section class="wp-block-kndsb-layout-section alignfull section_funds kndsb-layout-section kndsb-layout-section--white"><div class="padding-global"><div class="container-large"><div class="padding-section-medium"><!-- wp:kndsb/section-heading {"title":"Fondsen die KNDSB steunen"} /--><!-- wp:kndsb/logo-grid --><div class="wp-block-kndsb-logo-grid kndsb-logo-grid"><!-- wp:kndsb/logo-card {"name":"Stichting Mazzel","url":"https://www.stichtingmazzel.nl/","imageUrl":"https://www.kndsb.nl/wp-content/uploads/mazzel.jpg","imageAlt":"Stichting Mazzel"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.stichtingmazzel.nl/" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/mazzel.jpg" alt="Stichting Mazzel" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Stichting Vrienden van Effatha","url":"https://www.vriendeneffatha.nl/","imageUrl":"https://www.kndsb.nl/wp-content/uploads/fonds-svv-effatha.jpg","imageAlt":"Stichting Vrienden van Effatha"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.vriendeneffatha.nl/" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/fonds-svv-effatha.jpg" alt="Stichting Vrienden van Effatha" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Hermusfonds","url":"https://www.kentalis.nl/over-kentalis/over-kentalis/het-hermusfonds","imageUrl":"https://www.kndsb.nl/wp-content/uploads/fonds-hermus.jpg","imageAlt":"Hermusfonds"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.kentalis.nl/over-kentalis/over-kentalis/het-hermusfonds" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/fonds-hermus.jpg" alt="Hermusfonds" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Pasman Stichting","url":"http://www.pasmanstichting.nl/","imageUrl":"https://www.kndsb.nl/wp-content/uploads/fonds-pasman.jpg","imageAlt":"Pasman Stichting"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="http://www.pasmanstichting.nl/" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/fonds-pasman.jpg" alt="Pasman Stichting" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Zabawas","url":"https://www.zabawas.nl","imageUrl":"https://www.kndsb.nl/wp-content/uploads/fonds-zabawas.jpg","imageAlt":"Zabawas"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><a class="kndsb-logo-card__link" href="https://www.zabawas.nl" target="_blank" rel="noopener noreferrer"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/fonds-zabawas.jpg" alt="Zabawas" loading="lazy"></a></article><!-- /wp:kndsb/logo-card --><!-- wp:kndsb/logo-card {"name":"Stichting \'t Groenland","url":"","imageUrl":"https://www.kndsb.nl/wp-content/uploads/fonds-groenland.jpg","imageAlt":"Stichting \'t Groenland"} --><article class="wp-block-kndsb-logo-card kndsb-logo-card"><div class="kndsb-logo-card__link"><img class="kndsb-logo-card__image" src="https://www.kndsb.nl/wp-content/uploads/fonds-groenland.jpg" alt="Stichting \'t Groenland" loading="lazy"></div></article><!-- /wp:kndsb/logo-card --></div><!-- /wp:kndsb/logo-grid --></div></div></div></section><!-- /wp:kndsb/layout-section -->',
		)
	);

	register_block_pattern(
		'kndsb/news-overview',
		array(
			'title'      => __( 'KNDSB nieuwsoverzicht', 'kndsb' ),
			'categories' => array( 'kndsb' ),
			'content'    => '<!-- wp:kndsb/layout-section {"align":"full","sectionName":"news-overview","colorScheme":"white","containerSize":"large","paddingSize":"medium"} --><section class="wp-block-kndsb-layout-section alignfull section_news-overview kndsb-layout-section kndsb-layout-section--white"><div class="padding-global"><div class="container-large"><div class="padding-section-medium"><!-- wp:kndsb/section-heading {"title":"Laatste nieuws","linkText":"Bekijk al het nieuws","linkUrl":"/nieuws/"} /--><!-- wp:kndsb/posts-grid {"postsToShow":6,"columns":3,"showDate":true,"showExcerpt":false} /--></div></div></div></section><!-- /wp:kndsb/layout-section -->',
		)
	);

	register_block_pattern(
		'kndsb/board-members',
		array(
			'title'       => __( 'Bestuur KNDSB – volledige pagina', 'kndsb' ),
			'description' => __( 'Bewerkbare introductie, bestuursleden en bestuursnieuws.', 'kndsb' ),
			'categories'  => array( 'kndsb' ),
			'content'     => '<!-- wp:kndsb/board-intro /-->

<!-- wp:kndsb/board-members {"title":"Het bestuur"} -->
<div class="wp-block-kndsb-board-members kndsb-board-members"><h2 class="kndsb-board-page__section-title">Het bestuur</h2><div class="kndsb-board-page__grid">
<!-- wp:kndsb/board-member {"name":"Ko ter Linden","role":"Voorzitter","imageUrl":"/wp-content/uploads/koterlinden-1-2-scaled.jpg"} /-->
<!-- wp:kndsb/board-member {"name":"Wietse Sijm","role":"Bestuurslid sportzaken","imageUrl":"/wp-content/uploads/1764336903669.jpeg"} /-->
<!-- wp:kndsb/board-member {"name":"Johan Hessing","role":"Penningmeester bij volmacht","imageUrl":"/wp-content/uploads/Johan-Hessing-2-e1774818337924.jpg"} /-->
</div></div>
<!-- /wp:kndsb/board-members -->

<!-- wp:kndsb/board-documents /-->

<!-- wp:kndsb/news-row {"title":"Bestuursnieuws","categoryId":7,"postsToShow":3,"showExcerpt":true,"showReadMore":true,"loadMore":false} /-->',
		)
	);

	register_block_pattern(
		'kndsb/sports-overview',
		array(
			'title'       => __( 'KNDSB sporttakkenpagina', 'kndsb' ),
			'description' => __( 'Introductie en overzicht binnen de vaste Client-First-hiërarchie.', 'kndsb' ),
			'categories'  => array( 'kndsb' ),
			'content'     => '<!-- wp:kndsb/layout-section {"align":"full","sectionName":"sports-overview","colorScheme":"white","containerSize":"large","paddingSize":"none"} --><section class="wp-block-kndsb-layout-section alignfull section_sports-overview kndsb-layout-section kndsb-layout-section--white"><div class="padding-global"><div class="container-large"><div class="padding-section-none"><!-- wp:group {"className":"kndsb-sports-intro","layout":{"type":"default"}} --><div class="wp-block-group kndsb-sports-intro"><!-- wp:heading {"level":1} --><h1 class="wp-block-heading">Sporttakken</h1><!-- /wp:heading --><!-- wp:paragraph --><p>De KNDSB biedt verschillende sporttakken aan. Bekijk het aanbod en kies een sport voor meer informatie.</p><!-- /wp:paragraph --></div><!-- /wp:group --><!-- wp:kndsb/sports-overview /--></div></div></div></section><!-- /wp:kndsb/layout-section -->',
		)
	);

	$home_sections = array(
		array( 'home-featured', 'medium', '<!-- wp:kndsb/featured-grid {"categoryId":5,"postsToShow":4} /-->' ),
		array( 'home-latest-news', 'medium', '<!-- wp:kndsb/news-row {"title":"Laatste nieuws","accentColor":"var(--kndsb-color-orange)","categoryId":4,"postsToShow":4,"showExcerpt":true,"showReadMore":true,"loadMore":true} /-->' ),
		array( 'home-board', 'medium', '<!-- wp:kndsb/news-row {"title":"BESTUUR","accentColor":"#e63328","categoryId":7,"postsToShow":4,"showExcerpt":true,"showReadMore":true,"loadMore":true} /-->' ),
		array( 'home-deaflympics', 'medium', '<!-- wp:kndsb/news-row {"title":"DEAFLYMPICS","accentColor":"#004a99","categoryId":6,"postsToShow":4,"showExcerpt":true,"showReadMore":true,"loadMore":true} /-->' ),
	);
	$home_content = '';
	foreach ( $home_sections as $home_section ) {
		$home_content .= sprintf(
			'<!-- wp:kndsb/layout-section {"align":"full","sectionName":"%1$s","colorScheme":"white","containerSize":"large","paddingSize":"%2$s"} --><section class="wp-block-kndsb-layout-section alignfull section_%1$s kndsb-layout-section kndsb-layout-section--white"><div class="padding-global"><div class="container-large"><div class="padding-section-%2$s">%3$s</div></div></div></section><!-- /wp:kndsb/layout-section -->',
			esc_attr( $home_section[0] ),
			esc_attr( $home_section[1] ),
			$home_section[2]
		);
	}

	register_block_pattern(
		'kndsb/homepage',
		array(
			'title'       => __( 'KNDSB homepage', 'kndsb' ),
			'description' => __( 'Volledige Gutenberg-homepage met vaste Client-First-secties.', 'kndsb' ),
			'categories'  => array( 'kndsb' ),
			'content'     => $home_content,
		)
	);
}
add_action( 'init', 'kndsb_register_patterns' );
