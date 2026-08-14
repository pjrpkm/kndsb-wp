<?php
/**
 * Runtime Client-First bridge for KNDSB sections saved before the new system.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

/**
 * Force the modern child-theme template for the legacy Documenten page.
 *
 * The page still has Newspaper's page-pagebuilder-title.php stored as its
 * assigned template. An explicitly assigned page template takes precedence
 * over page-{slug}.php in WordPress, so page-documenten.php would otherwise
 * never be selected until the page setting is manually changed.
 */
function kndsb_documents_page_template( $template ) {
	if ( is_page( 'documenten' ) ) {
		$documents_template = KNDSB_CHILD_PATH . 'page-documenten.php';
		if ( file_exists( $documents_template ) ) {
			return $documents_template;
		}
	}

	return $template;
}
add_filter( 'template_include', 'kndsb_documents_page_template', 99 );

/**
 * Replace an old outer Group wrapper with the fixed Client-First hierarchy.
 */
function kndsb_wrap_legacy_sport_section( $block_content, $block ) {
	if ( false !== strpos( $block_content, 'section_sport-' ) || false !== strpos( $block_content, 'section_team-' ) ) {
		return $block_content;
	}

	$class_name = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
	$config = null;
	if ( false !== strpos( $class_name, 'kndsb-sport-page__main-sponsor' ) ) {
		$config = array(
			'section'   => 'sport-sponsors',
			'scheme'    => 'blue-white',
			'padding'   => 'medium',
			'component' => 'kndsb-sport-page__main-sponsor',
		);
	} elseif ( false !== strpos( $class_name, 'kndsb-sport-page__partners' ) ) {
		$config = array(
			'section'   => 'sport-partners',
			'scheme'    => 'red',
			'padding'   => 'small',
			'component' => 'kndsb-sport-page__partners',
		);
	} elseif ( false !== strpos( $class_name, 'kndsb-team-page__match-zone' ) ) {
		$config = array(
			'section'   => 'team-featured',
			'scheme'    => 'orange',
			'padding'   => 'small',
			'modifier'  => ' padding-top-only',
			'component' => 'kndsb-team-page__section kndsb-team-page__match-zone',
		);
	} elseif ( false !== strpos( $class_name, 'kndsb-team-page__news' ) ) {
		$config = array(
			'section'   => 'team-news',
			'scheme'    => 'blue',
			'padding'   => 'medium',
			'component' => 'kndsb-team-page__section kndsb-team-page__news',
		);
	}

	if ( ! $config ) {
		return $block_content;
	}

	$open_end  = strpos( $block_content, '>' );
	$close_pos = strrpos( $block_content, '</div>' );
	if ( false === $open_end || false === $close_pos || $close_pos <= $open_end ) {
		return $block_content;
	}

	$inner = substr( $block_content, $open_end + 1, $close_pos - $open_end - 1 );

	$anchor = isset( $block['attrs']['anchor'] ) ? sanitize_title( $block['attrs']['anchor'] ) : '';
	$id     = $anchor ? ' id="' . esc_attr( $anchor ) . '"' : '';
	$modifier = isset( $config['modifier'] ) ? $config['modifier'] : '';

	return sprintf(
		'<section class="alignfull section_%1$s kndsb-layout-section kndsb-layout-section--%2$s"><div class="padding-global"><div class="container-large"><div class="padding-section-%3$s%7$s"><div%6$s class="%4$s">%5$s</div></div></div></div></section>',
		esc_attr( $config['section'] ),
		esc_attr( $config['scheme'] ),
		esc_attr( $config['padding'] ),
		esc_attr( $config['component'] ),
		$inner,
		$id,
		esc_attr( $modifier )
	);
}
add_filter( 'render_block_core/group', 'kndsb_wrap_legacy_sport_section', 20, 2 );

/**
 * Keep the Sporttakken overview flush between adjacent full-width sections.
 * This also updates blocks that were saved before the padding setting changed.
 */
function kndsb_sports_overview_section_padding( $block_content, $block ) {
	$class_name = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
	if ( false === strpos( $class_name, 'section_sports-overview' ) ) {
		return $block_content;
	}

	return str_replace(
		array( 'padding-section-small', 'padding-section-medium', 'padding-section-large' ),
		'padding-section-none',
		$block_content
	);
}
add_filter( 'render_block_kndsb/layout-section', 'kndsb_sports_overview_section_padding', 20, 2 );
