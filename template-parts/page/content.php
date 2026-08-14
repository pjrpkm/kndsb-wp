<?php
/**
 * Default Gutenberg page content.
 *
 * The page shell owns the eyebrow and title. Gutenberg owns the page content.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

$parent_id = (int) get_post_field( 'post_parent', get_the_ID() );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'kndsb-page__article' ); ?>>
	<?php if ( ! is_front_page() ) : ?>
		<header class="kndsb-page-intro wp-block-kndsb-page-intro">
			<?php if ( $parent_id ) : ?>
				<p class="kndsb-page-intro__eyebrow"><?php echo esc_html( get_the_title( $parent_id ) ); ?></p>
			<?php endif; ?>
			<h1 class="kndsb-page-intro__title"><?php the_title(); ?></h1>
		</header>
	<?php endif; ?>

	<div class="kndsb-page__content">
		<?php the_content(); ?>
	</div>
</article>
