-- MySQL Script generated by MySQL Workbench
-- Mon Mar 13 13:38:05 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Restolerance
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Restolerance
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Restolerance` DEFAULT CHARACTER SET utf8 ;
USE `Restolerance` ;

-- -----------------------------------------------------
-- Table `Restolerance`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Restolerance`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lastname` VARCHAR(80) NOT NULL,
  `firstname` VARCHAR(80) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phonenumber` VARCHAR(15) NOT NULL,
  `password` VARCHAR(60) NOT NULL,users
  `usertype` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UniqueUser` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Restolerance`.`plates`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Restolerance`.`plates` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` VARCHAR(500) NOT NULL,
  `price` DECIMAL(5,2) NOT NULL,
  `image` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UniquePlate` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Restolerance`.`intolerances`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Restolerance`.`intolerances` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UniqueIntolerance` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Restolerance`.`plates_contain_intolerances`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Restolerance`.`plates_contain_intolerances` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `plate_id` INT NOT NULL,
  `intolerance_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_plates_has_intolerances_intolerances1_idx` (`intolerance_id` ASC) VISIBLE,
  INDEX `fk_plates_has_intolerances_plates_idx` (`plate_id` ASC) VISIBLE,
  UNIQUE INDEX `UniqueContain` (`plate_id` ASC, `intolerance_id` ASC) INVISIBLE,
  CONSTRAINT `fk_plates_has_intolerances_plates`
    FOREIGN KEY (`plate_id`)
    REFERENCES `Restolerance`.`plates` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plates_has_intolerances_intolerances1`
    FOREIGN KEY (`intolerance_id`)
    REFERENCES `Restolerance`.`intolerances` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Restolerance`.`users_select_intolerances`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Restolerance`.`users_select_intolerances` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `intolerance_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_has_intolerances_intolerances1_idx` (`intolerance_id` ASC) VISIBLE,
  INDEX `fk_users_has_intolerances_users1_idx` (`user_id` ASC) VISIBLE,
  UNIQUE INDEX `UniqueSelect` (`user_id` ASC, `intolerance_id` ASC) INVISIBLE,
  CONSTRAINT `fk_users_has_intolerances_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `Restolerance`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_intolerances_intolerances1`
    FOREIGN KEY (`intolerance_id`)
    REFERENCES `Restolerance`.`intolerances` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Restolerance`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Restolerance`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UniqueOrder` (`id` ASC) VISIBLE,
  INDEX `fk_orders_users1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_orders_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `Restolerance`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Restolerance`.`plates_contain_orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Restolerance`.`plates_contain_orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `quantity` INT(3) NOT NULL,
  `plate_id` INT NOT NULL,
  `order_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_plates_has_orders_orders1_idx` (`order_id` ASC) VISIBLE,
  INDEX `fk_plates_has_orders_plates1_idx` (`plate_id` ASC) VISIBLE,
  INDEX `UniqueContain` (`plate_id` ASC, `order_id` ASC) VISIBLE,
  CONSTRAINT `fk_plates_has_orders_plates1`
    FOREIGN KEY (`plate_id`)
    REFERENCES `Restolerance`.`plates` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plates_has_orders_orders1`
    FOREIGN KEY (`order_id`)
    REFERENCES `Restolerance`.`orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
