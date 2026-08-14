<?php
/**
 * Generic Gutenberg template for WordPress pages.
 *
 * PHP owns the fixed page shell; Gutenberg owns page content.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main-content" class="main-wrapper kndsb-page" tabindex="-1">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'template-parts/page/content' ); ?>
	<?php endwhile; ?>
</main>
<?php
get_footer();
