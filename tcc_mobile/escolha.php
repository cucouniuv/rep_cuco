<?php
include ('controle_sessao.php');
?>
<!DOCTYPE html>
<?php

header('Content-Type: text/html; charset=UTF-8', true);

include '../tcc_mobile/config.php';

session_start();
unset($_SESSION['tipoacesso']);
$id_pessoa = $_SESSION['id_pessoa'];

// Query
$query = "  select tipo ";
$query .= " from pessoa ";
$query .= " where id_pessoa = $id_pessoa ";

$tipo_pessoa = mysql_query($query, $conn) or die(mysql_error());
$resposta = mysql_fetch_assoc($tipo_pessoa);

$academico = preg_match('/[l]/', $resposta['tipo']);
$administrador = preg_match('/[a]/', $resposta['tipo']);
$professor = preg_match('/[p]/', $resposta['tipo']);
?>
<html>
	<head>
		<?php
		include ('cabecalho.php');
		?>
	</head>
	<body>
		<!-- Home -->
		<div data-role="page" id="page1">
			<div data-theme="b" data-role="header">
				<a data-role="button" href="login.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Escolha </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="true">

					<?php
					if (($academico) and isset($academico)) {
						//Verifica se o acadêmico possui mais turmas
						//Mysql_num_rows resulta as linhas de select e show, affected rows utilizado para update insert, deleted
						$query = "  select t.id_turma ";
						$query .= " from turma t ";
						$query .= " inner join aluno_turma at ";
						$query .= "         on ( t.id_turma = at.id_turma )";
						$query .= " where at.id_pessoa = $id_pessoa";

						$lista_turma = mysql_query($query, $conn) or die(mysql_error());
						if (mysql_num_rows($lista_turma) > 1) {
							echo '<li data-theme="c">';
							echo '<a href="escolha_turma.php?hash='.md5('aca').'" data-transition="slide">Acadêmico</a>';
							echo '</li>';
						} else {
							echo '<li data-theme="c">';
							echo '<a href="academico.php?hash='.md5('aca').'" data-transition="slide">Acadêmico</a>';
							echo '</li>';
						}
					}
					if (($administrador) and isset($administrador)) {
						echo '<li data-theme="c">';
						echo '<a href="administrador.php?hash='.md5('adm').'" data-transition="slide">Administrador</a>';
						echo '</li>';
					}
					if (($professor) and isset($professor)) {						
						echo '<li data-theme="c">';
						echo '<a href="orientador.php?hash='.md5('ori').'" data-transition="slide">Orientador</a>';
						echo '</li>';
					}
					?>
				</ul>
			</div>
		</div>
	</body>
</html>
