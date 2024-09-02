-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema prova
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema prova
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `prova` DEFAULT CHARACTER SET utf8mb4 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `prova`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`users` (
  `users_id` INT(11) NOT NULL AUTO_INCREMENT,
  `users_uid` VARCHAR(11) NOT NULL,
  `users_pwd` LONGTEXT NOT NULL,
  `users_email` TINYTEXT NOT NULL,
  `cuentaActiva` TINYINT(1) NOT NULL,
  `token` VARCHAR(45) NOT NULL,
  `deadLine` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`users_uid`),
  UNIQUE INDEX `users_id_UNIQUE` (`users_id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `prova`.`pisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`pisos` (
  `idPis` INT(5) NOT NULL AUTO_INCREMENT,
  `uidpis` VARCHAR(30) NOT NULL,
  `tipus` TINYINT(1) NOT NULL,
  `numHabitacions` INT(2) NOT NULL,
  `numLavabos` INT(2) NOT NULL,
  `users_users_uid` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`idPis`),
  UNIQUE INDEX `uidpis` (`uidpis` ASC) ,
  INDEX `fk_pisos_users_idx1` (`users_users_uid` ASC) ,
  CONSTRAINT `fk_pisos_users`
    FOREIGN KEY (`users_users_uid`)
    REFERENCES `prova`.`users` (`users_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `mydb`.`reservas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`reservas` (
  `idreservas` INT NOT NULL AUTO_INCREMENT,
  `fechaSolicitud` DATETIME NOT NULL,
  `pisos_idPis` INT(5) NOT NULL,
  `users_users_uid` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`idreservas`),
  INDEX `fk_reservas_pisos1_idx` (`pisos_idPis` ASC) ,
  INDEX `fk_reservas_users1_idx` (`users_users_uid` ASC) ,
  CONSTRAINT `fk_reservas_pisos1`
    FOREIGN KEY (`pisos_idPis`)
    REFERENCES `prova`.`pisos` (`idPis`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservas_users1`
    FOREIGN KEY (`users_users_uid`)
    REFERENCES `prova`.`users` (`users_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `prova` ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
