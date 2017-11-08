-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: e_learning
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_description` varchar(100) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'Answered a question',1,'0000-00-00 00:00:00','2017-10-28 19:14:38'),(2,'Answered a question1',2,'0000-00-00 00:00:00','2017-10-28 19:15:45'),(3,'Posted a question',1,'0000-00-00 00:00:00','2017-10-28 19:17:35'),(4,'Posted a question',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'Answered a question',3,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'Answered a question',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,'updated',1,'2017-10-28 15:38:28','2017-10-28 15:52:33'),(8,'erikson',4,'2017-10-28 16:51:32','2017-10-28 19:12:21'),(9,'erikson',1,'2017-10-28 16:52:42','2017-10-28 16:52:42'),(10,'noskire1111',2,'2017-10-28 17:02:21','2017-10-28 19:14:04'),(11,'adf',2,'2017-10-28 17:18:19','2017-10-28 17:18:19'),(12,'adf',2,'2017-10-28 17:18:54','2017-10-28 17:18:54'),(13,'asdf',3,'2017-10-28 19:28:04','2017-10-28 19:28:04'),(14,'asdf',1,'2017-10-28 19:28:17','2017-10-28 19:28:17'),(15,'noskiressss',2,'2017-10-28 19:29:37','2017-10-28 19:29:37'),(16,'noskiressss',2,'2017-10-28 19:29:55','2017-10-28 19:29:55'),(17,'noskiressss',2,'2017-10-28 19:30:14','2017-10-28 19:30:14'),(18,'noskiressss',2,'2017-10-28 19:31:32','2017-10-28 19:31:32'),(19,'aaannn',3,'2017-10-28 19:32:31','2017-10-28 19:32:31'),(20,'erikson b syonet',3,'2017-10-28 19:32:45','2017-10-28 19:32:45'),(21,'nothing nothing',2,'2017-10-29 11:52:49','2017-10-29 11:53:38');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-09  1:35:20
