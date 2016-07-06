<?php
include ("classe_turma.php");

$tempTurma = new Turma();

$retorno = $tempTurma -> excluirTurma($_GET['codigo']);

if ($retorno == false) {
	echo 'problema';
}

header('Location: administrador_turma_consulta.php');
?>