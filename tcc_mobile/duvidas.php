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
				<a data-role="button" href="login.php" data-icon="back" data-iconpos="left"
				class="ui-btn-left"> Voltar </a>
				<h3> Dúvidas </h3>
				<h4>Envie um e-mail para uniuv.cuco@bol.com.br</h4>				
			</div>
			<div data-role="content">
				<ul data-role="listview" data-divider-theme="b" data-inset="false" data-filter="true" data-filter-placeholder="Digite seu filtro aqui..." data-split-icon="delete" data-autodividers="true">
					<li data-theme="c">
						<h3>Como acesso o sistema?</h3>
						<span> Para acessar o sistema, o usuário deve preencher o CPF e senha e escolher a opção conectar. Caso esqueceu a senha, deve escolher a opção esqueci a senha. Caso queira cadastrar-se como acadêmico, escolher a opção quero me cadastrar. </span>
					</li>
					<li data-theme="c">
						<h3>Como cadastrar uma atividade?</h3>
						<span> No menu acadêmico, há o botão “Cadastrar” no grupo “Atividade”, preencha os campos e vincule um arquivo digitalizado do certificado/comprovante da realização do evento. Após cadastrar a atividade, a mesma ficará no aguardo da avaliação do orientador vinculado a turma. Se aprovado, a atividade retornará para a situação “Aguardando documentação a ser arquivada”. Entregue uma cópia da documentação ao orientador para que ele mude a situação para “Aprovado” e você receba um comprovante de entrega de documentação. </span>
					</li>
					<li data-theme="c">
						<h3>Como consulto minhas atividades?</h3>
						<span> No menu acadêmico, há o botão “Consultar” no grupo “Atividade”, escolha a situação desejada e verifique sua atividade. Caso queira alterar alguma informação, somente é possível caso a situação seja “Aguardando avaliação”. </span>
					</li>
					<li data-theme="c">
						<h3>Como vejo as informações das minhas horas cadastradas?</h3>
						<span> No menu acadêmico, há o botão “Informações” no grupo “Horas”, ao escolher essa opção, abrirá a tela com informações resumidas sobre o total de horas exigidas do curso e o total de horas aprovadas. Nessa tela ainda há relatório e gráficos. </span>
					</li>
					<li data-theme="c">
						<h3>Reprovei e não cumpri a quantia de horas exigidas. E agora?</h3>
						<span> Exemplo: Acadêmico já cadastrado possui 190 horas aprovadas e seu curso exige 200. Ele esta cadastrado na turma 1 – 2010 a 2013. Este acadêmico reprovou e o período de cadastro de atividades expirou. O orientador deve vinculá-lo a turma de 2011 a 2014, para que o acadêmico realize o cadastro das 10 horas restantes. Após isso, o acadêmico ou o orientador retira um relatório da turma de 2013 e um da turma de 2014. Anexa os dois arquivos e consta que o aluno cumpriu as horas. </span>
					</li>							
				</ul>
			</div>
		</div>
	</body>
</html>
