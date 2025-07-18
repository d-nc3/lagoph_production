-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2025 at 09:49 AM
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
-- Table structure for table `billing_address`
--

CREATE TABLE `billing_address` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `billing_email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `billing_address`
--

INSERT INTO `billing_address` (`id`, `user_id`, `street_address`, `municipality`, `billing_email`, `mobile_number`, `province`) VALUES
(3, 33, 'N/A', 'NCR', 'kathrinavaldezco553@gmail.com', '189182919', ''),
(4, 44, 'SS', 'NCR', 'kathrinavaldezco553@gmail.com', '09182350004', 'Bulacan'),
(9, 5, 'Sample Address', 'NCR', 'angela@gmail.com', '10100100', ''),
(10, 1, 'Sorrento Oasis', 'NCR', 'azoresmelmar@gmail.com', '09182350004', ''),
(11, 48, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'manualUser@example.com', '09359671913', ''),
(15, 3, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco@gmail.com', '9182345000', ''),
(16, 2, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco@gmail.com', '9182345000', ''),
(17, 51, 'Manila, Sampaloc, Metro Manila 1008', 'NCR', 'catherinemontalbo623@gmail.com', '9672654362', ''),
(18, 52, 'sample', 'NCR', 'kathrinavaldezco553@gmail.com', '09182345000', ''),
(19, 53, 'bjsahjh', 'NCR', 'kathrinavaldezco553@gmail.com', '09182345000', ''),
(20, 54, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathPadilla@gmail.com', '09359671913', ''),
(23, 58, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco553@gmail.com', '189182919', ''),
(24, 62, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco553@gmail.com', '189182919', ''),
(25, 63, '#49 Don A. Roces Paligsahan, Quezon City', 'NCR', 'kathrinavaldezco553@gmail.com', '189182919', '');

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
(55, 62, NULL, '10000.00', '8000.00', '1000.00', 9, '2000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-01-22', '2025-01-22', 0, '2025-01-22 05:58:28', 0, '2025-01-22 06:08:15', NULL, NULL),
(56, 63, NULL, '10000.00', '8000.00', '1000.00', 9, '2000.00', 'Initial Capital Contribution, First Payment', 'pending', '2025-01-23', '2025-01-23', 0, '2025-01-23 05:12:39', 0, '2025-01-23 05:15:38', NULL, NULL);

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
(871, 55, '2000.00', '2025-01-22', 'paid', '2025-01-22 14:08:15', 'sample@gmail.com', '2025-01-22 14:08:15', NULL, NULL, NULL),
(872, 55, '1000.00', '2025-02-22', 'payment_initiated', '2025-01-22 14:08:15', 'sample@gmail.com', '2025-01-22 16:36:57', 'nesPaular@gmail.com', NULL, NULL),
(873, 55, '1000.00', '2025-03-22', 'payment_initiated', '2025-01-22 14:08:15', 'sample@gmail.com', '2025-01-22 16:36:57', 'nesPaular@gmail.com', NULL, NULL),
(874, 55, '1000.00', '2025-04-22', 'payment_initiated', '2025-01-22 14:08:15', 'sample@gmail.com', '2025-01-22 16:36:57', 'nesPaular@gmail.com', NULL, NULL),
(875, 55, '1000.00', '2025-05-22', 'payment_initiated', '2025-01-22 14:08:15', 'sample@gmail.com', '2025-01-22 17:23:24', 'nesPaular@gmail.com', NULL, NULL),
(876, 55, '1000.00', '2025-06-22', 'payment_initiated', '2025-01-22 14:08:15', 'sample@gmail.com', '2025-01-22 17:23:24', 'nesPaular@gmail.com', NULL, NULL),
(877, 55, '1000.00', '2025-07-22', 'payment_initiated', '2025-01-22 14:08:15', 'sample@gmail.com', '2025-01-22 17:23:24', 'nesPaular@gmail.com', NULL, NULL),
(878, 55, '1000.00', '2025-08-22', 'pending', '2025-01-22 14:08:15', 'sample@gmail.com', '2025-01-22 16:23:23', 'nesPaular@gmail.com', NULL, NULL),
(879, 55, '1000.00', '2025-09-22', 'pending', '2025-01-22 14:08:15', 'sample@gmail.com', '2025-01-22 16:23:26', 'nesPaular@gmail.com', NULL, NULL),
(880, 56, '2000.00', '2025-01-23', 'paid', '2025-01-23 13:15:38', 'sample@gmail.com', '2025-01-23 13:15:38', NULL, NULL, NULL),
(881, 56, '1000.00', '2025-02-23', 'pending', '2025-01-23 13:15:38', 'sample@gmail.com', '2025-01-23 13:15:38', NULL, NULL, NULL),
(882, 56, '1000.00', '2025-03-23', 'pending', '2025-01-23 13:15:38', 'sample@gmail.com', '2025-01-23 13:15:38', NULL, NULL, NULL),
(883, 56, '1000.00', '2025-04-23', 'pending', '2025-01-23 13:15:38', 'sample@gmail.com', '2025-01-23 13:15:38', NULL, NULL, NULL),
(884, 56, '1000.00', '2025-05-23', 'pending', '2025-01-23 13:15:38', 'sample@gmail.com', '2025-01-23 13:15:38', NULL, NULL, NULL),
(885, 56, '1000.00', '2025-06-23', 'pending', '2025-01-23 13:15:38', 'sample@gmail.com', '2025-01-23 13:15:38', NULL, NULL, NULL),
(886, 56, '1000.00', '2025-07-23', 'pending', '2025-01-23 13:15:38', 'sample@gmail.com', '2025-01-23 13:15:38', NULL, NULL, NULL),
(887, 56, '1000.00', '2025-08-23', 'pending', '2025-01-23 13:15:38', 'sample@gmail.com', '2025-01-23 13:15:38', NULL, NULL, NULL),
(888, 56, '1000.00', '2025-09-23', 'pending', '2025-01-23 13:15:38', 'sample@gmail.com', '2025-01-23 13:15:38', NULL, NULL, NULL);

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
(715, 58, 'INV-202501230927093163', 0, 4370, '2025-01-23', NULL, NULL, NULL, 'sample@gmail.com', '2025-01-23 01:27:09', NULL, '2025-01-23 01:27:09', NULL, NULL, 'pending', 23, 3),
(716, 58, 'INV-202501230927093163', 0, 4370, '2025-01-23', NULL, NULL, NULL, 'sample@gmail.com', '2025-01-23 01:27:09', NULL, '2025-01-23 01:27:09', NULL, NULL, 'pending', 23, 3),
(717, 58, 'INV-202501230927093163', 0, 4370, '2025-01-23', NULL, NULL, NULL, 'sample@gmail.com', '2025-01-23 01:27:09', NULL, '2025-01-23 01:27:09', NULL, NULL, 'pending', 23, 3),
(718, 62, 'INV-202501230931094310', 0, 3642, '2025-01-23', NULL, NULL, NULL, 'sample@gmail.com', '2025-01-23 01:31:08', NULL, '2025-01-23 01:31:09', NULL, NULL, 'pending', 24, 3),
(719, 62, 'INV-202501230931094310', 0, 3642, '2025-01-23', NULL, NULL, NULL, 'sample@gmail.com', '2025-01-23 01:31:08', NULL, '2025-01-23 01:31:09', NULL, NULL, 'pending', 24, 3),
(720, 62, 'INV-202501230931094310', 0, 3642, '2025-01-23', NULL, NULL, NULL, 'sample@gmail.com', '2025-01-23 01:31:08', NULL, '2025-01-23 01:31:09', NULL, NULL, 'pending', 24, 3),
(721, 62, 'INV-202501230931371004', 0, 7283, '2025-01-23', NULL, NULL, NULL, 'nesPaular@gmail.com', '2025-01-23 01:31:37', NULL, '2025-01-23 01:31:37', NULL, NULL, 'payment-initiated', 24, 3),
(722, 62, 'INV-202501231005512117', 0, 7283, '2025-01-23', NULL, NULL, NULL, 'nesPaular@gmail.com', '2025-01-23 02:05:51', NULL, '2025-01-23 02:05:51', NULL, NULL, 'payment-initiated', 24, 3),
(723, 62, 'INV-202501231136262866', 0, 3642, '2025-01-23', NULL, NULL, NULL, 'nesPaular@gmail.com', '2025-01-23 03:36:26', NULL, '2025-01-23 03:36:26', NULL, NULL, 'payment-initiated', 24, 3),
(724, 62, 'INV-202501231247585418', 0, 7283, '2025-01-23', NULL, 'Sample Cashier', NULL, 'nesPaular@gmail.com', '2025-01-23 08:50:50', 'sample@gmail.com', '2025-01-23 08:50:50', NULL, NULL, 'completed', 24, 3),
(725, 63, 'INV-202501231311453064', 0, 500, '2025-01-23', NULL, 'Sample Cashier', NULL, 'system', '2025-01-23 05:15:29', 'sample@gmail.com', '2025-01-23 05:15:29', NULL, NULL, 'completed', 25, 1),
(726, 63, 'INV-202501231312399030', 0, 2000, '2025-01-23', NULL, 'Sample Cashier', NULL, 'danieDoe@gmail.com', '2025-01-23 05:15:38', 'sample@gmail.com', '2025-01-23 05:15:38', NULL, NULL, 'completed', 25, 2),
(727, 62, 'INV-202501231319008135', 0, 3642, '2025-01-23', NULL, 'Sample Cashier', NULL, 'nesPaular@gmail.com', '2025-01-24 01:37:54', 'sample@gmail.com', '2025-01-24 01:37:53', NULL, NULL, 'completed', 24, 3);

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
(1, 'Finance Division', 'Sample Head', 'Finance and cashiering', '2024-09-13 09:18:13', 'john.doe@example.com', '2024-09-13 09:18:13', NULL, NULL, NULL);

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
(1, 48, '289981', '2024-10-30 05:37:50', 'manualUser@example.com', '2024-10-30 05:38:23', 'sample@gmail.com', NULL, NULL),
(3, 51, '127520', '2024-11-14 02:09:58', 'catherinemontalbo623@gmail.com', '2024-11-14 02:10:15', 'sample@gmail.com', NULL, NULL),
(4, 52, '909455', '2024-11-15 07:10:18', 'catherinemontalbo6231@gmail.com', '2024-11-15 07:10:43', 'person@gmail.com', NULL, NULL),
(5, 53, '738877', '2024-11-15 08:32:34', 'cathpacunla@gmail.com', '2024-11-15 08:32:55', 'sysadmin', NULL, NULL),
(6, 54, '230220', '2024-11-19 01:40:03', 'kathPadilla@gmail.com', '2024-11-19 01:40:15', 'cathpacunla@gmail.com', NULL, NULL),
(7, 55, '825781', '2024-11-20 02:48:21', 'azoresmelmar2@gmail.com', '2024-11-20 02:48:42', 'sysadmin', NULL, NULL),
(10, 58, '721024', '2024-12-16 02:30:10', 'kathrinavaldezco553@gmail.com', '2024-12-16 02:30:27', 'miguelEnzo@gmail.com', NULL, NULL),
(14, 62, '494366', '2025-01-22 05:22:35', 'nesPaular@gmail.com', '2025-01-22 05:22:51', 'sysadmin', NULL, NULL),
(15, 63, '375342', '2025-01-23 04:57:02', 'danieDoe@gmail.com', '2025-01-23 04:58:00', 'nesPaular@gmail.com', NULL, NULL);

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
(1, 35, 2, 'Kathrina Valdezco', 'Savings', 1234567890, NULL, NULL, NULL, '2025-01-14 07:11:04', NULL, '2025-01-14 07:11:04', NULL, NULL),
(6, 35, 11, 'John Doe', 'Credit', 2147483647, '0000-00-00', 654, 'kathrinavaldezco553@gmail.com', '2025-01-14 07:53:50', NULL, '2025-01-14 07:53:50', NULL, NULL),
(7, 27, 2, 'kath Muntinlupa', 'Debit', 2147483647, '0000-00-00', 654, 'cathpacunla@gmail.com', '2025-01-17 08:21:58', NULL, '2025-01-17 08:21:58', NULL, NULL),
(8, 23, 11, 'Jane Valdez', 'Debit', 2147483647, '0000-00-00', 658, 'jane@gmail.com', '2025-01-21 07:57:11', NULL, '2025-01-21 07:57:11', NULL, NULL),
(9, 28, 11, 'John Doe', 'Debit', 918256356, NULL, NULL, 'person@gmail.com', '2025-01-21 08:18:18', NULL, '2025-01-21 08:18:18', NULL, NULL),
(10, 37, 2, 'John Doe', 'Debit', 2147483647, NULL, NULL, 'nesPaular@gmail.com', '2025-01-22 06:16:30', NULL, '2025-01-22 06:16:30', NULL, NULL),
(11, 39, 11, 'Daniel Doe', 'Debit', 2147483647, NULL, NULL, 'danieDoe@gmail.com', '2025-01-23 06:17:31', NULL, '2025-01-23 06:17:31', NULL, NULL);

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
(685, 724, 3, 1, 3642, 7283, 'nesPaular@gmail.com', '2025-01-23 04:47:58', NULL, '2025-01-23 04:47:58', NULL, NULL),
(686, 725, 1, 1, 500, 500, 'danieDoe@gmail.com', '2025-01-23 05:11:44', NULL, '2025-01-23 05:11:45', NULL, NULL),
(687, 726, 2, 1, 2000, 2000, 'danieDoe@gmail.com', '2025-01-23 05:12:39', NULL, '2025-01-23 05:12:39', NULL, NULL),
(688, 727, 3, 1, 3642, 3642, 'nesPaular@gmail.com', '2025-01-23 05:18:59', NULL, '2025-01-23 05:19:00', NULL, NULL);

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
(3, 9, 3, 1120000, 'Loans', '', 'pax', NULL, '2025-01-23 03:31:12', NULL, '2025-01-23 03:31:12', NULL, NULL, NULL);

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
  `loan_amount` decimal(10,0) DEFAULT NULL,
  `principal_with_interest` decimal(15,2) NOT NULL,
  `remaining_balance` decimal(15,2) NOT NULL,
  `loan_type` varchar(255) DEFAULT NULL,
  `loan_status` enum('Pending','Approved','Rejected','Disbursed','Fully Paid') NOT NULL DEFAULT 'Pending',
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

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `member_id`, `disbursment_account_id`, `loan_reference_number`, `loan_amount`, `principal_with_interest`, `remaining_balance`, `loan_type`, `loan_status`, `loan_term`, `start_date`, `end_date`, `remarks`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(21, 35, 1, 'LN-25010001', '12000', '13110.00', '13110.00', 'personal', 'Disbursed', 3, NULL, NULL, '', '2025-01-23 01:26:18', 'kathrinavaldezco553@gmail.com', '2025-01-23 01:27:09', 'sample@gmail.com', NULL, NULL),
(22, 37, 10, 'LN-25010002', '10000', '10925.00', '10925.00', 'personal', 'Disbursed', 3, NULL, NULL, '', '2025-01-23 01:30:19', 'nesPaular@gmail.com', '2025-01-23 01:31:08', 'sample@gmail.com', NULL, NULL),
(23, 39, 11, 'LN-25010003', '12000', '13110.00', '13110.00', 'personal', 'Disbursed', 3, NULL, NULL, '', '2025-01-23 06:19:15', 'danieDoe@gmail.com', '2025-01-23 06:24:27', 'sample@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_repayment_schedules`
--

CREATE TABLE `loan_repayment_schedules` (
  `id` int NOT NULL,
  `loan_id` int NOT NULL,
  `amount_due` decimal(15,2) DEFAULT NULL,
  `remaining_balance` decimal(10,2) DEFAULT NULL,
  `date_paid` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','paid','payment_initiated') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loan_repayment_schedules`
--

INSERT INTO `loan_repayment_schedules` (`id`, `loan_id`, `amount_due`, `remaining_balance`, `date_paid`, `due_date`, `amount_paid`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(49, 21, '4370.00', NULL, NULL, '2025-01-23 00:00:00', NULL, 'pending', 'sample@gmail.com', '2025-01-23 01:27:09', NULL, '2025-01-23 01:27:09', NULL, NULL),
(50, 21, '4370.00', NULL, NULL, '2025-02-23 00:00:00', NULL, 'pending', 'sample@gmail.com', '2025-01-23 01:27:09', NULL, '2025-01-23 01:27:09', NULL, NULL),
(51, 21, '4370.00', NULL, NULL, '2025-03-23 00:00:00', NULL, 'pending', 'sample@gmail.com', '2025-01-23 01:27:09', NULL, '2025-01-23 01:27:09', NULL, NULL),
(52, 22, '3641.67', NULL, NULL, '2025-01-23 00:00:00', NULL, 'payment_initiated', 'sample@gmail.com', '2025-01-23 05:19:00', 'nesPaular@gmail.com', '2025-01-23 05:18:59', NULL, NULL),
(53, 22, '3641.67', NULL, NULL, '2025-02-23 00:00:00', NULL, 'payment_initiated', 'sample@gmail.com', '2025-01-23 04:47:58', 'nesPaular@gmail.com', '2025-01-23 04:47:58', NULL, NULL),
(54, 22, '3641.67', NULL, NULL, '2025-03-23 00:00:00', NULL, 'pending', 'sample@gmail.com', '2025-01-23 01:31:08', NULL, '2025-01-23 01:31:09', NULL, NULL),
(55, 23, '4370.00', NULL, NULL, '2025-01-23 00:00:00', NULL, 'pending', 'sample@gmail.com', '2025-01-23 06:24:27', NULL, '2025-01-23 06:24:27', NULL, NULL),
(56, 23, '4370.00', NULL, NULL, '2025-02-23 00:00:00', NULL, 'pending', 'sample@gmail.com', '2025-01-23 06:24:27', NULL, '2025-01-23 06:24:27', NULL, NULL),
(57, 23, '4370.00', NULL, NULL, '2025-03-23 00:00:00', NULL, 'pending', 'sample@gmail.com', '2025-01-23 06:24:27', NULL, '2025-01-23 06:24:27', NULL, NULL);

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
(21, 51, 'M-2024-11-000000051', 'MONTALBO', 'CATHERINE', '', '', 'Single', '2024-05-12', 'NCR', 'MANILA, SAMPALOC, METRO MANILA 1008', '967 265 4362', '', 'catherinemontalbo623@gmail.com', '', '', '967 265 4362', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2024-11-14 05:37:41', 'catherinemontalbo623@gmail.com', '2025-01-22 02:30:58', 'john.doe@example.com', NULL, NULL),
(23, 3, 'M-2024-11-000000003', 'DOE', 'JANE', 'FORD', 'Female', 'Single', '2000-11-15', 'NCR', 'BLK 49 LOT 43', '948 030 0378', '', 'jane@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Processing', '-', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(27, 53, 'M-2024-11-000000053', 'PACUNLA', 'KATH', '', 'Female', 'Single', '2001-05-10', 'NCR', 'VISAYAS, REGION VI, CAPIZ, ROXAS CITY', '1 891 829 19', '', 'cathpacunla@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2024-11-15 08:51:11', 'cathpacunla@gmail.com', '2024-11-15 08:52:22', 'john.doe@example.com', NULL, NULL),
(28, 44, 'M-2024-11-000000044', 'DATA', 'PERSON', 'SAMPLE', 'Female', 'Single', '2001-05-10', 'NCR', 'SAMPLE', '918 234 5000', '', 'person@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:12:18', 'john.doe@example.com', NULL, NULL),
(35, 58, 'M-2024-12-000000058', 'VALDEZCO', 'KATHRINA', 'RONQUILLO', 'Female', 'Single', '2001-11-11', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'kathrinavaldezco553@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2024-12-16 02:38:31', 'kathrinavaldezco553@gmail.com', '2024-12-16 02:39:43', 'john.doe@example.com', NULL, NULL),
(37, 62, 'M-2025-01-000000062', 'PAULAR', 'NES', 'NULL', 'Female', 'Single', '2001-11-11', 'NCR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'nesPaular@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-01-22 06:15:28', 'nesPaular@gmail.com', '2025-01-22 06:15:52', 'john.doe@example.com', NULL, NULL),
(39, 63, 'M-2025-01-000000063', 'DOE', 'DANIEL', 'RONQUILLO', 'Male', 'Single', '2001-10-10', 'CAR', '#49 DON A. ROCES PALIGSAHAN, QUEZON CITY', '1 891 829 19', '', 'danieDoe@gmail.com', '', '', '', 'No', '', 'No', 'No', NULL, '', 'Approved', '-', '2025-01-23 05:14:25', 'danieDoe@gmail.com', '2025-01-23 05:15:03', 'john.doe@example.com', NULL, NULL);

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
(22, 21, 'Current', 'Administrative Officer II', 'CICC', '#49 Don A. Roces Paligsahan, Quezon City', '30000', 0, '09359671913', '2024-11-14 05:37:41', 'catherinemontalbo623@gmail.com', '2024-11-14 05:37:41', NULL, NULL, NULL),
(24, 23, 'Current', 'AOII', 'CICC', 'Blk 49 lot 43', '12000', 0, '1212323', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(28, 27, 'Current', 'AO II', 'CICC', '#49 Don A. Roces Paligsahan, Quezon City', '35000', 0, '09359671913', '2024-11-15 08:51:11', 'cathpacunla@gmail.com', '2024-11-15 08:51:11', NULL, NULL, NULL),
(29, 28, 'Current', 'AOII', 'CICC', '#49 Don A. Roces Paligsahan, Quezon City', '32000', 0, '09359671913', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
(36, 35, 'Current', 'ENGINEER I', 'CICC', '#49 Don A. Roces Paligsahan, Quezon City', '50000', 0, '09359671913', '2024-12-16 02:38:31', 'kathrinavaldezco553@gmail.com', '2024-12-16 02:38:31', NULL, NULL, NULL),
(38, 37, 'Current', 'Engineer I', 'CICC', '#49 Don A. Roces Paligsahan, Quezon City', '30000', 0, '09359671913', '2025-01-22 06:15:28', 'nesPaular@gmail.com', '2025-01-22 06:15:28', NULL, NULL, NULL),
(40, 39, 'Current', 'random', 'CICC / CIO-ID', 'Visayas, Region VI, Capiz, Roxas City', '42154151', 0, '09480300378', '2025-01-23 05:14:25', 'danieDoe@gmail.com', '2025-01-23 05:14:25', NULL, NULL, NULL);

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
(801, 'OR-202412161036499632', 23, 58, 1, '2024-12-16', 'Sample Cashier', '', 'sample@gmail.com', '2024-12-16 02:36:49', NULL, '2024-12-16 02:36:49', NULL, NULL),
(802, 'OR-202412161037011907', 23, 58, 2, '2024-12-16', 'Sample Cashier', '', 'sample@gmail.com', '2024-12-16 02:37:01', NULL, '2024-12-16 02:37:01', NULL, NULL),
(803, 'OR-202412261442053185', 23, 58, 2, '2024-12-26', 'Sample Cashier', '', 'sample@gmail.com', '2024-12-26 06:42:05', NULL, '2024-12-26 06:42:05', NULL, NULL),
(804, 'OR-202412261443576497', 23, 58, 4, '2024-12-26', 'Sample Cashier', '', NULL, '2024-12-26 06:43:57', NULL, '2024-12-26 06:43:57', NULL, NULL),
(805, 'OR-202501221233233867', 23, 58, 2, '2025-01-22', 'Sample Cashier', '', 'sample@gmail.com', '2025-01-22 04:33:23', NULL, '2025-01-22 04:33:23', NULL, NULL),
(806, 'OR-202501221408151620', 24, 62, 2, '2025-01-22', 'Sample Cashier', '', 'sample@gmail.com', '2025-01-22 06:08:15', NULL, '2025-01-22 06:08:15', NULL, NULL),
(807, 'OR-202501221410024646', 24, 62, 1, '2025-01-22', 'Sample Cashier', '', 'sample@gmail.com', '2025-01-22 06:10:02', NULL, '2025-01-22 06:10:02', NULL, NULL),
(808, 'OR-202501231315297309', 25, 63, 1, '2025-01-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-01-23 05:15:29', NULL, '2025-01-23 05:15:29', NULL, NULL),
(809, 'OR-202501231315387918', 25, 63, 2, '2025-01-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-01-23 05:15:38', NULL, '2025-01-23 05:15:38', NULL, NULL),
(810, 'OR-202501231650503120', 24, 62, 3, '2025-01-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-01-23 08:50:50', NULL, '2025-01-23 08:50:50', NULL, NULL),
(811, 'OR-202501231652241304', 24, 62, 3, '2025-01-23', 'Sample Cashier', '', 'sample@gmail.com', '2025-01-23 08:52:24', NULL, '2025-01-23 08:52:24', NULL, NULL),
(812, 'OR-202501240937541412', 24, 62, 3, '2025-01-24', 'Sample Cashier', '', 'sample@gmail.com', '2025-01-24 01:37:53', NULL, '2025-01-24 01:37:54', NULL, NULL);

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
(719, 1, 801, NULL, 1, 500, 500, NULL, '2024-12-16 02:36:49', NULL, '2024-12-16 02:36:49', NULL, NULL),
(720, 2, 802, NULL, 1, 1000, 1000, NULL, '2024-12-16 02:37:01', NULL, '2024-12-16 02:37:01', NULL, NULL),
(721, 2, 803, NULL, 1, 1000, 1000, NULL, '2024-12-26 06:42:05', NULL, '2024-12-26 06:42:05', NULL, NULL),
(722, 2, 804, NULL, 1, 1000, 1000, NULL, '2024-12-26 06:43:57', NULL, '2024-12-26 06:43:57', NULL, NULL),
(723, 2, 805, NULL, 1, 1000, 1000, NULL, '2025-01-22 04:33:23', NULL, '2025-01-22 04:33:23', NULL, NULL),
(724, 2, 806, NULL, 1, 1000, 1000, NULL, '2025-01-22 06:08:16', NULL, '2025-01-22 06:08:16', NULL, NULL),
(725, 1, 807, NULL, 1, 500, 500, NULL, '2025-01-22 06:10:02', NULL, '2025-01-22 06:10:02', NULL, NULL),
(726, 1, 808, NULL, 1, 500, 500, NULL, '2025-01-23 05:15:29', NULL, '2025-01-23 05:15:29', NULL, NULL),
(727, 2, 809, NULL, 1, 1000, 1000, NULL, '2025-01-23 05:15:38', NULL, '2025-01-23 05:15:38', NULL, NULL),
(728, 3, 810, NULL, 1, 10000, 0, NULL, '2025-01-23 08:50:50', NULL, '2025-01-23 08:50:50', NULL, NULL),
(729, 3, 811, NULL, 1, 3642, 0, NULL, '2025-01-23 08:52:24', NULL, '2025-01-23 08:52:24', NULL, NULL),
(730, 3, 812, NULL, 1, 3642, 0, NULL, '2025-01-24 01:37:54', NULL, '2025-01-24 01:37:54', NULL, NULL);

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
  `payment_option_id` int NOT NULL,
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

INSERT INTO `payment_methods` (`id`, `payment_option_id`, `financial_service_provider`, `type`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
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
(3, 1, 1110006, 'E-wallet', NULL, '2024-11-11 02:26:53', NULL, '2024-11-11 02:26:53', NULL, NULL),
(4, 1, 1110007, 'Bank Transfer', '1', '2024-11-10 13:40:00', NULL, '2024-11-10 13:40:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_records`
--

CREATE TABLE `payment_records` (
  `id` int NOT NULL,
  `invoice_particulars_id` int DEFAULT NULL,
  `transaction_category_id` int DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `date_verified` datetime NOT NULL,
  `payment_method_id` int DEFAULT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `reference_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `total_payment` float NOT NULL,
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

INSERT INTO `payment_records` (`id`, `invoice_particulars_id`, `transaction_category_id`, `payment_date`, `date_verified`, `payment_method_id`, `account_name`, `account_number`, `reference_number`, `total_payment`, `details`, `payment_proof`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `or_particulars_id`) VALUES
(733, 685, 3, '2025-01-23 00:00:00', '2025-01-23 16:50:50', 23, '', '', '', 7283.34, '', 'uploads/payments/payment_receipt/62/6791c9fe4eb02.jpeg', 'Completed', 'nesPaular@gmail.com', '2025-01-23 08:50:50', 'sample@gmail.com', '2025-01-23 08:50:50', NULL, NULL, 728),
(734, 686, 1, '2023-05-10 00:00:00', '2025-01-23 13:15:29', 2, 'Sample Name of user', '8912091020221', '', 500, 'payment\r\n', 'uploads/payments/63/INV-202501231311453064/6791cfae83f66.jpeg', 'Completed', 'danieDoe@gmail.com', '2025-01-23 05:15:29', 'sample@gmail.com', '2025-01-23 05:15:29', NULL, NULL, 726),
(735, 687, 2, '2025-11-11 00:00:00', '2025-01-23 13:15:38', 2, 'Sample Name of user', '8912091020221', '', 2000, 'payment for membership', 'uploads/payments/63/INV-202501231312399030/6791cfe37e5e0.jpeg', 'Completed', 'danieDoe@gmail.com', '2025-01-23 05:15:38', 'sample@gmail.com', '2025-01-23 05:15:38', NULL, NULL, 727),
(736, 688, 3, '2025-01-23 00:00:00', '2025-01-24 09:37:54', 23, '', '', '', 3641.67, '', 'uploads/payments/payment_receipt/62/6791d144232a6.jpg', 'Completed', 'nesPaular@gmail.com', '2025-01-24 01:37:54', 'sample@gmail.com', '2025-01-24 01:37:53', NULL, NULL, 730);

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
(1, 'Engineer I', 1, 1, 'Sample 1', '2024-09-13 09:19:03', 'sysadmin', '2024-09-13 09:19:03', NULL, NULL, NULL);

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
(4, 'Miscellaneous', 'General service fees', 1);

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
  `role` varchar(100) NOT NULL DEFAULT 'User',
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

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `status`, `login_attempts`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Melmar', 'Azores', 'azoresmelmar@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'User', 'active', 0, '2024-05-20 21:21:32', 'azoresmelmar@gmail.com', '2024-11-12 05:40:43', 'azoresmelmar@gmail.com', NULL, NULL),
(2, 'John', 'Doe', 'john.doe@example.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'Admin-approver', 'active', 0, '2024-05-20 21:21:32', 'john.doe@example.com', '2025-01-23 06:19:38', 'john.doe@example.com', NULL, NULL),
(3, 'Jane', 'Doe', 'jane@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'Member', 'active', 0, '2024-05-20 21:21:32', 'john.doe@example.com', '2025-01-22 01:21:48', 'jane@gmail.com', NULL, NULL),
(5, 'Angela', 'Jolie', 'angela@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'Member', 'active', 0, '2024-05-20 21:21:32', 'john.doe@example.com', '2025-01-16 01:59:48', 'angela@gmail.com', NULL, NULL),
(33, 'Sample', 'Cashier', 'sample@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'Cashier', 'active', 0, '2024-05-20 21:21:32', 'john.doe@example.com', '2025-01-24 00:55:10', 'sample@gmail.com', NULL, NULL),
(44, 'Person', 'Data', 'person@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'Member', 'active', 0, '2024-05-20 21:21:32', 'john.doe@example.com', '2025-01-22 02:30:21', 'person@gmail.com', NULL, NULL),
(48, 'Manual', 'User', 'manualUser@example.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'Member', 'active', 0, '2024-10-30 05:37:50', 'manualUser@example.com', '2025-01-21 08:31:40', 'manualUser@example.com', NULL, NULL),
(51, 'Catherine', 'Montalbo', 'catherinemontalbo623@gmail.com', '$2y$10$uzkWsu5kHHz1dQZEXTvda.OXaMXdhhlpsG5lZnTrys7z8s2D10hFe', 'Member', 'active', 0, '2024-11-14 02:09:58', 'catherinemontalbo623@gmail.com', '2025-01-22 02:31:13', 'catherinemontalbo623@gmail.com', NULL, NULL),
(52, 'Catherine', 'Montalbo', 'catherinemontalbo6231@gmail.com', '$2y$10$ipmFYNlH/w/LL3yLRRrMkemcU6Gc5d1ilVHsPaD/3wYYd0vZkqkaW', 'User', 'active', 0, '2024-11-15 07:10:18', 'catherinemontalbo6231@gmail.com', '2024-12-13 05:43:59', 'catherinemontalbo6231@gmail.com', NULL, NULL),
(53, 'Kath', 'Pacunla', 'cathpacunla@gmail.com', '$2y$10$1puNSdK9rUK5820gP25HX..WXwNCs4fOE/u.VCjnJyWblsMYJ4A32', 'Member', 'active', 0, '2024-11-15 08:32:34', 'cathpacunla@gmail.com', '2025-01-23 01:29:29', 'cathpacunla@gmail.com', NULL, NULL),
(54, 'Kathryn', 'Padilla', 'kathPadilla@gmail.com', '$2y$10$YxqXeOqu2rTIL8Z3hWciY.ogUeuBFy21Safe4D2ulf7EqIaza8.W2', 'Member', 'active', 0, '2024-11-19 01:40:03', 'kathPadilla@gmail.com', '2025-01-23 01:28:45', 'kathPadilla@gmail.com', NULL, NULL),
(55, 'Melmar', 'Azores', 'azoresmelmar2@gmail.com', '$2y$10$kDWuehUvSEfw7FOXk/R0he4AZsacFkZGqiLAEsS0BM/Y18p/ctbYi', 'User', 'active', 0, '2024-11-20 02:48:21', 'azoresmelmar2@gmail.com', '2024-11-20 02:48:53', 'azoresmelmar2@gmail.com', NULL, NULL),
(58, 'Kathrina', 'Valdezco', 'kathrinavaldezco553@gmail.com', '$2y$10$tqqfsJmZdesvGchsIxzvT.wovuqJnjLqUJ3irhb0q7CMur1uz4Npu', 'Member', 'active', 0, '2024-12-16 02:30:10', 'kathrinavaldezco553@gmail.com', '2025-01-24 02:26:38', 'kathrinavaldezco553@gmail.com', NULL, NULL),
(62, 'Nes', 'Paular', 'nesPaular@gmail.com', '$2y$10$tqqfsJmZdesvGchsIxzvT.wovuqJnjLqUJ3irhb0q7CMur1uz4Npu', 'Member', 'active', 0, '2025-01-22 05:22:35', 'nesPaular@gmail.com', '2025-01-23 08:52:48', 'nesPaular@gmail.com', NULL, NULL),
(63, 'Daniel', 'Doe', 'danieDoe@gmail.com', '$2y$10$tqqfsJmZdesvGchsIxzvT.wovuqJnjLqUJ3irhb0q7CMur1uz4Npu', 'Member', 'active', 0, '2025-01-23 04:57:02', 'danieDoe@gmail.com', '2025-01-23 06:24:43', 'danieDoe@gmail.com', NULL, NULL);

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
(74, 51, 'PMES Certificate', '145.29', 'pdf', '67358ca596c2c.pdf', '/uploads/M-2024-11-000000051/67358ca596c2c.pdf', '2024-11-14 05:37:41', 'catherinemontalbo623@gmail.com', '2024-11-14 05:37:41', NULL, NULL, NULL),
(75, 51, 'Proof of Identity', '180.96', 'jpeg', '67358ca599677.jpeg', '/uploads/M-2024-11-000000051/67358ca599677.jpeg', '2024-11-14 05:37:41', 'catherinemontalbo623@gmail.com', '2024-11-14 05:37:41', NULL, NULL, NULL),
(76, 51, 'Proof of Date of Birth', '123.85', 'pdf', '67358ca59bea5.pdf', '/uploads/M-2024-11-000000051/67358ca59bea5.pdf', '2024-11-14 05:37:41', 'catherinemontalbo623@gmail.com', '2024-11-14 05:37:41', NULL, NULL, NULL),
(77, 51, 'Proof of Address', '123.85', 'pdf', '67358ca59e320.pdf', '/uploads/M-2024-11-000000051/67358ca59e320.pdf', '2024-11-14 05:37:41', 'catherinemontalbo623@gmail.com', '2024-11-14 05:37:41', NULL, NULL, NULL),
(78, 51, '2x2 ID Picture', '159.57', 'jpg', '67358ca5a12e5.jpg', '/uploads/M-2024-11-000000051/67358ca5a12e5.jpg', '2024-11-14 05:37:41', 'catherinemontalbo623@gmail.com', '2024-11-14 05:37:41', NULL, NULL, NULL),
(82, 3, 'PMES Certificate', '26.32', 'pdf', '6736d7d026be6.pdf', '/uploads/M-2024-11-000000003/6736d7d026be6.pdf', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(83, 3, 'Proof of Identity', '5.17', 'jpg', '6736d7d02834a.jpg', '/uploads/M-2024-11-000000003/6736d7d02834a.jpg', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(84, 3, 'Proof of Date of Birth', '26.32', 'pdf', '6736d7d02a264.pdf', '/uploads/M-2024-11-000000003/6736d7d02a264.pdf', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(85, 3, 'Proof of Address', '55.31', 'pdf', '6736d7d02b839.pdf', '/uploads/M-2024-11-000000003/6736d7d02b839.pdf', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(86, 3, '2x2 ID Picture', '5.17', 'jpg', '6736d7d02d4e6.jpg', '/uploads/M-2024-11-000000003/6736d7d02d4e6.jpg', '2024-11-15 05:10:40', 'jane@gmail.com', '2024-11-15 05:10:40', NULL, NULL, NULL),
(90, 53, 'PMES Certificate', '159.57', 'jpg', '67370b7fd1c9a.jpg', '/uploads/M-2024-11-000000053/67370b7fd1c9a.jpg', '2024-11-15 08:51:11', 'cathpacunla@gmail.com', '2024-11-15 08:51:11', NULL, NULL, NULL),
(91, 53, 'Proof of Identity', '5.17', 'jpg', '67370b7fd4cb0.jpg', '/uploads/M-2024-11-000000053/67370b7fd4cb0.jpg', '2024-11-15 08:51:11', 'cathpacunla@gmail.com', '2024-11-15 08:51:11', NULL, NULL, NULL),
(92, 53, 'Proof of Date of Birth', '55.31', 'pdf', '67370b7fd7f7c.pdf', '/uploads/M-2024-11-000000053/67370b7fd7f7c.pdf', '2024-11-15 08:51:11', 'cathpacunla@gmail.com', '2024-11-15 08:51:11', NULL, NULL, NULL),
(93, 53, 'Proof of Address', '55.31', 'pdf', '67370b7fda744.pdf', '/uploads/M-2024-11-000000053/67370b7fda744.pdf', '2024-11-15 08:51:11', 'cathpacunla@gmail.com', '2024-11-15 08:51:11', NULL, NULL, NULL),
(94, 53, '2x2 ID Picture', '5.17', 'jpg', '67370b7fdd1f2.jpg', '/uploads/M-2024-11-000000053/67370b7fdd1f2.jpg', '2024-11-15 08:51:11', 'cathpacunla@gmail.com', '2024-11-15 08:51:11', NULL, NULL, NULL),
(95, 44, 'PMES Certificate', '17.87', 'pdf', '673e88d405431.pdf', '/uploads/M-2024-11-000000044/673e88d405431.pdf', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
(96, 44, 'Proof of Identity', '5.17', 'jpg', '673e88d407d77.jpg', '/uploads/M-2024-11-000000044/673e88d407d77.jpg', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
(97, 44, 'Proof of Date of Birth', '14.96', 'pdf', '673e88d40a77f.pdf', '/uploads/M-2024-11-000000044/673e88d40a77f.pdf', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
(98, 44, 'Proof of Address', '17.87', 'pdf', '673e88d40c7dc.pdf', '/uploads/M-2024-11-000000044/673e88d40c7dc.pdf', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
(99, 44, '2x2 ID Picture', '5.17', 'jpg', '673e88d40e94b.jpg', '/uploads/M-2024-11-000000044/673e88d40e94b.jpg', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
(130, 58, 'PMES Certificate', '145.39', 'pdf', '675f92a7c0eff.pdf', '/uploads/M-2024-12-000000058/675f92a7c0eff.pdf', '2024-12-16 02:38:31', 'kathrinavaldezco553@gmail.com', '2024-12-16 02:38:31', NULL, NULL, NULL),
(131, 58, 'Proof of Identity', '180.96', 'jpeg', '675f92a7c26d8.jpeg', '/uploads/M-2024-12-000000058/675f92a7c26d8.jpeg', '2024-12-16 02:38:31', 'kathrinavaldezco553@gmail.com', '2024-12-16 02:38:31', NULL, NULL, NULL),
(132, 58, 'Proof of Date of Birth', '307.24', 'pdf', '675f92a7c3d8d.pdf', '/uploads/M-2024-12-000000058/675f92a7c3d8d.pdf', '2024-12-16 02:38:31', 'kathrinavaldezco553@gmail.com', '2024-12-16 02:38:31', NULL, NULL, NULL),
(133, 58, 'Proof of Address', '307.24', 'pdf', '675f92a7c5c17.pdf', '/uploads/M-2024-12-000000058/675f92a7c5c17.pdf', '2024-12-16 02:38:31', 'kathrinavaldezco553@gmail.com', '2024-12-16 02:38:31', NULL, NULL, NULL),
(134, 58, '2x2 ID Picture', '2598.45', 'jpg', '675f92a7c6caa.jpg', '/uploads/M-2024-12-000000058/675f92a7c6caa.jpg', '2024-12-16 02:38:31', 'kathrinavaldezco553@gmail.com', '2024-12-16 02:38:31', NULL, NULL, NULL),
(137, 62, 'PMES Certificate', '159.57', 'jpg', '67908d00d306f.jpg', '/uploads/M-2025-01-000000062/67908d00d306f.jpg', '2025-01-22 06:15:28', 'nesPaular@gmail.com', '2025-01-22 06:15:28', NULL, NULL, NULL),
(138, 62, 'Proof of Identity', '180.96', 'jpeg', '67908d00d5877.jpeg', '/uploads/M-2025-01-000000062/67908d00d5877.jpeg', '2025-01-22 06:15:28', 'nesPaular@gmail.com', '2025-01-22 06:15:28', NULL, NULL, NULL),
(139, 62, 'Proof of Date of Birth', '154.81', 'pdf', '67908d00d7956.pdf', '/uploads/M-2025-01-000000062/67908d00d7956.pdf', '2025-01-22 06:15:28', 'nesPaular@gmail.com', '2025-01-22 06:15:28', NULL, NULL, NULL),
(140, 62, 'Proof of Address', '154.81', 'pdf', '67908d00d96f6.pdf', '/uploads/M-2025-01-000000062/67908d00d96f6.pdf', '2025-01-22 06:15:28', 'nesPaular@gmail.com', '2025-01-22 06:15:28', NULL, NULL, NULL),
(141, 62, '2x2 ID Picture', '5.17', 'jpg', '67908d00dab78.jpg', '/uploads/M-2025-01-000000062/67908d00dab78.jpg', '2025-01-22 06:15:28', 'nesPaular@gmail.com', '2025-01-22 06:15:28', NULL, NULL, NULL),
(143, 63, 'PMES Certificate', '159.57', 'jpg', '6791d0315bd9f.jpg', '/uploads/M-2025-01-000000063/6791d0315bd9f.jpg', '2025-01-23 05:14:25', 'danieDoe@gmail.com', '2025-01-23 05:14:25', NULL, NULL, NULL),
(144, 63, 'Proof of Identity', '5.17', 'jpg', '6791d031614a8.jpg', '/uploads/M-2025-01-000000063/6791d031614a8.jpg', '2025-01-23 05:14:25', 'danieDoe@gmail.com', '2025-01-23 05:14:25', NULL, NULL, NULL),
(145, 63, 'Proof of Date of Birth', '154.81', 'pdf', '6791d03165f59.pdf', '/uploads/M-2025-01-000000063/6791d03165f59.pdf', '2025-01-23 05:14:25', 'danieDoe@gmail.com', '2025-01-23 05:14:25', NULL, NULL, NULL),
(146, 63, 'Proof of Address', '133.9', 'pdf', '6791d0316787c.pdf', '/uploads/M-2025-01-000000063/6791d0316787c.pdf', '2025-01-23 05:14:25', 'danieDoe@gmail.com', '2025-01-23 05:14:25', NULL, NULL, NULL),
(147, 63, '2x2 ID Picture', '5.17', 'jpg', '6791d03168f40.jpg', '/uploads/M-2025-01-000000063/6791d03168f40.jpg', '2025-01-23 05:14:25', 'danieDoe@gmail.com', '2025-01-23 05:14:25', NULL, NULL, NULL);

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
(115, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-11 00:52:54', NULL, '2024-12-11 00:52:54', NULL, NULL),
(119, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-11 01:13:03', NULL, '2024-12-11 01:13:03', NULL, NULL),
(124, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-11 01:20:33', NULL, '2024-12-11 01:20:33', NULL, NULL),
(128, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-11 01:28:57', NULL, '2024-12-11 01:28:57', NULL, NULL),
(130, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-11 02:52:53', NULL, '2024-12-11 02:52:53', NULL, NULL),
(131, 54, 'User', 'Generated An Invoice', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-11 03:04:01', NULL, '2024-12-11 03:04:01', NULL, NULL),
(133, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-11 06:09:42', NULL, '2024-12-11 06:09:42', NULL, NULL),
(134, 54, 'User', 'Generated An Invoice', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 02:28:44', NULL, '2024-12-12 02:28:44', NULL, NULL),
(135, 54, 'User', 'Payment Initiated', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 02:29:13', NULL, '2024-12-12 02:29:13', NULL, NULL),
(136, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 02:37:42', NULL, '2024-12-12 02:37:42', NULL, NULL),
(137, 54, 'Employee', 'Generated an Invoice', '::1', 'User kathPadilla@gmail.comGenerated an invoice for Initial Capital share', NULL, '2024-12-12 05:07:57', NULL, '2024-12-12 05:07:57', NULL, NULL),
(138, 54, 'User', 'Payment Initiated', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 05:08:27', NULL, '2024-12-12 05:08:27', NULL, NULL),
(139, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 05:14:15', NULL, '2024-12-12 05:14:15', NULL, NULL),
(140, 52, 'User', 'Generated An Invoice', '::1', 'User catherinemontalbo6231@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 07:46:03', NULL, '2024-12-12 07:46:03', NULL, NULL),
(141, 52, 'Employee', 'Generated an Invoice', '::1', 'User catherinemontalbo6231@gmail.comGenerated an invoice for Initial Capital share', NULL, '2024-12-12 07:46:13', NULL, '2024-12-12 07:46:13', NULL, NULL),
(142, 52, 'User', 'Payment Initiated', '::1', 'User catherinemontalbo6231@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 07:46:35', NULL, '2024-12-12 07:46:35', NULL, NULL),
(143, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 07:47:00', NULL, '2024-12-12 07:47:00', NULL, NULL),
(144, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 07:47:26', NULL, '2024-12-12 07:47:26', NULL, NULL),
(145, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 07:47:54', NULL, '2024-12-12 07:47:54', NULL, NULL),
(146, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 07:48:35', NULL, '2024-12-12 07:48:35', NULL, NULL),
(147, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 07:50:38', NULL, '2024-12-12 07:50:38', NULL, NULL),
(148, 52, 'Employee', 'Generated an Invoice', '::1', 'User catherinemontalbo6231@gmail.comGenerated an invoice for Initial Capital share', NULL, '2024-12-12 07:53:43', NULL, '2024-12-12 07:53:43', NULL, NULL),
(149, 52, 'User', 'Payment Initiated', '::1', 'User catherinemontalbo6231@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 07:54:09', NULL, '2024-12-12 07:54:09', NULL, NULL),
(150, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 07:54:29', NULL, '2024-12-12 07:54:29', NULL, NULL),
(151, 52, 'User', 'Generated An Invoice', '::1', 'User catherinemontalbo6231@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 08:14:32', NULL, '2024-12-12 08:14:32', NULL, NULL),
(152, 52, 'Employee', 'Generated an Invoice', '::1', 'User catherinemontalbo6231@gmail.comGenerated an invoice for Initial Capital share', NULL, '2024-12-12 08:15:01', NULL, '2024-12-12 08:15:01', NULL, NULL),
(153, 52, 'User', 'Payment Initiated', '::1', 'User catherinemontalbo6231@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 08:15:22', NULL, '2024-12-12 08:15:22', NULL, NULL),
(157, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 08:17:39', NULL, '2024-12-12 08:17:39', NULL, NULL),
(158, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 08:17:53', NULL, '2024-12-12 08:17:53', NULL, NULL),
(159, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-12 08:19:32', NULL, '2024-12-12 08:19:32', NULL, NULL),
(160, 54, 'User', 'Generated An Invoice', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 01:52:12', NULL, '2024-12-13 01:52:12', NULL, NULL),
(161, 54, 'Employee', 'Generated an Invoice', '::1', 'User kathPadilla@gmail.comGenerated an invoice for Initial Capital share', NULL, '2024-12-13 01:52:25', NULL, '2024-12-13 01:52:25', NULL, NULL),
(162, 54, 'User', 'Payment Initiated', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 01:52:50', NULL, '2024-12-13 01:52:50', NULL, NULL),
(163, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 01:53:11', NULL, '2024-12-13 01:53:11', NULL, NULL),
(164, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 01:53:59', NULL, '2024-12-13 01:53:59', NULL, NULL),
(165, 54, 'User', 'Generated An Invoice', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 02:11:46', NULL, '2024-12-13 02:11:46', NULL, NULL),
(166, 54, 'Employee', 'Generated an Invoice', '::1', 'User kathPadilla@gmail.comGenerated an invoice for Initial Capital share', NULL, '2024-12-13 02:11:57', NULL, '2024-12-13 02:11:57', NULL, NULL),
(167, 54, 'User', 'Payment Initiated', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 02:12:24', NULL, '2024-12-13 02:12:24', NULL, NULL),
(172, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 02:14:55', NULL, '2024-12-13 02:14:55', NULL, NULL),
(173, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 02:15:15', NULL, '2024-12-13 02:15:15', NULL, NULL),
(174, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 02:15:43', NULL, '2024-12-13 02:15:43', NULL, NULL),
(175, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 02:17:27', NULL, '2024-12-13 02:17:27', NULL, NULL),
(176, 54, 'User', 'Generated An Invoice', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 02:39:59', NULL, '2024-12-13 02:39:59', NULL, NULL),
(177, 54, 'Employee', 'Generated an Invoice', '::1', 'User kathPadilla@gmail.comGenerated an invoice for Initial Capital share', NULL, '2024-12-13 02:40:10', NULL, '2024-12-13 02:40:10', NULL, NULL),
(178, 54, 'User', 'Payment Initiated', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 02:40:26', NULL, '2024-12-13 02:40:26', NULL, NULL),
(179, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 02:42:05', NULL, '2024-12-13 02:42:05', NULL, NULL),
(180, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 02:42:15', NULL, '2024-12-13 02:42:15', NULL, NULL),
(183, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 05:04:51', NULL, '2024-12-13 05:04:51', NULL, NULL),
(184, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 05:04:57', NULL, '2024-12-13 05:04:57', NULL, NULL),
(188, 52, 'Employee', 'Generated an Invoice', '::1', 'User catherinemontalbo6231@gmail.comGenerated an invoice for Initial Capital share', NULL, '2024-12-13 05:32:31', NULL, '2024-12-13 05:32:31', NULL, NULL),
(189, 52, 'User', 'Payment Initiated', '::1', 'User catherinemontalbo6231@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 05:32:59', NULL, '2024-12-13 05:32:59', NULL, NULL),
(190, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 05:33:29', NULL, '2024-12-13 05:33:29', NULL, NULL),
(191, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 05:33:46', NULL, '2024-12-13 05:33:46', NULL, NULL),
(192, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 05:33:53', NULL, '2024-12-13 05:33:53', NULL, NULL),
(195, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 05:54:11', NULL, '2024-12-13 05:54:11', NULL, NULL),
(196, 54, 'Employee', 'Generated an Invoice', '::1', 'User kathPadilla@gmail.comGenerated an invoice for Initial Capital share', NULL, '2024-12-13 05:56:42', NULL, '2024-12-13 05:56:42', NULL, NULL),
(197, 54, 'User', 'Payment Initiated', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 05:57:09', NULL, '2024-12-13 05:57:09', NULL, NULL),
(198, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 05:57:27', NULL, '2024-12-13 05:57:27', NULL, NULL),
(199, 54, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2024-12-13 06:02:31', NULL, '2024-12-13 06:02:31', NULL, NULL),
(200, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 06:02:53', NULL, '2024-12-13 06:02:53', NULL, NULL),
(201, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 06:03:29', NULL, '2024-12-13 06:03:29', NULL, NULL),
(202, 54, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2024-12-13 06:04:14', NULL, '2024-12-13 06:04:14', NULL, NULL),
(203, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 06:16:03', NULL, '2024-12-13 06:16:03', NULL, NULL),
(204, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 06:17:16', NULL, '2024-12-13 06:17:16', NULL, NULL),
(205, 54, 'User', 'Generated An Invoice', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 06:19:15', NULL, '2024-12-13 06:19:15', NULL, NULL),
(206, 54, 'Employee', 'Generated an Invoice', '::1', 'User kathPadilla@gmail.comGenerated an invoice for Initial Capital share', NULL, '2024-12-13 06:19:55', NULL, '2024-12-13 06:19:55', NULL, NULL),
(207, 54, 'User', 'Payment Initiated', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 06:20:11', NULL, '2024-12-13 06:20:11', NULL, NULL),
(210, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 06:24:41', NULL, '2024-12-13 06:24:41', NULL, NULL),
(211, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 06:25:54', NULL, '2024-12-13 06:25:54', NULL, NULL),
(213, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 06:29:11', NULL, '2024-12-13 06:29:11', NULL, NULL),
(214, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 06:30:52', NULL, '2024-12-13 06:30:52', NULL, NULL),
(215, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 06:34:21', NULL, '2024-12-13 06:34:21', NULL, NULL),
(222, 54, 'Employee', 'Generated an Invoice', '::1', 'User kathPadilla@gmail.comGenerated an invoice for Initial Capital share', NULL, '2024-12-13 08:09:09', NULL, '2024-12-13 08:09:09', NULL, NULL),
(223, 54, 'User', 'Payment Initiated', '::1', 'User kathPadilla@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 08:09:34', NULL, '2024-12-13 08:09:34', NULL, NULL),
(224, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 08:12:10', NULL, '2024-12-13 08:12:10', NULL, NULL),
(231, 54, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2024-12-13 08:17:23', NULL, '2024-12-13 08:17:23', NULL, NULL),
(232, 54, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2024-12-13 08:24:23', NULL, '2024-12-13 08:24:23', NULL, NULL),
(233, 54, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2024-12-13 08:34:48', NULL, '2024-12-13 08:34:48', NULL, NULL),
(234, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 08:51:23', NULL, '2024-12-13 08:51:23', NULL, NULL),
(235, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 08:51:32', NULL, '2024-12-13 08:51:32', NULL, NULL),
(236, 54, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2024-12-13 08:51:56', NULL, '2024-12-13 08:51:56', NULL, NULL),
(237, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-13 08:54:49', NULL, '2024-12-13 08:54:49', NULL, NULL),
(245, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-16 01:52:53', NULL, '2024-12-16 01:52:53', NULL, NULL),
(246, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-16 01:53:02', NULL, '2024-12-16 01:53:02', NULL, NULL),
(247, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-16 01:53:27', NULL, '2024-12-16 01:53:27', NULL, NULL),
(254, 58, 'User', 'Generated An Invoice', '::1', 'User kathrinavaldezco553@gmail.com Generated an Invoice for membership', NULL, '2024-12-16 02:31:22', NULL, '2024-12-16 02:31:22', NULL, NULL),
(255, 58, 'User', 'Payment Initiated', '::1', 'User kathrinavaldezco553@gmail.com Generated an Invoice for membership', NULL, '2024-12-16 02:31:44', NULL, '2024-12-16 02:31:44', NULL, NULL),
(256, 58, 'Employee', 'Generated an Invoice', '::1', 'User kathrinavaldezco553@gmail.comGenerated an invoice for Initial Capital share', NULL, '2024-12-16 02:32:01', NULL, '2024-12-16 02:32:01', NULL, NULL),
(257, 58, 'User', 'Payment Initiated', '::1', 'User kathrinavaldezco553@gmail.com Generated an Invoice for membership', NULL, '2024-12-16 02:32:52', NULL, '2024-12-16 02:32:52', NULL, NULL),
(258, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-16 02:36:49', NULL, '2024-12-16 02:36:49', NULL, NULL),
(259, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-16 02:37:01', NULL, '2024-12-16 02:37:01', NULL, NULL),
(260, 2, 'Employee', 'Membership Application Approved', '::1', 'User john.doe@example.com Approved a new member in the database', NULL, '2024-12-16 02:39:43', NULL, '2024-12-16 02:39:43', NULL, NULL),
(261, 58, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2024-12-26 06:37:00', NULL, '2024-12-26 06:37:00', NULL, NULL),
(262, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2024-12-26 06:42:05', NULL, '2024-12-26 06:42:05', NULL, NULL),
(263, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-16 06:51:31', NULL, '2025-01-16 06:51:31', NULL, NULL),
(264, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-16 06:52:40', NULL, '2025-01-16 06:52:40', NULL, NULL),
(265, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-16 07:24:03', NULL, '2025-01-16 07:24:03', NULL, NULL),
(266, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-16 07:26:19', NULL, '2025-01-16 07:26:19', NULL, NULL),
(267, 2, 'Admin-approver', 'Loan Application Rejected', '::1', 'User sysadmin Rejected an applicant in the form', NULL, '2025-01-16 07:36:49', NULL, '2025-01-16 07:36:49', NULL, NULL),
(268, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-17 08:27:47', NULL, '2025-01-17 08:27:47', NULL, NULL),
(269, 33, 'Cashier', 'Loan Amount Disbursed To Account', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-20 00:34:28', NULL, '2025-01-20 00:34:28', NULL, NULL),
(270, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-20 02:14:46', NULL, '2025-01-20 02:14:46', NULL, NULL),
(271, 58, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-21 02:18:37', NULL, '2025-01-21 02:18:37', NULL, NULL),
(272, 58, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-21 05:47:37', NULL, '2025-01-21 05:47:37', NULL, NULL),
(273, 58, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-21 05:47:59', NULL, '2025-01-21 05:47:59', NULL, NULL),
(274, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-21 07:58:11', NULL, '2025-01-21 07:58:11', NULL, NULL),
(275, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-21 08:20:07', NULL, '2025-01-21 08:20:07', NULL, NULL),
(276, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-21 08:41:46', NULL, '2025-01-21 08:41:46', NULL, NULL),
(277, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-22 01:21:06', NULL, '2025-01-22 01:21:06', NULL, NULL),
(278, 2, 'Employee', 'Membership Application Approved', '::1', 'User john.doe@example.com Approved a new member in the database', NULL, '2025-01-22 02:30:58', NULL, '2025-01-22 02:30:58', NULL, NULL),
(279, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-22 02:35:50', NULL, '2025-01-22 02:35:50', NULL, NULL),
(280, 58, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-22 04:30:26', NULL, '2025-01-22 04:30:26', NULL, NULL),
(281, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2025-01-22 04:33:23', NULL, '2025-01-22 04:33:23', NULL, NULL),
(282, 62, 'User', 'Generated An Invoice', '::1', 'User nesPaular@gmail.com Generated an Invoice for membership', NULL, '2025-01-22 05:55:18', NULL, '2025-01-22 05:55:18', NULL, NULL),
(283, 62, 'User', 'Generated An Invoice', '::1', 'User nesPaular@gmail.com Generated an Invoice for membership', NULL, '2025-01-22 05:55:25', NULL, '2025-01-22 05:55:25', NULL, NULL),
(284, 62, 'User', 'Generated An Invoice', '::1', 'User nesPaular@gmail.com Generated an Invoice for membership', NULL, '2025-01-22 05:55:53', NULL, '2025-01-22 05:55:53', NULL, NULL),
(285, 62, 'Employee', 'Generated an Invoice', '::1', 'User nesPaular@gmail.comGenerated an invoice for Initial Capital share', NULL, '2025-01-22 05:58:28', NULL, '2025-01-22 05:58:28', NULL, NULL),
(286, 62, 'User', 'Payment Initiated', '::1', 'User nesPaular@gmail.com Generated an Invoice for membership', NULL, '2025-01-22 05:59:02', NULL, '2025-01-22 05:59:02', NULL, NULL),
(287, 62, 'User', 'Generated An Invoice', '::1', 'User nesPaular@gmail.com Generated an Invoice for membership', NULL, '2025-01-22 05:59:39', NULL, '2025-01-22 05:59:39', NULL, NULL),
(288, 62, 'User', 'Payment Initiated', '::1', 'User nesPaular@gmail.com Generated an Invoice for membership', NULL, '2025-01-22 06:07:45', NULL, '2025-01-22 06:07:45', NULL, NULL),
(289, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2025-01-22 06:08:16', NULL, '2025-01-22 06:08:16', NULL, NULL),
(290, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2025-01-22 06:10:02', NULL, '2025-01-22 06:10:02', NULL, NULL),
(291, 2, 'Employee', 'Membership Application Approved', '::1', 'User john.doe@example.com Approved a new member in the database', NULL, '2025-01-22 06:15:52', NULL, '2025-01-22 06:15:52', NULL, NULL),
(292, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-22 06:17:04', NULL, '2025-01-22 06:17:04', NULL, NULL),
(293, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-22 07:55:32', NULL, '2025-01-22 07:55:32', NULL, NULL),
(294, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-22 08:11:56', NULL, '2025-01-22 08:11:56', NULL, NULL),
(295, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-22 08:13:50', NULL, '2025-01-22 08:13:50', NULL, NULL),
(296, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-22 08:15:41', NULL, '2025-01-22 08:15:41', NULL, NULL),
(297, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-22 08:36:57', NULL, '2025-01-22 08:36:57', NULL, NULL),
(298, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-22 09:23:24', NULL, '2025-01-22 09:23:24', NULL, NULL),
(302, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-22 09:31:45', NULL, '2025-01-22 09:31:45', NULL, NULL),
(306, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-22 09:45:06', NULL, '2025-01-22 09:45:06', NULL, NULL),
(307, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-23 01:17:35', NULL, '2025-01-23 01:17:35', NULL, NULL),
(308, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-23 01:26:54', NULL, '2025-01-23 01:26:54', NULL, NULL),
(309, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-23 01:30:54', NULL, '2025-01-23 01:30:54', NULL, NULL),
(310, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-23 01:31:37', NULL, '2025-01-23 01:31:37', NULL, NULL),
(311, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-23 02:05:51', NULL, '2025-01-23 02:05:51', NULL, NULL),
(312, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-23 03:36:26', NULL, '2025-01-23 03:36:26', NULL, NULL),
(313, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-23 04:47:58', NULL, '2025-01-23 04:47:58', NULL, NULL),
(314, 63, 'User', 'Generated An Invoice', '::1', 'User danieDoe@gmail.com Generated an Invoice for membership', NULL, '2025-01-23 05:11:45', NULL, '2025-01-23 05:11:45', NULL, NULL),
(315, 63, 'User', 'Payment Initiated', '::1', 'User danieDoe@gmail.com Generated an Invoice for membership', NULL, '2025-01-23 05:12:14', NULL, '2025-01-23 05:12:14', NULL, NULL),
(316, 63, 'Employee', 'Generated an Invoice', '::1', 'User danieDoe@gmail.comGenerated an invoice for Initial Capital share', NULL, '2025-01-23 05:12:39', NULL, '2025-01-23 05:12:39', NULL, NULL),
(317, 63, 'User', 'Payment Initiated', '::1', 'User danieDoe@gmail.com Generated an Invoice for membership', NULL, '2025-01-23 05:13:07', NULL, '2025-01-23 05:13:07', NULL, NULL),
(318, 2, 'Employee', 'Membership Application Approved', '::1', 'User john.doe@example.com Approved a new member in the database', NULL, '2025-01-23 05:15:03', NULL, '2025-01-23 05:15:03', NULL, NULL),
(319, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2025-01-23 05:15:29', NULL, '2025-01-23 05:15:29', NULL, NULL),
(320, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2025-01-23 05:15:38', NULL, '2025-01-23 05:15:38', NULL, NULL),
(321, 62, 'Member', 'User Payment Initiated', '::1', 'User sysadmin Generated an Invoice for membership', NULL, '2025-01-23 05:19:00', NULL, '2025-01-23 05:19:00', NULL, NULL),
(322, 2, 'Admin-approver', 'Loan Application Approved', '::1', 'User sysadmin Approved a Loan Application', NULL, '2025-01-23 06:21:19', NULL, '2025-01-23 06:21:19', NULL, NULL),
(323, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2025-01-23 08:50:50', NULL, '2025-01-23 08:50:50', NULL, NULL),
(324, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2025-01-23 08:52:24', NULL, '2025-01-23 08:52:24', NULL, NULL),
(325, 33, 'Cashier', 'Payment Approved', '::1', 'User sample@gmail.com Generated an Invoice for membership', NULL, '2025-01-24 01:37:54', NULL, '2025-01-24 01:37:54', NULL, NULL);

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
(524, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-11 01:12:23', NULL, '2024-12-11 01:12:23', NULL, NULL),
(527, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment', NULL, 0, NULL, 'miguelEnzo@gmail.com', '2024-12-11 01:16:02', NULL, '2024-12-11 01:16:03', NULL, NULL),
(528, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-11 01:19:56', NULL, '2024-12-11 01:19:56', NULL, NULL),
(530, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-11 01:27:11', NULL, '2024-12-11 01:27:11', NULL, NULL),
(531, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-11 01:28:47', NULL, '2024-12-11 01:28:47', NULL, NULL),
(533, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment', NULL, 0, NULL, 'miguelEnzo@gmail.com', '2024-12-11 01:29:39', NULL, '2024-12-11 01:29:39', NULL, NULL),
(535, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment', NULL, 0, NULL, 'miguelEnzo@gmail.com', '2024-12-11 05:51:00', NULL, '2024-12-11 05:51:00', NULL, NULL),
(536, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment formembership_fee', 'http://localhost/cycommph/Cashiering/cashier_billing/54', 0, NULL, 'kathPadilla@gmail.com', '2024-12-12 02:29:13', NULL, '2024-12-12 02:29:13', NULL, NULL),
(537, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/54', 0, NULL, 'kathPadilla@gmail.com', '2024-12-12 05:08:27', NULL, '2024-12-12 05:08:27', NULL, NULL),
(538, 33, 'New Online Payment Received!', 'Catherine Montalbo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/52', 0, NULL, 'catherinemontalbo6231@gmail.com', '2024-12-12 07:46:35', NULL, '2024-12-12 07:46:35', NULL, NULL),
(539, 33, 'New Online Payment Received!', 'Catherine Montalbo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/52', 0, NULL, 'catherinemontalbo6231@gmail.com', '2024-12-12 07:54:09', NULL, '2024-12-12 07:54:09', NULL, NULL),
(540, 33, 'New Online Payment Received!', 'Catherine Montalbo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/52', 0, NULL, 'catherinemontalbo6231@gmail.com', '2024-12-12 08:15:22', NULL, '2024-12-12 08:15:22', NULL, NULL),
(541, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-12 08:17:09', NULL, '2024-12-12 08:17:09', NULL, NULL),
(542, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/54', 0, NULL, 'kathPadilla@gmail.com', '2024-12-13 01:52:50', NULL, '2024-12-13 01:52:50', NULL, NULL),
(543, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/54', 0, NULL, 'kathPadilla@gmail.com', '2024-12-13 02:12:24', NULL, '2024-12-13 02:12:24', NULL, NULL),
(544, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment formembership_fee', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-13 02:13:25', NULL, '2024-12-13 02:13:25', NULL, NULL),
(545, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-13 02:14:02', NULL, '2024-12-13 02:14:02', NULL, NULL),
(546, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/54', 0, NULL, 'kathPadilla@gmail.com', '2024-12-13 02:40:25', NULL, '2024-12-13 02:40:26', NULL, NULL),
(547, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-13 03:41:48', NULL, '2024-12-13 03:41:48', NULL, NULL),
(548, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-13 05:31:57', NULL, '2024-12-13 05:31:58', NULL, NULL),
(549, 33, 'New Online Payment Received!', 'Catherine Montalbo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/52', 0, NULL, 'catherinemontalbo6231@gmail.com', '2024-12-13 05:32:59', NULL, '2024-12-13 05:32:59', NULL, NULL),
(550, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-13 05:50:06', NULL, '2024-12-13 05:50:06', NULL, NULL),
(551, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/54', 0, NULL, 'kathPadilla@gmail.com', '2024-12-13 05:57:09', NULL, '2024-12-13 05:57:09', NULL, NULL),
(552, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment', NULL, 0, NULL, 'kathPadilla@gmail.com', '2024-12-13 06:02:31', NULL, '2024-12-13 06:02:31', NULL, NULL),
(553, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment', NULL, 0, NULL, 'kathPadilla@gmail.com', '2024-12-13 06:04:14', NULL, '2024-12-13 06:04:14', NULL, NULL),
(554, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/54', 0, NULL, 'kathPadilla@gmail.com', '2024-12-13 06:20:11', NULL, '2024-12-13 06:20:11', NULL, NULL),
(555, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-13 06:24:22', NULL, '2024-12-13 06:24:22', NULL, NULL),
(556, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment', NULL, 0, NULL, 'miguelEnzo@gmail.com', '2024-12-13 06:26:21', NULL, '2024-12-13 06:26:21', NULL, NULL),
(561, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-13 08:08:49', NULL, '2024-12-13 08:08:49', NULL, NULL),
(562, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/54', 0, NULL, 'kathPadilla@gmail.com', '2024-12-13 08:09:34', NULL, '2024-12-13 08:09:34', NULL, NULL),
(569, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment', NULL, 0, NULL, 'kathPadilla@gmail.com', '2024-12-13 08:17:23', NULL, '2024-12-13 08:17:23', NULL, NULL),
(570, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment', NULL, 0, NULL, 'kathPadilla@gmail.com', '2024-12-13 08:24:23', NULL, '2024-12-13 08:24:23', NULL, NULL),
(571, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment', NULL, 0, NULL, 'kathPadilla@gmail.com', '2024-12-13 08:34:48', NULL, '2024-12-13 08:34:48', NULL, NULL),
(572, 33, 'New Online Payment Received!', 'Kathryn Padilla submitted an online payment', NULL, 0, NULL, 'kathPadilla@gmail.com', '2024-12-13 08:51:55', NULL, '2024-12-13 08:51:56', NULL, NULL),
(573, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/57', 0, NULL, 'miguelEnzo@gmail.com', '2024-12-16 01:46:37', NULL, '2024-12-16 01:46:37', NULL, NULL),
(574, 33, 'New Online Payment Received!', 'Kathrina Valdezco submitted an online payment formembership_fee', 'http://localhost/cycommph/Cashiering/cashier_billing/56', 0, NULL, 'kathrinavaldezco553@gmail.com', '2024-12-16 01:48:11', NULL, '2024-12-16 01:48:11', NULL, NULL),
(575, 33, 'New Online Payment Received!', 'Kathrina Valdezco submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/56', 0, NULL, 'kathrinavaldezco553@gmail.com', '2024-12-16 01:51:20', NULL, '2024-12-16 01:51:21', NULL, NULL),
(576, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment', NULL, 0, NULL, 'miguelEnzo@gmail.com', '2024-12-16 01:56:06', NULL, '2024-12-16 01:56:06', NULL, NULL),
(577, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment', NULL, 0, NULL, 'miguelEnzo@gmail.com', '2024-12-16 02:04:37', NULL, '2024-12-16 02:04:37', NULL, NULL),
(578, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment', NULL, 0, NULL, 'miguelEnzo@gmail.com', '2024-12-16 02:17:25', NULL, '2024-12-16 02:17:25', NULL, NULL),
(579, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment', NULL, 0, NULL, 'miguelEnzo@gmail.com', '2024-12-16 02:17:42', NULL, '2024-12-16 02:17:42', NULL, NULL),
(580, 33, 'New Online Payment Received!', 'Miguel Enzo submitted an online payment', NULL, 0, NULL, 'miguelEnzo@gmail.com', '2024-12-16 02:18:56', NULL, '2024-12-16 02:18:56', NULL, NULL),
(581, 33, 'New Online Payment Received!', 'Kathrina Valdezco submitted an online payment formembership_fee', 'http://localhost/cycommph/Cashiering/cashier_billing/58', 0, NULL, 'kathrinavaldezco553@gmail.com', '2024-12-16 02:31:44', NULL, '2024-12-16 02:31:44', NULL, NULL),
(582, 33, 'New Online Payment Received!', 'Kathrina Valdezco submitted an online payment forcapital_contribution', 'http://localhost/cycommph/Cashiering/cashier_billing/58', 0, NULL, 'kathrinavaldezco553@gmail.com', '2024-12-16 02:32:52', NULL, '2024-12-16 02:32:52', NULL, NULL),
(583, 2, 'New Information sheet received', 'Kathrina Valdezco submitted a membership information sheet form', '', 0, NULL, 'kathrinavaldezco553@gmail.com', '2024-12-16 02:38:31', NULL, '2024-12-16 02:38:31', NULL, NULL),
(584, 33, 'New Online Payment Received!', 'Kathrina Valdezco submitted an online payment', NULL, 0, NULL, 'kathrinavaldezco553@gmail.com', '2024-12-26 06:37:00', NULL, '2024-12-26 06:37:00', NULL, NULL),
(585, 33, 'New Online Payment Received!', 'Kathrina Valdezco submitted an online payment', NULL, 0, NULL, 'kathrinavaldezco553@gmail.com', '2025-01-21 02:18:37', NULL, '2025-01-21 02:18:37', NULL, NULL),
(586, 33, 'New Online Payment Received!', 'Kathrina Valdezco submitted an online payment', NULL, 0, NULL, 'kathrinavaldezco553@gmail.com', '2025-01-21 05:47:37', NULL, '2025-01-21 05:47:37', NULL, NULL),
(587, 33, 'New Online Payment Received!', 'Kathrina Valdezco submitted an online payment', NULL, 0, NULL, 'kathrinavaldezco553@gmail.com', '2025-01-21 05:47:59', NULL, '2025-01-21 05:47:59', NULL, NULL),
(588, 33, 'New Online Payment Received!', 'Kathrina Valdezco submitted an online payment', NULL, 0, NULL, 'kathrinavaldezco553@gmail.com', '2025-01-22 04:30:25', NULL, '2025-01-22 04:30:26', NULL, NULL),
(589, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/62', 0, NULL, 'nesPaular@gmail.com', '2025-01-22 05:59:02', NULL, '2025-01-22 05:59:02', NULL, NULL),
(590, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/62', 0, NULL, 'nesPaular@gmail.com', '2025-01-22 06:07:45', NULL, '2025-01-22 06:07:45', NULL, NULL),
(591, 2, 'New Information sheet received', 'Nes Paular submitted a membership information sheet form', '', 0, NULL, 'nesPaular@gmail.com', '2025-01-22 06:15:28', NULL, '2025-01-22 06:15:28', NULL, NULL),
(592, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-22 07:55:32', NULL, '2025-01-22 07:55:32', NULL, NULL),
(593, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-22 08:11:56', NULL, '2025-01-22 08:11:56', NULL, NULL),
(594, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-22 08:13:50', NULL, '2025-01-22 08:13:50', NULL, NULL),
(595, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-22 08:15:40', NULL, '2025-01-22 08:15:41', NULL, NULL),
(596, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-22 08:36:57', NULL, '2025-01-22 08:36:57', NULL, NULL),
(597, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-22 09:23:24', NULL, '2025-01-22 09:23:24', NULL, NULL),
(601, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-22 09:31:45', NULL, '2025-01-22 09:31:45', NULL, NULL),
(605, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-22 09:45:06', NULL, '2025-01-22 09:45:06', NULL, NULL),
(606, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-23 01:17:35', NULL, '2025-01-23 01:17:35', NULL, NULL),
(607, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-23 01:31:37', NULL, '2025-01-23 01:31:37', NULL, NULL),
(608, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-23 02:05:51', NULL, '2025-01-23 02:05:51', NULL, NULL),
(609, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-23 03:36:26', NULL, '2025-01-23 03:36:26', NULL, NULL),
(610, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-23 04:47:58', NULL, '2025-01-23 04:47:58', NULL, NULL),
(611, 33, 'New Online Payment Received!', 'Daniel Doe submitted an online payment forMembership Fee', 'http://localhost/cycommph/Cashiering/cashier_billing/63', 0, NULL, 'danieDoe@gmail.com', '2025-01-23 05:12:14', NULL, '2025-01-23 05:12:14', NULL, NULL),
(612, 33, 'New Online Payment Received!', 'Daniel Doe submitted an online payment forCapital Share', 'http://localhost/cycommph/Cashiering/cashier_billing/63', 0, NULL, 'danieDoe@gmail.com', '2025-01-23 05:13:07', NULL, '2025-01-23 05:13:07', NULL, NULL),
(613, 2, 'New Information sheet received', 'Daniel Doe submitted a membership information sheet form', '', 0, NULL, 'danieDoe@gmail.com', '2025-01-23 05:14:25', NULL, '2025-01-23 05:14:25', NULL, NULL),
(614, 33, 'New Online Payment Received!', 'Nes Paular submitted an online payment', NULL, 0, NULL, 'nesPaular@gmail.com', '2025-01-23 05:18:59', NULL, '2025-01-23 05:19:00', NULL, NULL);

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
(1, 1, 53, '375871fb-6c63-4f2a-adfc-da96884a6349', 'processing', '2024-05-20 21:34:25', 'sysadmin', '2024-11-15 08:32:55', 'sysadmin', NULL, NULL),
(3, 33, 51, 'b777fad1-b431-4266-b74e-1042d1d32fd4', 'processing', '2024-09-04 06:48:50', 'sample@gmail.com', '2024-11-14 02:10:15', 'sample@gmail.com', NULL, NULL),
(4, 5, 52, '3a0acd83-41e1-4afe-a362-72792e1b28e5', 'processing', '2024-10-22 04:51:29', 'angela@gmail.com', '2024-11-15 07:10:43', 'person@gmail.com', NULL, NULL),
(5, 5, 54, '8a7d3cc3-cc28-4791-ab25-ed2f8f385d6b', 'processing', '2024-10-22 05:09:50', 'angela@gmail.com', '2024-11-19 01:40:15', 'cathpacunla@gmail.com', NULL, NULL),
(6, 5, 58, 'dfbcd0db-10fe-4af0-8e7c-c3d4ba724418', 'processing', '2024-10-22 05:15:27', 'angela@gmail.com', '2024-12-16 02:30:27', 'miguelEnzo@gmail.com', NULL, NULL),
(7, 1, NULL, '36aa2a4b-5107-41b8-a7bb-2feac38e64d4', 'available', '2024-10-22 05:37:18', 'azoresmelmar@gmail.com', '2024-10-22 05:37:19', NULL, NULL, NULL),
(8, 3, NULL, '5252db9c-94d9-4176-bd15-c0f693d5fac4', 'available', '2024-10-28 03:18:22', 'jane@gmail.com', '2024-10-28 03:18:22', NULL, NULL, NULL),
(12, 53, 55, 'b49fd5bc-9657-4ddf-b979-f175b0e7df42', 'processing', '2024-11-15 08:51:11', 'cathpacunla@gmail.com', '2024-11-20 02:48:42', 'sysadmin', NULL, NULL),
(13, 44, NULL, 'f4e84a8d-40a2-47d0-8739-71d9385bab3f', 'available', '2024-11-21 01:11:47', 'person@gmail.com', '2024-11-21 01:11:48', NULL, NULL, NULL),
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
(56, 58, NULL, '828a8005-a55e-4c37-a9e7-82475a1d1ac5', 'available', '2024-12-23 03:42:59', 'sysadmin', '2024-12-23 03:42:59', NULL, NULL, NULL),
(57, 58, NULL, '19d8ac19-59c5-4e74-a8a8-f156db5384e2', 'available', '2024-12-23 03:44:14', 'sysadmin', '2024-12-23 03:44:14', NULL, NULL, NULL),
(59, 58, NULL, '9a155345-40c5-4e73-8b3c-fe7350115570', 'available', '2024-12-23 06:24:08', 'sysadmin', '2024-12-23 06:24:08', NULL, NULL, NULL),
(60, 58, 62, 'c5a91673-8275-4af3-a19d-bd48bc2fdbe4', 'processing', '2024-12-26 00:43:24', 'sysadmin', '2025-01-22 05:22:51', 'sysadmin', NULL, NULL),
(61, 58, NULL, '8a9e5ff7-2b23-4e5a-8b62-938eb1cb76e4', 'available', '2024-12-26 03:30:39', 'sysadmin', '2024-12-26 03:30:39', NULL, NULL, NULL),
(62, 58, NULL, '31627a13-20ef-4f7d-b769-4f0919ded355', 'available', '2024-12-26 03:30:42', 'sysadmin', '2024-12-26 03:30:42', NULL, NULL, NULL),
(63, 58, NULL, '84ede82e-f884-4fa9-a09e-35234e255a7e', 'available', '2024-12-26 03:52:27', 'sysadmin', '2024-12-26 03:52:27', NULL, NULL, NULL),
(64, 58, NULL, 'c16d41bf-dc1f-44ff-9a32-70344279c8cc', 'available', '2024-12-26 03:52:52', 'sysadmin', '2024-12-26 03:52:52', NULL, NULL, NULL),
(65, 62, 63, '71d41f36-791a-4853-a15b-90c5c8e8c8a8', 'processing', '2025-01-22 06:15:28', 'nesPaular@gmail.com', '2025-01-23 04:58:00', 'nesPaular@gmail.com', NULL, NULL),
(66, 63, NULL, '679f40b5-8c35-4e35-bb31-aef82aae19da', 'available', '2025-01-23 05:14:25', 'danieDoe@gmail.com', '2025-01-23 05:14:25', NULL, NULL, NULL),
(67, 63, NULL, 'bcd7646c-f0a2-4924-ae0f-86989af08a5a', 'available', '2025-01-23 05:54:16', 'sysadmin', '2025-01-23 05:54:16', NULL, NULL, NULL),
(68, 63, NULL, '4a3cd438-4465-457f-a567-d869e1e5d2f9', 'available', '2025-01-23 06:31:11', 'sysadmin', '2025-01-23 06:31:11', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_address`
--
ALTER TABLE `billing_address`
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
  ADD KEY `payment_option_id_ibfk_1` (`payment_option_id`);

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
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `unit_id` (`unit_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_address`
--
ALTER TABLE `billing_address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `capital_contributions`
--
ALTER TABLE `capital_contributions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `cap_share_account_dues`
--
ALTER TABLE `cap_share_account_dues`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=889;

--
-- AUTO_INCREMENT for table `cashiering_invoice`
--
ALTER TABLE `cashiering_invoice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=728;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `financial_accounts`
--
ALTER TABLE `financial_accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `investment_property_types`
--
ALTER TABLE `investment_property_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_particulars`
--
ALTER TABLE `invoice_particulars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=689;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `loan_repayment_schedules`
--
ALTER TABLE `loan_repayment_schedules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `member_beneficiaries`
--
ALTER TABLE `member_beneficiaries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `member_educ_backgrounds`
--
ALTER TABLE `member_educ_backgrounds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `member_work_backgrounds`
--
ALTER TABLE `member_work_backgrounds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `official_receipts`
--
ALTER TABLE `official_receipts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=813;

--
-- AUTO_INCREMENT for table `or_particulars`
--
ALTER TABLE `or_particulars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=731;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=737;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction_category`
--
ALTER TABLE `transaction_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=615;

--
-- AUTO_INCREMENT for table `user_referrals`
--
ALTER TABLE `user_referrals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing_address`
--
ALTER TABLE `billing_address`
  ADD CONSTRAINT `user_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
  ADD CONSTRAINT `payment_option_id_ibfk_1` FOREIGN KEY (`payment_option_id`) REFERENCES `payment_options` (`id`) ON DELETE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
