<?php

// Validar
if ($_POST['descricao'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Descrição em branco';
	echo json_encode($return_arr);
	exit ;
}

include ("classe_evento.php");
$tempEvento = new Evento();
$tempEvento -> descricao = $_POST['descricao'];

if (($tempEvento -> VerificaDuplicidadeEventoEdicao($_POST['id_evento'])) == true) {
	$return_arr["check"] = 0;
	$return_arr["message"] = 'Evento duplicado';
	echo json_encode($return_arr);
	exit ;
}

if (($tempEvento -> editarEvento($_POST['id_evento'])) == false) {
	$return_arr["check"] = 0;
	$return_arr["message"] = 'Falha ao editar evento';
	echo json_encode($return_arr);
	exit ;
}

$return_arr["check"] = 1;
echo json_encode($return_arr);
?>