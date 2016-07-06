<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

//Escolheu a turma e grava na sessao para usar nas outras telas
if ($_GET['codigo_turma'] > 0) {
	$_SESSION['codigo_turma'] = $_GET['codigo_turma'];
}

$codigo_turma = $_SESSION['codigo_turma'];
$codigo_pessoa = $_SESSION['id_pessoa'];

// Querys

$query = "	select l.*, ";
$query .= "        (case l.status when 'N' then 'Aguardando avaliação' ";
$query .= "                       when 'D' then 'Aguardando documentação a ser arquivada' ";
$query .= "                       when 'A' then 'Aprovado' ";
$query .= "                       when 'R' then 'Rejeitado' ";
$query .= "         end) as situacao,";
$query .= "        t.nome as turma,";
$query .= "        e.descricao as evento";
$query .= " from lancamento as l";
$query .= " inner join grade_evento as ge";
$query .= "         on (l.id_grade_evento = ge.id_grade_evento)";
$query .= " inner join evento as e";
$query .= "         on (ge.id_evento = e.id_evento)";
$query .= " inner join turma as t";
$query .= "         on (l.id_turma = t.id_turma)";
$query .= " where (t.id_turma = $codigo_turma )";
$query .= "       and (l.id_pessoa = $codigo_pessoa)";

if (count($_GET) > 0) {
	if (array_key_exists('status', $_GET)) {
		$query .= "       and (l.status = '". $_GET['status'] ."')";
	}
}

$query .= " order by l.id_lancamento desc";

$lista_atividade = mysql_query($query, $conn) or die(mysql_error());
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
				<a data-role="button" href="academico_atividade_situacao.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Consulta de atividades </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="true" data-filter-placeholder="Digite seu filtro..." data-autodividers="false">

					<?php
					if ($lista_atividade) {
						while ($row = mysql_fetch_array($lista_atividade)) {
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
							echo '<a href="academico_atividade_editar.php?id_lancamento='. $row['id_lancamento'] .'" data-transition="slide">';
							echo '<h3>' . $row['situacao'] . '</h3>';
							echo '<p>Código: ' . $row['id_lancamento'] . '</p>';
							echo '<p>Evento: ' . $row['evento'] . '</p>';
							$data_lancamento = date_create($row['data_lancamento']);
							echo '<p>Data de lançamento: ' . date_format($data_lancamento, 'd/m/Y H:i:s') . '</p>';
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
