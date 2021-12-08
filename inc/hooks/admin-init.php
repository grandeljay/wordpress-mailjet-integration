<?php
/**
 * Admin Initialization
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Settings
 *
 * @link https://developer.wordpress.org/apis/handbook/settings/
 */
function wpmji_settings() {
	/**
	 * Sections
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_settings_section/
	 */
	$wpmji_sections = array(
		/** Mailjet API */
		array(
			'id'       => WPMJI_SETTINGS_MAILJET_API,
			'title'    => __( 'Mailjet API', 'grandeljay-wp-mailjet-integration' ),
			'callback' => 'wpmji_setting_section_html_mailjet_api',
			'page'     => WPMJI_SETTINGS_MAILJET_API,
		),

		/** Mailjet Template */
		array(
			'id'       => WPMJI_SETTINGS_MAILJET_TEMPLATE,
			'title'    => __( 'Mailjet Template', 'grandeljay-wp-mailjet-integration' ),
			'callback' => 'wpmji_setting_section_html_mailjet_template',
			'page'     => WPMJI_SETTINGS_MAILJET_TEMPLATE,
		),

		/** WordPress */
		array(
			'id'       => WPMJI_SETTINGS_WORDPRESS,
			'title'    => __( 'WordPress', 'grandeljay-wp-mailjet-integration' ),
			'callback' => 'wpmji_setting_section_html_wordpress',
			'page'     => WPMJI_SETTINGS_WORDPRESS,
		),
	);

	/** WPML */
	if ( is_wpml_active() ) {
		$wpmji_sections[] = array(
			'id'       => WPMJI_SETTINGS_WPML,
			'title'    => __( 'WPML', 'grandeljay-wp-mailjet-integration' ),
			'callback' => 'wpmji_setting_section_html_wpml',
			'page'     => WPMJI_SETTINGS_WPML,
		);
	}

	foreach ( $wpmji_sections as $section ) {
		add_settings_section(
			$section['id'],
			$section['title'],
			$section['callback'],
			$section['page'],
		);
	}

	/**
	 * Fields
	 */
	$wpmji_fields = array(
		/**
		 * Mailjet API
		 */

		/** Version */
		array(
			array(
				'id'       => WPMJI_MAILJET_API_VERSION,
				'title'    => __( 'Version', 'grandeljay-wp-mailjet-integration' ),
				'callback' => 'wpmji_setting_section_html_mailjet_api_version',
				'page'     => WPMJI_SETTINGS_MAILJET_API,
				'section'  => WPMJI_SETTINGS_MAILJET_API,
				'args'     => array(
					'label_for' => WPMJI_MAILJET_API_VERSION,
				),
			),
			array(
				'option_group' => WPMJI_SETTINGS_MAILJET_API,
				'option_name'  => WPMJI_MAILJET_API_VERSION,
				'args'         => array(
					'type'         => 'string',
					'description'  => 'The current API version to use.',
					'show_in_rest' => false,
					'default'      => 'v3',
				),
			),
		),

		/** Version (Send) */
		array(
			array(
				'id'       => WPMJI_MAILJET_API_VERSION_SEND,
				'title'    => __( 'Version (Send)', 'grandeljay-wp-mailjet-integration' ),
				'callback' => 'wpmji_setting_section_html_mailjet_api_version_send',
				'page'     => WPMJI_SETTINGS_MAILJET_API,
				'section'  => WPMJI_SETTINGS_MAILJET_API,
				'args'     => array(
					'label_for' => WPMJI_MAILJET_API_VERSION_SEND,
				),
			),
			array(
				'option_group' => WPMJI_SETTINGS_MAILJET_API,
				'option_name'  => WPMJI_MAILJET_API_VERSION_SEND,
				'args'         => array(
					'type'         => 'string',
					'description'  => 'The current Send API version to use.',
					'show_in_rest' => false,
					'default'      => 'v3.1',
				),
			),
		),

		/** Key */
		array(
			array(
				'id'       => WPMJI_MAILJET_API_KEY,
				'title'    => __( 'Key', 'grandeljay-wp-mailjet-integration' ),
				'callback' => 'wpmji_setting_section_html_mailjet_api_key',
				'page'     => WPMJI_SETTINGS_MAILJET_API,
				'section'  => WPMJI_SETTINGS_MAILJET_API,
				'args'     => array(
					'label_for' => WPMJI_MAILJET_API_KEY,
				),
			),
			array(
				'option_group' => WPMJI_SETTINGS_MAILJET_API,
				'option_name'  => WPMJI_MAILJET_API_KEY,
				'args'         => array(
					'type'         => 'string',
					'description'  => 'The Mailjet API Key to use.',
					'show_in_rest' => false,
					'default'      => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
				),
			),
		),

		/** Secret */
		array(
			array(
				'id'       => WPMJI_MAILJET_API_SECRET,
				'title'    => __( 'Secret', 'grandeljay-wp-mailjet-integration' ),
				'callback' => 'wpmji_setting_section_html_mailjet_api_secret',
				'page'     => WPMJI_SETTINGS_MAILJET_API,
				'section'  => WPMJI_SETTINGS_MAILJET_API,
				'args'     => array(
					'label_for' => WPMJI_MAILJET_API_SECRET,
				),
			),
			array(
				'option_group' => WPMJI_SETTINGS_MAILJET_API,
				'option_name'  => WPMJI_MAILJET_API_SECRET,
				'args'         => array(
					'type'         => 'string',
					'description'  => 'The Mailjet API Secret to use.',
					'show_in_rest' => false,
					'default'      => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
				),
			),
		),

		/**
		 * Mailjet Template
		 */

		/** From Email */
		array(
			array(
				'id'       => WPMJI_MAILJET_TEMPLATE_EMAIL_FROM,
				'title'    => __( 'Email from', 'grandeljay-wp-mailjet-integration' ),
				'callback' => 'wpmji_setting_section_html_mailjet_template_email_from',
				'page'     => WPMJI_SETTINGS_MAILJET_TEMPLATE,
				'section'  => WPMJI_SETTINGS_MAILJET_TEMPLATE,
				'args'     => array(
					'label_for' => WPMJI_MAILJET_TEMPLATE_EMAIL_FROM,
				),
			),
			array(
				'option_group' => WPMJI_SETTINGS_MAILJET_TEMPLATE,
				'option_name'  => WPMJI_MAILJET_TEMPLATE_EMAIL_FROM,
				'args'         => array(
					'type'         => 'string',
					'description'  => 'The Mailjet Template From Email to use.',
					'show_in_rest' => false,
					'default'      => 'no-reply@' . isset( $_SERVER['HTTP_HOST'] ) ? sanitize_email( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : 'domain.tld',
				),
			),
		),

		/** From Name */
		array(
			array(
				'id'       => WPMJI_MAILJET_TEMPLATE_EMAIL_NAME,
				'title'    => __( 'Email name', 'grandeljay-wp-mailjet-integration' ),
				'callback' => 'wpmji_setting_section_html_mailjet_template_email_name',
				'page'     => WPMJI_SETTINGS_MAILJET_TEMPLATE,
				'section'  => WPMJI_SETTINGS_MAILJET_TEMPLATE,
				'args'     => array(
					'label_for' => WPMJI_MAILJET_TEMPLATE_EMAIL_NAME,
				),
			),
			array(
				'option_group' => WPMJI_SETTINGS_MAILJET_TEMPLATE,
				'option_name'  => WPMJI_MAILJET_TEMPLATE_EMAIL_NAME,
				'args'         => array(
					'type'         => 'string',
					'description'  => 'The Mailjet Template Email Name to use.',
					'show_in_rest' => false,
					'default'      => get_bloginfo( 'name' ),
				),
			),
		),

		/**
		 * WordPress
		 */

		/** Confirmation Page ID (Success) */
		array(
			array(
				'id'       => WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_SUCCESS,
				'title'    => __( 'Page ID Confirmation (Success)', 'grandeljay-wp-mailjet-integration' ),
				'callback' => 'wpmji_setting_section_html_wordpress_page_id_confirmation_success',
				'page'     => WPMJI_SETTINGS_WORDPRESS,
				'section'  => WPMJI_SETTINGS_WORDPRESS,
				'args'     => array(
					'label_for' => WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_SUCCESS,
				),
			),
			array(
				'option_group' => WPMJI_SETTINGS_WORDPRESS,
				'option_name'  => WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_SUCCESS,
				'args'         => array(
					'type'         => 'integer',
					'description'  => 'The WordPress confirmation page id (success) to use.',
					'show_in_rest' => false,
					'default'      => 0,
				),
			),
		),

		/** Confirmation Page ID (Failure) */
		array(
			array(
				'id'       => WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_FAILURE,
				'title'    => __( 'Page ID Confirmation (Failure)', 'grandeljay-wp-mailjet-integration' ),
				'callback' => 'wpmji_setting_section_html_wordpress_page_id_confirmation_failure',
				'page'     => WPMJI_SETTINGS_WORDPRESS,
				'section'  => WPMJI_SETTINGS_WORDPRESS,
				'args'     => array(
					'label_for' => WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_FAILURE,
				),
			),
			array(
				'option_group' => WPMJI_SETTINGS_WORDPRESS,
				'option_name'  => WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_FAILURE,
				'args'         => array(
					'type'         => 'integer',
					'description'  => 'The WordPress confirmation page id (failure) to use.',
					'show_in_rest' => false,
					'default'      => 0,
				),
			),
		),
	);

	/**
	 * Mailjet Template
	 */

	/** Confirmation ID */
	foreach ( get_active_languages() as $language ) {
		$template_id_confirmation_language = WPMJI_MAILJET_TEMPLATE_ID_CONFIRMATION . '-' . $language['code'];

		$wpmji_fields[] = array(
			array(
				'id'       => $template_id_confirmation_language,
				'title'    => sprintf(
					/* translators: %s: Language */
					__( 'Confirmation Template ID (%s)', 'grandeljay-wp-mailjet-integration' ),
					$language['translated_name']
				),
				'callback' => function() use ( $template_id_confirmation_language ) {
					$template_id_confirmation = get_option( $template_id_confirmation_language );
					?>
					<input type="text" name="<?php echo esc_attr( $template_id_confirmation_language ); ?>" id="<?php echo esc_attr( $template_id_confirmation_language ); ?>" value="<?php echo esc_html( $template_id_confirmation ); ?>" pattern="\d+" />
					<?php
				},
				'page'     => WPMJI_SETTINGS_MAILJET_TEMPLATE,
				'section'  => WPMJI_SETTINGS_MAILJET_TEMPLATE,
				'args'     => array(
					'label_for' => $template_id_confirmation_language,
				),
			),
			array(
				'option_group' => WPMJI_SETTINGS_MAILJET_TEMPLATE,
				'option_name'  => $template_id_confirmation_language,
				'args'         => array(
					'type'         => 'integer',
					'description'  => 'The Mailjet Template ID to use for confirmation emails.',
					'show_in_rest' => false,
					'default'      => 0,
				),
			),
		);
	}

	foreach ( $wpmji_fields as $section_field ) {
		add_settings_field(
			$section_field[0]['id'],
			$section_field[0]['title'],
			$section_field[0]['callback'],
			$section_field[0]['page'],
			$section_field[0]['section'],
			$section_field[0]['args'],
		);

		register_setting(
			$section_field[1]['option_group'],
			$section_field[1]['option_name'],
			$section_field[1]['args'],
		);
	}
}

add_action( 'admin_init', 'wpmji_settings' );

/**
 * Setting Section: Mailjet API
 *
 * @param array $args Display arguments.
 *
 * @return void
 */
function wpmji_setting_section_html_mailjet_api( $args ): void {
}

/**
 * Mailjet API: Version
 *
 * @return void
 */
function wpmji_setting_section_html_mailjet_api_version(): void {
	$versions        = array(
		'v2',
		'v3',
	);
	$current_version = get_option( WPMJI_MAILJET_API_VERSION );
	$field_value     = isset( $versions[ $current_version ] ) ? $versions[ $current_version ] : '';
	?>
	<select name="<?php echo esc_attr( WPMJI_MAILJET_API_VERSION ); ?>"
			id="<?php echo esc_attr( WPMJI_MAILJET_API_VERSION ); ?>"
	>
		<?php foreach ( $versions as $version ) { ?>
			<option value="<?php echo esc_attr( $version ); ?>"
					<?php selected( $version, $current_version ); ?>
			>
				<?php echo esc_html( $version ); ?>
			</option>
		<?php } ?>
	</select>
	<?php
}

/**
 * Mailjet API: Version (Send)
 *
 * @return void
 */
function wpmji_setting_section_html_mailjet_api_version_send(): void {
	$versions        = array(
		'v3',
		'v3.1',
	);
	$current_version = get_option( WPMJI_MAILJET_API_VERSION_SEND );
	$field_value     = isset( $versions[ $current_version ] ) ? $versions[ $current_version ] : '';
	?>
	<select name="<?php echo esc_attr( WPMJI_MAILJET_API_VERSION_SEND ); ?>" id="<?php echo esc_attr( WPMJI_MAILJET_API_VERSION_SEND ); ?>">
		<?php foreach ( $versions as $version ) { ?>
			<option value="<?php echo esc_attr( $version ); ?>"
					<?php selected( $version, $current_version ); ?>
			>
				<?php echo esc_html( $version ); ?>
			</option>
		<?php } ?>
	</select>
	<?php
}

/**
 * Mailjet API: Key
 *
 * @return void
 */
function wpmji_setting_section_html_mailjet_api_key(): void {
	$current_key = get_option( WPMJI_MAILJET_API_KEY );
	?>
	<input type="text" name="<?php echo esc_attr( WPMJI_MAILJET_API_KEY ); ?>" id="<?php echo esc_attr( WPMJI_MAILJET_API_KEY ); ?>" value="<?php echo esc_html( $current_key ); ?>" />
	<?php
}

/**
 * Mailjet API: Secret
 *
 * @return void
 */
function wpmji_setting_section_html_mailjet_api_secret(): void {
	$current_secret = get_option( WPMJI_MAILJET_API_SECRET );
	?>
	<input type="text" name="<?php echo esc_attr( WPMJI_MAILJET_API_SECRET ); ?>" id="<?php echo esc_attr( WPMJI_MAILJET_API_SECRET ); ?>" value="<?php echo esc_html( $current_secret ); ?>" />
	<?php
}

/**
 * Setting Section: Mailjet Confirmation Template ID
 *
 * @param array $args Display arguments.
 *
 * @return void
 */
function wpmji_setting_section_html_mailjet_template( $args ): void {
}

/**
 * Mailjet Template: Email From
 *
 * @return void
 */
function wpmji_setting_section_html_mailjet_template_email_from(): void {
	$email_from = get_option( WPMJI_MAILJET_TEMPLATE_EMAIL_FROM );
	?>
	<input type="email" name="<?php echo esc_attr( WPMJI_MAILJET_TEMPLATE_EMAIL_FROM ); ?>" id="<?php echo esc_attr( WPMJI_MAILJET_TEMPLATE_EMAIL_FROM ); ?>" value="<?php echo esc_html( $email_from ); ?>" />
	<?php
}

/**
 * Mailjet Template: Email Name
 *
 * @return void
 */
function wpmji_setting_section_html_mailjet_template_email_name(): void {
	$email_name = get_option( WPMJI_MAILJET_TEMPLATE_EMAIL_NAME );
	?>
	<input type="text" name="<?php echo esc_attr( WPMJI_MAILJET_TEMPLATE_EMAIL_NAME ); ?>" id="<?php echo esc_attr( WPMJI_MAILJET_TEMPLATE_EMAIL_NAME ); ?>" value="<?php echo esc_html( $email_name ); ?>" />
	<?php
}

/**
 * Setting Section: WordPress
 *
 * @param array $args Display arguments.
 *
 * @return void
 */
function wpmji_setting_section_html_wordpress( $args ): void {
}

/**
 * WordPress: Confirmation Page ID (Success)
 *
 * @return void
 */
function wpmji_setting_section_html_wordpress_page_id_confirmation_success(): void {
	$page_id_success = get_option( WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_SUCCESS );
	?>
	<input type="text" name="<?php echo esc_attr( WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_SUCCESS ); ?>" id="<?php echo esc_attr( WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_SUCCESS ); ?>" value="<?php echo esc_html( $page_id_success ); ?>" pattern="\d+" />
	<?php
}

/**
 * WordPress: Confirmation Page ID (Failure)
 *
 * @return void
 */
function wpmji_setting_section_html_wordpress_page_id_confirmation_failure(): void {
	$page_id_failure = get_option( WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_FAILURE );
	?>
	<input type="text" name="<?php echo esc_attr( WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_FAILURE ); ?>" id="<?php echo esc_attr( WPMJI_WORDPRESS_PAGE_ID_CONFIRMATION_FAILURE ); ?>" value="<?php echo esc_html( $page_id_failure ); ?>" pattern="\d+" />
	<?php
}

/**
 * Setting Section: WPML
 *
 * @param array $args Display arguments.
 *
 * @return void
 */
function wpmji_setting_section_html_wpml( $args ): void {
}
