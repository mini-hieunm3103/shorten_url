-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2023 at 12:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_shorten_url`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `permissions` text DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', NULL, 0, '2023-12-20 02:48:00', '2023-12-20 02:48:00'),
(2, 'Administrator', NULL, 1, '2023-12-20 06:23:59', '2023-12-20 06:23:59'),
(3, 'User', NULL, 1, '2023-12-20 02:50:07', '2023-12-20 02:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_12_10_123303_create_urls_table', 1),
(5, '2023_12_11_231311_add_foreign_urls_table', 1),
(6, '2023_12_13_130707_create_tags_table', 1),
(7, '2023_12_13_215352_create_url_tag_table', 1),
(8, '2023_12_14_151905_add_foreign_tags_table', 1),
(9, '2023_12_14_230634_create_groups_table', 1),
(10, '2023_12_15_101802_add_foreign_user_table', 1),
(11, '2023_12_15_223804_create_permission_tables', 1),
(12, '2023_12_20_100446_create_modules_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `title`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'user', 'Người Dùng', NULL, '2023-12-20 03:09:09', '2023-12-20 03:09:09'),
(2, 'group', 'Nhóm', 'users', '2023-12-20 03:09:09', '2023-12-20 03:09:09'),
(3, 'url', 'URL Rút Gọn', 'link', '2023-12-20 03:09:09', '2023-12-20 03:09:09'),
(4, 'tag', 'Nhãn Dán', NULL, '2023-12-20 03:09:09', '2023-12-20 03:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Voluptas veritatis libero ut.', NULL, 1, '2023-02-26 23:55:29', '2023-12-20 02:48:35'),
(2, 'Ut et dolore quia.', 'Tenetur et sint necessitatibus sit consequatur magnam.', 1, '2023-07-21 04:00:03', '2023-10-21 11:01:30'),
(3, 'Itaque et eligendi eaque ea.', 'Natus aperiam exercitationem sed ipsa reiciendis et id perferendis.', 1, '2023-09-21 10:35:08', '2023-07-12 04:56:49'),
(4, 'Praesentium dolor qui sed.', 'Asperiores veritatis rem explicabo rerum voluptatem neque magnam esse.', 1, '2023-07-23 18:38:03', '2023-04-05 06:12:56'),
(5, 'Eum vel alias architecto.', 'Aut aut illum velit qui recusandae reiciendis officiis.', 1, '2023-10-28 03:08:24', '2023-12-11 09:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `long_url` varchar(255) NOT NULL,
  `back_half` varchar(255) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `clicks` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`id`, `title`, `long_url`, `back_half`, `user_id`, `clicks`, `created_at`, `updated_at`, `expired_at`) VALUES
(6, 'Chat GPT', 'https://chat.openai.com/', 'tbTD2ao', 1, 6, '2023-12-20 04:40:16', '2023-12-20 11:13:22', '2024-01-19 11:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `url_tag`
--

CREATE TABLE `url_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `url_tag`
--

INSERT INTO `url_tag` (`id`, `url_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(3, 6, 3, '2023-12-20 06:48:14', '2023-12-20 06:48:14'),
(4, 6, 4, '2023-12-20 06:48:14', '2023-12-20 06:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `group_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Minh Hiếu', 'hieunm3103@gmail.com', 1, NULL, '$2y$12$mzqRYfoblkSLdJ3FQvS8QenKJfQHQDeL9bUUbzqgOpkuBR5kZGlrO', NULL, '2023-12-20 02:48:00', '2023-12-20 02:48:00'),
(42, 'Earl Witting', 'hillary99@example.com', 2, NULL, '$2y$12$0JVAmgLnDINNKO08ICrtf.h8A2dLxFP.hNllev3hlkEhys.8zMvB.', NULL, '1997-06-30 08:30:30', '2013-06-02 04:30:26'),
(43, 'Ryan Lueilwitz', 'kiehn.janis@example.com', 2, NULL, '$2y$12$1BqG1MfoDhawr0wfCVWT8u6ACelULL74VIQRNAw1XWYisgktnrnpm', NULL, '1979-07-01 21:54:40', '2003-11-23 21:11:09'),
(44, 'Mia Ortiz', 'tlubowitz@example.net', 2, NULL, '$2y$12$65N8GFcUjWzqflEztm0tPe8i5VOlGFdNYiwO3f5sButYNT49Wz0ny', NULL, '1971-10-19 02:30:47', '1989-11-20 00:52:17'),
(45, 'Geo Graham', 'dbode@example.net', 2, NULL, '$2y$12$JdLHtz7iIAYzEcMMYaVf9eRq8xsGZOLKadbYaRmkzZq6Odf1oQADq', NULL, '1972-10-31 07:35:32', '2015-05-29 16:18:35'),
(46, 'Lempi Morar', 'davis.jalon@example.net', 2, NULL, '$2y$12$4O7YOFVWkmeku.IEgpaMbOCpNiVRvrlGyLDfhkbhRsMz6Pe3TNpKC', NULL, '2000-08-20 03:21:36', '2015-08-12 11:22:46'),
(66, 'Prof. Eldridge Schiller', 'dmedhurst@example.net', 2, NULL, '$2y$12$s0Wxg9NSeHB3wmdbUuzWIOpadg2SrUryQgWAXaWa7b.EYSTR/fQmm', NULL, '1981-11-26 06:24:31', '2003-09-10 23:19:34'),
(67, 'Shirley Abbott', 'sstoltenberg@example.net', 3, NULL, '$2y$12$GG4XGqXPf5Muhb5TiN.Xduloe1Liw00NzKoMx4IUc.lT8p.0BbP5e', NULL, '1992-11-04 11:29:36', '2014-09-20 07:54:00'),
(68, 'Roslyn Tillman', 'micaela38@example.net', 3, NULL, '$2y$12$UC5/fpI4/0oKeSU6wcm0w.m1.w2VVYVveUVOGoWnfEJaV3ktCwtmW', NULL, '1998-10-03 13:35:55', '1996-07-30 04:31:00'),
(69, 'Mrs. Abagail Simonis', 'vhyatt@example.net', 3, NULL, '$2y$12$jX9Mt67GhiAF3TL2rASjWO0/1Un/w42b./GUXMgC8MiEWHIUNNYVe', NULL, '2016-11-09 19:02:37', '2012-07-11 20:40:55'),
(70, 'Cristian Gleason', 'mara.corwin@example.net', 3, NULL, '$2y$12$n02xgokj4CwD2fgDORPv.uE1rccZa4VFWYL25whOF4Lw2gxlSmj6S', NULL, '1988-10-29 17:10:54', '2001-10-10 09:35:26'),
(71, 'Laila Roberts', 'ayana.kulas@example.org', 3, NULL, '$2y$12$Y/v0mKLWIIY60BJml2IW/.EyHrkkveK.uKym3ou1F9NJO6u8L2VVu', NULL, '2017-08-23 12:15:36', '2023-03-07 04:50:45'),
(72, 'Ms. Reta Crona III', 'tschuster@example.com', 3, NULL, '$2y$12$fiVKafksIQcSpBXe6DcUvu7zgIv8PpPFtAy9aKHNGcIsRlrYuw2N.', NULL, '1981-02-07 04:28:48', '1987-03-26 13:25:59'),
(73, 'Keshawn Hickle', 'padberg.judson@example.net', 3, NULL, '$2y$12$kD36rjZTl4AvCqULqdXi8OPBSmdNRVz8A63XZMYWs2U2/wK/BXnQm', NULL, '2002-12-03 10:09:59', '2019-01-27 19:04:13'),
(74, 'Prof. Eddie Schultz', 'hudson.reyes@example.net', 3, NULL, '$2y$12$EdX5OGFTotxwZY1wjLY/7.MmOpyEeWxZCphGh6dyKjNvPGzVJbr1O', NULL, '2014-06-21 23:59:50', '1979-06-06 17:45:13'),
(75, 'Marvin Goldner', 'llegros@example.com', 3, NULL, '$2y$12$DxsBO/m21igPdA.PADj04ucoC8M5FAtHsX5MqeIDkZLWQ5/mb0DtG', NULL, '1976-01-16 16:53:16', '2011-06-05 16:45:01'),
(76, 'Autumn Moen', 'hnitzsche@example.org', 3, NULL, '$2y$12$5RiSpKHFbCJBGI7L/aG/6uj42lrZRpCww8zUm4MMhFc6oLtDmbzM.', NULL, '1981-05-01 08:27:36', '2018-04-24 06:29:03'),
(77, 'Melody Graham', 'sgrimes@example.org', 3, NULL, '$2y$12$54GmeOdWIAlUUVwD9J3su.z6yNzvuaXZ1l85984HamdhsJfaem.e6', NULL, '1970-05-16 06:23:49', '1970-01-24 22:33:37'),
(78, 'Mathilde Satterfield', 'sfranecki@example.net', 3, NULL, '$2y$12$xV0WzWnQxwyjlc6pCEofBe/0U2LchsajyWLKNYU3Aeqm/ULNyPSHC', NULL, '2022-04-28 12:00:21', '2002-11-11 08:17:53'),
(79, 'Dr. Kevon Effertz', 'wallace.schneider@example.org', 3, NULL, '$2y$12$IlhW51Gp6L3i1J8bqPNNUO7ClMcyJHTSkuGBuNs9HWZ.m9h817o9e', NULL, '1979-11-13 18:36:49', '2022-09-29 00:21:14'),
(80, 'Dr. Elmore D\'Amore', 'fannie64@example.com', 3, NULL, '$2y$12$w6TeFylYDbfWlh2RLSm4UemgLLNSSxh0Bk3xAVkkeIhWxinQlJTo2', NULL, '2008-08-02 20:44:37', '1977-01-17 19:17:26'),
(81, 'Ward Gislason', 'qwitting@example.com', 3, NULL, '$2y$12$bsivtPISHBAXbiZx9eM2uOloEI95ZljM7TvU6GP4aUgiIvfTZTCWO', NULL, '2021-12-31 15:12:04', '1990-01-18 15:35:44'),
(82, 'Dr. Gayle Haley II', 'altenwerth.nyasia@example.com', 3, NULL, '$2y$12$jYAu1vJSdtVAs1wq/Dq9FO/9KveTJMMTlraFn8doeG9znlfHwasMa', NULL, '1989-01-31 17:55:53', '2018-02-18 01:35:38'),
(83, 'Isai Lubowitz', 'pouros.rosalinda@example.org', 3, NULL, '$2y$12$OhFkrmY1NvvjGiXgVShpX.OVeXzm5w9n527WVSg.z09JKG6D1HFh6', NULL, '1975-03-29 06:26:30', '2015-02-11 18:03:22'),
(84, 'Shawn King', 'angelina.weber@example.net', 3, NULL, '$2y$12$qg8rZIrdTG.ezW9g86gle.zzs0eoe9H7Pr/rEsrSRmDvQBVAR1bBG', NULL, '2015-07-17 16:37:19', '1999-12-27 07:55:24'),
(85, 'Edmond Hahn', 'cassandra.bayer@example.com', 3, NULL, '$2y$12$UfeiqT.R/Lz/TlWGUi5Cm.KSd7avjY8UcHjvYicfNUv.UOYpXTxhi', NULL, '2023-11-11 16:43:19', '1997-08-19 20:03:28'),
(86, 'Jennings Armstrong V', 'dickens.donavon@example.net', 3, NULL, '$2y$12$3DXyS9Rjq./RjWD1Mcr4/eZOCRi5b60XpWXa1gtSXydCwfZAwLLNO', NULL, '1999-01-10 03:15:02', '2006-07-15 00:32:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_user_id_foreign` (`user_id`);

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `urls_user_id_foreign` (`user_id`);

--
-- Indexes for table `url_tag`
--
ALTER TABLE `url_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url_tag_url_id_foreign` (`url_id`),
  ADD KEY `url_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_group_id_foreign` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `url_tag`
--
ALTER TABLE `url_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `urls`
--
ALTER TABLE `urls`
  ADD CONSTRAINT `urls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `url_tag`
--
ALTER TABLE `url_tag`
  ADD CONSTRAINT `url_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `url_tag_url_id_foreign` FOREIGN KEY (`url_id`) REFERENCES `urls` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
