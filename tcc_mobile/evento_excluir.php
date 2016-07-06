<?php
include ("classe_evento.php");

$tempEvento = new Evento();

$tempEvento -> excluirEvento($_GET['codigo']);

?>