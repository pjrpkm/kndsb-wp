<?php
/**
 * Template Name: KNDSB Documenten pagina
 * Template Post Type: page
 *
 * Uses the exact same organisation intro shell and styling as the Bestuur page.
 * The existing page content remains available underneath for the document list.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="main-wrapper kndsb-board-page" id="main-content">
	<section class="section_board-intro">
		<div class="padding-global">
			<div class="container-large">
				<div class="padding-section-medium">
					<header class="kndsb-board-page__header">
						<p class="kndsb-board-page__eyebrow">Organisatie</p>
						<h1 class="kndsb-board-page__title"><?php the_title(); ?></h1>
						<p class="kndsb-board-page__intro">Hieronder een overzicht van belangrijke documenten voor de leden van Koninklijke Nederlandse Doven Sport Bond.</p>
					</header>
				</div>
			</div>
		</div>
	</section>

	<section class="section_board-members kndsb-board-page__members-section">
		<div class="padding-global">
			<div class="container-large">
				<div class="padding-section-medium">
					<div class="kndsb-documents-page__content">
						<?php
						while ( have_posts() ) :
							the_post();
							the_content();
						endwhile;
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
