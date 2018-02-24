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
-- Dumping data for table `rewards`
--

LOCK TABLES `rewards` WRITE;
/*!40000 ALTER TABLE `rewards` DISABLE KEYS */;
INSERT INTO `rewards` VALUES (1,'ASK-01','Reached 25 points from asking','Inquisitive','inquisitive.png','ASKING','',NULL,NULL,NULL,NULL),(2,'ASK-02','Asked 1st question ','Can you help me?','first-question.png','ASKING','',NULL,NULL,NULL,NULL),(3,'ASK-03','1st Approved question','Good question','approved.png','ASKING','',NULL,NULL,NULL,NULL),(4,'ASK-04','Having 20 questions approved','Insatiably curious','curious.png','ASKING','',NULL,NULL,NULL,NULL),(5,'ANS-01','Reached 75 points from answering','Knowledgeable!','knowledge.png','ANSWER','',NULL,NULL,NULL,NULL),(6,'ANS-02','Answered 1st question','Trying my best','first-answer.png','ANSWER','',NULL,NULL,NULL,NULL),(7,'ANS-03','1st correct answer','I know something','right-right.png','ANSWER','',NULL,NULL,NULL,NULL),(8,'ANS-04','1st Answer marked as correct in a coding type question','I can code','can-code.png','ANSWER','',NULL,NULL,NULL,NULL),(9,'PTP-01','Mastered All Categories','Master of All','scholar.png','PARTICIPATION','',NULL,NULL,NULL,NULL),(10,'PTP-02','Mastered Abstract Factory Category','Abstract Master','abstract-shape.png','PARTICIPATION','',NULL,NULL,'ABSTRACT-FACTORY','CATEGORYGROUP'),(11,'PTP-03','Mastered Adapter Category','Adapter Master','adapter.png','PARTICIPATION','',NULL,NULL,'ADAPTER','CATEGORYGROUP'),(12,'PTP-04','Mastered Composite Category','Composite Master','composer.png','PARTICIPATION','',NULL,NULL,'COMPOSITE','CATEGORYGROUP'),(13,'PTP-05','Mastered Decorator Category','Decorator Master','decorator.png','PARTICIPATION','',NULL,NULL,'DECORATOR','CATEGORYGROUP'),(14,'PTP-06','Mastered Factory Method Category','Factory Method Master','factory.png','PARTICIPATION','',NULL,NULL,'FACTORY-METHOD','CATEGORYGROUP'),(15,'PTP-07','Mastered Observer Category','Observer Master','observer.png','PARTICIPATION','',NULL,NULL,'OBSERVER','CATEGORYGROUP'),(16,'PTP-08','Mastered Observer Category','Strategy Master','strategy.png','PARTICIPATION','',NULL,NULL,'STRATEGY','CATEGORYGROUP'),(17,'PTP-09','Mastered Template Method Category','Template Master','template.png','PARTICIPATION','',NULL,NULL,'TEMPLATE-METHOD','CATEGORYGROUP'),(18,'PTP-10','Reach 25 points overall','Approaching the base','25.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(19,'PTP-11','Reach 50 points overall','Halfway there','50.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(20,'PTP-12','Reach 100 points overall','Accomplished','100.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(21,'PTP-13','Reach 150 points overall','Still going?','hooked.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(22,'PTP-14','Reach 200 points overall','Programming Junkie','programming-junkie.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(23,'PTP-15','Reach 500 points overall','Programming Genius','programming-junkie.png','PARTICIPATION','',NULL,NULL,NULL,'REACHINGGROUP'),(24,'PTP-16','1st Question to be rejected by the admin','N O P E ','reject.png','PARTICIPATION','',NULL,NULL,NULL,NULL),(25,'SCA-01','Getting 5 replies to your forum post','Social','social.png','SOCIAL','',NULL,NULL,NULL,NULL),(26,'SCA-02','Posted 5 topics in forum','Conversationalist','forum.png','SOCIAL','',NULL,NULL,NULL,NULL),(27,'FNA-01','Get first achievement.','Baby Steps','climbing-stairs.png','FUN','',NULL,NULL,NULL,NULL),(28,'FNA-02','Get all the achievements.','The Curator','curator.png','FUN','',NULL,NULL,NULL,NULL),(29,'ARQ-01','Getting your first “5 star” rating','Five Stars','five-stars.png','RATINGS','',NULL,NULL,NULL,NULL),(30,'ARQ-02','1st Question rated','Rated','rated.png','RATINGS','',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `rewards` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-24 15:15:31
