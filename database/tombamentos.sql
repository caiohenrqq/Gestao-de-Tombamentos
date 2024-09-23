CREATE DATABASE tombamentos;
USE tombamentos;

CREATE TABLE tecnicos (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
);

ALTER TABLE tecnicos 
ADD COLUMN senha varchar(255) not null;
    
SELECT * FROM tecnicos;

CREATE TABLE tombamentos (
  tombamento_id INT UNSIGNED NOT NULL,
  secretaria VARCHAR(50) NOT NULL,
  tecnico VARCHAR(50) NOT NULL,
  entrada DATETIME NOT NULL,
  saida DATETIME NOT NULL,
  prioridade INT UNSIGNED NOT NULL,
  status INT UNSIGNED NOT NULL,
  PRIMARY KEY (tombamento_id)
);