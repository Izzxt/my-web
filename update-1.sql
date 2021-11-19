-- MySQL dump 10.19  Distrib 10.3.31-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: my_web
-- ------------------------------------------------------
-- Server version	10.3.31-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'NULL',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'NULL',
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'NULL',
  `create_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'admin','Admin 1','admin@test.com','$2y$10$a4OsBWyAU22APKqaIAdYHepcshoGTkdvavKOwEY7F297YBjVHP6ne','01589347432','NULL','NULL','1637335990','1637335990'),(2,'izzat','admin 2','admin2@test.com','$2y$10$WFJGwWKv6kU6UFZUS35FxuuAlRSUuA.UQCAtenFLym0FtQz1yO/f.','01283490864','NULL','NULL','1637336034','1637336034');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

--
-- Table structure for table `customer_cart`
--

DROP TABLE IF EXISTS `customer_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `customer_id` int(11) DEFAULT NULL,
  `code_product` varchar(255) DEFAULT 'NULL',
  `quantity` double(11,2) DEFAULT NULL,
  `total_price` double(11,2) DEFAULT NULL,
  `create_date` varchar(255) DEFAULT NULL COMMENT 'Create Time',
  `update_date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_cart`
--

/*!40000 ALTER TABLE `customer_cart` DISABLE KEYS */;
INSERT INTO `customer_cart` VALUES (19,2,'D04',3.00,20.97,'1637338203','1637339057'),(20,2,'D03',3.00,8.97,'1637338207','1637339054'),(21,2,'D02',3.00,14.97,'1637338209','1637339055'),(22,2,'D01',2.00,19.98,'1637338210','1637339054'),(47,1,'D04',1.00,6.99,'1637339068','1637339068'),(48,1,'D03',1.00,2.99,'1637339072','1637339072'),(49,1,'D02',1.00,4.99,'1637339074','1637339074'),(50,1,'D01',1.00,9.99,'1637339076','1637339076');
/*!40000 ALTER TABLE `customer_cart` ENABLE KEYS */;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `customer_id` int(11) DEFAULT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `code_product` varchar(255) DEFAULT 'NULL',
  `shipping_address` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `total_price` double(11,2) DEFAULT NULL,
  `payment_status` enum('unpaid','paid') DEFAULT 'unpaid',
  `payment_type` varchar(255) DEFAULT NULL,
  `status` enum('pending','done') DEFAULT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `product_name` varchar(255) DEFAULT NULL,
  `code_product` varchar(255) DEFAULT NULL,
  `price` double(11,2) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `update_date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Air Kelapa','D01',9.99,'./assets/images/air-1.jpg',NULL,NULL,NULL),(2,'Air Milo','D02',4.99,'milo',NULL,NULL,NULL),(3,'Air Tea','D03',2.99,'tea',NULL,NULL,NULL),(4,'Air Oren','D04',6.99,'oren',NULL,NULL,NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-20  0:34:17
