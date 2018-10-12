# [RELEASE NOTES]

## BANCO MYSQL

CREATE SCHEMA `agenda` ;

CREATE TABLE `agenda`.`grupo` (
  `idgrupo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`idgrupo`));
  
  
  CREATE TABLE `agenda`.`contatos` (
  `idcontatos` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL,
  `telefone` VARCHAR(14) NULL,
  `email` VARCHAR(70) NULL,
  `grupo_idgrupo` INT NULL,
  PRIMARY KEY (`idcontatos`),
  INDEX `grupo_idgrupo_idx` (`grupo_idgrupo` ASC),
  CONSTRAINT `grupo_idgrupo`
    FOREIGN KEY (`grupo_idgrupo`)
    REFERENCES `agenda`.`grupo` (`idgrupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


## Instalação

Utilização do Zend Framework 1.11.11

* Necessário ter a seguinte hierarquia de pasta para rodar o zend: ..\htdocs\biblioteca\php\zend\zend-1.11.11\
* Necessário ter a seguinte hierarquia de pasta para a aplicacao: ..\htdocs\aplicacao\
* Mover a pasta \htdocs\aplicacao\zend-1.11.11\ para \htdocs\biblioteca\php\zend\zend-1.11.11\

* Configurar conexão de banco de dados no arquivo /config/configAgendaTelefonica.ini

## Contato

Wagner Lamoglia <wagnyero@gmail.com> 021976003581
