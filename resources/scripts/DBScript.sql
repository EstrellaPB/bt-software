-- CREATE DATABASE bt_publicity;
-- USE bt_publicity;

-- DROP DATABASE bt_publicity;

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(255) NOT NULL UNIQUE,
	`password` VARCHAR(60) NOT NULL,
	`remember_token` VARCHAR(255) DEFAULT NULL,
	`name` VARCHAR(255) DEFAULT NULL,
    `created_at` datetime,
    `updated_at` datetime,
    
	PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Categories`;
CREATE TABLE `Categories`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`shortDescription` VARCHAR(100),
    `longDescription` VARCHAR(400),
    `created_at` datetime,
    `updated_at` datetime,
    
	PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `CompanyClients`;
CREATE TABLE `CompanyClients`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(70),
    `rfc` VARCHAR(15),
    `city` VARCHAR(70),
    `state` VARCHAR(70),
    `created_at` datetime,
    `updated_at` datetime,
    
	PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `CompanyDetails`;
CREATE TABLE `CompanyDetails`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
    `id_company` INT,
    `latitude` FLOAT,
    `longitude` FLOAT,
	`is_premium` BOOLEAN DEFAULT FALSE,
    `is_active` BOOLEAN DEFAULT TRUE,
    `urlImage` VARCHAR(100),
    `created_at` datetime,
    `updated_at` datetime,
    
	PRIMARY KEY (`id`),
    CONSTRAINT `CompanyDetails_id_company_fk` FOREIGN KEY (`id_company`) REFERENCES `CompanyClients` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `CustomersProfiles`;
CREATE TABLE `CustomersProfiles`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_customer` INT,
	`first_name` VARCHAR(50) NOT NULL,
	`last_name` VARCHAR(50) NOT NULL,
	`address` VARCHAR(255) DEFAULT NULL,
	`tel` VARCHAR(10) DEFAULT NULL,
    `city` VARCHAR(50),
    `state` VARCHAR(50),
    `created_at` datetime,
    `updated_at` datetime,
    
	PRIMARY KEY (`id`),
    CONSTRAINT `CustomersProfiles_id_user_fk` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Devices`;
CREATE TABLE `Devices`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`mac` VARCHAR(20) UNIQUE,
    `created_at` datetime,
    `updated_at` datetime,
    
	PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Publications`;
CREATE TABLE `Publications`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
    `id_category` INT,
    `id_company` INT,
    `title` VARCHAR(255),
	`description` TEXT,
    `urlImage` VARCHAR(100),
    `is_coupon` BOOLEAN DEFAULT FALSE,
    `clicked` INT DEFAULT 0,
    `created_at` datetime,
    `updated_at` datetime,
    
	PRIMARY KEY (`id`),
    CONSTRAINT `Publications_id_company_fk` FOREIGN KEY (`id_company`) REFERENCES `CompanyClients` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Messages`;
CREATE TABLE `Messages`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_publication` INT NOT NULL,
	`message` VARCHAR(140),
    `url` VARCHAR(100),
    `created_at` datetime,
    `updated_at` datetime,
    
	PRIMARY KEY (`id`),
    CONSTRAINT `Messages_id_company_fk` FOREIGN KEY (`id_publication`) REFERENCES `Publications` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `CouponBooks`;
CREATE TABLE `CouponBooks`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_customer` INT,
	`id_publication` INT,
	`used` BOOLEAN DEFAULT FALSE,
    
	PRIMARY KEY (`id`),
    CONSTRAINT `CouponBooks_customer_fk` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`),
    CONSTRAINT `CouponBooks_id_publication_fk` FOREIGN KEY (`id_publication`) REFERENCES `Publications` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `MessagesDevices`;
CREATE TABLE `MessagesDevices`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_device` INT,
	`id_message` INT,
    
	PRIMARY KEY (`id`),
    CONSTRAINT `MessagesDevices_id_device_fk` FOREIGN KEY (`id_device`) REFERENCES `Devices` (`id`),
    CONSTRAINT `MessagesDevices_id_message_fk` FOREIGN KEY (`id_message`) REFERENCES `Messages` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;