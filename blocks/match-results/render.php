<?php
/**
 * Client-First shell for match-result blocks saved before v1.1.0.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

if ( false !== strpos( $content, 'section_team-results' ) ) {
	echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
}

$schemes = array( 'orange', 'blue', 'red', 'blue-white' );
$scheme  = isset( $attributes['colorScheme'] ) ? sanitize_key( $attributes['colorScheme'] ) : 'orange';
$scheme  = in_array( $scheme, $schemes, true ) ? $scheme : 'orange';
?>
<section class="alignfull section_team-results kndsb-layout-section kndsb-layout-section--<?php echo esc_attr( $scheme ); ?>">
	<div class="padding-global">
		<div class="container-large">
			<div class="padding-section-medium">
				<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>
	</div>
</section>
