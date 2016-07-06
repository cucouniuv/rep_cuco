<?php
$return_arr["check"] = 1;
$return_arr["message"] = '';

// Validar
if ($_POST['nome'] == ''){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Nome em branco';	
	echo json_encode($return_arr);
	exit;
}

include ("classe_curso.php");
$tempCurso = new curso();
$tempCurso -> nome = $_POST['nome'];

if (($tempCurso -> VerificaDuplicidadeCursoEdicao($_POST['id_curso'])) == true){
	$return_arr["check"] = 0;
	$return_arr["message"] = 'Curso duplicado';	
	echo json_encode($return_arr);
	exit;
}

if (($tempCurso -> editarCurso($_POST['id_curso'])) == false){
	$return_arr["check"] = 0;
	$return_arr["message"] = 'Falha ao editar curso';	
	echo json_encode($return_arr);
	exit;
}

echo json_encode($return_arr);
?>