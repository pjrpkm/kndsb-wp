<?php
/** @package KNDSB */
defined( 'ABSPATH' ) || exit;
$index = isset( $args['index'] ) ? absint( $args['index'] ) : 0;
$total = isset( $args['total'] ) ? absint( $args['total'] ) : 1;
?>
<article class="kndsb-featured-grid__item kndsb-featured-grid__item--<?php echo 0 === $index ? 'primary' : 'secondary'; ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Bericht %1$d van %2$d', 'kndsb' ), $index + 1, $total ) ); ?>">
	<a class="kndsb-featured-grid__link" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="kndsb-featured-grid__media"><?php the_post_thumbnail( 0 === $index ? 'large' : 'medium_large', array( 'class' => 'kndsb-featured-grid__image', 'loading' => 0 === $index ? 'eager' : 'lazy' ) ); ?></div>
		<?php endif; ?>
		<div class="kndsb-featured-grid__overlay"></div>
		<div class="kndsb-featured-grid__content">
			<h2 class="kndsb-featured-grid__title"><?php the_title(); ?></h2>
			<?php if ( 0 === $index ) : ?>
				<div class="kndsb-featured-grid__meta"><span class="kndsb-featured-grid__author"><?php echo esc_html( get_the_author() ); ?></span> · <time class="kndsb-featured-grid__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></div>
			<?php endif; ?>
		</div>
	</a>
</article>
