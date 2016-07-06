<?php
// Define valor padrao
$valida["check"] = 1;
$valida["message"] = '';

// Obriga a informacao da rejeicao
if ($_POST['status'] == 'R') {
	if ($_POST['observacao'] == '') {
		$valida["check"] = 0;
		$valida["message"] = '*Informe o motivo da rejeição';
		echo json_encode($valida);
		exit ;
	}
}

include ("classe_atividade.php");
$tempAtividade = new Atividade();

if (trim($_POST['observacao']) != ''){
	$tempAtividade -> observacao = '[Orientador escreveu: ' . $_POST['observacao'] . ']';
}

if (($tempAtividade -> validarAtividade($_POST['id_lancamento'], $_POST['status'])) == false) {
	$valida["check"] = 0;
	$valida["message"] = '*Falha ao validar atividade';
	echo json_encode($valida);
	exit ;
}

if ($_POST['status'] == 'A'){
	$valida["check"] = 2;
	$valida["id_lancamento"] = $_POST['id_lancamento'];
	echo json_encode($valida);
	exit ;
}

echo json_encode($valida);
?>