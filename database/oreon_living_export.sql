-- MySQL dump 10.13  Distrib 9.1.0, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: oreon_living
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity_id` bigint unsigned DEFAULT NULL,
  `entity_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,1,'Aditya Verma (Super Admin)','super_admin','product_quick_updated','Product',1,'Soham Earthen Water Carafe with Cork Lid','Quick update for \'Soham Earthen Water Carafe with Cork Lid\': Price ₹1499.00 -> ₹1599.00, Stock 28 -> 28','{\"price\": \"1499.00\", \"stock\": 28}','{\"price\": \"1599.00\", \"stock\": 28}','127.0.0.1','2026-10-18 05:49:06','2026-10-18 05:49:06'),(2,1,'Aditya Verma (Super Admin)','super_admin','product_quick_updated','Product',1,'Soham Earthen Water Carafe with Cork Lid','Quick update for \'Soham Earthen Water Carafe with Cork Lid\': Price ₹1599.00 -> ₹1699.00, Stock 28 -> 28','{\"price\": \"1599.00\", \"stock\": 28}','{\"price\": \"1699.00\", \"stock\": 28}','127.0.0.1','2026-10-18 05:55:28','2026-10-18 05:55:28'),(3,1,'Aditya Verma (Super Admin)','super_admin','product_quick_updated','Product',1,'Soham Earthen Water Carafe with Cork Lid','Quick update for \'Soham Earthen Water Carafe with Cork Lid\': Price ₹1699.00 -> ₹1799.00, Stock 28 -> 28','{\"price\": \"1699.00\", \"stock\": 28}','{\"price\": \"1799.00\", \"stock\": 28}','127.0.0.1','2026-10-18 05:56:38','2026-10-18 05:56:38'),(4,1,'Aditya Verma (Super Admin)','super_admin','product_quick_updated','Product',1,'Soham Earthen Water Carafe with Cork Lid','Quick update for \'Soham Earthen Water Carafe with Cork Lid\': Price ₹1799.00 -> ₹1899.00, Stock 28 -> 28','{\"price\": \"1799.00\", \"stock\": 28}','{\"price\": \"1899.00\", \"stock\": 28}','127.0.0.1','2026-10-18 05:57:09','2026-10-18 05:57:09'),(5,1,'Aditya Verma (Super Admin)','super_admin','product_quick_updated','Product',1,'Soham Earthen Water Carafe with Cork Lid','Quick update for \'Soham Earthen Water Carafe with Cork Lid\': Price ₹1899.00 -> ₹1999.00, Stock 28 -> 28','{\"price\": \"1899.00\", \"stock\": 28}','{\"price\": \"1999.00\", \"stock\": 28}','127.0.0.1','2026-10-18 05:59:12','2026-10-18 05:59:12'),(6,1,'Aditya Verma (Super Admin)','super_admin','product_quick_updated','Product',1,'Soham Earthen Water Carafe with Cork Lid','Quick update for \'Soham Earthen Water Carafe with Cork Lid\': Price ₹1999.00 -> ₹2099.00, Stock 28 -> 28','{\"price\": \"1999.00\", \"stock\": 28}','{\"price\": \"2099.00\", \"stock\": 28}','127.0.0.1','2026-10-18 06:00:26','2026-10-18 06:00:26'),(7,1,'Aditya Verma (Super Admin)','super_admin','product_quick_updated','Product',1,'Soham Earthen Water Carafe with Cork Lid','Quick update for \'Soham Earthen Water Carafe with Cork Lid\': Price ₹2099.00 -> ₹2199.00, Stock 25 -> 25','{\"price\": \"2099.00\", \"stock\": 25}','{\"price\": \"2199.00\", \"stock\": 25}','127.0.0.1','2026-10-18 06:00:52','2026-10-18 06:00:52'),(8,1,'Aditya Verma (Super Admin)','super_admin','product_quick_updated','Product',1,'Soham Earthen Water Carafe with Cork Lid','Quick update for \'Soham Earthen Water Carafe with Cork Lid\': Price ₹2199.00 -> ₹2299.00, Stock 22 -> 22','{\"price\": \"2199.00\", \"stock\": 22}','{\"price\": \"2299.00\", \"stock\": 22}','127.0.0.1','2026-10-18 06:01:26','2026-10-18 06:01:26'),(9,1,'Aditya Verma (Super Admin)','super_admin','banner_updated','HomepageBanner',1,'Crafted from Earth. Made for Living.','Updated homepage banner \'Crafted from Earth. Made for Living.\'',NULL,NULL,'127.0.0.1','2026-10-18 06:04:21','2026-10-18 06:04:21'),(10,1,'Aditya Verma (Super Admin)','super_admin','staff_logout','User',1,'Aditya Verma (Super Admin)','Staff member logged out (super_admin)',NULL,NULL,'127.0.0.1','2026-10-18 06:04:47','2026-10-18 06:04:47'),(11,6,'Siddharth Roy (Marketing Manager)','marketing_manager','staff_logout','User',6,'Siddharth Roy (Marketing Manager)','Staff member logged out (marketing_manager)',NULL,NULL,'127.0.0.1','2026-10-18 06:08:56','2026-10-18 06:08:56'),(12,4,'Kavita Joshi (Order Manager)','order_manager','staff_login','User',4,'Kavita Joshi (Order Manager)','Staff member logged in (order_manager)',NULL,NULL,'127.0.0.1','2026-10-18 06:09:00','2026-10-18 06:09:00'),(13,4,'Kavita Joshi (Order Manager)','order_manager','order_status_updated','Order',6,'OL-20261018-YDG3','Order #OL-20261018-YDG3 status changed from pending to pending','{\"order_status\": \"pending\"}','{\"order_status\": \"pending\"}','127.0.0.1','2026-10-18 06:09:32','2026-10-18 06:09:32'),(14,1,'Aditya Verma (Super Admin)','super_admin','product_quick_updated','Product',1,'Soham Earthen Water Carafe with Cork Lid','Quick update for \'Soham Earthen Water Carafe with Cork Lid\': Price ₹2299.00 -> ₹2399.00, Stock 19 -> 19','{\"price\": \"2299.00\", \"stock\": 19}','{\"price\": \"2399.00\", \"stock\": 19}','127.0.0.1','2026-10-18 06:17:54','2026-10-18 06:17:54'),(15,4,'Kavita Joshi (Order Manager)','order_manager','staff_login','User',4,'Kavita Joshi (Order Manager)','Staff member logged in (order_manager)',NULL,NULL,'127.0.0.1','2026-10-18 06:22:26','2026-10-18 06:22:26'),(16,1,'Aditya Verma (Super Admin)','super_admin','settings_updated','WebsiteSetting',NULL,'Website Configuration','Staff updated site settings: announcement_bar_text, address, meta_title_default, meta_description_default, meta_pixel_id, google_analytics_id, google_search_console_tag','{\"address\": \"Oreon Living Studio, 42 Pottery Lane, Heritage Crafts District, Bengaluru 560001, Karnataka\", \"meta_pixel_id\": \"123456789012345\", \"meta_title_default\": null, \"google_analytics_id\": \"G-OREON12345\", \"announcement_bar_text\": \"Complimentary pan-India delivery on orders above ₹1,999 • 100% Breakage-Free Guarantee\", \"meta_description_default\": null, \"google_search_console_tag\": null}','{\"address\": \"42 Pottery Lane, Heritage Crafts District, Bengaluru\", \"meta_pixel_id\": \"1234567890\", \"meta_title_default\": \"Oreon Living | Natural Earthen Clay\", \"google_analytics_id\": \"G-TEST12345\", \"announcement_bar_text\": \"Test Announcement 4896\", \"meta_description_default\": \"Pure unglazed porous pottery and terracotta wares.\", \"google_search_console_tag\": \"test-verification-code\"}','127.0.0.1','2026-11-04 12:41:39','2026-11-04 12:41:39'),(17,1,'Aditya Verma (Super Admin)','super_admin','settings_updated','WebsiteSetting',NULL,'Website Configuration','Staff updated site settings: announcement_bar_text','{\"announcement_bar_text\": \"Test Announcement 4896\"}','{\"announcement_bar_text\": \"Test Announcement 7256\"}','127.0.0.1','2026-11-04 12:42:10','2026-11-04 12:42:10'),(18,1,'Aditya Verma (Super Admin)','super_admin','product_quick_updated','Product',1,'Soham Earthen Water Carafe with Cork Lid','Quick update for \'Soham Earthen Water Carafe with Cork Lid\': Price ₹2399.00 -> ₹2499.00, Stock 18 -> 18','{\"price\": \"2399.00\", \"stock\": 18}','{\"price\": \"2499.00\", \"stock\": 18}','127.0.0.1','2026-11-04 12:42:24','2026-11-04 12:42:24'),(19,1,'Aditya Verma (Super Admin)','super_admin','settings_updated','WebsiteSetting',NULL,'Website Configuration','Staff updated site settings: announcement_bar_text','{\"announcement_bar_text\": \"Test Announcement 7256\"}','{\"announcement_bar_text\": \"Test Announcement 2221\"}','127.0.0.1','2026-11-04 12:42:24','2026-11-04 12:42:24'),(20,1,'Aditya Verma (Super Admin)','super_admin','product_quick_updated','Product',1,'Soham Earthen Water Carafe with Cork Lid','Quick update for \'Soham Earthen Water Carafe with Cork Lid\': Price ₹2499.00 -> ₹2599.00, Stock 17 -> 17','{\"price\": \"2499.00\", \"stock\": 17}','{\"price\": \"2599.00\", \"stock\": 17}','127.0.0.1','2026-11-04 13:35:50','2026-11-04 13:35:50'),(21,1,'Aditya Verma (Super Admin)','super_admin','settings_updated','WebsiteSetting',NULL,'Website Configuration','Staff updated site settings: announcement_bar_text','{\"announcement_bar_text\": \"Test Announcement 2221\"}','{\"announcement_bar_text\": \"Test Announcement 1707\"}','127.0.0.1','2026-11-04 13:35:51','2026-11-04 13:35:51'),(22,1,'Aditya Verma (Super Admin)','super_admin','product_quick_updated','Product',1,'Soham Earthen Water Carafe with Cork Lid','Quick update for \'Soham Earthen Water Carafe with Cork Lid\': Price ₹2599.00 -> ₹2699.00, Stock 16 -> 16','{\"price\": \"2599.00\", \"stock\": 16}','{\"price\": \"2699.00\", \"stock\": 16}','127.0.0.1','2026-11-04 13:37:04','2026-11-04 13:37:04'),(23,1,'Aditya Verma (Super Admin)','super_admin','settings_updated','WebsiteSetting',NULL,'Website Configuration','Staff updated site settings: announcement_bar_text','{\"announcement_bar_text\": \"Test Announcement 1707\"}','{\"announcement_bar_text\": \"Test Announcement 7263\"}','127.0.0.1','2026-11-04 13:37:05','2026-11-04 13:37:05');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'shipping',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'India',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (1,8,'shipping','Ananya Deshmukh','+91 98200 12345','Flat 402, Lotus Grandeur','14th Cross, Indiranagar','Near Defence Colony Play Ground','Bengaluru','Karnataka','560038','India',1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(2,9,'shipping','Vikram Malhotra','+91 98111 67890','B-12, Green Park Main','Second Floor','Opposite Green Park Market','New Delhi','Delhi','110016','India',1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(3,8,'shipping','Ananya Deshmukh','+91 98200 12345','Flat 402, Lotus Grandeur','14th Cross, Indiranagar',NULL,'Bengaluru','Karnataka','560038','India',0,'2026-10-18 06:05:56','2026-10-18 06:05:56');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('oreon-living-cache-roster:project:v3:8457746ca57fcc18ea2176eddff66a94','O:26:\"Laravel\\Roster\\ProjectScan\":8:{s:8:\"basePath\";s:35:\"C:\\wamp64\\www\\Oreon Living Laravel\\\";s:3:\"php\";O:35:\"Laravel\\Roster\\Ecosystems\\Ecosystem\":2:{s:9:\"\0*\0byName\";a:115:{s:10:\"brick/math\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"brick/math\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";E:43:\"Laravel\\Roster\\Enums\\PackageSource:Composer\";s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\brick\\math\";}s:31:\"carbonphp/carbon-doctrine-types\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:31:\"carbonphp/carbon-doctrine-types\";s:10:\"\0*\0version\";s:5:\"3.2.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:73:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\carbonphp\\carbon-doctrine-types\";}s:23:\"dflydev/dot-access-data\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"dflydev/dot-access-data\";s:10:\"\0*\0version\";s:5:\"3.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:65:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\dflydev\\dot-access-data\";}s:18:\"doctrine/inflector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"doctrine/inflector\";s:10:\"\0*\0version\";s:5:\"2.1.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\doctrine\\inflector\";}s:14:\"doctrine/lexer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"doctrine/lexer\";s:10:\"\0*\0version\";s:5:\"3.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\doctrine\\lexer\";}s:29:\"dragonmantank/cron-expression\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"dragonmantank/cron-expression\";s:10:\"\0*\0version\";s:5:\"3.6.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:71:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\dragonmantank\\cron-expression\";}s:23:\"egulias/email-validator\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"egulias/email-validator\";s:10:\"\0*\0version\";s:5:\"4.0.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:65:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\egulias\\email-validator\";}s:18:\"fruitcake/php-cors\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"fruitcake/php-cors\";s:10:\"\0*\0version\";s:5:\"1.4.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\fruitcake\\php-cors\";}s:27:\"graham-campbell/result-type\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"graham-campbell/result-type\";s:10:\"\0*\0version\";s:5:\"1.2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:69:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\graham-campbell\\result-type\";}s:17:\"guzzlehttp/guzzle\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"guzzlehttp/guzzle\";s:10:\"\0*\0version\";s:5:\"8.2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\guzzlehttp\\guzzle\";}s:19:\"guzzlehttp/promises\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"guzzlehttp/promises\";s:10:\"\0*\0version\";s:5:\"3.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\guzzlehttp\\promises\";}s:15:\"guzzlehttp/psr7\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"guzzlehttp/psr7\";s:10:\"\0*\0version\";s:5:\"3.2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\guzzlehttp\\psr7\";}s:23:\"guzzlehttp/uri-template\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"guzzlehttp/uri-template\";s:10:\"\0*\0version\";s:5:\"2.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:65:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\guzzlehttp\\uri-template\";}s:17:\"laravel/framework\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"13.37.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^13.17\";s:7:\"\0*\0path\";s:59:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\laravel\\framework\";}s:15:\"laravel/prompts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:6:\"0.3.26\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\laravel\\prompts\";}s:28:\"laravel/serializable-closure\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"laravel/serializable-closure\";s:10:\"\0*\0version\";s:5:\"2.1.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:70:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\laravel\\serializable-closure\";}s:14:\"laravel/tinker\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"laravel/tinker\";s:10:\"\0*\0version\";s:5:\"3.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^3.0\";s:7:\"\0*\0path\";s:56:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\laravel\\tinker\";}s:17:\"league/commonmark\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"league/commonmark\";s:10:\"\0*\0version\";s:6:\"2.10.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\league\\commonmark\";}s:13:\"league/config\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"league/config\";s:10:\"\0*\0version\";s:5:\"1.2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\league\\config\";}s:16:\"league/flysystem\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"league/flysystem\";s:10:\"\0*\0version\";s:6:\"3.36.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\league\\flysystem\";}s:22:\"league/flysystem-local\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"league/flysystem-local\";s:10:\"\0*\0version\";s:6:\"3.35.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\league\\flysystem-local\";}s:26:\"league/mime-type-detection\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"league/mime-type-detection\";s:10:\"\0*\0version\";s:6:\"1.17.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:68:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\league\\mime-type-detection\";}s:10:\"league/uri\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"league/uri\";s:10:\"\0*\0version\";s:5:\"7.9.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\league\\uri\";}s:21:\"league/uri-interfaces\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"league/uri-interfaces\";s:10:\"\0*\0version\";s:5:\"7.9.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\league\\uri-interfaces\";}s:15:\"monolog/monolog\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"monolog/monolog\";s:10:\"\0*\0version\";s:6:\"3.12.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\monolog\\monolog\";}s:13:\"nesbot/carbon\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"nesbot/carbon\";s:10:\"\0*\0version\";s:6:\"3.14.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\nesbot\\carbon\";}s:12:\"nette/schema\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"nette/schema\";s:10:\"\0*\0version\";s:5:\"1.3.6\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\nette\\schema\";}s:11:\"nette/utils\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"nette/utils\";s:10:\"\0*\0version\";s:5:\"4.1.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\nette\\utils\";}s:16:\"nikic/php-parser\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"nikic/php-parser\";s:10:\"\0*\0version\";s:5:\"5.9.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\nikic\\php-parser\";}s:19:\"nunomaduro/termwind\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"nunomaduro/termwind\";s:10:\"\0*\0version\";s:5:\"2.4.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\nunomaduro\\termwind\";}s:19:\"phpoption/phpoption\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"phpoption/phpoption\";s:10:\"\0*\0version\";s:6:\"1.10.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\phpoption\\phpoption\";}s:9:\"psr/clock\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"psr/clock\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\psr\\clock\";}s:13:\"psr/container\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"psr/container\";s:10:\"\0*\0version\";s:5:\"2.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\psr\\container\";}s:20:\"psr/event-dispatcher\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"psr/event-dispatcher\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\psr\\event-dispatcher\";}s:15:\"psr/http-client\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"psr/http-client\";s:10:\"\0*\0version\";s:5:\"1.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\psr\\http-client\";}s:16:\"psr/http-factory\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"psr/http-factory\";s:10:\"\0*\0version\";s:5:\"1.1.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\psr\\http-factory\";}s:16:\"psr/http-message\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"psr/http-message\";s:10:\"\0*\0version\";s:3:\"2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\psr\\http-message\";}s:7:\"psr/log\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:7:\"psr/log\";s:10:\"\0*\0version\";s:5:\"3.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\psr\\log\";}s:16:\"psr/simple-cache\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"psr/simple-cache\";s:10:\"\0*\0version\";s:5:\"3.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\psr\\simple-cache\";}s:9:\"psy/psysh\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"psy/psysh\";s:10:\"\0*\0version\";s:7:\"0.12.24\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\psy\\psysh\";}s:17:\"ramsey/collection\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"ramsey/collection\";s:10:\"\0*\0version\";s:5:\"2.1.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\ramsey\\collection\";}s:11:\"ramsey/uuid\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"ramsey/uuid\";s:10:\"\0*\0version\";s:5:\"4.9.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\ramsey\\uuid\";}s:13:\"symfony/clock\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"symfony/clock\";s:10:\"\0*\0version\";s:6:\"7.4.21\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\clock\";}s:15:\"symfony/console\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"symfony/console\";s:10:\"\0*\0version\";s:6:\"7.4.21\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\console\";}s:20:\"symfony/css-selector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"symfony/css-selector\";s:10:\"\0*\0version\";s:6:\"7.4.18\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\css-selector\";}s:29:\"symfony/deprecation-contracts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"symfony/deprecation-contracts\";s:10:\"\0*\0version\";s:5:\"3.7.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:71:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\deprecation-contracts\";}s:21:\"symfony/error-handler\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"symfony/error-handler\";s:10:\"\0*\0version\";s:6:\"7.4.20\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\error-handler\";}s:24:\"symfony/event-dispatcher\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:24:\"symfony/event-dispatcher\";s:10:\"\0*\0version\";s:6:\"7.4.17\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:66:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\event-dispatcher\";}s:34:\"symfony/event-dispatcher-contracts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:34:\"symfony/event-dispatcher-contracts\";s:10:\"\0*\0version\";s:5:\"3.7.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:76:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\event-dispatcher-contracts\";}s:14:\"symfony/finder\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"symfony/finder\";s:10:\"\0*\0version\";s:6:\"7.4.20\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\finder\";}s:23:\"symfony/http-foundation\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"symfony/http-foundation\";s:10:\"\0*\0version\";s:6:\"7.4.21\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:65:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\http-foundation\";}s:19:\"symfony/http-kernel\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"symfony/http-kernel\";s:10:\"\0*\0version\";s:6:\"7.4.21\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\http-kernel\";}s:14:\"symfony/mailer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"symfony/mailer\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\mailer\";}s:12:\"symfony/mime\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"symfony/mime\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\mime\";}s:22:\"symfony/polyfill-ctype\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-ctype\";s:10:\"\0*\0version\";s:6:\"1.37.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\polyfill-ctype\";}s:30:\"symfony/polyfill-intl-grapheme\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"symfony/polyfill-intl-grapheme\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:72:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\polyfill-intl-grapheme\";}s:25:\"symfony/polyfill-intl-idn\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"symfony/polyfill-intl-idn\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:67:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\polyfill-intl-idn\";}s:32:\"symfony/polyfill-intl-normalizer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"symfony/polyfill-intl-normalizer\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:74:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\polyfill-intl-normalizer\";}s:25:\"symfony/polyfill-mbstring\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"symfony/polyfill-mbstring\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:67:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\polyfill-mbstring\";}s:22:\"symfony/polyfill-php80\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php80\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\polyfill-php80\";}s:22:\"symfony/polyfill-php82\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php82\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\polyfill-php82\";}s:22:\"symfony/polyfill-php83\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php83\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\polyfill-php83\";}s:22:\"symfony/polyfill-php84\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php84\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\polyfill-php84\";}s:22:\"symfony/polyfill-php85\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php85\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\polyfill-php85\";}s:22:\"symfony/polyfill-php86\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php86\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\polyfill-php86\";}s:21:\"symfony/polyfill-uuid\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"symfony/polyfill-uuid\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\polyfill-uuid\";}s:15:\"symfony/process\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"symfony/process\";s:10:\"\0*\0version\";s:6:\"7.4.21\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\process\";}s:15:\"symfony/routing\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"symfony/routing\";s:10:\"\0*\0version\";s:6:\"7.4.21\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\routing\";}s:25:\"symfony/service-contracts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"symfony/service-contracts\";s:10:\"\0*\0version\";s:5:\"3.7.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:67:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\service-contracts\";}s:14:\"symfony/string\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"symfony/string\";s:10:\"\0*\0version\";s:6:\"7.4.21\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\string\";}s:19:\"symfony/translation\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"symfony/translation\";s:10:\"\0*\0version\";s:6:\"7.4.17\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\translation\";}s:29:\"symfony/translation-contracts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"symfony/translation-contracts\";s:10:\"\0*\0version\";s:5:\"3.7.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:71:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\translation-contracts\";}s:11:\"symfony/uid\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"symfony/uid\";s:10:\"\0*\0version\";s:6:\"7.4.21\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\uid\";}s:18:\"symfony/var-dumper\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"symfony/var-dumper\";s:10:\"\0*\0version\";s:6:\"7.4.21\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\var-dumper\";}s:33:\"tijsverkoyen/css-to-inline-styles\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"tijsverkoyen/css-to-inline-styles\";s:10:\"\0*\0version\";s:5:\"2.4.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:75:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\tijsverkoyen\\css-to-inline-styles\";}s:16:\"vlucas/phpdotenv\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"vlucas/phpdotenv\";s:10:\"\0*\0version\";s:5:\"5.7.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\vlucas\\phpdotenv\";}s:19:\"voku/portable-ascii\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"voku/portable-ascii\";s:10:\"\0*\0version\";s:5:\"2.1.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\voku\\portable-ascii\";}s:15:\"composer/semver\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"composer/semver\";s:10:\"\0*\0version\";s:5:\"3.6.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\composer\\semver\";}s:14:\"fakerphp/faker\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"fakerphp/faker\";s:10:\"\0*\0version\";s:6:\"1.24.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.23\";s:7:\"\0*\0path\";s:56:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\fakerphp\\faker\";}s:11:\"filp/whoops\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"filp/whoops\";s:10:\"\0*\0version\";s:6:\"2.18.6\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\filp\\whoops\";}s:21:\"hamcrest/hamcrest-php\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"hamcrest/hamcrest-php\";s:10:\"\0*\0version\";s:5:\"3.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\hamcrest\\hamcrest-php\";}s:22:\"laravel/agent-detector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"laravel/agent-detector\";s:10:\"\0*\0version\";s:5:\"2.0.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\laravel\\agent-detector\";}s:13:\"laravel/boost\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"laravel/boost\";s:10:\"\0*\0version\";s:6:\"2.10.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:1:\"*\";s:7:\"\0*\0path\";s:55:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\laravel\\boost\";}s:11:\"laravel/mcp\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"1.1.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\laravel\\mcp\";}s:12:\"laravel/pail\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"laravel/pail\";s:10:\"\0*\0version\";s:5:\"1.2.7\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^1.2.5\";s:7:\"\0*\0path\";s:54:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\laravel\\pail\";}s:11:\"laravel/pao\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"laravel/pao\";s:10:\"\0*\0version\";s:5:\"1.1.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^1.0.6\";s:7:\"\0*\0path\";s:53:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\laravel\\pao\";}s:12:\"laravel/pint\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.32.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.27\";s:7:\"\0*\0path\";s:54:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\laravel\\pint\";}s:14:\"laravel/roster\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"laravel/roster\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\laravel\\roster\";}s:15:\"mockery/mockery\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"mockery/mockery\";s:10:\"\0*\0version\";s:6:\"1.6.15\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^1.6\";s:7:\"\0*\0path\";s:57:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\mockery\\mockery\";}s:17:\"myclabs/deep-copy\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"myclabs/deep-copy\";s:10:\"\0*\0version\";s:6:\"1.14.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\myclabs\\deep-copy\";}s:20:\"nunomaduro/collision\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"nunomaduro/collision\";s:10:\"\0*\0version\";s:5:\"8.9.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^8.6\";s:7:\"\0*\0path\";s:62:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\nunomaduro\\collision\";}s:16:\"phar-io/manifest\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"phar-io/manifest\";s:10:\"\0*\0version\";s:5:\"2.0.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\phar-io\\manifest\";}s:15:\"phar-io/version\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"phar-io/version\";s:10:\"\0*\0version\";s:5:\"3.2.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\phar-io\\version\";}s:25:\"phpunit/php-code-coverage\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"phpunit/php-code-coverage\";s:10:\"\0*\0version\";s:6:\"12.5.8\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:67:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\phpunit\\php-code-coverage\";}s:25:\"phpunit/php-file-iterator\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"phpunit/php-file-iterator\";s:10:\"\0*\0version\";s:5:\"6.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:67:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\phpunit\\php-file-iterator\";}s:19:\"phpunit/php-invoker\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"phpunit/php-invoker\";s:10:\"\0*\0version\";s:5:\"6.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\phpunit\\php-invoker\";}s:25:\"phpunit/php-text-template\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"phpunit/php-text-template\";s:10:\"\0*\0version\";s:5:\"5.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:67:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\phpunit\\php-text-template\";}s:17:\"phpunit/php-timer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"phpunit/php-timer\";s:10:\"\0*\0version\";s:5:\"8.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\phpunit\\php-timer\";}s:15:\"phpunit/phpunit\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:7:\"12.5.40\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:8:\"^12.5.12\";s:7:\"\0*\0path\";s:57:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\phpunit\\phpunit\";}s:20:\"sebastian/cli-parser\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"sebastian/cli-parser\";s:10:\"\0*\0version\";s:5:\"4.2.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\cli-parser\";}s:20:\"sebastian/comparator\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"sebastian/comparator\";s:10:\"\0*\0version\";s:5:\"7.1.8\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\comparator\";}s:20:\"sebastian/complexity\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"sebastian/complexity\";s:10:\"\0*\0version\";s:5:\"5.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\complexity\";}s:14:\"sebastian/diff\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"sebastian/diff\";s:10:\"\0*\0version\";s:5:\"7.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\diff\";}s:21:\"sebastian/environment\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"sebastian/environment\";s:10:\"\0*\0version\";s:5:\"8.1.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\environment\";}s:18:\"sebastian/exporter\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"sebastian/exporter\";s:10:\"\0*\0version\";s:5:\"7.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\exporter\";}s:22:\"sebastian/global-state\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"sebastian/global-state\";s:10:\"\0*\0version\";s:5:\"8.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\global-state\";}s:23:\"sebastian/lines-of-code\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"sebastian/lines-of-code\";s:10:\"\0*\0version\";s:5:\"4.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:65:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\lines-of-code\";}s:27:\"sebastian/object-enumerator\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"sebastian/object-enumerator\";s:10:\"\0*\0version\";s:5:\"7.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:69:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\object-enumerator\";}s:26:\"sebastian/object-reflector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"sebastian/object-reflector\";s:10:\"\0*\0version\";s:5:\"5.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:68:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\object-reflector\";}s:27:\"sebastian/recursion-context\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"sebastian/recursion-context\";s:10:\"\0*\0version\";s:5:\"7.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:69:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\recursion-context\";}s:14:\"sebastian/type\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"sebastian/type\";s:10:\"\0*\0version\";s:5:\"6.0.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\type\";}s:17:\"sebastian/version\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"sebastian/version\";s:10:\"\0*\0version\";s:5:\"6.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\sebastian\\version\";}s:28:\"staabm/side-effects-detector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"staabm/side-effects-detector\";s:10:\"\0*\0version\";s:5:\"1.0.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:70:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\staabm\\side-effects-detector\";}s:12:\"symfony/yaml\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"symfony/yaml\";s:10:\"\0*\0version\";s:6:\"7.4.23\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\symfony\\yaml\";}s:17:\"theseer/tokenizer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"theseer/tokenizer\";s:10:\"\0*\0version\";s:5:\"2.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"C:\\wamp64\\www\\Oreon Living Laravel\\vendor\\theseer\\tokenizer\";}}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:115:{i:0;r:5;i:1;r:13;i:2;r:21;i:3;r:29;i:4;r:37;i:5;r:45;i:6;r:53;i:7;r:61;i:8;r:69;i:9;r:77;i:10;r:85;i:11;r:93;i:12;r:101;i:13;r:109;i:14;r:117;i:15;r:125;i:16;r:133;i:17;r:141;i:18;r:149;i:19;r:157;i:20;r:165;i:21;r:173;i:22;r:181;i:23;r:189;i:24;r:197;i:25;r:205;i:26;r:213;i:27;r:221;i:28;r:229;i:29;r:237;i:30;r:245;i:31;r:253;i:32;r:261;i:33;r:269;i:34;r:277;i:35;r:285;i:36;r:293;i:37;r:301;i:38;r:309;i:39;r:317;i:40;r:325;i:41;r:333;i:42;r:341;i:43;r:349;i:44;r:357;i:45;r:365;i:46;r:373;i:47;r:381;i:48;r:389;i:49;r:397;i:50;r:405;i:51;r:413;i:52;r:421;i:53;r:429;i:54;r:437;i:55;r:445;i:56;r:453;i:57;r:461;i:58;r:469;i:59;r:477;i:60;r:485;i:61;r:493;i:62;r:501;i:63;r:509;i:64;r:517;i:65;r:525;i:66;r:533;i:67;r:541;i:68;r:549;i:69;r:557;i:70;r:565;i:71;r:573;i:72;r:581;i:73;r:589;i:74;r:597;i:75;r:605;i:76;r:613;i:77;r:621;i:78;r:629;i:79;r:637;i:80;r:645;i:81;r:653;i:82;r:661;i:83;r:669;i:84;r:677;i:85;r:685;i:86;r:693;i:87;r:701;i:88;r:709;i:89;r:717;i:90;r:725;i:91;r:733;i:92;r:741;i:93;r:749;i:94;r:757;i:95;r:765;i:96;r:773;i:97;r:781;i:98;r:789;i:99;r:797;i:100;r:805;i:101;r:813;i:102;r:821;i:103;r:829;i:104;r:837;i:105;r:845;i:106;r:853;i:107;r:861;i:108;r:869;i:109;r:877;i:110;r:885;i:111;r:893;i:112;r:901;i:113;r:909;i:114;r:917;}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:2:\"js\";O:37:\"Laravel\\Roster\\Ecosystems\\JsEcosystem\":3:{s:9:\"\0*\0byName\";a:6:{s:17:\"@tailwindcss/vite\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"@tailwindcss/vite\";s:10:\"\0*\0version\";s:5:\"4.0.0\";s:9:\"\0*\0source\";E:38:\"Laravel\\Roster\\Enums\\PackageSource:Npm\";s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^4.0.0\";s:7:\"\0*\0path\";s:65:\"C:\\wamp64\\www\\Oreon Living Laravel\\node_modules\\@tailwindcss\\vite\";}s:12:\"concurrently\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"concurrently\";s:10:\"\0*\0version\";s:6:\"10.0.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:7:\"^10.0.3\";s:7:\"\0*\0path\";s:60:\"C:\\wamp64\\www\\Oreon Living Laravel\\node_modules\\concurrently\";}s:19:\"laravel-vite-plugin\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"laravel-vite-plugin\";s:10:\"\0*\0version\";s:3:\"3.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^3.1\";s:7:\"\0*\0path\";s:67:\"C:\\wamp64\\www\\Oreon Living Laravel\\node_modules\\laravel-vite-plugin\";}s:11:\"tailwindcss\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:5:\"4.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^4.0.0\";s:7:\"\0*\0path\";s:59:\"C:\\wamp64\\www\\Oreon Living Laravel\\node_modules\\tailwindcss\";}s:4:\"vite\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:4:\"vite\";s:10:\"\0*\0version\";s:5:\"8.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^8.0.0\";s:7:\"\0*\0path\";s:52:\"C:\\wamp64\\www\\Oreon Living Laravel\\node_modules\\vite\";}s:18:\"@laravel/multiplex\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"@laravel/multiplex\";s:10:\"\0*\0version\";s:5:\"0.4.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^0.4.1\";s:7:\"\0*\0path\";s:66:\"C:\\wamp64\\www\\Oreon Living Laravel\\node_modules\\@laravel\\multiplex\";}}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:6:{i:0;r:1045;i:1;r:1053;i:2;r:1061;i:3;r:1069;i:4;r:1077;i:5;r:1085;}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:17:\"\0*\0packageManager\";N;}s:6:\"stacks\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:1:{i:0;E:32:\"Laravel\\Roster\\Enums\\Stack:Blade\";}}s:21:\"browserTestFrameworks\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:0:{}}s:9:\"frontends\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:0:{}}s:6:\"agents\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:2:{i:0;E:37:\"Laravel\\Roster\\Enums\\Agent:ClaudeCode\";i:1;E:32:\"Laravel\\Roster\\Enums\\Agent:Codex\";}}s:7:\"editors\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:0:{}}}',1793819087),('oreon-living-cache-setting_announcement_bar_enabled','s:1:\"1\";',2109179544),('oreon-living-cache-setting_announcement_bar_link','s:5:\"/shop\";',2109179544),('oreon-living-cache-setting_announcement_bar_text','s:90:\"Complimentary pan-India delivery on orders above ₹1,999 • 100% Breakage-Free Guarantee\";',2107682668),('oreon-living-cache-setting_facebook_url','s:32:\"https://facebook.com/oreonliving\";',2107682668),('oreon-living-cache-setting_free_shipping_threshold','s:4:\"1999\";',2107682668),('oreon-living-cache-setting_google_search_console_tag','s:22:\"test-verification-code\";',2109179544),('oreon-living-cache-setting_instagram_url','s:33:\"https://instagram.com/oreonliving\";',2107682668),('oreon-living-cache-setting_meta_description_default','s:50:\"Pure unglazed porous pottery and terracotta wares.\";',2109179544),('oreon-living-cache-setting_meta_title_default','s:35:\"Oreon Living | Natural Earthen Clay\";',2109179544),('oreon-living-cache-setting_pinterest_url','N;',2109179544),('oreon-living-cache-setting_site_name','s:12:\"Oreon Living\";',2107683340),('oreon-living-cache-setting_site_tagline','s:47:\"Crafted from Earth. Designed for Modern Living.\";',2109179544),('oreon-living-cache-setting_standard_shipping_fee','s:3:\"149\";',2107682668),('oreon-living-cache-setting_upi_vpa','s:17:\"oreonliving@icici\";',2107683340),('oreon-living-cache-setting_whatsapp_number','s:12:\"919876543210\";',2107682668),('oreon-living-cache-setting_youtube_url','N;',2109179544);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `variant_id` bigint unsigned DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  KEY `cart_items_variant_id_foreign` (`variant_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
INSERT INTO `cart_items` VALUES (1,15,1,NULL,2,1999.00,'2026-10-18 05:59:13','2026-10-18 05:59:13'),(2,18,1,NULL,1,1999.00,'2026-10-18 05:59:13','2026-10-18 05:59:13'),(8,2,1,NULL,8,2699.00,'2026-10-18 06:17:55','2026-11-04 13:37:06');
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_session_id_index` (`session_id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,NULL,'3pn6SqMKQMzOPkrhbiKrzQDMMZgrIl0KT7mq7pKA',NULL,'2026-10-18 05:54:28','2026-10-18 05:54:28'),(2,8,NULL,'WELCOME10','2026-10-18 05:55:28','2026-10-18 06:17:56'),(3,NULL,'55KuSwjaicpQGUJjeasutArKu69tM5OiR5X3Yela',NULL,'2026-10-18 05:55:29','2026-10-18 05:55:29'),(4,NULL,'P7kjDgp2A14IoCXDtyEJjuqOBhhkLEGdmYfbY1G9',NULL,'2026-10-18 05:55:29','2026-10-18 05:55:29'),(5,NULL,'ZIkhE3Jrhi88cAHh6tZfLaoRz1W0fv76h5q5ko8P',NULL,'2026-10-18 05:55:29','2026-10-18 05:55:29'),(6,NULL,'cz44EF5i0SRF0PvU53dqaZyoCd69SVUXxd7uswyH',NULL,'2026-10-18 05:56:38','2026-10-18 05:56:38'),(7,NULL,'xI7Rzl2hpLMrdHrQBQRIL3XsGdNCSOlxYws7vknB',NULL,'2026-10-18 05:56:39','2026-10-18 05:56:39'),(8,NULL,'V6LHuBxVqTdeB65kHZStgGc1JsjyDOXJb7DTri1O',NULL,'2026-10-18 05:56:39','2026-10-18 05:56:39'),(9,NULL,'1H2g7Csz4LnHvxFT14PE0BykI9WfdJINQhzlPga1',NULL,'2026-10-18 05:57:09','2026-10-18 05:57:09'),(10,NULL,'UhUnVRLqY3oEoJYgQegauxJviVreurenpIwDN4qe',NULL,'2026-10-18 05:57:09','2026-10-18 05:57:09'),(11,NULL,'5ACktP0s3cfYDdNrpTSaGDVI7w2R0jU5ZMEgxGmW',NULL,'2026-10-18 05:57:10','2026-10-18 05:57:10'),(12,NULL,'iYUozFFAKNIMc83LFpFTz2LG0X2qHuIeHZR4FHBa',NULL,'2026-10-18 05:59:12','2026-10-18 05:59:12'),(13,NULL,'kyWwzpHZAzvrAFz2ekwUG0RyUsLCXpvJUEqg1b6D',NULL,'2026-10-18 05:59:13','2026-10-18 05:59:13'),(14,NULL,'PLnz8H0kHiD78scytack4p9lkjU9wLr5Dg09BUuO',NULL,'2026-10-18 05:59:13','2026-10-18 05:59:13'),(15,NULL,'h8rEVv8s09shhe8TUJCzkBx7SgNSrafLdZLT7AvW',NULL,'2026-10-18 05:59:13','2026-10-18 05:59:13'),(16,NULL,'JDYKyUAQFUYg4hxIIWlM2XrMBuNsVEeQY63oRGlW',NULL,'2026-10-18 05:59:13','2026-10-18 05:59:13'),(17,NULL,'yl0uhVrhTJhkrILBMvfoaVvstndfW8t5RIwJniHu',NULL,'2026-10-18 05:59:13','2026-10-18 05:59:13'),(18,NULL,'hYvMLIbAr7JBdXesAwLn39qmlhvRipmN8S2TfFBl',NULL,'2026-10-18 05:59:13','2026-10-18 05:59:13'),(19,NULL,'mMscv6AJbeW6zMQy2uEs1RSCUCZXhlL2HZpwwY1p',NULL,'2026-10-18 06:00:27','2026-10-18 06:00:27'),(20,NULL,'6pxsbK06DEAhNduQ34Ivo0UqmqF6boX4lyiNiHnq',NULL,'2026-10-18 06:00:27','2026-10-18 06:00:27'),(21,NULL,'js5rO9BzjdpJ3F5LNSOJwO4KdGNJUZADWj8RQ0R7',NULL,'2026-10-18 06:00:27','2026-10-18 06:00:27'),(22,NULL,'K1ZyBVs39yWZk6KdoWlSR18dwhLyyjvVvFyZZ8TQ',NULL,'2026-10-18 06:00:27','2026-10-18 06:00:27'),(23,NULL,'xfdcODMBr55bjP7nNevC2FetSR3Muka9sv6TLLPx',NULL,'2026-10-18 06:00:52','2026-10-18 06:00:52'),(24,NULL,'u60uoZPTJGSsmmUkeZ5G54zVq9cSxrlnYyn0HoYW',NULL,'2026-10-18 06:00:52','2026-10-18 06:00:52'),(25,NULL,'bok4qnsnH6yl1b8MRudSKqwfP7KXws0nHLaHkFgt',NULL,'2026-10-18 06:00:52','2026-10-18 06:00:52'),(26,NULL,'HX7jx2zwvlWyiiEa0dfgPepljQ9LId7LHFX1ZVdK',NULL,'2026-10-18 06:00:52','2026-10-18 06:00:52'),(27,NULL,'S191QgEYsZ5OKAmMqKed6O507CqXMfdN0SjNJzfu',NULL,'2026-10-18 06:01:26','2026-10-18 06:01:26'),(28,NULL,'1ePDb9GXvR8zYZw2jdv4U8nGm9rhQJfnHMEKkcnV',NULL,'2026-10-18 06:01:27','2026-10-18 06:01:27'),(29,NULL,'OLKU9BCeCvCG8Ty3DFVvU6zwvjSWjKPvRys7pY2f',NULL,'2026-10-18 06:01:27','2026-10-18 06:01:27'),(30,NULL,'fmJXDPVbsauA14pXsNpDQ62kBzUG9z2aYvDMHsFc',NULL,'2026-10-18 06:01:27','2026-10-18 06:01:27'),(31,10,NULL,NULL,'2026-10-18 06:01:27','2026-10-18 06:01:27'),(32,NULL,'YEszrN7zy5fIfoTLswfsbms0Qal1jOY49Oz3CZth',NULL,'2026-10-18 06:02:46','2026-10-18 06:02:46'),(33,NULL,'7UdhutWIdv2Zdf5y71mmKiR9uagtihyCet4yblDz',NULL,'2026-10-18 06:02:46','2026-10-18 06:02:46'),(34,NULL,'8NrNykXjTLWTvZ5Kl2MogTPREXs1EsZaPzMv6vnt',NULL,'2026-10-18 06:02:50','2026-10-18 06:02:50'),(35,1,NULL,NULL,'2026-10-18 06:04:27','2026-10-18 06:04:27'),(36,NULL,'QPp1kfrXUaE2RHduvGOT74bjRhJLvSjBLcepz3fV',NULL,'2026-10-18 06:04:59','2026-10-18 06:04:59'),(37,NULL,'aUeLACTUIStXVEnJ8RdpKNAIGmnJUAIzssdOg0mf',NULL,'2026-10-18 06:07:46','2026-10-18 06:07:46'),(38,6,NULL,NULL,'2026-10-18 06:08:09','2026-10-18 06:08:09'),(39,NULL,'42Cbvu99kBkm6vtHNqlwnM9R5zFZEsLbrPqkP2vS',NULL,'2026-10-18 06:17:55','2026-10-18 06:17:55'),(40,NULL,'OEbRiwVYLcqz3pz19IrudOfDk4rFA6pvTJ9K1JOh',NULL,'2026-10-18 06:17:55','2026-10-18 06:17:55'),(41,NULL,'zSk8D0P29wOhMlMh63oqteAnkY4tHt9U1mVCGhZm',NULL,'2026-10-18 06:17:55','2026-10-18 06:17:55'),(42,NULL,'gXMOTEPUFuBYnzPq1J2aEPigsNCFrMgbgKvExDyq',NULL,'2026-10-18 06:17:56','2026-10-18 06:17:56'),(43,11,NULL,NULL,'2026-10-18 06:17:56','2026-10-18 06:17:56'),(44,4,NULL,NULL,'2026-10-18 06:19:18','2026-10-18 06:19:18'),(45,NULL,'UKefhVObdYASdwATyqM7LuZGdwtGZfJ7bRcmL0VO',NULL,'2026-11-04 12:42:25','2026-11-04 12:42:25'),(46,NULL,'t0lFL6bEZOpH8NZGMMOR5SmQjRh1ADRqgkDPVnoN',NULL,'2026-11-04 12:42:25','2026-11-04 12:42:25'),(47,NULL,'Fj7VU8pOzUlyIU2OBLOPnOEs9RZNS1Jr3Lpxcme2',NULL,'2026-11-04 12:42:26','2026-11-04 12:42:26'),(48,NULL,'EQyJCo2hByg6rKKmzySMTvdWvLTyNp8TlXWe0LNg',NULL,'2026-11-04 12:42:27','2026-11-04 12:42:27'),(49,12,NULL,NULL,'2026-11-04 12:42:28','2026-11-04 12:42:28'),(50,NULL,'hBWqYaPOvQj8UDq0Ow761GYxG6t6lnUbPWDzOh4Y',NULL,'2026-11-04 13:35:52','2026-11-04 13:35:52'),(51,NULL,'cMOu8s5sVXeUv4stp3lKJcrkBngPxD0jCF0x7ZO9',NULL,'2026-11-04 13:35:52','2026-11-04 13:35:52'),(52,NULL,'kAmhtIGLILEL5HE924Ep0ygSspbw3fsqDe4FQwFq',NULL,'2026-11-04 13:35:52','2026-11-04 13:35:52'),(53,NULL,'9sagoqEKQvORDrOGBb3oJvnEgHCyDNjo0iZs9Odh',NULL,'2026-11-04 13:35:53','2026-11-04 13:35:53'),(54,13,NULL,NULL,'2026-11-04 13:35:53','2026-11-04 13:35:53'),(55,NULL,'N2p63J6YkIrRC1yLnMbFDmH7Z7iCaDqruZjb3ugr',NULL,'2026-11-04 13:36:52','2026-11-04 13:36:52'),(56,NULL,'YJJ08ZegVFMRgT8sO0hIKA29EjR1Uowf8hiFkniT',NULL,'2026-11-04 13:37:05','2026-11-04 13:37:05'),(57,NULL,'WV7RYOOX1Y6OJFlhp46HoFvcWVzrofdYXNs9O569',NULL,'2026-11-04 13:37:06','2026-11-04 13:37:06'),(58,NULL,'vDeguVc75K8FAzhiokeKoZnOQv5I9jYAQnoHQ9Re',NULL,'2026-11-04 13:37:06','2026-11-04 13:37:06'),(59,NULL,'cK3lGjFmQstH8j4SIhzXv3dKH9DcLR5TKgREWdf4',NULL,'2026-11-04 13:37:06','2026-11-04 13:37:06'),(60,NULL,'200hi8ElldGiUcNi3sHfXoEqDWYc0IVPRuq2PKKy',NULL,'2026-11-04 13:37:07','2026-11-04 13:37:07'),(61,14,NULL,NULL,'2026-11-04 13:37:07','2026-11-04 13:37:07');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,'Water Pots & Carafes','water-pots-and-carafes','Wheel-thrown porous terracotta carafes that naturally cool and mineralize drinking water.','https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=800&q=80',1,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(2,NULL,'Botanical Planters','botanical-planters','Breathable unglazed earthen planters engineered for healthy root aeration and moisture balance.','https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=800&q=80',1,2,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(3,NULL,'Earthen Cookware','earthen-cookware','Non-toxic, alkaline clay handis and cooking vessels that preserve nutrients and infuse subtle aroma.','https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=800&q=80',1,3,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(4,NULL,'Serveware & Tableware','serveware-and-tableware','Artisanal clay platters, salad bowls, and curd setting bowls finished with natural wood ash glaze.','https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=800&q=80',1,4,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(5,NULL,'Sculptural Vases','sculptural-vases','Architectural silhouettes and textured earthen vessels designed as serene interior centerpieces.','https://images.unsplash.com/photo-1581783342308-f792dbdd27c5?auto=format&fit=crop&w=800&q=80',1,5,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(6,NULL,'Ritual Diyas & Lamps','ritual-diyas-and-lamps','Pure unglazed red clay oil lamps handcrafted for slow, steady glow and meditative warmth.','https://images.unsplash.com/photo-1605371924599-2d0365da1ae0?auto=format&fit=crop&w=800&q=80',1,6,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(7,NULL,'Tea & Drinkware','tea-and-drinkware','Hand-formed kulhads, earthen mugs, and chai tumblers that honor the rich fragrance of first rain.','https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=800&q=80',1,7,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(8,NULL,'Artisan Limited Editions','artisan-limited-editions','Individually numbered master potter creations wood-fired in traditional village kilns.','https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?auto=format&fit=crop&w=800&q=80',1,8,'2026-10-18 05:19:04','2026-10-18 05:19:04');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_submissions`
--

DROP TABLE IF EXISTS `contact_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_submissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_submissions_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_submissions`
--

LOCK TABLES `contact_submissions` WRITE;
/*!40000 ALTER TABLE `contact_submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `value` decimal(10,2) NOT NULL,
  `minimum_order` decimal(10,2) NOT NULL DEFAULT '0.00',
  `max_discount` decimal(10,2) DEFAULT NULL,
  `max_uses` int DEFAULT NULL,
  `used_count` int NOT NULL DEFAULT '0',
  `starts_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'WELCOME10','percentage',10.00,999.00,500.00,1000,41,'2026-09-18 10:49:05','2027-10-18 10:49:05',1,'2026-10-18 05:19:05','2026-10-18 06:05:56'),(2,'EARTHEN500','fixed',500.00,2499.00,500.00,250,14,'2026-09-18 10:49:05','2027-10-18 10:49:05',1,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(3,'FESTIVE15','percentage',15.00,1499.00,750.00,500,52,'2026-10-08 10:49:05','2027-04-18 10:49:05',1,'2026-10-18 05:19:05','2026-10-18 05:19:05');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'General',
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'Care & Seasoning','How do I season my clay pot before first use?','Submerge the earthenware in clean water for 8 to 12 hours. Allow it to air dry naturally, then gently rub pure mustard or coconut oil over the surface. For cookware, boil starch water (cooked rice water) on low flame once before your first recipe.',1,1,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(2,'Care & Seasoning','Can I use synthetic dish soap to clean terracotta?','Never use chemical detergents or dish soaps on unglazed porous clay, as the microscopic pores will absorb soapy fragrance. Use warm water, lemon rind, and baking soda or a soft coir scrub.',2,1,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(3,'Shipping & Packaging','What if my clay products arrive broken during transit?','We provide a 100% Free Replacement Breakage Guarantee. Every order is encased in triple-ply custom corrugated cushioning. In the rare event of transit damage, simply share an unboxing photo within 48 hours on WhatsApp and a fresh piece will be dispatched immediately.',3,1,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(4,'Materials & Safety','Are your clay products certified lead-free?','Yes. All our clays are mined from clean alluvial river beds and laboratory tested to ensure zero lead, zero arsenic, and zero toxic heavy metals. 100% food safe and alkaline.',4,1,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(5,'Orders & Payment','What payment methods do you accept?','We accept all instant UPI apps (Google Pay, PhonePe, Paytm, BHIM), Credit/Debit cards, Netbanking, and Cash on Delivery across eligible Indian pin codes.',5,1,'2026-10-18 05:19:05','2026-10-18 05:19:05');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homepage_banners`
--

DROP TABLE IF EXISTS `homepage_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `homepage_banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `badge_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Explore Collection',
  `button_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/shop',
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homepage_banners`
--

LOCK TABLES `homepage_banners` WRITE;
/*!40000 ALTER TABLE `homepage_banners` DISABLE KEYS */;
INSERT INTO `homepage_banners` VALUES (1,'Crafted from Earth. Made for Living.','Porous terracotta carafes, sculptural planters, and kitchen handis designed to infuse calm into everyday rituals.','New Autumn Collection 2026','Discover the Collection','/shop','https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=1800&q=85',1,0,'2026-10-18 05:19:05','2026-10-18 06:04:21'),(2,'Naturally Cool. Mineral Rich.','Hand-burnished alluvial clay water carafes that lower temperature by up to 5°C without electricity.','Timeless Hydration','Explore Water Pots','/shop/water-pots-and-carafes','https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1800&q=85',2,1,'2026-10-18 05:19:05','2026-10-18 05:19:05');
/*!40000 ALTER TABLE `homepage_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_18_000001_create_categories_table',1),(5,'2026_10_18_000002_create_products_and_variants_tables',1),(6,'2026_10_18_000003_create_addresses_table',1),(7,'2026_10_18_000004_create_carts_and_items_tables',1),(8,'2026_10_18_000005_create_orders_and_items_tables',1),(9,'2026_10_18_000006_create_wishlists_reviews_coupons_tables',1),(10,'2026_10_18_000007_create_content_logs_and_settings_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `variant_id` bigint unsigned DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  KEY `order_items_variant_id_foreign` (`variant_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  CONSTRAINT `order_items_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,1,NULL,'Soham Earthen Water Carafe with Cork Lid','OL-WTR-001',1,1499.00,1499.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(2,1,5,NULL,'Amrit Traditional Clay Curd Handi with Lid','OL-CKW-001',1,799.00,799.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(3,2,2,NULL,'Prana Terracotta Water Dispenser with Brass Tap','OL-WTR-002',1,3299.00,3299.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(4,3,1,NULL,'Soham Earthen Water Carafe with Cork Lid','OL-WTR-001',3,2099.00,6297.00,'2026-10-18 06:00:28','2026-10-18 06:00:28'),(5,4,1,NULL,'Soham Earthen Water Carafe with Cork Lid','OL-WTR-001',3,2199.00,6597.00,'2026-10-18 06:00:53','2026-10-18 06:00:53'),(6,5,1,NULL,'Soham Earthen Water Carafe with Cork Lid','OL-WTR-001',1,2299.00,2299.00,'2026-10-18 06:01:27','2026-10-18 06:01:27'),(7,6,1,NULL,'Soham Earthen Water Carafe with Cork Lid','OL-WTR-001',2,2299.00,4598.00,'2026-10-18 06:05:56','2026-10-18 06:05:56'),(8,6,8,NULL,'Samata Shallow Pasta & Grain Bowls (Set of 2)','OL-SRV-002',1,1899.00,1899.00,'2026-10-18 06:05:56','2026-10-18 06:05:56'),(9,7,1,NULL,'Soham Earthen Water Carafe with Cork Lid','OL-WTR-001',1,2399.00,2399.00,'2026-10-18 06:17:56','2026-10-18 06:17:56'),(10,8,1,NULL,'Soham Earthen Water Carafe with Cork Lid','OL-WTR-001',1,2499.00,2499.00,'2026-11-04 12:42:28','2026-11-04 12:42:28'),(11,9,1,NULL,'Soham Earthen Water Carafe with Cork Lid','OL-WTR-001',1,2599.00,2599.00,'2026-11-04 13:35:54','2026-11-04 13:35:54'),(12,10,1,NULL,'Soham Earthen Water Carafe with Cork Lid','OL-WTR-001',1,2699.00,2699.00,'2026-11-04 13:37:07','2026-11-04 13:37:07');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` json NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'upi',
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carrier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `cancellation_reason` text COLLATE utf8mb4_unicode_ci,
  `return_reason` text COLLATE utf8mb4_unicode_ci,
  `utm_source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utm_medium` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utm_campaign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_payment_status_index` (`payment_status`),
  KEY `orders_order_status_index` (`order_status`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'OL-20261018-4821',8,'Ananya Deshmukh','ananya@example.com','+91 98200 12345','{\"city\": \"Bengaluru\", \"name\": \"Ananya Deshmukh\", \"phone\": \"+91 98200 12345\", \"state\": \"Karnataka\", \"country\": \"India\", \"postal_code\": \"560038\", \"address_line_1\": \"Flat 402, Lotus Grandeur, 14th Cross\", \"address_line_2\": \"Indiranagar\"}',2298.00,229.80,'WELCOME10',0.00,103.41,2171.61,'upi','paid','shipped','DELHIVERY892182910','Delhivery Express','https://www.delhivery.com/track/package/DELHIVERY892182910','Please leave at reception security if door is locked.',NULL,NULL,'instagram','social_post','spring_clay','2026-10-18 05:19:05','2026-10-18 05:19:05'),(2,'OL-20261018-5902',9,'Vikram Malhotra','customer@example.com','+91 98111 67890','{\"city\": \"New Delhi\", \"name\": \"Vikram Malhotra\", \"phone\": \"+91 98111 67890\", \"state\": \"Delhi\", \"country\": \"India\", \"postal_code\": \"110016\", \"address_line_1\": \"B-12, Green Park Main, Second Floor\"}',3299.00,500.00,'EARTHEN500',0.00,139.95,2938.95,'card','paid','confirmed',NULL,NULL,NULL,NULL,NULL,NULL,'google','cpc','terracotta_search','2026-10-18 05:19:05','2026-10-18 05:19:05'),(3,'OL-20261018-TUUG',8,'Aditi Sen','aditi.sen@example.com','9876543210','{\"city\": \"Bengaluru\", \"name\": \"Aditi Sen\", \"phone\": \"9876543210\", \"state\": \"Karnataka\", \"country\": \"India\", \"landmark\": null, \"postal_code\": \"560001\", \"address_line_1\": \"42 Green Valley Apartments\", \"address_line_2\": null}',6297.00,500.00,'WELCOME10',0.00,289.85,5797.00,'cod','pending','confirmed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-18 06:00:28','2026-10-18 06:00:28'),(4,'OL-20261018-ZN6X',8,'Aditi Sen','aditi.sen@example.com','9876543210','{\"city\": \"Bengaluru\", \"name\": \"Aditi Sen\", \"phone\": \"9876543210\", \"state\": \"Karnataka\", \"country\": \"India\", \"landmark\": null, \"postal_code\": \"560001\", \"address_line_1\": \"42 Green Valley Apartments\", \"address_line_2\": null}',6597.00,500.00,'WELCOME10',0.00,304.85,6097.00,'cod','pending','confirmed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-18 06:00:53','2026-10-18 06:00:53'),(5,'OL-20261018-9YBB',10,'Aditi Sen','aditi.sen@example.com','9876543210','{\"city\": \"Bengaluru\", \"name\": \"Aditi Sen\", \"phone\": \"9876543210\", \"state\": \"Karnataka\", \"country\": \"India\", \"landmark\": null, \"postal_code\": \"560001\", \"address_line_1\": \"42 Green Valley Apartments\", \"address_line_2\": null}',2299.00,0.00,NULL,0.00,114.95,2299.00,'cod','pending','confirmed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-18 06:01:27','2026-10-18 06:01:27'),(6,'OL-20261018-YDG3',8,'Ananya Deshmukh','ananya@example.com','+91 98200 12345','{\"city\": \"Bengaluru\", \"name\": \"Ananya Deshmukh\", \"phone\": \"+91 98200 12345\", \"state\": \"Karnataka\", \"country\": \"India\", \"landmark\": null, \"postal_code\": \"560038\", \"address_line_1\": \"Flat 402, Lotus Grandeur\", \"address_line_2\": \"14th Cross, Indiranagar\"}',6497.00,500.00,'WELCOME10',0.00,299.85,5997.00,'upi','failed','pending',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-18 06:05:56','2026-10-18 06:09:32'),(7,'OL-20261018-AP9R',11,'Aditi Sen','aditi.sen@example.com','9876543210','{\"city\": \"Bengaluru\", \"name\": \"Aditi Sen\", \"phone\": \"9876543210\", \"state\": \"Karnataka\", \"country\": \"India\", \"landmark\": null, \"postal_code\": \"560001\", \"address_line_1\": \"42 Green Valley Apartments\", \"address_line_2\": null}',2399.00,0.00,NULL,0.00,119.95,2399.00,'cod','pending','confirmed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-18 06:17:56','2026-10-18 06:17:56'),(8,'OL-20261104-LRFX',12,'Aditi Sen','aditi.sen@example.com','9876543210','{\"city\": \"Bengaluru\", \"name\": \"Aditi Sen\", \"phone\": \"9876543210\", \"state\": \"Karnataka\", \"country\": \"India\", \"landmark\": null, \"postal_code\": \"560001\", \"address_line_1\": \"42 Green Valley Apartments\", \"address_line_2\": null}',2499.00,0.00,NULL,0.00,124.95,2499.00,'cod','pending','confirmed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-11-04 12:42:28','2026-11-04 12:42:28'),(9,'OL-20261104-794S',13,'Aditi Sen','aditi.sen@example.com','9876543210','{\"city\": \"Bengaluru\", \"name\": \"Aditi Sen\", \"phone\": \"9876543210\", \"state\": \"Karnataka\", \"country\": \"India\", \"landmark\": null, \"postal_code\": \"560001\", \"address_line_1\": \"42 Green Valley Apartments\", \"address_line_2\": null}',2599.00,0.00,NULL,0.00,129.95,2599.00,'cod','pending','confirmed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-11-04 13:35:53','2026-11-04 13:35:53'),(10,'OL-20261104-4WNP',14,'Aditi Sen','aditi.sen@example.com','9876543210','{\"city\": \"Bengaluru\", \"name\": \"Aditi Sen\", \"phone\": \"9876543210\", \"state\": \"Karnataka\", \"country\": \"India\", \"landmark\": null, \"postal_code\": \"560001\", \"address_line_1\": \"42 Green Valley Apartments\", \"address_line_2\": null}',2699.00,0.00,NULL,0.00,134.95,2699.00,'cod','pending','confirmed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-11-04 13:37:07','2026-11-04 13:37:07');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pincodes`
--

DROP TABLE IF EXISTS `pincodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pincodes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_serviceable` tinyint(1) NOT NULL DEFAULT '1',
  `estimated_days` int NOT NULL DEFAULT '4',
  `cod_available` tinyint(1) NOT NULL DEFAULT '1',
  `shipping_charge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pincodes_pincode_unique` (`pincode`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pincodes`
--

LOCK TABLES `pincodes` WRITE;
/*!40000 ALTER TABLE `pincodes` DISABLE KEYS */;
INSERT INTO `pincodes` VALUES (1,'110001','New Delhi','Delhi',1,2,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(2,'110016','New Delhi','Delhi',1,2,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(3,'400001','Mumbai','Maharashtra',1,3,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(4,'400050','Mumbai','Maharashtra',1,3,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(5,'560001','Bengaluru','Karnataka',1,3,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(6,'560038','Bengaluru','Karnataka',1,3,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(7,'600001','Chennai','Tamil Nadu',1,4,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(8,'700001','Kolkata','West Bengal',1,4,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(9,'500001','Hyderabad','Telangana',1,3,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(10,'380001','Ahmedabad','Gujarat',1,3,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(11,'302001','Jaipur','Rajasthan',1,3,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(12,'411001','Pune','Maharashtra',1,3,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(13,'201301','Noida','Uttar Pradesh',1,2,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05'),(14,'122001','Gurugram','Haryana',1,2,1,0.00,'2026-10-18 05:19:05','2026-10-18 05:19:05');
/*!40000 ALTER TABLE `pincodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,1,'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=1000&q=85','Soham Earthen Water Carafe with Cork Lid - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(2,1,'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=1000&q=85','Soham Earthen Water Carafe with Cork Lid - Photo 2',1,0,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(3,1,'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1000&q=85','Soham Earthen Water Carafe with Cork Lid - Photo 3',2,0,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(4,2,'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1000&q=85','Prana Terracotta Water Dispenser with Brass Tap - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(5,2,'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=1000&q=85','Prana Terracotta Water Dispenser with Brass Tap - Photo 2',1,0,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(6,3,'https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=1000&q=85','Aura Fluted Terracotta Pedestal Planter - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(7,3,'https://images.unsplash.com/photo-1581783342308-f792dbdd27c5?auto=format&fit=crop&w=1000&q=85','Aura Fluted Terracotta Pedestal Planter - Photo 2',1,0,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(8,4,'https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=1000&q=85','Komorebi Wide Low Earthen Bowl Planter - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(9,5,'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=1000&q=85','Amrit Traditional Clay Curd Handi with Lid - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(10,5,'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1000&q=85','Amrit Traditional Clay Curd Handi with Lid - Photo 2',1,0,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(11,6,'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=1000&q=85','Veda Slow-Cooking Clay Biryani Pot with Steamer Lid - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(12,7,'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1000&q=85','Maitri Terracotta Serving Platter & Dip Bowl Set - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(13,7,'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=1000&q=85','Maitri Terracotta Serving Platter & Dip Bowl Set - Photo 2',1,0,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(14,8,'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1000&q=85','Samata Shallow Pasta & Grain Bowls (Set of 2) - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(15,9,'https://images.unsplash.com/photo-1581783342308-f792dbdd27c5?auto=format&fit=crop&w=1000&q=85','Kala Minimalist Loop Handle Earthen Vase - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(16,9,'https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?auto=format&fit=crop&w=1000&q=85','Kala Minimalist Loop Handle Earthen Vase - Photo 2',1,0,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(17,10,'https://images.unsplash.com/photo-1581783342308-f792dbdd27c5?auto=format&fit=crop&w=1000&q=85','Dhara Textured Moon Flask Vessel - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(18,11,'https://images.unsplash.com/photo-1605371924599-2d0365da1ae0?auto=format&fit=crop&w=1000&q=85','Anant Handcrafted Terracotta Akhand Diya with Glass Chimney - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(19,12,'https://images.unsplash.com/photo-1605371924599-2d0365da1ae0?auto=format&fit=crop&w=1000&q=85','Surya Petal Terracotta Festive Diyas (Box of 8) - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(20,13,'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=1000&q=85','Mitti Hand-Thrown Chai Kulhad Tumblers (Set of 4) - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(21,13,'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1000&q=85','Mitti Hand-Thrown Chai Kulhad Tumblers (Set of 4) - Photo 2',1,0,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(22,14,'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=1000&q=85','Oasis Terracotta Pour-Over Coffee Dripper Set - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(23,15,'https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?auto=format&fit=crop&w=1000&q=85','Nirvana Monolithic Wood-Fired Vessel No. 04 - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(24,15,'https://images.unsplash.com/photo-1581783342308-f792dbdd27c5?auto=format&fit=crop&w=1000&q=85','Nirvana Monolithic Wood-Fired Vessel No. 04 - Photo 2',1,0,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(25,16,'https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=1000&q=85','Zenith Hanging Terracotta Planter with Jute Cord - Photo 1',0,1,'2026-10-18 05:19:04','2026-10-18 05:19:04');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_variants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_variants_product_id_foreign` (`product_id`),
  CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
INSERT INTO `product_variants` VALUES (1,1,'Standard - 1.2 Liters','OL-WTR-001-1L',1499.00,18,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(2,1,'Family - 2.0 Liters','OL-WTR-001-2L',1999.00,10,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(3,2,'5 Litres','OL-WTR-002-5L',3299.00,8,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(4,2,'8 Litres','OL-WTR-002-8L',3999.00,6,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(5,3,'Medium (7 inch)','OL-PLT-001-M',1299.00,14,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(6,3,'Large (9 inch)','OL-PLT-001-L',1799.00,8,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(7,5,'750 ml','OL-CKW-001-750',799.00,20,1,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(8,5,'1.5 Liters','OL-CKW-001-15L',1199.00,15,1,'2026-10-18 05:19:04','2026-10-18 05:19:04');
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `compare_price` decimal(10,2) DEFAULT NULL,
  `cost_price` decimal(10,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `low_stock_threshold` int NOT NULL DEFAULT '5',
  `weight_grams` int DEFAULT NULL,
  `dimensions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `care_instructions` text COLLATE utf8mb4_unicode_ci,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `bestseller` tinyint(1) NOT NULL DEFAULT '0',
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_status_index` (`status`),
  KEY `products_featured_index` (`featured`),
  KEY `products_bestseller_index` (`bestseller`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'Soham Earthen Water Carafe with Cork Lid','soham-earthen-water-carafe-cork-lid','OL-WTR-001','A sculptural water vessel handcrafted on slow potter wheels from micro-porous natural clay.','Crafted from mineral-rich alluvial clay along the Narmada river basin, the Soham Carafe cools water through natural micro-evaporation. Unlike metallic or plastic carafes, natural terracotta gently balances the pH of your drinking water, leaving every sip crisp, refreshing, and subtly sweet.\n\nEach piece is hand-burnished using river stones before firing, producing a soft, tactile silk finish without synthetic lacquers.',2699.00,1899.00,520.00,15,5,1250,'14cm Diameter × 24cm Height','100% Lead-Free Porous Terracotta Clay, Natural Portuguese Cork','Rinse with warm water and a soft coir brush before first use. Do not use synthetic dishwashing detergents. Air dry completely before storage.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',1,1,'Soham Earthen Water Carafe with Cork Lid | Oreon Living','A sculptural water vessel handcrafted on slow potter wheels from micro-porous natural clay.','2026-10-18 05:19:04','2026-11-04 13:37:07'),(2,1,'Prana Terracotta Water Dispenser with Brass Tap','prana-terracotta-water-dispenser-brass-tap','OL-WTR-002','A 6-litre countertop earthen water reservoir featuring a solid forged brass dispensing spigot.','Bringing centuries of Indian vernacular wisdom to the contemporary kitchen, the Prana Dispenser holds 6 litres of water, maintaining an ideal 18°C temperature even during midsummer afternoons. Fitted with a food-grade solid brass tap for effortless daily pouring.',3299.00,3999.00,1200.00,14,4,3800,'22cm Diameter × 34cm Height','Natural Red Clay, Forged Brass Spigot with Silicone Washers','Clean weekly with baking soda and warm water. Soak overnight in clean water once a month to rejuvenate pore breathing.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',1,1,'Prana Terracotta Water Dispenser with Brass Tap | Oreon Living','A 6-litre countertop earthen water reservoir featuring a solid forged brass dispensing spigot.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(3,2,'Aura Fluted Terracotta Pedestal Planter','aura-fluted-terracotta-pedestal-planter','OL-PLT-001','Architectural fluted column planter that lets plant roots breathe naturally through unglazed earthen walls.','Hand-carved with gentle vertical flutes, the Aura Planter elevates indoor foliage into living sculpture. Terracotta\'s porous matrix wicks away excess moisture, shielding delicate roots against rot while providing natural soil thermal insulation.',1299.00,1599.00,420.00,22,5,1600,'18cm Top Diameter × 20cm Height','High-fired Porous Terracotta with Drainage Hole & Matching Saucer','Wipe exterior with a dry cloth. White mineral patina forming naturally over time enhances its vintage aesthetic.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',1,0,'Aura Fluted Terracotta Pedestal Planter | Oreon Living','Architectural fluted column planter that lets plant roots breathe naturally through unglazed earthen walls.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(4,2,'Komorebi Wide Low Earthen Bowl Planter','komorebi-wide-low-earthen-bowl-planter','OL-PLT-002','A shallow, grounding bowl planter ideal for succulent arrangements, bonsai, or water lilies.','Inspired by Japanese wabi-sabi aesthetics, the Komorebi bowl is wide and centered. Hand-thrown with coarse sand tempered clay to resist cracking, it serves as a serene focal point for entryway consoles or dining tables.',1699.00,2199.00,580.00,16,4,2200,'28cm Diameter × 12cm Height','Sand-tempered Red Clay with Matte Earth Finish','Suitable for indoor and protected outdoor spaces. Frost resistant.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',0,1,'Komorebi Wide Low Earthen Bowl Planter | Oreon Living','A shallow, grounding bowl planter ideal for succulent arrangements, bonsai, or water lilies.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(5,3,'Amrit Traditional Clay Curd Handi with Lid','amrit-traditional-clay-curd-handi-with-lid','OL-CKW-001','The authentic porous clay pot that sets the thickest, creamiest naturally sweet yogurt.','Clay pots absorb surplus whey through capillary action, concentrating milk solids to yield incomparably dense, velvety curd. The Amrit Handi comes pre-cured with organic rice starch water and pure mustard oil, ready for your kitchen rituals.',799.00,999.00,260.00,35,6,950,'16cm Diameter × 13cm Height','Pure Unglazed Natural Alluvial Clay','Season with warm rice water before first setting. Wash gently with warm water; never use chemical detergents.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',1,1,'Amrit Traditional Clay Curd Handi with Lid | Oreon Living','The authentic porous clay pot that sets the thickest, creamiest naturally sweet yogurt.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(6,3,'Veda Slow-Cooking Clay Biryani Pot with Steamer Lid','veda-slow-cooking-clay-biryani-pot-steamer-lid','OL-CKW-002','Heavy-walled deep clay vessel engineered for low flame dum cooking and aromatic curries.','The thermal inertia of heavy earthen clay seals in natural moisture and essential volatile oils, breaking down spices smoothly while using 50% less cooking oil. Certified completely free of lead, arsenic, and cadmium.',2199.00,2699.00,750.00,19,4,2600,'24cm Diameter × 18cm Height','Heat-Tolerant Micaceous Red Clay','Use on low to medium gas stove flame or oven. Always allow vessel to cool naturally before washing.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',0,1,'Veda Slow-Cooking Clay Biryani Pot with Steamer Lid | Oreon Living','Heavy-walled deep clay vessel engineered for low flame dum cooking and aromatic curries.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(7,4,'Maitri Terracotta Serving Platter & Dip Bowl Set','maitri-terracotta-serving-platter-dip-bowl-set','OL-SRV-001','Hand-pressed oblong serving platter paired with an earthen ramekin for artisanal canapés and breads.','Celebrate mindful hosting with the Maitri Platter. Crafted with a soft chamfered lip and hand-burnished base, it brings the tactile warmth of the kiln to table gatherings, keeping grilled bites naturally warm for longer.',1599.00,1999.00,510.00,17,5,1400,'32cm Length × 18cm Width × 3cm Height','Stoneware Clay blend with Organic Beeswax Polish','Hand wash with mild organic liquid soap and towel dry.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',1,0,'Maitri Terracotta Serving Platter & Dip Bowl Set | Oreon Living','Hand-pressed oblong serving platter paired with an earthen ramekin for artisanal canapés and breads.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(8,4,'Samata Shallow Pasta & Grain Bowls (Set of 2)','samata-shallow-pasta-grain-bowls-set-of-2','OL-SRV-002','Earthy wide-lip pasta bowls featuring a natural cream-slip interior glaze and raw terracotta rim.','A tranquil balance between glazed ease and raw earthen texture. The satin interior slip glaze prevents oil staining while the unglazed outer walls celebrate the natural terracotta grain.',1899.00,2299.00,620.00,23,5,1500,'21cm Diameter × 5.5cm Depth each','Food-grade Glazed Ceramic Clay / Terracotta Exterior','Microwave and dishwasher safe on gentle cycle.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',0,1,'Samata Shallow Pasta & Grain Bowls (Set of 2) | Oreon Living','Earthy wide-lip pasta bowls featuring a natural cream-slip interior glaze and raw terracotta rim.','2026-10-18 05:19:04','2026-10-18 06:05:56'),(9,5,'Kala Minimalist Loop Handle Earthen Vase','kala-minimalist-loop-handle-earthen-vase','OL-VAS-001','A sculptural amphora re-imagined with a bold continuous circular loop handle in raw sand tone.','Designed for minimalist interiors, dry pampas, or wild olive branches. The Kala Vase marries ancient Greek and Indus Valley pottery forms into a single tranquil modern silhouette.',2499.00,2999.00,820.00,12,3,1800,'16cm Width × 28cm Height','Coarse Grain Terracotta with Sand Wash Finish','Designed primarily for dry floral arrangements. Use a glass insert if holding fresh water.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',1,1,'Kala Minimalist Loop Handle Earthen Vase | Oreon Living','A sculptural amphora re-imagined with a bold continuous circular loop handle in raw sand tone.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(10,5,'Dhara Textured Moon Flask Vessel','dhara-textured-moon-flask-vessel','OL-VAS-002','Disc-shaped moon flask crafted with intentional fingertip pottery ridges and an earthen matte patina.','Holding space with quiet confidence, Dhara captures the calm serenity of the full moon. Each piece carries the maker\'s distinct thumb indentations, celebrating the human rhythm behind each piece.',2299.00,2799.00,740.00,15,4,1750,'22cm Width × 8cm Depth × 25cm Height','Stoneware & Red Terracotta Clay blend','Dust lightly with a soft brush.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',0,0,'Dhara Textured Moon Flask Vessel | Oreon Living','Disc-shaped moon flask crafted with intentional fingertip pottery ridges and an earthen matte patina.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(11,6,'Anant Handcrafted Terracotta Akhand Diya with Glass Chimney','anant-handcrafted-terracotta-akhand-diya-glass-chimney','OL-DIA-001','An enduring deep oil reservoir diya shielded by heat-resistant borosilicate glass for tranquil flame rituals.','Hand-shaped from pure terracotta, the Anant Diya holds enough sesame or mustard oil to burn steadily for over 18 hours. The removable glass hurricane prevents drafts while amplifying the serene warm glow across living spaces.',999.00,1299.00,310.00,40,8,850,'12cm Diameter × 18cm Height','Natural Red Clay, Borosilicate Glass Chimney, Brass Wick Holder','Wipe glass with cotton cloth. Wash clay base gently with warm water after flame is fully extinguished.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',1,1,'Anant Handcrafted Terracotta Akhand Diya with Glass Chimney | Oreon Living','An enduring deep oil reservoir diya shielded by heat-resistant borosilicate glass for tranquil flame rituals.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(12,6,'Surya Petal Terracotta Festive Diyas (Box of 8)','surya-petal-terracotta-festive-diyas-box-of-8','OL-DIA-002','Set of 8 petal-shaped earthen oil lamps presented in a sustainable handmade paper gift box.','Crafted by women potters in rural Gujarat using indigenous red clay. Each diya is kiln-baked under slow wood fires, providing a deep rustic hue that enhances festive evenings, Diwali celebrations, or sunset rituals.',499.00,649.00,140.00,65,10,600,'7.5cm Diameter × 3cm Height each','100% Biodegradable Pure Clay','Soak in water for 15 minutes prior to first lighting to reduce oil absorption.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',0,1,'Surya Petal Terracotta Festive Diyas (Box of 8) | Oreon Living','Set of 8 petal-shaped earthen oil lamps presented in a sustainable handmade paper gift box.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(13,7,'Mitti Hand-Thrown Chai Kulhad Tumblers (Set of 4)','mitti-hand-thrown-chai-kulhad-tumblers-set-of-4','OL-TEA-001','Reusable thick-rim earthen tea cups that infuse masala chai with the unforgettable scent of petrichor.','Reimagining the timeless railway kulhad for everyday modern living. Fired at higher temperatures for daily durability while maintaining the signature earthen sweetness that elevates morning tea.',699.00,899.00,210.00,45,8,900,'7cm Diameter × 8.5cm Height (180ml each)','Food-safe High-Fired Terracotta Clay','Hand wash with warm water and air dry thoroughly.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',1,1,'Mitti Hand-Thrown Chai Kulhad Tumblers (Set of 4) | Oreon Living','Reusable thick-rim earthen tea cups that infuse masala chai with the unforgettable scent of petrichor.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(14,7,'Oasis Terracotta Pour-Over Coffee Dripper Set','oasis-terracotta-pour-over-coffee-dripper-set','OL-TEA-002','Cone dripper and matching pitcher that delivers velvety, low-acidity filter brews with optimal thermal stability.','Slow down your morning brew. The Oasis Dripper harnesses clay\'s natural heat retention to sustain a steady extraction temperature, ensuring consistent, bloom-forward coffee every dawn.',1799.00,2299.00,590.00,18,4,1100,'Dripper: 11cm Diameter; Server: 500ml Capacity','Dense Earthen Stoneware with Food-Grade Clear Glaze Interior','Compatible with standard V60 #02 paper filters.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',0,0,'Oasis Terracotta Pour-Over Coffee Dripper Set | Oreon Living','Cone dripper and matching pitcher that delivers velvety, low-acidity filter brews with optimal thermal stability.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(15,8,'Nirvana Monolithic Wood-Fired Vessel No. 04','nirvana-monolithic-wood-fired-vessel-no-04','OL-LTD-001','A singular, hand-coiled collector vessel fired for 72 hours in an open anagama kiln.','Signed and numbered by Master Potter Ramachandran in Kutch. The accidental wood ash deposits and flame currents create an iridescent bronze-black surface that cannot ever be replicated. An authentic masterwork of Indian ceramic sculpture.',5499.00,6499.00,2200.00,4,2,4200,'26cm Width × 38cm Height','Wild Foraged Clay, Wood Ash Deposits, Naturally Reduced Iron Oxide','Collector piece. Display on solid surface away from vibration. Wipe with clean microfibre cloth.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',1,0,'Nirvana Monolithic Wood-Fired Vessel No. 04 | Oreon Living','A singular, hand-coiled collector vessel fired for 72 hours in an open anagama kiln.','2026-10-18 05:19:04','2026-10-18 05:19:04'),(16,2,'Zenith Hanging Terracotta Planter with Jute Cord','zenith-hanging-terracotta-planter-jute-cord','OL-PLT-003','Suspended earthenware bowl with hand-twisted natural jute rope for trailing vines and pothos.','Float greenery at eye level. The Zenith Planter features three reinforced rope grommets and an internal drainage reservoir that keeps roots aerated while protecting ceilings and hardwood floors from dripping.',999.00,1299.00,310.00,25,5,1100,'16cm Diameter × 10cm Bowl Depth; 75cm Cord Length','Terracotta Clay with Natural Golden Jute Cord','Avoid prolonged direct exposure to torrential outdoor rain to preserve jute fibers.','https://www.youtube.com/embed/dQw4w9WgXcQ','published',0,1,'Zenith Hanging Terracotta Planter with Jute Cord | Oreon Living','Suspended earthenware bowl with hand-twisted natural jute rope for trailing vines and pothos.','2026-10-18 05:19:04','2026-10-18 05:19:04');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint NOT NULL DEFAULT '5',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_product_id_foreign` (`product_id`),
  KEY `reviews_status_index` (`status`),
  CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,8,1,'Pooja Iyer',5,'Water has never tasted this sweet and refreshing','I replaced our stainless steel carafe with the Soham Earthen Carafe three months ago. The subtle cooling is remarkable without being teeth-chilling like refrigerator water. The cork lid also keeps dust away cleanly.','approved','2026-10-18 05:19:04','2026-10-18 05:19:04'),(2,8,2,'Dr. K. S. Sundaram',5,'Sets yogurt just like my grandmother used to make','The Amrit Curd Handi is a revelation. In Bangalore weather it sets firm, Greek-yogurt consistency curd in barely 6 hours with zero sourness. Excellent packaging as well—arrived without a single scratch.','approved','2026-10-18 05:19:04','2026-10-18 05:19:04'),(3,8,3,'Sunaina Kapoor',5,'True wabi-sabi centerpiece in my living room','The Kala vase is a work of sculptural art. The tactile matte terracotta texture feels soothing to touch. It commands attention on our entryway credenza.','approved','2026-10-18 05:19:04','2026-10-18 05:19:04'),(4,8,4,'Rohan Mehta',4,'Great quality, prompt delivery to Mumbai','Ordered the kulhads and planter set. Extremely robust packaging with eco-friendly corrugated wrap. Water dispensers tap works smoothly with zero leakage.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05'),(5,8,5,'Pooja Iyer',5,'Water has never tasted this sweet and refreshing','I replaced our stainless steel carafe with the Soham Earthen Carafe three months ago. The subtle cooling is remarkable without being teeth-chilling like refrigerator water. The cork lid also keeps dust away cleanly.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05'),(6,8,6,'Dr. K. S. Sundaram',5,'Sets yogurt just like my grandmother used to make','The Amrit Curd Handi is a revelation. In Bangalore weather it sets firm, Greek-yogurt consistency curd in barely 6 hours with zero sourness. Excellent packaging as well—arrived without a single scratch.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05'),(7,8,7,'Sunaina Kapoor',5,'True wabi-sabi centerpiece in my living room','The Kala vase is a work of sculptural art. The tactile matte terracotta texture feels soothing to touch. It commands attention on our entryway credenza.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05'),(8,8,8,'Rohan Mehta',4,'Great quality, prompt delivery to Mumbai','Ordered the kulhads and planter set. Extremely robust packaging with eco-friendly corrugated wrap. Water dispensers tap works smoothly with zero leakage.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05'),(9,8,9,'Pooja Iyer',5,'Water has never tasted this sweet and refreshing','I replaced our stainless steel carafe with the Soham Earthen Carafe three months ago. The subtle cooling is remarkable without being teeth-chilling like refrigerator water. The cork lid also keeps dust away cleanly.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05'),(10,8,10,'Dr. K. S. Sundaram',5,'Sets yogurt just like my grandmother used to make','The Amrit Curd Handi is a revelation. In Bangalore weather it sets firm, Greek-yogurt consistency curd in barely 6 hours with zero sourness. Excellent packaging as well—arrived without a single scratch.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05'),(11,8,11,'Sunaina Kapoor',5,'True wabi-sabi centerpiece in my living room','The Kala vase is a work of sculptural art. The tactile matte terracotta texture feels soothing to touch. It commands attention on our entryway credenza.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05'),(12,8,12,'Rohan Mehta',4,'Great quality, prompt delivery to Mumbai','Ordered the kulhads and planter set. Extremely robust packaging with eco-friendly corrugated wrap. Water dispensers tap works smoothly with zero leakage.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05'),(13,8,13,'Pooja Iyer',5,'Water has never tasted this sweet and refreshing','I replaced our stainless steel carafe with the Soham Earthen Carafe three months ago. The subtle cooling is remarkable without being teeth-chilling like refrigerator water. The cork lid also keeps dust away cleanly.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05'),(14,8,14,'Dr. K. S. Sundaram',5,'Sets yogurt just like my grandmother used to make','The Amrit Curd Handi is a revelation. In Bangalore weather it sets firm, Greek-yogurt consistency curd in barely 6 hours with zero sourness. Excellent packaging as well—arrived without a single scratch.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05'),(15,8,15,'Sunaina Kapoor',5,'True wabi-sabi centerpiece in my living room','The Kala vase is a work of sculptural art. The tactile matte terracotta texture feels soothing to touch. It commands attention on our entryway credenza.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05'),(16,8,16,'Rohan Mehta',4,'Great quality, prompt delivery to Mumbai','Ordered the kulhads and planter set. Extremely robust packaging with eco-friendly corrugated wrap. Water dispensers tap works smoothly with zero leakage.','approved','2026-10-18 05:19:05','2026-10-18 05:19:05');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_index` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Aditya Verma (Super Admin)','admin@oreonliving.com','+91 98765 00001','super_admin',1,NULL,'$2y$12$kmvOgpsEyMBnT1KzR8YOGejxng0KMuAC3vmqUSoOIaHdTkTlmy7JW',NULL,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(2,'Meera Nair (Content Manager)','content@oreonliving.com','+91 98765 00002','content_manager',1,NULL,'$2y$12$kmvOgpsEyMBnT1KzR8YOGejxng0KMuAC3vmqUSoOIaHdTkTlmy7JW',NULL,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(3,'Rajesh Sharma (Product Manager)','products@oreonliving.com','+91 98765 00003','product_manager',1,NULL,'$2y$12$kmvOgpsEyMBnT1KzR8YOGejxng0KMuAC3vmqUSoOIaHdTkTlmy7JW',NULL,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(4,'Kavita Joshi (Order Manager)','orders@oreonliving.com','+91 98765 00004','order_manager',1,NULL,'$2y$12$kmvOgpsEyMBnT1KzR8YOGejxng0KMuAC3vmqUSoOIaHdTkTlmy7JW','UmayrF5DqW4WOqqT9TxomATkfE5tE7kvIPTgFbRxc44EFddHfKuQrQpAhfWz','2026-10-18 05:19:04','2026-10-18 05:19:04'),(5,'Arun Patel (Customer Support)','support@oreonliving.com','+91 98765 00005','customer_support',1,NULL,'$2y$12$kmvOgpsEyMBnT1KzR8YOGejxng0KMuAC3vmqUSoOIaHdTkTlmy7JW',NULL,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(6,'Siddharth Roy (Marketing Manager)','marketing@oreonliving.com','+91 98765 00006','marketing_manager',1,NULL,'$2y$12$kmvOgpsEyMBnT1KzR8YOGejxng0KMuAC3vmqUSoOIaHdTkTlmy7JW',NULL,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(7,'Sneha Kulkarni (Viewer)','viewer@oreonliving.com','+91 98765 00007','viewer',1,NULL,'$2y$12$kmvOgpsEyMBnT1KzR8YOGejxng0KMuAC3vmqUSoOIaHdTkTlmy7JW',NULL,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(8,'Ananya Deshmukh','ananya@example.com','+91 98200 12345','customer',1,NULL,'$2y$12$kmvOgpsEyMBnT1KzR8YOGejxng0KMuAC3vmqUSoOIaHdTkTlmy7JW','btiRbTwJszsdRkS6w4L9Ai3h66gjpNxzODIvDjfaJYrmZH1TbOxegSfNQMYx','2026-10-18 05:19:04','2026-10-18 05:19:04'),(9,'Vikram Malhotra','customer@example.com','+91 98111 67890','customer',1,NULL,'$2y$12$kmvOgpsEyMBnT1KzR8YOGejxng0KMuAC3vmqUSoOIaHdTkTlmy7JW',NULL,'2026-10-18 05:19:04','2026-10-18 05:19:04'),(10,'Lazaro Hane DVM','samara68@example.com',NULL,'customer',1,'2026-10-18 06:01:27','$2y$04$YNAg/VRBmNqjayOPljU4Tu0vcs59Sot6ofIiudlsLRgWZ5UNt/Gmu','sWejrcPMe1','2026-10-18 06:01:27','2026-10-18 06:01:27'),(11,'Cristobal Balistreri','dibbert.jerod@example.org',NULL,'customer',1,'2026-10-18 06:17:56','$2y$04$YRtQBCw1Ot6V91Cwwce86uM0BiDNX4g8os1gtKHg7wIsSSrwbRKBe','e8H6SjMo5P','2026-10-18 06:17:56','2026-10-18 06:17:56'),(12,'Marjory Crist','alana48@example.org',NULL,'customer',1,'2026-11-04 12:42:27','$2y$04$3kgYhJmoEKVpKDkh5fGeVe10BuynVXfKK2KGwuyyZA5jZoFspkQgq','xmVfVuvKUK','2026-11-04 12:42:27','2026-11-04 12:42:27'),(13,'Julie Kiehn','brown.ambrose@example.org',NULL,'customer',1,'2026-11-04 13:35:53','$2y$04$tpXlYAuyH6asmyPYLN/er.ih5TlDLMyKgg3DePisY5xy5TwdGDR/i','EptpucRGvx','2026-11-04 13:35:53','2026-11-04 13:35:53'),(14,'Dr. Travis Hauck','clementine44@example.com',NULL,'customer',1,'2026-11-04 13:37:07','$2y$04$BNa0tRCRd.MAOGkPFjPXJO0gPNajbZxZT45uq/FzYtnRN82G6g5X6','PsBKJq1c0v','2026-11-04 13:37:07','2026-11-04 13:37:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `website_settings`
--

DROP TABLE IF EXISTS `website_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `website_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `website_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `website_settings`
--

LOCK TABLES `website_settings` WRITE;
/*!40000 ALTER TABLE `website_settings` DISABLE KEYS */;
INSERT INTO `website_settings` VALUES (1,'site_name','Oreon Living','general','2026-10-18 05:19:05','2026-10-18 05:19:05'),(2,'site_tagline','Crafted from Earth. Designed for Modern Living.','general','2026-10-18 05:19:05','2026-10-18 05:19:05'),(3,'announcement_bar_text','Test Announcement 7263','announcement','2026-10-18 05:19:05','2026-11-04 13:37:05'),(4,'announcement_bar_link','/shop','announcement','2026-10-18 05:19:05','2026-11-04 12:41:39'),(5,'announcement_bar_enabled','1','announcement','2026-10-18 05:19:05','2026-11-04 12:41:39'),(6,'whatsapp_number','919876543210','contact','2026-10-18 05:19:05','2026-11-04 12:41:39'),(7,'support_email','concierge@oreonliving.com','contact','2026-10-18 05:19:05','2026-11-04 12:41:39'),(8,'support_phone','+91 98765 43210','contact','2026-10-18 05:19:05','2026-11-04 12:41:39'),(9,'address','42 Pottery Lane, Heritage Crafts District, Bengaluru','contact','2026-10-18 05:19:05','2026-11-04 12:41:39'),(10,'meta_pixel_id','1234567890','tracking','2026-10-18 05:19:05','2026-11-04 12:41:39'),(11,'google_analytics_id','G-TEST12345','tracking','2026-10-18 05:19:05','2026-11-04 12:41:39'),(12,'instagram_url','https://instagram.com/oreonliving','social','2026-10-18 05:19:05','2026-11-04 12:41:39'),(13,'facebook_url','https://facebook.com/oreonliving','social','2026-10-18 05:19:05','2026-11-04 12:41:39'),(14,'free_shipping_threshold','1999','shipping','2026-10-18 05:19:05','2026-11-04 12:41:39'),(15,'standard_shipping_fee','149','shipping','2026-10-18 05:19:05','2026-11-04 12:41:39'),(16,'meta_title_default','Oreon Living | Natural Earthen Clay','seo','2026-11-04 12:41:39','2026-11-04 12:41:39'),(17,'meta_description_default','Pure unglazed porous pottery and terracotta wares.','seo','2026-11-04 12:41:39','2026-11-04 12:41:39'),(18,'google_search_console_tag','test-verification-code','tracking','2026-11-04 12:41:39','2026-11-04 12:41:39');
/*!40000 ALTER TABLE `website_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
INSERT INTO `wishlists` VALUES (1,8,1,'2026-10-18 06:07:20','2026-10-18 06:07:20'),(2,8,2,'2026-10-18 06:07:21','2026-10-18 06:07:21');
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-05  0:51:48
