<!DOCTYPE html>
<html>
	<head>
		<?php
		include ('cabecalho.php');
		?>
	</head>
	<body>
		<!-- Home -->
		<div data-role="page" id="page1">
			<div data-theme="b" data-role="header">
				<a data-role="button" href="login.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Esqueci </h3>
			</div>
			<div data-role="content">
				<form action="envia_recuperacao.php" method="POST" data-ajax="false">
					<div data-role="fieldcontain">
						<label for="cpf">CPF</label>
						<input name="cpf" id="cpf" type="text">
					</div>
					<input type="submit" value="Recuperar">
				</form>
			</div>
		<p>*Caso não receba o e-mail, verifique se o seu antivírus não esta bloqueando-o</p>			
		</div>
	</body>
</html>
