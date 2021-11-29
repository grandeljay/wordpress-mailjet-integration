<?php
/**
 * Admin Menu
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

define( 'GJMJ4WP_MENU_SLUG', 'gjmj4wp-options' );

/**
 * Options Page
 *
 * @link https://developer.wordpress.org/plugins/administration-menus/top-level-menus/
 */
function gjmj4wp_options_page() {
	$page_title = 'Mailjet for WordPress';
	$menu_title = 'Mailjet for WordPress';
	$capability = 'manage_options';
	$menu_slug  = GJMJ4WP_MENU_SLUG;
	$function   = 'gjmj4wp_options_page_html';
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

add_action( 'admin_menu', 'gjmj4wp_options_page' );

/**
 * Options Page HTML
 */
function gjmj4wp_options_page_html() {
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<form action="options.php" method="post">
			<?php
			settings_fields( GJMJ4WP_MENU_SLUG );

			do_settings_sections( GJMJ4WP_MENU_SLUG );

			submit_button( __( 'Save Settings', 'textdomain' ) );
			?>
		</form>
	</div>
	<?php
}
