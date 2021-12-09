<?php
/**
 * Integration for Mailjet shortcode (subscription form)
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Integration for Mailjet
 *
 * @param array  $atts    Any shortcode attributes.
 * @param string $content The shortcode content.
 *
 * @return string
 */
function gjmji_shortcode_mailjet_integration( $atts = array(), $content = '' ): string {
	$content .= '<div class="gjmji-response"></div>';

	$content .= '<form class="gjmji-subscribe" method="post">';
	$content .= '<input type="email" name="email" placeholder="' . __( 'Email address', 'grandeljay-mailjet-integration' ) . '">';
	$content .= '<input type="submit" value="' . __( 'Subscribe', 'grandeljay-mailjet-integration' ) . '">';
	$content .= '</form>';

	return $content;
}

add_shortcode( 'mailjet_integration', 'gjmji_shortcode_mailjet_integration' );
