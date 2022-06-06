-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2022 at 03:36 PM
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
  `images` varchar(155) DEFAULT NULL,
  `price` double NOT NULL,
  `price_sale` double NOT NULL,
  `slug` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `add_date` datetime NOT NULL,
  `backup` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `cate_id`, `description`, `thumb`, `images`, `price`, `price_sale`, `slug`, `stock`, `active`, `add_date`, `backup`) VALUES
(1, 'Echoes - The Microchip (Pre-Order)', 1, 'In the far future, civilization is lying in ruins, and the echoes of the past hide the tragic story of its downfall. See whether you can uncover the truth.', 'public/img/1654142967_584625875629837f709d93.jpg', NULL, 9.99, 8.49, '', 20, 1, '2022-01-16 00:00:00', NULL),
(11, 'tourzy media', 1, 'asdfasdf', 'public/img/1654142967_584625875629837f709d93.jpg', NULL, 9.99, 8.88, '', 10, 1, '2022-06-01 18:33:33', NULL),
(12, 'triển lãm', 1, '', 'Notice:  Undefined index: thumbPath in C:laragonwwwmeeple_shopbackendprod_create.php on line 145', NULL, 9.99, 8.88, 'tri-n-l-m', 15, 0, '2022-06-06 08:16:55', NULL);

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
  `registration_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `avatar`, `active`, `registration_date`, `updated_date`) VALUES
(3, 'admin', 'admin@localhost.com', '$2y$10$N9YcfnGKZvCwo13decSfFuulawvObkDQXgBad1rH2TQ6YDNxCu1Ve', 0, NULL, '1', '2022-05-08 21:31:53', '0000-00-00 00:00:00'),
(4, 'phuc nguyen', 'phuc.ng13988@gmail.com', '$2y$10$WFzd9D4Bhs31nqAA69zUq.ODnQpOpCTKelz4U4anjAF4eOCXgD2u.', 1, NULL, '1', '2022-05-08 22:09:11', '0000-00-00 00:00:00'),
(12, 'test', 'phucnguyen13988@gmail.com', '$2y$10$Hyn/RgFnuuMXFsRUUClMuO20/ZepMgrUQcyHuQJflh2zWoRBxJzEW', 1, NULL, '1', '2022-06-04 09:02:00', '2022-06-05 11:42:19'),
(16, 'tourzy media', 'phuc.nt163193@sis.hust.edu.vn', '$2y$10$INPlra/Ero5q8bP4oUYzZeeM9TN8zXrW8K058UChMoRa6vMvzfyJu', 1, NULL, '0', '2022-06-04 09:11:57', '2022-06-05 11:15:19');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
