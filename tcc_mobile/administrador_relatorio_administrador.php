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
	<!-- Home -->
	<div data-role="page" id="page1">
		<div data-theme="b" data-role="header">
			<h3> Relatório de administradores </h3>
			<a data-role="button" data-theme="b" href="administrador_relatorio.php" data-icon="back"
			data-iconpos="left" class="ui-btn-left"> Voltar </a>
		</div>
		<div data-role="content">
			<form id="formulario" method="POST" action="relatorio_administrador.php" data-ajax="false">
				<div data-role="fieldcontain">
					<label for="textinput1"> Código do administrador (início)</label>
					<input name="codigo_inicio" id="textinput1" placeholder="" value="0" type="number" required>
				</div>
				<div data-role="fieldcontain">
					<label for="textinput2"> Código do administrador (término)</label>
					<input name="codigo_termino" id="textinput2" placeholder="" value="9000" type="number" required>
				</div>
				<input id="imprimir" type="submit" data-icon="check" data-iconpos="left" value="Imprimir">	
			</form>
		</div>
	</div>
	</body>
</html>
