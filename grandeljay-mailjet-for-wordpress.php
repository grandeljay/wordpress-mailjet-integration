<?php

/**
 * Mailjet for WordPress
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 *
 * @wordpress-plugin
 * Plugin Name:       Mailjet for WordPress
 * Description:       A simple integration for Mailjet into WordPress.
 * Version:           0.1.0
 * Requires at least: 5.8
 * Requires PHP:      8.0
 * Author:            Jay Trees
 * Text Domain:       grandeljay-mailjet-for-wordpress
 */

require 'vendor/autoload.php';
require 'inc/config.php';
require 'inc/functions/auto-include.php';

define( 'GJMJ4WP', __DIR__ );

gjmj4wp_auto_include( GJMJ4WP . '/inc/functions' );
gjmj4wp_auto_include( GJMJ4WP . '/inc/shortcodes' );
