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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,1,'e@e.com','$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy',2),(2,2,'r@r.com','$2y$10$6C6VlaYAEUk.gA.ceS5y6OhXyFKRtZ/lJWuXi8qSRVaCO/toEhVSi',2),(3,3,'c@c.com','$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu',1),(4,4,'a@a.com','$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu',2),(5,5,'b@b.com','$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu',2),(6,6,'c@c.com','$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu',2);
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
-- Table structure for table `achievements`
--

DROP TABLE IF EXISTS `achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `achievements` (
  `achievement_id` int(11) NOT NULL AUTO_INCREMENT,
  `achievement_code` varchar(250) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `is_achieved` bit(1) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`achievement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `achievements`
--

LOCK TABLES `achievements` WRITE;
/*!40000 ALTER TABLE `achievements` DISABLE KEYS */;
INSERT INTO `achievements` VALUES (1,'ASK-01',1,'',NULL,NULL),(2,'ASK-02',1,'',NULL,NULL),(4,'ASK-03',1,'',NULL,NULL),(5,'ASK-04',1,'',NULL,NULL),(6,'ANS-01',1,'',NULL,NULL),(7,'ANS-02',1,'',NULL,NULL),(8,'ANS-03',1,'',NULL,NULL),(9,'ANS-04',1,'',NULL,NULL),(10,'PTP-01',1,'',NULL,NULL),(11,'PTP-02',1,'',NULL,NULL),(12,'PTP-03',1,'',NULL,NULL),(13,'PTP-04',1,'',NULL,NULL),(14,'PTP-05',1,'',NULL,NULL),(15,'PTP-06',1,'',NULL,NULL),(16,'PTP-07',1,'',NULL,NULL),(17,'PTP-08',1,'',NULL,NULL),(18,'PTP-09',1,'',NULL,NULL),(19,'PTP-10',1,'',NULL,NULL),(20,'PTP-11',1,'',NULL,NULL),(21,'PTP-12',1,'',NULL,NULL),(22,'SCA-01',1,'',NULL,NULL),(23,'SCA-02',1,'',NULL,NULL),(24,'FNA-01',1,'',NULL,NULL),(25,'FNA-02',1,'',NULL,NULL),(28,'ASK-02',4,'','2018-01-18 00:24:53','2018-01-18 00:24:53'),(29,'ASK-03',4,'','2018-01-18 00:57:20','2018-01-18 00:57:20'),(30,'ASK-04',4,'','2018-01-18 01:36:26','2018-01-18 01:36:26'),(31,'ANS-02',12,'','2018-01-20 20:06:08','2018-01-20 20:06:08'),(32,'ANS-02',12,'','2018-01-20 20:18:24','2018-01-20 20:18:24'),(33,'ANS-02',1,'','2018-01-20 20:34:09','2018-01-20 20:34:09'),(34,'ANS-03',51,'','2018-01-20 20:38:12','2018-01-20 20:38:12'),(35,'ASK-02',1,'','2018-01-20 22:36:47','2018-01-20 22:36:47'),(37,'ARQ-02',51,'','2018-01-20 23:06:18','2018-01-20 23:06:18'),(38,'ARQ-01',1,'','2018-01-20 23:10:28','2018-01-20 23:10:28'),(39,'ANS-03',1,'','2018-01-20 23:30:48','2018-01-20 23:30:48'),(40,'ARQ-02',1,'','2018-01-20 23:30:48','2018-01-20 23:30:48'),(44,'ANS-02',1,'','2018-01-20 23:34:06','2018-01-20 23:34:06'),(45,'ANS-02',5,'','2018-01-20 23:35:27','2018-01-20 23:35:27'),(46,'FNA-01',5,'','2018-01-20 23:35:27','2018-01-20 23:35:27'),(47,'ASK-03',5,'','2018-01-20 23:55:08','2018-01-20 23:55:08'),(48,'PTP-16',5,'','2018-01-20 23:55:08','2018-01-20 23:55:08'),(49,'ANS-03',5,'','2018-01-21 00:25:49','2018-01-21 00:25:49'),(50,'ARQ-02',3,'','2018-01-21 00:25:49','2018-01-21 00:25:49'),(51,'FNA-01',3,'','2018-01-21 00:25:49','2018-01-21 00:25:49'),(52,'ARQ-01',3,'','2018-01-21 00:25:49','2018-01-21 00:25:49'),(53,'PTP-03',5,'','2018-01-21 03:13:37','2018-01-21 03:13:37'),(55,'ARQ-02',5,'','2018-01-21 04:42:23','2018-01-21 04:42:23'),(56,'ARQ-01',5,'','2018-01-21 04:42:23','2018-01-21 04:42:23');
/*!40000 ALTER TABLE `achievements` ENABLE KEYS */;
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
-- Table structure for table `forums`
--

DROP TABLE IF EXISTS `forums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forums` (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(1000) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`forum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forums`
--

LOCK TABLES `forums` WRITE;
/*!40000 ALTER TABLE `forums` DISABLE KEYS */;
INSERT INTO `forums` VALUES (1,'1','1',1,'2018-01-01 00:00:00','2018-01-01 00:00:00','1'),(2,'this is forum 2','i dont know',2,'2018-01-01 00:00:00','2018-01-01 00:00:00','1');
/*!40000 ALTER TABLE `forums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forums_comments`
--

DROP TABLE IF EXISTS `forums_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forums_comments` (
  `forum_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`forum_comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forums_comments`
--

LOCK TABLES `forums_comments` WRITE;
/*!40000 ALTER TABLE `forums_comments` DISABLE KEYS */;
INSERT INTO `forums_comments` VALUES (1,1,1,'1','2018-01-01 00:00:00','2018-01-01 00:00:00'),(2,1,2,'comment 2','2018-01-01 00:00:00','2018-01-01 00:00:00'),(3,2,1,'comment for 2 _1',NULL,NULL);
/*!40000 ALTER TABLE `forums_comments` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multiple_choices`
--

LOCK TABLES `multiple_choices` WRITE;
/*!40000 ALTER TABLE `multiple_choices` DISABLE KEYS */;
INSERT INTO `multiple_choices` VALUES (17,'Q0102-0001','a','a',0,'2017-11-16 00:12:37','2017-11-16 00:12:37'),(18,'Q0102-0001','b','b',1,'2017-11-16 00:12:37','2017-11-16 00:12:37'),(19,'Q0102-0001','c','c',0,'2017-11-16 00:12:37','2017-11-16 00:12:37'),(20,'Q0102-0001','d','d',0,'2017-11-16 00:12:37','2017-11-16 00:12:37'),(21,'Q0402-0001','a','me',0,'2017-11-22 00:24:37','2017-11-22 00:24:37'),(22,'Q0402-0001','b','myseld',0,'2017-11-22 00:24:37','2017-11-22 00:24:37'),(23,'Q0402-0001','c','and',1,'2017-11-22 00:24:37','2017-11-22 00:24:37'),(24,'Q0402-0001','d','i',0,'2017-11-22 00:24:37','2017-11-22 00:24:37'),(25,'Q0103-0008','1','1',1,'2017-11-22 00:59:24','2017-11-22 00:59:24'),(26,'Q0103-0008','2','2',1,'2017-11-22 00:59:24','2017-11-22 00:59:24'),(27,'Q0103-0008','3','3',1,'2017-11-22 00:59:24','2017-11-22 00:59:24'),(28,'Q0103-0009','sd','sd',1,'2018-01-13 15:08:54','2018-01-13 15:08:54'),(29,'Q0303-0001','mem mem','mem mem',1,'2018-01-13 15:44:58','2018-01-13 15:44:58'),(30,'Q0303-0001','you you','you you',1,'2018-01-13 15:44:58','2018-01-13 15:44:58'),(31,'Q0303-0002','asd','asd',1,'2018-01-13 15:46:39','2018-01-13 15:46:39'),(32,'Q0102-0002','a','a',0,'2018-01-13 15:57:01','2018-01-13 15:57:01'),(33,'Q0102-0002','b','a',0,'2018-01-13 15:57:01','2018-01-13 15:57:01'),(34,'Q0102-0002','c','b',1,'2018-01-13 15:57:01','2018-01-13 15:57:01'),(35,'Q0102-0002','d','b',0,'2018-01-13 15:57:01','2018-01-13 15:57:01'),(36,'Q0102-0003','a','a',1,'2018-01-13 16:08:38','2018-01-13 16:08:38'),(37,'Q0102-0003','b','a',0,'2018-01-13 16:08:39','2018-01-13 16:08:39'),(38,'Q0102-0003','c','a',0,'2018-01-13 16:08:39','2018-01-13 16:08:39'),(39,'Q0102-0003','d','a',0,'2018-01-13 16:08:39','2018-01-13 16:08:39'),(40,'Q0103-0010','Hello','Hello',1,'2018-01-13 16:13:06','2018-01-13 16:13:06'),(41,'Q0103-0010','Hello','Hello',1,'2018-01-13 16:13:07','2018-01-13 16:13:07'),(42,'Q0103-0010','darkness','darkness',1,'2018-01-13 16:13:07','2018-01-13 16:13:07'),(43,'Q0103-0011','a','a',1,'2018-01-18 00:24:53','2018-01-18 00:24:53'),(44,'Q0103-0012','1','1',1,'2018-01-20 18:27:30','2018-01-20 18:27:30'),(45,'Q0103-0012','2','2',1,'2018-01-20 18:27:30','2018-01-20 18:27:30'),(46,'Q0103-0012','3','3',1,'2018-01-20 18:27:30','2018-01-20 18:27:30'),(47,'Q0103-0013','1','1',1,'2018-01-20 19:00:06','2018-01-20 19:00:06'),(48,'Q0103-0013','2','2',1,'2018-01-20 19:00:06','2018-01-20 19:00:06'),(49,'Q0103-0014','1','1',1,'2018-01-20 19:01:43','2018-01-20 19:01:43'),(50,'Q0103-0014','2','2',1,'2018-01-20 19:01:43','2018-01-20 19:01:43'),(51,'Q0103-0015','1','1',1,'2018-01-20 19:08:59','2018-01-20 19:08:59'),(52,'Q0103-0015','2','2',1,'2018-01-20 19:08:59','2018-01-20 19:08:59'),(53,'Q0103-0016','a','a',1,'2018-01-20 19:29:13','2018-01-20 19:29:13'),(54,'Q0103-0017','1','1',1,'2018-01-20 19:35:11','2018-01-20 19:35:11'),(55,'Q0103-0018','1','1',1,'2018-01-20 22:35:35','2018-01-20 22:35:35'),(56,'Q0103-0019','1','1',1,'2018-01-20 22:36:47','2018-01-20 22:36:47'),(57,'Q0103-0020','1','1',1,'2018-01-21 00:21:03','2018-01-21 00:21:03'),(58,'Q0102-0004','a','a',1,'2018-01-21 00:34:21','2018-01-21 00:34:21'),(59,'Q0102-0004','b','b',0,'2018-01-21 00:34:21','2018-01-21 00:34:21'),(60,'Q0102-0004','c','c',0,'2018-01-21 00:34:21','2018-01-21 00:34:21'),(61,'Q0102-0004','d','d',0,'2018-01-21 00:34:21','2018-01-21 00:34:21'),(62,'Q0103-0021','1','1',1,'2018-01-21 00:36:04','2018-01-21 00:36:04'),(63,'Q0203-0001','1','1',1,'2018-01-21 00:37:36','2018-01-21 00:37:36');
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
  `points` decimal(18,6) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (30,'<div><!--block-->asdf</div>','asdf','ADAPTER','MULTIPLE_CHOICE',1,'Q0102-0001',1,'2017-11-16 00:12:37','2017-11-16 00:12:37',NULL),(31,'<div><!--block-->asdfas</div>','asdfas','ADAPTER','CODING',1,'Q0101-0001',1,'2017-11-16 23:51:36','2017-11-16 23:51:36',NULL),(32,'<pre><!--block-->does the moonlight shine on paris after the sun goes down?does the moonlight shine on paris after the sun goes down?does the moonlight shine on paris after the sun goes down?does the moonlight shine on paris after the sun goes down?does the moonlight shine on paris after the sun goes down?does the moonlight shine on paris after the sun goes down?does the moonlight shine on paris after the sun goes down?does the moonlight shine on paris after the sun goes down?does the moonlight shine on paris after the sun goes down?does the moonlight shine on paris after the sun goes down?does the moonlight shine on paris after the sun goes down?does the moonlight shine on paris after the sun goes down?does the moonlight shine on paris after the sun goes down?</pre>','this is from c','STRATEGY','CODING',1,'Q0501-0001',3,'2017-11-18 22:05:07','2017-11-18 22:05:07',NULL),(33,'<div><!--block-->as</div>','d','ADAPTER','IDENTIFICATION',0,'Q0103-0001',2,'2017-11-19 01:17:36','2017-11-19 01:17:36',NULL),(34,'<div><!--block-->asdf</div>','sdf','ADAPTER','IDENTIFICATION',0,'Q0103-0002',2,'2017-11-19 01:18:09','2017-11-19 01:18:09',NULL),(35,'<div><!--block-->sadas</div>','sample','ADAPTER','IDENTIFICATION',0,'Q0103-0003',2,'2017-11-19 01:26:01','2017-11-19 01:26:01',NULL),(36,'<div><!--block-->sd</div>','sd','ADAPTER','IDENTIFICATION',0,'Q0103-0004',2,'2017-11-19 01:26:31','2017-11-19 01:26:31',NULL),(37,'<div><!--block-->sd</div>','sd','ADAPTER','IDENTIFICATION',0,'Q0103-0005',2,'2017-11-19 01:27:10','2017-11-19 01:27:10',NULL),(38,'<div><!--block-->asda</div>','asd','ADAPTER','IDENTIFICATION',0,'Q0103-0006',2,'2017-11-19 01:30:31','2017-11-19 01:30:31',NULL),(39,'<div><!--block-->who da who?</div>','Philippine hero','OBSERVER','MULTIPLE_CHOICE',1,'Q0402-0001',3,'2017-11-22 00:24:37','2017-11-22 00:24:37',NULL),(40,'<div><!--block-->Here</div>','identification','ADAPTER','IDENTIFICATION',0,'Q0103-0007',1,'2017-11-22 00:50:51','2017-11-22 00:50:51',NULL),(42,'<div><!--block-->d</div>','asdfasdf','ADAPTER','IDENTIFICATION',1,'Q0103-0008',1,'2017-11-22 00:59:24','2017-11-22 00:59:24',NULL),(43,'<div><!--block-->Test coding</div>','CODING','OBSERVER','CODING',0,'Q0401-0001',1,'2017-11-30 19:01:28','2017-11-30 19:01:28',NULL),(44,'<div><!--block-->asdf</div>','df','ADAPTER','IDENTIFICATION',1,'Q0103-0009',2,'2018-01-13 15:08:54','2018-01-13 15:08:54',NULL),(45,'<div><!--block-->ew</div>','ds','ADAPTER','CODING',1,'Q0101-0002',2,'2018-01-13 15:09:15','2018-01-13 15:09:15',NULL),(46,'<div><!--block--><strong>Who dat be? ____ and ____</strong></div>','who dat mbe','DECORATOR','IDENTIFICATION',0,'Q0303-0001',2,'2018-01-13 15:44:58','2018-01-13 15:44:58',NULL),(47,'<div><!--block-->BEBEBE</div>','asd','DECORATOR','IDENTIFICATION',1,'Q0303-0002',2,'2018-01-13 15:46:39','2018-01-13 15:46:39',NULL),(48,'<div><!--block-->who da</div>','asd','ADAPTER','MULTIPLE_CHOICE',0,'Q0102-0002',2,'2018-01-13 15:57:01','2018-01-13 15:57:01',NULL),(49,'<div><!--block-->Sample multiple choice question</div>','Test Question MC','ADAPTER','MULTIPLE_CHOICE',1,'Q0102-0003',2,'2018-01-13 16:08:38','2018-01-13 16:08:38',NULL),(50,'<div><!--block-->Testing Question Code</div>','Test Question Code','ADAPTER','CODING',0,'Q0101-0003',2,'2018-01-13 16:11:49','2018-01-13 16:11:49',NULL),(51,'<div><!--block-->Testing question for identification</div>','Test Question Identification','ADAPTER','IDENTIFICATION',1,'Q0103-0010',2,'2018-01-13 16:13:06','2018-01-13 16:13:06',NULL),(52,'<div><!--block-->code mo to &nbsp;para lumakas ka<br><br></div>','ask me?','ADAPTER','CODING',1,'Q0101-0004',2,'2018-01-13 16:37:38','2018-01-13 16:37:38',NULL),(53,'<div><!--block-->asdf</div>','asdfa','ADAPTER','CODING',1,'Q0101-0005',2,'2018-01-13 17:39:16','2018-01-13 17:39:16',NULL),(54,'<div><!--block-->sd</div>','as','ADAPTER','IDENTIFICATION',1,'Q0103-0011',4,'2018-01-18 00:24:53','2018-01-18 00:24:53',NULL),(55,'<div><!--block-->sds</div>','asdff','ABSTRACT-FACTORY','CODING',1,'Q0601-0001',4,'2018-01-18 00:25:24','2018-01-18 00:25:24',NULL),(56,'<div><!--block-->sd</div>','asd``','DECORATOR','CODING',NULL,'Q0301-0001',4,'2018-01-20 17:13:17','2018-01-20 17:13:17',NULL),(57,'<div><!--block-->asd</div>','asdfa','ADAPTER','CODING',NULL,'Q0101-0006',0,'2018-01-20 17:25:09','2018-01-20 17:25:09',NULL),(58,'<div><!--block-->sdad</div>','asfasdf','ADAPTER','CODING',NULL,'Q0101-0007',0,'2018-01-20 17:26:23','2018-01-20 17:26:23',NULL),(59,'<div><!--block-->fasd</div>','df','ADAPTER','CODING',1,'Q0101-0008',1,'2018-01-20 17:27:28','2018-01-20 17:27:28',0.500000),(60,'<div><!--block-->sample</div>','identification','ADAPTER','IDENTIFICATION',1,'Q0103-0012',1,'2018-01-20 18:27:30','2018-01-20 18:27:30',0.380000),(61,'<div><!--block-->wdw</div>','asdf','ADAPTER','IDENTIFICATION',1,'Q0103-0013',1,'2018-01-20 19:00:06','2018-01-20 19:00:06',0.380000),(62,'<div><!--block-->asd</div>','0.38','ADAPTER','IDENTIFICATION',1,'Q0103-0014',1,'2018-01-20 19:01:43','2018-01-20 19:01:43',0.380000),(63,'<div><!--block-->sd</div>','sdf','ADAPTER','IDENTIFICATION',1,'Q0103-0015',1,'2018-01-20 19:08:59','2018-01-20 19:08:59',0.380000),(64,'<div><!--block-->as</div>','sas','ADAPTER','IDENTIFICATION',1,'Q0103-0016',1,'2018-01-20 19:29:13','2018-01-20 19:29:13',0.375000),(65,'<div><!--block-->sad</div>','sd','ADAPTER','IDENTIFICATION',1,'Q0103-0017',1,'2018-01-20 19:35:11','2018-01-20 19:35:11',0.375000),(66,'<div><!--block-->1</div>','CODING','ADAPTER','CODING',1,'Q0101-0009',1,'2018-01-20 20:32:18','2018-01-20 20:32:18',NULL),(67,'<div><!--block-->asd</div>','adapter','ADAPTER','IDENTIFICATION',NULL,'Q0103-0018',1,'2018-01-20 22:35:35','2018-01-20 22:35:35',NULL),(68,'<div><!--block-->aS</div>','asd','ADAPTER','IDENTIFICATION',0,'Q0103-0019',5,'2018-01-20 22:36:47','2018-01-20 22:36:47',0.750000),(69,'<div><!--block-->AAAAAAAAAAAAAAAAAAAAA</div>','This is my life','OBSERVER','IDENTIFICATION',1,'Q0403-0001',1,'2018-01-21 02:36:04','2018-01-21 02:36:04',1.125000),(70,'<div><!--block-->ASDASD</div>','This is my second life','OBSERVER','IDENTIFICATION',1,'Q0403-0002',1,'2018-01-21 02:55:17','2018-01-21 02:55:17',0.750000),(71,'<div><!--block-->ASDASD</div>','Test ask','OBSERVER','IDENTIFICATION',1,'Q0403-0003',1,'2018-01-21 03:08:59','2018-01-21 03:08:59',0.750000),(72,'<div><!--block-->Eto na yung tanong</div>','Eto na talaga yon','OBSERVER','IDENTIFICATION',1,'Q0403-0004',4,'2018-01-21 03:32:10','2018-01-21 03:32:10',0.750000),(75,'<div><!--block-->Test3</div>','Test3','ADAPTER','IDENTIFICATION',1,'Q0103-0020',2,'2018-01-21 04:28:39','2018-01-21 04:28:39',0.375000),(77,'<div><!--block-->asd</div>','ASKJD','OBSERVER','IDENTIFICATION',1,'Q0403-0005',2,'2018-01-21 04:49:42','2018-01-21 04:49:42',1.000000),(81,'<div><!--block-->KJASHDKJASD</div>','asdasd','OBSERVER','IDENTIFICATION',1,'Q0403-0006',2,'2018-01-21 05:15:29','2018-01-21 05:15:29',0.750000);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rewards`
--

DROP TABLE IF EXISTS `rewards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rewards` (
  `reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `achievement_code` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `icon_path` varchar(150) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `active` bit(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `entity1` varchar(45) DEFAULT NULL,
  `entity2` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`reward_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rewards`
--

LOCK TABLES `rewards` WRITE;
/*!40000 ALTER TABLE `rewards` DISABLE KEYS */;
INSERT INTO `rewards` VALUES (1,'ASK-01','Reached 25 points from asking','Inquisitive','inquisitive.png','ASKING','',NULL,NULL,NULL,NULL),(2,'ASK-02','Asked 1st question ','Can you help me?','first-question.png','ASKING','',NULL,NULL,NULL,NULL),(3,'ASK-03','1st Approved question','Good question','approved.png','ASKING','',NULL,NULL,NULL,NULL),(4,'ASK-04','Having 20 questions approved','Insatiably curious','curious.png','ASKING','',NULL,NULL,NULL,NULL),(5,'ANS-01','Reached 75 points from answering','Knowledgeable!','knowledge.png','ANSWER','',NULL,NULL,NULL,NULL),(6,'ANS-02','Answered 1st question','Trying my best','first-answer.png','ANSWER','',NULL,NULL,NULL,NULL),(7,'ANS-03','1st correct answer','I know something','right-right.png','ANSWER','',NULL,NULL,NULL,NULL),(8,'ANS-04','1st Answer marked as correct in a coding type question','I can code','can-code.png','ANSWER','',NULL,NULL,NULL,NULL),(9,'PTP-01','Mastered All Categories','Master of All','scholar.png','PARTICIPATION','',NULL,NULL,NULL,NULL),(10,'PTP-02','Mastered Abstract Factory Category','Abstract Master','abstract-shape.png','PARTICIPATION','',NULL,NULL,'ABSTRACT-FACTORY','CATEGORYGROUP'),(11,'PTP-03','Mastered Adapter Category','Adapter Master','adapter.png','PARTICIPATION','',NULL,NULL,'ADAPTER','CATEGORYGROUP'),(12,'PTP-04','Mastered Composite Category','Composite Master','composer.png','PARTICIPATION','',NULL,NULL,'COMPOSITE','CATEGORYGROUP'),(13,'PTP-05','Mastered Decorator Category','Decorator Master','decorator.png','PARTICIPATION','',NULL,NULL,'DECORATOR','CATEGORYGROUP'),(14,'PTP-06','Mastered Factory Method Category','Factory Method Master','factory.png','PARTICIPATION','',NULL,NULL,'FACTORY-METHOD','CATEGORYGROUP'),(15,'PTP-07','Mastered Observer Category','Observer Master','observer.png','PARTICIPATION','',NULL,NULL,'OBSERVER','CATEGORYGROUP'),(16,'PTP-08','Mastered Observer Category','Strategy Master','strategy.png','PARTICIPATION','',NULL,NULL,'STRATEGY','CATEGORYGROUP'),(17,'PTP-09','Mastered Template Method Category','Template Master','template.png','PARTICIPATION','',NULL,NULL,'TEMPLATE-METHOD','CATEGORYGROUP'),(18,'PTP-10','Reach 25 points overall','Approaching the base','25.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(19,'PTP-11','Reach 50 points overall','Halfway there','50.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(20,'PTP-12','Reach 100 points overall','Accomplished','100.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(21,'PTP-13','Reach 150 points overall','Still going?','hooked.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(22,'PTP-14','Reach 200 points overall','Programming Junkie','programming-junkie.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(23,'PTP-15','Reach 500 points overall','Programming Genius','programming-junkie.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(24,'PTP-16','1st Question to be rejected by the admin','N O P E ','reject.png','PARTICIPATION','',NULL,NULL,NULL,NULL),(25,'SCA-01','Getting 5 replies to your forum post','Social','social.png','SOCIAL','',NULL,NULL,NULL,NULL),(26,'SCA-02','Posted 5 topics in forum','Conversationalist','forum.png','SOCIAL','',NULL,NULL,NULL,NULL),(27,'FNA-01','Get first achievement.','Baby Steps','climbing-stairs.png','FUN','',NULL,NULL,NULL,NULL),(28,'FNA-02','Get all the achievements.','The Curator','curator.png','FUN','',NULL,NULL,NULL,NULL),(29,'ARQ-01','Getting your first “5 star” rating','Five Stars','five-stars.png','RATINGS','',NULL,NULL,NULL,NULL),(30,'ARQ-02','1st Question rated','Rated','rated.png','RATINGS','',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `rewards` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Erik','Bosi','Son','',NULL,NULL),(2,'Rom','Wal','Do','',NULL,NULL),(3,'Bry','Po','Gi','Jr',NULL,NULL),(4,'a','a','a','a',NULL,NULL),(5,'b','b','b','b',NULL,NULL),(6,'c','c','c','c',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'CODING','Coding',NULL,NULL),(2,'MULTIPLE_CHOICE','Multiple Choice',NULL,NULL),(3,'IDENTIFICATION','Identification',NULL,NULL);
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

-- Dump completed on 2018-01-21  5:37:43
