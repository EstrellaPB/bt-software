# Host: 23.229.177.1  (Version 5.6.36-cll-lve)
# Date: 2018-02-27 22:40:02
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "admin_password_resets"
#

DROP TABLE IF EXISTS `admin_password_resets`;
CREATE TABLE `admin_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `admin_password_resets_email_index` (`email`),
  KEY `admin_password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "admin_password_resets"
#


#
# Structure for table "admins"
#

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "admins"
#

/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Admin','admin@studioav.com.mx','$2y$10$hY5kN.uBuouZxZe88N2PbOrFSzdrJ/9MW3ZOXopqdGyTq0/L96gia','wQoRZUzDbtS6BinKk3kcgRZiwRLaGXJ0ClSnfCDVzsniGqVAmDxjmJ4uSL0U','2018-01-16 22:29:09','2018-01-16 22:29:09'),(2,'prueba','prueba@studioav.com.mx','$2y$10$pjaf4.COH/QuQSCP08jKi.bQWDARUCfRC/9yINLqtLX6Do1uRwzrq',NULL,'2018-02-05 00:06:48','2018-02-05 00:06:48');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

#
# Structure for table "Categories"
#

DROP TABLE IF EXISTS `Categories`;
CREATE TABLE `Categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shortDescription` varchar(100) DEFAULT NULL,
  `longDescription` varchar(400) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Data for table "Categories"
#

INSERT INTO `Categories` VALUES (1,'Abarrotes','Descripción de abarrotes.','2018-01-05 13:00:00','2018-02-27 05:32:43'),(2,'Computadoras','Descripcion de Computadoras','2018-01-05 13:00:00','2018-01-05 13:00:00'),(3,'Entretenimiento','Descripcion de Entretenimiento','2018-01-05 13:00:00','2018-01-05 13:00:00'),(4,'Ropa','Descripcion de Ropa','2018-01-05 13:00:00','2018-01-05 13:00:00'),(5,'Entretenimiento','Descripcion de Entretenimiento','2018-01-05 13:00:00','2018-01-05 13:00:00'),(6,'Salud','Descripcion de Salud','2018-01-05 13:00:00','2018-01-05 13:00:00'),(7,'Autos','Descripcion de Autos','2018-01-05 13:00:00','2018-01-05 13:00:00'),(8,'Jardinería','Descripcion de Jardinería','2018-01-05 13:00:00','2018-01-05 13:00:00'),(9,'Patito','Muchos muchos patitos.','2018-02-27 05:33:50','2018-02-27 05:33:50');

#
# Structure for table "CompanyClients"
#

DROP TABLE IF EXISTS `CompanyClients`;
CREATE TABLE `CompanyClients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `city` varchar(70) DEFAULT NULL,
  `state` varchar(70) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "CompanyClients"
#

INSERT INTO `CompanyClients` VALUES (1,'Empresa 1','EPR103013I3','Mérida','Yucatán','2018-01-05 13:00:00','2018-01-05 13:00:00'),(2,'Empresa 2','EPR206506I9','Mérida','Yucatán','2018-01-05 13:00:00','2018-01-05 13:00:00'),(3,'Empresa 3','EPR305656I7','Mérida','Yucatán','2018-01-05 13:00:00','2018-01-05 13:00:00'),(4,'Empresa 4','EPR495456I8','Mérida','Yucatán','2018-01-05 13:00:00','2018-01-05 13:00:00');

#
# Structure for table "CompanyDetails"
#

DROP TABLE IF EXISTS `CompanyDetails`;
CREATE TABLE `CompanyDetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `is_premium` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `urlImage` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `CompanyDetails_id_company_fk` (`id_company`),
  CONSTRAINT `CompanyDetails_id_company_fk` FOREIGN KEY (`id_company`) REFERENCES `CompanyClients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "CompanyDetails"
#

INSERT INTO `CompanyDetails` VALUES (1,1,21.0364,-89.6464,0,1,'/images/companies/1.jpg','2018-01-05 13:00:00','2018-01-05 13:00:00'),(2,2,20.9478,-89.5777,0,1,'/images/companies/2.jpg','2018-01-05 13:00:00','2018-01-05 13:00:00'),(3,3,21.037,-89.6091,0,1,'/images/companies/3.jpg','2018-01-05 13:00:00','2018-01-05 13:00:00'),(4,4,20.9243,-89.6402,0,1,'/images/companies/4.jpg','2018-01-05 13:00:00','2018-01-05 13:00:00');

#
# Structure for table "customers"
#

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "customers"
#

INSERT INTO `customers` VALUES (1,'prueba@studioav.com.mx','$2y$10$Hcdm6YnTZuQlTeCA6oF7Euv6R9f5ASv7qiUEv/9iif4P4Ys3MBkQy','WeWIuYpbS6665zaeuB7ZUXi1TF2H6USJ8OtW9ZYV2XA9PqpFFfQrofZWBsxH','Usuario prueba','2018-01-19 02:54:45','2018-01-19 02:54:45'),(2,'prueba2@studioav.com.mx','$2y$10$92Ze2JdKSWS7ZcJMyywUqeFbUomLickS10v7LqHHbaHvc06/sLO3a','TZPgaRYhXef2yNzGJA2ygwzS9qXOJ0tiHsEX9H9O1giRqTOIEHflmRrTbi8N','Usuario de prueba 2','2018-01-19 02:56:08','2018-01-19 02:56:08'),(3,'prueba3@studioav.com.mx','$2y$10$fgs2w9MffiqcBIMkSLh6muDokBL.skPDJglzl4YBF1fAzxhd0vz2W','h1nVcBmGRFMHa5tb1msOhWdWHWJhMzpE13Wpp9r2Br5TVEAS1MemTUHr94Cu','Usuario de prueba 3','2018-01-19 02:56:45','2018-01-19 02:56:45'),(4,'prueba4@studioav.com.mx','$2y$10$jDowXaE1W3X3T/alVeIVUe1/heJYDfsGDYoefK5I0maVmwHySesxe','YeksUyt4PAvtmgcYM43uMgfMcBjYRW7oCAg8vFIDnymfd7tKYGpcdjAuf8no','Usuario de prueba 4','2018-01-19 02:57:51','2018-01-19 02:57:51'),(5,'prueba5@studioav.com.mx','$2y$10$gjcFAPCNAqz2LasPXaG5AOR1OfYKOjgua7lzqlcumVMd9/L2Ui3J.','Pjyv4aIYoILlHGS7bZHNP5awPxGbnDRuuNkhIZG82FKBnHkqcy7oj0S2njaU','Usuario de prueba 5','2018-01-19 02:58:28','2018-01-19 02:58:28');

#
# Structure for table "CustomersProfiles"
#

DROP TABLE IF EXISTS `CustomersProfiles`;
CREATE TABLE `CustomersProfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `CustomersProfiles_id_user_fk` (`id_customer`),
  CONSTRAINT `CustomersProfiles_id_user_fk` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "CustomersProfiles"
#

INSERT INTO `CustomersProfiles` VALUES (2,1,'Cuy Sanchez','David de los Santos','Calle 59D #263 x 122 y 124C. Fracc Yucalpeten','9991941528','Mérida','Yucatán','2018-01-05 13:00:00','2018-01-05 13:00:00');

#
# Structure for table "Devices"
#

DROP TABLE IF EXISTS `Devices`;
CREATE TABLE `Devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mac` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mac` (`mac`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "Devices"
#

INSERT INTO `Devices` VALUES (1,'0A:01:05:14:B2:42','2018-01-05 13:00:00','2018-01-05 13:00:00'),(2,'0A:01:05:14:B2:43','2018-01-05 13:00:00','2018-01-05 13:00:00'),(3,'0A:01:05:14:B2:44','2018-01-05 13:00:00','2018-01-05 13:00:00');

#
# Structure for table "migrations"
#

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "migrations"
#

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2017_12_19_224316_create_customer_password_resets_table',1),(2,'2018_01_16_204153_create_admins_table',1),(3,'2018_01_16_204154_create_admin_password_resets_table',1),(4,'2018_01_16_215552_create_admins_table',2),(5,'2018_01_16_215553_create_admin_password_resets_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

#
# Structure for table "Publications"
#

DROP TABLE IF EXISTS `Publications`;
CREATE TABLE `Publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT NULL,
  `id_company` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `urlImage` varchar(100) DEFAULT NULL,
  `is_coupon` tinyint(1) DEFAULT '0',
  `clicked` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Publications_id_company_fk` (`id_company`),
  CONSTRAINT `Publications_id_company_fk` FOREIGN KEY (`id_company`) REFERENCES `CompanyClients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

#
# Data for table "Publications"
#

INSERT INTO `Publications` VALUES (1,1,1,'Titulo 1','Promociones en artículo 1','/images/messages/1.jpg',0,11,'2018-01-05 13:00:00','2018-02-21 02:43:40'),(2,2,1,'Titulo 2','Promociones en artículo 2','/images/messages/2.jpg',0,9,'2018-01-05 13:00:00','2018-02-26 23:31:51'),(3,1,1,'Titulo 3','Promociones en artículo 3','/images/messages/3.jpg',1,8,'2018-01-05 13:00:00','2018-02-27 03:01:32'),(4,4,1,'Titulo 4','Promociones en artículo 4','/images/messages/4.jpg',0,3,'2018-01-05 13:00:00','2018-02-20 19:08:41'),(5,5,1,'Titulo 5','Promociones en artículo 5','/images/messages/5.jpg',0,0,'2018-01-05 13:00:00','2018-01-05 13:00:00'),(6,6,2,'Titulo 6','Promociones en artículo 1','/images/messages/6.jpg',0,0,'2018-01-05 13:00:00','2018-01-05 13:00:00'),(7,7,2,'Titulo 7','Promociones en artículo 2','/images/messages/7.jpg',1,6,'2018-01-05 13:00:00','2018-02-15 20:09:13'),(8,8,2,'Titulo 8','Promociones en artículo 3','/images/messages/8.jpg',0,2,'2018-01-05 13:00:00','2018-02-04 19:03:46'),(9,1,3,'Titulo 9','Promociones en artículo 6','/images/messages/9.jpg',0,0,'2018-01-05 13:00:00','2018-01-05 13:00:00'),(10,2,4,'Titulo 10','Promociones en artículo 5','/images/messages/10.jpg',1,2,'2018-01-05 13:00:00','2018-02-20 02:38:38'),(11,3,4,'Titulo 11','Promociones en artículo 6','/images/messages/11.jpg',0,0,'2018-01-05 13:00:00','2018-01-05 13:00:00'),(12,4,4,'Titulo 12','Promociones en artículo 7','/images/messages/12.jpg',0,0,'2018-01-05 13:00:00','2018-01-05 13:00:00'),(13,5,4,'Titulo 12','Promociones en artículo 8','/images/messages/13.jpg',0,0,'2018-01-05 13:00:00','2018-01-05 13:00:00'),(14,3,2,'Placa','Assdasda','/images/messages/14.jpg',3,0,'2018-02-20 11:09:34','2018-02-20 11:09:34'),(15,1,3,'Grafica','Esta es una gráfica','/images/messages/15.jpg',1,0,'2018-02-20 11:12:53','2018-02-20 11:12:53'),(16,4,4,'Grafica 2','Asdasvdfasfa','/images/messages/16.jpg',0,0,'2018-02-20 11:15:35','2018-02-20 11:15:35'),(17,2,2,'Captura de pantalla','Asda asdasdasa','/images/messages/17.jpg',1,2,'2018-02-20 11:16:27','2018-02-21 02:38:16'),(18,5,3,'Sin Archivo','Publicacion sin archivo','/images/messages/18.jpg',0,0,'2018-02-20 11:30:46','2018-02-20 11:30:47'),(19,2,3,'Servo','Imagen de servomotor','/images/messages/19.jpg',1,1,'2018-02-20 11:54:12','2018-02-20 11:54:59'),(20,2,3,'Placa PCB','Ejemplo de nueva publicación','/images/messages/20.jpg',1,1,'2018-02-21 02:45:29','2018-02-21 02:45:55'),(21,9,1,'Holi','Holiboli','/images/messages/21.jpg',1,0,'2018-02-27 05:37:20','2018-02-27 05:37:20');

#
# Structure for table "Messages"
#

DROP TABLE IF EXISTS `Messages`;
CREATE TABLE `Messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_publication` int(11) NOT NULL,
  `message` varchar(140) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Messages_id_company_fk` (`id_publication`),
  CONSTRAINT `Messages_id_company_fk` FOREIGN KEY (`id_publication`) REFERENCES `Publications` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

#
# Data for table "Messages"
#

INSERT INTO `Messages` VALUES (1,1,'Mensaje para publicacion 1','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(2,2,'Mensaje para publicacion 2','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(3,3,'Mensaje para publicacion 3','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(4,4,'Mensaje para publicacion 4','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(5,5,'Mensaje para publicacion 5','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(6,6,'Mensaje para publicacion 6','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(7,7,'Mensaje para publicacion 7','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(8,8,'Mensaje para publicacion 8','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(9,9,'Mensaje para publicacion 9','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(10,8,'Mensaje para publicacion 8','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(11,9,'Mensaje para publicacion 9','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(12,10,'Mensaje para publicacion 10','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(13,11,'Mensaje para publicacion 11','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(14,12,'Mensaje para publicacion 12','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(15,13,'Mensaje para publicacion 13','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00'),(16,2,'Mensaje para publicacion 2','www.example.com','2018-01-05 13:00:00','2018-01-05 13:00:00');

#
# Structure for table "MessagesDevices"
#

DROP TABLE IF EXISTS `MessagesDevices`;
CREATE TABLE `MessagesDevices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_device` int(11) DEFAULT NULL,
  `id_message` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `MessagesDevices_id_device_fk` (`id_device`),
  KEY `MessagesDevices_id_message_fk` (`id_message`),
  CONSTRAINT `MessagesDevices_id_device_fk` FOREIGN KEY (`id_device`) REFERENCES `Devices` (`id`),
  CONSTRAINT `MessagesDevices_id_message_fk` FOREIGN KEY (`id_message`) REFERENCES `Messages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

#
# Data for table "MessagesDevices"
#

INSERT INTO `MessagesDevices` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,2,6),(7,2,7),(8,2,8),(9,2,9),(10,2,10),(11,3,6),(12,3,11),(13,3,12),(14,3,2),(15,3,13);

#
# Structure for table "CouponBooks"
#

DROP TABLE IF EXISTS `CouponBooks`;
CREATE TABLE `CouponBooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) DEFAULT NULL,
  `id_publication` int(11) DEFAULT NULL,
  `used` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `CouponBooks_customer_fk` (`id_customer`),
  KEY `CouponBooks_id_publication_fk` (`id_publication`),
  CONSTRAINT `CouponBooks_customer_fk` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`),
  CONSTRAINT `CouponBooks_id_publication_fk` FOREIGN KEY (`id_publication`) REFERENCES `Publications` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

#
# Data for table "CouponBooks"
#

INSERT INTO `CouponBooks` VALUES (1,1,3,0),(2,1,7,0),(3,1,10,0),(5,1,7,0),(6,1,10,0),(7,2,3,0),(8,2,7,0),(9,3,3,0),(10,3,10,0),(11,4,7,1),(12,5,3,0),(13,5,7,1),(14,5,10,0);
