<?php
/**
 * WordPress Initialisation
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Load Textdomain
 */
function gjmji_load_textdomain() {
	load_plugin_textdomain(
		'grandeljay-mailjet-integration',
		false,
		dirname( plugin_basename( GJMF4WP_PLUGIN ) ) . '/languages'
	);
}

add_action( 'init', 'gjmji_load_textdomain' );
