-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema noticiast88
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema noticiast88
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `noticiast88` DEFAULT CHARACTER SET utf8mb4 ;
USE `noticiast88` ;

-- -----------------------------------------------------
-- Table `noticiast88`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `noticiast88`.`categorias` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB
COMMENT = 'Categorias das notícias.';


-- -----------------------------------------------------
-- Table `noticiast88`.`niveis_de_acessos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `noticiast88`.`niveis_de_acessos` (
  `id_nivel_de_acesso` INT NOT NULL AUTO_INCREMENT,
  `nivel_de_acesso` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_nivel_de_acesso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `noticiast88`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `noticiast88`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `id_nivel_de_acesso` INT NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `senha` VARCHAR(200) NOT NULL,
  `nome` VARCHAR(200) NOT NULL,
  `foto` VARCHAR(45) NULL,
  `perfil` TEXT NULL,
  `ddd` VARCHAR(45) NULL,
  `celular` VARCHAR(45) NULL,
  `dt_cadastro` DATE NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_usuarios_niveis_de_acessos_idx` (`id_nivel_de_acesso` ASC),
  CONSTRAINT `fk_usuarios_niveis_de_acessos`
    FOREIGN KEY (`id_nivel_de_acesso`)
    REFERENCES `noticiast88`.`niveis_de_acessos` (`id_nivel_de_acesso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `noticiast88`.`noticias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `noticiast88`.`noticias` (
  `id_noticia` INT NOT NULL AUTO_INCREMENT,
  `id_categoria` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `data` DATETIME NOT NULL,
  `titulo` VARCHAR(200) NOT NULL,
  `conteudo` TEXT NOT NULL,
  `subtitulo` VARCHAR(200) NULL,
  `foto` VARCHAR(45) NULL,
  `video` VARCHAR(200) NULL,
  PRIMARY KEY (`id_noticia`),
  INDEX `fk_noticias_categorias_idx` (`id_categoria` ASC),
  INDEX `fk_noticias_usuarios_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_noticias_categorias`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `noticiast88`.`categorias` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_noticias_usuarios`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `noticiast88`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `noticiast88`.`comentarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `noticiast88`.`comentarios` (
  `id_comentario` INT NOT NULL AUTO_INCREMENT,
  `id_noticia` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `comentario` TEXT NOT NULL,
  `data` DATETIME NOT NULL,
  PRIMARY KEY (`id_comentario`),
  INDEX `fk_comentarios_noticias_idx` (`id_noticia` ASC),
  INDEX `fk_comentarios_usuarios_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_comentarios_noticias`
    FOREIGN KEY (`id_noticia`)
    REFERENCES `noticiast88`.`noticias` (`id_noticia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentarios_usuarios`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `noticiast88`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `noticiast88`.`usuarios_categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `noticiast88`.`usuarios_categorias` (
  `id_usuario_categoria` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `id_categoria` INT NOT NULL,
  PRIMARY KEY (`id_usuario_categoria`),
  INDEX `fk_usuarios_cat_usuarios_idx` (`id_usuario` ASC),
  INDEX `fk_usaurios_cat_categorias_idx` (`id_categoria` ASC),
  CONSTRAINT `fk_usuarios_cat_usuarios`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `noticiast88`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usaurios_cat_categorias`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `noticiast88`.`categorias` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `noticiast88`.`anuncios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `noticiast88`.`anuncios` (
  `id_anuncio` INT NOT NULL AUTO_INCREMENT,
  `anuncio` VARCHAR(200) NOT NULL,
  `url` VARCHAR(200) NULL,
  `inicio` DATE NOT NULL,
  `termino` DATE NOT NULL,
  `exibicoes` INT NULL,
  PRIMARY KEY (`id_anuncio`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
