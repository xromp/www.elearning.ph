-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: e_learning
-- ------------------------------------------------------
-- Server version	5.7.18-log

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
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,1,'e@e.com','$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy',2),(2,2,'r@r.com','$2y$10$6C6VlaYAEUk.gA.ceS5y6OhXyFKRtZ/lJWuXi8qSRVaCO/toEhVSi',2),(3,3,'c@c.com','$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu',1),(4,4,'a@a.com','$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu',2),(5,5,'b@b.com','$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu',2),(6,6,'c@c.com','$2y$10$px/RM9vedMZIjxp/xSxEyeuiHdrT.QMUs1009LvGDWFZmWOJPGtmu',2),(7,7,'q1@com','$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy',2),(8,8,'q2@com','$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy',2),(9,9,'q3@com','$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy',2),(10,10,'admin1@com','$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy',1),(11,11,'answer1@com','$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy',2);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `accounttypes`
--

LOCK TABLES `accounttypes` WRITE;
/*!40000 ALTER TABLE `accounttypes` DISABLE KEYS */;
INSERT INTO `accounttypes` VALUES (1,'Student'),(2,'Admin');
/*!40000 ALTER TABLE `accounttypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `achievements`
--

LOCK TABLES `achievements` WRITE;
/*!40000 ALTER TABLE `achievements` DISABLE KEYS */;
INSERT INTO `achievements` VALUES (64,'ASK-02',1,'','2018-01-26 10:37:49','2018-01-26 10:37:49'),(65,'FNA-01',1,'','2018-01-26 10:37:50','2018-01-26 10:37:50'),(66,'ASK-03',1,'','2018-01-26 10:42:30','2018-01-26 10:42:30'),(67,'ASK-04',1,'','2018-01-26 10:54:03','2018-01-26 10:54:03'),(68,'PTP-16',1,'','2018-01-26 10:54:52','2018-01-26 10:54:52'),(69,'ASK-02',3,'','2018-01-26 10:57:02','2018-01-26 10:57:02'),(70,'FNA-01',3,'','2018-01-26 10:57:02','2018-01-26 10:57:02'),(71,'ASK-03',3,'','2018-01-26 10:57:41','2018-01-26 10:57:41'),(72,'ANS-02',1,'','2018-01-26 10:58:27','2018-01-26 10:58:27'),(73,'ARQ-02',3,'','2018-01-26 10:58:27','2018-01-26 10:58:27'),(74,'ARQ-01',3,'','2018-01-26 10:58:27','2018-01-26 10:58:27'),(75,'ANS-03',1,'','2018-01-26 10:59:31','2018-01-26 10:59:31'),(76,'ASK-02',4,'','2018-01-26 11:01:20','2018-01-26 11:01:20'),(77,'FNA-01',4,'','2018-01-26 11:01:20','2018-01-26 11:01:20'),(78,'ARQ-02',4,'','2018-01-26 11:02:49','2018-01-26 11:02:49'),(79,'ARQ-01',4,'','2018-01-26 11:02:49','2018-01-26 11:02:49'),(80,'ANS-04',1,'','2018-01-26 12:02:53','2018-01-26 12:02:53'),(81,'PTP-03',1,'','2018-01-26 12:07:25','2018-01-26 12:07:25'),(82,'ANS-02',4,'','2018-01-26 12:13:18','2018-01-26 12:13:18'),(94,'ARQ-02',1,'','2018-01-26 12:49:45','2018-01-26 12:49:45'),(95,'ARQ-01',1,'','2018-01-26 12:50:10','2018-01-26 12:50:10'),(96,'ANS-03',4,'','2018-01-26 18:18:27','2018-01-26 18:18:27');
/*!40000 ALTER TABLE `achievements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `answer_multiple_choices`
--

LOCK TABLES `answer_multiple_choices` WRITE;
/*!40000 ALTER TABLE `answer_multiple_choices` DISABLE KEYS */;
/*!40000 ALTER TABLE `answer_multiple_choices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,'Q0103-0003',1,'i think this is 2','\0',NULL,NULL,'2018-01-26 10:58:27','2018-01-26 10:58:27'),(3,'Q0103-0004',1,'2','',3.75,NULL,'2018-01-26 10:59:31','2018-01-26 10:59:31'),(4,'Q0101-0001',1,'<div><!--block-->SADF</div>',NULL,NULL,NULL,'2018-01-26 11:02:49','2018-01-26 11:02:49'),(5,'Q0101-0002',1,'<div><!--block-->CODING2</div>','',5.00,NULL,'2018-01-26 11:03:22','2018-01-26 11:03:22'),(6,'Q0203-0005',4,'ilikethis','\0',NULL,NULL,'2018-01-26 12:13:18','2018-01-26 12:13:18'),(7,'Q0102-0003',4,'<div><!--block-->sdf</div>',NULL,NULL,NULL,'2018-01-26 12:15:33','2018-01-26 12:15:33'),(8,'Q0102-0003',4,'<div><!--block-->sadf</div>',NULL,NULL,NULL,'2018-01-26 12:19:21','2018-01-26 12:19:21'),(9,'Q0201-0003',4,'<div><!--block-->dfs</div>',NULL,NULL,NULL,'2018-01-26 12:26:45','2018-01-26 12:26:45'),(15,'Q0103-0005',4,'asd','\0',NULL,2,'2018-01-26 12:49:45','2018-01-26 12:49:45'),(16,'Q0101-0003',4,'<div><!--block-->zxz</div>',NULL,NULL,5,'2018-01-26 12:50:10','2018-01-26 12:50:10'),(18,'Q0103-0004',4,'we','\0',NULL,NULL,'2018-01-26 18:16:53','2018-01-26 18:16:53'),(19,'Q0102-0001',4,'a','',3.75,4,'2018-01-26 18:18:27','2018-01-26 18:18:27'),(20,'Q0103-0001',4,'sds','\0',NULL,4,'2018-01-26 18:20:09','2018-01-26 18:20:09'),(22,'Q0103-0006',1,'YES','\0',NULL,NULL,'2018-01-26 20:40:26','2018-01-26 20:40:26');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'ADAPTER','Adapter','2017-10-29 01:03:03','2017-10-29 01:03:03'),(2,'COMPOSITE','Composite','2017-10-29 01:03:03','2017-10-29 01:03:03'),(3,'DECORATOR','Decorator','2017-10-29 01:03:03','2017-10-29 01:03:03'),(4,'OBSERVER','Observer','2017-10-29 01:03:03','2017-10-29 01:03:03'),(5,'STRATEGY','Strategy','2017-10-29 01:03:03','2017-10-29 01:03:03'),(6,'ABSTRACT-FACTORY','Abstract-Factory','2017-10-29 01:03:03','2017-10-29 01:03:03'),(7,'FACTORY-METHOD','Factory-Method','2017-10-29 01:03:03','2017-10-29 01:03:03'),(8,'TEMPLATE-METHOD','Template-Method','2017-10-29 01:03:03','2017-10-29 01:03:03');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `forums`
--

LOCK TABLES `forums` WRITE;
/*!40000 ALTER TABLE `forums` DISABLE KEYS */;
INSERT INTO `forums` VALUES (1,'1','1',1,'2018-01-01 00:00:00','2018-01-01 00:00:00','1'),(2,'this is forum 2','i dont know',2,'2018-01-01 00:00:00','2018-01-01 00:00:00','1');
/*!40000 ALTER TABLE `forums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `forums_comments`
--

LOCK TABLES `forums_comments` WRITE;
/*!40000 ALTER TABLE `forums_comments` DISABLE KEYS */;
INSERT INTO `forums_comments` VALUES (1,1,1,'1','2018-01-01 00:00:00','2018-01-01 00:00:00'),(2,1,2,'comment 2','2018-01-01 00:00:00','2018-01-01 00:00:00'),(3,2,1,'comment for 2 _1',NULL,NULL);
/*!40000 ALTER TABLE `forums_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'Answered a question',1,NULL,'0000-00-00 00:00:00','2017-10-28 19:14:38'),(2,'Answered a question1',2,NULL,'0000-00-00 00:00:00','2017-10-28 19:15:45'),(3,'Posted a question',1,NULL,'0000-00-00 00:00:00','2017-10-28 19:17:35'),(4,'Posted a question',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'Answered a question',3,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'Answered a question',2,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,'updated',1,NULL,'2017-10-28 15:38:28','2017-10-28 15:52:33'),(8,'erikson',4,NULL,'2017-10-28 16:51:32','2017-10-28 19:12:21'),(9,'erikson',1,NULL,'2017-10-28 16:52:42','2017-10-28 16:52:42'),(10,'noskire1111',2,NULL,'2017-10-28 17:02:21','2017-10-28 19:14:04'),(11,'adf',2,NULL,'2017-10-28 17:18:19','2017-10-28 17:18:19'),(12,'adf',2,NULL,'2017-10-28 17:18:54','2017-10-28 17:18:54'),(13,'asdf',3,NULL,'2017-10-28 19:28:04','2017-10-28 19:28:04'),(14,'asdf',1,NULL,'2017-10-28 19:28:17','2017-10-28 19:28:17'),(15,'noskiressss',2,NULL,'2017-10-28 19:29:37','2017-10-28 19:29:37'),(16,'noskiressss',2,NULL,'2017-10-28 19:29:55','2017-10-28 19:29:55'),(17,'noskiressss',2,NULL,'2017-10-28 19:30:14','2017-10-28 19:30:14'),(18,'noskiressss',2,NULL,'2017-10-28 19:31:32','2017-10-28 19:31:32'),(19,'aaannn',3,NULL,'2017-10-28 19:32:31','2017-10-28 19:32:31'),(20,'erikson b syonet',3,NULL,'2017-10-28 19:32:45','2017-10-28 19:32:45'),(21,'nothing nothing',2,NULL,'2017-10-29 11:52:49','2017-10-29 11:53:38'),(24,'4 has posted question 20',4,'Working Activities (Direct)','2018-01-26 18:07:47','2018-01-26 18:07:47'),(25,'4 has answered question 9',4,'Working Activities (Indirect)','2018-01-26 18:16:53','2018-01-26 18:16:53'),(26,'4 has rated question 6',4,'Working Activities (Direct)','2018-01-26 18:18:27','2018-01-26 18:18:27'),(27,'4 has answered question 6',4,'Working Activities (Indirect)','2018-01-26 18:18:27','2018-01-26 18:18:27'),(28,'4 has rated question 5',4,'Working Activities (Indirect)','2018-01-26 18:20:09','2018-01-26 18:20:09'),(29,'4 has answered question 5',4,'Working Activities (Direct)','2018-01-26 18:20:09','2018-01-26 18:20:09'),(30,'4 has accessed leaderboards page',4,'Fun Activities','2018-01-26 19:28:56','2018-01-26 19:28:56'),(31,'4 has accessed leaderboards page',4,'Fun Activities','2018-01-26 19:38:41','2018-01-26 19:38:41'),(32,'1 has accessed leaderboards page',1,'Fun Activities','2018-01-26 19:41:52','2018-01-26 19:41:52'),(34,'1 has answered question 20',1,'Working Activities (Direct)','2018-01-26 20:40:26','2018-01-26 20:40:26'),(35,'1 has planned before answering question 20',1,'Planning Activities','2018-01-26 20:40:26','2018-01-26 20:40:26');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `multiple_choices`
--

LOCK TABLES `multiple_choices` WRITE;
/*!40000 ALTER TABLE `multiple_choices` DISABLE KEYS */;
INSERT INTO `multiple_choices` VALUES (1,'Q0103-0001','a','a',1,'2018-01-26 09:55:18','2018-01-26 09:55:18'),(2,'Q0103-0001','a','a',1,'2018-01-26 10:05:18','2018-01-26 10:05:18'),(3,'Q0103-0002','a','a',1,'2018-01-26 10:13:51','2018-01-26 10:13:51'),(4,'Q0103-0003','a','a',1,'2018-01-26 10:14:11','2018-01-26 10:14:11'),(5,'Q0103-0001','1','1',1,'2018-01-26 10:37:50','2018-01-26 10:37:50'),(6,'Q0102-0001','a','q',1,'2018-01-26 10:38:26','2018-01-26 10:38:26'),(7,'Q0102-0001','b','1',0,'2018-01-26 10:38:26','2018-01-26 10:38:26'),(8,'Q0102-0001','c','1',0,'2018-01-26 10:38:26','2018-01-26 10:38:26'),(9,'Q0102-0001','d','2',0,'2018-01-26 10:38:26','2018-01-26 10:38:26'),(10,'Q0103-0002','w','w',1,'2018-01-26 10:38:50','2018-01-26 10:38:50'),(11,'Q0103-0003','1','1',1,'2018-01-26 10:57:03','2018-01-26 10:57:03'),(12,'Q0103-0004','2','2',1,'2018-01-26 10:57:33','2018-01-26 10:57:33'),(13,'Q0103-0005','q','q',1,'2018-01-26 12:05:23','2018-01-26 12:05:23'),(20,'Q0103-0006','z','z',1,'2018-01-26 18:07:47','2018-01-26 18:07:47');
/*!40000 ALTER TABLE `multiple_choices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (5,'<div><!--block-->First Questions</div>','1','ADAPTER','IDENTIFICATION',1,'Q0103-0001',1,'2018-01-26 10:37:50','2018-01-26 10:37:50',1.312500),(6,'<div><!--block-->Sample Question 2</div>','2','ADAPTER','MULTIPLE_CHOICE',1,'Q0102-0001',1,'2018-01-26 10:38:26','2018-01-26 10:38:26',1.312500),(7,'<div><!--block-->s</div>','3','ADAPTER','IDENTIFICATION',0,'Q0103-0002',1,'2018-01-26 10:38:50','2018-01-26 10:38:50',NULL),(8,'<div><!--block-->asd</div>','answer is 1','ADAPTER','IDENTIFICATION',1,'Q0103-0003',3,'2018-01-26 10:57:02','2018-01-26 10:57:02',1.312500),(9,'<div><!--block-->the answer is 2</div>','answer is 2','ADAPTER','IDENTIFICATION',1,'Q0103-0004',3,'2018-01-26 10:57:33','2018-01-26 10:57:33',1.312500),(10,'<div><!--block-->CODING</div>','CODING','ADAPTER','CODING',1,'Q0101-0001',4,'2018-01-26 11:01:20','2018-01-26 11:01:20',NULL),(11,'<div><!--block-->CODING</div>','CODING 2','ADAPTER','CODING',1,'Q0101-0002',4,'2018-01-26 11:01:36','2018-01-26 11:01:36',NULL),(12,'<div><!--block-->Rating 1st Questions</div>','FIrst Rating Question','ADAPTER','CODING',1,'Q0101-0003',1,'2018-01-26 12:05:00','2018-01-26 12:05:00',1.750000),(13,'<div><!--block-->CODING</div>','FIrst 5 RAting','ADAPTER','IDENTIFICATION',1,'Q0103-0005',1,'2018-01-26 12:05:23','2018-01-26 12:05:23',1.312500),(20,'<div><!--block-->sds</div>','asa','ADAPTER','IDENTIFICATION',1,'Q0103-0006',4,'2018-01-26 18:07:47','2018-01-26 18:07:47',NULL);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rewards`
--

LOCK TABLES `rewards` WRITE;
/*!40000 ALTER TABLE `rewards` DISABLE KEYS */;
INSERT INTO `rewards` VALUES (1,'ASK-01','Reached 25 points from asking','Inquisitive','inquisitive.png','ASKING','',NULL,NULL,NULL,NULL),(2,'ASK-02','Asked 1st question ','Can you help me?','first-question.png','ASKING','',NULL,NULL,NULL,NULL),(3,'ASK-03','1st Approved question','Good question','approved.png','ASKING','',NULL,NULL,NULL,NULL),(4,'ASK-04','Having 20 questions approved','Insatiably curious','curious.png','ASKING','',NULL,NULL,NULL,NULL),(5,'ANS-01','Reached 75 points from answering','Knowledgeable!','knowledge.png','ANSWER','',NULL,NULL,NULL,NULL),(6,'ANS-02','Answered 1st question','Trying my best','first-answer.png','ANSWER','',NULL,NULL,NULL,NULL),(7,'ANS-03','1st correct answer','I know something','right-right.png','ANSWER','',NULL,NULL,NULL,NULL),(8,'ANS-04','1st Answer marked as correct in a coding type question','I can code','can-code.png','ANSWER','',NULL,NULL,NULL,NULL),(9,'PTP-01','Mastered All Categories','Master of All','scholar.png','PARTICIPATION','',NULL,NULL,NULL,NULL),(10,'PTP-02','Mastered Abstract Factory Category','Abstract Master','abstract-shape.png','PARTICIPATION','',NULL,NULL,'ABSTRACT-FACTORY','CATEGORYGROUP'),(11,'PTP-03','Mastered Adapter Category','Adapter Master','adapter.png','PARTICIPATION','',NULL,NULL,'ADAPTER','CATEGORYGROUP'),(12,'PTP-04','Mastered Composite Category','Composite Master','composer.png','PARTICIPATION','',NULL,NULL,'COMPOSITE','CATEGORYGROUP'),(13,'PTP-05','Mastered Decorator Category','Decorator Master','decorator.png','PARTICIPATION','',NULL,NULL,'DECORATOR','CATEGORYGROUP'),(14,'PTP-06','Mastered Factory Method Category','Factory Method Master','factory.png','PARTICIPATION','',NULL,NULL,'FACTORY-METHOD','CATEGORYGROUP'),(15,'PTP-07','Mastered Observer Category','Observer Master','observer.png','PARTICIPATION','',NULL,NULL,'OBSERVER','CATEGORYGROUP'),(16,'PTP-08','Mastered Observer Category','Strategy Master','strategy.png','PARTICIPATION','',NULL,NULL,'STRATEGY','CATEGORYGROUP'),(17,'PTP-09','Mastered Template Method Category','Template Master','template.png','PARTICIPATION','',NULL,NULL,'TEMPLATE-METHOD','CATEGORYGROUP'),(18,'PTP-10','Reach 25 points overall','Approaching the base','25.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(19,'PTP-11','Reach 50 points overall','Halfway there','50.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(20,'PTP-12','Reach 100 points overall','Accomplished','100.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(21,'PTP-13','Reach 150 points overall','Still going?','hooked.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(22,'PTP-14','Reach 200 points overall','Programming Junkie','programming-junkie.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(23,'PTP-15','Reach 500 points overall','Programming Genius','programming-junkie.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(24,'PTP-16','1st Question to be rejected by the admin','N O P E ','reject.png','PARTICIPATION','',NULL,NULL,NULL,NULL),(25,'SCA-01','Getting 5 replies to your forum post','Social','social.png','SOCIAL','',NULL,NULL,NULL,NULL),(26,'SCA-02','Posted 5 topics in forum','Conversationalist','forum.png','SOCIAL','',NULL,NULL,NULL,NULL),(27,'FNA-01','Get first achievement.','Baby Steps','climbing-stairs.png','FUN','',NULL,NULL,NULL,NULL),(28,'FNA-02','Get all the achievements.','The Curator','curator.png','FUN','',NULL,NULL,NULL,NULL),(29,'ARQ-01','Getting your first “5 star” rating','Five Stars','five-stars.png','RATINGS','',NULL,NULL,NULL,NULL),(30,'ARQ-02','1st Question rated','Rated','rated.png','RATINGS','',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `rewards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Erik','Bosi','Son','',NULL,NULL),(2,'Rom','Wal','Do','',NULL,NULL),(3,'Bry','Po','Gi','Jr',NULL,NULL),(4,'a','a','a','a',NULL,NULL),(5,'b','b','b','b',NULL,NULL),(6,'c','c','c','c',NULL,NULL),(7,'q1','','','',NULL,NULL),(8,'q2','','','',NULL,NULL),(9,'q3','','','',NULL,NULL),(10,'admin 1','','','',NULL,NULL),(11,'answer 1','','','',NULL,NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

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

-- Dump completed on 2018-01-26 21:09:56
