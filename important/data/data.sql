CREATE DATABASE  IF NOT EXISTS `all4sport` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `all4sport`;
-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: all4sport
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (_binary '�B�Z�\�','Boxe'),(_binary '�8�Z�\�','Foot'),(_binary '�b�Z�\�','Vélo'),(_binary '��b�Z�','Tennis');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credential`
--

DROP TABLE IF EXISTS `credential`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `credential` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_connection` datetime DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credential`
--

LOCK TABLES `credential` WRITE;
/*!40000 ALTER TABLE `credential` DISABLE KEYS */;
INSERT INTO `credential` VALUES ('user1@gmail.com','$2a$15$WCyI5dhiIE2ad8I0i4PVMeaBFxFBNBzX773m4UOjHX75vwohX66li',NULL),('user2@gmail.com','$2a$15$msiz4F1QrhtkB8yKCMj7o.Gzoqb8gPZHtdYbPGrHiun1Ya1IEP7bq',NULL);
/*!40000 ALTER TABLE `credential` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `date_time` datetime NOT NULL,
  `total_price` double NOT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_detail` (
  `order_uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `product_uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`order_uuid`,`product_uuid`),
  KEY `IDX_ED896F469C8E6AB1` (`order_uuid`),
  KEY `IDX_ED896F465C977207` (`product_uuid`),
  CONSTRAINT `FK_ED896F465C977207` FOREIGN KEY (`product_uuid`) REFERENCES `product` (`uuid`),
  CONSTRAINT `FK_ED896F469C8E6AB1` FOREIGN KEY (`order_uuid`) REFERENCES `order` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_detail`
--

LOCK TABLES `order_detail` WRITE;
/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_rank`
--

DROP TABLE IF EXISTS `order_rank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_rank` (
  `order_uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `orderstate_uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`order_uuid`,`orderstate_uuid`),
  KEY `IDX_C588D2F29C8E6AB1` (`order_uuid`),
  KEY `IDX_C588D2F2B4870385` (`orderstate_uuid`),
  CONSTRAINT `FK_C588D2F29C8E6AB1` FOREIGN KEY (`order_uuid`) REFERENCES `order` (`uuid`),
  CONSTRAINT `FK_C588D2F2B4870385` FOREIGN KEY (`orderstate_uuid`) REFERENCES `order_state` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_rank`
--

LOCK TABLES `order_rank` WRITE;
/*!40000 ALTER TABLE `order_rank` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_rank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_state`
--

DROP TABLE IF EXISTS `order_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_state` (
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_state`
--

LOCK TABLES `order_state` WRITE;
/*!40000 ALTER TABLE `order_state` DISABLE KEYS */;
INSERT INTO `order_state` VALUES (_binary '\\��Z	�\�','transmise'),(_binary 'b8tZ	���','validée'),(_binary 'e�׵Z	��\�','en préparation'),(_binary 'i�a:Z	��\�','expédiée'),(_binary 'm4�\rZ	��\�','livrée'),(_binary 'pr��Z	�\�','retirée');
/*!40000 ALTER TABLE `order_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `category_uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_sales` int NOT NULL,
  PRIMARY KEY (`uuid`),
  UNIQUE KEY `UNIQ_1CF73D315E237E06` (`name`),
  KEY `IDX_1CF73D315AE42AE1` (`category_uuid`),
  CONSTRAINT `FK_1CF73D315AE42AE1` FOREIGN KEY (`category_uuid`) REFERENCES `category` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (_binary '\r���Z�',_binary '�8�Z�\�','But de football SG 500 taille M Bleu orange','Ceci est la description du But de football SG 500 taille M Bleu orange',75,'But de football SG 500 taille M Bleu orange.jpg', 0),(_binary '9�\'HZ��\�',_binary '�8�Z�\�','Chaussures de football FUTURE ULTIMATE ENERGY FG/AG PUMA','Ceci est la description des Chaussures de football FUTURE ULTIMATE ENERGY FG/AG PUMA',220,'Chaussures de football FUTURE ULTIMATE ENERGY FG.jpg', 0),(_binary 'Q7��Z�\�',_binary '�8�Z�\�','Ballon Coupe Du Monde 2018','Ceci est la description du Ballon Coupe Du Monde 2018',49.99,'ballon-futsal-match-ball-coupe-du-monde-2018-repli.webp', 0),(_binary '�R\\Z��\�',_binary '�b�Z�\�','Vélo VTT électrique semi-rigide 27,5 pouces - E-ST 500 NOIR','Ceci est la description du Vélo VTT électrique semi-rigide 27,5\" - E-ST 500 NOIR',1499,'velo-vtt-electrique-semi-rigide-275-e-st-500-noir.jpg', 0),(_binary '�4Z��\�',_binary '��b�Z�','BANDEAU DE SPORT ADIDAS NOIR','Ceci est la description du BANDEAU DE SPORT ADIDAS NOIR',13,'bandeau-de-sport-adidas-noir.jpg', 0),(_binary '�[C�Z�\�',_binary '�b�Z�\�','VÉLO VTT RANDONNEE ST 120 NOIR BLEU 27,5 POUCES','Ceci est la description du VÉLO VTT RANDONNEE ST 120 NOIR BLEU 27,5\"',339,'velo-vtt-randonnee-st-120-noir-bleu-275.jpg', 0),(_binary '��\'�Z�',_binary '�8�Z�\�','Hyperflex HN Gants De Gardien','Ceci est la description des Hyperflex HN Gants De Gardien',99.99,'101128601_pngUpLWrxnMjshAs.jpg', 0),(_binary '��YjZ�\�',_binary '�B�Z�\�','Sac de frappe pied/poing 32 kg adulte','Ceci est la description du Sac de frappe pied/poing 32 kg adulte',119.99,'sac-de-frappe-piedpoing-32-kg-adulte.jpg', 0);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock` (
  `store_uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `product_uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `quantity` int NOT NULL,
  PRIMARY KEY (`store_uuid`,`product_uuid`),
  KEY `IDX_8AF7796433C6FE68` (`store_uuid`),
  KEY `IDX_8AF779645C977207` (`product_uuid`),
  CONSTRAINT `FK_8AF7796433C6FE68` FOREIGN KEY (`store_uuid`) REFERENCES `store` (`uuid`),
  CONSTRAINT `FK_8AF779645C977207` FOREIGN KEY (`product_uuid`) REFERENCES `product` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (_binary 'u\rH:Z���',_binary '\r���Z�',6),(_binary 'u\rH:Z���',_binary '9�\'HZ��\�',44),(_binary 'u\rH:Z���',_binary 'Q7��Z�\�',124),(_binary 'u\rH:Z���',_binary '�R\\Z��\�',4),(_binary 'u\rH:Z���',_binary '�[C�Z�\�',19),(_binary 'u\rH:Z���',_binary '��\'�Z�',65),(_binary 'u\rH:Z���',_binary '��YjZ�\�',12),(_binary '|��DZ�\�',_binary '\r���Z�',7),(_binary '|��DZ�\�',_binary '9�\'HZ��\�',41),(_binary '|��DZ�\�',_binary 'Q7��Z�\�',133),(_binary '|��DZ�\�',_binary '�R\\Z��\�',1),(_binary '|��DZ�\�',_binary '�[C�Z�\�',12),(_binary '|��DZ�\�',_binary '��YjZ�\�',9),(_binary '��Z�Z�',_binary '9�\'HZ��\�',34),(_binary '��Z�Z�',_binary 'Q7��Z�\�',99),(_binary '��Z�Z�',_binary '�R\\Z��\�',3),(_binary '��Z�Z�',_binary '�[C�Z�\�',33),(_binary '��Z�Z�',_binary '��YjZ�\�',5),(_binary '��^KZ�\�',_binary '\r���Z�',22),(_binary '��^KZ�\�',_binary '9�\'HZ��\�',22),(_binary '��^KZ�\�',_binary 'Q7��Z�\�',88),(_binary '��^KZ�\�',_binary '��\'�Z�',19),(_binary '���Z�',_binary '\r���Z�',12),(_binary '���Z�',_binary 'Q7��Z�\�',121),(_binary '���Z�',_binary '�[C�Z�\�',15),(_binary '���Z�',_binary '��\'�Z�',42),(_binary '���Z�',_binary '��YjZ�\�',32),(_binary '����Z\�',_binary 'Q7��Z�\�',54),(_binary '����Z\�',_binary '�R\\Z��\�',16),(_binary '����Z\�',_binary '��\'�Z�',23),(_binary '����Z\�',_binary '��YjZ�\�',32);
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store` (
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store`
--

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` VALUES (_binary 'u\rH:Z���','Valenciennes'),(_binary '|��DZ�\�','Lille'),(_binary '��Z�Z�','Metz'),(_binary '��^KZ�\�','Lens'),(_binary '���Z�','Arras'),(_binary '����Z\�','Dunkerque');
/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `uuid` binary(16) NOT NULL COMMENT '(DC2Type:uuid)',
  `credential_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`uuid`),
  UNIQUE KEY `UNIQ_2DA17977A5D24B55` (`credential_email`),
  CONSTRAINT `FK_2DA17977A5D24B55` FOREIGN KEY (`credential_email`) REFERENCES `credential` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (_binary '8��Z\n�\�','user1@gmail.com','[]','NomUser1','PrenomUser1',1),(_binary '\\E��Z\n�\�','user2@gmail.com','[]','NomUser2','PrenomUser2',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-29 18:52:11
