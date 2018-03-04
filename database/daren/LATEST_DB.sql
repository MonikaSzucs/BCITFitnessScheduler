-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 04, 2018 at 09:04 PM
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
(1, 'TaiChi', '3700 Willingdon Ave, Burnaby, BC V5G 3H2', 'Tai Chi is a internal Chinese martial art practiced for both its defense training and its health benefits. The term taiji refers to a philosophy of the forces of yin and yang, related to the moves. Though originally conceived as a martial art, it is also typically practiced for a variety of other personal reasons: competitive wrestling in the format of pushing hands, demonstration competitions, and achieving greater longevity. As a result, a multitude of training forms exist, both traditional and modern, which correspond to those aims with differing emphasis.', '2018-04-23T13:00:00-08:00', '2018-04-23T14:00:00-08:00'),
(2, 'StudyStretch', '3700 Willingdon Ave, Burnaby, BC V5G 3H2', 'Ready to shape various aspects of your lives? This class will motivate, build confidence, develop competence and self-esteem, knowledge and understanding of the importance of physical activity in maintaining health and enhance the quality of life!', '2018-04-24T11:00:00-08:00', '2018-04-24T12:00:00-08:00'),
(3, 'WeekendRecovery', '3700 Willingdon Ave, Burnaby, BC V5G 3H2', 'This early morning Yoga Flow recovery class will help you detoxify the liver, re-oxygenate the body and help you tackle the week ahead with a clear and focused mind. Great for students and staff alike.', '2018-04-25T10:00:00-08:00', '2018-04-25T11:00:00-08:00'),
(4, 'CrossTrainChallenge', '3700 Willingdon Ave, Burnaby, BC V5G 3H2', 'CTC is a gritty, sweaty, full-body workout that will take your fitness to the next level. Strength, endurance, resistance, and functionality are all addressed.', '2018-04-26T14:00:00-08:00', '2018-04-26T15:00:00-08:00'),
(5, 'MuiThaiKickBoxing', '3700 Willingdon Ave, Burnaby, BC V5G 3H2', 'Thai boxing is a combat sport of Thailand that uses stand-up striking along with various clinching techniques. This physical and mental discipline which includes combat on shins is known as \"the art of eight limbs\" because it is characterized by the combined use of fists, elbows, knees, shins, being associated with a good physical preparation that makes a full-contact fighter very efficient. Muay Thai became widespread internationally in the twentieth century, when practitioners defeated notable practitioners of other martial arts. The professional league is governed by The Professional Boxing Association of Thailand (P.A.T) sanctioned by The Sport Authority of Thailand (S.A.T.), and World Muaythai Federation (WMF) overseas.', '2018-04-27T15:00:00-08:00', '2018-04-27T16:00:00-08:00'),
(6, 'LadiesWhoLift', '3700 Willingdon Ave, Burnaby, BC V5G 3H2', 'This Women\'s only small Personal Training Session is for any and all women who are new to weight training or want to advance their current program and get results. If you want to gain the confidence and execute perfect lifting techniques specific for women, this is the program for you.', '2018-04-27T16:00:00-08:00', '2018-04-27T17:00:00-08:00');

-- --------------------------------------------------------

--
-- Table structure for table `rec_IDs`
--

CREATE TABLE `rec_IDs` (
  `ID` int(11) NOT NULL,
  `event` varchar(100) NOT NULL,
  `event_ID` varchar(100) NOT NULL,
  `cal_UID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rec_IDs`
--

INSERT INTO `rec_IDs` (`ID`, `event`, `event_ID`, `cal_UID`) VALUES
(1, 'TaiChi', '', ''),
(2, 'StudyStretch', '', ''),
(3, 'WeekendRecovery', '', ''),
(4, 'CrossTrainChallenge', '', ''),
(5, 'MuiThaiKickBoxing', '', ''),
(6, 'LadiesWhoLift', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture`, `link`, `created`, `modified`) VALUES
(1, 'google', '103436661411729978732', 'Monika', 'Szucs', 'monikasilviaszucs@gmail.com', 'other', 'en', 'https://lh5.googleusercontent.com/-RU8qrp7xa0Q/AAAAAAAAAAI/AAAAAAAAA3s/p3aZqft7w94/photo.jpg', 'https://plus.google.com/+MonikaSzucsFeifei', '2018-02-27 09:56:04', '2018-02-28 06:53:56'),
(2, 'google', '105437848743873229516', 'Daren', 'Capacio', 'darencapacio@gmail.com', 'male', 'en', 'https://lh5.googleusercontent.com/-_T63LmXK_g4/AAAAAAAAAAI/AAAAAAAAAB4/9SobW0P7LGc/photo.jpg', 'https://plus.google.com/105437848743873229516', '2018-03-01 19:09:23', '2018-03-04 20:55:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_recreation`
--

CREATE TABLE `user_recreation` (
  `user_rec_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recreation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recreations`
--
ALTER TABLE `recreations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rec_IDs`
--
ALTER TABLE `rec_IDs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_recreation`
--
ALTER TABLE `user_recreation`
  ADD PRIMARY KEY (`user_rec_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `recreation_id` (`recreation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recreations`
--
ALTER TABLE `recreations`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rec_IDs`
--
ALTER TABLE `rec_IDs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_recreation`
--
ALTER TABLE `user_recreation`
  MODIFY `user_rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_recreation`
--
ALTER TABLE `user_recreation`
  ADD CONSTRAINT `user_recreation_ibfk_1` FOREIGN KEY (`recreation_id`) REFERENCES `recreations` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_recreation_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
