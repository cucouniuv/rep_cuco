<?php
include ("classe_evento.php");

$tempEvento = new Evento();

$tempEvento -> excluirGradeEvento($_GET['codigo']);

?>