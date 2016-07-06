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
				<h3> Orientador </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="true">
					<li data-role="list-divider" role="heading">
						Atividades
					</li>
					<li data-theme="c">
						<a href="orientador_atividade_turma.php" data-transition="slide"> Atividades de sua(s) turma(s) </a>
					</li>
					<li data-theme="c">
						<a href="orientador_atividade_cadastro_turma.php" data-transition="slide"> Cadastrar atividade para acadêmico </a>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
