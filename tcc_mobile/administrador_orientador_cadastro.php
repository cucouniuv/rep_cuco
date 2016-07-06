<?php
include ('controle_sessao.php');
include ('config.php');

$query = "	select t.*, ";
$query .= "        gc.total_horas,";
$query .= "        gc.validade_inicio,";
$query .= "        gc.validade_termino,";
$query .= "        c.nome as nome_curso ";
$query .= " from turma as t";
$query .= " inner join grade_curso as gc";
$query .= "         on (t.id_grade_curso = gc.id_grade_curso)";
$query .= " inner join curso as c";
$query .= "         on (gc.id_curso = c.id_curso)";
$turma = mysql_query($query, $conn) or die(mysql_error());

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
				<a data-role="button" href="administrador_orientador.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3>Orientador</h3>
			</div>
			<div data-role="content">
				<form id="cadastro">

					<div data-role="fieldcontain" id="cpf">
						<fieldset data-role="controlgroup">
							<label for="cpf"> CPF </label>
							<input name="cpf" id="cpf" placeholder="Insira 11 dígitos numéricos e sem máscara" value="<?php if (!empty($cpf)){echo $cpf;} ?>"  type="text" min="11" maxlength="11" pattern="[0-9]{11}" required>
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="nome">
						<fieldset data-role="controlgroup">
							<label for="nome"> Nome </label>
							<input name="nome" id="nome" placeholder="" value=""  maxlength="40" type="text" required>
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="email">
						<fieldset data-role="controlgroup">
							<label for="email"> E-mail </label>
							<input name="email" id="email" placeholder="" maxlength="45" value="" type="email">
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="telefone">
						<fieldset data-role="controlgroup">
							<label for="telefone"> Telefone para contato</label>
							<input name="telefone" id="telefone" placeholder="" maxlength="12" value="" type="number" required>
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="senha">
						<fieldset data-role="controlgroup">
							<label for="senha"> Senha </label>
							<input name="senha" id="senha" placeholder="Insira ao menos 5 dígitos e máximo 10" min="5" maxlength="10" value="" type="password" required>
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="conf_senha">
						<fieldset data-role="controlgroup">
							<label for="conf_senha"> Confirme sua senha </label>
							<input name="conf_senha" id="conf_senha" placeholder="Insira ao menos 5 dígitos e máximo 10" value="" min="5" maxlength="10" type="password" required>
						</fieldset>
					</div>
					<input id="enviar" type="submit" data-icon="check" data-iconpos="left" value="Confirmar">
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
							url : "orientador_incluir.php",
							cache : false,
							data : dados,
							success : function(data) {
								if (data.check == '1') {
									alert('Gravado com sucesso');
									location.href = "administrador_orientador.php";
								} else {
									alert(jQuery.trim(data.message));
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
<!--
	Validado
-->