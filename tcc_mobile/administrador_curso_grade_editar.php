<!DOCTYPE html>
<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

$codigo_grade_curso = $_GET['codigo'];
$query = " select * from grade_curso where id_grade_curso = $codigo_grade_curso";
$retorno = mysql_query($query, $conn) or die(mysql_error());
$gc = mysql_fetch_assoc($retorno);
$validade_inicio = date_format(date_create($gc['validade_inicio']), 'Y-m-d');
$validade_termino = date_format(date_create($gc['validade_termino']), 'Y-m-d');

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
				<a data-role="button" href="administrador_curso_grade_consulta.php" data-icon="back" data-iconpos="left"
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
									echo '<option value="' . $row['id_curso'] . '"' . ($gc['id_curso'] == $row['id_curso'] ? "selected=selected" : "") . '>';
									echo $row['nome'];
									echo '</option>';
								}
							}
							?>
						</select>

					</div>
					<div data-role="fieldcontain">
						<label for="textinput1"> Validade (início) </label>
						<input name="validade_inicio" id="textinput1" placeholder="" value="<?php echo $validade_inicio;?>"
						type="date" required>
					</div>
					<div data-role="fieldcontain">
						<label for="textinput2"> Validade (término) </label>
						<input name="validade_termino" id="textinput2" placeholder="" value="<?php echo $validade_termino;?>"
						type="date" required>
					</div>
					<div data-role="fieldcontain">
						<label for="textinput3"> Total de horas </label>
						<input name="total_horas" id="textinput3" pattern="[0-9]{0,1}[0-9]{0,1}[0-9]{1}\.[0-5]{1}[0-9]{1}" placeholder="HH.MM" value="<?php echo $gc['total_horas'];?>" type="text" required>
					</div>
					<input type="hidden" name="codigo_grade_curso" value="<?php echo $gc['id_grade_curso'];?>">
					<input id="enviar" type="submit" data-icon="check" data-iconpos="left" value="Gravar">
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
							url : "curso_grade_editar.php",
							processData : false,
							cache : false,
							data : dados,
							success : function(data) {

								if (data.check == '1') {
									alert('Gravado com sucesso');
									location.href = "administrador_curso_grade_consulta.php";
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
