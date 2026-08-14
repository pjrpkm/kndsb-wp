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
		<?php
		$categories = array_values( array_filter( get_the_category(), static function ( $category ) {
			return 'uitgelicht' !== $category->slug;
		} ) );
		$caption = get_the_post_thumbnail_caption();
		?>
		<article <?php post_class( 'kndsb-article' ); ?>>
			<?php if ( has_post_thumbnail() ) : ?>
				<section class="section_article-hero kndsb-article__hero">
					<figure class="kndsb-article__featured">
						<?php the_post_thumbnail( 'full', array( 'class' => 'kndsb-article__featured-image', 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
					</figure>

					<div class="padding-global kndsb-article__hero-card-wrap">
						<div class="container-small">
							<header class="kndsb-article__header kndsb-article__header--card">
								<?php if ( $categories ) : ?>
									<div class="kndsb-article__categories" aria-label="<?php esc_attr_e( 'Categorieën', 'kndsb' ); ?>">
										<?php foreach ( $categories as $category ) : ?>
											<a class="kndsb-article__category" href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
								<h1 class="kndsb-article__title"><?php the_title(); ?></h1>
								<time class="kndsb-article__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
								<?php if ( $caption ) : ?>
									<p class="kndsb-article__featured-caption"><?php echo wp_kses_post( $caption ); ?></p>
								<?php endif; ?>
							</header>
						</div>
					</div>
				</section>
			<?php else : ?>
				<header class="section_article-header kndsb-article__header kndsb-article__header--plain">
					<div class="padding-global">
						<div class="container-small">
							<?php if ( $categories ) : ?>
								<div class="kndsb-article__categories" aria-label="<?php esc_attr_e( 'Categorieën', 'kndsb' ); ?>">
									<?php foreach ( $categories as $category ) : ?>
										<a class="kndsb-article__category" href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<h1 class="kndsb-article__title"><?php the_title(); ?></h1>
							<time class="kndsb-article__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
						</div>
					</div>
				</header>
			<?php endif; ?>

			<section class="section_article-content kndsb-article__content-section">
				<div class="padding-global">
					<div class="container-small">
						<div class="kndsb-article-content">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</section>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
