-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 01:18 PM
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
-- Database: `blog_aprogrammer`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `author_id`, `post_id`, `created_at`) VALUES
(1, 'admin first comment', 1, 1, '2022-01-21 11:58:58'),
(2, 'agag comment ', 2, 1, '2022-01-21 11:59:23'),
(3, 'agag first comment', 2, 2, '2022-01-21 12:04:21'),
(4, 'agag comment', 4, 3, '2022-01-21 12:14:35'),
(5, 'aye aye comment', 2, 3, '2022-01-21 12:15:02'),
(6, 'ayeaye comment', 2, 4, '2022-01-21 12:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` longtext NOT NULL,
  `image` text NOT NULL,
  `author_id` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'admin first blog', 'this is first blog for admin\r\nok?', 'hhh.jpg', 1, '2022-01-21 11:58:44', '2022-01-21 11:58:44'),
(3, 'second blog', 'this is second blog', 'Einstein.jpg', 1, '2022-01-21 12:12:47', '2022-01-21 12:12:47'),
(4, 'third blog', 'this is third blog', 'hhh.jpg', 1, '2022-01-21 12:13:01', '2022-01-21 12:13:01'),
(5, 'fourth blog', 'this is fourth blog', 'Einstein.jpg', 1, '2022-01-21 12:13:16', '2022-01-21 12:13:16'),
(6, 'fifth blog', 'this is fifth blog', 'hhh.jpg', 1, '2022-01-21 12:13:32', '2022-01-21 12:13:32'),
(7, 'sixth blog', 'this is sixth blog', 'Einstein.jpg', 1, '2022-01-21 12:13:45', '2022-01-21 12:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$gptpKODjNQjHJTe12KBGnuXfMMJfx1R0k8IFFgqc6En5ql1Cva506', '1', '2022-01-21 11:44:08'),
(2, 'ayeaye', 'ayeaye@gmail.com', '$2y$10$J3wOsz9sDA1zaHJUUsR7Ce3Z34gBg7VgW4eiLikbDtj9YorULxv2C', '0', '2022-01-21 11:46:34'),
(4, 'agag', 'agag@gmail.com', '$2y$10$ZCuHff426Tjwyqpr1u5B3.g4BhGM7njDmkjJPUikNP8s8ln3W5Vsu', '0', '2022-01-21 12:07:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

