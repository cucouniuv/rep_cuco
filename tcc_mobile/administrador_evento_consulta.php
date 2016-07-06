<!DOCTYPE html>
<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

$query = " select id_evento, ";
$query .= "          descricao";
$query .= " from evento";
$query .= " order by descricao asc";

$lista_evento = mysql_query($query, $conn) or die(mysql_error());
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
				<a data-role="button" href="administrador_evento.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Consulta de eventos </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="true" data-filter-placeholder="Digite aqui seu filtro..." data-split-icon="delete" data-autodividers="true">

					<?php
					if ($lista_evento) {
						while ($row = mysql_fetch_array($lista_evento)) {
							//var_dump($row);
							echo '<li data-theme="c">';
							echo '<a href="administrador_evento_editar.php?codigo=' . $row['id_evento'] . '" data-transition="slide">';
							echo '<h3>' . $row['descricao'] . '</h3>';
							echo '<a href="evento_excluir.php?codigo=' . $row['id_evento'] . '" data-transition="slide" onclick="return confirmaExclusao();" "></a>';
							echo '</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>
	</body>
</html>
