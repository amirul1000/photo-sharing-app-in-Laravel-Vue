-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 07:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_photo_sharing`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Pet', 'Pet Desc', '2024-10-10 23:26:09', '2024-10-10 23:26:09'),
(2, 'Tree', '66', '2024-10-16 08:10:09', '2024-10-16 08:10:09'),
(3, 'Friends', 'Friends', '2024-10-16 11:47:29', '2024-10-16 11:47:29'),
(4, 'Family', 'Family', '2024-10-16 11:48:07', '2024-10-16 11:48:07'),
(5, 'yuyuyuyu', 'uyuyuyu', '2024-10-19 11:04:49', '2024-10-19 11:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('request','accept','reject') COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `from_user_id`, `to_user_id`, `status`, `active`, `created_at`, `updated_at`) VALUES
(35, 1, 1, 'reject', '1', '2024-10-12 01:06:33', '2024-10-17 08:58:57'),
(36, 1, 1, 'request', '0', '2024-10-12 03:29:34', '2024-10-12 03:29:34'),
(37, 1, 1, 'request', '1', '2024-10-12 06:23:18', '2024-10-12 06:23:18'),
(40, 7, 18, 'request', '1', '2024-10-17 08:04:26', '2024-10-17 08:04:26'),
(41, 8, 18, 'accept', '0', '2024-10-17 08:04:46', '2024-10-17 08:04:46'),
(42, 6, 18, 'request', '1', '2024-10-17 08:17:32', '2024-10-17 08:17:32'),
(43, 56, 57, 'request', '1', '2024-10-19 11:06:05', '2024-10-19 11:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_04_072343_create_categories_table', 1),
(6, '2024_10_11_051716_create_posts_table', 1),
(7, '2024_10_11_052806_create_post_photos_table', 2),
(8, '2024_10_11_052818_create_post_videos_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(39, 2, 1, '1111', NULL, '2024-10-16 08:09:28', '2024-10-16 08:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `post_photos`
--

CREATE TABLE `post_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_upload` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_photos`
--

INSERT INTO `post_photos` (`id`, `post_id`, `file_upload`, `created_at`, `updated_at`) VALUES
(4, 35, 'uploads/35/35_5.jpg', '2024-10-12 01:06:33', '2024-10-12 01:06:33'),
(5, 35, 'uploads/35/35_1.jpg', '2024-10-12 01:06:33', '2024-10-12 01:06:33'),
(6, 36, 'uploads/36/36_5.jpg', '2024-10-12 03:29:34', '2024-10-12 03:29:34'),
(7, 36, 'uploads/36/36_6wmm5gm9gym_(1).jpeg', '2024-10-12 03:29:34', '2024-10-12 03:29:34'),
(8, 36, 'uploads/36/36_1.jpg', '2024-10-12 03:29:35', '2024-10-12 03:29:35'),
(9, 35, 'uploads/35/35_5.jpg', '2024-10-12 06:20:31', '2024-10-12 06:20:31'),
(10, 35, 'uploads/35/35_1.jpg', '2024-10-12 06:20:31', '2024-10-12 06:20:31'),
(11, 37, 'uploads/37/37_5.jpg', '2024-10-12 06:23:18', '2024-10-12 06:23:18'),
(12, 38, 'uploads/38/38_1.jpg', '2024-10-12 06:23:47', '2024-10-12 06:23:47'),
(13, 39, 'uploads/39/39_32_1.jpg', '2024-10-16 08:09:28', '2024-10-16 08:09:28'),
(14, 40, 'uploads/40/40_images.jpeg', '2024-10-17 11:35:54', '2024-10-17 11:35:54'),
(15, 40, 'uploads/40/40_images.jpeg', '2024-10-17 22:16:40', '2024-10-17 22:16:40'),
(16, 41, 'uploads/41/41_test.png', '2024-10-19 00:40:52', '2024-10-19 00:40:52'),
(17, 41, 'uploads/41/41_test.png', '2024-10-19 00:40:52', '2024-10-19 00:40:52'),
(18, 41, 'uploads/41/41_test.png', '2024-10-19 00:40:53', '2024-10-19 00:40:53'),
(19, 41, 'uploads/41/41_test.png', '2024-10-19 00:41:27', '2024-10-19 00:41:27'),
(20, 39, 'uploads/39/39_screenshot3.png', '2024-10-19 11:05:26', '2024-10-19 11:05:26'),
(21, 39, 'uploads/39/39_flowers-276014__340.jpg', '2024-10-19 11:05:27', '2024-10-19 11:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `post_videos`
--

CREATE TABLE `post_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_upload` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` bigint(20) UNSIGNED NOT NULL,
  `to_user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shares`
--

INSERT INTO `shares` (`id`, `from_user_id`, `to_user_id`, `post_id`, `status`, `created_at`, `updated_at`) VALUES
(9, 56, 57, 39, 'active', '2024-10-19 11:05:47', '2024-10-19 11:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('memer','admin','super') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(10) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `profile_picture`, `active`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@admin.com', '2024-10-14 11:21:45', '$2y$12$MIPRkxFmGzkewxJ4kt/Rf.MhfEafXz63iLZ/AQONsbusiv8aAnlK6', NULL, 'super', 'uploads/profile/2/2_test.png', 1, '2024-10-14 11:21:45', '2024-10-19 11:01:32'),
(34, 'hhfgfgh', 'ghgfg@gfgf.com', NULL, '$2y$12$qw7AIj2Nycl6SGOevN4Xd.KiXpMW7siWG5J6unKLSLhEo4G3W9uBK', NULL, 'memer', 'uploads/profile/34/34_images_(1).jpeg', 1, '2024-10-18 09:05:30', '2024-10-18 09:22:13'),
(56, 'gfgff', 'fgfgfg@gfgfg.com', NULL, '$2y$12$UxXqiaRS5ajpaq5R41RMNuLSSWXWIOb2n.YTT37un0bj5l1gSeRZi', NULL, 'memer', 'uploads/profile/56/56_test.png', 1, '2024-10-19 00:01:47', '2024-10-19 00:01:47'),
(57, 'fgfgf', 'fgfg@ffdfd.com', NULL, '$2y$12$2LwyuaQ1l7tz3v7gmOUQsukwVmU7Wrmnv15iTrFVljTPoUouRjBOu', NULL, 'memer', 'uploads/profile/57/57_test.png', 1, '2024-10-19 00:18:44', '2024-10-19 00:18:44'),
(58, 'fdfdfdf', 'fdff@ffdfd.com', NULL, '$2y$12$DzS6tSIen3s7y0DO3.bImOr8EQDBneXRNcdRaoKPi.EwaQHJywIG6', NULL, NULL, 'uploads/profile/58/58_test.png', 1, '2024-10-19 04:27:41', '2024-10-19 11:01:58'),
(59, 'fdfdfdf', 'fdff1@ffdfd.com', NULL, '$2y$12$w8VVeHFTvfyC5SelLvAEf.AsKEjF9AdR1YZpLJXTRTlL6S4.Ek9.O', NULL, NULL, 'uploads/profile/59/59_test.png', 1, '2024-10-19 04:30:20', '2024-10-19 11:03:58'),
(60, 'dgdfggd', 'abc@abc.com', NULL, '$2y$12$M8s3iyZDYdq8o8eAUqVtgO7mEwIywiA8SfukDuephEfUQuYiuICCi', NULL, NULL, NULL, 1, '2024-10-19 04:35:03', '2024-10-19 04:35:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`from_user_id`),
  ADD KEY `posts_category_id_foreign` (`to_user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `post_photos`
--
ALTER TABLE `post_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_videos`
--
ALTER TABLE `post_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `post_photos`
--
ALTER TABLE `post_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `post_videos`
--
ALTER TABLE `post_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
