-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-06-2014 a las 02:40:55
-- Versión del servidor: 5.6.12
-- Versión de PHP: 5.5.3

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cookbook`
--
CREATE DATABASE IF NOT EXISTS `cookbook` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cookbook`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `dadoDeBaja` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`id`, `nombre`, `dadoDeBaja`, `created_at`, `updated_at`) VALUES
(1, 'Sin Autor', 0, '2014-05-01 00:00:00', '2014-05-01 00:00:00'),
(2, 'Carmen Valldejuli', 0, NULL, NULL),
(3, 'Kristen Feola', 0, NULL, NULL),
(4, 'Mirta G. Carabajal', 0, NULL, NULL),
(5, 'Petrona C. de Gandulfo', 0, NULL, NULL),
(6, 'Christine Bailey', 0, NULL, NULL),
(7, 'Toni Rodriguez', 0, NULL, NULL),
(8, 'Cecilia Fassardi', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE IF NOT EXISTS `editorial` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `dadoDeBaja` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`id`, `nombre`, `dadoDeBaja`, `created_at`, `updated_at`) VALUES
(1, 'Sin Editorial', 0, '2014-05-01 00:00:00', '2014-05-01 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `dadoDeBaja` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `etiqueta`
--

INSERT INTO `etiqueta` (`id`, `nombre`, `dadoDeBaja`, `created_at`, `updated_at`) VALUES
(1, 'Sin Etiqueta', 0, '2014-05-01 00:00:00', '2014-05-01 00:00:00'),
(2, 'criolla', 0, NULL, NULL),
(3, 'cupcakes', 0, NULL, NULL),
(4, 'guía', 0, NULL, NULL),
(5, 'jugos', 0, NULL, NULL),
(6, 'viandas', 0, NULL, NULL),
(7, 'recetas', 0, NULL, NULL),
(8, 'rústica', 0, NULL, NULL),
(9, 'zumos', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idioma`
--

CREATE TABLE IF NOT EXISTS `idioma` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `dadoDeBaja` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `idioma`
--

INSERT INTO `idioma` (`id`, `nombre`, `dadoDeBaja`, `created_at`, `updated_at`) VALUES
(1, 'Sin idioma', 0, NULL, NULL),
(2, 'Español', 0, NULL, NULL),
(3, 'Inglés', 0, NULL, NULL),
(4, 'Alemán', 0, NULL, NULL),
(5, 'Francés', 0, NULL, NULL),
(6, 'Italiano', 0, NULL, NULL),
(7, 'Portugués', 0, NULL, NULL),
(8, 'Japonés', 0, NULL, NULL),
(9, 'Chino', 0, NULL, NULL),
(10, 'Coreano', 0, NULL, NULL),
(11, 'Árabe', 0, NULL, NULL),
(12, 'Turco', 0, NULL, NULL),
(13, 'Ruso', 0, NULL, NULL),
(14, 'Polaco', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE IF NOT EXISTS `libro` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isbn` varchar(15) NOT NULL,
  `título` varchar(128) NOT NULL,
  `hojas` smallint(6) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `agotado` tinyint(1) NOT NULL DEFAULT '0',
  `tapa` varchar(128) DEFAULT NULL,
  `índice` varchar(128) DEFAULT NULL,
  `añoEdición` smallint(6) NOT NULL,
  `editorial_id` int(10) unsigned NOT NULL,
  `idioma_id` int(10) unsigned NOT NULL,
  `dadoDeBaja` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn_UNIQUE` (`isbn`),
  KEY `fk_Libro_1` (`editorial_id`),
  KEY `idioma_id` (`idioma_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `isbn`, `título`, `hojas`, `precio`, `agotado`, `tapa`, `índice`, `añoEdición`, `editorial_id`, `idioma_id`, `dadoDeBaja`, `created_at`, `updated_at`) VALUES
(1, '882894293', 'Cocina criolla', 87, '58.99', 0, '1.jpg', '1.jpg', 1983, 1, 2, 0, NULL, '2014-06-01 06:28:57'),
(2, '123456789', 'La guía óptima para el ayuno de Daniel', 68, '69.00', 0, '2.jpg', '2.jpg', 2001, 1, 2, 0, NULL, '2014-06-01 06:39:16'),
(3, '879548481', 'Las mejores recetas de rico y abundante', 70, '87.45', 0, '3.jpg', '3.jpg', 2012, 1, 2, 0, NULL, NULL),
(4, '888444777', 'Cocina con calor de hogar - rústica', 154, '152.21', 0, '4.jpg', '4.jpg', 2006, 1, 2, 0, NULL, NULL),
(5, '878987655', 'La dieta de los zumos', 54, '99.99', 0, '5.jpg', '5.jpg', 1999, 1, 2, 0, NULL, NULL),
(6, '1478523698', 'Cupcakes veganos', 55, '47.80', 0, '6.jpg', '6.jpg', 2011, 1, 2, 0, NULL, NULL),
(7, '8521479632', 'El libro de las viandas para pequeños', 87, '79.84', 0, '7.jpg', '7.jpg', 2012, 1, 2, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroautor`
--

CREATE TABLE IF NOT EXISTS `libroautor` (
  `libro_id` int(10) unsigned NOT NULL,
  `autor_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`libro_id`,`autor_id`),
  KEY `fk_LibroAutor_1` (`libro_id`),
  KEY `fk_LibroAutor_2` (`autor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libroautor`
--

INSERT INTO `libroautor` (`libro_id`, `autor_id`) VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 7),
(7, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroetiqueta`
--

CREATE TABLE IF NOT EXISTS `libroetiqueta` (
  `libro_id` int(10) unsigned NOT NULL,
  `etiqueta_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`libro_id`,`etiqueta_id`),
  KEY `fk_LibroEtiqueta_1` (`libro_id`),
  KEY `fk_LibroEtiqueta_2` (`etiqueta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libroetiqueta`
--

INSERT INTO `libroetiqueta` (`libro_id`, `etiqueta_id`) VALUES
(1, 2),
(2, 4),
(3, 7),
(4, 8),
(5, 5),
(5, 9),
(6, 3),
(7, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libropedido`
--

CREATE TABLE IF NOT EXISTS `libropedido` (
  `libro_id` int(10) unsigned NOT NULL,
  `pedido_id` int(10) unsigned NOT NULL,
  `cantidad` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`libro_id`,`pedido_id`),
  KEY `fk_LibroPedido_1` (`libro_id`),
  KEY `fk_LibroPedido_2` (`pedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE IF NOT EXISTS `mensaje` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asunto` varchar(128) DEFAULT NULL,
  `cuerpo` varchar(512) DEFAULT NULL,
  `leído` tinyint(1) NOT NULL DEFAULT '0',
  `usuario_id` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Mensaje_1` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `monto` decimal(8,2) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(1) NOT NULL DEFAULT 'p',
  `usuario_id` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Pedido_1` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE IF NOT EXISTS `provincia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Buenos Aires', '2014-05-01 00:00:00', '2014-05-01 00:00:00'),
(2, 'Capital Federal', NULL, NULL),
(3, 'Catamarca', NULL, NULL),
(4, 'Chaco', NULL, NULL),
(5, 'Chubut', NULL, NULL),
(6, 'Córdoba', NULL, NULL),
(7, 'Corrientes', NULL, NULL),
(8, 'Entre Ríos', NULL, NULL),
(9, 'Formosa', NULL, NULL),
(10, 'Jujuy', NULL, NULL),
(11, 'La Pampa', NULL, NULL),
(12, 'La Rioja', NULL, NULL),
(13, 'Mendoza', NULL, NULL),
(14, 'Misiones', NULL, NULL),
(15, 'Neuquén', NULL, NULL),
(16, 'Rio Negro', NULL, NULL),
(17, 'Salta', NULL, NULL),
(18, 'San Juan', NULL, NULL),
(19, 'San Luis', NULL, NULL),
(20, 'Santa Cruz', NULL, NULL),
(21, 'Santa Fe', NULL, NULL),
(22, 'Santiago del Estero', NULL, NULL),
(23, 'Tierra del Fuego', NULL, NULL),
(24, 'Tucumán', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrodeerrores`
--

CREATE TABLE IF NOT EXISTS `registrodeerrores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `descripción` varchar(255) DEFAULT NULL,
  `tipo_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_RegistroDeErrores_1` (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodeerror`
--

CREATE TABLE IF NOT EXISTS `tipodeerror` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `apellido` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `contraseña` varchar(128) NOT NULL,
  `esAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `dni` varchar(11) DEFAULT NULL,
  `teléfono` varchar(128) DEFAULT NULL,
  `bloqueado` tinyint(1) DEFAULT '0',
  `dadoDeBaja` tinyint(1) DEFAULT '0',
  `localidad` varchar(128) DEFAULT NULL,
  `dirección` varchar(128) DEFAULT NULL,
  `provincia_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `provincia_id` (`provincia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`, `contraseña`, `esAdmin`, `dni`, `teléfono`, `bloqueado`, `dadoDeBaja`, `localidad`, `dirección`, `provincia_id`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'Ruben', '***', 'admin@gmail.com', '$2y$10$WBTcG5CT3sNfD88/MBZjBuAmYn8OwfctuD/vT70P6W3wrreMbyifa', 1, NULL, '---', 0, 0, '---', '---', 1, '2014-05-01 00:00:00', '2014-05-01 00:00:00', NULL),
(2, 'Carlos', 'Sanchez', 'csanchez@gmail.com', '$2y$10$axTLXQNhxJFVyihyHv2pGuZCNEQgfnCskpPNKYlUZcZjqNRuJxxIO', 0, '11.454.789', '---', 0, 0, '---', '---', 1, '1983-03-31 00:00:00', '2014-06-01 06:43:33', NULL),
(3, 'Roberto', 'Juarez', 'rjuarez@gmail.com', '$2y$10$axTLXQNhxJFVyihyHv2pGuZCNEQgfnCskpPNKYlUZcZjqNRuJxxIO', 0, '10.222.333', '---', 0, 0, '---', '---', 1, '2001-08-25 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 'Ariel', 'Pasini', 'apasini@gmail.com', '$2y$10$axTLXQNhxJFVyihyHv2pGuZCNEQgfnCskpPNKYlUZcZjqNRuJxxIO', 0, '30.876.961', '---', 0, 0, '---', '---', 1, '2012-07-24 00:00:00', '0000-00-00 00:00:00', NULL),
(5, 'Nicolás', 'Galdámez', 'ngaldamez@gmail.com', '$2y$10$axTLXQNhxJFVyihyHv2pGuZCNEQgfnCskpPNKYlUZcZjqNRuJxxIO', 0, '2.968.741', '---', 0, 0, '---', '---', 1, '2006-06-06 00:00:00', '0000-00-00 00:00:00', NULL),
(6, 'Sebastián', 'Eguren', 'seuguren@gmail.com', '$2y$10$axTLXQNhxJFVyihyHv2pGuZCNEQgfnCskpPNKYlUZcZjqNRuJxxIO', 0, '3.478.987', '---', 0, 0, '---', '---', 1, '1999-05-03 00:00:00', '0000-00-00 00:00:00', NULL),
(7, 'María', 'Lopez', 'mlopez@gmail.com', '$2y$10$axTLXQNhxJFVyihyHv2pGuZCNEQgfnCskpPNKYlUZcZjqNRuJxxIO', 0, '12.547.897', '---', 0, 0, '---', '---', 1, '2011-01-02 00:00:00', '0000-00-00 00:00:00', NULL),
(8, 'Catalina', 'Perez', 'cperez@gmail.com', '$2y$10$axTLXQNhxJFVyihyHv2pGuZCNEQgfnCskpPNKYlUZcZjqNRuJxxIO', 0, '14.879.564', '---', 0, 0, '---', '---', 1, '2012-01-01 00:00:00', '2014-06-01 06:48:28', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `fk_Libro_1` FOREIGN KEY (`editorial_id`) REFERENCES `editorial` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Libro_2` FOREIGN KEY (`idioma_id`) REFERENCES `idioma` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libroautor`
--
ALTER TABLE `libroautor`
  ADD CONSTRAINT `fk_LibroAutor_1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LibroAutor_2` FOREIGN KEY (`autor_id`) REFERENCES `autor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libroetiqueta`
--
ALTER TABLE `libroetiqueta`
  ADD CONSTRAINT `fk_LibroEtiqueta_1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LibroEtiqueta_2` FOREIGN KEY (`etiqueta_id`) REFERENCES `etiqueta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libropedido`
--
ALTER TABLE `libropedido`
  ADD CONSTRAINT `fk_LibroPedido_1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LibroPedido_2` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_Mensaje_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_Pedido_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registrodeerrores`
--
ALTER TABLE `registrodeerrores`
  ADD CONSTRAINT `fk_RegistroDeErrores_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipodeerror` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_prov` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
