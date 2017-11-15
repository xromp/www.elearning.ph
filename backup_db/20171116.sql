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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `studID` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pword` varchar(60) NOT NULL,
  `accountTypeID` int(11) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,1,'e@e.com','$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy',2),(2,2,'r@r.com','$2y$10$6C6VlaYAEUk.gA.ceS5y6OhXyFKRtZ/lJWuXi8qSRVaCO/toEhVSi',2),(3,3,'c@c.com','$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu',1);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounttypes`
--

DROP TABLE IF EXISTS `accounttypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounttypes` (
  `accountTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `accountType` varchar(30) NOT NULL,
  PRIMARY KEY (`accountTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounttypes`
--

LOCK TABLES `accounttypes` WRITE;
/*!40000 ALTER TABLE `accounttypes` DISABLE KEYS */;
INSERT INTO `accounttypes` VALUES (1,'Student'),(2,'Admin');
/*!40000 ALTER TABLE `accounttypes` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_code` varchar(10) NOT NULL,
  `student_id` int(11) NOT NULL,
  `answer` varchar(1000) DEFAULT NULL,
  `points` varchar(45) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (38,'Q0102-0001',2,'d',NULL,3,'2017-11-16 01:19:11','2017-11-16 01:19:11');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `category_id` int(2) NOT NULL AUTO_INCREMENT,
  `category_code` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'ADAPTER','Adapter','2017-10-29 01:03:03','2017-10-29 01:03:03'),(2,'COMPOSITE','Composite','2017-10-29 01:03:03','2017-10-29 01:03:03'),(3,'DECORATOR','Decorator','2017-10-29 01:03:03','2017-10-29 01:03:03'),(4,'OBSERVER','Observer','2017-10-29 01:03:03','2017-10-29 01:03:03'),(5,'STRATEGY','Strategy','2017-10-29 01:03:03','2017-10-29 01:03:03'),(6,'ABSTRACT-FACTORY','Abstract-Factory','2017-10-29 01:03:03','2017-10-29 01:03:03'),(7,'FACTORY-METHOD','Factory-Method','2017-10-29 01:03:03','2017-10-29 01:03:03'),(8,'TEMPLATE-METHOD','Template-Method','2017-10-29 01:03:03','2017-10-29 01:03:03');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `multiple_choices`
--

DROP TABLE IF EXISTS `multiple_choices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multiple_choices` (
  `multiple_choice_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_code` varchar(10) NOT NULL,
  `choice_code` varchar(10) NOT NULL,
  `choice_desc` varchar(150) NOT NULL,
  `is_correct` int(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`multiple_choice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multiple_choices`
--

LOCK TABLES `multiple_choices` WRITE;
/*!40000 ALTER TABLE `multiple_choices` DISABLE KEYS */;
INSERT INTO `multiple_choices` VALUES (17,'Q0102-0001','a','a',0,'2017-11-16 00:12:37','2017-11-16 00:12:37'),(18,'Q0102-0001','b','b',1,'2017-11-16 00:12:37','2017-11-16 00:12:37'),(19,'Q0102-0001','c','c',0,'2017-11-16 00:12:37','2017-11-16 00:12:37'),(20,'Q0102-0001','d','d',0,'2017-11-16 00:12:37','2017-11-16 00:12:37');
/*!40000 ALTER TABLE `multiple_choices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `category_code` varchar(50) NOT NULL,
  `type_code` varchar(30) NOT NULL,
  `is_approved` int(1) DEFAULT NULL,
  `question_code` varchar(10) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (30,'<div><!--block-->asdf</div>','asdf','ADAPTER','MULTIPLE_CHOICE',1,'Q0102-0001',1,'2017-11-16 00:12:37','2017-11-16 00:12:37');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(25) NOT NULL,
  `mName` varchar(25) NOT NULL,
  `lName` varchar(25) NOT NULL,
  `suffix` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Erik','Bosi','Son','',NULL,NULL),(2,'Rom','Wal','Do','',NULL,NULL),(3,'Bry','Po','Gi','Jr',NULL,NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_code` varchar(45) DEFAULT NULL,
  `description` varchar(60) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'CODING','Coding',NULL,NULL),(2,'MULTIPLE_CHOICE','Multiple Choice',NULL,NULL);
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-16  1:46:50
