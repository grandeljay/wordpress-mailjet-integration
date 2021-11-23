<?php

/**
 * Mailjet for WordPress shortcode (response)
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

function gjmj4wp_shortcode_mailjet_for_wordpress_response( $atts = array(), $content = '' ) {
	$response = '';

	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['gjmj4wp-response'] ) ) {
		$response .= $_GET['gjmj4wp-response'];
	}
	if ( isset( $_GET['ErrorMessage'] ) ) {
		$response .= '<strong>' . $_GET['StatusCode'] . '</strong> - ';
		$response .= stripslashes( $_GET['ErrorMessage'] );
	}
	// phpcs:enable WordPress.Security.NonceVerification.Recommended

	$content .= '<div class="gjmj4wp-response">' . $response . '</div>';

	return $content;
}

add_shortcode( 'mailjet_for_wordpress_response', 'gjmj4wp_shortcode_mailjet_for_wordpress_response' );
