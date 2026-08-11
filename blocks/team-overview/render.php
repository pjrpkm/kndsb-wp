<?php
/**
 * Adds the Client-First shell to team-overview blocks saved before v1.6.0.
 *
 * @package KNDSB
 */

defined( 'ABSPATH' ) || exit;

if ( false !== strpos( $content, 'section_sport-teams' ) ) {
	echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
}

$allowed_schemes = array( 'orange', 'blue', 'red', 'blue-white' );
$scheme          = isset( $attributes['colorScheme'] ) ? sanitize_key( $attributes['colorScheme'] ) : 'orange';
$scheme          = in_array( $scheme, $allowed_schemes, true ) ? $scheme : 'orange';
?>
<section class="alignfull section_sport-teams kndsb-team-overview-section kndsb-team-overview-section--<?php echo esc_attr( $scheme ); ?>">
	<div class="padding-global">
		<div class="container-large">
			<div class="padding-section-medium">
				<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>
	</div>
</section>
