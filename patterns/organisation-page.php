<?php
/**
 * Title: KNDSB organisatiepagina
 * Slug: kndsb/organisation-page
 * Categories: kndsb
 * Description: Gutenberg-native basis voor organisatiepagina's met consistente KNDSB-breedtes en spacing.
 */
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|m","margin":{"top":"var:preset|spacing|m"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--m)">
	<!-- wp:paragraph {"fontSize":"medium"} -->
	<p class="has-medium-font-size">Schrijf hier de korte introductie van deze organisatiepagina.</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|l","margin":{"top":"var:preset|spacing|2-xl"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--2-xl)">
		<!-- wp:heading {"align":"wide","level":2} -->
		<h2 class="wp-block-heading alignwide">Sectietitel</h2>
		<!-- /wp:heading -->

		<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignwide">
			<!-- wp:paragraph -->
			<p>Voeg hier de inhoud, kaarten, documenten of andere Gutenberg-blokken van deze sectie toe.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|l","margin":{"top":"var:preset|spacing|2-xl"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--2-xl)">
		<!-- wp:heading {"align":"wide","level":2} -->
		<h2 class="wp-block-heading alignwide">Meer</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"wide"} -->
		<p class="alignwide">Voeg hier een volgende sectie toe. Gebruik de Gutenberg spacing-presets en alignwide zodat alle onderdelen dezelfde lijnen volgen.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
