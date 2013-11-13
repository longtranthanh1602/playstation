-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2013 at 09:08 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `playstation`
--
CREATE DATABASE IF NOT EXISTS `playstation` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `playstation`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_machines`
--

CREATE TABLE IF NOT EXISTS `tbl_machines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL,
  `status_msg` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_machines`
--

INSERT INTO `tbl_machines` (`id`, `name`, `status_id`, `status_msg`, `created_at`, `updated_at`) VALUES
(1, 'Máy số 1', 0, 'Không sử dụng', '2013-11-13 02:33:47', '2013-10-31 22:04:05'),
(2, 'Máy số 2', 0, 'Không sử dụng', '2013-11-13 05:59:30', '2013-10-31 22:04:05'),
(3, 'Máy số 3', 0, 'Đang sử dụng', '2013-11-06 05:35:22', '2013-10-31 22:04:05'),
(4, 'Máy số 4', 0, 'Không sử dụng', '2013-11-06 09:52:10', '2013-10-31 22:04:05'),
(5, 'Máy số 5', 0, 'Tắt', '2013-10-31 22:04:05', '2013-10-31 22:04:05'),
(6, 'Máy số 6', 0, 'Tắt', '2013-10-31 22:04:05', '2013-10-31 22:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mst_options`
--

CREATE TABLE IF NOT EXISTS `tbl_mst_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `unit_price` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_mst_options`
--

INSERT INTO `tbl_mst_options` (`id`, `name`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 'Tiền game', 10000, '2013-11-05 00:00:00', '2013-11-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `machine_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `begin` datetime NOT NULL,
  `end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `total_amount` float NOT NULL,
  `plus` float NOT NULL,
  `discount` float NOT NULL,
  `status_id` int(11) NOT NULL,
  `status_msg` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `machine_id`, `name`, `begin`, `end`, `total_amount`, `plus`, `discount`, `status_id`, `status_msg`, `created_at`, `updated_at`) VALUES
(1, 2, 'Máy số 2', '2013-11-13 12:59:16', '2013-11-13 15:59:00', 60000, 0, 2000, 0, 'Kết thúc', '2013-11-13 12:59:16', '2013-11-13 14:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_plus`
--

CREATE TABLE IF NOT EXISTS `tbl_order_plus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `total_amount` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE IF NOT EXISTS `tbl_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `unit_price` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `name`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 'Mì gói', 10000, '2013-11-01 06:27:43', '2013-11-01 06:27:43'),
(2, 'Thuốc lá Jet', 1000, '2013-11-01 06:30:48', '2013-11-01 06:30:48'),
(3, 'Thuốc lá Mèo', 1000, '2013-11-01 06:31:09', '2013-11-01 06:31:09'),
(4, 'Nước tăng lực', 10000, '2013-11-01 06:32:13', '2013-11-01 06:32:13'),
(5, 'Trà xanh 0 độ', 12000, '2013-11-01 06:34:36', '2013-11-01 06:34:36');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
