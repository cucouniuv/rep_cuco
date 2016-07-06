<!DOCTYPE html>
<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

$query = " select gc.id_grade_curso, ";
$query .= "         gc.id_curso,";
$query .= "         gc.validade_inicio,";
$query .= "         gc.validade_termino,";
$query .= "         gc.total_horas,";
$query .= "         c.nome as curso";
$query .= " from grade_curso as gc ";
$query .= " inner join curso as c ";
$query .= "         on (gc.id_curso = c.id_curso)";
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
				<a data-role="button" href="administrador_curso.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Consulta de grade de cursos </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="true" data-filter-placeholder="Digite seu filtro aqui..." data-split-icon="delete" data-autodividers="true">

					<?php
					if ($lista_grade_curso) {
						while ($row = mysql_fetch_array($lista_grade_curso)) {
							echo '<li data-theme="c">';
							echo '<a href="administrador_curso_grade_editar.php?codigo=' . $row['id_grade_curso'] . '" data-transition="slide">';
							echo '<h3>' . $row['curso'] . '</h3>';
							echo '<p>Código: ' . $row['id_grade_curso'] . '</p>';
							$validade_inicio = date_format(date_create($row['validade_inicio']), 'd/m/Y');
							$validade_termino = date_format(date_create($row['validade_termino']), 'd/m/Y');
							echo '<p>Validade (início):' . $validade_inicio . '</p>';
							echo '<p>Validade (término):' . $validade_termino . '</p>';
							echo '<p>Total de horas: ' . $row['total_horas'] . '</p>';
							echo '<a href="curso_grade_excluir.php?codigo=' . $row['id_grade_curso'] . '" data-transition="slide" onclick="return confirmaExclusao();" "></a>';
							echo '</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>
	</body>
</html>
