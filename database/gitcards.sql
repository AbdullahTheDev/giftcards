-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 07:37 PM
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
  `showname` text DEFAULT NULL,
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

INSERT INTO `events` (`id`, `user_id`, `name`, `showname`, `image`, `banner_type`, `banner`, `event_date`, `description`, `location`, `created_at`, `updated_at`) VALUES
(1, 100003, '100003', NULL, 'uploads/images/1725663444_bruce-mars.jpg', NULL, 'uploads/banners/1725663444_ivana-squares.jpg', '2024-09-26 00:00:00', NULL, NULL, '2024-09-06 22:30:15', '2024-09-06 22:57:58'),
(2, 100000, '100000', 'Event Name', 'uploads/images/1726848248_Picture1.jpg', NULL, 'uploads/banners/1726848260_image.jfif', '2024-09-27 00:00:00', 'Dummy event, just for testing, and this is its description. Stay Happy!', 'Florida USA', '2024-09-06 22:30:15', '2024-09-20 16:04:20'),
(3, 100004, '100004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-12 18:46:06', '2024-09-12 18:46:06'),
(4, 100005, '100005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-20 20:20:21', '2024-09-20 20:20:21');

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
  `total_amount` text DEFAULT NULL,
  `admin_fee` text DEFAULT NULL,
  `merchant_fee` text DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `payment_details` text DEFAULT NULL,
  `requested` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`id`, `gift_id`, `user_id`, `sender`, `message`, `amount`, `total_amount`, `admin_fee`, `merchant_fee`, `date`, `payment_details`, `requested`, `created_at`, `updated_at`) VALUES
(14, 'GFT-8CBCQIMH', 100000, '16', 'Eligendi deserunt ac', '27', '27.54', '1', '0.54', '2024-09-23 16:40:00', '{\"id\":\"ch_3Q2FIoH9USr1IGtU0K41KjmL\",\"object\":\"charge\",\"amount\":2754,\"amount_captured\":2754,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_3Q2FIoH9USr1IGtU0cq22Fz8\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"10000\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"AD POSSIMUS IN QUI SU\",\"captured\":true,\"created\":1727109598,\"currency\":\"usd\",\"customer\":null,\"description\":\"Eligendi deserunt ac\",\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_balance_transaction\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":58,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1Q2FInH9USr1IGtUEtoGCZTA\",\"payment_method_details\":{\"card\":{\"amount_authorized\":2754,\"authorization_code\":null,\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2028,\"extended_authorization\":{\"status\":\"disabled\"},\"fingerprint\":\"AoMkA6oipmawIXxi\",\"funding\":\"credit\",\"incremental_authorization\":{\"status\":\"unavailable\"},\"installments\":null,\"last4\":\"1111\",\"mandate\":null,\"multicapture\":{\"status\":\"unavailable\"},\"network\":\"visa\",\"network_token\":{\"used\":false},\"overcapture\":{\"maximum_amount_capturable\":2754,\"status\":\"unavailable\"},\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/payment\\/CAcaFwoVYWNjdF8xTHNDVHJIOVVTcjFJR3RVKN-zxrcGMgaIJXfvw9I6LBaVmFb0tRPFvm64lbJu6Mp21oUyAAz2nVMGXGD4YibcDnf8UUsdvku2bntz\",\"refunded\":false,\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1Q2FInH9USr1IGtUEtoGCZTA\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"10000\",\"address_zip_check\":\"pass\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2028,\"fingerprint\":\"AoMkA6oipmawIXxi\",\"funding\":\"credit\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"tokenization_method\":null,\"wallet\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}', 1, '2024-09-23 16:40:00', '2024-09-23 16:40:44'),
(15, 'GFT-HSHYONEC', 100000, '17', 'Ipsa ea temporibus', '57', '58.14', '1', '1.14', '2024-09-23 16:41:16', '{\"id\":\"ch_3Q2FK2H9USr1IGtU0Plx4jHx\",\"object\":\"charge\",\"amount\":5814,\"amount_captured\":5814,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_3Q2FK2H9USr1IGtU0EWm5aMF\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"10001\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"AD POSSIMUS IN QUI SU\",\"captured\":true,\"created\":1727109674,\"currency\":\"usd\",\"customer\":null,\"description\":\"Ipsa ea temporibus\",\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_balance_transaction\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":49,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1Q2FK1H9USr1IGtUGCe8QOh6\",\"payment_method_details\":{\"card\":{\"amount_authorized\":5814,\"authorization_code\":null,\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2065,\"extended_authorization\":{\"status\":\"disabled\"},\"fingerprint\":\"AoMkA6oipmawIXxi\",\"funding\":\"credit\",\"incremental_authorization\":{\"status\":\"unavailable\"},\"installments\":null,\"last4\":\"1111\",\"mandate\":null,\"multicapture\":{\"status\":\"unavailable\"},\"network\":\"visa\",\"network_token\":{\"used\":false},\"overcapture\":{\"maximum_amount_capturable\":5814,\"status\":\"unavailable\"},\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/payment\\/CAcaFwoVYWNjdF8xTHNDVHJIOVVTcjFJR3RVKKu0xrcGMgZC4bUNPE06LBZX64M5xN3DW4jHwn28_OHucsKMndBWFuLXzuKHRky_mmj3rrMSABxvdqUX\",\"refunded\":false,\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1Q2FK1H9USr1IGtUGCe8QOh6\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"10001\",\"address_zip_check\":\"pass\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2065,\"fingerprint\":\"AoMkA6oipmawIXxi\",\"funding\":\"credit\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"tokenization_method\":null,\"wallet\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}', 1, '2024-09-23 16:41:16', '2024-09-23 16:42:31'),
(16, 'GFT-S1SEOTRD', 100000, '18', 'Aliquam mollit assum', '26', '26.52', '1', '0.52', '2024-09-23 16:42:00', '{\"id\":\"ch_3Q2FKlH9USr1IGtU1oFBoCHn\",\"object\":\"charge\",\"amount\":2652,\"amount_captured\":2652,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_3Q2FKlH9USr1IGtU1Xb6XeSW\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"10000\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"AD POSSIMUS IN QUI SU\",\"captured\":true,\"created\":1727109719,\"currency\":\"usd\",\"customer\":null,\"description\":\"Aliquam mollit assum\",\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_balance_transaction\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":17,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1Q2FKkH9USr1IGtUH0MfoHYP\",\"payment_method_details\":{\"card\":{\"amount_authorized\":2652,\"authorization_code\":null,\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2028,\"extended_authorization\":{\"status\":\"disabled\"},\"fingerprint\":\"AoMkA6oipmawIXxi\",\"funding\":\"credit\",\"incremental_authorization\":{\"status\":\"unavailable\"},\"installments\":null,\"last4\":\"1111\",\"mandate\":null,\"multicapture\":{\"status\":\"unavailable\"},\"network\":\"visa\",\"network_token\":{\"used\":false},\"overcapture\":{\"maximum_amount_capturable\":2652,\"status\":\"unavailable\"},\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/payment\\/CAcaFwoVYWNjdF8xTHNDVHJIOVVTcjFJR3RVKNi0xrcGMgYixK8AWnM6LBax6obQlp0AowzcF9GZN8rBxuWhJG7YWEI4GvaNik5Qb2j-NMMqTaQOmOE-\",\"refunded\":false,\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1Q2FKkH9USr1IGtUH0MfoHYP\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"10000\",\"address_zip_check\":\"pass\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2028,\"fingerprint\":\"AoMkA6oipmawIXxi\",\"funding\":\"credit\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"tokenization_method\":null,\"wallet\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}', 1, '2024-09-23 16:42:00', '2024-09-23 16:42:31'),
(17, 'GFT-V2DCOIV2', 100000, '19', 'Dignissimos in eiusm', '91', '92.82', '1', '1.82', '2024-09-23 17:03:36', '{\"id\":\"ch_3Q2FffH9USr1IGtU04eXR6cP\",\"object\":\"charge\",\"amount\":9282,\"amount_captured\":9282,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_3Q2FffH9USr1IGtU0s3fw1BS\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"10001\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"AD POSSIMUS IN QUI SU\",\"captured\":true,\"created\":1727111015,\"currency\":\"usd\",\"customer\":null,\"description\":\"Dignissimos in eiusm\",\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_balance_transaction\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":14,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1Q2FfdH9USr1IGtUXy4Dxgpa\",\"payment_method_details\":{\"card\":{\"amount_authorized\":9282,\"authorization_code\":null,\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2026,\"extended_authorization\":{\"status\":\"disabled\"},\"fingerprint\":\"AoMkA6oipmawIXxi\",\"funding\":\"credit\",\"incremental_authorization\":{\"status\":\"unavailable\"},\"installments\":null,\"last4\":\"1111\",\"mandate\":null,\"multicapture\":{\"status\":\"unavailable\"},\"network\":\"visa\",\"network_token\":{\"used\":false},\"overcapture\":{\"maximum_amount_capturable\":9282,\"status\":\"unavailable\"},\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/payment\\/CAcaFwoVYWNjdF8xTHNDVHJIOVVTcjFJR3RVKOe-xrcGMgZwE4oBz1c6LBar1lI28N6grsvxWZgvHBZPUxTU93gqO8EGa2RFVjGlHtE2RUI_SHq6OFtr\",\"refunded\":false,\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1Q2FfdH9USr1IGtUXy4Dxgpa\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"10001\",\"address_zip_check\":\"pass\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2026,\"fingerprint\":\"AoMkA6oipmawIXxi\",\"funding\":\"credit\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"tokenization_method\":null,\"wallet\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}', 0, '2024-09-23 17:03:36', '2024-09-23 17:03:36');

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
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `accountName` text DEFAULT NULL,
  `BSBNumber` text DEFAULT NULL,
  `accountNumber` text DEFAULT NULL,
  `bankName` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `user_id`, `accountName`, `BSBNumber`, `accountNumber`, `bankName`, `created_at`, `updated_at`) VALUES
(1, 100000, 'John Doe', '2111315', '41111111111111111', 'BSS BANK', '2024-09-12 16:19:27', '2024-09-12 16:19:27'),
(2, 100005, NULL, NULL, NULL, NULL, '2024-09-20 20:20:21', '2024-09-20 20:20:21');

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
(9, 'Anastasia', 'Clemons', 'Australia', 'Aute culpa sint in', 'Id sit soluta dicta', 'New South Wales', 'Ut aute quis ut ut i', '+1 (541) 899-6041', 'lywojana@yopmail.com', '2024-09-20 17:24:36', '2024-09-20 17:24:36'),
(10, 'Dorothy', 'Peck', 'Australia', 'Dignissimos animi n', 'Suscipit mollit rem', 'New South Wales', 'Deserunt eum et magn', '+1 (534) 739-4747', 'dysesysi@mailinator.com', '2024-09-23 16:04:56', '2024-09-23 16:04:56'),
(11, 'Shay', 'Compton', 'Australia', 'Ex necessitatibus vo', 'Debitis voluptatem', 'New South Wales', 'Nisi eu quia eos cu', '+1 (999) 724-8642', 'tyxiluka@mailinator.com', '2024-09-23 16:18:44', '2024-09-23 16:18:44'),
(12, 'Kendall', 'Kerr', 'Australia', 'Dolorum esse duis d', 'Et ea amet expedita', 'New South Wales', 'In sequi dolor natus', '+1 (324) 789-5826', 'mivyxoroc@mailinator.com', '2024-09-23 16:23:22', '2024-09-23 16:23:22'),
(13, 'Kendall', 'Kerr', 'Australia', 'Dolorum esse duis d', 'Et ea amet expedita', 'New South Wales', 'In sequi dolor natus', '+1 (324) 789-5826', 'mivyxoroc@mailinator.com', '2024-09-23 16:23:28', '2024-09-23 16:23:28'),
(14, 'Sylvester', 'Lara', 'Australia', 'Ut sed sit dolores s', 'Quae anim voluptatum', 'New South Wales', 'Doloribus excepturi', '+1 (925) 369-8128', 'lecafuna@mailinator.com', '2024-09-23 16:34:02', '2024-09-23 16:34:02'),
(15, 'Sylvester', 'Lara', 'Australia', 'Ut sed sit dolores s', 'Quae anim voluptatum', 'New South Wales', 'Doloribus excepturi', '+1 (925) 369-8128', 'lecafuna@mailinator.com', '2024-09-23 16:34:07', '2024-09-23 16:34:07'),
(16, 'Venus', 'Patton', 'Australia', 'Perferendis ipsa ut', 'Duis iste cupidatat', 'New South Wales', 'Soluta velit ipsum t', '+1 (796) 645-4778', 'xoqafe@mailinator.com', '2024-09-23 16:40:00', '2024-09-23 16:40:00'),
(17, 'Quyn', 'Chapman', 'Australia', 'Dolores cupiditate a', 'Dolor dolore ut dese', 'New South Wales', 'Officiis accusantium', '+1 (634) 194-2094', 'faqefig@mailinator.com', '2024-09-23 16:41:16', '2024-09-23 16:41:16'),
(18, 'Travis', 'Vaughan', 'Australia', 'Illo ad recusandae', 'Nam quia voluptas co', 'New South Wales', 'Sit commodi cupidita', '+1 (992) 733-4823', 'vajigi@mailinator.com', '2024-09-23 16:42:00', '2024-09-23 16:42:00'),
(19, 'Elmo', 'Odonnell', 'Australia', 'Ad non commodo asper', 'Facilis aliquid comm', 'New South Wales', 'Tenetur nulla amet', '+1 (288) 394-3762', 'user2@yopmail.com', '2024-09-23 17:03:36', '2024-09-23 17:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `email` text DEFAULT NULL,
  `admin_fees` int(11) NOT NULL DEFAULT 3,
  `merchant_fees` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `email`, `admin_fees`, `merchant_fees`, `created_at`, `updated_at`) VALUES
(1, 'dev@uniquelogodesigns.com', 1, 2, '2024-09-16 22:02:21', '2024-09-20 17:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
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

INSERT INTO `users` (`id`, `role`, `first_name`, `last_name`, `email`, `phone`, `qrcode`, `email_verified_at`, `password`, `remember_token`, `last_login`, `created_at`, `updated_at`) VALUES
(100000, 'user', 'John', 'Doe', 'user@yopmail.com', '12346659988', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(6.897)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M9 0L9 1L10 1L10 2L8 2L8 3L9 3L9 4L10 4L10 5L9 5L9 6L8 6L8 8L4 8L4 9L7 9L7 10L6 10L6 11L4 11L4 10L3 10L3 8L0 8L0 9L2 9L2 10L3 10L3 11L2 11L2 12L1 12L1 13L0 13L0 16L1 16L1 17L2 17L2 19L1 19L1 18L0 18L0 19L1 19L1 20L0 20L0 21L1 21L1 20L2 20L2 21L4 21L4 20L6 20L6 21L7 21L7 20L9 20L9 21L8 21L8 25L9 25L9 21L10 21L10 24L11 24L11 26L12 26L12 24L14 24L14 26L13 26L13 27L14 27L14 26L15 26L15 24L16 24L16 23L17 23L17 26L16 26L16 27L15 27L15 28L16 28L16 27L17 27L17 29L19 29L19 26L21 26L21 27L20 27L20 29L21 29L21 27L22 27L22 26L21 26L21 25L23 25L23 27L24 27L24 28L22 28L22 29L24 29L24 28L25 28L25 23L26 23L26 22L27 22L27 24L28 24L28 25L26 25L26 27L27 27L27 29L29 29L29 28L28 28L28 27L29 27L29 21L26 21L26 22L25 22L25 20L26 20L26 18L27 18L27 20L28 20L28 19L29 19L29 16L28 16L28 15L29 15L29 12L28 12L28 11L29 11L29 9L28 9L28 10L26 10L26 9L27 9L27 8L26 8L26 9L25 9L25 10L24 10L24 12L25 12L25 14L23 14L23 12L22 12L22 11L21 11L21 10L23 10L23 8L21 8L21 10L20 10L20 11L17 11L17 10L18 10L18 7L19 7L19 8L20 8L20 7L21 7L21 6L20 6L20 5L21 5L21 4L19 4L19 3L20 3L20 2L21 2L21 1L20 1L20 0L18 0L18 1L17 1L17 0L16 0L16 1L14 1L14 0L12 0L12 1L10 1L10 0ZM13 1L13 2L14 2L14 1ZM11 2L11 3L12 3L12 4L11 4L11 5L10 5L10 6L9 6L9 7L10 7L10 6L11 6L11 8L12 8L12 10L10 10L10 8L9 8L9 10L8 10L8 12L7 12L7 11L6 11L6 12L7 12L7 13L6 13L6 14L5 14L5 13L3 13L3 12L4 12L4 11L3 11L3 12L2 12L2 13L1 13L1 16L2 16L2 15L3 15L3 18L4 18L4 17L5 17L5 19L6 19L6 20L7 20L7 19L8 19L8 18L9 18L9 20L11 20L11 21L12 21L12 20L13 20L13 21L14 21L14 22L13 22L13 23L14 23L14 22L15 22L15 23L16 23L16 22L18 22L18 23L19 23L19 22L20 22L20 21L17 21L17 19L18 19L18 20L19 20L19 19L20 19L20 20L22 20L22 17L21 17L21 16L22 16L22 15L23 15L23 14L22 14L22 15L20 15L20 14L21 14L21 11L20 11L20 12L18 12L18 13L17 13L17 11L16 11L16 10L17 10L17 9L16 9L16 10L14 10L14 8L12 8L12 6L13 6L13 7L14 7L14 6L15 6L15 8L16 8L16 6L17 6L17 7L18 7L18 5L19 5L19 4L18 4L18 3L19 3L19 2L17 2L17 3L16 3L16 2L15 2L15 3L16 3L16 4L15 4L15 5L14 5L14 4L13 4L13 3L12 3L12 2ZM13 5L13 6L14 6L14 5ZM19 6L19 7L20 7L20 6ZM0 10L0 11L1 11L1 10ZM9 10L9 11L10 11L10 10ZM13 10L13 11L14 11L14 10ZM25 10L25 11L26 11L26 13L27 13L27 14L25 14L25 15L24 15L24 16L23 16L23 18L24 18L24 20L25 20L25 18L26 18L26 17L27 17L27 18L28 18L28 17L27 17L27 14L28 14L28 13L27 13L27 11L26 11L26 10ZM11 11L11 12L12 12L12 13L11 13L11 14L9 14L9 13L8 13L8 15L7 15L7 14L6 14L6 15L5 15L5 16L6 16L6 17L7 17L7 16L8 16L8 15L10 15L10 16L9 16L9 18L12 18L12 16L14 16L14 18L13 18L13 19L14 19L14 18L15 18L15 16L16 16L16 15L17 15L17 18L16 18L16 19L15 19L15 20L16 20L16 19L17 19L17 18L19 18L19 17L18 17L18 14L16 14L16 15L15 15L15 14L14 14L14 13L13 13L13 12L12 12L12 11ZM15 11L15 12L16 12L16 11ZM13 14L13 15L14 15L14 14ZM6 15L6 16L7 16L7 15ZM11 15L11 16L12 16L12 15ZM19 15L19 16L20 16L20 15ZM25 15L25 16L26 16L26 15ZM6 18L6 19L7 19L7 18ZM20 18L20 19L21 19L21 18ZM2 19L2 20L3 20L3 19ZM11 19L11 20L12 20L12 19ZM21 21L21 24L24 24L24 21ZM22 22L22 23L23 23L23 22ZM11 23L11 24L12 24L12 23ZM19 24L19 25L20 25L20 24ZM8 26L8 29L10 29L10 28L9 28L9 26ZM17 26L17 27L18 27L18 26ZM27 26L27 27L28 27L28 26ZM11 27L11 28L12 28L12 29L13 29L13 28L12 28L12 27ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM22 0L22 7L29 7L29 0ZM23 1L23 6L28 6L28 1ZM24 2L24 5L27 5L27 2ZM0 22L0 29L7 29L7 22ZM1 23L1 28L6 28L6 23ZM2 24L2 27L5 27L5 24Z\" fill=\"#000000\"/></g></g></svg>\n', NULL, '$2y$12$7dOKNQS7eG23kc/bO6Vrt.Azlvd/D/m51gMqhDrjvbWKMco7aHCve', NULL, '2024-09-23 17:31:50', '2024-09-05 17:34:27', '2024-09-23 12:31:50'),
(100003, 'user', 'New', 'USer', 'newuser@yopmail.com', '12346659989', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(6.897)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M9 0L9 1L8 1L8 2L9 2L9 3L8 3L8 4L10 4L10 7L11 7L11 4L12 4L12 5L13 5L13 6L12 6L12 9L13 9L13 8L14 8L14 9L15 9L15 10L17 10L17 9L18 9L18 10L20 10L20 9L21 9L21 12L20 12L20 13L19 13L19 14L16 14L16 13L12 13L12 11L13 11L13 10L11 10L11 11L10 11L10 9L11 9L11 8L6 8L6 9L5 9L5 8L0 8L0 9L2 9L2 10L0 10L0 12L1 12L1 13L3 13L3 12L4 12L4 15L7 15L7 14L5 14L5 13L8 13L8 12L4 12L4 9L5 9L5 10L6 10L6 11L9 11L9 15L10 15L10 16L6 16L6 17L7 17L7 18L6 18L6 19L7 19L7 18L8 18L8 19L9 19L9 20L5 20L5 19L4 19L4 18L5 18L5 16L3 16L3 14L0 14L0 15L2 15L2 16L3 16L3 17L2 17L2 18L3 18L3 19L2 19L2 20L3 20L3 21L8 21L8 23L9 23L9 24L8 24L8 29L10 29L10 28L9 28L9 27L11 27L11 29L12 29L12 27L13 27L13 26L11 26L11 25L9 25L9 24L11 24L11 22L10 22L10 23L9 23L9 20L11 20L11 21L12 21L12 22L13 22L13 23L12 23L12 25L13 25L13 24L14 24L14 25L19 25L19 24L16 24L16 22L15 22L15 21L19 21L19 22L18 22L18 23L20 23L20 27L19 27L19 26L18 26L18 28L16 28L16 26L15 26L15 27L14 27L14 28L15 28L15 29L19 29L19 28L21 28L21 29L22 29L22 28L21 28L21 25L25 25L25 26L22 26L22 27L23 27L23 29L24 29L24 27L25 27L25 28L26 28L26 29L27 29L27 28L28 28L28 26L29 26L29 25L28 25L28 24L26 24L26 23L27 23L27 22L29 22L29 20L28 20L28 19L27 19L27 16L28 16L28 15L27 15L27 12L28 12L28 11L27 11L27 12L25 12L25 13L21 13L21 12L22 12L22 11L23 11L23 12L24 12L24 11L25 11L25 9L26 9L26 8L25 8L25 9L24 9L24 8L23 8L23 9L22 9L22 8L20 8L20 9L18 9L18 8L17 8L17 9L16 9L16 7L17 7L17 6L18 6L18 7L19 7L19 5L20 5L20 3L21 3L21 0L19 0L19 1L20 1L20 2L19 2L19 5L16 5L16 4L18 4L18 3L17 3L17 2L16 2L16 4L12 4L12 2L13 2L13 1L11 1L11 2L10 2L10 0ZM15 0L15 1L17 1L17 0ZM14 2L14 3L15 3L15 2ZM10 3L10 4L11 4L11 3ZM8 5L8 7L9 7L9 5ZM13 6L13 7L14 7L14 8L15 8L15 7L16 7L16 6L15 6L15 7L14 7L14 6ZM20 6L20 7L21 7L21 6ZM27 8L27 9L28 9L28 10L29 10L29 9L28 9L28 8ZM6 9L6 10L8 10L8 9ZM2 10L2 12L3 12L3 10ZM23 10L23 11L24 11L24 10ZM14 11L14 12L15 12L15 11ZM16 11L16 12L17 12L17 13L18 13L18 12L17 12L17 11ZM10 12L10 13L11 13L11 14L10 14L10 15L11 15L11 18L13 18L13 19L12 19L12 21L15 21L15 20L14 20L14 19L15 19L15 18L16 18L16 20L22 20L22 19L23 19L23 20L24 20L24 19L25 19L25 21L26 21L26 20L27 20L27 19L25 19L25 18L24 18L24 19L23 19L23 18L22 18L22 17L26 17L26 16L27 16L27 15L26 15L26 13L25 13L25 16L24 16L24 15L23 15L23 16L22 16L22 14L21 14L21 13L20 13L20 14L19 14L19 17L20 17L20 18L18 18L18 19L17 19L17 17L14 17L14 16L18 16L18 15L14 15L14 16L13 16L13 17L12 17L12 15L13 15L13 14L12 14L12 13L11 13L11 12ZM28 13L28 14L29 14L29 13ZM20 16L20 17L21 17L21 16ZM0 17L0 21L1 21L1 17ZM28 17L28 18L29 18L29 17ZM9 18L9 19L10 19L10 18ZM21 18L21 19L22 19L22 18ZM3 19L3 20L4 20L4 19ZM21 21L21 24L24 24L24 21ZM22 22L22 23L23 23L23 22ZM14 23L14 24L15 24L15 23ZM25 24L25 25L26 25L26 24ZM25 26L25 27L26 27L26 28L27 28L27 26ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM22 0L22 7L29 7L29 0ZM23 1L23 6L28 6L28 1ZM24 2L24 5L27 5L27 2ZM0 22L0 29L7 29L7 22ZM1 23L1 28L6 28L6 23ZM2 24L2 27L5 27L5 24Z\" fill=\"#000000\"/></g></g></svg>\n', NULL, '$2y$12$enBckKvKZhgC4o5Ka9xGEudi.QWa7OPiJIh.dFRMMTcfrY3IGLToW', NULL, NULL, '2024-09-06 17:30:15', '2024-09-06 18:01:36'),
(100004, 'admin', 'Admin', 'Person', 'admin@yopmail.com', NULL, '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(6.897)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M9 0L9 1L10 1L10 2L8 2L8 3L9 3L9 4L10 4L10 5L9 5L9 6L8 6L8 8L4 8L4 9L3 9L3 8L0 8L0 10L1 10L1 11L0 11L0 12L1 12L1 11L3 11L3 13L0 13L0 14L1 14L1 15L0 15L0 16L1 16L1 18L0 18L0 19L1 19L1 20L0 20L0 21L1 21L1 20L2 20L2 19L3 19L3 20L5 20L5 21L7 21L7 20L8 20L8 19L7 19L7 18L6 18L6 19L7 19L7 20L5 20L5 17L7 17L7 16L6 16L6 15L7 15L7 14L6 14L6 15L4 15L4 16L1 16L1 15L2 15L2 14L5 14L5 13L7 13L7 12L6 12L6 11L10 11L10 10L12 10L12 8L14 8L14 10L13 10L13 11L14 11L14 10L16 10L16 11L15 11L15 12L17 12L17 13L18 13L18 12L20 12L20 11L21 11L21 14L20 14L20 15L19 15L19 16L20 16L20 15L22 15L22 16L21 16L21 17L22 17L22 20L20 20L20 19L21 19L21 18L20 18L20 19L19 19L19 20L18 20L18 19L17 19L17 18L19 18L19 17L18 17L18 14L16 14L16 15L15 15L15 14L14 14L14 13L13 13L13 12L12 12L12 11L11 11L11 12L12 12L12 13L11 13L11 14L10 14L10 13L9 13L9 12L8 12L8 13L9 13L9 14L8 14L8 15L9 15L9 14L10 14L10 16L8 16L8 18L9 18L9 17L10 17L10 18L12 18L12 16L14 16L14 18L13 18L13 19L14 19L14 18L15 18L15 16L16 16L16 15L17 15L17 18L16 18L16 19L15 19L15 20L16 20L16 19L17 19L17 21L20 21L20 22L19 22L19 23L18 23L18 22L16 22L16 23L15 23L15 22L14 22L14 21L13 21L13 20L12 20L12 19L9 19L9 21L8 21L8 25L9 25L9 26L8 26L8 29L9 29L9 26L10 26L10 28L12 28L12 29L13 29L13 28L12 28L12 27L11 27L11 26L12 26L12 24L14 24L14 26L13 26L13 27L14 27L14 26L15 26L15 24L16 24L16 23L17 23L17 26L16 26L16 27L15 27L15 28L16 28L16 27L17 27L17 29L19 29L19 26L21 26L21 27L20 27L20 29L21 29L21 27L22 27L22 26L21 26L21 25L23 25L23 27L24 27L24 28L22 28L22 29L24 29L24 28L25 28L25 23L26 23L26 22L27 22L27 24L28 24L28 25L26 25L26 27L27 27L27 29L29 29L29 28L28 28L28 27L29 27L29 21L26 21L26 22L25 22L25 20L26 20L26 18L27 18L27 20L28 20L28 19L29 19L29 16L28 16L28 15L29 15L29 12L28 12L28 11L29 11L29 9L28 9L28 10L26 10L26 9L27 9L27 8L26 8L26 9L25 9L25 10L24 10L24 12L25 12L25 14L23 14L23 12L22 12L22 11L21 11L21 10L23 10L23 8L21 8L21 10L20 10L20 11L17 11L17 10L18 10L18 7L19 7L19 8L20 8L20 7L21 7L21 6L20 6L20 5L21 5L21 4L19 4L19 3L20 3L20 2L21 2L21 1L20 1L20 0L18 0L18 1L17 1L17 0L16 0L16 1L14 1L14 0L12 0L12 1L10 1L10 0ZM13 1L13 2L14 2L14 1ZM11 2L11 3L12 3L12 4L11 4L11 5L10 5L10 6L9 6L9 7L10 7L10 6L11 6L11 8L12 8L12 6L13 6L13 7L14 7L14 6L15 6L15 8L16 8L16 6L17 6L17 7L18 7L18 5L19 5L19 4L18 4L18 3L19 3L19 2L17 2L17 3L16 3L16 2L15 2L15 3L16 3L16 4L15 4L15 5L14 5L14 4L13 4L13 3L12 3L12 2ZM13 5L13 6L14 6L14 5ZM19 6L19 7L20 7L20 6ZM9 8L9 10L10 10L10 8ZM4 9L4 10L5 10L5 11L4 11L4 13L5 13L5 11L6 11L6 10L7 10L7 9ZM16 9L16 10L17 10L17 9ZM25 10L25 11L26 11L26 13L27 13L27 14L25 14L25 15L24 15L24 16L23 16L23 18L24 18L24 20L25 20L25 18L26 18L26 17L27 17L27 18L28 18L28 17L27 17L27 14L28 14L28 13L27 13L27 11L26 11L26 10ZM13 14L13 15L14 15L14 14ZM22 14L22 15L23 15L23 14ZM11 15L11 16L12 16L12 15ZM25 15L25 16L26 16L26 15ZM4 16L4 17L5 17L5 16ZM1 18L1 19L2 19L2 18ZM10 20L10 21L9 21L9 23L10 23L10 24L12 24L12 23L10 23L10 22L11 22L11 21L12 21L12 20ZM21 21L21 24L24 24L24 21ZM13 22L13 23L14 23L14 22ZM22 22L22 23L23 23L23 22ZM19 24L19 25L20 25L20 24ZM17 26L17 27L18 27L18 26ZM27 26L27 27L28 27L28 26ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM22 0L22 7L29 7L29 0ZM23 1L23 6L28 6L28 1ZM24 2L24 5L27 5L27 2ZM0 22L0 29L7 29L7 22ZM1 23L1 28L6 28L6 23ZM2 24L2 27L5 27L5 24Z\" fill=\"#000000\"/></g></g></svg>\n', NULL, '$2y$12$DjMDOOPKCm3KhbceCyJin.7Ds3PX9ZBRedhdEfx7zmP2U64VzdABW', NULL, '2024-09-23 17:33:31', '2024-09-12 13:46:06', '2024-09-23 12:33:31'),
(100005, 'user', 'asdca', 'ascs', 'debora.kamel@yopmail.com', NULL, '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(6.897)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M10 0L10 2L11 2L11 0ZM12 0L12 1L13 1L13 2L12 2L12 4L13 4L13 3L14 3L14 4L15 4L15 5L17 5L17 6L16 6L16 8L17 8L17 9L18 9L18 10L20 10L20 9L21 9L21 12L19 12L19 13L18 13L18 12L17 12L17 10L16 10L16 9L12 9L12 7L13 7L13 5L11 5L11 6L10 6L10 4L11 4L11 3L8 3L8 4L9 4L9 5L8 5L8 7L9 7L9 8L6 8L6 9L7 9L7 10L5 10L5 8L0 8L0 9L1 9L1 10L2 10L2 12L1 12L1 11L0 11L0 15L1 15L1 14L2 14L2 15L3 15L3 16L4 16L4 17L3 17L3 18L2 18L2 16L0 16L0 21L1 21L1 18L2 18L2 19L3 19L3 20L2 20L2 21L3 21L3 20L4 20L4 21L8 21L8 23L10 23L10 20L11 20L11 19L9 19L9 21L8 21L8 20L4 20L4 19L3 19L3 18L4 18L4 17L5 17L5 19L8 19L8 18L9 18L9 17L12 17L12 18L13 18L13 19L12 19L12 21L13 21L13 20L14 20L14 21L17 21L17 23L18 23L18 22L19 22L19 23L20 23L20 27L19 27L19 26L18 26L18 27L19 27L19 28L16 28L16 26L15 26L15 25L19 25L19 24L16 24L16 22L15 22L15 23L14 23L14 24L15 24L15 25L12 25L12 23L13 23L13 22L11 22L11 24L10 24L10 28L9 28L9 24L8 24L8 29L11 29L11 25L12 25L12 26L13 26L13 27L12 27L12 29L13 29L13 28L14 28L14 29L19 29L19 28L21 28L21 29L22 29L22 28L21 28L21 25L25 25L25 26L22 26L22 27L23 27L23 29L24 29L24 27L25 27L25 28L26 28L26 29L27 29L27 28L28 28L28 26L29 26L29 25L28 25L28 24L29 24L29 23L27 23L27 22L29 22L29 20L28 20L28 19L27 19L27 16L28 16L28 15L27 15L27 12L28 12L28 11L27 11L27 12L25 12L25 13L21 13L21 12L22 12L22 11L23 11L23 12L24 12L24 11L25 11L25 9L26 9L26 8L25 8L25 9L24 9L24 8L23 8L23 9L22 9L22 8L20 8L20 9L18 9L18 8L19 8L19 6L18 6L18 5L17 5L17 4L18 4L18 3L17 3L17 4L16 4L16 2L17 2L17 1L16 1L16 0ZM18 0L18 1L20 1L20 2L19 2L19 5L20 5L20 3L21 3L21 0ZM8 1L8 2L9 2L9 1ZM14 2L14 3L15 3L15 2ZM9 6L9 7L10 7L10 6ZM11 6L11 7L12 7L12 6ZM14 6L14 8L15 8L15 6ZM17 6L17 8L18 8L18 6ZM20 6L20 7L21 7L21 6ZM10 8L10 9L8 9L8 10L7 10L7 11L6 11L6 12L7 12L7 13L6 13L6 14L4 14L4 13L5 13L5 11L3 11L3 13L2 13L2 14L4 14L4 16L7 16L7 17L6 17L6 18L7 18L7 17L8 17L8 16L9 16L9 15L6 15L6 14L8 14L8 13L9 13L9 14L13 14L13 15L12 15L12 17L15 17L15 18L16 18L16 20L18 20L18 19L19 19L19 20L22 20L22 19L23 19L23 20L24 20L24 19L25 19L25 21L26 21L26 20L27 20L27 19L25 19L25 18L24 18L24 19L23 19L23 18L22 18L22 17L26 17L26 16L27 16L27 15L26 15L26 13L25 13L25 16L24 16L24 15L23 15L23 16L22 16L22 14L21 14L21 13L20 13L20 14L18 14L18 15L17 15L17 13L14 13L14 12L15 12L15 11L14 11L14 12L13 12L13 13L12 13L12 11L13 11L13 10L12 10L12 9L11 9L11 8ZM27 8L27 9L28 9L28 10L29 10L29 9L28 9L28 8ZM2 9L2 10L4 10L4 9ZM10 9L10 11L11 11L11 9ZM8 10L8 12L9 12L9 13L11 13L11 12L9 12L9 10ZM23 10L23 11L24 11L24 10ZM28 13L28 14L29 14L29 13ZM15 14L15 15L14 15L14 16L15 16L15 17L18 17L18 16L19 16L19 15L18 15L18 16L16 16L16 14ZM10 15L10 16L11 16L11 15ZM20 16L20 17L19 17L19 18L20 18L20 17L21 17L21 16ZM28 17L28 18L29 18L29 17ZM21 18L21 19L22 19L22 18ZM14 19L14 20L15 20L15 19ZM21 21L21 24L24 24L24 21ZM22 22L22 23L23 23L23 22ZM26 23L26 24L25 24L25 25L26 25L26 24L27 24L27 23ZM25 26L25 27L26 27L26 28L27 28L27 26ZM14 27L14 28L15 28L15 27ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM22 0L22 7L29 7L29 0ZM23 1L23 6L28 6L28 1ZM24 2L24 5L27 5L27 2ZM0 22L0 29L7 29L7 22ZM1 23L1 28L6 28L6 23ZM2 24L2 27L5 27L5 24Z\" fill=\"#000000\"/></g></g></svg>\n', NULL, '$2y$12$nOyYwpQjrGxMJ2khyxgOnO05.tApIXbOeuqTqcOIQWiXzLpWNJiqi', NULL, NULL, '2024-09-20 15:20:21', '2024-09-20 15:20:22');

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

-- --------------------------------------------------------

--
-- Table structure for table `withdrawls`
--

CREATE TABLE `withdrawls` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_id` text DEFAULT NULL,
  `amount` text DEFAULT NULL,
  `admin_fees` text DEFAULT NULL,
  `merchant_fees` text NOT NULL DEFAULT '0',
  `payment_status` text DEFAULT 'pending',
  `payment` text DEFAULT NULL,
  `mode` text NOT NULL DEFAULT 'Bank Transfer',
  `note` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdrawls`
--

INSERT INTO `withdrawls` (`id`, `user_id`, `invoice_id`, `amount`, `admin_fees`, `merchant_fees`, `payment_status`, `payment`, `mode`, `note`, `created_at`, `updated_at`) VALUES
(9, 100000, '1000009644', '26', '1', '2', 'paid', NULL, 'Bank Transfer', NULL, '2024-09-23 16:40:44', '2024-09-23 17:34:14'),
(10, 100000, '1000009751', '81', '2', '2', 'paid', NULL, 'Bank Transfer', NULL, '2024-09-23 16:42:31', '2024-09-23 16:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_gifts`
--

CREATE TABLE `withdraw_gifts` (
  `id` int(11) NOT NULL,
  `withdrawl_id` int(11) NOT NULL,
  `gift_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdraw_gifts`
--

INSERT INTO `withdraw_gifts` (`id`, `withdrawl_id`, `gift_id`, `created_at`, `updated_at`) VALUES
(10, 9, 14, '2024-09-23 16:40:44', '2024-09-23 16:40:44'),
(11, 10, 15, '2024-09-23 16:42:31', '2024-09-23 16:42:31'),
(12, 10, 16, '2024-09-23 16:42:31', '2024-09-23 16:42:31');

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
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- Indexes for table `withdrawls`
--
ALTER TABLE `withdrawls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_gifts`
--
ALTER TABLE `withdraw_gifts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `senders`
--
ALTER TABLE `senders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100006;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawls`
--
ALTER TABLE `withdrawls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `withdraw_gifts`
--
ALTER TABLE `withdraw_gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
