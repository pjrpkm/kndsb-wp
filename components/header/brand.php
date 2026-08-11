<?php
/** @package KNDSB */
defined( 'ABSPATH' ) || exit;
$logo = kndsb_header_logo();
?>
<div class="kndsb-header__brand">
	<a class="kndsb-header__brand-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<?php if ( $logo['url'] ) : ?>
			<img class="kndsb-header__brand-image" src="<?php echo esc_url( $logo['url'] ); ?>"<?php echo $logo['retina'] ? ' srcset="' . esc_url( $logo['retina'] ) . ' 2x"' : ''; ?> alt="<?php echo esc_attr( $logo['alt'] ); ?>">
		<?php else : ?>
			<span class="kndsb-header__brand-name"><?php bloginfo( 'name' ); ?></span>
		<?php endif; ?>
	</a>
</div>
