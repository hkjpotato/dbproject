-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: cs4400_group_ta
-- ------------------------------------------------------
-- Server version	5.1.73

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complaint` (
  `rid` int(9) NOT NULL DEFAULT '0',
  `phone` char(10) NOT NULL DEFAULT '',
  `cdate` date NOT NULL DEFAULT '0000-00-00',
  `description` varchar(80) NOT NULL,
  PRIMARY KEY (`rid`,`phone`,`cdate`),
  KEY `phone` (`phone`),
  CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`phone`) REFERENCES `customer` (`phone`),
  CONSTRAINT `complaint_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `restaurant` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaint`
--

LOCK TABLES `complaint` WRITE;
/*!40000 ALTER TABLE `complaint` DISABLE KEYS */;
INSERT INTO `complaint` VALUES (11,'1523779738','2015-09-20','I saw a mouse run into kitchen'),(14,'1574274261','2015-01-02','I saw a cockroach run into kitchen'),(16,'1998181725','2015-03-08','Food taste like shit and spoiled'),(16,'4455946585','2015-02-18','Food smells like DONKEY\'S BUTT and was spoiled'),(19,'8171379682','2015-06-01','Waitress went apeshit when I said sausage tastes bad');
/*!40000 ALTER TABLE `complaint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contains`
--

DROP TABLE IF EXISTS `contains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contains` (
  `itemnum` int(2) NOT NULL DEFAULT '0',
  `rid` int(9) NOT NULL DEFAULT '0',
  `idate` date NOT NULL DEFAULT '0000-00-00',
  `score` int(2) NOT NULL,
  PRIMARY KEY (`itemnum`,`rid`,`idate`),
  KEY `rid` (`rid`,`idate`),
  CONSTRAINT `contains_ibfk_1` FOREIGN KEY (`rid`, `idate`) REFERENCES `inspection` (`rid`, `idate`),
  CONSTRAINT `contains_ibfk_2` FOREIGN KEY (`itemnum`) REFERENCES `item` (`itemnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contains`
--

LOCK TABLES `contains` WRITE;
/*!40000 ALTER TABLE `contains` DISABLE KEYS */;
INSERT INTO `contains` VALUES (1,1,'2015-01-18',9),(1,2,'2015-02-25',9),(1,3,'2015-03-14',9),(1,4,'2015-04-13',9),(1,5,'2015-05-05',9),(1,6,'2015-06-09',9),(1,7,'2015-07-03',8),(1,8,'2015-08-12',8),(1,9,'2015-09-15',9),(1,10,'2015-10-10',9),(1,11,'2015-10-03',4),(1,11,'2015-11-03',9),(1,12,'2015-12-11',9),(1,13,'2015-01-04',9),(1,14,'2015-01-27',4),(1,14,'2015-02-27',9),(1,15,'2015-03-27',8),(1,16,'2015-03-18',5),(1,16,'2015-04-18',8),(1,17,'2015-05-18',9),(1,18,'2015-05-22',3),(1,18,'2015-06-22',8),(1,19,'2015-06-18',2),(1,19,'2015-07-18',9),(1,20,'2015-08-04',9),(2,1,'2015-01-18',9),(2,2,'2015-02-25',8),(2,3,'2015-03-14',9),(2,4,'2015-04-13',9),(2,5,'2015-05-05',8),(2,6,'2015-06-09',9),(2,7,'2015-07-03',8),(2,8,'2015-08-12',9),(2,9,'2015-09-15',9),(2,10,'2015-10-10',8),(2,11,'2015-10-03',2),(2,11,'2015-11-03',9),(2,12,'2015-12-11',9),(2,13,'2015-01-04',9),(2,14,'2015-01-27',8),(2,14,'2015-02-27',9),(2,15,'2015-03-27',8),(2,16,'2015-03-18',6),(2,16,'2015-04-18',8),(2,17,'2015-05-18',9),(2,18,'2015-05-22',8),(2,18,'2015-06-22',9),(2,19,'2015-06-18',3),(2,19,'2015-07-18',9),(2,20,'2015-08-04',9),(3,1,'2015-01-18',8),(3,2,'2015-02-25',9),(3,3,'2015-03-14',9),(3,4,'2015-04-13',9),(3,5,'2015-05-05',8),(3,6,'2015-06-09',9),(3,7,'2015-07-03',9),(3,8,'2015-08-12',8),(3,9,'2015-09-15',8),(3,10,'2015-10-10',9),(3,11,'2015-10-03',4),(3,11,'2015-11-03',9),(3,12,'2015-12-11',9),(3,13,'2015-01-04',9),(3,14,'2015-01-27',7),(3,14,'2015-02-27',9),(3,15,'2015-03-27',8),(3,16,'2015-03-18',7),(3,16,'2015-04-18',9),(3,17,'2015-05-18',9),(3,18,'2015-05-22',6),(3,18,'2015-06-22',9),(3,19,'2015-06-18',1),(3,19,'2015-07-18',9),(3,20,'2015-08-04',9),(4,1,'2015-01-18',8),(4,2,'2015-02-25',8),(4,3,'2015-03-14',9),(4,4,'2015-04-13',8),(4,5,'2015-05-05',8),(4,6,'2015-06-09',9),(4,7,'2015-07-03',9),(4,8,'2015-08-12',8),(4,9,'2015-09-15',9),(4,10,'2015-10-10',9),(4,11,'2015-10-03',3),(4,11,'2015-11-03',9),(4,12,'2015-12-11',9),(4,13,'2015-01-04',8),(4,14,'2015-01-27',4),(4,14,'2015-02-27',8),(4,15,'2015-03-27',8),(4,16,'2015-03-18',9),(4,16,'2015-04-18',9),(4,17,'2015-05-18',9),(4,18,'2015-05-22',8),(4,18,'2015-06-22',8),(4,19,'2015-06-18',0),(4,19,'2015-07-18',9),(4,20,'2015-08-04',9),(5,1,'2015-01-18',8),(5,2,'2015-02-25',9),(5,3,'2015-03-14',9),(5,4,'2015-04-13',9),(5,5,'2015-05-05',9),(5,6,'2015-06-09',9),(5,7,'2015-07-03',9),(5,8,'2015-08-12',9),(5,9,'2015-09-15',9),(5,10,'2015-10-10',9),(5,11,'2015-10-03',9),(5,11,'2015-11-03',9),(5,12,'2015-12-11',9),(5,13,'2015-01-04',8),(5,14,'2015-01-27',3),(5,14,'2015-02-27',8),(5,15,'2015-03-27',8),(5,16,'2015-03-18',9),(5,16,'2015-04-18',9),(5,17,'2015-05-18',9),(5,18,'2015-05-22',5),(5,18,'2015-06-22',8),(5,19,'2015-06-18',7),(5,19,'2015-07-18',9),(5,20,'2015-08-04',9),(6,1,'2015-01-18',8),(6,2,'2015-02-25',8),(6,3,'2015-03-14',9),(6,4,'2015-04-13',9),(6,5,'2015-05-05',9),(6,6,'2015-06-09',9),(6,7,'2015-07-03',9),(6,8,'2015-08-12',8),(6,9,'2015-09-15',9),(6,10,'2015-10-10',8),(6,11,'2015-10-03',4),(6,11,'2015-11-03',9),(6,12,'2015-12-11',9),(6,13,'2015-01-04',9),(6,14,'2015-01-27',2),(6,14,'2015-02-27',8),(6,15,'2015-03-27',8),(6,16,'2015-03-18',8),(6,16,'2015-04-18',8),(6,17,'2015-05-18',9),(6,18,'2015-05-22',9),(6,18,'2015-06-22',8),(6,19,'2015-06-18',1),(6,19,'2015-07-18',9),(6,20,'2015-08-04',9),(7,1,'2015-01-18',9),(7,2,'2015-02-25',9),(7,3,'2015-03-14',9),(7,4,'2015-04-13',9),(7,5,'2015-05-05',9),(7,6,'2015-06-09',9),(7,7,'2015-07-03',9),(7,8,'2015-08-12',9),(7,9,'2015-09-15',8),(7,10,'2015-10-10',8),(7,11,'2015-10-03',2),(7,11,'2015-11-03',9),(7,12,'2015-12-11',9),(7,13,'2015-01-04',8),(7,14,'2015-01-27',5),(7,14,'2015-02-27',9),(7,15,'2015-03-27',8),(7,16,'2015-03-18',3),(7,16,'2015-04-18',9),(7,17,'2015-05-18',9),(7,18,'2015-05-22',4),(7,18,'2015-06-22',8),(7,19,'2015-06-18',7),(7,19,'2015-07-18',9),(7,20,'2015-08-04',8),(8,1,'2015-01-18',9),(8,2,'2015-02-25',8),(8,3,'2015-03-14',9),(8,4,'2015-04-13',8),(8,5,'2015-05-05',9),(8,6,'2015-06-09',9),(8,7,'2015-07-03',8),(8,8,'2015-08-12',8),(8,9,'2015-09-15',8),(8,10,'2015-10-10',9),(8,11,'2015-10-03',4),(8,11,'2015-11-03',9),(8,12,'2015-12-11',9),(8,13,'2015-01-04',8),(8,14,'2015-01-27',0),(8,14,'2015-02-27',8),(8,15,'2015-03-27',8),(8,16,'2015-03-18',0),(8,16,'2015-04-18',8),(8,17,'2015-05-18',9),(8,18,'2015-05-22',5),(8,18,'2015-06-22',8),(8,19,'2015-06-18',1),(8,19,'2015-07-18',9),(8,20,'2015-08-04',8),(9,1,'2015-01-18',3),(9,2,'2015-02-25',3),(9,3,'2015-03-14',3),(9,4,'2015-04-13',4),(9,5,'2015-05-05',4),(9,6,'2015-06-09',4),(9,7,'2015-07-03',2),(9,8,'2015-08-12',3),(9,9,'2015-09-15',4),(9,10,'2015-10-10',3),(9,11,'2015-10-03',1),(9,11,'2015-11-03',4),(9,12,'2015-12-11',2),(9,13,'2015-01-04',2),(9,14,'2015-01-27',0),(9,14,'2015-02-27',2),(9,15,'2015-03-27',3),(9,16,'2015-03-18',0),(9,16,'2015-04-18',3),(9,17,'2015-05-18',2),(9,18,'2015-05-22',3),(9,18,'2015-06-22',2),(9,19,'2015-06-18',1),(9,19,'2015-07-18',4),(9,20,'2015-08-04',3),(10,1,'2015-01-18',4),(10,2,'2015-02-25',2),(10,3,'2015-03-14',4),(10,4,'2015-04-13',3),(10,5,'2015-05-05',4),(10,6,'2015-06-09',2),(10,7,'2015-07-03',2),(10,8,'2015-08-12',3),(10,9,'2015-09-15',3),(10,10,'2015-10-10',4),(10,11,'2015-10-03',1),(10,11,'2015-11-03',4),(10,12,'2015-12-11',3),(10,13,'2015-01-04',4),(10,14,'2015-01-27',4),(10,14,'2015-02-27',3),(10,15,'2015-03-27',2),(10,16,'2015-03-18',0),(10,16,'2015-04-18',3),(10,17,'2015-05-18',3),(10,18,'2015-05-22',3),(10,18,'2015-06-22',2),(10,19,'2015-06-18',4),(10,19,'2015-07-18',4),(10,20,'2015-08-04',3),(11,1,'2015-01-18',3),(11,2,'2015-02-25',2),(11,3,'2015-03-14',4),(11,4,'2015-04-13',2),(11,5,'2015-05-05',4),(11,6,'2015-06-09',3),(11,7,'2015-07-03',2),(11,8,'2015-08-12',2),(11,9,'2015-09-15',4),(11,10,'2015-10-10',3),(11,11,'2015-10-03',4),(11,11,'2015-11-03',4),(11,12,'2015-12-11',2),(11,13,'2015-01-04',4),(11,14,'2015-01-27',1),(11,14,'2015-02-27',3),(11,15,'2015-03-27',3),(11,16,'2015-03-18',0),(11,16,'2015-04-18',4),(11,17,'2015-05-18',4),(11,18,'2015-05-22',0),(11,18,'2015-06-22',1),(11,19,'2015-06-18',1),(11,19,'2015-07-18',4),(11,20,'2015-08-04',4),(12,1,'2015-01-18',3),(12,2,'2015-02-25',3),(12,3,'2015-03-14',3),(12,4,'2015-04-13',2),(12,5,'2015-05-05',3),(12,6,'2015-06-09',3),(12,7,'2015-07-03',2),(12,8,'2015-08-12',3),(12,9,'2015-09-15',3),(12,10,'2015-10-10',4),(12,11,'2015-10-03',0),(12,11,'2015-11-03',4),(12,12,'2015-12-11',3),(12,13,'2015-01-04',4),(12,14,'2015-01-27',4),(12,14,'2015-02-27',2),(12,15,'2015-03-27',2),(12,16,'2015-03-18',0),(12,16,'2015-04-18',3),(12,17,'2015-05-18',2),(12,18,'2015-05-22',4),(12,18,'2015-06-22',1),(12,19,'2015-06-18',0),(12,19,'2015-07-18',3),(12,20,'2015-08-04',3),(13,1,'2015-01-18',4),(13,2,'2015-02-25',1),(13,3,'2015-03-14',3),(13,4,'2015-04-13',1),(13,5,'2015-05-05',3),(13,6,'2015-06-09',4),(13,7,'2015-07-03',1),(13,8,'2015-08-12',2),(13,9,'2015-09-15',2),(13,10,'2015-10-10',3),(13,11,'2015-10-03',1),(13,11,'2015-11-03',3),(13,12,'2015-12-11',3),(13,13,'2015-01-04',2),(13,14,'2015-01-27',2),(13,14,'2015-02-27',3),(13,15,'2015-03-27',1),(13,16,'2015-03-18',0),(13,16,'2015-04-18',3),(13,17,'2015-05-18',3),(13,18,'2015-05-22',1),(13,18,'2015-06-22',1),(13,19,'2015-06-18',3),(13,19,'2015-07-18',3),(13,20,'2015-08-04',3),(14,1,'2015-01-18',4),(14,2,'2015-02-25',1),(14,3,'2015-03-14',4),(14,4,'2015-04-13',1),(14,5,'2015-05-05',2),(14,6,'2015-06-09',2),(14,7,'2015-07-03',1),(14,8,'2015-08-12',1),(14,9,'2015-09-15',2),(14,10,'2015-10-10',3),(14,11,'2015-10-03',1),(14,11,'2015-11-03',4),(14,12,'2015-12-11',3),(14,13,'2015-01-04',4),(14,14,'2015-01-27',2),(14,14,'2015-02-27',1),(14,15,'2015-03-27',1),(14,16,'2015-03-18',0),(14,16,'2015-04-18',2),(14,17,'2015-05-18',2),(14,18,'2015-05-22',0),(14,18,'2015-06-22',1),(14,19,'2015-06-18',0),(14,19,'2015-07-18',4),(14,20,'2015-08-04',2),(15,1,'2015-01-18',3),(15,2,'2015-02-25',1),(15,3,'2015-03-14',3),(15,4,'2015-04-13',1),(15,5,'2015-05-05',4),(15,6,'2015-06-09',3),(15,7,'2015-07-03',1),(15,8,'2015-08-12',1),(15,9,'2015-09-15',3),(15,10,'2015-10-10',1),(15,11,'2015-10-03',0),(15,11,'2015-11-03',4),(15,12,'2015-12-11',4),(15,13,'2015-01-04',2),(15,14,'2015-01-27',3),(15,14,'2015-02-27',1),(15,15,'2015-03-27',1),(15,16,'2015-03-18',0),(15,16,'2015-04-18',1),(15,17,'2015-05-18',2),(15,18,'2015-05-22',0),(15,18,'2015-06-22',1),(15,19,'2015-06-18',1),(15,19,'2015-07-18',4),(15,20,'2015-08-04',1);
/*!40000 ALTER TABLE `contains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuisines`
--

DROP TABLE IF EXISTS `cuisines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuisines` (
  `cuisine` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`cuisine`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuisines`
--

LOCK TABLES `cuisines` WRITE;
/*!40000 ALTER TABLE `cuisines` DISABLE KEYS */;
INSERT INTO `cuisines` VALUES ('American'),('Chinese'),('French'),('Greek'),('Indian'),('Italian'),('Japanese'),('Korean'),('Mexican'),('Thai');
/*!40000 ALTER TABLE `cuisines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `phone` char(10) NOT NULL DEFAULT '',
  `firstname` varchar(15) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES ('1523779738','Tao','Zhu'),('1574274261','Qingyang','Wang'),('1998181725','Lucy','Liu'),('4455946585','Jack','Li'),('8171379682','Chienan','Lai');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `healthpermit`
--

DROP TABLE IF EXISTS `healthpermit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `healthpermit` (
  `hpid` int(9) NOT NULL DEFAULT '0',
  `expirationdate` date NOT NULL,
  `rid` int(9) NOT NULL,
  PRIMARY KEY (`hpid`),
  UNIQUE KEY `rid` (`rid`),
  CONSTRAINT `healthpermit_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `restaurant` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `healthpermit`
--

LOCK TABLES `healthpermit` WRITE;
/*!40000 ALTER TABLE `healthpermit` DISABLE KEYS */;
INSERT INTO `healthpermit` VALUES (1,'2016-01-10',1),(2,'2016-02-10',2),(3,'2016-03-10',3),(4,'2016-04-10',4),(5,'2016-05-10',5),(6,'2016-06-10',6),(7,'2016-07-10',7),(8,'2016-08-10',8),(9,'2016-09-10',9),(10,'2016-10-10',10),(11,'2016-11-10',11),(12,'2016-12-10',12),(13,'2016-01-20',13),(14,'2016-02-20',14),(15,'2016-03-20',15),(16,'2016-04-20',16),(17,'2016-05-20',17),(18,'2016-06-20',18),(19,'2016-07-20',19),(20,'2016-08-20',20);
/*!40000 ALTER TABLE `healthpermit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `includes`
--

DROP TABLE IF EXISTS `includes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `includes` (
  `itemnum` int(2) NOT NULL DEFAULT '0',
  `rid` int(9) NOT NULL DEFAULT '0',
  `idate` date NOT NULL DEFAULT '0000-00-00',
  `comment` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`itemnum`,`rid`,`idate`),
  KEY `rid` (`rid`,`idate`),
  CONSTRAINT `includes_ibfk_1` FOREIGN KEY (`rid`, `idate`) REFERENCES `inspection` (`rid`, `idate`),
  CONSTRAINT `includes_ibfk_2` FOREIGN KEY (`itemnum`) REFERENCES `item` (`itemnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `includes`
--

LOCK TABLES `includes` WRITE;
/*!40000 ALTER TABLE `includes` DISABLE KEYS */;
INSERT INTO `includes` VALUES (3,11,'2015-10-03','Uncooked chicken was placed on the same surface as bread'),(3,14,'2015-01-27','Uncooked chicken was placed on the same surface as bread'),(3,16,'2015-03-18','Uncooked chicken was placed on the same surface as bread'),(3,18,'2015-05-22','Uncooked chicken was placed on the same surface as bread'),(3,19,'2015-06-18','Uncooked chicken was placed on the same surface as bread'),(5,11,'2015-10-03','Employees do not wash hands after restoom use'),(5,14,'2015-01-27','Employees do not wash hands after restoom use'),(5,16,'2015-03-18','Employees do not wash hands after restoom use'),(5,18,'2015-05-22','Employees do not wash hands after restoom use'),(5,19,'2015-06-18','Employees do not wash hands after restoom use'),(12,11,'2015-10-03','Toilet was not working in the bathroom'),(12,14,'2015-01-27','Toilet was not working in the bathroom'),(12,16,'2015-03-18','Toilet was not working in the bathroom'),(12,18,'2015-05-22','Toilet was not working in the bathroom'),(12,19,'2015-06-18','Toilet was not working in the bathroom'),(15,11,'2015-10-03','Napkin container was dirty'),(15,14,'2015-01-27','Napkin container was dirty'),(15,16,'2015-03-18','Napkin container was dirty'),(15,18,'2015-05-22','Napkin container was dirty'),(15,19,'2015-06-18','Napkin container was dirty');
/*!40000 ALTER TABLE `includes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inspection`
--

DROP TABLE IF EXISTS `inspection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inspection` (
  `rid` int(9) NOT NULL DEFAULT '0',
  `iid` int(9) DEFAULT NULL,
  `idate` date NOT NULL DEFAULT '0000-00-00',
  `totalscore` int(3) DEFAULT NULL,
  `passfail` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`rid`,`idate`),
  KEY `iid` (`iid`),
  CONSTRAINT `inspection_ibfk_1` FOREIGN KEY (`iid`) REFERENCES `inspector` (`iid`),
  CONSTRAINT `inspection_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `restaurant` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inspection`
--

LOCK TABLES `inspection` WRITE;
/*!40000 ALTER TABLE `inspection` DISABLE KEYS */;
INSERT INTO `inspection` VALUES (1,1,'2015-01-18',92,'PASS'),(2,2,'2015-02-25',81,'PASS'),(3,3,'2015-03-14',96,'PASS'),(4,4,'2015-04-13',84,'PASS'),(5,5,'2015-05-05',93,'PASS'),(6,1,'2015-06-09',93,'PASS'),(7,2,'2015-07-03',80,'PASS'),(8,3,'2015-08-12',82,'PASS'),(9,4,'2015-09-15',90,'PASS'),(10,5,'2015-10-10',90,'PASS'),(11,2,'2015-10-03',40,'FAIL'),(11,1,'2015-11-03',99,'PASS'),(12,2,'2015-12-11',92,'PASS'),(13,3,'2015-01-04',90,'PASS'),(14,5,'2015-01-27',49,'FAIL'),(14,4,'2015-02-27',83,'PASS'),(15,5,'2015-03-27',77,'PASS'),(16,3,'2015-03-18',47,'FAIL'),(16,1,'2015-04-18',87,'PASS'),(17,2,'2015-05-18',90,'PASS'),(18,4,'2015-05-22',59,'FAIL'),(18,3,'2015-06-22',75,'PASS'),(19,1,'2015-06-18',32,'FAIL'),(19,4,'2015-07-18',98,'PASS'),(20,5,'2015-08-04',89,'PASS');
/*!40000 ALTER TABLE `inspection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inspector`
--

DROP TABLE IF EXISTS `inspector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inspector` (
  `iid` int(9) NOT NULL DEFAULT '0',
  `phone` char(10) DEFAULT NULL,
  `username` char(10) DEFAULT NULL,
  `firstname` varchar(15) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`iid`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `username` (`username`),
  CONSTRAINT `inspector_ibfk_1` FOREIGN KEY (`username`) REFERENCES `registereduser` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inspector`
--

LOCK TABLES `inspector` WRITE;
/*!40000 ALTER TABLE `inspector` DISABLE KEYS */;
INSERT INTO `inspector` VALUES (1,'5467136945','edo','Ed','Omiecinski'),(2,'9741992475','snavathe','Sham','Navathe'),(3,'3419448256','jpark','Junhee','Park'),(4,'4942859283','klee','Kisung','Lee'),(5,'5959396483','kmal','Kunal','Malhotra');
/*!40000 ALTER TABLE `inspector` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `itemnum` int(2) NOT NULL DEFAULT '0',
  `perfectscore` int(1) NOT NULL,
  `description` varchar(150) NOT NULL,
  `critical` char(1) NOT NULL,
  PRIMARY KEY (`itemnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,9,'The food is in good condition and safe for human consumption','Y'),(2,9,'Potentially hazardous food is stored, prepared, displayed according to specified time and temperature requirements','Y'),(3,9,'Cross-contamination is prevented','Y'),(4,9,'Personnel with infections or communicable diseases are restricted from handling food','Y'),(5,9,'Personnel wash hands and use good hygienic practices','Y'),(6,9,'Food equipment and utensils are properly sanitized','Y'),(7,9,'Hot and cold water is from a safe and approved source','Y'),(8,9,'Insects, rodents and other animals are kept out of the restaurant','Y'),(9,4,'Proper equipment is used to maintain product temperature','N'),(10,4,'Gloves or utensils are used to minimize handling of food and ice','N'),(11,4,'Dishwashing facilities are properly  constructed and maintained','N'),(12,4,'Restrooms are clean and properly maintained','N'),(13,4,'Rubbish containers are covered and properly located','N'),(14,4,'Outside garbage disposal areas are enclosed and clean','N'),(15,4,'Non-food contact surfaces of equipment and utensils are clean and free of contaminants','N');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operatorowner`
--

DROP TABLE IF EXISTS `operatorowner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operatorowner` (
  `email` varchar(20) NOT NULL DEFAULT '',
  `phone` char(10) DEFAULT NULL,
  `username` char(10) DEFAULT NULL,
  `firstname` varchar(15) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `username` (`username`),
  CONSTRAINT `operatorowner_ibfk_1` FOREIGN KEY (`username`) REFERENCES `registereduser` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operatorowner`
--

LOCK TABLES `operatorowner` WRITE;
/*!40000 ALTER TABLE `operatorowner` DISABLE KEYS */;
INSERT INTO `operatorowner` VALUES ('chuney@gmail.com','7882950465','chuney','Chad','Huneycutt'),('cpu@gmail.com','4684358839','cpu','Calton','Pu'),('dmercer@gmail.com','5887690852','dmercer','David','Mercer'),('kschwan@gmail.com','5626152979','kschwan','Karsten','Schwan'),('lfort@gmail.com','4143128558','lfort','Lance','Fortnow'),('lhe@gmail.com','8998451514','lhe','Larry','He'),('lliu@gmail.com','1133923241','lliu','Ling','Liu'),('lmark@gmail.com','1671205190','lmark','Leo','Mark'),('ppatel@gmail.com','9949033018','ppatel','Prit','Patel'),('zgal@gmail.com','7691635581','zgal','Zvi','Galil');
/*!40000 ALTER TABLE `operatorowner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registereduser`
--

DROP TABLE IF EXISTS `registereduser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registereduser` (
  `username` char(10) NOT NULL DEFAULT '',
  `password` char(10) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registereduser`
--

LOCK TABLES `registereduser` WRITE;
/*!40000 ALTER TABLE `registereduser` DISABLE KEYS */;
INSERT INTO `registereduser` VALUES ('chuney','1234'),('cpu','1234'),('dmercer','1234'),('edo','1234'),('jpark','1234'),('klee','1234'),('kmal','1234'),('kschwan','1234'),('lfort','1234'),('lhe','1234'),('lliu','1234'),('lmark','1234'),('ppatel','1234'),('snavathe','1234'),('zgal','1234');
/*!40000 ALTER TABLE `registereduser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant` (
  `rid` int(9) NOT NULL DEFAULT '0',
  `phone` char(10) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `county` varchar(20) DEFAULT NULL,
  `street` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zipcode` int(5) DEFAULT NULL,
  `cuisine` varchar(20) DEFAULT NULL,
  `email` varchar(20) NOT NULL,
  PRIMARY KEY (`rid`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `street` (`street`,`city`,`state`,`zipcode`),
  KEY `cuisine` (`cuisine`),
  KEY `email` (`email`),
  CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`cuisine`) REFERENCES `cuisines` (`cuisine`),
  CONSTRAINT `restaurant_ibfk_2` FOREIGN KEY (`email`) REFERENCES `operatorowner` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant`
--

LOCK TABLES `restaurant` WRITE;
/*!40000 ALTER TABLE `restaurant` DISABLE KEYS */;
INSERT INTO `restaurant` VALUES (1,'4047242333','Antico Pizza','Fulton','1093 Hemphill Ave NW','Atlanta','GA',30318,'Italian','zgal@gmail.com'),(2,'4043650410','Bacchanalia','Fulton','1198 Howell Mill Rd','Atlanta','GA',30318,'American','lfort@gmail.com'),(3,'4043436783','The Sivas','Fulton','794 Juniper St NE','Atlanta','GA',30308,'Greek','lhe@gmail.com'),(4,'4044648571','Tabla','Fulton','77th 12th St NE','Atlanta','GA',30309,'Indian','ppatel@gmail.com'),(5,'4042616456','Bistro Niko','Fulton','3344 Peachtree Rd','Atlanta','GA',30326,'French','lmark@gmail.com'),(6,'4043151530','Little Bangkok','Fulton','2225 Cheshire Bridge','Atlanta','GA',30324,'Thai','cpu@gmail.com'),(7,'4042500515','Canton Cooks','Fulton','5984 Roswell Rd NE','Atlanta','GA',30328,'Chinese','lliu@gmail.com'),(8,'4048736582','Nakato','Fulton','1776 Cheshire Bridge','Atlanta','GA',30324,'Japanese','kschwan@gmail.com'),(9,'4042237500','Blossom Tree','Fulton','64 Peachtree St NW','Atlanta','GA',30303,'Korean','chuney@gmail.com'),(10,'4043529009','Nuevo Laredo Cantina','Fulton','1495 Chattahoochee A','Atlanta','GA',30318,'Mexican','dmercer@gmail.com'),(11,'4048151399','Bocado','Fulton','887 Howell Mill Rd','Atlanta','GA',30318,'American','ppatel@gmail.com'),(12,'4043479747','Rosebud','Fulton','1397 N Highland Ave','Atlanta','GA',30306,'American','ppatel@gmail.com'),(13,'7706122502','Heirloom','Cobb','2243 Akers Mill Rd','Atlanta','GA',30339,'American','lhe@gmail.com'),(14,'4042378888','China Moon','Cobb','2810 Paces Ferry Rd','Atlanta','GA',30339,'Chinese','cpu@gmail.com'),(15,'7709559444','House of Chan','Cobb','2469 Cobb Pkwy','Smyrna','GA',30080,'Chinese','cpu@gmail.com'),(16,'7704857753','I Love Sushi','Cobb','2086 Cobb Pkwy','Smyrna','GA',30080,'Japanese','lliu@gmail.com'),(17,'7704255050','Douceur de France','Cobb','277 S Marietta Pkwy','Marietta','GA',30064,'French','lmark@gmail.com'),(18,'7709567589','Swapna','Cobb','2655 Cobb Pkwy','Atlanta','GA',30339,'Indian','zgal@gmail.com'),(19,'7703190333','Mezza Luna','Cobb','1669 Spring Rd','Smyrna','GA',30080,'Italian','zgal@gmail.com'),(20,'4043528881','Hankook Taqueria','Fulton','1341 Collier Rd NW','Atlanta','GA',30318,'Korean','lfort@gmail.com');
/*!40000 ALTER TABLE `restaurant` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-14  1:36:33
