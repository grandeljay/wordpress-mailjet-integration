<?php
/**
 * WP Mailjet Integration shortcode (subscription form)
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * WP Mailjet Integration
 *
 * @param array  $atts    Any shortcode attributes.
 * @param string $content The shortcode content.
 *
 * @return string
 */
function wpmji_shortcode_wp_mailjet_integration( $atts = array(), $content = '' ): string {
	$content .= '<div class="wpmji-response"></div>';

	$content .= '<form class="wpmji-subscribe" method="post">';
	$content .= '<input type="email" name="email" placeholder="' . __( 'Email address', 'grandeljay-wp-mailjet-integration' ) . '">';
	$content .= '<input type="submit" value="' . __( 'Subscribe', 'grandeljay-wp-mailjet-integration' ) . '">';
	$content .= '</form>';

	return $content;
}

add_shortcode( 'wp_mailjet_integration', 'wpmji_shortcode_wp_mailjet_integration' );
