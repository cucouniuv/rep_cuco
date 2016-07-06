<?php
include '../tcc_mobile/config.php';

class Pessoa {

	public $nome;
	public $cpf;
	public $senha;
	public $email;
	public $tipo;
	public $numero_matricula_aluno;
	public $numero_matricula_professor;
	public $telefone;
	public $location;

	public function incluirPessoa() {

		try {

			$sql = " insert into pessoa (";
			$sql .= "                 tipo,";
			$sql .= "                 nome, ";
			$sql .= "                 senha, ";
			$sql .= "                 cpf, ";
			$sql .= "                 email, ";
			$sql .= "                 telefone, ";
			$sql .= "                 num_matricula_aluno, ";
			$sql .= "                 num_matricula_professor ";
			$sql .= " )";
			$sql .= " values (";
			$sql .= " '" . $this -> tipo . "',";
			$sql .= " '" . $this -> nome . "',";
			$sql .= " '" . md5($this -> senha) . "',";
			$sql .= " '" . $this -> cpf . "',";
			$sql .= " '" . $this -> email . "',";
			$sql .= " '" . $this -> telefone . "',";
			$sql .= " '" . $this -> numero_matricula_aluno . "',";
			$sql .= " '" . $this -> numero_matricula_professor . "')";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() > 0) {
				return true;
			} else {
				return false;
			}

		} catch (exception $e) {
			echo "Erro pega: ", $e -> getMessage(), "\n";
			return true;
		}
	}

	public function editarPessoa($idpessoa) {

		try {

			$sql = "  update pessoa";
			$sql .= " set nome = '" . $this -> nome . "'";

			//if (strlen($this->cpf) = 11){
			//	$sql .= " ,cpf = '" . $this->cpf . "'";
			//}

			$sql .= "     ,email = '" . $this -> email . "'";
			$sql .= "     ,telefone = '" . $this -> telefone . "'";

			if (strlen($this -> numero_matricula_aluno) > 5) {
				$sql .= " ,num_matricula_aluno = '" . $this -> numero_matricula_aluno . "'";
			}
			$sql .= " where id_pessoa = $idpessoa";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() > 0) {
				return true;
			} else {
				return false;
			}

		} catch (exception $e) {
			echo "Erro pega: ", $e -> getMessage(), "\n";
			return true;
		}
	}

	public function excluirPessoa($codigo_pessoa) {

		try {

			$sql = "  delete from pessoa ";
			$sql .= " where id_pessoa = $codigo_pessoa";

			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() > 0) {
				return true;
			} else {
				return false;
			}

		} catch (exception $e) {
			echo "Erro pega: ", $e -> getMessage(), "\n";
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
				header('Location: administrador_curso.php');
			} else {
				echo $sql;
			}

			return true;

		} catch (exception $e) {
			echo "Erro pega: ", $e -> getMessage(), "\n";
		}

	}

	public function editarGradeCurso($codigo_curso, $codigo_grade_curso) {
		return false;
	}

	public function excluirGradecurso($codigo_grade_curso) {
		return false;
	}

	public function vincularProfessor($codigo_curso, $codigo_professor) {
		return false;
	}

	public function alteraSenha($id_pessoa) {

		try {

			$sql = "  update pessoa";
			$sql .= " set senha = md5('" . $this -> senha . "')";
			$sql .= " where  id_pessoa = $id_pessoa";
			mysql_query($sql) or die(mysql_error());

			if (mysql_affected_rows() > 0) {
				return true;
			} else {
				return false;
			}

		} catch (exception $e) {
			echo "Erro pega: ", $e -> getMessage(), "\n";
			return false;
		}
	}

	public function retornaIdPessoa() {

		$sql = "  select coalesce(id_pessoa,-1) as id_pessoa";
		$sql .= " from pessoa";
		$sql .= " where  cpf = '" . $this -> cpf . "'";
		$retorno = mysql_query($sql) or die(mysql_error());

		if (mysql_num_rows($retorno) > 0) {
			$row = mysql_fetch_assoc($retorno);
			$id_pessoa = $row['id_pessoa'];
		} else {
			$id_pessoa = -1;
		}

		return $id_pessoa;
	}

	// retornaTipoPessoa: Verifica se a pessoa do tipo
	public function retornaTipoPessoa() {

		$sql = "  select tipo";
		$sql .= " from pessoa";
		$sql .= " where  cpf = '" . $this -> cpf . "'";
		$sql .= "        and tipo like '%" . $this -> tipo . "%'";
		$retorno = mysql_query($sql) or die(mysql_error());

		if (mysql_num_rows($retorno) > 0) {
			$tipo_pessoa = true;
		} else {
			$tipo_pessoa = false;
		}

		return $tipo_pessoa;
	}
// Verifica cpf
	public function verificaDuplicidade() {

		$sql = "  select id_pessoa";
		$sql .= " from pessoa";
		$sql .= " where  cpf = '" . $this -> cpf . "'";
		$retorno = mysql_query($sql) or die(mysql_error());

		if (mysql_num_rows($retorno) > 0) {
			$dup = true;
		} else {
			$dup = false;
		}
		return $dup;
	}

	public function alteraTipoPessoa() {

		try {

			$sql = "  update pessoa";
			$sql .= " set tipo = (concat(tipo,'" . $this -> tipo . "')) ";
			$sql .= " where  cpf = '" . $this -> cpf . "'";
			mysql_query($sql) or die(mysql_error());
			if (mysql_affected_rows() >= -1) {
				return true;
			} else {
				return false;
			}

		} catch (exception $e) {
			echo "Erro pega: ", $e -> getMessage(), "\n";
			return false;
		}
	}

	public function validaCpf() {
		try {
			$cpf = $this -> cpf;

			if (!is_numeric($cpf)) {
				return false;
			} else {
				//VERIFICA
				if (($cpf == '11111111111') || ($cpf == '22222222222') || ($cpf == '33333333333') || ($cpf == '44444444444') || ($cpf == '55555555555') || ($cpf == '66666666666') || ($cpf == '77777777777') || ($cpf == '88888888888') || ($cpf == '99999999999') || ($cpf == '00000000000')) {
					return false;
				} else {
					//PEGA O DIGITO VERIFIACADOR
					$dv_informado = substr($cpf, 9, 2);

					for ($i = 0; $i <= 8; $i++) {
						$digito[$i] = substr($cpf, $i, 1);
					}

					$posicao = 10;
					$soma = 0;

					for ($i = 0; $i <= 8; $i++) {
						$soma = $soma + $digito[$i] * $posicao;
						$posicao = ($posicao - 1);
					}

					$digito[9] = ($soma % 11);

					if ($digito[9] < 2) {
						$digito[9] = 0;
					} else {
						$digito[9] = 11 - $digito[9];
					}

					$posicao = 11;
					$soma = 0;

					for ($i = 0; $i <= 9; $i++) {
						$soma = $soma + $digito[$i] * $posicao;
						$posicao = $posicao - 1;
					}

					$digito[10] = $soma % 11;

					if ($digito[10] < 2) {
						$digito[10] = 0;
					} else {
						$digito[10] = 11 - $digito[10];
					}

					$dv = $digito[9] * 10 + $digito[10];
					if ($dv != $dv_informado) {
						return false;
					} else {
						return true;
					}
				}

			}

		} catch (exception $e) {
			echo "Erro pega: ", $e -> getMessage(), "\n";
			return false;
		}
	}

}
