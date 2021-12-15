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
	$content .= '<input type="email" name="email" placeholder="' . __( 'Email address', 'grandeljay-mailjet-integration' ) . '" required />';
	$content .= '<label><input type="checkbox" name="consent" required /> ' . __( 'I agree to the processing of my personal data for advertising purposes and to receive e-mail for advertising purposes. I can revoke the given consent at any time with effect for the future in any appropriate form.', 'grandeljay-mailjet-integration' ) . '</label>';
	$content .= '<input type="submit" value="' . __( 'Subscribe', 'grandeljay-mailjet-integration' ) . '">';
	$content .= '</form>';

	return $content;
}

add_shortcode( 'mailjet_integration', 'gjmji_shortcode_mailjet_integration' );
