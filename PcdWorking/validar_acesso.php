<?php

	session_start( );

	require_once('db.class.php');

	$email = $_POST['email'];
	$senha = $_POST['senha'];

	$sql = "SELECT * FROM usuarios WHERE email_usuario = '$email' AND senha_usuario = '$senha'";

	$objBD = new db();
	$link = $objBD->conecta_mysql();

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['email_usuario'])){
			$_SESSION['id_usuario'] = $dados_usuario['id_usuario'];
			$_SESSION['email'] = $dados_usuario['email_usuario'];
			$_SESSION['nome'] = $dados_usuario['nome_usuario'];
			$_SESSION['senha'] = $dados_usuario['senha_usuario'];
			$_SESSION['cpf'] = $dados_usuario['cpf'];
			$_SESSION['deficiencia'] = $dados_usuario['deficiencia'];
			$_SESSION['sexo'] = $dados_usuario['sexo'];
			header('Location: home.php');
		} else {
			header('Location: login.php?erro=1');
		}
	} else {
		echo 'Erro na execução da consulta!';
	}
	
?>