-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2018 at 09:07 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ifit`
--

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_recreation`
--

CREATE TABLE `enrolled_recreation` (
  `user_id` int(11) NOT NULL,
  `added_recreation_id` int(11) NOT NULL,
  `enrollment_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recreation_activities`
--

CREATE TABLE `recreation_activities` (
  `added_recreation_id` int(11) NOT NULL,
  `recreation_name` int(11) NOT NULL,
  `recreation_description` int(11) NOT NULL,
  `youtube_link` int(11) NOT NULL,
  `time_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recreation_timeline`
--

CREATE TABLE `recreation_timeline` (
  `time_id` int(11) NOT NULL,
  `recreation_day` date NOT NULL,
  `recreation_start` date NOT NULL,
  `recreation_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enrolled_recreation`
--
ALTER TABLE `enrolled_recreation`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `added_recreation_id` (`added_recreation_id`);

--
-- Indexes for table `recreation_activities`
--
ALTER TABLE `recreation_activities`
  ADD PRIMARY KEY (`added_recreation_id`),
  ADD UNIQUE KEY `time_id` (`time_id`);

--
-- Indexes for table `recreation_timeline`
--
ALTER TABLE `recreation_timeline`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enrolled_recreation`
--
ALTER TABLE `enrolled_recreation`
  MODIFY `enrollment_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recreation_activities`
--
ALTER TABLE `recreation_activities`
  MODIFY `added_recreation_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrolled_recreation`
--
ALTER TABLE `enrolled_recreation`
  ADD CONSTRAINT `enrolled_recreation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrolled_recreation_ibfk_2` FOREIGN KEY (`added_recreation_id`) REFERENCES `recreation_activities` (`added_recreation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recreation_activities`
--
ALTER TABLE `recreation_activities`
  ADD CONSTRAINT `recreation_activities_ibfk_1` FOREIGN KEY (`time_id`) REFERENCES `recreation_timeline` (`time_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
