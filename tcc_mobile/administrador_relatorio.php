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
				<h3> Relatórios </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="true">
					<li data-role="list-divider" role="heading">
						Relatórios
					</li>
					<li data-theme="c">
						<a href="administrador_relatorio_academico.php" data-transition="slide"> Relação de acadêmico por turma </a>
					</li>
					<li data-theme="c">
						<a href="administrador_relatorio_orientador.php" data-transition="slide"> Relação de orientador por turma </a>
					</li>
					<li data-theme="c">
						<a href="administrador_relatorio_administrador.php" data-transition="slide"> Relação de administradores </a>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
