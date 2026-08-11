<?php
/**
 * Keep new editing independent from WPBakery and flag legacy pages.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

/**
 * Determine whether the current page still depends on Newspaper/WPBakery.
 * Clean KNDSB templates must never inherit the parent theme's layout CSS.
 */
function kndsb_is_legacy_newspaper_page() {
	if ( is_home() || is_archive() || is_search() || is_404() ) {
		return true;
	}

	if ( ! is_page() || is_page( array( 'nieuws', 'bestuur-kndsb' ) ) ) {
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

	$page_template = (string) get_page_template_slug( $post );
	$legacy_template = false !== strpos( $page_template, 'pagebuilder' )
		|| false !== strpos( $page_template, 'tagdiv' )
		|| false !== strpos( $page_template, 'td-' );
	$legacy_content = false !== strpos( $content, '[vc_' ) || false !== strpos( $content, '[td_' );

	return $legacy_template || $legacy_content;
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
