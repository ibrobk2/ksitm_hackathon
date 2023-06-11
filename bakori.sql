-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 10:50 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakori`
--

-- --------------------------------------------------------

--
-- Table structure for table `farms`
--

CREATE TABLE `farms` (
  `farm_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `size` decimal(10,2) NOT NULL,
  `extension_officer` int(11) DEFAULT NULL,
  `total_visits` int(11) NOT NULL,
  `latitude` varchar(10) NOT NULL,
  `loongitude` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `farm_visits`
--

CREATE TABLE `farm_visits` (
  `id` int(11) NOT NULL,
  `farm_id` int(11) NOT NULL,
  `extension_officer` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(25) NOT NULL,
  `total_farms` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `username`, `email`, `password`, `role`, `total_farms`, `created_at`) VALUES
(1, 'Ibrahim Yusuf', 'ibrobk', 'ibrobk@gmail.com', '$2y$10$Sw3qrjznQhuDG6qHK0mqsOOEK/2a0TYPzQDJDBKVx0SrgxF7Vbae6', 'admin', '0', '2023-06-11 00:36:46'),
(2, 'Sani Aminu', 'ssaminu', 'saminu@gmail.com', '$2y$10$AORjP7VYBgMFmpyN83tszuAEEgzOx85e6n/32Ph3wuz6op6RdOq5K', 'extension', '0', '2023-06-10 22:58:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `farms`
--
ALTER TABLE `farms`
  ADD PRIMARY KEY (`farm_id`),
  ADD KEY `extension_officer` (`extension_officer`);

--
-- Indexes for table `farm_visits`
--
ALTER TABLE `farm_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farm_id` (`farm_id`),
  ADD KEY `extension_officer` (`extension_officer`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `farm_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `farm_visits`
--
ALTER TABLE `farm_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `farms`
--
ALTER TABLE `farms`
  ADD CONSTRAINT `farms_ibfk_1` FOREIGN KEY (`extension_officer`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `farm_visits`
--
ALTER TABLE `farm_visits`
  ADD CONSTRAINT `farm_visits_ibfk_1` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`farm_id`),
  ADD CONSTRAINT `farm_visits_ibfk_2` FOREIGN KEY (`extension_officer`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
