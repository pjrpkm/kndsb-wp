<?php
/** @package KNDSB */
defined( 'ABSPATH' ) || exit;
?>
<div class="kndsb-header__mobile-panel" id="kndsb-mobile-panel" hidden>
	<nav class="kndsb-header__mobile-navigation" aria-label="<?php esc_attr_e( 'Mobiele navigatie', 'kndsb' ); ?>">
		<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => false, 'menu_class' => 'kndsb-header__mobile-menu', 'menu_id' => 'kndsb-mobile-menu', 'fallback_cb' => false, 'depth' => 2 ) ); ?>
	</nav>
</div>
