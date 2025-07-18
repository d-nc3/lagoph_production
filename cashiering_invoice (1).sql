-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2024 at 08:18 AM
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
(297, 3, 'INV-202411071613309377', 0, 500, '2024-11-07', NULL, 'Sample Cashier', NULL, 'system', '2024-11-07 08:15:04', 'sample@gmail.com', '2024-11-07 08:15:04', NULL, NULL, 'completed', 8, 1),
(298, 3, 'INV-202411071614223345', 0, 2000, '2024-11-07', NULL, 'Sample Cashier', NULL, 'jane@gmail.com', '2024-11-07 08:16:44', 'sample@gmail.com', '2024-11-07 08:16:44', NULL, NULL, 'completed', 8, 2);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

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
