-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: shirt
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `shirt_types`
--

DROP TABLE IF EXISTS `shirt_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shirt_types` (
  `shirt_type_id` int NOT NULL,
  `shirt_type_code` varchar(255) NOT NULL,
  `shirt_type_name` varchar(255) NOT NULL,
  `shelf_number` varchar(50) NOT NULL,
  `date_time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_time_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`shirt_type_id`),
  UNIQUE KEY `shirt_type_code` (`shirt_type_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shirt_types`
--

LOCK TABLES `shirt_types` WRITE;
/*!40000 ALTER TABLE `shirt_types` DISABLE KEYS */;
INSERT INTO `shirt_types` VALUES (1,'GRAPH','Graphic','10','2026-02-24 01:28:41','2026-02-24 01:28:41'),(2,'BTNUP','Button-Up','B2','2026-02-23 18:23:42','2026-02-23 18:23:42'),(3,'FLANN','Flannel','C3','2026-02-23 18:23:43','2026-02-23 18:23:43');
/*!40000 ALTER TABLE `shirt_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shirt_users`
--

DROP TABLE IF EXISTS `shirt_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shirt_users` (
  `shirt_user_id` int NOT NULL AUTO_INCREMENT,
  `email_address` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `pronouns` varchar(60) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `date_time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_time_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`shirt_user_id`),
  UNIQUE KEY `email_address` (`email_address`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shirt_users`
--

LOCK TABLES `shirt_users` WRITE;
/*!40000 ALTER TABLE `shirt_users` DISABLE KEYS */;
INSERT INTO `shirt_users` VALUES (1,'taylor@shirts.com','37a756a120a28e975adff45b86e984dbe2ae6d242d58af871833355d593117f4','She/Her','Taylor','Swift','555-1234','2026-02-11 02:34:55','2026-02-11 02:34:55'),(2,'paul@shirts.com','37a756a120a28e975adff45b86e984dbe2ae6d242d58af871833355d593117f4','He/Him','Paul','Sidoti','555-5678','2026-02-11 02:34:58','2026-02-11 02:34:58'),(3,'alex@shirts.com','37a756a120a28e975adff45b86e984dbe2ae6d242d58af871833355d593117f4','They/Them','Alex','Rivera','555-9012','2026-02-11 02:35:00','2026-02-11 02:35:00');
/*!40000 ALTER TABLE `shirt_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shirts`
--

DROP TABLE IF EXISTS `shirts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shirts` (
  `shirt_id` int NOT NULL,
  `shirt_code` varchar(10) NOT NULL,
  `shirt_name` varchar(255) NOT NULL,
  `shirt_description` text NOT NULL,
  `fabric_type` varchar(50) NOT NULL,
  `fit` varchar(60) NOT NULL,
  `shirt_type_id` int DEFAULT NULL,
  `buy_price` decimal(10,2) NOT NULL,
  `sell_price` decimal(10,2) NOT NULL,
  `date_time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_time_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`shirt_id`),
  UNIQUE KEY `shirt_code` (`shirt_code`),
  KEY `shirt_type_id` (`shirt_type_id`),
  CONSTRAINT `shirts_ibfk_1` FOREIGN KEY (`shirt_type_id`) REFERENCES `shirt_types` (`shirt_type_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shirts`
--

LOCK TABLES `shirts` WRITE;
/*!40000 ALTER TABLE `shirts` DISABLE KEYS */;
INSERT INTO `shirts` VALUES (1,'GR004','Premium Graphic Tee','A bold graphic tee for everyday wear. Super comfortable and easy to style.','Cotton','Regular',1,12.50,29.99,'2026-02-24 01:46:15','2026-02-24 01:46:15'),(2,'BU001','Classic Button-Up','A clean button-up that works casual or formal.','Oxford','Slim',2,15.00,35.00,'2026-02-23 18:24:12','2026-02-23 18:24:12'),(3,'FL001','Cozy Flannel','Warm flannel shirt for colder days.','Flannel','Relaxed',3,18.00,40.00,'2026-02-23 18:24:18','2026-02-23 18:24:18'),(4,'GR002','Street Graphic Tee','A bold streetwear graphic tee designed for everyday style and comfort. The soft cotton fabric makes it perfect for casual outfits.','Cotton','Regular',1,8.50,24.99,'2026-02-24 01:52:50','2026-02-24 01:52:50'),(5,'GR003','Vintage Print Tee','A vintage-inspired graphic tee that adds a retro vibe to any wardrobe. Built for comfort and long-lasting wear.','Cotton','Regular',1,9.00,26.99,'2026-02-24 01:52:53','2026-02-24 01:52:53'),(7,'GR005','Minimal Graphic Tee','A clean minimal graphic tee for a modern understated look. Lightweight and comfortable for daily wear.','Cotton','Regular',1,7.75,22.99,'2026-02-24 01:52:57','2026-02-24 01:52:57'),(8,'BU002','Slim Oxford Shirt','A slim-fit oxford shirt designed for both business and casual settings. Breathable fabric keeps you comfortable all day.','Oxford Cotton','Slim',2,18.00,49.99,'2026-02-24 01:53:32','2026-02-24 01:53:32'),(9,'BU003','Formal Dress Shirt','A crisp formal dress shirt ideal for professional environments. Designed with smooth fabric and a tailored silhouette.','Poly Cotton','Regular',2,20.00,54.99,'2026-02-24 01:53:35','2026-02-24 01:53:35'),(10,'BU004','Casual Chambray Shirt','A lightweight chambray button-up that works great for relaxed occasions. Durable stitching ensures long-term wear.','Chambray','Regular',2,17.50,44.99,'2026-02-24 01:53:37','2026-02-24 01:53:37'),(11,'BU005','Business Button-Up','A professional button-up shirt built for office environments. Comfortable fabric blend keeps you looking sharp.','Cotton Blend','Regular',2,19.00,52.99,'2026-02-24 01:53:38','2026-02-24 01:53:38'),(12,'FL002','Plaid Outdoor Flannel','A warm plaid flannel perfect for outdoor activities and colder weather. Soft brushed fabric provides excellent comfort.','Flannel','Relaxed',3,16.50,42.99,'2026-02-24 01:54:01','2026-02-24 01:54:01'),(13,'FL003','Heavyweight Flannel','A heavyweight flannel shirt designed for maximum warmth during winter. Durable construction makes it long lasting.','Flannel','Relaxed',3,18.00,48.99,'2026-02-24 01:54:02','2026-02-24 01:54:02'),(14,'FL004','Classic Lumberjack Flannel','A classic lumberjack-style flannel with timeless plaid patterns. Ideal for layering in cold weather.','Flannel','Regular',3,17.25,45.99,'2026-02-24 01:54:03','2026-02-24 01:54:03'),(15,'FL005','Soft Brushed Flannel','A soft brushed flannel shirt that delivers both warmth and comfort. Perfect for casual fall and winter outfits.','Flannel','Relaxed',3,15.75,39.99,'2026-02-24 01:54:04','2026-02-24 01:54:04');
/*!40000 ALTER TABLE `shirts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-23 21:11:14
