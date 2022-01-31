-- Criando tabela para guardar unidades que serão utilizadas para saida de produtos
CREATE TABLE `produto_unidade` ( 
    `id` INT(11) NOT NULL , 
    `sigla` VARCHAR(20) NOT NULL , 
    `descricao` VARCHAR(150) NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `produto_categoria` ( 
    `id` INT(11) NOT NULL , 
    `nome` VARCHAR(20) NOT NULL , 
    `descricao` VARCHAR(150) NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `produto` ( 
    `id` INT(11) NOT NULL AUTO_INCREMENT , 
    `nome` VARCHAR(100) NOT NULL , 
    `descricao` TEXT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `produtos_categorias` ( 
    `id` INT(11) NOT NULL AUTO_INCREMENT , 
    `categoria_id` INT(11) NOT NULL , 
    `produto_id` INT(11) NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
ALTER TABLE `produtos_categorias` 
    ADD CONSTRAINT `FK_Produto_ID` 
    FOREIGN KEY (`produto_id`) 
    REFERENCES `produto`(`id`) 
    ON DELETE RESTRICT 
    ON UPDATE RESTRICT; 

ALTER TABLE `produtos_categorias` 
    ADD CONSTRAINT `FK_Categoria_ID` 
    FOREIGN KEY (`categoria_id`) 
    REFERENCES `produto_categoria`(`id`) 
    ON DELETE RESTRICT 
    ON UPDATE RESTRICT;