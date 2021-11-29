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
function gjmj4wp_settings() {
	/**
	 * Sections
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_settings_section/
	 */
	$gjmj4wp_sections_mailjet_api = 'gjmj4wp-mailjet-api';

	$gjmj4wp_sections = array(
		/** Mailjet API */
		array(
			'id'       => $gjmj4wp_sections_mailjet_api,
			'title'    => __( 'Mailjet API', 'grandeljay-mailjet-for-wordpress' ),
			'callback' => 'gjmj4wp_setting_section_mailjet_api_html',
			'page'     => GJMJ4WP_MENU_SLUG,
		),
	);

	foreach ( $gjmj4wp_sections as $section ) {
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
	$gjmj4wp_sections_mailjet_api_version = 'gjmj4wp-mailjet-api-version';

	$gjmj4wp_fields = array(
		/** Mailjet API */
		array(
			/**
			 * Add Field
			 *
			 * @link https://developer.wordpress.org/reference/functions/add_settings_field/
			 */
			array(
				'id'       => $gjmj4wp_sections_mailjet_api_version,
				'title'    => __( 'Version', 'grandeljay-mailjet-for-wordpress' ),
				'callback' => 'gjmj4wp_setting_section_mailjet_api_version_html',
				'page'     => GJMJ4WP_MENU_SLUG,
				'section'  => $gjmj4wp_sections_mailjet_api,
				'args'     => array(),
			),

			/**
			 * Register Setting
			 *
			 * @link https://developer.wordpress.org/reference/functions/register_setting/
			 */
			array(
				'option_group' => GJMJ4WP_SETTINGS_DEFAULT,
				'option_name'  => $gjmj4wp_sections_mailjet_api_version,
				'args'         => array(
					'type'         => 'array',
					'description'  => 'A List of available versions for the API.',
					'show_in_rest' => false,
					'default'      => 'v3',
				),
			),
		),
	);

	foreach ( $gjmj4wp_fields as $section_field ) {
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

add_action( 'admin_init', 'gjmj4wp_settings' );

/**
 * Setting Section: Mailjet API
 *
 * @param array $args Display arguments.
 *
 * @return void
 */
function gjmj4wp_setting_section_mailjet_api_html( $args ): void {
}

/**
 * Mailjet API: Version
 *
 * @link https://developer.wordpress.org/reference/functions/register_setting/
 */
function gjmj4wp_setting_section_mailjet_api_version_html() {
	$versions        = array(
		'v2',
		'v3',
	);
	$current_version = get_option( 'gjmj4wp-mailjet-api-version' );
	$field_value     = isset( $versions[ $current_version ] ) ? $versions[ $current_version ] : '';
	?>
	<select name="gjmj4wp-mailjet-api-version">
		<?php foreach ( $versions as $version ) { ?>
			<option value="<?php echo $version; ?>"
					<?php selected( $version, $current_version ); ?>
			>
				<?php echo $version; ?>
			</option>
		<?php } ?>
	</select>
	<?php
}
