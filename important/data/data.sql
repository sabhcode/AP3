-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: all4sport
-- ------------------------------------------------------
-- Server version	8.0.31
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!50503 SET NAMES utf8 */
;

/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;

/*!40103 SET TIME_ZONE='+00:00' */
;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;

/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;

--
-- Dumping data for table `category`
--
LOCK TABLES `category` WRITE;

/*!40000 ALTER TABLE `category` DISABLE KEYS */
;

INSERT INTO
    `category`
VALUES
    (_binary '�B�Z�\�', 'Boxe', 'boxe'),
(_binary '�8�Z�\�', 'Foot', 'foot'),
(_binary '�b�Z�\�', 'Vélo', 'velo'),
(_binary '��b�Z�', 'Tennis', 'tennis');

/*!40000 ALTER TABLE `category` ENABLE KEYS */
;

UNLOCK TABLES;

--
-- Dumping data for table `credential`
--
LOCK TABLES `credential` WRITE;

/*!40000 ALTER TABLE `credential` DISABLE KEYS */
;

INSERT INTO
    `credential`
VALUES
    (
        'user1@gmail.com',
        '$2a$15$WCyI5dhiIE2ad8I0i4PVMeaBFxFBNBzX773m4UOjHX75vwohX66li',
        NULL
    ),
(
        'user2@gmail.com',
        '$2a$15$msiz4F1QrhtkB8yKCMj7o.Gzoqb8gPZHtdYbPGrHiun1Ya1IEP7bq',
        NULL
    );

/*!40000 ALTER TABLE `credential` ENABLE KEYS */
;

UNLOCK TABLES;

--
-- Dumping data for table `order`
--
LOCK TABLES `order` WRITE;

/*!40000 ALTER TABLE `order` DISABLE KEYS */
;

/*!40000 ALTER TABLE `order` ENABLE KEYS */
;

UNLOCK TABLES;

--
-- Dumping data for table `order_detail`
--
LOCK TABLES `order_detail` WRITE;

/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */
;

/*!40000 ALTER TABLE `order_detail` ENABLE KEYS */
;

UNLOCK TABLES;

--
-- Dumping data for table `order_rank`
--
LOCK TABLES `order_rank` WRITE;

/*!40000 ALTER TABLE `order_rank` DISABLE KEYS */
;

/*!40000 ALTER TABLE `order_rank` ENABLE KEYS */
;

UNLOCK TABLES;

--
-- Dumping data for table `order_state`
--
LOCK TABLES `order_state` WRITE;

/*!40000 ALTER TABLE `order_state` DISABLE KEYS */
;

INSERT INTO
    `order_state`
VALUES
    (_binary '\\��Z	�\�', 'transmise'),
(_binary 'b8tZ	���', 'validée'),
(_binary 'e�׵Z	��\�', 'en préparation'),
(_binary 'i�a:Z	��\�', 'expédiée'),
(_binary 'm4�\rZ	��\�', 'livrée'),
(_binary 'pr��Z	�\�', 'retirée');

/*!40000 ALTER TABLE `order_state` ENABLE KEYS */
;

UNLOCK TABLES;

--
-- Dumping data for table `product`
--
LOCK TABLES `product` WRITE;

/*!40000 ALTER TABLE `product` DISABLE KEYS */
;

INSERT INTO
    `product`
VALUES
    (
        _binary '\r���Z�',
        _binary '�8�Z�\�',
        'But de football SG 500 taille M Bleu orange',
        'Ceci est la description du But de football SG 500 taille M Bleu orange',
        75,
        'But de football SG 500 taille M Bleu orange.jpg',
        0,
        'but-de-football-sg-500-taille-m-bleu-orange'
    ),
(
        _binary '9�\'HZ��\�',
        _binary '�8�Z�\�',
        'Chaussures de football FUTURE ULTIMATE ENERGY FG/AG PUMA',
        'Ceci est la description des Chaussures de football FUTURE ULTIMATE ENERGY FG/AG PUMA',
        220,
        'Chaussures de football FUTURE ULTIMATE ENERGY FG.jpg',
        0,
        'chaussures-de-football-future-ultimate-energy-fg-ag-puma'
    ),
(
        _binary 'Q7��Z�\�',
        _binary '�8�Z�\�',
        'Ballon Coupe Du Monde 2018',
        'Ceci est la description du Ballon Coupe Du Monde 2018',
        49.99,
        'ballon-futsal-match-ball-coupe-du-monde-2018-repli.webp',
        0,
        'ballon-coupe-du-monde-2018'
    ),
(
        _binary '�R\\Z��\�',
        _binary '�b�Z�\�',
        'Vélo VTT électrique semi-rigide 27,5 pouces - E-ST 500 NOIR',
        'Ceci est la description du Vélo VTT électrique semi-rigide 27,5 pouces - E-ST 500 NOIR',
        1499,
        'velo-vtt-electrique-semi-rigide-275-e-st-500-noir.jpg',
        0,
        'velo-vtt-electrique-semi-rigide-27-5-pouces-e-st-500-noir'
    ),
(
        _binary '�4Z��\�',
        _binary '��b�Z�',
        'BANDEAU DE SPORT ADIDAS NOIR',
        'Ceci est la description du BANDEAU DE SPORT ADIDAS NOIR',
        13,
        'bandeau-de-sport-adidas-noir.jpg',
        0,
        'bandeau-de-sport-adidas-noir'
    ),
(
        _binary '�[C�Z�\�',
        _binary '�b�Z�\�',
        'VÉLO VTT RANDONNEE ST 120 NOIR BLEU 27,5 POUCES',
        'Ceci est la description du VÉLO VTT RANDONNEE ST 120 NOIR BLEU 27,5 pouces',
        339,
        'velo-vtt-randonnee-st-120-noir-bleu-275.jpg',
        0,
        'velo-vtt-randonnee-st-120-noir-bleu-27-5-pouces'
    ),
(
        _binary '��\'�Z�',
        _binary '�8�Z�\�',
        'Hyperflex HN Gants De Gardien',
        'Ceci est la description des Hyperflex HN Gants De Gardien',
        99.99,
        '101128601_pngUpLWrxnMjshAs.jpg',
        0,
        'hyperflex-hn-gants-de-gardien'
    ),
(
        _binary '��YjZ�\�',
        _binary '�B�Z�\�',
        'Sac de frappe pied/poing 32 kg adulte',
        'Ceci est la description du Sac de frappe pied/poing 32 kg adulte',
        119.99,
        'sac-de-frappe-piedpoing-32-kg-adulte.jpg',
        0,
        'sac-de-frappe-pied-point-32-kg-adulte'
    );

/*!40000 ALTER TABLE `product` ENABLE KEYS */
;

UNLOCK TABLES;

--
-- Dumping data for table `stock`
--
LOCK TABLES `stock` WRITE;

/*!40000 ALTER TABLE `stock` DISABLE KEYS */
;

INSERT INTO
    `stock`
VALUES
    (_binary 'u\rH:Z���', _binary '\r���Z�', 6),
(_binary 'u\rH:Z���', _binary '9�\'HZ��\�', 44),
(_binary 'u\rH:Z���', _binary 'Q7��Z�\�', 124),
(_binary 'u\rH:Z���', _binary '�R\\Z��\�', 4),
(_binary 'u\rH:Z���', _binary '�[C�Z�\�', 19),
(_binary 'u\rH:Z���', _binary '��\'�Z�', 65),
(_binary 'u\rH:Z���', _binary '��YjZ�\�', 12),
(_binary '|��DZ�\�', _binary '\r���Z�', 7),
(_binary '|��DZ�\�', _binary '9�\'HZ��\�', 41),
(_binary '|��DZ�\�', _binary 'Q7��Z�\�', 133),
(_binary '|��DZ�\�', _binary '�R\\Z��\�', 1),
(_binary '|��DZ�\�', _binary '�[C�Z�\�', 12),
(_binary '|��DZ�\�', _binary '��YjZ�\�', 9),
(_binary '��Z�Z�', _binary '9�\'HZ��\�', 34),
(_binary '��Z�Z�', _binary 'Q7��Z�\�', 99),
(_binary '��Z�Z�', _binary '�R\\Z��\�', 3),
(_binary '��Z�Z�', _binary '�[C�Z�\�', 33),
(_binary '��Z�Z�', _binary '��YjZ�\�', 5),
(_binary '��^KZ�\�', _binary '\r���Z�', 22),
(_binary '��^KZ�\�', _binary '9�\'HZ��\�', 22),
(_binary '��^KZ�\�', _binary 'Q7��Z�\�', 88),
(_binary '��^KZ�\�', _binary '��\'�Z�', 19),
(_binary '���Z�', _binary '\r���Z�', 12),
(_binary '���Z�', _binary 'Q7��Z�\�', 121),
(_binary '���Z�', _binary '�[C�Z�\�', 15),
(_binary '���Z�', _binary '��\'�Z�', 42),
(_binary '���Z�', _binary '��YjZ�\�', 32),
(_binary '����Z\�', _binary 'Q7��Z�\�', 54),
(_binary '����Z\�', _binary '�R\\Z��\�', 16),
(_binary '����Z\�', _binary '��\'�Z�', 23),
(_binary '����Z\�', _binary '��YjZ�\�', 32);

/*!40000 ALTER TABLE `stock` ENABLE KEYS */
;

UNLOCK TABLES;

--
-- Dumping data for table `store`
--
LOCK TABLES `store` WRITE;

/*!40000 ALTER TABLE `store` DISABLE KEYS */
;

INSERT INTO
    `store`
VALUES
    (_binary 'u\rH:Z���', 'Valenciennes'),
(_binary '|��DZ�\�', 'Lille'),
(_binary '��Z�Z�', 'Metz'),
(_binary '��^KZ�\�', 'Lens'),
(_binary '���Z�', 'Arras'),
(_binary '����Z\�', 'Dunkerque');

/*!40000 ALTER TABLE `store` ENABLE KEYS */
;

UNLOCK TABLES;

--
-- Dumping data for table `user`
--
LOCK TABLES `user` WRITE;

/*!40000 ALTER TABLE `user` DISABLE KEYS */
;

INSERT INTO
    `user`
VALUES
    (
        _binary '8��Z\n�\�',
        'user1@gmail.com',
        '[]',
        'NomUser1',
        'PrenomUser1',
        '2414 Pleasant Hill Road',
        '33432',
        'Boca Raton',
        '561-962-2040',
        1
    ),
(
        _binary '\\E��Z\n�\�',
        'user2@gmail.com',
        '[]',
        'NomUser2',
        'PrenomUser2',
        '2263 Post Avenue',
        '56469',
        'Palisade',
        '218-845-7546',
        1
    );

/*!40000 ALTER TABLE `user` ENABLE KEYS */
;

UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */
;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;

/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;

-- Dump completed on 2023-10-12 16:37:14