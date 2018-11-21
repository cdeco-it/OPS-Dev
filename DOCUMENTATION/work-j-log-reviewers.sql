-- MySQL Script generated by MySQL Workbench
-- 11/21/18 14:27:18
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
-- Table `OPSDev`.`work_j_rfisub_log_reviewers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `OPSDev`.`work_j_rfisub_log_reviewers` (
  `work_j_rfisub_log_reviewers_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `work_j_rfisub_log_id` INT UNSIGNED NOT NULL,
  `work_j_rfisub_log_reviewers_employee` INT UNSIGNED NULL,
  `work_j_rfisub_log_reviewers_consultants` INT UNSIGNED NULL,
  PRIMARY KEY (`work_j_rfisub_log_reviewers_id`),
  INDEX `fk_work_j_rfisub_log_reviewers_workj_rfisub_log_work_j_lo_idx` (`work_j_rfisub_log_id` ASC),
  INDEX `fk_j_rfisubs-j_consultant_idx` (`work_j_rfisub_log_reviewers_consultants` ASC),
  INDEX `fk_j_rfisubs-employee_idx` (`work_j_rfisub_log_reviewers_employee` ASC),
  CONSTRAINT `fk_j_rfisubs-employee`
    FOREIGN KEY (`work_j_rfisub_log_reviewers_employee`)
    REFERENCES `OPSDev`.`work_j_team` (`work_j_team_id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_j_rfisubs-log_id`
    FOREIGN KEY (`work_j_rfisub_log_id`)
    REFERENCES `OPSDev`.`work_j_rfisub_log` (`work_j_rfisub_log_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_j_rfisubs-j_consultant`
    FOREIGN KEY (`work_j_rfisub_log_reviewers_consultants`)
    REFERENCES `OPSDev`.`work_j_consultants` (`work_j_consultants_id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'work_j_rfisubs_log_reviewers - A child table that holds all related reviewers of RFI/Submittal entries.';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
