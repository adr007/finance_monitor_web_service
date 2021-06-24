-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 24, 2021 at 02:35 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance_monitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `asset_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`asset_id`, `asset_name`, `asset_icon`, `asset_color`) VALUES
(1, 'Bank Savings', 'layers', 'lightBlue'),
(2, 'Cryptocurrency', 'lock_outline_sharp', 'amber'),
(3, 'Stock', 'business_center_sharp', 'teal'),
(4, 'Cash', 'attach_money', 'green');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_04_14_080031_create_assets_table', 1),
(6, '2021_04_14_080040_create_sub_assets_table', 1),
(7, '2021_04_14_080105_create_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(7, 'App\\Models\\User', 2, 'token', '5ae4a8524e0605bdf67dddff22d6a6a95c40f6e3c448cf9e14408ac737a6071e', '[\"*\"]', '2021-04-26 21:58:18', '2021-04-26 21:57:33', '2021-04-26 21:58:18'),
(8, 'App\\Models\\User', 1, 'token', '45d12cb389a306b476288f89af869c80e6e0d07a11507a38f3993c3e8ca88757', '[\"*\"]', '2021-06-22 20:00:45', '2021-06-22 17:59:12', '2021-06-22 20:00:45'),
(9, 'App\\Models\\User', 1, 'token', '8242773cae7de100cf7ba9b25425366d4679dfc6338392f8235f94bcac02285b', '[\"*\"]', '2021-06-23 18:18:58', '2021-06-23 16:35:02', '2021-06-23 18:18:58'),
(10, 'App\\Models\\User', 1, 'token', '1022802d39dff3eb5b4a3d629a3535b1a9194297ec1a39fbead687fcf8a5be1c', '[\"*\"]', '2021-06-23 17:49:51', '2021-06-23 17:47:50', '2021-06-23 17:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `sub_assets`
--

CREATE TABLE `sub_assets` (
  `sub_id` bigint(20) UNSIGNED NOT NULL,
  `sub_id_asset` bigint(20) UNSIGNED NOT NULL,
  `sub_id_user` bigint(20) UNSIGNED NOT NULL,
  `sub_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_vendor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_assets`
--

INSERT INTO `sub_assets` (`sub_id`, `sub_id_asset`, `sub_id_user`, `sub_name`, `sub_vendor`, `sub_value`, `created_at`, `updated_at`) VALUES
(12, 1, 1, 'Bank Saldo', 'BRI', 5162500, '2021-04-23 22:47:02', '2021-06-23 18:13:01'),
(13, 3, 1, 'BBNI', 'Ipot', 1155000, '2021-04-23 22:48:17', '2021-04-23 22:48:17'),
(14, 3, 1, 'INCO', 'Ipot', 1660000, '2021-04-23 22:48:47', '2021-04-23 22:48:47'),
(15, 3, 1, 'BBRI', 'Ipot', 2550000, '2021-04-23 22:49:33', '2021-04-23 22:49:33'),
(16, 2, 1, 'ADA', 'Indodax', 1725000, '2021-04-23 22:50:44', '2021-04-23 22:50:44'),
(17, 2, 1, 'DOGE', 'Indodax', 1134000, '2021-04-23 22:51:20', '2021-04-27 00:45:34'),
(18, 2, 1, 'XRP', 'Indodax', 1156000, '2021-04-23 22:51:47', '2021-04-23 22:51:47'),
(19, 2, 1, 'SafeMoon', 'Trust Wallet', 1632000, '2021-04-23 22:52:44', '2021-04-23 22:52:44'),
(20, 2, 1, 'BNB', 'Trust Wallet', 1269000, '2021-04-23 22:53:37', '2021-04-27 00:45:16'),
(21, 2, 1, 'SafeMars', 'Trust Wallet', 1014000, '2021-04-23 22:54:21', '2021-04-23 22:54:21'),
(22, 2, 1, 'Kangal', 'Trust Wallet', 547000, '2021-04-23 22:54:52', '2021-04-23 22:54:52'),
(23, 2, 1, 'FOX', 'Trust Wallet', 228000, '2021-04-23 22:55:13', '2021-04-23 22:55:13'),
(24, 2, 1, 'MoonRat', 'Trust Wallet', 9000, '2021-04-23 22:55:40', '2021-04-30 22:10:08'),
(25, 4, 1, 'Cash', 'Dompet', 550000, '2021-04-23 22:57:24', '2021-06-23 18:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` bigint(20) UNSIGNED NOT NULL,
  `trans_id_user` bigint(20) UNSIGNED NOT NULL,
  `trans_id_sub_asset` bigint(20) UNSIGNED NOT NULL,
  `trans_value` int(11) NOT NULL,
  `trans_status` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'UP/DOWN',
  `trans_information` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_date` date NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `trans_id_user`, `trans_id_sub_asset`, `trans_value`, `trans_status`, `trans_information`, `trans_date`, `created_time`, `updated_time`) VALUES
(1, 1, 12, 400000, 'DOWN', 'xxxx', '2021-05-01', '2021-04-30 22:09:11', '2021-04-30 22:09:11'),
(2, 1, 24, 80000, 'DOWN', 'yyym', '2021-05-01', '2021-04-30 22:10:08', '2021-04-30 22:10:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `user_tlp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `email_verified_at`, `user_tlp`, `user_photo`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Artono Dwi R', 'artono.dr@gmail.com', NULL, '082293422625', 'https://codexv.id/images/avatar/avatar_1615085057.jpeg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2021-04-14 09:03:15', '2021-04-14 09:03:23'),
(2, 'Resty Andrea', 'resty@gmail.com', NULL, '0822933454352', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2021-04-14 09:03:15', '2021-04-14 09:03:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sub_assets`
--
ALTER TABLE `sub_assets`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `sub_to_asset` (`sub_id_asset`),
  ADD KEY `sub_to_user` (`sub_id_user`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `trans_to_sub` (`trans_id_sub_asset`),
  ADD KEY `trans_to_user` (`trans_id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_user_email_unique` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `asset_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sub_assets`
--
ALTER TABLE `sub_assets`
  MODIFY `sub_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sub_assets`
--
ALTER TABLE `sub_assets`
  ADD CONSTRAINT `sub_to_asset` FOREIGN KEY (`sub_id_asset`) REFERENCES `assets` (`asset_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_to_user` FOREIGN KEY (`sub_id_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `trans_to_sub` FOREIGN KEY (`trans_id_sub_asset`) REFERENCES `sub_assets` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_to_user` FOREIGN KEY (`trans_id_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
