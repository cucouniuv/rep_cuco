<?php

// Validar
if ($_POST['descricao'] == ''){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Descrição em branco';	
	echo json_encode($return_arr);
	exit;
}

include ("classe_evento.php");
$tempEvento = new Evento();

//inicia a sessao
session_start();

$tempEvento -> id_usuario_lancamento = $_SESSION['id_pessoa'];
$tempEvento -> descricao = $_POST['descricao'];

if (($tempEvento -> VerificaDuplicidadeEvento()) == true){
	$return_arr["check"] = 0;
	$return_arr["message"] = 'Evento duplicado';	
	echo json_encode($return_arr);
	exit;
}

if (($tempEvento -> incluirEvento()) == false){
	$return_arr["check"] = 0;
	$return_arr["message"] = 'Falha ao incluir evento';	
	echo json_encode($return_arr);
	exit;
}

$return_arr["check"] = 1;
echo json_encode($return_arr);
?>