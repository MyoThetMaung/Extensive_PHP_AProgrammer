-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2022 at 02:13 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_aprogrammer`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created _at` date NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created _at`, `updated_at`) VALUES
(1, 'Shoe', 'Shoe category pr', '0000-00-00', '2022-01-24 16:30:04'),
(2, 'hat', 'This is hat', '0000-00-00', '2022-01-24 18:08:19'),
(3, 'tshirt', 'tshirt pr', '0000-00-00', '2022-01-25 15:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` text NOT NULL,
  `category_id` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'saimon shoes', 'shoes are good', 10000, 9, 'shoee.jpg', '1', '0000-00-00 00:00:00', '2022-01-24 18:47:50'),
(2, 'tshirt', 'this is t shirt form google', 5000, 6, 'shirt.jpg', '2', '0000-00-00 00:00:00', '2022-01-25 15:25:32'),
(3, 'teeee shirrrrttt', 'thisss isss tttt shirrttt', 7000, 2, 'shirt.jpg', '3', '0000-00-00 00:00:00', '2022-01-26 19:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `sale_orders`
--

CREATE TABLE `sale_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_orders`
--

INSERT INTO `sale_orders` (`id`, `user_id`, `total_price`, `order_date`) VALUES
(2, 1, 40000, '2022-01-26 09:45:14'),
(3, 1, 5000, '2022-01-26 09:47:22'),
(4, 1, 20000, '2022-01-26 09:51:29'),
(5, 14, 10000, '2022-01-26 12:08:45');

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_detail`
--

CREATE TABLE `sale_order_detail` (
  `id` int(11) NOT NULL,
  `sale_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_order_detail`
--

INSERT INTO `sale_order_detail` (`id`, `sale_order_id`, `product_id`, `quantity`, `order_date`) VALUES
(2, 2, 2, 4, '2022-01-26 15:15:14'),
(3, 2, 1, 2, '2022-01-26 15:15:14'),
(4, 3, 2, 1, '2022-01-26 15:17:23'),
(5, 4, 2, 2, '2022-01-26 15:21:29'),
(6, 4, 1, 1, '2022-01-26 15:21:29'),
(7, 5, 2, 2, '2022-01-26 17:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `role` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$gptpKODjNQjHJTe12KBGnuXfMMJfx1R0k8IFFgqc6En5ql1Cva506', '09777777777', 'Yangon', 1, '2022-01-24 10:18:52', '2022-01-24 15:49:20'),
(13, 'agag', 'agag@gmail.com', '$2y$10$Ye4DWLBi4ll7TuZXkLhdke0K5sby.IrqAzuFZYBzx9DvRf/wKduHS', '091111111111', 'ygn', 0, '2022-01-25 15:13:38', '2022-01-25 15:13:38'),
(14, 'susu', 'susu@gmail.com', '$2y$10$Za2c8pZUqUl0Bx0OuxmwBOPe1Ca9oTsY.eik9E2EfZuViq1z2jc/a', '09777777777', 'yangon', 0, '2022-01-26 17:37:55', '2022-01-26 17:37:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_order_detail`
--
ALTER TABLE `sale_order_detail`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sale_orders`
--
ALTER TABLE `sale_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale_order_detail`
--
ALTER TABLE `sale_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
