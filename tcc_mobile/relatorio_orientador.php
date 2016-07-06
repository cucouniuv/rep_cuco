<?php
include_once('class/tcpdf/tcpdf.php');
include_once("class/PHPJasperXML.inc.php");
include_once ('setting.php');

$par_codigo_inicio = $_POST["codigo_inicio"];
$par_codigo_termino = $_POST["codigo_termino"];
$par_codigo_turma = $_POST["codigo_turma"];

$xml = simplexml_load_file("relatorio/relacao_orientador.jrxml"); //informe onde está seu arquivo jrxml
$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->debugsql=false;
$PHPJasperXML->arrayParameter=array("par_codigo_inicio"=>$par_codigo_inicio,"par_codigo_termino"=>$par_codigo_termino,"par_codigo_turma"=>$par_codigo_turma); //passa o parâmetro cadastrado no iReport
$PHPJasperXML->xml_dismantle($xml);
$PHPJasperXML->connect($server,$user,$pass,$db);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");
?> 