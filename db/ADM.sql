-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2014 at 09:42 AM
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
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `ID_contact` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(20) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `nomor_telp1` varchar(15) NOT NULL,
  `nomor_telp2` varchar(15) NOT NULL,
  `nomor_telp3` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID_contact`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`ID_contact`, `nama`, `alamat`, `kota`, `kode_pos`, `nomor_telp1`, `nomor_telp2`, `nomor_telp3`, `email`, `status`) VALUES
(5, 'zaqi', 'jl.....................', 'malang', '0000', '098', '0786', '7655', 'bbbbb', 0);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_kota`
--

CREATE TABLE IF NOT EXISTS `daftar_kota` (
  `ID_kota` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kota` varchar(30) NOT NULL,
  `profinsi` varchar(30) NOT NULL,
  `posis` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_kota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `daftar_kota`
--

INSERT INTO `daftar_kota` (`ID_kota`, `nama_kota`, `profinsi`, `posis`) VALUES
(11, 'ma', 'hhhhh', '');

-- --------------------------------------------------------

--
-- Table structure for table `fp_fb_applications`
--

CREATE TABLE IF NOT EXISTS `fp_fb_applications` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fp_fb_applications`
--

INSERT INTO `fp_fb_applications` (`ID`, `app_name`, `appId`, `appSecret`, `return_url`, `homeurl`, `fbPermissions`, `token`, `status`) VALUES
(1, 'rezstore', '142895449211373', '3dbcdb2924d107bd28293f99ba0634e4', 'http://rezstore.com/facebook/process.php', 'http://rezstore.com/facebook/', 'publish_stream,manage_pages', 'CAAF4qGKsg1ABAB3UoHLLSRp66UOCdBvoKYwgYDdYRj6FQD0DfWZB0sLGVUDRAzbjUB2JIMewZCaGRZCeo7Q5FSEJZBYZCkmySWuD3ZCWFFh8MKEZAVv2rNDbJNvyxMvjXGTQY7y9ZBcdCxWA5EAj1w8lm8LRWqxkqbHsvsdxVVQZBZCPO58F0EZBqeu784au1PP9We3LVrAEDAHf0SdduuYALkT', 0),
(4, 'post', '543016585841901', 'acd91561e012251862364b115389d18f', 'http://rezstore.com/facebook/process.php', 'http://rezstore.com/facebook/', 'publish_stream,manage_pages', 'CAAHt3ua0zO0BADXzRmOWnaL4ToJvAUDoQAiD1IAZAXQFywRESkeuyDeGqtBZB3RgbTeIyfmiZBfEWRVKqVNvkhspaprG0ZBSlaObcMyzDGcpY1PQHkaSjLQQvnaMVri4fqAmmC8BmBLkYRxs1v7gjlKKiwhsSmIZAo1UOWxFpzmtvi1maajljZCLJz1m4kwh3bAlVBJHacGftQKvkOcOWo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fp_fb_fanpages`
--

CREATE TABLE IF NOT EXISTS `fp_fb_fanpages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` varchar(30) NOT NULL,
  `page_id` varchar(50) NOT NULL,
  `pagename` varchar(30) NOT NULL,
  `page_url` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fp_fb_fanpages`
--

INSERT INTO `fp_fb_fanpages` (`ID`, `UID`, `page_id`, `pagename`, `page_url`, `status`) VALUES
(1, '100005343461657', '338081799692389', 'RezstoreIndonesia', 'https://www.facebook.com/pages/Rezstore-indonesia/338081799692389', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fp_fb_messages_post`
--

CREATE TABLE IF NOT EXISTS `fp_fb_messages_post` (
  `ID_post` int(11) NOT NULL AUTO_INCREMENT,
  `date_post` date NOT NULL,
  `page_id` varchar(30) NOT NULL,
  `messages` text NOT NULL,
  `url` tinytext NOT NULL,
  `image` tinytext NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID_post`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `fp_fb_messages_post`
--

INSERT INTO `fp_fb_messages_post` (`ID_post`, `date_post`, `page_id`, `messages`, `url`, `image`, `status`) VALUES
(27, '2014-09-10', '338081799692389', 'Apakah anda mengenal aplikasi ini???\nlihat disini adf.ly/sVSkl', 'http://www.rezstore.com/blog/apa-itu/dunia-internet/belajar-menggunakan-github/', '1054727.png', 0),
(34, '2014-09-16', '338081799692389', 'jangan masuk kamar saya', 'github.com', '2230928.jpg', 0),
(35, '2014-09-03', '338081799692389', 'asdsad', 'http://www.rezstore.com', '08114029.png', 0),
(36, '2014-09-08', '338081799692389', 'localhost', 'http://www.rezstore.com', '51125129.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fp_fb_uid`
--

CREATE TABLE IF NOT EXISTS `fp_fb_uid` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` varchar(30) NOT NULL,
  `url` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fp_fb_uid`
--

INSERT INTO `fp_fb_uid` (`ID`, `UID`, `url`, `status`) VALUES
(1, '100005343461657', 'https://www.facebook.com/cobasaja123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fp_twitter_applications`
--

CREATE TABLE IF NOT EXISTS `fp_twitter_applications` (
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
-- Dumping data for table `fp_twitter_applications`
--

INSERT INTO `fp_twitter_applications` (`ID`, `UID`, `appId`, `appSecret`, `token`, `token_secret`, `status`) VALUES
(2, '1223463476', 'ajLH0TmTJ7KuRalXta3AsS2ah', 'rlWadDntq2L38GOuAU9eeoBT4EbcrRljp81BBcd1az3CMwwhvz', '1223463476-gpssQJ4CJRSXfw7I594ZhJf1W9QQVYh11Aa9tgS', '7COAZ6EOG25F6ZH70POdvU21ybj6PWYw1dTgRNVu17aYN', 0),
(3, '2832778561', 'ArndYPnREeIuB4VyS8J4m8mfx', 'HmLWedmsW4Zai1UdI1K9mPHCCJOohKpGQTyitAQpd9j3j52LS3', '2832778561-DQiZDXFQ9KkkQCD48M8rQdwFtFVva4EI4JBcpa2', 'yYAj6BZdoFbyMjJ0WESxRUsE9SrD3Ey15Mqr2pkcQt5oF', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fp_twitter_messages_post`
--

CREATE TABLE IF NOT EXISTS `fp_twitter_messages_post` (
  `ID_post` int(11) NOT NULL AUTO_INCREMENT,
  `date_post` date NOT NULL,
  `page_id` varchar(30) NOT NULL,
  `messages` text NOT NULL,
  `url` tinytext NOT NULL,
  `image` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_post`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `fp_twitter_messages_post`
--

INSERT INTO `fp_twitter_messages_post` (`ID_post`, `date_post`, `page_id`, `messages`, `url`, `image`, `status`) VALUES
(6, '2014-09-10', '2832778561', 'google', 'github.com/rezstore', '5760127.jpg', 0),
(7, '2014-09-10', '2832778561', 'asdasd', 'http://www.rezstore.com', '14125229.png', 1),
(8, '2014-10-01', '2832778561', 'asdasd', 'http://www.rezstore.com/blog/apa-itu/dunia-internet/belajar-menggunakan-github/', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fp_twitter_uid`
--

CREATE TABLE IF NOT EXISTS `fp_twitter_uid` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `url` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fp_twitter_uid`
--

INSERT INTO `fp_twitter_uid` (`ID`, `UID`, `user_name`, `url`, `status`) VALUES
(1, '2832778561', 'rezstore', 'https://twitter.com/rezstoreindo', 1),
(2, '1223463476', 'rohmanahmad', 'https://twitter.com/R0hmanAhmad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembukuan_akun_perkiraan`
--

CREATE TABLE IF NOT EXISTS `pembukuan_akun_perkiraan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nama_akun` varchar(30) NOT NULL,
  `id_parent` tinyint(3) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `jenis` varchar(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `pembukuan_akun_perkiraan`
--

INSERT INTO `pembukuan_akun_perkiraan` (`ID`, `nama_akun`, `id_parent`, `kode`, `jenis`) VALUES
(1, 'Aktiva', 0, '100', 'A'),
(2, 'Modal', 0, '300', 'M'),
(3, 'Kewajiban', 0, '200', 'K'),
(4, 'Pendapatan', 0, '400', 'P'),
(5, 'Biaya', 0, '500', 'B'),
(42, 'Kas', 1, '101', ''),
(43, 'Bank', 1, '102', ''),
(44, 'Perlengkapan Kantor', 1, '103', ''),
(46, 'Aktiva Tetap', 1, '105', ''),
(47, 'Persediaan Barang Dagang', 1, '106', ''),
(50, 'Penjualan website', 4, '401', ''),
(54, 'Biaya Iklan', 5, '501', ''),
(55, 'Biaya Listrik dan PDAM', 5, '502', ''),
(56, 'Biaya Pulsa', 5, '503', ''),
(57, 'Biaya Lain-Lain', 5, '504', ''),
(58, 'Prive rezstore', 67, '601', ''),
(59, 'Modal Awal', 2, '302', 'MA'),
(60, 'Beban Gaji', 5, '505', ''),
(61, 'Beban Pajak', 5, '506', ''),
(62, 'Rupa-Rupa Aktiva', 1, '107', ''),
(63, 'Rupa-Rupa Pasifa', 3, '401', ''),
(64, 'Hutang Dagang', 3, '402', ''),
(65, 'Bunga Bank', 4, '404', ''),
(66, 'Biaya Administrasi Bank', 5, '507', ''),
(67, 'Prive', 0, '600', 'R'),
(68, 'Biaya Pembelian', 5, '508', ''),
(69, 'Modal rezstore', 2, '301', ''),
(70, 'Persediaan Biaya Syukuran', 1, '108', ''),
(72, 'Cadangan Biaya Iklan', 1, '109', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembukuan_jurnal`
--

CREATE TABLE IF NOT EXISTS `pembukuan_jurnal` (
  `ID_jurnal` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`ID_jurnal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pembukuan_jurnal`
--

INSERT INTO `pembukuan_jurnal` (`ID_jurnal`, `tanggal`, `keterangan`) VALUES
(1, '0000-00-00', ''),
(2, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembukuan_jurnal_detail`
--

CREATE TABLE IF NOT EXISTS `pembukuan_jurnal_detail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_jurnal` int(11) NOT NULL,
  `id_akun_perkiraan` int(11) NOT NULL,
  `debet` decimal(14,2) NOT NULL,
  `kredit` decimal(14,2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`ID`, `user`, `date_time`, `type`, `message`) VALUES
(3, 'rohman', '2014-09-27 17:00:48', 'facebook', 'menambah record baru dengan tgl post=2014-09-17'),
(4, 'rohman', '2014-09-27 17:01:57', 'twitter', 'menambah record baru dengan tgl post=2014-09-10'),
(5, 'rohman', '2014-09-27 22:36:58', 'twitter', 'menambah record baru dengan tgl post=2014-09-09'),
(6, 'rohman', '2014-09-18 22:45:39', 'twitter', 'mengubah record dengan ID=6'),
(7, 'rohman', '2014-09-27 22:47:10', 'facebook', 'menambah record baru dengan tgl post=2014-09-10'),
(8, 'rohman', '2014-09-28 08:05:07', 'facebook', 'menambah record baru dengan tgl post=2014-09-09'),
(9, 'rohman', '2014-09-28 08:05:53', 'facebook', 'hapus record dengan id 33'),
(10, 'rohman', '2014-09-29 08:09:22', 'facebook', 'menambah record baru dengan tgl post=2014-09-16'),
(11, 'rohman', '2014-09-29 17:05:49', 'facebook', 'input aplikasi facebook baru dengan appId=werwer'),
(12, 'rohman', '2014-09-29 10:40:08', 'facebook', 'menambah record baru dengan tgl post=2014-09-03'),
(13, 'rohman', '2014-09-29 11:51:51', 'facebook', 'menambah record baru dengan tgl post=2014-09-08'),
(14, 'rohman', '2014-09-29 11:52:14', 'twitter', 'menambah record baru dengan tgl post=2014-09-10'),
(15, 'rohman', '2014-09-29 11:52:32', 'facebook', 'mengubah record dengan ID=36'),
(16, 'rohman', '2014-10-01 10:28:10', 'facebook', 'mengubah record dengan ID=27'),
(17, 'laptop', '2014-10-20 15:27:10', 'twitter', 'mengubah record dengan ID=6'),
(18, 'laptop', '2014-10-20 15:32:26', 'twitter', 'menambah record baru dengan tgl post=2014-10-01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
