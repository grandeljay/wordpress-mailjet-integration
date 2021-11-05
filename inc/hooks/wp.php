<?php

/**
 * wp
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

function gjmj4wp_confirm_email() {
	if ( ! isset( $_GET['gjmp4wp-email'], $_GET['gjmp4wp-checksum'] ) ) {
		return;
	}

	/**
	 * Checksum
	 */
	$checksum = sha1( 'GJMJ4WP-' . $_SERVER['DOCUMENT_ROOT'] . '-' . $_GET['gjmp4wp-email'] );

	if ( $checksum !== $_GET['gjmp4wp-checksum'] ) {
		return;
	}

	/**
	 * Add Contact
	 */

    // phpcs:ignore Generic.Formatting.MultipleStatementAlignment.NotSameWarning
	$mailjet = new \Mailjet\Client(
		GJMJ4WP_API_KEY,
		GJMJ4WP_API_SECRET,
		true,
		array(
			'version' => GJMJ4WP_API_VERSION,
		)
	);

	// phpcs:ignore Generic.Formatting.MultipleStatementAlignment.NotSameWarning
	$contact_add_body = array(
		'Email' => $_GET['gjmp4wp-email'],
	);

	// phpcs:ignore Generic.Formatting.MultipleStatementAlignment.NotSameWarning
	$contact_add = $mailjet->post(
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		\Mailjet\Resources::$Contact,
		array(
			'body' => $contact_add_body,
		)
	);

	/**
	 * Redirect
	 */
	if ( $contact_add->success() ) {
		/** Creating a contact has succeeded. */
		$id = apply_filters(
			'wpml_object_id',
			GJMJ4WP_PAGE_EMAIL_CONFIRMATION_SUCCESS,
			get_post_type( GJMJ4WP_PAGE_EMAIL_CONFIRMATION_SUCCESS ),
			true,
			GJMJ4WP_LANGUAGE_DEFAULT,
		);
	} else {
		/** Creating a contact has failed. */
		$id = apply_filters(
			'wpml_object_id',
			GJMJ4WP_PAGE_EMAIL_CONFIRMATION_FAILURE,
			get_post_type( GJMJ4WP_PAGE_EMAIL_CONFIRMATION_FAILURE ),
			true,
			GJMJ4WP_LANGUAGE_DEFAULT,
		);
	}

	wp_safe_redirect( get_page_link( $id ) );
	die();

}

add_action( 'wp', 'gjmj4wp_confirm_email' );
