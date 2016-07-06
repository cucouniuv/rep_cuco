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
				<h3> Gráficos </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="true">
					<li data-role="list-divider" role="heading">
						Gráficos
					</li>
					<li data-theme="c">
						<a href="orientador_grafico_horas_academico.php" data-transition="slide"> Horas aprovadas dos acadêmicos </a>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
