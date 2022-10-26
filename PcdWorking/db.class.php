<?php

	class db {
		//host
		private $host = 'localhost';

		//usuario
		private $usuario = 'root';

		//senha
		private $senha = '';

		//banco de dados
		private $database = 'db_pcd_working';

		public function conecta_mysql(){
			//criando conexão
			$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

			//ajustar o cahrset de comunicaão entre a aplicação e o bd
			mysqli_set_charset($con, 'utf8');

			//verificar se houve erro de conexão
			if(mysqli_connect_errno()){
				echo 'Erro ao tentar se conectar ao BD MySQL: '.mysqli_connect_error();
			}

			return $con;
		}
	}

?>