<?php
$data_inicio = new DateTime('20/03/2014');

// 13/04/2014 - LUIS.OLIVETTI
$data_atual = new DateTime( 'now', new DateTimeZone( 'America/Sao_Paulo') );


echo $data_atual->format('Y/m/d');
?>