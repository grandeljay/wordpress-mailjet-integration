<?php

/**
 * confirm-email.php
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
		MJ4WP_API_KEY,
		MJ4WP_API_SECRET,
		true,
		array(
			'version' => MJ4WP_API_VERSION,
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

	// phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedIf
	if ( $contact_add->success() ) {
		/** Creating a contact has succeeded. */
		echo 'Contact has been successfully added!<br />';
	} else {
		/** Creating a contact has failed. */
		echo '<pre>';
		var_dump( $contact_add->getData() );
		echo '</pre>';
	}

}
