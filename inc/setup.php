<?php
/**
 * Theme supports and editor defaults.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

function kndsb_child_setup() {
	load_child_theme_textdomain( 'kndsb', KNDSB_CHILD_PATH . 'languages' );

	add_theme_support( 'align-wide' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'custom-line-height' );
	add_theme_support( 'custom-spacing' );
	add_theme_support( 'appearance-tools' );
	add_editor_style( 'styles/editor.css' );

	register_nav_menus(
		array(
			'kndsb_footer' => __( 'KNDSB footer', 'kndsb' ),
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'KNDSB footer certificeringen', 'kndsb' ),
			'id'            => 'kndsb-footer-certifications',
			'description'   => __( 'Logo’s en certificeringen in de KNDSB-footer.', 'kndsb' ),
			'before_widget' => '<div id="%1$s" class="kndsb-footer__widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="kndsb-footer__widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'after_setup_theme', 'kndsb_child_setup', 20 );

function kndsb_body_classes( $classes ) {
	$classes[] = 'kndsb-site';

	if ( is_singular( 'post' ) ) {
		$classes[] = 'kndsb-single-article';
	}

	if ( is_page() ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			if ( kndsb_is_team_content( $post->post_content ) ) {
				$classes[] = 'kndsb-team-page-view';
			} elseif ( kndsb_is_sport_content( $post->post_content ) ) {
				$classes[] = 'kndsb-sport-page-view';
			}
		}
	}

	return $classes;
}
add_filter( 'body_class', 'kndsb_body_classes' );

function kndsb_is_sport_content( $content ) {
	$content = (string) $content;
	return false !== strpos( $content, 'kndsb-sport-page' )
		|| false !== strpos( $content, 'wp:kndsb/sport-' )
		|| false !== strpos( $content, 'wp:kndsb/sports-overview' )
		|| false !== strpos( $content, 'wp:kndsb/team-overview' );
}

/**
 * Detect every page that belongs to a KNDSB team mini-site.
 * Individual child pages no longer need the old wrapper group to receive the
 * clean team template.
 */
function kndsb_is_team_content( $content ) {
	$content = (string) $content;
	$markers = array(
		'kndsb-team-page',
		'wp:kndsb/team-hero',
		'wp:kndsb/team-nav',
		'wp:kndsb/team-match-list',
		'wp:kndsb/team-program',
		'wp:kndsb/match-results',
	);

	foreach ( $markers as $marker ) {
		if ( false !== strpos( $content, $marker ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Use the clean BEM page shell for individual sport pages.
 * This removes all Newspaper content wrappers from those pages.
 */
function kndsb_sport_page_template( $template ) {
	if ( ! is_page() ) {
		return $template;
	}

	$post = get_queried_object();
	if ( ! $post instanceof WP_Post || ! kndsb_is_sport_content( $post->post_content ) ) {
		return $template;
	}

	$sport_template = KNDSB_CHILD_PATH . 'page-templates/sport.php';
	return file_exists( $sport_template ) ? $sport_template : $template;
}
add_filter( 'template_include', 'kndsb_sport_page_template', 99 );

function kndsb_team_page_template( $template ) {
	if ( ! is_page() ) {
		return $template;
	}

	$post = get_queried_object();
	if ( ! $post instanceof WP_Post || ! kndsb_is_team_content( $post->post_content ) ) {
		return $template;
	}

	$team_template = KNDSB_CHILD_PATH . 'page-templates/team.php';
	return file_exists( $team_template ) ? $team_template : $template;
}
add_filter( 'template_include', 'kndsb_team_page_template', 100 );

/**
 * Always use the clean KNDSB news template for /nieuws.
 *
 * The existing WordPress page has a Newspaper page-builder template stored in
 * its metadata. A selected custom template takes precedence over page-nieuws.php
 * in WordPress' normal hierarchy, so resolve the child template explicitly.
 */
function kndsb_news_page_template( $template ) {
	if ( ! is_page( 'nieuws' ) ) {
		return $template;
	}

	$news_template = KNDSB_CHILD_PATH . 'nieuws-pagina.php';
	return file_exists( $news_template ) ? $news_template : $template;
}
add_filter( 'template_include', 'kndsb_news_page_template', 101 );

/**
 * Replace the legacy Newspaper/WPBakery board page with its clean KNDSB shell.
 */
function kndsb_board_page_template( $template ) {
	if ( ! is_page( 'bestuur-kndsb' ) ) {
		return $template;
	}

	$board_template = KNDSB_CHILD_PATH . 'bestuur-pagina.php';
	return file_exists( $board_template ) ? $board_template : $template;
}
add_filter( 'template_include', 'kndsb_board_page_template', 102 );


/**
 * Force /sponsoren through the clean Gutenberg shell.
 *
 * The live sponsors page still has a legacy Newspaper/tagDiv page-builder
 * template assigned in post meta. That custom template wins over page.php and
 * adds the old breadcrumb/title wrappers. Resolve the child template late so
 * the page consists only of the KNDSB header, Gutenberg components and footer.
 */
function kndsb_sponsors_page_template( $template ) {
	if ( ! is_page( 'sponsoren' ) ) {
		return $template;
	}

	$sponsors_template = KNDSB_CHILD_PATH . 'page-sponsoren.php';
	return file_exists( $sponsors_template ) ? $sponsors_template : $template;
}
add_filter( 'template_include', 'kndsb_sponsors_page_template', 103 );

/**
 * Force single news posts through the clean KNDSB article template.
 *
 * Newspaper/tagDiv can replace the normal WordPress single template late in
 * the template-loading process. Relying on the child theme hierarchy alone is
 * therefore not sufficient. Resolve the child template explicitly at a very
 * late priority so the article markup and its BEM component styles always
 * match.
 */
function kndsb_single_post_template( $template ) {
	if ( ! is_singular( 'post' ) ) {
		return $template;
	}

	$single_template = KNDSB_CHILD_PATH . 'single.php';
	return file_exists( $single_template ) ? $single_template : $template;
}
add_filter( 'template_include', 'kndsb_single_post_template', PHP_INT_MAX );

/**
 * Warn administrators when the parent version differs from the tested release.
 * A child theme prevents overwrites, but cannot guarantee API compatibility.
 */
function kndsb_parent_version_notice() {
	if ( ! current_user_can( 'update_themes' ) ) {
		return;
	}

	$parent         = wp_get_theme( get_template() );
	$parent_version = $parent->get( 'Version' );
	$tested_version = '6.7.2';

	if ( $parent_version === $tested_version ) {
		return;
	}

	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html(
			sprintf(
				/* translators: 1: installed parent version, 2: tested parent version. */
				__( 'KNDSB Child draait met Newspaper %1$s; deze release is getest met %2$s. Controleer templates en blokken eerst op staging.', 'kndsb' ),
				$parent_version,
				$tested_version
			)
		)
	);
}
add_action( 'admin_notices', 'kndsb_parent_version_notice' );
