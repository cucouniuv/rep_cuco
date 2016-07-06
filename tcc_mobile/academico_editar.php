<?php
$return_arr["check"] = 1;
$return_arr["message"] = '';

// Validar

//if ($_POST['cpf'] == '') {
//	$return_arr["check"] = 0;
//	$return_arr["message"] = '*CPF em branco';
//	echo json_encode($return_arr);
//	exit ;
//}

if ($_POST['nome'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Nome em branco';
	echo json_encode($return_arr);
	exit ;
}

if ($_POST['num_matricula'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Número de matrícula';
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
$tempPessoa -> numero_matricula_aluno = $_POST['num_matricula'];
$tempPessoa -> email = $_POST['email'];
$tempPessoa -> telefone = $_POST['telefone'];

// valida cpf
//if (($tempPessoa -> validaCpf()) == false) {
//	$return_arr["check"] = 0;
//	$return_arr["message"] = '*CPF incorreto';
//	echo json_encode($return_arr);
//	exit ;
//}

//$idpessoa = $tempPessoa -> retornaIdPessoa();
$idpessoa = $_POST['codigo_pessoa'];
// Nao existe o cpf cadastrado, entao cadastra
if (($tempPessoa -> editarPessoa($idpessoa)) == false){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Não foi realizada a alteração';
	echo json_encode($return_arr);
	exit ;	
};

echo json_encode($return_arr);
?>