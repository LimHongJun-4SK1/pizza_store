-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2025 at 09:46 AM
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
-- Database: `pizza_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `no` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`no`, `name`, `email`, `subject`, `message`) VALUES
(1, '123', '3123@gmail', '123123', '12312313'),
(2, '</div>', 'hongjunlim123@gmail.com', '123123', 'fuck u fellar'),
(3, 'asdasd', 'ho@gmail.com', '123123', 'sasasa');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `items` text DEFAULT NULL,
  `total_price` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `items`, `total_price`, `created_at`) VALUES
(1, '', 12.99, '2025-07-24 15:44:30'),
(2, '', 27.98, '2025-07-24 15:50:37'),
(3, 'Margherita x1, Pepperoni x1, Veggie x1', 41.97, '2025-07-24 16:03:27'),
(4, 'Margherita x3, Pepperoni x5, Veggie x3', 570831.00, '2025-07-24 16:11:26'),
(5, 'Margherita x3, Pepperoni x7, Veggie x3', 0.00, '2025-07-24 16:17:49'),
(6, 'Margherita x9, Pepperoni x7, Veggie x3', 0.00, '2025-07-24 16:23:12'),
(7, 'Margherita x9, Pepperoni x7, Veggie x3', 0.00, '2025-07-24 16:23:28'),
(8, 'Margherita x11, Pepperoni x7, Veggie x3', 0.00, '2025-07-24 16:23:47'),
(9, 'Margherita x13, Pepperoni x7, Veggie x3', 0.00, '2025-07-24 16:29:05'),
(10, 'Margherita x2', 0.00, '2025-07-24 16:33:30'),
(11, 'Margherita x2', 604.00, '2025-07-24 16:34:56'),
(12, 'Margherita x3', 1812.00, '2025-07-24 16:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'password123', ''),
(2, 'gm1', '$2y$10$kx5MtwpuIJJrGc6gUkVQ4OW53C58pLDa.TlegdORojq./3bNMUejW', 'hongjunlim123@gmail.com'),
(3, 'ho', '$2y$10$ErshUs08vQ.ItR6TQg2frOxL5vj2shS4TtWofSkA0lbBVKNSOT3qO', 'ho@gmail.com'),
(4, '121311', '$2y$10$nF0etZVopufuL6yCwp/A.OB49lAJjIRCSNT7DPNTwkBSKBqdlOhuu', 'adasd@121');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
