<?php

/**
 * Mailjet for WordPress shortcode (subscription form)
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

function gjmj4wp_shortcode_mailjet_for_wordpress( $atts = array(), $content = '' ) {
	$content .= '<div class="gjmj4wp-response"></div>';

	$content .= '<form class="gjmj4wp-subscribe" method="post">';
	$content .= '<input type="email" name="email" placeholder="' . __( 'Email address', 'grandeljay-mailjet-for-wordpress' ) . '">';
	$content .= '<input type="submit" value="' . __( 'Subscribe', 'grandeljay-mailjet-for-wordpress' ) . '">';
	$content .= '</form>';

	return $content;
}

add_shortcode( 'mailjet_for_wordpress', 'gjmj4wp_shortcode_mailjet_for_wordpress' );
