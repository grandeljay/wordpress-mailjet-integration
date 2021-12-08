<?php
/**
 * WP Mailjet Integration shortcode (response)
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Response
 *
 * @param array  $atts    Any shortcode attributes.
 * @param string $content The shortcode content.
 *
 * @return string
 */
function wpmji_shortcode_wp_mailjet_integration_response( $atts = array(), $content = '' ): string {
	$response = '';

	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['wpmji-response'] ) ) {
		$response .= $_GET['wpmji-response'];
	}
	if ( isset( $_GET['ErrorMessage'] ) ) {
		$response .= '<strong>' . $_GET['StatusCode'] . '</strong> - ';
		$response .= stripslashes( $_GET['ErrorMessage'] );
	}
	// phpcs:enable WordPress.Security.NonceVerification.Recommended

	$content .= '<div class="wpmji-response">' . $response . '</div>';

	return $content;
}

add_shortcode( 'wp_mailjet_integration_response', 'wpmji_shortcode_wp_mailjet_integration_response' );
