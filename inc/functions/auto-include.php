<?php

/**
 * auto-include.php
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

function auto_include( string $directoy_to_include ) {
	foreach ( scandir( $directory_to_include ) as $filename ) {
		$filepath = $directory_to_include . '/' . $filename;

		if ( is_file( $filepath ) && __FILE__ !== $filepath ) {
			require $filepath;
		}
	}
}
