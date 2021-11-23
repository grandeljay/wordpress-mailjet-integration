<?php

/**
 * get-page-id-subscribe.php
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

function get_page_id_subscribe_success() {
	$id = 0;

	if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
		$id = apply_filters(
			'wpml_object_id',
			GJMJ4WP_PAGE_EMAIL_CONFIRMATION_SUCCESS,
			get_post_type( GJMJ4WP_PAGE_EMAIL_CONFIRMATION_SUCCESS ),
			true,
			GJMJ4WP_LANGUAGE_DEFAULT,
		);
	}

	return $id;
}

function get_page_id_subscribe_failure() {
	$id = 0;

	if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
		$id = apply_filters(
			'wpml_object_id',
			GJMJ4WP_PAGE_EMAIL_CONFIRMATION_FAILURE,
			get_post_type( GJMJ4WP_PAGE_EMAIL_CONFIRMATION_FAILURE ),
			true,
			GJMJ4WP_LANGUAGE_DEFAULT,
		);
	}

	return $id;
}
