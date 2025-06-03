-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 12:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--
CREATE database `hostel`;
use hostel;
CREATE TABLE `issues` (
  `issue_id` int(11) auto_increment primary key,
  `raised_by` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `priority` enum('urgent','normal') NOT NULL DEFAULT 'normal',
  `date_of_issue` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('open','work in progress','postpone','resolved') DEFAULT 'open',
  `admin_comments` text DEFAULT NULL,
  `action_taken` text DEFAULT NULL,
  `action_resolve_date` date DEFAULT NULL,
  
  `date_submitted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`issue_id`, `raised_by`, `subject`, `details`, `priority`, `date_of_issue`, `status`, `admin_comments`, `action_taken`, `action_resolve_date`, `date_submitted`) VALUES
(1, 3, 'extra', 'extttt', 'urgent', '2025-04-21 11:57:25', 'open', 'vfffg', 'aahil', '2015-02-03', '2025-04-22 06:09:08'),
(2, 3, 'dhfkvhdf', 'fvfdljvflvjf;vfjv;f', 'normal', '2025-04-22 06:04:53', 'work in progress', 'fdsfdgdfd', 'rfrgtrgthyh', '2025-05-22', '2025-04-22 06:09:08'),
(3, 3, 'hello', 'hello', 'normal', '2025-04-22 06:11:59', 'open', NULL, NULL, NULL,  '2025-04-22 06:11:59'),
(4, 4, 'fgdfgfgfgf', 'yyuyuy', 'normal', '2025-04-28 08:20:32', 'open', NULL, NULL, NULL,  '2025-04-28 08:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `laundry`
--

CREATE TABLE `laundry` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `hostel_code` varchar(20) NOT NULL,
  `particular` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` >= 0),
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laundry`
--

INSERT INTO `laundry` (`id`, `student_id`, `student_name`, `hostel_code`, `particular`, `quantity`, `date`) VALUES
(1, 3, 'Lochna', '11102', 'Shirt', 1, '2025-04-22 05:58:57'),
(2, 3, 'Lochna', '1122', 'Shirt', 3, '2025-04-28 05:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `tuitions`
--

CREATE TABLE `tuitions` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `subject` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `tuition_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tuitions`
--

INSERT INTO `tuitions` (`id`, `student_id`, `student_name`, `day`, `from_time`, `to_time`, `subject`, `location`, `tuition_date`, `created_at`) VALUES
(1, 3, 'Lochna', 'Tuesday', '17:00:00', '13:00:00', 'law', 'mumbai', '2002-03-01', '2025-04-21 12:16:49'),
(2, 3, 'Lochna', 'Wednesday', '12:00:00', '12:00:00', 'law', 'andheri', '2000-03-12', '2025-04-22 06:05:41'),
(3, 4, 'saroj', 'Tuesday', '02:04:00', '03:04:00', 'extra class', 'bandra', '2025-05-04', '2025-04-28 08:53:50'),
(4, 4, 'saroj', 'Tuesday', '02:04:00', '03:04:00', 'extra class', 'bandra', '2025-05-04', '2025-04-28 09:06:01'),
(5, 4, 'saroj', 'Tuesday', '02:04:00', '03:04:00', 'extra class', 'bandra', '2025-05-04', '2025-04-28 09:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `parent_name` varchar(100) DEFAULT NULL,
  `parent_phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('student','admin') NOT NULL,
  `date_of_admission` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `phone`, `email`, `grade`, `parent_name`, `parent_phone`, `address`, `role`, `date_of_admission`, `created_at`) VALUES
(1, 'Kavyanjali', 'Banan', 'kavya', '$2y$10$Aahe7rvQlqnJpndZozQveu3op71eFMCvAZJDA.DnOog7RhxcfPHHq', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, '2025-04-21 11:05:10'),
(3, 'Lochna', 'P', 'Lochna', '$2y$10$wI2ISDkAVfrNVvekVNZpwuzLGDZUcdiV1Jh4QoXt396VdjylEt0Ua', '56767', 'lochna@gmail.com', '8', 'vyu', '347489', 'Mumbai', 'student', '2000-06-05', '2025-04-21 11:56:12'),
(4, 'saroj', 's', 'saroj', '$2y$10$hHsu2CEamv6m9rkfkWifce40JmJ4o9dTe8Dk3HQH6kOQoFXQvc93G', '56565', 'saroj@gmail.com', '5', 'fh', '46465', 'mumbai', 'student', '2025-04-25', '2025-04-28 08:18:25'),
(5, 'Bhakti', 'Patil', 'Bhakti', '$2y$10$wPCrHD.IhiuzadRUwb.F4Oq5N7s9Xt7iXMf9fonx9OkXdXc4pIub.', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, '2025-05-16 09:28:47'),
(6, 'Lav', 'Smit', 'Lav', '$2y$10$n199DcyLVHn2NzGhw8Xy/eLbXqIiuG/fNGDOpzRw4K.TsNLeSm/ra', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, '2025-05-16 09:30:35'),
(7, 'Teja', 'abc', 'Teja', '$2y$10$C8tRC.JQqxKYCl6UkWGuoOYnLmJk.XyIZRuE/1ag0hVR1W56ENLba', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, '2025-05-21 05:02:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`issue_id`),
  ADD KEY `raised_by` (`raised_by`);

--
-- Indexes for table `laundry`
--
ALTER TABLE `laundry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `tuitions`
--
ALTER TABLE `tuitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laundry`
--
ALTER TABLE `laundry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tuitions`
--
ALTER TABLE `tuitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `issues_ibfk_1` FOREIGN KEY (`raised_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `laundry`
--
ALTER TABLE `laundry`
  ADD CONSTRAINT `laundry_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tuitions`
--
ALTER TABLE `tuitions`
  ADD CONSTRAINT `tuitions_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
