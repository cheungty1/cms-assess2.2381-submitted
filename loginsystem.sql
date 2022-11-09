-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 02, 2022 at 11:42 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  `imageurl` text,
  `comment` text,
  `websitetitle` tinytext,
  `websiteurl` text,
  `author` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `imageurl`, `comment`, `websitetitle`, `websiteurl`, `author`) VALUES
(1, 'ocean-view', 'https://ia800402.us.archive.org/26/items/03-05-2016_Images_Images_1-30/01_PT_hero_42_153645159.jpg', 'jellyfish', 'archive.org', 'https://ia800402.us.archive.org/26/items/03-05-2016_Images_Images_1-30/01_PT_hero_42_153645159.jpg', 'Naomi'),
(2, 'airplane view', 'https://images.unsplash.com/photo-1500835556837-99ac94a94552?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1587&q=80', 'airplane view', 'unplash', 'https://images.unsplash.com/photo-1500835556837-99ac94a94552?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1587&q=80', 'Atena'),
(3, 'sakura', 'https://images.unsplash.com/photo-1617089268741-035d1a43fad9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80', 'sakura- japan', 'unsplash', 'https://unsplash.com/photos/Ml8WeLdCnRU', 'Sha'),
(4, 'train interior', 'https://images.unsplash.com/photo-1607270636550-da7062dc7c77?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80', 'train interior', 'unplash', 'https://unsplash.com/photos/49S7BKnHsI0', 'Keane'),
(5, 'train exterior', 'https://images.unsplash.com/photo-1527295110-5145f6b148d0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1131&q=80', 'train exterior', 'unsplash', 'https://unsplash.com/photos/Njq3Nz6-5rQ', 'Ben'),
(6, 'sushi', 'https://images.unsplash.com/photo-1563612116828-a62f45c706e4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=730&q=80', 'sushi', 'sushi', 'https://unsplash.com/photos/xXOcdw54sks', 'Tait'),
(7, 'laksa noodles', 'https://images.unsplash.com/photo-1585417791023-a5a6164b2646?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=707&q=80', 'laksa noodles', 'https://unsplash.com/photos/wrfO9SWykdE ', 'https://images.unsplash.com/photo-1585417791023-a5a6164b2646?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=707&q=80', 'Mina');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUsers` int(11) NOT NULL AUTO_INCREMENT,
  `uidUsers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `uidUsers`, `emailUsers`, `pwdUsers`) VALUES
(1, 'daniel', 'daniel@daniel.com', '$2y$10$Lz6NRGtp5mRsMZ16aMlQ8OXZyFiy8sfcBBcL2OAMGUycQT2CTrxTe'),
(8, 'alex', 'alex@alex.com', '$2y$10$.tbxlTh5BRnEEmGCrJdOKeS.Hx6OUfNOWXqnP4919wSQUQ2EXMvx2'),
(10, 'ben', 'ben@ben.com', '$2y$10$m8Z/7OkPWh.Uhu2FofG6lu9kqdmXaekjz6QkNEMNYQVInpV2ABpCm'),
(11, 'tait', 'tait@hotmail.com', '$2y$10$2cMIt1JH255bi3iC8Q1EEevGmX9QdHSEs4R6.0hKTBJWtznBlJRP2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
