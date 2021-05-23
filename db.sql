-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2021 at 03:18 PM
-- Server version: 5.6.24
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_php_drive`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_code` varchar(100) NOT NULL COMMENT 'รหัสไฟล',
  `file_g_id` varchar(100) NOT NULL COMMENT 'id google ไดรฟ์',
  `file_g_mime_type` varchar(255) NOT NULL,
  `file_date` datetime NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `file_name`, `file_code`, `file_g_id`, `file_g_mime_type`, `file_date`, `member_id`) VALUES
(4, '16_1.jpg', '1b479ca2bd68391e7ae7b79c2809b9b5', '1cq97RK18fUZm9_axChnKbmlkRNW3_q_Y', 'image/jpeg', '2021-05-22 10:28:53', 1),
(3, 'flag_ZTRjZ (1).txt', 'fd1e4be0e77d21cbb434b2ca1b31c808', '1myMznzh4QltgflMMfT4eFEw17KM5dBTD', 'text/plain', '2021-05-18 21:50:07', 4);

-- --------------------------------------------------------

--
-- Table structure for table `file_access`
--

CREATE TABLE `file_access` (
  `file_acc_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL COMMENT 'file id',
  `role_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='การเข้าถึงไฟล์';

--
-- Dumping data for table `file_access`
--

INSERT INTO `file_access` (`file_acc_id`, `file_id`, `role_id`, `member_id`) VALUES
(16, 1, 5, 5),
(15, 1, 3, 4),
(14, 1, 2, 3),
(13, 1, 1, 2),
(17, 2, 1, 1),
(18, 2, 1, 2),
(19, 2, 4, 3),
(20, 2, 5, 5),
(28, 3, 3, 5),
(27, 3, 2, 3),
(26, 3, 1, 2),
(25, 3, 1, 1),
(47, 4, 4, 5),
(46, 4, 3, 4),
(45, 4, 2, 3),
(44, 4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `member_email` varchar(200) NOT NULL,
  `member_name` varchar(200) NOT NULL,
  `member_password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_email`, `member_name`, `member_password`) VALUES
(1, 'test1@test.com', 'Test1', 'test1'),
(2, 'test2@test.com', 'Test2', 'test2'),
(3, 'test3@test.com', 'Test3', 'test3'),
(4, 'test4@test.com', 'Test4', 'test4'),
(5, 'test5@test.com', 'Test5', 'test5');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_edit` int(1) NOT NULL COMMENT '1=มีสิทธิ์แก้',
  `role_download` int(1) NOT NULL COMMENT '1=มีสิทธิ์ดาวน์โหลด',
  `role_delete` int(1) NOT NULL COMMENT '1=มีสิทธิ์ลบ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='กลุ่มผู้ใช้ง่น';

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_edit`, `role_download`, `role_delete`) VALUES
(1, 'Download/Edit/Delete', 1, 1, 1),
(2, 'Download/Edit', 1, 1, 0),
(3, 'Download', 0, 1, 0),
(4, 'Edit/Delete', 1, 0, 1),
(5, 'Delete', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `file_access`
--
ALTER TABLE `file_access`
  ADD PRIMARY KEY (`file_acc_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `file_access`
--
ALTER TABLE `file_access`
  MODIFY `file_acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
