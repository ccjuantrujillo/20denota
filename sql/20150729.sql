-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla 20denota.acta
CREATE TABLE IF NOT EXISTS `acta` (
  `ACTAP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `USUA_Codigo` int(11) NOT NULL,
  `PROP_Codigo` int(11) NOT NULL,
  `ACTAC_Tipo` char(2) DEFAULT '',
  `ACTAC_Fecha` date NOT NULL DEFAULT '0000-00-00',
  `ACTAC_Numero` int(11) NOT NULL,
  `ACTAC_Titulo` varchar(500) NOT NULL,
  `ACTAC_Agenda` varchar(6) NOT NULL DEFAULT '',
  `ACTAC_Detalle` text NOT NULL,
  `ACTAC_Hinicio` time NOT NULL,
  `ACTAC_Hfin` time NOT NULL,
  `ACTAC_FechaModificacion` datetime NOT NULL,
  `ACTAC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ACTAP_Codigo`),
  KEY `FK_acta_usuario` (`USUA_Codigo`),
  KEY `FK_acta_profesor` (`PROP_Codigo`),
  CONSTRAINT `FK_acta_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_acta_usuario` FOREIGN KEY (`USUA_Codigo`) REFERENCES `usuario` (`USUA_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.acta: ~5 rows (aproximadamente)
DELETE FROM `acta`;
/*!40000 ALTER TABLE `acta` DISABLE KEYS */;
INSERT INTO `acta` (`ACTAP_Codigo`, `USUA_Codigo`, `PROP_Codigo`, `ACTAC_Tipo`, `ACTAC_Fecha`, `ACTAC_Numero`, `ACTAC_Titulo`, `ACTAC_Agenda`, `ACTAC_Detalle`, `ACTAC_Hinicio`, `ACTAC_Hfin`, `ACTAC_FechaModificacion`, `ACTAC_FechaRegistro`) VALUES
	(1, 7, 5, '2', '2015-07-02', 3, 'sdafsadfsdfsdf a los aÃ±os', 'fgfdgs', 'sdfgsfgsdg', '08:25:00', '15:00:00', '2015-07-29 23:54:41', '0000-00-00 00:00:00'),
	(4, 7, 4, '', '2015-07-01', 2, 'erte fdas fasdvrewrwer', 'terter', '', '08:15:00', '10:15:00', '2015-07-29 23:58:20', '2015-07-29 14:35:21'),
	(6, 7, 5, '', '2015-07-21', 4, '345345345 erert', '345345', '', '08:15:00', '10:15:00', '2015-07-29 23:36:01', '2015-07-29 14:36:52'),
	(7, 7, 5, '', '2015-07-29', 1, 'asdfasdf', 'afsafa', '', '08:15:00', '10:15:00', '0000-00-00 00:00:00', '2015-07-29 14:38:29'),
	(9, 7, 5, '', '2015-07-29', 34242, 'sadf werw rwerewr rew', 'rew re', '', '08:15:00', '10:15:00', '0000-00-00 00:00:00', '2015-07-29 14:45:29'),
	(10, 7, 10, '', '2015-07-29', 10, 'Reunion 5', 'LISTA ', '', '08:15:00', '10:15:00', '0000-00-00 00:00:00', '2015-07-29 15:17:31'),
	(11, 7, 10, '', '2015-07-29', 10, 'Reunion 5', 'LISTA ', '', '08:15:00', '10:15:00', '0000-00-00 00:00:00', '2015-07-29 15:17:33'),
	(12, 7, 5, '', '2015-07-29', 12, 'Padre Nuestro', 'Hola a', '', '08:15:00', '10:15:00', '2015-07-29 22:24:49', '2015-07-29 15:20:56'),
	(13, 7, 4, '', '2015-07-10', 25, 'plana de trigonometria', 'hijo p', '', '08:15:00', '10:15:00', '2015-07-29 23:53:36', '2015-07-29 15:26:43');
/*!40000 ALTER TABLE `acta` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.actadetalle
CREATE TABLE IF NOT EXISTS `actadetalle` (
  `ACTADETP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `ACTAP_Codigo` int(11) NOT NULL DEFAULT '0',
  `ACTADETC_Observacion` text,
  `ACTADETC_FechaCompromiso` date DEFAULT NULL,
  `ACTADETC_FechaModificacion` datetime DEFAULT NULL,
  `ACTADETC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ACTADETP_Codigo`),
  KEY `FK_actadetalle_profesor` (`PROP_Codigo`),
  KEY `FK_actadetalle_acta` (`ACTAP_Codigo`),
  CONSTRAINT `FK_actadetalle_acta` FOREIGN KEY (`ACTAP_Codigo`) REFERENCES `acta` (`ACTAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_actadetalle_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.actadetalle: ~11 rows (aproximadamente)
DELETE FROM `actadetalle`;
/*!40000 ALTER TABLE `actadetalle` DISABLE KEYS */;
INSERT INTO `actadetalle` (`ACTADETP_Codigo`, `PROP_Codigo`, `ACTAP_Codigo`, `ACTADETC_Observacion`, `ACTADETC_FechaCompromiso`, `ACTADETC_FechaModificacion`, `ACTADETC_FechaRegistro`) VALUES
	(19, 12, 13, 'ha2', '2015-07-22', NULL, '2015-07-29 15:26:43'),
	(22, 6, 6, '1', '2015-07-22', NULL, '2015-07-29 16:35:13'),
	(26, 6, 6, '2', '2015-07-24', NULL, '2015-07-29 16:36:01'),
	(27, 6, 6, '3', '2015-07-23', NULL, '2015-07-29 16:36:01'),
	(28, 7, 6, '4', '2015-07-23', NULL, '2015-07-29 16:36:01'),
	(29, 6, 6, '5', '2015-07-23', NULL, '2015-07-29 16:36:02'),
	(30, 11, 13, 'Datos del proveedor', '2015-07-15', NULL, '2015-07-29 16:53:36'),
	(31, 5, 1, 'Hola a dtodsod\r\nfasdfasdfasdfsadfwer', '2015-07-08', NULL, '2015-07-29 16:54:13'),
	(32, 4, 4, 'asafweqrwqerweqrwqerqwr', '2015-07-15', NULL, '2015-07-29 16:57:22'),
	(33, 11, 4, 'qwer reqw rewqweqr', '2015-07-09', NULL, '2015-07-29 16:57:22'),
	(34, 11, 4, 'weqrwqer', '2015-07-15', NULL, '2015-07-29 16:57:37');
/*!40000 ALTER TABLE `actadetalle` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.actividad
CREATE TABLE IF NOT EXISTS `actividad` (
  `ACTP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `ORDENP_Codigo` int(11) NOT NULL,
  `ACTC_Accion` varchar(250) NOT NULL,
  `ACTC_Modulo` varchar(250) NOT NULL,
  `ACTC_Session` varchar(250) NOT NULL,
  `ACTC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ACTP_Codigo`),
  KEY `FK_actividad_orden` (`ORDENP_Codigo`),
  CONSTRAINT `FK_actividad_orden` FOREIGN KEY (`ORDENP_Codigo`) REFERENCES `matricula` (`ORDENP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.actividad: ~0 rows (aproximadamente)
DELETE FROM `actividad`;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.alumno
CREATE TABLE IF NOT EXISTS `alumno` (
  `CLIP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL,
  `PERSP_Codigo` int(11) NOT NULL,
  `CLIC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CLIC_FechaModificacion` datetime DEFAULT NULL,
  `CLIC_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`CLIP_Codigo`),
  KEY `FK_cliente_compania` (`CICLOP_Codigo`),
  KEY `FK_cliente_persona` (`PERSP_Codigo`),
  CONSTRAINT `FK_cliente_compania` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_cliente_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.alumno: ~10 rows (aproximadamente)
DELETE FROM `alumno`;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` (`CLIP_Codigo`, `CICLOP_Codigo`, `PERSP_Codigo`, `CLIC_FechaRegistro`, `CLIC_FechaModificacion`, `CLIC_FlagEstado`) VALUES
	(2, 1, 63, '2014-10-21 02:37:30', '2015-05-12 03:38:51', '1'),
	(5, 1, 71, '2014-10-21 05:23:52', '2015-05-09 03:26:31', '1'),
	(7, 1, 73, '2014-10-28 02:15:16', '2015-05-09 03:26:38', '1'),
	(9, 1, 80, '2014-10-30 07:52:00', '2015-05-09 03:44:40', '1'),
	(10, 1, 81, '2014-10-30 07:53:05', '2015-05-09 03:44:31', '1'),
	(11, 1, 82, '2014-12-19 17:36:43', '2014-12-22 16:07:14', '1'),
	(16, 1, 87, '2014-12-23 02:03:35', '2014-12-22 16:03:11', '1'),
	(17, 1, 92, '2015-05-09 12:39:23', '2015-05-09 03:38:59', '1'),
	(18, 1, 95, '2015-05-16 23:25:12', '2015-05-16 21:24:48', '1'),
	(19, 1, 96, '2015-05-30 05:29:13', '2015-07-23 21:34:49', '1');
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.asignacion
CREATE TABLE IF NOT EXISTS `asignacion` (
  `ASIGP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `AULAP_Codigo` int(11) NOT NULL DEFAULT '0',
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `CICLOP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TIPP_Codigo` int(11) NOT NULL DEFAULT '0',
  `ASIGC_Descripcion` varchar(250) NOT NULL DEFAULT '0',
  `ASIGC_Fecha` datetime NOT NULL,
  `ASIGC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ASIGC_FechaModificacion` datetime NOT NULL,
  `ASIGC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ASIGP_Codigo`),
  KEY `FK_asignacion_aula` (`AULAP_Codigo`),
  KEY `FK_asignacion_profesor` (`PROP_Codigo`),
  KEY `FK_asignacion_ciclo` (`CICLOP_Codigo`),
  KEY `FK_asignacion_tipoestudio` (`TIPP_Codigo`),
  CONSTRAINT `FK_asignacion_aula` FOREIGN KEY (`AULAP_Codigo`) REFERENCES `aula` (`AULAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_asignacion_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_asignacion_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_asignacion_tipoestudio` FOREIGN KEY (`TIPP_Codigo`) REFERENCES `tipoestudio` (`TIPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.asignacion: ~6 rows (aproximadamente)
DELETE FROM `asignacion`;
/*!40000 ALTER TABLE `asignacion` DISABLE KEYS */;
INSERT INTO `asignacion` (`ASIGP_Codigo`, `AULAP_Codigo`, `PROP_Codigo`, `CICLOP_Codigo`, `TIPP_Codigo`, `ASIGC_Descripcion`, `ASIGC_Fecha`, `ASIGC_FechaRegistro`, `ASIGC_FechaModificacion`, `ASIGC_FlagEstado`) VALUES
	(2, 5, 5, 1, 2, '0', '2015-05-29 00:00:00', '2015-05-30 07:24:50', '2015-07-24 00:00:00', '1'),
	(3, 7, 6, 2, 3, '0', '2015-07-24 00:00:00', '2015-07-23 17:48:51', '2015-07-24 00:00:00', '1'),
	(4, 11, 5, 2, 3, '0', '2015-07-24 00:00:00', '2015-07-23 17:49:13', '2015-07-24 00:00:00', '1'),
	(5, 11, 5, 2, 4, '0', '2015-07-24 00:00:00', '2015-07-23 17:53:55', '2015-07-24 00:00:00', '1'),
	(6, 11, 5, 2, 6, '0', '2015-07-24 00:00:00', '2015-07-23 17:54:02', '2015-07-24 00:00:00', '1'),
	(7, 5, 5, 2, 6, '0', '2015-07-24 00:00:00', '2015-07-23 17:58:00', '2015-07-24 00:00:00', '1');
/*!40000 ALTER TABLE `asignacion` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.aula
CREATE TABLE IF NOT EXISTS `aula` (
  `AULAP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `LOCP_Codigo` int(11) NOT NULL,
  `COMPP_Codigo` int(11) NOT NULL DEFAULT '0',
  `AULAC_Nombre` varchar(100) DEFAULT NULL,
  `AULAC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AULAP_Codigo`),
  KEY `FK_aula_local` (`LOCP_Codigo`),
  CONSTRAINT `FK_aula_local` FOREIGN KEY (`LOCP_Codigo`) REFERENCES `local` (`LOCP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.aula: ~19 rows (aproximadamente)
DELETE FROM `aula`;
/*!40000 ALTER TABLE `aula` DISABLE KEYS */;
INSERT INTO `aula` (`AULAP_Codigo`, `LOCP_Codigo`, `COMPP_Codigo`, `AULAC_Nombre`, `AULAC_FechaRegistro`) VALUES
	(1, 1, 1, 'D101', '2015-05-16 12:46:43'),
	(2, 1, 1, 'D102', '2015-05-16 12:46:58'),
	(3, 1, 1, 'D103', '2015-05-16 12:47:11'),
	(4, 1, 1, 'D104', '2015-05-16 12:47:20'),
	(5, 1, 1, 'D201', '2015-05-16 12:47:30'),
	(6, 1, 1, 'D202', '2015-05-16 12:47:40'),
	(7, 1, 1, 'D203', '2015-05-16 12:47:49'),
	(8, 1, 1, 'D204', '2015-05-16 12:47:58'),
	(9, 1, 1, 'D205', '2015-05-16 12:48:06'),
	(10, 1, 1, 'D206', '2015-05-16 12:48:14'),
	(11, 2, 1, 'A101', '2015-05-16 12:48:30'),
	(12, 2, 1, 'A102', '2015-05-16 12:48:41'),
	(13, 2, 1, 'A103', '2015-05-16 12:48:54'),
	(14, 2, 1, 'B101', '2015-05-16 12:49:06'),
	(15, 2, 1, 'B102', '2015-05-16 12:49:14'),
	(16, 2, 1, 'B103', '2015-05-16 12:49:23'),
	(17, 2, 1, 'C101', '2015-05-16 12:49:32'),
	(18, 2, 1, 'C102', '2015-05-16 12:49:40'),
	(19, 2, 1, 'C103', '2015-05-16 12:49:48');
/*!40000 ALTER TABLE `aula` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.ciclo
CREATE TABLE IF NOT EXISTS `ciclo` (
  `CICLOP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPC_Nombre` varchar(250) NOT NULL,
  `CICC_FECHA_INICIO` date NOT NULL,
  `CICC_FECHA_FIN` date NOT NULL,
  `CICC_DESCRIPCION` varchar(255) NOT NULL,
  `COMPC_Tipo` int(11) NOT NULL,
  `COMPC_FlagEstado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`CICLOP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.ciclo: ~2 rows (aproximadamente)
DELETE FROM `ciclo`;
/*!40000 ALTER TABLE `ciclo` DISABLE KEYS */;
INSERT INTO `ciclo` (`CICLOP_Codigo`, `COMPC_Nombre`, `CICC_FECHA_INICIO`, `CICC_FECHA_FIN`, `CICC_DESCRIPCION`, `COMPC_Tipo`, `COMPC_FlagEstado`) VALUES
	(1, 'ADMISION 2015-2', '0000-00-00', '1990-05-11', 'CICLO DE INICIO DEL Aï¿½O FF', 1, 1),
	(2, 'ADMISION 2016-1', '2015-05-06', '2015-10-25', 'CICLO DE FIN DE Aï¿½O FFFF', 2, 1);
/*!40000 ALTER TABLE `ciclo` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.curso
CREATE TABLE IF NOT EXISTS `curso` (
  `PROD_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL,
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
  KEY `FK_producto_compania` (`CICLOP_Codigo`),
  CONSTRAINT `FK_cji_producto_cji_tipoproducto` FOREIGN KEY (`TIPPROD_Codigo`) REFERENCES `tipoproducto` (`TIPPROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_producto_compania` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.curso: ~5 rows (aproximadamente)
DELETE FROM `curso`;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`PROD_Codigo`, `CICLOP_Codigo`, `TIPPROD_Codigo`, `PROD_Nombre`, `PROD_DescripcionBreve`, `PROD_EspecificacionPDF`, `PROD_Comentario`, `PROD_Cantidad`, `PROD_Intentos`, `PROD_Tiempo`, `PROD_TiempoExamen`, `PROD_Puntaje`, `PROD_Imagen`, `PROD_Silabus`, `PROD_FechaRegistro`, `PROD_FechaModificacion`, `PROD_FlagEstado`) VALUES
	(5, 1, 1, 'TRIGONOMETRIA', 'SED UT PERSPICIATIS UNDE OMNIS ISTE NATUS ERROR SIT VOLUPTATEM ACCUSANTIUM DOLOREMQUE LAUDANTIUM, TOTAM REM APERIAM. ', '', '', 88, 3, 2, 5, 14, 'erp.png', 'capitulo06.pdf', '2011-01-18 07:20:19', '2015-03-04 23:04:14', '1'),
	(92, 1, 1, 'FISICA', 'EDWARD 2', '', '', 3, 5, 5, 30, 14, NULL, NULL, '2015-03-25 18:01:35', '2015-07-23 21:18:17', '1'),
	(93, 1, 1, 'GEOMETRIA', 'EDWARD', '', '', 4, 5, 5, 30, 14, NULL, NULL, '2015-03-25 18:02:55', '2015-05-09 03:55:42', '1'),
	(95, 1, 1, 'ARITMETICA', 'SDFASDF', '', '', 12, 5, 5, 30, 14, NULL, NULL, '2015-07-24 23:55:23', NULL, '1'),
	(96, 1, 1, 'ALGEBRA', '', '', '', 11, 5, 5, 30, 14, NULL, NULL, '2015-07-24 23:55:41', NULL, '1');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `EMPRP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL,
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
  KEY `FK_empresa_compania` (`CICLOP_Codigo`),
  CONSTRAINT `FK_empresa_compania` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.empresa: ~2 rows (aproximadamente)
DELETE FROM `empresa`;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` (`EMPRP_Codigo`, `CICLOP_Codigo`, `EMPRC_Ruc`, `EMPRC_RazonSocial`, `EMPRC_Telefono`, `EMPRC_Movil`, `EMPRC_Fax`, `EMPRC_Web`, `EMPRC_Email`, `EMPRC_FechaRegistro`, `EMPRC_FechaModificacion`, `EMPRC_FlagEstado`) VALUES
	(0, 1, NULL, 'EMPRESA NO REGISTRADA', NULL, NULL, NULL, NULL, NULL, '2010-12-17 04:34:56', NULL, '1'),
	(1, 1, '11111111111', 'W', '', '', '', '', '', '2011-01-09 15:30:59', NULL, '0');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.local
CREATE TABLE IF NOT EXISTS `local` (
  `LOCP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `LOCC_Nombre` varchar(150) NOT NULL,
  `LOCC_Direccion` varchar(250) NOT NULL,
  `LOCC_Telefono` varchar(250) NOT NULL,
  `LOCC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`LOCP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.local: ~2 rows (aproximadamente)
DELETE FROM `local`;
/*!40000 ALTER TABLE `local` DISABLE KEYS */;
INSERT INTO `local` (`LOCP_Codigo`, `LOCC_Nombre`, `LOCC_Direccion`, `LOCC_Telefono`, `LOCC_FechaRegistro`) VALUES
	(1, 'Sede Sucre', 'AVENIDA SUCRE 1239', '4543278', '2015-05-16 12:45:22'),
	(2, 'Sede Javier Prado', 'Javier Prado 321', '5640904', '2015-05-16 12:45:32'),
	(4, 'Sede Los Olivos', 'Mz R Lote 50 Los Nisperos', '47646', '2015-07-23 16:34:35');
/*!40000 ALTER TABLE `local` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.matricula
CREATE TABLE IF NOT EXISTS `matricula` (
  `ORDENP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) DEFAULT NULL,
  `CLIP_Codigo` int(11) NOT NULL,
  `AULAP_Codigo` int(11) NOT NULL,
  `TIPP_Codigo` int(11) NOT NULL,
  `ORDENC_Observacion` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `ORDENC_Fecot` date DEFAULT NULL,
  `ORDENC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ORDENC_FechaModificacion` datetime DEFAULT NULL,
  `ORDENC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ORDENP_Codigo`),
  KEY `FK_orden_compania` (`CICLOP_Codigo`),
  KEY `FK_orden_cliente` (`CLIP_Codigo`),
  KEY `FK_orden_aula` (`AULAP_Codigo`),
  KEY `FK_matricula_tipoestudio` (`TIPP_Codigo`),
  CONSTRAINT `FK_matricula_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_matricula_tipoestudio` FOREIGN KEY (`TIPP_Codigo`) REFERENCES `tipoestudio` (`TIPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_orden_aula` FOREIGN KEY (`AULAP_Codigo`) REFERENCES `aula` (`AULAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_orden_cliente` FOREIGN KEY (`CLIP_Codigo`) REFERENCES `alumno` (`CLIP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.matricula: ~5 rows (aproximadamente)
DELETE FROM `matricula`;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
INSERT INTO `matricula` (`ORDENP_Codigo`, `CICLOP_Codigo`, `CLIP_Codigo`, `AULAP_Codigo`, `TIPP_Codigo`, `ORDENC_Observacion`, `ORDENC_Fecot`, `ORDENC_FechaRegistro`, `ORDENC_FechaModificacion`, `ORDENC_FlagEstado`) VALUES
	(1, 1, 11, 1, 1, '0', '2015-05-15', '2015-05-15 13:30:53', '2015-07-24 00:00:00', '1'),
	(2, 2, 16, 15, 5, '0', '2015-05-22', '2015-05-23 07:35:12', '2015-05-29 00:00:00', '1'),
	(3, 2, 10, 5, 5, NULL, '2015-05-22', '2015-05-23 07:58:30', '2015-07-24 00:00:00', '1'),
	(4, 2, 5, 14, 5, NULL, '2015-07-24', '2015-07-23 17:33:32', '2015-07-24 00:00:00', '1'),
	(5, 2, 19, 2, 3, NULL, '2015-07-24', '2015-07-23 17:36:16', '2015-07-24 00:00:00', '1');
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `MENU_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `MENU_Codigo_Padre` int(11) NOT NULL DEFAULT '0',
  `MENU_Descripcion` varchar(150) DEFAULT NULL,
  `MENU_Comentario` varchar(250) DEFAULT NULL,
  `MENU_Url` varchar(250) DEFAULT '#',
  `MENU_Imagen` varchar(100) DEFAULT NULL,
  `MENU_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `MENU_FechaModificacion` datetime DEFAULT NULL,
  `MENU_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`MENU_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.menu: ~18 rows (aproximadamente)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`MENU_Codigo`, `MENU_Codigo_Padre`, `MENU_Descripcion`, `MENU_Comentario`, `MENU_Url`, `MENU_Imagen`, `MENU_FechaRegistro`, `MENU_FechaModificacion`, `MENU_FlagEstado`) VALUES
	(2, 58, 'Alumnos', 'Aquí se podrán subir las imágenes o aniamciones que serán contenidas en la marquesina', 'index.php/ventas/alumno/listar', 'alumno.jpg', '2015-07-23 14:00:10', NULL, '1'),
	(3, 1, 'MANTENIMIENTOS', '', 'index.php/almacen/curso/listar', 'libros.jpg', '2015-06-20 22:04:31', NULL, '1'),
	(4, 1, 'PROCESOS', '', 'index.php/ventas/orden/listar', 'matri.jpg', '2015-06-20 22:04:33', NULL, '1'),
	(22, 3, 'Cursos', NULL, 'index.php/almacen/curso/listar', '', '2015-03-25 18:27:17', NULL, '1'),
	(48, 4, 'Matricula', 'Matricula', 'index.php/ventas/matricula/listar', 'matri.jpg', '2015-07-24 22:52:04', NULL, '1'),
	(49, 4, 'Carga horaria', NULL, 'index.php/ventas/asignacion/listar', NULL, '2015-05-17 10:10:56', NULL, '1'),
	(52, 3, 'Documentos', NULL, 'index.php/inicio/principal', NULL, '2015-03-03 13:38:57', NULL, '1'),
	(53, 58, 'Profesor', 'Tabla de Profesores', 'index.php/ventas/profesor/listar', NULL, '2015-07-23 14:00:14', NULL, '1'),
	(55, 3, 'Ejemplo 1', 'Ejemplo 1', 'index.php/almacen/curso/listar', NULL, '2015-04-02 20:40:06', NULL, '1'),
	(56, 1, 'Ejemplo 3', 'Ejemplo 3', 'index.php/almacen/curso/listar', NULL, '2015-04-02 20:58:24', NULL, '1'),
	(57, 56, 'Ejemplo 5', 'Ejemplo 5', 'Ejemplo5', NULL, '2015-04-02 21:18:33', NULL, '1'),
	(58, 3, 'Personas', NULL, '#', NULL, '2015-07-23 13:48:58', NULL, '1'),
	(59, 3, 'Aula', NULL, 'index.php/maestros/aula/listar', NULL, '2015-05-30 04:53:37', NULL, '1'),
	(61, 3, 'Local', NULL, 'index.php/maestros/local/listar', NULL, '2015-05-30 04:55:08', NULL, '1'),
	(62, 3, 'Ciclo', NULL, 'index.php/maestros/ciclo/listar', NULL, '2015-05-30 05:00:29', NULL, '1'),
	(63, 3, 'Tipo de Estudio ', NULL, 'index.php/maestros/tipoestudio/listar', NULL, '2015-06-13 00:02:54', NULL, '1'),
	(64, 1, 'REPORTES Y CONSULTAS', NULL, NULL, NULL, '2015-06-20 22:04:16', NULL, '1'),
	(65, 2, 'Alumnos pequeños', NULL, NULL, NULL, '2015-06-20 23:06:16', NULL, '1'),
	(66, 58, 'Usuarios', 'Usuarios', 'index.php/seguridad/usuario/listar', NULL, '2015-07-23 12:37:31', NULL, '1'),
	(67, 4, 'Actas de reunion', 'Actas de reunion', 'index.php/ventas/acta/listar', NULL, '2015-07-24 22:52:18', NULL, '1'),
	(68, 4, 'Tareas', 'Tareas', '#', NULL, '2015-07-24 22:20:22', NULL, '1'),
	(69, 4, 'Vigilancia de examenes', 'Vigilancia de examenes', '#', NULL, '2015-07-24 22:20:24', NULL, '1');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.permiso
CREATE TABLE IF NOT EXISTS `permiso` (
  `PERM_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL,
  `ROL_Codigo` int(11) NOT NULL,
  `MENU_Codigo` int(11) NOT NULL,
  `PERM_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`PERM_Codigo`),
  UNIQUE KEY `ROL_Codigo_MENU_Codigo` (`ROL_Codigo`,`MENU_Codigo`),
  KEY `FK_cji_permiso_cji_menu` (`MENU_Codigo`),
  KEY `COMPP_Codigo` (`CICLOP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.permiso: ~20 rows (aproximadamente)
DELETE FROM `permiso`;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` (`PERM_Codigo`, `CICLOP_Codigo`, `ROL_Codigo`, `MENU_Codigo`, `PERM_FlagEstado`) VALUES
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
	(49, 1, 4, 62, '1'),
	(50, 1, 4, 63, '1'),
	(51, 1, 4, 64, '1'),
	(52, 1, 4, 65, '1'),
	(53, 1, 4, 66, '1'),
	(54, 1, 4, 67, '1'),
	(55, 1, 4, 68, '1'),
	(56, 1, 4, 69, '1');
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `PERSP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL,
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
  KEY `FK_persona_compania` (`CICLOP_Codigo`),
  CONSTRAINT `FK_persona_compania` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.persona: ~22 rows (aproximadamente)
DELETE FROM `persona`;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`PERSP_Codigo`, `CICLOP_Codigo`, `PERSC_ApellidoPaterno`, `PERSC_ApellidoMaterno`, `PERSC_Nombre`, `PERSC_NumeroDocIdentidad`, `PERSC_Direccion`, `PERSC_Telefono`, `PERSC_Movil`, `PERSC_Fax`, `PERSC_Email`, `PERSC_Domicilio`, `PERSC_Web`, `PERSC_Sexo`, `PERSC_FechaNacimiento`, `PERSC_FechaRegistro`, `PERSC_FechaModificacion`, `PERSC_FlagEstado`) VALUES
	(1, 1, '', '', '', 'D1014', '', '0', '0', '0', '', '', '0', '0', '0000-00-00', '2010-12-29 20:15:19', NULL, '1'),
	(63, 1, 'GOMEZ  ', 'PEREZ ', 'EDUARDO EDUARDOGF', '45645667', '', '234423', '0', '0', 'eduardo@banich.com', '', '0', '0', '2015-05-03', '2011-08-13 09:32:02', NULL, '1'),
	(71, 1, 'PEREZ', 'AGUILAR ', 'MARIA', '40091852', 'AV PERU', '456465', '0', '0', 'maria.aguilar@hotmail.com', 'AV PERU', '0', '0', '2014-02-05', '2014-10-21 05:23:51', NULL, '1'),
	(73, 1, 'RODRIGUEZ', 'MEDRANO', 'ELISEO', '40003256', 'LOS GIRASOLES 4125', '234234/43223434', '0', '0', 'luis.arnaldo@hotmail.com', 'LOS GIRASOLES 4125', '0', '0', '2014-05-11', '2014-10-28 02:15:16', NULL, '1'),
	(80, 1, 'CANAZAS 2', 'QUISPE', 'RUTHCIÃ±A', '40091814', 'MZ R LOTE 50 LOS NISPEROS', '34234242', '0', '0', 'martin@trujillo.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-12-01', '2014-10-30 07:52:00', NULL, '1'),
	(81, 1, 'VARGAS', 'RUIZ', 'ELIZABETH', '21321321', 'MIMCO', 'sdfgdsfgdf', '0', '0', '', 'MIMCO', '0', '0', '0000-00-00', '2014-10-30 07:53:05', NULL, '1'),
	(82, 1, 'PEREZ', 'GUZMAN', 'ROBERTO', '45645654', 'MZ P LOTE 15 LOS ALAMAMO', '2342342343', '0', '0', 'roberto.perez@hotmail.com', 'MZ P LOTE 15 LOS ALAMAMO', '0', '0', '1992-03-02', '2014-12-19 17:36:43', NULL, '1'),
	(87, 1, 'PAREDES', 'GONZALES', 'ETHEL', '45645645', 'ASFASFF', '343243', '0', '0', 'ethel.gonzales@hotmail.com', 'ASFASFF', '0', '0', '1997-12-02', '2014-12-23 02:03:35', NULL, '1'),
	(88, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'AV. ABANCAY 986 S.M.P.', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'AV. ABANCAY 986 S.M.P.', '0', '0', '1980-03-19', '2015-03-21 11:32:00', NULL, '1'),
	(89, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'ABANCAY 986 SMP', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'ABANCAY 986 SMP', '0', '0', '2015-03-18', '2015-03-21 11:32:58', NULL, '1'),
	(90, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'AV. ABANCAY 986 SMP', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'AV. ABANCAY 986 SMP', '0', '0', '2015-03-11', '2015-03-21 11:36:29', NULL, '1'),
	(91, 1, 'FIGUERO', 'MALDONADO', 'EDWARD', '32424234', 'SAN MARTIN DE PORRES', '21231123', '0', '0', 'edward.figueroa@gmail.com', 'SAN MARTIN DE PORRES', '0', '0', '2015-05-26', '2015-04-04 15:07:59', NULL, '1'),
	(92, 1, 'PEREZ DOVAL', 'SANDOVAL', 'DALEANA', '12341234', 'MZ R LOTE 50 LOS NISPEROS', '34324234', '0', '0', 'miriam@hotmail.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-04-22', '2015-05-09 12:39:23', NULL, '1'),
	(93, 1, 'VASQUEZ', 'DOMINGUEZ', 'RIQUELMER', '32423423', 'LIMA', '234234', '0', '0', '', 'LIMA', '0', '0', '2015-05-20', '2015-05-16 12:23:59', NULL, '1'),
	(94, 1, 'AREVALO', 'VILLANUEVA', 'MANUEL', '234234', '', '324234324', '0', '0', '', '', '0', '0', '0000-00-00', '2015-05-16 12:25:47', NULL, '1'),
	(95, 1, 'PEREZ', 'PEREZ', 'GUSTAVO', '12341234', 'MZ R LOTE ', '342344', '0', '0', 'gusta.perez@gmail.com', 'MZ R LOTE ', '0', '0', '2015-05-12', '2015-05-16 23:25:12', NULL, '1'),
	(96, 1, 'AAA', 'BBBB', 'CCCCOCO', '41234321', 'WER', '34234', '0', '0', '', 'WER', '0', '0', '2015-05-26', '2015-05-30 05:29:13', NULL, '1'),
	(97, 1, 'ALMORA', 'RIVAS', 'ENRIQUE', '23452345', 'JHJ', '6598118', '0', '0', 'enalry25@hotmail.com', 'JHJ', '0', '0', '2015-05-25', '2015-05-30 05:31:56', NULL, '1'),
	(98, 1, 'PLANAS', 'VIGO', 'PEDRO', '24353453', 'ASDFSADF', '34234234234', '0', '0', 'pedro.planas@gmail.com', 'ASDFSADF', '0', '0', '2015-07-21', '2015-07-27 16:08:29', NULL, '1'),
	(99, 1, 'NICOMEDES', 'PLACENCIA', 'HUGO', '2342342', 'MZ R LOTE 50 LOS NISPEROS', '23424234', '0', '0', 'hugo.placencia@gmail.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-07-23', '2015-07-27 16:09:18', NULL, '1'),
	(100, 1, 'BONIFACIO', 'VILLA', 'JESUS', '435345', 'MZ R LOTE 50 LOS NISPEROS', '324234234', '0', '0', 'jesus.bonifacio@gmail.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-07-10', '2015-07-27 16:12:47', NULL, '1'),
	(101, 1, 'RODRIGUEZ', 'RICARDO', 'ROLANDO', '80980980', '', '324234', '0', '0', 'rolando.rodriguez@gmail.com', '', '0', '0', '2015-07-08', '2015-07-27 16:14:37', NULL, '1');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.productoatributo2
CREATE TABLE IF NOT EXISTS `productoatributo2` (
  `PRODATRIB2_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROD_Codigo` int(11) DEFAULT NULL,
  `COMPP_Codigo` int(11) DEFAULT NULL,
  `PRODATRIB2_Descripcion` varchar(150) DEFAULT NULL,
  `PRODATRIB2_FechaModificacion` datetime DEFAULT NULL,
  `PRODATRIB2_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PRODATRIB2_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.productoatributo2: ~0 rows (aproximadamente)
DELETE FROM `productoatributo2`;
/*!40000 ALTER TABLE `productoatributo2` DISABLE KEYS */;
/*!40000 ALTER TABLE `productoatributo2` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.productoprecio
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.productoprecio: ~0 rows (aproximadamente)
DELETE FROM `productoprecio`;
/*!40000 ALTER TABLE `productoprecio` DISABLE KEYS */;
/*!40000 ALTER TABLE `productoprecio` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.profesor
CREATE TABLE IF NOT EXISTS `profesor` (
  `PROP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL,
  `PROD_Codigo` int(11) NOT NULL,
  `PERSP_Codigo` int(11) NOT NULL,
  `ROL_Codigo` int(11) NOT NULL,
  `PROC_FechaModificacion` date NOT NULL,
  `PROC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PROC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`PROP_Codigo`),
  KEY `FK_profesor_persona` (`PERSP_Codigo`),
  KEY `FK_profesor_rol` (`ROL_Codigo`),
  KEY `FK_profesor_curso` (`PROD_Codigo`),
  KEY `FK_profesor_ciclo` (`CICLOP_Codigo`),
  CONSTRAINT `FK_profesor_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_profesor_curso` FOREIGN KEY (`PROD_Codigo`) REFERENCES `curso` (`PROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_profesor_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_profesor_rol` FOREIGN KEY (`ROL_Codigo`) REFERENCES `rol` (`ROL_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.profesor: ~9 rows (aproximadamente)
DELETE FROM `profesor`;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` (`PROP_Codigo`, `CICLOP_Codigo`, `PROD_Codigo`, `PERSP_Codigo`, `ROL_Codigo`, `PROC_FechaModificacion`, `PROC_FechaRegistro`, `PROC_FlagEstado`) VALUES
	(4, 1, 92, 90, 5, '2015-03-21', '2015-03-21 09:00:24', '1'),
	(5, 1, 93, 91, 7, '2015-05-16', '2015-05-16 09:00:24', '1'),
	(6, 1, 93, 93, 4, '2015-05-16', '2015-05-16 12:24:00', '1'),
	(7, 1, 93, 94, 5, '2015-05-16', '2015-05-16 12:25:47', '1'),
	(8, 1, 5, 97, 1, '2015-07-23', '2015-05-30 05:31:56', '1'),
	(9, 1, 5, 98, 1, '2015-07-27', '2015-07-27 16:08:29', '1'),
	(10, 1, 5, 99, 1, '2015-07-27', '2015-07-27 16:09:18', '1'),
	(11, 1, 92, 100, 1, '2015-07-27', '2015-07-27 16:12:47', '1'),
	(12, 1, 95, 101, 1, '2015-07-27', '2015-07-27 16:14:37', '1');
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.puntaje
CREATE TABLE IF NOT EXISTS `puntaje` (
  `PUNTP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PRODATRIB_Codigo` int(11) NOT NULL,
  `ORDENP_Codigo` int(11) NOT NULL DEFAULT '0',
  `PUNTC_Puntaje` double NOT NULL DEFAULT '0',
  `PUNTC_FechaInicio` datetime DEFAULT NULL,
  `PUNTC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PUNTP_Codigo`),
  KEY `FK_puntaje_productoatributo` (`PRODATRIB_Codigo`),
  KEY `FK_puntaje_orden` (`ORDENP_Codigo`),
  CONSTRAINT `FK_puntaje_orden` FOREIGN KEY (`ORDENP_Codigo`) REFERENCES `matricula` (`ORDENP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_puntaje_productoatributo` FOREIGN KEY (`PRODATRIB_Codigo`) REFERENCES `semana` (`PRODATRIB_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.puntaje: ~0 rows (aproximadamente)
DELETE FROM `puntaje`;
/*!40000 ALTER TABLE `puntaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `puntaje` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `ROL_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL,
  `ROL_Descripcion` varchar(150) DEFAULT NULL,
  `ROL_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ROL_FechaModificacion` datetime DEFAULT NULL,
  `ROL_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`ROL_Codigo`),
  KEY `FK_rol_compania` (`CICLOP_Codigo`),
  CONSTRAINT `FK_rol_compania` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.rol: ~5 rows (aproximadamente)
DELETE FROM `rol`;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`ROL_Codigo`, `CICLOP_Codigo`, `ROL_Descripcion`, `ROL_FechaRegistro`, `ROL_FechaModificacion`, `ROL_FlagEstado`) VALUES
	(1, 1, 'Usuario', '2014-10-13 02:09:54', NULL, '1'),
	(4, 1, 'Administrador', '2014-10-13 02:09:30', NULL, '1'),
	(5, 1, 'Profesor', '2015-05-16 11:08:48', NULL, '1'),
	(6, 1, 'Coordinador de plana', '2015-05-16 11:09:41', NULL, '1'),
	(7, 1, 'Coordinador general', '2015-05-16 11:09:53', NULL, '1');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.semana
CREATE TABLE IF NOT EXISTS `semana` (
  `PRODATRIB_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL,
  `PROD_Codigo` int(11) NOT NULL,
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
  KEY `FK_productoatributo_compania` (`CICLOP_Codigo`),
  CONSTRAINT `FK_productoatributo_compania` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_productoatributo_producto` FOREIGN KEY (`PROD_Codigo`) REFERENCES `curso` (`PROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.semana: ~20 rows (aproximadamente)
DELETE FROM `semana`;
/*!40000 ALTER TABLE `semana` DISABLE KEYS */;
INSERT INTO `semana` (`PRODATRIB_Codigo`, `CICLOP_Codigo`, `PROD_Codigo`, `PRODATRIB_Nombre`, `PRODATRIB_Descripcion`, `PRODATRIB_Preguntas`, `PRODATRIB_Puntaje`, `PRODATRIB_Vimeo`, `PRODATRIB_NroIntentos`, `PRODATRIB_FechaModificacion`, `PRODATRIB_FechaRegistro`) VALUES
	(16, 1, 93, 'SEMANA 01', 'ASDF', 5, 0, 'http://vimeo.com/92884359', 1, NULL, '2014-10-13 02:41:07'),
	(17, 1, 93, 'SEMANA 02', '', 5, 0, '', 0, NULL, '2015-05-12 11:54:09'),
	(18, 1, 93, 'SEMANA 03', '', 5, 0, '', 0, NULL, '2015-05-12 11:54:27'),
	(19, 1, 93, 'SEMANA 05', '', 5, 0, '', 0, NULL, '2015-05-12 11:54:40'),
	(20, 1, 93, 'SEMANA 04', '', 5, 0, '', 0, NULL, '2015-05-12 11:54:57'),
	(21, 1, 93, 'SEMANA 06', '', 5, 0, '', 0, NULL, '2015-05-12 11:55:15'),
	(22, 1, 93, 'SEMANA 07', '', 5, 0, '', 0, NULL, '2015-05-12 11:56:38'),
	(23, 1, 93, 'SEMANA 08', '', 5, 0, '', 0, NULL, '2015-05-12 11:57:38'),
	(24, 1, 93, 'SEMANA 09', '', 5, 0, '', 0, NULL, '2015-05-12 11:57:50'),
	(25, 1, 93, 'SEMANA 10', '', 5, 0, '', 0, NULL, '2015-05-12 11:58:00'),
	(26, 1, 93, 'SEMANA 11', '', 5, 0, '', 0, NULL, '2015-05-12 11:58:19'),
	(27, 1, 93, 'SEMANA 12', '', 5, 0, '', 0, NULL, '2015-05-12 11:58:35'),
	(28, 1, 93, 'SEMANA 13', '', 5, 0, '', 0, NULL, '2015-05-12 11:58:46'),
	(29, 1, 93, 'SEMANA 14', '', 5, 0, '', 0, NULL, '2015-05-12 11:59:07'),
	(30, 1, 93, 'SEMANA 15', '', 5, 0, '', 0, NULL, '2015-05-12 11:59:17'),
	(31, 1, 93, 'SEMANA 16', '', 5, 0, '', 0, NULL, '2015-05-12 11:59:46'),
	(32, 1, 93, 'SEMANA 17', '', 5, 0, '', 0, NULL, '2015-05-12 11:59:55'),
	(33, 1, 93, 'SEMANA 18', '', 5, 0, '', 0, NULL, '2015-05-12 12:00:11'),
	(34, 1, 93, 'SEMANA 19', '', 5, 0, '', 0, NULL, '2015-05-12 12:00:21'),
	(35, 1, 93, 'SEMANA 20', '', 5, 0, '', 0, NULL, '2015-05-12 12:00:36');
/*!40000 ALTER TABLE `semana` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tema
CREATE TABLE IF NOT EXISTS `tema` (
  `PRODATRIBDET_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PRODATRIB_Codigo` int(11) NOT NULL,
  `CICLOP_Codigo` int(11) NOT NULL,
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
  KEY `FK_productoatributodetalle_compania` (`CICLOP_Codigo`),
  CONSTRAINT `FK_productoatributodetalle_compania` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_productoatributodetalle_productoatributo` FOREIGN KEY (`PRODATRIB_Codigo`) REFERENCES `semana` (`PRODATRIB_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.tema: ~40 rows (aproximadamente)
DELETE FROM `tema`;
/*!40000 ALTER TABLE `tema` DISABLE KEYS */;
INSERT INTO `tema` (`PRODATRIBDET_Codigo`, `PRODATRIB_Codigo`, `CICLOP_Codigo`, `PRODATRIBDET_Numero`, `PRODATRIBDET_Descripcion`, `PRODATRIBDET_Alternativa1`, `PRODATRIBDET_Alternativa2`, `PRODATRIBDET_Alternativa3`, `PRODATRIBDET_Alternativa4`, `PRODATRIBDET_Alternativa5`, `PRODATRIBDET_FlagCorrecta`, `PRODATRIBDET_FechaModificacion`, `PRODATRIBDET_FechaRegistro`) VALUES
	(36, 16, 1, 2, 'NOCIONES BASICAS', '', '', '', '', '', 0, NULL, '2015-03-05 09:09:05'),
	(38, 16, 1, 2, 'TRIANGULOS', '', '', '', '', '', 0, NULL, '2015-03-05 09:09:49'),
	(39, 17, 1, 1, 'CONGRUENCIA DE TRIANGULOS', 'ED', 'ED', 'ED', 'ED', 'ED', 1, NULL, '2015-04-04 13:01:31'),
	(40, 17, 1, 1, 'APLICACIONES DE LA CONGRUENCIA', '', '', '', '', '', 0, NULL, '2015-05-12 12:43:14'),
	(41, 18, 1, 1, 'TRIANGULOS RECTANGULOS NOTABLES', '', '', '', '', '', 0, NULL, '2015-05-12 12:43:57'),
	(42, 18, 1, 2, 'CUADRILATEROS', '', '', '', '', '', 0, NULL, '2015-05-12 12:44:21'),
	(43, 20, 1, 1, 'CIRCUNFERENCIA', '', '', '', '', '', 0, NULL, '2015-05-12 12:45:05'),
	(44, 20, 1, 2, 'CUADRILATERO CIRSCUNSCRITO Y CIRCUNSCRIPTE', '', '', '', '', '', 0, NULL, '2015-05-12 12:45:52'),
	(45, 19, 1, 1, 'ANGULOS EN LA CIRCUNFERENCIA', '', '', '', '', '', 0, NULL, '2015-05-12 12:46:24'),
	(46, 19, 1, 2, 'PROPORCIONALIDAD', '', '', '', '', '', 0, NULL, '2015-05-12 12:46:42'),
	(47, 21, 1, 1, 'SEMEJANZA DE TRIANGULOS', '', '', '', '', '', 0, NULL, '2015-05-12 12:47:06'),
	(48, 21, 1, 2, 'RECTA Y CIRCUNFERENCIA DE EULER', '', '', '', '', '', 0, NULL, '2015-05-12 12:47:36'),
	(49, 22, 1, 1, 'RELACIONES METRICAS EN EL TRIANGULO RECTANGULO', 'l', '', '', '', '', 0, NULL, '2015-05-12 12:48:45'),
	(50, 22, 1, 2, 'RELACIONES METRICAS EN EL TRIANGULO OBLICUANGULO', '', '', '', '', '', 0, NULL, '2015-05-12 12:50:05'),
	(51, 23, 1, 1, 'TEOREMA DE LAS CUERDAS', '', '', '', '', '', 0, NULL, '2015-05-12 12:50:31'),
	(52, 23, 1, 2, 'TEOREMA DEL TRIANGULO INSCRITO', '', '', '', '', '', 0, NULL, '2015-05-12 12:51:09'),
	(53, 24, 1, 1, 'POLIGONOS REGULARES', '', '', '', '', '', 0, NULL, '2015-05-12 12:51:30'),
	(54, 24, 1, 2, 'POLIGONOS REGULARES NOTABLES INSCRITOS', '', '', '', '', '', 0, NULL, '2015-05-12 12:51:48'),
	(55, 25, 1, 1, 'SIMETRIA EN EL PLANO', '', '', '', '', '', 0, NULL, '2015-05-12 12:52:49'),
	(56, 25, 1, 2, 'LONGITUD DE LA CIRCUNFERENCIA', '', '', '', '', '', 0, NULL, '2015-05-12 12:53:17'),
	(57, 26, 1, 1, 'AREAS DE REGIONES POLIGONALES', '', '', '', '', '', 0, NULL, '2015-05-12 12:53:48'),
	(58, 26, 1, 2, 'RELACION DE AREAS DE REGIONES TRIANGULARES', '', '', '', '', '', 0, NULL, '2015-05-12 12:54:19'),
	(59, 27, 1, 1, 'AREA DE REGIONES CUADRANGULARES', '', '', '', '', '', 0, NULL, '2015-05-12 12:54:48'),
	(60, 27, 1, 2, 'AREAS DE REGIONES CIRCULARES', '', '', '', '', '', 0, NULL, '2015-05-12 12:55:11'),
	(61, 28, 1, 1, 'ELEMENTOS DE GEOMETRIA EN EL ESPACIO', '', '', '', '', '', 0, NULL, '2015-05-12 12:55:50'),
	(62, 28, 1, 2, 'RECTA PERPENDICULAR A UN PLANO', '', '', '', '', '', 0, NULL, '2015-05-12 12:56:43'),
	(63, 29, 1, 1, 'ANGULO DIEDRO', '', '', '', '', '', 0, NULL, '2015-05-12 12:57:03'),
	(64, 29, 1, 2, 'ANGULO TRIEDRO', '', '', '', '', '', 0, NULL, '2015-05-12 12:57:18'),
	(65, 30, 1, 1, 'POLIEDROS', '', '', '', '', '', 0, NULL, '2015-05-12 12:57:35'),
	(66, 30, 1, 2, 'POLIEDROS REGULARES', '', '', '', '', '', 0, NULL, '2015-05-12 12:57:57'),
	(67, 31, 1, 1, 'SIMETRIA EN EL ESPACIO', '', '', '', '', '', 0, NULL, '2015-05-12 12:58:26'),
	(68, 31, 1, 2, 'SUPERFICIE PRISMATICA: PRISMA', '', '', '', '', '', 0, NULL, '2015-05-12 12:58:57'),
	(69, 32, 1, 1, 'DESARROLLOP DE LA SUPERFICIE LATERAL Y TOTAL DE UN PRISMA RECTO', '', '', '', '', '', 0, NULL, '2015-05-12 12:59:47'),
	(70, 32, 1, 2, 'SUPERFICIE PIRAMIDAL: PIRAMIDE', '', '', '', '', '', 0, NULL, '2015-05-12 13:00:11'),
	(71, 33, 1, 1, 'TRONCO DE PIRAMIDE', '', '', '', '', '', 0, NULL, '2015-05-12 13:00:27'),
	(72, 33, 1, 2, 'CILINDRO', '', '', '', '', '', 0, NULL, '2015-05-12 13:00:51'),
	(73, 34, 1, 1, 'CONO', '', '', '', '', '', 0, NULL, '2015-05-12 13:01:07'),
	(74, 34, 1, 2, 'SUPERFICIE ESFERICA', '', '', '', '', '', 0, NULL, '2015-05-12 13:01:25'),
	(75, 35, 1, 1, 'ESFERA', '', '', '', '', '', 0, NULL, '2015-05-12 13:01:42'),
	(76, 35, 1, 2, 'TEOREMA DE PAPPUS-GUIDING', '', '', '', '', '', 0, NULL, '2015-05-12 13:02:07');
/*!40000 ALTER TABLE `tema` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tipoestudio
CREATE TABLE IF NOT EXISTS `tipoestudio` (
  `TIPP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL DEFAULT '1',
  `TIPC_Nombre` varchar(100) DEFAULT NULL,
  `TIPC_Descripcion` varchar(100) DEFAULT NULL,
  `TIPC_FechaRegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TIPC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`TIPP_Codigo`),
  KEY `FK_tipoestudio_compania` (`CICLOP_Codigo`),
  CONSTRAINT `FK_tipoestudio_compania` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tipoestudio: ~6 rows (aproximadamente)
DELETE FROM `tipoestudio`;
/*!40000 ALTER TABLE `tipoestudio` DISABLE KEYS */;
INSERT INTO `tipoestudio` (`TIPP_Codigo`, `CICLOP_Codigo`, `TIPC_Nombre`, `TIPC_Descripcion`, `TIPC_FechaRegistro`, `TIPC_FlagEstado`) VALUES
	(1, 1, 'Pre', 'Tipo de Estudio para los alumnos que van a postular a la UNI', '2015-05-15 04:18:57', '1'),
	(2, 1, 'Basico', 'Tipo de Estudio para los alumnos que recien egresan del colegio', '2015-05-15 04:19:14', '1'),
	(3, 2, 'Pre', 'Tipo de Estudio para los alumnos que van a postular a la UNI', '2015-05-15 04:19:44', '1'),
	(4, 2, 'Repaso', 'Tipo de estudio para los alumnos que requieren un repaso antes de postular a la UNI', '2015-05-15 04:19:49', '1'),
	(5, 2, 'Basico', 'Tipo de Estudio para los alumnos que recien egresan del colegio', '2015-05-15 04:20:23', '1'),
	(6, 2, 'Intensivo', 'Tipo de Estudio para resolver problemas antes de dar el examen de la UNI', '2015-05-15 04:20:28', '1');
/*!40000 ALTER TABLE `tipoestudio` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tipoproducto
CREATE TABLE IF NOT EXISTS `tipoproducto` (
  `TIPPROD_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) DEFAULT NULL,
  `TIPPROD_Descripcion` varchar(250) DEFAULT NULL,
  `TIPPROD_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TIPPROD_FechaModificacion` datetime DEFAULT NULL,
  `TIPPROD_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`TIPPROD_Codigo`),
  KEY `FK_tipoproducto_compania` (`CICLOP_Codigo`),
  CONSTRAINT `FK_tipoproducto_compania` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.tipoproducto: ~4 rows (aproximadamente)
DELETE FROM `tipoproducto`;
/*!40000 ALTER TABLE `tipoproducto` DISABLE KEYS */;
INSERT INTO `tipoproducto` (`TIPPROD_Codigo`, `CICLOP_Codigo`, `TIPPROD_Descripcion`, `TIPPROD_FechaRegistro`, `TIPPROD_FechaModificacion`, `TIPPROD_FlagEstado`) VALUES
	(0, 1, ':::SELECCIONE::', '2014-10-06 19:37:56', NULL, '1'),
	(1, 1, 'MATEMATICAS', '2011-01-04 04:31:10', NULL, '1'),
	(2, 1, 'IDIOMAS', '2011-01-04 04:31:19', NULL, '1'),
	(3, 1, 'NEGOCIOS', '2011-01-04 04:31:33', NULL, '1');
/*!40000 ALTER TABLE `tipoproducto` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `USUA_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL,
  `PERSP_Codigo` int(11) NOT NULL,
  `ROL_Codigo` int(11) NOT NULL,
  `USUA_usuario` varchar(20) DEFAULT NULL,
  `USUA_Password` varchar(50) DEFAULT NULL,
  `USUA_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `USUA_FechaModificacion` datetime DEFAULT NULL,
  `USUA_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`USUA_Codigo`),
  KEY `FK_usuario_compania` (`CICLOP_Codigo`),
  KEY `FK_usuario_persona` (`PERSP_Codigo`),
  KEY `FK_usuario_rol` (`ROL_Codigo`),
  CONSTRAINT `FK_usuario_compania` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuario_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`ROL_Codigo`) REFERENCES `rol` (`ROL_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.usuario: ~0 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`USUA_Codigo`, `CICLOP_Codigo`, `PERSP_Codigo`, `ROL_Codigo`, `USUA_usuario`, `USUA_Password`, `USUA_FechaRegistro`, `USUA_FechaModificacion`, `USUA_FlagEstado`) VALUES
	(7, 1, 1, 4, 'demo', 'e10adc3949ba59abbe56e057f20f883e', '2014-09-24 20:23:31', NULL, '1');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
