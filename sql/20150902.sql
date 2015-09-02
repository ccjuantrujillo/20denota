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
  `ACTAC_Agenda` text NOT NULL,
  `ACTAC_Detalle` text NOT NULL,
  `ACTAC_Hinicio` time NOT NULL,
  `ACTAC_Hfin` time NOT NULL,
  `ACTAC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ACTAC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ACTAP_Codigo`),
  KEY `FK_acta_usuario` (`USUA_Codigo`),
  KEY `FK_acta_profesor` (`PROP_Codigo`),
  CONSTRAINT `FK_acta_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_acta_usuario` FOREIGN KEY (`USUA_Codigo`) REFERENCES `usuario` (`USUA_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.acta: ~6 rows (aproximadamente)
DELETE FROM `acta`;
/*!40000 ALTER TABLE `acta` DISABLE KEYS */;
INSERT INTO `acta` (`ACTAP_Codigo`, `USUA_Codigo`, `PROP_Codigo`, `ACTAC_Tipo`, `ACTAC_Fecha`, `ACTAC_Numero`, `ACTAC_Titulo`, `ACTAC_Agenda`, `ACTAC_Detalle`, `ACTAC_Hinicio`, `ACTAC_Hfin`, `ACTAC_FechaModificacion`, `ACTAC_FechaRegistro`) VALUES
	(1, 7, 5, '2', '2015-07-02', 3, 'sdafsadfsdfsdf a los aÃ±os', 'fgfdgs', 'sdfgsfgsdg', '08:25:00', '15:00:00', '2015-07-29 23:54:41', '0000-00-00 00:00:00'),
	(4, 7, 4, '', '2015-07-01', 2, 'erte fdas fasdvrewrwer', 'terter', '', '08:15:00', '10:15:00', '2015-07-29 23:58:20', '2015-07-29 14:35:21'),
	(6, 7, 5, '', '2015-07-21', 4, '345345345 erert', '345345', '', '08:15:00', '10:15:00', '2015-07-29 23:36:01', '2015-07-29 14:36:52'),
	(10, 7, 10, '', '2015-07-29', 10, 'Reunion 5', 'LISTA ', '', '08:15:00', '10:15:00', '0000-00-00 00:00:00', '2015-07-29 15:17:31'),
	(11, 7, 10, '', '2015-07-29', 10, 'Reunion 5', 'LISTA ', '', '08:15:00', '10:15:00', '0000-00-00 00:00:00', '2015-07-29 15:17:33'),
	(12, 7, 5, '', '2015-07-29', 12, 'Padre Nuestro', 'Hola a', '', '08:15:00', '10:15:00', '2015-07-29 22:24:49', '2015-07-29 15:20:56');
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.actadetalle: ~10 rows (aproximadamente)
DELETE FROM `actadetalle`;
/*!40000 ALTER TABLE `actadetalle` DISABLE KEYS */;
INSERT INTO `actadetalle` (`ACTADETP_Codigo`, `PROP_Codigo`, `ACTAP_Codigo`, `ACTADETC_Observacion`, `ACTADETC_FechaCompromiso`, `ACTADETC_FechaModificacion`, `ACTADETC_FechaRegistro`) VALUES
	(22, 6, 6, '1', '2015-07-22', NULL, '2015-07-29 16:35:13'),
	(26, 6, 6, '2', '2015-07-24', NULL, '2015-07-29 16:36:01'),
	(27, 6, 6, '3', '2015-07-23', NULL, '2015-07-29 16:36:01'),
	(28, 7, 6, '4', '2015-07-23', NULL, '2015-07-29 16:36:01'),
	(31, 5, 1, 'Hola a dtodsod\r\nfasdfasdfasdfsadfwer', '2015-07-08', NULL, '2015-07-29 16:54:13'),
	(32, 4, 4, 'asafweqrwqerweqrwqerqwr', '2015-07-15', NULL, '2015-07-29 16:57:22'),
	(34, 5, 12, 'asdfasdf', '2015-08-17', NULL, '2015-08-07 08:07:54'),
	(35, 6, 12, 'dgsdgdfgsdg', '2015-08-10', NULL, '2015-08-07 08:15:33'),
	(36, 5, 12, ' gds gds gsdf gsdg d gsdf gsd', '2015-08-04', NULL, '2015-08-07 08:15:47'),
	(37, 11, 4, 'qwer reqw rewqweqr', '2015-07-09', NULL, '2015-08-07 09:23:43');
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
  `PERSP_Codigo` int(11) NOT NULL,
  `CLIC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CLIC_FechaModificacion` datetime DEFAULT NULL,
  `CLIC_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`CLIP_Codigo`),
  KEY `FK_cliente_persona` (`PERSP_Codigo`),
  CONSTRAINT `FK_cliente_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.alumno: ~10 rows (aproximadamente)
DELETE FROM `alumno`;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` (`CLIP_Codigo`, `PERSP_Codigo`, `CLIC_FechaRegistro`, `CLIC_FechaModificacion`, `CLIC_FlagEstado`) VALUES
	(2, 63, '2014-10-21 02:37:30', '2015-05-12 03:38:51', '1'),
	(5, 71, '2014-10-21 05:23:52', '2015-05-09 03:26:31', '1'),
	(7, 73, '2014-10-28 02:15:16', '2015-05-09 03:26:38', '1'),
	(9, 80, '2014-10-30 07:52:00', '2015-05-09 03:44:40', '1'),
	(10, 81, '2014-10-30 07:53:05', '2015-05-09 03:44:31', '1'),
	(11, 82, '2014-12-19 17:36:43', '2014-12-22 16:07:14', '1'),
	(16, 87, '2014-12-23 02:03:35', '2014-12-22 16:03:11', '1'),
	(17, 92, '2015-05-09 12:39:23', '2015-05-09 03:38:59', '1'),
	(18, 95, '2015-05-16 23:25:12', '2015-05-16 21:24:48', '1'),
	(19, 96, '2015-05-30 05:29:13', '2015-07-23 21:34:49', '1');
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.asignacion
CREATE TABLE IF NOT EXISTS `asignacion` (
  `ASIGP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `CICLOP_Codigo` int(11) NOT NULL DEFAULT '0',
  `ASIGC_Descripcion` varchar(250) NOT NULL DEFAULT '0',
  `ASIGC_Fecha` datetime NOT NULL,
  `ASIGC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  `ASIGC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ASIGC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ASIGP_Codigo`),
  KEY `FK_asignacion_profesor` (`PROP_Codigo`),
  KEY `FK_asignacion_ciclo` (`CICLOP_Codigo`),
  CONSTRAINT `FK_asignacion_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_asignacion_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.asignacion: ~4 rows (aproximadamente)
DELETE FROM `asignacion`;
/*!40000 ALTER TABLE `asignacion` DISABLE KEYS */;
INSERT INTO `asignacion` (`ASIGP_Codigo`, `PROP_Codigo`, `CICLOP_Codigo`, `ASIGC_Descripcion`, `ASIGC_Fecha`, `ASIGC_FlagEstado`, `ASIGC_FechaModificacion`, `ASIGC_FechaRegistro`) VALUES
	(8, 7, 1, '0', '2015-08-07 00:00:00', '1', '2015-08-06 16:46:18', '2015-08-05 19:55:56'),
	(9, 7, 2, '0', '2015-08-06 00:00:00', '1', '2015-08-06 00:00:00', '2015-08-05 19:56:28'),
	(13, 11, 1, '0', '2015-08-07 00:00:00', '2', NULL, '2015-08-07 12:12:40'),
	(14, 5, 1, '0', '2015-08-07 00:00:00', '1', NULL, '2015-08-07 12:15:07'),
	(15, 5, 1, '0', '2015-08-07 00:00:00', '1', NULL, '2015-08-07 12:15:09');
/*!40000 ALTER TABLE `asignacion` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.asignaciondetalle
CREATE TABLE IF NOT EXISTS `asignaciondetalle` (
  `ASIGDETP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `ASIGP_Codigo` int(11) NOT NULL DEFAULT '0',
  `AULAP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TIPP_Codigo` int(11) NOT NULL DEFAULT '0',
  `ASIGDETC_Dia` int(1) NOT NULL DEFAULT '0',
  `ASIGDETC_Desde` time DEFAULT NULL,
  `ASIGDETC_Hasta` time DEFAULT NULL,
  `ASIGDETC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ASIGDETC_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ASIGDETP_Codigo`),
  KEY `FK_asignaciondetalle_asignacion` (`ASIGP_Codigo`),
  KEY `FK_asignaciondetalle_aula` (`AULAP_Codigo`),
  KEY `FK_asignaciondetalle_tipoestudio` (`TIPP_Codigo`),
  CONSTRAINT `FK_asignaciondetalle_asignacion` FOREIGN KEY (`ASIGP_Codigo`) REFERENCES `asignacion` (`ASIGP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_asignaciondetalle_aula` FOREIGN KEY (`AULAP_Codigo`) REFERENCES `aula` (`AULAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_asignaciondetalle_tipoestudio` FOREIGN KEY (`TIPP_Codigo`) REFERENCES `tipoestudio` (`TIPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.asignaciondetalle: ~9 rows (aproximadamente)
DELETE FROM `asignaciondetalle`;
/*!40000 ALTER TABLE `asignaciondetalle` DISABLE KEYS */;
INSERT INTO `asignaciondetalle` (`ASIGDETP_Codigo`, `ASIGP_Codigo`, `AULAP_Codigo`, `TIPP_Codigo`, `ASIGDETC_Dia`, `ASIGDETC_Desde`, `ASIGDETC_Hasta`, `ASIGDETC_FechaModificacion`, `ASIGDETC_FechaRegistro`) VALUES
	(7, 8, 3, 1, 2, '12:00:00', '14:00:00', NULL, '2015-08-06 16:46:00'),
	(10, 8, 3, 1, 1, '01:01:00', '23:00:00', NULL, '2015-08-07 07:28:08'),
	(11, 8, 1, 2, 6, '02:03:00', '04:05:00', NULL, '2015-08-07 10:03:24'),
	(13, 8, 11, 1, 0, '00:00:00', '00:00:00', NULL, '2015-08-07 11:51:18'),
	(17, 8, 8, 2, 3, '01:01:00', '02:02:00', '2015-08-07 12:18:47', '2015-08-07 11:53:57'),
	(18, 8, 3, 2, 2, '00:00:00', '00:00:00', NULL, '2015-08-07 11:55:19'),
	(19, 8, 15, 1, 2, '00:00:00', '00:00:00', NULL, '2015-08-07 11:55:34'),
	(20, 8, 15, 1, 5, '00:00:00', '00:00:00', NULL, '2015-08-07 11:57:27'),
	(25, 9, 14, 5, 2, '00:00:00', '00:00:00', NULL, '2015-08-07 12:16:44'),
	(28, 15, 5, 1, 2, '00:00:00', '00:00:00', NULL, '2015-08-07 12:19:18'),
	(29, 9, 10, 5, 2, '00:00:00', '00:00:00', NULL, '2015-08-07 12:19:43');
/*!40000 ALTER TABLE `asignaciondetalle` ENABLE KEYS */;


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
  `TIPOCICLOP_Codigo` int(11) NOT NULL,
  `COMPC_Nombre` varchar(250) NOT NULL,
  `CICC_FECHA_INICIO` date NOT NULL,
  `CICC_FECHA_FIN` date NOT NULL,
  `CICC_DESCRIPCION` varchar(255) NOT NULL,
  `COMPC_FlagEstado` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`CICLOP_Codigo`),
  KEY `FK_ciclo_tipociclo` (`TIPOCICLOP_Codigo`),
  CONSTRAINT `FK_ciclo_tipociclo` FOREIGN KEY (`TIPOCICLOP_Codigo`) REFERENCES `tipociclo` (`TIPOCICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.ciclo: ~2 rows (aproximadamente)
DELETE FROM `ciclo`;
/*!40000 ALTER TABLE `ciclo` DISABLE KEYS */;
INSERT INTO `ciclo` (`CICLOP_Codigo`, `TIPOCICLOP_Codigo`, `COMPC_Nombre`, `CICC_FECHA_INICIO`, `CICC_FECHA_FIN`, `CICC_DESCRIPCION`, `COMPC_FlagEstado`) VALUES
	(1, 1, 'ADMISION 2016-1', '0000-00-00', '1990-05-11', 'CICLO DE INICIO DEL AÃ±O', 1),
	(2, 2, 'ADMISION 2015-2', '2015-05-06', '2015-10-25', 'CICLO DE FIN DE AÃ±O', 1);
/*!40000 ALTER TABLE `ciclo` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.curso
CREATE TABLE IF NOT EXISTS `curso` (
  `PROD_Codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `PROD_FlagEstado` char(1) NOT NULL DEFAULT '1',
  `PROD_FechaModificacion` datetime DEFAULT NULL,
  `PROD_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PROD_Codigo`),
  KEY `FK_cji_producto_cji_tipoproducto` (`TIPPROD_Codigo`),
  CONSTRAINT `FK_cji_producto_cji_tipoproducto` FOREIGN KEY (`TIPPROD_Codigo`) REFERENCES `tipoproducto` (`TIPPROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.curso: ~5 rows (aproximadamente)
DELETE FROM `curso`;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`PROD_Codigo`, `TIPPROD_Codigo`, `PROD_Nombre`, `PROD_DescripcionBreve`, `PROD_EspecificacionPDF`, `PROD_Comentario`, `PROD_Cantidad`, `PROD_Intentos`, `PROD_Tiempo`, `PROD_TiempoExamen`, `PROD_Puntaje`, `PROD_Imagen`, `PROD_Silabus`, `PROD_FlagEstado`, `PROD_FechaModificacion`, `PROD_FechaRegistro`) VALUES
	(5, 1, 'TRIGONOMETRIA', 'SED UT PERSPICIATIS UNDE OMNIS ISTE NATUS ERROR SIT VOLUPTATEM ACCUSANTIUM DOLOREMQUE LAUDANTIUM, TOTAM REM APERIAM. ', '', '', 88, 3, 2, 5, 14, 'erp.png', 'capitulo06.pdf', '1', '2015-03-04 23:04:14', '2011-01-18 07:20:19'),
	(92, 1, 'FISICA', 'EDWARD 2', '', '', 3, 5, 5, 30, 14, NULL, NULL, '1', '2015-07-23 21:18:17', '2015-03-25 18:01:35'),
	(93, 1, 'GEOMETRIA', 'EDWARD', '', '', 4, 5, 5, 30, 14, NULL, NULL, '1', '2015-05-09 03:55:42', '2015-03-25 18:02:55'),
	(95, 1, 'ARITMETICA', 'SDFASDF', '', '', 12, 5, 5, 30, 14, NULL, NULL, '1', NULL, '2015-07-24 23:55:23'),
	(96, 1, 'ALGEBRA', '', '', '', 11, 5, 5, 30, 14, NULL, NULL, '1', NULL, '2015-07-24 23:55:41');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.cursociclo
CREATE TABLE IF NOT EXISTS `cursociclo` (
  `CURSOCIP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROD_Codigo` int(11) NOT NULL DEFAULT '0',
  `CICLOP_Codigo` int(11) NOT NULL DEFAULT '0',
  `CURSOCIC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  `CURSOCIC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `CURSOCIC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CURSOCIP_Codigo`),
  UNIQUE KEY `PROD_Codigo_CICLOP_Codigo` (`PROD_Codigo`,`CICLOP_Codigo`),
  KEY `FK_cursociclo_ciclo` (`CICLOP_Codigo`),
  CONSTRAINT `FK_cursociclo_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_cursociclo_curso` FOREIGN KEY (`PROD_Codigo`) REFERENCES `curso` (`PROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.cursociclo: ~7 rows (aproximadamente)
DELETE FROM `cursociclo`;
/*!40000 ALTER TABLE `cursociclo` DISABLE KEYS */;
INSERT INTO `cursociclo` (`CURSOCIP_Codigo`, `PROD_Codigo`, `CICLOP_Codigo`, `CURSOCIC_FlagEstado`, `CURSOCIC_FechaModificacion`, `CURSOCIC_FechaRegistro`) VALUES
	(4, 93, 1, '1', NULL, '2015-08-12 12:08:18'),
	(5, 96, 1, '1', '2015-08-12 15:23:50', '2015-08-12 12:08:33'),
	(6, 95, 1, '1', NULL, '2015-08-12 12:08:43'),
	(7, 5, 1, '1', NULL, '2015-08-12 12:09:17'),
	(8, 92, 1, '1', NULL, '2015-08-12 14:03:10'),
	(10, 92, 2, '1', NULL, '2015-08-12 15:10:46'),
	(12, 5, 2, '1', NULL, '2015-08-12 15:11:07');
/*!40000 ALTER TABLE `cursociclo` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.cursotipoestudio
CREATE TABLE IF NOT EXISTS `cursotipoestudio` (
  `CURSOTIPOP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CURSOCIP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TIPP_Codigo` int(11) NOT NULL DEFAULT '0',
  `CURSOTIPOC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  `CURSOTIPOC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `CURSOTIPOC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CURSOTIPOP_Codigo`),
  KEY `FK_cursotipoestudio_cursociclo` (`CURSOCIP_Codigo`),
  KEY `FK_cursotipoestudio_tipoestudio` (`TIPP_Codigo`),
  CONSTRAINT `FK_cursotipoestudio_cursociclo` FOREIGN KEY (`CURSOCIP_Codigo`) REFERENCES `cursociclo` (`CURSOCIP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_cursotipoestudio_tipoestudio` FOREIGN KEY (`TIPP_Codigo`) REFERENCES `tipoestudio` (`TIPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.cursotipoestudio: ~7 rows (aproximadamente)
DELETE FROM `cursotipoestudio`;
/*!40000 ALTER TABLE `cursotipoestudio` DISABLE KEYS */;
INSERT INTO `cursotipoestudio` (`CURSOTIPOP_Codigo`, `CURSOCIP_Codigo`, `TIPP_Codigo`, `CURSOTIPOC_FlagEstado`, `CURSOTIPOC_FechaModificacion`, `CURSOTIPOC_FechaRegistro`) VALUES
	(1, 4, 3, '1', '2015-08-12 18:31:34', '2015-08-12 15:47:29'),
	(2, 4, 4, '1', '2015-08-12 18:31:41', '2015-08-12 18:28:33'),
	(3, 4, 5, '1', NULL, '2015-08-12 18:31:53'),
	(4, 4, 6, '1', NULL, '2015-08-12 18:32:04'),
	(5, 4, 7, '1', '2015-08-12 18:32:25', '2015-08-12 18:32:18'),
	(6, 4, 8, '1', NULL, '2015-08-12 18:32:35');
/*!40000 ALTER TABLE `cursotipoestudio` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.matricula: ~6 rows (aproximadamente)
DELETE FROM `matricula`;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
INSERT INTO `matricula` (`ORDENP_Codigo`, `CICLOP_Codigo`, `CLIP_Codigo`, `AULAP_Codigo`, `TIPP_Codigo`, `ORDENC_Observacion`, `ORDENC_Fecot`, `ORDENC_FechaRegistro`, `ORDENC_FechaModificacion`, `ORDENC_FlagEstado`) VALUES
	(1, 2, 11, 13, 5, '0', '2015-05-15', '2015-05-15 13:30:53', '2015-08-06 00:00:00', '1'),
	(2, 2, 16, 15, 5, '0', '2015-05-22', '2015-05-23 07:35:12', '2015-05-29 00:00:00', '1'),
	(3, 2, 10, 5, 5, NULL, '2015-05-22', '2015-05-23 07:58:30', '2015-07-24 00:00:00', '1'),
	(4, 2, 5, 14, 5, NULL, '2015-07-24', '2015-07-23 17:33:32', '2015-07-24 00:00:00', '1'),
	(5, 1, 19, 14, 1, NULL, '2015-07-24', '2015-07-23 17:36:16', '2015-08-06 00:00:00', '1'),
	(6, 2, 18, 4, 3, NULL, '2015-08-06', '2015-08-05 19:47:27', '2015-08-06 00:00:00', '1');
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `MENU_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `MENU_Codigo_Padre` int(11) NOT NULL DEFAULT '0',
  `MENU_Descripcion` varchar(150) DEFAULT NULL,
  `MENU_Comentario` varchar(250) DEFAULT NULL,
  `MENU_Url` varchar(250) DEFAULT '#',
  `MENU_Orden` int(1) DEFAULT '1',
  `MENU_Imagen` varchar(100) DEFAULT NULL,
  `MENU_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `MENU_FechaModificacion` datetime DEFAULT NULL,
  `MENU_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`MENU_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.menu: ~30 rows (aproximadamente)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`MENU_Codigo`, `MENU_Codigo_Padre`, `MENU_Descripcion`, `MENU_Comentario`, `MENU_Url`, `MENU_Orden`, `MENU_Imagen`, `MENU_FechaRegistro`, `MENU_FechaModificacion`, `MENU_FlagEstado`) VALUES
	(2, 58, 'Maestro de Alumnos', 'Aquí se podrán subir las imágenes o aniamciones que serán contenidas en la marquesina', 'index.php/ventas/alumno/listar', 1, 'alumno.jpg', '2015-08-03 20:06:30', NULL, '1'),
	(3, 1, 'MANTENIMIENTOS', '', 'index.php/almacen/curso/listar', 1, 'libros.jpg', '2015-06-20 22:04:31', NULL, '1'),
	(4, 1, 'PROCESOS', '', 'index.php/ventas/orden/listar', 2, 'matri.jpg', '2015-08-12 15:34:09', NULL, '1'),
	(22, 75, 'Maestro de Cursos', 'Maestro de Cursos', 'index.php/almacen/curso/listar', 1, '', '2015-08-11 08:27:54', NULL, '1'),
	(48, 4, 'Matricula', 'Matricula', 'index.php/ventas/matricula/listar', 1, 'matri.jpg', '2015-07-24 22:52:04', NULL, '1'),
	(49, 4, 'Carga horaria', NULL, 'index.php/ventas/asignacion/listar', 1, NULL, '2015-05-17 10:10:56', NULL, '1'),
	(52, 3, 'Documentos', NULL, 'index.php/inicio/principal', 4, NULL, '2015-08-12 15:35:34', NULL, '1'),
	(53, 58, 'Maestro de Profesores', 'Tabla de Profesores', 'index.php/ventas/profesor/listar', 1, NULL, '2015-08-03 20:06:22', NULL, '1'),
	(55, 3, 'Ejemplo 1', 'Ejemplo 1', 'index.php/almacen/curso/listar', 1, NULL, '2015-04-02 20:40:06', NULL, '1'),
	(56, 3, 'Ejemplo 3', 'Ejemplo 3', 'index.php/almacen/curso/listar', 1, NULL, '2015-08-05 11:48:18', NULL, '1'),
	(57, 56, 'Ejemplo 5', 'Ejemplo 5', 'Ejemplo5', 1, NULL, '2015-04-02 21:18:33', NULL, '1'),
	(58, 3, 'Configuracion Personal', NULL, '#', 1, NULL, '2015-08-03 20:05:22', NULL, '1'),
	(59, 74, 'Aula', NULL, 'index.php/maestros/aula/listar', 1, NULL, '2015-08-11 08:24:34', NULL, '1'),
	(61, 74, 'Local', NULL, 'index.php/maestros/local/listar', 1, NULL, '2015-08-11 08:24:32', NULL, '1'),
	(62, 74, 'Ciclo', NULL, 'index.php/maestros/ciclo/listar', 1, NULL, '2015-08-11 08:22:00', NULL, '1'),
	(63, 74, 'Tipo Estudio ', NULL, 'index.php/maestros/tipoestudio/listar', 1, NULL, '2015-08-11 08:22:05', NULL, '1'),
	(64, 1, 'REPORTES Y CONSULTAS', NULL, NULL, 3, NULL, '2015-08-12 15:34:20', NULL, '1'),
	(65, 2, 'Alumnos pequeños', NULL, NULL, 1, NULL, '2015-06-20 23:06:16', NULL, '1'),
	(66, 58, 'Maestro de Usuarios', 'Usuarios', 'index.php/seguridad/usuario/listar', 1, NULL, '2015-08-03 20:05:56', NULL, '1'),
	(67, 4, 'Actas de reunion', 'Actas de reunion', 'index.php/ventas/acta/listar', 1, NULL, '2015-07-24 22:52:18', NULL, '1'),
	(68, 4, 'Tareas', 'Tareas', '#', 1, NULL, '2015-07-24 22:20:22', NULL, '1'),
	(69, 4, 'Vigilancia de examenes', 'Vigilancia de examenes', '#', 1, NULL, '2015-07-24 22:20:24', NULL, '1'),
	(70, 4, 'Asistencia de profesores', 'Asistencia de profesores', 'index.php/ventas/tareo/editar', 1, NULL, '2015-07-30 20:31:00', NULL, '1'),
	(71, 4, 'Asistencia de alumnos', 'Asistencia de alumnos', 'index.php/ventas/asistencia/editar', 1, NULL, '2015-07-30 22:19:35', NULL, '1'),
	(72, 74, 'Semana', 'Semana', 'index.php/almacen/semana/listar', 1, NULL, '2015-08-11 08:22:08', NULL, '1'),
	(73, 75, 'Maestro de Temas', 'Maestro de Temas', 'index.php/almacen/tema/listar', 4, NULL, '2015-08-12 15:29:17', NULL, '1'),
	(74, 3, 'Configuracion Sistema', 'Configuracion Sistema', '#', 3, NULL, '2015-08-12 15:35:19', NULL, '1'),
	(75, 3, 'Configuracion Cursos', 'Configuracion Cursos', '#', 2, NULL, '2015-08-12 15:35:17', NULL, '1'),
	(76, 75, 'Maestro de Cursos Ciclo', 'Maestro de Cursos Ciclo', 'index.php/almacen/cursociclo/listar', 2, NULL, '2015-08-12 15:28:56', NULL, '1'),
	(77, 75, 'Maestro de Cursos Tipo', 'Maestro de Cursos Tipo', 'index.php/almacen/cursotipoestudio/listar', 3, NULL, '2015-08-12 16:08:25', NULL, '1');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.nacionalidad
CREATE TABLE IF NOT EXISTS `nacionalidad` (
  `NACP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `COMPP_Codigo` int(11) DEFAULT NULL,
  `NACC_Descripcion` varchar(150) DEFAULT NULL,
  `NACC_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`NACP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=274 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.nacionalidad: ~274 rows (aproximadamente)
DELETE FROM `nacionalidad`;
/*!40000 ALTER TABLE `nacionalidad` DISABLE KEYS */;
INSERT INTO `nacionalidad` (`NACP_Codigo`, `COMPP_Codigo`, `NACC_Descripcion`, `NACC_FechaRegistro`) VALUES
	(0, 1, '::Seleccione::', '2014-10-06 04:27:07'),
	(1, 1, 'BOUVET ISLAND', '2010-12-13 17:54:36'),
	(2, 1, 'COTE D IVOIRE', '2010-12-13 17:54:36'),
	(3, 1, 'FALKLAND ISLANDS (MALVINAS)', '2010-12-13 17:54:36'),
	(4, 1, 'FRANCE, METROPOLITAN', '2010-12-13 17:54:36'),
	(5, 1, 'FRENCH SOUTHERN TERRITORIES', '2010-12-13 17:54:36'),
	(6, 1, 'HEARD AND MC DONALD ISLANDS', '2010-12-13 17:54:36'),
	(7, 1, 'MAYOTTE', '2010-12-13 17:54:36'),
	(8, 1, 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', '2010-12-13 17:54:36'),
	(9, 1, 'SVALBARD AND JAN MAYEN ISLANDS', '2010-12-13 17:54:36'),
	(10, 1, 'UNITED STATES MINOR OUTLYING ISLANDS', '2010-12-13 17:54:36'),
	(11, 1, 'OTROS PAISES O LUGARES', '2010-12-13 17:54:36'),
	(12, 1, 'AFGANISTAN', '2010-12-13 17:54:36'),
	(13, 1, 'ALBANIA', '2010-12-13 17:54:36'),
	(14, 1, 'ALDERNEY', '2010-12-13 17:54:36'),
	(15, 1, 'ALEMANIA', '2010-12-13 17:54:36'),
	(16, 1, 'ARMENIA', '2010-12-13 17:54:36'),
	(17, 1, 'ARUBA', '2010-12-13 17:54:36'),
	(18, 1, 'ASCENCION', '2010-12-13 17:54:36'),
	(19, 1, 'BOSNIA-HERZEGOVINA', '2010-12-13 17:54:36'),
	(20, 1, 'BURKINA FASO', '2010-12-13 17:54:36'),
	(21, 1, 'ANDORRA', '2010-12-13 17:54:36'),
	(22, 1, 'ANGOLA', '2010-12-13 17:54:36'),
	(23, 1, 'ANGUILLA', '2010-12-13 17:54:36'),
	(24, 1, 'ANTIGUA Y BARBUDA', '2010-12-13 17:54:36'),
	(25, 1, 'ANTILLAS HOLANDESAS', '2010-12-13 17:54:36'),
	(26, 1, 'ARABIA SAUDITA', '2010-12-13 17:54:36'),
	(27, 1, 'ARGELIA', '2010-12-13 17:54:36'),
	(28, 1, 'ARGENTINA', '2010-12-13 17:54:36'),
	(29, 1, 'AUSTRALIA', '2010-12-13 17:54:36'),
	(30, 1, 'AUSTRIA', '2010-12-13 17:54:36'),
	(31, 1, 'AZERBAIJÁN', '2010-12-13 17:54:36'),
	(32, 1, 'BAHAMAS', '2010-12-13 17:54:36'),
	(33, 1, 'BAHREIN', '2010-12-13 17:54:36'),
	(34, 1, 'BANGLA DESH', '2010-12-13 17:54:36'),
	(35, 1, 'BARBADOS', '2010-12-13 17:54:36'),
	(36, 1, 'BÉLGICA', '2010-12-13 17:54:36'),
	(37, 1, 'BELICE', '2010-12-13 17:54:36'),
	(38, 1, 'BERMUDAS', '2010-12-13 17:54:36'),
	(39, 1, 'BELARUS', '2010-12-13 17:54:36'),
	(40, 1, 'MYANMAR', '2010-12-13 17:54:36'),
	(41, 1, 'BOLIVIA', '2010-12-13 17:54:36'),
	(42, 1, 'BOTSWANA', '2010-12-13 17:54:36'),
	(43, 1, 'BRASIL', '2010-12-13 17:54:36'),
	(44, 1, 'BRUNEI DARUSSALAM', '2010-12-13 17:54:36'),
	(45, 1, 'BULGARIA', '2010-12-13 17:54:36'),
	(46, 1, 'BURUNDI', '2010-12-13 17:54:36'),
	(47, 1, 'BUTÁN', '2010-12-13 17:54:36'),
	(48, 1, 'CABO VERDE', '2010-12-13 17:54:36'),
	(49, 1, 'CAIMÁN, ISLAS', '2010-12-13 17:54:36'),
	(50, 1, 'CAMBOYA', '2010-12-13 17:54:36'),
	(51, 1, 'CAMERÚN, REPUBLICA UNIDA DEL', '2010-12-13 17:54:36'),
	(52, 1, 'CAMPIONE D TALIA', '2010-12-13 17:54:36'),
	(53, 1, 'CANADÁ', '2010-12-13 17:54:36'),
	(54, 1, 'CANAL (NORMANDAS), ISLAS', '2010-12-13 17:54:36'),
	(55, 1, 'CANTÓN Y ENDERBURRY', '2010-12-13 17:54:36'),
	(56, 1, 'SANTA SEDE', '2010-12-13 17:54:36'),
	(57, 1, 'COCOS (KEELING),ISLAS', '2010-12-13 17:54:36'),
	(58, 1, 'COLOMBIA', '2010-12-13 17:54:36'),
	(59, 1, 'COMORAS', '2010-12-13 17:54:36'),
	(60, 1, 'CONGO', '2010-12-13 17:54:36'),
	(61, 1, 'COOK, ISLAS', '2010-12-13 17:54:36'),
	(62, 1, 'COREA (NORTE), REPUBLICA POPULAR DEMOCRATICA DE', '2010-12-13 17:54:36'),
	(63, 1, 'COREA (SUR), REPUBLICA DE', '2010-12-13 17:54:36'),
	(64, 1, 'COSTA DE MARFIL', '2010-12-13 17:54:36'),
	(65, 1, 'COSTA RICA', '2010-12-13 17:54:36'),
	(66, 1, 'CROACIA', '2010-12-13 17:54:36'),
	(67, 1, 'CUBA', '2010-12-13 17:54:36'),
	(68, 1, 'CHAD', '2010-12-13 17:54:36'),
	(69, 1, 'CHECOSLOVAQUIA', '2010-12-13 17:54:36'),
	(70, 1, 'CHILE', '2010-12-13 17:54:36'),
	(71, 1, 'CHINA', '2010-12-13 17:54:36'),
	(72, 1, 'TAIWAN (FORMOSA)', '2010-12-13 17:54:36'),
	(73, 1, 'CHIPRE', '2010-12-13 17:54:36'),
	(74, 1, 'BENIN', '2010-12-13 17:54:36'),
	(75, 1, 'DINAMARCA', '2010-12-13 17:54:36'),
	(76, 1, 'DOMINICA', '2010-12-13 17:54:36'),
	(77, 1, 'ECUADOR', '2010-12-13 17:54:36'),
	(78, 1, 'EGIPTO', '2010-12-13 17:54:36'),
	(79, 1, 'EL SALVADOR', '2010-12-13 17:54:36'),
	(80, 1, 'ERITREA', '2010-12-13 17:54:36'),
	(81, 1, 'EMIRATOS ARABES UNIDOS', '2010-12-13 17:54:36'),
	(82, 1, 'ESPANA', '2010-12-13 17:54:36'),
	(83, 1, 'ESLOVAQUIA', '2010-12-13 17:54:36'),
	(84, 1, 'ESLOVENIA', '2010-12-13 17:54:36'),
	(85, 1, 'ESTADOS UNIDOS', '2010-12-13 17:54:36'),
	(86, 1, 'ESTONIA', '2010-12-13 17:54:36'),
	(87, 1, 'ETIOPIA', '2010-12-13 17:54:36'),
	(88, 1, 'FEROE, ISLAS', '2010-12-13 17:54:36'),
	(89, 1, 'FILIPINAS', '2010-12-13 17:54:36'),
	(90, 1, 'FINLANDIA', '2010-12-13 17:54:36'),
	(91, 1, 'FRANCIA', '2010-12-13 17:54:36'),
	(92, 1, 'GABON', '2010-12-13 17:54:36'),
	(93, 1, 'GAMBIA', '2010-12-13 17:54:36'),
	(94, 1, 'GAZA Y JERICO', '2010-12-13 17:54:36'),
	(95, 1, 'GEORGIA', '2010-12-13 17:54:36'),
	(96, 1, 'GHANA', '2010-12-13 17:54:36'),
	(97, 1, 'GIBRALTAR', '2010-12-13 17:54:36'),
	(98, 1, 'GRANADA', '2010-12-13 17:54:36'),
	(99, 1, 'GRECIA', '2010-12-13 17:54:36'),
	(100, 1, 'GROENLANDIA', '2010-12-13 17:54:36'),
	(101, 1, 'GUADALUPE', '2010-12-13 17:54:36'),
	(102, 1, 'GUAM', '2010-12-13 17:54:36'),
	(103, 1, 'GUATEMALA', '2010-12-13 17:54:36'),
	(104, 1, 'GUAYANA FRANCESA', '2010-12-13 17:54:36'),
	(105, 1, 'GUERNSEY', '2010-12-13 17:54:36'),
	(106, 1, 'GUINEA', '2010-12-13 17:54:36'),
	(107, 1, 'GUINEA ECUATORIAL', '2010-12-13 17:54:36'),
	(108, 1, 'GUINEA-BISSAU', '2010-12-13 17:54:36'),
	(109, 1, 'GUYANA', '2010-12-13 17:54:36'),
	(110, 1, 'HAITI', '2010-12-13 17:54:36'),
	(111, 1, 'HONDURAS', '2010-12-13 17:54:36'),
	(112, 1, 'HONDURAS BRITANICAS', '2010-12-13 17:54:36'),
	(113, 1, 'HONG KONG', '2010-12-13 17:54:36'),
	(114, 1, 'HUNGRIA', '2010-12-13 17:54:36'),
	(115, 1, 'INDIA', '2010-12-13 17:54:36'),
	(116, 1, 'INDONESIA', '2010-12-13 17:54:36'),
	(117, 1, 'IRAK', '2010-12-13 17:54:36'),
	(118, 1, 'IRAN, REPUBLICA ISLAMICA DEL', '2010-12-13 17:54:36'),
	(119, 1, 'IRLANDA (EIRE)', '2010-12-13 17:54:36'),
	(120, 1, 'ISLA AZORES', '2010-12-13 17:54:36'),
	(121, 1, 'ISLA DEL MAN', '2010-12-13 17:54:36'),
	(122, 1, 'ISLANDIA', '2010-12-13 17:54:36'),
	(123, 1, 'ISLAS CANARIAS', '2010-12-13 17:54:36'),
	(124, 1, 'ISLAS DE CHRISTMAS', '2010-12-13 17:54:36'),
	(125, 1, 'ISLAS QESHM', '2010-12-13 17:54:36'),
	(126, 1, 'ISRAEL', '2010-12-13 17:54:36'),
	(127, 1, 'ITALIA', '2010-12-13 17:54:36'),
	(128, 1, 'JAMAICA', '2010-12-13 17:54:36'),
	(129, 1, 'JONSTON, ISLAS', '2010-12-13 17:54:36'),
	(130, 1, 'JAPON', '2010-12-13 17:54:36'),
	(131, 1, 'JERSEY', '2010-12-13 17:54:36'),
	(132, 1, 'JORDANIA', '2010-12-13 17:54:36'),
	(133, 1, 'KAZAJSTAN', '2010-12-13 17:54:36'),
	(134, 1, 'KENIA', '2010-12-13 17:54:36'),
	(135, 1, 'KIRIBATI', '2010-12-13 17:54:36'),
	(136, 1, 'KIRGUIZISTAN', '2010-12-13 17:54:36'),
	(137, 1, 'KUWAIT', '2010-12-13 17:54:36'),
	(138, 1, 'LABUN', '2010-12-13 17:54:36'),
	(139, 1, 'LAOS, REPUBLICA POPULAR DEMOCRATICA DE', '2010-12-13 17:54:36'),
	(140, 1, 'LESOTHO', '2010-12-13 17:54:36'),
	(141, 1, 'LETONIA', '2010-12-13 17:54:36'),
	(142, 1, 'LIBANO', '2010-12-13 17:54:36'),
	(143, 1, 'LIBERIA', '2010-12-13 17:54:36'),
	(144, 1, 'LIBIA', '2010-12-13 17:54:36'),
	(145, 1, 'LIECHTENSTEIN', '2010-12-13 17:54:36'),
	(146, 1, 'LITUANIA', '2010-12-13 17:54:36'),
	(147, 1, 'LUXEMBURGO', '2010-12-13 17:54:36'),
	(148, 1, 'MACAO', '2010-12-13 17:54:36'),
	(149, 1, 'MACEDONIA', '2010-12-13 17:54:36'),
	(150, 1, 'MADAGASCAR', '2010-12-13 17:54:36'),
	(151, 1, 'MADEIRA', '2010-12-13 17:54:36'),
	(152, 1, 'MALAYSIA', '2010-12-13 17:54:36'),
	(153, 1, 'MALAWI', '2010-12-13 17:54:36'),
	(154, 1, 'MALDIVAS', '2010-12-13 17:54:36'),
	(155, 1, 'MALI', '2010-12-13 17:54:36'),
	(156, 1, 'MALTA', '2010-12-13 17:54:36'),
	(157, 1, 'MARIANAS DEL NORTE, ISLAS', '2010-12-13 17:54:36'),
	(158, 1, 'MARSHALL, ISLAS', '2010-12-13 17:54:36'),
	(159, 1, 'MARRUECOS', '2010-12-13 17:54:36'),
	(160, 1, 'MARTINICA', '2010-12-13 17:54:36'),
	(161, 1, 'MAURICIO', '2010-12-13 17:54:36'),
	(162, 1, 'MAURITANIA', '2010-12-13 17:54:36'),
	(163, 1, 'MEXICO', '2010-12-13 17:54:36'),
	(164, 1, 'MICRONESIA, ESTADOS FEDERADOS DE', '2010-12-13 17:54:36'),
	(165, 1, 'MIDWAY ISLAS', '2010-12-13 17:54:36'),
	(166, 1, 'MOLDAVIA', '2010-12-13 17:54:36'),
	(167, 1, 'MONGOLIA', '2010-12-13 17:54:36'),
	(168, 1, 'MONACO', '2010-12-13 17:54:36'),
	(169, 1, 'MONTSERRAT, ISLA', '2010-12-13 17:54:36'),
	(170, 1, 'MOZAMBIQUE', '2010-12-13 17:54:36'),
	(171, 1, 'NAMIBIA', '2010-12-13 17:54:36'),
	(172, 1, 'NAURU', '2010-12-13 17:54:36'),
	(173, 1, 'NAVIDAD (CHRISTMAS), ISLA', '2010-12-13 17:54:36'),
	(174, 1, 'NEPAL', '2010-12-13 17:54:36'),
	(175, 1, 'NICARAGUA', '2010-12-13 17:54:36'),
	(176, 1, 'NIGER', '2010-12-13 17:54:36'),
	(177, 1, 'NIGERIA', '2010-12-13 17:54:36'),
	(178, 1, 'NIUE, ISLA', '2010-12-13 17:54:36'),
	(179, 1, 'NORFOLK, ISLA', '2010-12-13 17:54:36'),
	(180, 1, 'NORUEGA', '2010-12-13 17:54:36'),
	(181, 1, 'NUEVA CALEDONIA', '2010-12-13 17:54:36'),
	(182, 1, 'PAPUASIA NUEVA GUINEA', '2010-12-13 17:54:36'),
	(183, 1, 'NUEVA ZELANDA', '2010-12-13 17:54:36'),
	(184, 1, 'VANUATU', '2010-12-13 17:54:36'),
	(185, 1, 'OMAN', '2010-12-13 17:54:36'),
	(186, 1, 'PACIFICO, ISLAS DEL', '2010-12-13 17:54:36'),
	(187, 1, 'PAISES BAJOS', '2010-12-13 17:54:36'),
	(188, 1, 'PAKISTAN', '2010-12-13 17:54:36'),
	(189, 1, 'PALAU, ISLAS', '2010-12-13 17:54:36'),
	(190, 1, 'TERRITORIO AUTONOMO DE PALESTINA.', '2010-12-13 17:54:36'),
	(191, 1, 'PANAMA', '2010-12-13 17:54:36'),
	(192, 1, 'PARAGUAY', '2010-12-13 17:54:36'),
	(193, 1, 'PERÚ', '2010-12-13 17:54:36'),
	(194, 1, 'PITCAIRN, ISLA', '2010-12-13 17:54:36'),
	(195, 1, 'POLINESIA FRANCESA', '2010-12-13 17:54:36'),
	(196, 1, 'POLONIA', '2010-12-13 17:54:36'),
	(197, 1, 'PORTUGAL', '2010-12-13 17:54:36'),
	(198, 1, 'PUERTO RICO', '2010-12-13 17:54:36'),
	(199, 1, 'QATAR', '2010-12-13 17:54:36'),
	(200, 1, 'REINO UNIDO', '2010-12-13 17:54:36'),
	(201, 1, 'ESCOCIA', '2010-12-13 17:54:36'),
	(202, 1, 'REPUBLICA ARABE UNIDA', '2010-12-13 17:54:36'),
	(203, 1, 'REPUBLICA CENTROAFRICANA', '2010-12-13 17:54:36'),
	(204, 1, 'REPUBLICA CHECA', '2010-12-13 17:54:36'),
	(205, 1, 'REPUBLICA DE SWAZILANDIA', '2010-12-13 17:54:36'),
	(206, 1, 'REPUBLICA DE TUNEZ', '2010-12-13 17:54:36'),
	(207, 1, 'REPUBLICA DOMINICANA', '2010-12-13 17:54:36'),
	(208, 1, 'REUNION', '2010-12-13 17:54:36'),
	(209, 1, 'ZIMBABWE', '2010-12-13 17:54:36'),
	(210, 1, 'RUMANIA', '2010-12-13 17:54:36'),
	(211, 1, 'RUANDA', '2010-12-13 17:54:36'),
	(212, 1, 'RUSIA', '2010-12-13 17:54:36'),
	(213, 1, 'SALOMON, ISLAS', '2010-12-13 17:54:36'),
	(214, 1, 'SAHARA OCCIDENTAL', '2010-12-13 17:54:36'),
	(215, 1, 'SAMOA OCCIDENTAL', '2010-12-13 17:54:36'),
	(216, 1, 'SAMOA NORTEAMERICANA', '2010-12-13 17:54:36'),
	(217, 1, 'SAN CRISTOBAL Y NIEVES', '2010-12-13 17:54:36'),
	(218, 1, 'SAN MARINO', '2010-12-13 17:54:36'),
	(219, 1, 'SAN PEDRO Y MIQUELON', '2010-12-13 17:54:36'),
	(220, 1, 'SAN VICENTE Y LAS GRANADINAS', '2010-12-13 17:54:36'),
	(221, 1, 'SANTA ELENA', '2010-12-13 17:54:36'),
	(222, 1, 'SANTA LUCIA', '2010-12-13 17:54:36'),
	(223, 1, 'SANTO TOME Y PRINCIPE', '2010-12-13 17:54:36'),
	(224, 1, 'SENEGAL', '2010-12-13 17:54:36'),
	(225, 1, 'SEYCHELLES', '2010-12-13 17:54:36'),
	(226, 1, 'SIERRA LEONA', '2010-12-13 17:54:36'),
	(227, 1, 'SINGAPUR', '2010-12-13 17:54:36'),
	(228, 1, 'SIRIA, REPUBLICA ARABE DE', '2010-12-13 17:54:36'),
	(229, 1, 'SOMALIA', '2010-12-13 17:54:36'),
	(230, 1, 'SRI LANKA', '2010-12-13 17:54:36'),
	(231, 1, 'SUDAFRICA, REPUBLICA DE', '2010-12-13 17:54:36'),
	(232, 1, 'SUDAN', '2010-12-13 17:54:36'),
	(233, 1, 'SUECIA', '2010-12-13 17:54:36'),
	(234, 1, 'SUIZA', '2010-12-13 17:54:36'),
	(235, 1, 'SURINAM', '2010-12-13 17:54:36'),
	(236, 1, 'SAWSILANDIA', '2010-12-13 17:54:36'),
	(237, 1, 'TADJIKISTAN', '2010-12-13 17:54:36'),
	(238, 1, 'TAILANDIA', '2010-12-13 17:54:36'),
	(239, 1, 'TANZANIA, REPUBLICA UNIDA DE', '2010-12-13 17:54:36'),
	(240, 1, 'DJIBOUTI', '2010-12-13 17:54:36'),
	(241, 1, 'TERRITORIO ANTARTICO BRITANICO', '2010-12-13 17:54:36'),
	(242, 1, 'TERRITORIO BRITANICO DEL OCEANO INDICO', '2010-12-13 17:54:36'),
	(243, 1, 'TIMOR DEL ESTE', '2010-12-13 17:54:36'),
	(244, 1, 'TOGO', '2010-12-13 17:54:36'),
	(245, 1, 'TOKELAU', '2010-12-13 17:54:36'),
	(246, 1, 'TONGA', '2010-12-13 17:54:36'),
	(247, 1, 'TRINIDAD Y TOBAGO', '2010-12-13 17:54:36'),
	(248, 1, 'TRISTAN DA CUNHA', '2010-12-13 17:54:36'),
	(249, 1, 'TUNICIA', '2010-12-13 17:54:36'),
	(250, 1, 'TURCAS Y CAICOS, ISLAS', '2010-12-13 17:54:36'),
	(251, 1, 'TURKMENISTAN', '2010-12-13 17:54:36'),
	(252, 1, 'TURQUIA', '2010-12-13 17:54:36'),
	(253, 1, 'TUVALU', '2010-12-13 17:54:36'),
	(254, 1, 'UCRANIA', '2010-12-13 17:54:36'),
	(255, 1, 'UGANDA', '2010-12-13 17:54:36'),
	(256, 1, 'URSS', '2010-12-13 17:54:36'),
	(257, 1, 'URUGUAY', '2010-12-13 17:54:36'),
	(258, 1, 'UZBEKISTAN', '2010-12-13 17:54:36'),
	(259, 1, 'VENEZUELA', '2010-12-13 17:54:36'),
	(260, 1, 'VIET NAM', '2010-12-13 17:54:36'),
	(261, 1, 'VIETNAM (DEL NORTE)', '2010-12-13 17:54:36'),
	(262, 1, 'VIRGENES, ISLAS (BRITANICAS)', '2010-12-13 17:54:36'),
	(263, 1, 'VIRGENES, ISLAS (NORTEAMERICANAS)', '2010-12-13 17:54:36'),
	(264, 1, 'FIJI', '2010-12-13 17:54:36'),
	(265, 1, 'WAKE, ISLA', '2010-12-13 17:54:36'),
	(266, 1, 'WALLIS Y FORTUNA, ISLAS', '2010-12-13 17:54:36'),
	(267, 1, 'YEMEN', '2010-12-13 17:54:36'),
	(268, 1, 'YUGOSLAVIA', '2010-12-13 17:54:36'),
	(269, 1, 'ZAIRE', '2010-12-13 17:54:36'),
	(270, 1, 'ZAMBIA', '2010-12-13 17:54:36'),
	(271, 1, 'ZONA DEL CANAL DE PANAMA', '2010-12-13 17:54:36'),
	(272, 1, 'ZONA LIBRE OSTRAVA', '2010-12-13 17:54:36'),
	(273, 1, 'ZONA NEUTRAL (PALESTINA)', '2010-12-13 17:54:36');
/*!40000 ALTER TABLE `nacionalidad` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.permiso
CREATE TABLE IF NOT EXISTS `permiso` (
  `PERM_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `ROL_Codigo` int(11) NOT NULL,
  `MENU_Codigo` int(11) NOT NULL,
  `PERM_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`PERM_Codigo`),
  UNIQUE KEY `ROL_Codigo_MENU_Codigo` (`ROL_Codigo`,`MENU_Codigo`),
  KEY `FK_cji_permiso_cji_menu` (`MENU_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.permiso: ~28 rows (aproximadamente)
DELETE FROM `permiso`;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` (`PERM_Codigo`, `ROL_Codigo`, `MENU_Codigo`, `PERM_FlagEstado`) VALUES
	(2, 4, 2, '1'),
	(4, 4, 3, '1'),
	(5, 4, 4, '1'),
	(29, 4, 22, '1'),
	(32, 4, 48, '1'),
	(33, 4, 49, '1'),
	(38, 4, 52, '1'),
	(39, 4, 53, '1'),
	(45, 4, 57, '1'),
	(46, 4, 58, '1'),
	(47, 4, 59, '1'),
	(48, 4, 61, '1'),
	(49, 4, 62, '1'),
	(50, 4, 63, '1'),
	(51, 4, 64, '1'),
	(52, 4, 65, '1'),
	(53, 4, 66, '1'),
	(54, 4, 67, '1'),
	(55, 4, 68, '1'),
	(56, 4, 69, '1'),
	(57, 4, 70, '1'),
	(58, 4, 71, '1'),
	(59, 4, 72, '1'),
	(60, 4, 73, '1'),
	(61, 4, 74, '1'),
	(62, 4, 75, '1'),
	(63, 4, 76, '1'),
	(64, 4, 77, '1');
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `PERSP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `TIPDOCP_Codigo` int(11) NOT NULL DEFAULT '0',
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
  `PERSC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `PERSC_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`PERSP_Codigo`),
  KEY `FK_persona_tipodocumento` (`TIPDOCP_Codigo`),
  CONSTRAINT `FK_persona_tipodocumento` FOREIGN KEY (`TIPDOCP_Codigo`) REFERENCES `tipodocumento` (`TIPDOCP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.persona: ~23 rows (aproximadamente)
DELETE FROM `persona`;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`PERSP_Codigo`, `TIPDOCP_Codigo`, `PERSC_ApellidoPaterno`, `PERSC_ApellidoMaterno`, `PERSC_Nombre`, `PERSC_NumeroDocIdentidad`, `PERSC_Direccion`, `PERSC_Telefono`, `PERSC_Movil`, `PERSC_Fax`, `PERSC_Email`, `PERSC_Domicilio`, `PERSC_Web`, `PERSC_Sexo`, `PERSC_FechaNacimiento`, `PERSC_FechaRegistro`, `PERSC_FechaModificacion`, `PERSC_FlagEstado`) VALUES
	(1, 1, 'DOLORES', 'FLORES', 'MARIA', '0', '0', '0', '0', '0', '', '0', '0', '0', '0000-00-00', '2010-12-29 20:15:19', '2015-08-05 11:53:24', '1'),
	(63, 1, 'GOMEZ  ', 'PEREZ ', 'EDUARDO EDUARDOGF', '45645667', '', '234423', '0', '0', 'eduardo@banich.com', '', '0', '0', '2015-05-03', '2011-08-13 09:32:02', '2015-08-05 00:27:56', '1'),
	(71, 1, 'PEREZ', 'AGUILAR ', 'MARIA', '40091852', 'AV PERU', '456465', '0', '0', 'maria.aguilar@hotmail.com', 'AV PERU', '0', '0', '2014-02-05', '2014-10-21 05:23:51', '2015-08-05 00:27:56', '1'),
	(73, 1, 'RODRIGUEZ', 'MEDRANO', 'ELISEO', '40003256', 'LOS GIRASOLES 4125', '234234/43223434', '0', '0', 'luis.arnaldo@hotmail.com', 'LOS GIRASOLES 4125', '0', '0', '2014-05-11', '2014-10-28 02:15:16', '2015-08-05 00:27:56', '1'),
	(80, 1, 'CANAZAS 2', 'QUISPE', 'RUTHCIÃ±A', '40091814', 'MZ R LOTE 50 LOS NISPEROS', '34234242', '0', '0', 'martin@trujillo.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-12-01', '2014-10-30 07:52:00', '2015-08-05 00:27:56', '1'),
	(81, 1, 'VARGAS', 'RUIZ', 'ELIZABETH', '21321321', 'MIMCO', 'sdfgdsfgdf', '0', '0', '', 'MIMCO', '0', '0', '0000-00-00', '2014-10-30 07:53:05', '2015-08-05 00:27:56', '1'),
	(82, 1, 'PEREZ', 'GUZMAN', 'ROBERTO', '45645654', 'MZ P LOTE 15 LOS ALAMAMO', '2342342343', '0', '0', 'roberto.perez@hotmail.com', 'MZ P LOTE 15 LOS ALAMAMO', '0', '0', '1992-03-02', '2014-12-19 17:36:43', '2015-08-05 00:27:56', '1'),
	(87, 1, 'PAREDES', 'GONZALES', 'ETHEL', '45645645', 'ASFASFF', '343243', '0', '0', 'ethel.gonzales@hotmail.com', 'ASFASFF', '0', '0', '1997-12-02', '2014-12-23 02:03:35', '2015-08-05 00:27:56', '1'),
	(88, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'AV. ABANCAY 986 S.M.P.', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'AV. ABANCAY 986 S.M.P.', '0', '0', '1980-03-19', '2015-03-21 11:32:00', '2015-08-05 00:27:56', '1'),
	(89, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'ABANCAY 986 SMP', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'ABANCAY 986 SMP', '0', '0', '2015-03-18', '2015-03-21 11:32:58', '2015-08-05 00:27:56', '1'),
	(90, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'AV. ABANCAY 986 SMP', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'AV. ABANCAY 986 SMP', '0', '0', '2015-03-11', '2015-03-21 11:36:29', '2015-08-05 00:27:56', '1'),
	(91, 1, 'FIGUERO', 'MALDONADO', 'EDWARD', '32424234', 'SAN MARTIN DE PORRES', '21231123', '0', '0', 'edward.figueroa@gmail.com', 'SAN MARTIN DE PORRES', '0', '0', '2015-05-26', '2015-04-04 15:07:59', '2015-08-05 00:27:56', '1'),
	(92, 1, 'PEREZ DOVAL', 'SANDOVAL', 'DALEANA', '12341234', 'MZ R LOTE 50 LOS NISPEROS', '34324234', '0', '0', 'miriam@hotmail.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-04-22', '2015-05-09 12:39:23', '2015-08-05 00:27:56', '1'),
	(93, 1, 'VASQUEZ', 'DOMINGUEZ', 'RIQUELMER', '0', '0', '0', '0', '0', '', '0', '0', '0', '0000-00-00', '2015-05-16 12:23:59', '2015-08-05 18:52:51', '1'),
	(94, 1, 'AREVALO', 'VILLANUEVA', 'MANUEL', '234234', 'mz r lote 50 Los Nisperos', '324234324', '2', '0', 'martin_trujillo1105@hotmail.com', 'mz r lote 50 Los Nisperos', '0', '1', '0000-00-00', '2015-05-16 12:25:47', '2015-08-05 18:57:19', '1'),
	(95, 1, 'PEREZ', 'PEREZ', 'GUSTAVO', '12341234', 'MZ R LOTE ', '342344', '0', '0', 'gusta.perez@gmail.com', 'MZ R LOTE ', '0', '0', '2015-05-12', '2015-05-16 23:25:12', '2015-08-05 00:27:56', '1'),
	(96, 1, 'AAA', 'BBBB', 'CCCCOCO', '41234321', 'WER', '34234', '0', '0', '', 'WER', '0', '0', '2015-05-26', '2015-05-30 05:29:13', '2015-08-05 00:27:56', '1'),
	(97, 1, 'TRUJILLO ', ' BUSTAMANTE', 'HERNÃ¡N ', '0', '0', '0', '0', '0', '', '0', '0', '0', '0000-00-00', '2015-05-30 05:31:56', '2015-08-05 18:43:25', '1'),
	(98, 1, 'PLANAS', 'VIGO', 'PEDRO', '24353453', 'ASDFSADF', '34234234234', '0', '0', 'pedro.planas@gmail.com', 'ASDFSADF', '0', '0', '2015-07-21', '2015-07-27 16:08:29', '2015-08-05 00:27:56', '1'),
	(99, 1, 'NICOMEDES', 'PLACENCIA', 'HUGO', '2342342', 'MZ R LOTE 50 LOS NISPEROS', '23424234', '0', '0', 'hugo.placencia@gmail.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-07-23', '2015-07-27 16:09:18', '2015-08-05 00:27:56', '1'),
	(100, 1, 'BONIFACIO', 'VILLA', 'JESUS', '435345', 'MZ R LOTE 50 LOS NISPEROS', '324234234', '0', '0', 'jesus.bonifacio@gmail.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-07-10', '2015-07-27 16:12:47', '2015-08-05 00:27:56', '1'),
	(101, 1, 'RODRIGUEZ', 'RICARDO', 'ROLANDO', '0', '0', '0', '0', '0', '', '0', '0', '0', '0000-00-00', '2015-07-27 16:14:37', '2015-08-05 18:52:58', '1'),
	(136, 0, 'sanchez', 'calderon', 'josefina', '0', '0', '0', '0', '0', '', '0', '0', '0', '0000-00-00', '2015-08-05 18:53:28', NULL, '1');
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
  `PROD_Codigo` int(11) NOT NULL,
  `PERSP_Codigo` int(11) NOT NULL,
  `PROC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `PROC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PROC_FlagCoordinador` int(1) NOT NULL DEFAULT '2' COMMENT '1:Coordinador;2:Profesor',
  `PROC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`PROP_Codigo`),
  UNIQUE KEY `PERSP_Codigo` (`PERSP_Codigo`),
  KEY `FK_profesor_persona` (`PERSP_Codigo`),
  KEY `FK_profesor_curso` (`PROD_Codigo`),
  CONSTRAINT `FK_profesor_curso` FOREIGN KEY (`PROD_Codigo`) REFERENCES `curso` (`PROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_profesor_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.profesor: ~9 rows (aproximadamente)
DELETE FROM `profesor`;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` (`PROP_Codigo`, `PROD_Codigo`, `PERSP_Codigo`, `PROC_FechaModificacion`, `PROC_FechaRegistro`, `PROC_FlagCoordinador`, `PROC_FlagEstado`) VALUES
	(4, 92, 90, '2015-03-21 00:00:00', '2015-03-21 09:00:24', 2, '1'),
	(5, 93, 91, '2015-05-16 00:00:00', '2015-05-16 09:00:24', 2, '1'),
	(6, 93, 93, '2015-05-16 00:00:00', '2015-05-16 12:24:00', 2, '1'),
	(7, 95, 94, '2015-08-06 02:24:42', '2015-05-16 12:25:47', 1, '1'),
	(8, 5, 97, '2015-08-05 08:16:46', '2015-05-30 05:31:56', 1, '1'),
	(9, 5, 98, '2015-07-27 00:00:00', '2015-07-27 16:08:29', 2, '1'),
	(10, 5, 99, '2015-07-27 00:00:00', '2015-07-27 16:09:18', 2, '1'),
	(11, 92, 100, '2015-07-31 00:00:00', '2015-07-27 16:12:47', 2, '1'),
	(12, 95, 101, '2015-07-27 00:00:00', '2015-07-27 16:14:37', 2, '1');
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
  `ROL_Descripcion` varchar(150) DEFAULT NULL,
  `ROL_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ROL_FechaModificacion` datetime DEFAULT NULL,
  `ROL_FlagEstado` char(1) DEFAULT '1',
  PRIMARY KEY (`ROL_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.rol: ~6 rows (aproximadamente)
DELETE FROM `rol`;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`ROL_Codigo`, `ROL_Descripcion`, `ROL_FechaRegistro`, `ROL_FechaModificacion`, `ROL_FlagEstado`) VALUES
	(0, ':::Seleccione:::', '2015-08-05 16:08:09', NULL, '1'),
	(1, 'Profesor', '2015-08-03 23:34:42', NULL, '1'),
	(4, 'Directora', '2015-08-05 12:14:12', NULL, '1'),
	(5, 'Contador', '2015-08-05 12:14:21', NULL, '1'),
	(6, 'Coordinador de plana', '2015-05-16 11:09:41', NULL, '1'),
	(7, 'Coordinador general', '2015-05-16 11:09:53', NULL, '1');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.semana
CREATE TABLE IF NOT EXISTS `semana` (
  `PRODATRIB_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL,
  `TIPP_Codigo` int(11) NOT NULL,
  `PRODATRIB_Nombre` varchar(250) DEFAULT NULL,
  `PRODATRIB_Descripcion` varchar(250) DEFAULT NULL,
  `PRODATRIB_FechaInicio` date NOT NULL,
  `PRODATRIB_FechaFin` date NOT NULL DEFAULT '0000-00-00',
  `PRODATRIB_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `PRODATRIB_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PRODATRIB_Codigo`),
  KEY `FK_semana_ciclo` (`CICLOP_Codigo`),
  KEY `FK_semana_tipoestudio` (`TIPP_Codigo`),
  CONSTRAINT `FK_semana_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_semana_tipoestudio` FOREIGN KEY (`TIPP_Codigo`) REFERENCES `tipoestudio` (`TIPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.semana: ~54 rows (aproximadamente)
DELETE FROM `semana`;
/*!40000 ALTER TABLE `semana` DISABLE KEYS */;
INSERT INTO `semana` (`PRODATRIB_Codigo`, `CICLOP_Codigo`, `TIPP_Codigo`, `PRODATRIB_Nombre`, `PRODATRIB_Descripcion`, `PRODATRIB_FechaInicio`, `PRODATRIB_FechaFin`, `PRODATRIB_FechaModificacion`, `PRODATRIB_FechaRegistro`) VALUES
	(16, 1, 3, 'Semana 01', 'ASDF', '2015-08-04', '2015-08-25', '2015-08-10 18:24:13', '2014-10-13 02:41:07'),
	(17, 1, 3, 'Semana 02', '', '2015-08-03', '2015-08-18', '2015-08-10 18:24:34', '2015-05-12 11:54:09'),
	(18, 1, 5, 'Semana 03', '', '0000-00-00', '0000-00-00', '2015-08-10 18:16:35', '2015-05-12 11:54:27'),
	(19, 1, 3, 'Semana 05', '', '0000-00-00', '0000-00-00', '2015-08-10 18:25:31', '2015-05-12 11:54:40'),
	(20, 1, 3, 'Semana 04', '', '0000-00-00', '0000-00-00', '2015-08-10 18:25:10', '2015-05-12 11:54:57'),
	(21, 1, 9, 'Semana 06', '', '0000-00-00', '0000-00-00', '2015-08-10 18:28:31', '2015-05-12 11:55:15'),
	(22, 1, 5, 'Semana 07', '', '0000-00-00', '0000-00-00', '2015-08-10 18:23:30', '2015-05-12 11:56:38'),
	(23, 1, 5, 'Semana 08', '', '0000-00-00', '0000-00-00', '2015-08-10 18:19:40', '2015-05-12 11:57:38'),
	(24, 1, 5, 'Semana 09', '', '0000-00-00', '0000-00-00', '2015-08-10 18:20:01', '2015-05-12 11:57:50'),
	(25, 1, 5, 'Semana 10', '', '0000-00-00', '0000-00-00', '2015-08-10 18:20:18', '2015-05-12 11:58:00'),
	(26, 1, 5, 'Semana 11', '', '0000-00-00', '0000-00-00', '2015-08-10 18:20:35', '2015-05-12 11:58:19'),
	(27, 1, 5, 'Semana 12', '', '0000-00-00', '0000-00-00', '2015-08-10 18:21:01', '2015-05-12 11:58:35'),
	(28, 1, 5, 'Semana 13', '', '0000-00-00', '0000-00-00', '2015-08-10 18:21:17', '2015-05-12 11:58:46'),
	(29, 1, 5, 'Semana 14', '', '0000-00-00', '0000-00-00', '2015-08-10 18:21:34', '2015-05-12 11:59:07'),
	(30, 1, 5, 'Semana 15', '', '0000-00-00', '0000-00-00', '2015-08-10 18:21:59', '2015-05-12 11:59:17'),
	(31, 1, 5, 'Semana 16', '', '0000-00-00', '0000-00-00', '2015-08-10 18:22:15', '2015-05-12 11:59:46'),
	(32, 1, 5, 'Semana 17', '', '0000-00-00', '0000-00-00', '2015-08-10 18:22:30', '2015-05-12 11:59:55'),
	(33, 1, 5, 'Semana 18', '', '0000-00-00', '0000-00-00', '2015-08-10 18:22:45', '2015-05-12 12:00:11'),
	(34, 1, 5, 'Semana 19', '', '0000-00-00', '0000-00-00', '2015-08-10 18:23:01', '2015-05-12 12:00:21'),
	(35, 1, 5, 'Semana 20', '', '0000-00-00', '0000-00-00', '2015-08-10 18:23:15', '2015-05-12 12:00:36'),
	(36, 1, 5, 'Semana 01', 'primer semana 22', '2016-01-05', '2016-01-07', '2015-08-11 08:23:24', '2015-08-10 15:11:02'),
	(37, 1, 5, 'Semana 02', 'asdf', '2016-01-12', '2016-01-14', '2015-08-10 18:16:01', '2015-08-10 15:13:19'),
	(38, 1, 9, 'Semana 03', '', '2016-01-19', '2016-01-21', '2015-08-10 18:27:28', '2015-08-10 15:16:17'),
	(39, 1, 5, 'Semana 04', '', '2016-01-26', '2016-01-28', '2015-08-10 18:17:15', '2015-08-10 15:17:21'),
	(40, 1, 5, 'Semana 05', '', '2016-02-02', '2016-02-04', '2015-08-10 18:18:52', '2015-08-10 15:17:48'),
	(41, 1, 3, 'Semana 06', '', '2016-02-09', '2016-02-11', '2015-08-10 18:25:48', '2015-08-10 15:18:49'),
	(42, 1, 3, 'Semana 07', '', '2016-02-16', '2016-02-18', '2015-08-10 18:26:03', '2015-08-10 15:19:25'),
	(43, 1, 3, 'Semana 08', '', '2016-02-23', '2016-02-25', '2015-08-10 18:26:16', '2015-08-10 15:19:51'),
	(44, 1, 9, 'Semana 01', '', '2016-01-05', '2016-01-07', '2015-08-10 18:26:44', '2015-08-10 15:27:48'),
	(45, 1, 9, 'Semana 02', '', '2016-01-12', '2016-01-14', '2015-08-10 18:27:03', '2015-08-10 15:29:03'),
	(46, 1, 3, 'Semana 03', '', '2016-01-19', '2016-01-21', '2015-08-10 18:24:49', '2015-08-10 15:29:54'),
	(47, 1, 9, 'Semana 04', '', '2016-01-26', '2016-01-28', '2015-08-10 18:27:49', '2015-08-10 15:30:39'),
	(48, 1, 9, 'Semana 05', '', '2016-02-02', '2016-02-04', '2015-08-10 18:28:02', '2015-08-10 15:32:04'),
	(49, 1, 5, 'Semana 06', '', '2016-02-09', '2016-02-11', '2015-08-10 18:19:05', '2015-08-10 15:32:55'),
	(50, 1, 9, 'Semana 07', '', '2016-02-16', '2016-02-18', '2015-08-10 18:28:42', '2015-08-10 15:33:33'),
	(51, 1, 9, 'Semana 08', '', '2016-02-23', '2016-02-25', '2015-08-10 18:28:15', '2015-08-10 15:34:39'),
	(52, 2, 1, 'Semana 00', '', '2015-03-05', '2015-03-31', '2015-08-10 22:53:54', '2015-08-10 22:52:32'),
	(53, 2, 1, 'Semana 01', '', '2015-03-10', '2015-03-12', NULL, '2015-08-10 22:54:55'),
	(54, 2, 1, 'Semana 02', '', '2015-03-17', '2015-03-19', NULL, '2015-08-10 22:55:20'),
	(55, 2, 1, 'Semana 03', '', '2015-03-24', '2015-03-26', NULL, '2015-08-10 22:55:47'),
	(56, 2, 1, 'Semana 04', '', '2015-03-31', '0000-00-00', NULL, '2015-08-10 22:56:10'),
	(57, 2, 1, 'Semana 05', '', '2015-04-07', '2015-04-09', '2015-08-10 23:01:37', '2015-08-10 22:56:50'),
	(58, 2, 1, 'Semana 06', '', '2015-04-14', '2015-04-16', NULL, '2015-08-10 22:57:37'),
	(59, 2, 1, 'Semana 07', '', '2015-04-21', '2015-04-23', NULL, '2015-08-10 22:58:19'),
	(60, 2, 1, 'Semana 08', '', '2015-04-28', '2015-04-30', NULL, '2015-08-10 22:58:45'),
	(61, 2, 1, 'Semana 09', '', '2015-05-05', '2015-05-07', NULL, '2015-08-10 22:59:23'),
	(62, 2, 1, 'Semana 10', '', '2015-05-12', '2015-05-14', NULL, '2015-08-10 23:02:18'),
	(63, 2, 1, 'Semana 11', '', '2015-05-19', '2015-05-21', NULL, '2015-08-10 23:02:46'),
	(64, 2, 1, 'Semana 12', '', '2015-05-26', '2015-05-28', NULL, '2015-08-10 23:03:32'),
	(65, 2, 1, 'Semana 13', '', '2015-06-02', '2015-06-04', NULL, '2015-08-10 23:04:00'),
	(66, 2, 1, 'Semana 14', '', '2015-06-09', '2015-06-11', NULL, '2015-08-10 23:04:38'),
	(67, 2, 1, 'Semana 15', '', '2015-06-16', '2015-06-18', NULL, '2015-08-10 23:05:19'),
	(68, 2, 1, 'Semana 16', '', '2015-06-23', '2015-06-25', NULL, '2015-08-10 23:05:54'),
	(69, 2, 1, 'Semana 17', '', '2015-06-30', '2015-07-02', NULL, '2015-08-10 23:06:32'),
	(70, 2, 1, 'Semana 18', '', '2015-07-07', '2015-07-09', NULL, '2015-08-10 23:07:07'),
	(71, 2, 1, 'Semana 19', 'rtyrtyrtyrty', '2015-06-14', '2015-06-16', '2015-08-12 18:53:35', '2015-08-10 23:08:04'),
	(72, 2, 2, 'Semana 20', '', '2015-07-21', '2015-07-23', NULL, '2015-08-10 23:08:40');
/*!40000 ALTER TABLE `semana` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tareo
CREATE TABLE IF NOT EXISTS `tareo` (
  `TAREOP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `AULAP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TAREOC_ProfesorReemplazado` int(11) NOT NULL DEFAULT '0',
  `TAREOC_Fecha` date NOT NULL,
  `TAREOC_Hinicio` time NOT NULL,
  `TAREOC_Hfin` time NOT NULL,
  `TAREOC_Tipo` int(1) NOT NULL DEFAULT '0' COMMENT '1:Asistencia,2:Reemplazo;3:Falta',
  `TAREOC_Costo` double NOT NULL,
  `TAREOC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `TAREOC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TAREOP_Codigo`),
  KEY `FK_tareo_profesor` (`PROP_Codigo`),
  KEY `FK_tareo_aula` (`AULAP_Codigo`),
  CONSTRAINT `FK_tareo_aula` FOREIGN KEY (`AULAP_Codigo`) REFERENCES `aula` (`AULAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tareo_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tareo: ~2 rows (aproximadamente)
DELETE FROM `tareo`;
/*!40000 ALTER TABLE `tareo` DISABLE KEYS */;
INSERT INTO `tareo` (`TAREOP_Codigo`, `PROP_Codigo`, `AULAP_Codigo`, `TAREOC_ProfesorReemplazado`, `TAREOC_Fecha`, `TAREOC_Hinicio`, `TAREOC_Hfin`, `TAREOC_Tipo`, `TAREOC_Costo`, `TAREOC_FechaModificacion`, `TAREOC_FechaRegistro`) VALUES
	(1, 7, 1, 5, '2015-07-31', '08:00:00', '10:00:00', 1, 0, '2015-08-07 12:22:49', '2015-07-29 22:50:36'),
	(6, 8, 1, 5, '2015-07-31', '10:00:00', '12:00:00', 1, 0, '2015-08-05 20:28:48', '2015-07-30 22:09:19');
/*!40000 ALTER TABLE `tareo` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tema
CREATE TABLE IF NOT EXISTS `tema` (
  `PRODATRIBDET_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PRODATRIB_Codigo` int(11) NOT NULL,
  `CICLOP_Codigo` int(11) NOT NULL,
  `PROD_Codigo` int(11) NOT NULL,
  `PRODATRIBDET_Numero` int(11) NOT NULL DEFAULT '0',
  `PRODATRIBDET_Descripcion` varchar(250) DEFAULT NULL,
  `PRODATRIBDET_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `PRODATRIBDET_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PRODATRIBDET_Codigo`),
  KEY `FK_productoatributodetalle_productoatributo` (`PRODATRIB_Codigo`),
  KEY `FK_tema_ciclo` (`CICLOP_Codigo`),
  KEY `FK_tema_curso` (`PROD_Codigo`),
  CONSTRAINT `FK_productoatributodetalle_productoatributo` FOREIGN KEY (`PRODATRIB_Codigo`) REFERENCES `semana` (`PRODATRIB_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tema_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tema_curso` FOREIGN KEY (`PROD_Codigo`) REFERENCES `curso` (`PROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.tema: ~40 rows (aproximadamente)
DELETE FROM `tema`;
/*!40000 ALTER TABLE `tema` DISABLE KEYS */;
INSERT INTO `tema` (`PRODATRIBDET_Codigo`, `PRODATRIB_Codigo`, `CICLOP_Codigo`, `PROD_Codigo`, `PRODATRIBDET_Numero`, `PRODATRIBDET_Descripcion`, `PRODATRIBDET_FechaModificacion`, `PRODATRIBDET_FechaRegistro`) VALUES
	(36, 16, 1, 93, 0, 'Nociones basicas de geometria 22', '2015-08-10 21:21:03', '2015-03-05 09:09:05'),
	(38, 16, 1, 93, 2, 'TRIANGULOS', '2015-08-10 18:45:35', '2015-03-05 09:09:49'),
	(39, 17, 1, 93, 1, 'CONGRUENCIA DE TRIANGULOS', '2015-08-10 18:45:35', '2015-04-04 13:01:31'),
	(40, 17, 1, 93, 1, 'APLICACIONES DE LA CONGRUENCIA', '2015-08-10 18:45:35', '2015-05-12 12:43:14'),
	(41, 18, 1, 93, 1, 'TRIANGULOS RECTANGULOS NOTABLES', '2015-08-10 18:45:35', '2015-05-12 12:43:57'),
	(42, 18, 1, 93, 2, 'CUADRILATEROS', '2015-08-10 18:45:35', '2015-05-12 12:44:21'),
	(43, 20, 1, 93, 1, 'CIRCUNFERENCIA', '2015-08-10 18:45:35', '2015-05-12 12:45:05'),
	(44, 20, 1, 93, 2, 'CUADRILATERO CIRSCUNSCRITO Y CIRCUNSCRIPTE', '2015-08-10 18:45:35', '2015-05-12 12:45:52'),
	(45, 19, 1, 93, 1, 'ANGULOS EN LA CIRCUNFERENCIA', '2015-08-10 18:45:35', '2015-05-12 12:46:24'),
	(46, 19, 1, 93, 2, 'PROPORCIONALIDAD', '2015-08-10 18:45:35', '2015-05-12 12:46:42'),
	(47, 21, 1, 93, 1, 'SEMEJANZA DE TRIANGULOS', '2015-08-10 18:45:35', '2015-05-12 12:47:06'),
	(48, 21, 1, 93, 2, 'RECTA Y CIRCUNFERENCIA DE EULER', '2015-08-10 18:45:35', '2015-05-12 12:47:36'),
	(49, 22, 1, 93, 1, 'RELACIONES METRICAS EN EL TRIANGULO RECTANGULO', '2015-08-10 18:45:35', '2015-05-12 12:48:45'),
	(50, 22, 1, 93, 2, 'RELACIONES METRICAS EN EL TRIANGULO OBLICUANGULO', '2015-08-10 18:45:35', '2015-05-12 12:50:05'),
	(51, 23, 1, 93, 1, 'TEOREMA DE LAS CUERDAS', '2015-08-10 18:45:35', '2015-05-12 12:50:31'),
	(52, 23, 1, 93, 2, 'TEOREMA DEL TRIANGULO INSCRITO', '2015-08-10 18:45:35', '2015-05-12 12:51:09'),
	(53, 24, 1, 93, 1, 'POLIGONOS REGULARES', '2015-08-10 18:45:35', '2015-05-12 12:51:30'),
	(54, 24, 1, 93, 2, 'POLIGONOS REGULARES NOTABLES INSCRITOS', '2015-08-10 18:45:35', '2015-05-12 12:51:48'),
	(55, 25, 1, 93, 1, 'SIMETRIA EN EL PLANO', '2015-08-10 18:45:35', '2015-05-12 12:52:49'),
	(56, 25, 1, 93, 2, 'LONGITUD DE LA CIRCUNFERENCIA', '2015-08-10 18:45:35', '2015-05-12 12:53:17'),
	(57, 26, 1, 93, 1, 'AREAS DE REGIONES POLIGONALES', '2015-08-10 18:45:35', '2015-05-12 12:53:48'),
	(58, 26, 1, 93, 2, 'RELACION DE AREAS DE REGIONES TRIANGULARES', '2015-08-10 18:45:35', '2015-05-12 12:54:19'),
	(59, 27, 1, 93, 1, 'AREA DE REGIONES CUADRANGULARES', '2015-08-10 18:45:35', '2015-05-12 12:54:48'),
	(60, 27, 1, 93, 2, 'AREAS DE REGIONES CIRCULARES', '2015-08-10 18:45:35', '2015-05-12 12:55:11'),
	(61, 28, 1, 93, 1, 'ELEMENTOS DE GEOMETRIA EN EL ESPACIO', '2015-08-10 18:45:35', '2015-05-12 12:55:50'),
	(62, 28, 1, 93, 2, 'RECTA PERPENDICULAR A UN PLANO', '2015-08-10 18:45:35', '2015-05-12 12:56:43'),
	(63, 29, 1, 93, 1, 'ANGULO DIEDRO', '2015-08-10 18:45:35', '2015-05-12 12:57:03'),
	(64, 29, 1, 93, 2, 'ANGULO TRIEDRO', '2015-08-10 18:45:35', '2015-05-12 12:57:18'),
	(65, 30, 1, 93, 1, 'POLIEDROS', '2015-08-10 18:45:35', '2015-05-12 12:57:35'),
	(66, 30, 1, 93, 2, 'POLIEDROS REGULARES', '2015-08-10 18:45:35', '2015-05-12 12:57:57'),
	(67, 31, 1, 93, 1, 'SIMETRIA EN EL ESPACIO', '2015-08-10 18:45:35', '2015-05-12 12:58:26'),
	(68, 31, 1, 93, 2, 'SUPERFICIE PRISMATICA: PRISMA', '2015-08-10 18:45:35', '2015-05-12 12:58:57'),
	(69, 32, 1, 93, 1, 'DESARROLLOP DE LA SUPERFICIE LATERAL Y TOTAL DE UN PRISMA RECTO', '2015-08-10 18:45:35', '2015-05-12 12:59:47'),
	(70, 32, 1, 93, 2, 'SUPERFICIE PIRAMIDAL: PIRAMIDE', '2015-08-10 18:45:35', '2015-05-12 13:00:11'),
	(71, 33, 1, 93, 1, 'TRONCO DE PIRAMIDE', '2015-08-10 18:45:35', '2015-05-12 13:00:27'),
	(72, 33, 1, 93, 2, 'CILINDRO', '2015-08-10 18:45:35', '2015-05-12 13:00:51'),
	(73, 34, 1, 93, 1, 'CONO', '2015-08-10 18:45:35', '2015-05-12 13:01:07'),
	(74, 34, 1, 93, 2, 'SUPERFICIE ESFERICA', '2015-08-10 18:45:35', '2015-05-12 13:01:25'),
	(75, 35, 1, 93, 1, 'ESFERA', '2015-08-10 18:45:35', '2015-05-12 13:01:42'),
	(76, 35, 1, 93, 2, 'TEOREMA DE PAPPUS-GUIDING', '2015-08-10 18:45:35', '2015-05-12 13:02:07'),
	(77, 16, 1, 5, 0, 'angulos verticales', NULL, '2015-08-10 21:33:08'),
	(78, 48, 1, 95, 0, 'rtyrtyrtyerty', NULL, '2015-08-10 21:34:16'),
	(79, 45, 1, 92, 0, 'ertyrty', '2015-08-10 21:38:25', '2015-08-10 21:35:48');
/*!40000 ALTER TABLE `tema` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tipociclo
CREATE TABLE IF NOT EXISTS `tipociclo` (
  `TIPOCICLOP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `TIPOCICLOC_Descripcion` varchar(100) DEFAULT NULL,
  `TIPOCICLOC_Comentario` varchar(100) DEFAULT NULL,
  `TIPOCICLOC_FechaRegistro` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`TIPOCICLOP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tipociclo: ~2 rows (aproximadamente)
DELETE FROM `tipociclo`;
/*!40000 ALTER TABLE `tipociclo` DISABLE KEYS */;
INSERT INTO `tipociclo` (`TIPOCICLOP_Codigo`, `TIPOCICLOC_Descripcion`, `TIPOCICLOC_Comentario`, `TIPOCICLOC_FechaRegistro`) VALUES
	(1, 'Ciclo 1', 'Ciclo de inicio de año', '2015-08-10 18:14:14'),
	(2, 'Ciclo 2', 'Ciclo de fin de año', '2015-08-10 18:14:19');
/*!40000 ALTER TABLE `tipociclo` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tipodocumento
CREATE TABLE IF NOT EXISTS `tipodocumento` (
  `TIPDOCP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `TIPDOCC_Descripcion` varchar(150) DEFAULT NULL,
  `TIPOCC_Inciales` varchar(150) DEFAULT NULL,
  `TIPOCC_FlagEstado` char(1) DEFAULT '1',
  `TIPOCC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TIPDOCP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.tipodocumento: ~3 rows (aproximadamente)
DELETE FROM `tipodocumento`;
/*!40000 ALTER TABLE `tipodocumento` DISABLE KEYS */;
INSERT INTO `tipodocumento` (`TIPDOCP_Codigo`, `TIPDOCC_Descripcion`, `TIPOCC_Inciales`, `TIPOCC_FlagEstado`, `TIPOCC_FechaRegistro`) VALUES
	(0, '::Seleccione::', '::Seleccione::', '1', '2014-10-06 04:19:27'),
	(1, 'Documento Nacional de Identidad', 'D.N.I.', '1', '2010-12-16 12:50:42'),
	(2, 'Carnet de Extranjeria', 'C.E.', '1', '2010-12-16 12:50:46');
/*!40000 ALTER TABLE `tipodocumento` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tipoestudio
CREATE TABLE IF NOT EXISTS `tipoestudio` (
  `TIPP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `TIPOCICLOP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TIPC_Nombre` varchar(100) DEFAULT NULL,
  `TIPC_Descripcion` varchar(100) DEFAULT NULL,
  `TIPC_FechaRegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TIPC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`TIPP_Codigo`),
  KEY `FK_tipoestudio_tipociclo` (`TIPOCICLOP_Codigo`),
  CONSTRAINT `FK_tipoestudio_tipociclo` FOREIGN KEY (`TIPOCICLOP_Codigo`) REFERENCES `tipociclo` (`TIPOCICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tipoestudio: ~9 rows (aproximadamente)
DELETE FROM `tipoestudio`;
/*!40000 ALTER TABLE `tipoestudio` DISABLE KEYS */;
INSERT INTO `tipoestudio` (`TIPP_Codigo`, `TIPOCICLOP_Codigo`, `TIPC_Nombre`, `TIPC_Descripcion`, `TIPC_FechaRegistro`, `TIPC_FlagEstado`) VALUES
	(1, 2, 'Pre', 'Tipo de estudio para los alumnos QUE VAN A POSTULAR A LA UNI', '2015-05-15 04:18:57', '1'),
	(2, 2, 'Basico', 'Tipo de Estudio para los alumnos que recien egresan del colegio', '2015-05-15 04:19:14', '1'),
	(3, 1, 'Pre', 'Tipo de Estudio para los alumnos que van a postular a la UNI', '2015-05-15 04:19:44', '1'),
	(4, 1, 'Repaso', 'Tipo de estudio para los alumnos que requieren un repaso antes de postular a la UNI', '2015-05-15 04:19:49', '1'),
	(5, 1, 'Basico', 'Tipo de Estudio para los alumnos que recien egresan del colegio', '2015-05-15 04:20:23', '1'),
	(6, 1, 'Intensivo', 'Tipo de Estudio para resolver problemas antes de dar el examen de la UNI', '2015-05-15 04:20:28', '1'),
	(7, 1, 'Escolar 3ero', 'Escuca a todos', '2015-08-10 12:16:34', '1'),
	(8, 1, 'Escolar 4to', 'Escucha para ti', '2015-08-10 12:18:30', '1'),
	(9, 1, 'Escolar 5to', 'Para ti', '2015-08-10 12:18:46', '1');
/*!40000 ALTER TABLE `tipoestudio` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tipoproducto
CREATE TABLE IF NOT EXISTS `tipoproducto` (
  `TIPPROD_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) DEFAULT NULL,
  `TIPPROD_Descripcion` varchar(250) DEFAULT NULL,
  `TIPPROD_FlagEstado` char(1) DEFAULT '1',
  `TIPPROD_FechaModificacion` datetime DEFAULT NULL,
  `TIPPROD_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TIPPROD_Codigo`),
  KEY `FK_tipoproducto_compania` (`CICLOP_Codigo`),
  CONSTRAINT `FK_tipoproducto_compania` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.tipoproducto: ~4 rows (aproximadamente)
DELETE FROM `tipoproducto`;
/*!40000 ALTER TABLE `tipoproducto` DISABLE KEYS */;
INSERT INTO `tipoproducto` (`TIPPROD_Codigo`, `CICLOP_Codigo`, `TIPPROD_Descripcion`, `TIPPROD_FlagEstado`, `TIPPROD_FechaModificacion`, `TIPPROD_FechaRegistro`) VALUES
	(0, 1, ':::SELECCIONE::', '1', NULL, '2014-10-06 19:37:56'),
	(1, 1, 'MATEMATICAS', '1', NULL, '2011-01-04 04:31:10'),
	(2, 1, 'IDIOMAS', '1', NULL, '2011-01-04 04:31:19'),
	(3, 1, 'NEGOCIOS', '1', NULL, '2011-01-04 04:31:33');
/*!40000 ALTER TABLE `tipoproducto` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `USUA_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PERSP_Codigo` int(11) NOT NULL,
  `ROL_Codigo` int(11) NOT NULL,
  `USUA_usuario` varchar(20) DEFAULT NULL,
  `USUA_Password` varchar(50) DEFAULT NULL,
  `USUA_FlagEstado` char(1) DEFAULT '1',
  `USUA_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `USUA_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`USUA_Codigo`),
  KEY `FK_usuario_persona` (`PERSP_Codigo`),
  KEY `FK_usuario_rol` (`ROL_Codigo`),
  CONSTRAINT `FK_usuario_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`ROL_Codigo`) REFERENCES `rol` (`ROL_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.usuario: ~1 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`USUA_Codigo`, `PERSP_Codigo`, `ROL_Codigo`, `USUA_usuario`, `USUA_Password`, `USUA_FlagEstado`, `USUA_FechaModificacion`, `USUA_FechaRegistro`) VALUES
	(7, 1, 4, 'demo', 'e10adc3949ba59abbe56e057f20f883e', '1', '2015-08-05 12:09:17', '2015-08-04 00:25:58');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
