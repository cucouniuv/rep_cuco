<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

// Escolheu a turma e grava na sessao para usar nas outras telas
if ($_GET['codigo_turma'] > 0) {
	$_SESSION['codigo_turma'] = $_GET['codigo_turma'];
}

$codigo_turma = $_SESSION['codigo_turma'];
$codigo_pessoa = $_SESSION['id_pessoa'];

// Total de horas exigidas no curso
$query = "  select gc.total_horas,";
$query .= "        c.nome as curso,";
$query .= "        t.nome as turma";
$query .= " from grade_curso as gc";
$query .= " inner join curso as c";
$query .= "         on ( gc.id_curso = c.id_curso )";
$query .= " inner join turma as t";
$query .= "         on ( gc.id_grade_curso = t.id_grade_curso )";
$query .= " where (t.id_turma = $codigo_turma )";
$lista_info = mysql_query($query, $conn) or die(mysql_error());

// Total de horas aprovadas
$query = "  select sum(l.total_horas) as total_horas";
$query .= " from lancamento as l";
$query .= " where  (upper(status) = 'A')";
$query .= "        and (l.id_pessoa = $codigo_pessoa) ";
$query .= "        and (l.id_turma = $codigo_turma) ";
$lista_info_aluno = mysql_query($query, $conn) or die(mysql_error());
$row_aluno = mysql_fetch_array($lista_info_aluno);

// Total de horas aprovadas agrupados por evento
$query = "  select sum(l.total_horas) as total_horas,";
$query .= "        e.descricao as evento";
$query .= " from lancamento as l";
$query .= " inner join grade_evento as ge";
$query .= "         on (l.id_grade_evento = ge.id_grade_evento)";
$query .= " inner join evento as e";
$query .= "         on (ge.id_evento = e.id_evento)";
$query .= " where (upper(status) = 'A') ";
$query .= "        and (l.id_pessoa = $codigo_pessoa) ";
$query .= " group by e.descricao";
$lista_info_evento = mysql_query($query, $conn) or die(mysql_error());
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
			<a data-role="button" data-theme="b" href="academico.php" data-icon="back"
			data-iconpos="left" class="ui-btn-left"> Voltar </a>
			<h3> Informações </h3>
		</div>
		<div data-role="content">
			<div data-role="collapsible" data-collapsed="false" data-theme="b" data-content-theme="b">
				<h3> Detalhes</h3>
				<?php
				if ($lista_info) {
					while ($row = mysql_fetch_array($lista_info)) {
						echo '<p>Curso: ' . $row['curso'] . '</p>';
						echo '<p>Turma: ' . $row['turma'] . '</p>';
						echo '<p>Total de horas exigidas: ' . $row['total_horas'] . '</p>';
						echo '<p>Total de horas completadas: ' . $row_aluno['total_horas'] . '</p>';
					}
				}
				?>
			</div>
			<h4>Relatórios</h4>
			<form id="relatorio" action="relatorio_academico_atividade.php" method="GET" data-ajax="false">
				<div data-role="fieldcontain">
					<input type="hidden" name="id_turma" value="<?php echo $_SESSION['codigo_turma']; ?>" />
					<input type="hidden" name="id_pessoa" value="<?php echo $_SESSION['id_pessoa']; ?>" />
				</div>
				<input type="submit" data-icon="info" data-iconpos="left" value="Gerar relatório">
			</form>

			<h4>Gráficos</h4>
			<form id="grafico" action="grafico_academico_atividade.php" method="GET" data-ajax="false">
				<div data-role="fieldcontain">
					<input type="hidden" name="id_turma" value="<?php echo $_SESSION['codigo_turma']; ?>" />
				</div>
				<input type="submit" data-icon="info" data-iconpos="left" value="Comparativo entre horas restantes e realizadas">
			</form>
			
			<form id="grafico_evento" action="grafico_academico_atividade_evento.php" method="GET" data-ajax="false">
				<div data-role="fieldcontain">
					<input type="hidden" name="id_turma" value="<?php echo $_SESSION['codigo_turma']; ?>" />
				</div>
				<input type="submit" data-icon="info" data-iconpos="left" value="Quantia de horas realizadas agrupadas por evento">
			</form>

			<ul data-role="listview" data-divider-theme="b" data-inset="true">
				<h3>Detalhes das horas aprovadas</h3>
				<?php
				if ($lista_info_evento) {
					while ($row = mysql_fetch_array($lista_info_evento)) {
						echo '<li data-theme="c">';
						echo '<h3>Evento: ' . $row['evento'] . '</h3>';
						echo '<p>Total de horas: ' . $row['total_horas'] . '</p>';
						echo '</li>';
					}
				}
				?>
			</ul>
		</div>
	</div>
	</body>
</html>