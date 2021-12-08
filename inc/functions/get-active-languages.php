<?php
/**
 * Get Active Languages
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Get Active Languages
 *
 * @return array
 */
function get_active_languages(): array {
	$language_codes = array();

	if ( is_wpml_active() ) {
		$active_languages = apply_filters(
			'wpml_active_languages',
			null,
			array(
				'skip_missing' => 0,
			),
		);

		$language_codes = $active_languages;
	} else {
		$language_codes['en'] = array(
			'code'            => 'en',
			'id'              => '1',
			'native_name'     => 'English',
			'major'           => '1',
			'active'          => '1',
			'default_locale'  => 'en_US',
			'encode_url'      => '0',
			'tag'             => 'en',
			'translated_name' => 'English',
			'language_code'   => 'en',
		);
	}

	sort( $language_codes );

	return $language_codes;
}
