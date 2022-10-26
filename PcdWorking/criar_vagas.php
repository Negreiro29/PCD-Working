<?php

	session_start();

	if (!isset($_SESSION['email'])) {
    	header('Location: index.php?error=1');
  	}

	require_once('db.class.php');

	$id_empresa = $_SESSION['id_empresa'];
	$cargo = $_POST['cargo'];
	$salario = $_POST['salario'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['uf'];

	if ($cargo == '' || $salario == '' || $cidade == '') {
		die();
	}

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = "INSERT INTO vagas(id_empresa, cargo, salario, local_vaga, uf) values('$id_empresa', '$cargo', '$salario', '$cidade', '$estado')";

	//executar a query
	if (mysqli_query($link, $sql)){
		?>
			<script>
				confirm('Vaga criada com sucesso!');
				window.location = 'perfil_emp.php';
			</script>
		<?php
	} else{
		echo 'Erro ao cadastrar o vaga.';
	}

?>