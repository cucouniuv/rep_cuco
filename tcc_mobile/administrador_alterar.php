<?php
if ($_POST['nome'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Nome em branco';
	echo json_encode($return_arr);
	exit ;
}

if ($_POST['email'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*E-mail em branco';
	echo json_encode($return_arr);
	exit ;
}

if ($_POST['telefone'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Telefone em branco';
	echo json_encode($return_arr);
	exit ;
}

include ("classe_pessoa.php");
$tempPessoa = new Pessoa();
$tempPessoa -> nome = $_POST['nome'];
$tempPessoa -> email = $_POST['email'];
$tempPessoa -> telefone = $_POST['telefone'];

if (($tempPessoa -> editarPessoa($_POST['id_pessoa'])) == false) {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Falha ao editar pessoa';
	echo json_encode($return_arr);
	exit ;
}

$return_arr["check"] = 1;
echo json_encode($return_arr);
?>