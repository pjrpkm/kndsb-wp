<?php
/**
 * Dependencies and automatic cache-busting for the layout-section editor script.
 *
 * The script version follows index.js' modification time, so every deployed
 * editor change receives a fresh URL without relying on a hard refresh.
 */

$script_path = __DIR__ . '/index.js';

return array(
	'dependencies' => array(
		'wp-blocks',
		'wp-block-editor',
		'wp-components',
		'wp-element',
		'wp-i18n',
	),
	'version'      => file_exists( $script_path ) ? (string) filemtime( $script_path ) : '1.0.0',
);
