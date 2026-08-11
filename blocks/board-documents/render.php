<?php
defined( 'ABSPATH' ) || exit;
$first_label  = isset( $attributes['firstLabel'] ) ? wp_strip_all_tags( $attributes['firstLabel'] ) : '';
$first_url    = isset( $attributes['firstUrl'] ) ? $attributes['firstUrl'] : '';
$second_label = isset( $attributes['secondLabel'] ) ? wp_strip_all_tags( $attributes['secondLabel'] ) : '';
$second_url   = isset( $attributes['secondUrl'] ) ? $attributes['secondUrl'] : '';
?>
<nav <?php echo get_block_wrapper_attributes( array( 'class' => 'kndsb-board-documents', 'aria-label' => __( 'Bestuursdocumenten', 'kndsb' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $first_label && $first_url ) : ?><a class="kndsb-board-documents__button" href="<?php echo esc_url( $first_url ); ?>"><?php echo esc_html( $first_label ); ?><span aria-hidden="true">›</span></a><?php endif; ?>
	<?php if ( $second_label && $second_url ) : ?><a class="kndsb-board-documents__button" href="<?php echo esc_url( $second_url ); ?>"><?php echo esc_html( $second_label ); ?><span aria-hidden="true">›</span></a><?php endif; ?>
</nav>
