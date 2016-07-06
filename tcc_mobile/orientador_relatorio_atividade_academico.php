<?php
include ('controle_sessao.php');
include ('config.php');

$query = " select distinct t.id_turma, ";
$query .= "       c.nome as curso,";
$query .= "       t.nome as turma,";
$query .= "       t.data_inicio,";
$query .= "       t.data_termino";
$query .= " from turma t";
$query .= " inner join grade_curso gc";
$query .= "         on ( gc.id_grade_curso = t.id_grade_curso )";
$query .= " inner join curso c";
$query .= "         on ( gc.id_curso = c.id_curso )";
$query .= " inner join professor_turma as pt";
$query .= "         on (pt.id_turma = t.id_turma)";
$query .= " where pt.id_pessoa = " . $_SESSION['id_pessoa'];
$query .= " and exists(select at.id_turma";
$query .= "            from aluno_turma as at";
$query .= "            where at.id_turma = t.id_turma)";
$query .= " order by t.nome, c.nome asc";
$lista_turma = mysql_query($query, $conn) or die(mysql_error());
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
			<h3> Relatório de acadêmicos </h3>
			<a data-role="button" data-theme="b" href="orientador_relatorio.php" data-icon="back"
			data-iconpos="left" class="ui-btn-left"> Voltar </a>
		</div>
		<div data-role="content">
			<p>Só será exibido os acadêmicos que possuirem atividades realizadas.</p>
			<form id="formulario" method="POST" action="relatorio_atividade_academico.php" data-ajax="false">
				<div data-role="fieldcontain">
					<label for="selectmenu2"> Turma </label>
					<select name="codigo_turma" required>
						<?php
						if ($lista_turma) {
							while ($row = mysql_fetch_array($lista_turma)) {
								echo '<option value="' . $row['id_turma'] . '" required>';
								echo $row['turma'] . ' (' . date_format(date_create($row['data_inicio']), 'd/m/Y') . ' até ' . date_format(date_create($row['data_termino']), 'd/m/Y') . ') ' . $row['curso'];
								echo '</option>';
							}
						}
						?>
					</select>
				</div>
				<input id="imprimir" type="submit" data-icon="check" data-iconpos="left" value="Imprimir">
			</form>
		</div>
	</div>
	</body>
</html>
