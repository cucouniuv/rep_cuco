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
				<a data-role="button" href="administrador_consulta.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Cadastro de administrador</h3>
			</div>
			<div data-role="content">
				<form id="formulario">
					<div data-role="fieldcontain" id="cpf">
						<fieldset data-role="controlgroup">
							<label for="cpf"> CPF </label>
							<input name="cpf" id="cpf" placeholder="Insira 11 dígitos numéricos e sem máscara" pattern="[0-9]{11}" min="11" maxlength="11" value="<?php if (!empty($cpf)){echo $cpf;} ?>"  type="text" required>
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="nome">
						<fieldset data-role="controlgroup">
							<label for="nome"> Nome </label>
							<input name="nome" id="nome" placeholder="" maxlength="40" value="" type="text" required>
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="email">
						<fieldset data-role="controlgroup">
							<label for="email"> E-mail </label>
							<input name="email" id="email" placeholder="" value="" maxlength="45" type="email" required>
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="telefone">
						<fieldset data-role="controlgroup">
							<label for="telefone"> Telefone </label>
							<input name="telefone" id="telefone" placeholder="" maxlength="12" value="" type="number" required="">
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="senha">
						<fieldset data-role="controlgroup">
							<label for="senha"> Senha </label>
							<input name="senha" id="senha" pattern="^.{5,10}$" placeholder="Insira ao menos 5 dígitos e máximo 10" min="5" value="" type="password" required>
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="conf_senha">
						<fieldset data-role="controlgroup">
							<label for="conf_senha"> Confirme sua senha </label>
							<input name="conf_senha" id="conf_senha" pattern="^.{5,10}$" placeholder="Insira ao menos 5 dígitos e máximo 10" min="5" maxlength="10" value="" type="password" required>
						</fieldset>
					</div>
					<input id="enviar" type="submit" data-icon="check" data-iconpos="left" value="Confirmar">
					<div id="resposta"></div>
				</form>
			</div>

			<script type="text/javascript">
				jQuery(function() {
					jQuery("#formulario").submit(function(event) {

						// Mostra imagem carregando
						jQuery.mobile.showPageLoadingMsg();

						// Serializa o formulario
						var dados = new FormData(this);

						jQuery.ajax({
							type : "POST",
							url : "administrador_incluir.php",
							contentType : false,
							processData : false,
							cache : false,
							data : dados,
							success : function(data) {

								if (data.check == '1') {
									alert('Gravado com sucesso');
									location.href = 'administrador_consulta.php';
								} else {
									alert(jQuery.trim(data.message));
								}
							},
							dataType : "json"

						});

						// Esconde imagem carregando
						jQuery.mobile.hidePageLoadingMsg();

						event.preventDefault();
						return false;
					});
				});
			</script>
		</div>
	</body>
</html>