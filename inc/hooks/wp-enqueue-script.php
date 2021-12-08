<?php
/**
 * Enqueue Scripts
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Enqueue Scripts function
 *
 * @return void
 */
function wpmji_wp_enqueue_scripts(): void {
	/**
	 * Styles
	 */
	wp_enqueue_style(
		'wpmji-default-css',
		plugins_url( 'assets/css/default.css', __DIR__ ),
		array(),
		filemtime( plugin_dir_path( __DIR__ ) . 'assets/css/default.css' )
	);

	/**
	 * Scripts
	 */
	wp_enqueue_script(
		'wpmji-ajax',
		plugins_url( 'assets/js/ajax.js', __DIR__ ),
		array( 'jquery' ),
		filemtime( plugin_dir_path( __DIR__ ) . 'assets/js/ajax.js' ),
		true
	);
	wp_localize_script(
		'wpmji-ajax',
		'wpmji',
		array(
			'ajax_url'     => admin_url( 'admin-ajax.php' ),
			'nonce'        => wp_create_nonce( 'WPMJI-AJAX' ),
			'language'     => WPMJI_LANGUAGE_DEFAULT,

			'text_loading' => __( 'Loading. Please wait...', 'grandeljay-wp-mailjet-integration' ),
		)
	);
}

add_action( 'wp_enqueue_scripts', 'wpmji_wp_enqueue_scripts' );
