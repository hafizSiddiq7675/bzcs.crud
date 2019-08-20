-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 20, 2019 at 09:58 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easy_finance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coa_name` varchar(255) NOT NULL,
  `coa_desc` varchar(255) NOT NULL,
  `coa_type` enum('capital','assets','liability','expense','revenue') NOT NULL,
  `is_parent` tinyint(1) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`) VALUES
(1, 'test', 'test1@gmail.com', '12345', ''),
(2, 'test', 'test2@gmail.com', '12345', NULL),
(3, 'test', 'test3@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL),
(4, 'test', 'test4@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL),
(5, 'test1', 'test@gmail.com', '202cb962ac59075b964b07152d234b70', NULL),
(6, 'hafiz', 'hafiz@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL),
(7, 'test', 'test7@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(8, 'test', 'test5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(9, 'test', 'test9@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(10, 'test8', 'test8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(11, 'test', 'test11@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL),
(12, 'test', 'test10@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_id` (`user_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD CONSTRAINT `chart_of_accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
