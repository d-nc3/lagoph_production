-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 06, 2025 at 09:35 AM
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
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int NOT NULL,
  `cash_accounts_id` int NOT NULL,
  `code` int NOT NULL,
  `payment_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `cash_accounts_id`, `code`, `payment_name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 1, 1110001, 'Cash payment', '1', '2024-11-10 13:36:08', NULL, '2024-11-10 13:36:08', NULL, NULL),
(2, 1, 1110006, 'Cheque', '1', '2024-10-29 01:35:01', NULL, '2024-10-29 01:35:01', NULL, NULL),
(3, 1, 1110006, 'E-wallet', NULL, '2024-11-11 02:26:53', NULL, '2024-11-11 02:26:53', NULL, NULL),
(4, 1, 1110007, 'Bank', '1', '2025-02-18 05:43:50', NULL, '2025-02-18 05:43:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billing_address`
--

CREATE TABLE `billing_address` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `billing_email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `billing_address`
--

INSERT INTO `billing_address` (`id`, `user_id`, `street_address`, `municipality`, `billing_email`, `mobile_number`, `province`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(3, 33, 'N/A', 'NCR', 'kathrinavaldezco553@gmail.com', '189182919', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(4, 44, 'SS', 'NCR', 'kathrinavaldezco553@gmail.com', '09182350004', 'Bulacan', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(9, 5, 'Sample Address', 'NCR', 'angela@gmail.com', '10100100', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(30, 76, '413 Cristobal Street', 'NCR', 'danielPadilla@gmail.com', '09182350004', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(31, 2, 'Blk 19 lot 32', 'NCR', 'sample@gmail.com', '09182350004', '', '2025-03-18 14:28:55', NULL, '2025-03-19 15:39:37', NULL, '2025-03-19 15:39:37', 'john.doe@example.com'),
(32, 77, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco553@gmail.com', '189182919', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(33, 78, 'Blk 49 Laspalmas Subdv Caypombo SMB', 'NCR', 'jd@gmail.com', '09182350044', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(34, 79, 'Blk 49 lot 43 Las palmas Subdv.', 'NCR', 'dayonela@gmail.com', '0918235004', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(35, 3, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco553@gmail.com', '189182919', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(36, 80, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'rdumalo89@gmail.com', '189182919', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(37, 81, 'Caypombo Santa Maria Bulacan', 'NCR', 'annaMarilag@gmail.com', '09182350004', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(38, 82, 'Visayas, Region VI, Capiz, Roxas City', 'NCR', 'azoresmelmar@gmail.com', '09480300378', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(39, 84, 'Blk 49 lot 43 Las palmas Subdv.', 'NCR', 'maja_salvador@gmail.com', '09182350004', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(40, 85, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco553@gmail.com', '189182919', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(41, 85, 'SS', 'NCR', 'sample@gmail.com', '09182350004', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(42, 85, 'SS', 'NCR', 'jon_cena@gmail.com', '09182350004', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(43, 86, 'SS', 'NCR', 'erlinda@gmail.com', '09182350004', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(44, 87, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'diane@gmail.com', '189182919', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(45, 88, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'bj@gmail.com', '918235004', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(46, 2, '#49 Don A. Roces Paligsahan, Quezon City', 'CAR', 'kathrinavaldezco553@gmail.com', '189182919', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:29:32', NULL, '2025-03-18 14:29:32', 'john.doe@example.com'),
(47, 89, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'bhors3deguzman@gmail.com', '09359671913', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(48, 89, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'bhors3deguzman@gmail.com', '09359671913', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(49, 90, 'Blk 34, Lot 14 Garden Villas Tansa Cavite', 'NCR', 'jennifermiranda@gmail.com', '202555111', '', '2025-03-18 14:28:55', NULL, '2025-03-18 14:28:55', NULL, NULL, NULL),
(50, 91, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'Ak@gmail.com', '9610743235', '', '2025-03-18 14:28:55', NULL, '2025-03-19 15:00:45', NULL, '2025-03-19 15:00:45', 'Ak@gmail.com'),
(53, 91, 'Blk 49 lot 43', 'NCR', 'sample@gmail.com', '9182350004', '', '2025-03-19 15:22:42', NULL, '2025-03-19 16:01:44', NULL, '2025-03-19 16:01:44', 'Ak@gmail.com'),
(54, 91, 'Blk 49 lot 43', 'NCR', 'sample@gmail.com', '9182350004', '', '2025-03-19 16:02:11', NULL, '2025-03-19 16:02:11', NULL, NULL, NULL),
(55, 2, 'Blk 49 lot 43', 'NCR', 'sample@gmail.com', '9182350004', '', '2025-03-19 16:10:08', NULL, '2025-03-19 16:10:08', NULL, NULL, NULL),
(56, 93, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco553@gmail.com', '9182350004', '', '2025-03-20 15:50:49', NULL, '2025-03-20 15:50:49', NULL, NULL, NULL),
(57, 110, 'Blk 49 lot 43', 'NCR', 'sample@gmail.com', '9182350004', '', '2025-04-02 16:45:58', NULL, '2025-04-02 16:45:58', NULL, NULL, NULL),
(58, 111, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco553@gmail.com', '9182350004', '', '2025-04-14 08:46:56', NULL, '2025-04-14 08:46:56', NULL, NULL, NULL),
(59, 112, 'blk 49 lot 43', 'NCR', 'sample@gmail.com', '9182350004', '', '2025-04-15 08:23:54', NULL, '2025-04-15 08:23:54', NULL, NULL, NULL),
(60, 113, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco553@gmail.com', '9182350004', '', '2025-04-15 13:30:04', NULL, '2025-04-15 13:30:04', NULL, NULL, NULL),
(61, 114, '#49 Don A. Roces Ave., Brgy. Paligsahan, Quezon City', 'NCR', 'pamelavivientballesteros@gmail.com', '9065776463', '', '2025-04-15 15:17:51', NULL, '2025-04-15 15:17:51', NULL, NULL, NULL),
(62, 115, '#49 Don A. Roces Ave. paligsahan Quezon City', 'NCR', 'jeremy23deguzman@gmail.com', '9359671913', '', '2025-04-15 15:20:17', NULL, '2025-04-15 15:20:17', NULL, NULL, NULL),
(63, 115, '#49 Don A. Roces Ave. paligsahan Quezon City', 'NCR', 'jeremy23deguzman@gmail.com', '9359671913', '', '2025-04-15 15:20:29', NULL, '2025-04-15 15:20:29', NULL, NULL, NULL),
(64, 115, '#49 Don A. Roces Ave. paligsahan Quezon City', 'NCR', 'jeremy23deguzman@gmail.com', '9359671922', '', '2025-04-15 15:23:54', NULL, '2025-04-15 15:23:54', NULL, NULL, NULL),
(65, 125, 'Santa Maria', 'NCR', 'kathrinavaldezco553@gmail.com', '9610743235', '', '2025-04-23 16:03:12', NULL, '2025-04-23 16:03:12', NULL, NULL, NULL),
(66, 130, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco553@gmail.com', '9189182919', '', '2025-04-25 14:40:17', NULL, '2025-04-25 14:40:17', NULL, NULL, NULL),
(68, 132, '#49 Don A. Roces Paligsahan, Quezon City', 'CAR', 'kathrinavaldezco553@gmail.com', '9182350004', '', '2025-05-02 12:56:06', NULL, '2025-05-02 12:56:06', NULL, NULL, NULL),
(69, 139, '#49 Don A. Roces Paligsahan, Quezon City', 'CAR', 'kathrinavaldezco553@gmail.com', '9182350004', '', '2025-05-05 16:46:25', NULL, '2025-05-05 16:46:25', NULL, NULL, NULL),
(70, 142, 'Santa Maria', 'NCR', 'kathrinavaldezco553@gmail.com', '9610743235', '', '2025-05-06 12:58:32', NULL, '2025-05-06 12:58:32', NULL, NULL, NULL),
(71, 144, 'Santa Maria', 'NCR', 'kathrinavaldezco553@gmail.com', '9610743235', '', '2025-05-06 13:12:50', NULL, '2025-05-06 13:12:50', NULL, NULL, NULL),
(72, 145, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco553@gmail.com', '9182350004', '', '2025-05-06 13:29:54', NULL, '2025-05-06 13:29:54', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `calendars`
--

CREATE TABLE `calendars` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `color` varchar(7) DEFAULT '#4285F4',
  `visibility` enum('private','public') DEFAULT 'private',
  `timezone` varchar(50) DEFAULT 'UTC',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `calendars`
--

INSERT INTO `calendars` (`id`, `user_id`, `name`, `description`, `color`, `visibility`, `timezone`, `created_at`, `created_by`, `update_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'Work', NULL, '#1E90FF', 'private', 'UTC', '2025-04-14 20:50:45', NULL, NULL, NULL, NULL, NULL),
(2, 1, 'Personal', NULL, '#FF4500', 'private', 'UTC', '2025-04-14 20:50:45', NULL, NULL, NULL, NULL, NULL),
(3, 1, 'Family', NULL, '#32CD32', 'private', 'UTC', '2025-04-14 20:50:45', NULL, NULL, NULL, NULL, NULL),
(4, 1, 'Health & Fitness', NULL, '#FF69B4', 'private', 'UTC', '2025-04-14 20:50:45', NULL, NULL, NULL, NULL, NULL),
(5, 1, 'ETC', NULL, '#FFD700', 'private', 'UTC', '2025-04-14 20:50:45', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `capital_contributions`
--

CREATE TABLE `capital_contributions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `share_id` int DEFAULT NULL,
  `subscribed_amount` decimal(10,2) NOT NULL,
  `outstanding_balance` decimal(10,2) DEFAULT NULL,
  `amount_per_share` decimal(10,2) NOT NULL,
  `number_of_shares` int NOT NULL,
  `amount` decimal(10,2) DEFAULT '0.00',
  `detail` text,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `date_issued` date NOT NULL,
  `date_paid` date DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `capital_contributions`
--

INSERT INTO `capital_contributions` (`id`, `user_id`, `share_id`, `subscribed_amount`, `outstanding_balance`, `amount_per_share`, `number_of_shares`, `amount`, `detail`, `status`, `date_issued`, `date_paid`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(69, 88, NULL, '10000.00', '8000.00', '1000.00', 9, '2000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-03-11', '2025-03-11', 0, '2025-03-11 06:29:03', 0, '2025-03-11 06:32:05', NULL, NULL),
(70, 89, NULL, '10000.00', '6000.00', '1000.00', 7, '2000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-03-13', '2025-03-13', 0, '2025-03-13 00:31:52', 0, '2025-04-25 06:16:27', NULL, NULL),
(71, 91, NULL, '12000.00', '10000.00', '1000.00', 11, '2000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-03-17', '2025-03-17', 0, '2025-03-17 05:55:47', 0, '2025-03-17 05:57:16', NULL, NULL),
(72, 93, NULL, '10000.00', '0.00', '1000.00', 1, '2000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-03-20', '2025-03-20', 0, '2025-03-20 07:51:39', 0, '2025-03-20 08:14:00', NULL, NULL),
(73, 111, NULL, '10000.00', '7000.00', '1000.00', 8, '3000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-04-15', '2025-04-15', 0, '2025-04-14 21:57:58', 0, '2025-04-15 00:23:04', NULL, NULL),
(74, 114, NULL, '1000.00', '0.00', '1000.00', 1, '1000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-04-15', '2025-04-15', 0, '2025-04-15 07:22:03', 0, '2025-04-15 07:29:27', NULL, NULL),
(75, 115, NULL, '10000.00', '5000.00', '1000.00', 6, '1000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-04-15', '2025-04-15', 0, '2025-04-15 07:38:46', 0, '2025-04-15 07:42:57', NULL, NULL),
(76, 113, NULL, '10000.00', '7000.00', '1000.00', 8, '1000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-04-21', '2025-04-21', 0, '2025-04-21 01:54:15', 0, '2025-04-21 02:30:51', NULL, NULL),
(77, 125, NULL, '10000.00', '0.00', '1000.00', 1, '2000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-04-23', '2025-04-23', 0, '2025-04-23 08:06:35', 0, '2025-04-25 06:06:45', NULL, NULL),
(78, 130, NULL, '10000.00', '3000.00', '1000.00', 4, '2000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-04-25', '2025-04-25', 0, '2025-04-25 06:41:21', 0, '2025-04-25 07:58:13', NULL, NULL),
(82, 132, NULL, '20000.00', NULL, '2000.00', 10, '2000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-05-06', '2025-05-06', 0, '2025-05-06 04:00:23', 0, NULL, NULL, NULL),
(83, 142, NULL, '20000.00', '12000.00', '2000.00', 7, '2000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-05-06', '2025-05-06', 0, '2025-05-06 05:00:20', 0, '2025-05-06 05:03:34', NULL, NULL),
(84, 144, NULL, '10000.00', '8000.00', '1000.00', 9, '2000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-05-06', '2025-05-06', 0, '2025-05-06 05:15:00', 0, '2025-05-06 05:15:38', NULL, NULL),
(85, 145, NULL, '20000.00', '18000.00', '2000.00', 10, '2000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-05-06', '2025-05-06', 0, '2025-05-06 08:59:17', 0, '2025-05-06 09:06:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cap_share_account_dues`
--

CREATE TABLE `cap_share_account_dues` (
  `id` int NOT NULL,
  `capital_contribution_id` int NOT NULL,
  `amount_due` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('pending','paid','payment_initiated') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cap_share_account_dues`
--

INSERT INTO `cap_share_account_dues` (`id`, `capital_contribution_id`, `amount_due`, `due_date`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1022, 69, '2000.00', '2025-03-11', 'paid', '2025-03-11 14:32:05', 'sample@gmail.com', '2025-03-11 14:32:05', NULL, NULL, NULL),
(1023, 69, '1000.00', '2025-04-11', 'pending', '2025-03-11 14:32:05', 'sample@gmail.com', '2025-03-11 14:32:05', NULL, NULL, NULL),
(1024, 69, '1000.00', '2025-05-11', 'pending', '2025-03-11 14:32:05', 'sample@gmail.com', '2025-03-11 14:32:05', NULL, NULL, NULL),
(1025, 69, '1000.00', '2025-06-11', 'pending', '2025-03-11 14:32:05', 'sample@gmail.com', '2025-03-11 14:32:05', NULL, NULL, NULL),
(1026, 69, '1000.00', '2025-07-11', 'pending', '2025-03-11 14:32:05', 'sample@gmail.com', '2025-03-11 14:32:05', NULL, NULL, NULL),
(1027, 69, '1000.00', '2025-08-11', 'pending', '2025-03-11 14:32:05', 'sample@gmail.com', '2025-03-11 14:32:05', NULL, NULL, NULL),
(1028, 69, '1000.00', '2025-09-11', 'pending', '2025-03-11 14:32:05', 'sample@gmail.com', '2025-03-11 14:32:05', NULL, NULL, NULL),
(1029, 69, '1000.00', '2025-10-11', 'pending', '2025-03-11 14:32:05', 'sample@gmail.com', '2025-03-11 14:32:05', NULL, NULL, NULL),
(1030, 69, '1000.00', '2025-11-11', 'pending', '2025-03-11 14:32:05', 'sample@gmail.com', '2025-03-11 14:32:05', NULL, NULL, NULL),
(1031, 70, '2000.00', '2025-03-13', 'paid', '2025-03-13 08:48:18', 'sample@gmail.com', '2025-03-13 08:48:18', NULL, NULL, NULL),
(1032, 70, '1000.00', '2025-04-13', 'paid', '2025-03-13 08:48:18', 'sample@gmail.com', '2025-04-25 14:16:27', 'sample@gmail.com', NULL, NULL),
(1033, 70, '1000.00', '2025-05-13', 'paid', '2025-03-13 08:48:18', 'sample@gmail.com', '2025-04-25 14:16:27', 'sample@gmail.com', NULL, NULL),
(1034, 70, '1000.00', '2025-06-13', 'pending', '2025-03-13 08:48:18', 'sample@gmail.com', '2025-03-13 08:48:18', NULL, NULL, NULL),
(1035, 70, '1000.00', '2025-07-13', 'pending', '2025-03-13 08:48:18', 'sample@gmail.com', '2025-03-13 08:48:18', NULL, NULL, NULL),
(1036, 70, '1000.00', '2025-08-13', 'pending', '2025-03-13 08:48:18', 'sample@gmail.com', '2025-03-13 08:48:18', NULL, NULL, NULL),
(1037, 70, '1000.00', '2025-09-13', 'pending', '2025-03-13 08:48:18', 'sample@gmail.com', '2025-03-13 08:48:18', NULL, NULL, NULL),
(1038, 70, '1000.00', '2025-10-13', 'pending', '2025-03-13 08:48:18', 'sample@gmail.com', '2025-03-13 08:48:18', NULL, NULL, NULL),
(1039, 70, '1000.00', '2025-11-13', 'pending', '2025-03-13 08:48:18', 'sample@gmail.com', '2025-03-13 08:48:18', NULL, NULL, NULL),
(1040, 71, '2000.00', '2025-03-17', 'paid', '2025-03-17 13:57:16', 'sample@gmail.com', '2025-03-17 13:57:16', NULL, NULL, NULL),
(1041, 71, '1000.00', '2025-04-17', 'pending', '2025-03-17 13:57:16', 'sample@gmail.com', '2025-03-17 13:57:16', NULL, NULL, NULL),
(1042, 71, '1000.00', '2025-05-17', 'pending', '2025-03-17 13:57:16', 'sample@gmail.com', '2025-03-17 13:57:16', NULL, NULL, NULL),
(1043, 71, '1000.00', '2025-06-17', 'pending', '2025-03-17 13:57:16', 'sample@gmail.com', '2025-03-17 13:57:16', NULL, NULL, NULL),
(1044, 71, '1000.00', '2025-07-17', 'pending', '2025-03-17 13:57:16', 'sample@gmail.com', '2025-03-17 13:57:16', NULL, NULL, NULL),
(1045, 71, '1000.00', '2025-08-17', 'pending', '2025-03-17 13:57:16', 'sample@gmail.com', '2025-03-17 13:57:16', NULL, NULL, NULL),
(1046, 71, '1000.00', '2025-09-17', 'pending', '2025-03-17 13:57:16', 'sample@gmail.com', '2025-03-17 13:57:16', NULL, NULL, NULL),
(1047, 71, '1000.00', '2025-10-17', 'pending', '2025-03-17 13:57:16', 'sample@gmail.com', '2025-03-17 13:57:16', NULL, NULL, NULL),
(1048, 71, '1000.00', '2025-11-17', 'pending', '2025-03-17 13:57:16', 'sample@gmail.com', '2025-03-17 13:57:16', NULL, NULL, NULL),
(1049, 71, '1000.00', '2025-12-17', 'pending', '2025-03-17 13:57:16', 'sample@gmail.com', '2025-03-17 13:57:16', NULL, NULL, NULL),
(1050, 71, '1000.00', '2026-01-17', 'pending', '2025-03-17 13:57:16', 'sample@gmail.com', '2025-03-17 13:57:16', NULL, NULL, NULL),
(1051, 72, '2000.00', '2025-03-20', 'paid', '2025-03-20 15:57:29', 'sample@gmail.com', '2025-03-20 15:57:29', NULL, NULL, NULL),
(1052, 72, '1000.00', '2025-04-20', 'paid', '2025-03-20 15:57:29', 'sample@gmail.com', '2025-03-20 15:59:50', 'sample@gmail.com', NULL, NULL),
(1053, 72, '1000.00', '2025-05-20', 'paid', '2025-03-20 15:57:29', 'sample@gmail.com', '2025-03-20 15:59:50', 'sample@gmail.com', NULL, NULL),
(1054, 72, '1000.00', '2025-06-20', 'paid', '2025-03-20 15:57:29', 'sample@gmail.com', '2025-03-20 15:59:50', 'sample@gmail.com', NULL, NULL),
(1055, 72, '1000.00', '2025-07-20', 'paid', '2025-03-20 15:57:29', 'sample@gmail.com', '2025-03-20 16:14:01', 'sample@gmail.com', NULL, NULL),
(1056, 72, '1000.00', '2025-08-20', 'paid', '2025-03-20 15:57:29', 'sample@gmail.com', '2025-03-20 16:14:01', 'sample@gmail.com', NULL, NULL),
(1057, 72, '1000.00', '2025-09-20', 'paid', '2025-03-20 15:57:29', 'sample@gmail.com', '2025-03-20 16:14:01', 'sample@gmail.com', NULL, NULL),
(1058, 72, '1000.00', '2025-10-20', 'paid', '2025-03-20 15:57:29', 'sample@gmail.com', '2025-03-20 16:14:01', 'sample@gmail.com', NULL, NULL),
(1059, 72, '1000.00', '2025-11-20', 'paid', '2025-03-20 15:57:29', 'sample@gmail.com', '2025-03-20 16:14:01', 'sample@gmail.com', NULL, NULL),
(1060, 73, '3000.00', '2025-04-15', 'paid', '2025-04-15 08:23:04', 'sample@gmail.com', '2025-04-15 08:23:04', NULL, NULL, NULL),
(1061, 73, '1000.00', '2025-05-15', 'pending', '2025-04-15 08:23:04', 'sample@gmail.com', '2025-04-15 08:23:04', NULL, NULL, NULL),
(1062, 73, '1000.00', '2025-06-15', 'pending', '2025-04-15 08:23:04', 'sample@gmail.com', '2025-04-15 08:23:04', NULL, NULL, NULL),
(1063, 73, '1000.00', '2025-07-15', 'pending', '2025-04-15 08:23:04', 'sample@gmail.com', '2025-04-15 08:23:04', NULL, NULL, NULL),
(1064, 73, '1000.00', '2025-08-15', 'pending', '2025-04-15 08:23:04', 'sample@gmail.com', '2025-04-15 08:23:04', NULL, NULL, NULL),
(1065, 73, '1000.00', '2025-09-15', 'pending', '2025-04-15 08:23:04', 'sample@gmail.com', '2025-04-15 08:23:04', NULL, NULL, NULL),
(1066, 73, '1000.00', '2025-10-15', 'pending', '2025-04-15 08:23:04', 'sample@gmail.com', '2025-04-15 08:23:04', NULL, NULL, NULL),
(1067, 73, '1000.00', '2025-11-15', 'pending', '2025-04-15 08:23:04', 'sample@gmail.com', '2025-04-15 08:23:04', NULL, NULL, NULL),
(1068, 74, '1000.00', '2025-04-15', 'paid', '2025-04-15 15:29:27', 'sample@gmail.com', '2025-04-15 15:29:27', NULL, NULL, NULL),
(1069, 75, '5000.00', '2025-04-15', 'paid', '2025-04-15 15:42:57', 'sample@gmail.com', '2025-04-15 15:42:57', NULL, NULL, NULL),
(1070, 75, '1000.00', '2025-05-15', 'pending', '2025-04-15 15:42:57', 'sample@gmail.com', '2025-04-15 15:42:57', NULL, NULL, NULL),
(1071, 75, '1000.00', '2025-06-15', 'pending', '2025-04-15 15:42:57', 'sample@gmail.com', '2025-04-15 15:42:57', NULL, NULL, NULL),
(1072, 75, '1000.00', '2025-07-15', 'pending', '2025-04-15 15:42:57', 'sample@gmail.com', '2025-04-15 15:42:57', NULL, NULL, NULL),
(1073, 75, '1000.00', '2025-08-15', 'pending', '2025-04-15 15:42:57', 'sample@gmail.com', '2025-04-15 15:42:57', NULL, NULL, NULL),
(1074, 75, '1000.00', '2025-09-15', 'pending', '2025-04-15 15:42:57', 'sample@gmail.com', '2025-04-15 15:42:57', NULL, NULL, NULL),
(1075, 76, '3000.00', '2025-04-21', 'paid', '2025-04-21 10:30:51', 'sample@gmail.com', '2025-04-21 10:30:51', NULL, NULL, NULL),
(1076, 76, '1000.00', '2025-05-21', 'pending', '2025-04-21 10:30:51', 'sample@gmail.com', '2025-04-21 10:30:51', NULL, NULL, NULL),
(1077, 76, '1000.00', '2025-06-21', 'pending', '2025-04-21 10:30:51', 'sample@gmail.com', '2025-04-21 10:30:51', NULL, NULL, NULL),
(1078, 76, '1000.00', '2025-07-21', 'pending', '2025-04-21 10:30:51', 'sample@gmail.com', '2025-04-21 10:30:51', NULL, NULL, NULL),
(1079, 76, '1000.00', '2025-08-21', 'pending', '2025-04-21 10:30:51', 'sample@gmail.com', '2025-04-21 10:30:51', NULL, NULL, NULL),
(1080, 76, '1000.00', '2025-09-21', 'pending', '2025-04-21 10:30:51', 'sample@gmail.com', '2025-04-21 10:30:51', NULL, NULL, NULL),
(1081, 76, '1000.00', '2025-10-21', 'pending', '2025-04-21 10:30:51', 'sample@gmail.com', '2025-04-21 10:30:51', NULL, NULL, NULL),
(1082, 76, '1000.00', '2025-11-21', 'pending', '2025-04-21 10:30:51', 'sample@gmail.com', '2025-04-21 10:30:51', NULL, NULL, NULL),
(1101, 77, '2000.00', '2025-04-23', 'paid', '2025-04-23 16:17:42', 'sample@gmail.com', '2025-04-23 16:17:42', NULL, NULL, NULL),
(1102, 77, '1000.00', '2025-05-23', 'paid', '2025-04-23 16:17:42', 'sample@gmail.com', '2025-04-25 10:57:25', 'sample@gmail.com', NULL, NULL),
(1103, 77, '1000.00', '2025-06-23', 'paid', '2025-04-23 16:17:42', 'sample@gmail.com', '2025-04-25 10:57:25', 'sample@gmail.com', NULL, NULL),
(1104, 77, '1000.00', '2025-07-23', 'paid', '2025-04-23 16:17:42', 'sample@gmail.com', '2025-04-25 10:57:25', 'sample@gmail.com', NULL, NULL),
(1105, 77, '1000.00', '2025-08-23', 'paid', '2025-04-23 16:17:42', 'sample@gmail.com', '2025-04-25 13:25:32', 'sample@gmail.com', NULL, NULL),
(1106, 77, '1000.00', '2025-09-23', 'paid', '2025-04-23 16:17:42', 'sample@gmail.com', '2025-04-25 13:25:32', 'sample@gmail.com', NULL, NULL),
(1107, 77, '1000.00', '2025-10-23', 'paid', '2025-04-23 16:17:42', 'sample@gmail.com', '2025-04-25 13:40:41', 'sample@gmail.com', NULL, NULL),
(1108, 77, '1000.00', '2025-11-23', 'paid', '2025-04-23 16:17:42', 'sample@gmail.com', '2025-04-25 13:40:41', 'sample@gmail.com', NULL, NULL),
(1109, 77, '1000.00', '2025-12-23', 'paid', '2025-04-23 16:17:42', 'sample@gmail.com', '2025-04-25 14:06:45', 'sample@gmail.com', NULL, NULL),
(1110, 78, '2000.00', '2025-04-25', 'paid', '2025-04-25 14:43:29', 'sample@gmail.com', '2025-04-25 14:43:30', NULL, NULL, NULL),
(1111, 78, '1000.00', '2025-05-25', 'paid', '2025-04-25 14:43:29', 'sample@gmail.com', '2025-04-25 14:46:34', 'sample@gmail.com', NULL, NULL),
(1112, 78, '1000.00', '2025-06-25', 'paid', '2025-04-25 14:43:29', 'sample@gmail.com', '2025-04-25 14:46:34', 'sample@gmail.com', NULL, NULL),
(1113, 78, '1000.00', '2025-07-25', 'paid', '2025-04-25 14:43:29', 'sample@gmail.com', '2025-04-25 14:46:34', 'sample@gmail.com', NULL, NULL),
(1114, 78, '1000.00', '2025-08-25', 'paid', '2025-04-25 14:43:29', 'sample@gmail.com', '2025-04-25 15:58:13', 'sample@gmail.com', NULL, NULL),
(1115, 78, '1000.00', '2025-09-25', 'paid', '2025-04-25 14:43:29', 'sample@gmail.com', '2025-04-25 15:58:13', 'sample@gmail.com', NULL, NULL),
(1116, 78, '1000.00', '2025-10-25', 'pending', '2025-04-25 14:43:29', 'sample@gmail.com', '2025-04-25 14:43:30', NULL, NULL, NULL),
(1117, 78, '1000.00', '2025-11-25', 'pending', '2025-04-25 14:43:29', 'sample@gmail.com', '2025-04-25 14:43:30', NULL, NULL, NULL),
(1118, 78, '1000.00', '2025-12-25', 'pending', '2025-04-25 14:43:29', 'sample@gmail.com', '2025-04-25 14:43:30', NULL, NULL, NULL),
(1128, 83, '2000.00', '2025-05-06', 'paid', '2025-05-06 13:01:13', 'sample@gmail.com', '2025-05-06 13:01:13', NULL, NULL, NULL),
(1129, 83, '2000.00', '2025-06-06', 'paid', '2025-05-06 13:01:13', 'sample@gmail.com', '2025-05-06 13:03:34', 'sample@gmail.com', NULL, NULL),
(1130, 83, '2000.00', '2025-07-06', 'paid', '2025-05-06 13:01:13', 'sample@gmail.com', '2025-05-06 13:03:34', 'sample@gmail.com', NULL, NULL),
(1131, 83, '2000.00', '2025-08-06', 'paid', '2025-05-06 13:01:13', 'sample@gmail.com', '2025-05-06 13:03:34', 'sample@gmail.com', NULL, NULL),
(1132, 83, '2000.00', '2025-09-06', 'pending', '2025-05-06 13:01:13', 'sample@gmail.com', '2025-05-06 13:01:13', NULL, NULL, NULL),
(1133, 83, '2000.00', '2025-10-06', 'pending', '2025-05-06 13:01:13', 'sample@gmail.com', '2025-05-06 13:01:13', NULL, NULL, NULL),
(1134, 83, '2000.00', '2025-11-06', 'pending', '2025-05-06 13:01:13', 'sample@gmail.com', '2025-05-06 13:01:13', NULL, NULL, NULL),
(1135, 83, '2000.00', '2025-12-06', 'pending', '2025-05-06 13:01:13', 'sample@gmail.com', '2025-05-06 13:01:13', NULL, NULL, NULL),
(1136, 83, '2000.00', '2026-01-06', 'pending', '2025-05-06 13:01:13', 'sample@gmail.com', '2025-05-06 13:01:13', NULL, NULL, NULL),
(1137, 83, '2000.00', '2026-02-06', 'pending', '2025-05-06 13:01:13', 'sample@gmail.com', '2025-05-06 13:01:13', NULL, NULL, NULL),
(1138, 84, '2000.00', '2025-05-06', 'paid', '2025-05-06 13:15:38', 'sample@gmail.com', '2025-05-06 13:15:38', NULL, NULL, NULL),
(1139, 84, '1000.00', '2025-06-06', 'pending', '2025-05-06 13:15:38', 'sample@gmail.com', '2025-05-06 13:15:38', NULL, NULL, NULL),
(1140, 84, '1000.00', '2025-07-06', 'pending', '2025-05-06 13:15:38', 'sample@gmail.com', '2025-05-06 13:15:38', NULL, NULL, NULL),
(1141, 84, '1000.00', '2025-08-06', 'pending', '2025-05-06 13:15:38', 'sample@gmail.com', '2025-05-06 13:15:38', NULL, NULL, NULL),
(1142, 84, '1000.00', '2025-09-06', 'pending', '2025-05-06 13:15:38', 'sample@gmail.com', '2025-05-06 13:15:38', NULL, NULL, NULL),
(1143, 84, '1000.00', '2025-10-06', 'pending', '2025-05-06 13:15:38', 'sample@gmail.com', '2025-05-06 13:15:38', NULL, NULL, NULL),
(1144, 84, '1000.00', '2025-11-06', 'pending', '2025-05-06 13:15:38', 'sample@gmail.com', '2025-05-06 13:15:38', NULL, NULL, NULL),
(1145, 84, '1000.00', '2025-12-06', 'pending', '2025-05-06 13:15:38', 'sample@gmail.com', '2025-05-06 13:15:38', NULL, NULL, NULL),
(1146, 84, '1000.00', '2026-01-06', 'pending', '2025-05-06 13:15:38', 'sample@gmail.com', '2025-05-06 13:15:38', NULL, NULL, NULL),
(1147, 85, '2000.00', '2025-05-06', 'paid', '2025-05-06 17:06:00', 'sample@gmail.com', '2025-05-06 17:06:00', NULL, NULL, NULL),
(1148, 85, '2000.00', '2025-06-06', 'pending', '2025-05-06 17:06:00', 'sample@gmail.com', '2025-05-06 17:06:00', NULL, NULL, NULL),
(1149, 85, '2000.00', '2025-07-06', 'pending', '2025-05-06 17:06:00', 'sample@gmail.com', '2025-05-06 17:06:00', NULL, NULL, NULL),
(1150, 85, '2000.00', '2025-08-06', 'pending', '2025-05-06 17:06:00', 'sample@gmail.com', '2025-05-06 17:06:00', NULL, NULL, NULL),
(1151, 85, '2000.00', '2025-09-06', 'pending', '2025-05-06 17:06:00', 'sample@gmail.com', '2025-05-06 17:06:00', NULL, NULL, NULL),
(1152, 85, '2000.00', '2025-10-06', 'pending', '2025-05-06 17:06:00', 'sample@gmail.com', '2025-05-06 17:06:00', NULL, NULL, NULL),
(1153, 85, '2000.00', '2025-11-06', 'pending', '2025-05-06 17:06:00', 'sample@gmail.com', '2025-05-06 17:06:00', NULL, NULL, NULL),
(1154, 85, '2000.00', '2025-12-06', 'pending', '2025-05-06 17:06:00', 'sample@gmail.com', '2025-05-06 17:06:00', NULL, NULL, NULL),
(1155, 85, '2000.00', '2026-01-06', 'pending', '2025-05-06 17:06:00', 'sample@gmail.com', '2025-05-06 17:06:00', NULL, NULL, NULL),
(1156, 85, '2000.00', '2026-02-06', 'pending', '2025-05-06 17:06:00', 'sample@gmail.com', '2025-05-06 17:06:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cashiering_invoice`
--

CREATE TABLE `cashiering_invoice` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `discount` int DEFAULT '0',
  `amount` decimal(15,2) DEFAULT '0.00',
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
(1079, 132, 'INV-202504301458367373', 0, '500.00', '2025-04-30', NULL, 'Sample Cashier', NULL, 'system', '2025-05-02 04:26:32', 'sample@gmail.com', '2025-05-02 04:26:32', NULL, NULL, 'completed', 67, 1),
(1080, 132, 'INV-202504301517069077', 0, '2000.00', '2025-04-30', NULL, 'Sample Cashier', NULL, 'kath1234@mailinator.com', '2025-05-02 04:26:38', 'sample@gmail.com', '2025-05-02 04:26:38', NULL, NULL, 'completed', 67, 5),
(1081, 132, 'INV-202505021201369559', 0, '4000.00', '2025-05-02', NULL, 'Sample Cashier', NULL, 'kath1234@mailinator.com', '2025-05-02 04:26:45', 'sample@gmail.com', '2025-05-02 04:26:45', NULL, NULL, 'completed', 67, 2),
(1082, 132, 'INV-202505021228079594', 0, '364.16', '2025-05-02', NULL, 'Sample Cashier', NULL, 'sample@gmail.com', '2025-05-02 04:30:39', 'sample@gmail.com', '2025-05-02 04:30:39', NULL, NULL, 'completed', 67, 3),
(1083, 132, 'INV-202505021228079594', 0, '364.16', '2025-05-02', NULL, 'Sample Cashier', NULL, 'sample@gmail.com', '2025-05-02 04:32:06', 'sample@gmail.com', '2025-05-02 04:32:06', NULL, NULL, 'completed', 67, 3),
(1084, 132, 'INV-202505021228079594', 0, '364.18', '2025-05-02', NULL, 'Sample Cashier', NULL, 'sample@gmail.com', '2025-05-02 04:32:12', 'sample@gmail.com', '2025-05-02 04:32:12', NULL, NULL, 'completed', 67, 3),
(1085, 139, 'INV-202505060837493880', 0, '500.00', '2025-05-06', NULL, 'Sample Cashier', NULL, 'system', '2025-05-06 00:44:00', 'sample@gmail.com', '2025-05-06 00:43:59', NULL, NULL, 'completed', 69, 1),
(1086, 139, 'INV-202505060837491187', 0, '2000.00', '2025-05-06', NULL, NULL, NULL, 'system', '2025-05-06 00:37:49', 'system', '2025-05-06 00:37:49', NULL, NULL, 'payment-initiated', 69, 2),
(1089, 132, 'INV-202505061120558209', 0, '500.00', '2025-05-06', NULL, 'Sample Cashier', NULL, 'system', '2025-05-06 04:01:33', 'sample@gmail.com', '2025-05-06 04:01:33', NULL, NULL, 'completed', 68, 1),
(1090, 132, 'INV-202505061120552166', 0, '2000.00', '2025-05-06', NULL, 'Sample Cashier', NULL, 'system', '2025-05-06 04:01:44', 'sample@gmail.com', '2025-05-06 04:01:44', NULL, NULL, 'completed', 68, 5),
(1105, 132, 'INV-202505061200231218', 0, '500.00', '2025-05-06', NULL, NULL, NULL, 'system', '2025-05-06 04:00:23', 'system', '2025-05-06 04:00:23', NULL, NULL, 'payment-initiated', 68, 1),
(1106, 132, 'INV-202505061200233881', 0, '2000.00', '2025-05-06', NULL, NULL, NULL, 'system', '2025-05-06 04:00:23', 'system', '2025-05-06 04:00:23', NULL, NULL, 'payment-initiated', 68, 5),
(1107, 142, 'INV-202505061300206924', 0, '500.00', '2025-05-06', NULL, 'Sample Cashier', NULL, 'system', '2025-05-06 05:01:03', 'sample@gmail.com', '2025-05-06 05:01:03', NULL, NULL, 'completed', 70, 1),
(1108, 142, 'INV-202505061300207556', 0, '2000.00', '2025-05-06', NULL, 'Sample Cashier', NULL, 'system', '2025-05-06 05:01:13', 'sample@gmail.com', '2025-05-06 05:01:13', NULL, NULL, 'completed', 70, 5),
(1109, 142, 'INV-202505061303001066', 0, '6000.00', '2025-05-06', NULL, 'Sample Cashier', NULL, 'kathrina123456@mailinator.com', '2025-05-06 05:03:34', 'sample@gmail.com', '2025-05-06 05:03:34', NULL, NULL, 'completed', 70, 2),
(1110, 144, 'INV-202505061315003398', 0, '500.00', '2025-05-06', NULL, 'Sample Cashier', NULL, 'system', '2025-05-06 05:15:28', 'sample@gmail.com', '2025-05-06 05:15:28', NULL, NULL, 'completed', 71, 1),
(1111, 144, 'INV-202505061315009061', 0, '2000.00', '2025-05-06', NULL, 'Sample Cashier', NULL, 'system', '2025-05-06 05:15:38', 'sample@gmail.com', '2025-05-06 05:15:38', NULL, NULL, 'completed', 71, 5),
(1112, 145, 'INV-202505061659176248', 0, '500.00', '2025-05-06', NULL, 'Sample Cashier', NULL, 'system', '2025-05-06 09:05:52', 'sample@gmail.com', '2025-05-06 09:05:52', NULL, NULL, 'completed', 72, 1),
(1113, 145, 'INV-202505061659175102', 0, '2000.00', '2025-05-06', NULL, 'Sample Cashier', NULL, 'system', '2025-05-06 09:06:00', 'sample@gmail.com', '2025-05-06 09:06:00', NULL, NULL, 'completed', 72, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cash_accounts`
--

CREATE TABLE `cash_accounts` (
  `id` int NOT NULL,
  `cash_lvl_3_id` int NOT NULL,
  `code_of_cash_account` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cash_accounts`
--

INSERT INTO `cash_accounts` (`id`, `cash_lvl_3_id`, `code_of_cash_account`, `title`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 1, 1110001, 'Cash on Hand', 'Admin', NULL, 'Admin', NULL, NULL, NULL),
(2, 1, 1110002, 'Petty Cash', 'Admin', NULL, 'Admin', NULL, NULL, NULL),
(3, 2, 2110001, 'Savings Deposit', 'Admin', NULL, 'Admin', NULL, NULL, NULL),
(4, 3, 3110001, 'Subscribe Share Capital Common', 'Admin', NULL, 'Admin', NULL, NULL, NULL),
(5, 6, 4420001, 'Membership Fees', 'Admin', NULL, 'Admin', NULL, NULL, NULL),
(6, 7, 3150001, 'Subscribe share capital - Preferred', 'Admin', NULL, 'Admin', NULL, NULL, NULL),
(7, 8, 3120001, 'Subscription Receivable – Common', 'user123', NULL, NULL, NULL, NULL, NULL),
(8, 8, 3130001, 'Paid-up Share Capital – Common', 'user123', NULL, NULL, NULL, NULL, NULL),
(9, 2, 1212123, 'Loans receivable - current', NULL, '2025-01-21 05:09:58', NULL, '2025-01-21 05:09:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cash_lvl_1`
--

CREATE TABLE `cash_lvl_1` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cash_lvl_1`
--

INSERT INTO `cash_lvl_1` (`id`, `code`, `title`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 1000000, 'Assets', 'Admin', NULL, NULL, NULL, NULL, NULL),
(2, 2000000, 'Liabilities', 'Admin', NULL, NULL, NULL, NULL, NULL),
(3, 3000000, 'Equity', 'Admin', NULL, NULL, NULL, NULL, NULL),
(4, 4000000, 'Revenues', 'Admin', NULL, NULL, NULL, NULL, NULL),
(5, 5000000, 'Cost to generate revenues', 'Admin', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cash_lvl_2`
--

CREATE TABLE `cash_lvl_2` (
  `id` int NOT NULL,
  `cash_lvl_1_id` int NOT NULL,
  `code` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cash_lvl_2`
--

INSERT INTO `cash_lvl_2` (`id`, `cash_lvl_1_id`, `code`, `title`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 1, 1100000, 'Current assets', 'Admin', NULL, NULL, NULL, NULL, NULL),
(2, 2, 2100000, 'Current liabilities', 'Admin', NULL, NULL, NULL, NULL, NULL),
(3, 3, 3100000, 'Members equity', 'Admin', NULL, NULL, NULL, NULL, NULL),
(4, 4, 4100000, 'Revenues', 'Admin', NULL, NULL, NULL, NULL, NULL),
(5, 5, 5100000, 'Cost of Goods sold', 'Admin', NULL, NULL, NULL, NULL, NULL),
(6, 4, 4400000, 'Other income', 'Admin', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cash_lvl_3`
--

CREATE TABLE `cash_lvl_3` (
  `id` int NOT NULL,
  `cash_lvl_2_id` int NOT NULL,
  `code` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cash_lvl_3`
--

INSERT INTO `cash_lvl_3` (`id`, `cash_lvl_2_id`, `code`, `title`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 1, 1110000, 'Cash and cash Equivalents', 'Admin', NULL, NULL, NULL, NULL, NULL),
(2, 2, 2110000, 'Deposit liabilities', 'Admin', NULL, NULL, NULL, NULL, NULL),
(3, 3, 3110000, 'Subscribe Share Capital Common', 'Admin', NULL, NULL, NULL, NULL, NULL),
(4, 4, 4110000, 'Interest Income from loans', 'Admin', NULL, NULL, NULL, NULL, NULL),
(5, 5, 5110000, 'Cost of Goods sold', 'Admin', NULL, NULL, NULL, NULL, NULL),
(6, 6, 44200000, 'Membership Fees', 'Admin', NULL, NULL, NULL, NULL, NULL),
(7, 3, 3150000, 'Subscribe Share Capital - Preferred', 'Admin', NULL, NULL, NULL, NULL, NULL),
(8, 3, 3120000, 'Subscription Receivable – Common', 'user123', '2024-08-31 02:00:00', 'user123', '2024-08-31 02:00:00', NULL, NULL),
(9, 3, 3130000, 'Paid-up Share Capital – Common', 'user123', '2024-08-31 02:00:00', 'user123', '2024-08-31 02:00:00', NULL, NULL),
(10, 2, 1120000, 'Loans and Receivables\r\n', NULL, '2025-01-21 04:41:32', NULL, '2025-01-21 04:41:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int NOT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `department_head` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `department_head`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Finance Division', 'CPA. Nguyen', 'Finance and cashiering', '2024-09-13 09:18:13', 'john.doe@example.com', '2025-03-07 03:00:10', 'john.doe@example.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
--

CREATE TABLE `email_verifications` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `email_verifications`
--

INSERT INTO `email_verifications` (`id`, `user_id`, `code`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(23, 76, '187454', '2025-02-11 03:02:24', 'danielPadilla@gmail.com', '2025-02-11 03:02:39', 'person@gmail.com', NULL, NULL),
(24, 77, '338166', '2025-02-11 05:37:48', 'kathrinavaldezco553@gmail.com', '2025-02-11 05:44:48', 'danielPadilla@gmail.com', NULL, NULL),
(25, 78, '348952', '2025-02-13 08:18:51', 'jd@gmail.com', '2025-02-13 08:19:05', 'kathrinavaldezco553@gmail.com', NULL, NULL),
(26, 79, '751587', '2025-02-14 01:24:05', 'Dayonela@gmail.com', '2025-02-14 01:24:28', 'jd@gmail.com', NULL, NULL),
(27, 80, '395026', '2025-02-14 07:35:29', 'rdumalo89@gmail.com', '2025-02-14 07:36:12', 'jane@gmail.com', NULL, NULL),
(28, 81, '179408', '2025-02-17 08:08:17', 'annaMarilag@gmail.com', '2025-02-17 08:08:28', 'Dayonela@gmail.com', NULL, NULL),
(29, 83, '942699', '2025-03-03 02:36:06', 'claire_buenaventura@gmail.com', '2025-03-03 02:36:06', NULL, NULL, NULL),
(40, 84, '766484', '2025-03-03 03:23:54', 'maja_salvador@gmail.com', '2025-03-03 03:23:54', NULL, NULL, NULL),
(41, 84, '559478', '2025-03-03 05:49:17', 'maja_salvador@gmail.com', '2025-03-03 05:49:17', NULL, NULL, NULL),
(42, 84, '185552', '2025-03-03 06:56:29', 'maja_salvador@gmail.com', '2025-03-03 06:56:30', NULL, NULL, NULL),
(43, 84, '443259', '2025-03-03 07:07:07', 'maja_salvador@gmail.com', '2025-03-03 07:07:07', NULL, NULL, NULL),
(44, 84, '452079', '2025-03-03 07:07:44', 'maja_salvador@gmail.com', '2025-03-03 07:07:44', NULL, NULL, NULL),
(45, 84, '773068', '2025-03-03 07:08:03', 'maja_salvador@gmail.com', '2025-03-03 07:08:03', NULL, NULL, NULL),
(46, 84, '406504', '2025-03-03 07:11:24', 'maja_salvador@gmail.com', '2025-03-03 07:11:24', NULL, NULL, NULL),
(47, 84, '346758', '2025-03-03 07:11:59', 'maja_salvador@gmail.com', '2025-03-03 07:27:47', 'Dayonela@gmail.com', NULL, NULL),
(48, 85, '123887', '2025-03-04 01:28:54', 'john_cena@gmail.com', '2025-03-04 01:29:29', 'maja_salvador@gmail.com', NULL, NULL),
(49, 86, '859454', '2025-03-05 07:26:53', 'erlinda@gmail.com', '2025-03-05 07:27:01', 'maja_salvador@gmail.com', NULL, NULL),
(50, 87, '370149', '2025-03-06 06:05:54', 'dinae@gmail.com', '2025-03-06 06:06:00', 'erlinda@gmail.com', NULL, NULL),
(51, 88, '976453', '2025-03-11 06:27:25', 'bj@gmail.com', '2025-03-11 06:27:32', 'dinae@gmail.com', NULL, NULL),
(52, 89, '548514', '2025-03-12 07:01:46', 'bhorsman@gmail.com', '2025-03-12 07:01:55', 'dinae@gmail.com', NULL, NULL),
(53, 90, '220161', '2025-03-13 01:55:38', 'jennifermiranda@gmail.com', '2025-03-13 01:56:00', 'bj@gmail.com', NULL, NULL),
(54, 91, '649203', '2025-03-17 05:54:07', 'Ak@gmail.com', '2025-03-17 05:54:26', 'bhorsman@gmail.com', NULL, NULL),
(55, 92, '792099', '2025-03-19 06:44:29', 'ally@gmail.com', '2025-03-19 06:44:36', 'Ak@gmail.com', NULL, NULL),
(56, 93, '620956', '2025-03-20 07:50:20', 'hev@gmail.com', '2025-03-20 07:50:25', 'Ak@gmail.com', NULL, NULL),
(73, 110, '126859', '2025-04-02 01:57:46', 'kathvaldezcoronquillo@gmail.com', '2025-04-02 01:58:09', 'hev@gmail.com', NULL, NULL),
(74, 111, '160724', '2025-04-14 00:36:28', 'kathvaldezcoronquillo@gmail.com', '2025-04-14 00:37:53', 'hev@gmail.com', NULL, NULL),
(75, 112, '263485', '2025-04-14 18:35:36', 'cbd-coop@gmail.com', '2025-04-14 18:36:24', 'kathrinavaldezco553@gmail.com', NULL, NULL),
(76, 113, '464760', '2025-04-15 03:00:40', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 03:00:41', NULL, NULL, NULL),
(77, 113, '541179', '2025-04-15 03:08:01', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 03:08:01', NULL, NULL, NULL),
(78, 113, '180125', '2025-04-15 06:29:34', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 06:29:35', NULL, NULL, NULL),
(80, 113, '322626', '2025-04-15 06:30:48', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 06:31:13', 'dinae@gmail.com', NULL, NULL),
(81, 114, '303098', '2025-04-15 07:15:30', 'pamelavivientballesteros@gmail.com', '2025-04-15 07:15:55', 'sysadmin', NULL, NULL),
(82, 115, '138634', '2025-04-15 07:15:39', 'jeremy23deguzman@gmail.com', '2025-04-15 07:17:38', 'sysadmin', NULL, NULL),
(92, 125, '710891', '2025-04-23 08:01:30', 'kathvaldezcoronquillo@gmail.com', '2025-04-23 08:02:52', 'kathrinavaldezco553@gmail.com', NULL, NULL),
(96, 129, '884728', '2025-04-25 06:36:21', 'gtest88@gmail.com', '2025-04-25 06:36:22', NULL, NULL, NULL),
(97, 130, '900441', '2025-04-25 06:38:33', 'gtest8833@gmail.com', '2025-04-25 06:39:58', 'bhorsman@gmail.com', NULL, NULL),
(98, 131, '626432', '2025-04-28 00:45:45', 'kath123@gmail.com', '2025-04-28 00:45:46', NULL, NULL, NULL),
(99, 131, '969833', '2025-04-28 02:45:54', 'kath123@gmail.com', '2025-04-28 02:45:54', NULL, NULL, NULL),
(100, 132, '870697', '2025-04-28 02:46:23', 'kath1234@mailinator.com', '2025-04-28 02:46:23', NULL, NULL, NULL),
(101, 132, '621036', '2025-04-28 02:51:33', 'kath1234@mailinator.com', '2025-04-28 02:53:18', 'gtest8833@gmail.com', NULL, NULL),
(108, 139, '748221', '2025-05-05 08:41:05', 'kath-test@mailinator.com', '2025-05-05 08:46:06', 'gtest8833@gmail.com', NULL, NULL),
(109, 140, '912251', '2025-05-06 04:39:13', 'kathtest@mailinator.com', '2025-05-06 04:39:13', NULL, NULL, NULL),
(110, 141, '819059', '2025-05-06 04:44:28', 'kath123@mailinator.com', '2025-05-06 04:44:28', NULL, NULL, NULL),
(111, 142, '560501', '2025-05-06 04:56:33', 'kathrina123456@mailinator.com', '2025-05-06 04:58:02', 'kath1234@mailinator.com', NULL, NULL),
(112, 143, '547705', '2025-05-06 05:08:52', 'kathrina1234567@mailinator.com', '2025-05-06 05:08:52', NULL, NULL, NULL),
(113, 144, '474093', '2025-05-06 05:10:45', 'kath1234567@mailinator.com', '2025-05-06 05:12:18', 'kathrina123456@mailinator.com', NULL, NULL),
(114, 145, '400195', '2025-05-06 05:26:32', 'kath12345678@mailinator.com', '2025-05-06 05:28:57', 'kath1234@mailinator.com', NULL, NULL),
(115, 146, '763619', '2025-05-06 09:28:07', 'lago-test@mailinator.com', '2025-05-06 09:28:07', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'Employee',
  `department_id` int NOT NULL,
  `position_id` int NOT NULL,
  `unit_id` int NOT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `birth_place` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_hired` date DEFAULT NULL,
  `status` enum('Employed','Resigned','Terminated') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `first_name`, `last_name`, `middle_name`, `role`, `department_id`, `position_id`, `unit_id`, `sex`, `date_of_birth`, `birth_place`, `mobile_number`, `email`, `date_hired`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(2, 82, 'sample', 'sample', 'sample', 'Employee', 1, 1, 1, 'female', '2005-10-04', 'NCR', '09182345000', 'kathrinavaldezco@gmail.com', '2022-10-10', 'Employed', '2025-02-19 06:46:26', 'sysadmin', '2025-02-19 06:46:26', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `calendar_id` int DEFAULT NULL,
  `creator_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `location` varchar(255) DEFAULT NULL,
  `video_link` varchar(255) DEFAULT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `is_all_day` tinyint(1) DEFAULT '0',
  `recurrence_rule` text,
  `recurrence_end` datetime DEFAULT NULL,
  `visibility` enum('default','public','private') DEFAULT 'default',
  `status` enum('confirmed','tentative','cancelled') DEFAULT 'confirmed',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `calendar_id`, `creator_id`, `title`, `description`, `location`, `video_link`, `start_datetime`, `end_datetime`, `is_all_day`, `recurrence_rule`, `recurrence_end`, `visibility`, `status`, `created_at`, `updated_at`, `created_by`, `deleted_at`, `deleted_by`) VALUES
(1, 5, 2, 'Coopeartive Seminar and Training', 'This event is conducted in compliance to the membership process of the cooperative', 'DON ROCES AVE', 'https://shopee.ph/search?keyword=trophy', '2025-04-14 22:32:00', '2025-04-14 23:33:00', 0, NULL, NULL, 'default', 'confirmed', '2025-04-14 22:36:19', '2025-04-15 00:25:22', 'john.doe@example.com', NULL, NULL),
(2, 1, 2, 'Cooperative webinar', 'In compliance to the cooperative membership process', 'DON ROCES AVE', 'https://chatgpt.com/c/67fd54dc-6768-800d-a6a0-552b35ebe05b', '2025-04-15 02:33:00', '2025-04-19 02:33:00', 0, NULL, NULL, 'default', 'confirmed', '2025-04-15 02:34:14', '2025-04-15 02:34:14', 'john.doe@example.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_attendees`
--

CREATE TABLE `event_attendees` (
  `id` int NOT NULL,
  `event_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `response_status` enum('accepted','declined','tentative','needsAction') DEFAULT 'needsAction',
  `is_organizer` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_attendees`
--

INSERT INTO `event_attendees` (`id`, `event_id`, `user_id`, `response_status`, `is_organizer`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 111, 'accepted', 0, '2025-04-15 02:24:31', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL),
(2, 1, 111, 'accepted', 0, '2025-04-15 05:55:40', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL),
(3, 1, 113, 'accepted', 0, '2025-04-21 09:42:34', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL),
(4, 1, 125, 'accepted', 0, '2025-04-23 16:04:07', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL),
(5, 1, 130, 'accepted', 0, '2025-04-25 14:40:30', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL),
(6, 1, 132, 'accepted', 0, '2025-04-30 11:25:39', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL),
(7, 1, 142, 'accepted', 0, '2025-05-06 12:58:52', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL),
(8, 1, 144, 'accepted', 0, '2025-05-06 13:12:58', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL),
(9, 1, 145, 'accepted', 0, '2025-05-06 13:30:21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `financial_accounts`
--

CREATE TABLE `financial_accounts` (
  `id` int NOT NULL,
  `member_id` int NOT NULL,
  `method_id` int NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_type` varchar(255) DEFAULT NULL,
  `account_number` int DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `cvv_code` int DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `financial_accounts`
--

INSERT INTO `financial_accounts` (`id`, `member_id`, `method_id`, `account_name`, `account_type`, `account_number`, `exp_date`, `cvv_code`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(16, 46, 22, 'Kathrina Valdezco', 'Debit', 2147483647, NULL, NULL, 'kathrinavaldezco553@gmail.com', '2025-02-11 23:56:24', NULL, '2025-02-11 23:56:25', NULL, NULL),
(17, 49, 2, 'Jayson Derulo', 'online_banking', 2147483647, NULL, NULL, 'jd@gmail.com', '2025-02-13 08:51:46', NULL, '2025-02-13 08:51:46', NULL, NULL),
(18, 50, 22, 'Kathrina Valdezco', 'online_banking', 2147483647, NULL, NULL, 'Dayonela@gmail.com', '2025-02-14 01:45:57', NULL, '2025-02-14 01:45:57', NULL, NULL),
(19, 50, 11, 'John Doe', 'Debit', 2147483647, NULL, NULL, 'Dayonela@gmail.com', '2025-02-14 02:39:15', NULL, '2025-02-14 02:39:15', NULL, NULL),
(20, 50, 2, 'John Doe', 'Debit', 2147483647, NULL, NULL, 'Dayonela@gmail.com', '2025-02-14 06:30:30', NULL, '2025-02-14 06:30:31', NULL, NULL),
(21, 23, 2, 'Jane Doe', 'Debit', 78947845, NULL, NULL, 'jane@gmail.com', '2025-02-14 07:01:40', NULL, '2025-02-14 07:01:41', NULL, NULL),
(22, 23, 11, 'Jane Doe', 'Debit', 203232656, NULL, NULL, 'jane@gmail.com', '2025-02-14 07:12:40', NULL, '2025-02-14 07:12:40', NULL, NULL),
(23, 51, 11, 'Ralph Dumlao', 'Debit', 901290912, NULL, NULL, 'rdumalo89@gmail.com', '2025-02-14 07:44:04', NULL, '2025-02-14 07:44:04', NULL, NULL),
(24, 50, 11, 'John Doe', '3', 13567890, NULL, NULL, 'Dayonela@gmail.com', '2025-02-18 05:54:10', NULL, '2025-02-18 05:54:10', NULL, NULL),
(25, 23, 22, 'John Doe', '3', 2147483647, NULL, NULL, 'jane@gmail.com', '2025-02-28 09:02:37', NULL, '2025-02-28 09:02:37', NULL, NULL),
(26, 52, 2, 'John Doe', '3', 2147483647, NULL, NULL, 'maja_salvador@gmail.com', '2025-03-04 02:05:09', NULL, '2025-03-04 02:05:09', NULL, NULL),
(27, 52, 11, 'Maja Salvador', '3', 2147483647, NULL, NULL, 'maja_salvador@gmail.com', '2025-03-04 07:35:27', NULL, '2025-03-04 07:35:27', NULL, NULL),
(28, 53, 11, 'John Cena', '3', 2147483647, NULL, NULL, 'john_cena@gmail.com', '2025-03-05 02:25:24', NULL, '2025-03-05 02:25:24', NULL, NULL),
(29, 54, 2, 'Erlinda Montemayor', '4', 2147483647, NULL, NULL, 'erlinda@gmail.com', '2025-03-05 08:53:56', NULL, '2025-03-05 08:53:56', NULL, NULL),
(30, 55, 2, 'Diane Nguyen ', '3', 2147483647, NULL, NULL, 'dinae@gmail.com', '2025-03-06 06:11:25', NULL, '2025-03-06 06:11:25', NULL, NULL),
(31, 56, 22, 'Jane Doe', '4', 2147483647, NULL, NULL, 'bj@gmail.com', '2025-03-11 06:32:31', NULL, '2025-03-11 06:32:31', NULL, NULL),
(32, 57, 11, 'Jane Doe', '3', 2147483647, NULL, NULL, 'bhorsman@gmail.com', '2025-03-18 09:00:42', 'bhorsman@gmail.com', '2025-03-18 09:00:42', 'bhorsman@gmail.com', '2025-03-18 09:00:42'),
(33, 58, 2, 'Jane Doe', '4', 2147483647, NULL, NULL, 'Ak@gmail.com', '2025-03-19 04:19:41', NULL, '2025-03-19 04:19:41', 'Ak@gmail.com', '2025-03-19 04:19:41'),
(34, 58, 11, 'Jane Doe', '3', 2147483647, NULL, NULL, 'Ak@gmail.com', '2025-03-19 04:19:48', NULL, '2025-03-19 04:19:48', NULL, NULL),
(35, 59, 2, 'Jane Doe', '4', 2147483647, NULL, NULL, 'hev@gmail.com', '2025-03-20 07:57:59', NULL, '2025-03-20 07:57:59', NULL, NULL),
(36, 66, 2, 'Kathrina Valdezco', '3', 81992891, NULL, NULL, 'kathvaldezcoronquillo@gmail.com', '2025-04-15 00:28:06', NULL, '2025-04-15 00:28:06', NULL, NULL),
(37, 72, 2, 'Juana_test', '3', 2147483647, NULL, NULL, 'jeremy23deguzman@gmail.com', '2025-04-15 08:46:28', 'jeremy23deguzman@gmail.com', '2025-04-15 08:46:28', NULL, NULL),
(38, 74, 2, 'Jane Doe', '3', 2147483647, NULL, NULL, 'kathvaldezcoronquillo@gmail.com', '2025-04-21 08:04:19', NULL, '2025-04-21 08:04:19', NULL, NULL),
(42, 147, 11, 'Daniel Doe', '3', 2147483647, NULL, NULL, 'kathrina123456@mailinator.com', '2025-05-06 05:06:55', NULL, '2025-05-06 05:06:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investment_property_types`
--

CREATE TABLE `investment_property_types` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_particulars`
--

CREATE TABLE `invoice_particulars` (
  `id` int NOT NULL,
  `cashiering_invoice_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL,
  `unit_cost` int NOT NULL,
  `total_cost` int NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice_particulars`
--

INSERT INTO `invoice_particulars` (`id`, `cashiering_invoice_id`, `item_id`, `quantity`, `unit_cost`, `total_cost`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1016, 1056, 3, 1, 364, 364, 'sample@gmail.com', '2025-04-24 07:29:13', NULL, '2025-04-24 07:29:13', NULL, NULL),
(1017, 1057, 3, 1, 364, 364, 'sample@gmail.com', '2025-04-24 07:29:13', NULL, '2025-04-24 07:29:13', NULL, NULL),
(1018, 1058, 3, 1, 364, 364, 'sample@gmail.com', '2025-04-24 07:29:13', NULL, '2025-04-24 07:29:13', NULL, NULL),
(1019, 1059, 2, 1, 1000, 4000, 'kathvaldezcoronquillo@gmail.com', '2025-04-25 01:15:29', NULL, '2025-04-25 01:15:30', NULL, NULL),
(1020, 1060, 2, 1, 1000, 3000, 'kathvaldezcoronquillo@gmail.com', '2025-04-25 01:21:25', NULL, '2025-04-25 01:21:25', NULL, NULL),
(1021, 1061, 2, 1, 1000, 2000, 'kathvaldezcoronquillo@gmail.com', '2025-04-25 03:03:48', NULL, '2025-04-25 03:03:48', NULL, NULL),
(1022, 1062, 2, 1, 1000, 2000, 'kathvaldezcoronquillo@gmail.com', '2025-04-25 05:40:31', NULL, '2025-04-25 05:40:31', NULL, NULL),
(1023, 1063, 3, 1, 364, 364, 'sample@gmail.com', '2025-04-25 05:52:21', NULL, '2025-04-25 05:52:21', NULL, NULL),
(1024, 1064, 3, 1, 364, 364, 'sample@gmail.com', '2025-04-25 05:52:21', NULL, '2025-04-25 05:52:21', NULL, NULL),
(1025, 1065, 3, 1, 364, 364, 'sample@gmail.com', '2025-04-25 05:52:21', NULL, '2025-04-25 05:52:21', NULL, NULL),
(1026, 1066, 2, 1, 1000, 1000, 'kathvaldezcoronquillo@gmail.com', '2025-04-25 06:05:13', NULL, '2025-04-25 06:05:13', NULL, NULL),
(1027, 1067, 2, 1, 1000, 2000, 'bhorsman@gmail.com', '2025-04-25 06:16:01', NULL, '2025-04-25 06:16:02', NULL, NULL),
(1028, 1068, 1, 1, 500, 500, 'gtest8833@gmail.com', '2025-04-25 06:40:39', NULL, '2025-04-25 06:40:39', NULL, NULL),
(1029, 1069, 2, 1, 2000, 2000, 'gtest8833@gmail.com', '2025-04-25 06:41:20', NULL, '2025-04-25 06:41:21', NULL, NULL),
(1030, 1070, 2, 1, 1000, 3000, 'gtest8833@gmail.com', '2025-04-25 06:45:09', NULL, '2025-04-25 06:45:09', NULL, NULL),
(1031, 1071, 3, 1, 364, 364, 'sample@gmail.com', '2025-04-25 06:48:26', NULL, '2025-04-25 06:48:26', NULL, NULL),
(1032, 1072, 3, 1, 364, 364, 'sample@gmail.com', '2025-04-25 06:48:26', NULL, '2025-04-25 06:48:26', NULL, NULL),
(1033, 1073, 3, 1, 364, 364, 'sample@gmail.com', '2025-04-25 06:48:26', NULL, '2025-04-25 06:48:26', NULL, NULL),
(1034, 1074, 2, 1, 1000, 2000, 'gtest8833@gmail.com', '2025-04-25 07:57:31', NULL, '2025-04-25 07:57:31', NULL, NULL),
(1035, 1075, 1, 1, 500, 500, 'kath1234@mailinator.com', '2025-04-28 03:22:00', NULL, '2025-04-28 03:22:00', NULL, NULL),
(1036, 1076, 2, 1, 2000, 1000, 'kath1234@mailinator.com', '2025-04-28 03:22:16', NULL, '2025-04-28 03:22:16', NULL, NULL),
(1039, 1079, 1, 1, 500, 500, 'kath1234@mailinator.com', '2025-04-30 06:58:36', NULL, '2025-04-30 06:58:36', NULL, NULL),
(1040, 1080, 2, 1, 2000, 2000, 'kath1234@mailinator.com', '2025-04-30 07:17:06', NULL, '2025-04-30 07:17:06', NULL, NULL),
(1041, 1081, 2, 1, 1000, 4000, 'kath1234@mailinator.com', '2025-05-02 04:01:36', NULL, '2025-05-02 04:01:36', NULL, NULL),
(1042, 1082, 3, 1, 364, 364, 'sample@gmail.com', '2025-05-02 04:28:07', NULL, '2025-05-02 04:28:07', NULL, NULL),
(1043, 1083, 3, 1, 364, 364, 'sample@gmail.com', '2025-05-02 04:28:07', NULL, '2025-05-02 04:28:07', NULL, NULL),
(1044, 1084, 3, 1, 364, 364, 'sample@gmail.com', '2025-05-02 04:28:07', NULL, '2025-05-02 04:28:07', NULL, NULL),
(1045, 1085, 1, 1, 500, 500, 'kath-test@mailinator.com', '2025-05-06 00:37:49', NULL, '2025-05-06 00:37:49', NULL, NULL),
(1046, 1086, 1, 1, 2000, 2000, 'kath-test@mailinator.com', '2025-05-06 00:37:49', NULL, '2025-05-06 00:37:49', NULL, NULL),
(1049, 1089, 1, 1, 500, 500, 'kath1234@mailinator.com', '2025-05-06 03:20:55', NULL, '2025-05-06 03:20:55', NULL, NULL),
(1050, 1090, 1, 1, 2000, 2000, 'kath1234@mailinator.com', '2025-05-06 03:20:55', NULL, '2025-05-06 03:20:55', NULL, NULL),
(1065, 1105, 1, 1, 500, 500, 'kath1234@mailinator.com', '2025-05-06 04:00:23', NULL, '2025-05-06 04:00:23', NULL, NULL),
(1066, 1106, 1, 1, 2000, 2000, 'kath1234@mailinator.com', '2025-05-06 04:00:23', NULL, '2025-05-06 04:00:23', NULL, NULL),
(1067, 1107, 1, 1, 500, 500, 'kathrina123456@mailinator.com', '2025-05-06 05:00:20', NULL, '2025-05-06 05:00:20', NULL, NULL),
(1068, 1108, 1, 1, 2000, 2000, 'kathrina123456@mailinator.com', '2025-05-06 05:00:20', NULL, '2025-05-06 05:00:20', NULL, NULL),
(1069, 1109, 2, 1, 1000, 6000, 'kathrina123456@mailinator.com', '2025-05-06 05:03:00', NULL, '2025-05-06 05:03:00', NULL, NULL),
(1070, 1110, 1, 1, 500, 500, 'kath1234567@mailinator.com', '2025-05-06 05:15:00', NULL, '2025-05-06 05:15:00', NULL, NULL),
(1071, 1111, 1, 1, 2000, 2000, 'kath1234567@mailinator.com', '2025-05-06 05:15:00', NULL, '2025-05-06 05:15:00', NULL, NULL),
(1072, 1112, 1, 1, 500, 500, 'kath12345678@mailinator.com', '2025-05-06 08:59:17', NULL, '2025-05-06 08:59:17', NULL, NULL),
(1073, 1113, 1, 1, 2000, 2000, 'kath12345678@mailinator.com', '2025-05-06 08:59:17', NULL, '2025-05-06 08:59:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `cash_account_id` int DEFAULT NULL,
  `transaction_category_id` int DEFAULT NULL,
  `code` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `amount` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `cash_account_id`, `transaction_category_id`, `code`, `name`, `description`, `unit`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `amount`) VALUES
(1, 5, 1, 1, 'Membership fee', 'Payment for membership', 'Pax', 'Admin', '2025-01-21 05:32:53', 'Admin', '2025-01-21 05:32:53', NULL, NULL, 500),
(2, 4, 2, 2, 'Capital Contribution', 'Share capital', 'pcs', 'admin', '2025-01-21 05:32:49', NULL, '2025-01-21 05:32:49', NULL, NULL, 1000),
(3, 9, 3, 1120000, 'Loans', '', 'pax', NULL, '2025-01-23 03:31:12', NULL, '2025-01-23 03:31:12', NULL, NULL, NULL),
(4, 2, 5, 1, 'Initial Contribution', 'Purchased pens and paper', 'pcs', '1', '2025-05-06 00:42:30', '1', '2025-05-06 00:42:30', NULL, NULL, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `transaction_cash_account_id` int NOT NULL,
  `jev_number` varchar(255) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `debit` decimal(10,2) DEFAULT '0.00',
  `credit` decimal(10,2) DEFAULT '0.00',
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int NOT NULL,
  `member_id` int NOT NULL,
  `disbursment_account_id` int NOT NULL,
  `loan_reference_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `loan_amount` decimal(15,2) DEFAULT NULL,
  `principal_with_interest` decimal(15,2) NOT NULL,
  `remaining_balance` decimal(15,2) NOT NULL,
  `loan_type` varchar(255) DEFAULT NULL,
  `loan_status` enum('Pending','Approved','Rejected','Disbursed','Fully Paid','Pending Manager Approval') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Pending',
  `loan_term` int NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_repayment_schedules`
--

CREATE TABLE `loan_repayment_schedules` (
  `id` int NOT NULL,
  `loan_id` int NOT NULL,
  `amount_due` decimal(15,2) DEFAULT NULL,
  `remaining_balance` decimal(15,2) DEFAULT NULL,
  `date_paid` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `amount_paid` decimal(15,2) DEFAULT NULL,
  `status` enum('pending','paid','payment_initiated') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `reference_number` varchar(155) NOT NULL,
  `last_name` varchar(155) NOT NULL,
  `first_name` varchar(155) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `address` text,
  `mobile_number` varchar(100) DEFAULT NULL,
  `tel_number` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `spouse_name` varchar(100) DEFAULT NULL,
  `spouse_occupation` varchar(100) DEFAULT NULL,
  `spouse_mobile_number` varchar(100) DEFAULT NULL,
  `has_admin_offense` enum('Yes','No') NOT NULL DEFAULT 'No',
  `admin_offense` text,
  `is_convicted` enum('Yes','No') NOT NULL DEFAULT 'No',
  `is_PWD` enum('Yes','No') NOT NULL DEFAULT 'No',
  `pwd` text,
  `convicted` text,
  `status` varchar(100) NOT NULL DEFAULT 'Processing',
  `Remarks` varchar(100) NOT NULL DEFAULT '-',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `user_id`, `reference_number`, `last_name`, `first_name`, `middle_name`, `sex`, `civil_status`, `date_of_birth`, `place_of_birth`, `address`, `mobile_number`, `tel_number`, `email`, `spouse_name`, `spouse_occupation`, `spouse_mobile_number`, `has_admin_offense`, `admin_offense`, `is_convicted`, `is_PWD`, `pwd`, `convicted`, `status`, `Remarks`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(13, 5, 'M-2024-10-000000005', 'JOLIE', 'ANGELIE', '', 'Female', 'Single', '2001-05-10', 'NCR', 'SORRENTO OASIS', '948 030 0378', '', 'angela@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Completed', '-', '2024-10-22 05:15:27', 'angela@gmail.com', '2024-10-22 05:24:50', 'john.doe@example.com', NULL, NULL),
(14, 1, 'M-2024-10-000000001', 'AZORES', 'MELMAR', 'FORD', 'Male', 'Single', '1996-05-10', 'NCR', 'DON ROCES AVENUE', '948 030 0378', '', 'azoresmelmar@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2024-10-22 05:37:18', 'azoresmelmar@gmail.com', '2024-10-22 06:38:20', 'john.doe@example.com', NULL, NULL),
(23, 3, 'M-2024-11-000000003', 'DOE', 'JANE', 'FORD', 'Female', 'Single', '2000-11-15', 'NCR', 'BLK 49 LOT 43', '948 030 0378', '', 'jane@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Processing', '-', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(28, 44, 'M-2024-11-000000044', 'DATA', 'PERSON', 'SAMPLE', 'Female', 'Single', '2001-05-10', 'NCR', 'SAMPLE', '918 234 5000', '', 'person@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:12:18', 'john.doe@example.com', NULL, NULL),
(45, 76, 'M-2025-02-000000076', 'PADILLA', 'DANIEL', 'RONQUILLO', 'Male', 'Single', '2001-10-04', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'danielPadilla@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-02-11 03:16:14', 'danielPadilla@gmail.com', '2025-02-11 05:29:31', 'john.doe@example.com', NULL, NULL),
(46, 77, 'M-2025-02-000000077', 'VALDEZCO', 'KATHRINA', 'RONQUILLO', 'Female', 'Single', '2001-01-01', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'kathrinavaldezco553@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-02-11 07:31:20', 'kathrinavaldezco553@gmail.com', '2025-02-11 07:31:56', 'john.doe@example.com', NULL, NULL),
(49, 78, 'M-2025-02-000000078', 'DERULO', 'JAYSON', 'RONQUILLO', 'Female', 'Single', '2001-10-10', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'jd@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-02-13 08:45:20', 'jd@gmail.com', '2025-02-13 08:46:26', 'john.doe@example.com', NULL, NULL),
(50, 79, 'M-2025-02-000000079', 'OKSIHINA', 'DIONELA', '', 'Male', 'Single', '2001-10-10', 'NCR', 'LK 49 LOT 43 LASPALMAS SUBDV', '948 030 0378', '', 'Dayonela@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-02-14 01:28:32', 'Dayonela@gmail.com', '2025-02-14 01:30:10', 'john.doe@example.com', NULL, NULL),
(51, 80, 'M-2025-02-000000080', 'DUMLAO', 'RALPH', '', 'Male', 'Single', '2001-10-10', 'NCR', 'VISAYAS, REGION VI, CAPIZ, ROXAS CITY', '918 235 0004', '', 'rdumalo89@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-02-14 07:41:01', 'rdumalo89@gmail.com', '2025-02-14 07:42:51', 'john.doe@example.com', NULL, NULL),
(52, 84, 'M-2025-03-000000084', 'SALVADOR', 'MAJA', 'RONQUILLO', 'Female', 'Single', '2001-10-10', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'maja_salvador@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-03-03 08:56:03', 'maja_salvador@gmail.com', '2025-03-03 09:09:56', 'john.doe@example.com', NULL, NULL),
(53, 85, 'M-2025-03-000000085', 'CENA', 'JOHN', 'RONQUILLO', 'Male', 'Single', '2001-10-10', 'CAR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'john_cena@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-03-05 02:21:37', 'john_cena@gmail.com', '2025-03-05 02:22:23', 'john.doe@example.com', NULL, NULL),
(54, 86, 'M-2025-03-000000086', 'MONTEMAYOR', 'ERLINDA', '', 'Female', 'Single', '2001-10-10', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'erlinda@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-03-05 07:33:11', 'erlinda@gmail.com', '2025-03-05 08:53:21', 'john.doe@example.com', NULL, NULL),
(55, 87, 'M-2025-03-000000087', 'NGUYEN', 'DIANE', 'RONQUILLO', 'Female', 'Single', '2002-05-10', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'dinae@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-03-06 06:08:44', 'dinae@gmail.com', '2025-03-06 06:10:22', 'john.doe@example.com', NULL, NULL),
(56, 88, 'M-2025-03-000000088', 'HORSEMAN', 'BOJACK', '', 'Male', 'Single', '2001-10-10', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '918 235 0004', '', 'bj@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-03-11 06:31:08', 'bj@gmail.com', '2025-03-11 06:31:31', 'john.doe@example.com', NULL, NULL),
(57, 89, 'M-2025-03-000000089', 'HORSEMAN', 'BEATRICE', 'RONQUILLO', 'Female', 'Single', '2001-10-10', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '918 235 0004', '', 'bhorsman@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-03-13 00:44:19', 'bhorsman@gmail.com', '2025-03-13 00:45:37', 'john.doe@example.com', NULL, NULL),
(58, 91, 'M-2025-03-000000091', 'KEITING', 'ANNA', 'RONQUILLO', 'Female', 'Single', '2001-10-10', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'Ak@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-03-17 05:58:11', 'Ak@gmail.com', '2025-03-17 05:58:44', 'john.doe@example.com', NULL, NULL),
(59, 93, 'M-2025-03-000000093', 'DOE', 'HEV', 'ABI', 'Male', 'Single', '2001-01-01', 'CAR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'hev@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-03-20 07:53:39', 'hev@gmail.com', '2025-03-20 07:57:34', 'john.doe@example.com', NULL, NULL),
(66, 111, 'M-2025-04-000000111', 'CRISTOBAL', 'LIZA', '', 'Female', 'Single', '2001-10-10', 'NCR', 'GG', '918 235 0005', '', 'kathvaldezcoronquillo@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-04-15 00:16:37', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 00:27:29', 'cbd-coop@gmail.com', NULL, NULL),
(71, 114, 'M-2025-04-000000114', 'BALLESTEROS', 'PAMELA', '', 'Female', 'Single', '1997-01-18', 'NCR', '#49 DON A. ROCES AVE., BRGY. PALIGSAHAN, QUEZON CITY', '906 577 6463', '', 'pamelavivientballesteros@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-04-15 07:26:38', 'pamelavivientballesteros@gmail.com', '2025-04-15 07:36:39', 'cbd-coop@gmail.com', NULL, NULL),
(72, 115, 'M-2025-04-000000115', 'DELA CRUZ', 'JUANA', 'AGUIRRE', 'Male', 'Single', '2001-02-15', 'NCR', 'ERWRWEFWRGT5675665HTYH', '935 967 1913', '42352567', 'jeremy23deguzman@gmail.com', '35435TG54RTRHRTH', 'RTHRHRHTH', '948 030 0378', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 08:43:14', 'cbd-coop@gmail.com', NULL, NULL),
(74, 113, 'M-2025-04-000000113', 'VALDEZCO', 'KATHRINA', 'RONQUILLO', 'Female', 'Single', '2001-10-10', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '918 235 0004', '', 'kathvaldezcoronquillo@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', '', 'Incomplete payment requirements', '2025-04-21 02:19:56', 'kathvaldezcoronquillo@gmail.com', '2025-04-23 03:21:12', 'cbd-coop@gmail.com', NULL, NULL),
(129, 139, 'M-2025-05-000000139', 'VALDEZCO', 'KATHRINA', 'RONQUILLO', 'Female', 'Married', '2001-10-10', 'CAR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'kath-test@mailinator.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Processing', '-', '2025-05-06 00:37:49', 'kath-test@mailinator.com', '2025-05-06 00:37:49', NULL, NULL, NULL),
(146, 132, 'M-2025-05-000000132', 'TEST-1', 'TEST-1', 'SAMPLE', 'Female', 'Single', '2001-10-10', 'NCR', 'SAMPLE', '918 234 5000', '', 'kath1234@mailinator.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-05-06 04:00:23', 'kath1234@mailinator.com', '2025-05-06 04:03:26', 'cbd-coop@gmail.com', NULL, NULL),
(147, 142, 'M-2025-05-000000142', 'VALDEZCO', 'KATHRINA', '', 'Female', 'Single', '2001-10-10', 'NCR', 'SANTA MARIA', '961 074 3235', '', 'kathrina123456@mailinator.com', '', '', '', 'No', '', 'No', 'No', NULL, '', '', '-', '2025-05-06 05:00:20', 'kathrina123456@mailinator.com', '2025-05-06 06:59:29', 'cbd-coop@gmail.com', NULL, NULL),
(167, 145, 'M-2025-05-000000145', 'DATA', 'TEST', 'RONQUILLO', 'Female', 'Single', '2001-10-10', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'kath12345678@mailinator.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-05-06 08:59:17', 'kath12345678@mailinator.com', '2025-05-06 09:07:28', 'cbd-coop@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_balance`
--

CREATE TABLE `member_balance` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_contributions` decimal(15,2) DEFAULT '0.00',
  `total_deposits` decimal(15,2) DEFAULT '0.00',
  `total_withdrawals` decimal(15,2) DEFAULT '0.00',
  `available_credit` decimal(15,2) DEFAULT '0.00',
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member_balance`
--

INSERT INTO `member_balance` (`id`, `user_id`, `total_contributions`, `total_deposits`, `total_withdrawals`, `available_credit`, `last_updated`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(13, 88, '2000.00', '0.00', '0.00', '2850.00', '2025-03-12 01:14:20', 0, '2025-03-11 06:32:05', 0, '2025-03-12 01:14:20', NULL, NULL),
(14, 89, '4000.00', '0.00', '0.00', '3600.00', '2025-04-25 06:16:27', 0, '2025-03-13 00:48:18', 0, '2025-04-25 06:16:27', NULL, NULL),
(15, 91, '2000.00', '0.00', '0.00', '650.00', '2025-03-17 06:00:39', 0, '2025-03-17 05:57:16', 0, '2025-03-17 06:00:39', NULL, NULL),
(16, 93, '10000.00', '0.00', '0.00', '2300.00', '2025-03-24 05:46:39', 0, '2025-03-20 07:57:29', 0, '2025-03-24 05:46:38', NULL, NULL),
(17, 111, '3000.00', '0.00', '0.00', '700.00', '2025-04-15 00:33:38', 0, '2025-04-15 00:23:04', 0, '2025-04-15 00:33:38', NULL, NULL),
(18, 114, '1000.00', '0.00', '0.00', '900.00', '2025-04-15 07:29:27', 0, '2025-04-15 07:29:27', NULL, NULL, NULL, NULL),
(19, 115, '5000.00', '0.00', '0.00', '3500.00', '2025-04-15 08:50:50', 0, '2025-04-15 07:42:57', 0, '2025-04-15 08:50:50', NULL, NULL),
(20, 113, '3000.00', '0.00', '0.00', '1700.00', '2025-04-21 08:04:35', 0, '2025-04-21 02:30:51', 0, '2025-04-21 08:04:35', NULL, NULL),
(23, 125, '10000.00', '0.00', '0.00', '9000.00', '2025-04-25 06:06:45', 0, '2025-04-23 08:17:42', 0, '2025-04-25 06:06:45', NULL, NULL),
(24, 130, '7000.00', '0.00', '0.00', '6300.00', '2025-04-25 07:58:13', 0, '2025-04-25 06:43:29', 0, '2025-04-25 07:58:13', NULL, NULL),
(25, 132, '10000.00', '0.00', '0.00', '9000.00', '2025-05-06 04:01:44', 0, '2025-05-02 04:00:54', 0, '2025-05-06 04:01:44', NULL, NULL),
(26, 142, '8000.00', '0.00', '0.00', '7200.00', '2025-05-06 05:03:34', 0, '2025-05-06 05:01:13', NULL, '2025-05-06 05:03:34', NULL, NULL),
(27, 144, '2000.00', '0.00', '0.00', '1800.00', '2025-05-06 05:15:38', 0, '2025-05-06 05:15:38', NULL, NULL, NULL, NULL),
(28, 145, '2000.00', '0.00', '0.00', '1800.00', '2025-05-06 09:06:00', 0, '2025-05-06 09:06:00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_beneficiaries`
--

CREATE TABLE `member_beneficiaries` (
  `id` int NOT NULL,
  `member_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `relationship_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member_beneficiaries`
--

INSERT INTO `member_beneficiaries` (`id`, `member_id`, `name`, `date_of_birth`, `relationship_type`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(9, 49, 'Kathrina Ronquillo Valdezco', '2025-02-12', 'Sibling', '2025-02-13 08:45:20', 'jd@gmail.com', '2025-02-13 08:45:20', NULL, NULL, NULL),
(10, 57, 'Henrietta Horseman', '2001-05-10', 'Mother', '2025-03-13 00:44:19', 'bhorsman@gmail.com', '2025-03-13 00:44:19', NULL, NULL, NULL),
(11, 59, 'Ralph Dumlao', '2001-10-10', 'Sibling', '2025-03-20 07:53:39', 'hev@gmail.com', '2025-03-20 07:53:40', NULL, NULL, NULL),
(12, 72, 'Melmar Azores', '1999-01-05', 'Mother', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:49', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_educ_backgrounds`
--

CREATE TABLE `member_educ_backgrounds` (
  `id` int NOT NULL,
  `member_id` int NOT NULL,
  `level` enum('Elementary','Secondary','Vocational','Tertiary','Graduate Studies') NOT NULL,
  `education_course` varchar(255) NOT NULL,
  `school_institution` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member_educ_backgrounds`
--

INSERT INTO `member_educ_backgrounds` (`id`, `member_id`, `level`, `education_course`, `school_institution`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(14, 72, 'Elementary', 'ew4t34t', '4wtwtw4', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:49', NULL, NULL, NULL),
(15, 72, 'Secondary', '4wtw4t', 'tw4twt', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:49', NULL, NULL, NULL),
(16, 72, 'Vocational', 'w4tw4tw', 't4wtw', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:49', NULL, NULL, NULL),
(17, 72, 'Tertiary', 't4twt', '4wtwt4', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:49', NULL, NULL, NULL),
(18, 72, '', '4twtwt4', '4wtwt44', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:49', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_work_backgrounds`
--

CREATE TABLE `member_work_backgrounds` (
  `id` int NOT NULL,
  `member_id` int NOT NULL,
  `employment_status` enum('Previous','Current') NOT NULL DEFAULT 'Current',
  `occupation` varchar(255) NOT NULL,
  `office` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `income` varchar(255) DEFAULT NULL,
  `tin_id` int NOT NULL,
  `tel_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member_work_backgrounds`
--

INSERT INTO `member_work_backgrounds` (`id`, `member_id`, `employment_status`, `occupation`, `office`, `address`, `income`, `tin_id`, `tel_no`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(13, 13, 'Current', 'Engineer II', 'Cybercrime Investigation and coordinating center', 'Don roces Main office', '40,000', 0, '189201920', '2024-10-22 05:15:27', 'angela@gmail.com', '2024-10-22 05:15:27', NULL, NULL, NULL),
(14, 14, 'Current', 'Engineer IV', 'Cybercrime Coordinating Center', 'Don roces Avenue', '50,000', 0, '712898129', '2024-10-22 05:37:18', 'azoresmelmar@gmail.com', '2024-10-22 05:37:19', NULL, NULL, NULL),
(24, 23, 'Current', 'AOII', 'CICC', 'Blk 49 lot 43', '12000', 0, '1212323', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(29, 28, 'Current', 'AOII', 'CICC', '#49 Don A. Roces Paligsahan, Quezon City', '32000', 0, '09359671913', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
(46, 45, 'Current', 'Engineer I', 'CICC / CIO-ID', 'Visayas, Region VI, Capiz, Roxas City', '35000', 0, '09480300378', '2025-02-11 03:16:14', 'danielPadilla@gmail.com', '2025-02-11 03:16:14', NULL, NULL, NULL),
(47, 46, 'Current', 'Engineer I', 'CICC / CIO-ID', 'Visayas, Region VI, Capiz, Roxas City', '35000', 0, '09480300378', '2025-02-11 07:31:20', 'kathrinavaldezco553@gmail.com', '2025-02-11 07:31:20', NULL, NULL, NULL),
(50, 49, 'Current', 'Engineer I', 'CICC / CIO-ID', 'Visayas, Region VI, Capiz, Roxas City', '35000', 0, '09480300378', '2025-02-13 08:45:20', 'jd@gmail.com', '2025-02-13 08:45:20', NULL, NULL, NULL),
(51, 50, 'Current', 'Music Song Artist', 'ABSCBM', 'Mo. Ignacia Street Quezon City', '100000', 0, '789456', '2025-02-14 01:28:32', 'Dayonela@gmail.com', '2025-02-14 01:28:33', NULL, NULL, NULL),
(52, 51, 'Current', 'Engineer 1', 'CICC / CIO-ID', 'Visayas, Region VI, Capiz, Roxas City', '35000', 0, '09480300378', '2025-02-14 07:41:01', 'rdumalo89@gmail.com', '2025-02-14 07:41:01', NULL, NULL, NULL),
(53, 52, 'Current', 'affiliation sample', 'CICC / CIO-ID', 'Visayas, Region VI, Capiz, Roxas City', '30000', 0, '09480300378', '2025-03-03 08:56:03', 'maja_salvador@gmail.com', '2025-03-03 08:56:03', NULL, NULL, NULL),
(54, 53, 'Current', 'ENGINEER V', 'CICC', '#49 Don A. Roces Paligsahan, Quezon City', '50000', 0, '09359671913', '2025-03-05 02:21:37', 'john_cena@gmail.com', '2025-03-05 02:21:37', NULL, NULL, NULL),
(55, 54, 'Current', 'ENGINEER V', 'CICC', '#49 Don A. Roces Paligsahan, Quezon City', '50000', 0, '09359671913', '2025-03-05 07:33:11', 'erlinda@gmail.com', '2025-03-05 07:33:11', NULL, NULL, NULL),
(56, 55, 'Current', 'ENGINEER V', 'CICC', '#49 Don A. Roces Paligsahan, Quezon City', '20000', 0, '09359671913', '2025-03-06 06:08:44', 'dinae@gmail.com', '2025-03-06 06:08:44', NULL, NULL, NULL),
(57, 56, 'Current', 'ENGINEER I', 'CICC', '#49 Don A. Roces Paligsahan, Quezon City', '45000', 0, '09359671913', '2025-03-11 06:31:08', 'bj@gmail.com', '2025-03-11 06:31:09', NULL, NULL, NULL),
(58, 57, 'Current', 'Engineer I', 'CICC / CIO-ID', 'Visayas, Region VI, Capiz, Roxas City', '30000', 0, '09480300378', '2025-03-13 00:44:19', 'bhorsman@gmail.com', '2025-03-13 00:44:19', NULL, NULL, NULL),
(59, 58, 'Current', 'Engineer I', 'CICC / CIO-ID', 'Visayas, Region VI, Capiz, Roxas City', '30000', 0, '09480300378', '2025-03-17 05:58:11', 'Ak@gmail.com', '2025-03-17 05:58:11', NULL, NULL, NULL),
(60, 59, 'Current', 'Engineer II', 'CICC', 'Don Roces Pasig City', '30000', 0, '7152359', '2025-03-20 07:53:39', 'hev@gmail.com', '2025-03-20 07:53:40', NULL, NULL, NULL),
(67, 66, 'Current', 'engineer i', 'cicii', 'Don roces', '30000', 0, '715229', '2025-04-15 00:16:37', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 00:16:38', NULL, NULL, NULL),
(72, 71, 'Current', 'ADMIN', 'CYBERCRIME INVESTIGATION AND COORDINATING CENTER', '#49 Don A. Roces Ave., Brgy. Paligsahan, Quezon City', '10000', 0, '9065776463', '2025-04-15 07:26:38', 'pamelavivientballesteros@gmail.com', '2025-04-15 07:26:38', NULL, NULL, NULL),
(73, 72, 'Current', '4twtwt', 'CICC', '#49 Don A. Roces Ave. paligsahan Quezon City', '3763345', 0, '09359671913', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:49', NULL, NULL, NULL),
(74, 72, 'Previous', '34t634tt34t3t', 'CICC', '#49 Don A. Roces Ave. paligsahan Quezon City', '4t34t3636', 0, '09359671913', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:49', NULL, NULL, NULL),
(76, 74, 'Current', 'ENGINEER I', 'CICC / CIO-ID', 'Visayas, Region VI, Capiz, Roxas City', '30000', 0, '09480300378', '2025-04-21 02:19:56', 'kathvaldezcoronquillo@gmail.com', '2025-04-21 02:19:56', NULL, NULL, NULL),
(131, 129, 'Current', 'uyuuyu', 'CICC / CIO-ID', 'Visayas, Region VI, Capiz, Roxas City', '50000', 0, '9480300378', '2025-05-06 00:37:49', 'kath-test@mailinator.com', '2025-05-06 00:37:49', NULL, NULL, NULL),
(148, 146, 'Current', 'uyuuyu', 'CICC / CIO-ID', 'Visayas, Region VI, Capiz, Roxas City', '50000', 0, '9480300378', '2025-05-06 04:00:23', 'kath1234@mailinator.com', '2025-05-06 04:00:23', NULL, NULL, NULL),
(149, 147, 'Current', 'ENGINEER I', 'CICC', 'DON ROCES', '32000', 0, '715229', '2025-05-06 05:00:20', 'kathrina123456@mailinator.com', '2025-05-06 05:00:20', NULL, NULL, NULL),
(158, 167, 'Current', 'ENGINEER I', 'CICC', 'DONROCES', '32000', 0, '7145652', '2025-05-06 08:59:17', 'kath12345678@mailinator.com', '2025-05-06 08:59:17', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `official_receipts`
--

CREATE TABLE `official_receipts` (
  `id` int NOT NULL,
  `official_receipt_number` varchar(255) NOT NULL,
  `billing_address_id` int NOT NULL,
  `user_id` int NOT NULL,
  `transaction_category_id` int NOT NULL,
  `payment_date` date NOT NULL,
  `processed_by` varchar(255) NOT NULL,
  `issued_by` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `official_receipts`
--

INSERT INTO `official_receipts` (`id`, `official_receipt_number`, `billing_address_id`, `user_id`, `transaction_category_id`, `payment_date`, `processed_by`, `issued_by`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(830, 'OR-202502111348462334', 30, 76, 1, '2025-02-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-11 05:48:46', NULL, '2025-02-11 05:48:46', NULL, NULL),
(831, 'OR-202502111356204932', 30, 76, 2, '2025-02-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-11 05:56:20', NULL, '2025-02-11 05:56:20', NULL, NULL),
(832, 'OR-202502111529135219', 32, 77, 1, '2025-02-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-11 07:29:13', NULL, '2025-02-11 07:29:13', NULL, NULL),
(833, 'OR-202502111529207423', 32, 77, 2, '2025-02-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-11 07:29:20', NULL, '2025-02-11 07:29:20', NULL, NULL),
(834, 'OR-202502131647073692', 33, 78, 1, '2025-02-13', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-13 08:47:07', NULL, '2025-02-13 08:47:07', NULL, NULL),
(835, 'OR-202502131647135949', 33, 78, 2, '2025-02-13', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-13 08:47:13', NULL, '2025-02-13 08:47:13', NULL, NULL),
(836, 'OR-202502131653094171', 33, 78, 2, '2025-02-13', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-13 08:53:09', NULL, '2025-02-13 08:53:09', NULL, NULL),
(837, 'OR-202502131708593912', 33, 78, 3, '2025-02-13', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-13 09:08:59', NULL, '2025-02-13 09:08:59', NULL, NULL),
(838, 'OR-202502140929522387', 34, 79, 1, '2025-02-14', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-14 01:29:52', NULL, '2025-02-14 01:29:52', NULL, NULL),
(839, 'OR-202502140930006210', 34, 79, 2, '2025-02-14', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-14 01:30:00', NULL, '2025-02-14 01:30:00', NULL, NULL),
(840, 'OR-202502141513443068', 32, 77, 2, '2025-02-14', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-14 07:13:44', NULL, '2025-02-14 07:13:44', NULL, NULL),
(841, 'OR-202502141541447890', 36, 80, 1, '2025-02-14', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-14 07:41:44', NULL, '2025-02-14 07:41:44', NULL, NULL),
(842, 'OR-202502141542078046', 36, 80, 2, '2025-02-14', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-14 07:42:07', NULL, '2025-02-14 07:42:07', NULL, NULL),
(843, 'OR-202502141549049279', 36, 80, 3, '2025-02-14', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-14 07:49:04', NULL, '2025-02-14 07:49:04', NULL, NULL),
(844, 'OR-202502241513444101', 34, 79, 3, '2025-02-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-02-24 07:13:44', NULL, '2025-02-24 07:13:44', NULL, NULL),
(845, 'OR-202503031708113144', 39, 84, 1, '2025-03-03', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-03 09:08:11', NULL, '2025-03-03 09:08:11', NULL, NULL),
(846, 'OR-202503031708433971', 39, 84, 2, '2025-03-03', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-03 09:08:43', NULL, '2025-03-03 09:08:43', NULL, NULL),
(847, 'OR-202503040926195881', 37, 81, 1, '2025-03-04', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-04 01:26:19', NULL, '2025-03-04 01:26:19', NULL, NULL),
(850, 'OR-202503051024062822', 40, 85, 1, '2025-03-05', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-05 02:24:05', NULL, '2025-03-05 02:24:06', NULL, NULL),
(851, 'OR-202503051024164089', 40, 85, 2, '2025-03-05', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-05 02:24:15', NULL, '2025-03-05 02:24:16', NULL, NULL),
(852, 'OR-202503051652132776', 43, 86, 1, '2025-03-05', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-05 08:52:13', NULL, '2025-03-05 08:52:13', NULL, NULL),
(853, 'OR-202503051652226758', 43, 86, 2, '2025-03-05', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-05 08:52:21', NULL, '2025-03-05 08:52:22', NULL, NULL),
(854, 'OR-202503051710115601', 43, 86, 3, '2025-03-05', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-05 09:10:11', NULL, '2025-03-05 09:10:11', NULL, NULL),
(855, 'OR-202503061059422256', 39, 84, 3, '2025-03-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-06 02:59:42', NULL, '2025-03-06 02:59:42', NULL, NULL),
(856, 'OR-202503061059556189', 39, 84, 2, '2025-03-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-06 02:59:55', NULL, '2025-03-06 02:59:55', NULL, NULL),
(857, 'OR-202503061123466812', 39, 84, 3, '2025-03-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-06 03:23:46', NULL, '2025-03-06 03:23:46', NULL, NULL),
(858, 'OR-202503061306079362', 43, 86, 3, '2025-03-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-06 05:06:07', NULL, '2025-03-06 05:06:07', NULL, NULL),
(859, 'OR-202503061409289562', 44, 87, 1, '2025-03-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-06 06:09:28', NULL, '2025-03-06 06:09:28', NULL, NULL),
(860, 'OR-202503061409353347', 44, 87, 2, '2025-03-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-06 06:09:35', NULL, '2025-03-06 06:09:35', NULL, NULL),
(861, 'OR-202503061523143977', 44, 87, 3, '2025-03-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-06 07:23:14', NULL, '2025-03-06 07:23:14', NULL, NULL),
(862, 'OR-202503070935261002', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 01:35:26', NULL, '2025-03-07 01:35:26', NULL, NULL),
(863, 'OR-202503070959484006', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 01:59:48', NULL, '2025-03-07 01:59:48', NULL, NULL),
(864, 'OR-202503071000049235', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 02:00:04', NULL, '2025-03-07 02:00:04', NULL, NULL),
(865, 'OR-202503071005263130', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 02:05:26', NULL, '2025-03-07 02:05:26', NULL, NULL),
(866, 'OR-202503071028083017', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 02:28:08', NULL, '2025-03-07 02:28:08', NULL, NULL),
(867, 'OR-202503071028204709', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 02:28:20', NULL, '2025-03-07 02:28:20', NULL, NULL),
(868, 'OR-202503071028515860', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 02:28:51', NULL, '2025-03-07 02:28:51', NULL, NULL),
(869, 'OR-202503071329034717', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 05:29:02', NULL, '2025-03-07 05:29:03', NULL, NULL),
(870, 'OR-202503071329133191', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 05:29:13', NULL, '2025-03-07 05:29:13', NULL, NULL),
(871, 'OR-202503071329271575', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 05:29:27', NULL, '2025-03-07 05:29:27', NULL, NULL),
(872, 'OR-202503071352015622', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 05:52:01', NULL, '2025-03-07 05:52:01', NULL, NULL),
(873, 'OR-202503071405279383', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 06:05:27', NULL, '2025-03-07 06:05:27', NULL, NULL),
(874, 'OR-202503071415545217', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 06:15:54', NULL, '2025-03-07 06:15:54', NULL, NULL),
(875, 'OR-202503071417397379', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 06:17:39', NULL, '2025-03-07 06:17:39', NULL, NULL),
(876, 'OR-202503071417482313', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 06:17:48', NULL, '2025-03-07 06:17:48', NULL, NULL),
(877, 'OR-202503071417574324', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 06:17:56', NULL, '2025-03-07 06:17:57', NULL, NULL),
(878, 'OR-202503071422029289', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 06:22:02', NULL, '2025-03-07 06:22:02', NULL, NULL),
(879, 'OR-202503071422186798', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 06:22:18', NULL, '2025-03-07 06:22:18', NULL, NULL),
(880, 'OR-202503071422374898', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 06:22:36', NULL, '2025-03-07 06:22:37', NULL, NULL),
(881, 'OR-202503071555492183', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 07:55:49', NULL, '2025-03-07 07:55:49', NULL, NULL),
(882, 'OR-202503071556003589', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 07:56:00', NULL, '2025-03-07 07:56:00', NULL, NULL),
(883, 'OR-202503071556158958', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 07:56:14', NULL, '2025-03-07 07:56:15', NULL, NULL),
(884, 'OR-202503071734509822', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 09:34:50', NULL, '2025-03-07 09:34:50', NULL, NULL),
(885, 'OR-202503071735039379', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 09:35:03', NULL, '2025-03-07 09:35:03', NULL, NULL),
(886, 'OR-202503071735159044', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 09:35:15', NULL, '2025-03-07 09:35:15', NULL, NULL),
(887, 'OR-202503071741415194', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 09:41:41', NULL, '2025-03-07 09:41:41', NULL, NULL),
(888, 'OR-202503071741549431', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 09:41:54', NULL, '2025-03-07 09:41:54', NULL, NULL),
(889, 'OR-202503071742076337', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 09:42:07', NULL, '2025-03-07 09:42:07', NULL, NULL),
(890, 'OR-202503071750065862', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 09:50:06', NULL, '2025-03-07 09:50:06', NULL, NULL),
(891, 'OR-202503071750153778', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 09:50:15', NULL, '2025-03-07 09:50:15', NULL, NULL),
(892, 'OR-202503071750219162', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 09:50:21', NULL, '2025-03-07 09:50:21', NULL, NULL),
(893, 'OR-202503071757372186', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 09:57:37', NULL, '2025-03-07 09:57:37', NULL, NULL),
(894, 'OR-202503071757492496', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 09:57:48', NULL, '2025-03-07 09:57:49', NULL, NULL),
(895, 'OR-202503071757581826', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 09:57:58', NULL, '2025-03-07 09:57:58', NULL, NULL),
(896, 'OR-202503071800452848', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 10:00:45', NULL, '2025-03-07 10:00:45', NULL, NULL),
(897, 'OR-202503071800563478', 44, 87, 3, '2025-03-07', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-07 10:00:56', NULL, '2025-03-07 10:00:56', NULL, NULL),
(898, 'OR-202503100956315594', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 01:56:31', NULL, '2025-03-10 01:56:31', NULL, NULL),
(899, 'OR-202503100956497078', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 01:56:49', NULL, '2025-03-10 01:56:49', NULL, NULL),
(900, 'OR-202503100957091117', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 01:57:09', NULL, '2025-03-10 01:57:09', NULL, NULL),
(901, 'OR-202503101003395928', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 02:03:39', NULL, '2025-03-10 02:03:39', NULL, NULL),
(902, 'OR-202503101004511164', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 02:04:51', NULL, '2025-03-10 02:04:51', NULL, NULL),
(903, 'OR-202503101026145987', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 02:26:14', NULL, '2025-03-10 02:26:14', NULL, NULL),
(904, 'OR-202503101322567775', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 05:22:56', NULL, '2025-03-10 05:22:56', NULL, NULL),
(905, 'OR-202503101323072375', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 05:23:07', NULL, '2025-03-10 05:23:07', NULL, NULL),
(906, 'OR-202503101452531333', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 06:52:53', NULL, '2025-03-10 06:52:53', NULL, NULL),
(907, 'OR-202503101508225296', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 07:08:22', NULL, '2025-03-10 07:08:22', NULL, NULL),
(908, 'OR-202503101508324425', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 07:08:32', NULL, '2025-03-10 07:08:32', NULL, NULL),
(909, 'OR-202503101508437406', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 07:08:43', NULL, '2025-03-10 07:08:43', NULL, NULL),
(910, 'OR-202503101559013837', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 07:59:01', NULL, '2025-03-10 07:59:01', NULL, NULL),
(911, 'OR-202503101559315204', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 07:59:31', NULL, '2025-03-10 07:59:31', NULL, NULL),
(912, 'OR-202503101559493285', 44, 87, 3, '2025-03-10', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-10 07:59:49', NULL, '2025-03-10 07:59:49', NULL, NULL),
(913, 'OR-202503111345447167', 44, 87, 3, '2025-03-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 05:45:44', NULL, '2025-03-11 05:45:44', NULL, NULL),
(914, 'OR-202503111404036780', 44, 87, 3, '2025-03-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 06:04:03', NULL, '2025-03-11 06:04:03', NULL, NULL),
(915, 'OR-202503111404208657', 44, 87, 3, '2025-03-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 06:04:20', NULL, '2025-03-11 06:04:20', NULL, NULL),
(916, 'OR-202503111414547061', 44, 87, 3, '2025-03-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 06:14:54', NULL, '2025-03-11 06:14:54', NULL, NULL),
(917, 'OR-202503111417581207', 44, 87, 3, '2025-03-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 06:17:58', NULL, '2025-03-11 06:17:58', NULL, NULL),
(918, 'OR-202503111418132252', 44, 87, 3, '2025-03-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 06:18:13', NULL, '2025-03-11 06:18:13', NULL, NULL),
(919, 'OR-202503111419108172', 44, 87, 3, '2025-03-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 06:19:10', NULL, '2025-03-11 06:19:10', NULL, NULL),
(920, 'OR-202503111431563364', 45, 88, 1, '2025-03-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 06:31:56', NULL, '2025-03-11 06:31:56', NULL, NULL),
(921, 'OR-202503111432051797', 45, 88, 2, '2025-03-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 06:32:05', NULL, '2025-03-11 06:32:05', NULL, NULL),
(922, 'OR-202503111516101147', 45, 88, 3, '2025-03-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 07:16:10', NULL, '2025-03-11 07:16:10', NULL, NULL),
(923, 'OR-202503111516216974', 45, 88, 3, '2025-03-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 07:16:21', NULL, '2025-03-11 07:16:21', NULL, NULL),
(924, 'OR-202503111516371832', 45, 88, 3, '2025-03-11', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 07:16:37', NULL, '2025-03-11 07:16:37', NULL, NULL),
(925, 'OR-202503120726534755', 45, 88, 3, '2025-03-12', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 23:26:52', NULL, '2025-03-11 23:26:53', NULL, NULL),
(926, 'OR-202503120727093542', 45, 88, 3, '2025-03-12', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 23:27:09', NULL, '2025-03-11 23:27:09', NULL, NULL),
(927, 'OR-202503120727226898', 45, 88, 3, '2025-03-12', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-11 23:27:22', NULL, '2025-03-11 23:27:22', NULL, NULL),
(928, 'OR-202503120903584246', 45, 88, 3, '2025-03-12', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-12 01:03:58', NULL, '2025-03-12 01:03:58', NULL, NULL),
(929, 'OR-202503120904185907', 45, 88, 3, '2025-03-12', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-12 01:04:18', NULL, '2025-03-12 01:04:18', NULL, NULL),
(930, 'OR-202503120911599173', 45, 88, 3, '2025-03-12', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-12 01:11:59', NULL, '2025-03-12 01:11:59', NULL, NULL),
(931, 'OR-202503120913121263', 45, 88, 3, '2025-03-12', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-12 01:13:12', NULL, '2025-03-12 01:13:12', NULL, NULL),
(932, 'OR-202503120914208058', 45, 88, 3, '2025-03-12', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-12 01:14:20', NULL, '2025-03-12 01:14:20', NULL, NULL),
(933, 'OR-202503130848094089', 47, 89, 1, '2025-03-13', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-13 00:48:09', NULL, '2025-03-13 00:48:09', NULL, NULL),
(934, 'OR-202503130848188302', 47, 89, 2, '2025-03-13', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-13 00:48:18', NULL, '2025-03-13 00:48:18', NULL, NULL),
(935, 'OR-202503171332201406', 47, 89, 3, '2025-03-17', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-17 05:32:20', NULL, '2025-03-17 05:32:20', NULL, NULL),
(936, 'OR-202503171356522251', 50, 91, 1, '2025-03-17', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-17 05:56:52', NULL, '2025-03-17 05:56:52', NULL, NULL),
(937, 'OR-202503171357167881', 50, 91, 2, '2025-03-17', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-17 05:57:16', NULL, '2025-03-17 05:57:16', NULL, NULL),
(938, 'OR-202503171402329881', 50, 91, 3, '2025-03-17', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-17 06:02:32', NULL, '2025-03-17 06:02:32', NULL, NULL),
(939, 'OR-202503171405001419', 50, 91, 3, '2025-03-17', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-17 06:05:00', NULL, '2025-03-17 06:05:00', NULL, NULL),
(940, 'OR-202503201557133093', 56, 93, 1, '2025-03-20', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-20 07:57:13', NULL, '2025-03-20 07:57:13', NULL, NULL),
(941, 'OR-202503201557297675', 56, 93, 2, '2025-03-20', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-20 07:57:29', NULL, '2025-03-20 07:57:29', NULL, NULL),
(942, 'OR-202503201559508918', 56, 93, 2, '2025-03-20', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-20 07:59:50', NULL, '2025-03-20 07:59:50', NULL, NULL),
(943, 'OR-202503201611291731', 56, 93, 3, '2025-03-20', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-20 08:11:29', NULL, '2025-03-20 08:11:29', NULL, NULL),
(944, 'OR-202503201611427658', 56, 93, 3, '2025-03-20', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-20 08:11:42', NULL, '2025-03-20 08:11:42', NULL, NULL),
(945, 'OR-202503201611525482', 56, 93, 3, '2025-03-20', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-20 08:11:52', NULL, '2025-03-20 08:11:52', NULL, NULL),
(946, 'OR-202503201612001540', 56, 93, 3, '2025-03-20', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-20 08:12:00', NULL, '2025-03-20 08:12:00', NULL, NULL),
(947, 'OR-202503201612093838', 56, 93, 3, '2025-03-20', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-20 08:12:09', NULL, '2025-03-20 08:12:09', NULL, NULL),
(948, 'OR-202503201612185677', 56, 93, 3, '2025-03-20', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-20 08:12:18', NULL, '2025-03-20 08:12:18', NULL, NULL),
(949, 'OR-202503201614011228', 56, 93, 2, '2025-03-20', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-20 08:14:00', NULL, '2025-03-20 08:14:01', NULL, NULL),
(950, 'OR-202503211554388829', 56, 93, 3, '2025-03-21', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-21 07:54:38', NULL, '2025-03-21 07:54:38', NULL, NULL),
(951, 'OR-202503211555488261', 56, 93, 3, '2025-03-21', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-21 07:55:48', NULL, '2025-03-21 07:55:48', NULL, NULL),
(952, 'OR-202503211556558477', 56, 93, 3, '2025-03-21', 'Sample Cashier', '', 'sample@gmail.com', '2025-03-21 07:56:55', NULL, '2025-03-21 07:56:55', NULL, NULL),
(953, 'OR-202504150820398142', 58, 111, 1, '2025-04-15', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-15 00:20:39', NULL, '2025-04-15 00:20:39', NULL, NULL),
(954, 'OR-202504150823049041', 58, 111, 2, '2025-04-15', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-15 00:23:04', NULL, '2025-04-15 00:23:04', NULL, NULL),
(955, 'OR-202504151528399312', 61, 114, 1, '2025-04-15', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-15 07:28:39', NULL, '2025-04-15 07:28:39', NULL, NULL),
(956, 'OR-202504151529276953', 61, 114, 2, '2025-04-15', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-15 07:29:27', NULL, '2025-04-15 07:29:27', NULL, NULL),
(957, 'OR-202504151542468561', 62, 115, 1, '2025-04-15', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-15 07:42:46', NULL, '2025-04-15 07:42:46', NULL, NULL),
(958, 'OR-202504151542577296', 62, 115, 2, '2025-04-15', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-15 07:42:57', NULL, '2025-04-15 07:42:57', NULL, NULL),
(959, 'OR-202504211030513199', 60, 113, 2, '2025-04-21', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-21 02:30:51', NULL, '2025-04-21 02:30:51', NULL, NULL),
(960, 'OR-202504231608436000', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:08:43', NULL, '2025-04-23 08:08:43', NULL, NULL),
(961, 'OR-202504231608439562', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:08:43', NULL, '2025-04-23 08:08:43', NULL, NULL),
(962, 'OR-202504231608509854', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:08:50', NULL, '2025-04-23 08:08:50', NULL, NULL),
(963, 'OR-202504231608502411', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:08:50', NULL, '2025-04-23 08:08:50', NULL, NULL),
(964, 'OR-202504231612279899', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:12:27', NULL, '2025-04-23 08:12:27', NULL, NULL),
(965, 'OR-202504231612275556', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:12:27', NULL, '2025-04-23 08:12:27', NULL, NULL),
(966, 'OR-202504231612441222', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:12:44', NULL, '2025-04-23 08:12:44', NULL, NULL),
(967, 'OR-202504231612443268', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:12:44', NULL, '2025-04-23 08:12:44', NULL, NULL),
(968, 'OR-202504231613002906', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:13:00', NULL, '2025-04-23 08:13:00', NULL, NULL),
(969, 'OR-202504231613002763', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:13:00', NULL, '2025-04-23 08:13:00', NULL, NULL),
(974, 'OR-202504231616278337', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:16:26', NULL, '2025-04-23 08:16:27', NULL, NULL),
(975, 'OR-202504231616274733', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:16:26', NULL, '2025-04-23 08:16:27', NULL, NULL),
(976, 'OR-202504231616384004', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:16:38', NULL, '2025-04-23 08:16:38', NULL, NULL),
(977, 'OR-202504231616385365', 65, 125, 1, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:16:38', NULL, '2025-04-23 08:16:38', NULL, NULL),
(980, 'OR-202504231617425595', 65, 125, 2, '2025-04-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-23 08:17:42', NULL, '2025-04-23 08:17:42', NULL, NULL),
(981, 'OR-202504240856359733', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 00:56:35', NULL, '2025-04-24 00:56:35', NULL, NULL),
(982, 'OR-202504240905071365', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 01:05:07', NULL, '2025-04-24 01:05:07', NULL, NULL),
(983, 'OR-202504240905512820', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 01:05:51', NULL, '2025-04-24 01:05:51', NULL, NULL),
(984, 'OR-202504240915225343', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 01:15:22', NULL, '2025-04-24 01:15:22', NULL, NULL),
(985, 'OR-202504240915367073', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 01:15:36', NULL, '2025-04-24 01:15:36', NULL, NULL),
(986, 'OR-202504240916244223', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 01:16:24', NULL, '2025-04-24 01:16:24', NULL, NULL),
(987, 'OR-202504240924586969', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 01:24:58', NULL, '2025-04-24 01:24:58', NULL, NULL),
(988, 'OR-202504240925116224', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 01:25:10', NULL, '2025-04-24 01:25:11', NULL, NULL),
(989, 'OR-202504240925219869', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 01:25:21', NULL, '2025-04-24 01:25:21', NULL, NULL),
(990, 'OR-202504240943418900', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 01:43:41', NULL, '2025-04-24 01:43:41', NULL, NULL),
(991, 'OR-202504240943559722', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 01:43:55', NULL, '2025-04-24 01:43:55', NULL, NULL),
(992, 'OR-202504240944149296', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 01:44:14', NULL, '2025-04-24 01:44:14', NULL, NULL),
(993, 'OR-202504241014262999', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 02:14:25', NULL, '2025-04-24 02:14:26', NULL, NULL),
(994, 'OR-202504241014407351', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 02:14:40', NULL, '2025-04-24 02:14:40', NULL, NULL),
(995, 'OR-202504241014544961', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 02:14:54', NULL, '2025-04-24 02:14:54', NULL, NULL),
(996, 'OR-202504241031053207', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 02:31:05', NULL, '2025-04-24 02:31:05', NULL, NULL),
(997, 'OR-202504241032274858', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 02:32:27', NULL, '2025-04-24 02:32:27', NULL, NULL),
(998, 'OR-202504241033125823', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 02:33:12', NULL, '2025-04-24 02:33:12', NULL, NULL),
(999, 'OR-202504241104349054', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 03:04:34', NULL, '2025-04-24 03:04:34', NULL, NULL),
(1000, 'OR-202504241105092304', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 03:05:09', NULL, '2025-04-24 03:05:09', NULL, NULL),
(1001, 'OR-202504241105491027', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 03:05:48', NULL, '2025-04-24 03:05:49', NULL, NULL),
(1002, 'OR-202504241310595681', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:10:59', NULL, '2025-04-24 05:10:59', NULL, NULL),
(1003, 'OR-202504241311131646', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:11:13', NULL, '2025-04-24 05:11:13', NULL, NULL),
(1004, 'OR-202504241314465122', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:14:46', NULL, '2025-04-24 05:14:46', NULL, NULL),
(1005, 'OR-202504241323092863', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:23:09', NULL, '2025-04-24 05:23:09', NULL, NULL),
(1006, 'OR-202504241323422580', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:23:42', NULL, '2025-04-24 05:23:42', NULL, NULL),
(1007, 'OR-202504241324239733', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:24:22', NULL, '2025-04-24 05:24:23', NULL, NULL),
(1008, 'OR-202504241337556354', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:37:55', NULL, '2025-04-24 05:37:55', NULL, NULL),
(1009, 'OR-202504241338045110', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:38:04', NULL, '2025-04-24 05:38:04', NULL, NULL),
(1010, 'OR-202504241338532614', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:38:53', NULL, '2025-04-24 05:38:53', NULL, NULL),
(1011, 'OR-202504241343176212', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:43:17', NULL, '2025-04-24 05:43:17', NULL, NULL),
(1012, 'OR-202504241345535748', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:45:53', NULL, '2025-04-24 05:45:53', NULL, NULL),
(1013, 'OR-202504241346052644', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:46:05', NULL, '2025-04-24 05:46:05', NULL, NULL),
(1014, 'OR-202504241354151337', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:54:15', NULL, '2025-04-24 05:54:15', NULL, NULL),
(1015, 'OR-202504241354262340', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:54:26', NULL, '2025-04-24 05:54:26', NULL, NULL),
(1016, 'OR-202504241355115469', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 05:55:11', NULL, '2025-04-24 05:55:11', NULL, NULL),
(1017, 'OR-202504241412277733', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 06:12:27', NULL, '2025-04-24 06:12:27', NULL, NULL),
(1018, 'OR-202504241412376656', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 06:12:37', NULL, '2025-04-24 06:12:37', NULL, NULL),
(1019, 'OR-202504241424108202', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 06:24:10', NULL, '2025-04-24 06:24:10', NULL, NULL),
(1020, 'OR-202504241424408039', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 06:24:40', NULL, '2025-04-24 06:24:40', NULL, NULL),
(1021, 'OR-202504241424494048', 65, 125, 3, '2025-04-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-24 06:24:49', NULL, '2025-04-24 06:24:49', NULL, NULL),
(1022, 'OR-202504250919553416', 65, 125, 3, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 01:19:54', NULL, '2025-04-25 01:19:55', NULL, NULL),
(1023, 'OR-202504250920084052', 65, 125, 3, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 01:20:08', NULL, '2025-04-25 01:20:08', NULL, NULL),
(1024, 'OR-202504250920211848', 65, 125, 3, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 01:20:21', NULL, '2025-04-25 01:20:21', NULL, NULL),
(1025, 'OR-202504251057253729', 65, 125, 2, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 02:57:25', NULL, '2025-04-25 02:57:25', NULL, NULL),
(1026, 'OR-202504251325326021', 65, 125, 2, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 05:25:32', NULL, '2025-04-25 05:25:32', NULL, NULL),
(1027, 'OR-202504251340413799', 65, 125, 2, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 05:40:41', NULL, '2025-04-25 05:40:41', NULL, NULL),
(1028, 'OR-202504251403556898', 65, 125, 3, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 06:03:55', NULL, '2025-04-25 06:03:55', NULL, NULL),
(1029, 'OR-202504251404124387', 65, 125, 3, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 06:04:12', NULL, '2025-04-25 06:04:12', NULL, NULL),
(1030, 'OR-202504251404297526', 65, 125, 3, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 06:04:29', NULL, '2025-04-25 06:04:29', NULL, NULL),
(1031, 'OR-202504251406459467', 65, 125, 2, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 06:06:45', NULL, '2025-04-25 06:06:45', NULL, NULL),
(1032, 'OR-202504251416272649', 47, 89, 2, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 06:16:27', NULL, '2025-04-25 06:16:27', NULL, NULL),
(1033, 'OR-202504251443207069', 66, 130, 1, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 06:43:20', NULL, '2025-04-25 06:43:20', NULL, NULL),
(1034, 'OR-202504251443306118', 66, 130, 2, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 06:43:29', NULL, '2025-04-25 06:43:30', NULL, NULL),
(1035, 'OR-202504251446349699', 66, 130, 2, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 06:46:34', NULL, '2025-04-25 06:46:34', NULL, NULL),
(1036, 'OR-202504251450477831', 66, 130, 3, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 06:50:47', NULL, '2025-04-25 06:50:47', NULL, NULL),
(1037, 'OR-202504251451013343', 66, 130, 3, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 06:51:01', NULL, '2025-04-25 06:51:01', NULL, NULL),
(1038, 'OR-202504251451144543', 66, 130, 3, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 06:51:14', NULL, '2025-04-25 06:51:14', NULL, NULL),
(1039, 'OR-202504251558137225', 66, 130, 2, '2025-04-25', 'Sample Cashier', '', 'sample@gmail.com', '2025-04-25 07:58:13', NULL, '2025-04-25 07:58:13', NULL, NULL),
(1040, 'OR-202505021147221807', 67, 132, 1, '2025-05-02', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-02 03:47:22', NULL, '2025-05-02 03:47:22', NULL, NULL),
(1041, 'OR-202505021147445359', 67, 132, 5, '2025-05-02', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-02 03:47:44', NULL, '2025-05-02 03:47:44', NULL, NULL),
(1042, 'OR-202505021200487603', 67, 132, 1, '2025-05-02', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-02 04:00:48', NULL, '2025-05-02 04:00:48', NULL, NULL),
(1043, 'OR-202505021200549260', 67, 132, 5, '2025-05-02', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-02 04:00:54', NULL, '2025-05-02 04:00:54', NULL, NULL),
(1044, 'OR-202505021202041845', 67, 132, 2, '2025-05-02', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-02 04:02:04', NULL, '2025-05-02 04:02:04', NULL, NULL),
(1045, 'OR-202505021226323216', 67, 132, 1, '2025-05-02', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-02 04:26:32', NULL, '2025-05-02 04:26:32', NULL, NULL),
(1046, 'OR-202505021226384829', 67, 132, 5, '2025-05-02', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-02 04:26:38', NULL, '2025-05-02 04:26:38', NULL, NULL),
(1047, 'OR-202505021226456562', 67, 132, 2, '2025-05-02', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-02 04:26:45', NULL, '2025-05-02 04:26:45', NULL, NULL),
(1048, 'OR-202505021230391658', 67, 132, 3, '2025-05-02', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-02 04:30:39', NULL, '2025-05-02 04:30:39', NULL, NULL),
(1049, 'OR-202505021232061973', 67, 132, 3, '2025-05-02', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-02 04:32:06', NULL, '2025-05-02 04:32:06', NULL, NULL),
(1050, 'OR-202505021232122327', 67, 132, 3, '2025-05-02', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-02 04:32:12', NULL, '2025-05-02 04:32:12', NULL, NULL),
(1051, 'OR-202505060842394827', 69, 139, 1, '2025-05-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-06 00:42:39', NULL, '2025-05-06 00:42:39', NULL, NULL),
(1052, 'OR-202505060842458824', 69, 139, 1, '2025-05-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-06 00:42:45', NULL, '2025-05-06 00:42:45', NULL, NULL),
(1053, 'OR-202505060844007209', 69, 139, 1, '2025-05-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-06 00:43:59', NULL, '2025-05-06 00:44:00', NULL, NULL),
(1054, 'OR-202505061201332940', 68, 132, 1, '2025-05-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-06 04:01:33', NULL, '2025-05-06 04:01:33', NULL, NULL),
(1055, 'OR-202505061201444777', 68, 132, 5, '2025-05-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-06 04:01:44', NULL, '2025-05-06 04:01:44', NULL, NULL),
(1056, 'OR-202505061301032134', 70, 142, 1, '2025-05-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-06 05:01:03', NULL, '2025-05-06 05:01:03', NULL, NULL),
(1057, 'OR-202505061301138295', 70, 142, 5, '2025-05-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-06 05:01:13', NULL, '2025-05-06 05:01:13', NULL, NULL),
(1058, 'OR-202505061303345649', 70, 142, 2, '2025-05-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-06 05:03:34', NULL, '2025-05-06 05:03:34', NULL, NULL),
(1059, 'OR-202505061315281003', 71, 144, 1, '2025-05-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-06 05:15:28', NULL, '2025-05-06 05:15:28', NULL, NULL),
(1060, 'OR-202505061315383741', 71, 144, 5, '2025-05-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-06 05:15:38', NULL, '2025-05-06 05:15:38', NULL, NULL),
(1061, 'OR-202505061705521481', 72, 145, 1, '2025-05-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-06 09:05:52', NULL, '2025-05-06 09:05:52', NULL, NULL),
(1062, 'OR-202505061706004153', 72, 145, 5, '2025-05-06', 'Sample Cashier', '', 'sample@gmail.com', '2025-05-06 09:06:00', NULL, '2025-05-06 09:06:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `or_particulars`
--

CREATE TABLE `or_particulars` (
  `id` int NOT NULL,
  `item_id` int NOT NULL,
  `receipt_id` int NOT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `quantity` int NOT NULL,
  `unit_cost` int NOT NULL,
  `total_cost` int NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `or_particulars`
--

INSERT INTO `or_particulars` (`id`, `item_id`, `receipt_id`, `invoice_number`, `quantity`, `unit_cost`, `total_cost`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(748, 1, 830, NULL, 1, 500, 500, NULL, '2025-02-11 05:48:46', NULL, '2025-02-11 05:48:46', NULL, NULL),
(749, 2, 831, NULL, 1, 1000, 1000, NULL, '2025-02-11 05:56:20', NULL, '2025-02-11 05:56:20', NULL, NULL),
(750, 1, 832, NULL, 1, 500, 500, NULL, '2025-02-11 07:29:13', NULL, '2025-02-11 07:29:13', NULL, NULL),
(751, 2, 833, NULL, 1, 1000, 1000, NULL, '2025-02-11 07:29:20', NULL, '2025-02-11 07:29:20', NULL, NULL),
(752, 1, 834, NULL, 1, 500, 500, NULL, '2025-02-13 08:47:07', NULL, '2025-02-13 08:47:07', NULL, NULL),
(753, 2, 835, NULL, 1, 1000, 1000, NULL, '2025-02-13 08:47:13', NULL, '2025-02-13 08:47:13', NULL, NULL),
(754, 2, 836, NULL, 1, 1000, 1000, NULL, '2025-02-13 08:53:09', NULL, '2025-02-13 08:53:09', NULL, NULL),
(755, 3, 837, NULL, 1, 0, 0, NULL, '2025-02-13 09:08:59', NULL, '2025-02-13 09:08:59', NULL, NULL),
(756, 1, 838, NULL, 1, 500, 500, NULL, '2025-02-14 01:29:52', NULL, '2025-02-14 01:29:52', NULL, NULL),
(757, 2, 839, NULL, 1, 1000, 1000, NULL, '2025-02-14 01:30:00', NULL, '2025-02-14 01:30:00', NULL, NULL),
(758, 2, 840, NULL, 1, 1000, 1000, NULL, '2025-02-14 07:13:44', NULL, '2025-02-14 07:13:44', NULL, NULL),
(759, 1, 841, NULL, 1, 500, 500, NULL, '2025-02-14 07:41:44', NULL, '2025-02-14 07:41:44', NULL, NULL),
(760, 2, 842, NULL, 1, 1000, 1000, NULL, '2025-02-14 07:42:07', NULL, '2025-02-14 07:42:07', NULL, NULL),
(761, 3, 843, NULL, 1, 0, 0, NULL, '2025-02-14 07:49:04', NULL, '2025-02-14 07:49:04', NULL, NULL),
(762, 3, 844, NULL, 1, 0, 0, NULL, '2025-02-24 07:13:44', NULL, '2025-02-24 07:13:44', NULL, NULL),
(763, 1, 845, NULL, 1, 500, 500, NULL, '2025-03-03 09:08:11', NULL, '2025-03-03 09:08:11', NULL, NULL),
(764, 2, 846, NULL, 1, 1000, 1000, NULL, '2025-03-03 09:08:43', NULL, '2025-03-03 09:08:43', NULL, NULL),
(765, 1, 847, NULL, 1, 500, 500, NULL, '2025-03-04 01:26:19', NULL, '2025-03-04 01:26:19', NULL, NULL),
(766, 1, 850, NULL, 1, 500, 500, NULL, '2025-03-05 02:24:06', NULL, '2025-03-05 02:24:06', NULL, NULL),
(767, 2, 851, NULL, 1, 1000, 1000, NULL, '2025-03-05 02:24:16', NULL, '2025-03-05 02:24:16', NULL, NULL),
(768, 2, 852, NULL, 1, 1000, 1000, NULL, '2025-03-05 08:52:13', NULL, '2025-03-05 08:52:13', NULL, NULL),
(769, 2, 853, NULL, 1, 1000, 1000, NULL, '2025-03-05 08:52:22', NULL, '2025-03-05 08:52:22', NULL, NULL),
(770, 3, 854, NULL, 1, 437, 0, NULL, '2025-03-05 09:10:11', NULL, '2025-03-05 09:10:11', NULL, NULL),
(771, 3, 855, NULL, 1, 364, 0, NULL, '2025-03-06 02:59:42', NULL, '2025-03-06 02:59:42', NULL, NULL),
(772, 2, 856, NULL, 1, 1000, 1000, NULL, '2025-03-06 02:59:55', NULL, '2025-03-06 02:59:55', NULL, NULL),
(773, 3, 857, NULL, 1, 1821, 1821, NULL, '2025-03-06 03:23:46', NULL, '2025-03-06 03:23:46', NULL, NULL),
(774, 3, 858, NULL, 1, 364, 0, NULL, '2025-03-06 05:06:07', NULL, '2025-03-06 05:06:07', NULL, NULL),
(775, 1, 859, NULL, 1, 500, 500, NULL, '2025-03-06 06:09:28', NULL, '2025-03-06 06:09:28', NULL, NULL),
(776, 2, 860, NULL, 1, 1000, 1000, NULL, '2025-03-06 06:09:35', NULL, '2025-03-06 06:09:35', NULL, NULL),
(777, 3, 861, NULL, 1, 364, 0, NULL, '2025-03-06 07:23:14', NULL, '2025-03-06 07:23:14', NULL, NULL),
(778, 3, 862, NULL, 1, 364, 0, NULL, '2025-03-07 01:35:26', NULL, '2025-03-07 01:35:26', NULL, NULL),
(779, 3, 863, NULL, 1, 364, 0, NULL, '2025-03-07 01:59:48', NULL, '2025-03-07 01:59:48', NULL, NULL),
(780, 3, 864, NULL, 1, 364, 0, NULL, '2025-03-07 02:00:04', NULL, '2025-03-07 02:00:04', NULL, NULL),
(781, 3, 865, NULL, 1, 364, 0, NULL, '2025-03-07 02:05:26', NULL, '2025-03-07 02:05:26', NULL, NULL),
(782, 3, 866, NULL, 1, 364, 0, NULL, '2025-03-07 02:28:08', NULL, '2025-03-07 02:28:08', NULL, NULL),
(783, 3, 867, NULL, 1, 364, 0, NULL, '2025-03-07 02:28:20', NULL, '2025-03-07 02:28:20', NULL, NULL),
(784, 3, 868, NULL, 1, 364, 0, NULL, '2025-03-07 02:28:51', NULL, '2025-03-07 02:28:51', NULL, NULL),
(785, 3, 869, NULL, 1, 656, 0, NULL, '2025-03-07 05:29:03', NULL, '2025-03-07 05:29:03', NULL, NULL),
(786, 3, 870, NULL, 1, 656, 0, NULL, '2025-03-07 05:29:13', NULL, '2025-03-07 05:29:13', NULL, NULL),
(787, 3, 871, NULL, 1, 656, 0, NULL, '2025-03-07 05:29:27', NULL, '2025-03-07 05:29:27', NULL, NULL),
(788, 3, 872, NULL, 1, 232, 0, NULL, '2025-03-07 05:52:01', NULL, '2025-03-07 05:52:01', NULL, NULL),
(789, 3, 873, NULL, 1, 232, 0, NULL, '2025-03-07 06:05:27', NULL, '2025-03-07 06:05:27', NULL, NULL),
(790, 3, 874, NULL, 1, 232, 0, NULL, '2025-03-07 06:15:54', NULL, '2025-03-07 06:15:54', NULL, NULL),
(791, 3, 875, NULL, 1, 232, 0, NULL, '2025-03-07 06:17:39', NULL, '2025-03-07 06:17:39', NULL, NULL),
(792, 3, 876, NULL, 1, 232, 0, NULL, '2025-03-07 06:17:48', NULL, '2025-03-07 06:17:48', NULL, NULL),
(793, 3, 877, NULL, 1, 232, 0, NULL, '2025-03-07 06:17:57', NULL, '2025-03-07 06:17:57', NULL, NULL),
(794, 3, 878, NULL, 1, 364, 0, NULL, '2025-03-07 06:22:02', NULL, '2025-03-07 06:22:02', NULL, NULL),
(795, 3, 879, NULL, 1, 364, 0, NULL, '2025-03-07 06:22:18', NULL, '2025-03-07 06:22:18', NULL, NULL),
(796, 3, 880, NULL, 1, 364, 0, NULL, '2025-03-07 06:22:37', NULL, '2025-03-07 06:22:37', NULL, NULL),
(797, 3, 881, NULL, 1, 364, 0, NULL, '2025-03-07 07:55:49', NULL, '2025-03-07 07:55:49', NULL, NULL),
(798, 3, 882, NULL, 1, 419, 0, NULL, '2025-03-07 07:56:00', NULL, '2025-03-07 07:56:00', NULL, NULL),
(799, 3, 883, NULL, 1, 419, 0, NULL, '2025-03-07 07:56:15', NULL, '2025-03-07 07:56:15', NULL, NULL),
(800, 3, 884, NULL, 1, 419, 0, NULL, '2025-03-07 09:34:50', NULL, '2025-03-07 09:34:50', NULL, NULL),
(801, 3, 885, NULL, 1, 419, 0, NULL, '2025-03-07 09:35:03', NULL, '2025-03-07 09:35:03', NULL, NULL),
(802, 3, 886, NULL, 1, 419, 0, NULL, '2025-03-07 09:35:15', NULL, '2025-03-07 09:35:15', NULL, NULL),
(803, 3, 887, NULL, 1, 419, 0, NULL, '2025-03-07 09:41:41', NULL, '2025-03-07 09:41:41', NULL, NULL),
(804, 3, 888, NULL, 1, 419, 0, NULL, '2025-03-07 09:41:54', NULL, '2025-03-07 09:41:54', NULL, NULL),
(805, 3, 889, NULL, 1, 419, 0, NULL, '2025-03-07 09:42:07', NULL, '2025-03-07 09:42:07', NULL, NULL),
(806, 3, 890, NULL, 1, 419, 0, NULL, '2025-03-07 09:50:06', NULL, '2025-03-07 09:50:06', NULL, NULL),
(807, 3, 891, NULL, 1, 419, 0, NULL, '2025-03-07 09:50:15', NULL, '2025-03-07 09:50:15', NULL, NULL),
(808, 3, 892, NULL, 1, 419, 0, NULL, '2025-03-07 09:50:21', NULL, '2025-03-07 09:50:21', NULL, NULL),
(809, 3, 893, NULL, 1, 437, 0, NULL, '2025-03-07 09:57:37', NULL, '2025-03-07 09:57:37', NULL, NULL),
(810, 3, 894, NULL, 1, 437, 0, NULL, '2025-03-07 09:57:49', NULL, '2025-03-07 09:57:49', NULL, NULL),
(811, 3, 895, NULL, 1, 437, 0, NULL, '2025-03-07 09:57:58', NULL, '2025-03-07 09:57:58', NULL, NULL),
(812, 3, 896, NULL, 1, 419, 0, NULL, '2025-03-07 10:00:45', NULL, '2025-03-07 10:00:45', NULL, NULL),
(813, 3, 897, NULL, 1, 419, 0, NULL, '2025-03-07 10:00:56', NULL, '2025-03-07 10:00:56', NULL, NULL),
(814, 3, 898, NULL, 1, 546, 0, NULL, '2025-03-10 01:56:31', NULL, '2025-03-10 01:56:31', NULL, NULL),
(815, 3, 899, NULL, 1, 546, 0, NULL, '2025-03-10 01:56:49', NULL, '2025-03-10 01:56:49', NULL, NULL),
(816, 3, 900, NULL, 1, 546, 0, NULL, '2025-03-10 01:57:09', NULL, '2025-03-10 01:57:09', NULL, NULL),
(817, 3, 901, NULL, 1, 419, 0, NULL, '2025-03-10 02:03:39', NULL, '2025-03-10 02:03:39', NULL, NULL),
(818, 3, 902, NULL, 1, 419, 0, NULL, '2025-03-10 02:04:51', NULL, '2025-03-10 02:04:51', NULL, NULL),
(819, 3, 903, NULL, 1, 419, 0, NULL, '2025-03-10 02:26:14', NULL, '2025-03-10 02:26:14', NULL, NULL),
(820, 3, 904, NULL, 1, 419, 0, NULL, '2025-03-10 05:22:56', NULL, '2025-03-10 05:22:56', NULL, NULL),
(821, 3, 905, NULL, 1, 419, 0, NULL, '2025-03-10 05:23:07', NULL, '2025-03-10 05:23:07', NULL, NULL),
(822, 3, 906, NULL, 1, 419, 0, NULL, '2025-03-10 06:52:53', NULL, '2025-03-10 06:52:53', NULL, NULL),
(823, 3, 907, NULL, 1, 419, 0, NULL, '2025-03-10 07:08:22', NULL, '2025-03-10 07:08:22', NULL, NULL),
(824, 3, 908, NULL, 1, 419, 0, NULL, '2025-03-10 07:08:32', NULL, '2025-03-10 07:08:32', NULL, NULL),
(825, 3, 909, NULL, 1, 419, 0, NULL, '2025-03-10 07:08:43', NULL, '2025-03-10 07:08:43', NULL, NULL),
(826, 3, 910, NULL, 1, 546, 0, NULL, '2025-03-10 07:59:01', NULL, '2025-03-10 07:59:01', NULL, NULL),
(827, 3, 911, NULL, 1, 546, 0, NULL, '2025-03-10 07:59:31', NULL, '2025-03-10 07:59:31', NULL, NULL),
(828, 3, 912, NULL, 1, 546, 0, NULL, '2025-03-10 07:59:49', NULL, '2025-03-10 07:59:49', NULL, NULL),
(829, 3, 913, NULL, 1, 546, 0, NULL, '2025-03-11 05:45:44', NULL, '2025-03-11 05:45:44', NULL, NULL),
(830, 3, 914, NULL, 1, 546, 0, NULL, '2025-03-11 06:04:03', NULL, '2025-03-11 06:04:03', NULL, NULL),
(831, 3, 915, NULL, 1, 546, 0, NULL, '2025-03-11 06:04:20', NULL, '2025-03-11 06:04:20', NULL, NULL),
(832, 3, 916, NULL, 1, 419, 0, NULL, '2025-03-11 06:14:54', NULL, '2025-03-11 06:14:54', NULL, NULL),
(833, 3, 917, NULL, 1, 419, 0, NULL, '2025-03-11 06:17:58', NULL, '2025-03-11 06:17:58', NULL, NULL),
(834, 3, 918, NULL, 1, 419, 0, NULL, '2025-03-11 06:18:13', NULL, '2025-03-11 06:18:13', NULL, NULL),
(835, 3, 919, NULL, 1, 0, 0, NULL, '2025-03-11 06:19:10', NULL, '2025-03-11 06:19:10', NULL, NULL),
(836, 1, 920, NULL, 1, 500, 500, NULL, '2025-03-11 06:31:56', NULL, '2025-03-11 06:31:56', NULL, NULL),
(837, 2, 921, NULL, 1, 1000, 1000, NULL, '2025-03-11 06:32:05', NULL, '2025-03-11 06:32:05', NULL, NULL),
(838, 3, 922, NULL, 1, 419, 0, NULL, '2025-03-11 07:16:10', NULL, '2025-03-11 07:16:10', NULL, NULL),
(839, 3, 923, NULL, 1, 419, 0, NULL, '2025-03-11 07:16:21', NULL, '2025-03-11 07:16:21', NULL, NULL),
(840, 3, 924, NULL, 1, 419, 0, NULL, '2025-03-11 07:16:37', NULL, '2025-03-11 07:16:37', NULL, NULL),
(841, 3, 925, NULL, 1, 419, 0, NULL, '2025-03-11 23:26:53', NULL, '2025-03-11 23:26:53', NULL, NULL),
(842, 3, 926, NULL, 1, 419, 0, NULL, '2025-03-11 23:27:09', NULL, '2025-03-11 23:27:09', NULL, NULL),
(843, 3, 927, NULL, 1, 419, 0, NULL, '2025-03-11 23:27:22', NULL, '2025-03-11 23:27:22', NULL, NULL),
(844, 3, 928, NULL, 1, 455, 0, NULL, '2025-03-12 01:03:58', NULL, '2025-03-12 01:03:58', NULL, NULL),
(845, 3, 929, NULL, 1, 455, 0, NULL, '2025-03-12 01:04:18', NULL, '2025-03-12 01:04:18', NULL, NULL),
(846, 3, 930, NULL, 1, 455, 0, NULL, '2025-03-12 01:11:59', NULL, '2025-03-12 01:11:59', NULL, NULL),
(847, 3, 931, NULL, 1, 455, 0, NULL, '2025-03-12 01:13:12', NULL, '2025-03-12 01:13:12', NULL, NULL),
(848, 3, 932, NULL, 1, 455, 0, NULL, '2025-03-12 01:14:20', NULL, '2025-03-12 01:14:20', NULL, NULL),
(849, 2, 933, NULL, 1, 1000, 1000, NULL, '2025-03-13 00:48:09', NULL, '2025-03-13 00:48:09', NULL, NULL),
(850, 2, 934, NULL, 1, 1000, 1000, NULL, '2025-03-13 00:48:18', NULL, '2025-03-13 00:48:18', NULL, NULL),
(851, 3, 935, NULL, 1, 364, 364, NULL, '2025-03-17 05:32:20', NULL, '2025-03-17 05:32:20', NULL, NULL),
(852, 1, 936, NULL, 1, 500, 500, NULL, '2025-03-17 05:56:52', NULL, '2025-03-17 05:56:52', NULL, NULL),
(853, 2, 937, NULL, 1, 1000, 1000, NULL, '2025-03-17 05:57:16', NULL, '2025-03-17 05:57:16', NULL, NULL),
(854, 3, 938, NULL, 1, 222, 0, NULL, '2025-03-17 06:02:32', NULL, '2025-03-17 06:02:32', NULL, NULL),
(855, 3, 939, NULL, 1, 222, 0, NULL, '2025-03-17 06:05:00', NULL, '2025-03-17 06:05:00', NULL, NULL),
(856, 1, 940, NULL, 1, 500, 500, NULL, '2025-03-20 07:57:13', NULL, '2025-03-20 07:57:13', NULL, NULL),
(857, 2, 941, NULL, 1, 1000, 1000, NULL, '2025-03-20 07:57:29', NULL, '2025-03-20 07:57:29', NULL, NULL),
(858, 2, 942, NULL, 1, 1000, 1000, NULL, '2025-03-20 07:59:50', NULL, '2025-03-20 07:59:50', NULL, NULL),
(859, 3, 943, NULL, 1, 232, 0, NULL, '2025-03-20 08:11:29', NULL, '2025-03-20 08:11:29', NULL, NULL),
(860, 3, 944, NULL, 1, 232, 0, NULL, '2025-03-20 08:11:42', NULL, '2025-03-20 08:11:42', NULL, NULL),
(861, 3, 945, NULL, 1, 232, 0, NULL, '2025-03-20 08:11:52', NULL, '2025-03-20 08:11:52', NULL, NULL),
(862, 3, 946, NULL, 1, 232, 0, NULL, '2025-03-20 08:12:00', NULL, '2025-03-20 08:12:00', NULL, NULL),
(863, 3, 947, NULL, 1, 232, 0, NULL, '2025-03-20 08:12:09', NULL, '2025-03-20 08:12:09', NULL, NULL),
(864, 3, 948, NULL, 1, 232, 0, NULL, '2025-03-20 08:12:18', NULL, '2025-03-20 08:12:18', NULL, NULL),
(865, 2, 949, NULL, 1, 1000, 1000, NULL, '2025-03-20 08:14:01', NULL, '2025-03-20 08:14:01', NULL, NULL),
(866, 3, 950, NULL, 1, 3642, 0, NULL, '2025-03-21 07:54:38', NULL, '2025-03-21 07:54:38', NULL, NULL),
(867, 3, 951, NULL, 1, 3642, 0, NULL, '2025-03-21 07:55:48', NULL, '2025-03-21 07:55:48', NULL, NULL),
(868, 3, 952, NULL, 1, 3642, 0, NULL, '2025-03-21 07:56:55', NULL, '2025-03-21 07:56:55', NULL, NULL),
(869, 1, 953, NULL, 1, 500, 500, NULL, '2025-04-15 00:20:39', NULL, '2025-04-15 00:20:39', NULL, NULL),
(870, 2, 954, NULL, 1, 1000, 1000, NULL, '2025-04-15 00:23:04', NULL, '2025-04-15 00:23:04', NULL, NULL),
(871, 2, 955, NULL, 1, 1000, 1000, NULL, '2025-04-15 07:28:39', NULL, '2025-04-15 07:28:39', NULL, NULL),
(872, 2, 956, NULL, 1, 1000, 1000, NULL, '2025-04-15 07:29:27', NULL, '2025-04-15 07:29:27', NULL, NULL),
(873, 1, 957, NULL, 1, 500, 500, NULL, '2025-04-15 07:42:46', NULL, '2025-04-15 07:42:46', NULL, NULL),
(874, 2, 958, NULL, 1, 1000, 1000, NULL, '2025-04-15 07:42:57', NULL, '2025-04-15 07:42:57', NULL, NULL),
(875, 2, 959, NULL, 1, 1000, 1000, NULL, '2025-04-21 02:30:51', NULL, '2025-04-21 02:30:51', NULL, NULL),
(876, 1, 960, NULL, 1, 500, 500, NULL, '2025-04-23 08:08:43', NULL, '2025-04-23 08:08:43', NULL, NULL),
(877, 1, 962, NULL, 1, 500, 500, NULL, '2025-04-23 08:08:50', NULL, '2025-04-23 08:08:50', NULL, NULL),
(878, 1, 964, NULL, 1, 500, 500, NULL, '2025-04-23 08:12:27', NULL, '2025-04-23 08:12:27', NULL, NULL),
(879, 1, 966, NULL, 1, 500, 500, NULL, '2025-04-23 08:12:44', NULL, '2025-04-23 08:12:44', NULL, NULL),
(880, 1, 968, NULL, 1, 500, 500, NULL, '2025-04-23 08:13:00', NULL, '2025-04-23 08:13:00', NULL, NULL),
(881, 1, 974, NULL, 1, 500, 500, NULL, '2025-04-23 08:16:27', NULL, '2025-04-23 08:16:27', NULL, NULL),
(882, 1, 976, NULL, 1, 500, 500, NULL, '2025-04-23 08:16:38', NULL, '2025-04-23 08:16:38', NULL, NULL),
(883, 2, 980, NULL, 1, 1000, 1000, NULL, '2025-04-23 08:17:42', NULL, '2025-04-23 08:17:42', NULL, NULL),
(884, 3, 981, NULL, 1, 656, 0, NULL, '2025-04-24 00:56:35', NULL, '2025-04-24 00:56:35', NULL, NULL),
(885, 3, 982, NULL, 1, 656, 0, NULL, '2025-04-24 01:05:07', NULL, '2025-04-24 01:05:07', NULL, NULL),
(886, 3, 983, NULL, 1, 656, 0, NULL, '2025-04-24 01:05:51', NULL, '2025-04-24 01:05:51', NULL, NULL),
(887, 3, 984, NULL, 1, 364, 0, NULL, '2025-04-24 01:15:22', NULL, '2025-04-24 01:15:22', NULL, NULL),
(888, 3, 985, NULL, 1, 364, 0, NULL, '2025-04-24 01:15:36', NULL, '2025-04-24 01:15:36', NULL, NULL),
(889, 3, 986, NULL, 1, 364, 0, NULL, '2025-04-24 01:16:24', NULL, '2025-04-24 01:16:24', NULL, NULL),
(890, 3, 987, NULL, 1, 1093, 0, NULL, '2025-04-24 01:24:58', NULL, '2025-04-24 01:24:58', NULL, NULL),
(891, 3, 988, NULL, 1, 1093, 0, NULL, '2025-04-24 01:25:11', NULL, '2025-04-24 01:25:11', NULL, NULL),
(892, 3, 989, NULL, 1, 1093, 0, NULL, '2025-04-24 01:25:21', NULL, '2025-04-24 01:25:21', NULL, NULL),
(893, 3, 990, NULL, 1, 364, 0, NULL, '2025-04-24 01:43:41', NULL, '2025-04-24 01:43:41', NULL, NULL),
(894, 3, 991, NULL, 1, 364, 0, NULL, '2025-04-24 01:43:55', NULL, '2025-04-24 01:43:55', NULL, NULL),
(895, 3, 992, NULL, 1, 364, 0, NULL, '2025-04-24 01:44:14', NULL, '2025-04-24 01:44:14', NULL, NULL),
(896, 3, 993, NULL, 1, 73, 0, NULL, '2025-04-24 02:14:26', NULL, '2025-04-24 02:14:26', NULL, NULL),
(897, 3, 994, NULL, 1, 73, 0, NULL, '2025-04-24 02:14:40', NULL, '2025-04-24 02:14:40', NULL, NULL),
(898, 3, 995, NULL, 1, 73, 0, NULL, '2025-04-24 02:14:54', NULL, '2025-04-24 02:14:54', NULL, NULL),
(899, 3, 996, NULL, 1, 364, 0, NULL, '2025-04-24 02:31:05', NULL, '2025-04-24 02:31:05', NULL, NULL),
(900, 3, 997, NULL, 1, 364, 0, NULL, '2025-04-24 02:32:27', NULL, '2025-04-24 02:32:27', NULL, NULL),
(901, 3, 998, NULL, 1, 364, 0, NULL, '2025-04-24 02:33:12', NULL, '2025-04-24 02:33:12', NULL, NULL),
(902, 3, 999, NULL, 1, 361, 0, NULL, '2025-04-24 03:04:34', NULL, '2025-04-24 03:04:34', NULL, NULL),
(903, 3, 1000, NULL, 1, 364, 0, NULL, '2025-04-24 03:05:09', NULL, '2025-04-24 03:05:09', NULL, NULL),
(904, 3, 1001, NULL, 1, 364, 0, NULL, '2025-04-24 03:05:49', NULL, '2025-04-24 03:05:49', NULL, NULL),
(905, 3, 1002, NULL, 1, 291, 0, NULL, '2025-04-24 05:10:59', NULL, '2025-04-24 05:10:59', NULL, NULL),
(906, 3, 1003, NULL, 1, 291, 0, NULL, '2025-04-24 05:11:13', NULL, '2025-04-24 05:11:13', NULL, NULL),
(907, 3, 1004, NULL, 1, 291, 0, NULL, '2025-04-24 05:14:46', NULL, '2025-04-24 05:14:46', NULL, NULL),
(908, 3, 1005, NULL, 1, 364, 0, NULL, '2025-04-24 05:23:09', NULL, '2025-04-24 05:23:09', NULL, NULL),
(909, 3, 1006, NULL, 1, 364, 0, NULL, '2025-04-24 05:23:42', NULL, '2025-04-24 05:23:42', NULL, NULL),
(910, 3, 1007, NULL, 1, 364, 0, NULL, '2025-04-24 05:24:23', NULL, '2025-04-24 05:24:23', NULL, NULL),
(911, 3, 1008, NULL, 1, 364, 0, NULL, '2025-04-24 05:37:55', NULL, '2025-04-24 05:37:55', NULL, NULL),
(912, 3, 1009, NULL, 1, 364, 0, NULL, '2025-04-24 05:38:04', NULL, '2025-04-24 05:38:04', NULL, NULL),
(913, 3, 1010, NULL, 1, 364, 0, NULL, '2025-04-24 05:38:53', NULL, '2025-04-24 05:38:53', NULL, NULL),
(914, 3, 1011, NULL, 1, 346, 0, NULL, '2025-04-24 05:43:17', NULL, '2025-04-24 05:43:17', NULL, NULL),
(915, 3, 1012, NULL, 1, 364, 0, NULL, '2025-04-24 05:45:53', NULL, '2025-04-24 05:45:53', NULL, NULL),
(916, 3, 1013, NULL, 1, 364, 0, NULL, '2025-04-24 05:46:05', NULL, '2025-04-24 05:46:05', NULL, NULL),
(917, 3, 1014, NULL, 1, 728, 0, NULL, '2025-04-24 05:54:15', NULL, '2025-04-24 05:54:15', NULL, NULL),
(918, 3, 1015, NULL, 1, 728, 0, NULL, '2025-04-24 05:54:26', NULL, '2025-04-24 05:54:26', NULL, NULL),
(919, 3, 1016, NULL, 1, 728, 0, NULL, '2025-04-24 05:55:11', NULL, '2025-04-24 05:55:11', NULL, NULL),
(920, 3, 1017, NULL, 1, 364, 0, NULL, '2025-04-24 06:12:27', NULL, '2025-04-24 06:12:27', NULL, NULL),
(921, 3, 1018, NULL, 1, 364, 0, NULL, '2025-04-24 06:12:37', NULL, '2025-04-24 06:12:37', NULL, NULL),
(922, 3, 1019, NULL, 1, 364, 0, NULL, '2025-04-24 06:24:10', NULL, '2025-04-24 06:24:10', NULL, NULL),
(923, 3, 1020, NULL, 1, 364, 0, NULL, '2025-04-24 06:24:40', NULL, '2025-04-24 06:24:40', NULL, NULL),
(924, 3, 1021, NULL, 1, 364, 0, NULL, '2025-04-24 06:24:49', NULL, '2025-04-24 06:24:49', NULL, NULL),
(925, 3, 1022, NULL, 1, 364, 0, NULL, '2025-04-25 01:19:55', NULL, '2025-04-25 01:19:55', NULL, NULL),
(926, 3, 1023, NULL, 1, 364, 0, NULL, '2025-04-25 01:20:08', NULL, '2025-04-25 01:20:08', NULL, NULL),
(927, 3, 1024, NULL, 1, 364, 0, NULL, '2025-04-25 01:20:21', NULL, '2025-04-25 01:20:21', NULL, NULL),
(928, 2, 1025, NULL, 1, 1000, 1000, NULL, '2025-04-25 02:57:25', NULL, '2025-04-25 02:57:25', NULL, NULL),
(929, 2, 1026, NULL, 1, 1000, 1000, NULL, '2025-04-25 05:25:32', NULL, '2025-04-25 05:25:32', NULL, NULL),
(930, 2, 1027, NULL, 1, 1000, 1000, NULL, '2025-04-25 05:40:41', NULL, '2025-04-25 05:40:41', NULL, NULL),
(931, 3, 1028, NULL, 1, 364, 0, NULL, '2025-04-25 06:03:55', NULL, '2025-04-25 06:03:55', NULL, NULL),
(932, 3, 1029, NULL, 1, 364, 0, NULL, '2025-04-25 06:04:12', NULL, '2025-04-25 06:04:12', NULL, NULL),
(933, 3, 1030, NULL, 1, 364, 0, NULL, '2025-04-25 06:04:29', NULL, '2025-04-25 06:04:29', NULL, NULL),
(934, 2, 1031, NULL, 1, 1000, 1000, NULL, '2025-04-25 06:06:45', NULL, '2025-04-25 06:06:45', NULL, NULL),
(935, 2, 1032, NULL, 1, 1000, 1000, NULL, '2025-04-25 06:16:27', NULL, '2025-04-25 06:16:27', NULL, NULL),
(936, 1, 1033, NULL, 1, 500, 500, NULL, '2025-04-25 06:43:20', NULL, '2025-04-25 06:43:20', NULL, NULL),
(937, 2, 1034, NULL, 1, 1000, 1000, NULL, '2025-04-25 06:43:30', NULL, '2025-04-25 06:43:30', NULL, NULL),
(938, 2, 1035, NULL, 1, 1000, 1000, NULL, '2025-04-25 06:46:34', NULL, '2025-04-25 06:46:34', NULL, NULL),
(939, 3, 1036, NULL, 1, 364, 0, NULL, '2025-04-25 06:50:47', NULL, '2025-04-25 06:50:47', NULL, NULL),
(940, 3, 1037, NULL, 1, 364, 0, NULL, '2025-04-25 06:51:01', NULL, '2025-04-25 06:51:01', NULL, NULL),
(941, 3, 1038, NULL, 1, 364, 0, NULL, '2025-04-25 06:51:14', NULL, '2025-04-25 06:51:14', NULL, NULL),
(942, 2, 1039, NULL, 1, 1000, 1000, NULL, '2025-04-25 07:58:13', NULL, '2025-04-25 07:58:13', NULL, NULL),
(943, 1, 1040, NULL, 1, 500, 500, NULL, '2025-05-02 03:47:22', NULL, '2025-05-02 03:47:22', NULL, NULL),
(944, 2, 1041, NULL, 1, 1000, 1000, NULL, '2025-05-02 03:47:44', NULL, '2025-05-02 03:47:44', NULL, NULL),
(945, 1, 1042, NULL, 1, 500, 500, NULL, '2025-05-02 04:00:48', NULL, '2025-05-02 04:00:48', NULL, NULL),
(946, 2, 1043, NULL, 1, 1000, 1000, NULL, '2025-05-02 04:00:54', NULL, '2025-05-02 04:00:54', NULL, NULL),
(947, 2, 1044, NULL, 1, 1000, 1000, NULL, '2025-05-02 04:02:04', NULL, '2025-05-02 04:02:04', NULL, NULL),
(948, 1, 1045, NULL, 1, 500, 500, NULL, '2025-05-02 04:26:32', NULL, '2025-05-02 04:26:32', NULL, NULL),
(949, 2, 1046, NULL, 1, 1000, 1000, NULL, '2025-05-02 04:26:38', NULL, '2025-05-02 04:26:38', NULL, NULL),
(950, 2, 1047, NULL, 1, 1000, 1000, NULL, '2025-05-02 04:26:45', NULL, '2025-05-02 04:26:45', NULL, NULL),
(951, 3, 1048, NULL, 1, 364, 0, NULL, '2025-05-02 04:30:39', NULL, '2025-05-02 04:30:39', NULL, NULL),
(952, 3, 1049, NULL, 1, 364, 0, NULL, '2025-05-02 04:32:06', NULL, '2025-05-02 04:32:06', NULL, NULL),
(953, 3, 1050, NULL, 1, 364, 0, NULL, '2025-05-02 04:32:12', NULL, '2025-05-02 04:32:12', NULL, NULL),
(954, 1, 1051, NULL, 1, 500, 500, NULL, '2025-05-06 00:42:39', NULL, '2025-05-06 00:42:39', NULL, NULL),
(955, 1, 1052, NULL, 1, 500, 500, NULL, '2025-05-06 00:42:45', NULL, '2025-05-06 00:42:45', NULL, NULL),
(956, 1, 1053, NULL, 1, 500, 500, NULL, '2025-05-06 00:44:00', NULL, '2025-05-06 00:44:00', NULL, NULL),
(957, 1, 1054, NULL, 1, 500, 500, NULL, '2025-05-06 04:01:33', NULL, '2025-05-06 04:01:33', NULL, NULL),
(958, 4, 1055, NULL, 1, 2000, 2000, NULL, '2025-05-06 04:01:44', NULL, '2025-05-06 04:01:44', NULL, NULL),
(959, 1, 1056, NULL, 1, 500, 500, NULL, '2025-05-06 05:01:03', NULL, '2025-05-06 05:01:03', NULL, NULL),
(960, 4, 1057, NULL, 1, 2000, 2000, NULL, '2025-05-06 05:01:13', NULL, '2025-05-06 05:01:13', NULL, NULL),
(961, 2, 1058, NULL, 1, 1000, 1000, NULL, '2025-05-06 05:03:34', NULL, '2025-05-06 05:03:34', NULL, NULL),
(962, 1, 1059, NULL, 1, 500, 500, NULL, '2025-05-06 05:15:28', NULL, '2025-05-06 05:15:28', NULL, NULL),
(963, 4, 1060, NULL, 1, 2000, 2000, NULL, '2025-05-06 05:15:38', NULL, '2025-05-06 05:15:38', NULL, NULL),
(964, 1, 1061, NULL, 1, 500, 500, NULL, '2025-05-06 09:05:52', NULL, '2025-05-06 09:05:52', NULL, NULL),
(965, 4, 1062, NULL, 1, 2000, 2000, NULL, '2025-05-06 09:06:00', NULL, '2025-05-06 09:06:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `invoice_id` int NOT NULL,
  `user_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_type` enum('bank_transfer','Cash','Online') NOT NULL,
  `status` enum('Pending Verification','Completed','Failed') DEFAULT 'Pending Verification',
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_account_map`
--

CREATE TABLE `payment_account_map` (
  `id` int NOT NULL,
  `payment_options_id` int NOT NULL,
  `transaction_account_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment_account_map`
--

INSERT INTO `payment_account_map` (`id`, `payment_options_id`, `transaction_account_id`) VALUES
(1, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int NOT NULL,
  `account_type_id` int NOT NULL,
  `financial_service_provider` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` enum('Bank','E-Wallet','Cash') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `account_type_id`, `financial_service_provider`, `type`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(2, 4, 'BDO', 'Bank', '2024-10-29 03:03:29', NULL, '2024-11-12 03:01:03', NULL, NULL, NULL),
(11, 3, 'GCash', 'E-Wallet', '2024-10-29 03:05:46', NULL, '2024-11-12 03:01:09', NULL, NULL, NULL),
(22, 3, 'Maya', 'E-Wallet', '2024-11-12 05:18:09', NULL, '2024-11-12 05:18:25', NULL, NULL, NULL),
(23, 1, 'over_the_counter', 'Cash', '2024-11-13 08:42:13', NULL, '2024-11-18 08:39:21', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_options`
--

CREATE TABLE `payment_options` (
  `id` int NOT NULL,
  `cash_accounts_id` int NOT NULL,
  `code` int NOT NULL,
  `payment_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment_options`
--

INSERT INTO `payment_options` (`id`, `cash_accounts_id`, `code`, `payment_name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 1, 1110001, 'Cash payment', '1', '2024-11-10 13:36:08', NULL, '2024-11-10 13:36:08', NULL, NULL),
(2, 1, 1110006, 'Cheque', '1', '2024-10-29 01:35:01', NULL, '2024-10-29 01:35:01', NULL, NULL),
(3, 1, 1110006, 'E-wallet', '1', '2025-03-17 03:14:31', NULL, '2025-03-17 03:14:31', NULL, NULL),
(4, 1, 1110007, 'Bank transfer', '1', '2025-02-18 05:00:33', NULL, '2025-02-18 05:00:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_records`
--

CREATE TABLE `payment_records` (
  `id` int NOT NULL,
  `invoice_particulars_id` int DEFAULT NULL,
  `transaction_category_id` int DEFAULT NULL,
  `transaction_reference_id` int NOT NULL,
  `payment_date` datetime NOT NULL,
  `date_verified` datetime NOT NULL,
  `payment_method_id` int DEFAULT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `reference_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `total_payment` decimal(15,2) NOT NULL,
  `details` varchar(255) NOT NULL,
  `payment_proof` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `or_particulars_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment_records`
--

INSERT INTO `payment_records` (`id`, `invoice_particulars_id`, `transaction_category_id`, `transaction_reference_id`, `payment_date`, `date_verified`, `payment_method_id`, `account_name`, `account_number`, `reference_number`, `total_payment`, `details`, `payment_proof`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `or_particulars_id`) VALUES
(1021, 1045, 1, 0, '2025-05-06 08:37:49', '2025-05-06 08:44:00', 11, '', '', 'REF123456', '500.00', '', 'uploads/proof_of_payment/139/INV-202505060837493880/681959dd3a328.jpg', 'Completed', 'kath-test@mailinator.com', '2025-05-06 00:44:00', 'sample@gmail.com', '2025-05-06 00:43:59', NULL, NULL, 956),
(1022, 1046, 2, 0, '2025-05-06 08:37:49', '0000-00-00 00:00:00', 11, '', '', 'REF123456', '2000.00', '', 'uploads/proof_of_payment/139/INV-202505060837491187/681959dd3d472.jpg', 'pending', 'kath-test@mailinator.com', '2025-05-06 00:37:49', NULL, '2025-05-06 00:37:49', NULL, NULL, NULL),
(1025, 1049, 1, 0, '2025-05-06 11:20:55', '2025-05-06 12:01:33', 11, '', '', 'ref124561', '500.00', '', 'uploads/proof_of_payment/132/INV-202505061120558209/68198017681b4.jpg', 'Completed', 'kath1234@mailinator.com', '2025-05-06 04:01:33', 'sample@gmail.com', '2025-05-06 04:01:33', NULL, NULL, 957),
(1026, 1050, 5, 0, '2025-05-06 11:20:55', '2025-05-06 12:01:44', 11, '', '', 'REF123456', '2000.00', '', 'uploads/proof_of_payment/132/INV-202505061120552166/6819801769e27.jpeg', 'Completed', 'kath1234@mailinator.com', '2025-05-06 04:01:44', 'sample@gmail.com', '2025-05-06 04:01:44', NULL, NULL, 958),
(1041, 1065, 1, 0, '2025-05-06 12:00:23', '0000-00-00 00:00:00', 11, '', '', 'ref124561', '500.00', '', 'uploads/proof_of_payment/132/INV-202505061200231218/68198957d2733.jpeg', 'pending', 'kath1234@mailinator.com', '2025-05-06 04:00:23', NULL, '2025-05-06 04:00:23', NULL, NULL, NULL),
(1042, 1066, 5, 0, '2025-05-06 12:00:23', '0000-00-00 00:00:00', 11, '', '', 'REF123456', '2000.00', '', 'uploads/proof_of_payment/132/INV-202505061200233881/68198957d4046.jpeg', 'pending', 'kath1234@mailinator.com', '2025-05-06 04:00:23', NULL, '2025-05-06 04:00:23', NULL, NULL, NULL),
(1043, 1067, 1, 0, '2025-05-06 13:00:20', '2025-05-06 13:01:03', 2, '', '', 'REF12345', '500.00', '', 'uploads/proof_of_payment/142/INV-202505061300206924/68199764e36d8.jpeg', 'Completed', 'kathrina123456@mailinator.com', '2025-05-06 05:01:03', 'sample@gmail.com', '2025-05-06 05:01:03', NULL, NULL, 959),
(1044, 1068, 5, 0, '2025-05-06 13:00:20', '2025-05-06 13:01:13', 22, '', '', 'REF12345', '2000.00', '', 'uploads/proof_of_payment/142/INV-202505061300207556/68199764e667c.jpeg', 'Completed', 'kathrina123456@mailinator.com', '2025-05-06 05:01:13', 'sample@gmail.com', '2025-05-06 05:01:13', NULL, NULL, 960),
(1045, 1069, 2, 0, '2025-05-06 00:00:00', '2025-05-06 13:03:34', 23, '', '', '', '6000.00', '', 'uploads/payments/payment_receipt/142/6819980459066.jpeg', 'Completed', 'kathrina123456@mailinator.com', '2025-05-06 05:03:34', 'sample@gmail.com', '2025-05-06 05:03:34', NULL, NULL, 961),
(1046, 1070, 1, 0, '2025-05-06 13:15:00', '2025-05-06 13:15:28', 2, '', '', 'REF11342453', '500.00', '', 'uploads/proof_of_payment/144/INV-202505061315003398/68199ad488460.jpeg', 'Completed', 'kath1234567@mailinator.com', '2025-05-06 05:15:28', 'sample@gmail.com', '2025-05-06 05:15:28', NULL, NULL, 962),
(1047, 1071, 5, 0, '2025-05-06 13:15:00', '2025-05-06 13:15:38', 11, '', '', 'REF123456', '2000.00', '', 'uploads/proof_of_payment/144/INV-202505061315009061/68199ad48bdcd.jpeg', 'Completed', 'kath1234567@mailinator.com', '2025-05-06 05:15:38', 'sample@gmail.com', '2025-05-06 05:15:38', NULL, NULL, 963),
(1048, 1072, 1, 0, '2025-05-06 16:59:17', '2025-05-06 17:05:52', 2, '', '', 'ref12341561', '500.00', '', 'uploads/proof_of_payment/145/INV-202505061659176248/6819cf65330fa.jpeg', 'Completed', 'kath12345678@mailinator.com', '2025-05-06 09:05:52', 'sample@gmail.com', '2025-05-06 09:05:52', NULL, NULL, 964),
(1049, 1073, 5, 0, '2025-05-06 16:59:17', '2025-05-06 17:06:00', 2, '', '', 'ref12345', '2000.00', '', 'uploads/proof_of_payment/145/INV-202505061659175102/6819cf653503f.jpeg', 'Completed', 'kath12345678@mailinator.com', '2025-05-06 09:06:00', 'sample@gmail.com', '2025-05-06 09:06:00', NULL, NULL, 965);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int NOT NULL,
  `permission_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_name`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(5, 'can_manage_roles', 'Allows assigning or modifying user roles', '2023-09-30 16:00:00', '1', NULL, NULL, NULL, NULL),
(8, 'can_approve_loan', 'Approves any pending loan application', '2025-02-04 06:43:58', 'john.doe@example.com', '2025-02-04 06:55:08', NULL, '2025-02-04 06:55:08', 'john.doe@example.com'),
(9, 'can_view_loan_applicants', 'View the loan application dashboard', '2025-02-10 00:59:30', 'john.doe@example.com', '2025-02-10 00:59:30', NULL, NULL, NULL),
(10, 'view_all_invoice', 'View the invoice for all user', '2025-02-10 06:41:41', 'john.doe@example.com', '2025-02-10 06:41:41', NULL, NULL, NULL),
(11, 'process_payments', 'Accept and process payments', '2025-02-10 06:42:00', 'john.doe@example.com', '2025-02-10 06:42:00', NULL, NULL, NULL),
(13, 'view_transaction_billing', '	Confirm online payment transactions', '2025-02-10 06:42:40', 'john.doe@example.com', '2025-02-10 07:28:04', NULL, NULL, NULL),
(14, 'validate_payment', 'Verify payment authenticity before confirming', '2025-02-10 06:42:54', 'john.doe@example.com', '2025-02-10 06:42:54', NULL, NULL, NULL),
(15, 'disburse_loan', 'disburses the loan to the end user', '2025-02-10 06:48:31', 'john.doe@example.com', '2025-02-10 06:48:31', NULL, NULL, NULL),
(16, 'view_transaction_history', 'View all transactions made by the end user', '2025-02-10 06:56:48', 'john.doe@example.com', '2025-02-10 06:56:49', NULL, NULL, NULL),
(17, 'confirm_membership', 'Allows confirming membership application', '2025-02-10 08:13:47', 'john.doe@example.com', '2025-02-10 08:14:13', NULL, NULL, NULL),
(18, 'view_membership_application', ' Allows viewing pending membership applications.', '2025-02-10 08:14:40', 'john.doe@example.com', '2025-02-10 08:14:40', NULL, NULL, NULL),
(19, 'edit_membership_details', 'Allows modifying member details before approval', '2025-02-10 08:15:10', 'john.doe@example.com', '2025-02-10 08:15:11', NULL, NULL, NULL),
(20, 'view_loan', 'Can view loans and have loans', '2025-02-19 06:04:09', 'john.doe@example.com', '2025-02-19 06:04:10', NULL, NULL, NULL),
(21, 'view_loan_invoice', 'Can view loan and pending invoice', '2025-02-19 06:31:33', 'john.doe@example.com', '2025-02-19 06:31:33', NULL, NULL, NULL),
(22, 'view_contribution', 'view the contributions based on personal transactions', '2025-02-19 07:44:08', 'john.doe@example.com', '2025-02-19 07:44:08', NULL, NULL, NULL),
(23, 'initiate_contribution_payment', 'user permission for payment contribution', '2025-02-19 07:53:29', 'john.doe@example.com', '2025-02-19 07:53:29', NULL, NULL, NULL),
(24, 'can_approve_code', 'Provides code revies', '2025-03-07 02:58:58', 'john.doe@example.com', '2025-03-07 02:58:59', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int NOT NULL,
  `position_title` varchar(255) DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `unit_id` int DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position_title`, `department_id`, `unit_id`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Engineer I', 1, 1, 'Sample 1', '2024-09-13 09:19:03', 'sysadmin', '2024-09-13 09:19:03', NULL, NULL, NULL),
(2, 'Web Developer', 1, 1, 'Web developer for financial frauds', '2025-03-12 01:47:05', 'sysadmin', '2025-03-18 06:25:03', NULL, '2025-03-18 06:25:03', 'sysadmin');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `description`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'Super Admin', 'Has full access to the system', '1', '2025-02-10 02:04:18', '1', '2025-02-10 02:04:18', 'john.doe@example.com', '2025-02-10 02:04:18'),
(2, 'Admin', 'Manages users and content', '1', '2023-10-01 02:05:00', '1', '2023-10-01 02:05:00', NULL, NULL),
(3, 'Editor', 'Can edit and publish content', '1', '2025-02-10 02:04:25', '1', '2025-02-10 02:04:25', 'john.doe@example.com', '2025-02-10 02:04:25'),
(4, 'Viewer', 'Can view content but not edit', '1', '2025-02-10 02:04:30', '1', '2025-02-10 02:04:30', 'john.doe@example.com', '2025-02-10 02:04:30'),
(5, 'Guest', 'Limited access to the system', '1', '2025-02-10 02:04:41', '1', '2025-02-10 02:04:41', 'john.doe@example.com', '2025-02-10 02:04:41'),
(6, 'Loan Approver', 'Approves or rejects loan applications', '1', '2023-10-01 02:25:00', '1', '2023-10-01 02:25:00', NULL, NULL),
(7, 'User', 'Regular user with basic access', '1', '2023-10-01 02:30:00', '1', '2023-10-01 02:30:00', NULL, NULL),
(8, 'Member', 'Registered member with additional privileges', '1', '2023-10-01 02:35:00', '1', '2023-10-01 02:35:00', NULL, NULL),
(9, 'Cashier', 'Handles financial transactions', '1', '2023-10-01 02:40:00', '1', '2023-10-01 02:40:00', NULL, NULL),
(15, 'Loan Disburser', 'Has full access to loan disbursement to end user', 'john.doe@example.com', '2025-02-05 00:42:08', NULL, '2025-02-05 00:42:08', 'john.doe@example.com', '2025-02-05 00:42:08'),
(17, 'Member Officer', 'Handles the monitoring, verification, and review of members', 'john.doe@example.com', '2025-04-02 05:57:33', NULL, '2025-04-02 05:57:33', NULL, NULL),
(18, 'Loan Officer', 'Monitors and handles loan applications, repayments, and approval', 'john.doe@example.com', '2025-04-04 08:22:48', NULL, '2025-04-04 08:22:48', NULL, NULL),
(19, 'Coop Manager', 'for approval of different entities in the system', 'john.doe@example.com', '2025-04-14 18:39:04', NULL, '2025-04-14 18:39:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int NOT NULL,
  `role_id` int NOT NULL,
  `permissions_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permissions_id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(3, 7, 5, '2025-02-06 01:22:00', 'john.doe@example.com', '2025-02-06 01:22:00', NULL, NULL, NULL),
(4, 6, 5, '2025-02-06 01:34:03', 'john.doe@example.com', '2025-02-06 01:34:03', NULL, NULL, NULL),
(9, 2, 5, '2025-02-06 01:34:47', 'john.doe@example.com', '2025-02-06 01:34:47', NULL, NULL, NULL),
(20, 6, 9, '2025-02-10 01:00:02', 'john.doe@example.com', '2025-02-10 01:00:02', NULL, NULL, NULL),
(23, 9, 16, '2025-02-10 07:02:12', 'john.doe@example.com', '2025-02-10 07:02:12', NULL, NULL, NULL),
(25, 9, 11, '2025-02-10 07:02:12', 'john.doe@example.com', '2025-02-10 07:02:12', NULL, NULL, NULL),
(26, 9, 10, '2025-02-10 07:02:12', 'john.doe@example.com', '2025-02-10 07:02:12', NULL, NULL, NULL),
(27, 9, 13, '2025-02-10 07:02:12', 'john.doe@example.com', '2025-02-10 07:02:12', NULL, NULL, NULL),
(28, 9, 14, '2025-02-10 07:02:12', 'john.doe@example.com', '2025-02-10 07:02:12', NULL, NULL, NULL),
(29, 9, 15, '2025-02-10 07:02:12', 'john.doe@example.com', '2025-02-10 07:02:12', NULL, NULL, NULL),
(30, 9, 11, '2025-02-10 07:29:42', 'john.doe@example.com', '2025-02-10 07:29:42', NULL, NULL, NULL),
(31, 9, 15, '2025-02-10 07:44:05', 'john.doe@example.com', '2025-02-10 07:44:05', NULL, NULL, NULL),
(32, 6, 18, '2025-02-11 03:26:22', 'john.doe@example.com', '2025-02-11 03:26:22', NULL, NULL, NULL),
(33, 8, 20, '2025-02-19 06:04:33', 'john.doe@example.com', '2025-02-19 06:04:33', NULL, NULL, NULL),
(34, 8, 21, '2025-02-19 06:31:49', 'john.doe@example.com', '2025-02-19 06:31:49', NULL, NULL, NULL),
(35, 8, 22, '2025-02-19 07:44:46', 'john.doe@example.com', '2025-02-19 07:44:46', NULL, NULL, NULL),
(36, 8, 23, '2025-02-19 07:54:00', 'john.doe@example.com', '2025-02-19 07:54:00', NULL, NULL, NULL),
(37, 17, 18, '2025-04-02 09:13:22', 'john.doe@example.com', '2025-04-02 09:13:22', NULL, NULL, NULL),
(38, 17, 19, '2025-04-02 09:13:22', 'john.doe@example.com', '2025-04-02 09:13:22', NULL, NULL, NULL),
(39, 17, 22, '2025-04-02 09:13:22', 'john.doe@example.com', '2025-04-02 09:13:22', NULL, NULL, NULL),
(40, 18, 20, '2025-04-04 08:27:34', 'john.doe@example.com', '2025-04-04 08:27:34', NULL, NULL, NULL),
(41, 18, 9, '2025-04-04 08:27:34', 'john.doe@example.com', '2025-04-04 08:27:34', NULL, NULL, NULL),
(42, 18, 21, '2025-04-04 08:27:34', 'john.doe@example.com', '2025-04-04 08:27:34', NULL, NULL, NULL),
(43, 19, 17, '2025-04-14 18:39:52', 'john.doe@example.com', '2025-04-14 18:39:52', NULL, NULL, NULL),
(44, 19, 20, '2025-04-14 18:39:52', 'john.doe@example.com', '2025-04-14 18:39:52', NULL, NULL, NULL),
(45, 19, 21, '2025-04-14 18:39:52', 'john.doe@example.com', '2025-04-14 18:39:52', NULL, NULL, NULL),
(46, 19, 23, '2025-04-14 18:39:52', 'john.doe@example.com', '2025-04-14 18:39:52', NULL, NULL, NULL),
(47, 19, 24, '2025-04-14 18:39:52', 'john.doe@example.com', '2025-04-14 18:39:52', NULL, NULL, NULL),
(48, 19, 10, '2025-04-14 18:39:52', 'john.doe@example.com', '2025-04-14 18:39:52', NULL, NULL, NULL),
(49, 19, 15, '2025-04-14 18:39:52', 'john.doe@example.com', '2025-04-14 18:39:52', NULL, NULL, NULL),
(50, 19, 16, '2025-04-14 18:39:52', 'john.doe@example.com', '2025-04-14 18:39:52', NULL, NULL, NULL),
(51, 19, 18, '2025-04-15 00:27:11', 'john.doe@example.com', '2025-04-15 00:27:11', NULL, NULL, NULL),
(52, 19, 20, '2025-04-15 00:27:11', 'john.doe@example.com', '2025-04-15 00:27:11', NULL, NULL, NULL),
(53, 19, 9, '2025-04-15 00:27:11', 'john.doe@example.com', '2025-04-15 00:27:11', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_category`
--

CREATE TABLE `transaction_category` (
  `id` int NOT NULL,
  `transaction_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_default` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_category`
--

INSERT INTO `transaction_category` (`id`, `transaction_name`, `description`, `is_default`) VALUES
(1, 'Membership Fee', 'Payment for membership', 0),
(2, 'Capital Share', 'Payment for contribution', 0),
(3, 'Loan Repayment', 'Repayments for loans', 0),
(4, 'Miscellaneous', 'General service fees', 1),
(5, 'Initial Contribution', 'Payment for capital contribution', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE `transaction_types` (
  `id` int NOT NULL,
  `transaction_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_recurrent` tinyint(1) DEFAULT '0',
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `transaction_name`, `description`, `is_recurrent`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'membership_billing', 'Billing for Membership Fee', 0, 'sample@gmail.com', '2024-10-01 03:25:23', 'system', '2024-10-01 03:25:23', NULL, NULL),
(2, 'capital_contribution_billing', 'Billing for Capital Contribution', 0, 'sample@gmail.com', '2024-10-01 07:20:02', 'system', '2024-10-01 07:20:02', NULL, NULL),
(3, 'membership_payment', 'Payment for Membership Fee\r\n', 0, 'sample@gmail.com', '2024-10-01 23:49:23', NULL, '2024-10-01 23:49:23', NULL, NULL),
(4, 'membership_billing_debit', 'Billing for Membership fee', 0, 'sample@gmail.com', '2024-10-01 23:49:08', NULL, '2024-10-01 23:49:08', NULL, NULL),
(5, 'capital_contribution_payment', 'Payment for Capital Contribution', 0, 'sample@gmail.com', '2024-10-01 23:48:50', NULL, '2024-10-01 23:48:50', NULL, NULL),
(6, 'capital_contribution_initial_payment', 'partial payment for capital contribution', 0, 'sample@gmail.com', '2024-10-01 09:04:24', NULL, '2024-10-01 09:04:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types_cash_account`
--

CREATE TABLE `transaction_types_cash_account` (
  `id` int NOT NULL,
  `transaction_type_id` int NOT NULL,
  `cash_account_id` int NOT NULL,
  `account_type` enum('credit','debit') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_types_cash_account`
--

INSERT INTO `transaction_types_cash_account` (`id`, `transaction_type_id`, `cash_account_id`, `account_type`) VALUES
(1, 1, 5, 'credit'),
(2, 1, 6, 'credit'),
(3, 3, 1, 'debit'),
(4, 2, 7, NULL),
(5, 2, 4, NULL),
(6, 5, 1, NULL),
(7, 5, 7, NULL),
(10, 3, 5, 'debit');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int NOT NULL,
  `unit_name` varchar(255) DEFAULT NULL,
  `unit_head` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `department_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `unit_head`, `description`, `department_id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Petty Cash', 'Sample unit head', 'For disbursment ', 1, '2024-09-13 09:18:44', 'john.doe@example.com', '2024-09-13 09:18:44', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'inactive',
  `login_attempts` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `status`, `login_attempts`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Melmar', 'Azores', 'azoresmelmar@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'active', 0, '2024-05-20 21:21:32', 'azoresmelmar@gmail.com', '2024-11-12 05:40:43', 'azoresmelmar@gmail.com', NULL, NULL),
(2, 'John', 'Doe', 'john.doe@example.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'active', 0, '2024-05-20 21:21:32', 'john.doe@example.com', '2025-05-06 09:07:06', 'john.doe@example.com', NULL, NULL),
(3, 'Jane', 'Doe', 'jane@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'active', 0, '2024-05-20 21:21:32', 'john.doe@example.com', '2025-03-19 08:33:25', 'jane@gmail.com', NULL, NULL),
(5, 'Angela', 'Jolie', 'angela@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'active', 2, '2024-05-20 21:21:32', 'john.doe@example.com', '2025-04-23 07:52:42', 'angela@gmail.com', NULL, NULL),
(33, 'Sample', 'Cashier', 'sample@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'active', 0, '2024-05-20 21:21:32', 'john.doe@example.com', '2025-05-06 09:05:37', 'sample@gmail.com', NULL, NULL),
(44, 'Person', 'Data', 'person@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'active', 0, '2024-05-20 21:21:32', 'john.doe@example.com', '2025-02-11 02:40:09', 'person@gmail.com', NULL, NULL),
(76, 'Daniel', 'Padilla', 'danielPadilla@gmail.com', '$2y$10$s3DTJUhVEN1NC/jPNIIwkeaHEAK2jlyQMIJjNrGBujQcfKe/5zC4q', 'active', 0, '2025-02-11 03:02:24', 'danielPadilla@gmail.com', '2025-02-11 07:26:56', 'danielPadilla@gmail.com', NULL, NULL),
(77, 'Kathrina', 'Valdezco', 'kathrinavaldezco553@gmail.com', '$2y$10$r7SXTY8kPFC540YibwJi5uOgHdE4TMZiRzfljGd4VJWwQhaqYnzW6', 'active', 0, '2025-02-11 05:37:48', 'kathrinavaldezco553@gmail.com', '2025-04-23 08:24:05', 'kathrinavaldezco553@gmail.com', NULL, NULL),
(78, 'Jayson', 'Derulo', 'jd@gmail.com', '$2y$10$r42yVOm/XUGCua4BOxe/.uNrU4uF/kVigu2sPytSmh/WsOXgW8oji', 'active', 0, '2025-02-13 08:18:51', 'jd@gmail.com', '2025-02-14 01:22:52', 'jd@gmail.com', NULL, NULL),
(79, 'Dionela', 'Oksihina', 'Dayonela@gmail.com', '$2y$10$KSSV8UwqMsF3eVFI903FxejNqIvDjtkrx9j3KfhAF8W9twIdB6m5u', 'active', 0, '2025-02-14 01:24:05', 'Dayonela@gmail.com', '2025-03-03 08:50:04', 'dayonela@gmail.com', NULL, NULL),
(80, 'Ralph', 'Dumlao', 'rdumalo89@gmail.com', '$2y$10$ZdVaJHGCzXnM.52XGXE60.CMVzuwsn5nC/lKcNnVV0p3rUQBoUIQ.', 'active', 0, '2025-02-14 07:35:29', 'rdumalo89@gmail.com', '2025-02-17 04:43:49', 'rdumalo89@gmail.com', NULL, NULL),
(81, 'Anna', 'Marilag', 'annaMarilag@gmail.com', '$2y$10$cw/KZrHkI4ZZ.KnUVsNIhOQLeSA/P9ERSfuBDd3/dvINIcSdNI952', 'active', 0, '2025-02-17 08:08:17', 'annaMarilag@gmail.com', '2025-02-20 05:25:58', 'annaMarilag@gmail.com', NULL, NULL),
(82, '', '', 'kathrinavaldezco@gmail.com', '$2y$10$l5oJ/ycFF/s.Q0lOTgUiw.sJyELFYS0s2z9jfMs5iS3s4NC5lTsxO', 'active', 0, '2025-02-19 06:46:26', 'sysadmin', '2025-02-20 01:46:03', 'kathrinavaldezco@gmail.com', NULL, NULL),
(83, 'Claire', 'Buenaventura', 'claire_buenaventura@gmail.com', '$2y$10$WT1Fsi/plx9Wi9OMdQ7Ou.UvO44uBI3XLSprvbnB9vqI86WeTTtrK', 'inactive', 0, '2025-03-03 02:36:06', 'claire_buenaventura@gmail.com', '2025-03-03 02:36:06', NULL, NULL, NULL),
(84, 'Maja', 'Salvador', 'maja_salvador@gmail.com', '$2y$10$hb/ghQqNmW9jI/ZklxmaVOvWMUIycPQ2RAv5gKhio024qgUoMQTF2', 'active', 0, '2025-03-03 02:52:13', 'maja_salvador@gmail.com', '2025-03-06 03:47:24', 'maja_salvador@gmail.com', NULL, NULL),
(85, 'John ', 'Cena', 'john_cena@gmail.com', '$2y$10$HhkO.leE0s61QWxTsucgQeMkrbF8ZI.tJiK8HsZd4vx9KGBuvDYw.', 'active', 0, '2025-03-04 01:28:54', 'john_cena@gmail.com', '2025-03-06 05:13:32', 'john_cena@gmail.com', NULL, NULL),
(86, 'Erlinda', 'Montemayor', 'erlinda@gmail.com', '$2y$10$eK/IvO22Hyo3h8tqkEu5peK9iq40AsCmePEmapzm0enLX5OsXfagS', 'active', 0, '2025-03-05 07:26:53', 'erlinda@gmail.com', '2025-03-06 05:56:41', 'erlinda@gmail.com', NULL, NULL),
(87, 'Diane', ' Nguyen', 'dinae@gmail.com', '$2y$10$5Wb20h4Dih5Kg0YYGScaKeb6XLcLF18MBleI4qZzRhKJ.dMZOUKZC', 'active', 0, '2025-03-06 06:05:54', 'dinae@gmail.com', '2025-04-15 06:29:02', 'dinae@gmail.com', NULL, NULL),
(88, 'Bojack ', 'Horseman', 'bj@gmail.com', '$2y$10$lw0OGFIrlHtdZ1000bqrbOXW8vhsP4N64S0zcy9ZR4Rbz49aSj006', 'active', 0, '2025-03-11 06:27:25', 'bj@gmail.com', '2025-03-13 01:54:15', 'bj@gmail.com', NULL, NULL),
(89, 'Beatrice ', 'Horseman', 'bhorsman@gmail.com', '$2y$10$fjNrDAUsJZGDLKSebgZarOUTr2sIlcCFSUBx527g7c4ozEhz6Syti', 'active', 0, '2025-03-12 07:01:46', 'bhorsman@gmail.com', '2025-04-25 06:26:57', 'bhorsman@gmail.com', NULL, NULL),
(90, 'Jennifer', 'Miranda', 'jennifermiranda@gmail.com', '$2y$10$C1wX5LLpVH1zVEejaLyo0.Igu95pjoZeXjLCn/EjDAwOmhAFr1wHS', 'active', 0, '2025-03-13 01:55:38', 'jennifermiranda@gmail.com', '2025-03-13 01:56:18', 'jennifermiranda@gmail.com', NULL, NULL),
(91, 'Anna', 'Keiting', 'Ak@gmail.com', '$2y$10$fvAwN8EEU0CE0/ZvgXyOIe/7cHknz2wrUILY4cigKA0JaMYdmD6NO', 'active', 0, '2025-03-17 05:54:07', 'Ak@gmail.com', '2025-05-02 04:58:51', 'ak@gmail.com', NULL, NULL),
(92, 'Allyssa', 'Lorenzo', 'ally@gmail.com', '$2y$10$qiyr0vhk..ksvDZ9ly.inekEoSoMHRIHVUx9zmNiN1.KkdL8HkQx6', 'active', 0, '2025-03-19 06:44:29', 'ally@gmail.com', '2025-03-19 06:53:40', 'ally@gmail.com', NULL, NULL),
(93, 'Hev', 'Doe', 'hev@gmail.com', '$2y$10$J13GI6.KOxTEneJ07h8GH.WrulLC9Qn6UeytYluR83S2TO6c/HI0W', 'active', 0, '2025-03-20 07:50:20', 'hev@gmail.com', '2025-04-14 01:18:46', 'hev@gmail.com', NULL, NULL),
(112, 'Cleo ', 'Dongga-as', 'cbd-coop@gmail.com', '$2y$10$omPNygcrMIAlZ3auqG9k1.b/ICchDZWTTnEW4geR5WVr625Ip45P2', 'active', 0, '2025-04-14 18:35:36', 'cbd-coop@gmail.com', '2025-05-06 09:07:22', 'cbd-coop@gmail.com', NULL, NULL),
(114, 'Pamela', 'Ballesteros', 'pamelavivientballesteros@gmail.com', '$2y$10$6cF1BZzmIAzk8LwILrTNXeo3t.n2iwp41iwF1ShVWJlZUlHTqZ6pa', 'active', 0, '2025-04-15 07:15:30', 'pamelavivientballesteros@gmail.com', '2025-04-15 07:16:18', 'pamelavivientballesteros@gmail.com', NULL, NULL),
(115, 'Juana', 'Dela Cruz', 'jeremy23deguzman@gmail.com', '$2y$10$L6oHWPOxyxRYihy4KsLozO0ao8KTBb0LwQEnVCuoZONybgZmZ2MXm', 'active', 0, '2025-04-15 07:15:39', 'jeremy23deguzman@gmail.com', '2025-04-15 08:44:44', 'jeremy23deguzman@gmail.com', NULL, NULL),
(125, 'Kathrina', 'Valdezco', 'kathvaldezcoronquillo@gmail.com', '$2y$10$Uh7k/U7AIRE0HsYLIZqYyeEWyczopZ78e1XbjdhIAdNtUQviaq1cq', 'active', 0, '2025-04-23 08:01:30', 'kathvaldezcoronquillo@gmail.com', '2025-05-02 04:52:48', 'kathvaldezcoronquillo@gmail.com', NULL, NULL),
(129, 'test', 'test', 'gtest88@gmail.com', '$2y$10$iAsSJv1S8JIwUql/Mv5e4eMUOdQ4TOEUdCADR6.qaOTi34iQoSzwa', 'inactive', 0, '2025-04-25 06:36:21', 'gtest88@gmail.com', '2025-04-25 06:36:22', NULL, NULL, NULL),
(130, 'test', 'test', 'gtest8833@gmail.com', '$2y$10$uQkpesfqtYmrmgVPVYd4IeMc5J0FGWF9ENF2DL5TGL/4DnhqPA1z6', 'active', 0, '2025-04-25 06:38:33', 'gtest8833@gmail.com', '2025-05-05 08:24:25', 'gtest8833@gmail.com', NULL, NULL),
(131, 'test', 'test', 'kath123@gmail.com', '$2y$10$RgJhpq6LytlxLb9frhuKt.2W6aVMoEa/05/AuP2lq3JNJosz.Qy9i', 'inactive', 0, '2025-04-28 00:45:45', 'kath123@gmail.com', '2025-04-28 02:45:54', 'kath123@gmail.com', NULL, NULL),
(132, 'test-1', 'test-1', 'kath1234@mailinator.com', '$2y$10$buBtD7UbogHQRFqjSMlY3OzZp2u/UXsoYxoof3U1ym5AQ5Bzu9xXm', 'active', 0, '2025-04-28 02:46:23', 'kath1234@mailinator.com', '2025-05-06 05:18:31', 'kath1234@mailinator.com', NULL, NULL),
(139, 'Kathrina', 'Valdezco', 'kath-test@mailinator.com', '$2y$10$ZElkdI9b/dkA1DzQixCABuI6oKW.BVEgAEd7bAD.ZQ5RgCqa1eBnO', 'active', 0, '2025-05-05 08:41:05', 'kath-test@mailinator.com', '2025-05-06 04:04:01', 'kath-test@mailinator.com', NULL, NULL),
(140, 'Kathrina', 'Valdezco', 'kathtest@mailinator.com', '$2y$10$4WFxHc8oYGWSMSq6X9vhp.XYd3SducsqPXx7cE3zshipvTatb9/di', 'inactive', 0, '2025-05-06 04:39:13', 'kathtest@mailinator.com', '2025-05-06 04:39:13', NULL, NULL, NULL),
(141, 'Kathrina', 'Valdezco', 'kath123@mailinator.com', '$2y$10$Sed8m/YTdqPwQNxDWHVdM.o8S3JRlvvpn9fmxAQsHWh41QUy5zdQO', 'inactive', 0, '2025-05-06 04:44:28', 'kath123@mailinator.com', '2025-05-06 04:44:28', NULL, NULL, NULL),
(142, 'Kathrina', 'Valdezco', 'kathrina123456@mailinator.com', '$2y$10$t921SmO8zQIpy53ESqkoKOFuab4Nxp7.se6m3IUkqYtJQ5Lhv0MuO', 'active', 0, '2025-05-06 04:56:33', 'kathrina123456@mailinator.com', '2025-05-06 05:03:51', 'kathrina123456@mailinator.com', NULL, NULL),
(143, 'Kathrina', 'Valdezco', 'kathrina1234567@mailinator.com', '$2y$10$to12a/UxQLRvo7/EUqhyteU4PfiC4qgmIqaYpICcUTnpdEq8OWV9a', 'inactive', 0, '2025-05-06 05:08:52', 'kathrina1234567@mailinator.com', '2025-05-06 05:08:52', NULL, NULL, NULL),
(144, 'Kathrina', 'Valdezco', 'kath1234567@mailinator.com', '$2y$10$xd9QBzW8T2C/BDpeJpI9Ce2D8BWnHALZlSu1bUw36kcll17b8ReW2', 'active', 0, '2025-05-06 05:10:45', 'kath1234567@mailinator.com', '2025-05-06 05:17:01', 'kath1234567@mailinator.com', NULL, NULL),
(145, 'test', 'data', 'kath12345678@mailinator.com', '$2y$10$FUnr0ssAUYv8ToWYSkU6lO/jhtkpdRiphHtQukhIhAkVEg5ht5uQS', 'active', 0, '2025-05-06 05:26:32', 'kath12345678@mailinator.com', '2025-05-06 09:23:58', 'kath12345678@mailinator.com', NULL, NULL),
(146, 'test', 'data', 'lago-test@mailinator.com', '$2y$10$RHydkn/YNOBgyRv69VP07u4kkE6W2UDDwLxho7qpGSK.PRhyc8olu', 'inactive', 0, '2025-05-06 09:28:07', 'lago-test@mailinator.com', '2025-05-06 09:28:07', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `doc_size` varchar(255) NOT NULL,
  `doc_type` varchar(255) NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `doc_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_documents`
--

INSERT INTO `user_documents` (`id`, `user_id`, `document_type`, `doc_size`, `doc_type`, `doc_name`, `doc_path`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(5, 33, 'PMES Certificate', '5.17', 'jpg', '66c6f2c6032b0.jpg', '/uploads/M-2024-08-000000033/66c6f2c6032b0.jpg', '2024-08-22 08:11:49', 'sample@gmail.com', '2024-08-22 08:11:50', NULL, NULL, NULL),
(6, 33, 'Proof of Identity', '5.17', 'jpg', '66c6f2c605129.jpg', '/uploads/M-2024-08-000000033/66c6f2c605129.jpg', '2024-08-22 08:11:49', 'sample@gmail.com', '2024-08-22 08:11:50', NULL, NULL, NULL),
(7, 33, 'Proof of Date of Birth', '136.18', 'pdf', '66c6f2c609f7e.pdf', '/uploads/M-2024-08-000000033/66c6f2c609f7e.pdf', '2024-08-22 08:11:49', 'sample@gmail.com', '2024-08-22 08:11:50', NULL, NULL, NULL),
(8, 33, 'Proof of Address', '5.17', 'jpg', '66c6f2c60caba.jpg', '/uploads/M-2024-08-000000033/66c6f2c60caba.jpg', '2024-08-22 08:11:49', 'sample@gmail.com', '2024-08-22 08:11:50', NULL, NULL, NULL),
(9, 33, '2x2 ID Picture', '5.17', 'jpg', '66c6f2c611199.jpg', '/uploads/M-2024-08-000000033/66c6f2c611199.jpg', '2024-08-22 08:11:49', 'sample@gmail.com', '2024-08-22 08:11:50', NULL, NULL, NULL),
(10, 33, 'Membership Agreement Form', '136.18', 'pdf', '66c6f2c615a20.pdf', '/uploads/M-2024-08-000000033/66c6f2c615a20.pdf', '2024-08-22 08:11:49', 'sample@gmail.com', '2024-08-22 08:11:50', NULL, NULL, NULL),
(11, 33, 'Membership Fee Receipt', '5.17', 'jpg', '66c6f2c619a6c.jpg', '/uploads/M-2024-08-000000033/66c6f2c619a6c.jpg', '2024-08-22 08:11:49', 'sample@gmail.com', '2024-08-22 08:11:50', NULL, NULL, NULL),
(12, 33, 'Subscription Agreement Form', '136.18', 'pdf', '66c6f2c61cc2e.pdf', '/uploads/M-2024-08-000000033/66c6f2c61cc2e.pdf', '2024-08-22 08:11:49', 'sample@gmail.com', '2024-08-22 08:11:50', NULL, NULL, NULL),
(13, 33, 'Initial Capital Contribution Receipt', '5.17', 'jpg', '66c6f2c61e56f.jpg', '/uploads/M-2024-08-000000033/66c6f2c61e56f.jpg', '2024-08-22 08:11:49', 'sample@gmail.com', '2024-08-22 08:11:50', NULL, NULL, NULL),
(14, 33, 'PMES Certificate', '5.17', 'jpg', '66d802d2cd641.jpg', '/uploads/M-2024-09-000000033/66d802d2cd641.jpg', '2024-09-04 06:48:50', 'sample@gmail.com', '2024-09-04 06:48:50', NULL, NULL, NULL),
(15, 33, 'Proof of Identity', '5.17', 'jpg', '66d802d2d0cef.jpg', '/uploads/M-2024-09-000000033/66d802d2d0cef.jpg', '2024-09-04 06:48:50', 'sample@gmail.com', '2024-09-04 06:48:50', NULL, NULL, NULL),
(16, 33, 'Proof of Date of Birth', '5.17', 'jpg', '66d802d2d314f.jpg', '/uploads/M-2024-09-000000033/66d802d2d314f.jpg', '2024-09-04 06:48:50', 'sample@gmail.com', '2024-09-04 06:48:50', NULL, NULL, NULL),
(17, 33, 'Proof of Address', '5.17', 'jpg', '66d802d2d51db.jpg', '/uploads/M-2024-09-000000033/66d802d2d51db.jpg', '2024-09-04 06:48:50', 'sample@gmail.com', '2024-09-04 06:48:50', NULL, NULL, NULL),
(18, 33, '2x2 ID Picture', '5.17', 'jpg', '66d802d2d781a.jpg', '/uploads/M-2024-09-000000033/66d802d2d781a.jpg', '2024-09-04 06:48:50', 'sample@gmail.com', '2024-09-04 06:48:50', NULL, NULL, NULL),
(30, 5, 'PMES Certificate', '159.57', 'jpg', '67172f51ade22.jpg', '/uploads/M-2024-10-000000005/67172f51ade22.jpg', '2024-10-22 04:51:29', 'angela@gmail.com', '2024-10-22 04:51:29', NULL, NULL, NULL),
(31, 5, 'Proof of Identity', '5.17', 'jpg', '67172f51b11db.jpg', '/uploads/M-2024-10-000000005/67172f51b11db.jpg', '2024-10-22 04:51:29', 'angela@gmail.com', '2024-10-22 04:51:29', NULL, NULL, NULL),
(32, 5, 'Proof of Date of Birth', '53.41', 'pdf', '67172f51b3c15.pdf', '/uploads/M-2024-10-000000005/67172f51b3c15.pdf', '2024-10-22 04:51:29', 'angela@gmail.com', '2024-10-22 04:51:29', NULL, NULL, NULL),
(33, 5, 'Proof of Address', '5.17', 'jpg', '67172f51b5858.jpg', '/uploads/M-2024-10-000000005/67172f51b5858.jpg', '2024-10-22 04:51:29', 'angela@gmail.com', '2024-10-22 04:51:29', NULL, NULL, NULL),
(34, 5, '2x2 ID Picture', '5.17', 'jpg', '67172f51b7ea3.jpg', '/uploads/M-2024-10-000000005/67172f51b7ea3.jpg', '2024-10-22 04:51:29', 'angela@gmail.com', '2024-10-22 04:51:29', NULL, NULL, NULL),
(39, 5, 'PMES Certificate', '159.57', 'jpg', '6717339e4a2c0.jpg', '/uploads/M-2024-10-000000005/6717339e4a2c0.jpg', '2024-10-22 05:09:50', 'angela@gmail.com', '2024-10-22 05:09:50', NULL, NULL, NULL),
(40, 5, 'Proof of Identity', '5.17', 'jpg', '6717339e4ec24.jpg', '/uploads/M-2024-10-000000005/6717339e4ec24.jpg', '2024-10-22 05:09:50', 'angela@gmail.com', '2024-10-22 05:09:50', NULL, NULL, NULL),
(41, 5, 'Proof of Date of Birth', '565.84', 'pdf', '6717339e5189c.pdf', '/uploads/M-2024-10-000000005/6717339e5189c.pdf', '2024-10-22 05:09:50', 'angela@gmail.com', '2024-10-22 05:09:50', NULL, NULL, NULL),
(42, 5, 'Proof of Address', '5.17', 'jpg', '6717339e542fd.jpg', '/uploads/M-2024-10-000000005/6717339e542fd.jpg', '2024-10-22 05:09:50', 'angela@gmail.com', '2024-10-22 05:09:50', NULL, NULL, NULL),
(43, 5, '2x2 ID Picture', '5.17', 'jpg', '6717339e571f9.jpg', '/uploads/M-2024-10-000000005/6717339e571f9.jpg', '2024-10-22 05:09:50', 'angela@gmail.com', '2024-10-22 05:09:50', NULL, NULL, NULL),
(44, 5, 'PMES Certificate', '159.57', 'jpg', '671734ef724c1.jpg', '/uploads/M-2024-10-000000005/671734ef724c1.jpg', '2024-10-22 05:15:27', 'angela@gmail.com', '2024-10-22 05:15:27', NULL, NULL, NULL),
(45, 5, 'Proof of Identity', '5.17', 'jpg', '671734ef7681b.jpg', '/uploads/M-2024-10-000000005/671734ef7681b.jpg', '2024-10-22 05:15:27', 'angela@gmail.com', '2024-10-22 05:15:27', NULL, NULL, NULL),
(46, 5, 'Proof of Date of Birth', '565.84', 'pdf', '671734ef78e78.pdf', '/uploads/M-2024-10-000000005/671734ef78e78.pdf', '2024-10-22 05:15:27', 'angela@gmail.com', '2024-10-22 05:15:27', NULL, NULL, NULL),
(47, 5, 'Proof of Address', '5.17', 'jpg', '671734ef7a6fe.jpg', '/uploads/M-2024-10-000000005/671734ef7a6fe.jpg', '2024-10-22 05:15:27', 'angela@gmail.com', '2024-10-22 05:15:27', NULL, NULL, NULL),
(48, 5, '2x2 ID Picture', '5.17', 'jpg', '671734ef7c2be.jpg', '/uploads/M-2024-10-000000005/671734ef7c2be.jpg', '2024-10-22 05:15:27', 'angela@gmail.com', '2024-10-22 05:15:27', NULL, NULL, NULL),
(49, 1, 'PMES Certificate', '159.57', 'jpg', '67173a0f0bcad.jpg', '/uploads/M-2024-10-000000001/67173a0f0bcad.jpg', '2024-10-22 05:37:18', 'azoresmelmar@gmail.com', '2024-10-22 05:37:19', NULL, NULL, NULL),
(50, 1, 'Proof of Identity', '5.17', 'jpg', '67173a0f104ef.jpg', '/uploads/M-2024-10-000000001/67173a0f104ef.jpg', '2024-10-22 05:37:18', 'azoresmelmar@gmail.com', '2024-10-22 05:37:19', NULL, NULL, NULL),
(51, 1, 'Proof of Date of Birth', '565.84', 'pdf', '67173a0f134e8.pdf', '/uploads/M-2024-10-000000001/67173a0f134e8.pdf', '2024-10-22 05:37:18', 'azoresmelmar@gmail.com', '2024-10-22 05:37:19', NULL, NULL, NULL),
(52, 1, 'Proof of Address', '5.17', 'jpg', '67173a0f17e80.jpg', '/uploads/M-2024-10-000000001/67173a0f17e80.jpg', '2024-10-22 05:37:18', 'azoresmelmar@gmail.com', '2024-10-22 05:37:19', NULL, NULL, NULL),
(53, 1, '2x2 ID Picture', '5.17', 'jpg', '67173a0f1ae2e.jpg', '/uploads/M-2024-10-000000001/67173a0f1ae2e.jpg', '2024-10-22 05:37:18', 'azoresmelmar@gmail.com', '2024-10-22 05:37:19', NULL, NULL, NULL),
(54, 3, 'PMES Certificate', '159.57', 'jpg', '671f027ebd5fc.jpg', '/uploads/M-2024-10-000000003/671f027ebd5fc.jpg', '2024-10-28 03:18:22', 'jane@gmail.com', '2024-10-28 03:18:22', NULL, NULL, NULL),
(55, 3, 'Proof of Identity', '5.17', 'jpg', '671f027ec14b1.jpg', '/uploads/M-2024-10-000000003/671f027ec14b1.jpg', '2024-10-28 03:18:22', 'jane@gmail.com', '2024-10-28 03:18:22', NULL, NULL, NULL),
(56, 3, 'Proof of Date of Birth', '2503.54', 'pdf', '671f027ec6ce8.pdf', '/uploads/M-2024-10-000000003/671f027ec6ce8.pdf', '2024-10-28 03:18:22', 'jane@gmail.com', '2024-10-28 03:18:22', NULL, NULL, NULL),
(57, 3, 'Proof of Address', '565.84', 'pdf', '671f027ecadcf.pdf', '/uploads/M-2024-10-000000003/671f027ecadcf.pdf', '2024-10-28 03:18:22', 'jane@gmail.com', '2024-10-28 03:18:22', NULL, NULL, NULL),
(58, 3, '2x2 ID Picture', '5.17', 'jpg', '671f027ecd886.jpg', '/uploads/M-2024-10-000000003/671f027ecd886.jpg', '2024-10-28 03:18:22', 'jane@gmail.com', '2024-10-28 03:18:22', NULL, NULL, NULL),
(82, 3, 'PMES Certificate', '26.32', 'pdf', '6736d7d026be6.pdf', '/uploads/M-2024-11-000000003/6736d7d026be6.pdf', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(83, 3, 'Proof of Identity', '5.17', 'jpg', '6736d7d02834a.jpg', '/uploads/M-2024-11-000000003/6736d7d02834a.jpg', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(84, 3, 'Proof of Date of Birth', '26.32', 'pdf', '6736d7d02a264.pdf', '/uploads/M-2024-11-000000003/6736d7d02a264.pdf', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(85, 3, 'Proof of Address', '55.31', 'pdf', '6736d7d02b839.pdf', '/uploads/M-2024-11-000000003/6736d7d02b839.pdf', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(86, 3, '2x2 ID Picture', '5.17', 'jpg', '6736d7d02d4e6.jpg', '/uploads/M-2024-11-000000003/6736d7d02d4e6.jpg', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(95, 44, 'PMES Certificate', '17.87', 'pdf', '673e88d405431.pdf', '/uploads/M-2024-11-000000044/673e88d405431.pdf', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
(96, 44, 'Proof of Identity', '5.17', 'jpg', '673e88d407d77.jpg', '/uploads/M-2024-11-000000044/673e88d407d77.jpg', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
(97, 44, 'Proof of Date of Birth', '14.96', 'pdf', '673e88d40a77f.pdf', '/uploads/M-2024-11-000000044/673e88d40a77f.pdf', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
(98, 44, 'Proof of Address', '17.87', 'pdf', '673e88d40c7dc.pdf', '/uploads/M-2024-11-000000044/673e88d40c7dc.pdf', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
(99, 44, '2x2 ID Picture', '5.17', 'jpg', '673e88d40e94b.jpg', '/uploads/M-2024-11-000000044/673e88d40e94b.jpg', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
(158, 76, 'PMES Certificate', '5.17', 'jpg', '67aac0fe38973.jpg', '/uploads/M-2025-02-000000076/67aac0fe38973.jpg', '2025-02-11 03:16:14', 'danielPadilla@gmail.com', '2025-02-11 03:16:14', NULL, NULL, NULL),
(159, 76, 'Proof of Identity', '5.17', 'jpg', '67aac0fe3a080.jpg', '/uploads/M-2025-02-000000076/67aac0fe3a080.jpg', '2025-02-11 03:16:14', 'danielPadilla@gmail.com', '2025-02-11 03:16:14', NULL, NULL, NULL),
(160, 76, 'Proof of Date of Birth', '5.17', 'jpg', '67aac0fe3b4ce.jpg', '/uploads/M-2025-02-000000076/67aac0fe3b4ce.jpg', '2025-02-11 03:16:14', 'danielPadilla@gmail.com', '2025-02-11 03:16:14', NULL, NULL, NULL),
(161, 76, 'Proof of Address', '154.81', 'pdf', '67aac0fe3fd28.pdf', '/uploads/M-2025-02-000000076/67aac0fe3fd28.pdf', '2025-02-11 03:16:14', 'danielPadilla@gmail.com', '2025-02-11 03:16:14', NULL, NULL, NULL),
(162, 76, '2x2 ID Picture', '5.17', 'jpg', '67aac0fe41c12.jpg', '/uploads/M-2025-02-000000076/67aac0fe41c12.jpg', '2025-02-11 03:16:14', 'danielPadilla@gmail.com', '2025-02-11 03:16:14', NULL, NULL, NULL),
(163, 77, 'PMES Certificate', '5.17', 'jpg', '67aafcc850177.jpg', '/uploads/M-2025-02-000000077/67aafcc850177.jpg', '2025-02-11 07:31:20', 'kathrinavaldezco553@gmail.com', '2025-02-11 07:31:20', NULL, NULL, NULL),
(164, 77, 'Proof of Identity', '5.17', 'jpg', '67aafcc85235e.jpg', '/uploads/M-2025-02-000000077/67aafcc85235e.jpg', '2025-02-11 07:31:20', 'kathrinavaldezco553@gmail.com', '2025-02-11 07:31:20', NULL, NULL, NULL),
(165, 77, 'Proof of Date of Birth', '5.17', 'jpg', '67aafcc854219.jpg', '/uploads/M-2025-02-000000077/67aafcc854219.jpg', '2025-02-11 07:31:20', 'kathrinavaldezco553@gmail.com', '2025-02-11 07:31:20', NULL, NULL, NULL),
(166, 77, 'Proof of Address', '133.64', 'pdf', '67aafcc856455.pdf', '/uploads/M-2025-02-000000077/67aafcc856455.pdf', '2025-02-11 07:31:20', 'kathrinavaldezco553@gmail.com', '2025-02-11 07:31:20', NULL, NULL, NULL),
(167, 77, '2x2 ID Picture', '5.17', 'jpg', '67aafcc857f44.jpg', '/uploads/M-2025-02-000000077/67aafcc857f44.jpg', '2025-02-11 07:31:20', 'kathrinavaldezco553@gmail.com', '2025-02-11 07:31:20', NULL, NULL, NULL),
(178, 78, 'PMES Certificate', '159.57', 'jpg', '67adb120c85b9.jpg', '/uploads/M-2025-02-000000078/67adb120c85b9.jpg', '2025-02-13 08:45:20', 'jd@gmail.com', '2025-02-13 08:45:20', NULL, NULL, NULL),
(179, 78, 'Proof of Identity', '5.17', 'jpg', '67adb120ca6ff.jpg', '/uploads/M-2025-02-000000078/67adb120ca6ff.jpg', '2025-02-13 08:45:20', 'jd@gmail.com', '2025-02-13 08:45:20', NULL, NULL, NULL),
(180, 78, 'Proof of Date of Birth', '154.81', 'pdf', '67adb120cd0a2.pdf', '/uploads/M-2025-02-000000078/67adb120cd0a2.pdf', '2025-02-13 08:45:20', 'jd@gmail.com', '2025-02-13 08:45:20', NULL, NULL, NULL),
(181, 78, 'Proof of Address', '133.9', 'pdf', '67adb120ceb84.pdf', '/uploads/M-2025-02-000000078/67adb120ceb84.pdf', '2025-02-13 08:45:20', 'jd@gmail.com', '2025-02-13 08:45:20', NULL, NULL, NULL),
(182, 78, '2x2 ID Picture', '5.17', 'jpg', '67adb120d038f.jpg', '/uploads/M-2025-02-000000078/67adb120d038f.jpg', '2025-02-13 08:45:20', 'jd@gmail.com', '2025-02-13 08:45:20', NULL, NULL, NULL),
(183, 79, 'PMES Certificate', '5.17', 'jpg', '67ae9c4104fa9.jpg', '/uploads/M-2025-02-000000079/67ae9c4104fa9.jpg', '2025-02-14 01:28:32', 'Dayonela@gmail.com', '2025-02-14 01:28:33', NULL, NULL, NULL),
(184, 79, 'Proof of Identity', '159.57', 'jpg', '67ae9c410795b.jpg', '/uploads/M-2025-02-000000079/67ae9c410795b.jpg', '2025-02-14 01:28:32', 'Dayonela@gmail.com', '2025-02-14 01:28:33', NULL, NULL, NULL),
(185, 79, 'Proof of Date of Birth', '159.57', 'jpg', '67ae9c410a02a.jpg', '/uploads/M-2025-02-000000079/67ae9c410a02a.jpg', '2025-02-14 01:28:32', 'Dayonela@gmail.com', '2025-02-14 01:28:33', NULL, NULL, NULL),
(186, 79, 'Proof of Address', '154.81', 'pdf', '67ae9c410c93f.pdf', '/uploads/M-2025-02-000000079/67ae9c410c93f.pdf', '2025-02-14 01:28:32', 'Dayonela@gmail.com', '2025-02-14 01:28:33', NULL, NULL, NULL),
(187, 79, '2x2 ID Picture', '5.17', 'jpg', '67ae9c410e4d0.jpg', '/uploads/M-2025-02-000000079/67ae9c410e4d0.jpg', '2025-02-14 01:28:32', 'Dayonela@gmail.com', '2025-02-14 01:28:33', NULL, NULL, NULL),
(188, 80, 'PMES Certificate', '5.17', 'jpg', '67aef38dce1d3.jpg', '/uploads/M-2025-02-000000080/67aef38dce1d3.jpg', '2025-02-14 07:41:01', 'rdumalo89@gmail.com', '2025-02-14 07:41:01', NULL, NULL, NULL),
(189, 80, 'Proof of Identity', '5.17', 'jpg', '67aef38dd059d.jpg', '/uploads/M-2025-02-000000080/67aef38dd059d.jpg', '2025-02-14 07:41:01', 'rdumalo89@gmail.com', '2025-02-14 07:41:01', NULL, NULL, NULL),
(190, 80, 'Proof of Date of Birth', '5.17', 'jpg', '67aef38dd3326.jpg', '/uploads/M-2025-02-000000080/67aef38dd3326.jpg', '2025-02-14 07:41:01', 'rdumalo89@gmail.com', '2025-02-14 07:41:01', NULL, NULL, NULL),
(191, 80, 'Proof of Address', '133.9', 'pdf', '67aef38dd6710.pdf', '/uploads/M-2025-02-000000080/67aef38dd6710.pdf', '2025-02-14 07:41:01', 'rdumalo89@gmail.com', '2025-02-14 07:41:01', NULL, NULL, NULL),
(192, 80, '2x2 ID Picture', '5.17', 'jpg', '67aef38dd84bc.jpg', '/uploads/M-2025-02-000000080/67aef38dd84bc.jpg', '2025-02-14 07:41:01', 'rdumalo89@gmail.com', '2025-02-14 07:41:01', NULL, NULL, NULL),
(193, 84, 'PMES Certificate', '177.95', 'pdf', '67c56ea386e5a.pdf', '/uploads/M-2025-03-000000084/67c56ea386e5a.pdf', '2025-03-03 08:56:03', 'maja_salvador@gmail.com', '2025-03-03 08:56:03', NULL, NULL, NULL),
(194, 84, 'Proof of Identity', '194.69', 'jpg', '67c56ea389506.jpg', '/uploads/M-2025-03-000000084/67c56ea389506.jpg', '2025-03-03 08:56:03', 'maja_salvador@gmail.com', '2025-03-03 08:56:03', NULL, NULL, NULL),
(195, 84, 'Proof of Date of Birth', '177.95', 'pdf', '67c56ea38b6d0.pdf', '/uploads/M-2025-03-000000084/67c56ea38b6d0.pdf', '2025-03-03 08:56:03', 'maja_salvador@gmail.com', '2025-03-03 08:56:03', NULL, NULL, NULL),
(196, 84, 'Proof of Address', '177.95', 'pdf', '67c56ea38da11.pdf', '/uploads/M-2025-03-000000084/67c56ea38da11.pdf', '2025-03-03 08:56:03', 'maja_salvador@gmail.com', '2025-03-03 08:56:03', NULL, NULL, NULL),
(197, 84, '2x2 ID Picture', '194.69', 'jpg', '67c56ea38fd37.jpg', '/uploads/M-2025-03-000000084/67c56ea38fd37.jpg', '2025-03-03 08:56:03', 'maja_salvador@gmail.com', '2025-03-03 08:56:03', NULL, NULL, NULL),
(198, 85, 'PMES Certificate', '177.95', 'pdf', '67c7b5316eb45.pdf', '/uploads/M-2025-03-000000085/67c7b5316eb45.pdf', '2025-03-05 02:21:37', 'john_cena@gmail.com', '2025-03-05 02:21:37', NULL, NULL, NULL),
(199, 85, 'Proof of Identity', '231.32', 'jpg', '67c7b53170237.jpg', '/uploads/M-2025-03-000000085/67c7b53170237.jpg', '2025-03-05 02:21:37', 'john_cena@gmail.com', '2025-03-05 02:21:37', NULL, NULL, NULL),
(200, 85, 'Proof of Date of Birth', '177.95', 'pdf', '67c7b53171dbc.pdf', '/uploads/M-2025-03-000000085/67c7b53171dbc.pdf', '2025-03-05 02:21:37', 'john_cena@gmail.com', '2025-03-05 02:21:37', NULL, NULL, NULL),
(201, 85, 'Proof of Address', '177.95', 'pdf', '67c7b5317319e.pdf', '/uploads/M-2025-03-000000085/67c7b5317319e.pdf', '2025-03-05 02:21:37', 'john_cena@gmail.com', '2025-03-05 02:21:37', NULL, NULL, NULL),
(202, 85, '2x2 ID Picture', '240.53', 'jpg', '67c7b53174788.jpg', '/uploads/M-2025-03-000000085/67c7b53174788.jpg', '2025-03-05 02:21:37', 'john_cena@gmail.com', '2025-03-05 02:21:37', NULL, NULL, NULL),
(203, 86, 'PMES Certificate', '177.95', 'pdf', '67c7fe37b2de8.pdf', '/uploads/M-2025-03-000000086/67c7fe37b2de8.pdf', '2025-03-05 07:33:11', 'erlinda@gmail.com', '2025-03-05 07:33:11', NULL, NULL, NULL),
(204, 86, 'Proof of Identity', '87.98', 'jpg', '67c7fe37b4064.jpg', '/uploads/M-2025-03-000000086/67c7fe37b4064.jpg', '2025-03-05 07:33:11', 'erlinda@gmail.com', '2025-03-05 07:33:11', NULL, NULL, NULL),
(205, 86, 'Proof of Date of Birth', '177.95', 'pdf', '67c7fe37b5213.pdf', '/uploads/M-2025-03-000000086/67c7fe37b5213.pdf', '2025-03-05 07:33:11', 'erlinda@gmail.com', '2025-03-05 07:33:11', NULL, NULL, NULL),
(206, 86, 'Proof of Address', '177.95', 'pdf', '67c7fe37b6924.pdf', '/uploads/M-2025-03-000000086/67c7fe37b6924.pdf', '2025-03-05 07:33:11', 'erlinda@gmail.com', '2025-03-05 07:33:11', NULL, NULL, NULL),
(207, 86, '2x2 ID Picture', '87.98', 'jpg', '67c7fe37b75cc.jpg', '/uploads/M-2025-03-000000086/67c7fe37b75cc.jpg', '2025-03-05 07:33:11', 'erlinda@gmail.com', '2025-03-05 07:33:11', NULL, NULL, NULL),
(208, 87, 'PMES Certificate', '177.95', 'pdf', '67c93bec3c0b9.pdf', '/uploads/M-2025-03-000000087/67c93bec3c0b9.pdf', '2025-03-06 06:08:44', 'dinae@gmail.com', '2025-03-06 06:08:44', NULL, NULL, NULL),
(209, 87, 'Proof of Identity', '87.98', 'jpg', '67c93bec3d2c0.jpg', '/uploads/M-2025-03-000000087/67c93bec3d2c0.jpg', '2025-03-06 06:08:44', 'dinae@gmail.com', '2025-03-06 06:08:44', NULL, NULL, NULL),
(210, 87, 'Proof of Date of Birth', '177.95', 'pdf', '67c93bec3e3c1.pdf', '/uploads/M-2025-03-000000087/67c93bec3e3c1.pdf', '2025-03-06 06:08:44', 'dinae@gmail.com', '2025-03-06 06:08:44', NULL, NULL, NULL),
(211, 87, 'Proof of Address', '177.95', 'pdf', '67c93bec3f389.pdf', '/uploads/M-2025-03-000000087/67c93bec3f389.pdf', '2025-03-06 06:08:44', 'dinae@gmail.com', '2025-03-06 06:08:44', NULL, NULL, NULL),
(212, 87, '2x2 ID Picture', '194.69', 'jpg', '67c93bec40478.jpg', '/uploads/M-2025-03-000000087/67c93bec40478.jpg', '2025-03-06 06:08:44', 'dinae@gmail.com', '2025-03-06 06:08:44', NULL, NULL, NULL),
(213, 88, 'PMES Certificate', '177.95', 'pdf', '67cfd8ad18ead.pdf', '/uploads/M-2025-03-000000088/67cfd8ad18ead.pdf', '2025-03-11 06:31:08', 'bj@gmail.com', '2025-03-11 06:31:09', NULL, NULL, NULL),
(214, 88, 'Proof of Identity', '194.69', 'jpg', '67cfd8ad1fd1d.jpg', '/uploads/M-2025-03-000000088/67cfd8ad1fd1d.jpg', '2025-03-11 06:31:08', 'bj@gmail.com', '2025-03-11 06:31:09', NULL, NULL, NULL),
(215, 88, 'Proof of Date of Birth', '177.95', 'pdf', '67cfd8ad2242a.pdf', '/uploads/M-2025-03-000000088/67cfd8ad2242a.pdf', '2025-03-11 06:31:08', 'bj@gmail.com', '2025-03-11 06:31:09', NULL, NULL, NULL),
(216, 88, 'Proof of Address', '177.95', 'pdf', '67cfd8ad2369c.pdf', '/uploads/M-2025-03-000000088/67cfd8ad2369c.pdf', '2025-03-11 06:31:08', 'bj@gmail.com', '2025-03-11 06:31:09', NULL, NULL, NULL),
(217, 88, '2x2 ID Picture', '24.31', 'jpg', '67cfd8ad24e38.jpg', '/uploads/M-2025-03-000000088/67cfd8ad24e38.jpg', '2025-03-11 06:31:08', 'bj@gmail.com', '2025-03-11 06:31:09', NULL, NULL, NULL),
(218, 89, 'PMES Certificate', '177.95', 'pdf', '67d22a63c9499.pdf', '/uploads/M-2025-03-000000089/67d22a63c9499.pdf', '2025-03-13 00:44:19', 'bhorsman@gmail.com', '2025-03-13 00:44:19', NULL, NULL, NULL),
(219, 89, 'Proof of Identity', '194.69', 'jpg', '67d22a63cb1af.jpg', '/uploads/M-2025-03-000000089/67d22a63cb1af.jpg', '2025-03-13 00:44:19', 'bhorsman@gmail.com', '2025-03-13 00:44:19', NULL, NULL, NULL),
(220, 89, 'Proof of Date of Birth', '243.94', 'jpg', '67d22a63cd727.jpg', '/uploads/M-2025-03-000000089/67d22a63cd727.jpg', '2025-03-13 00:44:19', 'bhorsman@gmail.com', '2025-03-13 00:44:19', NULL, NULL, NULL),
(221, 89, 'Proof of Address', '177.95', 'pdf', '67d22a63cfba7.pdf', '/uploads/M-2025-03-000000089/67d22a63cfba7.pdf', '2025-03-13 00:44:19', 'bhorsman@gmail.com', '2025-03-13 00:44:19', NULL, NULL, NULL),
(222, 89, '2x2 ID Picture', '333.06', 'jpg', '67d22a63d1505.jpg', '/uploads/M-2025-03-000000089/67d22a63d1505.jpg', '2025-03-13 00:44:19', 'bhorsman@gmail.com', '2025-03-13 00:44:19', NULL, NULL, NULL),
(223, 91, 'PMES Certificate', '177.95', 'pdf', '67d7b9f385d36.pdf', '/uploads/M-2025-03-000000091/67d7b9f385d36.pdf', '2025-03-17 05:58:11', 'Ak@gmail.com', '2025-03-17 05:58:11', NULL, NULL, NULL),
(224, 91, 'Proof of Identity', '395.96', 'jpg', '67d7b9f387de8.jpg', '/uploads/M-2025-03-000000091/67d7b9f387de8.jpg', '2025-03-17 05:58:11', 'Ak@gmail.com', '2025-03-17 05:58:11', NULL, NULL, NULL),
(225, 91, 'Proof of Date of Birth', '177.95', 'pdf', '67d7b9f389882.pdf', '/uploads/M-2025-03-000000091/67d7b9f389882.pdf', '2025-03-17 05:58:11', 'Ak@gmail.com', '2025-03-17 05:58:11', NULL, NULL, NULL),
(226, 91, 'Proof of Address', '177.95', 'pdf', '67d7b9f38bc5c.pdf', '/uploads/M-2025-03-000000091/67d7b9f38bc5c.pdf', '2025-03-17 05:58:11', 'Ak@gmail.com', '2025-03-17 05:58:11', NULL, NULL, NULL),
(227, 91, '2x2 ID Picture', '333.06', 'jpg', '67d7b9f38e55c.jpg', '/uploads/M-2025-03-000000091/67d7b9f38e55c.jpg', '2025-03-17 05:58:11', 'Ak@gmail.com', '2025-03-17 05:58:11', NULL, NULL, NULL),
(228, 93, 'PMES Certificate', '462.37', 'pdf', '67dbc98416570.pdf', '/uploads/M-2025-03-000000093/67dbc98416570.pdf', '2025-03-20 07:53:39', 'hev@gmail.com', '2025-03-20 07:53:40', NULL, NULL, NULL),
(229, 93, 'Proof of Identity', '194.69', 'jpg', '67dbc98418749.jpg', '/uploads/M-2025-03-000000093/67dbc98418749.jpg', '2025-03-20 07:53:39', 'hev@gmail.com', '2025-03-20 07:53:40', NULL, NULL, NULL),
(230, 93, 'Proof of Date of Birth', '462.37', 'pdf', '67dbc9841affc.pdf', '/uploads/M-2025-03-000000093/67dbc9841affc.pdf', '2025-03-20 07:53:39', 'hev@gmail.com', '2025-03-20 07:53:40', NULL, NULL, NULL),
(231, 93, 'Proof of Address', '462.37', 'pdf', '67dbc9841d222.pdf', '/uploads/M-2025-03-000000093/67dbc9841d222.pdf', '2025-03-20 07:53:39', 'hev@gmail.com', '2025-03-20 07:53:40', NULL, NULL, NULL),
(232, 93, '2x2 ID Picture', '194.69', 'jpg', '67dbc9841f3f8.jpg', '/uploads/M-2025-03-000000093/67dbc9841f3f8.jpg', '2025-03-20 07:53:39', 'hev@gmail.com', '2025-03-20 07:53:40', NULL, NULL, NULL),
(233, 111, 'PMES Certificate', '194.69', 'jpg', '67fda5660d507.jpg', '/uploads/M-2025-04-000000111/67fda5660d507.jpg', '2025-04-15 00:16:37', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 00:16:38', NULL, NULL, NULL),
(234, 111, 'Proof of Identity', '194.69', 'jpg', '67fda5661331d.jpg', '/uploads/M-2025-04-000000111/67fda5661331d.jpg', '2025-04-15 00:16:37', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 00:16:38', NULL, NULL, NULL),
(235, 111, 'Proof of Date of Birth', '462.37', 'pdf', '67fda56617328.pdf', '/uploads/M-2025-04-000000111/67fda56617328.pdf', '2025-04-15 00:16:37', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 00:16:38', NULL, NULL, NULL),
(236, 111, 'Proof of Address', '462.37', 'pdf', '67fda5661b1c2.pdf', '/uploads/M-2025-04-000000111/67fda5661b1c2.pdf', '2025-04-15 00:16:37', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 00:16:38', NULL, NULL, NULL),
(237, 111, '2x2 ID Picture', '194.69', 'jpg', '67fda5661ebe5.jpg', '/uploads/M-2025-04-000000111/67fda5661ebe5.jpg', '2025-04-15 00:16:37', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 00:16:38', NULL, NULL, NULL),
(238, 113, 'PMES Certificate', '159.57', 'jpg', '67fdf267a3bc6.jpg', '/uploads/M-2025-04-000000113/67fdf267a3bc6.jpg', '2025-04-15 05:45:11', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 05:45:11', NULL, NULL, NULL),
(239, 113, 'Proof of Identity', '194.69', 'jpg', '67fdf267a697f.jpg', '/uploads/M-2025-04-000000113/67fdf267a697f.jpg', '2025-04-15 05:45:11', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 05:45:11', NULL, NULL, NULL),
(240, 113, 'Proof of Date of Birth', '194.69', 'jpg', '67fdf267a888a.jpg', '/uploads/M-2025-04-000000113/67fdf267a888a.jpg', '2025-04-15 05:45:11', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 05:45:11', NULL, NULL, NULL),
(241, 113, 'Proof of Address', '138.39', 'pdf', '67fdf267aab80.pdf', '/uploads/M-2025-04-000000113/67fdf267aab80.pdf', '2025-04-15 05:45:11', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 05:45:11', NULL, NULL, NULL),
(242, 113, '2x2 ID Picture', '5.17', 'jpg', '67fdf267ac39e.jpg', '/uploads/M-2025-04-000000113/67fdf267ac39e.jpg', '2025-04-15 05:45:11', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 05:45:11', NULL, NULL, NULL),
(245, 113, 'PMES Certificate', '159.57', 'jpg', '67fe021515f14.jpg', '/uploads/M-2025-04-000000113/67fe021515f14.jpg', '2025-04-15 06:52:04', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 06:52:05', NULL, NULL, NULL),
(246, 113, 'Proof of Identity', '59.17', 'jpg', '67fe02151a1a3.jpg', '/uploads/M-2025-04-000000113/67fe02151a1a3.jpg', '2025-04-15 06:52:04', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 06:52:05', NULL, NULL, NULL),
(247, 113, 'Proof of Date of Birth', '177.95', 'pdf', '67fe02151d05f.pdf', '/uploads/M-2025-04-000000113/67fe02151d05f.pdf', '2025-04-15 06:52:04', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 06:52:05', NULL, NULL, NULL),
(248, 113, 'Proof of Address', '334.27', 'pdf', '67fe02152030f.pdf', '/uploads/M-2025-04-000000113/67fe02152030f.pdf', '2025-04-15 06:52:04', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 06:52:05', NULL, NULL, NULL),
(249, 113, '2x2 ID Picture', '29.81', 'jpg', '67fe021521fed.jpg', '/uploads/M-2025-04-000000113/67fe021521fed.jpg', '2025-04-15 06:52:04', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 06:52:05', NULL, NULL, NULL),
(252, 114, 'PMES Certificate', '159.57', 'jpg', '67fe0a2e2cf2d.jpg', '/uploads/M-2025-04-000000114/67fe0a2e2cf2d.jpg', '2025-04-15 07:26:38', 'pamelavivientballesteros@gmail.com', '2025-04-15 07:26:38', NULL, NULL, NULL),
(253, 114, 'Proof of Identity', '59.17', 'jpg', '67fe0a2e301dc.jpg', '/uploads/M-2025-04-000000114/67fe0a2e301dc.jpg', '2025-04-15 07:26:38', 'pamelavivientballesteros@gmail.com', '2025-04-15 07:26:38', NULL, NULL, NULL),
(254, 114, 'Proof of Date of Birth', '334.27', 'pdf', '67fe0a2e32ebe.pdf', '/uploads/M-2025-04-000000114/67fe0a2e32ebe.pdf', '2025-04-15 07:26:38', 'pamelavivientballesteros@gmail.com', '2025-04-15 07:26:38', NULL, NULL, NULL),
(255, 114, 'Proof of Address', '334.27', 'pdf', '67fe0a2e3539f.pdf', '/uploads/M-2025-04-000000114/67fe0a2e3539f.pdf', '2025-04-15 07:26:38', 'pamelavivientballesteros@gmail.com', '2025-04-15 07:26:38', NULL, NULL, NULL),
(256, 114, '2x2 ID Picture', '59.17', 'jpg', '67fe0a2e37c26.jpg', '/uploads/M-2025-04-000000114/67fe0a2e37c26.jpg', '2025-04-15 07:26:38', 'pamelavivientballesteros@gmail.com', '2025-04-15 07:26:38', NULL, NULL, NULL),
(257, 115, 'PMES Certificate', '1359.19', 'pdf', '67fe0eea00261.pdf', '/uploads/M-2025-04-000000115/67fe0eea00261.pdf', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:50', NULL, NULL, NULL),
(258, 115, 'Proof of Identity', '37.34', 'jpg', '67fe0eea037be.jpg', '/uploads/M-2025-04-000000115/67fe0eea037be.jpg', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:50', NULL, NULL, NULL),
(259, 115, 'Proof of Date of Birth', '867.07', 'pdf', '67fe0eea06d50.pdf', '/uploads/M-2025-04-000000115/67fe0eea06d50.pdf', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:50', NULL, NULL, NULL),
(260, 115, 'Proof of Address', '53.18', 'pdf', '67fe0eea090f0.pdf', '/uploads/M-2025-04-000000115/67fe0eea090f0.pdf', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:50', NULL, NULL, NULL),
(261, 115, '2x2 ID Picture', '37.34', 'jpg', '67fe0eea0b571.jpg', '/uploads/M-2025-04-000000115/67fe0eea0b571.jpg', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:50', NULL, NULL, NULL),
(264, 113, 'PMES Certificate', '159.57', 'jpg', '6805ab4c477f4.jpg', '/uploads/M-2025-04-000000113/6805ab4c477f4.jpg', '2025-04-21 02:19:56', 'kathvaldezcoronquillo@gmail.com', '2025-04-21 02:19:56', NULL, NULL, NULL),
(265, 113, 'Proof of Identity', '59.17', 'jpg', '6805ab4c4ac9a.jpg', '/uploads/M-2025-04-000000113/6805ab4c4ac9a.jpg', '2025-04-21 02:19:56', 'kathvaldezcoronquillo@gmail.com', '2025-04-21 02:19:56', NULL, NULL, NULL),
(266, 113, 'Proof of Date of Birth', '334.27', 'pdf', '6805ab4c4d8b6.pdf', '/uploads/M-2025-04-000000113/6805ab4c4d8b6.pdf', '2025-04-21 02:19:56', 'kathvaldezcoronquillo@gmail.com', '2025-04-21 02:19:56', NULL, NULL, NULL),
(267, 113, 'Proof of Address', '334.27', 'pdf', '6805ab4c501d8.pdf', '/uploads/M-2025-04-000000113/6805ab4c501d8.pdf', '2025-04-21 02:19:56', 'kathvaldezcoronquillo@gmail.com', '2025-04-21 02:19:56', NULL, NULL, NULL),
(268, 113, '2x2 ID Picture', '59.17', 'jpg', '6805ab4c52eb1.jpg', '/uploads/M-2025-04-000000113/6805ab4c52eb1.jpg', '2025-04-21 02:19:56', 'kathvaldezcoronquillo@gmail.com', '2025-04-21 02:19:56', NULL, NULL, NULL),
(269, 125, 'PMES Certificate', '159.57', 'jpg', '68089fe01303c.jpg', '/uploads/M-2025-04-000000125/68089fe01303c.jpg', '2025-04-23 08:07:59', 'kathvaldezcoronquillo@gmail.com', '2025-04-23 08:08:00', NULL, NULL, NULL),
(270, 125, 'Proof of Identity', '59.17', 'jpg', '68089fe016e01.jpg', '/uploads/M-2025-04-000000125/68089fe016e01.jpg', '2025-04-23 08:07:59', 'kathvaldezcoronquillo@gmail.com', '2025-04-23 08:08:00', NULL, NULL, NULL),
(271, 125, 'Proof of Date of Birth', '334.27', 'pdf', '68089fe01afa2.pdf', '/uploads/M-2025-04-000000125/68089fe01afa2.pdf', '2025-04-23 08:07:59', 'kathvaldezcoronquillo@gmail.com', '2025-04-23 08:08:00', NULL, NULL, NULL),
(272, 125, 'Proof of Address', '334.27', 'pdf', '68089fe01e230.pdf', '/uploads/M-2025-04-000000125/68089fe01e230.pdf', '2025-04-23 08:07:59', 'kathvaldezcoronquillo@gmail.com', '2025-04-23 08:08:00', NULL, NULL, NULL),
(273, 125, '2x2 ID Picture', '59.17', 'jpg', '68089fe0212b1.jpg', '/uploads/M-2025-04-000000125/68089fe0212b1.jpg', '2025-04-23 08:07:59', 'kathvaldezcoronquillo@gmail.com', '2025-04-23 08:08:00', NULL, NULL, NULL),
(274, 130, 'PMES Certificate', '159.57', 'jpg', '680b2eedef67e.jpg', '/uploads/M-2025-04-000000130/680b2eedef67e.jpg', '2025-04-25 06:42:53', 'gtest8833@gmail.com', '2025-04-25 06:42:53', NULL, NULL, NULL),
(275, 130, 'Proof of Identity', '59.17', 'jpg', '680b2eedf1838.jpg', '/uploads/M-2025-04-000000130/680b2eedf1838.jpg', '2025-04-25 06:42:53', 'gtest8833@gmail.com', '2025-04-25 06:42:53', NULL, NULL, NULL),
(276, 130, 'Proof of Date of Birth', '334.27', 'pdf', '680b2eee00458.pdf', '/uploads/M-2025-04-000000130/680b2eee00458.pdf', '2025-04-25 06:42:53', 'gtest8833@gmail.com', '2025-04-25 06:42:54', NULL, NULL, NULL),
(277, 130, 'Proof of Address', '334.27', 'pdf', '680b2eee03f94.pdf', '/uploads/M-2025-04-000000130/680b2eee03f94.pdf', '2025-04-25 06:42:53', 'gtest8833@gmail.com', '2025-04-25 06:42:54', NULL, NULL, NULL),
(278, 130, '2x2 ID Picture', '159.57', 'jpg', '680b2eee05d98.jpg', '/uploads/M-2025-04-000000130/680b2eee05d98.jpg', '2025-04-25 06:42:53', 'gtest8833@gmail.com', '2025-04-25 06:42:54', NULL, NULL, NULL),
(279, 132, 'PMES Certificate', '159.57', 'jpg', '681087f204a6a.jpg', '/uploads/M-2025-04-000000132/681087f204a6a.jpg', '2025-04-29 08:04:01', 'kath1234@mailinator.com', '2025-04-29 08:04:02', NULL, NULL, NULL),
(280, 132, 'Proof of Identity', '59.17', 'jpg', '681087f20ba32.jpg', '/uploads/M-2025-04-000000132/681087f20ba32.jpg', '2025-04-29 08:04:01', 'kath1234@mailinator.com', '2025-04-29 08:04:02', NULL, NULL, NULL),
(281, 132, 'Proof of Date of Birth', '334.27', 'pdf', '681087f20f986.pdf', '/uploads/M-2025-04-000000132/681087f20f986.pdf', '2025-04-29 08:04:01', 'kath1234@mailinator.com', '2025-04-29 08:04:02', NULL, NULL, NULL),
(282, 132, 'Proof of Address', '334.27', 'pdf', '681087f2126d0.pdf', '/uploads/M-2025-04-000000132/681087f2126d0.pdf', '2025-04-29 08:04:01', 'kath1234@mailinator.com', '2025-04-29 08:04:02', NULL, NULL, NULL),
(283, 132, '2x2 ID Picture', '59.17', 'jpg', '681087f214fc5.jpg', '/uploads/M-2025-04-000000132/681087f214fc5.jpg', '2025-04-29 08:04:01', 'kath1234@mailinator.com', '2025-04-29 08:04:02', NULL, NULL, NULL),
(284, 132, 'PMES Certificate', '159.57', 'jpg', '6811713f93362.jpg', '/uploads/M-2025-04-000000132/6811713f93362.jpg', '2025-04-30 00:39:27', 'kath1234@mailinator.com', '2025-04-30 00:39:27', NULL, NULL, NULL),
(285, 132, 'Proof of Identity', '59.17', 'jpg', '6811713f9686d.jpg', '/uploads/M-2025-04-000000132/6811713f9686d.jpg', '2025-04-30 00:39:27', 'kath1234@mailinator.com', '2025-04-30 00:39:27', NULL, NULL, NULL),
(286, 132, 'Proof of Date of Birth', '334.27', 'pdf', '6811713f986c3.pdf', '/uploads/M-2025-04-000000132/6811713f986c3.pdf', '2025-04-30 00:39:27', 'kath1234@mailinator.com', '2025-04-30 00:39:27', NULL, NULL, NULL),
(287, 132, 'Proof of Address', '334.27', 'pdf', '6811713f99e46.pdf', '/uploads/M-2025-04-000000132/6811713f99e46.pdf', '2025-04-30 00:39:27', 'kath1234@mailinator.com', '2025-04-30 00:39:27', NULL, NULL, NULL),
(288, 132, '2x2 ID Picture', '59.17', 'jpg', '6811713f9b5aa.jpg', '/uploads/M-2025-04-000000132/6811713f9b5aa.jpg', '2025-04-30 00:39:27', 'kath1234@mailinator.com', '2025-04-30 00:39:27', NULL, NULL, NULL),
(289, 132, 'PMES Certificate', '163.76', 'pdf', '681197413cbe2.pdf', '/uploads/M-2025-04-000000132/681197413cbe2.pdf', '2025-04-30 03:21:37', 'kath1234@mailinator.com', '2025-04-30 03:21:37', NULL, NULL, NULL),
(290, 132, 'Proof of Identity', '159.57', 'jpg', '681197413f84f.jpg', '/uploads/M-2025-04-000000132/681197413f84f.jpg', '2025-04-30 03:21:37', 'kath1234@mailinator.com', '2025-04-30 03:21:37', NULL, NULL, NULL),
(291, 132, 'Proof of Date of Birth', '334.27', 'pdf', '6811974141a65.pdf', '/uploads/M-2025-04-000000132/6811974141a65.pdf', '2025-04-30 03:21:37', 'kath1234@mailinator.com', '2025-04-30 03:21:37', NULL, NULL, NULL),
(292, 132, 'Proof of Address', '334.27', 'pdf', '6811974143cc1.pdf', '/uploads/M-2025-04-000000132/6811974143cc1.pdf', '2025-04-30 03:21:37', 'kath1234@mailinator.com', '2025-04-30 03:21:37', NULL, NULL, NULL),
(293, 132, '2x2 ID Picture', '59.17', 'jpg', '681197414605a.jpg', '/uploads/M-2025-04-000000132/681197414605a.jpg', '2025-04-30 03:21:37', 'kath1234@mailinator.com', '2025-04-30 03:21:37', NULL, NULL, NULL),
(294, 132, 'PMES Certificate', '334.27', 'pdf', '681198a8bab80.pdf', '/uploads/M-2025-04-000000132/681198a8bab80.pdf', '2025-04-30 03:27:36', 'kath1234@mailinator.com', '2025-04-30 03:27:36', NULL, NULL, NULL),
(295, 132, 'Proof of Identity', '59.17', 'jpg', '681198a8bd5d6.jpg', '/uploads/M-2025-04-000000132/681198a8bd5d6.jpg', '2025-04-30 03:27:36', 'kath1234@mailinator.com', '2025-04-30 03:27:36', NULL, NULL, NULL),
(296, 132, 'Proof of Date of Birth', '334.27', 'pdf', '681198a8bfb52.pdf', '/uploads/M-2025-04-000000132/681198a8bfb52.pdf', '2025-04-30 03:27:36', 'kath1234@mailinator.com', '2025-04-30 03:27:36', NULL, NULL, NULL),
(297, 132, 'Proof of Address', '334.27', 'pdf', '681198a8c2b33.pdf', '/uploads/M-2025-04-000000132/681198a8c2b33.pdf', '2025-04-30 03:27:36', 'kath1234@mailinator.com', '2025-04-30 03:27:36', NULL, NULL, NULL),
(298, 132, '2x2 ID Picture', '59.17', 'jpg', '681198a8c5330.jpg', '/uploads/M-2025-04-000000132/681198a8c5330.jpg', '2025-04-30 03:27:36', 'kath1234@mailinator.com', '2025-04-30 03:27:36', NULL, NULL, NULL),
(299, 132, 'PMES Certificate', '159.57', 'jpg', '681199731cfbc.jpg', '/uploads/M-2025-04-000000132/681199731cfbc.jpg', '2025-04-30 03:30:58', 'kath1234@mailinator.com', '2025-04-30 03:30:59', NULL, NULL, NULL),
(300, 132, 'Proof of Identity', '180.96', 'jpeg', '681199731feab.jpeg', '/uploads/M-2025-04-000000132/681199731feab.jpeg', '2025-04-30 03:30:58', 'kath1234@mailinator.com', '2025-04-30 03:30:59', NULL, NULL, NULL),
(301, 132, 'Proof of Date of Birth', '159.57', 'jpg', '6811997322101.jpg', '/uploads/M-2025-04-000000132/6811997322101.jpg', '2025-04-30 03:30:58', 'kath1234@mailinator.com', '2025-04-30 03:30:59', NULL, NULL, NULL),
(302, 132, 'Proof of Address', '163.76', 'pdf', '6811997324897.pdf', '/uploads/M-2025-04-000000132/6811997324897.pdf', '2025-04-30 03:30:58', 'kath1234@mailinator.com', '2025-04-30 03:30:59', NULL, NULL, NULL),
(303, 132, '2x2 ID Picture', '159.57', 'jpg', '6811997326405.jpg', '/uploads/M-2025-04-000000132/6811997326405.jpg', '2025-04-30 03:30:58', 'kath1234@mailinator.com', '2025-04-30 03:30:59', NULL, NULL, NULL),
(304, 132, 'PMES Certificate', '159.57', 'jpg', '68119aa94367b.jpg', '/uploads/M-2025-04-000000132/68119aa94367b.jpg', '2025-04-30 03:36:09', 'kath1234@mailinator.com', '2025-04-30 03:36:09', NULL, NULL, NULL),
(305, 132, 'Proof of Identity', '59.17', 'jpg', '68119aa945f91.jpg', '/uploads/M-2025-04-000000132/68119aa945f91.jpg', '2025-04-30 03:36:09', 'kath1234@mailinator.com', '2025-04-30 03:36:09', NULL, NULL, NULL),
(306, 132, 'Proof of Date of Birth', '334.27', 'pdf', '68119aa948ebc.pdf', '/uploads/M-2025-04-000000132/68119aa948ebc.pdf', '2025-04-30 03:36:09', 'kath1234@mailinator.com', '2025-04-30 03:36:09', NULL, NULL, NULL),
(307, 132, 'Proof of Address', '59.17', 'jpg', '68119aa94add1.jpg', '/uploads/M-2025-04-000000132/68119aa94add1.jpg', '2025-04-30 03:36:09', 'kath1234@mailinator.com', '2025-04-30 03:36:09', NULL, NULL, NULL),
(308, 132, '2x2 ID Picture', '59.17', 'jpg', '68119aa94dee4.jpg', '/uploads/M-2025-04-000000132/68119aa94dee4.jpg', '2025-04-30 03:36:09', 'kath1234@mailinator.com', '2025-04-30 03:36:09', NULL, NULL, NULL),
(309, 132, 'PMES Certificate', '159.57', 'jpg', '68119f310e89f.jpg', '/uploads/M-2025-04-000000132/68119f310e89f.jpg', '2025-04-30 03:55:28', 'kath1234@mailinator.com', '2025-04-30 03:55:29', NULL, NULL, NULL),
(310, 132, 'Proof of Identity', '180.96', 'jpeg', '68119f3111c5e.jpeg', '/uploads/M-2025-04-000000132/68119f3111c5e.jpeg', '2025-04-30 03:55:28', 'kath1234@mailinator.com', '2025-04-30 03:55:29', NULL, NULL, NULL),
(311, 132, 'Proof of Date of Birth', '334.27', 'pdf', '68119f3114dfb.pdf', '/uploads/M-2025-04-000000132/68119f3114dfb.pdf', '2025-04-30 03:55:28', 'kath1234@mailinator.com', '2025-04-30 03:55:29', NULL, NULL, NULL),
(312, 132, 'Proof of Address', '334.27', 'pdf', '68119f3117a49.pdf', '/uploads/M-2025-04-000000132/68119f3117a49.pdf', '2025-04-30 03:55:28', 'kath1234@mailinator.com', '2025-04-30 03:55:29', NULL, NULL, NULL),
(313, 132, '2x2 ID Picture', '59.17', 'jpg', '68119f311a027.jpg', '/uploads/M-2025-04-000000132/68119f311a027.jpg', '2025-04-30 03:55:28', 'kath1234@mailinator.com', '2025-04-30 03:55:29', NULL, NULL, NULL),
(444, 132, 'PMES Certificate', '159.57', 'jpg', '6811c0a28df11.jpg', '/uploads/M-2025-04-000000132/6811c0a28df11.jpg', '2025-04-30 06:18:10', 'kath1234@mailinator.com', '2025-04-30 06:18:10', NULL, NULL, NULL),
(445, 132, 'Proof of Identity', '59.17', 'jpg', '6811c0a292275.jpg', '/uploads/M-2025-04-000000132/6811c0a292275.jpg', '2025-04-30 06:18:10', 'kath1234@mailinator.com', '2025-04-30 06:18:10', NULL, NULL, NULL),
(446, 132, 'Proof of Date of Birth', '334.27', 'pdf', '6811c0a29426a.pdf', '/uploads/M-2025-04-000000132/6811c0a29426a.pdf', '2025-04-30 06:18:10', 'kath1234@mailinator.com', '2025-04-30 06:18:10', NULL, NULL, NULL),
(447, 132, 'Proof of Address', '334.27', 'pdf', '6811c0a2969e1.pdf', '/uploads/M-2025-04-000000132/6811c0a2969e1.pdf', '2025-04-30 06:18:10', 'kath1234@mailinator.com', '2025-04-30 06:18:10', NULL, NULL, NULL),
(448, 132, '2x2 ID Picture', '59.17', 'jpg', '6811c0a2989ee.jpg', '/uploads/M-2025-04-000000132/6811c0a2989ee.jpg', '2025-04-30 06:18:10', 'kath1234@mailinator.com', '2025-04-30 06:18:10', NULL, NULL, NULL),
(449, 132, 'PMES Certificate', '159.57', 'jpg', '68143d3e58f1c.jpg', '/uploads/M-2025-05-000000132/68143d3e58f1c.jpg', '2025-05-02 03:34:22', 'kath1234@mailinator.com', '2025-05-02 03:34:22', NULL, NULL, NULL),
(450, 132, 'Proof of Identity', '6659.83', 'jpg', '68143d3e5cfe7.jpg', '/uploads/M-2025-05-000000132/68143d3e5cfe7.jpg', '2025-05-02 03:34:22', 'kath1234@mailinator.com', '2025-05-02 03:34:22', NULL, NULL, NULL),
(451, 132, 'Proof of Date of Birth', '601.02', 'pdf', '68143d3e6102c.pdf', '/uploads/M-2025-05-000000132/68143d3e6102c.pdf', '2025-05-02 03:34:22', 'kath1234@mailinator.com', '2025-05-02 03:34:22', NULL, NULL, NULL),
(452, 132, 'Proof of Address', '601.02', 'pdf', '68143d3e62e48.pdf', '/uploads/M-2025-05-000000132/68143d3e62e48.pdf', '2025-05-02 03:34:22', 'kath1234@mailinator.com', '2025-05-02 03:34:22', NULL, NULL, NULL),
(453, 132, '2x2 ID Picture', '24.31', 'jpg', '68143d3e64672.jpg', '/uploads/M-2025-05-000000132/68143d3e64672.jpg', '2025-05-02 03:34:22', 'kath1234@mailinator.com', '2025-05-02 03:34:22', NULL, NULL, NULL),
(539, 139, 'PMES Certificate', '159.57', 'jpg', '681959dd2d18e.jpg', '/uploads/M-2025-05-000000139/681959dd2d18e.jpg', '2025-05-06 00:37:49', 'kath-test@mailinator.com', '2025-05-06 00:37:49', NULL, NULL, NULL),
(540, 139, 'Proof of Identity', '59.17', 'jpg', '681959dd306d9.jpg', '/uploads/M-2025-05-000000139/681959dd306d9.jpg', '2025-05-06 00:37:49', 'kath-test@mailinator.com', '2025-05-06 00:37:49', NULL, NULL, NULL),
(541, 139, 'Proof of Date of Birth', '334.27', 'pdf', '681959dd32b7d.pdf', '/uploads/M-2025-05-000000139/681959dd32b7d.pdf', '2025-05-06 00:37:49', 'kath-test@mailinator.com', '2025-05-06 00:37:49', NULL, NULL, NULL),
(542, 139, 'Proof of Address', '334.27', 'pdf', '681959dd3497c.pdf', '/uploads/M-2025-05-000000139/681959dd3497c.pdf', '2025-05-06 00:37:49', 'kath-test@mailinator.com', '2025-05-06 00:37:49', NULL, NULL, NULL),
(543, 139, '2x2 ID Picture', '59.17', 'jpg', '681959dd3660c.jpg', '/uploads/M-2025-05-000000139/681959dd3660c.jpg', '2025-05-06 00:37:49', 'kath-test@mailinator.com', '2025-05-06 00:37:49', NULL, NULL, NULL),
(544, 132, 'PMES Certificate', '159.57', 'jpg', '68197e942fc7d.jpg', '/uploads/M-2025-05-000000132/68197e942fc7d.jpg', '2025-05-06 03:14:28', 'kath1234@mailinator.com', '2025-05-06 03:14:28', NULL, NULL, NULL),
(545, 132, 'Proof of Identity', '159.57', 'jpg', '68197e9431b16.jpg', '/uploads/M-2025-05-000000132/68197e9431b16.jpg', '2025-05-06 03:14:28', 'kath1234@mailinator.com', '2025-05-06 03:14:28', NULL, NULL, NULL),
(546, 132, 'Proof of Date of Birth', '163.76', 'pdf', '68197e9433e60.pdf', '/uploads/M-2025-05-000000132/68197e9433e60.pdf', '2025-05-06 03:14:28', 'kath1234@mailinator.com', '2025-05-06 03:14:28', NULL, NULL, NULL),
(547, 132, 'Proof of Address', '334.27', 'pdf', '68197e9434c04.pdf', '/uploads/M-2025-05-000000132/68197e9434c04.pdf', '2025-05-06 03:14:28', 'kath1234@mailinator.com', '2025-05-06 03:14:28', NULL, NULL, NULL),
(548, 132, '2x2 ID Picture', '59.17', 'jpg', '68197e94357cf.jpg', '/uploads/M-2025-05-000000132/68197e94357cf.jpg', '2025-05-06 03:14:28', 'kath1234@mailinator.com', '2025-05-06 03:14:28', NULL, NULL, NULL),
(549, 132, 'PMES Certificate', '159.57', 'jpg', '6819801760a56.jpg', '/uploads/M-2025-05-000000132/6819801760a56.jpg', '2025-05-06 03:20:55', 'kath1234@mailinator.com', '2025-05-06 03:20:55', NULL, NULL, NULL),
(550, 132, 'Proof of Identity', '59.17', 'jpg', '68198017620f3.jpg', '/uploads/M-2025-05-000000132/68198017620f3.jpg', '2025-05-06 03:20:55', 'kath1234@mailinator.com', '2025-05-06 03:20:55', NULL, NULL, NULL),
(551, 132, 'Proof of Date of Birth', '334.27', 'pdf', '6819801763878.pdf', '/uploads/M-2025-05-000000132/6819801763878.pdf', '2025-05-06 03:20:55', 'kath1234@mailinator.com', '2025-05-06 03:20:55', NULL, NULL, NULL),
(552, 132, 'Proof of Address', '334.27', 'pdf', '68198017646f8.pdf', '/uploads/M-2025-05-000000132/68198017646f8.pdf', '2025-05-06 03:20:55', 'kath1234@mailinator.com', '2025-05-06 03:20:55', NULL, NULL, NULL),
(553, 132, '2x2 ID Picture', '59.17', 'jpg', '6819801765897.jpg', '/uploads/M-2025-05-000000132/6819801765897.jpg', '2025-05-06 03:20:55', 'kath1234@mailinator.com', '2025-05-06 03:20:55', NULL, NULL, NULL),
(624, 132, 'PMES Certificate', '334.27', 'pdf', '68198957cd22c.pdf', '/uploads/M-2025-05-000000132/68198957cd22c.pdf', '2025-05-06 04:00:23', 'kath1234@mailinator.com', '2025-05-06 04:00:23', NULL, NULL, NULL),
(625, 132, 'Proof of Identity', '59.17', 'jpg', '68198957ce30f.jpg', '/uploads/M-2025-05-000000132/68198957ce30f.jpg', '2025-05-06 04:00:23', 'kath1234@mailinator.com', '2025-05-06 04:00:23', NULL, NULL, NULL),
(626, 132, 'Proof of Date of Birth', '334.27', 'pdf', '68198957cf2bd.pdf', '/uploads/M-2025-05-000000132/68198957cf2bd.pdf', '2025-05-06 04:00:23', 'kath1234@mailinator.com', '2025-05-06 04:00:23', NULL, NULL, NULL),
(627, 132, 'Proof of Address', '334.27', 'pdf', '68198957cfdce.pdf', '/uploads/M-2025-05-000000132/68198957cfdce.pdf', '2025-05-06 04:00:23', 'kath1234@mailinator.com', '2025-05-06 04:00:23', NULL, NULL, NULL),
(628, 132, '2x2 ID Picture', '59.17', 'jpg', '68198957d0b25.jpg', '/uploads/M-2025-05-000000132/68198957d0b25.jpg', '2025-05-06 04:00:23', 'kath1234@mailinator.com', '2025-05-06 04:00:23', NULL, NULL, NULL),
(629, 142, 'PMES Certificate', '159.57', 'jpg', '68199764d6152.jpg', '/uploads/M-2025-05-000000142/68199764d6152.jpg', '2025-05-06 05:00:20', 'kathrina123456@mailinator.com', '2025-05-06 05:00:20', NULL, NULL, NULL),
(630, 142, 'Proof of Identity', '180.96', 'jpeg', '68199764d9b88.jpeg', '/uploads/M-2025-05-000000142/68199764d9b88.jpeg', '2025-05-06 05:00:20', 'kathrina123456@mailinator.com', '2025-05-06 05:00:20', NULL, NULL, NULL),
(631, 142, 'Proof of Date of Birth', '334.27', 'pdf', '68199764dcd7f.pdf', '/uploads/M-2025-05-000000142/68199764dcd7f.pdf', '2025-05-06 05:00:20', 'kathrina123456@mailinator.com', '2025-05-06 05:00:20', NULL, NULL, NULL),
(632, 142, 'Proof of Address', '334.27', 'pdf', '68199764df055.pdf', '/uploads/M-2025-05-000000142/68199764df055.pdf', '2025-05-06 05:00:20', 'kathrina123456@mailinator.com', '2025-05-06 05:00:20', NULL, NULL, NULL),
(633, 142, '2x2 ID Picture', '59.17', 'jpg', '68199764e101d.jpg', '/uploads/M-2025-05-000000142/68199764e101d.jpg', '2025-05-06 05:00:20', 'kathrina123456@mailinator.com', '2025-05-06 05:00:20', NULL, NULL, NULL),
(634, 144, 'PMES Certificate', '334.27', 'pdf', '68199ad47a19e.pdf', '/uploads/M-2025-05-000000144/68199ad47a19e.pdf', '2025-05-06 05:15:00', 'kath1234567@mailinator.com', '2025-05-06 05:15:00', NULL, NULL, NULL),
(635, 144, 'Proof of Identity', '59.17', 'jpg', '68199ad47cf5e.jpg', '/uploads/M-2025-05-000000144/68199ad47cf5e.jpg', '2025-05-06 05:15:00', 'kath1234567@mailinator.com', '2025-05-06 05:15:00', NULL, NULL, NULL),
(636, 144, 'Proof of Date of Birth', '334.27', 'pdf', '68199ad48020a.pdf', '/uploads/M-2025-05-000000144/68199ad48020a.pdf', '2025-05-06 05:15:00', 'kath1234567@mailinator.com', '2025-05-06 05:15:00', NULL, NULL, NULL),
(637, 144, 'Proof of Address', '334.27', 'pdf', '68199ad4839b6.pdf', '/uploads/M-2025-05-000000144/68199ad4839b6.pdf', '2025-05-06 05:15:00', 'kath1234567@mailinator.com', '2025-05-06 05:15:00', NULL, NULL, NULL),
(638, 144, '2x2 ID Picture', '59.17', 'jpg', '68199ad485e32.jpg', '/uploads/M-2025-05-000000144/68199ad485e32.jpg', '2025-05-06 05:15:00', 'kath1234567@mailinator.com', '2025-05-06 05:15:00', NULL, NULL, NULL),
(639, 145, 'Proof of Identity', '180.96', 'jpeg', '6819c96772664.jpeg', '/uploads/M-2025-05-000000145/6819c96772664.jpeg', '2025-05-06 08:33:43', 'kath12345678@mailinator.com', '2025-05-06 08:33:43', NULL, NULL, NULL),
(640, 145, 'Proof of Date of Birth', '334.27', 'pdf', '6819c967759fe.pdf', '/uploads/M-2025-05-000000145/6819c967759fe.pdf', '2025-05-06 08:33:43', 'kath12345678@mailinator.com', '2025-05-06 08:33:43', NULL, NULL, NULL),
(641, 145, 'Proof of Address', '334.27', 'pdf', '6819c967781fa.pdf', '/uploads/M-2025-05-000000145/6819c967781fa.pdf', '2025-05-06 08:33:43', 'kath12345678@mailinator.com', '2025-05-06 08:33:43', NULL, NULL, NULL),
(642, 145, '2x2 ID Picture', '59.17', 'jpg', '6819c9677a541.jpg', '/uploads/M-2025-05-000000145/6819c9677a541.jpg', '2025-05-06 08:33:43', 'kath12345678@mailinator.com', '2025-05-06 08:33:43', NULL, NULL, NULL),
(643, 145, 'Proof of Identity', '180.96', 'jpeg', '6819c983e6ca6.jpeg', '/uploads/M-2025-05-000000145/6819c983e6ca6.jpeg', '2025-05-06 08:34:11', 'kath12345678@mailinator.com', '2025-05-06 08:34:11', NULL, NULL, NULL),
(644, 145, 'Proof of Date of Birth', '334.27', 'pdf', '6819c983e96df.pdf', '/uploads/M-2025-05-000000145/6819c983e96df.pdf', '2025-05-06 08:34:11', 'kath12345678@mailinator.com', '2025-05-06 08:34:11', NULL, NULL, NULL),
(645, 145, 'Proof of Address', '334.27', 'pdf', '6819c983eb030.pdf', '/uploads/M-2025-05-000000145/6819c983eb030.pdf', '2025-05-06 08:34:11', 'kath12345678@mailinator.com', '2025-05-06 08:34:11', NULL, NULL, NULL),
(646, 145, '2x2 ID Picture', '59.17', 'jpg', '6819c983ece9d.jpg', '/uploads/M-2025-05-000000145/6819c983ece9d.jpg', '2025-05-06 08:34:11', 'kath12345678@mailinator.com', '2025-05-06 08:34:11', NULL, NULL, NULL),
(652, 145, 'PMES Certificate', '159.57', 'jpg', '6819cf6529cfc.jpg', '/uploads/M-2025-05-000000145/6819cf6529cfc.jpg', '2025-05-06 08:59:17', 'kath12345678@mailinator.com', '2025-05-06 08:59:17', NULL, NULL, NULL),
(653, 145, 'Proof of Identity', '180.96', 'jpeg', '6819cf652bb05.jpeg', '/uploads/M-2025-05-000000145/6819cf652bb05.jpeg', '2025-05-06 08:59:17', 'kath12345678@mailinator.com', '2025-05-06 08:59:17', NULL, NULL, NULL),
(654, 145, 'Proof of Date of Birth', '334.27', 'pdf', '6819cf652cf96.pdf', '/uploads/M-2025-05-000000145/6819cf652cf96.pdf', '2025-05-06 08:59:17', 'kath12345678@mailinator.com', '2025-05-06 08:59:17', NULL, NULL, NULL);
INSERT INTO `user_documents` (`id`, `user_id`, `document_type`, `doc_size`, `doc_type`, `doc_name`, `doc_path`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(655, 145, 'Proof of Address', '334.27', 'pdf', '6819cf652ecb1.pdf', '/uploads/M-2025-05-000000145/6819cf652ecb1.pdf', '2025-05-06 08:59:17', 'kath12345678@mailinator.com', '2025-05-06 08:59:17', NULL, NULL, NULL),
(656, 145, '2x2 ID Picture', '59.17', 'jpg', '6819cf652ff1e.jpg', '/uploads/M-2025-05-000000145/6819cf652ff1e.jpg', '2025-05-06 08:59:17', 'kath12345678@mailinator.com', '2025-05-06 08:59:17', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `entity_name` varchar(255) NOT NULL,
  `type_of_action` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `action_description` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `entity_name`, `type_of_action`, `ip_address`, `action_description`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(840, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 02:14:26', NULL, '2025-04-24 02:14:26', NULL, NULL),
(841, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 02:14:40', NULL, '2025-04-24 02:14:40', NULL, NULL),
(842, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 02:14:54', NULL, '2025-04-24 02:14:54', NULL, NULL),
(843, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 02:27:58', NULL, '2025-04-24 02:27:58', NULL, NULL),
(844, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 02:28:23', NULL, '2025-04-24 02:28:23', NULL, NULL),
(845, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 02:29:34', NULL, '2025-04-24 02:29:34', NULL, NULL),
(846, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 02:29:54', NULL, '2025-04-24 02:29:54', NULL, NULL),
(847, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 02:30:16', NULL, '2025-04-24 02:30:16', NULL, NULL),
(848, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 02:31:05', NULL, '2025-04-24 02:31:05', NULL, NULL),
(849, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 02:32:27', NULL, '2025-04-24 02:32:27', NULL, NULL),
(850, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 02:33:12', NULL, '2025-04-24 02:33:12', NULL, NULL),
(851, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 03:01:14', NULL, '2025-04-24 03:01:14', NULL, NULL),
(852, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 03:01:39', NULL, '2025-04-24 03:01:39', NULL, NULL),
(853, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 03:02:39', NULL, '2025-04-24 03:02:39', NULL, NULL),
(854, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 03:03:00', NULL, '2025-04-24 03:03:00', NULL, NULL),
(855, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 03:03:20', NULL, '2025-04-24 03:03:20', NULL, NULL),
(856, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 03:04:34', NULL, '2025-04-24 03:04:34', NULL, NULL),
(857, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 03:05:09', NULL, '2025-04-24 03:05:09', NULL, NULL),
(858, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 03:05:49', NULL, '2025-04-24 03:05:49', NULL, NULL),
(859, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 05:05:57', NULL, '2025-04-24 05:05:57', NULL, NULL),
(860, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 05:06:15', NULL, '2025-04-24 05:06:15', NULL, NULL),
(861, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:07:12', NULL, '2025-04-24 05:07:12', NULL, NULL),
(862, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:07:37', NULL, '2025-04-24 05:07:37', NULL, NULL),
(863, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:07:57', NULL, '2025-04-24 05:07:57', NULL, NULL),
(864, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:10:59', NULL, '2025-04-24 05:10:59', NULL, NULL),
(865, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:11:13', NULL, '2025-04-24 05:11:13', NULL, NULL),
(866, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:14:46', NULL, '2025-04-24 05:14:46', NULL, NULL),
(867, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 05:16:10', NULL, '2025-04-24 05:16:10', NULL, NULL),
(868, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 05:17:35', NULL, '2025-04-24 05:17:35', NULL, NULL),
(869, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:21:40', NULL, '2025-04-24 05:21:40', NULL, NULL),
(870, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:22:04', NULL, '2025-04-24 05:22:04', NULL, NULL),
(871, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:22:30', NULL, '2025-04-24 05:22:30', NULL, NULL),
(872, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:23:09', NULL, '2025-04-24 05:23:09', NULL, NULL),
(873, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:23:42', NULL, '2025-04-24 05:23:42', NULL, NULL),
(874, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:24:23', NULL, '2025-04-24 05:24:23', NULL, NULL),
(875, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 05:33:04', NULL, '2025-04-24 05:33:04', NULL, NULL),
(876, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 05:34:05', NULL, '2025-04-24 05:34:05', NULL, NULL),
(877, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:35:56', NULL, '2025-04-24 05:35:56', NULL, NULL),
(878, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:36:17', NULL, '2025-04-24 05:36:17', NULL, NULL),
(879, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:37:08', NULL, '2025-04-24 05:37:08', NULL, NULL),
(880, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:37:55', NULL, '2025-04-24 05:37:55', NULL, NULL),
(881, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:38:04', NULL, '2025-04-24 05:38:04', NULL, NULL),
(882, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:38:53', NULL, '2025-04-24 05:38:53', NULL, NULL),
(883, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 05:40:23', NULL, '2025-04-24 05:40:23', NULL, NULL),
(884, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 05:40:40', NULL, '2025-04-24 05:40:40', NULL, NULL),
(885, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:41:42', NULL, '2025-04-24 05:41:42', NULL, NULL),
(886, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:43:17', NULL, '2025-04-24 05:43:17', NULL, NULL),
(887, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:45:06', NULL, '2025-04-24 05:45:06', NULL, NULL),
(888, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:45:28', NULL, '2025-04-24 05:45:28', NULL, NULL),
(889, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:45:53', NULL, '2025-04-24 05:45:53', NULL, NULL),
(890, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:46:05', NULL, '2025-04-24 05:46:05', NULL, NULL),
(891, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 05:51:59', NULL, '2025-04-24 05:51:59', NULL, NULL),
(892, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 05:52:21', NULL, '2025-04-24 05:52:21', NULL, NULL),
(893, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:52:56', NULL, '2025-04-24 05:52:56', NULL, NULL),
(894, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:53:12', NULL, '2025-04-24 05:53:12', NULL, NULL),
(895, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 05:53:28', NULL, '2025-04-24 05:53:28', NULL, NULL),
(896, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:54:15', NULL, '2025-04-24 05:54:15', NULL, NULL),
(897, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:54:26', NULL, '2025-04-24 05:54:26', NULL, NULL),
(898, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 05:55:11', NULL, '2025-04-24 05:55:11', NULL, NULL),
(899, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 06:08:12', NULL, '2025-04-24 06:08:12', NULL, NULL),
(900, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 06:08:35', NULL, '2025-04-24 06:08:35', NULL, NULL),
(901, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 06:09:19', NULL, '2025-04-24 06:09:19', NULL, NULL),
(902, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 06:09:33', NULL, '2025-04-24 06:09:33', NULL, NULL),
(903, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 06:09:46', NULL, '2025-04-24 06:09:46', NULL, NULL),
(904, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 06:11:09', NULL, '2025-04-24 06:11:09', NULL, NULL),
(905, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 06:12:27', NULL, '2025-04-24 06:12:27', NULL, NULL),
(906, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 06:12:37', NULL, '2025-04-24 06:12:37', NULL, NULL),
(907, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 06:15:25', NULL, '2025-04-24 06:15:25', NULL, NULL),
(908, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 06:16:06', NULL, '2025-04-24 06:16:06', NULL, NULL),
(909, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 06:17:15', NULL, '2025-04-24 06:17:15', NULL, NULL),
(910, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 06:17:29', NULL, '2025-04-24 06:17:29', NULL, NULL),
(911, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 06:17:43', NULL, '2025-04-24 06:17:43', NULL, NULL),
(912, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 06:24:10', NULL, '2025-04-24 06:24:10', NULL, NULL),
(913, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 06:24:40', NULL, '2025-04-24 06:24:40', NULL, NULL),
(914, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-24 06:24:49', NULL, '2025-04-24 06:24:49', NULL, NULL),
(915, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 06:48:02', NULL, '2025-04-24 06:48:02', NULL, NULL),
(916, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 06:48:41', NULL, '2025-04-24 06:48:41', NULL, NULL),
(917, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 06:49:18', NULL, '2025-04-24 06:49:18', NULL, NULL),
(918, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 06:49:32', NULL, '2025-04-24 06:49:32', NULL, NULL),
(919, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 07:12:28', NULL, '2025-04-24 07:12:28', NULL, NULL),
(920, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 07:26:06', NULL, '2025-04-24 07:26:06', NULL, NULL),
(921, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 07:28:43', NULL, '2025-04-24 07:28:43', NULL, NULL),
(922, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-24 07:28:56', NULL, '2025-04-24 07:28:56', NULL, NULL),
(923, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 07:29:31', NULL, '2025-04-24 07:29:31', NULL, NULL),
(924, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 07:30:13', NULL, '2025-04-24 07:30:13', NULL, NULL),
(925, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-24 07:30:33', NULL, '2025-04-24 07:30:33', NULL, NULL),
(926, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-04-25 01:15:30', NULL, '2025-04-25 01:15:30', NULL, NULL),
(927, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-25 01:19:04', NULL, '2025-04-25 01:19:04', NULL, NULL),
(928, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-25 01:19:21', NULL, '2025-04-25 01:19:21', NULL, NULL),
(929, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-25 01:19:39', NULL, '2025-04-25 01:19:39', NULL, NULL),
(930, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 01:19:55', NULL, '2025-04-25 01:19:55', NULL, NULL),
(931, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 01:20:08', NULL, '2025-04-25 01:20:08', NULL, NULL),
(932, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 01:20:21', NULL, '2025-04-25 01:20:21', NULL, NULL),
(933, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-04-25 01:21:25', NULL, '2025-04-25 01:21:25', NULL, NULL),
(934, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 02:57:25', NULL, '2025-04-25 02:57:25', NULL, NULL),
(935, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-04-25 03:03:48', NULL, '2025-04-25 03:03:48', NULL, NULL),
(936, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 05:25:32', NULL, '2025-04-25 05:25:32', NULL, NULL),
(937, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-04-25 05:40:31', NULL, '2025-04-25 05:40:31', NULL, NULL),
(938, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 05:40:41', NULL, '2025-04-25 05:40:41', NULL, NULL),
(939, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-25 05:50:35', NULL, '2025-04-25 05:50:35', NULL, NULL),
(940, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-25 05:51:41', NULL, '2025-04-25 05:51:41', NULL, NULL),
(941, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-25 05:55:59', NULL, '2025-04-25 05:55:59', NULL, NULL),
(942, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-25 05:56:26', NULL, '2025-04-25 05:56:26', NULL, NULL),
(943, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-25 05:56:48', NULL, '2025-04-25 05:56:48', NULL, NULL),
(944, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 06:03:55', NULL, '2025-04-25 06:03:55', NULL, NULL),
(945, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 06:04:12', NULL, '2025-04-25 06:04:12', NULL, NULL),
(946, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 06:04:29', NULL, '2025-04-25 06:04:29', NULL, NULL),
(947, 125, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-04-25 06:05:13', NULL, '2025-04-25 06:05:13', NULL, NULL),
(948, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 06:06:45', NULL, '2025-04-25 06:06:45', NULL, NULL),
(949, 89, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-04-25 06:16:02', NULL, '2025-04-25 06:16:02', NULL, NULL),
(950, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 06:16:27', NULL, '2025-04-25 06:16:27', NULL, NULL),
(951, 130, 'User', 'Generated An Invoice', '::1', 'User gtest8833@gmail.com Generated an Invoice for membership', NULL, '2025-04-25 06:40:39', NULL, '2025-04-25 06:40:39', NULL, NULL),
(952, 130, 'User', 'Payment Initiated', '::1', 'User gtest8833@gmail.com Generated an Invoice for membership', NULL, '2025-04-25 06:41:00', NULL, '2025-04-25 06:41:00', NULL, NULL),
(953, 130, 'Employee', 'Generated an Invoice', '::1', 'User gtest8833@gmail.comGenerated an invoice for Initial Capital share', NULL, '2025-04-25 06:41:21', NULL, '2025-04-25 06:41:21', NULL, NULL),
(954, 130, 'User', 'Payment Initiated', '::1', 'User gtest8833@gmail.com Generated an Invoice for membership', NULL, '2025-04-25 06:41:46', NULL, '2025-04-25 06:41:46', NULL, NULL),
(955, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 06:43:20', NULL, '2025-04-25 06:43:20', NULL, NULL),
(956, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 06:43:30', NULL, '2025-04-25 06:43:30', NULL, NULL),
(957, 2, 'Employee', 'Membership Application Approved', '::1', 'User john.doe@example.com approved a new member in the database', NULL, '2025-04-25 06:43:54', NULL, '2025-04-25 06:43:54', NULL, NULL),
(958, 112, 'Employee', 'Membership Application Approved', '::1', 'User cbd-coop@gmail.com approved a new member in the database', NULL, '2025-04-25 06:44:26', NULL, '2025-04-25 06:44:26', NULL, NULL),
(959, 130, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-04-25 06:45:09', NULL, '2025-04-25 06:45:09', NULL, NULL),
(960, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 06:46:34', NULL, '2025-04-25 06:46:34', NULL, NULL),
(961, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-25 06:48:00', NULL, '2025-04-25 06:48:00', NULL, NULL),
(962, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-04-25 06:48:18', NULL, '2025-04-25 06:48:18', NULL, NULL),
(963, 130, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-25 06:48:59', NULL, '2025-04-25 06:48:59', NULL, NULL),
(964, 130, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-25 06:49:15', NULL, '2025-04-25 06:49:15', NULL, NULL),
(965, 130, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-04-25 06:49:41', NULL, '2025-04-25 06:49:41', NULL, NULL),
(966, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 06:50:47', NULL, '2025-04-25 06:50:47', NULL, NULL),
(967, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 06:51:01', NULL, '2025-04-25 06:51:01', NULL, NULL),
(968, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 06:51:14', NULL, '2025-04-25 06:51:14', NULL, NULL),
(969, 130, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-04-25 07:57:31', NULL, '2025-04-25 07:57:31', NULL, NULL),
(970, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-04-25 07:58:13', NULL, '2025-04-25 07:58:13', NULL, NULL),
(971, 132, 'User', 'Generated An Invoice', '::1', 'User kath1234@mailinator.com Generated an Invoice for membership', NULL, '2025-04-28 03:22:00', NULL, '2025-04-28 03:22:00', NULL, NULL),
(972, 132, 'Employee', 'Generated an Invoice', '::1', 'User kath1234@mailinator.comGenerated an invoice for Initial Capital share', NULL, '2025-04-28 03:22:16', NULL, '2025-04-28 03:22:16', NULL, NULL),
(973, 132, 'User', 'Payment Initiated', '::1', 'User kath1234@mailinator.com Generated an Invoice for membership', NULL, '2025-04-28 05:23:02', NULL, '2025-04-28 05:23:02', NULL, NULL),
(974, 132, 'User', 'Generated An Invoice', '::1', 'User kath1234@mailinator.com Generated an Invoice for membership', NULL, '2025-04-30 02:12:17', NULL, '2025-04-30 02:12:17', NULL, NULL),
(975, 132, 'Employee', 'Generated an Invoice', '::1', 'User kath1234@mailinator.comGenerated an invoice for Initial Capital share', NULL, '2025-04-30 02:12:36', NULL, '2025-04-30 02:12:36', NULL, NULL),
(976, 132, 'User', 'Generated An Invoice', '::1', 'User kath1234@mailinator.com Generated an Invoice for membership', NULL, '2025-04-30 06:58:36', NULL, '2025-04-30 06:58:36', NULL, NULL),
(977, 132, 'Employee', 'Generated an Invoice', '::1', 'User kath1234@mailinator.comGenerated an invoice for Initial Capital share', NULL, '2025-04-30 07:17:06', NULL, '2025-04-30 07:17:06', NULL, NULL),
(978, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-02 03:47:22', NULL, '2025-05-02 03:47:22', NULL, NULL),
(979, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-02 03:47:44', NULL, '2025-05-02 03:47:44', NULL, NULL),
(980, 2, 'Employee', 'Membership Application Approved', '::1', 'User john.doe@example.com approved a new member in the database', NULL, '2025-05-02 03:48:26', NULL, '2025-05-02 03:48:26', NULL, NULL),
(981, 112, 'Employee', 'Membership Application Approved', '::1', 'User cbd-coop@gmail.com approved a new member in the database', NULL, '2025-05-02 03:48:42', NULL, '2025-05-02 03:48:42', NULL, NULL),
(982, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-02 04:00:48', NULL, '2025-05-02 04:00:48', NULL, NULL),
(983, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-02 04:00:54', NULL, '2025-05-02 04:00:54', NULL, NULL),
(984, 132, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-05-02 04:01:36', NULL, '2025-05-02 04:01:36', NULL, NULL),
(985, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-02 04:02:04', NULL, '2025-05-02 04:02:04', NULL, NULL),
(986, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-02 04:26:32', NULL, '2025-05-02 04:26:32', NULL, NULL),
(987, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-02 04:26:38', NULL, '2025-05-02 04:26:38', NULL, NULL),
(988, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-02 04:26:45', NULL, '2025-05-02 04:26:45', NULL, NULL),
(989, 91, 'Loan Officer', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-05-02 04:27:33', NULL, '2025-05-02 04:27:33', NULL, NULL),
(990, 112, 'Coop Manager', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-05-02 04:27:55', NULL, '2025-05-02 04:27:55', NULL, NULL),
(991, 132, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-05-02 04:28:41', NULL, '2025-05-02 04:28:41', NULL, NULL),
(992, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-02 04:30:39', NULL, '2025-05-02 04:30:39', NULL, NULL),
(993, 132, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-05-02 04:31:32', NULL, '2025-05-02 04:31:32', NULL, NULL),
(994, 132, 'Member', 'User Payment Initiated', '::1', 'User sysadminInitiate loan repayment', NULL, '2025-05-02 04:31:43', NULL, '2025-05-02 04:31:43', NULL, NULL),
(995, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-02 04:32:06', NULL, '2025-05-02 04:32:06', NULL, NULL),
(996, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-02 04:32:12', NULL, '2025-05-02 04:32:12', NULL, NULL),
(997, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-06 00:42:39', NULL, '2025-05-06 00:42:39', NULL, NULL),
(998, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-06 00:42:45', NULL, '2025-05-06 00:42:45', NULL, NULL),
(999, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-06 00:44:00', NULL, '2025-05-06 00:44:00', NULL, NULL),
(1000, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-06 04:01:33', NULL, '2025-05-06 04:01:33', NULL, NULL),
(1001, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-06 04:01:44', NULL, '2025-05-06 04:01:44', NULL, NULL),
(1002, 2, 'Employee', 'Membership Application Approved', '::1', 'User john.doe@example.com approved a new member in the database', NULL, '2025-05-06 04:03:07', NULL, '2025-05-06 04:03:07', NULL, NULL),
(1003, 112, 'Employee', 'Membership Application Approved', '::1', 'User cbd-coop@gmail.com approved a new member in the database', NULL, '2025-05-06 04:03:26', NULL, '2025-05-06 04:03:26', NULL, NULL),
(1004, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-06 05:01:03', NULL, '2025-05-06 05:01:03', NULL, NULL),
(1005, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-06 05:01:13', NULL, '2025-05-06 05:01:13', NULL, NULL),
(1006, 2, 'Employee', 'Membership Application Approved', '::1', 'User john.doe@example.com approved a new member in the database', NULL, '2025-05-06 05:01:34', NULL, '2025-05-06 05:01:34', NULL, NULL),
(1007, 112, 'Employee', 'Membership Application Approved', '::1', 'User cbd-coop@gmail.com approved a new member in the database', NULL, '2025-05-06 05:01:55', NULL, '2025-05-06 05:01:55', NULL, NULL),
(1008, 142, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-05-06 05:03:00', NULL, '2025-05-06 05:03:00', NULL, NULL),
(1009, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-06 05:03:34', NULL, '2025-05-06 05:03:34', NULL, NULL),
(1010, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-06 05:15:28', NULL, '2025-05-06 05:15:28', NULL, NULL),
(1011, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-06 05:15:38', NULL, '2025-05-06 05:15:38', NULL, NULL),
(1012, 2, 'Employee', 'Membership Application Approved', '::1', 'User john.doe@example.com approved a new member in the database', NULL, '2025-05-06 05:16:33', NULL, '2025-05-06 05:16:33', NULL, NULL),
(1013, 112, 'Employee', 'Membership Application Approved', '::1', 'User cbd-coop@gmail.com approved a new member in the database', NULL, '2025-05-06 05:16:47', NULL, '2025-05-06 05:16:47', NULL, NULL),
(1014, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-06 09:05:52', NULL, '2025-05-06 09:05:52', NULL, NULL),
(1015, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com generated an invoice for membership', NULL, '2025-05-06 09:06:00', NULL, '2025-05-06 09:06:00', NULL, NULL),
(1016, 2, 'Employee', 'Membership Application Approved', '::1', 'User john.doe@example.com approved a new member in the database', NULL, '2025-05-06 09:07:11', NULL, '2025-05-06 09:07:11', NULL, NULL),
(1017, 112, 'Employee', 'Membership Application Approved', '::1', 'User cbd-coop@gmail.com approved a new member in the database', NULL, '2025-05-06 09:07:28', NULL, '2025-05-06 09:07:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `notification_title` text NOT NULL,
  `message` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `read_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `user_id`, `notification_title`, `message`, `link`, `is_read`, `read_at`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(615, 33, 'New Online Payment Received!', 'Andrea Blatche submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/64', 0, NULL, 'andrea@gmail.com', '2025-01-28 05:48:34', NULL, '2025-01-28 05:48:34', NULL, NULL),
(616, 33, 'New Online Payment Received!', 'Andrea Blatche submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/64', 0, NULL, 'andrea@gmail.com', '2025-01-28 05:49:13', NULL, '2025-01-28 05:49:13', NULL, NULL),
(617, 2, 'New Information sheet received', 'Andrea Blatche submitted a membership information sheet form', '', 0, NULL, 'andrea@gmail.com', '2025-01-28 06:48:14', NULL, '2025-01-28 06:48:14', NULL, NULL),
(618, 33, 'New Online Payment Received!', 'Daniel Caesar submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/65', 0, NULL, 'danielC@gmail.com', '2025-01-30 02:00:37', NULL, '2025-01-30 02:00:37', NULL, NULL),
(619, 33, 'New Online Payment Received!', 'Daniel Caesar submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/65', 0, NULL, 'danielC@gmail.com', '2025-01-30 02:01:31', NULL, '2025-01-30 02:01:31', NULL, NULL),
(620, 2, 'New Information sheet received', 'Daniel Caesar submitted a membership information sheet form', '', 0, NULL, 'danielC@gmail.com', '2025-01-30 02:04:49', NULL, '2025-01-30 02:04:49', NULL, NULL),
(621, 33, 'New Online Payment Received!', 'Catherine Montefalco submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/75', 0, NULL, 'CM@gmail.com', '2025-02-06 06:42:17', NULL, '2025-02-06 06:42:17', NULL, NULL),
(622, 33, 'New Online Payment Received!', 'Catherine Montefalco submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/75', 0, NULL, 'CM@gmail.com', '2025-02-06 06:43:03', NULL, '2025-02-06 06:43:03', NULL, NULL),
(623, 33, 'New Online Payment Received!', 'Daniel Padilla submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/76', 0, NULL, 'danielPadilla@gmail.com', '2025-02-11 03:12:55', NULL, '2025-02-11 03:12:56', NULL, NULL),
(624, 33, 'New Online Payment Received!', 'Daniel Padilla submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/76', 0, NULL, 'danielPadilla@gmail.com', '2025-02-11 03:14:27', NULL, '2025-02-11 03:14:27', NULL, NULL),
(625, 2, 'New Information sheet received', 'Daniel Padilla submitted a membership information sheet form', '', 0, NULL, 'danielPadilla@gmail.com', '2025-02-11 03:16:14', NULL, '2025-02-11 03:16:14', NULL, NULL),
(626, 33, 'New Online Payment Received!', 'Kathrina Valdezco submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/77', 0, NULL, 'kathrinavaldezco553@gmail.com', '2025-02-11 05:45:47', NULL, '2025-02-11 05:45:48', NULL, NULL),
(627, 33, 'New Online Payment Received!', 'Kathrina Valdezco submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/77', 0, NULL, 'kathrinavaldezco553@gmail.com', '2025-02-11 05:47:05', NULL, '2025-02-11 05:47:05', NULL, NULL),
(628, 2, 'New Information sheet received', 'Kathrina Valdezco submitted a membership information sheet form', '', 0, NULL, 'kathrinavaldezco553@gmail.com', '2025-02-11 07:31:20', NULL, '2025-02-11 07:31:20', NULL, NULL),
(629, 33, 'New Online Payment Received!', 'Kathrina Valdezco submitted an online payment', NULL, 0, NULL, 'kathrinavaldezco553@gmail.com', '2025-02-12 01:12:09', NULL, '2025-02-12 01:12:09', NULL, NULL),
(630, 33, 'New Online Payment Received!', 'Jayson Derulo submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/78', 0, NULL, 'jd@gmail.com', '2025-02-13 08:23:39', NULL, '2025-02-13 08:23:39', NULL, NULL),
(631, 33, 'New Online Payment Received!', 'Jayson Derulo submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/78', 0, NULL, 'jd@gmail.com', '2025-02-13 08:42:48', NULL, '2025-02-13 08:42:48', NULL, NULL),
(632, 2, 'New Information sheet received', 'Jayson Derulo submitted a membership information sheet form', '', 0, NULL, 'jd@gmail.com', '2025-02-13 08:45:20', NULL, '2025-02-13 08:45:20', NULL, NULL),
(633, 33, 'New Online Payment Received!', 'Jayson Derulo submitted an online payment', NULL, 0, NULL, 'jd@gmail.com', '2025-02-13 08:52:31', NULL, '2025-02-13 08:52:31', NULL, NULL),
(634, 33, 'New Online Payment Received!', 'Dionela Oksihina submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/79', 0, NULL, 'Dayonela@gmail.com', '2025-02-14 01:26:05', NULL, '2025-02-14 01:26:05', NULL, NULL),
(635, 33, 'New Online Payment Received!', 'Dionela Oksihina submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/79', 0, NULL, 'Dayonela@gmail.com', '2025-02-14 01:26:47', NULL, '2025-02-14 01:26:48', NULL, NULL),
(636, 2, 'New Information sheet received', 'Dionela Oksihina submitted a membership information sheet form', '', 0, NULL, 'Dayonela@gmail.com', '2025-02-14 01:28:32', NULL, '2025-02-14 01:28:33', NULL, NULL),
(637, 33, 'New Online Payment Received!', 'Ralph Dumlao submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/80', 0, NULL, 'rdumalo89@gmail.com', '2025-02-14 07:37:49', NULL, '2025-02-14 07:37:49', NULL, NULL),
(638, 33, 'New Online Payment Received!', 'Ralph Dumlao submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/80', 0, NULL, 'rdumalo89@gmail.com', '2025-02-14 07:38:55', NULL, '2025-02-14 07:38:55', NULL, NULL),
(639, 2, 'New Information sheet received', 'Ralph Dumlao submitted a membership information sheet form', '', 0, NULL, 'rdumalo89@gmail.com', '2025-02-14 07:41:01', NULL, '2025-02-14 07:41:01', NULL, NULL),
(640, 33, 'New Online Payment Received!', 'Anna Marilag submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/81', 0, NULL, 'annaMarilag@gmail.com', '2025-02-17 08:10:20', NULL, '2025-02-17 08:10:20', NULL, NULL),
(641, 33, 'New Online Payment Received!', 'Maja Salvador submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/84', 0, NULL, 'maja_salvador@gmail.com', '2025-03-03 08:53:32', NULL, '2025-03-03 08:53:32', NULL, NULL),
(642, 33, 'New Online Payment Received!', 'Maja Salvador submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/84', 0, NULL, 'maja_salvador@gmail.com', '2025-03-03 08:54:17', NULL, '2025-03-03 08:54:17', NULL, NULL),
(643, 2, 'New Information sheet received', 'Maja Salvador submitted a membership information sheet form', '', 0, NULL, 'maja_salvador@gmail.com', '2025-03-03 08:56:03', NULL, '2025-03-03 08:56:03', NULL, NULL),
(644, 33, 'New Online Payment Received!', 'Maja Salvador submitted an online payment', NULL, 0, NULL, 'maja_salvador@gmail.com', '2025-03-05 00:54:33', NULL, '2025-03-05 00:54:33', NULL, NULL),
(645, 33, 'New Online Payment Received!', 'John  Cena submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/85', 0, NULL, 'john_cena@gmail.com', '2025-03-05 02:19:51', NULL, '2025-03-05 02:19:51', NULL, NULL),
(646, 33, 'New Online Payment Received!', 'John  Cena submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/85', 0, NULL, 'john_cena@gmail.com', '2025-03-05 02:20:37', NULL, '2025-03-05 02:20:37', NULL, NULL),
(647, 2, 'New Information sheet received', 'John  Cena submitted a membership information sheet form', '', 0, NULL, 'john_cena@gmail.com', '2025-03-05 02:21:37', NULL, '2025-03-05 02:21:37', NULL, NULL),
(648, 33, 'New Online Payment Received!', 'Erlinda Montemayor submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/86', 0, NULL, 'erlinda@gmail.com', '2025-03-05 07:31:22', NULL, '2025-03-05 07:31:22', NULL, NULL),
(649, 33, 'New Online Payment Received!', 'Erlinda Montemayor submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/86', 0, NULL, 'erlinda@gmail.com', '2025-03-05 07:32:06', NULL, '2025-03-05 07:32:06', NULL, NULL),
(650, 2, 'New Information sheet received', 'Erlinda Montemayor submitted a membership information sheet form', '', 0, NULL, 'erlinda@gmail.com', '2025-03-05 07:33:11', NULL, '2025-03-05 07:33:11', NULL, NULL),
(651, 33, 'New Online Payment Received!', 'Diane  Nguyen submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/87', 0, NULL, 'dinae@gmail.com', '2025-03-06 06:06:57', NULL, '2025-03-06 06:06:57', NULL, NULL),
(652, 33, 'New Online Payment Received!', 'Diane  Nguyen submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/87', 0, NULL, 'dinae@gmail.com', '2025-03-06 06:07:38', NULL, '2025-03-06 06:07:38', NULL, NULL),
(653, 2, 'New Information sheet received', 'Diane  Nguyen submitted a membership information sheet form', '', 0, NULL, 'dinae@gmail.com', '2025-03-06 06:08:44', NULL, '2025-03-06 06:08:44', NULL, NULL),
(654, 33, 'New Online Payment Received!', 'Bojack  Horseman submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/88', 0, NULL, 'bj@gmail.com', '2025-03-11 06:28:46', NULL, '2025-03-11 06:28:46', NULL, NULL),
(655, 33, 'New Online Payment Received!', 'Bojack  Horseman submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/88', 0, NULL, 'bj@gmail.com', '2025-03-11 06:29:32', NULL, '2025-03-11 06:29:32', NULL, NULL),
(656, 2, 'New Information sheet received', 'Bojack  Horseman submitted a membership information sheet form', '', 0, NULL, 'bj@gmail.com', '2025-03-11 06:31:08', NULL, '2025-03-11 06:31:09', NULL, NULL),
(657, 33, 'New Online Payment Received!', 'Beatrice  Horseman submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/89', 0, NULL, 'bhorsman@gmail.com', '2025-03-13 00:31:29', NULL, '2025-03-13 00:31:29', NULL, NULL),
(658, 33, 'New Online Payment Received!', 'Beatrice  Horseman submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/89', 0, NULL, 'bhorsman@gmail.com', '2025-03-13 00:32:33', NULL, '2025-03-13 00:32:33', NULL, NULL),
(659, 2, 'New Information sheet received', 'Beatrice  Horseman submitted a membership information sheet form', '', 0, NULL, 'bhorsman@gmail.com', '2025-03-13 00:44:19', NULL, '2025-03-13 00:44:19', NULL, NULL),
(660, 33, 'New Online Payment Received!', 'Anna Keiting submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/91', 0, NULL, 'Ak@gmail.com', '2025-03-17 05:55:34', NULL, '2025-03-17 05:55:34', NULL, NULL),
(661, 33, 'New Online Payment Received!', 'Anna Keiting submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/91', 0, NULL, 'Ak@gmail.com', '2025-03-17 05:56:13', NULL, '2025-03-17 05:56:13', NULL, NULL),
(662, 2, 'New Information sheet received', 'Anna Keiting submitted a membership information sheet form', '', 0, NULL, 'Ak@gmail.com', '2025-03-17 05:58:11', NULL, '2025-03-17 05:58:11', NULL, NULL),
(663, 33, 'New Online Payment Received!', 'Hev Doe submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/93', 0, NULL, 'hev@gmail.com', '2025-03-20 07:51:29', NULL, '2025-03-20 07:51:29', NULL, NULL),
(664, 33, 'New Online Payment Received!', 'Hev Doe submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/93', 0, NULL, 'hev@gmail.com', '2025-03-20 07:52:01', NULL, '2025-03-20 07:52:01', NULL, NULL),
(665, 2, 'New Information sheet received', 'Hev Doe submitted a membership information sheet form', '', 0, NULL, 'hev@gmail.com', '2025-03-20 07:53:39', NULL, '2025-03-20 07:53:40', NULL, NULL),
(666, 33, 'New Online Payment Received!', 'Hev Doe submitted an online payment', NULL, 0, NULL, 'hev@gmail.com', '2025-03-20 07:59:12', NULL, '2025-03-20 07:59:12', NULL, NULL),
(667, 33, 'New Online Payment Received!', 'Hev Doe submitted an online payment', NULL, 0, NULL, 'hev@gmail.com', '2025-04-14 07:14:50', 'sysadmin', '2025-04-14 07:14:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_referrals`
--

CREATE TABLE `user_referrals` (
  `id` int NOT NULL,
  `from_user_id` int NOT NULL,
  `to_user_id` int DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('available','processing','approved','disapproved') DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_referrals`
--

INSERT INTO `user_referrals` (`id`, `from_user_id`, `to_user_id`, `code`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(7, 1, NULL, '36aa2a4b-5107-41b8-a7bb-2feac38e64d4', 'available', '2024-10-22 05:37:18', 'azoresmelmar@gmail.com', '2024-10-22 05:37:19', NULL, NULL, NULL),
(8, 3, 80, '5252db9c-94d9-4176-bd15-c0f693d5fac4', 'processing', '2024-10-28 03:18:22', 'jane@gmail.com', '2025-02-14 07:36:12', 'jane@gmail.com', NULL, NULL),
(13, 44, 76, 'f4e84a8d-40a2-47d0-8739-71d9385bab3f', 'processing', '2024-11-21 01:11:47', 'person@gmail.com', '2025-02-11 03:02:39', 'person@gmail.com', NULL, NULL),
(33, 5, NULL, 'c82adc5e-f819-40aa-bbba-4e6d8033d513', 'available', '2024-12-23 02:52:25', 'sysadmin', '2024-12-23 02:52:25', NULL, NULL, NULL),
(34, 5, NULL, 'b01dd8c2-aa47-477f-b68b-b419cb912e5c', 'available', '2024-12-23 02:53:20', 'sysadmin', '2024-12-23 02:53:20', NULL, NULL, NULL),
(35, 5, NULL, '51ba20da-aaf2-40b3-b98d-8c660a802b47', 'available', '2024-12-23 02:53:29', 'sysadmin', '2024-12-23 02:53:29', NULL, NULL, NULL),
(36, 5, NULL, 'ba2a1324-a375-44ec-afc7-c1a439927a1b', 'available', '2024-12-23 02:54:25', 'sysadmin', '2024-12-23 02:54:25', NULL, NULL, NULL),
(37, 5, NULL, 'e08ed44a-0c05-4bfd-9d63-fc12a1fbd7f5', 'available', '2024-12-23 02:54:54', 'sysadmin', '2024-12-23 02:54:54', NULL, NULL, NULL),
(38, 5, NULL, '119b6dc6-c88b-47f2-9701-1344237c012a', 'available', '2024-12-23 02:55:22', 'sysadmin', '2024-12-23 02:55:22', NULL, NULL, NULL),
(39, 5, NULL, '047260b7-7c11-4593-ad00-36137e8c8d1f', 'available', '2024-12-23 02:55:51', 'sysadmin', '2024-12-23 02:55:51', NULL, NULL, NULL),
(40, 5, NULL, 'e417d86f-a4a4-4765-bdbc-c3466dffc631', 'available', '2024-12-23 02:56:11', 'sysadmin', '2024-12-23 02:56:11', NULL, NULL, NULL),
(41, 5, NULL, 'fc46f056-4916-4737-ab96-1fcc917f6af3', 'available', '2024-12-23 02:56:22', 'sysadmin', '2024-12-23 02:56:22', NULL, NULL, NULL),
(42, 5, NULL, '0ec29d96-0d30-43ac-b607-b7ad54503f22', 'available', '2024-12-23 02:57:00', 'sysadmin', '2024-12-23 02:57:00', NULL, NULL, NULL),
(43, 5, NULL, '16b63519-09bc-48dc-9bc9-2f5f288f6dea', 'available', '2024-12-23 02:57:34', 'sysadmin', '2024-12-23 02:57:34', NULL, NULL, NULL),
(44, 5, NULL, '9159742a-bd2d-4d33-b2ed-1396891db2a3', 'available', '2024-12-23 02:57:52', 'sysadmin', '2024-12-23 02:57:52', NULL, NULL, NULL),
(45, 5, NULL, '2ff37132-5c0b-46d4-a414-7b09d98909e1', 'available', '2024-12-23 02:58:31', 'sysadmin', '2024-12-23 02:58:31', NULL, NULL, NULL),
(46, 5, NULL, 'd51bdfcc-1a99-4010-86bf-c8245814d39c', 'available', '2024-12-23 02:58:44', 'sysadmin', '2024-12-23 02:58:44', NULL, NULL, NULL),
(47, 5, NULL, '288faf94-7c4c-40f0-89f9-f90c591aea75', 'available', '2024-12-23 02:59:41', 'sysadmin', '2024-12-23 02:59:41', NULL, NULL, NULL),
(48, 5, NULL, '36ef013e-0e33-45be-86eb-ebce18c8233f', 'available', '2024-12-23 03:02:33', 'sysadmin', '2024-12-23 03:02:33', NULL, NULL, NULL),
(49, 5, NULL, '763477ce-9cac-49cb-92ec-744e6bcc26d5', 'available', '2024-12-23 03:02:52', 'sysadmin', '2024-12-23 03:02:52', NULL, NULL, NULL),
(50, 5, NULL, 'dabcc6f2-0d92-4e47-af82-5e44914c5dfa', 'available', '2024-12-23 03:04:12', 'sysadmin', '2024-12-23 03:04:12', NULL, NULL, NULL),
(51, 5, NULL, 'ab2504f8-7a6f-4c34-be87-93219b6173c6', 'available', '2024-12-23 03:05:26', 'sysadmin', '2024-12-23 03:05:26', NULL, NULL, NULL),
(52, 5, NULL, '776bc58d-3526-4c14-82cc-b936ea625bb3', 'available', '2024-12-23 03:06:12', 'sysadmin', '2024-12-23 03:06:12', NULL, NULL, NULL),
(53, 5, NULL, '014d6c39-05d9-4e7b-b45e-d86315190a8a', 'available', '2024-12-23 03:07:10', 'sysadmin', '2024-12-23 03:07:11', NULL, NULL, NULL),
(54, 5, NULL, '5fe50c99-bf94-487e-8221-d7adc93b40b9', 'available', '2024-12-23 03:07:32', 'sysadmin', '2024-12-23 03:07:32', NULL, NULL, NULL),
(73, 76, 77, 'b69f52d6-f170-4a6b-abe5-2b6a2f6b1662', 'processing', '2025-02-11 03:16:14', 'danielPadilla@gmail.com', '2025-02-11 05:44:48', 'danielPadilla@gmail.com', NULL, NULL),
(74, 77, 78, '886cbea2-a6d9-452d-ab3c-561cdaff05ec', 'processing', '2025-02-11 07:31:20', 'kathrinavaldezco553@gmail.com', '2025-02-13 08:19:05', 'kathrinavaldezco553@gmail.com', NULL, NULL),
(75, 78, 79, '35dc3eec-e6b4-47d2-8137-a7d4c1799e5e', 'processing', '2025-02-13 08:45:20', 'jd@gmail.com', '2025-02-14 01:24:28', 'jd@gmail.com', NULL, NULL),
(76, 79, 81, '889be61c-228f-4f46-be98-1367ecfd129b', 'processing', '2025-02-14 01:28:32', 'Dayonela@gmail.com', '2025-02-17 08:08:28', 'Dayonela@gmail.com', NULL, NULL),
(77, 80, NULL, '11c6416b-9268-4d58-93ce-df20baaa3a1c', 'available', '2025-02-14 07:41:01', 'rdumalo89@gmail.com', '2025-02-14 07:41:01', NULL, NULL, NULL),
(78, 79, 84, '719290bc-097a-451a-a4bb-1824e8ea073c', 'processing', '2025-03-03 02:34:11', 'sysadmin', '2025-03-03 07:27:47', 'Dayonela@gmail.com', NULL, NULL),
(79, 84, 85, 'd09596db-9a9d-4295-a3c7-fdc5670eab1e', 'processing', '2025-03-03 08:56:03', 'maja_salvador@gmail.com', '2025-03-04 01:29:29', 'maja_salvador@gmail.com', NULL, NULL),
(80, 85, NULL, 'f1ab74b7-f573-4536-b474-5eb5cc8b16f9', 'available', '2025-03-05 02:21:37', 'john_cena@gmail.com', '2025-03-05 02:21:37', NULL, NULL, NULL),
(81, 84, 86, 'fb083131-ccc0-474e-aef7-9b73f4c9f7c9', 'processing', '2025-03-05 07:26:24', 'sysadmin', '2025-03-05 07:27:01', 'maja_salvador@gmail.com', NULL, NULL),
(82, 86, 87, '5a19f40d-6185-4674-8f81-f35c9e93c42f', 'processing', '2025-03-05 07:33:11', 'erlinda@gmail.com', '2025-03-06 06:06:00', 'erlinda@gmail.com', NULL, NULL),
(83, 87, 88, '32a9f338-cda3-4ff2-b6b9-ec628ba0f588', 'processing', '2025-03-06 06:08:44', 'dinae@gmail.com', '2025-03-11 06:27:32', 'dinae@gmail.com', NULL, NULL),
(84, 88, 90, 'bd3c5ed4-0889-4646-9a87-a8a9661efb9c', 'processing', '2025-03-11 06:31:08', 'bj@gmail.com', '2025-03-13 01:56:00', 'bj@gmail.com', NULL, NULL),
(85, 87, 89, 'ae28bf84-4684-4354-8132-73944ec4cabf', 'processing', '2025-03-12 06:59:06', 'sysadmin', '2025-03-12 07:01:55', 'dinae@gmail.com', NULL, NULL),
(86, 89, 91, '150f74ad-e320-47a7-8b5d-acf7e49ee72e', 'processing', '2025-03-13 00:44:19', 'bhorsman@gmail.com', '2025-03-17 05:54:26', 'bhorsman@gmail.com', NULL, NULL),
(87, 91, 92, '18ed319d-02b5-4bad-a5b4-897638c19186', 'processing', '2025-03-17 05:58:11', 'Ak@gmail.com', '2025-03-19 06:44:36', 'Ak@gmail.com', NULL, NULL),
(88, 91, 93, '0f702d61-0581-4a13-97a4-7649b944b34b', 'processing', '2025-03-20 07:49:56', 'sysadmin', '2025-03-20 07:50:25', 'Ak@gmail.com', NULL, NULL),
(89, 93, 110, '4f872e40-3577-4c07-bc91-c61d42fa381f', 'processing', '2025-03-20 07:53:39', 'hev@gmail.com', '2025-04-02 01:58:09', 'hev@gmail.com', NULL, NULL),
(90, 93, 111, '54c26fe3-d15e-4885-ae7c-0aeadf1bca26', 'processing', '2025-04-14 00:33:55', 'sysadmin', '2025-04-14 00:37:53', 'hev@gmail.com', NULL, NULL),
(91, 77, 112, '1cf7bd76-0cd4-43ab-914d-2975bc017881', 'processing', '2025-04-14 18:35:03', 'sysadmin', '2025-04-14 18:36:24', 'kathrinavaldezco553@gmail.com', NULL, NULL),
(92, 111, NULL, '1a991791-391a-4f6b-84eb-e63b65879fa5', 'available', '2025-04-15 00:16:37', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 00:16:38', NULL, NULL, NULL),
(93, 113, NULL, '43814705-6026-4b4e-8893-5cde674db54a', 'available', '2025-04-15 05:45:11', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 05:45:11', NULL, NULL, NULL),
(94, 77, 114, '851181da-c16e-42d5-9837-dd8902a911b0', 'processing', '2025-04-15 05:58:47', 'sysadmin', '2025-04-15 07:15:55', 'sysadmin', NULL, NULL),
(95, 87, 115, '94dea307-e29a-449c-a7d7-9f027a08a2e0', 'processing', '2025-04-15 06:18:21', 'sysadmin', '2025-04-15 07:17:38', 'sysadmin', NULL, NULL),
(96, 87, 113, '6f426846-445f-444a-8202-d92d61fdb1aa', 'processing', '2025-04-15 06:29:08', 'sysadmin', '2025-04-15 06:31:13', 'dinae@gmail.com', NULL, NULL),
(97, 113, NULL, '61ee081e-de9f-4401-8038-33d053ad5f12', 'available', '2025-04-15 06:52:04', 'kathvaldezcoronquillo@gmail.com', '2025-04-15 06:52:05', NULL, NULL, NULL),
(98, 114, NULL, 'c07c226f-0e36-446b-b879-d294e169a3b5', 'available', '2025-04-15 07:26:38', 'pamelavivientballesteros@gmail.com', '2025-04-15 07:26:38', NULL, NULL, NULL),
(99, 115, NULL, 'bd98bdbb-a3b7-4d2b-b864-22ad867d92c4', 'available', '2025-04-15 07:46:49', 'jeremy23deguzman@gmail.com', '2025-04-15 07:46:50', NULL, NULL, NULL),
(100, 113, NULL, '4e40251b-67dd-46c4-8504-a437b7427947', 'available', '2025-04-21 02:19:56', 'kathvaldezcoronquillo@gmail.com', '2025-04-21 02:19:56', NULL, NULL, NULL),
(101, 77, 125, '9d7c345f-b1e3-4e7c-8c19-f7930c2d1f37', 'processing', '2025-04-23 07:53:15', 'sysadmin', '2025-04-23 08:02:52', 'kathrinavaldezco553@gmail.com', NULL, NULL),
(102, 125, NULL, '498025a3-ee7f-4932-97b0-8051cb6c7352', 'available', '2025-04-23 08:07:59', 'kathvaldezcoronquillo@gmail.com', '2025-04-23 08:08:00', NULL, NULL, NULL),
(103, 89, 130, 'b5fd62f6-2ac7-43e8-bb36-6b341aa55bec', 'processing', '2025-04-25 06:27:00', 'sysadmin', '2025-04-25 06:39:58', 'bhorsman@gmail.com', NULL, NULL),
(104, 130, 132, '04d02d68-870c-4205-9cbd-c10df2b7460a', 'processing', '2025-04-25 06:42:53', 'gtest8833@gmail.com', '2025-04-28 02:53:18', 'gtest8833@gmail.com', NULL, NULL),
(105, 132, 142, '9e492b7b-6bb2-4fe5-9c3c-8f5ab79980bf', 'processing', '2025-04-29 08:04:01', 'kath1234@mailinator.com', '2025-05-06 04:58:02', 'kath1234@mailinator.com', NULL, NULL),
(106, 132, 145, 'f0a1ae7a-b7c8-4fe8-97ce-925daa49cc5f', 'processing', '2025-04-30 00:39:27', 'kath1234@mailinator.com', '2025-05-06 05:28:57', 'kath1234@mailinator.com', NULL, NULL),
(107, 132, NULL, '8fd59832-5420-4be4-820c-9f6c5ebfb416', 'available', '2025-04-30 03:21:37', 'kath1234@mailinator.com', '2025-04-30 03:21:37', NULL, NULL, NULL),
(108, 132, NULL, '2edae92b-1908-4cbe-b086-2fb6d837a531', 'available', '2025-04-30 03:27:36', 'kath1234@mailinator.com', '2025-04-30 03:27:36', NULL, NULL, NULL),
(109, 132, NULL, 'e4e12573-65f2-4d97-9bf1-28ddbf4104bd', 'available', '2025-04-30 03:30:58', 'kath1234@mailinator.com', '2025-04-30 03:30:59', NULL, NULL, NULL),
(110, 132, NULL, '68b599fc-90f5-47b1-b895-168754248f40', 'available', '2025-04-30 03:36:09', 'kath1234@mailinator.com', '2025-04-30 03:36:09', NULL, NULL, NULL),
(111, 132, NULL, 'e9337f17-ca97-4dcc-be03-a086793557fb', 'available', '2025-04-30 03:55:28', 'kath1234@mailinator.com', '2025-04-30 03:55:29', NULL, NULL, NULL),
(112, 132, NULL, 'ec12fd72-5a04-4c40-8c3e-6dd9cd492fcd', 'available', '2025-04-30 06:18:10', 'kath1234@mailinator.com', '2025-04-30 06:18:10', NULL, NULL, NULL),
(113, 132, NULL, 'e32e8d03-2951-45bf-9a47-ff976e673959', 'available', '2025-05-02 03:34:22', 'kath1234@mailinator.com', '2025-05-02 03:34:22', NULL, NULL, NULL),
(114, 130, 139, '29e394ec-fd16-4a76-a18c-6d137cb5c6b7', 'processing', '2025-05-05 08:24:31', 'sysadmin', '2025-05-05 08:46:06', 'gtest8833@gmail.com', NULL, NULL),
(115, 139, NULL, '1123712d-b036-40ad-809b-f2980de0c531', 'available', '2025-05-06 00:37:49', 'kath-test@mailinator.com', '2025-05-06 00:37:49', NULL, NULL, NULL),
(116, 132, NULL, 'ecf4acc3-1fc8-4e94-bf30-ebe2edc638fa', 'available', '2025-05-06 03:14:28', 'kath1234@mailinator.com', '2025-05-06 03:14:28', NULL, NULL, NULL),
(117, 132, NULL, '53ae43ce-004e-4a36-88b4-f9cb62064150', 'available', '2025-05-06 03:20:55', 'kath1234@mailinator.com', '2025-05-06 03:20:55', NULL, NULL, NULL),
(118, 132, NULL, '46dcdeb9-60a8-498c-892d-87e26f636fa4', 'available', '2025-05-06 04:00:23', 'kath1234@mailinator.com', '2025-05-06 04:00:23', NULL, NULL, NULL),
(119, 142, 144, '1f010f1f-378f-4073-9783-57673ca6fe6e', 'processing', '2025-05-06 05:00:20', 'kathrina123456@mailinator.com', '2025-05-06 05:12:18', 'kathrina123456@mailinator.com', NULL, NULL),
(120, 144, NULL, 'e0b5f952-737d-47bc-8d81-6b3048d96994', 'available', '2025-05-06 05:15:00', 'kath1234567@mailinator.com', '2025-05-06 05:15:00', NULL, NULL, NULL),
(121, 145, NULL, '69961ae0-e8cb-4d26-abcb-6810c2171442', 'available', '2025-05-06 08:59:17', 'kath12345678@mailinator.com', '2025-05-06 08:59:17', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `role_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(4, 2, 17, '2025-02-10 01:30:56', 'ADMIN', '2025-04-14 01:32:12', 'john.doe@example.com', NULL, NULL),
(7, 33, 9, '2025-02-10 07:05:26', 'john.doe@example.com', '2025-02-10 07:05:27', NULL, NULL, NULL),
(8, 76, 8, '2025-02-11 03:02:25', NULL, '2025-02-11 05:29:31', 'john.doe@example.com', NULL, NULL),
(9, 77, 8, '2025-02-11 05:37:48', NULL, '2025-02-11 07:31:56', 'john.doe@example.com', NULL, NULL),
(10, 78, 8, '2025-02-13 08:18:51', NULL, '2025-02-13 08:46:26', 'john.doe@example.com', NULL, NULL),
(11, 79, 8, '2025-02-14 01:24:05', NULL, '2025-02-14 01:30:10', 'john.doe@example.com', NULL, NULL),
(12, 80, 8, '2025-02-14 07:35:29', NULL, '2025-02-14 07:42:51', 'john.doe@example.com', NULL, NULL),
(13, 81, 7, '2025-02-17 08:08:17', NULL, '2025-02-17 08:08:17', NULL, NULL, NULL),
(14, 83, 7, '2025-03-03 02:36:06', NULL, '2025-03-03 02:36:06', NULL, NULL, NULL),
(15, 84, 8, '2025-03-03 02:52:13', NULL, '2025-03-03 09:09:56', 'john.doe@example.com', NULL, NULL),
(16, 85, 8, '2025-03-04 01:28:54', NULL, '2025-03-05 02:22:23', 'john.doe@example.com', NULL, NULL),
(17, 86, 8, '2025-03-05 07:26:54', NULL, '2025-03-05 08:53:21', 'john.doe@example.com', NULL, NULL),
(18, 87, 8, '2025-03-06 06:05:54', NULL, '2025-03-06 06:10:22', 'john.doe@example.com', NULL, NULL),
(19, 88, 8, '2025-03-11 06:27:25', NULL, '2025-03-11 06:31:31', 'john.doe@example.com', NULL, NULL),
(20, 89, 8, '2025-03-12 07:01:46', NULL, '2025-03-13 00:45:37', 'john.doe@example.com', NULL, NULL),
(21, 90, 7, '2025-03-13 01:55:39', NULL, '2025-03-13 01:55:39', NULL, NULL, NULL),
(22, 91, 18, '2025-03-17 05:54:08', NULL, '2025-04-04 08:33:05', 'john.doe@example.com', NULL, NULL),
(23, 92, 18, '2025-03-19 06:44:29', NULL, '2025-04-07 00:38:17', 'john.doe@example.com', NULL, NULL),
(24, 93, 8, '2025-03-20 07:50:20', NULL, '2025-03-20 07:57:34', 'john.doe@example.com', NULL, NULL),
(41, 110, 17, '2025-04-02 01:57:46', NULL, '2025-04-07 00:36:36', 'john.doe@example.com', NULL, NULL),
(43, 111, 8, '2025-04-14 00:36:29', NULL, '2025-04-15 00:27:29', 'cbd-coop@gmail.com', NULL, NULL),
(44, 112, 19, '2025-04-14 18:35:36', NULL, '2025-04-14 18:40:08', 'john.doe@example.com', NULL, NULL),
(45, 113, 8, '2025-04-15 03:00:41', NULL, '2025-04-21 02:31:15', 'cbd-coop@gmail.com', NULL, NULL),
(46, 114, 8, '2025-04-15 07:15:30', NULL, '2025-04-15 07:36:39', 'cbd-coop@gmail.com', NULL, NULL),
(47, 115, 8, '2025-04-15 07:15:39', NULL, '2025-04-15 08:43:14', 'cbd-coop@gmail.com', NULL, NULL),
(57, 125, 8, '2025-04-23 08:01:30', NULL, '2025-04-23 08:23:54', 'cbd-coop@gmail.com', NULL, NULL),
(61, 129, 7, '2025-04-25 06:36:22', NULL, '2025-04-25 06:36:22', NULL, NULL, NULL),
(62, 130, 8, '2025-04-25 06:38:33', NULL, '2025-04-25 06:44:25', 'cbd-coop@gmail.com', NULL, NULL),
(63, 131, 7, '2025-04-28 00:45:46', NULL, '2025-04-28 00:45:46', NULL, NULL, NULL),
(64, 132, 8, '2025-04-28 02:46:23', NULL, '2025-05-06 04:03:26', 'cbd-coop@gmail.com', NULL, NULL),
(71, 139, 7, '2025-05-05 08:41:06', NULL, '2025-05-05 08:41:06', NULL, NULL, NULL),
(72, 140, 7, '2025-05-06 04:39:13', NULL, '2025-05-06 04:39:13', NULL, NULL, NULL),
(73, 141, 7, '2025-05-06 04:44:28', NULL, '2025-05-06 04:44:28', NULL, NULL, NULL),
(74, 142, 8, '2025-05-06 04:56:33', NULL, '2025-05-06 05:01:55', 'cbd-coop@gmail.com', NULL, NULL),
(75, 143, 7, '2025-05-06 05:08:52', NULL, '2025-05-06 05:08:52', NULL, NULL, NULL),
(76, 144, 8, '2025-05-06 05:10:46', NULL, '2025-05-06 05:16:47', 'cbd-coop@gmail.com', NULL, NULL),
(77, 145, 8, '2025-05-06 05:26:32', NULL, '2025-05-06 09:07:28', 'cbd-coop@gmail.com', NULL, NULL),
(78, 146, 7, '2025-05-06 09:28:07', NULL, '2025-05-06 09:28:07', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_accounts_id` (`cash_accounts_id`);

--
-- Indexes for table `billing_address`
--
ALTER TABLE `billing_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `calendars`
--
ALTER TABLE `calendars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `capital_contributions`
--
ALTER TABLE `capital_contributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `cap_share_account_dues`
--
ALTER TABLE `cap_share_account_dues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cap_share_account_dues_ibfk_1` (`capital_contribution_id`);

--
-- Indexes for table `cashiering_invoice`
--
ALTER TABLE `cashiering_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `billing_address_id` (`billing_address_id`),
  ADD KEY `transaction_category_id` (`transaction_category_id`);

--
-- Indexes for table `cash_accounts`
--
ALTER TABLE `cash_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_lvl_3_id` (`cash_lvl_3_id`);

--
-- Indexes for table `cash_lvl_1`
--
ALTER TABLE `cash_lvl_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_lvl_2`
--
ALTER TABLE `cash_lvl_2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_lvl_1_id` (`cash_lvl_1_id`);

--
-- Indexes for table `cash_lvl_3`
--
ALTER TABLE `cash_lvl_3`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_lvl_2_id` (`cash_lvl_2_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calendar_id` (`calendar_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `financial_accounts`
--
ALTER TABLE `financial_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `method_id` (`method_id`);

--
-- Indexes for table `investment_property_types`
--
ALTER TABLE `investment_property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_particulars`
--
ALTER TABLE `invoice_particulars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cashiering_invoice_id` (`cashiering_invoice_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_account_id` (`cash_account_id`),
  ADD KEY `transaction_category_id` (`transaction_category_id`),
  ADD KEY `transaction_category_id_2` (`transaction_category_id`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `transaction_cash_account_id` (`transaction_cash_account_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `loan_repayment_schedules`
--
ALTER TABLE `loan_repayment_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_id` (`loan_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `member_balance`
--
ALTER TABLE `member_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_member_balance_user` (`user_id`);

--
-- Indexes for table `member_beneficiaries`
--
ALTER TABLE `member_beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member_educ_backgrounds`
--
ALTER TABLE `member_educ_backgrounds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member_work_backgrounds`
--
ALTER TABLE `member_work_backgrounds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `official_receipts`
--
ALTER TABLE `official_receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `billing_address_id` (`billing_address_id`),
  ADD KEY `transaction_category_id_ibfk3` (`transaction_category_id`);

--
-- Indexes for table `or_particulars`
--
ALTER TABLE `or_particulars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `receipt_id` (`receipt_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_account_map`
--
ALTER TABLE `payment_account_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_options_id` (`payment_options_id`),
  ADD KEY `account_map_transaction_type_id_ibfk_2` (`transaction_account_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_option_id_ibfk_1` (`account_type_id`);

--
-- Indexes for table `payment_options`
--
ALTER TABLE `payment_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_accounts_id` (`cash_accounts_id`);

--
-- Indexes for table `payment_records`
--
ALTER TABLE `payment_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_particulars_id` (`invoice_particulars_id`),
  ADD KEY `or_id` (`or_particulars_id`),
  ADD KEY `payment_methods_id` (`payment_method_id`),
  ADD KEY `transaciton_category_id` (`transaction_category_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `permissions_id` (`permissions_id`);

--
-- Indexes for table `transaction_category`
--
ALTER TABLE `transaction_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_types_cash_account`
--
ALTER TABLE `transaction_types_cash_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_type_id` (`transaction_type_id`),
  ADD KEY `cash_account_id` (`cash_account_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_referrals`
--
ALTER TABLE `user_referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_permissions_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `billing_address`
--
ALTER TABLE `billing_address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `calendars`
--
ALTER TABLE `calendars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `capital_contributions`
--
ALTER TABLE `capital_contributions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `cap_share_account_dues`
--
ALTER TABLE `cap_share_account_dues`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1157;

--
-- AUTO_INCREMENT for table `cashiering_invoice`
--
ALTER TABLE `cashiering_invoice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1114;

--
-- AUTO_INCREMENT for table `cash_accounts`
--
ALTER TABLE `cash_accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cash_lvl_1`
--
ALTER TABLE `cash_lvl_1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cash_lvl_2`
--
ALTER TABLE `cash_lvl_2`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cash_lvl_3`
--
ALTER TABLE `cash_lvl_3`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_attendees`
--
ALTER TABLE `event_attendees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `financial_accounts`
--
ALTER TABLE `financial_accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `investment_property_types`
--
ALTER TABLE `investment_property_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_particulars`
--
ALTER TABLE `invoice_particulars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1074;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `loan_repayment_schedules`
--
ALTER TABLE `loan_repayment_schedules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `member_balance`
--
ALTER TABLE `member_balance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `member_beneficiaries`
--
ALTER TABLE `member_beneficiaries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `member_educ_backgrounds`
--
ALTER TABLE `member_educ_backgrounds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `member_work_backgrounds`
--
ALTER TABLE `member_work_backgrounds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `official_receipts`
--
ALTER TABLE `official_receipts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1063;

--
-- AUTO_INCREMENT for table `or_particulars`
--
ALTER TABLE `or_particulars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=966;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_account_map`
--
ALTER TABLE `payment_account_map`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payment_options`
--
ALTER TABLE `payment_options`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_records`
--
ALTER TABLE `payment_records`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1050;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `transaction_category`
--
ALTER TABLE `transaction_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction_types_cash_account`
--
ALTER TABLE `transaction_types_cash_account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=657;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1018;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=668;

--
-- AUTO_INCREMENT for table `user_referrals`
--
ALTER TABLE `user_referrals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing_address`
--
ALTER TABLE `billing_address`
  ADD CONSTRAINT `user_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `calendars`
--
ALTER TABLE `calendars`
  ADD CONSTRAINT `calendars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `capital_contributions`
--
ALTER TABLE `capital_contributions`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cap_share_account_dues`
--
ALTER TABLE `cap_share_account_dues`
  ADD CONSTRAINT `cap_share_account_dues_ibfk_1` FOREIGN KEY (`capital_contribution_id`) REFERENCES `capital_contributions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cashiering_invoice`
--
ALTER TABLE `cashiering_invoice`
  ADD CONSTRAINT `billing_id_ibfk_1` FOREIGN KEY (`billing_address_id`) REFERENCES `billing_address` (`id`),
  ADD CONSTRAINT `cashiering_user_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_type_id_ibk_3` FOREIGN KEY (`transaction_category_id`) REFERENCES `transaction_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cash_accounts`
--
ALTER TABLE `cash_accounts`
  ADD CONSTRAINT `cash_lvl_3_ibfk_3` FOREIGN KEY (`cash_lvl_3_id`) REFERENCES `cash_lvl_3` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cash_lvl_2`
--
ALTER TABLE `cash_lvl_2`
  ADD CONSTRAINT `cash_lvl_2_ibfk_1` FOREIGN KEY (`cash_lvl_1_id`) REFERENCES `cash_lvl_1` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cash_lvl_3`
--
ALTER TABLE `cash_lvl_3`
  ADD CONSTRAINT `cash_lvl_3_ibfk_1` FOREIGN KEY (`cash_lvl_2_id`) REFERENCES `cash_lvl_2` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD CONSTRAINT `email_verifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `Employees_department_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Employees_department_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `positions` (`department_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Employees_positions_ibfk_4` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Employees_unit_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `positions` (`unit_id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`calendar_id`) REFERENCES `calendars` (`id`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD CONSTRAINT `event_attendees_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `event_attendees_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `financial_accounts`
--
ALTER TABLE `financial_accounts`
  ADD CONSTRAINT `member_id_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `method_id_ibfk_2` FOREIGN KEY (`method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_particulars`
--
ALTER TABLE `invoice_particulars`
  ADD CONSTRAINT `particulars_cashiering_invoice_id_ibfk_1` FOREIGN KEY (`cashiering_invoice_id`) REFERENCES `cashiering_invoice` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `particulars_item_id_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cash_account_id_ibfk_1` FOREIGN KEY (`cash_account_id`) REFERENCES `cash_accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_transaction_category_id` FOREIGN KEY (`transaction_category_id`) REFERENCES `transaction_category` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `ledger`
--
ALTER TABLE `ledger`
  ADD CONSTRAINT `ledger_table_user_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_cash_account_id_ibfk_2` FOREIGN KEY (`transaction_cash_account_id`) REFERENCES `transaction_types_cash_account` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loan_member_id_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loan_repayment_schedules`
--
ALTER TABLE `loan_repayment_schedules`
  ADD CONSTRAINT `loan_repayment_schedule_loan_id_ibfk_1` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `member_balance`
--
ALTER TABLE `member_balance`
  ADD CONSTRAINT `fk_member_balance_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `member_beneficiaries`
--
ALTER TABLE `member_beneficiaries`
  ADD CONSTRAINT `member_beneficiaries_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `member_educ_backgrounds`
--
ALTER TABLE `member_educ_backgrounds`
  ADD CONSTRAINT `member_educ_backgrounds_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `member_work_backgrounds`
--
ALTER TABLE `member_work_backgrounds`
  ADD CONSTRAINT `member_work_backgrounds_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `official_receipts`
--
ALTER TABLE `official_receipts`
  ADD CONSTRAINT `or_billing_address_id_ibfk_1` FOREIGN KEY (`billing_address_id`) REFERENCES `billing_address` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `or_user_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `transaction_category_id_ibfk3` FOREIGN KEY (`transaction_category_id`) REFERENCES `transaction_category` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `or_particulars`
--
ALTER TABLE `or_particulars`
  ADD CONSTRAINT `or_particulars_item_id_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `or_particulars_receipt_id_ibfk_2` FOREIGN KEY (`receipt_id`) REFERENCES `official_receipts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_account_map`
--
ALTER TABLE `payment_account_map`
  ADD CONSTRAINT `account_map_payment_options_id_ibfk_1` FOREIGN KEY (`payment_options_id`) REFERENCES `payment_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `account_map_transaction_type_id_ibfk_2` FOREIGN KEY (`transaction_account_id`) REFERENCES `transaction_types_cash_account` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_option_id_ibfk_1` FOREIGN KEY (`account_type_id`) REFERENCES `account_types` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `payment_options`
--
ALTER TABLE `payment_options`
  ADD CONSTRAINT `paymnetOpt_cash_accounts_ibfk_1` FOREIGN KEY (`cash_accounts_id`) REFERENCES `cash_accounts` (`id`);

--
-- Constraints for table `payment_records`
--
ALTER TABLE `payment_records`
  ADD CONSTRAINT `payment_method_id_ibfk_4` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_invoice_particulars_id_ibfk_2` FOREIGN KEY (`invoice_particulars_id`) REFERENCES `invoice_particulars` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `records_or_id_ibfk_3` FOREIGN KEY (`or_particulars_id`) REFERENCES `or_particulars` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `transaciton_category_id` FOREIGN KEY (`transaction_category_id`) REFERENCES `transaction_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_department_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unit_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `permissions_id_ibfk_1` FOREIGN KEY (`permissions_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_id_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_types_cash_account`
--
ALTER TABLE `transaction_types_cash_account`
  ADD CONSTRAINT `transaction_types_cash_acc_ibfk_2` FOREIGN KEY (`cash_account_id`) REFERENCES `cash_accounts` (`id`),
  ADD CONSTRAINT `transaction_types_id_ibfk_1` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_types` (`id`);

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_department_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD CONSTRAINT `user_documents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD CONSTRAINT `user_notifications_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_referrals`
--
ALTER TABLE `user_referrals`
  ADD CONSTRAINT `user_referrals_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_referrals_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `role_id_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_id_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
