<?php
/**
 * KNDSB Newspaper Child bootstrap.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

define( 'KNDSB_CHILD_VERSION', '1.11.5' );
define( 'KNDSB_CHILD_PATH', trailingslashit( get_stylesheet_directory() ) );
define( 'KNDSB_CHILD_URL', trailingslashit( get_stylesheet_directory_uri() ) );

$kndsb_modules = array(
	'inc/setup.php',
	'inc/header.php',
	'inc/footer.php',
	'inc/assets.php',
	'inc/blocks.php',
	'inc/patterns.php',
	'inc/content-structure.php',
	'inc/legacy.php',
);

foreach ( $kndsb_modules as $kndsb_module ) {
	require_once KNDSB_CHILD_PATH . $kndsb_module;
}


