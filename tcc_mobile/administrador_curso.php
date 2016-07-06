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
				<h3> Cursos </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="true">
					<li data-role="list-divider" role="heading">
						Cursos
					</li>
					<li data-theme="c">
						<a href="administrador_curso_cadastro.php" data-transition="slide"> Cadastrar </a>
					</li>
					<li data-theme="c">
						<a href="administrador_curso_consulta.php" data-transition="slide"> Consultar </a>
					</li>
					<li data-theme="c">
						<a href="administrador_curso_grade_cadastro.php" data-transition="slide"> Cadastrar grade </a>
					</li>
					<li data-theme="c">
						<a href="administrador_curso_grade_consulta.php" data-transition="slide"> Consultar grade </a>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
