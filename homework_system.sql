-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018-01-24 14:27:03
-- 服务器版本： 5.7.20
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homework_system`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_info`
--

CREATE TABLE IF NOT EXISTS `admin_info` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_info`
--

INSERT INTO `admin_info` (`id`, `name`, `password`, `created_at`) VALUES
(1, 'admin', '3456789', '2018-01-12 00:31:41');

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `homework`
--

CREATE TABLE IF NOT EXISTS `homework` (
  `id` int(10) NOT NULL,
  `homework_title` varchar(255) NOT NULL,
  `content` text,
  `class` varchar(255) NOT NULL,
  `teacher_number` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `complete_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `homework_attach_file`
--

CREATE TABLE IF NOT EXISTS `homework_attach_file` (
  `id` int(10) NOT NULL,
  `homework_id` int(10) NOT NULL,
  `attach_file` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) NOT NULL,
  `homework_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `submit_time` datetime DEFAULT NULL,
  `desciption` text,
  `score` int(10) DEFAULT NULL,
  `comments` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `product_attach_file`
--

CREATE TABLE IF NOT EXISTS `product_attach_file` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `attach_file` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `student_info`
--

CREATE TABLE IF NOT EXISTS `student_info` (
  `id` int(10) NOT NULL,
  `student_number` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `class` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT '111111',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `student_info`
--

INSERT INTO `student_info` (`id`, `student_number`, `name`, `phone`, `email`, `class`, `password`, `created_at`) VALUES
(1, '14115012044', '郑建鸿', '137234', 'ryan.zheng@easeware.net', '14计算机科学与技术2班', '111111', '2018-01-18 23:49:57'),
(125, '14115012046', '吴彦祖', '13727570356', 'zhengjianhong95@gmail.com', '14计算机科学与技术2班', '111111', '2018-01-14 08:25:03'),
(126, '14115012061', '林颖辉', '13727573116', '960404717@qq.com', '14计算机科学与技术2班', '111111', '2018-01-14 07:56:02');

-- --------------------------------------------------------

--
-- 表的结构 `teacher_info`
--

CREATE TABLE IF NOT EXISTS `teacher_info` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `work_number` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `professional` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL DEFAULT '111111',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacher_info`
--

INSERT INTO `teacher_info` (`id`, `name`, `work_number`, `email`, `phone`, `professional`, `password`, `created_at`) VALUES
(1, '蒋昌金', '1', 'zhengjianhong95@gmail.com', '134514564', '教授', '111111', '2018-01-13 15:12:23'),
(81, '王为群', '1431', '960407@qq.com', '13727573116', '工程师', '111111', '2018-01-13 09:17:31'),
(82, '梁永霖', '1432', '960404718@qq.com', '13727570356', '讲师', '111111', '2018-01-13 09:17:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_product_id` (`product_id`),
  ADD KEY `PK_student_id` (`student_id`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homework_attach_file`
--
ALTER TABLE `homework_attach_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attach_homework_id` (`homework_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homework_id` (`homework_id`,`student_id`),
  ADD KEY `product_student_id` (`student_id`);

--
-- Indexes for table `product_attach_file`
--
ALTER TABLE `product_attach_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PK_product_attaches` (`product_id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `homework_attach_file`
--
ALTER TABLE `homework_attach_file`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT for table `product_attach_file`
--
ALTER TABLE `product_attach_file`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `teacher_info`
--
ALTER TABLE `teacher_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- 限制导出的表
--

--
-- 限制表 `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `PK_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `PK_student_id` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`id`) ON DELETE CASCADE;

--
-- 限制表 `homework_attach_file`
--
ALTER TABLE `homework_attach_file`
  ADD CONSTRAINT `PK_homework_attaches` FOREIGN KEY (`homework_id`) REFERENCES `homework` (`id`) ON DELETE CASCADE;

--
-- 限制表 `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `PK_homeword_id_product` FOREIGN KEY (`homework_id`) REFERENCES `homework` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `PK_student_id_product` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`id`) ON DELETE CASCADE;

--
-- 限制表 `product_attach_file`
--
ALTER TABLE `product_attach_file`
  ADD CONSTRAINT `PK_product_attaches` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
