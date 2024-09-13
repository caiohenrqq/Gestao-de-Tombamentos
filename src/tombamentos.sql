CREATE DATABASE tombamentos;
USE tombamentos

CREATE TABLE tecnicos
(
	id int unsigned not null auto_increment,
    nome varchar(50) not null,
    email varchar(50) not null,
    PRIMARY KEY(id)
);

ALTER TABLE tecnicos 
ADD COLUMN senha varchar(255) not null;
	