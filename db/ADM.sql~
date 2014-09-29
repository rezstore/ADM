-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2014 at 05:30 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adm`
--

-- --------------------------------------------------------

--
-- Table structure for table `fb_applications`
--

CREATE TABLE IF NOT EXISTS `fb_applications` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(20) NOT NULL,
  `appId` varchar(100) NOT NULL,
  `appSecret` varchar(100) NOT NULL,
  `return_url` tinytext NOT NULL,
  `homeurl` tinytext NOT NULL,
  `fbPermissions` tinytext NOT NULL,
  `token` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fb_applications`
--

INSERT INTO `fb_applications` (`ID`, `app_name`, `appId`, `appSecret`, `return_url`, `homeurl`, `fbPermissions`, `token`, `status`) VALUES
(1, 'rezstore', '142895449211373', '3dbcdb2924d107bd28293f99ba0634e4', 'http://rezstore.com/facebook/process.php', 'http://rezstore.com/facebook/', 'publish_stream,manage_pages', 'CAACB9nB9ge0BAFzOdce8Y9yqwQbfc2uvvCgFNRvvrqs6x6FN98PsRG1MmiKsxw6DZAxOwqEtBQfQAZAtrXMaLsThTZBl279QC20dGskPGbNJhx7UtiOxEEr8AxzHK6ciAlZAYxCDBJcngM2wmMNz1Jn1cIZCAGix9YWMckTTZAU6ndSlsvz7kwckFJ77N5EB1sRHJBAcCPg24CCajLnGrQ', 0),
(2, 'rohman', '142895449211333', '3dbcdb2924d107bd28293f99ba0634e4', 'http://rezstore.com/facebook/process.php', 'http://rezstore.com/facebook/', 'publish_stream,manage_pages', 'CAACB9nB9ge0BAFzOdce8Y9yqwQbfc2uvvCgFNRvvrqs6x6FN98PsRG1MmiKsxw6DZAxOwqEtBQfQAZAtrXMaLsThTZBl279QC20dGskPGbNJhx7UtiOxEEr8AxzHK6ciAlZAYxCDBJcngM2wmMNz1Jn1cIZCAGix9YWMckTTZAU6ndSlsvz7kwckFJ77N5EB1sRHJBAcCPg24CCajLnGrQ', 0),
(3, 'werwe', 'werwer', 'werwer', 'wer', 'werwe', 'rewrwer', 'werwerer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fb_fanpages`
--

CREATE TABLE IF NOT EXISTS `fb_fanpages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` varchar(30) NOT NULL,
  `page_id` varchar(50) NOT NULL,
  `pagename` varchar(30) NOT NULL,
  `page_url` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fb_fanpages`
--

INSERT INTO `fb_fanpages` (`ID`, `UID`, `page_id`, `pagename`, `page_url`, `status`) VALUES
(1, '100005343461657', '338081799692389', 'RezstoreIndonesia', 'https://www.facebook.com/pages/Rezstore-indonesia/338081799692389', 1),
(2, '100005343461650', '338081799692380', 'rohman', 'https://www.facebook.com/pages/Rezstore-indonesia/338081799692389', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fb_messages_post`
--

CREATE TABLE IF NOT EXISTS `fb_messages_post` (
  `ID_post` int(11) NOT NULL AUTO_INCREMENT,
  `date_post` date NOT NULL,
  `page_id` varchar(30) NOT NULL,
  `messages` text NOT NULL,
  `url` tinytext NOT NULL,
  `image` tinytext NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID_post`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `fb_messages_post`
--

INSERT INTO `fb_messages_post` (`ID_post`, `date_post`, `page_id`, `messages`, `url`, `image`, `status`) VALUES
(27, '2014-09-10', '338081799692389', 'masuk', 'github.com', '1054727.jpg', 0),
(34, '2014-09-16', '338081799692389', 'jangan masuk kamar saya', 'github.com', '2230928.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fb_uid`
--

CREATE TABLE IF NOT EXISTS `fb_uid` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` varchar(30) NOT NULL,
  `url` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fb_uid`
--

INSERT INTO `fb_uid` (`ID`, `UID`, `url`, `status`) VALUES
(1, '100005343461657', 'https://www.facebook.com/cobasaja123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `twitter_applications`
--

CREATE TABLE IF NOT EXISTS `twitter_applications` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` varchar(30) NOT NULL,
  `appId` varchar(100) NOT NULL,
  `appSecret` varchar(100) NOT NULL,
  `token` tinytext NOT NULL,
  `token_secret` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `twitter_applications`
--

INSERT INTO `twitter_applications` (`ID`, `UID`, `appId`, `appSecret`, `token`, `token_secret`, `status`) VALUES
(2, '1223463476', 'ajLH0TmTJ7KuRalXta3AsS2ah', 'rlWadDntq2L38GOuAU9eeoBT4EbcrRljp81BBcd1az3CMwwhvz', '1223463476-gpssQJ4CJRSXfw7I594ZhJf1W9QQVYh11Aa9tgS', '7COAZ6EOG25F6ZH70POdvU21ybj6PWYw1dTgRNVu17aYN', 0),
(3, '2832778561', 'ArndYPnREeIuB4VyS8J4m8mfx', 'HmLWedmsW4Zai1UdI1K9mPHCCJOohKpGQTyitAQpd9j3j52LS3', '2832778561-DQiZDXFQ9KkkQCD48M8rQdwFtFVva4EI4JBcpa2', 'yYAj6BZdoFbyMjJ0WESxRUsE9SrD3Ey15Mqr2pkcQt5oF', 1);

-- --------------------------------------------------------

--
-- Table structure for table `twitter_messages_post`
--

CREATE TABLE IF NOT EXISTS `twitter_messages_post` (
  `ID_post` int(11) NOT NULL AUTO_INCREMENT,
  `date_post` date NOT NULL,
  `page_id` varchar(30) NOT NULL,
  `messages` text NOT NULL,
  `url` tinytext NOT NULL,
  `image` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_post`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `twitter_messages_post`
--

INSERT INTO `twitter_messages_post` (`ID_post`, `date_post`, `page_id`, `messages`, `url`, `image`, `status`) VALUES
(6, '2014-09-10', '2832778561', 'janganmasuk masuk', 'github.com/rezstore', '5760127.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `twitter_uid`
--

CREATE TABLE IF NOT EXISTS `twitter_uid` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `url` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `twitter_uid`
--

INSERT INTO `twitter_uid` (`ID`, `UID`, `user_name`, `url`, `status`) VALUES
(1, '2832778561', 'rezstore', 'https://twitter.com/rezstoreindo', 1),
(2, '1223463476', 'rohmanahmad', 'https://twitter.com/R0hmanAhmad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE IF NOT EXISTS `user_accounts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` tinytext NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`ID`, `username`, `password`, `status`) VALUES
(1, 'rohman', 'BmlVagAmV3QFOQ==', 1),
(2, 'laptop', '67bfP9hWnlUePxIQJFkheIF8pZjWYpnBtSxWC5Sld0t9h0gEZjDVw55kYeUtr9RG3+rhoKdS6+gzRUdRKUOh2A==', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE IF NOT EXISTS `user_activities` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  `message` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`ID`, `user`, `date_time`, `type`, `message`) VALUES
(3, 'rohman', '2014-09-27 17:00:48', 'facebook', 'menambah record baru dengan tgl post=2014-09-17'),
(4, 'rohman', '2014-09-27 17:01:57', 'twitter', 'menambah record baru dengan tgl post=2014-09-10'),
(5, 'laptop', '2014-09-27 22:36:58', 'twitter', 'menambah record baru dengan tgl post=2014-09-09'),
(6, 'laptop', '2014-09-27 22:45:39', 'twitter', 'mengubah record dengan ID=6'),
(7, 'laptop', '2014-09-27 22:47:10', 'facebook', 'menambah record baru dengan tgl post=2014-09-10'),
(8, 'laptop', '2014-09-28 08:05:07', 'facebook', 'menambah record baru dengan tgl post=2014-09-09'),
(9, 'laptop', '2014-09-28 08:05:53', 'facebook', 'hapus record dengan id 33'),
(10, 'laptop', '2014-09-28 08:09:22', 'facebook', 'menambah record baru dengan tgl post=2014-09-16'),
(11, 'laptop', '2014-09-28 17:05:49', 'facebook', 'input aplikasi facebook baru dengan appId=werwer');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
