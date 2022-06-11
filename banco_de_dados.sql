CREATE DATABASE tarefas;
USE tarefas;

CREATE TABLE tb_status(
	id INT NOT NULL PRIMARY KEY auto_increment,
    status VARCHAR(25) NOT NULL
);

INSERT INTO tb_status(status)VALUES('pendente');
INSERT INTO tb_status(status)VALUES('realizado');

CREATE TABLE tb_tarefas(
	id INT NOT NULL PRIMARY KEY auto_increment,
    id_status INT NOT NULL DEFAULT 1,
    FOREIGN KEY(id_status) REFERENCES tb_status(id),
	tarefa TEXT NOT NULL,
    data_cadastrado DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DELIMITER //
CREATE PROCEDURE inserir (
	IN tarefax TEXT
)
BEGIN
	INSERT INTO tb_tarefas (tarefa) VALUES 
    (tarefax);
END //

DELIMITER ;

DELIMITER //
CREATE PROCEDURE update_tarefas (
	IN tarefax TEXT,
	IN idx INT
)
BEGIN
	UPDATE tb_tarefas SET tarefa = tarefax WHERE id = idx;
END //

DELIMITER ;
