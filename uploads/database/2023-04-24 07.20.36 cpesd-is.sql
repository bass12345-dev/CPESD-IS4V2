-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: cpesd-is
-- ------------------------------------------------------
-- Server version 	10.4.28-MariaDB
-- Date: Mon, 24 Apr 2023 07:20:36 +0000

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cso`
--

LOCK TABLES `cso` WRITE;
/*!40000 ALTER TABLE `cso` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `cso` VALUES (1,'sdsad','sad','2','Binuangan','Basil','09','213','sadsadsa@asd','PO','active','','','','','2023-04-18 06:16:40'),(6,'12323','Golden Hands','2','Lower Loboc','qwqwqwe','0922323','312312','as','PO','active','','','','','2023-04-18 06:15:50');
/*!40000 ALTER TABLE `cso` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `cso` with 2 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cso_officers`
--

LOCK TABLES `cso_officers` WRITE;
/*!40000 ALTER TABLE `cso_officers` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `cso_officers` VALUES (24,1,'President/BOD Chairperson/BOT-1',2,'asdasd','sd','sdsd','sd','0923324','sdfdsfsdf@sdfsdf','2023-04-16 21:21:32'),(25,2,'Vice President/BOD Vice Chairperson-2',2,'sad','sda','dsad','sd','09','asdasd@asdsad','2023-04-16 22:22:42'),(26,3,'Secretary-3',2,'asdsad','asd','asdasd','as','092321','asdasda@asdasd','2023-04-16 22:22:53'),(27,4,'Treasurer-4',2,'sadsa','sadasd','','','09','sadasd@asdasd','2023-04-16 22:23:03'),(28,5,'Auditor-5',2,'asdsad','sadas','asdsad','asdsad','092132','dasdas@asdasd','2023-04-16 22:23:13'),(31,1,'President/BOD Chairperson/BOT-1',3,'asdsad','sd','dsad','sd','092321','AsaSA@adasdasd','2023-04-17 02:33:02'),(33,2,'Vice President/BOD Vice Chairperson-2',7,'asdsad','sd','dsad','sd','0923','asdsad@asdasd','2023-04-18 06:35:52'),(34,1,'President/BOD Chairperson/BOT-1',7,'asdasd','sda','sdsd','','09','sdfdsfsdf@sdfsdf','2023-04-18 06:52:28'),(35,3,'Secretary-3',7,'asdsad','sd','sdsd','sd','09','asdasd@asdsad','2023-04-18 06:53:27'),(36,1,'President/BOD Chairperson/BOT-1',1,'sdasd','sadas','sdsd','sd','091312','ssfdsf@asfsdfsd','2023-04-24 05:47:43');
/*!40000 ALTER TABLE `cso_officers` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `cso_officers` with 10 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `migrations` VALUES (1,'2023-04-04-132142','App\\Database\\Migrations\\Users','default','App',1680766417,1),(2,'2023-04-06-025556','App\\Database\\Migrations\\Cso','default','App',1680766417,1),(3,'2023-04-06-062440','App\\Database\\Migrations\\ActLogs','default','App',1680766417,1),(4,'2023-04-06-064054','App\\Database\\Migrations\\CsoOfficers','default','App',1680766417,1),(5,'2023-04-06-065021','App\\Database\\Migrations\\Transactions','default','App',1680766417,1),(6,'2023-04-06-070319','App\\Database\\Migrations\\ProjectMonitoring','default','App',1680766417,1),(7,'2023-04-06-070334','App\\Database\\Migrations\\Trainings','default','App',1680766417,1),(8,'2023-04-06-072434','App\\Database\\Migrations\\TypeOfActivity','default','App',1680766417,1),(9,'2023-04-06-072450','App\\Database\\Migrations\\ResponsibleSection','default','App',1680766417,1),(10,'2023-04-06-072511','App\\Database\\Migrations\\UnderTypeOfActivity','default','App',1680766417,1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `migrations` with 10 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_monitoring`
--

LOCK TABLES `project_monitoring` WRITE;
/*!40000 ALTER TABLE `project_monitoring` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `project_monitoring` VALUES (2,15,'sad','2023-03-29 00:00:00',12,12,12,12,213,2321.00,213.00,213.00,213.00,213.00,21321.00,123123.00),(3,20,'sadsadsadasd','2023-04-17 00:00:00',10,2,10,10,10,10.00,10.00,10.00,10.00,10.00,10.00,10.00),(4,21,'asdasdsad','2023-04-18 00:00:00',12,1,10,10,10,10.00,10.00,10.00,10.00,10.00,10.00,10.00),(5,22,'dsdsdsd','2023-04-18 00:00:00',10,2,10,10,10,10.00,10.00,10.00,10.00,10.00,10.00,10.00),(6,23,'asdsad','2023-04-18 00:00:00',12,2,10,10,10,10.00,10.00,10.00,10.00,10.00,10.00,10.00),(7,25,'Basil','2023-04-23 00:00:00',12,1,12,12,12,12.00,12.00,12.00,12.00,12.00,12.00,12.00),(8,26,'12321','2023-04-25 00:00:00',12,12,12,12,12,12.00,12.00,12.00,12.00,12.00,12.00,12.00),(9,27,'dsdsadsad','2023-04-23 00:00:00',12,12,12,12,12,12.00,12.00,12.00,12.00,12.00,121.00,12.00),(10,28,'21','2023-04-23 00:00:00',12,12,12,12,12,12.00,12.00,12.00,12.00,12.00,12.00,12.00);
/*!40000 ALTER TABLE `project_monitoring` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `project_monitoring` with 9 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsibility_center`
--

LOCK TABLES `responsibility_center` WRITE;
/*!40000 ALTER TABLE `responsibility_center` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `responsibility_center` VALUES (1,'123','asdsadasd','2023-04-07 15:07:23'),(2,'21321','dsada','2023-04-07 15:14:08');
/*!40000 ALTER TABLE `responsibility_center` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `responsibility_center` with 2 row(s)
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
INSERT INTO `responsible_section` VALUES (1,'asdsad','2023-04-07 15:48:41'),(2,'asdasd','2023-04-07 15:48:58'),(3,'3213','2023-04-07 15:59:57');
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
  PRIMARY KEY (`rfa_client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rfa_clients`
--

LOCK TABLES `rfa_clients` WRITE;
/*!40000 ALTER TABLE `rfa_clients` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `rfa_clients` VALUES (1,'asdasd','sd','sdsd','sd',0,'Lower Langcangan',923232,12,'employed','2023-04-19 05:57:31'),(2,'asdasd','','dd','sd',0,'Lower Langcangan',923232,12,'employed','2023-04-19 05:58:40'),(3,'asdasd','sds','dd','sd',0,'Lower Langcangan',923232,12,'employed','2023-04-19 05:58:54'),(4,'asdaasdsadas','sd','dd','sd',0,'Lower Langcangan',923232,12,'employed','2023-04-19 05:59:21'),(5,'asdaasdsadasasdasdassad','sd','dd','sd',0,'Lower Langcangan',923232,12,'employed','2023-04-19 05:59:29'),(6,'asdaasdsadasasdasdassad','sd','ddssss','sd',0,'Lower Langcangan',923232,12,'employed','2023-04-19 05:59:34');
/*!40000 ALTER TABLE `rfa_clients` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `rfa_clients` with 6 row(s)
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
  `reffered_to` int(11) NOT NULL,
  `action_to_be_taken` text NOT NULL,
  `approved_date` datetime NOT NULL,
  PRIMARY KEY (`rfa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rfa_transactions`
--

LOCK TABLES `rfa_transactions` WRITE;
/*!40000 ALTER TABLE `rfa_transactions` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `rfa_transactions` VALUES (31,'795508748202304241',5,9,13,'simple',1,'pending','2023-04-24 06:24:03','',0,'','0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainings`
--

LOCK TABLES `trainings` WRITE;
/*!40000 ALTER TABLE `trainings` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `trainings` VALUES (2,14,'asasd',122,12,'213','sadsad','0000-00-00 00:00:00'),(3,29,'asdsad',12,1,'123','sadsadasdasd','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `trainings` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `trainings` with 2 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `transactions` VALUES (25,9,1,'2023-04-24 05:39:43',1,4,0,2,'2023-04-23 22:39:26',6,1,0,'','completed',NULL),(26,9,2,'2023-04-24 05:40:33',2,4,0,2,'2018-05-16 00:31:00',6,1,0,'','completed',NULL),(27,9,3,'2023-04-24 05:42:00',2,4,0,2,'2018-05-16 00:31:00',1,1,0,'','completed',NULL),(28,9,4,'2023-04-24 05:43:38',3,4,0,2,'2023-04-23 22:39:26',6,1,0,'','completed',NULL),(29,9,5,'2023-04-24 06:15:05',2,5,4,2,'2023-04-23 23:14:42',6,0,1,'<p>sasdasdasdasd</p>','completed','2023-04-24 06:15:50'),(30,9,6,'2023-04-24 06:24:41',1,2,0,2,'2023-04-23 23:24:37',1,0,0,'<p>sdasdasdsadsa</p>','pending',NULL);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `transactions` with 6 row(s)
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
INSERT INTO `type_of_activities` VALUES (1,'asdsad','2023-04-07 16:34:00'),(2,'Job Vacancy Solicitation','2023-04-11 01:19:20'),(3,'Regular Monthly COOP Visit','2023-04-11 01:19:33'),(4,'Regular Monthly Project Monitoring','2023-04-11 01:19:45'),(5,'Training','2023-04-11 01:19:52');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_of_request`
--

LOCK TABLES `type_of_request` WRITE;
/*!40000 ALTER TABLE `type_of_request` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `type_of_request` VALUES (7,'Employement Referral','2023-04-24 06:01:28'),(8,'Skills Training','2023-04-24 06:01:36'),(9,'On Line Services','2023-04-24 06:01:43'),(10,'Registration','2023-04-24 06:01:51'),(11,'Accreditation','2023-04-24 06:02:00'),(12,'Annual Report Preparation','2023-04-24 06:02:41'),(13,'OWWA Scholarship','2023-04-24 06:02:54');
/*!40000 ALTER TABLE `type_of_request` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `type_of_request` with 7 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `under_type_of_activity`
--

LOCK TABLES `under_type_of_activity` WRITE;
/*!40000 ALTER TABLE `under_type_of_activity` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `under_type_of_activity` VALUES (2,1,'sample','2023-04-07 16:54:18'),(3,5,'asdsad','2023-04-07 16:55:47'),(4,5,'asd','2023-04-07 16:55:53'),(5,5,'wrer','2023-04-11 01:21:14');
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
INSERT INTO `users` VALUES (2,'Sample','','sample','','','','','user','active','useruser','user','2023-04-06 14:03:07'),(8,'Mark','','Artigas',NULL,'','',NULL,'admin','active','markuser','$2y$10$LNjjAwAdQazQMF22UnUCde32RHVohPL3QPjpQ2tJMkH4xswinXPu6','2023-04-06 16:32:32'),(9,'Basil John','C.','Manabo',NULL,'','',NULL,'user','active','basiluser','$2y$10$9/ESqpwWBUnryLu3QtGE5OK3qNrA/nvSTp42sOH650.fNNbeyXYMu','2023-04-07 03:04:02'),(10,'Qwerty','','qwerty','','','',NULL,'user','active','qwerty','$2y$10$qPPg3/FeB1bhDm2Dh0H6p.xxc04c5qyUfOWhadOR8KTthMKrpMlGW','2023-04-20 08:08:19');
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

-- Dump completed on: Mon, 24 Apr 2023 07:20:36 +0000
