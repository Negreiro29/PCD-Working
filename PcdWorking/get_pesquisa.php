<?php
	
	session_start();

	if (!isset($_SESSION['email'])) {
    	header('Location: index.php?error=1');
  	}

  	require_once('db.class.php');

  	$busca = $_POST['procurar_vagas'];
  	$id_empresa = $_SESSION['id_empresa'];

  	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = "SELECT v.id_empresa, v.cargo, v.salario, v.local_vaga, v.uf, date_format(v.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, e.nome_fantasia FROM vagas AS v JOIN empresas AS e ON (v.id_empresa = e.id_empresa) WHERE v.cargo LIKE '%$busca' ORDER BY data_inclusao DESC";

	//executar a query
	$resultado_id = mysqli_query($link, $sql);

	if ($resultado_id) {
		
		while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
			echo '<a href="#" class="list-group-item" style="text-decoration-color: black;"';
				echo '<h4 class="list-group-item-heading">'.$registro['nome_fantasia'].' <small> - '.$registro['data_inclusao_formatada'].' </small></h4>';
				echo '<h4 class="list-group-item-cargo">Cargo: '.$registro['cargo'].' </h4>';
				echo '<h5 class="list-group-item-salario">Salario: R$: '.$registro['salario'].' </h5>';
				echo '<h5 class="list-group-item-local list-group-item-uf">'.$registro['local_vaga'].' - '.$registro['uf'].'</h3>';
			echo "</a>";
		}

	} else{
		echo 'Erro na consulta de vagas!';
	}

?>