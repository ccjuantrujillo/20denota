-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.21 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- Volcando datos para la tabla 20denota.actividad: ~0 rows (aproximadamente)
DELETE FROM `actividad`;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.cliente: ~8 rows (aproximadamente)
DELETE FROM `cliente`;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`CLIP_Codigo`, `COMPP_Codigo`, `PERSP_Codigo`, `CLIC_FechaRegistro`, `CLIC_FechaModificacion`, `CLIC_FlagEstado`) VALUES
	(2, 1, 63, '2014-10-20 10:37:06', '2014-10-29 22:51:12', '2'),
	(5, 1, 71, '2014-10-20 13:23:28', '2014-10-29 21:38:32', '2'),
	(7, 1, 73, '2014-10-27 11:14:52', '2014-10-29 22:41:49', '1'),
	(9, 1, 80, '2014-10-29 16:51:36', '2014-12-22 14:24:01', '1'),
	(10, 1, 81, '2014-10-29 16:52:41', '2014-10-29 22:52:41', '2'),
	(11, 1, 82, '2014-12-19 01:36:19', '2014-12-22 16:07:14', '1'),
	(15, 1, 86, '2014-12-19 01:37:47', '2014-12-19 07:37:47', '1'),
	(16, 1, 87, '2014-12-22 10:03:11', '2014-12-22 16:03:11', '1');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.compania: ~0 rows (aproximadamente)
DELETE FROM `compania`;
/*!40000 ALTER TABLE `compania` DISABLE KEYS */;
INSERT INTO `compania` (`COMPP_Codigo`, `EMPRP_Codigo`, `COMPC_Logo`, `COMPC_TipoValorizacion`, `COMPC_FlagEstado`) VALUES
	(1, 1, 'Mi loguito', '0', 1);
/*!40000 ALTER TABLE `compania` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.empresa: ~2 rows (aproximadamente)
DELETE FROM `empresa`;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` (`EMPRP_Codigo`, `COMPP_Codigo`, `EMPRC_Ruc`, `EMPRC_RazonSocial`, `EMPRC_Telefono`, `EMPRC_Movil`, `EMPRC_Fax`, `EMPRC_Web`, `EMPRC_Email`, `EMPRC_FechaRegistro`, `EMPRC_FechaModificacion`, `EMPRC_FlagEstado`) VALUES
	(0, 1, NULL, 'EMPRESA NO REGISTRADA', NULL, NULL, NULL, NULL, NULL, '2010-12-16 12:34:32', NULL, '1'),
	(1, 1, '11111111111', 'W', '', '', '', '', '', '2011-01-08 23:30:35', NULL, '0');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.menu: ~7 rows (aproximadamente)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`MENU_Codigo`, `MENU_Codigo_Padre`, `MENU_Descripcion`, `MENU_Comentario`, `MENU_Url`, `MENU_Imagen`, `MENU_FechaRegistro`, `MENU_FechaModificacion`, `MENU_FlagEstado`) VALUES
	(2, 3, 'Alumnos', 'Aquí se podrán subir las imágenes o aniamciones que serán contenidas en la marquesina', 'index.php/ventas/cliente/listar', 'alumno.jpg', '2015-02-27 06:37:01', NULL, '1'),
	(3, 1, 'MANTENIMIENTOS', 'Aquí se podrán subir las imágenes tipo preview para el menú que contenga un enlace.', 'index.php/almacen/producto/listar', 'libros.jpg', '2015-02-27 06:34:42', NULL, '1'),
	(4, 1, 'OPERACIONES', 'Aquí se subirán la imagen del catálogo de la campaña actual.', 'index.php/ventas/orden/listar', 'matri.jpg', '2015-02-27 06:36:27', NULL, '1'),
	(22, 3, 'Cursos', NULL, 'index.php/almacen/producto/listar', '', '2015-03-02 21:31:38', NULL, '1'),
	(48, 4, 'Matricula', NULL, 'index.php/ventas/orden/listar', 'matri.jpg', '2015-02-27 06:36:18', NULL, '1'),
	(49, 4, 'Pagos', NULL, NULL, NULL, '2015-03-02 20:42:48', NULL, '1'),
	(52, 3, 'Documentos', NULL, 'index.php/inicio/principal', NULL, '2015-03-02 21:38:57', NULL, '1');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.orden: ~2 rows (aproximadamente)
DELETE FROM `orden`;
/*!40000 ALTER TABLE `orden` DISABLE KEYS */;
/*!40000 ALTER TABLE `orden` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.permiso: ~7 rows (aproximadamente)
DELETE FROM `permiso`;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` (`PERM_Codigo`, `COMPP_Codigo`, `ROL_Codigo`, `MENU_Codigo`, `PERM_FlagEstado`) VALUES
	(2, 1, 4, 2, '1'),
	(4, 1, 4, 3, '1'),
	(5, 1, 4, 4, '1'),
	(29, 1, 4, 22, '1'),
	(32, 1, 4, 48, '1'),
	(33, 1, 4, 49, '1'),
	(38, 1, 4, 52, '1');
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.persona: ~9 rows (aproximadamente)
DELETE FROM `persona`;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`PERSP_Codigo`, `COMPP_Codigo`, `PERSC_ApellidoPaterno`, `PERSC_ApellidoMaterno`, `PERSC_Nombre`, `PERSC_NumeroDocIdentidad`, `PERSC_Direccion`, `PERSC_Telefono`, `PERSC_Movil`, `PERSC_Fax`, `PERSC_Email`, `PERSC_Domicilio`, `PERSC_Web`, `PERSC_Sexo`, `PERSC_FechaNacimiento`, `PERSC_FechaRegistro`, `PERSC_FechaModificacion`, `PERSC_FlagEstado`) VALUES
	(1, 1, 'TRUJILLO', 'BUSTAMANTE', 'MARTIN', '23442342', 'SGSGSDFGSGSDG', '435345345', '345435', '5345435', 'ewtrewtertter', 'SGSGSDFGSGSDG', 'dgsgsgd', '', '1980-05-01', '2010-12-29 04:14:55', NULL, '1'),
	(63, 1, 'GOMEZ  ', 'PEREZ ', 'EDUARDO EDUARDOGF', '45645664', '', '234423', '0', '0', 'eduardo@banich.com', '', '0', '0', '0000-00-00', '2011-08-12 17:31:38', NULL, '1'),
	(71, 1, 'PEREZ', 'AGUILAR ', 'MARIA', '40091852', 'av peru', '456465', '0', '0', 'maria.aguilar@hotmail.com', '', '0', '0', '2014-02-05', '2014-10-20 13:23:27', NULL, '1'),
	(73, 1, 'RODRIGUEZ', 'MEDRANO', 'ELISEO', '40003256', 'los girasoles 4125', '234234/43223434', '0', '0', 'luis.arnaldo@hotmail.com', '', '0', '0', '2014-05-11', '2014-10-27 11:14:52', NULL, '1'),
	(80, 1, 'CANAZAS', 'QUISPE', 'RUTHCIÃ±A', '40091814', 'MZ R LOTE 50 LOS NISPEROS', '34234242', '0', '0', 'martin@trujillo.com', 'MZ R LOTE 50 LOS NISPEROS', '0', '0', '2015-12-29', '2014-10-29 16:51:36', NULL, '1'),
	(81, 1, 'VARGAS', 'RUIZ', 'ELIZABETH', '21321321', 'MIMCO', 'sdfgdsfgdf', '0', '0', '', '', '0', '0', '0000-00-00', '2014-10-29 16:52:41', NULL, '1'),
	(82, 1, 'PEREZ', 'GUZMAN', 'ROBERTO', '45645654', 'MZ P LOTE 15 LOS ALAMAMO', '2342342343', '0', '0', 'roberto.perez@hotmail.com', 'MZ P LOTE 15 LOS ALAMAMO', '0', '0', '1992-03-02', '2014-12-19 01:36:19', NULL, '1'),
	(86, 1, 'RETET', 'ERTET', 'TERTRET', '23465464', 'ERTERTERT', '345345', '0', '0', '', 'ERTERTERT', '0', '0', '0000-00-00', '2014-12-19 01:37:47', NULL, '1'),
	(87, 1, 'PAREDES', 'GONZALES', 'ETHEL', '45645645', 'ASFASFF', '343243', '0', '0', 'ethel.gonzales@hotmail.com', 'ASFASFF', '0', '0', '1997-12-02', '2014-12-22 10:03:11', NULL, '1');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.producto: ~12 rows (aproximadamente)
DELETE FROM `producto`;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`PROD_Codigo`, `COMPP_Codigo`, `TIPPROD_Codigo`, `PROD_Nombre`, `PROD_DescripcionBreve`, `PROD_EspecificacionPDF`, `PROD_Comentario`, `PROD_Cantidad`, `PROD_Intentos`, `PROD_Tiempo`, `PROD_TiempoExamen`, `PROD_Puntaje`, `PROD_Imagen`, `PROD_Silabus`, `PROD_FechaRegistro`, `PROD_FechaModificacion`, `PROD_FlagEstado`) VALUES
	(5, 1, 1, 'TRIGONOMETRIA', 'SED UT PERSPICIATIS UNDE OMNIS ISTE NATUS ERROR SIT VOLUPTATEM ACCUSANTIUM DOLOREMQUE LAUDANTIUM, TOTAM REM APERIAM. ', '', '', 88, 3, 2, 5, 14, 'erp.png', 'capitulo06.pdf', '2011-01-17 15:19:55', '2015-03-04 23:04:14', '1'),
	(88, 1, 1, 'GEOMETRIA', 'EN ESTE CURSO SE DESARROLLAN Y DETALLAN LAS METODOLOGIAS AGILES DE SCRUM', '', '', 7, 10, 5, 8, 14, 'scrum.png', 'ElPrincipito.doc', '2011-06-07 23:10:09', '2015-03-04 23:04:25', '1');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.productoatributo: ~12 rows (aproximadamente)
DELETE FROM `productoatributo`;
/*!40000 ALTER TABLE `productoatributo` DISABLE KEYS */;
INSERT INTO `productoatributo` (`PRODATRIB_Codigo`, `PROD_Codigo`, `COMPP_Codigo`, `PRODATRIB_Nombre`, `PRODATRIB_Descripcion`, `PRODATRIB_Preguntas`, `PRODATRIB_Puntaje`, `PRODATRIB_Vimeo`, `PRODATRIB_NroIntentos`, `PRODATRIB_FechaModificacion`, `PRODATRIB_FechaRegistro`) VALUES
	(5, 5, 1, 'CAPITULO II', 'ASDF', 5, 0, 'http://vimeo.com/92884359', 1, NULL, '2014-10-06 19:47:57'),
	(16, 5, 1, 'CAPITULO I', 'ASDF', 5, 0, 'http://vimeo.com/92884359', 1, NULL, '2014-10-12 10:40:43'),
	(27, 5, 1, 'CAPITULO III', '', 5, 0, '', 0, NULL, '2015-03-04 17:07:36'),
	(28, 5, 1, 'CAPITULO IV', '', 5, 0, '', 0, NULL, '2015-03-04 17:07:52');
/*!40000 ALTER TABLE `productoatributo` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.productoatributo2: ~0 rows (aproximadamente)
DELETE FROM `productoatributo2`;
/*!40000 ALTER TABLE `productoatributo2` DISABLE KEYS */;
/*!40000 ALTER TABLE `productoatributo2` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.productoatributodetalle: ~4 rows (aproximadamente)
DELETE FROM `productoatributodetalle`;
/*!40000 ALTER TABLE `productoatributodetalle` DISABLE KEYS */;
INSERT INTO `productoatributodetalle` (`PRODATRIBDET_Codigo`, `PRODATRIB_Codigo`, `COMPP_Codigo`, `PRODATRIBDET_Numero`, `PRODATRIBDET_Descripcion`, `PRODATRIBDET_Alternativa1`, `PRODATRIBDET_Alternativa2`, `PRODATRIBDET_Alternativa3`, `PRODATRIBDET_Alternativa4`, `PRODATRIBDET_Alternativa5`, `PRODATRIBDET_FlagCorrecta`, `PRODATRIBDET_FechaModificacion`, `PRODATRIBDET_FechaRegistro`) VALUES
	(36, 16, 1, 2, 'ANGULO TRIGONOMETRICO', '', '', '', '', '', 0, NULL, '2015-03-04 17:08:41'),
	(37, 16, 1, 2, 'LONGITUD DE ARCO Y CIRCUNFERENCIA', '', '', '', '', '', 0, NULL, '2015-03-04 17:08:59'),
	(38, 16, 1, 2, 'EL SECTOR CIRCULAR', '', '', '', '', '', 0, NULL, '2015-03-04 17:09:25'),
	(39, 5, 1, 3, 'RAZONES TRIGONOMETRICAS DE ANGULOS AGUDOS', '', '', '', '', '', 0, NULL, '2015-03-04 17:09:48'),
	(40, 5, 1, 3, 'ANGULOS HORIZONTALES', '', '', '', '', '', 0, NULL, '2015-03-04 17:10:09');
/*!40000 ALTER TABLE `productoatributodetalle` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.productoprecio: ~0 rows (aproximadamente)
DELETE FROM `productoprecio`;
/*!40000 ALTER TABLE `productoprecio` DISABLE KEYS */;
/*!40000 ALTER TABLE `productoprecio` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.puntaje: ~0 rows (aproximadamente)
DELETE FROM `puntaje`;
/*!40000 ALTER TABLE `puntaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `puntaje` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.rol: ~2 rows (aproximadamente)
DELETE FROM `rol`;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`ROL_Codigo`, `COMPP_Codigo`, `ROL_Descripcion`, `ROL_FechaRegistro`, `ROL_FechaModificacion`, `ROL_FlagEstado`) VALUES
	(1, 1, 'Usuario', '2014-10-12 10:09:30', NULL, '1'),
	(4, 1, 'Administrador', '2014-10-12 10:09:06', NULL, '1');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.tipoproducto: ~4 rows (aproximadamente)
DELETE FROM `tipoproducto`;
/*!40000 ALTER TABLE `tipoproducto` DISABLE KEYS */;
INSERT INTO `tipoproducto` (`TIPPROD_Codigo`, `COMPP_Codigo`, `TIPPROD_Descripcion`, `TIPPROD_FechaRegistro`, `TIPPROD_FechaModificacion`, `TIPPROD_FlagEstado`) VALUES
	(0, 1, ':::SELECCIONE::', '2014-10-06 03:37:32', NULL, '1'),
	(1, 1, 'MATEMATICAS', '2011-01-03 12:30:46', NULL, '1'),
	(2, 1, 'IDIOMAS', '2011-01-03 12:30:55', NULL, '1'),
	(3, 1, 'NEGOCIOS', '2011-01-03 12:31:09', NULL, '1');
/*!40000 ALTER TABLE `tipoproducto` ENABLE KEYS */;

-- Volcando datos para la tabla 20denota.usuario: ~0 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`USUA_Codigo`, `COMPP_Codigo`, `PERSP_Codigo`, `ROL_Codigo`, `USUA_usuario`, `USUA_Password`, `USUA_FechaRegistro`, `USUA_FechaModificacion`, `USUA_FlagEstado`) VALUES
	(7, 1, 1, 4, 'demo', 'e10adc3949ba59abbe56e057f20f883e', '2014-09-24 04:23:07', NULL, '1');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
