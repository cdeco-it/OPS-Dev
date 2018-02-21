-- MySQL Script generated by MySQL Workbench
-- 11/08/17 11:08:53
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema OPSDev
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema OPSDev
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `OPSDev` DEFAULT CHARACTER SET utf8 ;
USE `OPSDev` ;

-- -----------------------------------------------------
-- Table `OPSDev`.`work_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OPSDev`.`work_status` (
  `work_status_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `work_status_desc` VARCHAR(100) NULL,
  PRIMARY KEY (`work_status_id`))
ENGINE = InnoDB
COMMENT = 'work_status - A lookup table of all work status that a Work assignment as well as independent phases under a Work assignment.';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;