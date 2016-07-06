<!DOCTYPE html>
<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

if (count($_GET) > 0) {
	if (array_key_exists('codigo_turma', $_GET)) {
		$_SESSION['codigo_turma'] = $_GET['codigo_turma'];
	}
}

$codigo_turma = $_SESSION['codigo_turma'];

$query = "	select t.*, ";
$query .= " gc.total_horas,";
$query .= " gc.validade_inicio,";
$query .= " gc.validade_termino,";
$query .= " c.nome as nome_curso ";
$query .= " from turma as t";
$query .= " inner join grade_curso as gc";
$query .= " on (t.id_grade_curso = gc.id_grade_curso)";
$query .= " inner join curso as c";
$query .= " on (gc.id_curso = c.id_curso)";
$query .= " where t.id_turma = $codigo_turma";
$turma = mysql_query($query, $conn) or die(mysql_error());

$query = "  select p.nome,";
$query .= "        p.cpf";
$query .= " from pessoa as p";
$query .= " inner join professor_turma as pt";
$query .= "         on (pt.id_pessoa = p.id_pessoa)";
$query .= " where pt.id_turma = $codigo_turma";
$query .= " order by p.nome";
$lista_professores = mysql_query($query, $conn) or die(mysql_error());

$query = "  select id_pessoa, ";
$query .= "        nome, ";
$query .= "        cpf";
$query .= " from pessoa ";
$query .= " where tipo like '%p%'";
$query .= " order by nome";
$lista_professor = mysql_query($query, $conn) or die(mysql_error());
?>
<html>
	<head>
		<?php
		include ('cabecalho.php');
		?>
	</head>
	<body>
		<div data-role="page" id="page1">
			<div data-theme="b" data-role="header">
				<a data-role="button" href="administrador_turma_vincular_orientador.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Orientador - Turma </h3>
			</div>
			<div data-role="content">
				<div data-role="collapsible-set">
					<div data-role="collapsible" data-theme="b">
						<h3> Turma escolhida</h3>
						<?php
						if ($turma) {
							while ($row = mysql_fetch_array($turma)) {
								echo '<p>Código: ' . $row['id_turma'] . '</p>';
								echo '<p>Período de validade da turma: ' . date_format(date_create($row['data_inicio']), 'd/m/Y') . ' até ' . date_format(date_create($row['data_termino']), 'd/m/Y') . '</p>';
								echo '<p>Curso: ' . $row['nome_curso'] . '</p>';
								echo '<p>Período de validade do curso: ' . date_format(date_create($row['validade_inicio']), 'd/m/Y') . ' até ' . date_format(date_create($row['validade_termino']), 'd/m/Y') . '</p>';
							}
						}
						?>
					</div>
					<div data-role="collapsible" data-theme="a">
						<h3>Orientadores vinculados a turma</h3>
						<?php
						if ($lista_professores) {
							while ($row = mysql_fetch_array($lista_professores)) {
								echo '<p>' . $row['nome'] . ' (CPF: ' . $row['cpf'] . ')</p>';
							}
						}
						?>
					</div>
				</div>

				<form id="formulario">
					<div data-role="fieldcontain">
						<label for="selectmenu3"> Orientador(es): </label>
						<select id="selectmenu3" name="codigo_professor[]" data-native-menu="false" multiple="multiple" required>
							<?php
							if ($lista_professor) {
								while ($row = mysql_fetch_array($lista_professor)) {
									echo '<option value="' . $row['id_pessoa'] . '">';
									echo $row['nome'] . ' (CPF: ' . $row['cpf'] . ')';
									echo '</option>';
								}
							}
							?>
						</select>
					</div>
					<div data-role="fieldcontain">
						<fieldset data-role="controlgroup">
							<legend>
								Operação:
							</legend>
							<input type="radio" name="vincular" id="radio-choice-h-2a" value="sim" checked="checked">
							<label for="radio-choice-h-2a">Vincular</label>
							<input type="radio" name="vincular" id="radio-choice-h-2b" value="nao">
							<label for="radio-choice-h-2b">Desvincular</label>
						</fieldset>
					</div>

					<input type="hidden" name="id_turma" value="<?php echo $codigo_turma; ?>"/>
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
							url : "vincular_orientador_turma.php",
							processData : false,
							cache : false,
							data : dados,
							success : function(data) {

								if (data.check == '1') {
									alert('Gravado com sucesso');
									location.href = "administrador_turma_vincular_orientador.php";
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