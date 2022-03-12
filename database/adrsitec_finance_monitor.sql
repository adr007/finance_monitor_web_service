-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 07, 2022 at 05:38 PM
-- Server version: 10.3.32-MariaDB-log-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adrsitec_finance_monitor`
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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(7, 'App\\Models\\User', 2, 'token', '5ae4a8524e0605bdf67dddff22d6a6a95c40f6e3c448cf9e14408ac737a6071e', '[\"*\"]', '2021-04-26 21:58:18', '2021-04-26 21:57:33', '2021-04-26 21:58:18'),
(20, 'App\\Models\\User', 5, 'token', '02a8aaaa76fac37e947e5714f2e0cf89fc2ee5d1a6250e9299bcd120491c018e', '[\"*\"]', '2021-06-24 01:21:42', '2021-06-24 01:20:18', '2021-06-24 01:21:42'),
(22, 'App\\Models\\User', 7, 'token', 'e13d0ebc7b35f057bf95aeb4cc14e133476ad97ea11b18f48d7aabe6ee949d74', '[\"*\"]', '2021-06-24 07:53:47', '2021-06-24 07:53:14', '2021-06-24 07:53:47'),
(55, 'App\\Models\\User', 1, 'token', '0addf06cbe02bb3ffcf09a0e533f12498affd76738fb289d95554ac3095815c5', '[\"*\"]', '2022-03-06 20:19:24', '2022-03-06 19:43:49', '2022-03-06 20:19:24');

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
(26, 1, 4, 'Bank Saldo', 'BRI', 1200000, '2021-06-24 00:56:05', '2021-06-24 00:56:05'),
(27, 1, 1, 'BRI Balance', 'BRI', 52508400, '2021-06-24 05:39:31', '2022-03-06 19:44:01'),
(28, 3, 1, 'BBNI', 'Ipot', 1500000, '2021-06-24 05:42:36', '2022-02-20 19:39:56'),
(29, 3, 1, 'BBRI', 'Ipot', 3100000, '2021-06-24 05:43:20', '2022-02-20 19:45:04'),
(30, 2, 1, 'DOGE', 'Indodax', 1690000, '2021-06-24 05:45:19', '2021-10-09 03:51:45'),
(31, 2, 1, 'XRP', 'Indodax', 1000000, '2021-06-24 05:45:43', '2021-10-09 03:52:12'),
(32, 2, 1, 'Zilliqa', 'Indodax', 933000, '2021-06-24 05:46:12', '2021-10-09 03:52:45'),
(33, 2, 1, 'SafeMoon', 'TrustWallet', 834000, '2021-06-24 05:46:46', '2021-06-24 05:47:36'),
(34, 2, 1, 'Kabosu', 'TrustWallet', 478000, '2021-06-24 05:47:19', '2021-06-24 05:47:19'),
(35, 2, 1, 'SafeMars', 'TrustWallet', 125000, '2021-06-24 05:48:00', '2021-06-24 05:48:00'),
(36, 2, 1, 'Kangal', 'TrustWallet', 127000, '2021-06-24 05:48:19', '2021-06-24 05:48:19'),
(37, 2, 1, 'BNB', 'TrustWallet', 200000, '2021-06-24 05:48:48', '2021-06-24 05:48:48'),
(38, 4, 1, 'Cash', 'Wallet', 5745000, '2021-06-24 05:52:14', '2022-03-06 20:19:23'),
(40, 3, 1, 'BUKA', 'Ipot', 260000, '2021-08-25 00:58:59', '2022-02-20 19:45:23'),
(41, 3, 1, 'EMTK', 'Ipot', 4300000, '2021-08-25 00:59:28', '2022-02-20 19:39:28'),
(42, 3, 1, 'ASSA', 'Ipot', 5300000, '2021-08-25 00:59:46', '2022-02-20 19:45:43'),
(43, 3, 1, 'FILM', 'Ipot', 42000, '2021-08-25 01:00:10', '2021-10-09 03:49:20'),
(44, 2, 1, 'ADA', 'Indodax', 1030000, '2021-09-28 22:07:26', '2021-10-09 03:51:56'),
(45, 2, 1, 'BNB', 'Indodax', 2250000, '2021-09-28 22:08:26', '2021-10-09 03:51:26'),
(47, 1, 1, 'JAGO Balance', 'JAGO', 96000, '2021-10-09 03:47:12', '2021-10-28 22:50:51'),
(48, 3, 1, 'ARTO', 'Ipot', 3100000, '2021-10-09 03:50:32', '2022-02-20 19:42:07'),
(49, 2, 1, 'ETH', 'Indodax', 166000, '2021-10-09 03:53:16', '2021-10-09 03:53:16'),
(50, 2, 1, 'BCD', 'Indodax', 1000000, '2021-10-20 17:45:03', '2021-10-20 17:45:03'),
(51, 3, 1, 'Reksadana', 'Bibit', 7000000, '2021-12-06 07:13:32', '2021-12-06 07:14:16'),
(52, 3, 1, 'UNVR', 'Ipot', 1900000, '2021-12-29 21:15:26', '2022-02-20 19:44:29'),
(53, 3, 1, 'CMRY', 'Ipot', 750000, '2021-12-29 21:15:58', '2022-02-20 19:42:52'),
(54, 3, 1, 'Saham US : Apple, StarBucks', 'GoTrade', 500000, '2022-01-11 03:37:02', '2022-01-11 03:37:47'),
(55, 2, 1, 'Matic', 'Indodax', 1500000, '2022-01-14 23:39:38', '2022-01-14 23:40:24'),
(56, 3, 1, 'ADRO', 'Ipot', 2200000, '2022-01-18 00:30:20', '2022-01-18 00:30:55'),
(57, 3, 1, 'NETV', 'Ipot', 3320000, '2022-02-20 19:38:58', '2022-02-20 19:38:58'),
(58, 3, 1, 'BBYB', 'Ipot', 2400000, '2022-02-20 19:40:40', '2022-02-20 19:40:40'),
(59, 4, 8, 'Uang Kass', 'Cafe ANT', 105000, '2022-02-21 04:04:14', '2022-03-04 21:33:54');

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
(9, 1, 38, 50000, 'DOWN', 'Makan Grill ala ala', '2021-06-25', '2021-06-25 20:50:41', '2021-06-25 20:50:41'),
(11, 1, 38, 9000, 'UP', 'Uang dari kantong', '2021-06-27', '2021-06-26 18:35:55', '2021-06-26 18:35:55'),
(12, 1, 38, 45000, 'DOWN', 'Ongkir Pos', '2021-06-28', '2021-06-27 22:01:31', '2021-06-27 22:01:31'),
(13, 1, 38, 20000, 'DOWN', 'Nasi ikan', '2021-06-28', '2021-06-27 22:01:53', '2021-06-27 22:01:53'),
(14, 1, 38, 20000, 'DOWN', 'Bensin', '2021-06-28', '2021-06-28 01:59:04', '2021-06-28 01:59:04'),
(15, 1, 27, 51500, 'DOWN', 'Pulsa', '2021-06-29', '2021-06-28 18:37:18', '2021-06-28 18:37:18'),
(16, 1, 38, 25000, 'DOWN', 'Bakso & Es Teller', '2021-06-29', '2021-06-29 03:20:11', '2021-06-29 03:20:11'),
(17, 1, 38, 10000, 'DOWN', 'Minuman', '2021-06-29', '2021-06-29 03:20:26', '2021-06-29 03:20:26'),
(18, 1, 27, 200000, 'DOWN', 'Kirim Fahri', '2021-06-29', '2021-06-29 08:44:00', '2021-06-29 08:44:00'),
(19, 1, 38, 200000, 'UP', 'Fahri ganti cash', '2021-06-29', '2021-06-29 08:44:26', '2021-06-29 08:44:26'),
(20, 1, 38, 20000, 'DOWN', 'Makan Siang', '2021-06-30', '2021-06-30 03:22:10', '2021-06-30 03:22:10'),
(21, 1, 38, 8000, 'DOWN', 'GoodDay', '2021-06-30', '2021-06-30 03:22:27', '2021-06-30 03:22:27'),
(22, 1, 38, 20000, 'DOWN', 'Bensin', '2021-06-30', '2021-06-30 03:22:37', '2021-06-30 03:22:37'),
(23, 1, 38, 20000, 'DOWN', 'Makan siang', '2021-07-01', '2021-07-01 04:17:25', '2021-07-01 04:17:25'),
(25, 1, 38, 20000, 'DOWN', 'Makan Siang', '2021-07-02', '2021-07-01 23:53:52', '2021-07-01 23:53:52'),
(26, 1, 38, 18000, 'DOWN', 'Minuman', '2021-07-02', '2021-07-01 23:54:04', '2021-07-01 23:54:04'),
(27, 1, 38, 5000, 'DOWN', 'Sikat Gigi', '2021-07-02', '2021-07-02 04:48:37', '2021-07-02 04:48:37'),
(28, 1, 38, 41000, 'DOWN', 'Kopi dan Snack', '2021-07-03', '2021-07-02 22:12:16', '2021-07-02 22:12:16'),
(29, 1, 27, 2000000, 'UP', 'Termin 2 HSPK Konut', '2021-07-03', '2021-07-03 05:45:21', '2021-07-03 05:45:21'),
(30, 1, 38, 33000, 'DOWN', 'Makanan kucing', '2021-07-03', '2021-07-03 05:45:38', '2021-07-03 05:45:38'),
(31, 1, 38, 24000, 'DOWN', 'Kecap dan Telur', '2021-07-03', '2021-07-03 05:45:51', '2021-07-03 05:45:51'),
(32, 1, 27, 100000, 'DOWN', 'Sedakah kita bisa', '2021-07-04', '2021-07-03 18:49:45', '2021-07-03 18:49:45'),
(33, 1, 27, 1500000, 'DOWN', 'Kasi Mace', '2021-07-04', '2021-07-03 18:51:31', '2021-07-03 18:51:31'),
(34, 1, 27, 101500, 'DOWN', 'Pulsa', '2021-07-04', '2021-07-03 18:52:44', '2021-07-03 18:52:44'),
(35, 1, 38, 69000, 'DOWN', 'Foya foya alfamidi', '2021-07-04', '2021-07-04 06:31:15', '2021-07-04 06:31:15'),
(36, 1, 27, 84000, 'DOWN', 'Bayar briva hafid', '2021-07-05', '2021-07-05 01:43:47', '2021-07-05 01:43:47'),
(37, 1, 38, 10000, 'DOWN', 'Bensin', '2021-07-05', '2021-07-05 01:43:57', '2021-07-05 01:43:57'),
(38, 1, 38, 84000, 'UP', 'Hafid Bayar brivanya', '2021-07-05', '2021-07-05 03:14:10', '2021-07-05 03:14:10'),
(39, 1, 38, 16000, 'DOWN', 'NORMALISASI', '2021-07-05', '2021-07-05 03:22:01', '2021-07-05 03:22:01'),
(41, 1, 38, 50000, 'DOWN', 'Makan Ikan Bakar', '2021-07-05', '2021-07-05 18:13:37', '2021-07-05 18:13:37'),
(42, 1, 27, 800000, 'DOWN', 'Kirim ke mace', '2021-07-07', '2021-07-06 21:44:14', '2021-07-06 21:44:14'),
(43, 1, 38, 10000, 'DOWN', 'Bensin', '2021-07-07', '2021-07-07 04:52:36', '2021-07-07 04:52:36'),
(44, 1, 27, 4950000, 'UP', 'Gaji', '2021-07-08', '2021-07-08 04:58:58', '2021-07-08 04:58:58'),
(45, 1, 27, 1500000, 'UP', 'Uang Bayar kos joe', '2021-07-08', '2021-07-08 04:59:37', '2021-07-08 04:59:37'),
(46, 1, 27, 300000, 'DOWN', 'Tarik', '2021-07-08', '2021-07-08 04:59:52', '2021-07-08 04:59:52'),
(47, 1, 38, 300000, 'UP', 'Tarik doi', '2021-07-08', '2021-07-08 05:00:17', '2021-07-08 05:00:17'),
(48, 1, 38, 95000, 'DOWN', 'Foya2 Alfamidi', '2021-07-08', '2021-07-08 05:00:36', '2021-07-08 05:00:36'),
(49, 1, 27, 500000, 'UP', 'Maulid bayar utang', '2021-07-09', '2021-07-09 04:26:59', '2021-07-09 04:26:59'),
(50, 1, 38, 20000, 'DOWN', 'Nasi padang', '2021-07-09', '2021-07-09 04:27:16', '2021-07-09 04:27:16'),
(51, 1, 38, 20000, 'DOWN', 'Bensin', '2021-07-09', '2021-07-09 04:27:27', '2021-07-09 04:27:27'),
(52, 1, 38, 45000, 'DOWN', 'Ganti Oli', '2021-07-10', '2021-07-09 22:35:08', '2021-07-09 22:35:08'),
(53, 1, 38, 2500, 'DOWN', 'Foto Copy', '2021-07-10', '2021-07-09 22:35:25', '2021-07-09 22:35:25'),
(54, 1, 38, 5000, 'DOWN', 'Bantu beli sayur', '2021-07-10', '2021-07-09 22:35:57', '2021-07-09 22:35:57'),
(55, 1, 27, 250000, 'DOWN', 'Dipinjam Maulid', '2021-07-11', '2021-07-10 21:06:43', '2021-07-10 21:06:43'),
(56, 1, 38, 60000, 'DOWN', 'Foya foya grill', '2021-07-10', '2021-07-10 21:07:02', '2021-07-10 21:07:02'),
(57, 1, 27, 100000, 'DOWN', 'Beli Pulsa', '2021-07-12', '2021-07-11 15:17:51', '2021-07-11 15:17:51'),
(58, 1, 27, 3000000, 'DOWN', 'Bayar kos', '2021-07-12', '2021-07-12 04:22:08', '2021-07-12 04:22:08'),
(59, 1, 27, 1500000, 'DOWN', 'Bayar kos dari Joe', '2021-07-12', '2021-07-12 04:22:27', '2021-07-12 04:22:27'),
(60, 1, 27, 6500, 'DOWN', 'Biaya Admin', '2021-07-12', '2021-07-12 04:22:37', '2021-07-12 04:22:37'),
(61, 1, 38, 100000, 'UP', 'Dari pak ass 3', '2021-07-12', '2021-07-12 04:57:19', '2021-07-12 04:57:19'),
(62, 1, 38, 58000, 'DOWN', 'Beli sabun dan gooday', '2021-07-12', '2021-07-12 04:57:42', '2021-07-12 04:57:42'),
(63, 1, 27, 245000, 'UP', 'Dari pak dadang', '2021-07-15', '2021-07-15 02:53:29', '2021-07-15 02:53:29'),
(64, 1, 27, 180200, 'DOWN', 'Sepatu', '2021-07-15', '2021-07-15 02:54:02', '2021-07-15 02:54:02'),
(65, 1, 27, 495000, 'DOWN', 'Kabel type C, Power bank, kepala charger', '2021-07-15', '2021-07-15 02:54:53', '2021-07-15 02:54:53'),
(66, 1, 27, 142000, 'DOWN', 'Kaos ThreeSecond', '2021-07-15', '2021-07-15 02:55:29', '2021-07-15 02:55:29'),
(67, 1, 38, 50000, 'DOWN', 'Sepatu murah', '2021-07-15', '2021-07-15 02:55:41', '2021-07-15 02:55:41'),
(68, 1, 27, 193800, 'DOWN', 'Bayar Listrik', '2021-07-15', '2021-07-15 05:14:21', '2021-07-15 05:14:21'),
(69, 1, 27, 613500, 'DOWN', 'Sepatu dan topi hype biss', '2021-07-17', '2021-07-18 20:06:31', '2021-07-18 20:06:31'),
(70, 1, 27, 213750, 'DOWN', 'Baju dan celana dalam 3 second', '2021-07-17', '2021-07-18 20:07:10', '2021-07-18 20:07:10'),
(71, 1, 27, 173000, 'DOWN', 'Brownis Amanda', '2021-07-17', '2021-07-18 20:07:37', '2021-07-18 20:07:37'),
(72, 1, 27, 800000, 'DOWN', 'Kasi mace', '2021-07-19', '2021-07-18 20:10:09', '2021-07-18 20:10:09'),
(73, 1, 38, 250000, 'UP', 'Maulid bayar pinjaman', '2021-07-19', '2021-07-18 22:21:45', '2021-07-18 22:21:45'),
(74, 1, 38, 50000, 'DOWN', 'Bakar Ayam Malam', '2021-07-20', '2021-07-19 20:34:14', '2021-07-19 20:34:14'),
(75, 1, 38, 113000, 'DOWN', 'Foya foya alfamidi', '2021-07-21', '2021-07-19 20:34:45', '2021-07-19 20:34:45'),
(77, 1, 38, 1200000, 'UP', 'Uang Saku dari Pak Ass 3', '2021-07-18', '2021-07-19 20:37:38', '2021-07-19 20:37:38'),
(78, 1, 27, 3700000, 'UP', 'Pindahkan Saldo', '2021-07-21', '2021-07-20 22:05:19', '2021-07-20 22:05:19'),
(79, 1, 38, 26000, 'DOWN', 'Beli Materai', '2021-07-21', '2021-07-20 22:06:26', '2021-07-20 22:06:26'),
(80, 1, 38, 20000, 'DOWN', 'Beli bensin', '2021-07-21', '2021-07-20 22:06:43', '2021-07-20 22:06:43'),
(81, 1, 27, 500000, 'DOWN', 'Dipinjam Hafid', '2021-07-21', '2021-07-21 04:58:39', '2021-07-21 04:58:39'),
(82, 1, 27, 6500, 'DOWN', 'Biaya admin', '2021-07-21', '2021-07-21 04:58:51', '2021-07-21 04:58:51'),
(83, 1, 27, 500000, 'UP', 'Hafid bayar pinjaman', '2021-07-23', '2021-07-23 19:04:13', '2021-07-23 19:04:13'),
(84, 1, 27, 21000, 'DOWN', 'Belikan mace pulsa', '2021-07-24', '2021-07-23 19:04:36', '2021-07-23 19:04:36'),
(85, 1, 38, 20000, 'DOWN', 'Makan siang', '2021-07-23', '2021-07-23 19:04:48', '2021-07-23 19:04:48'),
(86, 1, 38, 8000, 'DOWN', 'Beli kopi', '2021-07-23', '2021-07-23 19:05:01', '2021-07-23 19:05:01'),
(87, 1, 38, 33000, 'DOWN', 'Beli galon, herocin, gooday', '2021-07-23', '2021-07-23 19:05:50', '2021-07-23 19:05:50'),
(88, 1, 38, 250000, 'DOWN', 'Join Coffe Corner', '2021-07-24', '2021-07-25 03:04:49', '2021-07-25 03:04:49'),
(89, 1, 27, 750000, 'DOWN', 'Kasi mace lewat ayu', '2021-07-25', '2021-07-25 03:05:15', '2021-07-25 03:05:15'),
(90, 1, 38, 20000, 'DOWN', 'Water dan lemon water', '2021-07-25', '2021-07-25 03:06:11', '2021-07-25 03:06:11'),
(91, 1, 27, 250000, 'UP', 'Fee direktur Carbon Circle', '2021-07-30', '2021-07-30 02:41:31', '2021-07-30 02:41:31'),
(92, 1, 27, 50000, 'DOWN', 'Sedekah kita bisa', '2021-07-30', '2021-07-30 02:41:53', '2021-07-30 02:41:53'),
(93, 1, 27, 101500, 'DOWN', 'Beli Pulsa', '2021-08-05', '2021-08-05 04:04:48', '2021-08-05 04:04:48'),
(94, 1, 27, 1500000, 'DOWN', 'Kasi Mace', '2021-08-09', '2021-08-09 01:37:57', '2021-08-09 01:37:57'),
(95, 1, 27, 151500, 'DOWN', 'Beli Pulsa', '2021-08-10', '2021-08-10 00:28:07', '2021-08-10 00:28:07'),
(96, 1, 27, 4950000, 'UP', 'Gaji Bulan Juli', '2021-08-10', '2021-08-10 03:30:39', '2021-08-10 03:30:39'),
(97, 1, 27, 200000, 'DOWN', 'Tarik', '2021-08-10', '2021-08-10 03:31:00', '2021-08-10 03:31:00'),
(98, 1, 27, 1000000, 'UP', 'Uang Kaget dari Pak Kaban', '2021-08-07', '2021-08-10 03:33:17', '2021-08-10 03:33:17'),
(99, 1, 27, 850000, 'DOWN', 'Beli Kursi', '2021-08-07', '2021-08-10 03:33:42', '2021-08-10 03:33:42'),
(100, 1, 27, 50000, 'DOWN', 'Sedekah Jumat', '2021-08-13', '2021-08-13 02:19:23', '2021-08-13 02:19:23'),
(101, 1, 27, 1000000, 'UP', 'Pim TPP Konut', '2021-08-15', '2021-08-14 20:23:00', '2021-08-14 20:23:00'),
(102, 1, 27, 500000, 'DOWN', 'Tarik', '2021-08-15', '2021-08-14 22:24:11', '2021-08-14 22:24:11'),
(103, 1, 38, 1000000, 'DOWN', 'NORMALISASI', '2021-08-15', '2021-08-14 22:24:49', '2021-08-14 22:24:49'),
(104, 1, 38, 500000, 'UP', 'Tarik Dari BRI', '2021-08-15', '2021-08-14 22:25:23', '2021-08-14 22:25:23'),
(105, 1, 38, 120000, 'DOWN', 'Foya Foya Alfamidi dan Makan siang', '2021-08-15', '2021-08-14 22:25:57', '2021-08-14 22:25:57'),
(106, 1, 27, 246000, 'DOWN', 'Bayar Listrik', '2021-08-15', '2021-08-14 23:54:52', '2021-08-14 23:54:52'),
(107, 1, 38, 246000, 'UP', 'Ganti Uang Bayar Listrik', '2021-08-15', '2021-08-14 23:55:10', '2021-08-14 23:55:10'),
(108, 1, 27, 754000, 'DOWN', 'Beli Ovomass', '2021-08-17', '2021-08-16 20:42:10', '2021-08-16 20:42:10'),
(109, 1, 27, 51000, 'DOWN', 'Beli Office 365', '2021-08-17', '2021-08-16 21:57:21', '2021-08-16 21:57:21'),
(110, 1, 27, 1500000, 'DOWN', 'Top Up RDN Ipot', '2021-08-19', '2021-08-18 23:48:03', '2021-08-18 23:48:03'),
(111, 1, 27, 1300000, 'UP', 'Uang Lembur', '2021-08-19', '2021-08-19 05:02:40', '2021-08-19 05:02:40'),
(112, 1, 27, 51000, 'DOWN', 'Beli Pulsa Pace', '2021-08-19', '2021-08-19 05:03:05', '2021-08-19 05:03:05'),
(113, 1, 27, 350000, 'DOWN', 'Perbaiki motor supra', '2021-08-23', '2021-08-23 04:21:56', '2021-08-23 04:21:56'),
(114, 1, 27, 3250000, 'UP', 'Uang Lembur', '2021-08-25', '2021-08-25 00:53:05', '2021-08-25 00:53:05'),
(115, 1, 27, 800000, 'DOWN', 'Tarik', '2021-08-25', '2021-08-26 05:58:44', '2021-08-26 05:58:44'),
(117, 1, 27, 2000000, 'DOWN', 'Kasi mace', '2021-08-31', '2021-08-31 02:30:35', '2021-08-31 02:30:35'),
(118, 1, 27, 100000, 'DOWN', 'Kumpul Basket Morowali', '2021-08-31', '2021-08-31 02:30:49', '2021-08-31 02:30:49'),
(119, 1, 27, 500000, 'DOWN', 'Tarik', '2021-09-04', '2021-09-03 19:02:18', '2021-09-03 19:02:18'),
(121, 1, 27, 100000, 'UP', 'Maulid bayar Evomass', '2021-09-04', '2021-09-03 21:49:40', '2021-09-03 21:49:40'),
(122, 1, 27, 300000, 'DOWN', 'Tarik', '2021-09-06', '2021-09-08 04:45:47', '2021-09-08 04:45:47'),
(123, 1, 27, 3000000, 'UP', 'Dp Sultra Pro Strategis', '2021-09-09', '2021-09-08 16:25:19', '2021-09-08 16:25:19'),
(124, 1, 27, 4950000, 'UP', 'Gaji', '2021-09-09', '2021-09-09 03:27:10', '2021-09-09 03:27:10'),
(125, 1, 27, 100000, 'DOWN', 'Beli Pulsa', '2021-09-09', '2021-09-09 03:27:25', '2021-09-09 03:27:25'),
(126, 1, 27, 180000, 'DOWN', 'Beli celana dan baju 3', '2021-09-10', '2021-09-10 06:12:26', '2021-09-10 06:12:26'),
(127, 1, 27, 320000, 'DOWN', 'Tarik', '2021-09-10', '2021-09-10 06:13:08', '2021-09-10 06:13:08'),
(128, 1, 38, 240000, 'DOWN', 'Normalisasi', '2021-09-10', '2021-09-10 06:14:50', '2021-09-10 06:14:50'),
(129, 1, 27, 8200000, 'UP', 'Sisa Income', '2021-09-29', '2021-09-28 22:19:06', '2021-09-28 22:19:06'),
(131, 1, 27, 204000, 'DOWN', 'Bayar Listrik', '2021-10-12', '2021-10-12 03:22:20', '2021-10-12 03:22:20'),
(132, 1, 27, 745000, 'DOWN', 'Sepatu Basket', '2021-10-14', '2021-10-13 18:17:45', '2021-10-13 18:17:45'),
(133, 1, 27, 183000, 'DOWN', 'Bola dan Pompa', '2021-10-14', '2021-10-13 18:18:06', '2021-10-13 18:18:06'),
(134, 1, 27, 310000, 'DOWN', 'Bayar Wifi Pak iksan', '2021-10-14', '2021-10-14 07:11:46', '2021-10-14 07:11:46'),
(135, 1, 38, 60000, 'UP', 'Normalisasi', '2021-10-14', '2021-10-14 07:12:30', '2021-10-14 07:12:30'),
(136, 1, 27, 2350000, 'UP', 'SPPD dari pak Sahlan', '2021-10-15', '2021-10-15 03:47:42', '2021-10-15 03:47:42'),
(137, 1, 47, 200000, 'DOWN', 'Kasi wa ayu', '2021-10-16', '2021-10-16 04:54:04', '2021-10-16 04:54:04'),
(138, 1, 27, 500000, 'DOWN', 'Tarik', '2021-10-26', '2021-10-25 22:05:06', '2021-10-25 22:05:06'),
(140, 1, 47, 4000, 'DOWN', 'Fee atm', '2021-10-25', '2021-10-25 22:39:50', '2021-10-25 22:39:50'),
(141, 1, 27, 2000000, 'DOWN', 'Kasi Mace', '2021-10-29', '2021-10-28 22:47:39', '2021-10-28 22:47:39'),
(142, 1, 47, 200000, 'DOWN', 'Dipinjam Fahri', '2021-10-29', '2021-10-28 22:47:58', '2021-10-28 22:47:58'),
(143, 1, 47, 500000, 'DOWN', 'Pindah ke BRI', '2021-10-29', '2021-10-28 22:50:51', '2021-10-28 22:50:51'),
(144, 1, 27, 500000, 'UP', 'Saldo dari JAGO', '2021-10-29', '2021-10-28 22:51:06', '2021-10-28 22:51:06'),
(145, 1, 27, 5000000, 'UP', 'Project Absensi', '2021-11-06', '2021-11-07 08:16:15', '2021-11-07 08:16:15'),
(146, 1, 27, 609000, 'DOWN', 'Beli Celana', '2021-11-07', '2021-11-07 08:16:44', '2021-11-07 08:16:44'),
(147, 1, 27, 600000, 'DOWN', 'Kasi Mace', '2021-11-07', '2021-11-07 08:16:53', '2021-11-07 08:16:53'),
(148, 1, 27, 1000000, 'DOWN', 'Dipinjam Pak Iksan', '2021-11-05', '2021-11-07 08:18:43', '2021-11-07 08:18:43'),
(149, 1, 27, 18900000, 'UP', 'BMD 4.0 Morowali', '2021-11-08', '2021-11-09 05:40:15', '2021-11-09 05:40:15'),
(150, 1, 27, 1500000, 'DOWN', 'Kasi Mace', '2021-11-09', '2021-11-09 05:40:34', '2021-11-09 05:40:34'),
(151, 1, 27, 1250000, 'DOWN', 'Tarik', '2021-11-09', '2021-11-09 05:40:49', '2021-11-09 05:40:49'),
(152, 1, 27, 100000, 'DOWN', 'Kita bisa', '2021-11-09', '2021-11-09 05:41:23', '2021-11-09 05:41:23'),
(153, 1, 27, 172000, 'DOWN', 'Normalisasi', '2021-11-09', '2021-11-09 05:44:04', '2021-11-09 05:44:04'),
(154, 1, 27, 4500000, 'UP', 'Termin 2 E-Pengendalian', '2021-11-10', '2021-11-11 04:32:42', '2021-11-11 04:32:42'),
(155, 1, 27, 235000, 'DOWN', 'Beli Evomass', '2021-11-11', '2021-11-11 04:33:43', '2021-11-11 04:33:43'),
(156, 1, 27, 4880000, 'DOWN', 'Beli Hp', '2021-11-13', '2021-11-13 00:51:14', '2021-11-13 00:51:14'),
(157, 1, 27, 4200000, 'UP', 'Gaji', '2021-11-15', '2021-11-15 22:04:14', '2021-11-15 22:04:14'),
(158, 1, 27, 214000, 'DOWN', 'Bayar Listrik', '2021-11-18', '2021-11-18 03:05:40', '2021-11-18 03:05:40'),
(159, 1, 27, 2340000, 'DOWN', 'Beli Smart Watch dan Tws', '2021-11-22', '2021-11-21 23:26:49', '2021-11-21 23:26:49'),
(160, 1, 27, 916000, 'DOWN', 'Beli protein Performance', '2021-11-27', '2021-11-27 01:40:07', '2021-11-27 01:40:07'),
(161, 1, 27, 600000, 'DOWN', 'Beli Diamond', '2021-11-27', '2021-11-27 07:10:35', '2021-11-27 07:10:35'),
(162, 1, 27, 400000, 'DOWN', 'Pajak motor honda', '2021-11-29', '2021-11-30 04:01:55', '2021-11-30 04:01:55'),
(163, 1, 27, 4500000, 'UP', 'Gaji', '2021-12-06', '2021-12-06 07:11:09', '2021-12-06 07:11:09'),
(164, 1, 27, 7000000, 'DOWN', 'Beli Reksadana', '2021-12-06', '2021-12-06 07:11:37', '2021-12-06 07:11:37'),
(165, 1, 51, 7000000, 'UP', 'Invest Reksadana', '2021-12-06', '2021-12-06 07:14:16', '2021-12-06 07:14:16'),
(166, 1, 27, 3000000, 'UP', 'Termin 3 E-Pengendalian', '2021-12-09', '2021-12-08 23:02:36', '2021-12-08 23:02:36'),
(167, 1, 27, 5300000, 'DOWN', 'Normalisasi', '2021-12-09', '2021-12-08 23:03:14', '2021-12-08 23:03:14'),
(168, 1, 27, 100000, 'DOWN', 'Kitabisa', '2021-12-10', '2021-12-10 03:18:14', '2021-12-10 03:18:14'),
(169, 1, 27, 20000000, 'UP', 'Persuratan Bungku Tengah', '2021-12-10', '2021-12-10 03:20:53', '2021-12-10 03:20:53'),
(170, 1, 38, 110500, 'DOWN', 'Normalisasi', '2021-12-10', '2021-12-10 03:25:46', '2021-12-10 03:25:46'),
(171, 1, 27, 3000000, 'UP', 'PIM bu desi', '2021-12-11', '2021-12-11 21:50:55', '2021-12-11 21:50:55'),
(172, 1, 27, 1000000, 'DOWN', 'Kasi Mace', '2021-12-11', '2021-12-11 21:51:25', '2021-12-11 21:51:25'),
(173, 1, 27, 300000, 'DOWN', 'Kasi Ayu', '2021-12-27', '2021-12-27 16:21:43', '2021-12-27 16:21:43'),
(174, 1, 27, 300000, 'DOWN', 'Kasi Bapa Tua', '2021-12-27', '2021-12-27 16:22:06', '2021-12-27 16:22:06'),
(175, 1, 27, 105000, 'DOWN', 'Makan Txs', '2021-12-26', '2021-12-27 16:22:43', '2021-12-27 16:22:43'),
(176, 1, 27, 200000, 'DOWN', 'Spiderman', '2021-12-26', '2021-12-27 16:23:44', '2021-12-27 16:23:44'),
(177, 1, 27, 5150000, 'UP', 'Gaji V2', '2021-12-24', '2021-12-27 16:25:05', '2021-12-27 16:25:05'),
(178, 1, 27, 7000000, 'DOWN', 'Pindah ke RDN Ipot', '2021-12-17', '2021-12-27 16:25:48', '2021-12-27 16:25:48'),
(179, 1, 27, 500000, 'DOWN', 'Bakar Ayam & Ikan', '2021-12-29', '2021-12-29 21:17:03', '2021-12-29 21:17:03'),
(180, 1, 27, 100000, 'DOWN', 'Pulsa Listrik Rull', '2021-12-29', '2021-12-29 21:18:22', '2021-12-29 21:18:22'),
(182, 1, 27, 500000, 'DOWN', 'Transport KDI Morowali (pp)', '2022-01-01', '2022-01-05 03:57:57', '2022-01-05 03:57:57'),
(183, 1, 27, 1026000, 'DOWN', 'Eiger : Jam, Topi x 2, Pisau', '2022-01-03', '2022-01-05 04:09:28', '2022-01-05 04:09:28'),
(184, 1, 27, 480000, 'DOWN', 'Oleh2: Brownte', '2022-01-05', '2022-01-05 04:10:09', '2022-01-05 04:10:09'),
(185, 1, 27, 1500000, 'DOWN', 'Kasi Mace', '2022-01-01', '2022-01-05 04:12:43', '2022-01-05 04:12:43'),
(186, 1, 27, 75000, 'DOWN', 'Ganti Oli', '2022-01-04', '2022-01-05 04:14:00', '2022-01-05 04:14:00'),
(187, 1, 27, 50000, 'DOWN', 'Kirim Paket', '2022-01-04', '2022-01-05 04:14:31', '2022-01-05 04:14:31'),
(188, 1, 27, 1000000, 'UP', 'Fee Direktur', '2022-01-03', '2022-01-08 06:51:10', '2022-01-08 06:51:10'),
(189, 1, 27, 500000, 'DOWN', 'Isi Saldo go Trade', '2022-01-08', '2022-01-08 06:52:10', '2022-01-08 06:52:10'),
(190, 1, 27, 1028000, 'DOWN', 'Jaket, Celana, Baju Dimzy Store', '2022-01-08', '2022-01-08 07:22:29', '2022-01-08 07:22:29'),
(191, 1, 27, 2000000, 'DOWN', 'Kasi Mace', '2022-01-11', '2022-01-11 03:34:28', '2022-01-11 03:34:28'),
(192, 1, 27, 500000, 'UP', 'Dari project Fahri', '2022-01-11', '2022-01-11 03:34:45', '2022-01-11 03:34:45'),
(193, 1, 27, 4100000, 'DOWN', 'Normalisasi :v', '2022-01-11', '2022-01-11 03:39:46', '2022-01-11 03:39:46'),
(194, 1, 27, 210000, 'DOWN', 'Ganti Oli, Kampas Rem, Busi', '2022-01-15', '2022-01-14 23:37:18', '2022-01-14 23:37:18'),
(195, 1, 27, 20000000, 'UP', 'Web Bungku Tengah V2', '2022-01-15', '2022-01-14 23:37:44', '2022-01-14 23:37:44'),
(196, 1, 27, 1500000, 'DOWN', 'Bali Token Matic', '2022-01-15', '2022-01-14 23:39:10', '2022-01-14 23:39:10'),
(197, 1, 55, 1500000, 'UP', 'Beli Token Matic', '2022-01-15', '2022-01-14 23:40:24', '2022-01-14 23:40:24'),
(198, 1, 27, 100000, 'DOWN', 'Stater tangan motor', '2022-01-15', '2022-01-15 04:51:56', '2022-01-15 04:51:56'),
(200, 1, 27, 9600000, 'UP', 'Web Bungku Tengah V2.2', '2022-01-16', '2022-01-15 18:12:16', '2022-01-15 18:12:16'),
(201, 1, 38, 9000000, 'UP', 'Web Bungku Tengah V2.3', '2022-01-16', '2022-01-15 19:02:35', '2022-01-15 19:02:35'),
(202, 1, 27, 1500000, 'DOWN', 'Kasi Mace', '2022-01-16', '2022-01-15 19:07:43', '2022-01-15 19:07:43'),
(203, 1, 38, 310000, 'DOWN', 'Grill GG', '2022-01-15', '2022-01-16 21:11:26', '2022-01-16 21:11:26'),
(204, 1, 56, 2200000, 'UP', 'First Buy ADRO', '2022-01-18', '2022-01-18 00:30:55', '2022-01-18 00:30:55'),
(205, 1, 38, 1500000, 'DOWN', 'Beli Evolen', '2022-01-19', '2022-01-20 03:10:15', '2022-01-20 03:10:15'),
(206, 1, 27, 850000, 'UP', 'Fahri bayar Evomass', '2022-01-20', '2022-01-20 03:12:22', '2022-01-20 03:12:22'),
(207, 1, 38, 500000, 'DOWN', 'Beli Celana', '2022-01-16', '2022-01-20 03:14:40', '2022-01-20 03:14:40'),
(208, 1, 38, 100000, 'DOWN', 'Beli Roti di palu', '2022-01-19', '2022-01-20 03:15:31', '2022-01-20 03:15:31'),
(209, 1, 38, 1100000, 'UP', 'Normalisasi', '2022-01-20', '2022-01-20 07:37:16', '2022-01-20 07:37:16'),
(210, 1, 27, 117000, 'DOWN', 'Beli Rak sepatu', '2022-01-23', '2022-01-23 04:01:59', '2022-01-23 04:01:59'),
(211, 1, 27, 369000, 'DOWN', 'Beli Bedak', '2022-01-24', '2022-01-24 06:40:28', '2022-01-24 06:40:28'),
(212, 1, 38, 415000, 'DOWN', 'Makan2 Ikan Bakar', '2022-01-24', '2022-01-24 06:41:36', '2022-01-24 06:41:36'),
(213, 1, 27, 100000, 'DOWN', 'Beli Pulsa', '2022-01-25', '2022-01-24 16:39:26', '2022-01-24 16:39:26'),
(214, 1, 38, 126000, 'DOWN', 'Foya2 Alfamidix', '2022-01-26', '2022-01-27 07:16:42', '2022-01-27 07:16:42'),
(215, 1, 27, 150000, 'DOWN', 'Paket Mace', '2022-01-30', '2022-01-29 18:00:47', '2022-01-29 18:00:47'),
(216, 1, 27, 2000000, 'DOWN', 'Kasi Pace', '2022-01-31', '2022-01-31 05:49:40', '2022-01-31 05:49:40'),
(217, 1, 38, 150000, 'DOWN', 'Beli Sepatu', '2022-02-02', '2022-02-04 22:30:57', '2022-02-04 22:30:57'),
(218, 1, 38, 70000, 'DOWN', 'Foya foya Alfamidix', '2022-02-03', '2022-02-04 22:31:28', '2022-02-04 22:31:28'),
(219, 1, 27, 238600, 'DOWN', 'Beli RC Car', '2022-02-06', '2022-02-06 04:54:21', '2022-02-06 04:54:21'),
(220, 1, 27, 3685000, 'DOWN', 'Beli HP Idil', '2022-02-06', '2022-02-06 04:55:12', '2022-02-06 04:55:12'),
(221, 1, 27, 2500000, 'UP', 'SPPD Palu Januari', '2022-02-07', '2022-02-07 22:40:08', '2022-02-07 22:40:08'),
(222, 1, 38, 140000, 'DOWN', 'Foya2 Alfamidix', '2022-02-07', '2022-02-07 22:40:28', '2022-02-07 22:40:28'),
(223, 1, 27, 2000000, 'DOWN', 'Kasi Mace', '2022-02-11', '2022-02-11 19:54:35', '2022-02-11 19:54:35'),
(224, 1, 38, 300000, 'DOWN', 'Beli Kemeja Putih, Celana, Parfum', '2022-02-12', '2022-02-11 19:55:07', '2022-02-11 19:55:07'),
(225, 1, 38, 45000, 'DOWN', 'Ganti Oli', '2022-02-12', '2022-02-11 19:55:19', '2022-02-11 19:55:19'),
(226, 1, 27, 161000, 'DOWN', 'Beli Obat Rambut (Shampo)', '2022-02-17', '2022-02-16 23:43:36', '2022-02-16 23:43:36'),
(227, 1, 38, 100000, 'DOWN', 'Foya2 Alfamidix', '2022-02-16', '2022-02-16 23:43:57', '2022-02-16 23:43:57'),
(228, 1, 38, 35000, 'DOWN', 'Beli Ankle support', '2022-02-18', '2022-02-20 03:01:01', '2022-02-20 03:01:01'),
(229, 1, 38, 50000, 'DOWN', 'Kasi Afdal', '2022-02-17', '2022-02-20 03:01:30', '2022-02-20 03:01:30'),
(230, 1, 27, 4950000, 'UP', 'Gaji Januari 2022', '2022-02-20', '2022-02-20 03:02:19', '2022-02-20 03:02:19'),
(231, 1, 27, 230000, 'DOWN', 'Bayar Listrik Kos', '2022-02-20', '2022-02-20 19:37:43', '2022-02-20 19:37:43'),
(232, 1, 27, 10000000, 'DOWN', 'Rekon Saham', '2022-02-21', '2022-02-20 19:38:03', '2022-02-20 19:38:03'),
(233, 1, 38, 770000, 'DOWN', 'Bayar Kass Februari', '2022-02-21', '2022-02-21 03:57:51', '2022-02-21 03:57:51'),
(234, 8, 59, 100000, 'UP', 'Sisa Januari 2022', '2022-02-21', '2022-02-21 04:05:35', '2022-02-21 04:05:35'),
(235, 8, 59, 1000000, 'UP', 'Uang Kas (ADR)', '2022-02-21', '2022-02-21 04:06:06', '2022-02-21 04:06:06'),
(236, 8, 59, 227000, 'DOWN', 'Bayar Listrik (Februari)', '2022-02-21', '2022-02-21 04:06:40', '2022-02-21 04:06:40'),
(237, 8, 59, 160000, 'DOWN', 'Bayar Wifi', '2022-02-21', '2022-02-21 04:32:54', '2022-02-21 04:32:54'),
(238, 8, 59, 93000, 'DOWN', 'Mi Kaldu 1 Dos', '2022-02-21', '2022-02-21 05:33:26', '2022-02-21 05:33:26'),
(239, 1, 27, 200000, 'DOWN', 'Kasi Mace', '2022-02-22', '2022-02-21 21:06:02', '2022-02-21 21:06:02'),
(240, 8, 59, 30000, 'DOWN', 'Martabak', '2022-02-23', '2022-02-23 04:28:26', '2022-02-23 04:28:26'),
(242, 1, 27, 76500, 'DOWN', 'Pulsa', '2022-02-24', '2022-02-23 18:00:06', '2022-02-23 18:00:06'),
(243, 8, 59, 136000, 'DOWN', 'Beli sabun cuci dan sabun mandi', '2022-02-24', '2022-02-24 04:24:32', '2022-02-24 04:24:32'),
(244, 8, 59, 15000, 'DOWN', 'Galon', '2022-02-25', '2022-02-24 22:11:32', '2022-02-24 22:11:32'),
(245, 8, 59, 35000, 'DOWN', 'Lauk Siang', '2022-02-25', '2022-02-24 22:11:48', '2022-02-24 22:11:48'),
(246, 1, 27, 340900, 'DOWN', 'Normalisasi', '2022-02-26', '2022-02-25 21:06:45', '2022-02-25 21:06:45'),
(247, 1, 38, 200000, 'DOWN', 'Fahri Tarik', '2022-02-26', '2022-02-26 05:33:54', '2022-02-26 05:33:54'),
(248, 1, 27, 200000, 'UP', 'Fahri Kirim', '2022-02-26', '2022-02-26 05:34:07', '2022-02-26 05:34:07'),
(249, 1, 27, 50000, 'DOWN', 'Diamond ML', '2022-02-27', '2022-02-26 21:34:32', '2022-02-26 21:34:32'),
(250, 8, 59, 63000, 'DOWN', 'Ikan & Sayur', '2022-02-27', '2022-02-27 04:28:02', '2022-02-27 04:28:02'),
(251, 1, 27, 449000, 'DOWN', 'Belanja Shopee (Tas, slingbag, jaket)', '2022-02-28', '2022-02-28 03:53:56', '2022-02-28 03:53:56'),
(252, 1, 27, 200000, 'UP', 'Warni Bayar Tas', '2022-02-28', '2022-02-28 04:22:06', '2022-02-28 04:22:06'),
(253, 8, 59, 106000, 'DOWN', 'Indomi Goreng', '2022-03-01', '2022-03-01 03:52:37', '2022-03-01 03:52:37'),
(254, 8, 59, 15000, 'DOWN', 'Galon', '2022-03-01', '2022-03-01 03:52:45', '2022-03-01 03:52:45'),
(255, 1, 27, 200000, 'DOWN', 'Diamon ML', '2022-03-01', '2022-03-01 04:36:14', '2022-03-01 04:36:14'),
(256, 1, 27, 1500000, 'DOWN', 'Kasi ayu', '2022-03-03', '2022-03-03 03:41:09', '2022-03-03 03:41:09'),
(257, 8, 59, 50000, 'DOWN', 'Beli Makanan Koceng', '2022-03-03', '2022-03-03 05:09:44', '2022-03-03 05:09:44'),
(258, 8, 59, 20000, 'DOWN', 'Beli Lauk siang', '2022-03-04', '2022-03-03 23:19:55', '2022-03-03 23:19:55'),
(259, 1, 27, 500000, 'DOWN', 'Inden Motor', '2022-03-04', '2022-03-03 23:20:42', '2022-03-03 23:20:42'),
(260, 8, 59, 45000, 'DOWN', 'Bahan masak', '2022-03-05', '2022-03-04 21:33:54', '2022-03-04 21:33:54'),
(261, 1, 27, 92600, 'DOWN', 'Masker', '2022-03-07', '2022-03-06 19:44:01', '2022-03-06 19:44:01'),
(262, 1, 38, 44000, 'DOWN', 'Bayar Beras', '2022-03-07', '2022-03-06 20:19:23', '2022-03-06 20:19:23');

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
(1, 'Artono Dwi R', 'artono.dr@gmail.com', NULL, '082293422625', 'https://i.ibb.co/DGcJ8L3/191353028-901207357330153-8928624074740994062-n-Copy.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2021-04-14 09:03:15', '2021-04-14 09:03:23'),
(2, 'Resty Andrea', 'resty@gmail.com', NULL, '0822933454352', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2021-04-14 09:03:15', '2021-04-14 09:03:23'),
(3, 'Ayu', 'ayu@gmail.com', NULL, '', 'https://www.insoft.co.id/wp-content/uploads/2014/05/default-user-image.png', '$2y$10$O5QzjLCqzBFgFK62vehKB.6D2SZt3c3Ossm6pDYUchp/qibSt2.Bu', NULL, '2021-06-23 23:59:54', '2021-06-23 23:59:54'),
(4, 'Tes 3', 'gggx@gmail.com', NULL, '', 'https://www.insoft.co.id/wp-content/uploads/2014/05/default-user-image.png', '$2y$10$S3GrzWqG8T75aKwXhLAB/e70NCoDC4UnBZxv9QrhjXR/Ik4oUmYRS', NULL, '2021-06-24 00:54:47', '2021-06-24 00:54:47'),
(5, 'aka', 'irunwazed@gmail.com', NULL, '', 'https://www.insoft.co.id/wp-content/uploads/2014/05/default-user-image.png', '$2y$10$6kYeDBegqpqiaxnRKxLcMuXqU8/DI1jgeaYewJg2Kg0SaYLXqAlfa', NULL, '2021-06-24 01:20:18', '2021-06-24 01:20:18'),
(6, 'Muazharin', 'muazharin@gmail.com', NULL, '', 'https://www.insoft.co.id/wp-content/uploads/2014/05/default-user-image.png', '$2y$10$D6Xurbv8DWuP3hVU9tWMYeNzLQ4ONI.MD4CXSO9LLE7ZFkkQhqDPO', NULL, '2021-06-24 07:12:51', '2021-06-24 07:12:51'),
(7, 'Ragil Manggalaning Yudhanto', 'ragilmanggalaning42@gmail.com', NULL, '', 'https://www.insoft.co.id/wp-content/uploads/2014/05/default-user-image.png', '$2y$10$c449K63B1WSFJXU1VT.fmOGKlIPsFmCsTaoO7ZOwgDbjvmZn45rme', NULL, '2021-06-24 07:53:14', '2021-06-24 07:53:14'),
(8, 'Cafe ANT', 'ant@gmail.com', NULL, '', 'https://bmd4.morowalikab.go.id/images/ico-morowali.png', '$2y$10$I60i/NzoXsRj5oE0cCOk/Oej0UNOjat5C.3vi8zk0bE9C1eFQP8IS', NULL, '2022-02-21 04:03:27', '2022-02-21 04:03:27');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `sub_assets`
--
ALTER TABLE `sub_assets`
  MODIFY `sub_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
