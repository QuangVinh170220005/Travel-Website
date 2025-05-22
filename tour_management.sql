-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 03:25 AM
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
-- Database: `tour_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(12,2) NOT NULL,
  `status` enum('PENDING','CONFIRMED','PAID','CANCELLED') NOT NULL DEFAULT 'PENDING',
  `special_requests` text DEFAULT NULL,
  `deposit_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `need_pickup` tinyint(1) NOT NULL DEFAULT 0,
  `pickup_location` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `detail_id` bigint(20) NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `adult_count` int(11) NOT NULL,
  `child_count` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_forms`
--

CREATE TABLE `contact_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('pending','read','replied') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_forms`
--

INSERT INTO `contact_forms` (`id`, `name`, `email`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Phạm Ngọc Phổ', 'phamngocpho1606@gmail.com', '8798790bhjbhj', 'pending', '2024-12-22 10:16:26', '2024-12-22 10:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `coordinates` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT 0,
  `best_time_to_visit` varchar(100) DEFAULT NULL,
  `weather_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `description`, `coordinates`, `is_popular`, `best_time_to_visit`, `weather_notes`, `created_at`, `updated_at`) VALUES
(1, 'Hạ Long Bay', 'A UNESCO World Heritage Site featuring thousands of limestone islands and islets rising from emerald waters.', '20.9101,107.1839', 1, 'October to December', 'Spring (March-April) has light rain. Summer (May-August) is hot with occasional storms.', '2024-11-12 17:22:30', '2024-12-19 15:54:55'),
(2, 'Hội An', 'Ancient trading port featuring unique architecture blending Vietnamese, Chinese and Japanese influences.', '15.8801,108.3380', 1, 'February to July', 'Dry season from February to July. Rainy season from October to January.', '2024-11-12 17:22:30', '2024-12-19 15:54:55'),
(3, 'Sapa', 'Mountain town famous for rice terraces, trekking routes and ethnic minority cultures.', '22.3364,103.8438', 1, 'March to May, September to November', 'Spring and Fall offer the best weather. Winter can be very cold.', '2024-11-12 17:22:30', '2024-12-19 15:54:55'),
(4, 'Phú Quốc', 'Vietnam\'s largest island known for pristine beaches, luxury resorts, and pearl farms.', '10.2896,103.9833', 1, 'November to March', 'Dry season from November to March. Rainy season from July to September.', '2024-11-12 17:22:30', '2024-12-19 15:54:55'),
(5, 'Đà Lạt', 'Mountain resort city known for its cool climate, French colonial architecture and flowers.', '11.9404,108.4583', 1, 'December to March', 'Cool climate year-round. Rainy season from May to October.', '2024-11-12 17:22:30', '2024-12-19 15:54:55'),
(6, 'Nha Trang', 'Coastal resort city with beautiful beaches, diving sites, and offshore islands.', '12.2388,109.1967', 1, 'March to September', 'Best weather from March to September. Rainy season from October to December.', '2024-11-12 17:22:30', '2024-12-19 15:54:55'),
(7, '687', '86778698dkxfjhbvgfkjsdn', '106.7626186,21.8384028', 1, 'mùa xuân', '89676879698', '2024-12-21 07:51:22', '2024-12-21 07:51:22'),
(8, 'chat bjdsfjask', '876', '105.7351068,21.053731', 1, '8798797097709', '809', '2024-12-21 09:58:30', '2024-12-21 09:58:30'),
(9, '97889', '890980', '106.63874104100006,10.77019111800007', 1, '089809', '809', '2024-12-21 21:15:58', '2024-12-21 21:15:58'),
(10, '789', '789', '105.8019889,10.022361', 1, '897', '798', '2024-12-21 21:18:30', '2024-12-21 21:18:30'),
(11, '8687', 'guhuigu', '105.59079818400005,21.31036427300006', 0, 'ug', 'giu', '2024-12-22 01:22:24', '2024-12-22 01:22:24'),
(12, '876', '868', '105.0797082,10.68177', 0, '86', '86', '2024-12-22 01:24:48', '2024-12-22 01:24:48'),
(14, '798', '789', '105.8019889,10.022361', 0, '798', '978', '2024-12-22 01:37:30', '2024-12-22 01:37:30'),
(15, '897', '9878', '105.14665305600005,9.17756444400004', 1, '798', '897', '2024-12-22 01:40:32', '2024-12-22 01:40:32'),
(16, '978', '987', '106.645675,20.8181027', 0, '789', '978', '2024-12-22 01:43:42', '2024-12-22 01:43:42'),
(17, '798', '7978', '107.1225556,10.3881851', 0, '789', '798', '2024-12-22 01:48:13', '2024-12-22 01:48:13'),
(18, '987', '87897', '105.9965925,20.2435062', 0, '798', '789', '2024-12-22 01:53:54', '2024-12-22 01:53:54'),
(19, '678', '876', '106.39063654500006,10.523775084000022', 0, '986', '798', '2024-12-22 02:02:33', '2024-12-22 02:02:33'),
(20, '53', 'sfgfs', '106.7584042,21.8638297', 0, 'dsgfsd', 'gregre', '2024-12-22 08:02:34', '2024-12-22 08:02:34'),
(21, '867', '876', '105.1365344,9.1927951', 1, '876', '678', '2024-12-22 08:40:20', '2024-12-22 08:40:20'),
(22, '867', '876', '105.1365344,9.1927951', 1, '876', '678', '2024-12-22 08:40:37', '2024-12-22 08:40:37'),
(23, '867', '876', '105.1365344,9.1927951', 1, '876', '678', '2024-12-22 08:42:37', '2024-12-22 08:42:37'),
(24, '768', '567', '103.90674731000007,21.33809867100007', 1, '567', '567', '2024-12-22 08:44:50', '2024-12-22 08:44:50'),
(25, '678', '678', '106.7626186,21.8384028', 1, '678', '768', '2024-12-22 08:55:10', '2024-12-22 08:55:10'),
(26, '567', '657', '105.920887,10.2698567', 1, '657', '657657', '2024-12-22 08:57:24', '2024-12-22 08:57:24'),
(27, '678', '876', '104.90338210300007,21.714817177000043', 0, '876', '678', '2024-12-22 09:00:09', '2024-12-22 09:00:09'),
(28, '768', NULL, '106.6356309,10.8913421', 0, NULL, NULL, '2024-12-22 09:26:41', '2024-12-22 09:26:41'),
(29, '567', NULL, '108.0009011,14.3650953', 0, NULL, NULL, '2024-12-22 09:29:04', '2024-12-22 09:29:04'),
(30, '789', '987789', '108.23335,16.0657247', 0, '789', '879789', '2024-12-22 10:29:26', '2024-12-22 10:29:26'),
(31, 'Vịnh Hạ long', 'dsss', '107.12651100000005,20.924303000000066', 1, '876', 'sss', '2024-12-22 11:03:17', '2024-12-22 11:03:17'),
(32, '3243543', '3124', '105.7841054,19.8020318', 0, '32413', '324124', '2024-12-23 00:49:35', '2024-12-23 00:49:35'),
(33, '798', '97', '106.6624847,10.9569116', 0, '79879', '7987979790907', '2024-12-23 07:03:00', '2024-12-23 07:03:00'),
(34, '897', '9877', '106.0786346,21.1752134', 0, '978', '97', '2024-12-23 07:05:02', '2024-12-23 07:05:02'),
(35, '78', '787', '107.92548,14.5325', 1, '678', '68', '2024-12-23 07:06:50', '2024-12-23 07:06:50'),
(36, '435', '45', '105.7759327,19.7873756', 0, '345', NULL, '2024-12-23 09:25:39', '2024-12-23 09:25:39'),
(37, '435', '45', '105.7759327,19.7873756', 0, '345', NULL, '2024-12-23 09:25:50', '2024-12-23 09:25:50'),
(38, '9877', '87687', '106.6624847,10.9569116', 1, '89789798', '798', '2024-12-23 11:25:17', '2024-12-23 11:25:17');

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
(1, '2024_11_07_125117_add_indexes_to_tables', 1),
(2, '2024_11_07_141514_create_sessions_table', 2),
(3, '2024_11_07_141637_create_sessions_table', 3),
(5, '2024_11_12_065010_create_admin_user', 4),
(6, '2024_11_30_144426_add_timestamps_to_bookings_table', 5),
(7, '2024_12_19_120906_create_contact_forms_table', 6),
(8, '2024_12_23_095018_create_wishlists_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `price_details`
--

CREATE TABLE `price_details` (
  `price_detail_id` bigint(20) UNSIGNED NOT NULL,
  `price_list_id` bigint(20) UNSIGNED NOT NULL,
  `customer_type` enum('ADULT','CHILD') NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `note` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_details`
--

INSERT INTO `price_details` (`price_detail_id`, `price_list_id`, `customer_type`, `price`, `note`, `updated_at`) VALUES
(44, 144, 'ADULT', 9787.00, '978', '2024-12-23 16:19:55'),
(45, 144, 'CHILD', 9890.00, '8977', '2024-12-23 16:19:55'),
(46, 145, 'ADULT', 798.00, '789', '2024-12-23 16:20:19'),
(47, 145, 'CHILD', 98009.00, '86976798', '2024-12-23 16:20:19'),
(48, 146, 'ADULT', 435436.00, '435', '2024-12-23 16:24:21'),
(49, 146, 'CHILD', 523452.00, '5234', '2024-12-23 16:24:21'),
(50, 147, 'ADULT', 345.00, '345', '2024-12-23 16:27:25'),
(51, 147, 'CHILD', 345.00, '435', '2024-12-23 16:27:25'),
(52, 148, 'ADULT', 987.00, '798', '2024-12-23 16:29:10'),
(53, 148, 'CHILD', 798.00, '789', '2024-12-23 16:29:10'),
(54, 149, 'ADULT', 987.00, '798', '2024-12-23 16:31:12'),
(55, 149, 'CHILD', 798.00, '789', '2024-12-23 16:31:12'),
(56, 150, 'ADULT', 987.00, '789', '2024-12-23 16:31:30'),
(57, 150, 'CHILD', 789.00, '798', '2024-12-23 16:31:30'),
(58, 151, 'ADULT', 987.00, '789', '2024-12-23 16:34:06'),
(59, 151, 'CHILD', 789.00, '789', '2024-12-23 16:34:06'),
(60, 152, 'ADULT', 768.00, '687', '2024-12-23 16:34:37'),
(61, 152, 'CHILD', 678.00, '678', '2024-12-23 16:34:37'),
(62, 153, 'ADULT', 798.00, '798', '2024-12-23 16:36:22'),
(63, 153, 'CHILD', 789.00, '789', '2024-12-23 16:36:22'),
(64, 154, 'ADULT', 678.00, '678', '2024-12-23 16:38:58'),
(65, 154, 'CHILD', 768.00, '678', '2024-12-23 16:38:58'),
(66, 155, 'ADULT', 678.00, '678', '2024-12-23 16:39:46'),
(67, 155, 'CHILD', 768.00, '678', '2024-12-23 16:39:46'),
(68, 156, 'ADULT', 698.00, '698', '2024-12-23 16:40:37'),
(69, 156, 'CHILD', 698.00, '698', '2024-12-23 16:40:37'),
(70, 157, 'ADULT', 798.00, '789', '2024-12-23 16:41:35'),
(71, 157, 'CHILD', 78.00, '879', '2024-12-23 16:41:35'),
(72, 158, 'ADULT', 798.00, '789', '2024-12-23 16:42:55'),
(73, 158, 'CHILD', 78.00, '879', '2024-12-23 16:42:55'),
(74, 159, 'ADULT', 789.00, '789', '2024-12-23 16:43:09'),
(75, 159, 'CHILD', 789.00, '879', '2024-12-23 16:43:09'),
(76, 160, 'ADULT', 98.00, '809', '2024-12-23 16:45:26'),
(77, 160, 'CHILD', 809.00, '890', '2024-12-23 16:45:26'),
(78, 161, 'ADULT', 798.00, '789', '2024-12-23 16:45:57'),
(79, 161, 'CHILD', 789.00, '789', '2024-12-23 16:45:57'),
(80, 162, 'ADULT', 67878678.00, '678', '2024-12-23 18:19:48'),
(81, 162, 'CHILD', 6786.00, '678', '2024-12-23 18:19:48'),
(82, 163, 'ADULT', 98679867.00, '687678', '2024-12-23 18:25:52'),
(83, 163, 'CHILD', 678667867.00, '678', '2024-12-23 18:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `price_lists`
--

CREATE TABLE `price_lists` (
  `price_list_id` bigint(20) UNSIGNED NOT NULL,
  `price_list_name` varchar(100) NOT NULL,
  `valid_from` datetime DEFAULT NULL,
  `valid_to` datetime DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `tour_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_lists`
--

INSERT INTO `price_lists` (`price_list_id`, `price_list_name`, `valid_from`, `valid_to`, `description`, `is_default`, `tour_id`, `created_at`, `updated_at`) VALUES
(144, 'gfiauegdiu', '2024-12-02 00:00:00', '2024-12-26 00:00:00', '798789', 0, 80, '2024-12-23 09:19:55', '2024-12-23 09:19:55'),
(145, 'gfiauegdiu', '2024-12-10 00:00:00', '2024-12-28 00:00:00', '98798798', 0, 91, '2024-12-23 09:20:19', '2024-12-23 09:20:19'),
(146, 'gfiauegdiu', '2024-12-10 00:00:00', '2024-12-18 00:00:00', '435534', 0, 90, '2024-12-23 09:24:21', '2024-12-23 09:24:21'),
(147, 'gfiauegdiu', '2024-12-19 00:00:00', '2024-12-31 00:00:00', '345', 0, 88, '2024-12-23 09:27:24', '2024-12-23 09:27:24'),
(148, '9798', '2024-12-19 00:00:00', '2024-12-28 00:00:00', '978', 0, 87, '2024-12-23 09:29:10', '2024-12-23 09:29:10'),
(149, '9798', '2024-12-19 00:00:00', '2024-12-28 00:00:00', '978', 0, 87, '2024-12-23 09:31:12', '2024-12-23 09:31:12'),
(150, 'gfiauegdiu', '2024-12-04 00:00:00', '2024-12-27 00:00:00', '98798', 0, 84, '2024-12-23 09:31:30', '2024-12-23 09:31:30'),
(151, '978', '2024-12-03 00:00:00', '2024-12-14 00:00:00', '798', 0, 90, '2024-12-23 09:34:06', '2024-12-23 09:34:06'),
(152, '89678', '2024-12-06 00:00:00', '2024-12-28 00:00:00', '876', 0, 89, '2024-12-23 09:34:37', '2024-12-23 09:34:37'),
(153, '798', '2024-12-06 00:00:00', '2024-12-26 00:00:00', '789798', 0, 85, '2024-12-23 09:36:22', '2024-12-23 09:36:22'),
(154, '768', '2024-12-01 00:00:00', '2024-12-19 00:00:00', '6876', 0, 83, '2024-12-23 09:38:58', '2024-12-23 09:38:58'),
(155, '768', '2024-12-01 00:00:00', '2024-12-19 00:00:00', '6876', 0, 83, '2024-12-23 09:39:46', '2024-12-23 09:39:46'),
(156, '8769689', '2024-12-06 00:00:00', '2024-12-28 00:00:00', '698', 0, 83, '2024-12-23 09:40:37', '2024-12-23 09:40:37'),
(157, '987897', '2024-12-11 00:00:00', '2024-12-27 00:00:00', '798', 0, 83, '2024-12-23 09:41:35', '2024-12-23 09:41:35'),
(158, '987897', '2024-12-11 00:00:00', '2024-12-27 00:00:00', '798', 0, 83, '2024-12-23 09:42:55', '2024-12-23 09:42:55'),
(159, 'gfiauegdiu', '2024-12-01 00:00:00', '2024-12-18 00:00:00', '7897', 0, 83, '2024-12-23 09:43:09', '2024-12-23 09:43:09'),
(160, 'gfiauegdiu', '2024-12-05 00:00:00', '2024-12-09 00:00:00', '9807809', 0, 80, '2024-12-23 09:45:26', '2024-12-23 09:45:26'),
(161, 'gfiauegdiu', '2024-12-06 00:00:00', '2024-12-28 00:00:00', '798789', 0, 93, '2024-12-23 09:45:57', '2024-12-23 09:45:57'),
(162, 'gfiauegdiu', '2024-12-01 00:00:00', '2024-12-27 00:00:00', '68687', 0, 93, '2024-12-23 11:19:48', '2024-12-23 11:19:48'),
(163, 'gfiauegdiu', '2024-12-02 00:00:00', '2024-12-28 00:00:00', 'ùuytfytf', 1, 94, '2024-12-23 11:25:52', '2024-12-23 11:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('QdClU6VlJlvNb86AAyX4XnepZRPA6IruyTsv96SC', 12, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibEVZT2Y0VmtDS1VGVmtIeUxVbVZ1V0loNlVOTVdUa0Uxc3VuUTVoZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9sb2NhbGhvc3QvVHJhdmVsLVdlYnNpdGUvcHVibGljL3dpc2hsaXN0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI7fQ==', 1734988087);

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `tour_name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `duration_days` int(11) NOT NULL,
  `max_participants` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `transportation` varchar(100) DEFAULT NULL,
  `include_hotel` tinyint(1) NOT NULL DEFAULT 1,
  `include_meal` tinyint(1) NOT NULL DEFAULT 1,
  `highlight_places` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`tour_id`, `tour_name`, `description`, `duration_days`, `max_participants`, `category`, `transportation`, `include_hotel`, `include_meal`, `highlight_places`, `created_at`, `updated_at`, `is_active`, `location_id`) VALUES
(13, '11', NULL, 11, 11, 'nature', '11', 1, 1, '11', '2024-11-12 11:06:59', '2024-11-12 11:06:59', 1, 2),
(14, '11111', NULL, 11, 11, 'nature', '11', 1, 1, '11', '2024-11-12 11:08:32', '2024-11-12 11:08:32', 1, 2),
(15, '11111', NULL, 11, 11, 'nature', '11', 1, 1, '11', '2024-11-12 11:08:32', '2024-11-12 11:08:32', 1, 2),
(19, '11', NULL, 11, 11, 'cultural', '11', 1, 1, '11', '2024-11-12 11:17:36', '2024-11-12 11:17:36', 1, 3),
(21, '11', NULL, 11, 11, 'cultural', '11', 1, 1, '11', '2024-11-12 11:19:56', '2024-11-12 11:19:56', 1, 3),
(22, '11', NULL, 11, 11, 'cultural', '11', 1, 1, '11', '2024-11-12 11:20:06', '2024-11-12 11:20:06', 1, 3),
(23, '11', NULL, 11, 111, 'beach', 'fvd', 1, 1, 'dffv', '2024-11-12 11:20:30', '2024-11-12 11:20:30', 1, 2),
(24, '11', NULL, 6, 666, 'adventure', '666', 1, 1, '6666', '2024-11-15 08:14:07', '2024-11-15 08:14:07', 1, 2),
(25, '11', NULL, 6, 666, 'adventure', '666', 1, 1, '6666', '2024-11-15 08:14:30', '2024-11-15 08:14:30', 1, 2),
(26, 'ghvh', NULL, 77, 77, 'adventure', '77', 1, 1, '77', '2024-11-15 08:15:20', '2024-11-15 08:15:20', 1, 2),
(27, '11', NULL, 65, 576, 'adventure', '66', 1, 1, '756', '2024-11-15 08:16:24', '2024-11-15 08:16:24', 1, 1),
(28, '6876', NULL, 6876, 687, 'nature', '687', 1, 1, '6786', '2024-11-15 08:16:56', '2024-11-15 08:16:56', 1, 2),
(29, 'guy', NULL, 897, 89, 'adventure', '899', 1, 1, '89', '2024-11-15 08:17:45', '2024-11-15 08:17:45', 1, 2),
(30, 'guy', NULL, 897, 89, 'adventure', '899', 1, 1, '89', '2024-11-15 08:21:25', '2024-11-15 08:21:25', 1, 2),
(31, 'guy', NULL, 897, 89, 'adventure', '899', 1, 1, '89', '2024-11-15 08:21:56', '2024-11-15 08:21:56', 1, 2),
(32, 'guy', NULL, 897, 89, 'adventure', '899', 1, 1, '89', '2024-11-15 08:25:44', '2024-11-15 08:25:44', 1, 2),
(33, '11111', NULL, 24, 32, 'cultural', 'fvd', 1, 1, 'sdv', '2024-11-15 08:52:42', '2024-11-15 08:52:42', 1, 1),
(34, '11111', NULL, 798, 7, 'cultural', 'fvd', 1, 1, '9798', '2024-11-15 10:17:45', '2024-11-15 10:17:45', 1, 2),
(35, 'tryy', NULL, 345, 435, 'cultural', '435', 1, 0, '45345', '2024-11-21 11:43:23', '2024-11-21 11:43:23', 1, 3),
(36, 'tryy', NULL, 345, 435, 'cultural', '435', 1, 0, '45345', '2024-11-21 11:43:35', '2024-11-21 11:43:35', 1, 3),
(37, '34', '432', 324, 423, 'cultural', '432', 1, 1, '342', '2024-11-21 12:36:50', '2024-11-21 12:36:50', 1, 4),
(38, '34', '432', 324, 423, 'cultural', '432', 1, 1, '342', '2024-11-21 12:36:55', '2024-11-21 12:36:55', 1, 4),
(39, '34', '432', 324, 423, 'cultural', '432', 1, 1, '342', '2024-11-21 12:37:08', '2024-11-21 12:37:08', 1, 4),
(40, '453', '534', 345, 534, 'cultural', '345', 1, 1, '354', '2024-11-21 12:38:59', '2024-11-21 12:38:59', 1, 2),
(41, 'testgajef', '432', 324, 423, 'cultural', '423', 1, 1, '432', '2024-11-21 12:39:53', '2024-11-21 12:39:53', 1, 1),
(42, 'fdg', '423', 234, 423, 'nature', '324', 1, 1, '432', '2024-11-21 12:43:48', '2024-11-21 12:43:48', 1, 2),
(43, 'testjjrehgej', '34', 42534, 43, 'nature', '234', 1, 1, '64', '2024-11-21 20:42:20', '2024-11-21 20:42:20', 1, 3),
(44, '657', '765', 567, 567, 'cultural', '756', 1, 1, '567', '2024-11-29 09:30:24', '2024-11-29 09:30:24', 1, 2),
(45, '11', '689', 6, 689, 'cultural', '68', 1, 1, '689', '2024-11-29 09:42:25', '2024-11-29 09:42:25', 1, 4),
(46, '453', '798', 7, 798, 'cultural', '789', 1, 1, '798', '2024-11-29 10:19:29', '2024-11-29 10:19:29', 1, NULL),
(47, '68', '678', 678, 786, 'cultural', '687', 1, 1, '678', '2024-11-29 10:23:05', '2024-11-29 10:23:05', 1, NULL),
(48, '453', '98', 87, 978, 'cultural', '97', 1, 1, '798', '2024-11-30 06:39:31', '2024-11-30 06:39:31', 1, NULL),
(49, 'Khám phá Hạ Long', 'Tour du lịch Hạ Long trọn gói bao gồm khách sạn 4 sao và du thuyền', 3, 20, 'Nature', 'Bus, Cruise', 1, 1, 'Hang Sửng Sốt, Đảo Ti Tốp, Hang Luồn', '2024-11-30 07:34:19', NULL, 1, 1),
(50, 'Hội An City Tour', 'Khám phá phố cổ Hội An, làng nghề truyền thống', 1, 15, 'Cultural', 'Walking, Cyclo', 0, 1, 'Chùa Cầu, Phố cổ, Làng gốm Thanh Hà', '2024-11-30 07:34:19', NULL, 1, 2),
(51, 'Sapa Trekking Adventure', 'Khám phá Sapa với tour trek đến các bản làng dân tộc', 2, 12, 'Adventure', 'Bus, Walking', 1, 1, 'Bản Cát Cát, Thác Bạc, Núi Hàm Rồng', '2024-11-30 07:34:19', NULL, 1, 3),
(52, '576', '576', 576, 576, 'cultural', '567', 1, 1, '567', '2024-12-19 01:08:34', '2024-12-19 01:08:34', 1, NULL),
(53, '234', '423', 422, 243, 'adventure', '423', 1, 1, '234', '2024-12-19 04:53:06', '2024-12-19 04:53:06', 1, NULL),
(54, '76', '678', 67, 678, 'cultural', '678', 1, 1, '678', '2024-12-19 08:11:42', '2024-12-19 08:11:42', 1, NULL),
(55, '97', '798', 798, 978, 'cultural', '78', 1, 1, '798', '2024-12-20 09:29:12', '2024-12-20 09:29:12', 1, NULL),
(57, '86', '57', 678, 78, 'cultural', '67', 1, 1, '678', '2024-12-20 10:11:33', '2024-12-20 10:11:33', 1, NULL),
(58, '687', '76', 689, 68, 'cultural', '68', 1, 1, '68', '2024-12-20 10:12:54', '2024-12-20 10:12:54', 1, NULL),
(59, '978', '789', 78, 87, 'adventure', '789', 1, 1, '789', '2024-12-20 10:20:11', '2024-12-20 10:20:11', 1, NULL),
(60, '687', '78', 68, 6, 'adventure', '768', 1, 1, '678', '2024-12-20 10:24:58', '2024-12-20 10:24:58', 1, NULL),
(62, '768', '86778698dkxfjhbvgfkjsdn', 768, 768, 'cultural', '678', 1, 1, '687', '2024-12-21 07:51:22', '2024-12-21 07:51:22', 1, 7),
(63, '766 dùiyhfieauhfioershgfierhauifc  úidafhis', '876', 4343, 34, 'adventure', '324', 1, 1, NULL, '2024-12-21 09:58:30', '2024-12-21 09:58:30', 1, 8),
(64, '978', '890980', 798, 798, 'adventure', '798', 1, 1, '89', '2024-12-21 21:15:58', '2024-12-21 21:15:58', 1, 9),
(65, '87', '789', 987, 8797, 'adventure', '789', 1, 1, '798', '2024-12-21 21:18:30', '2024-12-21 21:18:30', 1, 10),
(66, '86', 'guhuigu', 68, 68, 'adventure', '678', 1, 1, '687', '2024-12-22 01:22:24', '2024-12-22 01:22:24', 1, 11),
(67, '86876', '868', 86, 86, 'cultural', '86', 1, 1, '68', '2024-12-22 01:24:48', '2024-12-22 01:24:48', 1, 12),
(70, '978', '789', 978, 879, 'adventure', '798', 1, 1, '798', '2024-12-22 01:37:30', '2024-12-22 01:37:30', 1, 14),
(71, '69', '9878', 986, 789, 'adventure', '789', 1, 1, '789', '2024-12-22 01:40:32', '2024-12-22 01:40:32', 1, 15),
(72, '987', '987', 798, 978, 'cultural', '798', 1, 1, '879', '2024-12-22 01:43:42', '2024-12-22 01:43:42', 1, 16),
(73, '987', '7978', 789, 798, 'nature', '879', 1, 1, '789', '2024-12-22 01:48:13', '2024-12-22 01:48:13', 1, 17),
(74, '87', '87897', 798, 879, 'nature', '78', 1, 1, '798', '2024-12-22 01:53:54', '2024-12-22 01:53:54', 1, 18),
(75, '96', '876', 67, 6, 'cultural', '67', 1, 1, '67', '2024-12-22 02:02:33', '2024-12-22 02:02:33', 1, 19),
(76, '546', 'sfgfs', 65, 654, 'nature', '46', 1, 1, '46', '2024-12-22 08:02:34', '2024-12-22 08:02:34', 1, 20),
(80, '567', '567', 567, 657, 'nature', '567', 1, 1, '657', '2024-12-22 08:44:50', '2024-12-22 08:44:50', 1, 24),
(81, '76', '678', 768, 678, 'adventure', '678', 1, 1, '678', '2024-12-22 08:55:10', '2024-12-22 08:55:10', 1, 25),
(82, '876', '657', 768, 567, 'cultural', '657', 1, 1, '567', '2024-12-22 08:57:24', '2024-12-22 08:57:24', 1, 26),
(83, '86', '876', 67, 678, 'cultural', '678', 1, 1, '678', '2024-12-22 09:00:09', '2024-12-22 09:00:09', 1, 27),
(84, '5876', NULL, 687, 678, 'cultural', '678', 1, 1, '678', '2024-12-22 09:26:41', '2024-12-22 09:26:41', 1, 28),
(85, '65', NULL, 567, 567, 'cultural', '567', 1, 1, '567', '2024-12-22 09:29:04', '2024-12-22 09:29:04', 1, 29),
(86, '786', '987789', 789, 789, 'cultural', '789', 1, 1, '987789789', '2024-12-22 10:29:26', '2024-12-22 10:29:26', 1, 30),
(87, 'vinh lỏ', 'dsss', 12, 23, 'cultural', 'Xe du lịch', 1, 1, '111', '2024-12-22 11:03:17', '2024-12-22 11:03:17', 1, 31),
(88, '42', '3124', 3, 1, 'nature', '42343', 1, 1, '33253', '2024-12-23 00:49:35', '2024-12-23 00:49:35', 1, 32),
(89, 'iuy', '97', 97, 897, 'urban', '879', 1, 1, '789', '2024-12-23 07:03:00', '2024-12-23 07:03:00', 1, 33),
(90, '79878', '9877', 789, 798, 'nature', '798', 1, 1, '987', '2024-12-23 07:05:02', '2024-12-23 07:05:02', 1, 34),
(91, '687', '787', 6, 678, 'cultural', '87', 1, 1, '867', '2024-12-23 07:06:50', '2024-12-23 07:06:50', 1, 35),
(93, '435253', '45', 435, 5423, 'cultural', NULL, 1, 1, NULL, '2024-12-23 09:25:50', '2024-12-23 09:25:50', 1, 37),
(94, 'iqwehtoih', '87687', 87, 789, 'adventure', '798', 1, 1, '789', '2024-12-23 11:25:17', '2024-12-23 11:25:17', 1, 38);

-- --------------------------------------------------------

--
-- Table structure for table `tour_images`
--

CREATE TABLE `tour_images` (
  `image_id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT 0,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_images`
--

INSERT INTO `tour_images` (`image_id`, `tour_id`, `image_path`, `is_main`, `uploaded_at`) VALUES
(81, 74, 'tours/mY7DwQIO0EMnlloSaYLwkEjGBvt3EauW3rLuISDO.png', 1, '2024-12-22 08:53:54'),
(82, 74, 'tours/dLvG1JFH6tjZSLLUWJmpjZFsSrrTbc0mGwUFtpCi.png', 0, '2024-12-22 08:53:54'),
(83, 74, 'tours/YRHy6Tv6SrTjYyq9VwN0qV8z4UfIPqdGToTeRIsb.png', 0, '2024-12-22 08:53:54'),
(84, 74, 'tours/6fTlMCwAG4feZRtoPUQnAv5cfG6dFV83d6aLCbRA.png', 0, '2024-12-22 08:53:54'),
(85, 74, 'tours/VWLOHGzqdcFMmLGR0Yq64WHAVGSFE5YSvTGWmhiX.png', 0, '2024-12-22 08:53:54'),
(86, 74, 'tours/pN7yR57afqDrULSWkNdEtYwIa2TJzB226pfV62Zp.png', 0, '2024-12-22 08:53:54'),
(87, 74, 'tours/EU4CTavmS0n9eRy4myT2aDYz1TXNlDWuhOBA4CoY.png', 0, '2024-12-22 08:53:54'),
(88, 74, 'tours/cRoswqiyqJ1I58ta46xL2VTBJ7XT4wzXpDcA3Bhy.png', 0, '2024-12-22 08:53:54'),
(89, 74, 'tours/KgAhLApAo8Ycjf3U6IdwEdhGBIW982br1cCHgKXh.png', 0, '2024-12-22 08:53:54'),
(90, 74, 'tours/wNEGsjb1jaFDl07tlLa3YAqSUZl5n6mSR6tge2YF.png', 0, '2024-12-22 08:53:54'),
(91, 75, 'tours/pRR8Dj6Xm8XoZnr7ICya3qJCMBl70IskmPTRx6EW.png', 1, '2024-12-22 09:02:33'),
(92, 75, 'tours/c46OfdSHCEmIhD7wIiCVMp1xgQUkWbEXR0E6jpkg.png', 0, '2024-12-22 09:02:33'),
(93, 75, 'tours/eJt54IYA1dw32eHUAkGpoDpJg5ySoOklPAe7gqic.png', 0, '2024-12-22 09:02:33'),
(94, 75, 'tours/D2qzJIYonWuR3OH5FBiY4xyYasqLugq4SKxmlVll.png', 0, '2024-12-22 09:02:33'),
(95, 75, 'tours/Gw1PnC0NsKD33fgH9uJ9wvQZzpBZriioUA46xYhL.png', 0, '2024-12-22 09:02:33'),
(96, 76, 'tours/ajOIdbSDrdiIN1JiGo7bPhCdIshIdO54x68RB7Cj.png', 1, '2024-12-22 15:02:34'),
(97, 76, 'tours/R2tS3PmjAuwUTU1omLiZdJ0n9i82RWXO9KgPEQTC.png', 0, '2024-12-22 15:02:34'),
(98, 76, 'tours/acZUr5235N79nyaxv0MYGDx7mA0edBHky4q6rjIY.png', 0, '2024-12-22 15:02:34'),
(99, 76, 'tours/4MTBcb5LKVkj3CmE8IuG0BWoTqI4iuQf553jSGix.png', 0, '2024-12-22 15:02:34'),
(100, 76, 'tours/eyGDmG8X2pyaqmtxkVMK9j2uET6v2Tv6qnLDKpOo.png', 0, '2024-12-22 15:02:34'),
(104, 80, 'tours/tt1oasAIiWio3blHNZHqFI3H0msV9ZDrnOuq1IyX.png', 1, '2024-12-22 15:44:50'),
(105, 81, 'tours/Txbc64eWuRzPa3akhp5u2QZkPnaKDVVcLpuxqPkh.png', 1, '2024-12-22 15:55:10'),
(106, 82, 'tours/hrIeTsCq1sBSiRyuINPeMjNcjWnCoTYUpeOLReEU.png', 1, '2024-12-22 15:57:24'),
(107, 83, 'tours/QB6R5M6kyum4t4GAzRVFz65clFUhaaP618xeuqK8.png', 1, '2024-12-22 16:00:09'),
(108, 86, 'tours/yJXDVwS6ykiXrT5hXosWFTSSn3hlyp6cSPek2qkk.png', 1, '2024-12-22 17:29:26'),
(109, 86, 'tours/OAJ7DcenfobzmkMTMU9kSgu3ZQ8LrZkstIQF3T0B.png', 0, '2024-12-22 17:29:26'),
(110, 86, 'tours/OFfiysjPesqNMoQLKii6PLNmAAMUy5suYhsREK62.png', 0, '2024-12-22 17:29:26'),
(111, 86, 'tours/Xumxo6Wr8HtLY6xgXPKRRO1GfDKl4tkyKvDlMyKW.png', 0, '2024-12-22 17:29:26'),
(112, 86, 'tours/bQo7WmQ1kGrpdlrsniipsBZBQk0BqTzx8K8EBVCh.png', 0, '2024-12-22 17:29:26'),
(113, 87, 'tours/5byffIrSvxI5PeJzHiw1XdVAcL6SnThzNgIm0R14.png', 1, '2024-12-22 18:03:17'),
(114, 88, 'tours/encucBIgHV5mgD7epfZbMRdIfy2OwTD3yqzbWTLO.png', 1, '2024-12-23 07:49:35'),
(115, 88, 'tours/G8v2YvKitNgBmJK06rTI8clhTZyqvQqelMaCbS02.png', 0, '2024-12-23 07:49:35'),
(116, 88, 'tours/3QjlFJaIppo6Io7L8QbvTcfdsLA3vxzJ5mjghDMq.png', 0, '2024-12-23 07:49:35'),
(117, 88, 'tours/b9cWjY4xo1EqJSIur6H0PdXfpkwbpwicyFaKRGew.png', 0, '2024-12-23 07:49:35'),
(118, 88, 'tours/qPGsHbyyw6FtghaOkBGA0UcG1hR1qD7KxjNIYSp5.png', 0, '2024-12-23 07:49:35'),
(119, 90, 'tours/bby0i7ZF7yWXClcMx4HR6SlUgyV96KEoCMLC5HCF.png', 1, '2024-12-23 14:05:02'),
(120, 90, 'tours/urlv5HsGklwvRwhcozEiCAov1QkItIYEZaTkgyA9.png', 0, '2024-12-23 14:05:02'),
(121, 90, 'tours/UHl9il6LYGgpzVihiRU0SfKduTw0pVlOyN877qb4.png', 0, '2024-12-23 14:05:02'),
(122, 90, 'tours/8oX89CRMSKfseWujjGjBFGrDkPSgDi1Yq4wl7eBf.png', 0, '2024-12-23 14:05:02'),
(123, 90, 'tours/YrfSjDyURi5RyIDozyySf8H9idGncrM7X8QTaBvZ.png', 0, '2024-12-23 14:05:02'),
(124, 90, 'tours/cNCbnr0IpZCWl7dAmz24BN8tTpdWPZeGqx2GpWXw.png', 0, '2024-12-23 14:05:02'),
(125, 91, 'tours/HwXFaPfdSwEDT8PXqdNIgd0t3MOexeZJtBmcD1Z7.png', 1, '2024-12-23 14:06:50'),
(126, 91, 'tours/MI2lJNYR8nD1PlJ7F8N4eeOEsPwNTEXrDiAn1pkH.png', 0, '2024-12-23 14:06:50'),
(127, 91, 'tours/Mdm42C734i956btcLvY4kQYGqnBGkCdlftkvAtU8.png', 0, '2024-12-23 14:06:50'),
(128, 91, 'tours/JD6LYybSghP281s0Rq0746tYiWb26zRfJcsu9vsQ.png', 0, '2024-12-23 14:06:50'),
(129, 91, 'tours/2ZBwtRxTcnXYR1PmVfCB5w0HTmj5ipRNg38vaDrj.png', 0, '2024-12-23 14:06:50'),
(130, 91, 'tours/loi5Q9PwW8BNrKC6ZV54izDBsH20k6sbEC5mgqPJ.png', 0, '2024-12-23 14:06:50'),
(131, 94, 'tours/CkCF986OBd7iiA6IX3xk7frrBKkcHxj60wMvVgbA.png', 1, '2024-12-23 18:25:17'),
(132, 94, 'tours/XcD98usd77tM0Pa9Hf9bfEI6g0ypkESHytW4UmL0.png', 0, '2024-12-23 18:25:17'),
(133, 94, 'tours/C8iN14K37zlD91cByOL6JYwd6EU49GaC674yV90P.png', 0, '2024-12-23 18:25:17'),
(134, 94, 'tours/nR3z9oTJQFJssoV359wL6SiJupEdfqNyqtfoDmEs.png', 0, '2024-12-23 18:25:17'),
(135, 94, 'tours/N3uP3KiEgGFbOnCtzBOJ1jVhSj1oCn7p4B8EajKM.png', 0, '2024-12-23 18:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `tour_schedules`
--

CREATE TABLE `tour_schedules` (
  `schedule_id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `day_number` int(11) NOT NULL,
  `departure_date` datetime NOT NULL,
  `description` text NOT NULL,
  `return_date` datetime DEFAULT NULL,
  `available_slots` int(11) DEFAULT NULL,
  `status` enum('OPEN','FULL','COMPLETED','CANCELLED') DEFAULT 'OPEN',
  `meeting_point` varchar(200) DEFAULT NULL,
  `meeting_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_schedules`
--

INSERT INTO `tour_schedules` (`schedule_id`, `tour_id`, `day_number`, `departure_date`, `description`, `return_date`, `available_slots`, `status`, `meeting_point`, `meeting_time`) VALUES
(177, 81, 0, '2024-12-07 22:56:00', '768', NULL, NULL, 'OPEN', '768 Yên Ninh, Phường Minh Tân, Thành phố Yên Bái, Tỉnh Yên Bái', '14:59:00'),
(178, 82, 0, '2024-12-09 13:56:00', '6575765678587tdrhgyfdgy', NULL, NULL, 'OPEN', '567 Đường Duy Tân, Kon Tum, Kon Tum', '13:00:00'),
(179, 82, 0, '2024-12-13 22:59:00', '567', NULL, NULL, 'OPEN', '499 Hồ Thị Hương, Bàu Trâm, Long Khánh, Đồng Nai 75655', '13:00:00'),
(180, 83, 0, '2024-12-22 13:59:00', '678', NULL, NULL, 'OPEN', '786, Quốc lộ 20, Tân Phú, Đồng Nai', '13:02:00'),
(181, 83, 0, '2024-12-19 13:59:00', '678', NULL, NULL, 'OPEN', '678 Đường Bà Triệu, Lạng Sơn, Lạng Sơn', '15:05:00'),
(182, 84, 1, '2024-12-18 23:29:00', '8767', NULL, NULL, 'OPEN', '867, Trần Hưng Đạo, khóm 1, Sóc Trăng', '16:26:00'),
(183, 84, 2, '2024-12-22 13:26:00', '876', NULL, NULL, 'OPEN', '687, Đường Trần Não, Bình Khánh, Quận 2, Hồ Chí Minh', '14:29:00'),
(184, 85, 1, '2024-12-21 23:28:00', '657', NULL, NULL, 'OPEN', '576 Yên Ninh, Yên Ninh, Yên Bái, Yên Bái', '14:28:00'),
(185, 85, 2, '2024-12-11 13:28:00', '765', NULL, NULL, 'OPEN', '765 Tân Mai, Tân Mai, Hoàng Mai, Hà Nội', '14:28:00'),
(186, 86, 1, '2024-12-05 02:28:00', '798798', NULL, NULL, 'OPEN', '987F+CRM, Mỹ Tho, Tiền Giang', '14:31:00'),
(187, 86, 2, '2024-12-13 03:28:00', 'oyihiuyh', NULL, NULL, 'OPEN', 'Uy Nỗ, Đông Anh, Hà Nội', '00:32:00'),
(188, 87, 1, '2024-12-01 01:00:00', 'Ngày 1:\r\n\r\nSáng: Khởi hành từ Hà Nội đến Hạ Long\r\nTrưa: Check-in du thuyền, dùng bữa trưa\r\nChiều: Thăm hang Sửng Sốt, chèo kayak tại vùng biển Hang Luồn\r\nTối: Ăn tối trên tàu, tham gia câu mực đêm', NULL, NULL, 'OPEN', 'Bến xe Miền Đông, Đinh Bộ Lĩnh, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', '03:03:00'),
(189, 87, 2, '2024-12-04 01:01:00', 'Ngày 2:\r\n\r\nSáng: Tập Tai Chi, thăm làng chài Cửa Vạn\r\nTrưa: Tham quan đảo Ti Tốp, tắm biển\r\nChiều: Khám phá hang Mê Cung\r\nTối: BBQ trên tàu, ngắm hoàng hôn', NULL, NULL, 'OPEN', 'Trà Sữa Pé Po, 499 Hồ Thị Hương, Bàu Trâm, Long Khánh, Đồng Nai', '03:04:00'),
(190, 87, 3, '2024-12-19 01:01:00', 'Sáng: Thăm hang Trống, đảo Ngọc Vừng\r\nTrưa: Trả phòng, ăn trưa\r\nChiều: Về Hà Nội, kết thúc hành trình', NULL, NULL, 'OPEN', 'Bến Tre', '03:04:00'),
(191, 88, 1, '2024-12-10 14:51:00', '3412', NULL, NULL, 'OPEN', '32, Lê Lợi, Cà Mau', '14:52:00'),
(192, 89, 1, '2024-12-07 21:04:00', '869t uykjhgjg', NULL, NULL, 'OPEN', '79, Lê Chân, Yên Bái', '13:06:00'),
(193, 89, 2, '2024-12-13 21:05:00', 'uyguy', NULL, NULL, 'OPEN', 'FPT, 101 Láng Hạ, Phường Láng Hạ, Quận Đống Đa, Thành phố Hà Nội', '12:02:00'),
(194, 90, 1, '2024-12-12 21:07:00', '0797098', NULL, NULL, 'OPEN', '98, Đấu Mã, Bắc Ninh', '23:06:00'),
(195, 90, 2, '2024-12-23 21:06:00', '98798798', NULL, NULL, 'OPEN', '97 Lê Lợi, Phường 2, Thành phố Cà Mau, Tỉnh Cà Mau', '12:07:00'),
(196, 91, 1, '2024-12-12 12:06:00', '78678', NULL, NULL, 'OPEN', '87, Đường Tạ Uyên, Cà Mau', '23:08:00'),
(197, 91, 2, '2024-12-19 21:10:00', '687687', NULL, NULL, 'OPEN', '87, Đường Tạ Uyên, Cà Mau', '13:10:00'),
(198, 93, 1, '2024-12-05 23:26:00', '5346', NULL, NULL, 'OPEN', '324, Bời Lời, Tây Ninh', '13:27:00'),
(199, 94, 1, '2024-12-11 01:28:00', '987vhvh', NULL, NULL, 'OPEN', '798, Nguyễn Công Trứ, Đông Hồ, Ninh Bình', '03:26:00'),
(200, 94, 2, '2024-12-10 04:25:00', '8ugyguyg', NULL, NULL, 'OPEN', '43, Tổ 11, Hòa Bình', '16:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `id_card` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('ADMIN','STAFF','CUSTOMER') NOT NULL DEFAULT 'CUSTOMER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `remember_token`, `full_name`, `phone`, `address`, `id_card`, `created_at`, `role`) VALUES
(4, 'phamngocpho1606@gmail.com', '$2y$12$3QuTHj4OBN3HJYIehoqPO.Po5.NWiS8nnFBzxu1L/5ZPvciRP2jkO', '', 'Phổ', '000', NULL, NULL, '2024-11-08 12:02:43', 'CUSTOMER'),
(5, 'phamngocpho1@gmail.com', '$2y$12$pWZxqLXFq8rsHWPKKSzMMef4ecO1Zxn8CLBVombPD60ox9CSTPDBG', '', 'Phạm Ngọc Phổ', '6465699890', '11430 N Cave Creek Rd', NULL, '2024-11-08 12:03:16', 'CUSTOMER'),
(10, 'phamngocpho16061@gmail.com', '$2y$12$2MTT2dGd1ynZw5P06iTFFeCUE4SiD3eMiWo9la64hUe8ksD6cE/6y', '', 'Phạm Ngọc Phổ', NULL, NULL, NULL, '2024-11-12 06:57:35', 'CUSTOMER'),
(11, 'admin@web.com', '$2y$12$jdIUNsnV1I4rlMcAH0/3YuKAl.EWPfI8pq3rqg63.pCO1B.RckToC', 'OpeZWNsxopBkO5a4yKnNDujo3CbUXGGKV4jTIiMXEQm7XbMJJ4c3Hi3bpHHl', 'Administrator', NULL, NULL, NULL, '2024-11-12 10:22:30', 'ADMIN'),
(12, 'test@gmail.com', '$2y$12$63W5D3h31IrdFHw9g2wFo.3VtybjQLT4jBakCd8xxoRgUCnnLpTlW', '', 'Phạm Ngọc Phổ', NULL, NULL, NULL, '2024-11-15 15:30:09', 'CUSTOMER'),
(16, 'test02@gmail.com', '$2y$12$.IU128FBSQyfn3YC/hEiFO3iA0gTwtgTsFb3iDxmH64FMlIKOmg6C', NULL, 'Phạm Ngọc Phổ', NULL, NULL, NULL, '2024-12-21 12:53:45', 'CUSTOMER'),
(17, 'gocpho06@gmail.com', '$2y$12$gaRL7fTJcyLNoekzKVGVPO2uJx2VsDopZ83b06FuRNKegud851EfW', NULL, 'Ngoc Pho Pham', '6465699890', '11430 N Cave Creek Rd', NULL, '2024-12-23 17:38:13', 'CUSTOMER');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `tour_id`, `created_at`, `updated_at`) VALUES
(2, 11, 93, '2024-12-23 10:40:42', '2024-12-23 10:40:42'),
(3, 11, 91, '2024-12-23 10:41:03', '2024-12-23 10:41:03'),
(4, 11, 90, '2024-12-23 10:41:04', '2024-12-23 10:41:04'),
(5, 11, 89, '2024-12-23 10:41:05', '2024-12-23 10:41:05'),
(6, 12, 94, '2024-12-23 14:07:52', '2024-12-23 14:07:52'),
(7, 12, 93, '2024-12-23 14:07:53', '2024-12-23 14:07:53'),
(8, 12, 91, '2024-12-23 14:07:54', '2024-12-23 14:07:54'),
(9, 12, 90, '2024-12-23 14:07:55', '2024-12-23 14:07:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_tour_id_foreign` (`tour_id`),
  ADD KEY `bookings_schedule_id_foreign` (`schedule_id`),
  ADD KEY `idx_booking_status` (`status`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `contact_forms`
--
ALTER TABLE `contact_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_details`
--
ALTER TABLE `price_details`
  ADD PRIMARY KEY (`price_detail_id`),
  ADD KEY `price_list_id` (`price_list_id`);

--
-- Indexes for table `price_lists`
--
ALTER TABLE `price_lists`
  ADD PRIMARY KEY (`price_list_id`),
  ADD KEY `idx_price_list_dates` (`valid_from`,`valid_to`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_tour_id_foreign` (`tour_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `tours_location_id_foreign` (`location_id`),
  ADD KEY `idx_tour_status` (`is_active`);

--
-- Indexes for table `tour_images`
--
ALTER TABLE `tour_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `tour_images_tour_id_foreign` (`tour_id`);

--
-- Indexes for table `tour_schedules`
--
ALTER TABLE `tour_schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `idx_schedule_date` (`departure_date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `idx_user_email` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_tour_id_foreign` (`tour_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `detail_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_forms`
--
ALTER TABLE `contact_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `price_details`
--
ALTER TABLE `price_details`
  MODIFY `price_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `price_lists`
--
ALTER TABLE `price_lists`
  MODIFY `price_list_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `tour_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `tour_images`
--
ALTER TABLE `tour_images`
  MODIFY `image_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `tour_schedules`
--
ALTER TABLE `tour_schedules`
  MODIFY `schedule_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `tour_schedules` (`schedule_id`),
  ADD CONSTRAINT `bookings_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`),
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);

--
-- Constraints for table `price_details`
--
ALTER TABLE `price_details`
  ADD CONSTRAINT `price_details_ibfk_1` FOREIGN KEY (`price_list_id`) REFERENCES `price_lists` (`price_list_id`);

--
-- Constraints for table `price_lists`
--
ALTER TABLE `price_lists`
  ADD CONSTRAINT `price_lists_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`);

--
-- Constraints for table `tour_images`
--
ALTER TABLE `tour_images`
  ADD CONSTRAINT `tour_images_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`);

--
-- Constraints for table `tour_schedules`
--
ALTER TABLE `tour_schedules`
  ADD CONSTRAINT `tour_schedules_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`tour_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
