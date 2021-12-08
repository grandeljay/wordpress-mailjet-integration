/**
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

jQuery( document ).ready( function( $ ) {
	$( '.gjmji-subscribe' ).submit( function( event ) {
		event.preventDefault();

		var form_submit = $( this );
		form_submit.hide();

		var form_response = $( '.gjmji-response' );
		form_response.text(gjmji.text_loading);

		$
		.post(
			gjmji.ajax_url,
			{
				_ajax_nonce: gjmji.nonce,
				action: 'gjmji_ajax_subscribe',

				email: $( '[name="email"]' ).val(),
				language: gjmji.language,
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
