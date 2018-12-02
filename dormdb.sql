-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2018 at 12:55 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dormdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `autonum`
--

CREATE TABLE `autonum` (
  `id` int(10) UNSIGNED NOT NULL,
  `autonum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `autonum`
--

INSERT INTO `autonum` (`id`, `autonum`, `created_at`, `updated_at`) VALUES
(1, '201811172011370', '2018-11-17 13:11:37', '2018-11-17 13:11:37'),
(2, '201811172013251', '2018-11-17 13:13:25', '2018-11-17 13:13:25'),
(3, '201811172016092', '2018-11-17 13:16:09', '2018-11-17 13:16:09'),
(4, '201811172017153', '2018-11-17 13:17:15', '2018-11-17 13:17:15'),
(5, '201811172017154', '2018-11-17 13:17:15', '2018-11-17 13:17:15'),
(6, '201811191627495', '2018-11-19 09:27:49', '2018-11-19 09:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`, `number`, `created_at`, `updated_at`) VALUES
(1, 'พร้อมเพย์', '0950049666', '2018-11-17 13:05:39', '2018-11-17 13:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `status` int(11) NOT NULL,
  `paid` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `name`, `mobile`, `booking`, `room`, `checkin`, `status`, `paid`, `price`, `created_at`, `updated_at`) VALUES
(1, 'นาง วิภารัตน์ เพ็ชรวิสูตร', '0950049666', '201811172011370', 1101, '2018-11-17', 2, '1', '3500', '2018-11-17 13:11:37', '2018-11-17 13:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `received` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `num` int(10) UNSIGNED NOT NULL,
  `id` int(11) NOT NULL,
  `room` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `cancel` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`num`, `id`, `room`, `contract`, `term`, `start`, `end`, `cancel`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '1101', '1/2018', '12', '2018-11-01', '2019-10-01', '2018-11-17', 1, '2018-11-17 13:13:25', '2018-11-17 13:17:15'),
(2, 2, '1102', '2/2018', '12', '2018-11-01', '2019-10-01', NULL, 0, '2018-11-17 13:17:15', '2018-11-17 13:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `name`, `discount`, `created_at`, `updated_at`) VALUES
(2, 'ส่วนสดสำหรับการเช่า 12 เดือน', '-1500', '2018-11-17 13:15:37', '2018-11-17 13:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `familys`
--

CREATE TABLE `familys` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relationship` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `familys`
--

INSERT INTO `familys` (`id`, `name`, `relationship`, `mobile`, `created_at`, `updated_at`) VALUES
(2, 'Thadpakorn Phetwisut', 'ลูก', '0950049666', '2018-11-17 13:14:00', '2018-11-17 13:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `inbox_reply`
--

CREATE TABLE `inbox_reply` (
  `id` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inbox` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `water` int(11) NOT NULL,
  `power` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice`, `contract`, `due`, `year`, `ref`, `service`, `discount`, `water`, `power`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, '201811172013251', '1', NULL, NULL, '3500', 'ส่วนสดสำหรับการเช่า 12 เดือน', '-1500', 100, 100, 1, 1, '2018-11-17 13:13:25', '2018-11-17 13:16:09'),
(2, '201811172017153', '2', NULL, NULL, '5500', 'ส่วนสดสำหรับการเช่า 12 เดือน', '-1500', 100, 100, 1, 1, '2018-11-17 13:17:15', '2018-11-19 09:27:49'),
(3, '201811172017154', '1', '11', '2018', NULL, NULL, NULL, 120, 200, 2, 0, '2018-11-17 13:17:15', '2018-11-17 13:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
('201811172017154', 'ค่าทำความสะอาดห้องพัก', '200', '2018-11-17 13:17:15', '2018-11-17 13:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `mailling`
--

CREATE TABLE `mailling` (
  `id` int(10) UNSIGNED NOT NULL,
  `topic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gateways` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texts` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(24, '2014_10_12_000000_create_users_table', 1),
(25, '2014_10_12_100000_create_password_resets_table', 1),
(26, '2018_10_02_163303_create_profiles_table', 1),
(27, '2018_10_02_165112_create_familys_table', 1),
(28, '2018_10_05_112740_create_setting_table', 1),
(29, '2018_10_05_115619_create_autonum_table', 1),
(30, '2018_10_06_092102_create_rooms_table', 1),
(31, '2018_10_06_093129_create_sms_table', 1),
(32, '2018_10_07_081945_create_contact_table', 1),
(33, '2018_10_08_114559_create_events_table', 1),
(34, '2018_10_08_125501_create_sending_table', 1),
(35, '2018_10_09_141636_create_point_table', 1),
(36, '2018_10_09_182832_create_discount_table', 1),
(37, '2018_10_11_114942_create_booking_table', 1),
(38, '2018_10_15_104213_create_bank_table', 1),
(39, '2018_10_15_165513_create_contract_table', 1),
(40, '2018_10_17_135446_create_inbox_reply_table', 1),
(41, '2018_10_17_163119_create_invoice_table', 1),
(42, '2018_10_18_081705_create_mailling_table', 1),
(43, '2018_10_18_222428_create_payment_table', 1),
(44, '2018_10_20_174728_create_uploads_table', 1),
(45, '2018_10_21_153637_create_services_table', 1),
(46, '2018_11_06_204342_create_invoices_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `invoice`, `payment`, `month`, `year`, `total`, `status`, `created_at`, `updated_at`) VALUES
(2, '201811172013251', '201811172016092', '11', '2018', '5500', 0, '2018-11-17 13:16:09', '2018-11-17 13:16:09'),
(2, '201811172017153', '201811191627495', '11', '2018', '5500', 0, '2018-11-19 09:27:49', '2018-11-19 09:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `point`
--

CREATE TABLE `point` (
  `id` int(11) NOT NULL,
  `point` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `idcard` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hbd` date NOT NULL,
  `mobile` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `career` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `idcard`, `nickname`, `hbd`, `mobile`, `address`, `career`, `img`, `created_at`, `updated_at`) VALUES
(1, '1860600048510', 'อาร์ม', '1992-03-25', '0950049666', '119/2 ต้นมะม่วง', NULL, '1542448213.SDch6FazeI.jpg', '2018-11-17 09:50:13', '2018-11-17 09:50:13'),
(2, '1860600048510', 'ตุ๊กตา', '1992-03-25', '0950049666', '10 หมู่ 6 พะโต๊ะ พะโต๊ะ ชุมพร 86180', 'พนักงานบริษัท', '1542460200.0D5Avua7R7.jpg', '2018-11-17 13:10:01', '2018-11-17 13:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `price`, `floor`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, '1101', '3500', '1', 'Standard Room', 0, '2018-11-17 13:04:29', '2018-11-17 13:17:15'),
(2, '1102', '3500', '1', 'Standard Room', 2, '2018-11-17 13:04:38', '2018-11-17 13:17:15'),
(3, '1103', '3900', '2', 'Superior Room', 0, '2018-11-17 13:04:48', '2018-11-17 13:04:48'),
(4, '1104', '4000', '2', 'Deluxe Room', 0, '2018-11-17 13:05:06', '2018-11-17 13:05:06'),
(5, '1105', '4500', '3', 'Suite Room', 0, '2018-11-17 13:05:21', '2018-11-17 13:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `sending`
--

CREATE TABLE `sending` (
  `id` int(10) UNSIGNED NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gateways` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texts` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sending`
--

INSERT INTO `sending` (`id`, `mobile`, `gateways`, `texts`, `created_at`, `updated_at`) VALUES
(1, '0950049666', 'THSMS.COM', 'รหัสผ่านของท่านคือ pIoExw', '2018-11-17 13:10:01', '2018-11-17 13:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `num` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `num`, `name`, `price`, `created_at`, `updated_at`) VALUES
(2, 1, 'ส่วนสดสำหรับการเช่า 12 เดือน', '-1500', '2018-11-17 13:15:49', '2018-11-17 13:15:49'),
(3, 2, 'ส่วนสดสำหรับการเช่า 12 เดือน', '-1500', '2018-11-19 09:27:13', '2018-11-19 09:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `iddorm` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_th` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate_water` int(11) NOT NULL,
  `rate_elec` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `due` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `die` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_limit` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `iddorm`, `name_en`, `name_th`, `address`, `email`, `phone`, `rate_water`, `rate_elec`, `vat`, `due`, `die`, `pay`, `pay_limit`, `bank`, `contract`, `logo`, `created_at`, `updated_at`) VALUES
(1, '1234567890123', 'Thadpakorn', 'ธรรศฌ์ปกรณ์', '119/2 ต้นมะม่วง', 'thadpakorn.p@outlook.com', '0950049666', 10, 8, 0, '05', '25', '50', '750', 'ธรรศฌ์ปกรณ์ เพ็ชรวิสูตร', 'ธรรศฌ์ปกรณ์ เพ็ชรวิสูตร', '1542448280.yNqCfPerMa.jpg', '2018-11-17 09:51:20', '2018-11-17 09:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(10) UNSIGNED NOT NULL,
  `gateway` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`id`, `gateway`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'THSMS.COM', '0950049666', 'eyJpdiI6ImpoNXZxZzI2Nzl3WnZ2MElkbzc1Rmc9PSIsInZhbHVlIjoiS1FWMTJDUnZyQWE5N2JkdEEzY2pWUT09IiwibWFjIjoiZTA3Y2FiMTY4ZTlmODYwMmVjYzkyMDUxMTdjOTg1MWFiOWNhNDU0NmUxMDNkNjJhODQ3NTQ3OWQ1MzBkNDgyZiJ9', '2018-11-17 13:08:03', '2018-11-17 13:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(10) UNSIGNED NOT NULL,
  `num` int(11) NOT NULL,
  `files` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `num`, `files`, `created_at`, `updated_at`) VALUES
(1, 1, '1542622008.NUEjgZsG5LEWwnL.jpg', '2018-11-19 10:06:48', '2018-11-19 10:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `profile`, `status`, `point`) VALUES
(1, 'Thadpakorn Phetwisut', 'thadpakorn.p@outlook.com', NULL, '$2y$10$JM7CgGe0t2Hoo2mYSMy8jelEKNZxLhPxWqXlkbl5F4cCDS.pwQJ2C', 'pnVvkMu7aQbAdFknXdJBXgZm58dAhZqz1Haqog5e6PloplFB0RLbKy6Eq2s0', '2018-11-17 09:49:42', '2018-11-17 09:49:42', 'admin', 1, NULL),
(2, 'วิภารัตน์ เพ็ชรวิสูตร', 'thadpakorn.p@gmail.com', NULL, '$2y$10$IeRC746R6FZNMgOnhIgKde..c/nBLdc1uJ0PRtN9yGpA7f0v.9w/2', NULL, '2018-11-17 13:06:03', '2018-11-17 13:10:01', 'user', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autonum`
--
ALTER TABLE `autonum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailling`
--
ALTER TABLE `mailling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD UNIQUE KEY `profiles_id_unique` (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sending`
--
ALTER TABLE `sending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autonum`
--
ALTER TABLE `autonum`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `num` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mailling`
--
ALTER TABLE `mailling`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sending`
--
ALTER TABLE `sending`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
