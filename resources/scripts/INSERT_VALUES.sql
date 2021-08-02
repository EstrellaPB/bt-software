-- TABLE Categories
INSERT INTO `Categories` (`shortDescription`, `longDescription`, `created_at`, `updated_at`) VALUES('Abarrotes', 'Descripcion de abarrotes', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Categories` (`shortDescription`, `longDescription`, `created_at`, `updated_at`) VALUES('Computadoras', 'Descripcion de Computadoras', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Categories` (`shortDescription`, `longDescription`, `created_at`, `updated_at`) VALUES('Entretenimiento', 'Descripcion de Entretenimiento', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Categories` (`shortDescription`, `longDescription`, `created_at`, `updated_at`) VALUES('Ropa', 'Descripcion de Ropa', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Categories` (`shortDescription`, `longDescription`, `created_at`, `updated_at`) VALUES('Entretenimiento', 'Descripcion de Entretenimiento', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Categories` (`shortDescription`, `longDescription`, `created_at`, `updated_at`) VALUES('Salud', 'Descripcion de Salud', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Categories` (`shortDescription`, `longDescription`, `created_at`, `updated_at`) VALUES('Autos', 'Descripcion de Autos', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Categories` (`shortDescription`, `longDescription`, `created_at`, `updated_at`) VALUES('Jardinería', 'Descripcion de Jardinería', '2018-01-05 13:00:00', '2018-01-05 13:00:00');

-- TABLE CompanyClients

INSERT INTO `CompanyClients` (`name`, `rfc`, `city`, `state`, `created_at`, `updated_at`) VALUES ('Empresa 1', 'EPR103013I3', 'Mérida', 'Yucatán', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `CompanyClients` (`name`, `rfc`, `city`, `state`, `created_at`, `updated_at`) VALUES ('Empresa 2', 'EPR206506I9', 'Mérida', 'Yucatán', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `CompanyClients` (`name`, `rfc`, `city`, `state`, `created_at`, `updated_at`) VALUES ('Empresa 3', 'EPR305656I7', 'Mérida', 'Yucatán', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `CompanyClients` (`name`, `rfc`, `city`, `state`, `created_at`, `updated_at`) VALUES ('Empresa 4', 'EPR495456I8', 'Mérida', 'Yucatán', '2018-01-05 13:00:00', '2018-01-05 13:00:00');


-- TABLE CompanyDetails
INSERT INTO `CompanyDetails`(`id_company`, `latitude`, `longitude`, `urlImage`, `created_at`, `updated_at`) VALUES(1, 21.0363619, -89.6464408, '/images/companies/1.jpg', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `CompanyDetails`(`id_company`, `latitude`, `longitude`, `urlImage`, `created_at`, `updated_at`) VALUES(2, 20.9478413, -89.5776892, '/images/companies/2.jpg', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `CompanyDetails`(`id_company`, `latitude`, `longitude`, `urlImage`, `created_at`, `updated_at`) VALUES(3, 21.0369709, -89.6091175, '/images/companies/3.jpg', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `CompanyDetails`(`id_company`, `latitude`, `longitude`, `urlImage`, `created_at`, `updated_at`) VALUES(4, 20.924336, -89.6402281, '/images/companies/4.jpg', '2018-01-05 13:00:00', '2018-01-05 13:00:00');

-- TABLE CustomersProfiles
INSERT INTO `CustomersProfiles`(`id_customer`, `first_name`, `last_name`, `address`, `tel`, `city`, `state`, `created_at`, `updated_at`) VALUES(1, 'Cuy Sanchez', 'David de los Santos', 'Calle 59D #263 x 122 y 124C. Fracc Yucalpeten', '9991941528', 'Mérida', 'Yucatán', '2018-01-05 13:00:00', '2018-01-05 13:00:00');

-- TABLE Devices
INSERT INTO `Devices`(`mac`, `created_at`, `updated_at`) VALUES ('0A:01:05:14:B2:42', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Devices`(`mac`, `created_at`, `updated_at`) VALUES ('0A:01:05:14:B2:43', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Devices`(`mac`, `created_at`, `updated_at`) VALUES ('0A:01:05:14:B2:44', '2018-01-05 13:00:00', '2018-01-05 13:00:00');

-- TABLE Publications
INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (1, 1, 'Titulo 1', 'Promociones en artículo 1', '/images/messages/1.jpg', FALSE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (2, 1, 'Titulo 2', 'Promociones en artículo 2', '/images/messages/2.jpg', FALSE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (3, 1, 'Titulo 3', 'Promociones en artículo 3', '/images/messages/3.jpg', TRUE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (4, 1, 'Titulo 4', 'Promociones en artículo 4', '/images/messages/4.jpg', FALSE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (5, 1, 'Titulo 5', 'Promociones en artículo 5', '/images/messages/5.jpg', FALSE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');

INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (6, 2, 'Titulo 6', 'Promociones en artículo 1', '/images/messages/6.jpg', FALSE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (7, 2, 'Titulo 7', 'Promociones en artículo 2', '/images/messages/7.jpg', TRUE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (8, 2, 'Titulo 8', 'Promociones en artículo 3', '/images/messages/8.jpg', FALSE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');

INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (1, 3, 'Titulo 9', 'Promociones en artículo 6', '/images/messages/9.jpg', FALSE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');

INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (2, 4, 'Titulo 10', 'Promociones en artículo 5', '/images/messages/10.jpg', TRUE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (3, 4, 'Titulo 11', 'Promociones en artículo 6', '/images/messages/11.jpg', FALSE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (4, 4, 'Titulo 12', 'Promociones en artículo 7', '/images/messages/12.jpg', FALSE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Publications`(`id_category`, `id_company`, `title`, `description`, `urlImage`, `is_coupon`, `created_at`, `updated_at`) VALUES (5, 4, 'Titulo 12', 'Promociones en artículo 8', '/images/messages/13.jpg', FALSE, '2018-01-05 13:00:00', '2018-01-05 13:00:00');

-- TABLE CouponBooks
INSERT INTO `CouponBooks`(`id_customer`, `id_publication`) VALUES (1, 3);
INSERT INTO `CouponBooks`(`id_customer`, `id_publication`) VALUES (1, 7);
INSERT INTO `CouponBooks`(`id_customer`, `id_publication`) VALUES (1, 10);

INSERT INTO `CouponBooks`(`id_customer`, `id_publication`) VALUES (2, 3);
INSERT INTO `CouponBooks`(`id_customer`, `id_publication`) VALUES (2, 7);

INSERT INTO `CouponBooks`(`id_customer`, `id_publication`) VALUES (3, 3);
INSERT INTO `CouponBooks`(`id_customer`, `id_publication`) VALUES (3, 10);

INSERT INTO `CouponBooks`(`id_customer`, `id_publication`) VALUES (4, 7);

INSERT INTO `CouponBooks`(`id_customer`, `id_publication`) VALUES (5, 3);
INSERT INTO `CouponBooks`(`id_customer`, `id_publication`) VALUES (5, 7);
INSERT INTO `CouponBooks`(`id_customer`, `id_publication`) VALUES (5, 10);

-- TABLE Message
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (1, 'Mensaje para publicacion 1', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (2, 'Mensaje para publicacion 2', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (3, 'Mensaje para publicacion 3', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (4, 'Mensaje para publicacion 4', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (5, 'Mensaje para publicacion 5', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (6, 'Mensaje para publicacion 6', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (7, 'Mensaje para publicacion 7', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (8, 'Mensaje para publicacion 8', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (9, 'Mensaje para publicacion 9', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (8, 'Mensaje para publicacion 8', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (9, 'Mensaje para publicacion 9', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (10, 'Mensaje para publicacion 10', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (11, 'Mensaje para publicacion 11', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (12, 'Mensaje para publicacion 12', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (13, 'Mensaje para publicacion 13', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');
INSERT INTO `Messages`(`id_publication`, `message`, `url`, `created_at`, `updated_at`) VALUES (2, 'Mensaje para publicacion 2', 'www.example.com', '2018-01-05 13:00:00', '2018-01-05 13:00:00');


-- TABLE MessagesDevices
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (1, 1);
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (1, 2);
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (1, 3);
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (1, 4);
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (1, 5);

INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (2, 6);
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (2, 7);
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (2, 8);
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (2, 9);
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (2, 10);

INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (3, 6);
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (3, 11);
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (3, 12);
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (3, 2);
INSERT INTO `MessagesDevices`(`id_device`, `id_message`) VALUES (3, 13);