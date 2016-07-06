<?php
include ('controle_sessao.php');

// Valida niveis de acesso
if (isset($_GET['hash'])){
	$_SESSION['tipoacesso'] = $_GET['hash'];
}
include ('config.php');

$codigo_turma = 0;
//Escolheu a turma e grava na sessao para usar nas outras telas
if ($_GET['codigo_turma'] > 0) {
	$_SESSION['codigo_turma'] = $_GET['codigo_turma'];
}

$codigo_turma = $_SESSION['codigo_turma'];

if ($codigo_turma <= 0){
	header('Location: login.php');
}

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
$query .= " where t.id_turma = $codigo_turma";

$turma = mysql_query($query, $conn) or die(mysql_error());
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
				
				<a data-role="button" href="academico_configuracao.php" data-icon="gear"
				data-iconpos="left" class="ui-btn-right"> Config. </a>
				<a data-role="button" data-theme="b" href="login.php" data-icon="back"
				data-iconpos="left" class="ui-btn-left"> Sair </a>
				<h2> Acadêmico </h2>
			</div>
			<div data-role="content">
				<div data-role="collapsible" data-theme="b" data-content-theme="b">
					<h3> Turma escolhida</h3>
					<?php
					if ($turma) {
						while ($row = mysql_fetch_array($turma)) {						
							echo '<p>Código: ' . $row['id_turma'] . ' Nome: ' . $row['nome'] . '</p>';
							echo '<p>Período de validade da turma: ' . date_format(date_create($row['data_inicio']), 'd/m/Y') . ' até ' . date_format(date_create($row['data_termino']), 'd/m/Y') . '</p>';
							echo '<p>Curso: ' . $row['nome_curso'] . '</p>';
							echo '<p>Período de validade do curso: ' . date_format(date_create($row['validade_inicio']), 'd/m/Y') . ' até ' . date_format(date_create($row['validade_termino']), 'd/m/Y') . '</p>';
						}
					}
					?>
				</div>
				<ul data-role="listview" data-divider-theme="b" data-inset="true">
					<li data-role="list-divider" role="heading">
						Atividades
					</li>
					<li data-theme="c">
						<a href="academico_atividade_cadastro.php" rel="external" data-transition="slide"> Cadastrar </a>
					</li>
					<li data-theme="c">
						<a href="academico_atividade_situacao.php" data-transition="slide"> Consultar </a>
					</li>
				</ul>
				<ul data-role="listview" data-divider-theme="b" data-inset="true">
					<li data-role="list-divider" role="heading">
						Horas
					</li>
					<li data-theme="c">
						<a href="academico_atividade_informacao.php" data-transition="slide"> Informações </a>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>
