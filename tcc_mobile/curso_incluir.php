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
$retorno = $tempCurso -> VerificaDuplicidadeCurso();

if ($retorno == true){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Nome duplicado';	
	echo json_encode($return_arr);
	exit;
}

$tempCurso -> incluirCurso();

echo json_encode($return_arr);
?>