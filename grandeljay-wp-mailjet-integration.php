<?php
/**
 * WP Mailjet Integration
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 *
 * @wordpress-plugin
 * Plugin Name:       WP Mailjet Integration
 * Description:       A simple integration for Mailjet into WordPress.
 * Version:           0.2.2
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Author:            Jay Trees
 * Author URI:        https://github.com/grandeljay
 * Text Domain:       grandeljay-wp-mailjet-integration
 * License:           APGL3
 * License URI:       https://github.com/grandeljay/grandeljay-wp-mailjet-integration/blob/stable/LICENSE
 * Domain Path:       /languages
 *
 * @git-updater
 * GitHub Plugin URI: grandeljay/grandeljay-wp-mailjet-integration
 * Primary Branch: stable
 */

define( 'GJMF4WP_PLUGIN', __FILE__ );

/**
 * Initialize
 *
 * This plugin uses some WPML constants, hooks and filters.
 * WPML has to load before this plugin for the config to contain the correct
 * relevant information.
 *
 * @return void
 */
function wpmji_initialize() {
	include 'vendor/autoload.php';
	include 'inc/functions/auto-include.php';
	include 'inc/config.php';

	define( 'WPMJI', __DIR__ );

	wpmji_auto_include( WPMJI . '/inc/functions' );
	wpmji_auto_include( WPMJI . '/inc/shortcodes' );
	wpmji_auto_include( WPMJI . '/inc/hooks' );
	wpmji_auto_include( WPMJI . '/inc/ajax' );
}

add_action( 'plugins_loaded', 'wpmji_initialize' );
