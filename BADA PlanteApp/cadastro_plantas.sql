-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cadastro
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `plantas`
--

DROP TABLE IF EXISTS `plantas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plantas` (
  `idplantas` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `descricao` mediumtext DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `opcao` enum('doar','trocar','vender') DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `troca` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idplantas`),
  KEY `fk_plantas_usuarios_idx` (`usuario_id`),
  CONSTRAINT `fk_plantas_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `cadastro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plantas`
--

LOCK TABLES `plantas` WRITE;
/*!40000 ALTER TABLE `plantas` DISABLE KEYS */;
INSERT INTO `plantas` VALUES (3,'Logo','Digital',NULL,'É uma bela Planta.','3plantas.png','vender',100000.00,NULL,NULL),(6,'Mini Plantinha','Digital',NULL,'Facil de cuidar dificil de morrer','plantamini.png','doar',NULL,1,NULL),(8,'Planta','Digital','(12) 23321-3123','É pranta','3plantas.png','vender',100000.00,2,NULL),(22,'Teste','Digital','(75) 64787-6540','Teste','cadastro.png','trocar',NULL,2,'Rtx 5090 lacrada'),(23,'Log','Digital','(42) 56646-7683','Logo','planta_68b79383dc2bf9.69075104.png','doar',NULL,2,NULL);
/*!40000 ALTER TABLE `plantas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-02 22:31:19
