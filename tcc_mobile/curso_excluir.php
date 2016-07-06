<?php
include ("classe_curso.php");

$tempCurso = new curso();

$retorno = $tempCurso -> excluirCurso($_GET['codigo']);

if ($retorno == false) {
	echo 'problema';
}

?>