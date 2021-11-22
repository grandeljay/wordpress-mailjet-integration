/**
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

jQuery( document ).ready( function( $ ) {
	$( '.gjmj4wp-subscribe' ).submit( function( event ) {
		event.preventDefault();

		var form_submit = $( this );
		form_submit.hide();

		var form_response = $( '.gjmj4wp-response' );
		form_response.text(gjmj4wp.text_loading);

		$
		.post(
			gjmj4wp.ajax_url,
			{
				_ajax_nonce: gjmj4wp.nonce,
				action: 'gjmj4wp_ajax_subscribe',

				email: $( '[name="email"]' ).val(),
				language: gjmj4wp.language,
			}
		)
		.done( function( response ) {
			if ( response.data.message ) {
				form_response.html(
					response.data.message
				);
			} else if ( response.data.ErrorMessage ) {
				form_response.html(
					response.data.ErrorInfo + '<br />' +
					response.data.ErrorMessage + '<br />' +
					response.data.StatusCode
				);
			}
		} )
		.fail( function( data ) {
			form_response.html(
				'<strong>' + data.status + '</strong><br />' +
				'<p>' + data.statusText + '</p>'
			);
		} );
	} );

} );
