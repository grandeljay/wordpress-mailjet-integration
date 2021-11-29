<?php
/**
 * Get Page ID for Subscription events
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Success
 *
 * @return int
 */
function get_page_id_subscribe_success(): int {
	$id = 0;

	if ( is_wpml_active() ) {
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

/**
 * Failure
 *
 * @return int
 */
function get_page_id_subscribe_failure(): int {
	$id = 0;

	if ( is_wpml_active() ) {
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
