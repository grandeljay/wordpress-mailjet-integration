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

/** Mailjet */
define( 'WPMJI_SETTINGS_MAILJET_API', 'gjmji-mailjet-api' );
define( 'WPMJI_SETTINGS_MAILJET_TEMPLATE', 'gjmji-mailjet-template' );

/** WordPress */
define( 'WPMJI_SETTINGS_WORDPRESS', 'gjmji-wordpress' );

/** WPML */
define( 'WPMJI_SETTINGS_WPML', 'gjmji-wpml' );

/**
 * Options Page
 *
 * @link https://developer.wordpress.org/plugins/administration-menus/top-level-menus/
 */
function gjmji_options() {
	/**
	 * Menu
	 */
	$page_title = 'Mailjet Integration';
	$menu_title = 'Mailjet Integration';
	$capability = 'manage_options';
	$menu_slug  = 'gjmji-options';
	$function   = 'gjmji_options_html_mailjet_api';
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

add_action( 'admin_menu', 'gjmji_options' );

/**
 * Options Page HTML
 */
function gjmji_options_html_mailjet_api() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<form action="options.php" method="post">
			<?php
			settings_fields( WPMJI_SETTINGS_MAILJET_API );
			do_settings_sections( WPMJI_SETTINGS_MAILJET_API );
			submit_button( __( 'Save Mailjet API Settings', 'grandeljay-mailjet-integration' ) );
			?>
		</form>

		<form action="options.php" method="post">
			<?php
			settings_fields( WPMJI_SETTINGS_MAILJET_TEMPLATE );
			do_settings_sections( WPMJI_SETTINGS_MAILJET_TEMPLATE );
			submit_button( __( 'Save Mailjet Template Settings', 'grandeljay-mailjet-integration' ) );
			?>
		</form>

		<form action="options.php" method="post">
			<?php
			settings_fields( WPMJI_SETTINGS_WORDPRESS );
			do_settings_sections( WPMJI_SETTINGS_WORDPRESS );
			submit_button( __( 'Save WordPress Settings', 'grandeljay-mailjet-integration' ) );
			?>
		</form>

		<?php if ( is_wpml_active() ) { ?>
			<form action="options.php" method="post">
				<?php
				settings_fields( WPMJI_SETTINGS_WPML );
				do_settings_sections( WPMJI_SETTINGS_WPML );
				submit_button( __( 'Save WPML Settings', 'grandeljay-mailjet-integration' ) );
				?>
			</form>
		<?php } ?>
	</div>
	<?php
}
