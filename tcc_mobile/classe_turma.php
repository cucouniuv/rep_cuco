<?php

include '../tcc_mobile/config.php';

class Turma {

	public $nome;
	public $data_inicio;
	public $data_termino;
	public $id_usuario_lancamento;
	public $id_grade_curso;
	public $location;

	public function incluirTurma($codigo_grade_curso) {

		try {

			$sql = " insert into turma (";
			$sql .= "                 id_grade_curso, ";
			$sql .= "                 id_usuario_lancamento, ";
			$sql .= "                 nome, ";
			$sql .= "                 data_inicio, ";
			$sql .= "                 data_termino ";
			$sql .= " )";
			$sql .= " values (";
			$sql .= $codigo_grade_curso . ",";
			$sql .= $this -> id_usuario_lancamento . ",";
			$sql .= " '" . $this -> nome . "',";
			$sql .= " '" . $this -> data_inicio . "',";
			$sql .= " '" . $this -> data_termino . "')";

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

	public function editarTurma($codigo_turma) {

		try {

			$sql = "  update turma ";
			$sql .= " set id_grade_curso = '" . $this -> id_grade_curso . "' ";
			$sql .= "    ,nome = '" . $this -> nome . "' ";
			$sql .= "    ,data_inicio = '" . $this -> data_inicio . "' ";
			$sql .= "    ,data_termino = '" . $this -> data_termino . "' ";
			$sql .= " where id_turma = $codigo_turma";

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

	public function excluirTurma($codigo_turma) {

		try {

			$sql = "  delete from turma ";
			$sql .= " where id_turma = $codigo_turma";

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

	public function vincularAlunoTurma($codigo_turma, $codigo_aluno) {

		try {

			$sql = "  select count(*) as qtd";
			$sql .= " from aluno_turma";
			$sql .= " where  id_pessoa = $codigo_aluno";
			$sql .= "        and id_turma = $codigo_turma";
			$retorno = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($retorno);
			$qtd = $row['qtd'];

			if ($qtd > 0) {
				// Se já tem aluno não inclui
				return true;
			} else {

				$sql = " insert into aluno_turma (";
				$sql .= "                 id_pessoa, ";
				$sql .= "                 id_turma ";
				$sql .= " )";
				$sql .= " values (";
				$sql .= " $codigo_aluno,";
				$sql .= " $codigo_turma )";

				mysql_query($sql) or die(mysql_error());
				if (mysql_affected_rows() > 0) {
					return true;
				} else {
					return false;
				}
			}

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
			return false;
		}

	}

	public function desvincularAlunoTurma($codigo_turma, $codigo_aluno) {

		try {
			//return false;

			$sql = "  select count(*) qtd";
			$sql .= " from aluno_turma";
			$sql .= " where id_pessoa = $codigo_aluno";
			$sql .= "       and id_turma = $codigo_turma";
			$retorno = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($retorno);
			$qtd = $row['qtd'];

			if ($qtd > 0) {
				// Se já tem aluno exclui
				$sql = "  delete from aluno_turma";
				$sql .= " where id_pessoa = $codigo_aluno";
				$sql .= "       and id_turma = $codigo_turma";
				mysql_query($sql) or die(mysql_error());
				if (mysql_affected_rows() > 0) {
					return true;
				} else {
					return false;
				}

			} else {
				return true;
			}

		} catch (exception $e) {
			//echo "Exceção pega: ", $e -> getMessage(), "\n";
			return false;
		}

	}

	public function vincularProfessorTurma($codigo_turma, $codigo_professor) {

		try {

			$sql = "  select count(*) qtd";
			$sql .= " from professor_turma";
			$sql .= " where id_pessoa = $codigo_professor";
			$sql .= "       and id_turma = $codigo_turma";
			$retorno = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($retorno);
			$qtd = $row['qtd'];

			if ($qtd > 0) {
				// Se já tem professor não inclui
				return true;
			} else {

				$sql = " insert into professor_turma (";
				$sql .= "                 id_pessoa, ";
				$sql .= "                 id_turma ";
				$sql .= " )";
				$sql .= " values (";
				$sql .= " $codigo_professor,";
				$sql .= " $codigo_turma )";

				mysql_query($sql) or die(mysql_error());
				if (mysql_affected_rows() > 0) {
					return true;
				} else {
					return false;
				}
			}

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
			return false;
		}

	}

	public function desvincularProfessorTurma($codigo_turma, $codigo_professor) {

		try {

			$sql = "  select count(*) qtd";
			$sql .= " from professor_turma";
			$sql .= " where id_pessoa = $codigo_professor";
			$sql .= "       and id_turma = $codigo_turma";
			$retorno = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($retorno);
			$qtd = $row['qtd'];

			if ($qtd > 0) {
				// Se já tem professor, exclui
				$sql = "  delete from professor_turma";
				$sql .= " where id_pessoa = $codigo_professor";
				$sql .= "       and id_turma = $codigo_turma";
				mysql_query($sql) or die(mysql_error());
				if (mysql_affected_rows() > 0) {
					return true;
				} else {
					return false;
				}

			} else {
				return true;
			}

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
			return false;
		}

	}

	public function VerificaDuplicidadeTurma() {
		try {
			$sql = "  select id_turma";
			$sql .= " from turma";
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

	public function VerificaDuplicidadeTurmaEdicao($codigo_turma) {
		try {
			$sql = "  select id_turma";
			$sql .= " from turma";
			$sql .= " where  upper(nome) = upper('" . $this -> nome . "')";
			$sql .= "        and id_turma <> $codigo_turma";
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
