-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2015 a las 02:49:39
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`CLIP_Codigo`, `COMPP_Codigo`, `PERSP_Codigo`, `CLIC_FechaRegistro`, `CLIC_FechaModificacion`, `CLIC_FlagEstado`) VALUES
(2, 1, 63, '2014-10-20 15:37:06', '2014-10-29 22:51:12', '2'),
(5, 1, 71, '2014-10-20 18:23:28', '2014-10-29 21:38:32', '2'),
(7, 1, 73, '2014-10-27 16:14:52', '2014-10-29 22:41:49', '1'),
(9, 1, 80, '2014-10-29 21:51:36', '2014-12-22 14:24:01', '1'),
(10, 1, 81, '2014-10-29 21:52:41', '2014-10-29 22:52:41', '2'),
(11, 1, 82, '2014-12-19 06:36:19', '2014-12-22 16:07:14', '1'),
(15, 1, 86, '2014-12-19 06:37:47', '2014-12-19 07:37:47', '1'),
(16, 1, 87, '2014-12-22 15:03:11', '2014-12-22 16:03:11', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compania`
--

CREATE TABLE IF NOT EXISTS `compania` (
  `COMPP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `EMPRP_Codigo` int(11) NOT NULL,
  `COMPC_Logo` varchar(250) NOT NULL,
  `COMPC_TipoValorizacion` char(1) NOT NULL DEFAULT '0' COMMENT '0:FIFO, 1:LIFO',
  `COMPC_FlagEstado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`COMPP_Codigo`),
  KEY `FK_cji_compania_cji_empresa` (`EMPRP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `compania`
--

INSERT INTO `compania` (`COMPP_Codigo`, `EMPRP_Codigo`, `COMPC_Logo`, `COMPC_TipoValorizacion`, `COMPC_FlagEstado`) VALUES
(1, 1, 'Mi loguito', '0', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`PROD_Codigo`, `COMPP_Codigo`, `TIPPROD_Codigo`, `PROD_Nombre`, `PROD_DescripcionBreve`, `PROD_EspecificacionPDF`, `PROD_Comentario`, `PROD_Cantidad`, `PROD_Intentos`, `PROD_Tiempo`, `PROD_TiempoExamen`, `PROD_Puntaje`, `PROD_Imagen`, `PROD_Silabus`, `PROD_FechaRegistro`, `PROD_FechaModificacion`, `PROD_FlagEstado`) VALUES
(5, 1, 1, 'TRIGONOMETRIA', 'SED UT PERSPICIATIS UNDE OMNIS ISTE NATUS ERROR SIT VOLUPTATEM ACCUSANTIUM DOLOREMQUE LAUDANTIUM, TOTAM REM APERIAM. ', '', '', 88, 3, 2, 5, 14, 'erp.png', 'capitulo06.pdf', '2011-01-17 20:19:55', '2015-03-04 23:04:14', '1'),
(89, 1, 1, 'ALGEBRA', 'EDWARD', '', '', 3, 5, 5, 30, 14, NULL, NULL, '2015-03-25 07:50:36', NULL, '1'),
(90, 1, 0, '', '', '', '', 0, 5, 5, 30, 14, NULL, NULL, '2015-03-25 07:56:52', NULL, '1'),
(91, 1, 0, '', '', '', '', 0, 5, 5, 30, 14, NULL, NULL, '2015-03-25 08:00:33', NULL, '1'),
(92, 1, 1, 'EDWARD', 'EDWARD', '', '', 3, 5, 5, 30, 14, NULL, NULL, '2015-03-25 08:01:11', NULL, '1'),
(93, 1, 0, 'EDWARD', 'EDWARD', '', '', 4, 5, 5, 30, 14, NULL, NULL, '2015-03-25 08:02:31', NULL, '1'),
(94, 1, 1, 'ALEXANDER', 'ALEXANDER', '', '', 12, 5, 5, 30, 14, NULL, NULL, '2015-03-25 08:05:26', NULL, '1'),
(95, 1, 0, 'EDWA', '12', '', '', 12, 5, 5, 30, 14, NULL, NULL, '2015-03-25 08:21:16', '2015-04-11 06:49:01', '2'),
(96, 1, 0, 'BETSY', 'BETSY', '', '', 12, 5, 5, 30, 14, NULL, NULL, '2015-03-25 08:23:12', '2015-04-04 04:01:49', '1');

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
(0, 1, NULL, 'EMPRESA NO REGISTRADA', NULL, NULL, NULL, NULL, NULL, '2010-12-16 17:34:32', NULL, '1'),
(1, 1, '11111111111', 'W', '', '', '', '', '', '2011-01-09 04:30:35', NULL, '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`MENU_Codigo`, `MENU_Codigo_Padre`, `MENU_Descripcion`, `MENU_Comentario`, `MENU_Url`, `MENU_Imagen`, `MENU_FechaRegistro`, `MENU_FechaModificacion`, `MENU_FlagEstado`) VALUES
(2, 3, 'Alumnos', 'Aquí se podrán subir las imágenes o aniamciones que serán contenidas en la marquesina', 'index.php/ventas/alumno/listar', 'alumno.jpg', '2015-03-14 02:47:26', NULL, '1'),
(3, 1, 'MANTENIMIENTOS', 'Aquí se podrán subir las imágenes tipo preview para el menú que contenga un enlace.', 'index.php/almacen/curso/listar', 'libros.jpg', '2015-03-25 07:26:10', NULL, '1'),
(4, 1, 'OPERACIONES', 'Aquí se subirán la imagen del catálogo de la campaña actual.', 'index.php/ventas/orden/listar', 'matri.jpg', '2015-02-27 11:36:27', NULL, '1'),
(22, 3, 'Cursos', NULL, 'index.php/almacen/curso/listar', '', '2015-03-25 07:27:17', NULL, '1'),
(48, 4, 'Matricula', NULL, 'index.php/ventas/orden/listar', 'matri.jpg', '2015-02-27 11:36:18', NULL, '1'),
(49, 4, 'Pagos', NULL, NULL, NULL, '2015-03-03 01:42:48', NULL, '1'),
(52, 3, 'Documentos', NULL, 'index.php/inicio/principal', NULL, '2015-03-03 02:38:57', NULL, '1'),
(53, 3, 'Profesor', 'Tabla de Profesores', 'index.php/ventas/profesor/listar', NULL, '2015-03-14 03:18:04', NULL, '1'),
(55, 3, 'Ejemplo 1', 'Ejemplo 1', 'index.php/almacen/curso/listar', NULL, '2015-04-02 08:40:06', NULL, '1'),
(56, 1, 'Ejemplo 3', 'Ejemplo 3', 'index.php/almacen/curso/listar', NULL, '2015-04-02 08:58:24', NULL, '1'),
(57, 56, 'Ejemplo 5', 'Ejemplo 5', 'Ejemplo5', NULL, '2015-04-02 09:18:33', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE IF NOT EXISTS `orden` (
  `ORDENP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) DEFAULT NULL,
  `CLIP_Codigo` int(11) NOT NULL,
  `PROD_Codigo` int(11) NOT NULL,
  `ORDENC_Numero` int(11) DEFAULT NULL,
  `ORDENC_Tiempo` int(11) DEFAULT NULL,
  `ORDENC_Observacion` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `ORDENC_Usuario` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `ORDENC_Password` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `ORDENC_Fecot` date DEFAULT NULL,
  `ORDENC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ORDENC_FechaModificacion` datetime DEFAULT NULL,
  `ORDENC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ORDENP_Codigo`),
  KEY `FK_orden_compania` (`COMPP_Codigo`),
  KEY `FK_orden_cliente` (`CLIP_Codigo`),
  KEY `FK_orden_producto` (`PROD_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

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
(41, 1, 4, 55, '1'),
(44, 1, 4, 56, '1'),
(45, 1, 4, 57, '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`PERSP_Codigo`, `COMPP_Codigo`, `PERSC_ApellidoPaterno`, `PERSC_ApellidoMaterno`, `PERSC_Nombre`, `PERSC_NumeroDocIdentidad`, `PERSC_Direccion`, `PERSC_Telefono`, `PERSC_Movil`, `PERSC_Fax`, `PERSC_Email`, `PERSC_Domicilio`, `PERSC_Web`, `PERSC_Sexo`, `PERSC_FechaNacimiento`, `PERSC_FechaRegistro`, `PERSC_FechaModificacion`, `PERSC_FlagEstado`) VALUES
(1, 1, 'TRUJILLO', 'BUSTAMANTE', 'MARTIN', '23442342', 'SGSGSDFGSGSDG', '435345345', '345435', '5345435', 'ewtrewtertter', 'SGSGSDFGSGSDG', 'dgsgsgd', '', '1980-05-01', '2010-12-29 09:14:55', NULL, '1'),
(63, 1, 'GOMEZ  ', 'PEREZ ', 'EDUARDO EDUARDOGF', '45645664', '', '234423', '0', '0', 'eduardo@banich.com', '', '0', '0', '0000-00-00', '2011-08-12 22:31:38', NULL, '1'),
(71, 1, 'PEREZ', 'AGUILAR ', 'MARIA', '40091852', 'av peru', '456465', '0', '0', 'maria.aguilar@hotmail.com', '', '0', '0', '2014-02-05', '2014-10-20 18:23:27', NULL, '1'),
(73, 1, 'RODRIGUEZ', 'MEDRANO', 'ELISEO', '40003256', 'los girasoles 4125', '234234/43223434', '0', '0', 'luis.arnaldo@hotmail.com', '', '0', '0', '2014-05-11', '2014-10-27 16:14:52', NULL, '1'),
(80, 1, 'CANAZAS', 'QUISPE', 'RUTHCIÃ±A', '40091814', 'MZ R LOTE 50 LOS NISPEROS', '34234242', '0', '0', 'martin@trujillo.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-12-29', '2014-10-29 21:51:36', NULL, '1'),
(81, 1, 'VARGAS', 'RUIZ', 'ELIZABETH', '21321321', 'MIMCO', 'sdfgdsfgdf', '0', '0', '', '', '0', '0', '0000-00-00', '2014-10-29 21:52:41', NULL, '1'),
(82, 1, 'PEREZ', 'GUZMAN', 'ROBERTO', '45645654', 'MZ P LOTE 15 LOS ALAMAMO', '2342342343', '0', '0', 'roberto.perez@hotmail.com', 'MZ P LOTE 15 LOS ALAMAMO', '0', '0', '1992-03-02', '2014-12-19 06:36:19', NULL, '1'),
(86, 1, 'RETET', 'ERTET', 'TERTRET', '23465464', 'ERTERTERT', '345345', '0', '0', '', 'ERTERTERT', '0', '0', '0000-00-00', '2014-12-19 06:37:47', NULL, '1'),
(87, 1, 'PAREDES', 'GONZALES', 'ETHEL', '45645645', 'ASFASFF', '343243', '0', '0', 'ethel.gonzales@hotmail.com', 'ASFASFF', '0', '0', '1997-12-02', '2014-12-22 15:03:11', NULL, '1'),
(88, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'AV. ABANCAY 986 S.M.P.', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'AV. ABANCAY 986 S.M.P.', '0', '0', '1980-03-19', '2015-03-21 01:31:36', NULL, '1'),
(89, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'ABANCAY 986 SMP', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'ABANCAY 986 SMP', '0', '0', '2015-03-18', '2015-03-21 01:32:34', NULL, '1'),
(90, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'AV. ABANCAY 986 SMP', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'AV. ABANCAY 986 SMP', '0', '0', '2015-03-11', '2015-03-21 01:36:05', NULL, '1'),
(91, 1, '', '', '', '', '', '', '0', '0', '', '', '0', '0', '0000-00-00', '2015-04-04 04:07:35', NULL, '1');

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
  `PERSP_Codigo` int(11) NOT NULL,
  `PROC_FechaModificacion` date NOT NULL,
  `PROC_FechaRegistro` date NOT NULL,
  `PROC_FlagEstado` char(1) NOT NULL,
  `COMPP_Codigo` int(11) NOT NULL,
  PRIMARY KEY (`PROP_Codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`PROP_Codigo`, `PERSP_Codigo`, `PROC_FechaModificacion`, `PROC_FechaRegistro`, `PROC_FlagEstado`, `COMPP_Codigo`) VALUES
(4, 90, '2015-03-21', '0000-00-00', '1', 0),
(5, 91, '2015-04-04', '0000-00-00', '2', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ROL_Codigo`, `COMPP_Codigo`, `ROL_Descripcion`, `ROL_FechaRegistro`, `ROL_FechaModificacion`, `ROL_FlagEstado`) VALUES
(1, 1, 'Usuario', '2014-10-12 15:09:30', NULL, '1'),
(4, 1, 'Administrador', '2014-10-12 15:09:06', NULL, '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `semana`
--

INSERT INTO `semana` (`PRODATRIB_Codigo`, `PROD_Codigo`, `COMPP_Codigo`, `PRODATRIB_Nombre`, `PRODATRIB_Descripcion`, `PRODATRIB_Preguntas`, `PRODATRIB_Puntaje`, `PRODATRIB_Vimeo`, `PRODATRIB_NroIntentos`, `PRODATRIB_FechaModificacion`, `PRODATRIB_FechaRegistro`) VALUES
(16, 5, 1, 'CAPITULO I', 'ASDF', 5, 0, 'http://vimeo.com/92884359', 1, NULL, '2014-10-12 15:40:43');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`PRODATRIBDET_Codigo`, `PRODATRIB_Codigo`, `COMPP_Codigo`, `PRODATRIBDET_Numero`, `PRODATRIBDET_Descripcion`, `PRODATRIBDET_Alternativa1`, `PRODATRIBDET_Alternativa2`, `PRODATRIBDET_Alternativa3`, `PRODATRIBDET_Alternativa4`, `PRODATRIBDET_Alternativa5`, `PRODATRIBDET_FlagCorrecta`, `PRODATRIBDET_FechaModificacion`, `PRODATRIBDET_FechaRegistro`) VALUES
(36, 16, 1, 2, 'ANGULO TRIGONOMETRICO', '', '', '', '', '', 0, NULL, '2015-03-04 22:08:41'),
(38, 16, 1, 2, 'EL SECTOR CIRCULAR', '', '', '', '', '', 0, NULL, '2015-03-04 22:09:25'),
(39, 16, 1, 1, 'ED', 'ED', 'ED', 'ED', 'ED', 'ED', 1, NULL, '2015-04-04 02:01:07');

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
(0, 1, ':::SELECCIONE::', '2014-10-06 08:37:32', NULL, '1'),
(1, 1, 'MATEMATICAS', '2011-01-03 17:30:46', NULL, '1'),
(2, 1, 'IDIOMAS', '2011-01-03 17:30:55', NULL, '1'),
(3, 1, 'NEGOCIOS', '2011-01-03 17:31:09', NULL, '1');

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
(7, 1, 1, 4, 'demo', 'e10adc3949ba59abbe56e057f20f883e', '2014-09-24 09:23:07', NULL, '1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `FK_actividad_orden` FOREIGN KEY (`ORDENP_Codigo`) REFERENCES `orden` (`ORDENP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `FK_cliente_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `compania` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_cliente_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compania`
--
ALTER TABLE `compania`
  ADD CONSTRAINT `FK_compania_empresa` FOREIGN KEY (`EMPRP_Codigo`) REFERENCES `empresa` (`EMPRP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `FK_cji_producto_cji_tipoproducto` FOREIGN KEY (`TIPPROD_Codigo`) REFERENCES `tipoproducto` (`TIPPROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_producto_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `compania` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `FK_empresa_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `compania` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `FK_orden_cliente` FOREIGN KEY (`CLIP_Codigo`) REFERENCES `alumno` (`CLIP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_orden_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `compania` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_orden_producto` FOREIGN KEY (`PROD_Codigo`) REFERENCES `curso` (`PROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `FK_cji_permiso_cji_menu` FOREIGN KEY (`MENU_Codigo`) REFERENCES `menu` (`MENU_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_cji_permiso_cji_rol` FOREIGN KEY (`ROL_Codigo`) REFERENCES `rol` (`ROL_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `permiso_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `compania` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `FK_persona_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `compania` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `puntaje`
--
ALTER TABLE `puntaje`
  ADD CONSTRAINT `FK_puntaje_orden` FOREIGN KEY (`ORDENP_Codigo`) REFERENCES `orden` (`ORDENP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_puntaje_productoatributo` FOREIGN KEY (`PRODATRIB_Codigo`) REFERENCES `semana` (`PRODATRIB_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rol`
--
ALTER TABLE `rol`
  ADD CONSTRAINT `FK_rol_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `compania` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `semana`
--
ALTER TABLE `semana`
  ADD CONSTRAINT `FK_productoatributo_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `compania` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_productoatributo_producto` FOREIGN KEY (`PROD_Codigo`) REFERENCES `curso` (`PROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `FK_productoatributodetalle_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `compania` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_productoatributodetalle_productoatributo` FOREIGN KEY (`PRODATRIB_Codigo`) REFERENCES `semana` (`PRODATRIB_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  ADD CONSTRAINT `FK_tipoproducto_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `compania` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_usuario_compania` FOREIGN KEY (`COMPP_Codigo`) REFERENCES `compania` (`COMPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_usuario_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`ROL_Codigo`) REFERENCES `rol` (`ROL_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
