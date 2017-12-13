-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2017 at 11:10 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `msct_martvillage`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `company_id`, `name`, `unit`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Weight', 'kg', 'N', 1, 0, '2017-12-11 03:37:05', '2017-12-11 03:37:05'),
(2, 1, 'Size', 'ft3', 'N', 1, 0, '2017-12-11 03:37:25', '2017-12-11 03:37:25'),
(3, 1, 'Insurance', '%', 'N', 1, 0, '2017-12-11 03:37:40', '2017-12-11 03:37:40'),
(4, 1, 'Document', 'pcs', 'N', 1, 0, '2017-12-11 03:37:59', '2017-12-11 03:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) unsigned NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `building_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `location` text COLLATE utf8_unicode_ci,
  `expiry_date` date NOT NULL,
  `return_period` int(11) NOT NULL,
  `gst_rate` double(12,2) NOT NULL,
  `service_rate` double(12,2) NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `contact_no`, `short_code`, `fax`, `email`, `logo`, `unit_number`, `building_name`, `street`, `country_id`, `state_id`, `township_id`, `address`, `location`, `expiry_date`, `return_period`, `gst_rate`, `service_rate`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'MSCT', '6333 4292', 'MSCT', '', 'msctpteltd@gmail.com', '', '', '', '', 1, 1, 1, '', '', '2018-12-31', 60, 7.00, 7.00, 'N', 1, 1, '2017-12-11 03:10:58', '2017-12-11 03:32:14'),
(2, 'Zay Myitta', '+95 930093314 ', 'ZMT', NULL, 'zayar.zayar03@gmail.com', '', '6th Floor (A)', '93', 'Aungzayya Street', 2, 2, 2, '6th Floor (A)-93, Aungzayya Street, ', NULL, '2020-12-31', 30, 5.00, 5.00, 'N', 1, 0, '2017-12-11 03:44:48', '2017-12-11 03:44:48'),
(3, 'Shwe Mandalar', '1234567890', 'SMDL', NULL, 'smdl@gmail.com', '', '', '', '', 2, 2, 2, '', NULL, '2019-12-31', 90, 7.00, 7.00, 'N', 1, 1, '2017-12-12 03:11:44', '2017-12-12 03:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `companies_countries`
--

CREATE TABLE IF NOT EXISTS `companies_countries` (
  `companies_id` int(10) unsigned NOT NULL,
  `countries_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies_countries`
--

INSERT INTO `companies_countries` (`companies_id`, `countries_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `companies_states`
--

CREATE TABLE IF NOT EXISTS `companies_states` (
  `companies_id` int(10) unsigned NOT NULL,
  `states_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies_states`
--

INSERT INTO `companies_states` (`companies_id`, `states_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(1, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `companies_townships`
--

CREATE TABLE IF NOT EXISTS `companies_townships` (
  `companies_id` int(10) unsigned NOT NULL,
  `townships_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies_townships`
--

INSERT INTO `companies_townships` (`companies_id`, `townships_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL,
  `country_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_cities` int(11) NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `description`, `country_code`, `total_cities`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Singapore', 'Singapore (စကၤာပူ)', 'SG', 1, 'N', 1, 0, '2017-12-11 03:11:09', '2017-12-11 03:17:38'),
(2, 'Myanmar', 'Myanmar (ျမန္မာ)', 'MM', 2, 'N', 1, 0, '2017-12-11 03:12:13', '2017-12-12 04:10:57'),
(3, 'Japan', 'Japan (ဂ်ပန္)', 'JP', 0, 'N', 1, 0, '2017-12-11 03:13:26', '2017-12-11 03:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_location` int(11) NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `company_id`, `type`, `from_location`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'SGD', 1, 'N', 3, 0, '2017-12-11 04:13:46', '2017-12-11 04:13:46'),
(2, 2, 'MMK', 2, 'N', 3, 0, '2017-12-11 04:19:45', '2017-12-11 04:19:45');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL,
  `lotin_id` int(11) NOT NULL,
  `outgoing_id` int(11) NOT NULL,
  `packing_id` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_price` double(12,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double(12,2) NOT NULL,
  `status` enum('0','1','2','3') COLLATE utf8_unicode_ci NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `lotin_id`, `outgoing_id`, `packing_id`, `item_name`, `barcode`, `price_id`, `category_id`, `currency_id`, `unit`, `unit_price`, `quantity`, `amount`, `status`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 'Food', '00000000001', 1, 1, 2, '5', 1000.00, 1, 5000.00, '0', 'N', 3, 0, '2017-12-13 06:14:43', '2017-12-13 06:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `lotins`
--

CREATE TABLE IF NOT EXISTS `lotins` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `lot_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `outgoing_date` date NOT NULL,
  `incoming_date` date NOT NULL,
  `collected_date` date NOT NULL,
  `from_country` int(11) NOT NULL,
  `from_state` int(11) NOT NULL,
  `to_country` int(11) NOT NULL,
  `to_state` int(11) NOT NULL,
  `member_discount` double(5,2) NOT NULL,
  `member_discount_amt` double(12,2) NOT NULL,
  `other_discount_type` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_discount` double(5,2) NOT NULL,
  `other_discount_amt` double(12,2) NOT NULL,
  `gov_tax` double(5,2) NOT NULL,
  `gov_tax_amt` double(12,2) NOT NULL,
  `service_charge` double(5,2) NOT NULL,
  `service_charge_amt` double(12,2) NOT NULL,
  `total_amt` double(12,2) NOT NULL,
  `net_amt` double(12,2) NOT NULL,
  `payment` enum('Paid','Credit') COLLATE utf8_unicode_ci NOT NULL,
  `total_items` int(11) NOT NULL,
  `status` enum('0','1','2','3') COLLATE utf8_unicode_ci NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lotins`
--

INSERT INTO `lotins` (`id`, `company_id`, `user_id`, `sender_id`, `receiver_id`, `lot_no`, `date`, `time`, `outgoing_date`, `incoming_date`, `collected_date`, `from_country`, `from_state`, `to_country`, `to_state`, `member_discount`, `member_discount_amt`, `other_discount_type`, `other_discount`, `other_discount_amt`, `gov_tax`, `gov_tax_amt`, `service_charge`, `service_charge_amt`, `total_amt`, `net_amt`, `payment`, `total_items`, `status`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 1, 1, '20171213ZMT0001', '2017-12-13', '00:00:00', '0000-00-00', '0000-00-00', '0000-00-00', 2, 3, 2, 2, 5.00, 250.00, NULL, 0.00, 0.00, 5.00, 250.00, 5.00, 250.00, 5000.00, 5250.00, 'Paid', 1, '0', 'N', 3, 3, '2017-12-13 06:14:43', '2017-12-13 09:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `member_offers_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `nric_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nric_code_id` int(11) NOT NULL,
  `nric_township_id` int(11) NOT NULL,
  `gender` enum('Female','Male') COLLATE utf8_unicode_ci NOT NULL,
  `marital_status` enum('Single','Married','Separated','Divorced','Widowed','Single Parent') COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `building_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `company_id`, `member_offers_id`, `name`, `dob`, `nric_no`, `nric_code_id`, `nric_township_id`, `gender`, `marital_status`, `contact_no`, `member_no`, `email`, `unit_number`, `building_name`, `street`, `country_id`, `state_id`, `township_id`, `address`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 'WEEP', '1989-08-12', '', 0, 0, 'Female', 'Single', '+95 9402786013', 'ZMT201712000001', 'weep@gmail.com', '', '', '', 2, 2, 2, '', 'N', 3, 3, '2017-12-12 06:36:46', '2017-12-12 06:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `member_offers`
--

CREATE TABLE IF NOT EXISTS `member_offers` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate` double(5,2) NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member_offers`
--

INSERT INTO `member_offers` (`id`, `company_id`, `type`, `rate`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Type 1', 2.00, 'N', 3, 0, '2017-12-11 04:53:02', '2017-12-11 04:53:02'),
(2, 2, 'Type 2', 3.00, 'N', 3, 0, '2017-12-11 04:55:40', '2017-12-11 04:55:40'),
(3, 2, 'Type 3', 5.00, 'N', 3, 0, '2017-12-11 04:55:55', '2017-12-11 04:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_08_28_084341_create_tbl_nric_code', 1),
('2017_08_28_084646_create_tbl_nric_township', 1),
('2017_08_29_053259_entrust_setup_tables', 1),
('2017_08_29_061709_create_tbl_companies', 1),
('2017_08_29_065245_create_tbl_countries', 1),
('2017_08_29_071134_create_tbl_states', 1),
('2017_08_29_071353_create_tbl_townships', 1),
('2017_08_29_071505_create_tbl_nationality', 1),
('2017_09_02_224739_create_tbl_categories', 1),
('2017_09_02_225436_create_tbl_prices', 1),
('2017_09_02_231917_create_tbl_currency', 1),
('2017_09_07_235226_create_tbl_members', 1),
('2017_09_08_113447_create_tbl_senders', 1),
('2017_09_08_113510_create_tbl_receivers', 1),
('2017_09_10_170118_create_tbl_lotins', 1),
('2017_09_11_184134_create_tbl_items', 1),
('2017_09_15_140650_create_tbl_price_titles', 1),
('2017_09_27_154236_create_tbl_outgoings', 1),
('2017_10_17_145033_create_tbl_packings', 1),
('2017_12_07_100800_create_tbl_member_offers', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE IF NOT EXISTS `nationality` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nric_codes`
--

CREATE TABLE IF NOT EXISTS `nric_codes` (
  `id` int(10) unsigned NOT NULL,
  `nric_code` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nric_codes`
--

INSERT INTO `nric_codes` (`id`, `nric_code`, `description`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kachin State (ကခ်င္)', 'N', 1, 1, '2017-12-11 03:09:25', '2017-12-11 03:09:25'),
(2, 2, 'Kayah State (ကယား)', 'N', 1, 1, '2017-12-11 03:09:25', '2017-12-11 03:09:25'),
(3, 3, 'Kayin State (ကရင္)', 'N', 1, 1, '2017-12-11 03:09:25', '2017-12-11 03:09:25'),
(4, 4, 'Chin State (ခ်င္း)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26'),
(5, 5, 'Sagaing Division (စစ္ကိုင္း)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26'),
(6, 6, 'Tanintharyi Division (တနသၤာရီ)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26'),
(7, 7, 'Bago Division (ပဲခူး)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26'),
(8, 8, 'Magway Division (မေကြး)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26'),
(9, 9, 'Mandalay Division (မႏၲေလး)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26'),
(10, 10, 'Mon State (မြန္)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26'),
(11, 11, 'Rakhine State (ရခိုင္)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26'),
(12, 12, 'Yangon Division (ရန္ကုန္)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26'),
(13, 13, 'Shan State (ရွမ္း)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26'),
(14, 14, 'Ayeyarwady Division (ဧရာ၀တီ)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26'),
(15, 15, 'Naypyitaw (ေနျပည္ေတာ္)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26'),
(16, 16, 'Other (အျခား)', 'N', 1, 1, '2017-12-11 03:09:26', '2017-12-11 03:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `nric_townships`
--

CREATE TABLE IF NOT EXISTS `nric_townships` (
  `id` int(10) unsigned NOT NULL,
  `nric_code_id` int(11) NOT NULL,
  `township` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `serial_no` int(11) NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=338 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nric_townships`
--

INSERT INTO `nric_townships` (`id`, `nric_code_id`, `township`, `short_name`, `serial_no`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chipwi (ခ်ီေဗြ)', 'ခဗန', 1, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(2, 1, 'Khaunglanhpu (ေခါင္လန္ဖူး)', 'ခလဖ', 2, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(3, 1, 'Nawngmun (ေနာင္မြန္း)', 'နမန', 3, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(4, 1, 'Puta-O (ပူတာအို)', 'ပတအ', 4, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(5, 1, 'Hpakan (ဖားကန္႕)', 'ဖကန', 5, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(6, 1, 'Bamaw (ဗန္းေမာ္)', 'ဗမန', 6, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(7, 1, 'Machanbaw (မခ်မ္းေဘာ)', 'မခဘ', 7, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(8, 1, 'Mansi (မံစီ)', 'မစန', 8, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(9, 1, 'Mogaung (မိုးေကာင္း)', 'မကတ', 9, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(10, 1, 'Mohnyin (မိုးၫွင္း)', 'မညန', 10, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(11, 1, 'Momauk (မိုးေမာက္)', 'မမန', 11, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(12, 1, 'Myitkyina (ျမစ္ႀကီးနား)', 'မကန', 12, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(13, 1, 'Shwegu (ေရႊကူ)', 'ရကန', 13, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(14, 1, 'Waingmaw (၀ိုင္းေမာ္)', '၀မန', 14, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(15, 1, 'N Jang Yang (အင္ဂ်န္းယန္)', 'အဂယ', 15, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(16, 1, 'Sumprabum', 'ဆပဘ', 16, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(17, 1, 'Tanai', 'တနန', 17, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(18, 1, 'Tsawlaw', 'ထလန', 18, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(19, 2, 'Shadaw', 'စဒန', 1, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(20, 2, 'Demoso (ဒီေမာဆို)', 'ဒမဆ', 2, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(21, 2, 'Bawlakhe (ေဘာ္လခဲ)', 'ဘလခ', 3, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(22, 2, 'Mese (မယ္စဲ့)', 'မစန', 4, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(23, 2, 'Loikaw (လိြဳင္ေကာ္)', 'လကန', 5, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(24, 2, 'Hpasawng (ဖားေဆာင္း)', 'ဟဆန', 6, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(25, 2, 'Hpruso (ဖရူဆို)', 'ဟရဆ', 7, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(26, 3, 'Kawkareik (ေကာ့ကရိတ္)', 'ကကရ', 1, 'N', 1, 1, '2017-12-11 03:09:57', '2017-12-11 03:09:57'),
(27, 3, 'Kyain Seikgyi (ၾကာအင္းဆိပ္ႀကီး)', 'ကအဆ', 2, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(28, 3, 'Hpapun (ဖာပြန္)', 'ဖပန', 3, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(29, 3, 'Hpa-An (ဘားအံ)', 'ဘအန', 4, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(30, 3, 'Myawaddy (ျမ၀တီ)', 'မ၀တ', 5, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(31, 3, 'Hlaingbwe (လိႈင္းဘြဲ႕)', 'လဘန', 6, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(32, 3, 'Thandaung (သံေတာင္)', 'သတန', 7, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(33, 4, 'Kanpetlet (ကန္ပက္လက္)', 'ကပလ', 1, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(34, 4, 'Tonzang (တြန္းဇံ)', 'တဇန', 2, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(35, 4, 'Tedim (တီးတိန္)', 'တတန', 3, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(36, 4, 'Htantlang (ထန္တလန္)', 'ထတလ', 4, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(37, 4, 'Paletwa (ပလက္၀)', 'ပလ၀', 5, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(38, 4, 'Falam (ဖလမ္း)', 'ဖလန', 6, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(39, 4, 'Mindat (မင္းတပ္)', 'မတန', 7, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(40, 4, 'Madupi (မတူပီ)', 'မတပ', 8, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(41, 4, 'Hakha (ဟားခါး)', 'ဟခန', 9, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(42, 5, 'Kani (ကန္နီ)', 'ကနန', 1, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(43, 5, 'Kanbalu (ကန္႕ဘလူ)', 'ကဘလ', 2, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(44, 5, 'Kale (ကေလး)', 'ကလထ', 3, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(45, 5, 'Kawlin (ေကာလင္း)', 'ကလန', 4, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(46, 5, 'Kalewa (ကေလး၀)', 'ကလ၀', 5, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(47, 5, 'Kyunhla (ကြ်န္းလွ)', 'ကလန', 6, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(48, 5, 'Katha (ကသာ)', 'ကသန', 7, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(49, 5, 'Khin-U (ခင္ဦး)', 'ခဥန', 8, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(50, 5, 'Hkamti (ခႏၲီး)', 'ခတန', 9, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(51, 5, 'Chaung-U (ေခ်ာင္းဦး)', 'ခဥန', 10, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(52, 5, 'Sagaing (စစ္ကိုင္း)', 'စကန', 11, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(53, 5, 'Salingyi (ဆားလင္းႀကီး)', 'ဆလက', 12, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(54, 5, 'Taze (တန္႕ဆည္)', 'တဆန', 13, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(55, 5, 'Tamu (တမူး)', 'တမန', 14, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(56, 5, 'Tigyaing (ထီးခ်ိဳင့္)', 'ထခန', 15, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(57, 5, 'Tabayin (ဒီပဲယင္း)', 'ဒပယ', 16, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(58, 5, 'Nanyun (နန္းယြန္း)', 'နယန', 17, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(59, 5, 'Pale (ပုလဲ)', 'ပလန', 18, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(60, 5, 'Pinlebu (ပင္လည္ဘူး)', 'ပလဘ', 19, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(61, 5, 'Paungbyin (ေဖါင္းျပင္)', 'ဖပန', 20, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(62, 5, 'Banmauk (ဗန္းေမာက္)', 'ဗမန', 21, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(63, 5, 'Budalin (ဘုတလင္)', 'ဘတလ', 22, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(64, 5, 'Mingin (မင္းကင္း)', 'မကန', 23, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(65, 5, 'Myaung (ေျမာင္)', 'မန', 24, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(66, 5, 'Myinmu (ျမင္းမူ)', 'မမန', 25, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(67, 5, 'Monywa (မံုရြာ)', 'မရန', 26, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(68, 5, 'Mawlaik (ေမာ္လိုက္)', 'မလန', 27, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(69, 5, 'Yinmabin (ယင္းမာပင္)', 'ယမပ', 28, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(70, 5, 'Shwebo (ေရႊဘို)', 'ရဘန', 29, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(71, 5, 'Ye-U (ေရဦး)', 'ရဥန', 30, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(72, 5, 'Lay Shi (ေလရွီး)', 'လရန', 31, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(73, 5, 'Lahe (လဟယ္)', 'လဟန', 32, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(74, 5, 'Wetlet (၀က္လက္)', '၀လန', 33, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(75, 5, 'Wuntho (၀န္းသို)', '၀သန', 34, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(76, 5, 'Homalin (ဟုမၼလင္း)', 'ဟမလ', 35, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(77, 5, 'Indaw (အင္းေတာ္)', 'အတန', 36, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(78, 5, 'Ayadaw (အရာေတာ္)', 'အရတ', 37, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(79, 6, 'Kyunsu (ကြ်န္းစု)', 'ကစန', 1, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(80, 6, 'Kawthoung (ေကာ့ေသာင္း)', 'ကသန', 2, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(81, 6, 'Tanintharyi (တနသၤာရီ)', 'တသရ', 3, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(82, 6, 'Dawei (ထား၀ယ္)', 'ထ၀န', 4, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(83, 6, 'Palaw (ပုေလာ)', 'ပလန', 5, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(84, 6, 'Bokpyin (ဘုတ္ျပင္း)', 'ဘပန', 6, 'N', 1, 1, '2017-12-11 03:09:58', '2017-12-11 03:09:58'),
(85, 6, 'Myeik (ျမိတ္)', 'မမန', 7, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(86, 6, 'Yebyu (ေရျဖဴ)', 'ရဖန', 8, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(87, 6, 'Launglon (ေလာင္းလံု)', 'လလန', 9, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(88, 6, 'Thayetchaung (သရက္ေခ်ာင္း)', 'သရခ', 10, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(89, 7, 'Kyaukkyi (ေက်ာက္ႀကီး)', 'ကကန', 1, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(90, 7, 'Kyauktaga (ေက်ာက္တံခါး)', 'ကတခ', 2, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(91, 7, 'Gyobingauk (ႀကိဳ႕ပင္ေကာက္)', 'ကပက', 3, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(92, 7, 'Kawa (က၀)', 'က၀န', 4, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(93, 7, 'Zigon (ဇီးကုန္း)', 'ဇကန', 5, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(94, 7, 'Nyaung Lay Pin (ေညာင္ေလးပင္)', 'ညလပ', 6, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(95, 7, 'Taungoo (ေတာင္ငူ)', 'တငန', 7, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(96, 7, 'Htantabin (ထန္းတပင္)', 'ထတပ', 8, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(97, 7, 'Daik-U (ဒိုက္ဦး)', 'ဒဥန', 9, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(98, 7, 'Nattalin (နတ္တလင္း)', 'နတလ', 10, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(99, 7, 'Bago (ပဲခူး)', 'ပခန', 11, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(100, 7, 'Pauk Kaung (ေပါက္ေခါင္း)', 'ပခန', 12, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(101, 7, 'Padaung (ပန္းေတာင္း)', 'ပတတ', 13, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(102, 7, 'Paungde (ေပါင္းတည္)', 'ပတန', 14, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(103, 7, 'Pyay (ျပည္)', 'ပမန', 15, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(104, 7, 'Phyu (ျဖဴးး)', 'ဖမန', 16, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(105, 7, 'Monyo (မိုးညိဳ)', 'မညန', 17, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(106, 7, 'Minhla (မင္းလွ)', 'မလန', 18, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(107, 7, 'Shwegyin (ေရႊက်င္)', 'ရကန', 19, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(108, 7, 'Shwedaung (ေရႊေတာင္)', 'ရတန', 20, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(109, 7, 'Yedashe (ေရတာရွည္)', 'ရတရ', 21, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(110, 7, 'Letpadan (လက္ပံတန္း)', 'လပတ', 22, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(111, 7, 'Waw (ေ၀ါ)', '၀မန', 23, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(112, 7, 'Thegon (သဲကုန္း)', 'သကန', 24, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(113, 7, 'Thanatpin (သနပ္ပင္)', 'သနပ', 25, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(114, 7, 'Thayarwady (သာယာ၀တီ)', 'သ၀တ', 26, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(115, 7, 'Oktwin (အုတ္တြင္း)', 'အတန', 27, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(116, 7, 'Okpho (အုတ္ဖို)', 'အဖန', 28, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(117, 8, 'Kamma (ကန္မ)', 'ကမန', 1, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(118, 8, 'Chauk (ေခ်ာက္)', 'ခန', 2, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(119, 8, 'Gangaw (ဂန္႕ေဂါ)', 'ဂဂန', 3, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(120, 8, 'Ngape (ငဖဲ)', 'ငဖန', 4, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(121, 8, 'Sidoktaya (ေစတုတၱရာ)', 'စတရ', 5, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(122, 8, 'Salin (စလင္း)', 'စလန', 6, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(123, 8, 'Sinbaungwe (ဆင္ေပါင္၀ဲ)', 'ဆပ၀', 7, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(124, 8, 'Seikphyu (ဆိတ္ျဖဴ)', 'ဆဖန', 8, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(125, 8, 'Saw (ေဆာ)', 'ဆမန', 9, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(126, 8, 'Taungdwingyi (ေတာင္တြင္းႀကီး)', 'တတက', 10, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(127, 8, 'Tilin (ထီးလင္း)', 'ထလန', 11, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(128, 8, 'Natmauk (နတ္ေမာက္)', 'နမန', 12, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(129, 8, 'Pakokku (ပခုကၠဴ)', 'ပခက', 13, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(130, 8, 'Pauk (ေပါက္)', 'ပန', 14, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(131, 8, 'Pwintbyu (ပြင့္ျဖဴ)', 'ပဖန', 15, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(132, 8, 'Magway (မေကြး)', 'မကန', 16, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(133, 8, 'Mindon (မင္းတုန္း)', 'မတန', 17, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(134, 8, 'Minbu (မင္းဘူး)', 'မဘန', 18, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(135, 8, 'Myaing (ၿမိဳင္)', 'မမန', 19, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(136, 8, 'Minhla (မင္းလွ)', 'မလန', 20, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(137, 8, 'Myothit (ၿမိဳ႕သစ္)', 'မသန', 21, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(138, 8, 'Yesagyo (ေရစႀကိဳ)', 'ရစက', 22, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(139, 8, 'Yenangyaung (ေရနံေခ်ာင္း)', 'ရနခ', 23, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(140, 8, 'Thayet (သရက္)', 'သရန', 24, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(141, 8, 'Aunglan (ေအာင္လံ)', 'အလန', 25, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(142, 9, 'Kyaukse (ေက်ာက္ဆည္)', 'ကဆန', 1, 'N', 1, 1, '2017-12-11 03:09:59', '2017-12-11 03:09:59'),
(143, 9, 'Mahar Myaing (မဟာၿမိဳင္​)', 'မဟမ', 1, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(144, 9, 'Kyaukpadaung (ေက်ာက္ပန္းေတာင္း)', 'ကပတ', 2, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(145, 9, 'Chanmyathazi (ခ်မ္းျမသာစည္)', 'ခသစ', 3, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(146, 9, 'Chanayethazan (ခ်မ္းေအးသာဇံ)', 'ခအဇ', 4, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(147, 9, 'Ngazun (ငါန္းဇြန္)', 'ငဇန', 5, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(148, 9, 'Sintgaing (စဥ္႕ကိုင္)', 'စကတ', 6, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(149, 9, 'Singu (စဥ္႕ကူး)', 'စကန', 7, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(150, 9, 'Nyaung-U (ေညာင္ဦး)', 'ညဥန', 8, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(151, 9, 'Tatkon (တပ္ကုန္း)', 'တကန', 9, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(152, 9, 'Tada-U (တံတားဦး)', 'တတဥ', 10, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(153, 9, 'Taungtha (ေတာင္သာ)', 'တသန', 11, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(154, 9, 'Natogyi (ႏြားထိုးႀကီး)', 'နထက', 12, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(155, 9, 'Pyigyitagon (ျပည္ႀကီးတံခြန္)', 'ပကတ', 13, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(156, 9, 'Pyawbwe (ေပ်ာ္ဘြယ္)', 'ပဘန', 14, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(157, 9, 'Pyinmana (ပ်ဥ္းမနား)', 'ပမန', 15, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(158, 9, 'Patheingyi (ပုသိမ္ႀကီး)', 'ပသက', 16, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(159, 9, 'Pyinoolwin (ျပင္ဦးလြင္)', 'ပဥလ', 17, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(160, 9, 'Mogoke (မိုးကုတ္)', 'မကန', 18, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(161, 9, 'Myingyan (ျမင္းျခံ)', 'မခန', 19, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(162, 9, 'Madaya (မတၱရာ)', 'မတရ', 20, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(163, 9, 'Meiktila (မိတၳီလာ)', 'မထလ', 21, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(164, 9, 'မႏၱေလးအေရွ႔ေတာင္', 'မရတ', 22, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(165, 9, 'Mahlaing (မလႈိင္)', 'မလန', 23, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(166, 9, 'Myittha (ျမစ္သား)', 'မသန', 24, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(167, 9, 'Mahaaungmyay (မဟာေအာင္ေျမ)', 'မအမ', 25, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(168, 9, 'Yamethin (ရမည္းသင္း)', 'ရမသ', 26, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(169, 9, 'Lewe (လယ္ေ၀း)', 'လ၀န', 27, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(170, 9, 'Wundwin (၀မ္းတြင္း)', '၀တန', 28, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(171, 9, 'Thazi (သာစည္)', 'သစန', 29, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(172, 9, 'Thabeikkyin (သပိတ္က်င္း)', 'သပက', 30, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(173, 9, 'Aungmyaythazan (ေအာင္ေျမသာဇံ)', 'အမဇ', 31, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(174, 9, 'Amarapura (အမရပူရ)', 'အမရ', 32, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(175, 10, 'Kyaikto (က်ိဳက္ထို)', 'ကထန', 1, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(176, 10, 'Kyaikmaraw (က်ိဳက္မေရာ)', 'ကမရ', 2, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(177, 10, 'Chaungzon (ေခ်ာင္းဆံု)', 'ခဆန', 3, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(178, 10, 'Paung (ေပါင္)', 'ပန', 4, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(179, 10, 'Bilin (ဘီးလင္း)', 'ဘလန', 5, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(180, 10, 'Mudon (မုဒံု)', 'မဒန', 6, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(181, 10, 'Mawlamyine (ေမာ္လျမိဳင္)', 'မလမ', 7, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(182, 10, 'Ye (ေရး)', 'ရန', 8, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(183, 10, 'Thaton (သထံု)', 'သထန', 9, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(184, 10, 'Thanbyuzayat (သံျဖဴဇရပ္)', 'သဖဇ', 10, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(185, 11, 'Kyauktaw (ေက်ာက္ေတာ္)', 'ကတန', 1, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(186, 11, 'Kyaukpyu (ေက်ာက္ျဖဴ)', 'ကဖန', 2, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(187, 11, 'Gwa (ဂြ)', 'ဂန', 3, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(188, 11, 'Sittwe (စစ္ေတြ)', 'စတန', 4, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(189, 11, 'Toungup (ေတာင္ကုတ္)', 'တကန', 5, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(190, 11, 'Ponnagyun (ပုဏၰားကြ်န္း)', 'ပဏက', 6, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(191, 11, 'Pauktaw (ေပါက္ေတာ)', 'ပတန', 7, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(192, 11, 'Buthidaung (ဘူးသီးေတာင္)', 'ဘသတ', 8, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(193, 11, 'Maungdaw (ေမာင္းေတာ)', 'မတန', 9, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(194, 11, 'Minbya (မင္းျပား)', 'မပန', 10, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(195, 11, 'Myebon (ေျမပံု)', 'မပန', 11, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(196, 11, 'Munaung (မာန္ေအာင္)', 'မအန', 12, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(197, 11, 'Mrauk-U (ေျမာက္ဦး)', 'မဥန', 13, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(198, 11, 'Ramree (ရမ္းၿဗဲ)', 'ရဗန', 14, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(199, 11, 'Rathedaung (ရေသ့ေတာင္)', 'ရသတ', 15, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(200, 11, 'Thandwe (သံတြဲ)', 'သတန', 16, 'N', 1, 1, '2017-12-11 03:10:00', '2017-12-11 03:10:00'),
(201, 11, 'Ann (အမ္း)', 'အန', 17, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(202, 12, 'Cocokyun (ကိုကိုကြ်န္း)', 'ကကက', 1, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(203, 12, 'Kungyangon (ကြမ္းျခံကုန္း)', 'ကခက', 2, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(204, 12, 'Kyauktada (ေက်ာက္တံတား)', 'ကတတ', 3, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(205, 12, 'Kyauktan (ေက်ာက္တန္း)', 'ကတန', 4, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(206, 12, 'Kyeemyindaing (ၾကည့္ျမင္တိုင္)', 'ကမတ', 5, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(207, 12, 'Kawhmu (ေကာ့မွဴး)', 'ကမန', 6, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(208, 12, 'Kamaryut (ကမာရြတ္)', 'ကမရ', 7, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(209, 12, 'Kayan (ခရမ္း)', 'ခရန', 8, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(210, 12, 'Sanchaung (စမ္းေခ်ာင္း)', 'စခန', 9, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(211, 12, 'Seikgyikanaungto (ဆိပ္ႀကီးခေနာင္တို)', 'ဆကခ', 10, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(212, 12, 'Seikkan (ဆိပ္ကမ္း)', 'ဆကန', 11, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(213, 12, 'Dagon Myothit - Seikkan (ဒဂံဳုၿမိဳ႕သစ္ - ဆိပ္ကမ္း)', 'ဆဒဂ', 12, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(214, 12, 'Taikkyi (တိုက္ႀကီး)', 'တကန', 13, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(215, 12, 'Twantay (တြံေတး)', 'တတန', 14, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(216, 12, 'Tamwe (တာေမြ)', 'တမန', 15, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(217, 12, 'Htantabin (ထန္းတပင္)', 'ထတပ', 16, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(218, 12, 'Dagon Myothit - South (ဒဂံုၿမိဳ႕သစ္ - ေတာင္)', 'ဒဂတ', 17, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(219, 12, 'Dagon (ဒဂံု)', 'ဒဂန', 18, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(220, 12, 'Dagon Myothit - North (ဒဂံုၿမိဳ႕သစ္ - ေျမာက္)', 'ဒဂမ', 19, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(221, 12, 'Dagon Myothit - East (ဒဂံုၿမိဳ႕သစ္ - ေရွ႕)', 'ဒဂရ', 20, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(222, 12, 'Dawbon (ေဒါပံု)', 'ဒပန', 21, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(223, 12, 'Dala (ဒလ)', 'ဒလန', 22, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(224, 12, 'Pazundaung (ပုဇြန္ေတာင္)', 'ပဇတ', 23, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(225, 12, 'Pabedan (ပန္းဘဲတန္း)', 'ပဘတ', 24, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(226, 12, 'Bahan (ဗဟန္း)', 'ဗဟန', 25, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(227, 12, 'Botahtaung (ဗိုလ္တေထာင္)', 'ဗတထ', 26, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(228, 12, 'Mingalar Taung Nyunt (မဂၤလာေတာင္ညြန္႕)', 'မဂတ', 27, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(229, 12, 'Mingaladon (မဂၤလာဒံု)', 'မဂဒ', 28, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(230, 12, 'Hmawbi (ေမွာ္ဘီ)', 'မဘန', 29, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(231, 12, 'Mayangone (မရမ္းကုန္း)', 'မရက', 30, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(232, 12, 'Yankin (ရန္ကင္း)', 'ရကန', 31, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(233, 12, 'Shwepyithar (ေရႊျပည္သာ)', 'ရပသ', 32, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(234, 12, 'Hlegu (လွည္းကူး)', 'လကန', 33, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(235, 12, 'Lanmadaw (လမ္းမေတာ္)', 'လမတ', 34, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(236, 12, 'Hlaing (လႈိင္)', 'လမန', 35, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(237, 12, 'Latha (လသာ)', 'လသန', 36, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(238, 12, 'Hlaingtharya (လႈိင္သာယာ)', 'လသယ', 37, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(239, 12, 'Thaketa (သာေကတ)', 'သကတ', 38, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(240, 12, 'Thongwa (သံုးခြ)', 'သခန', 39, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(241, 12, 'Thingangkuun (သဃၤန္းကြ်န္း)', 'သဃက', 40, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(242, 12, 'Thanlyin (သံလွ်င္)', 'သလန', 41, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(243, 12, 'Insein (အင္းစိန္)', 'အစန', 42, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(244, 12, 'Ahlone (အလံု)', 'အလန', 43, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(245, 12, 'South Okkalapa (ေတာင္ဥကၠလာပ)', 'ဥကတ', 44, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(246, 12, 'North Okkalapa (ေျမာက္ဥကၠလာပ)', 'ဥကမ', 45, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(247, 13, 'Konkyan (ကုန္းၾကမ္း)', 'ကကန', 1, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(248, 13, 'Kutkai (ကြတ္ခိုင္)', 'ကခန', 2, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(249, 13, 'Keng Tung (က်ိဳင္းတံု)', 'ကတန', 3, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(250, 13, 'Kyuakme (ေက်ာက္မဲ)', 'ကမန', 4, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(251, 13, 'Kalaw (ကေလာ)', 'ကလန', 5, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(252, 13, 'Kunlong (ကြမ္းလံု)', 'ကလန', 6, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(253, 13, 'Kyethi (ေက်းသီး)', 'ကသန', 7, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(254, 13, 'Kunhing (ဂုခင္ဂွိင္)', 'ဂခဂ', 8, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(255, 13, 'Hsihseng (ဆီဆိုင္)', 'ဆဆန', 9, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(256, 13, 'Nyaungshwe (ေညာင္ေရႊ)', 'ညရန', 10, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(257, 13, 'Taunggyi (ေတာင္ႀကီး)', 'တကန', 11, 'N', 1, 1, '2017-12-11 03:10:01', '2017-12-11 03:10:01'),
(258, 13, 'Tachileik (တာခ်ီလိတ္)', 'တခလ', 12, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(259, 13, 'Tangyan (တန္႕ယန္း)', 'တယန', 13, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(260, 13, 'Nanhkan (နမ့္ခမ္း)', 'နခန', 14, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(261, 13, 'Nawnghkio (ေနာင္ခ်ိဳ)', 'နခန', 15, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(262, 13, 'Nansang (နမ့္စန္)', 'နစန', 16, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(263, 13, 'Namhsan (နမ့္ဆန္)', 'နဆန', 17, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(264, 13, 'Nampan (နမ့္ပန္)', 'နပန', 18, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(265, 13, 'Namtu (နမ္မတူ)', 'နမတ', 19, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(266, 13, 'Pindaya (ပင္းတယ)', 'ပတယ', 20, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(267, 13, 'Pinlaung (ပင္ေလာင္း)', 'ပလန', 21, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(268, 13, 'Pangwaun (ပန္၀ိုင္)', 'ပ၀န', 22, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(269, 13, 'Pekon (ဖယ္ခံု)', 'ဖခန', 23, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(270, 13, 'Mong Kaung (မိုင္းကိုင္)', 'မကန', 24, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(271, 13, 'Mongkhet (မိုင္းခတ္)', 'မခန', 25, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(272, 13, 'Mongnai (မိုင္းခဏ္း)', 'မခန', 26, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(273, 13, 'Muse (မူဆယ္)', 'မဆန', 27, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(274, 13, 'Mong Hsat (မိုင္းဆတ္)', 'မဆန', 28, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(275, 13, 'Manton (မန္တံု)', 'မတန', 29, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(276, 13, 'Mongton (မိုင္းတံု)', 'မတန', 30, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(277, 13, 'Mongpan (မိုင္းပဏ္း)', 'မပန', 31, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(278, 13, 'Mongping (မိုင္းျပင္း)', 'မပန', 32, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(279, 13, 'Monghpyak (မိုင္းျဖတ္)', 'မဖန', 33, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(280, 13, 'Mabein (မဘိမ္း)', 'မဘန', 34, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(281, 13, 'Matman (မက္မန္း)', 'မမန', 35, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(282, 13, 'Mongmao (မိုင္းေမာ)', 'မမန', 36, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(283, 13, 'Mongmit (မိုးမိတ္)', 'မမတ', 37, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(284, 13, 'Mawkmai (ေမာက္မယ္)', 'မမန', 38, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(285, 13, 'Mongyawng (မိုင္းေယာင္း)', 'မယန', 39, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(286, 13, 'Mongyang (မိုင္းရမ္း)', 'မရန', 40, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(287, 13, 'Mongyai (မိုင္းရယ္)', 'မရန', 41, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(288, 13, 'Mong Hsu (မိုင္းရႈး)', 'မရန', 42, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(289, 13, 'Mongla (မိုင္းလား)', 'မလန', 43, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(290, 13, 'Ywangan (ရြာငံ)', 'ရငန', 44, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(291, 13, 'Lawksawk (ရပ္ေစာက္)', 'ရစန', 45, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(292, 13, 'Laukkaing (ေလာက္ကိုင္)', 'လကန', 46, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(293, 13, 'Laihka (လဲခ်ား)', 'လခန', 47, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(294, 13, 'Langkho (လင္းေခး)', 'လခန', 48, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(295, 13, 'Lashio (လာရိႈး)', 'လရန', 49, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(296, 13, 'Loilen (လိြဳင္လင္)', 'လလန', 50, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(297, 13, 'Hseni (သိႏၷီ)', 'သနန', 51, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(298, 13, 'Hsipaw (သီေပါ)', 'သပန', 52, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(299, 13, 'Hopang (ဟိုပံုး)', 'ဟပန', 53, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(300, 13, 'Hopong (ဟိုပံုး)', 'ဟပန', 54, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(301, 13, 'Pangsang (ပာင္သာင္း)', 'ဟသန', 55, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(302, 13, 'Shwe Nyaung (ေရႊေညာင္)', 'ရညန', 56, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(303, 14, 'Kangyidaunt (ကန္ႀကီးေထာင့္)', 'ကကထ', 1, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(304, 14, 'Kyaunggon (ေက်ာင္းကုန္း)', 'ကကန', 2, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(305, 14, 'Kyangin (ႀကံခင္း)', 'ကခန', 3, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(306, 14, 'Kyonpyaw (က်ံဳေပ်ာ္)', 'ကပန', 4, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(307, 14, 'Kyaiklat (က်ိဳက္လတ္)', 'ကလန', 5, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(308, 14, 'Ngapudaw (ငပုေတာ)', 'ငပတ', 6, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(309, 14, 'Zalun (ဇလြန္)', 'ဇလန', 7, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(310, 14, 'Nyaungdon (ေညာင္တုန္း)', 'ညတန', 8, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(311, 14, 'Dedaye (ေဒးဒရဲ)', 'ဒဒရ', 9, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(312, 14, 'Danubyu (ဓႏုျဖဴ)', 'ဓနဖ', 10, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(313, 14, 'Pantanaw (ပန္းတေနာ္)', 'ပတန', 11, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(314, 14, 'Pathein (ပုသိမ္)', 'ပသန', 12, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(315, 14, 'Pathein (ပုုသိမ္အေရွ႕)', 'ပသရ', 13, 'N', 1, 1, '2017-12-11 03:10:02', '2017-12-11 03:10:02'),
(316, 14, 'Pyapon (ဖ်ာပံု)', 'ဖပန', 14, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(317, 14, 'Bogale (ဘိုကေလး)', 'ဘကလ', 15, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(318, 14, 'Mawlamyinegyun (ေမာ္ကြ်န္း)', 'မကန', 16, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(319, 14, 'Myaungmya (ေျမာင္းျမ)', 'မမန', 17, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(320, 14, 'Myanaung (ျမန္ေအာင္)', 'မအန', 18, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(321, 14, 'Maubin (မအူပင္)', 'မအပ', 19, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(322, 14, 'Yegyi (ေရၾကည္)', 'ရကန', 20, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(323, 14, 'Labutta (လပြတၱာ)', 'လပတ', 21, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(324, 14, 'Lemyethna (ေလးမ်က္ႏွာ)', 'လမန', 22, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(325, 14, 'Wakema (၀ါးခယ္မ)', '၀ခမ', 23, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(326, 14, 'Thabaung (သာေပါင္း)', 'သပန', 24, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(327, 14, 'Hinthada (ဟသၤာတ)', 'ဟသတ', 25, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(328, 14, 'Ingapu (အဂၤပူ)', 'အဂပ', 26, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(329, 14, 'Einme (အိမ္မဲ)', 'အမန', 27, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(330, 15, 'Zabuthiri  (ဇမၺဴသီရိ)', 'ဇဗန', 1, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(331, 15, 'Zeyarthiri ( ေဇယ်ာသီရိ)', 'ဇယသ', 2, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(332, 15, 'TatKone (တပ္ကုုန္း)', 'တကန', 3, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(333, 15, 'Dekkhinathiri (ဒကၡိဏသီရိ)', 'ဒကဏ', 4, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(334, 15, 'Pobbathiri (ပုဗၺသီရိ)', 'ပသန', 5, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(335, 15, 'Pyinmana (ပ်ဥ္းမနား)', 'ပမန', 6, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(336, 15, 'Lalway (လယ္ေ၀း)', 'လ၀မ', 7, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03'),
(337, 15, 'Ottarathiri (ဥတၱရသီရိ)', 'ဥသန', 8, 'N', 1, 1, '2017-12-11 03:10:03', '2017-12-11 03:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `outgoings`
--

CREATE TABLE IF NOT EXISTS `outgoings` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `lotin_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `passenger_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `carrier_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_line` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vessel_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dept_date` date NOT NULL,
  `dept_time` time NOT NULL,
  `arrival_date` date NOT NULL,
  `arrival_time` time NOT NULL,
  `weight` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_weight` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `box` int(11) NOT NULL DEFAULT '0',
  `from_country` int(11) NOT NULL DEFAULT '0',
  `from_city` int(11) NOT NULL DEFAULT '0',
  `to_country` int(11) NOT NULL DEFAULT '0',
  `to_city` int(11) NOT NULL DEFAULT '0',
  `packing_list` int(11) NOT NULL DEFAULT '0',
  `packing_id_list` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packings`
--

CREATE TABLE IF NOT EXISTS `packings` (
  `id` int(10) unsigned NOT NULL,
  `outgoing_id` int(11) NOT NULL,
  `packing_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'Display Role Listing', 'See only Listing Of Role', '2017-12-11 03:08:34', '2017-12-11 03:08:34'),
(2, 'role-create', 'Create Role', 'Create New Role', '2017-12-11 03:08:34', '2017-12-11 03:08:34'),
(3, 'role-edit', 'Edit Role', 'Edit Role', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(4, 'role-delete', 'Delete Role', 'Delete Role', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(5, 'permission-list', 'Display Permission Listing', 'See only Listing Of Permission', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(6, 'permission-create', 'Create Permission', 'Create New Permission', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(7, 'permission-edit', 'Edit Permission', 'Edit Permission', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(8, 'permission-delete', 'Delete Permission', 'Delete Permission', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(9, 'company-list', 'Display Company Listing', 'See only Listing Of Company', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(10, 'company-create', 'Create Company', 'Create New Company', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(11, 'company-edit', 'Edit Company', 'Edit Company', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(12, 'company-delete', 'Delete Company', 'Delete Company', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(13, 'user-list', 'Display User Listing', 'See only Listing Of User', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(14, 'user-create', 'Create User', 'Create New User', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(15, 'user-edit', 'Edit User', 'Edit User', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(16, 'user-delete', 'Delete User', 'Delete User', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(17, 'nric-code-list', 'Display NRIC Code Listing', 'See only Listing Of NRIC Code', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(18, 'nric-code-create', 'Create NRIC Code', 'Create New NRIC Code', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(19, 'nric-code-edit', 'Edit NRIC Code', 'Edit NRIC Code', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(20, 'nric-code-delete', 'Delete NRIC Code', 'Delete NRIC Code', '2017-12-11 03:08:35', '2017-12-11 03:08:35'),
(21, 'nric-township-list', 'Display NRIC Township Listing', 'See only Listing Of NRIC Township', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(22, 'nric-township-create', 'Create NRIC Township', 'Create New NRIC Township', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(23, 'nric-township-edit', 'Edit NRIC Township', 'Edit NRIC Township', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(24, 'nric-township-delete', 'Delete NRIC Township', 'Delete NRIC Township', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(25, 'country-list', 'Display Country Listing', 'See only Listing Of Country', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(26, 'country-create', 'Create Country', 'Create New Country', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(27, 'country-edit', 'Edit Country', 'Edit Country', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(28, 'country-delete', 'Delete Country', 'Delete Country', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(29, 'state-list', 'Display State Listing', 'See only Listing Of State', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(30, 'state-create', 'Create State', 'Create New State', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(31, 'state-edit', 'Edit State', 'Edit State', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(32, 'state-delete', 'Delete State', 'Delete State', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(33, 'township-list', 'Display Township Listing', 'See only Listing Of Township', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(34, 'township-create', 'Create Township', 'Create New Township', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(35, 'township-edit', 'Edit Township', 'Edit Township', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(36, 'township-delete', 'Delete Township', 'Delete Township', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(37, 'category-list', 'Display Category Listing', 'See only Listing Of Category', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(38, 'category-create', 'Create Category', 'Create New Category', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(39, 'category-edit', 'Edit Category', 'Edit Category', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(40, 'category-delete', 'Delete Category', 'Delete Category', '2017-12-11 03:08:36', '2017-12-11 03:08:36'),
(41, 'currency-list', 'Display Currency Listing', 'See only Listing Of Currency', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(42, 'currency-create', 'Create Currency', 'Create New Currency', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(43, 'currency-edit', 'Edit Currency', 'Edit Currency', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(44, 'currency-delete', 'Delete Currency', 'Delete Currency', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(45, 'price-list', 'Display Price Listing', 'See only Listing Of Price', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(46, 'price-create', 'Create Price', 'Create New Price', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(47, 'price-edit', 'Edit Price', 'Edit Price', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(48, 'price-delete', 'Delete Price', 'Delete Price', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(49, 'membership-list', 'Display Membership Listing', 'See only Listing Of Member Offer', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(50, 'membership-create', 'Create Membership', 'Create Member Offer', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(51, 'membership-edit', 'Edit Membership', 'Edit Member Offer', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(52, 'membership-delete', 'Delete Membership', 'Delete Member Offer', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(53, 'member-list', 'Display Member Listing', 'See only Listing Of Member', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(54, 'member-create', 'Create Member', 'Create New Member', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(55, 'member-edit', 'Edit Member', 'Edit Member', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(56, 'member-delete', 'Delete Member', 'Delete Member', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(57, 'lotin-list', 'Display Lot-in Listing', 'See only Listing Of Lot-in', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(58, 'lotin-create', 'Create Lot-in', 'Create New Lot-in', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(59, 'lotin-edit', 'Edit Lot-in', 'Edit Lot-in', '2017-12-11 03:08:37', '2017-12-11 03:08:37'),
(60, 'lotin-delete', 'Delete Lot-in', 'Delete Lot-in', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(61, 'outgoing-list', 'Display Outgoing Listing', 'See only Listing Of Outgoing', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(62, 'outgoing-create', 'Create Outgoing', 'Create New Outgoing', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(63, 'outgoing-edit', 'Edit Outgoing', 'Edit Outgoing', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(64, 'outgoing-delete', 'Delete Outgoing', 'Delete Outgoing', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(65, 'tracking-list', 'Display Tracking Listing', 'See only Listing Of Tracking', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(66, 'tracking-create', 'Create Tracking', 'Create New Tracking', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(67, 'tracking-edit', 'Edit Tracking', 'Edit Tracking', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(68, 'tracking-delete', 'Delete Tracking', 'Delete Tracking', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(69, 'tracking-show', 'Show Tracking Detail', 'Show Tracking Detail', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(70, 'collection-list', 'Display Collection Listing', 'See only Listing Of Collection', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(71, 'collection-create', 'Create Collection', 'Create New Collection', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(72, 'collection-edit', 'Edit Collection', 'Edit Collection', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(73, 'collection-delete', 'Delete Collection', 'Delete Collection', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(74, 'lotbalance-list', 'Display Lot Balance Listing', 'See only Listing Of Lot Balance', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(75, 'lotbalance-create', 'Create Lot Balance', 'Create New Lot Balance', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(76, 'lotbalance-edit', 'Edit Lot Balance', 'Edit Lot Balance', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(77, 'lotbalance-delete', 'Delete Lot Balance', 'Delete Lot Balance', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(78, 'message-list', 'Display Message Listing', 'See only Listing Of Message', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(79, 'message-create', 'Create Message', 'Create New Message', '2017-12-11 03:08:38', '2017-12-11 03:08:38'),
(80, 'message-edit', 'Edit Message', 'Edit Message', '2017-12-11 03:08:39', '2017-12-11 03:08:39'),
(81, 'message-delete', 'Delete Message', 'Delete Message', '2017-12-11 03:08:39', '2017-12-11 03:08:39'),
(82, 'report-list', 'Display Report Listing', 'See only Listing Of Report', '2017-12-11 03:08:39', '2017-12-11 03:08:39'),
(83, 'report-create', 'Create Report', 'Create New Report', '2017-12-11 03:08:39', '2017-12-11 03:08:39'),
(84, 'report-edit', 'Edit Report', 'Edit Report', '2017-12-11 03:08:39', '2017-12-11 03:08:39'),
(85, 'report-delete', 'Delete Report', 'Delete Report', '2017-12-11 03:08:39', '2017-12-11 03:08:39'),
(86, 'incoming-list', 'Display Incoming Listing', 'See only Listing Of Incoming', '2017-12-11 03:08:39', '2017-12-11 03:08:39'),
(87, 'incoming-create', 'Create Incoming', 'Create New Incoming', '2017-12-11 03:08:39', '2017-12-11 03:08:39'),
(88, 'incoming-edit', 'Edit Incoming', 'Edit Incoming', '2017-12-11 03:08:39', '2017-12-11 03:08:39'),
(89, 'incoming-delete', 'Delete Incoming', 'Delete Incoming', '2017-12-11 03:08:39', '2017-12-11 03:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`, `company_id`) VALUES
(1, 1, 0),
(1, 2, 0),
(2, 1, 0),
(2, 2, 0),
(3, 1, 0),
(3, 2, 0),
(4, 1, 0),
(4, 2, 0),
(5, 1, 0),
(5, 2, 0),
(6, 1, 0),
(7, 1, 0),
(8, 1, 0),
(9, 1, 0),
(9, 2, 0),
(10, 1, 0),
(11, 1, 0),
(11, 2, 0),
(12, 1, 0),
(13, 1, 0),
(13, 2, 0),
(14, 1, 0),
(14, 2, 0),
(15, 1, 0),
(15, 2, 0),
(16, 1, 0),
(16, 2, 0),
(17, 1, 0),
(17, 2, 0),
(18, 1, 0),
(19, 1, 0),
(20, 1, 0),
(21, 1, 0),
(21, 2, 0),
(22, 1, 0),
(23, 1, 0),
(24, 1, 0),
(25, 1, 0),
(25, 2, 0),
(26, 1, 0),
(26, 2, 0),
(27, 1, 0),
(27, 2, 0),
(28, 1, 0),
(28, 2, 0),
(29, 1, 0),
(29, 2, 0),
(30, 1, 0),
(30, 2, 0),
(31, 1, 0),
(31, 2, 0),
(32, 1, 0),
(32, 2, 0),
(33, 1, 0),
(33, 2, 0),
(34, 1, 0),
(34, 2, 0),
(35, 1, 0),
(35, 2, 0),
(36, 1, 0),
(36, 2, 0),
(37, 1, 0),
(37, 2, 0),
(38, 1, 0),
(39, 1, 0),
(40, 1, 0),
(41, 1, 0),
(41, 2, 0),
(42, 1, 0),
(42, 2, 0),
(43, 1, 0),
(43, 2, 0),
(44, 1, 0),
(44, 2, 0),
(45, 1, 0),
(45, 2, 0),
(46, 1, 0),
(46, 2, 0),
(47, 1, 0),
(47, 2, 0),
(48, 1, 0),
(48, 2, 0),
(49, 1, 0),
(49, 2, 0),
(50, 1, 0),
(50, 2, 0),
(51, 1, 0),
(51, 2, 0),
(52, 1, 0),
(52, 2, 0),
(53, 1, 0),
(53, 2, 0),
(54, 1, 0),
(54, 2, 0),
(55, 1, 0),
(55, 2, 0),
(56, 1, 0),
(56, 2, 0),
(57, 1, 0),
(57, 2, 0),
(58, 1, 0),
(58, 2, 0),
(59, 1, 0),
(59, 2, 0),
(60, 1, 0),
(60, 2, 0),
(61, 1, 0),
(61, 2, 0),
(62, 1, 0),
(62, 2, 0),
(63, 1, 0),
(63, 2, 0),
(64, 1, 0),
(64, 2, 0),
(65, 1, 0),
(65, 2, 0),
(66, 1, 0),
(66, 2, 0),
(67, 1, 0),
(67, 2, 0),
(68, 1, 0),
(68, 2, 0),
(69, 1, 0),
(69, 2, 0),
(70, 1, 0),
(70, 2, 0),
(71, 1, 0),
(71, 2, 0),
(72, 1, 0),
(72, 2, 0),
(73, 1, 0),
(73, 2, 0),
(74, 1, 0),
(74, 2, 0),
(75, 1, 0),
(75, 2, 0),
(76, 1, 0),
(76, 2, 0),
(77, 1, 0),
(77, 2, 0),
(78, 1, 0),
(78, 2, 0),
(79, 1, 0),
(79, 2, 0),
(80, 1, 0),
(80, 2, 0),
(81, 1, 0),
(81, 2, 0),
(82, 1, 0),
(82, 2, 0),
(83, 1, 0),
(83, 2, 0),
(84, 1, 0),
(84, 2, 0),
(85, 1, 0),
(85, 2, 0),
(86, 1, 0),
(86, 2, 0),
(87, 1, 0),
(87, 2, 0),
(88, 1, 0),
(88, 2, 0),
(89, 1, 0),
(89, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE IF NOT EXISTS `prices` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `title_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_country` int(11) NOT NULL,
  `from_state` int(11) NOT NULL,
  `to_country` int(11) NOT NULL,
  `to_state` int(11) NOT NULL,
  `unit_price` double(12,2) NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `company_id`, `category_id`, `currency_id`, `title_id`, `title_name`, `from_country`, `from_state`, `to_country`, `to_state`, `unit_price`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, 1, 'Normal Weight', 2, 3, 2, 2, 1000.00, 'N', 3, 0, '2017-12-12 04:46:42', '2017-12-12 04:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `price_titles`
--

CREATE TABLE IF NOT EXISTS `price_titles` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `title_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `price_titles`
--

INSERT INTO `price_titles` (`id`, `company_id`, `title_name`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Normal Weight', 'N', 3, 0, '2017-12-12 04:46:42', '2017-12-12 04:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `receivers`
--

CREATE TABLE IF NOT EXISTS `receivers` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nric_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nric_code_id` int(11) DEFAULT NULL,
  `nric_township_id` int(11) DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receivers`
--

INSERT INTO `receivers` (`id`, `company_id`, `sender_id`, `name`, `nric_no`, `nric_code_id`, `nric_township_id`, `contact_no`, `member_no`, `state_id`, `address`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Thu Thu', '', 0, 0, '+95 9780939699', 'ZMT201712000001', NULL, '1', 'N', 3, 3, '2017-12-13 06:14:43', '2017-12-13 09:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `company_id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'administrator', 'Project Administrator', 'Administrator allow to manage whole project', '2017-12-11 03:08:26', '2017-12-11 03:08:26'),
(2, 0, 'owner', 'CEO', 'Owner allow to manage his/her own resources', '2017-12-11 03:08:26', '2017-12-11 04:13:16'),
(3, 1, 'manager', 'Manager', 'Manager can access only permission that set from Owner', '2017-12-11 03:08:26', '2017-12-11 03:08:26'),
(4, 1, 'staff', 'Staff', 'Staff can access only permission that set from Owner', '2017-12-11 03:08:26', '2017-12-11 03:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `senders`
--

CREATE TABLE IF NOT EXISTS `senders` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nric_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nric_code_id` int(11) NOT NULL,
  `nric_township_id` int(11) NOT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(11) NOT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `senders`
--

INSERT INTO `senders` (`id`, `company_id`, `name`, `nric_no`, `nric_code_id`, `nric_township_id`, `contact_no`, `member_no`, `state_id`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'WEEP', '', 0, 0, '+95 9402786013', 'ZMT201712000001', 0, 'N', 3, 3, '2017-12-13 06:14:43', '2017-12-13 09:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(10) unsigned NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_townships` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `state_name`, `total_townships`, `description`, `state_code`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Singapore', 1, 'Singapore (စကၤာပူ)', 'SG', 'N', 1, 0, '2017-12-11 03:15:42', '2017-12-11 03:17:38'),
(2, 2, 'Yangon', 1, 'Yangon (ရန္ကုန္ျမိဳ ႔)', 'YGN', 'N', 1, 0, '2017-12-11 03:16:20', '2017-12-11 03:31:53'),
(3, 2, 'Mandalay', 0, 'Mandalay (မႏၱေလး)', 'MDY', 'N', 1, 0, '2017-12-12 04:10:57', '2017-12-12 04:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `townships`
--

CREATE TABLE IF NOT EXISTS `townships` (
  `id` int(10) unsigned NOT NULL,
  `state_id` int(11) NOT NULL,
  `township_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `townships`
--

INSERT INTO `townships` (`id`, `state_id`, `township_name`, `description`, `code`, `deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Raffle Place', 'Raffle Place', 'RFP', 'N', 1, 1, '2017-12-11 03:19:52', '2017-12-11 03:31:25'),
(2, 2, 'Ahlone Township', 'Ahlone Township (အလံုျမိဳ ႔နယ္)', 'AHL', 'N', 1, 0, '2017-12-11 03:31:52', '2017-12-11 03:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `nric_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nric_code_id` int(11) NOT NULL,
  `nric_township_id` int(11) NOT NULL,
  `gender` enum('Female','Male') COLLATE utf8_unicode_ci NOT NULL,
  `marital_status` enum('Single','Married','Separated','Divorced','Widowed','Single Parent') COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `building_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `name`, `dob`, `nric_no`, `nric_code_id`, `nric_township_id`, `gender`, `marital_status`, `contact_no`, `position`, `nationality`, `email`, `username`, `password`, `unit_number`, `building_name`, `street`, `country_id`, `state_id`, `township_id`, `address`, `photo`, `deleted`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Thet Thet Aye', '1991-12-13', '9/၀တန(N)၁၄၀၀၀၇', 9, 0, 'Female', 'Single', '91975833', 'Web Developer', 0, 'thetthetaye2709@gmail.com', 'thetthetaye2709@gmail.com', '$2y$10$YaPT3yaAI9lshesQY7jRbOk3XDNkarzOsbFG32XArp7wngiVKKu7G', '#08-858', 'Blk 840', 'Sims Ave', 1, 1, 0, '#08-858, Blk 840, Sims Ave', '', 'N', 1, 1, NULL, '2017-12-11 03:08:20', '2017-12-11 03:59:27'),
(2, 1, 'Zaw Zaw Aung', '1983-12-26', '', 0, 0, 'Male', 'Married', '123456789', '', 0, 'msctpteltd@gmail.com', 'msctpteltd@gmail.com', '$2y$10$24.Nwq8o1xQttTgnz.iese4TOHGDXHpdWJihdWULbnECiU8CSRQBy', '', '', '', 1, 1, 1, '', NULL, 'N', 1, 0, NULL, '2017-12-11 04:01:32', '2017-12-11 04:01:32'),
(3, 2, 'Zay Yar Oo', '1987-07-14', '', 0, 0, 'Male', 'Married', '+95 930093314', 'CEO', 0, 'zayar.zayar03@gmail.com', 'zayar.zayar03@gmail.com', '$2y$10$2Epw3a1lfvjBPMR9jdXpJO9FNY313JBnAvJv/d028MITGiSgj/EUi', '', '', '', 2, 2, 2, '', NULL, 'N', 1, 0, NULL, '2017-12-11 04:05:40', '2017-12-11 04:05:40'),
(4, 3, 'U Ko Ko', '1989-01-31', '', 0, 0, 'Male', 'Single', '0987654321', 'CEO', 0, 'smdl@gmail.com', 'scm@gmail.com', '$2y$10$f24SH5GLz1WDKA0QTjs2ye5HIwV7E36YXhM0ETGVagm.3GuuVxaFy', '', '', '', 2, 2, 2, '', NULL, 'N', 1, 0, NULL, '2017-12-12 03:12:57', '2017-12-12 03:12:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `companies_email_unique` (`email`);

--
-- Indexes for table `companies_countries`
--
ALTER TABLE `companies_countries`
  ADD PRIMARY KEY (`companies_id`,`countries_id`), ADD KEY `companies_countries_countries_id_foreign` (`countries_id`);

--
-- Indexes for table `companies_states`
--
ALTER TABLE `companies_states`
  ADD PRIMARY KEY (`companies_id`,`states_id`), ADD KEY `companies_states_states_id_foreign` (`states_id`);

--
-- Indexes for table `companies_townships`
--
ALTER TABLE `companies_townships`
  ADD PRIMARY KEY (`companies_id`,`townships_id`), ADD KEY `companies_townships_townships_id_foreign` (`townships_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lotins`
--
ALTER TABLE `lotins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `members_contact_no_unique` (`contact_no`), ADD UNIQUE KEY `members_member_no_unique` (`member_no`), ADD UNIQUE KEY `members_email_unique` (`email`);

--
-- Indexes for table `member_offers`
--
ALTER TABLE `member_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nric_codes`
--
ALTER TABLE `nric_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nric_townships`
--
ALTER TABLE `nric_townships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outgoings`
--
ALTER TABLE `outgoings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packings`
--
ALTER TABLE `packings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`), ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_titles`
--
ALTER TABLE `price_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receivers`
--
ALTER TABLE `receivers`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `receivers_contact_no_unique` (`contact_no`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`), ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `senders`
--
ALTER TABLE `senders`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `senders_contact_no_unique` (`contact_no`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `townships`
--
ALTER TABLE `townships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lotins`
--
ALTER TABLE `lotins`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `member_offers`
--
ALTER TABLE `member_offers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nric_codes`
--
ALTER TABLE `nric_codes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `nric_townships`
--
ALTER TABLE `nric_townships`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=338;
--
-- AUTO_INCREMENT for table `outgoings`
--
ALTER TABLE `outgoings`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `packings`
--
ALTER TABLE `packings`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `price_titles`
--
ALTER TABLE `price_titles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `receivers`
--
ALTER TABLE `receivers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `senders`
--
ALTER TABLE `senders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `townships`
--
ALTER TABLE `townships`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `companies_countries`
--
ALTER TABLE `companies_countries`
ADD CONSTRAINT `companies_countries_companies_id_foreign` FOREIGN KEY (`companies_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `companies_countries_countries_id_foreign` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `companies_states`
--
ALTER TABLE `companies_states`
ADD CONSTRAINT `companies_states_companies_id_foreign` FOREIGN KEY (`companies_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `companies_states_states_id_foreign` FOREIGN KEY (`states_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `companies_townships`
--
ALTER TABLE `companies_townships`
ADD CONSTRAINT `companies_townships_companies_id_foreign` FOREIGN KEY (`companies_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `companies_townships_townships_id_foreign` FOREIGN KEY (`townships_id`) REFERENCES `townships` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
