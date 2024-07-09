-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para virtulentes
CREATE DATABASE IF NOT EXISTS `virtulentes` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `virtulentes`;

-- Volcando estructura para tabla virtulentes.administrador
CREATE TABLE IF NOT EXISTS `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.administrador: ~2 rows (aproximadamente)
REPLACE INTO `administrador` (`id`, `usuario`, `contrasena`) VALUES
	(1, 'marco', '123'),
	(2, 'jean', '123');

-- Volcando estructura para tabla virtulentes.carrito
CREATE TABLE IF NOT EXISTS `carrito` (
  `id_carrito` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_carrito`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.carrito: ~0 rows (aproximadamente)

-- Volcando estructura para tabla virtulentes.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.categorias: ~5 rows (aproximadamente)
REPLACE INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
	(1, 'Lentes de Sol'),
	(2, 'Lentes de Lectura'),
	(3, 'Lentes de Contacto'),
	(4, 'Lentes de Seguridad'),
	(5, 'Lentes Deportivos');

-- Volcando estructura para tabla virtulentes.detalle_carrito
CREATE TABLE IF NOT EXISTS `detalle_carrito` (
  `id_detalle_carrito` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrito` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle_carrito`),
  KEY `id_carrito` (`id_carrito`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `detalle_carrito_ibfk_1` FOREIGN KEY (`id_carrito`) REFERENCES `carrito` (`id_carrito`) ON DELETE CASCADE,
  CONSTRAINT `detalle_carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.detalle_carrito: ~0 rows (aproximadamente)

-- Volcando estructura para tabla virtulentes.detalle_pedido
CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE,
  CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.detalle_pedido: ~125 rows (aproximadamente)
REPLACE INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `id_producto`, `cantidad`, `precio`) VALUES
	(27, 30, 10, 1, 55.00),
	(28, 30, 3, 1, 227.50),
	(29, 30, 2, 1, 179.99),
	(30, 30, 1, 1, 79.00),
	(31, 31, 10, 1, 55.00),
	(32, 31, 3, 1, 227.50),
	(33, 31, 2, 1, 179.99),
	(34, 31, 1, 2, 158.00),
	(35, 32, 10, 1, 55.00),
	(36, 32, 4, 2, 200.00),
	(37, 33, 6, 1, 99.99),
	(38, 33, 5, 2, 78.00),
	(39, 33, 2, 1, 179.99),
	(40, 34, 6, 2, 199.98),
	(41, 34, 1, 1, 79.00),
	(42, 35, 7, 3, 374.97),
	(43, 35, 2, 1, 179.99),
	(44, 36, 10, 1, 55.00),
	(45, 36, 2, 4, 719.96),
	(46, 37, 8, 3, 286.47),
	(47, 38, 10, 2, 110.00),
	(48, 38, 6, 1, 99.99),
	(49, 38, 5, 2, 78.00),
	(50, 39, 6, 1, 99.99),
	(51, 39, 7, 1, 124.99),
	(52, 40, 9, 2, 98.00),
	(53, 40, 1, 2, 158.00),
	(54, 41, 5, 1, 39.00),
	(55, 41, 2, 1, 179.99),
	(56, 43, 3, 2, 455.00),
	(57, 44, 6, 2, 199.98),
	(58, 44, 3, 1, 227.50),
	(59, 45, 5, 1, 39.00),
	(60, 45, 1, 1, 79.00),
	(61, 46, 5, 1, 39.00),
	(62, 46, 1, 2, 158.00),
	(63, 47, 5, 2, 78.00),
	(64, 47, 1, 3, 237.00),
	(65, 49, 5, 1, 39.00),
	(66, 49, 6, 2, 199.98),
	(67, 50, 3, 1, 227.50),
	(68, 51, 4, 2, 200.00),
	(69, 52, 6, 1, 99.99),
	(70, 53, 1, 1, 79.00),
	(71, 55, 3, 1, 227.50),
	(72, 55, 4, 1, 100.00),
	(73, 58, 5, 1, 39.00),
	(74, 59, 2, 1, 179.99),
	(75, 59, 6, 1, 99.99),
	(76, 60, 6, 1, 99.99),
	(77, 60, 7, 2, 249.98),
	(78, 61, 6, 1, 99.99),
	(79, 61, 5, 1, 39.00),
	(80, 62, 2, 1, 179.99),
	(81, 62, 3, 2, 455.00),
	(82, 63, 6, 1, 99.99),
	(83, 63, 7, 1, 124.99),
	(84, 64, 6, 1, 99.99),
	(85, 66, 2, 1, 179.99),
	(86, 66, 3, 1, 227.50),
	(87, 67, 7, 1, 124.99),
	(88, 67, 1, 1, 79.00),
	(89, 68, 7, 1, 124.99),
	(90, 68, 8, 1, 95.49),
	(91, 69, 3, 1, 227.50),
	(92, 69, 4, 1, 100.00),
	(93, 70, 6, 2, 199.98),
	(94, 71, 6, 1, 99.99),
	(95, 72, 4, 1, 100.00),
	(96, 72, 8, 1, 95.49),
	(97, 73, 3, 1, 227.50),
	(98, 74, 8, 1, 95.49),
	(99, 75, 8, 1, 95.49),
	(100, 76, 6, 1, 99.99),
	(101, 76, 3, 1, 227.50),
	(102, 77, 2, 1, 179.99),
	(103, 77, 3, 1, 227.50),
	(104, 78, 10, 1, 55.00),
	(105, 78, 1, 1, 79.00),
	(106, 79, 4, 1, 100.00),
	(107, 79, 3, 1, 227.50),
	(108, 80, 7, 1, 124.99),
	(109, 81, 5, 1, 39.00),
	(110, 82, 6, 1, 99.99),
	(111, 82, 5, 1, 39.00),
	(112, 83, 3, 1, 227.50),
	(113, 83, 2, 1, 179.99),
	(114, 84, 2, 1, 179.99),
	(115, 84, 3, 1, 227.50),
	(116, 85, 8, 1, 95.49),
	(117, 85, 4, 1, 100.00),
	(118, 86, 7, 1, 124.99),
	(119, 86, 5, 2, 78.00),
	(120, 87, 4, 1, 100.00),
	(121, 87, 3, 1, 227.50),
	(122, 88, 1, 1, 79.00),
	(123, 88, 2, 1, 179.99),
	(124, 89, 7, 1, 124.99),
	(125, 89, 10, 1, 55.00),
	(126, 90, 5, 2, 78.00),
	(127, 91, 7, 1, 124.99),
	(128, 92, 6, 1, 99.99),
	(129, 93, 8, 1, 95.49),
	(130, 94, 6, 1, 99.99),
	(131, 95, 5, 1, 39.00),
	(132, 96, 6, 1, 99.99),
	(133, 96, 4, 2, 200.00),
	(134, 97, 7, 1, 124.99),
	(135, 98, 8, 1, 95.49),
	(136, 99, 7, 1, 124.99),
	(137, 100, 8, 1, 95.49),
	(138, 102, 4, 1, 100.00),
	(139, 102, 3, 1, 227.50),
	(140, 103, 4, 1, 100.00),
	(141, 103, 3, 1, 227.50),
	(142, 104, 3, 1, 227.50),
	(143, 104, 4, 1, 100.00),
	(144, 105, 7, 1, 124.99),
	(145, 105, 2, 1, 179.99),
	(146, 106, 7, 1, 124.99),
	(147, 107, 3, 1, 227.50),
	(148, 107, 4, 1, 100.00),
	(149, 108, 7, 1, 124.99),
	(150, 109, 3, 1, 227.50),
	(151, 111, 1, 1, 79.00);

-- Volcando estructura para tabla virtulentes.detalle_producto
CREATE TABLE IF NOT EXISTS `detalle_producto` (
  `id_detalle_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `foto_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_detalle_producto`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.detalle_producto: ~10 rows (aproximadamente)
REPLACE INTO `detalle_producto` (`id_detalle_producto`, `id_producto`, `foto_url`) VALUES
	(1, 1, 'https://drive.google.com/uc?id=13eKujYQJJtbCQZovwY94AMfAM3AY0a5d'),
	(2, 1, 'https://drive.google.com/uc?id=13eKujYQJJtbCQZovwY94AMfAM3AY0a5d'),
	(3, 1, 'https://drive.google.com/uc?id=13eKujYQJJtbCQZovwY94AMfAM3AY0a5d'),
	(4, 2, 'https://drive.google.com/uc?id=13eKujYQJJtbCQZovwY94AMfAM3AY0a5d'),
	(5, 2, 'https://drive.google.com/uc?id=13eKujYQJJtbCQZovwY94AMfAM3AY0a5d'),
	(6, 1, 'https://drive.google.com/uc?id=13eKujYQJJtbCQZovwY94AMfAM3AY0a5d'),
	(7, 1, 'https://drive.google.com/uc?id=13eKujYQJJtbCQZovwY94AMfAM3AY0a5d'),
	(8, 1, 'https://drive.google.com/uc?id=13eKujYQJJtbCQZovwY94AMfAM3AY0a5d'),
	(9, 2, 'https://drive.google.com/uc?id=13eKujYQJJtbCQZovwY94AMfAM3AY0a5d'),
	(10, 2, 'https://drive.google.com/uc?id=13eKujYQJJtbCQZovwY94AMfAM3AY0a5d');

-- Volcando estructura para tabla virtulentes.modelos
CREATE TABLE IF NOT EXISTS `modelos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.modelos: ~11 rows (aproximadamente)
REPLACE INTO `modelos` (`id`, `url`) VALUES
	(1, '3dmodels/lentes.stl'),
	(3, '3dmodels/lentes3.stl'),
	(4, '3dmodels/lentes4.stl'),
	(5, '3dmodels/lentes5.stl'),
	(6, '../presentacion/3dmodels/shuttersummer.stl'),
	(7, '3dmodels/glasses.stl'),
	(8, '3dmodels/lentesNEW.stl'),
	(9, '3dmodels/glasses.stl'),
	(10, '3dmodels/lentesNEW.stl'),
	(11, '3dmodels/lentes1.stl'),
	(12, '3dmodels/shuttersummer.stl');

-- Volcando estructura para tabla virtulentes.model_tipo_rostro
CREATE TABLE IF NOT EXISTS `model_tipo_rostro` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.model_tipo_rostro: ~6 rows (aproximadamente)
REPLACE INTO `model_tipo_rostro` (`id_tipo`, `categoria`) VALUES
	(1, 'circular'),
	(2, 'ovalada'),
	(3, 'rectangular'),
	(4, 'cuadrada'),
	(5, 'triangular'),
	(6, 'diamante');

-- Volcando estructura para tabla virtulentes.pagos
CREATE TABLE IF NOT EXISTS `pagos` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha_pago` datetime DEFAULT current_timestamp(),
  `metodo_pago` enum('tarjeta','paypal','otro') NOT NULL,
  PRIMARY KEY (`id_pago`),
  KEY `id_pedido` (`id_pedido`),
  CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.pagos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla virtulentes.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_pedido` datetime DEFAULT current_timestamp(),
  `estado` enum('pendiente','completado','cancelado') NOT NULL DEFAULT 'pendiente',
  `fecha_entrega` datetime DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.pedidos: ~82 rows (aproximadamente)
REPLACE INTO `pedidos` (`id_pedido`, `id_usuario`, `fecha_pedido`, `estado`, `fecha_entrega`, `direccion`) VALUES
	(30, 2, '2024-06-24 02:37:22', 'pendiente', NULL, 'Tacna'),
	(31, 2, '2024-06-24 02:37:56', 'pendiente', NULL, 'Tacna'),
	(32, 2, '2024-06-24 02:38:26', 'pendiente', NULL, 'Tacna'),
	(33, 2, '2024-06-24 02:38:52', 'pendiente', NULL, 'Tacna'),
	(34, 2, '2024-06-24 02:39:18', 'pendiente', NULL, 'Tacna'),
	(35, 2, '2024-06-24 02:39:47', 'pendiente', NULL, 'Tacna'),
	(36, 2, '2024-06-24 02:40:09', 'pendiente', NULL, 'Tacna'),
	(37, 2, '2024-06-24 02:40:30', 'pendiente', NULL, 'Tacna'),
	(38, 2, '2024-06-24 02:40:54', 'pendiente', NULL, 'Tacna'),
	(39, 2, '2024-06-24 02:41:22', 'pendiente', NULL, 'Tacna'),
	(40, 2, '2024-06-24 02:41:45', 'pendiente', NULL, 'Tacna'),
	(41, 1, '2024-06-24 04:16:36', 'pendiente', NULL, 'Tacna'),
	(42, 1, '2024-06-24 04:18:07', 'pendiente', NULL, 'Tacna'),
	(43, 1, '2024-06-24 04:21:32', 'pendiente', NULL, 'Tacna'),
	(44, 1, '2024-06-24 04:32:16', 'pendiente', NULL, 'Tacna'),
	(45, 1, '2024-06-24 04:46:49', 'pendiente', NULL, 'Tacna'),
	(46, 1, '2024-06-24 04:52:34', 'pendiente', NULL, 'Tacna'),
	(47, 1, '2024-06-24 05:05:54', 'pendiente', NULL, 'Tacna'),
	(48, 1, '2024-06-24 05:10:17', 'pendiente', NULL, 'Tacna'),
	(49, 1, '2024-06-24 05:15:20', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(50, 1, '2024-06-24 05:23:34', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(51, NULL, '2024-06-24 16:45:55', 'pendiente', NULL, 'Tacna'),
	(52, NULL, '2024-06-24 16:51:46', 'pendiente', NULL, 'Tacna'),
	(53, NULL, '2024-06-24 17:00:54', 'pendiente', NULL, 'Tacna'),
	(54, NULL, '2024-06-24 17:04:25', 'pendiente', NULL, 'Tacna'),
	(55, NULL, '2024-06-24 17:13:51', 'pendiente', NULL, 'Tacna'),
	(56, NULL, '2024-06-24 17:36:14', 'pendiente', NULL, 'Tacna'),
	(57, NULL, '2024-06-24 17:36:23', 'pendiente', NULL, 'Tacna'),
	(58, NULL, '2024-06-24 17:40:29', 'pendiente', NULL, 'Tacna'),
	(59, NULL, '2024-06-24 17:57:24', 'pendiente', NULL, 'Tacna'),
	(60, NULL, '2024-06-24 11:20:54', 'pendiente', NULL, 'Tacna'),
	(61, NULL, '2024-06-24 11:23:28', 'pendiente', NULL, 'Tacna'),
	(62, NULL, '2024-06-24 11:40:37', 'pendiente', NULL, 'Tacna'),
	(63, NULL, '2024-06-24 11:46:23', 'pendiente', NULL, 'Tacna'),
	(64, 2, '2024-06-24 12:15:49', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(65, 3, '2024-06-24 14:24:39', 'pendiente', NULL, 'Tacna'),
	(66, 3, '2024-06-24 14:24:45', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(67, 3, '2024-06-24 14:27:33', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(68, 3, '2024-06-24 14:32:59', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(69, 3, '2024-06-24 14:53:22', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(70, 3, '2024-06-24 14:56:10', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(71, 3, '2024-06-24 14:58:40', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(72, 3, '2024-06-24 17:15:02', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(73, 3, '2024-06-24 17:19:27', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(74, 3, '2024-06-24 17:24:28', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(75, 3, '2024-06-25 01:00:49', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(76, 3, '2024-06-25 09:06:12', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(77, 3, '2024-06-25 09:39:56', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(78, 3, '2024-06-25 09:45:33', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(79, 3, '2024-06-25 09:47:06', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(80, 5, '2024-06-25 09:48:01', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(81, 5, '2024-06-25 09:52:28', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(82, 3, '2024-06-25 10:24:53', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(83, 3, '2024-06-25 10:26:44', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(84, 3, '2024-06-25 22:53:00', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(85, 3, '2024-06-25 22:54:23', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(86, 5, '2024-06-25 22:58:31', 'completado', '2024-06-26 00:00:00', 'Tacna'),
	(87, 3, '2024-06-26 23:59:06', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(88, 3, '2024-06-27 09:58:26', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(89, 5, '2024-06-27 10:51:25', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(90, 5, '2024-06-27 10:59:03', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(91, 3, '2024-06-27 11:47:21', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(92, 3, '2024-06-27 11:55:43', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(93, 5, '2024-06-27 12:00:55', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(94, 3, '2024-06-27 12:10:36', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(95, 3, '2024-06-27 12:12:15', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(96, 5, '2024-06-27 13:06:20', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(97, 3, '2024-06-27 13:23:45', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(98, 3, '2024-06-27 13:36:29', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(99, 3, '2024-06-27 13:45:33', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(100, 3, '2024-06-27 13:51:50', 'completado', '2024-06-27 00:00:00', 'Tacna'),
	(101, 4, '2024-06-27 16:30:18', 'pendiente', NULL, 'Tacna'),
	(102, 3, '2024-06-27 17:12:20', 'completado', '2024-06-28 00:00:00', 'Tacna'),
	(103, 3, '2024-06-27 17:13:10', 'pendiente', NULL, 'Tacna'),
	(104, 4, '2024-06-27 17:17:31', 'pendiente', NULL, 'Tacna'),
	(105, 3, '2024-06-27 17:19:05', 'pendiente', NULL, 'Tacna'),
	(106, 3, '2024-06-27 17:21:24', 'completado', '2024-06-28 00:00:00', 'Tacna'),
	(107, 4, '2024-06-27 17:29:23', 'pendiente', NULL, 'Tacna'),
	(108, 5, '2024-06-27 17:37:58', 'pendiente', NULL, 'Tacna'),
	(109, 5, '2024-06-27 17:38:53', 'completado', '2024-06-28 00:00:00', 'Tacna'),
	(110, 3, '2024-06-27 17:51:35', 'pendiente', NULL, 'Tacna'),
	(111, 3, '2024-06-27 17:52:04', 'pendiente', NULL, 'Tacna');

-- Volcando estructura para tabla virtulentes.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `modelo_url` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `material` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_categoria` (`id_categoria`),
  KEY `productos_ibfk_2` (`model_id`),
  KEY `FK_productos_model_tipo_rostro` (`id_tipo`),
  CONSTRAINT `FK_productos_model_tipo_rostro` FOREIGN KEY (`id_tipo`) REFERENCES `model_tipo_rostro` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE SET NULL,
  CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`model_id`) REFERENCES `modelos` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.productos: ~10 rows (aproximadamente)
REPLACE INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio`, `stock`, `modelo_url`, `id_categoria`, `model_id`, `id_tipo`, `material`) VALUES
	(1, 'LENTE VINTAGE NEGRO', 'A29B', 79.00, 100, 'https://i.ibb.co/khrckHP/Hoffman-Mate-Black-B-Sol-20.jpg', 1, 6, 1, 'plastico'),
	(2, 'LENTE VINTAGE ROJO', 'DIEL', 179.99, 50, 'https://i.ibb.co/jk5CGvh/lentes-vintage-rojo.png', 2, 7, 1, 'plastico'),
	(3, 'LENTE URCA AZUL', 'AN4257', 227.50, 200, 'https://i.ibb.co/sW486YG/0an4246-01-25-030a.jpg', 1, 3, 4, 'plastico'),
	(4, 'LENTE MARONI VERDE', 'LEN 006 V', 100.00, 75, 'https://i.ibb.co/37MF6Tq/LEN-006-V.jpg', 3, 4, 4, 'plastico'),
	(5, 'LENTE NILES NEGRO', 'LNTO 18', 39.00, 120, 'https://i.ibb.co/0qFhCHF/new-desc-marca-john-holden-modelo-lnt018-genero-hombre-tipo-lentes-de-sol-proteccion-uv-si-material.jpg', 2, 5, 2, 'plastico'),
	(6, 'LENTE NILES ROJO', 'LNTO 28', 99.99, 100, 'https://i.ibb.co/MVmLBkH/Disenosintitulo-2023-04-20-T180838-542.png', 1, 8, 2, 'plastico'),
	(7, 'LENTE MARONI AZUL', 'LEN 006 A', 124.99, 50, 'https://i.ibb.co/M76YD8V/len-006-a-lentes-maroni-color-azul.jpg', 2, 9, 2, 'plastico'),
	(8, 'LENTE SUNSET VERDE', 'LEN 001 A', 95.49, 200, 'https://articulospromocionaleskw.com/wp-content/uploads/len-001-v-lentes-sunset-color-verde.jpg', 1, 10, 2, 'plastico'),
	(9, 'LENTE DE SOL NEGRO', 'DEPORTIVO', 49.00, 75, 'https://www.mostperu.com/wp-content/uploads/2022/10/gaf-14.1.png', 3, 11, 1, 'plastico'),
	(10, 'LENTE DE SOL ROJO', 'REEVES', 55.00, 120, 'https://fitters.pe/cdn/shop/products/2B.jpg?v=1607531972&width=1445', 2, 12, 3, 'plastico');

-- Volcando estructura para tabla virtulentes.publicidad_email
CREATE TABLE IF NOT EXISTS `publicidad_email` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(50) NOT NULL DEFAULT '0',
  `correo` varchar(50) NOT NULL DEFAULT '0',
  `notificacion` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id_email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.publicidad_email: ~14 rows (aproximadamente)
REPLACE INTO `publicidad_email` (`id_email`, `cliente`, `correo`, `notificacion`) VALUES
	(1, 'marco', 'marconoalcca@gmail.com', b'1'),
	(2, 'gabriel', 'gabo@gmail.com', b'0'),
	(3, 'Urian', 'urian1213viera@gmail.com', b'0'),
	(4, 'Urian Viera', 'programadorphp2017@gmail.com', b'0'),
	(5, 'Developer', 'iamdeveloper86@gmail.com', b'0'),
	(6, 'Jhojan Castillo', 'urianyviera@gmail.com', b'0'),
	(7, 'lois', 'loisa@gmail.com', b'0'),
	(8, 'marcos', 'marcos@gmail.com', b'0'),
	(9, 'raul', 'raul@gmail.com', b'0'),
	(10, 'yuliana', 'yuliana@gmail.com', b'0'),
	(11, 'esther', 'esther@gmail.com', b'0'),
	(12, 'yadomi', 'yadomi@gmail.com', b'0'),
	(13, 'Jededias', 'Jededias@gmail.com', b'0'),
	(14, 'Renzo', 'Renzo@gmail.com', b'0');

-- Volcando estructura para tabla virtulentes.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash_contraseña` varchar(255) NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `dni` int(8) DEFAULT NULL,
  `rol` enum('cliente','administrador') NOT NULL DEFAULT 'cliente',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla virtulentes.usuarios: ~5 rows (aproximadamente)
REPLACE INTO `usuarios` (`id_usuario`, `nombre`, `email`, `hash_contraseña`, `fecha_creacion`, `dni`, `rol`) VALUES
	(1, 'test', 'test@gmail.com', '1234', '2024-06-22 22:01:04', 705456, 'cliente'),
	(2, 'michael', 'michael@gmail.com', '1234', '2024-06-23 15:38:38', 60775533, 'cliente'),
	(3, 'gabo', 'gm2021070311@virtual.upt.pe', '1234', '2024-06-24 14:10:44', 85379845, 'cliente'),
	(4, 'marco', 'marconoalcca@gmail.com', '123', '2024-06-24 16:49:41', 21547887, 'cliente'),
	(5, 'leandro', 'unkown@virtual.upt.pe', '1234', '2024-06-25 09:36:03', 60553355, 'cliente');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
