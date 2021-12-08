<?php
/**
 * Config
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/** Mailjet */
define( 'GJMJ4WP_MAILJET_API_VERSION', 'gjmj4wp-mailjet-api-version' );
define( 'GJMJ4WP_MAILJET_API_VERSION_SEND', 'gjmj4wp-mailjet-api-version-send' );
define( 'GJMJ4WP_MAILJET_API_KEY', 'gjmj4wp-mailjet-api-key' );
define( 'GJMJ4WP_MAILJET_API_SECRET', 'gjmj4wp-mailjet-api-secret' );

define( 'GJMJ4WP_MAILJET_TEMPLATE_ID_CONFIRMATION', 'gjmj4wp-mailjet-template-id-confirmation' );
define( 'GJMJ4WP_MAILJET_TEMPLATE_EMAIL_FROM', 'gjmj4wp-mailjet-template-email-from' );
define( 'GJMJ4WP_MAILJET_TEMPLATE_EMAIL_NAME', 'gjmj4wp-mailjet-template-email-name' );

/** WordPress */
define( 'GJMJ4WP_WORDPRESS_PAGE_ID_CONFIRMATION_SUCCESS', 'gjmj4wp-wordpress-page-id-confirmation-success' );
define( 'GJMJ4WP_WORDPRESS_PAGE_ID_CONFIRMATION_FAILURE', 'gjmj4wp-wordpress-page-id-confirmation-failure' );

/** WPML */
define( 'GJMJ4WP_LANGUAGE_DEFAULT', 'en' );
define(
	'GJMJ4WP_LANGUAGE_CURRENT',
	defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : GJMJ4WP_LANGUAGE_DEFAULT
);

/** Contact Properties */
define(
	'GJMJ4WP_CONTACT_PROPERTIES',
	array(
		'Name'  => 'language',
		'Value' => GJMJ4WP_LANGUAGE_CURRENT,
	)
);
