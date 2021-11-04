<?php

/**
 * Mailjet for WordPress shortcode
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

function gjmj4wp_shortcode_mailjet_for_wordpress( $atts = array(), $content = '' ) {
	$content .= 'Hello World';

	return $content;
}

add_shortcode( 'mailjet_for_wordpress', 'gjmj4wp_shortcode_mailjet_for_wordpress' );
