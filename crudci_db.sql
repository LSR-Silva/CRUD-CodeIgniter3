CREATE TABLE usuarios(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user VARCHAR(225) UNIQUE NOT NULL,
    email VARCHAR(225) UNIQUE NOT NULL,
    senha VARCHAR(225) NOT NULL
);

CREATE TABLE grupos(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    grupo VARCHAR(50) NOT NULL,
    id_user INTEGER NOT NULL
);

CREATE TABLE grupos_contatos(
	id_contato_grupo INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_contato INTEGER NOT NULL,
    id_grupo INTEGER NOT NULL,
    grupo VARCHAR(50) NOT NULL,
    id_user INTEGER NOT NULL
);

CREATE TABLE contatos(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR (100) NOT NULL,
    nascimento VARCHAR(10) NOT NULL,
    cpf VARCHAR(15) UNIQUE NOT NULL,
    id_user INTEGER NOT NULL
);

CREATE TABLE emails(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    id_contato INTEGER NOT NULL,
    id_user INTEGER NOT NULL
);

CREATE TABLE phones(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    phone VARCHAR(15) NOT NULL UNIQUE,
    id_contato INTEGER NOT NULL,
    id_user INTEGER NOT NULL
);

-- INSERT INTO grupos(grupo, id_user) VALUES('Grupo 1', 1), ('Grupo 2', 1), ('Grupo 3', 1), ('Grupo 4', 1), ('Grupo 5', 1);

-- INSERT INTO contatos(nome, nascimento, cpf, id_user) VALUES('José', '20/05/1970', '189.411.610-02', 1), ('Maria', '15/08/1975', '587.265.290-92', 1), ('Guilherme', '06/07/1990', '027.887.720-68', 1), ('Ewerton', '21/04/1989', '844.851.140-90', 1), ('João', '01/12/2010', '857.252.280-88', 1), ('Pedro', '26/08/2002', '415.958.280-01', 1);

-- INSERT INTO grupos_contatos(id_contato, id_grupo, grupo, id_user) VALUES(1, 1, 'Grupo 1', 1), (1, 2, 'Grupo 2', 1), (1, 5,'Grupo 5', 1), (2, 3, 'Grupo 3', 1), (2, 4, 'Grupo 4', 1), (3, 5, 'Grupo 5', 1), (3, 3, 'Grupo 3', 1), (4, 4, 'Grupo 4', 1), (4, 1, 'Grupo 1', 1), (5, 1, 'Grupo 1', 1), (5, 2, 'Grupo 2', 1), (6, 3, 'Grupo 3', 1), (6, 2, 'Grupo 2', 1), (6, 1, 'Grupo 1', 1);

-- INSERT INTO emails(email, id_contato, id_user) VALUES('jose@mail.com', 1, 1), ('maria@mail.com', 2, 1), ('guilherme@mail.com', 3, 1), ('ewerton@mail.com', 4, 1),
-- ('joao@mail.com', 5, 1), ('pedro@mail.com', 6, 1), ('meu@mail.com', 3, 1);

-- INSERT INTO phones(phone, id_contato, id_user) VALUES('(81) 99999-9999', 1, 1), ('(81) 98888-8888', 2, 1), ('(81) 97777-7777', 3, 1), ('(81) 96666-6666', 4, 1), ('(81) 95555-5555', 5, 1), ('(81) 94444-4444', 6, 1), ('(83) 94598-7695', 5, 1), ('(85) 96325-4789', 1, 1), ('(11) 95568-8945', 3, 1), ('(11) 98467-5123', 6, 1), ('(11) 96648-7591', 4, 1), ('(83) 948596-1240', 2, 1);