<?php

	session_start( );

	require_once('db.class.php');

	$email = $_POST['email'];
	$senha = $_POST['senha'];

	$sql = "SELECT * FROM empresas WHERE email_empresa = '$email' AND senha_empresa = '$senha'";

	$objBD = new db();
	$link = $objBD->conecta_mysql();

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		$dados_empresa = mysqli_fetch_array($resultado_id);

		if(isset($dados_empresa['email_empresa'])){
			$_SESSION['id_empresa'] = $dados_empresa['id_empresa'];
			$_SESSION['email'] = $dados_empresa['email_empresa'];
			$_SESSION['nome'] = $dados_empresa['nome_fantasia'];
			$_SESSION['cnpj'] = $dados_empresa['cnpj'];
			$_SESSION['razaosocial'] = $dados_empresa['razao_social'];
			$_SESSION['senha'] = $dados_empresa['senha_empresa'];
			header('Location: home_emp.php');
		} else {
			header('Location: login_emp.php?erro=1');
		}
	} else {
		echo 'Erro na execução da consulta!';
	}
	
?>