<?php

/**
 * subscribe.php
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

function gjmj4wp_ajax_subscribe() {
	check_ajax_referer( 'gjmj4wp' );

	/**
	 * Mailjet
	 */

	// phpcs:ignore Generic.Formatting.MultipleStatementAlignment.NotSameWarning
	$mailjet = new \Mailjet\Client(
		MJ4WP_API_KEY,
		MJ4WP_API_SECRET,
		true,
		array(
			'version' => MJ4WP_API_VERSION,
		)
	);

	/**
	 * Create new contact
	 */

	// phpcs:ignore Generic.Formatting.MultipleStatementAlignment.NotSameWarning
	$contact_add_body = array(
		'IsExcludedFromCampaigns' => 'true',
		'Email'                   => $_POST['email'],
	);

	// phpcs:ignore Generic.Formatting.MultipleStatementAlignment.NotSameWarning
	$contact_add = $mailjet->post(
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		\Mailjet\Resources::$Contact,
		array(
			'body' => $contact_add_body,
		)
	);

	// phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedIf
	if ( $contact_add->success() ) {
		/** Creating a contact has succeeded. */
	} else {
		/** Creating a contact has failed. */
		$data = $contact_add->getData();

		if ( $data ) {
			echo wp_send_json_error( $data );
		} else {
			/**
			 * Continue
			 *
			 * Maybe the contact already exists.
			 */
			/*
			wp_send_json_error(
				array(
					'message' => __( 'Failure (unknown reason)', 'grandeljay-mailjet-for-wordpress' ),
				),
			);
			*/
		}
	}

	/**
	 * Send confirmation mail
	 */
	$email_confirmation_body = array(
		'Messages' => array(
			array(
				'From' => array(
					'Email' => MJ4WP_TEMPLATE_FROM_EMAIL,
					'Name'  => MJ4WP_TEMPLATE_FROM_NAME,
				),
				'To' => array(
					array(
						'Email' => $_POST['email'],
					),
				),
				'TemplateID'       => MJ4WP_TEMPLATE_CONFIRMATION,
				'TemplateLanguage' => true,
				'Subject'          => 'Confirm your email',
			),
		),
	);

	$email_confirmation = $mailjet->post(
		// phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		\Mailjet\Resources::$Email,
		array(
			'body' => $email_confirmation_body,
		),
	);

	if ( $email_confirmation->success() ) {
		/** Sending a confirmation email has succeeded. */
		echo wp_send_json_success(
			array(
				'message' => __( 'Please confirm your email address.', 'grandeljay-mailjet-for-wordpress' ),
			),
		);
	} else {
		/** Sending a confirmation email has failed. */
		echo wp_send_json_error(
			$email_confirmation->getData()
		);
	}

	wp_die();
}

add_action( 'wp_ajax_gjmj4wp_ajax_subscribe', 'gjmj4wp_ajax_subscribe' );
