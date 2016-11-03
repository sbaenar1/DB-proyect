-- MySQL Script generated by MySQL Workbench
-- Mon Oct 31 13:58:32 2016
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Informacion_Contacto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Informacion_Contacto` (
  `Telefono` INT NOT NULL,
  `Direccion` VARCHAR(20) NULL,
  PRIMARY KEY (`Telefono`),
  UNIQUE INDEX `Telefono_UNIQUE` (`Telefono` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Universidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Universidades` (
  `idUniversidades` SMALLINT UNSIGNED NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `Informacion_Contacto_Telefono` INT NOT NULL,
  PRIMARY KEY (`idUniversidades`),
  UNIQUE INDEX `Nombre_UNIQUE` (`nombre` ASC),
  INDEX `fk_Universidades_Informacion_Contacto1_idx` (`Informacion_Contacto_Telefono` ASC),
  CONSTRAINT `fk_Universidades_Informacion_Contacto1`
    FOREIGN KEY (`Informacion_Contacto_Telefono`)
    REFERENCES `mydb`.`Informacion_Contacto` (`Telefono`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Representantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Representantes` (
  `idRepresentante` INT UNSIGNED NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `telefono` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idRepresentante`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tipo_Artista_Evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tipo_Artista_Evento` (
  `Tipo` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`Tipo`),
  UNIQUE INDEX `Tipo_UNIQUE` (`Tipo` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Artistas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Artistas` (
  `idArtistas` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `pais` SMALLINT UNSIGNED NULL,
  `Representantes_idRepresentante` INT UNSIGNED NOT NULL,
  `Tipo_Artista_Evento_Tipo` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`idArtistas`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC),
  INDEX `fk_Artistas_Representantes_idx` (`Representantes_idRepresentante` ASC),
  INDEX `fk_Artistas_Tipo_Artista_Evento1_idx` (`Tipo_Artista_Evento_Tipo` ASC),
  CONSTRAINT `fk_Artistas_Representantes`
    FOREIGN KEY (`Representantes_idRepresentante`)
    REFERENCES `mydb`.`Representantes` (`idRepresentante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Artistas_Tipo_Artista_Evento1`
    FOREIGN KEY (`Tipo_Artista_Evento_Tipo`)
    REFERENCES `mydb`.`Tipo_Artista_Evento` (`Tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Escenarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Escenarios` (
  `idEscenarios` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `capacidad` SMALLINT UNSIGNED NULL,
  `Informacion_Contacto_Telefono` INT NOT NULL,
  PRIMARY KEY (`idEscenarios`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC),
  INDEX `fk_Escenarios_Informacion_Contacto1_idx` (`Informacion_Contacto_Telefono` ASC),
  CONSTRAINT `fk_Escenarios_Informacion_Contacto1`
    FOREIGN KEY (`Informacion_Contacto_Telefono`)
    REFERENCES `mydb`.`Informacion_Contacto` (`Telefono`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Eventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Eventos` (
  `idEventos` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `horaInicio` TIME NOT NULL,
  `horaFinalizacion` TIME NULL,
  `fecha` DATE NOT NULL,
  `descripcion` TEXT NULL,
  `Universidades_idUniversidades` SMALLINT UNSIGNED NOT NULL,
  `Escenarios_idEscenarios` MEDIUMINT UNSIGNED NOT NULL,
  `Tipo_Artista_Evento_Tipo` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`idEventos`),
  INDEX `fk_Eventos_Universidades1_idx` (`Universidades_idUniversidades` ASC),
  INDEX `fk_Eventos_Escenarios1_idx` (`Escenarios_idEscenarios` ASC),
  INDEX `fk_Eventos_Tipo_Artista_Evento1_idx` (`Tipo_Artista_Evento_Tipo` ASC),
  CONSTRAINT `fk_Eventos_Universidades1`
    FOREIGN KEY (`Universidades_idUniversidades`)
    REFERENCES `mydb`.`Universidades` (`idUniversidades`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Eventos_Escenarios1`
    FOREIGN KEY (`Escenarios_idEscenarios`)
    REFERENCES `mydb`.`Escenarios` (`idEscenarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Eventos_Tipo_Artista_Evento1`
    FOREIGN KEY (`Tipo_Artista_Evento_Tipo`)
    REFERENCES `mydb`.`Tipo_Artista_Evento` (`Tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Puntos_de_Venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Puntos_de_Venta` (
  `idPuntos_de_Venta` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `Informacion_Contacto_Telefono` INT NOT NULL,
  PRIMARY KEY (`idPuntos_de_Venta`),
  INDEX `fk_Puntos_de_Venta_Informacion_Contacto1_idx` (`Informacion_Contacto_Telefono` ASC),
  CONSTRAINT `fk_Puntos_de_Venta_Informacion_Contacto1`
    FOREIGN KEY (`Informacion_Contacto_Telefono`)
    REFERENCES `mydb`.`Informacion_Contacto` (`Telefono`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Boletas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Boletas` (
  `idBoletas` SMALLINT NOT NULL,
  `localidad` VARCHAR(20) NULL,
  `valor` INT UNSIGNED NULL,
  `Eventos_idEventos` INT UNSIGNED NOT NULL,
  `Puntos_de_Venta_idPuntos_de_Venta` INT UNSIGNED NOT NULL,
  `Disponible` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`idBoletas`, `Eventos_idEventos`),
  INDEX `fk_Boletas_Eventos1_idx` (`Eventos_idEventos` ASC),
  INDEX `fk_Boletas_Puntos_de_Venta1_idx` (`Puntos_de_Venta_idPuntos_de_Venta` ASC),
  CONSTRAINT `fk_Boletas_Eventos1`
    FOREIGN KEY (`Eventos_idEventos`)
    REFERENCES `mydb`.`Eventos` (`idEventos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Boletas_Puntos_de_Venta1`
    FOREIGN KEY (`Puntos_de_Venta_idPuntos_de_Venta`)
    REFERENCES `mydb`.`Puntos_de_Venta` (`idPuntos_de_Venta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Participacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Participacion` (
  `Eventos_idEventos` INT UNSIGNED NOT NULL,
  `Artistas_idArtistas` INT UNSIGNED NOT NULL,
  INDEX `fk_Participacion_Eventos1_idx` (`Eventos_idEventos` ASC),
  INDEX `fk_Participacion_Artistas1_idx` (`Artistas_idArtistas` ASC),
  PRIMARY KEY (`Eventos_idEventos`, `Artistas_idArtistas`),
  CONSTRAINT `fk_Participacion_Eventos1`
    FOREIGN KEY (`Eventos_idEventos`)
    REFERENCES `mydb`.`Eventos` (`idEventos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Participacion_Artistas1`
    FOREIGN KEY (`Artistas_idArtistas`)
    REFERENCES `mydb`.`Artistas` (`idArtistas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Administradores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Administradores` (
  `idAdministradores` INT NOT NULL,
  `Usuario` VARCHAR(45) NOT NULL,
  `Contraseña` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idAdministradores`),
  UNIQUE INDEX `Usuario_UNIQUE` (`Usuario` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;