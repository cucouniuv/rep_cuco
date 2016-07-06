<?php
$return_arr["check"] = 1;
$return_arr["message"] = '';

// Validar
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
//Verificar tamanho do campo

include ("classe_pessoa.php");
$tempPessoa = new Pessoa();
$tempPessoa -> nome = $_POST['nome'];
$tempPessoa -> email = $_POST['email'];
$tempPessoa -> telefone = $_POST['telefone'];

//$idpessoa = $tempPessoa -> retornaIdPessoa();
$idpessoa = $_POST['codigo_pessoa'];
// Nao existe o cpf cadastrado, entao cadastra
if (($tempPessoa -> editarPessoa($idpessoa)) == false){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Não foi realizada alteração';
	echo json_encode($return_arr);
	exit ;	
};

echo json_encode($return_arr);
?>