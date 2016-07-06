<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

session_start();

// Verifica se existe valor no get
if (count($_GET) > 0) {
	if (array_key_exists('codigo_turma', $_GET)) {
		$_SESSION['codigo_turma'] = $_GET['codigo_turma'];
	}
}

if (count($_GET) > 0) {
	if (array_key_exists('status', $_GET)) {
		$_SESSION['status'] = $_GET['status'];
	}
}

$codigo_turma = $_SESSION['codigo_turma'];
$status = $_SESSION['status'];

// Querys

$query = "	select l.*, ";
$query .= "        (case l.status when 'N' then 'Aguardando avaliação' ";
$query .= "                       when 'D' then 'Aguardando documentação a ser arquivada' ";
$query .= "                       when 'A' then 'Aprovado' ";
$query .= "                       when 'R' then 'Rejeitado' ";
$query .= "         end) as situacao,";
$query .= "        t.nome as turma,";
$query .= "        e.descricao as evento,";
$query .= "        p.nome as pessoa";
$query .= " from lancamento as l";
$query .= " inner join grade_evento as ge";
$query .= "         on (l.id_grade_evento = ge.id_grade_evento)";
$query .= " inner join evento as e";
$query .= "         on (ge.id_evento = e.id_evento)";
$query .= " inner join turma as t";
$query .= "         on (l.id_turma = t.id_turma)";
$query .= " inner join pessoa as p";
$query .= "         on (l.id_pessoa = p.id_pessoa)";
$query .= " where (t.id_turma = $codigo_turma)";
$query .= "       and (l.status = '$status')";
$query .= " order by l.id_lancamento desc";

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
				<a data-role="button" href="orientador_atividade_situacao.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Atividades cadastradas </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="true" data-filter-reveal="false" data-filter-placeholder="Digite aqui seu filtro...">

					<?php
					if ($lista_turma) {
						while ($row = mysql_fetch_array($lista_turma)) {
							//var_dump($row);
							if ($row['status'] == 'A') {
								echo '<li data-theme="b">';
							} elseif ($row['status'] == 'R') {
								echo '<li data-theme="a">';
							} elseif ($row['status'] == 'D') {
								echo '<li data-theme="e">';
							} else {
								echo '<li data-theme="c">';
							}
							echo '<a href="orientador_atividade_visualizar.php?codigo_lancamento=' . $row['id_lancamento'] . '" data-transition="slide">';
							echo '<h3>' . $row['pessoa'] . '</h3>';
							echo '<p>Situação: ' . $row['situacao'] . '</p>';
							echo '<p>Código: ' . $row['id_lancamento'] . '</p>';
							echo '<p>Evento: ' . $row['evento'] . '</p>';
							echo '<p>Data de lançamento: ' . date_format(date_create($row['data_lancamento']), 'd/m/Y H:i:s') . '</p>';
							echo '<p>Quantidade de horas: ' . $row['total_horas'] . '</p>';
							echo '</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>
	</body>
</html>
