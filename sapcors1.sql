CREATE DATABASE  IF NOT EXISTS `sapcors1` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sapcors1`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: sapcors1
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
-- Table structure for table `antecedente`
--

DROP TABLE IF EXISTS `antecedente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `antecedente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motivo` varchar(60) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `antecedente`
--

LOCK TABLES `antecedente` WRITE;
/*!40000 ALTER TABLE `antecedente` DISABLE KEYS */;
/*!40000 ALTER TABLE `antecedente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleo`
--

DROP TABLE IF EXISTS `empleo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `puesto` varchar(50) NOT NULL,
  `lugar` varchar(70) NOT NULL,
  `horarioEntrada` time NOT NULL,
  `horarioSalida` time DEFAULT NULL,
  `paciente_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleo`
--

LOCK TABLES `empleo` WRITE;
/*!40000 ALTER TABLE `empleo` DISABLE KEYS */;
/*!40000 ALTER TABLE `empleo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enfoque`
--

DROP TABLE IF EXISTS `enfoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enfoque` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enfoque`
--

LOCK TABLES `enfoque` WRITE;
/*!40000 ALTER TABLE `enfoque` DISABLE KEYS */;
INSERT INTO `enfoque` VALUES (1,'unEnfoque');
/*!40000 ALTER TABLE `enfoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial`
--

DROP TABLE IF EXISTS `historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motivo` varchar(60) NOT NULL,
  `DSM5` varchar(45) DEFAULT NULL,
  `CIE10` varchar(45) DEFAULT NULL,
  `horasDescanso` int(11) DEFAULT NULL,
  `pensamientosSuicidas` int(11) DEFAULT NULL,
  `ideasSuicidas` int(11) DEFAULT NULL,
  `intentosSuicidas` int(11) DEFAULT NULL,
  `intencionSuicida` int(11) DEFAULT NULL,
  `accidentes` int(11) DEFAULT NULL,
  `secuelas` varchar(200) DEFAULT NULL,
  `calculosMentales` int(11) DEFAULT NULL,
  `habla` int(11) DEFAULT NULL,
  `motricidadManual` int(11) DEFAULT NULL,
  `historiaFamilia` varchar(300) DEFAULT NULL,
  `historiaAmorosa` varchar(300) DEFAULT NULL,
  `violencia` varchar(30) DEFAULT NULL,
  `intentosSalir` varchar(200) DEFAULT NULL,
  `paciente_id` int(11) NOT NULL,
  `enfoque_id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial`
--

LOCK TABLES `historial` WRITE;
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `primerApellido` varchar(20) NOT NULL,
  `segundoApellido` varchar(20) DEFAULT NULL,
  `fechaNacimiento` date NOT NULL,
  `primerContacto` int(11) NOT NULL,
  `estudios` int(11) NOT NULL,
  `necesidadEspecial` varchar(50) NOT NULL,
  `activo` int(11) NOT NULL,
  `domicilio_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente_droga`
--

DROP TABLE IF EXISTS `paciente_droga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente_droga` (
  `paciente_id` int(11) NOT NULL,
  `droga_id` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date DEFAULT NULL,
  `dosis` varchar(10) NOT NULL,
  `frecuencia` varchar(20) NOT NULL,
  PRIMARY KEY (`paciente_id`,`droga_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente_droga`
--

LOCK TABLES `paciente_droga` WRITE;
/*!40000 ALTER TABLE `paciente_droga` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente_droga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente_medicamento`
--

DROP TABLE IF EXISTS `paciente_medicamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente_medicamento` (
  `paciente_id` int(11) NOT NULL,
  `medicamento_id` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date DEFAULT NULL,
  `frecuencia` varchar(20) NOT NULL,
  `dosis` varchar(10) NOT NULL,
  PRIMARY KEY (`paciente_id`,`medicamento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente_medicamento`
--

LOCK TABLES `paciente_medicamento` WRITE;
/*!40000 ALTER TABLE `paciente_medicamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente_medicamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente_padecimientocronico`
--

DROP TABLE IF EXISTS `paciente_padecimientocronico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente_padecimientocronico` (
  `paciente_id` int(11) NOT NULL,
  `padecimientoCronico_id` int(11) NOT NULL,
  PRIMARY KEY (`paciente_id`,`padecimientoCronico_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente_padecimientocronico`
--

LOCK TABLES `paciente_padecimientocronico` WRITE;
/*!40000 ALTER TABLE `paciente_padecimientocronico` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente_padecimientocronico` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-26 13:26:36
