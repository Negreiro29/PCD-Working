<?php

	session_start();

	if (!isset($_SESSION['email'])) {
    	header('Location: index.php?error=1');
  	}

	require_once('db.class.php');

	$id_usuario = $_SESSION['id_usuario'];
	$vinculado_id_vaga = $_POST['vinculado_id_vaga'];

	if ($id_usuario == '' || $vinculado_id_vaga == '') {
		die();
	}

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = "INSERT INTO usuarios_vagas(id_usuario, vinculado_id_vaga) values($id_usuario, $vinculado_id_vaga)";

	//executar a query
	mysqli_query($link, $sql)
	/*if (mysqli_query($link, $sql)){
		?>
			<script>
				confirm('Candidatura feita com sucesso! Boa sorte!');
				window.location = 'perfil.php';
			</script>
		<?php
	} else{
		echo 'Erro ao vincular usuário a vaga.';
	}*/

?>