<?php
/**
 * WPML enabled
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * WPML enabled
 *
 * @return bool
 */
function is_wpml_active(): bool {
	return is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' );
}
