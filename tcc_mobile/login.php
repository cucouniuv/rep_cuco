<!DOCTYPE html>
<html>
	<head>
		<?php
		// elimina todas as informações relacionadas à sessão atual		
		//detroi a sessao
		$_SESSION = array();
		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time());
		}		

		if (isset($_SESSION)) {
			session_destroy();
		}
		
		// encerra o manipulador de sessão
		session_write_close();
		
		include ('cabecalho.php');
		?>
	</head>
	<body>
		<!-- Home -->
		<div data-role="page" id="page1">
			<div data-theme="b" data-role="header">
				<h4> Conecte-se </h4>
			</div>
			<div data-role="controlgroup">
				<form id="login" action="validalogin.php" method="POST">
					<div data-role="fieldcontain" id="cpf">
						<fieldset data-role="controlgroup">
							<label for="login_cpf"> CPF </label>
							<input name="login_cpf" id="login_cpf" placeholder="Insira 11 dígitos numéricos e sem máscara" type="text" value="61381021697" min="11" maxlength="11" pattern="[0-9]{11}" required>
						</fieldset>
					</div>
					<div data-role="fieldcontain" id="senha">
						<fieldset data-role="controlgroup">
							<label for="login_password"> Senha </label>
							<input name="login_password" id="login_password" placeholder="Insira ao menos 5 dígitos e máximo 10" value="" min="5" maxlength="10" type="password" pattern="^.{5,10}$" required>
						</fieldset>
					</div>
					<input id="conectar" data-theme="b" type="submit" data-icon="check" data-iconpos="left"
					value="Conectar">
					<div id="resposta"></div>
				</form>
			</div>

			<div data-role="controlgroup">
				<a data-role="button" href="esqueci.php" data-theme="c" data-icon="alert" data-transition="fade"> Esqueci a senha </a>
				<a data-role="button" href="novo.php" data-theme="c" data-icon="plus" data-transition="fade"> Quero me cadastrar </a>
				<a data-role="button" href="duvidas.php" data-theme="c" data-icon="plus" data-transition="fade"> Tenho dúvidas </a>				
			</div>
			<div data-role="content">
				<div style=" text-align:center">
					<img style="width: 30%; height: 30%" src="imagem/CucoLogo.png" title="Desenvolvido por Luis Olivetti">
				</div>
			</div>

			<div data-theme="c" data-role="footer">
				<h3> Controle de horas complementares </h3>
			</div>
			
			<script type="text/javascript">
				jQuery(function() {
					jQuery("#login").submit(function(event) {
					
						// Mostra imagem carregando
						jQuery.mobile.showPageLoadingMsg();
						
						// Serializa o formulario
						var dados = new FormData(this);

						jQuery.ajax({
							type : "POST",
							url : "validalogin.php",
							contentType: false,
							processData: false,
							cache : false,
							data : dados,
							success : function(data) {
							
								if (data.check == '2') {
									location.href = data.location;
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
