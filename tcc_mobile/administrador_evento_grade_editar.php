<!DOCTYPE html>
<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

$codigo_grade_evento = $_GET['codigo'];
$query = " select * from grade_evento where id_grade_evento = $codigo_grade_evento";
$retorno = mysql_query($query, $conn) or die(mysql_error());
$ge = mysql_fetch_assoc($retorno);

$query = " select id_evento, ";
$query .= "       descricao";
$query .= " from evento";
$query .= " order by descricao asc";
$lista_evento = mysql_query($query, $conn) or die(mysql_error());

$query = " select gc.id_grade_curso, ";
$query .= "       gc.id_curso,";
$query .= "       c.nome,";
$query .= "       gc.total_horas,";
$query .= "       gc.validade_inicio,";
$query .= "       gc.validade_termino";
$query .= " from grade_curso gc";
$query .= " inner join curso c";
$query .= "         on ( gc.id_curso = c.id_curso )";
$query .= " order by c.nome asc";
$lista_grade_curso = mysql_query($query, $conn) or die(mysql_error());

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
				<a data-role="button" href="administrador_evento_grade_consulta.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Grade de evento </h3>
			</div>
			<div data-role="content">
				<form id="formulario">
					<div data-role="fieldcontain">
						<legend>
							Grade de curso:
						</legend>
						<select id="selectmenu1" name="id_grade_curso" data-mini="false" required>
							<?php
							if ($lista_grade_curso) {
								while ($row = mysql_fetch_array($lista_grade_curso)) {
									echo '<option value="' . $row['id_grade_curso'] . '"' . ($ge['id_grade_curso']==$row['id_grade_curso']?"selected=selected":"")  .'>';
									echo $row['nome'] . ' (' . date_format(date_create($row['validade_inicio']), 'd/m/Y') . ' até ' . date_format(date_create($row['validade_termino']), 'd/m/Y') . ')';
									echo '</option>';
								}
							}
							?>
						</select>

					</div>

					<div data-role="fieldcontain">
						<legend>
							Evento:
						</legend>
						<select id="selectmenu1" name="id_evento" data-mini="false" required>
							<?php
							if ($lista_evento) {
								while ($row = mysql_fetch_array($lista_evento)) {
									echo '<option value="' . $row['id_evento'] . '"' . ($ge['id_evento']==$row['id_evento']?"selected=selected":"")  .'>';
									echo $row['descricao'];
									echo '</option>';
								}
							}
							?>
						</select>

					</div>
					<div data-role="fieldcontain">
						<label for="textinput1"> Quantia de horas </label>
						<input name="minimo_horas" id="textinput1" placeholder="HH.MM" value="<?php echo $ge['minimo_horas'];?>" pattern="[0-9]{0,1}[0-9]{0,1}[0-9]{1}\.[0-5]{1}[0-9]{1}"
						type="text" required>
					</div>
					<input type="hidden" name="codigo_grade_evento" value="<?php echo $ge['id_grade_evento'];?>">
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
							url : "evento_grade_editar.php",
							processData : false,
							cache : false,
							data : dados,
							success : function(data) {

								if (data.check == '1') {
									alert('Gravado com sucesso');
									location.href = "administrador_evento_grade_consulta.php";
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
