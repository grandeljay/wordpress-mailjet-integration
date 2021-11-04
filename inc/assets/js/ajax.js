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

				email: $( '[name="email"]' ).val(),
			},
			function( response ) {
				if ( response.data.message ) {
					$( '.gjmj4wp-response' ).html(
						response.data.message
					);
				} else if ( response.data.ErrorMessage ) {
					$( '.gjmj4wp-response' ).html(
						response.data.ErrorInfo + '<br />' +
						response.data.ErrorMessage + '<br />' +
						response.data.StatusCode
					);
				}
			}
		);
	} );

} );
