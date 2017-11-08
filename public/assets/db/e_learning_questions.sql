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
  `is_verified` int(1) NOT NULL,
  `question_code` varchar(10) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'<div><!--block-->Who is the current president of the Philippines?</div>','President','ADAPTER','MULTIPLE_CHOICE',0,'Q0103-001',1,'2017-11-03 01:34:21','2017-11-03 01:34:21'),(3,'<div><!--block-->Who is the founder of facebook?</div>','Social Media','COMPOSITE','MULTIPLE_CHOICE',0,'Q0103-002',1,'2017-11-03 01:43:21','2017-11-03 01:43:21'),(4,'<div><!--block-->I have something to share<br><br></div><blockquote><pre><!--block-->sds</pre></blockquote>','what is decorator?','DECORATOR','IDENTIFICATION',0,'Q0103-003',1,'2017-11-03 02:48:39','2017-11-03 02:48:39'),(5,'<blockquote><!--block--><strong><em><del>Question desc</del></em></strong></blockquote>','Lastest Adapter','ADAPTER','IDENTIFICATION',0,'Q0103-004',1,'2017-11-06 23:36:08','2017-11-06 23:36:08'),(6,'<pre><!--block--><em><del>2nd Adapter</del></em></pre>','2nd Adapter','ADAPTER','IDENTIFICATION',0,'Q0103-005',1,'2017-11-07 00:48:39','2017-11-07 00:48:39'),(7,'<div><!--block-->sd</div>','test_01','ADAPTER','CODING',0,'Q0101-0001',1,'2017-11-07 23:49:07','2017-11-07 23:49:07'),(8,'<div><!--block-->do you really like her?</div>','rom','ADAPTER','CODING',0,'Q0101-0002',1,'2017-11-08 00:20:24','2017-11-08 00:20:24'),(9,'<div><!--block-->do you think</div>','rom','ADAPTER','CODING',0,'Q0101-0003',2,'2017-11-08 00:22:11','2017-11-08 00:22:11'),(10,'<div><!--block-->asdf</div>','asdf','ADAPTER','CODING',0,'Q0101-0004',2,'2017-11-08 01:03:42','2017-11-08 01:03:42');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
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
