<?php

include ('controle_sessao.php');
include '../tcc_mobile/config.php';

$id_evento = $_GET['codigo'];
$query = "select * from evento where id_evento = $id_evento";
$ret = mysql_query($query, $conn) or die(mysql_error());
$res = mysql_fetch_assoc($ret);
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
				<a data-role="button" href="administrador_evento_consulta.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Evento </h3>
			</div>
			<div data-role="content">
				<form id="formulario">
					<div data-role="fieldcontain">
						<input type="hidden" name="id_evento" value="<?php echo $id_evento; ?>" />
						<label for="descricao"> Descrição </label>
						<input name="descricao" id="descricao" placeholder="" value="<?php echo $res['descricao']; ?>" type="text">
					</div>
					<input type="submit" data-icon="check" data-iconpos="left" value="Gravar">
					<div id="resposta"></div>
				</form>
			</div>
			
			<script type="text/javascript">
				jQuery(function() {
					jQuery("#formulario").submit(function(event) {

						jQuery.mobile.showPageLoadingMsg();

						var dados = jQuery("#formulario").serialize();

						jQuery.ajax({
							type : "POST",
							url : "evento_editar.php",
							processData : false,
							cache : false,
							data : dados,
							success : function(data) {
								if (data.check == '1') {
									alert('Gravado com sucesso');
									location.href = "administrador_evento_consulta.php";
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
