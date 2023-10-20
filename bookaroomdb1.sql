-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: bookaroomdb
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Current Database: `bookaroomdb`
--



--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking` (
  `bookingID` int NOT NULL AUTO_INCREMENT,
  `roomID` int NOT NULL,
  `customerID` int NOT NULL,
  `checkindate` date NOT NULL,
  `checkoutdate` date NOT NULL,
  `contactnumber` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` double DEFAULT NULL,
  `review` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `booking_extra` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`bookingID`),
  KEY `FK_customerID` (`customerID`),
  KEY `FK_roomID` (`roomID`),
  CONSTRAINT `FK_customerID` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_roomID` FOREIGN KEY (`roomID`) REFERENCES `room` (`roomID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,24,19,'2022-07-08','2022-07-09','(234)457 8770',222,NULL,'no'),(3,18,4,'2022-06-29','2022-06-30','(234)184 1250',300,'good',NULL),(4,26,10,'2022-07-01','2022-07-03','(234)197 5479',320,NULL,NULL),(5,28,20,'2022-07-15','2022-07-30','234-124-2550',250,'','new tv'),(15,15,1,'2022-07-16','2022-07-20','987-987-6541',NULL,'nice','a'),(18,15,1,'2022-07-08','2022-07-09','987-987-9632',NULL,NULL,'spa room'),(19,15,1,'2022-07-08','2022-07-09','987-986-9632',NULL,NULL,'spa room'),(20,15,1,'2022-07-08','2022-07-09','987-963-1234',NULL,NULL,'pet'),(21,15,1,'2022-07-30','2022-07-31','123-123-1234',NULL,NULL,'na'),(22,19,1,'2022-07-29','2022-07-30','123-123-1234',NULL,NULL,'spa'),(23,19,1,'2022-07-29','2022-07-30','123-123-1234',NULL,NULL,'spa'),(24,19,1,'2022-07-29','2022-07-30','123-123-1234',NULL,NULL,'spa');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `customerID` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'Garrison','Jordan','sit.amet.ornare@nequesedsem.edu',''),(2,'Desiree','Collier Mess','Maecenas@non.co.uk',''),(3,'Irene','Walker','id.erat.Etiam@id.org',''),(4,'Forrest','Baldwin','eget.nisi.dictum@a.com',''),(5,'Beverly','Sellers','ultricies.sem@pharetraQuisqueac.co.uk',''),(6,'Glenna','Kinney','dolor@orcilobortisaugue.org',''),(7,'Montana','Gallagher','sapien.cursus@ultriciesdignissimlacus.edu',''),(8,'Harlan','Lara','Duis@aliquetodioEtiam.edu',''),(9,'Benjamin','King','mollis@Nullainterdum.org',''),(10,'Rajah','Olsen','Vestibulum.ut.eros@nequevenenatislacus.ca',''),(11,'Castor','Kelly','Fusce.feugiat.Lorem@porta.co.uk',''),(12,'Omar','Oconnor','eu.turpis@auctorvelit.co.uk',''),(13,'Porter','Leonard','dui.Fusce@accumsanlaoreet.net',''),(14,'Buckminster','Gaines','convallis.convallis.dolor@ligula.co.uk',''),(15,'Hunter','Rodriquez','ridiculus.mus.Donec@est.co.uk',''),(16,'Zahir','Harper','vel@estNunc.com',''),(17,'Sopoline','Warner','vestibulum.nec.euismod@sitamet.co.uk',''),(18,'Burton','Parrish','consequat.nec.mollis@nequenonquam.org',''),(19,'Abbot','Rose','non@et.ca',''),(20,'Barry','Burks','risus@libero.net',''),(21,'nee','lam','ee@gmail.com','hhhjcbcgg'),(23,'nabin','pradhan','nabinpradhan@gmail.com','nabinpradhan'),(24,'neel','pari','neelpari@gmail.com','neelpari'),(25,'neelam','ranjit','neelamranjit@gmail.com','neelamranjit');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room` (
  `roomID` int NOT NULL AUTO_INCREMENT,
  `roomname` varchar(60) NOT NULL,
  `description` varchar(60) NOT NULL,
  `roomtype` varchar(50) NOT NULL,
  `beds` int NOT NULL,
  PRIMARY KEY (`roomID`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (15,'Kellie','good beds','D',2),(16,'Herman','New beds &amp; tv and new painting','D',5),(17,'Scarlett','new carpet','S',3),(18,'Jelani','Lorem ipsum dolor sit amet','S',2),(19,'Sonya','Lorem ipsum dolor sit amet','S',5),(20,'Miranda','Lorem ipsum dolor sit amet','S',4),(21,'Helen','Lorem ipsum dolor sit amet','S',2),(22,'Octavia','new shower','D',2),(23,'Gretchen','Lorem ipsum dolor sit','D',3),(24,'Bernard','Lorem ipsum dolor sit amet','S',5),(25,'Dacey','Lorem ipsum dolor sit amet','D',2),(26,'Preston','Lorem','D',2),(27,'Dane','Lorem ipsum dolor','S',4),(28,'Cole','Lorem ipsum dolor sit amet','S',1);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-08 15:31:35
