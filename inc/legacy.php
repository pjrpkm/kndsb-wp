<?php
/**
 * Keep new editing independent from WPBakery and flag legacy pages.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

/**
 * Newspaper pagebuilder templates may still be stored in _wp_page_template on
 * existing pages. Treat those assignments as obsolete: KNDSB owns the page
 * shell and Gutenberg owns the content.
 */
function kndsb_use_default_page_template( $template ) {
	if ( ! is_page() ) {
		return $template;
	}

	$post = get_queried_object();
	if ( ! $post instanceof WP_Post ) {
		return $template;
	}

	$page_template = (string) get_page_template_slug( $post );
	$is_newspaper_pagebuilder = false !== strpos( $page_template, 'pagebuilder' )
		|| false !== strpos( $page_template, 'tagdiv' )
		|| false !== strpos( $page_template, 'td-' );

	if ( ! $is_newspaper_pagebuilder ) {
		return $template;
	}

	$child_page_template = KNDSB_CHILD_PATH . 'page.php';
	return file_exists( $child_page_template ) ? $child_page_template : $template;
}
add_filter( 'template_include', 'kndsb_use_default_page_template', 999 );

/**
 * Determine whether the current page still contains Newspaper/WPBakery
 * content that needs migration. A legacy template assignment alone no longer
 * makes the frontend legacy because it is routed through page.php above.
 */
function kndsb_is_legacy_newspaper_page() {
	if ( is_home() || is_archive() || is_search() || is_404() ) {
		return true;
	}

	if ( ! is_page() ) {
		return false;
	}

	$post = get_queried_object();
	if ( ! $post instanceof WP_Post ) {
		return false;
	}

	$content = (string) $post->post_content;
	if ( function_exists( 'kndsb_is_sport_content' ) && kndsb_is_sport_content( $content ) ) {
		return false;
	}
	if ( function_exists( 'kndsb_is_team_content' ) && kndsb_is_team_content( $content ) ) {
		return false;
	}
	if ( has_block( 'kndsb/layout-section', $post ) ) {
		return false;
	}

	return false !== strpos( $content, '[vc_' ) || false !== strpos( $content, '[td_' );
}

/**
 * Expose the compatibility state to CSS without leaking Newspaper selectors
 * into clean KNDSB components.
 */
function kndsb_legacy_newspaper_body_class( $classes ) {
	if ( kndsb_is_legacy_newspaper_page() ) {
		$classes[] = 'kndsb-newspaper-legacy';
	}
	return $classes;
}
add_filter( 'body_class', 'kndsb_legacy_newspaper_body_class' );

function kndsb_legacy_admin_notice() {
	$screen = get_current_screen();
	if ( ! $screen || 'page' !== $screen->post_type || 'post' !== $screen->base ) {
		return;
	}

	$post_id = filter_input( INPUT_GET, 'post', FILTER_VALIDATE_INT );
	if ( ! $post_id ) {
		return;
	}

	$content = (string) get_post_field( 'post_content', $post_id );
	if ( false === strpos( $content, '[vc_' ) && false === strpos( $content, '[td_' ) ) {
		return;
	}

	echo '<div class="notice notice-warning"><p>' . esc_html__( 'Deze pagina bevat nog oude builder-shortcodes. Maak een Gutenberg-versie voordat je de oude inhoud verwijdert.', 'kndsb' ) . '</p></div>';
}
add_action( 'admin_notices', 'kndsb_legacy_admin_notice' );
