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
define( 'WPMJI_SETTINGS_MAILJET_API', 'wpmji-mailjet-api' );
define( 'WPMJI_SETTINGS_MAILJET_TEMPLATE', 'wpmji-mailjet-template' );

/** WordPress */
define( 'WPMJI_SETTINGS_WORDPRESS', 'wpmji-wordpress' );

/** WPML */
define( 'WPMJI_SETTINGS_WPML', 'wpmji-wpml' );

/**
 * Options Page
 *
 * @link https://developer.wordpress.org/plugins/administration-menus/top-level-menus/
 */
function wpmji_options() {
	/**
	 * Menu
	 */
	$page_title = 'WP Mailjet Integration';
	$menu_title = 'WP Mailjet Integration';
	$capability = 'manage_options';
	$menu_slug  = 'wpmji-options';
	$function   = 'wpmji_options_html_mailjet_api';
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

add_action( 'admin_menu', 'wpmji_options' );

/**
 * Options Page HTML
 */
function wpmji_options_html_mailjet_api() {
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
			submit_button( __( 'Save Mailjet API Settings', 'grandeljay-wp-mailjet-integration' ) );
			?>
		</form>

		<form action="options.php" method="post">
			<?php
			settings_fields( WPMJI_SETTINGS_MAILJET_TEMPLATE );
			do_settings_sections( WPMJI_SETTINGS_MAILJET_TEMPLATE );
			submit_button( __( 'Save Mailjet Template Settings', 'grandeljay-wp-mailjet-integration' ) );
			?>
		</form>

		<form action="options.php" method="post">
			<?php
			settings_fields( WPMJI_SETTINGS_WORDPRESS );
			do_settings_sections( WPMJI_SETTINGS_WORDPRESS );
			submit_button( __( 'Save WordPress Settings', 'grandeljay-wp-mailjet-integration' ) );
			?>
		</form>

		<?php if ( is_wpml_active() ) { ?>
			<form action="options.php" method="post">
				<?php
				settings_fields( WPMJI_SETTINGS_WPML );
				do_settings_sections( WPMJI_SETTINGS_WPML );
				submit_button( __( 'Save WPML Settings', 'grandeljay-wp-mailjet-integration' ) );
				?>
			</form>
		<?php } ?>
	</div>
	<?php
}
