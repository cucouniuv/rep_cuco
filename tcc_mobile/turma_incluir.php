<?php
$validou['check'] = 1;

if ($_POST['nome'] == ''){
	$validou['check'] = 0;
	$validou['message'] = '*Preencha o nome';
	echo json_encode($validou);
	exit;
}

$data_inicio = new DateTime($_POST['data_inicio']);
$data_termino = new DateTime($_POST['data_termino']);
//$data_atual = new DateTime(date(d/m/Y));

if ($data_inicio > $data_termino) {
	$validou["check"] = 0;
	$validou["message"] = '*Data inicial superior a de término';
	echo json_encode($validou);
	exit;
}

/*
if ($data_inicio > $data_atual){
	$validou["check"] = 0;
	$validou["message"] = '*Data inicial superior a data atual';
	echo json_encode($validou);
	exit;
}

if ($data_termino > $data_atual){
	$validou["check"] = 0;
	$validou["message"] = '*Data de término superior a data atual';
	echo json_encode($validou);
	exit;
}

*/
include ("classe_turma.php");

$tempTurma = new turma();

//inicia a sessao
session_start();

$tempTurma -> id_usuario_lancamento = $_SESSION['id_pessoa'];
$tempTurma -> nome = $_POST['nome'];
$tempTurma -> data_inicio = $_POST['data_inicio'];
$tempTurma -> data_termino = $_POST['data_termino'];

if (($tempTurma -> VerificaDuplicidadeTurma()) == true){
	$validou["check"] = 0;
	$validou["message"] = '*Turma duplicada';
	echo json_encode($validou);
	exit;
}

if (($tempTurma -> incluirTurma($_POST['codigo_grade_curso'])) == false){
	$validou["check"] = 0;
	$validou["message"] = 'Falha ao incluir turma';
	echo json_encode($validou);
	exit;
}

echo json_encode($validou);
?>