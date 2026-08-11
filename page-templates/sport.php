<?php
/**
 * Clean template for individual KNDSB sport pages.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main-content" class="main-wrapper kndsb-sport-template kndsb-sport-page" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php if ( has_block( 'kndsb/layout-section', get_the_content() ) ) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<section class="section_sport-content">
				<div class="padding-global">
					<div class="container-large">
						<div class="padding-section-none">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>
	<?php endwhile; ?>
</main>
<?php
get_footer();
