-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2026 at 12:33 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barbershop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `barbers`
--

CREATE TABLE `barbers` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barbers`
--

INSERT INTO `barbers` (`id`, `nama`, `no_hp`, `alamat`, `image`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(8, 'YANrangga', '099888777009', 'Denpasar', 'barbers/UdG03igC8JL72vvgLn9SyHUqbEBDUnH9IUFaUIvX.png', '2026-03-13 04:18:03', NULL, '2026-03-30 11:56:27', NULL),
(9, 'Wismuy', '081246444660', 'Anggunanne', 'barbers/ofYJs7wLUblrAUGR4ZqFDDiTSvTezKm9ffIUaV5I.png', '2026-03-13 04:23:54', NULL, '2026-03-13 04:23:54', NULL),
(10, 'Nanduyy', '099876789', 'Singaraja', 'barbers/lKjRsruRoGtqAb4xf5fd6ffba8wyTuF9EqxTZFs3.png', '2026-03-13 04:24:18', NULL, '2026-04-06 11:33:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `id_customer` int DEFAULT NULL,
  `id_barber` int DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `status` enum('menunggu','diterima','batal','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'menunggu',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `id_customer`, `id_barber`, `tanggal`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 6, 8, '2026-03-17 16:00:00', 'diterima', '2026-03-16 02:35:44', NULL, '2026-03-16 02:48:38', NULL),
(4, 6, 9, '2026-03-20 19:00:00', 'diterima', '2026-03-16 03:13:08', NULL, '2026-03-16 03:13:40', NULL),
(5, 6, 10, '2026-03-20 10:00:00', 'diterima', '2026-03-16 03:41:48', NULL, '2026-03-16 03:50:48', NULL),
(6, 6, 8, '2026-03-28 13:00:00', 'diterima', '2026-03-16 03:53:35', NULL, '2026-03-16 03:54:14', NULL),
(7, 6, 8, '2026-03-28 16:00:00', 'selesai', '2026-03-16 11:12:38', NULL, '2026-03-18 00:25:14', NULL),
(8, 6, 9, '2026-03-28 16:00:00', 'batal', '2026-03-16 11:12:51', NULL, '2026-03-16 11:13:19', NULL),
(10, 6, 9, '2026-03-22 15:00:00', 'selesai', '2026-03-22 14:18:51', NULL, '2026-03-22 14:19:49', NULL),
(11, 6, 9, '2026-03-27 19:00:00', 'selesai', '2026-03-26 05:02:32', NULL, '2026-03-26 05:05:18', NULL),
(12, 6, 10, '2026-03-28 13:00:00', 'selesai', '2026-03-26 05:02:44', NULL, '2026-03-26 05:03:42', NULL),
(13, 6, 10, '2026-03-26 11:00:00', 'menunggu', '2026-03-26 05:49:19', NULL, '2026-03-26 05:49:19', NULL),
(14, 6, 10, '2026-03-29 13:00:00', 'diterima', '2026-03-26 05:51:20', NULL, '2026-03-29 13:12:08', NULL),
(15, 6, 9, '2026-03-29 10:00:00', 'diterima', '2026-03-26 05:52:05', NULL, '2026-03-29 10:59:58', NULL),
(16, 6, 10, '2026-03-28 11:00:00', 'batal', '2026-03-27 01:11:31', NULL, '2026-03-31 03:37:19', NULL),
(17, 12, 10, '2026-03-27 14:00:00', 'menunggu', '2026-03-27 02:13:22', NULL, '2026-03-27 02:13:22', NULL),
(18, 12, 10, '2026-04-01 11:00:00', 'diterima', '2026-03-27 02:13:59', NULL, '2026-03-30 12:22:50', NULL),
(19, 6, 9, '2026-04-05 10:00:00', 'selesai', '2026-04-05 03:45:36', NULL, '2026-04-05 04:03:23', NULL),
(20, 6, 10, '2026-04-06 16:00:00', 'batal', '2026-04-05 11:24:52', NULL, '2026-04-05 11:29:27', NULL),
(21, 6, 8, '2026-04-06 10:00:00', 'selesai', '2026-04-05 12:36:11', NULL, '2026-04-05 12:36:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int NOT NULL,
  `id_booking` int DEFAULT NULL,
  `id_service` int DEFAULT NULL,
  `harga` int NOT NULL,
  `harga_asli` int NOT NULL DEFAULT '0',
  `diskon_persen` decimal(5,2) NOT NULL DEFAULT '0.00',
  `harga_bayar` int NOT NULL DEFAULT '0',
  `discount_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `id_booking`, `id_service`, `harga`, `harga_asli`, `diskon_persen`, `harga_bayar`, `discount_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 2, 3, 250000, 0, '0.00', 0, NULL, '2026-03-16 02:35:44', NULL, '2026-03-16 02:35:44', NULL),
(4, 4, 4, 400000, 0, '0.00', 0, NULL, '2026-03-16 03:13:08', NULL, '2026-03-16 03:13:08', NULL),
(5, 5, 4, 400000, 0, '0.00', 0, NULL, '2026-03-16 03:41:48', NULL, '2026-03-16 03:41:48', NULL),
(6, 6, 3, 250000, 0, '0.00', 0, NULL, '2026-03-16 03:53:35', NULL, '2026-03-16 03:53:35', NULL),
(7, 7, 2, 200000, 0, '0.00', 0, NULL, '2026-03-16 11:12:38', NULL, '2026-03-16 11:12:38', NULL),
(8, 8, 4, 400000, 0, '0.00', 0, NULL, '2026-03-16 11:12:51', NULL, '2026-03-16 11:12:51', NULL),
(10, 10, 1, 150000, 0, '0.00', 0, NULL, '2026-03-22 14:18:51', NULL, '2026-03-22 14:18:51', NULL),
(11, 11, 4, 400000, 0, '0.00', 0, NULL, '2026-03-26 05:02:32', NULL, '2026-03-26 05:02:32', NULL),
(12, 12, 2, 200000, 0, '0.00', 0, NULL, '2026-03-26 05:02:44', NULL, '2026-03-26 05:02:44', NULL),
(13, 13, 2, 200000, 0, '0.00', 0, NULL, '2026-03-26 05:49:19', NULL, '2026-03-26 05:49:19', NULL),
(14, 14, 3, 250000, 0, '0.00', 0, NULL, '2026-03-26 05:51:20', NULL, '2026-03-26 05:51:20', NULL),
(15, 15, 3, 250000, 0, '0.00', 0, NULL, '2026-03-26 05:52:05', NULL, '2026-03-26 05:52:05', NULL),
(16, 16, 2, 200000, 0, '0.00', 0, NULL, '2026-03-27 01:11:31', NULL, '2026-03-27 01:11:31', NULL),
(17, 17, 1, 150000, 0, '0.00', 0, NULL, '2026-03-27 02:13:22', NULL, '2026-03-27 02:13:22', NULL),
(18, 18, 2, 200000, 0, '0.00', 0, NULL, '2026-03-27 02:13:59', NULL, '2026-03-27 02:13:59', NULL),
(19, 19, 1, 150000, 150000, '25.00', 112500, 1, '2026-04-05 03:45:36', NULL, '2026-04-05 03:45:36', NULL),
(20, 20, 3, 250000, 250000, '25.00', 187500, 1, '2026-04-05 11:24:52', NULL, '2026-04-05 11:24:52', NULL),
(21, 21, 1, 150000, 150000, '15.00', 127500, 2, '2026-04-05 12:36:11', NULL, '2026-04-05 12:36:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `id_user`, `no_hp`, `alamat`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6, 14, '098768756122334', 'anggungan mengwi', '2026-03-10 05:38:36', NULL, '2026-03-10 05:38:36', NULL),
(8, 17, '081803141665', 'kuta selatan', '2026-03-13 05:48:58', NULL, '2026-03-27 02:05:49', NULL),
(12, 25, '0988776655', 'buidTabanank', '2026-03-27 02:11:34', NULL, '2026-03-30 11:54:24', NULL),
(13, 52, '0846372736', 'Tabananwii', '2026-03-30 12:25:45', NULL, '2026-03-30 13:01:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persen` decimal(5,2) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `nama`, `persen`, `tanggal_mulai`, `tanggal_selesai`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Nyepi holiday discount', '25.00', '2026-04-05', '2026-04-07', 0, 18, '2026-04-04 19:32:38', '2026-04-05 04:35:19'),
(2, 'Diskon lebaran', '15.00', '2026-04-05', '2026-04-11', 1, 18, '2026-04-04 19:38:26', '2026-04-06 03:18:55'),
(3, 'Imlek holiday discount', '15.00', '2026-04-06', '2026-04-08', 1, 18, '2026-04-06 03:26:08', '2026-04-06 04:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `id` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`id`, `id_user`, `no_hp`, `alamat`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(12, 50, '011000011', 'perumDalung', '2026-03-29 10:59:12', NULL, '2026-03-29 10:59:12', NULL),
(14, 18, '099888989789', 'anggungan lagi', '2026-03-30 13:03:57', NULL, '2026-03-30 13:03:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_05_015532_create_sessions_table', 2),
(5, '2026_04_05_025112_create_discounts_table', 3),
(6, '2026_04_05_030103_add_discount_columns_to_booking_details_table', 4),
(7, '2026_04_05_035350_add_discount_columns_to_transaction_details_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `nama_service` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `estimasi_menit` int NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `nama_service`, `harga`, `estimasi_menit`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Haircut', 150000, 30, 1, '2026-03-10 12:44:56', NULL, '2026-03-30 11:53:59', NULL),
(2, 'Premium-Haircut', 200000, 45, 1, '2026-03-10 12:48:41', NULL, '2026-03-16 04:12:24', NULL),
(3, 'highlight / Bleaching', 250000, 60, 1, '2026-03-11 05:29:21', NULL, '2026-03-16 04:11:03', NULL),
(4, 'Hair Styling (Pomade / Wax Styling)', 400000, 60, 1, '2026-03-12 05:38:40', NULL, '2026-03-28 10:10:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AQytwSwPgpqX7tIENhs9u6thFREQYy2o9AmIxWx8', 18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiellteUVLMnJncU9JZ1c3WlBmZ3B2ZWdkSUp5ZFZEWjFmaGtyQkEySiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kaXNjb3VudHMiO3M6NToicm91dGUiO3M6MTU6ImRpc2NvdW50cy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE4O30=', 1775478772),
('XHW2gYmUfv4EoJeG88o2eqsxYQBbsITfme2UWNoj', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMTRlVExCY29PeEgzZTNvbEVYZGt0eDA5YWl0YzZsWjlPZUE4enljUiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rpc2NvdW50cyI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vYmFyYmVycyI7czo1OiJyb3V0ZSI7czoxMzoiYmFyYmVycy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjg7fQ==', 1775475238);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `id_customer` int DEFAULT NULL,
  `id_barber` int DEFAULT NULL,
  `id_kasir` int DEFAULT NULL,
  `id_booking` int DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `metode_bayar` enum('tunai','qris') NOT NULL,
  `total` int NOT NULL,
  `status_layanan` enum('proses','selesai') DEFAULT 'proses',
  `status_pembayaran` enum('pending','lunas') DEFAULT 'pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `id_customer`, `id_barber`, `id_kasir`, `id_booking`, `tanggal`, `metode_bayar`, `total`, `status_layanan`, `status_pembayaran`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 6, 8, NULL, 2, '2026-03-16 02:52:26', 'tunai', 250000, 'selesai', 'lunas', '2026-03-16 02:52:26', NULL, '2026-03-26 01:26:13', NULL),
(3, 6, 10, NULL, NULL, '2026-03-16 03:01:59', 'qris', 150000, 'selesai', 'lunas', '2026-03-16 03:01:59', NULL, '2026-03-16 03:12:26', NULL),
(4, 6, 9, NULL, 4, '2026-03-16 03:13:50', 'tunai', 400000, 'selesai', 'lunas', '2026-03-16 03:13:50', NULL, '2026-03-16 03:13:57', NULL),
(5, 6, 10, NULL, 5, '2026-03-16 03:50:56', 'qris', 400000, 'selesai', 'lunas', '2026-03-16 03:50:56', NULL, '2026-03-16 03:51:02', NULL),
(6, 6, 8, NULL, 6, '2026-03-16 03:54:56', 'tunai', 250000, 'selesai', 'lunas', '2026-03-16 03:54:56', NULL, '2026-03-16 03:55:39', NULL),
(7, 6, 8, NULL, 7, '2026-03-18 00:25:14', 'qris', 200000, 'selesai', 'lunas', '2026-03-18 00:25:14', NULL, '2026-03-30 11:49:56', NULL),
(8, NULL, 8, NULL, NULL, '2026-03-18 00:31:35', 'tunai', 200000, 'selesai', 'lunas', '2026-03-18 00:31:35', NULL, '2026-03-29 13:32:26', NULL),
(9, 6, 9, NULL, 10, '2026-03-22 14:19:49', 'tunai', 150000, 'selesai', 'lunas', '2026-03-22 14:19:49', NULL, '2026-03-22 14:20:06', NULL),
(10, 6, 10, NULL, 12, '2026-03-26 05:03:42', 'qris', 200000, 'selesai', 'lunas', '2026-03-26 05:03:42', NULL, '2026-03-26 05:05:02', NULL),
(11, 6, 9, NULL, 11, '2026-03-26 05:05:18', 'qris', 400000, 'selesai', 'lunas', '2026-03-26 05:05:18', NULL, '2026-03-26 05:05:38', NULL),
(12, 6, 9, 14, 19, '2026-04-05 04:03:23', 'tunai', 112500, 'selesai', 'lunas', '2026-04-05 04:03:23', NULL, '2026-04-05 04:03:27', NULL),
(13, 6, 8, 14, 21, '2026-04-05 12:36:35', 'qris', 127500, 'selesai', 'lunas', '2026-04-05 12:36:35', NULL, '2026-04-05 12:36:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int NOT NULL,
  `id_transaction` int DEFAULT NULL,
  `id_service` int DEFAULT NULL,
  `harga` int NOT NULL,
  `harga_asli` int NOT NULL DEFAULT '0',
  `diskon_persen` decimal(5,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `id_transaction`, `id_service`, `harga`, `harga_asli`, `diskon_persen`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 2, NULL, 250000, 0, '0.00', '2026-03-16 02:52:26', NULL, '2026-03-16 02:52:26', NULL),
(3, 3, NULL, 150000, 0, '0.00', '2026-03-16 03:01:59', NULL, '2026-03-16 03:01:59', NULL),
(4, 4, NULL, 400000, 0, '0.00', '2026-03-16 03:13:50', NULL, '2026-03-16 03:13:50', NULL),
(5, 5, NULL, 400000, 0, '0.00', '2026-03-16 03:50:56', NULL, '2026-03-16 03:50:56', NULL),
(6, 6, 3, 250000, 0, '0.00', '2026-03-16 03:54:56', NULL, '2026-03-16 03:54:56', NULL),
(7, 7, 2, 200000, 0, '0.00', '2026-03-18 00:25:14', NULL, '2026-03-18 00:25:14', NULL),
(8, 8, 2, 200000, 0, '0.00', '2026-03-18 00:31:35', NULL, '2026-03-18 00:31:35', NULL),
(9, 9, 1, 150000, 0, '0.00', '2026-03-22 14:19:49', NULL, '2026-03-22 14:19:49', NULL),
(10, 10, 2, 200000, 0, '0.00', '2026-03-26 05:03:42', NULL, '2026-03-26 05:03:42', NULL),
(11, 11, 4, 400000, 0, '0.00', '2026-03-26 05:05:18', NULL, '2026-03-26 05:05:18', NULL),
(12, 12, 1, 112500, 150000, '25.00', '2026-04-05 04:03:23', NULL, '2026-04-05 04:03:23', NULL),
(13, 13, 1, 127500, 150000, '15.00', '2026-04-05 12:36:35', NULL, '2026-04-05 12:36:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','kasir','customer') NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `role`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(8, 'wismaadmin', 'wismaadmin', 'admin@gmail.com', '$2y$12$kJB5ZYbbp7vjMdlqwO0a8OXn.LEI9kblcq/vSOPz4JDLvxgjUezGe', 'admin', '2026-03-09 13:25:08', NULL, '2026-03-29 10:57:41', NULL),
(14, 'wsima', 'wismawardana', 'wisma@gmail.com', '$2y$12$a8Zu.4Ebexr41Xgte8O.teWVR272NNZqLFfdoM7QqIQrVjfoE4Av2', 'customer', '2026-03-10 05:38:36', NULL, '2026-03-10 05:38:36', NULL),
(17, 'Indra Farel', 'indra', 'indra@gmail.com', '$2y$12$UIqSISzOZwNsUxkc0yR3heueHjJdD6AaA5npdJvQTRzdNt2bLF8Om', 'customer', '2026-03-13 05:48:58', NULL, '2026-03-13 05:48:58', NULL),
(18, 'dewisma', 'dewisma', 'dewisma@gmail.com', '$2y$12$T8CtT9cWNgLKndcvvTBeaeTZdKpQoIkdqgnSEbGJUm4QYA/fh44Ia', 'kasir', '2026-03-16 02:51:54', NULL, '2026-03-30 13:04:01', NULL),
(25, 'yan', 'yanga', 'rangga@gmail.com', '$2y$12$astD4i/M1xWQshFbg8BHQuqhOXoa.5E8pPbuIsI/Frx4f9dUCxxl6', 'customer', '2026-03-27 02:11:34', NULL, '2026-03-27 02:11:34', NULL),
(50, 'rizky', 'rizky', 'rizky@gmail.com', '$2y$12$PV4n4UZSYHrn4IE.6r/Qb.DGwPfRj9UqdfRgzL3fss5eaf.SdXYUG', 'customer', '2026-03-29 10:59:12', NULL, '2026-03-29 10:59:23', NULL),
(52, 'rang', 'rang', 'ra@gmail.com', '$2y$12$x4AykBc0R7BnUwRni/frBuEx9MFe/qDW.rLv3OA3/EhVi1tZv7/iS', 'customer', '2026-03-30 12:25:45', NULL, '2026-03-30 12:25:45', NULL),
(53, 'nandaputra', 'nando', 'nando@gmail.com', '$2y$12$LRQ77fmTrMmj701wN1t1GO9nzytzRhHZ4JpCycpS6pxprUf4JPzhS', 'admin', '2026-03-30 13:06:57', NULL, '2026-03-30 13:08:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barbers`
--
ALTER TABLE `barbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bookings_customer` (`id_customer`),
  ADD KEY `fk_bookings_barber` (`id_barber`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bookingdetails_booking` (`id_booking`),
  ADD KEY `fk_bookingdetails_service` (`id_service`),
  ADD KEY `booking_details_discount_id_foreign` (`discount_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_created_by_foreign` (`created_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transactions_customer` (`id_customer`),
  ADD KEY `fk_transactions_barber` (`id_barber`),
  ADD KEY `fk_transactions_kasir` (`id_kasir`),
  ADD KEY `fk_transactions_booking` (`id_booking`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transactiondetails_transaction` (`id_transaction`),
  ADD KEY `fk_transactiondetails_service` (`id_service`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barbers`
--
ALTER TABLE `barbers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_barber` FOREIGN KEY (`id_barber`) REFERENCES `barbers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bookings_customer` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_bookingdetails_booking` FOREIGN KEY (`id_booking`) REFERENCES `bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bookingdetails_service` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_customers_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transactions_barber` FOREIGN KEY (`id_barber`) REFERENCES `barbers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transactions_booking` FOREIGN KEY (`id_booking`) REFERENCES `bookings` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transactions_customer` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transactions_kasir` FOREIGN KEY (`id_kasir`) REFERENCES `kasir` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `fk_transactiondetails_service` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transactiondetails_transaction` FOREIGN KEY (`id_transaction`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
