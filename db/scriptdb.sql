/**
 * Version: 01
 * Updated: 11/02/2017
 */

CREATE DATABASE IF NOT EXISTS `organize_test`;
USE `organize_test`;

-- -----------------------------------------------------------------------------
-- Create table org_plan_price
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_plan_price`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `plan` INT,
    `price` FLOAT,
    `is_active` TINYINT(1),
    `inserted_by` INT,
    `updated_by` INT,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_term
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_term`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255),
    `version_name` VARCHAR(255),
    `title` VARCHAR(255),
    `content` LONGTEXT,
    `publication_date` DATE,
    `is_active` TINYINT(1),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_first_access
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_first_access`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `device_id` VARCHAR(255) UNIQUE,
    `instalation_date` TIMESTAMP,
    `locale` VARCHAR(255),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `full_name` VARCHAR(255),
    `mail` VARCHAR(255) UNIQUE,
    `password` VARCHAR(255),
    `facebook_id` VARCHAR(255),
    `linkedin_id` VARCHAR(255),
    `google_id` VARCHAR(255),
    `profile_picture` VARCHAR(255),
    `cpf` VARCHAR(255) UNIQUE,
    `rg_number` VARCHAR(255),
    `rg_emitter_uf` VARCHAR(255),
    `rg_emitter_organ` VARCHAR(255),
    `rg_emitter_date` DATE,
    `birth_date` DATE,
    `responsible_name` VARCHAR(255),
    `responsible_cpf` VARCHAR(255),
    `org_term_id` INT UNSIGNED, 
    `term_accept` TINYINT(1), 
    `term_accept_date` TIMESTAMP,
    `plan` INT,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_fk1` (`org_term_id`),
    CONSTRAINT `org_user_fk1` FOREIGN KEY (`org_term_id`) REFERENCES `org_term` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_security_question
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_security_question`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `org_user_id` INT UNSIGNED,
    `locale` VARCHAR(255),
    `security_question` VARCHAR(255),
    `private` TINYINT(1),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_security_question_fk1` (`org_user_id`),
    CONSTRAINT `org_security_question_fk1` FOREIGN KEY (`org_user_id`) REFERENCES `org_user` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user_security
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_security`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `org_user_id` INT UNSIGNED,
    `org_security_question_id` INT UNSIGNED,
    `security_answer` VARCHAR(255),
    `last_update_date` TIMESTAMP,
    `last_update_platform` INT,
    `last_update_identifier` VARCHAR(255),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_security_fk1` (`org_user_id`),
    CONSTRAINT `org_user_security_fk1` FOREIGN KEY (`org_user_id`) REFERENCES `org_user` (`id`),

    KEY `org_user_security_fk2` (`org_security_question_id`),
    CONSTRAINT `org_user_security_fk2` FOREIGN KEY (`org_security_question_id`) REFERENCES `org_security_question` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_token
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_token`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `org_user_id` INT UNSIGNED,
    `org_first_access_id` INT UNSIGNED,
    `login_type` INT,
    `access_token` VARCHAR(255),
    `access_platform` INT,
    `access_date` TIMESTAMP,
    `keep_logged` TINYINT(1),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_token_fk1` (`org_user_id`),
    CONSTRAINT `org_token_fk1` FOREIGN KEY (`org_user_id`) REFERENCES `org_user` (`id`),

    KEY `org_token_fk2` (`org_first_access_id`),
    CONSTRAINT `org_token_fk2` FOREIGN KEY (`org_first_access_id`) REFERENCES `org_first_access` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_settings
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_settings`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `org_user_id` INT UNSIGNED,
    `settings` INT,
    `checking` TINYINT(1),
    `value` INT,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_settings_fk1` (`org_user_id`),
    CONSTRAINT `org_settings_fk1` FOREIGN KEY (`org_user_id`) REFERENCES `org_user` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_privacy
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_privacy`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `org_user_id` INT UNSIGNED,
    `privacy` INT,
    `checking` TINYINT(1),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_privacy_fk1` (`org_user_id`),
    CONSTRAINT `org_privacy_fk1` FOREIGN KEY (`org_user_id`) REFERENCES `org_user` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_notification
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_notification`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `org_user_id` INT UNSIGNED,
    `brief_description` VARCHAR(255),
    `description` VARCHAR(1500),
    `read` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_notification_fk1` (`org_user_id`),
    CONSTRAINT `org_notification_fk1` FOREIGN KEY (`org_user_id`) REFERENCES `org_user` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
