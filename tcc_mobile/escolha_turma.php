<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

if (isset($_GET['hash'])){
	$_SESSION['tipoacesso'] = $_GET['hash'];
}

$id_aluno = $_SESSION['id_pessoa'];

$query = " select t.id_turma, ";
$query .= "       t.nome as turma, ";
$query .= "       gc.validade_inicio,";
$query .= "       gc.validade_termino,";
$query .= "       gc.total_horas,";
$query .= "       c.nome as curso ";
$query .= " from turma t ";
$query .= " inner join aluno_turma at ";
$query .= "         on ( t.id_turma = at.id_turma )";
$query .= " inner join grade_curso gc";
$query .= "         on ( t.id_grade_curso = gc.id_grade_curso )";
$query .= " inner join curso c";
$query .= "         on ( gc.id_curso = c.id_curso )";
$query .= " where at.id_pessoa = $id_aluno";
$query .= " order by t.nome asc";

$lista_turma = mysql_query($query, $conn) or die(mysql_error());
?>

<!DOCTYPE html>
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
				<a data-role="button" href="login.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Escolha a turma </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="true" data-filter-placeholder="Digite seu filtro...">

					<?php
					if ($lista_turma) {
						while ($row = mysql_fetch_array($lista_turma)) {
							echo '<li data-theme="c">';
							echo '<a href="academico.php?codigo_turma=' . $row['id_turma'] . '" data-transition="slide">';
							echo '<h3>' . $row['turma'] . '</h3>';
							echo '<p>Curso: ' . $row['curso'] . '</p>';
							$validade_inicio = date_format(date_create($row['validade_inicio']), 'd/m/Y');
							$validade_termino = date_format(date_create($row['validade_termino']), 'd/m/Y');							
							echo '<p>Validade (início):' . $validade_inicio . '</p>';
							echo '<p>Validade (término):' . $validade_termino . '</p>';
							echo '<p>Total de horas exigidas: ' . $row['total_horas'] . '</p>';							
							echo '</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>

	</body>
</html>
