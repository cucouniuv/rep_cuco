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
				<a data-role="button" href="administrador_curso.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Curso </h3>
			</div>
			<div data-role="content">
				<form id="formulario">
					<div data-role="fieldcontain">
						<label for="nome"> Nome </label>
						<input name="nome" id="nome" placeholder="" maxlength="60" value="" type="text" required>
					</div>
					<input id="enviar" type="submit" data-icon="check" data-iconpos="left" value="Gravar">
				</form>
				<div id="resposta"></div>
			</div>
			<script type="text/javascript">
				jQuery(function() {
					jQuery("#formulario").submit(function(event) {
						
						jQuery.mobile.showPageLoadingMsg();
						var dados = jQuery("#formulario").serialize();

						jQuery.ajax({
							type : "POST",
							url : "curso_incluir.php",
							cache : false,
							data : dados,
							success : function(data) {
								if (data.check == '0') {
									alert(jQuery.trim(data.message));
								} else {
									alert('Gravado com sucesso');
									location.href = "administrador_curso.php";
								}
							},
							dataType : "json"
						});
						
						event.preventDefault();
						jQuery.mobile.hidePageLoadingMsg();
						return false;
					});
				});
			</script>
		</div>
	</body>
</html>
