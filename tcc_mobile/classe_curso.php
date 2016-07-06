<?php

include '../tcc_mobile/config.php';

class Curso {

	public $nome;
	public $total_horas;
	public $validade_inicio;
	public $validade_termino;

	public function incluirCurso() {

		try {
			//return false;

			$sql = " insert into curso (";
			$sql .= "                 nome ";
			$sql .= " )";
			$sql .= " values (";
			$sql .= " '" . $this -> nome . "')";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() >= -1) {
				//header('Location: administrador_curso.php');
			} else {
				echo 'Opa! ocorreu um problema: ';
				echo $sql;
			}

			return true;

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
		}
	}

	public function editarCurso($codigo_curso) {

		try {

			$sql = "  update curso ";
			$sql .= " set nome = '" . $this -> nome . "' ";
			$sql .= " where id_curso = $codigo_curso";

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

	public function excluirCurso($codigo_curso) {

		try {
			$sql = "  delete";
			$sql .= " from curso";
			$sql .= " where id_curso = $codigo_curso";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() >= -1) {
				header('Location: administrador_curso_consulta.php');
				return true;
			} else {
				echo 'Opa! ocorreu um problema: ';
				echo $sql;
				return false;
			}

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
			return false;
		}

	}

	public function incluirGradeCurso($codigocurso) {

		try {

			$sql = " insert into grade_curso (";
			$sql .= "                 id_curso, ";
			$sql .= "                 validade_inicio, ";
			$sql .= "                 validade_termino, ";
			$sql .= "                 total_horas ";
			$sql .= " )";
			$sql .= " values (";
			$sql .= " $codigocurso ,";
			$sql .= " '" . $this -> validade_inicio . "', ";
			$sql .= " '" . $this -> validade_termino . "', ";
			$sql .= " '" . $this -> total_horas . "')";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() >= -1) {
				//header('Location: administrador_curso.php');
			} else {
				echo 'Opa! ocorreu um problema: ';
				echo $sql;
			}

			return true;

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
		}

	}

	public function editarGradeCurso($codigo_curso, $codigo_grade_curso) {

		try {

			$sql = "  update grade_curso";
			$sql .= " set    id_curso = $codigo_curso";
			$sql .= "       ,validade_inicio = '" . $this -> validade_inicio ."'";
			$sql .= "       ,validade_termino = '" . $this -> validade_termino ."'";
			$sql .= "       ,total_horas = '" . $this -> total_horas ."'";
			$sql .= " where  id_grade_curso = $codigo_grade_curso";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() > 0) {
				return true;
			} else {
				return false;
			}

			return true;

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
			return false;
		}
	}

	public function excluirGradeCurso($codigo_grade_curso) {
		try {

			$sql = "  delete from grade_curso ";
			$sql .= " where id_grade_curso = $codigo_grade_curso";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() >= -1) {
				header('Location: administrador_curso_grade_consulta.php');
			} else {
				echo 'Opa! ocorreu um problema: ';
				echo $sql;
			}

			return true;

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
		}
	}

	public function vincularProfessor($codigo_curso, $codigo_professor) {
		return false;
	}

	public function VerificaDuplicidadeCurso() {
		try {
			$sql = "  select id_curso";
			$sql .= " from curso";
			$sql .= " where  upper(nome) = upper('" . $this -> nome . "')";
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
	
	public function VerificaDuplicidadeCursoEdicao($codigo_curso) {
		try {
			$sql = "  select id_curso";
			$sql .= " from curso";
			$sql .= " where  upper(nome) = upper('" . $this -> nome . "')";
			$sql .= "        and id_curso <> $codigo_curso";
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
