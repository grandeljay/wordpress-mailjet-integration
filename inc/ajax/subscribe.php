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
function gjmj4wp_ajax_subscribe(): void {
	check_ajax_referer( 'GJMJ4WP-AJAX' );

	if ( ! isset( $_POST['email'] ) ) {
		wp_die();
	}

	/**
	 * Mailjet
	 */
	$mailjet = new \Mailjet\Client(
		GJMJ4WP_API_KEY,
		GJMJ4WP_API_SECRET,
		true,
		array(
			'version' => GJMJ4WP_SEND_API_VERSION,
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
	$checksum                = sha1( 'GJMJ4WP-' . $s_doc_root . '-' . $email );
	$nonce                   = wp_create_nonce( 'newsletter-subscribe' );
	$confirmation_link       = get_site_url() . '/?gjmp4wp-email=' . $email . '&gjmp4wp-checksum=' . $checksum . '&gjmp4wp-nonce=' . $nonce;
	$email_confirmation_body = array();

	switch ( GJMJ4WP_SEND_API_VERSION ) {
		case 'v3':
			$email_confirmation_body = array(
				'FromEmail'           => GJMJ4WP_TEMPLATE_FROM_EMAIL,
				'FromName'            => GJMJ4WP_TEMPLATE_FROM_NAME,
				'Subject'             => 'Confirm your email',
				'Recipients'          => array(
					array(
						'Email' => $email,
					),
				),
				'MJ-TemplateID'       => GJMJ4WP_TEMPLATE_CONFIRMATION[ GJMJ4WP_LANGUAGE_DEFAULT ],
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
							'Email' => GJMJ4WP_TEMPLATE_FROM_EMAIL,
							'Name'  => GJMJ4WP_TEMPLATE_FROM_NAME,
						),
						'To'               => array(
							array(
								'Email' => $email,
							),
						),
						'TemplateID'       => GJMJ4WP_TEMPLATE_CONFIRMATION[ GJMJ4WP_LANGUAGE_DEFAULT ],
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

	if ( $email_confirmation->success() ) {
		/**
		 * Sending a confirmation email has succeeded
		 */
		echo wp_send_json_success(
			array(
				'message' => esc_html__( 'Please confirm your email address.', 'grandeljay-mailjet-for-wordpress' ),
			),
		);
	} else {
		/**
		 * Sending a confirmation email has failed
		 */
		echo wp_send_json_error(
			$email_confirmation->getData()
		);
	}

	wp_die();
}

add_action( 'wp_ajax_gjmj4wp_ajax_subscribe', 'gjmj4wp_ajax_subscribe' );
add_action( 'wp_ajax_nopriv_gjmj4wp_ajax_subscribe', 'gjmj4wp_ajax_subscribe' );
