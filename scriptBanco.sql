CREATE TABLE tbl_tipo_docente (
	id_tipo_docente integer auto_increment NOT NULL,
	descricao_tipo_docente varchar(50) not null,
	CONSTRAINT tbl_tipo_docente_pk PRIMARY KEY (id_tipo_docente)
);

CREATE TABLE tbl_docente (
	id_docente integer auto_increment NOT NULL,
	cod_tipo_docente integer not null,
	nome_docente varchar(80) not null,
	matricula varchar(10) not null,
	usuario varchar(50) not null,
	senha varchar(255) not null,
	email varchar(80) not null,
	ativo_inativo char(1) not null,
	CONSTRAINT tbl_docente_pk PRIMARY KEY (id_docente),
	CONSTRAINT tbl_docente_tipo_docente_fk FOREIGN KEY (cod_tipo_docente) REFERENCES tbl_tipo_docente(id_tipo_docente)
);

CREATE INDEX nome_docente_index ON tbl_docente (nome_docente);
CREATE INDEX matricula_index ON tbl_docente (matricula);

CREATE TABLE tbl_intersticio(
	id_intersticio integer auto_increment not null,
	data_inicio_intersticio date not null,
	data_fim_intersticio date not null,
	CONSTRAINT tbl_intersticio_pk PRIMARY KEY (id_intersticio)
);

CREATE INDEX data_inicio_index ON tbl_intersticio (data_inicio_intersticio);
CREATE INDEX data_fim_index ON tbl_intersticio (data_fim_intersticio);

CREATE TABLE tbl_carreira (
	id_carreira integer auto_increment NOT NULL,
	area varchar(80) not null,
	regime_trabalho varchar(50) not null,
	posicao_atual varchar(50) not null,
	cod_docente integer not null,
	cod_intersticio integer not null,
	CONSTRAINT tbl_carreira_pk PRIMARY KEY (id_carreira),
	CONSTRAINT tbl_carreira_docente_fk FOREIGN KEY (cod_docente) REFERENCES tbl_docente (id_docente),
	CONSTRAINT tbl_carreira_intersticio_fk FOREIGN KEY (cod_intersticio) REFERENCES tbl_intersticio (id_intersticio)
);

CREATE TABLE tbl_apendice (
	id_apendice integer auto_increment NOT NULL,
	nome_apendice varchar(50) not null,
	descricao_apendice varchar(80) not null,
	CONSTRAINT tbl_apendice_pk PRIMARY KEY (id_apendice)
);

CREATE TABLE tbl_intersticio_apendice(
	id_intersticio_apendice integer auto_increment not null,
	cod_intersticio integer not null,
	cod_apendice integer not null,
	pontuacao_docente smallint,
	nome_arquivo varchar (120),
    path varchar(150),
	pontuacao_cppd smallint,
	total_docente smallint, 
	total_cppd smallint,
	CONSTRAINT tbl_intersticio_apendice_pk PRIMARY KEY (id_intersticio_apendice),
	CONSTRAINT tbl_intersticio_apendice_intersticio_fk FOREIGN KEY (cod_intersticio) REFERENCES tbl_intersticio (id_intersticio),
	CONSTRAINT tbl_intersticio_apendice_apendice_fk FOREIGN KEY (cod_apendice) REFERENCES tbl_apendice (id_apendice)
);

CREATE TABLE tbl_item_apendice (
	id_item_apendice integer auto_increment NOT NULL,
	cod_apendice integer not null,
	desc_ativ_item text not null,
	CONSTRAINT tbl_item_apendice_pk PRIMARY KEY (id_item_apendice),
	CONSTRAINT tbl_item_apendice_apendice_apendice_fk FOREIGN KEY (cod_apendice) REFERENCES tbl_apendice (id_apendice)	
);

INSERT INTO tbl_tipo_docente (descricao_tipo_docente) VALUES ('Docente'), ('CPPD'), ('Admin');

INSERT INTO tbl_apendice (nome_apendice, descricao_apendice) VALUES 
('APÊNDICE - B', 'DAS ATIVIDADES DE ENSINO'), 
('APÊNDICE - C', 'DAS ATIVIDADES DE PESQUISA, PÓSGRADUAÇÃO E INOVAÇÃO'), 
('APÊNDICE - D', 'DAS ATIVIDADES DE EXTENSÃO'), 
('APÊNDICE - E', 'DAS ATIVIDADES ADMINISTRATIVOPEDAGÓGICAS'), 
('APÊNDICE - F', 'OUTRAS ATIVIDADES DOCENTES'), 
('APÊNDICE - G', 'AVALIAÇÃO FINAL');

INSERT INTO tbl_item_apendice (cod_apendice, desc_ativ_item) values 
(1, 'I. aulas no Ensino Básico e em suas formas de articulação com a Educação Profissional, Técnico de Nível Médio, Graduação, Aperfeiçoamento e Pós Graduação; aulas na Modalidade de EaD;
aulas em cursos de férias (durante os recessos); aulas em Nivelamento de Estudos, aulas de reforço e/ou outros Programas de Acesso e Permanência, treinamento esportivo permanente ou em
olimpíadas do conhecimento com estudantes matriculados - soma da carga horária semanal dos quatro semestres no interstício, um (1) ponto por aula;'),
(1, 'II. planejamento das aulas, avaliações e produção de material didático - 100% (cem por cento) da pontuação de cada atividade relacionada no inciso I deste artigo;'),
(1, 'III. orientação de Estágio Curricular Supervisionado - sem limite de estudantes, sendo dois (2) pontos por estudante;'),
(1, 'IV. orientação de Trabalho de Conclusão de Curso (TCC) Técnico de Nível Médio/estudante -  sem limite de estudantes, sendo três (3) pontos por estudante;'),
(1, 'V. orientação de TCC (monografia/artigo) Graduação - sem limite de estudantes, sendo quatro (4) pontos por estudante;'),
(1, 'VI. coorientação de TCC (monografia/artigo) Graduação - sem limite de estudantes, sendo dois (2) pontos por estudante;'),
(1, 'VII. atendimento regular ao discente constante no horário de trabalho - vinte (20) pontos no interstício sendo que a constatação deverá ocorrer no plano de trabalho do docente com pelo menos duas (2) horas/semana;'),
(1, 'VIII. coordenação de Programa de Monitoria e/ou Nivelamento - máximo um (1) programa/semestre, sendo quatro (4) pontos por programa;'),
(1, 'IX. orientação de Monitoria ou Nivelamento / monitor - máximo oito (8) monitores/interstício, sendo dois (2) pontos por monitor;'),
(1, 'X. supervisão de Atividades Complementares / curso - máximo um (1) curso/semestre, sendo quatro (4) pontos por curso;'),
(1, 'XI. supervisão de estágio do curso - máximo um (1) curso/semestre, sendo quatro (4) pontos por curso;'),
(1, 'XII. supervisão de Trabalhos de Conclusão de Curso (TCC) do curso - máximo um (1) curso/semestre, sendo quatro (4) pontos por curso;'),
(1, 'XIII. realização de visita técnica (responsável) ou acompanhamento em atividades extracurriculares (esportivas, artísticas, científicas, e afins ao ensino) - máximo quatro (4) visitas técnicas/semestre, sendo dois (2) pontos por visita;'),
(1, 'XIV. acréscimo de dois (2) pontos por turma excedente em cada semestre, quando o total de turmas em que o docente ministrar aulas for superior a quatro (4);'),
(1, 'XV. acréscimo de dois (2) pontos por componente curricular excedente, quando o total de componentes curriculares/disciplina em que o docente ministrar aulas for superior a três (3);'),
(1, 'XVI. projetos aprovados em editais da CAPES, que fomentam atividades de ensino dentro da instituição com bolsa e ou recursos financeiros (Programa Institucional de Bolsas de Iniciação à
Docência- PIBID Programa de Ensino Tutorial - PET, Pródocência, Jovens Talentos, Laboratórios Interdisciplinares de Formação de Educadores - LIFE, e similares) - sem limites sendo quinze (15) pontos por projeto aprovado.'),
(2, 'I. coordenação de Projetos de Pesquisa – máximo três (3) projetos/ano, sendo dez (10) pontos por projeto;'),
(2, 'II. participação em Projetos de Pesquisa – máximo seis (6) projetos/ano, sendo cinco (5) pontos por projeto;'),
(2, 'III. orientação de Trabalho de Iniciação Científica e Tecnológica/estudante – sem limites de estudantes/ano, sendo três (3) pontos por estudante;'),
(2, 'IV. orientação de TCC (monografia/artigo) Lato Sensu – sem limite de estudantes, sendo cinco (5) pontos por estudante;'),
(2, 'V. orientação de Dissertação (mestrado)/estudante – máximo dois (2) estudantes/ano, sendo oito (8) pontos por estudante;'),
(2, 'VI. orientação de Tese (doutorado)/estudante – máximo dois (2) estudantes/ano, sendo dez (10) pontos por estudante;'),
(2, 'VII. coorientação de Trabalho de Iniciação Científica e Tecnológica/estudante – sem limites de estudantes/ano, sendo um ponto e meio (1,5) por estudante;'),
(2, 'VIII. coorientação de TCC (monografia/artigo) Lato Sensu – sem limite de estudantes, sendo dois pontos e meio (2,5) por estudante;'),
(2, 'IX. coorientação de Dissertação (mestrado)/estudante – máximo dois (2) estudantes/ano, sendo quatro (4) pontos por estudante;'),
(2, 'X. coorientação de Tese (doutorado)/estudante – máximo dois (2) estudantes/ano, sendo cinco (5) pontos por estudante;'),
(2, 'XI. liderança de Grupo de Pesquisa / grupo – máximo um (1) grupo/ano, sendo quatro (4) pontos por grupo;'),
(2, 'XII. participação em grupo de pesquisa no IFTO ou outras Instituições – máximo dois (2) grupos/ano, sendo dois(2) pontos por grupo;'),
(2, 'XIII. publicação de artigo em periódico Qualis A1 e A2 – sem limite, sendo oito (8) pontos por artigo;'),
(2, 'XIV. publicação de artigo em periódico Qualis B1 e B2 – sem limite, sendo seis (6) pontos por artigo;'),
(2, 'XV. publicação de artigo em periódico Qualis B3 e B4 – sem limite, sendo quatro (4) pontos por artigo;'),
(2, 'XVI. publicação de artigo em periódico Qualis B5 e C – sem limite, sendo dois (2) pontos por artigo;'),
(2, 'XVII. publicação de artigo em periódico sem Qualis para qualificação – sem limite, sendo um (1) ponto por artigo;'),
(2, 'XVIII. aceite de artigo Qualis A – sem limite, sendo três (3) pontos por artigo;'),
(2, 'XIX. aceite de artigo Qualis B – sem limite, sendo um (1) ponto por artigo;'),
(2, 'XX. submissão de artigos para periódicos – máximo três (3) artigos/ano, sendo dois (2) pontos por artigo;'),
(2, 'XXI. produção e lançamento de software/produção de piloto/projeto/protótipo – sem limite, sendo dez (10) pontos por atividade;'),
(2, 'XXII. propriedade intelectual (processo, técnica, produtos e serviços) – patente, direito autoral – sem limite, sendo quinze (15) pontos por propriedade;'),
(2, 'XXIII. protocolo de depósito de propriedade intelectual – sem limite, sendo dois (2) pontos por protocolo;'),
(2, 'XXIV. revisão de periódico – sem limite, sendo quatro (4) pontos por periódico;'),
(2, 'XXV. atuação enquanto membro de corpo editorial – máximo um (1) por ano, sendo quatro (4) pontos por atividade;'),
(2, 'XXVI. obtenção de bolsa de produtividade CNPq – máximo uma (1) por ano, sendo quinze (15) pontos por bolsa;'),
(2, 'XXVII. atuação enquanto parecerista ad hoc em eventos – máximo dois (2) por ano, sendo dois (2) pontos por atividade;'),
(2, 'XXVIII. participação em painel, mesa redonda, congresso, conferência e similares – máximo dez (10) por ano, sendo dois (2) pontos por participação;'),
(2, 'XXIX. trabalho completo – evento nacional/internacional – sem limite, sendo quatro (4) pontos por trabalho;'),
(2, 'XXX. trabalho completo – evento local/regional – sem limite, sendo três (3) pontos por trabalho;'),
(2, 'XXXI. trabalho em resumo expandido – sem limites, sendo dois (2) pontos por trabalho;'),
(2, 'XXXII. trabalho em resumo simples – sem limites, sendo um (1) ponto por trabalho.'),
(3, 'I. coordenação de Projeto de Extensão/projeto – máximo dois (2) projetos por ano, sendo dez (10) pontos por projeto;'),
(3, 'II. participação em Projeto de Extensão/projeto – máximo dois (2) projetos por ano, sendo cinco (5) pontos por projeto;'),
(3, 'III. orientação de estudante em Projeto de Extensão/estudante – máximo três (3) estudantes por ano, sendo quatro (4) pontos por estudante;'),
(3, 'IV. coordenação de Comissão Organizadora de Eventos – máximo dois (2) por ano, sendo seis pontos (6) por coordenação;'),
(3, 'V. atuação enquanto membro de Comissão Organizadora de Eventos – sem limite, sendo dois (2) pontos por comissão;'),
(3, 'VI. realização de palestras internas e externas – sem limite, sendo três (3) pontos por palestra;'),
(3, 'VII. direção de espetáculo artístico (teatro, dança, música, visual, áudio) – máximo dois (2) por ano, sendo seis (6) pontos por espetáculo;'),
(3, 'VIII. atuação em espetáculo artístico (teatro, dança, música,visual, áudio) – máximo dois (2) por ano, sendo três (3) pontos por espetáculo;'),
(3, 'IX. criação ou atuação em performance – máximo dois (2) por ano, sendo dois (2) pontos por atividade;'),
(3, 'X. publicação de artigo livres em jornais – máximo seis (6) por ano, sendo um (1) ponto por atividade.'),
(4, 'I. presidência ou membro de Comissões, Órgãos Colegiados e Núcleo Docente Estruturante - NDE – sem limite, sendo dois (2) pontos por mês por portaria;'),
(4, 'II. coordenação de curso/área/eixo/nível/modalidade/núcleo – quatro (04) pontos por mês;'),
(4, 'III. atuação enquanto responsável técnico de curso - quatro (04) pontos/mês;'),
(4, 'IV. atuação enquanto responsável técnico de laboratório ou para as atividades que extrapolam as atribuições docentes e que remetam ao registro profissional do servidor – dois (2) pontos/mês;'),
(4, 'V. participação/acompanhamento de processo de compras, obras e serviços – sem limite, sendo três (3) pontos por mês;'),
(4, 'VI. cargo de direção CD1 e 2, sete (07) pontos por mês;'),
(4, 'VII. cargo de direção CD3 e 4, cinco (05) pontos por mês;'),
(4, 'VIII. presidência e membro de CPPD, Sindicância e Processo Administrativo Disciplinar - PAD – sem limite, sendo três (3) pontos por mês;'),
(4, 'IX. participação em reuniões pedagógicas previstas no calendário escolar/acadêmico e aquelas convocadas pela gerência/direção de ensino – sem limite, sendo dois pontos (2) por reunião;'),
(4, 'X. participação em reuniões pedagógicas convocadas por coordenações, máximo 20 pontos no interstício sendo um (1) ponto por reunião;'),
(5, 'I. participação em banca de avaliação de TCC – sem limite, sendo três (3) pontos por TCC;'),
(5, 'II. participação em banca de avaliação - sem limite, sendo dois (2) pontos por candidato;'),
(5, 'III. participação em bancas de avaliação e qualificação de mestrado e doutorado – sem limite, sendo seis pontos (6) por participação;'),
(5, 'IV. publicação de livro com ISBN – sem limite, sendo vinte (20) pontos por publicação;'),
(5, 'V. publicação de capítulo de livro com ISBN – sem limite, sendo dez (10) pontos por publicação;'),
(5, 'VI. organização de livro com ISBN – sem limite, sendo dez (10) pontos por atividade;'),
(5, 'VII. tradução de livro com ISBN – sem limite, sendo vinte (20) pontos por tradução;'),
(5, 'VIII. tradução de capítulo de livro e artigos completos com ISBN ou ISSN – sem limite, sendo dez (10) pontos por tradução;'),
(5, 'IX. atuação como intérprete em eventos realizados pelo IFTO sendo quatro (4) pontos por dia;'),
(5, 'X. elaboração de projeto técnico vinculado ao PDI – sem limite, sendo dez (10) pontos por projeto;'),
(5, 'XI. participação em cursos de qualificação e aperfeiçoamento – sem limite, sendo dois décimos de um ponto (0,2) por hora cursada;'),
(5, 'XII - participação como estudante em curso de graduação – máximo um (1) curso, sendo quatro (4) pontos por semestre;'),
(5, 'XIII - participação como estudante em cursos Lato Sensu – máximo um (1) curso por ano, sendo dezesseis (16) pontos por curso;'),
(5, 'XIV - participação como estudante em curso de mestrado ou doutorado em disciplina isolada – máximo uma (1) disciplina/semestre, sendo oito (8) pontos por disciplina;'),
(5, 'XV. participação como estudante em curso de mestrado, doutorado ou pós-doutorado com liberação parcial ou sem liberação – máximo um (1) curso, sendo três e meio pontos (3,5) por mês;'),
(5, 'XVI. participação como estudante em curso de mestrado, doutorado ou pós-doutorado com liberação total – máximo um (1) curso, sendo sete pontos (07) por mês;'),
(5, 'XVII. representações em conselhos, colegiados e comitês – máximo dois (2), sendo um ponto (1) por mês por portaria;'),
(5, 'XVIII. participação em reuniões externas de interesse do IFTO, sendo dois (2) pontos por reunião;'),
(5, 'XIX. participação em comissões externas de avaliação institucional e de cursos – máximo duas (2) comissões por ano, sendo dois (2) pontos por avaliação.'),
(5, 'XX. atuação enquanto parecerista ad hoc que não sejam inerentes a função – máximo dois (2) por ano, sendo dois (2) pontos por atividade;'),
(5, 'XXI. participação no Programa de Qualidade de Vida do IFTO documentado no setor de gestão de pessoas – sendo três (03) pontos pela adesão.'),
(6, 'AVALIAÇÃO DISCENTE'),
(6, 'DAS ATIVIDADES DE ENSINO'),
(6, 'DAS ATIVIDADES DE PESQUISA, PÓS-GRADUAÇÃO E INOVAÇÃO'),
(6, 'DAS ATIVIDADES DE EXTENSÃO'),
(6, 'DAS ATIVIDADES ADMINISTRATIVO-PEDAGÓGICAS'),
(6, 'OUTRAS ATIVIDADES DOCENTES'),
(6, 'DISPOSIÇÕES TRANSITÓRIAS DO REGULAMENTO');