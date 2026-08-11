<?php
/**
 * Template Name: KNDSB Bestuur pagina
 * Template Post Type: page
 *
 * Clean Client-First/BEM replacement for the legacy board page.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

$board_intro     = kndsb_render_board_intro_from_page();
$board_members   = kndsb_render_board_members_from_page();
$board_documents = kndsb_render_board_documents_from_page();
$board_news      = kndsb_render_board_news_from_page();

get_header();
?>
<main class="main-wrapper kndsb-board-page" id="main-content">
	<?php if ( $board_intro ) : ?>
	<section class="section_board-intro">
		<div class="padding-global">
			<div class="container-large">
				<div class="padding-section-medium">
					<?php echo $board_intro; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $board_members || $board_documents ) : ?>
	<section class="section_board-members kndsb-board-page__members-section">
		<div class="padding-global">
			<div class="container-large">
				<div class="padding-section-medium">
					<?php echo $board_members; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php echo $board_documents; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $board_news ) : ?>
	<section class="section_board-news kndsb-board-page__news-section">
		<div class="padding-global">
			<div class="container-large">
				<div class="padding-section-medium">
					<?php echo $board_news; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
</main>
<?php
get_footer();
