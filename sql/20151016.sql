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
  `TIPCICLOP_Codigo` int(11) NOT NULL,
  `ACTAC_Tipo` char(2) DEFAULT '',
  `ACTAC_Fecha` date NOT NULL DEFAULT '0000-00-00',
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
  KEY `FK_acta_tipoestudiociclo` (`TIPCICLOP_Codigo`),
  CONSTRAINT `FK_acta_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_acta_tipoestudiociclo` FOREIGN KEY (`TIPCICLOP_Codigo`) REFERENCES `tipoestudiociclo` (`TIPCICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_acta_usuario` FOREIGN KEY (`USUA_Codigo`) REFERENCES `usuario` (`USUA_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.acta: ~4 rows (aproximadamente)
DELETE FROM `acta`;
/*!40000 ALTER TABLE `acta` DISABLE KEYS */;
INSERT INTO `acta` (`ACTAP_Codigo`, `USUA_Codigo`, `PROP_Codigo`, `TIPCICLOP_Codigo`, `ACTAC_Tipo`, `ACTAC_Fecha`, `ACTAC_Titulo`, `ACTAC_Agenda`, `ACTAC_Detalle`, `ACTAC_Hinicio`, `ACTAC_Hfin`, `ACTAC_FechaModificacion`, `ACTAC_FechaRegistro`) VALUES
	(18, 7, 8, 1, '', '2015-09-24', 'ultima hora', 'asdf', '', '00:00:00', '00:00:00', '2015-10-06 13:28:35', '2015-09-24 06:58:26'),
	(19, 7, 5, 1, '', '2015-09-24', 'Acta de Geometria', 'Prueba para todos martin ', '', '08:11:00', '11:20:00', '2015-10-06 13:27:28', '2015-09-24 07:05:40'),
	(20, 7, 5, 2, '', '2015-10-09', 'sdf', 'sdfsdfsdf', '', '00:00:00', '00:59:00', NULL, '2015-10-08 19:13:11'),
	(21, 7, 5, 3, '', '2015-10-09', 'nuevo', 'sdfsdf', '', '00:00:00', '01:00:00', NULL, '2015-10-08 19:26:32'),
	(22, 12, 50, 3, '', '2015-10-16', 'wer', 'werwer', '', '00:00:00', '00:00:00', NULL, '2015-10-16 16:00:19');
/*!40000 ALTER TABLE `acta` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.actadetalle
CREATE TABLE IF NOT EXISTS `actadetalle` (
  `ACTADETP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `ACTAP_Codigo` int(11) NOT NULL DEFAULT '0',
  `ACTADETC_Nombre` varchar(150) DEFAULT NULL,
  `ACTADETC_Observacion` text,
  `ACTADETC_FechaModificacion` datetime DEFAULT NULL,
  `ACTADETC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ACTADETP_Codigo`),
  KEY `FK_actadetalle_acta` (`ACTAP_Codigo`),
  CONSTRAINT `FK_actadetalle_acta` FOREIGN KEY (`ACTAP_Codigo`) REFERENCES `acta` (`ACTAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.actadetalle: ~9 rows (aproximadamente)
DELETE FROM `actadetalle`;
/*!40000 ALTER TABLE `actadetalle` DISABLE KEYS */;
INSERT INTO `actadetalle` (`ACTADETP_Codigo`, `ACTAP_Codigo`, `ACTADETC_Nombre`, `ACTADETC_Observacion`, `ACTADETC_FechaModificacion`, `ACTADETC_FechaRegistro`) VALUES
	(81, 18, 'a', 'ae', NULL, '2015-09-24 07:00:41'),
	(82, 18, 'b', 'erw', NULL, '2015-09-24 07:00:41'),
	(83, 18, 'c', 'werwer', NULL, '2015-09-24 07:00:41'),
	(84, 18, 'd', 'rwewerwer', NULL, '2015-09-24 07:00:41'),
	(85, 19, 'Ruth', 'sAAVEDRA', NULL, '2015-09-24 07:05:40'),
	(88, 19, 'Maria', 'Saavedra', NULL, '2015-10-06 13:27:18'),
	(89, 19, 'Filomena', 'Saavedra', NULL, '2015-10-06 13:27:19'),
	(90, 20, 'asdf', 'asdfasdf', NULL, '2015-10-08 19:13:11'),
	(91, 20, 'afsd', 'asdf', NULL, '2015-10-08 19:13:11'),
	(92, 21, 'sdf', 'sdf', NULL, '2015-10-08 19:26:32');
/*!40000 ALTER TABLE `actadetalle` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.actaprofesor
CREATE TABLE IF NOT EXISTS `actaprofesor` (
  `ACTAPROFP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `ACTAP_Codigo` int(11) NOT NULL DEFAULT '0',
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `ACTAPROFC_Hingreso` time DEFAULT NULL,
  `ACTAPROFC_Hsalida` time DEFAULT NULL,
  `ACTAPROFC_Observacion` varchar(150) DEFAULT NULL,
  `ACTAPROFC_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ACTAPROFP_Codigo`),
  KEY `FK_actaprofesor_acta` (`ACTAP_Codigo`),
  KEY `FK_actaprofesor_profesor` (`PROP_Codigo`),
  CONSTRAINT `FK_actaprofesor_acta` FOREIGN KEY (`ACTAP_Codigo`) REFERENCES `acta` (`ACTAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_actaprofesor_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.actaprofesor: ~9 rows (aproximadamente)
DELETE FROM `actaprofesor`;
/*!40000 ALTER TABLE `actaprofesor` DISABLE KEYS */;
INSERT INTO `actaprofesor` (`ACTAPROFP_Codigo`, `ACTAP_Codigo`, `PROP_Codigo`, `ACTAPROFC_Hingreso`, `ACTAPROFC_Hsalida`, `ACTAPROFC_Observacion`, `ACTAPROFC_FechaRegistro`) VALUES
	(1, 19, 5, '11:21:30', '11:21:31', '', '2015-09-24 11:19:53'),
	(4, 19, 6, '02:00:00', '08:00:00', '', '2015-09-24 13:31:32'),
	(5, 18, 10, '00:00:00', '00:00:00', 'f', '2015-09-24 13:35:34'),
	(6, 18, 9, '02:00:00', '06:00:00', '', '2015-09-24 13:35:34'),
	(7, 18, 8, '01:00:00', '01:00:00', '', '2015-09-24 13:35:34'),
	(8, 20, 5, '01:01:00', '01:01:00', '', '2015-10-08 19:25:26'),
	(9, 20, 6, '01:00:00', '03:03:00', '', '2015-10-08 19:25:26'),
	(10, 21, 5, '01:01:00', '04:04:00', 'f', '2015-10-08 19:26:58'),
	(11, 21, 6, '02:02:00', '03:03:00', 'f', '2015-10-08 19:26:58'),
	(12, 21, 7, '00:00:00', '00:00:00', 'f', '2015-10-16 15:59:49'),
	(13, 21, 45, '00:00:00', '00:00:00', 'f', '2015-10-16 15:59:50'),
	(14, 21, 46, '00:00:00', '00:00:00', 'f', '2015-10-16 15:59:50');
/*!40000 ALTER TABLE `actaprofesor` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.asignacion: ~2 rows (aproximadamente)
DELETE FROM `asignacion`;
/*!40000 ALTER TABLE `asignacion` DISABLE KEYS */;
INSERT INTO `asignacion` (`ASIGP_Codigo`, `PROP_Codigo`, `CICLOP_Codigo`, `ASIGC_Descripcion`, `ASIGC_Fecha`, `ASIGC_FlagEstado`, `ASIGC_FechaModificacion`, `ASIGC_FechaRegistro`) VALUES
	(17, 7, 1, '0', '2015-09-15 00:00:00', '1', NULL, '2015-09-19 22:07:03'),
	(20, 5, 1, '0', '2015-09-21 00:00:00', '1', NULL, '2015-09-21 12:46:16'),
	(29, 11, 1, '0', '2015-10-02 00:00:00', '1', NULL, '2015-10-02 01:11:12');
/*!40000 ALTER TABLE `asignacion` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.asignaciondetalle
CREATE TABLE IF NOT EXISTS `asignaciondetalle` (
  `ASIGDETP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `ASIGP_Codigo` int(11) NOT NULL DEFAULT '0',
  `AULAP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TIPCICLOP_Codigo` int(11) NOT NULL DEFAULT '0',
  `ASIGDETC_Dia` int(1) NOT NULL DEFAULT '0',
  `ASIGDETC_Desde` time DEFAULT NULL,
  `ASIGDETC_Hasta` time DEFAULT NULL,
  `ASIGDETC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ASIGDETC_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ASIGDETP_Codigo`),
  KEY `FK_asignaciondetalle_asignacion` (`ASIGP_Codigo`),
  KEY `FK_asignaciondetalle_aula` (`AULAP_Codigo`),
  KEY `FK_asignaciondetalle_tipoestudiociclo` (`TIPCICLOP_Codigo`),
  CONSTRAINT `FK_asignaciondetalle_asignacion` FOREIGN KEY (`ASIGP_Codigo`) REFERENCES `asignacion` (`ASIGP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_asignaciondetalle_aula` FOREIGN KEY (`AULAP_Codigo`) REFERENCES `aula` (`AULAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_asignaciondetalle_tipoestudiociclo` FOREIGN KEY (`TIPCICLOP_Codigo`) REFERENCES `tipoestudiociclo` (`TIPCICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.asignaciondetalle: ~8 rows (aproximadamente)
DELETE FROM `asignaciondetalle`;
/*!40000 ALTER TABLE `asignaciondetalle` DISABLE KEYS */;
INSERT INTO `asignaciondetalle` (`ASIGDETP_Codigo`, `ASIGP_Codigo`, `AULAP_Codigo`, `TIPCICLOP_Codigo`, `ASIGDETC_Dia`, `ASIGDETC_Desde`, `ASIGDETC_Hasta`, `ASIGDETC_FechaModificacion`, `ASIGDETC_FechaRegistro`) VALUES
	(2, 17, 6, 11, 0, '05:00:00', '12:00:00', '2015-10-02 01:42:53', '2015-09-21 12:37:07'),
	(6, 20, 14, 3, 1, '00:00:00', '00:00:00', '2015-09-21 12:46:41', '2015-09-21 12:46:16'),
	(7, 20, 17, 1, 4, '00:00:00', '00:00:00', '2015-09-21 12:46:33', '2015-09-21 12:46:16'),
	(20, 29, 4, 11, 0, '01:00:00', '03:00:00', NULL, '2015-10-02 01:11:12'),
	(21, 29, 8, 3, 4, '05:00:00', '06:00:00', NULL, '2015-10-02 01:11:40'),
	(22, 17, 7, 3, 3, '01:00:00', '02:00:00', '2015-10-02 01:40:19', '2015-10-02 01:40:05'),
	(24, 17, 1, 5, 0, '22:00:00', '22:00:00', '2015-10-02 01:42:38', '2015-10-02 01:41:15'),
	(25, 17, 10, 1, 5, '23:00:00', '23:00:00', '2015-10-02 01:47:35', '2015-10-02 01:41:15'),
	(26, 17, 13, 3, 2, '00:00:00', '00:00:00', NULL, '2015-10-02 01:48:03'),
	(27, 17, 12, 3, 2, '00:00:00', '00:00:00', NULL, '2015-10-02 01:48:03');
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
	(2, 2, 'ADMISION 2015-2', '2015-05-06', '2015-10-25', 'CICLO DE FIN DE AÃ±O', 2);
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
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.curso: ~7 rows (aproximadamente)
DELETE FROM `curso`;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`PROD_Codigo`, `TIPPROD_Codigo`, `PROD_Nombre`, `PROD_DescripcionBreve`, `PROD_EspecificacionPDF`, `PROD_Comentario`, `PROD_Cantidad`, `PROD_Intentos`, `PROD_Tiempo`, `PROD_TiempoExamen`, `PROD_Puntaje`, `PROD_Imagen`, `PROD_Silabus`, `PROD_FlagEstado`, `PROD_FechaModificacion`, `PROD_FechaRegistro`) VALUES
	(5, 1, 'Trigonometria', 'SED UT PERSPICIATIS UNDE OMNIS ISTE NATUS ERROR SIT VOLUPTATEM ACCUSANTIUM DOLOREMQUE LAUDANTIUM, TOTAM REM APERIAM. ', '0', '0', 88, 3, 2, 5, 14, 'erp.png', 'capitulo06.pdf', '1', '2015-10-16 16:24:21', '2011-01-18 07:20:19'),
	(92, 1, 'Fisica', 'EDWARD 2', '0', '0', 3, 5, 5, 30, 14, NULL, NULL, '1', '2015-10-16 16:23:57', '2015-03-25 18:01:35'),
	(93, 1, 'Geometria', 'EDWARD', '0', '0', 4, 5, 5, 30, 14, NULL, NULL, '1', '2015-10-16 16:24:05', '2015-03-25 18:02:55'),
	(95, 1, 'Aritmetica', 'SDFASDF', '0', '0', 12, 5, 5, 30, 14, NULL, NULL, '1', '2015-10-16 16:23:49', '2015-07-24 23:55:23'),
	(96, 1, 'Algebra', '', '0', '0', 11, 5, 5, 30, 14, NULL, NULL, '1', '2015-10-16 16:23:41', '2015-07-24 23:55:41'),
	(97, 1, 'Quimica', '', '0', '0', 0, 5, 5, 30, 14, NULL, NULL, '1', '2015-10-16 16:24:12', '2015-10-16 09:20:50'),
	(98, 4, 'Humanidades', '', '0', '0', 0, 5, 5, 30, 14, NULL, NULL, '1', NULL, '2015-10-16 09:24:30');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.cursotipoestudio: ~0 rows (aproximadamente)
DELETE FROM `cursotipoestudio`;
/*!40000 ALTER TABLE `cursotipoestudio` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.matricula: ~3 rows (aproximadamente)
DELETE FROM `matricula`;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
INSERT INTO `matricula` (`ORDENP_Codigo`, `CICLOP_Codigo`, `CLIP_Codigo`, `AULAP_Codigo`, `TIPP_Codigo`, `ORDENC_Observacion`, `ORDENC_Fecot`, `ORDENC_FechaRegistro`, `ORDENC_FechaModificacion`, `ORDENC_FlagEstado`) VALUES
	(1, 2, 11, 13, 5, '0', '2015-05-15', '2015-05-15 13:30:53', '2015-08-06 00:00:00', '1'),
	(2, 2, 16, 15, 5, '0', '2015-05-22', '2015-05-23 07:35:12', '2015-05-29 00:00:00', '1'),
	(4, 2, 5, 14, 5, NULL, '2015-07-24', '2015-07-23 17:33:32', '2015-07-24 00:00:00', '1');
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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.menu: ~30 rows (aproximadamente)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`MENU_Codigo`, `MENU_Codigo_Padre`, `MENU_Descripcion`, `MENU_Comentario`, `MENU_Url`, `MENU_Orden`, `MENU_Imagen`, `MENU_FechaRegistro`, `MENU_FechaModificacion`, `MENU_FlagEstado`) VALUES
	(2, 58, 'Maestro de Alumnos', 'Aquí se podrán subir las imágenes o aniamciones que serán contenidas en la marquesina', 'index.php/ventas/alumno/listar', 1, 'alumno.jpg', '2015-08-03 20:06:30', NULL, '1'),
	(3, 1, 'MANTENIMIENTOS', '', 'index.php/almacen/curso/listar', 1, 'libros.jpg', '2015-06-20 22:04:31', NULL, '1'),
	(4, 1, 'PROCESOS', '', 'index.php/ventas/orden/listar', 2, 'matri.jpg', '2015-08-12 15:34:09', NULL, '1'),
	(22, 75, 'Maestro de Cursos', 'Maestro de Cursos', 'index.php/almacen/curso/listar', 1, '', '2015-08-11 08:27:54', NULL, '1'),
	(48, 4, 'Matricula', 'Matricula', 'index.php/ventas/matricula/listar', 1, 'matri.jpg', '2015-07-24 22:52:04', NULL, '1'),
	(49, 4, 'Cargas de trabajo', 'Cargas de trabajo', 'index.php/ventas/asignacion/listar', 1, NULL, '2015-10-01 00:30:47', NULL, '1'),
	(52, 3, 'Documentos', NULL, 'index.php/inicio/principal', 4, NULL, '2015-08-12 15:35:34', NULL, '1'),
	(53, 58, 'Maestro de Profesores', 'Tabla de Profesores', 'index.php/ventas/profesor/listar', 1, NULL, '2015-08-03 20:06:22', NULL, '1'),
	(55, 3, 'Ejemplo 1', 'Ejemplo 1', 'index.php/almacen/curso/listar', 1, NULL, '2015-04-02 20:40:06', NULL, '1'),
	(56, 3, 'Ejemplo 3', 'Ejemplo 3', 'index.php/almacen/curso/listar', 1, NULL, '2015-08-05 11:48:18', NULL, '1'),
	(57, 56, 'Ejemplo 5', 'Ejemplo 5', 'Ejemplo5', 1, NULL, '2015-04-02 21:18:33', NULL, '1'),
	(58, 3, 'Configuracion Personal', NULL, '#', 1, NULL, '2015-08-03 20:05:22', NULL, '1'),
	(59, 74, 'Aula', NULL, 'index.php/maestros/aula/listar', 6, NULL, '2015-09-19 22:18:45', NULL, '1'),
	(61, 74, 'Local', NULL, 'index.php/maestros/local/listar', 5, NULL, '2015-09-19 22:18:42', NULL, '1'),
	(62, 74, 'Maestro de Ciclo', 'Maestro de Ciclo', 'index.php/maestros/ciclo/listar', 1, NULL, '2015-10-16 12:43:26', NULL, '1'),
	(63, 74, 'Tipo Estudio ', NULL, 'index.php/maestros/tipoestudio/listar', 2, NULL, '2015-09-08 00:20:56', NULL, '1'),
	(64, 1, 'REPORTES Y CONSULTAS', NULL, NULL, 3, NULL, '2015-08-12 15:34:20', NULL, '1'),
	(65, 2, 'Alumnos pequeños', NULL, NULL, 1, NULL, '2015-06-20 23:06:16', NULL, '1'),
	(66, 58, 'Maestro de Usuarios', 'Usuarios', 'index.php/seguridad/usuario/listar', 1, NULL, '2015-08-03 20:05:56', NULL, '1'),
	(67, 4, 'Reuniones de plana', 'Actas de reunion', 'index.php/ventas/acta/listar', 2, NULL, '2015-10-01 00:33:09', NULL, '1'),
	(68, 4, 'Tareas asignadas', 'Tareas asignadas', 'index.php/ventas/tarea/listar', 4, NULL, '2015-10-06 15:47:24', NULL, '1'),
	(69, 4, 'Vigilancia de examenes', 'Vigilancia de examenes', 'index.php/ventas/vigilancia/listar', 5, NULL, '2015-10-09 22:22:49', NULL, '1'),
	(70, 4, 'Tardanzas Reemplazos', 'Tardanzas Reemplazos', 'index.php/ventas/tardanza/listar', 3, NULL, '2015-10-09 18:38:25', NULL, '1'),
	(71, 4, 'Asistencia de alumnos', 'Asistencia de alumnos', 'index.php/ventas/asistencia/editar', 1, NULL, '2015-07-30 22:19:35', NULL, '1'),
	(72, 74, 'Semana', 'Semana', 'index.php/almacen/semana/listar', 4, NULL, '2015-09-19 22:18:37', NULL, '1'),
	(73, 75, 'Maestro de Temas', 'Maestro de Temas', 'index.php/almacen/tema/listar', 4, NULL, '2015-08-12 15:29:17', NULL, '1'),
	(74, 3, 'Configuracion Sistema', 'Configuracion Sistema', '#', 3, NULL, '2015-08-12 15:35:19', NULL, '1'),
	(75, 3, 'Configuracion Cursos', 'Configuracion Cursos', '#', 2, NULL, '2015-08-12 15:35:17', NULL, '1'),
	(76, 75, 'Maestro de Cursos Ciclo', 'Maestro de Cursos Ciclo', 'index.php/almacen/cursociclo/listar', 2, NULL, '2015-08-12 15:28:56', NULL, '1'),
	(77, 75, 'Maestro de Cursos Tipo', 'Maestro de Cursos Tipo', 'index.php/almacen/cursotipoestudio/listar', 3, NULL, '2015-08-12 16:08:25', NULL, '1'),
	(78, 74, 'Tipo Estudio por ciclo', NULL, 'index.php/maestros/tipoestudiociclo/listar', 3, NULL, '2015-09-19 22:19:29', NULL, '1');
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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.permiso: ~50 rows (aproximadamente)
DELETE FROM `permiso`;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` (`PERM_Codigo`, `ROL_Codigo`, `MENU_Codigo`, `PERM_FlagEstado`) VALUES
	(4, 4, 3, '1'),
	(5, 4, 4, '1'),
	(29, 4, 22, '1'),
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
	(59, 4, 72, '1'),
	(60, 4, 73, '1'),
	(61, 4, 74, '1'),
	(62, 4, 75, '1'),
	(63, 4, 76, '1'),
	(64, 4, 77, '1'),
	(65, 4, 78, '1'),
	(66, 6, 3, '1'),
	(67, 6, 4, '1'),
	(68, 6, 22, '1'),
	(69, 6, 49, '1'),
	(70, 6, 52, '1'),
	(71, 6, 53, '1'),
	(72, 6, 57, '1'),
	(73, 6, 58, '1'),
	(74, 6, 59, '1'),
	(75, 6, 61, '1'),
	(76, 6, 62, '1'),
	(77, 6, 63, '1'),
	(78, 6, 64, '1'),
	(79, 6, 65, '1'),
	(81, 6, 67, '1'),
	(82, 6, 68, '1'),
	(83, 6, 69, '1'),
	(84, 6, 70, '1'),
	(85, 6, 72, '1'),
	(86, 6, 73, '1'),
	(87, 6, 74, '1'),
	(88, 6, 75, '1'),
	(89, 6, 76, '1'),
	(91, 6, 78, '1');
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
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.persona: ~63 rows (aproximadamente)
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
	(91, 1, 'Figueroa', 'Maldonado', 'Edward', '0', '0', '0', '0', '0', '', '0', '0', '1', '0000-00-00', '2015-04-04 15:07:59', '2015-10-16 15:42:56', '1'),
	(92, 1, 'PEREZ DOVAL', 'SANDOVAL', 'DALEANA', '12341234', 'MZ R LOTE 50 LOS NISPEROS', '34324234', '0', '0', 'miriam@hotmail.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-04-22', '2015-05-09 12:39:23', '2015-08-05 00:27:56', '1'),
	(93, 1, 'VASQUEZ', 'DOMINGUEZ', 'RIQUELMER', '0', '0', '0', '0', '0', '', '0', '0', '0', '0000-00-00', '2015-05-16 12:23:59', '2015-08-05 18:52:51', '1'),
	(94, 1, 'Arevalo', 'Villanueva', 'Manuel', '234234', '', '324234324', '2', '0', '', '', '0', '1', '0000-00-00', '2015-05-16 12:25:47', '2015-10-16 09:50:38', '1'),
	(95, 1, 'PEREZ', 'PEREZ', 'GUSTAVO', '12341234', 'MZ R LOTE ', '342344', '0', '0', 'gusta.perez@gmail.com', 'MZ R LOTE ', '0', '0', '2015-05-12', '2015-05-16 23:25:12', '2015-08-05 00:27:56', '1'),
	(96, 1, 'AAA', 'BBBB', 'CCCCOCO', '41234321', 'WER', '34234', '0', '0', '', 'WER', '0', '0', '2015-05-26', '2015-05-30 05:29:13', '2015-08-05 00:27:56', '1'),
	(97, 1, 'Lazo', 'Ochoa', 'Domingo Pedro', '0', '0', '0', '0', '0', '', '0', '0', '1', '0000-00-00', '2015-05-30 05:31:56', '2015-10-16 12:39:04', '1'),
	(98, 1, 'PLANAS', 'VIGO', 'PEDRO', '24353453', 'ASDFSADF', '34234234234', '0', '0', 'pedro.planas@gmail.com', 'ASDFSADF', '0', '0', '2015-07-21', '2015-07-27 16:08:29', '2015-08-05 00:27:56', '1'),
	(99, 1, 'NICOMEDES', 'PLACENCIA', 'HUGO', '2342342', 'MZ R LOTE 50 LOS NISPEROS', '23424234', '0', '0', 'hugo.placencia@gmail.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-07-23', '2015-07-27 16:09:18', '2015-08-05 00:27:56', '1'),
	(100, 1, 'Amoretti', 'Vidal', 'Jesus', '435345', '', '324234234', '0', '0', '', '', '0', '0', '2015-07-10', '2015-07-27 16:12:47', '2015-10-16 12:32:33', '1'),
	(101, 1, 'RODRIGUEZ', 'RICARDO', 'ROLANDO', '0', '0', '0', '0', '0', '', '0', '0', '0', '0000-00-00', '2015-07-27 16:14:37', '2015-08-05 18:52:58', '1'),
	(136, 0, 'sanchez', 'calderon', 'josefina', '0', '0', '0', '0', '0', '', '0', '0', '0', '0000-00-00', '2015-08-05 18:53:28', NULL, '1'),
	(137, 0, 'Alvarado', 'Jaramillo', 'Luis', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:07:14', NULL, '1'),
	(138, 0, 'Alvarado', 'Jaramillo', 'Luis', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:07:22', NULL, '1'),
	(139, 0, 'ArÃ©valo', 'Castro', 'VÃ­ctor Manuel', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:08:19', NULL, '1'),
	(140, 0, 'Arias ', 'Chumpitaz', 'Ulises', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:08:54', NULL, '1'),
	(141, 0, 'Barzola', 'Esteban', 'Marcelo Ricardo', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:09:40', NULL, '1'),
	(142, 0, 'Espirme', 'Ortega', 'David', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:09:59', NULL, '1'),
	(143, 0, 'Lopez', 'Esquivel', 'Miguel Angel', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:10:47', NULL, '1'),
	(144, 0, 'Mamani', 'Sulca', 'Oscar Manuel', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:11:14', NULL, '1'),
	(145, 0, 'Mas', 'Huaman', 'Ronald Jesus', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:11:38', NULL, '1'),
	(146, 0, 'Mejia ', 'Rodrigo', 'Edwin Octavio', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:12:16', NULL, '1'),
	(147, 0, 'Minaya', 'Ames', 'Julio Cesar', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:12:48', NULL, '1'),
	(148, 0, 'Nizama', 'Victoria', 'Luis', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:13:07', NULL, '1'),
	(149, 0, 'Norabuena', 'Meza', 'Edgar', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:13:32', NULL, '1'),
	(150, 0, 'Ã‘aupari', 'Huatuco', 'Zocimo', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:14:06', NULL, '1'),
	(151, 0, 'Perez', 'Cupe', 'Rosulo', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:14:25', NULL, '1'),
	(152, 0, 'Reyes', 'MuÃ±oz', 'Elva Flor', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:14:45', NULL, '1'),
	(153, 0, 'Silva', 'Santiesteban', 'Mario', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:15:08', NULL, '1'),
	(154, 0, 'Silvestre', 'Valer', 'Jim', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:33:28', NULL, '1'),
	(155, 0, 'Sotelo', 'Chico', 'Jose Carlos', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:34:35', '2015-10-16 09:43:58', '1'),
	(157, 0, 'Tori', 'Loza', 'Jose', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:45:09', NULL, '1'),
	(158, 0, 'Valderrama', 'Soto', 'Ericka', '', '', '', '', '0', '', '', '0', '2', '0000-00-00', '2015-10-16 09:45:34', NULL, '1'),
	(159, 0, 'Vidal', 'Dominguez', 'Emilio', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:45:58', NULL, '1'),
	(160, 0, 'Visurraga', 'Reinoso', 'Roberto', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:46:20', NULL, '1'),
	(161, 0, 'Zamudio', 'Peves', 'Jose Fernando', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:46:43', NULL, '1'),
	(162, 0, 'Cabrera', 'Chavez', 'Julio Cesar', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:47:31', NULL, '1'),
	(163, 0, 'Escudero', 'Acero', 'Phamela Estefany', '', '', '', '', '0', '', '', '0', '2', '0000-00-00', '2015-10-16 09:48:05', NULL, '1'),
	(164, 0, 'Espinoza', 'Vasquez', 'Manuel', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:48:24', NULL, '1'),
	(165, 0, 'Gallardo', 'Vasquez', 'Pablo', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:48:41', NULL, '1'),
	(166, 0, 'Gamarra', 'Lescano', 'Melbert Gustavo', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:49:18', NULL, '1'),
	(167, 0, 'Huaccha', 'Quiroz', 'Eduardo', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:49:36', NULL, '1'),
	(168, 0, 'Huaranca', 'Tanta', 'Sergio', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:49:59', NULL, '1'),
	(169, 0, 'Arias', 'Antonio', 'Leandro', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:51:06', NULL, '1'),
	(170, 0, 'Custodio', 'Ching', 'Victor', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 09:51:32', NULL, '1'),
	(171, 0, 'Andy', 'Chinchay', 'Alberto', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 12:30:18', NULL, '1'),
	(172, 0, 'Arambulo', 'Ostos', 'Carlos', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 12:30:45', NULL, '1'),
	(173, 0, 'Carbonel', 'Olazabal', 'Daniel Roberto', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 12:31:13', NULL, '1'),
	(174, 0, 'Alcantara', 'Malca', 'Daniel Alonso', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 12:32:59', NULL, '1'),
	(175, 0, 'Flores', 'Garcia', 'Jose', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 12:35:11', NULL, '1'),
	(176, 0, 'Rosales ', 'Huamani', 'Jimmy', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 12:35:36', NULL, '1'),
	(177, 0, 'Alania', 'Lazo', 'Nelly', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 12:36:00', NULL, '1'),
	(178, 0, 'Gamarra', 'La Rosa', 'Jose Luis', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '2015-10-16 12:36:26', NULL, '1');
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.profesor: ~48 rows (aproximadamente)
DELETE FROM `profesor`;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` (`PROP_Codigo`, `PROD_Codigo`, `PERSP_Codigo`, `PROC_FechaModificacion`, `PROC_FechaRegistro`, `PROC_FlagCoordinador`, `PROC_FlagEstado`) VALUES
	(5, 93, 91, '2015-10-16 22:42:56', '2015-05-16 09:00:24', 2, '1'),
	(6, 93, 93, '2015-05-16 00:00:00', '2015-05-16 12:24:00', 2, '1'),
	(7, 93, 94, '2015-10-16 16:50:38', '2015-05-16 12:25:47', 1, '1'),
	(8, 5, 97, '2015-10-16 19:39:04', '2015-05-30 05:31:56', 1, '1'),
	(9, 5, 98, '2015-07-27 00:00:00', '2015-07-27 16:08:29', 2, '1'),
	(10, 5, 99, '2015-07-27 00:00:00', '2015-07-27 16:09:18', 2, '1'),
	(11, 92, 100, '2015-10-16 19:32:33', '2015-07-27 16:12:47', 2, '1'),
	(12, 95, 101, '2015-07-27 00:00:00', '2015-07-27 16:14:37', 2, '1'),
	(14, 95, 138, '2015-10-16 16:07:22', '2015-10-16 09:07:22', 2, '1'),
	(15, 95, 139, '2015-10-16 16:08:19', '2015-10-16 09:08:19', 2, '1'),
	(16, 95, 140, '2015-10-16 16:08:54', '2015-10-16 09:08:54', 2, '1'),
	(17, 95, 141, '2015-10-16 16:09:40', '2015-10-16 09:09:40', 2, '1'),
	(18, 95, 142, '2015-10-16 16:09:59', '2015-10-16 09:09:59', 2, '1'),
	(19, 95, 143, '2015-10-16 16:10:47', '2015-10-16 09:10:47', 2, '1'),
	(20, 95, 144, '2015-10-16 16:11:14', '2015-10-16 09:11:14', 2, '1'),
	(21, 95, 145, '2015-10-16 16:11:39', '2015-10-16 09:11:39', 2, '1'),
	(22, 95, 146, '2015-10-16 16:12:16', '2015-10-16 09:12:16', 2, '1'),
	(23, 95, 147, '2015-10-16 16:12:48', '2015-10-16 09:12:48', 2, '1'),
	(24, 95, 148, '2015-10-16 16:13:07', '2015-10-16 09:13:07', 2, '1'),
	(25, 95, 149, '2015-10-16 16:13:32', '2015-10-16 09:13:32', 2, '1'),
	(26, 95, 150, '2015-10-16 16:14:06', '2015-10-16 09:14:06', 2, '1'),
	(27, 95, 151, '2015-10-16 16:14:25', '2015-10-16 09:14:25', 2, '1'),
	(28, 95, 152, '2015-10-16 16:14:45', '2015-10-16 09:14:45', 2, '1'),
	(29, 95, 153, '2015-10-16 16:15:08', '2015-10-16 09:15:08', 2, '1'),
	(30, 95, 154, '2015-10-16 16:33:28', '2015-10-16 09:33:28', 2, '1'),
	(31, 95, 155, '2015-10-16 16:44:38', '2015-10-16 09:34:35', 2, '1'),
	(33, 95, 157, '2015-10-16 16:45:09', '2015-10-16 09:45:09', 2, '1'),
	(34, 95, 158, '2015-10-16 16:45:34', '2015-10-16 09:45:34', 2, '1'),
	(35, 95, 159, '2015-10-16 16:45:58', '2015-10-16 09:45:58', 2, '1'),
	(36, 95, 160, '2015-10-16 16:46:20', '2015-10-16 09:46:20', 2, '1'),
	(37, 95, 161, '2015-10-16 16:46:43', '2015-10-16 09:46:43', 2, '1'),
	(38, 96, 162, '2015-10-16 16:47:31', '2015-10-16 09:47:31', 2, '1'),
	(39, 96, 163, '2015-10-16 16:48:05', '2015-10-16 09:48:05', 2, '1'),
	(40, 96, 164, '2015-10-16 16:48:24', '2015-10-16 09:48:24', 2, '1'),
	(41, 96, 165, '2015-10-16 16:48:42', '2015-10-16 09:48:42', 2, '1'),
	(42, 96, 166, '2015-10-16 16:49:18', '2015-10-16 09:49:18', 2, '1'),
	(43, 96, 167, '2015-10-16 16:49:36', '2015-10-16 09:49:36', 2, '1'),
	(44, 96, 168, '2015-10-16 16:49:59', '2015-10-16 09:49:59', 2, '1'),
	(45, 93, 169, '2015-10-16 16:51:06', '2015-10-16 09:51:06', 2, '1'),
	(46, 93, 170, '2015-10-16 16:51:32', '2015-10-16 09:51:32', 2, '1'),
	(47, 5, 171, '2015-10-16 19:30:18', '2015-10-16 12:30:18', 2, '1'),
	(48, 5, 172, '2015-10-16 19:30:45', '2015-10-16 12:30:45', 2, '1'),
	(49, 5, 173, '2015-10-16 19:31:13', '2015-10-16 12:31:13', 2, '1'),
	(50, 92, 174, '2015-10-16 19:32:59', '2015-10-16 12:32:59', 1, '1'),
	(51, 97, 175, '2015-10-16 19:35:11', '2015-10-16 12:35:11', 2, '1'),
	(52, 97, 176, '2015-10-16 19:35:36', '2015-10-16 12:35:36', 2, '1'),
	(53, 98, 177, '2015-10-16 19:36:00', '2015-10-16 12:36:00', 2, '1'),
	(54, 98, 178, '2015-10-16 19:36:50', '2015-10-16 12:36:26', 1, '1');
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
  CONSTRAINT `FK_puntaje_orden` FOREIGN KEY (`ORDENP_Codigo`) REFERENCES `matricula` (`ORDENP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
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

-- Volcando datos para la tabla 20denota.rol: ~3 rows (aproximadamente)
DELETE FROM `rol`;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`ROL_Codigo`, `ROL_Descripcion`, `ROL_FechaRegistro`, `ROL_FechaModificacion`, `ROL_FlagEstado`) VALUES
	(0, ':::Seleccione:::', '2015-08-05 16:08:09', NULL, '1'),
	(4, 'Coordinador general', '2015-10-16 08:53:26', NULL, '1'),
	(6, 'Coordinador de plana', '2015-05-16 11:09:41', NULL, '1');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.semana
CREATE TABLE IF NOT EXISTS `semana` (
  `PRODATRIB_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL,
  `TIPCICLOP_Codigo` int(11) NOT NULL,
  `PRODATRIB_Nombre` varchar(250) DEFAULT NULL,
  `PRODATRIB_Descripcion` varchar(250) DEFAULT NULL,
  `PRODATRIB_FechaInicio` date NOT NULL,
  `PRODATRIB_FechaFin` date NOT NULL DEFAULT '0000-00-00',
  `PRODATRIB_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `PRODATRIB_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PRODATRIB_Codigo`),
  KEY `FK_semana_ciclo` (`CICLOP_Codigo`),
  KEY `FK_semana_tipoestudiociclo` (`TIPCICLOP_Codigo`),
  CONSTRAINT `FK_semana_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_semana_tipoestudiociclo` FOREIGN KEY (`TIPCICLOP_Codigo`) REFERENCES `tipoestudiociclo` (`TIPCICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.semana: ~28 rows (aproximadamente)
DELETE FROM `semana`;
/*!40000 ALTER TABLE `semana` DISABLE KEYS */;
INSERT INTO `semana` (`PRODATRIB_Codigo`, `CICLOP_Codigo`, `TIPCICLOP_Codigo`, `PRODATRIB_Nombre`, `PRODATRIB_Descripcion`, `PRODATRIB_FechaInicio`, `PRODATRIB_FechaFin`, `PRODATRIB_FechaModificacion`, `PRODATRIB_FechaRegistro`) VALUES
	(1, 1, 1, 'Semana 01', 'erty sdfsff fdassdf ', '2015-09-02', '2015-09-04', '2015-09-21 10:27:04', '2015-09-21 09:57:19'),
	(2, 1, 1, 'Semana 02', '', '2015-09-09', '2015-09-11', NULL, '2015-09-21 10:27:35'),
	(3, 1, 1, 'Semana 03', '', '2015-09-16', '2015-09-18', NULL, '2015-09-21 10:27:59'),
	(4, 1, 1, 'Semana 04', '', '2015-09-23', '2015-09-25', NULL, '2015-09-21 10:28:17'),
	(5, 1, 1, 'Semana 05', '', '2015-09-30', '2015-10-02', NULL, '2015-09-21 10:28:45'),
	(6, 1, 1, 'Semana 06', '', '2015-10-07', '2015-10-09', NULL, '2015-09-21 10:29:08'),
	(7, 1, 1, 'Semana 07', '', '2015-10-14', '2015-10-16', NULL, '2015-09-21 10:29:34'),
	(8, 1, 1, 'Semana 08', '', '2015-10-21', '2015-10-23', NULL, '2015-09-21 10:29:57'),
	(9, 1, 1, 'Semana 09', '', '2015-10-28', '2015-10-30', NULL, '2015-09-21 10:32:13'),
	(10, 1, 1, 'Semana 10', '', '2015-11-04', '2015-11-06', NULL, '2015-09-21 10:32:37'),
	(11, 1, 1, 'Semana 11', '', '2015-11-11', '2015-11-13', NULL, '2015-09-21 10:32:57'),
	(12, 1, 1, 'Semana 12', '', '2015-11-18', '2015-11-20', '2015-09-21 10:35:59', '2015-09-21 10:33:16'),
	(13, 1, 1, 'Semana 13', '', '2015-11-25', '2015-11-27', NULL, '2015-09-21 10:33:37'),
	(14, 1, 1, 'Semana 14', '', '2015-12-02', '2015-12-04', NULL, '2015-09-21 10:33:56'),
	(15, 1, 1, 'Semana 15', '', '2015-12-09', '2015-12-11', NULL, '2015-09-21 10:34:16'),
	(16, 1, 1, 'Semana 16', '', '2015-12-16', '2015-12-18', NULL, '2015-09-21 10:34:38'),
	(17, 1, 1, 'Semana 17', '', '2015-12-23', '2015-12-30', NULL, '2015-09-21 10:34:56'),
	(18, 1, 1, 'Semana 18', '', '2016-01-06', '2016-01-08', NULL, '2015-09-21 10:35:15'),
	(19, 1, 1, 'Semana 19', '', '2016-02-13', '2016-01-15', '2015-09-21 10:36:09', '2015-09-21 10:35:33'),
	(20, 1, 1, 'Semana 20', '', '2016-01-20', '2016-01-22', NULL, '2015-09-21 10:36:33'),
	(21, 1, 11, 'Semana 01', '', '2016-01-05', '2016-01-07', NULL, '2015-09-21 10:38:10'),
	(22, 1, 11, 'Semana 02', '', '2016-01-12', '2016-01-14', NULL, '2015-09-21 10:38:55'),
	(23, 1, 11, 'Semana 03', '', '2016-01-19', '2016-01-21', '2015-09-21 10:39:52', '2015-09-21 10:39:15'),
	(24, 1, 11, 'Semana 04', '', '2016-01-26', '2016-01-28', NULL, '2015-09-21 10:39:34'),
	(25, 1, 11, 'Semana 05', '', '2016-02-02', '2016-02-04', NULL, '2015-09-21 10:40:20'),
	(26, 1, 11, 'Semana 06', '', '2016-02-09', '2016-02-11', NULL, '2015-09-21 10:40:42'),
	(27, 1, 11, 'Semana 07', '', '2016-02-16', '2016-02-18', NULL, '2015-09-21 10:41:10'),
	(28, 1, 11, 'Semana 08', '', '2016-02-23', '2016-02-25', NULL, '2015-09-21 10:41:38');
/*!40000 ALTER TABLE `semana` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tarea
CREATE TABLE IF NOT EXISTS `tarea` (
  `TAREAP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `USUA_Codigo` int(11) NOT NULL,
  `PROP_Codigo` int(11) NOT NULL,
  `CICLOP_Codigo` int(11) NOT NULL,
  `TIPOTAREAP_Codigo` int(11) DEFAULT NULL,
  `TAREAC_Nombre` varchar(500) NOT NULL,
  `TAREAC_Descripcion` varchar(500) NOT NULL,
  `TAREAC_Fecha` date NOT NULL DEFAULT '0000-00-00',
  `TAREAC_FechaEntrega` date NOT NULL DEFAULT '0000-00-00',
  `TAREAC_Numero` int(11) DEFAULT NULL,
  `TAREAC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `TAREAC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TAREAP_Codigo`),
  KEY `FK_tarea_usuario` (`USUA_Codigo`),
  KEY `FK_tarea_profesor` (`PROP_Codigo`),
  KEY `FK_tarea_ciclo` (`CICLOP_Codigo`),
  KEY `FK_tarea_tipotarea` (`TIPOTAREAP_Codigo`),
  CONSTRAINT `FK_tarea_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tarea_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tarea_tipotarea` FOREIGN KEY (`TIPOTAREAP_Codigo`) REFERENCES `tipotarea` (`TIPOTAREAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tarea_usuario` FOREIGN KEY (`USUA_Codigo`) REFERENCES `usuario` (`USUA_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tarea: ~5 rows (aproximadamente)
DELETE FROM `tarea`;
/*!40000 ALTER TABLE `tarea` DISABLE KEYS */;
INSERT INTO `tarea` (`TAREAP_Codigo`, `USUA_Codigo`, `PROP_Codigo`, `CICLOP_Codigo`, `TIPOTAREAP_Codigo`, `TAREAC_Nombre`, `TAREAC_Descripcion`, `TAREAC_Fecha`, `TAREAC_FechaEntrega`, `TAREAC_Numero`, `TAREAC_FechaModificacion`, `TAREAC_FechaRegistro`) VALUES
	(1, 7, 7, 1, 1, 'tarea de todos', 'asdfasdf hola a todos', '2015-09-01', '2015-09-15', 33, '2015-09-29 15:07:41', '2015-09-29 14:00:20'),
	(2, 7, 11, 1, 1, '', '', '2015-09-29', '2015-09-17', 22, '2015-09-29 15:06:58', '2015-09-29 15:00:40'),
	(3, 7, 8, 1, 1, '', '', '2015-09-29', '2015-09-23', 11, '2015-09-29 15:07:09', '2015-09-29 15:01:06'),
	(4, 7, 11, 1, 1, 'asdasd', 'asdasdasasddas gfd gfd dfg', '2015-09-29', '2015-09-30', 99, NULL, '2015-09-29 15:10:10'),
	(5, 7, 5, 1, 1, 'ertertertertre treterter tr', 'ertertertert ttttt dddd', '2015-09-29', '2015-10-16', 100, '2015-10-08 20:05:10', '2015-09-29 16:13:41'),
	(6, 7, 5, 1, 3, '1111111', 'wertwert', '2015-10-10', '2015-10-13', 333, '2015-10-09 21:48:35', '2015-10-09 18:21:35');
/*!40000 ALTER TABLE `tarea` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tareadetalle
CREATE TABLE IF NOT EXISTS `tareadetalle` (
  `TAREADETP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `TAREAP_Codigo` int(11) NOT NULL DEFAULT '0',
  `PROP_Codigo` int(11) DEFAULT '0',
  `PRODATRIBDET_Codigo` int(11) DEFAULT '0',
  `TAREADETC_Cantidad` varchar(50) DEFAULT NULL,
  `TAREADETC_FechaEntrega` date NOT NULL DEFAULT '0000-00-00',
  `TAREADETC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `TAREADETC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TAREADETP_Codigo`),
  KEY `FK_tareadetalle_tarea` (`TAREAP_Codigo`),
  KEY `FK_tareadetalle_profesor` (`PROP_Codigo`),
  KEY `FK_tareadetalle_tema` (`PRODATRIBDET_Codigo`),
  CONSTRAINT `FK_tareadetalle_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tareadetalle_tarea` FOREIGN KEY (`TAREAP_Codigo`) REFERENCES `tarea` (`TAREAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tareadetalle_tema` FOREIGN KEY (`PRODATRIBDET_Codigo`) REFERENCES `tema` (`PRODATRIBDET_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tareadetalle: ~6 rows (aproximadamente)
DELETE FROM `tareadetalle`;
/*!40000 ALTER TABLE `tareadetalle` DISABLE KEYS */;
INSERT INTO `tareadetalle` (`TAREADETP_Codigo`, `TAREAP_Codigo`, `PROP_Codigo`, `PRODATRIBDET_Codigo`, `TAREADETC_Cantidad`, `TAREADETC_FechaEntrega`, `TAREADETC_FechaModificacion`, `TAREADETC_FechaRegistro`) VALUES
	(1, 5, 6, 15, '11', '2015-10-01', '2015-10-09 18:15:11', '2015-09-29 15:12:02'),
	(2, 5, 6, 7, '10', '2015-10-01', '2015-10-09 18:13:55', '2015-10-06 16:03:53'),
	(3, 5, 6, 9, '9', '2015-10-15', '2015-10-09 18:14:23', '2015-10-08 20:03:37'),
	(4, 5, 6, 11, '8', '2015-10-13', '2015-10-09 18:14:23', '2015-10-08 20:22:49'),
	(5, 5, 6, 5, '1', '2015-10-26', '2015-10-09 18:14:23', '2015-10-08 20:46:10'),
	(10, 6, 6, 4, '6', '2015-10-08', NULL, '2015-10-09 21:59:21'),
	(12, 6, 5, 8, '6,7,8', '2015-10-05', NULL, '2015-10-09 22:07:55');
/*!40000 ALTER TABLE `tareadetalle` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tareo
CREATE TABLE IF NOT EXISTS `tareo` (
  `TAREOP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `AULAP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TAREOC_Tipo` int(1) NOT NULL DEFAULT '0' COMMENT '1:Asistencia,2:Reemplazo;3:Falta',
  `USUA_Codigo` int(1) NOT NULL DEFAULT '0',
  `TAREOC_ProfesorReemplazado` int(11) NOT NULL DEFAULT '0',
  `TAREOC_Fecha` date NOT NULL,
  `TAREOC_Hinicio` time NOT NULL,
  `TAREOC_Hfin` time NOT NULL,
  `TAREOC_Costo` double NOT NULL,
  `TAREOC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `TAREOC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TAREOP_Codigo`),
  KEY `FK_tareo_profesor` (`PROP_Codigo`),
  KEY `FK_tareo_aula` (`AULAP_Codigo`),
  KEY `FK_tareo_tipoasistencia` (`TAREOC_Tipo`),
  KEY `FK_tareo_usuario` (`USUA_Codigo`),
  CONSTRAINT `FK_tareo_aula` FOREIGN KEY (`AULAP_Codigo`) REFERENCES `aula` (`AULAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tareo_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tareo_tipoasistencia` FOREIGN KEY (`TAREOC_Tipo`) REFERENCES `tipoasistencia` (`TIPOASISP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tareo_usuario` FOREIGN KEY (`USUA_Codigo`) REFERENCES `usuario` (`USUA_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tareo: ~3 rows (aproximadamente)
DELETE FROM `tareo`;
/*!40000 ALTER TABLE `tareo` DISABLE KEYS */;
INSERT INTO `tareo` (`TAREOP_Codigo`, `PROP_Codigo`, `AULAP_Codigo`, `TAREOC_Tipo`, `USUA_Codigo`, `TAREOC_ProfesorReemplazado`, `TAREOC_Fecha`, `TAREOC_Hinicio`, `TAREOC_Hfin`, `TAREOC_Costo`, `TAREOC_FechaModificacion`, `TAREOC_FechaRegistro`) VALUES
	(12, 11, 1, 1, 7, 5, '2015-10-06', '23:00:00', '02:00:00', 0, '2015-10-09 21:16:19', '2015-10-06 15:42:52'),
	(13, 11, 1, 2, 7, 9, '2015-10-06', '03:00:00', '02:00:00', 0, '2015-10-09 23:12:28', '2015-10-06 15:43:54'),
	(15, 9, 11, 1, 7, 9, '2015-10-06', '02:00:00', '04:00:00', 0, '2015-10-09 21:15:39', '2015-10-06 15:44:27'),
	(17, 6, 2, 1, 7, 0, '2015-10-10', '01:00:00', '01:00:00', 0, NULL, '2015-10-09 21:43:40');
/*!40000 ALTER TABLE `tareo` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tema
CREATE TABLE IF NOT EXISTS `tema` (
  `PRODATRIBDET_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PRODATRIB_Codigo` int(11) NOT NULL,
  `CURSOCIP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TIPCICLOP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TEMAC_Descripcion` varchar(250) DEFAULT NULL,
  `TEMAC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `TEMAC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PRODATRIBDET_Codigo`),
  KEY `FK_tema_semana` (`PRODATRIB_Codigo`),
  KEY `FK_tema_cursociclo` (`CURSOCIP_Codigo`),
  KEY `FK_tema_tipoestudiociclo` (`TIPCICLOP_Codigo`),
  CONSTRAINT `FK_tema_cursociclo` FOREIGN KEY (`CURSOCIP_Codigo`) REFERENCES `cursociclo` (`CURSOCIP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tema_semana` FOREIGN KEY (`PRODATRIB_Codigo`) REFERENCES `semana` (`PRODATRIB_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tema_tipoestudiociclo` FOREIGN KEY (`TIPCICLOP_Codigo`) REFERENCES `tipoestudiociclo` (`TIPCICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.tema: ~22 rows (aproximadamente)
DELETE FROM `tema`;
/*!40000 ALTER TABLE `tema` DISABLE KEYS */;
INSERT INTO `tema` (`PRODATRIBDET_Codigo`, `PRODATRIB_Codigo`, `CURSOCIP_Codigo`, `TIPCICLOP_Codigo`, `TEMAC_Descripcion`, `TEMAC_FechaModificacion`, `TEMAC_FechaRegistro`) VALUES
	(2, 1, 4, 1, 'Nociones basicas', '2015-09-21 11:46:35', '2015-09-21 11:45:31'),
	(3, 1, 4, 1, 'Segmentos de recta', NULL, '2015-09-21 11:46:52'),
	(4, 2, 4, 1, 'Triangulos', NULL, '2015-09-21 11:47:11'),
	(5, 2, 4, 1, 'Correspondecias entre agnulos y lados', NULL, '2015-09-21 11:47:32'),
	(6, 3, 4, 1, 'Congruencia de triangulos', NULL, '2015-09-21 11:47:57'),
	(7, 3, 4, 1, 'Aplicaciones de la congruencia', NULL, '2015-09-21 11:48:17'),
	(8, 4, 4, 1, 'Teorema de base media', NULL, '2015-09-21 11:48:35'),
	(9, 4, 4, 1, 'Poligonos', NULL, '2015-09-21 11:48:53'),
	(10, 5, 4, 1, 'Cuadrilateros', NULL, '2015-09-21 11:49:12'),
	(11, 5, 4, 1, 'Circunferencia', NULL, '2015-09-21 11:49:34'),
	(12, 6, 4, 1, 'Cuadrilaterio circunscrito y circunscriptible', NULL, '2015-09-21 11:50:03'),
	(13, 6, 4, 1, 'Angulos en la circunferencia', NULL, '2015-09-21 11:50:29'),
	(14, 7, 4, 1, 'Proporcionalidad', NULL, '2015-09-21 11:50:45'),
	(15, 7, 4, 1, 'Semejanza de triangulos', NULL, '2015-09-21 11:51:02'),
	(16, 8, 4, 1, 'Relacione metricas en el trianglo rectangulo', NULL, '2015-09-21 11:51:23'),
	(17, 8, 4, 1, 'Teorema de Heron', NULL, '2015-09-21 11:51:37'),
	(18, 9, 4, 1, 'Poligonos regulares', NULL, '2015-09-21 11:51:55'),
	(19, 9, 4, 1, 'Poligonos regulares notables inscritos', NULL, '2015-09-21 11:52:18'),
	(20, 21, 4, 11, 'Repaso de geometria plana', NULL, '2015-09-21 11:53:06'),
	(21, 21, 4, 11, 'Postulados y teroresmas de la congruencia de triangulos', NULL, '2015-09-21 11:53:32'),
	(22, 22, 4, 11, 'Teorema sobre paralelogramso trapecios', NULL, '2015-09-21 11:54:22'),
	(23, 22, 4, 11, 'Teorema de Thales', NULL, '2015-09-21 11:54:41');
/*!40000 ALTER TABLE `tema` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tipoasistencia
CREATE TABLE IF NOT EXISTS `tipoasistencia` (
  `TIPOASISP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `TIPOASISC_Nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`TIPOASISP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tipoasistencia: ~2 rows (aproximadamente)
DELETE FROM `tipoasistencia`;
/*!40000 ALTER TABLE `tipoasistencia` DISABLE KEYS */;
INSERT INTO `tipoasistencia` (`TIPOASISP_Codigo`, `TIPOASISC_Nombre`) VALUES
	(1, 'Tardanza'),
	(2, 'Reemplazo');
/*!40000 ALTER TABLE `tipoasistencia` ENABLE KEYS */;


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
  `TIPC_Nombre` varchar(100) DEFAULT NULL,
  `TIPC_Descripcion` varchar(100) DEFAULT NULL,
  `TIPC_FechaRegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TIPC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`TIPP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tipoestudio: ~7 rows (aproximadamente)
DELETE FROM `tipoestudio`;
/*!40000 ALTER TABLE `tipoestudio` DISABLE KEYS */;
INSERT INTO `tipoestudio` (`TIPP_Codigo`, `TIPC_Nombre`, `TIPC_Descripcion`, `TIPC_FechaRegistro`, `TIPC_FlagEstado`) VALUES
	(3, 'Pre', 'Tipo de Estudio para los alumnos que van a postular a la UNI', '2015-05-15 04:19:44', '1'),
	(4, 'Repaso', 'Tipo de estudio para los alumnos que requieren un repaso antes de postular a la UNI', '2015-05-15 04:19:49', '1'),
	(5, 'Basico', 'Tipo de Estudio para los alumnos que recien egresan del colegio', '2015-05-15 04:20:23', '1'),
	(6, 'Intensivo', 'Tipo de Estudio para resolver problemas antes de dar el examen de la UNI', '2015-05-15 04:20:28', '1'),
	(7, 'Escolar 3ero', 'Escuca a todos', '2015-08-10 12:16:34', '1'),
	(8, 'Escolar 4to', 'Escucha para ti', '2015-08-10 12:18:30', '1'),
	(9, 'Escolar 5to', 'Para ti o voz ddd', '2015-08-10 12:18:46', '1');
/*!40000 ALTER TABLE `tipoestudio` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tipoestudiociclo
CREATE TABLE IF NOT EXISTS `tipoestudiociclo` (
  `TIPCICLOP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `TIPP_Codigo` int(11) NOT NULL DEFAULT '0',
  `CICLOP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TIPCICLOC_Observacion` varchar(150) DEFAULT NULL,
  `TIPCICLOC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  `TIPCICLOC_FechaRegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TIPCICLOP_Codigo`),
  KEY `FK_tipoestudiociclo_tipoestudio` (`TIPP_Codigo`),
  KEY `FK_tipoestudiociclo_ciclo` (`CICLOP_Codigo`),
  CONSTRAINT `FK_tipoestudiociclo_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tipoestudiociclo_tipoestudio` FOREIGN KEY (`TIPP_Codigo`) REFERENCES `tipoestudio` (`TIPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tipoestudiociclo: ~7 rows (aproximadamente)
DELETE FROM `tipoestudiociclo`;
/*!40000 ALTER TABLE `tipoestudiociclo` DISABLE KEYS */;
INSERT INTO `tipoestudiociclo` (`TIPCICLOP_Codigo`, `TIPP_Codigo`, `CICLOP_Codigo`, `TIPCICLOC_Observacion`, `TIPCICLOC_FlagEstado`, `TIPCICLOC_FechaRegistro`) VALUES
	(1, 5, 1, 'gfgdfgdfg', '1', '2015-09-19 22:47:46'),
	(2, 4, 1, 'Por defecto', '1', '2015-09-21 08:29:31'),
	(3, 3, 1, 'Ciclo pre', '1', '2015-09-21 08:31:14'),
	(4, 6, 1, 'Este ciclo es intensico', '1', '2015-09-21 08:31:36'),
	(5, 7, 1, 'escolar', '1', '2015-09-21 08:32:08'),
	(8, 4, 2, 'sdfg', '1', '2015-09-21 08:33:59'),
	(9, 6, 2, 'sdfg', '1', '2015-09-21 08:34:10'),
	(11, 9, 1, 'Ciclo preparatoria', '1', '2015-09-21 10:37:27');
/*!40000 ALTER TABLE `tipoestudiociclo` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.tipoproducto: ~3 rows (aproximadamente)
DELETE FROM `tipoproducto`;
/*!40000 ALTER TABLE `tipoproducto` DISABLE KEYS */;
INSERT INTO `tipoproducto` (`TIPPROD_Codigo`, `CICLOP_Codigo`, `TIPPROD_Descripcion`, `TIPPROD_FlagEstado`, `TIPPROD_FechaModificacion`, `TIPPROD_FechaRegistro`) VALUES
	(0, 1, ':::SELECCIONE::', '1', NULL, '2014-10-06 19:37:56'),
	(1, 1, 'Matematicas', '1', NULL, '2011-01-04 04:31:10'),
	(4, 1, 'Letras', '1', NULL, '2015-10-16 09:23:18');
/*!40000 ALTER TABLE `tipoproducto` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tipotarea
CREATE TABLE IF NOT EXISTS `tipotarea` (
  `TIPOTAREAP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `TIPOTAREAC_Nombre` varchar(100) DEFAULT NULL,
  `TIPOTAREAC_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TIPOTAREAP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tipotarea: ~2 rows (aproximadamente)
DELETE FROM `tipotarea`;
/*!40000 ALTER TABLE `tipotarea` DISABLE KEYS */;
INSERT INTO `tipotarea` (`TIPOTAREAP_Codigo`, `TIPOTAREAC_Nombre`, `TIPOTAREAC_FechaRegistro`) VALUES
	(1, 'Problemas para PC', '2015-09-29 14:17:08'),
	(2, 'Problemas para Seminario', '2015-09-29 14:17:05'),
	(3, 'Revisión de probemas', '2015-09-29 14:17:07');
/*!40000 ALTER TABLE `tipotarea` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.usuario: ~5 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`USUA_Codigo`, `PERSP_Codigo`, `ROL_Codigo`, `USUA_usuario`, `USUA_Password`, `USUA_FlagEstado`, `USUA_FechaModificacion`, `USUA_FechaRegistro`) VALUES
	(7, 1, 4, 'demo', 'e10adc3949ba59abbe56e057f20f883e', '1', '2015-08-05 12:09:17', '2015-08-04 00:25:58'),
	(11, 174, 6, 'dalcantara', 'e10adc3949ba59abbe56e057f20f883e', '1', NULL, '2015-10-16 12:34:09'),
	(12, 94, 6, 'marevalo', 'e10adc3949ba59abbe56e057f20f883e', '1', NULL, '2015-10-16 12:37:35'),
	(13, 178, 6, 'jgamarra', 'e10adc3949ba59abbe56e057f20f883e', '1', NULL, '2015-10-16 12:38:03'),
	(14, 97, 6, 'dochoa', 'e10adc3949ba59abbe56e057f20f883e', '1', NULL, '2015-10-16 12:39:34');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.vigilancia
CREATE TABLE IF NOT EXISTS `vigilancia` (
  `VIGILAP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `VIGILAC_Nombre` varchar(50) NOT NULL,
  `VIGILAC_Descripcion` varchar(250) NOT NULL,
  `VIGILAC_Fecha` date NOT NULL,
  `VIGILAC_FechaModificacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `VIGILAC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`VIGILAP_Codigo`),
  KEY `FK_vigilancia_profesor` (`PROP_Codigo`),
  CONSTRAINT `FK_vigilancia_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.vigilancia: ~0 rows (aproximadamente)
DELETE FROM `vigilancia`;
/*!40000 ALTER TABLE `vigilancia` DISABLE KEYS */;
INSERT INTO `vigilancia` (`VIGILAP_Codigo`, `PROP_Codigo`, `VIGILAC_Nombre`, `VIGILAC_Descripcion`, `VIGILAC_Fecha`, `VIGILAC_FechaModificacion`, `VIGILAC_FechaRegistro`) VALUES
	(1, 7, 'werwer', 'werwer', '2015-10-09', '2015-10-16 15:16:23', '2015-10-09 22:36:42'),
	(2, 38, 'dgsdfg', 'sdfgsdfg', '2015-10-16', NULL, '2015-10-16 15:13:53');
/*!40000 ALTER TABLE `vigilancia` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.vigilanciadetalle
CREATE TABLE IF NOT EXISTS `vigilanciadetalle` (
  `VIGILADETP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `VIGILAP_Codigo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`VIGILADETP_Codigo`),
  KEY `FK_vigilanciadetalle_vigilancia` (`VIGILAP_Codigo`),
  CONSTRAINT `FK_vigilanciadetalle_vigilancia` FOREIGN KEY (`VIGILAP_Codigo`) REFERENCES `vigilancia` (`VIGILAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.vigilanciadetalle: ~0 rows (aproximadamente)
DELETE FROM `vigilanciadetalle`;
/*!40000 ALTER TABLE `vigilanciadetalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `vigilanciadetalle` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
