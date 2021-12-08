<?php
/**
 * Hook: wp
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Confirm Email
 *
 * @return void
 */
function gjmj4wp_confirm_email(): void {
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
	 *
	 * phpcs:disable Generic.Commenting.DocComment.MissingShort
	 * phpcs:disable WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	 * phpcs:disable WordPress.Security.ValidatedSanitizedInput.MissingUnslash
	 */
	if ( false === wp_verify_nonce( $_GET['gjmp4wp-nonce'], 'newsletter-subscribe' ) ) {
		wp_safe_redirect(
			add_query_arg(
				rawurlencode( 'gjmj4wp-response' ),
				rawurlencode( __( 'The link appears to no longer be valid.', 'grandeljay-mailjet-for-wordpress' ) ),
				get_page_link( get_page_id_subscribe_failure() ),
			)
		);
		die();
	}

	/**
	 * Verify checksum
	 */
	$s_doc_root = isset( $_SERVER['DOCUMENT_ROOT'] ) ? $_SERVER['DOCUMENT_ROOT'] : '';
	$checksum   = sha1( 'GJMJ4WP-' . $s_doc_root . '-' . $_GET['gjmp4wp-email'] );

	if ( $checksum !== $_GET['gjmp4wp-checksum'] ) {
		wp_safe_redirect(
			add_query_arg(
				rawurlencode( 'gjmj4wp-response' ),
				rawurlencode( __( 'The link appears to no longer be valid.', 'grandeljay-mailjet-for-wordpress' ) ),
				get_page_link( get_page_id_subscribe_failure() ),
			)
		);
		die();
	}
	/**
	 * phpcs:enable Generic.Commenting.DocComment.MissingShort
	 * phpcs:enable WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	 * phpcs:enable WordPress.Security.ValidatedSanitizedInput.MissingUnslash
	 */

	/**
	 * Add Contact
	 */
	$mailjet = new \Mailjet\Client(
		get_option( GJMJ4WP_MAILJET_API_KEY ),
		get_option( GJMJ4WP_MAILJET_API_SECRET ),
		true,
		array(
			'version' => get_option( GJMJ4WP_MAILJET_API_VERSION ),
		)
	);

	$contact_add_body = array(
		'Email' => sanitize_email( wp_unslash( $_GET['gjmp4wp-email'] ) ),
	);

	$contact_add = $mailjet->post(
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		\Mailjet\Resources::$Contact,
		array(
			'body' => $contact_add_body,
		)
	);

	/**
	 * Contact Properties
	 *
	 * @link https://dev.mailjet.com/email/reference/contacts/contact-properties/
	 */
	$properties_update_body = array(
		'Data' => array( GJMJ4WP_CONTACT_PROPERTIES ),
	);

	if ( defined( 'GJMJ4WP_CONTACT_PROPERTIES' ) && count( GJMJ4WP_CONTACT_PROPERTIES ) > 0 ) {
		$properties_update = $mailjet->put(
			// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			\Mailjet\Resources::$Contactdata,
			array(
				// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
				'id'   => $contact_add->getBody()['Data'][0]['ID'],
				'body' => $properties_update_body,
			)
		);
	}

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
