-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 08:24 PM
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
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text DEFAULT NULL,
  `banner_type` text DEFAULT NULL,
  `banner` text DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `name`, `image`, `banner_type`, `banner`, `event_date`, `description`, `location`, `created_at`, `updated_at`) VALUES
(1, 100003, '100003', 'uploads/images/1725663444_bruce-mars.jpg', NULL, 'uploads/banners/1725663444_ivana-squares.jpg', '2024-09-26 00:00:00', NULL, NULL, '2024-09-06 22:30:15', '2024-09-06 22:57:58'),
(2, 100000, '100000', NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-06 22:30:15', '2024-09-06 22:30:15');

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
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `id` int(11) NOT NULL,
  `gift_id` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sender` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `amount` text DEFAULT NULL,
  `admin_fee` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `payment_details` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`id`, `gift_id`, `user_id`, `sender`, `message`, `amount`, `admin_fee`, `date`, `payment_details`, `created_at`, `updated_at`) VALUES
(2, 'GFT-DUPPNSGK', 100000, '4', 'Et excepturi ex id v', '1', '5', '2024-09-09 17:39:16', 'Stripe\\Charge JSON: {\n    \"id\": \"ch_3PxBYVH9USr1IGtU0NnC4tRl\",\n    \"object\": \"charge\",\n    \"amount\": 100,\n    \"amount_captured\": 100,\n    \"amount_refunded\": 0,\n    \"application\": null,\n    \"application_fee\": null,\n    \"application_fee_amount\": null,\n    \"balance_transaction\": \"txn_3PxBYVH9USr1IGtU0IDSUAZN\",\n    \"billing_details\": {\n        \"address\": {\n            \"city\": null,\n            \"country\": null,\n            \"line1\": null,\n            \"line2\": null,\n            \"postal_code\": \"10001\",\n            \"state\": null\n        },\n        \"email\": null,\n        \"name\": null,\n        \"phone\": null\n    },\n    \"calculated_statement_descriptor\": \"AD POSSIMUS IN QUI SU\",\n    \"captured\": true,\n    \"created\": 1725903555,\n    \"currency\": \"usd\",\n    \"customer\": null,\n    \"description\": \"Et excepturi ex id v\",\n    \"destination\": null,\n    \"dispute\": null,\n    \"disputed\": false,\n    \"failure_balance_transaction\": null,\n    \"failure_code\": null,\n    \"failure_message\": null,\n    \"fraud_details\": [],\n    \"invoice\": null,\n    \"livemode\": false,\n    \"metadata\": [],\n    \"on_behalf_of\": null,\n    \"order\": null,\n    \"outcome\": {\n        \"network_status\": \"approved_by_network\",\n        \"reason\": null,\n        \"risk_level\": \"normal\",\n        \"risk_score\": 58,\n        \"seller_message\": \"Payment complete.\",\n        \"type\": \"authorized\"\n    },\n    \"paid\": true,\n    \"payment_intent\": null,\n    \"payment_method\": \"card_1PxBYUH9USr1IGtUEBHJdDyW\",\n    \"payment_method_details\": {\n        \"card\": {\n            \"amount_authorized\": 100,\n            \"authorization_code\": null,\n            \"brand\": \"visa\",\n            \"checks\": {\n                \"address_line1_check\": null,\n                \"address_postal_code_check\": \"pass\",\n                \"cvc_check\": \"pass\"\n            },\n            \"country\": \"US\",\n            \"exp_month\": 11,\n            \"exp_year\": 2025,\n            \"extended_authorization\": {\n                \"status\": \"disabled\"\n            },\n            \"fingerprint\": \"AoMkA6oipmawIXxi\",\n            \"funding\": \"credit\",\n            \"incremental_authorization\": {\n                \"status\": \"unavailable\"\n            },\n            \"installments\": null,\n            \"last4\": \"1111\",\n            \"mandate\": null,\n            \"multicapture\": {\n                \"status\": \"unavailable\"\n            },\n            \"network\": \"visa\",\n            \"network_token\": {\n                \"used\": false\n            },\n            \"overcapture\": {\n                \"maximum_amount_capturable\": 100,\n                \"status\": \"unavailable\"\n            },\n            \"three_d_secure\": null,\n            \"wallet\": null\n        },\n        \"type\": \"card\"\n    },\n    \"receipt_email\": null,\n    \"receipt_number\": null,\n    \"receipt_url\": \"https:\\/\\/pay.stripe.com\\/receipts\\/payment\\/CAcaFwoVYWNjdF8xTHNDVHJIOVVTcjFJR3RVKMTl_LYGMgY89GpxkO46LBYTdPoqn31oG90omb3laUpPJaZHigW9UtWwWV2yFNroemmyvPS2NuraP76F\",\n    \"refunded\": false,\n    \"review\": null,\n    \"shipping\": null,\n    \"source\": {\n        \"id\": \"card_1PxBYUH9USr1IGtUEBHJdDyW\",\n        \"object\": \"card\",\n        \"address_city\": null,\n        \"address_country\": null,\n        \"address_line1\": null,\n        \"address_line1_check\": null,\n        \"address_line2\": null,\n        \"address_state\": null,\n        \"address_zip\": \"10001\",\n        \"address_zip_check\": \"pass\",\n        \"brand\": \"Visa\",\n        \"country\": \"US\",\n        \"customer\": null,\n        \"cvc_check\": \"pass\",\n        \"dynamic_last4\": null,\n        \"exp_month\": 11,\n        \"exp_year\": 2025,\n        \"fingerprint\": \"AoMkA6oipmawIXxi\",\n        \"funding\": \"credit\",\n        \"last4\": \"1111\",\n        \"metadata\": [],\n        \"name\": null,\n        \"tokenization_method\": null,\n        \"wallet\": null\n    },\n    \"source_transfer\": null,\n    \"statement_descriptor\": null,\n    \"statement_descriptor_suffix\": null,\n    \"status\": \"succeeded\",\n    \"transfer_data\": null,\n    \"transfer_group\": null\n}', '2024-09-09 17:39:16', '2024-09-09 17:39:16'),
(3, 'GFT-ER6ZOYZS', 100000, '5', 'Test', '6', '5', '2024-09-09 18:20:16', 'Stripe\\Charge JSON: {\n    \"id\": \"ch_3PxCCBH9USr1IGtU18VFTnSS\",\n    \"object\": \"charge\",\n    \"amount\": 600,\n    \"amount_captured\": 600,\n    \"amount_refunded\": 0,\n    \"application\": null,\n    \"application_fee\": null,\n    \"application_fee_amount\": null,\n    \"balance_transaction\": \"txn_3PxCCBH9USr1IGtU1Zuyyp1A\",\n    \"billing_details\": {\n        \"address\": {\n            \"city\": null,\n            \"country\": null,\n            \"line1\": null,\n            \"line2\": null,\n            \"postal_code\": \"10001\",\n            \"state\": null\n        },\n        \"email\": null,\n        \"name\": null,\n        \"phone\": null\n    },\n    \"calculated_statement_descriptor\": \"AD POSSIMUS IN QUI SU\",\n    \"captured\": true,\n    \"created\": 1725906015,\n    \"currency\": \"usd\",\n    \"customer\": null,\n    \"description\": \"Test\",\n    \"destination\": null,\n    \"dispute\": null,\n    \"disputed\": false,\n    \"failure_balance_transaction\": null,\n    \"failure_code\": null,\n    \"failure_message\": null,\n    \"fraud_details\": [],\n    \"invoice\": null,\n    \"livemode\": false,\n    \"metadata\": [],\n    \"on_behalf_of\": null,\n    \"order\": null,\n    \"outcome\": {\n        \"network_status\": \"approved_by_network\",\n        \"reason\": null,\n        \"risk_level\": \"normal\",\n        \"risk_score\": 18,\n        \"seller_message\": \"Payment complete.\",\n        \"type\": \"authorized\"\n    },\n    \"paid\": true,\n    \"payment_intent\": null,\n    \"payment_method\": \"card_1PxCC8H9USr1IGtUFGUk8Cd2\",\n    \"payment_method_details\": {\n        \"card\": {\n            \"amount_authorized\": 600,\n            \"authorization_code\": null,\n            \"brand\": \"visa\",\n            \"checks\": {\n                \"address_line1_check\": null,\n                \"address_postal_code_check\": \"pass\",\n                \"cvc_check\": \"pass\"\n            },\n            \"country\": \"US\",\n            \"exp_month\": 11,\n            \"exp_year\": 2025,\n            \"extended_authorization\": {\n                \"status\": \"disabled\"\n            },\n            \"fingerprint\": \"AoMkA6oipmawIXxi\",\n            \"funding\": \"credit\",\n            \"incremental_authorization\": {\n                \"status\": \"unavailable\"\n            },\n            \"installments\": null,\n            \"last4\": \"1111\",\n            \"mandate\": null,\n            \"multicapture\": {\n                \"status\": \"unavailable\"\n            },\n            \"network\": \"visa\",\n            \"network_token\": {\n                \"used\": false\n            },\n            \"overcapture\": {\n                \"maximum_amount_capturable\": 600,\n                \"status\": \"unavailable\"\n            },\n            \"three_d_secure\": null,\n            \"wallet\": null\n        },\n        \"type\": \"card\"\n    },\n    \"receipt_email\": null,\n    \"receipt_number\": null,\n    \"receipt_url\": \"https:\\/\\/pay.stripe.com\\/receipts\\/payment\\/CAcaFwoVYWNjdF8xTHNDVHJIOVVTcjFJR3RVKN_4_LYGMgZK-kfbDJQ6LBaRFUY7xkyFtLm8tJqJqMmHOczes28tUNvk-_qx0jaywwOg4rJ5RtNNnsue\",\n    \"refunded\": false,\n    \"review\": null,\n    \"shipping\": null,\n    \"source\": {\n        \"id\": \"card_1PxCC8H9USr1IGtUFGUk8Cd2\",\n        \"object\": \"card\",\n        \"address_city\": null,\n        \"address_country\": null,\n        \"address_line1\": null,\n        \"address_line1_check\": null,\n        \"address_line2\": null,\n        \"address_state\": null,\n        \"address_zip\": \"10001\",\n        \"address_zip_check\": \"pass\",\n        \"brand\": \"Visa\",\n        \"country\": \"US\",\n        \"customer\": null,\n        \"cvc_check\": \"pass\",\n        \"dynamic_last4\": null,\n        \"exp_month\": 11,\n        \"exp_year\": 2025,\n        \"fingerprint\": \"AoMkA6oipmawIXxi\",\n        \"funding\": \"credit\",\n        \"last4\": \"1111\",\n        \"metadata\": [],\n        \"name\": null,\n        \"tokenization_method\": null,\n        \"wallet\": null\n    },\n    \"source_transfer\": null,\n    \"statement_descriptor\": null,\n    \"statement_descriptor_suffix\": null,\n    \"status\": \"succeeded\",\n    \"transfer_data\": null,\n    \"transfer_group\": null\n}', '2024-09-09 18:20:16', '2024-09-09 18:20:16');

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
-- Table structure for table `senders`
--

CREATE TABLE `senders` (
  `id` int(11) NOT NULL,
  `first_name` text DEFAULT NULL,
  `last_name` text DEFAULT NULL,
  `country` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `suburb` text DEFAULT NULL,
  `state` text DEFAULT NULL,
  `postcode` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `senders`
--

INSERT INTO `senders` (`id`, `first_name`, `last_name`, `country`, `address`, `suburb`, `state`, `postcode`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Rhoda', 'Mays', 'Australia', 'Aliquip accusantium', 'Ut tempore atque co', 'New South Wales', 'Dolore quasi velit u', '+1 (749) 547-5809', 'kazunuj@mailinator.com', '2024-09-09 16:22:48', '2024-09-09 16:22:48'),
(2, 'Judah', 'Cannon', 'Australia', 'Tempore minim possi', 'Eos hic officia et', 'New South Wales', 'Perspiciatis quasi', '+1 (432) 551-1438', 'fasyny@mailinator.com', '2024-09-09 17:37:57', '2024-09-09 17:37:57'),
(3, 'Judah', 'Cannon', 'Australia', 'Tempore minim possi', 'Eos hic officia et', 'New South Wales', 'Perspiciatis quasi', '+1 (432) 551-1438', 'fasyny@mailinator.com', '2024-09-09 17:38:40', '2024-09-09 17:38:40'),
(4, 'Judah', 'Cannon', 'Australia', 'Tempore minim possi', 'Eos hic officia et', 'New South Wales', 'Perspiciatis quasi', '+1 (432) 551-1438', 'fasyny@mailinator.com', '2024-09-09 17:39:16', '2024-09-09 17:39:16'),
(5, 'BillName', 'BillLast', 'Australia', 'Houston', 'Houston', 'New South Wales', '77001', '184655151', 'dev@uniquelogodesigns.com', '2024-09-09 18:20:16', '2024-09-09 18:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` text DEFAULT NULL,
  `last_name` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` text DEFAULT NULL,
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

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `qrcode`, `email_verified_at`, `password`, `remember_token`, `last_login`, `created_at`, `updated_at`) VALUES
(100000, 'Abdullah', 'Waseem', 'user@yopmail.com', '12346659988', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(6.897)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M10 0L10 1L9 1L9 2L8 2L8 3L9 3L9 5L10 5L10 7L11 7L11 8L12 8L12 9L11 9L11 10L10 10L10 9L9 9L9 6L8 6L8 8L4 8L4 9L5 9L5 10L6 10L6 11L4 11L4 10L3 10L3 11L2 11L2 10L1 10L1 9L3 9L3 8L0 8L0 10L1 10L1 11L0 11L0 13L1 13L1 14L0 14L0 16L1 16L1 18L0 18L0 19L1 19L1 20L0 20L0 21L1 21L1 20L2 20L2 19L1 19L1 18L2 18L2 16L3 16L3 17L4 17L4 18L3 18L3 19L4 19L4 20L3 20L3 21L7 21L7 20L8 20L8 25L9 25L9 26L8 26L8 29L12 29L12 28L14 28L14 29L15 29L15 28L16 28L16 27L17 27L17 29L19 29L19 28L18 28L18 27L19 27L19 26L21 26L21 27L20 27L20 29L21 29L21 27L22 27L22 26L21 26L21 25L23 25L23 27L24 27L24 28L22 28L22 29L24 29L24 28L25 28L25 23L26 23L26 22L27 22L27 23L29 23L29 21L26 21L26 22L25 22L25 20L26 20L26 18L27 18L27 20L28 20L28 19L29 19L29 16L28 16L28 15L29 15L29 12L28 12L28 11L29 11L29 9L28 9L28 10L26 10L26 9L27 9L27 8L26 8L26 9L25 9L25 10L24 10L24 12L25 12L25 14L23 14L23 12L22 12L22 11L21 11L21 10L23 10L23 8L21 8L21 10L20 10L20 11L17 11L17 10L18 10L18 8L20 8L20 7L21 7L21 6L20 6L20 5L21 5L21 4L19 4L19 3L20 3L20 2L21 2L21 1L20 1L20 0L19 0L19 1L17 1L17 2L19 2L19 3L18 3L18 4L19 4L19 6L18 6L18 7L17 7L17 3L16 3L16 2L15 2L15 3L16 3L16 5L14 5L14 3L12 3L12 2L11 2L11 3L12 3L12 5L10 5L10 3L9 3L9 2L10 2L10 1L11 1L11 0ZM14 0L14 1L13 1L13 2L14 2L14 1L15 1L15 0ZM13 5L13 7L12 7L12 6L11 6L11 7L12 7L12 8L13 8L13 9L14 9L14 10L13 10L13 11L14 11L14 10L15 10L15 9L16 9L16 8L17 8L17 7L16 7L16 6L15 6L15 7L14 7L14 5ZM19 6L19 7L20 7L20 6ZM15 7L15 8L16 8L16 7ZM6 9L6 10L7 10L7 11L6 11L6 12L7 12L7 11L10 11L10 10L9 10L9 9ZM25 10L25 11L26 11L26 13L27 13L27 14L25 14L25 15L24 15L24 16L23 16L23 18L24 18L24 20L25 20L25 18L26 18L26 17L27 17L27 18L28 18L28 17L27 17L27 14L28 14L28 13L27 13L27 11L26 11L26 10ZM11 11L11 12L12 12L12 14L11 14L11 15L10 15L10 14L9 14L9 13L10 13L10 12L9 12L9 13L8 13L8 14L9 14L9 17L10 17L10 19L9 19L9 21L11 21L11 20L12 20L12 22L10 22L10 24L11 24L11 25L10 25L10 26L9 26L9 28L10 28L10 27L11 27L11 28L12 28L12 27L11 27L11 25L12 25L12 24L13 24L13 25L14 25L14 26L13 26L13 27L14 27L14 26L15 26L15 27L16 27L16 26L17 26L17 27L18 27L18 26L17 26L17 23L18 23L18 22L17 22L17 19L16 19L16 18L18 18L18 19L20 19L20 20L22 20L22 17L21 17L21 16L22 16L22 15L23 15L23 14L22 14L22 15L20 15L20 14L21 14L21 11L20 11L20 12L18 12L18 13L19 13L19 15L18 15L18 16L19 16L19 17L17 17L17 15L16 15L16 14L17 14L17 13L16 13L16 14L14 14L14 12L12 12L12 11ZM15 11L15 12L16 12L16 11ZM2 12L2 14L1 14L1 15L3 15L3 16L4 16L4 17L5 17L5 20L7 20L7 19L8 19L8 17L6 17L6 16L8 16L8 15L6 15L6 16L4 16L4 15L5 15L5 13L4 13L4 14L3 14L3 12ZM6 13L6 14L7 14L7 13ZM13 14L13 15L14 15L14 14ZM11 15L11 16L12 16L12 17L11 17L11 19L10 19L10 20L11 20L11 19L12 19L12 20L14 20L14 22L13 22L13 23L14 23L14 22L15 22L15 20L16 20L16 19L15 19L15 18L14 18L14 17L13 17L13 16L12 16L12 15ZM15 15L15 16L16 16L16 15ZM19 15L19 16L20 16L20 15ZM25 15L25 16L26 16L26 15ZM6 18L6 19L7 19L7 18ZM13 18L13 19L14 19L14 18ZM20 18L20 19L21 19L21 18ZM19 21L19 22L20 22L20 21ZM21 21L21 24L24 24L24 21ZM16 22L16 23L15 23L15 24L16 24L16 23L17 23L17 22ZM22 22L22 23L23 23L23 22ZM11 23L11 24L12 24L12 23ZM19 24L19 25L20 25L20 24ZM28 24L28 25L26 25L26 27L27 27L27 29L29 29L29 28L28 28L28 27L29 27L29 24ZM27 26L27 27L28 27L28 26ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM22 0L22 7L29 7L29 0ZM23 1L23 6L28 6L28 1ZM24 2L24 5L27 5L27 2ZM0 22L0 29L7 29L7 22ZM1 23L1 28L6 28L6 23ZM2 24L2 27L5 27L5 24Z\" fill=\"#000000\"/></g></g></svg>\n', NULL, '$2y$12$7dOKNQS7eG23kc/bO6Vrt.Azlvd/D/m51gMqhDrjvbWKMco7aHCve', NULL, '2024-09-09 15:26:22', '2024-09-05 17:34:27', '2024-09-09 13:21:13'),
(100003, 'New', 'USer', 'newuser@yopmail.com', '12346659989', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(6.897)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M9 0L9 1L8 1L8 2L9 2L9 3L8 3L8 4L10 4L10 7L11 7L11 4L12 4L12 5L13 5L13 6L12 6L12 9L13 9L13 8L14 8L14 9L15 9L15 10L17 10L17 9L18 9L18 10L20 10L20 9L21 9L21 12L20 12L20 13L19 13L19 14L16 14L16 13L12 13L12 11L13 11L13 10L11 10L11 11L10 11L10 9L11 9L11 8L6 8L6 9L5 9L5 8L0 8L0 9L2 9L2 10L0 10L0 12L1 12L1 13L3 13L3 12L4 12L4 15L7 15L7 14L5 14L5 13L8 13L8 12L4 12L4 9L5 9L5 10L6 10L6 11L9 11L9 15L10 15L10 16L6 16L6 17L7 17L7 18L6 18L6 19L7 19L7 18L8 18L8 19L9 19L9 20L5 20L5 19L4 19L4 18L5 18L5 16L3 16L3 14L0 14L0 15L2 15L2 16L3 16L3 17L2 17L2 18L3 18L3 19L2 19L2 20L3 20L3 21L8 21L8 23L9 23L9 24L8 24L8 29L10 29L10 28L9 28L9 27L11 27L11 29L12 29L12 27L13 27L13 26L11 26L11 25L9 25L9 24L11 24L11 22L10 22L10 23L9 23L9 20L11 20L11 21L12 21L12 22L13 22L13 23L12 23L12 25L13 25L13 24L14 24L14 25L19 25L19 24L16 24L16 22L15 22L15 21L19 21L19 22L18 22L18 23L20 23L20 27L19 27L19 26L18 26L18 28L16 28L16 26L15 26L15 27L14 27L14 28L15 28L15 29L19 29L19 28L21 28L21 29L22 29L22 28L21 28L21 25L25 25L25 26L22 26L22 27L23 27L23 29L24 29L24 27L25 27L25 28L26 28L26 29L27 29L27 28L28 28L28 26L29 26L29 25L28 25L28 24L26 24L26 23L27 23L27 22L29 22L29 20L28 20L28 19L27 19L27 16L28 16L28 15L27 15L27 12L28 12L28 11L27 11L27 12L25 12L25 13L21 13L21 12L22 12L22 11L23 11L23 12L24 12L24 11L25 11L25 9L26 9L26 8L25 8L25 9L24 9L24 8L23 8L23 9L22 9L22 8L20 8L20 9L18 9L18 8L17 8L17 9L16 9L16 7L17 7L17 6L18 6L18 7L19 7L19 5L20 5L20 3L21 3L21 0L19 0L19 1L20 1L20 2L19 2L19 5L16 5L16 4L18 4L18 3L17 3L17 2L16 2L16 4L12 4L12 2L13 2L13 1L11 1L11 2L10 2L10 0ZM15 0L15 1L17 1L17 0ZM14 2L14 3L15 3L15 2ZM10 3L10 4L11 4L11 3ZM8 5L8 7L9 7L9 5ZM13 6L13 7L14 7L14 8L15 8L15 7L16 7L16 6L15 6L15 7L14 7L14 6ZM20 6L20 7L21 7L21 6ZM27 8L27 9L28 9L28 10L29 10L29 9L28 9L28 8ZM6 9L6 10L8 10L8 9ZM2 10L2 12L3 12L3 10ZM23 10L23 11L24 11L24 10ZM14 11L14 12L15 12L15 11ZM16 11L16 12L17 12L17 13L18 13L18 12L17 12L17 11ZM10 12L10 13L11 13L11 14L10 14L10 15L11 15L11 18L13 18L13 19L12 19L12 21L15 21L15 20L14 20L14 19L15 19L15 18L16 18L16 20L22 20L22 19L23 19L23 20L24 20L24 19L25 19L25 21L26 21L26 20L27 20L27 19L25 19L25 18L24 18L24 19L23 19L23 18L22 18L22 17L26 17L26 16L27 16L27 15L26 15L26 13L25 13L25 16L24 16L24 15L23 15L23 16L22 16L22 14L21 14L21 13L20 13L20 14L19 14L19 17L20 17L20 18L18 18L18 19L17 19L17 17L14 17L14 16L18 16L18 15L14 15L14 16L13 16L13 17L12 17L12 15L13 15L13 14L12 14L12 13L11 13L11 12ZM28 13L28 14L29 14L29 13ZM20 16L20 17L21 17L21 16ZM0 17L0 21L1 21L1 17ZM28 17L28 18L29 18L29 17ZM9 18L9 19L10 19L10 18ZM21 18L21 19L22 19L22 18ZM3 19L3 20L4 20L4 19ZM21 21L21 24L24 24L24 21ZM22 22L22 23L23 23L23 22ZM14 23L14 24L15 24L15 23ZM25 24L25 25L26 25L26 24ZM25 26L25 27L26 27L26 28L27 28L27 26ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM22 0L22 7L29 7L29 0ZM23 1L23 6L28 6L28 1ZM24 2L24 5L27 5L27 2ZM0 22L0 29L7 29L7 22ZM1 23L1 28L6 28L6 23ZM2 24L2 27L5 27L5 24Z\" fill=\"#000000\"/></g></g></svg>\n', NULL, '$2y$12$enBckKvKZhgC4o5Ka9xGEudi.QWa7OPiJIh.dFRMMTcfrY3IGLToW', NULL, NULL, '2024-09-06 17:30:15', '2024-09-06 18:01:36');

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
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `senders`
--
ALTER TABLE `senders`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `senders`
--
ALTER TABLE `senders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100004;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
