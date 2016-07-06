<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

//Apagar codigo da turma
unset($_SESSION['codigo_turma']);

$codigo_pessoa = $_SESSION['id_pessoa'];

$query = " select count(l.id_lancamento) as aguardando,";
$query .= "       t.nome as turma,";
$query .= "       t.id_turma";
$query .= " from professor_turma as pt";
$query .= " inner join turma as t";
$query .= "         on (t.id_turma = pt.id_turma)";
$query .= " inner join lancamento as l";
$query .= "         on (l.id_turma = t.id_turma)";
$query .= " where (upper(l.status) = 'N')";
$query .= "       and pt.id_pessoa = $codigo_pessoa";
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
				<a data-role="button" href="orientador.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Suas turmas </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="true" data-filter-placeholder="Digite aqui seu filtro...">

					<?php
					if ($lista_turma) {
						while ($row = mysql_fetch_array($lista_turma)) {
							echo '<li data-theme="c">';
							echo '<a href="orientador_atividade_situacao.php?codigo_turma=' . $row['id_turma'] . '" data-transition="slide">';
							echo '<h3>' . $row['turma'] . '</h3>';
							echo '<span class="ui-li-count">' . $row['aguardando'] . ' aguardando</span>';
							echo '</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>
	</body>
</html>
