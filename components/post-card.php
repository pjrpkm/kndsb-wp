<?php
/**
 * Reusable post card component.
 *
 * @package KNDSB
 * @var array $args Component options passed by get_template_part().
 */

defined( 'ABSPATH' ) || exit;

$show_date    = ! isset( $args['show_date'] ) || (bool) $args['show_date'];
$show_excerpt = ! empty( $args['show_excerpt'] );
$show_read_more = ! empty( $args['show_read_more'] );
$post_id       = isset( $args['post_id'] ) ? absint( $args['post_id'] ) : get_the_ID();
$image_loading = isset( $args['image_loading'] ) && 'eager' === $args['image_loading'] ? 'eager' : 'lazy';
$thumbnail_id  = get_post_thumbnail_id( $post_id );
$image_url     = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'medium_large' ) : '';
$image_alt     = $thumbnail_id ? get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true ) : '';
$image_html    = $image_url
	? sprintf(
		'<img class="kndsb-post-card__image" src="%1$s" alt="%2$s" loading="%3$s">',
		esc_url( $image_url ),
		esc_attr( $image_alt ),
		esc_attr( $image_loading )
	)
	: '';

if ( ! $image_html ) {
	$content = (string) get_post_field( 'post_content', $post_id );
	if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/i', $content, $match ) ) {
		$image_html = sprintf(
			'<img class="kndsb-post-card__image" src="%1$s" alt="" loading="%2$s">',
			esc_url( $match[1] ),
			esc_attr( $image_loading )
		);
	}
}
$permalink = get_permalink( $post_id );
$title     = get_the_title( $post_id );
?>
<article class="<?php echo esc_attr( implode( ' ', get_post_class( 'kndsb-post-card', $post_id ) ) ); ?>">
	<a class="kndsb-post-card__media" href="<?php echo esc_url( $permalink ); ?>" aria-hidden="true" tabindex="-1">
		<?php if ( $image_html ) : ?>
			<?php echo $image_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php else : ?>
			<span class="kndsb-post-card__placeholder"></span>
		<?php endif; ?>
	</a>
	<div class="kndsb-post-card__body">
		<?php if ( $show_date ) : ?>
			<time class="kndsb-post-card__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C, $post_id ) ); ?>"><?php echo esc_html( get_the_date( '', $post_id ) ); ?></time>
		<?php endif; ?>
		<h3 class="kndsb-post-card__title"><a class="kndsb-post-card__link" href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h3>
		<?php if ( $show_excerpt ) : ?>
			<p class="kndsb-post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $post_id ), 22 ) ); ?></p>
		<?php endif; ?>
		<?php if ( $show_read_more ) : ?>
			<a class="kndsb-post-card__read-more" href="<?php echo esc_url( $permalink ); ?>"><?php esc_html_e( 'Lees artikel', 'kndsb' ); ?> <span aria-hidden="true"><svg viewBox="0 0 20 20" focusable="false"><path d="m7.5 4.5 5.5 5.5-5.5 5.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"/></svg></span></a>
		<?php endif; ?>
	</div>
</article>
