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
				<h3> Turmas </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="true">
					<li data-role="list-divider" role="heading">
						Turmas
					</li>
					<li data-theme="c">
						<a href="administrador_turma_cadastro.php" data-transition="slide"> Cadastrar </a>
					</li>
					<li data-theme="c">
						<a href="administrador_turma_consulta.php" data-transition="slide"> Consultar </a>
					</li>
					<li data-theme="c">
						<a href="administrador_turma_vincular_aluno.php" data-transition="slide"> Vincular acadêmico </a>
					</li>
					<li data-theme="c">
						<a href="administrador_turma_vincular_orientador.php" data-transition="slide"> Vincular orientador </a>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
