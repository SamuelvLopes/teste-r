 CREATE TABLE IF NOT EXISTS `teste2`.`clientes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL ,
  `cnpj` CHAR(14) NOT NULL UNIQUE,
  `status` INT NOT NULL,
  PRIMARY KEY (`id`)
  );
CREATE TABLE IF NOT EXISTS `teste2`.`contato` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_cliente` INT NULL,
  `nome_contato` VARCHAR(255) NOT NULL,
  `email_contato` VARCHAR(255) NOT NULL UNIQUE,
  `cpf` CHAR(11) NOT NULL UNIQUE,
  PRIMARY KEY (`id`),
  CONSTRAINT fk_id_cliente FOREIGN KEY (id_cliente) REFERENCES clientes (id)
  );
  

