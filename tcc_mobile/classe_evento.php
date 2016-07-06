<?php

include '../tcc_mobile/config.php';

class Evento {

	public $descricao;
	public $minimo_horas;
	public $maximo_horas;
	public $id_grade_curso;
	public $id_usuario_lancamento;

	public function incluirEvento() {

		try {

			$sql = " insert into evento (";
			$sql .= "                 descricao, ";
			$sql .= "                 id_usuario_lancamento";
			$sql .= " )";
			$sql .= " values (";
			$sql .= " '" . $this -> descricao . "',";
			$sql .= $this -> id_usuario_lancamento . ")";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() >= -1) {
				return true;
			} else {
				return false;
			}			

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
			return false;
		}
	}

	public function editarEvento($codigo_evento) {

		try {

			$sql = "  update evento ";
			$sql .= " set descricao = '" . $this -> descricao . "' ";
			$sql .= " where id_evento = $codigo_evento";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() > 0) {
				return true;
			} else {
				return false;
			}

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
			return false;
		}

	}

	public function excluirEvento($codigo_Evento) {

		try {
			//return false;

			$sql = "  delete from evento ";
			$sql .= " where id_evento = $codigo_Evento";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() >= -1) {
				header('Location: administrador_evento_consulta.php');
			} else {
				echo 'Opa! ocorreu um problema: ';
				echo $sql;
			}

			return true;

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
		}

	}

	public function incluirGradeEvento($codigo_evento) {

		try {

			$sql = " insert into grade_evento (";
			$sql .= "                 id_evento, ";
			$sql .= "                 minimo_horas, ";
			$sql .= "                 id_grade_curso, ";
			$sql .= "                 id_usuario_lancamento ";
			$sql .= " )";
			$sql .= " values (";
			$sql .= " $codigo_evento ,";
			$sql .= " '" . $this -> minimo_horas . "', ";
			$sql .= " '" . $this -> id_grade_curso . "', ";
			$sql .= " '" . $this -> id_usuario_lancamento . "')";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() > 0) {
				return true;
			} else {
				return false;
			}

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
			return false;
		}

	}

	public function editarGradeEvento($codigo_grade_evento, $codigo_evento) {
		
		try {

			$sql = "  update grade_evento";
			$sql .= " set    id_evento = $codigo_evento";
			$sql .= "       ,minimo_horas = '" . $this -> minimo_horas . "'";
			$sql .= "       ,id_grade_curso = '" . $this -> id_grade_curso . "'";
			$sql .= " where id_grade_evento = $codigo_grade_evento";
			
			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() > 0) {
				return true;
			} else {
				return false;
			}

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
			return false;
		}
	}

	public function excluirGradeEvento($codigo_grade_evento) {

		try {
			//return false;

			$sql = "  delete from grade_evento ";
			$sql .= " where id_grade_evento = $codigo_grade_evento";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() >= -1) {
				header('Location: administrador_evento_grade_consulta.php');
			} else {
				echo 'Opa! ocorreu um problema: ';
				echo $sql;
			}

			return true;

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
		}

	}

	public function VerificaDuplicidadeEvento() {
		try {
			$sql = "  select id_evento";
			$sql .= " from evento";
			$sql .= " where  upper(descricao) = upper('" . $this -> descricao . "')";
			$retorno = mysql_query($sql) or die(mysql_error());
			if (mysql_num_rows($retorno) > 0) {
				return true;
			} else {
				return false;
			}

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
			return false;
		}
	}
	
	public function VerificaDuplicidadeEventoEdicao($codigo_evento) {
		try {
			$sql = "  select id_evento";
			$sql .= " from evento";
			$sql .= " where  upper(descricao) = upper('" . $this -> descricao . "')";
			$sql .= "        and id_evento <> $codigo_evento";
			$retorno = mysql_query($sql) or die(mysql_error());
			if (mysql_num_rows($retorno) > 0) {
				return true;
			} else {
				return false;
			}

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
			return false;
		}
	}

}
