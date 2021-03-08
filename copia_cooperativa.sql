-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: cooperativa
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asamblea_estructura`
--

DROP TABLE IF EXISTS `asamblea_estructura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asamblea_estructura` (
  `id_ae` bigint(20) NOT NULL AUTO_INCREMENT,
  `etiqueta` varchar(150) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ae`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asamblea_estructura`
--

LOCK TABLES `asamblea_estructura` WRITE;
/*!40000 ALTER TABLE `asamblea_estructura` DISABLE KEYS */;
INSERT INTO `asamblea_estructura` VALUES (1,'Capitular'),(2,'Asamblea');
/*!40000 ALTER TABLE `asamblea_estructura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencia` (
  `id_asistencia` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_evento` bigint(20) NOT NULL,
  `tipoevent` int(11) NOT NULL,
  `num_cliente` int(11) NOT NULL,
  `trato` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `agencia` varchar(200) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `asistire` int(11) DEFAULT '0',
  `f_asistire_regis` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `soy_aspirante` int(11) DEFAULT '0',
  `cantidato_delegado` int(11) DEFAULT '0',
  `junta_directores` int(11) DEFAULT '0',
  `junta_vigilancia` int(11) DEFAULT '0',
  `comite_credito` int(11) DEFAULT '0',
  `veri_zoom_email` varchar(150) DEFAULT NULL,
  `veri_url` text,
  `veri_id_zoom` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_asistencia`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencia`
--

LOCK TABLES `asistencia` WRITE;
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `capitulos`
--

DROP TABLE IF EXISTS `capitulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capitulos` (
  `IDAGEN` int(11) DEFAULT NULL,
  `AGENCIA` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capitulos`
--

LOCK TABLES `capitulos` WRITE;
/*!40000 ALTER TABLE `capitulos` DISABLE KEYS */;
INSERT INTO `capitulos` VALUES (0,' '),(1,'PANAMA (SEDE PRINCIPAL)'),(2,'COCLE'),(3,'CHIRIQUI'),(4,'VERAGUAS'),(5,'AZUERO'),(6,'COLON'),(7,'BOCAS DEL TORO'),(8,'SUCURSAL EL DORADO'),(9,'SUCURSAL VISTA HERMOSA'),(11,'PANAMA OESTE');
/*!40000 ALTER TABLE `capitulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conf`
--

DROP TABLE IF EXISTS `conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conf` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `modo` int(11) NOT NULL DEFAULT '0' COMMENT '0 desarrollo  -  1 produccion',
  `correopruebas` varchar(150) NOT NULL DEFAULT 'eaguilar@cooprofesionales.com.pa',
  `servidor` varchar(150) DEFAULT NULL COMMENT 'no lo estoy usando',
  `limitespruebasdev` int(11) DEFAULT NULL COMMENT 'no lo estoy usando',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf`
--

LOCK TABLES `conf` WRITE;
/*!40000 ALTER TABLE `conf` DISABLE KEYS */;
INSERT INTO `conf` VALUES (1,0,'eaguilars@gmail.com','',0);
/*!40000 ALTER TABLE `conf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conf_areas`
--

DROP TABLE IF EXISTS `conf_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conf_areas` (
  `id_area` bigint(20) NOT NULL AUTO_INCREMENT,
  `area_etiqueta` varchar(50) NOT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_areas`
--

LOCK TABLES `conf_areas` WRITE;
/*!40000 ALTER TABLE `conf_areas` DISABLE KEYS */;
INSERT INTO `conf_areas` VALUES (1,'Candidatos a Delegados'),(2,'Junta de Directores'),(3,'Junta de Vigilancia'),(4,'Comité de Crédito');
/*!40000 ALTER TABLE `conf_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_clientes`
--

DROP TABLE IF EXISTS `data_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_clientes` (
  `CLDOC` bigint(20) NOT NULL DEFAULT '0',
  `CLASOC` bigint(20) DEFAULT NULL,
  `IDAGEN` int(11) DEFAULT NULL,
  `AGENCIA` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `APARTADO` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL,
  `NOMBRE` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `TELEFONO` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `CORREO` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `VALF1` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `VALF2` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `id_tipo` int(3) DEFAULT NULL,
  `tipo` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `celular` varchar(16) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_retiro` date DEFAULT NULL,
  `fecha_exp` date DEFAULT NULL,
  `fecha_reingreso1` date DEFAULT NULL,
  `fecha_reingreso2` int(11) DEFAULT NULL,
  `id_sexo` int(11) DEFAULT NULL,
  `id_estado` int(3) DEFAULT NULL,
  `estado` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `id_ocupacion` int(5) DEFAULT NULL,
  `ocupacion` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `id_profesion` int(5) DEFAULT NULL,
  `profesion` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `send_mail` tinyint(1) DEFAULT '1',
  `send_mail_coop` tinyint(1) DEFAULT '1',
  `send_ec` tinyint(1) DEFAULT NULL,
  `send_tarj` tinyint(1) DEFAULT NULL,
  `send_ec_mail` tinyint(4) DEFAULT NULL,
  `firma` tinyint(1) DEFAULT NULL,
  `trato` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`CLDOC`),
  KEY `VALF1` (`VALF1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Datos generales del Cliente';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_clientes`
--

LOCK TABLES `data_clientes` WRITE;
/*!40000 ALTER TABLE `data_clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `data_clientes_vt`
--

DROP TABLE IF EXISTS `data_clientes_vt`;
/*!50001 DROP VIEW IF EXISTS `data_clientes_vt`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `data_clientes_vt` AS SELECT 
 1 AS `CLASOC`,
 1 AS `IDAGEN`,
 1 AS `AGENCIA`,
 1 AS `APARTADO`,
 1 AS `NOMBRE`,
 1 AS `TELEFONO`,
 1 AS `CORREO`,
 1 AS `VALF1`,
 1 AS `VALF2`,
 1 AS `id_tipo`,
 1 AS `tipo`,
 1 AS `celular`,
 1 AS `fecha_nac`,
 1 AS `fecha_ingreso`,
 1 AS `fecha_retiro`,
 1 AS `fecha_exp`,
 1 AS `fecha_reingreso1`,
 1 AS `fecha_reingreso2`,
 1 AS `id_sexo`,
 1 AS `id_estado`,
 1 AS `estado`,
 1 AS `id_ocupacion`,
 1 AS `ocupacion`,
 1 AS `id_profesion`,
 1 AS `profesion`,
 1 AS `id_pais`,
 1 AS `send_mail`,
 1 AS `send_mail_coop`,
 1 AS `send_ec`,
 1 AS `send_tarj`,
 1 AS `send_ec_mail`,
 1 AS `firma`,
 1 AS `trato`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `directivos`
--

DROP TABLE IF EXISTS `directivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `directivos` (
  `id_delegado` bigint(20) NOT NULL AUTO_INCREMENT,
  `num_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `img_delegado` varchar(200) DEFAULT 'default.png',
  `estado` int(11) DEFAULT '0' COMMENT '0 : inscrito  1 : aprobaba',
  `user_audit` varchar(32) NOT NULL,
  `fecha_aud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto` text,
  `tipo` varchar(50) DEFAULT NULL,
  `eliminado` int(11) DEFAULT '0',
  `memoria` text,
  `experiencia` text,
  `adjunto` bigint(20) DEFAULT NULL COMMENT 'files_up',
  PRIMARY KEY (`id_delegado`),
  UNIQUE KEY `num_cliente` (`num_cliente`,`estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `directivos`
--

LOCK TABLES `directivos` WRITE;
/*!40000 ALTER TABLE `directivos` DISABLE KEYS */;
/*!40000 ALTER TABLE `directivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento_envio`
--

DROP TABLE IF EXISTS `documento_envio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento_envio` (
  `iddocsend` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_evento` bigint(20) NOT NULL DEFAULT '0',
  `asunto` varchar(250) CHARACTER SET latin1 NOT NULL,
  `texto` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`iddocsend`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento_envio`
--

LOCK TABLES `documento_envio` WRITE;
/*!40000 ALTER TABLE `documento_envio` DISABLE KEYS */;
INSERT INTO `documento_envio` VALUES (1,1,'Asamblea Panamá 2021','<p><u><strong>DA CLICK EN ESTE ENLACE</strong></u></p>\n');
/*!40000 ALTER TABLE `documento_envio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento_resultados`
--

DROP TABLE IF EXISTS `documento_resultados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento_resultados` (
  `idrestdoc` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_evento` bigint(20) NOT NULL,
  `superior` text NOT NULL,
  `inferior` text NOT NULL,
  PRIMARY KEY (`idrestdoc`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento_resultados`
--

LOCK TABLES `documento_resultados` WRITE;
/*!40000 ALTER TABLE `documento_resultados` DISABLE KEYS */;
INSERT INTO `documento_resultados` VALUES (1,1,'<p>Reemplace este c&oacute;digo</p>\n','<p>Reemplace este c&oacute;digo</p>\n');
/*!40000 ALTER TABLE `documento_resultados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `envios`
--

DROP TABLE IF EXISTS `envios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envios` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_evento` bigint(20) NOT NULL DEFAULT '0',
  `IDAGEN` bigint(20) NOT NULL,
  `CLDOC` bigint(20) NOT NULL,
  `CORREO` varchar(250) NOT NULL,
  `NOMBRE` varchar(250) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accion` int(11) DEFAULT '3' COMMENT '3:pendiente, 1: enviado , 0:fallido',
  `fechaenviado` timestamp NULL DEFAULT NULL,
  `tipo_envio` int(11) NOT NULL DEFAULT '1' COMMENT '1:invitacion a portal , 2: invitacion directa a votacion',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `envios`
--

LOCK TABLES `envios` WRITE;
/*!40000 ALTER TABLE `envios` DISABLE KEYS */;
/*!40000 ALTER TABLE `envios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `envios_tipos`
--

DROP TABLE IF EXISTS `envios_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envios_tipos` (
  `id_tipo_envio` int(11) DEFAULT NULL,
  `tedalle_tenvio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `envios_tipos`
--

LOCK TABLES `envios_tipos` WRITE;
/*!40000 ALTER TABLE `envios_tipos` DISABLE KEYS */;
INSERT INTO `envios_tipos` VALUES (1,'Registro'),(2,'Invitacion a Votación');
/*!40000 ALTER TABLE `envios_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados_asoc`
--

DROP TABLE IF EXISTS `estados_asoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados_asoc` (
  `id_estado` bigint(20) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados_asoc`
--

LOCK TABLES `estados_asoc` WRITE;
/*!40000 ALTER TABLE `estados_asoc` DISABLE KEYS */;
INSERT INTO `estados_asoc` VALUES (1,'ACTIVO'),(2,'RETIRADO'),(3,'EXPULSADO'),(4,'FALLECIDO'),(5,'EN TRAMITE'),(6,'CANCELADO');
/*!40000 ALTER TABLE `estados_asoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) NOT NULL,
  `rangofecha1` datetime NOT NULL,
  `rangofecha2` datetime NOT NULL,
  `preinscripActivo` int(11) DEFAULT '1',
  `maxvotos` bigint(20) NOT NULL DEFAULT '10',
  `capitulos` varchar(250) NOT NULL,
  `estadosasoc` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `tipo` int(11) NOT NULL COMMENT 'asamblea_estructura',
  `veri_id_zoom` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES (1,'Asamblea Panamá 2021','2021-03-05 00:00:00','2021-03-31 00:00:00',1,10,'[\"1\"]','[\"1\"]',1,2,NULL);
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento_directivos`
--

DROP TABLE IF EXISTS `evento_directivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento_directivos` (
  `id_dire_even` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_evento` bigint(20) NOT NULL,
  `id_delegado` bigint(20) NOT NULL,
  `id_area` bigint(20) NOT NULL,
  PRIMARY KEY (`id_dire_even`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento_directivos`
--

LOCK TABLES `evento_directivos` WRITE;
/*!40000 ALTER TABLE `evento_directivos` DISABLE KEYS */;
/*!40000 ALTER TABLE `evento_directivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files_up`
--

DROP TABLE IF EXISTS `files_up`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files_up` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_evento` varchar(150) NOT NULL,
  `cldoc` bigint(20) NOT NULL,
  `etiqueta` varchar(150) NOT NULL,
  `name_system` varchar(150) NOT NULL,
  `extension` varchar(150) NOT NULL,
  `tipoarchivo` varchar(500) NOT NULL,
  `sizefile` varchar(50) NOT NULL,
  `fecha_upload` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `eliminado` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files_up`
--

LOCK TABLES `files_up` WRITE;
/*!40000 ALTER TABLE `files_up` DISABLE KEYS */;
/*!40000 ALTER TABLE `files_up` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2021_01_11_235350_laratrust_setup_tables',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `icon` varchar(100) DEFAULT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,'icon-pencil-ruler','Configuraciones',1);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('eaguilars@gmail.com','$2y$10$e94/rAi43KT/2LXyEr5Swu4ecOMxWZN04lbV3TSyhKo8EGzRBgZLi','2021-02-23 11:01:08');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_user` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_user`
--

LOCK TABLES `permission_user` WRITE;
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
INSERT INTO `permission_user` VALUES (1,1,'App\\Models\\User'),(1,2,'App\\Models\\User'),(1,3,'App\\Models\\User'),(1,4,'App\\Models\\User'),(1,5,'App\\Models\\User'),(2,1,'App\\Models\\User'),(2,2,'App\\Models\\User'),(2,3,'App\\Models\\User'),(2,4,'App\\Models\\User'),(2,5,'App\\Models\\User'),(3,1,'App\\Models\\User'),(3,2,'App\\Models\\User'),(3,3,'App\\Models\\User'),(3,4,'App\\Models\\User'),(3,5,'App\\Models\\User'),(4,1,'App\\Models\\User'),(4,2,'App\\Models\\User'),(4,3,'App\\Models\\User'),(4,4,'App\\Models\\User'),(4,5,'App\\Models\\User'),(5,1,'App\\Models\\User'),(5,2,'App\\Models\\User'),(5,3,'App\\Models\\User'),(5,4,'App\\Models\\User'),(5,5,'App\\Models\\User'),(6,1,'App\\Models\\User'),(6,2,'App\\Models\\User'),(6,3,'App\\Models\\User'),(6,4,'App\\Models\\User'),(6,5,'App\\Models\\User');
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isMenu` int(11) DEFAULT NULL,
  `slave_id` int(11) DEFAULT NULL,
  `route` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'newaspirante','Portafolio de Aspirantes','aspirante','2021-01-11 19:09:00','2021-01-11 19:09:02',1,NULL,'/sistema/newaspirante',1),(2,'newevento','Nuevo Evento','evento','2021-01-11 19:09:15','2021-01-11 19:09:15',1,NULL,'/sistema/newevento',1),(3,'confvotacion','Aspirantes vs Eventos','asociar','2021-01-11 19:09:15','2021-01-11 19:09:15',1,NULL,'/sistema/confvotacion',1),(4,'confenvio','Envios','notificacion','2021-01-11 19:09:15','2021-01-11 19:09:15',1,NULL,'/sistema/confenvio',1),(5,'formatosdocumentos','Formatos Email / Reportes','documentos','2021-01-11 19:09:15','2021-01-11 19:09:15',1,NULL,'/sistema/formatosdocumentos',1),(6,'reportes','Reportes','reportes','2021-01-11 19:09:15','2021-01-11 19:09:15',1,NULL,'/sistema/reportes',1);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,'App\\Models\\User'),(1,2,'App\\Models\\User'),(1,3,'App\\Models\\User'),(1,4,'App\\Models\\User'),(1,5,'App\\Models\\User');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'soporte','soporte','soporte','2021-01-12 00:08:31','2021-01-12 00:08:31');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Eduardo Aguilar','eaguilars@gmail.com',NULL,'$2y$10$y8jR9qsuticwEkxM6S.a9uXegwXeo1TDR0DwKKS.4V0ztVbbKaApy','HMV3VxZmR9w6rvMMG3AMU1sp62GDU17uers8RYXw0cEe1v1TqepqjAq4Vozz','2021-01-12 00:03:35','2021-01-12 00:03:35'),(2,'Rafael Martínez','rdmartinez@cooprofesionales.com.pa',NULL,'$2y$10$63TC1bTFAdaP8BIpBJFTn.hW4GVac7JHIV2oqam28aNT/0BcNCOB2',NULL,'2021-01-13 14:26:36','2021-01-13 14:26:36'),(3,'usuariocope','ozieldevelop@gmail.com',NULL,'$2y$10$O/S2ePRF0rVhIWK690GePOHlhvoTYOhOLHSON23A2a/.aNKSn4tiy',NULL,'2021-02-09 20:31:01','2021-02-09 20:31:01'),(4,'Salvador Salas','ssalas@cooprofesionales.com.pa',NULL,'$2y$10$n1axj85s8Xl17qA2oSKGC.hLl9GUIz2/D.naGkrhQeUYtKqkArkcO',NULL,'2021-02-23 11:12:15','2021-02-23 11:12:15'),(5,'usuarioplataforma','ozkeyspty@gmail.com',NULL,'$2y$10$YPENTOUFrCZbvFNfbxmAw.JvMFdzxIszth1t5/LEHbaEhZTnPNhYC',NULL,'2021-03-03 11:19:00','2021-03-03 11:19:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votantes`
--

DROP TABLE IF EXISTS `votantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votantes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idterminal` varchar(50) CHARACTER SET utf8 NOT NULL,
  `id_evento` bigint(20) NOT NULL,
  `asociado` longblob NOT NULL,
  `json_data` text COLLATE utf8_spanish_ci,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votantes`
--

LOCK TABLES `votantes` WRITE;
/*!40000 ALTER TABLE `votantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `votantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votos`
--

DROP TABLE IF EXISTS `votos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_evento` bigint(20) NOT NULL,
  `id_area` bigint(20) NOT NULL,
  `idvotante` bigint(20) NOT NULL,
  `aspirante` longblob NOT NULL,
  `nombre` longblob NOT NULL,
  `apellido` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votos`
--

LOCK TABLES `votos` WRITE;
/*!40000 ALTER TABLE `votos` DISABLE KEYS */;
/*!40000 ALTER TABLE `votos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vt_aspirantes`
--

DROP TABLE IF EXISTS `vt_aspirantes`;
/*!50001 DROP VIEW IF EXISTS `vt_aspirantes`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vt_aspirantes` AS SELECT 
 1 AS `id_evento`,
 1 AS `tipo_evento`,
 1 AS `nombreevento`,
 1 AS `id_area`,
 1 AS `area_etiqueta`,
 1 AS `id_delegado`,
 1 AS `num_cliente`,
 1 AS `nombre`,
 1 AS `apellido`,
 1 AS `img_delegado`,
 1 AS `estado`,
 1 AS `user_audit`,
 1 AS `fecha_aud`,
 1 AS `foto`,
 1 AS `tipo`,
 1 AS `memoria`,
 1 AS `trato`,
 1 AS `ocupacion`,
 1 AS `profesion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vt_envios`
--

DROP TABLE IF EXISTS `vt_envios`;
/*!50001 DROP VIEW IF EXISTS `vt_envios`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vt_envios` AS SELECT 
 1 AS `tipo_invitacion`,
 1 AS `id_evento`,
 1 AS `IDAGEN`,
 1 AS `CLDOC`,
 1 AS `NOMBRE`,
 1 AS `CORREO`,
 1 AS `agregado`,
 1 AS `pendiente`,
 1 AS `enviados`,
 1 AS `fallido`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vt_menu_rol`
--

DROP TABLE IF EXISTS `vt_menu_rol`;
/*!50001 DROP VIEW IF EXISTS `vt_menu_rol`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vt_menu_rol` AS SELECT 
 1 AS `module_id`,
 1 AS `module_name`,
 1 AS `icon`,
 1 AS `permission_name`,
 1 AS `permission_id`,
 1 AS `route`,
 1 AS `isMenu`,
 1 AS `slave_id`,
 1 AS `user_id`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vt_totales`
--

DROP TABLE IF EXISTS `vt_totales`;
/*!50001 DROP VIEW IF EXISTS `vt_totales`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vt_totales` AS SELECT 
 1 AS `id_evento`,
 1 AS `id_area`,
 1 AS `id_delegado`,
 1 AS `aspirante`,
 1 AS `area_etiqueta`,
 1 AS `nombre`,
 1 AS `apellido`,
 1 AS `cantidadvotos`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vt_votos_detallado`
--

DROP TABLE IF EXISTS `vt_votos_detallado`;
/*!50001 DROP VIEW IF EXISTS `vt_votos_detallado`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vt_votos_detallado` AS SELECT 
 1 AS `id_evento`,
 1 AS `id_area`,
 1 AS `aspirante`,
 1 AS `nombre`,
 1 AS `apellido`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `data_clientes_vt`
--

/*!50001 DROP VIEW IF EXISTS `data_clientes_vt`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`oziel`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `data_clientes_vt` AS select `data_clientes`.`CLDOC` AS `CLASOC`,`data_clientes`.`IDAGEN` AS `IDAGEN`,`data_clientes`.`AGENCIA` AS `AGENCIA`,`data_clientes`.`APARTADO` AS `APARTADO`,`data_clientes`.`NOMBRE` AS `NOMBRE`,`data_clientes`.`TELEFONO` AS `TELEFONO`,`data_clientes`.`CORREO` AS `CORREO`,`data_clientes`.`VALF1` AS `VALF1`,`data_clientes`.`VALF2` AS `VALF2`,`data_clientes`.`id_tipo` AS `id_tipo`,`data_clientes`.`tipo` AS `tipo`,`data_clientes`.`celular` AS `celular`,`data_clientes`.`fecha_nac` AS `fecha_nac`,`data_clientes`.`fecha_ingreso` AS `fecha_ingreso`,`data_clientes`.`fecha_retiro` AS `fecha_retiro`,`data_clientes`.`fecha_exp` AS `fecha_exp`,`data_clientes`.`fecha_reingreso1` AS `fecha_reingreso1`,`data_clientes`.`fecha_reingreso2` AS `fecha_reingreso2`,`data_clientes`.`id_sexo` AS `id_sexo`,`data_clientes`.`id_estado` AS `id_estado`,`data_clientes`.`estado` AS `estado`,`data_clientes`.`id_ocupacion` AS `id_ocupacion`,`data_clientes`.`ocupacion` AS `ocupacion`,`data_clientes`.`id_profesion` AS `id_profesion`,`data_clientes`.`profesion` AS `profesion`,`data_clientes`.`id_pais` AS `id_pais`,`data_clientes`.`send_mail` AS `send_mail`,`data_clientes`.`send_mail_coop` AS `send_mail_coop`,`data_clientes`.`send_ec` AS `send_ec`,`data_clientes`.`send_tarj` AS `send_tarj`,`data_clientes`.`send_ec_mail` AS `send_ec_mail`,`data_clientes`.`firma` AS `firma`,`data_clientes`.`trato` AS `trato` from `data_clientes` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vt_aspirantes`
--

/*!50001 DROP VIEW IF EXISTS `vt_aspirantes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`oziel`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vt_aspirantes` AS select `a`.`id` AS `id_evento`,`a`.`tipo` AS `tipo_evento`,`a`.`nombre` AS `nombreevento`,`b`.`id_area` AS `id_area`,`e`.`area_etiqueta` AS `area_etiqueta`,`c`.`id_delegado` AS `id_delegado`,`c`.`num_cliente` AS `num_cliente`,`c`.`nombre` AS `nombre`,`c`.`apellido` AS `apellido`,`c`.`img_delegado` AS `img_delegado`,`c`.`estado` AS `estado`,`c`.`user_audit` AS `user_audit`,`c`.`fecha_aud` AS `fecha_aud`,`c`.`foto` AS `foto`,`c`.`tipo` AS `tipo`,`c`.`memoria` AS `memoria`,ifnull(concat(`d`.`trato`,'.'),'DR.') AS `trato`,ifnull(concat(`d`.`ocupacion`,'.'),'Aspirante') AS `ocupacion`,ifnull(concat(`d`.`profesion`,'.'),'.') AS `profesion` from ((((`evento` `a` join `evento_directivos` `b` on((`a`.`id` = `b`.`id_evento`))) join `directivos` `c` on((`b`.`id_delegado` = `c`.`id_delegado`))) join `conf_areas` `e` on((`b`.`id_area` = `e`.`id_area`))) left join `data_clientes` `d` on((`c`.`num_cliente` = `d`.`CLASOC`))) where (`c`.`estado` = 1) order by `a`.`id`,`b`.`id_area` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vt_envios`
--

/*!50001 DROP VIEW IF EXISTS `vt_envios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`oziel`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vt_envios` AS select `a`.`tipo_envio` AS `tipo_invitacion`,`a`.`id_evento` AS `id_evento`,`a`.`IDAGEN` AS `IDAGEN`,`a`.`CLDOC` AS `CLDOC`,`a`.`NOMBRE` AS `NOMBRE`,`a`.`CORREO` AS `CORREO`,(select count(0) from `envios` `c` where ((`c`.`id_evento` = `a`.`id_evento`) and (`c`.`CLDOC` = `a`.`CLDOC`) and (`c`.`tipo_envio` = `a`.`tipo_envio`)) group by `a`.`id_evento`,`a`.`tipo_envio`,`a`.`CLDOC`,`a`.`NOMBRE`,`a`.`CORREO`) AS `agregado`,(select count(0) from `envios` `d` where ((`d`.`id_evento` = `a`.`id_evento`) and (`d`.`CLDOC` = `a`.`CLDOC`) and (`d`.`tipo_envio` = `a`.`tipo_envio`) and (`d`.`accion` = 3)) group by `a`.`tipo_envio`) AS `pendiente`,(select count(0) from `envios` `e` where ((`e`.`id_evento` = `a`.`id_evento`) and (`e`.`CLDOC` = `a`.`CLDOC`) and (`e`.`tipo_envio` = `a`.`tipo_envio`) and (`e`.`accion` = 1)) group by `a`.`tipo_envio`) AS `enviados`,(select count(0) from `envios` `f` where ((`f`.`id_evento` = `a`.`id_evento`) and (`f`.`CLDOC` = `a`.`CLDOC`) and (`f`.`tipo_envio` = `a`.`tipo_envio`) and (`f`.`accion` = 0)) group by `a`.`tipo_envio`) AS `fallido` from (`envios` `a` join `evento` `b` on((`a`.`id_evento` = `b`.`id`))) group by `a`.`tipo_envio`,`a`.`id_evento`,`a`.`CLDOC`,`a`.`NOMBRE`,`a`.`CORREO` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vt_menu_rol`
--

/*!50001 DROP VIEW IF EXISTS `vt_menu_rol`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`oziel`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vt_menu_rol` AS select `m`.`id` AS `module_id`,`m`.`display_name` AS `module_name`,`m`.`icon` AS `icon`,`p`.`display_name` AS `permission_name`,`p`.`id` AS `permission_id`,`p`.`route` AS `route`,`p`.`isMenu` AS `isMenu`,`p`.`slave_id` AS `slave_id`,`u`.`id` AS `user_id` from (((`permissions` `p` join `permission_user` `pr` on((`pr`.`permission_id` = `p`.`id`))) join `users` `u` on((`pr`.`user_id` = `u`.`id`))) join `modules` `m` on((`p`.`module_id` = `m`.`id`))) where ((`m`.`status` <> 0) and (`p`.`isMenu` = 1)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vt_totales`
--

/*!50001 DROP VIEW IF EXISTS `vt_totales`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`oziel`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vt_totales` AS select `a`.`id_evento` AS `id_evento`,`a`.`id_area` AS `id_area`,`a`.`id_delegado` AS `id_delegado`,`b`.`num_cliente` AS `aspirante`,`c`.`area_etiqueta` AS `area_etiqueta`,`b`.`nombre` AS `nombre`,`b`.`apellido` AS `apellido`,(select count(0) from `vt_votos_detallado` `c` where ((`c`.`id_evento` = `a`.`id_evento`) and (`c`.`id_area` = `a`.`id_area`) and (`c`.`aspirante` = `b`.`num_cliente`))) AS `cantidadvotos` from ((`evento_directivos` `a` join `directivos` `b` on((`a`.`id_delegado` = `b`.`id_delegado`))) join `conf_areas` `c` on((`a`.`id_area` = `c`.`id_area`))) order by `a`.`id_evento`,`a`.`id_area`,`cantidadvotos` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vt_votos_detallado`
--

/*!50001 DROP VIEW IF EXISTS `vt_votos_detallado`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`oziel`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `vt_votos_detallado` AS select `e`.`id_evento` AS `id_evento`,`e`.`id_area` AS `id_area`,cast(aes_decrypt(`e`.`aspirante`,'xyz123') as char charset utf8mb4) AS `aspirante`,cast(aes_decrypt(`e`.`nombre`,'xyz123') as char charset utf8mb4) AS `nombre`,cast(aes_decrypt(`e`.`apellido`,'xyz123') as char charset utf8mb4) AS `apellido` from `votos` `e` order by `e`.`id_evento`,`e`.`id_area` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-08 19:55:20
