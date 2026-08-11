<?php
/**
 * Clean BEM template for every WordPress page.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main-content" class="main-wrapper kndsb-page" tabindex="-1">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php if ( has_block( 'kndsb/layout-section', get_the_content() ) ) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<section class="section_page-content"><div class="padding-global"><div class="container-large"><div class="padding-section-medium">
				<?php get_template_part( 'template-parts/page/content' ); ?>
			</div></div></div></section>
		<?php endif; ?>
	<?php endwhile; ?>
</main>
<?php
get_footer();
