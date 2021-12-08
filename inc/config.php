<?php
/**
 * Config
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/** Mailjet */
define( 'WPMJI_MAILJET_API_VERSION', 'wpmji-mailjet-api-version' );
define( 'WPMJI_MAILJET_API_VERSION_SEND', 'wpmji-mailjet-api-version-send' );
define( 'WPMJI_MAILJET_API_KEY', 'wpmji-mailjet-api-key' );
define( 'WPMJI_MAILJET_API_SECRET', 'wpmji-mailjet-api-secret' );

define( 'WPMJI_MAILJET_TEMPLATE_ID_CONFIRMATION', 'wpmji-mailjet-template-id-confirmation' );
define( 'WPMJI_MAILJET_TEMPLATE_EMAIL_FROM', 'wpmji-mailjet-template-email-from' );
define( 'WPMJI_MAILJET_TEMPLATE_EMAIL_NAME', 'wpmji-mailjet-template-email-name' );

/** WordPress */
define( 'WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_SUCCESS', 'wpmji-wordpress-page-id-confirmation-success' );
define( 'WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_FAILURE', 'wpmji-wordpress-page-id-confirmation-failure' );

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
