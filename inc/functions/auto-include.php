<?php
/**
 * Auto Include
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

/**
 * Auto Include
 *
 * @param  string $directory_to_include The directory to include.
 *
 * @return void
 */
function wpmji_auto_include( string $directory_to_include ): void {
	foreach ( scandir( $directory_to_include ) as $filename ) {
		$filepath      = str_replace( '\\', '/', $directory_to_include . '/' . $filename );
		$filepath_this = str_replace( '\\', '/', __FILE__ );

		if ( is_file( $filepath ) && $filepath_this !== $filepath ) {
			require $filepath;
		}
	}
}
