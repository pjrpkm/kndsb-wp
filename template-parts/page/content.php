<?php
/**
 * Default Gutenberg page content.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'kndsb-page__article' ); ?>>
	<?php if ( ! is_front_page() ) : ?>
		<header class="kndsb-page__header">
			<h1 class="kndsb-page__title"><?php the_title(); ?></h1>
		</header>
	<?php endif; ?>
	<div class="kndsb-page__content">
		<?php the_content(); ?>
	</div>
</article>
