<?php
/**
 * Footer data helpers.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

function kndsb_footer_logo() {
	$custom_url = trim( (string) get_option( 'kndsb_footer_logo_url', '' ) );
	$url        = $custom_url ?: 'https://www.kndsb.nl/wp-content/uploads/footer_logo.png';

	return array(
		'url'    => esc_url( $url ),
		'retina' => esc_url( $url ),
		'alt'    => sanitize_text_field( get_bloginfo( 'name' ) ),
	);
}

function kndsb_footer_copyright() {
	$copyright = wp_strip_all_tags( stripslashes( (string) get_option( 'kndsb_footer_copyright', '' ) ) );
	return $copyright ? $copyright : sprintf( __( 'Copyright %1$s %2$s. Alle rechten voorbehouden.', 'kndsb' ), wp_date( 'Y' ), get_bloginfo( 'name' ) );
}
