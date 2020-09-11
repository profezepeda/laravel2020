-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema laravel2019
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema laravel2019
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `laravel2019` DEFAULT CHARACTER SET utf8 ;
USE `laravel2019` ;

-- -----------------------------------------------------
-- Table `laravel2019`.`cargos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`cargos` (
  `idcargo` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cargo` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idcargo`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravel2019`.`regiones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`regiones` (
  `idregion` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `region` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idregion`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravel2019`.`comunas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`comunas` (
  `idcomuna` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comuna` VARCHAR(45) NOT NULL,
  `idregion` TINYINT(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`idcomuna`),
  INDEX `fk_comunas_regiones1_idx` (`idregion` ASC),
  CONSTRAINT `fk_comunas_regiones1`
    FOREIGN KEY (`idregion`)
    REFERENCES `laravel2019`.`regiones` (`idregion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravel2019`.`ciudades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`ciudades` (
  `idciudad` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ciudad` VARCHAR(45) NOT NULL,
  `idcomuna` MEDIUMINT(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`idciudad`),
  INDEX `fk_ciudades_comunas1_idx` (`idcomuna` ASC),
  CONSTRAINT `fk_ciudades_comunas1`
    FOREIGN KEY (`idcomuna`)
    REFERENCES `laravel2019`.`comunas` (`idcomuna`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravel2019`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `laravel2019`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`password_resets` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `password_resets_email_index` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `laravel2019`.`tiposusuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`tiposusuario` (
  `idtipousuario` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(20) NOT NULL,
  `modulo` VARCHAR(5) NULL DEFAULT NULL,
  PRIMARY KEY (`idtipousuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravel2019`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`users` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `username` VARCHAR(255) NOT NULL,
  `active` INT(11) NOT NULL DEFAULT '1',
  `idtipousuario` TINYINT(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC),
  UNIQUE INDEX `users_username_unique` USING BTREE (`username`),
  INDEX `fk_users_tiposusuario1_idx` (`idtipousuario` ASC),
  CONSTRAINT `fk_users_tiposusuario1`
    FOREIGN KEY (`idtipousuario`)
    REFERENCES `laravel2019`.`tiposusuario` (`idtipousuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `laravel2019`.`personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`personas` (
  `idpersona` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `rut` VARCHAR(45) NOT NULL,
  `primernombre` VARCHAR(45) NOT NULL,
  `segundonombre` VARCHAR(45) NOT NULL,
  `apellidopaterno` VARCHAR(45) NOT NULL,
  `apellidomaterno` VARCHAR(45) NOT NULL,
  `fechanacimiento` VARCHAR(45) NOT NULL,
  `sexo` ENUM('H', 'M') NOT NULL,
  `direccion_calle` VARCHAR(60) NULL DEFAULT NULL,
  `direccion_numero` VARCHAR(10) NULL DEFAULT NULL,
  `direccion_depto` VARCHAR(5) NULL DEFAULT NULL,
  `direccion_idciudad` MEDIUMINT(8) UNSIGNED NULL DEFAULT NULL,
  `foto_idtipoarchivo` TINYINT(3) UNSIGNED NULL DEFAULT NULL,
  `foto_contenido` BLOB NULL DEFAULT NULL,
  `salud_sangre` VARCHAR(10) NULL DEFAULT NULL,
  `salud_contraindicaciones` VARCHAR(45) NULL DEFAULT NULL,
  `fono` VARCHAR(45) NULL DEFAULT NULL,
  `fono_emergencia` VARCHAR(45) NULL DEFAULT NULL,
  `email_personal` VARCHAR(100) NULL DEFAULT NULL,
  `email_corporativo` VARCHAR(100) NULL DEFAULT NULL,
  `altura` VARCHAR(45) NULL DEFAULT NULL,
  `peso` VARCHAR(45) NULL DEFAULT NULL,
  `talla_zapato` VARCHAR(45) NULL DEFAULT NULL,
  `numero_hijos` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`idpersona`),
  INDEX `fk_personas_users1_idx` (`id` ASC),
  INDEX `fk_personas_ciudades1_idx` (`direccion_idciudad` ASC),
  CONSTRAINT `fk_personas_ciudades1`
    FOREIGN KEY (`direccion_idciudad`)
    REFERENCES `laravel2019`.`ciudades` (`idciudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personas_users1`
    FOREIGN KEY (`id`)
    REFERENCES `laravel2019`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 21
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravel2019`.`ptiposcontrato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`ptiposcontrato` (
  `idtipocontrato` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipocontrato` VARCHAR(30) NULL DEFAULT NULL,
  PRIMARY KEY (`idtipocontrato`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravel2019`.`pcontratos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`pcontratos` (
  `idpcontrato` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idccontrato` INT(10) UNSIGNED NULL DEFAULT NULL,
  `idpersona` INT(10) UNSIGNED NOT NULL,
  `numercontrato` VARCHAR(12) NULL DEFAULT NULL,
  `descripcion` VARCHAR(150) NULL DEFAULT NULL,
  `fechainicio` DATE NULL DEFAULT NULL,
  `fechatermino` DATE NULL DEFAULT NULL,
  `idtipocontrato` TINYINT(3) UNSIGNED NOT NULL,
  `fechaprecontrato` DATE NULL DEFAULT NULL,
  `sueldobase` INT(11) NULL DEFAULT NULL,
  `sueldoliquido` INT(11) NULL DEFAULT NULL,
  `idturno` TINYINT(3) UNSIGNED NOT NULL,
  `idseccion` MEDIUMINT(8) UNSIGNED NOT NULL,
  `idcargo` MEDIUMINT(8) UNSIGNED NOT NULL,
  `estado` TINYINT(4) NOT NULL COMMENT '0: Pre-Contrato\\n1: Aprobado por PR\\n2: Contrato\\n9: Rechazado por PR',
  `interno` TINYINT(4) NOT NULL,
  PRIMARY KEY (`idpcontrato`),
  INDEX `fk_pcontratos_personas1_idx` (`idpersona` ASC),
  INDEX `fk_pcontratos_ptiposcontrato1_idx` (`idtipocontrato` ASC),
  INDEX `fk_pcontratos_cargos1_idx` (`idcargo` ASC),
  CONSTRAINT `fk_pcontratos_cargos1`
    FOREIGN KEY (`idcargo`)
    REFERENCES `laravel2019`.`cargos` (`idcargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pcontratos_personas1`
    FOREIGN KEY (`idpersona`)
    REFERENCES `laravel2019`.`personas` (`idpersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pcontratos_ptiposcontrato1`
    FOREIGN KEY (`idtipocontrato`)
    REFERENCES `laravel2019`.`ptiposcontrato` (`idtipocontrato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 34
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravel2019`.`pr_documentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`pr_documentos` (
  `iddocumento` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(10) NOT NULL,
  `nombre` VARCHAR(150) NOT NULL,
  `sigla` VARCHAR(10) NOT NULL,
  `descripcion` MEDIUMTEXT NULL DEFAULT NULL,
  `idarea` MEDIUMINT(8) UNSIGNED NULL DEFAULT NULL,
  `idcargo` MEDIUMINT(8) UNSIGNED NULL DEFAULT NULL,
  `idtipoarchivo` TINYINT(3) UNSIGNED NULL DEFAULT NULL,
  `contenido` LONGBLOB NULL DEFAULT NULL,
  `tipodocumento` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0: Procedimientos\\n1: Instructivos\\n2: Reglamentos\\n3: Charlas',
  PRIMARY KEY (`iddocumento`),
  INDEX `fk_pr_documentos_cargos1_idx` (`idcargo` ASC),
  CONSTRAINT `fk_pr_documentos_cargos1`
    FOREIGN KEY (`idcargo`)
    REFERENCES `laravel2019`.`cargos` (`idcargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 38
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravel2019`.`pr_pruebas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`pr_pruebas` (
  `idprueba` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL DEFAULT NULL,
  `encargado_idpersona` INT(10) UNSIGNED NOT NULL,
  `iddocumento` INT(10) UNSIGNED NOT NULL,
  `habilitado` TINYINT(4) NOT NULL,
  PRIMARY KEY (`idprueba`),
  INDEX `fk_pr_pruebas_personas1_idx` (`encargado_idpersona` ASC),
  INDEX `fk_pr_pruebas_pr_documentos1_idx` (`iddocumento` ASC),
  CONSTRAINT `fk_pr_pruebas_personas1`
    FOREIGN KEY (`encargado_idpersona`)
    REFERENCES `laravel2019`.`personas` (`idpersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pr_pruebas_pr_documentos1`
    FOREIGN KEY (`iddocumento`)
    REFERENCES `laravel2019`.`pr_documentos` (`iddocumento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravel2019`.`pr_control`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`pr_control` (
  `idcontrol` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idprueba` INT(10) UNSIGNED NOT NULL,
  `idpersona` INT(10) UNSIGNED NOT NULL,
  `inicio` DATETIME NOT NULL,
  `termino` DATETIME NULL DEFAULT NULL,
  `puntaje` TINYINT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idcontrol`),
  INDEX `fk_pr_control_pr_pruebas1_idx` (`idprueba` ASC),
  INDEX `fk_pr_control_personas1_idx` (`idpersona` ASC),
  CONSTRAINT `fk_pr_control_personas1`
    FOREIGN KEY (`idpersona`)
    REFERENCES `laravel2019`.`personas` (`idpersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pr_control_pr_pruebas1`
    FOREIGN KEY (`idprueba`)
    REFERENCES `laravel2019`.`pr_pruebas` (`idprueba`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravel2019`.`pr_pruebaspreguntas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`pr_pruebaspreguntas` (
  `idpregunta` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idprueba` INT(10) UNSIGNED NOT NULL,
  `numero` TINYINT(4) NULL DEFAULT NULL,
  `pregunta` MEDIUMTEXT NOT NULL,
  `alternativa_a` VARCHAR(250) NOT NULL,
  `alternativa_b` VARCHAR(250) NOT NULL,
  `alternativa_c` VARCHAR(250) NOT NULL,
  `alternativa_d` VARCHAR(250) NOT NULL,
  `alternativacorrecta` ENUM('A', 'B', 'C', 'D') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idpregunta`),
  INDEX `fk_pr_pruebaspreguntas_pr_pruebas1_idx` (`idprueba` ASC),
  CONSTRAINT `fk_pr_pruebaspreguntas_pr_pruebas1`
    FOREIGN KEY (`idprueba`)
    REFERENCES `laravel2019`.`pr_pruebas` (`idprueba`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravel2019`.`pr_controlresp`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravel2019`.`pr_controlresp` (
  `idrespuesta` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idcontrol` INT(10) UNSIGNED NOT NULL,
  `idpregunta` INT(10) UNSIGNED NOT NULL,
  `alternativa` ENUM('A', 'B', 'C', 'D') NOT NULL,
  PRIMARY KEY (`idrespuesta`),
  INDEX `fk_pr_controlresp_pr_control1_idx` (`idcontrol` ASC),
  INDEX `fk_pr_controlresp_pr_pruebaspreguntas1_idx` (`idpregunta` ASC),
  CONSTRAINT `fk_pr_controlresp_pr_control1`
    FOREIGN KEY (`idcontrol`)
    REFERENCES `laravel2019`.`pr_control` (`idcontrol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pr_controlresp_pr_pruebaspreguntas1`
    FOREIGN KEY (`idpregunta`)
    REFERENCES `laravel2019`.`pr_pruebaspreguntas` (`idpregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
