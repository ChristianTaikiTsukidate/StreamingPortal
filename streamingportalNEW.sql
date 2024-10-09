-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema streamingportal
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema streamingportal
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `streamingportal` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `streamingportal` ;

-- -----------------------------------------------------
-- Table `streamingportal`.`providers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`providers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `affiliateLink` VARCHAR(255) NOT NULL,
  `logo` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`abos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`abos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cost` DECIMAL(11,2) NOT NULL,
  `provider_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_abos_provider_idx` (`provider_id` ASC),
  CONSTRAINT `fk_abos_provider`
    FOREIGN KEY (`provider_id`)
    REFERENCES `streamingportal`.`providers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`filmindustryprofessional`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`filmindustryprofessional` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(255) NOT NULL,
  `lastname` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`offers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`offers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `trailer` VARCHAR(255) NOT NULL,
  `fsk` TINYINT(4) NOT NULL,
  `posterLink` VARCHAR(255) NOT NULL,
  `originalTitle` VARCHAR(255) NOT NULL,
  `rating` DECIMAL(3,2) NOT NULL,
  `description` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`actors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`actors` (
  `offers_id` INT(11) NOT NULL,
  `filmIndustryProfessional_id` INT(11) NOT NULL,
  PRIMARY KEY USING BTREE (`offers_id`, `filmIndustryProfessional_id`),
  INDEX `fk_actors_filmIndustryProfessional1_idx` (`filmIndustryProfessional_id` ASC),
  CONSTRAINT `fk_actors_filmIndustryProfessional1`
    FOREIGN KEY (`filmIndustryProfessional_id`)
    REFERENCES `streamingportal`.`filmindustryprofessional` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_actors_offers`
    FOREIGN KEY (`offers_id`)
    REFERENCES `streamingportal`.`offers` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`admin` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `streamingportal`.`deleteduser`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`deleteduser` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(50) NOT NULL,
  `deltime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 21
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `streamingportal`.`directors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`directors` (
  `offers_id` INT(11) NOT NULL,
  `filmIndustryProfessional_id` INT(11) NOT NULL,
  PRIMARY KEY (`offers_id`, `filmIndustryProfessional_id`),
  INDEX `fk_directors_filmIndustryProfessional1_idx` (`filmIndustryProfessional_id` ASC),
  INDEX `fk_famouspersons_has_movies_movies1_idx` USING BTREE (`offers_id`),
  CONSTRAINT `fk_directors_filmIndustryProfessional1`
    FOREIGN KEY (`filmIndustryProfessional_id`)
    REFERENCES `streamingportal`.`filmindustryprofessional` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_famouspersons_has_movies_movies1`
    FOREIGN KEY (`offers_id`)
    REFERENCES `streamingportal`.`offers` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`seasons`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`seasons` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `number` INT(11) NOT NULL,
  `offers_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_seasons_offers1_idx` (`offers_id` ASC),
  CONSTRAINT `fk_seasons_offers1`
    FOREIGN KEY (`offers_id`)
    REFERENCES `streamingportal`.`offers` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`episodes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`episodes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `number` INT(11) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `duration` INT(11) NOT NULL,
  `releaseYear` INT(11) NOT NULL,
  `seasons_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_episodes_seasons1_idx` (`seasons_id` ASC),
  CONSTRAINT `fk_episodes_seasons1`
    FOREIGN KEY (`seasons_id`)
    REFERENCES `streamingportal`.`seasons` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 26
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`feedback`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`feedback` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `sender` VARCHAR(50) NOT NULL,
  `reciver` VARCHAR(50) NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `feedbackdata` VARCHAR(500) NOT NULL,
  `attachment` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 19
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `streamingportal`.`genres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`genres` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`languages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`languages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `language` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`hasdubs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`hasdubs` (
  `languages_id` INT(11) NOT NULL,
  `offers_id` INT(11) NOT NULL,
  PRIMARY KEY (`languages_id`, `offers_id`),
  INDEX `fk_languages_has_offers_offers1_idx` (`offers_id` ASC),
  INDEX `fk_languages_has_offers_languages1_idx` (`languages_id` ASC),
  CONSTRAINT `fk_languages_has_offers_languages1`
    FOREIGN KEY (`languages_id`)
    REFERENCES `streamingportal`.`languages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_languages_has_offers_offers1`
    FOREIGN KEY (`offers_id`)
    REFERENCES `streamingportal`.`offers` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`hassubs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`hassubs` (
  `offers_id` INT(11) NOT NULL,
  `languages_id` INT(11) NOT NULL,
  PRIMARY KEY (`offers_id`, `languages_id`),
  INDEX `fk_offers_has_languages_languages1_idx` (`languages_id` ASC),
  INDEX `fk_offers_has_languages_offers1_idx` (`offers_id` ASC),
  CONSTRAINT `fk_offers_has_languages_languages1`
    FOREIGN KEY (`languages_id`)
    REFERENCES `streamingportal`.`languages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_offers_has_languages_offers1`
    FOREIGN KEY (`offers_id`)
    REFERENCES `streamingportal`.`offers` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`movies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`movies` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `releaseYear` INT(11) NOT NULL,
  `duration` INT(11) NOT NULL,
  `offers_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_movie_offers1_idx` (`offers_id` ASC),
  CONSTRAINT `fk_movie_offers1`
    FOREIGN KEY (`offers_id`)
    REFERENCES `streamingportal`.`offers` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`notification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`notification` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `notiuser` VARCHAR(50) NOT NULL,
  `notireciver` VARCHAR(50) NOT NULL,
  `notitype` VARCHAR(50) NOT NULL,
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `streamingportal`.`offershasgenres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`offershasgenres` (
  `offers_id` INT(11) NOT NULL,
  `genres_id` INT(11) NOT NULL,
  PRIMARY KEY (`offers_id`, `genres_id`),
  INDEX `fk_offers_has_genres_genres1_idx` (`genres_id` ASC),
  INDEX `fk_offers_has_genres_offers1_idx` (`offers_id` ASC),
  CONSTRAINT `fk_offers_has_genres_genres1`
    FOREIGN KEY (`genres_id`)
    REFERENCES `streamingportal`.`genres` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_offers_has_genres_offers1`
    FOREIGN KEY (`offers_id`)
    REFERENCES `streamingportal`.`offers` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`offershasproviders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`offershasproviders` (
  `provider_id` INT(11) NOT NULL,
  `offers_id` INT(11) NOT NULL,
  PRIMARY KEY (`provider_id`, `offers_id`),
  INDEX `fk_provider_has_movie_movie1_idx` (`offers_id` ASC),
  INDEX `fk_provider_has_movie_provider1_idx` (`provider_id` ASC),
  CONSTRAINT `fk_provider_has_movie_movie1`
    FOREIGN KEY (`offers_id`)
    REFERENCES `streamingportal`.`offers` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_provider_has_movie_provider1`
    FOREIGN KEY (`provider_id`)
    REFERENCES `streamingportal`.`providers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `gender` VARCHAR(50) NOT NULL,
  `mobile` VARCHAR(50) NOT NULL,
  `designation` VARCHAR(50) NOT NULL,
  `image` VARCHAR(50) NOT NULL,
  `status` INT(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 22
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `streamingportal`.`watchlists`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `streamingportal`.`watchlists` (
  `user_id` INT(11) NOT NULL,
  `offers_id` INT(11) NOT NULL,
  PRIMARY KEY (`user_id`, `offers_id`),
  INDEX `fk_user_has_offers_offers1_idx` (`offers_id` ASC),
  INDEX `fk_user_has_offers_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_offers_offers1`
    FOREIGN KEY (`offers_id`)
    REFERENCES `streamingportal`.`offers` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_offers_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `streamingportal`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
