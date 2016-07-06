<?php
$return_arr["check"] = 1;
$return_arr["message"] = '';

// Verifica turmas
if (isset($_POST['codigo_turma'])) {
	$codigo_turma = $_POST['codigo_turma'];
	
	for ($i = 0; $i < count($codigo_turma); $i++) {
		if (empty($turma_aluno)) {
			$turma_aluno = $turma_aluno . $codigo_turma[$i];
		} else {
			$turma_aluno = $turma_aluno . ',' . $codigo_turma[$i];
		}
	}
} else {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Escolha a(s) turma(s)';
	echo json_encode($return_arr);
	exit ;
}

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

//Verificar tamanho do campo

if ($_POST['senha'] !== $_POST['conf_senha']) {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Senhas não conferem';
	echo json_encode($return_arr);
	exit ;
}

include ("classe_pessoa.php");
$tempPessoa = new Pessoa();
$tempPessoa -> tipo = 'l'; // Aluno
$tempPessoa -> nome = $_POST['nome'];
$tempPessoa -> cpf = $_POST['cpf'];
$tempPessoa -> numero_matricula_aluno = $_POST['num_matricula'];
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

if (($tempPessoa -> verificaDuplicidade()) == true){
	$return_arr["check"] = 0;
	$return_arr["message"] = '*CPF já existente';
	echo json_encode($return_arr);
	exit ;
}

if (($tempPessoa -> incluirPessoa()) == false) {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Falha ao incluir pessoa';
	echo json_encode($return_arr);
	exit ;
}

// Vincular pessoa a turma
include ("classe_turma.php");
$tempTurma = new Turma();
$lista_turma = explode(',', $turma_aluno);
				
foreach ($lista_turma as $key => $value) {
	if ($value > 0) {
		// Retorna ID da pessoa
		$id_pessoa = $tempPessoa -> retornaIdPessoa();

		if ($id_pessoa > 0) {			
			if (($tempTurma -> vincularAlunoTurma($value, $id_pessoa)) == false) {
				$return_arr["check"] = 0;
				$return_arr["message"] = '*Falha ao vincular pessoa na(s) turma(s)';
				echo json_encode($return_arr);
				exit ;
			}
		} else {
			$return_arr["check"] = 0;
			$return_arr["message"] = '*Falha ao buscar código da pessoa';
			echo json_encode($return_arr);
			exit ;
		}
	}
}
echo json_encode($return_arr);
?>