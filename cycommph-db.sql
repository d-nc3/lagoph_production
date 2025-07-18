-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2024 at 10:56 AM
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

INSERT INTO `users` (`id`,`first_name`,`last_name`, `email`, `password`, `role`, `status`, `login_attempts`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Melmar', 'Azores', 'azoresmelmar@gmail.com', '$2y$10$6FEqiqnbIcWJGTweGmpz8.hSarSXzwRC0neSfNHBRLnS9.vRU4fy.', 'User', 'active', 0, '2024-05-21 05:21:32', 'azoresmelmar@gmail.com', '2024-05-27 05:41:16', 'azoresmelmar@gmail.com', NULL, NULL),
(2, 'John', 'Doe', 'john.doe@example.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'Employee', 'active', 0, '2024-05-21 05:21:32', 'john.doe@example.com', '2024-05-27 05:41:16', 'azoresmelmar@gmail.com', NULL, NULL),
(33, 'Sample', 'User', 'sample@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'Employee', 'active', 0, '2024-05-21 05:21:32', 'john.doe@example.com', '2024-05-27 05:41:16', 'azoresmelmar@gmail.com', NULL, NULL);
(44, 'Person', 'Data', 'person@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'User', 'active', 0, '2024-05-21 05:21:32', 'john.doe@example.com', '2024-05-27 05:41:16', 'azoresmelmar@gmail.com', NULL, NULL);
(3, 'Jane', 'Doe', 'jane@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'User', 'active', 0, '2024-05-21 05:21:32', 'john.doe@example.com', '2024-05-27 05:41:16', 'azoresmelmar@gmail.com', NULL, NULL);
(5, 'Anglea', 'Jolie', 'angela@gmail.com', '$2y$10$QkFMNxaZy6/h8xq8GRJbF.N8X1B36y9IMQC/a5Fta.wHP0RF5ZMle', 'User', 'active', 0, '2024-05-21 05:21:32', 'john.doe@example.com', '2024-05-27 05:41:16', 'azoresmelmar@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Employees`
--
CREATE TABLE `employees` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'Employee',
  `department_id`  int NOT NULL,
  `position_id` int NOT NULL,
  `unit_id` int NOT NULL,
  `sex` enum('male','female'), 
  `date_of_birth` DATE,
  `birth_place` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_hired` DATE, 
  `status` enum('Employed','Resigned','Terminated'), 
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,    
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `users`
--


-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
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

-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
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
-- Dumping data for table `departments`

-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
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
-- Dumping data for table `departments`

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
(1, 1, NULL, '375871fb-6c63-4f2a-adfc-da96884a6349', 'available', '2024-05-21 05:34:25', 'sysadmin', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id`(`department_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);


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
-- AUTO_INCREMENT for table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


-- AUTO_INCREMENT for table `user_referrals`
--
ALTER TABLE `user_referrals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD CONSTRAINT `email_verifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_referrals`
--
ALTER TABLE `user_referrals`
  ADD CONSTRAINT `user_referrals_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_referrals_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

--
--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_department_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unit_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;
COMMIT;

--
--
-- Constraints for table `positions`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_department_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;
COMMIT;

ALTER TABLE `Employees`
 ADD CONSTRAINT `Employees_department_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Employees_department_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `positions` (`department_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Employees_unit_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `positions` (`unit_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Employees_positions_ibfk_4` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE;
COMMIT;

--
-- Constraints for table `units`
--



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `members` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `reference_number` varchar(155) NOT NULL,
  `last_name` varchar(155) NOT NULL,
  `first_name` varchar(155) NOT NULL,
  `middle_name` varchar(100)  DEFAULT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `date_of_birth` DATE DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `mobile_number` varchar(100) DEFAULT NULL,
  `tel_number` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `spouse_name` varchar(100) DEFAULT NULL,
  `spouse_occupation` varchar(100) DEFAULT NULL,
  `spouse_mobile_number` varchar(100) DEFAULT NULL,
  `has_admin_offense` enum('Yes','No') NOT NULL DEFAULT 'No',
  `admin_offense` text DEFAULT NULL,
  `is_convicted` enum('Yes','No') NOT NULL DEFAULT 'No',
  `is_PWD` enum('Yes','No') NOT NULL DEFAULT 'No',
  `pwd` text DEFAULT NULL,
  `convicted` text DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Processing',
  `Remarks` varchar(100) NOT NULL DEFAULT '-',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;



CREATE TABLE `member_beneficiaries` (
  `id` int NOT NULL,
  `member_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `relationship_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `member_beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

ALTER TABLE `member_beneficiaries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `member_beneficiaries`
  ADD CONSTRAINT `member_beneficiaries_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;


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

ALTER TABLE `member_educ_backgrounds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

ALTER TABLE `member_educ_backgrounds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `member_educ_backgrounds`
  ADD CONSTRAINT `member_educ_backgrounds_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;



CREATE TABLE `member_work_backgrounds` (
  `id` int NOT NULL,
  `member_id` int NOT NULL,
  `employment_status` enum('Previous','Current') NOT NULL DEFAULT 'Current',
  `occupation` varchar(255) NOT NULL,
  `office` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `income` varchar(255) DEFAULT NULL,
  'tin_id' int NOT NULL,
  `tel_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `member_work_backgrounds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

ALTER TABLE `member_work_backgrounds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `member_work_backgrounds`
  ADD CONSTRAINT `member_work_backgrounds_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;


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

ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `user_documents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `user_documents`
  ADD CONSTRAINT `user_documents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;



CREATE TABLE `user_logs` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `entity_name` varchar(255) NOT NULL,
  `type_of_action` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `action_description`varchar(255) NOT NULL ,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `user_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

 
--  TABLES FOR CASHIERING 

--  level 1 parent table
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
  

ALTER TABLE `cash_lvl_1`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cash_lvl_1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO cash_lvl_1 (code, title, created_by, created_at, updated_by, updated_at, deleted_by, deleted_at) VALUES
('1000000', 'Assets', 'Admin', NULL, NULL, NULL, NULL, NULL),
('2000000', 'Liabilities', 'Admin', NULL, NULL, NULL, NULL, NULL),
('3000000', 'Equity', 'Admin', NULL, NULL, NULL, NULL, NULL),
('4000000', 'Income', 'Admin', NULL, NULL, NULL, NULL, NULL),
('5000000', 'Expenses', 'Admin', NULL, NULL, NULL, NULL, NULL);

--  Cashiering-level-2
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

ALTER TABLE `cash_lvl_2`
  ADD PRIMARY KEY (`id`),
  ADD KEY  `cash_lvl_1_id` (`cash_lvl_1_id`);

ALTER TABLE `cash_lvl_2`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `cash_lvl_2`
  ADD CONSTRAINT `cash_lvl_2_ibfk_1` FOREIGN KEY (`cash_lvl_1_id`) REFERENCES `cash_lvl_1` (`id`) ON DELETE CASCADE;

INSERT INTO cash_lvl_2 ( cash_lvl_1_id, code, title, created_by, created_at, updated_by, updated_at, deleted_by, deleted_at)
 VALUES ('1', '1100000', 'Current assets', 'Admin', NULL, NULL, NULL, NULL, NULL),
  ('2', '2100000', 'Current liabilities', 'Admin', NULL, NULL, NULL, NULL, NULL), 
  ('3','3100000', 'Members equity', 'Admin', NULL, NULL, NULL, NULL, NULL), 
  ('4','4100000', 'Revenues', 'Admin', NULL, NULL, NULL, NULL, NULL),
   ('5', '5100000', 'Cost of Goods sold', 'Admin', NULL, NULL, NULL, NULL, NULL);

-- Cashiering-level-3
CREATE TABLE `cash_lvl_3`(
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
  
ALTER TABLE `cash_lvl_3`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_lvl_2_id` (`cash_lvl_2_id`);

ALTER TABLE `cash_lvl_3` 
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
ALTER TABLE `cash_lvl_3`
  ADD CONSTRAINT `cash_lvl_3_ibfk_1` FOREIGN KEY (`cash_lvl_2_id`) REFERENCES `cash_lvl_2` (`id`) ON DELETE CASCADE;

INSERT INTO cash_lvl_3 ( cash_lvl_2_id, code, title, created_by, created_at, updated_by, updated_at, deleted_by, deleted_at)
 VALUES ('1', '1110000', 'Cash and cash Equivalents', 'Admin', NULL, NULL, NULL, NULL, NULL),
  ('2', '2110000', 'Deposit liabilities', 'Admin', NULL, NULL, NULL, NULL, NULL), 
  ('3','3110000', 'Subscribe Share Capital Common', 'Admin', NULL, NULL, NULL, NULL, NULL), 
  ('4','4110000', 'Interest Income from loans', 'Admin', NULL, NULL, NULL, NULL, NULL), 
  ('5', '5110000', 'Cost of Goods sold', 'Admin', NULL, NULL, NULL, NULL, NULL);
-- parent table for-investment-level-4

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

ALTER TABLE `investment_property_types`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `investment_property_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


-- table summary for all cash accounts combined

CREATE TABLE `cash_accounts` (
  `id` int NOT NULL, 
  `cash_lvl_1_id` int NOT NULL,
  `cash_lvl_2_id` int NOT NULL, 
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


ALTER TABLE `cash_accounts` 
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_lvl_1_id`(`cash_lvl_1_id`),
  ADD KEY `cash_lvl_2_id`(`cash_lvl_2_id`),
  ADD KEY `cash_lvl_3_id` (`cash_lvl_3_id`),
 

ALTER TABLE `cash_accounts` 
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `cash_accounts`
  ADD CONSTRAINT `cash_lvl_1_ibfk_1` FOREIGN KEY (`cash_lvl_1_id`) REFERENCES `cash_lvl_1` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cash_lvl_2_ibfk_2` FOREIGN KEY (`cash_lvl_2_id`) REFERENCES `cash_lvl_2` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cash_lvl_3_ibfk_3` FOREIGN KEY (`cash_lvl_3_id`) REFERENCES `cash_lvl_3` (`id`) ON DELETE CASCADE;



CREATE TABLE `transaction_types` (
`id` INT NOT NULL,  
`transaction_name` varchar(255) NOT NULL,
`description` varchar(255) NOT NULL,
`is_recurrent` BOOLEAN DEFAULT FALSE,
`created_by` varchar(255) DEFAULT NULL,
`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`updated_by` varchar(255) DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`deleted_by` varchar(255) DEFAULT NULL,
`deleted_at` timestamp NULL DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `transaction_types`
ADD PRIMARY KEY(`id`),


ALTER TABLE `transaction_types`
MODIFY  `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `transaction_types`
ADD CONSTRAINT `transaction_types_cash_acc_ibfk_1` FOREIGN KEY (`cash_accounts_id`) REFERENCES `cash_accounts` (`id`);


CREATE TABLE `transaction_types_cash_account`(
`id ` INT NOT NULL,
`transaction_type_id` INT NOT NULL,
`cash_account_id`  INT NOT NULL,
`account_type` ENUM('Debit','Credit')  DEFAULT NULL,
`amount` decimal(10, 2) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `transaction_types_cash_account`
  ADD PRIMARY KEY(`id`),
  ADD KEY(`transaction_type_id`),
  ADD KEY (`cash_account_id`)


ALTER TABLE `transaction_types_cash_account` 
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `transaction_types_cash_account`
ADD CONSTRAINT `transaction_types_id_ibfk_1` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_types`(`id`),
ADD CONSTRAINT `transaction_types_cash_acc_ibfk_1` FOREIGN KEY (`cash_accounts_id`) REFERENCES `cash_accounts` (`id`);



CREATE TABLE `items` (
  `id` int NOT NULL, 
  `cash_account_id` int NOT NULL, 
  `name` varchar(255) NOT NULL, 
  `description` varchar(255) NOT NULL, 
  `unit` varchar(255) NOT NULL, 
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `items` 
  ADD PRIMARY KEY(`id`),
  ADD KEY `cash_account_id` (`cash_account_id`);

ALTER TABLE `items` 
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `items` 
  ADD CONSTRAINT `cash_account_ibfk_1` FOREIGN KEY (`cash_account_id`) REFERENCES `cash_account` (`id`) ON DELETE CASCADE; 


CREATE TABLE  `invoice_types`(
  `id` INT NOT NULL,
  `invoice_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `invoice_types` 
ADD PRIMARY KEY (`id`);

ALTER TABLE  `invoice_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1; 

CREATE TABLE `invoice_transaction_maps`(
  `id` INT NOT NULL,
  `invoice_type_id` int NOT NULL,
  `transaction_type_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `invoice_transaction_maps` 
ADD PRIMARY KEY (`id`),
ADD KEY (`invoice_type_id`),
ADD KEY (`transaction_type_id`);

ALTER TABLE  `invoice_transaction_maps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1; 

ALTER TABLE `invoice_transaction_maps`
ADD CONSTRAINT (`invoice_type_id_map_ibfk_1`) FOREIGN KEY (`invoice_type_id`) REFERENCES `invoice_types` (`id`) ON DELETE CASCADE;
ADD CONSTRAINT (`transaction_type_id_map_ibfk_2`) FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_types` (`id`)  ON DELETE CASCADE;

CREATE TABLE `cashiering_invoice` (
  `id` int NOT NULL, 
  `user_id` int  NOT NULL,
  `billing_address_id` int NOT NULL,
  `invoice_type_id` varchar(255) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `particulars` varchar(255) NOT NULL, 
  `discount` int  DEFAULT 0,
  `amount` int  DEFAULT 0,
  `date_issued` DATE NOT NULL,
  `date_due` DATE  DEFAULT NULL, 
  `issued_by` varchar(255)  DEFAULT NULL,
  `status` ENUM('pending','payment-initiated', 'processing', 'completed', 'failed')  DEFAULT NULL,
  `processed_by` varchar(255)  DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `cashiering_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_option_id` (`payment_option_id`);
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `cashiering_invoice` 
  MODIFY `id`int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `cashiering_invoice`
  ADD CONSTRAINT `cashiering_user_id_ibfk_1` FOREIGN KEY (`payment_option_id`) REFERENCES `payment_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `billing_id_ibfk_2` FOREIGN KEY (`billing_address_id`) REFERENCES `billing_address`(`id`) ON DELETE CASCADE;

CREATE TABLE `invoice_particulars` (
  `id` int NOT NULL,
  `cashiering_invoice_id` int NOT NULL, 
  `item_id` int NOT NULL, 
  `quantity` int NOT NULL,
  `unit_cost` int NOT NULL, 
  `total_cost`  int not NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
    

 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

 ALTER TABLE `invoice_particulars`
 ADD PRIMARY KEY (`id`),
 ADD KEY `cashiering_invoice_id` (`cashiering_invoice_id`),
 ADD KEY `item_id` (`item_id`);

 ALTER TABLE `invoice_particluars` 
  MODIFY `id`int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

 ALTER TABLE `invoice_particulars`
 ADD CONSTRAINT `cashiering_invoice_id_ibfk_1` FOREIGN KEY (`cashiering_invoice_id`) REFERENCES `cashiering_invoice` (`id`) ON DELETE CASCADE,
 ADD CONSTRAINT `item_id_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;



CREATE TABLE official_receipts (
  `id` INT NOT NULL, 
  `official_receipt_number` varchar(255) NOT NULL, 
  `billing_address_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `payment_date` DATE NOT NULL,
  `processed_by` varchar(255) NOT NULL,
  `issued_by` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `official_receipts`
ADD PRIMARY KEY (`id`),
ADD KEY (`user_id`),
ADD KEY (`billing_address_id`);

ALTER TABLE `official_receipts` 
MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `official_receipts`
ADD CONSTRAINT `user_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_id` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `or_billing_address_id_ibfk_1` FOREIGN KEY(`billing_address_id`) REFERENCES `billing_address` (`id`) ON DELETE CASCADE;




CREATE TABLE or_particulars (
  `id` INT NOT NULL,
  `item_id` INT NOT NULL,
  `receipt_id` INT NOT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `quantity` int NOT NULL,
  `unit_cost` int NOT NULL, 
  `total_cost`  int not NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `or_particulars`
ADD PRIMARY KEY (`id`),
ADD KEY (`item_id`),
ADD KEY (`receipt_id`);

ALTER TABLE `or_particulars`
MODIFY `id` int NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;

ALTER TABLE `or_particulars` 
ADD CONSTRAINT `item_id_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `receipt_id_ibfk_2` FOREIGN KEY (`receipt_id`) REFERENCES `official_receipts` (`id`) ON DELETE CASCADE;

 CREATE TABLE payment_records_invoice (
  `id` INT NOT NULL,
  `invoice_particulars_id` INT NOT NULL,
  `payment_date` DATE NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `account_num` int NOT NULL,
  `reference_num` varchar(255) NOT NULL,
  `total_payment` INT NOT NULL,
  `details` varchar(255) NOT NULL,
  `payment_proof`  varchar(255) NOT NULL, 
  `status` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
 
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `payment_records_invoice` 
ADD PRIMARY KEY (`id`), 
ADD KEY `invoice_particulars_id` (`invoice_particulars_id`);

 ALTER TABLE `payment_records_invoice` 
  MODIFY `id`int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `payment_records_invoice` 
ADD CONSTRAINT `payments_invoice_particulars_id_ibfk_1` FOREIGN KEY (`invoice_particulars_id`) REFERENCES `invoice_particulars` (`id`) ON DELETE CASCADE;



 CREATE TABLE payment_records_cashier_entry (
  `id` INT NOT NULL,
  `or_particulars_id` INT NOT NULL,
  `payment_date` DATE NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `account_num` int NOT NULL,
  `reference_num` varchar(255) NOT NULL,
  `total_payment` INT NOT NULL,
  `details` varchar(255) NOT NULL,
  `payment_proof`  varchar(255) NOT NULL, 
  `status` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
 
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `payment_records_cashier_entry` 
ADD PRIMARY KEY (`id`), 
ADD KEY `or_particulars_id` (`or_particulars_id`);

 ALTER TABLE `payment_records_cashier_entry` 
  MODIFY `id`int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `payment_records_cashier_entry` 
ADD CONSTRAINT `or_particulars_id_ibfk_1` FOREIGN KEY (`or_particulars_id`) REFERENCES `or_particulars` (`id`) ON DELETE CASCADE;




CREATE TABLE capital_contributions (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subscribed_amount` decimal(10, 2) NOT NULL,
  `amount` decimal(10, 2) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `date_issued` DATE DEFAULT NULL, 
  `date_paid` DATE DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



 ALTER TABLE `capital_contributions`
 ADD PRIMARY KEY (`id`),
 ADD KEY `user_id` (`user_id`);

 ALTER TABLE `capital_contributions` 
  MODIFY `id`int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

 ALTER TABLE `capital_contributions`
 ADD CONSTRAINT `user_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;



-- this part is specific to the payment options such as cash on hand & cash in bank

CREATE TABLE payment_options (
`id` INT NOT NULL,  
`cash_accounts_id` INT NOT NULL,
`code` varchar(255) NOT NULL,
`name` varchar(255) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `payment_options`
ADD PRIMARY KEY (`id`),
ADD KEY `cash_accounts_id` (`cash_accounts_id`);


 ALTER TABLE `payment_options` 
  MODIFY `id`int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
ALTER TABLE  `payment_options`
ADD CONSTRAINT `cash_accounts_id_ibfk_1` FOREIGN KEY (`cash_accounts_id`) REFERENCES `cash_accounts` (`id`) ON DELETE CASCADE;



CREATE TABLE ledger(
  `id` int NOT NULL, 
  `user_id` int NOT NULL,
  `item_id` int NOT NULL,
  `transaction_cash_account_id` INT NOT NULL,
  `jev_number` varchar(255) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `debit` int DEFAULT 0,
  `credit` int DEFAULT 0,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `ledger` 
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `transaction_cash_account_id` (`transaction_cash_account_id`),
  ADD KEY `item_id`(`item_id`);



ALTER TABLE `ledger` 
MODIFY `id`int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `ledger`
ADD CONSTRAINT `ledger_table_user_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `transaction_cash_account_id_ibfk_2` FOREIGN KEY (`transaction_cash_account_id`) REFERENCES `transaction_types_cash_account` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `ledger_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;


CREATE TABLE billing_address (
  `id` INT NOT NULL, 
  `user_id` INT NOT NULL,
  `street_address` varchar(255) NOT NULL, 
  `municipality` varchar(255) NOT NULL,
  `billing_email` varchar(255) NOT NULL, 
  `mobile_number` varchar(255) NOT NULL, 
  `province` varchar(255) NOT NULL,
   `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci; 

ALTER TABLE `billing_address` 
ADD PRIMARY KEY (`id`),
ADD KEY  (`user_id`);


ALTER TABLE `billing_address`
MODIFY `id`int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `billing_address` 
ADD CONSTRAINT `user_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

 CREATE TABLE `payment_account_map` (
  `id` INT NOT NULL,
  `payment_options_id` INT NOT NULL,
  `transaction_type_id` INT NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci; 

 ALTER TABLE `payment_account_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY (`payment_options_id`),
  ADD KEY (`transaction_type_id`);
 
 ALTER TABLE `payment_account_map`
 MODIFY `id` INT NOT NULL AUTO_INCERMENT, AUTO_INCREMENT=1;

 ALTER TABLE `payment_account_map`
 ADD CONSTRAINT `account_map_payment_options_id_ibfk_1` FOREIGN KEY (`payment_options_id`) REFERENCES `payment_options`(`id`) ON DELETE CASCADE;
 ADD CONSTRAINT `account_map_transaction_type_id_ibfk_2` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_types` (`id`) ON DELETE CASCADE;
 

CREATE TABLE `user_notifications`(
  `id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `notification_title` text NOT NULL,
  `message` TEXT NOT NULL,                 -- The notification message, ensuring it's not NULL.
  `link` VARCHAR(255) DEFAULT NULL,        -- Optional link related to the notification.
  `is_read` TINYINT(1) DEFAULT 0,         -- Default to 0 (unread) instead of NULL.
  `read_at` DATETIME DEFAULT NULL,  
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


 ALTER TABLE `payment_account_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY (`user_id`);
 
 ALTER TABLE `payment_account_map`
 MODIFY `id` INT NOT NULL AUTO_INCERMENT, AUTO_INCREMENT=1;

 ALTER TABLE `payment_account_map`
 ADD CONSTRAINT `user_notifications_id_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE;

 