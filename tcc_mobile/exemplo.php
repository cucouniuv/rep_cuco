<?php

include_once('class/tcpdf/tcpdf.php');

include_once("class/PHPJasperXML.inc.php");

include_once ('setting.php');

$xml = simplexml_load_file("relatorio/rptTurma.jrxml"); //informe onde está seu arquivo jrxml

$PHPJasperXML = new PHPJasperXML();

$PHPJasperXML->debugsql=false;

//$descricao=$_GET["descricao"]; //recebendo o parâmetro descrição

//$PHPJasperXML->arrayParameter=array("descricao"=>$descricao); //passa o parâmetro cadastrado no iReport

$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->connect($server,$user,$pass,$db);

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

$PHPJasperXML->outpage("I");

?> 