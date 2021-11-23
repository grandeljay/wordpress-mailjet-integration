<?php

/**
 * wp
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

function gjmj4wp_confirm_email() {
	/**
	 * Verify fields
	 */
	if (
		! isset(
			$_GET['gjmp4wp-email'],
			$_GET['gjmp4wp-checksum'],
			$_GET['gjmp4wp-nonce']
		)
	) {
		return;
	}

	/**
	 * Verify nonce
	 */
	if ( false === wp_verify_nonce( $_GET['gjmp4wp-nonce'], 'newsletter-subscribe' ) ) {
		wp_safe_redirect(
			add_query_arg(
				rawurlencode( 'gjmj4wp-response' ),
				rawurlencode( __( 'The link appears to no longer be valid.', 'grandeljay-mailjet-for-wordpress' ) ),
				get_page_link( get_page_id_subscribe_failure() ),
			)
		);
		return;
	}

	/**
	 * Verify checksum
	 */
	$checksum = sha1( 'GJMJ4WP-' . $_SERVER['DOCUMENT_ROOT'] . '-' . $_GET['gjmp4wp-email'] );

	if ( $checksum !== $_GET['gjmp4wp-checksum'] ) {
		wp_safe_redirect(
			add_query_arg(
				rawurlencode( 'gjmj4wp-response' ),
				rawurlencode( __( 'The link appears to no longer be valid.', 'grandeljay-mailjet-for-wordpress' ) ),
				get_page_link( get_page_id_subscribe_failure() ),
			)
		);
		return;
	}

	/**
	 * Add Contact
	 */

	// phpcs:disable Generic.Formatting.MultipleStatementAlignment.NotSameWarning
	$mailjet = new \Mailjet\Client(
		GJMJ4WP_API_KEY,
		GJMJ4WP_API_SECRET,
		true,
		array(
			'version' => GJMJ4WP_API_VERSION,
		)
	);

	$contact_add_body = array(
		'Email' => $_GET['gjmp4wp-email'],
	);

	$contact_add = $mailjet->post(
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		\Mailjet\Resources::$Contact,
		array(
			'body' => $contact_add_body,
		)
	);
	// phpcs:enable Generic.Formatting.MultipleStatementAlignment.NotSameWarning

	/**
	 * Contact Properties
	 *
	 * @link https://dev.mailjet.com/email/reference/contacts/contact-properties/
	 */
	$properties_add_body = array(
		'Data' => array( GJMJ4WP_CONTACT_PROPERTIES ),
	);

	/**
	 * Redirect
	 */
	$id = get_page_id_subscribe_failure();

	if ( $contact_add->success() ) {
		$id = get_page_id_subscribe_success();
	}

	/** Target */
	$redirect_target = get_page_link( $id );

	if ( $contact_add->getBody() ) {
		foreach ( $contact_add->getBody() as $key => $value ) {
			$redirect_target = add_query_arg(
				rawurlencode( $key ),
				rawurlencode( $value ),
				$redirect_target
			);
		}
	}

	wp_safe_redirect( $redirect_target );
	die();

}

add_action( 'wp', 'gjmj4wp_confirm_email' );
