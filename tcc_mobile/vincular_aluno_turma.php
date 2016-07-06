<?php

if ($_POST['id_turma'] <= 0){
	$validou['check'] = 0;
	$validou['message'] = '*Informe a turma';
	echo json_encode($validou);
	exit ;
}

include ("classe_turma.php");
$tempTurma = new Turma();

$vincular = $_POST['vincular'];
$id_turma = $_POST['id_turma'];

if ($vincular == 'sim') {
	if (isset($_POST['codigo_aluno'])) {

		$ta = $_POST['codigo_aluno'];

		for ($i = 0; $i < count($ta); $i++) {
			if (($tempTurma -> vincularAlunoTurma($id_turma, $ta[$i])) == false) {
				$validou['check'] = 0;
				$validou['message'] = 'Falha ao vincular aluno';
				echo json_encode($validou);
				exit ;
			}
		}
	} else {
		$validou['check'] = 0;
		$validou['message'] = '*Informe acadêmico(s)';
		echo json_encode($validou);
		exit ;
	}
} else {
	if (isset($_POST['codigo_aluno'])) {

		$ta = $_POST['codigo_aluno'];

		for ($i = 0; $i < count($ta); $i++) {
			if (($tempTurma -> desvincularAlunoTurma($id_turma, $ta[$i])) == false) {
				$validou['check'] = 0;
				$validou['message'] = 'Falha ao desvincular aluno';
				echo json_encode($validou);
				exit ;
			}
		}
	} else {
		$validou['check'] = 0;
		$validou['message'] = '*Informe acadêmico(s)';
		echo json_encode($validou);
		exit ;
	}
}

$validou['check'] = 1;
echo json_encode($validou);
?>