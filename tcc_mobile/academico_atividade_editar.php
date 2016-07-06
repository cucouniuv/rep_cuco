<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

//inicia a sessao
session_start();

$id_aluno = $_SESSION['id_pessoa'];
$id_turma = $_SESSION['codigo_turma'];

if ($id_turma > 0) {

	$query = "  select ge.id_grade_evento, e.descricao as evento ";
	$query .= " from grade_evento ge";
	$query .= " inner join grade_curso gc";
	$query .= "         on ( ge.id_grade_curso = gc.id_grade_curso)";
	$query .= " inner join turma t";
	$query .= "         on ( gc.id_grade_curso = t.id_grade_curso)";
	$query .= " inner join evento e";
	$query .= "         on (ge.id_evento = e.id_evento)";
	$query .= " where  t.id_turma = $id_turma";

	$lista_evento = mysql_query($query, $conn) or die(mysql_error());
}

$sql = "  select *";
$sql .= " from lancamento";
$sql .= " where id_lancamento = " . $_GET['id_lancamento'];
$lancamento = mysql_query($sql, $conn) or die(mysql_error());
$rl = $row = mysql_fetch_array($lancamento);
 
$datainicio = date_format(date_create($row['data_inicio_evento']), 'Y-m-d');
$datatermino = date_format(date_create($row['data_termino_evento']), 'Y-m-d');
 
?>

<!DOCTYPE html>
<html>
	<head>
		<?php
		include ('cabecalho.php');
		?>
	</head>
	<!-- Home -->
	<div data-role="page" id="page1">
		<div data-theme="b" data-role="header">
			<h3> Atividade </h3>
			<a data-role="button" data-theme="b" href="academico.php" data-icon="back"
			data-iconpos="left" class="ui-btn-left"> Voltar </a>
		</div>
		<div data-role="content">
			<form id="formulario" method="POST" action="atividade_editar.php" enctype="multipart/form-data">
				<div data-role="fieldcontain">
					<label for="selectmenu2"> Evento </label>
					<select name="codigo_evento" required>
						<?php
						if ($lista_evento) {
							while ($row = mysql_fetch_array($lista_evento)) {
								echo '<option value="' . $row['id_grade_evento'] . '"' . ($rl['id_grade_evento']==$row['id_grade_evento']?"selected=selected":"")  .'>';
								echo $row['evento'];
								echo '</option>';
							}
						}
						?>
					</select>
				</div>
				<div data-role="fieldcontain">
					<label for="textinput1"> Data de ínicio do evento </label>
					<input name="data_inicio" id="textinput1" placeholder="" value="<?php echo $datainicio;?>" type="date" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" required>
				</div>
				<div data-role="fieldcontain">
					<label for="textinput2"> Data de término do evento </label>
					<input name="data_termino" id="textinput2" placeholder="" value="<?php echo $datatermino;?>" type="date" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" required>
				</div>
				<div data-role="fieldcontain">
					<label for="textinput3"> Total de horas </label>
					<input name="total_horas" id="textinput3" placeholder="HH.MM" value="<?php echo $rl['total_horas']; ?>" type="text" pattern="[0-9]{0,1}[0-9]{0,1}[0-9]{1}\.[0-5]{1}[0-9]{1}" required>
				</div>
				<div data-role="fieldcontain">
					<label for="textarea1"> Observações </label>
					<textarea name="observacao" id="textarea1" placeholder=""><?php echo $rl['observacao'];?></textarea>
				</div>
				<!--
				<div data-role="fieldcontain">
					<label for="textinput4"> Certificado (frente) *JPG, TIF e PDF</label>
					<input name="documento_frente" id="files" placeholder="" value="" type="file" required>
				</div>
				<div data-role="fieldcontain">
					<label for="textinput5"> Certificado (verso) *JPG, TIF e PDF</label>
					<input name="documento_verso" id="textinput5" placeholder="" value="" type="file">
				</div>
				-->
				<input type="hidden" name="id_lancamento" value="<?php echo $rl['id_lancamento']; ?>">
				<input id="enviar" <?php if ($rl['status'] != 'N'){ echo 'disabled';} ?> type="submit" data-icon="check" data-iconpos="left" value="Gravar">
				<div id="resposta"></div>
			</form>
		</div>

		<script type="text/javascript">
			jQuery(function() {

				jQuery("#formulario").submit(function(event) {
					jQuery.mobile.showPageLoadingMsg();

					var dados = new FormData(this);

					jQuery.ajax({
						type : "POST",
						url : "atividade_editar.php",
						mimeType : "multipart/form-data",
						contentType : false,
						processData : false,
						cache : false,
						data : dados,
						success : function(data) {

							if (data.check == '1') {
								alert('Gravado com sucesso');
								location.href = "academico.php";
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
