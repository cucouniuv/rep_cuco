<?php

$arquivo = $_GET['arquivo'];
if ($arquivo) {
	enviar_arquivo($arquivo);
} else {
	exit ;
}

function enviar_arquivo($arq) {

	$arq = realpath($arq);

	if (!file_exists($arq)) {
		die("Arquivo não encontrado");
	}

	$extensao = strtolower(substr(strrchr($arq, "."), 1));
	switch ($extensao) {
		case "pdf" :
			$ctype = "application/pdf";
			break;
		case "exe" :
			$ctype = "application/octet-stream";
			break;
		case "zip" :
			$ctype = "application/zip";
			break;
		case "doc" :
			$ctype = "application/msword";
			break;
		case "xls" :
			$ctype = "application/vnd.ms-excel";
			break;
		case "ppt" :
			$ctype = "application/vnd.ms-powerpoint";
			break;
		case "gif" :
			$ctype = "image/gif";
			break;
		case "png" :
			$ctype = "image/png";
			break;
		case "jpe" :
		case "jpeg" :
		case "jpg" :
			$ctype = "image/jpg";
			break;
		default :
			$ctype = "application/force-download";
	}

	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private", false);
	header("Content-Type: $ctype");
	header("Content-Disposition: attachment; filename=\"" . basename($arq) . "\";");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: " . filesize($arq));
	set_time_limit(0);
	ob_clean();
	//Limpa a saida do buffer
	flush();
	//da a descarga
	readfile($arq) or die('Download incompleto');
	exit;
}
?>
