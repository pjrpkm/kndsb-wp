<?php
/** @package KNDSB */
defined( 'ABSPATH' ) || exit;
$socials = kndsb_social_links();
?>
<div class="kndsb-header__utility">
	<div class="kndsb-header__utility-inner">
		<time class="kndsb-header__date" datetime="<?php echo esc_attr( wp_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( wp_date( 'l j F Y' ) ); ?></time>
		<nav class="kndsb-header__secondary" aria-label="<?php esc_attr_e( 'Secundaire navigatie', 'kndsb' ); ?>">
			<?php wp_nav_menu( array( 'theme_location' => 'top-menu', 'container' => false, 'menu_class' => 'kndsb-header__secondary-menu', 'fallback_cb' => false, 'depth' => 1 ) ); ?>
		</nav>
		<?php if ( $socials ) : ?>
			<div class="kndsb-header__socials" aria-label="<?php esc_attr_e( 'Sociale media', 'kndsb' ); ?>">
				<?php foreach ( $socials as $network => $url ) : ?>
					<a class="kndsb-header__social kndsb-header__social--<?php echo esc_attr( sanitize_html_class( $network ) ); ?>" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><span class="screen-reader-text"><?php echo esc_html( ucfirst( $network ) ); ?></span><span aria-hidden="true"><?php echo 'youtube' === strtolower( $network ) ? '▶' : esc_html( strtoupper( substr( $network, 0, 1 ) ) ); ?></span></a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
