-- Created by Vertabelo (http://vertabelo.com)
-- Script type: drop
-- Scope: [tables, references, sequences, views, procedures]
-- Generated at Thu Dec 04 05:38:48 UTC 2014



-- foreign keys
ALTER TABLE tb_quartos DROP FOREIGN KEY tbqua_fktipcod;
ALTER TABLE tb_reservas DROP FOREIGN KEY tbres_fkclicod;
ALTER TABLE tb_reservas DROP FOREIGN KEY tbres_fkquanum;
ALTER TABLE tb_usuarios DROP FOREIGN KEY tbusu_fkclicod;

-- tables
-- Table tb_clientes
DROP TABLE tb_clientes;
-- Table tb_quartos
DROP TABLE tb_quartos;
-- Table tb_reservas
DROP TABLE tb_reservas;
-- Table tb_tipos
DROP TABLE tb_tipos;
-- Table tb_usuarios
DROP TABLE tb_usuarios;



-- End of file.

