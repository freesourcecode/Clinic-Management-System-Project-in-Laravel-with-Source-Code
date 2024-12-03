-- MySQL dump 10.13  Distrib 5.5.55, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: lokanthali_clinic
-- ------------------------------------------------------
-- Server version	5.5.55-0ubuntu0.14.04.1

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
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_date` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `patient_id` int(10) unsigned NOT NULL,
  `doctor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_patient_id_foreign` (`patient_id`),
  KEY `appointments_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Haematology','2017-07-11 05:15:43','2017-07-11 05:15:43',NULL),(2,'Biochemistry','2017-07-11 10:23:23','2017-07-11 10:23:23',NULL),(3,'PARASITOLOGY','2017-07-11 11:15:31','2017-07-11 11:15:31',NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_referreds`
--

DROP TABLE IF EXISTS `doctor_referreds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_referreds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` int(10) unsigned NOT NULL,
  `invoice_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_referreds_doctor_id_foreign` (`doctor_id`),
  KEY `doctor_referreds_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `doctor_referreds_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `doctor_referreds_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_referreds`
--

LOCK TABLES `doctor_referreds` WRITE;
/*!40000 ALTER TABLE `doctor_referreds` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctor_referreds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) unsigned NOT NULL,
  `fee` double(8,2) NOT NULL,
  `opd_charge` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctors_employee_id_foreign` (`employee_id`),
  CONSTRAINT `doctors_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `education` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speciality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `working_day` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `out_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_department_id_foreign` (`department_id`),
  CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examination_results`
--

DROP TABLE IF EXISTS `examination_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examination_results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_report_id` int(10) unsigned NOT NULL,
  `macroscopic_result` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `microscopic_result` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `examination_results_test_report_id_foreign` (`test_report_id`),
  CONSTRAINT `examination_results_test_report_id_foreign` FOREIGN KEY (`test_report_id`) REFERENCES `test_reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examination_results`
--

LOCK TABLES `examination_results` WRITE;
/*!40000 ALTER TABLE `examination_results` DISABLE KEYS */;
INSERT INTO `examination_results` VALUES (1,4,'a:5:{i:0;s:11:\"L.Yellowish\";i:1;s:5:\"Clear\";i:2;s:3:\"Nil\";i:3;s:3:\"Nil\";i:4;s:6:\"Acidic\";}','a:6:{i:0;s:3:\"0-2\";i:1;s:3:\"0-2\";i:2;s:3:\"Nil\";i:3;s:3:\"Nil\";i:4;s:3:\"Nil\";i:5;s:13:\"Bacteria Seen\";}','a:2:{s:19:\"macroscopic_comment\";N;s:19:\"microscopic_comment\";N;}','2017-07-11 11:21:37','2017-07-11 11:21:37');
/*!40000 ALTER TABLE `examination_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hospitals`
--

DROP TABLE IF EXISTS `hospitals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hospitals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pan_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_prefix` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LWC-',
  `patient_prefix` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LWC-',
  `tax_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_percent` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hospitals`
--

LOCK TABLES `hospitals` WRITE;
/*!40000 ALTER TABLE `hospitals` DISABLE KEYS */;
INSERT INTO `hospitals` VALUES (1,'Lokanthali Welness Clinic','Enhancing Life, Excelling Incase...','uploads/logo.png','Lokanthali-1, Madhyapur Thimi, Bhaktpur,Nepal ','+9779860479432 ,+9779846288255','lwc2074@gmail.com','123','12345','Invoice','lwc.health.com','Our moto healty life.','LWC-','LWC-','Health Tax',5,NULL,NULL,NULL);
/*!40000 ALTER TABLE `hospitals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_returns`
--

DROP TABLE IF EXISTS `invoice_returns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_returns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) unsigned NOT NULL,
  `return_amount` double(8,2) NOT NULL,
  `return_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_returns_invoice_id_foreign` (`invoice_id`),
  KEY `invoice_returns_user_id_foreign` (`user_id`),
  CONSTRAINT `invoice_returns_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoice_returns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_returns`
--

LOCK TABLES `invoice_returns` WRITE;
/*!40000 ALTER TABLE `invoice_returns` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_returns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cash',
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` double(8,2) NOT NULL,
  `sub_total` double(8,2) NOT NULL,
  `tax_amount` double(8,2) NOT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `cash` double(8,2) DEFAULT NULL,
  `patient_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_user_id_foreign` (`user_id`),
  KEY `invoices_patient_id_foreign` (`patient_id`),
  CONSTRAINT `invoices_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,1,'LWC-1','Cash',NULL,367.50,350.00,17.50,NULL,400.00,1,1,'2017-07-11 06:59:58','2017-07-11 06:59:58',NULL),(2,1,'LWC-2','Cash',NULL,517.50,492.86,24.64,NULL,600.00,1,1,'2017-07-11 10:26:11','2017-07-11 10:26:11',NULL),(3,1,'LWC-3','Cash',NULL,50.00,47.62,2.38,NULL,51.00,1,1,'2017-07-11 11:19:13','2017-07-11 11:19:13',NULL),(4,1,'LWC-4','Cash',NULL,500.00,476.19,23.81,NULL,500.00,1,1,'2017-07-11 11:45:35','2017-07-11 11:45:35',NULL);
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_05_03_144856_create_hospitals_table',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2016_09_04_000000_create_roles_table',1),(5,'2017_05_03_105229_create_departments_table',1),(6,'2017_05_03_108812_create_employees_table',1),(7,'2017_05_03_113257_create_doctors_table',1),(8,'2017_05_03_113812_create_services_table',1),(9,'2017_05_03_114713_create_patients_table',1),(10,'2017_05_03_144134_create_appointments_table',1),(11,'2017_05_07_103011_create_invoices_table',1),(12,'2017_05_07_103212_create_service_sales_table',1),(13,'2017_05_10_172506_create_temps_table',1),(14,'2017_05_12_115857_create_tests_table',1),(15,'2017_05_12_121150_create_test_references_table',1),(16,'2017_05_13_084837_create_test_test_reference_table',1),(17,'2017_05_13_160840_create_reports_table',1),(18,'2017_05_16_134531_create_opd_sales_table',1),(19,'2017_05_20_112840_create_test_reports_table',1),(20,'2017_05_21_065026_create_test_results_table',1),(21,'2017_05_26_141428_create_invoice_returns_table',1),(22,'2017_05_27_142501_create_doctor_referreds_table',1),(23,'2017_05_29_154917_create_packages_table',1),(24,'2017_05_29_155432_create_package_tests_table',1),(25,'2017_05_29_155748_create_package_sales_table',1),(26,'2017_06_13_061359_create_permission_role_table',1),(27,'2017_06_23_151525_create_reference_results_table',1),(28,'2017_06_23_153028_create_test_examinations_table',1),(29,'2017_06_23_155143_create_examination_results_table',1),(30,'2017_06_23_155601_create_test_antibiotics_table',1),(31,'2017_06_23_155702_create_test_test_antibiotic_table',1),(32,'2017_06_23_164519_create_permissions_table',1),(33,'2017_07_03_143253_create_test_stains_table',1),(34,'2017_07_04_164725_create_test_reference_results_table',1),(35,'2017_07_08_070551_create_test_antibiotic_results_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opd_sales`
--

DROP TABLE IF EXISTS `opd_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opd_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `opd_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_id` int(10) unsigned NOT NULL,
  `invoice_id` int(10) unsigned NOT NULL,
  `doctor_fee` double(8,2) NOT NULL,
  `opd_charge` double(8,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `opd_sales_doctor_id_foreign` (`doctor_id`),
  KEY `opd_sales_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `opd_sales_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opd_sales_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opd_sales`
--

LOCK TABLES `opd_sales` WRITE;
/*!40000 ALTER TABLE `opd_sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `opd_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_sales`
--

DROP TABLE IF EXISTS `package_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` int(10) unsigned NOT NULL,
  `invoice_id` int(10) unsigned NOT NULL,
  `patient_id` int(10) unsigned NOT NULL,
  `package_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `package_sales_package_id_foreign` (`package_id`),
  KEY `package_sales_invoice_id_foreign` (`invoice_id`),
  KEY `package_sales_patient_id_foreign` (`patient_id`),
  CONSTRAINT `package_sales_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `package_sales_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `package_sales_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_sales`
--

LOCK TABLES `package_sales` WRITE;
/*!40000 ALTER TABLE `package_sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `package_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_tests`
--

DROP TABLE IF EXISTS `package_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_tests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` int(10) unsigned NOT NULL,
  `test_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `package_tests_test_id_foreign` (`test_id`),
  KEY `package_tests_package_id_foreign` (`package_id`),
  CONSTRAINT `package_tests_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `package_tests_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_tests`
--

LOCK TABLES `package_tests` WRITE;
/*!40000 ALTER TABLE `package_tests` DISABLE KEYS */;
/*!40000 ALTER TABLE `package_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female','Other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nepal',
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bagmati',
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Kathmandu',
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relative_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relative_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` enum('single','married','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` enum('A+','A-','B+','AB+','AB-','B-','O+','O-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'ASHA',NULL,'SUBEDI',NULL,19,NULL,'Female',NULL,'Nepal','Bagmati','Kathmandu','Lokanthali',NULL,NULL,NULL,NULL,'married',NULL,'2017-07-11 06:59:44','2017-07-11 07:02:07',NULL);
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1,1,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(2,1,2,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(3,1,3,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(4,1,4,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(5,1,5,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(6,1,6,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(7,1,7,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(8,1,8,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(9,1,9,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(10,1,10,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(11,1,11,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(12,1,12,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(13,1,13,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(14,1,14,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(15,1,15,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(16,1,16,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(17,1,17,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(18,1,18,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(19,1,19,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(20,1,20,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(21,1,21,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(22,1,22,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(23,1,23,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(24,1,24,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(25,1,25,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(26,1,26,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(27,1,27,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(28,1,28,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(29,1,29,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(30,1,30,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(31,1,31,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(32,1,32,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(33,1,33,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(34,1,34,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(35,1,35,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(36,1,36,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(37,1,37,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(38,1,38,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(39,1,39,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(40,1,40,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(41,1,41,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(42,1,42,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(43,1,43,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(44,1,44,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(45,1,45,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(46,1,46,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(47,1,47,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(48,1,48,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(49,1,49,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(50,1,50,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(51,1,51,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(52,1,52,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(53,1,53,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(54,1,54,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(55,1,55,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(56,1,56,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(57,1,57,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(58,1,58,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(59,1,59,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(60,1,60,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(61,1,61,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(62,1,62,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(63,1,63,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(64,1,64,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(65,1,65,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(66,1,66,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(67,1,67,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(68,1,68,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(69,1,69,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(70,1,70,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(71,1,71,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(72,1,72,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(73,1,73,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(74,1,74,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(75,1,75,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(76,1,76,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(77,1,77,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(78,1,78,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(79,1,79,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(80,1,80,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(81,1,81,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(82,1,82,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(83,1,83,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(84,1,84,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(85,1,85,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(86,1,86,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(87,1,87,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(88,1,88,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(89,1,89,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(90,1,90,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(91,1,91,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(92,1,92,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(93,1,93,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(94,1,94,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(95,1,95,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(96,1,96,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(97,1,97,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(98,1,98,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(99,1,99,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(100,1,100,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(101,1,101,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(102,1,102,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(103,1,103,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(104,1,104,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(105,1,105,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(106,1,106,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(107,1,107,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(108,1,108,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(109,1,109,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(110,1,110,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(111,1,111,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(112,1,112,'2017-07-10 22:53:41','2017-07-10 22:53:41'),(113,2,1,'2017-07-10 22:58:18','2017-07-10 22:58:18');
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'dashboard','index','dashboard.index','2017-07-10 22:53:37','2017-07-10 22:53:37'),(2,'hospital','setting','hospital.setting','2017-07-10 22:53:37','2017-07-10 22:53:37'),(3,'change','password','change.password','2017-07-10 22:53:37','2017-07-10 22:53:37'),(4,'hospital','update','hospital.update','2017-07-10 22:53:37','2017-07-10 22:53:37'),(5,'tax','update','tax.update','2017-07-10 22:53:37','2017-07-10 22:53:37'),(6,'config','update','config.update','2017-07-10 22:53:37','2017-07-10 22:53:37'),(7,'user','index','user.index','2017-07-10 22:53:37','2017-07-10 22:53:37'),(8,'user','store','user.store','2017-07-10 22:53:37','2017-07-10 22:53:37'),(9,'user','edit','user.edit','2017-07-10 22:53:37','2017-07-10 22:53:37'),(10,'user','delete','user.delete','2017-07-10 22:53:37','2017-07-10 22:53:37'),(11,'department','index','department.index','2017-07-10 22:53:37','2017-07-10 22:53:37'),(12,'department','add','department.add','2017-07-10 22:53:38','2017-07-10 22:53:38'),(13,'department','edit','department.edit','2017-07-10 22:53:38','2017-07-10 22:53:38'),(14,'department','delete','department.delete','2017-07-10 22:53:38','2017-07-10 22:53:38'),(15,'service','index','service.index','2017-07-10 22:53:38','2017-07-10 22:53:38'),(16,'service','add','service.add','2017-07-10 22:53:38','2017-07-10 22:53:38'),(17,'service','edit','service.edit','2017-07-10 22:53:38','2017-07-10 22:53:38'),(18,'service','delete','service.delete','2017-07-10 22:53:38','2017-07-10 22:53:38'),(19,'employee','index','employee.index','2017-07-10 22:53:38','2017-07-10 22:53:38'),(20,'employee','create','employee.create','2017-07-10 22:53:38','2017-07-10 22:53:38'),(21,'employee','store','employee.store','2017-07-10 22:53:38','2017-07-10 22:53:38'),(22,'employee','show','employee.show','2017-07-10 22:53:38','2017-07-10 22:53:38'),(23,'employee','edit','employee.edit','2017-07-10 22:53:38','2017-07-10 22:53:38'),(24,'employee','update','employee.update','2017-07-10 22:53:38','2017-07-10 22:53:38'),(25,'employee','destroy','employee.destroy','2017-07-10 22:53:38','2017-07-10 22:53:38'),(26,'doctor','index','doctor.index','2017-07-10 22:53:38','2017-07-10 22:53:38'),(27,'doctor','create','doctor.create','2017-07-10 22:53:38','2017-07-10 22:53:38'),(28,'doctor','store','doctor.store','2017-07-10 22:53:38','2017-07-10 22:53:38'),(29,'doctor','show','doctor.show','2017-07-10 22:53:38','2017-07-10 22:53:38'),(30,'doctor','edit','doctor.edit','2017-07-10 22:53:38','2017-07-10 22:53:38'),(31,'doctor','update','doctor.update','2017-07-10 22:53:38','2017-07-10 22:53:38'),(32,'doctor','destroy','doctor.destroy','2017-07-10 22:53:38','2017-07-10 22:53:38'),(33,'patient','index','patient.index','2017-07-10 22:53:38','2017-07-10 22:53:38'),(34,'patient','create','patient.create','2017-07-10 22:53:38','2017-07-10 22:53:38'),(35,'patient','store','patient.store','2017-07-10 22:53:38','2017-07-10 22:53:38'),(36,'patient','show','patient.show','2017-07-10 22:53:38','2017-07-10 22:53:38'),(37,'patient','edit','patient.edit','2017-07-10 22:53:38','2017-07-10 22:53:38'),(38,'patient','update','patient.update','2017-07-10 22:53:38','2017-07-10 22:53:38'),(39,'patient','destroy','patient.destroy','2017-07-10 22:53:39','2017-07-10 22:53:39'),(40,'appointment','index','appointment.index','2017-07-10 22:53:39','2017-07-10 22:53:39'),(41,'appointment','create','appointment.create','2017-07-10 22:53:39','2017-07-10 22:53:39'),(42,'appointment','store','appointment.store','2017-07-10 22:53:39','2017-07-10 22:53:39'),(43,'appointment','show','appointment.show','2017-07-10 22:53:39','2017-07-10 22:53:39'),(44,'appointment','edit','appointment.edit','2017-07-10 22:53:39','2017-07-10 22:53:39'),(45,'appointment','update','appointment.update','2017-07-10 22:53:39','2017-07-10 22:53:39'),(46,'appointment','destroy','appointment.destroy','2017-07-10 22:53:39','2017-07-10 22:53:39'),(47,'role','index','role.index','2017-07-10 22:53:39','2017-07-10 22:53:39'),(48,'role','create','role.create','2017-07-10 22:53:39','2017-07-10 22:53:39'),(49,'role','store','role.store','2017-07-10 22:53:39','2017-07-10 22:53:39'),(50,'role','show','role.show','2017-07-10 22:53:39','2017-07-10 22:53:39'),(51,'role','edit','role.edit','2017-07-10 22:53:39','2017-07-10 22:53:39'),(52,'role','update','role.update','2017-07-10 22:53:39','2017-07-10 22:53:39'),(53,'role','destroy','role.destroy','2017-07-10 22:53:39','2017-07-10 22:53:39'),(54,'package','index','package.index','2017-07-10 22:53:39','2017-07-10 22:53:39'),(55,'package','store','package.store','2017-07-10 22:53:39','2017-07-10 22:53:39'),(56,'package','edit','package.edit','2017-07-10 22:53:39','2017-07-10 22:53:39'),(57,'package','test','package.test.delete','2017-07-10 22:53:39','2017-07-10 22:53:39'),(58,'package','delete','package.delete','2017-07-10 22:53:39','2017-07-10 22:53:39'),(59,'appointment','updated','appointment.updated','2017-07-10 22:53:39','2017-07-10 22:53:39'),(60,'invoice','index','invoice.index','2017-07-10 22:53:39','2017-07-10 22:53:39'),(61,'invoice','store','invoice.store','2017-07-10 22:53:39','2017-07-10 22:53:39'),(62,'invoice','patient','invoice.patient','2017-07-10 22:53:39','2017-07-10 22:53:39'),(63,'invoice','remove','invoice.remove','2017-07-10 22:53:39','2017-07-10 22:53:39'),(64,'invoice','sale','invoice.sale','2017-07-10 22:53:39','2017-07-10 22:53:39'),(65,'invoice','opd','invoice.opd','2017-07-10 22:53:39','2017-07-10 22:53:39'),(66,'invoice','report','invoice.report','2017-07-10 22:53:39','2017-07-10 22:53:39'),(67,'search','invoice','search.invoice','2017-07-10 22:53:39','2017-07-10 22:53:39'),(68,'invoice','return','invoice.return','2017-07-10 22:53:40','2017-07-10 22:53:40'),(69,'opd','index','opd.index','2017-07-10 22:53:40','2017-07-10 22:53:40'),(70,'opd','store','opd.store','2017-07-10 22:53:40','2017-07-10 22:53:40'),(71,'package','sale','package.sale','2017-07-10 22:53:40','2017-07-10 22:53:40'),(72,'package','sale','package.sale','2017-07-10 22:53:40','2017-07-10 22:53:40'),(73,'package','sales','package.sales','2017-07-10 22:53:40','2017-07-10 22:53:40'),(74,'test','index','test.index','2017-07-10 22:53:40','2017-07-10 22:53:40'),(75,'test','status','test.status','2017-07-10 22:53:40','2017-07-10 22:53:40'),(76,'test','store','test.store','2017-07-10 22:53:40','2017-07-10 22:53:40'),(77,'test','edit','test.edit','2017-07-10 22:53:40','2017-07-10 22:53:40'),(78,'test','delete','test.delete','2017-07-10 22:53:40','2017-07-10 22:53:40'),(79,'reference','index','reference.index','2017-07-10 22:53:40','2017-07-10 22:53:40'),(80,'reference','store','reference.store','2017-07-10 22:53:40','2017-07-10 22:53:40'),(81,'reference','update','reference.update','2017-07-10 22:53:40','2017-07-10 22:53:40'),(82,'reference','delete','reference.delete','2017-07-10 22:53:40','2017-07-10 22:53:40'),(83,'antibiotic','store','antibiotic.store','2017-07-10 22:53:40','2017-07-10 22:53:40'),(84,'antibiotic','edit','antibiotic.edit','2017-07-10 22:53:40','2017-07-10 22:53:40'),(85,'haematology','index','haematology.index','2017-07-10 22:53:40','2017-07-10 22:53:40'),(86,'haematology','store','haematology.store','2017-07-10 22:53:40','2017-07-10 22:53:40'),(87,'microbiology','index','microbiology.index','2017-07-10 22:53:40','2017-07-10 22:53:40'),(88,'microbiology','store','microbiology.store','2017-07-10 22:53:40','2017-07-10 22:53:40'),(89,'examination','index','examination.index','2017-07-10 22:53:40','2017-07-10 22:53:40'),(90,'examination','store','examination.store','2017-07-10 22:53:40','2017-07-10 22:53:40'),(91,'examination','update','examination.update','2017-07-10 22:53:40','2017-07-10 22:53:40'),(92,'biochemistry','index','biochemistry.index','2017-07-10 22:53:40','2017-07-10 22:53:40'),(93,'biochemistry','store','biochemistry.store','2017-07-10 22:53:40','2017-07-10 22:53:40'),(94,'stain','index','stain.index','2017-07-10 22:53:40','2017-07-10 22:53:40'),(95,'stain','store','stain.store','2017-07-10 22:53:40','2017-07-10 22:53:40'),(96,'stain','edit','stain.edit','2017-07-10 22:53:41','2017-07-10 22:53:41'),(97,'report','index','report.index','2017-07-10 22:53:41','2017-07-10 22:53:41'),(98,'report','status','report.status','2017-07-10 22:53:41','2017-07-10 22:53:41'),(99,'report','edit','report.edit','2017-07-10 22:53:41','2017-07-10 22:53:41'),(100,'report','patient','report.patient','2017-07-10 22:53:41','2017-07-10 22:53:41'),(101,'report','update','report.update','2017-07-10 22:53:41','2017-07-10 22:53:41'),(102,'report','print','report.print','2017-07-10 22:53:41','2017-07-10 22:53:41'),(103,'result','test','result.test','2017-07-10 22:53:41','2017-07-10 22:53:41'),(104,'result','tests','result.tests','2017-07-10 22:53:41','2017-07-10 22:53:41'),(105,'result','store','result.store','2017-07-10 22:53:41','2017-07-10 22:53:41'),(106,'result','edit','result.edit','2017-07-10 22:53:41','2017-07-10 22:53:41'),(107,'report','generate','report.generate','2017-07-10 22:53:41','2017-07-10 22:53:41'),(108,'report','comment','report.comment','2017-07-10 22:53:41','2017-07-10 22:53:41'),(109,'report','result','report.result','2017-07-10 22:53:41','2017-07-10 22:53:41'),(110,'account','service','account.service','2017-07-10 22:53:41','2017-07-10 22:53:41'),(111,'account','opd','account.opd','2017-07-10 22:53:41','2017-07-10 22:53:41'),(112,'account','package','account.package','2017-07-10 22:53:41','2017-07-10 22:53:41');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reference_results`
--

DROP TABLE IF EXISTS `reference_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reference_results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_report_id` int(10) unsigned NOT NULL,
  `test_reference_id` int(10) unsigned NOT NULL,
  `result` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reference_results_test_report_id_foreign` (`test_report_id`),
  KEY `reference_results_test_reference_id_foreign` (`test_reference_id`),
  CONSTRAINT `reference_results_test_reference_id_foreign` FOREIGN KEY (`test_reference_id`) REFERENCES `test_references` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reference_results_test_report_id_foreign` FOREIGN KEY (`test_report_id`) REFERENCES `test_reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reference_results`
--

LOCK TABLES `reference_results` WRITE;
/*!40000 ALTER TABLE `reference_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `reference_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `report` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reports_patient_id_foreign` (`patient_id`),
  CONSTRAINT `reports_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (1,1,NULL,'ASHA1.pdf',NULL,1,'2017-07-11 06:59:59','2017-07-11 10:09:06',NULL),(2,1,NULL,'ASHA2.pdf',NULL,1,'2017-07-11 10:26:11','2017-07-11 11:08:55',NULL),(3,1,NULL,'ASHA3.pdf',NULL,1,'2017-07-11 11:19:13','2017-07-11 11:21:47',NULL),(4,1,NULL,'ASHA4.pdf',NULL,1,'2017-07-11 11:45:35','2017-07-11 11:47:37',NULL);
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Superadmin','Role for Super administrator','2017-07-10 22:53:41','2017-07-10 22:53:41'),(2,'User','User','2017-07-10 22:58:18','2017-07-10 22:58:18');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_sales`
--

DROP TABLE IF EXISTS `service_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `service_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `invoice_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_sales_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `service_sales_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_sales`
--

LOCK TABLES `service_sales` WRITE;
/*!40000 ALTER TABLE `service_sales` DISABLE KEYS */;
INSERT INTO `service_sales` VALUES (1,1,'Complete Blood Count (CBC',350.00,1,1,'2017-07-11 06:59:59','2017-07-11 06:59:59',NULL),(2,2,'Serum Albumin',142.86,2,1,'2017-07-11 10:26:11','2017-07-11 10:26:11',NULL),(3,1,'Complete Blood Count (CBC',350.00,2,1,'2017-07-11 10:26:11','2017-07-11 10:26:11',NULL),(4,3,'Urine Routine',47.62,3,1,'2017-07-11 11:19:13','2017-07-11 11:19:13',NULL),(5,6,'Lipid Profile Test',476.19,4,1,'2017-07-11 11:45:35','2017-07-11 11:45:35',NULL);
/*!40000 ALTER TABLE `service_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_department_id_foreign` (`department_id`),
  CONSTRAINT `services_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Complete Blood Count (CBC',350.00,1,'2017-07-11 05:16:05','2017-07-11 05:16:05',NULL),(2,'Serum Albumin',142.86,2,'2017-07-11 10:25:43','2017-07-11 10:25:43',NULL),(3,'Urine Routine',47.62,3,'2017-07-11 11:16:28','2017-07-11 11:16:28',NULL),(4,'Urea',142.86,2,'2017-07-11 11:36:55','2017-07-11 11:36:55',NULL),(5,'Ceatinine ratio',809.52,2,'2017-07-11 11:37:50','2017-07-11 11:37:50',NULL),(6,'Lipid Profile Test',476.19,2,'2017-07-11 11:38:22','2017-07-11 11:38:22',NULL),(7,'Total Cholesterol',190.48,2,'2017-07-11 11:39:14','2017-07-11 11:39:14',NULL),(8,'Triglyceride',180.80,2,'2017-07-11 11:39:43','2017-07-11 11:39:43',NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temps`
--

DROP TABLE IF EXISTS `temps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `service_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temps`
--

LOCK TABLES `temps` WRITE;
/*!40000 ALTER TABLE `temps` DISABLE KEYS */;
/*!40000 ALTER TABLE `temps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_antibiotic_results`
--

DROP TABLE IF EXISTS `test_antibiotic_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_antibiotic_results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_report_id` int(11) NOT NULL,
  `test_antibiotic_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_antibiotic_results`
--

LOCK TABLES `test_antibiotic_results` WRITE;
/*!40000 ALTER TABLE `test_antibiotic_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `test_antibiotic_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_antibiotics`
--

DROP TABLE IF EXISTS `test_antibiotics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_antibiotics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_antibiotics`
--

LOCK TABLES `test_antibiotics` WRITE;
/*!40000 ALTER TABLE `test_antibiotics` DISABLE KEYS */;
/*!40000 ALTER TABLE `test_antibiotics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_examinations`
--

DROP TABLE IF EXISTS `test_examinations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_examinations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_id` int(10) unsigned NOT NULL,
  `macroscopics` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `microscopics` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_examinations_test_id_foreign` (`test_id`),
  CONSTRAINT `test_examinations_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_examinations`
--

LOCK TABLES `test_examinations` WRITE;
/*!40000 ALTER TABLE `test_examinations` DISABLE KEYS */;
INSERT INTO `test_examinations` VALUES (1,3,'a:5:{i:0;s:5:\"Color\";i:1;s:12:\"Transparency\";i:2;s:5:\"Sugar\";i:3;s:7:\"Albumin\";i:4;s:8:\"Reaction\";}','a:6:{i:0;s:9:\"Pus Cells\";i:1;s:16:\"Epithelial Cells\";i:2;s:4:\"RBCs\";i:3;s:10:\"Cast Cells\";i:4;s:8:\"Crystals\";i:5;s:6:\"Others\";}','2017-07-11 11:18:35','2017-07-11 11:18:35');
/*!40000 ALTER TABLE `test_examinations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_reference_results`
--

DROP TABLE IF EXISTS `test_reference_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_reference_results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_report_id` int(11) NOT NULL,
  `test_reference_id` int(11) NOT NULL,
  `result` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_reference_results`
--

LOCK TABLES `test_reference_results` WRITE;
/*!40000 ALTER TABLE `test_reference_results` DISABLE KEYS */;
INSERT INTO `test_reference_results` VALUES (1,1,1,'23','L','2017-07-11 08:32:51','2017-07-11 09:52:58'),(2,1,2,'34','H','2017-07-11 08:32:51','2017-07-11 09:52:58'),(3,1,4,'345','N','2017-07-11 08:32:51','2017-07-11 08:32:51'),(4,1,5,'3456','N','2017-07-11 08:32:51','2017-07-11 08:32:51'),(5,1,6,'456dd','N','2017-07-11 08:32:51','2017-07-11 09:52:58'),(6,1,7,'3456','N','2017-07-11 08:32:51','2017-07-11 08:32:51'),(7,1,8,'45','N','2017-07-11 08:32:51','2017-07-11 08:32:51'),(8,1,9,'o+ddd','L','2017-07-11 08:32:51','2017-07-11 09:52:58'),(17,3,10,'4.6','H','2017-07-11 10:32:39','2017-07-11 11:01:19'),(18,2,1,'2','N','2017-07-11 11:08:37','2017-07-11 11:08:37'),(19,2,2,'34','H','2017-07-11 11:08:37','2017-07-11 11:08:37'),(20,2,4,'23','L','2017-07-11 11:08:37','2017-07-11 11:08:37'),(21,2,5,'33','N','2017-07-11 11:08:37','2017-07-11 11:08:37'),(22,2,6,'2','N','2017-07-11 11:08:38','2017-07-11 11:08:38'),(23,2,7,'2','N','2017-07-11 11:08:38','2017-07-11 11:08:38'),(24,2,8,'1','N','2017-07-11 11:08:38','2017-07-11 11:08:38'),(25,2,9,'O Positive','N','2017-07-11 11:08:38','2017-07-11 11:08:48'),(26,5,12,'195.0','N','2017-07-11 11:47:16','2017-07-11 11:47:16'),(27,5,13,'188.5','H','2017-07-11 11:47:16','2017-07-11 11:47:16'),(28,5,14,'40.0','N','2017-07-11 11:47:16','2017-07-11 11:47:16'),(29,5,15,'117.3','H','2017-07-11 11:47:16','2017-07-11 11:47:16'),(30,5,16,'37.3','H','2017-07-11 11:47:16','2017-07-11 11:47:16');
/*!40000 ALTER TABLE `test_reference_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_references`
--

DROP TABLE IF EXISTS `test_references`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_references` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `range` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_references`
--

LOCK TABLES `test_references` WRITE;
/*!40000 ALTER TABLE `test_references` DISABLE KEYS */;
INSERT INTO `test_references` VALUES (1,'Haemoglobin','gm/dl','Male:14-18 Female:12-16',NULL,'2017-07-11 05:17:15','2017-07-11 05:30:48',NULL),(2,'Total WBC Count','/cumm','4,000 – 11,000',NULL,'2017-07-11 05:35:07','2017-07-11 05:35:07',NULL),(3,'Differential Count',NULL,NULL,NULL,'2017-07-11 06:52:15','2017-07-11 06:52:15',NULL),(4,'Neutrophil','%','40 – 70',3,'2017-07-11 06:52:56','2017-07-11 06:52:56',NULL),(5,'Lymphocytes','%','20 – 45',3,'2017-07-11 06:53:18','2017-07-11 06:53:18',NULL),(6,'Monocyte','%','01 – 08',3,'2017-07-11 06:53:40','2017-07-11 06:53:40',NULL),(7,'Eosinophil','%','01 – 06',3,'2017-07-11 06:54:02','2017-07-11 06:54:02',NULL),(8,'Basophil','%','00 – 01',3,'2017-07-11 06:54:31','2017-07-11 06:54:31',NULL),(9,'Blood Group',NULL,NULL,NULL,'2017-07-11 06:54:41','2017-07-11 06:54:41',NULL),(10,'Serum Albumin','g/dl','3.5-5.5',NULL,'2017-07-11 10:27:25','2017-07-11 10:27:25',NULL),(11,'Total Protein','gm/dl','6.0 - 8.0',NULL,'2017-07-11 10:27:55','2017-07-11 10:27:55',NULL),(12,'Total Cholesterol','mg/dl','0 - 220',NULL,'2017-07-11 11:41:09','2017-07-11 11:59:39',NULL),(13,'Triglyceride','mg/dl','0 - 150',NULL,'2017-07-11 11:41:58','2017-07-11 11:59:52',NULL),(14,'HDL','mg/dl','35-60',NULL,'2017-07-11 11:42:53','2017-07-11 11:42:53',NULL),(15,'LDL','mg/dl','0 - 100',NULL,'2017-07-11 11:43:48','2017-07-11 11:59:27',NULL),(16,'VLDL','mg/dl','0 - 30',NULL,'2017-07-11 11:44:12','2017-07-11 12:00:27',NULL);
/*!40000 ALTER TABLE `test_references` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_reports`
--

DROP TABLE IF EXISTS `test_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `report_id` int(10) unsigned NOT NULL,
  `test_id` int(10) unsigned NOT NULL,
  `report_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_reports_test_id_foreign` (`test_id`),
  KEY `test_reports_report_id_foreign` (`report_id`),
  CONSTRAINT `test_reports_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `test_reports_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_reports`
--

LOCK TABLES `test_reports` WRITE;
/*!40000 ALTER TABLE `test_reports` DISABLE KEYS */;
INSERT INTO `test_reports` VALUES (1,1,1,'haematology',1,1,'2017-07-11 06:59:59','2017-07-11 08:35:52',NULL),(2,2,1,'haematology',1,1,'2017-07-11 10:26:11','2017-07-11 11:08:38',NULL),(3,2,2,'biochemistry',1,1,NULL,'2017-07-11 10:32:39',NULL),(4,3,3,'examination',1,1,'2017-07-11 11:19:13','2017-07-11 11:21:37',NULL),(5,4,4,'biochemistry',1,1,'2017-07-11 11:45:35','2017-07-11 11:47:16',NULL);
/*!40000 ALTER TABLE `test_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_results`
--

DROP TABLE IF EXISTS `test_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_report_id` int(10) unsigned NOT NULL,
  `result` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_results_test_report_id_foreign` (`test_report_id`),
  CONSTRAINT `test_results_test_report_id_foreign` FOREIGN KEY (`test_report_id`) REFERENCES `test_reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_results`
--

LOCK TABLES `test_results` WRITE;
/*!40000 ALTER TABLE `test_results` DISABLE KEYS */;
INSERT INTO `test_results` VALUES (1,1,NULL,1,'2017-07-11 08:35:52','2017-07-11 08:35:52',NULL),(2,3,NULL,1,'2017-07-11 10:32:39','2017-07-11 10:32:39',NULL),(3,2,NULL,1,'2017-07-11 11:08:38','2017-07-11 11:08:38',NULL),(4,5,NULL,1,'2017-07-11 11:47:16','2017-07-11 11:47:16',NULL);
/*!40000 ALTER TABLE `test_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_stains`
--

DROP TABLE IF EXISTS `test_stains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_stains` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_id` int(10) unsigned NOT NULL,
  `test_names` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_stains_test_id_foreign` (`test_id`),
  CONSTRAINT `test_stains_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_stains`
--

LOCK TABLES `test_stains` WRITE;
/*!40000 ALTER TABLE `test_stains` DISABLE KEYS */;
/*!40000 ALTER TABLE `test_stains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_test_antibiotic`
--

DROP TABLE IF EXISTS `test_test_antibiotic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_test_antibiotic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `test_antibiotic_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_test_antibiotic`
--

LOCK TABLES `test_test_antibiotic` WRITE;
/*!40000 ALTER TABLE `test_test_antibiotic` DISABLE KEYS */;
/*!40000 ALTER TABLE `test_test_antibiotic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_test_reference`
--

DROP TABLE IF EXISTS `test_test_reference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_test_reference` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `test_reference_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_test_reference`
--

LOCK TABLES `test_test_reference` WRITE;
/*!40000 ALTER TABLE `test_test_reference` DISABLE KEYS */;
INSERT INTO `test_test_reference` VALUES (1,1,1,NULL,NULL,NULL),(2,1,2,NULL,NULL,NULL),(3,1,3,NULL,NULL,NULL),(4,1,9,NULL,NULL,NULL),(5,2,10,NULL,NULL,NULL),(6,4,12,NULL,NULL,NULL),(7,4,13,NULL,NULL,NULL),(8,4,14,NULL,NULL,NULL),(9,4,15,NULL,NULL,NULL),(10,4,16,NULL,NULL,NULL);
/*!40000 ALTER TABLE `test_test_reference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tests_service_id_foreign` (`service_id`),
  CONSTRAINT `tests_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` VALUES (1,1,'Complete Blood Count (CBC','haematology',NULL,'2017-07-11 05:16:37','2017-07-11 05:16:37',NULL),(2,2,'Serum Albumin','biochemistry',NULL,'2017-07-11 10:26:33','2017-07-11 10:26:33',NULL),(3,3,'Urine Examination','examination',NULL,'2017-07-11 11:16:44','2017-07-11 11:16:44',NULL),(4,6,'Lipid Profile Test','biochemistry',NULL,'2017-07-11 11:44:35','2017-07-11 11:44:35',NULL);
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@admin.com','$2y$10$x7beZaDIEWeXC0UdR0j9Ou/rAO7xrLP4myaLxR6X6P9vDnqLx4z5q',1,'hyTyyLXG3y9OUMgvs3tZSSIgViDNBNupCngIWn4X9IIafRkMJjWQQNzANzIN','2017-07-10 22:53:42','2017-07-10 22:53:42',NULL),(2,'User','user@user.com','$2y$10$D23rsi8XLb/80kjo2/XB1eDQzj7MG2F4LvlnWtmRQ6ztHn/B6vyxy',2,'8lOypemjmvg7JtDpy4KZGAzNYEGCiaSL3Iidj9nuuMSAJbtcRK2ONTHEvmGp','2017-07-10 22:58:51','2017-07-10 22:58:51',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-23 22:00:22
