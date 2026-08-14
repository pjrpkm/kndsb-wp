<?php
defined( 'ABSPATH' ) || exit;
$eyebrow = isset( $attributes['eyebrow'] ) ? wp_strip_all_tags( $attributes['eyebrow'] ) : '';
$title   = isset( $attributes['title'] ) ? wp_strip_all_tags( $attributes['title'] ) : '';
$intro   = isset( $attributes['intro'] ) ? wp_kses_post( $attributes['intro'] ) : '';
?>
<section class="section_page-intro">
	<div class="padding-global">
		<div class="container-large">
			<div class="padding-section-medium">
				<header <?php echo get_block_wrapper_attributes( array( 'class' => 'kndsb-page-intro' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php if ( $eyebrow ) : ?><p class="kndsb-page-intro__eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
					<h1 class="kndsb-page-intro__title"><?php echo esc_html( $title ); ?></h1>
					<p class="kndsb-page-intro__text"><?php echo $intro; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				</header>
			</div>
		</div>
	</div>
</section>
