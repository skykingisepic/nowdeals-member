-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: 149.28.249.46    Database: nowdeals
-- ------------------------------------------------------
-- Server version	11.4.3-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `pwd` varchar(10) NOT NULL,
  `jdate` date NOT NULL,
  `tier` varchar(1) DEFAULT NULL,
  `epic` decimal(17,8) DEFAULT 0.00000000,
  `email` varchar(40) NOT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `edate` date DEFAULT NULL,
  `erate` decimal(17,2) DEFAULT 0.00,
  `txhash` varchar(60) DEFAULT NULL,
  `usdt` smallint(5) DEFAULT NULL,
  `act` tinyint(1) DEFAULT 1,
  `refby` varchar(10) DEFAULT NULL,
  `refcode` varchar(10) DEFAULT NULL,
  `usdtadd` varchar(60) DEFAULT NULL,
  `commpend` mediumint(7) DEFAULT 0,
  `commtot` mediumint(7) DEFAULT 0,
  `country` varchar(20) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `commdone` tinyint(1) DEFAULT 0,
  `usdta` smallint(5) DEFAULT NULL,
  `vend` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `unique_email` (`email`),
  KEY `email_add` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
