<?php
/**
 * WordPress Initialisation
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Load Textdomain
 */
function gjmj4wp_load_textdomain() {
	load_plugin_textdomain(
		'grandeljay-mailjet-for-wordpress',
		false,
		dirname( plugin_basename( GJMF4WP_PLUGIN ) ) . '/languages'
	);
}

add_action( 'init', 'gjmj4wp_load_textdomain' );
