-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: all4sport
-- ------------------------------------------------------
-- Server version	8.0.32
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
    (1, 'Rugby', 'rugby'),
(2, 'Boxe', 'boxe'),
(3, 'Foot', 'foot'),
(4, 'Vélo', 'velo'),
(5, 'Tennis', 'tennis');

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
        '$2y$15$S85HOVmwUxBM0OD4S.N6aOVmVlgkGyWSZR5Af0TVvJnkmSzdhM4kO',
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
    (1, 'transmise'),
(2, 'validée'),
(3, 'en préparation'),
(4, 'expédiée'),
(5, 'livrée'),
(6, 'retirée');

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
        000000000001,
        3,
        'Pantalon de gardien de but enfant F 100 noir',
        'Description Pantalon de gardien de but enfant F 100 noir',
        22.00,
        0,
        'pantalon-de-gardien-de-but-enfant-f-100-noir'
    ),
(
        000000000002,
        5,
        'BALLE DE TENNIS TB160*60 JAUNE',
        'Description BALLE DE TENNIS TB160*60 JAUNE',
        65.00,
        0,
        'balle-de-tennis-tb16060-jaune'
    ),
(
        000000000003,
        3,
        'But de football SG 500 taille M Bleu orange',
        'Ceci est la description du But de football SG 500 taille M Bleu orange',
        75.00,
        0,
        'but-de-football-sg-500-taille-m-bleu-orange'
    ),
(
        000000000004,
        5,
        'SAC A DOS TENNIS - ARTENGO XL Pro 38L Noir Blanc Rouge',
        'Description SAC A DOS TENNIS - ARTENGO XL Pro 38L Noir Blanc Rouge',
        80.00,
        0,
        'sac-a-dos-tennis-artengo-xl-pro-38l-noir-blanc-rouge'
    ),
(
        000000000005,
        5,
        'Raquette de tennis bleu jaune',
        'Description de Raquette de tennis bleu jaune',
        49.90,
        0,
        'raquette-de-tennis-bleu-jaune'
    ),
(
        000000000006,
        3,
        'Chaussures de football FUTURE ULTIMATE ENERGY FG/AG PUMA',
        'Ceci est la description des Chaussures de football FUTURE ULTIMATE ENERGY FG/AG PUMA',
        220.00,
        0,
        'chaussures-de-football-future-ultimate-energy-fg-ag-puma'
    ),
(
        000000000007,
        3,
        'Ballon de Football Molten UEFA Europa League Match Officiel 2023/2024',
        'Description Ballon de Football Molten UEFA Europa League Match Officiel 2023/2024',
        140.00,
        0,
        'ballon-de-football-molten-uefa-europa-league-match-officiel-2023-2024'
    ),
(
        000000000008,
        3,
        'Ballon Coupe Du Monde 2018',
        'Ceci est la description du Ballon Coupe Du Monde 2018',
        49.99,
        0,
        'ballon-coupe-du-monde-2018'
    ),
(
        000000000009,
        3,
        'MAILLOT DE FOOTBALL MANCHES COURTES VIRALTO SOLO BLANC & NOIR',
        'Description MAILLOT DE FOOTBALL MANCHES COURTES VIRALTO SOLO BLANC & NOIR',
        12.00,
        0,
        'maillot-de-football-manches-courtes-viralto-solo-blanc-and-noir'
    ),
(
        000000000010,
        3,
        'Veste de football imperméable T100 adulte Bleu',
        'Description Veste de football imperméable T100 adulte Bleu',
        20.00,
        0,
        'veste-de-football-impermeable-t100-adulte-bleu'
    ),
(
        000000000011,
        4,
        'Vélo VTT électrique semi-rigide 27,5 pouces - E-ST 500 NOIR',
        'Ceci est la description du Vélo VTT électrique semi-rigide 27,5 pouces - E-ST 500 NOIR',
        1499.00,
        0,
        'velo-vtt-electrique-semi-rigide-27-5-pouces-e-st-500-noir'
    ),
(
        000000000012,
        5,
        'BANDEAU DE SPORT ADIDAS NOIR',
        'Ceci est la description du BANDEAU DE SPORT ADIDAS NOIR',
        13.00,
        0,
        'bandeau-de-sport-adidas-noir'
    ),
(
        000000000013,
        1,
        'Ballon de Rugby Gilbert Officiel Match Sirius Equipe de France',
        'Description Ballon de Rugby Gilbert Officiel Match Sirius Equipe de France',
        173.00,
        0,
        'ballon-de-rugby-gilbert-officiel-match-sirius-equipe-de-france'
    ),
(
        000000000014,
        2,
        'Gants de boxe MMA AVEC POUCE NOIR',
        'Description de Gants de boxe MMA AVEC POUCE NOIR',
        41.50,
        0,
        'gants-de-box-mma-avec-pouce-noir'
    ),
(
        000000000015,
        3,
        'Filet Basic goal Taille S',
        'Description Filet Basic goal Taille S',
        5.00,
        0,
        'filet-basic-goal-taille-s'
    ),
(
        000000000016,
        4,
        'VÉLO VTT RANDONNEE ST 120 NOIR BLEU 27,5 POUCES',
        'Ceci est la description du VÉLO VTT RANDONNEE ST 120 NOIR BLEU 27,5 pouces',
        339.00,
        0,
        'velo-vtt-randonnee-st-120-noir-bleu-27-5-pouces'
    ),
(
        000000000017,
        4,
        'Kit de brosse pour entretien vélo x3',
        'Description Kit de brosse pour entretien vélo x3',
        26.90,
        0,
        'kit-de-brosse-pour-entretien-velo-x3'
    ),
(
        000000000018,
        3,
        'Hyperflex HN Gants De Gardien',
        'Ceci est la description des Hyperflex HN Gants De Gardien',
        99.99,
        0,
        'hyperflex-hn-gants-de-gardien'
    ),
(
        000000000019,
        4,
        'POMPE A PIED 500',
        'Description POMPE A PIED 500',
        20.00,
        0,
        'pompe-a-pied-500'
    ),
(
        000000000020,
        2,
        'Sac de frappe pied/poing 32 kg adulte',
        'Ceci est la description du Sac de frappe pied/poing 32 kg adulte',
        119.99,
        0,
        'sac-de-frappe-pied-point-32-kg-adulte'
    ),
(
        000000000021,
        1,
        'Maillot d\'entrainement de Rugby France -Tee-Shirt Training FFR Adulte Rouge',
        'Description Maillot d\'entrainement de Rugby France -Tee-Shirt Training FFR Adulte Rouge',
        55.00,
        0,
        'maillot-d-entrainement-de-rugby-france-tee-shirt-training-ffr-adulte-rouge'
    );

/*!40000 ALTER TABLE `product` ENABLE KEYS */
;

UNLOCK TABLES;

--
-- Dumping data for table `product_img`
--
LOCK TABLES `product_img` WRITE;

/*!40000 ALTER TABLE `product_img` DISABLE KEYS */
;

INSERT INTO
    `product_img`
VALUES
    (
        'pantalon-de-gardien-de-but-enfant-f-100-noir-1.jpg',
        000000000001
    ),
(
        'pantalon-de-gardien-de-but-enfant-f-100-noir-2.jpg',
        000000000001
    ),
(
        'pantalon-de-gardien-de-but-enfant-f-100-noir-3.jpg',
        000000000001
    ),
('balle-de-tennis-tb16060-jaune.jpg', 000000000002),
(
        'But de football SG 500 taille M Bleu orange.jpg',
        000000000003
    ),
(
        'sac-a-dos-tennis-artengo-xl-pro-38l-noir-blanc-rouge.jpg',
        000000000004
    ),
('raquette-de-tennis-bleu-jaune.jpg', 000000000005),
(
        'Vermont_Colt_Senior_Tennis_Racket.jpg',
        000000000005
    ),
(
        'Chaussures de football FUTURE ULTIMATE ENERGY FG.jpg',
        000000000006
    ),
(
        'puma-future-ultimate-energy-fg-ag-107546-ultra-blue-yellow-alert-luminous-pink-2.jpg',
        000000000006
    ),
(
        'puma-future-ultimate-energy-fg-ag-107546-ultra-blue-yellow-alert-luminous-pink.jpg',
        000000000006
    ),
(
        'ballon-de-football-molten-uefa-europa-league-match-officiel-20232024.jpg',
        000000000007
    ),
(
        'ballon-futsal-match-ball-coupe-du-monde-2018-repli.webp',
        000000000008
    ),
(
        'maillot-de-football-manches-courtes-viralto-solo-blanc-and-noir.jpg',
        000000000009
    ),
(
        'veste-de-football-impermeable-t100-adulte-bleu-1.jpg',
        000000000010
    ),
(
        'veste-de-football-impermeable-t100-adulte-bleu-2.jpg',
        000000000010
    ),
(
        'veste-de-football-impermeable-t100-adulte-bleu-3.jpg',
        000000000010
    ),
(
        'veste-de-football-impermeable-t100-adulte-bleu-4.jpg',
        000000000010
    ),
(
        'veste-de-football-impermeable-t100-adulte-bleu-5.jpg',
        000000000010
    ),
(
        'velo-vtt-electrique-semi-rigide-275-e-st-500-noir-1.jpg',
        000000000011
    ),
(
        'velo-vtt-electrique-semi-rigide-275-e-st-500-noir-2.jpg',
        000000000011
    ),
(
        'velo-vtt-electrique-semi-rigide-275-e-st-500-noir-3.jpg',
        000000000011
    ),
(
        'velo-vtt-electrique-semi-rigide-275-e-st-500-noir-4.jpg',
        000000000011
    ),
(
        'velo-vtt-electrique-semi-rigide-275-e-st-500-noir-5.jpg',
        000000000011
    ),
('bandeau-de-sport-adidas-noir.jpg', 000000000012),
(
        '0ballon-de-rugby-gilbert-officiel-match-sirius-equipe-de-france.jpg',
        000000000013
    ),
(
        'ballon-rugby-replica-france-gilbert-t5.webp',
        000000000013
    ),
(
        'k$22351017e15577a44ce767619f1203f7.png',
        000000000013
    ),
(
        'k$640af436b09689a81b61b8f66c67a3f8.png',
        000000000013
    ),
(
        'k$eeabce5f4ff494f1a31ceca4501e76f3.png',
        000000000013
    ),
('gants-box-mma-pouce-noir.png', 000000000014),
(
        'gants-mma-d-entrainement-avec-pouce-metal-boxe.jpg',
        000000000014
    ),
('filet-basic-goal-taille-s.jpg', 000000000015),
(
        'velo-vtt-randonnee-st-120-noir-bleu-275.jpg',
        000000000016
    ),
(
        'kit-de-brosse-pour-entretien-velo-x3.jpg',
        000000000017
    ),
(
        '101128601_palm_png4qgz0wGaFdV4g_600x600.jpg',
        000000000018
    ),
('hyperflex-hn-gants-de-gardien.jpg', 000000000018),
(
        'Z101128601_D2_jpg9tNEFvpwAP6Ja_600x600.jpg',
        000000000018
    ),
('pompe-a-pied-500.jpg', 000000000019),
('Punhos-32-kg-Adulto.jpg', 000000000020),
(
        'sac-de-frappe-piedpoing-32-kg-adulte.jpg',
        000000000020
    ),
(
        'maillot-dentrainement-de-rugby-france-tee-shirt-training-ffr-adulte-rouge-1.jpg',
        000000000021
    ),
(
        'maillot-dentrainement-de-rugby-france-tee-shirt-training-ffr-adulte-rouge-2.jpg',
        000000000021
    ),
(
        'maillot-dentrainement-de-rugby-france-tee-shirt-training-ffr-adulte-rouge-3.jpg',
        000000000021
    );

/*!40000 ALTER TABLE `product_img` ENABLE KEYS */
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
    (1, 000000000002, 41),
(1, 000000000003, 6),
(1, 000000000005, 5),
(1, 000000000006, 44),
(1, 000000000007, 50),
(1, 000000000008, 124),
(1, 000000000011, 4),
(1, 000000000013, 3),
(1, 000000000016, 19),
(1, 000000000018, 65),
(1, 000000000020, 12),
(2, 000000000003, 7),
(2, 000000000006, 41),
(2, 000000000007, 6),
(2, 000000000008, 133),
(2, 000000000009, 26),
(2, 000000000011, 1),
(2, 000000000016, 12),
(2, 000000000020, 9),
(3, 000000000002, 56),
(3, 000000000005, 56),
(3, 000000000006, 34),
(3, 000000000007, 77),
(3, 000000000008, 99),
(3, 000000000010, 154),
(3, 000000000011, 3),
(3, 000000000016, 33),
(3, 000000000017, 9),
(3, 000000000020, 5),
(4, 000000000003, 22),
(4, 000000000006, 22),
(4, 000000000007, 32),
(4, 000000000008, 88),
(4, 000000000017, 88),
(4, 000000000018, 19),
(5, 000000000002, 13),
(5, 000000000003, 12),
(5, 000000000007, 142),
(5, 000000000008, 121),
(5, 000000000010, 99),
(5, 000000000016, 15),
(5, 000000000018, 42),
(5, 000000000020, 32),
(6, 000000000005, 32),
(6, 000000000007, 1),
(6, 000000000008, 54),
(6, 000000000010, 112),
(6, 000000000011, 16),
(6, 000000000017, 77),
(6, 000000000018, 23),
(6, 000000000020, 32);

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
    (1, '2 Alee Des Usines', '59300', 'Valenciennes'),
(2, '17 Vge Montana', '59000', 'Lille'),
(3, '33 Alee De La Moisson', '57000', 'Metz'),
(4, '26 Rue De Neudorf', '62218', 'Lens'),
(5, '34 Cami Sant Miquel De Forques', '62000', 'Arras'),
(6, '22 Rue Leon Blum', '59140', 'Dunkerque');

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
        1,
        'user1@gmail.com',
        '[]',
        'NomUser1',
        'PrenomUser1',
        '561-962-2040',
        '2414 Pleasant Hill Road',
        '33432',
        'Boca Raton',
        '1993/05/26',
        2,
        1
    ),
(
        2,
        'user2@gmail.com',
        '[]',
        'NomUser2',
        'PrenomUser2',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
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

-- Dump completed on 2023-11-02 17:38:37