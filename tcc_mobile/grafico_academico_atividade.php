<?php
//Criado dia 20/08/13
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

session_start();

//Escolheu a turma e grava na sessao para usar nas outras telas
if ($_GET['id_turma'] > 0) {
	$_SESSION['codigo_turma'] = $_GET['id_turma'];
}

$codigo_turma = $_SESSION['codigo_turma'];
$codigo_pessoa = $_SESSION['id_pessoa'];

$query = "  select gc.total_horas";
$query .= " from grade_curso as gc";
$query .= " inner join curso as c";
$query .= "         on ( gc.id_curso = c.id_curso )";
$query .= " inner join turma as t";
$query .= "         on ( gc.id_grade_curso = t.id_grade_curso )";
$query .= " where (t.id_turma = $codigo_turma )";

$lista_info = mysql_query($query, $conn) or die(mysql_error());
$row_turma = mysql_fetch_array($lista_info);

$query = "  select sum(l.total_horas) as total_horas";
$query .= " from lancamento as l";
$query .= " where  (upper(status) = 'A')";
$query .= "        and (l.id_pessoa = $codigo_pessoa) ";
$query .= "        and (l.id_turma = $codigo_turma) ";

$lista_info_aluno = mysql_query($query, $conn) or die(mysql_error());
$row_aluno = mysql_fetch_array($lista_info_aluno);
?>
<html>
	<head>
		<?php
		include ('cabecalho.php');
		?>
<!--
		<script type="text/javascript" src="Chart.js.legend-master/vendor/Chart.js"></script>
		<script type="text/javascript" src="Chart.js.legend-master/src/legend.js"></script>
-->		
		<meta name="viewport" content="width=device-width, minimum-scale=1 maximum-scale=1" />
		<link rel="shortcut icon" href="imagem/favicon.ico" type="image/x-icon" />

	</head>
	<body>
		<div data-role="page" id="page1">
			<div data-theme="b" data-role="header">
				<a data-role="button" href="academico_atividade_informacao.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3>Comparativo entre horas restantes e realizadas</h3>
			</div>
			<div data-role="content">
				<div id="chartContainer" style="height: 400px; width: 100%;"></div>
			</div>
<!--			
<script type="text/javascript">

var exigidas = new Number("<?php echo $row_turma['total_horas']; ?>");
var realizadas = new Number("<?php echo $row_aluno['total_horas']; ?>");
var restantes = new Number(exigidas - realizadas);

var pizzaDados = [
	{
		value : Number(realizadas),
		color : "#84AF42",
		title: 'Realizadas'
	}, 
	{
		value : Number(restantes),
		color : "#C72323",
		title: 'Restantes'
	}
];

var minhaPizza = document.getElementById("grafico").getContext("2d");
new Chart(minhaPizza).Pie(pizzaDados);

legend(document.getElementById("legenda"), pizzaDados);
</script>
-->

<script type="text/javascript">
					window.onload = function() {
						
var exigidas = new Number("<?php echo $row_turma['total_horas']; ?>");
var realizadas = new Number("<?php echo $row_aluno['total_horas']; ?>");
var restantes = new Number(exigidas - realizadas);
						
						var chart = new CanvasJS.Chart("chartContainer", {
							title : {
								text : "Comparativo entre horas restantes e realizadas"
							},
							data : [{
								type : "pie",
								showInLegend : true,
								dataPoints : [{
									y : Number(realizadas),
									legendText : "Realizadas",
									indexLabel : "Realizadas"
								}, {
									y : Number(restantes),
									legendText : "Restantes",
									indexLabel : "Restantes"
								}]
							}]
						});

						chart.render();
					}
				</script>
				<script type="text/javascript" src="canvasjs-1.3.0-beta/canvasjs.min.js"></script>
		</div>
	</body>
</html>

