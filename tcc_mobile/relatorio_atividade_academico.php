<?php
include_once('class/tcpdf/tcpdf.php');
include_once("class/PHPJasperXML.inc.php");
include_once ('setting.php');

$par_id_turma = $_POST["codigo_turma"];

$xml = simplexml_load_file("relatorio/orientador_academico_atividade.jrxml"); //informe onde está seu arquivo jrxml
$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->debugsql=false;
$PHPJasperXML->arrayParameter=array("par_id_turma"=>$par_id_turma); //passa o parâmetro cadastrado no iReport
$PHPJasperXML->xml_dismantle($xml);
$PHPJasperXML->connect($server,$user,$pass,$db);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");
?> 