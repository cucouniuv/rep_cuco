<?php
//include ('controle_sessao.php');

include_once('class/tcpdf/tcpdf.php');
include_once("class/PHPJasperXML.inc.php");
include_once ('setting.php');

$xml = simplexml_load_file("relatorio/academico_atividade.jrxml"); //informe onde está seu arquivo jrxml

$PHPJasperXML = new PHPJasperXML();

$PHPJasperXML->debugsql=False;

$id_pessoa = $_GET["id_pessoa"]; //recebendo o parâmetro descrição
$id_turma = $_GET["id_turma"]; //recebendo o parâmetro descrição

$PHPJasperXML->arrayParameter=array("par_id_pessoa"=>$id_pessoa,"par_id_turma"=>$id_turma); //passa o parâmetro cadastrado no iReport

$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->connect($server,$user,$pass,$db);

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

$PHPJasperXML->outpage("I");

?> 