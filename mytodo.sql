-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2014 at 08:27 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mytodo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `taskId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `taskName` varchar(500) NOT NULL,
  `taskDescription` varchar(4000) DEFAULT NULL,
  `dueDate` timestamp NULL DEFAULT NULL,
  `reminderDate` timestamp NULL DEFAULT NULL,
  `isReminder` tinyint(1) NOT NULL DEFAULT '0',
  `isDueDate` tinyint(1) NOT NULL DEFAULT '0',
  `isComplete` tinyint(1) NOT NULL DEFAULT '0',
  `createdDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`taskId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`taskId`, `userId`, `taskName`, `taskDescription`, `dueDate`, `reminderDate`, `isReminder`, `isDueDate`, `isComplete`, `createdDate`, `updatedDate`) VALUES
(30, 5, '323', '213123', NULL, NULL, 0, 0, 0, '2014-08-06 09:35:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fullname` varchar(500) DEFAULT NULL,
  `fbAccessToken` varchar(500) NOT NULL,
  PRIMARY KEY (`userId`),
  KEY `uid` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `fullname`, `fbAccessToken`) VALUES
(1, 'admin', 'admin', 'administrator', ''),
(2, 'admin1', 'admin1', 'admin1', ''),
(3, 'admin2', 'admin2', 'admin2', ''),
(4, 'admin4', 'admin4', 'admin4', ''),
(5, 'hungmutsu@gmail.com', '123456', 'Hung Mutsu', 'CAAVJqg8sqUkBANMMatzbZAV3jy4tMLj5DzvOyh1CUvTTjFGU6M2ZCnlaCNe7mCeuAV5ZB9okm2ZAaKyJr62DNkGjSb0fv0Ar1oJZBv2UKLyMFPGTIgIDQI8I7WAyMePi9neYMgLE35T4VRYqiWSVm7fpNfyKlSgH9d89Ru4ZBqQSKVnoe4fnjYd3fWBSXp92VUbxLCZCJNYwMydtONmsx47');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
