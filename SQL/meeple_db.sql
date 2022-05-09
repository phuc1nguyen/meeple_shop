-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2022 at 10:30 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meeple_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `cate_id` tinyint(4) NOT NULL,
  `description` text NOT NULL,
  `thumb` varchar(155) NOT NULL,
  `images` varchar(155) NOT NULL,
  `price` double NOT NULL,
  `price_sale` double NOT NULL,
  `slug` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `add_date` datetime NOT NULL,
  `backup` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `cate_id`, `description`, `thumb`, `images`, `price`, `price_sale`, `slug`, `stock`, `active`, `add_date`, `backup`) VALUES
(1, 'Echoes - The Microchip (Pre-Order)', 1, 'In the far future, civilization is lying in ruins, and the echoes of the past hide the tragic story of its downfall. See whether you can uncover the truth.', '', '', 9.99, 8.49, '', 20, 1, '2022-01-16 00:00:00', NULL),
(2, 'Echoes - The Microchip (Pre-Order) 12345', 1, 'asdfasdf', 'test', 'test', 6, 5, '', 10, 1, '2022-05-03 16:16:56', NULL),
(3, 'Echoes - The Microchip (Pre-Order) 12345', 1, '', 'test', 'test', 98, 52, '', 123, 1, '2022-05-03 16:17:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `email` varchar(155) NOT NULL,
  `password` varchar(155) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `avatar` varchar(255) DEFAULT NULL,
  `active` varchar(155) NOT NULL DEFAULT '1',
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `avatar`, `active`, `registration_date`) VALUES
(1, 'admin', 'admin@localhost.com', '$2y$10$iTYGYIC703rU7hNa4N2ziOqKdI/4fc9ncEBhhv7S038QiATmx.D6W', 0, NULL, '1', '2022-05-09 07:49:14'),
(2, 'phuc nguyen', 'phuc.ng13988@gmail.com', '$2y$10$4.dNNNFF92MOR18A7ZjQjOIQekcsaCQJOUI3uHnuOgG4zLbNL8QkO', 1, NULL, 'e682f2b8a000ceaa09f3d8e08073a457', '2022-05-09 07:51:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
