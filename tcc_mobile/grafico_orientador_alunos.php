<?php
//Criado dia 20/08/13
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

$codigo_turma = $_POST['codigo_turma'];

$query = "  select sum(l.total_horas) as total_horas,";
$query .= "        p.nome as pessoa,";
$query .= "        gc.total_horas as horas_curso";
$query .= " from lancamento as l";
$query .= " inner join pessoa as p";
$query .= "         on ( l.id_pessoa = p.id_pessoa )";
$query .= " inner join turma as t";
$query .= "         on ( l.id_turma = t.id_turma )";
$query .= " inner join grade_curso as gc";
$query .= "         on ( t.id_grade_curso = gc.id_grade_curso )";
$query .= " where  (upper(status) = 'A')";
$query .= "        and (l.id_turma = $codigo_turma) ";
$query .= " group by p.nome";
$query .= " order by p.nome asc";
$lista_pessoa = mysql_query($query, $conn) or die(mysql_error());

while ($row = mysql_fetch_array($lista_pessoa)) {	
	$matriz_pessoa[$i++] = $row['pessoa'];
	$matriz_hora[$j++] = $row['total_horas'];
	$horascurso = $row['horas_curso'];
}

$array_pessoa = implode('|', $matriz_pessoa);
//echo $array_pessoa;
$array_hora = implode('|', $matriz_hora);
//echo $array_hora;
//echo $horascurso;
?>
<html>
	<head>
		<?php
		include ('cabecalho.php');
		?>
		<meta name="viewport" content="width=device-width, minimum-scale=1 maximum-scale=1" />
		<link rel="shortcut icon" href="imagem/favicon.ico" type="image/x-icon" />

	</head>
	<body>
		<div data-role="page" id="page1">
			<div data-theme="b" data-role="header">
				<a data-role="button" href="orientador_grafico_horas_academico.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3>Horas aprovadas dos acadêmicos</h3>
			</div>
			<div data-role="content">
				<div id="chartContainer" style="height: 400px; width: 100%;"></div>
			</div>

<script type="text/javascript">
window.onload = function() {
						
var i, string_pessoa, string_hora, array_pessoa, array_hora, horas_curso;

string_pessoa = "<?php echo $array_pessoa;?>";
array_pessoa = string_pessoa.split("|");

string_hora = "<?php echo $array_hora;?>";
array_hora = string_hora.split("|");

horas_curso = "<?php echo $horascurso;?>";

function matriz_grupos(x,y,label){ 
	this.x=x; 
	this.y=y;
	this.label=label;
}

	var grupos = new Array();
	var grupos2 = new Array();

	i = 0;
	
	for (i in array_pessoa){
		x = Number(i);
		y = Number(array_hora[i]);
		label = array_pessoa[i];
		grupos[i] = new matriz_grupos(x,y,label);
	}
	
	i = 0;
	
	for (i in array_pessoa){
		x = Number(i);
		y = Number(horas_curso);
		label = array_pessoa[i];
		grupos2[i] = new matriz_grupos(x,y,label);
	}	
							
var chart = new CanvasJS.Chart("chartContainer", {
	title : {
		text : "Horas aprovadas dos acadêmicos"
	},
	
    toolTip: {
      shared: true
    },
      
    axisY: {
      title: "Horas"
    },    
	  
	data : [
	    {
		type : "stackedBar100",
		showInLegend : true,
		name : "Horas aprovadas",
		dataPoints : grupos
		},
		{
		type : "stackedBar100",
		showInLegend : true,
		name : "Horas exigidas",		
		dataPoints : grupos2
		}
		]
	});

	chart.render();
}
</script>
				<script type="text/javascript" src="canvasjs-1.3.0-beta/canvasjs.min.js"></script>
		</div>
	</body>
</html>

