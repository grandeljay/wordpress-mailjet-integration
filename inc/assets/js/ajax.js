/**
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

jQuery( document ).ready( function( $ ) {
	$( '.wpmji-subscribe' ).submit( function( event ) {
		event.preventDefault();

		var form_submit = $( this );
		form_submit.hide();

		var form_response = $( '.wpmji-response' );
		form_response.text(wpmji.text_loading);

		$
		.post(
			wpmji.ajax_url,
			{
				_ajax_nonce: wpmji.nonce,
				action: 'wpmji_ajax_subscribe',

				email: $( '[name="email"]' ).val(),
				language: wpmji.language,
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
