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
function gjmj4wp_shortcode_mailjet_for_wordpress( $atts = array(), $content = '' ): string {
	$content .= '<div class="gjmj4wp-response"></div>';

	$content .= '<form class="gjmj4wp-subscribe" method="post">';
	$content .= '<input type="email" name="email" placeholder="' . __( 'Email address', 'grandeljay-wp-mailjet-integration' ) . '">';
	$content .= '<input type="submit" value="' . __( 'Subscribe', 'grandeljay-wp-mailjet-integration' ) . '">';
	$content .= '</form>';

	return $content;
}

add_shortcode( 'mailjet_for_wordpress', 'gjmj4wp_shortcode_mailjet_for_wordpress' );
