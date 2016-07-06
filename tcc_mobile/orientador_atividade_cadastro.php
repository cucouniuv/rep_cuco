<!DOCTYPE html>
<?php
include ('controle_sessao.php');
include ('config.php');

$id_turma = $_GET['codigo'];

if ($id_turma > 0) {
	$query = "  select ge.id_grade_evento,";
	$query .= "        e.descricao as evento,";
	$query .= "        t.data_termino";
	$query .= " from grade_evento ge";
	$query .= " inner join grade_curso gc";
	$query .= "         on ( ge.id_grade_curso = gc.id_grade_curso)";
	$query .= " inner join turma as t";
	$query .= "         on ( gc.id_grade_curso = t.id_grade_curso)";
	$query .= " inner join evento e";
	$query .= "         on (ge.id_evento = e.id_evento)";
	$query .= " where  t.id_turma = $id_turma";
	$lista_evento = mysql_query($query, $conn) or die(mysql_error());
	// Query temporaria
	$query = "  select t.data_termino";
	$query .= " from grade_evento ge";
	$query .= " inner join grade_curso gc";
	$query .= "         on ( ge.id_grade_curso = gc.id_grade_curso)";
	$query .= " inner join turma as t";
	$query .= "         on ( gc.id_grade_curso = t.id_grade_curso)";
	$query .= " inner join evento e";
	$query .= "         on (ge.id_evento = e.id_evento)";
	$query .= " where  t.id_turma = $id_turma";
	$temp = mysql_query($query, $conn) or die(mysql_error());
	$row_temp = mysql_fetch_assoc($temp);
	$validade = $row_temp['data_termino'];
	unset($validade);

	$query = "  select distinct p.id_pessoa, ";
	$query .= "        p.nome, ";
	$query .= "        p.cpf";
	$query .= " from pessoa as p ";
	$query .= " inner join aluno_turma as altu";
	$query .= "         on (p.id_pessoa = altu.id_pessoa)";
	$query .= " where p.tipo like '%l%'";	
	$query .= "        and altu.id_turma = $id_turma";
	$query .= " order by nome";
	$lista_aluno = mysql_query($query, $conn) or die(mysql_error());

}
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
				<h3> Atividade </h3>
				<a data-role="button" data-theme="b" href="academico.php" data-icon="back"
				data-iconpos="left" class="ui-btn-left"> Voltar </a>
			</div>
			<div data-role="content">
				<form id="formulario" method="POST" action="atividade_incluir.php" enctype="multipart/form-data">

					<div data-role="fieldcontain">
						<label for="selectmenu3"> Aluno(a): </label>
						<select id="selectmenu3" name="codigo_aluno" data-native-menu="false" required>
							<?php
							if ($lista_aluno) {
								while ($row = mysql_fetch_array($lista_aluno)) {
									echo '<option value="' . $row['id_pessoa'] . '">';
									echo $row['nome'] . ' (CPF: ' . $row['cpf'] . ')';
									echo '</option>';
								}
							}
							?>
						</select>
					</div>
										
					<div data-role="fieldcontain">
						<label for="selectmenu2"> Evento </label>
						<select name="codigo_evento" required>
							<?php
							if ($lista_evento) {
								while ($row = mysql_fetch_array($lista_evento)) {
									echo '<option value="' . $row['id_grade_evento'] . '">';
									echo $row['evento'];
									echo '</option>';
								}
							}
							?>
						</select>
					</div>
					<div data-role="fieldcontain">
						<label for="textinput1"> Data de ínicio do evento </label>
						<input name="data_inicio" id="textinput1" placeholder="" value="" type="date" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" required>
					</div>
					<div data-role="fieldcontain">
						<label for="textinput2"> Data de término do evento </label>
						<input name="data_termino" id="textinput2" placeholder="" value="" type="date" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" required>
					</div>
					<div data-role="fieldcontain">
						<label for="textinput3"> Total de horas </label>
						<input name="total_horas" id="textinput3" placeholder="HH.MM" value="" type="text" pattern="[0-9]{0,1}[0-9]{0,1}[0-9]{1}\.[0-5]{1}[0-9]{1}" required>
					</div>
					<div data-role="fieldcontain">
						<label for="textarea1"> Observações </label>
						<textarea name="observacao" id="textarea1" placeholder="Descrição da atividade" required></textarea>
					</div>
					<input type="hidden" name="validade" value="<?php echo $validade; ?>">
					<input type="hidden" name="codigo_turma" value="<?php echo $id_turma; ?>">					
					<input id="enviar" type="submit" data-icon="check" data-iconpos="left" value="Gravar">
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
							url : "atividade_incluir_manual.php",
							mimeType : "multipart/form-data",
							contentType : false,
							processData : false,
							cache : false,
							data : dados,
							success : function(data) {

								if (data.check == '1') {
									alert('Gravado com sucesso');
									location.href = "orientador_atividade_cadastro_turma.php";
								} else {
									alert(jQuery.trim(data.message));
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