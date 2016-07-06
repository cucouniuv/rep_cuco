<?php
$return_arr["check"] = 1;
$return_arr["message"] = '';

// Validar
if ($_POST['codigo_evento'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Evento não informado';
	echo json_encode($return_arr);
	exit ;
}

if ($_POST['data_inicio'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Data de início';
	echo json_encode($return_arr);
	exit ;
}

if ($_POST['data_termino'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Data de término';
	echo json_encode($return_arr);
	exit ;
}

$data_inicio = new DateTime($_POST['data_inicio']);
$data_termino = new DateTime($_POST['data_termino']);
$data_atual = new DateTime(date(d/m/Y));

if ($data_inicio > $data_termino) {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Data inicial superior a de término';
	echo json_encode($return_arr);
	exit;
}

if ($data_inicio > $data_atual){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Data inicial superior a data atual';
	echo json_encode($return_arr);
	exit;
}

if ($data_termino > $data_atual){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Data de término superior a data atual';
	echo json_encode($return_arr);
	exit;
}

if ($_POST['total_horas'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Total de horas';
	echo json_encode($return_arr);
	exit ;
}

if ($_POST['id_lancamento'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Código do lançamento';
	echo json_encode($return_arr);
	exit ;
}


include ("classe_atividade.php");
$tempAtividade = new Atividade();
//inicia a sessao
session_start();

//Grava
$tempAtividade -> id_usuario_lancamento = $_SESSION['id_pessoa'];
$tempAtividade -> data_inicio = $_POST['data_inicio'];
$tempAtividade -> data_termino = $_POST['data_termino'];
$tempAtividade -> total_horas = $_POST['total_horas'];
$tempAtividade -> observacao = $_POST['observacao'];
$tempAtividade -> codigo_evento = $_POST['codigo_evento'];
$tempAtividade -> editarAtividade($_POST['id_lancamento']);

echo json_encode($return_arr);
?>