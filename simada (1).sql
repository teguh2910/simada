-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 07:27 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simada`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `kinds_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `documents` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `kinds_doc`, `documents`, `created_at`, `updated_at`) VALUES
(1, 'SPTT-1', 'Drawing', NULL, NULL),
(2, 'SPTT-1', 'Letter of Intent (LOI)', NULL, NULL),
(3, 'SPTT-1', 'Loading vs Capacity', NULL, NULL),
(4, 'SPTT-1', 'Tooling Progress Report (TPR)', NULL, NULL),
(5, 'SPTT-1', 'P3-Plan', NULL, NULL),
(6, 'SPTT-1', 'SE Activity', NULL, NULL),
(7, 'SPTT-1', 'SPTT-1 Form', NULL, NULL),
(8, 'SPTT-2', 'Supply Chain Management (SCM)', NULL, NULL),
(9, 'SPTT-2', 'Quality Control Process Chart (QCPC)', NULL, NULL),
(10, 'SPTT-2', 'Part Inspection Sheet (PIS)', NULL, NULL),
(11, 'SPTT-2', 'Layout Inspection', NULL, NULL),
(12, 'SPTT-2', 'PISS (Part Identification Standard Sheet)', NULL, NULL),
(13, 'SPTT-2', 'PESS (Part Evaluation Status Sheet)', NULL, NULL),
(14, 'SPTT-2', 'Check Sheet', NULL, NULL),
(15, 'SPTT-2', 'SoC Free', NULL, NULL),
(16, 'SPTT-2', 'Mill Sheet', NULL, NULL),
(17, 'SPTT-2', 'Cp CPk', NULL, NULL),
(18, 'SPTT-2', 'Material Safety Data Sheet (MSDS)', NULL, NULL),
(19, 'SPTT-2', 'Risk Management', NULL, NULL),
(20, 'SPTT-2', 'Measurement System Analysis (MSA) Report', NULL, NULL),
(21, 'SPTT-2', 'Packing Specification', NULL, NULL),
(22, 'SPTT-2', 'PFMEA', NULL, NULL),
(23, 'SPTT-2', 'QC Plan', NULL, NULL),
(24, 'SPTT-2', 'Logistic Supplier', NULL, NULL),
(25, 'SPTT-2', 'Test Report', NULL, NULL),
(26, 'SPTT-2', 'Process Flow Diagram', NULL, NULL),
(27, 'SPTT-2', 'SPTT-2 Form', NULL, NULL),
(28, 'SPTT-3', 'Data HVPT', NULL, NULL),
(29, 'SPTT-3', 'Initial Control Form', NULL, NULL),
(30, 'SPTT-3', 'SPTT-3 Form', NULL, NULL),
(31, 'SPTT-1', 'Quotation', NULL, NULL),
(32, 'SPTT-1', 'Price Confirmation', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `komentars`
--

CREATE TABLE `komentars` (
  `id_komentar` int(11) NOT NULL,
  `id_transactions` int(11) NOT NULL,
  `pic_k` varchar(30) NOT NULL,
  `npk_k` int(11) NOT NULL,
  `dep_k` varchar(30) NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2022_11_17_045429_create_table_db_document', 2),
(4, '2022_11_17_061127_createtabletransaksi', 3),
(5, '2022_11_17_073807_detail_transactions', 4),
(7, '2022_11_17_082333_add_file_to_transcations_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int(10) UNSIGNED NOT NULL,
  `project` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `supplier` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `part_number` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `id_document` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revise` int(11) NOT NULL,
  `pic` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `npk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dept` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `npk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `dept`, `npk`) VALUES
(1, 'ttmi', 'ceo@ttmi.com', '$2y$10$9pvLeyC.bZH5KHZ.xL8jQeuXkcFIm1VFdAj0Ys722HnDGBNJwTWKi', 'pi5oEHUDUir76eeYgziEaykVsqSmVqe0Mma07etGbL5i4ZW6LOoDkzN2mos8', '2022-10-25 23:28:18', '2022-12-19 11:25:15', 'MIM', 10460),
(2, 'rizty', 'rizty@aisin-indonesia.co.id', '$2y$10$9pvLeyC.bZH5KHZ.xL8jQeuXkcFIm1VFdAj0Ys722HnDGBNJwTWKi', 'D1pb0xmXeX3gjLNgMQBmDIcowZ6VUsthJsGOZFFnmOUqeywQ6dN3b08uyj4X', '2022-10-25 23:28:18', '2022-12-19 11:05:28', 'MIM', 8682),
(3, 'esa', 'esa@aisin-indonesia.co.id', '$2y$10$9pvLeyC.bZH5KHZ.xL8jQeuXkcFIm1VFdAj0Ys722HnDGBNJwTWKi', 'YF4EZoTHsEFFeW1tlp0zRBT1YW6XHVgDvJMuXTwHVme2x2EGbHmhSdwwb5ZC', '2022-10-25 23:28:18', '2022-10-25 23:28:20', 'NPL', 10463),
(4, 'Seno', 'seno@aisin-indonesia.co.id', '$2y$10$9pvLeyC.bZH5KHZ.xL8jQeuXkcFIm1VFdAj0Ys722HnDGBNJwTWKi', 'z2XXhE1vsJxuJr9mu86gaLvDqHdfPwyImML3i7lWNxsToEz1139zBsxKVhln', '2022-10-25 23:28:18', '2022-12-19 11:09:10', 'QA', 6969);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentars`
--
ALTER TABLE `komentars`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`);

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
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `komentars`
--
ALTER TABLE `komentars`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
