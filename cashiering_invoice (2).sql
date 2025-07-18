-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2025 at 09:01 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cycommph-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cashiering_invoice`
--

CREATE TABLE `cashiering_invoice` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `discount` int DEFAULT '0',
  `amount` int DEFAULT '0',
  `date_issued` date NOT NULL,
  `date_due` date DEFAULT NULL,
  `issued_by` varchar(255) DEFAULT NULL,
  `processed_by` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','payment-initiated','processing','completed','failed') DEFAULT NULL,
  `billing_address_id` int NOT NULL,
  `transaction_category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cashiering_invoice`
--

INSERT INTO `cashiering_invoice` (`id`, `user_id`, `invoice_number`, `discount`, `amount`, `date_issued`, `date_due`, `issued_by`, `processed_by`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `status`, `billing_address_id`, `transaction_category_id`) VALUES
(791, 76, 'INV-202502111111517680', 0, 500, '2025-02-11', NULL, 'Sample Cashier', NULL, 'system', '2025-02-11 05:48:46', 'sample@gmail.com', '2025-02-11 05:48:46', NULL, NULL, 'completed', 30, 1),
(792, 76, 'INV-202502111113483944', 0, 2000, '2025-02-11', NULL, 'Sample Cashier', NULL, 'danielPadilla@gmail.com', '2025-02-11 05:56:20', 'sample@gmail.com', '2025-02-11 05:56:20', NULL, NULL, 'completed', 30, 2),
(793, 77, 'INV-202502111345285499', 0, 500, '2025-02-11', NULL, 'Sample Cashier', NULL, 'system', '2025-02-11 07:29:13', 'sample@gmail.com', '2025-02-11 07:29:13', NULL, NULL, 'completed', 32, 1),
(794, 77, 'INV-202502111346361428', 0, 2000, '2025-02-11', NULL, 'Sample Cashier', NULL, 'kathrinavaldezco553@gmail.com', '2025-02-11 07:29:20', 'sample@gmail.com', '2025-02-11 07:29:20', NULL, NULL, 'completed', 32, 2),
(795, 76, 'INV-202502111525467027', 0, 364, '2025-02-11', NULL, NULL, NULL, 'sample@gmail.com', '2025-02-11 07:25:46', NULL, '2025-02-11 07:25:46', NULL, NULL, 'pending', 30, 3),
(796, 76, 'INV-202502111525467027', 0, 364, '2025-02-11', NULL, NULL, NULL, 'sample@gmail.com', '2025-02-11 07:25:46', NULL, '2025-02-11 07:25:46', NULL, NULL, 'pending', 30, 3),
(797, 76, 'INV-202502111525467027', 0, 364, '2025-02-11', NULL, NULL, NULL, 'sample@gmail.com', '2025-02-11 07:25:46', NULL, '2025-02-11 07:25:46', NULL, NULL, 'pending', 30, 3),
(798, 77, 'INV-202502120912092923', 0, 2000, '2025-02-12', NULL, 'Sample Cashier', NULL, 'kathrinavaldezco553@gmail.com', '2025-02-14 07:13:44', 'sample@gmail.com', '2025-02-14 07:13:44', NULL, NULL, 'completed', 32, 2),
(799, 78, 'INV-202502131623151088', 0, 500, '2025-02-13', NULL, 'Sample Cashier', NULL, 'system', '2025-02-13 08:47:07', 'sample@gmail.com', '2025-02-13 08:47:07', NULL, NULL, 'completed', 33, 1),
(800, 78, 'INV-202502131624042401', 0, 3000, '2025-02-13', NULL, 'Sample Cashier', NULL, 'jd@gmail.com', '2025-02-13 08:47:13', 'sample@gmail.com', '2025-02-13 08:47:13', NULL, NULL, 'completed', 33, 2),
(801, 78, 'INV-202502131652317089', 0, 3000, '2025-02-13', NULL, 'Sample Cashier', NULL, 'jd@gmail.com', '2025-02-13 08:53:09', 'sample@gmail.com', '2025-02-13 08:53:09', NULL, NULL, 'completed', 33, 2),
(802, 78, 'INV-202502131659547233', 0, 728, '2025-02-13', NULL, 'Sample Cashier', NULL, 'sample@gmail.com', '2025-02-14 01:13:54', 'sample@gmail.com', '2025-02-14 01:13:54', NULL, NULL, 'payment-initiated', 33, 3),
(803, 78, 'INV-202502131659547233', 0, 728, '2025-02-13', NULL, NULL, NULL, 'sample@gmail.com', '2025-02-13 08:59:54', NULL, '2025-02-13 08:59:54', NULL, NULL, 'pending', 33, 3),
(804, 77, 'INV-202502131700065548', 0, 364, '2025-02-13', NULL, NULL, NULL, 'sample@gmail.com', '2025-02-13 09:00:05', NULL, '2025-02-13 09:00:06', NULL, NULL, 'pending', 32, 3),
(805, 77, 'INV-202502131700065548', 0, 364, '2025-02-13', NULL, NULL, NULL, 'sample@gmail.com', '2025-02-13 09:00:05', NULL, '2025-02-13 09:00:06', NULL, NULL, 'pending', 32, 3),
(806, 79, 'INV-202502140925308105', 0, 500, '2025-02-14', NULL, 'Sample Cashier', NULL, 'system', '2025-02-14 01:29:52', 'sample@gmail.com', '2025-02-14 01:29:52', NULL, NULL, 'completed', 34, 1),
(807, 79, 'INV-202502140926259455', 0, 2000, '2025-02-14', NULL, 'Sample Cashier', NULL, 'Dayonela@gmail.com', '2025-02-14 01:30:00', 'sample@gmail.com', '2025-02-14 01:30:00', NULL, NULL, 'completed', 34, 2),
(808, 79, 'INV-202502141415048126', 0, 364, '2025-02-14', NULL, 'Sample Cashier', NULL, 'sample@gmail.com', '2025-02-24 07:13:44', 'sample@gmail.com', '2025-02-24 07:13:44', NULL, NULL, 'completed', 34, 3),
(809, 79, 'INV-202502141415048126', 0, 364, '2025-02-14', NULL, NULL, NULL, 'sample@gmail.com', '2025-02-14 06:15:04', NULL, '2025-02-14 06:15:04', NULL, NULL, 'pending', 34, 3),
(810, 80, 'INV-202502141536573261', 0, 500, '2025-02-14', NULL, 'Sample Cashier', NULL, 'system', '2025-02-14 07:41:44', 'sample@gmail.com', '2025-02-14 07:41:44', NULL, NULL, 'completed', 36, 1),
(811, 80, 'INV-202502141538245222', 0, 3000, '2025-02-14', NULL, 'Sample Cashier', NULL, 'rdumalo89@gmail.com', '2025-02-14 07:42:07', 'sample@gmail.com', '2025-02-14 07:42:07', NULL, NULL, 'completed', 36, 2),
(812, 80, 'INV-202502141547316742', 0, 364, '2025-02-14', NULL, 'Sample Cashier', NULL, 'sample@gmail.com', '2025-02-14 07:49:04', 'sample@gmail.com', '2025-02-14 07:49:04', NULL, NULL, 'completed', 36, 3),
(813, 80, 'INV-202502141547316742', 0, 364, '2025-02-14', NULL, NULL, NULL, 'sample@gmail.com', '2025-02-14 07:47:30', NULL, '2025-02-14 07:47:31', NULL, NULL, 'pending', 36, 3),
(814, 81, 'INV-202502171609239000', 0, 500, '2025-02-17', NULL, 'Sample Cashier', NULL, 'system', '2025-03-04 01:26:19', 'sample@gmail.com', '2025-03-04 01:26:19', NULL, NULL, 'completed', 37, 1),
(815, 84, 'INV-202503031653055779', 0, 500, '2025-03-03', NULL, 'Sample Cashier', NULL, 'system', '2025-03-03 09:08:11', 'sample@gmail.com', '2025-03-03 09:08:11', NULL, NULL, 'completed', 39, 1),
(816, 84, 'INV-202503031653525479', 0, 3000, '2025-03-03', NULL, 'Sample Cashier', NULL, 'maja_salvador@gmail.com', '2025-03-03 09:08:43', 'sample@gmail.com', '2025-03-03 09:08:43', NULL, NULL, 'completed', 39, 2),
(817, 84, 'INV-202503041603506690', 0, 364, '2025-03-04', NULL, NULL, NULL, 'sample@gmail.com', '2025-03-04 08:50:36', NULL, '2025-03-04 08:50:36', NULL, NULL, 'payment-initiated', 39, 3),
(818, 84, 'INV-202503041603506690', 0, 364, '2025-03-04', NULL, NULL, NULL, 'sample@gmail.com', '2025-03-04 08:03:50', NULL, '2025-03-04 08:03:50', NULL, NULL, 'pending', 39, 3),
(819, 84, 'INV-202503050854333635', 0, 5000, '2025-03-05', NULL, NULL, NULL, 'maja_salvador@gmail.com', '2025-03-05 00:54:33', NULL, '2025-03-05 00:54:33', NULL, NULL, 'payment-initiated', 39, 2),
(820, 85, 'INV-202503051019275486', 0, 500, '2025-03-05', NULL, 'Sample Cashier', NULL, 'system', '2025-03-05 02:24:06', 'sample@gmail.com', '2025-03-05 02:24:05', NULL, NULL, 'completed', 40, 1),
(821, 85, 'INV-202503051020062197', 0, 2000, '2025-03-05', NULL, 'Sample Cashier', NULL, 'john_cena@gmail.com', '2025-03-05 02:24:16', 'sample@gmail.com', '2025-03-05 02:24:15', NULL, NULL, 'completed', 40, 2),
(822, 85, 'INV-202503051028289272', 0, 364, '2025-03-05', NULL, NULL, NULL, 'sample@gmail.com', '2025-03-05 02:28:28', NULL, '2025-03-05 02:28:28', NULL, NULL, 'pending', 40, 3),
(823, 85, 'INV-202503051028289272', 0, 364, '2025-03-05', NULL, NULL, NULL, 'sample@gmail.com', '2025-03-05 02:28:28', NULL, '2025-03-05 02:28:28', NULL, NULL, 'pending', 40, 3),
(824, 86, 'INV-202503051530384135', 0, 500, '2025-03-05', NULL, 'Sample Cashier', NULL, 'system', '2025-03-05 08:52:13', 'sample@gmail.com', '2025-03-05 08:52:13', NULL, NULL, 'completed', 43, 1),
(825, 86, 'INV-202503051531387673', 0, 2000, '2025-03-05', NULL, 'Sample Cashier', NULL, 'erlinda@gmail.com', '2025-03-05 08:52:22', 'sample@gmail.com', '2025-03-05 08:52:21', NULL, NULL, 'completed', 43, 2),
(826, 86, 'INV-202503051655153807', 0, 437, '2025-03-05', NULL, NULL, NULL, 'sample@gmail.com', '2025-03-05 08:56:07', NULL, '2025-03-05 08:56:07', NULL, NULL, 'payment-initiated', 43, 3),
(827, 86, 'INV-202503051655153807', 0, 437, '2025-03-05', NULL, NULL, NULL, 'sample@gmail.com', '2025-03-05 08:55:15', NULL, '2025-03-05 08:55:15', NULL, NULL, 'pending', 43, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cashiering_invoice`
--
ALTER TABLE `cashiering_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `billing_address_id` (`billing_address_id`),
  ADD KEY `transaction_category_id` (`transaction_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cashiering_invoice`
--
ALTER TABLE `cashiering_invoice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=828;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cashiering_invoice`
--
ALTER TABLE `cashiering_invoice`
  ADD CONSTRAINT `billing_id_ibfk_1` FOREIGN KEY (`billing_address_id`) REFERENCES `billing_address` (`id`),
  ADD CONSTRAINT `cashiering_user_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_type_id_ibk_3` FOREIGN KEY (`transaction_category_id`) REFERENCES `transaction_category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
