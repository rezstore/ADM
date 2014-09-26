-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2014 at 05:55 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ADM`
--

-- --------------------------------------------------------

--
-- Table structure for table `fb_applications`
--

CREATE TABLE IF NOT EXISTS `fb_applications` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `appId` varchar(100) NOT NULL,
  `appSecret` varchar(100) NOT NULL,
  `return_url` tinytext NOT NULL,
  `homeurl` tinytext NOT NULL,
  `fbPermissions` tinytext NOT NULL,
  `token` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fb_applications`
--

INSERT INTO `fb_applications` (`ID`, `appId`, `appSecret`, `return_url`, `homeurl`, `fbPermissions`, `token`, `status`) VALUES
(1, '142895449211373', '3dbcdb2924d107bd28293f99ba0634e4', 'http://rezstore.com/facebook/process.php', 'http://rezstore.com/facebook/', 'publish_stream,manage_pages', 'CAACB9nB9ge0BAFzOdce8Y9yqwQbfc2uvvCgFNRvvrqs6x6FN98PsRG1MmiKsxw6DZAxOwqEtBQfQAZAtrXMaLsThTZBl279QC20dGskPGbNJhx7UtiOxEEr8AxzHK6ciAlZAYxCDBJcngM2wmMNz1Jn1cIZCAGix9YWMckTTZAU6ndSlsvz7kwckFJ77N5EB1sRHJBAcCPg24CCajLnGrQ', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `fb_messages_post`
--

INSERT INTO `fb_messages_post` (`ID_post`, `date_post`, `page_id`, `messages`, `url`, `image`, `status`) VALUES
(13, '2014-09-09', '338081799692389', 'mengapa???', 'github.com/rezstore', '1132026.png', 0),
(14, '2014-09-10', '338081799692389', 'janganmasuk mengendarai ', 'http://rezstore.com/c/index.php/c/id/por', '3432826.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fb_UID`
--

CREATE TABLE IF NOT EXISTS `fb_UID` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` varchar(30) NOT NULL,
  `url` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fb_UID`
--

INSERT INTO `fb_UID` (`ID`, `UID`, `url`, `status`) VALUES
(1, '100005343461657', 'https://www.facebook.com/cobasaja123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `twitter_applications`
--

CREATE TABLE IF NOT EXISTS `twitter_applications` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
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

INSERT INTO `twitter_applications` (`ID`, `appId`, `appSecret`, `token`, `token_secret`, `status`) VALUES
(2, 'ajLH0TmTJ7KuRalXta3AsS2ah', 'rlWadDntq2L38GOuAU9eeoBT4EbcrRljp81BBcd1az3CMwwhvz', '1223463476-gpssQJ4CJRSXfw7I594ZhJf1W9QQVYh11Aa9tgS', '7COAZ6EOG25F6ZH70POdvU21ybj6PWYw1dTgRNVu17aYN', 0),
(3, 'ArndYPnREeIuB4VyS8J4m8mfx', 'HmLWedmsW4Zai1UdI1K9mPHCCJOohKpGQTyitAQpd9j3j52LS3', '2832778561-DQiZDXFQ9KkkQCD48M8rQdwFtFVva4EI4JBcpa2', 'yYAj6BZdoFbyMjJ0WESxRUsE9SrD3Ey15Mqr2pkcQt5oF', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `twitter_messages_post`
--

INSERT INTO `twitter_messages_post` (`ID_post`, `date_post`, `page_id`, `messages`, `url`, `image`, `status`) VALUES
(1, '2014-09-08', 'asd', 'asdasdasdasdasd', 'asdasdasdasd', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `twitter_UID`
--

CREATE TABLE IF NOT EXISTS `twitter_UID` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` varchar(30) NOT NULL,
  `url` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `twitter_UID`
--

INSERT INTO `twitter_UID` (`ID`, `UID`, `url`, `status`) VALUES
(1, '100005343461657', 'https://www.facebook.com/cobasaja123', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
