<?php
/**
 * Admin Menu
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Slugs
 *
 * @see admin-init.php
 */
define( 'GJMJ4WP_SETTINGS_MAILJET_API', 'gjmj4wp-mailjet-api' );

/**
 * Options Page
 *
 * @link https://developer.wordpress.org/plugins/administration-menus/top-level-menus/
 */
function gjmj4wp_options() {
	/**
	 * Menu
	 */
	$page_title = 'Mailjet for WordPress';
	$menu_title = 'Mailjet for WordPress';
	$capability = 'manage_options';
	$menu_slug  = 'gjmj4wp-options';
	$function   = 'gjmj4wp_options_html_mailjet_api';
	$icon_url   = 'dashicons-email';
	$position   = null;

	add_menu_page(
		$page_title,
		$menu_title,
		$capability,
		$menu_slug,
		$function,
		$icon_url,
		$position
	);
}

add_action( 'admin_menu', 'gjmj4wp_options' );

/**
 * Options Page HTML
 */
function gjmj4wp_options_html_mailjet_api() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<form action="options.php" method="post">
			<?php
			/**
			 * Output nonce, action, and option_page fields for a settings page.
			 *
			 * @link https://developer.wordpress.org/reference/functions/settings_fields/
			 */
			settings_fields( GJMJ4WP_SETTINGS_MAILJET_API );

			/**
			 * Prints out all settings sections added to a particular settings page.
			 *
			 * @link https://developer.wordpress.org/reference/functions/do_settings_sections/
			 */
			do_settings_sections( GJMJ4WP_SETTINGS_MAILJET_API );

			/**
			 * Echoes a submit button, with provided text and appropriate class(es).
			 *
			 * @link https://developer.wordpress.org/reference/functions/submit_button/
			 */
			submit_button( __( 'Save Mailjet API Settings', 'grandeljay-mailjet-for-wordpress' ) );
			?>
		</form>
	</div>
	<?php
}
