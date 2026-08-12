<?php
/**
 * Dependencies for the layout-section editor script.
 *
 * Keep the asset version stable and in sync with the block release. WordPress
 * block registration reads this metadata while registering the editor script;
 * cache invalidation is handled by bumping this value with block changes.
 */
return array(
	'dependencies' => array(
		'wp-blocks',
		'wp-block-editor',
		'wp-components',
		'wp-element',
		'wp-i18n',
	),
	'version' => '1.2.1',
);
