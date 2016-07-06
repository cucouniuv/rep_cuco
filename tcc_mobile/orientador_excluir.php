<?php
include ("classe_pessoa.php");
$tempPessoa = new pessoa();
$retorno = $tempPessoa -> excluirPessoa($_GET['id_pessoa']);

if ($retorno == false) {
	echo 'problema';
}

?>