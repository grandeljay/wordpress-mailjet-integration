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
	$id = get_option( WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_SUCCESS );

	if ( is_wpml_active() ) {
		$id = apply_filters(
			'wpml_object_id',
			$id,
			get_post_type( $id ),
			true,
			WPMJI_LANGUAGE_DEFAULT,
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
	$id = get_option( WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_FAILURE );

	if ( is_wpml_active() ) {
		$id = apply_filters(
			'wpml_object_id',
			$id,
			get_post_type( $id ),
			true,
			WPMJI_LANGUAGE_DEFAULT,
		);
	}

	return $id;
}
