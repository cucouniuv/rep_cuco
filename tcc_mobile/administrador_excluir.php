<?php
include ("classe_pessoa.php");
$tempPessoa = new Pessoa();
$retorno = $tempPessoa -> excluirPessoa($_GET['codigo']);

if ($retorno == false) {
	echo 'problema';
}
else {
	header('Location: administrador_consulta.php');
}

?>