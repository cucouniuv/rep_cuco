<?php
include ('controle_sessao.php');
?>
<!DOCTYPE html>
<?php
include '../tcc_mobile/config.php';

$query = "  select *";
$query .= " from pessoa";
$query .= " where tipo like '%a%'";
$query .= " order by nome asc";
$lista_pessoa = mysql_query($query, $conn) or die(mysql_error());
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
				<a data-role="button" href="administrador_cadastro.php" data-icon="plus"
				data-iconpos="left" class="ui-btn-right">Novo</a>
				<a data-role="button" href="administrador_configuracao.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Consulta de administradores </h3>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="true" data-filter-placeholder="Digite seu filtro aqui..." data-split-icon="delete" data-autodividers="true">

					<?php
					if ($lista_pessoa) {
						while ($row = mysql_fetch_array($lista_pessoa)) {
							echo '<li data-theme="c">';
							echo '<a href="administrador_editar.php?codigo=' . $row['id_pessoa'] . '" data-transition="slide">';
							echo '<h3>' . $row['nome'] . '</h3>';
							echo '<a href="administrador_excluir.php?codigo=' . $row['id_pessoa'] . '" data-transition="slide" onclick="return confirmaExclusao();" "></a>';
							echo '</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>
	</body>
</html>
