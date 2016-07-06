<?php
include('controle_sessao.php');
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
				<a data-role="button" href="academico.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Suas tarefas </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="false" data-filter-placeholder="Digite aqui seu filtro...">
					<li data-theme="c">
						<a href="academico_atividade_consultar.php?status=N" data-transition="slide"> <h3>Aguardando avaliação</h3> </a>
					</li>
					<li data-theme="e">
						<a href="academico_atividade_consultar.php?status=D" data-transition="slide"> <h3>Aguardando documentação</h3> </a>
					</li>
					<li data-theme="b">
						<a href="academico_atividade_consultar.php?status=A" data-transition="slide"> <h3>Aprovados</h3> </a>
					</li>
					<li data-theme="a">
						<a href="academico_atividade_consultar.php?status=R" data-transition="slide"> <h3>Reprovados</h3> </a>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
