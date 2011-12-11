-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.58-1ubuntu1


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema academico
--

CREATE DATABASE IF NOT EXISTS academico;
USE academico;

--
-- Temporary table structure for view `academico`.`students`
--
DROP TABLE IF EXISTS `academico`.`students`;
DROP VIEW IF EXISTS `academico`.`students`;
CREATE TABLE `academico`.`students` (
  `id` int(11),
  `name` varchar(255),
  `type` varchar(150)
);
--
-- Create schema academico_test
--

CREATE DATABASE IF NOT EXISTS academico_test;
USE academico_test;

--
-- Temporary table structure for view `academico_test`.`students`
--
DROP TABLE IF EXISTS `academico_test`.`students`;
DROP VIEW IF EXISTS `academico_test`.`students`;
CREATE TABLE `academico_test`.`students` (
  `id` int(11),
  `name` varchar(255),
  `type` varchar(150)
);

--
-- Temporary table structure for view `academico_test`.`teachers`
--
DROP TABLE IF EXISTS `academico_test`.`teachers`;
DROP VIEW IF EXISTS `academico_test`.`teachers`;
CREATE TABLE `academico_test`.`teachers` (
  `id` int(11),
  `name` varchar(255),
  `type` varchar(150),
  `created_at` datetime,
  `updated_at` datetime
);
--
-- Create schema academico
--

CREATE DATABASE IF NOT EXISTS academico;
USE academico;

--
-- Definition of table `academico`.`accounts`
--

DROP TABLE IF EXISTS `academico`.`accounts`;
CREATE TABLE  `academico`.`accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider` varchar(100) DEFAULT NULL,
  `login` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `oauth_token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `person_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academico`.`accounts`
--

/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
LOCK TABLES `accounts` WRITE;
INSERT INTO `academico`.`accounts` VALUES  (1,'facebook','fabrizio','','','0000-00-00 00:00:00','0000-00-00 00:00:00',12),
 (2,'twitter','fabriziocolombo','','','0000-00-00 00:00:00','0000-00-00 00:00:00',12),
 (3,'erp','jms','123456','','0000-00-00 00:00:00','0000-00-00 00:00:00',11);
UNLOCK TABLES;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;


--
-- Definition of table `academico`.`customer`
--

DROP TABLE IF EXISTS `academico`.`customer`;
CREATE TABLE  `academico`.`customer` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academico`.`customer`
--

/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
LOCK TABLES `customer` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;


--
-- Definition of table `academico`.`enrollments`
--

DROP TABLE IF EXISTS `academico`.`enrollments`;
CREATE TABLE  `academico`.`enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `person_id` (`person_id`),
  CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academico`.`enrollments`
--

/*!40000 ALTER TABLE `enrollments` DISABLE KEYS */;
LOCK TABLES `enrollments` WRITE;
INSERT INTO `academico`.`enrollments` VALUES  (9,2010,12),
 (10,2011,12);
UNLOCK TABLES;
/*!40000 ALTER TABLE `enrollments` ENABLE KEYS */;


--
-- Definition of table `academico`.`people`
--

DROP TABLE IF EXISTS `academico`.`people`;
CREATE TABLE  `academico`.`people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `type` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `academico`.`people`
--

/*!40000 ALTER TABLE `people` DISABLE KEYS */;
LOCK TABLES `people` WRITE;
INSERT INTO `academico`.`people` VALUES  (10,'Maria',NULL),
 (11,'Joao','Teacher'),
 (12,'Fabrizio','Student'),
 (13,'test','Student');
UNLOCK TABLES;
/*!40000 ALTER TABLE `people` ENABLE KEYS */;


--
-- Definition of table `academico`.`product`
--

DROP TABLE IF EXISTS `academico`.`product`;
CREATE TABLE  `academico`.`product` (
  `category` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`category`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academico`.`product`
--

/*!40000 ALTER TABLE `product` DISABLE KEYS */;
LOCK TABLES `product` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;


--
-- Definition of table `academico`.`product_order`
--

DROP TABLE IF EXISTS `academico`.`product_order`;
CREATE TABLE  `academico`.`product_order` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `product_category` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`no`),
  KEY `product_category` (`product_category`,`product_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`product_category`, `product_id`) REFERENCES `product` (`category`, `id`) ON UPDATE CASCADE,
  CONSTRAINT `product_order_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academico`.`product_order`
--

/*!40000 ALTER TABLE `product_order` DISABLE KEYS */;
LOCK TABLES `product_order` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `product_order` ENABLE KEYS */;


--
-- Definition of table `academico`.`users`
--

DROP TABLE IF EXISTS `academico`.`users`;
CREATE TABLE  `academico`.`users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email_address` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academico`.`users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
LOCK TABLES `users` WRITE;
INSERT INTO `academico`.`users` VALUES  (1,'beau.frusetta@gmail.com'),
 (2,'beau.frusetta@gmail.com'),
 (3,'beau.frusetta@gmail.com'),
 (4,'beau.frusetta@gmail.com'),
 (5,'beau.frusetta@gmail.com'),
 (6,'beau.frusetta@gmail.com'),
 (7,'beau.frusetta@gmail.com'),
 (8,'fcm@unesc.net'),
 (9,'fabrizio@unesc.net');
UNLOCK TABLES;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Create schema academico_test
--

CREATE DATABASE IF NOT EXISTS academico_test;
USE academico_test;

--
-- Definition of table `academico_test`.`accounts`
--

DROP TABLE IF EXISTS `academico_test`.`accounts`;
CREATE TABLE  `academico_test`.`accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider` varchar(100) DEFAULT NULL,
  `login` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `oauth_token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `person_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academico_test`.`accounts`
--

/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
LOCK TABLES `accounts` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;


--
-- Definition of table `academico_test`.`enrollments`
--

DROP TABLE IF EXISTS `academico_test`.`enrollments`;
CREATE TABLE  `academico_test`.`enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `new_fk_constraint` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academico_test`.`enrollments`
--

/*!40000 ALTER TABLE `enrollments` DISABLE KEYS */;
LOCK TABLES `enrollments` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `enrollments` ENABLE KEYS */;


--
-- Definition of table `academico_test`.`people`
--

DROP TABLE IF EXISTS `academico_test`.`people`;
CREATE TABLE  `academico_test`.`people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academico_test`.`people`
--

/*!40000 ALTER TABLE `people` DISABLE KEYS */;
LOCK TABLES `people` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `people` ENABLE KEYS */;


--
-- Definition of table `academico_test`.`phone_carrier`
--

DROP TABLE IF EXISTS `academico_test`.`phone_carrier`;
CREATE TABLE  `academico_test`.`phone_carrier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `txt_address` varchar(150) DEFAULT NULL,
  `txt_message_length` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academico_test`.`phone_carrier`
--

/*!40000 ALTER TABLE `phone_carrier` DISABLE KEYS */;
LOCK TABLES `phone_carrier` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `phone_carrier` ENABLE KEYS */;


--
-- Definition of table `academico_test`.`schools`
--

DROP TABLE IF EXISTS `academico_test`.`schools`;
CREATE TABLE  `academico_test`.`schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academico_test`.`schools`
--

/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
LOCK TABLES `schools` WRITE;
INSERT INTO `academico_test`.`schools` VALUES  (1,'UNESC');
UNLOCK TABLES;
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;


--
-- Definition of table `academico_test`.`users`
--

DROP TABLE IF EXISTS `academico_test`.`users`;
CREATE TABLE  `academico_test`.`users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email_address` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academico_test`.`users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
LOCK TABLES `users` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Create schema academico
--

CREATE DATABASE IF NOT EXISTS academico;
USE academico;

--
-- Definition of view `academico`.`students`
--

DROP TABLE IF EXISTS `academico`.`students`;
DROP VIEW IF EXISTS `academico`.`students`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `academico`.`students` AS select `academico`.`people`.`id` AS `id`,`academico`.`people`.`name` AS `name`,`academico`.`people`.`type` AS `type` from `academico`.`people` where (`academico`.`people`.`type` = 'Student');
--
-- Create schema academico_test
--

CREATE DATABASE IF NOT EXISTS academico_test;
USE academico_test;

--
-- Definition of view `academico_test`.`students`
--

DROP TABLE IF EXISTS `academico_test`.`students`;
DROP VIEW IF EXISTS `academico_test`.`students`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `academico_test`.`students` AS select `academico_test`.`people`.`id` AS `id`,`academico_test`.`people`.`name` AS `name`,`academico_test`.`people`.`type` AS `type` from `academico_test`.`people` where (`academico_test`.`people`.`type` = 'Student');

--
-- Definition of view `academico_test`.`teachers`
--

DROP TABLE IF EXISTS `academico_test`.`teachers`;
DROP VIEW IF EXISTS `academico_test`.`teachers`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `academico_test`.`teachers` AS select `academico_test`.`people`.`id` AS `id`,`academico_test`.`people`.`name` AS `name`,`academico_test`.`people`.`type` AS `type`,`academico_test`.`people`.`created_at` AS `created_at`,`academico_test`.`people`.`updated_at` AS `updated_at` from `academico_test`.`people` where (`academico_test`.`people`.`type` = 'teacher');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
