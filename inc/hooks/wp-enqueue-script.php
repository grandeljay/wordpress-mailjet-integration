<?php

/**
 * wp_enqueue_script
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

function gjmj4wp_wp_enqueue_script() {
	wp_enqueue_script(
		'gjmj4wp-ajax',
		plugins_url( 'assets/js/ajax.js', __DIR__ ),
		array( 'jquery' ),
		filemtime( plugin_dir_path( __DIR__ ) . 'assets/js/ajax.js' ),
		true
	);
	wp_localize_script(
		'gjmj4wp-ajax',
		'gjmj4wp',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'GJMJ4WP-AJAX' ),
			'language' => GJMJ4WP_LANGUAGE_DEFAULT,
		)
	);
}

add_action( 'wp_enqueue_scripts', 'gjmj4wp_wp_enqueue_script' );
