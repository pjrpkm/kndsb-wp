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

			<div class="kndsb-article__container-wrap<?php echo has_post_thumbnail() ? ' kndsb-article__container-wrap--overlap' : ''; ?>">
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

			<?php
			$related_args = array(
				'post_type'           => get_post_type(),
				'post_status'         => 'publish',
				'posts_per_page'      => 3,
				'post__not_in'        => array( get_the_ID() ),
				'ignore_sticky_posts' => true,
			);

			$category_ids = wp_get_post_categories( get_the_ID() );
			if ( ! empty( $category_ids ) ) {
				$related_args['category__in'] = $category_ids;
			}

			$related_articles = new WP_Query( $related_args );
			?>
			<?php if ( $related_articles->have_posts() ) : ?>
				<section class="kndsb-related" aria-labelledby="kndsb-related-title">
					<div class="kndsb-related__inner">
						<h2 id="kndsb-related-title" class="kndsb-related__title">Gerelateerde artikelen</h2>
						<div class="kndsb-related__grid">
							<?php while ( $related_articles->have_posts() ) : $related_articles->the_post(); ?>
								<article class="kndsb-related__card">
									<a class="kndsb-related__link" href="<?php the_permalink(); ?>">
										<?php if ( has_post_thumbnail() ) : ?>
											<div class="kndsb-related__image-wrap">
												<?php the_post_thumbnail( 'medium_large', array( 'class' => 'kndsb-related__image', 'loading' => 'lazy' ) ); ?>
											</div>
										<?php endif; ?>
										<div class="kndsb-related__content">
											<time class="kndsb-related__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
											<h3 class="kndsb-related__card-title"><?php the_title(); ?></h3>
										</div>
									</a>
								</article>
							<?php endwhile; ?>
						</div>
					</div>
				</section>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
