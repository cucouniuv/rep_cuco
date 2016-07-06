<?php
include ('controle_sessao.php');
include '../tcc_mobile/config.php';

// Querys

//inicia a sessao
session_start();

$codigo_lancamento = $_GET['codigo_lancamento'];
$codigo_turma = $_SESSION['codigo_turma'];

if ($codigo_turma > 0) {

	$query = "	select l.*, ";
	$query .= "        (case l.status when 'N' then 'Aguardando avaliação' ";
	$query .= "                       when 'D' then 'Aguardando documentação a ser arquivada' ";
	$query .= "                       when 'A' then 'Aprovado' ";
	$query .= "                       when 'R' then 'Rejeitado' ";
	$query .= "         end) as situacao,";
	$query .= "        t.nome as turma,";
	$query .= "        e.descricao as evento,";
	$query .= "        p.nome as pessoa";
	$query .= " from lancamento as l";
	$query .= " inner join grade_evento as ge";
	$query .= "         on (l.id_grade_evento = ge.id_grade_evento)";
	$query .= " inner join evento as e";
	$query .= "         on (ge.id_evento = e.id_evento)";
	$query .= " inner join turma as t";
	$query .= "         on (l.id_turma = t.id_turma)";
	$query .= " inner join pessoa as p";
	$query .= "         on (l.id_pessoa = p.id_pessoa)";
	$query .= " where (t.id_turma = $codigo_turma )";
	$query .= "       and (l.id_lancamento = $codigo_lancamento )";
	$query .= " order by l.id_lancamento desc";

	$lista_atividade = mysql_query($query, $conn) or die(mysql_error());
	if ($lista_atividade) {
		$row = mysql_fetch_assoc($lista_atividade);
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php
		include ('cabecalho.php');
		?>
	</head>
	<!-- Home -->
	<div data-role="page" id="page1">
		<div data-theme="b" data-role="header">
			<h3> Atividade </h3>
			<a data-role="button" data-theme="b" href="orientador_atividade_solicitacao.php" data-icon="back"
			data-iconpos="left" class="ui-btn-left"> Voltar </a>
		</div>
		<div data-role="content">
			<div data-role="collapsible" data-theme="b" data-content-theme="b" data-collapsed="false">
				<h3> Atividade </h3>
				<?php
				echo '<p>Acadêmico: ' . $row['pessoa'] . '</p>';
				echo '<p>Código: ' . $row['id_lancamento'] . '</p>';
				echo '<p>Evento: ' . $row['evento'] . '</p>';
				echo '<p>Data do evento: ' . date_format(date_create($row['data_inicio']), 'd/m/Y') . ' até ' . date_format(date_create($row['data_termino']), 'd/m/Y') . '</p>';
				echo '<p>Total de horas: ' . $row['total_horas'] . '</p>';
				echo '<p>Situação: ' . $row['situacao'] . '</p>';
				echo '<p>Observações: ' . $row['observacao'] . '</p>';
				if ($row['caminho_certificado_frente']) {
					$arquivo1 = $row['caminho_certificado_frente'];
					echo '<a href="arquivo_download.php?arquivo=' . $arquivo1 . '" target="_blank">Download do arquivo 1</a>';
				}
				if ($row['caminho_certificado_verso']) {
					$arquivo2 = $row['caminho_certificado_verso'];
					echo '</br><a href="arquivo_download.php?arquivo=' . $arquivo2 . '" target="_blank">Download do arquivo 2</a>';
				}
				?>
			</div>
			<form id="formulario" action="orientador_validar_atividade.php" method="POST">

				<fieldset data-role="controlgroup" required>
					<legend>
						Situação:
					</legend>
					<input type="radio" name="status" id="radio-choice-v-2a" value="D" checked="checked">
					<label for="radio-choice-v-2a">Aprovado mas aguardando documentação</label>
					<input type="radio" name="status" id="radio-choice-v-2b" value="A">
					<label for="radio-choice-v-2b">Aprovado</label>
					<input type="radio" name="status" id="radio-choice-v-2c" value="R">
					<label for="radio-choice-v-2c">Rejeitado</label>
				</fieldset>

				<label for="observacao">Observações:</label>
				<textarea cols="40" rows="8" name="observacao" id="observacao"></textarea>
				<input type="hidden" name="id_lancamento" id="id_lancamento" value="<?php echo $codigo_lancamento; ?>" >
				<input type="submit" <?php
					if ($row['status'] == 'R') {
						echo 'disabled';
					}
					if ($row['status'] == 'A') {
						echo 'onclick="return confirmaAlteracao();"';
					}
				?> data-icon="check" data-iconpos="left" value="Gravar">
				<div id="resposta"></div>
			</form>
		</div>

		<script type="text/javascript">
			jQuery(function() {
				jQuery("#formulario").submit(function(event) {

					// Mostra imagem carregando
					jQuery.mobile.showPageLoadingMsg();

					// Serializa o formulario
					var dados = new FormData(this);

					jQuery.ajax({
						type : "POST",
						url : "orientador_validar_atividade.php",
						contentType : false,
						processData : false,
						cache : false,
						data : dados,
						success : function(data) {

							if (data.check == '1') {
								alert('Alterado com sucesso');
								location.href = 'orientador_atividade_solicitacao.php';
							} else if (data.check == '2') {
								alert('Alterado com sucesso');
								location.href = 'relatorio_comprovante_entrega.php?id_lancamento=' + data.id_lancamento;
								//location.href = 'orientador_atividade_solicitacao.php'; 
							} else {
								alert(jQuery.trim(data.message));

							}
						},
						dataType : "json"

					});

					// Esconde imagem carregando
					jQuery.mobile.hidePageLoadingMsg();

					event.preventDefault();
					return false;
				});
			});
		</script>

	</div>
	</body>
</html>
