<?php
/**
 * Native Gutenberg blocks.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

function kndsb_register_blocks() {
	register_block_type( KNDSB_CHILD_PATH . 'blocks/layout-section' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/section-heading' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/logo-grid' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/logo-card' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/page-intro' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/sports-overview' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/sport-card' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/team-overview' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/team-card' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/sport-hero' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/sport-section' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/sport-program' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/match-results' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/match-result' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/board-members' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/board-member' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/board-intro' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/board-documents' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/board-vacancy' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/team-program' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/team-program-item' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/team-nav' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/team-match-list' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/team-match' );
	register_block_type( KNDSB_CHILD_PATH . 'blocks/team-hero' );
	register_block_type(
		KNDSB_CHILD_PATH . 'blocks/team-featured',
		array( 'render_callback' => 'kndsb_render_team_featured' )
	);
	register_block_type(
		KNDSB_CHILD_PATH . 'blocks/posts-grid',
		array( 'render_callback' => 'kndsb_render_posts_grid' )
	);
	register_block_type(
		KNDSB_CHILD_PATH . 'blocks/featured-grid',
		array( 'render_callback' => 'kndsb_render_featured_grid' )
	);
	register_block_type(
		KNDSB_CHILD_PATH . 'blocks/news-row',
		array( 'render_callback' => 'kndsb_render_news_row' )
	);
}
add_action( 'init', 'kndsb_register_blocks' );

function kndsb_find_block_by_name( $blocks, $name ) {
	foreach ( $blocks as $block ) {
		if ( isset( $block['blockName'] ) && $name === $block['blockName'] ) {
			return $block;
		}
		if ( ! empty( $block['innerBlocks'] ) ) {
			$nested = kndsb_find_block_by_name( $block['innerBlocks'], $name );
			if ( $nested ) {
				return $nested;
			}
		}
	}
	return null;
}

function kndsb_render_board_members_from_page() {
	$content = get_post_field( 'post_content', get_queried_object_id() );
	$block   = kndsb_find_block_by_name( parse_blocks( (string) $content ), 'kndsb/board-members' );
	return $block ? render_block( $block ) : '';
}

function kndsb_render_board_intro_from_page() {
	$content = get_post_field( 'post_content', get_queried_object_id() );
	$block   = kndsb_find_block_by_name( parse_blocks( (string) $content ), 'kndsb/board-intro' );
	return $block ? render_block( $block ) : '';
}

function kndsb_render_board_news_from_page() {
	$content = get_post_field( 'post_content', get_queried_object_id() );
	$block   = kndsb_find_block_by_name( parse_blocks( (string) $content ), 'kndsb/news-row' );
	return $block ? render_block( $block ) : '';
}

function kndsb_render_board_documents_from_page() {
	$content = get_post_field( 'post_content', get_queried_object_id() );
	$block   = kndsb_find_block_by_name( parse_blocks( (string) $content ), 'kndsb/board-documents' );
	return $block ? render_block( $block ) : '';
}

function kndsb_register_core_block_styles() {
	register_block_style(
		'core/table',
		array(
			'name'  => 'kndsb-table',
			'label' => __( 'KNDSB tabel', 'kndsb' ),
		)
	);
}
add_action( 'init', 'kndsb_register_core_block_styles' );

function kndsb_render_team_featured( $attributes ) {
	$category_id = isset( $attributes['categoryId'] ) ? absint( $attributes['categoryId'] ) : 0;
	$query_args = array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 1, 'ignore_sticky_posts' => true );
	if ( $category_id ) {
		$query_args['cat'] = $category_id;
	}
	$posts = new WP_Query( $query_args );
	if ( ! $posts->have_posts() ) {
		return '<div ' . get_block_wrapper_attributes( array( 'class' => 'kndsb-team-featured__empty' ) ) . '>' . esc_html__( 'Geen teamnieuws gevonden. Kies een categorie met gepubliceerde berichten.', 'kndsb' ) . '</div>';
	}
	$posts->the_post();
	ob_start();
	?>
	<article <?php echo get_block_wrapper_attributes( array( 'class' => 'kndsb-team-featured' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<a class="kndsb-team-featured__link" href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'large', array( 'class' => 'kndsb-team-featured__image', 'loading' => 'eager' ) ); endif; ?>
			<span class="kndsb-team-featured__overlay"></span>
			<div class="kndsb-team-featured__content"><h2 class="kndsb-team-featured__title"><?php the_title(); ?></h2></div>
		</a>
	</article>
	<?php
	wp_reset_postdata();
	return ob_get_clean();
}

function kndsb_get_posts_query( $category_id, $count, $offset = 0 ) {
	$args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $count,
		'ignore_sticky_posts' => true,
		'offset'              => max( 0, (int) $offset ),
	);

	if ( $category_id ) {
		$args['cat'] = $category_id;
	}

	return new WP_Query( $args );
}

function kndsb_render_featured_grid( $attributes ) {
	$count       = isset( $attributes['postsToShow'] ) ? min( 8, max( 1, (int) $attributes['postsToShow'] ) ) : 4;
	$category_id = isset( $attributes['categoryId'] ) ? absint( $attributes['categoryId'] ) : 5;
	$posts       = kndsb_get_posts_query( $category_id, $count );

	if ( ! $posts->have_posts() ) {
		return '<p class="kndsb-featured-grid__empty">' . esc_html__( 'Geen uitgelichte berichten gevonden.', 'kndsb' ) . '</p>';
	}

	$post_count = (int) $posts->post_count;
	$wrapper    = get_block_wrapper_attributes( array( 'class' => 'kndsb-featured-grid' ) );

	ob_start();
	?>
	<section <?php echo $wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<div class="kndsb-featured-grid__items">
			<?php
			$index = 0;
			while ( $posts->have_posts() ) :
				$posts->the_post();
				get_template_part( 'components/featured-slide', null, array( 'index' => $index, 'total' => $post_count ) );
				++$index;
			endwhile;
			?>
		</div>
	</section>
	<?php
	wp_reset_postdata();
	return ob_get_clean();
}

function kndsb_render_news_row( $attributes ) {
	$title       = isset( $attributes['title'] ) ? sanitize_text_field( $attributes['title'] ) : __( 'Laatste nieuws', 'kndsb' );
	$accent      = isset( $attributes['accentColor'] ) ? sanitize_hex_color( $attributes['accentColor'] ) : 'var(--kndsb-color-orange)';
	$category_id = isset( $attributes['categoryId'] ) ? absint( $attributes['categoryId'] ) : 0;
	$count       = isset( $attributes['postsToShow'] ) ? min( 12, max( 1, (int) $attributes['postsToShow'] ) ) : 5;
	$offset      = isset( $attributes['postOffset'] ) ? min( 12, max( 0, (int) $attributes['postOffset'] ) ) : 0;
	if ( 'Teamnieuws' === $title && 0 === $offset ) {
		$offset = 1;
	}
	$link_text   = isset( $attributes['linkText'] ) ? sanitize_text_field( $attributes['linkText'] ) : '';
	$link_url    = isset( $attributes['linkUrl'] ) ? esc_url( $attributes['linkUrl'] ) : '';
	$load_more   = ! isset( $attributes['loadMore'] ) || (bool) $attributes['loadMore'];
	$show_excerpt = ! empty( $attributes['showExcerpt'] );
	$show_read_more = ! empty( $attributes['showReadMore'] );
	$is_home_row    = is_front_page();
	if ( is_front_page() ) {
		$count          = 4;
		$show_excerpt   = true;
		$show_read_more = true;
		$load_more      = false;
	}
	$posts       = kndsb_get_posts_query( $category_id, $count, $offset );

	if ( ! $posts->have_posts() ) {
		return '<p class="kndsb-news-row__empty">' . esc_html__( 'Geen berichten gevonden.', 'kndsb' ) . '</p>';
	}

	$wrapper = get_block_wrapper_attributes(
		array(
			'class'             => 'kndsb-news-row',
			'style'             => '--kndsb-section-accent:' . ( $accent ? $accent : 'var(--kndsb-color-orange)' ),
			'data-endpoint'     => esc_url( rest_url( 'wp/v2/posts' ) ),
			'data-category-id'  => $category_id,
			'data-posts-page'   => 1,
			'data-posts-count'  => $count,
		)
	);
	$display_title = $title;
	if ( $is_home_row && 'SELECTIE VAN HET LAATSTE NIEUWS' === strtoupper( $display_title ) ) {
		$display_title = __( 'Laatste nieuws', 'kndsb' );
	}
	$archive_url = $link_url;
	if ( $is_home_row && ! $archive_url ) {
		$archive_url = 4 === $category_id ? home_url( '/nieuws/' ) : get_category_link( $category_id );
	}

	ob_start();
	?>
	<section <?php echo $wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<header class="kndsb-news-row__header">
			<h2 class="kndsb-news-row__title"><?php echo esc_html( $display_title ); ?></h2>
			<?php if ( $is_home_row && $archive_url && ! is_wp_error( $archive_url ) ) : ?>
				<a class="kndsb-news-row__heading-link" href="<?php echo esc_url( $archive_url ); ?>"><?php esc_html_e( 'Toon alle artikelen', 'kndsb' ); ?><span aria-hidden="true">›</span></a>
			<?php endif; ?>
		</header>
		<div class="kndsb-news-row__items" data-posts-grid>
			<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
				<?php get_template_part( 'components/post-card', null, array( 'show_date' => false, 'show_excerpt' => $show_excerpt, 'show_read_more' => $show_read_more ) ); ?>
			<?php endwhile; ?>
		</div>
		<?php if ( $link_text && $link_url ) : ?>
			<a class="kndsb-news-row__more" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_text ); ?> <span aria-hidden="true">→</span></a>
		<?php endif; ?>
		<?php if ( $load_more && $posts->max_num_pages > 1 ) : ?>
			<button class="kndsb-news-row__load-more" type="button"><?php esc_html_e( 'Laad meer', 'kndsb' ); ?> <span aria-hidden="true">⌄</span></button>
		<?php endif; ?>
	</section>
	<?php
	wp_reset_postdata();
	return ob_get_clean();
}

function kndsb_render_posts_grid( $attributes ) {
	$count       = isset( $attributes['postsToShow'] ) ? min( 12, max( 1, (int) $attributes['postsToShow'] ) ) : 6;
	$category_id = isset( $attributes['categoryId'] ) ? absint( $attributes['categoryId'] ) : 0;
	$columns     = isset( $attributes['columns'] ) ? min( 4, max( 1, (int) $attributes['columns'] ) ) : 3;
	$show_date   = ! isset( $attributes['showDate'] ) || (bool) $attributes['showDate'];
	$show_excerpt = ! empty( $attributes['showExcerpt'] );

	$query_args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $count,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	);

	if ( $category_id ) {
		$query_args['cat'] = $category_id;
	}

	$posts = new WP_Query( $query_args );
	if ( ! $posts->have_posts() ) {
		return '<p class="kndsb-posts-grid__empty">' . esc_html__( 'Geen berichten gevonden.', 'kndsb' ) . '</p>';
	}

	$wrapper_attributes = get_block_wrapper_attributes(
		array(
			'class' => 'kndsb-posts-grid kndsb-posts-grid--columns-' . $columns,
		)
	);

	ob_start();
	?>
	<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
			<?php
			get_template_part(
				'components/post-card',
				null,
				array(
					'show_date'    => $show_date,
					'show_excerpt' => $show_excerpt,
				)
			);
			?>
		<?php endwhile; ?>
	</div>
	<?php
	wp_reset_postdata();
	return ob_get_clean();
}
