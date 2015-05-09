-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2015 at 05:53 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blogsoftuni`
--
CREATE DATABASE IF NOT EXISTS `blogsoftuni` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `blogsoftuni`;

-- --------------------------------------------------------

--
-- Table structure for table `blogcomments`
--

CREATE TABLE IF NOT EXISTS `blogcomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(45) NOT NULL,
  `Comment` text NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Email` varchar(45) DEFAULT NULL,
  `Blogs_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_BlogComments_Blogs1_idx` (`Blogs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogers`
--

CREATE TABLE IF NOT EXISTS `blogers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Info` text,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `UserName` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UserName_UNIQUE` (`UserName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `blogers`
--

INSERT INTO `blogers` (`id`, `FirstName`, `LastName`, `Info`, `Email`, `Password`, `UserName`) VALUES
(1, 'kalin', 'kanchev3', 'Info for megddd2  n', 'test@test.som', '123456', 'mas');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(45) NOT NULL,
  `Text` text,
  `Visits` int(11) DEFAULT NULL,
  `Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Blogers_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Blogs_Blogers1_idx` (`Blogers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `Title`, `Text`, `Visits`, `Date`, `Blogers_id`) VALUES
(20, '2', '2', 4, '2015-05-09 08:28:28', 1),
(21, '3', '3', 1, '2015-05-09 08:28:34', 1),
(22, '4', '4', 1, '2015-05-09 08:28:39', 1),
(23, '5', '5', 1, '2015-05-09 08:28:45', 1),
(24, '6', '6', 2, '2015-05-09 08:28:50', 1),
(25, '7', '7', 0, '2015-05-09 08:28:57', 1),
(27, '9', '9', 0, '2015-05-09 08:29:09', 1),
(28, '10', '10', 0, '2015-05-09 08:29:17', 1),
(29, '11', '11', 1, '2015-05-09 08:29:23', 1),
(30, 'fd', 'fdfd', 1, '2015-05-09 14:49:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `TagText` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `TagText`) VALUES
(8, 'sdsa'),
(9, 'fdfdf'),
(10, 'new'),
(12, 'a'),
(14, 'fdsfsfssa'),
(15, 'fsd ssf dfds e33'),
(16, 'fdfds');

-- --------------------------------------------------------

--
-- Table structure for table `tags_has_blogs`
--

CREATE TABLE IF NOT EXISTS `tags_has_blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Tags_id` int(11) NOT NULL,
  `Blogs_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Tags_has_Blogs_Blogs1_idx` (`Blogs_id`),
  KEY `fk_Tags_has_Blogs_Tags_idx` (`Tags_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tags_has_blogs`
--

INSERT INTO `tags_has_blogs` (`id`, `Tags_id`, `Blogs_id`) VALUES
(2, 12, 20),
(3, 12, 21),
(4, 12, 22),
(5, 12, 23),
(6, 12, 24);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogcomments`
--
ALTER TABLE `blogcomments`
  ADD CONSTRAINT `fk_BlogComments_Blogs1` FOREIGN KEY (`Blogs_id`) REFERENCES `blogs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `fk_Blogs_Blogers1` FOREIGN KEY (`Blogers_id`) REFERENCES `blogers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
