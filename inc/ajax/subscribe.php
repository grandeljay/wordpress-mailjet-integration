<?php
/**
 * Subscribe
 *
 * Sends a confirmation email to the specified email address.
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Subscribe
 *
 * @return void
 */
function gjmji_ajax_subscribe(): void {
	check_ajax_referer( 'WPMJI-AJAX' );

	if ( ! isset( $_POST['email'] ) ) {
		wp_die();
	}

	/**
	 * Mailjet
	 */
	$mailjet = new \Mailjet\Client(
		get_option( WPMJI_MAILJET_API_KEY ),
		get_option( WPMJI_MAILJET_API_SECRET ),
		true,
		array(
			'version' => get_option( WPMJI_MAILJET_API_VERSION ),
		)
	);

	/**
	 * Send confirmation mail
	 *
	 * Using a checksum and an nonce is probably unnecessary. However, I only
	 * noticed that after creating both and thought it couldn't harm to keep
	 * them.
	 */
	// phpcs:disable WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
	$s_doc_root              = isset( $_SERVER['DOCUMENT_ROOT'] ) ? $_SERVER['DOCUMENT_ROOT'] : '';
	$email                   = sanitize_email( wp_unslash( $_POST['email'] ) );
	$checksum                = sha1( 'WPMJI-' . $s_doc_root . '-' . $email );
	$nonce                   = wp_create_nonce( 'newsletter-subscribe' );
	$confirmation_link       = get_site_url() . '/?gjmp4wp-email=' . $email . '&gjmp4wp-checksum=' . $checksum . '&gjmp4wp-nonce=' . $nonce;
	$email_confirmation_body = array();

	switch ( get_option( WPMJI_MAILJET_API_VERSION_SEND ) ) {
		case 'v3':
			$email_confirmation_body = array(
				'FromEmail'           => get_option( WPMJI_MAILJET_TEMPLATE_EMAIL_FROM ),
				'FromName'            => get_option( WPMJI_MAILJET_TEMPLATE_EMAIL_NAME ),
				'Subject'             => 'Confirm your email',
				'Recipients'          => array(
					array(
						'Email' => $email,
					),
				),
				'MJ-TemplateID'       => gjmji_get_template_id(),
				'MJ-TemplateLanguage' => true,
				'Vars'                => array(
					'approximatename'  => explode( '@', $email )[0],
					'confirmationlink' => $confirmation_link,
				),
			);
			break;

		case 'v3.1':
			$email_confirmation_body = array(
				'Messages' => array(
					array(
						'From'             => array(
							'Email' => get_option( WPMJI_MAILJET_TEMPLATE_EMAIL_FROM ),
							'Name'  => get_option( WPMJI_MAILJET_TEMPLATE_EMAIL_NAME ),
						),
						'To'               => array(
							array(
								'Email' => $email,
							),
						),
						'TemplateID'       => gjmji_get_template_id(),
						'TemplateLanguage' => true,
						'Subject'          => 'Confirm your email',
						'Variables'        => array(
							'approximatename'  => explode( '@', $email )[0],
							'confirmationlink' => $confirmation_link,
						),
					),
				),
			);
			break;
	}

	$email_confirmation = $mailjet->post(
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		\Mailjet\Resources::$Email,
		array(
			'body' => $email_confirmation_body,
		),
	);

	/**
	 * Fallback to Send API v3 if v3.1 fails
	 *
	 * Sometimes v3.1 just returns an empty response, we'll fallback to v3
	 * here and try again.
	 */
	if ( empty( $email_confirmation->getData() ) && 'v3' !== get_option( WPMJI_MAILJET_API_VERSION_SEND ) ) {
		update_option( WPMJI_MAILJET_API_VERSION_SEND, 'v3' );

		gjmji_ajax_subscribe();
		wp_die();
	}

	if ( $email_confirmation->success() ) {
		/**
		 * Sending a confirmation email has succeeded
		 */
		wp_send_json_success(
			array(
				'message' => esc_html__( 'Please confirm your email address.', 'grandeljay-mailjet-integration' ),
			),
		);
	} else {
		/**
		 * Sending a confirmation email has failed
		 */
		wp_send_json_error(
			$email_confirmation->getData()
		);
	}

	wp_die();
}

add_action( 'wp_ajax_gjmji_ajax_subscribe', 'gjmji_ajax_subscribe' );
add_action( 'wp_ajax_nopriv_gjmji_ajax_subscribe', 'gjmji_ajax_subscribe' );
