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
-- Table structure for table `answer_multiple_choices`
--

DROP TABLE IF EXISTS `answer_multiple_choices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answer_multiple_choices` (
  `answer_choices_id` int(11) NOT NULL AUTO_INCREMENT,
  `answer_id` varchar(10) NOT NULL,
  `answer` varchar(150) NOT NULL,
  `points` int(3) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`answer_choices_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer_multiple_choices`
--

LOCK TABLES `answer_multiple_choices` WRITE;
/*!40000 ALTER TABLE `answer_multiple_choices` DISABLE KEYS */;
INSERT INTO `answer_multiple_choices` VALUES (1,'Q0103-001','4',0,NULL,NULL),(2,'Q0103-001','2',0,NULL,NULL),(4,'14','a',NULL,'2017-11-03 15:37:18','2017-11-03 15:37:18'),(5,'15','a',NULL,'2017-11-03 15:40:26','2017-11-03 15:40:26'),(6,'16','a',NULL,'2017-11-03 15:41:52','2017-11-03 15:41:52'),(7,'17','a',NULL,'2017-11-03 15:41:53','2017-11-03 15:41:53'),(8,'18','a',NULL,'2017-11-03 15:50:05','2017-11-03 15:50:05'),(9,'19','a',NULL,'2017-11-03 15:53:36','2017-11-03 15:53:36'),(10,'20','b',NULL,'2017-11-03 15:56:25','2017-11-03 15:56:25'),(11,'21','b',NULL,'2017-11-03 15:56:46','2017-11-03 15:56:46'),(12,'22','a',NULL,'2017-11-03 15:57:54','2017-11-03 15:57:54'),(13,'23','a',NULL,'2017-11-03 15:58:11','2017-11-03 15:58:11'),(14,'24','a',NULL,'2017-11-03 15:58:21','2017-11-03 15:58:21'),(15,'25','b',NULL,'2017-11-03 16:49:17','2017-11-03 16:49:17'),(16,'26','b',NULL,'2017-11-03 16:52:53','2017-11-03 16:52:53'),(17,'27','d',NULL,'2017-11-03 23:38:57','2017-11-03 23:38:57'),(18,'28','d',NULL,'2017-11-03 23:39:00','2017-11-03 23:39:00'),(19,'29','d',NULL,'2017-11-06 23:14:35','2017-11-06 23:14:35');
/*!40000 ALTER TABLE `answer_multiple_choices` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-09  1:35:21
