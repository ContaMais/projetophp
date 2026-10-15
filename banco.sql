CREATE DATABASE IF NOT EXISTS meu_projeto;
USE meu_projeto;

CREATE TABLE IF NOT EXISTS cadastro (
  nome VARCHAR(35) NOT NULL,
  email VARCHAR(25) NOT NULL,
  cidade VARCHAR(35) NOT NULL,
  estado VARCHAR(2) NOT NULL,
  comentarios TEXT NOT NULL
);