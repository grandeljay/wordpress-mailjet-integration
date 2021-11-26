<?php
/**
 * Get Mailjet Template for Language
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Get Template ID
 *
 * @return int
 */
function gjmj4wp_get_template_id(): int {
	$template_id;

	if ( isset( GJMJ4WP_TEMPLATE_CONFIRMATION[ GJMJ4WP_LANGUAGE_CURRENT ] ) ) {
		$template_id = GJMJ4WP_TEMPLATE_CONFIRMATION[ GJMJ4WP_LANGUAGE_CURRENT ];
	} else {
		$template_id = GJMJ4WP_TEMPLATE_CONFIRMATION[ GJMJ4WP_LANGUAGE_DEFAULT ];
	}

	return $template_id;
}
