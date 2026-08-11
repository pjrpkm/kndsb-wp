<?php
/**
 * Header data helpers.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

function kndsb_header_logo( $compact = false ) {
	$logo_id      = (int) get_theme_mod( 'custom_logo' );
	$custom_url   = $logo_id ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';
	$desktop_logo = 'https://www.kndsb.nl/wp-content/uploads/website-logo-300x122.png';
	$compact_logo = 'https://www.kndsb.nl/wp-content/uploads/footer_logo-300x122.png';
	$url          = $compact ? $compact_logo : ( $custom_url ?: $desktop_logo );

	return array(
		'url'    => esc_url( $url ),
		'retina' => esc_url( $url ),
		'alt'    => sanitize_text_field( get_bloginfo( 'name' ) ),
	);
}

/**
 * Return the assigned menu as a predictable tree without TagDiv markup.
 */
function kndsb_menu_tree( $location ) {
	$locations = get_nav_menu_locations();
	if ( empty( $locations[ $location ] ) ) {
		return array();
	}

	$items = wp_get_nav_menu_items( $locations[ $location ] );
	if ( ! $items || is_wp_error( $items ) ) {
		return array();
	}

	$children = array();
	foreach ( $items as $item ) {
		$children[ (int) $item->menu_item_parent ][] = $item;
	}

	$build = function ( $parent_id ) use ( &$build, $children ) {
		$branch = array();
		foreach ( $children[ $parent_id ] ?? array() as $item ) {
			$branch[] = array(
				'item'     => $item,
				'children' => $build( (int) $item->ID ),
			);
		}
		return $branch;
	};

	return $build( 0 );
}

function kndsb_header_menu_classes( $classes, $item, $args ) {
	if ( empty( $args->menu_class ) || false === strpos( $args->menu_class, 'kndsb-header__' ) ) {
		return $classes;
	}

	$allowed = array( 'menu-item', 'menu-item-has-children', 'current-menu-item', 'current-menu-ancestor', 'current_page_item' );
	return array_values( array_intersect( $classes, $allowed ) );
}
add_filter( 'nav_menu_css_class', 'kndsb_header_menu_classes', 20, 3 );

function kndsb_header_submenu_classes( $classes, $args ) {
	if ( ! empty( $args->menu_class ) && false !== strpos( $args->menu_class, 'kndsb-header__' ) ) {
		return array( 'kndsb-header__submenu' );
	}

	return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'kndsb_header_submenu_classes', 20, 2 );

function kndsb_header_link_attributes( $atts, $item, $args ) {
	if ( ! empty( $args->menu_class ) && false !== strpos( $args->menu_class, 'kndsb-header__' ) ) {
		unset( $atts['class'] );
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'kndsb_header_link_attributes', 20, 3 );
