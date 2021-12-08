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
function wpmji_get_template_id(): int {
	$template_id;

	foreach ( get_active_languages() as $language ) {
		if ( ICL_LANGUAGE_CODE === $language['code'] ) {
			$template_id = get_option( WPMJI_MAILJET_TEMPLATE_ID_CONFIRMATION . '-' . $language['code'] );
			break;
		}
	}

	return $template_id;
}
