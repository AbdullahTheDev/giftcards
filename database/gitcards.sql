-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 08:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gitcards`
--

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_05_221830_create_verification_codes_table', 2),
(6, '2024_09_05_221831_create_verification_codes_table', 3);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` text DEFAULT NULL,
  `last_name` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `qrcode` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `qrcode`, `email_verified_at`, `password`, `remember_token`, `last_login`, `created_at`, `updated_at`) VALUES
(100000, 'Abdullah', 'Waseem', 'user@yopmail.com', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(6.897)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M10 0L10 1L9 1L9 2L8 2L8 3L9 3L9 5L10 5L10 7L11 7L11 8L12 8L12 9L11 9L11 10L10 10L10 9L9 9L9 6L8 6L8 8L4 8L4 9L5 9L5 10L6 10L6 11L4 11L4 10L3 10L3 11L2 11L2 10L1 10L1 9L3 9L3 8L0 8L0 10L1 10L1 11L0 11L0 13L1 13L1 14L0 14L0 16L1 16L1 18L0 18L0 19L1 19L1 20L0 20L0 21L1 21L1 20L2 20L2 19L1 19L1 18L2 18L2 16L3 16L3 17L4 17L4 18L3 18L3 19L4 19L4 20L3 20L3 21L7 21L7 20L8 20L8 25L9 25L9 26L8 26L8 29L12 29L12 28L14 28L14 29L15 29L15 28L16 28L16 27L17 27L17 29L19 29L19 28L18 28L18 27L19 27L19 26L21 26L21 27L20 27L20 29L21 29L21 27L22 27L22 26L21 26L21 25L23 25L23 27L24 27L24 28L22 28L22 29L24 29L24 28L25 28L25 23L26 23L26 22L27 22L27 23L29 23L29 21L26 21L26 22L25 22L25 20L26 20L26 18L27 18L27 20L28 20L28 19L29 19L29 16L28 16L28 15L29 15L29 12L28 12L28 11L29 11L29 9L28 9L28 10L26 10L26 9L27 9L27 8L26 8L26 9L25 9L25 10L24 10L24 12L25 12L25 14L23 14L23 12L22 12L22 11L21 11L21 10L23 10L23 8L21 8L21 10L20 10L20 11L17 11L17 10L18 10L18 8L20 8L20 7L21 7L21 6L20 6L20 5L21 5L21 4L19 4L19 3L20 3L20 2L21 2L21 1L20 1L20 0L19 0L19 1L17 1L17 2L19 2L19 3L18 3L18 4L19 4L19 6L18 6L18 7L17 7L17 3L16 3L16 2L15 2L15 3L16 3L16 5L14 5L14 3L12 3L12 2L11 2L11 3L12 3L12 5L10 5L10 3L9 3L9 2L10 2L10 1L11 1L11 0ZM14 0L14 1L13 1L13 2L14 2L14 1L15 1L15 0ZM13 5L13 7L12 7L12 6L11 6L11 7L12 7L12 8L13 8L13 9L14 9L14 10L13 10L13 11L14 11L14 10L15 10L15 9L16 9L16 8L17 8L17 7L16 7L16 6L15 6L15 7L14 7L14 5ZM19 6L19 7L20 7L20 6ZM15 7L15 8L16 8L16 7ZM6 9L6 10L7 10L7 11L6 11L6 12L7 12L7 11L10 11L10 10L9 10L9 9ZM25 10L25 11L26 11L26 13L27 13L27 14L25 14L25 15L24 15L24 16L23 16L23 18L24 18L24 20L25 20L25 18L26 18L26 17L27 17L27 18L28 18L28 17L27 17L27 14L28 14L28 13L27 13L27 11L26 11L26 10ZM11 11L11 12L12 12L12 14L11 14L11 15L10 15L10 14L9 14L9 13L10 13L10 12L9 12L9 13L8 13L8 14L9 14L9 17L10 17L10 19L9 19L9 21L11 21L11 20L12 20L12 22L10 22L10 24L11 24L11 25L10 25L10 26L9 26L9 28L10 28L10 27L11 27L11 28L12 28L12 27L11 27L11 25L12 25L12 24L13 24L13 25L14 25L14 26L13 26L13 27L14 27L14 26L15 26L15 27L16 27L16 26L17 26L17 27L18 27L18 26L17 26L17 23L18 23L18 22L17 22L17 19L16 19L16 18L18 18L18 19L20 19L20 20L22 20L22 17L21 17L21 16L22 16L22 15L23 15L23 14L22 14L22 15L20 15L20 14L21 14L21 11L20 11L20 12L18 12L18 13L19 13L19 15L18 15L18 16L19 16L19 17L17 17L17 15L16 15L16 14L17 14L17 13L16 13L16 14L14 14L14 12L12 12L12 11ZM15 11L15 12L16 12L16 11ZM2 12L2 14L1 14L1 15L3 15L3 16L4 16L4 17L5 17L5 20L7 20L7 19L8 19L8 17L6 17L6 16L8 16L8 15L6 15L6 16L4 16L4 15L5 15L5 13L4 13L4 14L3 14L3 12ZM6 13L6 14L7 14L7 13ZM13 14L13 15L14 15L14 14ZM11 15L11 16L12 16L12 17L11 17L11 19L10 19L10 20L11 20L11 19L12 19L12 20L14 20L14 22L13 22L13 23L14 23L14 22L15 22L15 20L16 20L16 19L15 19L15 18L14 18L14 17L13 17L13 16L12 16L12 15ZM15 15L15 16L16 16L16 15ZM19 15L19 16L20 16L20 15ZM25 15L25 16L26 16L26 15ZM6 18L6 19L7 19L7 18ZM13 18L13 19L14 19L14 18ZM20 18L20 19L21 19L21 18ZM19 21L19 22L20 22L20 21ZM21 21L21 24L24 24L24 21ZM16 22L16 23L15 23L15 24L16 24L16 23L17 23L17 22ZM22 22L22 23L23 23L23 22ZM11 23L11 24L12 24L12 23ZM19 24L19 25L20 25L20 24ZM28 24L28 25L26 25L26 27L27 27L27 29L29 29L29 28L28 28L28 27L29 27L29 24ZM27 26L27 27L28 27L28 26ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM22 0L22 7L29 7L29 0ZM23 1L23 6L28 6L28 1ZM24 2L24 5L27 5L27 2ZM0 22L0 29L7 29L7 22ZM1 23L1 28L6 28L6 23ZM2 24L2 27L5 27L5 24Z\" fill=\"#000000\"/></g></g></svg>\n', NULL, '$2y$12$7dOKNQS7eG23kc/bO6Vrt.Azlvd/D/m51gMqhDrjvbWKMco7aHCve', NULL, '2024-09-06 17:25:58', '2024-09-05 17:34:27', '2024-09-06 12:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `verification_codes_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100001;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
