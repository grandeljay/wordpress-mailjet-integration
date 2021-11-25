<?php
/**
 * Config
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Mailjet API
 */
define( 'GJMJ4WP_API_VERSION', 'v3' );
define( 'GJMJ4WP_SEND_API_VERSION', 'v3.1' );
define( 'GJMJ4WP_API_KEY', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX' );
define( 'GJMJ4WP_API_SECRET', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX' );

/**
 * Mailjet Template
 */
define( 'GJMJ4WP_TEMPLATE_CONFIRMATION', 0 );

define( 'GJMJ4WP_TEMPLATE_FROM_EMAIL', 'email@domain.tld' );
define( 'GJMJ4WP_TEMPLATE_FROM_NAME', 'Company Name' );

/**
 * WordPress
 */
define( 'GJMJ4WP_PAGE_EMAIL_CONFIRMATION_SUCCESS', 0 );
define( 'GJMJ4WP_PAGE_EMAIL_CONFIRMATION_FAILURE', 0 );

/**
 * WPML
 *
 * Language to use if WMPL is not installed.
 */
define(
	'GJMJ4WP_LANGUAGE_DEFAULT',
	defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : 'en'
);

/**
 * Contact Properties
 */
define(
	'GJMJ4WP_CONTACT_PROPERTIES',
	array(
		'Name'  => 'language',
		'Value' => GJMJ4WP_LANGUAGE_DEFAULT,
	)
);
