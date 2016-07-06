<?php
include ('controle_sessao.php');

// Valida niveis de acesso
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
				<a data-role="button" href="orientador_configuracao.php" data-icon="gear"
				data-iconpos="left" class="ui-btn-right"> Config. </a>
				<a data-role="button" href="login.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Sair </a>
				<h3> Orientador </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="true">
					<li data-role="list-divider" role="heading">
						Opções
					</li>
					<li data-theme="c">
						<a href="orientador_turma.php" data-transition="slide"> Turmas </a>
					</li>
					<li data-theme="c">
						<a href="orientador_atividade.php" data-transition="slide"> Atividades </a>
					</li>
					<li data-theme="c">
						<a href="orientador_relatorio.php" data-transition="slide"> Relatórios </a>
					</li>
					<li data-theme="c">
						<a href="orientador_grafico.php" data-transition="slide"> Gráficos </a>
					</li>	
				</ul>
			</div>
		</div>
	</body>
</html>
