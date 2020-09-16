-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 16, 2020 at 08:20 AM
-- Server version: 5.7.11
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog29`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `b_id` int(5) NOT NULL,
  `b_user` int(5) NOT NULL,
  `b_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `b_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `b_img` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `b_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `b_blog` text COLLATE utf8_unicode_ci NOT NULL,
  `b_accept_by` int(5) DEFAULT NULL,
  `b_accept_date` datetime DEFAULT NULL,
  `b_likes` int(5) NOT NULL DEFAULT '0',
  `b_see` int(5) NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`b_id`, `b_user`, `b_title`, `b_desc`, `b_img`, `b_keywords`, `b_blog`, `b_accept_by`, `b_accept_date`, `b_likes`, `b_see`, `create_at`, `update_at`, `update_by`) VALUES
(1, 1, 'التجربة 1', 'التجربة التجربة التجربة التجربة التجربة ', 'blog.jpg', 'التجربة,التجربة ', 'اقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيد', 1, '2020-09-14 00:00:00', 0, 0, '2020-09-14 00:00:00', NULL, NULL),
(2, 2, 'التجربة 2', 'الاختبار الاختبار الاختبار الاختبار الاختبار ', 'blog-1.jpg', 'الاختبار ,التجربة ', 'اقراء الاختبار الاختبار الاختبار  المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء الاختبار الاختبار الاختبار المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء الاختبار الاختبار الاختبار الاختبار المزيداقراء المزيد', 1, '2020-09-08 00:00:00', 0, 0, '2020-09-01 00:00:00', NULL, NULL),
(3, 2, 'التجربة 3', 'الاختبار الاختبار الاختبار الاختبار الاختبار ', 'blog-44.jpg', 'الاختبار ,التجربة ', 'اقراء الاختبار الاختبار الاختبار  المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء الاختبار الاختبار الاختبار المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء الاختبار الاختبار الاختبار الاختبار المزيداقراء المزيد', 1, '2020-09-08 00:00:00', 0, 0, '2020-09-01 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `blog_id` int(5) NOT NULL,
  `category` int(3) NOT NULL,
  `comment` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`blog_id`, `category`, `comment`) VALUES
(1, 1, NULL),
(1, 5, NULL),
(2, 2, NULL),
(2, 4, NULL),
(2, 5, NULL),
(3, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(3) NOT NULL,
  `cat_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cat_class` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` int(5) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_class`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'أرض السُمر', 'bg-secondary', '2020-09-14 00:00:00', 1, NULL, NULL),
(2, 'الإصدارات', 'bg-warning', '2020-09-14 00:00:00', 1, NULL, NULL),
(3, 'الإنسان', 'bg-success', '2020-09-14 00:00:00', 1, NULL, NULL),
(4, 'المجتمع', 'bg-primary', '2020-09-14 00:00:00', 1, NULL, NULL),
(5, 'المهجر', 'bg-info', '2020-09-14 00:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(10) NOT NULL,
  `com_blog` int(5) NOT NULL,
  `com_aut_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `com_aut_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `com_aut_email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `com_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `com_likes` int(5) NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL,
  `accept_by` int(5) DEFAULT NULL,
  `accept_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `conf_user` int(5) NOT NULL DEFAULT '0',
  `conf_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `conf_val` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`conf_user`, `conf_name`, `conf_val`, `update_at`) VALUES
(0, 'NEW_VISIT', '6', NULL),
(0, 'VISIT', '11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `con_id` int(5) NOT NULL,
  `con_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `con_subject` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `con_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `con_msg` text COLLATE utf8_unicode_ci NOT NULL,
  `con_date` datetime NOT NULL,
  `con_read` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`con_id`, `con_name`, `con_subject`, `con_email`, `con_msg`, `con_date`, `con_read`) VALUES
(1, 'asdasd', 'Testing', 'abd1988bz@gmail.com', 'dfdgfdgfdg', '2020-09-11 17:37:08', 0),
(2, 'asdasd', 'Testing', 'abd1988bz@gmail.com', 'dfdgfdgfdg', '2020-09-11 17:37:11', 0),
(3, 'asdasd', 'Testing', 'abd1988bz@gmail.com', 'dfdgfdgfdg', '2020-09-11 17:37:14', 0),
(4, '15-711862', 'add PDO extension', 'sdapps3@gmail.com', 'sdfdsfsdfsdf', '2020-09-11 17:38:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mail_list`
--

CREATE TABLE `mail_list` (
  `mail_id` int(5) NOT NULL,
  `mail_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mail_active` int(1) NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(5) NOT NULL,
  `staff_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `staff_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `staff_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `staff_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'DR',
  `staff_address` text COLLATE utf8_unicode_ci,
  `staff_img` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user.jpg',
  `staff_active` int(1) NOT NULL DEFAULT '1',
  `staff_about` text COLLATE utf8_unicode_ci,
  `staff_uname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `staff_pass` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` int(5) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_phone`, `staff_email`, `staff_type`, `staff_address`, `staff_img`, `staff_active`, `staff_about`, `staff_uname`, `staff_pass`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'خليل طه', '0123900060', 'admin@org.com', 'admin', 'asd asd', 'logo.png', 1, NULL, 'admin@org.com', '5db074ea7a3d9c0cc12409c2c92cc3625c183f6f88fbc9f0c84bbd439acb4ed1', '2020-06-01 00:00:00', NULL, '2020-06-29 22:14:45', 1),
(2, 'مدير الكيان', '0123900066', 'super@org.com', 'staff', NULL, 'user.jpg', 1, NULL, '0123900066', '5db074ea7a3d9c0cc12409c2c92cc3625c183f6f88fbc9f0c84bbd439acb4ed1', '2020-06-24 10:21:58', NULL, NULL, NULL),
(3, 'gfdgdf', '014777414', 'fff@aa.bb', 'staff', NULL, 'user.jpg', 1, NULL, '014777414', '5db074ea7a3d9c0cc12409c2c92cc3625c183f6f88fbc9f0c84bbd439acb4ed1', '2020-06-25 23:03:05', NULL, NULL, NULL),
(4, 'ryrtrt', '0147852369', 'asiaabdsssa172@gmail.com', 'staff', NULL, 'user.jpg', 1, NULL, '0147852369', '5db074ea7a3d9c0cc12409c2c92cc3625c183f6f88fbc9f0c84bbd439acb4ed1', '2020-06-25 23:04:43', NULL, NULL, NULL),
(5, 'وليام جون', '093456444', 'wilam@asd.com', 'staff', NULL, 'user.jpg', 1, NULL, 'wilam@asd.com', '5db074ea7a3d9c0cc12409c2c92cc3625c183f6f88fbc9f0c84bbd439acb4ed1', '2020-08-16 20:43:13', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `b_user` (`b_user`),
  ADD KEY `b_accept_by` (`b_accept_by`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`blog_id`,`category`),
  ADD KEY `bl_cat_category` (`category`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `create_by` (`create_by`),
  ADD KEY `update_by` (`update_by`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `com_blog` (`com_blog`),
  ADD KEY `accept_by` (`accept_by`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`conf_user`,`conf_name`),
  ADD KEY `conf_user` (`conf_user`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `mail_list`
--
ALTER TABLE `mail_list`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_phone` (`staff_phone`),
  ADD UNIQUE KEY `staff_email` (`staff_email`),
  ADD UNIQUE KEY `staff_uname` (`staff_uname`),
  ADD KEY `create_by` (`create_by`),
  ADD KEY `update_by` (`update_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `b_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `con_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mail_list`
--
ALTER TABLE `mail_list`
  MODIFY `mail_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_accepted` FOREIGN KEY (`b_accept_by`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `blog_owner` FOREIGN KEY (`b_user`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD CONSTRAINT `bl_cat_blog` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`b_id`),
  ADD CONSTRAINT `bl_cat_category` FOREIGN KEY (`category`) REFERENCES `category` (`cat_id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `cat_create` FOREIGN KEY (`create_by`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `cat_update` FOREIGN KEY (`update_by`) REFERENCES `staff` (`staff_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
