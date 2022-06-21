-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2022 at 11:32 AM
-- Server version: 10.5.13-MariaDB-cll-lve
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `housekeeperskw_cleanner`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(12) NOT NULL DEFAULT '0',
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  `user_id` varchar(255) NOT NULL DEFAULT '0' COMMENT 'for admin role set 1 always',
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Only for admin access';

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `timestamp`, `fullname`, `username`, `email`, `phone`, `password`, `address`, `user_id`, `status`) VALUES
(1, '2022-01-02 05:00\r\n', 'Abdulla', 'Abdulla', 'admin@gmail.com', '0123654789', '123456', 'Indore,India', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `area_code_list`
--

CREATE TABLE `area_code_list` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `area_name` varchar(255) DEFAULT NULL,
  `area_code` varchar(255) DEFAULT NULL,
  `area_uniqid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area_code_list`
--

INSERT INTO `area_code_list` (`id`, `timestamp`, `area_name`, `area_code`, `area_uniqid`) VALUES
(11, '2022-06-02 15:14:10', 'Bhawarkua, indore', '1', '6298866a13226'),
(12, '2022-06-02 15:14:18', 'vishnupuri, indore', '1', '6298867246326'),
(13, '2022-06-02 15:14:27', 'vijay nagar, indore', '2', '6298867b1d17a');

-- --------------------------------------------------------

--
-- Table structure for table `cleanner`
--

CREATE TABLE `cleanner` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `job_type` varchar(255) DEFAULT NULL,
  `identity_card` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `area_code` varchar(255) DEFAULT NULL,
  `email_token` int(1) NOT NULL DEFAULT 0 COMMENT '0=done,1=send',
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cleanner`
--

INSERT INTO `cleanner` (`id`, `timestamp`, `emp_id`, `fullname`, `email`, `password`, `phone`, `job_type`, `identity_card`, `profile`, `area_code`, `email_token`, `status`) VALUES
(57, '2022-06-02 15:22:07', '62988847a24cb', 'Goldberg', 'srk@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '8319364008', 'cleaner', 'dummy.png', 'dummy.png', '', 0, 1),
(58, '2022-06-02 15:22:45', '6298886d3cc67', 'driver dony bb', 'dony@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '987897654', 'driver', 'dummy.png', 'dummy.png', '1', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `msg` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave`
--

CREATE TABLE `emp_leave` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `leave_date` varchar(255) DEFAULT NULL,
  `shift` varchar(255) DEFAULT NULL,
  `fullday` varchar(255) DEFAULT '0',
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `descp` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `timestamp`, `title`, `descp`) VALUES
(7, '2022-05-24 12:28:05', 'title for test', 'demo data'),
(8, '2022-05-24 12:29:04', 'title for test', 'demo data'),
(9, '2022-05-24 12:30:12', 'title for test', 'demo data'),
(10, '2022-05-24 12:31:06', 'title for test', 'demo data'),
(11, '2022-05-24 12:32:04', 'title for test', 'demo data');

-- --------------------------------------------------------

--
-- Table structure for table `job_avalability`
--

CREATE TABLE `job_avalability` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plan_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_shift` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `book_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `uniqid` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `is_done` int(1) NOT NULL DEFAULT 0 COMMENT '0=job not done,1=job done',
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=inactive,1=active,2=deny a day'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_avalability`
--

INSERT INTO `job_avalability` (`id`, `timestamp`, `job_id`, `plan_type`, `order_id`, `day`, `job_shift`, `book_date`, `user_id`, `emp_id`, `uniqid`, `is_done`, `status`) VALUES
(55, '2022-06-03', '629888965343e', '0', '6299aa75bacdc', 'Monday', '629887e1207ee', '2022-06-06', '629886b22aea1', '62988847a24cb', '6299aa75bb309', 0, 1),
(56, '2022-06-09', '629888a0d8f92', '1', '62a1ec1d43bbe', 'Monday', '629887e1207ee', '2022-06-13', '629886b22aea1', '62988847a24cb', '62a1ec1d443a8', 1, 1),
(57, '2022-06-09', '629888a0d8f92', '1', '62a1ec1d43bbe', 'Monday', '629887e1207ee', '2022-06-20', '629886b22aea1', '62988847a24cb', '62a1ec1d443a8', 1, 1),
(58, '2022-06-09', '629888a0d8f92', '1', '62a1ec1d43bbe', 'Monday', '629887e1207ee', '2022-06-27', '629886b22aea1', '62988847a24cb', '62a1ec1d443a8', 1, 1),
(59, '2022-06-09', '629888a0d8f92', '1', '62a1ec1d43bbe', 'Monday', '629887e1207ee', '2022-07-04', '629886b22aea1', '62988847a24cb', '62a1ec1d443a8', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_scheduler`
--

CREATE TABLE `job_scheduler` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `driver` varchar(255) NOT NULL DEFAULT '0',
  `plan_type` varchar(255) NOT NULL COMMENT '0 = at a time,1=once a week,2=twice a week,3=thrice a week      ',
  `shift` varchar(255) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `day_name` varchar(255) NOT NULL DEFAULT '0',
  `price` varchar(255) NOT NULL COMMENT 'price according to plan and shift',
  `pricing_planid` varchar(255) NOT NULL,
  `area_code` varchar(255) DEFAULT NULL,
  `area_uniq` varchar(255) NOT NULL DEFAULT '0',
  `scheduler_id` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0=inactive,1=available,2=booked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_scheduler`
--

INSERT INTO `job_scheduler` (`id`, `timestamp`, `emp_id`, `driver`, `plan_type`, `shift`, `day`, `day_name`, `price`, `pricing_planid`, `area_code`, `area_uniq`, `scheduler_id`, `status`) VALUES
(33, '2022-06-02 15:23:26', '62988847a24cb', '6298886d3cc67', '0', '629887e1207ee', '629887ec96eee', 'Monday', '100', '6298880bf418c', '1', '6298866a13226', '629888965343e', 1),
(34, '2022-06-02 15:23:36', '62988847a24cb', '6298886d3cc67', '1', '629887e1207ee', '629887ec96eee', 'Monday', '300', '629888125e6ed', '1', '6298866a13226', '629888a0d8f92', 1),
(35, '2022-06-02 15:23:46', '62988847a24cb', '6298886d3cc67', '2', '629887e1207ee', '629887f1e72bd', 'Tuesday,Wednesday', '500', '6298881964111', '1', '6298866a13226', '629888aa92f2d', 1);

-- --------------------------------------------------------

--
-- Table structure for table `note_data`
--

CREATE TABLE `note_data` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `note_by` varchar(255) DEFAULT NULL,
  `availability_id` varchar(255) NOT NULL,
  `note_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `note_data`
--

INSERT INTO `note_data` (`id`, `timestamp`, `emp_id`, `note`, `user_id`, `note_by`, `availability_id`, `note_id`) VALUES
(1, '2022-05-23 15:46:05', '620358648dfe2', 'done', '620757787724f', 'dbsharukh', '6285ddeb4dc99', '628b5ee58a4ce'),
(2, '2022-06-02 15:44:32', '62988847a24cb', 'ok', '629886b22aea1', 'Goldberg', '62988c41c835f', '62988d8811470');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_plan`
--

CREATE TABLE `pricing_plan` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `plan` varchar(255) DEFAULT NULL COMMENT '0 = at a time,1=once a week,2=twice a week,3=thrice a week',
  `shift` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `plan_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricing_plan`
--

INSERT INTO `pricing_plan` (`id`, `timestamp`, `plan`, `shift`, `price`, `plan_id`) VALUES
(19, '2022-06-02 15:21:07', '0', '629887e1207ee', '100', '6298880bf418c'),
(20, '2022-06-02 15:21:14', '1', '629887e1207ee', '300', '629888125e6ed'),
(21, '2022-06-02 15:21:21', '2', '629887e1207ee', '500', '6298881964111'),
(22, '2022-06-02 15:21:30', '3', '629887e1207ee', '800', '6298882213c91');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` int(11) NOT NULL,
  `descp` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rewards_codes`
--

CREATE TABLE `rewards_codes` (
  `id` int(11) NOT NULL,
  `cupon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active,0=expire or used'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reward_price`
--

CREATE TABLE `reward_price` (
  `id` int(11) NOT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reward_price`
--

INSERT INTO `reward_price` (`id`, `discount`) VALUES
(1, '20');

-- --------------------------------------------------------

--
-- Table structure for table `search_history`
--

CREATE TABLE `search_history` (
  `id` int(11) NOT NULL,
  `package` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `search_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `search_history`
--

INSERT INTO `search_history` (`id`, `package`, `shift`, `area`, `start_date`, `search_id`) VALUES
(561, '0', '', '', '2022-06-02', '6298b24755456'),
(562, '0', '', '', '2022-06-05', '6298b24e74fc4'),
(563, '0', '', '', '2022-06-06', '6298b25c706e3'),
(564, '0', '', '6298866a13226', '2022-06-02', '6298b2be552ca'),
(565, '0', '', '6298866a13226', '2022-06-06', '6298b2c78c8e9'),
(566, '0', '', '6298866a13226', '2022-06-06', '6298b3424a1eb'),
(567, '1', '629887e1207ee', '6298866a13226', '2022-06-02', '6298c98c9cbcc'),
(568, '0', '', '6298866a13226', '2022-06-03', '6299aa51ed118'),
(569, '2', '629887e1207ee', '6298866a13226', '2022-06-03', '6299b38447506'),
(570, '2', '629887e1207ee', '6298866a13226', '2022-06-04', '629a83c820048'),
(571, '2', '629887e1207ee', '6298866a13226', '2022-06-05', '629ca6d8e2ee0'),
(572, '0', '', '6298867246326', '2022-06-06', '629df3539ef42'),
(573, '2', '629887e1207ee', '6298866a13226', '2022-06-07', '629e839b08b39'),
(574, '1', '629887e1207ee', '6298866a13226', '2022-06-09', '62a1ebf35af4d'),
(575, '1', '629887e1207ee', '6298866a13226', '2022-06-09', '62a1ec08a8550');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `from_time` varchar(255) DEFAULT NULL,
  `to_time` varchar(255) DEFAULT NULL,
  `hours` varchar(255) NOT NULL,
  `shift_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `timestamp`, `from_time`, `to_time`, `hours`, `shift_id`) VALUES
(10, '2022-06-02 15:20:25', '06:00 AM', '09:00 AM', '3', '629887e1207ee');

-- --------------------------------------------------------

--
-- Table structure for table `single_job_data`
--

CREATE TABLE `single_job_data` (
  `id` int(11) NOT NULL,
  `job_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uniqid` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `area_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '2=book,1=not bok'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_day`
--

CREATE TABLE `subscription_day` (
  `id` int(11) NOT NULL,
  `day` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT '1=once a week,2=twice a week,3=thrice a week',
  `sub_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription_day`
--

INSERT INTO `subscription_day` (`id`, `day`, `type`, `sub_id`) VALUES
(21, 'Monday', '1', '629887ec96eee'),
(22, 'Tuesday,Wednesday', '2', '629887f1e72bd'),
(23, 'Thursday,Friday,Saturday', '3', '629887fb75538');

-- --------------------------------------------------------

--
-- Table structure for table `terms&condition`
--

CREATE TABLE `terms&condition` (
  `id` int(11) NOT NULL,
  `descp` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `package` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `charge_id` varchar(255) NOT NULL DEFAULT '0',
  `msg` varchar(255) NOT NULL DEFAULT '0',
  `main_address` varchar(255) NOT NULL DEFAULT '0',
  `price` varchar(255) NOT NULL DEFAULT '0',
  `job_id` varchar(255) NOT NULL,
  `plan_start` varchar(255) NOT NULL,
  `is_done` int(1) NOT NULL DEFAULT 1,
  `notification_mail` int(1) NOT NULL DEFAULT 0 COMMENT '1=mail send',
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `timestamp`, `package`, `shift`, `area`, `user_id`, `order_id`, `charge_id`, `msg`, `main_address`, `price`, `job_id`, `plan_start`, `is_done`, `notification_mail`, `status`) VALUES
(28, '2022-06-03', '0', '629887e1207ee', '6298866a13226', '629886b22aea1', '6299aa75bacdc', 'chg_LV021420220930Mk6g0306657', 'Captured', 'matagujari,indore', '100', '629888965343e', '2022-06-06', 1, 0, 1),
(29, '2022-06-09', '1', '629887e1207ee', '6298866a13226', '629886b22aea1', '62a1ec1d43bbe', '0', '0', 'Jabriya block 3', '300', '629888a0d8f92', '2022-06-09', 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `timestamp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fulladdress` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `fulladdress2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `addrs_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email_token` int(1) NOT NULL DEFAULT 0 COMMENT '0=done,1=send',
  `ref_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Self',
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `timestamp`, `user_id`, `fullname`, `email`, `password`, `phone`, `address`, `fulladdress`, `fulladdress2`, `addrs_id`, `email_token`, `ref_by`, `status`) VALUES
(29, '2022-06-03 13:24:33', '629886b22aea1', 'Dbsharukh', 'dbsharukh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '7999611964', 'Bhawarkua', 'azad nagar , indore', '0', '6298866a13226', 0, 'Self', 1),
(30, '2022-06-05 01:37:02', '629bbb66886b5', 'Abdullah Albanwan', 'a_banwan@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '97664476', 'vishnupuri', ' Jabriya, block 8, street 12, hssdd', '0', '6298867246326', 0, 'Self', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_addrs`
--

CREATE TABLE `user_addrs` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `chk_uniqid_fromarea` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `chk_name_fromarea` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `chk_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_addrs`
--

INSERT INTO `user_addrs` (`id`, `uid`, `address`, `chk_uniqid_fromarea`, `chk_name_fromarea`, `chk_type`) VALUES
(105, '62984746d619f', 'indore, choitram', '628b865748c06', 'Indore', 'Home'),
(214, '629886b22aea1', 'matagujari,indore', '6298866a13226', 'Bhawarkua', 'Home'),
(215, '629886b22aea1', 'Jabriya block 3', '6298867246326', 'vishnupuri', 'Office'),
(218, '629bbb66886b5', ' Jabriya, block 8, street 12, hssdd', '6298867246326', '6298867246326', 'Home');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area_code_list`
--
ALTER TABLE `area_code_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cleanner`
--
ALTER TABLE `cleanner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_cleanner_emp_id` (`emp_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_leave`
--
ALTER TABLE `emp_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_avalability`
--
ALTER TABLE `job_avalability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_scheduler`
--
ALTER TABLE `job_scheduler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_job_scheduler_cleanner` (`emp_id`);

--
-- Indexes for table `note_data`
--
ALTER TABLE `note_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing_plan`
--
ALTER TABLE `pricing_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards_codes`
--
ALTER TABLE `rewards_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reward_price`
--
ALTER TABLE `reward_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_history`
--
ALTER TABLE `search_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `single_job_data`
--
ALTER TABLE `single_job_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_day`
--
ALTER TABLE `subscription_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms&condition`
--
ALTER TABLE `terms&condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_addrs`
--
ALTER TABLE `user_addrs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `area_code_list`
--
ALTER TABLE `area_code_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cleanner`
--
ALTER TABLE `cleanner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_leave`
--
ALTER TABLE `emp_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `job_avalability`
--
ALTER TABLE `job_avalability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `job_scheduler`
--
ALTER TABLE `job_scheduler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `note_data`
--
ALTER TABLE `note_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pricing_plan`
--
ALTER TABLE `pricing_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rewards_codes`
--
ALTER TABLE `rewards_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reward_price`
--
ALTER TABLE `reward_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `search_history`
--
ALTER TABLE `search_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=576;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `single_job_data`
--
ALTER TABLE `single_job_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47065;

--
-- AUTO_INCREMENT for table `subscription_day`
--
ALTER TABLE `subscription_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `terms&condition`
--
ALTER TABLE `terms&condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_addrs`
--
ALTER TABLE `user_addrs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_scheduler`
--
ALTER TABLE `job_scheduler`
  ADD CONSTRAINT `fk_job_scheduler_cleanner` FOREIGN KEY (`emp_id`) REFERENCES `cleanner` (`emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
