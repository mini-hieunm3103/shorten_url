-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: laravel_shorten_url
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.22.04.1

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
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `user_id` int unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `groups_user_id_foreign` (`user_id`),
  KEY `groups_role_id_foreign` (`role_id`),
  CONSTRAINT `groups_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Super Administrator',NULL,0,1,'2023-12-29 16:17:55','2023-12-29 16:17:55'),(2,'Administrator',NULL,1,2,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(3,'User',NULL,1,3,'2023-12-29 16:17:56','2023-12-29 16:17:56');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_12_14_000001_create_personal_access_tokens_table',1),(4,'2023_12_22_123610_create_groups_table',1),(5,'2023_12_22_123759_create_urls_table',1),(6,'2023_12_22_124708_create_tags_table',1),(7,'2023_12_22_124958_create_url_tag_table',1),(8,'2023_12_22_125115_create_modules_table',1),(9,'2023_12_22_125235_create_permission_tables',1),(10,'2023_12_22_130136_add_foreign_group_id_users_table',1),(11,'2023_12_22_130317_add_foreign_key_groups_table',1),(12,'2023_12_22_211151_add_foreign_module_id_permissions_table',1),(13,'2023_12_30_093419_create_is_custom_column_urls_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'Modules\\User\\app\\Models\\User',1),(1,'Modules\\User\\app\\Models\\User',3),(3,'Modules\\User\\app\\Models\\User',10);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modules` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,'group','Nhóm','users','2023-12-29 16:17:55','2023-12-29 16:17:55'),(2,'user','Người Dùng',NULL,'2023-12-29 16:17:55','2023-12-29 16:17:55'),(3,'tag','Nhãn Dán',NULL,'2023-12-29 16:17:55','2023-12-29 16:17:55'),(4,'url','URL Rút Gọn','link','2023-12-29 16:17:55','2023-12-29 16:17:55');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
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
INSERT INTO `password_reset_tokens` VALUES ('hieunm3103@gmail.com','$2y$12$uPy9HXSzRT8i76FYOZwNt..FqysaQf2xvQZCLy0exJR3vj62Quqe6','2024-01-02 09:51:31');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  KEY `permissions_module_id_foreign` (`module_id`),
  CONSTRAINT `permissions_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view groups','web',1,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(2,'show group','web',1,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(3,'create group','web',1,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(4,'edit group','web',1,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(5,'delete group','web',1,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(6,'permission group','web',1,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(7,'view users','web',2,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(8,'show user','web',2,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(9,'create user','web',2,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(10,'edit user','web',2,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(11,'delete user','web',2,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(12,'view tags','web',3,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(13,'show tag','web',3,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(14,'create tag','web',3,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(15,'edit tag','web',3,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(16,'delete tag','web',3,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(17,'view urls','web',4,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(18,'show url','web',4,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(19,'create url','web',4,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(20,'edit url','web',4,'2023-12-29 16:17:56','2023-12-29 16:17:56'),(21,'delete url','web',4,'2023-12-29 16:17:56','2023-12-29 16:17:56');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(1,2),(2,2),(3,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(8,3),(10,3),(11,3),(13,3),(14,3),(17,3),(18,3),(19,3),(20,3),(21,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super_administrator','web','2023-12-29 16:17:56','2023-12-29 16:17:56'),(2,'administrator','web','2023-12-29 16:17:56','2023-12-29 16:17:56'),(3,'user','web','2023-12-29 16:17:56','2023-12-29 16:17:56');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tags_user_id_foreign` (`user_id`),
  CONSTRAINT `tags_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (13,'Laravel',1,'2023-12-30 02:25:37','2023-12-30 02:25:37'),(15,'All',1,'2023-12-30 02:27:49','2023-12-30 02:27:49'),(16,'Custom',1,'2023-12-30 03:18:56','2023-12-30 03:18:56'),(28,'jk',1,'2023-12-30 13:34:52','2023-12-30 13:34:52'),(35,'gds',1,'2023-12-30 15:08:22','2023-12-30 15:08:22'),(36,'acs',1,'2023-12-30 15:08:45','2023-12-30 15:08:45'),(37,'gsdf',1,'2023-12-31 02:24:48','2023-12-31 02:24:48'),(39,'URL',1,'2024-01-02 03:47:38','2024-01-02 03:47:38'),(40,'Heroku',3,'2024-01-02 10:15:07','2024-01-02 10:15:07'),(45,'Heroku',1,'2024-01-03 06:20:47','2024-01-03 06:20:47'),(46,'me',3,'2024-01-03 10:45:50','2024-01-03 10:45:50');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `url_tag`
--

DROP TABLE IF EXISTS `url_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `url_tag` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `url_id` bigint unsigned NOT NULL,
  `tag_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `url_tag_url_id_foreign` (`url_id`),
  KEY `url_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `url_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE,
  CONSTRAINT `url_tag_url_id_foreign` FOREIGN KEY (`url_id`) REFERENCES `urls` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `url_tag`
--

LOCK TABLES `url_tag` WRITE;
/*!40000 ALTER TABLE `url_tag` DISABLE KEYS */;
INSERT INTO `url_tag` VALUES (12,3,15,'2023-12-30 02:27:49','2023-12-30 02:27:49'),(13,1,15,'2024-01-03 05:51:07','2024-01-03 05:51:07'),(16,8,16,'2023-12-31 04:00:42','2023-12-31 04:00:42'),(37,3,13,'2023-12-31 06:20:13','2023-12-31 06:20:13'),(44,14,39,'2024-01-02 03:47:38','2024-01-02 03:47:38'),(56,27,45,'2024-01-03 06:21:44','2024-01-03 06:21:44'),(57,27,15,'2024-01-03 06:21:44','2024-01-03 06:21:44'),(58,20,46,'2024-01-03 10:45:50','2024-01-03 10:45:50');
/*!40000 ALTER TABLE `url_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urls`
--

DROP TABLE IF EXISTS `urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `urls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `back_half` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int unsigned NOT NULL,
  `clicks` int NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_custom` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `urls_user_id_foreign` (`user_id`),
  CONSTRAINT `urls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urls`
--

LOCK TABLES `urls` WRITE;
/*!40000 ALTER TABLE `urls` DISABLE KEYS */;
INSERT INTO `urls` VALUES (1,'TC','http://www.heathcote.com/ipsa-aperiam-nobis-sint','QjC8x',1,0,1,'2023-03-23 06:30:12','2024-01-03 05:51:07','2024-02-02 05:51:07',1),(3,'Untitled 2023-12-29 16:17:55 UTC','http://gleichner.com/','090Gu',1,0,1,'2023-11-02 09:39:51','2023-12-31 05:10:50','2024-01-28 16:17:55',0),(8,'Untitled 2023-12-30 02:44:24','https://icons.getbootstrap.com/icons/x-circle/','aaaaa',1,0,1,'2023-12-30 02:44:24','2023-12-31 05:13:28','2024-01-30 04:00:42',1),(14,'Shorten-url','https://shortenurl-75506879d065.herokuapp.com/','shortenurl',1,0,1,'2024-01-01 02:42:02','2024-01-03 03:50:31','2024-01-31 02:42:02',1),(20,'Untitled 2024-01-03 02:05:07','https://www.shorturl.at/shortener.php','jx21zt',3,0,1,'2024-01-03 02:05:07','2024-01-03 02:05:07','2024-02-02 02:05:07',0),(27,'heroku','https://devcenter.heroku.com/articles/automated-certificate-management#view-your-certificate-status','heroku1',1,0,1,'2024-01-03 06:18:37','2024-01-03 06:21:44','2024-02-02 06:21:44',1),(29,'Untitled 2024-01-03 14:08:25','https://www.shorturl.at/','59zLOjj',1,0,1,'2024-01-03 14:08:25','2024-01-03 14:08:25','2024-02-02 14:08:25',0),(30,'Untitled 2024-01-04 08:06:22','https://devcenter.heroku.com/aticles/automated-certificate-management#view-your-certificate-status','MnMu5Xg',3,0,1,'2024-01-04 08:06:22','2024-01-04 08:06:22','2024-02-03 08:06:22',0);
/*!40000 ALTER TABLE `urls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` int unsigned NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_group_id_foreign` (`group_id`),
  CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nguyễn Minh Hiếu','hieunm3103@gmail.com',1,NULL,'$2y$12$W/ckyVxd6jfSdcMmUD7p/.r3NptkeXqY2tmmIDnt6LHqnoPi6KHyS',NULL,'2023-12-29 16:17:55','2024-01-02 03:26:03'),(3,'Administrator','admin@gmail.com',1,NULL,'$2y$12$DwcnZop8T68ypyvU7FeExewXxxyIkZ5MKR0I2Bls6YIPsGuF/D/kW',NULL,'2024-01-01 08:24:41','2024-01-02 10:11:37'),(10,'Ta Thi Ha','ha@gmail.com',3,NULL,'$2y$12$uHxXZfYkEdfBEPjcy7Us/.WPj6hSvyTnLDlqLz9vQxOlsY0AkIrpe',NULL,'2024-01-02 12:25:09','2024-01-02 12:25:09'),(13,'Xyla Bridges','qigymer@mailinator.com',3,NULL,'$2y$12$AlGXXA4s1u27gpa2biq33O3XexNGeWYqwZHmeQu8fqv/u.AnMooJK',NULL,'2024-01-03 03:47:38','2024-01-03 03:47:38'),(14,'Abra Rocha','mikec@mailinator.com',3,NULL,'$2y$12$aoDFZW1wvValF3UJY8jxzuLjOZ31evfgAMngfn4CGsyoNadLyS8M6',NULL,'2024-01-03 03:53:51','2024-01-03 03:53:51'),(15,'Wynne Bullock','tomykal@mailinator.com',3,NULL,'$2y$12$bzeAL5dCtkjOmahMTpo9Ke4C9J1vb1GoAsnbOpOZ3kOzKK6ZDolX2',NULL,'2024-01-03 03:54:56','2024-01-03 03:54:56'),(16,'Patience Graves','kasab@mailinator.com',3,NULL,'$2y$12$DxFKZHMw/6HT/zqfdOfbeOBxYNB9BdTnELzift7qTcK4GL7YWeXiO',NULL,'2024-01-03 03:55:28','2024-01-03 03:55:28'),(17,'Oscar Douglas','nejupacew@mailinator.com',3,NULL,'$2y$12$heE6qfpMw1s2iujFK4PkwO9eweAyGBaGBPIcG1DjXmEmSpgV3a.Ji',NULL,'2024-01-03 03:58:54','2024-01-03 03:58:54'),(18,'Vladimir Baird','ragypek@mailinator.com',3,NULL,'$2y$12$iaDtRRxHQ5t6MElQ6Xpy9u/PAC6EFeoV/kDlPwFn4cAaz2bIIkh5C',NULL,'2024-01-03 04:10:28','2024-01-03 04:10:28'),(19,'Amanda Klein','fatoqy@mailinator.com',3,NULL,'$2y$12$W8U3JHhiX9zRRTbOrgRV2.kMcu4Kj9DUoL3Xjv2NWHyodBmWDwYrO',NULL,'2024-01-03 04:11:49','2024-01-03 04:11:49'),(20,'Nicole Solis','falibe@mailinator.com',3,NULL,'$2y$12$QZ6HsAUTInaJxMiHaIQOsu8yp.PB0lUlu.00kFYaU15ANYnK/5WtO',NULL,'2024-01-03 04:12:11','2024-01-03 04:12:11');
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

-- Dump completed on 2024-01-04 20:14:14
