CREATE TABLE anunciante (
  idAnunciante INT AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  cpf VARCHAR(20) NOT NULL,
  email VARCHAR(45) NULL,
  senhaHash VARCHAR(255) NULL,
  telefone INT NULL,
  PRIMARY KEY(idAnunciante)
)ENGINE=InnoDB;

CREATE TABLE anuncio (
  idAnuncio INT AUTO_INCREMENT,
  titulo VARCHAR(20) NOT NULL,
  descricao VARCHAR(255) NOT NULL,
  preco FLOAT NOT NULL,
  dataHora DATETIME NULL,
  cep VARCHAR(10) NOT NULL,
  bairro VARCHAR(30) NULL,
  cidade VARCHAR(30) NULL,
  estado VARCHAR(30) NULL,
  idAnunciante INT NOT NULL,
  idCategoria INT NOT NULL,
  PRIMARY KEY(idAnuncio, idAnunciante),
  INDEX anuncio_FK_index1(idAnunciante),
  INDEX anuncio_FK_index2(idCategoria)
);

CREATE TABLE baseEndAjax (
  cep INT NULL,
  cidade VARCHAR(30) NULL,
  estado VARCHAR(20) NULL
)ENGINE=InnoDB;

CREATE TABLE categoria (
  idCategoria INT AUTO_INCREMENT,
  nome VARCHAR(20) NOT NULL,
  descricao VARCHAR(255) NOT NULL,
  PRIMARY KEY(idCategoria)
)ENGINE=InnoDB;

CREATE TABLE foto (
  nomeArqFoto VARCHAR(50) NOT NULL,
  idAnuncio INT NULL,
  PRIMARY KEY(idAnuncio),
  INDEX foto_FK(idAnuncio)
)ENGINE=InnoDB;

CREATE TABLE interesse (
  idInteresse INT AUTO_INCREMENT,
  mensagem VARCHAR(255) NOT NULL,
  dataHora DATETIME NOT NULL,
  contato INT NOT NULL,
  PRIMARY KEY(idInteresse),
  idAnuncio INT NOT NULL,
  INDEX interesse_FK(idAnuncio)
)ENGINE=InnoDB;