<?php
/**
 * Render the KNDSB team hero.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

$title    = isset( $attributes['title'] ) ? wp_kses_post( $attributes['title'] ) : '';
$image_id = isset( $attributes['imageId'] ) ? absint( $attributes['imageId'] ) : 0;
$image_url = isset( $attributes['imageUrl'] ) ? esc_url( $attributes['imageUrl'] ) : '';
$image_alt = isset( $attributes['imageAlt'] ) ? sanitize_text_field( $attributes['imageAlt'] ) : '';
$opacity   = isset( $attributes['overlayOpacity'] ) ? min( 80, max( 0, absint( $attributes['overlayOpacity'] ) ) ) : 45;
$height    = isset( $attributes['height'] ) ? min( 720, max( 300, absint( $attributes['height'] ) ) ) : 520;
$position  = isset( $attributes['contentPosition'] ) && 'center' === $attributes['contentPosition'] ? 'center' : 'left';
$class     = 'kndsb-team-page__hero kndsb-team-hero kndsb-team-hero--' . $position;
$style     = sprintf( '--kndsb-team-hero-overlay:%.2f;--kndsb-team-hero-height:%dpx', $opacity / 100, $height );
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => $class, 'style' => $style ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $image_id ) : ?>
		<?php echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'kndsb-team-hero__image', 'alt' => $image_alt, 'loading' => 'eager' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php elseif ( $image_url ) : ?>
		<img class="kndsb-team-hero__image" src="<?php echo $image_url; ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="eager">
	<?php else : ?>
		<div class="kndsb-team-hero__placeholder" aria-hidden="true"></div>
	<?php endif; ?>
	<span class="kndsb-team-hero__overlay" aria-hidden="true"></span>
	<div class="padding-global kndsb-team-hero__layout">
		<div class="container-large">
			<div class="kndsb-team-hero__inner">
				<h1 class="kndsb-team-page__title kndsb-team-hero__title"><?php echo $title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h1>
			</div>
		</div>
	</div>
</section>
