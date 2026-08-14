<?php
/**
 * KNDSB single news article template.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main-content" class="main-wrapper kndsb-article-page" tabindex="-1">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php $caption = get_the_post_thumbnail_caption(); ?>
		<article <?php post_class( 'kndsb-article' ); ?>>
			<?php if ( has_post_thumbnail() ) : ?>
				<header class="page-heading--large kndsb-article__hero">
					<figure class="page-heading__figure kndsb-article__featured">
						<?php the_post_thumbnail( 'full', array( 'class' => 'kndsb-article__featured-image', 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
					</figure>
				</header>
			<?php endif; ?>

			<div class="padding-global kndsb-article__container-wrap<?php echo has_post_thumbnail() ? ' kndsb-article__container-wrap--overlap' : ''; ?>">
				<div class="container-large">
					<div class="kndsb-article__container">
						<header class="kndsb-article__heading">
							<h1 class="kndsb-article__title"><?php the_title(); ?></h1>
							<time class="kndsb-article__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
							<?php if ( $caption ) : ?>
								<p class="kndsb-article__featured-caption"><?php echo wp_kses_post( $caption ); ?></p>
							<?php endif; ?>
						</header>

						<div class="kndsb-article-content">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
