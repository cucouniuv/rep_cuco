<?php
include ('controle_sessao.php');
$location = $_POST['location'];
global $mensagem;
$mensagem = $_POST['mensagem'];
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
				<a data-role="button" data-direction="reverse" href="<?php echo $location; ?>"
				data-icon="forward" data-iconpos="left" class="ui-btn-left"> Voltar </a>
				<h3> Validação </h3>
			</div>
			<div data-role="content">
			<?php echo $mensagem; ?>;
			</div>
		</div>
	</body>
</html>
?>
