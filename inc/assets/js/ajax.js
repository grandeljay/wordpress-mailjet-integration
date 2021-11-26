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
			var messages = [];

			if ( response.data.message ) {
				messages.push(response.data.message);
			}

			if ( response.data.ErrorInfo ) {
				messages.push(response.data.ErrorInfo);
			}
			if ( response.data.ErrorMessage ) {
				messages.push(response.data.ErrorMessage);
			}
			if ( response.data.StatusCode ) {
				messages.push(response.data.StatusCode);
			}

			form_response.html(messages.join('<br />'));
		} )
		.fail( function( data ) {
			form_response.html(
				'<strong>' + data.status + '</strong><br />' +
				'<p>' + data.statusText + '</p>'
			);
		} );
	} );

} );
