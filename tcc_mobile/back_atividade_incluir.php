<?php
$return_arr["check"] = 1;
$return_arr["message"] = '';
print_r($_POST);
print_r($_FILES);
exit;

// Validar
if ($_POST['codigo_evento'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Evento não informado';
	echo json_encode($return_arr);
	exit ;
}

if ($_POST['data_inicio'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Data de início';
	echo json_encode($return_arr);
	exit ;
}

if ($_POST['data_termino'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Data de término';
	echo json_encode($return_arr);
	exit ;
}

$data_inicio = new DateTime($_POST['data_inicio']);
$data_termino = new DateTime($_POST['data_termino']);

if ($data_inicio > $data_termino) {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Data inicial superior a de término';
	echo json_encode($return_arr);
	exit;
}

if ($_POST['total_horas'] == '') {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Total de horas';
	echo json_encode($return_arr);
	exit ;
}

if (empty($_FILES['documento_frente']) && empty($_FILES['documento_verso'])) {	
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Informe um arquivo para upload';
	echo json_encode($return_arr);
	exit ;
}

include ("classe_atividade.php");
$tempAtividade = new Atividade();
//inicia a sessao
session_start();

//Recebe id da pessoa
$id_pessoa = $_SESSION['id_pessoa'];

if ($id_pessoa > 0) {
	//Passa caminho da pasta
	$_UP['pasta'] = 'uploads/' . $id_pessoa . '/';

	//Verifica se existe a pasta
	if (is_dir($_UP['pasta']) == false) {
		$oldmask = umask(0);
		mkdir($_UP['pasta'], 0755);
		umask($oldmask);
		echo "Diretorio criado";
	}
} else {
	exit ;
}

// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 2;
// 2Mb

// Array com as extensões permitidas
$_UP['extensoes'] = array('jpg', 'tif', 'pdf');

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if (($_FILES['documento_frente']['error'] != 0) && ($_FILES['documento_verso']['error'] != 0)) {
	//	die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['documento_frente']['error']]);
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Erro ao realizar upload';
	echo json_encode($return_arr);
	exit ;
}
if (($_FILES['documento_verso']['error'] != 0) && ($_FILES['documento_verso']['error'] != 4)) {
	$return_arr["check"] = 0;
	$return_arr["message"] = '*Erro ao realizar upload [2]';
	echo json_encode($return_arr);
	exit ;
}

// Arquivo 1
if ($_FILES['documento_frente']) {
	// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
	// Faz a verificação da extensão do arquivo
	$extensao = strtolower(end(explode('.', $_FILES['documento_frente']['name'])));
	if (array_search($extensao, $_UP['extensoes']) === false) {
		//echo "Por favor, envie arquivos com as seguintes extensões: jpg, tif ou pdf";
		$return_arr["check"] = 0;
		$return_arr["message"] = '*Por favor, envie arquivos com as seguintes extensões: jpg, tif ou pdf';
		echo json_encode($return_arr);
		exit ;
	}
	// Faz a verificação do tamanho do arquivo
	else if ($_UP['tamanho'] < $_FILES['documento_frente']['size']) {
		$return_arr["check"] = 0;
		$return_arr["message"] = '*O arquivo enviado é muito grande, envie arquivos de até 2Mb';
		echo json_encode($return_arr);
		exit ;
	}
	// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
	else {

		$nome_arquivo1 = $_FILES['documento_frente']['name'];

		// Depois verifica se é possível mover o arquivo para a pasta escolhida
		if (move_uploaded_file($_FILES['documento_frente']['tmp_name'], $_UP['pasta'] . $nome_arquivo1)) {
			// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
			echo "Upload efetuado com sucesso!";
		} else {
			$return_arr["check"] = 0;
			$return_arr["message"] = '*Não foi possível fazer o upload, provavelmente a pasta está incorreta.';
			echo json_encode($return_arr);
			exit ;
		}

	}
}

// Arquivo 2
if ($_FILES['documento_verso']) {
	// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
	// Faz a verificação da extensão do arquivo
	$extensao = strtolower(end(explode('.', $_FILES['documento_verso']['name'])));
	if (array_search($extensao, $_UP['extensoes']) === false) {
		$return_arr["check"] = 0;
		$return_arr["message"] = '*Por favor, envie arquivos com as seguintes extensões: jpg, tif ou pdf.';
		echo json_encode($return_arr);
		exit ;
	}
	// Faz a verificação do tamanho do arquivo
	else if ($_UP['tamanho'] < $_FILES['documento_verso']['size']) {
		$return_arr["check"] = 0;
		$return_arr["message"] = '*O arquivo enviado é muito grande, envie arquivos de até 2Mb.';
		echo json_encode($return_arr);
		exit ;
	}
	// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
	else {

		$nome_arquivo2 = $_FILES['documento_verso']['name'];

		// Depois verifica se é possível mover o arquivo para a pasta escolhida
		if (move_uploaded_file($_FILES['documento_verso']['tmp_name'], $_UP['pasta'] . $nome_arquivo2)) {
			// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
			echo "Upload efetuado com sucesso!";
		} else {
			// Não foi possível fazer o upload, provavelmente a pasta está incorreta
			$return_arr["check"] = 0;
			$return_arr["message"] = '*Falha ao realizar upload do segundo arquivo.';
			echo json_encode($return_arr);
			exit ;
		}

	}
}

//Grava
$tempAtividade -> id_usuario_lancamento = $_SESSION['id_pessoa'];
$tempAtividade -> data_inicio = $_POST['data_inicio'];
$tempAtividade -> data_termino = $_POST['data_termino'];
$tempAtividade -> total_horas = $_POST['total_horas'];
$tempAtividade -> observacao = $_POST['observacao'];

if (empty($nome_arquivo1) == false) {
	$tempAtividade -> documento_frente = $_UP['pasta'] . $nome_arquivo1;
}
if (empty($nome_arquivo2) == false) {
	$tempAtividade -> documento_verso = $_UP['pasta'] . $nome_arquivo2;
}

$tempAtividade -> codigo_evento = $_POST['codigo_evento'];
$tempAtividade -> incluirAtividade($_SESSION['id_pessoa'], $_SESSION['codigo_turma']);
?>