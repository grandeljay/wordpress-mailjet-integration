/**
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

jQuery( document ).ready( function( $ ) {

	$( '.gjmj4wp-subscribe' ).submit( function( event ) {
		event.preventDefault();

		$.post(
			gjmj4wp.ajax_url,
			{
				_ajax_nonce: gjmj4wp.nonce,
				action: 'gjmj4wp_ajax_subscribe',

				// Data
				fields: $( this ).serialize(),
			},
			function( response ) {
				console.log( response );
			}
		);
	} );

} );
