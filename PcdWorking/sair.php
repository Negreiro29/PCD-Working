<?php

	session_start();

	unset($_SESSION['email']);
	unset($_SESSION['senha']);

	?>
		<script>
			confirm('Logoff efetuado com sucesso, esperamos te ver novamente!');
			window.location = 'index.php';
		</script>
	<?php

?>