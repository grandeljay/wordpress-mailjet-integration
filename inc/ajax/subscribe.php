<?php

/**
 * subscribe.php
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

function gjmj4wp_ajax_subscribe() {
	check_ajax_referer( 'GJMJ4WP-AJAX' );

	/**
	 * Mailjet
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

	/**
	 * Send confirmation mail
	 *
	 * Using a checksum and an nonce is probably unnecessary.
	 * However, I only noticed that after creating both and thought
	 * it couldn't harm to keep both.
	 */
	$checksum                = sha1( 'GJMJ4WP-' . $_SERVER['DOCUMENT_ROOT'] . '-' . $_POST['email'] );
	$nonce                   = wp_create_nonce( 'newsletter-subscribe' );
	$condirmation_link       = get_site_url() . '/?gjmp4wp-email=' . $_POST['email'] . '&gjmp4wp-checksum=' . $checksum . '&gjmp4wp-nonce=' . $nonce;
	$email_confirmation_body = array();

	switch ( GJMJ4WP_API_VERSION ) {
		case 'v3':
			$email_confirmation_body = array(
				'FromEmail'           => GJMJ4WP_TEMPLATE_FROM_EMAIL,
				'FromName'            => GJMJ4WP_TEMPLATE_FROM_NAME,
				'Subject'             => 'Confirm your email',
				'Recipients'          => array(
					array(
						'Email' => $_POST['email'],
					),
				),
				'MJ-TemplateID'       => GJMJ4WP_TEMPLATE_CONFIRMATION[ GJMJ4WP_LANGUAGE_DEFAULT ],
				'MJ-TemplateLanguage' => true,
				'Vars'                => array(
					'approximatename'  => explode( '@', $_POST['email'] )[0],
					'confirmationlink' => $condirmation_link,
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
								'Email' => $_POST['email'],
							),
						),
						'TemplateID'       => GJMJ4WP_TEMPLATE_CONFIRMATION[ GJMJ4WP_LANGUAGE_DEFAULT ],
						'TemplateLanguage' => true,
						'Subject'          => 'Confirm your email',
						'Variables'        => array(
							'approximatename'  => explode( '@', $_POST['email'] )[0],
							'confirmationlink' => $condirmation_link,
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

		// The output is indeed being escaped and therefore
		// this error will be ignored.
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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
