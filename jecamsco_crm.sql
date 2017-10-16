-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2017 at 02:30 PM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jecamsco_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounting_papers`
--

CREATE TABLE IF NOT EXISTS `accounting_papers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agent_statuses`
--

CREATE TABLE IF NOT EXISTS `agent_statuses` (
  `id` int(11) NOT NULL,
  `quota` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `team_id` int(22) DEFAULT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `tin_number` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent_statuses`
--

INSERT INTO `agent_statuses` (`id`, `quota`, `user_id`, `team_id`, `date_from`, `date_to`, `created`, `modified`, `tin_number`) VALUES
(1, '1000000', 4, 1, '2017-07-17 08:24:00', '2017-07-17 08:24:00', '2017-07-17 08:25:45', '2017-07-17 08:25:45', '1'),
(2, '1.5', 4, 4, '2017-07-17 00:00:00', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2'),
(3, '1000000', 7, 2, '2017-07-17 16:06:00', '2017-07-17 16:06:00', '2017-07-17 16:06:32', '2017-07-17 16:06:32', '3'),
(4, '3', 6, 3, '2017-07-17 16:06:00', '2017-07-17 16:06:00', '2017-07-17 16:06:42', '2017-07-17 16:06:42', ''),
(5, '34', 5, 4, '2017-07-17 16:06:00', '2017-07-17 16:06:00', '2017-07-17 16:06:54', '2017-07-17 16:06:54', ''),
(6, '', 20, 1, '2017-09-22 12:52:00', '2017-09-22 12:52:00', '2017-09-22 12:53:51', '2017-09-22 12:53:51', '');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE IF NOT EXISTS `banks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `display_name`, `created`, `modified`) VALUES
(1, 'bdo', 'Banco De Oro', '2017-08-09 00:09:27', '2017-08-09 00:09:27'),
(2, 'metrobank', 'Metrobank', '2017-08-09 00:09:40', '2017-08-09 00:09:40'),
(3, 'bpi', 'Bank of the Philippine Islands', '2017-08-09 00:10:05', '2017-08-09 00:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created`, `modified`) VALUES
(1, 'OFFICE SEATING', '2017-07-17 16:41:42', '2017-07-17 16:41:42'),
(2, 'OFFICE TABLES', '2017-07-17 16:48:39', '2017-07-17 16:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `lead` int(11) DEFAULT '0' COMMENT '1,0',
  `name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tin_number` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `owner_marketing` int(11) DEFAULT '0',
  `date_forwarded` datetime DEFAULT NULL,
  `original_owner` int(11) DEFAULT NULL,
  `date_transfered` datetime DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `lead`, `name`, `contact_person`, `position`, `address`, `email`, `tin_number`, `contact_number`, `created`, `modified`, `owner_marketing`, `date_forwarded`, `original_owner`, `date_transfered`, `team_id`) VALUES
(1, 3, 1, 'A', 'a', 'a', 'a', 'admin', 'a', 'a', '2017-07-13 18:25:58', '2017-07-13 18:25:58', NULL, NULL, NULL, NULL, NULL),
(2, 3, 1, 'B', 'bb', 'bbb', 'bbbbb', 'bbbbbbb', 'bbbbbbbbbbbb', 'bbbbbbb', '2017-07-13 18:46:56', '2017-07-13 18:46:56', NULL, NULL, NULL, NULL, NULL),
(3, 3, 1, 'B', 'bb', 'bbb', 'bbbbb', 'bbbbbbb', 'bbbbbbbbbbbb', 'bbbbbbb', '2017-07-13 18:46:59', '2017-07-13 18:46:59', NULL, NULL, NULL, NULL, NULL),
(4, 3, 1, 'B', 'bb', 'bbb', 'bbbbb', 'bbbbbbb', 'bbbbbbbbbbbb', 'bbbbbbb', '2017-07-13 18:47:00', '2017-07-13 18:47:00', NULL, NULL, NULL, NULL, NULL),
(5, 3, 1, 'C', 'c', 'c', 'c', 'c', 'c', 'c', '2017-07-13 18:52:34', '2017-07-13 18:52:34', NULL, NULL, NULL, NULL, NULL),
(6, 3, 1, 'ASA', 'as', '', 'as', 'as', '', 'asas', '2017-07-16 14:59:42', '2017-07-16 14:59:42', NULL, NULL, NULL, NULL, NULL),
(7, 3, 1, 'X', 'x', 'x', 'x', 'x', 'x', 'x', '2017-07-16 15:10:02', '2017-07-16 15:10:02', NULL, NULL, NULL, NULL, NULL),
(8, 3, 0, 'V', 'v', 'v', 'v', 'v', 'v', 'v', '2017-07-16 15:10:51', '2017-07-16 15:10:51', NULL, NULL, NULL, NULL, NULL),
(9, 3, 1, 'E', 'e', 'e', 'e', 'e', 'e', 'e', '2017-07-16 15:52:15', '2017-07-16 15:52:15', 0, NULL, NULL, NULL, NULL),
(10, 4, 1, '2', '2', '2', '2', '2', '2', '2', '2017-07-17 11:26:09', '2017-07-28 17:38:09', 0, NULL, NULL, NULL, NULL),
(11, NULL, 1, 'V', 'v', 'v', 'v', 'v', 'v', 'v', '2017-07-17 11:32:46', '2017-07-17 11:32:46', NULL, NULL, NULL, NULL, NULL),
(12, NULL, 1, 'L', 'l', 'l', 'l', 'l', '', 'l', '2017-07-17 12:04:37', '2017-07-17 12:04:37', NULL, NULL, NULL, NULL, NULL),
(13, 4, 1, 'TY', 'y', 't', 't', 't', '', 't', '2017-07-17 12:08:35', '2017-07-17 12:08:35', 0, NULL, NULL, NULL, NULL),
(14, 4, 1, 'H', 'h', 'h', 'h', 'h', 'h', 'h', '2017-07-17 12:09:10', '2017-07-17 12:09:10', 0, NULL, NULL, NULL, NULL),
(15, 4, 1, 'LK', 'l', '', 'l', 'l', '', 'l', '2017-07-17 12:11:41', '2017-07-17 12:11:41', 0, NULL, NULL, NULL, NULL),
(16, 4, 1, 'MNMN', 'mm', 'm', 'm', 'm', '', 'm', '2017-07-17 12:13:22', '2017-09-08 02:41:49', 0, NULL, NULL, NULL, NULL),
(17, 4, 1, 'QQQQQQQQQQ', 'q', 'q', 'q', 'q', '', 'q', '2017-07-17 14:13:59', '2017-07-17 14:13:59', 0, NULL, NULL, NULL, 0),
(18, 4, 0, 'Company XXX', 'y', 'y', 'y', 'y', '1111133333', 'y', '2017-07-17 15:13:17', '2017-09-06 01:04:09', 0, NULL, NULL, NULL, 0),
(19, 4, 0, 'Company ZZZ', 'qw', 'qw', 'qw', 'qw', '111111111', 'qw', '2017-07-17 15:15:23', '2017-09-06 01:07:19', 0, NULL, NULL, NULL, 6),
(20, 0, 1, 'Q', 'q', 'q', 'q', 'q', '', 'q', '2017-07-17 15:30:12', '2017-07-17 15:30:12', 5, NULL, NULL, NULL, 0),
(21, 7, 1, 'A', 'a', 'a', 'a', 'a', '', 'a', '2017-07-17 15:31:27', '2017-07-17 16:24:15', 5, NULL, NULL, NULL, 0),
(24, 4, 0, 'Company A', 'q', 'q', 'q', 'q', '1111444', 'q', '2017-07-19 16:40:25', '2017-09-06 01:11:28', 0, NULL, NULL, NULL, 6),
(25, 4, 1, '/.,MJ.LIKNM', 'q', 'q', 'q', 'q', 'q', 'q', '2017-07-19 16:41:29', '2017-07-19 16:41:29', 0, NULL, NULL, NULL, 6),
(26, 6, 0, '1', '1', '1', '1', '1', '1', '1', '2017-07-24 18:40:16', '2017-07-28 17:41:03', 0, NULL, NULL, NULL, 3),
(27, 4, 0, 'RE', 're', 'rw', 'rew', 're', 're', 'e', '2017-07-28 17:31:57', '2017-07-28 17:31:57', 0, NULL, NULL, NULL, 6),
(28, 4, 1, '1', '1', '1', '1', '1', '1', '1', '2017-07-28 17:32:18', '2017-07-28 17:32:18', 0, NULL, NULL, NULL, 6),
(29, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-09 21:55:04', '2017-08-09 21:55:04', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE IF NOT EXISTS `collections` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `bank_id` int(11) NOT NULL DEFAULT '0',
  `type` enum('bir2307','dp','initial','partial','full','none') NOT NULL,
  `amount_paid` double(50,6) NOT NULL DEFAULT '0.000000',
  `with_held` double(50,6) NOT NULL DEFAULT '0.000000',
  `check_number` varchar(255) DEFAULT NULL,
  `check_date` date DEFAULT NULL,
  `status` enum('unverified','verified','void','ongoing','bounced_check') NOT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `date_completed` datetime DEFAULT NULL,
  `payment_mode` enum('cash','check','online','cod','terms') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `quotation_id`, `user_id`, `bank_id`, `type`, `amount_paid`, `with_held`, `check_number`, `check_date`, `status`, `date_deleted`, `date_updated`, `created`, `modified`, `date_completed`, `payment_mode`) VALUES
(3, 47, 4, 1, 'dp', 111.000000, 111.000000, '0', NULL, 'unverified', NULL, NULL, '2017-08-09 22:20:49', '2017-08-09 22:20:49', NULL, 'online'),
(4, 62, 4, 0, 'none', 0.000000, 0.000000, '0', NULL, 'unverified', NULL, NULL, '2017-08-19 20:20:15', '2017-08-19 20:20:15', NULL, 'terms'),
(5, 64, 4, 0, 'dp', 11.000000, 11.000000, '0', NULL, 'unverified', NULL, NULL, '2017-08-26 01:26:54', '2017-08-26 01:26:54', NULL, 'cash'),
(6, 67, 4, 0, 'dp', 11.000000, 11.000000, '0', NULL, 'unverified', NULL, NULL, '2017-08-26 01:32:36', '2017-08-26 01:32:36', NULL, 'cash'),
(7, 68, 4, 2, 'dp', 11.000000, 11.000000, '0', NULL, 'unverified', NULL, NULL, '2017-09-05 00:48:45', '2017-09-05 00:48:45', NULL, 'online'),
(8, 70, 4, 1, 'dp', 1.000000, 0.000000, '1', '2017-09-15', 'unverified', NULL, NULL, '2017-09-05 23:36:52', '2017-09-05 23:36:52', NULL, 'check'),
(9, 70, 4, 1, 'dp', 11.000000, 11.000000, '11', '2017-09-13', 'unverified', NULL, NULL, '2017-09-05 23:41:36', '2017-09-05 23:41:36', NULL, 'check'),
(10, 69, 4, 1, 'dp', 1.000000, 0.000000, '0', NULL, 'void', NULL, NULL, '2017-09-06 01:00:18', '2017-09-23 12:23:28', NULL, 'online'),
(11, 68, 4, 1, 'dp', 1.000000, 0.000000, '0', NULL, 'unverified', NULL, NULL, '2017-09-06 01:04:09', '2017-09-06 01:04:09', NULL, 'online'),
(12, 69, 4, 0, 'none', 0.000000, 0.000000, '0', NULL, 'unverified', NULL, NULL, '2017-09-06 01:05:41', '2017-09-06 01:05:41', NULL, 'terms'),
(13, 69, 4, 0, 'dp', 1.000000, 1.000000, '0', NULL, 'verified', NULL, NULL, '2017-09-06 01:05:58', '2017-09-06 01:05:58', NULL, 'cash'),
(14, 47, 4, 1, 'dp', 1.000000, 1.000000, '0', NULL, 'unverified', NULL, NULL, '2017-09-06 01:07:18', '2017-09-06 01:07:18', NULL, 'online'),
(15, 69, 4, 2, 'dp', 1.000000, 1.000000, '0', NULL, 'verified', NULL, NULL, '2017-09-06 01:11:28', '2017-09-06 01:11:28', NULL, 'online');

-- --------------------------------------------------------

--
-- Table structure for table `collection_papers`
--

CREATE TABLE IF NOT EXISTS `collection_papers` (
  `id` int(11) NOT NULL,
  `ref_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ref_date` datetime NOT NULL,
  `amount` float(30,15) NOT NULL DEFAULT '0.000000000000000',
  `accounting_paper_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('pending','onhand') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending' COMMENT '''pending'',''onhand''',
  `quotation_id` int(11) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection_schedules`
--

CREATE TABLE IF NOT EXISTS `collection_schedules` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL DEFAULT '0',
  `collection_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT 'collector',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `onhand` int(11) NOT NULL DEFAULT '0' COMMENT '1 or 0',
  `officer_remarks` longtext,
  `agent_instruction` longtext,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('for_collection','collected','cancelled','rescheduled') NOT NULL,
  `collection_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collection_schedules`
--

INSERT INTO `collection_schedules` (`id`, `quotation_id`, `collection_id`, `user_id`, `created_by`, `onhand`, `officer_remarks`, `agent_instruction`, `created`, `modified`, `status`, `collection_date`) VALUES
(16, 69, 0, 6, 4, 0, NULL, 'asd', '2017-09-06 13:43:52', '2017-09-08 23:27:58', 'for_collection', '2017-09-26 13:45:00'),
(17, 69, 0, 7, 4, 0, NULL, 'dqwe', '2017-09-08 22:27:19', '2017-09-08 23:27:02', 'cancelled', '2017-09-11 22:30:00'),
(18, 69, 0, 0, 0, 0, NULL, NULL, '2017-09-08 23:26:06', '2017-09-08 23:26:06', 'cancelled', '0000-00-00 00:00:00'),
(19, 69, 0, 0, 0, 0, NULL, NULL, '2017-09-08 23:26:08', '2017-09-08 23:26:08', 'cancelled', '0000-00-00 00:00:00'),
(20, 69, 0, 0, 0, 0, NULL, NULL, '2017-09-08 23:26:21', '2017-09-08 23:26:21', 'for_collection', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_papers`
--

CREATE TABLE IF NOT EXISTS `delivery_papers` (
  `id` int(11) NOT NULL,
  `dr_paper_id` int(11) NOT NULL DEFAULT '0',
  `quotation_id` int(11) NOT NULL DEFAULT '0',
  `date_needed` date DEFAULT NULL,
  `date_acquired` datetime DEFAULT NULL,
  `date_processed` datetime DEFAULT NULL,
  `status` enum('pending','processed','acquired') NOT NULL DEFAULT 'pending',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_papers`
--

INSERT INTO `delivery_papers` (`id`, `dr_paper_id`, `quotation_id`, `date_needed`, `date_acquired`, `date_processed`, `status`, `created`, `modified`, `user_id`) VALUES
(1, 1, 69, '2017-09-19', NULL, NULL, 'pending', '2017-09-08 02:22:08', '2017-09-08 02:22:08', 4),
(2, 1, 68, '2017-09-15', NULL, NULL, 'pending', '2017-09-08 02:28:42', '2017-09-08 02:28:42', 4),
(3, 2, 69, '2017-09-13', NULL, NULL, 'pending', '2017-09-08 21:00:59', '2017-09-08 21:00:59', 4),
(4, 1, 71, '2017-09-07', NULL, NULL, 'pending', '2017-09-08 21:30:51', '2017-09-08 21:30:51', 4),
(5, 1, 71, '2017-09-21', '2017-09-21 00:00:00', NULL, 'pending', '2017-09-08 21:33:24', '2017-09-08 21:33:24', 4),
(6, 2, 71, '2017-09-27', NULL, NULL, 'pending', '2017-09-22 15:50:48', '2017-09-22 15:50:48', 4);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_schedules`
--

CREATE TABLE IF NOT EXISTS `delivery_schedules` (
  `id` int(11) NOT NULL,
  `dr_number` varchar(255) NOT NULL,
  `status` enum('ongoing','pending','approved','scheduled','delivered') NOT NULL DEFAULT 'ongoing',
  `delivery_date` date DEFAULT NULL,
  `delivery_time` time DEFAULT NULL,
  `quotation_id` int(11) NOT NULL DEFAULT '0',
  `approved_by` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_schedules`
--

INSERT INTO `delivery_schedules` (`id`, `dr_number`, `status`, `delivery_date`, `delivery_time`, `quotation_id`, `approved_by`, `created`, `modified`) VALUES
(3, '1910117090707', 'approved', '2017-09-11', '01:00:00', 69, 0, '2017-09-07 01:00:07', '2017-09-23 11:32:47'),
(4, '7022217090722', 'ongoing', '2017-09-14', '13:00:00', 71, 0, '2017-09-07 22:15:22', '2017-09-07 22:15:22'),
(5, '121617092239', 'ongoing', '2017-08-24', '14:12:00', 65, 0, '2017-09-22 16:37:39', '2017-09-22 16:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_sched_products`
--

CREATE TABLE IF NOT EXISTS `delivery_sched_products` (
  `id` int(11) NOT NULL,
  `delivery_schedule_id` int(11) NOT NULL,
  `quotation_product_id` int(11) NOT NULL,
  `status` enum('pending','processed','delivered') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `requested_qty` int(11) NOT NULL DEFAULT '0',
  `actual_qty` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_sched_products`
--

INSERT INTO `delivery_sched_products` (`id`, `delivery_schedule_id`, `quotation_product_id`, `status`, `created`, `modified`, `requested_qty`, `actual_qty`) VALUES
(1, 3, 47, 'pending', '2017-09-07 01:00:07', '2017-09-23 11:14:25', 11, 1),
(2, 3, 45, 'pending', '2017-09-07 01:53:56', '2017-09-07 01:53:56', 11, 0),
(3, 3, 47, 'pending', '2017-09-07 01:54:58', '2017-09-07 01:54:58', 11, 0),
(4, 4, 52, 'pending', '2017-09-07 22:15:22', '2017-09-07 22:15:22', 1, 1),
(5, 3, 49, 'pending', '2017-09-07 22:42:55', '2017-09-07 22:42:55', 11, 0),
(6, 3, 49, 'pending', '2017-09-07 22:52:03', '2017-09-07 22:52:03', 11, 11),
(7, 3, 45, 'pending', '2017-09-07 23:30:55', '2017-09-07 23:30:55', 11, 0),
(8, 3, 47, 'pending', '2017-09-07 23:31:22', '2017-09-07 23:31:22', 11, 0),
(9, 3, 50, 'pending', '2017-09-07 23:38:36', '2017-09-07 23:38:36', 11, 0),
(10, 5, 23, 'pending', '2017-09-22 16:37:39', '2017-09-22 16:37:39', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created`, `modified`) VALUES
(1, 'IT Department', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Sales Department', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Proprietor', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Marketing Department', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Design Department', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Purchasing (Supply)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Purchasing (Raw)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Logistics - Warehouse (Raw)', '2017-09-03 23:15:01', '2017-09-03 23:15:01'),
(9, 'Logistics - Warehouse (Supply)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Accounting Department', '2017-09-05 22:18:10', '2017-09-05 22:18:10'),
(11, 'Production Department', '2017-09-07 23:43:40', '2017-09-07 23:43:40'),
(12, 'Human Resource', '2017-09-22 09:52:13', '2017-09-22 09:52:13'),
(13, 'Logistics', '2017-09-22 16:55:59', '2017-09-22 16:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `dr_papers`
--

CREATE TABLE IF NOT EXISTS `dr_papers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_papers`
--

INSERT INTO `dr_papers` (`id`, `name`, `created`, `modified`) VALUES
(1, 'gate pass', '2017-09-08 01:55:51', '2017-09-08 01:55:51'),
(2, 'building permit', '2017-09-08 01:58:36', '2017-09-08 01:58:36'),
(3, 'sanitary permit', '2017-09-08 02:00:44', '2017-09-08 02:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `erp_permissions`
--

CREATE TABLE IF NOT EXISTS `erp_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_locations`
--

CREATE TABLE IF NOT EXISTS `inv_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_locations`
--

INSERT INTO `inv_locations` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Main Warehouse', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Main Showroom', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Makati Showroom', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'BGC Showroom', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inv_logs`
--

CREATE TABLE IF NOT EXISTS `inv_logs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `inv_location_id` int(11) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL DEFAULT '0',
  `released_to` int(11) NOT NULL DEFAULT '0',
  `received_from` int(11) NOT NULL DEFAULT '0',
  `quotation_product_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_requests`
--

CREATE TABLE IF NOT EXISTS `job_requests` (
  `id` int(11) NOT NULL,
  `jr_number` varchar(100) NOT NULL,
  `status` enum('pending','ongoing','accomplished') NOT NULL DEFAULT 'pending',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_requests`
--

INSERT INTO `job_requests` (`id`, `jr_number`, `status`, `created`, `modified`) VALUES
(70, 'JECJR-7760692', 'pending', '2017-08-21 22:51:13', '2017-08-21 22:51:13'),
(71, 'JECJR-7036509', 'accomplished', '2017-08-22 20:17:00', '2017-08-24 22:37:45'),
(72, 'JECJR-7833255', 'accomplished', '2017-08-26 00:48:21', '2017-08-26 01:00:16'),
(73, 'JECJR-8402530', 'pending', '2017-09-05 00:45:41', '2017-09-05 00:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `jr_products`
--

CREATE TABLE IF NOT EXISTS `jr_products` (
  `id` int(11) NOT NULL,
  `quotation_product_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT 'designer_id',
  `date_assigned` datetime DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `job_request_id` int(11) NOT NULL DEFAULT '0',
  `floor_plan_details` longtext,
  `status` enum('pending','ongoing','declined','revised','accomplished','cancelled','onhold') NOT NULL,
  `date_ongoing` datetime NOT NULL,
  `date_declined` datetime NOT NULL,
  `date_cancelled` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `date_finished` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jr_products`
--

INSERT INTO `jr_products` (`id`, `quotation_product_id`, `user_id`, `date_assigned`, `deadline`, `job_request_id`, `floor_plan_details`, `status`, `date_ongoing`, `date_declined`, `date_cancelled`, `created`, `modified`, `date_finished`) VALUES
(9, 23, 0, NULL, NULL, 70, NULL, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-21 23:08:52', '2017-08-21 23:08:52', NULL),
(10, 24, 11, '2017-08-22 00:15:41', '2017-08-30 00:00:00', 70, NULL, 'ongoing', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-21 23:08:52', '2017-09-22 16:01:12', NULL),
(11, 21, 0, NULL, NULL, 71, NULL, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-22 20:17:00', '2017-08-22 20:17:00', NULL),
(12, 22, 11, '2017-08-22 20:18:09', '2017-08-30 00:00:00', 71, NULL, 'ongoing', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-22 20:17:01', '2017-08-24 22:23:02', NULL),
(13, 25, 11, '2017-08-22 20:18:14', '2017-08-24 00:00:00', 71, NULL, 'accomplished', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-22 20:17:01', '2017-08-24 22:37:45', NULL),
(14, 0, 0, NULL, NULL, 0, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-24 22:02:08', '2017-08-24 22:02:08', NULL),
(15, 0, 0, NULL, NULL, 0, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-24 22:02:10', '2017-08-24 22:02:10', NULL),
(16, 0, 0, NULL, NULL, 0, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-24 22:02:11', '2017-08-24 22:02:11', NULL),
(17, 0, 0, NULL, NULL, 0, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-24 22:02:23', '2017-08-24 22:02:23', NULL),
(18, 0, 0, NULL, NULL, 0, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-24 22:02:39', '2017-08-24 22:02:39', NULL),
(19, 0, 0, NULL, NULL, 0, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-24 22:02:40', '2017-08-24 22:02:40', NULL),
(20, 0, 0, NULL, NULL, 0, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-24 22:03:09', '2017-08-24 22:03:09', NULL),
(21, 0, 0, NULL, NULL, 0, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-24 22:04:15', '2017-08-24 22:04:15', NULL),
(22, 0, 0, NULL, NULL, 0, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-24 22:04:15', '2017-08-24 22:04:15', NULL),
(23, 0, 0, NULL, NULL, 0, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-24 22:04:16', '2017-08-24 22:04:16', NULL),
(24, 0, 0, NULL, NULL, 0, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-24 22:04:16', '2017-08-24 22:04:16', NULL),
(25, 0, 0, NULL, NULL, 0, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-24 22:04:16', '2017-08-24 22:04:16', NULL),
(26, 26, 11, '2017-08-26 00:55:21', '2017-09-09 00:00:00', 72, NULL, 'accomplished', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-26 00:48:22', '2017-08-26 01:00:16', NULL),
(27, 27, 0, NULL, NULL, 72, NULL, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-26 00:48:22', '2017-08-26 00:48:22', NULL),
(28, 0, 0, NULL, '2017-08-30 00:00:00', 72, 'drawing sample floor plan', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-26 00:48:47', '2017-08-26 00:49:00', NULL),
(29, 28, 0, NULL, NULL, 72, NULL, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-08-26 00:50:03', '2017-08-26 00:50:03', NULL),
(30, 45, 0, NULL, NULL, 73, NULL, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-09-05 00:50:32', '2017-09-05 00:50:32', NULL),
(31, 47, 0, NULL, '2017-09-28 00:00:00', 73, NULL, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-09-05 00:50:32', '2017-09-05 00:51:19', NULL),
(32, 48, 0, NULL, '2017-09-09 00:00:00', 73, NULL, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-09-05 00:50:32', '2017-09-05 00:51:23', NULL),
(33, 49, 0, NULL, NULL, 73, NULL, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-09-05 00:50:32', '2017-09-05 00:50:32', NULL),
(34, 50, 0, NULL, '2017-09-14 00:00:00', 73, NULL, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2017-09-05 00:50:32', '2017-09-05 00:51:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jr_uploads`
--

CREATE TABLE IF NOT EXISTS `jr_uploads` (
  `id` int(11) NOT NULL,
  `jr_product_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `viewed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jr_uploads`
--

INSERT INTO `jr_uploads` (`id`, `jr_product_id`, `file`, `created`, `modified`, `viewed`) VALUES
(14, 12, 'D:\\xampp\\htdocs\\app\\webroot\\job_request_product/12/24_08_2017_21_24_26_dec.pdf', '2017-08-24 21:24:26', '2017-08-24 21:24:26', 0),
(15, 12, 'D:\\xampp\\htdocs\\app\\webroot\\job_request_product/12/24_08_2017_21_24_26_feb.pdf', '2017-08-24 21:24:26', '2017-08-24 21:24:26', 0),
(16, 12, '/home2/jecamsco/public_html/crm/app/webroot/job_request_product/12/22_09_2017_16_04_27_M-1.pdf', '2017-09-22 16:04:27', '2017-09-22 16:04:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jr_work_statuses`
--

CREATE TABLE IF NOT EXISTS `jr_work_statuses` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `minutes` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `jr_product_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jr_work_statuses`
--

INSERT INTO `jr_work_statuses` (`id`, `status`, `minutes`, `created`, `modified`, `jr_product_id`) VALUES
(1, 'start', 0, '2017-08-24 22:00:20', '2017-08-24 22:00:20', 12),
(2, 'start', 0, '2017-08-24 22:02:08', '2017-08-24 22:02:08', 12),
(3, 'start', 0, '2017-08-24 22:02:10', '2017-08-24 22:02:10', 12),
(4, 'start', 0, '2017-08-24 22:02:11', '2017-08-24 22:02:11', 12),
(5, 'start', 0, '2017-08-24 22:02:23', '2017-08-24 22:02:23', 12),
(6, 'start', 0, '2017-08-24 22:02:39', '2017-08-24 22:02:39', 12),
(7, 'start', 0, '2017-08-24 22:02:40', '2017-08-24 22:02:40', 12),
(8, 'start', 0, '2017-08-24 22:03:09', '2017-08-24 22:03:09', 12),
(9, 'start', 0, '2017-08-24 22:04:14', '2017-08-24 22:04:14', 12),
(10, 'start', 0, '2017-08-24 22:04:15', '2017-08-24 22:04:15', 12),
(11, 'start', 0, '2017-08-24 22:04:16', '2017-08-24 22:04:16', 12),
(12, 'start', 0, '2017-08-24 22:04:16', '2017-08-24 22:04:16', 12),
(13, 'start', 0, '2017-08-24 22:04:16', '2017-08-24 22:04:16', 12),
(14, 'start', 0, '2017-08-24 22:04:39', '2017-08-24 22:04:39', 12),
(15, 'start', 0, '2017-08-24 22:05:46', '2017-08-24 22:05:46', 13),
(16, 'ongoing', 0, '2017-08-24 22:06:44', '2017-08-24 22:06:44', 12),
(17, 'onhold', 0, '2017-08-24 22:21:26', '2017-08-24 22:21:26', 12),
(18, 'ongoing', 0, '2017-08-24 22:22:57', '2017-08-24 22:22:57', 12),
(19, 'accomplished', 0, '2017-08-24 22:23:02', '2017-08-24 22:23:02', 12),
(20, 'ongoing', 0, '2017-08-24 22:37:24', '2017-08-24 22:37:24', 13),
(21, 'onhold', 0, '2017-08-24 22:37:39', '2017-08-24 22:37:39', 13),
(22, 'ongoing', 0, '2017-08-24 22:37:43', '2017-08-24 22:37:43', 13),
(23, 'accomplished', 0, '2017-08-24 22:37:45', '2017-08-24 22:37:45', 13),
(24, 'ongoing', 0, '2017-08-24 22:40:08', '2017-08-24 22:40:08', 10),
(25, 'ongoing', 0, '2017-08-26 00:57:45', '2017-08-26 00:57:45', 26),
(26, 'onhold', 0, '2017-08-26 00:58:18', '2017-08-26 00:58:18', 26),
(27, 'ongoing', 0, '2017-08-26 00:58:33', '2017-08-26 00:58:33', 26),
(28, 'accomplished', 0, '2017-08-26 01:00:16', '2017-08-26 01:00:16', 26),
(29, 'onhold', 0, '2017-09-22 16:01:03', '2017-09-22 16:01:03', 10),
(30, 'ongoing', 0, '2017-09-22 16:01:12', '2017-09-22 16:01:12', 10);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL,
  `details` varchar(255) DEFAULT NULL,
  `device` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

CREATE TABLE IF NOT EXISTS `markers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES
(1, 'asd', 'asd', 47.6156, -122.344, 'restaurant'),
(2, 'asd', 'asd', 47.6167, -122.345, 'bar'),
(3, 'sdf', 'sdf', 14.7163, 121.039, 'bar');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0' COMMENT 'creator_id',
  `for_who` int(11) NOT NULL DEFAULT '0' COMMENT 'for_id',
  `position_id` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `viewed` int(11) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `description` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `for_who`, `position_id`, `title`, `viewed`, `created`, `modified`, `description`) VALUES
(3, 4, 9, 0, 'Job Request', 0, '2017-07-30 17:42:41', '2017-07-30 17:42:41', 'salesName added deadline for a product in Job Request');

-- --------------------------------------------------------

--
-- Table structure for table `pdfs`
--

CREATE TABLE IF NOT EXISTS `pdfs` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permission_users`
--

CREATE TABLE IF NOT EXISTS `permission_users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `erp_permission_id` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `created`, `modified`) VALUES
(1, 'IT Supervisor', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Sales Executive', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'President', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Marketing Staff', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Sales Coordinator', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Sales Manager', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'IT Staff', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Purchasing Staff(Supply)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Designer Head', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Designer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Purchasing Head (Supply)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Purchasing Staff (Raw)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Purchasing Head (Raw)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Warehouse Head (Raw)', '2017-09-03 23:18:07', '2017-09-03 23:18:07'),
(15, 'Warehouse Head (Supply)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Collection Officer', '2017-09-05 22:18:41', '2017-09-05 22:18:41'),
(17, 'Production Head', '2017-09-07 23:43:59', '2017-09-07 23:43:59'),
(18, 'HR Head', '2017-09-22 09:51:57', '2017-09-22 09:51:57'),
(19, 'Logistics Head', '2017-09-22 16:54:58', '2017-09-22 16:54:58'),
(20, 'Vice President', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `po_products`
--

CREATE TABLE IF NOT EXISTS `po_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `purchase_order_id` int(11) NOT NULL DEFAULT '0',
  `price` float(50,6) NOT NULL,
  `qty` float(13,6) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `quotation_product_id` int(11) NOT NULL DEFAULT '0',
  `quotation_id` int(11) NOT NULL DEFAULT '0',
  `transmittal_id` int(11) NOT NULL DEFAULT '0',
  `demo_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `additional` int(11) NOT NULL DEFAULT '0' COMMENT '1 or 0'
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_products`
--

INSERT INTO `po_products` (`id`, `product_id`, `purchase_order_id`, `price`, `qty`, `created`, `modified`, `quotation_product_id`, `quotation_id`, `transmittal_id`, `demo_id`, `user_id`, `additional`) VALUES
(6, 7, 6, 200.250000, 1.000000, '2017-08-28 10:07:23', '2017-08-28 10:07:23', 25, 64, 0, 0, 12, 0),
(7, 7, 6, 20.000000, 2.000000, '2017-08-28 10:07:57', '2017-08-31 22:37:06', 25, 64, 0, 0, 12, 0),
(8, 7, 6, 200.000000, 2.000000, '2017-08-28 10:09:01', '2017-08-31 22:37:40', 25, 64, 0, 0, 12, 0),
(9, 7, 6, 200.000000, 2.000000, '2017-08-28 10:14:19', '2017-08-31 22:37:44', 25, 64, 0, 0, 12, 0),
(10, 7, 6, 0.000000, 1.000000, '2017-08-28 10:14:43', '2017-08-28 10:14:43', 25, 64, 0, 0, 12, 0),
(11, 7, 6, 0.000000, 1.000000, '2017-08-28 10:15:04', '2017-08-28 10:15:04', 25, 64, 0, 0, 12, 0),
(12, 9, 6, 0.000000, 1.000000, '2017-08-28 10:17:43', '2017-08-28 10:17:43', 25, 64, 0, 0, 12, 0),
(13, 10, 6, 0.000000, 1.000000, '2017-08-28 10:18:05', '2017-08-28 10:18:05', 25, 64, 0, 0, 12, 0),
(14, 9, 6, 0.000000, 1.000000, '2017-08-28 10:18:25', '2017-08-28 10:18:25', 25, 64, 0, 0, 12, 0),
(15, 10, 6, 0.000000, 1.000000, '2017-08-30 21:22:52', '2017-08-30 21:22:52', 25, 64, 0, 0, 12, 0),
(16, 10, 6, 0.000000, 1.000000, '2017-08-30 21:33:17', '2017-08-30 21:33:17', 25, 64, 0, 0, 12, 0),
(17, 9, 6, 0.000000, 2.000000, '2017-08-30 21:33:39', '2017-08-30 21:33:39', 25, 64, 0, 0, 12, 0),
(18, 9, 6, 0.000000, 1.000000, '2017-08-30 21:36:50', '2017-08-30 21:36:50', 25, 64, 0, 0, 12, 0),
(19, 9, 6, 0.000000, 2.000000, '2017-08-30 22:27:07', '2017-08-30 22:27:07', 25, 64, 0, 0, 12, 0),
(20, 10, 6, 0.000000, 1.000000, '2017-08-30 22:30:49', '2017-08-30 22:30:49', 25, 64, 0, 0, 12, 0),
(21, 9, 6, 0.000000, 2.000000, '2017-08-30 22:33:16', '2017-08-30 22:33:16', 25, 64, 0, 0, 12, 1),
(22, 9, 6, 0.000000, 2.000000, '2017-08-30 22:48:20', '2017-08-30 22:48:20', 25, 64, 0, 0, 12, 1),
(23, 9, 6, 200.000000, 3.000000, '2017-08-30 22:49:46', '2017-08-31 01:14:42', 25, 64, 0, 0, 12, 1),
(24, 10, 6, 120.000000, 2.000000, '2017-08-30 22:52:15', '2017-08-31 23:01:48', 25, 64, 0, 0, 12, 1),
(25, 9, 6, 150.000000, 2.000000, '2017-08-31 22:35:09', '2017-08-31 23:05:02', 25, 64, 0, 0, 12, 1),
(26, 10, 6, 200.000000, 1.000000, '2017-09-01 08:48:43', '2017-09-01 08:48:43', 0, 0, 0, 0, 12, 2),
(27, 10, 6, 200.000000, 1.000000, '2017-09-01 08:49:27', '2017-09-01 08:49:27', 0, 0, 0, 0, 12, 2),
(28, 9, 6, 7.000000, 2.000000, '2017-09-01 08:49:54', '2017-09-01 09:47:02', 0, 0, 0, 0, 12, 2),
(29, 13, 8, 11.000000, 1.000000, '2017-09-03 14:32:51', '2017-09-03 14:32:51', 0, 0, 0, 0, 13, 0),
(30, 13, 8, 11.000000, 1.000000, '2017-09-03 14:33:40', '2017-09-03 14:33:40', 0, 0, 0, 0, 13, 0),
(31, 12, 8, 2.000000, 2.000000, '2017-09-03 14:35:35', '2017-09-03 14:35:35', 0, 0, 0, 0, 13, 0),
(32, 12, 8, 2.000000, 1.000000, '2017-09-03 14:40:46', '2017-09-03 14:40:46', 0, 0, 0, 0, 13, 0),
(33, 12, 8, 2.000000, 12.000000, '2017-09-03 14:41:20', '2017-09-03 14:41:20', 0, 0, 0, 0, 13, 0),
(34, 12, 8, 2.000000, 2.000000, '2017-09-03 19:13:18', '2017-09-03 19:13:18', 22, 64, 0, 0, 13, 0),
(35, 12, 8, 2.000000, 2.000000, '2017-09-03 19:16:25', '2017-09-03 19:16:25', 22, 64, 0, 0, 13, 0),
(36, 12, 8, 2.000000, 3.000000, '2017-09-03 19:16:34', '2017-09-03 19:16:34', 22, 64, 0, 0, 13, 0),
(37, 12, 8, 2.000000, 2.000000, '2017-09-03 19:18:11', '2017-09-03 19:18:11', 22, 64, 0, 0, 13, 0),
(38, 11, 7, 22.000000, 1.000000, '2017-09-03 19:20:59', '2017-09-03 19:20:59', 22, 64, 0, 0, 13, 0),
(39, 12, 8, 2.000000, 2.000000, '2017-09-03 19:21:37', '2017-09-03 19:21:37', 22, 64, 0, 0, 13, 0),
(40, 12, 8, 2.000000, 2.000000, '2017-09-03 19:22:49', '2017-09-03 19:22:49', 22, 64, 0, 0, 13, 0),
(41, 12, 8, 2.000000, 2.000000, '2017-09-03 19:23:41', '2017-09-03 19:23:41', 22, 64, 0, 0, 13, 0),
(42, 12, 8, 2.000000, 1.000000, '2017-09-03 19:28:32', '2017-09-03 19:28:32', 22, 64, 0, 0, 13, 0),
(43, 11, 7, 22.000000, 1.000000, '2017-09-03 19:42:30', '2017-09-03 19:42:30', 22, 64, 0, 0, 13, 0),
(44, 11, 7, 22.000000, 1.000000, '2017-09-03 19:44:17', '2017-09-03 19:44:17', 22, 64, 0, 0, 13, 0),
(45, 11, 7, 22.000000, 1.000000, '2017-09-03 19:44:44', '2017-09-03 19:44:44', 24, 65, 0, 0, 13, 0),
(46, 13, 8, 11.000000, 1.000000, '2017-09-03 19:49:45', '2017-09-03 19:49:45', 22, 64, 0, 0, 13, 0),
(47, 11, 9, 22.000000, 1.000000, '2017-09-03 23:21:28', '2017-09-03 23:21:28', 0, 0, 0, 0, 13, 2),
(48, 11, 10, 2500.000000, 1.000000, '2017-09-03 23:22:27', '2017-09-22 16:22:03', 0, 0, 0, 0, 13, 2),
(49, 13, 11, 11.000000, 1.000000, '2017-09-03 23:22:35', '2017-09-03 23:22:35', 0, 0, 0, 0, 13, 2),
(50, 11, 10, 2300.000000, 1.000000, '2017-09-03 23:22:46', '2017-09-22 16:24:07', 0, 0, 0, 0, 13, 2),
(51, 9, 12, 3.000000, 2.000000, '2017-09-05 00:44:01', '2017-09-05 00:44:01', 0, 0, 0, 0, 12, 2),
(52, 9, 12, 3.000000, 2.000000, '2017-09-05 00:50:00', '2017-09-05 00:50:00', 45, 69, 0, 0, 12, 0),
(53, 10, 12, 200.000000, 3.000000, '2017-09-05 00:50:13', '2017-09-05 00:50:13', 47, 69, 0, 0, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `po_product_properties`
--

CREATE TABLE IF NOT EXISTS `po_product_properties` (
  `id` int(11) NOT NULL,
  `po_product_id` int(11) NOT NULL,
  `property` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_product_properties`
--

INSERT INTO `po_product_properties` (`id`, `po_product_id`, `property`, `value`, `created`, `modified`) VALUES
(10, 6, 'color', 'xxx', '2017-08-28 10:07:23', '2017-08-28 10:07:23'),
(11, 7, 'mobile ped', 'yes', '2017-08-28 10:07:57', '2017-08-28 10:07:57'),
(12, 7, 'color', 'blue', '2017-08-28 10:07:57', '2017-08-28 10:07:57'),
(13, 8, 'color', 'xxx', '2017-08-28 10:09:02', '2017-08-28 10:09:02'),
(14, 9, 'color', 'xxx', '2017-08-28 10:14:19', '2017-08-28 10:14:19'),
(15, 10, 'mobile ped', 'yes', '2017-08-28 10:14:44', '2017-08-28 10:14:44'),
(16, 10, 'color', 'blue', '2017-08-28 10:14:44', '2017-08-28 10:14:44'),
(17, 11, 'color', 'xxx', '2017-08-28 10:15:04', '2017-08-28 10:15:04'),
(18, 12, 'mobile ped', 'yes', '2017-08-28 10:17:43', '2017-08-28 10:17:43'),
(19, 12, 'color', 'blue', '2017-08-28 10:17:44', '2017-08-28 10:17:44'),
(20, 13, 'color', 'xxx', '2017-08-28 10:18:06', '2017-08-28 10:18:06'),
(21, 14, 'mobile ped', 'yes', '2017-08-28 10:18:25', '2017-08-28 10:18:25'),
(22, 14, 'color', 'blue', '2017-08-28 10:18:25', '2017-08-28 10:18:25'),
(23, 15, 'color', 'xxx', '2017-08-30 21:22:52', '2017-08-30 21:22:52'),
(24, 16, 'color', 'xxx', '2017-08-30 21:33:17', '2017-08-30 21:33:17'),
(25, 17, 'mobile ped', 'yes', '2017-08-30 21:33:39', '2017-08-30 21:33:39'),
(26, 17, 'color', 'blue', '2017-08-30 21:33:39', '2017-08-30 21:33:39'),
(27, 18, 'mobile ped', 'yes', '2017-08-30 21:36:50', '2017-08-30 21:36:50'),
(28, 18, 'color', 'blue', '2017-08-30 21:36:50', '2017-08-30 21:36:50'),
(29, 19, 'mobile ped', 'yes', '2017-08-30 22:27:07', '2017-08-30 22:27:07'),
(30, 19, 'color', 'blue', '2017-08-30 22:27:07', '2017-08-30 22:27:07'),
(31, 20, 'color', 'xxx', '2017-08-30 22:30:49', '2017-08-30 22:30:49'),
(32, 21, 'mobile ped', 'yes', '2017-08-30 22:33:16', '2017-08-30 22:33:16'),
(33, 21, 'color', 'blue', '2017-08-30 22:33:16', '2017-08-30 22:33:16'),
(34, 22, 'mobile ped', 'yes', '2017-08-30 22:48:20', '2017-08-30 22:48:20'),
(35, 22, 'color', 'blue', '2017-08-30 22:48:20', '2017-08-30 22:48:20'),
(36, 23, 'mobile ped', 'yes', '2017-08-30 22:49:46', '2017-08-30 22:49:46'),
(37, 23, 'color', 'blue', '2017-08-30 22:49:46', '2017-08-30 22:49:46'),
(38, 24, 'color', 'xxx', '2017-08-30 22:52:15', '2017-08-30 22:52:15'),
(39, 24, 'color', 'xxx', '2017-08-30 22:52:15', '2017-08-30 22:52:15'),
(40, 25, 'mobile ped', 'yes', '2017-08-31 22:35:09', '2017-08-31 22:35:09'),
(41, 25, 'color', 'blue', '2017-08-31 22:35:09', '2017-08-31 22:35:09'),
(42, 26, 'color', 'xxx', '2017-09-01 08:48:43', '2017-09-01 08:48:43'),
(43, 27, 'color', 'xxx', '2017-09-01 08:49:27', '2017-09-01 08:49:27'),
(44, 28, 'mobile ped', 'yes', '2017-09-01 08:49:54', '2017-09-01 08:49:54'),
(45, 28, 'color', 'blue', '2017-09-01 08:49:54', '2017-09-01 08:49:54'),
(46, 29, 'color', 'xxx', '2017-09-03 14:32:51', '2017-09-03 14:32:51'),
(47, 30, 'color', 'xxx', '2017-09-03 14:33:40', '2017-09-03 14:33:40'),
(48, 31, 'mobile ped', 'yes', '2017-09-03 14:35:35', '2017-09-03 14:35:35'),
(49, 31, 'color', 'blue', '2017-09-03 14:35:35', '2017-09-03 14:35:35'),
(50, 32, 'mobile ped', 'yes', '2017-09-03 14:40:46', '2017-09-03 14:40:46'),
(51, 32, 'color', 'blue', '2017-09-03 14:40:46', '2017-09-03 14:40:46'),
(52, 33, 'mobile ped', 'yes', '2017-09-03 14:41:20', '2017-09-03 14:41:20'),
(53, 33, 'color', 'blue', '2017-09-03 14:41:20', '2017-09-03 14:41:20'),
(54, 34, 'mobile ped', 'yes', '2017-09-03 19:13:18', '2017-09-03 19:13:18'),
(55, 34, 'color', 'blue', '2017-09-03 19:13:19', '2017-09-03 19:13:19'),
(56, 35, 'mobile ped', 'yes', '2017-09-03 19:16:25', '2017-09-03 19:16:25'),
(57, 35, 'color', 'blue', '2017-09-03 19:16:25', '2017-09-03 19:16:25'),
(58, 36, 'mobile ped', 'yes', '2017-09-03 19:16:34', '2017-09-03 19:16:34'),
(59, 36, 'color', 'blue', '2017-09-03 19:16:34', '2017-09-03 19:16:34'),
(60, 37, 'mobile ped', 'yes', '2017-09-03 19:18:11', '2017-09-03 19:18:11'),
(61, 37, 'color', 'blue', '2017-09-03 19:18:11', '2017-09-03 19:18:11'),
(62, 38, 'color', 'xxx', '2017-09-03 19:20:59', '2017-09-03 19:20:59'),
(63, 39, 'mobile ped', 'yes', '2017-09-03 19:21:37', '2017-09-03 19:21:37'),
(64, 39, 'color', 'blue', '2017-09-03 19:21:37', '2017-09-03 19:21:37'),
(65, 40, 'mobile ped', 'yes', '2017-09-03 19:22:49', '2017-09-03 19:22:49'),
(66, 40, 'color', 'blue', '2017-09-03 19:22:49', '2017-09-03 19:22:49'),
(67, 41, 'mobile ped', 'yes', '2017-09-03 19:23:41', '2017-09-03 19:23:41'),
(68, 41, 'color', 'blue', '2017-09-03 19:23:41', '2017-09-03 19:23:41'),
(69, 42, 'mobile ped', 'yes', '2017-09-03 19:28:33', '2017-09-03 19:28:33'),
(70, 42, 'color', 'blue', '2017-09-03 19:28:33', '2017-09-03 19:28:33'),
(71, 43, 'color', 'xxx', '2017-09-03 19:42:30', '2017-09-03 19:42:30'),
(72, 44, 'color', 'xxx', '2017-09-03 19:44:17', '2017-09-03 19:44:17'),
(73, 45, 'color', 'xxx', '2017-09-03 19:44:44', '2017-09-03 19:44:44'),
(74, 46, 'color', 'xxx', '2017-09-03 19:49:45', '2017-09-03 19:49:45'),
(75, 47, 'color', 'xxx', '2017-09-03 23:21:29', '2017-09-03 23:21:29'),
(76, 48, 'color', 'xxx', '2017-09-03 23:22:28', '2017-09-03 23:22:28'),
(77, 49, 'color', 'xxx', '2017-09-03 23:22:35', '2017-09-03 23:22:35'),
(78, 50, 'color', 'xxx', '2017-09-03 23:22:46', '2017-09-03 23:22:46'),
(79, 51, 'mobile ped', 'yes', '2017-09-05 00:44:01', '2017-09-05 00:44:01'),
(80, 51, 'color', 'blue', '2017-09-05 00:44:02', '2017-09-05 00:44:02'),
(81, 52, 'mobile ped', 'yes', '2017-09-05 00:50:00', '2017-09-05 00:50:00'),
(82, 52, 'color', 'blue', '2017-09-05 00:50:00', '2017-09-05 00:50:00'),
(83, 53, 'color', 'xxx', '2017-09-05 00:50:13', '2017-09-05 00:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `po_raw_requests`
--

CREATE TABLE IF NOT EXISTS `po_raw_requests` (
  `id` int(11) NOT NULL,
  `quotation_product_id` int(11) NOT NULL,
  `jr_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` float(50,6) NOT NULL,
  `status` enum('pending','processed') NOT NULL,
  `date_needed` date DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `processed_qty` float(50,6) NOT NULL DEFAULT '0.000000',
  `released_qty` float(50,6) NOT NULL DEFAULT '0.000000',
  `date_processed` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_raw_requests`
--

INSERT INTO `po_raw_requests` (`id`, `quotation_product_id`, `jr_product_id`, `product_id`, `user_id`, `qty`, `status`, `date_needed`, `created`, `modified`, `processed_qty`, `released_qty`, `date_processed`) VALUES
(1, 21, 9, 7, 3, 1.000000, 'processed', '2017-08-25', '2017-08-25 23:20:31', '2017-09-03 14:32:51', 1.000000, 0.000000, '2017-09-03 14:32:51'),
(2, 0, 0, 0, 0, 0.000000, 'pending', '0000-00-00', '2017-08-25 23:24:07', '2017-08-25 23:24:07', 0.000000, 0.000000, NULL),
(3, 0, 0, 0, 0, 0.000000, 'pending', '0000-00-00', '2017-08-25 23:24:29', '2017-08-25 23:24:29', 0.000000, 0.000000, NULL),
(6, 22, 12, 10, 10, 1.000000, 'processed', '2017-08-25', '2017-08-25 23:54:35', '2017-09-03 14:33:40', 1.000000, 0.000000, '2017-09-03 14:33:40'),
(7, 22, 12, 10, 10, 1.000000, 'processed', '2017-08-16', '2017-08-25 23:55:20', '2017-09-03 19:13:19', 2.000000, 0.000000, '2017-09-03 19:13:19'),
(8, 22, 12, 10, 10, 1.000000, 'processed', '2017-08-23', '2017-08-25 23:56:57', '2017-09-03 19:18:12', 2.000000, 0.000000, '2017-09-03 19:18:12'),
(9, 22, 12, 9, 10, 1.000000, 'processed', '2017-08-23', '2017-08-25 23:57:34', '2017-09-03 19:20:59', 1.000000, 0.000000, '2017-09-03 19:20:59'),
(10, 22, 12, 9, 10, 2.000000, 'processed', '2017-08-25', '2017-08-25 23:58:12', '2017-09-03 19:16:34', 3.000000, 0.000000, '2017-09-03 19:16:34'),
(11, 22, 12, 8, 10, 1.000000, 'processed', '2017-08-16', '2017-08-25 23:59:10', '2017-09-03 19:21:37', 2.000000, 0.000000, '2017-09-03 19:21:37'),
(12, 22, 12, 7, 10, 1.000000, 'processed', '2017-08-17', '2017-08-25 23:59:24', '2017-09-03 19:44:18', 1.000000, 0.000000, '2017-09-03 19:44:18'),
(13, 22, 12, 9, 10, 11.000000, 'processed', '2017-08-24', '2017-08-25 23:59:35', '2017-09-03 19:50:06', 11.000000, 0.000000, '2017-09-03 19:50:06'),
(15, 24, 10, 10, 10, 23.000000, 'pending', '2017-08-24', '2017-08-26 00:12:55', '2017-09-03 19:44:44', 1.000000, 0.000000, '2017-09-03 19:44:44'),
(16, 24, 10, 9, 10, 1.000000, 'pending', '2017-08-31', '2017-08-26 00:14:43', '2017-08-26 00:14:43', 0.000000, 0.000000, NULL),
(18, 24, 10, 10, 10, 1.000000, 'pending', '2017-08-16', '2017-08-26 00:31:30', '2017-08-26 00:31:30', 0.000000, 0.000000, NULL),
(19, 26, 26, 9, 10, 12.000000, 'pending', '2017-08-31', '2017-08-26 00:56:15', '2017-09-03 14:41:20', 13.000000, 0.000000, '2017-09-03 14:41:20'),
(20, 26, 26, 10, 10, 12.000000, 'processed', '2017-08-31', '2017-08-26 00:56:28', '2017-09-03 14:35:35', 2.000000, 0.000000, '2017-09-03 14:35:35'),
(21, 47, 31, 7, 10, 1.000000, 'pending', '2017-09-13', '2017-09-05 00:52:39', '2017-09-05 00:52:39', 0.000000, 0.000000, NULL),
(22, 47, 31, 9, 10, 11.000000, 'pending', '2017-09-19', '2017-09-05 00:52:48', '2017-09-05 00:52:48', 0.000000, 0.000000, NULL),
(23, 47, 31, 8, 10, 1.000000, 'pending', '2017-09-27', '2017-09-05 00:52:55', '2017-09-05 00:52:55', 0.000000, 0.000000, NULL),
(24, 47, 31, 8, 10, 1.000000, 'pending', '2017-09-27', '2017-09-05 00:52:58', '2017-09-05 00:52:58', 0.000000, 0.000000, NULL),
(25, 47, 31, 8, 10, 3.000000, 'pending', '2017-09-27', '2017-09-05 00:53:06', '2017-09-05 00:53:06', 0.000000, 0.000000, NULL),
(26, 47, 31, 8, 10, 3.000000, 'pending', '2017-09-27', '2017-09-05 00:53:07', '2017-09-05 00:53:07', 0.000000, 0.000000, NULL),
(27, 47, 31, 8, 10, 3.000000, 'pending', '2017-09-27', '2017-09-05 00:53:07', '2017-09-05 00:53:07', 0.000000, 0.000000, NULL),
(28, 47, 31, 7, 10, 1.000000, 'pending', '2017-09-13', '2017-09-05 00:55:39', '2017-09-05 00:55:39', 0.000000, 0.000000, NULL),
(29, 47, 31, 9, 10, 1.000000, 'pending', '2017-09-14', '2017-09-05 00:55:51', '2017-09-05 00:55:51', 0.000000, 0.000000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `po_raw_request_properties`
--

CREATE TABLE IF NOT EXISTS `po_raw_request_properties` (
  `id` int(11) NOT NULL,
  `po_raw_request_id` int(11) NOT NULL,
  `property` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_raw_request_properties`
--

INSERT INTO `po_raw_request_properties` (`id`, `po_raw_request_id`, `property`, `value`, `created`, `modified`) VALUES
(1, 12, 'color', 'xxx', '2017-08-25 23:59:24', '2017-08-25 23:59:24'),
(2, 13, 'size', '1950x350x1520 mm ', '2017-08-25 23:59:35', '2017-08-25 23:59:35'),
(3, 13, 'xxxx', 'aaaa', '2017-08-25 23:59:36', '2017-08-25 23:59:36'),
(4, 14, 'color', 'xxx', '2017-08-26 00:12:17', '2017-08-26 00:12:17'),
(5, 15, 'mobile ped', 'yes', '2017-08-26 00:12:55', '2017-08-26 00:12:55'),
(6, 15, 'color', 'blue', '2017-08-26 00:12:55', '2017-08-26 00:12:55'),
(7, 16, 'size', '1950x350x1520 mm ', '2017-08-26 00:14:43', '2017-08-26 00:14:43'),
(8, 16, 'xxxx', 'aaaa', '2017-08-26 00:14:43', '2017-08-26 00:14:43'),
(9, 17, 'mobile ped', 'yes', '2017-08-26 00:15:36', '2017-08-26 00:15:36'),
(10, 17, 'color', 'blue', '2017-08-26 00:15:36', '2017-08-26 00:15:36'),
(11, 18, 'mobile ped', 'yes', '2017-08-26 00:31:30', '2017-08-26 00:31:30'),
(12, 18, 'color', 'blue', '2017-08-26 00:31:30', '2017-08-26 00:31:30'),
(13, 19, 'size', '1950x350x1520 mm ', '2017-08-26 00:56:15', '2017-08-26 00:56:15'),
(14, 19, 'xxxx', 'aaaa', '2017-08-26 00:56:16', '2017-08-26 00:56:16'),
(15, 20, 'mobile ped', 'yes', '2017-08-26 00:56:28', '2017-08-26 00:56:28'),
(16, 20, 'color', 'blue', '2017-08-26 00:56:28', '2017-08-26 00:56:28'),
(17, 21, 'color', 'xxx', '2017-09-05 00:52:39', '2017-09-05 00:52:39'),
(18, 22, 'size', '1950x350x1520 mm ', '2017-09-05 00:52:48', '2017-09-05 00:52:48'),
(19, 22, 'xxxx', 'aaaa', '2017-09-05 00:52:48', '2017-09-05 00:52:48'),
(20, 28, 'color', 'xxx', '2017-09-05 00:55:39', '2017-09-05 00:55:39'),
(21, 29, 'size', '1950x350x1520 mm ', '2017-09-05 00:55:51', '2017-09-05 00:55:51'),
(22, 29, 'xxxx', 'aaaa', '2017-09-05 00:55:51', '2017-09-05 00:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sub_category_id` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `other_info` longtext,
  `type` enum('supply','customized','combination','raw','chopped','office') DEFAULT NULL,
  `sale_price` double(50,6) NOT NULL DEFAULT '0.000000'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `sub_category_id`, `created`, `modified`, `other_info`, `type`, `sale_price`) VALUES
(7, 'WD-1310 Bench', 'WD-1310 Bench.png', '4', '2017-07-17 17:25:59', '2017-08-21 22:21:28', 'asd', 'supply', 0.000000),
(8, 'WD-13166', 'WD-1310 Bench.png', '1', '2017-07-17 17:32:19', '2017-07-17 17:32:19', 'as', 'supply', 0.000000),
(9, 'AST-30123', 'AST-30123.png', '1', '2017-07-17 17:34:35', '2017-07-17 17:34:35', 'Warranty: 6 months', 'customized', 0.000000),
(10, 'CFT-NM1564', '1500306129.png', '4', '2017-07-17 17:36:33', '2017-07-17 17:36:33', 'Prices are included with vat.', 'supply', 2500.000000),
(11, 'as', 'fa43cefa1fc648d91518f2910509f5e7.jpg', '2', '2017-07-17 17:38:44', '2017-07-17 17:38:44', 'asd', NULL, 0.000000),
(12, 'sdf', '9663493_orig.jpg', '1', '2017-07-17 17:40:37', '2017-07-17 17:40:37', 'sdf', NULL, 0.000000),
(13, 'as', '9663493_orig.jpg', '2', '2017-07-17 17:41:44', '2017-07-17 17:41:44', 'as', NULL, 0.000000),
(14, 'sad', '1500306129.jpg', '2', '2017-07-17 17:42:08', '2017-07-17 17:42:08', 'sad', NULL, 0.000000),
(15, 'asd', '1500306220.png', '1', '2017-07-17 17:43:39', '2017-07-17 17:43:39', 'asd', NULL, 0.000000);

-- --------------------------------------------------------

--
-- Table structure for table `product_properties`
--

CREATE TABLE IF NOT EXISTS `product_properties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_properties`
--

INSERT INTO `product_properties` (`id`, `name`, `product_id`, `created`, `modified`) VALUES
(1, 'mobile ped', '10', '2017-07-17 17:44:04', '2017-07-17 17:44:04'),
(2, 'color\r\n', '10', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'size', '9', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'xxxx', '9', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'color', '7', '2017-08-21 22:23:03', '2017-08-21 22:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_sources`
--

CREATE TABLE IF NOT EXISTS `product_sources` (
  `id` int(11) NOT NULL,
  `quotation_product_id` int(11) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL DEFAULT '0',
  `source` enum('po','inventory') NOT NULL,
  `quotation_id` int(11) NOT NULL DEFAULT '0',
  `purchase_order_id` int(11) NOT NULL DEFAULT '0',
  `prod_inv_location_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('pending','approved') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `type` enum('supply','raw') NOT NULL,
  `processed_qty` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_sources`
--

INSERT INTO `product_sources` (`id`, `quotation_product_id`, `qty`, `source`, `quotation_id`, `purchase_order_id`, `prod_inv_location_id`, `status`, `created`, `modified`, `type`, `processed_qty`) VALUES
(1, 27, 1, 'po', 66, 1, 0, 'pending', '2017-08-26 01:10:10', '2017-08-26 01:10:10', 'supply', 0),
(2, 27, 5, 'po', 66, 2, 0, 'pending', '2017-08-26 01:10:39', '2017-08-26 01:10:39', 'supply', 0),
(3, 29, 1, 'inventory', 67, 0, 2, 'pending', '2017-08-26 21:01:52', '2017-08-26 21:01:52', 'supply', 0),
(4, 29, 1, 'inventory', 67, 0, 2, 'pending', '2017-08-26 21:02:24', '2017-08-26 21:02:24', 'supply', 0),
(5, 29, 1, 'inventory', 67, 0, 2, 'pending', '2017-08-26 21:02:48', '2017-08-26 21:02:48', 'supply', 0),
(6, 29, 1, 'inventory', 67, 0, 2, 'pending', '2017-08-26 21:04:34', '2017-08-26 21:04:34', 'supply', 0),
(7, 29, 1, 'inventory', 67, 0, 2, 'pending', '2017-08-26 21:04:53', '2017-08-26 21:04:53', 'supply', 0),
(8, 29, 1, 'inventory', 67, 0, 2, 'pending', '2017-08-26 21:06:01', '2017-08-26 21:06:01', 'supply', 0),
(9, 29, 1, 'inventory', 67, 0, 2, 'pending', '2017-08-26 21:08:45', '2017-08-26 21:08:45', 'supply', 0),
(10, 23, 3, 'po', 65, 3, 0, 'pending', '2017-08-26 21:52:25', '2017-08-26 21:52:25', 'supply', 0),
(11, 21, 2, 'po', 64, 4, 0, 'pending', '2017-08-26 21:57:55', '2017-08-26 21:57:55', 'supply', 0),
(12, 21, 11, 'po', 64, 5, 0, 'pending', '2017-08-26 21:58:10', '2017-08-26 21:58:10', 'supply', 0),
(13, 25, 1, 'po', 64, 6, 0, 'pending', '2017-08-28 10:07:24', '2017-08-28 10:07:24', 'supply', 0),
(14, 25, 2, 'po', 64, 6, 0, 'pending', '2017-08-28 10:14:20', '2017-08-28 10:14:20', 'supply', 0),
(15, 25, 1, 'po', 64, 6, 0, 'pending', '2017-08-28 10:14:44', '2017-08-28 10:14:44', 'supply', 0),
(16, 25, 1, 'po', 64, 6, 0, 'pending', '2017-08-28 10:15:04', '2017-08-28 10:15:04', 'supply', 0),
(17, 25, 1, 'po', 64, 6, 0, 'pending', '2017-08-28 10:17:44', '2017-08-28 10:17:44', 'supply', 0),
(18, 25, 1, 'po', 64, 6, 0, 'pending', '2017-08-28 10:18:06', '2017-08-28 10:18:06', 'supply', 0),
(19, 25, 1, 'po', 64, 6, 0, 'pending', '2017-08-28 10:18:25', '2017-08-28 10:18:25', 'supply', 0),
(20, 25, 1, 'po', 64, 6, 0, 'pending', '2017-08-30 21:22:53', '2017-08-30 21:22:53', 'supply', 0),
(21, 25, 1, 'po', 64, 6, 0, 'pending', '2017-08-30 21:33:17', '2017-08-30 21:33:17', 'supply', 0),
(22, 25, 2, 'po', 64, 6, 0, 'pending', '2017-08-30 21:33:40', '2017-08-30 21:33:40', 'supply', 0),
(23, 25, 1, 'po', 64, 6, 0, 'pending', '2017-08-30 21:36:50', '2017-08-30 21:36:50', 'supply', 0),
(24, 25, 2, 'po', 64, 6, 0, 'pending', '2017-08-30 22:27:07', '2017-08-30 22:27:07', 'supply', 0),
(25, 25, 1, 'po', 64, 6, 0, 'pending', '2017-08-30 22:30:50', '2017-08-30 22:30:50', 'supply', 0),
(26, 25, 2, 'po', 64, 6, 0, 'pending', '2017-08-30 22:33:16', '2017-08-30 22:33:16', 'supply', 0),
(27, 25, 2, 'po', 64, 6, 0, 'pending', '2017-08-30 22:48:20', '2017-08-30 22:48:20', 'supply', 0),
(28, 25, 3, 'po', 64, 6, 0, 'pending', '2017-08-30 22:49:47', '2017-08-30 22:49:47', 'supply', 0),
(29, 25, 2, 'po', 64, 6, 0, 'pending', '2017-08-30 22:52:16', '2017-08-30 22:52:16', 'supply', 0),
(30, 25, 2, 'po', 64, 6, 0, 'pending', '2017-08-31 22:35:10', '2017-08-31 22:35:10', 'supply', 0),
(31, 22, 2, 'po', 64, 8, 0, 'pending', '2017-09-03 19:23:41', '2017-09-03 19:23:41', 'supply', 0),
(32, 22, 1, 'po', 64, 8, 0, 'pending', '2017-09-03 19:28:33', '2017-09-03 19:28:33', 'supply', 0),
(33, 22, 1, 'po', 64, 7, 0, 'pending', '2017-09-03 19:42:30', '2017-09-03 19:42:30', 'supply', 0),
(34, 22, 1, 'po', 64, 7, 0, 'pending', '2017-09-03 19:44:17', '2017-09-03 19:44:17', 'supply', 0),
(35, 24, 1, 'po', 65, 7, 0, 'pending', '2017-09-03 19:44:44', '2017-09-03 19:44:44', 'supply', 0),
(36, 22, 2, 'inventory', 64, 0, 2, 'pending', '2017-09-03 19:45:50', '2017-09-03 19:45:50', 'supply', 0),
(37, 22, 1, 'po', 64, 8, 0, 'pending', '2017-09-03 19:49:45', '2017-09-03 19:49:45', 'raw', 0),
(38, 22, 2, 'inventory', 64, 0, 2, 'pending', '2017-09-03 19:50:05', '2017-09-03 19:50:05', 'raw', 0),
(39, 45, 2, 'po', 69, 12, 0, 'pending', '2017-09-05 00:50:01', '2017-09-05 00:50:01', 'supply', 0),
(40, 47, 3, 'po', 69, 12, 0, 'pending', '2017-09-05 00:50:13', '2017-09-05 00:50:13', 'supply', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_source_properties`
--

CREATE TABLE IF NOT EXISTS `product_source_properties` (
  `id` int(11) NOT NULL,
  `property` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `product_source_id` int(11) NOT NULL,
  `qty` float(50,6) NOT NULL DEFAULT '0.000000',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_source_properties`
--

INSERT INTO `product_source_properties` (`id`, `property`, `value`, `product_source_id`, `qty`, `created`, `modified`) VALUES
(1, 'mobile ped', 'yes', 1, 1.000000, '2017-08-26 01:10:10', '2017-08-26 01:10:10'),
(2, 'color', 'blue', 1, 0.000000, '2017-08-26 01:10:10', '2017-08-26 01:10:10'),
(3, 'color', 'xxx', 2, 3.000000, '2017-08-26 01:10:39', '2017-08-26 01:10:39'),
(4, 'color', 'xxx', 2, 2.000000, '2017-08-26 01:10:40', '2017-08-26 01:10:40'),
(5, 'color', 'green', 3, 1.000000, '2017-08-26 21:01:53', '2017-08-26 21:01:53'),
(6, 'size', 'small', 3, 0.000000, '2017-08-26 21:01:53', '2017-08-26 21:01:53'),
(7, 'color', 'green', 4, 1.000000, '2017-08-26 21:02:24', '2017-08-26 21:02:24'),
(8, 'size', 'small', 4, 0.000000, '2017-08-26 21:02:24', '2017-08-26 21:02:24'),
(9, 'color', 'green', 5, 1.000000, '2017-08-26 21:02:48', '2017-08-26 21:02:48'),
(10, 'size', 'small', 5, 0.000000, '2017-08-26 21:02:48', '2017-08-26 21:02:48'),
(11, 'color', 'green', 6, 1.000000, '2017-08-26 21:04:34', '2017-08-26 21:04:34'),
(12, 'size', 'small', 6, 0.000000, '2017-08-26 21:04:34', '2017-08-26 21:04:34'),
(13, 'color', 'green', 7, 1.000000, '2017-08-26 21:04:53', '2017-08-26 21:04:53'),
(14, 'size', 'small', 7, 0.000000, '2017-08-26 21:04:53', '2017-08-26 21:04:53'),
(15, 'color', 'green', 8, 1.000000, '2017-08-26 21:06:02', '2017-08-26 21:06:02'),
(16, 'size', 'small', 8, 0.000000, '2017-08-26 21:06:02', '2017-08-26 21:06:02'),
(17, 'color', 'green', 9, 1.000000, '2017-08-26 21:08:45', '2017-08-26 21:08:45'),
(18, 'size', 'small', 9, 0.000000, '2017-08-26 21:08:45', '2017-08-26 21:08:45'),
(19, 'mobile ped', 'yes', 10, 2.000000, '2017-08-26 21:52:25', '2017-08-26 21:52:25'),
(20, 'color', 'blue', 10, 1.000000, '2017-08-26 21:52:25', '2017-08-26 21:52:25'),
(21, 'mobile ped', 'yes', 11, 1.000000, '2017-08-26 21:57:55', '2017-08-26 21:57:55'),
(22, 'color', 'blue', 11, 1.000000, '2017-08-26 21:57:56', '2017-08-26 21:57:56'),
(23, 'color', 'xxx', 12, 11.000000, '2017-08-26 21:58:10', '2017-08-26 21:58:10'),
(24, 'color', 'xxx', 13, 1.000000, '2017-08-28 10:07:24', '2017-08-28 10:07:24'),
(25, 'color', 'xxx', 14, 2.000000, '2017-08-28 10:14:20', '2017-08-28 10:14:20'),
(26, 'mobile ped', 'yes', 15, 1.000000, '2017-08-28 10:14:44', '2017-08-28 10:14:44'),
(27, 'color', 'blue', 15, 0.000000, '2017-08-28 10:14:44', '2017-08-28 10:14:44'),
(28, 'color', 'xxx', 16, 1.000000, '2017-08-28 10:15:04', '2017-08-28 10:15:04'),
(29, 'mobile ped', 'yes', 17, 1.000000, '2017-08-28 10:17:44', '2017-08-28 10:17:44'),
(30, 'color', 'blue', 17, 0.000000, '2017-08-28 10:17:44', '2017-08-28 10:17:44'),
(31, 'color', 'xxx', 18, 1.000000, '2017-08-28 10:18:06', '2017-08-28 10:18:06'),
(32, 'mobile ped', 'yes', 19, 1.000000, '2017-08-28 10:18:25', '2017-08-28 10:18:25'),
(33, 'color', 'blue', 19, 0.000000, '2017-08-28 10:18:25', '2017-08-28 10:18:25'),
(34, 'color', 'xxx', 20, 1.000000, '2017-08-30 21:22:53', '2017-08-30 21:22:53'),
(35, 'color', 'xxx', 21, 1.000000, '2017-08-30 21:33:17', '2017-08-30 21:33:17'),
(36, 'mobile ped', 'yes', 22, 1.000000, '2017-08-30 21:33:40', '2017-08-30 21:33:40'),
(37, 'color', 'blue', 22, 1.000000, '2017-08-30 21:33:40', '2017-08-30 21:33:40'),
(38, 'mobile ped', 'yes', 23, 1.000000, '2017-08-30 21:36:51', '2017-08-30 21:36:51'),
(39, 'color', 'blue', 23, 0.000000, '2017-08-30 21:36:51', '2017-08-30 21:36:51'),
(40, 'mobile ped', 'yes', 24, 1.000000, '2017-08-30 22:27:07', '2017-08-30 22:27:07'),
(41, 'color', 'blue', 24, 1.000000, '2017-08-30 22:27:07', '2017-08-30 22:27:07'),
(42, 'color', 'xxx', 25, 1.000000, '2017-08-30 22:30:50', '2017-08-30 22:30:50'),
(43, 'mobile ped', 'yes', 26, 1.000000, '2017-08-30 22:33:16', '2017-08-30 22:33:16'),
(44, 'color', 'blue', 26, 1.000000, '2017-08-30 22:33:16', '2017-08-30 22:33:16'),
(45, 'mobile ped', 'yes', 27, 1.000000, '2017-08-30 22:48:21', '2017-08-30 22:48:21'),
(46, 'color', 'blue', 27, 1.000000, '2017-08-30 22:48:21', '2017-08-30 22:48:21'),
(47, 'mobile ped', 'yes', 28, 1.000000, '2017-08-30 22:49:47', '2017-08-30 22:49:47'),
(48, 'color', 'blue', 28, 2.000000, '2017-08-30 22:49:47', '2017-08-30 22:49:47'),
(49, 'color', 'xxx', 29, 1.000000, '2017-08-30 22:52:16', '2017-08-30 22:52:16'),
(50, 'color', 'xxx', 29, 1.000000, '2017-08-30 22:52:16', '2017-08-30 22:52:16'),
(51, 'mobile ped', 'yes', 30, 1.000000, '2017-08-31 22:35:10', '2017-08-31 22:35:10'),
(52, 'color', 'blue', 30, 1.000000, '2017-08-31 22:35:10', '2017-08-31 22:35:10'),
(53, 'mobile ped', 'yes', 31, 1.000000, '2017-09-03 19:23:42', '2017-09-03 19:23:42'),
(54, 'color', 'blue', 31, 1.000000, '2017-09-03 19:23:42', '2017-09-03 19:23:42'),
(55, 'mobile ped', 'yes', 32, 1.000000, '2017-09-03 19:28:33', '2017-09-03 19:28:33'),
(56, 'color', 'blue', 32, 0.000000, '2017-09-03 19:28:33', '2017-09-03 19:28:33'),
(57, 'color', 'xxx', 33, 1.000000, '2017-09-03 19:42:30', '2017-09-03 19:42:30'),
(58, 'color', 'xxx', 34, 1.000000, '2017-09-03 19:44:17', '2017-09-03 19:44:17'),
(59, 'color', 'xxx', 35, 1.000000, '2017-09-03 19:44:44', '2017-09-03 19:44:44'),
(60, 'color', 'green', 36, 1.000000, '2017-09-03 19:45:50', '2017-09-03 19:45:50'),
(61, 'size', 'small', 36, 1.000000, '2017-09-03 19:45:50', '2017-09-03 19:45:50'),
(62, 'color', 'xxx', 37, 1.000000, '2017-09-03 19:49:45', '2017-09-03 19:49:45'),
(63, 'color', 'green', 38, 1.000000, '2017-09-03 19:50:05', '2017-09-03 19:50:05'),
(64, 'size', 'small', 38, 1.000000, '2017-09-03 19:50:05', '2017-09-03 19:50:05'),
(65, 'mobile ped', 'yes', 39, 1.000000, '2017-09-05 00:50:01', '2017-09-05 00:50:01'),
(66, 'color', 'blue', 39, 1.000000, '2017-09-05 00:50:01', '2017-09-05 00:50:01'),
(67, 'color', 'xxx', 40, 3.000000, '2017-09-05 00:50:13', '2017-09-05 00:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_suppliers`
--

CREATE TABLE IF NOT EXISTS `product_suppliers` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `note` longtext,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `product_code` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_suppliers`
--

INSERT INTO `product_suppliers` (`id`, `product_id`, `supplier_id`, `note`, `created`, `modified`, `product_code`) VALUES
(9, 10, 2, 'qweqwe', '2017-08-21 22:01:13', '2017-08-21 22:01:13', 'sasadasd'),
(10, 7, 2, 'mm', '2017-08-21 22:27:24', '2017-08-21 22:27:24', 'mm'),
(11, 7, 9, 'no notes', '2017-09-01 13:17:46', '2017-09-01 13:17:46', 'a'),
(12, 10, 10, 'ss', '2017-09-02 01:22:49', '2017-09-02 01:22:49', 'ss'),
(13, 7, 10, '11', '2017-09-02 01:23:05', '2017-09-02 01:23:05', '11');

-- --------------------------------------------------------

--
-- Table structure for table `product_supplier_properties`
--

CREATE TABLE IF NOT EXISTS `product_supplier_properties` (
  `id` int(11) NOT NULL,
  `product_supplier_id` int(11) NOT NULL,
  `property` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `price` float(50,6) NOT NULL DEFAULT '0.000000',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_supplier_properties`
--

INSERT INTO `product_supplier_properties` (`id`, `product_supplier_id`, `property`, `value`, `price`, `created`, `modified`) VALUES
(1, 1, 'color', 'green', 20.000000, '2017-08-19 21:46:53', '2017-08-19 21:46:53'),
(2, 1, 'size', 'small', 10.000000, '2017-08-19 21:47:16', '2017-08-19 21:47:16'),
(9, 6, 'mobile ped', 'yes', 9999.000000, '2017-08-21 20:38:42', '2017-08-21 20:38:42'),
(10, 6, 'color', 'blue', 9999999.000000, '2017-08-21 20:38:42', '2017-08-21 20:38:42'),
(11, 9, 'mobile ped', 'yes', 2.000000, '2017-08-21 22:01:13', '2017-08-21 22:01:13'),
(12, 9, 'color', 'blue', 1.000000, '2017-08-21 22:01:13', '2017-08-21 22:01:13'),
(13, 10, 'color', 'xxx', 200.000000, '2017-08-21 22:27:24', '2017-08-21 22:27:24'),
(14, 11, 'color', 'xxx', 22.000000, '2017-09-01 13:17:46', '2017-09-01 13:17:46'),
(15, 12, 'mobile ped', 'yes', 1.000000, '2017-09-02 01:22:49', '2017-09-02 01:22:49'),
(16, 12, 'color', 'blue', 1.000000, '2017-09-02 01:22:49', '2017-09-02 01:22:49'),
(17, 13, 'color', 'xxx', 11.000000, '2017-09-02 01:23:05', '2017-09-02 01:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_values`
--

CREATE TABLE IF NOT EXISTS `product_values` (
  `id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `price` double(50,6) DEFAULT NULL,
  `default` int(11) DEFAULT NULL,
  `product_property_id` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_values`
--

INSERT INTO `product_values` (`id`, `value`, `price`, `default`, `product_property_id`, `created`, `modified`) VALUES
(1, 'yes', 2541.050000, 1, '1', '2017-07-17 17:44:19', '2017-07-17 17:44:19'),
(2, 'blue', 6522.000000, 0, '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '1950x350x1520 mm ', 2000.000000, 1, '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'aaaa', 122.000000, 0, '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'xxx', 11.000000, NULL, '5', '2017-08-21 22:25:44', '2017-08-21 22:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `prod_inv_combo`
--

CREATE TABLE IF NOT EXISTS `prod_inv_combo` (
  `id` int(11) NOT NULL,
  `prod_inv_location_id` int(11) NOT NULL DEFAULT '0',
  `qty` float(13,6) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prod_inv_conditions`
--

CREATE TABLE IF NOT EXISTS `prod_inv_conditions` (
  `id` int(11) NOT NULL,
  `prod_inv_location_property_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `conditions` enum('good','for_repair','junk','chopped') NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prod_inv_locations`
--

CREATE TABLE IF NOT EXISTS `prod_inv_locations` (
  `id` int(11) NOT NULL,
  `inv_location_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prod_inv_locations`
--

INSERT INTO `prod_inv_locations` (`id`, `inv_location_id`, `product_id`, `created`, `modified`) VALUES
(1, 2, 9, '2017-08-17 22:04:13', '2017-08-17 22:04:13'),
(2, 1, 9, '2017-08-17 22:04:22', '2017-08-17 22:04:22'),
(3, 1, 10, '2017-08-17 22:04:27', '2017-08-17 22:04:27'),
(4, 1, 8, '2017-09-03 15:00:23', '2017-09-03 15:00:23');

-- --------------------------------------------------------

--
-- Table structure for table `prod_inv_location_properties`
--

CREATE TABLE IF NOT EXISTS `prod_inv_location_properties` (
  `id` int(11) NOT NULL,
  `prod_inv_location_id` int(11) NOT NULL,
  `qty` float(50,6) NOT NULL DEFAULT '0.000000',
  `property` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `prod_inv_combo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prod_inv_location_properties`
--

INSERT INTO `prod_inv_location_properties` (`id`, `prod_inv_location_id`, `qty`, `property`, `value`, `created`, `modified`, `prod_inv_combo`) VALUES
(1, 1, 2.000000, 'color', 'blue', '2017-08-17 22:05:35', '2017-08-17 22:05:35', 0),
(2, 2, 2.000000, 'color', 'green', '2017-08-17 22:05:51', '2017-08-17 22:05:51', 0),
(3, 2, 10.000000, 'size', 'small', '2017-08-17 22:15:12', '2017-08-17 22:15:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE IF NOT EXISTS `purchase_orders` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `po_number` varchar(255) NOT NULL,
  `status` enum('ongoing','pending','approved') NOT NULL,
  `discount` float(50,6) NOT NULL DEFAULT '0.000000',
  `vat_amount` float(50,6) NOT NULL DEFAULT '0.000000',
  `ewt_amount` float(50,6) NOT NULL DEFAULT '0.000000',
  `void_date` datetime DEFAULT NULL,
  `void_reason` longtext,
  `with_held` float(50,6) NOT NULL DEFAULT '0.000000',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `type` enum('raw','supply') NOT NULL,
  `grand_total` float(50,6) NOT NULL DEFAULT '0.000000',
  `total_purchased` float(50,6) NOT NULL DEFAULT '0.000000'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `supplier_id`, `user_id`, `po_number`, `status`, `discount`, `vat_amount`, `ewt_amount`, `void_date`, `void_reason`, `with_held`, `created`, `modified`, `type`, `grand_total`, `total_purchased`) VALUES
(6, 2, 12, 'JEC-1008282307', 'pending', 0.000000, 0.000000, 23.162947, NULL, NULL, 0.000000, '2017-08-28 10:07:23', '2017-09-01 09:56:51', 'supply', 2571.087158, 2594.250000),
(7, 9, 13, 'JEC-0209033831', 'pending', 0.000000, 0.000000, 0.785714, NULL, NULL, 0.000000, '2017-09-03 14:31:38', '2017-09-03 19:54:12', 'raw', 87.214287, 88.000000),
(8, 10, 13, 'JEC-0209031832', 'pending', 0.000000, 0.000000, 0.000000, NULL, NULL, 0.000000, '2017-09-03 14:32:18', '2017-09-03 23:22:11', 'raw', 0.000000, 0.000000),
(9, 9, 13, 'JEC-1109032821', 'pending', 0.000000, 0.000000, 0.000000, NULL, NULL, 0.000000, '2017-09-03 23:21:28', '2017-09-03 23:22:17', 'raw', 0.000000, 0.000000),
(10, 9, 13, 'JEC-1109032722', 'ongoing', 0.000000, 0.000000, 42.857143, NULL, NULL, 0.000000, '2017-09-03 23:22:27', '2017-09-22 16:24:07', 'raw', 4757.143066, 4800.000000),
(11, 10, 13, 'JEC-1109033522', 'ongoing', 0.000000, 0.000000, 0.000000, NULL, NULL, 0.000000, '2017-09-03 23:22:35', '2017-09-03 23:22:35', 'raw', 0.000000, 0.000000),
(12, 2, 12, 'JEC-1209050144', 'ongoing', 0.000000, 0.000000, 0.000000, NULL, NULL, 0.000000, '2017-09-05 00:44:01', '2017-09-05 00:44:01', 'supply', 0.000000, 0.000000);

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE IF NOT EXISTS `quotations` (
  `id` int(11) NOT NULL,
  `quote_number` varchar(255) NOT NULL DEFAULT '0',
  `client_id` int(11) NOT NULL DEFAULT '0',
  `team_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `job_request_id` int(11) NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL,
  `status` enum('ongoing','pending','moved','approved','processed','revised','lost','deleted','void') NOT NULL,
  `terms_info` longtext NOT NULL,
  `sub_total` double(50,6) NOT NULL DEFAULT '0.000000',
  `installation_charge` double(50,6) NOT NULL DEFAULT '0.000000',
  `delivery_charge` double(50,6) NOT NULL DEFAULT '0.000000',
  `discount` double(50,6) NOT NULL DEFAULT '0.000000',
  `grand_total` decimal(13,6) NOT NULL DEFAULT '0.000000',
  `type` enum('quotation','fitout') NOT NULL,
  `validity_date` date DEFAULT NULL,
  `bill_ship_address` int(11) NOT NULL DEFAULT '0',
  `bill_address` varchar(255) DEFAULT NULL,
  `bill_geolocation` varchar(255) DEFAULT NULL,
  `bill_latitude` varchar(255) DEFAULT NULL,
  `bill_longitude` varchar(255) DEFAULT NULL,
  `ship_address` varchar(255) DEFAULT NULL,
  `ship_geolocation` varchar(255) DEFAULT NULL,
  `ship_latitude` varchar(255) DEFAULT NULL,
  `ship_longitude` varchar(255) DEFAULT NULL,
  `target_delivery` date DEFAULT NULL,
  `date_moved` datetime DEFAULT NULL,
  `date_processed` datetime DEFAULT NULL,
  `delivery_mode` enum('pickup','deliver') DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `date_deleted_lost` datetime DEFAULT NULL,
  `vat_type` enum('vat inc','zero rated','sales to government','exempt sales reciept') DEFAULT NULL,
  `quotation_term_id` int(11) NOT NULL DEFAULT '0',
  `advance_invoice` int(11) NOT NULL DEFAULT '0' COMMENT '1 or 0',
  `date_approved` datetime DEFAULT NULL,
  `approved_by` int(11) NOT NULL DEFAULT '0',
  `collection_paper_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `quote_number`, `client_id`, `team_id`, `user_id`, `job_request_id`, `subject`, `status`, `terms_info`, `sub_total`, `installation_charge`, `delivery_charge`, `discount`, `grand_total`, `type`, `validity_date`, `bill_ship_address`, `bill_address`, `bill_geolocation`, `bill_latitude`, `bill_longitude`, `ship_address`, `ship_geolocation`, `ship_latitude`, `ship_longitude`, `target_delivery`, `date_moved`, `date_processed`, `delivery_mode`, `created`, `modified`, `date_deleted_lost`, `vat_type`, `quotation_term_id`, `advance_invoice`, `date_approved`, `approved_by`, `collection_paper_id`) VALUES
(47, '4421717073149', 19, 2, 4, 51, 'ssa', 'approved', ' <ol class="terms-and-condition"> <li> <h3>PRICE</h3> <ol> <li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> </li> <li> <h3>AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> </li> <li> <h3>PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol> </li> <li> <h3>DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol> </li> <li> <h3>WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol> </li> <li> <h3>INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <li> <h3>LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol> </li> <li> <h3>PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol> </li> <li> <h3>NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol> </li> </ol> <br> ', 2300.000000, 0.000000, 0.000000, 0.000000, '2300.000000', 'fitout', '2017-08-17', 1, '', 'Diego Silang, Novaliches, Quezon City, Metro Manila, Philippines', '14.727612', '121.034196', '', 'Fordham St, Novaliches, Quezon City, Metro Manila, Philippines', '14.696564', '121.056855', '2017-08-23', '2017-09-06 01:07:18', '2017-08-13 23:58:40', 'deliver', '2017-07-31 17:48:49', '2017-09-06 01:07:19', NULL, 'zero rated', 3, 0, NULL, 0, 0),
(57, '1472317080514', 19, 4, 4, 0, 'a', 'approved', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 2000.000000, 0.000000, 0.000000, 0.000000, '2000.000000', 'quotation', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pickup', '2017-08-05 23:17:14', '2017-08-05 23:19:06', '2017-08-05 23:19:06', NULL, 0, 0, NULL, 0, 0),
(58, '9962317080508', 19, 4, 4, 0, 'a', 'deleted', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 2000.000000, 0.000000, 0.000000, 0.000000, '2000.000000', 'quotation', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pickup', '2017-08-05 23:19:09', '2017-08-05 23:19:59', '2017-08-05 23:19:59', NULL, 0, 0, NULL, 0, 0),
(59, '6862317080501', 19, 4, 4, 0, 'ss', 'deleted', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 2000.000000, 0.000000, 0.000000, 0.000000, '2000.000000', 'quotation', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pickup', '2017-08-05 23:20:01', '2017-08-05 23:20:46', '2017-08-05 23:20:46', NULL, 0, 0, NULL, 0, 0),
(60, '0082317080556', 19, 4, 4, 0, 'a', 'processed', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 2500.000000, 0.000000, 0.000000, 0.000000, '2500.000000', 'quotation', '2017-08-29', 0, NULL, NULL, '14.727612', '121.034196', NULL, NULL, NULL, NULL, '2017-08-23', '2017-08-10 00:21:08', '2017-08-14 23:18:17', 'deliver', '2017-08-05 23:21:56', '2017-08-14 23:18:17', NULL, 'zero rated', 1, 0, NULL, 0, 0),
(62, '0901917081946', 19, 4, 4, 69, 's', 'processed', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 4622.000000, 100.000000, 100.000000, 100.000000, '4722.000000', 'quotation', '2017-08-31', 1, '', '478 Quirino Hwy, Talipapa, Novaliches Quezon City, 1116 Metro Manila, Philippines', '14.685604', '121.024642', '', '478 Quirino Hwy, Talipapa, Novaliches Quezon City, 1116 Metro Manila, Philippines', '14.685604', '121.024642', '2017-08-31', '2017-08-19 20:20:15', '2017-08-20 00:55:48', 'pickup', '2017-08-19 19:53:46', '2017-08-20 00:55:48', NULL, 'vat inc', 3, 0, NULL, 0, 0);
INSERT INTO `quotations` (`id`, `quote_number`, `client_id`, `team_id`, `user_id`, `job_request_id`, `subject`, `status`, `terms_info`, `sub_total`, `installation_charge`, `delivery_charge`, `discount`, `grand_total`, `type`, `validity_date`, `bill_ship_address`, `bill_address`, `bill_geolocation`, `bill_latitude`, `bill_longitude`, `ship_address`, `ship_geolocation`, `ship_latitude`, `ship_longitude`, `target_delivery`, `date_moved`, `date_processed`, `delivery_mode`, `created`, `modified`, `date_deleted_lost`, `vat_type`, `quotation_term_id`, `advance_invoice`, `date_approved`, `approved_by`, `collection_paper_id`) VALUES
(63, '6342117082142', 19, 4, 4, 0, 'asas', 'processed', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 4622.000000, 88.000000, 100.000000, 10.000000, '4800.000000', 'fitout', '2017-08-30', 1, '', 'Queens, Novaliches, Quezon City, Metro Manila, Philippines', '14.732086', '120.993378', '', 'Queens, Novaliches, Quezon City, Metro Manila, Philippines', '14.732086', '120.993378', '2017-08-29', '2017-08-21 21:23:41', '2017-08-21 22:44:22', 'deliver', '2017-08-21 21:13:42', '2017-08-21 22:44:22', NULL, 'vat inc', 1, 0, NULL, 0, 0),
(64, '9812117082143', 19, 4, 4, 71, 'sample', 'processed', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 2222.000000, 100.000000, 0.000000, 22.000000, '2300.000000', 'quotation', '2017-08-30', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-31', '2017-08-26 01:26:53', '2017-08-31 22:35:09', 'pickup', '2017-08-21 21:29:43', '2017-08-31 22:35:09', NULL, 'zero rated', 3, 0, NULL, 0, 0),
(65, '0992217082109', 19, 4, 4, 70, 'sample fitout', 'processed', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 4622.000000, 400.000000, 0.000000, 22.000000, '5000.000000', 'fitout', '2017-08-29', 1, '', 'Damortis, Novaliches, Quezon City, Metro Manila, Philippines', '14.730268', '121.051362', '', 'Damortis, Novaliches, Quezon City, Metro Manila, Philippines', '14.730268', '121.051362', '2017-08-24', '2017-08-21 23:07:31', '2017-08-26 21:52:24', 'deliver', '2017-08-21 22:51:09', '2017-08-26 21:52:24', NULL, 'vat inc', 1, 0, NULL, 0, 0),
(66, '3090017082658', 24, 4, 4, 72, 'sample', 'processed', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 5344.000000, 500.000000, 300.000000, 44.000000, '6100.000000', 'fitout', '2017-08-25', 1, '', 'St James Dr, Novaliches, Quezon City, Metro Manila, Philippines', '14.718646', '121.044383', '', 'St James Dr, Novaliches, Quezon City, Metro Manila, Philippines', '14.718646', '121.044383', '2017-08-28', '2017-08-26 01:03:22', '2017-08-26 01:10:39', 'deliver', '2017-08-26 00:45:58', '2017-08-26 01:10:39', NULL, 'vat inc', 3, 0, NULL, 0, 0),
(67, '5380117082606', 19, 4, 4, 0, 'a', 'processed', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 11.000000, 0.000000, 0.000000, 0.000000, '11.000000', 'quotation', '2017-08-29', 1, '', '13 S Francisco, Novaliches, Quezon City, 1116 Metro Manila, Philippines', '14.704700', '121.038831', '', '13 S Francisco, Novaliches, Quezon City, 1116 Metro Manila, Philippines', '14.704700', '121.038831', '2017-08-29', '2017-08-26 01:32:36', '2017-08-26 21:08:45', 'pickup', '2017-08-26 01:29:06', '2017-08-26 21:08:45', NULL, 'vat inc', 3, 0, NULL, 0, 0),
(68, '3480017090435', 18, 4, 4, 0, 'sa', 'approved', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 15287.000000, 0.000000, 0.000000, 0.000000, '15287.000000', 'quotation', '2017-09-26', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-21', '2017-09-06 01:04:09', NULL, 'pickup', '2017-09-04 00:48:35', '2017-09-06 01:04:10', NULL, 'vat inc', 3, 0, NULL, 0, 0);
INSERT INTO `quotations` (`id`, `quote_number`, `client_id`, `team_id`, `user_id`, `job_request_id`, `subject`, `status`, `terms_info`, `sub_total`, `installation_charge`, `delivery_charge`, `discount`, `grand_total`, `type`, `validity_date`, `bill_ship_address`, `bill_address`, `bill_geolocation`, `bill_latitude`, `bill_longitude`, `ship_address`, `ship_geolocation`, `ship_latitude`, `ship_longitude`, `target_delivery`, `date_moved`, `date_processed`, `delivery_mode`, `created`, `modified`, `date_deleted_lost`, `vat_type`, `quotation_term_id`, `advance_invoice`, `date_approved`, `approved_by`, `collection_paper_id`) VALUES
(69, '9940017090520', 24, 4, 4, 73, 'aaa', 'approved', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 4655.000000, 0.000000, 0.000000, 0.000000, '4655.000000', 'quotation', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-11', '2017-09-06 01:11:28', '2017-09-05 00:50:13', 'pickup', '2017-09-05 00:45:21', '2017-09-06 01:11:28', NULL, 'vat inc', 3, 0, NULL, 0, 0),
(70, '7592217090533', 18, 4, 4, 0, 'xzc', 'approved', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 1.000000, 0.000000, 0.000000, 0.000000, '1.000000', 'quotation', '2017-09-27', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-27', '2017-09-05 23:41:36', NULL, 'deliver', '2017-09-05 22:44:33', '2017-09-05 23:41:37', NULL, 'vat inc', 3, 0, NULL, 0, 0),
(71, '4222117090620', 19, 4, 4, 0, 'asd', 'pending', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMSâ€™ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Clientâ€™s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturerâ€™s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 11.000000, 2.000000, 0.000000, 1.000000, '12.000000', 'quotation', '2017-09-13', 0, '', 'Main Building, SM City Fairview, Novaliches, Quezon City, Metro Manila, Philippines', '14.734678', '121.059782', '', '6795, Makati, Metro Manila, Philippines', '14.558231', '121.019393', '2017-09-29', NULL, NULL, 'deliver', '2017-09-06 21:27:20', '2017-09-22 16:36:24', NULL, NULL, 0, 0, NULL, 0, 0),
(73, '8531217092202', 0, 1, 20, 0, '', 'ongoing', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMS’ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Client’s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturer’s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 0.000000, 0.000000, 0.000000, 0.000000, '0.000000', 'quotation', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-22 12:54:02', '2017-09-22 12:54:02', NULL, NULL, 0, 0, NULL, 0, 0),
(74, '+121617092201', 0, 4, 4, 0, '', 'ongoing', ' <h3>I. PRICE</h3> <ol><li><p>All prices are quoted in Philippine Pesos are inclusive of VAT, delivered and installed at site within Metro Manila. </p></li> <li><p>Price quoted is based on the specifications provided by JECAMS INC. and accepted by the client and vice-versa. Changes in design or specifications after approval of proposal may be subject to price adjustment as the parties may agree.</p></li> <li><p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p></li> </ol> <h3>II. AVAILABILITY OF STOCKS</h3> <ol> <li><p>10 days from the date of proposal, subject to a written confirmation thereafter. Stock availability may vary without prior notice.</p></li> </ol> <h3>III. PAYMENT</h3> <ol> <li><p>A <strong>FIFTY PERCENT (50%)</strong> downpayment shall be required unless JECAMS, INC. and the Client shall otherwise agree.</p></li> <li><p>The balance of the quoted and agreed price shall be paid upon completion and full delivery of the project, on fitout projects, the balance shall be paid through progress billing.</p></li> <li><p>In case of replacements or non-acceptance of some items due to defect or failure to abide by specifications, only that portion pertaining to the value of such items to be replaced or unaccepted shall be left unpaid before delivery, but the entire balance for the items delivered and accepted must be paid in full upon completion and acceptance.</p></li> <li><p>Any payment made through bank is acceptable. However, in case of check payment subject to clearing, actual payment shall be considered made only upon clearing of such check and not on the date of deposit. In cases of bank transfers, payment shall; be considered upon actual crediting of the payment to JECAMS account.</p></li> <li><p>Provincial clients are encouraged to pay through bank and a copy of the deposit slip must be faxed or e-mailed to JECAMS, INC. prior to delivery/installation. All checks should be payable to JECAMS INC. only and any payment made to other entities or individuals whether employee or agent shall not be recognized.</p></li> </ol><h3>IV. DELIVERY</h3> <ol> <li><p>For Standard items, delivery shall be made within a period of 10-20 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>For Indent Items, delivery shall be made within a period of 45-60 working days upon receipt of purchase order, down payment, and complete specifications.</p></li> <li><p>Delivery in provincial areas such as in the Visayas and Mindanao, a forwarder suggested and chosen by the Client shall make the actual delivery. It is understood that the forwarder has the responsibility over the items upon JECAMS’ delivery of such items in good order condition.</p></li> <li><p>Delivery and installation of panels, partitions, workstations, furniture and supplies shall be scheduled upon site visit and upon the instructions of the Client. However, it is understood that the site shall be clean, ready and clear of any obstruction or debris to avoid delay, losses or damage to the item(s).</p></li> <li><p>In case of delay in the installation due to the Client’s fault, JECAMS INC. may charge the client accordingly, which shall be that amount corresponding to the manpower expense incurred due to the delay, lost income or damage incurred.  Elevator access, electricity/power supply must be arranged by the Client prior to delivery and installation. Damaged/missing items should be reported immediately.</p></li> <li><p>Delay due to fortuitous even or force majeure shall not make liable JECAMS, INC. for any damages. Likewise, if the delay in the installation was caused by a fortuitous event or force majeure, Client shall not be answerable to JECAMS, INC. for damages.</p></li> </ol><h3>V. WARRANTY AND AFTER SALES SUPPORT</h3> <ol> <li><p>A Standard <strong>One (1) Year Manufacturer’s Warranty</strong> against factory defect from date of delivery in parts and services shall apply. To ascertain the actual date of delivery, that appearing in the Delivery Receipt shall prevail.</p></li> <li><p>Further, the warranty does not include upgrades and relocation, damage to items caused by an accident, improper use or abuse of the items, alterations, scratches, dents or repairs done by a person other than JECAMS, INC. Service Agents, usage of component parts not supplied by JECAMS INC, poor operating environment, fire and other natural calamities. Fabrics, leatherette, mesh, and the like are not included in the warranty.</p></li> </ol><h3>VI. INCLUSIONS</h3> <ol> <li><p>Only the specific product details, layout, and drawing hardcopies are included in this proposal and warranty.</p></li> </ol> </li> <h3>VII. LIMITATIONS</h3> <ol> <li><p>Items not mentioned in the proposed deliverables, cost breakdown, and other conditions shall not form part of this proposal. Fees related to bank charges, bonds, failed pick up or delivery, re-configuration or re-consignment shall require review of the cost implication and shall necessitate a written request, prior to approval. The charges or expenses mentioned in the preceding sentence shall be considered for the account of the Client in the absence of any specific agreement between the Parties.</p></li> </ol><h3>VIII. PENALTY</h3> <ol> <li><p>A Penalty of <strong>One Percent (1%) daily</strong> on all unpaid items shall be applied if Client fails to settle the obligation on the due date. For purposes of ascertaining when the due date is, it shall be the date when payment should have been made based on the completion and delivery as agreed upon by the Parties.</p></li> <li><p>When the due date falls on a holiday or weekend, it shall be considered due on the next business day for purposes of ascertain the date when payment and penalties may be demanded.</p></li> <li><p>In case of return of items without the fault of JECAMS, INC. a penalty of THIRTY PERCENT (30%) on all items returned after delivery/ installation shall be imposed.</p></li> <li><p>In case of cancellation of order seven (7) days after the issuance and receipt by JECAMS, INC. of the Purchase Order, a penalty of THIRTY PERCENT (30%) on all items shall be imposed.</p></li> <li><p>All items delivered shall remain properties of JECAMS INC until fully paid by client.</p></li> <li><p>A change of mind on the part of the Client shall not entitle latter to an exchange or refund under Republic Act 7394, otherwise known as "The Consumer Act of the Philippines."</p></li> </ol><h3>IX. NON - DISCLOSURE</h3> <ol> <li><p>Any information contained in the proposal shall be treated as confidential and shall not be disclosed to anyone except to the agents, employees or representatives of the Client duly authorized. Likewise, JECAMS, INC. shall keep confidential all the specifications and details pertaining to the Client or the items purchased or ordered. Any breach of this Confidentiality Clause shall be a valid ground for the rescission of this Agreement between the Parties and may even expose the violating party to liability.</p></li> <li><p>Should you have favourably considered our proposal, please sign on the Conforme Portion below to signify your intention of availing our products and services.</p></li> </ol><br> ', 0.000000, 0.000000, 0.000000, 0.000000, '0.000000', 'quotation', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-22 16:33:01', '2017-09-22 16:33:01', NULL, NULL, 0, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_products`
--

CREATE TABLE IF NOT EXISTS `quotation_products` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double(50,6) NOT NULL,
  `qty` double(50,6) NOT NULL,
  `total` double(50,6) DEFAULT '0.000000',
  `type` enum('supply','customized','combination','raw') NOT NULL,
  `other_info` longtext NOT NULL,
  `edited_amount` double(50,6) NOT NULL,
  `sale` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `additional` double(50,6) NOT NULL DEFAULT '0.000000',
  `discount` double(50,6) NOT NULL DEFAULT '0.000000',
  `processed_qty` float(50,6) NOT NULL DEFAULT '0.000000',
  `delivered_qty` float(50,6) NOT NULL DEFAULT '0.000000',
  `dr_requested` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_products`
--

INSERT INTO `quotation_products` (`id`, `quotation_id`, `product_id`, `image`, `price`, `qty`, `total`, `type`, `other_info`, `edited_amount`, `sale`, `created`, `modified`, `deleted`, `additional`, `discount`, `processed_qty`, `delivered_qty`, `dr_requested`) VALUES
(21, 64, 7, 'WD-1310 Bench.png', 11.000000, 11.000000, 1100.000000, 'supply', 'asd', 100.000000, 0, '2017-08-21 22:50:15', '2017-08-26 21:58:10', NULL, -89.000000, 0.000000, 13.000000, 0.000000, 0),
(22, 64, 9, 'AST-30123.png', 2122.000000, 11.000000, 23342.000000, 'customized', 'Warranty: 6 months', 2122.000000, 0, '2017-08-21 22:50:43', '2017-08-21 22:50:43', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(23, 65, 10, '1500306129.png', 2500.000000, 10.000000, 25000.000000, 'supply', 'Prices are included with vat.', 2500.000000, 1, '2017-08-21 22:51:42', '2017-09-22 16:37:39', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 1),
(24, 65, 9, 'AST-30123.png', 2122.000000, 5.000000, 10610.000000, 'customized', 'Warranty: 6 months', 2122.000000, 0, '2017-08-21 22:52:11', '2017-08-21 22:52:11', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(25, 64, 7, 'WD-1310 Bench.png', 11.000000, 12.000000, 132.000000, 'combination', 'asd', 11.000000, 0, '2017-08-22 20:14:46', '2017-08-31 22:35:09', NULL, 0.000000, 0.000000, 28.000000, 0.000000, 0),
(26, 66, 9, 'AST-30123.png', 2122.000000, 1.000000, 2122.000000, 'customized', 'Warranty: 6 months', 2122.000000, 0, '2017-08-26 00:47:09', '2017-08-26 00:47:09', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(27, 66, 7, 'WD-1310 Bench.png', 11.000000, 12.000000, 13200.000000, 'supply', 'asd', 1100.000000, 0, '2017-08-26 00:47:30', '2017-08-26 01:10:39', NULL, -1089.000000, 0.000000, 0.000000, 0.000000, 0),
(28, 66, 9, 'AST-30123.png', 2122.000000, 1.000000, 2122.000000, 'customized', 'Warranty: 6 months', 2122.000000, 0, '2017-08-26 00:49:49', '2017-08-26 00:49:49', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(29, 67, 7, 'WD-1310 Bench.png', 11.000000, 1.000000, 11.000000, 'supply', 'asd', 11.000000, 0, '2017-08-26 01:29:46', '2017-08-26 21:08:45', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(30, 68, 7, 'WD-1310 Bench.png', 11.000000, 1.000000, 11.000000, 'supply', 'asd', 11.000000, 0, '2017-09-04 00:49:03', '2017-09-04 00:49:03', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(31, 68, 7, 'WD-1310 Bench.png', 11.000000, 1.000000, 11.000000, 'supply', 'asd', 11.000000, 0, '2017-09-04 00:49:11', '2017-09-04 00:49:11', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(32, 68, 8, 'WD-1310 Bench.png', 0.000000, 1.000000, 0.000000, 'supply', 'as', 0.000000, 0, '2017-09-04 00:49:21', '2017-09-04 00:49:21', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(33, 68, 9, 'AST-30123.png', 2122.000000, 1.000000, 2122.000000, 'customized', 'Warranty: 6 months', 2122.000000, 0, '2017-09-04 00:49:30', '2017-09-04 00:49:30', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(34, 68, 9, 'AST-30123.png', 2122.000000, 1.000000, 2122.000000, 'customized', 'Warranty: 6 months', 2122.000000, 0, '2017-09-04 00:49:38', '2017-09-04 00:49:38', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(35, 68, 9, 'AST-30123.png', 2122.000000, 1.000000, 2122.000000, 'customized', 'Warranty: 6 months', 2122.000000, 0, '2017-09-04 00:49:46', '2017-09-04 00:49:46', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(36, 68, 10, '1500306129.png', 2500.000000, 1.000000, 2500.000000, 'supply', 'Prices are included with vat.', 2500.000000, 1, '2017-09-04 00:49:54', '2017-09-04 00:49:54', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(37, 68, 9, 'AST-30123.png', 2122.000000, 1.000000, 2122.000000, 'customized', 'Warranty: 6 months', 2122.000000, 0, '2017-09-04 00:50:01', '2017-09-04 00:50:01', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(38, 68, 7, 'WD-1310 Bench.png', 11.000000, 1.000000, 11.000000, 'supply', 'asd', 11.000000, 0, '2017-09-04 00:50:07', '2017-09-04 00:50:07', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(39, 68, 7, 'WD-1310 Bench.png', 11.000000, 1.000000, 11.000000, 'supply', 'asd', 11.000000, 0, '2017-09-04 00:50:17', '2017-09-04 00:50:17', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(40, 68, 8, 'WD-1310 Bench.png', 0.000000, 1.000000, 0.000000, 'supply', 'as', 0.000000, 0, '2017-09-04 00:50:25', '2017-09-04 00:50:25', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(41, 68, 9, 'AST-30123.png', 2122.000000, 1.000000, 2122.000000, 'customized', 'Warranty: 6 months', 2122.000000, 0, '2017-09-04 00:50:32', '2017-09-04 00:50:32', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(42, 68, 9, 'AST-30123.png', 2122.000000, 1.000000, 2122.000000, 'customized', 'Warranty: 6 months', 2122.000000, 0, '2017-09-04 00:50:41', '2017-09-04 00:50:41', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(43, 68, 7, 'WD-1310 Bench.png', 11.000000, 1.000000, 11.000000, 'supply', 'asd', 11.000000, 0, '2017-09-04 00:50:50', '2017-09-04 00:50:50', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(44, 68, 8, 'WD-1310 Bench.png', 0.000000, 1.000000, 0.000000, 'supply', 'as', 0.000000, 0, '2017-09-04 00:50:58', '2017-09-04 00:50:58', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(45, 69, 7, 'WD-1310 Bench.png', 11.000000, 11.000000, 121.000000, 'supply', 'asd', 11.000000, 0, '2017-09-05 00:46:14', '2017-09-07 23:30:56', NULL, 0.000000, 0.000000, 2.000000, 0.000000, 1),
(47, 69, 8, 'WD-1310 Bench.png', 0.000000, 11.000000, 121.000000, 'combination', 'as', 11.000000, 0, '2017-09-05 00:46:50', '2017-09-07 23:31:22', NULL, -11.000000, 0.000000, 3.000000, 0.000000, 1),
(48, 69, 9, 'AST-30123.png', 2122.000000, 11.000000, 23342.000000, 'customized', 'Warranty: 6 months', 2122.000000, 0, '2017-09-05 00:47:03', '2017-09-05 00:47:03', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 0),
(49, 69, 10, '1500306129.png', 2500.000000, 11.000000, 27500.000000, 'supply', 'Prices are included with vat.', 2500.000000, 1, '2017-09-05 00:47:26', '2017-09-05 00:47:26', NULL, 0.000000, 0.000000, 0.000000, 11.000000, 1),
(50, 69, 7, 'WD-1310 Bench.png', 11.000000, 11.000000, 121.000000, 'combination', 'asd', 11.000000, 0, '2017-09-05 00:47:47', '2017-09-07 23:38:36', NULL, 0.000000, 0.000000, 0.000000, 0.000000, 1),
(51, 70, 8, 'WD-1310 Bench.png', 0.000000, 1.000000, 1.000000, 'supply', 'as', 1.000000, 0, '2017-09-05 22:44:57', '2017-09-05 22:44:57', NULL, -1.000000, 0.000000, 0.000000, 0.000000, 0),
(52, 71, 8, 'WD-1310 Bench.png', 0.000000, 1.000000, 11.000000, 'supply', 'as', 11.000000, 0, '2017-09-06 21:27:51', '2017-09-06 21:27:51', NULL, -11.000000, 0.000000, 0.000000, 0.000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_product_properties`
--

CREATE TABLE IF NOT EXISTS `quotation_product_properties` (
  `id` int(11) NOT NULL,
  `quotation_product_id` int(11) NOT NULL DEFAULT '0',
  `property` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `product_property_id` int(11) NOT NULL DEFAULT '0',
  `product_value_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=690 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_product_properties`
--

INSERT INTO `quotation_product_properties` (`id`, `quotation_product_id`, `property`, `value`, `product_property_id`, `product_value_id`, `created`, `modified`) VALUES
(647, 21, NULL, NULL, 5, 5, '2017-08-21 22:50:15', '2017-08-21 22:50:15'),
(648, 22, 'specs', 'tall', 0, 0, '2017-08-21 22:50:44', '2017-08-21 22:50:44'),
(649, 22, NULL, NULL, 3, 3, '2017-08-21 22:50:44', '2017-08-21 22:50:44'),
(650, 22, NULL, NULL, 4, 4, '2017-08-21 22:50:44', '2017-08-21 22:50:44'),
(651, 23, NULL, NULL, 1, 1, '2017-08-21 22:51:42', '2017-08-21 22:51:42'),
(652, 23, NULL, NULL, 2, 2, '2017-08-21 22:51:42', '2017-08-21 22:51:42'),
(653, 24, NULL, NULL, 3, 3, '2017-08-21 22:52:11', '2017-08-21 22:52:11'),
(654, 24, NULL, NULL, 4, 4, '2017-08-21 22:52:11', '2017-08-21 22:52:11'),
(655, 25, 'size', 'small', 0, 0, '2017-08-22 20:14:46', '2017-08-22 20:14:46'),
(656, 25, NULL, NULL, 5, 5, '2017-08-22 20:14:47', '2017-08-22 20:14:47'),
(657, 26, NULL, NULL, 3, 3, '2017-08-26 00:47:09', '2017-08-26 00:47:10'),
(658, 26, NULL, NULL, 4, 4, '2017-08-26 00:47:10', '2017-08-26 00:47:10'),
(659, 27, NULL, NULL, 5, 5, '2017-08-26 00:47:30', '2017-08-26 00:47:30'),
(660, 28, NULL, NULL, 3, 3, '2017-08-26 00:49:49', '2017-08-26 00:49:49'),
(661, 28, NULL, NULL, 4, 4, '2017-08-26 00:49:49', '2017-08-26 00:49:49'),
(662, 29, NULL, NULL, 5, 5, '2017-08-26 01:29:46', '2017-08-26 01:29:47'),
(663, 30, NULL, NULL, 5, 5, '2017-09-04 00:49:03', '2017-09-04 00:49:03'),
(664, 31, NULL, NULL, 5, 5, '2017-09-04 00:49:12', '2017-09-04 00:49:12'),
(665, 33, NULL, NULL, 3, 3, '2017-09-04 00:49:30', '2017-09-04 00:49:30'),
(666, 33, NULL, NULL, 4, 4, '2017-09-04 00:49:30', '2017-09-04 00:49:30'),
(667, 34, NULL, NULL, 3, 3, '2017-09-04 00:49:39', '2017-09-04 00:49:39'),
(668, 34, NULL, NULL, 4, 4, '2017-09-04 00:49:39', '2017-09-04 00:49:39'),
(669, 35, NULL, NULL, 3, 3, '2017-09-04 00:49:46', '2017-09-04 00:49:46'),
(670, 35, NULL, NULL, 4, 4, '2017-09-04 00:49:46', '2017-09-04 00:49:46'),
(671, 36, NULL, NULL, 1, 1, '2017-09-04 00:49:54', '2017-09-04 00:49:54'),
(672, 36, NULL, NULL, 2, 2, '2017-09-04 00:49:55', '2017-09-04 00:49:55'),
(673, 37, NULL, NULL, 3, 3, '2017-09-04 00:50:01', '2017-09-04 00:50:01'),
(674, 37, NULL, NULL, 4, 4, '2017-09-04 00:50:01', '2017-09-04 00:50:01'),
(675, 38, NULL, NULL, 5, 5, '2017-09-04 00:50:07', '2017-09-04 00:50:07'),
(676, 39, NULL, NULL, 5, 5, '2017-09-04 00:50:18', '2017-09-04 00:50:18'),
(677, 41, NULL, NULL, 3, 3, '2017-09-04 00:50:32', '2017-09-04 00:50:32'),
(678, 41, NULL, NULL, 4, 4, '2017-09-04 00:50:32', '2017-09-04 00:50:32'),
(679, 42, NULL, NULL, 3, 3, '2017-09-04 00:50:41', '2017-09-04 00:50:41'),
(680, 42, NULL, NULL, 4, 4, '2017-09-04 00:50:41', '2017-09-04 00:50:41'),
(681, 43, NULL, NULL, 5, 5, '2017-09-04 00:50:50', '2017-09-04 00:50:50'),
(682, 45, NULL, NULL, 5, 5, '2017-09-05 00:46:14', '2017-09-05 00:46:14'),
(683, 47, 'color', 'brown', 0, 0, '2017-09-05 00:46:50', '2017-09-05 00:46:50'),
(684, 48, NULL, NULL, 3, 3, '2017-09-05 00:47:03', '2017-09-05 00:47:03'),
(685, 48, NULL, NULL, 4, 4, '2017-09-05 00:47:03', '2017-09-05 00:47:03'),
(686, 49, NULL, NULL, 1, 1, '2017-09-05 00:47:26', '2017-09-05 00:47:26'),
(687, 49, NULL, NULL, 2, 2, '2017-09-05 00:47:26', '2017-09-05 00:47:26'),
(688, 50, 'type', 'small', 0, 0, '2017-09-05 00:47:47', '2017-09-05 00:47:47'),
(689, 50, NULL, NULL, 5, 5, '2017-09-05 00:47:47', '2017-09-05 00:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_terms`
--

CREATE TABLE IF NOT EXISTS `quotation_terms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_terms`
--

INSERT INTO `quotation_terms` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Cash On Delivery', '2015-02-21 19:43:00', '2015-02-21 19:43:00'),
(2, 'Full Payment', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '50-50', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created`, `modified`) VALUES
(1, 'it_staff', '2017-09-22 12:01:11', '2017-09-22 12:01:11'),
(2, 'super_admin', '2017-09-22 12:04:12', '2017-09-22 12:04:12'),
(3, 'marketing_staff', '2017-09-22 12:04:57', '2017-09-22 12:04:57'),
(4, 'sales_executive', '2017-09-22 12:05:08', '2017-09-22 12:05:08'),
(5, 'design_head', '2017-09-22 12:05:18', '2017-09-22 12:05:18'),
(6, 'designer', '2017-09-22 12:06:35', '2017-09-22 12:06:35'),
(7, 'supply_staff', '2017-09-22 12:06:44', '2017-09-22 12:06:44'),
(8, 'raw_head', '2017-09-22 12:06:51', '2017-09-22 12:06:51'),
(9, 'warehouse_head', '2017-09-22 12:07:01', '2017-09-22 12:07:01'),
(10, 'collection_officer', '2017-09-22 12:07:11', '2017-09-22 12:07:11'),
(11, 'production_head', '2017-09-22 12:07:19', '2017-09-22 12:07:19'),
(12, 'hr_head', '2017-09-22 12:07:27', '2017-09-22 12:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `social_profiles`
--

CREATE TABLE IF NOT EXISTS `social_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `social_network_name` varchar(64) DEFAULT NULL,
  `social_network_id` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `display_name` varchar(128) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `link` varchar(512) NOT NULL,
  `picture` varchar(512) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_profiles`
--

INSERT INTO `social_profiles` (`id`, `user_id`, `social_network_name`, `social_network_id`, `email`, `display_name`, `first_name`, `last_name`, `link`, `picture`, `created`, `modified`, `status`) VALUES
(1, 20, 'Google', '108168780327855664239', 'ronalyn.jecams@gmail.com', 'Ronalyn Ariola', 'Ronalyn', 'Ariola', '', 'https://lh5.googleusercontent.com/-WulcldjVTWw/AAAAAAAAAAI/AAAAAAAAAA0/wRIUN3Yohqc/photo.jpg?sz=200', '2017-09-20 04:03:25', '2017-09-20 04:03:25', 1),
(2, 21, 'Google', '104851172660812457367', 'ariolaronalyn@gmail.com', 'Ronalyn Ariola', 'Ronalyn', 'Ariola', 'https://plus.google.com/104851172660812457367', 'https://lh4.googleusercontent.com/-2e7MTLMZnnM/AAAAAAAAAAI/AAAAAAAAABE/XugzLcb__Vw/photo.jpg?sz=200', '2017-09-22 08:15:30', '2017-09-22 08:15:30', 1),
(3, 22, 'Google', '112785927694337097022', 'alvin.jecams@gmail.com', 'Alvin Prieto', 'Alvin', 'Prieto', '', 'https://lh4.googleusercontent.com/-IhUExuL6xhQ/AAAAAAAAAAI/AAAAAAAAAAs/E5lgpObXXfg/photo.jpg?sz=200', '2017-09-22 09:17:35', '2017-09-22 09:17:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `category_id`, `created`, `modified`) VALUES
(1, 'Clerical Chairs', 1, '2017-07-17 16:50:37', '2017-07-17 16:50:37'),
(2, 'Mesh Chairs', 1, '2017-07-17 16:50:51', '2017-07-17 16:50:51'),
(3, 'Highback Chairs', 1, '2017-07-17 16:51:04', '2017-07-17 16:51:04'),
(4, 'Gang Chair', 1, '2017-07-17 16:51:18', '2017-07-17 16:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `contact_person` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `type` enum('supply','raw','both','rawsubcon') NOT NULL,
  `tin_number` varchar(255) NOT NULL,
  `vatable` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `code`, `status`, `contact_person`, `contact_number`, `email`, `address`, `type`, `tin_number`, `vatable`, `created`, `modified`, `user_id`) VALUES
(1, 'Company 2', 'kopk', 'active', 'kop', 'kop', 'sdsdf@fgh.cc', 'kop', 'supply', 'kop', 0, '0000-00-00 00:00:00', '2017-08-21 22:00:38', 12),
(2, 'Company 1', 'as', 'active', 'as', 'as', 'as@sdf.sdr', 'as', 'supply', 'as', 0, '2017-08-12 15:15:58', '2017-08-21 22:00:22', 12),
(3, 'q', 'q', '', 'q', 'q', 'q@aaa.asa', 'q', '', 'q', 1, '2017-08-21 08:20:57', '2017-08-21 08:20:57', 12),
(4, 'q', 'q', '', 'q', 'q', 'q@qwqw.as', 'q', '', 'qq', 1, '2017-08-21 08:30:53', '2017-08-21 08:30:53', 12),
(5, 'q', 'q', '', 'q', 'q', 'q@qwqw.as', 'q', 'supply', 'qq', 1, '2017-08-21 08:36:14', '2017-08-21 08:36:14', 12),
(6, 'q', 'q', '', 'q', 'q', 'q@qwe.sdf', 'q', 'supply', 'q', 1, '2017-08-21 08:39:43', '2017-08-21 08:39:43', 12),
(7, 'zzzz', 'a', 'active', 'x', 'x', 'x@sda.df', 'x', 'supply', 'x', 1, '2017-08-21 08:39:56', '2017-08-21 09:36:49', 12),
(8, 'w', 'w', 'active', 'w', 'w', 'w@qq.se', 'w', 'supply', 'w', 0, '2017-08-21 09:06:04', '2017-08-21 09:06:04', 12),
(9, 'www', 'ww', 'active', 'ww', 'ww', 'ww@ff.dss', 'ww', 'raw', 'ww', 0, '2017-09-01 13:17:30', '2017-09-01 13:17:30', 13),
(10, 'xx', 'xx', 'active', 'xx', 'xx', 'xx@xx.com', 'xx', 'raw', 'xxx', 1, '2017-09-02 01:22:33', '2017-09-02 01:22:33', 13);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_tags`
--

CREATE TABLE IF NOT EXISTS `supplier_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `team_manager` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `created`, `modified`, `display_name`, `location`, `telephone`, `team_manager`) VALUES
(1, 'awesome', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Team Awesome', '<b>Main:</b> 3 Queen St.Forest Hills, Novaliches Quezon City 1117', '<b>Tel:</b> 358.8149 / 921.1033', 1),
(2, 'kate', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Team Elite', '<b>Main:</b> 3 Queen St.Forest Hills, Novaliches Quezon City 1117', '<b>Tel:</b> 358.8149 / 921.1033', 0),
(3, 'bgc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Team Tyrant', '<b>BGC:</b> 6/F, Icon Plaza, 26th St. Bonifacio Global City, Taguig City', '<b>Tel:</b> 805.2312 / 805.8251', 0),
(4, 'makati', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Team Enthusiastic', '<b>Makati:</b> 1177 Chino Roces Ave. Brgy. San Antonio,Makati City', '<b>Tel:</b> 800.8231', 10);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'new' COMMENT 'sales_executive,  marketing_staff,super_admin,it_staff',
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `position_id` int(11) DEFAULT '0',
  `department_id` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `signature` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `first_name`, `last_name`, `picture`, `position_id`, `department_id`, `active`, `created`, `modified`, `signature`) VALUES
(3, 'admin', '$2a$10$vyADTWUl3uT6Bj3iAJB/J.3T79O1GPBX2osJc0TiafN0.YYQNd/Gu', '', 'super_admin', 'Ronalyn', 'Ariola', NULL, 2, 2, 1, '2015-06-19 08:31:21', '2015-06-19 08:31:21', NULL),
(4, 'sales_executive', '$2a$10$4YdV3uVz/QFa1zpKu.FUt.JLLri.Cp.uoB7Zdz0bRWWCD/Uls/Q6m', '', 'sales_executive', 'salesName', 'LName', NULL, 2, 2, 1, '2017-07-17 05:40:16', '2017-07-17 05:40:16', 'Regill.png'),
(5, 'marketing_staff', '$2a$10$NPynBV22QbcJuryGsLcuGO9egi5Vw65MVaKVm5HvRUjwarTD4TqTG', '', 'marketing_staff', 'marketingName', 'LName', NULL, 4, 4, 1, '2017-07-17 05:42:21', '2017-07-17 05:42:21', NULL),
(6, 'sales_executive2', '$2a$10$Q2P7zxd3wIiHkeWz.Yj/Cue7p.4bbczANgGv6SXd2hPz4reVdQhD2', '', 'sales_executive', 'sales executive', 'number2', NULL, 2, 2, 1, '2017-07-17 16:04:52', '2017-07-17 16:04:52', NULL),
(7, 'sales_executive3', '$2a$10$1.xbgxiin39IVY5nEhCBj.g2ql8EaES9K/HmhQ59yzh0ZLUxsNtEq', '', 'sales_executive', 'SE3', 'SE3', NULL, 2, 5, 1, '2017-07-17 16:05:36', '2017-07-17 16:05:36', NULL),
(8, 'itstaff', '$2a$10$1d6sdcS6EfkwB39fcZTWQ.xyDL/ybMAn/XbcxwKxAt.qSvAON.mI6', '', 'it_staff', 'itstaff', 'lname', NULL, 7, 1, NULL, '2017-07-17 16:32:06', '2017-07-17 16:32:06', NULL),
(10, 'design_head', '$2a$10$uVQY61KfGS1T/fuZ1ZJo0u7hMvtFPP68xskh46rwqN1RUIzR8fq5O', '', 'design_head', 'design_head', 'design_head', NULL, 9, 5, 1, '2017-07-31 14:52:23', '2017-07-31 14:52:23', 'Shaira.png'),
(11, 'designer', '$2a$10$bgRibN.szya/AU.mK3031e.aPIrh0HRbhmalkJI8qiII3Lw0ksWLK', '', 'designer', 'designer', 'designer', NULL, 10, 5, 1, '2017-08-06 00:46:15', '2017-08-06 00:46:15', NULL),
(12, 'supply_purchasing', '$2a$10$GH1fkY4hp82dIn2Ts896MeKlEpgX1ElgHD8esnE9fpOOB5qs4BfNa', '', 'supply_staff', 'supply', ' purchasing', NULL, 8, 6, 1, '2017-08-11 22:30:49', '2017-08-11 22:30:49', NULL),
(13, 'raw_head', '$2a$10$fNmSZQq3yx8SpXMF408ZM.mU/KDxPvb./dFRJ4EOM0vRGer6bLKu2', '', 'raw_head', 'cess', 'mm', NULL, 13, 7, 1, '2017-08-26 00:10:59', '2017-08-26 00:10:59', NULL),
(15, 'warehouse_head_raw', '$2a$10$duz2B.Dzu0XPXf//O/ga8eTgxoM9zEM.WClOievV/AQjQK3r4UdbW', '', 'warehouse_head_raw', 'warehouse_head_raw', 'warehouse_head_raw', NULL, 14, 8, 1, '2017-09-04 23:48:12', '2017-09-04 23:48:12', NULL),
(16, 'warehouse_head_supply', '$2a$10$JirU0Fy3vVmrn3/X95BB0erSWi7FdJZ4JC9EXQg54mIrXkBpEO7Uu', '', 'warehouse_head_supply', 'warehouse_head_supply', 'warehouse_head_supply', NULL, 15, 9, 1, '2017-09-04 23:48:33', '2017-09-04 23:48:33', NULL),
(17, 'collection_officer', '$2a$10$be3Xf0N9770YMrecwMqoE.ULGZUQk1K12HKzpovi2ZUW865eOqgVW', '', 'collection_officer', 'collection_officer', 'collection_officer', NULL, 16, 10, 1, '2017-09-05 22:19:10', '2017-09-05 22:19:10', NULL),
(19, 'production_head', '$2a$10$DyqZNjxusi4XRXs/yMyyA.q.89Wx9H1toqUDWvbPl.1lEvbkEvt2u', '', 'production_head', 'production_head', 'production_head', NULL, 17, 11, 1, '2017-09-07 23:44:33', '2017-09-07 23:44:33', NULL),
(20, 'ronalyn_ariola', '$2a$10$jy8xWRXGIOW/cTuKL6qEa.lRk0Yc2WYfGQ0O6l/5tbZ8vcO89LWau', 'ronalyn.jecams@gmail.com', 'sales_executive', 'Ronalyn', 'Ariola', 'https://lh5.googleusercontent.com/-WulcldjVTWw/AAAAAAAAAAI/AAAAAAAAAA0/wRIUN3Yohqc/photo.jpg?sz=200', 2, 2, 1, '2017-09-20 04:03:25', '2017-09-22 12:51:05', NULL),
(21, 'ronalyn_ariola', '$2a$10$El.ltOuEvU8.JnWMA/zba.SOEmiNgy.hi.GZ/ohAq3r6oDtqeJUDO', 'ariolaronalyn@gmail.com', 'new', 'Ronalyns', 'Ariolasss', 'https://lh4.googleusercontent.com/-2e7MTLMZnnM/AAAAAAAAAAI/AAAAAAAAABE/XugzLcb__Vw/photo.jpg?sz=200', 0, 0, 1, '2017-09-22 08:15:30', '2017-09-22 08:15:30', NULL),
(22, 'alvin_prieto', '$2a$10$/aHSYjBms1g75VPb.mj8S.Fa3Em23QUjJdMqSspZcaRd/KcT45Ptq', 'alvin.jecams@gmail.com', 'new', 'Alvin', 'Prieto', 'https://lh4.googleusercontent.com/-IhUExuL6xhQ/AAAAAAAAAAI/AAAAAAAAAAs/E5lgpObXXfg/photo.jpg?sz=200', 0, 0, 1, '2017-09-22 09:17:35', '2017-09-22 09:17:35', NULL),
(23, 'hr_head', '$2a$10$NxIhwqFZ58325h8SPgRnTe8zs.hPzGZ3noldM9YuMXVyZBW9gwNNq', NULL, 'hr_head', 'hr_head', 'hr_head', NULL, 18, 12, 1, '2017-09-22 09:52:38', '2017-09-22 09:52:38', NULL),
(24, 'logistics_head', '$2a$10$lPLVNDBaBIWqjfCUv16yyeEcVnV.vzT6b/Bi8Wn72xr09SI89LGDi', NULL, 'logistics_head', 'Logistics', 'Head', NULL, 19, 13, 1, '2017-09-22 16:57:04', '2017-09-22 16:57:04', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_papers`
--
ALTER TABLE `accounting_papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_statuses`
--
ALTER TABLE `agent_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_schedules`
--
ALTER TABLE `collection_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_papers`
--
ALTER TABLE `delivery_papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_schedules`
--
ALTER TABLE `delivery_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_sched_products`
--
ALTER TABLE `delivery_sched_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dr_papers`
--
ALTER TABLE `dr_papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_permissions`
--
ALTER TABLE `erp_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_locations`
--
ALTER TABLE `inv_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_logs`
--
ALTER TABLE `inv_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_requests`
--
ALTER TABLE `job_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jr_products`
--
ALTER TABLE `jr_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jr_uploads`
--
ALTER TABLE `jr_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jr_work_statuses`
--
ALTER TABLE `jr_work_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdfs`
--
ALTER TABLE `pdfs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_users`
--
ALTER TABLE `permission_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_products`
--
ALTER TABLE `po_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_product_properties`
--
ALTER TABLE `po_product_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_raw_requests`
--
ALTER TABLE `po_raw_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_raw_request_properties`
--
ALTER TABLE `po_raw_request_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_properties`
--
ALTER TABLE `product_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sources`
--
ALTER TABLE `product_sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_source_properties`
--
ALTER TABLE `product_source_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_suppliers`
--
ALTER TABLE `product_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_supplier_properties`
--
ALTER TABLE `product_supplier_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_values`
--
ALTER TABLE `product_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prod_inv_combo`
--
ALTER TABLE `prod_inv_combo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prod_inv_conditions`
--
ALTER TABLE `prod_inv_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prod_inv_locations`
--
ALTER TABLE `prod_inv_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prod_inv_location_properties`
--
ALTER TABLE `prod_inv_location_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_products`
--
ALTER TABLE `quotation_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_product_properties`
--
ALTER TABLE `quotation_product_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_terms`
--
ALTER TABLE `quotation_terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_profiles`
--
ALTER TABLE `social_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_tags`
--
ALTER TABLE `supplier_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_papers`
--
ALTER TABLE `accounting_papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agent_statuses`
--
ALTER TABLE `agent_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `collection_schedules`
--
ALTER TABLE `collection_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `delivery_papers`
--
ALTER TABLE `delivery_papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `delivery_schedules`
--
ALTER TABLE `delivery_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `delivery_sched_products`
--
ALTER TABLE `delivery_sched_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `dr_papers`
--
ALTER TABLE `dr_papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `erp_permissions`
--
ALTER TABLE `erp_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inv_locations`
--
ALTER TABLE `inv_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `inv_logs`
--
ALTER TABLE `inv_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_requests`
--
ALTER TABLE `job_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `jr_products`
--
ALTER TABLE `jr_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `jr_uploads`
--
ALTER TABLE `jr_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `jr_work_statuses`
--
ALTER TABLE `jr_work_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pdfs`
--
ALTER TABLE `pdfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permission_users`
--
ALTER TABLE `permission_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `po_products`
--
ALTER TABLE `po_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `po_product_properties`
--
ALTER TABLE `po_product_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `po_raw_requests`
--
ALTER TABLE `po_raw_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `po_raw_request_properties`
--
ALTER TABLE `po_raw_request_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `product_properties`
--
ALTER TABLE `product_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_sources`
--
ALTER TABLE `product_sources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `product_source_properties`
--
ALTER TABLE `product_source_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `product_suppliers`
--
ALTER TABLE `product_suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `product_supplier_properties`
--
ALTER TABLE `product_supplier_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `product_values`
--
ALTER TABLE `product_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `prod_inv_combo`
--
ALTER TABLE `prod_inv_combo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prod_inv_conditions`
--
ALTER TABLE `prod_inv_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prod_inv_locations`
--
ALTER TABLE `prod_inv_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `prod_inv_location_properties`
--
ALTER TABLE `prod_inv_location_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `quotation_products`
--
ALTER TABLE `quotation_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `quotation_product_properties`
--
ALTER TABLE `quotation_product_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=690;
--
-- AUTO_INCREMENT for table `quotation_terms`
--
ALTER TABLE `quotation_terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `social_profiles`
--
ALTER TABLE `social_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `supplier_tags`
--
ALTER TABLE `supplier_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
