CREATE DATABASE  IF NOT EXISTS `bd_coches_v2` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `bd_coches_v2`;
-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bd_coches_v2
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad` varchar(45) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
INSERT INTO `ciudades` VALUES (1,'Reus','España'),(2,'Ploiesti','Romania'),(3,'Passau','Germany'),(4,'Girona','España'),(5,'Bilbao','España'),(6,'Tarragona','España'),(7,'Terrassa','España'),(8,'Ulm','Germany'),(9,'Stuttgart','Germany'),(10,'Berlin','Germany'),(11,'Barcelona','España');
/*!40000 ALTER TABLE `ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coches`
--

DROP TABLE IF EXISTS `coches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_fabricacion` int(11) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `vendedores_id` int(11) NOT NULL,
  `compradores_id` int(11) DEFAULT NULL,
  `combustible_id` int(11) DEFAULT NULL,
  `modelos_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_coches_vendedores_idx` (`vendedores_id`),
  KEY `fk_coches_combustible1_idx` (`combustible_id`),
  KEY `fk_coches_modelos1_idx` (`modelos_id`),
  CONSTRAINT `fk_coches_combustible1` FOREIGN KEY (`combustible_id`) REFERENCES `combustible` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_coches_modelos1` FOREIGN KEY (`modelos_id`) REFERENCES `modelos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_coches_vendedores` FOREIGN KEY (`vendedores_id`) REFERENCES `vendedores` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coches`
--

LOCK TABLES `coches` WRITE;
/*!40000 ALTER TABLE `coches` DISABLE KEYS */;
INSERT INTO `coches` VALUES (1,1998,5210,1,1,1,4),(2,2002,7900,6,2,2,5),(3,2015,9700,4,0,2,2),(4,2012,9540,4,NULL,2,2),(12,2010,5000,6,NULL,1,1),(13,2014,7200,2,NULL,2,12);
/*!40000 ALTER TABLE `coches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coches_media`
--

DROP TABLE IF EXISTS `coches_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coches_media` (
  `coches_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  PRIMARY KEY (`coches_id`,`media_id`),
  KEY `fk_coches_has_media_media1_idx` (`media_id`),
  KEY `fk_coches_has_media_coches1_idx` (`coches_id`),
  CONSTRAINT `fk_coches_has_media_coches1` FOREIGN KEY (`coches_id`) REFERENCES `coches` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_coches_has_media_media1` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coches_media`
--

LOCK TABLES `coches_media` WRITE;
/*!40000 ALTER TABLE `coches_media` DISABLE KEYS */;
INSERT INTO `coches_media` VALUES (1,3),(2,4),(3,5),(4,9),(12,17),(13,18);
/*!40000 ALTER TABLE `coches_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coches_transacciones`
--

DROP TABLE IF EXISTS `coches_transacciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coches_transacciones` (
  `coches_id` int(11) NOT NULL,
  `transacciones_id` int(11) NOT NULL,
  PRIMARY KEY (`coches_id`,`transacciones_id`),
  KEY `fk_coches_has_transacciones_transacciones1_idx` (`transacciones_id`),
  KEY `fk_coches_has_transacciones_coches1_idx` (`coches_id`),
  CONSTRAINT `fk_coches_has_transacciones_coches1` FOREIGN KEY (`coches_id`) REFERENCES `coches` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_coches_has_transacciones_transacciones1` FOREIGN KEY (`transacciones_id`) REFERENCES `transacciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coches_transacciones`
--

LOCK TABLES `coches_transacciones` WRITE;
/*!40000 ALTER TABLE `coches_transacciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `coches_transacciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `coches_vendedores`
--

DROP TABLE IF EXISTS `coches_vendedores`;
/*!50001 DROP VIEW IF EXISTS `coches_vendedores`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `coches_vendedores` AS SELECT 
 1 AS `id`,
 1 AS `marca`,
 1 AS `modelo`,
 1 AS `Combustible`,
 1 AS `fecha_fabricacion`,
 1 AS `precio`,
 1 AS `vendedores_id`,
 1 AS `nombre_vendedor`,
 1 AS `apellido_vendedor`,
 1 AS `dni`,
 1 AS `direccion`,
 1 AS `codigo_postal`,
 1 AS `ciudad`,
 1 AS `pais`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `combustible`
--

DROP TABLE IF EXISTS `combustible`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `combustible` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gasolina` tinyint(4) DEFAULT NULL,
  `diesel` tinyint(4) DEFAULT NULL,
  `electrico` tinyint(4) DEFAULT NULL,
  `hibrido` tinyint(4) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `combustible`
--

LOCK TABLES `combustible` WRITE;
/*!40000 ALTER TABLE `combustible` DISABLE KEYS */;
INSERT INTO `combustible` VALUES (1,1,0,0,0,'gasolina'),(2,0,1,0,0,'diesel'),(3,0,0,1,0,'electrico'),(4,0,0,0,1,'hibrido');
/*!40000 ALTER TABLE `combustible` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compradores`
--

DROP TABLE IF EXISTS `compradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_comprador` varchar(45) DEFAULT NULL,
  `apellido_comprador` varchar(45) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `localizacion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`localizacion_id`),
  KEY `fk_compradores_localizacion1_idx` (`localizacion_id`),
  CONSTRAINT `fk_compradores_localizacion1` FOREIGN KEY (`localizacion_id`) REFERENCES `localizacion` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compradores`
--

LOCK TABLES `compradores` WRITE;
/*!40000 ALTER TABLE `compradores` DISABLE KEYS */;
INSERT INTO `compradores` VALUES (1,'Monica','Geller','651',6),(2,'Marry','Olsen','321555321',7),(3,'Walter','Williams','841',9);
/*!40000 ALTER TABLE `compradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localizacion`
--

DROP TABLE IF EXISTS `localizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `localizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(200) DEFAULT NULL,
  `codigo_postal` varchar(45) DEFAULT NULL,
  `ciudades_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`ciudades_id`),
  KEY `fk_localizacion_ciudades1_idx` (`ciudades_id`),
  CONSTRAINT `fk_localizacion_ciudades1` FOREIGN KEY (`ciudades_id`) REFERENCES `ciudades` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localizacion`
--

LOCK TABLES `localizacion` WRITE;
/*!40000 ALTER TABLE `localizacion` DISABLE KEYS */;
INSERT INTO `localizacion` VALUES (1,'C 123','123',1),(2,'C 321','321',4),(3,'C 111','111',7),(4,'C 44','44444',3),(5,'C 55','55555',5),(6,'C 65','65665',9),(7,'C 31','32321',8),(8,'C 77','77077',9),(9,'C 841','84841',2);
/*!40000 ALTER TABLE `localizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `marca_modelo`
--

DROP TABLE IF EXISTS `marca_modelo`;
/*!50001 DROP VIEW IF EXISTS `marca_modelo`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `marca_modelo` AS SELECT 
 1 AS `id_marca`,
 1 AS `marca`,
 1 AS `id_modelo`,
 1 AS `modelo`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'Opel'),(2,'Skoda'),(3,'Dacia'),(4,'Seat'),(5,'Nissan');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path_media` varchar(200) DEFAULT NULL,
  `mime_type` varchar(45) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (2,'/tmp/auto-3298890__340.jpg','',0),(3,'/tmp/fiat-4322521__340.jpg','',0),(4,'/tmp/cuba-1197800_1920.jpg','',0),(5,'/tmp/cuba-1197800__340.jpg','',0),(6,'/tmp/fiat-4322521__340.jpg','',0),(7,'/tmp/fiat-4322521__340.jpg','',0),(8,'/tmp/fiat-4322521__340.jpg','',0),(9,'/tmp/fiat-4322521__340.jpg','',0),(10,'/tmp/cuba-1197800_1920.jpg','',0),(11,'/tmp/fiat-4322521__340.jpg','',0),(12,'/tmp/auto-3298890__340.jpg','',0),(13,'/tmp/auto-3298890__340.jpg','',0),(14,'/tmp/cuba-1197800__340.jpg','',0),(15,'/tmp/boat_house12.jpg','',0),(16,'/tmp/cuba-1197800__340.jpg','',0),(17,'/tmp/cuba-1197800__340.jpg','',0),(18,'/tmp/fiat-4322521__340.jpg','',0);
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modelos`
--

DROP TABLE IF EXISTS `modelos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modelos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(45) DEFAULT NULL,
  `marcas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`marcas_id`),
  KEY `fk_modelos_marcas1_idx` (`marcas_id`),
  CONSTRAINT `fk_modelos_marcas1` FOREIGN KEY (`marcas_id`) REFERENCES `marcas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modelos`
--

LOCK TABLES `modelos` WRITE;
/*!40000 ALTER TABLE `modelos` DISABLE KEYS */;
INSERT INTO `modelos` VALUES (1,'Agila',1),(2,'Duster',3),(3,'Fabia',2),(4,'Zafira',1),(5,'Roomster',2),(6,'Ateca',4),(7,'Mii',4),(8,'Ibiza',4),(9,'Leaf',5),(10,'Juke',5),(11,'Sandero',3),(12,'Astra',1);
/*!40000 ALTER TABLE `modelos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transacciones`
--

DROP TABLE IF EXISTS `transacciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transacciones` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transacciones`
--

LOCK TABLES `transacciones` WRITE;
/*!40000 ALTER TABLE `transacciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `transacciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_vendedor` varchar(45) DEFAULT NULL,
  `apellido_vendedor` varchar(45) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `localizacion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`localizacion_id`),
  KEY `fk_vendedores_localizacion1_idx` (`localizacion_id`),
  CONSTRAINT `fk_vendedores_localizacion1` FOREIGN KEY (`localizacion_id`) REFERENCES `localizacion` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'John','Madsen','123',1),(2,'Ray','Hamilton','321',2),(3,'Terry','Fischer','111',3),(4,'Rachel','Green','444',4),(5,'Tom','Ross','555',5),(6,'Jen','Peterson','777',8);
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bd_coches_v2'
--

--
-- Dumping routines for database 'bd_coches_v2'
--

--
-- Final view structure for view `coches_vendedores`
--

/*!50001 DROP VIEW IF EXISTS `coches_vendedores`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `coches_vendedores` AS select `coches`.`id` AS `id`,`marcas`.`marca` AS `marca`,`modelos`.`modelo` AS `modelo`,`combustible`.`nombre` AS `Combustible`,`coches`.`fecha_fabricacion` AS `fecha_fabricacion`,`coches`.`precio` AS `precio`,`coches`.`vendedores_id` AS `vendedores_id`,`vendedores`.`nombre_vendedor` AS `nombre_vendedor`,`vendedores`.`apellido_vendedor` AS `apellido_vendedor`,`vendedores`.`dni` AS `dni`,`localizacion`.`direccion` AS `direccion`,`localizacion`.`codigo_postal` AS `codigo_postal`,`ciudades`.`ciudad` AS `ciudad`,`ciudades`.`pais` AS `pais` from ((((((`coches` left join `modelos` on(`coches`.`modelos_id` = `modelos`.`id`)) left join `marcas` on(`modelos`.`marcas_id` = `marcas`.`id`)) left join `combustible` on(`coches`.`combustible_id` = `combustible`.`id`)) left join `vendedores` on(`coches`.`vendedores_id` = `vendedores`.`id`)) left join `localizacion` on(`vendedores`.`localizacion_id` = `localizacion`.`id`)) left join `ciudades` on(`localizacion`.`ciudades_id` = `ciudades`.`id`)) order by `marcas`.`marca` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `marca_modelo`
--

/*!50001 DROP VIEW IF EXISTS `marca_modelo`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `marca_modelo` AS select `marcas`.`id` AS `id_marca`,`marcas`.`marca` AS `marca`,`modelos`.`id` AS `id_modelo`,`modelos`.`modelo` AS `modelo` from (`marcas` left join `modelos` on(`marcas`.`id` = `modelos`.`marcas_id`)) order by `marcas`.`marca`,`modelos`.`modelo` */;
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

-- Dump completed on 2020-10-30 16:51:40
