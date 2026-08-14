<?php
/**
 * Default Gutenberg page content.
 *
 * PHP owns the page shell and title hierarchy. Gutenberg owns page content.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

$parent_id = (int) get_post_field( 'post_parent', get_the_ID() );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'kndsb-page__article' ); ?>>
	<?php if ( ! is_front_page() ) : ?>
		<section class="section_page-intro">
			<div class="padding-global">
				<div class="container-large">
					<div class="padding-section-medium">
						<header class="kndsb-page-intro wp-block-kndsb-page-intro">
							<?php if ( $parent_id ) : ?>
								<p class="kndsb-page-intro__eyebrow"><?php echo esc_html( get_the_title( $parent_id ) ); ?></p>
							<?php endif; ?>
							<h1 class="kndsb-page-intro__title"><?php the_title(); ?></h1>
						</header>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="section_page-content">
		<div class="padding-global">
			<div class="container-large">
				<div class="kndsb-page__content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section>
</article>
