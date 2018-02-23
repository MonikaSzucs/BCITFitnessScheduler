-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 23, 2018 at 12:13 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `googlelogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `recreations`
--

CREATE TABLE `recreations` (
  `ID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `startTime` varchar(50) NOT NULL,
  `endTime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recreations`
--

INSERT INTO `recreations` (`ID`, `name`, `location`, `description`, `startTime`, `endTime`) VALUES
(1, 'Tai Chi', '3700 Willingdon Ave, Burnaby, BC V5G 3H2', 'Tai Chi is an internal Chinese martial art practiced for both its defense training and its health benefits. The term taiji refers to a philosophy of the forces of yin and yang, related to the moves. Though originally conceived as a martial art, it is also typically practiced for a variety of other personal reasons: competitive wrestling in the format of pushing hands , demonstration competitions, and achieving greater longevity. As a result, a multitude of training forms exist, both traditional and modern, which correspond to those aims with differing emphasis. Some training forms of are especially known for being practiced with relatively slow movements.', '2018-02-26T13:00:00-08:00', '2018-02-26T14:00:00-08:00'),
(2, 'Study Stretch', '3700 Willingdon Ave, Burnaby, BC V5G 3H2', 'Ready to shape various aspects of your lives? This class will motivate, build confidence, develop competence and self-esteem, knowledge and understanding of the importance of physical activity in maintaining health and enhance the quality of life!', '2018-02-27T11:00:00-08:00', '2018-02-27T12:00:00-08:00'),
(3, 'Weekend Recovery', '3700 Willingdon Ave, Burnaby, BC V5G 3H2', 'This early morning Yoga Flow recovery class will help you detoxify the liver, re-oxygenate the body and help you tackle the week ahead with a clear and focused mind. Great for students and staff alike.', '2018-02-28T10:00:00-08:00', '2018-02-28T11:00:00-08:00'),
(4, 'Cross-Train Challenge', '3700 Willingdon Ave, Burnaby, BC V5G 3H2', 'CTC is a gritty, sweaty, full-body workout that will take your fitness to the next level. Strength, endurance, resistance, and functionality are all addressed.', '2018-03-01T14:00:00-08:00', '2018-03-01T15:00:00-08:00'),
(5, 'Mui Thai Kick Boxing', '3700 Willingdon Ave, Burnaby, BC V5G 3H2', 'Thai boxing is a combat sport of Thailand that uses stand-up striking along with various clinching techniques. This physical and mental discipline which includes combat on shins is known as \"the art of eight limbs\" because it is characterized by the combined use of fists, elbows, knees, shins, being associated with a good physical preparation that makes a full-contact fighter very efficient.  Muay Thai became widespread internationally in the twentieth century, when practitioners defeated notable practitioners of other martial arts. The professional league is governed by The Professional Boxing Association of Thailand (P.A.T) sanctioned by The Sport Authority of Thailand (S.A.T.), and World Muaythai Federation (WMF) overseas.', '2018-03-02T15:00:00-08:00', '2018-03-02T16:00:00-08:00'),
(6, 'Ladies Who Lift', '3700 Willingdon Ave, Burnaby, BC V5G 3H2', 'This Women\'s only small Personal Training Session is for any and all women who are new to weight training or want to advance their current program and get results. If you want to gain the confidence and execute perfect lifting techniques specific for women, this is the program for you.', '2018-03-02T16:00:00-08:00', '2018-03-02T17:00:00-08:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recreations`
--
ALTER TABLE `recreations`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recreations`
--
ALTER TABLE `recreations`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;