<?php
include ('controle_sessao.php');

if (isset($_GET['hash'])){
	$_SESSION['tipoacesso'] = $_GET['hash'];
}

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
				<a data-role="button" href="administrador_configuracao.php" data-icon="gear"
				data-iconpos="left" class="ui-btn-right"> Config. </a>
				<a data-role="button" href="login.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Sair </a>
				<h3> Administrador </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="true">
					<li data-theme="c">
						<a href="administrador_curso.php" data-transition="slide"> Cursos </a>
					</li>
					<li data-theme="c">
						<a href="administrador_orientador.php" data-transition="slide"> Orientadores </a>
					</li>
					<li data-theme="c">
						<a href="administrador_turma.php" data-transition="slide"> Turmas </a>
					</li>
					<li data-theme="c">
						<a href="administrador_evento.php" data-transition="slide"> Eventos </a>
					</li>
					<li data-theme="c">
						<a href="administrador_relatorio.php" data-transition="slide"> Relatórios </a>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
