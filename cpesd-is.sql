-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 07:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpesd-is`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `activity_log_id` int(50) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `action` tinytext NOT NULL,
  `activity_log_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cso`
--

CREATE TABLE `cso` (
  `cso_id` int(50) UNSIGNED NOT NULL,
  `cso_code` varchar(50) NOT NULL,
  `cso_name` varchar(150) NOT NULL,
  `purok_number` varchar(50) NOT NULL,
  `barangay` varchar(150) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `telephone_number` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `type_of_cso` enum('PO','Coop','NSC') NOT NULL,
  `cso_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `cor` varchar(150) NOT NULL,
  `bylaws` varchar(200) NOT NULL,
  `aoc/aoi` varchar(200) NOT NULL,
  `other_docs` varchar(200) NOT NULL,
  `cso_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cso`
--

INSERT INTO `cso` (`cso_id`, `cso_code`, `cso_name`, `purok_number`, `barangay`, `contact_person`, `contact_number`, `telephone_number`, `email_address`, `type_of_cso`, `cso_status`, `cor`, `bylaws`, `aoc/aoi`, `other_docs`, `cso_created`) VALUES
(1, '001', 'Apil Farmers Association', '', 'Apil', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 17:09:53'),
(2, '002', 'Apil Peace-Building Mission Association', '', 'Apil', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:17:42'),
(3, '005', 'Bolibol Farmers Association', '', 'Bolibol', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:31:18'),
(4, '006 ', 'Buenavista Farmers Association', '', 'Buenavista', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:43:03'),
(5, '007', 'Buntawan Farmers Association', '', 'Buenavista', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:43:47'),
(6, '008', 'Burgos Livelihood Association', '', 'Burgos', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:44:24'),
(7, '009', 'Camubay Fishermens Association', '', 'Canubay', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:45:27'),
(8, '010', 'Canubay Dried Squid Association', '', 'Canubay', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:46:03'),
(9, '011', 'Clarin Settlement Producers Association', '', 'Clarin Settlement', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:49:27'),
(10, '012', 'Dolipos Alto Vegetables Growers Association', '', 'Dolipos Alto', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:50:17'),
(11, '013', 'Dolipos Bajo Farmers Association', '', 'Dolipos Bajo', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:51:43'),
(12, '014', 'Dullan Sur Farmers Association', '', 'Dullan Sur', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:52:50'),
(13, '016', 'Lower Lancangan Livelihood Women Association', '', 'Lower Langcangan', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:56:38'),
(14, '017', 'Mobod Coastal Tourism Association', '', 'Mobod', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 18:58:05'),
(15, '024', 'Paypayan Farmers Association', '', 'Paypayan', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:16:27'),
(16, '025', 'San Vicente Bajo Fisherman Association', '', 'San Vicente Bajo', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:17:03'),
(17, '026', 'Senote Livelihood Association', '', 'Senote', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:17:59'),
(18, '027', 'Taboc Norte Fisherfolks Association', '', 'Taboc Norte', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:18:49'),
(19, '028', 'Talairon Livelihood Association', '', 'Talairon', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:19:48'),
(20, '029', 'Talic Farmers Association', '', 'Talic', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:20:15'),
(21, '030', 'Tipan Consumers Association', '', 'Tipan', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:20:47'),
(22, '031', 'Tipan Fisherfolks Association', '', 'Tipan', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:22:00'),
(23, '035', 'Dullan Sur Womens Association', '', 'Dullan Sur', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:23:12'),
(24, '037', 'Binuangan Cutflower Growers Association', '', 'Binuangan', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:24:05'),
(25, '039', 'Villaflor Swine Raisers Association', '', 'Villaflor', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:24:43'),
(26, '047', 'Senote Women\'s Association', '', 'Senote', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:25:58'),
(27, '048', 'Dolipos Bajo Women\'s Association', '', 'Dolipos Bajo', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:26:36'),
(28, '049', 'Dulapo Fisherfolks Association', '', 'Dulapo', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:27:09'),
(29, '053', 'Pines Nursery Association', '', 'Pines', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:28:51'),
(30, '054', 'Clarin Settlement Corn Dream Growers Association', '', 'Clarin Settlement', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:29:45'),
(31, '055', 'Pines Fishermans Association', '', 'Pines', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:30:38'),
(32, '056', 'Taboc Sur Fishermens Association', '', 'Taboc Sur', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:31:28'),
(33, '057', 'Mobod Fisherfolks Association', '', 'Mobod', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:32:17'),
(34, '060', 'Womens Association of Brgy. Buenavista', '', 'Buenavista', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:33:19'),
(35, '061', 'Tipan Fisherpods Association', '', 'Tipan', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:34:02'),
(36, '062', 'Toliyok Womens Association', '', 'Toliyok', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:34:42'),
(37, '063', 'Tipan Crop Growers Association', '', 'Tipan', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:35:34'),
(38, '067', 'Poblacion 1 Motorcab Owners & Drivers Association', '', 'Poblacion 1', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:37:28'),
(39, '069', 'Tuyabang Alto Womens Association', '', 'Tuyabang Alto', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:39:06'),
(40, '073', 'Barangay Bolibol Womens Association', '', 'Bolibol', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:40:04'),
(41, '078', 'Poblacion I Fisherfolks Association, Inc', '', 'Poblacion 1', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:41:30'),
(42, '082', 'Bunga Child Labor Association', '', 'Bunga', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:42:21'),
(43, '084', 'Upper Lamac Water Consumers Association', '', 'Upper Lamac', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:43:09'),
(44, '089', 'Dolipos Alto Farmers Association', '', 'Dolipos Alto', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:44:28'),
(45, '092', 'Malindang Farmers Association', '', 'Malindang', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:45:09'),
(46, '093', 'Talairon Womens Association', '', 'Talairon', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:45:41'),
(47, '095', 'Tipan-Parents-Children Association', '', 'Tipan', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 20:47:06'),
(49, '004', '', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 21:30:33'),
(50, '003', 'Badjao Association for Poverty Alleviation', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 21:33:07'),
(51, '015', 'Jasys Workers Association', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 21:33:44'),
(52, '018', 'Oroquieta Bus Terminal Vendors Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:34:44'),
(53, '019', 'Oroquieta City Balot Vendors Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:35:46'),
(54, '020', 'Oroquieta City Sidewalk Vendors Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:36:25'),
(55, '021', 'Oroquieta City Sikad Operators & Drivers Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:37:10'),
(56, '022', 'Oroquieta Flower Garden Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:38:00'),
(57, '023', 'Oroquieta Goldenhands for Health & Welness Association , Inc', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:38:48'),
(58, '032', 'Upper Rizal Small Coconut Farmers Organization', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 21:39:23'),
(59, '033', 'Verdant Hills Farmers Association', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 21:39:53'),
(60, '034', 'Binuangan Small Coconut Farmers Organization', '', 'Binuangan', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 21:40:45'),
(61, '036', 'Oroquieta Public Market Laborers Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:41:35'),
(62, '038', 'Federated Womens Organization', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:42:47'),
(63, '040', 'Bunotex Employees Livelihood & Industrial Project Association', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 21:44:00'),
(64, '041', 'Purok 1 Mabinati-on Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:44:59'),
(65, '042', 'Brgy. Tipan Leader Organization', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 21:45:33'),
(66, '043', '', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 21:46:07'),
(67, '044', 'New Alliance for Good Oroquieta', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 21:46:32'),
(68, '045', 'Oroquieta City People\'s Alliance for Progress', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 21:47:18'),
(69, '046', 'Oroquieta City People\'s Organization for Livelihood Program', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 21:47:57'),
(70, '050', 'Pamilya Uswag Gugma Alang sa Tanan Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:55:49'),
(71, '051', 'Oroquieta City Agrarian Reform Beneficiaries Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:56:48'),
(72, '052', 'Oroquieta City Cutflowers Growers & Vendors Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:58:02'),
(73, '058', 'Manuel L. Quezon Port Employees & Fisherman Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:58:49'),
(74, '059', 'Dagatan Fisherman Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 21:59:22'),
(75, '064', 'Community Participation Action Research Farmers Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:00:32'),
(76, '065', 'Association of Bantay Dangan Volunteers', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:01:06'),
(77, '066', 'Oroquieta City Community Affairs for Reform & Development Programs', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:02:03'),
(78, '068', 'Oroquieta Halang Halang Vendors Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:02:49'),
(79, '070', 'Oroquieta City Downtown Express Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:03:35'),
(80, '071', 'Womens in Government Service Association of Oroquieta City , Inc.', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:04:32'),
(81, '072', 'Goodlife Rubber Producers Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:05:04'),
(82, '074', 'Youth Leadership Program - Oroquieta City Youth Group Inc.', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:06:12'),
(83, '075', 'Mialen, Toliyok , Bunga, Sebucal, Villaflor, Clarin Settlement(MITOBUSVIC)', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:07:40'),
(84, '076', 'Federation of Senior Citizens of Oroquieta City, Inc.', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:08:35'),
(85, '077', 'Oroquieta Town Center Stall Owners Association, Inc', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:09:32'),
(86, '079', 'Misamis Occidental Mangrove Management Association Inc.', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:10:22'),
(87, '080', 'Tuyabang Alto Small Coconut Farmers Organization', '', 'Tuyabang Alto', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:11:06'),
(88, '081', 'Oroquieta City Coconut Farmers Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:11:51'),
(89, '083', 'Organization of Quarista in Barangay Toliok', '', 'Toliyok', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:12:37'),
(90, '085', 'Lumad nga Mag-uuma sa Sebucal Inc', '', 'Sebucal', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:13:27'),
(91, '086', 'Oroquieta City Bamboocraft Producers Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:14:06'),
(92, '087', 'Toliyok-Senote-Villaflor Community Swine Raisers Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:15:38'),
(93, '088', 'Oroquieta City Differently Abled Person Association, Inc', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:18:31'),
(94, '090', '', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:18:45'),
(95, '091', 'Oroquieta City Community Volunteer Health Workers Association Inc', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:19:29'),
(96, '096', 'City Plaza Vendors Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:21:55'),
(97, '097', 'Association of Building Officials of Misamis Occidental Inc.', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:22:30'),
(98, '098', 'Hugpong sa mga Barangay of Oroquieta City Inc.', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:34:30'),
(99, '099', 'Misamis Occidental Tourism Officers Association, Inc', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:35:18'),
(100, '100', 'Caluya Floating Cottage Operators Association, Inc', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:36:07'),
(101, '101', 'Association of Barangay Captain of Sapang Dalaga Inc.', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:37:44'),
(102, '102', 'Magapangi Irrigators Association for Sustainable Livelihood Inc', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:39:19'),
(103, '103', 'Kausaban, Ampingan, Ugmaron, Batukan, ang Naagian (KAUBAN) Association', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:40:18'),
(104, '104', 'Carrer Advocates and Public Employment Service Officers of Misamis Occidental', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:41:14'),
(105, '105', 'Kuyog(Kalisud Sulbaron, Uswagon ang Kinabuhi, Yawi sa Panginabuhi, Otung sa Buh)', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:42:31'),
(106, '106', 'Naghiusang Lumad nga Mag-uuma sa Sebucal', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:43:09'),
(107, '107', 'Association of Coco Pilots of Oroquieta City', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:43:42'),
(108, '108', 'Oroquieta City Tennis Club Inc.', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:44:04'),
(109, '109', 'Talic Livelihood Association', '', 'Talic', '', '09', '', '', 'PO', 'inactive', '', '', '', '', '2023-05-10 05:42:17'),
(110, '110', 'Service Advocates and Volunteers for Environment(SAVE)', '', '', '', '09', '', '', '', 'active', '', '', '', '', '2023-04-27 22:49:21'),
(111, '111', 'Meat Vendors Association', '', '', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-04-27 22:49:41'),
(112, '112', 'Music Enthusiasts Club in Oroquieta ', '', '', '', '09', '', '', '', 'inactive', '', '', '', '', '2023-04-27 22:50:41'),
(113, '113', 'Dolipos  Bajo Panginabuhian Association ', '', 'Dolipos Bajo', '', '09', '', '', 'PO', 'active', '', '', '', '', '2023-05-18 13:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `cso_officers`
--

CREATE TABLE `cso_officers` (
  `cso_officer_id` int(20) UNSIGNED NOT NULL,
  `position_number` int(10) NOT NULL,
  `cso_position` varchar(150) NOT NULL,
  `officer_cso_id` int(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `extension` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `cso_officer_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cso_officers`
--

INSERT INTO `cso_officers` (`cso_officer_id`, `position_number`, `cso_position`, `officer_cso_id`, `first_name`, `middle_name`, `last_name`, `extension`, `contact_number`, `email_address`, `cso_officer_created`) VALUES
(1, 1, 'President/BOD Chairperson/BOT-1', 112, 'sadsad', 'sad', 'aASD', 'SAD', '09', 'DSFDSF@ASDASDSA', '2023-05-12 02:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `cso_project_implemented`
--

CREATE TABLE `cso_project_implemented` (
  `cso_project_implemented_id` int(11) NOT NULL,
  `project_cso_id` int(11) NOT NULL,
  `title_of_project` varchar(250) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `year` date DEFAULT NULL,
  `funding_agency` varchar(250) NOT NULL,
  `status` set('inactive','active') NOT NULL,
  `cso_project_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cso_project_implemented`
--

INSERT INTO `cso_project_implemented` (`cso_project_implemented_id`, `project_cso_id`, `title_of_project`, `amount`, `year`, `funding_agency`, `status`, `cso_project_created`) VALUES
(1, 0, 'sadsad', 121.12, '2023-05-11', 'sadsadsad asd', 'active', '2023-05-10 14:57:35'),
(2, 0, 'asdas', 12.12, '2023-05-11', 'asdasd asdasd', 'active', '2023-05-10 14:59:53'),
(3, 112, 'sample11', 12.13, '2023-05-11', 'asdasd', 'active', '2023-05-10 15:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_meeting`
--

CREATE TABLE `project_meeting` (
  `meeting_transaction_id` int(11) NOT NULL,
  `meeting_present` int(50) NOT NULL,
  `meeting_absent` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_meeting`
--

INSERT INTO `project_meeting` (`meeting_transaction_id`, `meeting_present`, `meeting_absent`) VALUES
(15, 12, 1),
(20, 12, 0),
(22, 17, 0),
(24, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_monitoring`
--

CREATE TABLE `project_monitoring` (
  `project_monitoring_id` int(50) UNSIGNED NOT NULL,
  `project_transact_id` int(20) NOT NULL,
  `project_title` varchar(150) NOT NULL,
  `period` datetime NOT NULL,
  `attendance_present` int(50) NOT NULL,
  `attendance_absent` int(150) NOT NULL,
  `nom_borrowers_delinquent` int(150) NOT NULL,
  `nom_borrowers_overdue` int(150) NOT NULL,
  `total_production` int(150) NOT NULL,
  `total_collection_sales` float(10,2) NOT NULL,
  `total_released_purchases` float(10,2) NOT NULL,
  `total_delinquent_account` float(10,2) NOT NULL,
  `total_over_due_account` float(10,2) NOT NULL,
  `cash_in_bank` float(10,2) NOT NULL,
  `cash_on_hand` float(10,2) NOT NULL,
  `inventories` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_monitoring`
--

INSERT INTO `project_monitoring` (`project_monitoring_id`, `project_transact_id`, `project_title`, `period`, `attendance_present`, `attendance_absent`, `nom_borrowers_delinquent`, `nom_borrowers_overdue`, `total_production`, `total_collection_sales`, `total_released_purchases`, `total_delinquent_account`, `total_over_due_account`, `cash_in_bank`, `cash_on_hand`, `inventories`) VALUES
(1, 3, '', '1970-01-01 00:00:00', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(2, 7, '', '1970-01-01 00:00:00', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(3, 8, '', '1970-01-01 00:00:00', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(4, 11, 'massage center', '2023-05-05 00:00:00', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 38316.00, 0.00, 0.00),
(5, 18, 'Rice Trading & Life Vest', '1970-01-01 00:00:00', 0, 0, 0, 28, 0, 0.00, 0.00, 0.00, 41675.00, 21000.00, 2074.00, 0.00),
(6, 19, 'Rice Trading', '1970-01-01 00:00:00', 12, 0, 0, 54, 0, 0.00, 7700.00, 0.00, 53430.00, 35259.66, 5400.00, 0.00),
(7, 23, 'grocery store', '1970-01-01 00:00:00', 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 115000.00, 32000.00, 30000.00),
(8, 27, 'Improvement of Balot Vending Kit', '1970-01-01 00:00:00', 0, 0, 0, 0, 0, 11351.00, 0.00, 0.00, 0.00, 0.00, 4120.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `responsibility_center`
--

CREATE TABLE `responsibility_center` (
  `responsibility_center_id` int(20) NOT NULL,
  `responsibility_center_code` varchar(50) NOT NULL,
  `responsibility_center_name` varchar(150) NOT NULL,
  `responsibility_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responsibility_center`
--

INSERT INTO `responsibility_center` (`responsibility_center_id`, `responsibility_center_code`, `responsibility_center_name`, `responsibility_created`) VALUES
(1, '1', 'No. of SPRS Monthly Report Prepared & Submitted', '2023-05-02 20:53:59'),
(2, '2', 'No. of  Monthly LMI Report Prepared & Submitted', '2023-05-02 20:54:15'),
(3, '3', 'No. of  Monthly LMI Analysis Prepared & Submitted', '2023-05-02 20:54:26'),
(4, '4', 'No. of Job vacancies solicitation Conducted', '2023-05-02 20:54:45'),
(5, '5', 'No. of Job Vacancies Solicited - Local', '2023-05-02 20:54:59'),
(6, '6', 'No. of Job Vacancies Solicited - Overseas', '2023-05-02 20:55:13'),
(7, '7', 'No. of Individuals Reached with LMI', '2023-05-02 20:55:22'),
(8, '8', 'No. of Entities Reached with LMI', '2023-05-02 20:55:33'),
(9, '9', 'No. of Inquiries Answered on PESO Fb Page', '2023-05-02 21:04:29'),
(11, '10', 'No. of Inquiries Answered on Hotjobs Fb Page', '2023-05-02 21:06:02'),
(12, '11', 'No. of Inquiries Answered on Jobs email-ad', '2023-05-02 21:07:16'),
(13, '12', 'No. of Job Applicants Registered', '2023-05-02 21:07:41'),
(14, '13', 'No. of Job Applicants Referred', '2023-05-02 21:07:55'),
(15, '14', 'No. of Job Applicants Placed (92% placement rate)', '2023-05-02 21:08:04'),
(16, '15', 'No.  of SHS Conducted Pre-Employment Coaching', '2023-05-02 21:08:24'),
(17, '16', 'No.  of SHS Covered for  Pre-Employment Coaching', '2023-05-02 21:08:40'),
(18, '17', 'No.  of JHS Conducted Pre-Employment Coaching', '2023-05-02 21:08:49'),
(19, '18', 'No.  of JHS Covered for  Pre-Employment Coaching', '2023-05-02 21:09:00'),
(20, '19', 'No.  of G6 Conducted Career Advocacy', '2023-05-02 21:09:31'),
(21, '20', 'No.  of G6 Covered for Career Advocacy', '2023-05-02 21:09:49'),
(22, '21', 'No. of  Labor Education for Graduating Students (LEGS) Conducted', '2023-05-02 21:10:04'),
(23, '22', 'No. of  Students Conducted attended LEGS', '2023-05-02 21:10:55'),
(24, '23', 'No. Beneficiaries - 10 Day PSEP', '2023-05-02 21:11:16'),
(25, '24', 'No. Beneficiaries - 20 Days SPES', '2023-05-02 21:11:29'),
(26, '25', 'No. of PSEP Orientation Conducted ', '2023-05-02 21:11:41'),
(27, '26', 'No. of SPES Orientation Conducted', '2023-05-02 21:11:51'),
(28, '27', 'No. of SPES Beneficiary Docs reviewed  for Academe Implementer', '2023-05-02 21:12:02'),
(29, '28', 'No. of  SRA Conducted', '2023-05-02 21:12:15'),
(30, '29', 'No. of  Applicants Registered- SRA', '2023-05-02 21:12:37'),
(31, '30', 'No. of LRA or Mini-job Fair Conducted ', '2023-05-02 21:12:56'),
(32, '31', 'No. of  Applicants Registered- LRA', '2023-05-02 21:13:21'),
(33, '32', 'No. of SRA/LRA Placement Monitoring Conducted', '2023-05-02 21:13:37'),
(34, '33', 'No. of Job Fair Conducted', '2023-05-02 21:13:54'),
(35, '34', 'No. of Business Fair Conducted', '2023-05-02 21:14:08'),
(36, '35', 'No. of  One-stop-Shop Services Conducted', '2023-05-02 21:14:25'),
(37, '36', 'No. of  Skills Demo Conducted', '2023-05-02 21:14:35'),
(38, '37', 'No. of Applicants Registered to PEIS', '2023-05-02 21:15:03'),
(39, '38', 'No. of Establishments Registered to PEIS', '2023-05-02 21:15:14'),
(40, '39', 'No. of Job Vacancies Posted to PEIS', '2023-05-02 21:15:28'),
(41, '40', 'No. of PEIS Profile Updated', '2023-05-02 21:15:37'),
(42, '41', 'No. of PEIS-Based Referral', '2023-05-02 21:16:24'),
(43, '42', 'No. of BNSRP-PEIS FB Quarterly Meeting Conducted', '2023-05-02 21:16:36'),
(44, '43', 'No. of PEIS On-site Enrolment Conducted', '2023-05-02 21:16:58'),
(45, '44', 'No. of PEIS Applicants Tagged PLACED', '2023-05-02 21:17:45'),
(46, '45', 'No. of Awarding and Recognition conducted', '2023-05-02 21:17:55'),
(47, '46', 'No. of Applicants Registered to PJN', '2023-05-02 21:18:06'),
(48, '47', 'No. of Establishments Registered to PJN', '2023-05-02 21:18:19'),
(49, '48', 'No. of Job Vacancies Registered to PJN', '2023-05-02 21:18:43'),
(50, '49', 'No. of Target Beneficiaries', '2023-05-02 21:18:53'),
(51, '50', 'No. of Employer\'s Forum Conducted', '2023-05-02 21:19:08'),
(52, '51', 'No. of Employer\'s Participated', '2023-05-02 21:19:17'),
(53, '52', 'No. of Placed', '2023-05-02 21:19:45'),
(54, '53', 'No. of Scholars Processed &  Approved - SHS ', '2023-05-02 21:19:54'),
(55, '54', 'No. of Scholars Processed & Approved - College', '2023-05-02 21:20:02'),
(56, '55', 'No. of Scholars Processed & Approved - TVET', '2023-05-02 21:20:11'),
(57, '56', 'No. of Scholarship Forms Encoded at PEIS', '2023-05-02 21:20:19'),
(58, '57', 'No. of NGA Scholarship Application Facilitated / Processed', '2023-05-02 21:20:28'),
(59, '58', 'No. of Labor Education conducted', '2023-05-02 21:20:38'),
(60, '59', 'No. of Kasambahay Profiled / Updated', '2023-05-02 21:20:57'),
(61, '60', 'No. of Kasambahay Given Intervention', '2023-05-02 21:21:06'),
(62, '61', 'No. of Establishment Inspection Conducted', '2023-05-02 21:21:16'),
(63, '62', 'No. of Establishment\'s 201 File Examined / Evaluated / Maintained', '2023-05-02 21:21:44'),
(64, '64', 'No. of  Awarding and Recognition Conducted', '2023-05-02 21:21:55'),
(65, '65', 'No. of WHIP Monitoring Conducted ', '2023-05-02 21:22:03'),
(66, '66', 'No. of WHIP Placement', '2023-05-02 21:22:13'),
(67, '67', 'No. of WHIP Monitoring Reports Submitted', '2023-05-02 21:22:22'),
(68, '68', 'No. of Monthly WHIP Project Progress Report Submitted', '2023-05-02 21:22:30'),
(69, '69', 'No. of WHIP Project Terminal Report Submitted', '2023-05-02 21:23:28'),
(70, '70', 'No. of AIR Advocacy Conducted', '2023-05-02 21:23:50'),
(71, '71', 'No. of Child Labor Beneficiaries Assisted', '2023-05-02 21:24:07'),
(72, '72', 'No. of Child Labor Project Monitoring Conducted', '2023-05-02 21:25:27'),
(73, '73', 'No. of Activity conducted during International CL Day', '2023-05-02 21:25:37'),
(74, '74', 'No. OFW Help-Desk Maintained', '2023-05-02 21:26:00'),
(75, '75', 'No. OFW Welfare Case  Assisted - Regular', '2023-05-02 21:26:17'),
(76, '76', '% Rate of OFWs Cases Resolved', '2023-05-02 21:26:27'),
(77, '77', 'No. of OFWs Assisted - Calamity Assistance', '2023-05-02 21:26:36'),
(78, '78', 'No. of OFWs Profiled', '2023-05-02 21:26:45'),
(79, '79', 'No. of EDSP/ODSP Scholarship Assisted', '2023-05-02 21:27:03'),
(80, '80', 'No. of OFW Family Circle Organized & Registered', '2023-05-02 21:27:15'),
(81, '81', 'No. of OFW Family Circle Orientation Conducted', '2023-05-02 21:27:22'),
(82, '82', 'No. of  Skills Training for PWDs Conducted', '2023-05-02 21:27:30'),
(83, '83', 'No. of PWDs Profiled', '2023-05-02 21:27:39'),
(84, '84', 'No. of TUPAD Beneficiaries Processed/Assisted/Referred', '2023-05-02 21:27:47'),
(85, '85', 'No. of GIP Beneficiaries Assisted', '2023-05-02 21:28:06'),
(86, '86', 'No. of Mission Race Beneficiaries Processed / Assisted', '2023-05-02 21:28:18'),
(87, '87', 'No. of 1st Time Jobseekers Assisted', '2023-05-02 21:28:33'),
(88, '88', 'No. of 1st Time Jobseekers Advocacy  Conducted', '2023-05-02 21:28:41'),
(89, '89', 'No. of CTEC Report Submitted - 12', '2023-05-02 21:28:49'),
(90, '90', 'No. of Community-Based Skills Training Conducted', '2023-05-02 21:28:57'),
(91, '91', 'No. of CBT Beneficiaries (Regular)', '2023-05-02 21:30:42'),
(92, '92', 'No. of CBT Beneficiaries (ELCAC)', '2023-05-02 21:30:55'),
(93, '93', 'No. of  Skills Trainings Conducted', '2023-05-02 21:31:22'),
(94, '94', 'No. of Beneficiaries - Skills Training', '2023-05-02 21:31:36'),
(95, '95', 'No. of  Capability Building Trainings Conducted', '2023-05-02 21:31:47'),
(96, '96', 'No. of Beneficiaries - Cap Devt', '2023-05-02 21:32:45'),
(97, '97', 'No. of  Mandatory Coop officers Trainings Facilitated', '2023-05-02 21:33:00'),
(98, '98', 'No. of Beneficiaries - Mandatory Training', '2023-05-02 21:33:09'),
(99, '99', 'No. of  Other Coop officers Trainings Facilitated', '2023-05-02 21:33:18'),
(100, '100', 'No. of Beneficiaries - Other Training', '2023-05-02 21:33:27'),
(101, '101', 'No. of Employability Enhancement, Labor Relations and Productivity Trainings Conducted (virtual)', '2023-05-02 21:33:38'),
(102, '102', 'No. of Livelihood Projects Implemented/Assisted - Regular', '2023-05-02 21:33:48'),
(103, '103', 'No. of Livelihood Projects Implemented/Assisted -Individual', '2023-05-02 21:33:58'),
(104, '104', 'No. of Livelihood Projects Implemented/Assisted - PWD', '2023-05-02 21:34:07'),
(105, '105', 'No. of Livelihood Projects Implemented/Assisted - Ips', '2023-05-02 21:34:18'),
(106, '106', 'No. of Livelihood Beneficiaries - Regular', '2023-05-02 21:34:39'),
(107, '107', 'No. of Livelihood Beneficiaries - Individual', '2023-05-02 21:35:01'),
(108, '108', 'No. of LAG Beneficiaries Assisted', '2023-05-02 21:35:14'),
(109, '109', 'No. of GEDA Projects Assisted/Implemented', '2023-05-02 21:35:23'),
(110, '110', 'No. of Individual LAG Monitoring Conducted', '2023-05-02 21:35:35'),
(111, '111', 'No. of COOP/PO Project Monitoring Conducted', '2023-05-02 21:35:47'),
(112, '112', 'No. of COOP/PO Monitoring/Meeting Conducted/Attended', '2023-05-02 21:36:00'),
(113, '113', 'No. of COOP Visits Conducted', '2023-05-02 21:36:10'),
(114, '114', 'No. of  CSO-Desk Maintained', '2023-05-02 21:36:46'),
(115, '115', 'No. of  People\'s Council Organized', '2023-05-02 21:36:54'),
(116, '116', 'No. of  People\'s Council Meeting Facilitated', '2023-05-02 21:37:02'),
(117, '117', 'No. of  CSO Meetings Faciliated', '2023-05-02 21:37:11'),
(118, '118', 'No. of COOPs Given Assistance in Making Reports', '2023-05-02 21:37:20'),
(119, '119', 'No. of COOP Reports Assisted', '2023-05-02 21:37:28'),
(120, '120', 'No. of POs Given Assistance in Making Reports-DOLE', '2023-05-02 21:37:37'),
(121, '121', 'No. of POs  Reports-DOLE Assisted', '2023-05-02 21:38:07'),
(122, '122', 'No. of POs Given Assistance in Making Reports - SEC', '2023-05-02 21:38:15'),
(123, '123', 'No. of POs Reports - SEC Assisted', '2023-05-02 21:38:22'),
(124, '124', 'No. of Pos Registered to DOLE/SEC', '2023-05-02 21:38:30'),
(125, '125', 'No. of COOPs Registered to CDA', '2023-05-02 21:38:37'),
(126, '126', 'No. of COOPs/Pos Assisted for Accreditation', '2023-05-02 21:38:45'),
(127, '127', 'No. of COOPs/Pos Assisted for BIR Regulation', '2023-05-02 21:38:52'),
(128, '128', 'No. of PRS Facilitated', '2023-05-02 21:45:54'),
(129, '129', 'No. of PRS- Facilitated Beneficiaries', '2023-05-02 21:46:02'),
(130, '130', 'No. of Coop Month Celebration Activities Conducted', '2023-05-02 21:46:15'),
(131, '131', 'No. of OMJ Episodes Shoot', '2023-05-02 21:46:32'),
(132, '132', 'No. of PO-COOP Updating Survey Bounded', '2023-05-02 21:46:39'),
(133, '133', 'No. of OCCDC Meeting Facilitated', '2023-05-02 21:48:39'),
(134, '134', 'No. of Applicants Given On-line Assistance', '2023-05-02 21:48:49'),
(135, '135', 'No. of Job Vacancy Lay-out Prepared', '2023-05-02 21:48:59'),
(136, '136', 'No. of  Meetings Conducted/Facilitated', '2023-05-02 21:49:09'),
(137, '137', 'No. of Success Videos / Stories Prepared', '2023-05-02 21:49:30'),
(138, '138', 'No. of Lay-outs / Artcard Prepared', '2023-05-02 21:49:40'),
(139, '139', 'No. of Advocacy Video Prepared', '2023-05-02 21:49:52'),
(140, '140', 'No. of Monthly LMI Updates Artcard Prepared', '2023-05-02 21:50:01'),
(141, '141', 'No. of Advocacy Videos Posted at You-tube', '2023-05-02 21:50:18'),
(142, '142', '% rate of 2021 Activity Photo Folder Maintained for SBP', '2023-05-02 21:51:00'),
(143, '143', '% rate of Documents Received Routed Immediately', '2023-05-02 21:51:08'),
(144, '144', '% rate of Documents Released/Processed Transmitted Immediately', '2023-05-02 21:51:16'),
(145, '145', '% rate of Documents Filed (in proper filing center) in a span of 2 to 3 days', '2023-05-02 21:51:24'),
(146, '146', '% Rate of Active Filing Center maintained', '2023-05-02 21:51:41'),
(147, '147', '% Rate of Budget Logbook Maintained', '2023-05-02 21:51:50'),
(148, '148', 'No. of PRs prepared', '2023-05-02 21:52:02'),
(149, '149', 'No. of Petty Cash Prepared', '2023-05-02 21:52:16'),
(150, '150', 'No. of Cash Advance Prepared', '2023-05-02 21:52:26'),
(151, '151', 'No. of Documents Printed from Email (Yahoo and Jobs)', '2023-05-02 21:52:39'),
(152, '152', 'No. of Documents Dessiminated', '2023-05-02 21:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `responsible_section`
--

CREATE TABLE `responsible_section` (
  `responsible_section_id` int(50) UNSIGNED NOT NULL,
  `responsible_section_name` varchar(150) NOT NULL,
  `responsible_section_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `responsible_section`
--

INSERT INTO `responsible_section` (`responsible_section_id`, `responsible_section_name`, `responsible_section_created`) VALUES
(1, 'Cooperative & Livelihood Development', '2023-04-27 23:01:37'),
(2, 'Labor & Employment', '2023-04-27 23:01:49'),
(3, 'Manpower Development & Scholarship', '2023-04-27 23:02:01'),
(5, 'Administrative', '2023-05-10 12:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `rfa_clients`
--

CREATE TABLE `rfa_clients` (
  `rfa_client_id` int(30) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `purok` int(10) DEFAULT NULL,
  `barangay` varchar(100) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `age` int(20) NOT NULL,
  `employment_status` varchar(150) NOT NULL,
  `rfa_client_created` datetime NOT NULL,
  `rfa_client_added_by` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rfa_clients`
--

INSERT INTO `rfa_clients` (`rfa_client_id`, `first_name`, `middle_name`, `last_name`, `extension`, `purok`, `barangay`, `contact_number`, `age`, `employment_status`, `rfa_client_created`, `rfa_client_added_by`) VALUES
(1, 'Basil', '', 'Manabo', '', 2, 'Bolibol', '09126548518', 12, 'employed', '2023-04-30 04:48:58', 9),
(2, 'Jovencia ', 'C', 'Guia', '', 1, 'Victoria', '2147483647', 71, 'self-employed', '2023-05-17 16:10:36', 18),
(3, 'Evelyn ', '', 'Jambo', '', 0, 'Canubay', '9', 0, 'employed', '2023-05-17 16:48:52', 18),
(4, 'Maricel', 'T.', 'Camacho', '', 3, 'Villaflor', '2147483647', 33, 'self-employed', '2023-05-18 12:16:14', 19);

-- --------------------------------------------------------

--
-- Table structure for table `rfa_transactions`
--

CREATE TABLE `rfa_transactions` (
  `rfa_id` int(20) NOT NULL,
  `rfa_tracking_code` varchar(100) NOT NULL,
  `client_id` int(20) NOT NULL,
  `rfa_created_by` int(30) NOT NULL,
  `tor_id` int(20) NOT NULL,
  `type_of_transaction` enum('simple','complex') DEFAULT NULL,
  `number` varchar(150) NOT NULL,
  `rfa_status` set('pending','completed') NOT NULL,
  `rfa_date_filed` datetime NOT NULL,
  `action_taken` text NOT NULL,
  `reffered_to` int(11) DEFAULT NULL,
  `reffered_date_and_time` datetime NOT NULL,
  `action_to_be_taken` text DEFAULT NULL,
  `action_to_be_taken_date_time` datetime NOT NULL,
  `accomplished_status` int(1) NOT NULL,
  `approved_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rfa_transactions`
--

INSERT INTO `rfa_transactions` (`rfa_id`, `rfa_tracking_code`, `client_id`, `rfa_created_by`, `tor_id`, `type_of_transaction`, `number`, `rfa_status`, `rfa_date_filed`, `action_taken`, `reffered_to`, `reffered_date_and_time`, `action_to_be_taken`, `action_to_be_taken_date_time`, `accomplished_status`, `approved_date`) VALUES
(1, '193444233720230517001', 2, 18, 9, 'simple', '023', 'pending', '2023-05-17 16:13:15', '<p>for assistance</p>', 18, '2023-05-18 03:18:44', NULL, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(24, '115284297720230517024', 3, 18, 20, 'simple', '024', 'completed', '2023-05-17 16:50:33', '<p>forward to goldenhands the payroll</p>', 18, '2023-05-18 03:17:08', '<p>file received 5/18/2023</p>', '2023-05-18 03:53:10', 1, '2023-05-18 05:21:45'),
(25, '10790345320230518025', 4, 19, 9, 'complex', '025', 'pending', '2023-05-18 12:16:55', '<p>Please ask the requestor for review and supply of needed data aron mafinalize na</p>', 19, '2023-05-18 05:21:32', NULL, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rfa_transaction_history`
--

CREATE TABLE `rfa_transaction_history` (
  `history_id` int(20) NOT NULL,
  `track_code` varchar(50) NOT NULL,
  `received_by` int(20) NOT NULL,
  `received_date_and_time` datetime NOT NULL,
  `action_taken` text NOT NULL,
  `referred_to` int(20) DEFAULT NULL,
  `reffered_date_and_time` datetime NOT NULL,
  `action_to_be_taken` text NOT NULL,
  `rfa_tracking_status` enum('received','to-complete','completed') DEFAULT NULL,
  `release_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `training_id` int(50) UNSIGNED NOT NULL,
  `training_transact_id` int(20) NOT NULL,
  `title_of_training` varchar(150) NOT NULL,
  `number_of_participants` int(50) NOT NULL,
  `female` int(50) NOT NULL,
  `overall_ratings` varchar(150) NOT NULL,
  `name_of_trainor` varchar(150) NOT NULL,
  `training_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`training_id`, `training_transact_id`, `title_of_training`, `number_of_participants`, `female`, `overall_ratings`, `name_of_trainor`, `training_created`) VALUES
(1, 1, 'Employers Forum', 52, 36, '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(50) UNSIGNED NOT NULL,
  `created_by` int(50) NOT NULL,
  `number` varchar(150) NOT NULL,
  `date_and_time_filed` datetime NOT NULL,
  `responsible_section_id` int(150) NOT NULL,
  `type_of_activity_id` int(150) NOT NULL,
  `under_type_of_activity_id` int(150) DEFAULT NULL,
  `responsibility_center_id` int(150) NOT NULL,
  `date_and_time` datetime NOT NULL,
  `cso_Id` int(150) DEFAULT NULL,
  `is_project_monitoring` int(11) NOT NULL,
  `is_training` int(11) NOT NULL,
  `is_project_meeting` int(1) NOT NULL,
  `remarks` text NOT NULL,
  `transaction_status` enum('pending','completed') NOT NULL,
  `transaction_date_time_completed` datetime DEFAULT NULL,
  `annotations` text DEFAULT NULL,
  `update_status` set('to-update','updated') NOT NULL,
  `updated_on` datetime NOT NULL,
  `action_taken_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `created_by`, `number`, `date_and_time_filed`, `responsible_section_id`, `type_of_activity_id`, `under_type_of_activity_id`, `responsibility_center_id`, `date_and_time`, `cso_Id`, `is_project_monitoring`, `is_training`, `is_project_meeting`, `remarks`, `transaction_status`, `transaction_date_time_completed`, `annotations`, `update_status`, `updated_on`, `action_taken_date`) VALUES
(2, 13, '125', '2023-05-09 13:43:49', 2, 6, 0, 31, '2023-05-08 13:43:32', 0, 0, 0, 0, '<p>dgaskbdkasbdkbaskdbksabdsabdasbkdsad</p>', 'completed', NULL, NULL, 'updated', '0000-00-00 00:00:00', '2023-05-18 02:18:21'),
(10, 18, '126', '2023-05-16 11:07:28', 1, 1, 0, 112, '2023-05-05 08:00:00', 57, 0, 0, 0, '', 'completed', NULL, NULL, 'to-update', '0000-00-00 00:00:00', NULL),
(11, 18, '127', '2023-05-16 11:19:58', 1, 4, 0, 111, '2005-05-05 08:00:00', 57, 1, 0, 0, '', 'completed', NULL, '<p>* nagsuggest sila sa ilang CBU e separate ug other account</p>\r\n<p>* nagreklamo ang uban therapist sa isa ka kauban nila hing extend ila pagmasahe na wala magpahibalo sa desk.</p>\r\n<p>* naay 3 ka member na wala nay duty2 or inactive member pero nagkuha ug uniform, pwede ba daw nila kwaon or paulian sa uban member na walay uniform</p>\r\n<p>ang inactive member kinahanglan maggama ug resignation letter.</p>', 'updated', '2023-05-17 10:45:29', NULL),
(12, 12, '128', '2023-05-16 11:51:42', 2, 6, 0, 65, '2023-04-28 10:00:00', 0, 0, 0, 0, '', 'completed', NULL, '<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\"><strong>PROJECT TITLE</strong>: 22KI0038-Oroquieta City-Calamba Road Widening</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\"><strong>CONTRACTOR</strong>: Grace Construction Corporation</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\"><strong>PROJECT LOCATION</strong>: Lower Rizal, Oroquieta City</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\"><strong>PROJECT NATURE</strong>: DPWH 1st District<span style=\"mso-spacerun: yes;\">&nbsp;</span>Implemented</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\"><strong>PROJECT COST</strong>: Php 47,805,860.33</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\"><strong>DATE STARTED</strong>: February 15, 2022</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\"><strong>DATE OF MONITORING</strong>: April 28, 2023</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\"><strong>SPECIFIC ACTIVITY</strong>: road widening-finishing touch</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\"><strong>* Percentage of SKILLED WORKERS</strong>-33.33%, LHSW-1 from Far Brgy(Canubay)&nbsp;</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\"><strong>Percentage of Unskilled workers</strong>-80%, LHUSW-4 from Far Brgy(Canubay,Villaflor)&nbsp;</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\"><strong>COMPLIANT</strong>-based on Labor Localization Ordinance</span></p>', 'updated', '2023-05-18 11:43:57', NULL),
(13, 12, '129', '2023-05-16 11:56:09', 2, 8, 0, 0, '2023-05-10 10:00:00', 0, 0, 0, 0, '', 'completed', NULL, '<p>Attended the meeting and actual site inspection at barangay Taboc Sur</p>\r\n<p>The project was 100% completed</p>\r\n<p>Issued placement form for EG-16 of DDS Builders to Mr. Elmar Uba, passed to Wiengelyn for pies</p>', 'updated', '2023-05-17 08:51:02', NULL),
(16, 12, '130', '2023-05-17 08:19:25', 2, 6, 0, 65, '2023-05-11 09:30:10', 0, 0, 0, 0, '', 'completed', NULL, '<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">PROJECT TITLE:</span></strong><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">23KI0077-Rehabilitation of Drainage Along National Roads</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">CONTRACTOR: </span></strong><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">SBU Builders &amp; General Merchandise</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">PROJECT LOCATION:</span></strong><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">&nbsp;Canubay-Mobod, Oroquieta City</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">PROJECT NATURE:</span></strong><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">&nbsp;DPWH<span style=\"mso-spacerun: yes;\">&nbsp;1st District&nbsp;</span>Implemented</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">PROJECT COST:</span></strong><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\"> Php 8,125,000.00</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">DATE STARTED:</span></strong><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">&nbsp;April 02, 2023</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">DATE OF MONITORING:</span></strong><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">&nbsp;May 11, 2023</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">SPECIFIC ACTIVITY: </span></strong><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">demolition of existing structure-breaking concrete</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">Percentage of SKILLED WORKERS</span></strong><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">-100%, LHSW-2 from Within Project barangay(Mobod) and Far barangay(Talairon)</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">Percentage of SKILLED WORKERS</span></strong><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">-100%, LHUSW-5 from Within Project barangay(Mobod) and Far barangay(San Vicenre Bajo and Apil)</span></p>\r\n<p style=\"margin: 0in; margin-bottom: .0001pt; line-height: 19.5pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">COMPLIANT</span></strong><span style=\"font-size: 11.5pt; font-family: \'Arial\',sans-serif; color: #444444;\">-based on Labor Localization Ordinance</span></p>\r\n<p class=\"MsoNormal\">&nbsp;</p>', 'updated', '2023-05-18 14:51:40', NULL),
(17, 12, '131', '2023-05-17 08:20:16', 2, 6, 0, 65, '2023-05-11 14:30:10', 0, 0, 0, 0, '', 'completed', NULL, '<p><strong>PROJECT TITLE:</strong> 23KI0001-REHABILITATION(COMPLETION) OF MULTI-PURPOSE BUILDING</p>\r\n<p><strong>CONTRACTOR:</strong> RRJ BUILDERS CONSTRUCTION &amp; GENERAL MERCHANDISE</p>\r\n<p><strong>PROJECT LOCATION:</strong> Paypayan, Oroquieta City</p>\r\n<p><strong>PROJECT NATURE:</strong> DPWH 1ST District Implemented</p>\r\n<p><strong>PROJECT COST:</strong> Php 1,863,007.92</p>\r\n<p><strong>DATE STARTED:</strong> April 2, 2023</p>\r\n<p><strong>DATE OF MONITORING:</strong> May 11, 2023</p>\r\n<p><strong>SPECIFIC ACTIVITY:</strong> finishing, ceiling joist</p>\r\n<p><strong>Percentage of SKILLED WORKERS</strong>-50%, LHSW-2 from Within Project barangay(Paypayan) and Far barangay(Dullan Norte)</p>\r\n<p><strong>Percentage of Unskilled workers</strong>-50%, LHUSW-3 from Within Project barangay(Paypayan,2) and Far barangay(Upper Langcangan)</p>\r\n<p><strong>COMPLIANT</strong>-based on Labor Localization Ordinance</p>', 'updated', '2023-05-18 11:41:34', NULL),
(18, 19, '132', '2023-05-17 08:38:59', 1, 4, 0, 111, '2023-05-12 09:00:00', 89, 1, 0, 0, '<p>Please encode the receivables</p>', 'completed', NULL, '<p>RECIEVABLES</p>\r\n<p>1.) Nilo Sarial - 1950.00</p>\r\n<p>2.) Violy Sugalam - 830.00</p>\r\n<p>3.) Ronel Gumalas - 1250.00</p>\r\n<p>4.) Raymundo Padogdog - 900.00</p>\r\n<p>5.) Ricky Tual - 150.00</p>\r\n<p>6.) Jonwyne Montipon - 2,900.00</p>\r\n<p>7.) Grecerio Gaas - 15405.00</p>\r\n<p>8.) Rico Sugalam - 1250.00</p>\r\n<p>9.) Lorena/Jaime Gumeason - 1250.00</p>\r\n<p>10.) Diosdado Penalte - 500.00</p>\r\n<p>11.) Pablo Floriza - 150.00</p>\r\n<p>12.) Erick Floriza - 1250.00</p>\r\n<p>13.) Lanie Sugalam - 1450.00</p>\r\n<p>14.) Arnel Penaran - 750.00</p>\r\n<p>15.) Elmer Malayon - 1100.00</p>\r\n<p>16.) Angelito Penaran Jr. - 1170.00</p>\r\n<p>17.) Bernaldo Tual - 850.00</p>\r\n<p>18.) Nick Floriza - 1350.00</p>\r\n<p>19.) Sarah Carillo - 1250.00</p>\r\n<p>20.) Jomie Asok - 1000.00</p>\r\n<p>21.) Ricky Sugalam - 1250.00</p>\r\n<p>22.) Mely Salibay - 1250.00</p>\r\n<p>23.) Modisto Labor - 250</p>\r\n<p>24.) Joy Gumeason - 250.00</p>\r\n<p>25.) Ronald Sugalam - 2000.00</p>\r\n<p>26.) Elpidio Malayon - 250.00</p>\r\n<p>27.) Jonwyne Montipon Jr. - 1200.00</p>\r\n<p>28.) Gerwin Malayon - 1250.00</p>\r\n<p>29.) Eddie Tual - 200.00</p>\r\n<p>30.) Robert Cagas - 1200.00</p>\r\n<p>31.) Leny Sumanduran - 1150.00</p>', 'updated', '2023-05-23 11:56:57', '2023-05-23 03:59:11'),
(19, 19, '133', '2023-05-17 08:42:56', 1, 4, 0, 111, '2023-05-17 09:00:00', 47, 1, 0, 0, '', 'completed', NULL, '', 'updated', '2023-05-18 10:11:52', NULL),
(20, 19, '134', '2023-05-17 08:43:45', 1, 1, 0, 112, '2023-05-17 09:00:00', 47, 0, 0, 1, '', 'completed', NULL, '<p>* wala nadayon ug re-elect of officers ky dili ma qurom ang mga members apil na ang mga officers nila.</p>\r\n<p>* dili pa utangon ug rice ang mga dagko pa ug bayronon.</p>\r\n<p>* every meeting dapat mu data sa utang.</p>\r\n<p>* karong next meeting nila June 2, 2023 mihangyo sila f pwede mu attend si ma\'am Marilou.</p>', 'updated', '2023-05-18 12:57:39', NULL),
(21, 18, '135', '2023-05-17 10:22:34', 1, 10, 0, 1, '2023-05-11 10:22:14', 0, 0, 0, 0, '<p>Please indicate names of monitored beneficiaries and their status under the proceedings</p>', 'completed', NULL, '<p>Barangay Tipan - 8 individuals - Operational</p>\r\n<p>1. Jasinta Lumasag - monthly sales P18,000/ dili monthly ang kita sa ila baboyan&nbsp;</p>\r\n<p>2. Jefrey Lumasag - monthly sales 17,500/ dili monthly ang kita sa ila baboyan</p>\r\n<p>3. Genna Divino - sales 7,800/ expenses 6,000</p>\r\n<p>4. Annie Baron - sales 7,280/ expenses 4,800</p>\r\n<p>5. Maribeth Salibay - sales 40,000/ expenses 30,000</p>\r\n<p>6. Joan Dano - sales 5,000/ expenses 3,000</p>\r\n<p>7. Rosalinda Abal - operational(iya anak nagbantay)</p>\r\n<p>8. Erlanda Belarma - 39,000/ expenses monthly 25,000</p>', 'updated', '2023-05-18 11:27:31', '2023-05-18 07:23:10'),
(22, 18, '136', '2023-05-17 10:48:44', 1, 1, 0, 112, '2023-05-17 10:48:29', 0, 0, 0, 1, '', 'pending', NULL, NULL, 'to-update', '0000-00-00 00:00:00', NULL),
(23, 15, '137', '2023-05-18 15:28:38', 1, 4, 0, 111, '2023-05-17 08:00:00', 113, 1, 0, 0, '<p>Please make corrections</p>\n<p>Not Apil farmers Association and please correct also the amount</p>', 'pending', NULL, '<p>Discuss Annual Report &amp; Monitor the income</p>', 'updated', '2023-05-22 10:40:56', '2023-05-24 01:02:21'),
(24, 19, '138', '2023-05-18 17:05:30', 1, 1, 0, 112, '2023-05-19 09:00:00', 89, 0, 0, 1, '', 'completed', NULL, '', 'updated', '2023-05-19 15:34:56', NULL),
(25, 12, '139', '2023-05-19 08:24:11', 2, 9, 0, 0, '2023-05-19 09:00:00', 0, 0, 0, 0, '', 'completed', NULL, '<p>Pre Construction Meeting at Lamac Lower Barangay Office:</p>\r\n<p>PROJECT NAME: CONCRETING OF G.H. DEL PILAR STREET (CEMETERY ROAD)&nbsp;</p>\r\n<p>LOCATION: BARANGAY LOWER LAMAC, OROQUIETA CITY</p>\r\n<p>CONTRACT DURATION: 104 Calendar Days</p>\r\n<p>CONTRACT EFFECTIVITY: May 22, 2023</p>\r\n<p>TARGET COMPLETION: September 2, 2023</p>\r\n<p>Source of Funds: 20% LDF-CY 2022(continuing)</p>\r\n<p>CONTRACT AMOUNT: P1,875,640.00</p>\r\n<p>CONTRACTOR: DDS BUILDERS</p>\r\n<p>The CEO will contact PESO if the project will start</p>\r\n<p>&nbsp;</p>', 'updated', '2023-05-19 14:28:31', NULL),
(26, 12, '140', '2023-05-19 08:26:01', 2, 9, 0, 0, '2023-05-19 10:30:00', 0, 0, 0, 0, '<p>is it possible to issue skilled workers referral?</p>', 'completed', NULL, '<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Times New Roman\';\">Pre Construction Meeting at Poblacion 1:</span></p>\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Times New Roman\';\">PROJECT NAME: CONSTRUCTION OF POBLACION 1 BARANGAY HEALTH CENTER</span></p>\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Times New Roman\';\">LOCATION: BARANGAY POBLACION 1, OROQUIETA CITY</span></p>\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Times New Roman\';\">CONTRACT DURATION: 105 Calendar Days</span></p>\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Times New Roman\';\">CONTRACT EFFECTIVITY: May 19, 2023</span></p>\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Times New Roman\';\">TARGET COMPLETION: August 31, 2023</span></p>\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Times New Roman\';\">Source of Funds: 20% LDF-CY 2022(continuing)</span></p>\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Times New Roman\';\">CONTRACT AMOUNT: P1,822,700.00</span></p>\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Times New Roman\';\">CONTRACTOR: SBU BUILDERS AND GENERAL MERCHANDISE</span></p>\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Times New Roman\';\">The CEO will contact PESO if the project will start</span></p>\r\n<p class=\"MsoNormal\">&nbsp;</p>', 'updated', '2023-05-19 14:34:25', '2023-05-22 02:28:38'),
(27, 18, '141', '2023-05-22 11:21:21', 1, 4, 0, 111, '2023-05-22 10:00:00', 53, 1, 0, 0, '<p>Why is that the COH not equal or more than the total colelctions? Please monitor their monthly repayment scheme and identify those who did not pay regularly.</p>', 'pending', NULL, '<p>Discuss Annual Report &amp; Monitored the income</p>', 'updated', '2023-05-22 11:24:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_of_activities`
--

CREATE TABLE `type_of_activities` (
  `type_of_activity_id` int(50) UNSIGNED NOT NULL,
  `type_of_activity_name` varchar(150) NOT NULL,
  `type_act_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `type_of_activities`
--

INSERT INTO `type_of_activities` (`type_of_activity_id`, `type_of_activity_name`, `type_act_created`) VALUES
(1, 'Regular Monthly Meeting', '2023-04-27 23:11:32'),
(2, 'Regular Monthly Coop Visit', '2023-04-27 23:11:53'),
(3, 'Job Vacancy Solicitation', '2023-04-27 23:12:04'),
(4, 'Regular Monthly Project Monitoring', '2023-04-27 23:12:25'),
(5, 'Training', '2023-04-27 23:12:31'),
(6, 'Other Activity', '2023-05-09 13:42:59'),
(7, 'Local Recruitment Activity', '2023-05-09 13:57:10'),
(8, 'Inspection', '2023-05-10 09:50:37'),
(9, 'Pre-construction Meeting', '2023-05-10 09:51:26'),
(10, 'Livelihood Assistance Grant (LAG) Monitoring', '2023-05-10 12:46:27');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_request`
--

CREATE TABLE `type_of_request` (
  `type_of_request_id` int(20) NOT NULL,
  `type_of_request_name` varchar(150) NOT NULL,
  `type_of_request_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_of_request`
--

INSERT INTO `type_of_request` (`type_of_request_id`, `type_of_request_name`, `type_of_request_created`) VALUES
(4, 'Employement Referral', '2023-05-02 22:22:29'),
(5, 'Skills Training', '2023-05-02 22:23:41'),
(6, 'on-line services', '2023-05-02 22:23:50'),
(7, 'registration', '2023-05-02 22:23:56'),
(8, 'accreditation', '2023-05-02 22:24:12'),
(9, 'annual report preparation', '2023-05-02 22:24:24'),
(10, 'OWWA Scholarship - ODSP/EDSP', '2023-05-02 22:24:34'),
(11, 'OWWA Benefits', '2023-05-02 22:25:35'),
(12, 'OWWA Welfare Case', '2023-05-02 22:25:56'),
(13, 'inquiry', '2023-05-02 22:26:08'),
(14, 'application letter and resume-making', '2023-05-02 22:26:21'),
(15, 're-integration program for OFW\'s', '2023-05-02 22:26:52'),
(16, 'free clearance for 1st-time jobseekers', '2023-05-02 22:27:16'),
(17, 'Labor Market Information(LMI)', '2023-05-02 22:27:31'),
(18, 'Livelihood', '2023-05-02 22:27:35'),
(19, 'Job Vacancy for Posting', '2023-05-02 22:27:48'),
(20, 'Payroll Processing', '2023-05-17 16:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `under_type_of_activity`
--

CREATE TABLE `under_type_of_activity` (
  `under_type_act_id` int(50) UNSIGNED NOT NULL,
  `typ_ac_id` int(50) NOT NULL,
  `under_type_act_name` varchar(150) NOT NULL,
  `under_type_act_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `under_type_of_activity`
--

INSERT INTO `under_type_of_activity` (`under_type_act_id`, `typ_ac_id`, `under_type_act_name`, `under_type_act_created`) VALUES
(1, 5, 'SKL', '2023-04-27 23:12:41'),
(2, 5, 'MDT', '2023-04-27 23:12:45'),
(3, 5, 'CD', '2023-04-27 23:12:48'),
(4, 5, 'PRS', '2023-04-27 23:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(50) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `contact_number` varchar(15) NOT NULL,
  `address` varchar(150) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `profile_pic` varchar(50) DEFAULT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `work_status` set('jo','regular') DEFAULT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_name`, `last_name`, `extension`, `contact_number`, `address`, `email_address`, `profile_pic`, `user_type`, `user_status`, `work_status`, `username`, `password`, `user_created`) VALUES
(8, 'Mark Anthony', '', 'Artigas', '', '0905788844', 'Binuangan', 'markeeboi1985@gmail.com', NULL, 'admin', 'active', NULL, 'markuser', '$2y$10$LNjjAwAdQazQMF22UnUCde32RHVohPL3QPjpQ2tJMkH4xswinXPu6', '2023-04-06 16:32:32'),
(9, 'Basil John', 'C.', 'Manabo', '', '0912321321', 'Lower Rizal', 'manabobasil@gmail.com', NULL, 'user', 'active', NULL, 'basiluser', '$2y$10$9/ESqpwWBUnryLu3QtGE5OK3qNrA/nvSTp42sOH650.fNNbeyXYMu', '2023-04-07 03:04:02'),
(12, 'Katlyn Mary', '', 'Daraman', '', '0963936232', 'Canubay', 'daraman.cp', NULL, 'user', 'active', 'jo', 'katlyn1388', '$2y$10$HU/SEKRHDbELpPI10DLnx.EjP2uh0akDblmg0o1vES9lHPRc47xkC', '2023-05-05 05:00:46'),
(13, 'Judith', 'P.', 'Abuhon', '', '09107324580', 'Villaflor', 'abuhon.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'ram_tom', '$2y$10$TE3O7GRzGKGl18SRaGV9s.u7BpPN.Fsv/YHAujQXEhROnnfAm1Xbm', '2023-05-05 07:01:00'),
(14, 'Sheila Marie', '', 'Daque', '', '09516531821', 'Lower Loboc', 'daquesheilamarie@gmail.com', NULL, 'user', 'active', 'jo', 'Shelayla', '$2y$10$Md/bS.rZKXp/HDAuIkoXgOR9iwbLGGli51TY8kGiSJZZ3yyZzZsGe', '2023-05-05 07:23:18'),
(15, 'Cel', 'Betero', 'Chua', '', '0912789660', 'Talairon', 'chua.cpesd', NULL, 'user', 'active', 'jo', 'Choyerns', '$2y$10$InNvidAtcrzChJgWFn6joubY5J2nSFS7aUUlWT3ULls4pmTBBr3l2', '2023-05-05 07:25:12'),
(16, 'WIENGELYN', 'MILO', 'IBASAN', '', '0912367928', 'Tipan', 'ibasan.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'Wiengy ', '$2y$10$QsoMylmly4nLdJSS318MReBYY1a7wkNKdaGE/g7SsQvt4gJD2sS5O', '2023-05-05 07:27:14'),
(17, 'John Rick', 'Himpayan', 'Tac-an', '', '09618058910', 'Proper Langcangan', 'jrtacanambush@gmail.com', NULL, 'user', 'active', 'jo', 'John Rick', '$2y$10$gtbD6ggrpp8YD4CKOdUkj.PXYN4J2h21Z1hUONiAzi0MzwmsMRIuy', '2023-05-05 07:46:38'),
(18, 'Celrose', 'O', 'Español', '', '09465543788', 'Mobod', 'celrose14@gmail.com', NULL, 'user', 'active', 'jo', 'CELROSE', '$2y$10$GEbJsRNIXgE4JPi3Sg.4YuJXV2J6HRlcrqdkzF3loj7RcTICmqA4q', '2023-05-05 08:18:24'),
(19, 'Judy Mae', 'Taberao', 'Catane', '', '09462326054', 'Pines', 'catane.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'judai09', '$2y$10$2j8deWGJKg6ftOrTRH43pudfIajE/BBn5n8mbZ2KWTzKK90gIcg1y', '2023-05-09 14:24:42'),
(20, 'Dayanara Mae', 'Molina', 'Hipos', '', '09700746605', 'Villaflor', 'hipos.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'Dayanara', '$2y$10$qIHpUso7ScnxB4x0c3HGMOnDcAF.B4lWyx8uCkoWaxRSDf4vEcgwu', '2023-05-09 14:30:58'),
(21, 'Marilou', 'Inting', 'Gumapac ', '', '09632873186', 'Binuangan', 'gumapac.cpesdoroq@gmail.com', NULL, 'user', 'active', 'regular', 'MIG101583', '$2y$10$mqZM/5a49RucInt0oMQ8zOQEoRiww9hE67fferYtXynrhMDg.Jso2', '2023-05-10 08:49:43'),
(22, 'Reymond', 'Manlod', 'Tacastacas', '', '09090821383', 'Taboc Sur', 'verzacheboitax@gmail.com', NULL, 'user', 'active', 'jo', 'boitacs', '$2y$10$3HcPLa8XnlvpYxLpn99Xj.ZLBT5SXnfd4kl3yS3vmaPdVrIK6H05S', '2023-05-10 09:26:41'),
(23, 'Richard', 'Cariaga ', 'Liberto ', '', '09383926364', 'Canubay', 'richardliberto11@gmail.com', NULL, 'user', 'active', 'regular', 'Jhong ', '$2y$10$v83WR45m3GZb9mxaqZxp5O.3Z9l3tdTPCsuU/b0Tlyc5rn5jSvldK', '2023-05-10 09:28:27'),
(24, 'Dennamor', 'Tangcay', 'Markinex', '', '09300334135', 'Lower Langcangan', 'markinez.cpesdoroq@gmail.com', NULL, 'user', 'active', 'jo', 'amoreezz', '$2y$10$lnfNauHJ/hTWRgEXSWw2g.RIGcsvIUwCqft74vSVpnUcUxJjVwY0K', '2023-05-12 14:08:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`activity_log_id`);

--
-- Indexes for table `cso`
--
ALTER TABLE `cso`
  ADD PRIMARY KEY (`cso_id`);

--
-- Indexes for table `cso_officers`
--
ALTER TABLE `cso_officers`
  ADD PRIMARY KEY (`cso_officer_id`);

--
-- Indexes for table `cso_project_implemented`
--
ALTER TABLE `cso_project_implemented`
  ADD PRIMARY KEY (`cso_project_implemented_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_monitoring`
--
ALTER TABLE `project_monitoring`
  ADD PRIMARY KEY (`project_monitoring_id`);

--
-- Indexes for table `responsibility_center`
--
ALTER TABLE `responsibility_center`
  ADD PRIMARY KEY (`responsibility_center_id`);

--
-- Indexes for table `responsible_section`
--
ALTER TABLE `responsible_section`
  ADD PRIMARY KEY (`responsible_section_id`);

--
-- Indexes for table `rfa_clients`
--
ALTER TABLE `rfa_clients`
  ADD PRIMARY KEY (`rfa_client_id`);

--
-- Indexes for table `rfa_transactions`
--
ALTER TABLE `rfa_transactions`
  ADD PRIMARY KEY (`rfa_id`);

--
-- Indexes for table `rfa_transaction_history`
--
ALTER TABLE `rfa_transaction_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`training_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `type_of_activities`
--
ALTER TABLE `type_of_activities`
  ADD PRIMARY KEY (`type_of_activity_id`);

--
-- Indexes for table `type_of_request`
--
ALTER TABLE `type_of_request`
  ADD PRIMARY KEY (`type_of_request_id`);

--
-- Indexes for table `under_type_of_activity`
--
ALTER TABLE `under_type_of_activity`
  ADD PRIMARY KEY (`under_type_act_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `activity_log_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cso`
--
ALTER TABLE `cso`
  MODIFY `cso_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `cso_officers`
--
ALTER TABLE `cso_officers`
  MODIFY `cso_officer_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cso_project_implemented`
--
ALTER TABLE `cso_project_implemented`
  MODIFY `cso_project_implemented_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_monitoring`
--
ALTER TABLE `project_monitoring`
  MODIFY `project_monitoring_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `responsibility_center`
--
ALTER TABLE `responsibility_center`
  MODIFY `responsibility_center_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `responsible_section`
--
ALTER TABLE `responsible_section`
  MODIFY `responsible_section_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rfa_clients`
--
ALTER TABLE `rfa_clients`
  MODIFY `rfa_client_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rfa_transactions`
--
ALTER TABLE `rfa_transactions`
  MODIFY `rfa_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `rfa_transaction_history`
--
ALTER TABLE `rfa_transaction_history`
  MODIFY `history_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `training_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `type_of_activities`
--
ALTER TABLE `type_of_activities`
  MODIFY `type_of_activity_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `type_of_request`
--
ALTER TABLE `type_of_request`
  MODIFY `type_of_request_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `under_type_of_activity`
--
ALTER TABLE `under_type_of_activity`
  MODIFY `under_type_act_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
