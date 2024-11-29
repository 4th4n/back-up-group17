-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 03:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project17`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `description`, `image`, `quantity`, `category`, `created_at`, `updated_at`) VALUES
(11, 'burgerssss', 30.00, NULL, '1731138299.jpg', 2, 'Snacks', '2024-11-08 23:44:59', '2024-11-28 18:20:31'),
(13, 'dfs', 9.00, '4zdgg', NULL, 2, 'Breakfast', '2024-11-10 21:15:15', '2024-11-28 18:20:56'),
(14, 'carding', 122.00, NULL, '1731304141.jpg', 0, 'Breakfast', '2024-11-10 21:49:01', '2024-11-20 17:08:07'),
(15, 'burger', 23.00, NULL, '1731470813.jpg', 1, 'Breakfast', '2024-11-12 20:06:53', '2024-11-28 17:10:55'),
(17, 'pizza', 12.00, '2', '1732087998.jpg', 0, 'Chocolates', '2024-11-19 23:33:18', '2024-11-25 00:01:06'),
(18, 'jonathan', 18.00, NULL, '1732108799.jpg', 0, 'Junk foods', '2024-11-20 05:19:59', '2024-11-20 05:20:27'),
(19, 'rimart', 12.00, NULL, NULL, 0, 'Drinks', '2024-11-20 17:16:30', '2024-11-20 17:17:18'),
(20, 'jonathan', 22.00, NULL, NULL, 118, 'Cup Noodles', '2024-11-27 07:04:17', '2024-11-27 07:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(19, '0001_01_01_000000_create_users_table', 1),
(20, '0001_01_01_000001_create_cache_table', 1),
(21, '0001_01_01_000002_create_jobs_table', 1),
(22, '2024_10_16_033750_create_items_table', 1),
(23, '2024_10_16_041442_create_orders_table', 1),
(24, '2024_10_16_041443_create_order_items_table', 1),
(25, '2024_10_16_061245_add_quantity_to_items_table', 1),
(26, '2024_10_18_070302_add_image_to_items_table', 1),
(29, '2024_11_04_062435_create_menus_table', 2),
(30, '2024_11_05_024736_create_categories_table', 2),
(37, '2024_11_07_060120_make_category_nullable_in_items_table', 3),
(38, '2024_11_07_060453_add_category_to_items_table', 3),
(39, '2024_11_08_041605_add_completed_to_orders_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `total_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `total_price`, `created_at`, `updated_at`, `completed`) VALUES
(33, '', 30.00, '2024-11-14 03:28:45', '2024-11-14 03:28:45', 0),
(34, '', 9.00, '2024-11-14 03:46:19', '2024-11-14 03:46:19', 0),
(35, '', 122.00, '2024-11-18 03:55:48', '2024-11-18 03:55:48', 0),
(36, '', 60.00, '2024-11-19 21:47:47', '2024-11-19 21:47:47', 0),
(37, '', 131.00, '2024-11-19 22:02:26', '2024-11-19 22:02:26', 0),
(38, '', 122.00, '2024-11-19 23:32:00', '2024-11-19 23:32:00', 0),
(39, '', 12.00, '2024-11-19 23:33:35', '2024-11-19 23:33:35', 0),
(40, '', 60.00, '2024-11-20 04:17:36', '2024-11-20 04:17:36', 0),
(41, '', 30.00, '2024-11-20 04:17:44', '2024-11-20 04:17:44', 0),
(42, '', 30.00, '2024-11-20 04:17:50', '2024-11-20 04:17:50', 0),
(43, '', 0.00, '2024-11-20 04:44:07', '2024-11-20 04:44:07', 0),
(44, '', 122.00, '2024-11-20 05:12:04', '2024-11-20 05:12:04', 0),
(45, '', 36.00, '2024-11-20 05:20:27', '2024-11-20 05:20:27', 0),
(58, 'ORD-6747252792D1A', 23.00, '2024-11-27 05:56:55', '2024-11-27 05:56:55', 0),
(59, 'ORD-67472CB988DDF', 23.00, '2024-11-27 06:29:13', '2024-11-27 06:29:13', 0),
(60, 'ORD-67472DBC3F7BB', 23.00, '2024-11-27 06:33:32', '2024-11-27 06:33:32', 0),
(61, 'ORD-67472E76608AF', 23.00, '2024-11-27 06:36:38', '2024-11-27 06:36:38', 0),
(62, 'ORD-67472E8F0C93A', 23.00, '2024-11-27 06:37:03', '2024-11-27 06:37:03', 0),
(63, 'ORD-67472FD4DD904', 23.00, '2024-11-27 06:42:28', '2024-11-27 06:42:28', 0),
(64, 'ORD-67473093D0F0A', 23.00, '2024-11-27 06:45:39', '2024-11-27 06:45:39', 0),
(65, 'ORD-674731508206C', 23.00, '2024-11-27 06:48:48', '2024-11-27 06:48:48', 0),
(66, 'ORD-674733A23676F', 23.00, '2024-11-27 06:58:42', '2024-11-27 06:58:42', 0),
(67, 'ORD-6747351A9A2DA', 22.00, '2024-11-27 07:04:58', '2024-11-27 07:04:58', 0),
(68, 'ORD-67473650b4e24', 45.00, '2024-11-27 07:10:08', '2024-11-27 07:10:08', 0),
(69, 'ORD-674736c103233', 45.00, '2024-11-27 07:12:01', '2024-11-27 07:12:01', 0),
(70, 'ORD-6747377B6E35E', 23.00, '2024-11-27 07:15:07', '2024-11-27 07:15:07', 0),
(71, 'ORD-6747382245E03', 23.00, '2024-11-27 07:17:54', '2024-11-27 07:17:54', 0),
(72, 'ORD-6747383D6F977', 23.00, '2024-11-27 07:18:21', '2024-11-27 07:18:21', 0),
(73, 'ORD-674739BF40F9E', 46.00, '2024-11-27 07:24:47', '2024-11-27 07:24:47', 0),
(74, 'ORD-6749149F537A4', 23.00, '2024-11-28 17:10:55', '2024-11-28 17:10:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`, `price`, `image`, `created_at`, `updated_at`) VALUES
(49, 33, 11, 1, 30.00, NULL, '2024-11-14 03:28:45', '2024-11-14 03:28:45'),
(50, 34, 13, 1, 9.00, NULL, '2024-11-14 03:46:19', '2024-11-14 03:46:19'),
(51, 35, 14, 1, 122.00, NULL, '2024-11-18 03:55:48', '2024-11-18 03:55:48'),
(52, 36, 11, 2, 30.00, NULL, '2024-11-19 21:47:47', '2024-11-19 21:47:47'),
(53, 37, 13, 1, 9.00, NULL, '2024-11-19 22:02:26', '2024-11-19 22:02:26'),
(54, 37, 14, 1, 122.00, NULL, '2024-11-19 22:02:26', '2024-11-19 22:02:26'),
(56, 38, 14, 1, 122.00, NULL, '2024-11-19 23:32:00', '2024-11-19 23:32:00'),
(57, 39, 17, 1, 12.00, NULL, '2024-11-19 23:33:35', '2024-11-19 23:33:35'),
(58, 40, 11, 2, 30.00, NULL, '2024-11-20 04:17:36', '2024-11-20 04:17:36'),
(59, 41, 11, 1, 30.00, NULL, '2024-11-20 04:17:44', '2024-11-20 04:17:44'),
(60, 42, 11, 1, 30.00, NULL, '2024-11-20 04:17:50', '2024-11-20 04:17:50'),
(62, 44, 14, 1, 122.00, NULL, '2024-11-20 05:12:04', '2024-11-20 05:12:04'),
(63, 45, 18, 2, 18.00, NULL, '2024-11-20 05:20:27', '2024-11-20 05:20:27'),
(77, 58, 15, 1, 23.00, NULL, '2024-11-27 05:56:55', '2024-11-27 05:56:55'),
(78, 59, 15, 1, 23.00, NULL, '2024-11-27 06:29:13', '2024-11-27 06:29:13'),
(79, 60, 15, 1, 23.00, NULL, '2024-11-27 06:33:32', '2024-11-27 06:33:32'),
(80, 61, 15, 1, 23.00, NULL, '2024-11-27 06:36:38', '2024-11-27 06:36:38'),
(81, 62, 15, 1, 23.00, NULL, '2024-11-27 06:37:03', '2024-11-27 06:37:03'),
(82, 63, 15, 1, 23.00, NULL, '2024-11-27 06:42:28', '2024-11-27 06:42:28'),
(83, 64, 15, 1, 23.00, NULL, '2024-11-27 06:45:39', '2024-11-27 06:45:39'),
(84, 65, 15, 1, 23.00, NULL, '2024-11-27 06:48:48', '2024-11-27 06:48:48'),
(85, 66, 15, 1, 23.00, NULL, '2024-11-27 06:58:42', '2024-11-27 06:58:42'),
(86, 67, 20, 1, 22.00, NULL, '2024-11-27 07:04:58', '2024-11-27 07:04:58'),
(87, 68, 15, 1, 23.00, NULL, '2024-11-27 07:10:08', '2024-11-27 07:10:08'),
(88, 68, 20, 1, 22.00, NULL, '2024-11-27 07:10:08', '2024-11-27 07:10:08'),
(89, 69, 15, 1, 23.00, NULL, '2024-11-27 07:12:01', '2024-11-27 07:12:01'),
(90, 69, 20, 1, 22.00, NULL, '2024-11-27 07:12:01', '2024-11-27 07:12:01'),
(91, 70, 15, 1, 23.00, NULL, '2024-11-27 07:15:07', '2024-11-27 07:15:07'),
(92, 71, 15, 1, 23.00, NULL, '2024-11-27 07:17:54', '2024-11-27 07:17:54'),
(93, 72, 15, 1, 23.00, NULL, '2024-11-27 07:18:21', '2024-11-27 07:18:21'),
(94, 73, 15, 2, 23.00, NULL, '2024-11-27 07:24:47', '2024-11-27 07:24:47'),
(95, 74, 15, 1, 23.00, NULL, '2024-11-28 17:10:55', '2024-11-28 17:10:55');

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
('c3vWQA208Cu3CHOWmJP1wcpuezPS7anvwXkQ6wIa', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Avast/130.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZzV6ODdwT2U4enk4cUJXUDE5dHREck84TWExalB1dFd4MUJ0NjNLQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZXN0b2NrIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1732847108);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2024-11-07 21:33:15', '$2y$12$qSfO8G4x9q7.A4BiLCqeAeGo8xkrhxxQ1RyoyeImlN86oeSfdsiUi', '9rlCGploM5', '2024-11-07 21:33:15', '2024-11-07 21:33:15'),
(3, 'Guido Grimes', 'zhirthe@example.com', '2024-11-07 21:35:34', '$2y$12$pW9FsDnf8n53lspo38DeQO4XHTGB.Pv1aCLQwLh6.vv95.FyOf5ae', '7xhpS1g0CWQAHQvc4ToMarGxk60et6R87ec9hb9Hftg9hUkoAEB0IxLEQ9EQ', '2024-11-07 21:35:34', '2024-11-07 21:35:34'),
(4, 'jonathan Dreo', 'dreo@gmail.com', '2024-11-07 22:01:47', '$2y$12$ux2EjF/TO.0XlW82X/D.reCmBXhY88Escjco3ppRxysxIGZbhsWry', 'hYU16lfMgGJIYyk0Ppm9nRkFs1VaDjG88kGRdgiGFPDTDXgpZQTkTaxtL3LX', '2024-11-07 22:01:47', '2024-11-07 22:01:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

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
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
