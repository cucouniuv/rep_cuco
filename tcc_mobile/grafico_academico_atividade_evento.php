<?php
//Criado dia 20/08/13
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

session_start();

$codigo_turma = $_SESSION['codigo_turma'];
$codigo_pessoa = $_SESSION['id_pessoa'];

// Total de horas aprovadas agrupados por evento
$query = "  select sum(l.total_horas) as total_horas,";
$query .= "        e.descricao as evento,";
$query .= "        ge.minimo_horas";
$query .= " from lancamento as l";
$query .= " inner join grade_evento as ge";
$query .= "         on (l.id_grade_evento = ge.id_grade_evento)";
$query .= " inner join evento as e";
$query .= "         on (ge.id_evento = e.id_evento)";
$query .= " where (upper(status) = 'A') ";
$query .= "        and (l.id_pessoa = $codigo_pessoa) ";
$query .= " group by e.descricao";
$lista_info_evento = mysql_query($query, $conn) or die(mysql_error());


while ($row = mysql_fetch_array($lista_info_evento)) {	
	$matriz_evento[$i++] = $row['evento'];
	$matriz_hora[$j++] = $row['total_horas'];
	$matriz_minimo[$k++] = $row['minimo_horas'];
}

$array_evento = implode('|', $matriz_evento);
echo $array_evento;

$array_hora = implode('|', $matriz_hora);
echo $array_hora;

$array_minimo = implode('|', $matriz_minimo);
echo $array_minimo;
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
				<a data-role="button" href="academico_atividade_informacao.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3>Quantia de horas realizadas agrupadas por evento</h3>
			</div>
			<div data-role="content">
				<div id="chartContainer" style="height: 400px; width: 100%;"></div>

				<script type="text/javascript">
					window.onload = function() {
						
var i, string_evento, string_hora, string_minimo, array_evento, array_hora, array_minimo;

string_evento = "<?php echo $array_evento;?>";
array_evento = string_evento.split("|");

string_hora = "<?php echo $array_hora;?>";
array_hora = string_hora.split("|");

string_minimo = "<?php echo $array_minimo;?>";
array_minimo = string_minimo.split("|");
	
function matriz_grupos(x,y,label){ 
	this.x=x; 
	this.y=y;
	this.label=label;
}

	var grupos = new Array();
	var grupos2 = new Array();
		
	i = 0;
	
	for (i in array_evento){
		x = Number(i);
		y = Number(array_hora[i]);
		//alert(array_hora[i]);
		label = array_evento[i];
		grupos[i] = new matriz_grupos(x,y,label);
	}
	
	i = 0;
	
	for (i in array_evento){
		x = Number(i);
		y = Number(array_minimo[i]);
		label = array_evento[i];
		grupos2[i] = new matriz_grupos(x,y,label);
	}	

	console.log(grupos);
	
var chart = new CanvasJS.Chart("chartContainer",
    {
      theme: "theme1",
      title:{
        text: "Quantia de horas realizadas agrupadas por evento"
      },
      
      toolTip: {
	    shared: true
	  },
      
      axisX: {
	    title: "Eventos"
	  },
	        
      axisY: {
	    title: "Quantia de horas"
	  },
			
      data: [

      {
      	type: "column",	
		name: "Horas cadastradas",
		legendText: "Horas cadastradas",
		showInLegend: true,
        dataPoints: grupos
      },
      {
      	type: "column",	
		name: "Quantia de horas aceita",
		legendText: "Quantia de horas aceita",
		showInLegend: true,      	
        dataPoints: grupos2
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

