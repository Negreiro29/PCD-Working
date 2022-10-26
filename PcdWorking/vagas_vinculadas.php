<?php
	
	session_start();

	if (!isset($_SESSION['email'])) {
    	header('Location: index.php?error=1');
  	}

  	require_once('db.class.php');

  	$id_empresa = $_SESSION['id_empresa'];
  	$id_usuario = $_SESSION['id_usuario'];

  	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$sql = "SELECT s.*, u.*, v.id_vaga, v.id_empresa, v.cargo, v.salario, v.local_vaga, v.uf, date_format(v.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, e.nome_fantasia FROM usuarios AS u LEFT JOIN usuarios_vagas AS s ON (s.id_usuario = u.id_usuario) LEFT JOIN vagas AS v ON (s.vinculado_id_vaga = v.id_vaga) JOIN empresas AS e ON (v.id_empresa = e.id_empresa) WHERE u.id_usuario = '$id_usuario' ORDER BY data_inclusao DESC";

	//executar a query
	$resultado_id = mysqli_query($link, $sql);

	if ($resultado_id) {
		
		while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
			echo '<a href="#" class="list-group-item"';
				echo '<h4 class="list-group-item-nome">'.$registro['nome_fantasia'].' <small> - '.$registro['data_inclusao_formatada'].' </small></h4>';
				echo '<h4 class="list-group-item-cargo">Cargo: '.$registro['cargo'].' </h4>';
				echo '<h5 class="list-group-item-salario">Salario: R$: '.$registro['salario'].' </h5>';
				echo '<h5 class="list-group-item-local list-group-item-uf">'.$registro['local_vaga'].' - '.$registro['uf'].'</h3>';
				echo '<p class="list-group-item-text pull-right">';

					$esta_vinculado_vaga_sn = isset($registro['id_usuario_vaga']) && !empty($registro['id_usuario_vaga']) ? 'S' : 'N';
					$btn_vincular_display = 'block';
					$btn_desvincular_display = 'block';

					if ($esta_vinculado_vaga_sn == 'N') {
						$btn_desvincular_display = 'none';
					} else {
						$btn_vincular_display = 'none';
					}

					echo '<button type="button" id="btn_vincular_'.$registro['id_vaga'].'" style="display: '.$btn_vincular_display.'" class="btn btn-primary btn_vincular" data-id_vaga="'.$registro['id_vaga'].'">Cadidatar-se</button>';
					echo '<button type="button" id="btn_desvincular_'.$registro['id_vaga'].'" style="display: '.$btn_desvincular_display.'" class="btn btn-danger btn_desvincular" data-id_vaga="'.$registro['id_vaga'].'">Cancelar candidatura</button>';
				echo '</p>';
				echo '<div class="clearfix"></div>';
			echo "</a>";
		}

	} else{
		echo 'Erro na consulta de vagas!';
	}

?>