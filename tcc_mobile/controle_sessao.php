<?php
// session_start inicia a sessão
session_start();

if (!isset($_SESSION['id_pessoa']) or ($_SESSION['id_pessoa'] < 1)) {
	destroi_sessao();
	exit ;
}

// Verifica nivel de acesso pelo arquivo aberto
$nomearquivo = $_SERVER['PHP_SELF'];

if (strpos($nomearquivo, '/admin') > 0) {
	$nomearquivo = 'adm';
} elseif (strpos($nomearquivo, '/academico') > 0) {
	$nomearquivo = 'aca';
} elseif (strpos($nomearquivo, '/orienta') > 0) {
	$nomearquivo = 'ori';
}

// Aqui vem o md5
if (isset($_SESSION['tipoacesso'])){
	$tipoacesso = $_SESSION['tipoacesso'];
}

// Nao acessou com nenhum dos niveis
if (($tipoacesso != md5('aca')) and ($tipoacesso != md5('adm')) and ($tipoacesso != md5('ori')) and (strlen($tipoacesso) > 20)) {
	destroi_sessao();
	exit ;
}

// Valida acesso academico
if ($tipoacesso == md5('aca')) {
	if (($nomearquivo == 'adm') or ($nomearquivo == 'ori')) {
		destroi_sessao();
		exit ;
	}
}
// Valida acesso administrador
if ($tipoacesso == md5('adm')) {
	if (($nomearquivo == 'aca') or ($nomearquivo == 'ori')) {
		destroi_sessao();
		exit ;
	}
}
// Valida acesso orientador
if ($tipoacesso == md5('ori')) {
	if (($nomearquivo == 'adm') or ($nomearquivo == 'aca')) {
		destroi_sessao();
		exit ;
	}
}

function destroi_sessao() {

	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
		//setcookie(session_name(), '', time() - 42000, '/');
		setcookie(session_name(), '', time());
	}

	// elimina todas as informações relacionadas à sessão atual
	session_destroy();

	// encerra o manipulador de sessão
	session_write_close();

	header('Location: login.php');
}
?>

