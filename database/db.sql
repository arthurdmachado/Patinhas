CREATE DATABASE patinha_segura;
USE patinha_segura;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
);

CREATE TABLE animais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    raca VARCHAR(200) NOT NULL,
    clientes_id INT, 
    FOREIGN KEY (clientes_id) REFERENCES clientes(id)
);