-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: cpesd-is
-- ------------------------------------------------------
-- Server version 	10.4.28-MariaDB
-- Date: Sun, 30 Apr 2023 05:14:03 +0000

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_logs`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_logs` (
  `activity_log_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `action` tinytext NOT NULL,
  `activity_log_created` datetime NOT NULL,
  PRIMARY KEY (`activity_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `activity_logs` with 0 row(s)
--

--
-- Table structure for table `cso`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cso` (
  `cso_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `cso_code` varchar(50) NOT NULL,
  `cso_name` varchar(150) NOT NULL,
  `purok_number` varchar(50) NOT NULL,
  `barangay` varchar(150) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `telephone_number` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `type_of_cso` varchar(50) NOT NULL,
  `cso_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `cor` varchar(150) NOT NULL,
  `bylaws` varchar(200) NOT NULL,
  `aoc/aoi` varchar(200) NOT NULL,
  `other_docs` varchar(200) NOT NULL,
  `cso_created` datetime NOT NULL,
  PRIMARY KEY (`cso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cso`
--

LOCK TABLES `cso` WRITE;
/*!40000 ALTER TABLE `cso` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `cso` VALUES (1,'001','Apil Farmers Association','','Apil','','09','','','PO','active','','','','','2023-04-27 17:09:53'),(2,'002','Apil Peace-Building Mission Association','','Apil','','09','','','PO','active','','','','','2023-04-27 18:17:42'),(3,'005','Bolibol Farmers Association','','Bolibol','','09','','','PO','active','','','','','2023-04-27 18:31:18'),(4,'006 ','Buenavista Farmers Association','','Buenavista','','09','','','PO','active','','','','','2023-04-27 18:43:03'),(5,'007','Buntawan Farmers Association','','Buenavista','','09','','','PO','active','','','','','2023-04-27 18:43:47'),(6,'008','Burgos Livelihood Association','','Burgos','','09','','','PO','active','','','','','2023-04-27 18:44:24'),(7,'009','Camubay Fishermens Association','','Canubay','','09','','','PO','active','','','','','2023-04-27 18:45:27'),(8,'010','Canubay Dried Squid Association','','Canubay','','09','','','PO','active','','','','','2023-04-27 18:46:03'),(9,'011','Clarin Settlement Producers Association','','Clarin Settlement','','09','','','PO','active','','','','','2023-04-27 18:49:27'),(10,'012','Dolipos Alto Vegetables Growers Association','','Dolipos Alto','','09','','','PO','active','','','','','2023-04-27 18:50:17'),(11,'013','Dolipos Bajo Farmers Association','','Dolipos Bajo','','09','','','PO','active','','','','','2023-04-27 18:51:43'),(12,'014','Dullan Sur Farmers Association','','Dullan Sur','','09','','','PO','active','','','','','2023-04-27 18:52:50'),(13,'016','Lower Lancangan Livelihood Women Association','','Lower Langcangan','','09','','','PO','active','','','','','2023-04-27 18:56:38'),(14,'017','Mobod Coastal Tourism Association','','Mobod','','09','','','PO','active','','','','','2023-04-27 18:58:05'),(15,'024','Paypayan Farmers Association','','Paypayan','','09','','','PO','active','','','','','2023-04-27 20:16:27'),(16,'025','San Vicente Bajo Fisherman Association','','San Vicente Bajo','','09','','','PO','active','','','','','2023-04-27 20:17:03'),(17,'026','Senote Livelihood Association','','Senote','','09','','','PO','active','','','','','2023-04-27 20:17:59'),(18,'027','Taboc Norte Fisherfolks Association','','Taboc Norte','','09','','','PO','active','','','','','2023-04-27 20:18:49'),(19,'028','Talairon Livelihood Association','','Talairon','','09','','','PO','active','','','','','2023-04-27 20:19:48'),(20,'029','Talic Farmers Association','','Talic','','09','','','PO','active','','','','','2023-04-27 20:20:15'),(21,'030','Tipan Consumers Association','','Tipan','','09','','','PO','active','','','','','2023-04-27 20:20:47'),(22,'031','Tipan Fisherfolks Association','','Tipan','','09','','','PO','active','','','','','2023-04-27 20:22:00'),(23,'035','Dullan Sur Womens Association','','Dullan Sur','','09','','','PO','active','','','','','2023-04-27 20:23:12'),(24,'037','Binuangan Cutflower Growers Association','','Binuangan','','09','','','PO','active','','','','','2023-04-27 20:24:05'),(25,'039','Villaflor Swine Raisers Association','','Villaflor','','09','','','PO','active','','','','','2023-04-27 20:24:43'),(26,'047','Senote Women\'s Association','','Senote','','09','','','PO','active','','','','','2023-04-27 20:25:58'),(27,'048','Dolipos Bajo Women\'s Association','','Dolipos Bajo','','09','','','PO','active','','','','','2023-04-27 20:26:36'),(28,'049','Dulapo Fisherfolks Association','','Dulapo','','09','','','PO','active','','','','','2023-04-27 20:27:09'),(29,'053','Pines Nursery Association','','Pines','','09','','','PO','active','','','','','2023-04-27 20:28:51'),(30,'054','Clarin Settlement Corn Dream Growers Association','','Clarin Settlement','','09','','','PO','active','','','','','2023-04-27 20:29:45'),(31,'055','Pines Fishermans Association','','Pines','','09','','','PO','active','','','','','2023-04-27 20:30:38'),(32,'056','Taboc Sur Fishermens Association','','Taboc Sur','','09','','','PO','active','','','','','2023-04-27 20:31:28'),(33,'057','Mobod Fisherfolks Association','','Mobod','','09','','','PO','active','','','','','2023-04-27 20:32:17'),(34,'060','Womens Association of Brgy. Buenavista','','Buenavista','','09','','','PO','active','','','','','2023-04-27 20:33:19'),(35,'061','Tipan Fisherpods Association','','Tipan','','09','','','PO','active','','','','','2023-04-27 20:34:02'),(36,'062','Toliyok Womens Association','','Toliyok','','09','','','PO','active','','','','','2023-04-27 20:34:42'),(37,'063','Tipan Crop Growers Association','','Tipan','','09','','','PO','active','','','','','2023-04-27 20:35:34'),(38,'067','Poblacion 1 Motorcab Owners & Drivers Association','','Poblacion 1','','09','','','PO','active','','','','','2023-04-27 20:37:28'),(39,'069','Tuyabang Alto Womens Association','','Tuyabang Alto','','09','','','PO','active','','','','','2023-04-27 20:39:06'),(40,'073','Barangay Bolibol Womens Association','','Bolibol','','09','','','PO','active','','','','','2023-04-27 20:40:04'),(41,'078','Poblacion I Fisherfolks Association, Inc','','Poblacion 1','','09','','','PO','active','','','','','2023-04-27 20:41:30'),(42,'082','Bunga Child Labor Association','','Bunga','','09','','','PO','active','','','','','2023-04-27 20:42:21'),(43,'084','Upper Lamac Water Consumers Association','','Upper Lamac','','09','','','PO','active','','','','','2023-04-27 20:43:09'),(44,'089','Dolipos Alto Farmers Association','','Dolipos Alto','','09','','','PO','active','','','','','2023-04-27 20:44:28'),(45,'092','Malindang Farmers Association','','Malindang','','09','','','PO','active','','','','','2023-04-27 20:45:09'),(46,'093','Talairon Womens Association','','Talairon','','09','','','PO','active','','','','','2023-04-27 20:45:41'),(47,'095','Tipan-Parents-Children Association','','Tipan','','09','','','PO','active','','','','','2023-04-27 20:47:06'),(49,'004','','','','','09','','','','active','','','','','2023-04-27 21:30:33'),(50,'003','Badjao Association for Poverty Alleviation','','','','09','','','','active','','','','','2023-04-27 21:33:07'),(51,'015','Jasys Workers Association','','','','09','','','','active','','','','','2023-04-27 21:33:44'),(52,'018','Oroquieta Bus Terminal Vendors Association','','','','09','','','PO','active','','','','','2023-04-27 21:34:44'),(53,'019','Oroquieta City Balot Vendors Association','','','','09','','','PO','active','','','','','2023-04-27 21:35:46'),(54,'020','Oroquieta City Sidewalk Vendors Association','','','','09','','','PO','active','','','','','2023-04-27 21:36:25'),(55,'021','Oroquieta City Sikad Operators & Drivers Association','','','','09','','','PO','active','','','','','2023-04-27 21:37:10'),(56,'022','Oroquieta Flower Garden Association','','','','09','','','PO','active','','','','','2023-04-27 21:38:00'),(57,'023','Oroquieta Goldenhands for Health & Welness Association , Inc','','','','09','','','PO','active','','','','','2023-04-27 21:38:48'),(58,'032','Upper Rizal Small Coconut Farmers Organization','','','','09','','','','active','','','','','2023-04-27 21:39:23'),(59,'033','Verdant Hills Farmers Association','','','','09','','','','active','','','','','2023-04-27 21:39:53'),(60,'034','Binuangan Small Coconut Farmers Organization','','Binuangan','','09','','','','active','','','','','2023-04-27 21:40:45'),(61,'036','Oroquieta Public Market Laborers Association','','','','09','','','PO','active','','','','','2023-04-27 21:41:35'),(62,'038','Federated Womens Organization','','','','09','','','PO','active','','','','','2023-04-27 21:42:47'),(63,'040','Bunotex Employees Livelihood & Industrial Project Association','','','','09','','','','active','','','','','2023-04-27 21:44:00'),(64,'041','Purok 1 Mabinati-on Association','','','','09','','','PO','active','','','','','2023-04-27 21:44:59'),(65,'042','Brgy. Tipan Leader Organization','','','','09','','','','active','','','','','2023-04-27 21:45:33'),(66,'043','','','','','09','','','','active','','','','','2023-04-27 21:46:07'),(67,'044','New Alliance for Good Oroquieta','','','','09','','','','active','','','','','2023-04-27 21:46:32'),(68,'045','Oroquieta City People\'s Alliance for Progress','','','','09','','','','active','','','','','2023-04-27 21:47:18'),(69,'046','Oroquieta City People\'s Organization for Livelihood Program','','','','09','','','','active','','','','','2023-04-27 21:47:57'),(70,'050','Pamilya Uswag Gugma Alang sa Tanan Association','','','','09','','','PO','active','','','','','2023-04-27 21:55:49'),(71,'051','Oroquieta City Agrarian Reform Beneficiaries Association','','','','09','','','PO','active','','','','','2023-04-27 21:56:48'),(72,'052','Oroquieta City Cutflowers Growers & Vendors Association','','','','09','','','PO','active','','','','','2023-04-27 21:58:02'),(73,'058','Manuel L. Quezon Port Employees & Fisherman Association','','','','09','','','PO','active','','','','','2023-04-27 21:58:49'),(74,'059','Dagatan Fisherman Association','','','','09','','','PO','active','','','','','2023-04-27 21:59:22'),(75,'064','Community Participation Action Research Farmers Association','','','','09','','','PO','active','','','','','2023-04-27 22:00:32'),(76,'065','Association of Bantay Dangan Volunteers','','','','09','','','PO','active','','','','','2023-04-27 22:01:06'),(77,'066','Oroquieta City Community Affairs for Reform & Development Programs','','','','09','','','','active','','','','','2023-04-27 22:02:03'),(78,'068','Oroquieta Halang Halang Vendors Association','','','','09','','','PO','active','','','','','2023-04-27 22:02:49'),(79,'070','Oroquieta City Downtown Express Association','','','','09','','','PO','active','','','','','2023-04-27 22:03:35'),(80,'071','Womens in Government Service Association of Oroquieta City , Inc.','','','','09','','','PO','active','','','','','2023-04-27 22:04:32'),(81,'072','Goodlife Rubber Producers Association','','','','09','','','PO','active','','','','','2023-04-27 22:05:04'),(82,'074','Youth Leadership Program - Oroquieta City Youth Group Inc.','','','','09','','','','active','','','','','2023-04-27 22:06:12'),(83,'075','Mialen, Toliyok , Bunga, Sebucal, Villaflor, Clarin Settlement(MITOBUSVIC)','','','','09','','','','active','','','','','2023-04-27 22:07:40'),(84,'076','Federation of Senior Citizens of Oroquieta City, Inc.','','','','09','','','','active','','','','','2023-04-27 22:08:35'),(85,'077','Oroquieta Town Center Stall Owners Association, Inc','','','','09','','','PO','active','','','','','2023-04-27 22:09:32'),(86,'079','Misamis Occidental Mangrove Management Association Inc.','','','','09','','','PO','active','','','','','2023-04-27 22:10:22'),(87,'080','Tuyabang Alto Small Coconut Farmers Organization','','Tuyabang Alto','','09','','','','active','','','','','2023-04-27 22:11:06'),(88,'081','Oroquieta City Coconut Farmers Association','','','','09','','','PO','active','','','','','2023-04-27 22:11:51'),(89,'083','Organization of Quarista in Barangay Toliok','','Toliyok','','09','','','','active','','','','','2023-04-27 22:12:37'),(90,'085','Lumad nga Mag-uuma sa Sebucal Inc','','Sebucal','','09','','','','active','','','','','2023-04-27 22:13:27'),(91,'086','Oroquieta City Bamboocraft Producers Association','','','','09','','','PO','active','','','','','2023-04-27 22:14:06'),(92,'087','Toliyok-Senote-Villaflor Community Swine Raisers Association','','','','09','','','PO','active','','','','','2023-04-27 22:15:38'),(93,'088','Oroquieta City Differently Abled Person Association, Inc','','','','09','','','PO','active','','','','','2023-04-27 22:18:31'),(94,'090','','','','','09','','','','active','','','','','2023-04-27 22:18:45'),(95,'091','Oroquieta City Community Volunteer Health Workers Association Inc','','','','09','','','PO','active','','','','','2023-04-27 22:19:29'),(96,'096','City Plaza Vendors Association','','','','09','','','PO','active','','','','','2023-04-27 22:21:55'),(97,'097','Association of Building Officials of Misamis Occidental Inc.','','','','09','','','PO','active','','','','','2023-04-27 22:22:30'),(98,'098','Hugpong sa mga Barangay of Oroquieta City Inc.','','','','09','','','','active','','','','','2023-04-27 22:34:30'),(99,'099','Misamis Occidental Tourism Officers Association, Inc','','','','09','','','PO','active','','','','','2023-04-27 22:35:18'),(100,'100','Caluya Floating Cottage Operators Association, Inc','','','','09','','','PO','active','','','','','2023-04-27 22:36:07'),(101,'101','Association of Barangay Captain of Sapang Dalaga Inc.','','','','09','','','PO','active','','','','','2023-04-27 22:37:44'),(102,'102','Magapangi Irrigators Association for Sustainable Livelihood Inc','','','','09','','','','active','','','','','2023-04-27 22:39:19'),(103,'103','Kausaban, Ampingan, Ugmaron, Batukan, ang Naagian (KAUBAN) Association','','','','09','','','','active','','','','','2023-04-27 22:40:18'),(104,'104','Carrer Advocates and Public Employment Service Officers of Misamis Occidental','','','','09','','','','active','','','','','2023-04-27 22:41:14'),(105,'105','Kuyog(Kalisud Sulbaron, Uswagon ang Kinabuhi, Yawi sa Panginabuhi, Otung sa Buh)','','','','09','','','','active','','','','','2023-04-27 22:42:31'),(106,'106','Naghiusang Lumad nga Mag-uuma sa Sebucal','','','','09','','','','active','','','','','2023-04-27 22:43:09'),(107,'107','Association of Coco Pilots of Oroquieta City','','','','09','','','PO','active','','','','','2023-04-27 22:43:42'),(108,'108','Oroquieta City Tennis Club Inc.','','','','09','','','','active','','','','','2023-04-27 22:44:04'),(109,'109','Talic Livelihood Association','','','','09','','','PO','active','','','','','2023-04-27 22:44:31'),(110,'110','Service Advocates and Volunteers for Environment(SAVE)','','','','09','','','','active','','','','','2023-04-27 22:49:21'),(111,'111','Meat Vendors Association','','','','09','','','PO','active','','','','','2023-04-27 22:49:41'),(112,'112','Music Enthusiasts Club in Oroquieta ','','','','09','','','','active','','','','','2023-04-27 22:50:41');
/*!40000 ALTER TABLE `cso` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `cso` with 111 row(s)
--

--
-- Table structure for table `cso_officers`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cso_officers` (
  `cso_officer_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `position_number` int(10) NOT NULL,
  `cso_position` varchar(150) NOT NULL,
  `officer_cso_id` int(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `extension` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `cso_officer_created` datetime NOT NULL,
  PRIMARY KEY (`cso_officer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cso_officers`
--

LOCK TABLES `cso_officers` WRITE;
/*!40000 ALTER TABLE `cso_officers` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `cso_officers` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `cso_officers` with 0 row(s)
--

--
-- Table structure for table `migrations`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `migrations` with 0 row(s)
--

--
-- Table structure for table `project_monitoring`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_monitoring` (
  `project_monitoring_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `project_transact_id` int(20) NOT NULL,
  `project_title` varchar(150) NOT NULL,
  `period` datetime NOT NULL,
  `attendance_present` int(50) NOT NULL,
  `attendance_absent` int(150) NOT NULL,
  `nom_borrowers_delinquent` int(150) NOT NULL,
  `nom_borrowers_overdue` int(150) NOT NULL,
  `total_production` int(150) NOT NULL,
  `total_collection_sales` decimal(10,2) NOT NULL,
  `total_released_purchases` decimal(10,2) NOT NULL,
  `total_delinquent_account` decimal(10,2) NOT NULL,
  `total_over_due_account` decimal(10,2) NOT NULL,
  `cash_in_bank` decimal(10,2) NOT NULL,
  `cash_on_hand` decimal(10,2) NOT NULL,
  `inventories` decimal(10,2) NOT NULL,
  PRIMARY KEY (`project_monitoring_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_monitoring`
--

LOCK TABLES `project_monitoring` WRITE;
/*!40000 ALTER TABLE `project_monitoring` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `project_monitoring` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `project_monitoring` with 0 row(s)
--

--
-- Table structure for table `responsibility_center`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responsibility_center` (
  `responsibility_center_id` int(20) NOT NULL AUTO_INCREMENT,
  `responsibility_center_code` varchar(50) NOT NULL,
  `responsibility_center_name` varchar(150) NOT NULL,
  `responsibility_created` datetime NOT NULL,
  PRIMARY KEY (`responsibility_center_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsibility_center`
--

LOCK TABLES `responsibility_center` WRITE;
/*!40000 ALTER TABLE `responsibility_center` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `responsibility_center` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `responsibility_center` with 0 row(s)
--

--
-- Table structure for table `responsible_section`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responsible_section` (
  `responsible_section_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `responsible_section_name` varchar(150) NOT NULL,
  `responsible_section_created` datetime NOT NULL,
  PRIMARY KEY (`responsible_section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsible_section`
--

LOCK TABLES `responsible_section` WRITE;
/*!40000 ALTER TABLE `responsible_section` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `responsible_section` VALUES (1,'Cooperative & Livelihood','2023-04-27 23:01:37'),(2,'Employment','2023-04-27 23:01:49'),(3,'Manpower Dev\'t','2023-04-27 23:02:01');
/*!40000 ALTER TABLE `responsible_section` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `responsible_section` with 3 row(s)
--

--
-- Table structure for table `rfa_clients`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rfa_clients` (
  `rfa_client_id` int(30) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `purok` int(10) DEFAULT NULL,
  `barangay` varchar(100) NOT NULL,
  `contact_number` int(50) DEFAULT NULL,
  `age` int(20) NOT NULL,
  `employment_status` varchar(150) NOT NULL,
  `rfa_client_created` datetime NOT NULL,
  `rfa_client_added_by` int(50) NOT NULL,
  PRIMARY KEY (`rfa_client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rfa_clients`
--

LOCK TABLES `rfa_clients` WRITE;
/*!40000 ALTER TABLE `rfa_clients` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `rfa_clients` VALUES (1,'Basil','','Manabo','',2,'Bolibol',2147483647,12,'employed','2023-04-30 04:48:58',9);
/*!40000 ALTER TABLE `rfa_clients` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `rfa_clients` with 1 row(s)
--

--
-- Table structure for table `rfa_transactions`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rfa_transactions` (
  `rfa_id` int(20) NOT NULL AUTO_INCREMENT,
  `rfa_tracking_code` varchar(100) NOT NULL,
  `client_id` int(20) NOT NULL,
  `rfa_created_by` int(30) NOT NULL,
  `tor_id` int(20) NOT NULL,
  `type_of_transaction` enum('simple','complex') DEFAULT NULL,
  `number` int(30) NOT NULL,
  `rfa_status` set('pending','completed') NOT NULL,
  `rfa_date_filed` datetime NOT NULL,
  `action_taken` text NOT NULL,
  `reffered_to` int(11) DEFAULT NULL,
  `reffered_date_and_time` datetime NOT NULL,
  `action_to_be_taken` text DEFAULT NULL,
  `action_to_be_taken_date_time` datetime NOT NULL,
  `accomplished_status` int(1) NOT NULL,
  `approved_date` datetime NOT NULL,
  PRIMARY KEY (`rfa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rfa_transactions`
--

LOCK TABLES `rfa_transactions` WRITE;
/*!40000 ALTER TABLE `rfa_transactions` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `rfa_transactions` VALUES (2,'971897773202304301',1,9,2,'complex',1,'pending','2023-04-30 05:03:28','',NULL,'0000-00-00 00:00:00',NULL,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `rfa_transactions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `rfa_transactions` with 1 row(s)
--

--
-- Table structure for table `rfa_transaction_history`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rfa_transaction_history` (
  `history_id` int(20) NOT NULL AUTO_INCREMENT,
  `track_code` varchar(50) NOT NULL,
  `received_by` int(20) NOT NULL,
  `received_date_and_time` datetime NOT NULL,
  `action_taken` text NOT NULL,
  `referred_to` int(20) DEFAULT NULL,
  `reffered_date_and_time` datetime NOT NULL,
  `action_to_be_taken` text NOT NULL,
  `rfa_tracking_status` enum('received','to-complete','completed') DEFAULT NULL,
  `release_status` int(1) NOT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rfa_transaction_history`
--

LOCK TABLES `rfa_transaction_history` WRITE;
/*!40000 ALTER TABLE `rfa_transaction_history` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `rfa_transaction_history` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `rfa_transaction_history` with 0 row(s)
--

--
-- Table structure for table `trainings`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainings` (
  `training_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `training_transact_id` int(20) NOT NULL,
  `title_of_training` varchar(150) NOT NULL,
  `number_of_participants` int(50) NOT NULL,
  `female` int(50) NOT NULL,
  `overall_ratings` varchar(150) NOT NULL,
  `name_of_trainor` varchar(150) NOT NULL,
  `training_created` datetime NOT NULL,
  PRIMARY KEY (`training_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainings`
--

LOCK TABLES `trainings` WRITE;
/*!40000 ALTER TABLE `trainings` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `trainings` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `trainings` with 0 row(s)
--

--
-- Table structure for table `transactions`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `transaction_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `created_by` int(50) NOT NULL,
  `number` int(150) NOT NULL,
  `date_and_time_filed` datetime NOT NULL,
  `responsible_section_id` int(150) NOT NULL,
  `type_of_activity_id` int(150) NOT NULL,
  `under_type_of_activity_id` int(150) DEFAULT NULL,
  `responsibility_center_id` int(150) NOT NULL,
  `date_and_time` datetime NOT NULL,
  `cso_Id` int(150) NOT NULL,
  `is_project_monitoring` int(11) NOT NULL,
  `is_training` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `transaction_status` enum('pending','completed') NOT NULL,
  `action_taken_date` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `transactions` with 0 row(s)
--

--
-- Table structure for table `type_of_activities`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_of_activities` (
  `type_of_activity_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `type_of_activity_name` varchar(150) NOT NULL,
  `type_act_created` datetime NOT NULL,
  PRIMARY KEY (`type_of_activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_of_activities`
--

LOCK TABLES `type_of_activities` WRITE;
/*!40000 ALTER TABLE `type_of_activities` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `type_of_activities` VALUES (1,'Regular Monthly Meeting','2023-04-27 23:11:32'),(2,'Regular Monthly COOP Visit','2023-04-27 23:11:53'),(3,'Job Vacancy Solicitation','2023-04-27 23:12:04'),(4,'Regular Monthly Project Monitoring','2023-04-27 23:12:25'),(5,'Training','2023-04-27 23:12:31');
/*!40000 ALTER TABLE `type_of_activities` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `type_of_activities` with 5 row(s)
--

--
-- Table structure for table `type_of_request`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_of_request` (
  `type_of_request_id` int(20) NOT NULL AUTO_INCREMENT,
  `type_of_request_name` varchar(150) NOT NULL,
  `type_of_request_created` datetime NOT NULL,
  PRIMARY KEY (`type_of_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_of_request`
--

LOCK TABLES `type_of_request` WRITE;
/*!40000 ALTER TABLE `type_of_request` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `type_of_request` VALUES (1,'sample1','2023-04-30 04:44:04'),(2,'sample2','2023-04-30 04:44:08'),(3,'sample3','2023-04-30 04:44:12');
/*!40000 ALTER TABLE `type_of_request` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `type_of_request` with 3 row(s)
--

--
-- Table structure for table `under_type_of_activity`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `under_type_of_activity` (
  `under_type_act_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `typ_ac_id` int(50) NOT NULL,
  `under_type_act_name` varchar(150) NOT NULL,
  `under_type_act_created` datetime NOT NULL,
  PRIMARY KEY (`under_type_act_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `under_type_of_activity`
--

LOCK TABLES `under_type_of_activity` WRITE;
/*!40000 ALTER TABLE `under_type_of_activity` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `under_type_of_activity` VALUES (1,5,'SKL','2023-04-27 23:12:41'),(2,5,'MDT','2023-04-27 23:12:45'),(3,5,'CD','2023-04-27 23:12:48'),(4,5,'PRS','2023-04-27 23:12:51');
/*!40000 ALTER TABLE `under_type_of_activity` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `under_type_of_activity` with 4 row(s)
--

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `contact_number` varchar(10) NOT NULL,
  `address` varchar(150) NOT NULL,
  `email_address` varchar(10) NOT NULL,
  `profile_pic` varchar(50) DEFAULT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `username` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_created` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (2,'Sample','','sample','','','','','','user','active','useruser','user','2023-04-06 14:03:07'),(8,'Mark','','Artigas','','0912321321','Lower Lamac','sample@gma',NULL,'admin','active','markuser','$2y$10$LNjjAwAdQazQMF22UnUCde32RHVohPL3QPjpQ2tJMkH4xswinXPu6','2023-04-06 16:32:32'),(9,'Basil John','C.','Manabo',NULL,'','','',NULL,'user','active','basiluser','$2y$10$9/ESqpwWBUnryLu3QtGE5OK3qNrA/nvSTp42sOH650.fNNbeyXYMu','2023-04-07 03:04:02'),(10,'Qwerty','','qwerty','','','','',NULL,'user','active','qwerty','$2y$10$qPPg3/FeB1bhDm2Dh0H6p.xxc04c5qyUfOWhadOR8KTthMKrpMlGW','2023-04-20 08:08:19');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 4 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET AUTOCOMMIT=@OLD_AUTOCOMMIT */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Sun, 30 Apr 2023 05:14:03 +0000
