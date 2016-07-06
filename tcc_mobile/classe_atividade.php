<?php

include '../tcc_mobile/config.php';

class Atividade {

	public $id_usuario_lancamento;
	public $data_inicio;
	public $data_termino;
	public $total_horas;
	public $observacao;
	public $documento_frente;
	public $documento_verso;
	public $codigo_evento;

	public function incluirAtividade($codigo_aluno, $codigo_turma) {

		try {
			//return false;

			$sql = " insert into lancamento (";
			$sql .= "                 id_pessoa, ";
			$sql .= "                 id_usuario_lancamento,";
			$sql .= "                 id_turma,";
			$sql .= "                 id_grade_evento,";
			$sql .= "                 data_lancamento,";
			$sql .= "                 data_inicio_evento,";
			$sql .= "                 data_termino_evento,";
			$sql .= "                 total_horas,";
			$sql .= "                 status,";
			$sql .= "                 observacao,";
			$sql .= "                 caminho_certificado_frente,";
			$sql .= "                 caminho_certificado_verso";
			$sql .= " )";
			$sql .= " values (";
			$sql .= $codigo_aluno . ",";
			$sql .= $this -> id_usuario_lancamento . ",";
			$sql .= $codigo_turma . ",";
			$sql .= $this -> codigo_evento . ",";
			$sql .= " Now(),";
			$sql .= " '" . $this -> data_inicio . "',";
			$sql .= " '" . $this -> data_termino . "',";
			$sql .= " '" . $this -> total_horas . "',";
			$sql .= " 'N',";
			$sql .= "'" . $this -> observacao . "',";
			$sql .= "'" . $this -> documento_frente . "',";
			$sql .= "'" . $this -> documento_verso . "')";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() >= -1) {
				//header('Location: academico.php');
			} else {
				echo 'Opa! ocorreu um problema: ';
				echo $sql;
			}

			return true;

		} catch (exception $e) {
			echo "Exceção pega: ", $e -> getMessage(), "\n";
		}
	}

	public function validarAtividade($codigo_atividade, $status) {

		try {

			$sql = "  update lancamento ";
			$sql .= " set observacao = concat(coalesce(observacao,''),' " . $this -> observacao . "')";
			$sql .= "    ,status = '" . $status . "' ";
			
			if (trim($status) == 'A'){
				$sql .= " ,data_arquivamento = now()";
			}
					
			$sql .= " where id_lancamento = $codigo_atividade";

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

	public function editarAtividade($codigo_lancamento) {

		try {

			$sql = "  update lancamento ";
			$sql .= " set data_inicio_evento = '" . $this -> data_inicio . "' ";
			$sql .= "    ,data_termino_evento = '" . $this -> data_termino . "' ";
			$sql .= "    ,total_horas = '" . $this -> total_horas . "' ";
			$sql .= "    ,observacao = '" . $this -> observacao . "' ";
			$sql .= "    ,id_grade_evento = '" . $this -> codigo_evento . "' ";
			$sql .= " where id_lancamento = $codigo_lancamento";

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

	public function incluirGradeEvento($codigo_evento) {

		try {

			$sql = " insert into grade_evento (";
			$sql .= "                 id_evento, ";
			$sql .= "                 minimo_horas, ";
			$sql .= "                 maximo_horas, ";
			$sql .= "                 id_grade_curso, ";
			$sql .= "                 id_usuario_lancamento ";
			$sql .= " )";
			$sql .= " values (";
			$sql .= " $codigo_evento ,";
			$sql .= " '" . $this -> minimo_horas . "', ";
			$sql .= " '" . $this -> maximo_horas . "', ";
			$sql .= " '" . $this -> id_grade_curso . "', ";
			$sql .= " '" . $this -> id_usuario_lancamento . "')";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() >= -1) {
				header('Location: administrador_evento.php');
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
		return false;
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

	public function vincularProfessor($codigo_curso, $codigo_professor) {
		return false;
	}

}
