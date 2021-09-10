-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2021 at 06:14 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todoslist`
--

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`id`, `uid`, `title`, `description`) VALUES
(13, 3, 'I have to go to the mall', 'I have to go to the mall to get this job done');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `p_number` bigint(250) NOT NULL,
  `password` varchar(550) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `email`, `p_number`, `password`) VALUES
(3, 'Demo Demo', 'demo@gmail.com', 9898883001, '$2y$10$0tfuRaGlpF7HHo1jkV98l.Z/uaJVBfOGDftEYvE2qnCoNluPOKCAu'),
(4, 'USer Second', 'usec@gmail.com', 9898883002, '$2y$10$f483FCAeAooAcDNCu5sxdO/FJzGdXmozRJdDEFoBVhhIbjave7eLq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list`
--
ALTER TABLE `list`
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
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
