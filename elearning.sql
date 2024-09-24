-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 10, 2018 at 02:12 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_details`
--

CREATE TABLE `api_details` (
  `id` int(50) NOT NULL,
  `mailchimp_api_key` varchar(200) DEFAULT NULL,
  `mailchimp_list_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_details`
--

INSERT INTO `api_details` (`id`, `mailchimp_api_key`, `mailchimp_list_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'd1038fdd5fc4be30e900c8a08367bbc8-us17', '3097c6d2ca', '2018-02-17 12:50:42', '2018-07-12 11:41:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(255) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `account_holder_name`, `bank_name`, `branch`, `account_number`, `ifsc_code`, `created_at`, `updated_at`) VALUES
(1, 'Deepak Salunke', 'Bank Of Maharashtra', 'Nashik', '852369852147852', '0258452', '2018-07-31 06:26:52', '2018-07-31 06:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `id` int(11) NOT NULL,
  `template_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `template_subject` text CHARACTER SET utf8 NOT NULL,
  `template_from` varchar(255) CHARACTER SET utf8 NOT NULL,
  `template_from_mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template_html` mediumtext CHARACTER SET utf8 NOT NULL,
  `template_variables` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NA' COMMENT '~ Separated',
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`id`, `template_name`, `template_subject`, `template_from`, `template_from_mail`, `template_html`, `template_variables`, `locale`, `created_at`, `updated_at`) VALUES
(1, 'Student Certificate', 'Student Certificate', 'E-Learning - Student Certificate', 'admin@support.com', '<table style=\"font-family: Arial, Helvetica, sans-serif; font-size: 14px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center; padding: 0px 30px; background-image: url(\'##PROJECT_URL##/images/certificate-merit-top.png\'); background-repeat: no-repeat;\" height=\"60px\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y;\"><img src=\"##PROJECT_URL##/images/emailer-logo.png\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 0px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y;\" height=\"20px\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y; font-size: 30px;\">Certificate of Achievement in<br /> &nbsp;&nbsp;&nbsp;<center><span style=\"border-bottom: 1px solid #000; display: inline-block; width: 300px; margin: 0 auto;\">##PROGRAM_NAME##</span></center>&nbsp;&nbsp;&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 20px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y; font-size: 16px;\"><center style=\"text-align: center; line-height: 30px;\">\r\n<div style=\"display: block;\">for demonstrating mastery of the subtraction table by answering all</div>\r\n<div style=\"display: block; text-align: center; width: 320px; margin: 0 auto;\"><span style=\"display: inline-block;\">Subtraction facts in under</span> <span style=\"border-bottom: 1px solid #000; display: inline-block;\">##TIME##</span> <span style=\"display: inline-block;\">seconds</span></div>\r\n</center></td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y; font-size: 40px;\">Congratulations</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y; font-size: 14px;\"><span style=\"border-bottom: 1px solid #000; padding: 0 10px 5px; font-size: 16px; display: block; text-align: center; width: 200px; margin: 0 auto;\">##USERNAME##</span><span style=\"padding: 10px 10px 0; display: block;\">STUDENT</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y;\" height=\"5px\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y; font-size: 14px;\"><span style=\"border-bottom: 1px solid #000; padding: 0 10px 5px; font-size: 16px; display: block; text-align: center; width: 200px; margin: 0 auto;\">##TEACHER_NAME##</span><span style=\"padding: 10px 10px 0; display: block;\">TEACHER</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y;\" height=\"5px\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y; font-size: 14px;\"><span style=\"border-bottom: 1px solid #000; padding: 0 10px 5px; font-size: 16px; display: block; text-align: center; width: 200px; margin: 0 auto;\">##DATE##</span><span style=\"padding: 10px 10px 0; display: block;\">DATE</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/certificate-merit-footer.png\'); background-repeat: no-repeat;\" height=\"60px\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p></p>', '##USERNAME##~##PROGRAM_NAME##~##PROJECT_NAME##~##PROJECT_URL##~##TIME##~##TEACHER_NAME##~##~##DATE##', 'en', '2018-04-18 18:30:00', '2018-08-03 08:36:26'),
(2, 'Student Certificate', 'Student Certificate', 'E-Learning - Student Certificate', 'admin@support.com', '<table style=\"font-family: Arial, Helvetica, sans-serif; font-size: 14px;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center; padding: 0px 30px; background-image: url(\'##PROJECT_URL##/images/certificate-merit-top.png\'); background-repeat: no-repeat;\" height=\"60px\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y;\"><img src=\"##PROJECT_URL##/images/emailer-logo.png\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 0px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y;\" height=\"20px\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y; font-size: 30px;\">Certificate of Achievement in<br /> &nbsp;&nbsp;&nbsp;<center><span style=\"border-bottom: 1px solid #ccc; display: inline-block; width: 300px; margin: 0 auto;\">##PROGRAM_NAME##</span></center>&nbsp;&nbsp;&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 20px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y; font-size: 16px;\"><center>for demonstrating mastery of the &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subtraction table by answering all <br /> <span style=\"display: inline-block;\">Subtraction facts in under</span> &nbsp;&nbsp;&nbsp;<span style=\"border-bottom: 1px solid #ccc; display: inline-block;\">##TIME##</span> &nbsp;&nbsp;&nbsp;<span>seconds</span></center></td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y;\" height=\"20px\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y; font-size: 40px;\">Congratulations</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 20px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y;\" height=\"10px\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y; font-size: 14px;\">##USERNAME## <br /> STUDENT</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y;\" height=\"10px\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y; font-size: 14px;\">##TEACHER_NAME## <br /> TEACHER</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y;\" height=\"10px\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/cetificate-middal.png\'); background-repeat: repeat-y; font-size: 14px;\">##DATE## <br /> DATE</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center; padding: 10px 30px; background-image: url(\'##PROJECT_URL##/images/certificate-merit-footer.png\'); background-repeat: no-repeat;\" height=\"60px\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', '##USERNAME##~##PROGRAM_NAME##~##PROJECT_NAME##~##PROJECT_URL##~##TIME##~##TEACHER_NAME##~##~##DATE##', 'cn', '2018-04-18 09:00:00', '2018-07-24 08:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `class_enrollment_code` text CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL COMMENT '0-inactive,1-active',
  `is_transfer` enum('no','yes') NOT NULL,
  `transfer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`id`, `class_enrollment_code`, `name`, `slug`, `teacher_id`, `subject_id`, `grade_id`, `program_id`, `start_date`, `end_date`, `status`, `is_transfer`, `transfer_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'OC9cxe37uT0ktJz', 'Math', 'math', 7, 1, 4, 15, NULL, '2018-07-26', '1', 'no', NULL, '2018-06-20 11:12:40', '2018-08-07 00:46:39', NULL),
(2, '1A4Imxij3URaBFp', 'English', 'english', 7, 3, 1, 9, NULL, '2018-08-30', '1', 'no', NULL, '2018-06-20 11:12:40', '2018-08-02 03:48:08', NULL),
(3, 'kovPglmMK8hXxSw', 'Start', 'start', 7, 1, 1, NULL, NULL, '2018-07-25', '1', 'no', NULL, '2018-07-05 04:53:37', '2018-07-31 05:30:57', '2018-07-10 04:08:19'),
(4, 'uy18iS7KEQbgH3l', 'Start New class', 'start-new-class', 7, 1, 1, 1, NULL, '2018-07-10', '1', 'no', NULL, '2018-07-05 04:54:33', '2018-07-31 05:31:04', '2018-07-05 22:48:31'),
(5, 'i0qRz2JtY6UEKHX', 'Webwing', 'webwing', 7, 2, 2, 8, NULL, '2018-07-31', '1', 'no', NULL, '2018-07-22 01:35:34', '2018-08-07 00:46:12', NULL),
(6, 'U54NyiATIvMhWmG', 'Wwt', 'wwt', 7, 1, 1, NULL, NULL, '2018-12-31', '1', 'no', NULL, '2018-07-22 01:57:33', '2018-07-31 05:31:17', '2018-07-22 01:59:49'),
(7, 'UTlD4E9OgVPMbn3', 'Wwt', 'wwt', 7, 1, 1, 8, NULL, '2018-12-31', '1', 'no', NULL, '2018-07-22 02:00:01', '2018-07-31 05:31:24', '2018-07-22 02:01:46'),
(8, 'cxvoPKwFVESutAN', 'Wwt', 'wwt', 7, 1, 6, 7, NULL, '2018-12-31', '1', 'yes', 78, '2018-07-22 02:02:27', '2018-08-07 00:46:12', NULL),
(9, '70ZJ3AqngPEf5Qa', 'Addition Class', 'addition-class', 78, 1, 4, 11, NULL, '2018-08-22', '1', 'no', NULL, '2018-07-30 01:52:33', '2018-08-02 03:48:09', NULL),
(10, 'ER8zyB5DM40cIrw', 'Annual Program', 'annual-program', 78, 2, 2, 8, NULL, '2018-09-29', '1', 'yes', 7, '2018-08-01 00:16:16', '2018-08-02 04:45:23', NULL),
(11, 'r68Vz4EdnHgGQ9m', 'Wwt', 'wwt', 78, 1, 6, 7, NULL, '2018-12-31', '1', 'no', NULL, '2018-08-02 03:45:23', '2018-08-02 03:48:09', NULL),
(12, 'beyPgAVWQf6ENDI', 'PT Class', 'pt-class', 7, 1, 4, 10, NULL, '2018-10-31', '1', 'yes', 78, '2018-08-02 03:57:08', '2018-08-06 07:09:47', NULL),
(13, 'KregBwhJScpaF2O', 'PT Class', 'pt-class', 78, 1, 4, 10, NULL, '2018-10-31', '1', 'yes', 7, '2018-08-02 03:57:55', '2018-08-02 04:52:39', NULL),
(14, 'qzQlPtW6yiVbSv4', 'Annual Program', 'annual-program', 7, 2, 2, 8, NULL, '2018-09-29', '1', 'no', NULL, '2018-08-02 04:45:23', '2018-08-07 00:46:39', NULL),
(15, 'TGrISZw6xsdfpoR', 'PT Class', 'pt-class', 7, 1, 4, 10, NULL, '2018-10-31', '1', 'yes', 78, '2018-08-02 04:52:39', '2018-08-06 07:09:47', NULL),
(16, 'WnNiurXJLsh6Sjz', 'PT Class', 'pt-class', 78, 1, 4, 10, NULL, '2018-10-31', '1', 'no', NULL, '2018-08-02 05:19:32', '2018-08-02 05:19:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classroom_student`
--

CREATE TABLE `classroom_student` (
  `id` int(11) NOT NULL,
  `classroom_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `is_active` enum('active','block') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classroom_student`
--

INSERT INTO `classroom_student` (`id`, `classroom_id`, `teacher_id`, `student_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 68, 'active', '2018-07-26 06:23:11', '2018-07-30 07:45:29'),
(2, 1, 7, 69, 'active', '2018-07-24 05:17:46', '2018-07-30 07:45:29'),
(3, 1, 7, 70, 'active', '2018-07-24 05:18:07', '2018-07-30 07:45:29'),
(4, 5, 7, 71, 'active', '2018-07-24 05:19:15', '2018-07-24 05:19:15'),
(5, 8, 7, 72, 'active', '2018-07-24 05:20:00', '2018-07-30 07:40:13'),
(6, 5, 7, 68, 'active', '2018-07-24 05:17:35', '2018-07-25 06:46:10'),
(7, 5, 7, 75, 'active', '2018-07-24 05:17:35', '2018-07-25 09:55:08'),
(8, 1, 7, 75, 'active', '2018-07-24 05:17:35', '2018-07-30 07:45:29'),
(16, 8, 7, 76, 'active', '2018-07-26 23:22:43', '2018-07-30 07:40:13'),
(17, 8, 7, 77, 'active', '2018-07-26 23:40:14', '2018-07-30 07:40:13'),
(43, 1, 78, 68, 'active', '2018-07-30 03:37:32', '2018-07-30 03:37:32'),
(44, 1, 78, 69, 'active', '2018-07-30 03:37:32', '2018-07-30 03:37:32'),
(45, 1, 78, 70, 'active', '2018-07-30 03:37:32', '2018-07-30 03:37:32'),
(46, 1, 78, 75, 'active', '2018-07-30 03:37:32', '2018-07-30 03:37:32'),
(47, 1, 78, 68, 'active', '2018-07-30 03:37:32', '2018-07-30 03:37:32'),
(48, 5, 78, 71, 'active', '2018-07-30 05:52:36', '2018-07-30 05:52:36'),
(49, 5, 78, 68, 'active', '2018-07-30 05:52:36', '2018-07-30 05:52:36'),
(50, 5, 78, 75, 'active', '2018-07-30 05:52:36', '2018-07-30 05:52:36'),
(51, 1, 91, 68, 'active', '2018-07-31 05:09:36', '2018-07-31 05:09:36'),
(52, 1, 91, 69, 'active', '2018-07-31 05:09:36', '2018-07-31 05:09:36'),
(53, 1, 91, 70, 'active', '2018-07-31 05:09:36', '2018-07-31 05:09:36'),
(54, 1, 91, 75, 'active', '2018-07-31 05:09:36', '2018-07-31 05:09:36'),
(55, 1, 92, 68, 'active', '2018-07-31 05:11:33', '2018-07-31 05:11:33'),
(56, 1, 92, 69, 'active', '2018-07-31 05:11:33', '2018-07-31 05:11:33'),
(57, 1, 92, 70, 'active', '2018-07-31 05:11:33', '2018-07-31 05:11:33'),
(58, 1, 92, 75, 'active', '2018-07-31 05:11:33', '2018-07-31 05:11:33'),
(59, 2, 7, 75, 'active', '2018-08-01 05:25:00', '2018-08-01 05:25:00'),
(60, 8, 7, 96, 'active', '2018-08-01 07:44:43', '2018-08-01 07:44:43'),
(61, 8, 78, 72, 'active', '2018-08-02 03:45:23', '2018-08-02 03:45:23'),
(62, 8, 78, 76, 'active', '2018-08-02 03:45:23', '2018-08-02 03:45:23'),
(63, 8, 78, 77, 'active', '2018-08-02 03:45:23', '2018-08-02 03:45:23'),
(64, 8, 78, 96, 'active', '2018-08-02 03:45:23', '2018-08-02 03:45:23'),
(65, 12, 7, 103, 'active', '2018-08-02 04:29:43', '2018-08-02 04:29:43'),
(66, 12, 7, 104, 'active', '2018-08-02 04:30:13', '2018-08-02 04:30:13'),
(67, 10, 78, 105, 'active', '2018-08-02 04:44:01', '2018-08-02 04:44:01'),
(68, 10, 7, 105, 'active', '2018-08-02 04:44:38', '2018-08-02 04:44:38'),
(69, 10, 7, 105, 'active', '2018-08-02 04:45:23', '2018-08-02 04:45:23'),
(71, 13, 7, 106, 'active', '2018-08-02 04:52:39', '2018-08-02 04:52:39'),
(73, 15, 78, 107, 'active', '2018-08-02 05:19:32', '2018-08-02 05:19:32'),
(74, 14, 7, 128, 'active', '2018-08-07 00:55:25', '2018-08-07 00:55:25'),
(75, 1, 112, 68, 'active', '2018-08-07 01:20:19', '2018-08-07 01:20:19'),
(76, 1, 112, 69, 'active', '2018-08-07 01:20:19', '2018-08-07 01:20:19'),
(77, 1, 112, 70, 'active', '2018-08-07 01:20:19', '2018-08-07 01:20:19'),
(78, 1, 112, 75, 'active', '2018-08-07 01:20:19', '2018-08-07 01:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` int(11) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lat` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lon` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `address`, `lat`, `lon`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Nashik, Maharashtra, India', '19.9974533', '73.78980229999999', '1', '2018-07-09 04:55:24', '2018-07-20 07:56:43'),
(6, '625 West Madison Street, Chicago, IL 60661, USA', '41.881975', '-87.643344', '1', '2018-07-19 23:26:56', '2018-07-20 13:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `contact_enquiry`
--

CREATE TABLE `contact_enquiry` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `message` varchar(500) CHARACTER SET utf8 NOT NULL,
  `is_read_status` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_enquiry`
--

INSERT INTO `contact_enquiry` (`id`, `first_name`, `last_name`, `email`, `mobile`, `subject`, `message`, `is_read_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Amol', 'Bhamare', 'aalex4274@gmail.com', '7894561230', NULL, 'How to Login? How to Login? How to Login?How to Login?', '0', '2018-06-15 06:10:35', '2018-07-20 07:26:42', NULL),
(2, 'Deepak', 'Salunke', 'deepaks@webwing.com', '9876543210', 'Contact Us subject', 'contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message', '0', '2018-07-20 01:27:00', '2018-07-20 01:27:00', NULL),
(3, 'Deepak', 'Salunke', 'deepaks@webwing.com', '9876543210', 'Contact Us subject', 'contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message contact us message', '0', '2018-07-20 01:27:37', '2018-07-20 01:27:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 NOT NULL,
  `discount_amount` double(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `coupon_option` int(11) NOT NULL COMMENT 'no of times coupons use',
  `coupen_usage_count` int(11) NOT NULL COMMENT 'this copuen code usage count',
  `status` enum('0','1') NOT NULL COMMENT '0-inactive,1-active',
  `owner` varchar(100) NOT NULL,
  `reward_type_for_referral` enum('validity_extension','reference_amount','both') NOT NULL COMMENT 'for referral user settings ',
  `reward_amount` decimal(10,2) NOT NULL COMMENT 'for referral user settings (%)',
  `validity_extension` varchar(255) NOT NULL COMMENT 'for referral user settings (months)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `created_by`, `coupon_code`, `title`, `discount_amount`, `start_date`, `end_date`, `coupon_option`, `coupen_usage_count`, `status`, `owner`, `reward_type_for_referral`, `reward_amount`, `validity_extension`, `created_at`, `updated_at`) VALUES
(4, 0, 'IM454545', 'Coupon 1', 50.00, '2018-07-06', '2018-07-06', 0, 0, '1', '', 'validity_extension', '0.00', '', '2018-06-18 00:37:48', '2018-08-05 08:55:43'),
(5, 1, 'QJND8ONR5N', 'christmas offer', 10.00, '2018-08-01', '2020-07-26', 500, 0, '1', '', 'validity_extension', '0.00', '', '2018-07-30 03:31:42', '2018-08-02 03:37:11'),
(6, 1, 'T28I88QYV9', 'Summer offer', 5.00, '2018-08-01', '2018-08-10', 30, 13, '1', 'admin', 'validity_extension', '0.00', '', '2018-07-30 03:42:49', '2018-08-10 05:02:50'),
(7, 1, 'TZNZ4U94QQ', 'falcon', 2.50, '2018-08-02', '2018-08-09', 5, 0, '1', 'admin', 'validity_extension', '0.00', '', '2018-07-30 05:03:22', '2018-08-02 03:37:11'),
(8, 1, '8R5MOIN674', 'falcon new', 10.00, '2018-08-01', '2018-08-06', 0, 0, '1', '', 'validity_extension', '0.00', '', '2018-07-30 05:05:10', '2018-08-02 03:37:11'),
(9, 1, '9V3ZX4RAHX', 'Bunglow for rent', 10.00, '2018-08-09', '2018-08-11', 500, 0, '1', 'admin', 'validity_extension', '0.00', '', '2018-07-30 05:06:49', '2018-08-02 03:37:11'),
(10, 100, '1041', '', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Webeing Webwing', 'validity_extension', '0.00', '', '2018-08-02 08:35:36', '2018-08-02 03:35:29'),
(11, 101, '6858', 'Extension of 2 months', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'BlrTesting February', 'validity_extension', '0.00', '', '2018-08-02 08:46:49', '2018-08-02 03:35:29'),
(12, 102, '7483', 'Extension of 2 months andIncentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Jai T', 'validity_extension', '0.00', '', '2018-08-02 08:53:40', '2018-08-02 03:35:29'),
(13, 110, '4283', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Mayuri Pardeshi', 'validity_extension', '0.00', '', '2018-08-03 05:07:38', '2018-08-03 05:07:38'),
(14, 116, '8251', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Parent Learning', 'validity_extension', '0.00', '', '2018-08-03 12:11:26', '2018-08-03 12:11:26'),
(15, 118, '9725', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Sadasd Sadasd', 'validity_extension', '0.00', '', '2018-08-03 12:20:16', '2018-08-03 12:20:16'),
(16, 120, '5997', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Sadsad Sadsad', 'validity_extension', '0.00', '', '2018-08-05 06:15:15', '2018-08-05 06:15:15'),
(17, 121, '8596', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Sadsad NJSDJKF', 'validity_extension', '0.00', '', '2018-08-05 06:24:25', '2018-08-05 06:24:25'),
(18, 122, '1140', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Test Joshi', 'validity_extension', '0.00', '', '2018-08-06 03:58:15', '2018-08-06 03:58:15'),
(19, 123, '5413', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Test Ytes', 'validity_extension', '0.00', '', '2018-08-06 13:19:17', '2018-08-06 13:19:17'),
(20, 124, '6296', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Sadasd Sadasd', 'validity_extension', '0.00', '', '2018-08-06 13:21:49', '2018-08-06 13:21:49'),
(21, 125, '0639', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Aaaa Aaaa', 'validity_extension', '0.00', '', '2018-08-06 13:22:54', '2018-08-06 13:22:54'),
(22, 126, '4799', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Sdfsdf Sdfsdfsdf', 'validity_extension', '0.00', '', '2018-08-06 13:32:45', '2018-08-06 13:32:45'),
(23, 127, '4001', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Sdsad Sadasd', 'validity_extension', '0.00', '', '2018-08-07 04:39:23', '2018-08-07 04:39:23'),
(24, 129, '4258', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Sdd Sddsd', 'both', '25.00', '2', '2018-08-07 09:00:15', '2018-08-07 09:00:15'),
(25, 130, '0245', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Sadsad Sadasd', 'both', '25.00', '2', '2018-08-07 09:20:34', '2018-08-07 09:20:34'),
(26, 131, '8542', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Sdfsdf Sdfsdf', 'both', '25.00', '2', '2018-08-07 09:29:55', '2018-08-07 09:29:55'),
(27, 132, '3230', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Sadasd Sadasd', 'both', '25.00', '2', '2018-08-07 13:18:10', '2018-08-07 13:18:10'),
(28, 133, '1042', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Dsfsdf Sdfsdf', 'both', '25.00', '2', '2018-08-07 13:23:50', '2018-08-07 13:23:50'),
(29, 134, '9698', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Ddd Dddd', 'both', '25.00', '2', '2018-08-08 09:11:27', '2018-08-08 09:11:27'),
(30, 135, '1589', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '0', 'Payment Demo', 'both', '25.00', '2', '2018-08-08 10:09:52', '2018-08-08 10:11:41'),
(31, 136, '7150', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Aaa Aaaa', 'both', '25.00', '2', '2018-08-08 10:57:40', '2018-08-08 10:57:40'),
(32, 138, '8040', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Elearning Demo', 'both', '25.00', '2', '2018-08-08 13:13:17', '2018-08-08 13:13:17'),
(33, 139, '8994', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Sajid Sasad', 'both', '25.00', '2', '2018-08-09 04:08:30', '2018-08-09 04:08:30'),
(34, 140, '8229', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Parent AB', 'both', '25.00', '2', '2018-08-09 06:59:19', '2018-08-09 06:59:19'),
(35, 141, '8360', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Sad Sadasd', 'both', '25.00', '2', '2018-08-09 10:04:56', '2018-08-09 10:04:56'),
(36, 142, '5673', 'Extension of 2 months and Incentive of 25.00%', 0.00, '0000-00-00', '0000-00-00', 0, 0, '1', 'Mayuri P', 'both', '25.00', '2', '2018-08-10 07:31:37', '2018-08-10 07:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usage`
--

CREATE TABLE `coupon_usage` (
  `id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `reward_type_for_referral` enum('','validity_extension','reference_amount','both') NOT NULL COMMENT 'for referral user settings ',
  `reward_amount` decimal(10,2) NOT NULL COMMENT 'for referral user reward amount in CNY',
  `validity_extension` varchar(255) NOT NULL COMMENT 'for referral user settings ',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `per_unit_conversion_rate` decimal(10,2) NOT NULL,
  `conversion_reward_amount` decimal(10,2) NOT NULL,
  `from_currency` int(11) NOT NULL,
  `to_currency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon_usage`
--

INSERT INTO `coupon_usage` (`id`, `coupon_id`, `user_id`, `created_by`, `reward_type_for_referral`, `reward_amount`, `validity_extension`, `created_at`, `updated_at`, `per_unit_conversion_rate`, `conversion_reward_amount`, `from_currency`, `to_currency`) VALUES
(1, 4, 5, 0, '', '0.00', '', '2018-08-09 05:01:00', '0000-00-00 00:00:00', '0.00', '0.00', 0, 0),
(2, 4, 6, 0, '', '0.00', '', '2018-08-09 05:01:03', '0000-00-00 00:00:00', '0.00', '0.00', 0, 0),
(3, 6, 129, 0, 'validity_extension', '25.00', '', '2018-08-07 09:14:43', '0000-00-00 00:00:00', '200.00', '5000.00', 0, 0),
(4, 6, 130, 0, 'validity_extension', '25.00', '', '2018-08-07 09:26:02', '0000-00-00 00:00:00', '200.00', '5000.00', 0, 0),
(5, 25, 131, 130, 'both', '125.00', '2', '2018-08-07 09:37:44', '0000-00-00 00:00:00', '200.00', '25000.00', 2, 1),
(6, 28, 134, 133, 'both', '125.00', '2', '2018-08-08 10:54:31', '0000-00-00 00:00:00', '200.00', '25000.00', 2, 1),
(7, 29, 138, 134, 'both', '25.00', '2', '2018-08-08 13:15:17', '0000-00-00 00:00:00', '0.15', '3.75', 2, 1),
(8, 6, 141, 0, '', '10.00', '', '2018-08-10 09:49:18', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(9, 6, 141, 0, '', '10.00', '', '2018-08-10 10:02:56', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(10, 6, 141, 0, '', '10.00', '', '2018-08-10 10:21:07', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(11, 6, 141, 0, '', '10.00', '', '2018-08-10 10:21:22', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(12, 6, 141, 0, '', '10.00', '', '2018-08-10 10:21:37', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(13, 6, 141, 0, '', '10.00', '', '2018-08-10 10:22:25', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(14, 6, 141, 0, '', '10.00', '', '2018-08-10 10:23:56', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(15, 6, 141, 0, '', '10.00', '', '2018-08-10 10:24:12', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(16, 6, 141, 0, '', '10.00', '', '2018-08-10 10:24:54', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(17, 6, 141, 0, '', '10.00', '', '2018-08-10 10:26:12', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(18, 6, 141, 0, '', '10.00', '', '2018-08-10 10:27:02', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(19, 6, 141, 0, '', '10.00', '', '2018-08-10 10:28:44', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(20, 6, 141, 0, '', '10.00', '', '2018-08-10 10:28:51', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(21, 6, 141, 0, '', '10.00', '', '2018-08-10 10:29:09', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(22, 6, 141, 0, '', '10.00', '', '2018-08-10 10:30:03', '0000-00-00 00:00:00', '0.15', '1.50', 0, 0),
(23, 6, 141, 0, '', '0.00', '', '2018-08-10 05:01:10', '2018-08-10 05:01:10', '0.00', '0.00', 0, 0),
(24, 6, 141, 0, '', '0.00', '', '2018-08-10 05:01:47', '2018-08-10 05:01:47', '0.00', '0.00', 0, 0),
(25, 6, 141, 0, '', '0.00', '', '2018-08-10 05:02:14', '2018-08-10 05:02:14', '0.00', '0.00', 0, 0),
(26, 6, 141, 0, '', '0.00', '', '2018-08-10 05:02:50', '2018-08-10 05:02:50', '0.00', '0.00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `html_code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0-inactive, 1-active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `slug`, `code`, `html_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'US Dollars', 'us-dollars', 'USD', '<i class=\"fa fa-usd\" aria-hidden=\"true\"></i>', '1', '2018-06-15 06:26:10', '2018-07-10 01:01:03'),
(2, 'Renminbi', 'renminbi', 'CNY', '<i class=\"fa fa-jpy\" aria-hidden=\"true\"></i>', '1', '2018-06-15 06:27:00', '2018-07-03 07:08:45'),
(3, 'Indian Rupee', 'indian-rupee', 'INR', '<i class=\"fa fa-inr\" aria-hidden=\"true\"></i>', '1', '2018-06-15 06:27:33', '2018-07-10 04:11:40');

-- --------------------------------------------------------

--
-- Table structure for table `currency_rate`
--

CREATE TABLE `currency_rate` (
  `id` int(11) NOT NULL,
  `from_currency_id` int(11) NOT NULL,
  `from_currency_code` varchar(20) CHARACTER SET utf8 NOT NULL,
  `to_currency_id` int(11) NOT NULL,
  `to_currency_code` varchar(20) CHARACTER SET utf8 NOT NULL,
  `rate` decimal(10,3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_rate`
--

INSERT INTO `currency_rate` (`id`, `from_currency_id`, `from_currency_code`, `to_currency_id`, `to_currency_code`, `rate`, `created_at`, `updated_at`) VALUES
(1, 2, 'CNY', 1, 'USD', '0.150', '2018-08-04 06:23:09', '2018-08-08 06:33:12'),
(2, 2, 'CNY', 2, 'CNY', '345345.000', '2018-08-04 07:33:55', '2018-08-04 07:33:55'),
(3, 3, 'USD', 1, 'INR', '68.740', '2018-08-04 07:34:23', '2018-08-06 10:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `template_from` varchar(255) CHARACTER SET utf8 NOT NULL,
  `template_from_mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `template_variables` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT 'NA' COMMENT '~ Separated',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `template_from`, `template_from_mail`, `template_variables`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##ACTIVATION_URL##~##PROJECT_NAME##~##REFERENCE_CODE##', NULL, '2017-08-21 05:17:22', '2018-08-03 07:08:44'),
(2, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##RESET_LINK##~##PROJECT_NAME##', NULL, NULL, '2018-07-11 07:09:08'),
(3, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##STUDENTPIN##~##PROJECT_NAME##', NULL, NULL, '2018-08-03 07:09:08'),
(4, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##PROJECT_NAME##', NULL, NULL, '2018-07-22 05:51:36'),
(5, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##PROJECT_NAME##~##PROJECT_URL\r\n##', NULL, NULL, '2018-08-04 03:44:04'),
(6, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##PROJECT_NAME##~##PROJECT_URL\r\n##', NULL, NULL, '2018-08-04 03:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `email_template_translation`
--

CREATE TABLE `email_template_translation` (
  `id` int(11) NOT NULL,
  `email_template_id` int(11) NOT NULL,
  `template_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `template_subject` text CHARACTER SET utf8 NOT NULL,
  `template_html` text CHARACTER SET utf8 NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_template_translation`
--

INSERT INTO `email_template_translation` (`id`, `email_template_id`, `template_name`, `template_subject`, `template_html`, `locale`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Registration Email', 'Registration Successful', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Registration Successful</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">\r\n<p>Thank you for your interest in ##PROJECT_NAME##.Please click on below link to verify and activate your account</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=\"listed-btn\">##ACTIVATION_URL##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p></p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, '2017-08-20 22:17:22', '2018-08-03 06:40:28'),
(3, 2, 'Forgot Password', 'Forgot Password', '<table style=\"margin-bottom: 0;\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Reset Password</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">Please use below link to reset your password in ##PROJECT_NAME##!</td>\r\n</tr>\r\n<tr>\r\n<td class=\"listed-btn\"><a target=\"_blank\" href=\"##RESET_LINK##\" rel=\"noopener noreferrer\">Reset Password</a></td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, NULL, '2018-07-04 06:28:03'),
(4, 2, 'Forgot Password', 'Forgot Password', '<table style=\"margin-bottom: 0;\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Reset Password</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">Please use below link to reset your password in ##PROJECT_NAME##!</td>\r\n</tr>\r\n<tr>\r\n<td class=\"listed-btn\"><a target=\"_blank\" href=\"##RESET_LINK##\" rel=\"noopener noreferrer\">Reset Password</a></td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, '2018-07-04 06:11:12', '2018-07-04 06:28:03'),
(5, 3, 'Forgot PIN Email', 'Forgot PIN', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Registration Successful</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">\r\n<p>We have recently received your PIN request.</p>\r\n<p>Below are your PIN for respective kids.</p>\r\n<p>##STUDENTPIN##</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p></p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, NULL, '2018-07-22 05:51:36'),
(6, 3, 'Forgot PIN Email', 'Forgot PIN Email', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Registration Successful</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">Thank you for your interest in ##PROJECT_NAME##! Please click on below link to verify and activate your account</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p>##ACTIVATION_URL##</p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, NULL, '2018-07-22 01:08:41'),
(7, 4, 'Flyer', 'Flyer', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Parent Flyer</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Dear Parent of <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">\r\n	Find the flyer attachment of your child.\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p></p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, NULL, '2018-07-22 05:51:36'),
(8, 4, 'Flyer', 'Flyer', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Parent Flyer</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Dear Parent of <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">\r\n	Find the flyer attachment of your child.\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p></p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, NULL, '2018-07-22 01:08:41'),
(9, 5, 'Elearning Invitation', 'Elearning Invitation', '<table style=\"margin-bottom: 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">##PROJECT_NAME## Invitation</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">You are invited on ##PROJECT_NAME##, Please click on below link to register your account</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p>##PROJECT_URL##</p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, NULL, '2018-08-04 01:28:18'),
(10, 5, 'Elearning Invitation', 'Elearning Invitation', '<table style=\"margin-bottom: 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">##PROJECT_NAME## Invitation</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">You are invited on ##PROJECT_NAME## and register as \"Teacher\" to enjoy our service, Please click on below link to register your account</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p>##PROJECT_URL##</p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, NULL, '2018-08-04 01:30:12'),
(11, 1, 'Registration Email', 'Registration Successful', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Registration Successful</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">\r\n<p>Thank you for your interest in ##PROJECT_NAME##.Please click on below link to verify and activate your account</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=\"listed-btn\">##ACTIVATION_URL##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p></p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, '2018-08-02 23:59:58', '2018-08-03 07:08:44'),
(12, 6, 'Wire Transfer Request', 'Wire Transfer Request', '<table style=\"margin-bottom: 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Payment Wire Tranfer Request </td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">Admin,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">You have received Payment Wire Transder Request from ##NAME## parent on ##PROJECT_NAME##.</td>\r\n</tr>\r\n\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, NULL, '2018-08-04 01:30:12'),
(13, 6, 'Wire Transfer Request', 'Wire Transfer Request', '<table style=\"margin-bottom: 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Payment Wire Tranfer Request </td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">Admin,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">You have received Payment Wire Transder Request from ##NAME## parent on ##PROJECT_NAME##.</td>\r\n</tr>\r\n\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, NULL, '2018-08-04 01:30:12');

-- --------------------------------------------------------

--
-- Table structure for table `flyer`
--

CREATE TABLE `flyer` (
  `id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `template_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `template_subject` text CHARACTER SET utf8 NOT NULL,
  `template_from` varchar(255) CHARACTER SET utf8 NOT NULL,
  `template_from_mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template_html` mediumtext CHARACTER SET utf8 NOT NULL,
  `template_variables` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NA' COMMENT '~ Separated',
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `flyer`
--

INSERT INTO `flyer` (`id`, `template_id`, `template_name`, `template_subject`, `template_from`, `template_from_mail`, `template_html`, `template_variables`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'Flyer', 'Enroll Flyer', 'E-Learning - Admin Flyer', 'admin@support.com', '<table style=\"font-family: Arial, Helvetica, sans-serif; font-size: 14px;\" tbody=\"\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center; padding: 20px 0;\"><img src=\"##PROJECT_URL##/images/emailer-logo.png\" alt=\"content-img\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding: 0 60px;\" height=\"2\">\r\n<div class=\"gray-border-section\"></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td>Dear Parent of <span style=\"font-weight: 600;\">##USERNAME##:</span></td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">We are using a program called ##PROJECT_NAME## to increase speed and accuracy in arithmetic. ##USERNAME## is invited to spend a few minutes each day practicing math on a computer, tablet, or phone.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">If you would like kavita to do ##PROJECT_NAME## on a tablet or smartphone, look for ##PROJECT_NAME## in the app store. The app costs $5. On a laptop or desktop computer, he/she can do ##PROJECT_NAME## for free at <a href=\"##PROJECT_URL##\" style=\"color: #0f6bb0; font-weight: 600;\">##PROJECT_NAME##.org.</a></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td style=\"padding: 15px 0;\" width=\"20%\"><img style=\"margin-left: -20px;\" src=\"##PROJECT_URL##/images/emailer-content-img.png\" alt=\"content-img\" /></td>\r\n<td style=\"padding-left: 20px;\" width=\"80%\"><span style=\"color: #0f6bb0; font-weight: 500; display: block;\">Here\'s what you need to do: </span> <span>In the app or on the website, select <span style=\"color: #0f6bb0; font-weight: 500;\">Enroll.</span></span> <span style=\"padding: 15px 0px; display: block;\">Enter your email address and ##USERNAME##\'s enrollment code, <span style=\"color: #0f6bb0; font-weight: 700;\">##CODE##</span></span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">This will (1) create a parent account for you if you don\'t have one, (2) link ##USERNAME##\'s account to your account so you can review his/her progress, and (3) save ##USERNAME##\'s account information for easy sign-in on that computer or device.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">If you already have a parent account for ##USERNAME## from a previous class or personal use, then this enrollment</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">process will allow ##USERNAME## to resume ##PROJECT_NAME## where he/she left off rather than starting over in my classroom.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">For more information about ##PROJECT_NAME## watch the videos on their website, <a href=\"##PROJECT_URL##\" style=\"color: #0f6bb0; font-weight: 600;\"> ##PROJECT_NAME##.org.</a></td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Think of ##PROJECT_NAME## as a math vitamin! For best results, ##USERNAME## should do ##PROJECT_NAME## once per day as regularly as possible. It only takes a few minutes so make it a part of your daily routine. Math facts are the building blocks of your child\'s math education and your child will be well rewarded for the time they spend practicing on ##PROJECT_NAME##.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Thank you!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px; font-weight: 600; color: #0f6bb0;\">##TEACHER_NAME##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p></p>', '##USERNAME##~##CODE##~##PROJECT_NAME##~##PROJECT_URL##~##TEACHER_NAME##', 'en', '2018-04-18 18:30:00', '2018-07-31 00:52:34'),
(2, 1, 'Flyer', 'Enroll Flyer', 'E-Learning - Admin Flyer', 'admin@support.com', '<table style=\"font-family: Arial, Helvetica, sans-serif; font-size: 14px;\" tbody=\"\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center; padding: 20px 0;\"><img src=\"##PROJECT_URL##/images/emailer-logo.png\" alt=\"content-img\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding: 0 60px;\" height=\"2\">\r\n<div class=\"gray-border-section\"></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td>Dear Parent of <span style=\"font-weight: 600;\">##USERNAME##:</span></td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">We are using a program called ##PROJECT_NAME## to increase speed and accuracy in arithmetic. ##USERNAME## is invited to spend a few minutes each day practicing math on a computer, tablet, or phone.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">If you would like kavita to do ##PROJECT_NAME## on a tablet or smartphone, look for ##PROJECT_NAME## in the app store. The app costs $5. On a laptop or desktop computer, he/she can do ##PROJECT_NAME## for free at <a href=\"##PROJECT_URL##\" style=\"color: #0f6bb0; font-weight: 600;\">##PROJECT_NAME##.org.</a></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td style=\"padding: 15px 0;\" width=\"20%\"><img style=\"margin-left: -20px;\" src=\"##PROJECT_URL##/images/emailer-content-img.png\" alt=\"content-img\" /></td>\r\n<td style=\"padding-left: 20px;\" width=\"80%\"><span style=\"color: #0f6bb0; font-weight: 500; display: block;\">Here\'s what you need to do: </span> <span>In the app or on the website, select <span style=\"color: #0f6bb0; font-weight: 500;\">Enroll.</span></span> <span style=\"padding: 15px 0px; display: block;\">Enter your email address and ##USERNAME##\'s enrollment code, <span style=\"color: #0f6bb0; font-weight: 700;\">##CODE##</span></span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">This will (1) create a parent account for you if you don\'t have one, (2) link ##USERNAME##\'s account to your account so you can review his/her progress, and (3) save ##USERNAME##\'s account information for easy sign-in on that computer or device.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">If you already have a parent account for ##USERNAME## from a previous class or personal use, then this enrollment</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">process will allow ##USERNAME## to resume ##PROJECT_NAME## where he/she left off rather than starting over in my classroom.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">For more information about ##PROJECT_NAME## watch the videos on their website, <a href=\"##PROJECT_URL##\" style=\"color: #0f6bb0; font-weight: 600;\"> ##PROJECT_NAME##.org.</a></td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Think of ##PROJECT_NAME## as a math vitamin! For best results, ##USERNAME## should do ##PROJECT_NAME## once per day as regularly as possible. It only takes a few minutes so make it a part of your daily routine. Math facts are the building blocks of your child\'s math education and your child will be well rewarded for the time they spend practicing on ##PROJECT_NAME##.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Thank you!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px; font-weight: 600; color: #0f6bb0;\">##TEACHER_NAME##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p></p>', '##USERNAME##~##CODE##~##PROJECT_NAME##~##PROJECT_URL##~##TEACHER_NAME##', 'cn', '2018-04-18 09:00:00', '2018-07-24 08:33:06'),
(3, 2, 'Flyer', 'Sign In Flyer', 'E-Learning - Admin Flyer', 'admin@support.com', '<table style=\"font-family: Arial, Helvetica, sans-serif; font-size: 14px;\" tbody=\"\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center; padding: 20px 0;\"><img src=\"##PROJECT_URL##/images/emailer-logo.png\" alt=\"content-img\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding: 0 60px;\" height=\"2\">\r\n<div class=\"gray-border-section\"></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td>Dear Parent of <span style=\"font-weight: 600;\">##USERNAME##:</span></td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">We are using a program called ##PROJECT_NAME## to increase speed and accuracy in arithmetic. amita is invited to spend a few minutes each day practicing math on a computer, tablet, or phone. If you would like amita to do ##PROJECT_NAME## on a tablet or smartphone, look for ##PROJECT_NAME## in the app store. The app costs $5. On a laptop or desktop computer, he/she can do ##PROJECT_NAME## for free at <a href=\"##PROJECT_URL##\" style=\"color: #0f6bb0; font-weight: 600;\">##PROJECT_NAME##.org.</a>.</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td style=\"padding: 15px 0;\" width=\"20%\"><img style=\"margin-left: -20px;\" src=\"##PROJECT_URL##/images/emailer-content-img2.png\" alt=\"content-img\" /></td>\r\n<td style=\"padding-left: 20px;\" width=\"80%\"><span>In the app or on the website, select <span style=\"color: #000; font-weight: bold;\">Sign In.</span></span> <span style=\"display: block; padding: 0 0 15px;\">Here is ##USERNAME##\'s sign in information,</span>\r\n<div style=\"display: block; padding: 0 0 5px; font-size: 15px; font-weight: 600;\"><span>Email:</span> <span style=\"color: #0f6bb0;\">##EMAIL##</span></div>\r\n<div style=\"display: block; padding: 0 0 5px; font-size: 15px; font-weight: 600;\"><span style=\"font-weight: 600;\">Name:</span> <span style=\"color: #0f6bb0;\">##USERNAME##</span></div>\r\n<div style=\"display: block; padding: 0 0 5px; font-size: 15px; font-weight: 600;\"><span style=\"font-weight: 600;\">PIN:</span> <span style=\"color: #0f6bb0;\">##PIN## </span></div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">After ##USERNAME## signs in the first time, this information will be remembered so he/she can sign in by simply clicking on his/her name.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Think of ##PROJECT_NAME## as a math vitamin! For best results, ##USERNAME## should do ##PROJECT_NAME## once per day as regularly as possible. It only takes a few minutes so make it a part of your daily routine. Math facts are the building blocks of your child\'s math education and your child will be well rewarded for the time they spend practicing on ##PROJECT_NAME##.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Thank you!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px; font-weight: 600; color: #0f6bb0;\">##TEACHER_NAME##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p></p>', '##USERNAME##~##PIN##~##PROJECT_NAME##~##PROJECT_URL##~##EMAIL##~##TEACHER_NAME##', 'en', '2018-04-18 18:30:00', '2018-08-06 00:25:34'),
(4, 2, 'Flyer', 'Sign In Flyer', 'E-Learning - Admin Flyer', 'admin@support.com', '<table style=\"font-family: Arial, Helvetica, sans-serif; font-size: 14px;\" tbody=\"\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center; padding: 20px 0;\"><img src=\"##PROJECT_URL##/images/emailer-logo.png\" alt=\"content-img\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding: 0 60px;\" height=\"2\">\r\n<div class=\"gray-border-section\"></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td>Dear Parent of <span style=\"font-weight: 600;\">##USERNAME##:</span></td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">We are using a program called ##PROJECT_NAME## to increase speed and accuracy in arithmetic. amita is invited to\r\nspend a few minutes each day practicing math on a computer, tablet, or phone.\r\nIf you would like amita to do ##PROJECT_NAME## on a tablet or smartphone, look for ##PROJECT_NAME## in the app store. The app\r\ncosts $5. On a laptop or desktop computer, he/she can do ##PROJECT_NAME## for free at <a href=\"##PROJECT_URL##\" style=\"color: #0f6bb0; font-weight: 600;\">##PROJECT_NAME##.org.</a>.</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td style=\"padding: 15px 0;\" width=\"20%\"><img style=\"margin-left: -20px;\" src=\"##PROJECT_URL##/images/emailer-content-img.png\" alt=\"content-img\" /></td>\r\n\r\n<td style=\"padding-left: 20px;\" width=\"80%\"> <span>In the app or on the website, select <span style=\"color: #0f6bb0; font-weight: 500;\">Sign In.</span></span> <span style=\"padding: 15px 0px; display: block;\">Here is ##USERNAME##\'s sign in information,<br/> <span style=\"font-weight: 600;\">Email:</span>##EMAIL##<br/><span style=\"font-weight: 600;\">Name:</span>##USERNAME##<br/><span style=\"font-weight: 600;\">PIN:</span>##PIN## </span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">After ##USERNAME## signs in the first time, this information will be remembered so he/she can sign in by simply\r\nclicking on his/her name. </td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Think of ##PROJECT_NAME## as a math vitamin! For best results, ##USERNAME## should do ##PROJECT_NAME## once per day as regularly\r\nas possible. It only takes a few minutes so make it a part of your daily routine. Math facts are the building\r\nblocks of your child\'s math education and your child will be well rewarded for the time they spend practicing\r\non ##PROJECT_NAME##. </td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Thank you!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px; font-weight: 600; color: #0f6bb0;\">##TEACHER_NAME##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p></p>', '##USERNAME##~##PIN##~##PROJECT_NAME##~##PROJECT_URL##~##EMAIL##~##TEACHER_NAME##', 'cn', '2018-04-18 09:00:00', '2018-07-24 08:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `front_pages`
--

CREATE TABLE `front_pages` (
  `id` int(11) NOT NULL,
  `page_slug` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8 NOT NULL DEFAULT '1' COMMENT '0-inactive,1-active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `front_pages`
--

INSERT INTO `front_pages` (`id`, `page_slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'about-us', '1', '2018-06-14 23:57:44', '2018-08-03 08:21:29'),
(2, 'help', '1', '2018-06-16 04:26:00', '2018-08-03 22:41:09'),
(3, 'terms-&-conditions', '1', '2018-06-14 23:59:34', '2018-08-03 22:40:06'),
(4, 'privacy-policy', '1', '2018-06-16 04:27:00', '2018-08-04 03:37:36'),
(5, 'home', '1', '2018-06-16 04:27:00', '2018-08-03 07:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `front_pages_translation`
--

CREATE TABLE `front_pages_translation` (
  `id` int(11) NOT NULL,
  `front_page_id` int(11) NOT NULL,
  `locale` varchar(10) CHARACTER SET utf8 NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `meta_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `front_pages_translation`
--

INSERT INTO `front_pages_translation` (`id`, `front_page_id`, `locale`, `name`, `title`, `meta_title`, `meta_keyword`, `meta_description`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'About us', 'About us', 'Sdfsdf', 'Sdfsdfdsf', 'Sdfsdfsdfsdf', '<div class=\"gray-btn-main-section pircing-main-section\">\r\n<div class=\"container\">\r\n<div class=\"about-us-img-section\"><img src=\"images/about-us-top-img.jpg\" alt=\"about us image\" /></div>\r\n<div class=\"pricing-head-content-section\">\r\n<div class=\"pricing-head-section\">Merit Learning</div>\r\n<div class=\"priceing-content-section\">\r\n<p>Lorem Ipsum <g class=\"gr_ gr_75 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar multiReplace\" id=\"75\" data-gr-id=\"75\">is simply dummy</g> text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the <g class=\"gr_ gr_76 gr-alert gr_gramm gr_inline_cards gr_run_anim Punctuation only-del replaceWithoutSep\" id=\"76\" data-gr-id=\"76\">1500s,</g> when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years Lorem Ipsum <g class=\"gr_ gr_87 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar multiReplace\" id=\"87\" data-gr-id=\"87\">is simply dummy</g> text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen <g class=\"gr_ gr_55 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"55\" data-gr-id=\"55\">bookContrary</g> to popular belief, Lorem Ipsum is not BC, making it over 2000 years old Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"about-us-points\">\r\n<div class=\"container\">\r\n<div class=\"row display-table-section\">\r\n<div class=\"col-sm-4 col-md-4 col-lg-4 display-table-cell-section\">\r\n<div class=\"about-point-img\"><img src=\"images/about-us-online-test-img.png\" alt=\"online test\" /></div>\r\n<div class=\"about-point-head\">Online Test</div>\r\n<div class=\"about-point-description\">Lorem ipsum <g class=\"gr_ gr_62 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling multiReplace\" id=\"62\" data-gr-id=\"62\">dolor</g> <g class=\"gr_ gr_60 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar multiReplace\" id=\"60\" data-gr-id=\"60\">sit</g> <g class=\"gr_ gr_31 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"31\" data-gr-id=\"31\">amet</g>, <g class=\"gr_ gr_33 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"33\" data-gr-id=\"33\">consectetur</g> <g class=\"gr_ gr_34 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"34\" data-gr-id=\"34\">adipiscing</g> elitLorem <g class=\"gr_ gr_30 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"30\" data-gr-id=\"30\">ipsum</g> <g class=\"gr_ gr_63 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling multiReplace\" id=\"63\" data-gr-id=\"63\">dolor</g> sit <g class=\"gr_ gr_32 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"32\" data-gr-id=\"32\">amet</g>, <g class=\"gr_ gr_35 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"35\" data-gr-id=\"35\">consectetur</g> <g class=\"gr_ gr_36 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"36\" data-gr-id=\"36\">adipiscing</g> <g class=\"gr_ gr_37 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"37\" data-gr-id=\"37\">elit</g>...</div>\r\n</div>\r\n<div class=\"col-sm-4 col-md-4 col-lg-4 display-table-cell-section\">\r\n<div class=\"about-point-img\"><img src=\"images/about-us-practice-tutorials-img.png\" alt=\"Practice Tutorials\" /></div>\r\n<div class=\"about-point-head\">Practice Tutorials</div>\r\n<div class=\"about-point-description\">Lorem ipsum <g class=\"gr_ gr_66 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling multiReplace\" id=\"66\" data-gr-id=\"66\">dolor</g> <g class=\"gr_ gr_64 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar multiReplace\" id=\"64\" data-gr-id=\"64\">sit</g> <g class=\"gr_ gr_39 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"39\" data-gr-id=\"39\">amet</g>, <g class=\"gr_ gr_41 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"41\" data-gr-id=\"41\">consectetur</g> <g class=\"gr_ gr_42 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"42\" data-gr-id=\"42\">adipiscing</g> elitLorem <g class=\"gr_ gr_38 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"38\" data-gr-id=\"38\">ipsum</g> <g class=\"gr_ gr_67 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling multiReplace\" id=\"67\" data-gr-id=\"67\">dolor</g> sit <g class=\"gr_ gr_40 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"40\" data-gr-id=\"40\">amet</g>, <g class=\"gr_ gr_43 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"43\" data-gr-id=\"43\">consectetur</g> <g class=\"gr_ gr_44 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"44\" data-gr-id=\"44\">adipiscing</g> <g class=\"gr_ gr_45 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"45\" data-gr-id=\"45\">elit</g>...</div>\r\n</div>\r\n<div class=\"col-sm-4 col-md-4 col-lg-4 display-table-cell-section\">\r\n<div class=\"about-point-img\"><img src=\"images/about-us-ask-question-img.png\" alt=\"Ask a Question\" /></div>\r\n<div class=\"about-point-head\">Ask a Question</div>\r\n<div class=\"about-point-description\">Lorem ipsum <g class=\"gr_ gr_58 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling multiReplace\" id=\"58\" data-gr-id=\"58\">dolor</g> <g class=\"gr_ gr_56 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar multiReplace\" id=\"56\" data-gr-id=\"56\">sit</g> <g class=\"gr_ gr_47 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"47\" data-gr-id=\"47\">amet</g>, <g class=\"gr_ gr_49 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"49\" data-gr-id=\"49\">consectetur</g> <g class=\"gr_ gr_50 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"50\" data-gr-id=\"50\">adipiscing</g> elitLorem <g class=\"gr_ gr_46 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"46\" data-gr-id=\"46\">ipsum</g> <g class=\"gr_ gr_59 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling multiReplace\" id=\"59\" data-gr-id=\"59\">dolor</g> sit <g class=\"gr_ gr_48 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"48\" data-gr-id=\"48\">amet</g>, <g class=\"gr_ gr_51 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"51\" data-gr-id=\"51\">consectetur</g> <g class=\"gr_ gr_52 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"52\" data-gr-id=\"52\">adipiscing</g> <g class=\"gr_ gr_53 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"53\" data-gr-id=\"53\">elit</g>...</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"container\">\r\n<div class=\"about-marit-learning\">\r\n<div class=\"about-us-img-section\"><img src=\"images/about-us-bottom-img.jpg\" alt=\"about us image\" /></div>\r\n<div class=\"pricing-head-content-section\">\r\n<div class=\"pricing-head-section\">About Merit Learning</div>\r\n<div class=\"priceing-content-section\">\r\n<p>Lorem Ipsum <g class=\"gr_ gr_70 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar multiReplace\" id=\"70\" data-gr-id=\"70\">is simply dummy</g> text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the <g class=\"gr_ gr_71 gr-alert gr_gramm gr_inline_cards gr_run_anim Punctuation only-del replaceWithoutSep\" id=\"71\" data-gr-id=\"71\">1500s,</g> when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years Lorem Ipsum <g class=\"gr_ gr_81 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar multiReplace\" id=\"81\" data-gr-id=\"81\">is simply dummy</g> text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen <g class=\"gr_ gr_54 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"54\" data-gr-id=\"54\">bookContrary</g> to popular belief, Lorem Ipsum is not BC, making it over 2000 years old Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '2018-06-14 23:57:44', '2018-08-03 08:21:29'),
(2, 1, 'cn', '关于我们', '关于我们', 'Sdfsdf', 'Sdfsdfsdf', 'Sdfsdfsdfsdf', '<p><img src=\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxISEhIQEBAQFRAQEBAQFRAPDw8PDxUQFhUWFhUVFhUYHSggGBolHRUVITEhJSkrLi4uFx8zODMsNygtLisBCgoKDg0OFhAQFysdHR0tKy0rKystLS0rKy0rKystLSsrLS0tLTctLS0rKy0rKy0rLSstLSstKysrNy0rLSsrK//AABEIAOEA4QMBIgACEQEDEQH/xAAbAAABBQEBAAAAAAAAAAAAAAADAQIEBQYAB//EAD0QAAIBAgQDBgMGBAQHAAAAAAECAAMRBBIhMQVBUQYiYXGBoRORwSMyQrHh8DNSctEHFGLxFTRDU3OCsv/EABkBAQEBAQEBAAAAAAAAAAAAAAABAgMEBf/EACMRAQEAAgICAQQDAAAAAAAAAAABAhEDIRIxIgQTMkFRUmH/2gAMAwEAAhEDEQA/AMwNI6BBkimJh02egjrRVEdaEDIiiPCx2SA0RI4rGQHRLRRK3ifFBS03J5QqwLAbwFfGIn3mA95nauLqVddQvW9gBAkDZbnmWNvymfJrxXVTjaDYExn/ABzW+X3lMVvrr0gfhHU3tJ5L4xpBx5B95SPLWSsPxui34rabEWmRWmb89eUIaAFiA1+s1tPFs1xykgA7g8xJF7zD/wCYe977CWmA4s6mz3y8zrG0uLRERCI2jXDgEEGEmmTQIuWOAjrQBFYuWEtG3gDKxpWGMaRADadaEIjYDbRYt4kCKFhUMZTaEkBVimMSOMBymEvAiKTKCExhEaBHEHkLnpAicQxJRe6LudAPGVeC4FUqHNVOp5CXtPD2a57znTbQeA/vLzCYDKuZj3/HUThnyaenj4tsNxLAMtktYLpYb+shjBNa+Uhep0JM9IbCI2ptpzAtcyBieE5tQug2vtOU5HW8TErh7DkPDnFbC3E09fg5uAF7x5Ae8k4Ps4SRmuT7TX3In2mYwfDix0Fz1vJy8MNtRNvh+AhRqLTq+BVRsJzvM7Y8M08/q8LGunLY/lK8YUre2a1tVvfL5eE3WJw410vKrG8PBGdLgga2nTDPbhycXj2z/D8QyWP4djb87TSUXuAQb3EpMNQIfKR9QR1HprJ+CplScv3Ty/tPRK81ixEeBBqYUNNMkYQRhmMATA684RscohC2jHjojQBRY606BEhFMYohQJFKI+0aI4GEKBHXjZwEoesWpXCLfmTlA8TEAkTEVFzoG5H3mM703hO17wnClu8w0Gnmec0dPDZhbl1/e8iYOmAFUbWlthxz9hPncmVtfV4sZMTqHD1A2BPjDf5EHf5WElUKRPKShSI5TUnTOWWqoWwVj3R3m08hJlHBhB4yzWkCY2pRMvinkrKyytxCS6q05Aq05zsdZWcxKyn+Pkex1VhYiaLG0rTL477/AKzfH7Y5NWG4nD2YHTuG4INu6f3eAwT3LXN+VwLEEEj6QuJrDIdPw3HpuIHBVhn5ajX+rY/Pee7GvnZTtNAjobEAX05gGDyzo5UwwbCHKxrJIAzrx5SNtKht4hj8sawgNnRJ0AIjg0ZliSAscINYVRAdaLFAnEShQZTY0/br0Fhb6y6USgxlS9Ym22kxk3g9KwDXCkbaS9w66abTKdmK+anrymrwzaameDLHVfTwy3jFrhTa0NUMiUHkk+E6Y3pyynZo3jajTrxtQSkR64lfUA/Zk6osg1x4bTnXWKziJAGkx2L1Y+BM1PEATMtiW3lw9pn6VWNrWXxvBYOoQVPO4MTiA0v0gsLU+6fDnPVL08WU7bKtSOVW6nTyOog1WE4fiVajkJAYEEKdCbdJ06RxynYRWdlj7xQJWQSkGyyWRAuIACINoVhA1FlDZ0badAEpnNEXSEUXkDRCKYuSJlgEBizkWOKyjhM/j6dqrfveaFRBcX4WCq1kJOoVxax3HtOeeUjtxYXLekvsW5u3TSbvCdZjeyGFKUzcfimgrY8qCFBuNPWeTPVr2cfUaSg40uYR64HOecY/G1je1QBtTlRWc2AudvCU9DjmJ0b4mZDYggEXB2M1qyEuNutvWBiheI+LEz3ZnFtVF33GkTtQWpgspIuCNJnddNRa1uM0lFmYCVlTj1EmwYTzR6VfEMbswW9tL39JbcY7M1cNSDUldqhWmVykMLlrNnLdFv62nTHDblnyePbW18XTIOomX4rYNdToZz4fEImdlBTbUBHta3KNo0Q+oO/4eY8xJrVTe4ratO4PlIK0wpTztaXFajuOnpIQpgNmNwRrrtedI55Q7iNZrq4IUqwFxzHnNLuB5TLGqtQKvW3zmrTYeU3x3bPPjJIARHqYpWIROrylLQLNHPIlV4DmeMcwBeEDQOtOi3nQI7JeFpJaJTaHUSBLTgsfaPQQFSnB1RDZoKoYDUmjw1JamHANszBgdgLgaTOoZoezeVw9NvAj6zlzT47en6a/LX8hdnLhGB3FQj+0sOJYQ1FAFwtxmsd7SNQXJVqIALBgR5ETSYRQbX6TyW3b1ySKCrwelUpBHUgKCO7cE3Gusr6WApIBSRO6MoFxewGgFuU2VfDBtLXHQ7TqeEQDVVA6KAJu52zSTHGXeu1dhECKpAsR4WkLtSc1PXlaWtQX5c/aV/amh9npzymc+3Wf6qeABQCMq+DWuRL1hVIy208CRM9wh/hsGJGuhE22GcGxmts2aZ+rwZqn3ybdL8vSPqYNKa2AGg6W2l7iiLXmc4xVy31mb0a2zVdlzHz2IldWYNcdW9totdyX8DIhuCdNdfznoxvxefKfJB4eh+MRbuq5t85tgJRcMw4JC21zXJ59ZovhzrxuX1N7kCIg2hnEj1DOrzB1GkGtJLwFSnAikxQ0J8KMKQhc0WJadAVFkmnBqkOiQpLTo8iMhSC8cyx6kRrmRDQsm8MrmnUDenzkNDDiTKbmmscvGyrjiFKzpUzXDrY+BH+5l7gq1gNZlmxt0yMNRsw+sseH4u6A+E8GeNxfTw5Jk1qVhl1kGvjEvkzDNKPi/EmVQia1HIVR4n6SXwjAJSU5mz1W1eoevQdBLvbVkxWF9o/jCBkAt+HLtM9jMdiadUEGk1Ibd1g/le8g8a7YVFpt9k2bkRqLy6Tc2EaSKHUkZlN9T8pN4N2gYqFddja4nnSY9qjZ3z3JJtyv4zRcMxBQA9Zrw6YnLLW9q40MvvMvxvGcryetZXQFTy5Sl4hhjYMfO8567b85rpUqLnnprpD4bhzVC7K+XJbcXDZusjVGsw15S74a9qbkczb0G09XHOni5MtdwTh2DFPUm7HnsB4CTiZAp1LyShnaTTz5W27pHF4JqUmKsRllRANKN+FJbLG2gQ2oyLVpyzqCQ6wgRMkSFnQgiiEUxAI4CRXGMYQoiEQAiLaECzgsoRUh6aRUEMsBmSJw+rluvJT7c4VpGqnIb8mOp6G31nLlx8o68WXjU6upzpVtfKGHkSBYx+G4gwBLpUy5txY+286jiRlIGx8NPSTsDTU0yLa3vPJ6fQxu6AnEKbc2t0Kx1evhypGUnwIBjjZCcyggc8t4jcUpDX4aA/0gGallbsxjMYqiL3p0DblcSDUw1drDuoDy+83pNTicW9X7i6HrppC4bA5bMd99estz0lxxqHwTh7ogp1Drqbxnaat9mqqNRaSMZj7G4I7l9JmuK8RzAm8mMtu3DOyTUQcQ4Y77Xl3gx9mB0O0zWHYufAEetpfU8WFCKdncrfo1r2npx96eazctTqQk6iJHprJlMzrpxHURGEUNOJjQCwg2EOYGpGgCoZDrNJNWRaol0gN4sbaLCDgx4iKsdaZacI9VnKI8CENyxVSOtHqJQ3LHrOtFAgIYj0wylW2OkeBCKkgpxUZD8Nj3d1Y7Ef3lxwfFbLmPrG1sIrjKwuD85R4+nUw7Ar3kFiP5gBuPEThycf7ejj5b6bkshF7wGIo0jZioJ8ZV8K4xTdQ2YG1ly3HmdP3tJGJ4nRXW6n9f1nD7dj1Tlmkw1FVbhQJT1uI3JAI+g9ZX8Y7RU2BCuOmhAHzmTxvaZBdUF9eXPb9+s6Y8TGfNr0uuNYqw3Hea9ha95nP82XJUc9JHd6lU3Nxe3y8pMpUAgnTqOHeVWGDpBV/d5A7QYrL8EA6ioX9v1lpQFxMjxrFfEqmx7qdweNtz6y4btbupi0PCu0TJX+E7ZqT2IvuhO4v0m5RtrbWnjGFvnzdJ6Z2U4mKiimx7y7X5id9vK0aCFyxKcPeE2jPI1QyXWIkKoYAHMC6wxWLkgRPhzpJyRYQK8URQsItOZU1RDBZypCKJQ1UjskIBFIgDCxSIULEKwGBYamIiJDKkBQsi46jdb9NfTnJhEiYtyqO3RWPtJZuNY3VljMY/g+pakSrEaMvQ7zOcQ4diALMzEDpYb/7TY8AxwxFBX/EhKN5j9LGWmHpI2jrPNMrOnpy499vJG4c3NW9ZMwWCtrlF56Vj8BSsbL7TMPQAJsJrz2z9vtAoULa84vwCxPnfwlhSoX5SLxrGikuVbfEPsOszO7p0mOor+McRyKaSHvMLHwHSZth+/EwpBJJO55nUwmFpXa/Jfznoxx1HLOn0MPYW58/OTsFWamwIOxvB00hLSuD0XgPEhWTo43X6j5S1IM8uo4gpqrFWGxU2M2PB+0l7LXt0+Iv1mpU0vHSC+FJgIYXBBB5jaMZJUQ2pxrLJTLBMIEfLOhbTpBEUQyRix4EiirFiLGVLwJCmOtItBjJqwOAjgkVBDqIDKaQ4SNAlNxjtVQw/dB+JU2yKdB/UYF0Vmd7Tcco0lejfNVZCMq27txzmX4t21xLXVCiX/kGoHmecz9IG5ZySx1JJub+Jja4+4vewmLyV6lFj3agVwOV9jN0tOxnkhxDU2Won3k/ZE9Z4PjBWopWW3eUEge88vNjq7fQw/qjY6sdpTvQJOg35y5xbAm4Eq+JcRWmL/iI0Hj18pmbvpdIXEsUtFbaFyNB9TMjWJY5mNydZLxFQuxZtSecj1BPThhqM5XaG46bywp0MqqvM6k+MHgqOZs52XbxMOxufD3mq8md7cFjVp3hQvOFRIYRMQbWHU+w/Yj6Ne3OR8S93Y/y90fWMJhGk4Zx2pSOjXHNTqD/aarA8epVNCcjdG29DPMVfpDLiyDrLtHrF76jaMeefcP47UT7rnyOomiwHaVXsKqgcsy7X8RLsXc6B/wA9S/7ifOdGw1RCqIxRDIJA9RHZJwi5rQFWkIQLFDi1yQB1O0z/ABftbRp3FL7Rxpp9wevOQaIsFFyQAOZNhKHiXbGjTutIfEbqDZAfPnMXxTjNbEfxHOT+UaL8pXoOXKFXeO7S4itcZ8qn8KDL7yjraa+/O8kKLSOVufCAyjT/ABH0H1jq9SxUc2JPpCMdpBd81ew2UWiLj7iZkuCPD3my/wANcYLVMMzWIJdPI/eHz/OZCn++km4Ph9fOHp2QixVixDX8hyPSZzxlmntntveN4inQVnc3OyqN2aYLFV2cl23Ow5AdBC4+tUdyazEspt4ekh1Gjj4/GNWmkyNVa+g3MkNtGYCnc5yNBoJ0cuTLUTFphVCdN/OKtO/nDMkeqWHnMvKGKWlvWCxFQKpboJIYyr4k98q/zEk/0j9YESntrvufMx/jFCx4pwgYE60KRBtKOJi08UR5RhjcsIlf8QPQ/MTpFv5xYHqqR5e0YojmWAtKteReLY9KK53PkvNj4RmLxS0Uao2yj5noJgeI416zl3O/LkPASKl8U41Vr6MxCckU2Hr1lYWnRDAeohEtAiEUwHMYMkAekcYJmgdQO5PiZBwGru3U/nJSvYMf9JEBwwWQt4n2Esaw/JKOIIdVXWxFzyzHYT1bg+Ep/BXPbMBcjn5ieWdjqXxsWqNqGOYjy8Zse2PEDRuqHugWHn4zGXt6MM9y1WdoaqGs2S21/PxlPeU2GxLtVB3JJvfod5cNoZ0i4Z+RtU3FhLLBUcqiRcJT523/ACkuk1tOmx8JmuPJlujBB6zm9J19JDxFe3OHMuIrchzMrSczseS2Qemp/OENXRnOyj3jOGr3ATuxLfMwgxWMJj6m8Ex9oCFowxdzpHKsATDnGEQ7U4NxAFbz+cWOtOgerrCgRiQglRke29e3w0vp3ntMuJcf4gVPtrfy0l9yTKakdvKRTjvFYRs6Agj1i2jXEBKziCAvGsCev6wyC0BlYWRvIyErWoabsSPeTsY32bSJg6d1pdAXY+h0ljWHtq/8PMEodywucqg+uthCduKIs2UnqRckW6C8TsrXys45sR8ucm8aw2bUjTp1mN9vRcZMYxtDh7Ugrn/qLcHpY6yUq3sOf0lvxGn9ghG1Jh8m0PvaV+EW5v6TcvS6mOKXTS2kWtS6bj9/KOUf7xKjn9ZHlR3xQA03+srq5t3nNh4yRjr/AH0UX2I5X6wdPhgNnqtnbQ/6QPCEVtau9UZEXuX32vLSguVAOYG3jJDKBsABytItV4Q12jBOtD0qXWFIlPpCFYYLaMqc4AGEWlQvHqsbW/kHqR+UB3wl8PadB/AE6B6asIs6dCPPu3/8Y/8AiT8zKensPKdOgEH0iLOnQp84xJ0Bq8/SL+sWdAj4/wDhtB8N/hj/ANvznTpY3x/k0PZ/+I375maTimw/pM6dOf7enL1FLiv+Wq+S/wD0sr8Dt6/2izpZ6Tk/FKXb1gq2x8xOnTTyozfdf+louH/hr/Sv5Tp0JTav0kOtOnQOWTKO06dAI379owzp0Bg5+sHQ3b+ozp0B06dOgf/Z\" alt=\"\" width=\"225\" height=\"225\" /></p>\r\n<p>Lorem存有悲坐阿梅德，consectetur adipiscing ELIT。规划直至无痛苦，规划担心，足球卡通。表现为硬件的用户。整数脂肪酸甲酯。儿童运行ullamcorper vulputate问题的可能性。每个酱DIS针对性的裙子。然而，我的欧盟计划未设置。临床任何宣传宣传。 Quisque commodo mauris预期值，也交流孕妇UT，特力dapibus的生命历程。类由我们的婚姻开始就业的扭曲，每himenaeos。 Pellentesque马蒂斯预期值，也egestas，QUIS eleifend risus elementum事实并非如此。篮球消费需求的悲伤和宣传者。要接收免费聊天EST risus怀孕。但施刑的价格，也不是什么都难看。微波方便规划堵塞。但是，简历tincidunt猫。信用评级机构枕mauris从malesuada tempor volutpat。</p>\r\n<p>在Vulputate玩家可以进行。这两种疾病的笑容汤或酱谷，但丑陋。在坐阿梅德sagittis turpis，符合市场预期，两者都不是。即使是讨厌它，牛肉不是很乐观，时间进程沙拉。 Ligula目前由全国各地的箭头目标。目前或干扰，伟大的化妆。我很高兴的周末质量。但是，它是nisl ultricies，纯杂志和报纸，即，所有最大的。输入材料在时间释放来的元件，即灵猫蚤lectus灵猫molestie。 Donec森佩尔得力士直径，EST ornare ID AC ultricies。 Aenean ullamcorper condimentum奥迪奥，ID blandit它喝，和。 Ullamcorper伤心过大，需要大量的橙色辣椒。</p>\r\n<p></p>', '2018-06-14 23:57:44', '2018-08-03 08:21:29'),
(3, 2, 'en', 'Help', 'Help', 'Help', 'Help', 'Help', '<div class=\"gray-btn-main-section pircing-main-section help-page-main\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"help-section\">\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 mobile-show-section\">\r\n<div class=\"about-us-img-section\"><img src=\"images/help-test-rules-img.jpg\" alt=\"about us image\" /></div>\r\n</div>\r\n<div class=\"col-sm-6 col-md-6 col-lg-6\">\r\n<div class=\"pricing-head-content-section\">\r\n<div class=\"pricing-head-section\">Test Rules</div>\r\n<div class=\"priceing-content-section\">\r\n<div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</div>\r\n<div>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took</div>\r\n<div>Galley of type and scrambled it to make a type specimen bookContrary to popular belief, Lorem Ipsum is not BC, making it over 2000 years old took a galley of type and scrambled it to make a type specimen bookContrary to popular belief, Lorem Ipsum is not BC, making it over 2000 years old....</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 dest-show-section\">\r\n<div class=\"about-us-img-section\"><img src=\"images/help-test-rules-img.jpg\" alt=\"about us image\" /></div>\r\n</div>\r\n<div class=\"clearfix\"></div>\r\n</div>\r\n<div class=\"help-secound-section\">\r\n<div class=\"col-sm-6 col-md-6 col-lg-6\">\r\n<div class=\"about-us-img-section\"><img src=\"images/pricing-img.jpg\" alt=\"about us image\" /></div>\r\n</div>\r\n<div class=\"col-sm-6 col-md-6 col-lg-6\">\r\n<div class=\"pricing-head-content-section\">\r\n<div class=\"pricing-head-section\">Merit Learning</div>\r\n<div class=\"priceing-content-section\">\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen bookContrary to popular belief, Lorem Ipsum is not BC, making it over 2000 years old Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"clearfix\"></div>\r\n</div>\r\n</div>\r\n<div class=\"help-points-section\">\r\n<div class=\"pricing-head-section\">Help</div>\r\n<div class=\"row\">\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"help-point-main\">\r\n<div class=\"help-point-img-section\"><img src=\"images/help-refresh-icon.png\" alt=\"refresh\" /></div>\r\n<div class=\"help-point-content-main\">\r\n<div class=\"help-point-head-section\">Refresh</div>\r\n<div class=\"help-point-content\">Refresh the page in your browser.</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"help-point-main\">\r\n<div class=\"help-point-img-section\"><img src=\"images/help-restart-icon.png\" alt=\"restart\" /></div>\r\n<div class=\"help-point-content-main\">\r\n<div class=\"help-point-head-section\">Restart</div>\r\n<div class=\"help-point-content\">Restart your browser.</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"help-point-main\">\r\n<div class=\"help-point-img-section\"><img src=\"images/help-clear-data-refresh-icon.png\" alt=\"data-refresh\" /></div>\r\n<div class=\"help-point-content-main\">\r\n<div class=\"help-point-head-section\">Clear Data Refresh</div>\r\n<div class=\"help-point-content\">Clear Merit Learning data from your browser.</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"help-point-main\">\r\n<div class=\"help-point-img-section\"><img src=\"images/help-clear-cache-icon.png\" alt=\"clear-cache\" /></div>\r\n<div class=\"help-point-content-main\">\r\n<div class=\"help-point-head-section\">Clear Cache</div>\r\n<div class=\"help-point-content\">Clear your browser\'s cache.</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"help-point-main\">\r\n<div class=\"help-point-img-section\"><img src=\"images/help-different-browser-icon.png\" alt=\"different-browser\" /></div>\r\n<div class=\"help-point-content-main\">\r\n<div class=\"help-point-head-section\">Try Different Browser</div>\r\n<div class=\"help-point-content\">Try a different browser if one is already installed.</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"help-point-main\">\r\n<div class=\"help-point-img-section\"><img src=\"images/help-install-latest-version-icon.png\" alt=\"install-latest-version\" /></div>\r\n<div class=\"help-point-content-main\">\r\n<div class=\"help-point-head-section\">Install Latest Version</div>\r\n<div class=\"help-point-content\">Install or upgrade to the latest version of IE, Safari, Chrome.</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"help-point-main\">\r\n<div class=\"help-point-img-section\"><img src=\"images/help-different-time-icon.png\" alt=\"different-time\" /></div>\r\n<div class=\"help-point-content-main\">\r\n<div class=\"help-point-head-section\">Different Time</div>\r\n<div class=\"help-point-content\">Try at a different time of day.</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"help-point-main\">\r\n<div class=\"help-point-img-section\"><img src=\"images/help-different-PC-icon.png\" alt=\"different-PC\" /></div>\r\n<div class=\"help-point-content-main\">\r\n<div class=\"help-point-head-section\">Try Different PC</div>\r\n<div class=\"help-point-content\">Try on a different computer if one is available.</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"help-point-main\">\r\n<div class=\"help-point-img-section\"><img src=\"images/help-another-location-icon.png\" alt=\"another-location\" /></div>\r\n<div class=\"help-point-content-main\">\r\n<div class=\"help-point-head-section\">Try at another Location</div>\r\n<div class=\"help-point-content\">Try at another location with a different connection to the Internet.</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '2018-06-14 23:57:44', '2018-08-03 22:41:09'),
(4, 2, 'cn', '帮帮我', '帮帮我', '帮帮我', '帮帮我', '帮帮我', '<p>什么是Lorem Ipsum？ Lorem Ipsum只是印刷和排版行业的虚拟文本。 Lorem Ipsum自从16世纪以来一直是业界标准的虚拟文本，当时一台未知的打印机采用了一种类型的厨房，并将其制作成样本书。它不仅存活了五个世纪，而且还实现了电子排版的飞跃，基本保持不变。它在20世纪60年代随着包含Lorem Ipsum段落的Letraset工作表的发布以及最近的包括Aldus PageMaker在内的桌面出版软件（包括Lorem Ipsum的版本）而得到普及。</p>', '2018-06-14 23:57:44', '2018-08-03 22:41:09'),
(5, 3, 'en', 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', '<div class=\"gray-btn-main-section pircing-main-section\"><!-- Terms And Conditions start here-->\r\n<div class=\"container\">\r\n<div class=\"terms-condi-main-block\">\r\n<div class=\"welcome-to-travel\">\r\n<h1>Welcome to travel Portal!</h1>\r\n<p class=\"terms-margin-botto\">These terms and conditions outline the rules and regulations for the use of Accommodation Portal\'s Website. Accommodation Portal is located at:</p>\r\n<p class=\"terms-margin-botto add\">902 Room BIT Building Haidian District, Beijing City, China 100081</p>\r\n<p class=\"terms-margin-botto\">By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Accommodation Portal\'s website if you do not accept all of the terms and conditions stated on this page.</p>\r\n<p class=\"terms-margin-botto\">The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and any or all Agreements: \"Client\", \"You\" and \"You\" By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Accommodation Portal\'s website if you do not accept all of the terms and conditions stated on this page. By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Accommodation Portal\'s website if you do not accept all of the terms and conditions stated on this page. By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Accommodation Portal\'s website if you do not accept all of the terms and conditions stated on this page.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>Cookies</h1>\r\n<p class=\"terms-margin-botto m-b-0\">employ the use of cookies. By using Accommodation Portal\'s website you consent to the use of cookies in accordance with Accommodation Portal\'s privacy policy.</p>\r\n<p class=\"terms-margin-botto\">Most of the modern day interactive web sites use cookies to enable us to retrieve user details for each visit. Cookies are used in some areas of our site to enable the functionality of this area and ease of use for those people visiting. Some of our affiliate / advertising partners may also use cookies</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>License</h1>\r\n<p class=\"terms-margin-botto\">Most of the modern day interactive web sites use cookies to enable us to retrieve user details for each visit. Cookies are used in some areas of our site to enable the functionality of this area and ease of use for those people visiting. Some of our affiliate / advertising partners may also use cookies enable the functionality of this area and ease of use for those people visiting. Some of our affiliate / advertising partners may also use cookies</p>\r\n<p class=\"terms-margin-botto m-b-0\">You must not:</p>\r\n<div class=\"boolet-text-block\">\r\n<div class=\"boolet-text\">\r\n<ul>\r\n<li><span class=\"blue-circle\"><i class=\"fa fa-circle\"></i></span> <span class=\"text-bullet\">Republish material from http://www.example.com</span>\r\n<div class=\"clr\"></div>\r\n</li>\r\n<li><span class=\"blue-circle\"><i class=\"fa fa-circle\"></i></span> <span class=\"text-bullet\">Sell, rent or sub-license material from http://www.example.com</span>\r\n<div class=\"clr\"></div>\r\n</li>\r\n<li><span class=\"blue-circle\"><i class=\"fa fa-circle\"></i></span> <span class=\"text-bullet\">Reproduce, duplicate or copy material from http://www.example.com</span>\r\n<div class=\"clr\"></div>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<p class=\"terms-margin-botto\">Redistribute content from Accommodation Portal (unless content is specifically made for redistribution).</p>\r\n<div class=\"cookies-block\">\r\n<h1>User Comments</h1>\r\n<ul>\r\n<li>This Agreement shall begin on the date hereof.</li>\r\n<li>Certain parts of this website offer the opportunity for users to post and exchange opinions, information, material and data (\'Comments\') in a asof the website. Accommodation Portal does not screen, edit, publish or review Comments prior to their appearance on the website and comments do not reflect the views or opinions of Accommodation Portal, its agents or affiliates. Comments reflect the view and opinion of the person who posts such view or opinion. To the extent permitted by applicable laws Accommodation Portal shall not be responsible or liable for the Comments or for any loss cost, liability, damages or expenses caused and or suffered as a result of any use of and/or posting of and/appearance of the Comments on this website.</li>\r\n<li>Accommodation Portal reserves the right to monitor all Comments and to remove any Comments which it considers in its absolute discretion to be inappropriate, offensive or otherwise in breach of these Terms and Conditions.</li>\r\n<li>You warrant and represent that:\r\n<ul>\r\n<li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>\r\n<li>The Comments do not infringe any intellectual property right, including without limitation copyright, patent or trademark, or other proprietary right of any third party;</li>\r\n<li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material or material which is an invasion of privacy</li>\r\n<li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>\r\n<li>You hereby grant to Accommodation Portal a non-exclusive royalty-free license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>Reservation of Rights</h1>\r\n<p class=\"terms-margin-botto\">We reserve the right at any time and in its sole discretion to request that you remove all links or any particular link to our Web site. You agree to immediately remove all links to our Web site upon such request. We also reserve the right to amend these terms and conditions and its linking policy at any time. By continuing to link to our Web site, you agree to be bound to and abide by these linking terms and conditions</p>\r\n</div>\r\n</div>\r\n<!-- container end here--> <!-- Terms And Conditions end here--></div>\r\n</div>', '2018-06-14 23:59:34', '2018-08-03 22:40:06'),
(6, 3, 'cn', '条款和条件', '条款和条件', '条款和条件', '条款和条件', '条款和条件', '<p>Lorem存有悲坐阿梅德，consectetur adipiscing ELIT。规划直至无痛苦，规划担心，足球卡通。表现为硬件的用户。整数脂肪酸甲酯。儿童运行ullamcorper vulputate问题的可能性。每个酱DIS针对性的裙子。然而，我的欧盟计划未设置。临床任何宣传宣传。 Quisque commodo mauris预期值，也交流孕妇UT，特力dapibus的生命历程。类由我们的婚姻开始就业的扭曲，每himenaeos。 Pellentesque马蒂斯预期值，也egestas，QUIS eleifend risus elementum事实并非如此。篮球消费需求的悲伤和宣传者。要接收免费聊天EST risus怀孕。但施刑的价格，也不是什么都难看。微波方便规划堵塞。但是，简历tincidunt猫。信用评级机构枕mauris从malesuada tempor volutpat。</p>\r\n<p>在Vulputate玩家可以进行。这两种疾病的笑容汤或酱谷，但丑陋。在坐阿梅德sagittis turpis，符合市场预期，两者都不是。即使是讨厌它，牛肉不是很乐观，时间进程沙拉。 Ligula目前由全国各地的箭头目标。目前或干扰，伟大的化妆。我很高兴的周末质量。但是，它是nisl ultricies，纯杂志和报纸，即，所有最大的。输入材料在时间释放来的元件，即灵猫蚤lectus灵猫molestie。 Donec森佩尔得力士直径，EST ornare ID AC ultricies。 Aenean ullamcorper condimentum奥迪奥，ID blandit它喝，和。 Ullamcorper伤心过大，需要大量的橙色辣椒。</p>', '2018-06-14 23:59:35', '2018-08-03 22:40:06'),
(7, 4, 'en', 'Privacy Policy', 'Privacy Policy', 'ELearning', 'ELearning', 'Sdfsdfsdf', '<p>sdsd</p>', '2018-06-16 04:29:23', '2018-08-04 03:37:36'),
(8, 4, 'cn', '隐私政策', '隐私政策', 'ELearning', 'ELearning', 'ELearning', '<p>sdsd</p>', '2018-06-16 04:29:23', '2018-08-04 03:37:36'),
(9, 5, 'en', 'Home', 'Home', 'ELearning', 'ELearning', 'ELearning is the best learning website for your  child', '<!--banner section start here-->\r\n<div class=\"home-banner-serction\" style=\"background-image: url(\'images/home-banner-img.jpg\');\">\r\n<div class=\"banner-content-section\">\r\n<div class=\"container\">\r\n<div class=\"banner-content-head\">Don\'t Study Hard Study Smart</div>\r\n<div class=\"banner-content-semi-head\">Learn a new skill online on your time</div>\r\n<div class=\"btn-get-start-section\"><a class=\"get-start-btn sim-button\">Get Started Now</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--banner section end here-->\r\n<p></p>\r\n<!--welcome to section start here-->\r\n<div class=\"learning-app\">\r\n<div class=\"container-fluid\">\r\n<div class=\"welcome-to-section-main\">\r\n<div class=\"col-sm-12 col-md-12 col-lg-6 p-0 swap-right\">\r\n<div class=\"learning-app-section-img\"><img src=\"images/welcome-to-img.jpg\" class=\"img-responsive\" alt=\"learning app\" /></div>\r\n</div>\r\n<div class=\"col-sm-12 col-md-12 col-lg-6 p-0\">\r\n<div class=\"welcome-content-txt\">\r\n<div class=\"welcome-to-head-section\">Welcome To</div>\r\n<div class=\"learning-app-section\">The Merit Learning App</div>\r\n<div class=\"merit-learning-app-contnet\">\r\n<p>The Merit Learning is an exceptional community committed to helping a diverse student body achieve academic, social, and personal excellence through a partnership among children, parents, teacher, and community.</p>\r\n<p>The Merit Learning supports each family\'s expectation to preparing their children for success! Let us help your kids go out into the world!</p>\r\n</div>\r\n<div class=\"btn-get-start-section\"><a class=\"get-start-btn sim-button\">Try out the App on Browser</a></div>\r\n</div>\r\n</div>\r\n<div class=\"clearfix\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--welcome to section end here-->\r\n<p></p>\r\n<!--why choose merit learning section start here-->\r\n<div class=\"why-choose-merit-main\">\r\n<div class=\"container\">\r\n<div class=\"why-choose-metit-head\">Why Choose Merit Learning</div>\r\n<div class=\"why-choose-merit-description\">Help Your Kids Excel in English and Math Complete Pre-K through High School Learning Program</div>\r\n<div class=\"row\">\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img\"></div>\r\n<div class=\"why-choose-plan-name\">The USA Plan</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img englis-login-img\"></div>\r\n<div class=\"why-choose-plan-name\">English Logic</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img american-phonics-img\"></div>\r\n<div class=\"why-choose-plan-name\">American Phonics</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img diverse-culture\"></div>\r\n<div class=\"why-choose-plan-name\">Diverse Culture</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img eng-maths-img\"></div>\r\n<div class=\"why-choose-plan-name\">English and Maths</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img positive-incentive\"></div>\r\n<div class=\"why-choose-plan-name\">Positive Incentive</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--why choose merit learning section start here-->', '2018-06-16 04:29:23', '2018-07-30 00:45:28'),
(10, 5, 'cn', 'Home Chinese', 'Elearning', 'Elearning', 'Elearning', 'Elearning', '<!--banner section start here-->\r\n<div class=\"home-banner-serction\" style=\"background-image: url(\'images/home-banner-img.jpg\');\">\r\n<div class=\"banner-content-section\">\r\n<div class=\"container\">\r\n<div class=\"banner-content-head\">不要研究硬学习聪明</div>\r\n<div class=\"banner-content-semi-head\">按时在线学习新技能</div>\r\n<div class=\"btn-get-start-section\"><a class=\"get-start-btn sim-button\">现在就开始</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--banner section end here-->\r\n<p></p>\r\n<!--welcome to section start here-->\r\n<div class=\"learning-app\">\r\n<div class=\"container-fluid\">\r\n<div class=\"welcome-to-section-main\">\r\n<div class=\"col-sm-12 col-md-12 col-lg-6 p-0 swap-right\">\r\n<div class=\"learning-app-section-img\"><img src=\"{{ url(\'/\') }}/images/welcome-to-img.jpg\" class=\"img-responsive\" alt=\"learning app\" /></div>\r\n</div>\r\n<div class=\"col-sm-12 col-md-12 col-lg-6 p-0\">\r\n<div class=\"welcome-content-txt\">\r\n<div class=\"welcome-to-head-section\">Welcome To</div>\r\n<div class=\"learning-app-section\">The Merit Learning App</div>\r\n<div class=\"merit-learning-app-contnet\">\r\n<p>The Merit Learning is an exceptional community committed to helping a diverse student body achieve academic, social, and personal excellence through a partnership among children, parents, teacher, and community.</p>\r\n<p>The Merit Learning supports each family\'s expectation to preparing their children for success! Let us help your kids go out into the world!</p>\r\n</div>\r\n<div class=\"btn-get-start-section\"><a class=\"get-start-btn sim-button\">Try out the App on Browser</a></div>\r\n</div>\r\n</div>\r\n<div class=\"clearfix\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--welcome to section end here-->\r\n<p></p>\r\n<!--why choose merit learning section start here-->\r\n<div class=\"why-choose-merit-main\">\r\n<div class=\"container\">\r\n<div class=\"why-choose-metit-head\">Why Choose Merit Learning</div>\r\n<div class=\"why-choose-merit-description\">Help Your Kids Excel in English and Math Complete Pre-K through High School Learning Program</div>\r\n<div class=\"row\">\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img\"></div>\r\n<div class=\"why-choose-plan-name\">The USA Plan</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img englis-login-img\"></div>\r\n<div class=\"why-choose-plan-name\">English Logic</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img american-phonics-img\"></div>\r\n<div class=\"why-choose-plan-name\">American Phonics</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img diverse-culture\"></div>\r\n<div class=\"why-choose-plan-name\">Diverse Culture</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img eng-maths-img\"></div>\r\n<div class=\"why-choose-plan-name\">English and Maths</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img positive-incentive\"></div>\r\n<div class=\"why-choose-plan-name\">Positive Incentive</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--why choose merit learning section start here-->', '2018-06-16 04:29:23', '2018-07-30 00:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '29803cabba57f1a19c601731b4d31f03d95545b7.jpg', '2018-07-11 06:53:16', '2018-07-11 06:53:16'),
(2, '8d678bba324b25b9c2c032010e28dd81faa3a697.jpg', '2018-07-11 06:53:20', '2018-07-11 06:53:20'),
(3, '32c70437bb023f74f27af107ec2f2aea428567b7.jpg', '2018-07-11 06:53:24', '2018-07-11 06:53:24'),
(4, 'dda514aad70b27b799de2c46512c3924b536dbc7.jpg', '2018-07-11 06:53:28', '2018-07-11 06:53:28'),
(5, '1138e657e2874478fa5fa20d44ba8217f675f708.jpg', '2018-07-11 06:53:31', '2018-07-11 06:53:31'),
(6, 'bc3bcc05acfaac2b31c84c2bc87b693808f1d0c6.jpg', '2018-07-11 06:53:35', '2018-07-11 06:53:35'),
(9, '99f66a66946842ed71d64e0ce6f7bbac635f9ee5.jpg', '2018-07-11 08:18:19', '2018-07-11 08:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `global_setting`
--

CREATE TABLE `global_setting` (
  `id` int(11) NOT NULL,
  `child_limit` int(11) DEFAULT NULL,
  `daily_lesson_limit` int(11) DEFAULT NULL,
  `daily_homework_limit` int(11) NOT NULL,
  `daily_textbook_limit` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `global_setting`
--

INSERT INTO `global_setting` (`id`, `child_limit`, `daily_lesson_limit`, `daily_homework_limit`, `daily_textbook_limit`, `created_at`, `updated_at`) VALUES
(1, 5, 3, 2, 5, '2018-07-23 00:26:53', '2018-08-09 10:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `subject`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, '1', '2018-08-02 09:13:05', '2018-08-02 03:43:05', NULL),
(2, 2, '1', '2018-08-02 09:13:05', '2018-08-02 03:43:05', NULL),
(3, 4, '1', '2018-08-02 09:13:05', '2018-08-02 03:43:05', NULL),
(4, 1, '1', '2018-08-02 09:13:05', '2018-08-02 03:43:05', NULL),
(5, 0, '1', '2018-07-20 07:04:51', '2018-07-20 01:34:51', '2018-07-20 01:34:51'),
(6, 1, '1', '2018-08-02 09:13:05', '2018-08-02 03:43:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grade_translation`
--

CREATE TABLE `grade_translation` (
  `id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `locale` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_translation`
--

INSERT INTO `grade_translation` (`id`, `grade_id`, `name`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', 'en', '2018-07-20 09:30:50', '2018-07-20 04:00:50'),
(2, 1, '@', 'cn', '2018-07-20 09:30:50', '2018-07-20 04:00:50'),
(3, 2, 'C', 'en', '2018-06-18 04:30:41', '2018-06-14 23:13:27'),
(4, 2, '涅', 'cn', '2018-07-04 11:37:42', '2018-07-04 06:07:43'),
(5, 3, 'D', 'en', '2018-07-04 07:19:58', '2018-06-16 04:54:02'),
(6, 3, '的', 'cn', '2018-07-04 11:34:38', '2018-07-04 06:04:38'),
(7, 4, 'W', 'en', '2018-07-04 06:15:13', '2018-07-04 06:15:13'),
(8, 4, '利', 'cn', '2018-07-04 06:15:13', '2018-07-04 06:15:13'),
(9, 5, 'english', 'en', '2018-07-17 04:15:59', '2018-07-17 04:15:59'),
(10, 5, 'English', 'cn', '2018-07-17 04:15:59', '2018-07-17 04:15:59'),
(11, 6, 'B', 'en', '2018-07-30 09:10:31', '2018-07-30 03:40:31'),
(12, 6, 'sdfsdf', 'cn', '2018-07-20 03:33:38', '2018-07-20 03:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0-inactive,1-active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`id`, `program_id`, `lesson_id`, `name`, `slug`, `subject_id`, `grade_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 12, 'One', 'one', 1, 1, '1', '2018-07-31 06:06:28', '2018-08-04 06:11:10'),
(3, 6, 12, 'One 1', 'one-1', 1, 1, '1', '2018-07-31 07:20:23', '2018-08-04 06:11:10'),
(4, 6, 12, 'Two 2', 'two-2', 1, 1, '1', '2018-07-31 07:20:23', '2018-08-04 06:11:09'),
(5, 6, 12, 'aaa', 'aaa', 1, 6, '1', '2018-08-03 03:26:50', '2018-08-04 06:11:09'),
(9, 17, 19, 'trees in forest', 'trees-in-forest', 1, 4, '1', '2018-08-04 05:55:27', '2018-08-04 06:11:09'),
(10, 17, 19, 'hydra', 'hydra', 1, 4, '1', '2018-08-04 05:55:27', '2018-08-04 06:11:09'),
(11, 17, 19, 'cars', 'cars', 1, 4, '1', '2018-08-04 05:55:27', '2018-08-04 06:11:09'),
(12, 5, 6, 'Demo', 'demo', 2, 2, '1', '2018-08-04 06:22:02', '2018-08-04 06:22:02'),
(13, 29, 30, 'Math Lesson homework1', 'math-lesson-homework1', 1, 4, '1', '2018-08-09 00:42:34', '2018-08-09 00:42:34'),
(14, 29, 30, 'Math Lesson homework1', 'math-lesson-homework1', 1, 4, '1', '2018-08-09 00:42:50', '2018-08-09 00:42:50'),
(15, 29, 30, 'Math Lesson homework1', 'math-lesson-homework1', 1, 4, '1', '2018-08-09 00:43:31', '2018-08-09 00:43:31'),
(16, 29, 30, 'Math Lesson homework2', 'math-lesson-homework2', 1, 4, '1', '2018-08-09 00:43:31', '2018-08-09 00:43:31'),
(17, 29, 31, 'Math Lesson homework22', 'math-lesson-homework22', 1, 4, '1', '2018-08-09 00:44:13', '2018-08-09 05:49:27'),
(18, 31, 35, 'H1', 'h1', 1, 4, '1', '2018-08-10 03:53:24', '2018-08-10 03:54:06'),
(19, 31, 35, 'H2', 'h2', 1, 4, '1', '2018-08-10 03:53:24', '2018-08-10 03:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `homework_image`
--

CREATE TABLE `homework_image` (
  `id` int(11) NOT NULL,
  `homework_id` int(11) NOT NULL,
  `file` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homework_image`
--

INSERT INTO `homework_image` (`id`, `homework_id`, `file`, `created_at`, `updated_at`) VALUES
(2, 1, '15330369885b6049bcaf1da.jpeg', '2018-07-31 06:06:28', '2018-07-31 06:06:28'),
(3, 1, '15330369885b6049bcb1cf2.jpg', '2018-07-31 06:06:28', '2018-07-31 06:06:28'),
(4, 1, '15330369885b6049bcb83a7.png', '2018-07-31 06:06:28', '2018-07-31 06:06:28'),
(7, 1, '15330382355b604e9b22ae5.mp4', '2018-07-31 06:27:15', '2018-07-31 06:27:15'),
(8, 5, '15332866105b6418d2e37d9.jpeg', '2018-08-03 03:26:50', '2018-08-03 03:26:50'),
(9, 3, '15332933625b643332073b2.jpg', '2018-08-03 05:19:22', '2018-08-03 05:19:22'),
(10, 3, '15332937255b64349dbc5f6.jpg', '2018-08-03 05:25:25', '2018-08-03 05:25:25'),
(11, 3, '15332937355b6434a7b3d1b.jpg', '2018-08-03 05:25:35', '2018-08-03 05:25:35'),
(12, 3, '15332937445b6434b0786b4.jpeg', '2018-08-03 05:25:44', '2018-08-03 05:25:44'),
(20, 9, '15333819275b658d27c5618.jpg', '2018-08-04 05:55:27', '2018-08-04 05:55:27'),
(21, 10, '15333819275b658d27ceefc.jpg', '2018-08-04 05:55:27', '2018-08-04 05:55:27'),
(22, 11, '15333819275b658d27e082b.jpg', '2018-08-04 05:55:27', '2018-08-04 05:55:27'),
(23, 11, '15333820225b658d86e0a9a.jpg', '2018-08-04 05:57:02', '2018-08-04 05:57:02'),
(24, 12, '15333835225b6593623e8f8.jpg', '2018-08-04 06:22:02', '2018-08-04 06:22:02'),
(25, 15, '15337952115b6bdb8b4012a.png', '2018-08-09 00:43:31', '2018-08-09 00:43:31'),
(26, 17, '15337952535b6bdbb5dd87b.jpg', '2018-08-09 00:44:13', '2018-08-09 00:44:13'),
(27, 17, '15338064325b6c07603f1da.jpeg', '2018-08-09 03:50:32', '2018-08-09 03:50:32'),
(28, 17, '15338064325b6c07604690f.mp4', '2018-08-09 03:50:32', '2018-08-09 03:50:32'),
(30, 18, '15338930045b6d598c4334d.png', '2018-08-10 03:53:24', '2018-08-10 03:53:24'),
(31, 19, '15338930045b6d598c479f4.mp4', '2018-08-10 03:53:24', '2018-08-10 03:53:24'),
(32, 18, '15338930465b6d59b6910a2.mp4', '2018-08-10 03:54:06', '2018-08-10 03:54:06'),
(33, 19, '15338931455b6d5a191e79e.jpg', '2018-08-10 03:55:45', '2018-08-10 03:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `locale` varchar(10) CHARACTER SET utf8 NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `title`, `locale`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 1, '2018-06-13 13:27:41', '0000-00-00 00:00:00'),
(2, 'Chinese', 'cn', 1, '2018-06-13 13:28:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `program_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`id`, `name`, `program_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'Program 2 : Lesson 1', 5, '2018-07-17 00:43:22', '2018-07-26 14:04:55', NULL),
(8, 'Gfdsgfgfdgdf', 7, '2018-07-17 23:45:46', '2018-07-17 23:45:46', NULL),
(9, 'Math Lesson 1', 8, '2018-07-18 00:22:43', '2018-07-18 00:22:43', NULL),
(10, 'Lesson 2', 9, '2018-07-18 00:40:14', '2018-07-18 00:40:14', NULL),
(11, 'Math Lesson 2', 8, '2018-07-18 04:50:05', '2018-07-18 04:50:05', NULL),
(12, 'Program 2 : Lesson 1', 6, '2018-07-18 23:45:04', '2018-08-09 03:11:47', NULL),
(13, 'Lesson 1', 10, '2018-07-24 07:31:33', '2018-07-24 07:31:33', NULL),
(14, 'Lesson for new program', 11, '2018-07-25 05:26:02', '2018-07-25 05:26:02', NULL),
(15, 'Lesson 1', 13, '2018-07-26 01:14:15', '2018-07-26 01:14:15', NULL),
(16, 'Lesson 1 : 21 - 25', 14, '2018-07-27 01:49:28', '2018-07-27 01:49:28', NULL),
(17, 'Lesson for 26-28', 15, '2018-07-27 06:22:38', '2018-07-27 06:22:38', NULL),
(18, '44 template', 16, '2018-07-28 22:14:16', '2018-07-28 22:14:16', NULL),
(19, 'Lesson for Test program Update', 17, '2018-07-30 00:57:55', '2018-07-30 01:13:11', NULL),
(20, 'Lesson 2 for Test program', 17, '2018-07-30 01:08:56', '2018-07-30 01:08:56', NULL),
(21, 'Sdsds ds', 20, '2018-07-30 02:09:25', '2018-07-30 02:09:25', NULL),
(24, 'Lesson 11', 23, '2018-07-30 09:06:48', '2018-07-30 09:06:48', NULL),
(25, 'L1 test 29-35', 24, '2018-07-30 22:37:00', '2018-07-30 22:37:00', NULL),
(26, 'Lesson for 1 - 5', 25, '2018-07-31 03:09:17', '2018-07-31 03:09:17', NULL),
(27, 'Lesson 36-40', 26, '2018-07-31 05:06:25', '2018-07-31 05:06:25', NULL),
(28, 'Lesson for 41-50', 27, '2018-07-31 05:14:32', '2018-07-31 05:45:31', NULL),
(29, 'Common Lesson', 28, '2018-08-01 23:34:37', '2018-08-01 23:34:37', NULL),
(30, 'Math Lesson', 29, '2018-08-03 01:38:41', '2018-08-03 01:38:41', NULL),
(31, 'English Lesson', 29, '2018-08-03 01:40:32', '2018-08-03 01:40:32', NULL),
(32, 'Science Lesson', 29, '2018-08-03 01:42:31', '2018-08-03 01:42:31', NULL),
(33, 'L1', 30, '2018-08-07 01:47:33', '2018-08-07 01:47:33', NULL),
(34, 'Set - A', 31, '2018-08-10 03:31:23', '2018-08-10 03:31:23', NULL),
(35, 'Set - B', 31, '2018-08-10 03:41:26', '2018-08-10 03:41:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `slug`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Edit Profile', 'account_setting/edit_profile', '1', '2018-07-18 05:35:16', NULL, NULL),
(2, 'Site Setting', 'account_setting/site_status', '1', '2018-07-18 05:35:16', NULL, NULL),
(3, 'Change Password', 'account_setting/password/change', '1', '2018-07-18 05:35:16', NULL, NULL),
(4, 'Contact Address Manage', 'account_setting/contact_address_manage', '1', '2018-07-18 05:35:16', NULL, NULL),
(5, 'Currency', 'account_setting/currency', '1', '2018-07-18 05:35:16', NULL, NULL),
(6, 'Reference Code', 'account_setting/reference_code', '1', '2018-07-18 05:35:16', NULL, NULL),
(7, 'Front Pages', 'front_pages', '1', '2018-07-18 05:35:16', NULL, NULL),
(8, 'Subject', 'subject', '1', '2018-07-18 05:35:16', NULL, NULL),
(9, 'Email Template', 'email_template', '1', '2018-07-18 05:35:16', NULL, NULL),
(10, 'Grade', 'grade', '1', '2018-07-18 05:35:16', NULL, NULL),
(11, 'Contact Enquiry', 'contact_enquiry', '1', '2018-07-18 05:35:16', NULL, NULL),
(12, 'Newsletter', 'newsletter', '1', '2018-07-18 05:35:16', NULL, NULL),
(13, 'Subscription Plan', 'subscription_plan', '1', '2018-07-18 05:35:16', NULL, NULL),
(14, 'Testimonials', 'testimonials', '1', '2018-07-18 05:35:16', NULL, NULL),
(15, 'Textbook', 'textbook', '1', '2018-07-18 05:35:16', NULL, NULL),
(16, 'Coupons', 'coupons', '1', '2018-07-18 05:35:16', NULL, NULL),
(17, 'Notifications', 'notifications', '1', '2018-07-18 05:35:16', NULL, NULL),
(18, 'Classrooms', 'classrooms', '1', '2018-07-18 05:35:16', NULL, NULL),
(19, 'Flyer', 'flyer', '1', '2018-07-18 05:35:16', NULL, NULL),
(20, 'Users', 'users', '1', '2018-07-18 05:35:16', NULL, NULL),
(21, 'Gallery', 'gallery', '1', '2018-07-18 05:35:16', NULL, NULL),
(22, 'Global Setting', 'global_setting', '1', '2018-07-23 06:40:43', NULL, NULL),
(23, 'Certificate', 'certificate', '1', '2018-07-23 06:40:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 NOT NULL,
  `subject` varchar(250) CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0=>inactive 1=>active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `title`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'Test Newsletter', 'Hunters Jungle Lanuch a new offer..	new page meta keyword', '1', '2018-06-18 11:49:36', '2018-06-18 06:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscriber`
--

CREATE TABLE `newsletter_subscriber` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(80) NOT NULL,
  `is_active` enum('active','block') NOT NULL,
  `subscription_date` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter_subscriber`
--

INSERT INTO `newsletter_subscriber` (`id`, `user_id`, `user_type`, `is_active`, `subscription_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 97, 'enroll', 'active', '2018-08-01 13:44:33', '2018-08-01 13:44:33', '2018-08-01 13:44:33', NULL),
(2, 98, 'enroll', 'active', '2018-08-01 14:04:02', '2018-08-01 14:04:02', '2018-08-01 14:04:02', NULL),
(3, 99, 'enroll', 'active', '2018-08-01 14:10:12', '2018-08-01 14:10:12', '2018-08-01 14:10:12', NULL),
(4, 100, 'parent', 'active', '2018-08-02 08:35:36', '2018-08-02 08:35:36', '2018-08-02 08:35:36', NULL),
(5, 101, 'parent', 'active', '2018-08-02 08:46:49', '2018-08-02 08:46:49', '2018-08-02 08:46:49', NULL),
(6, 102, 'parent', 'active', '2018-08-02 08:53:40', '2018-08-02 08:53:40', '2018-08-02 08:53:40', NULL),
(7, 108, 'teacher', 'active', '2018-08-02 11:34:23', '2018-08-02 11:34:23', '2018-08-02 11:34:23', NULL),
(8, 109, 'teacher', 'active', '2018-08-02 11:39:44', '2018-08-02 11:39:44', '2018-08-02 11:39:44', NULL),
(9, 110, 'parent', 'active', '2018-08-03 05:07:38', '2018-08-03 05:07:38', '2018-08-03 05:07:38', NULL),
(10, 111, 'teacher', 'active', '2018-08-03 05:10:47', '2018-08-03 05:10:47', '2018-08-03 05:10:47', NULL),
(11, 112, 'teacher', 'active', '2018-08-03 11:44:49', '2018-08-03 11:44:49', '2018-08-03 11:44:49', NULL),
(12, 113, 'teacher', 'active', '2018-08-03 11:46:56', '2018-08-03 11:46:56', '2018-08-03 11:46:56', NULL),
(13, 114, 'teacher', 'active', '2018-08-03 11:52:27', '2018-08-03 11:52:27', '2018-08-03 11:52:27', NULL),
(14, 115, 'teacher', 'active', '2018-08-03 11:58:16', '2018-08-03 11:58:16', '2018-08-03 11:58:16', NULL),
(15, 116, 'parent', 'active', '2018-08-03 12:11:26', '2018-08-03 12:11:26', '2018-08-03 12:11:26', NULL),
(16, 117, 'teacher', 'active', '2018-08-03 12:20:08', '2018-08-03 12:20:08', '2018-08-03 12:20:08', NULL),
(17, 118, 'parent', 'active', '2018-08-03 12:20:16', '2018-08-03 12:20:16', '2018-08-03 12:20:16', NULL),
(18, 119, 'teacher', 'active', '2018-08-03 12:22:24', '2018-08-03 12:22:24', '2018-08-03 12:22:24', NULL),
(19, 120, 'parent', 'active', '2018-08-05 06:15:15', '2018-08-05 06:15:15', '2018-08-05 06:15:15', NULL),
(20, 121, 'parent', 'active', '2018-08-05 06:24:25', '2018-08-05 06:24:25', '2018-08-05 06:24:25', NULL),
(21, 122, 'parent', 'active', '2018-08-06 03:58:15', '2018-08-06 03:58:15', '2018-08-06 03:58:15', NULL),
(22, 123, 'parent', 'active', '2018-08-06 13:19:17', '2018-08-06 13:19:17', '2018-08-06 13:19:17', NULL),
(23, 124, 'parent', 'active', '2018-08-06 13:21:49', '2018-08-06 13:21:49', '2018-08-06 13:21:49', NULL),
(24, 125, 'parent', 'active', '2018-08-06 13:22:54', '2018-08-06 13:22:54', '2018-08-06 13:22:54', NULL),
(25, 126, 'parent', 'active', '2018-08-06 13:32:45', '2018-08-06 13:32:45', '2018-08-06 13:32:45', NULL),
(26, 127, 'parent', 'active', '2018-08-07 04:39:23', '2018-08-07 04:39:24', '2018-08-07 04:39:24', NULL),
(27, 129, 'parent', 'active', '2018-08-07 09:00:15', '2018-08-07 09:00:15', '2018-08-07 09:00:15', NULL),
(28, 130, 'parent', 'active', '2018-08-07 09:20:34', '2018-08-07 09:20:34', '2018-08-07 09:20:34', NULL),
(29, 131, 'parent', 'active', '2018-08-07 09:29:55', '2018-08-07 09:29:55', '2018-08-07 09:29:55', NULL),
(30, 132, 'parent', 'active', '2018-08-07 13:18:10', '2018-08-07 13:18:10', '2018-08-07 13:18:10', NULL),
(31, 133, 'parent', 'active', '2018-08-07 13:23:50', '2018-08-07 13:23:50', '2018-08-07 13:23:50', NULL),
(32, 134, 'parent', 'active', '2018-08-08 09:11:27', '2018-08-08 09:11:27', '2018-08-08 09:11:27', NULL),
(33, 135, 'parent', 'active', '2018-08-08 10:09:52', '2018-08-08 10:09:52', '2018-08-08 10:09:52', NULL),
(34, 136, 'parent', 'active', '2018-08-08 10:57:40', '2018-08-08 10:57:40', '2018-08-08 10:57:40', NULL),
(35, 137, 'teacher', 'active', '2018-08-08 13:10:42', '2018-08-08 13:10:42', '2018-08-08 13:10:42', NULL),
(36, 138, 'parent', 'active', '2018-08-08 13:13:17', '2018-08-08 13:13:17', '2018-08-08 13:13:17', NULL),
(37, 139, 'parent', 'active', '2018-08-09 04:08:30', '2018-08-09 04:08:30', '2018-08-09 04:08:30', NULL),
(38, 140, 'parent', 'active', '2018-08-09 06:59:19', '2018-08-09 06:59:19', '2018-08-09 06:59:19', NULL),
(39, 141, 'parent', 'active', '2018-08-09 10:04:56', '2018-08-09 10:04:56', '2018-08-09 10:04:56', NULL),
(40, 142, 'parent', 'active', '2018-08-10 07:31:37', '2018-08-10 07:31:37', '2018-08-10 07:31:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` varchar(255) CHARACTER SET utf8 NOT NULL,
  `url` varchar(500) CHARACTER SET utf8 NOT NULL,
  `is_read` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `from_user_id`, `to_user_id`, `message`, `url`, `is_read`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 'Salunke Deepak has registered as a student.', 'student/details/MQ==', '1', '2018-06-16 18:30:00', '2018-07-02 01:35:59'),
(8, 2, 1, 'Nilesh Vibhute has left the PHP class ', 'student/details/MQ==', '1', '2018-06-18 18:30:00', '2018-06-19 04:30:42'),
(9, 7, 1, 'Teacher Demo has added new student, sad sad', '', '1', '2018-07-10 01:09:42', '2018-07-10 08:39:26'),
(11, 7, 1, 'Teacher Demo has added new student, asdf asd', '', '1', '2018-07-10 01:09:43', '2018-07-10 08:39:26'),
(13, 7, 1, 'Teacher Demo has added new student, asd asd', '', '1', '2018-07-10 01:09:43', '2018-07-10 08:39:26'),
(15, 7, 1, 'Teacher Demo has added new student,  ', '', '1', '2018-07-10 01:09:43', '2018-07-10 08:39:26'),
(17, 7, 1, 'Teacher Demo has deleted a class', '', '1', '2018-07-10 04:08:19', '2018-07-10 08:39:26'),
(19, 15, 1, 'Your password was successfully reset.', '', '1', '2018-07-10 07:23:15', '2018-07-10 08:39:26'),
(20, 15, 1, 'Your password was successfully reset.', '', '1', '2018-07-10 07:24:36', '2018-07-10 08:39:26'),
(21, 1, 15, 'You have successfully updated your password', 'teacher/account-setting/my-profile', '0', '2018-07-10 07:25:58', '2018-07-10 07:25:58'),
(22, 7, 1, 'Teacher Demo has added new student, Students Demos', '', '1', '2018-07-10 08:11:41', '2018-07-10 08:39:26'),
(24, 7, 1, 'Teacher Demo has added new student, Studentss Demoss', '', '1', '2018-07-10 08:11:41', '2018-07-10 08:39:26'),
(26, 7, 1, 'Teacher Demo has added new student, Studentsss Demosss', '', '1', '2018-07-10 08:11:42', '2018-07-10 08:39:26'),
(28, 7, 1, 'Teacher Demo has added new student,  ', '', '1', '2018-07-10 08:11:42', '2018-07-10 08:39:26'),
(30, 7, 1, 'Teacher Demo has added new student, Studentq Demoq', '', '1', '2018-07-10 08:13:59', '2018-07-10 08:39:26'),
(32, 7, 1, 'Teacher Demo has added new student, Studentqq Demoqq', '', '1', '2018-07-10 08:14:00', '2018-07-10 08:39:26'),
(34, 7, 1, 'Teacher Demo has added new student,  ', '', '1', '2018-07-10 08:14:00', '2018-07-10 08:39:26'),
(36, 7, 1, 'Teacher Demo has added new student, Studentww demoww', '', '1', '2018-07-10 08:16:30', '2018-07-10 08:39:26'),
(38, 7, 1, 'Teacher Demo has added new student,  ', '', '1', '2018-07-10 08:16:31', '2018-07-10 08:39:26'),
(40, 1, 15, 'Your password was successfully reset.', '', '0', '2018-07-11 00:11:26', '2018-07-11 00:11:26'),
(41, 1, 15, 'Your password was successfully reset.', '', '0', '2018-07-11 00:13:51', '2018-07-11 00:13:51'),
(42, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 03:06:12', '2018-07-12 03:06:12'),
(43, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 03:06:26', '2018-07-12 03:06:26'),
(44, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 03:06:49', '2018-07-12 03:06:49'),
(48, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:00:41', '2018-07-12 04:00:41'),
(49, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:01:13', '2018-07-12 04:01:13'),
(50, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:01:23', '2018-07-12 04:01:23'),
(51, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:01:29', '2018-07-12 04:01:29'),
(52, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:02:11', '2018-07-12 04:02:11'),
(53, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:03:44', '2018-07-12 04:03:44'),
(54, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:05:02', '2018-07-12 04:05:02'),
(55, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:07:14', '2018-07-12 04:07:14'),
(56, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:09:57', '2018-07-12 04:09:57'),
(57, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:11:06', '2018-07-12 04:11:06'),
(58, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:11:27', '2018-07-12 04:11:27'),
(59, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:13:40', '2018-07-12 04:13:40'),
(60, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-12 04:15:18', '2018-07-12 04:15:18'),
(62, 1, 16, 'You have successfully updated your password', 'parent/account-setting/my-profile', '0', '2018-07-12 04:23:52', '2018-07-12 04:23:52'),
(63, 1, 16, 'You have successfully updated your password', 'parent/account-setting/my-profile', '0', '2018-07-12 04:26:54', '2018-07-12 04:26:54'),
(64, 16, 1, 'Parent Demo has added new child', '', '1', '2018-07-13 03:08:16', '2018-07-18 00:51:03'),
(65, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-13 03:08:16', '2018-07-13 03:08:16'),
(66, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-13 04:39:17', '2018-07-18 00:51:03'),
(68, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-13 06:20:54', '2018-07-18 00:51:03'),
(70, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-13 06:29:50', '2018-07-18 00:51:03'),
(71, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-07-13 06:29:50', '2018-07-13 06:29:50'),
(72, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-13 06:42:50', '2018-07-18 00:51:03'),
(73, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-07-13 06:42:50', '2018-07-13 06:42:50'),
(74, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-13 06:43:00', '2018-07-18 00:51:03'),
(75, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-07-13 06:43:00', '2018-07-13 06:43:00'),
(76, 16, 1, 'Parent Demo has deleted a child', '', '1', '2018-07-13 06:49:47', '2018-07-18 00:51:03'),
(77, 1, 16, 'You have successfully deleted your child', 'parent/dashboard', '0', '2018-07-13 06:49:47', '2018-07-13 06:49:47'),
(78, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-13 07:00:20', '2018-07-18 00:51:03'),
(80, 16, 1, 'Parent Demo has deleted a child', '', '1', '2018-07-13 07:49:53', '2018-07-18 00:51:03'),
(82, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-15 22:56:40', '2018-07-18 00:51:03'),
(84, 18, 1, 'zara siddhiky has successfully completed registration for parent', '', '1', '2018-07-15 22:59:56', '2018-07-18 00:51:03'),
(85, 20, 1, 'smita joshi has successfully completed registration for parent', '', '1', '2018-07-16 00:13:02', '2018-07-18 00:51:03'),
(86, 31, 1, 'Smita Joshi has successfully completed registration for parent', 'users/parent/view/MzE=', '1', '2018-07-16 04:07:06', '2018-07-18 00:51:03'),
(87, 33, 1, 'Sdasd Asdasd has successfully completed registration for parent', 'users/parent/view/MzM=', '1', '2018-07-16 04:13:21', '2018-07-18 00:51:03'),
(88, 34, 1, 'Smita Joshi has successfully completed registration for parent', 'users/parent/view/MzQ=', '1', '2018-07-16 04:15:21', '2018-07-18 00:51:03'),
(89, 39, 1, 'Sad Asd has successfully completed registration for parent', 'users/parent/view/Mzk=', '1', '2018-07-16 05:42:40', '2018-07-18 00:51:03'),
(90, 40, 1, 'Sad Asd has successfully completed registration for parent', 'users/parent/view/NDA=', '1', '2018-07-16 05:45:32', '2018-07-18 00:51:03'),
(91, 41, 1, 'Sdasd Asdasd has successfully completed registration for parent', 'users/parent/view/NDE=', '1', '2018-07-16 05:47:55', '2018-07-18 00:51:03'),
(92, 43, 1, 'Guyg Sdf has successfully completed registration for parent', 'users/parent/view/NDM=', '1', '2018-07-16 06:16:54', '2018-07-18 00:51:03'),
(93, 44, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/NDQ=', '1', '2018-07-16 06:23:30', '2018-07-18 00:51:03'),
(94, 45, 1, 'Smita Joshi has successfully completed registration for parent', 'users/parent/view/NDU=', '1', '2018-07-16 06:25:31', '2018-07-18 00:51:03'),
(95, 49, 1, 'Amol C has successfully completed registration for parent', '', '1', '2018-07-17 04:09:32', '2018-07-18 00:51:03'),
(96, 52, 1, 'Test Test has successfully completed registration for parent', 'users/parent/view/NTI=', '1', '2018-07-17 04:57:21', '2018-07-18 00:51:03'),
(97, 18, 1, 'Deepak Deepak has successfully completed registration for teacher', '', '1', '2018-07-17 05:14:44', '2018-07-18 00:51:03'),
(98, 18, 1, 'Deepak Salunke has successfully completed registration for teacher', '', '1', '2018-07-17 05:22:47', '2018-07-18 00:51:03'),
(99, 16, 1, 'Parent Demo has added new child', '', '1', '2018-07-17 07:19:33', '2018-07-18 00:51:03'),
(100, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-17 07:19:33', '2018-07-17 07:19:33'),
(101, 16, 1, 'Parent Demo has added new child', '', '1', '2018-07-19 23:54:57', '2018-07-20 01:23:48'),
(102, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-19 23:54:57', '2018-07-19 23:54:57'),
(103, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-19 23:56:43', '2018-07-20 01:23:48'),
(104, 1, 7, 'You have successfully updated a class', 'teacher/dashboard', '0', '2018-07-19 23:56:43', '2018-07-19 23:56:43'),
(105, 7, 1, 'Teacher Demo has added new student, ss s', '', '1', '2018-07-19 23:58:14', '2018-07-20 01:23:48'),
(106, 1, 7, 'You have successfully added new student, ss s', '', '0', '2018-07-19 23:58:14', '2018-07-19 23:58:14'),
(107, 0, 1, 'Deepak Salunke has successfully send message using contact us form.', '', '1', '2018-07-20 01:27:37', '2018-07-27 07:58:09'),
(108, 7, 1, 'Teacher Demo has updated a student data, Studentsss Demosss', 'student/view/MjY=', '1', '2018-07-21 03:45:17', '2018-07-27 07:58:09'),
(109, 1, 7, 'You have successfully updated a student data, Studentsss Demosss', 'teacher/dashboard', '0', '2018-07-21 03:45:17', '2018-07-21 03:45:17'),
(110, 7, 1, 'Teacher Demo has updated a student data, Students Demos', 'student/view/MjY=', '1', '2018-07-21 03:45:31', '2018-07-27 07:58:09'),
(111, 1, 7, 'You have successfully updated a student data, Students Demos', 'teacher/dashboard', '0', '2018-07-21 03:45:31', '2018-07-21 03:45:31'),
(112, 7, 1, 'Teacher Demo has updated a student data, Students Demos', 'student/view/MjY=', '1', '2018-07-21 03:46:02', '2018-07-27 07:58:09'),
(113, 1, 7, 'You have successfully updated a student data, Students Demos', 'teacher/dashboard', '0', '2018-07-21 03:46:02', '2018-07-21 03:46:02'),
(114, 7, 1, 'Teacher Demo has updated a student data, Student Demo', 'student/view/MTM=', '1', '2018-07-21 03:46:38', '2018-07-27 07:58:09'),
(115, 1, 7, 'You have successfully updated a student data, Student Demo', 'teacher/dashboard', '0', '2018-07-21 03:46:38', '2018-07-21 03:46:38'),
(116, 7, 1, 'Teacher Demo has updated a student data, Student Demo', 'student/view/MTM=', '1', '2018-07-21 03:46:45', '2018-07-27 07:58:09'),
(117, 1, 7, 'You have successfully updated a student data, Student Demo', 'teacher/dashboard', '0', '2018-07-21 03:46:45', '2018-07-21 03:46:45'),
(118, 7, 1, 'Teacher Demo has updated a student data, Student Ds', '', '1', '2018-07-21 04:21:05', '2018-07-27 07:58:09'),
(119, 1, 7, 'You have successfully updated a student data, Student Ds', 'teacher/my-student/MQ==', '0', '2018-07-21 04:21:05', '2018-07-21 04:21:05'),
(120, 7, 1, 'Teacher Demo has removed a student from class, Student Ds', '', '1', '2018-07-21 04:26:45', '2018-07-27 07:58:09'),
(121, 1, 7, 'You have successfully removed a student from your class, Student Ds', 'teacher/my-student/MQ==', '0', '2018-07-21 04:26:46', '2018-07-21 04:26:46'),
(122, 33, 1, 'Mayuri Pardeshi has added new child', '', '1', '2018-07-22 00:46:27', '2018-07-27 07:58:09'),
(123, 1, 33, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-22 00:46:27', '2018-07-22 00:46:27'),
(124, 7, 1, 'Teacher Demo has added new class', '', '1', '2018-07-22 01:35:34', '2018-07-27 07:58:09'),
(125, 1, 7, 'You have successfully added new class', 'teacher/dashboard', '0', '2018-07-22 01:35:34', '2018-07-22 01:35:34'),
(126, 7, 1, 'Teacher Demo has added new student, kk kk', '', '1', '2018-07-22 01:36:13', '2018-07-27 07:58:09'),
(127, 1, 7, 'You have successfully added new student, kk kk', '', '0', '2018-07-22 01:36:13', '2018-07-22 01:36:13'),
(128, 7, 1, 'Teacher Demo has added new class', '', '1', '2018-07-22 01:57:33', '2018-07-27 07:58:09'),
(129, 1, 7, 'You have successfully added new class', 'teacher/dashboard', '0', '2018-07-22 01:57:33', '2018-07-22 01:57:33'),
(130, 7, 1, 'Teacher Demo has added new student, BlrTesting February', '', '1', '2018-07-22 01:57:49', '2018-07-27 07:58:09'),
(131, 1, 7, 'You have successfully added new student, BlrTesting February', '', '0', '2018-07-22 01:57:49', '2018-07-22 01:57:49'),
(132, 7, 1, 'Teacher Demo has added new student, BlrTesting February', '', '1', '2018-07-22 01:58:28', '2018-07-27 07:58:09'),
(133, 1, 7, 'You have successfully added new student, BlrTesting February', '', '0', '2018-07-22 01:58:28', '2018-07-22 01:58:28'),
(134, 7, 1, 'Teacher Demo has added new student, BlrTesting February', '', '1', '2018-07-22 01:58:36', '2018-07-27 07:58:09'),
(135, 1, 7, 'You have successfully added new student, BlrTesting February', '', '0', '2018-07-22 01:58:36', '2018-07-22 01:58:36'),
(136, 7, 1, 'Teacher Demo has deleted a class', '', '1', '2018-07-22 01:59:49', '2018-07-27 07:58:09'),
(137, 1, 7, 'You have successfully deleted a class', 'teacher/dashboard', '0', '2018-07-22 01:59:49', '2018-07-22 01:59:49'),
(138, 7, 1, 'Teacher Demo has added new class', '', '1', '2018-07-22 02:00:01', '2018-07-27 07:58:09'),
(139, 1, 7, 'You have successfully added new class', 'teacher/dashboard', '0', '2018-07-22 02:00:01', '2018-07-22 02:00:01'),
(140, 7, 1, 'Teacher Demo has added new student, BlrTesting February', '', '1', '2018-07-22 02:00:07', '2018-07-27 07:58:09'),
(141, 1, 7, 'You have successfully added new student, BlrTesting February', '', '0', '2018-07-22 02:00:07', '2018-07-22 02:00:07'),
(142, 7, 1, 'Teacher Demo has added new student, jai t', '', '1', '2018-07-22 02:00:36', '2018-07-27 07:58:09'),
(143, 1, 7, 'You have successfully added new student, jai t', '', '0', '2018-07-22 02:00:36', '2018-07-22 02:00:36'),
(144, 7, 1, 'Teacher Demo has added new student, gg gg', '', '1', '2018-07-22 02:00:36', '2018-07-27 07:58:09'),
(145, 1, 7, 'You have successfully added new student, gg gg', '', '0', '2018-07-22 02:00:36', '2018-07-22 02:00:36'),
(146, 7, 1, 'Teacher Demo has deleted a class', '', '1', '2018-07-22 02:01:46', '2018-07-27 07:58:09'),
(147, 1, 7, 'You have successfully deleted a class', 'teacher/dashboard', '0', '2018-07-22 02:01:46', '2018-07-22 02:01:46'),
(148, 7, 1, 'Teacher Demo has added new class', '', '1', '2018-07-22 02:02:27', '2018-07-27 07:58:09'),
(149, 1, 7, 'You have successfully added new class', 'teacher/dashboard', '0', '2018-07-22 02:02:27', '2018-07-22 02:02:27'),
(150, 7, 1, 'Teacher Demo has added new student, BlrTesting February', '', '1', '2018-07-22 02:02:51', '2018-07-27 07:58:09'),
(151, 1, 7, 'You have successfully added new student, BlrTesting February', '', '0', '2018-07-22 02:02:51', '2018-07-22 02:02:51'),
(152, 7, 1, 'Teacher Demo has added new student, jai t', '', '1', '2018-07-22 02:02:51', '2018-07-27 07:58:09'),
(153, 1, 7, 'You have successfully added new student, jai t', '', '0', '2018-07-22 02:02:51', '2018-07-22 02:02:51'),
(154, 7, 1, 'Teacher Demo has added new student, priyanka k', '', '1', '2018-07-22 02:02:52', '2018-07-27 07:58:09'),
(155, 1, 7, 'You have successfully added new student, priyanka k', '', '0', '2018-07-22 02:02:52', '2018-07-22 02:02:52'),
(156, 33, 1, 'Mayuri Pardeshi has added new child', '', '1', '2018-07-22 05:00:01', '2018-07-27 07:58:09'),
(157, 1, 33, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-22 05:00:01', '2018-07-22 05:00:01'),
(158, 7, 1, 'Teacher Demo has added new student, noo ooo', '', '1', '2018-07-22 05:43:19', '2018-07-27 07:58:09'),
(159, 1, 7, 'You have successfully added new student, noo ooo', '', '0', '2018-07-22 05:43:19', '2018-07-22 05:43:19'),
(160, 49, 1, 'Sdf Sdf has successfully completed registration for parent', 'users/parent/view/NDk=', '1', '2018-07-22 23:08:19', '2018-07-27 07:58:09'),
(161, 50, 1, 'Rrrrr Rrrr has successfully completed registration for parent', 'users/parent/view/NTA=', '1', '2018-07-22 23:10:45', '2018-07-27 07:58:09'),
(162, 51, 1, 'Test Test has successfully completed registration for parent', 'users/parent/view/NTE=', '1', '2018-07-22 23:18:14', '2018-07-27 07:58:09'),
(163, 52, 1, 'Ads Sad has successfully completed registration for parent', 'users/parent/view/NTI=', '1', '2018-07-22 23:23:33', '2018-07-27 07:58:09'),
(164, 53, 1, 'Werr Werr has successfully completed registration for parent', 'users/parent/view/NTM=', '1', '2018-07-22 23:28:37', '2018-07-27 07:58:09'),
(165, 16, 1, 'Parent Demo has added new child', '', '1', '2018-07-23 05:01:08', '2018-07-27 07:58:09'),
(166, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-23 05:01:08', '2018-07-23 05:01:08'),
(167, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-23 05:16:35', '2018-07-27 07:58:09'),
(168, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-07-23 05:16:35', '2018-07-23 05:16:35'),
(169, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-23 05:49:23', '2018-07-27 07:58:09'),
(170, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-07-23 05:49:23', '2018-07-23 05:49:23'),
(171, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-23 05:49:38', '2018-07-27 07:58:09'),
(172, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-07-23 05:49:38', '2018-07-23 05:49:38'),
(173, 16, 1, 'Parent Demo has added new child', '', '1', '2018-07-23 05:56:40', '2018-07-27 07:58:09'),
(174, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-23 05:56:41', '2018-07-23 05:56:41'),
(175, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-23 05:56:47', '2018-07-27 07:58:09'),
(176, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-07-23 05:56:47', '2018-07-23 05:56:47'),
(177, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-23 05:57:03', '2018-07-27 07:58:09'),
(178, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-07-23 05:57:03', '2018-07-23 05:57:03'),
(179, 16, 1, 'Parent Demo has deleted a child', '', '1', '2018-07-23 05:57:11', '2018-07-27 07:58:09'),
(180, 1, 16, 'You have successfully deleted your child', 'parent/dashboard', '0', '2018-07-23 05:57:11', '2018-07-23 05:57:11'),
(181, 1, 53, 'Erwr my has registered by your reference code. You have received insentive amount means discount amount for next membership purchase', '', '0', '2018-07-23 06:16:16', '2018-07-23 06:16:16'),
(182, 59, 1, 'Erwr My has successfully completed registration for parent', 'users/parent/view/NTk=', '1', '2018-07-23 06:18:52', '2018-07-27 07:58:09'),
(183, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-23 06:29:33', '2018-07-27 07:58:09'),
(184, 1, 7, 'You have successfully updated a class', 'teacher/dashboard', '0', '2018-07-23 06:29:33', '2018-07-23 06:29:33'),
(185, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-23 06:44:22', '2018-07-27 07:58:09'),
(186, 1, 7, 'You have successfully updated a class', 'teacher/dashboard', '0', '2018-07-23 06:44:22', '2018-07-23 06:44:22'),
(187, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-23 06:44:35', '2018-07-27 07:58:09'),
(188, 1, 7, 'You have successfully updated a class', 'teacher/dashboard', '0', '2018-07-23 06:44:35', '2018-07-23 06:44:35'),
(189, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-23 06:44:51', '2018-07-27 07:58:09'),
(190, 1, 7, 'You have successfully updated a class', 'teacher/dashboard', '0', '2018-07-23 06:44:51', '2018-07-23 06:44:51'),
(191, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-23 06:46:56', '2018-07-27 07:58:09'),
(192, 1, 7, 'You have successfully updated a class', 'teacher/dashboard', '0', '2018-07-23 06:46:56', '2018-07-23 06:46:56'),
(193, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-23 06:47:14', '2018-07-27 07:58:09'),
(194, 1, 7, 'You have successfully updated a class', 'teacher/dashboard', '0', '2018-07-23 06:47:14', '2018-07-23 06:47:14'),
(195, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-23 08:41:38', '2018-07-23 08:41:38'),
(196, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-23 08:42:33', '2018-07-23 08:42:33'),
(197, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-23 22:36:30', '2018-07-23 22:36:30'),
(198, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-23 22:38:34', '2018-07-23 22:38:34'),
(199, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-23 22:59:50', '2018-07-23 22:59:50'),
(200, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-23 23:13:55', '2018-07-23 23:13:55'),
(201, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-07-24 01:01:41', '2018-07-24 01:01:41'),
(202, 1, 7, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-07-24 01:29:15', '2018-07-24 01:29:15'),
(203, 16, 1, 'Parent Demo has added new child', '', '1', '2018-07-24 04:06:13', '2018-07-27 07:58:09'),
(204, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-24 04:06:14', '2018-07-24 04:06:14'),
(205, 7, 1, 'Teacher Demo has added new student, Sagar N', '', '1', '2018-07-24 04:25:23', '2018-07-27 07:58:09'),
(206, 1, 7, 'You have successfully added new student, Sagar N', '', '0', '2018-07-24 04:25:23', '2018-07-24 04:25:23'),
(207, 7, 1, 'Teacher Demo has added new student, Sachin N', '', '1', '2018-07-24 04:27:18', '2018-07-27 07:58:09'),
(208, 1, 7, 'You have successfully added new student, Sachin N', '', '0', '2018-07-24 04:27:18', '2018-07-24 04:27:18'),
(209, 7, 1, 'Teacher Demo has added new student, Avinash S', '', '1', '2018-07-24 04:31:41', '2018-07-27 07:58:09'),
(210, 1, 7, 'You have successfully added new student, Avinash S', '', '0', '2018-07-24 04:31:41', '2018-07-24 04:31:41'),
(211, 7, 1, 'Teacher Demo has added new student, Sonu S', '', '1', '2018-07-24 04:32:03', '2018-07-27 07:58:09'),
(212, 1, 7, 'You have successfully added new student, Sonu S', '', '0', '2018-07-24 04:32:03', '2018-07-24 04:32:03'),
(213, 7, 1, 'Teacher Demo has added new student, Bruce Wayne', '', '1', '2018-07-24 04:33:07', '2018-07-27 07:58:09'),
(214, 1, 7, 'You have successfully added new student, Bruce Wayne', '', '0', '2018-07-24 04:33:07', '2018-07-24 04:33:07'),
(215, 16, 1, 'Parent Demo has added new child', '', '1', '2018-07-24 05:16:51', '2018-07-27 07:58:09'),
(216, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-24 05:16:51', '2018-07-24 05:16:51'),
(217, 16, 1, 'Parent Demo has added new child', '', '1', '2018-07-24 05:17:10', '2018-07-27 07:58:09'),
(218, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-24 05:17:11', '2018-07-24 05:17:11'),
(219, 7, 1, 'Teacher Demo has added new student, Tony Stark', '', '1', '2018-07-24 05:17:35', '2018-07-27 07:58:09'),
(220, 1, 7, 'You have successfully added new student, Tony Stark', '', '0', '2018-07-24 05:17:35', '2018-07-24 05:17:35'),
(221, 7, 1, 'Teacher Demo has added new student, Peter Parker', '', '1', '2018-07-24 05:17:46', '2018-07-27 07:58:09'),
(222, 1, 7, 'You have successfully added new student, Peter Parker', '', '0', '2018-07-24 05:17:46', '2018-07-24 05:17:46'),
(223, 7, 1, 'Teacher Demo has added new student, Oliver Queen', '', '1', '2018-07-24 05:18:07', '2018-07-27 07:58:09'),
(224, 1, 7, 'You have successfully added new student, Oliver Queen', '', '0', '2018-07-24 05:18:07', '2018-07-24 05:18:07'),
(225, 7, 1, 'Teacher Demo has added new student, Luke Cage', '', '1', '2018-07-24 05:19:15', '2018-07-27 07:58:09'),
(226, 1, 7, 'You have successfully added new student, Luke Cage', '', '0', '2018-07-24 05:19:15', '2018-07-24 05:19:15'),
(227, 7, 1, 'Teacher Demo has added new student, Walley West', '', '1', '2018-07-24 05:20:00', '2018-07-27 07:58:09'),
(228, 1, 7, 'You have successfully added new student, Walley West', '', '0', '2018-07-24 05:20:00', '2018-07-24 05:20:00'),
(229, 16, 1, 'Parent Demo has added new child', '', '1', '2018-07-24 07:36:31', '2018-07-27 07:58:09'),
(230, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-24 07:36:31', '2018-07-24 07:36:31'),
(231, 16, 1, 'Parent Demo has added new child', '', '1', '2018-07-24 08:13:52', '2018-07-27 07:58:09'),
(232, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-24 08:13:52', '2018-07-24 08:13:52'),
(233, 16, 1, 'Parent Demo has added existed child to his/her account.', '', '1', '2018-07-25 01:31:33', '2018-07-27 07:58:09'),
(234, 1, 16, 'You have successfully added existed child to your account', 'parent/dashboard', '0', '2018-07-25 01:31:33', '2018-07-25 01:31:33'),
(235, 16, 1, 'Parent Demo has added existed child to his/her account.', '', '1', '2018-07-25 01:33:00', '2018-07-27 07:58:09'),
(236, 1, 16, 'You have successfully added existed child to your account', 'parent/dashboard', '0', '2018-07-25 01:33:00', '2018-07-25 01:33:00'),
(237, 16, 1, 'Parent Demo has added new child', '', '1', '2018-07-25 04:24:18', '2018-07-27 07:58:09'),
(238, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-07-25 04:24:18', '2018-07-25 04:24:18'),
(239, 16, 1, 'Parent Demo has added existed child to his/her account using enrollment code.', '', '1', '2018-07-25 04:35:33', '2018-07-27 07:58:09'),
(240, 1, 16, 'You have successfully added existed child to your account using enrollment code', 'parent/dashboard', '0', '2018-07-25 04:35:33', '2018-07-25 04:35:33'),
(241, 16, 1, 'Parent Demo has added existed child to his/her account.', '', '1', '2018-07-25 05:53:51', '2018-07-27 07:58:09'),
(242, 1, 16, 'You have successfully added existed child to your account', 'parent/dashboard', '0', '2018-07-25 05:53:51', '2018-07-25 05:53:51'),
(243, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-25 05:55:46', '2018-07-27 07:58:09'),
(244, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-07-25 05:55:46', '2018-07-25 05:55:46'),
(245, 19, 1, 'Ss Sss has successfully completed registration for parent', 'users/parent/view/MTk=', '1', '2018-07-25 08:36:09', '2018-07-27 07:58:09'),
(246, 7, 1, 'Teacher Demo has added existed student, Tony Stark', '', '1', '2018-07-26 00:42:04', '2018-07-27 07:58:09'),
(247, 1, 7, 'You have successfully added existed student, Tony Stark', '', '0', '2018-07-26 00:42:04', '2018-07-26 00:42:04'),
(248, 7, 1, 'Teacher Demo has transfer student, Tony Stark', '', '1', '2018-07-26 00:50:49', '2018-07-27 07:58:09'),
(249, 1, 7, 'You have successfully transfer student, Tony Stark', '', '0', '2018-07-26 00:50:49', '2018-07-26 00:50:49'),
(250, 7, 1, 'Teacher Demo has removed a student from class, Tony Stark', '', '1', '2018-07-26 00:52:07', '2018-07-27 07:58:09'),
(251, 1, 7, 'You have successfully removed a student from your class, Tony Stark', 'teacher/my-student/MQ==', '0', '2018-07-26 00:52:07', '2018-07-26 00:52:07'),
(252, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-26 03:01:07', '2018-07-27 07:58:09'),
(253, 1, 7, 'You have successfully updated a class', 'teacher/dashboard', '0', '2018-07-26 03:01:07', '2018-07-26 03:01:07'),
(254, 16, 1, 'Parent Demo has added existed child to his/her account using enrollment code.', '', '1', '2018-07-26 03:03:40', '2018-07-27 07:58:09'),
(255, 1, 16, 'You have successfully added existed child to your account using enrollment code', 'parent/dashboard', '0', '2018-07-26 03:03:40', '2018-07-26 03:03:40'),
(256, 7, 1, 'Teacher Demo has added existed student, Tony Stark', '', '1', '2018-07-26 05:58:30', '2018-07-27 07:58:09'),
(257, 1, 7, 'You have successfully added existed student, Tony Stark', '', '0', '2018-07-26 05:58:30', '2018-07-26 05:58:30'),
(258, 7, 1, 'Teacher Demo has added new student, jason h', '', '1', '2018-07-26 23:22:43', '2018-07-27 07:58:09'),
(259, 1, 7, 'You have successfully added new student, jason h', '', '0', '2018-07-26 23:22:43', '2018-07-26 23:22:43'),
(260, 7, 1, 'Teacher Demo has added new student, jai joshi', '', '1', '2018-07-26 23:40:14', '2018-07-27 07:58:09'),
(261, 1, 7, 'You have successfully added new student, jai joshi', '', '0', '2018-07-26 23:40:14', '2018-07-26 23:40:14'),
(262, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-07-30 00:53:07', '2018-08-02 03:43:23'),
(263, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-07-30 00:53:07', '2018-07-30 00:53:07'),
(264, 7, 1, 'Teacher Demo has updated a student data, Tony Stark', '', '1', '2018-07-30 01:11:58', '2018-08-02 03:43:23'),
(265, 1, 7, 'You have successfully updated a student data, Tony Stark', 'teacher/my-student/MQ==', '0', '2018-07-30 01:11:58', '2018-07-30 01:11:58'),
(266, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-30 01:24:48', '2018-08-02 03:43:23'),
(267, 1, 7, 'You have successfully updated a class', 'teacher/dashboard', '0', '2018-07-30 01:24:48', '2018-07-30 01:24:48'),
(268, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-30 01:24:57', '2018-08-02 03:43:23'),
(269, 1, 7, 'You have successfully updated a class', 'teacher/dashboard', '0', '2018-07-30 01:24:57', '2018-07-30 01:24:57'),
(270, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-30 01:27:49', '2018-08-02 03:43:23'),
(271, 1, 7, 'You have successfully updated a class', 'teacher/dashboard', '0', '2018-07-30 01:27:49', '2018-07-30 01:27:49'),
(272, 7, 1, 'Teacher Demo has updated a class', '', '1', '2018-07-30 01:28:26', '2018-08-02 03:43:23'),
(273, 1, 7, 'You have successfully updated a class', 'teacher/dashboard', '0', '2018-07-30 01:28:26', '2018-07-30 01:28:26'),
(274, 78, 1, 'nupur joshi has successfully completed registration for teacher', '', '1', '2018-07-30 01:45:31', '2018-08-02 03:43:23'),
(275, 78, 1, 'Nupur Joshi has added new class', '', '1', '2018-07-30 01:52:34', '2018-08-02 03:43:23'),
(276, 1, 78, 'You have successfully added new class', 'teacher/dashboard', '0', '2018-07-30 01:52:34', '2018-07-30 01:52:34'),
(277, 7, 78, 'Teacher Demo has shared class successfully.', 'http://192.168.1.61/elearning/teacher/dashboard', '0', '2018-07-30 05:52:36', '2018-07-30 05:52:36'),
(278, 80, 1, 'sadasd sadasd has successfully completed registration for teacher', '', '1', '2018-07-30 08:54:43', '2018-08-02 03:43:23'),
(279, 82, 1, 'Teacher A has successfully completed registration for teacher', '', '1', '2018-07-30 23:31:17', '2018-08-02 03:43:23'),
(280, 84, 1, 'Teacher A has successfully completed registration for teacher', '', '1', '2018-07-30 23:37:28', '2018-08-02 03:43:23'),
(281, 85, 1, 'Teacher A has successfully completed registration for teacher', '', '1', '2018-07-30 23:39:46', '2018-08-02 03:43:23'),
(282, 88, 1, 'Teacher A has successfully completed registration for teacher', '', '1', '2018-07-31 00:13:51', '2018-08-02 03:43:23'),
(283, 89, 1, 'Ganesh Datir has successfully completed registration for teacher', '', '1', '2018-07-31 00:16:42', '2018-08-02 03:43:23'),
(284, 90, 1, 'tesdt yet has successfully completed registration for teacher', '', '1', '2018-07-31 03:21:42', '2018-08-02 03:43:23'),
(285, 91, 1, 'sdfsdf sdasd has successfully completed registration for teacher', '', '1', '2018-07-31 04:01:05', '2018-08-02 03:43:23'),
(286, 7, 91, 'Teacher Demo has shared class successfully.', 'http://192.168.1.61/elearning/teacher/dashboard', '0', '2018-07-31 05:09:36', '2018-07-31 05:09:36'),
(287, 7, 92, 'Teacher Demo has shared class successfully.', 'http://192.168.1.61/elearning/teacher/dashboard', '0', '2018-07-31 05:11:33', '2018-07-31 05:11:33'),
(288, 92, 1, 'sadasd sdasd has successfully completed registration for teacher', '', '1', '2018-07-31 05:11:37', '2018-08-02 03:43:23'),
(289, 93, 1, 'Teacher A has successfully completed registration for teacher', '', '1', '2018-07-31 22:49:22', '2018-08-02 03:43:23'),
(290, 94, 1, 'Teacher B has successfully completed registration for teacher', '', '1', '2018-07-31 22:50:18', '2018-08-02 03:43:23'),
(291, 78, 1, 'Nupur Joshi has added new class', '', '1', '2018-08-01 00:16:16', '2018-08-02 03:43:23'),
(292, 1, 78, 'You have successfully added new class', 'teacher/dashboard', '0', '2018-08-01 00:16:16', '2018-08-01 00:16:16'),
(293, 7, 1, 'Teacher Demo has transfer student, Tom Jerry', '', '1', '2018-08-01 05:25:00', '2018-08-02 03:43:23'),
(294, 1, 7, 'You have successfully transfer student, Tom Jerry', '', '0', '2018-08-01 05:25:00', '2018-08-01 05:25:00'),
(295, 4, 5, 'Program for approve', 'javascript:void(0);', '1', '2018-08-01 06:19:28', '2018-08-03 06:42:51'),
(296, 4, 14, 'Program for approve', 'javascript:void(0);', '0', '2018-08-01 06:19:29', '2018-08-01 06:19:29'),
(297, 4, 5, 'Program for approve', 'javascript:void(0);', '1', '2018-08-01 06:44:48', '2018-08-03 06:42:51'),
(298, 4, 14, 'Program for approve', 'javascript:void(0);', '0', '2018-08-01 06:44:48', '2018-08-01 06:44:48'),
(299, 4, 5, 'Program \"Program 2\" comes for approval which is created by \"Smita Joshi\" .', 'javascript:void(0);', '1', '2018-08-01 06:45:51', '2018-08-03 06:42:51'),
(300, 4, 14, 'Program \"Program 2\" comes for approval which is created by \"Smita Joshi\" .', 'javascript:void(0);', '0', '2018-08-01 06:45:51', '2018-08-01 06:45:51'),
(301, 16, 1, 'Parent Demo has added existed child to his/her account.', '', '1', '2018-08-01 07:02:31', '2018-08-02 03:43:23'),
(302, 1, 16, 'You have successfully added existed child to your account', 'parent/dashboard', '0', '2018-08-01 07:02:31', '2018-08-01 07:02:31'),
(303, 7, 1, 'Teacher Demo has added new student, dfsdf sdfsdf', '', '1', '2018-08-01 07:44:43', '2018-08-02 03:43:23'),
(304, 1, 7, 'You have successfully added new student, dfsdf sdfsdf', '', '0', '2018-08-01 07:44:43', '2018-08-01 07:44:43'),
(305, 97, 1, 'Sss Sss has successfully completed registration for parent', 'users/parent/view/OTc=', '1', '2018-08-01 08:17:55', '2018-08-02 03:43:23'),
(306, 99, 1, 'Asdasd Asdasd has successfully completed registration for parent', 'users/parent/view/OTk=', '1', '2018-08-01 08:41:02', '2018-08-02 03:43:23'),
(307, 1, 15, 'Admin has shared class successfully.', 'http://192.168.1.7/elearning/teacher/dashboard', '0', '2018-08-02 03:39:57', '2018-08-02 03:39:57'),
(308, 7, 78, 'Teacher Demo has transfered Wwt class successfully.', 'http://192.168.1.61/elearning/teacher/dashboard', '0', '2018-08-02 03:45:23', '2018-08-02 03:45:23'),
(309, 7, 1, 'Teacher Demo has added new class', '', '1', '2018-08-02 03:57:08', '2018-08-02 06:37:04'),
(310, 1, 7, 'You have successfully added new class', 'teacher/dashboard', '0', '2018-08-02 03:57:08', '2018-08-02 03:57:08'),
(311, 7, 78, 'Teacher Demo has transfered PT Class class successfully.', 'http://192.168.1.61/elearning/teacher/dashboard', '0', '2018-08-02 03:57:55', '2018-08-02 03:57:55'),
(312, 7, 1, 'Teacher Demo has added new student, Student Demoss', '', '1', '2018-08-02 04:29:43', '2018-08-02 06:37:04'),
(313, 1, 7, 'You have successfully added new student, Student Demoss', '', '0', '2018-08-02 04:29:43', '2018-08-02 04:29:43'),
(314, 7, 1, 'Teacher Demo has added new student, asd asd', '', '1', '2018-08-02 04:30:13', '2018-08-02 06:37:04'),
(315, 1, 7, 'You have successfully added new student, asd asd', '', '0', '2018-08-02 04:30:13', '2018-08-02 04:30:13'),
(316, 78, 1, 'Nupur Joshi has added new student, ghghj ghjghjghj', '', '1', '2018-08-02 04:44:01', '2018-08-02 06:37:04'),
(317, 1, 78, 'You have successfully added new student, ghghj ghjghjghj', '', '0', '2018-08-02 04:44:01', '2018-08-02 04:44:01'),
(318, 78, 7, 'Nupur Joshi has shared Annual Program class successfully.', 'http://192.168.1.61/elearning/teacher/dashboard', '0', '2018-08-02 04:44:38', '2018-08-02 04:44:38'),
(319, 78, 7, 'Nupur Joshi has transfered Annual Program class successfully.', 'http://192.168.1.61/elearning/teacher/dashboard', '0', '2018-08-02 04:45:23', '2018-08-02 04:45:23'),
(320, 78, 1, 'Nupur Joshi has added new student, sadasd sadasd', '', '1', '2018-08-02 04:51:44', '2018-08-02 06:37:04'),
(321, 1, 78, 'You have successfully added new student, sadasd sadasd', '', '0', '2018-08-02 04:51:44', '2018-08-02 04:51:44'),
(322, 78, 7, 'Nupur Joshi has transfered PT Class class successfully.', 'http://192.168.1.61/elearning/teacher/dashboard', '0', '2018-08-02 04:52:39', '2018-08-02 04:52:39'),
(323, 7, 1, 'Teacher Demo has added new student, sdfsd dsfsdfsdf', '', '1', '2018-08-02 05:19:02', '2018-08-02 06:37:04'),
(324, 1, 7, 'You have successfully added new student, sdfsd dsfsdfsdf', '', '0', '2018-08-02 05:19:02', '2018-08-02 05:19:02'),
(325, 7, 78, 'Teacher Demo has transfered PT Class class successfully.', 'http://192.168.1.61/elearning/teacher/dashboard', '0', '2018-08-02 05:19:32', '2018-08-02 05:19:32'),
(326, 108, 1, 'Teacher Demo has successfully completed registration for teacher', '', '1', '2018-08-02 06:04:23', '2018-08-02 06:37:04'),
(327, 109, 1, 'Deepak Salunke has successfully completed registration for teacher', '', '1', '2018-08-02 06:09:49', '2018-08-02 06:37:04'),
(328, 4, 5, 'Program \"All Programs\" comes for approval which is created by \"Smita Joshi\" .', 'javascript:void(0);', '1', '2018-08-02 06:25:56', '2018-08-03 06:42:51'),
(329, 4, 14, 'Program \"All Programs\" comes for approval which is created by \"Smita Joshi\" .', 'javascript:void(0);', '0', '2018-08-02 06:25:56', '2018-08-02 06:25:56'),
(330, 111, 1, 'BlrTesting February has successfully completed registration for teacher', '', '1', '2018-08-02 23:40:53', '2018-08-04 02:58:30'),
(331, 1, 7, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-08-03 01:41:35', '2018-08-03 01:41:35'),
(332, 1, 7, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-08-03 01:41:41', '2018-08-03 01:41:41'),
(333, 1, 7, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-08-03 01:41:53', '2018-08-03 01:41:53'),
(334, 1, 7, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-08-03 01:42:21', '2018-08-03 01:42:21'),
(335, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-08-03 02:02:00', '2018-08-03 02:02:00'),
(336, 7, 91, 'Teacher Demo has shared Annual Program class successfully.', 'http://192.168.1.61/elearning/teacher/dashboard', '0', '2018-08-03 04:15:44', '2018-08-03 04:15:44'),
(337, 7, 78, 'Teacher Demo has shared Annual Program class successfully.', 'http://192.168.1.61/elearning/teacher/dashboard', '0', '2018-08-03 04:15:47', '2018-08-03 04:15:47'),
(338, 7, 92, 'Teacher Demo has shared Annual Program class successfully.', 'http://192.168.1.61/elearning/teacher/dashboard', '0', '2018-08-03 04:15:56', '2018-08-03 04:15:56'),
(339, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-08-03 05:36:23', '2018-08-03 05:36:23'),
(340, 1, 7, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-08-03 05:37:46', '2018-08-03 05:37:46'),
(341, 112, 1, 'deepak s has successfully completed registration for teacher', '', '1', '2018-08-03 06:14:55', '2018-08-04 02:58:30'),
(342, 113, 1, 'mayuri pardeshi has successfully completed registration for teacher', '', '1', '2018-08-03 06:17:00', '2018-08-04 02:58:30'),
(343, 114, 1, 'dad sfdf has successfully completed registration for teacher', '', '1', '2018-08-03 06:22:35', '2018-08-04 02:58:30'),
(344, 115, 1, 'Mayuri Pardeshi has successfully completed registration for teacher', '', '1', '2018-08-03 06:28:20', '2018-08-04 02:58:30'),
(345, 117, 1, 'tester webwing has successfully completed registration for teacher', '', '1', '2018-08-03 06:50:12', '2018-08-04 02:58:30'),
(346, 118, 1, 'Sadasd Sadasd has successfully completed registration for parent', 'users/parent/view/MTE4', '1', '2018-08-03 06:51:36', '2018-08-04 02:58:30'),
(347, 119, 1, 'mayuri p has successfully completed registration for teacher', '', '1', '2018-08-03 06:52:27', '2018-08-04 02:58:30'),
(348, 1, 119, 'Your password was successfully reset.', '', '0', '2018-08-03 06:56:53', '2018-08-03 06:56:53'),
(349, 120, 1, 'Sadsad Sadsad has successfully completed registration for parent', 'users/parent/view/MTIw', '1', '2018-08-05 00:49:44', '2018-08-06 07:48:00'),
(350, 122, 1, 'Test Joshi parent has requested for wire transfer payment.', '', '1', '2018-08-06 07:47:38', '2018-08-06 07:48:00'),
(351, 7, 1, 'Teacher Demo has added new student, Iron Fist', '', '1', '2018-08-07 00:55:25', '2018-08-09 22:47:21'),
(352, 1, 7, 'You have successfully added new student, Iron Fist', '', '0', '2018-08-07 00:55:25', '2018-08-07 00:55:25'),
(353, 1, 7, 'Admin has shared your Math class successfully.', 'http://192.168.1.7/elearning/teacher/dashboard', '0', '2018-08-07 01:20:19', '2018-08-07 01:20:19'),
(354, 7, 112, 'Teacher Demo has shared Math class successfully.', 'http://192.168.1.7/elearning/teacher/dashboard', '0', '2018-08-07 01:20:19', '2018-08-07 01:20:19'),
(355, 5, 4, 'Program \"P11\" approved by \"Deepak Salunke\" .', 'javascript:void(0);', '1', '2018-08-07 02:03:31', '2018-08-07 05:26:50'),
(356, 129, 1, 'Sdd Sddsd has successfully completed registration for parent', 'users/parent/view/MTI5', '1', '2018-08-07 03:36:52', '2018-08-09 22:47:21'),
(357, 129, 1, 'Sdd Sddsd has successfully completed registration for parent', 'users/parent/view/MTI5', '1', '2018-08-07 03:40:07', '2018-08-09 22:47:21'),
(358, 129, 1, 'Sdd Sddsd has successfully completed registration for parent', 'users/parent/view/MTI5', '1', '2018-08-07 03:43:03', '2018-08-09 22:47:21'),
(359, 129, 1, 'Sdd Sddsd has successfully completed registration for parent', 'users/parent/view/MTI5', '1', '2018-08-07 03:44:40', '2018-08-09 22:47:21'),
(360, 1, 129, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 500 amount', '', '0', '2018-08-07 03:44:43', '2018-08-07 03:44:43'),
(361, 130, 1, 'Sadsad Sadasd has successfully completed registration for parent', 'users/parent/view/MTMw', '1', '2018-08-07 03:55:58', '2018-08-09 22:47:21'),
(362, 1, 130, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 500 amount', '', '0', '2018-08-07 03:56:02', '2018-08-07 03:56:02'),
(363, 131, 1, 'Sdfsdf Sdfsdf has successfully completed registration for parent', 'users/parent/view/MTMx', '1', '2018-08-07 04:02:23', '2018-08-09 22:47:21'),
(364, 131, 1, 'Sdfsdf Sdfsdf has successfully completed registration for parent', 'users/parent/view/MTMx', '1', '2018-08-07 04:07:40', '2018-08-09 22:47:21'),
(365, 1, 130, 'Sdfsdf Sdfsdf parent registered with your reference code, So you have received Extension of 2 months and Incentive of 25.00%', '', '0', '2018-08-07 04:07:44', '2018-08-07 04:07:44'),
(366, 5, 4, '', 'javascript:void(0);', '1', '2018-08-07 05:19:07', '2018-08-07 05:26:50'),
(367, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-08-07 05:19:44', '2018-08-09 22:47:21'),
(368, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-08-07 05:19:44', '2018-08-07 05:19:44'),
(369, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-08-07 05:19:52', '2018-08-09 22:47:21'),
(371, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-08-07 05:19:58', '2018-08-09 22:47:21'),
(372, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-08-07 05:19:58', '2018-08-07 05:19:58'),
(373, 16, 1, 'Parent Demo has updated a child', '', '1', '2018-08-07 05:20:05', '2018-08-09 22:47:21'),
(374, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-08-07 05:20:05', '2018-08-07 05:20:05'),
(375, 5, 4, 'Program \"P11\" rejected by \"Deepak Salunke\" .', 'javascript:void(0);', '1', '2018-08-07 05:20:30', '2018-08-07 05:26:50'),
(376, 5, 4, 'Program \"P11\" rejected by \"Deepak Salunke\" .', 'http://192.168.1.74/elearning/supervisor/program/view/MzA=', '1', '2018-08-07 05:26:22', '2018-08-07 05:26:50'),
(377, 5, 4, 'Program \"P11\" rejected by \"Deepak Salunke\" .', 'http://192.168.1.74/elearning/program-creator/program/view/MzA=', '1', '2018-08-07 06:10:24', '2018-08-07 06:10:30'),
(378, 7, 1, 'Teacher Demo has transfer student, Luke Cage', '', '1', '2018-08-07 07:32:13', '2018-08-09 22:47:21'),
(379, 1, 7, 'You have successfully transfer student, Luke Cage', '', '0', '2018-08-07 07:32:13', '2018-08-07 07:32:13'),
(380, 7, 1, 'Teacher Demo has removed a student from class, Luke Cage', '', '1', '2018-08-07 07:32:29', '2018-08-09 22:47:21'),
(381, 1, 7, 'You have successfully removed a student from your class, Luke Cage', 'teacher/my-student/MTQ=', '0', '2018-08-07 07:32:29', '2018-08-07 07:32:29'),
(382, 133, 1, 'Dsfsdf Sdfsdf has successfully completed registration for parent', 'users/parent/view/MTMz', '1', '2018-08-07 07:56:28', '2018-08-09 22:47:21'),
(383, 1, 133, 'Ddd Dddd parent registered with your reference code, So you have received Extension of 2 months and Incentive of 25.00%', '', '0', '2018-08-08 05:24:31', '2018-08-08 05:24:31'),
(384, 134, 1, 'Ddd Dddd has successfully completed registration for parent', 'users/parent/view/MTM0', '1', '2018-08-08 05:24:32', '2018-08-09 22:47:21'),
(385, 16, 1, 'Parent Demo has added existed child to his/her account.', '', '1', '2018-08-08 06:20:47', '2018-08-09 22:47:21'),
(386, 1, 16, 'You have successfully added existed child to your account', 'parent/dashboard', '0', '2018-08-08 06:20:47', '2018-08-08 06:20:47'),
(387, 137, 1, 'Paypal Demo has successfully completed registration for teacher', '', '1', '2018-08-08 07:40:47', '2018-08-09 22:47:21'),
(388, 1, 134, 'Elearning Demo parent registered with your reference code, So you have received Extension of 2 months and Incentive of 25.00%', '', '0', '2018-08-08 07:45:17', '2018-08-08 07:45:17'),
(389, 1, 4, 'Program \"P11\" approved by \"Admin Webwing\" .', 'http://192.168.1.74/elearning/program-creator/program/view/MzA=', '0', '2018-08-08 23:52:44', '2018-08-08 23:52:44'),
(390, 5, 4, 'Program \"P11\" rejected by \"Deepak Salunke\" .', 'http://192.168.1.74/elearning/program-creator/program/view/MzA=', '0', '2018-08-08 23:59:14', '2018-08-08 23:59:14'),
(391, 1, 4, 'Program \"P11\" rejected by \"Admin Webwing\".', 'http://192.168.1.74/elearning/program-creator/program/view/MzA=', '0', '2018-08-09 00:08:32', '2018-08-09 05:42:28'),
(392, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 00:40:44', '2018-08-10 00:40:44'),
(393, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 03:34:58', '2018-08-10 03:34:58'),
(394, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 03:38:35', '2018-08-10 03:38:35'),
(395, 5, 4, 'Program \"Program Name 1\" approved by \"Deepak Salunke\".', 'http://192.168.1.74/elearning/program-creator/program/view/MzE=', '0', '2018-08-10 03:47:33', '2018-08-10 03:47:33'),
(396, 5, 4, 'Program \"Program Name 1\" rejected by \"Deepak Salunke\".', 'http://192.168.1.74/elearning/program-creator/program/view/MzE=', '0', '2018-08-10 03:49:24', '2018-08-10 03:49:24'),
(397, 5, 4, 'Program \"Program Name 1\" rejected by \"Deepak Salunke\".', 'http://192.168.1.74/elearning/program-creator/program/view/MzE=', '0', '2018-08-10 03:50:46', '2018-08-10 03:50:46'),
(398, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 03:50:53', '2018-08-10 03:50:53'),
(399, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 03:52:00', '2018-08-10 03:52:00'),
(400, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 03:54:49', '2018-08-10 03:54:49'),
(401, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 03:55:39', '2018-08-10 03:55:39'),
(402, 1, 4, 'Program \"Program Name 1\" approved by \"Admin Webwing\".', 'http://192.168.1.74/elearning/program-creator/program/view/MzE=', '0', '2018-08-10 03:59:50', '2018-08-10 03:59:50'),
(403, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 04:01:36', '2018-08-10 04:01:36'),
(404, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 04:19:18', '2018-08-10 04:19:18'),
(405, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 04:19:18', '2018-08-10 04:19:18'),
(406, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 04:32:56', '2018-08-10 04:32:56'),
(407, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 04:32:56', '2018-08-10 04:32:56'),
(408, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 04:42:06', '2018-08-10 04:42:06');
INSERT INTO `notifications` (`id`, `from_user_id`, `to_user_id`, `message`, `url`, `is_read`, `created_at`, `updated_at`) VALUES
(409, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 04:44:26', '2018-08-10 04:44:26'),
(410, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 04:51:37', '2018-08-10 04:51:37'),
(411, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 04:52:25', '2018-08-10 04:52:25'),
(412, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 04:53:56', '2018-08-10 04:53:56'),
(413, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 04:54:12', '2018-08-10 04:54:12'),
(414, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 04:54:54', '2018-08-10 04:54:54'),
(415, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 04:56:12', '2018-08-10 04:56:12'),
(416, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 04:57:02', '2018-08-10 04:57:02'),
(417, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 04:58:44', '2018-08-10 04:58:44'),
(418, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 04:58:51', '2018-08-10 04:58:51'),
(419, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 04:59:09', '2018-08-10 04:59:09'),
(420, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 05:00:03', '2018-08-10 05:00:03'),
(421, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 05:01:10', '2018-08-10 05:01:10'),
(422, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 05:01:47', '2018-08-10 05:01:47'),
(423, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 05:02:14', '2018-08-10 05:02:14'),
(424, 1, 141, 'You have received 5% discount on <i class=\"fa fa-jpy\" aria-hidden=\"true\"></i> 200 amount', '', '0', '2018-08-10 05:02:50', '2018-08-10 05:02:50'),
(425, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 05:02:51', '2018-08-10 05:02:51'),
(426, 16, 1, 'Parent Demo has deleted a child', '', '0', '2018-08-10 05:20:32', '2018-08-10 05:20:32'),
(427, 1, 16, 'You have successfully deleted your child', 'parent/dashboard', '0', '2018-08-10 05:20:32', '2018-08-10 05:20:32'),
(428, 16, 1, 'Parent Demo has added new child', '', '0', '2018-08-10 05:35:46', '2018-08-10 05:35:46'),
(429, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-08-10 05:35:46', '2018-08-10 05:35:46'),
(430, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-08-10 05:38:34', '2018-08-10 05:38:34'),
(431, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-08-10 05:41:47', '2018-08-10 05:41:47'),
(432, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-08-10 05:42:04', '2018-08-10 05:42:04'),
(434, 16, 1, 'Parent Demo has added new child', '', '0', '2018-08-10 06:36:19', '2018-08-10 06:36:19'),
(435, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-08-10 06:36:19', '2018-08-10 06:36:19'),
(436, 16, 1, 'Parent Demo has updated a child', '', '0', '2018-08-10 06:36:26', '2018-08-10 06:36:26'),
(437, 1, 16, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-08-10 06:36:26', '2018-08-10 06:36:26'),
(438, 16, 1, 'Parent Demo has deleted a child', '', '0', '2018-08-10 06:36:32', '2018-08-10 06:36:32'),
(439, 1, 16, 'You have successfully deleted your child', 'parent/dashboard', '0', '2018-08-10 06:36:32', '2018-08-10 06:36:32'),
(440, 16, 1, 'Parent Demo has added new child', '', '0', '2018-08-10 06:40:11', '2018-08-10 06:40:11'),
(441, 1, 16, 'You have successfully added new child', 'parent/dashboard', '0', '2018-08-10 06:40:11', '2018-08-10 06:40:11'),
(442, 141, 1, 'Sad Sadasd has successfully completed registration for parent', 'users/parent/view/MTQx', '0', '2018-08-10 06:41:35', '2018-08-10 06:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('deepak@o3enzyme.com', 'a9176976da93d56de1c8841e3b1c36fa05af860778c27ed66ef37999b4936f80', '2018-07-02 05:34:28'),
('student@o3enzyme.com', '5a61d77e52b8b77f806b48f5311831c7cbe0ac17613c54e5926bb4f967d93c78', '2018-07-02 05:35:11'),
('admin@webwing.com', '2a4c9f606ef53b7b299e6773cc7e037f2247dfb3d358509630e54b92f6a251d0', '2018-07-02 05:48:29'),
('admin@o3enzyme.com', 'aa5e95fe52e4b70dde589e2a9935280d65f696a4651e17c651138139ff4716a8', '2018-07-02 06:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Program Creator Id (Program-Creator)',
  `unique_id` varchar(255) DEFAULT NULL,
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(128) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `subject` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `template_id` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 = block, 1 = active',
  `approve_status` enum('pending','approved','disapproved') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `user_id`, `unique_id`, `name`, `slug`, `description`, `subject`, `grade`, `template_id`, `status`, `approve_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 4, 'P000005', 'Program 1', 'Program-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', 4, 2, '1,2,3,4,5', '1', 'approved', '2018-07-17 00:41:29', '2018-08-02 03:41:50', NULL),
(6, 4, 'P000006', 'Program 2', 'Program-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', 1, 4, '1,18,19,20,21,22,23,24,25,26,27,28,29,32,33,34,36,37,39,46,31,38,50,48,49,40,41,42,45,11,2,3,4,5,7,12,13,14,15,16,44,35,30,6,8,9,10,17,43,47', '1', 'disapproved', '2018-07-17 04:17:57', '2018-08-09 00:23:25', NULL),
(7, 4, 'P000007', 'Program 3', 'Program-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', 1, 6, '1', '1', 'approved', '2018-07-17 23:01:13', '2018-08-02 03:41:50', NULL),
(8, 4, 'P000008', 'Math Program', 'Math-Program', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 2, 2, '1,2', '1', 'approved', '2018-07-18 00:22:14', '2018-08-02 03:41:50', NULL),
(9, 4, 'P000009', 'Test Program', 'Test-Program', 'Test Program Description', 3, 1, '1,2,3', '1', 'approved', '2018-07-18 00:28:05', '2018-08-02 03:41:50', NULL),
(10, 4, 'P000010', 'Final Program', 'Final-Program', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.', 1, 4, '1,2,3,4,5', '1', 'approved', '2018-07-24 07:26:07', '2018-08-02 03:41:50', NULL),
(11, 4, 'P000011', 'Final Program 2', 'Final-Program-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 1, 4, '6,7,8,9', '1', 'approved', '2018-07-25 05:22:53', '2018-08-02 03:41:50', NULL),
(12, 4, 'P000012', 'Ff', 'Ff', 'Fff', 2, 2, NULL, '1', 'pending', '2018-07-25 05:44:37', '2018-08-02 03:42:45', NULL),
(13, 4, 'P000013', 'Final Program 10 - 20', 'Final-Program-10---20', 'Final Program 10 - 15 Final Program 10 - 15 Final Program 10 - 15', 1, 4, '10,11,12,13,14,15,16,17,18,19,20', '1', 'pending', '2018-07-26 01:11:45', '2018-08-02 03:42:45', NULL),
(14, 4, 'P000014', 'Final Program 21 - 25', 'Final-Program-21---25', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 4, '21,22,23,24,25', '1', 'approved', '2018-07-27 01:47:58', '2018-08-02 03:41:49', NULL),
(15, 4, 'P000015', 'Program 26-28', 'Program-26-28', 'Dsfd sdfds fdsfds fdsfdsf dsfdsf dsfds', 1, 4, '26,27,28', '1', 'approved', '2018-07-27 06:20:53', '2018-08-02 03:41:49', NULL),
(16, 4, 'P000016', 'Mayuri\'s program', 'Mayuri\'s-program', 'Mayuri\'s program', 1, 1, '44', '1', 'pending', '2018-07-28 22:13:17', '2018-08-02 03:42:45', NULL),
(17, 4, 'P000017', 'Program For Tester 1', 'Program-For-Tester-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.', 1, 4, '1,2,3', '1', 'approved', '2018-07-30 00:55:02', '2018-08-02 03:41:49', NULL),
(18, 4, 'P000018', 'Xfcdxczx', 'Xfcdxczx', 'Cfssdadsadsa', 1, 4, NULL, '1', 'pending', '2018-07-30 01:58:35', '2018-08-02 03:42:45', NULL),
(19, 4, 'P000019', 'Dfgdfg', 'Dfgdfg', 'Fgjhfghgh', 1, 1, NULL, '1', 'pending', '2018-07-30 02:02:38', '2018-08-02 23:50:52', NULL),
(20, 4, 'P000020', 'Sdfds dsfds dsf', 'Sdfds-dsfds-dsf', 'Sdfdsf dsfsd dsfsd fdsfsdf ds', 1, 4, '1', '1', 'pending', '2018-07-30 02:08:57', '2018-08-09 00:16:36', NULL),
(23, 4, 'P000023', 'Test One P', 'Test-One-P', 'Desc', 1, 4, '1', '1', 'pending', '2018-07-30 09:00:30', '2018-08-09 00:16:36', NULL),
(24, 4, 'P000024', 'Program 29-35', 'Program-29-35', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 1, 4, '29,30,31,32,33,34,35', '1', 'disapproved', '2018-07-30 22:34:38', '2018-08-09 00:16:36', NULL),
(25, 4, 'P000025', 'Program Test : 1 - 5', 'Program-Test-:-1---5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.', 1, 4, '1,2,3,4,5,37', '1', 'approved', '2018-07-31 03:06:00', '2018-08-09 00:16:36', NULL),
(26, 4, 'P000026', 'Program 36-40', 'Program-36-40', 'Test Desc', 1, 4, '36,37,38,39,40', '1', 'approved', '2018-07-31 05:05:06', '2018-08-09 00:16:36', NULL),
(27, 4, 'P000027', 'Program 41-50', 'Program-41-50', 'Test Desc', 1, 4, '41,42,43,44,45,46,48,49,50', '1', 'approved', '2018-07-31 05:12:50', '2018-08-09 00:16:36', NULL),
(28, 4, 'P000028', 'All Programs', 'All-Programs', 'This Program contains all questions from 1 - 49 (except 47 and 50)', 1, 4, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,48,49,50,47', '1', 'approved', '2018-08-01 23:29:01', '2018-08-09 00:16:36', NULL),
(29, 4, 'P000029', 'Program With Multiple Lessons', 'Program-With-Multiple-Lessons', 'Program With Multiple Lessons', 1, 4, '1,2', '1', 'approved', '2018-08-03 01:36:20', '2018-08-09 00:16:36', NULL),
(30, 4, 'P000030', 'P11', 'P11', 'Sadsasdsdsadsa', 1, 4, '1', '1', 'disapproved', '2018-08-03 06:22:23', '2018-08-09 00:16:36', NULL),
(31, 4, 'P000031', 'Program Name 1', 'Program-Name-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 1, 4, '1,2,3', '1', 'approved', '2018-08-10 03:25:45', '2018-08-10 04:01:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program_question`
--

CREATE TABLE `program_question` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_question`
--

INSERT INTO `program_question` (`id`, `program_id`, `template_id`, `lesson_id`, `question_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 1, 8, 6, '2018-07-17 23:45:47', '2018-07-17 23:45:47', NULL),
(2, 8, 1, 9, 7, '2018-07-18 00:22:44', '2018-07-18 00:22:44', NULL),
(3, 8, 1, 9, 8, '2018-07-18 00:23:02', '2018-07-18 00:23:02', NULL),
(4, 9, 1, 6, 9, '2018-07-18 00:36:04', '2018-07-18 00:36:04', NULL),
(5, 8, 1, 11, 10, '2018-07-18 04:50:06', '2018-07-18 04:50:06', NULL),
(7, 8, 2, 11, 7, '2018-07-18 04:55:31', '2018-07-18 04:55:31', NULL),
(8, 8, 1, 11, 12, '2018-07-18 04:55:51', '2018-07-18 04:55:51', NULL),
(12, 6, 1, 12, 13, '2018-07-18 23:45:04', '2018-07-18 23:45:04', NULL),
(13, 6, 1, 12, 14, '2018-07-18 23:46:03', '2018-07-18 23:46:03', NULL),
(15, 6, 18, 12, 2, '2018-07-21 01:38:01', '2018-07-21 01:38:01', NULL),
(16, 6, 19, 12, 3, '2018-07-21 04:30:19', '2018-07-21 04:30:19', NULL),
(20, 6, 20, 12, 2, '2018-07-21 07:40:46', '2018-07-21 07:40:46', NULL),
(22, 6, 21, 12, 2, '2018-07-22 00:53:12', '2018-07-22 00:53:12', NULL),
(23, 6, 22, 12, 3, '2018-07-22 01:16:47', '2018-07-22 01:16:47', NULL),
(25, 6, 22, 12, 2, '2018-07-22 01:21:42', '2018-07-22 01:21:42', NULL),
(26, 6, 23, 12, 3, '2018-07-22 01:53:30', '2018-07-22 01:53:30', NULL),
(28, 6, 23, 12, 2, '2018-07-22 01:59:06', '2018-07-22 01:59:06', NULL),
(30, 6, 24, 12, 2, '2018-07-22 02:27:25', '2018-07-22 02:27:25', NULL),
(33, 6, 25, 12, 3, '2018-07-22 03:54:30', '2018-07-22 03:54:30', NULL),
(35, 6, 26, 12, 2, '2018-07-22 04:20:36', '2018-07-22 04:20:36', NULL),
(37, 6, 27, 12, 2, '2018-07-22 05:08:24', '2018-07-22 05:08:24', NULL),
(39, 6, 28, 12, 2, '2018-07-23 00:02:42', '2018-07-23 00:02:42', NULL),
(41, 6, 29, 12, 2, '2018-07-23 01:14:36', '2018-07-23 01:14:36', NULL),
(43, 6, 32, 12, 2, '2018-07-23 02:21:31', '2018-07-23 02:21:31', NULL),
(44, 6, 33, 12, 1, '2018-07-23 06:34:57', '2018-07-23 06:34:57', NULL),
(46, 6, 34, 12, 2, '2018-07-23 08:07:19', '2018-07-23 08:07:19', NULL),
(50, 6, 36, 12, 4, '2018-07-23 23:39:11', '2018-07-23 23:39:11', NULL),
(55, 6, 37, 12, 5, '2018-07-24 04:10:35', '2018-07-24 04:10:35', NULL),
(57, 6, 39, 12, 2, '2018-07-24 05:52:31', '2018-07-24 05:52:31', NULL),
(59, 6, 46, 12, 2, '2018-07-24 06:48:47', '2018-07-24 06:48:47', NULL),
(62, 10, 1, 13, 16, '2018-07-24 07:31:33', '2018-07-24 07:31:33', NULL),
(63, 10, 2, 13, 9, '2018-07-24 07:32:00', '2018-07-24 13:21:50', '2018-07-24 13:21:50'),
(64, 10, 3, 13, 4, '2018-07-24 07:32:42', '2018-07-24 13:21:52', '2018-07-24 13:21:52'),
(65, 10, 4, 13, 3, '2018-07-24 07:33:52', '2018-07-24 13:21:54', '2018-07-24 13:21:54'),
(66, 10, 5, 13, 3, '2018-07-24 07:34:34', '2018-07-24 13:21:56', '2018-07-24 13:21:56'),
(67, 6, 31, 12, 3, '2018-07-24 08:27:45', '2018-07-24 08:27:45', NULL),
(69, 6, 31, 12, 2, '2018-07-24 08:32:37', '2018-07-24 08:32:37', NULL),
(70, 6, 38, 12, 3, '2018-07-24 09:00:39', '2018-07-24 09:00:39', NULL),
(72, 6, 38, 12, 2, '2018-07-24 22:44:01', '2018-07-24 22:44:01', NULL),
(74, 6, 50, 12, 2, '2018-07-25 00:41:28', '2018-07-25 00:41:28', NULL),
(77, 6, 48, 12, 2, '2018-07-25 01:33:30', '2018-07-25 01:33:30', NULL),
(79, 6, 49, 12, 2, '2018-07-25 05:21:59', '2018-07-25 05:21:59', NULL),
(80, 11, 6, 14, 1, '2018-07-25 05:26:02', '2018-07-25 05:26:02', NULL),
(81, 11, 7, 14, 1, '2018-07-25 05:27:48', '2018-07-25 05:27:48', NULL),
(82, 11, 8, 14, 1, '2018-07-25 05:28:54', '2018-07-25 05:28:54', NULL),
(83, 11, 9, 14, 1, '2018-07-25 05:30:49', '2018-07-25 05:30:49', NULL),
(85, 6, 40, 12, 2, '2018-07-25 07:43:33', '2018-07-25 07:43:33', NULL),
(87, 6, 41, 12, 2, '2018-07-25 08:57:35', '2018-07-25 08:57:35', NULL),
(88, 6, 42, 12, 1, '2018-07-25 23:27:32', '2018-07-25 23:27:32', NULL),
(91, 13, 10, 15, 1, '2018-07-26 01:14:15', '2018-07-26 01:14:15', NULL),
(92, 13, 11, 15, 2, '2018-07-26 01:15:47', '2018-07-26 01:15:47', NULL),
(93, 13, 12, 15, 3, '2018-07-26 01:16:23', '2018-07-26 01:16:23', NULL),
(94, 13, 13, 15, 3, '2018-07-26 01:20:23', '2018-07-26 01:20:23', NULL),
(95, 13, 14, 15, 3, '2018-07-26 01:22:25', '2018-07-26 01:22:25', NULL),
(96, 13, 15, 15, 3, '2018-07-26 01:23:24', '2018-07-26 01:23:24', NULL),
(97, 13, 16, 15, 3, '2018-07-26 01:26:28', '2018-07-26 01:26:28', NULL),
(98, 13, 17, 15, 3, '2018-07-26 01:27:45', '2018-07-26 01:27:45', NULL),
(99, 13, 18, 15, 3, '2018-07-26 01:29:38', '2018-07-26 01:29:38', NULL),
(100, 13, 19, 15, 4, '2018-07-26 01:30:50', '2018-07-26 01:30:50', NULL),
(101, 13, 20, 15, 3, '2018-07-26 01:31:46', '2018-07-26 01:31:46', NULL),
(103, 6, 45, 12, 2, '2018-07-26 03:43:55', '2018-07-26 03:43:55', NULL),
(104, 6, 11, 12, 3, '2018-07-27 01:05:02', '2018-07-27 01:05:02', NULL),
(108, 14, 21, 16, 3, '2018-07-27 01:49:28', '2018-07-27 01:49:28', NULL),
(109, 14, 22, 16, 3, '2018-07-27 01:51:51', '2018-07-27 01:51:51', NULL),
(110, 14, 23, 16, 3, '2018-07-27 01:52:58', '2018-07-27 01:52:58', NULL),
(111, 14, 24, 16, 3, '2018-07-27 01:54:35', '2018-07-27 01:54:35', NULL),
(112, 14, 25, 16, 4, '2018-07-27 01:55:41', '2018-07-27 01:55:41', NULL),
(119, 15, 26, 17, 3, '2018-07-27 06:22:38', '2018-07-27 06:22:38', NULL),
(120, 15, 27, 17, 3, '2018-07-27 06:23:56', '2018-07-27 06:23:56', NULL),
(121, 15, 28, 17, 3, '2018-07-27 06:25:17', '2018-07-27 06:25:17', NULL),
(122, 6, 1, 12, 19, '2018-07-27 06:48:04', '2018-07-27 06:48:04', NULL),
(123, 6, 2, 12, 12, '2018-07-27 07:04:50', '2018-07-27 07:04:50', NULL),
(124, 6, 3, 12, 5, '2018-07-27 07:17:45', '2018-07-27 07:17:45', NULL),
(125, 6, 4, 12, 4, '2018-07-27 08:17:37', '2018-07-27 08:17:37', NULL),
(126, 6, 5, 12, 4, '2018-07-27 08:40:01', '2018-07-27 08:40:01', NULL),
(127, 6, 7, 12, 2, '2018-07-28 00:11:40', '2018-07-28 00:11:40', NULL),
(129, 6, 7, 12, 4, '2018-07-28 01:39:19', '2018-07-28 01:39:19', NULL),
(141, 6, 44, 12, 1, '2018-07-28 08:49:09', '2018-07-28 08:49:09', NULL),
(143, 6, 35, 12, 1, '2018-07-28 09:22:40', '2018-07-28 09:22:40', NULL),
(144, 16, 44, 18, 3, '2018-07-28 22:14:16', '2018-07-28 22:14:16', NULL),
(146, 6, 30, 12, 1, '2018-07-29 01:35:20', '2018-07-29 01:35:20', NULL),
(147, 17, 1, 19, 20, '2018-07-30 00:57:55', '2018-07-30 00:57:55', NULL),
(148, 17, 2, 19, 13, '2018-07-30 01:03:15', '2018-07-30 01:03:15', NULL),
(149, 17, 3, 20, 6, '2018-07-30 01:08:57', '2018-07-30 01:08:57', NULL),
(150, 17, 1, 19, 21, '2018-07-30 01:09:50', '2018-07-30 01:09:50', NULL),
(151, 20, 1, 21, 22, '2018-07-30 02:09:25', '2018-07-30 02:09:25', NULL),
(154, 22, 1, 23, 25, '2018-07-30 02:45:22', '2018-07-30 02:45:22', NULL),
(155, 22, 1, 23, 26, '2018-07-30 02:45:48', '2018-07-30 02:45:48', NULL),
(158, 6, 1, 12, 29, '2018-07-30 07:33:27', '2018-07-30 07:33:27', NULL),
(159, 23, 1, 24, 30, '2018-07-30 09:06:48', '2018-07-30 09:06:48', NULL),
(160, 6, 2, 12, 14, '2018-07-30 09:29:55', '2018-07-30 09:29:55', NULL),
(161, 6, 6, 12, 2, '2018-07-30 10:31:02', '2018-07-30 10:31:02', NULL),
(162, 24, 29, 25, 3, '2018-07-30 22:37:00', '2018-07-30 22:37:00', NULL),
(163, 24, 30, 25, 2, '2018-07-30 22:38:32', '2018-07-30 22:38:32', NULL),
(164, 24, 31, 25, 3, '2018-07-30 22:40:07', '2018-07-30 22:40:07', NULL),
(165, 24, 32, 25, 3, '2018-07-30 22:43:13', '2018-07-30 22:43:13', NULL),
(166, 24, 33, 25, 2, '2018-07-30 22:45:28', '2018-07-30 22:45:28', NULL),
(167, 24, 34, 25, 3, '2018-07-30 22:46:15', '2018-07-30 22:46:15', NULL),
(168, 24, 35, 25, 2, '2018-07-30 22:48:05', '2018-07-30 22:48:05', NULL),
(169, 6, 8, 12, 2, '2018-07-30 23:31:55', '2018-07-30 23:31:55', NULL),
(170, 6, 9, 12, 2, '2018-07-30 23:34:40', '2018-07-30 23:34:40', NULL),
(171, 6, 10, 12, 2, '2018-07-30 23:38:55', '2018-07-30 23:38:55', NULL),
(172, 6, 11, 12, 4, '2018-07-30 23:45:15', '2018-07-30 23:45:15', NULL),
(173, 6, 12, 12, 4, '2018-07-30 23:49:01', '2018-07-30 23:49:01', NULL),
(174, 6, 13, 12, 4, '2018-07-30 23:51:26', '2018-07-30 23:51:26', NULL),
(175, 6, 14, 12, 4, '2018-07-30 23:55:27', '2018-07-30 23:55:27', NULL),
(176, 6, 15, 12, 4, '2018-07-30 23:57:49', '2018-07-30 23:57:49', NULL),
(177, 6, 16, 12, 4, '2018-07-30 23:59:52', '2018-07-30 23:59:52', NULL),
(178, 6, 17, 12, 4, '2018-07-31 00:06:28', '2018-07-31 00:06:28', NULL),
(179, 6, 18, 12, 4, '2018-07-31 00:09:11', '2018-07-31 00:09:11', NULL),
(180, 6, 50, 12, 3, '2018-07-31 01:27:02', '2018-07-31 01:27:02', NULL),
(181, 25, 1, 26, 31, '2018-07-31 03:09:17', '2018-07-31 03:09:17', NULL),
(182, 25, 2, 26, 15, '2018-07-31 03:10:55', '2018-07-31 03:10:55', NULL),
(183, 25, 3, 26, 7, '2018-07-31 03:12:09', '2018-07-31 03:12:09', NULL),
(184, 25, 4, 26, 5, '2018-07-31 03:14:52', '2018-07-31 03:14:52', NULL),
(185, 25, 5, 26, 5, '2018-07-31 03:17:48', '2018-07-31 03:17:48', NULL),
(186, 25, 37, 26, 6, '2018-07-31 04:22:36', '2018-07-31 04:22:36', NULL),
(187, 26, 36, 27, 5, '2018-07-31 05:06:25', '2018-07-31 05:06:25', NULL),
(188, 26, 37, 27, 7, '2018-07-31 05:07:45', '2018-07-31 05:07:45', NULL),
(189, 26, 38, 27, 4, '2018-07-31 05:08:55', '2018-07-31 05:08:55', NULL),
(190, 26, 39, 27, 3, '2018-07-31 05:10:15', '2018-07-31 05:10:15', NULL),
(191, 26, 40, 27, 3, '2018-07-31 05:12:08', '2018-07-31 05:12:08', NULL),
(192, 27, 41, 28, 3, '2018-07-31 05:14:32', '2018-07-31 05:14:32', NULL),
(193, 27, 42, 28, 2, '2018-07-31 05:16:37', '2018-07-31 05:16:37', NULL),
(194, 27, 43, 28, 3, '2018-07-31 05:18:47', '2018-07-31 05:18:47', NULL),
(195, 27, 44, 28, 4, '2018-07-31 05:24:40', '2018-07-31 05:24:40', NULL),
(196, 27, 45, 28, 3, '2018-07-31 05:29:53', '2018-07-31 05:29:53', NULL),
(197, 27, 46, 28, 3, '2018-07-31 05:32:58', '2018-07-31 05:32:58', NULL),
(198, 27, 48, 28, 3, '2018-07-31 05:34:26', '2018-07-31 05:34:26', NULL),
(199, 27, 49, 28, 3, '2018-07-31 05:41:29', '2018-07-31 05:41:29', NULL),
(200, 27, 50, 28, 4, '2018-07-31 05:44:27', '2018-07-31 05:44:27', NULL),
(201, 6, 21, 12, 4, '2018-08-01 03:27:01', '2018-08-01 03:27:01', NULL),
(202, 6, 43, 12, 4, '2018-08-01 05:16:46', '2018-08-01 05:16:46', NULL),
(203, 6, 1, 12, 32, '2018-08-01 06:04:08', '2018-08-01 06:04:08', NULL),
(204, 6, 1, 12, 33, '2018-08-01 06:04:14', '2018-08-01 06:04:14', NULL),
(205, 6, 1, 12, 34, '2018-08-01 06:14:29', '2018-08-01 06:14:29', NULL),
(206, 6, 1, 12, 35, '2018-08-01 06:14:46', '2018-08-01 06:14:46', NULL),
(207, 6, 1, 12, 36, '2018-08-01 06:19:28', '2018-08-01 06:19:28', NULL),
(208, 6, 1, 12, 37, '2018-08-01 06:33:49', '2018-08-01 06:33:49', NULL),
(209, 6, 1, 12, 38, '2018-08-01 06:33:59', '2018-08-01 06:33:59', NULL),
(210, 6, 1, 12, 39, '2018-08-01 06:34:22', '2018-08-01 06:34:22', NULL),
(211, 6, 1, 12, 40, '2018-08-01 06:35:00', '2018-08-01 06:35:00', NULL),
(212, 6, 1, 12, 41, '2018-08-01 06:35:16', '2018-08-01 06:35:16', NULL),
(213, 6, 1, 12, 42, '2018-08-01 06:35:47', '2018-08-01 06:35:47', NULL),
(214, 6, 1, 12, 43, '2018-08-01 06:36:00', '2018-08-01 06:36:00', NULL),
(215, 6, 1, 12, 44, '2018-08-01 06:36:16', '2018-08-01 06:36:16', NULL),
(216, 6, 1, 12, 45, '2018-08-01 06:38:13', '2018-08-01 06:38:13', NULL),
(217, 6, 1, 12, 46, '2018-08-01 06:38:38', '2018-08-01 06:38:38', NULL),
(218, 6, 1, 12, 47, '2018-08-01 06:38:52', '2018-08-01 06:38:52', NULL),
(219, 6, 1, 12, 48, '2018-08-01 06:39:00', '2018-08-01 06:39:00', NULL),
(220, 6, 1, 12, 49, '2018-08-01 06:39:19', '2018-08-01 06:39:19', NULL),
(221, 6, 1, 12, 50, '2018-08-01 06:42:04', '2018-08-01 06:42:04', NULL),
(222, 6, 1, 12, 51, '2018-08-01 06:43:24', '2018-08-01 06:43:24', NULL),
(223, 6, 1, 12, 52, '2018-08-01 06:44:05', '2018-08-01 06:44:05', NULL),
(224, 6, 1, 12, 53, '2018-08-01 06:44:26', '2018-08-01 06:44:26', NULL),
(225, 6, 1, 12, 54, '2018-08-01 06:44:37', '2018-08-01 06:44:37', NULL),
(226, 6, 1, 12, 55, '2018-08-01 06:44:48', '2018-08-01 06:44:48', NULL),
(228, 28, 1, 29, 57, '2018-08-01 23:34:37', '2018-08-01 23:34:37', NULL),
(229, 28, 2, 29, 16, '2018-08-01 23:35:56', '2018-08-01 23:35:56', NULL),
(230, 28, 3, 29, 8, '2018-08-01 23:38:31', '2018-08-01 23:38:31', NULL),
(231, 28, 4, 29, 6, '2018-08-01 23:40:16', '2018-08-01 23:40:16', NULL),
(232, 28, 5, 29, 6, '2018-08-01 23:43:55', '2018-08-01 23:43:55', NULL),
(233, 28, 6, 29, 3, '2018-08-01 23:44:50', '2018-08-01 23:44:50', NULL),
(234, 28, 7, 29, 5, '2018-08-01 23:48:15', '2018-08-01 23:48:15', NULL),
(235, 28, 8, 29, 3, '2018-08-01 23:50:31', '2018-08-01 23:50:31', NULL),
(236, 28, 9, 29, 3, '2018-08-01 23:53:54', '2018-08-01 23:53:54', NULL),
(237, 28, 10, 29, 3, '2018-08-01 23:55:12', '2018-08-01 23:55:12', NULL),
(238, 28, 11, 29, 5, '2018-08-01 23:58:58', '2018-08-01 23:58:58', NULL),
(239, 28, 12, 29, 5, '2018-08-01 23:59:50', '2018-08-01 23:59:50', NULL),
(240, 28, 13, 29, 5, '2018-08-02 00:01:38', '2018-08-02 00:01:38', NULL),
(241, 28, 14, 29, 5, '2018-08-02 00:03:39', '2018-08-02 00:03:39', NULL),
(242, 28, 15, 29, 5, '2018-08-02 00:05:23', '2018-08-02 00:05:23', NULL),
(243, 28, 16, 29, 5, '2018-08-02 00:07:44', '2018-08-02 00:07:44', NULL),
(244, 28, 17, 29, 5, '2018-08-02 00:09:45', '2018-08-02 00:09:45', NULL),
(245, 28, 18, 29, 5, '2018-08-02 00:12:09', '2018-08-02 00:12:09', NULL),
(246, 28, 19, 29, 5, '2018-08-02 00:13:49', '2018-08-02 00:13:49', NULL),
(247, 28, 20, 29, 4, '2018-08-02 00:15:02', '2018-08-02 00:15:02', NULL),
(248, 28, 21, 29, 5, '2018-08-02 00:16:07', '2018-08-02 00:16:07', NULL),
(249, 28, 22, 29, 4, '2018-08-02 00:17:47', '2018-08-02 00:17:47', NULL),
(250, 28, 23, 29, 4, '2018-08-02 00:18:55', '2018-08-02 00:18:55', NULL),
(251, 28, 24, 29, 4, '2018-08-02 00:20:43', '2018-08-02 00:20:43', NULL),
(252, 28, 25, 29, 5, '2018-08-02 00:22:00', '2018-08-02 00:22:00', NULL),
(253, 28, 26, 29, 4, '2018-08-02 00:23:17', '2018-08-02 00:23:17', NULL),
(254, 28, 27, 29, 4, '2018-08-02 00:24:53', '2018-08-02 00:24:53', NULL),
(255, 28, 28, 29, 4, '2018-08-02 00:26:40', '2018-08-02 00:26:40', NULL),
(256, 28, 29, 29, 4, '2018-08-02 00:28:09', '2018-08-02 00:28:09', NULL),
(257, 28, 30, 29, 3, '2018-08-02 00:29:22', '2018-08-02 00:29:22', NULL),
(258, 28, 31, 29, 4, '2018-08-02 00:31:37', '2018-08-02 00:31:37', NULL),
(259, 28, 32, 29, 4, '2018-08-02 00:34:36', '2018-08-02 00:34:36', NULL),
(260, 28, 33, 29, 3, '2018-08-02 00:37:19', '2018-08-02 00:37:19', NULL),
(261, 28, 34, 29, 4, '2018-08-02 00:38:35', '2018-08-02 00:38:35', NULL),
(262, 28, 35, 29, 3, '2018-08-02 00:41:42', '2018-08-02 00:41:42', NULL),
(263, 28, 36, 29, 6, '2018-08-02 00:42:28', '2018-08-02 00:42:28', NULL),
(264, 28, 37, 29, 8, '2018-08-02 00:44:32', '2018-08-02 00:44:32', NULL),
(265, 28, 38, 29, 5, '2018-08-02 00:46:04', '2018-08-02 00:46:04', NULL),
(266, 28, 39, 29, 4, '2018-08-02 00:47:10', '2018-08-02 00:47:10', NULL),
(267, 28, 40, 29, 4, '2018-08-02 04:16:47', '2018-08-02 04:16:47', NULL),
(268, 28, 41, 29, 4, '2018-08-02 04:19:58', '2018-08-02 04:19:58', NULL),
(269, 28, 42, 29, 3, '2018-08-02 04:23:11', '2018-08-02 04:23:11', NULL),
(270, 28, 43, 29, 5, '2018-08-02 04:25:34', '2018-08-02 04:25:34', NULL),
(271, 6, 47, 12, 1, '2018-08-02 04:27:23', '2018-08-02 04:27:23', NULL),
(272, 28, 44, 29, 5, '2018-08-02 04:26:50', '2018-08-02 04:26:50', NULL),
(273, 28, 45, 29, 4, '2018-08-02 04:30:23', '2018-08-02 04:30:23', NULL),
(274, 28, 46, 29, 4, '2018-08-02 04:34:21', '2018-08-02 04:34:21', NULL),
(275, 28, 48, 29, 4, '2018-08-02 04:38:26', '2018-08-02 04:38:26', NULL),
(276, 28, 49, 29, 4, '2018-08-02 04:40:42', '2018-08-02 04:40:42', NULL),
(277, 28, 50, 29, 5, '2018-08-02 04:42:18', '2018-08-02 04:42:18', NULL),
(278, 28, 47, 29, 2, '2018-08-02 06:25:56', '2018-08-02 06:25:56', NULL),
(279, 29, 1, 30, 58, '2018-08-03 01:38:41', '2018-08-03 01:38:41', NULL),
(280, 29, 2, 30, 17, '2018-08-03 01:39:22', '2018-08-03 01:39:22', NULL),
(281, 29, 1, 31, 59, '2018-08-03 01:40:32', '2018-08-03 01:40:32', NULL),
(282, 29, 2, 31, 18, '2018-08-03 01:41:14', '2018-08-03 01:41:14', NULL),
(283, 29, 1, 32, 60, '2018-08-03 01:42:31', '2018-08-03 01:42:31', NULL),
(284, 30, 1, 33, 61, '2018-08-07 01:47:33', '2018-08-07 01:47:33', NULL),
(285, 31, 1, 34, 62, '2018-08-10 03:31:23', '2018-08-10 03:31:23', NULL),
(286, 31, 2, 34, 19, '2018-08-10 03:39:57', '2018-08-10 03:39:57', NULL),
(287, 31, 3, 35, 9, '2018-08-10 03:41:26', '2018-08-10 03:41:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program_reason`
--

CREATE TABLE `program_reason` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `reason` text CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_reason`
--

INSERT INTO `program_reason` (`id`, `user_id`, `program_id`, `reason`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 6, 'Test desc', '2018-08-06 06:27:51', '2018-08-06 06:27:51', NULL),
(2, 5, 6, 'Test 2', '2018-08-06 06:44:24', '2018-08-06 06:44:24', NULL),
(3, 5, 6, 'test 3', '2018-08-06 06:45:26', '2018-08-06 06:45:26', NULL),
(4, 5, 6, 'gfhg hghghfg', '2018-08-06 06:51:50', '2018-08-06 06:51:50', NULL),
(5, 5, 6, 'dtrv re greer', '2018-08-06 06:55:10', '2018-08-06 06:55:10', NULL),
(6, 5, 6, 'rf geg erger greger gergerg er', '2018-08-06 06:56:43', '2018-08-06 06:56:43', NULL),
(7, 5, 30, 'Test 1', '2018-08-06 22:59:59', '2018-08-06 22:59:59', NULL),
(8, 5, 30, 'Test 2', '2018-08-06 23:00:29', '2018-08-06 23:00:29', NULL),
(9, 5, 30, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.', '2018-08-07 00:33:31', '2018-08-07 00:33:31', NULL),
(10, 5, 30, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', '2018-08-07 01:45:05', '2018-08-07 01:45:05', NULL),
(11, 5, 30, 'Content Content Content Content Content Content Content Content Content Content Content Content Content Content Content Content Content Content Content Content vContent Content Content Content Content Content Content Content Content Content Content Content Content Content Content Content Content Content Content Content v', '2018-08-07 02:57:03', '2018-08-07 02:57:03', NULL),
(12, 5, 30, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', '2018-08-07 05:19:07', '2018-08-07 05:19:07', NULL),
(13, 5, 30, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', '2018-08-07 05:20:30', '2018-08-07 05:20:30', NULL),
(14, 5, 30, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', '2018-08-07 05:26:22', '2018-08-07 05:26:22', NULL),
(15, 5, 30, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.', '2018-08-07 06:10:24', '2018-08-07 06:10:24', NULL),
(16, 5, 30, '$isExist', '2018-08-08 23:59:14', '2018-08-08 23:59:14', NULL),
(17, 1, 30, 'Lorem Ipsum，也称乱数假文或者哑元文本， 是印刷及排版领域所常用的虚拟文字。由于曾经一台匿名的打印机刻意打乱了一盒印刷字体从而造出一本字体样品书，Lorem Ipsum从西元15世纪起就被作为此领域的标准文本使用。它不仅延续了五个世纪，还通过了电子排版的挑战，其雏形却依然保存至今。在1960年代，”Leatraset”公司发布了印刷着Lorem Ipsum段落的纸张，从而广泛普及了它的使用。最近，计算机桌面出版软件”Aldus PageMaker”也通过同样的方式使Lorem Ipsum落入大众的视野。', '2018-08-09 00:08:32', '2018-08-09 00:08:32', NULL),
(18, 5, 31, '无可否认，当读者在浏览一个页面的排版时，难免会被可阅读的内容所分散注意力。Lorem Ipsum的目的就是为了保持字母多多少少标准及平均的分配，而不是“此处有文本，此处有文本”，从而让内容更像可读的英语。如今，很多桌面排版软件以及网页编辑用Lorem Ipsum作为默认的示范文本，搜一搜“Lorem Ipsum”就能找到这些网站的雏形。这些年来Lorem Ipsum演变出了各式各样的版本，有些出于偶然，有些则是故意的（刻意的幽默之类的）。', '2018-08-10 03:49:24', '2018-08-10 03:49:24', NULL),
(19, 5, 31, '1234无可否认，当读者在浏览一个页面的排版时，难免会被可阅读的内容所分散注意力。Lorem Ipsum的目的就是为了保持字母多多少少标准及平均的分配，而不是“此处有文本，此处有文本”，从而让内容更像可读的英语。如今，很多桌面排版软件以及网页编辑用Lorem Ipsum作为默认的示范文本，搜一搜“Lorem Ipsum”就能找到这些网站的雏形。这些年来Lorem Ipsum演变出了各式各样的版本，有些出于偶然，有些则是故意的（刻意的幽默之类的）。', '2018-08-10 03:50:46', '2018-08-10 03:50:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reference_code`
--

CREATE TABLE `reference_code` (
  `id` int(11) NOT NULL,
  `validity_extension` varchar(255) NOT NULL,
  `reward_amount` decimal(12,2) NOT NULL,
  `reference_reward_type` enum('validity_extension','reference_amount','both') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reference_code`
--

INSERT INTO `reference_code` (`id`, `validity_extension`, `reward_amount`, `reference_reward_type`, `created_at`, `updated_at`) VALUES
(1, '2', '25.00', 'both', '2018-06-27 22:46:32', '2018-07-30 02:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `share_class`
--

CREATE TABLE `share_class` (
  `id` int(11) NOT NULL,
  `from_teacher_id` int(11) NOT NULL,
  `to_teacher` varchar(200) NOT NULL,
  `to_teacher_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `share_class`
--

INSERT INTO `share_class` (`id`, `from_teacher_id`, `to_teacher`, `to_teacher_id`, `classroom_id`, `created_at`, `updated_at`) VALUES
(7, 7, 'nupur@getnada.com', 78, 1, '2018-07-30 03:37:32', '2018-07-30 11:58:46'),
(8, 7, 'nupur@getnada.com', 78, 5, '2018-07-30 05:52:36', '2018-07-30 11:58:50'),
(9, 7, 'sonaji@getnada.com', 0, 1, '2018-07-31 02:00:16', '2018-07-31 08:27:04'),
(12, 7, 'sonas@getnada.com', 0, 1, '2018-07-31 02:59:01', '2018-07-31 08:31:41'),
(13, 7, 'sona@getnada.com', 91, 1, '2018-07-31 03:02:31', '2018-07-31 05:09:36'),
(14, 7, 'krish@getnada.com', 92, 1, '2018-07-31 05:10:50', '2018-07-31 05:11:33'),
(15, 7, 'vrajesh@getnada.com', 0, 8, '2018-08-02 00:36:35', '2018-08-02 00:36:35'),
(18, 1, 'deepak@zippiex.com', 0, 1, '2018-08-02 03:12:44', '2018-08-02 03:12:44'),
(19, 1, 'deepak@pay-mon.com', 0, 1, '2018-08-02 03:37:30', '2018-08-02 03:37:30'),
(20, 1, 'teacher@zippiex.com', 15, 8, '2018-08-02 03:39:57', '2018-08-02 03:39:57'),
(21, 78, 'teacher@webwing.com', 7, 10, '2018-08-02 04:44:38', '2018-08-02 04:44:38'),
(22, 7, 'dsfgsdf@sdfsdf.com', 0, 14, '2018-08-03 04:15:36', '2018-08-03 04:15:36'),
(23, 7, 'sona@getnada.com', 91, 14, '2018-08-03 04:15:44', '2018-08-03 04:15:44'),
(24, 7, 'nupur@getnada.com', 78, 14, '2018-08-03 04:15:47', '2018-08-03 04:15:47'),
(25, 7, 'deepak@getnada.com', 0, 14, '2018-08-03 04:15:50', '2018-08-03 04:15:50'),
(26, 7, 'krish@getnada.com', 92, 14, '2018-08-03 04:15:56', '2018-08-03 04:15:56'),
(27, 7, 'vrajesh@getnada.com', 0, 14, '2018-08-03 04:15:59', '2018-08-03 04:15:59'),
(28, 7, 'jai@getnada.com', 0, 14, '2018-08-03 04:16:05', '2018-08-03 04:16:05'),
(29, 7, 'deepak@pay-mon.com', 112, 1, '2018-08-07 01:20:19', '2018-08-07 01:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `site_status`
--

CREATE TABLE `site_status` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_address` varchar(255) NOT NULL,
  `site_contact_number` varchar(255) DEFAULT NULL,
  `site_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=offline, 1=online',
  `site_video` varchar(255) NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_keyword` varchar(500) NOT NULL,
  `site_email_address` varchar(255) DEFAULT NULL,
  `fb_url` varchar(255) NOT NULL,
  `twitter_url` varchar(255) NOT NULL,
  `google_plus_url` varchar(500) NOT NULL,
  `linkedin_url` varchar(500) NOT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `lat` varchar(250) NOT NULL,
  `lon` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_status`
--

INSERT INTO `site_status` (`id`, `site_name`, `site_address`, `site_contact_number`, `site_status`, `site_video`, `meta_desc`, `meta_keyword`, `site_email_address`, `fb_url`, `twitter_url`, `google_plus_url`, `linkedin_url`, `youtube_url`, `lat`, `lon`, `created_at`, `updated_at`) VALUES
(1, 'Merit Learning', '4th Floor, Bhandari Jewellery, Beside Kalika Mandir, Mumbai Naka, Matoshree Nagar, Nashik, Maharashtra 422001', '01068470073', '1', 'https://www.youtube.com/watch?v=SwUy1aGvmME', 'meta description', 'meta keyword', 'demo@webwing.com', 'https://facebook.com', 'https://twitter.com', 'https://gmail.com', '', NULL, '', '', '2018-04-13 06:48:30', '2018-07-20 07:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`id`, `student_id`, `parent_id`, `added_by`, `subject_id`, `grade_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 66, 16, 16, 1, 4, '2018-07-24 05:16:51', '2018-08-07 05:19:44', NULL),
(2, 67, 16, 16, 1, 4, '2018-07-24 05:17:10', '2018-08-10 05:20:32', '2018-08-10 05:20:32'),
(3, 68, 16, 7, 1, 4, '2018-07-24 05:17:34', '2018-08-08 06:20:47', NULL),
(4, 69, 16, 7, 1, 4, '2018-07-24 05:17:46', '2018-07-26 03:03:40', NULL),
(5, 70, 28, 7, 3, 1, '2018-07-24 05:18:07', '2018-07-25 05:12:21', NULL),
(6, 71, 0, 7, 0, 0, '2018-07-24 05:19:14', '2018-08-07 07:32:13', NULL),
(7, 72, 0, 7, 1, 6, '2018-07-24 05:20:00', '2018-07-24 05:20:00', NULL),
(8, 73, 16, 16, 1, 4, '2018-07-24 07:36:31', '2018-08-07 05:19:58', NULL),
(9, 74, 16, 16, 1, 4, '2018-07-24 08:13:51', '2018-08-07 05:20:05', NULL),
(10, 75, 19, 7, 0, 0, '2018-07-25 04:24:18', '2018-08-01 05:25:00', NULL),
(11, 76, 0, 7, 1, 6, '2018-07-26 23:22:43', '2018-07-26 23:22:43', NULL),
(12, 77, 99, 7, 0, 0, '2018-07-26 23:40:14', '2018-08-01 08:40:12', NULL),
(13, 96, 0, 7, 0, 0, '2018-08-01 07:44:43', '2018-08-01 07:44:43', NULL),
(14, 103, 0, 7, 1, 4, '2018-08-02 04:29:43', '2018-08-02 04:29:43', NULL),
(15, 104, 0, 7, 1, 4, '2018-08-02 04:30:13', '2018-08-02 04:30:13', NULL),
(16, 105, 0, 78, 0, 0, '2018-08-02 04:44:01', '2018-08-02 04:44:01', NULL),
(17, 106, 0, 78, 0, 0, '2018-08-02 04:51:44', '2018-08-02 04:51:44', NULL),
(18, 107, 0, 7, 0, 0, '2018-08-02 05:19:02', '2018-08-02 05:19:02', NULL),
(19, 128, 0, 7, 0, 0, '2018-08-07 00:55:25', '2018-08-07 00:55:25', NULL),
(20, 143, 16, 16, 1, 6, '2018-08-10 05:35:45', '2018-08-10 05:35:45', NULL),
(21, 144, 16, 16, 2, 2, '2018-08-10 06:36:19', '2018-08-10 06:36:32', '2018-08-10 06:36:32'),
(22, 145, 16, 16, 3, 1, '2018-08-10 06:40:11', '2018-08-10 06:40:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_programs`
--

CREATE TABLE `student_programs` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `assigned_by` enum('teacher','parent') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_programs`
--

INSERT INTO `student_programs` (`id`, `student_id`, `program_id`, `created_by`, `assigned_by`, `created_at`, `updated_at`) VALUES
(1, 66, 8, 7, 'teacher', '2018-07-24 10:58:11', '0000-00-00 00:00:00'),
(6, 34, 6, 33, 'parent', '2018-07-22 09:50:08', '0000-00-00 00:00:00'),
(7, 34, 7, 33, 'parent', '2018-07-22 10:31:12', '0000-00-00 00:00:00'),
(8, 34, 8, 33, 'parent', '2018-07-22 10:31:16', '0000-00-00 00:00:00'),
(10, 18, 5, 16, 'parent', '2018-07-24 09:36:43', '0000-00-00 00:00:00'),
(11, 73, 7, 16, 'parent', '2018-07-24 13:06:52', '2018-07-24 07:36:31'),
(12, 74, 8, 16, 'parent', '2018-07-24 08:13:51', '2018-07-24 08:13:51'),
(13, 68, 10, 16, 'parent', '2018-07-25 01:31:33', '2018-07-25 01:31:33'),
(14, 68, 10, 16, 'parent', '2018-07-25 01:33:00', '2018-07-25 01:33:00'),
(15, 75, 10, 16, 'parent', '2018-07-25 04:24:18', '2018-07-25 04:24:18'),
(16, 68, 9, 16, 'parent', '2018-07-25 04:35:33', '2018-07-25 04:35:33'),
(17, 69, 11, 16, 'parent', '2018-07-25 05:53:51', '2018-07-25 05:53:51'),
(18, 68, 8, 7, 'teacher', '2018-07-26 00:42:04', '2018-07-26 00:42:04'),
(19, 68, 8, 7, 'teacher', '2018-07-26 00:42:35', '2018-07-26 00:42:35'),
(20, 68, 8, 7, 'teacher', '2018-07-26 00:47:33', '2018-07-26 00:47:33'),
(21, 68, 8, 7, 'teacher', '2018-07-26 00:50:48', '2018-07-26 00:50:48'),
(22, 69, 13, 16, 'parent', '2018-07-26 08:29:21', '0000-00-00 00:00:00'),
(23, 69, 13, 16, 'parent', '2018-07-26 03:03:40', '2018-07-26 03:03:40'),
(24, 68, 13, 7, 'teacher', '2018-07-26 05:58:30', '2018-07-26 05:58:30'),
(25, 71, 8, 7, 'teacher', '2018-07-27 07:21:17', '0000-00-00 00:00:00'),
(26, 69, 14, 16, 'parent', '2018-07-27 09:09:41', '0000-00-00 00:00:00'),
(27, 69, 15, 16, 'parent', '2018-07-27 11:56:39', '0000-00-00 00:00:00'),
(28, 69, 24, 16, 'parent', '2018-07-31 04:20:20', '0000-00-00 00:00:00'),
(29, 69, 25, 16, 'parent', '2018-07-31 08:48:36', '0000-00-00 00:00:00'),
(30, 69, 26, 16, 'parent', '2018-07-31 11:34:12', '0000-00-00 00:00:00'),
(31, 69, 27, 16, 'parent', '2018-08-01 05:52:16', '0000-00-00 00:00:00'),
(32, 103, 10, 7, 'teacher', '2018-08-02 04:29:43', '2018-08-02 04:29:43'),
(33, 104, 10, 7, 'teacher', '2018-08-02 04:30:13', '2018-08-02 04:30:13'),
(34, 69, 28, 16, 'parent', '2018-08-02 10:15:37', '0000-00-00 00:00:00'),
(35, 69, 29, 16, 'parent', '2018-08-03 07:15:03', '0000-00-00 00:00:00'),
(36, 69, 29, 7, 'teacher', '2018-08-03 12:39:37', '0000-00-00 00:00:00'),
(38, 128, 8, 7, 'teacher', '2018-08-10 05:43:40', '0000-00-00 00:00:00'),
(39, 143, 7, 16, 'parent', '2018-08-10 05:35:45', '2018-08-10 05:35:45'),
(40, 144, 8, 16, 'parent', '2018-08-10 06:36:19', '2018-08-10 06:36:19'),
(41, 145, 9, 16, 'parent', '2018-08-10 06:40:11', '2018-08-10 06:40:11');

-- --------------------------------------------------------

--
-- Table structure for table `student_program_questions`
--

CREATE TABLE `student_program_questions` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `audio_file` text NOT NULL,
  `answer_time` time NOT NULL,
  `is_answer` enum('no','yes') NOT NULL DEFAULT 'no',
  `wrong_attempts` int(11) NOT NULL DEFAULT '0',
  `is_delay` enum('no','yes') NOT NULL DEFAULT 'no',
  `answer_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_program_questions`
--

INSERT INTO `student_program_questions` (`id`, `program_id`, `template_id`, `lesson_id`, `question_id`, `student_id`, `audio_file`, `answer_time`, `is_answer`, `wrong_attempts`, `is_delay`, `answer_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 1, 8, 6, 71, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-17 23:45:47', '2018-07-24 11:02:21', NULL),
(2, 8, 1, 9, 7, 71, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-18 00:22:44', '2018-07-25 10:07:54', NULL),
(3, 8, 1, 9, 8, 71, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-18 00:23:02', '2018-07-25 10:08:08', NULL),
(4, 9, 1, 6, 9, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-18 00:36:04', '2018-08-09 06:53:01', NULL),
(5, 8, 1, 11, 10, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-18 10:26:29', '2018-08-09 06:53:01', NULL),
(6, 8, 2, 11, 7, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-18 10:26:45', '2018-08-09 06:53:01', NULL),
(7, 8, 1, 11, 12, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-18 10:26:59', '2018-08-09 06:53:01', NULL),
(8, 10, 1, 13, 16, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-18 10:26:59', '2018-08-09 06:53:01', NULL),
(9, 10, 2, 13, 9, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-18 10:26:59', '2018-08-09 06:53:01', NULL),
(10, 10, 3, 13, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-18 10:26:59', '2018-08-09 06:53:01', NULL),
(11, 10, 4, 13, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-18 10:26:59', '2018-08-09 06:53:01', NULL),
(12, 10, 5, 13, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-18 10:26:59', '2018-08-09 06:53:01', NULL),
(13, 8, 1, 9, 7, 74, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-24 08:13:51', '2018-07-30 05:44:27', NULL),
(14, 8, 1, 9, 8, 74, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-24 08:13:52', '2018-07-24 08:13:52', NULL),
(15, 8, 1, 11, 10, 74, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-24 08:13:52', '2018-07-24 08:13:52', NULL),
(16, 8, 2, 11, 7, 74, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-24 08:13:52', '2018-07-24 08:13:52', NULL),
(17, 8, 1, 11, 12, 74, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-24 08:13:52', '2018-07-24 08:13:52', NULL),
(18, 10, 1, 13, 16, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 01:31:33', '2018-07-25 01:31:33', NULL),
(19, 10, 2, 13, 9, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 01:31:33', '2018-07-25 01:31:33', NULL),
(20, 10, 3, 13, 4, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 01:31:33', '2018-07-25 01:31:33', NULL),
(21, 10, 4, 13, 3, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 01:31:33', '2018-07-25 01:31:33', NULL),
(22, 10, 5, 13, 3, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 01:31:33', '2018-07-25 01:31:33', NULL),
(23, 10, 1, 13, 16, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 01:33:00', '2018-07-25 01:33:00', NULL),
(24, 10, 2, 13, 9, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 01:33:00', '2018-07-25 01:33:00', NULL),
(25, 10, 3, 13, 4, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 01:33:00', '2018-07-25 01:33:00', NULL),
(26, 10, 4, 13, 3, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 01:33:00', '2018-07-25 01:33:00', NULL),
(27, 10, 5, 13, 3, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 01:33:00', '2018-07-25 01:33:00', NULL),
(28, 10, 1, 13, 16, 75, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 04:24:18', '2018-07-25 04:24:18', NULL),
(29, 10, 2, 13, 9, 75, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 04:24:18', '2018-07-25 04:24:18', NULL),
(30, 10, 3, 13, 4, 75, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 04:24:18', '2018-07-25 04:24:18', NULL),
(31, 10, 4, 13, 3, 75, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 04:24:18', '2018-07-25 04:24:18', NULL),
(32, 10, 5, 13, 3, 75, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 04:24:18', '2018-07-25 04:24:18', NULL),
(33, 9, 1, 6, 9, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 04:35:33', '2018-07-25 04:35:33', NULL),
(34, 11, 6, 14, 1, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 05:53:51', '2018-08-02 10:38:52', NULL),
(35, 11, 7, 14, 1, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 05:53:51', '2018-08-02 10:38:52', NULL),
(36, 11, 8, 14, 1, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 05:53:51', '2018-08-02 10:38:52', NULL),
(37, 11, 9, 14, 1, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-25 05:53:51', '2018-08-02 10:38:52', NULL),
(38, 8, 1, 9, 7, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:42:04', '2018-07-26 00:42:04', NULL),
(39, 8, 1, 9, 8, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:42:04', '2018-07-26 00:42:04', NULL),
(40, 8, 1, 11, 10, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:42:04', '2018-07-26 00:42:04', NULL),
(41, 8, 2, 11, 7, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:42:04', '2018-07-26 00:42:04', NULL),
(42, 8, 1, 11, 12, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:42:04', '2018-07-26 00:42:04', NULL),
(43, 8, 1, 9, 7, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:42:35', '2018-07-26 00:42:35', NULL),
(44, 8, 1, 9, 8, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:42:35', '2018-07-26 00:42:35', NULL),
(45, 8, 1, 11, 10, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:42:35', '2018-07-26 00:42:35', NULL),
(46, 8, 2, 11, 7, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:42:35', '2018-07-26 00:42:35', NULL),
(47, 8, 1, 11, 12, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:42:35', '2018-07-26 00:42:35', NULL),
(48, 8, 1, 9, 7, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:47:33', '2018-07-26 00:47:33', NULL),
(49, 8, 1, 9, 8, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:47:33', '2018-07-26 00:47:33', NULL),
(50, 8, 1, 11, 10, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:47:33', '2018-07-26 00:47:33', NULL),
(51, 8, 2, 11, 7, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:47:33', '2018-07-26 00:47:33', NULL),
(52, 8, 1, 11, 12, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:47:33', '2018-07-26 00:47:33', NULL),
(53, 8, 1, 9, 7, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:50:48', '2018-07-26 00:50:48', NULL),
(54, 8, 1, 9, 8, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:50:48', '2018-07-26 00:50:48', NULL),
(55, 8, 1, 11, 10, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:50:48', '2018-07-26 00:50:48', NULL),
(56, 8, 2, 11, 7, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:50:48', '2018-07-26 00:50:48', NULL),
(57, 8, 1, 11, 12, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 00:50:49', '2018-07-26 00:50:49', NULL),
(58, 13, 10, 15, 1, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 03:03:40', '2018-08-02 04:13:53', NULL),
(59, 13, 11, 15, 2, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 03:03:40', '2018-08-02 04:13:53', NULL),
(60, 13, 12, 15, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 03:03:40', '2018-08-02 04:13:53', NULL),
(61, 13, 13, 15, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 03:03:40', '2018-08-02 04:13:53', NULL),
(62, 13, 14, 15, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 03:03:40', '2018-08-02 04:13:53', NULL),
(63, 13, 15, 15, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 03:03:40', '2018-08-02 04:13:53', NULL),
(64, 13, 16, 15, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 03:03:40', '2018-08-02 04:13:53', NULL),
(65, 13, 17, 15, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 03:03:40', '2018-08-02 04:13:53', NULL),
(66, 13, 18, 15, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 03:03:40', '2018-08-02 04:13:53', NULL),
(67, 13, 19, 15, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 03:03:40', '2018-08-02 04:13:53', NULL),
(68, 13, 20, 15, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 03:03:40', '2018-08-02 04:13:53', NULL),
(69, 13, 10, 15, 1, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 05:58:30', '2018-07-26 05:58:30', NULL),
(70, 13, 11, 15, 2, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 05:58:30', '2018-07-26 05:58:30', NULL),
(71, 13, 12, 15, 3, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 05:58:30', '2018-07-26 05:58:30', NULL),
(72, 13, 13, 15, 3, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 05:58:30', '2018-07-26 05:58:30', NULL),
(73, 13, 14, 15, 3, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 05:58:30', '2018-07-26 05:58:30', NULL),
(74, 13, 15, 15, 3, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 05:58:30', '2018-07-26 05:58:30', NULL),
(75, 13, 16, 15, 3, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 05:58:30', '2018-07-26 05:58:30', NULL),
(76, 13, 17, 15, 3, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 05:58:30', '2018-07-26 05:58:30', NULL),
(77, 13, 18, 15, 3, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 05:58:30', '2018-07-26 05:58:30', NULL),
(78, 13, 19, 15, 4, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 05:58:30', '2018-07-26 05:58:30', NULL),
(79, 13, 20, 15, 3, 68, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-26 05:58:30', '2018-07-26 05:58:30', NULL),
(80, 8, 1, 9, 7, 0, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:47:04', '2018-07-27 01:47:04', NULL),
(81, 8, 1, 9, 8, 0, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:47:04', '2018-07-27 01:47:04', NULL),
(82, 8, 1, 11, 10, 0, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:47:04', '2018-07-27 01:47:04', NULL),
(83, 8, 2, 11, 7, 0, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:47:04', '2018-07-27 01:47:04', NULL),
(84, 8, 1, 11, 12, 0, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:47:05', '2018-07-27 01:47:05', NULL),
(85, 8, 1, 9, 7, 0, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:48:12', '2018-07-27 01:48:12', NULL),
(86, 8, 1, 9, 8, 0, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:48:12', '2018-07-27 01:48:12', NULL),
(87, 8, 1, 11, 10, 0, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:48:12', '2018-07-27 01:48:12', NULL),
(88, 8, 2, 11, 7, 0, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:48:12', '2018-07-27 01:48:12', NULL),
(89, 8, 1, 11, 12, 0, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:48:12', '2018-07-27 01:48:12', NULL),
(90, 8, 1, 9, 7, 71, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:51:17', '2018-07-27 01:51:17', NULL),
(91, 8, 1, 9, 8, 71, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:51:17', '2018-07-27 01:51:17', NULL),
(92, 8, 1, 11, 10, 71, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:51:17', '2018-07-27 01:51:17', NULL),
(93, 8, 2, 11, 7, 71, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:51:17', '2018-07-27 01:51:17', NULL),
(94, 8, 1, 11, 12, 71, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 01:51:17', '2018-07-27 01:51:17', NULL),
(95, 14, 21, 16, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 03:39:41', '2018-08-02 10:38:52', NULL),
(96, 14, 22, 16, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 03:39:41', '2018-08-02 10:38:52', NULL),
(97, 14, 23, 16, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 03:39:41', '2018-08-02 10:38:52', NULL),
(98, 14, 24, 16, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 03:39:41', '2018-08-02 10:38:52', NULL),
(99, 14, 25, 16, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 03:39:41', '2018-08-02 10:38:52', NULL),
(100, 15, 26, 17, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 06:26:39', '2018-08-02 10:38:52', NULL),
(101, 15, 27, 17, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 06:26:39', '2018-08-02 10:38:52', NULL),
(102, 15, 28, 17, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-27 06:26:39', '2018-08-02 10:38:52', NULL),
(103, NULL, 11, NULL, NULL, NULL, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-30 08:44:36', '2018-07-30 08:44:36', NULL),
(104, 24, 29, 25, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-30 22:50:20', '2018-08-02 04:13:53', NULL),
(105, 24, 30, 25, 2, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-30 22:50:20', '2018-08-02 04:13:53', NULL),
(106, 24, 31, 25, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-30 22:50:20', '2018-08-02 04:13:53', NULL),
(107, 24, 32, 25, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-30 22:50:20', '2018-08-02 04:13:53', NULL),
(108, 24, 33, 25, 2, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-30 22:50:20', '2018-08-02 04:13:53', NULL),
(109, 24, 34, 25, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-30 22:50:20', '2018-08-02 04:13:53', NULL),
(110, 24, 35, 25, 2, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-30 22:50:20', '2018-08-02 04:13:53', NULL),
(111, 25, 1, 26, 31, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-31 03:18:36', '2018-08-02 10:38:52', NULL),
(112, 25, 2, 26, 15, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-31 03:18:36', '2018-08-02 10:38:52', NULL),
(113, 25, 3, 26, 7, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-31 03:18:36', '2018-08-02 10:38:52', NULL),
(114, 25, 4, 26, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-31 03:18:36', '2018-08-02 10:38:52', NULL),
(115, 25, 5, 26, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-07-31 03:18:36', '2018-08-02 10:38:52', NULL),
(116, 26, 36, 27, 5, 69, '', '00:00:19', 'yes', 8, 'yes', '2018-08-10', '2018-07-31 06:04:12', '2018-08-10 06:19:39', NULL),
(117, 26, 37, 27, 7, 69, '', '00:00:05', 'yes', 0, 'yes', '2018-08-10', '2018-07-31 06:04:13', '2018-08-10 06:18:52', NULL),
(118, 26, 38, 27, 4, 69, '', '00:00:15', 'yes', 2, 'no', '2018-08-10', '2018-07-31 06:04:13', '2018-08-10 06:19:02', NULL),
(119, 26, 39, 27, 3, 69, '', '00:00:12', 'yes', 3, 'yes', '2018-08-10', '2018-07-31 06:04:13', '2018-08-10 06:19:14', NULL),
(120, 26, 40, 27, 3, 69, '', '00:00:16', 'yes', 0, 'yes', '2018-08-10', '2018-07-31 06:04:13', '2018-08-10 06:19:30', NULL),
(121, 27, 41, 28, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-01 00:22:16', '2018-08-02 10:38:52', NULL),
(122, 27, 42, 28, 2, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-01 00:22:16', '2018-08-02 10:38:52', NULL),
(123, 27, 43, 28, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-01 00:22:16', '2018-08-02 10:38:52', NULL),
(124, 27, 44, 28, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-01 00:22:16', '2018-08-02 10:38:52', NULL),
(125, 27, 45, 28, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-01 00:22:16', '2018-08-02 10:38:52', NULL),
(126, 27, 46, 28, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-01 00:22:16', '2018-08-02 10:38:52', NULL),
(127, 27, 48, 28, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-01 00:22:16', '2018-08-02 10:38:52', NULL),
(128, 27, 49, 28, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-01 00:22:16', '2018-08-02 10:38:52', NULL),
(129, 27, 50, 28, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-01 00:22:16', '2018-08-02 10:38:52', NULL),
(130, 10, 1, 13, 16, 103, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:29:43', '2018-08-02 04:29:43', NULL),
(131, 10, 2, 13, 9, 103, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:29:43', '2018-08-02 04:29:43', NULL),
(132, 10, 3, 13, 4, 103, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:29:43', '2018-08-02 04:29:43', NULL),
(133, 10, 4, 13, 3, 103, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:29:43', '2018-08-02 04:29:43', NULL),
(134, 10, 5, 13, 3, 103, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:29:43', '2018-08-02 04:29:43', NULL),
(135, 10, 1, 13, 16, 104, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:30:13', '2018-08-02 04:30:13', NULL),
(136, 10, 2, 13, 9, 104, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:30:13', '2018-08-02 04:30:13', NULL),
(137, 10, 3, 13, 4, 104, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:30:13', '2018-08-02 04:30:13', NULL),
(138, 10, 4, 13, 3, 104, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:30:13', '2018-08-02 04:30:13', NULL),
(139, 10, 5, 13, 3, 104, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:30:13', '2018-08-02 04:30:13', NULL),
(140, 28, 1, 29, 57, 69, '', '00:00:06', 'yes', 1, 'no', '2018-08-10', '2018-08-02 04:45:37', '2018-08-10 06:09:52', NULL),
(141, 28, 2, 29, 16, 69, '', '00:00:10', 'yes', 0, 'yes', '2018-08-10', '2018-08-02 04:45:37', '2018-08-10 06:15:21', NULL),
(142, 28, 3, 29, 8, 69, '', '00:00:06', 'yes', 0, 'no', '2018-08-10', '2018-08-02 04:45:37', '2018-08-10 06:15:27', NULL),
(143, 28, 4, 29, 6, 69, '', '00:00:10', 'yes', 0, 'yes', '2018-08-10', '2018-08-02 04:45:37', '2018-08-10 06:16:24', NULL),
(144, 28, 5, 29, 6, 69, '', '00:00:04', 'yes', 1, 'no', '2018-08-10', '2018-08-02 04:45:37', '2018-08-10 06:16:28', NULL),
(145, 28, 6, 29, 3, 69, '', '00:00:10', 'yes', 0, 'yes', '2018-08-10', '2018-08-02 04:45:37', '2018-08-10 06:24:31', NULL),
(146, 28, 7, 29, 5, 69, '', '00:00:58', 'yes', 0, 'no', '2018-08-10', '2018-08-02 04:45:37', '2018-08-10 06:25:52', NULL),
(147, 28, 8, 29, 3, 69, '', '00:02:00', 'yes', 0, 'yes', '2018-08-10', '2018-08-02 04:45:37', '2018-08-10 06:30:14', NULL),
(148, 28, 9, 29, 3, 69, '', '00:00:06', 'yes', 0, 'no', '2018-08-10', '2018-08-02 04:45:37', '2018-08-10 06:30:21', NULL),
(149, 28, 10, 29, 3, 69, '', '00:02:00', 'yes', 0, 'yes', '2018-08-10', '2018-08-02 04:45:37', '2018-08-10 06:38:44', NULL),
(150, 28, 11, 29, 5, 69, '', '00:00:10', 'yes', 0, 'no', '2018-08-10', '2018-08-02 04:45:37', '2018-08-10 06:38:54', NULL),
(151, 28, 12, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:37', '2018-08-10 11:40:54', NULL),
(152, 28, 13, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:37', '2018-08-10 11:40:54', NULL),
(153, 28, 14, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:37', '2018-08-10 11:40:54', NULL),
(154, 28, 15, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:37', '2018-08-10 11:40:54', NULL),
(155, 28, 16, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:37', '2018-08-10 11:40:54', NULL),
(156, 28, 17, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:37', '2018-08-10 11:40:54', NULL),
(157, 28, 18, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:37', '2018-08-10 11:40:54', NULL),
(158, 28, 19, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:37', '2018-08-10 11:40:54', NULL),
(159, 28, 20, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:37', '2018-08-10 11:40:54', NULL),
(160, 28, 21, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:37', '2018-08-10 11:40:54', NULL),
(161, 28, 22, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:37', '2018-08-10 11:40:54', NULL),
(162, 28, 23, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:37', '2018-08-10 11:40:54', NULL),
(163, 28, 24, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-10 11:40:54', NULL),
(164, 28, 25, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-10 11:40:54', NULL),
(165, 28, 26, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-10 11:40:54', NULL),
(166, 28, 27, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-10 11:40:54', NULL),
(167, 28, 28, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-10 10:06:44', NULL),
(168, 28, 29, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-10 10:06:44', NULL),
(169, 28, 30, 29, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-10 10:06:44', NULL),
(170, 28, 31, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(171, 28, 32, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(172, 28, 33, 29, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(173, 28, 34, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(174, 28, 35, 29, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(175, 28, 36, 29, 6, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(176, 28, 37, 29, 8, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(177, 28, 38, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(178, 28, 39, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(179, 28, 40, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(180, 28, 41, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(181, 28, 42, 29, 3, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(182, 28, 43, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(183, 28, 44, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(184, 28, 45, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(185, 28, 46, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(186, 28, 48, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(187, 28, 49, 29, 4, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(188, 28, 50, 29, 5, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(189, 28, 47, 29, 2, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-02 04:45:38', '2018-08-09 06:53:01', NULL),
(190, 29, 1, 30, 58, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-03 01:45:03', '2018-08-10 10:06:44', NULL),
(191, 29, 2, 30, 17, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-03 01:45:03', '2018-08-10 05:19:59', NULL),
(192, 29, 1, 31, 59, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-03 01:45:03', '2018-08-10 05:03:07', NULL),
(193, 29, 2, 31, 18, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-03 01:45:03', '2018-08-10 05:03:07', NULL),
(194, 29, 1, 32, 60, 69, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-03 01:45:03', '2018-08-10 05:03:07', NULL),
(195, 7, 1, 8, 6, 143, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-10 05:35:46', '2018-08-10 05:35:46', NULL),
(196, 8, 1, 9, 7, 144, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-10 06:36:19', '2018-08-10 06:36:19', NULL),
(197, 8, 1, 9, 8, 144, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-10 06:36:19', '2018-08-10 06:36:19', NULL),
(198, 8, 1, 11, 10, 144, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-10 06:36:19', '2018-08-10 06:36:19', NULL),
(199, 8, 2, 11, 7, 144, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-10 06:36:19', '2018-08-10 06:36:19', NULL),
(200, 8, 1, 11, 12, 144, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-10 06:36:19', '2018-08-10 06:36:19', NULL),
(201, 9, 1, 6, 9, 145, '', '00:00:00', 'no', 0, 'no', NULL, '2018-08-10 06:40:11', '2018-08-10 06:40:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subject_slug` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` enum('1','0') DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject_slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'math', '1', '2018-08-02 09:25:36', '2018-08-02 03:55:36', NULL),
(2, 'english', '1', '2018-08-02 09:25:36', '2018-08-02 03:55:36', NULL),
(3, 'marathi', '1', '2018-08-02 09:25:36', '2018-08-02 03:55:36', NULL),
(4, 'history', '1', '2018-08-02 09:25:36', '2018-08-02 03:55:36', NULL),
(5, 'test', '1', '2018-07-20 06:38:22', '2018-07-20 01:08:22', '2018-07-20 01:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `subject_translation`
--

CREATE TABLE `subject_translation` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `locale` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_translation`
--

INSERT INTO `subject_translation` (`id`, `subject_id`, `name`, `locale`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Math', 'en', '2018-07-03 23:56:18', '2018-07-03 23:56:18', NULL),
(2, 1, '数学', 'cn', '2018-07-04 05:50:25', '2018-07-03 23:56:18', NULL),
(3, 2, 'English', 'en', '2018-07-03 23:56:28', '2018-07-03 23:56:28', NULL),
(4, 2, '英语', 'cn', '2018-08-03 06:49:43', '2018-07-03 23:56:28', NULL),
(5, 3, 'Marathi', 'en', '2018-07-03 23:56:39', '2018-07-03 23:56:39', NULL),
(6, 3, '马拉', 'cn', '2018-08-03 06:49:54', '2018-07-03 23:56:39', NULL),
(7, 4, 'History', 'en', '2018-07-03 23:56:50', '2018-07-03 23:56:50', NULL),
(8, 4, '历史', 'cn', '2018-08-03 06:50:03', '2018-07-03 23:56:50', NULL),
(9, 5, 'Test', 'en', '2018-08-03 06:50:15', '2018-07-20 01:08:22', '2018-07-20 01:08:22'),
(10, 5, '测试', 'cn', '2018-08-03 06:50:16', '2018-07-20 01:08:22', '2018-07-20 01:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `status`, `created_at`, `updated_at`) VALUES
(2, 'kavitag@webwing.com', '1', '2018-06-18 12:12:47', '2018-06-18 06:42:47'),
(3, 'priyankak@webwing.com', '1', '2018-06-18 12:12:47', '2018-06-18 06:42:47'),
(4, 'mayurip@webwing.com', '1', '2018-06-18 12:12:47', '2018-06-18 06:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan`
--

CREATE TABLE `subscription_plan` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 NOT NULL,
  `price` double(10,2) NOT NULL,
  `scrash_price1` double(10,2) NOT NULL,
  `scrash_price2` double(10,2) NOT NULL,
  `per_day_price` double(10,2) NOT NULL,
  `validity` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_plan`
--

INSERT INTO `subscription_plan` (`id`, `slug`, `price`, `scrash_price1`, `scrash_price2`, `per_day_price`, `validity`, `status`, `created_at`, `updated_at`) VALUES
(1, '1-year', 100.00, 700.00, 2.30, 1.37, '1 year', '1', '2018-06-15 03:35:41', '2018-08-08 06:01:15'),
(2, '3-year', 200.00, 1200.00, 3.29, 2.74, '3 year', '1', '2018-06-15 03:46:48', '2018-08-08 06:03:35'),
(3, '5-year', 300.00, 1700.00, 4.66, 4.11, '5 year', '1', '2018-06-15 23:54:14', '2018-08-08 06:03:42'),
(4, 'life-time', 400.00, 2200.00, 6.03, 5.48, 'life time', '1', '2018-06-15 23:54:14', '2018-08-08 06:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan_translation`
--

CREATE TABLE `subscription_plan_translation` (
  `id` int(11) NOT NULL,
  `subscription_plan_id` int(11) NOT NULL,
  `locale` varchar(10) CHARACTER SET utf8 NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `details` text CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_plan_translation`
--

INSERT INTO `subscription_plan_translation` (`id`, `subscription_plan_id`, `locale`, `name`, `details`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', '1 Year', 'Parents can pay monthly for the classes', '2018-06-15 03:35:41', '2018-07-10 06:58:21'),
(2, 1, 'cn', '每月一次', '家长可以按月支付课程费用', '2018-06-15 03:35:41', '2018-07-04 07:57:01'),
(3, 2, 'en', '3 Year', 'Parents can pay yearly for the classes', '2018-06-15 03:46:48', '2018-07-10 06:58:25'),
(4, 2, 'cn', '每年', '家长可以每年为课程付费', '2018-06-15 03:46:48', '2018-06-15 03:46:48'),
(5, 3, 'en', '5 Year', '545435345', '2018-06-15 23:54:14', '2018-07-10 06:58:27'),
(6, 3, 'cn', '43534', '43534', '2018-06-15 23:54:14', '2018-06-15 23:54:14'),
(7, 4, 'en', 'Life Time', 'sdfsdf', '2018-06-16 00:53:22', '2018-07-08 23:57:22'),
(8, 4, 'cn', 'sdfsdf', 'sddfsdf', '2018-06-16 00:53:22', '2018-06-16 00:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `type`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'read_the_paragraph', 'Template 1', 'template_1.jpg', '2018-06-22 06:36:47', '2018-07-09 08:55:17'),
(2, 'fill_in_the_blanks', 'Template 2', 'template_2.jpg', '2018-06-22 06:37:00', '2018-07-09 08:55:22'),
(3, 'circle_the_letter', 'Template 3', 'template_3.jpg', '2018-06-22 06:37:24', '2018-07-09 08:55:26'),
(4, 'circle_the_word', 'Template 4', 'template_4.jpg', '2018-06-22 06:38:18', '2018-07-11 06:22:24'),
(5, 'objective', 'Template 5', 'template_5.jpg', '2018-06-22 06:38:18', '2018-07-11 06:22:31'),
(6, 'trace_the_letter', 'Template 6', 'template_6.jpg', '2018-06-22 06:38:18', '2018-07-12 06:28:43'),
(7, 'objective', 'Template 7', 'template_7.jpg', '2018-06-22 06:38:18', '2018-07-12 06:28:52'),
(8, 'match_with_drag', 'Template 8', 'template_8.jpg', '2018-06-22 06:38:18', '2018-07-12 12:43:49'),
(9, 'fill_in_the_blanks', 'Template 9', 'template_9.jpg', '2018-06-25 11:50:28', '2018-07-12 06:29:12'),
(10, 'match_with_drag', 'Template 10', 'template_10.jpg', '2018-06-25 11:50:28', '2018-07-21 03:57:29'),
(11, 'circle_the_word', 'Template 11', 'template_11.jpg', '2018-06-25 11:50:28', '2018-07-21 03:58:32'),
(12, 'match_with_lines', 'Template 12', 'template_12.jpg', '2018-06-25 11:50:28', '2018-07-21 03:58:49'),
(13, 'fill_in_the_blanks', 'Template 13', 'template_13.jpg', '2018-06-25 11:50:28', '2018-07-21 03:58:57'),
(14, 'match_with_lines', 'Template 14', 'template_14.jpg', '2018-06-25 11:50:28', '2018-07-21 03:59:05'),
(15, 'fill_in_the_blanks', 'Template 15', 'template_15.jpg', '2018-06-25 11:50:28', '2018-07-21 03:59:10'),
(16, 'fill_in_the_blanks', 'Template 16', 'template_16.jpg', '2018-06-25 11:50:28', '2018-07-21 03:59:20'),
(17, 'fill_in_the_blanks', 'Template 17', 'template_17.jpg', '2018-06-25 11:50:28', '2018-07-21 03:59:26'),
(18, 'fill_in_the_blanks', 'Template 18', 'template_18.jpg', '2018-06-25 11:50:28', '2018-07-23 05:57:25'),
(19, 'fill_in_the_blanks', 'Template 19', 'template_19.jpg', '2018-06-25 11:50:28', '2018-07-23 05:57:35'),
(20, 'fill_in_the_blanks', 'Template 20', 'template_20.jpg', '2018-06-25 11:50:28', '2018-07-23 05:57:41'),
(21, 'circle_the_word', 'Template 21', 'template_21.jpg', '2018-06-25 11:50:28', '2018-07-23 05:57:47'),
(22, 'fill_in_the_blanks', 'Template 22', 'template_22.jpg', '2018-06-25 11:50:28', '2018-07-23 05:57:53'),
(23, 'fill_in_the_blanks', 'Template 23', 'template_23.jpg', '2018-06-25 11:50:28', '2018-07-23 05:57:58'),
(24, 'read_the_paragraph', 'Template 24', 'template_24.jpg', '2018-06-25 11:50:28', '2018-07-23 05:58:04'),
(25, 'match_with_lines', 'Template 25', 'template_25.jpg', '2018-06-25 11:50:28', '2018-07-23 05:58:10'),
(26, 'input_the_paragraph', 'Template 26', 'template_26.jpg', '2018-06-25 11:50:28', '2018-07-23 05:58:25'),
(27, 'circle_the_word', 'Template 27', 'template_27.jpg', '2018-06-25 11:50:28', '2018-07-23 05:58:35'),
(28, 'input_word', 'Template 28', 'template_28.jpg', '2018-06-25 11:50:28', '2018-07-23 05:58:42'),
(29, 'input_word', 'Template 29', 'template_29.jpg', '2018-06-25 12:14:26', '2018-07-23 05:58:49'),
(30, 'circle_the_word', 'Template 30', 'template_30.jpg', '2018-06-25 12:14:26', '2018-07-23 05:58:55'),
(31, 'input_word', 'Template 31', 'template_31.jpg', '2018-06-25 12:14:26', '2018-07-23 05:59:01'),
(32, 'fill_in_the_blanks', 'Template 32', 'template_32.jpg', '2018-06-25 12:14:26', '2018-07-23 05:59:07'),
(33, 'circle_the_word', 'Template 33', 'template_33.jpg', '2018-06-25 12:14:26', '2018-07-23 05:59:13'),
(34, 'input_word', 'Template 34', 'template_34.jpg', '2018-06-25 12:14:26', '2018-07-23 05:59:20'),
(35, 'input_word', 'Template 35', 'template_35.jpg', '2018-06-25 12:14:26', '2018-07-23 05:59:26'),
(36, 'input_word', 'Template 36', 'template_36.jpg', '2018-06-25 12:14:26', '2018-07-23 05:59:35'),
(37, 'input_word', 'Template 37', 'template_37.jpg', '2018-06-25 12:14:26', '2018-07-23 05:59:41'),
(38, 'input_word', 'Template 38', 'template_38.jpg', '2018-06-25 12:14:26', '2018-07-23 05:59:48'),
(39, 'input_word', 'Template 39', 'template_39.jpg', '2018-06-25 12:14:26', '2018-07-23 05:59:54'),
(40, 'input_word', 'Template 40', 'template_40.jpg', '2018-06-25 12:14:26', '2018-07-23 06:00:02'),
(41, 'input_word', 'Template 41', 'template_41.jpg', '2018-06-25 12:14:26', '2018-07-23 06:00:09'),
(42, 'input_word', 'Template 42', 'template_42.jpg', '2018-06-25 12:14:26', '2018-07-23 06:00:16'),
(43, 'input_word', 'Template 43', 'template_43.jpg', '2018-06-25 12:14:26', '2018-07-23 06:00:24'),
(44, 'fill_in_the_blanks', 'Template 44', 'template_44.jpg', '2018-06-25 12:14:26', '2018-07-23 06:00:30'),
(45, 'input_word', 'Template 45', 'template_45.jpg', '2018-06-25 12:14:26', '2018-07-23 06:00:39'),
(46, 'fill_in_the_blanks', 'Template 46', 'template_46.jpg', '2018-06-25 12:14:26', '2018-07-23 06:14:10'),
(47, 'input_word', 'Template 47', 'template_47.jpg', '2018-06-25 12:14:26', '2018-07-23 06:14:15'),
(48, 'fill_in_the_blanks', 'Template 48', 'template_48.jpg', '2018-06-25 12:14:26', '2018-07-23 06:14:20'),
(49, 'fill_in_the_blanks', 'Template 49', 'template_49.jpg', '2018-06-25 12:14:48', '2018-07-23 06:14:26'),
(50, 'input_word', 'Template 50', 'template_50.jpg', '2018-06-25 12:14:48', '2018-07-23 06:14:36'),
(51, 'input_word', 'Template 51', 'template_51.jpg', '2018-06-25 12:14:48', '2018-07-23 06:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `template_1`
--

CREATE TABLE `template_1` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `file_type` enum('image','video') NOT NULL,
  `file` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `question_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `duration` time NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_1`
--

INSERT INTO `template_1` (`id`, `program_id`, `lesson_id`, `file_type`, `file`, `question`, `question_text`, `horn`, `duration`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 5, 6, 'image', '170720181531831197.jpg', '', 'HAT', '170720181531831197.mp3', '00:00:59', '1', '2018-07-17 07:09:57', '2018-07-19 09:50:55', NULL),
(6, 7, 8, 'image', '180720181531890946.jpg', '', 'dfgfdgdf', '180720181531890946.mp3', '00:00:59', '1', '2018-07-17 23:45:46', '2018-07-19 09:50:55', NULL),
(7, 8, 9, 'image', '180720181531893163.jpg', 'Question', 'HAT', '180720181531893163.mp3', '00:00:15', '1', '2018-07-18 00:22:43', '2018-07-30 05:04:55', NULL),
(8, 8, 9, 'image', '180720181531893182.png', '', 'CAT', '180720181531893182.mp3', '00:01:59', '1', '2018-07-18 00:23:02', '2018-07-21 11:14:29', NULL),
(9, 9, 6, 'video', '180720181531894060.mp4', '', 'HAT', '180720181531893964.mp3', '00:00:59', '1', '2018-07-18 00:36:04', '2018-07-19 09:50:55', NULL),
(10, 8, 11, 'image', '180720181531909205.jpg', 'Question', 'CARROON', '180720181531909205.mp3', '00:00:59', '1', '2018-07-18 04:50:05', '2018-07-30 05:04:52', NULL),
(12, 8, 11, 'image', '180720181531909551.jpg', '', 'FENCE', '180720181531909551.mp3', '00:00:59', '1', '2018-07-18 04:55:51', '2018-07-19 09:50:55', NULL),
(13, 6, 12, 'image', '190720181531977304.jpg', 'Question', 'HAT', '190720181531977304.mp3', '00:00:59', '1', '2018-07-18 23:45:04', '2018-07-30 05:04:57', NULL),
(14, 6, 12, 'image', '270720181532692165.jpg', 'sfdsfdsfdf fdf d fdf dfd', 'HAT 1', '190720181531977363.mp3', '00:00:59', '1', '2018-07-18 23:46:03', '2018-07-27 11:49:23', NULL),
(16, 10, 13, 'image', '240720181532437293.jpg', 'Question', 'HAT', '240720181532437293.mp3', '00:01:00', '1', '2018-07-24 07:31:33', '2018-07-30 05:04:58', NULL),
(19, 6, 12, 'image', '270720181532694133.png', 'fgdf dgdfgfdgdf', 'dfdsf dsfdsfdsf', '270720181532693884.mp3', '00:00:00', '1', '2018-07-27 06:48:04', '2018-07-27 12:22:11', NULL),
(20, 17, 19, 'video', '300720181532932233.mp4', 'Watch & read & get answer', 'DUCK', '300720181532932075.mp3', '00:00:00', '1', '2018-07-30 00:57:55', '2018-07-30 06:30:31', NULL),
(21, 17, 19, 'image', '300720181532932790.jpg', 'Test', 'ELEPHANT', '300720181532932790.mp3', '00:00:00', '1', '2018-07-30 01:09:50', '2018-07-30 01:09:50', NULL),
(22, 20, 21, 'image', '300720181532936365.jpg', 'dsds d', 'sdsds', '300720181532936365.mp3', '00:00:00', '1', '2018-07-30 02:09:25', '2018-07-30 02:09:25', NULL),
(29, 6, 12, 'image', '300720181532955807.jpg', 'sdfssadsadsasa', 'ssdsdsadsa', '300720181532955807.mp3', '00:00:31', '1', '2018-07-30 07:33:27', '2018-07-31 04:54:04', NULL),
(30, 23, 24, 'image', '300720181532961408.jpg', 'Read que', 'DUCK', '300720181532961408.mp3', '00:00:10', '1', '2018-07-30 09:06:48', '2018-07-30 09:06:48', NULL),
(31, 25, 26, 'image', '310720181533026357.jpg', 'Read a text', 'Duck', '310720181533026357.mp3', '00:00:20', '1', '2018-07-31 03:09:17', '2018-07-31 03:09:17', NULL),
(32, 6, 12, 'image', '010820181533123248.jpg', 'sadsadsad', 'sdsdsa', '010820181533123248.mp3', '00:00:02', '1', '2018-08-01 06:04:08', '2018-08-01 06:04:08', NULL),
(33, 6, 12, 'image', '010820181533123254.jpg', 'sadsadsad', 'sdsdsa', '010820181533123254.mp3', '00:00:02', '1', '2018-08-01 06:04:14', '2018-08-01 06:04:14', NULL),
(34, 6, 12, 'image', '010820181533123869.png', 'asdsdsadsa', 'asdsadsa', '010820181533123869.mp3', '00:00:01', '1', '2018-08-01 06:14:29', '2018-08-01 06:14:29', NULL),
(35, 6, 12, 'image', '010820181533123886.png', 'sadsadsa', 'sadsadsa', '010820181533123886.mp3', '00:00:01', '1', '2018-08-01 06:14:46', '2018-08-01 06:14:46', NULL),
(36, 6, 12, 'image', '010820181533124168.png', 'sadsadsa', 'sadsadsa', '010820181533124168.mp3', '00:00:01', '1', '2018-08-01 06:19:28', '2018-08-01 06:19:28', NULL),
(37, 6, 12, 'image', '010820181533125029.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125029.mp3', '00:00:05', '1', '2018-08-01 06:33:49', '2018-08-01 06:33:49', NULL),
(38, 6, 12, 'image', '010820181533125039.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125039.mp3', '00:00:05', '1', '2018-08-01 06:33:59', '2018-08-01 06:33:59', NULL),
(39, 6, 12, 'image', '010820181533125061.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125062.mp3', '00:00:05', '1', '2018-08-01 06:34:22', '2018-08-01 06:34:22', NULL),
(40, 6, 12, 'image', '010820181533125099.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125100.mp3', '00:00:05', '1', '2018-08-01 06:35:00', '2018-08-01 06:35:00', NULL),
(41, 6, 12, 'image', '010820181533125115.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125116.mp3', '00:00:05', '1', '2018-08-01 06:35:16', '2018-08-01 06:35:16', NULL),
(42, 6, 12, 'image', '010820181533125147.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125147.mp3', '00:00:05', '1', '2018-08-01 06:35:47', '2018-08-01 06:35:47', NULL),
(43, 6, 12, 'image', '010820181533125160.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125160.mp3', '00:00:05', '1', '2018-08-01 06:36:00', '2018-08-01 06:36:00', NULL),
(44, 6, 12, 'image', '010820181533125176.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125176.mp3', '00:00:05', '1', '2018-08-01 06:36:16', '2018-08-01 06:36:16', NULL),
(45, 6, 12, 'image', '010820181533125292.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125293.mp3', '00:00:05', '1', '2018-08-01 06:38:13', '2018-08-01 06:38:13', NULL),
(46, 6, 12, 'image', '010820181533125318.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125318.mp3', '00:00:05', '1', '2018-08-01 06:38:38', '2018-08-01 06:38:38', NULL),
(47, 6, 12, 'image', '010820181533125332.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125332.mp3', '00:00:05', '1', '2018-08-01 06:38:52', '2018-08-01 06:38:52', NULL),
(48, 6, 12, 'image', '010820181533125339.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125339.mp3', '00:00:05', '1', '2018-08-01 06:39:00', '2018-08-01 06:39:00', NULL),
(49, 6, 12, 'image', '010820181533125359.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125359.mp3', '00:00:05', '1', '2018-08-01 06:39:19', '2018-08-01 06:39:19', NULL),
(50, 6, 12, 'image', '010820181533125523.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125524.mp3', '00:00:05', '1', '2018-08-01 06:42:04', '2018-08-01 06:42:04', NULL),
(51, 6, 12, 'image', '010820181533125603.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125604.mp3', '00:00:05', '1', '2018-08-01 06:43:24', '2018-08-01 06:43:24', NULL),
(52, 6, 12, 'image', '010820181533125645.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125645.mp3', '00:00:05', '1', '2018-08-01 06:44:05', '2018-08-01 06:44:05', NULL),
(53, 6, 12, 'image', '010820181533125666.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125666.mp3', '00:00:05', '1', '2018-08-01 06:44:26', '2018-08-01 06:44:26', NULL),
(54, 6, 12, 'image', '010820181533125677.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds', '010820181533125677.mp3', '00:00:05', '1', '2018-08-01 06:44:37', '2018-08-01 06:44:37', NULL),
(55, 6, 12, 'image', '010820181533125688.png', 'asdfs sdfds fdsfds fdsf dsfdsf dsfds', 'sdf dfdsfdsfdsds fgfdgdf 1', '010820181533125688.mp3', '00:00:07', '1', '2018-08-01 06:44:48', '2018-08-09 12:09:08', NULL),
(57, 28, 29, 'image', '020820181533186277.png', 'Fill in the blanks', 'HAT', '020820181533186277.mp3', '00:00:10', '1', '2018-08-01 23:34:37', '2018-08-08 10:27:49', NULL),
(58, 29, 30, 'image', '030820181533280120.png', 'Fill in the Blanks', 'mouse', '030820181533280121.mp3', '00:02:00', '1', '2018-08-03 01:38:41', '2018-08-03 01:38:41', NULL),
(59, 29, 31, 'image', '030820181533280232.png', 'Fill in the blanks', 'bucket', '030820181533280232.mp3', '00:04:00', '1', '2018-08-03 01:40:32', '2018-08-03 01:40:32', NULL),
(60, 29, 32, 'image', '030820181533280351.png', 'fill in the blanks', 'can', '030820181533280351.mp3', '00:04:00', '1', '2018-08-03 01:42:31', '2018-08-03 01:42:31', NULL),
(61, 30, 33, 'image', '070820181533626253.png', 'asdsadsa', 'asdsdsa1', '070820181533626253.mp3', '00:00:05', '1', '2018-08-07 01:47:33', '2018-08-07 11:37:48', NULL),
(62, 31, 34, 'image', '100820181533891683.jpg', 'Read & answer it', 'DUCK', '100820181533891683.mp3', '00:00:05', '1', '2018-08-10 03:31:23', '2018-08-10 03:31:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_2`
--

CREATE TABLE `template_2` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `file_type` enum('image','video') NOT NULL,
  `file` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `question_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_position` varchar(255) NOT NULL COMMENT '0 = Blank',
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_2`
--

INSERT INTO `template_2` (`id`, `program_id`, `lesson_id`, `file_type`, `file`, `question`, `question_text`, `answer_position`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 5, 6, 'image', '170720181531831220.jpg', '', 'DUCK', '1100', '170720181531831220.mp3', '1', '00:01:00', '2018-07-17 07:10:20', '2018-07-24 12:24:45', NULL),
(3, 9, 10, 'image', '180720181531894214.jpg', '', 'DUCK', '1010', '180720181531894214.mp3', '1', '00:02:00', '2018-07-18 00:40:14', '2018-07-24 12:25:21', NULL),
(7, 8, 11, 'image', '180720181531909530.jpg', '', 'FOX', '110', '180720181531909530.mp3', '1', '00:01:30', '2018-07-18 04:55:30', '2018-07-24 12:25:51', NULL),
(9, 10, 6, 'image', '240720181532437320.jpg', '', 'DUCK', '1010', '240720181532437320.mp3', '1', '00:01:00', '2018-07-24 07:32:00', '2018-07-25 10:12:04', NULL),
(12, 6, 12, 'image', '270720181532694948.jpg', 'sadsad sadsadsadsa', 'ddsd', '1011', '270720181532694890.mp3', '1', '00:00:05', '2018-07-27 07:04:50', '2018-07-30 15:26:23', NULL),
(13, 17, 19, 'image', '300720181532932529.jpg', 'Fill in the blankls', 'DUCK', '1100', '300720181532932395.mp3', '1', '00:00:00', '2018-07-30 01:03:15', '2018-07-30 06:35:27', NULL),
(14, 6, 12, 'image', '300720181532962795.jpg', 'dsfds dsfsf dfdsff dsfds', 'DUCK', '1010', '300720181532962795.mp3', '1', '00:00:06', '2018-07-30 09:29:55', '2018-08-09 12:24:54', NULL),
(15, 25, 26, 'image', '310720181533026455.jpg', 'Fill the banks', 'ELEPHANT', '11011110', '310720181533026455.mp3', '1', '00:00:20', '2018-07-31 03:10:55', '2018-07-31 03:10:55', NULL),
(16, 28, 29, 'image', '020820181533186356.png', 'Fill in the blanks', 'DUCK', '0101', '020820181533186356.mp3', '1', '00:00:10', '2018-08-01 23:35:56', '2018-08-08 10:11:44', NULL),
(17, 29, 30, 'image', '030820181533280161.png', 'Fill in the Blanks', 'chips', '01001', '030820181533280162.mp3', '1', '00:02:00', '2018-08-03 01:39:22', '2018-08-08 10:11:51', NULL),
(18, 29, 31, 'image', '030820181533280274.png', 'Fill in the blanks', 'map', '100', '030820181533280274.mp3', '1', '00:04:00', '2018-08-03 01:41:14', '2018-08-03 01:41:14', NULL),
(19, 31, 34, 'image', '100820181533892196.jpg', 'Fill in the blank', 'DUCK', '1010', '100820181533892197.mp3', '1', '00:00:05', '2018-08-10 03:39:57', '2018-08-10 03:39:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_3`
--

CREATE TABLE `template_3` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_1_file` varchar(255) NOT NULL,
  `question_1_text` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `question_2_text` varchar(128) CHARACTER SET utf8 NOT NULL,
  `answer` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_3`
--

INSERT INTO `template_3` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_1_text`, `question_2_file`, `question_2_text`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 5, 6, 'Name the pictures out lout. Then,Circle the d in each Name', '1707201815318312861.jpg', 'DEER', '1707201815318312862.jpeg', 'BIRD', 'D', '170720181531831286.mp3', '1', '00:05:00', '2018-07-17 07:11:26', '2018-07-24 13:08:13', NULL),
(3, 9, 10, 'f dfsdfsdd dfsdfsd  fsd dfgdf gdf', '1807201815318943771.jpg', 'DEER', '1807201815318943772.jpeg', 'BIRD', 'D', '180720181531894377.mp3', '1', '00:04:00', '2018-07-18 00:42:57', '2018-07-24 13:08:36', NULL),
(4, 10, 6, 'Name the pictures out lout. Then,Circle the d in each Name', '2407201815324398181.jpg', 'DEER', '2407201815324398902.jpg', 'BIRD', 'D', '240720181532437361.mp3', '1', '00:03:30', '2018-07-24 07:32:41', '2018-07-24 13:44:48', NULL),
(5, 6, 12, 'sdsad sadsadsadas dsadsd sadsad', '2707201815326956641.png', 'flower', '2707201815326961142.jpg', 'glob', 'o', '270720181532695664.mp3', '1', '00:00:13', '2018-07-27 07:17:44', '2018-08-09 12:36:08', NULL),
(6, 17, 20, 'Name the pictures out lout. Then,Circle the d in each Name', '3007201815329327361.jpg', 'DEER', '3007201815329327362.jpg', 'BIRD', 'D', '300720181532932736.mp3', '1', '00:00:00', '2018-07-30 01:08:56', '2018-07-30 01:08:56', NULL),
(7, 25, 26, 'Name the pictures out lout. Then,Circle the d in each Name', '3107201815330265291.jpg', 'DEER', '3107201815330265292.jpg', 'BIRD', 'D', '310720181533026529.mp3', '1', '00:00:20', '2018-07-31 03:12:09', '2018-07-31 03:12:09', NULL),
(8, 28, 29, 'Name the pictures out lout. Then,Circle the d in each Name', '0208201815331865111.png', 'DEER', '0208201815331865112.png', 'BIRD', 'D', '020820181533186511.mp3', '1', '00:00:10', '2018-08-01 23:38:31', '2018-08-08 12:07:32', NULL),
(9, 31, 35, 'Name the pictures out lout. Then,Circle the d in each Name', '1008201815338922861.jpg', 'DEER', '1008201815338922862.jpg', 'BIRD', 'D', '100820181533892286.mp3', '1', '00:00:10', '2018-08-10 03:41:26', '2018-08-10 09:20:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_4`
--

CREATE TABLE `template_4` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_1_file` varchar(255) NOT NULL,
  `question_1_text` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `question_2_text` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_3_file` varchar(255) NOT NULL,
  `question_3_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_4`
--

INSERT INTO `template_4` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_1_text`, `question_2_file`, `question_2_text`, `question_3_file`, `question_3_text`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 5, 6, 'Say the sound in each box. circle each picture that begins with that sound.', '1707201815318314561.jpg', 'fence', '1707201815318314562.jpg', 'fox', '1707201815318314563.jpg', 'raccoon', '/f/', '170720181531831456.mp3', '1', '00:04:00', '2018-07-17 07:14:16', '2018-07-25 06:23:57', NULL),
(3, 10, 6, 'Say the sound in each box. circle each picture that begins with that sound.', '2407201815324374311.jpg', 'Fence', '2407201815324374312.jpg', 'Fox', '2407201815324374313.jpg', 'Raccoon', 'F', '240720181532437431.mp3', '1', '00:03:00', '2018-07-24 07:33:51', '2018-07-25 08:56:09', NULL),
(4, 6, 12, 'sadfsad sad asdasd as', '0308201815332994681.png', 'dsdsdsdsf1', '2707201815326992572.jpg', 'dsdsdsdsdss1', '2707201815326992573.jpg', 'scsxsdxs', 'f', '270720181532699257.mp3', '1', '00:00:06', '2018-07-27 08:17:37', '2018-08-09 13:01:20', NULL),
(5, 25, 26, 'Say the sound in each box. circle each picture that begins with that sound.', '3107201815330266921.png', 'Fence', '3107201815330266922.png', 'Fox', '3107201815330266923.png', 'Raccoon', 'f', '310720181533026692.mp3', '1', '00:00:21', '2018-07-31 03:14:52', '2018-07-31 09:15:51', NULL),
(6, 28, 29, 'Say the sound in each box. circle each picture that begins with that sound.', '0208201815331866161.png', 'fence', '0208201815331866162.png', 'fox', '0208201815331866163.png', 'racoon', 'f', '020820181533186616.mp3', '1', '00:00:10', '2018-08-01 23:40:16', '2018-08-08 10:30:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_5`
--

CREATE TABLE `template_5` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `file_type` enum('image','video') NOT NULL,
  `file` varchar(255) NOT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `option1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `option2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_5`
--

INSERT INTO `template_5` (`id`, `program_id`, `lesson_id`, `file_type`, `file`, `question`, `option1`, `option2`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 5, 6, 'image', '170720181531831558.jpg', 'Picture Clues', 'The squirrel is playing', 'The squirrel is eating', '2', '170720181531831558.mp3', '1', '00:00:00', '2018-07-17 07:15:58', '2018-07-17 07:15:58', NULL),
(3, 10, 6, 'image', '240720181532437474.jpg', 'Picture Clues', 'The squirrel is playing', 'The squirrel is eating', '2', '240720181532437474.mp3', '1', '00:04:00', '2018-07-24 07:34:34', '2018-07-25 09:28:48', NULL),
(4, 6, 12, 'image', '280720181532754660.jpg', 'sfddsdfds', 'dsssds', 'dsdsdsds', '2', '270720181532700601.mp3', '1', '00:01:23', '2018-07-27 08:40:01', '2018-08-09 13:01:55', NULL),
(5, 25, 26, 'image', '310720181533026867.png', 'Picture Clues', 'The squirrel is playing', 'The squirrel is eating', '1', '310720181533026867.mp3', '1', '00:00:20', '2018-07-31 03:17:47', '2018-07-31 03:17:48', NULL),
(6, 28, 29, 'image', '020820181533186834.png', 'Picture Clues', 'The squirrel is playing', 'The squirrel is eating', '2', '020820181533186834.mp3', '1', '00:00:10', '2018-08-01 23:43:55', '2018-08-04 06:25:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_6`
--

CREATE TABLE `template_6` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_file` varchar(255) NOT NULL,
  `option1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `option2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `answer` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_6`
--

INSERT INTO `template_6` (`id`, `program_id`, `lesson_id`, `question`, `question_file`, `option1`, `option2`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 11, 14, 'Choose the action word that goes with each picture', '2507201815325161621.mp4', 'Run', 'Throw', '1', '250720181532516162.mp3', '1', '00:04:00', '2018-07-25 05:26:02', '2018-07-25 12:34:09', NULL),
(2, 6, 12, 'sdsadsa', '3007201815329664621.mp4', 'sdsad', 'dsadsad', '1', '300720181532966462.mp3', '1', '00:00:06', '2018-07-30 10:31:02', '2018-08-06 06:33:00', NULL),
(3, 28, 29, 'Choose the action word that goes with each picture', '0208201815331868901.mp4', 'run', 'throw', '1', '020820181533186890.mp3', '1', '00:00:10', '2018-08-01 23:44:50', '2018-08-04 06:26:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_7`
--

CREATE TABLE `template_7` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_1_file` varchar(255) NOT NULL,
  `answer1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `answer2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_3_file` varchar(255) NOT NULL,
  `answer3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4_file` varchar(255) NOT NULL,
  `answer4` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_5_file` varchar(255) NOT NULL,
  `answer5` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_7`
--

INSERT INTO `template_7` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `answer1`, `question_2_file`, `answer2`, `question_3_file`, `answer3`, `question_4_file`, `answer4`, `question_5_file`, `answer5`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 11, 14, 'Match the correct position word to show where the mouse is', '2507201815325162671.jpg', 'in', '2507201815325162672.jpg', 'on', '2507201815325162673.jpg', 'under', '2507201815325162674.jpg', 'beside', '2507201815325162675.jpg', 'over', '250720181532516267.mp3', '1', '00:00:10', '2018-07-25 05:27:47', '2018-07-25 13:47:34', NULL),
(2, 6, 12, 'sadfs dsadsa dsa dsa dsadsa dsadsada', '2807201815327613481.jpg', 'sdsdsds', '2807201815327613782.jpg', 'sdsadasdsa', '2807201815327614223.jpeg', 'asdsadsadsa', '2807201815327614564.jpg', 'asdsadsadas', '2807201815327612645.jpeg', 'asdsadsadsadsa', '280720181532756500.mp3', '1', '00:00:00', '2018-07-28 00:11:40', '2018-07-28 07:04:14', NULL),
(4, 6, 12, 'sdf dfdf dsfdsf ds', '0308201815333005371.png', 'ddddfdsfdssdfds1', '2807201815327617992.png', 'fffffsdfdsfds1', '2807201815327617993.png', 'eeeee1', '2807201815327617994.png', 'ggggg1', '0608201815335372495.jpg', 'ggfgfgf1', '280720181532761759.mp3', '1', '00:00:08', '2018-07-28 01:39:19', '2018-08-06 06:34:09', NULL),
(5, 28, 29, 'Match the correct position word to show where the mouse is', '0208201815331870951.png', 'IN', '0208201815331870952.png', 'ON', '0208201815331870953.png', 'UNDER', '0208201815331870954.png', 'BESIDE', '0208201815331870955.png', 'OVER', '020820181533187095.mp3', '1', '00:02:00', '2018-08-01 23:48:15', '2018-08-01 23:48:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_8`
--

CREATE TABLE `template_8` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_1_file` varchar(255) NOT NULL,
  `question_1_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `question_2_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_8`
--

INSERT INTO `template_8` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_1_text`, `answer1`, `question_2_file`, `question_2_text`, `answer2`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 11, 14, 'Pick the correct position word for each sentence', '2507201815325163341.png', 'The cat is #BLANK#  the box', 'on', '2507201815325163342.jpg', 'The cat is #BLANK#  the box', 'beside', '250720181532516334.mp3', '1', '00:03:00', '2018-07-25 05:28:54', '2018-07-26 04:08:47', NULL),
(2, 6, 12, 'sdfsa sadsad sadsa', '3107201815330133141.jpg', 'sdds #BLANK# dsdsdsd sds dsds dsds ds', 'ssdsdfgf1', '3107201815330133152.jpg', 'sdds #BLANK# dsdsdsd sds dsds dsds ds1', 'fdfdfdfdfgfgf', '310720181533013315.mp3', '1', '00:00:10', '2018-07-30 23:31:55', '2018-08-06 06:34:35', NULL),
(3, 28, 29, 'Pick the correct position word for each sentence', '0208201815331872301.png', 'The mouse is #BLANK# the box', 'on', '0208201815331872312.png', 'The mouse is #BLANK# the box', 'beside', '020820181533187231.mp3', '1', '00:02:00', '2018-08-01 23:50:31', '2018-08-01 23:50:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_9`
--

CREATE TABLE `template_9` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `option1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `option2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `option3` varchar(128) CHARACTER SET utf8 NOT NULL,
  `option4` varchar(128) CHARACTER SET utf8 NOT NULL,
  `answer` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_9`
--

INSERT INTO `template_9` (`id`, `program_id`, `lesson_id`, `question`, `question_text`, `option1`, `option2`, `option3`, `option4`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 11, 14, 'Drag the correctly spelled word into the sentence.', 'We saw the art #BLANK# at the museum.', 'exhibiton', 'exhibition', 'exhition', 'exhiion', '2', '250720181532516449.mp3', '1', '00:05:00', '2018-07-25 05:30:49', '2018-07-26 04:41:59', NULL),
(2, 6, 12, 'sdfd fdsfd', 'sdfds fdsfds  fdsf #BLANK# sdfsd fdsfds fsdfs', 'aaaaaa1', 'bbbbbbb', 'cccccc', 'dddddddd', '2', '310720181533013480.mp3', '1', '00:00:09', '2018-07-30 23:34:40', '2018-08-06 06:36:34', NULL),
(3, 28, 29, 'Drag the correctly spelled word into sentence', 'We saw the art #BLANK# as the museum', 'exibet', 'exibit', 'exhibit', 'exhibiet', '3', '020820181533187434.mp3', '1', '00:02:00', '2018-08-01 23:53:54', '2018-08-01 23:53:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_10`
--

CREATE TABLE `template_10` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) NOT NULL,
  `question_text` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_file` varchar(255) NOT NULL,
  `option1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `option2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_10`
--

INSERT INTO `template_10` (`id`, `program_id`, `lesson_id`, `question`, `question_text`, `question_file`, `option1`, `option2`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, 15, '', '#BLANK# spill the paint!', '2607201815325874551.png', 'She', 'They', '2', '260720181532587455.mp3', '1', '00:15:00', '2018-07-26 01:14:15', '2018-07-26 08:34:38', NULL),
(2, 6, 12, 'sadsad sadsad sadsadsad sa', 'sad sdsad   sadsa das #BLANK# dfds fsd', '3107201815330137351.jpg', 'dfdsfds1', 'erfererer1', '2', '310720181533013735.mp3', '1', '00:00:11', '2018-07-30 23:38:55', '2018-08-06 08:17:04', NULL),
(3, 28, 29, 'a pic and one sentence', '#BLANK#  spill the paint!', '0208201815331875111.png', 'She', 'They', '2', '020820181533187512.mp3', '1', '00:02:00', '2018-08-01 23:55:12', '2018-08-01 23:55:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_11`
--

CREATE TABLE `template_11` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_1_file` varchar(255) NOT NULL,
  `answer1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `answer2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_3_file` varchar(255) NOT NULL,
  `answer3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4_file` varchar(255) NOT NULL,
  `answer4` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_11`
--

INSERT INTO `template_11` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `answer1`, `question_2_file`, `answer2`, `question_3_file`, `answer3`, `question_4_file`, `answer4`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 12, 'Match each pronoun to the person or thing it names', '1907201815319905531.jpeg', 'He', '1907201815319852922.jpg', 'They', '1907201815319852923.jpeg', 'She', '1907201815319911524.jpg', 'It', '190720181531990597.mp3', '1', '00:05:00', '2018-07-19 01:58:12', '2018-07-30 08:45:36', NULL),
(2, 13, 15, 'Match each pronoun to the person or thing it names', '3007201815329448551.png', 'he', '3007201815329448552.png', 'they', '3007201815329448553.png', 'she', '3007201815329448554.png', 'it', '260720181532587547.mp3', '1', '00:05:00', '2018-07-26 01:15:47', '2018-07-30 10:00:52', NULL),
(3, 6, 12, 'Match each pronoun to the person or thing it names', '2707201815326733021.jpeg', 'He', '2707201815326733022.jpg', 'They', '2707201815326733023.jpeg', 'She', '2707201815326733024.jpg', 'It', NULL, '1', '00:05:00', '2018-07-27 01:05:02', '2018-07-30 08:45:40', NULL),
(4, 6, 12, 'sdsdsa sad sadsa sadsa dsadsa dsada', '3107201815330141141.jpg', 'sadsad sa1', '3107201815330141142.jpg', 'sadsa', '3107201815330141143.jpg', 'sadsadsadsd', '3107201815330141154.jpg', 'sadsadsa', NULL, '1', '00:00:10', '2018-07-30 23:45:15', '2018-08-06 06:37:11', NULL),
(5, 28, 29, 'Match each pronoun to the person or thing it names', '0208201815331877371.png', 'it', '0208201815331877382.png', 'she', '0208201815331877383.png', 'he', '0208201815331877384.png', 'they', NULL, '1', '00:02:00', '2018-08-01 23:58:58', '2018-08-01 23:58:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_12`
--

CREATE TABLE `template_12` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_1_file` varchar(255) NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `answer2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_12`
--

INSERT INTO `template_12` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_2_file`, `answer2`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Write a word that rhymes with each world on the left', '1907201815319944841.jpeg', '1907201815319954812.jpg', 'Letter', '190720181531995508.mp3', '1', '00:05:00', '2018-07-19 04:31:24', '2018-07-26 10:05:42', NULL),
(3, 13, 15, 'Write a word that rhymes with each world on the left', '2607201815325875831.jpeg', '2607201815325875832.jpg', 'Letter', '260720181532587583.mp3', '1', '00:05:00', '2018-07-26 01:16:23', '2018-07-26 10:05:40', NULL),
(4, 6, 12, 'asdsd s', '3107201815330143411.jpg', '3107201815330143412.jpg', 'edgfdgfgf1', '310720181533014341.mp3', '1', '00:00:30', '2018-07-30 23:49:01', '2018-08-06 06:37:23', NULL),
(5, 28, 29, 'Write a word that rhymes with each world on the left', '0208201815331877901.png', '0208201815331877902.png', 'letter', '020820181533187790.mp3', '1', '00:02:00', '2018-08-01 23:59:50', '2018-08-01 23:59:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_13`
--

CREATE TABLE `template_13` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_1_file` varchar(255) NOT NULL,
  `answer1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `answer2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_3_file` varchar(255) NOT NULL,
  `answer3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4_file` varchar(255) NOT NULL,
  `answer4` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_5_file` varchar(255) NOT NULL,
  `answer5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_6_file` varchar(255) NOT NULL,
  `answer6` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_13`
--

INSERT INTO `template_13` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `answer1`, `question_2_file`, `answer2`, `question_3_file`, `answer3`, `question_4_file`, `answer4`, `question_5_file`, `answer5`, `question_6_file`, `answer6`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Draw lines to match each picture to its name', '1907201815320021661.jpg', 'Hook', '1907201815320021662.jpg', 'Hood', '1907201815320021663.jpeg', 'Wood', '1907201815320021664.png', 'Football', '1907201815320021665.jpg', 'Brook', '1907201815320021666.jpg', 'Foot', '190720181532002166.mp3', '1', '00:05:00', '2018-07-19 06:39:26', '2018-07-26 10:57:24', NULL),
(3, 13, 15, 'Draw lines to match each picture to its name', '3007201815329516171.png', 'hook', '3007201815329516172.png', 'hood', '3007201815329516173.png', 'wood', '3007201815329516174.png', 'football', '3007201815329516175.png', 'brook', '3007201815329516176.png', 'foot', '260720181532587823.mp3', '1', '00:05:00', '2018-07-26 01:20:23', '2018-07-30 11:53:34', NULL),
(4, 6, 12, 'sdsadsa', '3107201815330144861.jpg', 'ddfdsfdsfdsfdsfsd', '3107201815330144862.jpg', 'dfdsfdsdfds1', '3107201815330144863.jpg', 'ffdfddfdsfds', '3107201815330144864.jpg', 'ddfdfdfddsfds', '3107201815330144865.jpg', 'dfdfdfdssfd', '0608201815335374616.jpg', 'fdsffdsfdsfdsdsfds', '310720181533014486.mp3', '1', '00:00:14', '2018-07-30 23:51:26', '2018-08-06 06:37:40', NULL),
(5, 28, 29, 'Draw lines to match each picture to its name', '0208201815331878971.png', 'hook', '0208201815331878972.png', 'brook', '0208201815331878973.png', 'hood', '0208201815331878974.png', 'football', '0208201815331878975.png', 'foot', '0208201815331878976.png', 'wood', '020820181533187897.mp3', '1', '00:02:00', '2018-08-02 00:01:37', '2018-08-02 00:01:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_14`
--

CREATE TABLE `template_14` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_1_file` varchar(255) NOT NULL,
  `answer1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `answer2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_3_file` varchar(255) NOT NULL,
  `answer3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4_file` varchar(255) NOT NULL,
  `answer4` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_5_file` varchar(255) NOT NULL,
  `answer5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_6_file` varchar(255) NOT NULL,
  `answer6` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_14`
--

INSERT INTO `template_14` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `answer1`, `question_2_file`, `answer2`, `question_3_file`, `answer3`, `question_4_file`, `answer4`, `question_5_file`, `answer5`, `question_6_file`, `answer6`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Enter write spelling', '1907201815320038851.jpg', 'Tray', '1907201815320038852.jpg', 'Book', '1907201815320038853.png', 'Dog', '1907201815320038854.jpg', 'Buildings', '1907201815320044385.jpg', 'Teeth', '1907201815320042586.jpg', 'Stool', '190720181532004438.mp3', '1', '00:05:00', '2018-07-19 07:08:05', '2018-07-26 10:59:36', NULL),
(3, 13, 15, 'Gess & answer', '2607201815325879451.jpg', 'tray', '2607201815325879452.jpg', 'book', '2607201815325879453.png', 'puppy', '2607201815325879454.jpg', 'city', '2607201815325879455.jpg', 'tooth', '2607201815325879456.jpg', 'stool', '260720181532587945.mp3', '1', '00:05:00', '2018-07-26 01:22:25', '2018-07-26 10:59:38', NULL),
(4, 6, 12, 'sadsa dsad sadas dsad', '3107201815330147261.jpg', 'sdsdsg1', '3107201815330147262.jpg', 'sfsdsdsg2', '3107201815330147273.jpg', 'dsdsdsg1', '3107201815330147274.jpg', 'dsdsdsg2', '0608201815335375115.png', 'sdsdsdg1', '3107201815330147276.jpg', 'sdsdsdsdsg2', '310720181533014727.mp3', '1', '00:00:14', '2018-07-30 23:55:27', '2018-08-06 06:38:30', NULL),
(5, 28, 29, 'Fill in the blanks', '0208201815331880191.png', 'puppy', '0208201815331880192.png', 'city', '0208201815331880193.png', 'book', '0208201815331880194.png', 'tray', '0208201815331880195.png', 'stool', '0208201815331880196.png', 'tooth', '020820181533188019.mp3', '1', '00:02:00', '2018-08-02 00:03:39', '2018-08-02 00:03:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_15`
--

CREATE TABLE `template_15` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1_file` varchar(255) NOT NULL,
  `question_1_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_1_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_1_answer_position` varchar(255) NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `question_2_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2_answer_position` varchar(255) NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_15`
--

INSERT INTO `template_15` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_1_text`, `question_1_answer`, `question_1_answer_position`, `question_2_file`, `question_2_text`, `question_2_answer`, `question_2_answer_position`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Write the missing letter or letters to complete', '2007201815320938331.jpeg', 'CAN', 'A', '101', '2007201815320909672.jpeg', 'MAP', 'M', '011', '200720181532093904.mp3', '1', '00:05:00', '2018-07-20 07:19:27', '2018-07-26 11:25:30', NULL),
(3, 13, 15, 'Write the missing letter or letters to complete', '2607201815325880031.jpeg', 'CAN', 'C', '011', '2607201815325880032.jpeg', 'MAP', 'A', '101', '260720181532588003.mp3', '1', '00:05:00', '2018-07-26 01:23:23', '2018-07-26 11:25:31', NULL),
(4, 6, 12, 'sads sad sadsadsa dsadsa', '3107201815330148691.jpg', 'sdfdsdfsf', 'f', '110111111', '3107201815330148692.jpg', 'sdfdsfdsfds1', '1', '111111111110', '310720181533014869.mp3', '1', '00:00:16', '2018-07-30 23:57:49', '2018-08-06 06:38:46', NULL),
(5, 28, 29, 'Write the missing letter or letters to complete', '0208201815331881231.png', 'CAN', 'A', '101', '0208201815331881232.png', 'MAP', 'A', '101', '020820181533188123.mp3', '1', '00:02:00', '2018-08-02 00:05:23', '2018-08-02 00:05:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_16`
--

CREATE TABLE `template_16` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_1_file` varchar(255) NOT NULL,
  `question_1_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `question_2_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_16`
--

INSERT INTO `template_16` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_1_text`, `answer1`, `question_2_file`, `question_2_text`, `answer2`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Fill in the banks', '2007201815320619791.jpg', 'Dad had the frog in a #BLANK# .', 'net', '2007201815320615982.jpg', 'The bird sleeps in its #BLANK# .', 'nest', '200720181532061598.mp3', '1', '00:04:00', '2018-07-19 23:09:58', '2018-07-26 11:47:57', NULL),
(3, 13, 15, 'Select answer', '2607201815325881871.jpg', 'Dad had the frog in a #BLANK# .', 'net', '2607201815326064492.jpeg', 'The bird sleeps in its #BLANK# .', 'nest', '260720181532588187.mp3', '1', '00:04:00', '2018-07-26 01:26:27', '2018-07-26 12:00:47', NULL),
(4, 6, 12, 'add sads dsadsa dsa dsadsad sadas', '3107201815330149921.jpg', 'asd dsa  fsdfds fdsfdsfsd #BLANK# fgvhgfg', 'dfdfdfdsdfsds', '3107201815330149922.jpg', 'sdfs dfdsf dsf#BLANK# dsfd fdsfds fdsf', 'dfdfd1', '310720181533014992.mp3', '1', '00:00:16', '2018-07-30 23:59:52', '2018-08-06 06:40:13', NULL),
(5, 28, 29, 'fill in the blanks or drag words', '0208201815331882631.png', 'Dad had the frog in a #BLANK#.', 'net', '0208201815331882642.png', 'The bird sleeps in its #BLANK#.', 'nest', '020820181533188264.mp3', '1', '00:02:00', '2018-08-02 00:07:44', '2018-08-02 00:07:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_17`
--

CREATE TABLE `template_17` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_1_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_1_option1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_1_option2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_1_option3` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_1_answer` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2_option1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_option2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_option3` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_answer` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_17`
--

INSERT INTO `template_17` (`id`, `program_id`, `lesson_id`, `question`, `question_1_text`, `question_1_option1`, `question_1_option2`, `question_1_option3`, `question_1_answer`, `question_2_text`, `question_2_option1`, `question_2_option2`, `question_2_option3`, `question_2_answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Fill in the blank', 'Lisa put the hat in the #BLANK#', 'bone', 'box', 'nest', '2', 'A #BLANK# is a very large animal.', 'hag', 'hose', 'hog', '3', '200720181532076650.mp3', '1', '00:05:00', '2018-07-20 03:00:08', '2018-07-26 12:11:45', NULL),
(3, 13, 15, 'Question 17', 'Lisa put the hat in the #BLANK#', 'bone', 'box', 'nest', '2', 'A #BLANK# is a very large animal.', 'hag', 'hose', 'hog', '3', '260720181532588264.mp3', '1', '00:05:00', '2018-07-26 01:27:44', '2018-07-26 12:32:47', NULL),
(4, 6, 12, 'asdsad sadsa', 'dsadsadsadsa #BLANK# dsfds fdsfds fdsfgsd', 'sdsdss1', 'dsdsd', 'sdsds1', '1', 'dsadsadsadsa #BLANK# dsfds fdsfds fdsfgsd sfds dsfd sfdsfds fds', 'fdfdfdfd', 'fdfdfdfd', 'fdfdfdfd', '1', '310720181533015388.mp3', '1', '00:00:17', '2018-07-31 00:06:28', '2018-08-06 06:40:23', NULL),
(5, 28, 29, 'Select the right answer', 'Lisa put the hat in the #BLANK#', 'bone', 'box', 'nest', '2', 'A #BLANK# is a very large animal.', 'hag', 'hose', 'hog', '3', '020820181533188385.mp3', '1', '00:02:00', '2018-08-02 00:09:45', '2018-08-02 00:09:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_18`
--

CREATE TABLE `template_18` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1_file` varchar(255) NOT NULL,
  `question_1_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_1_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_1_answer_position` varchar(255) NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `question_2_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2_answer_position` varchar(255) NOT NULL,
  `question_3_file` varchar(255) NOT NULL,
  `question_3_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_3_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_3_answer_position` varchar(255) NOT NULL,
  `question_4_file` varchar(255) NOT NULL,
  `question_4_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4_answer_position` varchar(255) NOT NULL,
  `question_5_file` varchar(255) NOT NULL,
  `question_5_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_5_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_5_answer_position` varchar(255) NOT NULL,
  `question_6_file` varchar(255) NOT NULL,
  `question_6_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_6_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_6_answer_position` varchar(255) NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_18`
--

INSERT INTO `template_18` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_1_text`, `question_1_answer`, `question_1_answer_position`, `question_2_file`, `question_2_text`, `question_2_answer`, `question_2_answer_position`, `question_3_file`, `question_3_text`, `question_3_answer`, `question_3_answer_position`, `question_4_file`, `question_4_text`, `question_4_answer`, `question_4_answer_position`, `question_5_file`, `question_5_text`, `question_5_answer`, `question_5_answer_position`, `question_6_file`, `question_6_text`, `question_6_answer`, `question_6_answer_position`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Fill in the blanks', '2107201815321568811.jpg', 'flower', 'fl', '001111', '2107201815321568812.jpeg', 'block', 'bl', '00111', '2107201815321724233.jpg', 'flag', 'fl', '0011', '2107201815321568814.jpg', 'glob', 'gl', '0011', '2107201815321568815.jpeg', 'plate', 'pl', '00111', '2107201815321568816.jpg', 'clam', 'cl', '0011', '210720181532156881.mp3', '1', '00:05:00', '2018-07-21 01:38:01', '2018-07-27 04:26:46', NULL),
(3, 13, 15, 'Question 18', '2707201815326722371.png', 'flower', 'fl', '001111', '2607201815325883782.jpeg', 'block', 'bl', '00111', '2607201815325883783.jpg', 'flag', 'fl', '0011', '2707201815326720694.jpg', 'globe', 'gl', '00111', '2607201815325883785.jpeg', 'plate', 'pl', '00111', '2707201815326722926.jpg', 'clam', 'cl', '0011', '260720181532588378.mp3', '1', '00:05:00', '2018-07-26 01:29:38', '2018-07-27 06:18:10', NULL),
(4, 6, 12, 'sadfsdsad sadsad sa', '3107201815330155511.png', 'sdsds', 'ds', '10011', '3107201815330155512.jpg', 'sdsd', 'sd', '0110', '3107201815330155513.jpg', 'sds', 'd', '101', '3107201815330155514.jpg', 'dsd', 'd', '011', '3107201815330155515.jpg', 'dsds', 'd', '0111', '3107201815330155516.jpg', 'sdsd', 's', '0111', '310720181533015551.mp3', '1', '00:00:19', '2018-07-31 00:09:11', '2018-08-06 06:40:39', NULL),
(5, 28, 29, 'Fill in the blanks or drag words', '0208201815331885291.png', 'FLOWER', 'FL', '001111', '0208201815331885292.png', 'BLOCK', 'BL', '00111', '0208201815331885293.png', 'FLAG', 'FL', '0011', '0208201815331885294.png', 'GLOBE', 'GL', '00111', '0208201815331885295.png', 'PLATE', 'PL', '00111', '0208201815331885296.png', 'CLAM', 'CL', '0011', '020820181533188529.mp3', '1', '00:02:00', '2018-08-02 00:12:09', '2018-08-02 00:12:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_19`
--

CREATE TABLE `template_19` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1_file` varchar(255) NOT NULL,
  `question_1_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `question_2_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_3_file` varchar(255) NOT NULL,
  `question_3_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4_file` varchar(255) NOT NULL,
  `question_4_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_5_file` varchar(255) NOT NULL,
  `question_5_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_6_file` varchar(255) NOT NULL,
  `question_6_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_19`
--

INSERT INTO `template_19` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_1_answer`, `question_2_file`, `question_2_answer`, `question_3_file`, `question_3_answer`, `question_4_file`, `question_4_answer`, `question_5_file`, `question_5_answer`, `question_6_file`, `question_6_answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 6, 12, 'Fill the blanks', '2107201815321753741.jpg', 'flower', '2107201815321753112.jpeg', 'block', '2107201815321753113.jpg', 'flag', '2107201815321753114.jpg', 'glob', '2107201815321753115.jpeg', 'plate', '2107201815321753116.jpg', 'clam', '210720181532175374.mp3', '1', '00:05:04', '2018-07-21 06:45:11', '2018-07-31 05:42:35', NULL),
(4, 13, 15, 'Question 19', '2707201815326723601.png', 'flower', '2607201815325884502.jpeg', 'block', '2607201815325884503.jpg', 'flag', '2707201815326723604.jpg', 'glob', '2607201815325884505.jpeg', 'plate', '2707201815326723606.jpg', 'clam', '260720181532588450.mp3', '1', '00:05:00', '2018-07-26 01:30:50', '2018-07-27 06:19:18', NULL),
(5, 28, 29, 'Fill in the blanks or drag the words', '0208201815331886291.png', 'flower', '0208201815331886292.png', 'blocks', '0208201815331886293.png', 'flag', '0208201815331886294.png', 'globe', '0208201815331886295.png', 'plate', '0208201815331886296.png', 'clam', '020820181533188629.mp3', '1', '00:02:00', '2018-08-02 00:13:49', '2018-08-02 00:13:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_20`
--

CREATE TABLE `template_20` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1_file` varchar(255) NOT NULL,
  `question_1_option1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_1_option2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_1_option3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_1_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `question_2_option1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2_option2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2_option3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2_answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_20`
--

INSERT INTO `template_20` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_1_option1`, `question_1_option2`, `question_1_option3`, `question_1_answer`, `question_2_file`, `question_2_option1`, `question_2_option2`, `question_2_option3`, `question_2_answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Choose corect answer', '2107201815321796911.jpg', 'mop', 'block', 'jog', '1', '2107201815321786462.jpg', 'stop', 'frog', 'rob', '2', '210720181532178646.mp3', '1', '00:04:51', '2018-07-21 07:40:46', '2018-08-06 06:41:13', NULL),
(3, 13, 15, 'Question 20', '2607201815325885061.jpg', 'mop', 'block', 'jog', '1', '2607201815325885062.jpg', 'stop', 'frog', 'rob', '2', '260720181532588506.mp3', '1', '00:05:00', '2018-07-26 01:31:46', '2018-07-27 06:27:40', NULL),
(4, 28, 29, 'Select the right answer', '0208201815331887011.png', 'stop', 'frog', 'rob', '2', '0208201815331887022.png', 'mop', 'block', 'jog', '1', '020820181533188702.mp3', '1', '00:02:00', '2018-08-02 00:15:02', '2018-08-02 00:15:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_21`
--

CREATE TABLE `template_21` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_6` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_6` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_21`
--

INSERT INTO `template_21` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `answer_1`, `question_2`, `answer_2`, `question_3`, `answer_3`, `question_4`, `answer_4`, `question_5`, `answer_5`, `question_6`, `answer_6`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Solve Angle & Triangle Questions', 'How many right angles are there?', '5', 'How many obtuse angles are there?', '4', 'How many acute angles are there?', '3', 'How many equilateral triangles are there?', '2', 'How many isosceles triangles are there?', '1', 'How many scalence triangles are there?', '6', '240720181532435984.mp3', '1', '00:05:05', '2018-07-22 00:53:12', '2018-08-06 06:41:26', NULL),
(3, 14, 16, 'On the line, write the base word.', 'mixes', 'mix', 'fries', 'fry', 'talks', 'talk', 'claps', 'clap', 'cries', 'cry', 'hisses', 'hiss', '270720181532675968.mp3', '1', '00:05:00', '2018-07-27 01:49:28', '2018-07-27 09:18:43', NULL),
(4, 6, 12, 'sdf dsf dsfdsf dsfsdf sdfsdf sdf', 'dfgdfgfdgfd', 'gsfdfgdfsgfg', 'sdf', 'sdfgdfsd', 'sdfdsfds', 'fdsfdssdf', 'sdfdsfsdfdsfsdf', 'sddsfsd', 'dsfdsfdsf', 'fdsfdsfds', 'dsfdsfdssd', 'dsfsdf', '010820181533113821.mp3', '1', '00:00:01', '2018-08-01 03:27:01', '2018-08-01 03:27:01', NULL),
(5, 28, 29, 'On the line, write the base word', 'mixes', 'mix', 'fries', 'fry', 'talks', 'talk', 'claps', 'clap', 'cries', 'cry', 'hisses', 'hiss', '020820181533188767.mp3', '1', '00:02:00', '2018-08-02 00:16:07', '2018-08-02 00:16:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_22`
--

CREATE TABLE `template_22` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_22`
--

INSERT INTO `template_22` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `answer_1`, `question_2`, `answer_2`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'On the line, write the comparative form of the words in parentheses()', 'The #BLANK# place in the world that people live is Dallol.Ethiopia. It can be 145 degrees in the sun!(most hot)', 'most hot', 'Mr. Waialeale is #BLANK# place in the united states. It gets about 460 inches of rain per year.(most wet)', 'most wet', '220720181532242798.mp3', '1', '00:04:57', '2018-07-22 01:21:42', '2018-07-31 05:47:18', NULL),
(3, 14, 16, 'On the line, write the comparative form of the words in parentheses()', 'The #BLANK# place in the world that people live is Dallol.Ethiopia. It can be 145 degrees in the sun!(most hot)', 'most hot', 'Mr. Waialeale is #BLANK# place in the united states. It gets about 460 inches of rain per year.(most wet)', 'most wet', '270720181532676111.mp3', '1', '00:05:00', '2018-07-27 01:51:51', '2018-07-27 10:18:02', NULL),
(4, 28, 29, 'On the line, write the comparative form of the words in parentheses()', 'The #BLANK# place in the world that people live is Dallol. Ethiopia. It can be 145 degrees in the sun!(most hot)', 'most hot', 'Mr. Waialeale is #BLANK# place in the united states. It gets about 460 inches of rain per year.(most wet)', 'most wet', '020820181533188867.mp3', '1', '00:02:00', '2018-08-02 00:17:47', '2018-08-02 00:17:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_23`
--

CREATE TABLE `template_23` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` text CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_23`
--

INSERT INTO `template_23` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Read a paragraph', 'Julia has not left house in a week.\r\nShe is getting over the chicken pox.\r\nJulia’s case of the chicken pox was not as bad as max’s was.\r\nJulia has not left house in a week.\r\nShe is getting over the chicken pox.\r\nJulia’s case of the chicken pox was not as bad as max’s was.', '220720181532244908.mp3', '1', '00:00:10', '2018-07-22 01:59:05', '2018-08-06 06:42:50', NULL),
(3, 14, 16, 'Read & Record', 'Julia has not left house in a week.\r\nShe is getting over the chicken pox.\r\nJulia’s case of the chicken pox was not as bad as max’s was.\r\nJulia has not left house in a week.\r\nShe is getting over the chicken pox.\r\nJulia’s case of the chicken pox was not as bad as max’s was.', '270720181532676178.mp3', '1', '00:00:10', '2018-07-27 01:52:58', '2018-07-27 11:17:08', NULL),
(4, 28, 29, 'Read Paragraph and Answer this', 'Julia has not left house in a week.\r\nShe is getting over the chicken pox.\r\nJulia’s case of the chicken pox was not as bad as max’s was.\r\nJulia has not left house in a week.\r\nShe is getting over the chicken pox.\r\nJulia’s case of the chicken pox was not as bad as max’s was.', '020820181533188935.mp3', '1', '00:02:00', '2018-08-02 00:18:55', '2018-08-02 00:18:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_24`
--

CREATE TABLE `template_24` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_6` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_6` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_7` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_7` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_8` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_8` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_24`
--

INSERT INTO `template_24` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `answer_1`, `question_2`, `answer_2`, `question_3`, `answer_3`, `question_4`, `answer_4`, `question_5`, `answer_5`, `question_6`, `answer_6`, `question_7`, `answer_7`, `question_8`, `answer_8`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Match the pairs', 'he would', 'he’d', 'I will', 'I’ll', 'did not', 'didn\'t', 'have not', 'haven’t', 'she is', 'she’s', 'they are', 'they’re', 'were not', 'weren’t', 'you have', 'you’ve', '220720181532246690.mp3', '1', '00:09:51', '2018-07-22 02:27:25', '2018-08-06 06:45:01', NULL),
(3, 14, 16, 'Match the pairs', 'he would', 'he’d', 'I will', 'I’ll', 'did not', 'didn\'t', 'have not', 'haven’t', 'she is', 'she’s', 'they are', 'they’re', 'were not', 'weren’t', 'you have', 'you’ve', '270720181532676275.mp3', '1', '00:10:00', '2018-07-27 01:54:35', '2018-07-30 12:28:31', NULL),
(4, 28, 29, 'Match the following', 'he would', 'he’d', 'I will', 'I’ll', 'did not', 'didn\'t', 'have not', 'haven’t', 'she is', 'she’s', 'they are', 'they’re', 'were not', 'weren’t', 'you have', 'you’ve', '020820181533189043.mp3', '1', '00:02:00', '2018-08-02 00:20:43', '2018-08-02 00:20:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_25`
--

CREATE TABLE `template_25` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` text CHARACTER SET utf8 NOT NULL,
  `question_1_file` varchar(255) NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_25`
--

INSERT INTO `template_25` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `question_1_file`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 6, 12, 'See video & read a paragraph', 'A cactus is a type of plant. It grows mostly in desert areas of the Americas. Cacti (the plural of cactus) are one of few plants that can live in the harsh conditions of deserts. Unlike most plants, cacti do not have leaves.Instead, they have sharp spines. The spines protect cacti from desert animals.', '2207201815322514701.mp4', '220720181532251470.mp3', '1', '00:05:06', '2018-07-22 03:54:30', '2018-08-06 06:45:11', NULL),
(4, 14, 16, 'Read & Record', 'A cactus is a type of plant. It grows mostly in desert areas of the Americas. Cacti (the plural of cactus) are one of few plants that can live in the harsh conditions of deserts. Unlike most plants, cacti do not have leaves. Instead, they have sharp spines. The spines protect cacti from desert animals.', '2707201815326763411.mp4', '270720181532676341.mp3', '1', '00:00:20', '2018-07-27 01:55:41', '2018-07-27 12:01:14', NULL),
(5, 28, 29, 'Read out loud the paragraph', 'A cactus is a type of plant. It grows mostly in desert\r\nareas of the Americas. Cacti (the plural of cactus) are\r\none of few plants that can live in the harsh conditions\r\nof deserts. Unlike most plants, cacti do not have leaves.\r\nInstead, they have sharp spines. The spines protect\r\ncacti from desert animals.', '0208201815331891201.mp4', '020820181533189120.mp3', '1', '00:05:00', '2018-08-02 00:22:00', '2018-08-02 00:22:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_26`
--

CREATE TABLE `template_26` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_1_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_1_option1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_1_option2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_1_option3` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_1_answer` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2_option1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_option2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_option3` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_2_answer` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_3_text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_3_option1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_3_option2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_3_option3` varchar(128) CHARACTER SET utf8 NOT NULL,
  `question_3_answer` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_26`
--

INSERT INTO `template_26` (`id`, `program_id`, `lesson_id`, `question`, `question_1_text`, `question_1_option1`, `question_1_option2`, `question_1_option3`, `question_1_answer`, `question_2_text`, `question_2_option1`, `question_2_option2`, `question_2_option3`, `question_2_answer`, `question_3_text`, `question_3_option1`, `question_3_option2`, `question_3_option3`, `question_3_answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Circle the word that best matches clue.', 'I am another word for great or wonderful', 'awful', 'terrific', 'old', '1', 'I am another word for tired', 'sleepy', 'worried', 'joyful', '2', 'I am another world for huge or enormous.', 'tiny', 'slippery', 'giant', '3', '220720181532254433.mp3', '1', '00:04:55', '2018-07-22 04:20:36', '2018-08-06 06:45:21', NULL),
(3, 15, 17, 'Circle the word that best matches clue.', 'I am another word for great or wonderful', 'awful', 'terrific', 'old', '2', 'I am another word for tired', 'sleepy', 'worried', 'joyful', '1', 'I am another world for huge or enormous.', 'tiny', 'slippery', 'giant', '3', '270720181532692358.mp3', '1', '00:05:00', '2018-07-27 06:22:38', '2018-07-27 12:11:44', NULL),
(4, 28, 29, 'Circle the word that best matches clue.', 'I am another word for great or wonderful', 'awful', 'terrific', 'old', '2', 'I am another word for tired', 'sleepy', 'worried', 'joyful', '1', 'I am another world for huge or enormous.', 'tiny', 'slippery', 'giant', '3', '020820181533189197.mp3', '1', '00:02:00', '2018-08-02 00:23:17', '2018-08-02 00:23:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_27`
--

CREATE TABLE `template_27` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_27`
--

INSERT INTO `template_27` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `answer_1`, `question_2`, `answer_2`, `question_3`, `answer_3`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Write the verb or verbs from each sentence on the lines.', 'Madeleine sang “Yesterday” by the Beatles for the talent show.', 'one,two,three', 'Eddie practiced his knock-knock jokes and riddles for weeks before the show', 'four,five,six', 'Vinh played two songs on the piano.', 'seven,eight,nine', '220720181532256845.mp3', '1', '00:04:59', '2018-07-22 05:08:24', '2018-08-06 06:45:43', NULL),
(3, 15, 17, 'Write the verb or verbs from each sentence on the lines.', 'Madeleine sang “Yesterday” by the Beatles for the talent show.', 'one,two,three', 'Eddie practiced his knock-knock jokes and riddles for weeks before the show', 'four,five', 'Vinh played two songs on the piano.', 'six,seven,eight,nine,ten', '270720181532692436.mp3', '1', '00:05:00', '2018-07-27 06:23:56', '2018-07-27 13:53:36', NULL),
(4, 28, 29, 'Write the verb or verbs from each sentence on the lines', 'Madeleine sang “Yesterday” by the Beatles for the talent show.', 'one,two,three,four,five', 'Eddie practiced his knock-knock jokes and riddles for weeks before the show', 'five,four,three,two,one,seven,six', 'Vinh played two songs on the piano.', 'five,four,three,two,one,seven,six,eight,nine,ten', '020820181533189293.mp3', '1', '00:00:30', '2018-08-02 00:24:53', '2018-08-10 07:30:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_28`
--

CREATE TABLE `template_28` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_28`
--

INSERT INTO `template_28` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `answer_1`, `question_2`, `answer_2`, `question_3`, `answer_3`, `question_4`, `answer_4`, `question_5`, `answer_5`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'If it is a complete sentence , write c on the line. if it is a sentence fragment,write an F on the line.', 'Painted an underwater scene on the walls of the room', 'c', 'After Leo and Nina moved the furniture .', 'c', 'Grandpa Watered the plants.', 'f', 'The ladybug climbed onto the leaf', 'c', 'Rained for four days.', 'f', '230720181532324645.mp3', '1', '00:05:01', '2018-07-23 00:02:42', '2018-08-06 06:46:03', NULL),
(3, 15, 17, 'If it is a complete sentence , write c on the line. if it is a sentence fragment, write an F on the line.', 'Painted an underwater scene on the walls of the room', 'c', 'After Leo and Nina moved the furniture .', 'f', 'Grandpa Watered the plants.', 'f', 'The ladybug climbed onto the leaf', 'c', 'Rained for four days.', 'c', '270720181532692517.mp3', '1', '00:05:00', '2018-07-27 06:25:17', '2018-07-30 04:24:34', NULL),
(4, 28, 29, 'If it is a complete sentence , write c on the line. if it is a sentence fragment, write an F on the line.', 'Painted an underwater scene on the walls of the room.', 'c', 'After Leo and Nina moved the furniture.', 'c', 'Grandpa Watered the plants.', 'f', 'The ladybug climbed onto the leaf.', 'f', 'Rained for four days.', 'c', '020820181533189400.mp3', '1', '00:02:00', '2018-08-02 00:26:40', '2018-08-02 00:26:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_29`
--

CREATE TABLE `template_29` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_29`
--

INSERT INTO `template_29` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `question_2`, `question_3`, `question_4`, `question_5`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Underline each word that begins with an s blend in the sentences below.Then, circle the blend', 'Stella and Spencer put on sweaters and wrapped scarves around their necks.', 'They spend every fall evening swinging from the old oak tree.', 'Stella scanned the sky for constellations. Stella and Spencer were keeping score to see who could spot more stars.', 'Spencer liked the way the air smelled like smoke from backyard bonfires.', 'When it was time to go back inside,Stella and Spencer snuggled into their beds. They knew that snow was coming, and fall would soon be over.', 's', '230720181532328899.mp3', '1', '00:03:00', '2018-07-23 01:14:36', '2018-08-06 06:46:19', NULL),
(3, 24, 25, 'Underline each word that begins with an s blend in the sentences below.Then, circle the blend', 'Stella and Spencer put on sweaters and wrapped scarves around their necks.', 'They spend every fall evening swinging from the old oak tree.', 'Stella scanned the sky for constellations. Stella and Spencer were keeping score to see who could spot more stars.', 'Spencer liked the way the air smelled like smoke from backyard bonfires.', 'When it was time to go back inside, Stella and Spencer snuggled into their beds. They knew that snow was coming, and fall would soon be over.', 's', '310720181533010020.mp3', '1', '00:00:10', '2018-07-30 22:37:00', '2018-07-31 06:09:54', NULL),
(4, 28, 29, 'Underline each word that begins with an s blend in the sentences below.Then, circle the blend', 'Stella and Spencer put on sweaters and wrapped scarves around their necks.', 'They spend every fall evening swinging from the old oak tree.', 'Stella scanned the sky for constellations. Stella and Spencer were keeping score to see who could spot more stars.', 'Spencer liked the way the air smelled like smoke from backyard bonfires.', 'When it was time to go back inside, Stella and Spencer snuggled into their beds. They knew that snow was coming, and fall would soon be over.', 's', '020820181533189489.mp3', '1', '00:01:00', '2018-08-02 00:28:09', '2018-08-02 00:28:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_30`
--

CREATE TABLE `template_30` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_30`
--

INSERT INTO `template_30` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `answer_1`, `question_2`, `answer_2`, `question_3`, `answer_3`, `question_4`, `answer_4`, `question_5`, `answer_5`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 12, 'Write the letter of the definition on the line beside the word', 'third', 'comes between second and fourth', 'verb', 'a part of speech; an action word', 'thorn', 'a sharp point on the stem of a plant', 'guitar', 'a musical instrument', 'turkey', 'food usually served at thanksgiving', '290720181532848817.mp3', '1', '00:00:31', '2018-07-29 01:35:19', '2018-08-06 06:46:26', NULL),
(2, 24, 25, 'Write the letter of the definition on the line beside the word', 'third', 'comes between second and fourth', 'verb', 'a part of speech; an action word', 'thorn', 'a sharp point on the stem of a plant', 'guitar', 'a musical instrument', 'turkey', 'food usually served at thanksgiving', '310720181533010111.mp3', '1', '00:00:30', '2018-07-30 22:38:31', '2018-07-31 06:52:34', NULL),
(3, 28, 29, 'Write the letter of the definition on the line beside the word', 'third', 'comes between second and fourth', 'verb', 'a part of speech; an action word', 'thorn', 'a sharp point on the stem of a plant', 'guitar', 'a musical instrument', 'turkey', 'food usually served at thanksgiving', '020820181533189562.mp3', '1', '00:03:00', '2018-08-02 00:29:22', '2018-08-02 00:29:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_31`
--

CREATE TABLE `template_31` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` text CHARACTER SET utf8 NOT NULL,
  `answer` text CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_31`
--

INSERT INTO `template_31` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'On the line, write the plural form of each word in parentheses.', 'On the line, write the plural form of each word in parentheses.Aleesha was packing the #BLANK# ( content ) of her room. Downstairs, the \r\n#BLANK# (glass), #BLANK# (dish), books, and #BLANK# (picture) had been packed. She had said good-bye to her two best #BLANK# (friend) and all the nearby #BLANK# (family) in the neighborhood.', 'content,glass,dish,picture,friend,family', '240720181532441377.mp3', '1', '00:03:00', '2018-07-24 08:32:37', '2018-08-06 06:48:23', NULL),
(3, 24, 25, 'On the line, write the plural form of each word in parentheses.', 'Aleesha was packing the #BLANK# ( content ) of her room. Downstairs, the #BLANK# (glass), #BLANK# (dish), books, and #BLANK# (picture) had been packed. She had said good-bye to her two best #BLANK# (friend) and all the nearby #BLANK# (family) in the neighborhood.', 'content,glass,dish,picture,friend,family', '310720181533010207.mp3', '1', '00:05:50', '2018-07-30 22:40:07', '2018-07-30 22:40:07', NULL),
(4, 28, 29, 'On the line, write the plural form of each word in parentheses.', 'Aleesha was packing the #BLANK# ( content ) of her room. Downstairs, the\r\n#BLANK# (glass), #BLANK# (dish), books, and #BLANK# (picture) had been packed. She had\r\nsaid good-bye to her two best #BLANK# (friend) and all the nearby #BLANK# (family) in the\r\nneighborhood.', 'content,glass,dish,picture,friend,family', '020820181533189697.mp3', '1', '00:02:00', '2018-08-02 00:31:37', '2018-08-02 00:31:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_32`
--

CREATE TABLE `template_32` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` text CHARACTER SET utf8 NOT NULL,
  `answer` text CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_32`
--

INSERT INTO `template_32` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'The comma has been taken out of the sentence below.Normally, a comma would come immediately after the introductory phrase or clause. Highlight the word that comes right before the comma.', 'Sarah was pretty excited although she didn\'t know how it would turn out.', 'excited', '230720181532332873.mp3', '1', '00:03:01', '2018-07-23 02:21:31', '2018-08-06 06:50:38', NULL),
(3, 24, 25, 'The comma has been taken out of the sentense below.Normally, a comma would come immediately after the introductory phrase or clause.highlight the word that comes right before the comma.', 'Sarah was pretty excited although she didn\'t know how it would turn out.', 'excited', '310720181533010392.mp3', '1', '00:05:45', '2018-07-30 22:43:12', '2018-07-30 22:43:13', NULL),
(4, 28, 29, 'The comma has been taken out from sentence below. Normally, a comma would come immediately after the introductory phrase or clause. Highlight the word that comes right after the comma', 'Sarah was pretty excited although she didn\'t know how it would turn out.', 'excited', '020820181533189876.mp3', '1', '00:00:30', '2018-08-02 00:34:36', '2018-08-02 00:34:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_33`
--

CREATE TABLE `template_33` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `digit1_1` double(10,2) NOT NULL,
  `operator1` varchar(128) NOT NULL,
  `digit1_2` double(10,2) NOT NULL,
  `answer1` double(10,2) NOT NULL,
  `digit2_1` double(10,2) NOT NULL,
  `operator2` varchar(128) NOT NULL,
  `digit2_2` double(10,2) NOT NULL,
  `answer2` double(10,2) NOT NULL,
  `digit3_1` double(10,2) NOT NULL,
  `operator3` varchar(128) NOT NULL,
  `digit3_2` double(10,2) NOT NULL,
  `answer3` double(10,2) NOT NULL,
  `digit4_1` double(10,2) NOT NULL,
  `operator4` varchar(128) NOT NULL,
  `digit4_2` double(10,2) NOT NULL,
  `answer4` double(10,2) NOT NULL,
  `digit5_1` double(10,2) NOT NULL,
  `operator5` varchar(128) NOT NULL,
  `digit5_2` double(10,2) NOT NULL,
  `answer5` double(10,2) NOT NULL,
  `digit6_1` double(10,2) NOT NULL,
  `operator6` varchar(128) NOT NULL,
  `digit6_2` double(10,2) NOT NULL,
  `answer6` double(10,2) NOT NULL,
  `digit7_1` double(10,2) NOT NULL,
  `operator7` varchar(128) NOT NULL,
  `digit7_2` double(10,2) NOT NULL,
  `answer7` double(10,2) NOT NULL,
  `digit8_1` double(10,2) NOT NULL,
  `operator8` varchar(128) NOT NULL,
  `digit8_2` double(10,2) NOT NULL,
  `answer8` double(10,2) NOT NULL,
  `digit9_1` double(10,2) NOT NULL,
  `operator9` varchar(128) NOT NULL,
  `digit9_2` double(10,2) NOT NULL,
  `answer9` double(10,2) NOT NULL,
  `digit10_1` double(10,2) NOT NULL,
  `operator10` varchar(128) NOT NULL,
  `digit10_2` double(10,2) NOT NULL,
  `answer10` double(10,2) NOT NULL,
  `digit11_1` double(10,2) NOT NULL,
  `operator11` varchar(128) NOT NULL,
  `digit11_2` double(10,2) NOT NULL,
  `answer11` double(10,2) NOT NULL,
  `digit12_1` double(10,2) NOT NULL,
  `operator12` varchar(128) NOT NULL,
  `digit12_2` double(10,2) NOT NULL,
  `answer12` double(10,2) NOT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_33`
--

INSERT INTO `template_33` (`id`, `program_id`, `lesson_id`, `question`, `digit1_1`, `operator1`, `digit1_2`, `answer1`, `digit2_1`, `operator2`, `digit2_2`, `answer2`, `digit3_1`, `operator3`, `digit3_2`, `answer3`, `digit4_1`, `operator4`, `digit4_2`, `answer4`, `digit5_1`, `operator5`, `digit5_2`, `answer5`, `digit6_1`, `operator6`, `digit6_2`, `answer6`, `digit7_1`, `operator7`, `digit7_2`, `answer7`, `digit8_1`, `operator8`, `digit8_2`, `answer8`, `digit9_1`, `operator9`, `digit9_2`, `answer9`, `digit10_1`, `operator10`, `digit10_2`, `answer10`, `digit11_1`, `operator11`, `digit11_2`, `answer11`, `digit12_1`, `operator12`, `digit12_2`, `answer12`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 12, 'Solve equation', 5.00, '-', 1.00, 4.00, 5.00, '-', 2.00, 3.00, 5.00, '-', 3.00, 2.00, 5.00, '-', 4.00, 1.00, 5.00, '-', 5.00, 0.00, 5.00, '-', 0.00, 5.00, 500.00, '-', 1.00, 499.00, 5000.00, '-', 2.00, 4998.00, 50000.00, '-', 3.00, 49997.00, 500000.00, '-', 4.00, 499996.00, 500000.00, '-', 5.00, 499995.00, 500000.00, '-', 0.00, 500000.00, '230720181532349742.mp3', '1', '00:00:33', '2018-07-23 06:34:57', '2018-08-06 06:51:05', NULL),
(2, 24, 25, 'Solve equations', 5.00, '-', 1.00, 4.00, 5.00, '-', 2.00, 3.00, 5.00, '-', 3.00, 2.00, 5.00, '-', 4.00, 1.00, 5.00, '-', 5.00, 0.00, 5.00, '-', 0.00, 5.00, 500.00, '-', 1.00, 499.00, 5000.00, '-', 2.00, 4998.00, 50000.00, '-', 3.00, 49997.00, 500000.00, '-', 4.00, 499996.00, 500000.00, '-', 5.00, 499995.00, 500000.00, '-', 0.00, 500000.00, NULL, '1', '00:05:10', '2018-07-30 22:45:27', '2018-07-30 22:45:27', NULL),
(3, 28, 29, 'solve following equation', 5.00, '-', 1.00, 4.00, 5.00, '-', 2.00, 3.00, 5.00, 'x', 3.00, 15.00, 5.00, '/', 5.00, 1.00, 5.00, '+', 11.00, 16.00, 5.00, '-', 0.00, 5.00, 500.00, '-', 1.00, 499.00, 5000.00, '-', 2.00, 4998.00, 50000.00, '-', 3.00, 49997.00, 500000.00, '-', 4.00, 499996.00, 50000.00, '-', 5.00, 49995.00, 50000.00, '+', 2.00, 50002.00, NULL, '1', '00:06:00', '2018-08-02 00:37:19', '2018-08-02 00:37:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_34`
--

CREATE TABLE `template_34` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_file` varchar(255) NOT NULL,
  `digit1_1` double(10,2) NOT NULL,
  `operator1` varchar(128) NOT NULL,
  `digit1_2` double(10,2) NOT NULL,
  `answer1` double(10,2) NOT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_34`
--

INSERT INTO `template_34` (`id`, `program_id`, `lesson_id`, `question`, `question_file`, `digit1_1`, `operator1`, `digit1_2`, `answer1`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Solve equation', '3107201815330296071.png', 4.00, '-', 2.00, 2.00, '230720181532354063.mp3', '1', '00:00:34', '2018-07-23 08:07:18', '2018-08-06 06:51:17', NULL),
(3, 24, 25, 'Solve equation', '3107201815330105751.jpg', 3.00, '+', 1.00, 4.00, NULL, '1', '00:05:20', '2018-07-30 22:46:15', '2018-07-30 22:46:15', NULL),
(4, 28, 29, 'input answers on the blanks', '0208201815331901151.jpg', 3.00, '-', 1.00, 2.00, NULL, '1', '00:00:30', '2018-08-02 00:38:35', '2018-08-02 00:38:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_35`
--

CREATE TABLE `template_35` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1_file` varchar(255) NOT NULL,
  `question_2_file` varchar(255) DEFAULT NULL,
  `digit1_1` double(10,2) NOT NULL,
  `operator1` varchar(128) NOT NULL,
  `digit1_2` double(10,2) NOT NULL,
  `answer1` double(10,2) NOT NULL,
  `answer1Position` varchar(255) NOT NULL COMMENT '0 = Blank',
  `digit2_1` double(10,2) NOT NULL,
  `operator2` varchar(128) NOT NULL,
  `digit2_2` double(10,2) NOT NULL,
  `answer2` double(10,2) NOT NULL,
  `answer2Position` varchar(255) NOT NULL COMMENT '0 = Blank',
  `digit3_1` double(10,2) NOT NULL,
  `operator3` varchar(128) NOT NULL,
  `digit3_2` double(10,2) NOT NULL,
  `answer3` double(10,2) NOT NULL,
  `answer3Position` varchar(255) NOT NULL COMMENT '0 = Blank',
  `digit4_1` double(10,2) NOT NULL,
  `operator4` varchar(128) NOT NULL,
  `digit4_2` double(10,2) NOT NULL,
  `answer4` double(10,2) NOT NULL,
  `answer4Position` varchar(255) NOT NULL COMMENT '0 = Blank',
  `digit5_1` double(10,2) NOT NULL,
  `operator5` varchar(128) NOT NULL,
  `digit5_2` double(10,2) NOT NULL,
  `answer5` double(10,2) NOT NULL,
  `answer5Position` varchar(255) NOT NULL COMMENT '0 = Blank',
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_35`
--

INSERT INTO `template_35` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_2_file`, `digit1_1`, `operator1`, `digit1_2`, `answer1`, `answer1Position`, `digit2_1`, `operator2`, `digit2_2`, `answer2`, `answer2Position`, `digit3_1`, `operator3`, `digit3_2`, `answer3`, `answer3Position`, `digit4_1`, `operator4`, `digit4_2`, `answer4`, `answer4Position`, `digit5_1`, `operator5`, `digit5_2`, `answer5`, `answer5Position`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 12, 'dsfg dfdsf dsfd fdsdsf ds', '0608201815335382901.jpg', '0608201815335382982.png', 11.00, '+', 11.00, 22.00, '010', 22.00, '+', 22.00, 44.00, '101', 33.00, '+', 33.00, 66.00, '001', 44.00, '+', 44.00, 88.00, '011', 55.00, '+', 55.00, 110.00, '010', NULL, '1', '00:00:35', '2018-07-28 09:22:39', '2018-08-06 07:34:31', NULL),
(2, 24, 25, 'Solve equation', '3107201815330106851.jpg', '3107201815330388612.jpg', 4.00, '+', 7.00, 11.00, '110', 30.00, '+', 20.00, 50.00, '110', 10.00, 'x', 1.00, 10.00, '011', 11.00, '-', 2.00, 9.00, '101', 25.00, '+', 25.00, 50.00, '110', NULL, '1', '00:05:15', '2018-07-30 22:48:05', '2018-07-31 12:07:38', NULL),
(3, 28, 29, 'input answers on the blanks', '0208201815331903021.jpg', '0208201815331903022.jpg', 4.00, '+', 7.00, 11.00, '110', 30.00, '+', 20.00, 50.00, '110', 10.00, 'x', 2.00, 20.00, '101', 13.00, '-', 8.00, 5.00, '101', 30.00, '+', 5.00, 35.00, '101', NULL, '1', '00:03:00', '2018-08-02 00:41:42', '2018-08-04 09:50:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_36`
--

CREATE TABLE `template_36` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1_file` varchar(255) NOT NULL,
  `question_2_file` varchar(255) DEFAULT NULL COMMENT 'Optional',
  `answer` double(10,2) NOT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_36`
--

INSERT INTO `template_36` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_2_file`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 6, 12, 'Calculate answer', '2407201815324089501.png', '2907201815328381632.jpg', 15.00, '240720181532408950.mp3', '1', '00:00:36', '2018-07-23 23:39:10', '2018-08-06 07:34:43', NULL),
(5, 26, 27, 'Get an answer', '3107201815330333851.png', NULL, 5.00, NULL, '1', '00:00:20', '2018-07-31 05:06:25', '2018-07-31 05:06:25', NULL),
(6, 28, 29, 'input answers on the blanks', '0208201815331903481.jpg', '0208201815331903482.jpg', 13.00, NULL, '1', '00:02:00', '2018-08-02 00:42:28', '2018-08-02 00:42:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_37`
--

CREATE TABLE `template_37` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1_file` varchar(255) NOT NULL,
  `digit1_1` double(10,2) NOT NULL,
  `operator1` varchar(128) NOT NULL,
  `digit1_2` double(10,2) NOT NULL,
  `answer1` double(10,2) NOT NULL,
  `question_2_file` varchar(255) DEFAULT NULL,
  `digit2_1` double(10,2) DEFAULT NULL,
  `operator2` varchar(128) DEFAULT NULL,
  `digit2_2` double(10,2) DEFAULT NULL,
  `answer2` double(10,2) DEFAULT NULL,
  `question_3_file` varchar(255) DEFAULT NULL,
  `digit3_1` double(10,2) DEFAULT NULL,
  `operator3` varchar(255) DEFAULT NULL,
  `digit3_2` double(10,2) DEFAULT NULL,
  `answer3` double(10,2) DEFAULT NULL,
  `question_4_file` varchar(255) DEFAULT NULL,
  `digit4_1` double(10,2) DEFAULT NULL,
  `operator4` varchar(255) DEFAULT NULL,
  `digit4_2` double(10,2) DEFAULT NULL,
  `answer4` double(10,2) DEFAULT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_37`
--

INSERT INTO `template_37` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `digit1_1`, `operator1`, `digit1_2`, `answer1`, `question_2_file`, `digit2_1`, `operator2`, `digit2_2`, `answer2`, `question_3_file`, `digit3_1`, `operator3`, `digit3_2`, `answer3`, `question_4_file`, `digit4_1`, `operator4`, `digit4_2`, `answer4`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 6, 12, 'Solve equations', '2407201815324252351.jpg', 4.00, '-', 2.00, 2.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '240720181532425235.mp3', '1', '00:03:07', '2018-07-24 04:10:35', '2018-08-06 07:35:07', NULL),
(6, 25, 26, 'sdsdsasds', '3107201815330307551.png', 11.00, '+', 11.00, 22.00, '3107201815330307552.jpg', 11.00, '+', 11.00, 22.00, '3107201815330307553.png', 11.00, '+', 11.00, 22.00, '3107201815330307554.jpg', 11.00, '+', 11.00, 22.00, NULL, '1', '00:00:05', '2018-07-31 04:22:35', '2018-08-01 08:34:35', NULL),
(7, 26, 27, 'Get an answer', '3107201815330334641.jpg', 2.00, '+', 2.00, 4.00, NULL, NULL, NULL, NULL, NULL, '3107201815330334653.jpeg', 2.00, '+', 3.00, 5.00, '3107201815330334654.jpg', 4.00, '+', 2.00, 6.00, NULL, '1', '00:00:20', '2018-07-31 05:07:45', '2018-07-31 07:08:12', NULL),
(8, 28, 29, 'Input answers on the blanks.', '0208201815331904721.jpg', 6.00, '-', 2.00, 4.00, '0208201815331904722.jpg', 5.00, '-', 1.00, 4.00, '0208201815331904723.jpg', 4.00, '-', 3.00, 1.00, '0208201815331904724.jpg', 8.00, '-', 4.00, 4.00, NULL, '1', '00:12:00', '2018-08-02 00:44:32', '2018-08-02 00:44:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_38`
--

CREATE TABLE `template_38` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_file` varchar(255) NOT NULL,
  `question_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `question_3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `question_4` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_4` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_38`
--

INSERT INTO `template_38` (`id`, `program_id`, `lesson_id`, `question`, `question_file`, `question_1`, `answer_1`, `question_2`, `answer_2`, `question_3`, `answer_3`, `question_4`, `answer_4`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Template 38 - Question', '0108201815330981791.jpg', 'how many grasshoppers are there ?', '5', 'How many files are there?', '1', NULL, NULL, NULL, NULL, '250720181532492040.mp3', '1', '00:00:38', '2018-07-24 22:44:00', '2018-08-06 07:35:30', NULL),
(3, 6, 12, 'dsfdsfdsfdsfds', '2707201815326766811.jpg', 'sdsd', 'dsdsa', 'dsadsad', 'sdsadsadsa', 'dsa', 'fdsfdsd', 'dfsdfdsfdsfdf', 'dsdsfdsfds', NULL, '1', '00:00:00', '2018-07-27 02:01:21', '2018-07-27 02:01:21', NULL),
(4, 26, 27, 'Get an answer', '3107201815330335351.jpg', 'how many grasshoppers are there ?', '5', 'How many files are there?', '7', NULL, NULL, 'how many grasshoppers 1 are there ?', '12', NULL, '1', '00:00:20', '2018-07-31 05:08:55', '2018-07-31 12:57:03', NULL),
(5, 28, 29, 'input answers on the blanks.', '0208201815331905631.jpg', 'how many grasshoppers are there ?', '6', 'How many files are there?', '6', 'How many files and grasshoppers are there?', '12', NULL, NULL, NULL, '1', '00:02:00', '2018-08-02 00:46:03', '2018-08-02 00:46:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_39`
--

CREATE TABLE `template_39` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `digit1_1` double(10,2) NOT NULL,
  `operator1` varchar(128) NOT NULL,
  `digit1_2` double(10,2) NOT NULL,
  `answer1` double(10,2) NOT NULL,
  `digit2_1` double(10,2) NOT NULL,
  `operator2` varchar(128) NOT NULL,
  `digit2_2` double(10,2) NOT NULL,
  `answer2` double(10,2) NOT NULL,
  `digit3_1` double(10,2) NOT NULL,
  `operator3` varchar(128) NOT NULL,
  `digit3_2` double(10,2) NOT NULL,
  `answer3` double(10,2) NOT NULL,
  `digit4_1` double(10,2) DEFAULT NULL,
  `operator4` varchar(128) DEFAULT NULL,
  `digit4_2` double(10,2) DEFAULT NULL,
  `answer4` double(10,2) DEFAULT NULL,
  `digit5_1` double(10,2) DEFAULT NULL,
  `operator5` varchar(128) DEFAULT NULL,
  `digit5_2` double(10,2) DEFAULT NULL,
  `answer5` double(10,2) DEFAULT NULL,
  `digit6_1` double(10,2) DEFAULT NULL,
  `operator6` varchar(128) DEFAULT NULL,
  `digit6_2` double(10,2) DEFAULT NULL,
  `answer6` double(10,2) DEFAULT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_39`
--

INSERT INTO `template_39` (`id`, `program_id`, `lesson_id`, `question`, `digit1_1`, `operator1`, `digit1_2`, `answer1`, `digit2_1`, `operator2`, `digit2_2`, `answer2`, `digit3_1`, `operator3`, `digit3_2`, `answer3`, `digit4_1`, `operator4`, `digit4_2`, `answer4`, `digit5_1`, `operator5`, `digit5_2`, `answer5`, `digit6_1`, `operator6`, `digit6_2`, `answer6`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Solve Equations', 11.00, '+', 11.00, 22.00, 11.00, '-', 11.00, 0.00, 11.00, 'x', 11.00, 121.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '240720181532431350.mp3', '1', '00:03:09', '2018-07-24 05:52:30', '2018-08-06 07:35:47', NULL),
(3, 26, 27, 'Solve an equation', 23.00, '-', 5.00, 18.00, 23.00, '-', 6.00, 17.00, 23.00, '-', 7.00, 16.00, 23.00, '-', 8.00, 15.00, 23.00, '+', 1.00, 24.00, 23.00, '+', 2.00, 25.00, NULL, '1', '00:00:20', '2018-07-31 05:10:15', '2018-07-31 05:10:15', NULL),
(4, 28, 29, 'input answers on the blanks', 23.00, '-', 5.00, 18.00, 20.00, 'x', 2.00, 40.00, 20.00, '/', 10.00, 2.00, 11.00, '+', 2.00, 13.00, 5.00, '-', 4.00, 1.00, 5.00, 'x', 4.00, 20.00, NULL, '1', '00:06:00', '2018-08-02 00:47:10', '2018-08-02 00:47:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_40`
--

CREATE TABLE `template_40` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question1_1` text CHARACTER SET utf8 NOT NULL,
  `question1_2` text CHARACTER SET utf8 NOT NULL,
  `answer_1` varchar(128) NOT NULL,
  `question2_1` text CHARACTER SET utf8 NOT NULL,
  `question2_2` text CHARACTER SET utf8 NOT NULL,
  `answer_2` varchar(128) NOT NULL,
  `question3_1` text CHARACTER SET utf8 NOT NULL,
  `question3_2` text CHARACTER SET utf8 NOT NULL,
  `answer_3` varchar(128) NOT NULL,
  `question4_1` text CHARACTER SET utf8 NOT NULL,
  `question4_2` text CHARACTER SET utf8 NOT NULL,
  `answer_4` varchar(128) NOT NULL,
  `question5_1` text CHARACTER SET utf8 NOT NULL,
  `question5_2` text CHARACTER SET utf8 NOT NULL,
  `answer_5` varchar(128) NOT NULL,
  `question6_1` text CHARACTER SET utf8 NOT NULL,
  `question6_2` text CHARACTER SET utf8 NOT NULL,
  `answer_6` varchar(128) NOT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_40`
--

INSERT INTO `template_40` (`id`, `program_id`, `lesson_id`, `question`, `question1_1`, `question1_2`, `answer_1`, `question2_1`, `question2_2`, `answer_2`, `question3_1`, `question3_2`, `answer_3`, `question4_1`, `question4_2`, `answer_4`, `question5_1`, `question5_2`, `answer_5`, `question6_1`, `question6_2`, `answer_6`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'For each problem below, add or subtract fractions and then compare results. Write greater-than (>), less-than (<), or equal to (=).', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>6</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>20</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>6</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>20</mn></mfrac></math>', '=', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>6</mn><mfrac><mn>5</mn><mn>10</mn></mfrac><mo>+</mo><mn>8</mn><mfrac><mn>1</mn><mn>4</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>2</mn><mfrac><mn>4</mn><mn>14</mn></mfrac><mo>+</mo><mn>7</mn><mfrac><mn>1</mn><mn>7</mn></mfrac></math>', '>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>8</mn><mfrac><mn>3</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>5</mn><mn>7</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>9</mn><mfrac><mn>6</mn><mn>7</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>2</mn><mn>14</mn></mfrac></math>', '<', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>3</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>+</mo><mn>3</mn><mfrac><mn>4</mn><mn>6</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>2</mn><mfrac><mn>1</mn><mn>2</mn></mfrac><mo>+</mo><mn>3</mn><mfrac><mn>1</mn><mn>2</mn></mfrac></math>', '>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>9</mn><mfrac><mn>5</mn><mn>6</mn></mfrac><mo>+</mo><mn>5</mn><mfrac><mn>2</mn><mn>3</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>8</mn><mfrac><mn>7</mn><mn>9</mn></mfrac><mo>-</mo><mn>4</mn><mfrac><mn>1</mn><mn>3</mn></mfrac></math>', '>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>5</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>1</mn><mfrac><mn>1</mn><mn>8</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>3</mn><mfrac><mn>1</mn><mn>2</mn></mfrac><mo>+</mo><mn>5</mn><mfrac><mn>3</mn><mn>6</mn></mfrac></math>', '<', '250720181532524518.mp3', '1', '00:04:01', '2018-07-25 07:43:32', '2018-08-06 07:35:56', NULL),
(3, 26, 27, 'For each problem below, add or subtract fractions and then compare results. Write greater-than (>), less-than (<), or equal to (=).', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>6</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>10</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>6</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>10</mn></mfrac></math>', '=', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>8</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>10</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>9</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>10</mn></mfrac></math>', '>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>10</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>10</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>11</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>10</mn></mfrac></math>', '<', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>12</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>10</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>13</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>10</mn></mfrac></math>', '=', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>14</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>10</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>15</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>10</mn></mfrac></math>', '>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>16</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>10</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>17</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>10</mn></mfrac></math>', '<', NULL, '1', '00:00:20', '2018-07-31 05:12:08', '2018-08-01 05:42:49', NULL),
(4, 28, 29, 'Write <, > or =', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>6</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>20</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>6</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>1</mn><mn>20</mn></mfrac></math>', '=', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>6</mn><mfrac><mn>5</mn><mn>10</mn></mfrac><mo>+</mo><mn>8</mn><mfrac><mn>1</mn><mn>4</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>2</mn><mfrac><mn>4</mn><mn>14</mn></mfrac><mo>+</mo><mn>7</mn><mfrac><mn>1</mn><mn>7</mn></mfrac></math>', '>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>8</mn><mfrac><mn>3</mn><mn>4</mn></mfrac><mo>+</mo><mn>8</mn><mfrac><mn>1</mn><mn>4</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>9</mn><mfrac><mn>6</mn><mn>7</mn></mfrac><mo>-</mo><mn>3</mn><mfrac><mn>2</mn><mn>14</mn></mfrac></math>', '<', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>3</mn><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>+</mo><mn>3</mn><mfrac><mn>4</mn><mn>6</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>2</mn><mfrac><mn>1</mn><mn>2</mn></mfrac><mo>+</mo><mn>3</mn><mfrac><mn>1</mn><mn>2</mn></mfrac></math>', '>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>9</mn><mfrac><mn>5</mn><mn>6</mn></mfrac><mo>+</mo><mn>5</mn><mfrac><mn>2</mn><mn>3</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>8</mn><mfrac><mn>7</mn><mn>9</mn></mfrac><mo>-</mo><mn>4</mn><mfrac><mn>2</mn><mn>3</mn></mfrac></math>', '<', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>6</mn><mfrac><mn>4</mn><mn>9</mn></mfrac><mo>+</mo><mn>8</mn><mfrac><mn>2</mn><mn>3</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>6</mn><mfrac><mn>4</mn><mn>9</mn></mfrac><mo>+</mo><mn>8</mn><mfrac><mn>2</mn><mn>3</mn></mfrac></math>', '=', NULL, '1', '00:06:00', '2018-08-02 04:16:47', '2018-08-02 04:16:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_41`
--

CREATE TABLE `template_41` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question1_1` text CHARACTER SET utf8 NOT NULL,
  `question1_2` text CHARACTER SET utf8 NOT NULL,
  `answer_1` varchar(128) NOT NULL,
  `question2_1` text CHARACTER SET utf8 NOT NULL,
  `question2_2` text CHARACTER SET utf8 NOT NULL,
  `answer_2` varchar(128) NOT NULL,
  `question3_1` text CHARACTER SET utf8 NOT NULL,
  `question3_2` text CHARACTER SET utf8 NOT NULL,
  `answer_3` varchar(128) NOT NULL,
  `question4_1` text CHARACTER SET utf8,
  `question4_2` text CHARACTER SET utf8,
  `answer_4` varchar(128) DEFAULT NULL,
  `question5_1` text CHARACTER SET utf8,
  `question5_2` text CHARACTER SET utf8,
  `answer_5` varchar(128) DEFAULT NULL,
  `question6_1` text CHARACTER SET utf8,
  `question6_2` text CHARACTER SET utf8,
  `answer_6` varchar(128) DEFAULT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_41`
--

INSERT INTO `template_41` (`id`, `program_id`, `lesson_id`, `question`, `question1_1`, `question1_2`, `answer_1`, `question2_1`, `question2_2`, `answer_2`, `question3_1`, `question3_2`, `answer_3`, `question4_1`, `question4_2`, `answer_4`, `question5_1`, `question5_2`, `answer_5`, `question6_1`, `question6_2`, `answer_6`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'For each problem below, add or subtract fractions and then compare results. Write greater-than (>), less-than (<), or equal to (=).', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>4</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>1</mn><mn>4</mn></mfrac></math>', '=', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>5</mn><mn>7</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>6</mn><mn>7</mn></mfrac></math>', '<', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>2</mn><mn>10</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>8</mn><mn>10</mn></mfrac></math>', '>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '250720181532529169.mp3', '1', '00:04:02', '2018-07-25 08:57:35', '2018-08-06 07:38:11', NULL),
(3, 27, 28, 'For each problem below, add or subtract fractions and then compare results. Write greater-than (>), less-than (<), or equal to (=).', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>4</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>4</mn></mfrac></math>', '>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>4</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>4</mn></mfrac></math>', '<', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>4</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>4</mn></mfrac></math>', '=', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>4</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>4</mn></mfrac></math>', '>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>4</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>4</mn></mfrac></math>', '<', NULL, NULL, NULL, NULL, '1', '00:00:20', '2018-07-31 05:14:32', '2018-08-01 06:15:03', NULL),
(4, 28, 29, 'Write <, > or =', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>4</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>1</mn><mn>4</mn></mfrac></math>', '<', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>5</mn><mn>7</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>6</mn><mn>7</mn></mfrac></math>', '>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>2</mn><mn>10</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>8</mn><mn>10</mn></mfrac></math>', '>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>9</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>3</mn><mn>9</mn></mfrac></math>', '=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '00:06:00', '2018-08-02 04:19:58', '2018-08-02 04:19:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_42`
--

CREATE TABLE `template_42` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question1` text CHARACTER SET utf8 NOT NULL,
  `answer1` text NOT NULL,
  `question2` text CHARACTER SET utf8 NOT NULL,
  `answer2` text NOT NULL,
  `question3` text CHARACTER SET utf8 NOT NULL,
  `answer3` text NOT NULL,
  `question4` text CHARACTER SET utf8,
  `answer4` text,
  `question5` text CHARACTER SET utf8,
  `answer5` text,
  `question6` text CHARACTER SET utf8,
  `answer6` text,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_42`
--

INSERT INTO `template_42` (`id`, `program_id`, `lesson_id`, `question`, `question1`, `answer1`, `question2`, `answer2`, `question3`, `answer3`, `question4`, `answer4`, `question5`, `answer5`, `question6`, `answer6`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 12, 'Solve equations', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>1</mn><mn>3</mn></mfrac><mo>+</mo><mfrac><mn>1</mn><mn>3</mn></mfrac><mo>&#160;</mo><mo>=</mo><mo>&#160;</mo></math>', '2,6', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>2</mn><mn>4</mn></mfrac><mo>+</mo><mfrac><mn>1</mn><mn>4</mn></mfrac><mo>&#160;</mo><mo>=</mo><mo>&#160;</mo></math>', '3,8', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>7</mn><mn>12</mn></mfrac><mo>+</mo><mfrac><mn>3</mn><mn>12</mn></mfrac><mo>&#160;</mo><mo>=</mo><mo>&#160;</mo></math>', '10,24', NULL, NULL, NULL, NULL, NULL, NULL, '260720181532582715.mp3', '1', '00:04:03', '2018-07-25 23:27:31', '2018-08-06 07:38:47', NULL),
(2, 27, 28, 'Solve an equation', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>1</mn><mn>3</mn></mfrac><mo>+</mo><mfrac><mn>1</mn><mn>3</mn></mfrac></math>', '1,2', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>1</mn><mn>3</mn></mfrac><mo>+</mo><mfrac><mn>1</mn><mn>3</mn></mfrac></math>', '3,4', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>1</mn><mn>3</mn></mfrac><mo>+</mo><mfrac><mn>1</mn><mn>3</mn></mfrac></math>', '5,6', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>1</mn><mn>3</mn></mfrac><mo>+</mo><mfrac><mn>1</mn><mn>3</mn></mfrac></math>', '7,8', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>1</mn><mn>3</mn></mfrac><mo>+</mo><mfrac><mn>1</mn><mn>3</mn></mfrac></math>', '9,10', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>1</mn><mn>3</mn></mfrac><mo>+</mo><mfrac><mn>1</mn><mn>3</mn></mfrac></math>', '11,12', NULL, '1', '00:00:20', '2018-07-31 05:16:36', '2018-08-01 06:21:26', NULL),
(3, 28, 29, 'Solve the equations', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>1</mn><mn>3</mn></mfrac><mo>+</mo><mfrac><mn>4</mn><mn>3</mn></mfrac></math>', '4,6', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>1</mn><mn>7</mn></mfrac><mo>+</mo><mfrac><mn>4</mn><mn>7</mn></mfrac></math>', '5,7', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>5</mn><mn>3</mn></mfrac><mo>+</mo><mfrac><mn>6</mn><mn>3</mn></mfrac></math>', '11,6', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>5</mn><mn>3</mn></mfrac><mo>+</mo><mfrac><mn>22</mn><mn>3</mn></mfrac></math>', '21,5', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>5</mn><mn>12</mn></mfrac><mo>+</mo><mfrac><mn>6</mn><mn>3</mn></mfrac></math>', '2,12', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>5</mn><mn>12</mn></mfrac><mo>+</mo><mfrac><mn>6</mn><mn>23</mn></mfrac></math>', '2,23', NULL, '1', '00:06:00', '2018-08-02 04:23:11', '2018-08-04 11:30:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_43`
--

CREATE TABLE `template_43` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_file` varchar(255) NOT NULL,
  `question_1` text CHARACTER SET utf8 NOT NULL,
  `answer_1` text CHARACTER SET utf8 NOT NULL,
  `question_2` text CHARACTER SET utf8 NOT NULL,
  `answer_2` text CHARACTER SET utf8 NOT NULL,
  `question_3` text CHARACTER SET utf8 NOT NULL,
  `answer_3` text CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_43`
--

INSERT INTO `template_43` (`id`, `program_id`, `lesson_id`, `question`, `question_file`, `question_1`, `answer_1`, `question_2`, `answer_2`, `question_3`, `answer_3`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 27, 28, 'Get an answer', '3107201815330341271.png', '#BLANK# groups of #BLANK# elephant', '1,5', '#BLANK# X #BLANK#', '1,5', '#BLANK# total elephant', '5', NULL, '1', '00:00:20', '2018-07-31 05:18:47', '2018-07-31 05:18:47', NULL),
(4, 6, 12, 'asafds sgf sdfdsfdsf dsfds', '0108201815331204051.jpg', 'asdsa sdsad #BLANK# sadsad sadsa dsadsa', '1', '#BLANK# X #BLANK# = #BLANK#', '1,2,2', '#BLANK# dsfdsfdsfds', '10', NULL, '1', '00:00:01', '2018-08-01 05:16:46', '2018-08-06 07:39:27', NULL),
(5, 28, 29, 'input answers on the blanks', '0208201815332037341.png', '#BLANK# groups of #BLANK# chips', '1,3', '#BLANK# X #BLANK# = #BLANK#', '1,3,3', '#BLANK# total chips', '3', NULL, '1', '00:05:00', '2018-08-02 04:25:34', '2018-08-02 10:02:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_44`
--

CREATE TABLE `template_44` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `table_from` int(11) NOT NULL,
  `table_to` int(11) NOT NULL,
  `digit1_1` double(10,2) NOT NULL,
  `operator1` varchar(128) NOT NULL,
  `digit1_2` double(10,2) NOT NULL,
  `answer1` double(10,2) NOT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_44`
--

INSERT INTO `template_44` (`id`, `program_id`, `lesson_id`, `question`, `table_from`, `table_to`, `digit1_1`, `operator1`, `digit1_2`, `answer1`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 12, 'table', 11, 20, 15.00, 'x', 6.00, 90.00, NULL, '1', '00:04:04', '2018-07-28 08:49:08', '2018-08-06 07:39:43', NULL),
(3, 16, 18, 'table', 21, 30, 25.00, 'x', 7.00, 175.00, NULL, '1', '00:00:00', '2018-07-28 22:14:16', '2018-07-28 22:14:16', NULL),
(4, 27, 28, 'Fill the blank value', 1, 10, 2.00, 'x', 5.00, 10.00, NULL, '1', '00:00:20', '2018-07-31 05:24:40', '2018-07-31 05:24:40', NULL),
(5, 28, 29, 'Enter the missing product', 1, 10, 6.00, 'x', 4.00, 24.00, NULL, '1', '00:00:30', '2018-08-02 04:26:50', '2018-08-04 11:43:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_45`
--

CREATE TABLE `template_45` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1_file` varchar(255) NOT NULL,
  `question1_1` text CHARACTER SET utf8 NOT NULL,
  `answer1_1` text CHARACTER SET utf8 NOT NULL,
  `question1_2` text CHARACTER SET utf8 NOT NULL,
  `answer1_2` text CHARACTER SET utf8 NOT NULL,
  `question1_3` text CHARACTER SET utf8 NOT NULL,
  `answer1_3` text CHARACTER SET utf8 NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `question2_1` text CHARACTER SET utf8 NOT NULL,
  `answer2_1` text CHARACTER SET utf8 NOT NULL,
  `question2_2` text CHARACTER SET utf8 NOT NULL,
  `answer2_2` text CHARACTER SET utf8 NOT NULL,
  `question2_3` text CHARACTER SET utf8 NOT NULL,
  `answer2_3` text CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_45`
--

INSERT INTO `template_45` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question1_1`, `answer1_1`, `question1_2`, `answer1_2`, `question1_3`, `answer1_3`, `question_2_file`, `question2_1`, `answer2_1`, `question2_2`, `answer2_2`, `question2_3`, `answer2_3`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Fill in the blanks', '0108201815331031111.jpg', '#BLANK# groups with #BLANK# each', '6,1', 'There are #BLANK# in total', '6', '#BLANK# X #BLANK# = #BLANK#', '6,2,12', '2607201815325978002.jpeg', '#BLANK# groups with #BLANK# each', '6,1', 'There are #BLANK# in total', '6', '#BLANK# X #BLANK# = #BLANK#', '6,1,6', '260720181532596435.mp3', '0', '00:04:05', '2018-07-26 03:43:55', '2018-08-06 07:40:06', NULL),
(3, 27, 28, 'Get an answer', '3107201815330347931.png', '#BLANK# group with #BLANK# elephant', '1,5', 'There are #BLANK# elephant in total', '5', '#BLANK# X #BLANK# = #BLANK#', '1,5,5', '3107201815330347932.jpeg', '#BLANK# group with #BLANK# horse', '1,6', 'There are #BLANK# horse in total', '6', '#BLANK# X #BLANK# = #BLANK#', '1,6,6', NULL, '1', '00:01:00', '2018-07-31 05:29:53', '2018-07-31 05:29:53', NULL),
(4, 28, 29, 'input answers on the blanks', '0208201815332040221.png', '#BLANK# groups with #BLANK# tulips each', '2,3', 'there are #BLANK# tulips in total', '6', '#BLANK# X #BLANK# = #BLANK#', '2,3,6', '0208201815332040222.png', '#BLANK# groups with #BLANK# tulips each', '6,2', 'there are #BLANK# tulips in total', '12', '#BLANK# X #BLANK# = #BLANK#', '6,2,12', NULL, '1', '00:12:00', '2018-08-02 04:30:22', '2018-08-02 04:30:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_46`
--

CREATE TABLE `template_46` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_file` varchar(255) NOT NULL,
  `question_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_5` varchar(255) CHARACTER SET utf8 NOT NULL,
  `question_6` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_6` varchar(255) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_46`
--

INSERT INTO `template_46` (`id`, `program_id`, `lesson_id`, `question`, `question_file`, `question_1`, `answer_1`, `question_2`, `answer_2`, `question_3`, `answer_3`, `question_4`, `answer_4`, `question_5`, `answer_5`, `question_6`, `answer_6`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Solve Angle & Triangle Questions', '2407201815324361071.png', 'How many right angles are there?', '5', 'How many obtuse angles are there?', '4', 'How many acute angles are there?', '3', 'How many equilateral triangles are there?', '2', 'How many isosceles triangles are there?', '1', 'How many scalence triangles are there?', '61', '240720181532436054.mp3', '1', '00:00:46', '2018-07-24 06:48:47', '2018-08-06 07:40:15', NULL),
(3, 27, 28, 'Solve an equations', '3107201815330349781.png', 'How many right angles are there?', '2', 'How many left angles are there?', '3', 'How many angles are there?', '10', 'How many total angles are there?', '10', 'How many angles are present?', '10', 'How many right angles?', '2', NULL, '1', '00:01:00', '2018-07-31 05:32:58', '2018-07-31 05:32:58', NULL),
(4, 28, 29, 'input answers on the blanks', '0208201815332042611.png', 'How many right angles are there?', '2', 'how many obtuse angles are there?', '6', 'how many octuse angles are there?', '8', 'how many equilateral triangles are there?', '4', 'how many isoscelse triangles are there?', '4', 'how many scalene triangles are there?', '2', NULL, '1', '00:12:00', '2018-08-02 04:34:21', '2018-08-02 04:34:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_47`
--

CREATE TABLE `template_47` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_text` text NOT NULL,
  `answer` text NOT NULL COMMENT '0 = Blank',
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_47`
--

INSERT INTO `template_47` (`id`, `program_id`, `lesson_id`, `question`, `question_text`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 12, 'Fill in the blanks of each crossword puzzle to make the multiplication equation true.', '1,+,2,=,3,4,+,5,=,6,X,X,7,-,8,=,9,10,-,11,=,12,=,=,13,X,14,=,15', '1,1,0,1,0,0,1,0,1,0,1,1,1,1,1,1,0,0,1,1,1,0,1,1,1,1,1,1,1', NULL, '1', '00:04:07', '2018-08-02 04:27:23', '2018-08-09 00:30:42', NULL),
(2, 28, 29, 'Fill in the blanks for each cross word', '2,X,3,=,6,6,X,5,=,30,X,X,4,X,1,=,4,8,X,4,=,32,=,=,2,X,24,=,48', '1,1,0,1,1,0,1,1,1,1,1,1,0,1,1,1,0,0,1,1,1,1,1,1,0,1,1,1,0', NULL, '1', '00:06:00', '2018-08-02 06:25:56', '2018-08-02 12:40:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_48`
--

CREATE TABLE `template_48` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_position` varchar(255) NOT NULL COMMENT '0 = Blank',
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_48`
--

INSERT INTO `template_48` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `answer_position`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Use the distributive property of multiplication to complete this math sentence.', '3X99=297X(10+9)', '111110001100111', '250720181532503076.mp3', '1', '00:00:48', '2018-07-25 01:33:30', '2018-08-06 07:40:55', NULL),
(3, 27, 28, 'Use the distributive property of multiplication to compare this math sentence.', '3X99=297X(10+9)', '111110001100111', NULL, '1', '00:02:00', '2018-07-31 05:34:26', '2018-07-31 05:34:26', NULL),
(4, 28, 29, 'Use the distributive property of multiplication to complete this math sentence.', '11X9=11X(10+9)', '11111001101111', NULL, '1', '00:06:00', '2018-08-02 04:38:25', '2018-08-02 04:38:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_49`
--

CREATE TABLE `template_49` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` text CHARACTER SET utf8 NOT NULL,
  `option_1` text CHARACTER SET utf8 NOT NULL,
  `option_2` text CHARACTER SET utf8 NOT NULL,
  `option_3` text CHARACTER SET utf8 NOT NULL,
  `option_4` text CHARACTER SET utf8 NOT NULL,
  `answer` varchar(255) NOT NULL COMMENT '0 = Blank',
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_49`
--

INSERT INTO `template_49` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'Which mixed number is the same as this improper fraction?', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>7</mn><mn>2</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>2</mn><mfrac><mn>5</mn><mn>8</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>2</mn><mfrac><mn>1</mn><mn>2</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>3</mn><mfrac><mn>1</mn><mn>2</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>7</mn><mfrac><mn>1</mn><mn>2</mn></mfrac></math>', '3', '250720181532517121.mp3', '1', '00:04:09', '2018-07-25 05:21:59', '2018-08-06 07:41:03', NULL),
(3, 27, 28, 'Which mixed number is the same as this improper fraction?', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>7</mn><mn>2</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>2</mn><mfrac><mn>5</mn><mn>8</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>3</mn><mfrac><mn>5</mn><mn>8</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>4</mn><mfrac><mn>5</mn><mn>8</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>5</mn><mfrac><mn>5</mn><mn>8</mn></mfrac></math>', '2', NULL, '1', '00:03:00', '2018-07-31 05:41:28', '2018-07-31 05:41:28', NULL),
(4, 28, 29, 'Which mixed number is the same as this imporper fraction?', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mfrac><mn>7</mn><mn>2</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>2</mn><mfrac><mn>5</mn><mn>8</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>3</mn><mfrac><mn>1</mn><mn>2</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>2</mn><mfrac><mn>1</mn><mn>2</mn></mfrac></math>', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mn>7</mn><mfrac><mn>1</mn><mn>2</mn></mfrac></math>', '2', NULL, '1', '00:06:00', '2018-08-02 04:40:41', '2018-08-02 04:40:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_50`
--

CREATE TABLE `template_50` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` time NOT NULL,
  `question_2` time NOT NULL,
  `option_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `option_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `option_3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `option_4` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_50`
--

INSERT INTO `template_50` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `question_2`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 6, 12, 'How much time has passed between Clock A & Clock B?', '07:15:00', '09:15:00', '1 hour, 30 minutes', '1 hour, 45 minutes', '2 hour, 15 minutes', '2 hour', '3', '250720181532499878.mp3', '1', '00:01:02', '2018-07-25 00:41:28', '2018-08-06 07:41:26', NULL),
(3, 6, 12, 'dfdsds', '12:26:00', '12:27:00', 'dfdff', 'dfd', 'dfdfdfd', 'fdfdfd', '1', NULL, '1', '00:05:01', '2018-07-31 01:27:02', '2018-07-31 07:20:22', NULL),
(4, 27, 28, 'How much time has passed between Clock A and Clock B?', '07:15:00', '09:30:00', '1 hour, 30 Minutes', '1 hour, 45 Minutes', '2 hour, 15 Minutes', '2 hour', '3', NULL, '1', '00:03:00', '2018-07-31 05:44:27', '2018-07-31 05:44:27', NULL),
(5, 28, 29, 'How much time has passed between Clock A and Clock B?', '15:30:00', '18:00:00', '1 Hour 30 mins', '2 Hour 30 mins', '3 Hour 30 mins', '4 Hour', '2', NULL, '1', '00:02:00', '2018-08-02 04:42:18', '2018-08-02 04:42:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('0','1') DEFAULT NULL COMMENT '0-inactive,1-active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, '24bc1971c52bb853f7c9688be5a2edc96e9f3187.jpg', '1', '2018-06-16 05:09:52', '2018-07-05 01:17:27'),
(2, '2ba62ca292c23b7dacd9582c020f3798d1269c6c.jpg', '0', '2018-06-16 05:10:49', '2018-07-05 01:17:39'),
(3, '0a5f34ac07ca2c9ec902593bb991ac6b34e2c04a.jpg', '1', '2018-07-05 00:54:41', '2018-07-05 01:17:05'),
(4, 'dfe725a4b53b01f2596b00477e1dc55670e04ee7.jpg', '1', '2018-07-05 01:01:27', '2018-07-11 07:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials_translation`
--

CREATE TABLE `testimonials_translation` (
  `id` int(11) NOT NULL,
  `testimonials_id` int(11) NOT NULL,
  `locale` varchar(10) CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials_translation`
--

INSERT INTO `testimonials_translation` (`id`, `testimonials_id`, `locale`, `title`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'New', '<p><strong>dsssssssss</strong> sdf sfsdf ewr we rew ewrwerer ereqwqw qwe rererer&nbsp;dsssssssss sdf sfsdf ewr we rew ewrwerer ereqwqw qwe rererer&nbsp;dsssssssss sdf sfsdf ewr we rew ewrwerer ereqwqw qwe rererer&nbsp;dsssssssss sdf sfsdf ewr we rew ewrwerer ereqwqw qwe rererer&nbsp;dsssssssss sdf sfsdf ewr we rew ewrwerer ereqwqw qwe rererer&nbsp;dsssssssss sdf sfsdf ewr we rew ewrwerer ereqwqw qwe rererer&nbsp;dsssssssss sdf sfsdf ewr we rew ewrwerer ereqwqw qwe rererer&nbsp;dsssssssss sdf sfs</p>', '2018-06-16 05:09:53', '2018-07-05 01:17:28'),
(2, 1, 'cn', 'Fsf', '<p>fdsfds</p>', '2018-06-16 05:09:53', '2018-06-16 05:09:53'),
(3, 2, 'en', 'Fsd', '<p>fsds</p>', '2018-06-16 05:10:49', '2018-06-16 05:10:49'),
(4, 2, 'cn', 'Fsdf', '<p>sdfsd</p>', '2018-06-16 05:10:50', '2018-06-16 05:10:50'),
(5, 3, 'en', 'Jai', '<p>sdasdasdsad</p>', '2018-07-05 00:54:41', '2018-07-05 00:54:41'),
(6, 3, 'cn', 'Fsdfsdf', '<p>asdasd</p>', '2018-07-05 00:54:41', '2018-07-05 01:01:42'),
(7, 4, 'en', 'Testing', '<p>sdfsdf</p>', '2018-07-05 01:01:27', '2018-07-05 01:01:27'),
(8, 4, 'cn', 'Dsad', '<p>asdsad</p>', '2018-07-05 01:01:27', '2018-07-05 01:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `textbook`
--

CREATE TABLE `textbook` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0-inactive,1-active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `textbook`
--

INSERT INTO `textbook` (`id`, `program_id`, `lesson_id`, `name`, `slug`, `subject_id`, `grade_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 6, 12, 'Material 1', 'Material 1', 1, 4, '1', '2018-07-29 07:42:12', '2018-08-07 11:15:20'),
(4, 6, 12, 'Material 2', 'material-2', 1, 4, '1', '2018-07-29 07:42:12', '2018-08-09 03:36:45'),
(5, 6, 12, 'One 1', 'one-1', 1, 4, '1', '2018-07-31 06:00:56', '2018-08-07 11:15:27'),
(6, 6, 12, 'Two', 'two', 1, 4, '1', '2018-07-31 06:00:57', '2018-08-07 11:15:40'),
(8, 6, 12, 'Two 2', 'two-2', 1, 4, '1', '2018-07-31 07:14:04', '2018-08-09 05:58:04'),
(9, 0, 0, 'Marathi demo create stones', 'marathi-demo-create-stones', 1, 4, '1', '2018-08-05 00:21:23', '2018-08-09 03:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `textbook_image`
--

CREATE TABLE `textbook_image` (
  `id` int(11) NOT NULL,
  `textbook_id` int(11) NOT NULL,
  `file` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `textbook_image`
--

INSERT INTO `textbook_image` (`id`, `textbook_id`, `file`, `created_at`, `updated_at`) VALUES
(8, 3, '15328699325b5dbd2cd0eb2.jpg', '2018-07-29 07:42:12', '2018-07-29 07:42:12'),
(9, 3, '15328699325b5dbd2cd618d.png', '2018-07-29 07:42:12', '2018-07-29 07:42:12'),
(10, 3, '15328699325b5dbd2cd8c53.png', '2018-07-29 07:42:12', '2018-07-29 07:42:12'),
(11, 3, '15328699325b5dbd2cdd2f4.jpeg', '2018-07-29 07:42:12', '2018-07-29 07:42:12'),
(13, 4, '15328699325b5dbd2ceb68b.jpg', '2018-07-29 07:42:12', '2018-07-29 07:42:12'),
(14, 4, '15329313335b5ead05afc13.jpg', '2018-07-30 00:45:33', '2018-07-30 00:45:33'),
(15, 4, '15329340085b5eb77803c2a.jpg', '2018-07-30 01:30:08', '2018-07-30 01:30:08'),
(18, 4, '15329462425b5ee7423e6b4.png', '2018-07-30 04:54:02', '2018-07-30 04:54:02'),
(19, 4, '15329477765b5eed4013457.mp4', '2018-07-30 05:19:36', '2018-07-30 05:19:36'),
(20, 4, '15329478875b5eedafd5420.pdf', '2018-07-30 05:21:27', '2018-07-30 05:21:27'),
(21, 4, '15329493225b5ef34a9ea97.jpeg', '2018-07-30 05:45:22', '2018-07-30 05:45:22'),
(22, 4, '15329536215b5f0415986bf.mp4', '2018-07-30 06:57:01', '2018-07-30 06:57:01'),
(23, 5, '15330366565b604870e57c6.jpg', '2018-07-31 06:00:56', '2018-07-31 06:00:56'),
(24, 5, '15330366575b60487105e8b.jpg', '2018-07-31 06:00:57', '2018-07-31 06:00:57'),
(25, 5, '15330366575b6048710b13e.jpeg', '2018-07-31 06:00:57', '2018-07-31 06:00:57'),
(26, 6, '15330366575b60487122217.jpg', '2018-07-31 06:00:57', '2018-07-31 06:00:57'),
(27, 6, '15330366575b6048712b436.jpg', '2018-07-31 06:00:57', '2018-07-31 06:00:57'),
(29, 5, '15332897055b6424e97294e.mp4', '2018-08-03 04:18:25', '2018-08-03 04:18:25'),
(30, 9, '15334482835b66905b1a47d.jpg', '2018-08-05 00:21:23', '2018-08-05 00:21:23'),
(31, 4, '15338056055b6c0425de76c.jpg', '2018-08-09 03:36:45', '2018-08-09 03:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `textbook_translation`
--

CREATE TABLE `textbook_translation` (
  `id` int(11) NOT NULL,
  `textbook_id` int(11) NOT NULL,
  `locale` varchar(100) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_usage_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL COMMENT 'actual plan amount',
  `per_unit_conversion_rate` double(10,2) NOT NULL,
  `total_converted_amount` double(10,2) NOT NULL COMMENT 'converted courency',
  `child_limit` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `from_currency` int(11) NOT NULL,
  `to_currency` int(11) NOT NULL,
  `payment_via` varchar(200) NOT NULL COMMENT 'payment gateway',
  `status` enum('active','expired') NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `user_id`, `plan_id`, `coupon_id`, `coupon_usage_id`, `amount`, `per_unit_conversion_rate`, `total_converted_amount`, `child_limit`, `transaction_date`, `expiry_date`, `from_currency`, `to_currency`, `payment_via`, `status`, `invoice`, `created_at`, `updated_at`) VALUES
(1, '1234567', 16, 4, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-11', '2018-11-15', 0, 0, '', 'active', 'dump_invoice', '2018-07-12 12:46:46', '2018-07-22 08:42:35'),
(2, 'PAY-1KW09883G6854803JLNGGBNY', 16, 4, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '', '2018-07-16 09:09:39', '2018-07-23 08:33:07'),
(3, 'PAY-13460895J5519682FLNGGCPA', 26, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '', '2018-07-16 09:11:57', '2018-07-22 08:42:35'),
(4, 'PAY-48D19424VR855734MLNGGGAA', 27, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '', '2018-07-16 09:20:08', '2018-07-22 08:42:35'),
(5, 'PAY-30R545287P2904637LNGGIZA', 28, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '', '2018-07-16 09:25:29', '2018-07-22 08:42:35'),
(6, 'PAY-099978208D324135GLNGGKBI', 29, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '', '2018-07-16 09:28:14', '2018-07-22 08:42:35'),
(7, 'PAY-6NB33859MB003310NLNGGM4A', 30, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '', '2018-07-16 09:34:05', '2018-07-22 08:42:35'),
(8, 'PAY-7EG896581R063382MLNGGOEA', 31, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T8.pdf', '2018-07-16 09:37:02', '2018-08-07 09:18:07'),
(9, 'PAY-5A261561FP2723112LNGGRFI', 33, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T9.pdf', '2018-07-16 09:43:12', '2018-08-07 09:18:10'),
(10, 'PAY-8K93873788838032MLNGGSAA', 34, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T10.pdf', '2018-07-16 09:45:17', '2018-08-07 09:18:12'),
(11, 'PAY-0D33556798208481TLNGGVTY', 35, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T11.pdf', '2018-07-16 09:52:58', '2018-08-07 09:18:15'),
(12, 'PAY-2BS23482UK7481924LNGG4WQ', 36, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T12.pdf', '2018-07-16 10:08:17', '2018-08-07 09:18:18'),
(13, 'PAY-1T273546NV101402KLNGHH2A', 37, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T13.pdf', '2018-07-16 10:31:39', '2018-08-07 09:18:21'),
(14, 'PAY-8LJ53325V5835123YLNGH3BA', 39, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T14.pdf', '2018-07-16 11:12:35', '2018-08-07 09:18:24'),
(15, 'PAY-7CY81999HT2157136LNGH37Y', 40, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T15.pdf', '2018-07-16 11:15:28', '2018-08-07 09:18:03'),
(16, 'PAY-1VC8640188972650KLNGH5KA', 41, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T16.pdf', '2018-07-16 11:17:51', '2018-08-07 09:18:27'),
(17, 'PAY-76L957516P069932WLNGIKYA', 43, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T17.pdf', '2018-07-16 11:46:49', '2018-08-07 09:18:39'),
(18, 'PAY-5KW454704E0251326LNGIODY', 44, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T18.pdf', '2018-07-16 11:53:26', '2018-08-07 09:18:44'),
(19, 'PAY-9L4300785X700660MLNGIPEQ', 45, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-16', '2019-07-16', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T19.pdf', '2018-07-16 11:55:26', '2018-07-22 08:42:35'),
(20, 'PAY-78924618F6708323TLNG4IZI', 52, 1, 0, 0, 500.00, 0.00, 0.00, 100, '2018-07-17', '2019-07-17', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T20.pdf', '2018-07-17 10:27:16', '2018-07-22 08:42:35'),
(21, 'PAY-6A039429KK710374KLNKVXGA', 49, 1, 0, 0, 500.00, 0.00, 0.00, 50, '2018-07-23', '2019-07-23', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T21.pdf', '2018-07-23 04:38:18', '2018-07-23 04:38:19'),
(22, 'PAY-0PF95984JN398352MLNKVYLQ', 50, 1, 0, 0, 500.00, 0.00, 0.00, 50, '2018-07-23', '2019-07-23', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T22.pdf', '2018-07-23 04:40:44', '2018-07-23 04:40:45'),
(23, 'PAY-3L336221AX3373447LNKV34Q', 51, 1, 0, 0, 500.00, 0.00, 0.00, 50, '2018-07-23', '2019-07-23', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T23.pdf', '2018-07-23 04:48:13', '2018-07-23 04:48:14'),
(24, 'PAY-5N70433785444793JLNKV6IY', 52, 1, 0, 0, 500.00, 0.00, 0.00, 50, '2018-07-23', '2019-07-23', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T24.pdf', '2018-07-23 04:53:33', '2018-07-23 04:53:33'),
(25, 'PAY-99B57037K7904793XLNKWARY', 53, 1, 0, 0, 500.00, 0.00, 0.00, 50, '2018-07-23', '2019-07-23', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T25.pdf', '2018-07-23 04:58:37', '2018-07-23 04:58:37'),
(26, 'PAY-9TU62305NM4005035LNKZ5JY', 56, 1, 0, 0, 500.00, 0.00, 0.00, 5, '2018-07-23', '2019-07-23', 0, 0, '', 'active', '/public/uploads/invoice/Invoice_T26.pdf', '2018-07-23 09:25:07', '2018-08-08 07:28:30'),
(27, 'PAY-6GT366536B4058424LNK4AZY', 59, 1, 0, 0, 500.00, 0.00, 0.00, 5, '2018-07-23', '2019-07-23', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T27.pdf', '2018-07-23 11:48:52', '2018-07-23 11:48:52'),
(28, 'PAY-3VG4858459039094XLNMIHIQ', 19, 1, 0, 0, 500.00, 0.00, 0.00, 5, '2018-07-25', '2019-07-25', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T28.pdf', '2018-07-25 14:06:09', '2018-07-25 14:06:09'),
(29, 'PAY-7EN66254WV344164YLNQ3SUQ', 97, 1, 0, 0, 500.00, 0.00, 0.00, 5, '2018-08-01', '2019-08-01', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T29.pdf', '2018-08-01 13:47:55', '2018-08-01 13:47:55'),
(30, 'PAY-2NA76922BD0475005LNQ36UI', 99, 1, 0, 0, 500.00, 0.00, 0.00, 5, '2018-08-01', '2019-08-01', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T30.pdf', '2018-08-01 14:11:02', '2018-08-01 14:11:02'),
(31, 'PAY-36A91203B39203331LNSERDQ', 118, 1, 0, 0, 500.00, 0.00, 0.00, 5, '2018-08-03', '2019-08-03', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T31.pdf', '2018-08-03 12:21:36', '2018-08-03 12:21:36'),
(32, 'PAY-3FJ66221EW309581HLNTJMAY', 120, 1, 0, 0, 500.00, 0.00, 0.00, 5, '2018-08-05', '2019-08-05', 0, 0, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T32.pdf', '2018-08-05 06:19:44', '2018-08-05 06:19:44'),
(33, 'PAY-68F7122627090212GLNUWCCQ', 129, 1, 0, 0, 500.00, 200.00, 10.00, 5, '2018-08-07', '2019-08-07', 2, 2, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T33.pdf', '2018-08-07 09:06:51', '2018-08-07 09:06:52'),
(34, 'PAY-64803440CF361024GLNUWDSI', 129, 1, 0, 0, 500.00, 200.00, 10.00, 5, '2018-08-07', '2019-08-07', 2, 2, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T34.pdf', '2018-08-07 09:10:07', '2018-08-07 09:10:07'),
(35, 'PAY-0MB35447C3144031KLNUWE6A', 129, 1, 0, 0, 500.00, 200.00, 10.00, 5, '2018-08-07', '2019-08-07', 2, 2, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T35.pdf', '2018-08-07 09:13:03', '2018-08-07 09:13:03'),
(36, 'PAY-3AL45478G3799590GLNUWFWQ', 129, 1, 0, 0, 500.00, 200.00, 10.00, 5, '2018-08-07', '2019-08-07', 2, 2, '', 'active', '/opt/lampp/htdocs/elearning/public/uploads/invoice/Invoice_T36.pdf', '2018-08-07 09:14:40', '2018-08-07 09:14:40'),
(37, 'PAY-905125160N961883ULNUWKWI', 130, 1, 0, 0, 500.00, 200.00, 95000.00, 5, '2018-08-07', '2019-08-07', 2, 1, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T37.pdf', '2018-08-07 09:25:58', '2018-08-07 09:25:58'),
(38, 'PAY-10E13754YV372900MLNUWNOY', 131, 1, 0, 0, 500.00, 200.00, 75000.00, 5, '2018-08-07', '2019-08-07', 2, 1, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T38.pdf', '2018-08-07 09:32:23', '2018-08-07 09:32:23'),
(39, 'PAY-0RL63494WB114331VLNUWQMA', 131, 1, 0, 0, 500.00, 200.00, 75000.00, 5, '2018-08-07', '2019-08-07', 2, 1, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T39.pdf', '2018-08-07 09:37:40', '2018-08-07 09:37:40'),
(40, 'PAY-28U24448JD4445507LNUZ3XA', 133, 1, 0, 0, 500.00, 200.00, 100000.00, 5, '2018-08-07', '0000-00-00', 2, 1, '', 'active', '/opt/lampp/htdocs/elearning/uploads/invoice/Invoice_T40.pdf', '2018-08-07 13:26:28', '2018-08-07 13:26:28'),
(41, 'PAY-8FC69444GE614723FLNVMXPA', 134, 1, 28, 6, 500.00, 200.00, 75000.00, 5, '2018-08-08', '0000-01-30', 2, 1, '', 'active', 'Invoice_T41.pdf', '2018-08-08 10:54:31', '2018-08-08 10:54:32'),
(42, 'PAY-0CW47048UU477112PLNVOZFA', 138, 1, 29, 7, 100.00, 0.15, 11.25, 5, '2018-08-08', '0000-03-30', 2, 1, '', 'active', '', '2018-08-08 13:15:17', '2018-08-08 13:15:17'),
(43, '2018081021001004980200635865', 141, 1, 0, 0, 100.00, 0.15, 15.00, 5, '2018-08-10', '2019-08-10', 2, 1, '', 'active', 'Invoice_T43.pdf', '2018-08-10 06:10:44', '2018-08-10 06:10:44'),
(44, '2018081021001004980200635874', 0, 2, 0, 0, 200.00, 0.15, 30.00, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T44.pdf', '2018-08-10 08:55:47', '2018-08-10 08:55:48'),
(45, '2018081021001004980200635875', 0, 2, 0, 0, 200.00, 0.15, 30.00, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T45.pdf', '2018-08-10 08:58:09', '2018-08-10 08:58:09'),
(46, '2018081021001004980200635983', 141, 2, 0, 0, 200.00, 0.15, 30.00, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T46.pdf', '2018-08-10 09:04:58', '2018-08-10 09:04:58'),
(47, '2018081021001004980200635877', 141, 2, 0, 0, 200.00, 0.15, 30.00, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T47.pdf', '2018-08-10 09:08:35', '2018-08-10 09:08:35'),
(48, '2018081021001004980200635986', 141, 2, 0, 0, 200.00, 0.15, 30.00, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T48.pdf', '2018-08-10 09:20:53', '2018-08-10 09:20:53'),
(49, '2018081021001004980200635986', 141, 2, 0, 0, 200.00, 0.15, 30.00, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T49.pdf', '2018-08-10 09:22:00', '2018-08-10 09:22:00'),
(50, '2018081021001004980200636156', 141, 2, 0, 0, 200.00, 0.15, 30.00, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T50.pdf', '2018-08-10 09:24:48', '2018-08-10 09:24:49'),
(51, '2018081021001004980200636156', 141, 2, 0, 0, 200.00, 0.15, 30.00, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T51.pdf', '2018-08-10 09:25:38', '2018-08-10 09:25:38'),
(52, '2018081021001004980200636156', 141, 2, 0, 0, 200.00, 0.15, 30.00, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T52.pdf', '2018-08-10 09:31:36', '2018-08-10 09:31:36'),
(53, '2018081021001004980200636161', 141, 2, 6, 8, 200.00, 0.15, 28.50, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T53.pdf', '2018-08-10 09:49:18', '2018-08-10 09:49:18'),
(54, '2018081021001004980200635994', 141, 2, 6, 9, 200.00, 0.15, 28.50, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T54.pdf', '2018-08-10 10:02:56', '2018-08-10 10:02:56'),
(55, '2018081021001004980200636165', 141, 2, 0, 0, 200.00, 0.15, 30.00, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T55.pdf', '2018-08-10 10:12:06', '2018-08-10 10:12:06'),
(56, '2018081021001004980200636166', 141, 2, 0, 0, 200.00, 0.15, 30.00, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T56.pdf', '2018-08-10 10:14:25', '2018-08-10 10:14:26'),
(57, '2018081021001004980200635996', 141, 2, 6, 25, 200.00, 0.15, 28.50, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', '', '2018-08-10 10:32:14', '2018-08-10 10:32:14'),
(58, '2018081021001004980200635996', 141, 2, 6, 26, 200.00, 0.15, 28.50, 5, '2018-08-10', '2021-08-10', 2, 1, '', 'active', 'Invoice_T58.pdf', '2018-08-10 10:32:50', '2018-08-10 10:32:51'),
(59, 'PAY-6LM51045B66430047LNWYBGA', 141, 2, 0, 0, 200.00, 0.15, 30.00, 5, '2018-08-10', '2021-08-10', 2, 1, 'paypal', 'active', 'Invoice_T58.pdf', '2018-08-10 12:11:35', '2018-08-10 12:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` enum('admin','student','parent','supervisor','program-creator','teacher','subadmin') DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text,
  `password_reset_code` mediumtext COMMENT 'Mobile OTP and password reset code',
  `is_active_membership` enum('no','yes') NOT NULL,
  `is_verify` enum('yes','no') DEFAULT 'no',
  `is_mobile_verify` enum('yes','no') DEFAULT 'no',
  `is_active` enum('active','block') DEFAULT 'block',
  `is_social` enum('no','yes') DEFAULT 'no',
  `contact` varchar(255) DEFAULT NULL,
  `fax_number` varchar(50) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `reference_user_id` int(11) NOT NULL,
  `reference_code` varchar(255) NOT NULL,
  `insentive_amount` int(11) NOT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `post_code` varchar(200) DEFAULT NULL,
  `lat` varchar(200) DEFAULT NULL,
  `lang` varchar(200) DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `enrollment_code` text NOT NULL,
  `permissions` text,
  `preferred_language` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `first_name`, `last_name`, `user_name`, `email`, `password`, `password_reset_code`, `is_active_membership`, `is_verify`, `is_mobile_verify`, `is_active`, `is_social`, `contact`, `fax_number`, `gender`, `remember_token`, `reference_user_id`, `reference_code`, `insentive_amount`, `profile_image`, `address`, `city`, `state`, `country`, `post_code`, `lat`, `lang`, `pin`, `enrollment_code`, `permissions`, `preferred_language`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'Admin', 'Webwing', 'admin', 'admin@webwing.com', '$2y$10$j8FszFlknVlJq4wBkbScxOokJ8PXA12wNGlMm0AV5BcCsbfEtGbhK', NULL, 'no', 'yes', 'no', 'active', 'no', '435345443545', '453445345345', 'female', 'S7kimI0pMavkYLAg6YzDuaoxu5CDkAl3hrJpGiximV2Ehnql53F7l52cq6Iy', 0, '', 0, '5753afccbe0bd7b7844e4efd72f31e1a493e0f69.png', 'Pune, Maharashtra, India', '', '', '', '', '', '', '4450', 'EuBpOv8aSHeMzJL', '', NULL, '2018-04-11 18:30:00', '2018-08-10 09:11:50', NULL),
(4, 'program-creator', 'Smita', 'Joshi', 'dssdsd', 'creator@webwing.com', '$2y$10$Gpg.CtHk1thQ1gWBnCx5JOoz9ZKTIK/99cu7IVIlulkddYGZ0pugq', NULL, 'no', 'yes', 'no', 'active', 'no', '78946512', '45454544545', 'male', '07YldGnhBawLuGGzfvA4T1W0cAC0VqhUFupbFJHm1qAIM4jIItSTk4CjC8I7', 0, '', 0, '562ed2bfe48ea8086bff1751d3238b4549b4f51a.png', 'West Dallas Street, Houston, TX, USA', NULL, NULL, NULL, NULL, NULL, NULL, '', 'LlF9QucZK2MSrb0', '', NULL, '2018-06-16 06:35:17', '2018-08-10 10:05:49', NULL),
(5, 'supervisor', 'Deepak', 'Salunke', 'supervisor', 'supervisor@webwing.com', '$2y$10$.mm9LxvI1.Z.kXbz5m.6ie88dcP/My2S5R.sLvmAocj4zyPeybDN6', NULL, 'no', 'yes', 'no', 'active', 'no', '857888000', '123456789', 'male', 'sd63MTAm1IhqRvi3CjAnC4eE3rlCDGkLvC3bPsWkwIT2bwZ38QWeIA4cRWlk', 0, '', 0, 'e22eb7985ffcf21c13e524be03f3bc4f494ce089.jpg', 'SDSU Transit Center, San Diego, CA, USA', NULL, NULL, NULL, NULL, NULL, NULL, '', 'RZaiWIJqcs9yuAK', '', NULL, '2018-06-16 06:44:52', '2018-08-10 09:26:24', NULL),
(6, 'program-creator', 'Smita', 'Joshi', NULL, 'my@gmail.com', '$2y$10$BTYn5cpEbko1lr0h6VlYQ.m7Miro.xPAVInvojEocIcByhfQeXCtS', NULL, 'no', 'yes', 'no', 'active', 'no', '78965410', NULL, 'male', NULL, 0, '', 0, NULL, 'San Francisco, CA, USA', NULL, NULL, NULL, NULL, NULL, NULL, '', 'iRpXubNQnYl03rk', '', NULL, '2018-06-19 01:29:44', '2018-07-24 11:47:24', NULL),
(7, 'teacher', 'Teacher', 'Demo', 'teacherdemo', 'teacher@webwing.com', '$2y$10$ivFpnV22oQRRtf6zDC4U.Ojl1Bl5wcU1ufU6QGWzok6MXzlRn6zqS', '429281', 'no', 'yes', 'yes', 'active', 'no', '9876543211', NULL, 'male', 'eBQgB9UaQIwC8leHbc7qz8F7sVT78ySbCgEEVWLlJFXey3tMQ2hQA6fjfV0f', 0, '', 0, '03c0e0d2fbbee3d98855c8057a8ff29b227ea8be.png', 'Nasr City, Al Manteqah Al Oula, Nasr City, Egypt', 'Al Manteqah Al Oula', 'Nasr City', 'Egypt', NULL, NULL, NULL, '', 'vkxQDeKitaXSHsE', '', 'en', '2018-06-19 05:13:32', '2018-08-10 06:53:41', NULL),
(9, 'program-creator', 'Demo', 'Deepak', NULL, 'deepak123@o3enzyme.com', '$2y$10$6.D1gn1ZSfuJ/nnrDCUv0.SRn6RFaxCwra3XoPF/5D2M.qntNvTzO', NULL, 'no', 'yes', 'no', 'active', 'no', '9876543210', NULL, 'male', NULL, 0, '', 0, NULL, '123, Admin-Faculty Quarters Road, Bargur, Tamil Nadu, India', NULL, NULL, NULL, NULL, NULL, NULL, '', 'cjTFVyDwpGPOYtU', '', NULL, '2018-06-28 07:38:52', '2018-07-24 11:47:36', NULL),
(12, 'parent', 'Deepak', 'Salunke', NULL, 'deepak@o3enzyme.com', '$2y$10$ivFpnV22oQRRtf6zDC4U.Ojl1Bl5wcU1ufU6QGWzok6MXzlRn6zqS', NULL, 'no', 'yes', 'no', 'active', 'no', '9876543210', NULL, NULL, 'OvDePGzJ8QymHn7GZUNWKyJRTz5rJuVxHo3PQ3cCmm9jL6WIHryjcVOgKG9R', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5393', 'uah9IOcM0vfVxRj', '', NULL, '2018-07-01 23:35:12', '2018-07-24 11:47:40', NULL),
(14, 'supervisor', 'Smita', 'Joshi', NULL, 'jait@webwingtechnologies.com', '$2y$10$Pv..oPj/Q9dn7U20I.bI9O0YL.GNYUUL/jy53RLBzWHYwvgbt3cmC', NULL, 'no', 'yes', 'no', 'active', 'no', '7447474744', NULL, NULL, NULL, 0, '', 0, NULL, 'San Diego, CA, USA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'lTjdt9uk5b6q8hH', '', NULL, '2018-07-02 08:36:15', '2018-07-24 11:47:46', NULL),
(15, 'teacher', 'Deepak', 'Salunke', NULL, 'teacher@shinnemo.com', '$2y$10$zfrvWBivbQs.q5VQCXmjmOPAfX.SQjAhByeREAX6N3Ng/UDL.Bs62', 'uEfTS5Ncw6pc1BHo', 'no', 'yes', 'no', 'active', 'no', '7894561230', NULL, 'male', 'SjYrhDBf6SkDf7sOUwijaof9RKpR3R8fboETW5FNN9g067L5pkpjXUyE1feb', 0, '', 0, '67d56534a148eb445c9736639c75714d72d1f8fb.png', 'Mumbai Central Railway Station Building, Mumbai Central, Mumbai, Maharashtra, India', NULL, NULL, NULL, NULL, NULL, NULL, '9521', '6sqapJFWMQNkoiP', '', 'en', '2018-07-03 04:29:39', '2018-08-02 10:22:16', NULL),
(16, 'parent', 'Parent', 'Demo', NULL, 'parent@webwing.com', '$2y$10$Gj0mhfJT2W7ogmxLiYBy6OarvEns2L3HybOqBNO9taCxi1GVb274S', NULL, 'yes', 'yes', 'yes', 'active', 'no', '7896352410', NULL, 'female', 'zHHnMibHTI1GxBeAm9mUj7OLEnsxw9PPPrWFpwryH6ZFqoUcbDqI9E2HhDKO', 0, '', 0, '5a73edfb4c6ec45f1f6397e4482cf016124a478a.jpg', 'Mumbai Central Railway Station Building, Mumbai Central, Mumbai, Maharashtra, India', NULL, NULL, NULL, NULL, NULL, NULL, '9522', '6ZpEkYhmJl2r7O9', '', 'en', '2018-07-03 04:29:39', '2018-08-10 05:49:39', NULL),
(19, 'parent', 'Ss', 'Sss', NULL, 'webwingt@gmail.com', '$2y$10$mCFs5oKgrg8.CUwKM3CKx.RnnkeU9MBVjdCQ.TeczcadHTFoqy21.', NULL, 'no', 'no', 'yes', 'block', 'no', '42342442342', NULL, NULL, 'a3809f3945ad72fee1c29c9a1a62f6f3', 0, 'NAsEne1PrZ', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2182', 'ohWFpgKRjXmH3uM', '', NULL, '2018-07-17 23:20:07', '2018-08-01 10:29:34', NULL),
(20, 'subadmin', 'Ffffff', 'Ffff', NULL, 'jonny@getnada.com', '$2y$10$Fj0z7VTziGGchtK2UipZPuaL84AWa2MTpBrgnBMm54Bdyk0mXZ7gS', NULL, 'no', 'yes', 'no', 'active', 'no', '79878989', NULL, NULL, NULL, 0, '', 0, NULL, 'D-1, Lal Bahadur Shastri Road, Damodar Park, Ghatkopar West, Mumbai, Maharashtra, India', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'iw8ZJPDVLUarBYd', '{\"account_settings\\/password\\/change.list\":\"true\",\"account_settings\\/password\\/change.update\":\"true\",\"account_settings\\/edit_profile.list\":\"true\",\"account_settings\\/edit_profile.update\":\"true\"}', NULL, '2018-07-18 06:24:10', '2018-07-24 11:48:09', NULL),
(21, 'subadmin', 'Smita', 'Sdasd', NULL, 'jsdonny@getnada.com', '$2y$10$lWSI/pb9XyHH9JH4W032t.zC8cOi3f80YQarY3wWFE8Qsog67MyWu', NULL, 'no', 'yes', 'no', 'active', 'no', '7894541212', NULL, NULL, NULL, 0, '', 0, NULL, 'subadmin@webwing.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'zIGKpbF7Uw4mnyL', '{\"account_setting\\/password\\/change.list\":\"true\",\"account_setting\\/password\\/change.update\":\"true\",\"contact_enquiry.list\":\"true\",\"account_setting\\/edit_profile.list\":\"true\",\"account_setting\\/edit_profile.update\":\"true\",\"notifications.list\":\"true\",\"account_setting\\/reference_code.list\":\"true\",\"subject.list\":\"true\"}', NULL, '2018-07-18 06:26:04', '2018-07-24 11:48:13', NULL),
(22, 'subadmin', 'Sdasd', 'Thakrey', NULL, 'jonnys@getnada.com', '$2y$10$U80nqnBbClF5zL0MScD7zeO7Km1Hc5PyORsIhK8IddVncxoZI4dxm', NULL, 'no', 'yes', 'no', 'active', 'no', '78946512', NULL, NULL, NULL, 0, '', 0, NULL, 'F -WING, Lal Bahadur Shastri Road, Surya Nagar, Gandhi Nagar, Vikhroli West, Mumbai, Maharashtra, India', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LbkN14XhUPioVMZ', '{\"account_setting\\/password\\/change.list\":\"true\",\"account_setting\\/password\\/change.update\":\"true\",\"classrooms.list\":\"true\",\"account_setting\\/contact_address_manage.list\":\"true\",\"account_setting\\/contact_address_manage.update\":\"true\",\"contact_enquiry.list\":\"true\",\"coupons.list\":\"true\",\"coupons.update\":\"true\",\"account_setting\\/currency.list\":\"true\",\"account_setting\\/currency.update\":\"true\",\"account_setting\\/edit_profile.list\":\"true\",\"account_setting\\/edit_profile.update\":\"true\",\"email_template.list\":\"true\",\"email_template.update\":\"true\",\"flyer.list\":\"true\",\"flyer.update\":\"true\",\"front_pages.list\":\"true\",\"front_pages.update\":\"true\",\"gallery.list\":\"true\",\"grade.list\":\"true\",\"grade.update\":\"true\",\"newsletter.list\":\"true\",\"newsletter.update\":\"true\",\"notifications.list\":\"true\",\"account_setting\\/reference_code.list\":\"true\",\"account_setting\\/reference_code.update\":\"true\",\"account_setting\\/site_status.list\":\"true\",\"account_setting\\/site_status.update\":\"true\",\"subject.list\":\"true\",\"subject.update\":\"true\",\"subscription_plan.list\":\"true\",\"subscription_plan.update\":\"true\",\"testimonials.list\":\"true\",\"testimonials.update\":\"true\",\"textbook.list\":\"true\",\"textbook.update\":\"true\",\"users.list\":\"true\"}', NULL, '2018-07-18 07:08:47', '2018-07-24 11:48:17', NULL),
(23, 'subadmin', 'Smita', 'Joshi', NULL, 'subadmin@webwing.com', '$2y$10$j8FszFlknVlJq4wBkbScxOokJ8PXA12wNGlMm0AV5BcCsbfEtGbhK', NULL, 'no', 'yes', 'no', 'active', 'no', '123321544', NULL, NULL, '9B84QjPKwrIxhfsyQYiLYZH5UJEh4uwu7F9GEghqlQFaxHe3orJMd6CP5zLj', 0, '', 0, NULL, 'Singapore', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'b6XI2CTGyF5EAje', '{\"account_setting\\/password\\/change.list\":\"true\",\"account_setting\\/password\\/change.update\":\"true\",\"account_setting\\/contact_address_manage.list\":\"true\",\"account_setting\\/contact_address_manage.delete\":\"true\",\"contact_enquiry.list\":\"true\",\"contact_enquiry.delete\":\"true\",\"coupons.list\":\"true\",\"account_setting\\/currency.list\":\"true\",\"account_setting\\/edit_profile.list\":\"true\",\"account_setting\\/edit_profile.update\":\"true\",\"gallery.delete\":\"true\",\"global_setting.list\":\"true\",\"grade.list\":\"true\",\"grade.delete\":\"true\",\"notifications.list\":\"true\",\"notifications.delete\":\"true\",\"account_setting\\/reference_code.list\":\"true\",\"account_setting\\/site_status.list\":\"true\",\"subject.list\":\"true\",\"subject.delete\":\"true\",\"testimonials.list\":\"true\",\"testimonials.delete\":\"true\",\"textbook.list\":\"true\",\"textbook.delete\":\"true\"}', NULL, '2018-07-18 07:28:47', '2018-07-24 11:48:22', NULL),
(24, 'parent', 'Sdf', 'Sdf', NULL, 'sdf@gmail.com', '$2y$10$Q0Q.EwY/p2/12Beb1.0Aj.6wNzsn0K5ev6OFYHuUwXHnUGZRu1YIK', NULL, 'no', 'no', 'no', 'block', 'no', '543534534535', NULL, NULL, '341e274abc547ddee87f2c3017e7de99', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0468', '7nrUZJvzNLewOmd', NULL, NULL, '2018-07-19 22:50:10', '2018-07-24 11:48:28', NULL),
(27, 'parent', 'Demo', 'Demo', NULL, 'demo@getnada.com', '$2y$10$cFSDkqhh4eerDw8sSERSNuvvTBBDELrm/TWrzNjWh4tTKFifH3XeG', NULL, 'no', 'no', 'no', 'block', 'no', '8741259630', NULL, NULL, '275686394fde237aeccfba3568a602ed', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2398', 'gYmfUbBS4tZeG3L', NULL, NULL, '2018-07-20 06:23:53', '2018-07-24 11:48:32', NULL),
(28, 'parent', 'Jayant', 'Jayantm', NULL, 'aalex4274@gmail.com', '$2y$10$zUrYf2ia459vfabDX1R.w.EZhZsvJyksaxBIp4qMsnUdW1y2763.G', NULL, 'no', 'no', 'no', 'block', 'no', '74132132456', NULL, NULL, '0fbe336794eea358abd3d0f423c742e2', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2128', 'GvigozA9X3j0yDq', NULL, NULL, '2018-07-20 23:00:22', '2018-07-25 06:32:27', NULL),
(29, 'parent', 'Jay', 'Sjakdj', NULL, 'jau@gmail.com', '$2y$10$PyDjGrsoXGlCDzfgXbThluEbb2knHvv8DMmYgx1yfcf51p5dENgdq', NULL, 'no', 'no', 'no', 'block', 'no', '1234654546', NULL, NULL, 'c06bc720e37dfd7a2212b97659e7d5c0', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4836', 'qP0LGtjVMZ8wyIa', NULL, NULL, '2018-07-21 00:26:31', '2018-07-24 11:48:40', NULL),
(30, 'parent', 'Sad', 'Sad', NULL, 'sad@fsdfsd.com', '$2y$10$VWrIu8RXu4OxzpgQVYQmeuVHWEDW8wtvUsCoD.uB8ExpsTh0xBQkO', NULL, 'no', 'no', 'no', 'block', 'no', '3432423424', NULL, NULL, '73c371462382be06243aecc03bdd7f80', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6963', 'BO7hiEMpHSnDfzF', NULL, NULL, '2018-07-21 00:56:13', '2018-07-24 11:48:45', NULL),
(31, 'parent', 'Qweq', 'Wqe', NULL, 'esdrw@gmail.com', '$2y$10$jTE.5XDiIRerUM7gSJZSyefCLPyehgx4NBNx2j91.LeYvDKW2JSCe', NULL, 'no', 'no', 'no', 'block', 'no', '24234234234', NULL, NULL, '2367b6d979fbdd8e2a1dfec9140bfdf9', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1146', 'eLnT5SZgaBk2j6K', NULL, NULL, '2018-07-21 01:07:12', '2018-07-24 11:48:49', NULL),
(32, 'parent', 'Asd', 'Asd', NULL, 'sadcc@ccc.com', '$2y$10$64EQo.eJiSeY2RrEggEXy.NQs3uPf.z2YV.83kFt29QjsUyBHbOFG', NULL, 'no', 'no', 'no', 'block', 'no', '7891423132545', NULL, NULL, '6f770738fe903644a68e064ef8aea887', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6986', 'tNvA70CZUei4a23', NULL, NULL, '2018-07-21 01:28:55', '2018-07-24 11:48:57', NULL),
(33, 'parent', 'Mayuri', 'Pardeshi', NULL, 'mayuri@webwingtechnologies.com', '$2y$10$89ECCZiPfydXSlBW4CcyfONfRRk1eJxbsWzZNgPQ5NMf.NqBheQvm', NULL, 'yes', 'yes', 'yes', 'active', 'no', '4567891230', NULL, NULL, 'd8q9IJfxvA4C9HZFmpl5716qXw6LfR21nRTYyk3kwwnvyrB6NhOAYTsoHU2J', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1285', 'adlPFiWIxev8ZVC', NULL, NULL, '2018-07-22 00:42:59', '2018-08-03 11:46:07', NULL),
(49, 'parent', 'Sdf', 'Sdf', NULL, 'eee@ddd.com', '$2y$10$l//UIuAwyf3/YIk51frWXO.MIZc4yG6KnAEynPUFUy0YqrLEr9hLW', NULL, 'no', 'no', 'no', 'block', 'no', '12645445498', NULL, NULL, 'd52cde1230413085d19546710e69f81e', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9941', 'YjwivDRBcGgCuNO', NULL, NULL, '2018-07-22 23:07:31', '2018-07-24 11:49:02', NULL),
(50, 'parent', 'Rrrrr', 'Rrrr', NULL, 'rr@gg.com', '$2y$10$X4yey0yI/Y51A.26U6xV/.deEz17ovDIrFp/26u70xMLsURhEnTj6', NULL, 'yes', 'no', 'no', 'block', 'no', '78971212', NULL, NULL, '18e8139319fe5f7ffca48b75a317a833', 0, 'Rjel3q5kbs', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4938', 'XrTwSWacQvoLGif', NULL, NULL, '2018-07-22 23:10:05', '2018-07-24 11:49:06', NULL),
(51, 'parent', 'Test', 'Test', NULL, 'test@gmail.com', '$2y$10$cFo1GrMOmiAnfOo7lYdPjummurwuuvLf/mMbprTY3ve6OJdhh0YyG', NULL, 'no', 'no', 'no', 'block', 'no', '74125896320', NULL, NULL, '284480ba79a4e051f5d25b9818268516', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1239', '4hp0LIRQuSDinYK', NULL, NULL, '2018-07-22 23:17:38', '2018-07-24 11:46:43', NULL),
(52, 'parent', 'Ads', 'Sad', NULL, 'eee@eee.com', '$2y$10$IenOx9QW8bcvxtDJz5m9k.Y0J.aR.ZhP2RhuQtCXXb9.kZj6UyHpe', NULL, 'no', 'no', 'no', 'block', 'no', '132121564', NULL, NULL, '6ca9389946b174a95cc16ab827d94518', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4659', 'N1WXdHpIkx4FbsP', NULL, NULL, '2018-07-22 23:22:39', '2018-07-24 11:46:34', NULL),
(53, 'parent', 'Werr', 'Werr', NULL, 'erer@gsandn.com', '$2y$10$GXirqfPHgajX5F2BIHBeO.D771kTh.4bMqAXp.8AvvXRHsXxkYdFm', NULL, 'no', 'no', 'no', 'block', 'no', '713212212312', NULL, NULL, '5aeab48dd1e74f4cc08c292a8bc396fd', 0, 'uL4EQls1Tr', 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6657', '0iopINrxXDQySgU', NULL, NULL, '2018-07-22 23:27:33', '2018-07-24 11:46:29', NULL),
(54, 'parent', 'Ytty', 'Tyy', NULL, 'yyyy@gmail.com', '$2y$10$/SNNz7Zc6o0WhXEjTtkGfOljw1HE/eZI2qJKBgj0HEohh1J919Kz.', NULL, 'no', 'no', 'no', 'block', 'no', '5252552525', NULL, NULL, 'eba8fe7112d4c181e0263c520c844153', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0155', 'DqueyvSQrafZ4og', NULL, NULL, '2018-07-23 00:23:11', '2018-07-24 11:46:24', NULL),
(55, 'parent', 'Saqe', 'Qwer', NULL, 'erwrw@ae.yrty', '$2y$10$yQY2io3VLwkd0xPp8DD1pOsCAEki/Bcxn2/DmrU8LYtOG9E2iLLiG', NULL, 'no', 'no', 'no', 'block', 'no', '23432456423', NULL, NULL, 'd153002fd8f4d2884899dc76fc836149', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3585', 'jLfet5CxDhn4A2v', NULL, NULL, '2018-07-23 01:09:45', '2018-07-24 11:46:19', NULL),
(56, 'parent', 'Test', 'Test', NULL, 'test@test.com', '$2y$10$itnDrjfChE9IlB37V6EkRuDoQDS7pcWqDVQOcYyE29S4.5FX2j9Hq', NULL, 'no', 'no', 'no', 'block', 'no', '5456777123', NULL, NULL, 'd142c119b1345a113fc8f002c3bbb2be', 53, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7075', 'awpHgEuXd30iV81', NULL, NULL, '2018-07-23 03:34:38', '2018-07-24 11:46:14', NULL),
(59, 'parent', 'Erwr', 'My', NULL, 'mydemoo@gmail.com', '$2y$10$G0uu5sIFv94upiGZXFMBneABHnWclpCVIggGCj.mP4cwSMefUGqBK', NULL, 'yes', 'no', 'no', 'block', 'no', '45121211211', NULL, NULL, '60cc9ba097a89f75ba0933140cc3e083', 53, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2344', 'cWm5TyFRi9ghN0Z', NULL, NULL, '2018-07-23 06:16:16', '2018-07-24 11:46:09', NULL),
(66, 'student', 'Barry', 'Allen', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', NULL, NULL, NULL, 'ae2d0e5bb3f4b9ac13491204d5b31069', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8410', '7DtKgCHwEIJ1Zjp', NULL, NULL, '2018-07-24 10:46:51', '2018-08-07 05:19:44', NULL),
(67, 'student', 'Bruce', 'Wayne', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', NULL, NULL, NULL, '9a34c8a379aaba7e239f0e50d83d7dec', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0543', 'iQNZOmlzeIHDxg4', NULL, NULL, '2018-07-24 10:47:10', '2018-08-10 05:20:32', '2018-08-10 05:20:32'),
(68, 'student', 'Tony', 'Stark', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, 'A3ZndTJWwl2GHfHLMbStFPzGplHh9lz6Ws4EEJewgcLInBIuluVj1gPcuJk0', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6470', 'anLipKWoUsgFOy1', NULL, NULL, '2018-07-24 10:47:34', '2018-07-31 03:33:04', NULL),
(69, 'student', 'Peter', 'Parker', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, 'A48eqcB3MXQNTBJx8uVrDtwI7lwI6w3AB5e4P3VzLKvOOTTf7SGHRbnO27xB', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6860', 'VqyYJMnErcRmhTb', NULL, NULL, '2018-07-24 10:47:46', '2018-08-09 07:07:27', NULL),
(70, 'student', 'Oliver', 'Queen', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, '43bc4d7bee3a77e3e9ca3aadee821637', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6707', '7UsTB2CRbW8EJyt', NULL, NULL, '2018-07-24 10:48:07', '2018-07-24 11:45:50', NULL),
(71, 'student', 'Luke', 'Cage', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, 'c628bbe65713f759aea0f24f9ade56ff', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2133', 'tRcTVjsu6Cb8iEO', NULL, NULL, '2018-07-24 10:49:14', '2018-07-24 11:45:49', NULL),
(72, 'student', 'Wally', 'West', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, '39dd162bea515b5613d0d8bf98a36f6d', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2351', '7RfkhBsENlea8UY', NULL, NULL, '2018-07-24 10:50:00', '2018-07-24 11:45:47', NULL),
(73, 'student', 'Black', 'Widow', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', NULL, NULL, NULL, '75a51a775a8938df7e867aae9538cd8a', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3916', 'oFA2U7ZlTyrwegf', NULL, NULL, '2018-07-24 13:06:31', '2018-08-07 05:19:58', NULL),
(74, 'student', 'Flash', 'Thompson', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', NULL, NULL, NULL, 'd0e6d8d1efb89c40c222378d18ddfe3a', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2190', 'aimwec9W3Hh61CN', NULL, NULL, '2018-07-24 13:43:51', '2018-08-07 05:20:05', NULL),
(75, 'student', 'Tom', 'Jerry', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', NULL, NULL, NULL, 'f3c737a678eeb17be30d993d3ef92d72', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3233', '5YP63nJwgNBCI0c', NULL, NULL, '2018-07-25 09:54:18', '2018-07-31 01:58:01', NULL),
(76, 'student', 'Jason', 'H', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, '4aa6a2e08fab1ae4be33fe2c1c74fe1e', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0743', 'fCDu7kM8pwzHNn4', NULL, NULL, '2018-07-27 04:52:43', NULL, NULL),
(77, 'student', 'Jai', 'Joshi', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, '87cbd604fb79efc77172f8295ef0d31d', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6165', 'lRvoj3xSgwhH2GK', NULL, NULL, '2018-07-27 05:10:14', NULL, NULL),
(78, 'teacher', 'Nupur', 'Joshi', NULL, 'nupur@getnada.com', '$2y$10$hr3ljAoOWOwEXexLUF7nIOQvBgjU0ROV5wsKVj0Fwigf.m9/KQQHW', '428802', 'no', 'yes', 'no', 'active', 'no', '7415497721231', NULL, NULL, 'ZJshN2zfHeW4ifla5PzV3ijd8bh8AyhIcvabFeS1zq1VRewWy8xKERy8Uwlq', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6897', '', NULL, NULL, '2018-07-30 01:45:25', '2018-08-02 03:44:29', NULL),
(80, 'teacher', 'Sadasd', 'Sadasd', NULL, 'sonas@getnada.com', '$2y$10$p7qtzqEHDz0/6iSJ21TsH.PftaYSVFVtv5JzSS8SONe6JDDY7GYQy', '416234', 'no', 'no', 'no', 'active', 'no', '79845515454', NULL, NULL, '65d3e802334e6d6af4ad8becb1c3dba8', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3070', '', NULL, NULL, '2018-07-30 08:54:39', '2018-08-02 03:44:29', NULL),
(83, 'teacher', 'Asd', 'Sad', NULL, 'parinita@getnada.com', '$2y$10$j768KH6COvGxQXJcfigsDukRklFaM2KHCchUkEgLo/Y8OF8DmpXQS', NULL, 'no', 'no', 'no', 'active', 'no', '132132156486', NULL, NULL, '832d2a0c0652c42a28c2569ddaa9fc15', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3538', '', NULL, NULL, '2018-07-30 23:31:21', '2018-08-02 03:44:29', NULL),
(89, 'teacher', 'Ganesh', 'Datir', NULL, 'ganesh.datir@gmail.com', '$2y$10$zr0t/85WjTwY4OIfsVzvGO/JsKBYXwbXiULJ6CAHehKjBUqjvq3HG', '634010', 'no', 'no', 'no', 'active', 'no', '3698741478', NULL, NULL, '72b9f29588ee7304ea922518859eb801', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9487', '', NULL, NULL, '2018-07-31 00:16:42', '2018-08-02 03:44:29', NULL),
(90, 'teacher', 'Tesdt', 'Yet', NULL, 'sonasss@getnada.com', '$2y$10$UvgdDhOhnPdy/.EUfA031OhDkdeDD7mixaBu1mmVP5iLhjLxdwICS', NULL, 'no', 'no', 'yes', 'active', 'no', '121231321321', NULL, NULL, '43df4e33a0a177d9e96ce20e8dcdaae0', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6628', '', NULL, NULL, '2018-07-31 03:21:37', '2018-08-02 03:44:29', NULL),
(91, 'teacher', 'Sdfsdf', 'Sdasd', NULL, 'sona@getnada.com', '$2y$10$ii6OTWlLNwPxUjAmK1arxO6ubECwRM18L0q4gCK9RkVCnImnKWwLC', '962683', 'no', 'no', 'no', 'active', 'no', '212154444', NULL, NULL, 'ffe4f1522d69b81c1d0bd868ecedb2fa', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7698', '', NULL, NULL, '2018-07-31 04:01:01', '2018-08-02 03:44:29', NULL),
(92, 'teacher', 'Sadasd', 'Sdasd', NULL, 'krish@getnada.com', '$2y$10$cI3lwd8HjEuwHUEseO3gbuY7EfweYPt2vGeG86Ihn882Z7sRbUol.', '150462', 'no', 'no', 'no', 'active', 'no', '5545512212121', NULL, NULL, '16089537e840301a09b0bbad4f3f39f8', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7046', '', NULL, NULL, '2018-07-31 05:11:32', '2018-08-02 03:44:28', NULL),
(93, 'teacher', 'Teacher', 'A', NULL, 'teachera@gmail.com', '$2y$10$THLLX/ClOJOO5jUbCI1rYOtc3GTGohvRwqInaVXgLDCQimKMXJdAi', '103468', 'no', 'no', 'no', 'active', 'no', '6351478541236', NULL, NULL, 'af6610433c08c7088574115a457ce350', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9640', '', NULL, NULL, '2018-07-31 22:49:22', '2018-08-02 03:44:28', NULL),
(94, 'teacher', 'Teacher', 'B', NULL, 'teacherb@gmail.com', '$2y$10$1jpen.EPRCmr5KIVqd75a.56X8RWg33xFwC8RqaftIWghq1lOcFuO', '236788', 'no', 'no', 'no', 'active', 'no', '9685474125', NULL, NULL, '19945629338b474bb010874c8d98331e', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2473', '', NULL, NULL, '2018-07-31 22:50:18', '2018-08-02 03:44:28', NULL),
(95, 'parent', 'Parent', 'A', NULL, 'parenta@gmail.com', '$2y$10$O9yL3ZzUQ8pDq3KUjRFmoOUvluf7KCbHlWOUN56s6KUPMz2W/Q3me', NULL, 'no', 'no', 'no', 'active', 'no', '9658741523', NULL, NULL, '5b3cd2207f8fb6f9ec4969a82bc516b5', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0460', '', NULL, NULL, '2018-07-31 22:51:15', '2018-07-31 22:51:15', NULL),
(96, 'student', 'Dfsdf', 'Sdfsdf', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, 'a63a53dbef153a674eb7c331de5add3b', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1484', 'whZQd9pLr8lFfXx', NULL, NULL, '2018-08-01 13:14:43', NULL, NULL),
(97, 'parent', 'Sss', 'Sss', NULL, 'patan@getnada.com', '$2y$10$BnDPz552E4.1EJgv2ZpKJ.Atos6EUmb52XVgYwozia/lt73AaHd2q', '161021', 'yes', 'yes', 'no', 'active', 'no', '1115454545', NULL, NULL, '5WeMHyZzuiDv6bz1pPi37T5M7jr5pFXW9cJ4CId3Nw56k6Y1FCVluhFLjAvy', 0, 'qtryjOYNUf', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6978', '', NULL, NULL, '2018-08-01 08:14:33', '2018-08-01 14:02:24', NULL),
(98, 'parent', 'Sss', 'Ssss', NULL, 'patanyyjali@getnada.comg', '$2y$10$5JVOfTbUX/Qo48.VPSBUZ.MAGuvh9NuX5bTXfmD4ih.RXbpdMvd16', NULL, 'no', 'no', 'no', 'active', 'no', '87854512211', NULL, NULL, '502cf869d6f51974a57c1f0eacbfd164', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4493', '', NULL, NULL, '2018-08-01 08:34:02', '2018-08-01 14:04:36', NULL),
(99, 'parent', 'Asdasd', 'Asdasd', NULL, 'patanjali@getnada.com', '$2y$10$7ZHCGtmEQlNIKhzbj5NKl.xTDPg1SiQCDflvvOSfK39cvyryTDYCG', '754115', 'yes', 'yes', 'no', 'active', 'no', '78965412303', NULL, NULL, NULL, 0, 'Eiy1zImnl5', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1596', '', NULL, NULL, '2018-08-01 08:40:12', '2018-08-01 08:41:22', NULL),
(100, 'parent', 'Webeing', 'Webwing', NULL, 'tester@webwingtechnologies.com', '$2y$10$M1.MMehl2o6nElxgnuEld.4/50jfXCd55To535FQDj7xWItudzffa', NULL, 'no', 'no', 'no', 'active', 'no', '1234567890', NULL, NULL, '67411f3c25a7716ce90a8b0e0b24e67a', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1041', '', NULL, NULL, '2018-08-02 03:05:36', '2018-08-02 03:05:36', NULL),
(101, 'parent', 'BlrTesting', 'February', NULL, 'blrtesting12@gmail.com', '$2y$10$d73GJlWGnDTyf6gQcMtDXOt74iTuZJHZb6Qpm6XLTGoL9M/hfyV8u', NULL, 'no', 'no', 'no', 'active', 'no', '9092113553', NULL, NULL, 'c567f5e053754ae1da72c286d7d203c6', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6858', '', NULL, NULL, '2018-08-02 03:16:49', '2018-08-02 03:16:49', NULL),
(102, 'parent', 'Jai', 'T', NULL, 'jait@wwebwingtechnologies.com', '$2y$10$YjtybkEArEXgsDlJZBz4ZeHIsAvAUgWxbUiVYWJz1ZXO74ddTvsly', NULL, 'no', 'no', 'no', 'active', 'no', '7896541230', NULL, NULL, '2bbb90f9de3d58a151bdb885545f0bc8', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7483', '', NULL, NULL, '2018-08-02 03:23:40', '2018-08-02 03:23:40', NULL),
(103, 'student', 'Student', 'Demoss', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, '117159cab5787b832de27ced3e0ac4aa', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5120', 'ZQVa7Nogc9sSCwY', NULL, NULL, '2018-08-02 09:59:43', NULL, NULL),
(104, 'student', 'Asd', 'Asd', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, '764e4d64a9be6dd9cc582feaf02b7b4d', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5405', 'Eg0fiaIqCH8p7ZU', NULL, NULL, '2018-08-02 10:00:13', NULL, NULL),
(105, 'student', 'Ghghj', 'Ghjghjghj', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, '7ed6d513028f50c0b5aac01a77f9d1c1', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7534', 'qn4vgkxldQR7GzH', NULL, NULL, '2018-08-02 10:14:01', NULL, NULL),
(106, 'student', 'Sadasd', 'Sadasd', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, 'b67f31243eeb4bbfac754c8c130d4e02', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4551', 'LDzfG7To5w8RaNn', NULL, NULL, '2018-08-02 10:21:44', NULL, NULL),
(107, 'student', 'Sdfsd', 'Dsfsdfsdf', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, '8c0e46db1247ce630393ad0fddccfcf9', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7720', '9ZBEHMsCVFQDUjd', NULL, NULL, '2018-08-02 10:49:02', NULL, NULL),
(108, 'teacher', 'Teacher', 'Demo', NULL, 'teacher@zippiexzippiexzippiex.com', '$2y$10$uBSimTdTc9V1NRXAfIzFm.CZbeQozfQ5lNAPEkS46KolAMZaiS8gq', NULL, 'no', 'no', 'yes', 'active', 'no', '9873210654', NULL, NULL, 'd973275aa8b718cfe7568d6974e889e5', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2984', '', NULL, NULL, '2018-08-02 06:04:23', '2018-08-02 11:36:08', NULL),
(109, 'teacher', 'Deepak', 'Salunke', NULL, 'teacher@zippiex.com', '$2y$10$bCpDHDlUzknwj5RTCfKc7OM9B1zVOEKKNs02BKRCgnvzuQ3LAvziy', '547700', 'no', 'no', 'no', 'active', 'no', '6547893210', NULL, NULL, 'a4d74bbc2a699da6dc4a1a62c6ac434e', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2689', '', NULL, NULL, '2018-08-02 06:09:44', '2018-08-02 06:09:49', NULL),
(110, 'parent', 'Mayuri', 'Pardeshi', NULL, 'mayuri@pay-mon.com', '$2y$10$xTGXwrmVFHCobuANwsArq.HdMirvX3rG7Wth4cQ7QocDFoKXA7.ci', NULL, 'no', 'no', 'no', 'active', 'no', '7896541231', NULL, NULL, '3369a5d51a6f83008a5ff90690ea9b1a', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4283', '', NULL, NULL, '2018-08-02 23:37:38', '2018-08-02 23:37:38', NULL),
(111, 'teacher', 'BlrTesting', 'February', NULL, 'jai@pay-mon.com', '$2y$10$eZQnjur8ynk3C2LjeN/OeOAcxDOonwwA3Ax5goFGwOO0zkUVB2hG.', '819884', 'no', 'no', 'no', 'active', 'no', '9092113554', NULL, NULL, '9eae8f196126daba56813cbd61f663cd', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3445', '', NULL, NULL, '2018-08-02 23:40:47', '2018-08-02 23:40:53', NULL),
(112, 'teacher', 'Deepak', 'S', NULL, 'deepak@pay-mon.com', '$2y$10$XiYh/pSwU05cm8GMWBQqRObHizFdWiikzZJcRsPGyFEj.DAMEL2ry', '638232', 'no', 'yes', 'no', 'active', 'no', '4561237890', NULL, NULL, NULL, 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4749', '', NULL, NULL, '2018-08-03 06:14:49', '2018-08-03 06:15:16', NULL),
(113, 'teacher', 'Mayuri', 'Pardeshi', NULL, 'mayurip@webwingtdechnologies.com', '$2y$10$uZolTwYU9sgJjbkult.pSOWHDjXUZGEYj3UeswBIZNN4OXGJU71NC', '247219', 'no', 'no', 'no', 'active', 'no', '7539518520', NULL, NULL, '5deed10f7e29203ff937bafc8a33639f', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3994', '', NULL, NULL, '2018-08-03 06:16:56', '2018-08-03 12:21:53', NULL),
(114, 'teacher', 'Dad', 'Sfdf', NULL, 'h@pay-mon.com', '$2y$10$A35iIAdVi2QHHfiu.NkiSuxovWc6kCdry4M1M9pBJMe.WowBcHMoG', '126681', 'no', 'no', 'no', 'active', 'no', '9513578524', NULL, NULL, '05723940428ba9284b3e6570a81f1d52', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3830', '', NULL, NULL, '2018-08-03 06:22:27', '2018-08-03 06:22:35', NULL),
(115, 'teacher', 'Mayuri', 'Pardeshi', NULL, 'mayurip@webwingtechnologides.com', '$2y$10$B0nOBlt97eReO4cE7DRA3.fTSVQBbS6HVdWDHNIIddkCpX6rD8u6.', '869934', 'no', 'no', 'no', 'active', 'no', '9632580147', NULL, NULL, '9327a1af3f8f80e2798db0b0c6baca82', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7819', '', NULL, NULL, '2018-08-03 06:28:16', '2018-08-03 12:21:59', NULL),
(116, 'parent', 'Parent', 'Learning', NULL, 'parent@pay-mon.com', '$2y$10$MFlEO9iVuWJc7/AWxso5VOOME7wqsQQ9h3KcpgZ7UW3be0DBh9pvS', NULL, 'no', 'no', 'no', 'active', 'no', '6987413250', NULL, NULL, '95a541cd44d54d29676aee5b9df55b20', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8251', '', NULL, NULL, '2018-08-03 06:41:26', '2018-08-03 06:41:26', NULL),
(117, 'teacher', 'Tester', 'Webwing', NULL, 'tester@pay-mon.com', '$2y$10$VrXgvaxkIhR4jyzoCc4TW.zEtpKr0aeu4Vu/Fs.0GM3ZVVuagCN86', '641142', 'no', 'no', 'no', 'active', 'no', '4589712365', NULL, NULL, '78fc7b3e7dc03fb76996a7d4adeab0c3', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2671', '', NULL, NULL, '2018-08-03 06:50:08', '2018-08-03 06:50:12', NULL),
(118, 'parent', 'Sadasd', 'Sadasd', NULL, 'yega@getnada.com', '$2y$10$LnRtePn.80izxpRzKhE8JOr29HgfgnZJWcnoQOxF7iq02unSEYcCa', '386699', 'yes', 'no', 'no', 'active', 'no', '1544484845511', NULL, NULL, 'dbd185c45d48384ec675cd70b3546cc8', 0, 'GL1mHQbMpS', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9725', '', NULL, NULL, '2018-08-03 06:50:16', '2018-08-03 12:21:40', NULL),
(119, 'teacher', 'Mayuri', 'P', NULL, 'mayurip@webwingtechnologies.com', '$2y$10$CdpZyVFoHLI1nDZqrDTNMORhvCl9xciB1bYxyoaLDfE8mAdYo4vxy', '', 'no', 'yes', 'no', 'active', 'no', '0123456789', NULL, NULL, '9a1c1ff2abced0c689c64f1dd03869cf', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2907', '', NULL, NULL, '2018-08-03 06:52:24', '2018-08-03 12:28:56', NULL),
(120, 'parent', 'Sadsad', 'Sadsad', NULL, 'sadsad@fsdf.com', '$2y$10$0DVaElGHl5rKdGWMWhCYDuQjrOzfA4SEK9XLIbBWJ8GJP3y1J6QCO', '024792', 'yes', 'no', 'no', 'active', 'no', '12248548465', NULL, NULL, 'b19e18b925b2d28068622ec525c7ca95', 0, '0', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5997', '', NULL, NULL, '2018-08-05 00:45:15', '2018-08-05 06:19:49', NULL),
(121, 'parent', 'Sadsad', 'NJSDJKF', NULL, 'NMDSKF@GSADKL.com', '$2y$10$CUeOeBmRMFU8zZyTIUQp0.ikz7jdRCkPoI.KmakqO63MDsxB2InoS', NULL, 'no', 'no', 'no', 'active', 'no', '132684212154', NULL, NULL, '26d31e7d898fbb6ff52ed743a2634c3a', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8596', '', NULL, NULL, '2018-08-05 00:54:25', '2018-08-05 00:54:25', NULL),
(122, 'parent', 'Test', 'Joshi', NULL, 'syami@getnada.com', '$2y$10$41WbE5Iaa28MiMj3aR2Sr.zk94xhT.tQxHWRcH92L4LPBEYkwnUoK', NULL, 'no', 'no', 'no', 'active', 'no', '745488121364', NULL, NULL, '21625bb25de174de8d36783ff3be0c83', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1140', '', NULL, NULL, '2018-08-05 22:28:15', '2018-08-05 22:28:15', NULL),
(123, 'parent', 'Test', 'Ytes', NULL, 'viveks@getnada.com', '$2y$10$ZGWAg/fFVokcUVsTz6a9ue2cm1AUl1wsYq9pbzAZ/iKIa1cYLR2/i', NULL, 'no', 'no', 'no', 'active', 'no', '15454122312123', NULL, NULL, '75b49edcd27c180276707e8caa087b49', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5413', '', NULL, NULL, '2018-08-06 07:49:17', '2018-08-06 13:21:16', NULL),
(124, 'parent', 'Sadasd', 'Sadasd', NULL, 'vivesk@getnada.com', '$2y$10$egqKOLjUVQ01tXzTU8LhfeG06.bSmNp4kZQJMDe.BYNjrBVJDzOom', NULL, 'no', 'no', 'no', 'active', 'no', '8456512313', NULL, NULL, '9e3fd0e51e31384df7c89794de4fa388', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6296', '', NULL, NULL, '2018-08-06 07:51:49', '2018-08-06 13:22:11', NULL),
(125, 'parent', 'Aaaa', 'Aaaa', NULL, 'vivek@getnada.com', '$2y$10$ga7QKYbpO2U7cRI6T7ctKOo0o/XfPzBTw9r3iktjUBGsZx81Td8Qi', NULL, 'no', 'no', 'no', 'active', 'no', '5412135478', NULL, NULL, 'c7ffae048d63a895e1b3f51b13e76a8c', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0639', '', NULL, NULL, '2018-08-06 07:52:54', '2018-08-06 07:52:54', NULL),
(126, 'parent', 'Sdfsdf', 'Sdfsdfsdf', NULL, 'mayurid@getnada.com', '$2y$10$S/LqbzFgRNJBcczgeoITA.n7GX2qUSJh8REGYqBxzUoudD2Wo/dnG', NULL, 'no', 'no', 'no', 'active', 'no', '251284784251', NULL, NULL, '36c366d542bfbe57a25f53531597f990', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4799', '', NULL, NULL, '2018-08-06 08:02:45', '2018-08-07 04:26:04', NULL),
(127, 'parent', 'Sdsad', 'Sadasd', NULL, 'mayuridd@getnada.com', '$2y$10$vc/8c1ltRUEbUtEytbw6UeiNoq4cBda4vpHGhr6vsfjnMdlDCpekK', NULL, 'no', 'no', 'no', 'active', 'no', '4586421232', NULL, NULL, 'd422ab03f1fc187d316c4cde4ee072f0', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001', '', NULL, NULL, '2018-08-06 23:09:23', '2018-08-07 08:59:37', NULL),
(128, 'student', 'Iron', 'Fist', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', '', NULL, NULL, '2d60cc87a49d467a70f0705920ae6fc0', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5326', 'zjBwkF7xI08aLR5', NULL, NULL, '2018-08-07 06:25:25', NULL, NULL),
(129, 'parent', 'Sdd', 'Sddsd', NULL, 'mayuri@getnada.com', '$2y$10$C7qgiQmXJ5.sj4Rw.AcNLuTQzgtM7/CX5/KwchDaQOULKUmaNp9wa', '541451', 'yes', 'no', 'no', 'active', 'no', '2312145488787', NULL, NULL, '70532221b78dac8442f80f77226af701', 0, '0', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4258', '', NULL, NULL, '2018-08-07 03:30:15', '2018-08-07 09:14:43', NULL),
(130, 'parent', 'Sadsad', 'Sadasd', NULL, 'pooja@getnada.com', '$2y$10$vCHMsMDysK6s7wod9melIeR9C6DFBNuV8EnlvnwUC7f/oDEZVx9Qa', '443154', 'yes', 'no', 'no', 'active', 'no', '811564464', NULL, NULL, 'f0f02cc78bf0ba45a1dbd623a5d77bb4', 0, '0', 125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0245', '', NULL, NULL, '2018-08-07 03:50:34', '2018-08-07 04:07:44', NULL),
(131, 'parent', 'Sdfsdf', 'Sdfsdf', NULL, 'webwing@getnada.com', '$2y$10$sUrkcXpOo/gNK2PMkpX46OTuyk1mJpo5NtzGopLRSN9W4gFAPedwm', '489537', 'yes', 'yes', 'no', 'active', 'no', '7894521212', NULL, NULL, NULL, 0, '0', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8542', '', NULL, NULL, '2018-08-07 03:59:54', '2018-08-07 06:18:27', NULL),
(132, 'parent', 'Sadasd', 'Sadasd', NULL, 'karuna@getnada.com', '$2y$10$uTAuVe5rXUIKf2kskfsYNu8quCaz7qUrbG16SpSLoEM4BWleabvUC', NULL, 'no', 'no', 'no', 'active', 'no', '324234234324', NULL, NULL, '8ed8c9ff61cc708cdcefc6a51babf90c', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3230', '', NULL, NULL, '2018-08-07 07:48:10', '2018-08-07 07:48:10', NULL),
(133, 'parent', 'Dsfsdf', 'Sdfsdf', NULL, 'sdfsdf@dsf.com', '$2y$10$4KNxEeG4D/2BtWAyQVylvOJcMr/kt7FapG7bxdSvYCKUAW/0m6a9u', '443494', 'yes', 'no', 'no', 'active', 'no', '11223123123123', NULL, NULL, '5739b5d9e71fa9648552a52a585d2f2f', 0, '0', 125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1042', '', NULL, NULL, '2018-08-07 07:53:50', '2018-08-08 05:24:31', NULL),
(134, 'parent', 'Ddd', 'Dddd', NULL, 'ddsadsa@asdad.Com', '$2y$10$8OcXnHUvrqa375KbquATN.pQ2TpJRhwUDYQuNEYj1vQ9wObScUHKa', '586278', 'yes', 'yes', 'yes', 'active', 'no', '342342342342', NULL, NULL, 'ef6628e8fc84e503d90e2f1e864a20e7', 0, '0', 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9698', '', NULL, NULL, '2018-08-08 03:41:27', '2018-08-08 07:45:17', NULL),
(135, 'parent', 'Payment', 'Demo', NULL, 'payment@zippiex.com', '$2y$10$5ZLN0E8giX/BX3DpdXwAO.cOU/U5kVK/hBUF5PRa6efbJoY8TlYzO', NULL, 'no', 'no', 'no', 'active', 'no', '1478523690', NULL, NULL, '158cdc54256ce7a59c5b3aff15c3cd49', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1589', '', NULL, NULL, '2018-08-08 04:39:51', '2018-08-08 04:39:51', NULL),
(136, 'parent', 'Aaa', 'Aaaa', NULL, 'sf@dd.com', '$2y$10$JNExue6snnyNKCDgfE874.dhziF9yaO.vHsN6APj193szp/6BCy1S', NULL, 'no', 'no', 'no', 'active', 'no', '234234234', NULL, NULL, '304a7c51a97a9c9e1e4e5b702590eb78', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7150', '', NULL, NULL, '2018-08-08 05:27:40', '2018-08-08 05:27:40', NULL),
(137, 'teacher', 'Paypal', 'Demo', NULL, 'paypal@zippiex.com', '$2y$10$QRxY.RGhY/BzoXKBSoy76.eMp0OblZ6MHms51/M3DbVJ0CwSUYQ/K', NULL, 'no', 'no', 'yes', 'active', 'no', '3698527410', NULL, NULL, 'cda3395e2cfe1a5e51702ec1fb72222b', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4203', '', NULL, NULL, '2018-08-08 07:40:42', '2018-08-08 07:41:25', NULL),
(138, 'parent', 'Elearning', 'Demo', NULL, 'elearning@zippiex.com', '$2y$10$.cxtuZziGHTWMPr/3h2q4ebzDrOi3WxMPc0OBqRctBmtal99dFwJC', NULL, 'no', 'no', 'no', 'active', 'no', '472369810', NULL, NULL, 'a2280a4204d7a42a0582b2e4db2b14bd', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8040', '', NULL, NULL, '2018-08-08 07:43:17', '2018-08-08 07:43:17', NULL),
(139, 'parent', 'Sajid', 'Sasad', NULL, 'sajid@getnada.com', '$2y$10$SCpHgVikEmAcSMnRZfjtS.HNAn56n8ulJbqJUYY2PdgJs1BrlHcra', NULL, 'no', 'no', 'no', 'active', 'no', '418547136541', NULL, NULL, '414e972836f35607d4ccd4951709e6eb', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8994', '', NULL, NULL, '2018-08-08 22:38:30', '2018-08-08 22:38:30', NULL),
(140, 'parent', 'Parent', 'AB', NULL, 'parentab@gmail.com', '$2y$10$NOSNFhuBXv1X7JoNkrm1juRriGou6o3c.gflq3Y2vd1kMD4X7PLxq', NULL, 'no', 'no', 'no', 'active', 'no', '8547896214', NULL, NULL, 'ac2691e15266a0e5d11c378d722b3d95', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8229', '', NULL, NULL, '2018-08-09 01:29:19', '2018-08-09 01:29:19', NULL),
(141, 'parent', 'Sad', 'Sadasd', NULL, 'sd@sdd.com', '$2y$10$nYqJI9g/1Zcmc3aCfQauVe/w73uvzlaiW1cQX8hVSW5mI4Dp7Kw/u', '444329', 'yes', 'yes', 'no', 'active', 'no', '3443543545', NULL, NULL, 'c14c465ef87929b94d19e76c13ef2db0', 0, '0', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8360', '', NULL, NULL, '2018-08-09 04:34:56', '2018-08-10 07:26:29', NULL),
(142, 'parent', 'Mayuri', 'P', NULL, 'mayuri@zippiex.com', '$2y$10$di0gteqvIvQv1enfLiZE6OgfcpmIGYG4KjgTT.kXx9eM.nWyjlhze', NULL, 'no', 'no', 'no', 'active', 'no', '7350285035', NULL, NULL, '1a07cd27d3dfc4c207f336acd4ba2997', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5673', '', NULL, NULL, '2018-08-10 02:01:37', '2018-08-10 02:01:37', NULL),
(143, 'student', 'Jackhens', 'lewins', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', NULL, NULL, NULL, 'a2185f5099e65f594297576d6b13ea60', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2062', '2R1lQKGZPnerAsh', NULL, NULL, '2018-08-10 11:05:45', NULL, NULL),
(144, 'student', 'Kavita', 'G', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', NULL, NULL, NULL, 'd987a2685c5bdd3f1c0490a05d362526', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4200', 'Dpf7JLNIVTHWPuZ', NULL, NULL, '2018-08-10 12:06:19', '2018-08-10 06:36:32', '2018-08-10 06:36:32'),
(145, 'student', 'Testingblr', 'Trainer', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', NULL, NULL, NULL, '965ec7efa80d8962892705756a95a191', 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3314', 'joqcHxUKslu10SD', NULL, NULL, '2018-08-10 12:10:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wire_transfereed_request`
--

CREATE TABLE `wire_transfereed_request` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `requested_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wire_transfereed_request`
--

INSERT INTO `wire_transfereed_request` (`id`, `plan_id`, `user_id`, `requested_date`, `created_at`, `updated_at`) VALUES
(1, 1, 122, '2018-08-06', '2018-08-06 07:47:33', '2018-08-06 07:47:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_details`
--
ALTER TABLE `api_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom_student`
--
ALTER TABLE `classroom_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_enquiry`
--
ALTER TABLE `contact_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_usage`
--
ALTER TABLE `coupon_usage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_rate`
--
ALTER TABLE `currency_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template_translation`
--
ALTER TABLE `email_template_translation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_template_id` (`email_template_id`);

--
-- Indexes for table `flyer`
--
ALTER TABLE `flyer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_pages`
--
ALTER TABLE `front_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_pages_translation`
--
ALTER TABLE `front_pages_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_setting`
--
ALTER TABLE `global_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_translation`
--
ALTER TABLE `grade_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homework_image`
--
ALTER TABLE `homework_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscriber`
--
ALTER TABLE `newsletter_subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_question`
--
ALTER TABLE `program_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_reason`
--
ALTER TABLE `program_reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reference_code`
--
ALTER TABLE `reference_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share_class`
--
ALTER TABLE `share_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_status`
--
ALTER TABLE `site_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_programs`
--
ALTER TABLE `student_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_program_questions`
--
ALTER TABLE `student_program_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_translation`
--
ALTER TABLE `subject_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plan_translation`
--
ALTER TABLE `subscription_plan_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_1`
--
ALTER TABLE `template_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_2`
--
ALTER TABLE `template_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_3`
--
ALTER TABLE `template_3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_4`
--
ALTER TABLE `template_4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_5`
--
ALTER TABLE `template_5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_6`
--
ALTER TABLE `template_6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_7`
--
ALTER TABLE `template_7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_8`
--
ALTER TABLE `template_8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_9`
--
ALTER TABLE `template_9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_10`
--
ALTER TABLE `template_10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_11`
--
ALTER TABLE `template_11`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_12`
--
ALTER TABLE `template_12`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_13`
--
ALTER TABLE `template_13`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_14`
--
ALTER TABLE `template_14`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_15`
--
ALTER TABLE `template_15`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_16`
--
ALTER TABLE `template_16`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_17`
--
ALTER TABLE `template_17`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_18`
--
ALTER TABLE `template_18`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_19`
--
ALTER TABLE `template_19`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_20`
--
ALTER TABLE `template_20`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_21`
--
ALTER TABLE `template_21`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_22`
--
ALTER TABLE `template_22`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_23`
--
ALTER TABLE `template_23`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_24`
--
ALTER TABLE `template_24`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_25`
--
ALTER TABLE `template_25`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_26`
--
ALTER TABLE `template_26`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_27`
--
ALTER TABLE `template_27`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_28`
--
ALTER TABLE `template_28`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_29`
--
ALTER TABLE `template_29`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_30`
--
ALTER TABLE `template_30`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_31`
--
ALTER TABLE `template_31`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_32`
--
ALTER TABLE `template_32`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_33`
--
ALTER TABLE `template_33`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_34`
--
ALTER TABLE `template_34`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_35`
--
ALTER TABLE `template_35`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_36`
--
ALTER TABLE `template_36`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_37`
--
ALTER TABLE `template_37`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_38`
--
ALTER TABLE `template_38`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_39`
--
ALTER TABLE `template_39`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_40`
--
ALTER TABLE `template_40`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_41`
--
ALTER TABLE `template_41`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_42`
--
ALTER TABLE `template_42`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_43`
--
ALTER TABLE `template_43`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_44`
--
ALTER TABLE `template_44`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_45`
--
ALTER TABLE `template_45`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_46`
--
ALTER TABLE `template_46`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_47`
--
ALTER TABLE `template_47`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_48`
--
ALTER TABLE `template_48`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_49`
--
ALTER TABLE `template_49`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_50`
--
ALTER TABLE `template_50`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials_translation`
--
ALTER TABLE `testimonials_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `textbook`
--
ALTER TABLE `textbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `textbook_image`
--
ALTER TABLE `textbook_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `textbook_translation`
--
ALTER TABLE `textbook_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wire_transfereed_request`
--
ALTER TABLE `wire_transfereed_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_details`
--
ALTER TABLE `api_details`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `classroom_student`
--
ALTER TABLE `classroom_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_enquiry`
--
ALTER TABLE `contact_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `coupon_usage`
--
ALTER TABLE `coupon_usage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `currency_rate`
--
ALTER TABLE `currency_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `email_template_translation`
--
ALTER TABLE `email_template_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `flyer`
--
ALTER TABLE `flyer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `front_pages`
--
ALTER TABLE `front_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `front_pages_translation`
--
ALTER TABLE `front_pages_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `global_setting`
--
ALTER TABLE `global_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grade_translation`
--
ALTER TABLE `grade_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `homework_image`
--
ALTER TABLE `homework_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletter_subscriber`
--
ALTER TABLE `newsletter_subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `program_question`
--
ALTER TABLE `program_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT for table `program_reason`
--
ALTER TABLE `program_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reference_code`
--
ALTER TABLE `reference_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `share_class`
--
ALTER TABLE `share_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `site_status`
--
ALTER TABLE `site_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `student_programs`
--
ALTER TABLE `student_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `student_program_questions`
--
ALTER TABLE `student_program_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subject_translation`
--
ALTER TABLE `subject_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscription_plan_translation`
--
ALTER TABLE `subscription_plan_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `template_1`
--
ALTER TABLE `template_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `template_2`
--
ALTER TABLE `template_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `template_3`
--
ALTER TABLE `template_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `template_4`
--
ALTER TABLE `template_4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `template_5`
--
ALTER TABLE `template_5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `template_6`
--
ALTER TABLE `template_6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_7`
--
ALTER TABLE `template_7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_8`
--
ALTER TABLE `template_8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_9`
--
ALTER TABLE `template_9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_10`
--
ALTER TABLE `template_10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_11`
--
ALTER TABLE `template_11`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_12`
--
ALTER TABLE `template_12`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_13`
--
ALTER TABLE `template_13`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_14`
--
ALTER TABLE `template_14`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_15`
--
ALTER TABLE `template_15`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_16`
--
ALTER TABLE `template_16`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_17`
--
ALTER TABLE `template_17`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_18`
--
ALTER TABLE `template_18`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_19`
--
ALTER TABLE `template_19`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_20`
--
ALTER TABLE `template_20`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_21`
--
ALTER TABLE `template_21`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_22`
--
ALTER TABLE `template_22`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_23`
--
ALTER TABLE `template_23`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_24`
--
ALTER TABLE `template_24`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_25`
--
ALTER TABLE `template_25`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_26`
--
ALTER TABLE `template_26`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_27`
--
ALTER TABLE `template_27`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_28`
--
ALTER TABLE `template_28`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_29`
--
ALTER TABLE `template_29`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_30`
--
ALTER TABLE `template_30`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_31`
--
ALTER TABLE `template_31`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_32`
--
ALTER TABLE `template_32`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_33`
--
ALTER TABLE `template_33`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_34`
--
ALTER TABLE `template_34`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_35`
--
ALTER TABLE `template_35`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_36`
--
ALTER TABLE `template_36`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `template_37`
--
ALTER TABLE `template_37`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `template_38`
--
ALTER TABLE `template_38`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_39`
--
ALTER TABLE `template_39`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_40`
--
ALTER TABLE `template_40`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_41`
--
ALTER TABLE `template_41`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_42`
--
ALTER TABLE `template_42`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_43`
--
ALTER TABLE `template_43`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_44`
--
ALTER TABLE `template_44`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `template_45`
--
ALTER TABLE `template_45`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_46`
--
ALTER TABLE `template_46`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_47`
--
ALTER TABLE `template_47`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template_48`
--
ALTER TABLE `template_48`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_49`
--
ALTER TABLE `template_49`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template_50`
--
ALTER TABLE `template_50`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimonials_translation`
--
ALTER TABLE `testimonials_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `textbook`
--
ALTER TABLE `textbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `textbook_image`
--
ALTER TABLE `textbook_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `textbook_translation`
--
ALTER TABLE `textbook_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `wire_transfereed_request`
--
ALTER TABLE `wire_transfereed_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
