CREATE DATABASE  IF NOT EXISTS `ap3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ap3`;
-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: ap3
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `ca_uuid` varchar(36) NOT NULL,
  `ca_libeller` varchar(45) NOT NULL,
  PRIMARY KEY (`ca_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credentials`
--

DROP TABLE IF EXISTS `credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `credentials` (
  `us_uuid` varchar(36) NOT NULL,
  `cr_password` varchar(60) NOT NULL,
  `cr_lastlog` datetime NOT NULL,
  PRIMARY KEY (`us_uuid`),
  CONSTRAINT `cr_fk_us_id` FOREIGN KEY (`us_uuid`) REFERENCES `users` (`us_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credentials`
--

LOCK TABLES `credentials` WRITE;
/*!40000 ALTER TABLE `credentials` DISABLE KEYS */;
/*!40000 ALTER TABLE `credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_states`
--

DROP TABLE IF EXISTS `order_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_states` (
  `os_uuid` varchar(36) NOT NULL,
  `os_libeller` varchar(45) NOT NULL,
  PRIMARY KEY (`os_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_states`
--

LOCK TABLES `order_states` WRITE;
/*!40000 ALTER TABLE `order_states` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `or_uuid` varchar(36) NOT NULL,
  `or_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `or_total` int unsigned NOT NULL,
  `fk_os_uuid` varchar(36) NOT NULL,
  `fk_us_uuid` varchar(36) NOT NULL,
  PRIMARY KEY (`or_uuid`),
  KEY `fk_os_uuid_idx` (`fk_os_uuid`),
  KEY `fk_us_uuid_idx` (`fk_us_uuid`),
  CONSTRAINT `or_fk_os_uuid` FOREIGN KEY (`fk_os_uuid`) REFERENCES `order_states` (`os_uuid`),
  CONSTRAINT `or_fk_us_uuid` FOREIGN KEY (`fk_us_uuid`) REFERENCES `users` (`us_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `pr_uuid` varchar(36) NOT NULL,
  `pr_libeller` varchar(45) NOT NULL,
  `pr_desc` text NOT NULL,
  `pr_price` double NOT NULL,
  `fk_ca_uuid` varchar(36) NOT NULL,
  PRIMARY KEY (`pr_uuid`),
  KEY `pr_fk_ca_uuid_idx` (`fk_ca_uuid`),
  CONSTRAINT `pr_fk_ca_uuid` FOREIGN KEY (`fk_ca_uuid`) REFERENCES `categories` (`ca_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_baskets`
--

DROP TABLE IF EXISTS `products_baskets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_baskets` (
  `us_uuid` varchar(36) NOT NULL,
  `pr_uuid` varchar(36) NOT NULL,
  `pb_quantity` int unsigned NOT NULL,
  PRIMARY KEY (`us_uuid`,`pr_uuid`),
  KEY `pb_fk_pr_uuid_idx` (`pr_uuid`),
  CONSTRAINT `pb_fk_pr_uuid` FOREIGN KEY (`pr_uuid`) REFERENCES `products` (`pr_uuid`),
  CONSTRAINT `pb_fk_us_uuid` FOREIGN KEY (`us_uuid`) REFERENCES `users` (`us_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_baskets`
--

LOCK TABLES `products_baskets` WRITE;
/*!40000 ALTER TABLE `products_baskets` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_baskets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_orders`
--

DROP TABLE IF EXISTS `products_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_orders` (
  `or_uuid` varchar(36) NOT NULL,
  `pr_uuid` varchar(36) NOT NULL,
  `po_quantity` int unsigned NOT NULL,
  `po_price` double unsigned NOT NULL,
  PRIMARY KEY (`or_uuid`,`pr_uuid`),
  KEY `po_fk_pr_uuid_idx` (`pr_uuid`),
  CONSTRAINT `po_fk_or_uuid` FOREIGN KEY (`or_uuid`) REFERENCES `orders` (`or_uuid`),
  CONSTRAINT `po_fk_pr_uuid` FOREIGN KEY (`pr_uuid`) REFERENCES `products` (`pr_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_orders`
--

LOCK TABLES `products_orders` WRITE;
/*!40000 ALTER TABLE `products_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock` (
  `st_uuid` varchar(36) NOT NULL,
  `pr_uuid` varchar(36) NOT NULL,
  `st_quantity` int unsigned NOT NULL,
  PRIMARY KEY (`st_uuid`,`pr_uuid`),
  KEY `st_fk_pr_uuid_idx` (`pr_uuid`),
  CONSTRAINT `st_fk_pr_uuid` FOREIGN KEY (`pr_uuid`) REFERENCES `products` (`pr_uuid`),
  CONSTRAINT `st_fk_st_uuid` FOREIGN KEY (`st_uuid`) REFERENCES `stores` (`st_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stores` (
  `st_uuid` varchar(36) NOT NULL,
  `st_libeller` varchar(45) NOT NULL,
  `st_city` varchar(45) NOT NULL,
  PRIMARY KEY (`st_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `us_uuid` varchar(36) NOT NULL,
  `us_name` varchar(45) NOT NULL,
  `us_firstname` varchar(45) NOT NULL,
  `us_email` varchar(45) NOT NULL,
  PRIMARY KEY (`us_uuid`),
  UNIQUE KEY `us_email_UNIQUE` (`us_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-12 19:08:21
