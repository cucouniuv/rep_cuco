<!DOCTYPE html>
<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

$query = " select id_curso,";
$query .= "       nome";
$query .= " from curso";
$query .= " order by nome asc";

$lista_curso = mysql_query($query, $conn) or die(mysql_error());
?>
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
				<h3> Grade de curso </h3>
			</div>
			<div data-role="content">
				<form id="formulario">
					<div data-role="fieldcontain">
						<legend>
							Curso:
						</legend>
						<select id="selectmenu1" name="curso" data-mini="false" required>
							<?php
							if ($lista_curso) {
								while ($row = mysql_fetch_array($lista_curso)) {
									echo '<option value="' . $row['id_curso'] . '">';
									echo $row['nome'];
									echo '</option>';
								}
							}
							?>
						</select>

					</div>
					<div data-role="fieldcontain">
						<label for="textinput1"> Validade (início) </label>
						<input name="validade_inicio" id="textinput1" placeholder="" value=""
						type="date" required>
					</div>
					<div data-role="fieldcontain">
						<label for="textinput2"> Validade (término) </label>
						<input name="validade_termino" id="textinput2" placeholder="" value=""
						type="date" required>
					</div>
					<div data-role="fieldcontain">
						<label for="textinput3"> Total de horas </label>
						<input name="total_horas" id="textinput3" pattern="[0-9]{0,1}[0-9]{0,1}[0-9]{1}\.[0-5]{1}[0-9]{1}" placeholder="HH.MM" value="" type="text" required>
					</div>
					<input id="enviar" type="submit" data-icon="check" data-iconpos="left" value="Gravar">
					<div id="resposta"></div>
				</form>
			</div>
			<script type="text/javascript">
				jQuery(function() {
					jQuery("#formulario").submit(function(event) {
					
						var dados = jQuery("#formulario").serialize();

						// Depuracao
						console.log(dados);
						console.log(jQuery("#formulario").serializeArray());

						jQuery.ajax({
							type : "POST",
							url : "curso_grade_incluir.php",
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
						return false;
					});
				});
			</script>
		</div>
	</body>
</html>
