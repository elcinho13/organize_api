/**
 * Author:  marcelamelo
 * Created: 09/02/2017
 */

-- ----------------------------------------------------------------------------
-- Create database organize_test
-- Test database for development use
-------------------------------------------------------------------------------
CREATE IF NOT EXISTS DATABASE `organize_test`;
USE `organize_test`;

-- -----------------------------------------------------------------------------
-- Create table firt_access
-- -----------------------------------------------------------------------------
CREATE IF NOT EXISTS TABLE `org_firt_access`(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `device_id` VARCHAR(255) UNIQUE,
    `instalation_date` TIMESTAMP,
    `locale` VARCHAR(255),
    `term_accept` CHAR,
    `term_accept_date` TIMESTAMP,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP
);