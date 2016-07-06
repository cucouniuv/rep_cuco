<?php
include ('controle_sessao.php');
session_start();

include '../tcc_mobile/config.php';

$query = "	select p.id_pessoa,";
$query .= "        p.nome,";
$query .= "        p.cpf,";
$query .= "        p.email";
$query .= " from pessoa as p";
$query .= " where p.tipo like '%p%'";
$query .= " order by p.nome";
$professores = mysql_query($query, $conn) or die(mysql_error());

?>

<!DOCTYPE html>
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
				<a data-role="button" href="administrador_orientador.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3>Orientador</h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="true" data-filter-placeholder="Digite aqui seu filtro..." data-split-icon="delete" data-autodividers="true">

					<?php
					if ($professores) {
						while ($row = mysql_fetch_array($professores)) {
							echo '<li data-theme="c">';
							echo '<a href="administrador_orientador_editar.php?id_pessoa=' . $row['id_pessoa'] . '" data-transition="slide">';
							echo '<h3>' . $row['nome'] . '</h3>';
							echo '<p>CPF:' . $row['cpf'] . '</p>';
							echo '<p>E-mail:' . $row['email'] . '</p>';
							echo '<a href="orientador_excluir.php?id_pessoa=' . $row['id_pessoa'] . '" data-transition="slide" onclick="return confirmaExclusao();" "></a>';
							echo '</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>
	</body>
</html>
