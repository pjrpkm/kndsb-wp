<?php
/**
 * KNDSB site footer.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;
$footer_logo = kndsb_footer_logo();
$footer_text = wp_kses_post( stripslashes( (string) get_option( 'kndsb_footer_text', '' ) ) );
?>
		<footer class="kndsb-footer">
			<section class="section_footer-main kndsb-footer__main">
				<div class="padding-global"><div class="container-large"><div class="padding-section-medium"><div class="kndsb-footer__inner">
					<section class="kndsb-footer__column kndsb-footer__column--identity">
						<?php if ( $footer_logo['url'] ) : ?>
							<a class="kndsb-footer__logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="kndsb-footer__logo" src="<?php echo esc_url( $footer_logo['url'] ); ?>"<?php echo $footer_logo['retina'] ? ' srcset="' . esc_url( $footer_logo['retina'] ) . ' 2x"' : ''; ?> alt="<?php echo esc_attr( $footer_logo['alt'] ); ?>"></a>
						<?php endif; ?>
						<div class="kndsb-footer__details">
							<p>KvK-nummer: 40342242<br>RSIN-nummer: 005373645<br>IBAN-nummer: NL89ABNA0413005364</p>
						</div>
					</section>

					<section class="kndsb-footer__column kndsb-footer__column--about">
						<h2 class="kndsb-footer__title"><?php esc_html_e( 'Over de KNDSB', 'kndsb' ); ?></h2>
						<div class="kndsb-footer__text">
							<?php if ( $footer_text ) : echo $footer_text; else : ?>
								<p>De Koninklijke Nederlandse Doven Sport Bond<br>Oprichtingsdatum: 4 april 1926<br>Willy Brandtlaan 40<br>6716 RK Ede</p>
							<?php endif; ?>
						</div>
					</section>

					<section class="kndsb-footer__column kndsb-footer__column--links">
						<h2 class="kndsb-footer__title"><?php esc_html_e( 'ERKEND DOOR', 'kndsb' ); ?></h2>
						<nav class="kndsb-footer__navigation" aria-label="<?php esc_attr_e( 'Footernavigatie', 'kndsb' ); ?>">
							<img class="kndsb-footer__recognition-logo" src="https://www.kndsb.nl/wp-content/uploads/ANBI-CBF-1.png" alt="ANBI en CBF Erkend">
						</nav>
						<?php if ( is_active_sidebar( 'kndsb-footer-certifications' ) ) : ?><div class="kndsb-footer__certifications"><?php dynamic_sidebar( 'kndsb-footer-certifications' ); ?></div><?php endif; ?>
					</section>
				</div></div></div></div>
			</section>
			<section class="section_footer-bottom kndsb-footer__bottom">
				<div class="padding-global"><div class="container-large"><div class="padding-section-small"><div class="kndsb-footer__bottom-inner"><p class="kndsb-footer__copyright"><?php echo esc_html( kndsb_footer_copyright() ); ?></p></div></div></div></div>
			</section>
		</footer>
</div><!-- .kndsb-site-shell -->
<?php wp_footer(); ?>
</body>
</html>
