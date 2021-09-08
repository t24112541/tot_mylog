-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2021 at 03:46 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nt_my_log`
--
CREATE DATABASE IF NOT EXISTS `nt_my_log` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `nt_my_log`;

-- --------------------------------------------------------

--
-- Table structure for table `l_department`
--
-- Creation: Sep 07, 2021 at 01:10 PM
-- Last update: Sep 07, 2021 at 01:10 PM
--

DROP TABLE IF EXISTS `l_department`;
CREATE TABLE IF NOT EXISTS `l_department` (
  `d_id` int(10) NOT NULL AUTO_INCREMENT,
  `d_name` text COLLATE utf8_unicode_ci NOT NULL,
  `d_des` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `l_department`:
--

-- --------------------------------------------------------

--
-- Table structure for table `l_log`
--
-- Creation: Sep 07, 2021 at 01:19 PM
-- Last update: Sep 07, 2021 at 01:19 PM
--

DROP TABLE IF EXISTS `l_log`;
CREATE TABLE IF NOT EXISTS `l_log` (
  `l_id` int(10) NOT NULL AUTO_INCREMENT,
  `l_title` text COLLATE utf8_unicode_ci NOT NULL,
  `l_detail` text COLLATE utf8_unicode_ci,
  `l_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `l_log`:
--

-- --------------------------------------------------------

--
-- Table structure for table `l_log_approve`
--
-- Creation: Sep 07, 2021 at 01:17 PM
-- Last update: Sep 07, 2021 at 01:17 PM
--

DROP TABLE IF EXISTS `l_log_approve`;
CREATE TABLE IF NOT EXISTS `l_log_approve` (
  `la_id` int(10) NOT NULL AUTO_INCREMENT,
  `l_id` int(10) NOT NULL,
  `la_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_id` int(10) NOT NULL,
  `la_comment` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`la_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `l_log_approve`:
--

-- --------------------------------------------------------

--
-- Table structure for table `l_log_files`
--
-- Creation: Sep 07, 2021 at 01:21 PM
-- Last update: Sep 07, 2021 at 01:21 PM
--

DROP TABLE IF EXISTS `l_log_files`;
CREATE TABLE IF NOT EXISTS `l_log_files` (
  `lf_id` int(10) NOT NULL AUTO_INCREMENT,
  `lf_file` text COLLATE utf8_unicode_ci NOT NULL,
  `l_id` int(10) NOT NULL,
  PRIMARY KEY (`lf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `l_log_files`:
--

-- --------------------------------------------------------

--
-- Table structure for table `l_position`
--
-- Creation: Sep 07, 2021 at 01:12 PM
-- Last update: Sep 07, 2021 at 01:12 PM
--

DROP TABLE IF EXISTS `l_position`;
CREATE TABLE IF NOT EXISTS `l_position` (
  `p_id` int(10) NOT NULL AUTO_INCREMENT,
  `p_name` text COLLATE utf8_unicode_ci NOT NULL,
  `p_des` text COLLATE utf8_unicode_ci,
  `p_priority` int(1) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `l_position`:
--

-- --------------------------------------------------------

--
-- Table structure for table `l_province`
--
-- Creation: Sep 07, 2021 at 01:19 PM
-- Last update: Sep 07, 2021 at 01:19 PM
--

DROP TABLE IF EXISTS `l_province`;
CREATE TABLE IF NOT EXISTS `l_province` (
  `pv_id` int(10) NOT NULL,
  `pv_name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `l_province`:
--

-- --------------------------------------------------------

--
-- Table structure for table `l_unit_work`
--
-- Creation: Sep 07, 2021 at 01:22 PM
-- Last update: Sep 07, 2021 at 01:22 PM
--

DROP TABLE IF EXISTS `l_unit_work`;
CREATE TABLE IF NOT EXISTS `l_unit_work` (
  `uw_id` int(10) NOT NULL AUTO_INCREMENT,
  `l_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  PRIMARY KEY (`uw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `l_unit_work`:
--

-- --------------------------------------------------------

--
-- Table structure for table `l_users`
--
-- Creation: Sep 07, 2021 at 01:08 PM
-- Last update: Sep 07, 2021 at 01:08 PM
--

DROP TABLE IF EXISTS `l_users`;
CREATE TABLE IF NOT EXISTS `l_users` (
  `u_id` int(10) NOT NULL AUTO_INCREMENT,
  `u_fullname` text COLLATE utf8_unicode_ci NOT NULL,
  `u_tel` text COLLATE utf8_unicode_ci NOT NULL,
  `d_id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `pv_id` int(10) NOT NULL,
  `u_code` int(13) NOT NULL COMMENT 'รหัสประชาชน',
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `l_users`:
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
