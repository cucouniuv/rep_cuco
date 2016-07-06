<?php
include ("classe_curso.php");

$tempCurso = new curso();
$tempCurso -> excluirGradeCurso($_GET['codigo']);

?>