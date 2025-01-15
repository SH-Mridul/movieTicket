-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 05:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_ticket_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking_lists`
--

CREATE TABLE `booking_lists` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(250) NOT NULL,
  `contact_number` varchar(250) NOT NULL,
  `movie_name` varchar(250) NOT NULL,
  `show_time` varchar(250) NOT NULL,
  `seat_name` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_lists`
--

INSERT INTO `booking_lists` (`id`, `customer_name`, `contact_number`, `movie_name`, `show_time`, `seat_name`, `status`) VALUES
(1, 'Mridul', '01931769834', 'আয়নাবাজি ', 'Wednesday, January 15, 2025 at 11:00 AM', 'A1', 1),
(2, 'Sakhawat Hossain Mridul', '01931769834', 'আয়নাবাজি', 'Wednesday, January 15, 2025 at 11:00 AM', 'A2', 1),
(3, 'Sakhawat Hossain Mridul', '01931769834', 'আয়নাবাজি', 'Wednesday, January 15, 2025 at 11:00 AM', 'A3', 1),
(4, 'hasan', '0190000001', 'আয়নাবাজি', 'Wednesday, January 15, 2025 at 11:00 AM', 'F5', 0),
(5, 'hasan', '0190000001', 'আয়নাবাজি', 'Wednesday, January 15, 2025 at 11:00 AM', 'D5', 1),
(6, 'mridul', '01931769834', 'আয়নাবাজি', 'Wednesday, January 15, 2025 at 11:00 AM', 'D8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movie_list`
--

CREATE TABLE `movie_list` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `show_status` varchar(250) NOT NULL,
  `poster_path` varchar(250) NOT NULL,
  `ticket_price` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_list`
--

INSERT INTO `movie_list` (`id`, `name`, `show_status`, `poster_path`, `ticket_price`, `status`) VALUES
(1, 'Andrew May', 'showing', 'poster/movie_6786f17943d896.53923358.jpeg', 101, 0),
(2, 'Sakhawat', 'upcoming', 'poster/movie_6786f3a13052e3.67821759.jpg', 200, 0),
(3, 'আয়নাবাজি', 'upcoming', 'poster/movie_67870f58b61111.75086476.jpeg', 400, 1),
(4, 'Spider Man', 'showing', 'poster/movie_6787e367f0a550.25262965.jpg', 500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `movie_show_date_time`
--

CREATE TABLE `movie_show_date_time` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `show_date_time` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_show_date_time`
--

INSERT INTO `movie_show_date_time` (`id`, `movie_id`, `show_date_time`, `status`) VALUES
(4, 1, '2025-01-15T08:20', 0),
(6, 2, '2025-01-15T05:30', 0),
(9, 3, '2025-01-15T11:00', 1),
(10, 3, '2025-01-22T12:30', 1),
(11, 4, '2025-01-15T08:39', 1),
(12, 4, '2025-01-16T16:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `seat_name` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `seat_name`, `status`) VALUES
(1, 'A1', 1),
(2, 'A2', 1),
(3, 'A3', 1),
(4, 'A4', 1),
(5, 'A5', 1),
(6, 'A6', 1),
(7, 'A7', 1),
(8, 'A8', 1),
(9, 'B1', 1),
(10, 'B2', 1),
(11, 'B3', 1),
(12, 'B4', 1),
(13, 'B5', 1),
(14, 'B6', 1),
(15, 'B7', 1),
(16, 'B8', 1),
(17, 'C1', 1),
(18, 'C2', 1),
(19, 'C3', 1),
(20, 'C4', 1),
(21, 'C5', 1),
(22, 'C6', 1),
(23, 'C7', 1),
(24, 'C8', 1),
(25, 'D1', 1),
(26, 'D2', 1),
(27, 'D3', 1),
(28, 'D4', 1),
(29, 'D5', 1),
(30, 'D6', 1),
(31, 'D7', 1),
(32, 'D8', 1),
(33, 'E1', 1),
(34, 'E2', 1),
(35, 'E3', 1),
(36, 'E4', 1),
(37, 'E5', 1),
(38, 'E6', 1),
(39, 'E7', 1),
(40, 'E8', 1),
(41, 'F1', 1),
(42, 'F2', 1),
(43, 'F3', 1),
(44, 'F4', 1),
(45, 'F5', 1),
(46, 'F6', 1),
(47, 'F7', 1),
(48, 'F8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `contact_number` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `contact_number`, `password`, `status`) VALUES
(1, 'anyone', 'anyone@gmail.com', '01900000000', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'jerin', 'mridulcse8@gmail.com', '01931769834', 'e10adc3949ba59abbe56e057f20f883e', 1),
(3, 'mridul', 'mridul@gmail.com', '01931769834', 'e10adc3949ba59abbe56e057f20f883e', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_lists`
--
ALTER TABLE `booking_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_list`
--
ALTER TABLE `movie_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_show_date_time`
--
ALTER TABLE `movie_show_date_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_lists`
--
ALTER TABLE `booking_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `movie_list`
--
ALTER TABLE `movie_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movie_show_date_time`
--
ALTER TABLE `movie_show_date_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
