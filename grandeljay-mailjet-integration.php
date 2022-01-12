<?php
/**
 * Integration for Mailjet
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 *
 * @wordpress-plugin
 * Plugin Name:       Integration for Mailjet
 * Description:       A simple free and open source integration for Mailjet into WordPress.
 * Version:           0.3.2
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

define( 'WPMJI_PLUGIN', __FILE__ );

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

/**
 * Set the activation hook for a plugin
 *
 * Note that register_activation_hook must not be registered from within another
 * hook for example 'plugins_loaded' or 'init' as these will have all been
 * called before the plugin is loaded or activated.
 *
 * @link https://developer.wordpress.org/reference/functions/register_activation_hook/
 *
 * @return void
 */
function gjmji_register_activation_hook() {
	global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();
	$table_consent   = $wpdb->prefix . 'gjmji_consent';

	$sql_consent = "CREATE TABLE IF NOT EXISTS $table_consent (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
		email varchar(255) NOT NULL,
		language varchar(2) NOT NULL,
		PRIMARY KEY  (id),
		UNIQUE KEY  (email)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql_consent );
}

register_activation_hook( WPMJI_PLUGIN, 'gjmji_register_activation_hook' );

/**
 * Sets the deactivation hook for a plugin
 *
 * @link https://developer.wordpress.org/reference/functions/register_deactivation_hook/
 *
 * @return void
 */
function gjmji_register_deactivation_hook() {
}

register_deactivation_hook( WPMJI_PLUGIN, 'gjmji_register_deactivation_hook' );

/**
 * Sets the uninstallation hook for a plugin
 *
 * @link https://developer.wordpress.org/reference/functions/register_uninstall_hook/
 *
 * @return void
 */
function gjmji_register_uninstall_hook() {
	if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
		die();
	}

	global $wpdb;

	$table_consent = $wpdb->prefix . 'gjmji_consent';

	/**
	 * Disable PHPCS Errors and Warnings
	 *
	 * I am unable to make this work with Prepare. If you know how to,
	 * please help me out.
	 * If've tried
	 *
	 * $wpdb->query(
	 *     $wpdb->prepare(
	 *         'DROP TABLE %s',
	 *         $table_consent
	 *     )
	 * );
	 *
	 * But got
	 * You have an error in your SQL syntax; check the manual that corresponds
	 * to your MariaDB server version for the right syntax to use
	 * near ''wp_gjmji_consent'' [...]
	 *
	 * phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
	 * phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery
	 * phpcs:disable WordPress.DB.DirectDatabaseQuery.SchemaChange
	 */
	$wpdb->query( 'DROP TABLE IF EXISTS `' . $table_consent . '`' );
	/**
	 * Enable PHPCS Errors and Warnings
	 *
	 * phpcs:enable WordPress.DB.PreparedSQL.NotPrepared
	 * phpcs:enable WordPress.DB.DirectDatabaseQuery.DirectQuery
	 * phpcs:enable WordPress.DB.DirectDatabaseQuery.SchemaChange
	 */
}

register_uninstall_hook( WPMJI_PLUGIN, 'gjmji_register_uninstall_hook' );
