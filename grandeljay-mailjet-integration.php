<?php
/**
 * Integration for Mailjet
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 *
 * @wordpress-plugin
 * Plugin Name:       Integration for Mailjet
 * Description:       A simple integration for Mailjet into WordPress.
 * Version:           0.2.2
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Author:            Jay Trees
 * Author URI:        https://github.com/grandeljay
 * Text Domain:       grandeljay-mailjet-integration
 * License:           APGL3
 * License URI:       https://github.com/grandeljay/grandeljay-mailjet-integration/blob/stable/LICENSE
 * Domain Path:       /languages
 *
 * @git-updater
 * GitHub Plugin URI: grandeljay/grandeljay-mailjet-integration
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
function gjmji_initialize() {
	include 'vendor/autoload.php';
	include 'inc/functions/auto-include.php';
	include 'inc/config.php';

	define( 'WPMJI', __DIR__ );

	gjmji_auto_include( WPMJI . '/inc/functions' );
	gjmji_auto_include( WPMJI . '/inc/shortcodes' );
	gjmji_auto_include( WPMJI . '/inc/hooks' );
	gjmji_auto_include( WPMJI . '/inc/ajax' );
}

add_action( 'plugins_loaded', 'gjmji_initialize' );
