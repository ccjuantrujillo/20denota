-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2015 a las 04:42:37
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `20denota`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE IF NOT EXISTS `actividad` (
  `ACTP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `ORDENP_Codigo` int(11) NOT NULL,
  `ACTC_Accion` varchar(250) NOT NULL,
  `ACTC_Modulo` varchar(250) NOT NULL,
  `ACTC_Session` varchar(250) NOT NULL,
  `ACTC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ACTP_Codigo`),
  KEY `FK_actividad_orden` (`ORDENP_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `CLIP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) NOT NULL,
  `PERSP_Codigo` int(11) NOT NULL,
  `CLIC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CLIC_FechaModificacion` datetime DEFAULT NULL,
  `CLIC_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`CLIP_Codigo`),
  KEY `FK_cliente_compania` (`COMPP_Codigo`),
  KEY `FK_cliente_persona` (`PERSP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`CLIP_Codigo`, `COMPP_Codigo`, `PERSP_Codigo`, `CLIC_FechaRegistro`, `CLIC_FechaModificacion`, `CLIC_FlagEstado`) VALUES
(2, 1, 63, '2014-10-20 22:37:06', '2015-05-12 03:38:51', '1'),
(5, 1, 71, '2014-10-21 01:23:28', '2015-05-09 03:26:31', '1'),
(7, 1, 73, '2014-10-27 22:14:52', '2015-05-09 03:26:38', '1'),
(9, 1, 80, '2014-10-30 03:51:36', '2015-05-09 03:44:40', '1'),
(10, 1, 81, '2014-10-30 03:52:41', '2015-05-09 03:44:31', '1'),
(11, 1, 82, '2014-12-19 12:36:19', '2014-12-22 16:07:14', '1'),
(16, 1, 87, '2014-12-22 21:03:11', '2014-12-22 16:03:11', '1'),
(17, 1, 92, '2015-05-09 08:38:59', '2015-05-09 03:38:59', '1'),
(18, 1, 95, '2015-05-16 19:24:48', '2015-05-16 21:24:48', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE IF NOT EXISTS `aula` (
  `AULAP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `LOCP_Codigo` int(11) NOT NULL,
  `COMPP_Codigo` int(11) NOT NULL DEFAULT '0',
  `AULAC_Nombre` varchar(100) DEFAULT NULL,
  `AULAC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AULAP_Codigo`),
  KEY `FK_aula_local` (`LOCP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`AULAP_Codigo`, `LOCP_Codigo`, `COMPP_Codigo`, `AULAC_Nombre`, `AULAC_FechaRegistro`) VALUES
(1, 1, 1, 'D101', '2015-05-16 08:46:19'),
(2, 1, 1, 'D102', '2015-05-16 08:46:34'),
(3, 1, 1, 'D103', '2015-05-16 08:46:47'),
(4, 1, 1, 'D104', '2015-05-16 08:46:56'),
(5, 1, 1, 'D201', '2015-05-16 08:47:06'),
(6, 1, 1, 'D202', '2015-05-16 08:47:16'),
(7, 1, 1, 'D203', '2015-05-16 08:47:25'),
(8, 1, 1, 'D204', '2015-05-16 08:47:34'),
(9, 1, 1, 'D205', '2015-05-16 08:47:42'),
(10, 1, 1, 'D206', '2015-05-16 08:47:50'),
(11, 2, 1, 'A101', '2015-05-16 08:48:06'),
(12, 2, 1, 'A102', '2015-05-16 08:48:17'),
(13, 2, 1, 'A103', '2015-05-16 08:48:30'),
(14, 2, 1, 'B101', '2015-05-16 08:48:42'),
(15, 2, 1, 'B102', '2015-05-16 08:48:50'),
(16, 2, 1, 'B103', '2015-05-16 08:48:59'),
(17, 2, 1, 'C101', '2015-05-16 08:49:08'),
(18, 2, 1, 'C102', '2015-05-16 08:49:16'),
(19, 2, 1, 'C103', '2015-05-16 08:49:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo`
--

CREATE TABLE IF NOT EXISTS `ciclo` (
  `COMPP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPC_Nombre` varchar(250) NOT NULL,
  `CICC_FECHA_INICIO` datetime NOT NULL,
  `CICC_FECHA_FIN` datetime NOT NULL,
  `CICC_DESCRIPCION` varchar(255) NOT NULL,
  `COMPC_Tipo` int(11) NOT NULL,
  `COMPC_FlagEstado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`COMPP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ciclo`
--

INSERT INTO `ciclo` (`COMPP_Codigo`, `COMPC_Nombre`, `CICC_FECHA_INICIO`, `CICC_FECHA_FIN`, `CICC_DESCRIPCION`, `COMPC_Tipo`, `COMPC_FlagEstado`) VALUES
(1, 'Admision 2015-2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 1),
(2, 'Admision 2016-1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `PROD_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) NOT NULL,
  `TIPPROD_Codigo` int(11) NOT NULL,
  `PROD_Nombre` varchar(100) DEFAULT NULL,
  `PROD_DescripcionBreve` varchar(200) DEFAULT NULL,
  `PROD_EspecificacionPDF` varchar(100) DEFAULT NULL,
  `PROD_Comentario` text,
  `PROD_Cantidad` double DEFAULT NULL,
  `PROD_Intentos` double DEFAULT NULL,
  `PROD_Tiempo` double DEFAULT NULL,
  `PROD_TiempoExamen` double NOT NULL DEFAULT '30',
  `PROD_Puntaje` double DEFAULT '14',
  `PROD_Imagen` varchar(150) DEFAULT NULL,
  `PROD_Silabus` varchar(150) DEFAULT NULL,
  `PROD_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PROD_FechaModificacion` datetime DEFAULT NULL,
  `PROD_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`PROD_Codigo`),
  KEY `FK_cji_producto_cji_tipoproducto` (`TIPPROD_Codigo`),
  KEY `FK_producto_compania` (`COMPP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`PROD_Codigo`, `COMPP_Codigo`, `TIPPROD_Codigo`, `PROD_Nombre`, `PROD_DescripcionBreve`, `PROD_EspecificacionPDF`, `PROD_Comentario`, `PROD_Cantidad`, `PROD_Intentos`, `PROD_Tiempo`, `PROD_TiempoExamen`, `PROD_Puntaje`, `PROD_Imagen`, `PROD_Silabus`, `PROD_FechaRegistro`, `PROD_FechaModificacion`, `PROD_FlagEstado`) VALUES
(5, 1, 1, 'TRIGONOMETRIA', 'SED UT PERSPICIATIS UNDE OMNIS ISTE NATUS ERROR SIT VOLUPTATEM ACCUSANTIUM DOLOREMQUE LAUDANTIUM, TOTAM REM APERIAM. ', '', '', 88, 3, 2, 5, 14, 'erp.png', 'capitulo06.pdf', '2011-01-18 02:19:55', '2015-03-04 23:04:14', '1'),
(92, 1, 1, 'FISICA', 'EDWARD', '', '', 3, 5, 5, 30, 14, NULL, NULL, '2015-03-25 14:01:11', '2015-05-09 03:55:51', '1'),
(93, 1, 1, 'GEOMETRIA', 'EDWARD', '', '', 4, 5, 5, 30, 14, NULL, NULL, '2015-03-25 14:02:31', '2015-05-09 03:55:42', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `EMPRP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) NOT NULL,
  `EMPRC_Ruc` varchar(11) DEFAULT NULL,
  `EMPRC_RazonSocial` varchar(150) DEFAULT NULL,
  `EMPRC_Telefono` varchar(50) DEFAULT NULL,
  `EMPRC_Movil` varchar(50) DEFAULT NULL,
  `EMPRC_Fax` varchar(50) DEFAULT NULL,
  `EMPRC_Web` varchar(250) DEFAULT NULL,
  `EMPRC_Email` varchar(250) DEFAULT NULL,
  `EMPRC_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `EMPRC_FechaModificacion` datetime DEFAULT NULL,
  `EMPRC_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`EMPRP_Codigo`),
  KEY `FK_empresa_compania` (`COMPP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`EMPRP_Codigo`, `COMPP_Codigo`, `EMPRC_Ruc`, `EMPRC_RazonSocial`, `EMPRC_Telefono`, `EMPRC_Movil`, `EMPRC_Fax`, `EMPRC_Web`, `EMPRC_Email`, `EMPRC_FechaRegistro`, `EMPRC_FechaModificacion`, `EMPRC_FlagEstado`) VALUES
(0, 1, NULL, 'EMPRESA NO REGISTRADA', NULL, NULL, NULL, NULL, NULL, '2010-12-16 23:34:32', NULL, '1'),
(1, 1, '11111111111', 'W', '', '', '', '', '', '2011-01-09 10:30:35', NULL, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `local`
--

CREATE TABLE IF NOT EXISTS `local` (
  `LOCP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `LOCC_Nombre` varchar(150) NOT NULL,
  `LOCC_Direccion` varchar(250) NOT NULL,
  `LOCC_Telefono` varchar(250) NOT NULL,
  `LOCC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`LOCP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `local`
--

INSERT INTO `local` (`LOCP_Codigo`, `LOCC_Nombre`, `LOCC_Direccion`, `LOCC_Telefono`, `LOCC_FechaRegistro`) VALUES
(1, 'Sede Sucre', '', '', '2015-05-16 08:44:58'),
(2, 'Sede Javier Prado', '', '', '2015-05-16 08:45:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE IF NOT EXISTS `matricula` (
  `ORDENP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) DEFAULT NULL,
  `CLIP_Codigo` int(11) NOT NULL,
  `AULAP_Codigo` int(11) NOT NULL,
  `TIPP_Codigo` int(11) NOT NULL,
  `ORDENC_Observacion` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `ORDENC_Fecot` date DEFAULT NULL,
  `ORDENC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ORDENC_FechaModificacion` datetime DEFAULT NULL,
  `ORDENC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ORDENP_Codigo`),
  KEY `FK_orden_compania` (`COMPP_Codigo`),
  KEY `FK_orden_cliente` (`CLIP_Codigo`),
  KEY `FK_orden_aula` (`AULAP_Codigo`),
  KEY `FK_matricula_tipoestudio` (`TIPP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`ORDENP_Codigo`, `COMPP_Codigo`, `CLIP_Codigo`, `AULAP_Codigo`, `TIPP_Codigo`, `ORDENC_Observacion`, `ORDENC_Fecot`, `ORDENC_FechaRegistro`, `ORDENC_FechaModificacion`, `ORDENC_FlagEstado`) VALUES
(1, 1, 11, 1, 1, '0', '2015-05-15', '2015-05-15 09:30:29', '2015-05-22 00:00:00', '2'),
(2, 1, 16, 5, 1, '0', '2015-05-22', '2015-05-23 03:34:48', '2015-05-22 00:00:00', '1'),
(3, 2, 10, 5, 5, NULL, '2015-05-22', '2015-05-23 03:58:06', '2015-05-22 00:00:00', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `MENU_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `MENU_Codigo_Padre` int(11) NOT NULL DEFAULT '0',
  `MENU_Descripcion` varchar(150) DEFAULT NULL,
  `MENU_Comentario` varchar(250) DEFAULT NULL,
  `MENU_Url` varchar(250) DEFAULT NULL,
  `MENU_Imagen` varchar(100) DEFAULT NULL,
  `MENU_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `MENU_FechaModificacion` datetime DEFAULT NULL,
  `MENU_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`MENU_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`MENU_Codigo`, `MENU_Codigo_Padre`, `MENU_Descripcion`, `MENU_Comentario`, `MENU_Url`, `MENU_Imagen`, `MENU_FechaRegistro`, `MENU_FechaModificacion`, `MENU_FlagEstado`) VALUES
(2, 3, 'Alumnos', 'Aquí se podrán subir las imágenes o aniamciones que serán contenidas en la marquesina', 'index.php/ventas/alumno/listar', 'alumno.jpg', '2015-03-14 08:47:26', NULL, '1'),
(3, 1, 'MANTENIMIENTOS', 'Aquí se podrán subir las imágenes tipo preview para el menú que contenga un enlace.', 'index.php/almacen/curso/listar', 'libros.jpg', '2015-03-25 13:26:10', NULL, '1'),
(4, 1, 'OPERACIONES', 'Aquí se subirán la imagen del catálogo de la campaña actual.', 'index.php/ventas/orden/listar', 'matri.jpg', '2015-02-27 17:36:27', NULL, '1'),
(22, 3, 'Cursos', NULL, 'index.php/almacen/curso/listar', '', '2015-03-25 13:27:17', NULL, '1'),
(48, 4, 'Matricula', NULL, 'index.php/ventas/matricula/listar', 'matri.jpg', '2015-05-17 05:10:45', NULL, '1'),
(49, 4, 'Carga horaria', NULL, 'index.php/ventas/asignacion/listar', NULL, '2015-05-17 05:10:56', NULL, '1'),
(52, 3, 'Documentos', NULL, 'index.php/inicio/principal', NULL, '2015-03-03 08:38:57', NULL, '1'),
(53, 3, 'Profesor', 'Tabla de Profesores', 'index.php/ventas/profesor/listar', NULL, '2015-03-14 09:18:04', NULL, '1'),
(55, 3, 'Ejemplo 1', 'Ejemplo 1', 'index.php/almacen/curso/listar', NULL, '2015-04-02 15:40:06', NULL, '1'),
(56, 1, 'Ejemplo 3', 'Ejemplo 3', 'index.php/almacen/curso/listar', NULL, '2015-04-02 15:58:24', NULL, '1'),
(57, 56, 'Ejemplo 5', 'Ejemplo 5', 'Ejemplo5', NULL, '2015-04-02 16:18:33', NULL, '1'),
(58, 3, 'Usuario', NULL, 'index.php/maestros/usuario/listar', NULL, '2015-05-29 23:52:35', NULL, '1'),
(59, 3, 'Aula', NULL, 'index.php/maestros/aula/listar', NULL, '2015-05-29 23:53:37', NULL, '1'),
(61, 3, 'Local', NULL, 'index.php/maestros/local/listar', NULL, '2015-05-29 23:55:08', NULL, '1'),
(62, 3, 'Ciclo', NULL, 'index.php/maestros/ciclo/listar', NULL, '2015-05-30 00:00:29', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
  `PERM_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) NOT NULL,
  `ROL_Codigo` int(11) NOT NULL,
  `MENU_Codigo` int(11) NOT NULL,
  `PERM_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`PERM_Codigo`),
  UNIQUE KEY `ROL_Codigo_MENU_Codigo` (`ROL_Codigo`,`MENU_Codigo`),
  KEY `FK_cji_permiso_cji_menu` (`MENU_Codigo`),
  KEY `COMPP_Codigo` (`COMPP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`PERM_Codigo`, `COMPP_Codigo`, `ROL_Codigo`, `MENU_Codigo`, `PERM_FlagEstado`) VALUES
(2, 1, 4, 2, '1'),
(4, 1, 4, 3, '1'),
(5, 1, 4, 4, '1'),
(29, 1, 4, 22, '1'),
(32, 1, 4, 48, '1'),
(33, 1, 4, 49, '1'),
(38, 1, 4, 52, '1'),
(39, 1, 4, 53, '1'),
(45, 1, 4, 57, '1'),
(46, 1, 4, 58, '1'),
(47, 1, 4, 59, '1'),
(48, 1, 4, 61, '1'),
(49, 1, 4, 62, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `PERSP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) NOT NULL,
  `PERSC_ApellidoPaterno` varchar(150) DEFAULT NULL,
  `PERSC_ApellidoMaterno` varchar(150) DEFAULT NULL,
  `PERSC_Nombre` varchar(150) DEFAULT NULL,
  `PERSC_NumeroDocIdentidad` char(8) DEFAULT NULL,
  `PERSC_Direccion` varchar(250) DEFAULT NULL,
  `PERSC_Telefono` varchar(20) DEFAULT NULL,
  `PERSC_Movil` varchar(20) DEFAULT NULL,
  `PERSC_Fax` varchar(20) DEFAULT NULL,
  `PERSC_Email` varchar(200) DEFAULT NULL,
  `PERSC_Domicilio` varchar(250) DEFAULT NULL,
  `PERSC_Web` varchar(250) DEFAULT NULL,
  `PERSC_Sexo` char(2) DEFAULT NULL,
  `PERSC_FechaNacimiento` date DEFAULT NULL,
  `PERSC_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `PERSC_FechaModificacion` datetime DEFAULT NULL,
  `PERSC_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`PERSP_Codigo`),
  KEY `FK_persona_compania` (`COMPP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`PERSP_Codigo`, `COMPP_Codigo`, `PERSC_ApellidoPaterno`, `PERSC_ApellidoMaterno`, `PERSC_Nombre`, `PERSC_NumeroDocIdentidad`, `PERSC_Direccion`, `PERSC_Telefono`, `PERSC_Movil`, `PERSC_Fax`, `PERSC_Email`, `PERSC_Domicilio`, `PERSC_Web`, `PERSC_Sexo`, `PERSC_FechaNacimiento`, `PERSC_FechaRegistro`, `PERSC_FechaModificacion`, `PERSC_FlagEstado`) VALUES
(1, 1, 'TRUJILLO', 'BUSTAMANTE', 'MARTIN', '23442342', 'SGSGSDFGSGSDG', '435345345', '345435', '5345435', 'ewtrewtertter', 'SGSGSDFGSGSDG', 'dgsgsgd', '', '1980-05-01', '2010-12-29 15:14:55', NULL, '1'),
(63, 1, 'GOMEZ  ', 'PEREZ ', 'EDUARDO EDUARDOGF', '45645667', '', '234423', '0', '0', 'eduardo@banich.com', '', '0', '0', '2015-05-03', '2011-08-13 05:31:38', NULL, '1'),
(71, 1, 'PEREZ', 'AGUILAR ', 'MARIA', '40091852', 'AV PERU', '456465', '0', '0', 'maria.aguilar@hotmail.com', 'AV PERU', '0', '0', '2014-02-05', '2014-10-21 01:23:27', NULL, '1'),
(73, 1, 'RODRIGUEZ', 'MEDRANO', 'ELISEO', '40003256', 'LOS GIRASOLES 4125', '234234/43223434', '0', '0', 'luis.arnaldo@hotmail.com', 'LOS GIRASOLES 4125', '0', '0', '2014-05-11', '2014-10-27 22:14:52', NULL, '1'),
(80, 1, 'CANAZAS 2', 'QUISPE', 'RUTHCIÃ±A', '40091814', 'MZ R LOTE 50 LOS NISPEROS', '34234242', '0', '0', 'martin@trujillo.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-12-01', '2014-10-30 03:51:36', NULL, '1'),
(81, 1, 'VARGAS', 'RUIZ', 'ELIZABETH', '21321321', 'MIMCO', 'sdfgdsfgdf', '0', '0', '', 'MIMCO', '0', '0', '0000-00-00', '2014-10-30 03:52:41', NULL, '1'),
(82, 1, 'PEREZ', 'GUZMAN', 'ROBERTO', '45645654', 'MZ P LOTE 15 LOS ALAMAMO', '2342342343', '0', '0', 'roberto.perez@hotmail.com', 'MZ P LOTE 15 LOS ALAMAMO', '0', '0', '1992-03-02', '2014-12-19 12:36:19', NULL, '1'),
(87, 1, 'PAREDES', 'GONZALES', 'ETHEL', '45645645', 'ASFASFF', '343243', '0', '0', 'ethel.gonzales@hotmail.com', 'ASFASFF', '0', '0', '1997-12-02', '2014-12-22 21:03:11', NULL, '1'),
(88, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'AV. ABANCAY 986 S.M.P.', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'AV. ABANCAY 986 S.M.P.', '0', '0', '1980-03-19', '2015-03-21 07:31:36', NULL, '1'),
(89, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'ABANCAY 986 SMP', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'ABANCAY 986 SMP', '0', '0', '2015-03-18', '2015-03-21 07:32:34', NULL, '1'),
(90, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'AV. ABANCAY 986 SMP', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'AV. ABANCAY 986 SMP', '0', '0', '2015-03-11', '2015-03-21 07:36:05', NULL, '1'),
(91, 1, 'FIGUERO', 'MALDONADO', 'EDWARD', '32424234', 'SAN MARTIN DE PORRES', '21231123', '0', '0', 'edward.figueroa@gmail.com', 'SAN MARTIN DE PORRES', '0', '0', '2015-05-26', '2015-04-04 11:07:35', NULL, '1'),
(92, 1, 'PEREZ DOVAL', 'SANDOVAL', 'DALEANA', '12341234', 'MZ R LOTE 50 LOS NISPEROS', '34324234', '0', '0', 'miriam@hotmail.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-04-22', '2015-05-09 08:38:59', NULL, '1'),
(93, 1, 'VASQUEZ', 'DOMINGUEZ', 'RIQUELMER', '32423423', 'LIMA', '234234', '0', '0', '', 'LIMA', '0', '0', '2015-05-20', '2015-05-16 08:23:35', NULL, '1'),
(94, 1, 'AREVALO', 'VILLANUEVA', 'MANUEL', '234234', '', '324234324', '0', '0', '', '', '0', '0', '0000-00-00', '2015-05-16 08:25:23', NULL, '1'),
(95, 1, 'PEREZ', 'PEREZ', 'GUSTAVO', '12341234', 'MZ R LOTE ', '342344', '0', '0', 'gusta.perez@gmail.com', 'MZ R LOTE ', '0', '0', '2015-05-12', '2015-05-16 19:24:48', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productoatributo2`
--

CREATE TABLE IF NOT EXISTS `productoatributo2` (
  `PRODATRIB2_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROD_Codigo` int(11) DEFAULT NULL,
  `COMPP_Codigo` int(11) DEFAULT NULL,
  `PRODATRIB2_Descripcion` varchar(150) DEFAULT NULL,
  `PRODATRIB2_FechaModificacion` datetime DEFAULT NULL,
  `PRODATRIB2_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PRODATRIB2_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productoprecio`
--

CREATE TABLE IF NOT EXISTS `productoprecio` (
  `PRODPREP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROD_Codigo` int(11) NOT NULL,
  `MONED_Codigo` int(11) NOT NULL,
  `PRODPREC_Precio` double NOT NULL,
  `PRODPREC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PRODPREC_FechaModificacion` datetime DEFAULT NULL,
  `PRODPREC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`PRODPREP_Codigo`),
  UNIQUE KEY `PROD_Codigo` (`PROD_Codigo`,`MONED_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE IF NOT EXISTS `profesor` (
  `PROP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) NOT NULL,
  `PROD_Codigo` int(11) NOT NULL,
  `PERSP_Codigo` int(11) NOT NULL,
  `ROL_Codigo` int(11) NOT NULL,
  `PROC_FechaModificacion` date NOT NULL,
  `PROC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PROC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`PROP_Codigo`),
  KEY `FK_profesor_persona` (`PERSP_Codigo`),
  KEY `FK_profesor_rol` (`ROL_Codigo`),
  KEY `FK_profesor_curso` (`PROD_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`PROP_Codigo`, `COMPP_Codigo`, `PROD_Codigo`, `PERSP_Codigo`, `ROL_Codigo`, `PROC_FechaModificacion`, `PROC_FechaRegistro`, `PROC_FlagEstado`) VALUES
(4, 0, 92, 90, 5, '2015-03-21', '2015-03-21 05:00:00', '1'),
(5, 1, 93, 91, 7, '2015-05-16', '2015-05-16 05:00:00', '1'),
(6, 1, 93, 93, 4, '2015-05-16', '2015-05-16 08:23:36', '1'),
(7, 1, 93, 94, 5, '2015-05-16', '2015-05-16 08:25:23', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntaje`
--

CREATE TABLE IF NOT EXISTS `puntaje` (
  `PUNTP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PRODATRIB_Codigo` int(11) NOT NULL,
  `ORDENP_Codigo` int(11) NOT NULL DEFAULT '0',
  `PUNTC_Puntaje` double NOT NULL DEFAULT '0',
  `PUNTC_FechaInicio` datetime DEFAULT NULL,
  `PUNTC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PUNTP_Codigo`),
  KEY `FK_puntaje_productoatributo` (`PRODATRIB_Codigo`),
  KEY `FK_puntaje_orden` (`ORDENP_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `ROL_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) NOT NULL,
  `ROL_Descripcion` varchar(150) DEFAULT NULL,
  `ROL_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ROL_FechaModificacion` datetime DEFAULT NULL,
  `ROL_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`ROL_Codigo`),
  KEY `FK_rol_compania` (`COMPP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ROL_Codigo`, `COMPP_Codigo`, `ROL_Descripcion`, `ROL_FechaRegistro`, `ROL_FechaModificacion`, `ROL_FlagEstado`) VALUES
(1, 1, 'Usuario', '2014-10-12 22:09:30', NULL, '1'),
(4, 1, 'Administrador', '2014-10-12 22:09:06', NULL, '1'),
(5, 1, 'Profesor', '2015-05-16 07:08:24', NULL, '1'),
(6, 1, 'Coordinador de plana', '2015-05-16 07:09:17', NULL, '1'),
(7, 1, 'Coordinador general', '2015-05-16 07:09:29', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semana`
--

CREATE TABLE IF NOT EXISTS `semana` (
  `PRODATRIB_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROD_Codigo` int(11) NOT NULL,
  `COMPP_Codigo` int(11) NOT NULL,
  `PRODATRIB_Nombre` varchar(250) DEFAULT NULL,
  `PRODATRIB_Descripcion` varchar(250) DEFAULT NULL,
  `PRODATRIB_Preguntas` int(11) NOT NULL,
  `PRODATRIB_Puntaje` double NOT NULL DEFAULT '0',
  `PRODATRIB_Vimeo` varchar(250) DEFAULT NULL,
  `PRODATRIB_NroIntentos` int(11) NOT NULL,
  `PRODATRIB_FechaModificacion` datetime DEFAULT NULL,
  `PRODATRIB_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PRODATRIB_Codigo`),
  KEY `FK_productoatributo_producto` (`PROD_Codigo`),
  KEY `FK_productoatributo_compania` (`COMPP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `semana`
--

INSERT INTO `semana` (`PRODATRIB_Codigo`, `PROD_Codigo`, `COMPP_Codigo`, `PRODATRIB_Nombre`, `PRODATRIB_Descripcion`, `PRODATRIB_Preguntas`, `PRODATRIB_Puntaje`, `PRODATRIB_Vimeo`, `PRODATRIB_NroIntentos`, `PRODATRIB_FechaModificacion`, `PRODATRIB_FechaRegistro`) VALUES
(16, 93, 1, 'SEMANA 01', 'ASDF', 5, 0, 'http://vimeo.com/92884359', 1, NULL, '2014-10-12 22:40:43'),
(17, 93, 1, 'SEMANA 02', '', 5, 0, '', 0, NULL, '2015-05-12 07:53:45'),
(18, 93, 1, 'SEMANA 03', '', 5, 0, '', 0, NULL, '2015-05-12 07:54:03'),
(19, 93, 1, 'SEMANA 05', '', 5, 0, '', 0, NULL, '2015-05-12 07:54:16'),
(20, 93, 1, 'SEMANA 04', '', 5, 0, '', 0, NULL, '2015-05-12 07:54:33'),
(21, 93, 1, 'SEMANA 06', '', 5, 0, '', 0, NULL, '2015-05-12 07:54:51'),
(22, 93, 1, 'SEMANA 07', '', 5, 0, '', 0, NULL, '2015-05-12 07:56:14'),
(23, 93, 1, 'SEMANA 08', '', 5, 0, '', 0, NULL, '2015-05-12 07:57:14'),
(24, 93, 1, 'SEMANA 09', '', 5, 0, '', 0, NULL, '2015-05-12 07:57:26'),
(25, 93, 1, 'SEMANA 10', '', 5, 0, '', 0, NULL, '2015-05-12 07:57:36'),
(26, 93, 1, 'SEMANA 11', '', 5, 0, '', 0, NULL, '2015-05-12 07:57:55'),
(27, 93, 1, 'SEMANA 12', '', 5, 0, '', 0, NULL, '2015-05-12 07:58:11'),
(28, 93, 1, 'SEMANA 13', '', 5, 0, '', 0, NULL, '2015-05-12 07:58:22'),
(29, 93, 1, 'SEMANA 14', '', 5, 0, '', 0, NULL, '2015-05-12 07:58:43'),
(30, 93, 1, 'SEMANA 15', '', 5, 0, '', 0, NULL, '2015-05-12 07:58:53'),
(31, 93, 1, 'SEMANA 16', '', 5, 0, '', 0, NULL, '2015-05-12 07:59:22'),
(32, 93, 1, 'SEMANA 17', '', 5, 0, '', 0, NULL, '2015-05-12 07:59:31'),
(33, 93, 1, 'SEMANA 18', '', 5, 0, '', 0, NULL, '2015-05-12 07:59:47'),
(34, 93, 1, 'SEMANA 19', '', 5, 0, '', 0, NULL, '2015-05-12 07:59:57'),
(35, 93, 1, 'SEMANA 20', '', 5, 0, '', 0, NULL, '2015-05-12 08:00:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE IF NOT EXISTS `tema` (
  `PRODATRIBDET_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PRODATRIB_Codigo` int(11) NOT NULL,
  `COMPP_Codigo` int(11) NOT NULL,
  `PRODATRIBDET_Numero` int(11) NOT NULL,
  `PRODATRIBDET_Descripcion` varchar(250) DEFAULT NULL,
  `PRODATRIBDET_Alternativa1` varchar(250) DEFAULT NULL,
  `PRODATRIBDET_Alternativa2` varchar(250) DEFAULT NULL,
  `PRODATRIBDET_Alternativa3` varchar(250) DEFAULT NULL,
  `PRODATRIBDET_Alternativa4` varchar(250) DEFAULT NULL,
  `PRODATRIBDET_Alternativa5` varchar(250) DEFAULT NULL,
  `PRODATRIBDET_FlagCorrecta` int(11) NOT NULL DEFAULT '0',
  `PRODATRIBDET_FechaModificacion` datetime DEFAULT NULL,
  `PRODATRIBDET_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PRODATRIBDET_Codigo`),
  KEY `FK_productoatributodetalle_productoatributo` (`PRODATRIB_Codigo`),
  KEY `FK_productoatributodetalle_compania` (`COMPP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`PRODATRIBDET_Codigo`, `PRODATRIB_Codigo`, `COMPP_Codigo`, `PRODATRIBDET_Numero`, `PRODATRIBDET_Descripcion`, `PRODATRIBDET_Alternativa1`, `PRODATRIBDET_Alternativa2`, `PRODATRIBDET_Alternativa3`, `PRODATRIBDET_Alternativa4`, `PRODATRIBDET_Alternativa5`, `PRODATRIBDET_FlagCorrecta`, `PRODATRIBDET_FechaModificacion`, `PRODATRIBDET_FechaRegistro`) VALUES
(36, 16, 1, 2, 'NOCIONES BASICAS', '', '', '', '', '', 0, NULL, '2015-03-05 04:08:41'),
(38, 16, 1, 2, 'TRIANGULOS', '', '', '', '', '', 0, NULL, '2015-03-05 04:09:25'),
(39, 17, 1, 1, 'CONGRUENCIA DE TRIANGULOS', 'ED', 'ED', 'ED', 'ED', 'ED', 1, NULL, '2015-04-04 09:01:07'),
(40, 17, 1, 1, 'APLICACIONES DE LA CONGRUENCIA', '', '', '', '', '', 0, NULL, '2015-05-12 08:42:50'),
(41, 18, 1, 1, 'TRIANGULOS RECTANGULOS NOTABLES', '', '', '', '', '', 0, NULL, '2015-05-12 08:43:33'),
(42, 18, 1, 2, 'CUADRILATEROS', '', '', '', '', '', 0, NULL, '2015-05-12 08:43:57'),
(43, 20, 1, 1, 'CIRCUNFERENCIA', '', '', '', '', '', 0, NULL, '2015-05-12 08:44:41'),
(44, 20, 1, 2, 'CUADRILATERO CIRSCUNSCRITO Y CIRCUNSCRIPTE', '', '', '', '', '', 0, NULL, '2015-05-12 08:45:28'),
(45, 19, 1, 1, 'ANGULOS EN LA CIRCUNFERENCIA', '', '', '', '', '', 0, NULL, '2015-05-12 08:46:00'),
(46, 19, 1, 2, 'PROPORCIONALIDAD', '', '', '', '', '', 0, NULL, '2015-05-12 08:46:18'),
(47, 21, 1, 1, 'SEMEJANZA DE TRIANGULOS', '', '', '', '', '', 0, NULL, '2015-05-12 08:46:42'),
(48, 21, 1, 2, 'RECTA Y CIRCUNFERENCIA DE EULER', '', '', '', '', '', 0, NULL, '2015-05-12 08:47:12'),
(49, 22, 1, 1, 'RELACIONES METRICAS EN EL TRIANGULO RECTANGULO', 'l', '', '', '', '', 0, NULL, '2015-05-12 08:48:21'),
(50, 22, 1, 2, 'RELACIONES METRICAS EN EL TRIANGULO OBLICUANGULO', '', '', '', '', '', 0, NULL, '2015-05-12 08:49:41'),
(51, 23, 1, 1, 'TEOREMA DE LAS CUERDAS', '', '', '', '', '', 0, NULL, '2015-05-12 08:50:07'),
(52, 23, 1, 2, 'TEOREMA DEL TRIANGULO INSCRITO', '', '', '', '', '', 0, NULL, '2015-05-12 08:50:45'),
(53, 24, 1, 1, 'POLIGONOS REGULARES', '', '', '', '', '', 0, NULL, '2015-05-12 08:51:06'),
(54, 24, 1, 2, 'POLIGONOS REGULARES NOTABLES INSCRITOS', '', '', '', '', '', 0, NULL, '2015-05-12 08:51:24'),
(55, 25, 1, 1, 'SIMETRIA EN EL PLANO', '', '', '', '', '', 0, NULL, '2015-05-12 08:52:25'),
(56, 25, 1, 2, 'LONGITUD DE LA CIRCUNFERENCIA', '', '', '', '', '', 0, NULL, '2015-05-12 08:52:53'),
(57, 26, 1, 1, 'AREAS DE REGIONES POLIGONALES', '', '', '', '', '', 0, NULL, '2015-05-12 08:53:24'),
(58, 26, 1, 2, 'RELACION DE AREAS DE REGIONES TRIANGULARES', '', '', '', '', '', 0, NULL, '2015-05-12 08:53:55'),
(59, 27, 1, 1, 'AREA DE REGIONES CUADRANGULARES', '', '', '', '', '', 0, NULL, '2015-05-12 08:54:24'),
(60, 27, 1, 2, 'AREAS DE REGIONES CIRCULARES', '', '', '', '', '', 0, NULL, '2015-05-12 08:54:47'),
(61, 28, 1, 1, 'ELEMENTOS DE GEOMETRIA EN EL ESPACIO', '', '', '', '', '', 0, NULL, '2015-05-12 08:55:26'),
(62, 28, 1, 2, 'RECTA PERPENDICULAR A UN PLANO', '', '', '', '', '', 0, NULL, '2015-05-12 08:56:19'),
(63, 29, 1, 1, 'ANGULO DIEDRO', '', '', '', '', '', 0, NULL, '2015-05-12 08:56:39'),
(64, 29, 1, 2, 'ANGULO TRIEDRO', '', '', '', '', '', 0, NULL, '2015-05-12 08:56:54'),
(65, 30, 1, 1, 'POLIEDROS', '', '', '', '', '', 0, NULL, '2015-05-12 08:57:11'),
(66, 30, 1, 2, 'POLIEDROS REGULARES', '', '', '', '', '', 0, NULL, '2015-05-12 08:57:33'),
(67, 31, 1, 1, 'SIMETRIA EN EL ESPACIO', '', '', '', '', '', 0, NULL, '2015-05-12 08:58:02'),
(68, 31, 1, 2, 'SUPERFICIE PRISMATICA: PRISMA', '', '', '', '', '', 0, NULL, '2015-05-12 08:58:33'),
(69, 32, 1, 1, 'DESARROLLOP DE LA SUPERFICIE LATERAL Y TOTAL DE UN PRISMA RECTO', '', '', '', '', '', 0, NULL, '2015-05-12 08:59:23'),
(70, 32, 1, 2, 'SUPERFICIE PIRAMIDAL: PIRAMIDE', '', '', '', '', '', 0, NULL, '2015-05-12 08:59:47'),
(71, 33, 1, 1, 'TRONCO DE PIRAMIDE', '', '', '', '', '', 0, NULL, '2015-05-12 09:00:03'),
(72, 33, 1, 2, 'CILINDRO', '', '', '', '', '', 0, NULL, '2015-05-12 09:00:27'),
(73, 34, 1, 1, 'CONO', '', '', '', '', '', 0, NULL, '2015-05-12 09:00:43'),
(74, 34, 1, 2, 'SUPERFICIE ESFERICA', '', '', '', '', '', 0, NULL, '2015-05-12 09:01:01'),
(75, 35, 1, 1, 'ESFERA', '', '', '', '', '', 0, NULL, '2015-05-12 09:01:18'),
(76, 35, 1, 2, 'TEOREMA DE PAPPUS-GUIDING', '', '', '', '', '', 0, NULL, '2015-05-12 09:01:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoestudio`
--

CREATE TABLE IF NOT EXISTS `tipoestudio` (
  `TIPP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) NOT NULL DEFAULT '1',
  `TIPC_Nombre` varchar(100) DEFAULT NULL,
  `TIPC_Descripcion` varchar(100) DEFAULT NULL,
  `TIPC_FechaRegistro` datetime NOT NULL,
  `TIPC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`TIPP_Codigo`),
  KEY `FK_tipoestudio_compania` (`COMPP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `tipoestudio`
--

INSERT INTO `tipoestudio` (`TIPP_Codigo`, `COMPP_Codigo`, `TIPC_Nombre`, `TIPC_Descripcion`, `TIPC_FechaRegistro`, `TIPC_FlagEstado`) VALUES
(1, 1, 'Pre', NULL, '2015-05-15 04:18:57', '1'),
(2, 1, 'Basico', NULL, '2015-05-15 04:19:14', '1'),
(3, 2, 'Pre', NULL, '2015-05-15 04:19:44', '1'),
(4, 2, 'Repaso', NULL, '2015-05-15 04:19:49', '1'),
(5, 2, 'Basico', NULL, '2015-05-15 04:20:23', '1'),
(6, 2, 'Intensivo', NULL, '2015-05-15 04:20:28', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproducto`
--

CREATE TABLE IF NOT EXISTS `tipoproducto` (
  `TIPPROD_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) DEFAULT NULL,
  `TIPPROD_Descripcion` varchar(250) DEFAULT NULL,
  `TIPPROD_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TIPPROD_FechaModificacion` datetime DEFAULT NULL,
  `TIPPROD_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`TIPPROD_Codigo`),
  KEY `FK_tipoproducto_compania` (`COMPP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipoproducto`
--

INSERT INTO `tipoproducto` (`TIPPROD_Codigo`, `COMPP_Codigo`, `TIPPROD_Descripcion`, `TIPPROD_FechaRegistro`, `TIPPROD_FechaModificacion`, `TIPPROD_FlagEstado`) VALUES
(0, 1, ':::SELECCIONE::', '2014-10-06 15:37:32', NULL, '1'),
(1, 1, 'MATEMATICAS', '2011-01-03 23:30:46', NULL, '1'),
(2, 1, 'IDIOMAS', '2011-01-03 23:30:55', NULL, '1'),
(3, 1, 'NEGOCIOS', '2011-01-03 23:31:09', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `USUA_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) NOT NULL,
  `PERSP_Codigo` int(11) NOT NULL,
  `ROL_Codigo` int(11) NOT NULL,
  `USUA_usuario` varchar(20) DEFAULT NULL,
  `USUA_Password` varchar(50) DEFAULT NULL,
  `USUA_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `USUA_FechaModificacion` datetime DEFAULT NULL,
  `USUA_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`USUA_Codigo`),
  KEY `FK_usuario_compania` (`COMPP_Codigo`),
  KEY `FK_usuario_persona` (`PERSP_Codigo`),
  KEY `FK_usuario_rol` (`ROL_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`USUA_Codigo`, `COMPP_Codigo`, `PERSP_Codigo`, `ROL_Codigo`, `USUA_usuario`, `USUA_Password`, `USUA_FechaRegistro`, `USUA_FechaModificacion`, `USUA_FlagEstado`) VALUES
(7, 1, 1, 4, 'demo', 'e10adc3949ba59abbe56e057f20f883e', '2014-09-24 16:23:07', NULL, '1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `FK_actividad_orden` FOREIGN KEY (`ORDENP_Codigo`) REFERENCES `matricula` (`ORDENP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `FK_cliente_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `ciclo` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_cliente_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `aula`
--
ALTER TABLE `aula`
  ADD CONSTRAINT `FK_aula_local` FOREIGN KEY (`LOCP_Codigo`) REFERENCES `local` (`LOCP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `FK_cji_producto_cji_tipoproducto` FOREIGN KEY (`TIPPROD_Codigo`) REFERENCES `tipoproducto` (`TIPPROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_producto_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `ciclo` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `FK_empresa_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `ciclo` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `FK_matricula_tipoestudio` FOREIGN KEY (`TIPP_Codigo`) REFERENCES `tipoestudio` (`TIPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_orden_aula` FOREIGN KEY (`AULAP_Codigo`) REFERENCES `aula` (`AULAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_orden_cliente` FOREIGN KEY (`CLIP_Codigo`) REFERENCES `alumno` (`CLIP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `FK_cji_permiso_cji_menu` FOREIGN KEY (`MENU_Codigo`) REFERENCES `menu` (`MENU_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_cji_permiso_cji_rol` FOREIGN KEY (`ROL_Codigo`) REFERENCES `rol` (`ROL_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `permiso_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `ciclo` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `FK_persona_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `ciclo` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `FK_profesor_curso` FOREIGN KEY (`PROD_Codigo`) REFERENCES `curso` (`PROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_profesor_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_profesor_rol` FOREIGN KEY (`ROL_Codigo`) REFERENCES `rol` (`ROL_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `puntaje`
--
ALTER TABLE `puntaje`
  ADD CONSTRAINT `FK_puntaje_orden` FOREIGN KEY (`ORDENP_Codigo`) REFERENCES `matricula` (`ORDENP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_puntaje_productoatributo` FOREIGN KEY (`PRODATRIB_Codigo`) REFERENCES `semana` (`PRODATRIB_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rol`
--
ALTER TABLE `rol`
  ADD CONSTRAINT `FK_rol_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `ciclo` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `semana`
--
ALTER TABLE `semana`
  ADD CONSTRAINT `FK_productoatributo_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `ciclo` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_productoatributo_producto` FOREIGN KEY (`PROD_Codigo`) REFERENCES `curso` (`PROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `FK_productoatributodetalle_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `ciclo` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_productoatributodetalle_productoatributo` FOREIGN KEY (`PRODATRIB_Codigo`) REFERENCES `semana` (`PRODATRIB_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tipoestudio`
--
ALTER TABLE `tipoestudio`
  ADD CONSTRAINT `FK_tipoestudio_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `ciclo` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  ADD CONSTRAINT `FK_tipoproducto_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `ciclo` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_usuario_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `ciclo` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_usuario_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`ROL_Codigo`) REFERENCES `rol` (`ROL_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
