<?php
$return_arr["check"] = 1;
$return_arr["message"] = '';

// Validar
if ($_POST['validade_inicio'] == ''){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Validade (início) em branco';	
	echo json_encode($return_arr);
	exit;
}

if ($_POST['validade_inicio'] == ''){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Validade (término) em branco';
	echo json_encode($return_arr);
	exit;		
}

if ($_POST['total_horas'] == ''){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Total de horas em branco';
	echo json_encode($return_arr);
	exit;		
}

$data_inicio = new DateTime($_POST['validade_inicio']);
$data_termino = new DateTime($_POST['validade_termino']);

if ($data_inicio > $data_termino) {
	$return_arr["check"] = 0;
	$return_arr["message"] = 'Validade inicial superior a de término';
	echo json_encode($return_arr);
	exit;
}

include ("classe_curso.php");

$tempCurso = new curso();

$tempCurso -> validade_inicio = $_POST['validade_inicio'];
$tempCurso -> validade_termino = $_POST['validade_termino'];
$tempCurso -> total_horas = $_POST['total_horas'];

if (($tempCurso -> editarGradeCurso($_POST['curso'], $_POST['codigo_grade_curso'])) == false){
	$return_arr["check"] = 0;
	$return_arr["message"] = 'Falha ao editar grade de curso';
	echo json_encode($return_arr);
	exit;
}

echo json_encode($return_arr);
?>