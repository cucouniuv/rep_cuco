<!DOCTYPE html>
<?php

include ('controle_sessao.php');
include '../tcc_mobile/config.php';

$query = "	select t.*, ";
$query .= "        gc.total_horas,";
$query .= "        gc.validade_inicio,";
$query .= "        gc.validade_termino,";
$query .= "        c.nome as nome_curso ";
$query .= " from turma as t";
$query .= " inner join grade_curso as gc";
$query .= "         on (t.id_grade_curso = gc.id_grade_curso)";
$query .= " inner join curso as c";
$query .= "         on (gc.id_curso = c.id_curso)";
$query .= " order by t.nome";

$lista_turma = mysql_query($query, $conn) or die(mysql_error());
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
				<a data-role="button" href="administrador_turma.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Orientador - Turma </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="true" data-autodividers="true" data-filter-placeholder="Digite seu filtro aqui...">
					<?php
					if ($lista_turma) {
						while ($row = mysql_fetch_array($lista_turma)) {
							//var_dump($row);
							echo '<li data-theme="c">';
							echo '<a href="administrador_turma_vincular_orientador_escolha.php?codigo_turma=' . $row['id_turma'] . '"data-transition="slide">';
							echo '<h3>' . $row['nome'] . '</h3>';
							echo '<p>Código: ' . $row['id_turma'] . '</p>';
							echo '<p>Período de validade da turma: ' . date_format(date_create($row['data_inicio']), 'd/m/Y') . ' até ' . date_format(date_create($row['data_termino']), 'd/m/Y') . '</p>';
							echo '<p>Curso: ' . $row['nome_curso'] . '</p>';
							echo '<p>Período de validade do curso: ' . date_format(date_create($row['validade_inicio']), 'd/m/Y') . ' até ' . date_format(date_create($row['validade_termino']), 'd/m/Y') . '</p>';
							echo '</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>
	</body>
</html>