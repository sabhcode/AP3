-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: all4sport_lota
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
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (_binary '@É°p\èî¤’ğ/t\ŞM','Rugby','rugby'),(_binary 'ï¿½Bï¿½Zï¿½\ï¿','Boxe','boxe'),(_binary 'ï¿½8ï¿½Zï¿½\ï¿','Foot','foot'),(_binary 'ï¿½bï¿½Zï¿½\ï¿','VÃ©lo','velo'),(_binary 'ï¿½ï¿½bï¿½Zï¿½','Tennis','tennis');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `credential`
--

LOCK TABLES `credential` WRITE;
/*!40000 ALTER TABLE `credential` DISABLE KEYS */;
INSERT INTO `credential` VALUES ('user1@gmail.com','$2y$15$S85HOVmwUxBM0OD4S.N6aOVmVlgkGyWSZR5Af0TVvJnkmSzdhM4kO',NULL),('user2@gmail.com','$2a$15$msiz4F1QrhtkB8yKCMj7o.Gzoqb8gPZHtdYbPGrHiun1Ya1IEP7bq',NULL);
/*!40000 ALTER TABLE `credential` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `order_detail`
--

LOCK TABLES `order_detail` WRITE;
/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `order_rank`
--

LOCK TABLES `order_rank` WRITE;
/*!40000 ALTER TABLE `order_rank` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_rank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `order_state`
--

LOCK TABLES `order_state` WRITE;
/*!40000 ALTER TABLE `order_state` DISABLE KEYS */;
INSERT INTO `order_state` VALUES (_binary '\\ï¿½ï¿½Z	ï¿½\ï¿','transmise'),(_binary 'b8tZ	ï¿½ï¿½ï¿½','validÃ©e'),(_binary 'eï¿½×µZ	ï¿½ï¿½\ï','en prÃ©paration'),(_binary 'iï¿½a:Z	ï¿½ï¿½\ï','expÃ©diÃ©e'),(_binary 'm4ï¿½\rZ	ï¿½ï¿½\ï','livrÃ©e'),(_binary 'prï¿½ï¿½Z	ï¿½\ï¿','retirÃ©e');
/*!40000 ALTER TABLE `order_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (_binary '\0(ùp\æî¤’ğ/t\ŞM',_binary 'ï¿½8ï¿½Zï¿½\ï¿','Pantalon de gardien de but enfant F 100 noir','Description Pantalon de gardien de but enfant F 100 noir',22,'pantalon-de-gardien-de-but-enfant-f-100-noir.jpg',0,'pantalon-de-gardien-de-but-enfant-f-100-noir'),(_binary '\àQ–p\äî¤’ğ/t\ŞM',_binary 'ï¿½ï¿½bï¿½Zï¿½','BALLE DE TENNIS TB160*60 JAUNE','Description BALLE DE TENNIS TB160*60 JAUNE',65,'balle-de-tennis-tb16060-jaune.jpg',0,'balle-de-tennis-tb16060-jaune'),(_binary '\rï¿½ï¿½ï¿½Zï¿½',_binary 'ï¿½8ï¿½Zï¿½\ï¿','But de football SG 500 taille M Bleu orange','Ceci est la description du But de football SG 500 taille M Bleu orange',75,'But de football SG 500 taille M Bleu orange.jpg',0,'but-de-football-sg-500-taille-m-bleu-orange'),(_binary ';p\åî¤’ğ/t\ŞM',_binary 'ï¿½ï¿½bï¿½Zï¿½','SAC A DOS TENNIS - ARTENGO XL Pro 38L Noir Blanc Rouge','Description SAC A DOS TENNIS - ARTENGO XL Pro 38L Noir Blanc Rouge',80,'sac-a-dos-tennis-artengo-xl-pro-38l-noir-blanc-rouge.jpg',0,'sac-a-dos-tennis-artengo-xl-pro-38l-noir-blanc-rouge'),(_binary '-\Ğ\' \É\ÍN\ä®{+\é	ôn',_binary 'ï¿½ï¿½bï¿½Zï¿½','Raquette de tennis bleu jaune','Description de Raquette de tennis bleu jaune',49.9,'raquette-de-tennis-bleu-jaune.jpg',0,'raquette-de-tennis-bleu-jaune'),(_binary '9ï¿½\'HZï¿½ï¿½\ï',_binary 'ï¿½8ï¿½Zï¿½\ï¿','Chaussures de football FUTURE ULTIMATE ENERGY FG/AG PUMA','Ceci est la description des Chaussures de football FUTURE ULTIMATE ENERGY FG/AG PUMA',220,'Chaussures de football FUTURE ULTIMATE ENERGY FG.jpg',0,'chaussures-de-football-future-ultimate-energy-fg-ag-puma'),(_binary ';­´¿p\çî¤’ğ/t\ŞM',_binary 'ï¿½8ï¿½Zï¿½\ï¿','Ballon de Football Molten UEFA Europa League Match Officiel 2023/2024','Description Ballon de Football Molten UEFA Europa League Match Officiel 2023/2024',140,'ballon-de-football-molten-uefa-europa-league-match-officiel-20232024.jpg',0,'ballon-de-football-molten-uefa-europa-league-match-officiel-20232024'),(_binary 'Q7ï¿½ï¿½Zï¿½\ï¿',_binary 'ï¿½8ï¿½Zï¿½\ï¿','Ballon Coupe Du Monde 2018','Ceci est la description du Ballon Coupe Du Monde 2018',49.99,'ballon-futsal-match-ball-coupe-du-monde-2018-repli.webp',0,'ballon-coupe-du-monde-2018'),(_binary 'bğJp\æî¤’ğ/t\ŞM',_binary 'ï¿½8ï¿½Zï¿½\ï¿','MAILLOT DE FOOTBALL MANCHES COURTES VIRALTO SOLO BLANC & NOIR','Description MAILLOT DE FOOTBALL MANCHES COURTES VIRALTO SOLO BLANC & NOIR',12,'maillot-de-football-manches-courtes-viralto-solo-blanc-and-noir.jpg',0,'maillot-de-football-manches-courtes-viralto-solo-blanc-and-noir'),(_binary 'ŸO?¤p\çî¤’ğ/t\ŞM',_binary 'ï¿½8ï¿½Zï¿½\ï¿','Filet Basic goal Taille S','Description Filet Basic goal Taille S',5,'filet-basic-goal-taille-s.jpg',0,'filet-basic-goal-taille-s'),(_binary '¥¨W2p\æî¤’ğ/t\ŞM',_binary 'ï¿½bï¿½Zï¿½\ï¿','POMPE A PIED 500','Description POMPE A PIED 500',20,'pompe-a-pied-500.jpg',0,'pompe-a-pied-500'),(_binary '¹3\Âp¼î¤’ğ/t\ŞM',_binary 'ï¿½Bï¿½Zï¿½\ï¿','Gants de boxe MMA AVEC POUCE NOIR','Description de Gants de boxe MMA AVEC POUCE NOIR',41.5,'gants-box-mma-pouce-noir.png',0,'gants-de-box-mma-avec-pouce-noir'),(_binary '\Ã©ˆp\åî¤’ğ/t\ŞM',_binary 'ï¿½8ï¿½Zï¿½\ï¿','Veste de football impermÃ©able T100 adulte Bleu','Description Veste de football impermÃ©able T100 adulte Bleu',20,'veste-de-football-impermeable-t100-adulte-bleu.jpg',0,'veste-de-football-impermeable-t100-adulte-bleu'),(_binary '\×€p\èî¤’ğ/t\ŞM',_binary '@É°p\èî¤’ğ/t\ŞM','Ballon de Rugby Gilbert Officiel Match Sirius Equipe de France','Description Ballon de Rugby Gilbert Officiel Match Sirius Equipe de France',173,'ballon-de-rugby-gilbert-officiel-match-sirius-equipe-de-france.jpg',0,'ballon-de-rugby-gilbert-officiel-match-sirius-equipe-de-france'),(_binary '\éÙp\çî¤’ğ/t\ŞM',_binary 'ï¿½bï¿½Zï¿½\ï¿','Kit de brosse pour entretien vÃ©lo x3','Description Kit de brosse pour entretien vÃ©lo x3',26.9,'kit-de-brosse-pour-entretien-velo-x3.jpg',0,'kit-de-brosse-pour-entretien-velo-x3'),(_binary 'ï¿½R\\Zï¿½ï¿½\ï',_binary 'ï¿½bï¿½Zï¿½\ï¿','VÃ©lo VTT Ã©lectrique semi-rigide 27,5 pouces - E-ST 500 NOIR','Ceci est la description du VÃ©lo VTT Ã©lectrique semi-rigide 27,5 pouces - E-ST 500 NOIR',1499,'velo-vtt-electrique-semi-rigide-275-e-st-500-noir.jpg',0,'velo-vtt-electrique-semi-rigide-27-5-pouces-e-st-500-noir'),(_binary 'ï¿½4Zï¿½ï¿½\ï',_binary 'ï¿½ï¿½bï¿½Zï¿½','BANDEAU DE SPORT ADIDAS NOIR','Ceci est la description du BANDEAU DE SPORT ADIDAS NOIR',13,'bandeau-de-sport-adidas-noir.jpg',0,'bandeau-de-sport-adidas-noir'),(_binary 'ï¿½[Cï¿½Zï¿½\ï¿',_binary 'ï¿½bï¿½Zï¿½\ï¿','VÃ‰LO VTT RANDONNEE ST 120 NOIR BLEU 27,5 POUCES','Ceci est la description du VÃ‰LO VTT RANDONNEE ST 120 NOIR BLEU 27,5 pouces',339,'velo-vtt-randonnee-st-120-noir-bleu-275.jpg',0,'velo-vtt-randonnee-st-120-noir-bleu-27-5-pouces'),(_binary 'ï¿½ï¿½\'ï¿½Zï¿½',_binary 'ï¿½8ï¿½Zï¿½\ï¿','Hyperflex HN Gants De Gardien','Ceci est la description des Hyperflex HN Gants De Gardien',99.99,'101128601_pngUpLWrxnMjshAs.jpg',0,'hyperflex-hn-gants-de-gardien'),(_binary 'ï¿½ï¿½YjZï¿½\ï¿',_binary 'ï¿½Bï¿½Zï¿½\ï¿','Sac de frappe pied/poing 32 kg adulte','Ceci est la description du Sac de frappe pied/poing 32 kg adulte',119.99,'sac-de-frappe-piedpoing-32-kg-adulte.jpg',0,'sac-de-frappe-pied-point-32-kg-adulte');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (_binary 'u\rH:Zï¿½ï¿½ï¿½',_binary '\rï¿½ï¿½ï¿½Zï¿½',6),(_binary 'u\rH:Zï¿½ï¿½ï¿½',_binary '9ï¿½\'HZï¿½ï¿½\ï',44),(_binary 'u\rH:Zï¿½ï¿½ï¿½',_binary 'Q7ï¿½ï¿½Zï¿½\ï¿',124),(_binary 'u\rH:Zï¿½ï¿½ï¿½',_binary 'ï¿½R\\Zï¿½ï¿½\ï',4),(_binary 'u\rH:Zï¿½ï¿½ï¿½',_binary 'ï¿½[Cï¿½Zï¿½\ï¿',19),(_binary 'u\rH:Zï¿½ï¿½ï¿½',_binary 'ï¿½ï¿½\'ï¿½Zï¿½',65),(_binary 'u\rH:Zï¿½ï¿½ï¿½',_binary 'ï¿½ï¿½YjZï¿½\ï¿',12),(_binary '|ï¿½ï¿½DZï¿½\ï¿',_binary '\rï¿½ï¿½ï¿½Zï¿½',7),(_binary '|ï¿½ï¿½DZï¿½\ï¿',_binary '9ï¿½\'HZï¿½ï¿½\ï',41),(_binary '|ï¿½ï¿½DZï¿½\ï¿',_binary 'Q7ï¿½ï¿½Zï¿½\ï¿',133),(_binary '|ï¿½ï¿½DZï¿½\ï¿',_binary 'ï¿½R\\Zï¿½ï¿½\ï',1),(_binary '|ï¿½ï¿½DZï¿½\ï¿',_binary 'ï¿½[Cï¿½Zï¿½\ï¿',12),(_binary '|ï¿½ï¿½DZï¿½\ï¿',_binary 'ï¿½ï¿½YjZï¿½\ï¿',9),(_binary 'ï¿½ï¿½Zï¿½Zï¿½',_binary '9ï¿½\'HZï¿½ï¿½\ï',34),(_binary 'ï¿½ï¿½Zï¿½Zï¿½',_binary 'Q7ï¿½ï¿½Zï¿½\ï¿',99),(_binary 'ï¿½ï¿½Zï¿½Zï¿½',_binary 'ï¿½R\\Zï¿½ï¿½\ï',3),(_binary 'ï¿½ï¿½Zï¿½Zï¿½',_binary 'ï¿½[Cï¿½Zï¿½\ï¿',33),(_binary 'ï¿½ï¿½Zï¿½Zï¿½',_binary 'ï¿½ï¿½YjZï¿½\ï¿',5),(_binary 'ï¿½ï¿½^KZï¿½\ï¿',_binary '\rï¿½ï¿½ï¿½Zï¿½',22),(_binary 'ï¿½ï¿½^KZï¿½\ï¿',_binary '9ï¿½\'HZï¿½ï¿½\ï',22),(_binary 'ï¿½ï¿½^KZï¿½\ï¿',_binary 'Q7ï¿½ï¿½Zï¿½\ï¿',88),(_binary 'ï¿½ï¿½^KZï¿½\ï¿',_binary 'ï¿½ï¿½\'ï¿½Zï¿½',19),(_binary 'ï¿½ï¿½ï¿½Zï¿½',_binary '\rï¿½ï¿½ï¿½Zï¿½',12),(_binary 'ï¿½ï¿½ï¿½Zï¿½',_binary 'Q7ï¿½ï¿½Zï¿½\ï¿',121),(_binary 'ï¿½ï¿½ï¿½Zï¿½',_binary 'ï¿½[Cï¿½Zï¿½\ï¿',15),(_binary 'ï¿½ï¿½ï¿½Zï¿½',_binary 'ï¿½ï¿½\'ï¿½Zï¿½',42),(_binary 'ï¿½ï¿½ï¿½Zï¿½',_binary 'ï¿½ï¿½YjZï¿½\ï¿',32),(_binary 'ï¿½ï¿½ï¿½ï¿½Z\ï',_binary 'Q7ï¿½ï¿½Zï¿½\ï¿',54),(_binary 'ï¿½ï¿½ï¿½ï¿½Z\ï',_binary 'ï¿½R\\Zï¿½ï¿½\ï',16),(_binary 'ï¿½ï¿½ï¿½ï¿½Z\ï',_binary 'ï¿½ï¿½\'ï¿½Zï¿½',23),(_binary 'ï¿½ï¿½ï¿½ï¿½Z\ï',_binary 'ï¿½ï¿½YjZï¿½\ï¿',32);
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `store`
--

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` VALUES (_binary 'u\rH:Zï¿½ï¿½ï¿½','Valenciennes'),(_binary '|ï¿½ï¿½DZï¿½\ï¿','Lille'),(_binary 'ï¿½ï¿½Zï¿½Zï¿½','Metz'),(_binary 'ï¿½ï¿½^KZï¿½\ï¿','Lens'),(_binary 'ï¿½ï¿½ï¿½Zï¿½','Arras'),(_binary 'ï¿½ï¿½ï¿½ï¿½Z\ï','Dunkerque');
/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (_binary '8ï¿½ï¿½Z\nï¿½\ï¿','user1@gmail.com','[]','NomUser1','PrenomUser1','2414 Pleasant Hill Road','33432','Boca Raton','561-962-2040',1),(_binary '\\Eï¿½ï¿½Z\nï¿½\ï¿','user2@gmail.com','[]','NomUser2','PrenomUser2','2263 Post Avenue','56469','Palisade','218-845-7546',1);
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

-- Dump completed on 2023-10-22 17:03:11
