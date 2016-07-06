DROP TABLE aluno_turma;

CREATE TABLE `aluno_turma` (
  `id_pessoa` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  PRIMARY KEY (`id_pessoa`,`id_turma`),
  KEY `fk_aluno_turma_turma1_idx` (`id_turma`),
  KEY `fk_aluno_turma_aluno1_idx` (`id_pessoa`),
  CONSTRAINT `fk_aluno_turma_aluno1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_aluno_turma_turma1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE curso;

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `id_usuario_lancamento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `fk_curso_usuario_lancamento_idx` (`id_usuario_lancamento`),
  CONSTRAINT `fk_curso_usuario_lancamento` FOREIGN KEY (`id_usuario_lancamento`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;




DROP TABLE evento;

CREATE TABLE `evento` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_lancamento` int(11) DEFAULT NULL,
  `descricao` varchar(45) NOT NULL,
  PRIMARY KEY (`id_evento`),
  KEY `fl_evento_usuario_lancamento_idx` (`id_usuario_lancamento`),
  CONSTRAINT `fl_evento_usuario_lancamento` FOREIGN KEY (`id_usuario_lancamento`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;




DROP TABLE grade_curso;

CREATE TABLE `grade_curso` (
  `id_grade_curso` int(11) NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) NOT NULL,
  `id_usuario_lancamento` int(11) DEFAULT NULL,
  `total_horas` decimal(5,2) NOT NULL,
  `validade_inicio` date NOT NULL,
  `validade_termino` date NOT NULL,
  PRIMARY KEY (`id_grade_curso`),
  KEY `fk_grade_curso_curso1_idx` (`id_curso`),
  KEY `fk_grade_curso_usuario_lancamento_idx` (`id_usuario_lancamento`),
  CONSTRAINT `fk_grade_curso_curso1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grade_curso_usuario_lancamento` FOREIGN KEY (`id_usuario_lancamento`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;




DROP TABLE grade_evento;

CREATE TABLE `grade_evento` (
  `id_grade_evento` int(11) NOT NULL AUTO_INCREMENT,
  `id_grade_curso` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_usuario_lancamento` int(11) DEFAULT NULL,
  `minimo_horas` decimal(5,2) NOT NULL,
  `maximo_horas` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id_grade_evento`,`id_grade_curso`,`id_evento`),
  KEY `fk_grade_evento_evento1_idx` (`id_evento`),
  KEY `fk_grade_evento_grade_curso1_idx` (`id_grade_curso`),
  KEY `fk_grade_evento_usuario_lancamento_idx` (`id_usuario_lancamento`),
  CONSTRAINT `fk_grade_evento_evento1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grade_evento_grade_curso1` FOREIGN KEY (`id_grade_curso`) REFERENCES `grade_curso` (`id_grade_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grade_evento_usuario_lancamento` FOREIGN KEY (`id_usuario_lancamento`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;




DROP TABLE lancamento;

CREATE TABLE `lancamento` (
  `id_lancamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `id_grade_evento` int(11) NOT NULL,
  `id_usuario_lancamento` int(11) DEFAULT NULL,
  `data_lancamento` datetime NOT NULL,
  `data_inicio_evento` datetime NOT NULL,
  `data_termino_evento` datetime NOT NULL,
  `total_horas` decimal(5,2) NOT NULL,
  `status` char(1) NOT NULL COMMENT 'N - Não avaliado\nA - Aprovado\nR - Rejeitado\n\n',
  `observacao` text,
  `caminho_certificado_frente` varchar(255) DEFAULT NULL,
  `caminho_certificado_verso` varchar(255) DEFAULT NULL,
  `data_arquivamento` datetime DEFAULT NULL,
  PRIMARY KEY (`id_lancamento`,`id_pessoa`,`id_turma`,`id_grade_evento`),
  KEY `fk_aluno_turma_has_grade_evento_aluno_turma1_idx` (`id_pessoa`,`id_turma`),
  KEY `fk_lancamento_grade_evento1_idx` (`id_grade_evento`),
  KEY `fk_lancamento_usuario_lancamento_idx` (`id_usuario_lancamento`),
  CONSTRAINT `fk_aluno_turma_has_grade_evento_aluno_turma1` FOREIGN KEY (`id_pessoa`, `id_turma`) REFERENCES `aluno_turma` (`id_pessoa`, `id_turma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lancamento_grade_evento1` FOREIGN KEY (`id_grade_evento`) REFERENCES `grade_evento` (`id_grade_evento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lancamento_usuario_lancamento` FOREIGN KEY (`id_usuario_lancamento`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;




DROP TABLE pessoa;

CREATE TABLE `pessoa` (
  `id_pessoa` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` char(3) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefone` varchar(12) DEFAULT NULL,
  `num_matricula_aluno` varchar(11) DEFAULT NULL,
  `num_matricula_professor` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id_pessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

INSERT INTO pessoa VALUES("1","a","Administrador","21232f297a57a5a743894a0e4a801fc3","61381021697","luuisf92@gmail.com","4235229090","","");



DROP TABLE professor_turma;

CREATE TABLE `professor_turma` (
  `id_pessoa` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  PRIMARY KEY (`id_pessoa`,`id_turma`),
  KEY `fk_professor_turma_id_pessoa_idx` (`id_pessoa`),
  KEY `fk_professor_turma_id_turma_idx` (`id_turma`),
  CONSTRAINT `fk_professor_turma_id_pessoa` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_professor_turma_id_turma` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE turma;

CREATE TABLE `turma` (
  `id_turma` int(11) NOT NULL AUTO_INCREMENT,
  `id_grade_curso` int(11) NOT NULL,
  `id_usuario_lancamento` int(11) DEFAULT NULL,
  `nome` varchar(60) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_termino` date NOT NULL,
  PRIMARY KEY (`id_turma`),
  KEY `fk_turma_grade_curso1_idx` (`id_grade_curso`),
  KEY `fk_turma_usuario_lancamento_idx` (`id_usuario_lancamento`),
  CONSTRAINT `fk_turma_grade_curso1` FOREIGN KEY (`id_grade_curso`) REFERENCES `grade_curso` (`id_grade_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turma_usuario_lancamento` FOREIGN KEY (`id_usuario_lancamento`) REFERENCES `pessoa` (`id_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;




