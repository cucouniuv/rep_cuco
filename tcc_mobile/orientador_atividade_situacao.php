<?php

include('controle_sessao.php');

session_start();

if (count($_GET) > 0) {
	if (array_key_exists('codigo_turma', $_GET)) {
		$_SESSION['codigo_turma'] = $_GET['codigo_turma'];
	}
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
				<a data-role="button" href="orientador.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Situações </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="false" data-filter-placeholder="Digite aqui seu filtro...">
					<li data-theme="c">
						<a href="orientador_atividade_solicitacao.php?status=N" data-transition="slide"> <h3>Aguardando avaliação</h3> </a>
					</li>
					<li data-theme="e">
						<a href="orientador_atividade_solicitacao.php?status=D" data-transition="slide"> <h3>Aguardando documentação</h3> </a>
					</li>
					<li data-theme="b">
						<a href="orientador_atividade_solicitacao.php?status=A" data-transition="slide"> <h3>Aprovados</h3> </a>
					</li>
					<li data-theme="a">
						<a href="orientador_atividade_solicitacao.php?status=R" data-transition="slide"> <h3>Reprovados</h3> </a>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
