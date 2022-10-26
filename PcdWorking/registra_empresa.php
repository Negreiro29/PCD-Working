<?php

	require_once('db.class.php');

	$razaoSocial = $_POST['razaoSocial'];
	$nomeFantasia = $_POST['nomeFantasia'];
	$cnpj = $_POST['cnpj'];
	$emailEmpresa = $_POST['emailEmpresa'];
	$senhaEmpresa = $_POST['senhaEmpresa'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$emailp_existe = false;
	$cnpj_existe = false;

	//verificar se email ja existe
	$sql = "SELECT * FROM empresas WHERE email_empresa = '$emailEmpresa'";
	if ($resultado_id = mysqli_query($link, $sql)){
		$dados_empresa = mysqli_fetch_array($resultado_id);
		if(isset($dados_empresa['email_empresa'])){
			$emailp_existe = true;
		}
	} else {
		echo 'Erro ao tentar localizar o registro de email';
	}

	//verificar se o cnpj ja existe
	$sql = "SELECT * FROM empresas WHERE cnpj = '$cnpj'";
	if ($resultado_id = mysqli_query($link, $sql)){
		$dados_empresa = mysqli_fetch_array($resultado_id);
		if(isset($dados_empresa['cnpj'])){
			$cnpj_existe = true;
		}
	} else {
		echo 'Erro ao tentar localizar o registro de CNPJ';
	}

	if ($emailp_existe || $cnpj_existe) {
		$retorno_get = '';
		if ($cnpj_existe == true) {
			$retorno_get.= "erro_cnpj=1&";
		}
		if ($emailp_existe == true) {
			$retorno_get.= "erro_emailp=1&";
		}

		header('Location: cadastro2.php?'.$retorno_get);
		die();
	}


	$sql = "insert into empresas(razao_social, nome_fantasia,cnpj, email_empresa, senha_empresa) values('$razaoSocial', '$nomeFantasia', '$cnpj', '$emailEmpresa', '$senhaEmpresa')";

	//executar a query
	if (mysqli_query($link, $sql)){
		?>
			<script>
				confirm('Empresa resgistrado com sucesso!');
				window.location = 'login_emp.php';
			</script>
		<?php
		#echo 'Usuário registrado com sucesso!';
	} else{
		echo 'Erro ao registrar o empresa.';
	}

?>