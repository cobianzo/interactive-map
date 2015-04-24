jQuery(document).ready(function( $ ) {

	$('#backtoblog a').prop('title','Vuelve al inicio');
	$('#login').prepend('<h2><a href="'+$('#login h1:first a:first').attr("href")+'" class="button button-primary button-large">Vuelve al inicio</a></h2><br class="clear">');
	$('form#loginform').prepend('<h2>Introduce tus credenciales.</h2><br class="clear">');
	$('form#lostpasswordform').prepend('<h2>Introduce la información requerida. Recibirás un email para reestablecer tu password.</h2><br class="clear">');
	$('form#resetpassform').prepend('<h2>Introduce tu nuevo password.</h2><br class="clear">');

	$('form#registerform').prepend('<h2>Crea tu cuenta. <br\>Comprueba tu email.</h2><br class="clear">');
	$('form').prepend('<p class="ver"><a href="http://www.editorialveras.com/editorialveras/">Visita EditorialVeras.com</a></p>');

	//TODO: make the alert boxes look prettier. :)

	$("p.reset-pass:contains('Enter your new password below')").hide();

	$("p.reset-pass:contains('Your password has been reset')").show().addClass('backtologin').removeClass('message').removeClass('reset-pass');
});