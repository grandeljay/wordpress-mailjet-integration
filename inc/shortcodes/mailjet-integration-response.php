<?php
/**
 * Integration for Mailjet shortcode (response)
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
function gjmji_shortcode_mailjet_integration_response( $atts = array(), $content = '' ): string {
	$response = '';

	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['gjmji-response'] ) ) {
		$response .= $_GET['gjmji-response'];
	}
	if ( isset( $_GET['ErrorMessage'] ) ) {
		$response .= '<strong>' . $_GET['StatusCode'] . '</strong> - ';
		$response .= stripslashes( $_GET['ErrorMessage'] );
	}
	// phpcs:enable WordPress.Security.NonceVerification.Recommended

	$content .= '<div class="gjmji-response">' . $response . '</div>';

	return $content;
}

add_shortcode( 'mailjet_integration_response', 'gjmji_shortcode_mailjet_integration_response' );
