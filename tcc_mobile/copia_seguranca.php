<?php
include ('controle_sessao.php');

$ret = backup_database_tables('127.0.0.1', 'root', '', 'horascomp', '*');

//header('Location: administrador_configuracao.php');
//exit ;

function backup_database_tables($host, $user, $pass, $name, $tables) {

	try {
		$link = mysql_connect($host, $user, $pass);
		mysql_select_db($name, $link);

		//get all of the tables
		if ($tables == '*') {
			$tables = array();
			$result = mysql_query('SHOW TABLES');
			while ($row = mysql_fetch_row($result)) {
				$tables[] = $row[0];
			}
		} else {
			$tables = is_array($tables) ? $tables : explode(',', $tables);
		}

		//cycle through each table and format the data
		foreach ($tables as $table) {
			$result = mysql_query('SELECT * FROM ' . $table);
			$num_fields = mysql_num_fields($result);

			$return .= 'DROP TABLE ' . $table . ';';
			$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE ' . $table));
			$return .= "\n\n" . $row2[1] . ";\n\n";

			for ($i = 0; $i < $num_fields; $i++) {
				while ($row = mysql_fetch_row($result)) {
					$return .= 'INSERT INTO ' . $table . ' VALUES(';
					for ($j = 0; $j < $num_fields; $j++) {
						$row[$j] = addslashes($row[$j]);
						$row[$j] = ereg_replace("\n", "\\n", $row[$j]);
						if (isset($row[$j])) { $return .= '"' . $row[$j] . '"';
						} else { $return .= '""';
						}
						if ($j < ($num_fields - 1)) { $return .= ',';
						}
					}
					$return .= ");\n";
				}
			}
			$return .= "\n\n\n";
		}

		//save the file
		$nome = 'Cópia realizada em ..copia_seguranca/db-copia-' . time() . '-' . (md5(implode(',', $tables))) . '.sql';
		$handle = fopen('copia_seguranca/db-copia-' . time() . '-' . (md5(implode(',', $tables))) . '.sql', 'w+');
		fwrite($handle, $return);
		fclose($handle);

		return $nome;
	} catch (Exception $e) {
		$men = "Exceção pega: " . $e -> getMessage();
		return $men;		
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
	<body>
		<!-- Home -->
		<div data-role="page" id="page1">
			<div data-theme="b" data-role="header">
				<a data-role="button" data-direction="reverse" href="administrador_configuracao.php"
				data-icon="back" data-iconpos="left" class="ui-btn-left"> Voltar </a>
				<h2> Cópia de segurança </h2>
			</div>
			<div data-role="content">
			<?php echo $ret . $nome;?>
			</div>
		</div>
	</body>
</html>