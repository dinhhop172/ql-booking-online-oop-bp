-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 27, 2022 at 09:07 AM
-- Server version: 8.0.29-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ql-booking-oop`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int NOT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `roles` enum('admin','user','staff') CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL DEFAULT 'user',
  `verification_code` text,
  `email_verified_at` datetime DEFAULT NULL,
  `staff_id` int DEFAULT NULL,
  `percent` float DEFAULT NULL,
  `money` int DEFAULT NULL,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `phone_number`, `sex`, `address`, `roles`, `verification_code`, `email_verified_at`, `staff_id`, `percent`, `money`, `status`) VALUES
(1, 'Admin', '$2y$10$j1yDxP/2/Gs/SQmquEZDcudcfkcUtFYWn7gBMRC.XVdfRy5CN8wmS', 'dinhhop172@gmail.com', 123123123, 'male', 'Hue city', 'admin', '156287', '2022-07-25 15:46:09', NULL, NULL, NULL, 1),
(3, 'Staff', '$2y$10$v4hc1/OY1migjUeItA9LVeOj2LS12YwJCjJfD1xqA8wvPuqieYOCC', 'nhatthang1702@gmail.com', 1231231231, 'female', 'Hue city', 'staff', 'c9e9b0e37b5f8060661f8f0f1727fbd67871', '2022-07-13 10:43:35', NULL, 5, 70, 1),
(24, 'keiradom', '$2y$10$repMA1GJgtGum9iJrN10UusOEgp8EXA8/Kev7uBMooro8vw7Fr5Xq', 'hop@gmail.com', 123123123, 'female', 'HUe city', 'user', '7dde5a9a9906e7b14910354dcf82b7803234', '2022-07-21 20:04:36', NULL, NULL, NULL, 1),
(28, 'dinhhop1702', '$2y$10$2B5lAOrc6/sna.dLJ6vZuuz3jZ/iCecT5I66QRw9fI976DT9MBZ7u', 'dinhhop1702@gmail.com', 123123123, 'male', 'hue', 'user', 'c16228aa290ae0f889e282fca27fbbc93144', '2022-07-22 14:05:22', 3, NULL, NULL, 1),
(29, 'nhatthang', '$2y$10$F7YQXgkjJGCUFVngBv/Tn.DpOD7rdp2FRyQNFpdGtzlI5o.iBBU3i', 'nhatthang1720@gmail.com', 1231231231, 'female', '123', 'user', 'fef8682ec96e236397d75d93cfe6c5931553', '2022-07-22 14:06:37', 3, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int NOT NULL,
  `account_id` int NOT NULL,
  `room_id` int NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_day` int DEFAULT NULL,
  `total_price` int DEFAULT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `request_payments`
--

CREATE TABLE `request_payments` (
  `id` int NOT NULL,
  `staff_id` int NOT NULL,
  `money` int NOT NULL,
  `status` int NOT NULL,
  `request_day` datetime NOT NULL,
  `payment_day` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `request_payments`
--

INSERT INTO `request_payments` (`id`, `staff_id`, `money`, `status`, `request_day`, `payment_day`) VALUES
(53, 3, 0, 3, '2022-07-26 08:48:56', '2022-07-26 08:49:02'),
(54, 3, 0, 3, '2022-07-26 08:49:19', '2022-07-26 08:49:26'),
(55, 3, 0, 3, '2022-07-26 08:49:29', '2022-07-26 08:49:32'),
(56, 3, 0, 3, '2022-07-26 08:49:43', '2022-07-26 09:00:26'),
(57, 3, 10, 2, '2022-07-26 09:00:33', '2022-07-26 09:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `price`, `status`) VALUES
(1, 'Room 1', 500, 1),
(9, 'Room 2', 100, 1),
(10, 'Room 3', 1000, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_ibfk_1` (`room_id`),
  ADD KEY `booking_ibfk_2` (`account_id`);

--
-- Indexes for table `request_payments`
--
ALTER TABLE `request_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `request_payments`
--
ALTER TABLE `request_payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
