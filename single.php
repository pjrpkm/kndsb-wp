<?php
/**
 * Clean Gutenberg-native single news article template.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main-content" class="main-wrapper kndsb-article-page" tabindex="-1">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$post_id     = get_the_ID();
		$author_id   = (int) get_the_author_meta( 'ID' );
		$author_url  = get_author_posts_url( $author_id );
		$permalink   = get_permalink();
		$title       = get_the_title();
		$share_url   = rawurlencode( $permalink );
		$share_title = rawurlencode( $title );
		?>
		<article <?php post_class( 'kndsb-article' ); ?>>
			<?php
			$categories = array_values( array_filter( get_the_category(), static function ( $category ) {
				return 'uitgelicht' !== $category->slug;
			} ) );
			?>
			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="section_article-media kndsb-article__featured">
					<div class="padding-global">
						<div class="container-large">
							<div class="kndsb-article__featured-frame">
								<?php the_post_thumbnail( 'full', array( 'class' => 'kndsb-article__featured-image', 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
								<div class="kndsb-article__featured-shade" aria-hidden="true"></div>
								<header class="section_article-header kndsb-article__header kndsb-article__header--overlay">
									<div class="kndsb-article__header-inner">
										<?php if ( $categories ) : ?>
											<div class="kndsb-article__categories" aria-label="<?php esc_attr_e( 'Categorieën', 'kndsb' ); ?>">
												<?php foreach ( $categories as $category ) : ?>
													<a class="kndsb-article__category" href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
										<h1 class="kndsb-article__title"><?php the_title(); ?></h1>
										<div class="kndsb-article__meta" aria-label="<?php esc_attr_e( 'Artikelinformatie', 'kndsb' ); ?>">
											<span class="kndsb-article__author"><?php esc_html_e( 'Door', 'kndsb' ); ?> <a class="kndsb-article__author-link" href="<?php echo esc_url( $author_url ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span>
											<span class="kndsb-article__meta-separator" aria-hidden="true">·</span>
											<time class="kndsb-article__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
										</div>
									</div>
								</header>
							</div>
							<?php $caption = get_the_post_thumbnail_caption(); ?>
							<?php if ( $caption ) : ?>
								<figcaption class="kndsb-article__featured-caption"><?php echo wp_kses_post( $caption ); ?></figcaption>
							<?php endif; ?>
						</div>
					</div>
				</figure>
			<?php else : ?>
				<header class="section_article-header kndsb-article__header">
					<div class="padding-global">
						<div class="container-small">
							<div class="padding-section-medium kndsb-article__header-inner">
								<?php if ( $categories ) : ?>
									<div class="kndsb-article__categories" aria-label="<?php esc_attr_e( 'Categorieën', 'kndsb' ); ?>">
										<?php foreach ( $categories as $category ) : ?>
											<a class="kndsb-article__category" href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
								<h1 class="kndsb-article__title"><?php the_title(); ?></h1>
								<div class="kndsb-article__meta" aria-label="<?php esc_attr_e( 'Artikelinformatie', 'kndsb' ); ?>">
									<span class="kndsb-article__author"><?php esc_html_e( 'Door', 'kndsb' ); ?> <a class="kndsb-article__author-link" href="<?php echo esc_url( $author_url ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span>
									<span class="kndsb-article__meta-separator" aria-hidden="true">·</span>
									<time class="kndsb-article__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
								</div>
							</div>
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

			<footer class="section_article-footer kndsb-article__footer">
				<div class="padding-global">
					<div class="container-small">
						<div class="padding-section-medium">
							<section class="kndsb-article-share" aria-labelledby="kndsb-share-title-<?php echo esc_attr( $post_id ); ?>">
								<h2 id="kndsb-share-title-<?php echo esc_attr( $post_id ); ?>" class="kndsb-article-share__title"><?php esc_html_e( 'Delen', 'kndsb' ); ?></h2>
								<div class="kndsb-article-share__buttons">
									<a class="kndsb-article-share__button" href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . $share_url ); ?>" target="_blank" rel="noopener noreferrer"><span class="kndsb-article-share__icon" aria-hidden="true">f</span><span><?php esc_html_e( 'Facebook', 'kndsb' ); ?></span></a>
									<a class="kndsb-article-share__button" href="<?php echo esc_url( 'https://x.com/intent/post?text=' . $share_title . '&url=' . $share_url ); ?>" target="_blank" rel="noopener noreferrer"><span class="kndsb-article-share__icon" aria-hidden="true">X</span><span><?php esc_html_e( 'X', 'kndsb' ); ?></span></a>
									<a class="kndsb-article-share__button" href="<?php echo esc_url( 'https://wa.me/?text=' . $share_title . '%20' . $share_url ); ?>" target="_blank" rel="noopener noreferrer"><span class="kndsb-article-share__icon" aria-hidden="true">↗</span><span><?php esc_html_e( 'WhatsApp', 'kndsb' ); ?></span></a>
									<button class="kndsb-article-share__button kndsb-article-share__button--copy" type="button" data-kndsb-copy-link data-url="<?php echo esc_url( $permalink ); ?>"><span class="kndsb-article-share__icon" aria-hidden="true">⧉</span><span data-kndsb-copy-label><?php esc_html_e( 'Kopieer link', 'kndsb' ); ?></span></button>
								</div>
								<p class="kndsb-article-share__status screen-reader-text" data-kndsb-copy-status aria-live="polite"></p>
							</section>

							<?php
							$previous_post = get_previous_post();
							$next_post     = get_next_post();
							if ( $previous_post || $next_post ) :
								?>
								<nav class="kndsb-article-navigation" aria-label="<?php esc_attr_e( 'Artikelnavigatie', 'kndsb' ); ?>">
									<?php if ( $previous_post ) : ?>
										<div class="kndsb-article-navigation__item kndsb-article-navigation__item--previous"><span class="kndsb-article-navigation__label"><?php esc_html_e( 'Vorig artikel', 'kndsb' ); ?></span><a class="kndsb-article-navigation__link" href="<?php echo esc_url( get_permalink( $previous_post ) ); ?>"><?php echo esc_html( get_the_title( $previous_post ) ); ?></a></div>
									<?php endif; ?>
									<?php if ( $next_post ) : ?>
										<div class="kndsb-article-navigation__item kndsb-article-navigation__item--next"><span class="kndsb-article-navigation__label"><?php esc_html_e( 'Volgend artikel', 'kndsb' ); ?></span><a class="kndsb-article-navigation__link" href="<?php echo esc_url( get_permalink( $next_post ) ); ?>"><?php echo esc_html( get_the_title( $next_post ) ); ?></a></div>
									<?php endif; ?>
								</nav>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</footer>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
