<?php
//maldita permissao de arquivo
//perdi uns 20 min
session_start();
include '../tcc_mobile/config.php';

$destino = addslashes($_POST['cpf']);
$senha = geraSenha(6);
$senhamd5 = md5($senha);

$query = "  select nome, cpf, email";
$query .= " from pessoa";
$query .= " where cpf = '$destino' ";
$ret = mysql_query($query, $conn) or die(mysql_error());
$res = mysql_fetch_assoc($ret);

$email = $res['email'];

if (($res['cpf'] != $destino) or ($destino === '')) {
	$_SESSION['erro'] = 'CPF não cadastrado ou inválido.';
	$_SESSION['passou'] = 0;
	header('Location: esqueci.php');
	exit;
} else {
	$_SESSION['passou'] = 1;
	//update
	$usuario = $res['nome'];
	$query = "update pessoa set senha = '$senhamd5' where cpf = '$destino'";
	$ret = mysql_query($query, $conn) or die(mysql_error());
	$res = mysql_fetch_assoc($ret);
}

// Inclui o arquivo class.phpmailer.php localizado na pasta
require ("../tcc_mobile/class/email/class.phpmailer.php");

// Inicia a classe PHPMailer
$mail = new PHPMailer();

// Define os dados do servidor e tipo de conex�o
$mail -> IsSMTP();
// Define que a mensagem ser� SMTP
$mail -> Host = "smtps.bol.com.br";
// Endereco do servidor SMTP
$mail -> Port = 587;
$mail -> SMTPAuth = true;
// Usa autenticao SMTP? (opcional)
//$mail->SMTPSecure = "ssl";
$mail -> Username = 'cuco-uniuv@bol.com.br';
// Usu�rio do servidor SMTP
$mail -> Password = 'cuco2013';
// Senha do servidor SMTP

// Define o remetente, ou seja, quem ta enviando
$mail -> From = "cuco-uniuv@bol.com.br";
// Seu e-mail
$mail -> FromName = "CUCO Recupera";
// Seu nome

// Define os destinat�rio(s)
$mail -> AddAddress($email, $usuario);
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // C�pia Oculta

// Define os dados t�cnicos da Mensagem
$mail -> IsHTML(true);
// Define que o e-mail ser� enviado como HTML
$mail -> CharSet = 'iso-8859-1';
// Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
$mail -> Subject = "Recuperacao de senha";
// Assunto da mensagem
$mail -> Body = "Sua nova senha de acesso ao sistema CUCO: " . $senha;

// Define os anexos (opcional)
//$mail->AddAttachment("C:\pacientes_backup.sql", "novo_nome.pdf");  // Insere um anexo

// Envia o e-mail
$enviado = $mail -> Send();

// Limpa os destinat�rios e os anexos
$mail -> ClearAllRecipients();
$mail -> ClearAttachments();

// Exibe uma mensagem de resultado
if ($enviado) {
	echo "E-mail enviado com sucesso!";
	header('Location: login.php');
} else {
	echo "Não foi possível enviar o e-mail.<br /><br />";
	echo "<b>Informações do erro:</b> <br />" . $mail -> ErrorInfo;
	echo " Tente desativar temporariamente seu antivírus chulezento";
}

//gera senha
function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
	$lmin = 'abcdefghijklmnopqrstuvwxyz';
	$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$num = '1234567890';
	$simb = '!@#$%*-';
	$retorno = '';
	$caracteres = '';

	$caracteres .= $lmin;
	if ($maiusculas)
		$caracteres .= $lmai;
	if ($numeros)
		$caracteres .= $num;
	if ($simbolos)
		$caracteres .= $simb;

	$len = strlen($caracteres);
	for ($n = 1; $n <= $tamanho; $n++) {
		$rand = mt_rand(1, $len);
		$retorno .= $caracteres[$rand - 1];
	}
	return $retorno;
}

?>