<?php

/**
 * auto-include.php
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

function gjmj4wp_auto_include( string $directory_to_include ) {
	foreach ( scandir( $directory_to_include ) as $filename ) {
		$filepath      = str_replace( '\\', '/', $directory_to_include . '/' . $filename );
		$filepath_this = str_replace( '\\', '/', __FILE__ );

		if ( is_file( $filepath ) && $filepath_this !== $filepath ) {
			require $filepath;
		}
	}
}
