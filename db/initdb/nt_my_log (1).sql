-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2021 at 05:30 PM
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

DROP TABLE IF EXISTS `l_department`;
CREATE TABLE IF NOT EXISTS `l_department` (
  `d_id` int(10) NOT NULL AUTO_INCREMENT,
  `d_name` text COLLATE utf8_unicode_ci NOT NULL,
  `d_des` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1004 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `l_department`
--

INSERT INTO `l_department` (`d_id`, `d_name`, `d_des`) VALUES
(1001, 'ศูนย์ปฏิบัติการตอนนอก', ''),
(1002, 'ศูนย์บริการลูกค้าสาขาชัยภูมิ', ''),
(1003, 'ชัยภูมิ', '');

-- --------------------------------------------------------

--
-- Table structure for table `l_log`
--

DROP TABLE IF EXISTS `l_log`;
CREATE TABLE IF NOT EXISTS `l_log` (
  `l_id` int(10) NOT NULL AUTO_INCREMENT,
  `l_title` text COLLATE utf8_unicode_ci NOT NULL,
  `l_detail` text COLLATE utf8_unicode_ci,
  `l_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_id` int(10) NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `l_log`
--

INSERT INTO `l_log` (`l_id`, `l_title`, `l_detail`, `l_date`, `u_id`) VALUES
(1, 'ตรวจแก้วงจร j', 'fdzhtgxyjh', '2021-09-18 09:38:35', 0),
(2, 'ตรวจแก้วงจร j', 'fdzhtgxyjh', '2021-09-18 09:40:05', 0),
(3, 'ตรวจแก้วงจร j', 'fdzhtgxyjh', '2021-09-18 09:41:01', 0),
(4, 'ตรวจแก้วงจร j', 'fdzhtgxyjh', '2021-09-18 09:41:28', 0),
(5, 'ตรวจแก้วงจร j', 'fdzhtgxyjh', '2021-09-18 09:42:06', 0),
(6, 'ตรวจแก้วงจร l', 'fdzhtgxyjh', '2021-09-18 09:42:43', 0),
(7, 'ตรวจแก้วงจร j', 'fdzhtgxyjh', '2021-09-18 09:43:52', 1),
(8, 'ตรวจแก้วงจร j', 'fdzhtgxyjh', '2021-09-18 09:50:23', 0),
(9, 'ตรวจแก้วงจร j 1111', 'ddddddddddddddddddddd', '2021-09-18 09:51:35', 1),
(10, 'ตรวจแก้วงจร j', 'fdzhtgxyjh', '2021-09-18 09:53:09', 0),
(11, 'ตรวจแก้วงจร j', 'fdzhtgxyjh', '2021-09-18 09:53:21', 0),
(12, 'ตรวจแก้วงจร j', 'fdzhtgxyjh', '2021-09-18 09:53:35', 0),
(13, 'ตรวจแก้วงจร j', 'fdzhtgxyjh', '2021-09-18 09:54:04', 0),
(14, 'ตรวจแก้วงจร j 12121', 'hhhhhhhhhhhhhhhhhhhhhhhh', '2021-09-18 09:54:38', 1),
(15, 'ตรวจแก้วงจร j', 'fdzhtgxyjh', '2021-09-18 09:55:18', 0),
(16, 'ตรวจแก้วงจร j', 'ด', '2021-09-18 15:19:33', 1),
(17, 'ตัดถ่าย', 'ดดดดดดดดดดดด', '2021-09-18 15:19:46', 1),
(28, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-19 22:55:24', 1),
(26, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-19 22:54:25', 1),
(27, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-19 22:55:01', 1),
(29, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-19 22:55:38', 1),
(30, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-19 22:56:10', 1),
(31, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-19 22:56:27', 1),
(32, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-19 22:56:48', 1),
(33, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-19 22:59:54', 1),
(34, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-19 23:00:17', 1),
(35, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-19 23:00:55', 1),
(36, 'ตรวจแก้วงจร j 12121', NULL, '2021-09-19 23:01:14', 1),
(37, 'ตรวจแก้วงจร j 12121', NULL, '2021-09-19 23:02:03', 1),
(38, 'ตรวจแก้วงจร j 12121', NULL, '2021-09-19 23:02:24', 1),
(39, 'ตรวจแก้วงจร j 12121', NULL, '2021-09-19 23:02:49', 1),
(40, 'ตรวจแก้วงจร j 12121', NULL, '2021-09-19 23:02:57', 1),
(41, 'ตรวจแก้วงจร j 12121', NULL, '2021-09-19 23:04:55', 1),
(42, 'ตรวจแก้วงจร j 12121', NULL, '2021-09-19 23:05:46', 1),
(43, 'ตรวจแก้วงจร j 12121', NULL, '2021-09-19 23:06:51', 1),
(44, 'ตรวจแก้วงจร j 12121', NULL, '2021-09-19 23:20:21', 1),
(45, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-19 23:23:36', 1),
(46, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-19 23:48:04', 1),
(47, 'null', NULL, '2021-09-19 23:51:45', 1),
(48, 'ตรวจแก้วงจร j 1111', 'uuuu', '2021-09-19 23:52:16', 1),
(49, 'ตรวจแก้วงจร j', 'xd', '2021-09-19 23:53:33', 1),
(50, 'ตรวจแก้วงจร j 1111', 'ccccc', '2021-09-19 23:54:36', 1),
(51, 'ตรวจแก้วงจร j 1111', 'ccccc', '2021-09-19 23:55:39', 1),
(52, 'ตรวจแก้วงจร l', 'null', '2021-09-19 23:57:41', 1),
(53, 'ตรวจแก้วงจร j 1111', 'null', '2021-09-19 23:58:57', 1),
(54, 'asdfghjkl;', NULL, '2021-09-20 08:39:46', 1),
(55, 'ตรวจแก้ชุมสายร่วง', NULL, '2021-09-20 08:45:34', 1),
(56, 'burst', NULL, '2021-09-20 08:51:42', 1),
(57, 'hello', NULL, '2021-09-20 08:54:26', 1),
(58, 'ola', NULL, '2021-09-20 08:55:00', 1),
(59, 'ตรวจแก้วงจร j 1111', 'null', '2021-09-20 21:40:29', 1),
(60, 'hello', NULL, '2021-09-20 22:22:45', 1),
(61, 'ตรวจแก้วงจร l', NULL, '2021-09-20 22:23:17', 1),
(62, 'ตรวจแก้วงจร j 1111', NULL, '2021-09-20 22:24:10', 1),
(63, 'ตรวจแก้วงจร j', '4485j1234 หนูกัดสาย', '2021-09-22 21:13:56', 3),
(64, 'ตรวจแก้วงจร j 12121', 'กดทเปอิืปอเื้', '2021-09-25 21:59:07', 4),
(65, 'ตรวจแก้ชุมสายร่วง', 'ffffffffffffffff', '2021-09-25 23:11:03', 3),
(66, 'ตัดถ่าย', NULL, '2021-10-01 21:08:30', 3),
(67, 'ola', NULL, '2021-10-01 21:49:19', 3);

-- --------------------------------------------------------

--
-- Table structure for table `l_log_approve`
--

DROP TABLE IF EXISTS `l_log_approve`;
CREATE TABLE IF NOT EXISTS `l_log_approve` (
  `la_id` int(10) NOT NULL AUTO_INCREMENT,
  `l_id` int(10) NOT NULL,
  `la_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `u_id` int(10) DEFAULT NULL,
  `la_comment` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`la_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `l_log_approve`
--

INSERT INTO `l_log_approve` (`la_id`, `l_id`, `la_date`, `u_id`, `la_comment`) VALUES
(1, 1, '2021-09-18 09:38:35', NULL, NULL),
(2, 2, '2021-09-18 09:40:05', NULL, NULL),
(3, 3, '2021-09-18 09:41:01', NULL, NULL),
(4, 4, '2021-09-18 09:41:28', NULL, NULL),
(5, 5, '2021-09-18 09:42:06', NULL, NULL),
(6, 6, '2021-09-18 09:42:43', NULL, NULL),
(7, 7, '2021-09-18 09:43:52', NULL, NULL),
(8, 8, '2021-09-18 09:50:23', NULL, NULL),
(9, 9, '2021-09-18 09:51:35', NULL, NULL),
(10, 10, '2021-09-18 09:53:09', NULL, NULL),
(11, 11, '2021-09-18 09:53:21', NULL, NULL),
(12, 12, '2021-09-18 09:53:35', NULL, NULL),
(13, 13, '2021-09-18 09:54:04', NULL, NULL),
(14, 14, '2021-09-18 09:54:38', NULL, NULL),
(15, 15, '2021-09-18 09:55:18', NULL, NULL),
(16, 16, '2021-09-18 15:19:33', NULL, NULL),
(17, 17, '2021-09-18 15:19:46', NULL, NULL),
(18, 18, '2021-09-19 21:35:46', NULL, NULL),
(19, 19, '2021-09-19 21:44:34', NULL, NULL),
(20, 20, '2021-09-19 21:44:50', NULL, NULL),
(21, 21, '2021-09-19 22:48:20', NULL, NULL),
(22, 22, '2021-09-19 22:49:03', NULL, NULL),
(23, 23, '2021-09-19 22:52:11', NULL, NULL),
(24, 24, '2021-09-19 22:52:41', NULL, NULL),
(25, 25, '2021-09-19 22:53:20', NULL, NULL),
(26, 51, '2021-09-19 23:55:39', NULL, NULL),
(27, 52, '2021-09-19 23:57:41', NULL, NULL),
(28, 53, '2021-09-19 23:58:57', NULL, NULL),
(29, 54, '2021-09-20 08:39:46', NULL, NULL),
(30, 55, '2021-09-20 08:45:34', NULL, NULL),
(31, 56, '2021-09-20 08:51:42', NULL, NULL),
(32, 57, '2021-09-20 08:54:26', NULL, NULL),
(33, 58, '2021-09-20 08:55:00', NULL, NULL),
(34, 59, '2021-09-20 21:40:29', NULL, NULL),
(35, 60, '2021-09-20 22:22:45', NULL, NULL),
(36, 61, '2021-09-20 22:23:17', NULL, NULL),
(37, 62, '2021-09-20 22:24:10', NULL, NULL),
(38, 63, '2021-09-22 21:13:56', 4, 'ทดสอบนะไอสัส'),
(39, 64, '2021-09-27 20:17:38', 1, 'ตรวจแล้วดีมาก'),
(40, 65, '2021-09-27 20:12:37', 4, ' ทดสอบๆ'),
(41, 66, '2021-10-01 21:08:30', NULL, NULL),
(42, 67, '2021-10-01 21:49:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `l_log_files`
--

DROP TABLE IF EXISTS `l_log_files`;
CREATE TABLE IF NOT EXISTS `l_log_files` (
  `lf_id` int(10) NOT NULL AUTO_INCREMENT,
  `lf_file` text COLLATE utf8_unicode_ci,
  `l_id` int(10) NOT NULL,
  PRIMARY KEY (`lf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `l_log_files`
--

INSERT INTO `l_log_files` (`lf_id`, `lf_file`, `l_id`) VALUES
(1, '', 9),
(2, '', 10),
(3, '', 11),
(4, '', 12),
(5, '', 13),
(6, '../../img/2121-09-18_095518.jpg', 14),
(7, '../../img/2121-09-18_095518.jpg', 15),
(8, '', 16),
(9, '../../img/2021-09-20_000533.jpg', 17),
(10, '', 18),
(11, '', 19),
(12, '', 20),
(13, '', 21),
(14, '', 22),
(15, '', 23),
(16, '', 24),
(17, '', 25),
(18, '', 26),
(19, '', 27),
(20, '', 28),
(21, './img/2021-09-19_225538.jpg', 29),
(22, './img/2021-09-19_225610.jpg', 30),
(23, './img/2021-09-19_225627.jpg', 31),
(24, '', 32),
(25, '../../img/2021-09-20_000520.jpg', 51),
(26, '../../img/2021-09-20_000503.jpg', 52),
(27, '../../img/2021-09-20_000430.jpg', 53),
(28, '', 54),
(29, '', 55),
(30, '', 56),
(31, '', 57),
(32, '', 58),
(33, '../../img/2021-09-20_222207.jpg', 59),
(34, '../../img/2021-09-20_222245.jpg', 60),
(35, '../../img/2021-09-20_222317.jpg', 61),
(36, '../../img/2021-09-20_222410.jpg', 62),
(37, '../../img/2021-09-22_211356.jpg', 63),
(38, '../../img/2021-09-25_215907.jpg', 64),
(39, '../../img/2021-09-25_231103.jpg', 65),
(40, '', 66),
(41, '', 67);

-- --------------------------------------------------------

--
-- Table structure for table `l_position`
--

DROP TABLE IF EXISTS `l_position`;
CREATE TABLE IF NOT EXISTS `l_position` (
  `p_id` int(10) NOT NULL AUTO_INCREMENT,
  `p_name` text COLLATE utf8_unicode_ci NOT NULL,
  `p_des` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_priority` int(1) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1005 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `l_position`
--

INSERT INTO `l_position` (`p_id`, `p_name`, `p_des`, `p_priority`) VALUES
(1001, 'ส่วน', '', 0),
(1002, 'หัวหน้าศูนย์ชัยภูมิ', '', 1),
(1003, 'ช่างศูนย์ชัยภูมิ กองงานที่ 001', 'กองงานที่ 001 ทะเบียนรถ ซซ 1234 กทม. พื้นที่ดูแล ในเมืองทั้งหมด', 2),
(1004, 'ช่างตอนนอก กองงานที่ 1001', 'พื้นที่รับผิดชอบทั่วโลก', 2);

-- --------------------------------------------------------

--
-- Table structure for table `l_province`
--

DROP TABLE IF EXISTS `l_province`;
CREATE TABLE IF NOT EXISTS `l_province` (
  `pv_id` int(10) NOT NULL,
  `pv_name` text COLLATE utf8_unicode_ci NOT NULL,
  `pv_des` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `l_province`
--

INSERT INTO `l_province` (`pv_id`, `pv_name`, `pv_des`) VALUES
(36000, 'ชัยภูมิ', ''),
(40000, 'ขอนแก่น', '');

-- --------------------------------------------------------

--
-- Table structure for table `l_unit_work`
--

DROP TABLE IF EXISTS `l_unit_work`;
CREATE TABLE IF NOT EXISTS `l_unit_work` (
  `uw_id` int(10) NOT NULL AUTO_INCREMENT,
  `l_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  PRIMARY KEY (`uw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `l_users`
--

DROP TABLE IF EXISTS `l_users`;
CREATE TABLE IF NOT EXISTS `l_users` (
  `u_id` int(10) NOT NULL AUTO_INCREMENT,
  `u_fullname` text COLLATE utf8_unicode_ci NOT NULL,
  `u_tel` text COLLATE utf8_unicode_ci NOT NULL,
  `d_id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `pv_id` int(10) NOT NULL,
  `u_code` varchar(13) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสประชาชน',
  `u_password` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `l_users`
--

INSERT INTO `l_users` (`u_id`, `u_fullname`, `u_tel`, `d_id`, `p_id`, `pv_id`, `u_code`, `u_password`) VALUES
(1, 'cv style', '0852114119', 1003, 1001, 36000, 'admin', '21232f29a57a5a73894a0ea801fc3'),
(2, 'แป้ง', '0000000000', 1002, 1003, 36000, 'lisa', 'ed14f4a47ecddb6ae8e5490300b1e'),
(3, 'staff2', '0000000000', 1002, 1003, 36000, 'staff2', '8bc017118163ec32aa068812cdf3b'),
(4, 'staff1', '0000000000', 1002, 1002, 36000, 'staff1', '4d7d719a0cf3d78a8a9470913fe47'),
(5, 'ชาญวิทย์ บุญปลื้ม', '0000000000', 1002, 1003, 36000, 'cv', 'de3ec0aa234aa1eee275bb715c6c9');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
