<?php
/**
 * Enqueue Admin Scripts
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Enqueue the admin scripts.
 *
 * @param string $hook Hook suffix for the current admin page.
 */
function wpdocs_selectively_enqueue_admin_script( $hook ): void {
	if ( 'toplevel_page_wpmji-options' !== $hook ) {
		return;
	}

	/**
	 * Styles
	 */
	wp_enqueue_style(
		'wpmji-admin-css',
		plugins_url( 'assets/css/admin.css', __DIR__ ),
		array(),
		filemtime( plugin_dir_path( __DIR__ ) . 'assets/css/admin.css' )
	);
}

add_action( 'admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script' );
