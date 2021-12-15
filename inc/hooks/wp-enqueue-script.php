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
function gjmji_wp_enqueue_scripts(): void {
	/**
	 * Styles
	 */
	wp_enqueue_style(
		'gjmji-default-css',
		plugins_url( 'assets/css/default.css', __DIR__ ),
		array(),
		filemtime( plugin_dir_path( __DIR__ ) . 'assets/css/default.css' )
	);

	/**
	 * Scripts
	 */
	wp_enqueue_script(
		'gjmji-ajax',
		plugins_url( 'assets/js/ajax.js', __DIR__ ),
		array( 'jquery' ),
		filemtime( plugin_dir_path( __DIR__ ) . 'assets/js/ajax.js' ),
		true
	);
	wp_localize_script(
		'gjmji-ajax',
		'gjmji',
		array(
			'ajax_url'     => admin_url( 'admin-ajax.php' ),
			'nonce'        => wp_create_nonce( 'WPMJI-AJAX' ),
			'language'     => WPMJI_LANGUAGE_CURRENT,

			'text_loading' => __( 'Loading. Please wait...', 'grandeljay-mailjet-integration' ),
		)
	);
}

add_action( 'wp_enqueue_scripts', 'gjmji_wp_enqueue_scripts' );
