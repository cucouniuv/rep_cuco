 <!DOCTYPE html> 
<html> 
	<head> 
	<title>Sistema Chronos - Controle de horas complementares - UNIUV</title> 
	<meta http-equiv="Content-Language" content="pt-br">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="estilo.css" />
	<link rel="stylesheet" href="jquerymobile130/jquery.mobile-1.3.0.min.css" />
	<script src="jquerymobile130/jquery-1.9.1.min.js"></script>
	<script src="jquerymobile130/jquery.mobile-1.3.0.min.js"></script>	
</head> 
<body>
<!-- Home -->
<div data-role="page" id="page1">
    <div data-theme="b" data-role="header">
        <a data-role="button" href="orientador.html" data-icon="back" data-iconpos="left"
        class="ui-btn-left">
            Voltar
        </a>
        <h3>
            Orientador
        </h3>
    </div>
    <div data-role="content">
        <form action="solicitar_admin.php" method="POST" data-ajax="false">
            <div data-role="fieldcontain">
                <fieldset data-role="controlgroup">
                    <label for="textinput1">
                        Assunto
                    </label>
                    <input name="assunto" id="textinput1" placeholder="" value="" type="text">
                </fieldset>
            </div>
            <div data-role="fieldcontain">
                <fieldset data-role="controlgroup">
                    <label for="textarea1">
                        Mensagem
                    </label>
                    <textarea name="mensagem" id="textarea1" placeholder=""></textarea>
                </fieldset>
            </div>
            <input type="submit" value="Enviar">
        </form>
    </div>
</div>
</body>
</html>
