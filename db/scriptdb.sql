/**
 * Version: 13
 * Updated: 11/06/2017
 */

CREATE DATABASE IF NOT EXISTS `organize_test`;
USE `organize_test`;

-- -----------------------------------------------------------------------------
-- Create table org_user_admin
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_admin`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) UNIQUE NOT NULL,
    `profile_picture` VARCHAR(255),
    `cpf` VARCHAR(255) UNIQUE NOT NULL,
    `birth_date` DATE NOT NULL,
    `phone` VARCHAR(255) UNIQUE NOT NULL,
    `mail` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `access_token` VARCHAR(255),
    `last_access` DATETIME,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_access_platform
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_access_platform`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_access_platform_fk1` (`user_last_update`),
    CONSTRAINT `org_access_platform_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_contact_type
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_contact_type`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_contact_type_fk1` (`user_last_update`),
    CONSTRAINT `org_contact_type_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_login_type
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_login_type`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_login_type_fk1` (`user_last_update`),
    CONSTRAINT `org_login_type_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user_type
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_type`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_type_fk1` (`user_last_update`),
    CONSTRAINT `org_user_type_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_institutional
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_institutional`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `site_url` VARCHAR(255) NOT NULL,
    `description` VARCHAR(2500) NOT NULL,
    `mission` VARCHAR(2500) NOT NULL,
    `vision` VARCHAR(2500) NOT NULL,
    `values` VARCHAR(2500) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_institutional_fk1` (`user_last_update`),
    CONSTRAINT `org_institutional_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_privacy
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_privacy`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(1000) NOT NULL,
    `check_default` TINYINT(1),
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_privacy_fk1` (`user_last_update`),
    CONSTRAINT `org_privacy_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_settings
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_settings`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(1000) NOT NULL,
    `check_default` TINYINT(1),
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_settings_fk1` (`user_last_update`),
    CONSTRAINT `org_settings_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_term
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_term`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `version_name` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `content` LONGTEXT NOT NULL,
    `publication_date` DATE NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_term_fk1` (`user_last_update`),
    CONSTRAINT `org_term_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_plan
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_plan`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(2000) NOT NULL,
    `security_code` VARCHAR(255),
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_plan_fk1` (`user_last_update`),
    CONSTRAINT `org_plan_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_contact
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_contact`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `contact_type` INT UNSIGNED NOT NULL,
    `contact` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_contact_fk1` (`user_last_update`),
    CONSTRAINT `org_contact_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_contact_fk2` (`contact_type`),
    CONSTRAINT `org_contact_fk2` FOREIGN KEY (`contact_type`) REFERENCES `org_contact_type` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_plan_price
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_plan_price`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `plan` INT UNSIGNED NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `price` FLOAT NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_plan_price_fk1` (`user_last_update`),
    CONSTRAINT `org_plan_price_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_plan_price_fk2` (`plan`),
    CONSTRAINT `org_plan_price_fk2` FOREIGN KEY (`plan`) REFERENCES `org_plan` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_plan_advantages
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_plan_advantages`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `plan` INT UNSIGNED NOT NULL, 
    `advantage` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_plan_advantages_fk1` (`user_last_update`),
    CONSTRAINT `org_plan_advantages_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_plan_advantages_fk2` (`plan`),
    CONSTRAINT `org_plan_advantages_fk2` FOREIGN KEY (`plan`) REFERENCES `org_plan` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_token
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_token`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `login_type` INT UNSIGNED NOT NULL,
    `access_platform` INT UNSIGNED NOT NULL,
    `access_token` VARCHAR(255) NOT NULL,
    `access_date` DATETIME NOT NULL,
    `keep_logged` TINYINT(1),
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_token_fk1` (`user_last_update`),
    CONSTRAINT `org_token_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_token_fk2` (`login_type`),
    CONSTRAINT `org_token_fk2` FOREIGN KEY (`login_type`) REFERENCES `org_login_type` (`id`),

    KEY `org_token_fk3` (`access_platform`),
    CONSTRAINT `org_token_fk3` FOREIGN KEY (`access_platform`) REFERENCES `org_access_platform` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user_type` INT UNSIGNED NOT NULL,
    `token` INT UNSIGNED NOT NULL,
    `plan` INT UNSIGNED NOT NULL,
    `privacy` INT UNSIGNED NOT NULL,
    `full_name` VARCHAR(255) NOT NULL,
    `mail` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `profile_picture` VARCHAR(255),
    `cpf` VARCHAR(255) UNIQUE NOT NULL,
    `rg_number` VARCHAR(255),
    `rg_emitter_uf` VARCHAR(255),
    `rg_emitter_organ` VARCHAR(255),
    `rg_emitter_date` DATE,
    `birth_date` DATE NOT NULL,
    `gender` VARCHAR(1) NOT NULL,
    `responsible_name` VARCHAR(255),
    `responsible_cpf` VARCHAR(255),
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_fk1` (`user_last_update`),
    CONSTRAINT `org_user_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_user_fk2` (`user_type`),
    CONSTRAINT `org_user_fk2` FOREIGN KEY (`user_type`) REFERENCES `org_user_type` (`id`),

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
    `user` INT UNSIGNED NOT NULL,
    `term` INT UNSIGNED NOT NULL, 
    `term_accept` TINYINT(1), 
    `term_accept_date` DATETIME NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_term_fk1` (`user_last_update`),
    CONSTRAINT `org_user_term_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_user_term_fk2` (`user`),
    CONSTRAINT `org_user_term_fk2` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`),

    KEY `org_user_term_fk3` (`term`),
    CONSTRAINT `org_user_term_fk3` FOREIGN KEY (`term`) REFERENCES `org_term` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_first_access
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_first_access`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED NOT NULL,
    `device_id` VARCHAR(255) UNIQUE NOT NULL,
    `instalation_date` DATETIME NOT NULL,
    `locale` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_first_access_fk1` (`user_last_update`),
    CONSTRAINT `org_first_access_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_first_access_fk2` (`user`),
    CONSTRAINT `org_first_access_fk2` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_notification
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_notifications`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED NOT NULL,
    `brief_description` VARCHAR(255) NOT NULL,
    `description` VARCHAR(1500) NOT NULL,
    `notification_date` DATETIME NOT NULL,
    `is_read` TINYINT(1) DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_notifications_fk1` (`user_last_update`),
    CONSTRAINT `org_user_notifications_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_user_notifications_fk2` (`user`),
    CONSTRAINT `org_user_notifications_fk2` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user_settings
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_settings`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED NOT NULL,
    `setting` INT UNSIGNED NOT NULL,
    `checking` TINYINT(1),
    `value` INT,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_settings_fk1` (`user_last_update`),
    CONSTRAINT `org_user_settings_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_user_settings_fk2` (`user`),
    CONSTRAINT `org_user_settings_fk2` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`),

    KEY `org_user_settings_fk3` (`setting`),
    CONSTRAINT `org_user_settings_fk3` FOREIGN KEY (`setting`) REFERENCES `org_settings` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_security_question
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_security_question`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED NOT NULL,
    `locale` VARCHAR(255) NOT NULL,
    `security_question` VARCHAR(255) NOT NULL,
    `private_use` TINYINT(1),
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_security_question_fk1` (`user_last_update`),
    CONSTRAINT `org_security_question_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_security_question_fk2` (`user`),
    CONSTRAINT `org_security_question_fk2` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user_security
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_security`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED NOT NULL,
    `security_question` INT UNSIGNED NOT NULL,
    `security_answer` VARCHAR(255) NOT NULL,
    `last_update_date` DATETIME NOT NULL,
    `access_platform` INT UNSIGNED NOT NULL,
    `last_update_identifier` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_security_fk1` (`user_last_update`),
    CONSTRAINT `org_user_security_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_user_security_fk2` (`user`),
    CONSTRAINT `org_user_security_fk2` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`),

    KEY `org_user_security_fk3` (`security_question`),
    CONSTRAINT `org_user_security_fk3` FOREIGN KEY (`security_question`) REFERENCES `org_security_question` (`id`),

    KEY `org_user_security_fk4` (`access_platform`),
    CONSTRAINT `org_user_security_fk4` FOREIGN KEY (`access_platform`) REFERENCES `org_access_platform` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_password_recovery
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_password_recovery`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED NOT NULL,
    `token` VARCHAR(45) NOT NULL,
    `send_date` DATETIME NOT NULL,
    `validate_date` DATETIME NOT NULL,
    `access_date` DATETIME,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_password_recovery_fk1` (`user_last_update`),
    CONSTRAINT `org_password_recovery_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_password_recovery_fk2` (`user`),
    CONSTRAINT `org_password_recovery_fk2` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_place
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_place`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `place_id` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `icon` VARCHAR(255),
    `web_site_uri` VARCHAR(255),
    `formatted_address` VARCHAR(255) NOT NULL,
    `lat` DOUBLE NOT NULL,
    `long` DOUBLE NOT NULL,
    `type` int NOT NULL,
    `price_level` FLOAT,
    `rating` FLOAT,
    `references` VARCHAR(255),
    `permanently_closed` TINYINT(1),
    `vicinity` VARCHAR(255),
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_place_fk1` (`user_last_update`),
    CONSTRAINT `org_place_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user_address
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_address`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED NOT NULL,
    `place` INT UNSIGNED NOT NULL,
    `complement` VARCHAR(255),
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_address_fk1` (`user_last_update`),
    CONSTRAINT `org_user_address_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_user_address_fk2` (`user`),
    CONSTRAINT `org_user_address_fk2` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`),

    KEY `org_user_address_fk3` (`place`),
    CONSTRAINT `org_user_address_fk3` FOREIGN KEY (`place`) REFERENCES `org_place` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user_contact
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_contact`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `contact_type` INT UNSIGNED NOT NULL,
    `user` INT UNSIGNED NOT NULL,
    `contact` varchar(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_contact_fk1` (`user_last_update`),
    CONSTRAINT `org_user_contact_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_user_contact_fk2` (`contact_type`),
    CONSTRAINT `org_user_contact_fk2` FOREIGN KEY (`contact_type`) REFERENCES `org_contact_type` (`id`),

    KEY `org_user_contact_fk3` (`user`),
    CONSTRAINT `org_user_contact_fk3` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_literacy (Grau de instrução)
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_literacy`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_literacy_fk1` (`user_last_update`),
    CONSTRAINT `org_literacy_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_social_network_type
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_social_network_type`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_social_network_type_fk1` (`user_last_update`),
    CONSTRAINT `org_social_network_type_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_shift (Turno)
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_shift`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_shift_fk1` (`user_last_update`),
    CONSTRAINT `org_shift_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_institution_type
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_institution_type`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_institution_type_fk1` (`user_last_update`),
    CONSTRAINT `org_institution_type_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_course
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_course`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `locale` VARCHAR(255) NOT NULL,
    `code_enum` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_course_fk1` (`user_last_update`),
    CONSTRAINT `org_course_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_user_social_network
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_social_network`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `social_network_type` INT UNSIGNED NOT NULL,
    `user` INT UNSIGNED NOT NULL,
    `url` varchar(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_user_social_network_fk1` (`user_last_update`),
    CONSTRAINT `org_user_social_network_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_user_social_network_fk2` (`social_network_type`),
    CONSTRAINT `org_user_social_network_fk2` FOREIGN KEY (`social_network_type`) REFERENCES `org_social_network_type` (`id`),

    KEY `org_user_social_network_fk3` (`user`),
    CONSTRAINT `org_user_social_network_fk3` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_institution
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_institution`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `institution_type` INT UNSIGNED NOT NULL,
    `place` INT UNSIGNED UNIQUE NOT NULL,
    `name` varchar(255) NOT NULL,
    `unit` varchar(255) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_institution_fk1` (`user_last_update`),
    CONSTRAINT `org_institution_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_institution_fk2` (`institution_type`),
    CONSTRAINT `org_institution_fk2` FOREIGN KEY (`institution_type`) REFERENCES `org_institution_type` (`id`),

    KEY `org_institution_fk3` (`place`),
    CONSTRAINT `org_institution_fk3` FOREIGN KEY (`place`) REFERENCES `org_place` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_institution_course
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_institution_course`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `institution` INT UNSIGNED NOT NULL,
    `course` INT UNSIGNED NOT NULL,
    `duration` int NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_institution_course_fk1` (`user_last_update`),
    CONSTRAINT `org_institution_course_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_institution_course_fk2` (`institution`),
    CONSTRAINT `org_institution_course_fk2` FOREIGN KEY (`institution`) REFERENCES `org_institution` (`id`),

    KEY `org_institution_course_fk3` (`course`),
    CONSTRAINT `org_institution_course_fk3` FOREIGN KEY (`course`) REFERENCES `org_course` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_academic_class
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_academic_class`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `institution_course` INT UNSIGNED NOT NULL,
    `shift` INT UNSIGNED NOT NULL,
    `identify` VARCHAR(200) UNIQUE NOT NULL,
    `start_year` INT(4) NOT NULL,
    `start_semester` INT(1) NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_academic_class_fk1` (`user_last_update`),
    CONSTRAINT `org_academic_class_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_academic_class_fk2` (`institution_course`),
    CONSTRAINT `org_academic_class_fk2` FOREIGN KEY (`institution_course`) REFERENCES `org_institution_course` (`id`),

    KEY `org_academic_class_fk3` (`shift`),
    CONSTRAINT `org_academic_class_fk3` FOREIGN KEY (`shift`) REFERENCES `org_shift` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------------------------------
-- Create table org_academic_data
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `org_user_academic_data`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user` INT UNSIGNED NOT NULL,
    `literacy` INT UNSIGNED NOT NULL,
    `institution` INT UNSIGNED NOT NULL,
    `course` INT UNSIGNED NOT NULL,
    `academic_class` INT UNSIGNED NOT NULL,
    `start_date` DATE NOT NULL,
    `final_date` DATE NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `user_last_update` INT UNSIGNED,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    KEY `org_academic_data_fk1` (`user_last_update`),
    CONSTRAINT `org_academic_data_fk1` FOREIGN KEY (`user_last_update`) REFERENCES `org_user_admin` (`id`),

    KEY `org_academic_data_fk2` (`user`),
    CONSTRAINT `org_academic_data_fk2` FOREIGN KEY (`user`) REFERENCES `org_user` (`id`),

    KEY `org_academic_data_fk3` (`literacy`),
    CONSTRAINT `org_academic_data_fk3` FOREIGN KEY (`literacy`) REFERENCES `org_literacy` (`id`),

    KEY `org_academic_data_fk4` (`institution`),
    CONSTRAINT `org_academic_data_fk4` FOREIGN KEY (`institution`) REFERENCES `org_institution` (`id`),

    KEY `org_academic_data_fk5` (`course`),
    CONSTRAINT `org_academic_data_fk5` FOREIGN KEY (`course`) REFERENCES `org_institution_course` (`id`),

    KEY `org_academic_data_fk6` (`academic_class`),
    CONSTRAINT `org_academic_data_fk6` FOREIGN KEY (`academic_class`) REFERENCES `org_academic_class` (`id`)

)ENGINE=InnoDB DEFAULT CHARSET=utf8;