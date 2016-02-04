-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 04, 2016 at 10:17 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Users`
--

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `priority` int(1) NOT NULL DEFAULT '2',
  `created_on` datetime NOT NULL,
  `due_on` datetime NOT NULL,
  `last_modified_on` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('PENDING','DONE','VOIDED') NOT NULL DEFAULT 'PENDING',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `username`, `email`, `password`, `priority`, `created_on`, `due_on`, `last_modified_on`, `title`, `status`, `deleted`) VALUES
(1, 'fred', 'fred@fred.com', 'fred01', 2, '2016-02-19 00:00:00', '2016-03-31 00:00:00', '2016-02-10 00:00:00', '01.jpg', 'PENDING', 0),
(2, 'fred', 'fred@fred.com', 'fred01', 2, '2016-02-19 00:00:00', '2016-03-31 00:00:00', '2016-02-10 00:00:00', '01.jpg', 'PENDING', 0),
(3, 'Harry', 'Harry@harry.com', 'Harry01', 2, '2016-02-20 00:00:00', '2016-02-27 00:00:00', '2016-02-22 00:00:00', '02.jpg', 'PENDING', 0),
(4, 'Lin', 'lin@lin.com', 'Lin01', 2, '2016-02-01 00:00:00', '2016-02-03 00:00:00', '2016-02-01 00:00:00', '03.jpg', 'DONE', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `priority` (`priority`),
  ADD KEY `due_on` (`due_on`),
  ADD KEY `status` (`status`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
