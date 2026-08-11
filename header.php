<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>
<div class="page-wrapper kndsb-site-shell">
		<header class="kndsb-header" data-kndsb-header>
			<?php get_template_part( 'template-parts/header/brand' ); ?>
			<?php get_template_part( 'template-parts/header/navigation' ); ?>
			<?php get_template_part( 'template-parts/header/mobile-panel' ); ?>
		</header>
