<?php
include ('controle_sessao.php');
include ('config.php');

$sql = "  select *";
$sql .= " from pessoa";
$sql .= " where  id_pessoa = " . $_GET['codigo'];
$retorno = mysql_query($sql, $conn) or die(mysql_error());
$adm = $row = mysql_fetch_array($retorno);
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
					<div data-role="fieldcontain" id="nome">
						<fieldset data-role="controlgroup">
							<label for="nome"> Nome </label>
							<input name="nome" id="nome" placeholder="" maxlength="40" value="<?php echo $adm['nome'];?>" type="text" required>
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="email">
						<fieldset data-role="controlgroup">
							<label for="email"> E-mail </label>
							<input name="email" id="email" placeholder="" value="<?php echo $adm['email'];?>" maxlength="45" type="email" required>
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="telefone">
						<fieldset data-role="controlgroup">
							<label for="telefone"> Telefone </label>
							<input name="telefone" id="telefone" placeholder="" maxlength="12" value="<?php echo $adm['telefone'];?>" type="number" required>
						</fieldset>
					</div>
					<input type="hidden" name="id_pessoa" value="<?php echo $adm['id_pessoa'];?>">
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
							url : "administrador_alterar.php",
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