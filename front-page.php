<?php
/**
 * Gutenberg-native homepage.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main-content" class="main-wrapper kndsb-home" tabindex="-1">
	<div style="position:relative;z-index:9999;padding:12px;text-align:center;font-weight:700;">TEST</div>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php if ( has_block( 'kndsb/layout-section', get_the_content() ) ) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<section class="section_home-content"><div class="padding-global"><div class="container-large"><div class="padding-section-medium kndsb-home__content">
				<?php the_content(); ?>
			</div></div></div></section>
		<?php endif; ?>
	<?php endwhile; ?>
</main>
<?php
get_footer();
