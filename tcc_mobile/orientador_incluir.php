<?php
$return_arr["check"] = 1;
$return_arr["message"] = '';

// Validar

if ($_POST['cpf'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*CPF em branco';
	echo json_encode($return_arr);
	exit ;
}

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

if ($_POST['senha'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Senha em branco';
	echo json_encode($return_arr);
	exit ;
}

if ($_POST['conf_senha'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Senha de confirmação em branco';
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

if ($_POST['senha'] !== $_POST['conf_senha']) {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Senhas não conferem';
	echo json_encode($return_arr);
	exit ;
}

include ("classe_pessoa.php");
$tempPessoa = new Pessoa();
$tempPessoa -> tipo = 'p';
$tempPessoa -> nome = $_POST['nome'];
$tempPessoa -> cpf = $_POST['cpf'];
$tempPessoa -> email = $_POST['email'];
$tempPessoa -> senha = $_POST['senha'];
$tempPessoa -> telefone = $_POST['telefone'];

// valida cpf
if (($tempPessoa -> validaCpf()) == false) {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*CPF incorreto';
	echo json_encode($return_arr);
	exit ;
}

$idpessoa = $tempPessoa -> retornaIdPessoa();
// Nao existe o cpf cadastrado, entao cadastra

if ($idpessoa == -1) {
	if (($tempPessoa -> incluirPessoa()) == false) {
		$return_arr["check"] = 0;
		$return_arr["message"] = '*Não foi possível incluir a pessoa';
		echo json_encode($return_arr);
		exit ;
	}
} else {
	// O retorno é booleano, onde se pesquisar por p e encontrar retorna true
	$tipo = $tempPessoa -> retornaTipoPessoa();

	// Se ainda não é professor, faz update
	if ($tipo == false) {
		if ($tempPessoa -> alteraTipoPessoa() == false) {
			$return_arr["check"] = 0;
			$return_arr["message"] = '*Não foi possível alterar o tipo da pessoa';
			echo json_encode($return_arr);
			exit ;
		}
	}
}
echo json_encode($return_arr);
?>