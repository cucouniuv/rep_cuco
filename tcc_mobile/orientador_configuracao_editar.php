<?php
include ('controle_sessao.php');
include ('config.php');

$idpessoa = $_SESSION['id_pessoa'];
$query = "	select *";
$query .= " from pessoa";
$query .= " where  id_pessoa = $idpessoa";
$pessoa = mysql_query($query, $conn) or die(mysql_error());
$rp = mysql_fetch_assoc($pessoa);
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
				<a data-role="button" href="orientador_configuracao.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3>Orientador</h3>
			</div>
			<div data-role="content">
				<form id="cadastro">
					<div data-role="fieldcontain" id="nome">
						<fieldset data-role="controlgroup">
							<label for="nome"> Nome </label>
							<input name="nome" id="nome" placeholder="" value="<?php echo $rp['nome']; ?>"  maxlength="40" type="text" required>
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="email">
						<fieldset data-role="controlgroup">
							<label for="email"> E-mail </label>
							<input name="email" id="email" placeholder="" maxlength="45" value="<?php echo $rp['email']; ?>" type="email">
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="telefone">
						<fieldset data-role="controlgroup">
							<label for="telefone"> Telefone para contato</label>
							<input name="telefone" id="telefone" placeholder="" maxlength="12" value="<?php echo $rp['telefone']; ?>" type="number" required>
						</fieldset>
					</div>
					<input type="hidden" name="codigo_pessoa" value="<?php echo $rp['id_pessoa'];?>">
					<input id="enviar" type="submit" data-icon="check" data-iconpos="left" value="Editar">
					<div id="resposta"></div>
				</form>
			</div>
			<script type="text/javascript">
				jQuery(function() {
					jQuery("#cadastro").submit(function(event) {

						jQuery.mobile.showPageLoadingMsg();

						var dados = jQuery("#cadastro").serialize();

						jQuery.ajax({
							type : "POST",
							url : "orientador_editar.php",
							processData : false,
							cache : false,
							data : dados,
							success : function(data) {
								if (data.check == '1') {
									alert('Gravado com sucesso');
									location.href = "orientador_configuracao.php";
								} else {
									alert(jQuery.trim(data.message));
								}
							},
							dataType : "json"
						});
						jQuery.mobile.hidePageLoadingMsg();
						event.preventDefault();
						return false;
					});
				});
			</script>
		</div>
	</body>
</html>
<!--
Validado
-->