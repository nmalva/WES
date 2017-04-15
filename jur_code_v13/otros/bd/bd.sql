-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 13-03-2015 a las 06:11:29
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `CAMEXAM`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Candidate`
--

CREATE TABLE `Candidate` (
  `can_id` int(10) NOT NULL AUTO_INCREMENT,
  `can_dni` int(10) NOT NULL,
  `can_firstname` varchar(50) NOT NULL,
  `can_lastname` varchar(50) NOT NULL,
  `can_gender` tinyint(1) NOT NULL,
  `can_datebirth` date NOT NULL,
  `can_email` varchar(50) NOT NULL,
  `can_adress` varchar(100) NOT NULL,
  `can_telephone` varchar(20) NOT NULL,
  `can_cellphone` varchar(20) NOT NULL,
  `can_visa` tinyint(1) NOT NULL,
  `can_disability` tinyint(1) NOT NULL,
  `can_disabilitycom` varchar(50) NOT NULL,
  `exp_id` int(5) NOT NULL,
  `exa_id` int(5) NOT NULL,
  `can_candidatetype` int(5) NOT NULL,
  `prc_id` int(5) NOT NULL,
  `can_candidatenum` int(10) NOT NULL,
  `can_packingcode` int(10) NOT NULL,
  `can_paymentfile` varchar(100) NOT NULL,
  `can_dnifile` varchar(100) NOT NULL,
  `can_acifile` varchar(100) NOT NULL,
  `can_disabilityfile` varchar(100) NOT NULL,
  `can_status` int(1) NOT NULL,
  `can_comment` varchar(400) NOT NULL,
  `can_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`can_id`),
  KEY `exp_id` (`exp_id`,`prc_id`),
  KEY `exa_id` (`exa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `Candidate`
--

INSERT INTO `Candidate` (`can_id`, `can_dni`, `can_firstname`, `can_lastname`, `can_gender`, `can_datebirth`, `can_email`, `can_adress`, `can_telephone`, `can_cellphone`, `can_visa`, `can_disability`, `can_disabilitycom`, `exp_id`, `exa_id`, `can_candidatetype`, `prc_id`, `can_candidatenum`, `can_packingcode`, `can_paymentfile`, `can_dnifile`, `can_acifile`, `can_disabilityfile`, `can_status`, `can_comment`, `can_timestamp`) VALUES
(6, 322423245, 'Hiroldo', 'Aroldo', 1, '1986-06-18', 'arlod@hotmail.com', 'Posadasdasd', '34112391230', '3513242242', 0, 0, '', 2, 1, 0, 1, 0, 0, '', '', '', '', 1, '', '2015-02-01 06:18:23'),
(7, 322424242, 'Bustos', 'Lebust', 1, '1989-06-13', 'Lebust@lebust.com', 'Poasdas', '12343234234', '123123125123', 0, 0, '', 1, 1, 0, 3, 0, 0, '2015-05-08/CAE/7_payment.jpg', '', '', '', 2, '', '2015-02-01 06:22:05'),
(8, 23322234, 'Agusto', 'Lopez', 0, '1989-06-14', 'nmalvasio@ta.telecom.com.ar', 'posadas 454', '543514206495', '543514206495', 1, 1, 'asdasd', 2, 1, 0, 1, 0, 0, '2015-05-08/CAE/8_payment.jpg', '', '', '', 0, '', '2015-02-17 22:33:28'),
(9, 344324234, 'Veronica', 'Jones', 0, '1984-07-11', 'mara@jaosd.com', 'sadaras', '123123', '2342345', 1, 0, 'asd', 2, 1, 0, 1, 0, 0, '2015-05-08/CAE/9_payment.png', '2015-05-08/CAE/9_dni.png', '', '2015-05-08/CAE/9_disability.pdf', 0, '', '2015-02-17 22:35:50'),
(10, 23324245, 'Javier', 'Malvasio', 1, '1984-06-13', 'nmalva@hotmail.com', 'Catamarca', '3514532343', '3514534456', 0, 0, '', 2, 1, 0, 1, 0, 0, '2015-05-08/CAE/10_payment.pdf', '2015-05-08/CAE/10_dni.png', '', '', 0, '', '2015-02-18 01:29:08'),
(11, 234234234, 'Agustascom', 'alksnc', 0, '2015-02-18', 'nmalvasio@ta.telecom.com.ar', 'asd', '543514206495', '543514206495', 0, 0, '', 1, 1, 0, 1, 0, 0, '', '', '', '', 0, '', '2015-02-18 02:38:16'),
(12, 34061231, 'Mariana', 'Villar', 0, '1989-03-08', 'mvillar@hotmail.com', 'Obispo Salgero 431', '3412341234', '234234', 0, 1, 'Varios!', 1, 3, 0, 1, 1, 4, '', '', '', '', 1, '0', '2015-02-18 03:01:13'),
(13, 23242324, 'Alonso', 'Lopez', 1, '1989-06-21', 'nmal@hotmail.com', 'La calle', '341123425', '35142325234', 0, 0, '', 2, 1, 0, 3, 0, 0, '', '', '', '', 0, '', '2015-02-19 00:26:48'),
(14, 32424253, 'Nicos', 'Malva', 0, '1980-06-18', 'nmalvasio@ta.telecom.com.ar', 'posads 454', '3514206495', '3514206495', 0, 0, '', 1, 3, 0, 3, 2, 2, '2015-05-08/FIRST/14_payment.jpg', '2015-05-08/FIRST/14_dni.jpg', '2015-05-08/FIRST/14_aci.jpg', '2015-05-08/FIRST/14_disability.jpg', 1, '0', '2015-02-22 16:06:13'),
(15, 234, 'ASD', 'LAKNSC', 0, '2015-03-02', 'NMA@NAMSD.COM', 'QWE', '123', '123', 0, 0, '', 1, 3, 0, 3, 3, 1, '', '', '', '', 1, '', '2015-03-01 17:22:55'),
(16, 24234234, 'agusto', 'lopez', 0, '2015-03-19', 'nma@nma.com', 'asd', '234234', '234', 0, 0, '', 1, 11, 0, 3, 0, 0, '', '', '', '', 0, '', '2015-03-03 03:43:26'),
(17, 23234234, 'qasd', 'asd', 1, '2015-03-18', 'nma@nma.com', 'posads', '234234', '234', 0, 0, '', 1, 11, 0, 3, 0, 0, '', '', '', '', 0, '', '2015-03-03 03:45:13'),
(18, 23232324, 'Eugenia', 'Obrist', 0, '1984-06-12', 'nmalva@hotmail.com', 'Humberto Primo 630', '351123234', '3513222280', 0, 1, 'daltonico', 1, 12, 0, 3, 1, 1, '2015-12-10/FIRST/18_payment.jpg', '2015-12-10/FIRST/18_dni.pdf', '', '', 2, '', '2015-03-03 12:08:38'),
(19, 322044888, 'nicola', 'asldk', 0, '2015-03-03', 'nma@nma.com', 'poas', '1234', '1234', 0, 0, '', 1, 1, 0, 4, 0, 0, '', '', '', '', 0, '', '2015-03-07 02:19:11'),
(20, 23232324, 'asd', 'asd', 0, '2015-03-10', 'nma@asdn.com', 'asd', '234', '234', 0, 0, '', 1, 1, 0, 4, 0, 0, '', '', '', '', 0, '', '2015-03-07 02:22:17'),
(21, 2147483647, 'Nicolas', 'Malva', 0, '2015-03-09', 'nma@nma.com', '234', '123', '234', 0, 0, '', 1, 3, 0, 4, 4, 4, '', '', '', '', 2, '', '2015-03-11 22:06:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `City`
--

CREATE TABLE `City` (
  `cit_id` int(5) NOT NULL AUTO_INCREMENT,
  `cit_name` varchar(50) NOT NULL,
  `cit_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `City`
--

INSERT INTO `City` (`cit_id`, `cit_name`, `cit_timestamp`) VALUES
(2, 'Buenos Aires', '2015-01-24 20:22:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Exam`
--

CREATE TABLE `Exam` (
  `exa_id` int(5) NOT NULL AUTO_INCREMENT,
  `exa_date` date NOT NULL,
  `tye_id` int(5) NOT NULL,
  `exa_comment` varchar(200) NOT NULL,
  `exa_status` int(1) NOT NULL,
  `exa_aci` int(1) NOT NULL,
  `exa_deadline` date NOT NULL,
  `exa_deadlineshow` date NOT NULL,
  `exa_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`exa_id`),
  KEY `tye_id` (`tye_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `Exam`
--

INSERT INTO `Exam` (`exa_id`, `exa_date`, `tye_id`, `exa_comment`, `exa_status`, `exa_aci`, `exa_deadline`, `exa_deadlineshow`, `exa_timestamp`) VALUES
(1, '2015-06-10', 1, 'Nothing', 1, 1, '2015-07-08', '2015-07-08', '2015-01-31 17:13:30'),
(3, '2015-05-08', 4, 'nada', 2, 0, '2015-10-22', '2015-10-22', '2015-02-01 02:03:53'),
(4, '2015-05-09', 3, 'asd', 2, 0, '0000-00-00', '0000-00-00', '2015-02-01 02:23:27'),
(5, '2015-06-17', 1, 'nada', 1, 0, '0000-00-00', '0000-00-00', '2015-02-01 03:18:43'),
(6, '0000-00-00', 1, '', 1, 0, '0000-00-00', '0000-00-00', '2015-02-18 02:45:07'),
(7, '2015-05-08', 1, '', 1, 0, '2015-07-22', '2015-06-22', '2015-02-22 17:40:34'),
(8, '2015-05-08', 3, '', 1, 0, '0000-00-00', '0000-00-00', '2015-02-22 18:03:03'),
(9, '2015-05-09', 1, '', 1, 0, '0000-00-00', '0000-00-00', '2015-02-22 18:05:37'),
(10, '0000-00-00', 1, '', 1, 0, '0000-00-00', '0000-00-00', '2015-02-22 18:18:14'),
(11, '2015-05-28', 1, '', 1, 0, '0000-00-00', '0000-00-00', '2015-02-23 01:30:43'),
(12, '2015-12-10', 4, '', 1, 0, '0000-00-00', '0000-00-00', '2015-03-03 11:45:41'),
(13, '2016-03-10', 1, 'Nada', 1, 0, '0000-00-00', '0000-00-00', '2015-03-06 00:30:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ExamPlace`
--

CREATE TABLE `ExamPlace` (
  `exp_id` int(5) NOT NULL AUTO_INCREMENT,
  `exp_name` varchar(100) NOT NULL,
  `exp_adress` varchar(100) NOT NULL,
  `exp_telephone` varchar(50) NOT NULL,
  `exp_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`exp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `ExamPlace`
--

INSERT INTO `ExamPlace` (`exp_id`, `exp_name`, `exp_adress`, `exp_telephone`, `exp_timestamp`) VALUES
(1, 'Academia Arguello', 'Avenida Academia 2334', '351 456783', '2015-01-25 18:12:18'),
(2, 'Cultura Britanica', 'Pueyrredon 4325', '045234123', '2015-01-25 18:12:18'),
(5, 'Icana', 'Tejeda2234', '12302349', '2015-01-25 19:21:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PlaceForSit`
--

CREATE TABLE `PlaceForSit` (
  `plf_id` int(5) NOT NULL AUTO_INCREMENT,
  `exa_id` int(5) NOT NULL,
  `exp_id` int(5) NOT NULL,
  `plf_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`plf_id`),
  KEY `exa_id` (`exa_id`,`exp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `PlaceForSit`
--

INSERT INTO `PlaceForSit` (`plf_id`, `exa_id`, `exp_id`, `plf_timestamp`) VALUES
(12, 4, 1, '2015-02-18 02:55:38'),
(13, 4, 2, '2015-02-18 02:55:38'),
(14, 4, 5, '2015-02-18 02:55:38'),
(15, 3, 1, '2015-02-18 03:01:48'),
(16, 3, 5, '2015-02-18 03:01:48'),
(18, 11, 1, '2015-02-23 01:30:50'),
(19, 11, 2, '2015-02-23 01:30:50'),
(22, 12, 1, '2015-03-03 12:33:18'),
(23, 12, 2, '2015-03-03 12:33:18'),
(24, 12, 5, '2015-03-03 12:33:18'),
(25, 13, 2, '2015-03-06 00:30:43'),
(29, 1, 1, '2015-03-10 21:34:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PrepCentre`
--

CREATE TABLE `PrepCentre` (
  `prc_id` int(5) NOT NULL AUTO_INCREMENT,
  `prc_name` varchar(50) NOT NULL,
  `prc_shortname` varchar(50) NOT NULL,
  `prc_firstname` varchar(50) NOT NULL,
  `prc_lastname` varchar(50) NOT NULL,
  `prc_adress1` varchar(100) NOT NULL,
  `prc_adress2` varchar(100) NOT NULL,
  `prc_city` varchar(50) NOT NULL,
  `prc_postcode` varchar(10) NOT NULL,
  `prc_areacode` int(5) NOT NULL,
  `prc_telephone` int(10) NOT NULL,
  `prc_email` varchar(50) NOT NULL,
  `prc_typefunding` varchar(50) NOT NULL,
  `prc_preparationtype` varchar(50) NOT NULL,
  `prc_uniqueid` varchar(50) NOT NULL,
  `prc_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`prc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=320 ;

--
-- Volcado de datos para la tabla `PrepCentre`
--

INSERT INTO `PrepCentre` (`prc_id`, `prc_name`, `prc_shortname`, `prc_firstname`, `prc_lastname`, `prc_adress1`, `prc_adress2`, `prc_city`, `prc_postcode`, `prc_areacode`, `prc_telephone`, `prc_email`, `prc_typefunding`, `prc_preparationtype`, `prc_uniqueid`, `prc_timestamp`) VALUES
(1, 'ABC 1', 'ABC 1', 'Ivana', 'Cavallera', 'Angelo Peredo 1572', '', 'Córdoba', '5000', 0, 4118921, 'icavallera@hotmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC003146', '2015-02-22 20:42:42'),
(2, 'Academia Argüello', 'AA', 'Eugenia', 'Obrist', 'Av. R.Nuñez 5675', 'Argüello', 'Córdoba', '5147', 3543, 443030, 'eugenia.obrist@aa.edu.ar', 'No State Funding', 'Private Language School', 'ARPC001518', '2015-02-22 20:42:42'),
(3, 'Academia Boichenko', 'Boichenko', 'Esteban', 'De Michelis', 'Florencio Sánchez 1141', 'Cosquín', 'Córdoba', '5111', 3541, 451682, 'demisteve38@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000045', '2015-02-22 20:42:42'),
(4, 'ACADEMIA CLUB SARMIENTO', 'SARMIENTO', 'Vanesa', 'Raspo', 'Belgrano 1080', '', 'Marcos Juarez', '', 3472, 15506411, 'vanesaraspo@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004247', '2015-02-22 20:42:42'),
(5, 'Academia De Enseñanza de Ingles', 'ADEI', 'Elgue', 'De Basualdo', 'Ciudad de Tampa 2869', 'Villa Cabrera', 'Córdoba', '5009', 351, 4805284, 'academia_adei@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000695', '2015-02-22 20:42:42'),
(6, 'Academia de Inglés Schulman', 'Schulman', 'Susana', 'Schulman', 'Obispo Carranza 1942', 'B° Ayacucho', 'Córdoba', '5001', 351, 4704285, 'academia_schulman@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000047', '2015-02-22 20:42:42'),
(7, 'Academia de Lengua Inglesa', 'ALI', 'Ana María', 'Sierra', 'Rosario de Santa Fe 1366', 'General Paz', 'Córdoba', '5000', 351, 4514796, 'anateacher@sinectis.com.ar', 'Full State Funding', 'Private Language School', 'ARPC002094', '2015-02-22 20:42:42'),
(8, 'ACCESS', 'ACCESS', 'PATRICIA LAURA', 'PEÑALOZA', 'INDEPENDENCIA 846', '', 'BIALET MASSÉ', '5158', 3541, 441531, 'patry_penaloza@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003396', '2015-02-22 20:42:42'),
(9, 'ADI', 'ADI', 'Silvana', 'Rodriguez', '9 de Julio 1128', 'Villa Mercedes', 'San Luis', '5730', 2657, 224946, 'andrearodriguez390@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003170', '2015-02-22 20:42:42'),
(10, 'Advance Academy', 'Advance Academy', 'Silvia', 'Hofirek', 'Rafael Nuñez 1154', 'Pilar', 'Córdoba', '5972', 3572, 471669, 'siladv@hotmail.es', 'No State Funding', 'Private Language School', 'ARPC000694', '2015-02-22 20:42:42'),
(11, 'Advanced English', 'Advanced', 'Karina', 'Finkielsztejn', 'Olascoaga 736', '', 'Mendoza', '5500', 261, 4238148, 'info@advanced-english.com.ar', 'No State Funding', 'Private Language School', 'ARPC003042', '2015-02-22 20:42:42'),
(12, 'Alicia Bertino', 'Prof Alicia Bertino', 'Alicia', 'Bertino', 'Mitre 671', 'San Francisco', 'Córdoba', '2400', 3564, 432817, 'aa.bertino@hotmai.com', 'No State Funding', 'Private Language School', 'ARPC001141', '2015-02-22 20:42:42'),
(13, 'ALTO INGLÉS', 'ALTO', 'ALEJANDRA', 'CARPINETTI', 'ONCATIVO 58', 'RIO CEBALLOS', 'CORDOBA', '5111', 3543, 454075, 'macarpinetti@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002959', '2015-02-22 20:42:42'),
(14, 'AMCI Marcos Juárez', 'AMCI', 'Verónica', 'Pandolfi', 'Hipólito Irigoyen 568', '', 'Marcos Juárez', '2580', 3472, 422244, 'pottypandolfi@hotmail.com', 'No State Funding', '', 'ARPC004161', '2015-02-22 20:42:42'),
(15, 'AMERICAN INSTITUTE', 'AMERICAN INSTITUTE', 'LILIANA', 'MORÈ', '17 DE AGOSTO 240', 'BO. ZAILA', 'RIO III', '5850', 3571, 422238, 'moreliliana47@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004124', '2015-02-22 20:42:42'),
(16, 'Ana Claudia Schreiner', 'Schreiner', 'Ana Claudia', 'Schreiner', 'Benigno Acosta 4408', 'Villa entenario', 'Córdoba', '5009', 351, 4822665, 'schreinermaida@fullzero.com.ar', 'No State Funding', 'Private Language School', 'ARPC002740', '2015-02-22 20:42:42'),
(17, 'Ana Laura Barbosa', 'Barbosa', 'Ana Laura', 'Barbosa', 'Güemes 662', '', 'Villa Allende', '5105', 3543, 155940636, 'ana-laurabarbosa@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003907', '2015-02-22 20:42:42'),
(18, 'Ana Wittouck Córdoba', 'Ana Wittouck Cba', 'Ana', 'Wittouck', 'Colón 569', 'Centro', 'Córdoba', '5000', 3543, 443030, 'awittouck59@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000708', '2015-02-22 20:42:42'),
(19, 'Ana Wittouck Río Cuarto', 'Wittouck R IV', 'Ana', 'Wittouck', 'General Deheza', 'Rio Cuarto', 'Córdoba', '5800', 358, 154280260, 'ana_wittouck@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC002124', '2015-02-22 20:42:42'),
(20, 'Andrea Álvarez', 'Andrea Alvarez', 'Andrea', 'Álvarez', 'Las Clivas 173', 'Mendiolaza', 'Córdoba', '5107', 3543, 443030, 'xycarius@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002125', '2015-02-22 20:42:42'),
(21, 'Andrea Cano', 'Andrea Cano', 'Andrea', 'Cano', 'Obispo Trejo 949 8ºA', 'Nueva Córdoba', 'Córdoba', '5000', 351, 4695998, 'andre99cano@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002126', '2015-02-22 20:42:42'),
(22, 'Andrea Martinez', 'Andrea Martinez', 'Andrea', 'Martinez', 'Libertad y Las Piedras', 'Liniers', 'Córdoba', '2592', 3547, 42639, 'andreaaltag@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002127', '2015-02-22 20:42:42'),
(23, 'ANGLO ALTA GRACIA', 'ANGLO ALTA GRACIA', 'Graciela', 'Sosa', 'PELLEGRINI 637', 'ALTA GRACIA', 'CORDOBA', '5186', 3547, 423336, 'missgmazzucco@yahoo.com.ar', 'No State Funding', 'Compulsory Education School', 'ARPC002647', '2015-02-22 20:42:42'),
(24, 'Anglo American School', 'Anglo LR', 'Analía', 'Cicconi', 'Avenida Peron 444', 'La Rioja', 'La Rioja', '5300', 3822, 437844, 'analiacic@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000051', '2015-02-22 20:42:42'),
(25, 'Anglo School English Institute', 'Anglo MAntonietta', 'Marcela', 'Antonietta', 'Benito Fernandez 370', '', 'San Marcos Sud', '2566', 3537, 498053, 'marcelaesbin@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004177', '2015-02-22 20:42:42'),
(26, 'Around the World', 'Around the World', 'Mariela', 'Marin', 'Celso Barrios 2300', 'jardín', 'cordoba', '5014', 0, 4671036, 'marielamarin2@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003516', '2015-02-22 20:42:42'),
(27, 'ASCENTIO TECHNOLOGIES SA', 'ASCENTIO', 'Mariano', 'Gionco', '9 DE JULIO 1365', '', 'RIO CUARTO', '5800', 358, 4622098, 'mgionco@ascentio.com.ar', 'No State Funding', 'Others', 'ARPC003643', '2015-02-22 20:42:42'),
(28, 'Ashford English Language Teaching', 'Ashford', 'Graciela', 'Giménez', 'Balcarce 869', 'Villa Mercedes', 'San Luis', '5730', 2657, 426768, 'ashford@infovia.com.ar', 'No State Funding', 'Private Language School', 'ARPC000052', '2015-02-22 20:42:42'),
(29, 'Asociación Argentina de Cultura Británica', 'AACB', 'Graciela', 'Oliva', 'Hipolito Yrigoyen 496', 'Nueva Córdoba', 'Córdoba', '5000', 351, 4691000, 'secgeneral@culturabritanicacba.com.ar', 'No State Funding', 'Private Language School', 'ARPC002098', '2015-02-22 20:42:42'),
(30, 'Asociación Belvillense de Cultura Inglesa', 'ABCI', 'María Rosa', 'Allione', 'Rivadavia 332', 'Bell Ville', 'Córdoba', '2550', 3534, 425489, 'mrallione@gmail.com', 'No State Funding', 'Private Language School', 'ARPC002099', '2015-02-22 20:42:42'),
(31, 'Asociación Educativa Pio Leon', 'Pio Leon', 'Ethel', 'Larovere', 'Av. 28 de julio 345', '', 'Colonia Caroya', '', 3525, 422323, 'pio.leon@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004309', '2015-02-22 20:42:42'),
(32, 'Bell School', 'Bell', 'Analía', 'Lucero', 'San Juan 738', 'Río Segundo', 'Córdoba', '5960', 3572, 423665, 'asilvia-75@live.com.ar', 'No State Funding', 'Private Language School', 'ARPC002100', '2015-02-22 20:42:42'),
(33, 'Ben & Bill', 'Ben', 'Ben', 'Bill', 'Av Italia 1129', 'Rio Cuarto', 'Cordoba', '5800', 0, 4640153, 'benandbill@intercitv.net.ar', 'No State Funding', 'Private Language School', 'ARPC003040', '2015-02-22 20:42:42'),
(34, 'Bernardez', 'Bernardez', 'Laura', 'Bonichelli', 'José Otero 1644', 'Cerro', 'C', '5009', 0, 443030, 'laurabonichelli@hotmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC003408', '2015-02-22 20:42:42'),
(35, 'Blue Castle', 'bluecastle', 'Patricia', 'Marziale', 'Luis de Azpeitia 3225', 'Alto Alberdi', 'Córdoba', '5003', 0, 4892835, 'patomarziale@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002640', '2015-02-22 20:42:42'),
(36, 'Blue Moon 1', 'Bluemoon 1', 'Andrea', 'Roggero', 'Zampol 256', '', 'Brinkmann', '2419', 3562, 480249, 'bluemoonbrk@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003075', '2015-02-22 20:42:42'),
(37, 'BLUEMOON', 'BLUEMOON', 'Patricia', 'Burgener', '25 de Mayo 214', 'Freyre', 'Córdoba', '2413', 3564, 15576279, 'patri_burgener@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002930', '2015-02-22 20:42:42'),
(38, 'BRIDGE INGLES', 'BRIDGE ingles', 'ANALIA', 'ORTIZ', 'PADRE LOZANO 2081', 'MARIANO BALCARCE', 'CORDOBA', '5011', 351, 4652842, 'bridgeingles@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004011', '2015-02-22 20:42:42'),
(39, 'Brighton Institute', 'Brighton', 'Ana María', 'Cabrini', '25 de Mayo 726', 'General Paz', 'Cordoba', '5000', 351, 4264069, 'anacabrini@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000055', '2015-02-22 20:42:42'),
(40, 'Britannia', 'Britannia', 'Graciela', 'Freudenreich', 'De los Extremeños 5100 Dto 2', 'Los Bulevares', 'Córdoba', '5022', 3543, 444301, 'britanniaingles@gmail.com', 'No State Funding', 'Private Language School', 'ARPC002762', '2015-02-22 20:42:42'),
(41, 'British Language School', 'BLS SF', 'Roberta', 'Ambroggio', 'Rivadavia 310 PA', 'San Francisco', 'Córdoba', '2400', 3564, 429577, 'armanias@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC002101', '2015-02-22 20:42:42'),
(42, 'BRITISH MERLO', 'BRITISH MERLO', 'Carolina Anahí', 'Silva', 'P.P.Tissera 150', 'Merlo', 'San Luis', '', 0, 265647806, 'caroline_silva@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003474', '2015-02-22 20:42:42'),
(43, 'British School', 'British Cerro', 'Pamela', 'French', 'José Roque Funes 1511', 'Cerro', 'Córdoba', '5000', 351, 4812104, 'pfrench@britishschoolcba.com.ar', 'No State Funding', 'Private Language School', 'ARPC000636', '2015-02-22 20:42:42'),
(44, 'British School Nueva Córdoba', 'British NC', 'Elvira', 'Scagliotti', 'Poeta Lugones 494', 'Nueva Córdoba', 'Córdoba', '5000', 351, 4683205, 'pfrench@britishschoolcba.com.ar', 'No State Funding', 'Private Language School', 'ARPC002102', '2015-02-22 20:42:42'),
(45, 'British School of English', 'British LR', 'Laura', 'Del Rio', 'Santa Fe 791', 'La Rioja', 'La Rioja', '5300', 3822, 462037, 'florenciabitetti@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000058', '2015-02-22 20:42:42'),
(46, 'California School', 'California', 'Laura', 'Troglia', '7898 Recta Martinoli Ave.', 'Argüello', 'Córdoba', '5121', 3543, 427943, 'ltroglia@gmail.com', 'No State Funding', 'Private Language School', 'ARPC000502', '2015-02-22 20:42:42'),
(47, 'Cambridge Institute', 'Cambridge Cat', 'Olga', 'Sarmiento', 'Sarmiento 817', '', 'Catamarca', '', 3834, 361193, 'olguisarmiento@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002720', '2015-02-22 20:42:42'),
(48, 'Cambridge Marcela Coronel', 'Cambridge Coronel', 'Marcela', 'Coronel', 'Altolaguirre 2283 - Primer Piso', 'Yofre Norte', 'Córdoba', '5012', 351, 4514718, 'marce_coronel@yahoo.com', 'No State Funding', 'Private Language School', 'ARPC000541', '2015-02-22 20:42:42'),
(49, 'Carola Queralt', 'Carola Queralt', 'Carola', 'Queralt', 'Los Talas 1170', 'Capilla del Monte', 'Córdoba', '5184', 3548, 481530, 'caroqueralt@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC002779', '2015-02-22 20:42:42'),
(50, 'Carolina Cecilia Requena', 'Carolina Requena', 'Carolina Cecilia', 'Requena', 'Av. 25 de Mayo 889', 'Villa Mercedes', 'San Luis', '5730', 2657, 431815, 'carolina_requena@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC002128', '2015-02-22 20:42:42'),
(51, 'CAROLINA MOYANO', 'CAROLINA MOYANO', 'CAROLINA', 'MOYANO', 'LOTE 6 MZA. J', 'LA RESERVA', 'CORDOBA', '5003', 351, 152363283, 'caromoyanocuenca@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003698', '2015-02-22 20:42:42'),
(52, 'Castel Franco', 'Castelfranco', 'Debora', 'Scott', 'La Salle esq Avogadro', 'Villa Belgrano', 'Córdoba', '5147', 3543, 441189, 'deboramatti@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000503', '2015-02-22 20:42:42'),
(53, 'CECILIA GONZALEZ', 'CECILIA GONZALEZ', 'CECILIA', 'GONZALEZ', 'LEOVINO MARTINEZ 114', 'LA RIOJA', 'CHILECITO', '5360', 3825, 15402340, 'cecigonzalez36@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003236', '2015-02-22 20:42:42'),
(54, 'CELI', 'CELI', 'MARIA ANGELICA', 'LACAPRA', 'CONSTITUCION Y ESPAÑA', '', 'REALICO - LA PAMPA', '6200', 2331, 460539, 'inglesceli@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003720', '2015-02-22 20:42:42'),
(55, 'Centro Cultura Americana', 'CCA', 'Alicia', 'Aguirre', 'Hugo Miatello 4207', 'Poeta Lugones', 'Córdoba', '5008', 0, 4760129, 'culturaamericana10@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC002787', '2015-02-22 20:42:42'),
(56, 'Centro Cultural de Lengua', 'CCL', 'Ana Cristina', 'Gómez de Asia', 'Acevey 2124 - 1er piso', 'Ayacucho', 'Córdoba', '5001', 351, 4704295, 'c.c.l.idiomas@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002103', '2015-02-22 20:42:42'),
(57, 'Centro de Enseñanza de Inglés (CEI)', 'CEI Flavia de Costa', 'Flavia', 'De Costa', 'Caseros 2571', 'Alto Alberdi', 'Córdoba', '5003', 351, 4800335, 'inglescei@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000506', '2015-02-22 20:42:42'),
(58, 'Centro de Estudios CID', 'CID', 'Claudia', 'Massei', 'La Tablada 1045', '', 'Oncativo', '', 3572, 460381, 'anto_lazzarini@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004266', '2015-02-22 20:42:42'),
(59, 'Centro Educativo Causay', 'Causay', 'Marcela', 'Massobrio', 'Quines 655', 'San Luis', 'San Luis', '5700', 2652, 438114, 'marcelamassobrio@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000508', '2015-02-22 20:42:42'),
(60, 'Centro Educativo Nuevo Siglo', 'Nuevo Siglo', 'Claudia', 'Novick', '25 de Mayo 1040', 'General Paz', 'Córdoba', '5000', 351, 4258609, 'claudianovick@hotmail.com', 'Partial State Funding', 'Compulsory Education School', 'ARPC000509', '2015-02-22 20:42:42'),
(61, 'Centro Educativo Oliva (CEO)', 'CEO', 'Mónica', 'Donalisio', 'Olmos 390', 'Oliva', 'Córdoba', '5980', 3532, 412455, 'm.donalisio@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000510', '2015-02-22 20:42:42'),
(62, 'Centro Integral de Idiomas', 'Integral R Ceballos', 'Mariqué', 'Rosso', 'Av. San Martín 5190', 'Río Ceballos', 'Córdoba', '5111', 3543, 454706, 'centrointegral.rc@gmail.com', 'No State Funding', 'Private Language School', 'ARPC000511', '2015-02-22 20:42:42'),
(63, 'Cerro Azul', 'Cerro Azul', 'Analía', 'Gimenez', 'Belgrano 508', '', 'Villa Dolores', '', 3544, 420610, 'institutocerroazul@gmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC004241', '2015-02-22 20:42:42'),
(64, 'CES', 'CES', 'Andrea', 'Navajas', 'Coronel Iseas 96', '', 'Villa Mercedes', '5730', 2657, 438552, 'ces_englishexams@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC003130', '2015-02-22 20:42:42'),
(65, 'Chilecito English Center', 'Chilecito E C', 'María Florencia', 'Bustos', 'La Plata 325', '', 'Chilecito', '5360', 3825, 15537218, 'mariaflorenciabustos@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003405', '2015-02-22 20:42:42'),
(66, 'CIC Centro de Inglés y Computación', 'CIC Margaria', 'Cristina', 'Margaría', 'Belgrano 484', 'Oncativo', 'Córdoba', '5986', 3572, 461550, 'cris_margaria@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000507', '2015-02-22 20:42:42'),
(67, 'CIDI', 'CENTRO INTEGRAL DE I', 'MARIA CRISTINA', 'BUSSO', 'COLON 26- P.A.', '', 'SAN FRANCISCO', '2400', 3564, 447455, 'cidisanfrancisco@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003986', '2015-02-22 20:42:42'),
(68, 'CIEm', 'CIEm', 'Gladys', 'Matar', 'Pública s/Nº', 'Villa Irupé', 'Embalse', '5856', 3571, 485111, 'bernardetm@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003923', '2015-02-22 20:42:42'),
(69, 'CIL Centro Integral de Lenguas', 'CIL Bellolio', 'Liliana', 'Bellolio', 'León 1753', 'Maipú', 'Córdoba', '5014', 351, 4581727, 'info@cil-edu.com.ar', 'No State Funding', 'Private Language School', 'ARPC000512', '2015-02-22 20:42:42'),
(70, 'Cinco Rios', 'CINCO RIOS', 'Marta', 'Crespo', 'Padre Luchesse Km 2', 'Villa Allende', 'Córdoba', '5105', 351, 438800, 'mariana_moretta@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000100', '2015-02-22 20:42:42'),
(71, 'CITUS', 'CITUS', 'Nora', 'Medina de Picco', 'Luis Agote 2585', 'Los Naranjos', 'Córdoba', '5010', 351, 4664378, 'medinanora@live.com', 'No State Funding', 'Private Language School', 'ARPC000681', '2015-02-22 20:42:42'),
(72, 'Colegio Alemán', 'Aleman CBA', 'Silvina', 'Martinez', 'Recta Martinoli 3752', 'Argüello', 'Córdoba', '5147', 3543, 444218, 'silvinamartinez2002@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC002104', '2015-02-22 20:42:42'),
(73, 'COLEGIO ALEMAN VGB', 'COLEGIO ALEMAN VGB', 'ALBERTO', 'CAPELLINI', 'AV. LOS INCAS 131', '', 'VILLA GENERAL BELGRANO', '5194', 3546, 461366, 'coordingles@colegioalemanvgb.edu.ar', 'No State Funding', 'Private Language School', 'ARPC003744', '2015-02-22 20:42:42'),
(74, 'COLEGIO BILINGUE SAN PATRICIO', 'SAN PATRICIO', 'EUGENIA', 'GRIFFA', 'AV. VALPARAISO 4140', 'BO. JARDÍN HIPÓDROMO', 'CORDOBA', '5016', 351, 4613463, 'eugeniagriffa@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004136', '2015-02-22 20:42:42'),
(75, 'Colegio Dante Alighieri - Carlos Paz', 'Dante Carlos Paz', 'Liliana', 'Barrionuevo', 'Alfonsina Storni y Los Alerces', 'Carlos Paz', 'Córdoba', '5141', 651, 152009144, 'misslilibarrionuevo@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000501', '2015-02-22 20:42:42'),
(76, 'Colegio Dante Alighieri (Carlos Paz)', 'Dante Carlos Paz', 'Liliana', 'Barrionuevo', 'Alfonsina Storni y Los Alerces', 'Va. Carlos Paz', 'Córdoba', '5152', 351, 152009144, 'misslilibarrionuevo@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC002718', '2015-02-22 20:42:42'),
(77, 'Colegio Dante Alighieri Córdoba', 'Dante Cba', 'Carola', 'Fitzgerald', 'José Javier Díaz 480 y Bunge', 'Iponá', 'Córdoba', '5016', 351, 156820280, 'lolasheep@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000655', '2015-02-22 20:42:42'),
(78, 'COLEGIO DEL CARMEN', 'DEL CARMEN', 'CAROLINA', 'GIRAUDO', 'FRANCISCO PALAU', 'ESQ. MARTINOLLI', 'CORDOBA', '5147', 351, 153503597, 'carolinagiraudo@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003743', '2015-02-22 20:42:42'),
(79, 'Colegio La Salle', 'La Salle', 'Dolores', 'Laje', 'Recta Martinoli 6602', 'Argüello', 'Córdoba', '5147', 3543, 421010, 'dlaje@fibertel.com.ar', 'Partial State Funding', 'Compulsory Education School', 'ARPC000043', '2015-02-22 20:42:42'),
(80, 'Colegio María de Nazareth', 'Nazareth', 'Andrea', 'Chiodi', 'Los Alamos 1111 Cuesta Colorada', 'La Calera', 'Córdoba', '5147', 3543, 441011, 'andychiodi@yahoo.com.ar', 'No State Funding', 'Compulsory Education School', 'ARPC000042', '2015-02-22 20:42:42'),
(81, 'Colegio Nuestra Señora del Luján', 'Lujan', 'Cecilia', 'Sosa Loyola', 'Avenida San Martín 1070', 'Saldán', 'Córdoba', '5149', 3543, 432958, 'institutolujan@hotmail.com', 'No State Funding', '', 'ARPC000515', '2015-02-22 20:42:42'),
(82, 'Colegio San José Secundario', 'San Jose', 'Negrita', 'Candiotti', 'Sol de Mayo 726', 'Alto Alberdi', 'Córdoba', '5003', 351, 4882306, 'englishcolegiosanjose@terra.com', 'Partial State Funding', 'Compulsory Education School', 'ARPC000039', '2015-02-22 20:42:42'),
(83, 'Colegio San Martin', 'San Martin', 'Gabriela', 'Zurlo', 'Av. Duarte Quirós 4800', '', 'Córdoba', '5003', 351, 4858964, 'gabriela_zurlo@hotmail.com', 'Partial State Funding', 'Compulsory Education School', 'ARPC003066', '2015-02-22 20:42:42'),
(84, 'Colegio Santa Catalina', 'Santa Catalina', 'Fabiana', 'Amat', 'Belgrano 395 e Ituzaingó', 'San Luis', 'San Luis', '5700', 2652, 453757, 'fabianaamat@yahoo.com', 'No State Funding', 'Compulsory Education School', 'ARPC000040', '2015-02-22 20:42:42'),
(85, 'Community', 'Community', 'Silvia', 'San Román', 'Bº 142 viviendas Manzana 328 casa 6', '', 'San Luis', '', 0, 4473809, 'sisan24@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003465', '2015-02-22 20:42:42'),
(86, 'ComputEnglish Centre', 'Computenglish', 'Nicholas', 'Basily', 'Gob. José Reynafé 1928', 'Cerro', 'Córdoba', '5009', 351, 4812422, 'nicobasily@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000638', '2015-02-22 20:42:42'),
(87, 'Connections Va Ma', 'Connections English', 'Andrea', 'Nieto', 'Entre Ríos 712', '', 'Villa María', '5900', 353, 4548870, 'connectionsenglishinstitute@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003868', '2015-02-22 20:42:42'),
(88, 'Consuelo Nores', 'Consuelo Nores', 'Consuelo', 'Nores', 'Aconquija 3200', 'Bº Parque Capital Sur', 'Córdoba', '5016', 0, 156878973, 'consuelonores@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC003046', '2015-02-22 20:42:42'),
(89, 'Cordoba English Center', 'CBA ENGLISH CENTER', 'Helen', 'Easdale', 'Italia 3074', 'Villa Cabrera', 'Córdoba', '5009', 351, 4805296, 'hgr_easdale@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000103', '2015-02-22 20:42:42'),
(90, 'Costa Azul College', 'Costa Azul', 'Ana Flavia', 'Herrou', 'Comechingones esq Huarpes', 'Carlos Paz', 'Córdoba', '5152', 3541, 420530, 'anaherrou@hotmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC000090', '2015-02-22 20:42:42'),
(91, 'Covent Garden', 'Covent Garden', 'Alina', 'Machnicki', 'Poincaré 6880', 'Argüello', 'Córdoba', '5147', 3543, 428368, 'alivero16@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000639', '2015-02-22 20:42:42'),
(92, 'Cristina Schor', 'Cristina Schor', 'Cristina', 'Schor', 'Gregorio Velez 3552', 'Ceroo', 'Córdoba', '5009', 351, 4810197, 'cristischor@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC001108', '2015-02-22 20:42:42'),
(93, 'Cross Cultural', 'Cross Cultural', 'Mónica', 'Rios', 'Roberto Cayol 3546', 'Poeta Lugones', 'Córdoba', '5008', 351, 4760259, 'monica_rios@fibertel.com.ar', 'No State Funding', 'Private Language School', 'ARPC002105', '2015-02-22 20:42:42'),
(94, 'Cultura Americana', 'Cultura Americana', 'Alicia', 'Aguirre', 'Hugo Miatello 4207', '', 'Córdoba', '', 0, 4760129, 'info@culturaamericana.com.ar', 'No State Funding', 'Private Language School', 'ARPC004295', '2015-02-22 20:42:42'),
(95, 'CULTURA BELL VILLE', 'CULTURA BELL VILLE', 'MONICA ESTER', 'LICARI', 'RIVADAVIA 332', 'BELL VILLE', 'CORDOBA', '2550', 3534, 425489, 'culturalinglesabv@nodosud.com.ar', 'No State Funding', 'Private Language School', 'ARPC002646', '2015-02-22 20:42:42'),
(96, 'CULTURA INGLESA', 'CULTURA VILLA MARIA', 'CECILIA', 'PETRELLI', 'SAN JUAN 1169', '', 'VILLA MARÍA', '5900', 353, 156559002, 'cultura_inglesa@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004117', '2015-02-22 20:42:42'),
(97, 'Cultura Inglesa de Jesús María', 'CIJM', 'Martha', 'Zaya', 'Castulo Peña 468', 'Jesús María', 'Córdoba', '5220', 3525, 424780, 'marthabzaya@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002106', '2015-02-22 20:42:42'),
(98, 'Cultural Inglesa de Bristol', 'Bristol', 'Margarita', 'Tiraferri', 'Córdoba 512', 'Santa Rosa de Calamuchita', 'Pcia de Córdoba', '5196', 3546, 421890, 'a-bristol@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002884', '2015-02-22 20:42:42'),
(99, 'Culturarte', 'Culturarte', 'Mariela', 'Medel', '25 de Mayo 963', 'Pilar', 'Córdoba', '5972', 3572, 471315, 'mariela_medel@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002929', '2015-02-22 20:42:42'),
(100, 'Dallas Institute', 'Dallas', 'Elsa', 'Chiusano', 'Gob. Gordillo 36', 'Chilecito', 'La Rioja', '5360', 3825, 424118, 'elsachiusano@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000517', '2015-02-22 20:42:42'),
(101, 'Dorset School of English', 'Dorset', 'Yanina', 'Pujol', 'David Luque 5', 'General Paz', 'Córdoba', '5000', 351, 4224156, 'ypujol@dorset.com.ar', 'No State Funding', 'Private Language School', 'ARPC000518', '2015-02-22 20:42:42'),
(102, 'El Torreon', 'Torreon', 'María Inés', 'Romero', 'Av Padre luchesse S/Nº', 'Villa Allende', 'Córdoba', '5105', 3543, 438804, 'maleromero@hotmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC000089', '2015-02-22 20:42:42'),
(103, 'EMILIO LAMARCA', 'LAMARCA', 'CAROLINA', 'RODRIGUEZ', 'EMILIO LAMARCA 4205', 'URCA', 'CORDOBA', '5009', 351, 4818664, 'karorod@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003738', '2015-02-22 20:42:42'),
(104, 'Eng Training Asin', 'English Training Asi', 'Paula', 'Asin', 'B.Mitre y Sanchez Manzanera', '', 'Pozo del Molle', '5913', 353, 154138357, 'englishtrainingpz@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003077', '2015-02-22 20:42:42'),
(105, 'English', 'English Boschetto', 'Elide', 'Boschetto', 'El Libertador 120', 'Morteros', 'Córdoba', '2421', 3562, 404640, 'tvbocco@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000519', '2015-02-22 20:42:42'),
(106, 'English and Arts', 'Eng n Arts', 'Gabriela', 'Villalba', 'Calle 26 Nº 143', 'Inaudi', 'Córdoba', '5016', 351, 4943829, 'colorvillalba@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002107', '2015-02-22 20:42:42'),
(107, 'English Centre', 'Silvana Protti', 'Silvana', 'Protti', '9 de Julio y Gral. Paz', 'Oliva', 'Córdoba', '5980', 3532, 15679141, 'silvanaprotti07@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC001143', '2015-02-22 20:42:42'),
(108, 'English Forum', 'EForum Gloria', 'Gloria', 'Echave', 'Diego Rapela 3303', 'Residencial Vélez Sársfield', 'Córdoba', '5016', 351, 4612087, 'gechave@english-forum.com.ar', 'No State Funding', 'Private Language School', 'ARPC000696', '2015-02-22 20:42:42'),
(109, 'English Forum Chilecito', 'EForum Chilecito', 'Mirtha', 'Frezzi', 'El Maestro 425', 'Chilecito', 'La Rioja', '5360', 3825, 424574, 'forumchilecito@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000520', '2015-02-22 20:42:42'),
(110, 'English in Company', 'English in Company', 'Eugenia', 'Casserly', 'Castulo Peña 157', '', 'Jesus Maria', '', 3525, 15642753, 'ec.englishincompany@gmail.com', 'No State Funding', 'Private Language School', 'ARPC004310', '2015-02-22 20:42:42'),
(111, 'English Institute', 'English Institute', 'Cristina', 'Mondino', 'Colón 88', 'San Francisco', 'Córdoba', '2400', 3564, 424623, 'crist.mondino@gmail.com', 'No State Funding', 'Private Language School', 'ARPC000112', '2015-02-22 20:42:42'),
(112, 'ENGLISH KINGDOM', 'ENGLISH KINGDOM', 'MARÍA DEL MAR', 'DE LA FUENTE', 'SAN MARTIN 487', '', 'VILLA MARÍA', '5903', 353, 4910849, 'english_kingdom@hotmail.com.ar', 'No State Funding', 'Private Language School', 'ARPC003411', '2015-02-22 20:42:42'),
(113, 'English Language Centre - Bibiana Ricardo', 'ELC Bibiana Ricardo', 'Bibiana', 'Ricardo', 'Carlos Pellegrini 154', 'Las Varillas', 'Córdoba', '5940', 3533, 421823, 'bibricardo@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000697', '2015-02-22 20:42:42'),
(114, 'English Language Institute - Olivero', 'ELI Olivero', 'Clarisa', 'Olivero', 'San Martin 294', 'Noetinger', 'Córdoba', '2563', 3472, 470030, 'clarisaolivero@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000657', '2015-02-22 20:42:42'),
(115, 'English Net', 'English Net', 'Carla', 'Teruzzi', 'Roma 224', 'General Paz', 'Córdoba', '5000', 351, 4521062, 'carlateacher@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000524', '2015-02-22 20:42:42'),
(116, 'English Private Institute', 'EPI', 'Ana Maria', 'Ambroggio', 'Mitre 875', 'San Francisco', 'Córdoba', '2400', 3564, 428377, 'gbonetti@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000113', '2015-02-22 20:42:42'),
(117, 'English Programmes', 'EP', 'Sandra', 'Gastaldi', 'Av Rafael Nuñez 5671', '', 'Cordoba', '', 3543, 443030, 'sandragastaldi@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003043', '2015-02-22 20:42:42'),
(118, 'English School', 'Eng School Mara', 'Prof. Mara', 'Genesio', 'Belgrano 465', 'Zenon Pereyra', 'Santa Fe', '2409', 3564, 492367, 'maragenesio@ghotmail.com', 'No State Funding', 'Private Language School', 'ARPC002712', '2015-02-22 20:42:42'),
(119, 'ENGLISH SCHOOL- M.E. VEGA', 'ME VEGA', 'MARÍA ELENA', 'VEGA', 'BUENOS AIRES 340', '', 'LA RIOJA', '5300', 3804, 424243, 'englishschoollarioja@gmail.com', 'No State Funding', 'Private Language School', 'ARPC004160', '2015-02-22 20:42:42'),
(120, 'English Studio', 'English Studio', 'María Elisa', 'Lucero', 'Pio Angulo 117', '', 'Bell Ville', '', 3537, 423337, 'elilucerostudio@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004265', '2015-02-22 20:42:42'),
(121, 'English Today School', 'English Today', 'Martha', 'Asis de Beraudo', '25 de Mayo 773', 'Sunchales', 'Santa Fe', '2322', 3493, 422643, 'englishtoday@soon.com.ar', 'No State Funding', 'Private Language School', 'ARPC001146', '2015-02-22 20:42:42'),
(122, 'English Training Centre', 'Eng Training Centre', 'Fabiana', 'Cáceres', 'Av. Tronador 2466', 'Parque Capital', 'Córdoba', '5010', 351, 4667411, 'fabicaceres@siscadat.com.ar', 'No State Funding', 'Private Language School', 'ARPC000525', '2015-02-22 20:42:42'),
(123, 'English World', 'Englis World', 'Rosana', 'Berlezieri', 'Bulnes 3102', 'Pueyrredón', 'Cordoba', '5012', 0, 4521400, 'english-world@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC003078', '2015-02-22 20:42:42'),
(124, 'Englishland', 'Englishland', 'Ana Rita', 'De Monte', 'Julián Paz 1842', 'Villa Cabrera', 'Córdoba', '5009', 351, 4803762, 'anardemonte@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000526', '2015-02-22 20:42:42'),
(125, 'ENGLISH-NET ENSEÑANZA DE INGLES PARA ADULTOS', 'ENGLISH NET SAN LUIS', 'ROMINA', 'FESSIA', 'CHACABUCO 1209', '', 'SAN LUIS', '5700', 266, 4431885, 'consultas@english-net.com.ar', 'No State Funding', 'Private Language School', 'ARPC003413', '2015-02-22 20:42:42'),
(126, 'Esc Bilingüe Dante Alighieri San Francisco', 'Dante San Francisco', 'Susana', 'Lagnasco', 'Las Margaritas esq Universidad', '', 'SAN FRANCISCO', '2400', 3564, 438086, 'marielavalsagna@hotmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC004175', '2015-02-22 20:42:42'),
(127, 'Escuela Adolfo Bioy Casares', 'ABC', 'Ivana', 'Cavallera', 'Peredo 1572', 'Observatorio', 'Córdoba', '5000', 351, 4118921, 'icavallera@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002108', '2015-02-22 20:42:42'),
(128, 'ESCUELA DE CULTURA INGLESA GRAL. PICO', 'ESC CULT GRAL PICO', 'MARGARITA', 'SOLER', 'CALLE 21 Nº 701', '', 'GENERAL PICO', '6360', 2302, 421824, 'megsol@speedy.com.ar', 'No State Funding', 'Private Language School', 'ARPC003537', '2015-02-22 20:42:42'),
(129, 'Escuela de Lengua Extranjera (ELE)', 'ELE La Rioja', 'María Eugenia', 'De la Vega', 'Albert Einstein y Tajamar', 'La Rioja', 'La Rioja', '5300', 3822, 155911152, 'eugedelavega@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000528', '2015-02-22 20:42:42'),
(130, 'Escuela El Caminante', 'Caminante', 'Mercedes', 'Sosa', 'Dean funes 1720', 'Villa María', 'Córdoba', '5900', 353, 4611440, 'coqui.sosa@gmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC000529', '2015-02-22 20:42:42'),
(131, 'Escuela Privada Jean Piaget', 'Jean Piaget', 'Mariana', 'Barrantes', 'Belisario Lobos 67', '', 'Chilecito La Rioja', '5360', 3825, 15585802, 'mariaacunia123@hotmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC004176', '2015-02-22 20:42:42'),
(132, 'Estudio Stratford', 'Stratford', 'Diana', 'Ubios', 'Ginés García 3835', 'Urca', 'Córdoba', '5009', 351, 4819611, 'dianaubios@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000530', '2015-02-22 20:42:42'),
(133, 'Evergreen School of English', 'Evergreen', 'Mónica', 'Vanzetti', 'Ramiro Suárez 1155', 'Villa María', 'Córdoba', '5900', 353, 4528538, 'monicavanzetti@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000531', '2015-02-22 20:42:42'),
(134, 'Fany Romagnoli', 'Romagnoli', 'Fany', 'Romagnoli', 'Deán Funes 258', 'Monte Buey', 'Córdoba', '2589', 3467, 470769, 'fanromag@nodosud.com.ar', 'No State Funding', 'Private Language School', 'ARPC002109', '2015-02-22 20:42:42'),
(135, 'FASTA', 'FASTA', 'Isabel', 'Griffa', 'Bv.Saenz Peña 1151', '', 'San Francisco', '2400', 0, 123456, 'chabegriffa@hotmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC003082', '2015-02-22 20:42:42'),
(136, 'FIAT AUTO ARGENTINA SA', 'FIAT', 'Andrea', 'Calvo', 'Ruta 9 km 695', 'Ferreyra', 'Córdoba', '', 0, 4103559, 'andrea.calvo@fiatauto.com.ar', 'No State Funding', 'Private Language School', 'ARPC003510', '2015-02-22 20:42:42'),
(137, 'Fundación Puntana Eva Perón', 'FPEP', 'Verónica', 'Bustos', 'Pedernera 635', 'Villa Mercedes', 'San Luis', '', 2657, 426835, 'verbustos@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002790', '2015-02-22 20:42:42'),
(138, 'Gabriela Altamirano', 'Altamirano', 'Gabriela', 'Altamirano', 'Urquiza 155 7P dto 47', '', 'Córdoba', '5000', 351, 443030, 'gabrielaaltar@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC003222', '2015-02-22 20:42:42'),
(139, 'Gabriela Díaz Tagle', 'Diaz Tagle', 'Gabriela', 'Diaz Tagle', 'Rey del Bosque 802', 'La Paloma', 'Villa Allende', '5105', 351, 156515655, 'gabydiaz_t@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002146', '2015-02-22 20:42:42'),
(140, 'Gabriela Salto', 'Gabriela Salto', 'Gabriela', 'Salto', 'José Javier Díaz 1620', 'Córdoba', 'Córdoba', '5014', 351, 155999054, 'gabysalto@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002719', '2015-02-22 20:42:42'),
(141, 'GENIUS ACADEMY', 'GENIUS', 'NATACHA LORENA', 'TONDO', 'AV. SERRANA Y ROTONDA DE LOS NIÑOS', '', 'LA PUNTA', '5710', 266, 4862143, 'natylor@gmail.com', 'No State Funding', 'Private Language School', 'ARPC004119', '2015-02-22 20:42:42'),
(142, 'GEORGINA SANTA CRUZ', 'GEORGINA', 'GEORGINA', 'SANTA CRUZ', 'Avila y Zarate', '', 'CORDOBA', '5009', 351, 4816308, 'geobsc@msn.com', 'No State Funding', 'Private Language School', 'ARPC003668', '2015-02-22 20:42:42'),
(143, 'GET ACROSS', 'GET ACROSS', 'MARIA CECILIA', 'ARELLANO LUCAS', 'LAVALLE 1265', '', 'SAN LUIS', '5700', 2664, 9346, 'ceciliasoule@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC003745', '2015-02-22 20:42:42'),
(144, 'Gisela Laco de Ficetti', 'Laco', 'Gisela', 'Laco de Ficetti', 'Pte Perón 682', 'Cosquín', 'Córdoba', '5166', 3541, 451325, 'lacogisela@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC002110', '2015-02-22 20:42:42'),
(145, 'Global', 'Global', 'Gabriela', 'Ayan', 'Balcarce y 17 de agosto', '', 'La Rioja', '', 3822, 15360552, 'gabriela.ayan@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003138', '2015-02-22 20:42:42'),
(146, 'GLOBAL COMMUNICATION', 'GLOBAL 2', 'NATALIA', 'RIVA', 'SAN PEDRO 17', 'RIO TERCERO', 'CORDOBA', '5850', 3571, 412155, 'natiriva@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003159', '2015-02-22 20:42:42'),
(147, 'GO IDIOMAS', 'GO IDIOMAS', 'MARCELA', 'ROMERO', 'ARQ. THAYS 51', 'NUEVA CÓRDOBA', 'CORDOBA', '5000', 351, 5944739, 'marcela@goidiomas.com.ar', 'No State Funding', 'Private Language School', 'ARPC003996', '2015-02-22 20:42:42'),
(148, 'GO PLACES', 'GO PLACES', 'Valeria', 'Luquez', 'Mascardi 113', 'Don Bosco Norte', 'Córdoba', '5000', 0, 155923227, 'goplacesdonbosco@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003956', '2015-02-22 20:42:42'),
(149, 'Green Hills VAllende', 'GH VALLENDE', 'Patricia', 'Masjoan', 'Rivera Indarte 50', 'Villa Allende', 'Córdoba', '5105', 3543, 437376, 'pmasjoan3@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC002111', '2015-02-22 20:42:42'),
(150, 'Green Land', 'Green Land', 'Carolina', 'Ortiz', 'Rafael Nuñez 3784', 'Cerro de Las Rosas', 'Córdoba', '5009', 351, 4810954, 'ariescmo@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000532', '2015-02-22 20:42:42'),
(151, 'Greenhill Alto Verde', 'Greenhill AVERDE', 'Noemí', 'Bergallo', 'La Ramada 3476', 'Alto Verde', 'Córdoba', '5009', 351, 4822133, 'noemicbergallo@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002112', '2015-02-22 20:42:42'),
(152, 'Greenwich English Institute', 'Greenwich', 'Flavia', 'Massei', 'Rivadavia 1128', 'Oncativo', 'Córdoba', '5986', 3572, 15500038, 'flaviamassei@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002715', '2015-02-22 20:42:42'),
(153, 'Growing School', 'Growing School', 'Mariana', 'Beja', 'San Martin 4300', '', 'Rio Ceballos', '', 3543, 15531056, 'mari.beja@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004267', '2015-02-22 20:42:42'),
(154, 'Hands On English & Art School', 'Hands On', 'Romina Gabriela', 'Forray', 'Cerro de las Ovejas y Los Lapachos Sur', 'Villa de merlo', 'San Luis', '5881', 2656, 475366, 'hands-onschool@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002692', '2015-02-22 20:42:42'),
(155, 'Hartford', 'Hartford', 'Gabriela', 'Pautasso', 'Alberdi 168', 'Carlos Paz', 'Córdoba', '5152', 3541, 426652, 'info@hartford-institute.com', 'No State Funding', 'Private Language School', 'ARPC000082', '2015-02-22 20:42:42'),
(156, 'Helston School', 'Helston', 'Elena', 'Bergero', 'Av. Santiago Costamagna 6734', 'Don Bosco', 'Córdoba', '5003', 351, 4840353, 'nora_kusok@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000533', '2015-02-22 20:42:42'),
(157, 'High School Institute', 'High', 'Daniela', 'Gagliardo', 'Janer 780', 'Bº Gral Paz', 'Cordoba', '5000', 0, 443030, 'danigagliardo@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003076', '2015-02-22 20:42:42'),
(158, 'Highland School', 'Highland', 'Anabella', 'Bonetto', 'Manuel Cardeñosa 3117', 'Alto Verde', 'Córdoba', '5009', 351, 4817392, 'highland_school@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000093', '2015-02-22 20:42:42'),
(159, 'Highlands School of English', 'Highlands Sta Rosa', 'Sonia', 'Nicosia', 'Antártida Argentina 457', 'Sta. Rosa de Calamuchita', 'Córdoba', '5196', 3546, 422057, 'sonianicosia@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000660', '2015-02-22 20:42:42'),
(160, 'Highlight English Institute', 'Highlight PALANCAR', 'Lorena', 'Palancar', 'Bv Roca 2061', 'San Francisco', 'Córdoba', '2400', 3564, 433922, 'lorena.palancar@fibertel.com.ar', 'No State Funding', 'Private Language School', 'ARPC002113', '2015-02-22 20:42:42'),
(161, 'High-time School of English', 'Hightime', 'Clara', 'Levi de Goldemberg', 'Morcillo 1931', 'Bº Lourdes', 'Córdoba', '5014', 351, 4550604, 'm_gold@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000535', '2015-02-22 20:42:42'),
(162, 'Hillbrook', 'Hillbrook', 'Rosalía', 'Baronas', 'Mal Paso 3272', 'Bº Jardín', 'Córdoba', '5016', 351, 4647158, 'rosibaronas@yahoo.com', 'No State Funding', '', 'ARPC000537', '2015-02-22 20:42:42'),
(163, 'Hogwarts Academy', 'Hogwarts', 'Mariana', 'Salas', 'Artigas 335', 'Carlos Paz', 'Córdoba', '5152', 3541, 431591, 'info@e-hogwarts.com.ar', 'No State Funding', 'Private Language School', 'ARPC002741', '2015-02-22 20:42:42'),
(164, 'Hudson', 'Hudson', 'Lila', 'Alonso', 'Av. Italia 1537', 'Río Cuarto', 'Córdoba', '5800', 358, 4645464, 'williamhhudson@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000545', '2015-02-22 20:42:42'),
(165, 'I L Arroyito', 'ILA', 'Griselda', 'Magi', 'Gral Paz 1220', '', 'Arroyito', '2434', 3576, 454888, 'griseldamagi@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC003068', '2015-02-22 20:42:42'),
(166, 'ILEI', 'ILEI', 'Robin', 'Bridger', 'Lavalle 261', 'Villa Mercedes', 'San Luis', '5730', 2657, 436599, 'ileivm@gmail.com', 'No State Funding', 'Private Language School', 'ARPC000097', '2015-02-22 20:42:42'),
(167, 'ILI Instituto de Lengua Inglesa', 'ILI SF', 'Maria Rosa', 'Lorenzatto', 'Colón 195', 'San Francisco', 'Córdoba', '2400', 3564, 434495, 'ilisanfrancisco@arnetbiz.com.ar', 'No State Funding', 'Private Language School', 'ARPC000536', '2015-02-22 20:42:42'),
(168, 'In English', 'In English', 'Luisa', 'Maglione', 'Lamadrid 637', 'General Paz', 'Córdoba', '5004', 351, 4517852, 'luisamaglione@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000661', '2015-02-22 20:42:42'),
(169, 'In-Company', 'In Company', 'Andrea', 'Ciarapica', 'Goyechea 3326', '', 'Cordoba', '', 0, 4816054, 'andreaciarapica@incompany-net.com', 'No State Funding', 'Private Language School', 'ARPC003523', '2015-02-22 20:42:42'),
(170, 'INSIGHT ENGLISH INSTITUTE', 'INSIGHT', 'Dora', 'Garbarino', 'San José 829', '', 'Leones', '2594', 3472, 15625232, 'doragarbarino@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC004246', '2015-02-22 20:42:42'),
(171, 'Instituto Argentino de Lengua Inglesa', 'IALI Isla Verde', 'Adriana Susana', 'Gaiero', 'Belgrano 300', 'Isla Verde', 'Córdoba', '2661', 3468, 400082, 'iali@nodosud.com.ar', 'No State Funding', 'Private Language School', 'ARPC002743', '2015-02-22 20:42:42'),
(172, 'Instituto Cambridge La Rioja', 'Cambridge La Rioja', 'Marina', 'Luján', 'Brasil 191', 'Chamical', 'La Rioja', '5380', 3826, 422216, 'mar-lujan@hotmail.es', 'No State Funding', 'Private Language School', 'ARPC000662', '2015-02-22 20:42:42'),
(173, 'INSTITUTO CARLOS SAAVEDRA LAMAS', 'SAAVEDRA LAMAS', 'CLAUDIA CECILIA', 'FELICI', 'HILARIO CUADROS Y EDMUNDO CARLOS', 'BO. CABERO', 'RIO TERCERO', '5850', 3571, 421411, 'icslamas-nm@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003987', '2015-02-22 20:42:42'),
(174, 'Instituto Churchill', 'Churchill RIO III', 'Marta', 'Orta de Arnaudo', 'Alberdi 841', 'Río Tercero', 'Córdoba', '5850', 3571, 422617, 'martaorta@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC002114', '2015-02-22 20:42:42'),
(175, 'INSTITUTO DE LENGUAS ARROYITO', 'INST DE L ARROYITO', 'IVANA', 'MARIONI', 'GENERAL PAZ 1220', '', 'ARROYITO', '2434', 3576, 454888, 'institutolenguasarroyito@gmail.com', 'No State Funding', 'Private Language School', 'ARPC004009', '2015-02-22 20:42:42'),
(176, 'Instituto Headway', 'Headway', 'María Susana', 'Marocco', 'Luis Amaya 24', 'Río Tercero', 'Córdoba', '5850', 3571, 428913, 'susybuby@itc.com.ar', 'No State Funding', 'Private Language School', 'ARPC001077', '2015-02-22 20:42:42'),
(177, 'Instituto Integral de Inglés Mariza Berone', 'Mariza Berone', 'Mariza', 'Berone de Sella', '9 de Julio 1189', 'Morteros', 'Córdoba', '2421', 3562, 423581, 'marizaberone@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000670', '2015-02-22 20:42:42'),
(178, 'Instituto Integral Quality', 'Integral Quality', 'Norma', 'Andrada', 'Santa Fe 736', 'Rio Segundo', 'Córdoba', '5960', 3572, 421087, 'integquality@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000108', '2015-02-22 20:42:42'),
(179, 'Instituto Kent - Mirta Scolari', 'Kent Scolari', 'Mirta', 'Scolari de Barrea', 'Acapulco 4092', 'Parque Horizonte', 'Córdoba', '5016', 351, 4613085, 'institutokent@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002115', '2015-02-22 20:42:42'),
(180, 'INSTITUTO LONDRES', 'LONDRES SAN FRANCISC', 'SILVANA', 'PEROTTI', '25 DE MAYO 2057', '', 'SAN FRANCISCO', '2400', 3564, 15410871, 'perottisilvana@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004118', '2015-02-22 20:42:42'),
(181, 'Instituto Manuel Belgrano', 'Belgrano Catamarca', 'Delia', 'Monferran', 'Chacabuco 381', 'Catamarca', 'Catamarca', '4700', 3833, 430768, 'deliamonferran@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000562', '2015-02-22 20:42:42'),
(182, 'Instituto Sagrado Corazón - Hermanos Maristas', 'Maristas', 'Graciela', 'Ricci', 'Bv. 25 de Mayo 1414', 'San Francisco', 'Córdoba', '2400', 3564, 424855, 'oxford_cli@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC002116', '2015-02-22 20:42:42'),
(183, 'Instituto Santa Ana', 'Santa Ana', 'Mabel', 'Gras', 'Ricardo Rojas 4289', 'Argüello', 'Córdoba', '5147', 3543, 420449, 'colegio_santana@arnet.com.ar', 'No State Funding', 'Compulsory Education School', 'ARPC000041', '2015-02-22 20:42:42'),
(184, 'INSTITUTO SUPERIOR ENGLISH CENTRE', 'INST SUP ENGLISH CEN', 'ELSA', 'PEREZ DE CAPELLO', 'MAIPU 743', '', 'SAN LUIS', '5700', 2664, 440634, 'englishcentre1@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003414', '2015-02-22 20:42:42'),
(185, 'INTELEGO', 'INTEREGO', 'SANDRA', 'BUSTOS', 'VIRGILIO MOYANO 869', '', 'CORDOBA', '5016', 351, 156889182, 'info@intelegoargentina.com', 'No State Funding', 'Private Language School', 'ARPC003570', '2015-02-22 20:42:42'),
(186, 'Interaction', 'Interaction Savid', 'Inés', 'Savid', 'Richardson 40 - PB', 'Nueva Córdoba', 'Córdoba', '5000', 351, 4683185, 'interactionenglish@gmail.com', 'No State Funding', 'Private Language School', 'ARPC000574', '2015-02-22 20:42:42'),
(187, 'Interaction School', 'Interaction Soler', 'Mabel', 'de Soler', 'Raul Casariego 4245', 'Poeta Lugones', 'Córdoba', '5008', 351, 4761174, 'mabesoler17@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000575', '2015-02-22 20:42:42'),
(188, 'Interlingua', 'Interlingua', 'Soledad', 'Rivas', 'Pasaje Teresa González 771', 'Bell Ville', 'Córdoba', '2552', 3534, 419090, 'interlingua2010@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000576', '2015-02-22 20:42:42'),
(189, 'Interlink', 'Interlink', 'Silvana', 'Cornatosky', 'San Nicolás 730', 'Laguna Larga', 'Córoba', '5974', 3572, 480934, 's_cornatosky@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002722', '2015-02-22 20:42:42'),
(190, 'International School', 'International School', 'María Eugenia', 'Fernandez', '3 de Febrero 125', 'Unquillo', 'Córdoba', '5109', 3543, 488600, 'mauge992@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000703', '2015-02-22 20:42:42'),
(191, 'ISLI', 'ISLI', 'Mónica', 'Mastropasqua', 'Av. Mitre 617', 'Villa Mercedes', 'San Luis', '5730', 2657, 431782, 'mastromonica@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000538', '2015-02-22 20:42:42'),
(192, 'Jesus & Mary School of English', 'Jesus Mary', 'Analía', 'Piacenza', 'Vieytes 1635', 'Bª Avenida', 'Córdoba', '5010', 351, 4650306, 'anapiacenza@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC001078', '2015-02-22 20:42:42'),
(193, 'Jose Paz', 'Jose Paz', 'Biviana', 'Marquez', 'Uruguay 210', 'Inriville', 'Pcia de Cordoba', '2587', 0, 480265, 'isjmp@hotmail.com', 'Partial State Funding', 'Compulsory Education School', 'ARPC003409', '2015-02-22 20:42:42'),
(194, 'Julia Mariano', 'Julia Mariano', 'Julia', 'Mariano', 'Colombia 146', 'Nueva Córdoba', 'Córdoba', '5000', 351, 4683093, 'juliaemariano@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000667', '2015-02-22 20:42:42'),
(195, 'Karina Pedacchio Leaniz', 'Pedacchio', 'Karina Elizabeth', 'Pedacchio Leaniz', 'Menta 580', '', 'Villa Giardino', '5176', 3548, 497319, 'karypedacchioleaniz@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003867', '2015-02-22 20:42:42'),
(196, 'Kendall School', 'Kendall', 'Soledad', 'Zannier', 'La Posta 2434', 'Alto Verde', 'Córdoba', '5009', 351, 488793, 'solezanni@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000065', '2015-02-22 20:42:42'),
(197, 'KENT LA PUERTA', 'KENT LA PUERTA', 'Vanesa', 'Grosso', '9 de Julio S/Nº', 'La Puerta - Depto. Río Primero', 'Córdoba', '5137', 3575, 422394, 'vanesa.grosso@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000554', '2015-02-22 20:42:42'),
(198, 'KENT SCHOOL OF ENGLISH - RUEDA', 'KENT RUEDA', 'Ana María', 'Rueda', 'Alte Brown 2353', '', 'Córdoba', '5010', 0, 4663339, 'ruedanam@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003142', '2015-02-22 20:42:42'),
(199, 'King Arthur''s School', 'King Arthur', 'Claudia', 'Beltran', 'Av. Gauss 5984', 'Villa Belgrano', 'Córdoba', '5147', 3543, 434812, 'clabel_63@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002117', '2015-02-22 20:42:42'),
(200, 'KINGS GATE', 'KINGS GATE', 'Laura', 'Effron', 'Colón 49', 'Centro', 'Chamical', '5380', 3826, 154717788, 'lalieffron10@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003080', '2015-02-22 20:42:42'),
(201, 'King''s School', 'Kings School Urca', 'Beatriz', 'Castell de Ruiz', 'Lagos García 1214', 'Urca', 'Córdoba', '5009', 351, 4815165, 'kingsschool@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000590', '2015-02-22 20:42:42'),
(202, 'LA FRANCIA', 'ACAD PART LA FRANCIA', 'MARTA', 'PIOVANO', 'SAN JUAN 555', '', 'LA FRANCIA', '2426', 3564, 15666032, 'teacherone@educ.ar', 'No State Funding', 'Private Language School', 'ARPC003415', '2015-02-22 20:42:42');
INSERT INTO `PrepCentre` (`prc_id`, `prc_name`, `prc_shortname`, `prc_firstname`, `prc_lastname`, `prc_adress1`, `prc_adress2`, `prc_city`, `prc_postcode`, `prc_areacode`, `prc_telephone`, `prc_email`, `prc_typefunding`, `prc_preparationtype`, `prc_uniqueid`, `prc_timestamp`) VALUES
(203, 'Landmark', 'Landmark', 'Cristina', 'Seppey', '25 de Mayo 801 - Planta Baja', 'Villa María', 'Córdoba', '5900', 353, 453308, 'espina@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000559', '2015-02-22 20:42:42'),
(204, 'Laura Bossio', 'Laura Bossio', 'Laura', 'Bossio', 'Macedonio Fernández 4120', 'Parque Corema', 'Córdoba', '5009', 351, 421640, 'laurabossio@languageforbusiness.com.ar', 'No State Funding', 'Private Language School', 'ARPC000549', '2015-02-22 20:42:42'),
(205, 'Laura Naum', 'Laura Naum', 'Laura', 'Naum', 'Independencia 750 Piso 18 Dpto F', 'Nueva Córdoba', 'Córdoba', '5000', 351, 4243999, 'launaum@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC002130', '2015-02-22 20:42:42'),
(206, 'Laura Valinotti', 'Valinotti', 'Laura', 'Valinotti', 'Agüero 1385', 'Villa Mercedes', 'San Luis', '5730', 3543, 443030, 'lauravalinotti@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000550', '2015-02-22 20:42:42'),
(207, 'Leda Gimenez', 'Leda Gimenez', 'Leda Marisa', 'Gimenez', 'Santa Fe 1232', '', 'Santa Fe', '2451', 3406, 441583, 'ledagc@yahoo.com', 'No State Funding', 'Private Language School', 'ARPC003223', '2015-02-22 20:42:42'),
(208, 'Lincoln Institute', 'Lincoln', 'Carolina', 'Palmero', 'Solares 1352', 'San Vicente', 'Córdoba', '5006', 351, 4551684, 'cpalmero@lincoln-institute.com.ar', 'No State Funding', 'Private Language School', 'ARPC002119', '2015-02-22 20:42:42'),
(209, 'LINK - MANERA', 'LINK MANERA', 'Alejandra', 'Manera', 'Padilla 4896', 'San Lorenzo Sur', 'Córdoba', '', 0, 156746188, 'ale-manera@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004294', '2015-02-22 20:42:42'),
(210, 'Link English Language Center', 'Link ELC', 'Mónica', 'Manzotti', 'Almafuerte 261', 'San Francisco', 'Córdoba', '2400', 3564, 422545, 'monica@vaira.com', 'No State Funding', 'Private Language School', 'ARPC002883', '2015-02-22 20:42:42'),
(211, 'LINKS CENTRO DE IDIOMAS', 'LINKS ITURRA', 'Gabriela', 'Iturra', 'Castulo Peña 240', '', 'Jesús María', '5220', 3525, 607617, 'links.centrodeidiomas@gmail.com', 'No State Funding', 'Private Language School', 'ARPC004183', '2015-02-22 20:42:42'),
(212, 'Links Institute', 'Links Inst', 'Cristina', 'Di Natale', 'Capital Federal 23', 'La Falda', 'Córdoba', '5172', 351, 421605, 'linksinstitute@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000592', '2015-02-22 20:42:42'),
(213, 'Liverpool School', 'Liverpool', 'Patricia', 'Budman', 'Martiniano Leguizamón 4089', 'Urca', 'Córdoba', '5009', 351, 4822903, 'jesi248@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000560', '2015-02-22 20:42:42'),
(214, 'Lollipop', 'Lollipop', 'Olga', 'Weihmuller', 'Belgrano 62', 'Deán Funes', 'Córdoba', '5200', 3521, 420697, 'nacho_bussy@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000561', '2015-02-22 20:42:42'),
(215, 'London Academia de Lengua Inglesa', 'London Monica Franco', 'Monica', 'Franco', 'Monseñor Pablo Cabrera 3228', 'Zumaran', 'Córdoba', '5008', 351, 4771089, 'acad_london@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000633', '2015-02-22 20:42:42'),
(216, 'London English Center', 'London Ochetti', 'Victoria', 'Ochetti', 'Piacenza 297', '', 'Oncativo', '5986', 3572, 466389, 'vikiochetti@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003234', '2015-02-22 20:42:42'),
(217, 'London Institute', 'London Cosquin', 'Monica', 'Brunello', 'Gerónico 379', 'Cosquín', 'Córdoba', '5166', 351, 452752, 'londoninstitute@live.com.ar', 'No State Funding', 'Private Language School', 'ARPC000593', '2015-02-22 20:42:42'),
(218, 'LTC', 'LEADING TRAINING COR', 'OSVALDO', 'RODAS', 'SUCRE 270', '', 'CORDOBA', '5000', 351, 4290599, 'info@ltcargentina.com', 'No State Funding', 'Private Language School', 'ARPC003257', '2015-02-22 20:42:42'),
(219, 'Mainland Institute', 'Mainland', 'Mónica', 'Comba', 'Mariano Moreno 138', 'San Guillermo', 'Santa Fé', '2347', 3562, 466616, 'monic_810@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000594', '2015-02-22 20:42:42'),
(220, 'Manchester Institute', 'Manchester Horizonte', 'María del Carmen', 'Maiztegui', 'Canarias 4372', 'Parque Horizonte', 'Córdoba', '5016', 351, 4611823, 'mdelcmaiztegui@uolsinectis.com.ar', 'No State Funding', 'Private Language School', 'ARPC000595', '2015-02-22 20:42:42'),
(221, 'Manon Kleinveld', 'Manon Kleinveld', 'Manon', 'Kleinveld', 'Mons. Ferreyra 6181', 'Arguello', 'Córdoba', '', 3543, 426994, 'manonbkleinveld@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003221', '2015-02-22 20:42:42'),
(222, 'MARIA VERONICA DEFAGOT', 'VERONICA DEFAGOT', 'MARIA VERONICA', 'DEFAGOT', 'BRAULIO COLAZO 1323', 'PILAR', 'CORDOBA', '5972', 3572, 471502, 'verodefagot@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002650', '2015-02-22 20:42:42'),
(223, 'Mariana Figueroa', 'Mariana Figueroa', 'Mariana', 'Figueroa', 'Yahuar Huacac 7525', 'Argüello', 'Córdoba', '5147', 3543, 429447, 'figueroayflia@uolsinectis.com.ar', 'No State Funding', 'Private Language School', 'ARPC000673', '2015-02-22 20:42:42'),
(224, 'Mariela Giurda', 'Giurda', 'Mariela', 'Giurda', '25 de Mayo 1817', 'Arroyito', 'Córdoba', '2434', 3576, 424029, 'marielagiurda@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002641', '2015-02-22 20:42:42'),
(225, 'MARIQUE ROSSO', 'Rosso', 'María del Carmen', 'Rosso', 'Amuchástegui 113', '', 'Río Ceballos', '5111', 3543, 452309, 'rossomarique@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC004033', '2015-02-22 20:42:42'),
(226, 'MARISA FAVRE', 'MARISA FAVRE', 'MARISA', 'FAVRE', '25 de mayo 654', '', 'VILLA ALLENDE', '5105', 3543, 433574, 'marfavr2005@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003259', '2015-02-22 20:42:42'),
(227, 'Marta Vivas', 'Marta Vivas', 'Marta', 'Vivas', 'Junin 1252 1 "A"', 'San Luis', 'San Luis', '5700', 2652, 424194, 'martavivas@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002726', '2015-02-22 20:42:42'),
(228, 'Maryland School', 'Maryland', 'Leticia', 'Di Siena', 'Güemes y Alberti', 'Villa Allende', 'Córdoba', '5105', 3543, 432232, 'leticiadealbera@gmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC000086', '2015-02-22 20:42:42'),
(229, 'Maxwell', 'Maxwell', 'Mabel', 'Stump', 'Boucherville 545', 'La Cumbre', 'Córdoba', '5178', 3548, 451532, 'maxwellse@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002707', '2015-02-22 20:42:42'),
(230, 'Morrison Institute', 'Morrison', 'Raul and Carolina', 'Massei', 'Av. Belgrano 158', '', 'Morrison', '', 3537, 480171, 'anacarolinamassei@gmail.com', 'No State Funding', 'Private Language School', 'ARPC004268', '2015-02-22 20:42:42'),
(231, 'MOVE ON', 'MOVE ON', 'Carolina', 'Robles', 'Dean Funes 50 - 2° Piso - Of. 205', 'Argüello', 'Córdoba', '5147', 351, 152264573, 'carolina@moveonincompany.com', 'No State Funding', 'Private Language School', 'ARPC004327', '2015-02-22 20:42:42'),
(232, 'Multiple Choice', 'Multiple Choice', 'Diego', 'Quinteros', 'Pablo Buitrago 7100 esq Domingo Albariños', 'Quintas de Argüello', 'Córdoba', '5147', 3543, 443335, 'multiplechoiceingles@gmail.com', 'No State Funding', 'Private Language School', 'ARPC000608', '2015-02-22 20:42:42'),
(233, 'My English School', 'My English School', 'Norma', 'Rossini', 'Belgrano 746', 'Arroyito', 'Córdoba', '2434', 3576, 422225, 'esrossini@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000609', '2015-02-22 20:42:42'),
(234, 'Natalia Gomez Calvillo', 'Gomez Calvillo', 'Natalia', 'Gómez Calvillo', 'Mercado y Villacorta 1767 PB E', 'Bajo Palermo', 'Córdoba', '5009', 351, 4898944, 'nataliagomezcalvillo@yahoo.es', 'No State Funding', 'Private Language School', 'ARPC001517', '2015-02-22 20:42:42'),
(235, 'Network Hernando', 'Network Hernando', 'Raquel', 'Novaira', 'Italia 369', 'Hernando', 'Córdoba', '5929', 353, 4962053, 'network@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC003224', '2015-02-22 20:42:42'),
(236, 'Network Totoral', 'Network Tot', 'Ma. Rosario', 'Del Castillo', 'Pte Perón esq O. Pinto', 'Villa del Totoral', 'Córdoba', '5236', 3524, 471876, 'nwtotoral@cooptotoral.com.ar', 'No State Funding', 'Private Language School', 'ARPC000078', '2015-02-22 20:42:42'),
(237, 'Neverland', 'Neverland', 'Noelia', 'Scillone', 'Estados Unidos 885', 'Villa Maria', 'Córdoba', '5900', 353, 4614927, 'noeliascillone1@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002644', '2015-02-22 20:42:42'),
(238, 'New American School', 'New American', 'Eva', 'Lejbman', 'Obispo Arregui 4700', 'Padre Claret', 'Córdoba', '5009', 351, 4811323, 'uclescba@ciudad.com.ar', 'No State Funding', 'Private Language School', 'ARPC000610', '2015-02-22 20:42:42'),
(239, 'New Connections', 'New Connections', 'María Laura', 'Romero', 'Pasaje Tossolini 1357', 'Bell Ville', 'Córdoba', '2550', 3534, 423224, 'mlromerolali@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002120', '2015-02-22 20:42:42'),
(240, 'NEW GENERATION', 'NEW GENERATION', 'NANCY', 'CAMUSSO', 'ITALIA 913', 'Fray Luis Beltrán 127', 'DEVOTO', '2424', 3564, 15562408, 'ncamusso@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003710', '2015-02-22 20:42:42'),
(241, 'New School of English', 'New School English', 'Marysol', 'Costa', '9 de Julio 226', 'Villa María', 'Córdoba', '5900', 353, 154064373, 'marysolcosta@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC001079', '2015-02-22 20:42:42'),
(242, 'NEW WAVE', 'NEW WAVE', 'Nidia', 'Bruno', 'Belgrano 445', '', 'Porteña', '2415', 3564, 614875, 'brunonidia@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003235', '2015-02-22 20:42:42'),
(243, 'New Ways Institute', 'New Ways', 'María José', 'Castro', 'Rivadavia 156', 'Villa Allende', 'Córdoba', '5105', 3543, 435175, 'new.ways.va@gmail.com', 'No State Funding', 'Private Language School', 'ARPC002122', '2015-02-22 20:42:42'),
(244, 'Niños Músicos', 'Ninos Musicos', 'Carolina', 'Acuña', 'Ituzaingó 658', 'Nueva Córdoba', 'Córdoba', '5000', 351, 4614827, 'caroacu69@gmail.com', 'No State Funding', 'Private Language School', 'ARPC000544', '2015-02-22 20:42:42'),
(245, 'Northlands School of English', 'Northlands', 'Marisel', 'Bonansea', 'Córdoba 934', 'Jesús María', 'Córdoba', '5520', 3525, 15549003, 'mariselbon3@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000034', '2015-02-22 20:42:42'),
(246, 'Northstar', 'Northstar', 'Carolina', 'D''Agostino', 'Paraguay 425', 'Paso de Los Andes', 'Córdoba', '', 0, 4272011, 'ingles_ns@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002788', '2015-02-22 20:42:42'),
(247, 'Nottingham', 'Nottingham', 'Cecilia', 'Gilli', 'Ruta Provincial E 57', 'Country Cuatro Hojas', 'Córdoba', '5007', 3543, 496865, 'uclescba@ciudad.com.ar', 'No State Funding', 'Private Language School', 'ARPC002932', '2015-02-22 20:42:42'),
(248, 'NUEVO MILENIO', 'NUEVO MILENIO', 'VALERIA', 'CALICIOTTI', 'RUTA 53', 'UNQUILLO', 'CORDOBA', '5109', 3543, 15558459, 'englishforeing@hotmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC002648', '2015-02-22 20:42:42'),
(249, 'O''CLOCK ENGLISH CENTRE', 'OCLOCK', 'Iris', 'Groube', 'Cordillera 3774', 'Cerro Chico', 'Córdoba', '5009', 351, 152430954, 'carotova21@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003924', '2015-02-22 20:42:42'),
(250, 'OK IDIOMAS', 'OK IDIOMAS', 'ANDREA', 'OSUNA', 'ANTRANIK 886', '', 'CORDOBA', '5012', 351, 4525772, 'ok.idiomas@topmail.com', 'No State Funding', 'Private Language School', 'ARPC003603', '2015-02-22 20:42:42'),
(251, 'On Line English School', 'On Line', 'Silvana', 'Bastino', 'Estados Unidos 229', 'Villa María', 'Córdoba', '5900', 353, 4536089, 'silvanabastino@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000033', '2015-02-22 20:42:42'),
(252, 'ON TOP', 'ON TOP', 'SANDRA MARIELA', 'CARLETTO', 'CATAMARCA 995 - 6º B', 'BARRIO GENERAL PAZ', 'CORDOBA', '5000', 351, 4210900, 'carlettosandra@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003602', '2015-02-22 20:42:42'),
(253, 'One World', 'One World', 'Ivana', 'Fassi', 'Progreso 715', 'Villa María', 'Cordoba', '5900', 353, 155699987, 'free285@msn.com', 'No State Funding', 'Private Language School', 'ARPC003468', '2015-02-22 20:42:42'),
(254, 'Open Doors', 'Open Doors', 'Romina', 'Rolando', 'La Rioja 732', 'Alicia - San Justo', 'Córdoba', '5949', 3533, 15430030, 'safira48@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC001142', '2015-02-22 20:42:42'),
(255, 'OPEN DOORS ENGLISH', 'OPEN DOORS ENG', 'CONSTANZA', 'RULLI', 'La Salle 6074', 'Villa Belgrano', 'Córdoba', '5147', 351, 156103637, 'opendoorsenglish@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003410', '2015-02-22 20:42:42'),
(256, 'OXBRIDGE', 'OXBRIDGE SCHOOL OF E', 'LEO MARTIN', 'MARQUEZ', 'SARMIENTO E HIPOLITO', 'CONCARAN - SAN LUIS', 'CONCARAN', '5770', 2656, 474553, 'oxbridgesanluis@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003258', '2015-02-22 20:42:42'),
(257, 'Oxford Bell Ville', 'Oxford Bell Ville', 'Alicia', 'Bertello', 'Tucumán 323', 'Bell Ville', 'Córdoba', '2550', 3534, 425298, 'aliciabertello@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000540', '2015-02-22 20:42:42'),
(258, 'Oxford Centro de Cultura Inglesa', 'Oxford Santillan', 'Graciela', 'Santillan', 'Fragueiro 2186', 'Alta Córdoba', 'Córdoba', '5001', 351, 4736041, 'mcsambrooks@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000505', '2015-02-22 20:42:42'),
(259, 'Oxford Centro de Lengua Inglesa', 'Oxford San Francisco', 'Graciela', 'Ricci', 'Salta 2662', 'San Francisco', 'Córdoba', '2400', 3564, 433235, 'oxford_cli@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000675', '2015-02-22 20:42:42'),
(260, 'Oxford Institute Alta Gracia', 'Oxford Alta Gracia', 'Suny', 'Guereschy', 'Paraguay 535', 'Alta Gracia', 'Córdoba', '5186', 3547, 420815, 'oxford@fullzero.com.ar', 'No State Funding', 'Private Language School', 'ARPC000676', '2015-02-22 20:42:42'),
(261, 'Oxford Institute Villa Belgrano', 'Oxford Villa Belgran', 'María Isabel', 'Lázzaro', 'Fernando Braun 6023', 'Villa Belgrano', 'Córdoba', '5147', 3543, 422138, 'marylazzaro22@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000677', '2015-02-22 20:42:42'),
(262, 'OXFORD SCHOOL OF ENGLISH', 'OXFORD ONCATIVO', 'CECILIA', 'AIMAR', 'LAMADRID 536', '', 'ONCATIVO', '5986', 3572, 466961, 'cecilia_aimar@hotmail.com.ar', 'No State Funding', 'Private Language School', 'ARPC004116', '2015-02-22 20:42:42'),
(263, 'PAMPAS', 'Pampas T T', 'Mariela', 'Miazzo', 'Suipacha 313', '', 'Villa Mercedes', '5730', 2657, 604662, 'pampas@pampastranslations.com', 'No State Funding', 'Private Language School', 'ARPC003876', '2015-02-22 20:42:42'),
(264, 'Passport English Institute', 'Passport Ballesteros', 'SILVANA', 'BRINER', 'Velez Sarsfield 145', '', 'Ballesteros', '2572', 353, 155695090, 'silbriner@gmail.com', 'No State Funding', 'Private Language School', 'ARPC004174', '2015-02-22 20:42:42'),
(265, 'Passport English School', 'Passport', 'Claudia', 'Zulpo', 'Güemes 1084', 'Justiniano Posse', 'Córdoba', '2553', 3534, 15550002, 'claudiazulpo@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000088', '2015-02-22 20:42:42'),
(266, 'Passport English School 1', 'Passport 3', 'Sandra', 'Mulassano', 'Emilio Casas Ocampo 2972', '', 'Córdoba', '', 3543, 429292, 'passportenglishschool@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC003141', '2015-02-22 20:42:42'),
(267, 'Passport Idiomas', 'Passport 1', 'Marcela', 'Serra', '9 de Julio 537', '', 'Córdoba', '', 351, 270208, 'cursos@passportidiomas.com.ar', 'No State Funding', 'Private Language School', 'ARPC003122', '2015-02-22 20:42:42'),
(268, 'PASSWORD', 'PASSWORD', 'MARIANA', 'LANZA', 'PUEYRREDON 161', '', 'RAFAELA', '2300', 3492, 15519402, 'marilan8@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003644', '2015-02-22 20:42:42'),
(269, 'Patricia Maqueda', 'Maqueda', 'Patricia', 'Maqueda', 'Pascal 5719', 'Villa Belgrano', 'Córdoba', '5147', 351, 155946509, 'p.maqueda@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000552', '2015-02-22 20:42:42'),
(270, 'Patricia Osacar', 'Osacar', 'Patricia', 'Osacar', 'Valparaíso 4247', '', 'Córdoba', '5016', 351, 4620419, 'pat.osacar@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003906', '2015-02-22 20:42:42'),
(271, 'Pia Didoménico', 'PIA', 'Carolina', 'Ferraresi Curotto', 'Perú 18', 'Catamarca', 'Catamarca', '4700', 383, 4420726, 'caroferraresicurotto@yahoo.com.ar', 'Partial State Funding', 'Private Language School', 'ARPC002123', '2015-02-22 20:42:42'),
(272, 'Pink and Blue', 'Pink and Blue', 'Silvia', 'Campra de Juan', 'Sarmiento 321', 'Las Varillas', 'Córdoba', '5940', 3533, 420437, 'campra@lasvarinet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000611', '2015-02-22 20:42:42'),
(273, 'Praxis', 'Praxis', 'Mónica', 'Spesso', '25 de Mayo 301', 'Las Varillas', 'Córdoba', '5940', 3533, 421665, 'aromando@lasvarinet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000029', '2015-02-22 20:42:42'),
(274, 'Precision Translation and Training', 'Precision', 'Cecilia', 'Sartori', 'Chile 172 - 4º C', 'Centro', 'Córdoba', '5000', 351, 4606058, 'ceciliasartori@precisiontc.com.ar', 'No State Funding', 'Private Language School', 'ARPC000028', '2015-02-22 20:42:42'),
(275, 'Primera Enseñanza', 'Primera Ensenanza', 'Valeria', 'Mosqueda', 'Santa Rosa 688', '', 'Córdoba', '', 0, 4280380, 'valeriamosqueda@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003522', '2015-02-22 20:42:42'),
(276, 'Quality Justiniano Posse', 'Quality JP', 'Luciana', 'Sileoni', 'Gral Guemes esq. Las Heras', 'Justiniano Posse', 'Córdoba', '2553', 351, 155120749, 'lucianasileoni@yahoo.com', 'No State Funding', 'Private Language School', 'ARPC000543', '2015-02-22 20:42:42'),
(277, 'Queenspark', 'Queenspark', 'Patricia', 'Robino', '7 De Septiembre 4251', 'Panamericano Anexo', 'Córdoba', '5000', 351, 4700458, 'queenspark_cba@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC002723', '2015-02-22 20:42:42'),
(278, 'Rainbow - Va Ma', 'Rainbow Va Ma', 'Patricia', 'Scauso', 'Bv. Italia 180', '', 'Villa María', '5900', 353, 4534953, 'patriciaeviola@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC003875', '2015-02-22 20:42:42'),
(279, 'Rainbow Arroyito', 'Rainbow Arroyito', 'Laura', 'Ferreyra', 'Rivadavia 528', 'Arroyito', 'Córdoba', '2434', 3576, 424011, 'garciaferreyra@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000564', '2015-02-22 20:42:42'),
(280, 'Rainbow Bell Ville', 'Rainbow BV', 'Liliana', 'Cabo de Vila', 'Bv Colón 372', 'Bell Ville', 'Córdoba', '2550', 3534, 424896, 'rainbowbv@nodosud.com.ar', 'No State Funding', 'Private Language School', 'ARPC000075', '2015-02-22 20:42:42'),
(281, 'Rainbow Oliva', 'Rainbow Oliva', 'Noelia', 'Mainardi', 'Belgrano 29', 'Oliva', 'Córdoba', '5980', 3532, 420673, 'noeliamainardi@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000679', '2015-02-22 20:42:42'),
(282, 'RAINBOW V MACKENNA', 'RAINBOW MACKENNA', 'MARÍA CECILIA', 'PEREZ', 'JULIO A. ROCA 170', '', 'VICUÑA MACKENNA', '', 3583, 15595108, 'amiss@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003512', '2015-02-22 20:42:42'),
(283, 'Red and Green', 'Red and Green', 'Marisa', 'Castro', 'Rafael Sanzio 860', 'Bº Jardín', 'Córdoba', '5016', 351, 4618515, 'marisacastro66@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000553', '2015-02-22 20:42:42'),
(284, 'Red Apple', 'Red Apple', 'Ana', 'Centeno', 'Petorutti 2349', 'Cerro', 'Córdoba', '5009', 351, 4819213, 'a.c.centeno@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000619', '2015-02-22 20:42:42'),
(285, 'Reydon School', 'Reydon', 'Mónica', 'Jackson', 'Cruz Chica', 'La Cumbre', 'Córdoba', '5178', 3548, 452007, 'mjackson@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000612', '2015-02-22 20:42:42'),
(286, 'RIVENDELL', 'RIVENDELL SCHOOL OF', 'ERICA SOFÍA', 'CARIGNANO', 'BOSQUE PEHUÉN 120', '', 'VILLA NUEVA', '5903', 353, 4914159, 'inforivendell@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003536', '2015-02-22 20:42:42'),
(287, 'Rupert Ormsby', 'Ormsby', 'Georgina', 'Ormsby', 'Córdoba 1330', 'Jesús María', 'Córdoba', '5220', 3525, 421976, 'uclescba@ciudad.com.ar', 'No State Funding', 'Private Language School', 'ARPC000547', '2015-02-22 20:42:42'),
(288, 'S John the Baptist', 'Baptist', 'Monica', 'Forzani', '25 de Mayo 1194', '', 'San Francisco', '2400', 3564, 15611334, 'mforzani@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC003129', '2015-02-22 20:42:42'),
(289, 'S&M English Group', 'Huergo LR', 'SILVIA', 'Jardón', '25 de Mayo 475', '', 'La Rioja', '5300', 380, 4360870, 'siljlr@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002651', '2015-02-22 20:42:42'),
(290, 'Sagrada Familia', 'Sagrada Familia', 'Maria Piera', 'Cortez', 'Vicuña Mackenna', '', 'Córdoba', '6140', 3583, 420403, 'cortezpiera@hotmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC003041', '2015-02-22 20:42:42'),
(291, 'Saint George Misiones', 'St George Misiones', 'Patricia', 'Rodriguez', 'San Luis y La Rioja', 'Posadas', 'Misiones', '3300', 0, 440055, 'stgeorge@isparm.edu.ar', 'No State Funding', 'Private Language School', 'ARPC002931', '2015-02-22 20:42:42'),
(292, 'Salesiano Don Bosco (Pio X)', 'Pio X', 'Patricia', 'Arriondo de Jauregui', '9 de Julio 1055', 'Centro', 'Córdoba', '5000', 351, 155308834, 'hellopatopato@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC002739', '2015-02-22 20:42:42'),
(293, 'San Diego', 'San Diego', 'Graciela', 'Nobile', 'Lestache 125', '', 'Rio Ceballos', '5111', 3543, 2147483647, 'nobilegraciela@gmail.com', 'No State Funding', 'Private Language School', 'ARPC003905', '2015-02-22 20:42:42'),
(294, 'San Jorge', 'San Jorge', 'Patricia', 'Murúa', 'Maipu 66', 'Centro', 'Cordoba', '5000', 0, 4224449, 'patomurua@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003407', '2015-02-22 20:42:42'),
(295, 'San Pedro Apóstol', 'San Pedro', 'María José', 'Peyrani', 'Av. Piemonte esq Nazca', 'Chateau Carreras', 'Córdoba', '5003', 351, 4846584, 'mjpeyrani@hotmail.com', 'No State Funding', 'Compulsory Education School', 'ARPC000027', '2015-02-22 20:42:42'),
(296, 'San Pedro Apóstol primary school', 'SPA Prim', 'Maria Paulina', 'Dall''Occhio', 'Av. del Piemonte esq Nazca', '', 'Córdoba', '5003', 351, 4846584, 'paudallo@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003085', '2015-02-22 20:42:42'),
(297, 'Sandra Costilla', 'Costilla', 'Sandra', 'Costilla', 'Argüello', '', 'Córdoba', '', 0, 443030, 'sccostilla@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC002147', '2015-02-22 20:42:42'),
(298, 'Santa Clara de Asís', 'Santa Clara', 'Mirta', 'Stobbia', 'Revolución de Mayo 1476', 'Maipú', 'Córdoba', '5014', 3543, 443030, 'surubi51@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000514', '2015-02-22 20:42:42'),
(299, 'SET IDIOMAS', 'SET', 'Eduardo', 'Trucco', 'Laprida 255', 'B° Güemes', 'Córdoba', '5000', 351, 4691574, 'etrucco@set-idiomas.com.ar', 'No State Funding', 'Private Language School', 'ARPC000613', '2015-02-22 20:42:42'),
(300, 'SHEBOYGAN ENGLISH SCHOOL', 'SHEBOYGAN', 'GLORIA', 'GUZMÁN', 'M.A. LUQUE 401', '', 'LAS VARILLAS', '5940', 3533, 421900, 'sheboygans@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003605', '2015-02-22 20:42:42'),
(301, 'Sherwood Institute', 'Sherwood', 'Marisa', 'Burki', 'Av. España 41', 'Bell Ville', 'Córdoba', '2550', 3543, 443030, 'marisaburki@live.com.ar', 'No State Funding', 'Private Language School', 'ARPC000565', '2015-02-22 20:42:42'),
(302, 'SHERWOOD MARCOS JUAREZ', 'SHERWOOD MJ', 'ANA CLAUDIA', 'LAMBERTUCCI', 'JUJUY 624', 'MARCOS JUAREZ', 'CORDOBA', '2580', 3472, 4244387, 'gaierofernando@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC002649', '2015-02-22 20:42:42'),
(303, 'Skills Catamarca', 'Skills Catamarca', 'Joanne', 'Ingouville', 'Sarmiento 817', 'Catamarca', 'Catamarca', '4700', 3833, 431671, 'skills@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC002131', '2015-02-22 20:42:42'),
(304, 'Skills Institute', 'Skills Las Rosas', 'Amalia', 'Flores', 'Rafael Correa 1125', 'Las Rosas', 'Córdoba', '5009', 351, 4814481, 'varinici@ciudad.com.ar', 'No State Funding', 'Private Language School', 'ARPC000567', '2015-02-22 20:42:42'),
(305, 'Skills Jardín', 'Skills Jardin', 'Marcela', 'Massé', 'Elías Yofre 1079', 'Bº Jardín', 'Córdoba', '5016', 351, 4647387, 'sm-skills@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000566', '2015-02-22 20:42:42'),
(306, 'Smallville', 'Smallville', 'Gabriela', 'Parsi', 'Progreso 371', 'Villa María', 'Córdoba', '5900', 353, 4526854, 'gabrielaparsi@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000614', '2015-02-22 20:42:42'),
(307, 'Smart', 'Smart Laura Frola', 'Laura', 'Frola', 'Paseo Comercial del Centro Local 10 PA', 'Devoto', 'Córdoba', '2424', 3562, 400333, 'lfbrink@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC000615', '2015-02-22 20:42:42'),
(308, 'Smart Romina Trossero', 'Smart Trossero', 'Romina', 'Trossero', 'San Martín 952', 'Freyre', 'Córdoba', '2413', 3564, 461227, 'rtrossero@yahoo.com.ar', 'No State Funding', 'Private Language School', 'ARPC002132', '2015-02-22 20:42:42'),
(309, 'SPEAKER´S CORNER-BARONI', 'SPEAKERS', 'MARÍA CAROLINA', 'BARONI', 'CNO. SAN CARLOS KM 5 1/2', 'FINCAS DEL SUR', 'CORDOBA', '5014', 351, 155900310, 'carolinabaroni@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC003657', '2015-02-22 20:42:42'),
(310, 'Speaker''s Corner', 'Speakers Corner', 'Juliana', 'Damia', 'Real de Azua 3722 esq. Lagos García', 'Urca', 'Córdoba', '5009', 351, 4821130, 'julianadamia@gmail.com', 'No State Funding', 'Private Language School', 'ARPC000025', '2015-02-22 20:42:42'),
(311, 'St Mark''s School', 'st marks', 'Candelaria', 'Torres', 'Mariotte 6715', 'Villa Belgrano', 'Córdoba', '5147', 3543, 402259, 'candetorres@yahoo.com', 'No State Funding', 'Private Language School', 'ARPC000024', '2015-02-22 20:42:42'),
(312, 'St Michael''s English Institute', 'St Michaels', 'Sarah Ana', 'Estrada de Juarez', 'Pelagio B. Luna 337', 'La Rioja', 'La Rioja', '5300', 3822, 426148, 'sarahana@latinmail.com', 'No State Funding', 'Private Language School', 'ARPC000023', '2015-02-22 20:42:42'),
(313, 'St Paul''s School', 'St Pauls', 'Kathleen', 'Sampson', 'Calle Publica', 'La Cumbre', 'Córdoba', '5178', 3548, 492021, 'kathysampson@arnet.com.ar', 'No State Funding', 'Private Language School', 'ARPC000022', '2015-02-22 20:42:42'),
(314, 'St Peter''s School', 'St Peters', 'Graciela', 'Sosa de Mazzucco', 'Buenos Aires 240', 'Alta Gracia', 'Córdoba', '5186', 3547, 424470, 'gracielasosa57@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000021', '2015-02-22 20:42:42'),
(315, 'St Thomas Institute', 'St Thomas', 'Verónica', 'Manini', 'San Martín 130', 'Saldán', 'Córdoba', '5149', 3543, 494422, 'chivi_marti0407@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000020', '2015-02-22 20:42:42'),
(316, 'St. George', 'St George', 'Cecilia', 'Audisio', 'Colón 703', 'Villa del Rosario', 'Córdoba', '5963', 3573, 424384, 'ceciliaaudisio@covinter.com.ar', 'No State Funding', 'Private Language School', 'ARPC000095', '2015-02-22 20:42:42'),
(317, 'St. John''s School', 'St Johns School', 'María Inés', 'Scagliotti', 'Recta Martinoli 5946', 'Argüello', 'Córdoba', '5147', 3543, 440234, 'malecordeiro@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000617', '2015-02-22 20:42:42'),
(318, 'St. John''s Wood', 'St Johns Wood', 'Ana', 'Trezza', 'Edison 1466', 'Yofre Sur', 'Córdoba', '5012', 351, 4524382, 'sjwcordoba@hotmail.com', 'No State Funding', 'Private Language School', 'ARPC000618', '2015-02-22 20:42:42'),
(319, 'St. Louis Institute', 'St Louis', 'Celeste', 'de Camargo', 'Mitre 613', 'San Luis', 'San Luis', '5700', 2652, 429202, 'saintlouis@speedy.com.ar', 'No State Funding', '', '', '2015-02-22 20:42:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TypeExam`
--

CREATE TABLE `TypeExam` (
  `tye_id` int(5) NOT NULL AUTO_INCREMENT,
  `tye_name` varchar(100) NOT NULL,
  `tye_aci` tinyint(1) NOT NULL,
  `tye_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tye_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `TypeExam`
--

INSERT INTO `TypeExam` (`tye_id`, `tye_name`, `tye_aci`, `tye_timestamp`) VALUES
(1, 'CAE', 0, '2015-01-25 02:17:33'),
(2, 'KET', 1, '2015-01-25 02:17:33'),
(3, 'PET', 0, '2015-01-25 02:17:36'),
(4, 'FIRST', 1, '2015-01-25 02:17:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User`
--

CREATE TABLE `User` (
  `use_id` int(5) NOT NULL AUTO_INCREMENT,
  `use_name` varchar(50) NOT NULL,
  `use_lastname` varchar(50) NOT NULL,
  `use_email` varchar(50) NOT NULL,
  `use_telephone` varchar(20) NOT NULL,
  `use_user` varchar(20) NOT NULL,
  `use_password` varchar(20) NOT NULL,
  `use_usertype` int(2) NOT NULL,
  `prc_id` int(2) NOT NULL,
  `use_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`use_id`),
  KEY `prc_id` (`prc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `User`
--

INSERT INTO `User` (`use_id`, `use_name`, `use_lastname`, `use_email`, `use_telephone`, `use_user`, `use_password`, `use_usertype`, `prc_id`, `use_timestamp`) VALUES
(1, 'Agustin', 'Lopez', 'agulo@hotmail.com', '4514123', 'nmalva3', '14411441', 2, 1, '2015-02-01 06:04:17'),
(3, 'Astor', 'Piazola', 'alopez@jiji.com', '3411235123', 'nmalva2', '14411441', 2, 3, '2015-02-01 06:16:10'),
(4, 'Nicolas', 'Malvasio', 'nmalva@hotmail.com', '234234234', 'nmalva1', '14411441', 1, 4, '2015-02-19 00:20:04');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
