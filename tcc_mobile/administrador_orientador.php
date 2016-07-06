<?php
include ('controle_sessao.php');
?>
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
				<a data-role="button" href="administrador.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Orientadores </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="true">
					<li data-role="list-divider" role="heading">
						Orientadores
					</li>
					<li data-theme="c">
						<a href="administrador_orientador_cadastro.php" data-transition="slide"> Cadastrar </a>
					</li>
					<li data-theme="c">
						<a href="administrador_orientador_consulta.php" data-transition="slide"> Consultar </a>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
