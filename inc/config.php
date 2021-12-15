<?php
/**
 * Config
 *
 * These are the slugs for the options in WordPress.
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/** Mailjet */
define( 'WPMJI_MAILJET_API_VERSION', 'gjmji-mailjet-api-version' );
define( 'WPMJI_MAILJET_API_VERSION_SEND', 'gjmji-mailjet-api-version-send' );
define( 'WPMJI_MAILJET_API_KEY', 'gjmji-mailjet-api-key' );
define( 'WPMJI_MAILJET_API_SECRET', 'gjmji-mailjet-api-secret' );

define( 'WPMJI_MAILJET_TEMPLATE_ID_CONFIRMATION', 'gjmji-mailjet-template-id-confirmation' );
define( 'WPMJI_MAILJET_TEMPLATE_EMAIL_FROM', 'gjmji-mailjet-template-email-from' );
define( 'WPMJI_MAILJET_TEMPLATE_EMAIL_NAME', 'gjmji-mailjet-template-email-name' );

/** WordPress */
define( 'WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_SUCCESS', 'gjmji-wordpress-page-id-confirmation-success' );
define( 'WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_FAILURE', 'gjmji-wordpress-page-id-confirmation-failure' );

/** WPML */
define( 'WPMJI_LANGUAGE_DEFAULT', 'en' );
define(
	'WPMJI_LANGUAGE_CURRENT',
	defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : WPMJI_LANGUAGE_DEFAULT
);

/** Contact Properties */
define(
	'WPMJI_CONTACT_PROPERTIES',
	array(
		'Name'  => 'language',
		'Value' => WPMJI_LANGUAGE_CURRENT,
	)
);
