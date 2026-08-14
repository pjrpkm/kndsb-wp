<?php
/**
 * Title: KNDSB bestuurspagina
 * Slug: kndsb/organisation-board
 * Categories: kndsb
 * Description: Huidige bestuurspagina als Gutenberg-native composition volgens het KNDSB framework.
 */
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|2-xl","margin":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|3-xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--m);margin-bottom:var(--wp--preset--spacing--3-xl)">

	<!-- wp:paragraph {"align":"wide"} -->
	<p class="alignwide">Het KNDSB-beleid wordt op hoofdlijnen vastgesteld door het bestuur. De bestuursleden bewaken de uitvoering en controleren of het beleid zo effectief en efficiënt mogelijk wordt uitgevoerd. Het bestuur bestaat uit maximaal zeven leden.</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|l"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:kndsb/board-members {"title":"Het bestuur"} -->
		<div class="wp-block-kndsb-board-members kndsb-board-members">
			<!-- wp:kndsb/board-member {"name":"Ko ter Linden","role":"Voorzitter","imageUrl":"/wp-content/uploads/koterlinden-1-2-scaled.jpg"} /-->
			<!-- wp:kndsb/board-member {"name":"Wietse Sijm","role":"Bestuurslid sportzaken","imageUrl":"/wp-content/uploads/1764336903669.jpeg"} /-->
			<!-- wp:kndsb/board-member {"name":"Johan Hessing","role":"Penningmeester bij volmacht","imageUrl":"/wp-content/uploads/Johan-Hessing-2-e1774818337924.jpg"} /-->
		</div>
		<!-- /wp:kndsb/board-members -->

		<!-- wp:kndsb/board-documents /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:kndsb/news-row {"align":"wide","title":"Bestuursnieuws","accentColor":"var(--kndsb-color-red)","postsToShow":3,"categoryId":7,"loadMore":false,"showExcerpt":true,"showReadMore":true} /-->
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
