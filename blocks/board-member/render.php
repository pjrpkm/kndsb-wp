<?php
defined( 'ABSPATH' ) || exit;
$name      = isset( $attributes['name'] ) ? wp_strip_all_tags( $attributes['name'] ) : '';
$role      = isset( $attributes['role'] ) ? wp_strip_all_tags( $attributes['role'] ) : '';
$image_url = isset( $attributes['imageUrl'] ) ? $attributes['imageUrl'] : '';
?>
<article <?php echo get_block_wrapper_attributes( array( 'class' => 'kndsb-board-card' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="kndsb-board-card__media">
		<?php if ( $image_url ) : ?><img class="kndsb-board-card__image" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy"><?php endif; ?>
	</div>
	<div class="kndsb-board-card__body">
		<p class="kndsb-board-card__role"><?php echo esc_html( $role ); ?></p>
		<h3 class="kndsb-board-card__name"><?php echo esc_html( $name ); ?></h3>
	</div>
</article>
