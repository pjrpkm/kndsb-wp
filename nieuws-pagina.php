<?php
/**
 * Template Name: KNDSB Nieuws pagina
 * Template Post Type: page
 *
 * Standalone Client-First/BEM news overview. Stored Newspaper/WPBakery page
 * content is intentionally not rendered.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

get_header();

$paged = max( 1, absint( get_query_var( 'paged' ) ), absint( get_query_var( 'page' ) ) );
$news_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 12,
		'paged'               => $paged,
		'ignore_sticky_posts' => false,
	)
);
?>
<main class="main-wrapper kndsb-news-archive" id="main-content">
	<section class="section_news-archive">
		<div class="padding-global">
			<div class="container-large">
				<div class="padding-section-medium">
					<header class="kndsb-news-archive__header">
						<p class="kndsb-news-archive__eyebrow"><?php esc_html_e( 'KNDSB', 'kndsb' ); ?></p>
						<h1 class="kndsb-news-archive__title"><?php echo esc_html( get_the_title() ?: __( 'Nieuws', 'kndsb' ) ); ?></h1>
					</header>

					<?php if ( $news_query->have_posts() ) : ?>
						<div class="kndsb-news-archive__grid">
							<?php
							while ( $news_query->have_posts() ) :
								$news_query->the_post();
								get_template_part(
									'components/post-card',
									null,
									array(
										'show_date'      => true,
										'show_excerpt'   => true,
										'show_read_more' => true,
									)
								);
							endwhile;
							?>
						</div>

						<nav class="kndsb-news-archive__pagination" aria-label="<?php esc_attr_e( 'Nieuwspaginering', 'kndsb' ); ?>">
							<?php
							echo wp_kses_post(
								paginate_links(
									array(
										'total'     => $news_query->max_num_pages,
										'current'   => $paged,
										'prev_text' => __( 'Vorige', 'kndsb' ),
										'next_text' => __( 'Volgende', 'kndsb' ),
									)
								)
							);
							?>
						</nav>
					<?php else : ?>
						<p class="kndsb-news-archive__empty"><?php esc_html_e( 'Er zijn momenteel geen nieuwsberichten.', 'kndsb' ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
wp_reset_postdata();
get_footer();
