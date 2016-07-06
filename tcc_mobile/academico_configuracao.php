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
				<a data-role="button" data-direction="reverse" href="academico.php"
				data-icon="forward" data-iconpos="left" class="ui-btn-left"> Voltar </a>
				<h3> Configuração </h3>
			</div>
			<div data-role="content">
				<form id="formulario">
					<div data-role="fieldcontain">
						<label for="textinput2"> Nova senha </label>
						<input name="senha" id="textinput2" pattern="^.{5,10}$" placeholder="Insira ao menos 5 dígitos e máximo 10" min="5" maxlength="10" type="password" required>
					</div>
					<div data-role="fieldcontain">
						<label for="textinput3"> Confirmação de nova senha </label>
						<input name="senha_confirmacao" id="textinput3" pattern="^.{5,10}$" placeholder="Insira ao menos 5 dígitos e máximo 10" min="5" maxlength="10" value=""
						type="password" required>
					</div>
					<input type="hidden" name="idpessoa" value="<?php echo $_SESSION['id_pessoa']; ?>">
					<input type="submit" id="enviar" name="enviar" data-icon="check" data-iconpos="left" value="Alterar">
					<div id="resposta"></div>
				</form>
				<a data-role="button" href="academico_configuracao_editar.php"
				data-icon="next"> Alterar dados cadastrais </a>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(function() {
				jQuery("#formulario").submit(function(event) {

					var dados = jQuery("#formulario").serialize();

					// Depuracao
					console.log(dados);

					jQuery.ajax({
						type : "POST",
						url : "altera_senha.php",
						cache : false,
						data : dados,
						success : function(data) {

							if (data.check == '1') {
								alert('Alterado com sucesso');
								location.href = "academico.php";
							} else {
								alert(jQuery.trim(data.message));
							}
						},
						dataType : "json"
					});

					event.preventDefault();
					return false;
				});
			});
		</script>
		</div>
	</body>
</html>