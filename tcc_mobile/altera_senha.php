<?php
$return_arr["check"] = 1;
$return_arr["message"] = '';

if ($_POST['senha'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = 'Preencha a senha';
	echo json_encode($return_arr);
	exit ;
}
if ($_POST['senha_confirmacao'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = 'Preencha a senha de confirmação';
	echo json_encode($return_arr);
	exit ;
}
// Valida se as senhas sao iguais
if ($_POST['senha'] !== $_POST['senha_confirmacao']) {
	$return_arr["check"] = 0;
	$return_arr["message"] = 'As senhas não são iguais';
	echo json_encode($return_arr);
	exit ;
}

include 'classe_pessoa.php';
$tempPessoa = new pessoa();
$tempPessoa -> senha = $_POST['senha'];
$idpessoa = $_POST['idpessoa'];
if (($tempPessoa -> alteraSenha($idpessoa)) == false) {
	$return_arr["check"] = 0;
	$return_arr["message"] = 'Problema ao alterar senha';
	echo json_encode($return_arr);
	exit ;
}
echo json_encode($return_arr);
?>