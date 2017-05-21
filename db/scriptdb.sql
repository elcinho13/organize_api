/**
 * Version: 07
 * Updated: 16/05/2017
 */

CREATE DATABASE IF NOT EXISTS `organize_test`;
USE `organize_test`;

-- -----------------------------------------------------------------------------
-- Create table org_access_platform
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_access_platform`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255),
    `code_enum` INT UNSIGNED,
    `name` VARCHAR(255),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_contact_type
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_contact_type`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255),
    `code_enum` INT UNSIGNED,
    `name` VARCHAR(255),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_login_type
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_login_type`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255),
    `code_enum` INT UNSIGNED,
    `name` VARCHAR(255),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user_type
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_type`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255),
    `code_enum` INT UNSIGNED,
    `name` VARCHAR(255),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_institutional
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_institutional`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255),
    `code_enum` INT UNSIGNED,
    `site_url` VARCHAR(255),
    `description` VARCHAR(2500),
    `mission` VARCHAR(2500),
    `vision` VARCHAR(2500),
    `values` VARCHAR(2500),
    `is_active` TINYINT(1),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_privacy
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_privacy`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255),
    `code_enum` INT UNSIGNED,
    `name` VARCHAR(255),
    `description` VARCHAR(1000),
    `check_default` TINYINT(1),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_settings
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_settings`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255),
    `code_enum` INT UNSIGNED,
    `name` VARCHAR(255),
    `description` VARCHAR(1000),
    `check_default` TINYINT(1),
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
-- Create table org_plan
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_plan`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255),
    `code_enum` INT UNSIGNED,
    `name` VARCHAR(255),
    `description` VARCHAR(2000),
    `security_code` VARCHAR(255),
    `is_active` TINYINT(1),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_contact
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_contact`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255),
    `code_enum` INT UNSIGNED,
    `description` VARCHAR(255),
    `contact_type` INT UNSIGNED,
    `contact` varchar(255),
    `is_active` TINYINT(1),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_contact_fk1` (`contact_type`),
    CONSTRAINT `org_contact_fk1` FOREIGN KEY (`contact_type`) REFERENCES `org_contact_type` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_plan_price
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_plan_price`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255),
    `code_enum` INT UNSIGNED,
    `plan` INT UNSIGNED,
    `description` VARCHAR(255),
    `price` FLOAT,
    `is_active` TINYINT(1),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_plan_price_fk1` (`plan`),
    CONSTRAINT `org_plan_price_fk1` FOREIGN KEY (`plan`) REFERENCES `org_plan` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_plan_advantages
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_plan_advantages`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255),
    `code_enum` INT UNSIGNED,
    `plan` INT UNSIGNED, 
    `advantage` VARCHAR(255),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_plan_advantages_fk1` (`plan`),
    CONSTRAINT `org_plan_advantages_fk1` FOREIGN KEY (`plan`) REFERENCES `org_plan` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_token
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_token`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `login_type` INT UNSIGNED,
    `access_platform` INT UNSIGNED,
    `access_token` VARCHAR(255),
    `access_date` DATETIME,
    `keep_logged` TINYINT(1),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_token_fk1` (`login_type`),
    CONSTRAINT `org_token_fk1` FOREIGN KEY (`login_type`) REFERENCES `org_login_type` (`id`),

    KEY `org_token_fk2` (`access_platform`),
    CONSTRAINT `org_token_fk2` FOREIGN KEY (`access_platform`) REFERENCES `org_access_platform` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user_type` INT UNSIGNED,
    `token` INT UNSIGNED,
    `plan` INT UNSIGNED,
    `privacy` INT UNSIGNED,
    `full_name` VARCHAR(255),
    `mail` VARCHAR(255) UNIQUE,
    `password` VARCHAR(255),
    `profile_picture` VARCHAR(255),
    `cpf` VARCHAR(255) UNIQUE,
    `rg_number` VARCHAR(255),
    `rg_emitter_uf` VARCHAR(255),
    `rg_emitter_organ` VARCHAR(255),
    `rg_emitter_date` DATE,
    `birth_date` DATE,
    `gender` VARCHAR(1),
    `responsible_name` VARCHAR(255),
    `responsible_cpf` VARCHAR(255),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_fk1` (`user_type`),
    CONSTRAINT `org_user_fk1` FOREIGN KEY (`user_type`) REFERENCES `org_user_type` (`id`),

    KEY `org_user_fk3` (`token`),
    CONSTRAINT `org_user_fk3` FOREIGN KEY (`token`) REFERENCES `org_token` (`id`),

    KEY `org_user_fk4` (`plan`),
    CONSTRAINT `org_user_fk4` FOREIGN KEY (`plan`) REFERENCES `org_plan` (`id`),

    KEY `org_user_fk5` (`privacy`),
    CONSTRAINT `org_user_fk5` FOREIGN KEY (`privacy`) REFERENCES `org_privacy` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user_term
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_term`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED,
    `term` INT UNSIGNED, 
    `term_accept` TINYINT(1), 
    `term_accept_date` DATETIME,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,


    KEY `org_user_term_fk1` (`user`),
    CONSTRAINT `org_user_term_fk1` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`),

    KEY `org_user_term_fk2` (`term`),
    CONSTRAINT `org_user_term_fk2` FOREIGN KEY (`term`) REFERENCES `org_term` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_first_access
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_first_access`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED,
    `device_id` VARCHAR(255) UNIQUE,
    `instalation_date` DATETIME,
    `locale` VARCHAR(255),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_first_access_fk1` (`user`),
    CONSTRAINT `org_first_access_fk1` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_notification
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_notifications`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED,
    `brief_description` VARCHAR(255),
    `description` VARCHAR(1500),
    `notification_date` DATETIME,
    `is_read` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_notifications_fk1` (`user`),
    CONSTRAINT `org_user_notifications_fk1` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user_settings
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_settings`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED,
    `setting` INT UNSIGNED,
    `checking` TINYINT(1),
    `value` INT,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_settings_fk1` (`user`),
    CONSTRAINT `org_user_settings_fk1` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`),

    KEY `org_user_settings_fk2` (`setting`),
    CONSTRAINT `org_user_settings_fk2` FOREIGN KEY (`setting`) REFERENCES `org_settings` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_security_question
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_security_question`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED,
    `locale` VARCHAR(255),
    `security_question` VARCHAR(255),
    `private_use` TINYINT(1),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_security_question_fk1` (`user`),
    CONSTRAINT `org_security_question_fk1` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user_security
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_security`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED,
    `security_question` INT UNSIGNED,
    `security_answer` VARCHAR(255),
    `last_update_date` DATETIME,
    `access_platform` INT UNSIGNED,
    `last_update_identifier` VARCHAR(255),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_security_fk1` (`user`),
    CONSTRAINT `org_user_security_fk1` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`),

    KEY `org_user_security_fk2` (`security_question`),
    CONSTRAINT `org_user_security_fk2` FOREIGN KEY (`security_question`) REFERENCES `org_security_question` (`id`),

    KEY `org_user_security_fk3` (`access_platform`),
    CONSTRAINT `org_user_security_fk3` FOREIGN KEY (`access_platform`) REFERENCES `org_access_platform` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_password_recovery
-- -----------------------------------------------------------------------------
    CREATE TABLE IF NOT EXISTS `org_password_recovery`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED,
    `token` VARCHAR(45),
    `send_date` DATETIME,
    `validate_date` DATETIME,
    `access_date` DATETIME,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_password_recovery_fk1` (`user`),
    CONSTRAINT `org_password_recovery_fk1` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;