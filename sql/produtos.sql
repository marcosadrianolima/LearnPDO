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