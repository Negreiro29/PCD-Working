<?php

	require_once('db.class.php');

	$nomeUsuario = $_POST['nomeUsuario'];
	$cpf = $_POST['cpf'];
	$sexo = $_POST['sexo'];
	$deficiencia = $_POST['deficiencia'];
	$emailUsuario = $_POST['emailUsuario'];
	$senhaUsuario = $_POST['senhaUsuario'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$email_existe = false;
	$cpf_existe = false;

	//verificar se email ja existe
	$sql = "SELECT * FROM usuarios WHERE email_usuario = '$emailUsuario'";
	if ($resultado_id = mysqli_query($link, $sql)){
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if(isset($dados_usuario['email_usuario'])){
			$email_existe = true;
		}
	} else {
		echo 'Erro ao tentar localizar o registro de email';
	}

	//verificar se o cpf ja existe
	$sql = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
	if ($resultado_id = mysqli_query($link, $sql)){
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if(isset($dados_usuario['cpf'])){
			$cpf_existe = true;
		}
	} else {
		echo 'Erro ao tentar localizar o registro de CPF';
	}

	if ($email_existe || $cpf_existe
	) {
		$retorno_get = '';
		if ($email_existe){
			$retorno_get.= "erro_email=1&";
		}
		if ($cpf_existe) {
			$retorno_get.= "erro_cpf=1&";
		}

		header('Location: cadastro.php?'.$retorno_get);
		die();
	}

	$sql = "insert into usuarios(nome_usuario, cpf, sexo, deficiencia, email_usuario, senha_usuario) values('$nomeUsuario', '$cpf', '$sexo', '$deficiencia', '$emailUsuario', '$senhaUsuario')";

	//executar a query
	if (mysqli_query($link, $sql)){
		?>
			<script>
				confirm('Usuário resgistrado com sucesso!');
				window.location = 'login.php';
			</script>
		<?php
		#echo 'Usuário registrado com sucesso!';
	} else{
		echo 'Erro ao registrar o usuário.';
	}

?>