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
				<a data-role="button" href="orientador.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Turmas </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="true">
					<li data-role="list-divider" role="heading">
						Turmas
					</li>
					<li data-theme="c">
						<a href="orientador_turma_cadastro.php" data-transition="slide"> Cadastrar </a>
					</li>
					<li data-theme="c">
						<a href="orientador_turma_consulta.php" data-transition="slide"> Consultar </a>
					</li>
					<li data-theme="c">
						<a href="orientador_turma_vincular_aluno.php" data-transition="slide"> Vincular acadêmico </a>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
