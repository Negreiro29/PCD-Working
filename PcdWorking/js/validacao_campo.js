$(document).ready(function(){
	$('#btn-login').click(function(){
		if ($('#email_usuario').val() == '' || $('#email_empresa').val() == '') {
			alert('Email vazio');
		}

		if ($('#senha_usuario').val() == '' || $('#senha_empresa').val() == '') {
			alert('Senha vazia');
		}
	});
});