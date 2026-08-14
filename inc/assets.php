<?php
/**
 * Public and editor assets.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

function kndsb_asset_version( $relative_path ) {
	$path = KNDSB_CHILD_PATH . ltrim( $relative_path, '/' );
	return file_exists( $path ) ? (string) filemtime( $path ) : KNDSB_CHILD_VERSION;
}

function kndsb_enqueue_style_file( $handle, $relative_path, $dependencies = array() ) {
	$path = KNDSB_CHILD_PATH . ltrim( $relative_path, '/' );
	if ( ! file_exists( $path ) ) {
		return;
	}

	wp_enqueue_style(
		$handle,
		KNDSB_CHILD_URL . ltrim( $relative_path, '/' ),
		$dependencies,
		kndsb_asset_version( $relative_path )
	);
}

function kndsb_enqueue_assets() {
	$legacy_newspaper_page = function_exists( 'kndsb_is_legacy_newspaper_page' ) && kndsb_is_legacy_newspaper_page();
	$clean_page = ( is_page() || is_front_page() || is_singular( 'post' ) ) && ! $legacy_newspaper_page;
	$wp_styles     = wp_styles();
	$td_theme      = isset( $wp_styles->registered['td-theme'] ) ? $wp_styles->registered['td-theme'] : null;
	$child_css_url = get_stylesheet_uri();

	if ( $clean_page ) {
		wp_dequeue_style( 'td-theme' );
		wp_deregister_style( 'td-theme' );
	} elseif ( $td_theme && $child_css_url === $td_theme->src ) {
		$parent_theme   = wp_get_theme( get_template() );
		$parent_version = $parent_theme->get( 'Version' );

		wp_dequeue_style( 'td-theme' );
		wp_deregister_style( 'td-theme' );
		wp_enqueue_style(
			'td-theme',
			get_template_directory_uri() . '/style.css',
			array(),
			$parent_version
		);
	}

	wp_enqueue_style( 'kndsb-typekit', 'https://use.typekit.net/riw7yqu.css', array(), null );

	$styles = array(
		'kndsb-variables'  => 'styles/variables.css',
		'kndsb-settings'   => 'styles/settings.css',
		'kndsb-reset'      => 'styles/reset.css',
		'kndsb-base'       => 'styles/base.css',
		'kndsb-typography' => 'styles/typography.css',
		'kndsb-client-first' => 'styles/client-first.css',
		'kndsb-utilities'  => 'styles/utilities.css',
		'kndsb-layout'     => 'styles/layout.css',
		'kndsb-newspaper-bridge' => 'styles/newspaper-bridge.css',
		'kndsb-page-intro' => 'blocks/page-intro/style.css',
		'kndsb-home'       => 'template-parts/home/home.css',
		'kndsb-sport-page' => 'template-parts/sport-page/sport-page.css',
		'kndsb-team-page'  => 'template-parts/team-page/team-page.css',
		'kndsb-team-squad' => 'styles/components/team-squad.css',
		'kndsb-news'       => 'template-parts/news/news.css',
		'kndsb-board'      => 'template-parts/organisation/board.css',
		'kndsb-media'      => 'styles/components/media.css',
		'kndsb-header'     => 'template-parts/header/header.css',
		'kndsb-footer'     => 'template-parts/footer/footer.css',
		'kndsb-post-card'  => 'styles/components/post-card.css',
		'kndsb-tables'     => 'styles/components/table.css',
		'kndsb-hero'       => 'styles/components/hero.css',
		'kndsb-buttons'    => 'styles/components/buttons.css',
		'kndsb-article'    => 'styles/components/article.css',
	);
	$dependency = $clean_page ? array( 'kndsb-typekit' ) : array( 'td-theme', 'kndsb-typekit' );

	foreach ( $styles as $handle => $relative_path ) {
		kndsb_enqueue_style_file( $handle, $relative_path, $dependency );
		$dependency = array( $handle );
	}

	wp_enqueue_script(
		'kndsb-header',
		KNDSB_CHILD_URL . 'assets/js/header.js',
		array(),
		kndsb_asset_version( 'assets/js/header.js' ),
		true
	);

	wp_enqueue_script(
		'kndsb-sport-page',
		KNDSB_CHILD_URL . 'assets/js/sport-page.js',
		array(),
		kndsb_asset_version( 'assets/js/sport-page.js' ),
		true
	);

	wp_enqueue_script(
		'kndsb-team-page',
		KNDSB_CHILD_URL . 'assets/js/team-page.js',
		array(),
		kndsb_asset_version( 'assets/js/team-page.js' ),
		true
	);

	if ( is_singular( 'post' ) ) {
		wp_enqueue_script(
			'kndsb-article-share',
			KNDSB_CHILD_URL . 'assets/js/article-share.js',
			array(),
			kndsb_asset_version( 'assets/js/article-share.js' ),
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'kndsb_enqueue_assets', 1100 );

function kndsb_enqueue_editor_assets() {
	wp_enqueue_style( 'kndsb-typekit-editor', 'https://use.typekit.net/riw7yqu.css', array(), null );

	$editor_styles = array(
		'kndsb-variables-editor'    => 'styles/variables.css',
		'kndsb-settings-editor'     => 'styles/settings.css',
		'kndsb-base-editor'         => 'styles/base.css',
		'kndsb-typography-editor'   => 'styles/typography.css',
		'kndsb-client-first-editor' => 'styles/client-first.css',
		'kndsb-utilities-editor'    => 'styles/utilities.css',
		'kndsb-page-intro-editor'   => 'blocks/page-intro/style.css',
		'kndsb-sport-page-editor'   => 'template-parts/sport-page/sport-page.css',
		'kndsb-team-page-editor'    => 'template-parts/team-page/team-page.css',
		'kndsb-team-squad-editor'   => 'styles/components/team-squad.css',
		'kndsb-board-page-editor'   => 'template-parts/organisation/board.css',
		'kndsb-post-card-editor'    => 'styles/components/post-card.css',
		'kndsb-article-editor'      => 'styles/components/article.css',
		/* Must remain last: neutralises frontend full-width breakout inside Gutenberg. */
		'kndsb-editor'              => 'styles/editor.css',
	);
	$dependency = array( 'kndsb-typekit-editor' );
	foreach ( $editor_styles as $handle => $relative_path ) {
		kndsb_enqueue_style_file( $handle, $relative_path, $dependency );
		$dependency = array( $handle );
	}

	wp_enqueue_script(
		'kndsb-editor',
		KNDSB_CHILD_URL . 'assets/js/editor.js',
		array(),
		kndsb_asset_version( 'assets/js/editor.js' ),
		true
	);

}
add_action( 'enqueue_block_editor_assets', 'kndsb_enqueue_editor_assets' );
