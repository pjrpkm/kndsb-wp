<?php
/**
 * Template Name: KNDSB Documenten pagina
 * Template Post Type: page
 *
 * The page content is Gutenberg-native. Use kndsb/page-intro as the first block
 * so organisation pages can share one editable intro component.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="main-wrapper kndsb-documents-page" id="main-content">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<div class="kndsb-documents-page__content">
			<?php the_content(); ?>
		</div>
		<?php
	endwhile;
	?>
</main>
<?php
get_footer();
