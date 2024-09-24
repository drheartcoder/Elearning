-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2018 at 11:43 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_data` ()  BEGIN
SELECT * FROM `users`;
END$$

DELIMITER ;

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
  `account_number` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ifsc_code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `swift_code` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `account_number`, `ifsc_code`, `swift_code`, `created_at`, `updated_at`) VALUES
(1, '324234', '12234', '324', '2018-10-04 09:49:50', '2018-10-20 07:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details_translation`
--

CREATE TABLE `bank_details_translation` (
  `id` int(11) NOT NULL,
  `locale` varchar(20) NOT NULL,
  `bank_details_id` int(11) DEFAULT NULL,
  `account_holder_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `branch` varchar(200) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_details_translation`
--

INSERT INTO `bank_details_translation` (`id`, `locale`, `bank_details_id`, `account_holder_name`, `bank_name`, `branch`, `note`, `created_at`, `updated_at`) VALUES
(1, 'en', 1, 'rohini', 'ICICI', 'nashik road', 'test', '2018-10-20 07:11:06', '2018-10-20 07:11:06'),
(2, 'cn', 1, '测试 测试 测试', 'Hdfach', '测试', '测试', '2018-10-20 07:11:06', '2018-10-20 07:11:06');

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
(1, 'J2sF51Nc3gSPMzj', 'Class 5', 'class-5', 162, 1, 1, 1, NULL, '2018-09-12', '1', 'no', NULL, '2018-09-12 09:16:46', '2018-10-10 09:08:54', '2018-10-10 09:08:54'),
(2, 'SJZhnELNW12kFMb', 'Annual Class', 'annual-class', 219, 1, 1, 1, NULL, '2019-12-26', '1', 'no', NULL, '2018-10-01 05:16:07', '2018-10-06 06:17:43', '2018-10-06 06:17:43'),
(3, 'h23p07leb5ijJc9', 'Class2', 'class2', 219, 1, 1, 1, NULL, '2018-10-19', '1', 'no', NULL, '2018-10-06 06:05:35', '2018-10-10 09:08:50', '2018-10-10 09:08:50'),
(4, 'lh1ZAfkL2VxJ4R3', 'Class 11', 'class-1', 219, 1, 1, 1, NULL, '2018-10-10', '1', 'yes', 218, '2018-10-06 06:18:14', '2018-10-06 07:20:43', NULL),
(5, 'TuK7IUVxFM1pPY4', 'Class 11', 'class-1', 218, 1, 1, 1, NULL, '2018-10-10', '1', 'no', NULL, '2018-10-06 07:20:43', '2018-10-10 09:08:41', '2018-10-10 09:08:41'),
(6, 'Bt5SKpgDlw1rqHA', 'Class1', 'class1', 211, 1, 1, 1, NULL, '2018-10-06', '1', 'no', NULL, '2018-10-06 10:37:51', '2018-10-08 08:46:55', '2018-10-08 08:46:55'),
(7, 'yQwVvI6PXWUAimt', 'Class2', 'class2', 211, 1, 1, 2, NULL, '2018-10-18', '1', 'no', NULL, '2018-10-06 12:35:16', '2018-10-06 12:35:16', NULL),
(8, 'WJYaK6fMoPbEF8w', 'Class A', 'class-a', 255, 1, 1, 1, NULL, '2018-10-08', '1', 'yes', 211, '2018-10-08 08:49:33', '2018-10-10 09:08:37', '2018-10-10 09:08:37'),
(9, 'DPl45V0MKqYfTre', 'Class A', 'class-a', 211, 1, 1, 1, NULL, '2018-10-08', '1', 'no', NULL, '2018-10-08 08:51:02', '2018-10-09 04:22:38', '2018-10-09 04:22:38'),
(10, 'Snzp7wKFIERH1As', 'Class 1', 'class-1', 211, 1, 1, 1, NULL, '2018-10-09', '1', 'no', NULL, '2018-10-09 04:22:51', '2018-10-09 04:22:51', NULL),
(11, 'urXYVs2yMZKlCwg', 'Class3', 'class3', 211, 2, 3, 3, NULL, '2018-10-31', '1', 'no', NULL, '2018-10-09 11:10:38', '2018-10-12 03:57:29', '2018-10-12 03:57:29'),
(12, 'jpSihVJPFsl4BmO', 'Class4', 'class4', 211, 2, 3, 3, NULL, '2018-10-31', '1', 'no', NULL, '2018-10-09 11:10:55', '2018-10-12 03:57:25', '2018-10-12 03:57:25'),
(13, '5jNpU0cFlbKTg8i', 'Testing Class', 'testing-class', 211, 2, 3, 3, NULL, '2018-10-30', '1', 'no', NULL, '2018-10-11 05:50:13', '2018-10-12 03:57:22', '2018-10-12 03:57:22'),
(14, 'yM8cunTF4JHkB7U', 'Class 14', 'class-14', 211, 2, 3, 3, NULL, '2018-10-30', '1', 'no', NULL, '2018-10-11 06:08:25', '2018-10-12 03:57:19', '2018-10-12 03:57:19'),
(15, 'cymXHkeUaQD01qj', 'Cc-Test Class', 'cc-test-class', 255, 2, 3, 3, NULL, '2018-10-12', '1', 'no', NULL, '2018-10-11 06:17:39', '2018-10-11 06:17:39', NULL),
(16, 'J4wd6As10jWqmvh', 'Test new class', 'test-new-class', 255, 1, 1, 1, NULL, '2018-10-25', '1', 'no', NULL, '2018-10-11 06:38:23', '2018-10-11 06:38:23', NULL),
(17, 'KkjV9GW6rmwHBNs', 'New class', 'new-class', 211, 1, 1, 1, NULL, '2018-10-12', '1', 'no', NULL, '2018-10-12 03:58:29', '2018-10-12 03:58:29', NULL),
(18, 'stzEZbcWDgoFpn5', 'Class orange', 'class-orange', 274, 1, 1, 1, NULL, '2018-10-15', '1', 'no', NULL, '2018-10-12 05:46:12', '2018-10-12 05:46:12', NULL),
(19, 'j9ovmYzBw7aWpeV', 'Class blackberry', 'class-blackberry', 274, 1, 1, 1, NULL, '2018-10-15', '1', 'no', NULL, '2018-10-15 08:47:58', '2018-10-20 07:20:30', '2018-10-20 07:20:30'),
(20, 'txrD0oUEziVNWZI', 'Teacher class', 'teacher-class', 274, 2, 3, 3, NULL, '2018-10-27', '1', 'no', NULL, '2018-10-20 07:28:30', '2018-10-20 07:29:34', '2018-10-20 07:29:34');

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
(1, 1, 162, 166, 'active', '2018-09-12 09:17:11', '2018-09-12 09:17:11'),
(2, 2, 219, 220, 'active', '2018-10-01 05:16:36', '2018-10-01 05:16:36'),
(3, 2, 219, 223, 'active', '2018-10-01 05:45:52', '2018-10-01 05:45:52'),
(4, 2, 219, 222, 'active', '2018-10-01 06:09:47', '2018-10-01 06:09:47'),
(5, 2, 219, 224, 'active', '2018-10-01 06:11:14', '2018-10-01 06:11:14'),
(9, 5, 218, 241, 'active', '2018-10-06 07:20:43', '2018-10-06 07:20:43'),
(10, 5, 218, 242, 'active', '2018-10-06 07:20:43', '2018-10-06 07:20:43'),
(11, 3, 219, 245, 'active', '2018-10-06 08:46:51', '2018-10-06 08:46:51'),
(14, 6, 211, 249, 'active', '2018-10-06 12:27:37', '2018-10-06 12:27:37'),
(19, 8, 255, 254, 'active', '2018-10-08 08:52:59', '2018-10-08 08:52:59'),
(23, 13, 211, 260, 'active', '2018-10-11 05:50:42', '2018-10-11 05:50:42'),
(27, 16, 255, 254, 'active', '2018-10-11 06:50:31', '2018-10-11 06:50:31'),
(29, 16, 255, 279, 'active', '2018-10-15 08:36:49', '2018-10-15 08:36:49'),
(30, 19, 274, 281, 'active', '2018-10-15 08:48:16', '2018-10-20 07:18:50'),
(31, 18, 274, 264, 'active', '2018-10-15 08:50:17', '2018-10-20 07:18:08'),
(33, 16, 255, 264, 'active', '2018-10-15 08:52:56', '2018-10-15 08:52:56'),
(34, 20, 274, 282, 'active', '2018-10-20 07:28:51', '2018-10-20 07:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `contact_address`
--

CREATE TABLE `contact_address` (
  `id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_address`
--

INSERT INTO `contact_address` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '2018-10-16 10:52:15', '2018-10-16 11:50:07'),
(2, '1', '2018-10-16 11:21:00', '2018-10-16 11:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `contact_address_translation`
--

CREATE TABLE `contact_address_translation` (
  `id` int(11) NOT NULL,
  `contact_address_id` int(11) NOT NULL,
  `address` text CHARACTER SET utf8,
  `locale` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_address_translation`
--

INSERT INTO `contact_address_translation` (`id`, `contact_address_id`, `address`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'MERIT TED, CHINA Telephone: 010-684-70-073 Address: 902 Room BIT Building Haidian District, Beijing City, China 100081', 'en', '2018-10-16 10:52:15', '2018-10-16 11:21:23'),
(2, 1, '优界科技 中国 电话 ：010-6847-0073 地址：北京市海淀区中关村南⼤街9号理⼯科技⼤厦902室 邮编： 100081', 'cn', '2018-10-16 10:52:15', '2018-10-16 11:21:23'),
(3, 2, 'MERIT TED, The USA Address: 625 West Madison Street, Chicago, IL 60661', 'en', '2018-10-16 11:21:00', '2018-10-16 11:29:36'),
(4, 2, 'MERIT TED, Chicago, The USA Address: 625 West Madison Street, IL 60661', 'cn', '2018-10-16 11:21:00', '2018-10-16 11:29:36'),
(5, 3, 'sadasd', 'en', '2018-10-16 11:35:56', '2018-10-16 11:35:56'),
(6, 3, 'sadasd', 'cn', '2018-10-16 11:35:56', '2018-10-16 11:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `contact_enquiry`
--

CREATE TABLE `contact_enquiry` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone_code` int(11) DEFAULT NULL,
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

INSERT INTO `contact_enquiry` (`id`, `first_name`, `last_name`, `email`, `phone_code`, `mobile`, `subject`, `message`, `is_read_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Ria', 'Patil', 'rohinij@webwing.com', NULL, '8345345545', 'test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', '0', '2018-09-18 07:20:19', '2018-09-18 07:20:19', NULL),
(3, 'Dsfsd', 'Fsdfsdf', 'dfdgdf2@gmail.com', NULL, '345345345345', 'test', 'kjdsfdfsdfdsf', '0', '2018-09-24 10:36:43', '2018-09-24 10:36:43', NULL),
(4, 'Rohini', 'Jagtap', 'rohiniJ@webwing.com', NULL, '435345345345', 'test', 'test', '0', '2018-10-03 10:52:19', '2018-10-03 10:52:19', NULL),
(5, 'Kecam', 'Kecam', 'kecam@nada.email', 7, '634234234234', 'test', 'my test', '0', '2018-10-03 11:19:05', '2018-10-03 11:19:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country_phone_codes`
--

CREATE TABLE `country_phone_codes` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_phone_codes`
--

INSERT INTO `country_phone_codes` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93, '2016-10-12 10:21:14', '0000-00-00 00:00:00', NULL),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263, '2016-10-12 10:21:41', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 NOT NULL,
  `discount_amount` float NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `coupon_option` int(11) DEFAULT NULL COMMENT 'no of times coupons use',
  `coupen_usage_count` int(11) NOT NULL COMMENT 'this copuen code usage count',
  `status` enum('0','1') NOT NULL COMMENT '0-inactive,1-active',
  `owner` varchar(100) NOT NULL,
  `coupen_type` enum('PARENT','TEACHER','','') DEFAULT NULL,
  `reward_type_for_referral` enum('validity_extension','reference_amount','both') NOT NULL COMMENT 'for referral user settings ',
  `reward_amount` float NOT NULL COMMENT 'for referral user settings (%)',
  `validity_extension` varchar(255) NOT NULL COMMENT 'for referral user settings (months)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `created_by`, `coupon_code`, `title`, `discount_amount`, `start_date`, `end_date`, `coupon_option`, `coupen_usage_count`, `status`, `owner`, `coupen_type`, `reward_type_for_referral`, `reward_amount`, `validity_extension`, `created_at`, `updated_at`) VALUES
(1, 1, '03UXDZW6Q6', 'Admin coupon', 100, '2018-10-10', '2018-10-18', 10, 10, '1', 'admin', NULL, 'validity_extension', 0, '', '2018-10-06 13:03:19', '2018-10-10 10:00:26'),
(2, 0, '1022', 'Incentive of 50.00', 40, '2018-09-25', '2018-10-31', NULL, 0, '1', 'cececy cc', 'TEACHER', 'reference_amount', 50, '', '2018-10-08 08:48:23', '2018-10-11 12:45:14'),
(4, 261, '8029', 'Extension of 3 months', 10, '2018-09-27', '2018-10-26', NULL, 0, '1', 'Testng Parent', 'PARENT', 'validity_extension', 200, '3', '2018-10-11 05:58:56', '2018-10-25 12:01:05'),
(5, 271, '0935', 'Extension of 3 months', 10, '2018-09-27', '2018-10-26', NULL, 0, '1', 'Aaaa Bbbb', 'PARENT', 'validity_extension', 200, '3', '2018-10-11 12:48:45', '2018-10-25 12:01:05'),
(6, 0, '7370', 'Incentive of 50.00', 40, '2018-09-25', '2018-10-31', NULL, 0, '1', 'teacher teacher', 'TEACHER', 'reference_amount', 50, '', '2018-10-12 05:37:00', '2018-10-12 05:37:00'),
(7, 276, '4576', 'Extension of 3 months', 10, '2018-09-27', '2018-10-26', NULL, 0, '1', 'Parent P', 'PARENT', 'validity_extension', 200, '3', '2018-10-12 07:11:10', '2018-10-25 12:01:05'),
(8, 278, '5710', 'Extension of 3 months', 10, '2018-09-27', '2018-10-26', NULL, 0, '1', 'Cokumut Cc', 'PARENT', 'validity_extension', 200, '3', '2018-10-12 12:57:03', '2018-10-25 12:01:05'),
(9, 1, 'PA0VXN3NR8', 'Admin coupen 1', 40, '2018-10-20', '2018-10-24', 5, 5, '1', 'admin', NULL, 'validity_extension', 0, '', '2018-10-20 04:56:54', '2018-10-20 04:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usage`
--

CREATE TABLE `coupon_usage` (
  `id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `reward_type_for_referral` enum('','validity_extension','reference_amount','both') NOT NULL COMMENT 'for referral user settings ',
  `reward_amount` float NOT NULL COMMENT 'for referral user reward amount in CNY',
  `validity_extension` varchar(255) NOT NULL COMMENT 'for referral user settings ',
  `discount_amount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `per_unit_conversion_rate` float DEFAULT NULL,
  `conversion_reward_amount` float DEFAULT NULL,
  `from_currency` int(11) DEFAULT NULL,
  `to_currency` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon_usage`
--

INSERT INTO `coupon_usage` (`id`, `coupon_id`, `user_id`, `created_by`, `reward_type_for_referral`, `reward_amount`, `validity_extension`, `discount_amount`, `created_at`, `updated_at`, `per_unit_conversion_rate`, `conversion_reward_amount`, `from_currency`, `to_currency`) VALUES
(1, 1, 213, 1, 'validity_extension', 0, '', 100, '2018-10-06 13:04:41', '0000-00-00 00:00:00', 0, NULL, 2, 1),
(2, 1, 213, 1, 'validity_extension', 0, '', 100, '2018-10-09 09:16:52', '0000-00-00 00:00:00', 0, NULL, 2, 1),
(3, 3, 213, 1, 'validity_extension', 0, '', 50, '2018-10-09 09:54:17', '0000-00-00 00:00:00', 0, NULL, 0, 0),
(4, 3, 213, 1, 'validity_extension', 0, '', 50, '2018-10-09 09:59:17', '0000-00-00 00:00:00', 0, NULL, 2, 1),
(5, 3, 213, 1, 'validity_extension', 0, '', 50, '2018-10-09 11:46:45', '0000-00-00 00:00:00', 0, NULL, 2, 1),
(6, 7, 182, 276, 'both', 200, '4', 70, '2018-10-15 11:41:16', '0000-00-00 00:00:00', 0, NULL, 2, 1),
(7, 6, 276, 274, 'reference_amount', 50, '', 40, '2018-10-19 13:29:03', '0000-00-00 00:00:00', 0, NULL, 2, 1),
(8, 6, 276, 274, 'reference_amount', 50, '', 40, '2018-10-19 13:33:20', '0000-00-00 00:00:00', 0, NULL, 2, 1),
(9, 9, 276, 1, 'validity_extension', 0, '', 40, '2018-10-20 05:02:51', '0000-00-00 00:00:00', 0, NULL, 2, 1);

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
(3, 'Indian Rupee', 'indian-rupee', 'INR', '<i class=\"fa fa-inr\" aria-hidden=\"true\"></i>', '1', '2018-06-15 06:27:33', '2018-09-28 11:27:28'),
(4, 'dsfsd', 'dsfsd', 'sdfsdf', '465456', '1', '2018-10-17 08:53:40', '2018-10-17 08:53:49');

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
  `rate` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_rate`
--

INSERT INTO `currency_rate` (`id`, `from_currency_id`, `from_currency_code`, `to_currency_id`, `to_currency_code`, `rate`, `created_at`, `updated_at`) VALUES
(1, 1, '', 2, '', 6.84836, '2018-08-22 06:04:04', '2018-10-17 08:54:12'),
(2, 1, 'USD', 3, 'INR', 72.445, '2018-08-22 06:04:04', '2018-09-24 04:20:09'),
(3, 2, 'CNY', 1, 'USD', 0.146017, '2018-08-22 06:04:05', '2018-09-24 04:20:09'),
(4, 2, 'CNY', 3, 'INR', 10.5768, '2018-08-22 06:04:05', '2018-09-24 04:20:09'),
(5, 3, 'INR', 1, 'USD', 0.013805, '2018-08-22 06:04:06', '2018-09-24 04:20:10'),
(6, 3, 'INR', 2, 'CNY', 0.094548, '2018-08-22 06:04:06', '2018-09-24 04:20:10');

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
(1, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##ACTIVATION_URL##~##PROJECT_NAME##~##REFERENCE_CODE##', NULL, '2017-08-21 05:17:22', '2018-09-17 14:57:09'),
(2, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##RESET_LINK##~##PROJECT_NAME##', NULL, NULL, '2018-07-11 07:09:08'),
(3, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##STUDENTPIN##~##PROJECT_NAME##', NULL, NULL, '2018-08-03 07:09:08'),
(4, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##PROJECT_NAME##', NULL, NULL, '2018-07-22 05:51:36'),
(5, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##PROJECT_NAME##~##PROJECT_URL##', NULL, NULL, '2018-09-20 12:06:31'),
(6, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##PROJECT_NAME##~##PROJECT_URL##', NULL, NULL, '2018-08-14 03:05:30'),
(7, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##PROJECT_NAME##~##MESSAGE##', NULL, NULL, '2018-09-17 14:57:41'),
(8, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##PROJECT_NAME##~##PLAN_NAME##~##START_DATE##~##END_DATE##~##VALIDITY##', NULL, NULL, '2018-08-24 06:42:38'),
(9, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##SUBJECT##~##PROJECT_NAME##~##PLAN_NAME##', NULL, '2017-08-21 05:17:22', '2018-09-21 06:05:24'),
(10, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##SUBJECT##~##EXTENSION##~##DISCOUNT_AMOUNT##', NULL, '2017-08-21 05:17:22', '2018-09-28 07:06:28'),
(11, 'Merit Learning', 'noreply@meritlearning.com', '##NAME##~##MESSAGE##~##UNSUBSCRIBE_LINK##', NULL, '2018-09-25 05:59:38', '2018-09-25 05:59:38');

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
(9, 5, 'Lwdzhvhh_elearning Invitation', 'Lwdzhvhh_elearning Invitation', '<table style=\"margin-bottom: 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">##PROJECT_NAME## Invitation</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">You are invited on ##PROJECT_NAME##, Please click on below link to register your account</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p>##PROJECT_URL##</p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, NULL, '2018-09-20 12:06:31'),
(10, 5, 'Elearning Invitation', 'Elearning Invitation', '<table style=\"margin-bottom: 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">##PROJECT_NAME## Invitation</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">You are invited on ##PROJECT_NAME## and register as \"Teacher\" to enjoy our service, Please click on below link to register your account</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p>##PROJECT_URL##</p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, NULL, '2018-09-20 12:06:31'),
(11, 1, 'Registration Email', 'Registration Successful', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Registration Successful</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">\r\n<p>你好， 谢谢 非常欢迎 for your interest in ##PROJECT_NAME##.Please click on below link to verify and activate your account</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=\"listed-btn\">##ACTIVATION_URL##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p></p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, '2018-08-02 23:59:58', '2018-09-17 14:57:09'),
(12, 6, 'Wire Transfer Request', 'Wire Transfer Request', '<table style=\"margin-bottom: 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Payment Wire Tranfer Request </td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">Admin,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">You have received Payment Wire Transder Request from ##NAME## parent on ##PROJECT_NAME##.</td>\r\n</tr>\r\n\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, NULL, '2018-08-04 01:30:12'),
(13, 6, 'Wire Transfer Request', 'Wire Transfer Request', '<table style=\"margin-bottom: 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Payment Wire Tranfer Request </td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">Admin,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">You have received Payment Wire Transder Request from ##NAME## parent on ##PROJECT_NAME##.</td>\r\n</tr>\r\n\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, NULL, '2018-08-04 01:30:12'),
(14, 7, 'Contact Enquiry', 'Contact Enquiry', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Contact Enquiry</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">##MESSAGE##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p></p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, NULL, '2018-08-24 06:42:38'),
(15, 7, 'Contact Enquiry', 'Contact Enquiry', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Contact Enquiry</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">你好， 谢谢 非常欢迎 ##MESSAGE##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">\r\n<p></p>\r\n</td>\r\n</tr>\r\n<tr></tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, NULL, '2018-09-17 14:57:41'),
(16, 8, '	\r\nMembership Plan Expiry Remainder', 'Membership Plan Going to Expire in 3 days', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Membership Plan Expiry Remainder</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n\r\n<tr>\r\n   <td style=\"color: #545454;font-size: 15px;padding: 12px 30px;\">Your current ##PLAN_NAME## membership Plan going to expire in 3 days, Please upgrade your plan for continue our service on ##PROJECT_NAME##, Please find following expired plan details :                         \r\n   </td>\r\n</tr>\r\n\r\n<tr>\r\n      <td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">Current Plan details :</td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\"> Current Plan Name : ##PLAN_NAME## <br /> Validity In Year : ##VALIDITY## <br/> Plan Start Date : ##START_DATE## <br/> Plan Expiry Date : ##END_DATE## </td>\r\n</tr>\r\n\r\n<tr>\r\n   <td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, NULL, '2018-08-24 06:42:38'),
(17, 8, '	\r\nMembership Plan Expiry Remainder', 'Membership Plan Going to Expire in 3 days', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">Membership Plan Expiry Remainder</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n\r\n<tr>\r\n   <td style=\"color: #545454;font-size: 15px;padding: 12px 30px;\">Your current ##PLAN_NAME## membership Plan going to expire in 3 days, Please upgrade your plan for continue our service on ##PROJECT_NAME##, Please find following expired plan details :                         \r\n   </td>\r\n</tr>\r\n\r\n<tr>\r\n      <td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">Current Plan details :</td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\"> Current Plan Name : ##PLAN_NAME## <br /> Validity In Year : ##VALIDITY## <br/> Plan Start Date : ##START_DATE## <br/> Plan Expiry Date : ##END_DATE## </td>\r\n</tr>\r\n\r\n<tr>\r\n   <td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, NULL, '2018-08-24 06:42:38'),
(18, 9, 'Transaction Email', 'Transaction Mail', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">##SUBJECT##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">\r\n<p>Your transaction of plan - ##PLAN_NAME## is successfully done,Please find the below attachment of invoice</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; Plan Name:##PLAN_NAME##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; Transaction Id:##TRANSACTION_ID##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; Transaction Amount:##TRANSACTION_AMOUNT##</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, '2017-08-20 22:17:22', '2018-09-21 06:05:24'),
(19, 9, 'Transaction Email', 'Transaction Email', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">##SUBJECT##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">\r\n<p>Your transaction of ##PLAN## is successfully done,Please find the below attachment of invoice</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; Plan Name:##PLAN_NAME##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; Transaction Id:##TRANSACTION_ID##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; Transaction Amount:##TRANSACTION_AMOUNT##</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, '2018-09-20 12:23:01', '2018-09-20 12:23:01'),
(20, 10, 'Refer Coupon Email', 'Refer Coupon Email', '<table style=\"margin-bottom: 0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">##SUBJECT##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">&nbsp;Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">\r\n<p>&nbsp;Please share this discount coupen ##DISCOUNT_COUPEN## with your friends and get discount amount &amp; validity extension on membership plan.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Extention&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : ##EXTENSION##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Discount Amount : ##DISCOUNT_AMOUNT##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Validity Start date : ##START_DATE##&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Validity End date&nbsp; &nbsp;: ##END_DATE##&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, '2017-08-20 22:17:22', '2018-09-28 07:05:19'),
(21, 10, 'Coupen Email', 'Coupen Email', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td>##SUBJECT##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td>Hello <span>##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p>Please share this discount coupen ##DISCOUNT_COUPEN## with your friends and get discount amount &amp; validity extension on membership plan.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Extention: ##EXTENSION##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Discount Amount: ##DISCOUNT_AMOUNT##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Validity Start date : ##START_DATE##&nbsp; &nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Validity End date&nbsp; &nbsp;: ##END_DATE##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, '2018-09-21 05:20:21', '2018-09-28 07:06:28'),
(22, 11, 'NewsLetter Email', 'NewsLetter Email', '<table style=\"margin-bottom: 0;\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">News Letter</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">##MESSAGE##</td>\r\n</tr>\r\n<tr>\r\n<td class=\"listed-btn\"><a target=\"_blank\" href=\"##UNSUBSCRIBE_LINK##\" rel=\"noopener noreferrer\">Unsubscribe</a></td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'en', NULL, '2018-09-21 05:20:21', '2018-09-21 05:20:21'),
(23, 11, 'NewsLetter Email', 'NewsLetter Email', '<table style=\"margin-bottom: 0;\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 15px; padding-top: 3px; text-align: center; font-family: robotomedium;\">News Letter</td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #333333; font-size: 16px; padding: 0 30px;\">Hello <span style=\"color: #0050a0; font-family: \'ubuntumedium\',sans-serif;\">##NAME##,</span></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #545454; font-size: 15px; padding: 12px 30px;\">##MESSAGE##</td>\r\n</tr>\r\n<tr>\r\n<td class=\"listed-btn\"><a target=\"_blank\" href=\"##UNSUBSCRIBE_LINK##\" rel=\"noopener noreferrer\">Unsubscribe</a></td>\r\n</tr>\r\n<tr>\r\n<td height=\"40\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'cn', NULL, '2018-09-21 05:20:21', '2018-09-21 05:20:21');

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
(1, 1, 'Flyer', 'Enroll Flyer', 'E-Learning - Admin Flyer', 'admin@support.com', '<table style=\"font-family: Arial, Helvetica, sans-serif; font-size: 14px;\" tbody=\"\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center; padding: 20px 0;\"><img src=\"##PROJECT_URL##/images/emailer-logo.png\" alt=\"content-img\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding: 0 60px;\" height=\"2\">\r\n<div class=\"gray-border-section\"></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td>Dear Parent of <span style=\"font-weight: 600;\">##USERNAME##:</span></td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">We are using a program called <strong>##PROGRAM##</strong> to increase speed and accuracy in <strong>##SUBJECT##</strong>. <strong>##USERNAME##</strong> is invited to spend a few minutes each day practicing&nbsp;<strong>##SUBJECT##</strong>&nbsp;on a computer, tablet, or phone.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">If you would like <strong>##USERNAME##</strong> to do <strong>##PROGRAM##</strong>&nbsp;on a tablet or smartphone, look for <strong>##PROJECT_NAME##</strong> in the app store. The app costs $5. On a laptop or desktop computer, he/she can do <strong>##PROGRAM##</strong>&nbsp;for free at <a href=\"##PROJECT_URL##\" style=\"color: #0f6bb0; font-weight: 600;\">##PROJECT_URL##.</a></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td style=\"padding: 15px 0;\" width=\"20%\"><img style=\"margin-left: -20px;\" src=\"##PROJECT_URL##/images/emailer-content-img.png\" alt=\"content-img\" /></td>\r\n<td style=\"padding-left: 20px;\" width=\"80%\"><span style=\"color: #0f6bb0; font-weight: 500; display: block;\">Here\'s what you need to do: </span> <span>In the app or on the website, select <span style=\"color: #0f6bb0; font-weight: 500;\">Enroll.</span></span> <span style=\"padding: 15px 0px; display: block;\"><span style=\"padding: 15px 0px; display: block;\">Enter your email address and <strong><span style=\"color: #0f6bb0;\">##USERNAME##\'s</span></strong> enrollment code, <span style=\"color: #0f6bb0; font-weight: bold;\">##CODE##<br /><br /></span><strong>Here is ##USERNAME##\'s sign up information :&nbsp;</strong><br /><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"><br /><strong>Teacher Email&nbsp; :</strong></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"> </span><span style=\"font-size: inherit;\"><strong><span style=\"color: #0f6bb0;\"><span style=\"font-family: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\">##TEACHER_EMAIL##<br /></span></span><span style=\"font-family: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\">Name&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</span></strong></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"> </span><span style=\"font-size: inherit;\"><strong><span style=\"color: #0f6bb0;\"><span style=\"font-family: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\">##USERNAME##<br /></span></span><span style=\"font-family: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\">PIN&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</span></strong></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"> </span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"><strong><span style=\"color: #0f6bb0;\">##PIN##</span></strong><br /></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"><strong>Class&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong> <strong><span style=\"color: #0f6bb0;\">##CLASS##</span></strong><br /></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"><strong>Grade&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</strong> <strong><span style=\"color: #0f6bb0;\">##GRADE##</span></strong><br /></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"><strong>Subject&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</strong> <strong><span style=\"color: #0f6bb0;\">##SUBJECT##</span></strong><br /></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"><strong>Program&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</strong> <strong><span style=\"color: #0f6bb0;\">##PROGRAM##</span></strong></span></span></span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">This will (1) create a parent account for you if you don\'t have one, (2) link <strong>##USERNAME##\'s</strong> account to your account so you can review his/her progress, and (3) save <strong>##USERNAME##\'s</strong> account information for easy sign-in on that computer or device.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">If you already have a parent account for <strong>##USERNAME##</strong> from a previous class or personal use, then this enrollment</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">process will allow <strong>##USERNAME##</strong> to resume <strong>##PROGRAM##</strong>&nbsp;where he/she left off rather than starting over in my classroom.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">For more information about <strong>##PROJECT_NAME##</strong> watch the videos on their website, <a href=\"##PROJECT_URL##\" style=\"color: #0f6bb0; font-weight: 600;\"> ##PROJECT_URL##.</a></td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Think of <strong>##PROGRAM##</strong> as a <strong>##SUBJECT##</strong> vitamin! For best results, <strong>##USERNAME##</strong> should do <strong>##PROGRAM##</strong> once per day as regularly as possible. It only takes a few minutes so make it a part of your daily routine.&nbsp;<strong>##SUBJECT##</strong> facts are the building blocks of your child\'s&nbsp;<strong>##SUBJECT##</strong>&nbsp;education and your child will be well rewarded for the time they spend practicing on <strong>##PROJECT_NAME##</strong>.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Thank you!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px; font-weight: 600; color: #0f6bb0;\">##TEACHER_NAME##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', '##USERNAME##~##CODE##~##PIN##~##PROJECT_NAME##~##PROJECT_URL##~##TEACHER_NAME##~##TEACHER_EMAIL##~##CLASS##~##GRADE##~##SUBJECT##~##PROGRAM##', 'en', '2018-04-18 13:00:00', '2018-10-03 23:04:58'),
(2, 1, 'Flyer', 'Enroll Flyer', 'E-Learning - Admin Flyer', 'admin@support.com', '<table style=\"font-family: Arial, Helvetica, sans-serif; font-size: 14px;\" tbody=\"\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center; padding: 20px 0;\"><img src=\"##PROJECT_URL##/images/emailer-logo.png\" alt=\"content-img\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding: 0 60px;\" height=\"2\">\r\n<div class=\"gray-border-section\"></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td>Dear Parent of <span style=\"font-weight: 600;\">##USERNAME##:</span></td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">We are using a program called <strong>##PROGRAM##</strong> to increase speed and accuracy in <strong>##SUBJECT##</strong>. <strong>##USERNAME##</strong> is invited to spend a few minutes each day practicing&nbsp;<strong>##SUBJECT##</strong>&nbsp;on a computer, tablet, or phone.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">If you would like <strong>##USERNAME##</strong> to do <strong>##PROGRAM##</strong>&nbsp;on a tablet or smartphone, look for <strong>##PROJECT_NAME##</strong> in the app store. The app costs $5. On a laptop or desktop computer, he/she can do <strong>##PROGRAM##</strong>&nbsp;for free at <a href=\"##PROJECT_URL##\" style=\"color: #0f6bb0; font-weight: 600;\">##PROJECT_URL##.</a></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td style=\"padding: 15px 0;\" width=\"20%\"><img style=\"margin-left: -20px;\" src=\"##PROJECT_URL##/images/emailer-content-img.png\" alt=\"content-img\" /></td>\r\n<td style=\"padding-left: 20px;\" width=\"80%\"><span style=\"color: #0f6bb0; font-weight: 500; display: block;\">Here\'s what you need to do: </span> <span>In the app or on the website, select <span style=\"color: #0f6bb0; font-weight: 500;\">Enroll.</span></span> <span style=\"padding: 15px 0px; display: block;\"><span style=\"padding: 15px 0px; display: block;\">Enter your email address and <strong><span style=\"color: #0f6bb0;\">##USERNAME##\'s</span></strong> enrollment code, <span style=\"color: #0f6bb0; font-weight: bold;\">##CODE##<br /><br /></span><strong>Here is ##USERNAME##\'s sign up information :&nbsp;</strong><br /><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"><br /><strong>Teacher Email&nbsp; :</strong></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"> </span><span style=\"font-size: inherit;\"><strong><span style=\"color: #0f6bb0;\"><span style=\"font-family: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\">##TEACHER_EMAIL##<br /></span></span><span style=\"font-family: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\">Name&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</span></strong></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"> </span><span style=\"font-size: inherit;\"><strong><span style=\"color: #0f6bb0;\"><span style=\"font-family: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\">##USERNAME##<br /></span></span><span style=\"font-family: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\">PIN&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</span></strong></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"> </span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"><strong><span style=\"color: #0f6bb0;\">##PIN##</span></strong><br /></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"><strong>Class&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong> <strong><span style=\"color: #0f6bb0;\">##CLASS##</span></strong><br /></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"><strong>Grade&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</strong> <strong><span style=\"color: #0f6bb0;\">##GRADE##</span></strong><br /></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"><strong>Subject&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</strong> <strong><span style=\"color: #0f6bb0;\">##SUBJECT##</span></strong><br /></span><span style=\"font-family: inherit; font-size: inherit; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit;\"><strong>Program&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</strong> <strong><span style=\"color: #0f6bb0;\">##PROGRAM##</span></strong></span></span></span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">This will (1) create a parent account for you if you don\'t have one, (2) link <strong>##USERNAME##\'s</strong> account to your account so you can review his/her progress, and (3) save <strong>##USERNAME##\'s</strong> account information for easy sign-in on that computer or device.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">If you already have a parent account for <strong>##USERNAME##</strong> from a previous class or personal use, then this enrollment</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">process will allow <strong>##USERNAME##</strong> to resume <strong>##PROGRAM##</strong>&nbsp;where he/she left off rather than starting over in my classroom.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">For more information about <strong>##PROJECT_NAME##</strong> watch the videos on their website, <a href=\"##PROJECT_URL##\" style=\"color: #0f6bb0; font-weight: 600;\"> ##PROJECT_URL##.</a></td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Think of <strong>##PROGRAM##</strong> as a <strong>##SUBJECT##</strong> vitamin! For best results, <strong>##USERNAME##</strong> should do <strong>##PROGRAM##</strong> once per day as regularly as possible. It only takes a few minutes so make it a part of your daily routine.&nbsp;<strong>##SUBJECT##</strong> facts are the building blocks of your child\'s&nbsp;<strong>##SUBJECT##</strong>&nbsp;education and your child will be well rewarded for the time they spend practicing on <strong>##PROJECT_NAME##</strong>.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Thank you!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px; font-weight: 600; color: #0f6bb0;\">##TEACHER_NAME##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', '##USERNAME##~##CODE##~##PIN##~##PROJECT_NAME##~##PROJECT_URL##~##TEACHER_NAME##~##TEACHER_EMAIL##~##CLASS##~##GRADE##~##SUBJECT##~##PROGRAM##', 'cn', '2018-04-18 03:30:00', '2018-10-03 23:04:48'),
(3, 2, 'Flyer', 'Sign In Flyer', 'E-Learning - Admin Flyer', 'admin@support.com', '<table style=\"font-family: Arial, Helvetica, sans-serif; font-size: 14px;\" tbody=\"\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center; padding: 20px 0;\"><img src=\"##PROJECT_URL##/images/emailer-logo.png\" alt=\"content-img\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding: 0 60px;\" height=\"2\">\r\n<div class=\"gray-border-section\"></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td>Dear Parent of <span style=\"font-weight: 600;\">##USERNAME##:</span></td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">We are using a program called <strong>##PROGRAM##</strong> to increase speed and accuracy in arithmetic. <strong>##USERNAME##</strong> is invited to spend a few minutes each day practicing <strong>##SUBJECT##</strong> on a computer, tablet, or phone. If you would like <strong>##USERNAME##</strong> to do <strong>##PROGRAM##</strong> on a tablet or smartphone, look for <strong>##PROJECT_NAME##</strong> in the app store. The app costs $5. On a laptop or desktop computer, he/she can do <strong>##PROGRAM##</strong> for free at <a href=\"##PROJECT_URL##\" style=\"color: #0f6bb0; font-weight: 600;\">##PROJECT_URL##.</a></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td style=\"padding: 15px 0;\" width=\"20%\"><img style=\"margin-left: -20px;\" src=\"##PROJECT_URL##/images/emailer-content-img.png\" alt=\"content-img\" /></td>\r\n<td style=\"padding-left: 20px;\" width=\"80%\"><span>In the app or on the website, select <span style=\"color: #0f6bb0; font-weight: 500;\">Sign In.</span></span> <span style=\"padding: 15px 0px; display: block;\"><strong>Here is ##USERNAME##\'s sign in information,</strong><br /> <br /><span style=\"font-weight: 600;\">Email&nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;</span><span style=\"color: #0f6bb0;\">##EMAIL##</span><br /><span style=\"font-weight: 600;\">Name&nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;</span><span style=\"color: #0f6bb0;\">##USERNAME##</span><br /><span style=\"font-weight: 600;\">PIN&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;</span><span style=\"color: #0f6bb0;\">##PIN##</span><br /><strong>Class&nbsp; &nbsp; &nbsp; &nbsp;:</strong>&nbsp;<span style=\"color: #0f6bb0;\">##CLASS##</span><br /><strong>Grade&nbsp; &nbsp; &nbsp; :</strong>&nbsp;<span style=\"color: #0f6bb0;\">##GRADE##</span><br /><strong>Subject&nbsp; &nbsp; :</strong>&nbsp;<span style=\"color: #0f6bb0;\">##SUBJECT##</span><br /><strong>Program&nbsp; :</strong>&nbsp;<span style=\"color: #0f6bb0;\">##PROGRAM##</span><br /><br /> </span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">After <strong>##USERNAME##</strong> signs in the first time, this information will be remembered so he/she can sign in by simply clicking on his/her name.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Think of <strong>##PROGRAM##</strong> as a <strong>##SUBJECT##</strong> vitamin! For best results, <strong>##USERNAME##</strong> should do <strong>##PROGRAM##</strong> once per day as regularly as possible. It only takes a few minutes so make it a part of your daily routine. <strong>##SUBJECT##</strong> facts are the building blocks of your child\'s&nbsp;<strong>##SUBJECT##</strong>&nbsp;education and your child will be well rewarded for the time they spend practicing on <strong>##PROJECT_NAME##</strong>.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Thank you!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px; font-weight: 600; color: #0f6bb0;\">##TEACHER_NAME##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', '##USERNAME##~##EMAIL##~##CODE##~##PIN##~##PROJECT_NAME##~##PROJECT_URL##~##TEACHER_NAME##~##TEACHER_EMAIL##~##CLASS##~##GRADE##~##SUBJECT##~##PROGRAM##', 'en', '2018-04-18 13:00:00', '2018-10-03 23:04:35'),
(4, 2, 'Flyer', 'Sign In Flyer', 'E-Learning - Admin Flyer', 'admin@support.com', '<table style=\"font-family: Arial, Helvetica, sans-serif; font-size: 14px;\" tbody=\"\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center; padding: 20px 0;\"><img src=\"##PROJECT_URL##/images/emailer-logo.png\" alt=\"content-img\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"padding: 0 60px;\" height=\"2\">\r\n<div class=\"gray-border-section\"></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td>Dear Parent of <span style=\"font-weight: 600;\">##USERNAME##:</span></td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">We are using a program called <strong>##PROGRAM##</strong> to increase speed and accuracy in arithmetic. <strong>##USERNAME##</strong> is invited to spend a few minutes each day practicing <strong>##SUBJECT##</strong> on a computer, tablet, or phone. If you would like <strong>##USERNAME##</strong> to do <strong>##PROGRAM##</strong> on a tablet or smartphone, look for <strong>##PROJECT_NAME##</strong> in the app store. The app costs $5. On a laptop or desktop computer, he/she can do <strong>##PROGRAM##</strong> for free at <a href=\"##PROJECT_URL##\" style=\"color: #0f6bb0; font-weight: 600;\">##PROJECT_URL##.</a></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td style=\"padding: 15px 0;\" width=\"20%\"><img style=\"margin-left: -20px;\" src=\"##PROJECT_URL##/images/emailer-content-img.png\" alt=\"content-img\" /></td>\r\n<td style=\"padding-left: 20px;\" width=\"80%\"><span>In the app or on the website, select <span style=\"color: #0f6bb0; font-weight: 500;\">Sign In.</span></span> <span style=\"padding: 15px 0px; display: block;\"><strong>Here is ##USERNAME##\'s sign in information,</strong><br /> <br /><span style=\"font-weight: 600;\">Email&nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;</span><span style=\"color: #0f6bb0;\">##EMAIL##</span><br /><span style=\"font-weight: 600;\">Name&nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;</span><span style=\"color: #0f6bb0;\">##USERNAME##</span><br /><span style=\"font-weight: 600;\">PIN&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;</span><span style=\"color: #0f6bb0;\">##PIN##</span><br /><strong>Class&nbsp; &nbsp; &nbsp; &nbsp;:</strong>&nbsp;<span style=\"color: #0f6bb0;\">##CLASS##</span><br /><strong>Grade&nbsp; &nbsp; &nbsp; :</strong>&nbsp;<span style=\"color: #0f6bb0;\">##GRADE##</span><br /><strong>Subject&nbsp; &nbsp; :</strong>&nbsp;<span style=\"color: #0f6bb0;\">##SUBJECT##</span><br /><strong>Program&nbsp; :</strong>&nbsp;<span style=\"color: #0f6bb0;\">##PROGRAM##</span><br /><br /> </span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">After <strong>##USERNAME##</strong> signs in the first time, this information will be remembered so he/she can sign in by simply clicking on his/her name.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"20\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Think of <strong>##PROGRAM##</strong> as a <strong>##SUBJECT##</strong> vitamin! For best results, <strong>##USERNAME##</strong> should do <strong>##PROGRAM##</strong> once per day as regularly as possible. It only takes a few minutes so make it a part of your daily routine. <strong>##SUBJECT##</strong> facts are the building blocks of your child\'s&nbsp;<strong>##SUBJECT##</strong>&nbsp;education and your child will be well rewarded for the time they spend practicing on <strong>##PROJECT_NAME##</strong>.</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px;\">Thank you!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 14px; font-weight: 600; color: #0f6bb0;\">##TEACHER_NAME##</td>\r\n</tr>\r\n<tr>\r\n<td height=\"10\"></td>\r\n</tr>\r\n</tbody>\r\n</table>', '##USERNAME##~##EMAIL##~##CODE##~##PIN##~##PROJECT_NAME##~##PROJECT_URL##~##TEACHER_NAME##~##TEACHER_EMAIL##~##CLASS##~##GRADE##~##SUBJECT##~##PROGRAM##', 'cn', '2018-04-18 03:30:00', '2018-10-03 23:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `front_pages`
--

CREATE TABLE `front_pages` (
  `id` int(11) NOT NULL,
  `page_slug` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8 NOT NULL DEFAULT '1' COMMENT '0-inactive,1-active',
  `banner_image` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `front_pages`
--

INSERT INTO `front_pages` (`id`, `page_slug`, `status`, `banner_image`, `order`, `created_at`, `updated_at`) VALUES
(1, 'about-us', '1', NULL, 4, '2018-06-14 23:57:44', '2018-10-22 05:04:58'),
(2, 'help', '1', NULL, 3, '2018-06-16 04:26:00', '2018-10-25 12:27:44'),
(3, 'terms-&-conditions', '1', NULL, 6, '2018-06-14 23:59:34', '2018-10-22 06:54:22'),
(4, 'privacy-policy', '1', NULL, 7, '2018-06-16 04:27:00', '2018-10-22 04:39:32'),
(5, 'home', '1', NULL, 1, '2018-06-16 04:27:00', '2018-10-26 07:04:56'),
(6, 'price-page', '1', NULL, 2, '2018-09-18 05:54:36', '2018-10-25 12:32:37'),
(7, 'contact-us-page', '1', 'bae33a110bfb3a0c2f62b738686af15ecd7ea597.jpg', 8, '2018-09-18 05:54:36', '2018-10-22 04:41:06');

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
(1, 1, 'en', 'About Us', 'About Us', 'About Us', 'About Us', 'About Us', '<div class=\"gray-btn-main-section pircing-main-section\">\r\n<div class=\"container\">\r\n<div class=\"about-us-img-section\"><img src=\"images/about-us-top-img.jpg\" alt=\"about us image\" /></div>\r\n<div class=\"pricing-head-content-section\">\r\n<div class=\"priceing-content-section\">Thanks for visiting meritted.com. &mdash;&mdash;-欢迎访问 meritTED.com\r\n<h1>Merit Ted</h1>\r\n<p>We are passionate about creating and supporting the best educational technology possible. We develop learning plan of native projects used by millions of learners, from children to adults. People count on us to make learning as effec- tive as it can be, and we are committed to solving the real-world challenges faced by students and teachers around the planet.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"about-us-points\">\r\n<div class=\"container\">\r\n<div class=\"row display-table-section\">\r\n<div class=\"col-sm-4 col-md-4 col-lg-4 display-table-cell-section\">\r\n<div class=\"about-point-img\"><img src=\"images/about-us-online-test-img.png\" alt=\"online test\" /></div>\r\n<div class=\"about-point-head\">Online Test</div>\r\n<div class=\"about-point-description\">Lorem ipsum <g class=\"gr_ gr_62 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling multiReplace\" id=\"62\" data-gr-id=\"62\">dolor</g> <g class=\"gr_ gr_60 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar multiReplace\" id=\"60\" data-gr-id=\"60\">sit</g> <g class=\"gr_ gr_31 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"31\" data-gr-id=\"31\">amet</g>, <g class=\"gr_ gr_33 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"33\" data-gr-id=\"33\">consectetur</g> <g class=\"gr_ gr_34 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"34\" data-gr-id=\"34\">adipiscing</g> elitLorem <g class=\"gr_ gr_30 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"30\" data-gr-id=\"30\">ipsum</g> <g class=\"gr_ gr_63 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling multiReplace\" id=\"63\" data-gr-id=\"63\">dolor</g> sit <g class=\"gr_ gr_32 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"32\" data-gr-id=\"32\">amet</g>, <g class=\"gr_ gr_35 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"35\" data-gr-id=\"35\">consectetur</g> <g class=\"gr_ gr_36 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"36\" data-gr-id=\"36\">adipiscing</g> <g class=\"gr_ gr_37 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"37\" data-gr-id=\"37\">elit</g>...</div>\r\n</div>\r\n<div class=\"col-sm-4 col-md-4 col-lg-4 display-table-cell-section\">\r\n<div class=\"about-point-img\"><img src=\"images/about-us-practice-tutorials-img.png\" alt=\"Practice Tutorials\" /></div>\r\n<div class=\"about-point-head\">Practice Tutorials</div>\r\n<div class=\"about-point-description\">Lorem ipsum <g class=\"gr_ gr_66 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling multiReplace\" id=\"66\" data-gr-id=\"66\">dolor</g> <g class=\"gr_ gr_64 gr-alert gr_gramm gr_inline_cards gr_run_anim Grammar multiReplace\" id=\"64\" data-gr-id=\"64\">sit</g> <g class=\"gr_ gr_39 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"39\" data-gr-id=\"39\">amet</g>, <g class=\"gr_ gr_41 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"41\" data-gr-id=\"41\">consectetur</g> <g class=\"gr_ gr_42 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"42\" data-gr-id=\"42\">adipiscing</g> elitLorem <g class=\"gr_ gr_38 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"38\" data-gr-id=\"38\">ipsum</g> <g class=\"gr_ gr_67 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling multiReplace\" id=\"67\" data-gr-id=\"67\">dolor</g> sit <g class=\"gr_ gr_40 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace\" id=\"40\" data-gr-id=\"40\">amet</g>, <g class=\"gr_ gr_43 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"43\" data-gr-id=\"43\">consectetur</g> <g class=\"gr_ gr_44 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"44\" data-gr-id=\"44\">adipiscing</g> <g class=\"gr_ gr_45 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling\" id=\"45\" data-gr-id=\"45\">elit</g>...</div>\r\n</div>\r\n<div class=\"col-sm-4 col-md-4 col-lg-4 display-table-cell-section\">\r\n<div class=\"about-point-img\"><img src=\"images/about-us-ask-question-img.png\" alt=\"Ask a Question\" /></div>\r\n<div class=\"about-point-head\">Ask a Question</div>\r\n<div class=\"about-point-description\">Ask a QuestionAsk a QuestionAsk a Question</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"container\">\r\n<div class=\"about-marit-learning\">\r\n<div class=\"about-us-img-section\"><img src=\"images/about-us-bottom-img.jpg\" alt=\"about us image\" /></div>\r\n<div class=\"pricing-head-content-section\">\r\n<div class=\"priceing-content-section\">\r\n<div class=\"priceing-content-section\">\r\n<h1>Learning and Brain Sciences</h1>\r\n<p>Using a pioneering brain-imaging technique called magnetoencephalography (MEG), new neuroscience research is providing some clarity &mdash; insight that has implications regarding understanding of language learning. The Positive Learning System (MLearning) focus on trigger learning and acquisition through the growing brain from children to adults. Parlayed this technique into educational programming that strengthening neural pathways at critical periods of learning and diversity thinking. MLearning will enable teacher to identify and measure problems early on, when inter- ventions to address them are most effective.</p>\r\n</div>\r\n<div class=\"priceing-content-section\">\r\n<h1>Technology</h1>\r\n<p>We invent new educational technologies that reshape the teaching and learning process. We believe in the power of technology, and we relish the challenge of building elegant and creative solutions to seemingly intractable problem- s.We take the power of technology and apply it to huge, important issues in education today. And through technology, we create lasting solutions&mdash;millions of students and teachers are smart learning on MLearning.</p>\r\n</div>\r\n<div class=\"priceing-content-section\">\r\n<h1>MLearning</h1>\r\n<p>MLearning support learners in more than 190 countries around the world. We provide the USA English plans from kindergarten through high school. Elementary school teachers get lesson plans from APP (MLearning ) that are ready to use in their classrooms. Home schoolers can get lesson plans to use at home and parents can get ideas for educational activities to use with their children.We have worked hard to develop a in- ternational and good extensive resource for educators. With students, parents, and teachers all on the same page and working together toward shared goals, we can ensure that students make progress each year and graduate from school prepared to succeed in life.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '2018-06-14 23:57:44', '2018-10-22 05:04:58'),
(2, 1, 'cn', '关于我们', '关于我们', '关于我们', '关于我们', '关于我们', '<div class=\"gray-btn-main-section pircing-main-section\">\r\n<div class=\"container\">\r\n<div class=\"about-us-img-section\"><img src=\"images/about-us-top-img.jpg\" alt=\"about us image\" /></div>\r\n<div class=\"pricing-head-content-section\">\r\n<div class=\"priceing-content-section\">感谢您访问meritted.com &mdash;&mdash;-欢迎访问 meritTED.com\r\n<h1>关于优界</h1>\r\n<p>我们热衷于创造和支支持最好的教育技术实现。我们通过研究数百万儿儿童至至成年年人人的学习,开发基于不不同国家教学大大纲的 教学计划。人人们通过我们的技术把学习变得更更为有效,我们致力力力于解决世界各地学生生和老老老师面面临的现实挑战。</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"about-us-points\">\r\n<div class=\"container\">\r\n<div class=\"row display-table-section\">\r\n<div class=\"col-sm-4 col-md-4 col-lg-4 display-table-cell-section\">\r\n<div class=\"about-point-img\"><img src=\"images/about-us-online-test-img.png\" alt=\"online test\" /></div>\r\n<div class=\"about-point-head\">在线测试</div>\r\n<div class=\"about-point-description\">Lorem存有Lorem存有Lorem存有Lorem存有Lorem存有Lorem存有</div>\r\n</div>\r\n<div class=\"col-sm-4 col-md-4 col-lg-4 display-table-cell-section\">\r\n<div class=\"about-point-img\"><img src=\"images/about-us-practice-tutorials-img.png\" alt=\"Practice Tutorials\" /></div>\r\n<div class=\"about-point-head\">练习教程</div>\r\n<div class=\"about-point-description\">Lorem存有Lorem存有Lorem存有Lorem存有Lorem存有Lorem存有</div>\r\n</div>\r\n<div class=\"col-sm-4 col-md-4 col-lg-4 display-table-cell-section\">\r\n<div class=\"about-point-img\"><img src=\"images/about-us-ask-question-img.png\" alt=\"Ask a Question\" /></div>\r\n<div class=\"about-point-head\">问一个问题</div>\r\n<div class=\"about-point-description\">Lorem存有Lorem存有Lorem存有Lorem存有Lorem存有Lorem存有</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"container\">\r\n<div class=\"about-marit-learning\">\r\n<div class=\"about-us-img-section\"><img src=\"images/about-us-bottom-img.jpg\" alt=\"about us image\" /></div>\r\n<div class=\"pricing-head-content-section\">\r\n<div class=\"priceing-content-section\">\r\n<div class=\"priceing-content-section\">\r\n<h1>技术</h1>\r\n<p>我们创新教育技术,重塑教学过程。我们相信科技的力力力量量,并为哪些看似难解的问题与逻辑,建立立简洁和创造性的解决 方方案。我们利利用用科技的力力力量量,将其应用用于当今教育中的挑战性问题。通过技术,我们创造了了持久的解决方方案,数以百万 计的学生生和教师在应用用我们的教学系统更更聪明的学习。</p>\r\n</div>\r\n<div class=\"priceing-content-section\">\r\n<h1>学习与脑科学</h1>\r\n<p>一一个开创性的脑成像技术被称为大大脑活动扫描器器(MEG),为新的神经科学研究对语言言学习的理理解和影响,提供了了清晰的 大大脑内部活动观察。将此技术应用用于教育性的程序设计中,以强化在关键学习期和多元化思维上的神经通路路活动。</p>\r\n</div>\r\n<div class=\"priceing-content-section\">\r\n<h1>正向干干预学习系统</h1>\r\n<p>正向干干预学习系统(MLearning) 通过美国心心理理学家、大大脑发育和神经认知专家的合作,提供大大脑在语言言与思维逻辑发展 关键阶段进行行行正向干干预学习的训练系统。该系统采用用正向干干预模式,让大大脑的神经感知与记忆系统学习效率加倍。基于 大大脑神经认知发展与语言言系统形成规律律,针对不不同年年龄阶段大大脑对语言言和逻辑的最佳学习方方式,提供与各年年龄段儿儿童大大 脑发育相匹配的训练体系。加强大大脑部对语言言的获取、感知、分析、理理解、反馈和记忆能力力力,让孩子子更更聪明的学习!</p>\r\n</div>\r\n<div class=\"priceing-content-section\">\r\n<h1>美国英语</h1>\r\n<p>MLearning支支持在全世界190多个国家的学生生学习。 提供从幼儿儿园至至高高中阶段完整的美国英文文教学方方案。教师可以通过 注册优学(MLearning)APP获得完整的纯英文文课堂教学方方案,用用于各年年级的英文文教学;家庭自自主学习者可以通过优学获 得与美国学生生相同的英文文教学方方案,用用于自自我第二二语言言学习;父父母母可以通过优学获得传统美国教学思路路,并将其应用用在 对孩子子的教育活动中。我们为那些关注下一一代成⻓长的教育工工作者,贡献国际化且内容丰富的教学资源。 我们的训练系统帮助学生生建立立学习兴趣,每天拓拓展孩子子在不不同方方向的知识边界。让孩子子具备优秀的英语逻辑表达、理理解 多元文文化、学习多种沟通技巧。我们与学生生,家⻓长和教师都在为同一一个目目标工工作,确保学生生每一一年年都能取得进步,并为 他们的人人生生成功做好每个阶段的准备。</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '2018-06-14 23:57:44', '2018-10-17 08:51:55'),
(3, 2, 'en', 'Products', 'Products', 'Products', 'Products', 'Products', '<div class=\"gray-btn-main-section pircing-main-section\">\r\n<div class=\"container\">\r\n<div class=\"multi-products-wrapper\">\r\n<div class=\"product-section\">\r\n<div class=\"row\">\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 img-section\">\r\n<div class=\"product-img\"><img src=\"images/about-us-top-img.jpg\" class=\"img-responsive\" alt=\"Product image\" /></div>\r\n</div>\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 product-details\">\r\n<h4>In upper-level maths:</h4>\r\n<p><i class=\"fas fa-quote-left\"></i> We\'ve only been using IXL for a couple of weeks but already most of my maths-phobic students have blossomed. And my better students are thrilled to have more challenging work always available at their fingertips. <i class=\"fas fa-quote-right\"></i></p>\r\n<h5>Victor Lena, algebra teacher, Reston, Virginia, U.S.A.</h5>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"product-section\">\r\n<div class=\"row\">\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 img-section\">\r\n<div class=\"product-img\"><img src=\"images/about-us-top-img.jpg\" class=\"img-responsive\" alt=\"Product image\" /></div>\r\n</div>\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 product-details\">\r\n<h4>In upper-level maths:</h4>\r\n<p><i class=\"fas fa-quote-left\"></i> We\'ve only been using IXL for a couple of weeks but already most of my maths-phobic students have blossomed. And my better students are thrilled to have more challenging work always available at their fingertips. <i class=\"fas fa-quote-right\"></i></p>\r\n<h5>Victor Lena, algebra teacher, Reston, Virginia, U.S.A.</h5>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"product-section\">\r\n<div class=\"row\">\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 img-section\">\r\n<div class=\"product-img\"><img src=\"images/about-us-top-img.jpg\" class=\"img-responsive\" alt=\"Product image\" /></div>\r\n</div>\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 product-details\">\r\n<h4>In upper-level maths:</h4>\r\n<p><i class=\"fas fa-quote-left\"></i> We\'ve only been using IXL for a couple of weeks but already most of my maths-phobic students have blossomed. And my better students are thrilled to have more challenging work always available at their fingertips. <i class=\"fas fa-quote-right\"></i></p>\r\n<h5>Victor Lena, algebra teacher, Reston, Virginia, U.S.A.</h5>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"product-section\">\r\n<div class=\"row\">\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 img-section\">\r\n<div class=\"product-img\"><img src=\"images/about-us-top-img.jpg\" class=\"img-responsive\" alt=\"Product image\" /></div>\r\n</div>\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 product-details\">\r\n<h4>In upper-level maths:</h4>\r\n<p><i class=\"fas fa-quote-left\"></i> We\'ve only been using IXL for a couple of weeks but already most of my maths-phobic students have blossomed. And my better students are thrilled to have more challenging work always available at their fingertips. <i class=\"fas fa-quote-right\"></i></p>\r\n<h5>Victor Lena, algebra teacher, Reston, Virginia, U.S.A.</h5>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '2018-06-14 23:57:44', '2018-10-23 13:06:39'),
(4, 2, 'cn', '产品', '产品', '产品', '产品', '产品', '<div class=\"gray-btn-main-section pircing-main-section\">\r\n<div class=\"container\">\r\n<div class=\"multi-products-wrapper\">\r\n<div class=\"product-section\">\r\n<div class=\"row\">\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 img-section\">\r\n<div class=\"product-img\"><img src=\"images/about-us-top-img.jpg\" class=\"img-responsive\" alt=\"Product image\" /></div>\r\n</div>\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 product-details\">\r\n<h4>在高级数学中:</h4>\r\n<p><i class=\"fas fa-quote-left\"></i> 我们只使用了IXL几周，但我的大部分数学恐惧症学生已经蓬勃发展。我更好的学生很高兴能够随时随地获得更具挑战性的工作 <i class=\"fas fa-quote-right\"></i></p>\r\n<h5>Victor Lena，代数老师，美国弗吉尼亚州雷斯顿。</h5>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"product-section\">\r\n<div class=\"row\">\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 img-section\">\r\n<div class=\"product-img\"><img src=\"images/about-us-top-img.jpg\" class=\"img-responsive\" alt=\"Product image\" /></div>\r\n</div>\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 product-details\">\r\n<h4>在高级数学中:</h4>\r\n<p><i class=\"fas fa-quote-left\"></i> 我们只使用了IXL几周，但我的大部分数学恐惧症学生已经蓬勃发展。我更好的学生很高兴能够随时随地获得更具挑战性的工作。<i class=\"fas fa-quote-right\"></i></p>\r\n<h5>Victor Lena，代数老师，美国弗吉尼亚州雷斯顿。</h5>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"product-section\">\r\n<div class=\"row\">\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 img-section\">\r\n<div class=\"product-img\"><img src=\"images/about-us-top-img.jpg\" class=\"img-responsive\" alt=\"Product image\" /></div>\r\n</div>\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 product-details\">\r\n<h4>在高级数学中:</h4>\r\n<p><i class=\"fas fa-quote-left\"></i>我们只使用了IXL几周，但我的大部分数学恐惧症学生已经蓬勃发展。我更好的学生很高兴能够随时随地获得更具挑战性的工作。 <i class=\"fas fa-quote-right\"></i></p>\r\n<h5>Victor Lena，代数老师，美国弗吉尼亚州雷斯顿</h5>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"product-section\">\r\n<div class=\"row\">\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 img-section\">\r\n<div class=\"product-img\"><img src=\"images/about-us-top-img.jpg\" class=\"img-responsive\" alt=\"Product image\" /></div>\r\n</div>\r\n<div class=\"col-sm-6 col-md-6 col-lg-6 product-details\">\r\n<h4>在高级数学中:</h4>\r\n<p><i class=\"fas fa-quote-left\"></i> 我们只使用了IXL几周，但我的大部分数学恐惧症学生已经蓬勃发展。我更好的学生很高兴能够随时随地获得更具挑战性的工作。 <i class=\"fas fa-quote-right\"></i></p>\r\n<h5>Victor Lena，代数老师，美国弗吉尼亚州雷斯顿</h5>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '2018-06-14 23:57:44', '2018-10-25 12:27:44'),
(5, 3, 'en', 'Terms of Service', 'Terms of Service', 'Terms of Service', 'Terms of Service', 'Terms of Service', '<div class=\"gray-btn-main-section pircing-main-section\"><!-- Terms And Conditions start here-->\r\n<div class=\"container\">\r\n<div class=\"terms-condi-main-block\">\r\n<div class=\"welcome-to-travel\">\r\n<h1>1. ACCEPTANCE OF TERMS</h1>\r\n<p class=\"terms-margin-botto\">Beijing Merit Ted Co.,Ltd. ( Merit Ted) provides its service to you, subject to the following Terms of Service (\"TOS\"), which may be updated by us from time to time without notice to you. When using particular Merit Ted services, you and Merit Ted shall be subject to any posted guidelines or rules applicable to such services which may be posted from time to time. All such guidelines or rules are hereby incorporated by reference into the TOS.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>2. DESCRIPTION OF SERVICE</h1>\r\n<p class=\"terms-margin-botto m-b-0\">Merit Ted currently provides users with a service to help learn and practice mathematics, language arts, science, social studies. Unless explicitly stated otherwise, any new features that augment or enhance the current Service, including the release of new Merit Ted properties, shall be subject to the TOS. You understand and agree that the Service is provided \"as-is\" and that Merit Ted assumes no responsibility for the timeliness, deletion, misdelivery or failure to store any user communications or personalization settings.</p>\r\n<p class=\"terms-margin-botto m-b-0\">In order to use the Service, you must obtain access to the Internet, either directly or through devices that access web-based content, and pay any service fees associated with such access. In addition, you must provide all equipment necessary to make such connection to the Internet, including a computer and modem or other access device.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>3. YOUR REGISTRATION OBLIGATIONS</h1>\r\n<p class=\"terms-margin-botto\">In consideration of your use of the Service, you agree to: (a) provide true, accurate, current and complete information about yourself as prompted by the Service\'s registration form (such information being the \"Registration Data\") and (b) maintain and promptly update the Registration Data to keep it true, accurate, current and complete. If you provide any information that is untrue, inaccurate, not current or incomplete, or Merit Ted has reasonable grounds to suspect that such information is untrue, inaccurate, not current or incomplete, Merit Ted has the right to suspend or terminate your account and refuse any and all current or future use of the Service (or any portion thereof).</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>4. MEMBERSHIP AND BILLING</h1>\r\n<ul>\r\n<li>Family Memberships</li>\r\n<li>You can find the specific details regarding your membership with Merit Ted at any time. Simply sign in to your Merit Ted parent account, go to the Membership tab, and click Manage your account.</li>\r\n<li>a. Billing By starting your Merit Ted membership, you are expressly agreeing that we are authorized to charge you the membership fee associated with the type of membership (monthly or yearly) you chose during registration. You agree that we are authorized to charge you the membership fee at the then-current rate to the Payment Method you provided during registration (or to a different Payment Method if you change your account information). Please note that prices and charges are subject to change with notice. Payments are nonrefundable and there are no refunds or credits for partially used periods. We may change the fees and charges in effect, or add new fees and charges from time to time, but we will give you advance notice of these changes by e-mail. If you want to use a different Payment Method or if there is a change in Payment Method, such as your credit card validity or expiration date, you may edit your Payment Method information from your Account management page. To access your Account management page sign in to your Merit Ted parent account, go to the Membership tab, and click Manage your account. If your Payment Method reaches its expiration date and you do not edit your Payment Method information or cancel your account (see, \"Cancellation\" below), you authorize us to continue billing that Payment Method and you remain responsible for any uncollected amounts</li>\r\n<li>b. Ongoing Membership Your Merit Ted membership will continue in effect unless and until you cancel your membership or we terminate it. You must cancel your membership before it renews each billing period in order to avoid billing of the next membership fee to your Payment Method. We will bill the membership fee at the then-current rate plus any applicable tax to the Payment Method you provide to us during registration (or to a different Payment Method if you change your account information). Membership fees are fully earned upon payment.</li>\r\n<li>b. Ongoing Membership Your Merit Ted membership will continue in effect unless and until you cancel your membership or we terminate it. You must cancel your membership before it renews each billing period in order to avoid billing of the next membership fee to your Payment Method. We will bill the membership fee at the then-current rate plus any applicable tax to the Payment Method you provide to us during registration (or to a different Payment Method if you change your account information). Membership fees are fully earned upon payment.</li>\r\n<li>c. Cancellation You may cancel your Merit Ted membership at any time, and cancellation will be effective immediately. You will continue to have access to the program until the current billing period ends. We do not provide refunds or credits for any partially used membership periods. To cancel your membership, sign in to your parent account and click the words \"Cancel membership\" on your Account management page. Follow the instructions for cancellation under the heading \"Cancel Membership.\"</li>\r\n<li>d. Purchases through the Apple iTunes store If you purchased your Merit Ted membership through your iTunes account, sections 4a through 4c of \"Membership and Billing\" may not apply to you. Because such a purchase is between you and the Apple iTunes store, and not Merit Ted, you acknowledge and agree that Merit Ted is not responsible for billing for your membership and is not responsible or liable for any claims relating to your purchase. If you have questions about membership or billing, you should contact the Apple iTunes store directly</li>\r\n</ul>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>5. MERIT TED PRIVACY POLICY</h1>\r\n<p class=\"terms-margin-botto\">Registration Data and certain other information about you is subject to our Privacy Policy</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>6. MEMBER ACCOUNT, PASSWORD AND SECURITY</h1>\r\n<p class=\"terms-margin-botto\">You will have a password and account designation upon completing the Service\'s registration process. You are responsible for maintaining the confidentiality of the password and account and are fully responsible for all activities that occur under your password or account. You agree to (a) immediately notify Merit Ted of any unauthorized use of your password or account or any other breach of security, and (b) ensure that you exit from your account at the end of each session. Merit Ted cannot and will not be liable for any loss or damage arising from your failure to comply with this Section 6. Merit Ted accounts may not be shared by more than one person unless express authorization is given by Beijing Merit Ted Co.,Ltd.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>7. MEMBER CONDUCT</h1>\r\n<p class=\"terms-margin-botto\">You understand that all information including but not limited to data, text, software, photographs, graphics, illustrations, artwork, video, music, sound, messages, names, logos, trademarks, service marks and other materials (\"Content\"), whether publicly posted or privately transmitted, are the sole responsibility of the person from which such Content originated. This means that you, and not Merit Ted, are entirely responsible for all Content that you upload, post, e-mail, transmit or otherwise make available via the Service. Merit Ted does not control the Content posted via the Service and, as such, does not guarantee the accuracy, integrity or quality of such Content. Under no circumstances will Merit Ted be liable in any way for any Content, including, but not limited to, for any errors or omissions in any Content, or for any loss or damage of any kind incurred as a result of the use of any Content posted, e-mailed, transmitted or otherwise made available via the Service. You understand that the technical processing and transmission of the Service, including your Content, may involve (a) transmissions over various networks; and (b) changes to conform and adapt to technical requirements of connecting networks or devices.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>8. SPECIAL ADMONITIONS FOR INTERNATIONAL USE</h1>\r\n<p class=\"terms-margin-botto\">Recognizing the global nature of the Internet, you agree to comply with all local rules regarding online conduct and acceptable Content. Specifically, you agree to comply with all applicable laws regarding the transmission of technical data exported from the United States or the country in which you reside.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>9. INDEMNITY</h1>\r\n<p class=\"terms-margin-botto\">You agree to indemnify and hold Merit Ted, and its subsidiaries, affiliates, officers, agents, cobranders or other partners, and employees, harmless from any claim or demand, including reasonable attorneys\' fees, made by any third party due to or arising out of Content you submit, post, transmit or make available through the Service, your use of the Service, your connection to the Service, your violation of the TOS, or your violation of any rights of another</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>10. NO RESALE OF SERVICE</h1>\r\n<p class=\"terms-margin-botto\">You agree not to reproduce, duplicate, copy, sell, resell or exploit for any commercial purposes, any portion of the Service, use of the Service, or access to the Service.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>11. MODIFICATIONS TO SERVICE</h1>\r\n<p class=\"terms-margin-botto\">Merit Ted reserves the right at any time and from time to time to modify or temporarily discontinue the Service (or any part thereof) with or without notice. You agree that Merit Ted shall not be liable to you or to any third party for any modification, suspension or temporary discontinuance of the Service.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>12. TERMINATION</h1>\r\n<p class=\"terms-margin-botto\">You agree that Merit Ted, in its sole discretion, may terminate your password, account (or any part thereof) or use of the Service, for any reason, including, without limitation, for lack of use or if Merit Ted believes that you have violated or acted inconsistently with the letter or spirit of the TOS. Merit Ted may also in its sole discretion and at any time discontinue providing the Service, or any part thereof, with or without notice. You agree that any termination of your access to the Service under any provision of this TOS may be effected without prior notice, and acknowledge and agree that Merit Ted may immediately deactivate or delete your account and all related information and files in your account and/or bar any further access to such files or the Service. Further, you agree that Merit Ted shall not be liable to you or any third-party for any termination of your access to the Service.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>13. LINKS</h1>\r\n<p class=\"terms-margin-botto\">The Service may provide, or third parties may provide, links to other Internet websites or resources. Because Merit Ted has no control over such sites and resources, you acknowledge and agree that Merit Ted is not responsible for the availability of such external sites or resources, and does not endorse and is not responsible or liable for any Content, advertising, products, or other materials on or available from such sites or resources. You further acknowledge and agree that Merit Ted shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such Content, goods or services available on or through any such site or resource</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>14. MERIT TED\'S PROPRIETARY RIGHTS</h1>\r\n<p class=\"terms-margin-botto\">You acknowledge and agree that the Service and any necessary software used in connection with the Service (\"Software\") contain proprietary and confidential information that is protected by applicable intellectual property and other laws. You further acknowledge and agree that information presented to you through the Service is protected by copyrights, trademarks, service marks, patents or other proprietary rights and laws. Except as expressly authorized by Merit Ted or advertisers, you agree not to modify, rent, lease, loan, sell, distribute or create derivative works based on the Service or the Software, in whole or in part.</p>\r\n<p class=\"terms-margin-botto\">Merit Ted grants you a personal, non-transferable and non-exclusive right and license to use the Service. You agree that you will not copy, modify, create a derivative work of, reverse engineer, reverse assemble or otherwise attempt to discover any source code, sell, assign, sublicense, grant a security interest in or otherwise transfer any right in the Software. You agree not to modify the Software in any manner or form, or to use modified versions of the Software, including (without limitation) for the purpose of obtaining unauthorized access to the Service. You agree not to access the Service by any means other than through the interface that is provided by Merit Ted for use in accessing the Service.</p>\r\n<p class=\"terms-margin-botto\">Furthermore, you understand that the Content is protected by copyright and other laws in both the United States and elsewhere. Under the terms of this agreement, it is expressly forbidden to distribute the Content or any portion thereof by any means, including but not limited to electronic and print, to any person or entity who does not have a valid account. Merit Ted reserves the right to cancel your organization\'s license without refund if it is determined that you have violated this portion of the agreement.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>15. DISCLAIMER OF WARRANTIES</h1>\r\n<p class=\"terms-margin-botto\">YOU EXPRESSLY UNDERSTAND AND AGREE THAT</p>\r\n<ul>\r\n<li>a. YOUR USE OF THE SERVICE IS AT YOUR SOLE RISK. THE SERVICE IS PROVIDED ON AN \"AS IS\" AND \"AS AVAILABLE\" BASIS. Merit Ted EXPRESSLY DISCLAIMS ALL WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT.</li>\r\n<li>b. Merit Ted MAKES NO WARRANTY THAT (i) THE SERVICE WILL MEET YOUR REQUIREMENTS, (ii) THE SERVICE WILL BE UNINTERRUPTED, TIMELY, SECURE, OR ERRORFREE, (iii) THE RESULTS THAT MAY BE OBTAINED FROM THE USE OF THE SERVICE WILL BE ACCURATE OR RELIABLE, (iv) THE QUALITY OF ANY PRODUCTS, SERVICES, INFORMATION, OR OTHER MATERIAL PURCHASED OR OBTAINED BY YOU THROUGH THE SERVICE WILL MEET YOUR EXPECTATIONS, AND (V) ANY ERRORS IN THE SOFTWARE WILL BE CORRECTED.</li>\r\n<li>c. ANY MATERIAL DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE SERVICE IS DONE AT YOUR OWN DISCRETION AND RISK AND THAT YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR LOSS OF DATA THAT RESULTS FROM THE DOWNLOAD OF ANY SUCH MATERIAL. d. NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM Merit Ted OR THROUGH OR FROM THE SERVICE SHALL CREATE ANY WARRANTY NOT EXPRESSLY STATED IN THE TOS.</li>\r\n</ul>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>16. LIMITATION OF LIABILITY</h1>\r\n<p class=\"terms-margin-botto\">YOU EXPRESSLY UNDERSTAND AND AGREE THAT Merit Ted SHALL NOT BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL OR EXEMPLARY DAMAGES, INCLUDING BUT NOT LIMITED TO, DAMAGES FOR LOSS OF PROFITS, GOODWILL, USE, DATA OR OTHER INTANGIBLE LOSSES (EVEN IF Merit Ted HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES), RESULTING FROM: (i) THE USE OR THE INABILITY TO USE THE SERVICE; (ii) THE COST OF PROCUREMENT OF SUBSTITUTE GOODS AND SERVICES RESULTING FROM ANY GOODS, DATA, INFORMATION OR SERVICES PURCHASED OR OBTAINED OR MESSAGES RECEIVED OR TRANSACTIONS ENTERED INTO THROUGH OR FROM THE SERVICE; (iii) UNAUTHORIZED ACCESS TO OR ALTERATION OF YOUR TRANSMISSIONS OR DATA; (iv) STATEMENTS OR CONDUCT OF ANY THIRD PARTY ON THE SERVICE; OR (v) ANY OTHER MATTER RELATING TO THE SERVICE.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>17. EXCLUSIONS AND LIMITATIONS</h1>\r\n<p class=\"terms-margin-botto\">SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES OR THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES. ACCORDINGLY, SOME OF THE ABOVE LIMITATIONS OF SECTIONS 15 AND 16 MAY NOT APPLY TO YOU.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>18. TRADEMARK INFORMATION</h1>\r\n<p class=\"terms-margin-botto\">MLearning is a registered trademark of Beijing Merit Ted Co.,Ltd</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>19. GENERAL INFORMATION</h1>\r\n<p class=\"terms-margin-botto\">The TOS constitute the entire agreement between you and Merit Ted and govern your use of the Service, superseding any prior agreements between you and Merit Ted. You also may be subject to additional terms and conditions that may apply when you use affiliate services, third-party content or third-party software. The TOS and the relationship between you and Merit Ted shall be governed by the laws of China without regard to conflict of law provisions. The failure of Merit Ted to exercise or enforce any right or provision of the TOS shall not constitute a waiver of such right or provision. If any provision of the TOS is found by a court of competent jurisdiction to be invalid, the parties nevertheless agree that the court should endeavor to give effect to the parties\' intentions as reflected in the provision, and the other provisions of the TOS remain in full force and effect. You agree that regardless of any statute or law to the contrary, any claim or cause of action arising out of or related to use of the Service or the TOS must be filed within one (1) year after such claim or cause of action arose or be forever barred.</p>\r\n<p class=\"terms-margin-botto\">The section titles in the TOS are for convenience only and have no legal or contractual effect.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '2018-06-14 23:59:34', '2018-10-22 06:54:22'),
(6, 3, 'cn', '服务条款', '服务条款', '条款和条件', '条款和条件', '条款和条件', '<div class=\"gray-btn-main-section pircing-main-section\"><!-- Terms And Conditions start here-->\r\n<div class=\"container\">\r\n<div class=\"terms-condi-main-block\">\r\n<div class=\"welcome-to-travel\">\r\n<h1>1. 接受条款</h1>\r\n<p class=\"terms-margin-botto\">北京优界科技有限责任公司（&ldquo;优界科技&rdquo;或&ldquo;Merit Ted&rdquo;）根据以下服务条款（&ldquo;TOS&rdquo;）为您提供服 务，我们可能会随时更新您的服务条款。当您使⽤任何优界科技服务时，您和优界科技将受制于 任何可能随时公布的政策或规则。所有这些政策或规则都会纳⼊TOS。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>2. 服务说明</h1>\r\n<p class=\"terms-margin-botto m-b-0\">优界科技⽬前为⽤户提供帮助学习和练习数学，语⾔艺术，科学，社会研究的服务。除⾮另有明 确规定，否则任何增加或增强当前服务的新功能，包括新功能特性的发布均应服从TOS。您了解 并同意本服务&ldquo;按现状&rdquo;提供，Merit Ted对于及时性，删除，误传或未能存储任何⽤户通信或个性 化设置不承担任何责任。 要使⽤本服务，您必须直接或通过访问基于Web的内容访问互联⽹，并 ⽀付与此类访问相关的任何服务费⽤。另外，您必须提供与Internet连接所需的所有设备，包括计 算机和调制解调器或其他接⼊设备。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>3. .您的注册义务</h1>\r\n<p class=\"terms-margin-botto\">考虑到您对本服务的使⽤，您同意：（a）根据本服务的注册表格（这些信息为&ldquo;注册数据&rdquo;）提供 关于您⾃⼰的真实，准确，最新和完整的信息;（b）及时更新注册资料，保持真实，准确，最 新，完整。如果您提供任何不真实，不准确，不现实或不完整的信息，或者Merit Ted有合理的理 由怀疑这些信息不真实，不准确，不现实或不完整，Merit Ted有权暂停或终⽌您的帐户并拒绝本 服务（或其任何部分）当前或未来的任何和所有⽤途。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>4. 会员和账单</h1>\r\n<ul>\r\n<li>家庭成员</li>\r\n<li>您可以随时在Merit Ted找到有关您的会员资格的具体细节。只需登录您的Merit Ted家⻓账户，找 到会员标签，然后点击管理您的账户。</li>\r\n<li>a. 计费 通过开通您的优界科技会员资格，您明确同意我们有权向您收取与您在注册期间选择的会员类型 （按⽉或按年）相关的会员费。您同意我们有权根据您在注册期间提供的付款⽅式（或者如果您 更改您的账户信息⽽使⽤不同的付款⽅式）以当时的利率向您收取会员费。请注意，价格和收费 如有变更，恕不另⾏通知。付款是不可退还的，部分使⽤的期间不会退款或退款。我们可能会更 改有效的收费标准，或者不时增加新的收费标准，但我们会通过电⼦邮件提前通知您。如果您想 使⽤不同的付款⽅式，或者如果付款⽅式发⽣变化，例如您的信⽤卡有效期或到期⽇，您可以从 您的账户管理⻚⾯编辑您的付款⽅式信息。要访问您的账户管理⻚⾯，请登录您的Merit Ted家⻓ 账户，转到&ldquo;成员资格&rdquo;选项卡，然后点击管理您的账户。如果您的付款⽅式到期，并且您没有修 改您的付款⽅式信息或取消您的账户（请参阅下⾯的&ldquo;取消&rdquo;），您授权我们继续对付款⽅式进⾏ 结算，并对任何未收取的⾦额负责。</li>\r\n<li>b. 会员资格延续 除⾮您取消您的会员资格或我们终⽌会员资格，否则您的优异会员资格将继续有效。您必须先取 消您的会员资格，才能续订每个结算周期，以避免向您的付款⽅式收取下⼀笔会费。我们会根据 您在注册时提供给我们的付款⽅式（或者如果您更改您的账户信息时使⽤不同的付款⽅式），按 照当时的汇率和任何适⽤的税率向您收取会员费⽤。会员费⽤全额⽀付。</li>\r\n<li>c.会员资格取消 您可以随时取消您的优界科技会员资格，取消将⽴即⽣效。您将继续访问该程序，直到当前的结 算周期结束。我们不提供任何部分使⽤的会员期间的退款或信⽤。要取消您的会员资格，请登录 您的⽗⺟帐户，然后在您的帐户管理⻚⾯上点击&ldquo;取消会员资格&rdquo;字样。按照&ldquo;取消会员&rdquo;标题下的取 消说明进⾏操作。</li>\r\n<li>d. 通过苹果iTunes商店购买 如果您通过iTunes帐户购买了Merit Ted会员，则&ldquo;会员和帐单&rdquo;部分的第4a⾄4c部分可能不适⽤于 您。由于此类购买是在您与Apple iTunes商店之间进⾏的，⽽不是Merit Ted，因此您承认并同 意，Merit Ted不对您的会员账单负责，也不对您购买的任何索赔负责。如果您对会员资格或帐单 有疑问，请直接联系Apple iTunes商店。</li>\r\n</ul>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>5.优惠隐私政策</h1>\r\n<p class=\"terms-margin-botto\">注册数据和关于您的某些其他信息受我们的隐私政策的约束。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>6.会员帐号，密码和安全</h1>\r\n<p class=\"terms-margin-botto\">完成服务注册过程后，您将获得密码和帐户指定。您有责任保持密码和帐户的机密性，并对您的 密码或帐户下发⽣的所有活动负全部责任。您同意（a）⽴即通知优界科技任何未经授权使⽤您 的密码或帐户或任何其他违反安全的⾏为;（b）确保您在每次会话结束时退出您的帐户。 优界科 技不能也不会为您不遵守本第6条⽽引起的任何损失或损害负责。 北京优界科技有限责任公司给 予明确授权的，不得⼀⼈以上分享。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>7. 会员⾏为</h1>\r\n<p class=\"terms-margin-botto\">您了解所有信息，包括但不限于数据，⽂字，软件，照⽚，图形，插图，艺术品，视频，⾳乐， 声⾳，信息，名称，标识，商标，服务标记和其他材料（&ldquo;内容&rdquo;公开发布或私下传播，是由内容 发起⼈所独有的责任。这意味着您，⽽不是优界科技，对您通过本服务上传，发布，发送电⼦邮 件，传输或以其他⽅式提供的所有内容负全部责任。 优界科技不控制通过服务发布的内容，因此 不保证此类内容的准确性，完整性或质量。在任何情况下，优界科技都不会以任何⽅式对任何内 容承担责任，包括但不限于任何内容中的任何错误或遗漏，或任何因使⽤任何内容⽽导致的任何 损失或损害张贴，电⼦邮件，传送或以其他⽅式通过本服务提供。 您了解，服务的技术处理和传 输（包括您的内容）可能涉及（a）通过各种⽹络进⾏的传输; （b）改变以符合和适应连接⽹络 或设备的技术要求。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>8. 国际使⽤的特殊要求</h1>\r\n<p class=\"terms-margin-botto\">认识到互联⽹的全球性质，您同意遵守当地有关在线⾏为和可接受内容的所有规定。具体⽽⾔， 您同意遵守有关从美国或您居住的国家输出技术数据的所有适⽤法律。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>9. 赔偿</h1>\r\n<p class=\"terms-margin-botto\">您同意赔偿优界科技及其⼦公司，联营公司，管理⼈员，代理⼈，联合品牌商或其他合作伙伴以 及员⼯对任何第三⽅提出的任何索赔或要求，包括合理的律师费，由于您通过服务提交，发布， 传输或提供的内容，您使⽤本服务，您与本服务的连接，您违反本服务条款或您侵犯他⼈的任何 权利⽽导致的内容。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>10.⽆转售后服务</h1>\r\n<p class=\"terms-margin-botto\">您同意不出于任何商业⽬的复制，复制，复制，出售，转售或利⽤本服务的任何部分，使⽤本服 务或访问本服务。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>11. 对服务的修改</h1>\r\n<p class=\"terms-margin-botto\">优界科技保留随时修改或暂时中⽌本服务（或其任何部分）的权利，恕不另⾏通知。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>12. 终⽌</h1>\r\n<p class=\"terms-margin-botto\">您同意，Merit Ted可⾃⾏决定终⽌您的密码，帐户（或其任何部分）或使⽤本服务，原因包括但 不限于缺乏使⽤或Merit Ted认为您拥有违反或不符合服务条款的⽂字或精神。 Merit Ted也可以⾃ ⾏决定，随时停⽌提供服务或其任何部分，⽆论是否通知。您同意根据本服务条款的任何条款终 ⽌您对本服务的访问权限，可能会在未事先通知的情况下⽣效，并确认并同意，优界科技可能⽴ 即停⽤或删除您的帐户以及您帐户中的所有相关信息和⽂件和/或禁⽌进⼀步访问这些⽂件或服 务。此外，您同意Merit Ted对您或任何第三⽅对您终⽌访问服务不承担任何责任。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>13. 链接</h1>\r\n<p class=\"terms-margin-botto\">服务可以提供或者第三⽅可以提供到其他互联⽹⽹站或资源的链接。由于Merit Ted⽆法控制此类 ⽹站和资源，因此您认可并同意，Merit Ted不对此类外部⽹站或资源的可⽤性负责，也不对任何 内容，⼴告，产品或服务承担责任。或这些⽹站或资源上的其他资料。您进⼀步确认并同意，优 界科技不承担任何直接或间接的责任或责任，由于使⽤或依赖任何此类内容，货物或服务⽽导致 或据称是由于使⽤或依赖于通过任何这样的⽹站或资源。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>14. 优界科技的专所有权</h1>\r\n<p class=\"terms-margin-botto\">您承认并同意，本服务以及与本服务（&ldquo;软件&rdquo;）相关的任何必要软件均包含受适⽤知识产权和其 他法律保护的专有和机密信息。您进⼀步确认并同意通过本服务向您提供的信息受版权，商标， 服务标志，专利或其他所有权和法律的保护。除⾮Merit Ted或⼴告商明确授权，您同意不会基于 服务或软件全部或部分修改，出租，租赁，出借，分发或创建衍⽣作品。 Merit Ted授予您⼀项 个⼈的，不可转让的，⾮排他性的权利和使⽤本服务的许可。您同意不会复制，修改，创建衍⽣ 作品，逆向⼯程，反向汇编或以其他⽅式尝试发现任何源代码，出售，分配，再许可，授予安全 利益或以其他⽅式转让软件中的任何权利。您同意不以任何⽅式或形式修改本软件，也不得修改 本软件的版本，包括（但不限于）未经授权访问本服务的⽬的。您同意不以通过Merit Ted提供的 ⽤于访问服务的界⾯以外的任何⽅式访问服务。 此外，您明⽩，内容受美国和其他地⽅的版权和 其他法律的保护。根据本协议的条款，明确禁⽌以任何⼿段（包括但不限于电⼦和印刷）将内容 或其任何部分分发给任何没有有效账户的个⼈或实体。如果确定您违反了这部分协议，Merit Ted 有权不退款取消您所在组织的使⽤许可。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>15. 免责声明</h1>\r\n<p class=\"terms-margin-botto\">您明确了解并同意：</p>\r\n<ul>\r\n<li>a.您⾃⾏承担使⽤本服务的⻛险。本服务按&ldquo;现状&rdquo;和&ldquo;现有&rdquo;的基础提供。 Merit Ted明确否认所有明 示或暗示的保证，包括但不限于对适销性，特定⽤途适⽤性和⾮侵权性的暗示保证。</li>\r\n<li>b. Merit Ted不担保（i）服务符合您的要求，（ii）服务不会中断，及时，安全或没有错误，（iii） 使⽤本服务可能获得的结果准确可靠（iv）您通过本服务购买或获得的任何产品，服务，信息或 其他材料的质量将符合您的期望，并且（v）本软件中的任何错误都将得到纠正。</li>\r\n<li>c.通过使⽤本服务下载或以其他⽅式获得的任何材料均由您⾃⾏决定并承担⻛险，并且由于下载 任何此类材料⽽导致您对计算机系统的任何损坏或数据丢失承担全部责任。</li>\r\n<li>d.任何建议或信息，⽆论是⼝头还是书⾯的，由您从优界科技获得，或通过或从服务中产⽣的任 何担保没有明确规定在服务条款。</li>\r\n</ul>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>16. 责任限制</h1>\r\n<p class=\"terms-margin-botto\">您明确了解并同意，对于任何直接的，间接的，附带的，特殊的，结果性的或惩戒性的损害赔偿， 包括但不限于利润损失，商誉，使⽤损失，数据损失或其他⽆形损失如果Merit Ted已被告知发⽣ 此类损害的可能性），则可能导致：（i）使⽤或⽆法使⽤本服务; （ii）购买或获得的任何商品， 数据，信息或服务或收到的消息或通过服务进⼊或从服务中获得的交易所获得的替代商品和服务 的成本; （iii）未经授权访问或更改您的传输或数据; （iv）任何第三⽅对服务的声明或⾏为;或 （v）与本服务相关的任何其他事宜。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>17.排除和限制</h1>\r\n<p class=\"terms-margin-botto\">某些司法管辖区不允许排除某些担保或限制或排除偶发或间接损失的责任。因此，第15条和第16 条的某些上述限制可能不适⽤于您。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>18. 商标信息</h1>\r\n<p class=\"terms-margin-botto\">MLearning是北京优界科技股份有限责任公司的注册商标。</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>19. ⼀般资料</h1>\r\n<p class=\"terms-margin-botto\">TOS构成您与Merit Ted之间的完整协议，并管理您对服务的使⽤，取代之前您与优界科技之间的 任何协议。您还可能受到附加服务，第三⽅内容或第三⽅软件时可能适⽤的附加条款和条件的约 束。 TOS以及您与Merit Ted之间的关系将受到中国法律的约束，⽽不考虑法律规定的冲突。 Merit Ted没有⾏使或执⾏TOS的任何权利或条款，不构成对此权利或条款的放弃。如果具有司法 管辖权的法院认为TOS的任何规定是⽆效的，当事⼈仍然同意法院应该努⼒落实该条款中反映的 当事⼈的意图，并且TOS的其他规定仍然存在充分的⼒量和效果。您同意，⽆论任何法规或法律 有何相反规定，由于使⽤服务或服务条款引起的或与使⽤服务或服务条款相关的任何索赔或诉因， 都必须在此索赔或诉讼因由发⽣后⼀（1）年内提交，或永远被禁⽌。 服务条款中的章节标题只 是为了⽅便，没有法律或合同的效果</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '2018-06-14 23:59:35', '2018-10-22 06:54:22');
INSERT INTO `front_pages_translation` (`id`, `front_page_id`, `locale`, `name`, `title`, `meta_title`, `meta_keyword`, `meta_description`, `description`, `created_at`, `updated_at`) VALUES
(7, 4, 'en', 'Privacy Policy', 'Privacy Policy', 'ELearning', 'ELearning', 'Sdfsdfsdf', '<div class=\"gray-btn-main-section pircing-main-section\"><!-- Terms And Conditions start here-->\r\n<div class=\"container\">\r\n<div class=\"terms-condi-main-block\">\r\n<div class=\"welcome-to-travel\">\r\n<h1>Privacy Policy for the Merit Ted Product</h1>\r\n<p class=\"terms-margin-botto\">Merit Ted supports the Student Privacy Pledge to safeguard student privacy.</p>\r\n<h1>How we use your information</h1>\r\n<p class=\"terms-margin-botto\">Merit Ted knows that you care how information about you is used and shared, and we appreciate your trust that we will do so carefully and sensibly. This notice describes our privacy policy. Your use of the meritted.com website and, more specifically, the use of the Merit Ted product, is conditioned on your acceptance of this policy. Merit Ted may have other products on this or another website that have a different privacy policy.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>What personally identifiable information does Merit Ted collect from you?</h1>\r\n<p class=\"terms-margin-botto m-b-0\">Merit Ted collects information in several ways from different parts of our products.</p>\r\n<p class=\"terms-margin-botto m-b-0\">Some personal information is gathered when you register. Depending on your account type, Merit Ted may ask for your name, e-mail address, and/or additional information. We may also ask you to choose a username and password.</p>\r\n<p class=\"terms-margin-botto\">In addition to the information we collect when you register, we may ask you for personal information at other times, such as when you contact our technical support team. We also collect information about your use of Merit Ted websites and any information that you submit to Merit Ted websites, such as answers to questions or quizzes.</p>\r\n<p class=\"terms-margin-botto\">Furthermore, when you send e-mail, user surveys, or other communication to Merit Ted, we may retain those communications in order to process your inquiries, respond to your requests, and improve our services.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>What are cookies and how does Merit Ted use them?</h1>\r\n<p class=\"terms-margin-botto\">As part of offering and providing customizable and personalized services, Merit Ted and its vendors use cookies to temporarily store information. We use cookies to better display our website, to save you time, to provide better technical support, for promotional purposes, and to track website usage. For example, cookies help us to:</p>\r\n<p class=\"terms-margin-botto\">Keep track of whether you are signed in or have previously signed in so that we can display all the features that are available to you. Remember your settings on the pages you visit, so that we can display your preferred content the next time you visit. Customize the function and appearance of the pages you visit based on information relating to your account; for example, in order to default you to a particular grade level, or to remember customized settings for a report. Know your username when you submit a technical support request so that you don\'t have to type it in. Advertise Merit Ted on other websites, such as in Google search results and partner websites. Track website usage for various purposes including sales, marketing, and billing.</p>\r\n<p class=\"terms-margin-botto\">Most browsers are initially set up to accept cookies, but you can reset your browser to refuse all cookies or to indicate when a cookie is being sent. However, some features and services (particularly those that require you to sign in) may not function properly if your cookies are disabled.</p>\r\n<p class=\"terms-margin-botto\">We may also use local storage mechanisms other than cookies, including but not limited to Flash storage and HTML5 local storage.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>How does Merit Ted use your information?</h1>\r\n<p class=\"terms-margin-botto\">Merit Ted\'s goals in collecting information are to provide you with a customized experience on our sites and a high level of technical support.</p>\r\n<p class=\"terms-margin-botto\">Merit Ted analyzes users\' interactions with the product and their feedback submitted via e-mail and surveys in order to provide better service, to improve our current products and services, and to develop new ones.</p>\r\n<p class=\"terms-margin-botto\">Who is collecting information, and with whom is it shared?</p>\r\n<p class=\"terms-margin-botto\">When you are on an Merit Ted site and are asked for personal information, you are sharing that information with Merit Ted, unless it is specifically stated otherwise.</p>\r\n<p class=\"terms-margin-botto\">Merit Ted will not disclose any of your personally identifiable information to third parties except when we have your permission or under specific circumstances, such as when we believe in good faith that the law requires it. The following describes some of the circumstances under which your information may be disclosed.</p>\r\n<p class=\"terms-margin-botto\">Business Partners &amp; Sponsors. Merit Ted will not disclose your personally identifiable information to business partners or sponsors for their benefit, unless it is specifically described to you prior to data collection or prior to transferring the data. If Merit Ted becomes involved in a merger, acquisition, or any form of sale of some or all of its assets, your personal information may be transferred to the purchaser. In such an event, we will provide notice before personal information is transferred and becomes subject to a different privacy policy.</p>\r\n<p class=\"terms-margin-botto\">Third Party Data &amp; Data in the Aggregate. Under confidentiality agreements, Merit Ted may match non-student accountholder information with third party data. Also, Merit Ted discloses aggregated user statistics (for instance, the percentage of Merit Ted users from a particular geographic region) in order to describe our services to current and prospective partners and other third parties, and for other lawful purposes.</p>\r\n<p class=\"terms-margin-botto\">Vendors and Service Providers. Merit Ted may disclose information collected from you to vendors or service providers who are under an obligation of confidentiality to Merit Ted for the purpose of providing services or products for us or on our behalf, including for purposes of analytics, billing, and marketing. Such service providers or vendors may send you e-mails on Merit Ted\'s behalf. However, Merit Ted will not knowingly use student information for behavioral targeting of advertisements to students</p>\r\n<p class=\"terms-margin-botto\">Educational Institution Affiliation. Merit Ted may disclose information collected from users associated with an educational institution with other users designated by the educational institution, such as teachers and school administrators of that institution.Other. Merit Ted may release personal information if it has a good faith belief that access, use, preservation, or disclosure of such information is reasonably necessary to (a) satisfy any applicable law, regulation, legal process, or enforceable governmental request; (b) enforce applicable Terms of Service, including investigation of potential violations thereof; (c) detect, prevent or otherwise address fraud, security or technical issues; or (d) protect against imminent harm to the rights, property, or safety of Merit Ted, its users, or the public as required or permitted by law.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>What are your choices regarding collection, use, and distribution of your information?</h1>\r\n<p class=\"terms-margin-botto\">Merit Ted may, from time to time, send you e-mail regarding our products and services, or your use of our products and services. Only Merit Ted (or its vendors or service providers) will send you these direct mailings. You can choose not to receive these e-mails by clicking the unsubscribe link in any e-mail.</p>\r\n<p class=\"terms-margin-botto\">You also have choices with respect to cookies. By modifying your browser preferences, you have the choice to accept all cookies, to be notified when a cookie is set, or to reject all cookies. However, if you choose to reject all cookies you will be unable to use those Merit Ted services that require registration and sign-in in order to participate.</p>\r\n<p class=\"terms-margin-botto\">What is Merit Ted\'s policy on allowing you to update, correct, or delete your personally identifi- able information?</p>\r\n<p class=\"terms-margin-botto\">You may edit your account information at any time by logging into your account and clicking the Account or Profile link. We recommend that you review your personal information periodically to ensure that it is accurate, complete, and current.</p>\r\n<p class=\"terms-margin-botto\">If you have forgotten your password, you may request a new one. A new password will be sent to the e-mail address you specified during registration. For all other problems logging into Merit Ted services, please contact our technical support team using the contact information on meritted.com .</p>\r\n<p class=\"terms-margin-botto\">Please contact technical support for further instructions about deleting or deactivating your account for any Merit Ted service. Residual information may remain within our archive records, such as for billing and tax purposes.</p>\r\n<p class=\"terms-margin-botto\">What security precautions are in place to protect the loss, misuse, or alteration of your information?</p>\r\n<p class=\"terms-margin-botto\">We take appropriate security measures to protect against unauthorized access to or unauthorized alteration, disclosure, or destruction of data. These include internal reviews of our data collection, storage, and processing practices and security measures, as well as physical security measures to guard against unauthorized access to systems where we store personal data.</p>\r\n<p class=\"terms-margin-botto\">Your registered accounts are password-protected so that you and only you have access to any personal information you have entered in your account. You may edit your account information at any time by logging into your account and clicking the Account or Profile link.</p>\r\n<p class=\"terms-margin-botto\">For your protection, remember to log out of all accounts before closing your browser.</p>\r\n<p class=\"terms-margin-botto\">We restrict access to personal information to Merit Ted employees, contractors, and agents who need to know that information in order to operate, develop, or improve our products and services. These individuals are bound by confidentiality obligations and may be subject to discipline, including termination and criminal prosecution, if they fail to meet these obligations.</p>\r\n</div>\r\n<div class=\"cookies-block\">\r\n<h1>How does Merit Ted protect children\'s privacy?</h1>\r\n<p class=\"terms-margin-botto\">Merit Ted accounts are created by parents and educational institutions/Teachers. Merit Ted does not permit children under the age of 13 to create an account and does not knowingly collect personally identifying information from children under the age of 13 without the consent of a parent or educational institution. Merit Ted may collect and store question answers provided by users of accounts created by parents and educational institutions for the purpose of providing feedback to the user and educational institution and for compiling reports and awards. Merit Ted may also collect and store an e-mail address provided by users of accounts created by parents and educational institutions for the purpose of password reset. Merit Ted will not ask children under age 13 for more information, as a condition of participation, than is reasonably necessary to participate in a given activity. Any disclosure of information collected from children under the age of 13 to third parties will be pursuant to an agreement of confidentiality and may be used for purposes of site analytics, billing and marketing. If any information is disclosed to Merit Ted by a child under the age of 13, that child\'s parent may contact Merit Ted using the contact information below to ascertain the information collected and/or to request its deletion.</p>\r\n<p class=\"terms-margin-botto\">What else should you know about your privacy?</p>\r\n<p class=\"terms-margin-botto\">Please keep in mind that whenever you voluntarily disclose personal information online that information can be collected and used by others. For example, if you post personal information online that is accessible to the public, you may receive unsolicited messages from other parties in return. Some Merit Ted services may offer the ability to create public web pages and to show your name and e-mail address on them. The pages thus created may be accessed by anyone. Please do not include any information on your Web page that you do not want to disclose over the Internet. Additional information Please note that this Privacy Policy may change from time to time. We will notify you about significant changes in the way we treat your personal information by placing a prominent notice on our websites or by e-mail. Any changes will take effect fourteen (14) days after they are posted. By continuing to use Merit Ted services after that time, you agree to the updated Privacy Policy. If you have a question regarding this statement, or if a question was not addressed in this privacy policy, you may contact technical support using the contact information on the website. We will do our best to answer your question promptly and accurately.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '2018-06-16 04:29:23', '2018-10-16 06:57:18'),
(8, 4, 'cn', '隐私政策', '隐私政策', '在线学习', '在线学习', '在线学习', '<div class=\"gray-btn-main-section pircing-main-section\"><!-- Terms And Conditions start here-->\r\n<div class=\"container\">\r\n<div class=\"terms-condi-main-block\">\r\n<div class=\"welcome-to-travel\">\r\n<h1>优界科技⽀持学⽣隐私承诺，以保护学⽣的隐私。</h1>\r\n<p class=\"terms-margin-botto\"> 我们如何使⽤您的信息</p>\r\n<p class=\"terms-margin-botto\"><h1>How we use your information</h1></p>\r\n<p class=\"terms-margin-botto\"> 优界科技知道你关⼼我们如何使⽤和共享你的信息，我们感谢你的信任，我们将会⾮常认真的对\r\n待你的信息。本通知描述了我们的隐私政策。您对meritted.com⽹站的使⽤，更具体地说是对\r\nMerit Ted产品的使⽤，以您接受此政策为条件。 优界科技可能有其他产品在这个或另⼀个⽹站有\r\n不同的隐私政策。</p>\r\n</div>\r\n\r\n<div class=\"cookies-block\">\r\n<p><h1>Merit Ted从您那⾥收集哪些个⼈信息？ </h1></p>\r\n<p class=\"terms-margin-botto m-b-0\">优界科技从我们产品的不同部分以⼏种⽅式收集信息。 您注册时会收集⼀些个⼈信息。根据您的\r\n账户类型，Merit Ted可能会要求您提供您的姓名，电⼦邮件地址和/或其他信息。我们也可能会要\r\n求您选择⽤户名和密码。 除了我们在注册时收集的信息外，我们可能会在其他时间要求您提供个\r\n⼈信息，例如您联系我们的技术⽀持团队。我们还收集有关您使⽤Merit Ted⽹站的信息以及您提\r\n交给Merit Ted ⽹站的任何信息，例如问题或测验的答案。 此外，当您将电⼦邮件，⽤户调查或\r\n其他沟通发送到Merit Ted 时，我们可能会保留这些沟通以处理您的查询，回应您的请求并改进我\r\n们的服务。</p>\r\n\r\n</div>\r\n\r\n<div class=\"cookies-block\">\r\n<p class=\"terms-margin-botto\"><h1>什么是cookies，Merit Ted如何使⽤它们？</h1></p>\r\n<p class=\"terms-margin-botto\">作为提供和提供可定制和个性化服务的⼀部分，Merit Ted及其供应商使⽤cookie临时存储信息。\r\n我们使⽤cookies来更好地显示我们的⽹站，节省您的时间，提供更好的技术⽀持，促销⽬的，并\r\n跟踪⽹站的使⽤情况。例如，Cookie可以帮助我们： 跟踪您是否已登录或先前已登录，以便我们\r\n可以显示所有可⽤的功能。 在您访问的⽹⻚上记住您的设置，以便我们可以在下次访问时显示您\r\n的⾸选内容。 根据您的帐户信息⾃定义您访问的⻚⾯的功能和外观;例如，为了默认你到⼀个特\r\n定的年级，或记住⾃定义设置的报告。 当您提交技术⽀持请求时，请了解您的⽤户名，以便您不\r\n必输⼊。 在其他⽹站上发布Merit Ted，例如Google搜索结果和合作伙伴⽹站。 跟踪⽹站使⽤的\r\n各种⽬的，包括销售，市场营销和计费。 ⼤多数浏览器最初设置为接受cookie，但您可以重置浏\r\n览器拒绝所有cookie或指示何时发送cookie。但是，如果您的Cookie被禁⽤，某些功能和服务\r\n（特别是那些需要您登录的功能和服务）可能⽆法正常运⾏。 我们也可能使⽤Cookie以外的本地\r\n存储机制，包括但不限于Flash存储和HTML5本地存储。</p>\r\n</div>\r\n\r\n\r\n<div class=\"cookies-block\">\r\n<p class=\"terms-margin-botto m-b-0\"><h1>Merit Ted如何使⽤您的信息？ </h1></p>\r\n<p class=\"terms-margin-botto\"> 优界科技收集信息的⽬标是为您提供在我们⽹站上的定制体验和⾼⽔平的技术⽀持。 Merit Ted\r\n通过电⼦邮件和调查分析了⽤户与产品的互动以及他们的反馈，以便提供更好的服务，改进我们\r\n现有的产品和服务，并开发新的产品和服务。</p>\r\n</div>\r\n\r\n\r\n<div class=\"cookies-block\">\r\n<p class=\"terms-margin-botto m-b-0\"><h1>谁在收集信息，谁与谁共享？</h1></p>\r\n\r\n<p class=\"terms-margin-botto\"> 当您在Merit Ted⽹站上被要求提供个⼈信息时，您将与Merit Ted分享这些信息，除⾮另有特别说\r\n明。 除⾮获得您的许可或在特定情况下，例如我们真诚相信法律要求，否则优界科技不会将任\r\n何您的个⼈身份信息透露给第三⽅。以下描述了您的信息可能被披露的⼀些情况。\r\n业务合作伙伴和赞助商。除⾮在数据收集之前或在传输数据之前对您进⾏特别说明，否则Merit\r\nTed不会向商业伙伴或赞助商披露您的个⼈身份信息。如果优界科技涉及合并，收购或任何形式\r\n的部分或全部资产出售，您的个⼈信息可能会转移给买⽅。在这种情况下，我们会在个⼈信息转\r\n移之前提供通知，并遵守不同的隐私政策。\r\n第三⽅数据和资料的统计。根据保密协议，Merit Ted 可能会将⾮学⽣账户持有⼈信息与第三⽅数\r\n据进⾏匹配。此外，Merit Ted 还披露了聚合的⽤户统计数据（例如，来⾃特定地理区域的Merit\r\nTed⽤户的百分⽐），以便向当前和未来的合作伙伴以及其他第三⽅描述我们的服务，并且还为\r\n其他合法⽬的使⽤。</p>\r\n\r\n<p class=\"terms-margin-botto\">供应商和服务提供商。为了向我们或代表我们提供服务或产品，包括出于分析，计费和市场营销\r\n的⽬的，Merit Ted 可能会将从您那⾥收集的信息披露给对Merit Ted 有保密义务的供应商或服务\r\n提供商。此类服务提供商或供应商可能会以Merit Ted的名义向您发送电⼦邮件。然⽽，Merit Ted\r\n不会故意使⽤学⽣信息来进⾏针对学⽣的⼴告⾏为定位。\r\n教育机构的联系。 Merit Ted 可能会将与教育机构相关的⽤户与教育机构指定的其他⽤户（例如\r\n该机构的教师和学校管理员）收集的信息进⾏披露。\r\n其他。优界科技可能会发布个⼈信息，只要其确信访问，使⽤，保存或披露此类信息对于（a）\r\n满⾜任何适⽤的法律，法规，法律程序或可执⾏的政府要求是合理必要的; （b）执⾏适⽤的服务\r\n条款，包括调查潜在的违规⾏为; （c）侦测，防⽌或以其他⽅式处理欺诈，安全或技术问题;或\r\n（d）根据法律的要求或许可。</p>\r\n\r\n</div>\r\n\r\n\r\n<div class=\"cookies-block\">\r\n<p class=\"terms-margin-botto m-b-0\"><h1>您收集，使⽤和分发您的信息的选择是什么？</h1></p>\r\n\r\n<p class=\"terms-margin-botto\"> \r\n 优界科技可能会不时向您发送有关我们的产品和服务的电⼦邮件，或者您使⽤我们的产品和服务。\r\n只有优界科技（或其供应商或服务提供商）将向您发送这些直接邮件。您可以通过点击任何电⼦\r\n邮件中的取消订阅链接来选择不接收这些电⼦邮件。 您也可以选择cookie。通过修改您的浏览器\r\n偏好设置，您可以选择接受所有的Cookie，在设置Cookie时收到通知，或拒绝所有的Cookie。但\r\n是，如果您选择拒绝所有Cookie，您将⽆法使⽤需要注册和登录的Merit Ted 服务才能参与。</p>\r\n\r\n<p class=\"terms-margin-botto\">在允许您更新，更正或删除您的个⼈身份信息上，优界科技的政策是什么？\r\n您可以随时编辑您的帐户信息，⽅法是登录您的帐户并点击帐户或个⼈资料链接。我们建议您定\r\n期查看您的个⼈信息，以确保其准确，完整和最新。如果您忘记了密码，可以申请⼀个新密码。\r\n⼀个新的密码将被发送到您在注册期间指定的电⼦邮件地址。对于登录Merit Ted 服务的所有其他\r\n问题，请使⽤meritted.com与我们的技术⽀持团队联系。\r\n请联系技术⽀持获取关于删除或停⽤您的账户以获得任何优界科技服务的进⼀步说明。剩余信息\r\n可能会保留在我们的档案记录中，例如计费和报税⽬的。</p>\r\n\r\n</div>\r\n\r\n<div class=\"cookies-block\">\r\n<p class=\"terms-margin-botto m-b-0\"><h1>有什么安全措施来保护信息的丢失，滥⽤或篡改？</h1></p>\r\n\r\n<p class=\"terms-margin-botto\"> \r\n 我们采取适当的安全措施来防⽌未经授权的访问或未经授权的更改，披露或销毁数据。这些包括\r\n对我们的数据收集，存储，处理实践和安全措施的内部审查，以及防⽌未经授权访问存储个⼈数\r\n据的系统的物理安全措施。 您的注册帐户受密码保护，因此您只有您可以访问您在帐户中输⼊的\r\n任何个⼈信息。您可以随时编辑您的帐户信息，⽅法是登录您的帐户并点击帐户或个⼈资料链\r\n接。 为了保护您的隐私，请务必在关闭浏览器之前退出所有帐户。我们将限制临时雇员，代理商\r\n和开发或改进我们的产品和服务⽽需要了解该信息的Merit Ted 员⼯，对个⼈信息的访问权限。承\r\n包商和代理商。这些⼈受到保密义务的约束，如果不履⾏这些义务，可能会受到纪律处分，包括\r\n终⽌和刑事起诉。</p>\r\n</div>\r\n\r\n\r\n<div class=\"cookies-block\">\r\n<p class=\"terms-margin-botto m-b-0\"><h1>Merit Ted 如何保护孩⼦的隐私？ </h1></p>\r\n\r\n<p class=\"terms-margin-botto\"> \r\n优界科技账户是由家⻓和教育机构或教师创建的。优异的特德学习不允许13岁以下的⼉童创建⼀\r\n个帐户，并不会故意收集13岁以下⼉童的个⼈识别信息，未经⽗⺟或教育机构的同意。优界科技\r\n可以收集和存储由家⻓和教育机构创建的帐户⽤户提供的问题答案，以向⽤户和教育机构提供反\r\n馈，并编制报告和奖励。优界科技学习还可以收集和存储由家⻓和教育机构创建的帐户⽤户提供\r\n的电⼦邮件地址，⽤于重设密码。优界科技不会要求13岁以下的⼉童作为参与条件的更多信息，\r\n⽽不是参加特定活动的合理必要条件。将从13岁以下⼉童收集到的任何信息披露给第三⽅都将遵\r\n守保密协议，并可⽤于⽹站分析，计费和营销。如果13岁以下⼉童向Merit Ted 透露任何信息，该\r\n孩⼦的⽗⺟可以使⽤以下联系信息联系Merit Ted，以确定收集到的信息和/或要求删除该信息。</p>\r\n</div>\r\n\r\n<div class=\"cookies-block\">\r\n<p class=\"terms-margin-botto m-b-0\"><h1>你还应该知道你的隐私吗？ </h1></p>\r\n\r\n<p class=\"terms-margin-botto\"> \r\n请记住，每当您⾃愿在⽹上披露个⼈信息时，这些信息可以被其他⼈收集和使⽤。例如，如果您\r\n在线公布个⼈信息，则可能会收到来⾃其他⽅的未经请求的信息。 ⼀些优界科技服务可能提供创\r\n建公共⽹⻚，并显示您的姓名和电⼦邮件地址的能⼒。这样创建的⻚⾯可以被任何⼈访问。请不\r\n要在您的⽹⻚上包含您不想透过互联⽹透露的资讯。 附加信息 请注意，本隐私政策可能会随时\r\n更改。我们会通过在我们的⽹站上或通过电⼦邮件发出突出通知，通知您我们对待您的个⼈信息\r\n的⽅式发⽣重⼤变化。任何更改将在发布后⼗四（14）天后⽣效。在此之后继续使⽤Merit Ted 服\r\n务，即表示您同意更新的隐私政策。 如果您对本声明有疑问，或者本隐私政策中未解决问题，可\r\n以使⽤⽹站上的联系信息联系技术⽀持。我们将尽最⼤努⼒及时准确地回答您的问题。</p>\r\n</div>\r\n\r\n\r\n</div>\r\n</div>\r\n</div>\r\n', '2018-06-16 04:29:23', '2018-10-16 07:02:50'),
(9, 5, 'en', 'Home', 'Home', 'Elearning', 'Elearning', 'Elearning is best for your child', '<!--banner section start here-->\r\n<div class=\"home-banner-serction\" style=\"background-image: url(\'images/home-banner-img.jpg\');\">\r\n<div class=\"banner-content-section\">\r\n<div class=\"container\">\r\n<div class=\"banner-content-head\"></div>\r\n<div class=\"banner-content-head\"><span>Don\'t Study Hard</span> Study Smart</div>\r\n<div class=\"btn-get-start-section\"><a class=\"get-start-btn sim-button\" href=\"signup\">Get Started Now</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--banner section end here-->\r\n<p></p>\r\n<!--welcome to section start here-->\r\n<div class=\"learning-app\">\r\n<div class=\"container-fluid\">\r\n<div class=\"welcome-to-section-main\">\r\n<div class=\"col-sm-12 col-md-12 col-lg-6 p-0 swap-right\">\r\n<div class=\"learning-app-section-img\"><img src=\"images/welcome-to-img.jpg\" class=\"img-responsive\" alt=\"learning app\" /></div>\r\n</div>\r\n<div class=\"col-sm-12 col-md-12 col-lg-6 p-0\">\r\n<div class=\"welcome-content-txt\">\r\n<div class=\"welcome-to-head-section\">Welcome To</div>\r\n<div class=\"learning-app-section\">The Merit Learning App</div>\r\n<div class=\"merit-learning-app-contnet\">\r\n<p>The Merit Learning is an exceptional community committed to helping a diverse student body achieve academic, social, and personal excellence through a partnership among children, parents, teacher, and community.</p>\r\n<p>The Merit Learning supports each family\'s expectation to preparing their children for success! Let us help your kids go out into the world!</p>\r\n</div>\r\n<div class=\"btn-get-start-section\"></div>\r\n</div>\r\n</div>\r\n<div class=\"clearfix\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--welcome to section end here-->\r\n<p></p>\r\n<!--why choose merit learning section start here-->\r\n<div class=\"why-choose-merit-main\">\r\n<div class=\"container\">\r\n<div class=\"why-choose-metit-head\">Why Choose Merit Learning</div>\r\n<div class=\"why-choose-merit-description\">Help Your Kids Excel in English and Math Complete Pre-K through High School Learning Program</div>\r\n<div class=\"row\">\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img\"></div>\r\n<div class=\"why-choose-plan-name\">The USA Plan</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img englis-login-img\"></div>\r\n<div class=\"why-choose-plan-name\">English Logic</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img american-phonics-img\"></div>\r\n<div class=\"why-choose-plan-name\">American Phonics</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img diverse-culture\"></div>\r\n<div class=\"why-choose-plan-name\">Diverse Culture</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img eng-maths-img\"></div>\r\n<div class=\"why-choose-plan-name\">English and Maths</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img positive-incentive\"></div>\r\n<div class=\"why-choose-plan-name\">Positive Incentive</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--why choose merit learning section start here-->', '2018-06-16 04:29:23', '2018-10-26 07:04:56'),
(10, 5, 'cn', '⾸⻚', '⾸⻚', '在线学习', '在线学习', '在线学习是您孩子最好的学习网站', '<!--banner section start here-->\r\n<div class=\"home-banner-serction\" style=\"background-image: url(\'images/home-banner-img.jpg\');\">\r\n<div class=\"banner-content-section\">\r\n<div class=\"container\">\r\n<div class=\"banner-content-head\"><span>聪明的学习</span> 而非努力的学习</div>\r\n<div class=\"banner-content-semi-head\">用你的时间在线学习一项新技能</div>\r\n<div class=\"btn-get-start-section\"><a class=\"get-start-btn sim-button\" href=\"signup\">现在开始</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--banner section end here-->\r\n<p></p>\r\n<!--welcome to section start here-->\r\n<div class=\"learning-app\">\r\n<div class=\"container-fluid\">\r\n<div class=\"welcome-to-section-main\">\r\n<div class=\"col-sm-12 col-md-12 col-lg-6 p-0 swap-right\">\r\n<div class=\"learning-app-section-img\"><img src=\"images/welcome-to-img.jpg\" class=\"img-responsive\" alt=\"learning app\" /></div>\r\n</div>\r\n<div class=\"col-sm-12 col-md-12 col-lg-6 p-0\">\r\n<div class=\"welcome-content-txt\">\r\n<div class=\"welcome-to-head-section\">欢迎来到</div>\r\n<div class=\"learning-app-section\">Merit Learning应用<br />\r\n<div class=\"learning-app-section\">\r\n<div class=\"learning-app-section\">\r\n<div class=\"learning-app-section\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"merit-learning-app-contnet\">\r\n<p>Merit 特殊的社区，致力于通过儿童、父母、教师和社区之间的伙伴关系，帮助不同的学生团体实现学术、社会和个人卓越</p>\r\n</div>\r\n<div class=\"btn-get-start-section\"></div>\r\n</div>\r\n</div>\r\n<div class=\"clearfix\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--welcome to section end here-->\r\n<p></p>\r\n<!--why choose merit learning section start here-->\r\n<div class=\"why-choose-merit-main\">\r\n<div class=\"container\">\r\n<div class=\"why-choose-metit-head\">为什么选择优异学习</div>\r\n<div class=\"why-choose-merit-description\">我们帮助您的孩⼦擅⻓英语和数学 完整的从幼⼉园到⾼中阶段的学习⽅案</div>\r\n<div class=\"row\">\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img\"></div>\r\n<div class=\"why-choose-plan-name\">为什么选择Merit Learning</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img englis-login-img\"></div>\r\n<div class=\"why-choose-plan-name\">英⽂逻辑</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img american-phonics-img\"></div>\r\n<div class=\"why-choose-plan-name\">美式发⾳</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img diverse-culture\"></div>\r\n<div class=\"why-choose-plan-name\">多元⽂化</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img eng-maths-img\"></div>\r\n<div class=\"why-choose-plan-name\">英语数学</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xs-6 col-sm-4 col-md-4 col-lg-4\">\r\n<div class=\"why-choose-plan-section\">\r\n<div class=\"why-choose-plan-txt\">\r\n<div class=\"why-choose-plan-img positive-incentive\"></div>\r\n<div class=\"why-choose-plan-name\">正向激励</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--why choose merit learning section start here-->', '2018-06-16 04:29:23', '2018-10-25 12:30:19'),
(11, 6, 'en', 'Membership', 'Membership', 'Membership', 'Membership', 'Membership', '<p>##PLANLIST##</p>\r\n<div class=\"grade-list-section\">\r\n<div class=\"get-access-child-head\">Grade List</div>\r\n<div class=\"table-responsive table-scroll-section\">\r\n<table class=\"table students-list-section\">\r\n<tbody>\r\n<tr>\r\n<th>GRADE</th>\r\n<th>AGE</th>\r\n<th>PROGRAM</th>\r\n<th>SIGN UP</th>\r\n</tr>\r\n<tr>\r\n<td>Preschool</td>\r\n<td>2-5</td>\r\n<td>Preschool English Plan</td>\r\n<td>2-5 years old kids/English Beginner</td>\r\n</tr>\r\n<tr>\r\n<td>K1-K3</td>\r\n<td>5-6</td>\r\n<td>Kindergarten English Plan</td>\r\n<td>Kindergarten Students of English school/1th grade of Chinese Elementary School</td>\r\n</tr>\r\n<tr>\r\n<td>1th Grade</td>\r\n<td>6-7</td>\r\n<td>1th Grade English Plan</td>\r\n<td>1th grade students of english school/2th-6th grade of Chinese Elementary School/1th students of Chinese Middle-School</td>\r\n</tr>\r\n<tr>\r\n<td>2th Grade</td>\r\n<td>7-8</td>\r\n<td>2th Grade English Plan</td>\r\n<td>2th grade students of english school/2th grade students of Chinese Middle-School/1th grade students of Chinese High-School/freshman of university</td>\r\n</tr>\r\n<tr>\r\n<td>3th Grade</td>\r\n<td>8-9</td>\r\n<td>3th Grade English Plan</td>\r\n<td>3th grade students of english school/3th grade students of Chinese Middle-School/1th grade students of Chinese High-School/freshman of university</td>\r\n</tr>\r\n<tr>\r\n<td>4th Grade</td>\r\n<td>9-10</td>\r\n<td>4th Grade English Plan</td>\r\n<td>4th grade students of english school/1th &amp; 2th grade students of Chinese High-School/sophomore of university</td>\r\n</tr>\r\n<tr>\r\n<td>5th Grade</td>\r\n<td>10-11</td>\r\n<td>5th Grade English Plan</td>\r\n<td>5th grade students of english school/2th &amp; 3th grade students of Chinese High-School/junior of university</td>\r\n</tr>\r\n<tr>\r\n<td>6th Grade</td>\r\n<td>11-12</td>\r\n<td>6th Grade English Plan</td>\r\n<td>6th grade students of english school/3th grade students of Chinese High-School/senior of university</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</div>', '2018-09-18 05:54:36', '2018-10-25 12:32:37'),
(12, 6, 'cn', '会员', '会员', '会员', '会员', '会员', '<p>##PLANLIST##</p>\r\n<div class=\"grade-list-section\">\r\n<div class=\"get-access-child-head\">注册年级选择建议</div>\r\n<div class=\"table-responsive table-scroll-section\">\r\n<table class=\"table students-list-section\">\r\n<tbody>\r\n<tr>\r\n<th>年级</th>\r\n<th>年龄</th>\r\n<th>教学内容</th>\r\n<th>注册建议</th>\r\n</tr>\r\n<tr>\r\n<td>幼⼉园</td>\r\n<td>2-5</td>\r\n<td>美国幼⼉园阶段英语教学⽅案</td>\r\n<td>2-5岁年龄段⼩朋友／英语零基础学⽣</td>\r\n</tr>\r\n<tr>\r\n<td>学前班</td>\r\n<td>5-6</td>\r\n<td>美国学前班阶段英语教学⽅案</td>\r\n<td>英⽂学校学前班转⼊学员／⼀年英语学习基础的⼩朋友;中⽂学校⼀年级学⽣</td>\r\n</tr>\r\n<tr>\r\n<td>⼀年级</td>\r\n<td>6-7</td>\r\n<td>美国⼀年级阶段英语教学⽅案</td>\r\n<td>英⽂国际学校⼀年级学⽣; 中⽂学校⼆年级 ⾄ 六年级／初⼀年级学⽣</td>\r\n</tr>\r\n<tr>\r\n<td>⼆年级</td>\r\n<td>7-8</td>\r\n<td>美国⼆年级阶段英语教学⽅案</td>\r\n<td>英⽂国际学校⼆年级学⽣；中⽂学校初⼆年级学⽣／⾼⼀／⼤学⼀年级学⽣</td>\r\n</tr>\r\n<tr>\r\n<td>三年级</td>\r\n<td>8-9</td>\r\n<td>美国三年级阶段英语教学⽅案</td>\r\n<td>英⽂国际学校三年级学⽣；中⽂学校初三／⾼⼀／⼤学⼀年级学⽣</td>\r\n</tr>\r\n<tr>\r\n<td>四年级</td>\r\n<td>9-10</td>\r\n<td>美国四年级阶段英语教学⽅案</td>\r\n<td>英⽂国际学校四年级学⽣；中⽂学校⾼⼀／⾼⼆／⼤学⼆年级学⽣</td>\r\n</tr>\r\n<tr>\r\n<td>五年级</td>\r\n<td>10-11</td>\r\n<td>美国五年级阶段英语教学⽅案</td>\r\n<td>英⽂国际学校五年级学⽣；中⽂学校⾼⼆／⾼三／⼤学三年级学⽣</td>\r\n</tr>\r\n<tr>\r\n<td>六年级</td>\r\n<td>11-12</td>\r\n<td>美国六年级阶段英语教学⽅案</td>\r\n<td>英⽂国际学校六年级学⽣；中⽂学校⾼三／⼤学四年级学⽣</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</div>', '2018-09-18 05:54:36', '2018-10-25 12:26:50'),
(13, 7, 'en', 'Contact Us', 'Contact Us', 'Contact Us', 'Contact Us', 'Contact Us', '', '2018-09-18 05:54:36', '2018-09-18 07:01:15'),
(14, 7, 'cn', 'Contact Us', 'Contact Us', 'Contact Us', 'Contact Us', 'Contact Us', '', '2018-09-18 05:54:36', '2018-09-18 07:01:15');

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
(18, '9e58e34ce760ad60fd43541500d3e169274fa38d.jpg', '2018-09-10 08:41:51', '2018-09-10 08:41:51'),
(19, 'a011e6802a403fb7141f4f4050b30f7b4cce821d.jpg', '2018-10-20 05:58:21', '2018-10-20 05:58:21');

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
(1, 2, 5, 2, 5, '2018-07-23 00:26:53', '2018-09-10 06:30:13');

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
(1, 1, '1', '2018-09-10 06:55:10', '2018-09-10 06:55:10', NULL),
(2, 2, '1', '2018-09-10 06:56:30', '2018-09-10 06:56:30', NULL),
(3, 2, '1', '2018-09-10 06:56:50', '2018-09-10 06:56:50', NULL),
(4, 2, '1', '2018-10-20 08:30:40', '2018-10-20 08:30:40', '2018-10-20 08:30:40');

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
(1, 1, 'Section A', 'en', '2018-09-10 06:55:10', '2018-09-10 06:55:10'),
(2, 1, 'Section A', 'cn', '2018-09-10 06:55:10', '2018-09-10 06:55:10'),
(3, 2, 'Section B', 'en', '2018-09-10 06:56:30', '2018-09-10 06:56:30'),
(4, 2, 'Section B', 'cn', '2018-09-10 06:56:30', '2018-09-10 06:56:30'),
(5, 3, 'Section C', 'en', '2018-09-10 06:56:50', '2018-09-10 06:56:50'),
(6, 3, 'Section C', 'cn', '2018-09-10 06:56:50', '2018-09-10 06:56:50'),
(7, 4, 'gfhghgh', 'en', '2018-10-20 08:30:33', '2018-10-20 08:30:33'),
(8, 4, 'ghfhghgf', 'cn', '2018-10-20 08:30:33', '2018-10-20 08:30:33');

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
  `is_holiday` enum('no','yes') NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`id`, `program_id`, `lesson_id`, `name`, `slug`, `subject_id`, `grade_id`, `status`, `is_holiday`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'Test1', 'test1', 1, 1, '1', 'no', '2018-10-20 11:33:19', '2018-10-20 11:33:19'),
(3, 1, 1, 'rrrrrrrrrrrr', 'rrrrrrrrrrrr', 1, 1, '1', 'no', '2018-10-20 12:52:14', '2018-10-20 13:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `homework_image`
--

CREATE TABLE `homework_image` (
  `id` int(11) NOT NULL,
  `homework_id` int(11) NOT NULL,
  `homework_name` varchar(500) NOT NULL,
  `homework_slug` varchar(500) DEFAULT NULL,
  `file` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homework_image`
--

INSERT INTO `homework_image` (`id`, `homework_id`, `homework_name`, `homework_slug`, `file`, `created_at`, `updated_at`) VALUES
(1, 2, '', NULL, '15400351995bcb127fc8147.jpg', '2018-10-20 11:33:19', '2018-10-20 11:33:19'),
(2, 2, '', NULL, '15400351995bcb127fd66f9.jpeg', '2018-10-20 11:33:19', '2018-10-20 11:33:19'),
(4, 3, '', NULL, '15400404555bcb27075c3dc.jpg', '2018-10-20 13:00:55', '2018-10-20 13:00:55'),
(7, 3, '', NULL, '15400410055bcb292d5f552.jpeg', '2018-10-20 13:10:05', '2018-10-20 13:10:05'),
(8, 3, '', NULL, '15400411395bcb29b38b5fb.jpeg', '2018-10-20 13:12:19', '2018-10-20 13:12:19'),
(9, 3, '', NULL, '15400411435bcb29b7b4175.png', '2018-10-20 13:12:23', '2018-10-20 13:12:23'),
(10, 3, '', NULL, '15400411955bcb29eb6668b.jpg', '2018-10-20 13:13:15', '2018-10-20 13:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Lesson1', 1, '2018-09-10 09:05:35', '2018-09-10 09:05:35', NULL),
(2, 'Lesson2', 2, '2018-09-11 04:08:02', '2018-09-11 04:08:02', NULL),
(3, 'L1', 3, '2018-09-14 13:03:24', '2018-09-14 13:03:24', NULL),
(4, 'Lesson-1', 3, '2018-09-29 05:47:17', '2018-09-29 05:47:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_09_21_100220_create_jobs_table', 1);

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
(23, 'Certificate', 'certificate', '1', '2018-07-23 06:40:43', NULL, NULL),
(24, 'Program', 'program', '1', '2018-07-23 06:40:43', NULL, NULL),
(25, 'Homework', 'homework', '1', '2018-07-23 06:40:43', NULL, NULL),
(26, 'Material', 'material', '1', '2018-07-23 06:40:43', NULL, NULL),
(27, 'Transaction', 'transaction', '1', '2018-07-23 06:40:43', NULL, NULL),
(28, 'Wire Transfer Request', 'wire_transfer_request', '1', '2018-07-23 06:40:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `user_type` enum('parent','teacher','student','program-creator','supervisor','subadmin') DEFAULT NULL,
  `broadcast_date` date DEFAULT NULL,
  `status` enum('pending','sent') NOT NULL COMMENT '0=>inactive 1=>active',
  `is_active` enum('active','block') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `title`, `message`, `user_type`, `broadcast_date`, `status`, `is_active`, `created_at`, `updated_at`) VALUES
(11, 'New News Letter', '<p>This is a new newsletter</p>', 'teacher', '2018-10-31', 'pending', 'active', '2018-10-19 12:52:57', '2018-10-19 12:52:57');

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
(1, 162, 'teacher', 'active', '2018-09-10 14:44:21', '2018-09-10 14:44:21', '2018-09-10 14:44:21', NULL),
(2, 167, 'parent', 'active', '2018-09-18 14:43:45', '2018-09-18 14:43:45', '2018-09-18 14:43:45', NULL),
(3, 168, 'parent', 'active', '2018-09-18 15:26:35', '2018-09-18 15:26:35', '2018-09-18 15:26:35', NULL),
(4, 169, 'parent', 'active', '2018-09-18 18:35:56', '2018-09-18 18:35:56', '2018-09-18 18:35:56', NULL),
(5, 170, 'teacher', 'active', '2018-09-18 18:47:35', '2018-09-18 18:47:35', '2018-09-18 18:47:35', NULL),
(6, 171, 'parent', 'active', '2018-09-20 12:38:46', '2018-09-20 12:38:46', '2018-09-20 12:38:46', NULL),
(7, 172, 'parent', 'active', '2018-09-20 12:43:39', '2018-09-20 12:43:39', '2018-09-20 12:43:39', NULL),
(8, 173, 'teacher', 'active', '2018-09-20 14:30:26', '2018-09-20 14:30:26', '2018-09-20 14:30:26', NULL),
(9, 174, 'teacher', 'active', '2018-09-20 14:40:57', '2018-09-20 14:40:57', '2018-09-20 14:40:57', NULL),
(10, 175, 'parent', 'active', '2018-09-20 15:55:43', '2018-09-20 15:55:43', '2018-09-20 15:55:43', NULL),
(11, 176, 'parent', 'active', '2018-09-20 16:07:44', '2018-09-20 16:07:44', '2018-09-20 16:07:44', NULL),
(12, 177, 'parent', 'active', '2018-09-20 17:03:03', '2018-09-20 17:03:03', '2018-09-20 17:03:03', NULL),
(13, 178, 'parent', 'active', '2018-09-20 17:06:01', '2018-09-20 17:06:01', '2018-09-20 17:06:01', NULL),
(14, 179, 'parent', 'active', '2018-09-20 18:19:14', '2018-09-20 18:19:14', '2018-09-20 18:19:14', NULL),
(15, 180, 'parent', 'active', '2018-09-20 18:19:57', '2018-09-20 18:19:57', '2018-09-20 18:19:57', NULL),
(16, 181, 'parent', 'active', '2018-09-20 18:25:17', '2018-09-20 18:25:17', '2018-09-20 18:25:17', NULL),
(17, 182, 'parent', 'active', '2018-09-20 18:50:28', '2018-09-20 18:50:28', '2018-09-20 18:50:28', NULL),
(18, 183, 'parent', 'active', '2018-09-21 09:52:00', '2018-09-21 09:52:00', '2018-09-21 09:52:00', NULL),
(19, 184, 'parent', 'active', '2018-09-21 09:57:53', '2018-09-21 09:57:53', '2018-09-21 09:57:53', NULL),
(20, 187, 'parent', 'active', '2018-09-21 11:20:33', '2018-09-21 11:20:33', '2018-09-21 11:20:33', NULL),
(21, 188, 'parent', 'active', '2018-09-21 11:30:47', '2018-09-21 11:30:47', '2018-09-21 11:30:47', NULL),
(22, 189, 'teacher', 'active', '2018-09-21 12:00:36', '2018-09-21 12:00:36', '2018-09-21 12:00:36', NULL),
(23, 190, 'teacher', 'active', '2018-09-21 12:02:35', '2018-09-21 12:02:35', '2018-09-21 12:02:35', NULL),
(24, 191, 'teacher', 'active', '2018-09-21 12:04:17', '2018-09-21 12:04:17', '2018-09-21 12:04:17', NULL),
(25, 192, 'teacher', 'active', '2018-09-21 12:04:48', '2018-09-21 12:04:48', '2018-09-21 12:04:48', NULL),
(26, 193, 'parent', 'active', '2018-09-21 12:07:29', '2018-09-21 12:07:29', '2018-09-21 12:07:29', NULL),
(27, 194, 'parent', 'active', '2018-09-25 13:59:49', '2018-09-25 13:59:49', '2018-09-25 13:59:49', NULL),
(28, 195, 'parent', 'active', '2018-09-25 14:04:02', '2018-09-25 14:04:02', '2018-09-25 14:04:02', NULL),
(29, 196, 'parent', 'active', '2018-09-25 14:48:57', '2018-09-25 14:48:57', '2018-09-25 14:48:57', NULL),
(30, 197, 'program-creator', 'active', '2018-09-25 14:57:52', '2018-09-25 14:57:52', '2018-09-25 14:57:52', NULL),
(31, 198, 'parent', 'active', '2018-09-25 16:44:34', '2018-09-25 16:44:34', '2018-09-25 16:44:34', NULL),
(32, 199, 'parent', 'active', '2018-09-25 16:47:12', '2018-09-25 16:47:12', '2018-09-25 16:47:12', NULL),
(33, 200, 'parent', 'active', '2018-09-25 17:06:26', '2018-09-25 17:06:26', '2018-09-25 17:06:26', NULL),
(34, 201, 'parent', 'active', '2018-09-25 17:18:37', '2018-09-25 17:18:37', '2018-09-25 17:18:37', NULL),
(35, 202, 'parent', 'active', '2018-09-25 17:21:14', '2018-09-25 17:21:14', '2018-09-25 17:21:14', NULL),
(36, 203, 'parent', 'active', '2018-09-25 17:25:30', '2018-09-25 17:25:30', '2018-09-25 17:25:30', NULL),
(37, 204, 'parent', 'active', '2018-09-25 17:27:30', '2018-09-25 17:27:30', '2018-09-25 17:27:30', NULL),
(38, 205, 'parent', 'active', '2018-09-25 17:28:48', '2018-09-25 17:28:48', '2018-09-25 17:28:48', NULL),
(39, 206, 'parent', 'active', '2018-09-25 18:43:49', '2018-09-25 18:43:49', '2018-09-25 18:43:49', NULL),
(40, 207, 'parent', 'active', '2018-09-26 10:10:34', '2018-09-26 10:10:34', '2018-09-26 10:10:34', NULL),
(41, 208, 'teacher', 'active', '2018-09-26 14:50:32', '2018-09-26 14:50:32', '2018-09-26 14:50:32', NULL),
(42, 209, 'parent', 'active', '2018-09-26 15:00:09', '2018-09-26 15:00:09', '2018-09-26 15:00:09', NULL),
(43, 210, 'parent', 'active', '2018-09-26 15:03:42', '2018-09-26 15:03:42', '2018-09-26 15:03:42', NULL),
(44, 211, 'teacher', 'active', '2018-09-26 18:31:01', '2018-09-26 18:31:01', '2018-09-26 18:31:01', NULL),
(45, 212, 'parent', 'active', '2018-09-27 15:20:42', '2018-09-27 15:20:42', '2018-09-27 15:20:42', NULL),
(46, 213, 'parent', 'active', '2018-09-27 15:22:12', '2018-09-27 15:22:12', '2018-09-27 15:22:12', NULL),
(47, 214, 'parent', 'active', '2018-09-27 16:35:50', '2018-09-27 16:35:50', '2018-09-27 16:35:50', NULL),
(48, 215, 'parent', 'active', '2018-09-28 14:58:30', '2018-09-28 14:58:30', '2018-09-28 14:58:30', NULL),
(49, 216, 'parent', 'active', '2018-09-28 15:29:06', '2018-09-28 15:29:06', '2018-09-28 15:29:06', NULL),
(50, 217, 'teacher', 'active', '2018-09-28 15:39:56', '2018-09-28 15:39:56', '2018-09-28 15:39:56', NULL),
(51, 218, 'teacher', 'active', '2018-09-28 16:04:21', '2018-09-28 16:04:21', '2018-09-28 16:04:21', NULL),
(52, 219, 'teacher', 'active', '2018-10-01 10:44:36', '2018-10-01 10:44:36', '2018-10-01 10:44:36', NULL),
(53, 221, 'parent', 'active', '2018-10-01 10:50:25', '2018-10-01 10:50:25', '2018-10-01 10:50:25', NULL),
(54, 226, 'parent', 'active', '2018-10-01 18:25:27', '2018-10-01 18:25:27', '2018-10-01 18:25:27', NULL),
(55, 227, 'parent', 'active', '2018-10-02 09:32:22', '2018-10-02 09:32:22', '2018-10-02 09:32:22', NULL),
(56, 228, 'parent', 'active', '2018-10-02 09:41:54', '2018-10-02 09:41:54', '2018-10-02 09:41:54', NULL),
(57, 229, 'parent', 'active', '2018-10-02 09:46:48', '2018-10-02 09:46:48', '2018-10-02 09:46:48', NULL),
(58, 232, 'parent', 'active', '2018-10-02 14:34:01', '2018-10-02 14:34:01', '2018-10-02 14:34:01', NULL),
(59, 233, 'parent', 'active', '2018-10-02 14:34:59', '2018-10-02 14:34:59', '2018-10-02 14:34:59', NULL),
(60, 234, 'parent', 'active', '2018-10-02 14:42:46', '2018-10-02 14:42:46', '2018-10-02 14:42:46', NULL),
(61, 235, 'parent', 'active', '2018-10-02 14:47:12', '2018-10-02 14:47:12', '2018-10-02 14:47:12', NULL),
(62, 236, 'parent', 'active', '2018-10-03 14:39:47', '2018-10-03 14:39:47', '2018-10-03 14:39:47', NULL),
(63, 237, 'supervisor', 'active', '2018-10-04 11:26:08', '2018-10-04 11:26:08', '2018-10-04 11:26:08', NULL),
(64, 255, 'teacher', 'active', '2018-10-08 14:18:18', '2018-10-08 14:18:18', '2018-10-08 14:18:18', NULL),
(65, 259, 'enroll', 'active', '2018-10-11 11:13:41', '2018-10-11 11:13:41', '2018-10-11 11:13:41', NULL),
(66, 261, 'enroll', 'active', '2018-10-11 11:23:23', '2018-10-11 11:23:23', '2018-10-11 11:23:23', NULL),
(67, 265, 'enroll', 'active', '2018-10-11 12:42:21', '2018-10-11 12:42:21', '2018-10-11 12:42:21', NULL),
(68, 271, 'parent', 'active', '2018-10-11 18:13:57', '2018-10-11 18:13:57', '2018-10-11 18:13:57', NULL),
(69, 274, 'teacher', 'active', '2018-10-12 11:06:56', '2018-10-12 11:06:56', '2018-10-12 11:06:56', NULL),
(70, 276, 'enroll', 'active', '2018-10-12 11:18:29', '2018-10-12 11:18:29', '2018-10-12 11:18:29', NULL),
(71, 278, 'parent', 'active', '2018-10-12 18:24:09', '2018-10-12 18:24:09', '2018-10-12 18:24:09', NULL),
(72, 280, 'enroll', 'active', '2018-10-15 14:09:08', '2018-10-15 14:09:08', '2018-10-15 14:09:08', NULL),
(73, 283, 'program-creator', 'active', '2018-10-17 14:56:56', '2018-10-17 14:56:56', '2018-10-17 14:56:56', NULL),
(74, 284, 'supervisor', 'active', '2018-10-17 15:01:10', '2018-10-17 15:01:10', '2018-10-17 15:01:10', NULL),
(75, 285, 'program-creator', 'active', '2018-10-22 10:48:36', '2018-10-22 10:48:36', '2018-10-22 10:48:36', NULL),
(76, 286, 'parent', 'active', '2018-10-22 10:56:29', '2018-10-22 10:56:29', '2018-10-22 10:56:29', NULL),
(77, 287, 'supervisor', 'active', '2018-10-24 11:02:58', '2018-10-24 11:02:58', '2018-10-24 11:02:58', NULL);

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
(1, 1, 161, 'Program \"Program 1\" approved by \"Admin Webwing\".', 'http://192.168.1.3/elearning/program-creator/program/view/MQ==', '1', '2018-09-10 09:07:45', '2018-09-10 09:11:16'),
(3, 1, 162, 'Your password was successfully reset.', '', '0', '2018-09-10 09:18:09', '2018-09-10 09:18:09'),
(4, 1, 162, 'Your password was successfully reset.', '', '0', '2018-09-10 09:22:19', '2018-09-10 09:22:19'),
(5, 1, 162, 'Your password was successfully reset.', '', '0', '2018-09-10 09:28:01', '2018-09-10 09:28:01'),
(6, 1, 16, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '1', '2018-09-11 05:19:25', '2018-09-11 05:19:36'),
(7, 1, 4, 'Program \"Math Program\" approved by \"Admin Webwing\".', 'http://192.168.1.59/e-learning/program-creator/program/view/Mg==', '1', '2018-09-11 06:11:28', '2018-09-14 12:56:07'),
(8, 1, 161, 'Program \"Program 1\" approved by \"Admin Webwing\".', 'http://192.168.1.59/e-learning/program-creator/program/view/MQ==', '0', '2018-09-11 06:11:31', '2018-09-11 06:11:31'),
(10, 1, 16, 'You have successfully added new child', 'parent/dashboard', '1', '2018-09-11 06:22:58', '2018-09-13 07:01:35'),
(12, 1, 16, 'You have successfully deleted your child', 'parent/dashboard', '1', '2018-09-11 06:23:03', '2018-09-13 07:01:35'),
(14, 1, 16, 'You have successfully deleted your child', 'parent/dashboard', '1', '2018-09-11 06:23:05', '2018-09-13 07:01:35'),
(16, 1, 16, 'You have successfully added new child', 'parent/dashboard', '1', '2018-09-11 06:23:20', '2018-09-13 07:01:35'),
(20, 1, 162, 'You have successfully added new class', 'teacher/dashboard', '0', '2018-09-12 09:16:47', '2018-09-12 09:16:47'),
(22, 1, 162, 'You have successfully added new student, Arnav Jagtap', '', '0', '2018-09-12 09:17:11', '2018-09-12 09:17:11'),
(30, 1, 0, 'Admin has generated invoice for your payment of Plan-5 Year', '/parent/transactions', '0', '2018-09-13 06:14:04', '2018-09-13 06:14:04'),
(33, 1, 0, 'Admin has generated invoice for your payment of Plan-5 Year', '/parent/transactions', '0', '2018-09-13 06:32:50', '2018-09-13 06:32:50'),
(36, 1, 0, 'Admin has generated invoice for your payment of Plan-5 Year', '/parent/transactions', '0', '2018-09-13 06:35:05', '2018-09-13 06:35:05'),
(38, 1, 0, 'Admin has generated invoice for your payment of Plan-5 Year', '/parent/transactions', '0', '2018-09-13 06:39:16', '2018-09-13 06:39:16'),
(40, 1, 0, 'Admin has generated invoice for your payment of Plan-Life Time', '/parent/transactions', '0', '2018-09-13 07:21:09', '2018-09-13 07:21:09'),
(45, 1, 0, 'Admin has generated invoice for your payment of Plan-Life Time', '/parent/transactions', '0', '2018-09-18 09:17:52', '2018-09-18 09:17:52'),
(48, 1, 0, 'Admin has generated invoice for your payment of Plan-3 Year', '/parent/transactions', '0', '2018-09-18 12:16:25', '2018-09-18 12:16:25'),
(51, 1, 0, 'Admin has generated invoice for your payment of Plan-3 Year', '/parent/transactions', '0', '2018-09-18 12:37:04', '2018-09-18 12:37:04'),
(53, 1, 0, 'Admin has generated invoice for your payment of Plan-3 Year', '/parent/transactions', '0', '2018-09-18 12:41:21', '2018-09-18 12:41:21'),
(55, 1, 0, 'Admin has generated invoice for your payment of Plan-5 Year', '/parent/transactions', '0', '2018-09-18 12:47:26', '2018-09-18 12:47:26'),
(57, 1, 0, 'Admin has generated invoice for your payment of Plan-3 Year', '/parent/transactions', '0', '2018-09-18 12:49:01', '2018-09-18 12:49:01'),
(59, 1, 0, 'Admin has generated invoice for your payment of Plan-3 Year', '/parent/transactions', '0', '2018-09-18 12:52:40', '2018-09-18 12:52:40'),
(61, 1, 0, 'Admin has generated invoice for your payment of Plan-3 Year', '/parent/transactions', '0', '2018-09-19 05:09:15', '2018-09-19 05:09:15'),
(73, 1, 184, 'You have successfully added new child', 'parent/dashboard', '1', '2018-09-21 04:41:46', '2018-09-24 12:37:19'),
(74, 184, 185, 'You have been successfully added by Anushka Shrma', '', '0', '2018-09-21 04:41:46', '2018-09-21 04:41:46'),
(76, 1, 184, 'You have successfully added new child', 'parent/dashboard', '1', '2018-09-21 04:42:09', '2018-09-24 12:37:19'),
(77, 184, 186, 'You have been successfully added by Anushka Shrma', '', '0', '2018-09-21 04:42:09', '2018-09-21 04:42:09'),
(88, 1, 0, 'Admin has generated invoice for your payment of Plan -1 Year', '/parent/transactions', '0', '2018-09-21 12:09:46', '2018-09-21 12:09:46'),
(148, 1, 0, 'Admin has generated invoice for your payment of Plan -1 Year', '/parent/transactions', '0', '2018-09-27 04:35:08', '2018-09-27 04:35:08'),
(150, 1, 0, 'Admin has generated invoice for your payment of Plan -3 Year', '/parent/transactions', '0', '2018-09-27 04:35:45', '2018-09-27 04:35:45'),
(153, 1, 0, 'Admin has generated invoice for your payment of Plan -1 Year', '/parent/transactions', '0', '2018-09-27 05:11:26', '2018-09-27 05:11:26'),
(155, 1, 0, 'Admin has generated invoice for your payment of Plan -1 Year', '/parent/transactions', '0', '2018-09-27 05:18:55', '2018-09-27 05:18:55'),
(157, 1, 0, 'Admin has generated invoice for your payment of Plan -1 Year', '/parent/transactions', '0', '2018-09-27 05:26:00', '2018-09-27 05:26:00'),
(159, 1, 0, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '0', '2018-09-27 05:37:35', '2018-09-27 05:37:35'),
(160, 1, 210, 'Your request is approved by Admin & also invoice is generated for your payment of Plan -5 Year', '/parent/transactions', '1', '2018-09-27 05:37:48', '2018-09-27 05:37:57'),
(162, 1, 182, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '1', '2018-09-27 05:52:41', '2018-09-27 05:52:47'),
(163, 1, 182, 'Your request is approved by Admin & also invoice is generated for your payment of Plan -1 Year', '/parent/transactions', '1', '2018-09-27 05:53:22', '2018-10-01 11:57:52'),
(164, 1, 182, 'Your request is approved by Admin & also invoice is generated for your payment of Plan -1 Year', '/parent/transactions', '1', '2018-09-27 05:56:54', '2018-10-01 11:57:52'),
(165, 1, 182, 'Your request is approved by Admin & also invoice is generated for your payment of Plan -1 Year', '/parent/transactions', '1', '2018-09-27 05:58:34', '2018-10-01 11:57:52'),
(167, 1, 182, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '1', '2018-09-27 09:00:04', '2018-10-01 11:57:52'),
(171, 1, 212, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '0', '2018-09-27 10:34:29', '2018-09-27 10:34:29'),
(174, 1, 214, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '1', '2018-09-27 11:07:35', '2018-09-27 11:09:01'),
(175, 1, 182, 'Your request is approved by Admin & also invoice is generated for your payment of Plan -3 Year', '/parent/transactions', '1', '2018-09-28 09:25:50', '2018-10-01 11:57:52'),
(177, 1, 182, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '1', '2018-09-28 09:26:13', '2018-10-01 11:57:52'),
(182, 1, 215, '50 has been deducted from your incentive amount.', ' ', '1', '2018-09-28 11:26:14', '2018-09-28 11:26:55'),
(183, 1, 215, '20 has been deducted from your incentive amount.', ' ', '0', '2018-09-29 03:59:10', '2018-09-29 03:59:10'),
(184, 1, 215, '10 has been deducted from your incentive amount.', ' ', '0', '2018-09-29 04:02:24', '2018-09-29 04:02:24'),
(187, 1, 219, 'You have successfully added new class', 'teacher/dashboard', '1', '2018-10-01 05:16:07', '2018-10-06 06:05:02'),
(189, 1, 219, 'You have successfully added new student, New Student', '', '1', '2018-10-01 05:16:36', '2018-10-06 06:05:02'),
(190, 219, 220, 'You have successfully added to class : Annual Class by Amail Kret', '', '0', '2018-10-01 05:16:36', '2018-10-01 05:16:36'),
(193, 1, 221, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '1', '2018-10-01 05:23:51', '2018-10-01 06:23:04'),
(194, 1, 221, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -3 Year', '/parent/transactions', '1', '2018-10-01 05:24:54', '2018-10-01 06:23:04'),
(196, 1, 221, 'You have successfully added new child', 'parent/dashboard', '1', '2018-10-01 05:30:32', '2018-10-01 06:23:04'),
(197, 221, 222, 'You have been successfully added by Dujoqi Snohi', '', '0', '2018-10-01 05:30:32', '2018-10-01 05:30:32'),
(199, 1, 219, 'You have successfully added new student, Akshay Studnet', '', '1', '2018-10-01 05:45:52', '2018-10-06 06:05:02'),
(200, 219, 223, 'You have successfully added to class : Annual Class by Amail Kret', '', '0', '2018-10-01 05:45:52', '2018-10-01 05:45:52'),
(202, 1, 219, 'You have successfully added existed student, Djui Dijui', '', '1', '2018-10-01 06:09:47', '2018-10-06 06:05:02'),
(203, 219, 222, 'You have successfully added to class : Annual Class by Amail Kret', '', '0', '2018-10-01 06:09:47', '2018-10-01 06:09:47'),
(205, 1, 221, 'You have successfully added new child', 'parent/dashboard', '1', '2018-10-01 06:10:51', '2018-10-01 06:23:04'),
(206, 221, 224, 'You have been successfully added by Dujoqi Snohi', '', '0', '2018-10-01 06:10:51', '2018-10-01 06:10:51'),
(208, 1, 219, 'You have successfully added existed student, Cool Dude', '', '1', '2018-10-01 06:11:14', '2018-10-06 06:05:02'),
(209, 219, 224, 'You have successfully added to class : Annual Class by Amail Kret', '', '0', '2018-10-01 06:11:14', '2018-10-01 06:11:14'),
(210, 1, 219, 'Entered pin, dujo, doesn\'t exists.', '', '1', '2018-10-01 06:11:48', '2018-10-06 06:05:02'),
(212, 1, 219, 'You have successfully updated a student data, Djui Dijui', 'teacher/my-student/Mg==', '1', '2018-10-01 06:12:25', '2018-10-06 06:05:02'),
(213, 219, 222, 'Your name Djui Dijui has been updated by Amail Kret', '', '0', '2018-10-01 06:12:25', '2018-10-01 06:12:25'),
(215, 1, 219, 'You have successfully updated a student data, Cool Dude', 'teacher/my-student/Mg==', '1', '2018-10-01 06:12:38', '2018-10-06 06:05:02'),
(216, 219, 224, 'Your name Cool Dude has been updated by Amail Kret', '', '0', '2018-10-01 06:12:38', '2018-10-01 06:12:38'),
(217, 1, 182, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -1 Year', '/parent/transactions', '1', '2018-10-01 07:15:04', '2018-10-01 11:57:52'),
(218, 1, 4, 'Program \"New PRogram\" approved by \"Admin Webwing\".', 'http://192.168.1.59/e-learning/program-creator/program/view/Mw==', '1', '2018-10-01 07:15:43', '2018-10-01 12:13:51'),
(220, 1, 182, 'You have successfully added new child', 'parent/dashboard', '1', '2018-10-01 07:16:06', '2018-10-01 11:57:52'),
(221, 182, 225, 'You have been successfully added by Rohini J', '', '1', '2018-10-01 07:16:06', '2018-10-01 11:43:35'),
(222, 1, 4, 'Program \"New PRogram\" approved by \"Admin Webwing\".', 'http://192.168.1.59/e-learning/program-creator/program/view/Mw==', '1', '2018-10-01 10:42:05', '2018-10-01 12:13:51'),
(225, 1, 226, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '1', '2018-10-01 12:56:09', '2018-10-01 13:22:04'),
(226, 1, 226, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -1 Year', '/parent/transactions', '1', '2018-10-01 12:56:41', '2018-10-01 13:22:04'),
(228, 1, 226, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '1', '2018-10-01 13:16:55', '2018-10-01 13:22:04'),
(229, 1, 210, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -1 Year', '/parent/transactions', '1', '2018-10-01 13:17:35', '2018-10-06 06:51:36'),
(231, 1, 226, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '1', '2018-10-01 13:19:52', '2018-10-01 13:22:04'),
(232, 1, 210, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -5 Year', '/parent/transactions', '1', '2018-10-01 13:21:41', '2018-10-06 06:51:36'),
(234, 1, 226, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '0', '2018-10-01 13:24:18', '2018-10-01 13:24:18'),
(235, 1, 182, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -1 Year', '/parent/transactions', '1', '2018-10-01 13:24:32', '2018-10-09 06:00:32'),
(238, 1, 227, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '0', '2018-10-02 04:02:45', '2018-10-02 04:02:45'),
(239, 1, 182, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -3 Year', '/parent/transactions', '1', '2018-10-02 04:03:30', '2018-10-09 06:00:32'),
(242, 1, 228, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '0', '2018-10-02 04:12:37', '2018-10-02 04:12:37'),
(243, 1, 228, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -1 Year', '/parent/transactions', '0', '2018-10-02 04:15:32', '2018-10-02 04:15:32'),
(246, 1, 16, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '1', '2018-10-02 04:38:24', '2018-10-03 05:23:48'),
(247, 1, 16, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -3 Year', '/parent/transactions', '1', '2018-10-02 04:38:45', '2018-10-03 05:23:48'),
(250, 1, 229, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -5 Year', '/parent/transactions', '1', '2018-10-02 04:51:42', '2018-10-02 04:57:32'),
(251, 1, 229, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '1', '2018-10-02 04:56:28', '2018-10-02 04:57:32'),
(253, 1, 229, 'You have successfully added new child', 'parent/dashboard', '1', '2018-10-02 04:57:09', '2018-10-02 04:57:32'),
(254, 229, 230, 'You have been successfully added by Test Test', '', '1', '2018-10-02 04:57:09', '2018-10-02 05:00:40'),
(256, 1, 229, 'You have successfully updated a child', 'parent/dashboard', '1', '2018-10-02 05:10:42', '2018-10-02 07:24:59'),
(257, 229, 230, 'Your name Arpit U has been updated by Test Test', '', '0', '2018-10-02 05:10:43', '2018-10-02 05:10:43'),
(259, 1, 229, 'You have successfully deleted your child', 'parent/dashboard', '1', '2018-10-02 05:10:58', '2018-10-02 07:24:59'),
(260, 1, 229, 'Your current 5 Year plan going to expire after 3 day\'s, Please upgread your membership plan.', '', '1', '2018-10-02 07:23:39', '2018-10-02 07:24:59'),
(261, 1, 229, 'Your current 5 Year plan has been expired, Please upgread your membership.', '', '0', '2018-10-02 08:29:13', '2018-10-02 08:29:13'),
(263, 1, 229, 'You have successfully added new child', 'parent/dashboard', '0', '2018-10-02 08:35:00', '2018-10-02 08:35:00'),
(264, 229, 231, 'You have been successfully added by Test Test', '', '0', '2018-10-02 08:35:00', '2018-10-02 08:35:00'),
(265, 1, 229, 'Your current 5 Year plan has been expired, Please upgread your membership.', '', '0', '2018-10-02 08:36:02', '2018-10-02 08:36:02'),
(267, 1, 229, 'You have successfully updated a child', 'parent/dashboard', '0', '2018-10-02 08:36:25', '2018-10-02 08:36:25'),
(268, 229, 231, 'Your name Taimur Khan has been updated by Test Test', '', '0', '2018-10-02 08:36:25', '2018-10-02 08:36:25'),
(270, 1, 229, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '0', '2018-10-02 08:45:14', '2018-10-02 08:45:14'),
(271, 1, 229, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -1 Year', '/parent/transactions', '0', '2018-10-02 08:46:27', '2018-10-02 08:46:27'),
(275, 1, 234, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '0', '2018-10-02 09:13:48', '2018-10-02 09:13:48'),
(276, 1, 234, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -1 Year', '/parent/transactions', '0', '2018-10-02 09:15:17', '2018-10-02 09:15:17'),
(279, 1, 16, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '1', '2018-10-03 05:07:42', '2018-10-03 05:23:48'),
(280, 1, 16, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -5 Year', '/parent/transactions', '1', '2018-10-03 05:22:44', '2018-10-03 05:23:48'),
(282, 1, 229, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-10-03 09:32:12', '2018-10-03 09:32:12'),
(283, 1, 229, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-10-03 09:32:54', '2018-10-03 09:32:54'),
(284, 1, 229, 'You have successfully updated your profile', 'parent/account-setting/my-profile', '0', '2018-10-03 09:34:06', '2018-10-03 09:34:06'),
(285, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:53:02', '2018-10-03 09:53:02'),
(286, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:53:51', '2018-10-03 09:53:51'),
(287, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:54:39', '2018-10-03 09:54:39'),
(288, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:54:44', '2018-10-03 09:54:44'),
(289, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:55:55', '2018-10-03 09:55:55'),
(290, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:56:01', '2018-10-03 09:56:01'),
(291, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:56:17', '2018-10-03 09:56:17'),
(292, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:56:24', '2018-10-03 09:56:24'),
(293, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:56:43', '2018-10-03 09:56:43'),
(294, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:57:36', '2018-10-03 09:57:36'),
(295, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:58:28', '2018-10-03 09:58:28'),
(296, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:58:32', '2018-10-03 09:58:32'),
(297, 1, 217, 'You have successfully updated your profile', 'teacher/account-setting/my-profile', '0', '2018-10-03 09:58:50', '2018-10-03 09:58:50'),
(300, 213, 1, 'Ruhi J has requested for wire transfer payment.', '', '1', '2018-10-04 10:32:32', '2018-10-04 13:11:48'),
(301, 1, 213, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '', '1', '2018-10-04 10:32:32', '2018-10-04 10:51:33'),
(302, 1, 213, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -1 Year', '/parent/transactions', '1', '2018-10-04 13:29:26', '2018-10-06 04:00:28'),
(303, 213, 1, 'Ruhi J has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-04 13:29:44', '2018-10-06 05:37:29'),
(304, 1, 213, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-04 13:29:45', '2018-10-06 04:00:28'),
(305, 1, 213, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -3 Year', '/parent/transactions', '1', '2018-10-04 13:35:08', '2018-10-06 04:00:28'),
(306, 213, 1, 'Ruhi J has added new child', '/admin/users/student/view/MjQw', '1', '2018-10-04 13:35:41', '2018-10-06 05:37:29'),
(307, 1, 213, 'You have been added a new child', 'parent/dashboard', '1', '2018-10-04 13:35:41', '2018-10-06 04:00:28'),
(308, 213, 240, 'You have been successfully added by Ruhi J', '', '0', '2018-10-04 13:35:42', '2018-10-04 13:35:42'),
(309, 1, 213, 'You have successfully updated your password', 'parent/account-setting/my-profile', '1', '2018-10-06 04:00:00', '2018-10-06 04:00:28'),
(310, 1, 213, 'You have successfully updated your password', 'parent/account-setting/my-profile', '1', '2018-10-06 04:01:07', '2018-10-06 04:03:58'),
(311, 1, 213, 'You have successfully updated your password', 'parent/account-setting/my-profile', '1', '2018-10-06 04:04:56', '2018-10-06 04:05:56'),
(312, 1, 213, 'You have updated your profile successfully.', 'parent/account-setting/my-profile', '1', '2018-10-06 04:26:00', '2018-10-06 04:30:15'),
(313, 1, 213, 'You have updated your profile successfully.', 'parent/account-setting/my-profile', '1', '2018-10-06 05:37:54', '2018-10-06 06:01:40'),
(314, 219, 1, 'Amail Kret has added new class', '/admin/classrooms', '1', '2018-10-06 06:05:35', '2018-10-06 06:07:36'),
(315, 1, 219, 'You have successfully added new class', 'teacher/dashboard', '1', '2018-10-06 06:05:36', '2018-10-06 06:05:44'),
(316, 219, 1, 'Amail Kret has updated a class', '', '1', '2018-10-06 06:05:42', '2018-10-06 06:07:36'),
(317, 1, 219, 'You have successfully updated a class', 'teacher/dashboard', '1', '2018-10-06 06:05:43', '2018-10-06 06:05:44'),
(318, 219, 1, 'Amail Kret has updated a class', '', '1', '2018-10-06 06:08:02', '2018-10-06 06:08:10'),
(319, 1, 219, 'You have successfully updated a class', 'teacher/dashboard', '1', '2018-10-06 06:08:02', '2018-10-06 06:21:35'),
(320, 219, 1, 'Amail Kret has deleted a class', '/admin/classrooms', '1', '2018-10-06 06:17:43', '2018-10-06 07:11:11'),
(321, 1, 219, 'You have successfully deleted a class', '/teacher/dashboard', '1', '2018-10-06 06:17:43', '2018-10-06 06:21:35'),
(322, 219, 1, 'Amail Kret has added new class', '/admin/classrooms/view/NA==', '1', '2018-10-06 06:18:14', '2018-10-06 07:11:11'),
(323, 1, 219, 'You have successfully added new class', 'teacher/dashboard', '1', '2018-10-06 06:18:14', '2018-10-06 06:21:35'),
(324, 219, 1, 'Amail Kret has updated a class', '/admin/classrooms/view/NA==', '1', '2018-10-06 06:18:35', '2018-10-06 07:11:11'),
(325, 1, 219, 'You have successfully updated a class', 'teacher/dashboard', '1', '2018-10-06 06:18:35', '2018-10-06 06:21:35'),
(326, 219, 1, 'Amail Kret has added new student, Akashya garje', '/admin/users/student/view/MjQx', '1', '2018-10-06 06:21:33', '2018-10-06 07:11:11'),
(327, 1, 219, 'You have successfully added new student, Akashya garje', '', '1', '2018-10-06 06:21:33', '2018-10-06 06:21:35'),
(328, 219, 241, 'You have successfully added to class : Class 11 by Amail Kret', '', '0', '2018-10-06 06:21:33', '2018-10-06 06:21:33'),
(329, 219, 1, 'Amail Kret has added new student, akshara garje', '/admin/users/student/view/MjQy', '1', '2018-10-06 06:24:19', '2018-10-06 07:11:11'),
(330, 1, 219, 'You have successfully added new student, akshara garje', '/teacher/my-student/NA==', '1', '2018-10-06 06:24:19', '2018-10-06 06:24:23'),
(331, 219, 242, 'You have successfully added to class : Class 11 by Amail Kret', '', '0', '2018-10-06 06:24:19', '2018-10-06 06:24:19'),
(332, 1, 219, 'Entered email/mobile, qehyla@amail.club, doesn\'t belong to this pin, 7386, or vice versa.', '', '1', '2018-10-06 06:32:03', '2018-10-06 06:33:41'),
(333, 1, 219, 'Akshara Garje, student already exists in your class.', '/teacher/my-student/NA==', '1', '2018-10-06 06:32:54', '2018-10-06 06:33:41'),
(334, 219, 242, 'You have successfully transfered to class : Class 11', '', '0', '2018-10-06 06:32:54', '2018-10-06 06:32:54'),
(336, 210, 1, 'Adolf Rebelo has added new child', '/admin/users/student/view/MjQz', '1', '2018-10-06 06:51:30', '2018-10-06 07:11:11'),
(337, 1, 210, 'You have been added a new child', 'parent/dashboard', '1', '2018-10-06 06:51:30', '2018-10-06 06:51:36'),
(338, 210, 243, 'You have been successfully added by Adolf Rebelo', '', '1', '2018-10-06 06:51:30', '2018-10-06 06:54:18'),
(339, 210, 1, 'Adolf Rebelo has updated a child', '/admin/users/student/view/MjQz', '1', '2018-10-06 06:51:34', '2018-10-06 07:11:11'),
(340, 1, 210, 'You have successfully updated a child', 'parent/dashboard', '1', '2018-10-06 06:51:34', '2018-10-06 06:51:36'),
(341, 210, 243, 'Your name Aashish Patil has been updated by Adolf Rebelo', '', '1', '2018-10-06 06:51:34', '2018-10-06 06:54:18'),
(342, 210, 1, 'Adolf Rebelo has added new child', '/admin/users/student/view/MjQ0', '1', '2018-10-06 06:56:47', '2018-10-06 07:11:11'),
(343, 1, 210, 'You have been added a new child', '/parent/my-kids', '1', '2018-10-06 06:56:47', '2018-10-06 06:56:49'),
(344, 210, 244, 'You have been successfully added by Adolf Rebelo', '', '1', '2018-10-06 06:56:47', '2018-10-06 07:15:43'),
(345, 219, 1, 'Amail Kret has updated a class', '/admin/classrooms/view/Mw==', '1', '2018-10-06 07:00:42', '2018-10-06 07:11:11'),
(346, 1, 219, 'You have successfully updated a class', 'teacher/dashboard', '1', '2018-10-06 07:00:42', '2018-10-06 07:06:27'),
(347, 219, 1, 'Amail Kret has added existing student, Djui Dijui', '/admin/users/student/view/MjIy', '1', '2018-10-06 07:06:22', '2018-10-06 07:11:11'),
(348, 1, 219, 'You have successfully added existing student, Djui Dijui', '/teacher/my-student/NA==', '1', '2018-10-06 07:06:22', '2018-10-06 07:06:27'),
(349, 219, 222, 'You have successfully added to class : Class 11 by Amail Kret', '', '0', '2018-10-06 07:06:22', '2018-10-06 07:06:22'),
(350, 219, 1, 'Amail Kret has updated a student data, Aarav Jagtap', '/admin/users/student/view/MjIy', '1', '2018-10-06 07:08:41', '2018-10-06 07:11:11'),
(351, 1, 219, 'You have successfully updated a student data, Aarav Jagtap', 'teacher/my-student/NA==', '1', '2018-10-06 07:08:41', '2018-10-06 07:08:44'),
(352, 219, 222, 'Your name Aarav Jagtap has been updated by Amail Kret', '', '0', '2018-10-06 07:08:41', '2018-10-06 07:08:41'),
(353, 219, 1, 'Amail Kret has removed a student from class, Aarav Jagtap', '/admin/users/student', '1', '2018-10-06 07:13:30', '2018-10-06 09:45:44'),
(354, 1, 219, 'You have successfully removed a student from your class, Aarav Jagtap', 'teacher/my-student/NA==', '1', '2018-10-06 07:13:30', '2018-10-06 07:13:33'),
(355, 219, 222, 'You have been removed from class : Class 11 by Amail Kret', '', '0', '2018-10-06 07:13:30', '2018-10-06 07:13:30'),
(356, 1, 219, 'Entered email/mobile, qehyla@amail.club, doesn\'t belong to this pin or entered pin, 0237, doesn\'t exists.', '', '1', '2018-10-06 07:18:42', '2018-10-06 07:19:04'),
(357, 1, 219, 'Akshara Garje, student already exists in your class.', '/teacher/my-student/NA==', '1', '2018-10-06 07:18:56', '2018-10-06 07:19:04'),
(358, 219, 242, 'You have successfully added to class : Class 11 by Amail Kret', '', '0', '2018-10-06 07:18:56', '2018-10-06 07:18:56'),
(359, 219, 218, 'Amail Kret has transfered Class 11 class successfully.', 'http://192.168.1.59/e-learning/teacher/dashboard', '0', '2018-10-06 07:20:43', '2018-10-06 07:20:43'),
(360, 219, 1, 'Amail Kret has added new student, ishwari mawal', '/admin/users/student/view/MjQ1', '1', '2018-10-06 08:46:51', '2018-10-06 09:45:44'),
(361, 1, 219, 'You have successfully added new student, ishwari mawal', '/teacher/my-student/Mw==', '0', '2018-10-06 08:46:51', '2018-10-06 08:46:51'),
(362, 219, 245, 'You have successfully added to class : Class2 by Amail Kret', '', '0', '2018-10-06 08:46:51', '2018-10-06 08:46:51'),
(363, 219, 1, 'Amail Kret has updated a student data, Ishwari Mawal', '/admin/users/student/view/MjQ1', '1', '2018-10-06 08:52:35', '2018-10-06 09:45:44'),
(364, 1, 219, 'You have successfully updated a student data, Ishwari Mawal', 'teacher/my-student/Mw==', '0', '2018-10-06 08:52:35', '2018-10-06 08:52:35'),
(365, 219, 245, 'Your name Ishwari Mawal has been updated by Amail Kret', '', '0', '2018-10-06 08:52:35', '2018-10-06 08:52:35'),
(366, 213, 1, 'Ruhi J has added new child', '/admin/users/student/view/MjQ2', '1', '2018-10-06 08:58:02', '2018-10-06 09:45:44'),
(368, 213, 246, 'You have been successfully added by Ruhi J', '', '1', '2018-10-06 08:58:02', '2018-10-06 09:18:40'),
(369, 1, 246, 'You have successfully completed program', '/program/details/', '1', '2018-10-06 09:18:35', '2018-10-06 09:18:40'),
(370, 1, 4, 'Program \"New PRogram\" approved by \"Admin Webwing\".', 'http://192.168.1.59/e-learning/program-creator/program/view/Mw==', '1', '2018-10-06 09:38:01', '2018-10-11 10:28:27'),
(371, 1, 4, 'Program \"Math Program\" approved by \"Admin Webwing\".', 'http://192.168.1.59/e-learning/program-creator/program/view/Mg==', '1', '2018-10-06 09:38:04', '2018-10-11 10:28:27'),
(372, 213, 246, 'A new program : Math Program is assigned to you by Ruhi J', '/student/program/details', '1', '2018-10-06 09:38:33', '2018-10-06 09:43:47'),
(374, 1, 246, 'You have successfully completed program - Math Program', '/student/program/details/Math-Program', '1', '2018-10-06 09:45:20', '2018-10-06 09:45:23'),
(375, 1, 246, 'You have successfully completed program - Math Program', '/student/program/details/Math-Program', '1', '2018-10-06 09:46:56', '2018-10-06 09:46:59'),
(376, 1, 246, 'You have successfully completed program - Math Program', '/student/program/details/Math-Program', '0', '2018-10-06 09:48:20', '2018-10-06 09:48:20'),
(377, 246, 1, 'Anshu j has successfully completed program - Math Program', 'admin/users/student/view/MjQ2', '1', '2018-10-06 09:48:20', '2018-10-09 05:22:38'),
(378, 213, 1, 'Ruhi J has updated a child', '/admin/users/student/view/MjQ2', '1', '2018-10-06 09:59:21', '2018-10-09 05:22:38'),
(379, 1, 213, 'You have successfully updated a child', 'parent/dashboard', '1', '2018-10-06 09:59:21', '2018-10-06 10:48:48'),
(380, 213, 246, 'Your name Anshu J has been updated by Ruhi J', '', '0', '2018-10-06 09:59:22', '2018-10-06 09:59:22'),
(381, 1, 246, 'You have successfully completed program - Math Program', '/student/program/details/Math-Program', '0', '2018-10-06 10:01:32', '2018-10-06 10:01:32'),
(382, 246, 1, 'Anshu J has successfully completed program - Math Program', '/admin/users/student/view/MjQ2', '1', '2018-10-06 10:01:32', '2018-10-09 05:22:38'),
(383, 211, 1, 'Teacher Teacher has added new class', '/admin/classrooms/view/Ng==', '1', '2018-10-06 10:37:51', '2018-10-09 05:22:38'),
(384, 1, 211, 'You have successfully added new class', '/teacher/dashboard', '1', '2018-10-06 10:37:52', '2018-10-06 13:10:16'),
(385, 213, 1, 'Ruhi J has updated a child', '/admin/users/student/view/MjQ2', '1', '2018-10-06 10:50:06', '2018-10-09 05:22:38'),
(386, 1, 213, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-06 10:50:06', '2018-10-06 10:50:34'),
(387, 213, 246, 'Your name Anshu J has been updated by Ruhi J', '', '0', '2018-10-06 10:50:06', '2018-10-06 10:50:06'),
(388, 1, 211, 'Entered email/mobile, teacher@cars2.club, doesn\'t belong to this pin or entered pin, 6324, doesn\'t exists.', '', '1', '2018-10-06 10:52:06', '2018-10-06 13:10:16'),
(389, 1, 211, 'Entered email/mobile, teacher@cars2.club, doesn\'t belong to this pin or entered pin, 6324, doesn\'t exists.', '', '1', '2018-10-06 10:52:41', '2018-10-06 13:10:16'),
(390, 211, 1, 'Teacher Teacher has added new student, Anuj reuhela', '/admin/users/student/view/MjQ3', '1', '2018-10-06 11:03:03', '2018-10-09 05:22:38'),
(391, 1, 211, 'You have successfully added new student, Anuj reuhela', '/teacher/my-student/Ng==', '1', '2018-10-06 11:03:03', '2018-10-06 13:10:16'),
(392, 211, 247, 'You have successfully added to class : Class1 by Teacher Teacher', '', '0', '2018-10-06 11:03:03', '2018-10-06 11:03:03'),
(393, 213, 1, 'Ruhi J has added existing child to his/her account using enrollment code.', '/admin/users/student', '1', '2018-10-06 11:10:43', '2018-10-09 05:22:38'),
(394, 1, 213, 'You have successfully added existing child to your account using enrollment code', '/parent/my-kids', '1', '2018-10-06 11:10:43', '2018-10-06 12:43:16'),
(395, 213, 247, 'You have been successfully added by Ruhi J', '', '0', '2018-10-06 11:10:43', '2018-10-06 11:10:43'),
(396, 211, 1, 'Teacher Teacher has added new student, Shivansh patil', '/admin/users/student/view/MjQ4', '1', '2018-10-06 11:43:09', '2018-10-09 05:22:38'),
(397, 1, 211, 'You have successfully added new student, Shivansh patil', '/teacher/my-student/Ng==', '1', '2018-10-06 11:43:09', '2018-10-06 13:10:16'),
(398, 211, 248, 'You have successfully added to class : Class1 by Teacher Teacher', '', '0', '2018-10-06 11:43:09', '2018-10-06 11:43:09'),
(399, 213, 1, 'Ruhi J has added existing child to his/her account using enrollment code.', '/admin/users/student', '1', '2018-10-06 12:25:03', '2018-10-09 05:22:38'),
(400, 1, 213, 'You have successfully added existing child to your account using enrollment code', '/parent/my-kids', '1', '2018-10-06 12:25:03', '2018-10-06 12:43:16'),
(401, 213, 248, 'You have been successfully added by Ruhi J', '', '0', '2018-10-06 12:25:03', '2018-10-06 12:25:03'),
(402, 213, 1, 'Ruhi J has deleted a child', '/admin/users/student', '1', '2018-10-06 12:27:18', '2018-10-09 05:22:38'),
(403, 1, 213, 'You have successfully deleted your child', '/parent/dashboard', '1', '2018-10-06 12:27:18', '2018-10-06 12:43:16'),
(404, 211, 1, 'Teacher Teacher has added new student, Shivansh patil', '/admin/users/student/view/MjQ5', '1', '2018-10-06 12:27:37', '2018-10-09 05:22:38'),
(405, 1, 211, 'You have successfully added new student, Shivansh patil', '/teacher/my-student/Ng==', '1', '2018-10-06 12:27:37', '2018-10-06 13:10:16'),
(406, 211, 249, 'You have successfully added to class : Class1 by Teacher Teacher', '', '0', '2018-10-06 12:27:37', '2018-10-06 12:27:37'),
(407, 211, 1, 'Teacher Teacher has added new student, Ishwari m', '/admin/users/student/view/MjUw', '1', '2018-10-06 12:28:42', '2018-10-09 05:22:38'),
(408, 1, 211, 'You have successfully added new student, Ishwari m', '/teacher/my-student/Ng==', '1', '2018-10-06 12:28:42', '2018-10-06 13:10:16'),
(409, 211, 250, 'You have successfully added to class : Class1 by Teacher Teacher', '', '0', '2018-10-06 12:28:42', '2018-10-06 12:28:42'),
(410, 213, 1, 'Ruhi J has added existing child to his/her account using enrollment code.', '/admin/users/student', '1', '2018-10-06 12:29:25', '2018-10-09 05:22:38'),
(411, 1, 213, 'You have successfully added existing child to your account using enrollment code', '/parent/my-kids', '1', '2018-10-06 12:29:25', '2018-10-06 12:43:16'),
(412, 213, 250, 'You have been successfully added by Ruhi J', '', '0', '2018-10-06 12:29:26', '2018-10-06 12:29:26'),
(413, 211, 1, 'Teacher Teacher has added new student, Shivansh p', '/admin/users/student/view/MjUx', '1', '2018-10-06 12:32:25', '2018-10-09 05:22:38'),
(414, 1, 211, 'You have successfully added new student, Shivansh p', '/teacher/my-student/Ng==', '1', '2018-10-06 12:32:25', '2018-10-06 13:10:16'),
(415, 211, 251, 'You have successfully added to class : Class1 by Teacher Teacher', '', '0', '2018-10-06 12:32:25', '2018-10-06 12:32:25'),
(416, 213, 1, 'Ruhi J has added existing child to his/her account using enrollment code.', '/admin/users/student', '1', '2018-10-06 12:34:23', '2018-10-09 05:22:38'),
(417, 1, 213, 'You have successfully added existing child to your account using enrollment code', '/parent/my-kids', '1', '2018-10-06 12:34:23', '2018-10-06 12:43:16'),
(418, 213, 251, 'You have been successfully added by Ruhi J', '', '0', '2018-10-06 12:34:23', '2018-10-06 12:34:23'),
(419, 213, 1, 'Ruhi J has updated a child', '/admin/users/student/view/MjUx', '1', '2018-10-06 12:34:34', '2018-10-09 05:22:38'),
(421, 213, 251, 'Your name Shivansh Patil has been updated by Ruhi J', '', '0', '2018-10-06 12:34:34', '2018-10-06 12:34:34'),
(422, 211, 1, 'Teacher Teacher has added new class', '/admin/classrooms/view/Nw==', '1', '2018-10-06 12:35:16', '2018-10-09 05:22:38'),
(423, 1, 211, 'You have successfully added new class', '/teacher/dashboard', '1', '2018-10-06 12:35:16', '2018-10-06 13:10:16'),
(424, 211, 1, 'Teacher Teacher has added new student, akshaya garje', '/admin/users/student/view/MjUy', '1', '2018-10-06 12:35:43', '2018-10-09 05:22:38'),
(425, 1, 211, 'You have successfully added new student, akshaya garje', '/teacher/my-student/Nw==', '1', '2018-10-06 12:35:43', '2018-10-06 13:10:16'),
(426, 211, 252, 'You have successfully added to class : Class2 by Teacher Teacher', '', '1', '2018-10-06 12:35:43', '2018-10-06 12:50:27'),
(427, 213, 1, 'Ruhi J has added existing child to his/her account using enrollment code.', '/admin/users/student', '1', '2018-10-06 12:43:10', '2018-10-09 05:22:38'),
(428, 1, 213, 'You have successfully added existing child to your account using enrollment code', '/parent/my-kids', '1', '2018-10-06 12:43:10', '2018-10-06 12:43:16'),
(429, 213, 252, 'You have been successfully added by Ruhi J', '', '1', '2018-10-06 12:43:10', '2018-10-06 12:50:27'),
(430, 213, 1, 'Ruhi J has updated a child', '/admin/users/student/view/MjUy', '1', '2018-10-06 12:43:23', '2018-10-09 05:22:38'),
(431, 1, 213, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-06 12:43:23', '2018-10-06 12:43:24'),
(432, 213, 252, 'Your name Akshaya Garje has been updated by Ruhi J', '', '1', '2018-10-06 12:43:23', '2018-10-06 12:50:27'),
(433, 213, 252, 'A new program : Math Program is assigned to you by Ruhi J', '/student/program/details/Math-Program', '1', '2018-10-06 12:43:43', '2018-10-06 12:50:27'),
(434, 213, 252, 'A new program : Program 1 is assigned to you by Ruhi J', '/student/program/details/Program-1', '1', '2018-10-06 12:49:40', '2018-10-06 12:50:27'),
(436, 213, 252, 'A new program : Math Program is assigned to you by Ruhi J', '/student/program/details/Math-Program', '1', '2018-10-08 04:39:10', '2018-10-11 05:27:34'),
(437, 213, 1, 'Ruhi J has updated a child', '/admin/users/student/view/MjUy', '1', '2018-10-08 04:56:12', '2018-10-09 05:22:38'),
(439, 213, 252, 'Your name Akshaya Garje has been updated by Ruhi J', '', '1', '2018-10-08 04:56:12', '2018-10-11 05:27:34'),
(440, 213, 1, 'Ruhi J has added new child', '/admin/users/student/view/MjUz', '1', '2018-10-08 05:08:55', '2018-10-09 05:22:38'),
(442, 213, 253, 'You have been successfully added by Ruhi J', '', '0', '2018-10-08 05:08:55', '2018-10-08 05:08:55'),
(443, 211, 1, 'Teacher Teacher has added new student, Aditya patil', '/admin/users/student/view/MjU0', '1', '2018-10-08 06:05:16', '2018-10-09 05:22:38'),
(444, 1, 211, 'You have successfully added new student, Aditya patil', '/teacher/my-student/Nw==', '1', '2018-10-08 06:05:17', '2018-10-08 08:46:32'),
(445, 211, 254, 'You have successfully added to class : Class2 by Teacher Teacher', '', '0', '2018-10-08 06:05:17', '2018-10-08 06:05:17'),
(446, 211, 1, 'Teacher Teacher has updated a student data, Aditya Patil', '/admin/users/student/view/MjU0', '1', '2018-10-08 06:05:21', '2018-10-09 05:22:38'),
(447, 1, 211, 'You have successfully updated a student data, Aditya Patil', 'teacher/my-student/Nw==', '1', '2018-10-08 06:05:21', '2018-10-08 08:46:32'),
(448, 211, 254, 'Your name Aditya Patil has been updated by Teacher Teacher', '', '0', '2018-10-08 06:05:21', '2018-10-08 06:05:21'),
(449, 211, 1, 'Teacher Teacher has updated a student data, Aditya Patil', '/admin/users/student/view/MjU0', '1', '2018-10-08 08:41:06', '2018-10-09 05:22:38'),
(450, 1, 211, 'You have successfully updated a student data, Aditya Patil', 'teacher/my-student/Nw==', '1', '2018-10-08 08:41:06', '2018-10-08 08:46:32'),
(451, 211, 254, 'Your name Aditya Patil has been updated by Teacher Teacher', '', '0', '2018-10-08 08:41:07', '2018-10-08 08:41:07'),
(452, 211, 1, 'Teacher Teacher has updated a student data, Aditya Patil', '/admin/users/student/view/MjU0', '1', '2018-10-08 08:43:47', '2018-10-09 05:22:38'),
(453, 1, 211, 'You have successfully updated a student data, Aditya Patil', 'teacher/my-student/Nw==', '1', '2018-10-08 08:43:47', '2018-10-08 08:46:32'),
(454, 211, 254, 'Your name Aditya Patil has been updated by Teacher Teacher', '', '0', '2018-10-08 08:43:47', '2018-10-08 08:43:47'),
(455, 211, 1, 'Teacher Teacher has deleted a class', '/admin/classrooms', '1', '2018-10-08 08:46:55', '2018-10-09 05:22:38'),
(456, 1, 211, 'You have successfully deleted a class', '/teacher/dashboard', '1', '2018-10-08 08:46:55', '2018-10-08 08:54:45'),
(457, 255, 1, 'cececy cc has successfully registered as a teacher', '/admin/users/teacher', '1', '2018-10-08 08:48:23', '2018-10-09 05:22:38'),
(458, 255, 1, 'Cececy Cc has added new class', '/admin/classrooms/view/OA==', '1', '2018-10-08 08:49:33', '2018-10-09 05:22:38'),
(459, 1, 255, 'You have successfully added new class', '/teacher/dashboard', '1', '2018-10-08 08:49:33', '2018-10-08 08:51:39'),
(460, 255, 1, 'Cececy Cc has transfer student, Aditya Patil', '/admin/users/student/view/MjU0', '1', '2018-10-08 08:50:13', '2018-10-09 05:22:38'),
(461, 1, 255, 'You have successfully transfer student, Aditya Patil', '/teacher/my-student/OA==', '1', '2018-10-08 08:50:13', '2018-10-08 08:51:39'),
(462, 255, 254, 'You have successfully transfered to class : Class A', '', '0', '2018-10-08 08:50:13', '2018-10-08 08:50:13'),
(463, 255, 211, 'Cececy Cc has shared Class A class successfully.', '/teacher/dashboard', '1', '2018-10-08 08:50:53', '2018-10-08 08:54:45'),
(464, 255, 211, 'Cececy Cc has transfered Class A class successfully.', '/teacher/dashboard', '1', '2018-10-08 08:51:02', '2018-10-08 08:54:45'),
(465, 255, 1, 'Cececy Cc has transfer student, Aditya Patil', '/admin/users/student/view/MjU0', '1', '2018-10-08 08:52:59', '2018-10-09 05:22:38'),
(466, 1, 255, 'You have successfully transfer student, Aditya Patil', '/teacher/my-student/OA==', '1', '2018-10-08 08:52:59', '2018-10-08 08:57:57'),
(467, 255, 254, 'You have successfully transfered to class : Class A', '', '0', '2018-10-08 08:52:59', '2018-10-08 08:52:59'),
(468, 1, 211, 'Aditya Patil, student already exists in your class.', '/teacher/my-student/OQ==', '1', '2018-10-08 08:54:24', '2018-10-08 08:54:45'),
(469, 211, 254, 'You have successfully added to class : Class A by Teacher Teacher', '', '0', '2018-10-08 08:54:24', '2018-10-08 08:54:24'),
(470, 255, 1, 'Cececy Cc has updated a student data, Aditya Patil', '/admin/users/student/view/MjU0', '1', '2018-10-08 09:32:57', '2018-10-09 05:22:38'),
(471, 1, 255, 'You have successfully updated a student data, Aditya Patil', 'teacher/my-student/OA==', '1', '2018-10-08 09:32:57', '2018-10-09 04:04:54'),
(472, 255, 254, 'Your name Aditya Patil has been updated by Cececy Cc', '', '0', '2018-10-08 09:32:57', '2018-10-08 09:32:57'),
(473, 1, 211, 'You have successfully updated your password', '/teacher/account-setting/my-profile', '1', '2018-10-08 10:20:51', '2018-10-08 10:38:33'),
(474, 1, 211, 'You have successfully updated your profile', '/teacher/account-setting/my-profile', '1', '2018-10-08 13:09:12', '2018-10-09 04:15:32'),
(475, 211, 1, 'Teacher Teacher has deleted a class', '/admin/classrooms', '1', '2018-10-09 04:22:38', '2018-10-09 05:22:38'),
(476, 1, 211, 'You have successfully deleted a class', '/teacher/dashboard', '1', '2018-10-09 04:22:38', '2018-10-09 11:06:58'),
(477, 211, 1, 'Teacher Teacher has added new class', '/admin/classrooms/view/MTA=', '1', '2018-10-09 04:22:51', '2018-10-09 05:22:38'),
(478, 1, 211, 'You have successfully added new class', '/teacher/dashboard', '1', '2018-10-09 04:22:51', '2018-10-09 11:06:58'),
(479, 211, 1, 'Teacher Teacher has added new student, riddhi j', '/admin/users/student/view/MjU2', '1', '2018-10-09 04:27:02', '2018-10-09 05:22:38'),
(480, 1, 211, 'You have successfully added new student, riddhi j', '/teacher/my-student/Nw==', '1', '2018-10-09 04:27:02', '2018-10-09 11:06:58'),
(481, 211, 256, 'You have successfully added to class : Class2 by Teacher Teacher', '', '1', '2018-10-09 04:27:02', '2018-10-12 04:33:24'),
(482, 1, 218, 'Admin has successfully updated your\"Class 11\" class', 'teacher/dashboard', '0', '2018-10-09 06:01:21', '2018-10-09 06:01:21'),
(483, 211, 1, 'Teacher Teacher has added new student, Apeksha p', '/admin/users/student/view/MjU3', '1', '2018-10-09 06:05:14', '2018-10-09 10:44:05'),
(484, 1, 211, 'You have successfully added new student, Apeksha p', '/teacher/my-student/Nw==', '1', '2018-10-09 06:05:14', '2018-10-09 11:06:58'),
(485, 211, 257, 'You have successfully added to class : Class2 by Teacher Teacher', '', '1', '2018-10-09 06:05:14', '2018-10-11 10:29:55'),
(486, 213, 1, 'Ruhi J has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-09 09:59:17', '2018-10-09 10:44:05'),
(487, 1, 213, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-09 09:59:17', '2018-10-09 10:19:53'),
(488, 1, 213, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -3 Year', '/parent/transactions', '1', '2018-10-09 09:59:42', '2018-10-09 10:19:53'),
(489, 213, 1, 'Ruhi J has updated a child', '/admin/users/student/view/MjUx', '1', '2018-10-09 10:21:37', '2018-10-09 10:44:05'),
(490, 1, 213, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-09 10:21:37', '2018-10-09 10:22:30'),
(491, 213, 251, 'Your name Shivansh Patil has been updated by Ruhi J', '', '0', '2018-10-09 10:21:37', '2018-10-09 10:21:37'),
(492, 1, 213, 'You have updated your profile successfully.', '/parent/account-setting/my-profile', '1', '2018-10-09 10:24:02', '2018-10-09 10:52:38'),
(493, 211, 1, 'Teacher Teacher has added new class', '/admin/classrooms/view/MTE=', '1', '2018-10-09 11:10:38', '2018-10-09 11:20:41'),
(494, 1, 211, 'You have successfully added new class', '/teacher/dashboard', '1', '2018-10-09 11:10:38', '2018-10-09 11:11:15'),
(495, 211, 1, 'Teacher Teacher has added new class', '/admin/classrooms/view/MTI=', '1', '2018-10-09 11:10:55', '2018-10-09 11:20:41'),
(496, 1, 211, 'You have successfully added new class', '/teacher/dashboard', '1', '2018-10-09 11:10:55', '2018-10-09 11:11:15'),
(497, 213, 1, 'Ruhi J has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-09 11:46:45', '2018-10-09 12:17:09'),
(499, 211, 257, 'A new program : Math Program is assigned to you by Teacher Teacher', '/student/program/details', '1', '2018-10-09 13:35:31', '2018-10-11 10:29:55'),
(500, 211, 257, 'A new program : Program 1 is assigned to you by Teacher Teacher', '/student/program/details', '1', '2018-10-09 13:35:35', '2018-10-11 10:29:55'),
(501, 1, 16, 'You have updated your profile successfully.', '/parent/account-setting/my-profile', '1', '2018-10-10 06:18:29', '2018-10-15 04:03:11'),
(502, 1, 16, 'You have updated your profile successfully.', '/parent/account-setting/my-profile', '1', '2018-10-10 06:36:27', '2018-10-15 04:03:11'),
(503, 1, 16, 'You have updated your profile successfully.', '/parent/account-setting/my-profile', '1', '2018-10-10 06:36:31', '2018-10-15 04:03:11'),
(504, 1, 16, 'You have updated your profile successfully.', '/parent/account-setting/my-profile', '1', '2018-10-10 06:36:35', '2018-10-15 04:03:11'),
(505, 1, 16, 'You have updated your profile successfully.', '/parent/account-setting/my-profile', '1', '2018-10-10 06:36:39', '2018-10-15 04:03:11'),
(506, 211, 256, 'A new program : Program 1 is assigned to you by Teacher Teacher', '/student/program/details', '1', '2018-10-10 07:27:34', '2018-10-12 04:33:24'),
(507, 211, 1, 'Teacher Teacher has added new student, Kriti sanon', '/admin/users/student/view/MjU4', '1', '2018-10-10 09:10:03', '2018-10-10 09:36:18'),
(508, 1, 211, 'You have successfully added new student, Kriti sanon', '/teacher/my-student/MTI=', '1', '2018-10-10 09:10:03', '2018-10-10 09:31:04'),
(509, 211, 258, 'You have successfully added to class : Class4 by Teacher Teacher', '', '0', '2018-10-10 09:10:03', '2018-10-10 09:10:03'),
(510, 213, 1, 'Ruhi J has updated a child', '/admin/users/student/view/MjUy', '1', '2018-10-10 09:50:16', '2018-10-10 10:08:43'),
(512, 213, 252, 'Your name Akshaya Garje has been updated by Ruhi J', '', '1', '2018-10-10 09:50:16', '2018-10-11 05:27:34'),
(513, 1, 211, 'You have successfully updated your profile', '/teacher/account-setting/my-profile', '1', '2018-10-10 09:57:17', '2018-10-11 04:05:11'),
(514, 1, 213, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -3 Year', '/parent/transactions', '1', '2018-10-10 10:06:30', '2018-10-10 10:20:54'),
(515, 211, 1, 'Teacher Teacher has updated a class', '/admin/classrooms/view/MTI=', '1', '2018-10-10 11:39:51', '2018-10-12 04:40:35'),
(516, 1, 211, 'You have successfully updated a class', '/teacher/dashboard', '1', '2018-10-10 11:39:51', '2018-10-11 04:05:11'),
(517, 182, 1, 'Rohini J has added existing child to his/her account using enrollment code.', '/admin/users/student', '1', '2018-10-11 05:41:11', '2018-10-12 04:40:35');
INSERT INTO `notifications` (`id`, `from_user_id`, `to_user_id`, `message`, `url`, `is_read`, `created_at`, `updated_at`) VALUES
(518, 1, 182, 'You have successfully added existing child to your account using enrollment code', '/parent/my-kids', '1', '2018-10-11 05:41:11', '2018-10-11 07:18:59'),
(519, 182, 258, 'You have been successfully added by Rohini J', '', '0', '2018-10-11 05:41:11', '2018-10-11 05:41:11'),
(520, 259, 1, 'poonam mahajan has successfully registered as a enroll', '/admin/users/teacher', '1', '2018-10-11 05:43:44', '2018-10-12 04:40:35'),
(521, 211, 1, 'Teacher Teacher has added new class', '/admin/classrooms/view/MTM=', '1', '2018-10-11 05:50:13', '2018-10-12 04:40:35'),
(522, 1, 211, 'You have successfully added new class', '/teacher/dashboard', '1', '2018-10-11 05:50:13', '2018-10-11 07:27:01'),
(523, 211, 1, 'Teacher Teacher has added new student, dummy Student', '/admin/users/student/view/MjYw', '1', '2018-10-11 05:50:42', '2018-10-12 04:40:35'),
(524, 1, 211, 'You have successfully added new student, dummy Student', '/teacher/my-student/MTM=', '1', '2018-10-11 05:50:42', '2018-10-11 07:27:01'),
(525, 211, 260, 'You have successfully added to class : Testing Class by Teacher Teacher', '', '1', '2018-10-11 05:50:42', '2018-10-11 05:54:32'),
(526, 261, 1, 'Testng Parent has successfully registered as a enroll', '/admin/users/teacher', '1', '2018-10-11 05:53:26', '2018-10-12 04:40:35'),
(527, 211, 1, 'Teacher Teacher has added new class', '/admin/classrooms/view/MTQ=', '1', '2018-10-11 06:08:25', '2018-10-12 04:40:35'),
(528, 1, 211, 'You have successfully added new class', '/teacher/dashboard', '1', '2018-10-11 06:08:26', '2018-10-11 07:27:01'),
(529, 211, 1, 'Teacher Teacher has added new student, New Student', '/admin/users/student/view/MjYy', '1', '2018-10-11 06:09:20', '2018-10-12 04:40:35'),
(530, 1, 211, 'You have successfully added new student, New Student', '/teacher/my-student/MTM=', '1', '2018-10-11 06:09:20', '2018-10-11 07:27:01'),
(531, 211, 262, 'You have successfully added to class : Testing Class by Teacher Teacher', '', '0', '2018-10-11 06:09:20', '2018-10-11 06:09:20'),
(532, 261, 1, 'Testng Parent has added existing child to his/her account using enrollment code.', '/admin/users/student', '1', '2018-10-11 06:11:40', '2018-10-12 04:40:35'),
(533, 1, 261, 'You have successfully added existing child to your account using enrollment code', '/parent/my-kids', '0', '2018-10-11 06:11:40', '2018-10-11 06:11:40'),
(534, 261, 262, 'You have been successfully added by Testng Parent', '', '0', '2018-10-11 06:11:40', '2018-10-11 06:11:40'),
(535, 255, 1, 'Cececy Cc has added new class', '/admin/classrooms/view/MTU=', '1', '2018-10-11 06:17:39', '2018-10-12 04:40:35'),
(536, 1, 255, 'You have successfully added new class', '/teacher/dashboard', '1', '2018-10-11 06:17:39', '2018-10-11 06:47:17'),
(537, 255, 1, 'Cececy Cc has added new student, asd asdasd', '/admin/users/student/view/MjYz', '1', '2018-10-11 06:37:35', '2018-10-12 04:40:35'),
(538, 1, 255, 'You have successfully added new student, asd asdasd', '/teacher/my-student/MTU=', '1', '2018-10-11 06:37:35', '2018-10-11 06:47:17'),
(539, 255, 263, 'You have successfully added to class : Cc-Test Class by Cececy Cc', '', '0', '2018-10-11 06:37:35', '2018-10-11 06:37:35'),
(540, 255, 1, 'Cececy Cc has removed a student from class, Asd Asdasd', '/admin/users/student', '1', '2018-10-11 06:37:39', '2018-10-12 04:40:35'),
(541, 1, 255, 'You have successfully removed a student from your class, Asd Asdasd', 'teacher/my-student/MTU=', '1', '2018-10-11 06:37:39', '2018-10-11 06:47:17'),
(542, 255, 263, 'You have been removed from class : Cc-Test Class by Cececy Cc', '', '0', '2018-10-11 06:37:40', '2018-10-11 06:37:40'),
(543, 255, 1, 'Cececy Cc has added new student, fghfgh fghfghfgh', '/admin/users/student/view/MjY0', '1', '2018-10-11 06:37:50', '2018-10-12 04:40:35'),
(544, 1, 255, 'You have successfully added new student, fghfgh fghfghfgh', '/teacher/my-student/MTU=', '1', '2018-10-11 06:37:50', '2018-10-11 06:47:17'),
(545, 255, 264, 'You have successfully added to class : Cc-Test Class by Cececy Cc', '', '0', '2018-10-11 06:37:50', '2018-10-11 06:37:50'),
(546, 255, 1, 'Cececy Cc has added new class', '/admin/classrooms/view/MTY=', '1', '2018-10-11 06:38:23', '2018-10-12 04:40:35'),
(547, 1, 255, 'You have successfully added new class', '/teacher/dashboard', '1', '2018-10-11 06:38:23', '2018-10-11 06:47:17'),
(548, 255, 1, 'Cececy Cc has updated a student data, Athrav Patil', '/admin/users/student/view/MjY0', '1', '2018-10-11 06:38:52', '2018-10-12 04:40:35'),
(549, 1, 255, 'You have successfully updated a student data, Athrav Patil', 'teacher/my-student/MTU=', '1', '2018-10-11 06:38:52', '2018-10-11 06:47:17'),
(550, 255, 264, 'Your name Athrav Patil has been updated by Cececy Cc', '', '0', '2018-10-11 06:38:52', '2018-10-11 06:38:52'),
(551, 1, 255, 'Athrav Patil, student already exists in your class.', '/teacher/my-student/MTY=', '1', '2018-10-11 06:42:21', '2018-10-11 06:47:17'),
(552, 255, 264, 'You have successfully transfered to class : Test new class', '', '0', '2018-10-11 06:42:21', '2018-10-11 06:42:21'),
(553, 1, 255, 'Athrav Patil, student already exists in your class.', '/teacher/my-student/MTY=', '1', '2018-10-11 06:43:22', '2018-10-11 06:47:17'),
(554, 255, 264, 'You have successfully transfered to class : Test new class', '', '0', '2018-10-11 06:43:22', '2018-10-11 06:43:22'),
(555, 1, 255, 'Entered email/mobile, teacher@cars2.club, doesn\'t belong to this pin, 5646, or vice versa.', '', '1', '2018-10-11 06:44:41', '2018-10-11 06:47:17'),
(556, 1, 255, 'Entered email/mobile, cececy@nada.email, doesn\'t belong to this pin, 5646, or vice versa.', '', '1', '2018-10-11 06:44:55', '2018-10-11 06:47:17'),
(557, 1, 255, 'Entered email/mobile, cececy@nada.email, doesn\'t belong to this pin, 7604, or vice versa.', '', '1', '2018-10-11 06:45:14', '2018-10-11 06:47:17'),
(558, 1, 255, 'Entered email/mobile, cececy@nada.email, doesn\'t belong to this pin, 5646, or vice versa.', '', '1', '2018-10-11 06:48:17', '2018-10-11 06:48:19'),
(559, 255, 1, 'Cececy Cc has transfer student, Aditya Patil', '/admin/users/student/view/MjU0', '1', '2018-10-11 06:50:31', '2018-10-12 04:40:35'),
(560, 1, 255, 'You have successfully transfer student, Aditya Patil', '/teacher/my-student/MTY=', '1', '2018-10-11 06:50:31', '2018-10-15 07:25:02'),
(561, 255, 254, 'You have successfully transfered to class : Test new class', '', '0', '2018-10-11 06:50:31', '2018-10-11 06:50:31'),
(562, 265, 1, 'isha gupta has successfully registered as a enroll', '/admin/users/teacher', '1', '2018-10-11 07:12:24', '2018-10-12 04:40:35'),
(563, 182, 1, 'Rohini J has added existing child to his/her account using enrollment code.', '/admin/users/student', '1', '2018-10-11 07:25:18', '2018-10-12 04:40:35'),
(564, 1, 182, 'You have successfully added existing child to your account using enrollment code', '/parent/my-kids', '1', '2018-10-11 07:25:18', '2018-10-11 08:32:06'),
(565, 182, 257, 'You have been successfully added by Rohini J', '', '1', '2018-10-11 07:25:18', '2018-10-11 10:29:55'),
(566, 1, 211, 'You have successfully updated your profile', '/teacher/account-setting/my-profile', '1', '2018-10-11 07:27:34', '2018-10-11 07:29:03'),
(567, 211, 1, 'Teacher Teacher has updated a class', '/admin/classrooms/view/MTE=', '1', '2018-10-11 07:28:14', '2018-10-12 04:40:35'),
(568, 1, 211, 'You have successfully updated a class', '/teacher/dashboard', '1', '2018-10-11 07:28:14', '2018-10-11 07:29:03'),
(569, 182, 257, 'A new program : Program 1 is assigned to you by Rohini J', '/student/program/details/Program-1', '1', '2018-10-11 10:23:00', '2018-10-11 10:29:55'),
(570, 182, 1, 'Rohini J has added new child', '/admin/users/student/view/MjY2', '1', '2018-10-11 11:16:45', '2018-10-12 04:40:35'),
(571, 1, 182, 'You have added a new child', '/parent/my-kids', '1', '2018-10-11 11:16:45', '2018-10-11 11:56:10'),
(572, 182, 266, 'You have been successfully added by Rohini J', '', '0', '2018-10-11 11:16:45', '2018-10-11 11:16:45'),
(573, 182, 1, 'Rohini J has added new child', '/admin/users/student/view/MjY3', '1', '2018-10-11 11:17:00', '2018-10-12 04:40:35'),
(574, 1, 182, 'You have added a new child', '/parent/my-kids', '1', '2018-10-11 11:17:00', '2018-10-11 11:56:10'),
(575, 182, 267, 'You have been successfully added by Rohini J', '', '0', '2018-10-11 11:17:00', '2018-10-11 11:17:00'),
(576, 182, 1, 'Rohini J has added new child', '/admin/users/student/view/MjY4', '1', '2018-10-11 11:17:19', '2018-10-12 04:40:35'),
(577, 1, 182, 'You have added a new child', '/parent/my-kids', '1', '2018-10-11 11:17:19', '2018-10-11 11:56:10'),
(578, 182, 268, 'You have been successfully added by Rohini J', '', '0', '2018-10-11 11:17:19', '2018-10-11 11:17:19'),
(579, 213, 252, 'A new program : Program 1 is assigned to you by Ruhi J', '/student/program/details/Program-1', '0', '2018-10-11 11:19:59', '2018-10-11 11:19:59'),
(580, 213, 1, 'Ruhi J has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-11 12:10:13', '2018-10-12 04:40:35'),
(581, 1, 213, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-11 12:10:13', '2018-10-12 03:54:58'),
(582, 1, 213, 'You have updated your profile successfully.', '/parent/account-setting/my-profile', '1', '2018-10-11 12:35:03', '2018-10-12 03:54:58'),
(583, 213, 1, 'Ruhi J has added new child', '/admin/users/student/view/MjY5', '1', '2018-10-11 12:37:59', '2018-10-12 04:40:35'),
(584, 1, 213, 'You have added a new child', '/parent/my-kids', '1', '2018-10-11 12:37:59', '2018-10-12 03:54:58'),
(585, 213, 269, 'You have been successfully added by Ruhi J', '', '0', '2018-10-11 12:37:59', '2018-10-11 12:37:59'),
(586, 213, 1, 'Ruhi J has added new child', '/admin/users/student/view/Mjcw', '1', '2018-10-11 12:38:13', '2018-10-12 04:40:35'),
(587, 1, 213, 'You have added a new child', '/parent/my-kids', '1', '2018-10-11 12:38:14', '2018-10-12 03:54:58'),
(588, 213, 270, 'You have been successfully added by Ruhi J', '', '0', '2018-10-11 12:38:14', '2018-10-11 12:38:14'),
(589, 213, 1, 'Ruhi J has updated a child', '/admin/users/student/view/Mjcw', '1', '2018-10-11 12:38:23', '2018-10-12 04:40:35'),
(590, 1, 213, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-11 12:38:23', '2018-10-12 03:54:58'),
(591, 213, 270, 'Your name Sdfsdfxcvc Sfsdfccxvvvvvvvvvv has been updated by Ruhi J', '', '0', '2018-10-11 12:38:23', '2018-10-11 12:38:23'),
(592, 213, 1, 'Ruhi J has deleted a child', '/admin/users/student', '1', '2018-10-11 12:38:26', '2018-10-12 04:40:35'),
(593, 1, 213, 'You have successfully deleted your child', '/parent/dashboard', '1', '2018-10-11 12:38:26', '2018-10-12 03:54:58'),
(594, 271, 1, 'aaaa bbbb has successfully registered as a parent', '/admin/users/parent', '1', '2018-10-11 12:44:00', '2018-10-12 04:40:35'),
(595, 271, 1, 'Aaaa Bbbb has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-11 12:46:35', '2018-10-12 04:40:35'),
(596, 1, 271, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-11 12:46:35', '2018-10-11 13:25:05'),
(597, 1, 271, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -1 Year', '/parent/transactions', '1', '2018-10-11 12:48:52', '2018-10-11 13:25:05'),
(598, 211, 256, 'A new program : Math Program is assigned to you by Teacher Teacher', '/student/program/details', '1', '2018-10-11 12:49:40', '2018-10-12 04:33:24'),
(599, 271, 1, 'Aaaa Bbbb has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-11 13:17:21', '2018-10-12 04:40:35'),
(600, 1, 271, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-11 13:17:21', '2018-10-11 13:25:05'),
(601, 1, 271, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -1 Year', '/parent/transactions', '1', '2018-10-11 13:17:45', '2018-10-11 13:25:05'),
(602, 271, 1, 'Aaaa Bbbb has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-11 13:24:42', '2018-10-12 04:40:35'),
(603, 1, 271, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-11 13:24:42', '2018-10-11 13:25:05'),
(604, 1, 271, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -1 Year', '/parent/transactions', '0', '2018-10-11 13:25:48', '2018-10-11 13:25:48'),
(605, 271, 1, 'Aaaa Bbbb has added new child', '/admin/users/student/view/Mjcy', '1', '2018-10-11 13:28:07', '2018-10-12 04:40:35'),
(606, 1, 271, 'You have added a new child', '/parent/my-kids', '0', '2018-10-11 13:28:07', '2018-10-11 13:28:07'),
(607, 271, 272, 'You have been successfully added by Aaaa Bbbb', '', '0', '2018-10-11 13:28:07', '2018-10-11 13:28:07'),
(608, 271, 1, 'Aaaa Bbbb has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-11 13:28:17', '2018-10-12 04:40:35'),
(609, 1, 271, 'Your wire transfer request has been sent successfully to admin,Wait until admin approve your request After only you can access this functionality.', '/pricing', '0', '2018-10-11 13:28:17', '2018-10-11 13:28:17'),
(610, 1, 213, 'You have updated your profile successfully.', '/parent/account-setting/my-profile', '1', '2018-10-12 03:55:46', '2018-10-12 03:55:57'),
(611, 213, 1, 'Ruhi J has deleted a child', '/admin/users/student', '1', '2018-10-12 03:56:35', '2018-10-12 04:40:35'),
(612, 1, 213, 'You have successfully deleted your child', '/parent/dashboard', '0', '2018-10-12 03:56:35', '2018-10-12 03:56:35'),
(613, 211, 1, 'Teacher Teacher has deleted a class', '/admin/classrooms', '1', '2018-10-12 03:57:19', '2018-10-12 04:40:35'),
(614, 1, 211, 'You have successfully deleted a class', '/teacher/dashboard', '0', '2018-10-12 03:57:19', '2018-10-12 03:57:19'),
(615, 211, 1, 'Teacher Teacher has deleted a class', '/admin/classrooms', '1', '2018-10-12 03:57:22', '2018-10-12 04:40:35'),
(616, 1, 211, 'You have successfully deleted a class', '/teacher/dashboard', '0', '2018-10-12 03:57:22', '2018-10-12 03:57:22'),
(617, 211, 1, 'Teacher Teacher has deleted a class', '/admin/classrooms', '1', '2018-10-12 03:57:25', '2018-10-12 04:40:35'),
(618, 1, 211, 'You have successfully deleted a class', '/teacher/dashboard', '0', '2018-10-12 03:57:25', '2018-10-12 03:57:25'),
(619, 211, 1, 'Teacher Teacher has deleted a class', '/admin/classrooms', '1', '2018-10-12 03:57:29', '2018-10-12 04:40:35'),
(620, 1, 211, 'You have successfully deleted a class', '/teacher/dashboard', '0', '2018-10-12 03:57:29', '2018-10-12 03:57:29'),
(621, 211, 1, 'Teacher Teacher has added new class', '/admin/classrooms/view/MTc=', '1', '2018-10-12 03:58:29', '2018-10-12 04:40:35'),
(622, 1, 211, 'You have successfully added new class', '/teacher/dashboard', '0', '2018-10-12 03:58:29', '2018-10-12 03:58:29'),
(623, 211, 256, 'You have transfered from Class2 to New class', '', '1', '2018-10-12 04:29:39', '2018-10-12 04:33:24'),
(624, 211, 0, 'Your child -Riddhi J has transfered from Class2 to New class', '', '0', '2018-10-12 04:29:39', '2018-10-12 04:29:39'),
(625, 182, 1, 'Rohini J has added existing child to his/her account using enrollment code.', '/admin/users/student', '1', '2018-10-12 04:32:59', '2018-10-12 04:40:35'),
(626, 1, 182, 'You have successfully added existing child to your account using enrollment code', '/parent/my-kids', '1', '2018-10-12 04:32:59', '2018-10-12 04:33:02'),
(627, 182, 256, 'You have been successfully added by Rohini J', '', '1', '2018-10-12 04:32:59', '2018-10-12 04:33:24'),
(628, 182, 1, 'Rohini J has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-12 05:03:25', '2018-10-12 06:03:49'),
(629, 1, 182, 'Your wire transfer request has been sent successfully to admin, Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-12 05:03:25', '2018-10-12 05:20:04'),
(630, 182, 1, 'Rohini J has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-12 05:17:21', '2018-10-12 06:03:49'),
(631, 1, 182, 'Your wire transfer request has been sent successfully to admin, Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-12 05:17:21', '2018-10-12 05:20:04'),
(632, 182, 1, 'Rohini J has added new child', '/admin/users/student/view/Mjcz', '1', '2018-10-12 05:29:23', '2018-10-12 06:03:49'),
(633, 1, 182, 'You have added a new child', '/parent/my-kids', '1', '2018-10-12 05:29:23', '2018-10-12 05:31:43'),
(634, 182, 273, 'You have been successfully added by Rohini J', '', '0', '2018-10-12 05:29:23', '2018-10-12 05:29:23'),
(635, 182, 1, 'Rohini J has updated a child', '/admin/users/student/view/Mjcz', '1', '2018-10-12 05:29:28', '2018-10-12 06:03:49'),
(636, 1, 182, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-12 05:29:28', '2018-10-12 05:31:43'),
(637, 182, 273, 'Your name Kareena Kappor has been updated by Rohini J', '', '0', '2018-10-12 05:29:28', '2018-10-12 05:29:28'),
(638, 1, 182, 'You have updated your profile successfully.', '/parent/account-setting/my-profile', '1', '2018-10-12 05:31:11', '2018-10-12 05:31:43'),
(639, 1, 182, 'You have updated your profile successfully.', '/parent/account-setting/my-profile', '1', '2018-10-12 05:31:19', '2018-10-12 05:31:43'),
(640, 274, 1, 'teacher teacher has successfully registered as a teacher', '/admin/users/teacher', '1', '2018-10-12 05:36:59', '2018-10-12 06:03:49'),
(641, 274, 1, 'Teacher Teacher has added new class', '/admin/classrooms/view/MTg=', '1', '2018-10-12 05:46:12', '2018-10-12 06:03:49'),
(642, 1, 274, 'You have successfully added new class', '/teacher/dashboard', '1', '2018-10-12 05:46:12', '2018-10-12 05:47:33'),
(643, 274, 1, 'Teacher Teacher has added new student, Arpita malode', '/admin/users/student/view/Mjc1', '1', '2018-10-12 05:46:54', '2018-10-12 06:03:49'),
(644, 1, 274, 'You have successfully added new student, Arpita malode', '/teacher/my-student/MTg=', '1', '2018-10-12 05:46:54', '2018-10-12 05:47:33'),
(645, 274, 275, 'You have successfully added to class : Class orange by Teacher Teacher', '', '1', '2018-10-12 05:46:54', '2018-10-12 05:58:50'),
(646, 276, 1, 'parent p has successfully registered as a enroll', '/admin/users/teacher', '1', '2018-10-12 05:48:33', '2018-10-12 06:03:49'),
(647, 276, 1, 'Parent P has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-12 05:50:04', '2018-10-12 06:03:49'),
(648, 1, 276, 'Your wire transfer request has been sent successfully to admin, Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-12 05:50:04', '2018-10-12 05:58:12'),
(649, 276, 1, 'Parent P has updated a child', '/admin/users/student/view/Mjc1', '1', '2018-10-12 05:57:47', '2018-10-12 06:03:49'),
(650, 1, 276, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-12 05:57:47', '2018-10-12 05:58:12'),
(651, 276, 275, 'Your name Arpita Malode has been updated by Parent P', '', '1', '2018-10-12 05:57:47', '2018-10-12 05:58:50'),
(652, 276, 275, 'A new program : Program 1 is assigned to you by Parent P', '/student/program/details/Program-1', '1', '2018-10-12 05:58:02', '2018-10-12 05:58:50'),
(653, 276, 1, 'Parent P has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-12 06:10:12', '2018-10-12 10:44:30'),
(654, 1, 276, 'Your wire transfer request has been sent successfully to admin, Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-12 06:10:12', '2018-10-12 06:57:37'),
(655, 276, 1, 'Parent P has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-12 06:54:56', '2018-10-12 10:44:30'),
(656, 1, 276, 'Your wire transfer request has been sent successfully to admin, Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-12 06:54:56', '2018-10-12 06:57:37'),
(657, 1, 276, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -5 Year', '/parent/transactions', '1', '2018-10-12 07:11:16', '2018-10-12 07:11:32'),
(658, 276, 1, 'Parent P has added new child', '/admin/users/student/view/Mjc3', '1', '2018-10-12 10:47:11', '2018-10-16 11:48:41'),
(659, 1, 276, 'You have added a new child', '/parent/my-kids', '1', '2018-10-12 10:47:11', '2018-10-12 10:47:56'),
(660, 276, 277, 'You have been successfully added by Parent P', '', '1', '2018-10-12 10:47:11', '2018-10-15 04:26:26'),
(661, 276, 1, 'Parent P has updated a child', '/admin/users/student/view/Mjc1', '1', '2018-10-12 10:48:29', '2018-10-16 11:48:41'),
(662, 1, 276, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-12 10:48:29', '2018-10-12 10:48:31'),
(663, 276, 275, 'Your name Arpita Malode has been updated by Parent P', '', '0', '2018-10-12 10:48:29', '2018-10-12 10:48:29'),
(664, 278, 1, 'cokumut cc has successfully registered as a parent', '/admin/users/parent', '1', '2018-10-12 12:54:12', '2018-10-16 11:48:41'),
(665, 278, 1, 'Cokumut Cc has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-12 12:55:13', '2018-10-16 11:48:41'),
(666, 1, 278, 'Your wire transfer request has been sent successfully to admin, Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-12 12:55:13', '2018-10-12 12:58:19'),
(667, 1, 278, 'Your request has been approved by Admin & also invoice is generated for the payment has received for a Plan -1 Year', '/parent/transactions', '1', '2018-10-12 12:57:11', '2018-10-12 12:58:19'),
(668, 255, 1, 'Cececy Cc has updated a student data, Aditya Patil', '/admin/users/student/view/MjU0', '1', '2018-10-15 07:25:00', '2018-10-16 11:48:41'),
(669, 1, 255, 'You have successfully updated a student data, Aditya Patil', 'teacher/my-student/MTY=', '1', '2018-10-15 07:25:00', '2018-10-15 07:25:02'),
(670, 255, 254, 'Your nameAditya Patil has been updated by Cececy Cc', '', '0', '2018-10-15 07:25:00', '2018-10-15 07:25:00'),
(671, 255, 1, 'Cececy Cc has added new student, Harshada uk', '/admin/users/student/view/Mjc5', '1', '2018-10-15 08:36:49', '2018-10-16 11:48:41'),
(672, 1, 255, 'You have successfully added new student, Harshada uk', '/teacher/my-student/MTY=', '1', '2018-10-15 08:36:49', '2018-10-15 08:36:59'),
(673, 255, 279, 'You have successfully added to class :Test new class by Cececy Cc', '', '0', '2018-10-15 08:36:49', '2018-10-15 08:36:49'),
(674, 280, 1, 'vina tttt has successfully registered as a enroll', '/admin/users/teacher', '1', '2018-10-15 08:39:11', '2018-10-16 11:48:41'),
(675, 274, 1, 'Teacher Teacher has added new class', '/admin/classrooms/view/MTk=', '1', '2018-10-15 08:47:58', '2018-10-16 11:48:41'),
(676, 1, 274, 'New Class added successfully', '/teacher/dashboard', '1', '2018-10-15 08:47:58', '2018-10-19 06:01:57'),
(677, 274, 1, 'Teacher Teacher has added new student, Anushka sharma', '/admin/users/student/view/Mjgx', '1', '2018-10-15 08:48:16', '2018-10-16 11:48:41'),
(678, 1, 274, 'You have successfully added new student, Anushka sharma', '/teacher/my-student/MTg=', '1', '2018-10-15 08:48:16', '2018-10-19 06:01:57'),
(679, 274, 281, 'You have successfully added to class :Class orange by Teacher Teacher', '', '0', '2018-10-15 08:48:16', '2018-10-15 08:48:16'),
(680, 274, 281, 'You have transfered from Class orange to Class blackberry', '', '0', '2018-10-15 08:49:37', '2018-10-15 08:49:37'),
(681, 274, 1, 'Teacher Teacher has transfer student, Athrav Patil', '/admin/users/student/view/MjY0', '1', '2018-10-15 08:50:17', '2018-10-16 11:48:41'),
(682, 1, 274, 'You have successfully transfer student, Athrav Patil', '/teacher/my-student/MTk=', '1', '2018-10-15 08:50:17', '2018-10-19 06:01:57'),
(683, 274, 264, 'You have successfully transffered to class :Class blackberry', '', '0', '2018-10-15 08:50:17', '2018-10-15 08:50:17'),
(684, 274, 1, 'Teacher Teacher has added existing student, Aditya Patil', '/admin/users/student/view/MjU0', '1', '2018-10-15 08:50:51', '2018-10-16 11:48:41'),
(685, 1, 274, 'You have successfully added existing student, Aditya Patil', '/teacher/my-student/MTk=', '1', '2018-10-15 08:50:51', '2018-10-19 06:01:57'),
(686, 274, 254, 'You have successfully added to class :Class blackberry by Teacher Teacher', '', '0', '2018-10-15 08:50:51', '2018-10-15 08:50:51'),
(687, 1, 255, 'Entered pin, asda, doesn\'t exists.', '', '1', '2018-10-15 08:52:33', '2018-10-15 09:09:59'),
(688, 1, 255, 'Entered pin, 3534, doesn\'t exists.', '', '1', '2018-10-15 08:52:44', '2018-10-15 09:09:59'),
(689, 255, 1, 'Cececy Cc has added existing student, Athrav Patil', '/admin/users/student/view/MjY0', '1', '2018-10-15 08:52:56', '2018-10-16 11:48:41'),
(690, 1, 255, 'You have successfully added existing student, Athrav Patil', '/teacher/my-student/MTY=', '1', '2018-10-15 08:52:56', '2018-10-15 09:09:59'),
(691, 255, 264, 'You have successfully added to class :Test new class by Cececy Cc', '', '0', '2018-10-15 08:52:56', '2018-10-15 08:52:56'),
(692, 255, 264, 'A new program : Program 1 is assigned to you by Cececy Cc', '/student/program/details', '0', '2018-10-15 09:09:49', '2018-10-15 09:09:49'),
(693, 274, 1, 'Teacher Teacher has added existing student, Kareena Kappor', '/admin/users/student/view/Mjcz', '1', '2018-10-15 09:21:13', '2018-10-16 11:48:41'),
(694, 1, 274, 'You have successfully added existing student, Kareena Kappor', '/teacher/my-student/MTk=', '1', '2018-10-15 09:21:13', '2018-10-19 06:01:57'),
(695, 274, 273, 'You have successfully added to class :Class blackberry by Teacher Teacher', '', '0', '2018-10-15 09:21:13', '2018-10-15 09:21:13'),
(696, 1, 274, 'Kareena Kappor, student already exists in your class.', '/teacher/my-student/MTk=', '1', '2018-10-15 09:21:22', '2018-10-19 06:01:57'),
(697, 274, 273, 'You have successfully added to class :Class blackberry by Teacher Teacher', '', '0', '2018-10-15 09:21:22', '2018-10-15 09:21:22'),
(698, 1, 274, 'Kareena Kappor, student already exists in your class.', '/teacher/my-student/MTk=', '1', '2018-10-15 09:21:22', '2018-10-19 06:01:57'),
(699, 274, 273, 'You have successfully added to class :Class blackberry by Teacher Teacher', '', '0', '2018-10-15 09:21:22', '2018-10-15 09:21:22'),
(700, 1, 274, 'Kareena Kappor, student already exists in your class.', '/teacher/my-student/MTk=', '1', '2018-10-15 09:21:22', '2018-10-19 06:01:57'),
(701, 274, 273, 'You have successfully added to class :Class blackberry by Teacher Teacher', '', '0', '2018-10-15 09:21:23', '2018-10-15 09:21:23'),
(702, 1, 274, 'Kareena Kappor, student already exists in your class.', '/teacher/my-student/MTk=', '1', '2018-10-15 09:21:23', '2018-10-19 06:01:57'),
(703, 274, 273, 'You have successfully added to class :Class blackberry by Teacher Teacher', '', '0', '2018-10-15 09:21:23', '2018-10-15 09:21:23'),
(704, 1, 274, 'Entered pin, 6867, doesn\'t exists.', '', '1', '2018-10-15 09:27:54', '2018-10-19 06:01:57'),
(705, 1, 274, 'Entered pin, , doesn\'t exists.', '', '1', '2018-10-15 09:34:27', '2018-10-19 06:01:57'),
(706, 1, 274, 'Entered pin, , doesn\'t exists.', '', '1', '2018-10-15 09:35:35', '2018-10-19 06:01:57'),
(707, 274, 1, 'Teacher Teacher has removed a student from class, Kareena Kappor', '/admin/users/student', '1', '2018-10-15 09:51:57', '2018-10-16 11:48:41'),
(708, 1, 274, 'You have successfully removed a student from your class, Kareena Kappor', 'teacher/my-student/MTk=', '1', '2018-10-15 09:51:57', '2018-10-19 06:01:57'),
(709, 274, 273, 'You have been removed from class : Class blackberry by Teacher Teacher', '', '0', '2018-10-15 09:51:57', '2018-10-15 09:51:57'),
(710, 274, 1, 'Teacher Teacher has removed a student from class, Aditya Patil', '/admin/users/student', '1', '2018-10-15 09:52:01', '2018-10-16 11:48:41'),
(711, 1, 274, 'You have successfully removed a student from your class, Aditya Patil', 'teacher/my-student/MTk=', '1', '2018-10-15 09:52:01', '2018-10-19 06:01:57'),
(712, 274, 254, 'You have been removed from class : Class blackberry by Teacher Teacher', '', '0', '2018-10-15 09:52:01', '2018-10-15 09:52:01'),
(713, 276, 1, 'Parent P has added new child', '/admin/users/student/view/Mjgy', '1', '2018-10-15 09:55:46', '2018-10-16 11:48:41'),
(714, 1, 276, 'You have added a new child', '/parent/my-kids', '1', '2018-10-15 09:55:46', '2018-10-15 09:56:18'),
(715, 276, 282, 'You have been successfully added by Parent P', '', '1', '2018-10-15 09:55:46', '2018-10-20 05:48:27'),
(716, 276, 1, 'Parent P has updated a child', '/admin/users/student/view/Mjgy', '1', '2018-10-15 09:55:50', '2018-10-16 11:48:41'),
(717, 1, 276, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-15 09:55:50', '2018-10-15 09:56:18'),
(718, 276, 282, 'Your name Nikita More has been updated by Parent P', '', '1', '2018-10-15 09:55:50', '2018-10-20 05:48:27'),
(719, 276, 1, 'Parent P has updated a child', '/admin/users/student/view/Mjgy', '1', '2018-10-15 09:55:59', '2018-10-16 11:48:41'),
(720, 1, 276, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-15 09:55:59', '2018-10-15 09:56:18'),
(722, 1, 276, 'Profile updated successfully', '/parent/account-setting/my-profile', '1', '2018-10-15 11:34:16', '2018-10-15 11:34:34'),
(723, 1, 276, '资料更新成功', '/parent/account-setting/my-profile', '1', '2018-10-15 11:34:27', '2018-10-15 11:34:34'),
(724, 182, 1, 'Rohini J has deleted a child', '/admin/users/student', '1', '2018-10-15 11:42:44', '2018-10-16 11:48:41'),
(725, 1, 182, 'You have successfully deleted your child', '/parent/dashboard', '1', '2018-10-15 11:42:44', '2018-10-15 11:43:55'),
(726, 182, 1, 'Rohini J has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-15 11:43:19', '2018-10-16 11:48:41'),
(727, 1, 182, 'Your wire transfer request has been sent successfully to admin, Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-15 11:43:19', '2018-10-15 11:43:55'),
(728, 1, 182, 'Profile updated successfully', '/parent/account-setting/my-profile', '1', '2018-10-15 11:54:08', '2018-10-16 12:20:43'),
(729, 1, 182, 'Profile updated successfully', '/parent/account-setting/my-profile', '1', '2018-10-15 11:54:12', '2018-10-16 12:20:43'),
(730, 1, 182, 'Profile updated successfully', '/parent/account-setting/my-profile', '1', '2018-10-15 11:54:41', '2018-10-16 12:20:43'),
(731, 1, 182, 'Profile updated successfully', '/parent/account-setting/my-profile', '1', '2018-10-15 11:56:49', '2018-10-16 12:20:43'),
(732, 1, 274, 'Profile updated successfully', '/teacher/account-setting/my-profile', '1', '2018-10-15 12:00:01', '2018-10-19 06:01:57'),
(733, 276, 1, 'Parent P has updated a child', '/admin/users/student/view/Mjgy', '1', '2018-10-15 13:04:25', '2018-10-16 11:48:41'),
(734, 1, 276, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-15 13:04:25', '2018-10-17 05:29:02'),
(736, 0, 1, 'dadsdfsdff dadasd has sent enquiry', '/admin/contact_enquiry/view/Ng==', '1', '2018-10-16 11:47:42', '2018-10-16 11:48:41'),
(737, 1, 276, '10 has been deducted from your incentive amount.', '/parent/dashboard', '1', '2018-10-16 11:50:46', '2018-10-17 05:29:02'),
(738, 182, 1, 'Rohini J has added existing child to his/her account using enrollment code.', '/admin/users/student', '1', '2018-10-16 12:17:22', '2018-10-19 12:53:13'),
(739, 1, 182, 'You have successfully added existing child to your account using enrollment code', '/parent/my-kids', '1', '2018-10-16 12:17:22', '2018-10-16 12:20:43'),
(740, 182, 275, 'You have been successfully added by Rohini J', '', '0', '2018-10-16 12:17:22', '2018-10-16 12:17:22'),
(741, 5, 4, 'Program \"Marathi program\" approved by \"Deepak Salunke\".', '/program-creator/program/view/NA==', '0', '2018-10-16 13:15:35', '2018-10-16 13:15:35'),
(743, 1, 276, 'Profile updated successfully', '/parent/account-setting/my-profile', '1', '2018-10-17 06:18:08', '2018-10-17 09:38:58'),
(746, 1, 255, 'Profile updated successfully', '/teacher/account-setting/my-profile', '0', '2018-10-17 09:41:35', '2018-10-17 09:41:35'),
(747, 1, 255, 'Profile updated successfully', '/teacher/account-setting/my-profile', '0', '2018-10-17 09:41:44', '2018-10-17 09:41:44'),
(748, 0, 1, 'test testjj has sent enquiry', '/admin/contact_enquiry/view/Nw==', '1', '2018-10-17 09:58:47', '2018-10-19 12:53:13'),
(750, 1, 274, 'Profile updated successfully', '/teacher/account-setting/my-profile', '1', '2018-10-19 06:00:43', '2018-10-19 06:01:57'),
(751, 1, 274, 'Profile updated successfully', '/teacher/account-setting/my-profile', '0', '2018-10-19 06:05:10', '2018-10-19 06:05:10'),
(752, 276, 1, 'Parent P has requested for wire transfer payment.', '/admin/wire-transfer', '1', '2018-10-20 04:58:11', '2018-10-20 05:00:55'),
(753, 1, 276, 'Your wire transfer request has been sent successfully to admin, Wait until admin approve your request After only you can access this functionality.', '/pricing', '1', '2018-10-20 04:58:11', '2018-10-20 04:59:15'),
(754, 1, 274, 'Profile updated successfully', '/teacher/account-setting/my-profile', '0', '2018-10-20 05:59:41', '2018-10-20 05:59:41'),
(755, 1, 276, '20 has been deducted from your incentive amount.', '/parent/dashboard', '1', '2018-10-20 07:06:37', '2018-10-20 08:33:23'),
(756, 274, 264, 'You have transfered from Class blackberry to Class orange', '', '0', '2018-10-20 07:18:08', '2018-10-20 07:18:08'),
(757, 274, 265, 'Your child -Athrav Patil has transfered from Class blackberry to Class orange', '', '0', '2018-10-20 07:18:08', '2018-10-20 07:18:08'),
(758, 274, 281, 'You have transfered from Class blackberry to Class orange', '', '0', '2018-10-20 07:18:08', '2018-10-20 07:18:08'),
(759, 274, 281, 'You have transfered from Class orange to Class blackberry', '', '0', '2018-10-20 07:18:50', '2018-10-20 07:18:50'),
(760, 274, 1, 'Teacher Teacher has deleted a class', '/admin/classrooms', '1', '2018-10-20 07:20:30', '2018-10-20 08:51:00'),
(761, 1, 274, 'Class deleted successfully.', '/teacher/dashboard', '0', '2018-10-20 07:20:30', '2018-10-20 07:20:30'),
(762, 274, 1, 'Teacher Teacher has added new class', '/admin/classrooms/view/MjA=', '1', '2018-10-20 07:28:30', '2018-10-20 08:51:00'),
(763, 1, 274, 'New Class added successfully', '/teacher/dashboard', '0', '2018-10-20 07:28:30', '2018-10-20 07:28:30'),
(764, 274, 1, 'Teacher Teacher has added existing student, Nikita More', '/admin/users/student/view/Mjgy', '1', '2018-10-20 07:28:51', '2018-10-20 08:51:00'),
(765, 1, 274, 'You have successfully added existing student, Nikita More', '/teacher/my-student/MjA=', '0', '2018-10-20 07:28:51', '2018-10-20 07:28:51'),
(766, 274, 282, 'You have successfully added to class :Teacher class by Teacher Teacher', '', '1', '2018-10-20 07:28:51', '2018-10-20 07:30:26'),
(767, 274, 282, 'A new program : New PRogram is assigned to you by Teacher Teacher', '/student/program/details', '1', '2018-10-20 07:29:21', '2018-10-20 07:30:26'),
(768, 274, 1, 'Teacher Teacher has deleted a class', '/admin/classrooms', '1', '2018-10-20 07:29:34', '2018-10-20 08:51:00'),
(769, 1, 274, 'Class deleted successfully.', '/teacher/dashboard', '0', '2018-10-20 07:29:34', '2018-10-20 07:29:34'),
(770, 1, 276, 'Profile updated successfully', '/parent/account-setting/my-profile', '1', '2018-10-20 08:58:10', '2018-10-20 08:58:15'),
(771, 1, 276, 'Profile updated successfully', '/parent/account-setting/my-profile', '1', '2018-10-20 09:57:56', '2018-10-20 09:59:44'),
(772, 1, 276, 'Profile updated successfully', '/parent/account-setting/my-profile', '1', '2018-10-20 10:25:48', '2018-10-20 10:26:01'),
(773, 276, 1, 'Parent P has updated a child', '/admin/users/student/view/Mjgy', '1', '2018-10-20 10:34:20', '2018-10-20 10:44:17'),
(774, 1, 276, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-20 10:34:20', '2018-10-20 10:34:29'),
(775, 276, 282, 'Your name Nikita More has been updated by Parent P', '', '0', '2018-10-20 10:34:20', '2018-10-20 10:34:20'),
(776, 286, 1, 'sf dfsdf has successfully registered as a parent', '/admin/users/parent', '1', '2018-10-22 05:26:37', '2018-10-25 09:02:26'),
(777, 1, 182, 'Profile updated successfully', '/parent/account-setting/my-profile', '1', '2018-10-25 07:00:36', '2018-10-25 07:12:35'),
(778, 1, 182, 'Profile updated successfully', '/parent/account-setting/my-profile', '1', '2018-10-25 10:26:26', '2018-10-25 10:26:51'),
(779, 182, 1, 'Rohini J has updated a child', '/admin/users/student/view/MjY3', '1', '2018-10-25 10:26:45', '2018-10-25 11:20:45'),
(780, 1, 182, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-25 10:26:45', '2018-10-25 10:26:51'),
(781, 182, 267, 'Your name Child Two has been updated by Rohini J', '', '0', '2018-10-25 10:26:46', '2018-10-25 10:26:46'),
(782, 182, 1, 'Rohini J has updated a child', '/admin/users/student/view/MjU2', '1', '2018-10-25 10:30:22', '2018-10-25 11:20:45'),
(783, 1, 182, 'You have successfully updated a child', '/parent/my-kids', '1', '2018-10-25 10:30:22', '2018-10-25 10:31:31'),
(784, 182, 256, 'Your name Riddhi J has been updated by Rohini J', '', '0', '2018-10-25 10:30:22', '2018-10-25 10:30:22'),
(785, 1, 182, '资料更新成功', '/parent/account-setting/my-profile', '0', '2018-10-26 08:29:48', '2018-10-26 08:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `points_table`
--

CREATE TABLE `points_table` (
  `id` int(11) NOT NULL,
  `type` enum('score_a','score_b','score_c','score_d') DEFAULT NULL,
  `a+` int(11) NOT NULL,
  `a` int(11) NOT NULL,
  `b+` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `points_table`
--

INSERT INTO `points_table` (`id`, `type`, `a+`, `a`, `b+`, `b`, `c`, `d`, `created_at`, `update_at`, `deleted_at`) VALUES
(1, 'score_a', 70, 50, 40, 30, 20, 0, '2018-08-14 10:27:18', '2018-08-20 06:50:48', NULL),
(2, 'score_b', 25, 20, 15, 15, 10, 5, '2018-08-14 10:27:45', '2018-09-03 11:19:36', NULL),
(3, 'score_c', 20, 15, 10, 10, 10, 5, '2018-08-14 10:28:48', '2018-09-04 09:39:28', NULL),
(4, 'score_d', 20, 15, 10, 10, 10, 5, '2018-08-14 10:29:07', '2018-09-04 09:39:30', NULL);

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
  `is_holiday_program` enum('no','yes') NOT NULL,
  `approve_status` enum('pending','approved','disapproved') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `user_id`, `unique_id`, `name`, `slug`, `description`, `subject`, `grade`, `template_id`, `status`, `is_holiday_program`, `approve_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 161, 'P000001', 'Program 1', 'Program-1', 'Program 1', 1, 1, '1,2', '1', 'yes', 'approved', '2018-09-10 09:00:38', '2018-10-20 05:55:25', NULL),
(2, 4, 'P000002', 'Math Program', 'Math-Program', 'Math Program', 1, 1, '8,12', '1', 'no', 'approved', '2018-09-11 04:04:22', '2018-10-06 09:38:04', NULL),
(3, 4, 'P000003', 'New PRogram', 'New-PRogram', 'New PRogram', 2, 3, '50,40,41,42,49,46,33,35,37,39', '1', 'no', 'approved', '2018-09-14 13:00:30', '2018-10-06 09:38:01', NULL),
(4, 4, 'P000004', 'Marathi program', 'Marathi-program', 'Marathi program', 3, 1, NULL, '1', 'no', 'approved', '2018-10-12 09:51:26', '2018-10-20 06:52:31', NULL);

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
(1, 1, 1, 1, 1, '2018-09-10 09:05:35', '2018-09-10 09:05:35', NULL),
(2, 1, 2, 1, 1, '2018-09-10 09:07:24', '2018-09-10 09:07:24', NULL),
(3, 2, 8, 2, 1, '2018-09-11 04:08:02', '2018-09-11 04:08:02', NULL),
(4, 2, 12, 2, 1, '2018-09-12 09:41:38', '2018-09-12 09:41:38', NULL),
(20, 3, 50, 4, 2, '2018-09-29 09:57:49', '2018-09-29 09:57:49', NULL),
(21, 3, 40, 4, 3, '2018-09-29 10:03:27', '2018-09-29 10:03:27', NULL),
(22, 3, 41, 4, 9, '2018-09-29 10:04:56', '2018-09-29 10:04:56', NULL),
(23, 3, 42, 4, 2, '2018-09-29 10:05:20', '2018-09-29 10:05:20', NULL),
(24, 3, 49, 4, 2, '2018-09-29 10:25:56', '2018-09-29 10:25:56', NULL),
(25, 3, 46, 4, 3, '2018-09-29 10:27:54', '2018-09-29 10:27:54', NULL),
(26, 3, 33, 4, 1, '2018-10-01 06:11:21', '2018-10-01 06:11:21', NULL),
(27, 3, 35, 4, 1, '2018-10-01 06:29:22', '2018-10-01 06:29:22', NULL),
(28, 3, 37, 4, 1, '2018-10-01 06:55:35', '2018-10-01 06:55:35', NULL),
(29, 3, 39, 4, 1, '2018-10-01 06:56:22', '2018-10-01 06:56:22', NULL),
(30, 3, 37, 4, 2, '2018-10-01 10:02:40', '2018-10-01 10:02:40', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `redeem_amount` float(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reference_code`
--

CREATE TABLE `reference_code` (
  `id` int(11) NOT NULL,
  `discount_amount` float NOT NULL,
  `validity_extension` varchar(255) NOT NULL,
  `reward_amount` decimal(12,2) NOT NULL,
  `coupen_type` enum('PARENT','TEACHER') DEFAULT NULL,
  `reference_reward_type` enum('validity_extension','reference_amount','both') NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reference_code`
--

INSERT INTO `reference_code` (`id`, `discount_amount`, `validity_extension`, `reward_amount`, `coupen_type`, `reference_reward_type`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 10, '3', '200.00', 'PARENT', 'validity_extension', '2018-09-27', '2018-10-26', '2018-09-25 04:23:15', '2018-10-25 12:01:05'),
(2, 40, '', '50.00', 'TEACHER', 'reference_amount', '2018-09-25', '2018-10-31', '2018-09-25 04:23:31', '2018-10-11 12:45:14');

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
  `status` enum('active','block') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `share_class`
--

INSERT INTO `share_class` (`id`, `from_teacher_id`, `to_teacher`, `to_teacher_id`, `classroom_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 255, 'teacher@cars2.club', 211, 8, 'active', '2018-10-08 08:50:53', '2018-10-08 08:50:53');

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
  `apple_url` text NOT NULL,
  `google_play_url` text NOT NULL,
  `acrobat_url` text NOT NULL,
  `chrome_url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_status`
--

INSERT INTO `site_status` (`id`, `site_name`, `site_address`, `site_contact_number`, `site_status`, `site_video`, `meta_desc`, `meta_keyword`, `site_email_address`, `fb_url`, `twitter_url`, `google_plus_url`, `linkedin_url`, `youtube_url`, `lat`, `lon`, `apple_url`, `google_play_url`, `acrobat_url`, `chrome_url`, `created_at`, `updated_at`) VALUES
(1, 'Merit Learning', '4th Floor, Bhandari Jewellery, Beside Kalika Mandir, Mumbai Naka, Matoshree Nagar, Nashik, Maharashtra 422001', '01068470073', '1', 'https://www.youtube.com/watch?v=w5N2TN520U8', 'meta description', 'meta keyword', 'demo@webwing.com', 'https://facebook.com', 'https://twitter.com', 'https://gmail.com', 'https://linkedin.com', 'https://youtube.com', '', '', 'https://ios.com', 'https://googleplay.com', 'https://acrobat.com', 'https://chrome.com', '2018-04-13 06:48:30', '2018-10-26 04:09:31');

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
(1, 246, 213, 213, 1, 1, '2018-10-06 08:58:02', '2018-10-06 10:50:06', NULL),
(2, 247, 213, 211, 1, 1, '2018-10-06 11:03:03', '2018-10-06 11:10:42', NULL),
(3, 248, 213, 211, 0, 0, '2018-10-06 11:43:09', '2018-10-06 12:27:18', '2018-10-06 12:27:18'),
(6, 251, 213, 211, 1, 1, '2018-10-06 12:32:25', '2018-10-09 10:21:37', NULL),
(7, 252, 213, 211, 1, 1, '2018-10-06 12:35:43', '2018-10-10 09:50:16', NULL),
(8, 253, 213, 213, 1, 1, '2018-10-08 05:08:55', '2018-10-08 05:08:55', NULL),
(9, 254, 0, 211, 0, 0, '2018-10-08 06:05:16', '2018-10-15 08:50:51', NULL),
(10, 256, 182, 211, 1, 1, '2018-10-09 04:27:02', '2018-10-25 10:30:22', NULL),
(11, 257, 182, 211, 1, 1, '2018-10-09 06:05:13', '2018-10-11 07:25:18', NULL),
(12, 258, 259, 211, 1, 1, '2018-10-10 09:10:03', '2018-10-11 05:43:41', NULL),
(13, 260, 261, 211, 2, 3, '2018-10-11 05:50:41', '2018-10-11 05:53:23', NULL),
(14, 262, 261, 211, 2, 3, '2018-10-11 06:09:20', '2018-10-11 06:11:40', NULL),
(15, 263, 0, 255, 0, 0, '2018-10-11 06:37:35', '2018-10-11 06:37:35', NULL),
(16, 264, 265, 255, 0, 0, '2018-10-11 06:37:50', '2018-10-15 08:52:56', NULL),
(17, 266, 182, 182, 1, 1, '2018-10-11 11:16:45', '2018-10-11 11:16:45', NULL),
(18, 267, 182, 182, 1, 1, '2018-10-11 11:17:00', '2018-10-25 10:26:45', NULL),
(19, 268, 182, 182, 2, 3, '2018-10-11 11:17:18', '2018-10-11 11:17:18', NULL),
(20, 269, 213, 213, 1, 1, '2018-10-11 12:37:59', '2018-10-12 03:56:35', '2018-10-12 03:56:35'),
(21, 270, 213, 213, 1, 1, '2018-10-11 12:38:13', '2018-10-11 12:38:26', '2018-10-11 12:38:26'),
(22, 272, 271, 271, 1, 1, '2018-10-11 13:28:07', '2018-10-11 13:28:07', NULL),
(23, 273, 182, 182, 0, 0, '2018-10-12 05:29:23', '2018-10-15 11:42:44', '2018-10-15 11:42:44'),
(24, 275, 182, 274, 1, 1, '2018-10-12 05:46:54', '2018-10-16 12:17:22', NULL),
(25, 277, 276, 276, 1, 1, '2018-10-12 10:47:11', '2018-10-12 10:47:11', NULL),
(26, 279, 280, 255, 1, 1, '2018-10-15 08:36:49', '2018-10-15 08:39:08', NULL),
(27, 281, 0, 274, 1, 1, '2018-10-15 08:48:16', '2018-10-15 08:48:16', NULL),
(28, 282, 276, 276, 2, 3, '2018-10-15 09:55:46', '2018-10-20 10:34:20', NULL);

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
(2, 266, 1, 182, 'parent', '2018-10-11 11:16:45', '2018-10-11 11:16:45'),
(3, 267, 2, 182, 'parent', '2018-10-11 11:17:00', '2018-10-11 11:17:00'),
(4, 268, 3, 182, 'parent', '2018-10-11 11:17:18', '2018-10-11 11:17:18'),
(5, 252, 1, 213, 'parent', '2018-10-11 11:19:59', '0000-00-00 00:00:00'),
(6, 269, 1, 213, 'parent', '2018-10-11 12:37:59', '2018-10-11 12:37:59'),
(7, 270, 2, 213, 'parent', '2018-10-11 12:38:13', '2018-10-11 12:38:13'),
(8, 256, 2, 211, 'teacher', '2018-10-11 12:49:40', '0000-00-00 00:00:00'),
(9, 272, 1, 271, 'parent', '2018-10-11 13:28:07', '2018-10-11 13:28:07'),
(10, 256, 0, 182, 'parent', '2018-10-12 04:32:59', '2018-10-12 04:32:59'),
(11, 273, 1, 182, 'parent', '2018-10-12 05:29:23', '2018-10-12 05:29:23'),
(12, 275, 1, 276, 'parent', '2018-10-12 05:58:02', '0000-00-00 00:00:00'),
(13, 277, 1, 276, 'parent', '2018-10-12 10:47:11', '2018-10-12 10:47:11'),
(14, 264, 1, 255, 'teacher', '2018-10-15 09:09:49', '0000-00-00 00:00:00'),
(15, 282, 1, 276, 'parent', '2018-10-15 09:55:46', '2018-10-15 09:55:46'),
(16, 275, 0, 182, 'parent', '2018-10-16 12:17:22', '2018-10-16 12:17:22'),
(17, 282, 3, 274, 'teacher', '2018-10-20 07:29:20', '0000-00-00 00:00:00');

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
(3, 1, 1, 1, 1, 266, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:16:45', '2018-10-11 11:16:45', NULL),
(4, 1, 2, 1, 1, 266, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:16:45', '2018-10-11 11:16:45', NULL),
(5, 2, 8, 2, 1, 267, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:00', '2018-10-11 11:17:00', NULL),
(6, 2, 12, 2, 1, 267, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:00', '2018-10-11 11:17:00', NULL),
(7, 3, 50, 4, 2, 268, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:18', '2018-10-11 11:17:18', NULL),
(8, 3, 40, 4, 3, 268, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:18', '2018-10-11 11:17:18', NULL),
(9, 3, 41, 4, 9, 268, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:18', '2018-10-11 11:17:18', NULL),
(10, 3, 42, 4, 2, 268, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:18', '2018-10-11 11:17:18', NULL),
(11, 3, 49, 4, 2, 268, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:18', '2018-10-11 11:17:18', NULL),
(12, 3, 46, 4, 3, 268, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:18', '2018-10-11 11:17:18', NULL),
(13, 3, 33, 4, 1, 268, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:19', '2018-10-11 11:17:19', NULL),
(14, 3, 35, 4, 1, 268, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:19', '2018-10-11 11:17:19', NULL),
(15, 3, 37, 4, 1, 268, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:19', '2018-10-11 11:17:19', NULL),
(16, 3, 39, 4, 1, 268, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:19', '2018-10-11 11:17:19', NULL),
(17, 3, 37, 4, 2, 268, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:17:19', '2018-10-11 11:17:19', NULL),
(18, 1, 1, 1, 1, 252, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:19:59', '2018-10-11 11:19:59', NULL),
(19, 1, 2, 1, 1, 252, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 11:19:59', '2018-10-11 11:19:59', NULL),
(20, 1, 1, 1, 1, 269, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 12:37:59', '2018-10-11 12:37:59', NULL),
(21, 1, 2, 1, 1, 269, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 12:37:59', '2018-10-11 12:37:59', NULL),
(22, 2, 8, 2, 1, 270, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 12:38:13', '2018-10-11 12:38:13', NULL),
(23, 2, 12, 2, 1, 270, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 12:38:13', '2018-10-11 12:38:13', NULL),
(24, 2, 8, 2, 1, 256, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 12:49:40', '2018-10-11 12:49:40', NULL),
(25, 2, 12, 2, 1, 256, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 12:49:40', '2018-10-11 12:49:40', NULL),
(26, 1, 1, 1, 1, 272, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 13:28:07', '2018-10-11 13:28:07', NULL),
(27, 1, 2, 1, 1, 272, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-11 13:28:07', '2018-10-11 13:28:07', NULL),
(28, 1, 1, 1, 1, 273, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-12 05:29:23', '2018-10-12 05:29:23', NULL),
(29, 1, 2, 1, 1, 273, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-12 05:29:23', '2018-10-12 05:29:23', NULL),
(30, 1, 1, 1, 1, 275, '', '00:00:00', 'no', 0, 'yes', NULL, '2018-10-12 05:58:02', '2018-10-12 06:00:50', NULL),
(31, 1, 2, 1, 1, 275, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-12 05:58:02', '2018-10-12 05:58:02', NULL),
(32, 1, 1, 1, 1, 277, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-12 10:47:11', '2018-10-12 10:47:11', NULL),
(33, 1, 2, 1, 1, 277, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-12 10:47:11', '2018-10-12 10:47:11', NULL),
(34, 1, 1, 1, 1, 264, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-15 09:09:49', '2018-10-15 09:09:49', NULL),
(35, 1, 2, 1, 1, 264, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-15 09:09:49', '2018-10-15 09:09:49', NULL),
(36, 1, 1, 1, 1, 282, '', '00:00:00', 'no', 18, 'yes', NULL, '2018-10-15 09:55:46', '2018-10-20 07:30:11', NULL),
(37, 1, 2, 1, 1, 282, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-15 09:55:46', '2018-10-15 09:55:46', NULL),
(38, 3, 50, 4, 2, 282, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-20 07:29:20', '2018-10-20 07:29:20', NULL),
(39, 3, 40, 4, 3, 282, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-20 07:29:20', '2018-10-20 07:29:20', NULL),
(40, 3, 41, 4, 9, 282, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-20 07:29:20', '2018-10-20 07:29:20', NULL),
(41, 3, 42, 4, 2, 282, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-20 07:29:20', '2018-10-20 07:29:20', NULL),
(42, 3, 49, 4, 2, 282, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-20 07:29:20', '2018-10-20 07:29:20', NULL),
(43, 3, 46, 4, 3, 282, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-20 07:29:20', '2018-10-20 07:29:20', NULL),
(44, 3, 33, 4, 1, 282, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-20 07:29:21', '2018-10-20 07:29:21', NULL),
(45, 3, 35, 4, 1, 282, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-20 07:29:21', '2018-10-20 07:29:21', NULL),
(46, 3, 37, 4, 1, 282, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-20 07:29:21', '2018-10-20 07:29:21', NULL),
(47, 3, 39, 4, 1, 282, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-20 07:29:21', '2018-10-20 07:29:21', NULL),
(48, 3, 37, 4, 2, 282, '', '00:00:00', 'no', 0, 'no', NULL, '2018-10-20 07:29:21', '2018-10-20 07:29:21', NULL);

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
(1, 'math', '1', '2018-10-19 12:52:00', '2018-10-19 12:52:00', NULL),
(2, 'english', '1', '2018-08-02 09:25:36', '2018-08-02 03:55:36', NULL),
(3, 'marathi', '1', '2018-08-02 09:25:36', '2018-08-02 03:55:36', NULL),
(4, 'history', '1', '2018-08-02 09:25:36', '2018-08-02 03:55:36', NULL),
(5, 'test', '1', '2018-07-20 06:38:22', '2018-07-20 01:08:22', '2018-07-20 01:08:22'),
(6, 'geography', '1', '2018-09-10 06:54:05', '2018-09-10 06:54:05', NULL);

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
(10, 5, '测试', 'cn', '2018-08-03 06:50:16', '2018-07-20 01:08:22', '2018-07-20 01:08:22'),
(11, 6, 'Geography', 'en', '2018-09-10 06:54:05', '2018-09-10 06:54:05', NULL),
(12, 6, 'Geography', 'cn', '2018-09-10 06:54:05', '2018-09-10 06:54:05', NULL);

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
(1, '1-year', 9125.00, 12775.00, 35.00, 25.00, '1 year', '1', '2018-06-15 03:35:41', '2018-10-16 05:36:45'),
(2, '3-year', 16425.00, 28470.00, 26.00, 15.00, '3 year', '1', '2018-06-15 03:46:48', '2018-10-16 05:37:01'),
(3, '5-year', 21900.00, 34675.00, 19.00, 12.00, '5 year', '1', '2018-06-15 23:54:14', '2018-10-16 05:37:16'),
(4, 'life-time', 29200.00, 43800.00, 12.00, 8.00, 'life time', '1', '2018-06-15 23:54:14', '2018-10-16 05:37:32');

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
(1, 1, 'en', 'One Year', 'Pay once, access for\r\none year', '2018-06-15 03:35:41', '2018-10-16 05:32:26'),
(2, 1, 'cn', '⼀年', '⼀次⽀付⼀年有效', '2018-06-15 03:35:41', '2018-10-16 05:31:28'),
(3, 2, 'en', 'Three Years', 'Pay once, access for\r\nthree years', '2018-06-15 03:46:48', '2018-10-16 05:33:26'),
(4, 2, 'cn', '三年', '⼀次⽀付三年有效', '2018-06-15 03:46:48', '2018-10-16 05:33:50'),
(5, 3, 'en', 'Five Years', 'Pay once, access for\r\nfive years', '2018-06-15 23:54:14', '2018-10-16 05:34:52'),
(6, 3, 'cn', '五年', '⼀次⽀付五年有效', '2018-06-15 23:54:14', '2018-10-16 05:34:52'),
(7, 4, 'en', 'Lifetime', 'Pay once, Unlimited\r\naccess', '2018-06-16 00:53:22', '2018-10-16 05:35:58'),
(8, 4, 'cn', '终⽣会员', '⼀次⽀付终⽣有效', '2018-06-16 00:53:22', '2018-10-16 05:35:58'),
(9, 5, 'en', 'test', 'test', '2018-09-10 07:08:39', '2018-09-10 07:08:39'),
(10, 5, 'cn', 'test', 'test', '2018-09-10 07:08:39', '2018-09-10 07:08:39');

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
(1, 1, 1, 'image', '100920181536570335.png', 'Fill in the blanks', 'HAT', '100920181536570335.mp3', '00:01:01', '1', '2018-09-10 09:05:35', '2018-09-10 09:05:35', NULL);

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
(1, 1, 1, 'image', '100920181536570444.jpg', 'Fill in the blanks', 'DUCk', '1010', '100920181536570444.mp3', '1', '00:03:00', '2018-09-10 09:07:24', '2018-09-10 09:07:24', NULL);

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
(1, 2, 2, 'Lesson2', '1109201815366388821.png', 'duck is in the #BLANK#', 'Water', '1109201815366388822.png', 'That hat is hang on the #BLANK#', 'Stick', '110920181536638882.mp3', '1', '00:02:30', '2018-09-11 04:08:02', '2018-09-11 04:08:02', NULL);

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
  `answer1` varchar(128) NOT NULL,
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

INSERT INTO `template_12` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `answer1`, `question_2_file`, `answer2`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, 'Match the words', '1209201815367452981.png', 'PAIL', '1209201815367452982.png', 'LETTER', '120920181536745298.mp3', '1', '00:00:35', '2018-09-12 09:41:38', '2018-09-12 09:43:17', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `template_30`
--

CREATE TABLE `template_30` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `question_2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `question_3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `question_4` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_4` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `question_5` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_5` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `template_33`
--

CREATE TABLE `template_33` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `digit1_1` double(10,2) DEFAULT NULL,
  `operator1` varchar(128) DEFAULT NULL,
  `digit1_2` double(10,2) DEFAULT NULL,
  `answer1` double(10,2) DEFAULT NULL,
  `digit2_1` double(10,2) NOT NULL,
  `operator2` varchar(128) DEFAULT NULL,
  `digit2_2` double(10,2) DEFAULT NULL,
  `answer2` double(10,2) DEFAULT NULL,
  `digit3_1` double(10,2) DEFAULT NULL,
  `operator3` varchar(128) DEFAULT NULL,
  `digit3_2` double(10,2) DEFAULT NULL,
  `answer3` double(10,2) DEFAULT NULL,
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
  `digit7_1` double(10,2) DEFAULT NULL,
  `operator7` varchar(128) DEFAULT NULL,
  `digit7_2` double(10,2) DEFAULT NULL,
  `answer7` double(10,2) DEFAULT NULL,
  `digit8_1` double(10,2) DEFAULT NULL,
  `operator8` varchar(128) DEFAULT NULL,
  `digit8_2` double(10,2) DEFAULT NULL,
  `answer8` double(10,2) DEFAULT NULL,
  `digit9_1` double(10,2) DEFAULT NULL,
  `operator9` varchar(128) DEFAULT NULL,
  `digit9_2` double(10,2) DEFAULT NULL,
  `answer9` double(10,2) DEFAULT NULL,
  `digit10_1` double(10,2) DEFAULT NULL,
  `operator10` varchar(128) DEFAULT NULL,
  `digit10_2` double(10,2) DEFAULT NULL,
  `answer10` double(10,2) DEFAULT NULL,
  `digit11_1` double(10,2) DEFAULT NULL,
  `operator11` varchar(128) DEFAULT NULL,
  `digit11_2` double(10,2) DEFAULT NULL,
  `answer11` double(10,2) DEFAULT NULL,
  `digit12_1` double(10,2) DEFAULT NULL,
  `operator12` varchar(128) DEFAULT NULL,
  `digit12_2` double(10,2) DEFAULT NULL,
  `answer12` double(10,2) DEFAULT NULL,
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
(1, 3, 4, 'test', 123.00, '+', 13.00, 136.00, 12.00, '/', 6.00, 2.00, NULL, NULL, NULL, NULL, 56.00, '+', 2.00, 58.00, NULL, NULL, NULL, NULL, 299.00, '+', 6.00, 305.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2888.00, '/', 4.00, 722.00, NULL, '1', '00:00:17', '2018-10-01 06:11:21', '2018-10-01 12:19:56', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `template_35`
--

CREATE TABLE `template_35` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1_file` varchar(255) DEFAULT NULL,
  `question_2_file` varchar(255) DEFAULT NULL,
  `question_3_file` varchar(255) DEFAULT NULL,
  `question_4_file` varchar(255) DEFAULT NULL,
  `question_5_file` varchar(255) DEFAULT NULL,
  `digit1_1` double(10,2) DEFAULT NULL,
  `operator1` varchar(128) DEFAULT NULL,
  `digit1_2` double(10,2) DEFAULT NULL,
  `answer1` double(10,2) DEFAULT NULL,
  `answer1Position` varchar(255) DEFAULT NULL COMMENT '0 = Blank',
  `digit2_1` double(10,2) DEFAULT NULL,
  `operator2` varchar(128) DEFAULT NULL,
  `digit2_2` double(10,2) DEFAULT NULL,
  `answer2` double(10,2) DEFAULT NULL,
  `answer2Position` varchar(255) DEFAULT NULL COMMENT '0 = Blank',
  `digit3_1` double(10,2) DEFAULT NULL,
  `operator3` varchar(128) DEFAULT NULL,
  `digit3_2` double(10,2) DEFAULT NULL,
  `answer3` double(10,2) DEFAULT NULL,
  `answer3Position` varchar(255) DEFAULT NULL COMMENT '0 = Blank',
  `digit4_1` double(10,2) DEFAULT NULL,
  `operator4` varchar(128) DEFAULT NULL,
  `digit4_2` double(10,2) DEFAULT NULL,
  `answer4` double(10,2) DEFAULT NULL,
  `answer4Position` varchar(255) DEFAULT NULL COMMENT '0 = Blank',
  `digit5_1` double(10,2) DEFAULT NULL,
  `operator5` varchar(128) DEFAULT NULL,
  `digit5_2` double(10,2) DEFAULT NULL,
  `answer5` double(10,2) DEFAULT NULL,
  `answer5Position` varchar(255) DEFAULT NULL COMMENT '0 = Blank',
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

INSERT INTO `template_35` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_2_file`, `question_3_file`, `question_4_file`, `question_5_file`, `digit1_1`, `operator1`, `digit1_2`, `answer1`, `answer1Position`, `digit2_1`, `operator2`, `digit2_2`, `answer2`, `answer2Position`, `digit3_1`, `operator3`, `digit3_2`, `answer3`, `answer3Position`, `digit4_1`, `operator4`, `digit4_2`, `answer4`, `answer4Position`, `digit5_1`, `operator5`, `digit5_2`, `answer5`, `answer5Position`, `horn`, `status`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 4, 'test template 35', '0110201815383753621.jpg', NULL, NULL, NULL, '0110201815383753625.jpg', 23.00, '+', 24.00, 47.00, '110', 45.00, '-', 20.00, 25.00, '101', NULL, NULL, NULL, NULL, NULL, 67.00, '/', 2.00, 33.50, '011', 3.00, 'x', 4.00, 12.00, '011', NULL, '1', '00:00:30', '2018-10-01 06:29:22', '2018-10-01 12:00:06', NULL);

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
(1, 3, 4, 'test template 37', '0110201815383769341.png', 1.00, '/', 2.00, 0.50, NULL, 12.00, '/', 34.00, 0.35, NULL, NULL, NULL, NULL, NULL, NULL, 89.00, '/', 50.00, 1.78, NULL, '1', '00:00:30', '2018-10-01 06:55:35', '2018-10-01 12:00:42', NULL),
(2, 3, 4, 'sdsadsd', '0110201815383881591.jpg', 56.00, '+', 5.00, 61.00, NULL, NULL, NULL, NULL, NULL, '0110201815383881593.jpg', 5.00, '+', 7.00, 12.00, NULL, NULL, NULL, NULL, NULL, NULL, '1', '00:00:41', '2018-10-01 10:02:39', '2018-10-01 11:54:09', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `template_39`
--

CREATE TABLE `template_39` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `digit1_1` double(10,2) DEFAULT NULL,
  `operator1` varchar(128) DEFAULT NULL,
  `digit1_2` double(10,2) DEFAULT NULL,
  `answer1` double(10,2) DEFAULT NULL,
  `digit2_1` double(10,2) DEFAULT NULL,
  `operator2` varchar(128) DEFAULT NULL,
  `digit2_2` double(10,2) DEFAULT NULL,
  `answer2` double(10,2) DEFAULT NULL,
  `digit3_1` double(10,2) DEFAULT NULL,
  `operator3` varchar(128) DEFAULT NULL,
  `digit3_2` double(10,2) DEFAULT NULL,
  `answer3` double(10,2) DEFAULT NULL,
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
(1, 3, 4, 'test esmplate 39', 23.00, '+', 10.00, 33.00, 45.00, '-', 30.00, 15.00, NULL, NULL, NULL, NULL, 4.00, 'x', 12.00, 48.00, 12.00, 'x', 2.00, 24.00, 78.00, '/', 66.00, 1.18, NULL, '1', '00:00:30', '2018-10-01 06:56:22', '2018-10-01 12:01:09', NULL);

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
(3, 3, 4, 'sdasd', '45', '4', '=', '', '', '', '', '', '', '21', '5', '>', '', '', '', '', '', '', NULL, '1', '00:00:37', '2018-09-29 10:03:27', '2018-10-01 12:06:29', NULL);

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
(9, 3, 4, 'sdasd', '2', '4', '=', '17', '16', '>', '24', '35', '<', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '00:00:30', '2018-09-29 10:04:56', '2018-10-01 12:07:10', NULL);

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
(2, 3, 4, 'test program', '50', '6,3', '', ',', '10/2', '2,7', NULL, NULL, '4', '9,1', '45', '7,78', NULL, '1', '00:00:30', '2018-09-29 10:05:20', '2018-10-01 12:12:10', NULL);

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
(3, 3, 4, 'Answer the following questions', '2909201815382168741.jpg', 'Question 1', 'Answer 1', 'Question 2', 'Answer2', '', '', '', '', '', '', '', '', NULL, '1', '00:00:30', '2018-09-29 10:27:54', '2018-10-01 09:24:26', NULL);

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
(2, 3, 4, 'test', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><msup><mn>2</mn><mn>6</mn></msup></math>+<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><msqrt><mn>4</mn></msqrt></math>', '15', '', '', '56', '1', NULL, '1', '00:00:30', '2018-09-29 10:25:56', '2018-10-01 09:17:56', NULL);

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
(2, 3, 4, 'How much time has been passed between two clock?', '15:27:00', '18:27:00', '2', '1', '', '', '2', NULL, '1', '00:00:30', '2018-09-29 09:57:49', '2018-10-01 04:21:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_1`
--

CREATE TABLE `template_preview_1` (
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
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_preview_1`
--

INSERT INTO `template_preview_1` (`id`, `program_id`, `lesson_id`, `file_type`, `file`, `question`, `question_text`, `horn`, `duration`, `status`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'image', '100920181536570355432.png', 'Fill in the blanks', 'HAT', '100920181536570355469.mp3', '00:00:02', '1', 161, '2018-09-10 09:05:55', '2018-09-10 09:05:55', NULL),
(2, 1, NULL, 'image', '100920181536570499284.png', 'Fill in the blanks', 'HAT', '100920181536570499920.mp3', '00:00:02', '1', 1, '2018-09-10 09:08:19', '2018-09-10 09:08:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_2`
--

CREATE TABLE `template_preview_2` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_preview_2`
--

INSERT INTO `template_preview_2` (`id`, `program_id`, `lesson_id`, `file_type`, `file`, `question`, `question_text`, `answer_position`, `horn`, `status`, `created_by`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, NULL, 'image', '100920181536574692860.jpg', 'Fill in the blanks', 'DUCk', '1010', '100920181536574692105.mp3', '1', 161, '00:00:00', '2018-09-10 10:18:12', '2018-09-10 10:18:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_3`
--

CREATE TABLE `template_preview_3` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_4`
--

CREATE TABLE `template_preview_4` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_5`
--

CREATE TABLE `template_preview_5` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_6`
--

CREATE TABLE `template_preview_6` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_7`
--

CREATE TABLE `template_preview_7` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_8`
--

CREATE TABLE `template_preview_8` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_9`
--

CREATE TABLE `template_preview_9` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_10`
--

CREATE TABLE `template_preview_10` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_11`
--

CREATE TABLE `template_preview_11` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_12`
--

CREATE TABLE `template_preview_12` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'direction',
  `question_1_file` varchar(255) NOT NULL,
  `answer1` varchar(128) NOT NULL,
  `question_2_file` varchar(255) NOT NULL,
  `answer2` varchar(128) CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_preview_12`
--

INSERT INTO `template_preview_12` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `answer1`, `question_2_file`, `answer2`, `horn`, `status`, `created_by`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(32, NULL, NULL, 'Match the words', '120920181536747084351.png', 'PAIL', '120920181536747084965.png', 'LETTER', '120920181536747084716.mp3', '1', 0, '00:00:00', '2018-09-12 10:11:24', '2018-09-12 10:11:24', NULL),
(33, NULL, NULL, 'Match the words', '120920181536747288609.png', 'PAIL', '120920181536747288717.png', 'LETTER', '120920181536747288420.mp3', '1', 0, '00:00:00', '2018-09-12 10:14:48', '2018-09-12 10:14:48', NULL),
(39, 2, NULL, 'Asdasd', '1209201815367475241.png', 'asd', '1209201815367475242.png', '123123', '120920181536747524.mp3', '1', 4, '00:00:30', '2018-09-12 10:18:44', '2018-09-12 10:18:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_13`
--

CREATE TABLE `template_preview_13` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_14`
--

CREATE TABLE `template_preview_14` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_15`
--

CREATE TABLE `template_preview_15` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_16`
--

CREATE TABLE `template_preview_16` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_17`
--

CREATE TABLE `template_preview_17` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_18`
--

CREATE TABLE `template_preview_18` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_19`
--

CREATE TABLE `template_preview_19` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_20`
--

CREATE TABLE `template_preview_20` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_21`
--

CREATE TABLE `template_preview_21` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_22`
--

CREATE TABLE `template_preview_22` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_23`
--

CREATE TABLE `template_preview_23` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` text CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_24`
--

CREATE TABLE `template_preview_24` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_25`
--

CREATE TABLE `template_preview_25` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` text CHARACTER SET utf8 NOT NULL,
  `question_1_file` varchar(255) NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_26`
--

CREATE TABLE `template_preview_26` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_27`
--

CREATE TABLE `template_preview_27` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_28`
--

CREATE TABLE `template_preview_28` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_29`
--

CREATE TABLE `template_preview_29` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_30`
--

CREATE TABLE `template_preview_30` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `question_2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `question_3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `question_4` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_4` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `question_5` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `answer_5` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_31`
--

CREATE TABLE `template_preview_31` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` text CHARACTER SET utf8 NOT NULL,
  `answer` text CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_32`
--

CREATE TABLE `template_preview_32` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` text CHARACTER SET utf8 NOT NULL,
  `answer` text CHARACTER SET utf8 NOT NULL,
  `horn` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_33`
--

CREATE TABLE `template_preview_33` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `digit1_1` double(10,2) DEFAULT NULL,
  `operator1` varchar(128) DEFAULT NULL,
  `digit1_2` double(10,2) DEFAULT NULL,
  `answer1` double(10,2) DEFAULT NULL,
  `digit2_1` double(10,2) NOT NULL,
  `operator2` varchar(128) DEFAULT NULL,
  `digit2_2` double(10,2) DEFAULT NULL,
  `answer2` double(10,2) DEFAULT NULL,
  `digit3_1` double(10,2) DEFAULT NULL,
  `operator3` varchar(128) DEFAULT NULL,
  `digit3_2` double(10,2) DEFAULT NULL,
  `answer3` double(10,2) DEFAULT NULL,
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
  `digit7_1` double(10,2) DEFAULT NULL,
  `operator7` varchar(128) DEFAULT NULL,
  `digit7_2` double(10,2) DEFAULT NULL,
  `answer7` double(10,2) DEFAULT NULL,
  `digit8_1` double(10,2) DEFAULT NULL,
  `operator8` varchar(128) DEFAULT NULL,
  `digit8_2` double(10,2) DEFAULT NULL,
  `answer8` double(10,2) DEFAULT NULL,
  `digit9_1` double(10,2) DEFAULT NULL,
  `operator9` varchar(128) DEFAULT NULL,
  `digit9_2` double(10,2) DEFAULT NULL,
  `answer9` double(10,2) DEFAULT NULL,
  `digit10_1` double(10,2) DEFAULT NULL,
  `operator10` varchar(128) DEFAULT NULL,
  `digit10_2` double(10,2) DEFAULT NULL,
  `answer10` double(10,2) DEFAULT NULL,
  `digit11_1` double(10,2) DEFAULT NULL,
  `operator11` varchar(128) DEFAULT NULL,
  `digit11_2` double(10,2) DEFAULT NULL,
  `answer11` double(10,2) DEFAULT NULL,
  `digit12_1` double(10,2) DEFAULT NULL,
  `operator12` varchar(128) DEFAULT NULL,
  `digit12_2` double(10,2) DEFAULT NULL,
  `answer12` double(10,2) DEFAULT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_preview_33`
--

INSERT INTO `template_preview_33` (`id`, `program_id`, `lesson_id`, `question`, `digit1_1`, `operator1`, `digit1_2`, `answer1`, `digit2_1`, `operator2`, `digit2_2`, `answer2`, `digit3_1`, `operator3`, `digit3_2`, `answer3`, `digit4_1`, `operator4`, `digit4_2`, `answer4`, `digit5_1`, `operator5`, `digit5_2`, `answer5`, `digit6_1`, `operator6`, `digit6_2`, `answer6`, `digit7_1`, `operator7`, `digit7_2`, `answer7`, `digit8_1`, `operator8`, `digit8_2`, `answer8`, `digit9_1`, `operator9`, `digit9_2`, `answer9`, `digit10_1`, `operator10`, `digit10_2`, `answer10`, `digit11_1`, `operator11`, `digit11_2`, `answer11`, `digit12_1`, `operator12`, `digit12_2`, `answer12`, `horn`, `status`, `created_by`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 3, NULL, 'test', 123.00, '+', 13.00, 136.00, 12.00, '/', 6.00, 2.00, NULL, NULL, NULL, NULL, 56.00, '+', 2.00, 58.00, NULL, NULL, NULL, NULL, 299.00, '+', 6.00, 305.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2888.00, '/', 4.00, 722.00, NULL, '1', 1, '00:00:17', '2018-10-01 12:41:34', '2018-10-01 12:41:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_34`
--

CREATE TABLE `template_preview_34` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_35`
--

CREATE TABLE `template_preview_35` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1_file` varchar(255) DEFAULT NULL,
  `question_2_file` varchar(255) DEFAULT NULL,
  `question_3_file` varchar(255) DEFAULT NULL,
  `question_4_file` varchar(255) DEFAULT NULL,
  `question_5_file` varchar(255) DEFAULT NULL,
  `digit1_1` double(10,2) DEFAULT NULL,
  `operator1` varchar(128) DEFAULT NULL,
  `digit1_2` double(10,2) DEFAULT NULL,
  `answer1` double(10,2) DEFAULT NULL,
  `answer1Position` varchar(255) DEFAULT NULL COMMENT '0 = Blank',
  `digit2_1` double(10,2) DEFAULT NULL,
  `operator2` varchar(128) DEFAULT NULL,
  `digit2_2` double(10,2) DEFAULT NULL,
  `answer2` double(10,2) DEFAULT NULL,
  `answer2Position` varchar(255) DEFAULT NULL COMMENT '0 = Blank',
  `digit3_1` double(10,2) DEFAULT NULL,
  `operator3` varchar(128) DEFAULT NULL,
  `digit3_2` double(10,2) DEFAULT NULL,
  `answer3` double(10,2) DEFAULT NULL,
  `answer3Position` varchar(255) DEFAULT NULL COMMENT '0 = Blank',
  `digit4_1` double(10,2) DEFAULT NULL,
  `operator4` varchar(128) DEFAULT NULL,
  `digit4_2` double(10,2) DEFAULT NULL,
  `answer4` double(10,2) DEFAULT NULL,
  `answer4Position` varchar(255) DEFAULT NULL COMMENT '0 = Blank',
  `digit5_1` double(10,2) DEFAULT NULL,
  `operator5` varchar(128) DEFAULT NULL,
  `digit5_2` double(10,2) DEFAULT NULL,
  `answer5` double(10,2) DEFAULT NULL,
  `answer5Position` varchar(255) DEFAULT NULL COMMENT '0 = Blank',
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_preview_35`
--

INSERT INTO `template_preview_35` (`id`, `program_id`, `lesson_id`, `question`, `question_1_file`, `question_2_file`, `question_3_file`, `question_4_file`, `question_5_file`, `digit1_1`, `operator1`, `digit1_2`, `answer1`, `answer1Position`, `digit2_1`, `operator2`, `digit2_2`, `answer2`, `answer2Position`, `digit3_1`, `operator3`, `digit3_2`, `answer3`, `answer3Position`, `digit4_1`, `operator4`, `digit4_2`, `answer4`, `answer4Position`, `digit5_1`, `operator5`, `digit5_2`, `answer5`, `answer5Position`, `horn`, `status`, `created_by`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 3, NULL, 'test template 35', '011020181538397528274.jpg', NULL, NULL, NULL, '011020181538397528599.jpg', 23.00, '+', 24.00, 47.00, '110', 45.00, '-', 20.00, 25.00, '101', NULL, NULL, NULL, NULL, NULL, 67.00, '/', 2.00, 33.50, '011', 3.00, 'x', 4.00, 12.00, '011', NULL, '1', 4, '00:00:30', '2018-10-01 12:38:48', '2018-10-01 12:38:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_36`
--

CREATE TABLE `template_preview_36` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1_file` varchar(255) NOT NULL,
  `question_2_file` varchar(255) DEFAULT NULL COMMENT 'Optional',
  `answer` double(10,2) NOT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_37`
--

CREATE TABLE `template_preview_37` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_38`
--

CREATE TABLE `template_preview_38` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_39`
--

CREATE TABLE `template_preview_39` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `digit1_1` double(10,2) DEFAULT NULL,
  `operator1` varchar(128) DEFAULT NULL,
  `digit1_2` double(10,2) DEFAULT NULL,
  `answer1` double(10,2) DEFAULT NULL,
  `digit2_1` double(10,2) DEFAULT NULL,
  `operator2` varchar(128) DEFAULT NULL,
  `digit2_2` double(10,2) DEFAULT NULL,
  `answer2` double(10,2) DEFAULT NULL,
  `digit3_1` double(10,2) DEFAULT NULL,
  `operator3` varchar(128) DEFAULT NULL,
  `digit3_2` double(10,2) DEFAULT NULL,
  `answer3` double(10,2) DEFAULT NULL,
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_preview_39`
--

INSERT INTO `template_preview_39` (`id`, `program_id`, `lesson_id`, `question`, `digit1_1`, `operator1`, `digit1_2`, `answer1`, `digit2_1`, `operator2`, `digit2_2`, `answer2`, `digit3_1`, `operator3`, `digit3_2`, `answer3`, `digit4_1`, `operator4`, `digit4_2`, `answer4`, `digit5_1`, `operator5`, `digit5_2`, `answer5`, `digit6_1`, `operator6`, `digit6_2`, `answer6`, `horn`, `status`, `created_by`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 3, NULL, 'test esmplate 39', 23.00, '+', 10.00, 33.00, 45.00, '-', 30.00, 15.00, NULL, NULL, NULL, NULL, 4.00, 'x', 12.00, 48.00, 12.00, 'x', 2.00, 24.00, 78.00, '/', 66.00, 1.18, NULL, '1', 1, '00:00:00', '2018-10-01 12:41:02', '2018-10-01 12:41:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_40`
--

CREATE TABLE `template_preview_40` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_preview_40`
--

INSERT INTO `template_preview_40` (`id`, `program_id`, `lesson_id`, `question`, `question1_1`, `question1_2`, `answer_1`, `question2_1`, `question2_2`, `answer_2`, `question3_1`, `question3_2`, `answer_3`, `question4_1`, `question4_2`, `answer_4`, `question5_1`, `question5_2`, `answer_5`, `question6_1`, `question6_2`, `answer_6`, `horn`, `status`, `created_by`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 3, NULL, 'sdasd', '45', '4', '=', '', '', '', '22', '20', '>', '21', '5', '>', '', '', '', '', '', '', NULL, '1', 4, '00:00:40', '2018-10-01 12:36:16', '2018-10-01 12:36:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_41`
--

CREATE TABLE `template_preview_41` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_preview_41`
--

INSERT INTO `template_preview_41` (`id`, `program_id`, `lesson_id`, `question`, `question1_1`, `question1_2`, `answer_1`, `question2_1`, `question2_2`, `answer_2`, `question3_1`, `question3_2`, `answer_3`, `question4_1`, `question4_2`, `answer_4`, `question5_1`, `question5_2`, `answer_5`, `question6_1`, `question6_2`, `answer_6`, `horn`, `status`, `created_by`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(23, 3, NULL, 'sdasd', '2', '4', '=', '17', '16', '>', '24', '35', '<', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 4, '00:00:35', '2018-10-01 12:39:26', '2018-10-01 12:39:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_42`
--

CREATE TABLE `template_preview_42` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question1` longtext CHARACTER SET utf8 NOT NULL,
  `answer1` longtext CHARACTER SET latin1 NOT NULL,
  `question2` longtext CHARACTER SET utf8 NOT NULL,
  `answer2` longtext CHARACTER SET latin1 NOT NULL,
  `question3` longtext CHARACTER SET utf8 NOT NULL,
  `answer3` longtext CHARACTER SET latin1 NOT NULL,
  `question4` longtext CHARACTER SET utf8,
  `answer4` longtext CHARACTER SET latin1,
  `question5` longtext CHARACTER SET utf8,
  `answer5` longtext CHARACTER SET latin1,
  `question6` longtext CHARACTER SET utf8,
  `answer6` longtext CHARACTER SET latin1,
  `horn` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET latin1 NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_43`
--

CREATE TABLE `template_preview_43` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_44`
--

CREATE TABLE `template_preview_44` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_45`
--

CREATE TABLE `template_preview_45` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_46`
--

CREATE TABLE `template_preview_46` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_preview_46`
--

INSERT INTO `template_preview_46` (`id`, `program_id`, `lesson_id`, `question`, `question_file`, `question_1`, `answer_1`, `question_2`, `answer_2`, `question_3`, `answer_3`, `question_4`, `answer_4`, `question_5`, `answer_5`, `question_6`, `answer_6`, `horn`, `status`, `created_by`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 3, NULL, 'Answer the following questions', '011020181538397707345.jpg', 'Question 1', 'Answer 1', 'Question 2', 'Answer2', '', '', '', '', 'sdfds', 'fsdff', '', '', NULL, '1', 1, '00:00:30', '2018-10-01 12:41:47', '2018-10-01 12:41:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_47`
--

CREATE TABLE `template_preview_47` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_text` text NOT NULL,
  `answer` text NOT NULL COMMENT '0 = Blank',
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_48`
--

CREATE TABLE `template_preview_48` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Description',
  `question_1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer_position` varchar(255) NOT NULL COMMENT '0 = Blank',
  `horn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_49`
--

CREATE TABLE `template_preview_49` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_preview_49`
--

INSERT INTO `template_preview_49` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `horn`, `status`, `created_by`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 3, NULL, 'test', '<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><msup><mn>2</mn><mn>6</mn></msup></math>+<math xmlns=\"http://www.w3.org/1998/Math/MathML\"><msqrt><mn>4</mn></msqrt></math>', '15', '', '3333', '56', '3', NULL, '1', 1, '00:00:30', '2018-10-01 12:42:04', '2018-10-01 12:42:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_preview_50`
--

CREATE TABLE `template_preview_50` (
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
  `created_by` int(11) NOT NULL,
  `duration` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_preview_50`
--

INSERT INTO `template_preview_50` (`id`, `program_id`, `lesson_id`, `question`, `question_1`, `question_2`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `horn`, `status`, `created_by`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 3, NULL, 'How much time has been passed between two clock?', '15:27:00', '18:27:00', '2', '1', '', '', '2', NULL, '1', 1, '00:00:30', '2018-10-01 12:46:46', '2018-10-01 12:46:46', NULL);

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
(2, 'a790ded79297ac7167ccd819ef880c24149bb7ae.jpg', '1', '2018-09-10 07:15:05', '2018-09-10 07:15:05');

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
(3, 2, 'en', 'Test testimonials', '<p>test testimonials</p>', '2018-09-10 07:15:05', '2018-09-10 07:15:05'),
(4, 2, 'cn', 'Http://192.168.1.3/elearning/admin/testimonials/', '<p>http://192.168.1.3/elearning/admin/testimonials/</p>', '2018-09-10 07:15:05', '2018-09-10 07:15:05');

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
(9, 0, 0, 'Simple Math', 'simple-math', 1, 1, '1', '2018-09-10 08:58:03', '2018-10-20 10:46:01'),
(11, 2, 2, 'MEW1', 'mew1', 1, 1, '1', '2018-09-14 12:57:09', '2018-09-14 12:57:09'),
(14, 0, 0, 'English grammer', 'english-grammer', 2, 2, '1', '2018-10-20 06:03:49', '2018-10-20 06:03:49');

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
(4, 11, '15369298295b9bb025cd97d.jpg', '2018-09-14 12:57:09', '2018-09-14 12:57:09'),
(6, 14, '15400154295bcac545f39ab.pdf', '2018-10-20 06:03:50', '2018-10-20 06:03:50');

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
  `uniq_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_usage_id` int(11) NOT NULL,
  `wire_transfer_id` int(11) DEFAULT NULL,
  `amount` float NOT NULL COMMENT 'actual plan amount in CNY',
  `payment_note` text,
  `per_unit_conversion_rate` float NOT NULL,
  `total_price_cny_amount` float NOT NULL,
  `total_converted_amount` float NOT NULL COMMENT 'converted in USD courency ',
  `child_limit` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `extension_date` datetime DEFAULT NULL,
  `from_currency` int(11) NOT NULL,
  `to_currency` int(11) NOT NULL,
  `payment_via` varchar(200) NOT NULL COMMENT 'payment gateway',
  `payment_status` enum('unpaid','paid','pending') DEFAULT NULL,
  `status` enum('active','expired') NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `uniq_id`, `user_id`, `plan_id`, `coupon_id`, `coupon_usage_id`, `wire_transfer_id`, `amount`, `payment_note`, `per_unit_conversion_rate`, `total_price_cny_amount`, `total_converted_amount`, `child_limit`, `transaction_date`, `expiry_date`, `extension_date`, `from_currency`, `to_currency`, `payment_via`, `payment_status`, `status`, `invoice`, `created_at`, `updated_at`) VALUES
(1, 'PAY-2TC08289HF955252KLPAEJUQ', '', 276, 1, 0, 0, 0, 100, '', 0.146017, 100, 14.6017, 0, '2018-10-12', '2019-10-12', '2019-10-12 00:00:00', 2, 1, 'paypal', 'paid', 'expired', 'Invoice_T1.pdf', '2018-10-12 06:54:03', '2018-10-20 05:02:51'),
(2, 'EL-2018-3e51c63e2dded065', '', 276, 3, 0, 0, 1, 200, '', 0.146017, 200, 29.2034, 0, '2018-10-12', '2024-10-12', '2025-02-12 00:00:00', 2, 1, 'offline', 'paid', 'expired', 'Invoice_T2.pdf', '2018-10-12 06:54:56', '2018-10-20 05:02:51'),
(3, 'EL-2018-a26491f146ee533c', '', 278, 1, 0, 0, 2, 100, '', 0.146017, 100, 14.6017, 0, '2018-10-12', '2019-10-12', '2019-10-12 00:00:00', 2, 1, 'offline', 'paid', 'active', 'Invoice_T3.pdf', '2018-10-12 12:55:13', '2018-10-12 12:57:11'),
(4, 'PAY-9W240316NW016741WLPCHZHI', '', 182, 1, 7, 0, 0, 100, '', 0, 30, 4.381, 0, '2018-10-15', '2019-10-15', '2019-10-15 00:00:00', 2, 1, 'paypal', 'paid', 'active', 'Invoice_T4.pdf', '2018-10-15 11:41:16', '2018-10-15 11:41:16'),
(5, 'EL-2018-39614b3246071a4f', '', 182, 3, 0, 0, 3, 200, '', 0.146017, 200, 29.2034, 0, '2018-10-15', '2024-10-15', '2024-10-15 00:00:00', 2, 1, 'offline', 'unpaid', 'active', 'Invoice_T5bd031d3aec6c.pdf', '2018-10-15 11:43:19', '2018-10-24 09:21:10'),
(6, 'PAY-7LV0748305995631ELPE5X6Y', '', 276, 1, 6, 0, 0, 9125, '', 0, 9085, 1, 0, '2018-10-19', '2025-10-12', '2026-02-12 00:00:00', 2, 1, 'paypal', 'paid', 'expired', 'Invoice_T6.pdf', '2018-10-19 13:29:03', '2018-10-20 05:02:51'),
(7, 'PAY-9BV54917P4565300ALPE52BQ', '', 276, 2, 6, 0, 0, 16425, '', 0, 16385, 2392.49, 0, '2018-10-19', '2028-10-12', '2029-02-12 00:00:00', 2, 1, 'paypal', 'paid', 'expired', 'Invoice_T7.pdf', '2018-10-19 13:33:20', '2018-10-20 05:02:51'),
(9, 'PAY-0DY42184J0741445SLPFLNJQ', '', 276, 2, 0, 0, 0, 16425, '', 0.146017, 16425, 2398.33, 0, '2018-10-20', '2032-10-12', '2033-02-12 00:00:00', 2, 1, 'paypal', 'paid', 'expired', 'Invoice_T9.pdf', '2018-10-20 05:01:54', '2018-10-20 05:02:51'),
(10, 'PAY-73865842C4421912WLPFLNZI', '', 276, 1, 9, 0, 0, 9125, '', 0, 9085, 1326.56, 0, '2018-10-20', '2033-10-12', '2034-02-12 00:00:00', 2, 1, 'paypal', 'paid', 'active', 'Invoice_T10.pdf', '2018-10-20 05:02:51', '2018-10-20 05:02:51'),
(26, '5bd2b71b5c435', '5bd2b71b5c435', 16, 1, 0, 0, 0, 9125, '', 0.146017, 9125, 1332.41, 0, '2018-10-26', '2027-10-24', '2027-10-24 00:00:00', 2, 1, 'wechat', 'paid', 'expired', '', '2018-10-26 06:41:33', '2018-10-26 06:43:43'),
(27, 'WE-5bd2b79b550ba', '5bd2b79b550ba', 16, 1, 0, 0, 0, 9125, '', 0.146017, 9125, 1332.41, 0, '2018-10-26', '2028-10-24', '2028-10-24 00:00:00', 2, 2, 'wechat', 'paid', 'active', 'Invoice_T27.pdf', '2018-10-26 06:43:43', '2018-10-26 06:44:57');

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
  `social_via` enum('facebook','twitter','linkedin','wechat') NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `fax_number` varchar(50) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `reference_user_id` int(11) DEFAULT NULL,
  `reference_code` varchar(255) DEFAULT NULL,
  `insentive_amount` float DEFAULT NULL COMMENT 'CNY amount',
  `total_incentive_amount` float(10,2) DEFAULT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `post_code` varchar(200) DEFAULT NULL,
  `phone_code` int(11) DEFAULT NULL,
  `lat` varchar(200) DEFAULT NULL,
  `lang` varchar(200) DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `enrollment_code` text,
  `permissions` text,
  `preferred_language` varchar(10) DEFAULT NULL,
  `a_points` int(11) NOT NULL DEFAULT '0',
  `b_points` int(11) NOT NULL DEFAULT '0',
  `c_points` int(11) NOT NULL DEFAULT '0',
  `d_points` int(11) NOT NULL DEFAULT '0',
  `total_points` int(11) NOT NULL DEFAULT '0',
  `reporting_to` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `first_name`, `last_name`, `user_name`, `email`, `password`, `password_reset_code`, `is_active_membership`, `is_verify`, `is_mobile_verify`, `is_active`, `is_social`, `social_via`, `contact`, `fax_number`, `gender`, `remember_token`, `reference_user_id`, `reference_code`, `insentive_amount`, `total_incentive_amount`, `profile_image`, `address`, `city`, `state`, `country`, `post_code`, `phone_code`, `lat`, `lang`, `pin`, `enrollment_code`, `permissions`, `preferred_language`, `a_points`, `b_points`, `c_points`, `d_points`, `total_points`, `reporting_to`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'Admin', 'Webwing', 'admin', 'admin@webwing.com', '$2y$10$j8FszFlknVlJq4wBkbScxOokJ8PXA12wNGlMm0AV5BcCsbfEtGbhK', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '9041323444', '67757', 'female', 'mGHujMVBvvRsBUMH9IWOqx64CfjgAwKrm5D024XipOk74Pra03OABwgveABW', 0, '', 80, 80.00, '047fd29d207691b586c4fbe7357fd98fef1f21f7.jpeg', 'Indiranagar, Bengaluru, Karnataka, India', '', '', '', '', 83, '', '', '4450', 'EuBpOv8aSHeMzJL', '', NULL, 0, 0, 0, 0, 0, 0, '2018-04-11 18:30:00', '2018-10-26 07:28:23', NULL),
(4, 'program-creator', 'Smita', 'Joshi', 'creator', 'creator@webwing.com', '$2y$10$Gpg.CtHk1thQ1gWBnCx5JOoz9ZKTIK/99cu7IVIlulkddYGZ0pugq', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '78946512', '45454544545', 'male', 'BS5SJivEdlEWowGuDl1vB8IhLelxR5WbdDpsRI5APBK43BZBEgpKjphN0rGb', 0, '', 0, 0.00, NULL, 'NSW, Australia', NULL, NULL, NULL, NULL, 6, NULL, NULL, '', 'LlF9QucZK2MSrb0', '{\"account_setting\\/password\\/change.list\":\"true\",\"account_setting\\/password\\/change.update\":\"true\",\"account_setting\\/edit_profile.list\":\"true\",\"account_setting\\/edit_profile.update\":\"true\"}', NULL, 0, 0, 0, 0, 0, 0, '2017-11-01 06:35:17', '2018-10-22 05:14:33', '2018-10-22 05:14:33'),
(5, 'supervisor', 'Deepak', 'Salunke', 'supervisor', 'supervisor@webwing.com', '$2y$10$3RcdGW9.HEosi8j2XdRJquDP7OxVQPf81M6jaZDR4AFB8sWipYax6', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '857888000', NULL, 'male', 'aufPhNQVF98z5ikoJlGNprZuqMIqnkfSkZfsTiMnLR8wchwLEM7Yde9hbh4Y', 0, '', 0, 0.00, '9a02ce55018ddbbac862f0ebd40eae86d1fedbd9.jpg', 'SDSU Transit Center, San Diego, CA, USA', NULL, NULL, NULL, NULL, 18, NULL, NULL, '', 'RZaiWIJqcs9yuAK', '{\"account_setting\\/password\\/change.list\":\"true\",\"account_setting\\/password\\/change.update\":\"true\",\"account_setting\\/edit_profile.list\":\"true\",\"account_setting\\/edit_profile.update\":\"true\"}', NULL, 0, 0, 0, 0, 0, 0, '2018-06-16 06:44:52', '2018-10-17 09:26:24', '2018-10-17 09:26:24'),
(16, 'parent', 'Parent', 'D', NULL, 'parent@webwing.com', '$2y$10$3RcdGW9.HEosi8j2XdRJquDP7OxVQPf81M6jaZDR4AFB8sWipYax6', '', 'yes', 'yes', 'yes', 'active', 'no', 'facebook', '7896352410', NULL, 'male', 'aR8pmZzJHw42EKNMYt2zeMkGueZXF3MLyzvXXOEOwp1l62XgcaaDw2KsL0ro', 0, '', 0, 0.00, 'ed9d16ea9b59709bf59d64ddd594e860e5e3d871.jpg', 'Avenida Rivadavia 3454, Buenos Aires, Argentina', NULL, NULL, NULL, NULL, 0, NULL, NULL, '9522', '6ZpEkYhmJl2r7O9', '', 'en', 0, 0, 0, 0, 0, 0, '2017-10-18 04:29:39', '2018-10-23 12:25:05', NULL),
(182, 'parent', 'Rohini', 'J', NULL, 'webwingt@gmail.com', '$2y$10$Udg01cyuN8ctfxyKFOeZkOKIktF1hY5fh7H06QImNB2PcOe/qw9xa', NULL, 'yes', 'yes', 'yes', 'active', 'no', 'facebook', '456456456', NULL, 'female', 'uTKFdkICZhZ46n8EhY2qc0Zp46GtRWOA9YpO9eFTfgxvgRZtUbNoFn2PMobw', 0, '', 0, 0.00, 'f81a632d5a1935d86a99e3b6a9571118a1aa5972.jpg', 'Nashik Road, Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, 81, NULL, NULL, '6098', '', NULL, 'en', 0, 0, 0, 0, 0, 0, '2018-09-20 13:20:28', '2018-10-26 08:29:52', NULL),
(184, 'supervisor', 'Anushka', 'Shrma', NULL, 'adolf.rebelo@gmail.com', '$2y$10$Udg01cyuN8ctfxyKFOeZkOKIktF1hY5fh7H06QImNB2PcOe/qw9xa', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '89234234', NULL, NULL, 'DohmeiCJWepbiB6jtKte4HamhxK4aHRXAzy5RP54AYuM8M4lXneerhhRGc0T', 0, '', 0, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1742', '', NULL, NULL, 0, 0, 0, 0, 0, 0, '2018-09-21 04:27:53', '2018-10-04 04:50:52', '2018-09-26 09:28:38'),
(210, 'parent', 'Adolf', 'Rebelo', NULL, 'adolf.rebelo123@gmail.com', '$2y$10$LlbK1NxvUMBp8cs3x4Td3e7DK3kJZa4L5l9tgWWmIYWQBNJF6rXIC', NULL, 'yes', 'yes', 'no', 'active', 'no', 'facebook', '9234234234', NULL, NULL, '2rM7NvcRpUU9Jw6AUVACI8WXQMp5DOxwikc9BSdGMduo00se9lQlDfz6Anub', 0, '', 360, 520.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9734', '', NULL, NULL, 0, 0, 0, 0, 0, 0, '2018-09-26 09:33:42', '2018-10-06 07:14:15', NULL),
(211, 'teacher', 'Teacher', 'Teacher', NULL, 'teacher@cars2.club', '$2y$10$nKsSu6leNgvqIchGWyA6bepmP6GbgXX7VFGY9QOgddDCLAiQeGT32', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '9304535345', NULL, 'male', 'rxQsawdjARKaAtlVU6qJYM3D6tzL1ouBuyokmI3y05qMmUFPtoNNtQCrpycW', 0, '', 0, NULL, 'a043d62396c54eb0c410eab7bb01f0f2fe6c7cff.jpeg', 'Nashville, TN, USA', NULL, NULL, NULL, NULL, 99, NULL, NULL, '7674', '', NULL, 'en', 0, 0, 0, 0, 0, 0, '2018-09-26 13:01:01', '2018-10-12 04:31:02', NULL),
(213, 'parent', 'Ruhi', 'J', NULL, 'ruhi@gmail.com', '$2y$10$g8vwl9FJ6yUapI13lmyNB.HE0Tbz15gcSTR.qUEF5koW2NzSRLmvm', '', 'yes', 'yes', 'no', 'active', 'no', 'facebook', '9023423444', NULL, 'female', '62duAbgTKuoB3GHZN6eRSAokuRuMLTIGwuww1x9Zxg0ZXmu6spwxi3JQNGTB', 0, '', 50, NULL, '340b0099d96214898ee486679f7feff899e186d0.jpg', 'Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, 9, NULL, NULL, '5742', '', NULL, 'en', 0, 0, 0, 0, 0, 0, '2018-09-27 09:52:12', '2018-10-12 03:56:48', NULL),
(246, 'student', 'Anshu', 'J', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', NULL, NULL, NULL, 'ghSwldjn0Z4o8IaBsFb6lSA7lGmeF78cHVvO0hecifulXaInT54HR8BDOpTt', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6324', 'Kar3Ui2q4fG6AX8', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-06 08:58:02', '2018-10-06 10:50:06', NULL),
(247, 'student', 'Anuj', 'Reuhela', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, '86be5340bbb665e8df3d032c8c38452b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7222', 'YT7ma9IDQjgZHdb', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-06 11:03:03', NULL, NULL),
(251, 'student', 'Shivansh', 'Patil', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, '28e0679b3e6ee2797472226ba98520ff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6981', 'd7fjFAtbXpG21zm', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-06 12:32:25', '2018-10-09 10:21:37', NULL),
(252, 'student', 'Akshaya', 'Garje', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, 'lDDWGb5XsLGLZf6Cv9ucDl4GGPBEH82dEgp7vWZCHy0HdhI6woDvASYHeV06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5162', 'joBdVAPFUaCgER0', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-06 12:35:43', '2018-10-11 11:19:46', NULL),
(253, 'student', 'divya', 'd', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', NULL, NULL, NULL, '08427bc81e02495f132669f38db45e76', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6003', 'AY5WLhCkftoMljr', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-08 05:08:55', NULL, NULL),
(254, 'student', 'Aditya', 'Patil', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, 'b8a67208bd55ecec1e378c36444083d7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6598', 'NifcxjDXhk8ATvb', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-08 06:05:16', '2018-10-15 07:25:00', NULL),
(255, 'teacher', 'Cececy', 'Cc', NULL, 'cececy@nada.email', '$2y$10$zQ.hov15fyd9oG9srMUg0.QZpcwZw/kcF7FWm4CVyXS6hktDuQe/u', '', 'no', 'yes', 'no', 'active', 'no', 'facebook', '2344234234', NULL, 'male', 'pjHadyJbF2biPy52brZHE8QbQdnbm9sv7CfTFjEJWP5r3ThJNSTBOz7vrESN', NULL, NULL, NULL, NULL, '34b83e48f2bac8d148a2a7c2a8d2ffc110653014.jpg', 'Ghansoli, Navi Mumbai, Maharashtra, India', NULL, NULL, NULL, NULL, 44, NULL, NULL, '1022', NULL, NULL, 'en', 0, 0, 0, 0, 0, NULL, '2018-10-08 08:48:18', '2018-10-17 09:42:12', NULL),
(256, 'student', 'Riddhi', 'J', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, '0wQnKUpyfqPqiQVMVMfLPa1KbjuC5hkMWFx6GOlZc7rzuaMJrp2WqruBGMHI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1620', 'xD9u01wZFsbAIj5', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-09 04:27:02', '2018-10-25 10:30:22', NULL),
(257, 'student', 'Apeksha', 'P', NULL, '', '', '', 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, 'rJB6MZN2gGlq614tmbldbUC8tIyMcNPpHAWNEfp0Q6raB0JStGdeHbe329J8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7604', '6yaiXdRHDh2Bwtc', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-09 06:05:13', '2018-10-11 11:16:02', NULL),
(258, 'student', 'Kriti', 'Sanon', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, 'TIHUZOBBfMkN334MDELWaD2CcMkpizpJbz7SGBVxgartAZfsXvvvqyMMZbOS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5646', 'FsSMnAV2NUY4Jcj', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-10 09:10:03', '2018-10-11 05:48:57', NULL),
(259, 'parent', 'Poonam', 'Mahajan', NULL, 'poonamm@gmail.com', '$2y$10$zQ.hov15fyd9oG9srMUg0.QZpcwZw/kcF7FWm4CVyXS6hktDuQe/u', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '434534545', NULL, NULL, '2NnoHrhr4phLwojrGIfirt0pwU6ezjkX59V6OPPYr5Z4YJG84YzcFKgjgb8f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 05:43:41', '2018-10-11 05:48:28', NULL),
(260, 'student', 'Dummy', 'Student', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, 'WVBJ6wZrjvWbmYQUjaqrf2NsE8X3e987oKORvz9AMcP2rGWkWTqVRg2KAi91', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8028', 'T0NxJVcjtzishCH', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 05:50:41', '2018-10-11 05:54:36', NULL),
(261, 'parent', 'Testng', 'Parent', NULL, 'xesu@cars2.club', '$2y$10$iqPgLoI0oZ50K3eD2924quYbiuuq1d9ZEIIrJHwhhtplXRcszewme', NULL, 'yes', 'yes', 'no', 'active', 'no', 'facebook', '1111111111', NULL, NULL, 'wCxBCsvrjG17tgEOU5x8n8aSnrebko7OT8Lm759oM5qWd7LetlPz3UOmXPI9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, '8029', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 05:53:23', '2018-10-11 06:12:27', NULL),
(262, 'student', 'New', 'Student', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, '3072d26a24b5c5d16025fd0e230bcb8e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8667', '4mrLYDXIsNTlC0R', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:09:20', NULL, NULL),
(263, 'student', 'Asd', 'Asdasd', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, 'c6593dca90e64b4715972c8486bfb732', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9731', 'OVp7j9QJDGR6mLr', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:37:35', NULL, NULL),
(264, 'student', 'Athrav', 'Patil', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, 'La55vEco6GBlagYyviA3wkdu4P3qoBwxx61cZw2LOwqLY68YWp1PmK5r5n3L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7864', 'VjCYN5Q2aSrAztn', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 06:37:50', '2018-10-11 07:14:50', NULL),
(265, 'parent', 'Isha', 'Gupta', NULL, 'giwofi@duck2.club', '$2y$10$RbEm7ozL1L2cJ0HXIx3mNubjhNT.Xv.CAvLtQAGcch.pMSLNik/Ou', NULL, 'no', 'no', 'no', 'active', 'no', 'facebook', '465464566', NULL, NULL, '3b7e11e43c68f1ee8bd21ae68932233d', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 07:12:20', '2018-10-11 07:12:20', NULL),
(266, 'student', 'Chilld', 'One', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', NULL, NULL, NULL, 'c6c6f11a35dae60f161d04e5b33b0dc0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4411', 'wCNcSoehH4zv6dn', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 11:16:45', NULL, NULL),
(267, 'student', 'Child', 'Two', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', NULL, NULL, NULL, '14ab492b9b3d58e2345cec08d14924cb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4101', 'Ct0GdNoSpwcaIkn', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 11:17:00', '2018-10-25 10:26:45', NULL),
(268, 'student', 'Child', 'Three', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', NULL, NULL, NULL, '1c3f61b1768796c173ac9dccadd81e3a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6268', 'xBJ3OL40mvGtWaM', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 11:17:18', NULL, NULL),
(269, 'student', 'sdfsdf', 'sdfsdf', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', NULL, NULL, NULL, '2abce80477405f56f5ebe74233877075', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6057', 'LtMKqsg1uv6C2oe', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 12:37:59', '2018-10-12 03:56:35', '2018-10-12 03:56:35'),
(270, 'student', 'Sdfsdfxcvc', 'Sfsdfccxvvvvvvvvvv', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', NULL, NULL, NULL, '2f7caa3547789aa506250896e2cdf9bf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0466', '270TvK5zY8EXmgd', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 12:38:13', '2018-10-11 12:38:26', '2018-10-11 12:38:26'),
(271, 'parent', 'Aaaa', 'Bbbb', NULL, 'vecufoxu@banit.me', '$2y$10$pVrw223tIFBQU5hOkPgeq.ZaZAT9pMH8E.EjrqVTDF33N/diinaM6', NULL, 'yes', 'yes', 'no', 'active', 'no', 'facebook', '903455345345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, '0935', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 12:43:57', '2018-10-22 05:26:03', '2018-10-22 05:26:03'),
(272, 'student', 'Kajal', 'pawar', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', NULL, NULL, NULL, '058173d03a032714bebd20c35a3f0c39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5617', 'ygxtfH4DjuVhIeZ', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-11 13:28:07', NULL, NULL),
(273, 'student', 'Kareena', 'Kappor', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', NULL, NULL, NULL, '0c642d5ea00cd60b44c9e35e4d69e687', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0097', 'DLnhl0rCFUxduaK', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-12 05:29:23', '2018-10-15 11:42:44', '2018-10-15 11:42:44'),
(274, 'teacher', 'Teacher', 'Teacher', NULL, 'teacher@wmail.club', '$2y$10$yUX9yPAUC/dCawk2JDQ40ePeusVjFtBw3b.sq/AHvs6zQNn7nVrHO', NULL, 'no', 'yes', 'yes', 'active', 'no', 'facebook', '3453453455', NULL, 'male', 'fdnE27W0oBEFWBT0lTGGOSylZxWFMuSRZcjwZgP32E5oxWzBWVXNh67EYhLf', NULL, NULL, 100, 100.00, 'fa6211b836f698ea3f7c2d9ee006518b979e18cc.jpg', 'XC-1, Sevashram Road, Buddhdev Market, Panchbatti, Moti Doongri, Bharuch, Gujarat, India', NULL, NULL, NULL, NULL, 23, NULL, NULL, '7370', NULL, NULL, 'en', 0, 0, 0, 0, 0, NULL, '2018-10-12 05:36:56', '2018-10-25 05:05:46', NULL),
(275, 'student', 'Arpita', 'Malode', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, '2BmEcqHBouaMp5vXxlxMhI8w5Bckc443rYCtu9ASB5SvLZx0nvJJAEUq1WNg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3698', 'YzwN8ple43x729V', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-12 05:46:54', '2018-10-12 10:48:29', NULL),
(276, 'parent', 'Parent', 'P', NULL, 'parent@wmail.club', '$2y$10$FJKfehE/EEj1QdwEz76E2.SQ73H/HuECmYXZ9Ual1rfnsKS.Oy32m', NULL, 'yes', 'yes', 'yes', 'active', 'no', 'facebook', '567567567567', NULL, 'female', 'Yt3JayXDN0aQrXU31peTYY3Rb8oIMwvca2rZxCxlXbYMj0QFUm2BnHHSiL5E', NULL, NULL, 170, 200.00, 'caa0e7d6d402ba026de616bb5ebd763d701fdd23.jpg', 'Nashville, TN, USA', NULL, NULL, NULL, NULL, 44, NULL, NULL, '4576', NULL, NULL, 'en', 0, 0, 0, 0, 0, NULL, '2018-10-12 05:48:29', '2018-10-26 05:11:37', NULL),
(277, 'student', 'Arsh', 'ukarde', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', NULL, NULL, NULL, 'N1hKhL5gtkBKlUkzmKF48Iqvkb9lQzQ5igj7kt7rPBxDdnvlSMLKt2U55rYF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1743', 'lIKkiO9dXAzY0PM', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-12 10:47:11', '2018-10-15 05:53:28', NULL),
(278, 'parent', 'Cokumut', 'Cc', NULL, 'cokumut@banit.club', '$2y$10$tucegX89qwGUigqFnxEPjORfIOa37K6KavoXt4LoeOT1QpIgWMnEO', NULL, 'yes', 'yes', 'no', 'active', 'no', 'facebook', '46546546456', NULL, NULL, 'GYzC3jsgnBxKX7XxbSuoFE88BIbUdnF5EwDUH5AcQuQDL2CU2RaQ95qQyna3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, '5710', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-12 12:54:09', '2018-10-22 05:23:50', '2018-10-22 05:23:50'),
(279, 'student', 'Harshada', 'Uk', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, '7dca53b7f96537278a60ab16fefd8656', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2491', 'XVvA3ZWEDoruKaY', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-15 08:36:49', NULL, NULL),
(280, 'parent', 'Vina', 'Tttt', NULL, 'volehu@nada.ltd', '$2y$10$A/h0sRFz3V.Heo1MeT5R5e43QwlcvBSYu1AvppfnO119ZpBml.A1e', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '34535345345', NULL, NULL, 'T7IfpO4FCy8zFszlK6KQj0OhVfA1aHH4DsMCwbyckoyx7NDKCRDvflS7LTMn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 99, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-15 08:39:08', '2018-10-20 05:45:19', '2018-10-20 05:45:19'),
(281, 'student', 'Anushka', 'Sharma', NULL, '', '', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '', NULL, NULL, 'b61724cf7957fa4e43d0ae0daff0f7eb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5751', '1Uw0KfA5j4TFV2X', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-15 08:48:15', NULL, NULL),
(282, 'student', 'Nikita', 'More', NULL, NULL, NULL, NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', NULL, NULL, NULL, 'yzOoyCvup5kJohppwJpRV6pTWHeFc4usMhAfi4RvCsPBvEtEZvRJN90m3lEy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6200', '16k0OCQJm54rufW', NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-15 09:55:46', '2018-10-20 10:34:20', NULL),
(283, 'program-creator', 'Fdsfsd', 'Fsdfsdf', NULL, 'sdfsdf@gmail.com', '$2y$10$Ub6M8qd43UZ4Zq3Ha60yhuyepg8DmKiJkH6080k.NbbUvmGDZySdy', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '345345345345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Nashik Road, Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '{\"account_setting\\/password\\/change.list\":\"true\",\"account_setting\\/password\\/change.update\":\"true\",\"account_setting\\/edit_profile.list\":\"true\",\"account_setting\\/edit_profile.update\":\"true\"}', NULL, 0, 0, 0, 0, 0, 0, '2018-10-17 09:26:56', '2018-10-17 09:30:10', '2018-10-17 09:30:10'),
(284, 'supervisor', 'Sdjfsj', 'Jjh', NULL, 'xcvxcv@gmail.com', '$2y$10$xVVJOtOvUBGNh2ytcHzd2Ox1dc4nodCHIguT3wnrC9NYdQ2pk2rdK', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '54 645646', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nashikl road', NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, '{\"account_setting\\/password\\/change.list\":\"true\",\"account_setting\\/password\\/change.update\":\"true\",\"account_setting\\/edit_profile.list\":\"true\",\"account_setting\\/edit_profile.update\":\"true\"}', NULL, 0, 0, 0, 0, 0, NULL, '2018-10-17 09:31:10', '2018-10-17 09:31:25', '2018-10-17 09:31:25'),
(285, 'program-creator', 'Sdfsd', 'Fsdfsdf', NULL, 'creator@webwing.com', '$2y$10$BMpYNhz8Y3Xud32aWAIvsupbXuLvRlpcDupiVgQQ.WkTIY79rcR7C', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '44564645', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6dfgdfgdfg', NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, '{\"account_setting\\/password\\/change.list\":\"true\",\"account_setting\\/password\\/change.update\":\"true\",\"account_setting\\/edit_profile.list\":\"true\",\"account_setting\\/edit_profile.update\":\"true\"}', NULL, 0, 0, 0, 0, 0, 287, '2018-10-22 05:18:36', '2018-10-24 05:33:17', NULL),
(286, 'parent', 'Sf', 'Dfsdf', NULL, 'vecufoxu@banit.me', '$2y$10$gc3518mP5lbCulQsFcnsgemtbOSc5AzhASDPAu5Bp359WAvaKwUle', NULL, 'no', 'no', 'no', 'active', 'no', 'facebook', '546456546546', NULL, NULL, 'c7107d5ce4aae8a08dd174be029b1d59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, '2018-10-22 05:26:29', '2018-10-22 05:26:29', NULL),
(287, 'supervisor', 'Akshay', 'Supervisor', NULL, 'supervisor@webwing.com', '$2y$10$7DJM4TEoEV9MZD545DaM2e/Z.VWsHMx9z7Vlv16heF66H6v6/w5QC', NULL, 'no', 'yes', 'no', 'active', 'no', 'facebook', '1324657980', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nashik', NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, '{\"account_setting\\/password\\/change.list\":\"true\",\"account_setting\\/password\\/change.update\":\"true\",\"account_setting\\/edit_profile.list\":\"true\",\"account_setting\\/edit_profile.update\":\"true\"}', NULL, 0, 0, 0, 0, 0, NULL, '2018-10-24 05:32:58', '2018-10-24 05:32:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_login_history`
--

CREATE TABLE `user_login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'user id -foreign key from user table',
  `login_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `total_time` time DEFAULT NULL,
  `time_in_seconds` int(11) NOT NULL COMMENT 'time in seconds',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login_history`
--

INSERT INTO `user_login_history` (`id`, `user_id`, `login_date`, `start_time`, `end_time`, `total_time`, `time_in_seconds`, `created_at`, `updated_at`) VALUES
(1, 252, '2018-10-11', '16:49:27', '16:49:46', '00:02:12', 0, '2018-10-11 05:26:14', '2018-10-11 11:19:46'),
(2, 213, '2018-10-11', '17:25:39', '18:13:21', '00:48:27', 0, '2018-10-11 05:29:50', '2018-10-11 12:43:21'),
(3, 211, '2018-10-11', '18:18:39', '18:35:45', '04:06:25', 0, '2018-10-11 05:31:04', '2018-10-11 13:05:45'),
(4, 182, '2018-10-11', '11:11:52', '17:30:59', '07:19:18', 0, '2018-10-11 05:41:52', '2018-10-11 12:00:59'),
(5, 259, '2018-10-11', '11:16:43', '11:18:28', '00:02:03', 0, '2018-10-11 05:45:21', '2018-10-11 05:48:28'),
(6, 258, '2018-10-11', '11:18:35', '11:18:57', '00:00:22', 0, '2018-10-11 05:48:35', '2018-10-11 05:48:57'),
(7, 260, '2018-10-11', '11:23:42', '11:24:36', '00:00:54', 0, '2018-10-11 05:53:42', '2018-10-11 05:54:36'),
(8, 261, '2018-10-11', '11:42:27', NULL, NULL, 0, '2018-10-11 06:12:27', '2018-10-11 06:12:27'),
(9, 255, '2018-10-11', '11:44:48', '12:20:52', '00:36:04', 0, '2018-10-11 06:14:48', '2018-10-11 06:50:52'),
(10, 264, '2018-10-11', '12:44:47', '12:44:50', '00:00:03', 0, '2018-10-11 07:14:47', '2018-10-11 07:14:50'),
(11, 257, '2018-10-11', '16:45:54', '16:46:02', '00:01:47', 0, '2018-10-11 07:25:35', '2018-10-11 11:16:02'),
(12, 271, '2018-10-11', '18:15:56', NULL, NULL, 0, '2018-10-11 12:45:56', '2018-10-11 12:45:56'),
(13, 213, '2018-10-12', '09:24:49', '09:26:48', '00:01:59', 0, '2018-10-12 03:54:49', '2018-10-12 03:56:48'),
(14, 211, '2018-10-12', '09:49:37', '10:01:02', '00:18:49', 0, '2018-10-12 03:56:56', '2018-10-12 04:31:02'),
(15, 182, '2018-10-12', '10:31:46', '11:04:41', '00:56:39', 0, '2018-10-12 04:31:39', '2018-10-12 05:34:41'),
(16, 256, '2018-10-12', '10:03:20', '10:03:45', '00:00:25', 0, '2018-10-12 04:33:20', '2018-10-12 04:33:45'),
(17, 274, '2018-10-12', '11:07:55', '11:17:39', '00:09:44', 0, '2018-10-12 05:37:55', '2018-10-12 05:47:39'),
(18, 276, '2018-10-12', '18:21:55', '18:23:23', '05:24:19', 0, '2018-10-12 05:50:32', '2018-10-12 12:53:23'),
(19, 275, '2018-10-12', '11:28:30', '11:32:26', '00:03:56', 0, '2018-10-12 05:58:30', '2018-10-12 06:02:26'),
(20, 278, '2018-10-12', '18:28:03', '18:27:59', '00:02:42', 0, '2018-10-12 12:55:17', '2018-10-12 12:58:03'),
(21, 16, '2018-10-15', '09:32:53', '09:54:43', '00:21:50', 0, '2018-10-15 04:02:53', '2018-10-15 04:24:43'),
(22, 182, '2018-10-15', '17:07:25', '17:27:45', '00:21:15', 0, '2018-10-15 04:24:56', '2018-10-15 11:57:45'),
(23, 276, '2018-10-15', '18:12:31', '17:07:19', '01:51:58', 0, '2018-10-15 04:25:59', '2018-10-15 12:42:31'),
(24, 277, '2018-10-15', '11:23:01', '11:23:28', '00:00:27', 0, '2018-10-15 04:26:15', '2018-10-15 05:53:28'),
(25, 274, '2018-10-15', '17:27:59', '17:30:13', '01:05:31', 0, '2018-10-15 05:53:43', '2018-10-15 12:00:13'),
(26, 255, '2018-10-15', '14:15:40', '14:07:03', '01:19:03', 0, '2018-10-15 07:18:00', '2018-10-15 08:45:40'),
(27, 280, '2018-10-15', '14:15:05', '14:17:19', '00:02:27', 0, '2018-10-15 08:44:19', '2018-10-15 08:47:19'),
(28, 182, '2018-10-16', '17:46:37', '17:50:55', '00:04:18', 0, '2018-10-16 12:16:37', '2018-10-16 12:20:55'),
(29, 276, '2018-10-17', '16:42:54', '15:09:00', '03:25:16', 0, '2018-10-17 05:10:33', '2018-10-17 11:12:54'),
(30, 255, '2018-10-17', '15:10:46', '15:12:12', '00:01:26', 0, '2018-10-17 09:40:46', '2018-10-17 09:42:12'),
(31, 276, '2018-10-19', '18:53:07', '18:38:28', '01:51:51', 0, '2018-10-19 04:14:50', '2018-10-19 13:23:07'),
(32, 274, '2018-10-19', '11:13:03', '11:40:13', '00:27:10', 0, '2018-10-19 05:43:03', '2018-10-19 06:10:13'),
(33, 16, '2018-10-19', '15:13:02', NULL, NULL, 0, '2018-10-19 09:43:02', '2018-10-19 09:43:02'),
(34, 276, '2018-10-20', '18:53:06', '16:00:10', '01:57:43', 0, '2018-10-20 05:42:32', '2018-10-20 13:23:06'),
(35, 16, '2018-10-20', '17:25:28', '11:13:25', '00:00:02', 0, '2018-10-20 05:43:23', '2018-10-20 11:55:29'),
(36, 280, '2018-10-20', '11:15:13', '11:15:16', '00:00:03', 0, '2018-10-20 05:45:13', '2018-10-20 05:45:16'),
(37, 282, '2018-10-20', '12:59:50', '14:02:41', '01:20:58', 0, '2018-10-20 05:46:27', '2018-10-20 08:32:41'),
(38, 274, '2018-10-20', '12:58:06', '12:59:37', '01:22:38', 0, '2018-10-20 05:59:28', '2018-10-20 07:29:37'),
(39, 16, '2018-10-23', '15:39:02', '17:55:05', '02:16:03', 0, '2018-10-23 10:09:02', '2018-10-23 12:25:05'),
(40, 276, '2018-10-23', '17:56:08', NULL, NULL, 0, '2018-10-23 12:26:08', '2018-10-23 12:26:08'),
(41, 274, '2018-10-24', '10:39:35', '12:42:11', '02:02:36', 0, '2018-10-24 05:09:35', '2018-10-24 07:12:11'),
(42, 276, '2018-10-24', '17:14:38', '18:24:46', '01:10:08', 0, '2018-10-24 07:12:23', '2018-10-24 12:54:46'),
(43, 276, '2018-10-25', '09:31:42', '10:16:14', '00:45:47', 0, '2018-10-25 04:00:23', '2018-10-25 04:46:14'),
(44, 16, '2018-10-25', '09:44:42', NULL, NULL, 0, '2018-10-25 04:14:42', '2018-10-25 04:14:42'),
(45, 274, '2018-10-25', '10:16:30', '10:35:45', '00:19:15', 0, '2018-10-25 04:46:30', '2018-10-25 05:05:45'),
(46, 182, '2018-10-25', '18:23:25', '18:23:31', '04:50:23', 0, '2018-10-25 05:18:18', '2018-10-25 12:53:31'),
(47, 276, '2018-10-26', '09:58:48', '10:41:37', '00:42:49', 0, '2018-10-26 04:28:48', '2018-10-26 05:11:37'),
(48, 182, '2018-10-26', '10:49:36', '13:59:52', '03:10:16', 0, '2018-10-26 05:19:36', '2018-10-26 08:29:52'),
(49, 16, '2018-10-26', '12:13:34', NULL, NULL, 0, '2018-10-26 06:41:27', '2018-10-26 06:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `wire_transfereed_request`
--

CREATE TABLE `wire_transfereed_request` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `requested_date` date NOT NULL,
  `payment_status` enum('paid','unpaid') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wire_transfereed_request`
--

INSERT INTO `wire_transfereed_request` (`id`, `plan_id`, `user_id`, `requested_date`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 3, 276, '2018-10-12', 'paid', '2018-10-12 06:54:56', '2018-10-12 07:11:10'),
(2, 1, 278, '2018-10-12', 'paid', '2018-10-12 12:55:12', '2018-10-12 12:57:03'),
(3, 3, 182, '2018-10-15', 'unpaid', '2018-10-15 11:43:18', '2018-10-20 06:18:43');

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
-- Indexes for table `bank_details_translation`
--
ALTER TABLE `bank_details_translation`
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
-- Indexes for table `contact_address`
--
ALTER TABLE `contact_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_address_translation`
--
ALTER TABLE `contact_address_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_enquiry`
--
ALTER TABLE `contact_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_phone_codes`
--
ALTER TABLE `country_phone_codes`
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
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`(191));

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `points_table`
--
ALTER TABLE `points_table`
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
-- Indexes for table `template_preview_1`
--
ALTER TABLE `template_preview_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_2`
--
ALTER TABLE `template_preview_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_3`
--
ALTER TABLE `template_preview_3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_4`
--
ALTER TABLE `template_preview_4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_5`
--
ALTER TABLE `template_preview_5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_6`
--
ALTER TABLE `template_preview_6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_7`
--
ALTER TABLE `template_preview_7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_8`
--
ALTER TABLE `template_preview_8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_9`
--
ALTER TABLE `template_preview_9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_10`
--
ALTER TABLE `template_preview_10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_11`
--
ALTER TABLE `template_preview_11`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_12`
--
ALTER TABLE `template_preview_12`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_13`
--
ALTER TABLE `template_preview_13`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_14`
--
ALTER TABLE `template_preview_14`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_15`
--
ALTER TABLE `template_preview_15`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_16`
--
ALTER TABLE `template_preview_16`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_17`
--
ALTER TABLE `template_preview_17`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_18`
--
ALTER TABLE `template_preview_18`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_19`
--
ALTER TABLE `template_preview_19`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_20`
--
ALTER TABLE `template_preview_20`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_21`
--
ALTER TABLE `template_preview_21`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_22`
--
ALTER TABLE `template_preview_22`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_23`
--
ALTER TABLE `template_preview_23`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_24`
--
ALTER TABLE `template_preview_24`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_25`
--
ALTER TABLE `template_preview_25`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_26`
--
ALTER TABLE `template_preview_26`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_27`
--
ALTER TABLE `template_preview_27`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_28`
--
ALTER TABLE `template_preview_28`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_29`
--
ALTER TABLE `template_preview_29`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_30`
--
ALTER TABLE `template_preview_30`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_31`
--
ALTER TABLE `template_preview_31`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_32`
--
ALTER TABLE `template_preview_32`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_33`
--
ALTER TABLE `template_preview_33`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_34`
--
ALTER TABLE `template_preview_34`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_35`
--
ALTER TABLE `template_preview_35`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_36`
--
ALTER TABLE `template_preview_36`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_37`
--
ALTER TABLE `template_preview_37`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_38`
--
ALTER TABLE `template_preview_38`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_39`
--
ALTER TABLE `template_preview_39`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_40`
--
ALTER TABLE `template_preview_40`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_41`
--
ALTER TABLE `template_preview_41`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_42`
--
ALTER TABLE `template_preview_42`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_43`
--
ALTER TABLE `template_preview_43`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_44`
--
ALTER TABLE `template_preview_44`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_45`
--
ALTER TABLE `template_preview_45`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_46`
--
ALTER TABLE `template_preview_46`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_47`
--
ALTER TABLE `template_preview_47`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_48`
--
ALTER TABLE `template_preview_48`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_49`
--
ALTER TABLE `template_preview_49`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_preview_50`
--
ALTER TABLE `template_preview_50`
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
-- Indexes for table `user_login_history`
--
ALTER TABLE `user_login_history`
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
-- AUTO_INCREMENT for table `bank_details_translation`
--
ALTER TABLE `bank_details_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `classroom_student`
--
ALTER TABLE `classroom_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `contact_address`
--
ALTER TABLE `contact_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_address_translation`
--
ALTER TABLE `contact_address_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_enquiry`
--
ALTER TABLE `contact_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `country_phone_codes`
--
ALTER TABLE `country_phone_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupon_usage`
--
ALTER TABLE `coupon_usage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `currency_rate`
--
ALTER TABLE `currency_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `email_template_translation`
--
ALTER TABLE `email_template_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `flyer`
--
ALTER TABLE `flyer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `front_pages`
--
ALTER TABLE `front_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `front_pages_translation`
--
ALTER TABLE `front_pages_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `global_setting`
--
ALTER TABLE `global_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grade_translation`
--
ALTER TABLE `grade_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homework_image`
--
ALTER TABLE `homework_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `newsletter_subscriber`
--
ALTER TABLE `newsletter_subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=786;

--
-- AUTO_INCREMENT for table `points_table`
--
ALTER TABLE `points_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `program_question`
--
ALTER TABLE `program_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `program_reason`
--
ALTER TABLE `program_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reference_code`
--
ALTER TABLE `reference_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `share_class`
--
ALTER TABLE `share_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_status`
--
ALTER TABLE `site_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `student_programs`
--
ALTER TABLE `student_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `student_program_questions`
--
ALTER TABLE `student_program_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subject_translation`
--
ALTER TABLE `subject_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscription_plan_translation`
--
ALTER TABLE `subscription_plan_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `template_1`
--
ALTER TABLE `template_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_2`
--
ALTER TABLE `template_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_3`
--
ALTER TABLE `template_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_4`
--
ALTER TABLE `template_4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_5`
--
ALTER TABLE `template_5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_6`
--
ALTER TABLE `template_6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_7`
--
ALTER TABLE `template_7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_8`
--
ALTER TABLE `template_8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_9`
--
ALTER TABLE `template_9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_10`
--
ALTER TABLE `template_10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_11`
--
ALTER TABLE `template_11`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_12`
--
ALTER TABLE `template_12`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_13`
--
ALTER TABLE `template_13`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_14`
--
ALTER TABLE `template_14`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_15`
--
ALTER TABLE `template_15`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_16`
--
ALTER TABLE `template_16`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_17`
--
ALTER TABLE `template_17`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_18`
--
ALTER TABLE `template_18`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_19`
--
ALTER TABLE `template_19`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_20`
--
ALTER TABLE `template_20`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_21`
--
ALTER TABLE `template_21`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_22`
--
ALTER TABLE `template_22`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_23`
--
ALTER TABLE `template_23`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_24`
--
ALTER TABLE `template_24`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_25`
--
ALTER TABLE `template_25`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_26`
--
ALTER TABLE `template_26`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_27`
--
ALTER TABLE `template_27`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_28`
--
ALTER TABLE `template_28`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_29`
--
ALTER TABLE `template_29`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_30`
--
ALTER TABLE `template_30`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_31`
--
ALTER TABLE `template_31`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_32`
--
ALTER TABLE `template_32`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_33`
--
ALTER TABLE `template_33`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_34`
--
ALTER TABLE `template_34`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_35`
--
ALTER TABLE `template_35`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_36`
--
ALTER TABLE `template_36`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_37`
--
ALTER TABLE `template_37`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template_38`
--
ALTER TABLE `template_38`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_39`
--
ALTER TABLE `template_39`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_40`
--
ALTER TABLE `template_40`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_41`
--
ALTER TABLE `template_41`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `template_42`
--
ALTER TABLE `template_42`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template_43`
--
ALTER TABLE `template_43`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_44`
--
ALTER TABLE `template_44`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_45`
--
ALTER TABLE `template_45`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_46`
--
ALTER TABLE `template_46`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_47`
--
ALTER TABLE `template_47`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_48`
--
ALTER TABLE `template_48`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_49`
--
ALTER TABLE `template_49`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template_50`
--
ALTER TABLE `template_50`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template_preview_1`
--
ALTER TABLE `template_preview_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template_preview_2`
--
ALTER TABLE `template_preview_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template_preview_3`
--
ALTER TABLE `template_preview_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_4`
--
ALTER TABLE `template_preview_4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_5`
--
ALTER TABLE `template_preview_5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_6`
--
ALTER TABLE `template_preview_6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_7`
--
ALTER TABLE `template_preview_7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_8`
--
ALTER TABLE `template_preview_8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_9`
--
ALTER TABLE `template_preview_9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_10`
--
ALTER TABLE `template_preview_10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_11`
--
ALTER TABLE `template_preview_11`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_12`
--
ALTER TABLE `template_preview_12`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `template_preview_13`
--
ALTER TABLE `template_preview_13`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_14`
--
ALTER TABLE `template_preview_14`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_15`
--
ALTER TABLE `template_preview_15`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_16`
--
ALTER TABLE `template_preview_16`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_17`
--
ALTER TABLE `template_preview_17`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_18`
--
ALTER TABLE `template_preview_18`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_19`
--
ALTER TABLE `template_preview_19`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_20`
--
ALTER TABLE `template_preview_20`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_21`
--
ALTER TABLE `template_preview_21`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_22`
--
ALTER TABLE `template_preview_22`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_23`
--
ALTER TABLE `template_preview_23`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_24`
--
ALTER TABLE `template_preview_24`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_25`
--
ALTER TABLE `template_preview_25`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_26`
--
ALTER TABLE `template_preview_26`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_27`
--
ALTER TABLE `template_preview_27`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_28`
--
ALTER TABLE `template_preview_28`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_29`
--
ALTER TABLE `template_preview_29`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_30`
--
ALTER TABLE `template_preview_30`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_31`
--
ALTER TABLE `template_preview_31`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_32`
--
ALTER TABLE `template_preview_32`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_33`
--
ALTER TABLE `template_preview_33`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `template_preview_34`
--
ALTER TABLE `template_preview_34`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_35`
--
ALTER TABLE `template_preview_35`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `template_preview_36`
--
ALTER TABLE `template_preview_36`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_37`
--
ALTER TABLE `template_preview_37`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_38`
--
ALTER TABLE `template_preview_38`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_39`
--
ALTER TABLE `template_preview_39`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `template_preview_40`
--
ALTER TABLE `template_preview_40`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `template_preview_41`
--
ALTER TABLE `template_preview_41`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `template_preview_42`
--
ALTER TABLE `template_preview_42`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_43`
--
ALTER TABLE `template_preview_43`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_44`
--
ALTER TABLE `template_preview_44`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_45`
--
ALTER TABLE `template_preview_45`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_46`
--
ALTER TABLE `template_preview_46`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `template_preview_47`
--
ALTER TABLE `template_preview_47`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_48`
--
ALTER TABLE `template_preview_48`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_preview_49`
--
ALTER TABLE `template_preview_49`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `template_preview_50`
--
ALTER TABLE `template_preview_50`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonials_translation`
--
ALTER TABLE `testimonials_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `textbook`
--
ALTER TABLE `textbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `textbook_image`
--
ALTER TABLE `textbook_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `textbook_translation`
--
ALTER TABLE `textbook_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT for table `user_login_history`
--
ALTER TABLE `user_login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `wire_transfereed_request`
--
ALTER TABLE `wire_transfereed_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
