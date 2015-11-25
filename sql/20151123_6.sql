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

-- Volcando estructura para tabla 20denota.acceso
CREATE TABLE IF NOT EXISTS `acceso` (
  `ACCESOP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PERSP_Codigo` int(11) NOT NULL DEFAULT '0',
  `ACCESOC_Fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ACCESOP_Codigo`),
  KEY `FK_acceso_persona` (`PERSP_Codigo`),
  CONSTRAINT `FK_acceso_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.acceso: ~11 rows (aproximadamente)
DELETE FROM `acceso`;
/*!40000 ALTER TABLE `acceso` DISABLE KEYS */;
INSERT INTO `acceso` (`ACCESOP_Codigo`, `PERSP_Codigo`, `ACCESOC_Fecha`) VALUES
	(1, 1, '2015-11-23 09:15:37'),
	(2, 1, '2015-11-23 09:15:58'),
	(3, 1, '2015-11-23 09:28:14'),
	(4, 94, '2015-11-23 09:28:44'),
	(5, 1, '2015-11-23 09:30:26'),
	(8, 1, '2015-11-23 10:21:19'),
	(10, 1, '2015-11-23 10:23:41'),
	(11, 1, '2015-11-23 10:26:48');
/*!40000 ALTER TABLE `acceso` ENABLE KEYS */;


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
  `ACTAC_FechaModificacion` datetime DEFAULT NULL,
  `ACTAC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ACTAP_Codigo`),
  KEY `FK_acta_usuario` (`USUA_Codigo`),
  KEY `FK_acta_profesor` (`PROP_Codigo`),
  KEY `FK_acta_tipoestudiociclo` (`TIPCICLOP_Codigo`),
  CONSTRAINT `FK_acta_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_acta_tipoestudiociclo` FOREIGN KEY (`TIPCICLOP_Codigo`) REFERENCES `tipoestudiociclo` (`TIPCICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_acta_usuario` FOREIGN KEY (`USUA_Codigo`) REFERENCES `usuario` (`USUA_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.acta: ~5 rows (aproximadamente)
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

-- Volcando datos para la tabla 20denota.actadetalle: ~10 rows (aproximadamente)
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

-- Volcando datos para la tabla 20denota.actaprofesor: ~12 rows (aproximadamente)
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


-- Volcando estructura para tabla 20denota.afiliacion
CREATE TABLE IF NOT EXISTS `afiliacion` (
  `AFILIAP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `SOCIEDP_Codigo` int(11) NOT NULL DEFAULT '0',
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `AFILIAC_Fecha` date NOT NULL DEFAULT '0000-00-00',
  `AFILIAC_FechaModificacion` datetime DEFAULT NULL,
  `AFILIAC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AFILIAP_Codigo`),
  KEY `FK_afiliacion_sociedad` (`SOCIEDP_Codigo`),
  KEY `FK_afiliacion_profesor` (`PROP_Codigo`),
  CONSTRAINT `FK_afiliacion_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_afiliacion_sociedad` FOREIGN KEY (`SOCIEDP_Codigo`) REFERENCES `sociedad` (`SOCIEDP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.afiliacion: ~0 rows (aproximadamente)
DELETE FROM `afiliacion`;
/*!40000 ALTER TABLE `afiliacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `afiliacion` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.alumno
CREATE TABLE IF NOT EXISTS `alumno` (
  `CLIP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PERSP_Codigo` int(11) NOT NULL,
  `CLIC_FlagEstado` char(1) DEFAULT '1',
  `CLIC_FechaModificacion` datetime DEFAULT NULL,
  `CLIC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CLIP_Codigo`),
  KEY `FK_cliente_persona` (`PERSP_Codigo`),
  CONSTRAINT `FK_cliente_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.alumno: ~2 rows (aproximadamente)
DELETE FROM `alumno`;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` (`CLIP_Codigo`, `PERSP_Codigo`, `CLIC_FlagEstado`, `CLIC_FechaModificacion`, `CLIC_FechaRegistro`) VALUES
	(20, 179, '1', '2015-11-06 16:21:20', '2015-11-06 10:21:20'),
	(21, 180, '1', '2015-11-06 16:22:25', '2015-11-06 10:22:25');
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.asignacion
CREATE TABLE IF NOT EXISTS `asignacion` (
  `ASIGP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `CICLOP_Codigo` int(11) NOT NULL DEFAULT '0',
  `ASIGC_Descripcion` varchar(250) NOT NULL DEFAULT '0',
  `ASIGC_Fecha` datetime NOT NULL,
  `ASIGC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  `ASIGC_FechaModificacion` datetime DEFAULT NULL,
  `ASIGC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ASIGP_Codigo`),
  KEY `FK_asignacion_profesor` (`PROP_Codigo`),
  KEY `FK_asignacion_ciclo` (`CICLOP_Codigo`),
  CONSTRAINT `FK_asignacion_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_asignacion_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.asignacion: ~3 rows (aproximadamente)
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
  `ASIGDETC_FechaModificacion` datetime DEFAULT NULL,
  `ASIGDETC_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ASIGDETP_Codigo`),
  KEY `FK_asignaciondetalle_asignacion` (`ASIGP_Codigo`),
  KEY `FK_asignaciondetalle_aula` (`AULAP_Codigo`),
  KEY `FK_asignaciondetalle_tipoestudiociclo` (`TIPCICLOP_Codigo`),
  CONSTRAINT `FK_asignaciondetalle_asignacion` FOREIGN KEY (`ASIGP_Codigo`) REFERENCES `asignacion` (`ASIGP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_asignaciondetalle_aula` FOREIGN KEY (`AULAP_Codigo`) REFERENCES `aula` (`AULAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_asignaciondetalle_tipoestudiociclo` FOREIGN KEY (`TIPCICLOP_Codigo`) REFERENCES `tipoestudiociclo` (`TIPCICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.asignaciondetalle: ~10 rows (aproximadamente)
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


-- Volcando estructura para tabla 20denota.conferencia
CREATE TABLE IF NOT EXISTS `conferencia` (
  `CONFERP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROP_Codigo` int(11) NOT NULL,
  `CONFERC_Nombre` varchar(50) DEFAULT NULL,
  `CONFERC_Descripcion` varchar(150) DEFAULT NULL,
  `CONFERC_Fecha` date DEFAULT '0000-00-00',
  `CONFERC_FechaModificacion` datetime DEFAULT NULL,
  `CONFERC_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CONFERP_Codigo`),
  KEY `FK_conferencia_profesor` (`PROP_Codigo`),
  CONSTRAINT `FK_conferencia_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.conferencia: ~5 rows (aproximadamente)
DELETE FROM `conferencia`;
/*!40000 ALTER TABLE `conferencia` DISABLE KEYS */;
INSERT INTO `conferencia` (`CONFERP_Codigo`, `PROP_Codigo`, `CONFERC_Nombre`, `CONFERC_Descripcion`, `CONFERC_Fecha`, `CONFERC_FechaModificacion`, `CONFERC_FechaRegistro`) VALUES
	(1, 54, 'sgsdfg', 'sfgsdfg', '0000-00-00', NULL, '2015-11-06 12:16:49'),
	(2, 53, 'Date', 'Datefile', '2015-11-04', NULL, '2015-11-16 11:07:12'),
	(3, 53, 'Upa', 'Upa las Americas', '2015-11-11', NULL, '2015-11-16 11:07:51'),
	(4, 53, 'HOp', 'HOp asdf', '2015-11-12', NULL, '2015-11-16 11:08:29'),
	(5, 53, 'Los expedientes secretos', 'David Scully', '2015-11-04', NULL, '2015-11-16 11:10:07');
/*!40000 ALTER TABLE `conferencia` ENABLE KEYS */;


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
  `CURSOCIC_FechaModificacion` datetime DEFAULT NULL,
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
  `CURSOTIPOC_FechaModificacion` datetime DEFAULT NULL,
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
  `SECTORP_Codigo` int(11) NOT NULL,
  `EMPRC_Ruc` varchar(11) DEFAULT NULL,
  `EMPRC_RazonSocial` varchar(150) DEFAULT NULL,
  `EMPRC_Telefono` varchar(50) DEFAULT NULL,
  `EMPRC_Movil` varchar(50) DEFAULT NULL,
  `EMPRC_Fax` varchar(50) DEFAULT NULL,
  `EMPRC_Web` varchar(250) DEFAULT NULL,
  `EMPRC_Email` varchar(250) DEFAULT NULL,
  `EMPRC_FlagEstado` char(1) DEFAULT '1',
  `EMPRC_FechaModificacion` datetime DEFAULT NULL,
  `EMPRC_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`EMPRP_Codigo`),
  KEY `FK_empresa_sector` (`SECTORP_Codigo`),
  CONSTRAINT `FK_empresa_sector` FOREIGN KEY (`SECTORP_Codigo`) REFERENCES `sector` (`SECTORP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.empresa: ~2 rows (aproximadamente)
DELETE FROM `empresa`;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` (`EMPRP_Codigo`, `SECTORP_Codigo`, `EMPRC_Ruc`, `EMPRC_RazonSocial`, `EMPRC_Telefono`, `EMPRC_Movil`, `EMPRC_Fax`, `EMPRC_Web`, `EMPRC_Email`, `EMPRC_FlagEstado`, `EMPRC_FechaModificacion`, `EMPRC_FechaRegistro`) VALUES
	(0, 1, NULL, 'EMPRESA NO REGISTRADA', NULL, NULL, NULL, NULL, NULL, '1', NULL, '2010-12-17 04:34:56'),
	(1, 1, '11111111111', 'W', '', '', '', '', '', '0', NULL, '2011-01-09 15:30:59');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.estudios
CREATE TABLE IF NOT EXISTS `estudios` (
  `ESTUDIOP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `UNIVP_Codigo` int(11) NOT NULL DEFAULT '0',
  `GRADOP_Codigo` int(11) NOT NULL DEFAULT '0',
  `ESTUDIOC_Descripcion` varchar(150) DEFAULT NULL,
  `ESTUDIOC_Estado` char(1) NOT NULL DEFAULT '1' COMMENT '1:Culminado, 2:En curso,3:Abandonado',
  `ESTUDIOC_FechaInicio` date DEFAULT '0000-00-00',
  `ESTUDIOC_FechaFin` date DEFAULT '0000-00-00',
  `ESTUDIOC_FechaModificacion` datetime DEFAULT NULL,
  `ESTUDIOC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ESTUDIOP_Codigo`),
  KEY `FK_estudios_universidad` (`UNIVP_Codigo`),
  KEY `FK_estudios_grado` (`GRADOP_Codigo`),
  KEY `FK_estudios_profesor` (`PROP_Codigo`),
  CONSTRAINT `FK_estudios_grado` FOREIGN KEY (`GRADOP_Codigo`) REFERENCES `grado` (`GRADOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_estudios_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_estudios_universidad` FOREIGN KEY (`UNIVP_Codigo`) REFERENCES `universidad` (`UNIVP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.estudios: ~10 rows (aproximadamente)
DELETE FROM `estudios`;
/*!40000 ALTER TABLE `estudios` DISABLE KEYS */;
INSERT INTO `estudios` (`ESTUDIOP_Codigo`, `PROP_Codigo`, `UNIVP_Codigo`, `GRADOP_Codigo`, `ESTUDIOC_Descripcion`, `ESTUDIOC_Estado`, `ESTUDIOC_FechaInicio`, `ESTUDIOC_FechaFin`, `ESTUDIOC_FechaModificacion`, `ESTUDIOC_FechaRegistro`) VALUES
	(1, 54, 17, 1, 'primera carrera', '1', '0000-00-00', '0000-00-00', '2015-10-26 11:05:05', '2015-10-26 10:43:50'),
	(2, 54, 15, 5, 'segunda carrera', '1', '0000-00-00', '0000-00-00', '2015-10-26 11:05:08', '2015-10-26 10:44:04'),
	(3, 54, 9, 3, 'tercera carrera', '1', '0000-00-00', '0000-00-00', '2015-10-26 11:05:11', '2015-10-26 10:44:17'),
	(5, 54, 6, 3, 'Fisica', '1', '1952-05-01', '1952-04-01', NULL, '2015-11-09 07:29:10'),
	(6, 54, 15, 4, 'Ingles', '1', '1952-02-01', '1951-03-01', NULL, '2015-11-09 07:56:29'),
	(7, 54, 1, 1, 'olo', '1', '1951-04-01', '1951-03-01', NULL, '2015-11-09 08:28:15'),
	(8, 53, 4, 3, 'asdfsadf', '1', '1952-03-01', '1952-04-01', NULL, '2015-11-09 08:30:22'),
	(9, 53, 6, 4, 'Ciencias de la salud', '1', '1954-02-01', '1955-05-01', NULL, '2015-11-16 09:07:55'),
	(10, 53, 12, 4, 'Ciencias de la salud', '3', '1953-03-01', '1954-04-01', NULL, '2015-11-16 09:10:37'),
	(11, 53, 5, 4, 'Estomatologia', '2', '1955-04-01', '1967-04-01', NULL, '2015-11-16 09:15:24');
/*!40000 ALTER TABLE `estudios` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.estudiosidiomas
CREATE TABLE IF NOT EXISTS `estudiosidiomas` (
  `ESTIDIOMP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `IDIOMP_Codigo` int(11) NOT NULL DEFAULT '0',
  `ESTIDIOMC_Descripcion` varchar(150) DEFAULT NULL,
  `ESTIDIOMC_Nivel` char(1) NOT NULL DEFAULT '1',
  `ESTIDIOMC_Estado` char(1) DEFAULT '1' COMMENT '1:Culminado, 2:En curso,3:Abandonado',
  `ESTIDIOMC_FechaInicio` date DEFAULT '0000-00-00',
  `ESTIDIOMC_FechaFin` date DEFAULT '0000-00-00',
  `ESTIDIOMC_FechaModificacion` datetime DEFAULT NULL,
  `ESTIDIOMC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ESTIDIOMP_Codigo`),
  KEY `FK_estudiosidiomas_profesor` (`PROP_Codigo`),
  KEY `FK_estudiosidiomas_idiomas` (`IDIOMP_Codigo`),
  CONSTRAINT `FK_estudiosidiomas_idiomas` FOREIGN KEY (`IDIOMP_Codigo`) REFERENCES `idiomas` (`IDIOMP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_estudiosidiomas_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.estudiosidiomas: ~8 rows (aproximadamente)
DELETE FROM `estudiosidiomas`;
/*!40000 ALTER TABLE `estudiosidiomas` DISABLE KEYS */;
INSERT INTO `estudiosidiomas` (`ESTIDIOMP_Codigo`, `PROP_Codigo`, `IDIOMP_Codigo`, `ESTIDIOMC_Descripcion`, `ESTIDIOMC_Nivel`, `ESTIDIOMC_Estado`, `ESTIDIOMC_FechaInicio`, `ESTIDIOMC_FechaFin`, `ESTIDIOMC_FechaModificacion`, `ESTIDIOMC_FechaRegistro`) VALUES
	(1, 54, 1, 'afadsfsdf', '1', '1', '0000-00-00', '0000-00-00', NULL, '2015-11-06 12:03:27'),
	(2, 54, 4, '0', '2', '1', '1953-03-00', '1953-03-00', NULL, '2015-11-09 08:21:48'),
	(3, 54, 5, '0', '3', '1', '1954-03-00', '1954-03-00', NULL, '2015-11-09 08:27:00'),
	(4, 54, 2, '0', '1', '1', '1952-05-00', '1952-05-00', NULL, '2015-11-09 08:27:54'),
	(5, 53, 2, '0', '2', '1', '1952-03-00', '1955-07-00', NULL, '2015-11-16 08:09:16'),
	(6, 53, 1, '0', '2', '1', '1952-05-00', '1952-05-00', NULL, '2015-11-16 08:12:30'),
	(8, 50, 2, '0', '2', '2', '1950-04-00', '1950-04-00', NULL, '2015-11-17 09:15:55'),
	(9, 53, 5, '0', '2', '2', '1955-04-00', '1961-05-00', NULL, '2015-11-23 07:32:42');
/*!40000 ALTER TABLE `estudiosidiomas` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.experiencia
CREATE TABLE IF NOT EXISTS `experiencia` (
  `EXPERP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `UNIVP_Codigo` int(11) NOT NULL DEFAULT '0',
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `EXPERPC_Cargo` varchar(150) DEFAULT NULL,
  `EXPERPC_Empresa` varchar(150) DEFAULT NULL,
  `EXPERPC_Curso` varchar(150) DEFAULT NULL,
  `EXPERPC_FechaInicio` date DEFAULT '0000-00-00',
  `EXPERPC_FechaFin` date DEFAULT '0000-00-00',
  `EXPERPC_FechaModificacion` datetime DEFAULT NULL,
  `EXPERPC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`EXPERP_Codigo`),
  KEY `FK_experiencia_profesor` (`PROP_Codigo`),
  KEY `FK_experiencia_universidad` (`UNIVP_Codigo`),
  CONSTRAINT `FK_experiencia_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_experiencia_universidad` FOREIGN KEY (`UNIVP_Codigo`) REFERENCES `universidad` (`UNIVP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.experiencia: ~12 rows (aproximadamente)
DELETE FROM `experiencia`;
/*!40000 ALTER TABLE `experiencia` DISABLE KEYS */;
INSERT INTO `experiencia` (`EXPERP_Codigo`, `UNIVP_Codigo`, `PROP_Codigo`, `EXPERPC_Cargo`, `EXPERPC_Empresa`, `EXPERPC_Curso`, `EXPERPC_FechaInicio`, `EXPERPC_FechaFin`, `EXPERPC_FechaModificacion`, `EXPERPC_FechaRegistro`) VALUES
	(4, 1, 54, 'Jefe de Practica', NULL, 'Matematica Basica I', '0000-00-00', '0000-00-00', NULL, '2015-10-29 07:59:36'),
	(7, 1, 54, 'fasdfasdf', 'asdfasd', 'asdfasdf', '1954-03-00', '1954-03-00', NULL, '2015-11-09 06:42:13'),
	(8, 1, 54, 'Jefe de presupuestos', 'CAME S.A.', 'Lineas de transmision', '1953-05-00', '1953-05-00', NULL, '2015-11-09 06:43:20'),
	(9, 1, 54, 'Sistemas analista', 'MIMCO S.A.C.', 'Sap', '1954-05-00', '1954-05-00', NULL, '2015-11-09 06:47:40'),
	(10, 1, 54, 'sdfgsdf', 'dsfg', 'gsdfgsdfg', '1952-06-00', '1952-06-00', NULL, '2015-11-09 06:59:02'),
	(11, 1, 54, 'Analista funcional', 'COSAPI DATA', 'Primero tu', '1955-03-00', '1955-03-00', NULL, '2015-11-09 07:05:35'),
	(12, 1, 54, 'Profesor auxiliar', 'UNIVERSIDAD NACIONAL DE INGENIERIA', 'Matematica basicas II', '1953-04-00', '1953-04-00', NULL, '2015-11-09 07:07:37'),
	(13, 1, 54, 'Profesor auxiliar', 'UNIVERSIDAD', 'Matematica basicas II', '1953-04-00', '1953-04-00', NULL, '2015-11-09 07:07:51'),
	(14, 1, 54, 'Dibujante', 'Construcciones metalicas', 'Autocad', '1955-05-00', '1955-05-00', NULL, '2015-11-09 07:08:38'),
	(19, 16, 53, 'Docente', '0', 'Matematicas IIII', '1952-05-00', '1952-05-00', NULL, '2015-11-16 09:07:18'),
	(21, 8, 53, 'Profesor universitario', '0', 'Cepre-UNI', '1958-07-00', '2011-12-00', NULL, '2015-11-23 06:03:09'),
	(22, 7, 53, 'sdf', '0', 'sdf', '1954-05-00', '1955-05-00', NULL, '2015-11-23 06:15:08');
/*!40000 ALTER TABLE `experiencia` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.grado
CREATE TABLE IF NOT EXISTS `grado` (
  `GRADOP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `GRADOC_Descripcion` varchar(150) NOT NULL,
  `GRADOC_FechaModificacion` datetime DEFAULT NULL,
  `GRADOC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`GRADOP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.grado: ~5 rows (aproximadamente)
DELETE FROM `grado`;
/*!40000 ALTER TABLE `grado` DISABLE KEYS */;
INSERT INTO `grado` (`GRADOP_Codigo`, `GRADOC_Descripcion`, `GRADOC_FechaModificacion`, `GRADOC_FechaRegistro`) VALUES
	(1, 'Bachiller', NULL, '2015-10-26 07:29:06'),
	(2, 'Titulado', NULL, '2015-10-26 07:29:11'),
	(3, 'Maestria', NULL, '2015-10-26 07:29:16'),
	(4, 'Doctorado', NULL, '2015-10-26 07:29:21'),
	(5, 'Licenciado', NULL, '2015-10-26 08:48:33');
/*!40000 ALTER TABLE `grado` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.idiomas
CREATE TABLE IF NOT EXISTS `idiomas` (
  `IDIOMP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `IDIOMC_Descripcion` varchar(150) DEFAULT NULL,
  `IDIOMC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDIOMP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.idiomas: ~6 rows (aproximadamente)
DELETE FROM `idiomas`;
/*!40000 ALTER TABLE `idiomas` DISABLE KEYS */;
INSERT INTO `idiomas` (`IDIOMP_Codigo`, `IDIOMC_Descripcion`, `IDIOMC_FechaRegistro`) VALUES
	(1, 'Ingles', '2015-10-29 07:57:58'),
	(2, 'Frances', '2015-10-29 07:58:03'),
	(3, 'Aleman', '2015-10-29 07:58:14'),
	(4, 'Portugues', '2015-10-29 07:58:23'),
	(5, 'Italiano', '2015-10-29 07:58:28'),
	(6, 'Otros', '2015-10-29 07:59:02');
/*!40000 ALTER TABLE `idiomas` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.local
CREATE TABLE IF NOT EXISTS `local` (
  `LOCP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `LOCC_Nombre` varchar(150) NOT NULL,
  `LOCC_Direccion` varchar(250) NOT NULL,
  `LOCC_Telefono` varchar(250) NOT NULL,
  `LOCC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`LOCP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.local: ~3 rows (aproximadamente)
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
  `ORDENC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  `ORDENC_FechaModificacion` datetime DEFAULT NULL,
  `ORDENC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ORDENP_Codigo`),
  KEY `FK_orden_compania` (`CICLOP_Codigo`),
  KEY `FK_orden_cliente` (`CLIP_Codigo`),
  KEY `FK_orden_aula` (`AULAP_Codigo`),
  KEY `FK_matricula_tipoestudio` (`TIPP_Codigo`),
  CONSTRAINT `FK_matricula_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_matricula_tipoestudio` FOREIGN KEY (`TIPP_Codigo`) REFERENCES `tipoestudio` (`TIPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_orden_aula` FOREIGN KEY (`AULAP_Codigo`) REFERENCES `aula` (`AULAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_orden_cliente` FOREIGN KEY (`CLIP_Codigo`) REFERENCES `alumno` (`CLIP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.matricula: ~0 rows (aproximadamente)
DELETE FROM `matricula`;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
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
  `MENU_FlagEstado` char(1) DEFAULT '1',
  `MENU_FechaModificacion` datetime DEFAULT NULL,
  `MENU_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`MENU_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.menu: ~33 rows (aproximadamente)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`MENU_Codigo`, `MENU_Codigo_Padre`, `MENU_Descripcion`, `MENU_Comentario`, `MENU_Url`, `MENU_Orden`, `MENU_Imagen`, `MENU_FlagEstado`, `MENU_FechaModificacion`, `MENU_FechaRegistro`) VALUES
	(2, 58, 'Maestro de Alumnos', 'Aquí se podrán subir las imágenes o aniamciones que serán contenidas en la marquesina', 'index.php/ventas/alumno/listar', 1, 'alumno.jpg', '1', NULL, '2015-08-03 20:06:30'),
	(3, 1, 'MANTENIMIENTOS', '', 'index.php/almacen/curso/listar', 1, 'libros.jpg', '1', NULL, '2015-06-20 22:04:31'),
	(4, 1, 'PROCESOS', '', 'index.php/ventas/orden/listar', 2, 'matri.jpg', '1', NULL, '2015-08-12 15:34:09'),
	(22, 75, 'Maestro de Cursos', 'Maestro de Cursos', 'index.php/almacen/curso/listar', 1, '', '1', NULL, '2015-08-11 08:27:54'),
	(48, 4, 'Matricula', 'Matricula', 'index.php/ventas/matricula/listar', 1, 'matri.jpg', '1', NULL, '2015-07-24 22:52:04'),
	(49, 4, 'Cargas de trabajo', 'Cargas de trabajo', 'index.php/ventas/asignacion/listar', 1, NULL, '1', NULL, '2015-10-01 00:30:47'),
	(52, 3, 'Documentos', NULL, 'index.php/inicio/principal', 4, NULL, '1', NULL, '2015-08-12 15:35:34'),
	(53, 58, 'Maestro de Profesores', 'Tabla de Profesores', 'index.php/ventas/profesor/listar', 1, NULL, '1', NULL, '2015-08-03 20:06:22'),
	(55, 3, 'Ejemplo 1', 'Ejemplo 1', 'index.php/almacen/curso/listar', 1, NULL, '1', NULL, '2015-04-02 20:40:06'),
	(56, 3, 'Ejemplo 3', 'Ejemplo 3', 'index.php/almacen/curso/listar', 1, NULL, '1', NULL, '2015-08-05 11:48:18'),
	(57, 56, 'Ejemplo 5', 'Ejemplo 5', 'Ejemplo5', 1, NULL, '1', NULL, '2015-04-02 21:18:33'),
	(58, 3, 'Configuracion Personal', NULL, '#', 1, NULL, '1', NULL, '2015-08-03 20:05:22'),
	(59, 74, 'Maestro de Aulas', 'Maestro de Aulas', 'index.php/maestros/aula/listar', 6, NULL, '1', NULL, '2015-11-16 12:29:53'),
	(61, 74, 'Maestro de Locales', 'Maestro de Locales', 'index.php/maestros/local/listar', 5, NULL, '1', NULL, '2015-11-16 12:29:51'),
	(62, 74, 'Maestro de Ciclo', 'Maestro de Ciclo', 'index.php/maestros/ciclo/listar', 1, NULL, '1', NULL, '2015-10-16 12:43:26'),
	(63, 74, 'Tipo Estudio ', NULL, 'index.php/maestros/tipoestudio/listar', 2, NULL, '1', NULL, '2015-09-08 00:20:56'),
	(64, 1, 'REPORTES Y CONSULTAS', NULL, NULL, 3, NULL, '1', NULL, '2015-08-12 15:34:20'),
	(65, 2, 'Alumnos pequeños', NULL, NULL, 1, NULL, '1', NULL, '2015-06-20 23:06:16'),
	(66, 58, 'Maestro de Usuarios', 'Usuarios', 'index.php/seguridad/usuario/listar', 1, NULL, '1', NULL, '2015-08-03 20:05:56'),
	(67, 4, 'Reuniones de plana', 'Actas de reunion', 'index.php/ventas/acta/listar', 2, NULL, '1', NULL, '2015-10-01 00:33:09'),
	(68, 4, 'Tareas asignadas', 'Tareas asignadas', 'index.php/ventas/tarea/listar', 4, NULL, '1', NULL, '2015-10-06 15:47:24'),
	(69, 4, 'Vigilancia de examenes', 'Vigilancia de examenes', 'index.php/ventas/vigilancia/listar', 5, NULL, '1', NULL, '2015-10-09 22:22:49'),
	(70, 4, 'Tardanzas Reemplazos', 'Tardanzas Reemplazos', 'index.php/ventas/tardanza/listar', 3, NULL, '1', NULL, '2015-10-09 18:38:25'),
	(71, 4, 'Asistencia de alumnos', 'Asistencia de alumnos', 'index.php/ventas/asistencia/editar', 1, NULL, '1', NULL, '2015-07-30 22:19:35'),
	(72, 74, 'Maestro de Semana', 'Maestro de Semana', 'index.php/almacen/semana/listar', 4, NULL, '1', NULL, '2015-11-16 12:28:47'),
	(73, 75, 'Maestro de Temas', 'Maestro de Temas', 'index.php/almacen/tema/listar', 4, NULL, '1', NULL, '2015-08-12 15:29:17'),
	(74, 3, 'Configuracion Sistema', 'Configuracion Sistema', '#', 3, NULL, '1', NULL, '2015-08-12 15:35:19'),
	(75, 3, 'Configuracion Cursos', 'Configuracion Cursos', '#', 2, NULL, '1', NULL, '2015-08-12 15:35:17'),
	(76, 75, 'Maestro de Cursos Ciclo', 'Maestro de Cursos Ciclo', 'index.php/almacen/cursociclo/listar', 2, NULL, '1', NULL, '2015-08-12 15:28:56'),
	(77, 75, 'Maestro de Cursos Tipo', 'Maestro de Cursos Tipo', 'index.php/almacen/cursotipoestudio/listar', 3, NULL, '1', NULL, '2015-08-12 16:08:25'),
	(78, 74, 'Tipo Estudio por ciclo', NULL, 'index.php/maestros/tipoestudiociclo/listar', 3, NULL, '1', NULL, '2015-09-19 22:19:29'),
	(79, 74, 'Maestro de Empresas', 'Maestro de Empresas', 'index.php/maestros/empresa/listar', 7, NULL, '1', NULL, '2015-11-16 12:32:52'),
	(80, 74, 'Maestro de Sectores', 'Maestro de Sectores', 'index.php/maestros/sector/listar', 8, NULL, '1', NULL, '2015-11-16 12:33:31');
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
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.permiso: ~50 rows (aproximadamente)
DELETE FROM `permiso`;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` (`PERM_Codigo`, `ROL_Codigo`, `MENU_Codigo`, `PERM_FlagEstado`) VALUES
	(4, 4, 3, '1'),
	(5, 4, 4, '1'),
	(29, 4, 22, '1'),
	(33, 4, 49, '1'),
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
	(91, 6, 78, '1'),
	(92, 4, 79, '1'),
	(93, 4, 80, '1');
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
  `PERSC_FlagEstado` char(1) DEFAULT '1',
  `PERSC_FechaModificacion` datetime DEFAULT NULL,
  `PERSC_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PERSP_Codigo`),
  KEY `FK_persona_tipodocumento` (`TIPDOCP_Codigo`),
  CONSTRAINT `FK_persona_tipodocumento` FOREIGN KEY (`TIPDOCP_Codigo`) REFERENCES `tipodocumento` (`TIPDOCP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.persona: ~54 rows (aproximadamente)
DELETE FROM `persona`;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`PERSP_Codigo`, `TIPDOCP_Codigo`, `PERSC_ApellidoPaterno`, `PERSC_ApellidoMaterno`, `PERSC_Nombre`, `PERSC_NumeroDocIdentidad`, `PERSC_Direccion`, `PERSC_Telefono`, `PERSC_Movil`, `PERSC_Fax`, `PERSC_Email`, `PERSC_Domicilio`, `PERSC_Web`, `PERSC_Sexo`, `PERSC_FechaNacimiento`, `PERSC_FlagEstado`, `PERSC_FechaModificacion`, `PERSC_FechaRegistro`) VALUES
	(1, 1, 'Dolores', 'Flores', 'Maria', '0', '0', '0', '0', '0', '', '0', '0', '0', '0000-00-00', '1', '2015-08-05 11:53:24', '2010-12-29 20:15:19'),
	(88, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'AV. ABANCAY 986 S.M.P.', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'AV. ABANCAY 986 S.M.P.', '0', '0', '1980-03-19', '1', '2015-08-05 00:27:56', '2015-03-21 11:32:00'),
	(89, 1, 'FIGUEROA', 'MALDONADO', 'EDWARD', '40772496', 'ABANCAY 986 SMP', '5681903', '0', '0', 'edward.figueroa.ing@gmail.com', 'ABANCAY 986 SMP', '0', '0', '2015-03-18', '1', '2015-08-05 00:27:56', '2015-03-21 11:32:58'),
	(91, 1, 'Figueroa', 'Maldonado', 'Edward', '0', '0', '0', '0', '0', '', '0', '0', '1', '0000-00-00', '1', '2015-10-16 15:42:56', '2015-04-04 15:07:59'),
	(93, 1, 'VASQUEZ', 'DOMINGUEZ', 'RIQUELMER', '0', '0', '0', '0', '0', '', '0', '0', '0', '0000-00-00', '1', '2015-08-05 18:52:51', '2015-05-16 12:23:59'),
	(94, 1, 'Arevalo', 'Villanueva', 'Manuel', '234234', '', '324234324', '2', '0', '', '', '0', '1', '0000-00-00', '1', '2015-10-16 09:50:38', '2015-05-16 12:25:47'),
	(97, 1, 'Lazo', 'Ochoa', 'Domingo Pedro', '0', '0', '0', '0', '0', '', '0', '0', '1', '0000-00-00', '1', '2015-10-16 12:39:04', '2015-05-30 05:31:56'),
	(98, 1, 'PLANAS', 'VIGO', 'PEDRO', '24353453', 'ASDFSADF', '34234234234', '0', '0', 'pedro.planas@gmail.com', 'ASDFSADF', '0', '0', '2015-07-21', '1', '2015-08-05 00:27:56', '2015-07-27 16:08:29'),
	(99, 1, 'NICOMEDES', 'PLACENCIA', 'HUGO', '2342342', 'MZ R LOTE 50 LOS NISPEROS', '23424234', '0', '0', 'hugo.placencia@gmail.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-07-23', '1', '2015-08-05 00:27:56', '2015-07-27 16:09:18'),
	(100, 1, 'Amoretti', 'Vidal', 'Jesus', '435345', '', '324234234', '0', '0', '', '', '0', '0', '2015-07-10', '1', '2015-10-16 12:32:33', '2015-07-27 16:12:47'),
	(101, 1, 'RODRIGUEZ', 'RICARDO', 'ROLANDO', '0', '0', '0', '0', '0', '', '0', '0', '0', '0000-00-00', '1', '2015-08-05 18:52:58', '2015-07-27 16:14:37'),
	(136, 0, 'sanchez', 'calderon', 'josefina', '0', '0', '0', '0', '0', '', '0', '0', '0', '0000-00-00', '1', NULL, '2015-08-05 18:53:28'),
	(137, 0, 'Alvarado', 'Jaramillo', 'Luis', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:07:14'),
	(138, 0, 'Alvarado', 'Jaramillo', 'Luis', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:07:22'),
	(139, 0, 'ArÃ©valo', 'Castro', 'VÃ­ctor Manuel', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:08:19'),
	(140, 0, 'Arias ', 'Chumpitaz', 'Ulises', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:08:54'),
	(141, 0, 'Barzola', 'Esteban', 'Marcelo Ricardo', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:09:40'),
	(142, 0, 'Espirme', 'Ortega', 'David', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:09:59'),
	(143, 0, 'Lopez', 'Esquivel', 'Miguel Angel', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:10:47'),
	(144, 0, 'Mamani', 'Sulca', 'Oscar Manuel', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:11:14'),
	(145, 0, 'Mas', 'Huaman', 'Ronald Jesus', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:11:38'),
	(146, 0, 'Mejia ', 'Rodrigo', 'Edwin Octavio', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:12:16'),
	(147, 0, 'Minaya', 'Ames', 'Julio Cesar', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:12:48'),
	(148, 0, 'Nizama', 'Victoria', 'Luis', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:13:07'),
	(149, 0, 'Norabuena', 'Meza', 'Edgar', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:13:32'),
	(150, 0, 'Ã‘aupari', 'Huatuco', 'Zocimo', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:14:06'),
	(151, 0, 'Perez', 'Cupe', 'Rosulo', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:14:25'),
	(152, 0, 'Reyes', 'MuÃ±oz', 'Elva Flor', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:14:45'),
	(153, 0, 'Silva', 'Santiesteban', 'Mario', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:15:08'),
	(154, 0, 'Silvestre', 'Valer', 'Jim', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:33:28'),
	(155, 0, 'Sotelo', 'Chico', 'Jose Carlos', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', '2015-10-16 09:43:58', '2015-10-16 09:34:35'),
	(157, 0, 'Tori', 'Loza', 'Jose', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:45:09'),
	(158, 0, 'Valderrama', 'Soto', 'Ericka', '', '', '', '', '0', '', '', '0', '2', '0000-00-00', '1', NULL, '2015-10-16 09:45:34'),
	(159, 0, 'Vidal', 'Dominguez', 'Emilio', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:45:58'),
	(160, 0, 'Visurraga', 'Reinoso', 'Roberto', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:46:20'),
	(162, 0, 'Cabrera', 'Chavez', 'Julio Cesar', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:47:31'),
	(163, 0, 'Escudero', 'Acero', 'Phamela Estefany', '', '', '', '', '0', '', '', '0', '2', '0000-00-00', '1', NULL, '2015-10-16 09:48:05'),
	(164, 0, 'Espinoza', 'Vasquez', 'Manuel', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:48:24'),
	(165, 0, 'Gallardo', 'Vasquez', 'Pablo', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:48:41'),
	(166, 0, 'Gamarra', 'Lescano', 'Melbert Gustavo', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:49:18'),
	(167, 0, 'Huaccha', 'Quiroz', 'Eduardo', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:49:36'),
	(168, 0, 'Huaranca', 'Tanta', 'Sergio', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:49:59'),
	(169, 0, 'Arias', 'Antonio', 'Leandro', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:51:06'),
	(170, 0, 'Custodio', 'Ching', 'Victor', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 09:51:32'),
	(171, 0, 'Andy', 'Chinchay', 'Alberto', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 12:30:18'),
	(172, 0, 'Arambulo', 'Ostos', 'Carlos', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 12:30:45'),
	(173, 0, 'Carbonel', 'Olazabal', 'Daniel Roberto', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 12:31:13'),
	(174, 0, 'Alcantara', 'Malca', 'Daniel Alonso', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 12:32:59'),
	(175, 0, 'Flores', 'Garcia', 'Jose', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 12:35:11'),
	(176, 0, 'Rosales ', 'Huamani', 'Jimmy', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 12:35:36'),
	(177, 1, 'Alania', 'Lazo', 'Nelly', '40000000', 'Mz R Lote 50 Los Nisperos', '12313123', '3245234234324234', '0', 'martin.trujillo1105@gmail.com', 'Mz R Lote 50 Los Nisperos', '0', '2', '2015-11-11', '1', NULL, '2015-10-16 12:36:00'),
	(178, 0, 'Gamarra', 'La Rosa', 'Jose Luis', '', '', '', '', '0', '', '', '0', '1', '0000-00-00', '1', NULL, '2015-10-16 12:36:26'),
	(179, 0, 'Mitanda', 'Cuadros', 'Yordi', '12313232', 'Mz G Lote 6 - Los Chasquis', '997157682', '0', '0', 'yordi_efra@hotmail.com', 'Mz G Lote 6 - Los Chasquis', '0', '0', '2005-11-17', '1', NULL, '2015-11-06 10:21:20'),
	(180, 0, 'Chuquisaca', 'Chec-huaya', 'Rosmery Melissa', '23423423', 'Mz R Lote 24 Los NÃ­speros', '', '0', '0', '', 'Mz R Lote 24 Los NÃ­speros', '0', '0', '0000-00-00', '1', NULL, '2015-11-06 10:22:25');
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
  `PRODPREC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  `PRODPREC_FechaModificacion` datetime DEFAULT NULL,
  `PRODPREC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `PROC_FlagCoordinador` int(1) NOT NULL DEFAULT '2' COMMENT '1:Coordinador;2:Profesor',
  `PROC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  `PROC_FechaModificacion` datetime DEFAULT NULL,
  `PROC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PROP_Codigo`),
  UNIQUE KEY `PERSP_Codigo` (`PERSP_Codigo`),
  KEY `FK_profesor_persona` (`PERSP_Codigo`),
  KEY `FK_profesor_curso` (`PROD_Codigo`),
  CONSTRAINT `FK_profesor_curso` FOREIGN KEY (`PROD_Codigo`) REFERENCES `curso` (`PROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_profesor_persona` FOREIGN KEY (`PERSP_Codigo`) REFERENCES `persona` (`PERSP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.profesor: ~47 rows (aproximadamente)
DELETE FROM `profesor`;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` (`PROP_Codigo`, `PROD_Codigo`, `PERSP_Codigo`, `PROC_FlagCoordinador`, `PROC_FlagEstado`, `PROC_FechaModificacion`, `PROC_FechaRegistro`) VALUES
	(5, 93, 91, 2, '1', '2015-10-16 22:42:56', '2015-05-16 09:00:24'),
	(6, 93, 93, 2, '1', '2015-05-16 00:00:00', '2015-05-16 12:24:00'),
	(7, 93, 94, 1, '1', '2015-10-16 16:50:38', '2015-05-16 12:25:47'),
	(8, 5, 97, 1, '1', '2015-10-16 19:39:04', '2015-05-30 05:31:56'),
	(9, 5, 98, 2, '1', '2015-07-27 00:00:00', '2015-07-27 16:08:29'),
	(10, 5, 99, 2, '1', '2015-07-27 00:00:00', '2015-07-27 16:09:18'),
	(11, 92, 100, 2, '1', '2015-10-16 19:32:33', '2015-07-27 16:12:47'),
	(12, 95, 101, 2, '1', '2015-07-27 00:00:00', '2015-07-27 16:14:37'),
	(14, 95, 138, 2, '1', '2015-10-16 16:07:22', '2015-10-16 09:07:22'),
	(15, 95, 139, 2, '1', '2015-10-16 16:08:19', '2015-10-16 09:08:19'),
	(16, 95, 140, 2, '1', '2015-10-16 16:08:54', '2015-10-16 09:08:54'),
	(17, 95, 141, 2, '1', '2015-10-16 16:09:40', '2015-10-16 09:09:40'),
	(18, 95, 142, 2, '1', '2015-10-16 16:09:59', '2015-10-16 09:09:59'),
	(19, 95, 143, 2, '1', '2015-10-16 16:10:47', '2015-10-16 09:10:47'),
	(20, 95, 144, 2, '1', '2015-10-16 16:11:14', '2015-10-16 09:11:14'),
	(21, 95, 145, 2, '1', '2015-10-16 16:11:39', '2015-10-16 09:11:39'),
	(22, 95, 146, 2, '1', '2015-10-16 16:12:16', '2015-10-16 09:12:16'),
	(23, 95, 147, 2, '1', '2015-10-16 16:12:48', '2015-10-16 09:12:48'),
	(24, 95, 148, 2, '1', '2015-10-16 16:13:07', '2015-10-16 09:13:07'),
	(25, 95, 149, 2, '1', '2015-10-16 16:13:32', '2015-10-16 09:13:32'),
	(26, 95, 150, 2, '1', '2015-10-16 16:14:06', '2015-10-16 09:14:06'),
	(27, 95, 151, 2, '1', '2015-10-16 16:14:25', '2015-10-16 09:14:25'),
	(28, 95, 152, 2, '1', '2015-10-16 16:14:45', '2015-10-16 09:14:45'),
	(29, 95, 153, 2, '1', '2015-10-16 16:15:08', '2015-10-16 09:15:08'),
	(30, 95, 154, 2, '1', '2015-10-16 16:33:28', '2015-10-16 09:33:28'),
	(31, 95, 155, 2, '1', '2015-10-16 16:44:38', '2015-10-16 09:34:35'),
	(33, 95, 157, 2, '1', '2015-10-16 16:45:09', '2015-10-16 09:45:09'),
	(34, 95, 158, 2, '1', '2015-10-16 16:45:34', '2015-10-16 09:45:34'),
	(35, 95, 159, 2, '1', '2015-10-16 16:45:58', '2015-10-16 09:45:58'),
	(36, 95, 160, 1, '1', '2015-11-16 18:26:46', '2015-10-16 09:46:20'),
	(38, 96, 162, 2, '1', '2015-10-16 16:47:31', '2015-10-16 09:47:31'),
	(39, 96, 163, 2, '1', '2015-10-16 16:48:05', '2015-10-16 09:48:05'),
	(40, 96, 164, 2, '1', '2015-10-16 16:48:24', '2015-10-16 09:48:24'),
	(41, 96, 165, 2, '1', '2015-10-16 16:48:42', '2015-10-16 09:48:42'),
	(42, 96, 166, 2, '1', '2015-10-16 16:49:18', '2015-10-16 09:49:18'),
	(43, 96, 167, 2, '1', '2015-10-16 16:49:36', '2015-10-16 09:49:36'),
	(44, 96, 168, 2, '1', '2015-10-16 16:49:59', '2015-10-16 09:49:59'),
	(45, 93, 169, 2, '1', '2015-10-16 16:51:06', '2015-10-16 09:51:06'),
	(46, 93, 170, 2, '1', '2015-10-16 16:51:32', '2015-10-16 09:51:32'),
	(47, 5, 171, 2, '1', '2015-10-16 19:30:18', '2015-10-16 12:30:18'),
	(48, 5, 172, 2, '1', '2015-10-16 19:30:45', '2015-10-16 12:30:45'),
	(49, 5, 173, 2, '1', '2015-10-16 19:31:13', '2015-10-16 12:31:13'),
	(50, 92, 174, 1, '1', '2015-10-16 19:32:59', '2015-10-16 12:32:59'),
	(51, 97, 175, 2, '1', '2015-10-16 19:35:11', '2015-10-16 12:35:11'),
	(52, 97, 176, 2, '1', '2015-10-16 19:35:36', '2015-10-16 12:35:36'),
	(53, 98, 177, 2, '1', '2015-11-16 18:26:36', '2015-10-16 12:36:00'),
	(54, 98, 178, 1, '1', '2015-10-16 19:36:50', '2015-10-16 12:36:26');
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.profesorsociedad
CREATE TABLE IF NOT EXISTS `profesorsociedad` (
  `PROFSOCP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `SOCIEDP_Codigo` int(11) NOT NULL DEFAULT '0',
  `PROFSOCC_FechaSuscripcion` date NOT NULL DEFAULT '0000-00-00',
  `PROFSOCC_FechaModificacion` datetime DEFAULT NULL,
  `PROFSOCC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PROFSOCP_Codigo`),
  KEY `FK_profesorsociedad_profesor` (`PROP_Codigo`),
  KEY `FK_profesorsociedad_sociedad` (`SOCIEDP_Codigo`),
  CONSTRAINT `FK_profesorsociedad_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_profesorsociedad_sociedad` FOREIGN KEY (`SOCIEDP_Codigo`) REFERENCES `sociedad` (`SOCIEDP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.profesorsociedad: ~6 rows (aproximadamente)
DELETE FROM `profesorsociedad`;
/*!40000 ALTER TABLE `profesorsociedad` DISABLE KEYS */;
INSERT INTO `profesorsociedad` (`PROFSOCP_Codigo`, `PROP_Codigo`, `SOCIEDP_Codigo`, `PROFSOCC_FechaSuscripcion`, `PROFSOCC_FechaModificacion`, `PROFSOCC_FechaRegistro`) VALUES
	(4, 54, 2, '0000-00-00', NULL, '2015-11-06 12:31:20'),
	(5, 54, 1, '0000-00-00', NULL, '2015-11-06 12:31:28'),
	(6, 53, 1, '0000-00-00', NULL, '2015-11-16 11:22:47'),
	(7, 53, 1, '0000-00-00', NULL, '2015-11-16 11:22:52'),
	(8, 53, 2, '2015-11-19', NULL, '2015-11-16 11:26:15'),
	(9, 53, 1, '2015-11-19', NULL, '2015-11-16 11:26:28');
/*!40000 ALTER TABLE `profesorsociedad` ENABLE KEYS */;


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
  `ROL_FlagEstado` char(1) DEFAULT '1',
  `ROL_FechaModificacion` datetime DEFAULT NULL,
  `ROL_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ROL_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla 20denota.rol: ~3 rows (aproximadamente)
DELETE FROM `rol`;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`ROL_Codigo`, `ROL_Descripcion`, `ROL_FlagEstado`, `ROL_FechaModificacion`, `ROL_FechaRegistro`) VALUES
	(0, ':::Seleccione:::', '1', NULL, '2015-08-05 16:08:09'),
	(4, 'Coordinador general', '1', NULL, '2015-10-16 08:53:26'),
	(6, 'Coordinador de plana', '1', NULL, '2015-05-16 11:09:41');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.sector
CREATE TABLE IF NOT EXISTS `sector` (
  `SECTORP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `SECTORC_Descripcion` varchar(150) DEFAULT NULL,
  `SECTORC_FechaModificacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SECTORC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`SECTORP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.sector: ~6 rows (aproximadamente)
DELETE FROM `sector`;
/*!40000 ALTER TABLE `sector` DISABLE KEYS */;
INSERT INTO `sector` (`SECTORP_Codigo`, `SECTORC_Descripcion`, `SECTORC_FechaModificacion`, `SECTORC_FechaRegistro`) VALUES
	(1, 'Educacion', '0000-00-00 00:00:00', '2015-11-16 11:32:23'),
	(2, 'Pesqueria', '0000-00-00 00:00:00', '2015-11-16 11:32:30'),
	(3, 'Mineria', '0000-00-00 00:00:00', '2015-11-16 11:32:36'),
	(4, 'Construccion', '0000-00-00 00:00:00', '2015-11-16 11:32:43'),
	(5, 'Metalmecanico', '0000-00-00 00:00:00', '2015-11-16 11:32:50'),
	(6, 'Electricidad', '0000-00-00 00:00:00', '2015-11-16 11:32:57');
/*!40000 ALTER TABLE `sector` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.semana
CREATE TABLE IF NOT EXISTS `semana` (
  `PRODATRIB_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `CICLOP_Codigo` int(11) NOT NULL,
  `TIPCICLOP_Codigo` int(11) NOT NULL,
  `PRODATRIB_Nombre` varchar(250) DEFAULT NULL,
  `PRODATRIB_Descripcion` varchar(250) DEFAULT NULL,
  `PRODATRIB_FechaInicio` date NOT NULL DEFAULT '0000-00-00',
  `PRODATRIB_FechaFin` date NOT NULL DEFAULT '0000-00-00',
  `PRODATRIB_FechaModificacion` datetime DEFAULT NULL,
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


-- Volcando estructura para tabla 20denota.sociedad
CREATE TABLE IF NOT EXISTS `sociedad` (
  `SOCIEDP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `SOCIEDC_Nombre` varchar(50) NOT NULL,
  `SOCIEDC_Descripcion` varchar(150) NOT NULL,
  `SOCIEDC_FechaModificacion` datetime DEFAULT NULL,
  `SOCIEDC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`SOCIEDP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.sociedad: ~2 rows (aproximadamente)
DELETE FROM `sociedad`;
/*!40000 ALTER TABLE `sociedad` DISABLE KEYS */;
INSERT INTO `sociedad` (`SOCIEDP_Codigo`, `SOCIEDC_Nombre`, `SOCIEDC_Descripcion`, `SOCIEDC_FechaModificacion`, `SOCIEDC_FechaRegistro`) VALUES
	(1, 'IEE', 'Instituto de Ingeniero Electricos Electricisas', NULL, '2015-11-06 12:30:09'),
	(2, 'AEP', 'Asociacion Electrotecnica Peruana', NULL, '2015-11-06 12:30:26');
/*!40000 ALTER TABLE `sociedad` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tarea
CREATE TABLE IF NOT EXISTS `tarea` (
  `TAREAP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `USUA_Codigo` int(11) NOT NULL,
  `PROP_Codigo` int(11) NOT NULL,
  `CICLOP_Codigo` int(11) NOT NULL,
  `TIPOTAREAP_Codigo` int(11) DEFAULT NULL,
  `TAREAC_Nombre` varchar(500) NOT NULL,
  `TAREAC_Descripcion` varchar(500) NOT NULL,
  `TAREAC_Numero` int(11) DEFAULT NULL,
  `TAREAC_Fecha` date NOT NULL DEFAULT '0000-00-00',
  `TAREAC_FechaEntrega` date NOT NULL DEFAULT '0000-00-00',
  `TAREAC_FechaModificacion` datetime DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tarea: ~8 rows (aproximadamente)
DELETE FROM `tarea`;
/*!40000 ALTER TABLE `tarea` DISABLE KEYS */;
INSERT INTO `tarea` (`TAREAP_Codigo`, `USUA_Codigo`, `PROP_Codigo`, `CICLOP_Codigo`, `TIPOTAREAP_Codigo`, `TAREAC_Nombre`, `TAREAC_Descripcion`, `TAREAC_Numero`, `TAREAC_Fecha`, `TAREAC_FechaEntrega`, `TAREAC_FechaModificacion`, `TAREAC_FechaRegistro`) VALUES
	(1, 7, 7, 1, 1, 'tarea de todos', 'asdfasdf hola a todos', 33, '2015-09-01', '2015-09-15', '2015-09-29 15:07:41', '2015-09-29 14:00:20'),
	(2, 7, 50, 1, 1, 'Problemas de fisica', 'adfasdf', 22, '2015-09-29', '2015-09-17', '2015-10-24 07:38:11', '2015-09-29 15:00:40'),
	(3, 7, 8, 1, 1, 'Mi casa es tu cas', 'asdfasdfsdf', 20, '2015-09-29', '2015-09-23', '2015-10-24 07:38:47', '2015-09-29 15:01:06'),
	(4, 7, 11, 1, 1, 'asdasd', 'asdasdasasddas gfd gfd dfg', 99, '2015-09-29', '2015-09-30', NULL, '2015-09-29 15:10:10'),
	(5, 7, 5, 1, 1, 'ertertertertre treterter tr', 'ertertertert ttttt dddd', 100, '2015-09-29', '2015-10-16', '2015-10-08 20:05:10', '2015-09-29 16:13:41'),
	(6, 7, 7, 1, 3, '1111111', 'wertwert', 333, '2015-10-10', '2015-10-13', '2015-10-22 00:30:24', '2015-10-09 18:21:35'),
	(7, 7, 54, 1, 3, 'dsfdasf', 'afsdasdfsadf', 3, '2015-10-22', '2015-10-07', NULL, '2015-10-22 00:25:35'),
	(8, 7, 8, 1, 3, 'ola a todos', 'adsf', 3, '2015-10-24', '2015-10-07', NULL, '2015-10-24 07:34:39');
/*!40000 ALTER TABLE `tarea` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tareadetalle
CREATE TABLE IF NOT EXISTS `tareadetalle` (
  `TAREADETP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `TAREAP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TIPCICLOP_Codigo` int(11) NOT NULL DEFAULT '0',
  `PROP_Codigo` int(11) DEFAULT '0',
  `PRODATRIBDET_Codigo` int(11) DEFAULT '0',
  `TAREADETC_Cantidad` varchar(50) DEFAULT NULL,
  `TAREADETC_FechaEntrega` date NOT NULL DEFAULT '0000-00-00',
  `TAREADETC_FechaModificacion` datetime DEFAULT NULL,
  `TAREADETC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TAREADETP_Codigo`),
  KEY `FK_tareadetalle_tarea` (`TAREAP_Codigo`),
  KEY `FK_tareadetalle_profesor` (`PROP_Codigo`),
  CONSTRAINT `FK_tareadetalle_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tareadetalle_tarea` FOREIGN KEY (`TAREAP_Codigo`) REFERENCES `tarea` (`TAREAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tareadetalle: ~15 rows (aproximadamente)
DELETE FROM `tareadetalle`;
/*!40000 ALTER TABLE `tareadetalle` DISABLE KEYS */;
INSERT INTO `tareadetalle` (`TAREADETP_Codigo`, `TAREAP_Codigo`, `TIPCICLOP_Codigo`, `PROP_Codigo`, `PRODATRIBDET_Codigo`, `TAREADETC_Cantidad`, `TAREADETC_FechaEntrega`, `TAREADETC_FechaModificacion`, `TAREADETC_FechaRegistro`) VALUES
	(23, 6, 1, 5, 5, '8', '2015-10-21', NULL, '2015-10-24 07:12:26'),
	(24, 6, 1, 6, 11, '55', '0000-00-00', NULL, '2015-10-24 07:27:11'),
	(25, 6, 1, 45, 9, '6', '2015-10-13', NULL, '2015-10-24 07:29:00'),
	(26, 6, 1, 6, 15, '77', '2015-10-14', NULL, '2015-10-24 07:29:00'),
	(27, 6, 5, 5, 0, '999', '2015-10-13', '2015-10-24 07:33:00', '2015-10-24 07:30:47'),
	(28, 6, 1, 5, 18, '888', '2015-10-28', '2015-10-24 07:32:45', '2015-10-24 07:32:18'),
	(29, 7, 1, 53, 0, '15', '2015-10-14', NULL, '2015-10-24 07:33:31'),
	(30, 7, 2, 53, 0, '58', '2015-10-07', NULL, '2015-10-24 07:33:31'),
	(31, 8, 1, 8, 0, '25', '2015-10-07', '2015-10-26 00:25:04', '2015-10-24 07:34:39'),
	(32, 8, 2, 10, 0, '33', '2015-10-14', NULL, '2015-10-24 07:34:40'),
	(33, 8, 4, 47, 0, '33', '2015-10-14', NULL, '2015-10-24 07:34:40'),
	(34, 2, 2, 50, 0, '234', '2015-10-14', NULL, '2015-10-24 07:38:11'),
	(35, 3, 3, 9, 0, '234', '2015-10-06', NULL, '2015-10-24 07:38:47'),
	(36, 3, 4, 9, 0, '32', '2015-10-13', NULL, '2015-10-24 07:38:47'),
	(37, 8, 1, 9, 0, '5555', '0000-00-00', NULL, '2015-10-26 00:25:20');
/*!40000 ALTER TABLE `tareadetalle` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tareo
CREATE TABLE IF NOT EXISTS `tareo` (
  `TAREOP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `AULAP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TAREOC_Tipo` int(1) NOT NULL DEFAULT '0' COMMENT '1:Asistencia,2:Reemplazo;3:Falta',
  `USUA_Codigo` int(1) NOT NULL DEFAULT '0',
  `TAREOC_ProfesorReemplazado` int(11) NOT NULL DEFAULT '0',
  `TAREOC_Fecha` date NOT NULL DEFAULT '0000-00-00',
  `TAREOC_Hinicio` time NOT NULL,
  `TAREOC_Hfin` time NOT NULL,
  `TAREOC_Costo` double NOT NULL,
  `TAREOC_FechaModificacion` datetime DEFAULT NULL,
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

-- Volcando datos para la tabla 20denota.tareo: ~4 rows (aproximadamente)
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
  `TEMAC_FechaModificacion` datetime DEFAULT NULL,
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
  `TIPC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  `TIPC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TIPP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tipoestudio: ~7 rows (aproximadamente)
DELETE FROM `tipoestudio`;
/*!40000 ALTER TABLE `tipoestudio` DISABLE KEYS */;
INSERT INTO `tipoestudio` (`TIPP_Codigo`, `TIPC_Nombre`, `TIPC_Descripcion`, `TIPC_FlagEstado`, `TIPC_FechaRegistro`) VALUES
	(3, 'Pre', 'Tipo de Estudio para los alumnos que van a postular a la UNI', '1', '2015-05-15 04:19:44'),
	(4, 'Repaso', 'Tipo de estudio para los alumnos que requieren un repaso antes de postular a la UNI', '1', '2015-05-15 04:19:49'),
	(5, 'Basico', 'Tipo de Estudio para los alumnos que recien egresan del colegio', '1', '2015-05-15 04:20:23'),
	(6, 'Intensivo', 'Tipo de Estudio para resolver problemas antes de dar el examen de la UNI', '1', '2015-05-15 04:20:28'),
	(7, 'Escolar 3ero', 'Escuca a todos', '1', '2015-08-10 12:16:34'),
	(8, 'Escolar 4to', 'Escucha para ti', '1', '2015-08-10 12:18:30'),
	(9, 'Escolar 5to', 'Para ti o voz ddd', '1', '2015-08-10 12:18:46');
/*!40000 ALTER TABLE `tipoestudio` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.tipoestudiociclo
CREATE TABLE IF NOT EXISTS `tipoestudiociclo` (
  `TIPCICLOP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `TIPP_Codigo` int(11) NOT NULL DEFAULT '0',
  `CICLOP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TIPCICLOC_Observacion` varchar(150) DEFAULT NULL,
  `TIPCICLOC_FlagEstado` char(1) NOT NULL DEFAULT '1',
  `TIPCICLOC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`TIPCICLOP_Codigo`),
  KEY `FK_tipoestudiociclo_tipoestudio` (`TIPP_Codigo`),
  KEY `FK_tipoestudiociclo_ciclo` (`CICLOP_Codigo`),
  CONSTRAINT `FK_tipoestudiociclo_ciclo` FOREIGN KEY (`CICLOP_Codigo`) REFERENCES `ciclo` (`CICLOP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tipoestudiociclo_tipoestudio` FOREIGN KEY (`TIPP_Codigo`) REFERENCES `tipoestudio` (`TIPP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.tipoestudiociclo: ~8 rows (aproximadamente)
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

-- Volcando datos para la tabla 20denota.tipotarea: ~3 rows (aproximadamente)
DELETE FROM `tipotarea`;
/*!40000 ALTER TABLE `tipotarea` DISABLE KEYS */;
INSERT INTO `tipotarea` (`TIPOTAREAP_Codigo`, `TIPOTAREAC_Nombre`, `TIPOTAREAC_FechaRegistro`) VALUES
	(1, 'Problemas para PC', '2015-09-29 14:17:08'),
	(2, 'Problemas para Seminario', '2015-09-29 14:17:05'),
	(3, 'Revisión de probemas', '2015-09-29 14:17:07');
/*!40000 ALTER TABLE `tipotarea` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.trabajo
CREATE TABLE IF NOT EXISTS `trabajo` (
  `TRABAJP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `EMPRP_Codigo` int(11) NOT NULL DEFAULT '0',
  `TRABAJC_Descripcion` varchar(150) DEFAULT NULL,
  `TRABAJC_FechaInicio` date NOT NULL DEFAULT '0000-00-00',
  `TRABAJC_FechaFin` date NOT NULL DEFAULT '0000-00-00',
  `TRABAJC_FechaModificacion` datetime DEFAULT NULL,
  `TRABAJC_FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TRABAJP_Codigo`),
  KEY `FK_trabajo_profesor` (`PROP_Codigo`),
  KEY `FK_trabajo_empresa` (`EMPRP_Codigo`),
  CONSTRAINT `FK_trabajo_empresa` FOREIGN KEY (`EMPRP_Codigo`) REFERENCES `empresa` (`EMPRP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_trabajo_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.trabajo: ~4 rows (aproximadamente)
DELETE FROM `trabajo`;
/*!40000 ALTER TABLE `trabajo` DISABLE KEYS */;
INSERT INTO `trabajo` (`TRABAJP_Codigo`, `PROP_Codigo`, `EMPRP_Codigo`, `TRABAJC_Descripcion`, `TRABAJC_FechaInicio`, `TRABAJC_FechaFin`, `TRABAJC_FechaModificacion`, `TRABAJC_FechaRegistro`) VALUES
	(1, 54, 1, 'sasadfafsadf', '0000-00-00', '0000-00-00', NULL, '2015-11-06 12:47:55'),
	(2, 53, 1, 'sadfasdf', '1953-04-00', '1954-04-00', NULL, '2015-11-16 12:04:38'),
	(3, 53, 1, 'sadafsdfasdf', '1952-04-00', '1956-03-00', NULL, '2015-11-16 12:05:05'),
	(4, 53, 1, 'asdfasdf', '1952-02-00', '1953-03-00', NULL, '2015-11-16 12:26:32');
/*!40000 ALTER TABLE `trabajo` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.universidad
CREATE TABLE IF NOT EXISTS `universidad` (
  `UNIVP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `UNIVC_Nombre` varchar(150) NOT NULL,
  `UNIVC_Iniciales` varchar(50) DEFAULT NULL,
  `UNIVC_FechaModificacion` datetime DEFAULT NULL,
  `UNIVC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`UNIVP_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.universidad: ~18 rows (aproximadamente)
DELETE FROM `universidad`;
/*!40000 ALTER TABLE `universidad` DISABLE KEYS */;
INSERT INTO `universidad` (`UNIVP_Codigo`, `UNIVC_Nombre`, `UNIVC_Iniciales`, `UNIVC_FechaModificacion`, `UNIVC_FechaRegistro`) VALUES
	(1, 'Universidad Nacional Mayor de San Marcos', 'UNMSM', NULL, '2015-10-26 07:19:02'),
	(2, 'Universidad Nacional de Ingenieria', 'UNI', NULL, '2015-10-26 07:20:02'),
	(3, 'Universidad Nacional San Agustin', 'UNSA', NULL, '2015-10-26 07:20:24'),
	(4, 'Universidad Nacional Federico Villareal', 'UNFV', NULL, '2015-10-26 07:20:43'),
	(5, 'Universidad Nacional Agraria La Molina', NULL, NULL, '2015-10-26 07:21:07'),
	(6, 'Universidad Privada del Norte', 'UPN', NULL, '2015-10-26 07:21:33'),
	(7, 'Universidad Cesar Vallejo', 'UCV', NULL, '2015-10-26 07:21:45'),
	(8, 'Universidad Catolica Sedes Sapientiae', 'UCSS', NULL, '2015-10-26 07:22:07'),
	(9, 'Universidad Femenina del Sagrado Corazon', 'UNIFE', NULL, '2015-10-26 07:22:23'),
	(10, 'Universidad Privada San Juan Bautista', NULL, NULL, '2015-10-26 07:23:08'),
	(11, 'Universidad Privada Norbert Wiener', NULL, NULL, '2015-10-26 07:23:22'),
	(12, 'Universidad Marcelino Champagnat', NULL, NULL, '2015-10-26 07:23:45'),
	(13, 'Universidad Peruana de Ciencias Aplicadas', 'UPC', NULL, '2015-10-26 07:24:01'),
	(14, 'Universidad del Pacifico', NULL, NULL, '2015-10-26 07:24:24'),
	(15, 'Universidad Cientifica del Sur', NULL, NULL, '2015-10-26 07:24:39'),
	(16, 'Universidad Peruana Cayetano Heredia', 'UCH', NULL, '2015-10-26 07:24:55'),
	(17, 'Universidad Antonio Ruiz de Montoya', 'UARM', NULL, '2015-10-26 07:25:09'),
	(18, 'Universidad Tecnologica del Peru', 'UTP', NULL, '2015-10-26 07:25:36');
/*!40000 ALTER TABLE `universidad` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `USUA_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `PERSP_Codigo` int(11) NOT NULL,
  `ROL_Codigo` int(11) NOT NULL,
  `USUA_usuario` varchar(20) DEFAULT NULL,
  `USUA_Password` varchar(50) DEFAULT NULL,
  `USUA_FlagEstado` char(1) DEFAULT '1',
  `USUA_FechaModificacion` datetime DEFAULT NULL,
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
  `VIGILAC_FechaModificacion` datetime DEFAULT NULL,
  `VIGILAC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`VIGILAP_Codigo`),
  KEY `FK_vigilancia_profesor` (`PROP_Codigo`),
  CONSTRAINT `FK_vigilancia_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.vigilancia: ~3 rows (aproximadamente)
DELETE FROM `vigilancia`;
/*!40000 ALTER TABLE `vigilancia` DISABLE KEYS */;
INSERT INTO `vigilancia` (`VIGILAP_Codigo`, `PROP_Codigo`, `VIGILAC_Nombre`, `VIGILAC_Descripcion`, `VIGILAC_Fecha`, `VIGILAC_FechaModificacion`, `VIGILAC_FechaRegistro`) VALUES
	(3, 7, 'adsfasdf', 'adsfasdfsadf', '2015-10-24', NULL, '2015-10-24 07:57:16'),
	(4, 54, 'Algebra', 'asdfasdfasdf', '2015-10-24', NULL, '2015-10-24 08:10:07'),
	(7, 50, 'Examenes parciales ultimos', '2015 4', '2015-10-26', NULL, '2015-10-26 00:50:06');
/*!40000 ALTER TABLE `vigilancia` ENABLE KEYS */;


-- Volcando estructura para tabla 20denota.vigilanciadetalle
CREATE TABLE IF NOT EXISTS `vigilanciadetalle` (
  `VIGILADETP_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `VIGILAP_Codigo` int(11) NOT NULL DEFAULT '0',
  `PROD_Codigo` int(11) NOT NULL DEFAULT '0',
  `PROP_Codigo` int(11) NOT NULL DEFAULT '0',
  `VIGILADETC_FechaModificacion` datetime DEFAULT NULL,
  `VIGILADETC_FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`VIGILADETP_Codigo`),
  KEY `FK_vigilanciadetalle_vigilancia` (`VIGILAP_Codigo`),
  KEY `FK_vigilanciadetalle_curso` (`PROD_Codigo`),
  KEY `FK_vigilanciadetalle_profesor` (`PROP_Codigo`),
  CONSTRAINT `FK_vigilanciadetalle_curso` FOREIGN KEY (`PROD_Codigo`) REFERENCES `curso` (`PROD_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_vigilanciadetalle_profesor` FOREIGN KEY (`PROP_Codigo`) REFERENCES `profesor` (`PROP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_vigilanciadetalle_vigilancia` FOREIGN KEY (`VIGILAP_Codigo`) REFERENCES `vigilancia` (`VIGILAP_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla 20denota.vigilanciadetalle: ~8 rows (aproximadamente)
DELETE FROM `vigilanciadetalle`;
/*!40000 ALTER TABLE `vigilanciadetalle` DISABLE KEYS */;
INSERT INTO `vigilanciadetalle` (`VIGILADETP_Codigo`, `VIGILAP_Codigo`, `PROD_Codigo`, `PROP_Codigo`, `VIGILADETC_FechaModificacion`, `VIGILADETC_FechaRegistro`) VALUES
	(2, 7, 5, 10, NULL, '2015-10-26 00:50:06'),
	(3, 7, 93, 5, NULL, '2015-10-26 00:50:06'),
	(5, 7, 93, 45, NULL, '2015-10-26 00:50:07'),
	(6, 7, 96, 39, '2015-10-26 06:49:40', '2015-10-26 00:57:45'),
	(7, 7, 92, 11, '2015-10-26 06:49:40', '2015-10-26 00:58:42'),
	(8, 7, 93, 7, NULL, '2015-10-26 06:49:40'),
	(9, 7, 92, 11, NULL, '2015-10-26 06:49:58'),
	(10, 7, 96, 38, NULL, '2015-10-26 06:49:58');
/*!40000 ALTER TABLE `vigilanciadetalle` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
