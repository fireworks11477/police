-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: laboratory
-- ------------------------------------------------------
-- Server version	5.5.35-1ubuntu1

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
-- Current Database: `laboratory`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `laboratory` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `laboratory`;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Admin','admin','21232f297a57a5a743894a0e4a801fc3'),(2,'User','user','ee11cbb19052e40b07aac0ca060c23ee');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class`
--

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
INSERT INTO `class` VALUES (1,'实验一班'),(2,'实验二班');
/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `teacher` varchar(30) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `content` varchar(500) DEFAULT NULL,
  `open` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (1,'kecheng1','teacher1',1,'content1','ture'),(2,'kecheng2','teacher2',2,'content2','false'),(3,'kecheng3','teacher3',3,'content3','ture');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courseGrade`
--

DROP TABLE IF EXISTS `courseGrade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courseGrade` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `courseName` varchar(30) NOT NULL,
  `courseId` int(10) NOT NULL,
  `courseResult` varchar(1000) NOT NULL,
  `student` varchar(30) NOT NULL,
  `studentId` int(10) NOT NULL,
  `grade` int(3) DEFAULT NULL,
  `cost` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courseGrade`
--

LOCK TABLES `courseGrade` WRITE;
/*!40000 ALTER TABLE `courseGrade` DISABLE KEYS */;
INSERT INTO `courseGrade` VALUES (1,'kecheng1',1,'result1','student',1,91,100),(2,'kecheng2',2,'result2','student2',2,NULL,3000);
/*!40000 ALTER TABLE `courseGrade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ipAddress`
--

DROP TABLE IF EXISTS `ipAddress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ipAddress` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `ipAddress` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipAddress`
--

LOCK TABLES `ipAddress` WRITE;
/*!40000 ALTER TABLE `ipAddress` DISABLE KEYS */;
INSERT INTO `ipAddress` VALUES (1,'192.168.1.211'),(2,'127.0.0.1');
/*!40000 ALTER TABLE `ipAddress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scheduling`
--

DROP TABLE IF EXISTS `scheduling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scheduling` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `courseId` int(10) NOT NULL,
  `courseName` varchar(30) NOT NULL,
  `teacherId` varchar(10) NOT NULL,
  `startTime` int(20) NOT NULL,
  `endTime` int(20) NOT NULL,
  `className` varchar(30) NOT NULL,
  `classId` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scheduling`
--

LOCK TABLES `scheduling` WRITE;
/*!40000 ALTER TABLE `scheduling` DISABLE KEYS */;
INSERT INTO `scheduling` VALUES (1,1,'kecheng1','1',1451659500,1483285800,'实验一班',1),(4,1,'kecheng1','1',1459483620,1467259620,'实验二班',2);
/*!40000 ALTER TABLE `scheduling` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sqlCrontab`
--

DROP TABLE IF EXISTS `sqlCrontab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sqlCrontab` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sqlCrontab` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sqlCrontab`
--

LOCK TABLES `sqlCrontab` WRITE;
/*!40000 ALTER TABLE `sqlCrontab` DISABLE KEYS */;
INSERT INTO `sqlCrontab` VALUES (1,12);
/*!40000 ALTER TABLE `sqlCrontab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `number` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `class` int(5) NOT NULL,
  `password` varchar(32) NOT NULL,
  `open` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,1,'student',1,'cd73502828457d15655bbd7a63fb0bc8','ture'),(2,2,'student2',2,'202cb962ac59075b964b07152d234b70','false');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `open` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (1,'teacher','teacher','8d788385431273d11e8b43bb78f3aa41','ture'),(2,'teacher2','teacher2','ccffb0bb993eeb79059b31e1611ec353','false');
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-13  2:11:37
