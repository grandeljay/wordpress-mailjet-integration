<?php

/**
 * subscribe.php
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

function gjmj4wp_ajax_subscribe() {
	check_ajax_referer( 'gjmj4wp' );

	echo wp_json_encode( $_POST );

	wp_die();
}

add_action( 'wp_ajax_gjmj4wp_ajax_subscribe', 'gjmj4wp_ajax_subscribe' );
