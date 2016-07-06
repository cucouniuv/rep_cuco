<!DOCTYPE html>
<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

$codigo_turma = $_GET['id_turma'];

// Recarrega dados da turma
$query = "  select *";
$query .= " from turma";
$query .= " where id_turma = $codigo_turma";
$retorno = mysql_query($query, $conn) or die(mysql_error());
$turma = mysql_fetch_assoc($retorno);

$data_inicio = date_format(date_create($turma['data_inicio']), 'Y-m-d');
$data_termino = date_format(date_create($turma['data_termino']), 'Y-m-d');

// Carrega dados da grade do curso
$query = " select gc.id_grade_curso, ";
$query .= "       gc.validade_inicio, ";
$query .= "       gc.validade_termino, ";
$query .= "       c.nome";
$query .= " from grade_curso gc ";
$query .= " inner join curso c ";
$query .= "    on ( gc.id_curso = c.id_curso )";
$query .= " order by nome asc";
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
				<a data-role="button" href="administrador_turma_consulta.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Turma </h3>
			</div>
			<div data-role="content">
				<form id="formulario">
					<div data-role="fieldcontain">
						<legend>
							Grade de curso:
						</legend>
						<select id="selectmenu1" name="codigo_grade_curso" data-mini="false">
							<?php
							if ($lista_grade_curso) {
								while ($row = mysql_fetch_array($lista_grade_curso)) {
									echo '<option value="' . $row['id_grade_curso'] . '"' . ($turma['id_grade_curso']==$row['id_grade_curso']?"selected=selected":"") . '>';
									echo $row['nome'] . ' (' . date_format(date_create($row['validade_inicio']), 'd/m/Y') . ' até ' . date_format(date_create($row['validade_termino']), 'd/m/Y') . ')';
									echo '</option>';
								}
							}
							?>
						</select>

					</div>

					<div data-role="fieldcontain">
						<label for="nome"> Nome </label>
						<input name="nome" id="nome" placeholder="" value="<?php echo $turma['nome'];?>"  min="5" maxlength="60" type="text" required>
					</div>
					<div data-role="fieldcontain">
						<label for="textinput1"> Data (início) </label>
						<input name="data_inicio" id="textinput1" placeholder="" value="<?php echo $data_inicio;?>"
						type="date" required>
					</div>
					<div data-role="fieldcontain">
						<label for="textinput2"> Data (término) </label>
						<input name="data_termino" id="textinput2" placeholder="" value="<?php echo $data_termino;?>"
						type="date" required>
					</div>
					<input type="hidden" name="id_turma" value="<?php echo $codigo_turma;?>">
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
							url : "turma_editar.php",
							processData : false,
							cache : false,
							data : dados,
							success : function(data) {

								if (data.check == '1') {
									alert('Gravado com sucesso');
									location.href = "administrador_turma_consulta.php";
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
