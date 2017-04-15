-- phpMyAdmin SQL Dump
-- version 3.2.0-beta1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-09-2009 a las 16:17:36
-- Versión del servidor: 5.1.30
-- Versión de PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `demoabm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nivel` enum('USUARIO','ADMIN') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USUARIO',
  `fechaAlta` datetime NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `ultimoLogin` datetime DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paisId` int(11) NOT NULL,
  `comentarios` text COLLATE utf8_spanish2_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `nivel`, `fechaAlta`, `ip`, `activo`, `ultimoLogin`, `email`, `nombre`, `apellido`, `paisId`, `comentarios`) VALUES
(1, 'admin', 'admin', 'ADMIN', '2009-07-27 11:23:03', '127.0.0.1', 1, '2009-08-24 15:42:00', 'admin@demo.com', 'Usuario', 'Administrador', 1, 'soy administrador ;)'),
(2, 'usuario', 'usuario', 'USUARIO', '2009-07-28 16:19:58', '127.0.0.1', 1, '2009-08-24 15:48:46', 'juan@perez.com', 'Juan', 'Perez', 1, NULL),
(4, 'acarizza', '1234', 'USUARIO', '0000-00-00 00:00:00', '127.0.0.1', 0, '2009-08-18 22:10:51', 'email@server.com', 'Andres', 'Carizza', 1, 'probando <b>aa ''comilla "comilla doble \\ barra invertida /barra *asterisco'),
(5, 'maria', '1234', 'USUARIO', '0000-00-00 00:00:00', NULL, 1, NULL, 'maria@hotmail.com', 'Maria', 'Juana', 2, 'Comentarios para el campo de texto'),
(7, 'juan', '1234', 'USUARIO', '0000-00-00 00:00:00', NULL, 1, NULL, 'juan@hotmail.com', 'Juan', '', 4, ''),
(9, 'pepe', '1234', 'USUARIO', '0000-00-00 00:00:00', NULL, 1, NULL, 'pepe@pepe.com', 'Pepe', 'Perez', 3, 'hola que tal');
