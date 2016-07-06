<?php

// Validar
if ($_POST['minimo_horas'] == ''){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Horas';	
	echo json_encode($return_arr);
	exit;
}

// Validar
if ($_POST['id_grade_curso'] == ''){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Grade de curso';	
	echo json_encode($return_arr);
	exit;
}

// Validar
if ($_POST['id_evento'] == ''){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Evento';	
	echo json_encode($return_arr);
	exit;
}

include ("classe_evento.php");
$tempEvento = new Evento();

//inicia a sessao
session_start();

$tempEvento -> id_usuario_lancamento = $_SESSION['id_pessoa'];
$tempEvento -> minimo_horas = $_POST['minimo_horas'];
$tempEvento -> id_grade_curso = $_POST['id_grade_curso'];

if (($tempEvento -> editarGradeEvento($_POST['codigo_grade_evento'], $_POST['id_evento'])) == false){
	$return_arr["check"] = 0;
	$return_arr["message"] = 'Falha ao editar grade de evento';	
	echo json_encode($return_arr);
	exit;
}

$return_arr["check"] = '1';	
echo json_encode($return_arr);
?>