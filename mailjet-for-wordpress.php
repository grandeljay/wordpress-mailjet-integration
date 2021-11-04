<?php

/**
 * Mailjet for WordPress
 *
 * @author Jay Trees <j.trees@hybridsupply.de>
 *
 * @wordpress-plugin
 * Plugin Name:       Mailjet for WordPress
 * Description:       A simple integration for mailjet into WordPress.
 * Version:           0.1.0
 * Requires at least: 5.8
 * Requires PHP:      8.0
 * Author:            Jay Trees
 * Text Domain:       mailjet-for-wordpress
 */

require 'vendor/autoload.php';
require 'inc/config.php';

use MailjetResources;

$mj = new MailjetClient(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
$body = [
    'Messages' => [
    [
        'From' => [
        'Email' => "info@hybridsupply.uk",
        'Name' => "HybridSupply"
        ],
        'To' => [
        [
            'Email' => "passenger1@example.com",
            'Name' => "passenger 1"
        ]
        ],
        'TemplateID' => 3311910,
        'TemplateLanguage' => true,
        'Subject' => "Confirm your email",
        'Variables' => json_decode('{}', true)
    ]
    ]
];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success() && var_dump($response->getData());

if ( $response->success() ) {
	echo '<pre>';
	var_dump( $response->getData() );
	echo '</pre>';
} else {
	echo '<pre>';
	var_dump( $response );
	echo '</pre>';
}
