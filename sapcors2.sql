CREATE DATABASE  IF NOT EXISTS `sapcors2` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sapcors2`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: sapcors2
-- ------------------------------------------------------
-- Server version	8.0.18

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
-- Table structure for table `contacto`
--

DROP TABLE IF EXISTS `contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `primerApellido` varchar(20) NOT NULL,
  `segundoApellido` varchar(20) DEFAULT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `domicilio_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacto`
--

LOCK TABLES `contacto` WRITE;
/*!40000 ALTER TABLE `contacto` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estudiante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `primerApellido` varchar(20) NOT NULL,
  `segundoApellido` varchar(20) DEFAULT NULL,
  `semestre` int(11) NOT NULL,
  `passwd` varchar(15) NOT NULL,
  `enfoque_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=221561 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudiante`
--

LOCK TABLES `estudiante` WRITE;
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
INSERT INTO `estudiante` VALUES (221560,'Carlos alumno','Aranda','Ochoa',8,'123',1);
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente_contacto`
--

DROP TABLE IF EXISTS `paciente_contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente_contacto` (
  `paciente_id` int(11) NOT NULL,
  `contacto_id` int(11) NOT NULL,
  `relacion` varchar(20) NOT NULL,
  PRIMARY KEY (`paciente_id`,`contacto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente_contacto`
--

LOCK TABLES `paciente_contacto` WRITE;
/*!40000 ALTER TABLE `paciente_contacto` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente_contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso`
--

DROP TABLE IF EXISTS `proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proceso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicio` date NOT NULL,
  `fechaFin` date DEFAULT NULL,
  `horasSumadas` int(11) NOT NULL,
  `programa` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `psicologo_id` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proceso`
--

LOCK TABLES `proceso` WRITE;
/*!40000 ALTER TABLE `proceso` DISABLE KEYS */;
INSERT INTO `proceso` VALUES (1,'2020-06-25',NULL,0,1,221560,'CED12345');
/*!40000 ALTER TABLE `proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `psicologo`
--

DROP TABLE IF EXISTS `psicologo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `psicologo` (
  `id` varchar(8) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `primerApellido` varchar(20) NOT NULL,
  `segundoApellido` varchar(20) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `horaEntrada` time NOT NULL,
  `horaSalida` time NOT NULL,
  `passwd` varchar(15) NOT NULL,
  `rol` int(11) NOT NULL,
  `domicilio_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `psicologo`
--

LOCK TABLES `psicologo` WRITE;
/*!40000 ALTER TABLE `psicologo` DISABLE KEYS */;
INSERT INTO `psicologo` VALUES ('CED12345','Carlos Psicologo','Aranda','Ochoa','carlos@psicologos.com','9175749','08:00:00','11:30:00','contra123',1,1),('CED12346','Emmanuel Psicologo','Aranda','Ochoa','emmanuel@psicologos.com','9175749','08:00:00','11:30:00','contra123',1,3),('CED12347','Isaac Psicologo','Esquivel','Ramirez','isaac@psicologos.com','3968116','11:30:00','15:00:00','contra123',1,4),('CED12348','Monica Psicologa','Barrios','Zavala','monica@psicologos.com','3968116','11:30:00','15:00:00','contra123',2,5);
/*!40000 ALTER TABLE `psicologo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reporte`
--

DROP TABLE IF EXISTS `reporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reporte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `horasReportadas` int(11) NOT NULL,
  `proceso_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reporte`
--

LOCK TABLES `reporte` WRITE;
/*!40000 ALTER TABLE `reporte` DISABLE KEYS */;
/*!40000 ALTER TABLE `reporte` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-26 13:26:46
