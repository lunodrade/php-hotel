-- Created by Vertabelo (http://vertabelo.com)
-- Script type: create
-- Scope: [tables, references, sequences, views, procedures]
-- Generated at Fri Nov 14 12:07:23 UTC 2014




-- tables
-- Table: tb_clientes
-- Tabela com informações dos Clientes.

CREATE TABLE tb_clientes (
    pk_cli_cod int    NOT NULL  AUTO_INCREMENT,
    cli_nome varchar(100)    NOT NULL ,
    cli_nasc date    NOT NULL ,
    cli_rg bigint    NOT NULL ,
    cli_cpf bigint    NOT NULL ,
    CONSTRAINT tb_clientes_pk PRIMARY KEY (pk_cli_cod)
);

-- Table: tb_quartos
-- Tabela com informações dos quartos.

CREATE TABLE tb_quartos (
    pk_qua_num int    NOT NULL ,
    qua_status bool    NOT NULL ,
    fk_tip_cod int    NOT NULL ,
    CONSTRAINT tb_quartos_pk PRIMARY KEY (pk_qua_num)
);

-- Table: tb_reservas
-- Tabela que armazena os dados das reservas (tanto as já utilizadas como as futuras).

CREATE TABLE tb_reservas (
    pk_res_cod int    NOT NULL  AUTO_INCREMENT,
    res_in timestamp    NOT NULL ,
    res_out timestamp    NOT NULL ,
    res_val double(10,2)    NOT NULL ,
    fk_qua_num int    NOT NULL ,
    fk_cli_cod int    NOT NULL ,
    CONSTRAINT tb_reservas_pk PRIMARY KEY (pk_res_cod)
);

-- Table: tb_tipos
-- Tabela com informações dos tipos de quartos.

CREATE TABLE tb_tipos (
    pk_tip_cod int    NOT NULL  AUTO_INCREMENT,
    tip_nome varchar(20)    NOT NULL ,
    tip_val double(6,2)    NOT NULL ,
    tip_desc varchar(80)    NOT NULL ,
    CONSTRAINT tb_tipos_pk PRIMARY KEY (pk_tip_cod)
);

-- Table: tb_usuarios
-- Tabela que armazena os usuários de login no sistema online.

CREATE TABLE tb_usuarios (
    pk_usu_cod int    NOT NULL  AUTO_INCREMENT,
    usu_nome varchar(50)    NOT NULL ,
    usu_email varchar(100)    NOT NULL ,
    usu_senha varchar(50)    NOT NULL ,
    usu_tipo varchar(20)    NOT NULL ,
    fk_cli_cod int    NULL ,
    CONSTRAINT tb_usuarios_pk PRIMARY KEY (pk_usu_cod)
);





-- foreign keys
-- Reference:  tbqua_fktipcod (table: tb_quartos)
-- Um Quarto tem 1 tipo.
-- Um tipo pode ter nenhum ou quantos quartos quiser.


ALTER TABLE tb_quartos ADD CONSTRAINT tbqua_fktipcod FOREIGN KEY tbqua_fktipcod (fk_tip_cod)
    REFERENCES tb_tipos (pk_tip_cod);
-- Reference:  tbres_fkclicod (table: tb_reservas)
-- Uma reserva tem 1 cliente.
-- Um cliente pode ter 1 ou mais reservas.


ALTER TABLE tb_reservas ADD CONSTRAINT tbres_fkclicod FOREIGN KEY tbres_fkclicod (fk_cli_cod)
    REFERENCES tb_clientes (pk_cli_cod);
-- Reference:  tbres_fkquanum (table: tb_reservas)
-- Uma reserva tem 1 quarto.
-- Um quarto pode ter nenhuma ou quantas reservas quiser.


ALTER TABLE tb_reservas ADD CONSTRAINT tbres_fkquanum FOREIGN KEY tbres_fkquanum (fk_qua_num)
    REFERENCES tb_quartos (pk_qua_num);
-- Reference:  tbusu_fkclicod (table: tb_usuarios)
-- Um cliente obrigatoriamente possui um - e somente um - usuário de login.
-- Um usuario possui um ou nenhum cliente (caso for somente uma conta de admin, por exemplo, não há necessidade de cliente pra ele)


ALTER TABLE tb_usuarios ADD CONSTRAINT tbusu_fkclicod FOREIGN KEY tbusu_fkclicod (fk_cli_cod)
    REFERENCES tb_clientes (pk_cli_cod);




-- Inserindo Clientes
INSERT INTO tb_clientes
(cli_nome,  cli_nasc,    cli_rg,   cli_cpf) 
VALUES
('Luciano', '1990-8-22',   1154452018, 42254908012),
('Ana',    '1980-2-2',   1104414504, 02024232313),
('Bruna', '1993-4-12',   1107300418, 12312453456),
('Carlos', '1994-8-21',   2738756418, 03423189045),
('Juliano', '1985-7-16',   4530325348, 12352525245),
('Maicon', '1974-10-2',   1404553418, 04533188534),
('Jean', '1994-6-13',   4540534638, 11241008008),
('Diego', '1986-5-4',   1424383418, 02045413058),
('Fernanda','1992-3-7',   1547387818, 45343787567),
('Paula', '1986-2-12',   1465732418, 02756754508),
('Suelen', '1995-4-30',   1121243418, 45153858456);

-- Inserindo Tipos de quartos
INSERT INTO tb_tipos
(tip_nome,  tip_val,  tip_desc) 
VALUES
('Simples', 49.99,   'Um quarto simples, com uma cama de casal apenas.'),
('Duplo',  69.99,   'Um quarto simples, com duas camas de solteiro.'),
('Luxo',  99.99,   'Um quarto luxuoso, com uma cama de casal, banheira e outros detalhes.');

-- Inserindo os quartos
INSERT INTO tb_quartos
(pk_qua_num,  qua_status, fk_tip_cod) 
VALUES
(101,    true,   1),
(102,    false,   1),
(103,    true,   2),
(104,    true,   1),
(105,    true,   1),
(106,    true,   2),
(201,   true,   3),
(202,    true,   3);

-- Inserindo as reservas
INSERT INTO tb_reservas
(res_in,     res_out,     res_val,  fk_qua_num, fk_cli_cod) 
VALUES                                                  
('2014-11-12 13:00:00', '2014-11-13 12:00:00',  1.99,   101,   4),
('2014-11-15 13:00:00', '2014-11-16 12:00:00',  1.99,   101,   1),
('2014-11-20 13:00:00', '2014-11-23 12:00:00',  1.99,   101,   2),
('2014-11-18 13:00:00', '2014-11-19 12:00:00',  1.99,   102,   1),
('2014-11-13 13:00:00', '2014-11-14 12:00:00',  1.99,   103,   2),
('2014-11-16 13:00:00', '2014-11-19 12:00:00',  1.99,   104,   3),
('2014-11-18 13:00:00', '2014-11-20 12:00:00',  1.99,   105,   6),
('2014-11-13 13:00:00', '2014-11-15 12:00:00',  1.99,   106,   5),
('2014-11-19 13:00:00', '2014-11-21 12:00:00',  1.99,   201,   7),
('2014-11-12 13:00:00', '2014-11-14 12:00:00',  1.99,   202,   8),
('2014-11-14 13:00:00', '2014-11-15 12:00:00',  1.99,   202,   10);


-- End of file.

