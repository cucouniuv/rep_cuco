<?php
# Informa qual o conjunto de caracteres será usado.
header('Content-Type: text/html; charset=utf-8');
//definindo a conexao do sistema
//servidor
$servidor = '127.0.0.1';
//usuario
$usuarios = 'root';
//senha
$senha = '';
//base
$db = 'horascomp';

//conecta com mysql
$conn = mysql_connect($servidor, $usuarios, $senha) or die(mysql_error());

//conect o banco
$database = mysql_select_db($db) or die(mysql_error($conn));

# Aqui está o segredo
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

?>
