<!DOCTYPE html>
<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

$query = " select ge.id_grade_evento, ";
$query .= "       e.descricao as evento,";
$query .= "       gc.id_curso,";
$query .= "       ge.id_evento,";
$query .= "       ge.minimo_horas,";
$query .= "       ge.maximo_horas,";
$query .= "       gc.validade_inicio,";
$query .= "       gc.validade_termino,";
$query .= "       gc.total_horas,";
$query .= "       c.nome as curso";
$query .= " from grade_evento ge ";
$query .= " inner join grade_curso as gc ";
$query .= "           on (ge.id_grade_curso = gc.id_grade_curso)";
$query .= " inner join curso as c ";
$query .= "           on (gc.id_curso = c.id_curso)";
$query .= " inner join evento as e ";
$query .= "           on (ge.id_evento = e.id_evento)";
$query .= " order by e.descricao, c.nome, ge.id_grade_evento";

$lista_grade_evento = mysql_query($query, $conn) or die(mysql_error());
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
				<a data-role="button" href="administrador_evento.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Consulta de grade de eventos </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="true" data-filter-placeholder="Digite aqui seu filtro..." data-split-icon="delete" data-autodividers="true">

					<?php
					if ($lista_grade_evento) {
						while ($row = mysql_fetch_array($lista_grade_evento)) {
							echo '<li data-theme="c">';
							echo '<a href="administrador_evento_grade_editar.php?codigo=' . $row['id_grade_evento'] . '" data-transition="slide">';
							echo '<h3>' . $row['evento'] . '</h3>';
							echo '<p>Curso: ' . $row['curso'] . '</p>';
							echo '<p>Código: ' . $row['id_grade_evento'] . '</p>';
							echo '<p>Mínimo de horas:' . $row['minimo_horas'] . ' Máximo de horas:' . $row['maximo_horas'] . '</p>';
							echo '<p>Validade (início):' . date_format(date_create($row['validade_inicio']), 'd/m/Y') . ' Validade (término):' . date_format(date_create($row['validade_termino']), 'd/m/Y') . '</p>';
							echo '<p>Total de horas: ' . $row['total_horas'] . '</p>';
							echo '<a href="evento_grade_excluir.php?codigo=' . $row['id_grade_evento'] . '" data-transition="slide" onclick="return confirmaExclusao();" "></a>';
							echo '</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>
	</body>
</html>
