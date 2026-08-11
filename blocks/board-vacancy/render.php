<?php
defined( 'ABSPATH' ) || exit;
$title       = isset( $attributes['title'] ) ? wp_strip_all_tags( $attributes['title'] ) : '';
$role        = isset( $attributes['role'] ) ? wp_strip_all_tags( $attributes['role'] ) : '';
$description = isset( $attributes['description'] ) ? wp_kses_post( $attributes['description'] ) : '';
$link_label  = isset( $attributes['linkLabel'] ) ? wp_strip_all_tags( $attributes['linkLabel'] ) : '';
$link_url    = isset( $attributes['linkUrl'] ) ? $attributes['linkUrl'] : '';
$image_url   = isset( $attributes['imageUrl'] ) ? $attributes['imageUrl'] : '';
?>
<article <?php echo get_block_wrapper_attributes( array( 'class' => 'kndsb-board-vacancy' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="kndsb-board-vacancy__media">
		<?php if ( $image_url ) : ?><img class="kndsb-board-vacancy__image" src="<?php echo esc_url( $image_url ); ?>" alt="" loading="lazy"><?php else : ?><div class="kndsb-board-vacancy__icon" aria-hidden="true">+</div><?php endif; ?>
	</div>
	<div class="kndsb-board-vacancy__body">
		<p class="kndsb-board-vacancy__role"><?php echo esc_html( $role ); ?></p>
		<h3 class="kndsb-board-vacancy__title"><?php echo esc_html( $title ); ?></h3>
		<p class="kndsb-board-vacancy__description"><?php echo $description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		<?php if ( $link_label && $link_url ) : ?><a class="kndsb-board-vacancy__link" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_label ); ?><span aria-hidden="true">›</span></a><?php endif; ?>
	</div>
</article>
