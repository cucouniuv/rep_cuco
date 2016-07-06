<?php
// Define valor padrao
$valida["check"] = 2;
$valida["message"] = '';
$valida["location"] = 'login.php';

include '../tcc_mobile/config.php';

// Expira a sessão em 10 minutos de inatividade
session_cache_expire(10);
session_start();

// CPF e Senha
$login_cpf = addslashes($_POST['login_cpf']);
$login_password = addslashes($_POST['login_password']);

if ((empty($login_cpf)) or (empty($login_password))) {
	$valida["check"] = 0;
	$valida["message"] = '*CPF/Senha em branco';
	echo json_encode($valida);
	exit;
}

include ("classe_pessoa.php");
$tempPessoa = new Pessoa();
$tempPessoa -> cpf = $login_cpf;
if (($tempPessoa -> validaCpf()) == false){
	$valida["check"] = 0;
	$valida["message"] = '*CPF incorreto';
	echo json_encode($valida);
	exit;	
}

// Verifica se há algum CPF cadastrado, senão abre a tela de cadastro de novo usuario
$query = "  select cpf";
$query .= " from pessoa";
$query .= " where  cpf = '$login_cpf'";
$retorno = mysql_query($query, $conn) or die(mysql_error());
$resposta = mysql_fetch_assoc($retorno);

if (empty($resposta)) {
	$_SESSION['pass'] = $login_password;
	$valida["check"] = 2;
	$valida["location"] = 'novo.php?cpf=' . $login_cpf;
	echo json_encode($valida);	
	exit;
}


// CPF existente, valida se é academico, orientador ou administrador
$query = "  select id_pessoa, ";
$query .= "        tipo,";
$query .= "        nome ";
$query .= " from pessoa ";
$query .= " where  cpf = '$login_cpf' ";
$query .= "        and senha = md5('$login_password')";

$retorno = mysql_query($query, $conn) or die(mysql_error());
$resposta = mysql_fetch_assoc($retorno);

// Se estiver vazio, CPF e senhas não batem
if (empty($resposta)) {
	$valida["check"] = 0;
	$valida["message"] = '*CPF/Senha inválido';
	$valida["location"] = 'login.php';
	echo json_encode($valida);	
	exit;
}

// Repassa ID pessoa e nome para a sessão
$_SESSION['id_pessoa'] = $resposta['id_pessoa'];
$_SESSION['nome'] = $resposta['nome'];

// Verifica se possui as letras no campo e se tiver altera as variáveis booleanas
$academico = preg_match('/[l]/', $resposta['tipo']);
$administrador = preg_match('/[a]/', $resposta['tipo']);
$professor = preg_match('/[p]/', $resposta['tipo']);

if (($academico) and isset($academico) and !($administrador) and !($professor)) {
	//Verifica se o acadêmico possui mais turmas
	//Mysql_num_rows resulta as linhas de select e show
	//affected rows utilizado para update insert, deleted
	$query = "  select t.id_turma ";
	$query .= " from turma t ";
	$query .= " inner join aluno_turma at ";
	$query .= "         on ( t.id_turma = at.id_turma )";
	$query .= " where at.id_pessoa = " . $_SESSION['id_pessoa'];	
	$lista_turma = mysql_query($query, $conn) or die(mysql_error());
	if (mysql_num_rows($lista_turma) > 1) {
		$valida["check"] = 2;
		$valida["location"] = 'escolha_turma.php';
		echo json_encode($valida);	
		exit;
	} else {
		$row = mysql_fetch_assoc($lista_turma);
		$_SESSION['codigo_turma'] = $row['id_turma'];
		$valida["check"] = 2;
		$valida["location"] = 'academico.php';
		echo json_encode($valida);	
		exit;
	}
}

if (($professor) and isset($professor) and !($administrador) and !($academico)) {
	$valida["check"] = 2;
	$valida["location"] = 'orientador.php';
	echo json_encode($valida);	
	exit;
}

if (($administrador) and isset($administrador) and !($academico) and !($professor)) {
	$valida["check"] = 2;
	$valida["location"] = 'administrador.php';
	echo json_encode($valida);	
	exit;
}

$valida["check"] = 2;
$valida["location"] = 'escolha.php';
echo json_encode($valida);	
?>