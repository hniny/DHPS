-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 05, 2021 at 08:06 AM
-- Server version: 10.2.36-MariaDB-1:10.2.36+maria~bionic
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhps`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Yangon', '2020-09-06 21:35:50', '2020-09-06 21:35:50', NULL),
(2, 'Mandalay/Monywa', '2020-09-06 21:36:06', '2020-09-06 21:36:06', NULL),
(3, 'Ayeyarwaddy', '2020-09-06 21:36:31', '2020-09-06 21:36:31', NULL),
(4, 'Bago (E)', '2020-09-06 21:36:44', '2020-09-06 21:36:44', NULL),
(5, 'Bago (W)', '2020-09-06 21:36:54', '2020-09-06 21:36:54', NULL),
(6, 'Mon-Kayin', '2020-09-06 21:37:16', '2020-09-06 21:37:16', NULL),
(7, 'Shan', '2020-09-06 21:37:24', '2020-09-06 21:37:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `consigemts_has_extra_user`
--

CREATE TABLE `consigemts_has_extra_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consigment_id` bigint(20) UNSIGNED NOT NULL,
  `extra_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consigments`
--

CREATE TABLE `consigments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `signature_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_returns`
--

CREATE TABLE `credit_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_order_id` bigint(20) UNSIGNED NOT NULL,
  `return_reason_id` bigint(20) UNSIGNED NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `office_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `componay_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trading_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_registration_date` date NOT NULL,
  `company_registration_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `preferred_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` int(11) NOT NULL,
  `payment_term` int(11) NOT NULL DEFAULT 1,
  `applicant_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_ref_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_member_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `applicant_id_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_ref_id_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_type_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `outlet_type_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `office_number`, `mobile_number`, `componay_name`, `trading_name`, `company_registration_date`, `company_registration_no`, `office_address`, `delivery_address`, `preferred_bank`, `payment_method`, `payment_term`, `applicant_id`, `company_ref_id`, `team_member_id`, `deleted_at`, `created_at`, `updated_at`, `applicant_id_one`, `company_ref_id_one`, `customer_type_id`, `outlet_type_id`, `position`) VALUES
(1, 3, '09264118868', '09264118868', 'Lan Thit', 'Lan Thit', '2020-09-28', '09264118868', '1', '16,17,18 Lan Thit, Lan Gyee Bay', '2', 1, 3, '1605243242Lan THit.jpg', '1605243242Lan THit.jpg', 1, NULL, '2020-11-13 04:54:02', '2020-11-13 04:59:03', '1605243242Lan THit.jpg', '1605243242Lan THit.jpg', 2, 7, 'Sale'),
(2, 9, '0987654321', '0987654321', 'hmm', 'hmm', '2020-12-08', '12345', '11', 'test', 'AYA', 1, 1, '1608007196Abstract-Desktop-Wallpaper-Hd-1080p-for-Computer-Windows-10.jpg', '1608007196Abstract-Tree-background-HD-Wallpaper (2).jpg', NULL, '2020-12-28 06:38:42', '2020-12-15 04:39:56', '2020-12-28 06:38:42', '1608007196Abstract-Tree-background-HD-Wallpaper (2).jpg', '1608007196Abstract-Tree-background-HD-Wallpaper (2).jpg', 1, 2, 'test'),
(3, 21, '09799795072', '09799795072', 'Thadar', 'Thadar', '2021-01-14', '5678', '9', 'No(416), Zayar 10th Street, 10 ward, South Okkalapa', 'ဘဏ်ရွေးချယ်ပါ', 1, 2, '1610939024Thadar.jpg', '1610939024Thadar.jpg', 13, NULL, '2021-01-18 03:03:44', '2021-01-18 03:11:11', '1610939024Thadar.jpg', '1610939024Thadar.jpg', 2, 3, 'Owner'),
(4, 23, '095401754', '0979888003', 'Thukamon Pharmacy', 'Thukamon Pharmacy', '2020-11-10', '667788', '28', 'No(168 D),Layhti Street,Tatkyigone Quarter,Hmawbi', '2', 1, 2, '1610940675FB_IMG_1596091860883.jpg', '1610940675FB_IMG_1596091860883.jpg', NULL, '2021-01-18 03:32:02', '2021-01-18 03:31:15', '2021-01-18 03:32:02', '1610940675FB_IMG_1596091860883.jpg', '1610940675FB_IMG_1596091860883.jpg', 2, 3, 'Owner'),
(5, 24, '095401754', '0979888003', 'Thukamon Pharmacy', 'Thukamon Pharmacy', '2020-11-10', '667788', '28', 'No(168 D),Layhti Street,Tatkyigone Quarter,Hmawbi', '2', 1, 2, '1610940676FB_IMG_1596091860883.jpg', '1610940676FB_IMG_1596091860883.jpg', NULL, '2021-01-18 03:31:56', '2021-01-18 03:31:16', '2021-01-18 03:31:56', '1610940676FB_IMG_1596091860883.jpg', '1610940676FB_IMG_1596091860883.jpg', 2, 3, 'Owner'),
(6, 25, '095401754', '0979888003', 'Thukamon Pharmacy', 'Thukamon Pharmacy', '2020-11-10', '667788', '28', 'No(168 D),Layhti Street,Tatkyigone Quarter,Hmawbi', '2', 1, 2, '1610940676FB_IMG_1596091860883.jpg', '1610940676FB_IMG_1596091860883.jpg', NULL, '2021-01-18 03:31:59', '2021-01-18 03:31:16', '2021-01-18 03:31:59', '1610940676FB_IMG_1596091860883.jpg', '1610940676FB_IMG_1596091860883.jpg', 2, 3, 'Owner'),
(7, 26, '095401754', '0979888003', 'Thukamon Pharmacy', 'Thukamon Pharmacy', '2020-11-10', '667788', '28', 'No(168 D),Layhti Street,Tatkyigone Quarter,Hmawbi', '2', 1, 2, '1610940677FB_IMG_1596091860883.jpg', '1610940677FB_IMG_1596091860883.jpg', NULL, '2021-01-18 03:31:52', '2021-01-18 03:31:17', '2021-01-18 03:31:52', '1610940677FB_IMG_1596091860883.jpg', '1610940677FB_IMG_1596091860883.jpg', 2, 3, 'Owner'),
(8, 27, '095401754', '0979888003', 'Thukamon Pharmacy', 'Thukamon Pharmacy', '2020-11-10', '667788', '28', 'No(168 D),Layhti Street,Tatkyigone Quarter,Hmawbi', 'ဘဏ်ရွေးချယ်ပါ', 1, 2, '1611198912Thukhamon.jpg', '1611198912Thukhamon.jpg', 1, NULL, '2021-01-18 03:31:18', '2021-01-21 03:15:12', '1611198912Thukhamon.jpg', '1611198912Thukhamon.jpg', 2, 3, 'Owner'),
(9, 28, '09400500640', '09400500640', 'Dagon Store', 'Dagon Store', '2020-09-28', '၅/ဘတလ(ႏိုင္)၁၁၃၂၆၇', '14', 'No. 702.Bayintnaung street. 30ward. Nouth Dagon', '2', 1, 2, '1610943765Screenshot_20210118_101232.png', '1610943765Screenshot_20210118_101232.png', 8, NULL, '2021-01-18 04:22:46', '2021-01-18 04:23:14', '1610943765Screenshot_20210118_101232.png', '1610943766Screenshot_20210118_101232.png', 2, 2, 'Owner'),
(10, 29, '01577277', '01577277', 'Kyoe Kyar Store', 'Kyoe Kyar Store', '2020-11-11', '၁၂/ရကန(ႏိုင္)၀၅၀၆၀', '12', 'Moe Kaung Bus Stop, Yankin Township, Yangon', 'ဘဏ်ရွေးချယ်ပါ', 1, 2, '1610947221Screenshot_20210118_114314.png', '1610947221Screenshot_20210118_114314.png', 9, NULL, '2021-01-18 05:20:22', '2021-01-18 05:23:18', '1610947221Screenshot_20210118_114314.png', '1610947222Screenshot_20210118_114314.png', 2, 2, 'Owner'),
(11, 30, '09975269498', '09975269498', 'Pyit Tine Htaung (1)Pharmacy', 'Pyit Time Htaung(1) Pharmacy', '2020-10-12', '9/Pa Oo La(N)003088', '30', 'No. 3.Kyaik Kyout Pagada Road. Thanlyin', '2', 1, 2, '1610947877Screenshot_20210118_115129.png', '1610947877Screenshot_20210118_115129.png', NULL, NULL, '2021-01-18 05:31:18', '2021-01-18 05:31:18', '1610947878Screenshot_20210118_115129.png', '1610947878Screenshot_20210118_115129.png', 2, 3, 'Owner'),
(12, 31, '09793619341', '09793619341', 'Pyae Sone Taw win', 'Pyae Sone Taw win', '2020-10-19', 'Dr. Tin Zar Naing', '10', 'No. 65/B. Lay Daut Kan Street. Zawana Bus Shop. Thingankyun', '2', 1, 2, '1610948371Screenshot_20210118_120401.png', '1610948371Screenshot_20210118_120401.png', NULL, NULL, '2021-01-18 05:39:31', '2021-01-18 05:39:31', '1610948371Screenshot_20210118_120401.png', '1610948371Screenshot_20210118_120401.png', 2, 3, 'Owner'),
(13, 32, '095146385', '095146385', 'Kyal Ni Store', 'Kyal Ni Store', '2020-10-21', '14/A ma ta(N)046526', '8', 'No. 14.5.336/Pukan street. Shwepoutkan township', '2', 1, 2, '1610949132Screenshot_20210118_120956.png', '1610949132Screenshot_20210118_120956.png', NULL, NULL, '2021-01-18 05:52:12', '2021-01-18 05:52:12', '1610949132Screenshot_20210118_120956.png', '1610949132Screenshot_20210118_120956.png', 2, 8, 'Owner'),
(14, 33, '09799526242', '09799526242', 'Hello Baby store', 'Hello Baby Store', '2020-10-21', '12/U Ka Ma (N)012229', '8', 'No. 572/14ward. Pukan street. Shwepoutkan township', '2', 1, 2, '1610949557Screenshot_20210118_122253.png', '1610949557Screenshot_20210118_122253.png', NULL, NULL, '2021-01-18 05:59:18', '2021-01-18 05:59:18', '1610949558Screenshot_20210118_122253.png', '1610949558Screenshot_20210118_122253.png', 2, 8, 'Owner'),
(15, 34, '0975445362', '09975445362', 'Wyut yee Pharmacy', 'Wyut yee pharmacy', '2020-10-22', '12/Ba Ha Na(N)085977', '8', 'No. 15/B. Thitsarpanstreet. ႒ward. North Okkalapa', '2', 1, 2, '1610950134Screenshot_20210118_122949.png', '1610950134Screenshot_20210118_122949.png', NULL, NULL, '2021-01-18 06:08:54', '2021-01-18 06:08:54', '1610950134Screenshot_20210118_122949.png', '1610950134Screenshot_20210118_122949.png', 2, 3, 'Owner'),
(16, 35, '09455049485', '09455049485', 'Pyae Shan pharmacy', 'Pyae Shan pharmacy', '2020-10-21', '12/LaTa Ya(N)048523', '8', 'No. 1105.Hantarwady street. 6ward. Shwepoutkan township', '2', 1, 2, '1610958987Screenshot_20210118_145747.png', '1610958987Screenshot_20210118_145747.png', NULL, NULL, '2021-01-18 08:36:27', '2021-01-18 08:36:27', '1610958987Screenshot_20210118_145747.png', '1610958987Screenshot_20210118_145747.png', 2, 3, 'Owner'),
(17, 36, '09250877238', '09250877238', 'Shwe Hninsi', 'Shwe Hninsi pharmacy', '2020-10-23', '12/Dakama(N)003198', '14', 'No. 1418.49 ward. Bayintnaung street North Dagon', '2', 1, 2, '1610959458Screenshot_20210118_150711.png', '1610959458Screenshot_20210118_150711.png', NULL, NULL, '2021-01-18 08:44:18', '2021-01-18 08:44:18', '1610959458Screenshot_20210118_150711.png', '1610959458Screenshot_20210118_150711.png', 2, 3, 'Owner'),
(18, 37, '09421162293', '09421162293', 'Tamadi Pharmacy', 'Tamadi Pharmacy', '2020-10-23', '5/Ya Ma Ma(N)047212', '14', 'No. 169/B. Banula street. 30ward. North Dagon', '2', 1, 2, '1610960089Screenshot_20210118_151630.png', '1610960089Screenshot_20210118_151630.png', NULL, NULL, '2021-01-18 08:54:50', '2021-01-18 08:54:50', '1610960090Screenshot_20210118_151630.png', '1610960090Screenshot_20210118_151630.png', 2, 3, 'Owner'),
(19, 38, '09420075307', '0420075307', 'Shwe Myitta Pharmacy', 'Shwe Myitra Pharmacy', '2020-10-23', '12/MaYaTa(N)139124', '14', 'No. 55.Banula street. 45 ward. North Dagon', '2', 1, 2, '1610960401Screenshot_20210118_151928.png', '1610960401Screenshot_20210118_151928.png', NULL, NULL, '2021-01-18 09:00:02', '2021-01-18 09:00:02', '1610960401Screenshot_20210118_151928.png', '1610960402Screenshot_20210118_151928.png', 2, 3, 'Owner'),
(20, 39, '019552925', '019552925', 'Myanmar Big Shop', 'Myanmar Big Shop', '2020-10-26', '12/Ka Ma Ya(N)051658', '13', 'No. 85/Ka. Yetashae street. Bahan', '2', 1, 2, '1611024005Screenshot_20210119_090205.png', '1611024005Screenshot_20210119_090205.png', NULL, NULL, '2021-01-19 02:40:05', '2021-01-19 02:40:05', '1611024005Screenshot_20210119_090205.png', '1611024005Screenshot_20210119_090205.png', 2, 3, 'Manager'),
(21, 40, '09784137650', '09784137650', 'Myanmar Big Shop(Shwe Yati)', 'Myanmar Big Shop(Shwe. Yati)', '2020-10-26', '12/Ka Ma Ya(N)051658', '13', 'No. 37.Yartashone(old). Bahan', '2', 1, 2, '1611024289Screenshot_20210119_090205.png', '1611024289Screenshot_20210119_090205.png', NULL, NULL, '2021-01-19 02:44:50', '2021-01-19 02:44:50', '1611024289Screenshot_20210119_090205.png', '1611024290Screenshot_20210119_090205.png', 2, 3, 'Manager'),
(22, 41, '09791384847', '09791384847', 'Kyal Sin', 'Kyal Sin', '2021-01-05', '88990', '43', 'Between 82st and 83st, Mandalay', '2', 2, 2, '1611046567Thadar.jpg', '1611046567Thadar.jpg', 14, NULL, '2021-01-19 08:56:07', '2021-01-20 08:42:30', '1611046567Thadar.jpg', '1611046567Thadar.jpg', 1, 3, 'owner'),
(23, 42, '0943103270', '0943103270', 'U Paw Sein Store', 'U Paw Sein Store', '2021-01-19', '1/19/2021', '34', '65,West Myin Street,Yait Thar Qtr,Hlegu Township,Yangon.', '2', 1, 2, '1611110476IMG-0f3a64149b033eda26544413d6147900-V.jpg', '1611110476IMG-252d4da8b866bc8fbd90299358516e08-V.jpg', NULL, NULL, '2021-01-20 02:41:16', '2021-01-20 02:41:16', '1611110476IMG-0f3a64149b033eda26544413d6147900-V.jpg', '1611110476IMG-252d4da8b866bc8fbd90299358516e08-V.jpg', 2, 2, 'Owner'),
(24, 43, '09799888237', '09799888237', 'Thidi San Pharmacy', 'Thidi San Pharmacy', '2020-10-26', '12/Ba ha Na (N) 078724', '14', 'No. 321.Thuriya Aungsan street. 47 ward. North Dagon.', '2', 1, 2, '1611111272Screenshot_20210119_091718.png', '1611111272Screenshot_20210119_091718.png', NULL, NULL, '2021-01-20 02:54:32', '2021-01-20 02:54:32', '1611111272Screenshot_20210119_091718.png', '1611111272Screenshot_20210119_091718.png', 2, 3, 'Owner'),
(25, 44, '09925367844', '09925367844', 'Taraphi Store', 'Taraphi store', '2020-09-28', '7/Da Ou Na(N)023618', '14', 'No. 1135/ka. Tapinshwehti street. 38 ward.  North Dagon', '2', 1, 2, '1611111653Screenshot_20210120_092611.png', '1611111653Screenshot_20210120_092611.png', NULL, NULL, '2021-01-20 03:00:54', '2021-01-20 03:00:54', '1611111654Screenshot_20210120_092611.png', '1611111654Screenshot_20210120_092611.png', 2, 5, 'Owner'),
(26, 45, '09447742756', '09447742756', 'Win Myitta Pharmacy', 'Win Myitta pharmacy', '2020-09-28', '5/pa La Na(N)056674', '8', '17 ward. Inwa Street. Shwepoukkan township', '2', 1, 2, '1611112597Screenshot_20210120_093150.png', '1611112598Screenshot_20210120_093150.png', NULL, NULL, '2021-01-20 03:16:38', '2021-01-20 03:16:38', '1611112598Screenshot_20210120_093150.png', '1611112598Screenshot_20210120_093150.png', 2, 3, 'Owner'),
(27, 46, '09925367844', '09925367844', 'Thuka pharmacy', 'Thuka pharmacy', '2020-09-28', '12/Ou Ca Ma (N)159773', '8', 'No. 9.စ် Zay. Maydarwai Street. North Okkalapa', '2', 1, 2, '1611113206Screenshot_20210120_094752.png', '1611113206Screenshot_20210120_094752.png', NULL, NULL, '2021-01-20 03:26:46', '2021-01-20 03:26:46', '1611113206Screenshot_20210120_094752.png', '1611113206Screenshot_20210120_094752.png', 2, 3, 'Owner'),
(28, 47, '09405181850', '09405181850', 'ZiwaThuka Pharmacy', 'Ziwa Thuka Pharmacy', '2020-09-28', '1/Da La Na(N)037782', '8', 'No. 44.စ်Zay. Maydarwai Street. North Okkalapa', '2', 1, 2, '1611113674Screenshot_20210120_095832.png', '1611113674Screenshot_20210120_095832.png', NULL, NULL, '2021-01-20 03:34:34', '2021-01-20 03:34:34', '1611113674Screenshot_20210120_095832.png', '1611113674Screenshot_20210120_095832.png', 2, 3, 'Owner'),
(29, 48, '09783332273', '09733332273', 'MaNawThuka pharmacy', 'MaNaw Thuka Pharmacy', '2020-09-28', '12/Ou Ca Ma (N)266961', '8', 'No. 569. Maydarwai Street. စ်Zay. North Okkalapa', '2', 1, 2, '1611114085Screenshot_20210120_101001.png', '1611114086Screenshot_20210120_101001.png', NULL, NULL, '2021-01-20 03:41:26', '2021-01-20 03:41:26', '1611114086Screenshot_20210120_101001.png', '1611114086Screenshot_20210120_101001.png', 2, 3, 'Owner'),
(30, 49, '09791384847', '09791384847', 'kyawkyaw', 'kyawkyaw', '2020-12-15', '556677', '4', 'No(127), Thiri 3st, Kamayut', '2', 2, 2, '1611118771Thadar.jpg', '1611118771Thadar.jpg', 14, NULL, '2021-01-20 04:59:31', '2021-01-20 08:42:22', '1611118771Thadar.jpg', '1611118771Thadar.jpg', 1, 5, 'owner'),
(31, 51, '095125660', '09790143577', 'Kadaytoe store', 'Kadaytoe store', '2020-09-29', '12/BTH(N)034163', '14', 'No. 669.Mandalay street. 36 ward. North Dagon', '2', 1, 2, '1611198685Screenshot_20210121_093640.png', '1611198686Screenshot_20210121_093640.png', NULL, NULL, '2021-01-21 03:11:26', '2021-01-21 03:11:26', '1611198686Screenshot_20210121_093640.png', '1611198686Screenshot_20210121_093640.png', 2, 2, 'Owner'),
(32, 52, '09450043622', '09450043622', 'AM store', 'A M store', '2020-09-30', '12/La Ma Na (N)154246', '18', 'No. 14.Myike Street. 2 ward. Sorth Dagon', '2', 1, 2, '1611199020Screenshot_20210121_094302.png', '1611199020Screenshot_20210121_094302.png', NULL, NULL, '2021-01-21 03:17:00', '2021-01-21 03:17:00', '1611199020Screenshot_20210121_094302.png', '1611199020Screenshot_20210121_094302.png', 2, 8, 'Owner'),
(33, 53, '09260715350', '09260715360', 'La Pyae Won Pharmacy', 'La Pyae won Pharmacy', '2020-09-30', '14/Ma Ea Pa(N)147634', '18', 'No. 1126.Pakan street&Kyun Shwe War street. Sourth Dagon', '2', 1, 2, '1611199349Screenshot_20210121_094752.png', '1611199349Screenshot_20210121_094752.png', NULL, NULL, '2021-01-21 03:22:29', '2021-01-21 03:22:29', '1611199349Screenshot_20210121_094752.png', '1611199349Screenshot_20210121_094752.png', 2, 3, 'Owner'),
(34, 54, '09965030286', '09965030286', 'SKY Pharmacy', 'SKY Pharmacy', '2020-09-30', '12/Ou Ca Ta(N)000009', '9', 'No. 332.Tumingalar street. Nananwon Zay \r\nSouth Okkalapa', '2', 1, 2, '1611199682Screenshot_20210121_095258.png', '1611199682Screenshot_20210121_095258.png', NULL, NULL, '2021-01-21 03:28:02', '2021-01-21 03:28:02', '1611199682Screenshot_20210121_095258.png', '1611199682Screenshot_20210121_095258.png', 2, 3, 'Owner'),
(35, 55, '09778556325', '09778556325', 'Ko Zaw Pharmacy', 'Ko Zaw pharmacy', '2020-10-01', '5/Ya Ma Pa (N)080491', '14', '5 ward. BayintNaung Street. North Dagon', '2', 1, 2, '1611200130Screenshot_20210121_100019.png', '1611200130Screenshot_20210121_100019.png', NULL, NULL, '2021-01-21 03:35:30', '2021-01-21 03:35:30', '1611200130Screenshot_20210121_100019.png', '1611200130Screenshot_20210121_100019.png', 2, 3, 'Owner'),
(36, 56, '09886855292', '09886855292', 'Myitta Pharmacy', 'Myitta pharmacy', '2020-10-08', '14/La Pa Ta (N)125178', '17', 'No. 120.Min Nandar Street. 2 ward. Tarkayta', '2', 1, 2, '1611201132Screenshot_20210121_101156.png', '1611201132Screenshot_20210121_101156.png', NULL, NULL, '2021-01-21 03:52:12', '2021-01-21 03:52:12', '1611201132Screenshot_20210121_101156.png', '1611201132Screenshot_20210121_101156.png', 2, 3, 'Owner'),
(37, 57, '0942030605', '0942030605', 'U Pharm Pharmacy', 'U pharm pharmacy', '2020-10-08', '12/Da Ga Ta(N)132065', '17', 'No. 5.Thadar Nwe street. Dowpon', '2', 1, 2, '1611201638Screenshot_20210121_102253.png', '1611201638Screenshot_20210121_102253.png', NULL, NULL, '2021-01-21 04:00:38', '2021-01-21 04:00:38', '1611201638Screenshot_20210121_102253.png', '1611201638Screenshot_20210121_102253.png', 2, 3, 'Owner'),
(38, 58, '09401702232', '09401702232', 'Pwint San Pharmacy&Store', 'Pwint san Pharmacy &Store', '2020-09-30', '12/Da Ga Na(N)010585', '9', 'No. 321.Yandanar Street. 11 ward. Soith Okkalapa', '2', 1, 2, '1611203510Screenshot_20210121_105749.png', '1611203510Screenshot_20210121_105749.png', NULL, NULL, '2021-01-21 04:31:50', '2021-01-21 04:31:50', '1611203510Screenshot_20210121_105749.png', '1611203510Screenshot_20210121_105749.png', 2, 5, 'Owner'),
(39, 59, '09799904586', '09799904586', 'Sun Mini Mart', 'Sun Mini Mart', '2020-12-01', '14/Pa Ta Na(N)223698', '8', 'No. 564.pukan Street. Shwe Pouk kan', '2', 1, 2, '1611204286Screenshot_20210121_111338.png', '1611204286Screenshot_20210121_111338.png', NULL, '2021-01-27 07:41:23', '2021-01-21 04:44:47', '2021-01-27 07:41:23', '1611204286Screenshot_20210121_111338.png', '1611204287Screenshot_20210121_111338.png', 2, 7, 'Owner'),
(40, 60, '09799904586', '09799904586', 'Sun Mini Mart', 'Sun Mini Mart', '2020-12-01', '14/Pa Ta Na(N)223698', '8', 'No. 564.pukan Street. Shwe Pouk kan', '2', 1, 2, '1611204288Screenshot_20210121_111338.png', '1611204288Screenshot_20210121_111338.png', NULL, NULL, '2021-01-21 04:44:49', '2021-01-21 04:44:49', '1611204289Screenshot_20210121_111338.png', '1611204289Screenshot_20210121_111338.png', 2, 7, 'Owner'),
(41, 61, '09253737385', '09253737385', 'Ag Mart', 'Ag Mart', '2021-01-25', '25/1/2021', '7', 'Maharbanduula Road,9 Qt ,Shwe Pyi Thar Township', '2', 1, 2, '161154607820210125_100101.jpg', '161154607920210125_100101.jpg', 1, NULL, '2021-01-25 03:41:19', '2021-01-27 07:41:07', '161154607920210125_100234.jpg', '161154607920210125_100234.jpg', 2, 8, 'Owner'),
(42, 64, '09791384847', '09791384847', 'Joker', 'Joker', '2020-12-29', '444444', '1', 'dfsdfds', '1', 1, 1, '1611632996images.jpg', '1611632996images.jpg', NULL, '2021-01-27 07:36:39', '2021-01-26 03:49:56', '2021-01-27 07:36:39', '1611632996images.jpg', '1611632996images.jpg', 2, 4, 'owner'),
(43, 65, '09776223990', '09776223990', 'Yar Zar', 'Yar Zar', '2021-01-25', '12/ThaKhaNa(N)096072', '32', 'Aung Zaya Road , Thone Gwa', 'ဘဏ်ရွေးချယ်ပါ', 1, 2, '1611635628D7A2BB91-81B2-42BB-BB0F-6A2240F09BF8.jpeg', '16116356281CBA1959-56D2-45BE-8469-7F253B5770AF.jpeg', 9, NULL, '2021-01-26 04:33:48', '2021-01-27 07:37:05', '16116356280B10C7C3-650F-490F-9F8C-2134E7F8D5E0.jpeg', '16116356285BCD0144-14A6-4ADF-8024-E59953D66351.jpeg', 2, 7, 'Owner'),
(44, 66, '09425301694', '09425301694', 'Daw Aye Than Store', 'Daw Aye Than Store', '2021-01-25', 'Ka Ga Ka (N)151719', '10', 'No.43.Hnin Si Gone Street.Thingangyun\r\nTownship', '2', 1, 2, '1611636829FDEFDAE5-42C5-4BBB-B2E8-13A5AAB51067.jpeg', '16116368298920A9EF-C6CA-409E-8E35-942EB6CDEB0E.jpeg', 9, NULL, '2021-01-26 04:53:49', '2021-01-27 07:34:45', '1611636829803085B6-3B71-47AA-B420-F61CA124B1EF.jpeg', '1611636829E1610FD3-E0BA-41CC-AFA2-6B74F53ABA07.jpeg', 2, 8, 'Owner'),
(45, 67, '09425301694', '09425301694', 'Daw Aye Than Store', 'Daw Aye Than Store', '2021-01-25', 'Ka Ga Ka (N)151719', '10', 'No.43.Hnin Si Gone Street.Thingangyun\r\nTownship', '2', 1, 2, '1611636857FDEFDAE5-42C5-4BBB-B2E8-13A5AAB51067.jpeg', '16116368578920A9EF-C6CA-409E-8E35-942EB6CDEB0E.jpeg', NULL, '2021-01-26 05:11:09', '2021-01-26 04:54:17', '2021-01-26 05:11:09', '1611636857803085B6-3B71-47AA-B420-F61CA124B1EF.jpeg', '1611636857E1610FD3-E0BA-41CC-AFA2-6B74F53ABA07.jpeg', 2, 8, 'Owner'),
(46, 68, '09954271284', '09954271284', 'Flower mart', 'Flower mart', '2021-01-26', '၅/စကန(ဧ)၀၀၀၀၃၁', '9', 'No.296./ka.Thantumar street.5ward.South okkalapa', '1', 1, 2, '161164957321AD65DC-0199-4C49-BEA8-BE64B3107E73.jpeg', '16116495745B0AFE11-C192-4B35-9F70-18575584033A.jpeg', 9, NULL, '2021-01-26 08:26:15', '2021-01-26 08:34:55', '16116495759B63FB27-2CB3-482F-9965-E4F686475D08.jpeg', '1611649575FC21BFA7-F478-499C-A245-BA75573DF14D.jpeg', 2, 7, 'Owner'),
(47, 69, '09977046779', '09977046779', 'Jivaka', 'Jivaka', '2021-01-05', '112233', '39', '30st,76st.77st', '2', 1, 2, '1611731902Thukhamon.jpg', '1611731902Thukhamon.jpg', NULL, '2021-01-27 07:26:48', '2021-01-27 07:18:22', '2021-01-27 07:26:48', '1611731902Thukhamon.jpg', '1611731902Thukhamon.jpg', 1, 3, 'MD'),
(48, 70, '092038490', '092038490', 'Aye Ko Aye Cho', 'Aye Ko Aye Cho', '2021-01-27', '2334134', '45', '68st bet 113 &114st mdy\r\nPyigyitagon', '2', 1, 2, '1611732311IMG20201229133730.jpg', '1611732311IMG20201229134716.jpg', NULL, '2021-01-27 07:26:52', '2021-01-27 07:25:12', '2021-01-27 07:26:52', '1611732312IMG20201211111746.jpg', '1611732312IMG20201211105952.jpg', 2, 3, 'Owner'),
(49, 71, '09442700826', '09442700826', '​​​​​Phyu Sin Myittar', '​​​​​Phyu Sin Myittar', '2021-01-12', '112233', '36', '587,Lawkar Road,Shwepyithar Township.', '2', 2, 2, '1611735881Phyu Sin.jpg', '1611735881Phyu Sin.jpg', 1, NULL, '2021-01-27 08:24:41', '2021-01-27 08:26:52', '1611735881Phyu Sin.jpg', '1611735881Phyu Sin.jpg', 2, 3, 'owner'),
(50, 73, '0977648146', '0977648146', '​​​​​Shwe Taw Thar', '​​​​​Shwe Taw Thar', '2021-01-11', '112233', '36', '24 Qt,No (4) Road,Shwepyithar Township', '2', 1, 2, '1611735977shwe thaw tar.jpg', '1611735977shwe thaw tar.jpg', 1, NULL, '2021-01-27 08:26:17', '2021-01-27 08:26:29', '1611735977shwe thaw tar.jpg', '1611735977shwe thaw tar.jpg', 2, 8, 'owner'),
(51, 72, '09963003050', '09963006030', 'Aung', 'Aung', '2021-01-27', '5/ Pa la Na (N)150279', '8', 'Ayar(18). Nyar ward. North Okkalapa', '2', 1, 2, '1611735977received_264318118386155.jpeg', '1611735978received_264318118386155.jpeg', 9, NULL, '2021-01-27 08:26:18', '2021-01-27 08:27:52', '1611735978received_264318118386155.jpeg', '1611735978received_264318118386155.jpeg', 2, 3, 'Owner'),
(52, 74, '09450037749', '09450037749', 'Ngwe Kant kaw', 'Ngwe Kant Kaw', '2021-01-27', '5/Ya Ma Pa(N)083639', '8', 'No. 634.Bom Mar Street. Zamin Zwe ward. North Okkalapa', '2', 1, 2, '1611737687received_800801360504205.jpeg', '1611737687received_800801360504205.jpeg', NULL, NULL, '2021-01-27 08:54:47', '2021-01-27 08:54:47', '1611737687received_800801360504205.jpeg', '1611737687received_800801360504205.jpeg', 2, 3, 'Owner'),
(53, 75, '09790138556', '09790138556', 'Yu', 'Yu', '2021-01-27', '6/pa La Na (N)029074', '18', 'No. 221.sipin street. 18 ward. South Dagon', '2', 1, 2, '1611737919received_1400789980265469.jpeg', '1611737919received_1400789980265469.jpeg', NULL, NULL, '2021-01-27 08:58:39', '2021-01-27 08:58:39', '1611737919received_1400789980265469.jpeg', '1611737919received_1400789980265469.jpeg', 2, 8, 'Owner'),
(54, 76, '09423750195', '09423750195', 'Say Nan Taw', 'Say Nan Taw', '2021-01-12', '112233', '91', 'Lanmadaw Street, Pyi Taw Thar ward, U Shit Pin', '2', 1, 2, '1611738436Say Nan Taw.jpg', '1611738437Say Nan Taw.jpg', NULL, NULL, '2021-01-27 09:07:17', '2021-01-27 09:07:17', '1611738437Say Nan Taw.jpg', '1611738437Say Nan Taw.jpg', 2, 3, 'owner'),
(55, 77, '09790141381', '09790141381', 'Sat Kyar Shwe Yee.Store', 'Sat Kyar Shwe Yee.Store', '2021-01-28', '28/1/2021', '28', '73/C,Tat Kyi Kone Qtr,Pyay Road,Hmawbi', '2', 1, 2, '161181901020210128_121708.jpg', '161181901020210128_121708.jpg', 1, NULL, '2021-01-28 07:30:11', '2021-01-28 09:21:01', '161181901020210128_121708.jpg', '161181901120210128_121708.jpg', 2, 8, 'Owner'),
(56, 78, '09400400602', '09400400602', 'KMB Mart', 'KMB Mart', '2021-01-28', '12/Da Ga Ta (N)034227', '18', 'No. 258(CA). maungmakan street. 18 ward. South Dagon', '2', 1, 2, '1611821246received_120777306584254.jpeg', '1611821246received_120777306584254.jpeg', 9, NULL, '2021-01-28 08:07:27', '2021-01-28 09:20:29', '1611821247received_120777306584254.jpeg', '1611821247received_120777306584254.jpeg', 2, 7, 'Owner'),
(57, 79, '09762400810', '09762400810', 'Htun Kywal', 'Htun Kywal', '2021-01-28', '12/Ea Sa Na (N)150561', '14', 'No.238.Tapin Shwe Htee Street.36ward.North Dagon', 'ဘဏ်ရွေးချယ်ပါ', 1, 2, '1611823809EA4A3EA9-9130-414B-8BCD-41F8730D40F4.jpeg', '1611823809F3DFB135-E67C-4BC8-A8B8-0A0ED9914966.jpeg', 9, NULL, '2021-01-28 08:50:09', '2021-01-29 04:20:27', '1611823809EA3019D9-8A2E-4DD4-AEA0-7B490C895C67.jpeg', '16118238094D5F72F3-C754-4984-8046-78BFB146BBA6.jpeg', 2, 3, 'Owner'),
(58, 80, '09791384847', '09791384847', 'San Thit Sa', 'San Thit Sa', '2021-01-28', '112233', '68', 'Kyaiklat', '2', 1, 2, '1611836826image.jpg', '1611836827image.jpg', NULL, NULL, '2021-01-28 12:27:08', '2021-01-28 12:27:08', '1611836827image.jpg', '1611836828image.jpg', 3, 8, 'Owner'),
(59, 81, '09253243220', '09253243220', 'Nay Yaung Chi', 'Nay Yaung Chi', '2021-01-18', '6/La La Na (N)090579', '9', 'No. 227.Tantumar street. 2 ward.  South Okkalapa', '2', 1, 2, '1611888811received_238122291179829.jpeg', '1611888811received_238122291179829.jpeg', NULL, NULL, '2021-01-29 02:53:31', '2021-01-29 02:53:31', '1611888811received_238122291179829.jpeg', '1611888811received_238122291179829.jpeg', 2, 3, 'Owner'),
(60, 82, '09451845512', '09451845512', 'Suu Myat', 'Suu Myat', '2020-12-29', '11/Ca Pha Na (N)035484', '9', 'No. 902.Thiri Zayar Street. 7 ward. South OKKalapa', '2', 1, 2, '1611889422received_2731205767140651.jpeg', '1611889422received_2731205767140651.jpeg', 9, NULL, '2021-01-29 03:03:43', '2021-01-29 05:07:07', '1611889422received_2731205767140651.jpeg', '1611889423received_2731205767140651.jpeg', 2, 8, 'Owner'),
(61, 83, '09794291399', '09794291399', 'Thein Kabar', 'Thein Kabar', '2020-12-30', '10/Ta Pha Ya (N)128885', '30', 'Htama lone pogada East. Kyuk Tan Street', '2', 1, 2, '1611891600received_421761012214242.jpeg', '1611891600received_421761012214242.jpeg', 8, NULL, '2021-01-29 03:40:00', '2021-01-29 05:08:31', '1611891600received_421761012214242.jpeg', '1611891600received_421761012214242.jpeg', 2, 8, 'Owner'),
(62, 84, '09420022870', '09420022870', 'Zaw Pyan', 'Zaw Pyan', '2020-12-30', '12/Ca Ta Na(N)000380', '30', 'No. 65.Sin Kan Street. Sin Kan ward. Kyut Tan Town Ship', '2', 1, 2, '1611895669received_135206948434056.jpeg', '1611895669received_135206948434056.jpeg', 8, NULL, '2021-01-29 04:47:49', '2021-01-29 05:08:08', '1611895669received_135206948434056.jpeg', '1611895669received_135206948434056.jpeg', 2, 8, 'Owner'),
(63, 85, '09260454972', '09260464972', 'Thidi pharmacy', 'Thidi Pharmacy', '2021-01-18', '6/Ma Ma Na (N)148405', '9', 'No. 908/Ca. Byamaso street. 5ward. South Okkalapa', 'ဘဏ်ရွေးချယ်ပါ', 1, 2, '1611896412received_244000950547573.jpeg', '1611896412received_244000950547573.jpeg', 9, NULL, '2021-01-29 05:00:12', '2021-01-29 05:07:42', '1611896412received_244000950547573.jpeg', '1611896412received_244000950547573.jpeg', 2, 3, 'Owner'),
(64, 86, '09785157363', '09785157363', 'Moe Thu San Mart', 'Moe Thu San Mart', '2021-01-12', '12/Ca Ma Ya (N)062737', '8', 'No. 654.Maydarwi Street. ဆ ward. North Okkalapa', '2', 1, 2, '1611897624received_427904985077400.jpeg', '1611897624received_427904985077400.jpeg', 9, NULL, '2021-01-29 05:20:25', '2021-01-29 05:22:17', '1611897625received_427904985077400.jpeg', '1611897625received_427904985077400.jpeg', 2, 7, 'Owner'),
(65, 87, '095038205', '095038205', 'Pyae', 'Pyae', '2021-01-19', '7/Pa Ta Na(N)006264', '11', 'Myan Gyi Aung street.Sawbwargyi gone.10mile', '2', 1, 2, '1611899511FB9B5EBC-E668-4B10-A628-6A1FF1FFDCDB.jpeg', '1611899511C1978715-53B6-46D4-B361-2BD6D740DA39.jpeg', 9, NULL, '2021-01-29 05:51:51', '2021-01-29 05:54:02', '1611899511B8B67390-139F-4DED-84FC-1C94F0F67616.jpeg', '1611899511F668DCC2-7D65-4AB8-BD17-4BE33E01E987.jpeg', 2, 3, 'Owner'),
(66, 88, '09963879770', '09963879770', 'Test', 'Test', '2021-01-29', '096321', '2', 'Test', '1', 1, 1, '1611911828Geometry04.jpg', '1611911828NaturalTexture06.jpg', NULL, NULL, '2021-01-29 09:17:08', '2021-01-29 09:17:08', '1611911828NaturalTexture01.jpg', '1611911828Geometry01.jpg', 1, 1, 'Owner'),
(67, 89, '09254006774', '09254006774', 'Ar Raw Jan', 'Ar Raw Jan', '2021-01-14', 'No', '14', 'No. 720.30ward. Bayint Naung street. North Dagon', '2', 1, 2, '1611912829Screenshot_20210129_160212.png', '1611912829Screenshot_20210129_160212.png', NULL, NULL, '2021-01-29 09:33:49', '2021-01-29 09:33:49', '1611912829Screenshot_20210129_160212.png', '1611912829Screenshot_20210129_160212.png', 2, 3, 'Owner'),
(68, 90, '09448021453', '09448021453', 'Paiel', 'Paiel', '2021-01-07', '12/Ma Ga Na(N)079503', '17', 'No. 745.Manpay(14)Street. 3 zay. Tarkayta', '2', 1, 2, '1611913456received_117601640239749.jpeg', '1611913456received_117601640239749.jpeg', NULL, NULL, '2021-01-29 09:44:17', '2021-01-29 09:44:17', '1611913457received_117601640239749.jpeg', '1611913457received_117601640239749.jpeg', 2, 3, 'Owner');

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biller_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urgent_order` int(11) NOT NULL DEFAULT 0,
  `delivered_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`id`, `invoice_no`, `biller_address`, `delivery_address`, `customer_note`, `invoice`, `urgent_order`, `delivered_at`, `deleted_at`, `created_at`, `updated_at`, `status`) VALUES
(1, 'DHPS-ORD-210119-0003', 'Between 82st and 83st, Mandalay', 'Between 82st and 83st, Mandalay', NULL, '20210205-0745_2MB.pdf', 0, NULL, NULL, '2021-01-19 08:57:05', '2021-02-05 07:45:28', 0),
(2, 'DHPS-ORD-210120-0004', 'No(127), Thiri 3st, Kamayut', 'No(127), Thiri 3st, Kamayut', NULL, '20210127-0427_DHPS Invoice - 0000522.pdf', 1, NULL, NULL, '2021-01-20 05:01:33', '2021-01-27 04:27:48', 0),
(3, 'DHPS-ORD-210127-0005', 'No.296./ka.Thantumar street.5ward.South okkalapa', 'No.296./ka.Thantumar street.5ward.South okkalapa', NULL, NULL, 1, NULL, '2021-01-27 03:18:27', '2021-01-27 03:16:50', '2021-01-27 03:18:27', 0),
(4, 'DHPS-ORD-210127-0006', 'No.296./ka.Thantumar street.5ward.South okkalapa', 'No.296./ka.Thantumar street.5ward.South okkalapa', NULL, '20210127-0752_DHPS Invoice - 0000553.pdf', 1, NULL, NULL, '2021-01-27 03:19:15', '2021-01-27 07:52:02', 0),
(5, 'DHPS-ORD-210127-0007', '587,Lawkar Road,Shwepyithar Township.', '587,Lawkar Road,Shwepyithar Township.', NULL, '20210127-0845_DHPS Invoice - 0000558.pdf', 1, NULL, NULL, '2021-01-27 08:29:30', '2021-01-27 08:45:59', 0),
(6, 'DHPS-ORD-210127-0008', '24 Qt,No (4) Road,Shwepyithar Township', '24 Qt,No (4) Road,Shwepyithar Township', NULL, NULL, 1, NULL, NULL, '2021-01-27 08:31:59', '2021-01-27 08:32:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders_has_order_requests`
--

CREATE TABLE `customer_orders_has_order_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_order_id` bigint(20) UNSIGNED NOT NULL,
  `order_request_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_orders_has_order_requests`
--

INSERT INTO `customer_orders_has_order_requests` (`id`, `customer_order_id`, `order_request_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL),
(3, 1, 3, NULL, NULL, NULL),
(4, 1, 4, NULL, NULL, NULL),
(5, 2, 5, NULL, NULL, NULL),
(6, 2, 6, NULL, NULL, NULL),
(7, 2, 7, NULL, NULL, NULL),
(8, 2, 8, NULL, NULL, NULL),
(9, 2, 9, NULL, NULL, NULL),
(10, 2, 10, NULL, NULL, NULL),
(11, 2, 11, NULL, NULL, NULL),
(12, 2, 12, NULL, NULL, NULL),
(17, 4, 17, NULL, NULL, NULL),
(18, 4, 18, NULL, NULL, NULL),
(19, 4, 19, NULL, NULL, NULL),
(20, 4, 20, NULL, NULL, NULL),
(21, 5, 21, NULL, NULL, NULL),
(22, 5, 22, NULL, NULL, NULL),
(23, 6, 23, NULL, NULL, NULL),
(24, 6, 24, NULL, NULL, NULL),
(25, 6, 25, NULL, NULL, NULL),
(26, 6, 26, NULL, NULL, NULL),
(27, 6, 27, NULL, NULL, NULL),
(28, 6, 28, NULL, NULL, NULL),
(29, 6, 29, NULL, NULL, NULL),
(30, 6, 30, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_types`
--

CREATE TABLE `customer_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_types`
--

INSERT INTO `customer_types` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Class A', NULL, '2020-09-03 17:02:40', '2020-09-03 17:02:40'),
(2, 'Class B', NULL, '2020-09-03 17:02:40', '2020-09-03 17:02:40'),
(3, 'Class C', NULL, '2020-09-03 17:02:40', '2020-09-03 17:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dep_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dep_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Department 1', NULL, '2020-08-28 02:16:16', '2020-08-28 02:16:16'),
(2, 'Department 2', NULL, '2020-08-28 02:16:16', '2020-08-28 02:16:16'),
(3, 'Department 3', '2021-01-05 07:43:24', '2020-08-28 02:16:16', '2021-01-05 07:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contact`
--

CREATE TABLE `emergency_contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_member_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emergency_contact`
--

INSERT INTO `emergency_contact` (`id`, `name`, `phone`, `city`, `team_member_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hnin', '09250888888', 'Htout Kyunt', 1, '2020-11-13 04:58:43', '2020-12-27 13:09:51', '2020-12-27 13:09:51'),
(2, 'Kyaw Ye Naing', '09444011121', 'Mandalay', 2, '2020-12-14 06:31:56', '2020-12-14 06:31:56', NULL),
(3, 'Ye Naing', '09970347735', 'Mandalay', 3, '2020-12-14 06:47:34', '2020-12-14 06:47:34', NULL),
(4, 'Thura Oo', '09250894843', 'Monywa', 4, '2020-12-14 06:56:23', '2020-12-14 06:56:23', NULL),
(5, 'Lwin Aung', '09250893432', 'Yangon', 5, '2020-12-14 07:04:51', '2020-12-14 07:04:51', NULL),
(6, 'hmmm', '0987654321', 'ygn', 6, '2020-12-27 12:57:18', '2020-12-27 12:59:29', '2020-12-27 12:59:29'),
(7, 'hmmm', '0987654321', 'ygn', 7, '2020-12-27 12:58:41', '2020-12-27 12:59:26', '2020-12-27 12:59:26'),
(8, 'Zayar Myint', '09420066196', 'Yangon', 8, '2020-12-27 13:04:23', '2020-12-27 13:04:23', NULL),
(9, 'Hnin', '09425784477', 'Yangon', 1, '2020-12-27 13:11:16', '2020-12-27 13:11:16', NULL),
(10, 'Kyaw Kyaw Zin', '09954695045', 'Yangon', 9, '2020-12-27 13:16:57', '2020-12-27 13:16:57', NULL),
(11, 'Si Thu Htet', '09775747877', 'Ayeyarwaddy', 10, '2020-12-27 13:28:25', '2020-12-27 13:28:25', NULL),
(12, 'Kyaw Myo Han', '097953800079', 'Ayeyarwaddy', 11, '2020-12-27 13:35:22', '2020-12-27 13:35:22', NULL),
(13, 'Swe Swe Thin', '0943097540', 'Bago', 12, '2020-12-27 13:42:43', '2020-12-27 13:42:43', NULL),
(14, 'Phyo Myat Mon', '09799795072', 'Yangon', 13, '2021-01-18 03:10:57', '2021-01-18 03:10:57', NULL),
(15, 'fsdfds', '09-420066196', 'Yangon', 14, '2021-01-20 08:42:13', '2021-01-20 08:42:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `extra_users`
--

CREATE TABLE `extra_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `key`, `value`) VALUES
(1, 'order_no_next', '9');

-- --------------------------------------------------------

--
-- Table structure for table `member_customer_orders`
--

CREATE TABLE `member_customer_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` int(11) DEFAULT 0,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_order_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_customer_orders`
--

INSERT INTO `member_customer_orders` (`id`, `member_id`, `customer_id`, `customer_order_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 0, 22, 1, NULL, '2021-01-19 08:57:05', '2021-01-19 08:57:05'),
(2, 0, 30, 2, NULL, '2021-01-20 05:01:33', '2021-01-20 05:01:33'),
(3, 0, 46, 3, NULL, '2021-01-27 03:16:50', '2021-01-27 03:16:50'),
(4, 0, 46, 4, NULL, '2021-01-27 03:19:15', '2021-01-27 03:19:15'),
(5, 0, 49, 5, NULL, '2021-01-27 08:29:30', '2021-01-27 08:29:30'),
(6, 0, 50, 6, NULL, '2021-01-27 08:31:59', '2021-01-27 08:31:59');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_21_094611_create_permission_tables', 1),
(5, '2020_07_21_094918_create_products_table', 1),
(6, '2020_07_26_062122_create_departments_table', 1),
(7, '2020_07_26_062122_create_positions_table', 1),
(8, '2020_07_26_062123_create_customers_table', 1),
(9, '2020_07_26_075138_create_team_members_table', 1),
(10, '2020_07_26_080826_create_emergency_contact_table', 1),
(11, '2020_07_26_115511_create_customer_orders_table', 1),
(12, '2020_07_26_120644_create_order_requests_table', 1),
(13, '2020_07_26_121050_create_customer_orders_has_order_requests_table', 1),
(14, '2020_07_26_154733_create_return_reasons_table', 1),
(15, '2020_07_26_154735_create_credit_returns_table', 1),
(16, '2020_07_27_035721_create_consigments_table', 1),
(17, '2020_07_27_041407_create_extra_users_table', 1),
(18, '2020_07_27_041504_creat_consigments_has_extra_user_table', 1),
(19, '2020_07_27_133400_create_member_customer_orders_table', 1),
(20, '2020_08_10_072317_create_cities_table', 1),
(21, '2020_08_21_052659_add_image_to_products', 1),
(22, '2020_08_21_084730_add_applicant_company_to_customers', 1),
(23, '2020_08_24_072825_add_infos_to_team_members', 1),
(24, '2020_08_26_035211_create_zones_table', 1),
(25, '2020_08_26_041237_create_townships_table', 1),
(26, '2020_08_31_084926_add_status_to_users', 2),
(27, '2020_09_03_095539_create_customer_types_table', 3),
(28, '2020_09_03_100833_create_outlet_types_table', 4),
(29, '2020_09_03_101016_add_types_to_customers', 5),
(30, '2020_09_03_103926_create_outlet_types_table', 6),
(31, '2020_09_03_161502_create_customer_types_table', 7),
(32, '2020_09_03_161540_create_outlet_types_table', 7),
(33, '2020_09_03_165724_create_customer_types_table', 8),
(34, '2020_09_03_165735_create_outlet_types_table', 8),
(35, '2020_09_04_034733_add_types_to_customers_table', 9),
(36, '2020_09_04_050549_remove_position_id_from_customers', 10),
(37, '2020_09_04_051125_add_position_to_customers', 11),
(38, '2020_09_07_162735_add_status_to_customer_orders', 12);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 3),
(2, 'App\\User', 11),
(2, 'App\\User', 14),
(2, 'App\\User', 45),
(2, 'App\\User', 47),
(3, 'App\\User', 2),
(3, 'App\\User', 12),
(3, 'App\\User', 16),
(3, 'App\\User', 30),
(3, 'App\\User', 31),
(4, 'App\\User', 12),
(2, 'App\\User', 13),
(3, 'App\\User', 14),
(3, 'App\\User', 5),
(2, 'App\\User', 21),
(2, 'App\\User', 27),
(2, 'App\\User', 28),
(2, 'App\\User', 29),
(2, 'App\\User', 30),
(2, 'App\\User', 31),
(2, 'App\\User', 32),
(2, 'App\\User', 33),
(2, 'App\\User', 34),
(2, 'App\\User', 35),
(2, 'App\\User', 36),
(2, 'App\\User', 37),
(2, 'App\\User', 38),
(2, 'App\\User', 39),
(2, 'App\\User', 40),
(2, 'App\\User', 41),
(2, 'App\\User', 42),
(2, 'App\\User', 43),
(2, 'App\\User', 44),
(2, 'App\\User', 46),
(2, 'App\\User', 48),
(2, 'App\\User', 49),
(2, 'App\\User', 51),
(2, 'App\\User', 52),
(2, 'App\\User', 53),
(2, 'App\\User', 54),
(2, 'App\\User', 55),
(2, 'App\\User', 56),
(2, 'App\\User', 57),
(2, 'App\\User', 58),
(2, 'App\\User', 60),
(2, 'App\\User', 61),
(2, 'App\\User', 65),
(2, 'App\\User', 66),
(3, 'App\\User', 50),
(3, 'App\\User', 20),
(2, 'App\\User', 68),
(3, 'App\\User', 19),
(3, 'App\\User', 18),
(3, 'App\\User', 8),
(3, 'App\\User', 7),
(3, 'App\\User', 6),
(2, 'App\\User', 71),
(2, 'App\\User', 73),
(2, 'App\\User', 72),
(2, 'App\\User', 74),
(2, 'App\\User', 75),
(2, 'App\\User', 76),
(2, 'App\\User', 77),
(2, 'App\\User', 78),
(2, 'App\\User', 79),
(3, 'App\\User', 4),
(3, 'App\\User', 22),
(2, 'App\\User', 80),
(2, 'App\\User', 81),
(2, 'App\\User', 82),
(2, 'App\\User', 83),
(2, 'App\\User', 84),
(2, 'App\\User', 85),
(2, 'App\\User', 86),
(3, 'App\\User', 17),
(2, 'App\\User', 87),
(2, 'App\\User', 88),
(2, 'App\\User', 89),
(2, 'App\\User', 90);

-- --------------------------------------------------------

--
-- Table structure for table `order_requests`
--

CREATE TABLE `order_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pack_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_requests`
--

INSERT INTO `order_requests` (`id`, `item_no`, `pack_size`, `description`, `quantity`, `remark`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Newborn', NULL, 'NOD0001', 1, NULL, NULL, '2021-01-19 08:57:05', '2021-01-19 08:57:05'),
(2, 'Follow On', NULL, 'NOD0002', 1, NULL, NULL, '2021-01-19 08:57:05', '2021-01-19 08:57:05'),
(3, 'Toddler', NULL, 'NOD0003', 1, NULL, NULL, '2021-01-19 08:57:05', '2021-01-19 08:57:05'),
(4, 'Fortiplus', NULL, 'NOD0004', 2, NULL, NULL, '2021-01-19 08:57:05', '2021-01-19 08:57:05'),
(5, 'Newborn', NULL, 'NOD0001', 5, NULL, '2021-01-20 08:47:45', '2021-01-20 05:01:33', '2021-01-20 08:47:45'),
(6, 'Follow On', NULL, 'NOD0002', 5, NULL, '2021-01-20 08:47:45', '2021-01-20 05:01:33', '2021-01-20 08:47:45'),
(7, 'Toddler', NULL, 'NOD0003', 5, NULL, '2021-01-20 08:47:45', '2021-01-20 05:01:33', '2021-01-20 08:47:45'),
(8, 'Fortiplus', NULL, 'NOD0004', 10, NULL, '2021-01-20 08:47:45', '2021-01-20 05:01:33', '2021-01-20 08:47:45'),
(9, 'Newborn', NULL, 'NOD0001', 5, NULL, NULL, '2021-01-20 08:47:45', '2021-01-20 08:47:45'),
(10, 'Follow On', NULL, 'NOD0002', 5, NULL, NULL, '2021-01-20 08:47:45', '2021-01-20 08:47:45'),
(11, 'Toddler', NULL, 'NOD0003', 5, NULL, NULL, '2021-01-20 08:47:45', '2021-01-20 08:47:45'),
(12, 'Fortiplus', NULL, 'NOD0004', 10, NULL, NULL, '2021-01-20 08:47:45', '2021-01-20 08:47:45'),
(13, 'Newborn', NULL, 'NOD0001', 1, NULL, '2021-01-27 03:18:27', '2021-01-27 03:16:50', '2021-01-27 03:18:27'),
(14, 'Follow On', NULL, 'NOD0002', 3, NULL, '2021-01-27 03:18:27', '2021-01-27 03:16:50', '2021-01-27 03:18:27'),
(15, 'Toddler', NULL, 'NOD0003', 1, NULL, '2021-01-27 03:18:27', '2021-01-27 03:16:50', '2021-01-27 03:18:27'),
(16, 'Fortiplus', NULL, 'NOD0004', 5, NULL, '2021-01-27 03:18:27', '2021-01-27 03:16:50', '2021-01-27 03:18:27'),
(17, 'Newborn', NULL, 'NOD0001', 1, NULL, NULL, '2021-01-27 03:19:15', '2021-01-27 03:19:15'),
(18, 'Follow On', NULL, 'NOD0002', 1, NULL, NULL, '2021-01-27 03:19:15', '2021-01-27 03:19:15'),
(19, 'Toddler', NULL, 'NOD0003', 1, NULL, NULL, '2021-01-27 03:19:15', '2021-01-27 03:19:15'),
(20, 'Fortiplus', NULL, 'NOD0004', 1, NULL, NULL, '2021-01-27 03:19:15', '2021-01-27 03:19:15'),
(21, 'Fortiplus', NULL, 'NOD0004', 2, NULL, '2021-01-27 08:29:44', '2021-01-27 08:29:30', '2021-01-27 08:29:44'),
(22, 'Fortiplus', NULL, 'NOD0004', 2, NULL, NULL, '2021-01-27 08:29:45', '2021-01-27 08:29:45'),
(23, 'Newborn', NULL, 'NOD0001', 1, NULL, '2021-01-27 08:32:09', '2021-01-27 08:31:59', '2021-01-27 08:32:09'),
(24, 'Follow On', NULL, 'NOD0002', 1, NULL, '2021-01-27 08:32:09', '2021-01-27 08:31:59', '2021-01-27 08:32:09'),
(25, 'Toddler', NULL, 'NOD0003', 1, NULL, '2021-01-27 08:32:09', '2021-01-27 08:31:59', '2021-01-27 08:32:09'),
(26, 'Fortiplus', NULL, 'NOD0004', 1, NULL, '2021-01-27 08:32:09', '2021-01-27 08:31:59', '2021-01-27 08:32:09'),
(27, 'Newborn', NULL, 'NOD0001', 1, NULL, NULL, '2021-01-27 08:32:09', '2021-01-27 08:32:09'),
(28, 'Follow On', NULL, 'NOD0002', 1, NULL, NULL, '2021-01-27 08:32:09', '2021-01-27 08:32:09'),
(29, 'Toddler', NULL, 'NOD0003', 1, NULL, NULL, '2021-01-27 08:32:09', '2021-01-27 08:32:09'),
(30, 'Fortiplus', NULL, 'NOD0004', 1, NULL, NULL, '2021-01-27 08:32:09', '2021-01-27 08:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `outlet_types`
--

CREATE TABLE `outlet_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `outlet_types`
--

INSERT INTO `outlet_types` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Modern Trade', NULL, '2020-09-03 17:09:07', '2020-09-03 17:09:07'),
(2, 'Grocery', NULL, '2020-09-03 17:09:07', '2020-09-03 17:09:07'),
(3, 'Pharmacy', NULL, '2020-09-07 17:09:07', '2020-09-07 17:09:07'),
(4, 'Pharmacy & Cosmetic', NULL, '2020-09-07 17:09:07', '2020-09-07 17:09:07'),
(5, 'Pharmacy & Store', NULL, '2020-09-07 17:09:07', '2020-09-07 17:09:07'),
(6, 'Hospital', NULL, '2020-09-07 17:09:07', '2020-09-07 17:09:07'),
(7, 'Mini Mart', NULL, '2020-09-07 17:09:07', '2020-09-07 17:09:07'),
(8, 'Convenience Store', NULL, '2020-09-07 17:09:07', '2020-09-07 17:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2020-08-28 02:16:09', '2020-08-28 02:16:09'),
(2, 'role-create', 'web', '2020-08-28 02:16:09', '2020-08-28 02:16:09'),
(3, 'role-edit', 'web', '2020-08-28 02:16:09', '2020-08-28 02:16:09'),
(4, 'role-delete', 'web', '2020-08-28 02:16:09', '2020-08-28 02:16:09'),
(5, 'product-list', 'web', '2020-08-28 02:16:09', '2020-08-28 02:16:09'),
(6, 'product-create', 'web', '2020-08-28 02:16:09', '2020-08-28 02:16:09'),
(7, 'product-edit', 'web', '2020-08-28 02:16:09', '2020-08-28 02:16:09'),
(8, 'product-delete', 'web', '2020-08-28 02:16:09', '2020-08-28 02:16:09'),
(9, 'customer-list', 'web', '2020-08-28 02:16:10', '2020-08-28 02:16:10'),
(10, 'customer-create', 'web', '2020-08-28 02:16:10', '2020-08-28 02:16:10'),
(11, 'customer-edit', 'web', '2020-08-28 02:16:10', '2020-08-28 02:16:10'),
(12, 'customer-delete', 'web', '2020-08-28 02:16:10', '2020-08-28 02:16:10'),
(13, 'customerOrder-list', 'web', '2020-08-28 02:16:10', '2020-08-28 02:16:10'),
(14, 'customerOrder-create', 'web', '2020-08-28 02:16:10', '2020-08-28 02:16:10'),
(15, 'customerOrder-edit', 'web', '2020-08-28 02:16:10', '2020-08-28 02:16:10'),
(16, 'customerOrder-delete', 'web', '2020-08-28 02:16:10', '2020-08-28 02:16:10'),
(17, 'creditReturn-list', 'web', '2020-08-28 02:16:10', '2020-08-28 02:16:10'),
(18, 'creditReturn-create', 'web', '2020-08-28 02:16:10', '2020-08-28 02:16:10'),
(19, 'creditReturn-edit', 'web', '2020-08-28 02:16:11', '2020-08-28 02:16:11'),
(20, 'creditReturn-delete', 'web', '2020-08-28 02:16:11', '2020-08-28 02:16:11'),
(21, 'user-list', 'web', '2020-08-28 02:16:11', '2020-08-28 02:16:11'),
(22, 'user-create', 'web', '2020-08-28 02:16:11', '2020-08-28 02:16:11'),
(23, 'user-edit', 'web', '2020-08-28 02:16:11', '2020-08-28 02:16:11'),
(24, 'user-delete', 'web', '2020-08-28 02:16:11', '2020-08-28 02:16:11'),
(25, 'teamMember-list', 'web', '2020-08-28 02:16:11', '2020-08-28 02:16:11'),
(26, 'teamMember-create', 'web', '2020-08-28 02:16:11', '2020-08-28 02:16:11'),
(27, 'teamMember-edit', 'web', '2020-08-28 02:16:11', '2020-08-28 02:16:11'),
(28, 'teamMember-delete', 'web', '2020-08-28 02:16:11', '2020-08-28 02:16:11'),
(29, 'consigment-list', 'web', '2020-08-28 02:16:11', '2020-08-28 02:16:11'),
(30, 'consigment-create', 'web', '2020-08-28 02:16:11', '2020-08-28 02:16:11'),
(31, 'consigment-edit', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(32, 'consigment-delete', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(33, 'city-list', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(34, 'city-create', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(35, 'city-edit', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(36, 'city-delete', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(37, 'zone-list', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(38, 'zone-create', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(39, 'zone-edit', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(40, 'zone-delete', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(41, 'township-list', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(42, 'township-create', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(43, 'township-edit', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(44, 'township-delete', 'web', '2020-08-28 02:16:12', '2020-08-28 02:16:12'),
(45, 'warehouse-list', 'web', '2020-09-08 02:16:11', '2020-09-08 02:16:11'),
(46, 'department-list', 'web', '2020-12-17 10:33:21', '2020-12-17 10:33:21'),
(47, 'department-create', 'web', '2020-12-17 10:38:29', '2020-12-17 10:38:29'),
(48, 'department-edit', 'web', '2020-12-17 10:38:29', '2020-12-17 10:38:29'),
(49, 'department-delete', 'web', '2020-12-17 10:38:29', '2020-12-17 10:38:29'),
(50, 'position-list', 'web', '2020-12-17 10:38:29', '2020-12-17 10:38:29'),
(51, 'position-create', 'web', '2020-12-17 10:38:29', '2020-12-17 10:38:29'),
(52, 'position-edit', 'web', '2020-12-17 10:38:29', '2020-12-17 10:38:29'),
(53, 'position-delete', 'web', '2020-12-17 10:38:29', '2020-12-17 10:38:29');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position_name`, `department_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Position 1', 1, NULL, '2020-08-28 02:16:16', '2020-08-28 02:16:16'),
(2, 'Position 2', 1, NULL, '2020-08-28 02:16:16', '2020-08-28 02:16:16'),
(3, 'Position 3', 1, '2021-01-05 07:43:34', '2020-08-28 02:16:16', '2021-01-05 07:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `detail`, `price`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Newborn', 'NOD0001', 45000, '2020-09-07 01:27:02', '2021-01-19 04:40:24', 'NOD_Standard NewBorn_Myanmar.png'),
(2, 'Follow On', 'NOD0002', 39600, '2020-09-07 01:27:39', '2021-01-19 04:40:12', 'NOD_Standard Follow-On_Myanmar.png'),
(3, 'Toddler', 'NOD0003', 38500, '2020-09-07 01:29:09', '2021-01-19 04:40:04', 'NOD_Standard Toddler_Maynmar.png'),
(4, 'Fortiplus', 'NOD0004', 38500, '2020-09-07 01:31:18', '2021-01-19 04:39:55', 'NOD Fortiplus_Myanmar.png');

-- --------------------------------------------------------

--
-- Table structure for table `return_reasons`
--

CREATE TABLE `return_reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_reasons`
--

INSERT INTO `return_reasons` (`id`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Damaged', NULL, '2020-08-28 02:16:16', '2020-08-28 02:16:16'),
(2, 'Expire date less thant 6 months', NULL, '2020-08-28 02:16:16', '2020-08-28 02:16:16'),
(3, 'Different with invoice', NULL, '2020-08-28 02:16:16', '2020-08-28 02:16:16'),
(4, 'Different with order', NULL, '2020-08-28 02:16:16', '2020-08-28 02:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2020-08-28 02:16:13', '2020-08-28 02:16:13'),
(2, 'Customer', 'web', '2020-08-28 02:16:15', '2020-08-28 02:16:15'),
(3, 'Team Member', 'web', '2020-08-28 02:16:15', '2020-08-28 02:16:15'),
(4, 'Warehouse Manager', 'web', '2020-09-08 02:16:15', '2020-09-08 02:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(9, 3),
(10, 3),
(11, 3),
(13, 2),
(13, 3),
(13, 4),
(14, 2),
(14, 3),
(15, 2),
(15, 3),
(45, 4),
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1);

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `residential_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_of_employee` date NOT NULL,
  `emp_id_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `applicant_id_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_info_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `home_number`, `mobile_number`, `residential_address`, `postal_address`, `application_id`, `employee_info`, `department_id`, `position_id`, `user_id`, `date_of_employee`, `emp_id_no`, `created_at`, `updated_at`, `deleted_at`, `applicant_id_one`, `employee_info_one`) VALUES
(1, 'Htout Kyunt', '09250892649', 'No 28, BO Tay Za St, Htaukkyunt Township', '2', '1609074676EID.jpg', '1609074676ID-Back.jpg', 1, 1, 4, '2020-08-10', 'DHPS00015', '2020-11-13 04:58:43', '2020-12-27 14:06:23', NULL, '1609074676Eid_back.jpg', '1605243523KTK.jpg'),
(2, '09444011121', '09444011121', '42st, Between 86st & 87st, Maha Aung Myay, Mandalay.', '6', '1607927515MMK.jpg', '1607927515ID_card.jpg', 1, 1, 5, '2020-08-10', 'DHPS00020', '2020-12-14 06:31:56', '2020-12-14 06:31:56', NULL, '1607927515BACK.jpg', '1607927516ID_card.jpg'),
(3, '09250894036', '09250894036', '78 လမ်း ၄၂ ၄၃ကြားမန်းလေးမြို့', '7', '1607928454KYN_ID_Front.jpg', '1607928454ID_Card_Front.jpg', 1, 1, 6, '2020-08-10', 'DHPS00018', '2020-12-14 06:47:34', '2020-12-14 06:47:34', NULL, '1607928454back.jpg', '1607928454Id_back.jpg'),
(4, '09250894843', '09250894843', 'သာစည်လမ်း၊ဘုန်းစိုးရပ်ကွက်၊ Hotel BaThaung နှင့်မျက်နှာချင်းဆိုင်၊မုံရွာမြို့။', '8', '1607928983Front_ID.jpg', '1607928983id_front.jpg', 1, 1, 7, '2020-08-10', 'DHPS00019', '2020-12-14 06:56:23', '2020-12-14 06:56:23', NULL, '1607928983back_id.jpg', '1607928983id_back.jpg'),
(5, '09250893432', '09662120020', 'No.59, သန့်ဇင်လမ်းသွယ် ( 1 ),( 3 ) ရပ်ကွက် , မရမ်းကုန်းမြို့နယ်', '3', '1607929491Front_ID.jpg', '1607929491id_front.jpg', 1, 1, 8, '2020-08-10', 'DHPS00017', '2020-12-14 07:04:51', '2020-12-14 07:04:51', NULL, '1607929491back_id.jpg', '1607929491id_back.jpg'),
(6, '0987654321', '0987654321', 'test', '2', '1609073837Abstract-Tree-background-HD-Wallpaper (2).jpg', '1609073838Abstract-Tree-background-HD-Wallpaper (2).jpg', 1, 1, 14, '2020-12-22', 'hmm', '2020-12-27 12:57:18', '2020-12-27 12:59:29', '2020-12-27 12:59:29', '1609073838Abstract-Tree-background-HD-Wallpaper (2).jpg', '1609073838Abstract-Tree-background-HD-Wallpaper (2).jpg'),
(7, '0987654321', '0987654321', 'test', '1', '1609073921download (1).jpg', '1609073921download (1).jpg', 2, 2, 15, '2020-12-16', 'hmmq', '2020-12-27 12:58:41', '2020-12-27 12:59:26', '2020-12-27 12:59:26', '1609073921download (1).jpg', '1609073921download (1).jpg'),
(8, '09250893201', '09250893201', 'ဌ/၆၇၇ကံ့ကော်လမ်း မြောက်ဥက္ကလာ ပ', '4', '1609074263ID.jpg', '1609074263EID.jpg', 1, 1, 16, '2020-08-10', 'DHPS00016', '2020-12-27 13:04:23', '2020-12-27 14:06:13', NULL, '1609074263ID_back.jpg', '1609074263EID_back.jpg'),
(9, '09250892778', '09250892778', 'အမှတ်(အမှတ်322)ဖောင်တော်ဦးဘုရားလမ်းကျောက်ရေတွင်းရပ်ကွက်မြောက်ဥက္ကလာပမြို့နယ်', '5', '1609075017ID.jpg', '1609075017EID.jpg', 1, 1, 17, '2020-08-10', 'DHPS00014', '2020-12-27 13:16:57', '2020-12-27 14:05:59', NULL, '1609075017ID_back.jpg', '1609075017Eid_back.jpg'),
(10, '09795800079', '09795800079', 'ဧရာဝတီတိုင်း ကျိုက်လတ်မြို့နယ် လှိုင်းတာကျေးရွာ', '9', '1609075705ID.jpg', '1609075705EID.jpg', 1, 1, 18, '2020-08-10', 'DHPS00021', '2020-12-27 13:28:25', '2020-12-27 14:05:43', NULL, '1609075705ID_back.jpg', '1609075705EID_back.jpg'),
(11, '09775747877', '09775747877', 'Dayda Ye` Towship , Than Teik Village', '10', '1609076122ID.jpg', '1609076122EID.jpg', 1, 1, 19, '2020-08-10', 'DHPS00022', '2020-12-27 13:35:22', '2020-12-27 14:05:31', NULL, '1609076122ID_back.jpg', '1609076122EID_back.jpg'),
(12, '09250898188', '09250898188', 'အမှတ် ၁၉၀၇၊ ထန်းတပင် ၁ လမ်း၊ ဆံတော်တွင်းရပ်ကွက်၊ ပဲခူးမြို့', '11', '1609076563ID.jpg', '1609076563EID.jpg', 1, 1, 20, '2020-08-10', 'DHPS00023', '2020-12-27 13:42:43', '2020-12-27 14:05:21', NULL, '1609076563ID_back.jpg', '1609076563EID_back.jpg'),
(13, '09250891781', '09250891781', 'No(610), Zarni 12 street, 9 ward, South Okkalapa', '1', '1610939457ID_Front.jpg', '1610939457EID_Front.jpg', 1, 1, 22, '2020-08-10', 'DHPS00011', '2021-01-18 03:10:57', '2021-01-18 03:10:57', NULL, '1610939457ID_back.jpg', '1610939457EID_back.jpg'),
(14, '0933838383', '0933838383', 'kfjsjsdkf', '2', '1611132133Thadar.jpg', '1611132133Thadar.jpg', 1, 1, 50, '2021-01-04', 'DHPS00005', '2021-01-20 08:42:13', '2021-01-20 08:42:13', NULL, '1611132133Thadar.jpg', '1611132133Thadar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `townships`
--

CREATE TABLE `townships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `townships`
--

INSERT INTO `townships` (`id`, `name`, `city_id`, `zone_id`, `postal_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mingalardon', 1, 2, '11021', '2020-09-06 21:44:29', '2020-09-06 21:44:29', NULL),
(2, 'Sanchaung', 1, 2, '11111', '2020-09-06 21:45:23', '2020-09-06 21:45:23', NULL),
(3, 'Hlaing', 1, 2, '11052', '2020-09-06 22:05:21', '2020-09-06 22:05:21', NULL),
(4, 'Kamayut', 1, 2, '11041', '2020-09-06 22:05:52', '2020-09-06 22:05:52', NULL),
(5, 'Hlaing Thar Yar', 1, 2, '11401', '2020-09-06 22:06:27', '2020-09-06 22:06:27', NULL),
(6, 'Insein', 1, 2, '11012', '2020-09-06 22:06:56', '2020-09-06 22:06:56', NULL),
(7, 'Shwe Pyi Thar', 1, 2, '11411', '2020-09-06 22:11:25', '2020-09-06 22:11:25', NULL),
(8, 'North Okkala', 1, 3, '11032', '2020-09-06 22:13:00', '2020-09-06 22:13:00', NULL),
(9, 'South Okkala', 1, 3, '11091', '2020-09-06 22:13:26', '2020-09-06 22:13:26', NULL),
(10, 'Thingangyun', 1, 3, '11072', '2020-09-06 22:13:59', '2020-09-06 22:13:59', NULL),
(11, 'Mayangone', 1, 3, '11062', '2020-09-06 22:14:28', '2020-09-06 22:14:28', NULL),
(12, 'Yankin', 1, 3, '11082', '2020-09-06 22:14:53', '2020-09-06 22:14:53', NULL),
(13, 'Bahan', 1, 3, '11201', '2020-09-06 22:15:20', '2020-09-06 22:15:20', NULL),
(14, 'North Dagon', 1, 4, '11431', '2020-09-06 22:16:58', '2020-09-06 22:16:58', NULL),
(15, 'Bothahtaung', 1, 4, '11162', '2020-09-06 22:17:21', '2020-09-06 22:17:21', NULL),
(16, 'Puzundaung', 1, 4, '11142', '2020-09-06 22:17:47', '2020-09-06 22:17:47', NULL),
(17, 'Tharkayta /Daw pon', 1, 4, '11231', '2020-09-06 22:18:22', '2020-09-06 22:18:22', NULL),
(18, 'South Dagon', 1, 4, '11434', '2020-09-06 22:18:57', '2020-09-06 22:27:52', NULL),
(19, 'Dagon Seikkan', 1, 4, '11441', '2020-09-06 22:19:48', '2020-09-06 22:26:48', NULL),
(20, 'East Dagon', 1, 4, 'East Dagon', '2020-09-06 22:20:13', '2020-09-06 22:20:13', NULL),
(21, 'Mingalar  Taung Nyunt', 1, 5, '11221', '2020-09-06 22:20:50', '2020-09-06 22:20:50', NULL),
(22, 'Kyukthadar', 1, 5, '11182', '2020-09-06 22:21:18', '2020-09-06 22:21:18', NULL),
(23, 'Lanmadaw', 1, 5, '11131', '2020-09-06 22:21:42', '2020-09-06 22:21:42', NULL),
(24, 'Tarmwe', 1, 5, '11211', '2020-09-06 22:22:10', '2020-09-06 22:22:10', NULL),
(25, 'Pebedan', 1, 5, '11143', '2020-09-06 22:22:36', '2020-09-06 22:22:36', NULL),
(26, 'Alhone', 1, 5, '11121', '2020-09-06 22:23:01', '2020-09-06 22:23:01', NULL),
(27, 'Dala', 1, 1, '11261', '2020-09-06 22:25:40', '2020-09-06 22:25:40', NULL),
(28, 'Hmawbi', 1, 1, '11361', '2020-09-06 22:29:47', '2020-09-06 22:29:47', NULL),
(29, 'Htaukkyant', 1, 1, '11021', '2020-09-06 22:30:29', '2020-09-06 22:30:29', NULL),
(30, 'Thanlyin', 1, 1, '11291', '2020-09-06 22:31:56', '2020-09-06 22:31:56', NULL),
(31, 'Khayan', 1, 1, '11321', '2020-09-06 22:33:06', '2020-09-06 22:33:06', NULL),
(32, 'Twantay', 1, 1, '11331', '2020-09-06 22:34:33', '2020-09-06 22:34:33', NULL),
(33, 'Kunchankon', 1, 1, '11341', '2020-09-06 22:36:08', '2020-09-06 22:36:08', NULL),
(34, 'Hlegu', 1, 1, '11373', '2020-09-06 22:36:54', '2020-09-06 22:36:54', NULL),
(35, 'Hlegu', 1, 1, '11373', '2020-09-06 22:36:55', '2020-09-06 22:36:55', NULL),
(36, 'Htantabin', 1, 1, '11392', '2020-09-06 22:37:25', '2020-09-06 22:37:25', NULL),
(37, 'Seikgyikanaungto', 1, 1, '11271', '2020-09-06 22:37:56', '2020-09-06 22:37:56', NULL),
(38, 'Aungmyaythazan', 2, 6, '05012', '2020-09-06 22:46:20', '2020-09-06 22:46:20', NULL),
(39, 'Chanayethazan', 2, 6, '05024', '2020-09-06 22:46:53', '2020-09-06 22:46:53', NULL),
(40, 'Mahaaungmyay', 2, 6, '05033', '2020-09-06 22:47:57', '2020-09-06 22:47:57', NULL),
(41, 'Kyaukse', 2, 6, '05151', '2020-09-06 22:48:56', '2020-09-06 22:48:56', NULL),
(42, 'Madaya (Short Trip)', 2, 6, '05121', '2020-09-06 22:53:42', '2020-09-06 22:53:42', NULL),
(43, 'Chanmyathazi', 2, 7, '05041', '2020-09-06 22:54:20', '2020-09-06 22:54:20', NULL),
(44, 'Amarapura', 2, 7, '05061', '2020-09-06 22:55:21', '2020-09-06 22:55:21', NULL),
(45, 'Pyigyitagon', 2, 7, '05051', '2020-09-06 22:56:13', '2020-09-06 22:56:13', NULL),
(46, 'Myingyan (Short Trip)', 2, 7, '05251', '2020-09-06 22:56:49', '2020-09-06 22:56:49', NULL),
(47, 'Meiktila (Short Trip)', 2, 7, '05186', '2020-09-06 22:57:59', '2020-09-06 22:57:59', NULL),
(48, 'Meiktila (Short Trip)', 2, 7, '05186', '2020-09-06 22:58:02', '2020-09-06 22:58:02', NULL),
(49, 'Magway (Trip)', 2, 8, '04151', '2020-09-06 23:05:42', '2020-09-06 23:05:42', NULL),
(50, 'Minbu (Trip)', 2, 8, '04021', '2020-09-06 23:06:16', '2020-09-06 23:06:16', NULL),
(51, 'Upper Minhla (Trip)', 2, 8, '04073', '2020-09-06 23:07:18', '2020-09-06 23:07:18', NULL),
(52, 'Pakokku (Trip)', 2, 8, '04206', '2020-09-06 23:08:14', '2020-09-06 23:08:14', NULL),
(53, 'Taungdwingyi (Trip)', 2, 8, '04144', '2020-09-06 23:08:45', '2020-09-06 23:08:45', NULL),
(54, 'Yenanchaung(Trip)', 2, 8, '04162', '2020-09-06 23:11:18', '2020-09-06 23:11:18', NULL),
(55, 'Chauk (Trip)', 2, 8, '04171', '2020-09-06 23:11:45', '2020-09-06 23:11:45', NULL),
(56, 'Pwintphyu (Trip)', 2, 8, '04032', '2020-09-06 23:12:13', '2020-09-06 23:12:13', NULL),
(57, 'Monywa (Trip)', 2, 8, '02301', '2020-09-06 23:12:47', '2020-09-06 23:12:47', NULL),
(58, 'Mahlaing', 2, 8, '05201', '2020-09-06 23:13:45', '2020-09-06 23:13:45', NULL),
(59, 'Nyaung-U', 2, 8, '05231', '2020-09-06 23:14:30', '2020-09-06 23:14:30', NULL),
(60, 'Pyawbwe (Trip)', 2, 8, '05211', '2020-09-06 23:16:40', '2020-09-06 23:16:40', NULL),
(61, 'Shwe Bo (Trip)', 2, 8, '02261', '2020-09-06 23:17:10', '2020-09-06 23:17:10', NULL),
(62, 'Yae Oo(Trip)', 2, 8, '02241', '2020-09-06 23:19:33', '2020-09-06 23:19:33', NULL),
(63, 'Myin Mu (Short Trip)', 2, 8, '02341', '2020-09-06 23:20:22', '2020-09-06 23:20:22', NULL),
(64, 'Kyangin (Trip)', 3, 9, '10032', '2020-09-07 00:30:55', '2020-09-07 00:30:55', NULL),
(65, 'Myanaung (Trip)', 3, 9, '10043', '2020-09-07 00:31:37', '2020-09-07 00:31:37', NULL),
(66, 'Hinthada (Trip)', 3, 9, '10062', '2020-09-07 00:32:11', '2020-09-07 00:32:11', NULL),
(67, 'Nyaungdon (Trip)', 3, 9, '10162', '2020-09-07 00:32:49', '2020-09-07 00:32:49', NULL),
(68, 'Kyaiklat', 3, 9, '10241', '2020-09-07 00:33:22', '2020-09-07 00:33:22', NULL),
(69, 'Pyapon', 3, 9, '10254', '2020-09-07 00:33:57', '2020-09-07 00:33:57', NULL),
(70, 'Bogalay', 3, 9, '10231', '2020-09-07 00:34:44', '2020-09-07 00:34:44', NULL),
(71, 'Maubin', 3, 9, '10185', '2020-09-07 00:35:14', '2020-09-07 00:35:14', NULL),
(72, 'Kamma', 2, 8, '90304', '2020-09-07 00:39:00', '2020-09-07 00:39:00', NULL),
(73, 'Pathein', 3, 10, '10011', '2020-09-07 00:41:19', '2020-09-07 00:41:19', NULL),
(74, 'Myaungmya', 3, 10, '10211', '2020-09-07 00:42:00', '2020-09-07 00:42:00', NULL),
(75, 'Labutta (Trip)', 3, 10, '10121', '2020-09-07 00:42:27', '2020-09-07 00:42:27', NULL),
(76, 'Kyonpyaw (Trip)', 3, 10, '170105', '2020-09-07 00:43:02', '2020-09-07 00:43:02', NULL),
(77, 'Einme', 3, 10, '10191', '2020-09-07 00:43:30', '2020-09-07 00:43:30', NULL),
(78, 'Pantanaw (Trip)', 3, 10, '10171', '2020-09-07 00:43:59', '2020-09-07 00:43:59', NULL),
(79, 'Kyaung Gone', 3, 10, '10101', '2020-09-07 00:45:05', '2020-09-07 00:45:05', NULL),
(80, 'Wakema (Trip)', 3, 10, '10202', '2020-09-07 00:46:22', '2020-09-07 00:46:22', NULL),
(81, 'Bago', 4, 11, '08018', '2020-09-07 00:47:06', '2021-01-28 03:14:08', NULL),
(82, 'Daik-U (Trip)', 4, 11, '08064', '2020-09-07 00:48:46', '2020-09-07 00:48:46', NULL),
(83, 'Nyaunglaybin (Trip)', 4, 11, '08031', '2020-09-07 00:49:35', '2020-09-07 00:49:35', NULL),
(84, 'Shwegyin (Trip)', 4, 11, '08033', '2020-09-07 00:50:15', '2020-09-07 00:50:15', NULL),
(85, 'Taungoo (Trip)', 4, 12, '08104', '2020-09-07 00:50:47', '2020-09-07 00:50:47', NULL),
(86, 'Phyu (Trip)', 4, 12, '08145', '2020-09-07 00:51:21', '2020-09-07 00:51:21', NULL),
(87, 'Oktwin (Trip)', 4, 12, '08122', '2020-09-07 00:51:53', '2020-09-07 00:51:53', NULL),
(88, 'Yedashe (Trip)', 4, 12, '08113', '2020-09-07 00:52:23', '2020-09-07 00:52:23', NULL),
(89, 'Swa (Trip)', 4, 12, '00000', '2020-09-07 00:53:44', '2020-09-07 00:53:44', NULL),
(90, 'Shwedaung', 5, 13, '08182', '2020-09-07 00:54:31', '2020-09-07 00:54:31', NULL),
(91, 'Pyay', 5, 13, 'Pyay', '2020-09-07 00:54:59', '2020-09-07 00:54:59', NULL),
(92, 'Aung Lan', 5, 13, '04151', '2020-09-07 00:55:41', '2020-09-07 00:55:41', NULL),
(93, 'Gyobingauk', 5, 13, '80208', '2020-09-07 00:56:25', '2020-09-07 00:56:25', NULL),
(94, 'Letpadan', 5, 13, '08274', '2020-09-07 00:57:51', '2020-09-07 00:57:51', NULL),
(95, 'Nattalin', 5, 13, '08214', '2020-09-07 00:58:42', '2020-09-07 00:58:42', NULL),
(96, 'Okpho', 5, 13, '08253', '2020-09-07 00:59:08', '2020-09-07 00:59:08', NULL),
(97, 'Paungde', 5, 13, '08202', '2020-09-07 00:59:46', '2020-09-07 00:59:46', NULL),
(98, 'Thayarwady', 5, 13, '08232', '2020-09-07 01:00:18', '2020-09-07 01:00:18', NULL),
(99, 'Thonese', 5, 13, '00000', '2020-09-07 01:01:49', '2020-09-07 01:01:49', NULL),
(100, 'Oakkan', 5, 13, '00000', '2020-09-07 01:02:58', '2020-09-07 01:02:58', NULL),
(101, 'Thayet', 5, 13, '04091', '2020-09-07 01:07:04', '2020-09-07 01:07:04', NULL),
(102, 'Kyaikto', 6, 14, '12021', '2020-09-07 01:08:03', '2020-09-07 01:08:03', NULL),
(103, 'Thaton', 6, 14, '12041', '2020-09-07 01:08:32', '2020-09-07 01:08:32', NULL),
(104, 'Mawlamyine', 6, 14, '12014', '2020-09-07 01:08:59', '2020-09-07 01:08:59', NULL),
(105, 'Mudon', 6, 14, '12083', '2020-09-07 01:09:28', '2020-09-07 01:09:28', NULL),
(106, 'Thanbyuzayat', 6, 14, '12095', '2020-09-07 01:09:59', '2020-09-07 01:09:59', NULL),
(107, 'Myeik', 6, 14, '14053', '2020-09-07 01:10:52', '2020-09-07 01:10:52', NULL),
(108, 'Ye', 6, 14, '12103', '2020-09-07 01:11:15', '2020-09-07 01:11:15', NULL),
(109, 'Hpa-An', 6, 14, '13018', '2020-09-07 01:12:06', '2020-09-07 01:12:06', NULL),
(110, 'Waw', 6, 14, '08074', '2020-09-07 01:13:15', '2020-09-07 01:13:15', NULL),
(111, 'Taunggyi', 7, 15, '06012', '2020-09-07 01:14:14', '2020-09-07 01:14:14', NULL),
(112, 'Lashoi (Trip)', 7, 15, '06304', '2020-09-07 01:14:48', '2020-09-07 01:14:48', NULL),
(113, 'Yenangyaung', 2, 8, '04162', '2020-09-07 01:16:24', '2020-09-07 01:16:24', NULL),
(114, 'Mawgyun', 3, 9, '00000', '2020-09-07 01:17:15', '2020-09-07 01:17:15', NULL),
(115, 'Swa (Trip)', 4, 12, '00000', '2020-09-07 01:18:03', '2020-09-07 01:18:03', NULL),
(116, 'Thonese', 5, 13, '00000', '2020-09-07 01:18:41', '2020-09-07 01:18:41', NULL),
(117, 'Oakkan', 5, 13, '00000', '2020-09-07 01:19:18', '2020-09-07 01:19:18', NULL),
(118, 'Pyin Oo Lwin (Trip)', 2, 6, '05081', '2021-01-27 07:28:28', '2021-01-27 07:30:11', NULL),
(119, 'Sagaing (Trip)', 2, 6, '02371', '2021-01-27 07:34:01', '2021-01-27 07:34:14', NULL),
(120, 'Dedaye', 3, 9, '10261', '2021-01-29 08:12:35', '2021-01-29 08:13:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` int(11) DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_name`, `email_verified_at`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Admin', 'admin@dhps.com.mm', NULL, NULL, '$2y$10$ffV2tg7iChrQ10zKefrRF.W5WbzmgrlTVAfP8Uq7RuckBen2oJ2Ci', 1, NULL, '2020-10-12 11:16:20', '2020-10-12 11:16:20', 0),
(2, 'Warehouse Manager', 'warehouse@dhps.com.mm', NULL, NULL, '$2y$10$NQyCCj57kTXfmuMvsI6RmuZu50QyOX3PiCz71lqLbZI9H6kzcP9sS', 4, NULL, '2020-10-12 11:18:25', '2020-10-12 11:18:25', 0),
(3, 'Lan Thit', NULL, '110211', NULL, '$2y$10$G7RwOAw5ojkkib6AUDgBjOx0cyoAnFHTU5b.5./BaFyEoLSI6PUae', 2, NULL, '2020-11-13 04:54:02', '2020-12-28 01:33:25', 1),
(4, 'Kyaw Win Htut', 'kwhtut@mail.dhps.com.mm', 'DHPS0020', NULL, '$2y$10$mDF/Xz2782EsKtOOzkzqN.7r8MC/QQtpolSHgqEfL8oNTpmb.aRcC', 3, NULL, '2020-11-13 04:58:43', '2020-12-11 08:47:34', 0),
(5, 'Myo Min Kyaw', 'mmkyaw@mail.dhps.com.mm', 'DHPS00020', NULL, '$2y$10$l2JAouBCHhfrl3YcFjZGPuUiAV6bb2tP6fca0oukgMOJ6YlzQWgwG', 3, NULL, '2020-12-14 06:31:54', '2020-12-14 06:31:54', 0),
(6, 'Kyaw Yae’ Naing', 'yenaing@mai.dhps.com.mm', 'DHPS00018', NULL, '$2y$10$TJgNxUnyByswm52tZFGAa.H4RjLRJDBXyMXRG9QCIwCRegju.JdX6', 3, NULL, '2020-12-14 06:47:34', '2020-12-14 06:47:34', 0),
(7, 'Aung Thura Oo', 'atoo@mail.dhps.com.mm', 'DHPS00019', NULL, '$2y$10$XeDcAGf0ClxA6qmuygAJS./qWZGaWTVaUvXxN0SptzmTiNFza/fIq', 3, NULL, '2020-12-14 06:56:23', '2020-12-14 06:56:23', 0),
(8, 'Lwin Aung', 'lwinaung@mail.dhps.com.mm', 'DHPS00017', NULL, '$2y$10$d2y7YIyjvxqNMWAQsYXIxORQFVEzQ.ffXGlHQAWj6jmTvMeTEYii6', 3, NULL, '2020-12-14 07:04:51', '2020-12-14 07:04:51', 0),
(14, 'Host Myanmar', 'hmm@gmail.com', 'hmm', NULL, '$2y$10$7X83MjSCdYZ.2z.VsO9KVOMBjYwTmxCeCESTHPRHFSd3a8zXYAqji', 3, NULL, '2020-12-27 12:57:17', '2020-12-27 12:57:17', 0),
(16, 'Zayar Myint', 'zayarmyint@mail.dhps.com.mm', 'DHPS0016', NULL, '$2y$10$l0qbCgXhXOdQFvuY/e6cLebz1r/.iLhpQD5.qXeR7C0Vkl4f/7srS', 3, NULL, '2020-12-27 13:04:23', '2020-12-27 13:04:23', 0),
(17, 'Kyaw Kyaw Zin', 'kkzin@mail.dhps.com.mm', 'DHPS0014', NULL, '$2y$10$QvwSF8ZZYRZioe1sBt5VUegZFMdNF4dTWjiT7hQSZxwOYIHTSn/p2', 3, NULL, '2020-12-27 13:16:57', '2021-01-29 05:24:39', 0),
(18, 'Si Thu Htet', 'sthtet@mail.dhps.com.mm', 'DHPS0021', NULL, '$2y$10$MGNUCp4VU/uTfOd79l2YUeOAVtBojV3zkz7XCuB8r6/aOsJSSvGqu', 3, NULL, '2020-12-27 13:28:25', '2020-12-27 13:28:25', 0),
(19, 'Kyaw Myo Han', 'kmhan@mail.dhps.com.mm', 'DHPS0022', NULL, '$2y$10$VEvpbWRpZqQPbBjCbVB7JOKtKjS66fMRc6l0fy6dBunfVviAVO02.', 3, NULL, '2020-12-27 13:35:22', '2020-12-27 13:35:22', 0),
(20, 'Swe Swe Thin', 'ssthin@mail.dhps.com.mm', 'DHPS0023', NULL, '$2y$10$KNhhckNbJXqe.c2mUztBSewExgkCQdmZqZyDnLSfdzLmmXPPO2nwO', 3, NULL, '2020-12-27 13:42:43', '2020-12-27 13:42:43', 0),
(21, 'Phyo Myat Mon(Thadar)', NULL, '110913', NULL, '$2y$10$L9a.sE2S7HZyLkZVoH2oC.KxakiB419d1hdnKsfL.x0PU4Es34uKa', 2, NULL, '2021-01-18 03:03:44', '2021-01-21 02:57:09', 1),
(22, 'Su Mon Oo', 'sumonoo@mail.dhps.com.mm', 'DHPS00011', NULL, '$2y$10$lJKjppfAWdfaZv0VwTDlSeb6yiqOQKVDd1gxAJRaeHEzBThgCClHu', 3, NULL, '2021-01-18 03:10:57', '2021-01-18 03:10:57', 0),
(27, 'Daw Khin Myat Mon Win', NULL, '113618', NULL, '$2y$10$vtc77RvfWuaA0sIlWoMIwubBDi.shet6rfDTMGU1ZqMWMymeflAIG', 2, NULL, '2021-01-18 03:31:17', '2021-01-21 03:15:12', 0),
(28, 'Ma Ei Phyu', NULL, '114319', NULL, '$2y$10$fMLkBYN.Gw8zT7RjUPchNeGF1k8k1Wpsp.sCgKZLXm8A..zQnbugG', 2, NULL, '2021-01-18 04:22:45', '2021-01-18 04:26:21', 1),
(29, 'U Ohm Htoo', NULL, '1108210', NULL, '$2y$10$eRQzCt1RfVuiVz2pj6.A4.zbDPH2sFhJuArFhCTddDyJWbudSYEZi', 2, NULL, '2021-01-18 05:20:21', '2021-01-18 05:23:23', 1),
(30, 'U Ye Myat', NULL, '1129111', NULL, '$2y$10$KRWNz.zxkp2/2uvZrUXHO.kF77fGUsqHpaV455cVOB41.3YGfxLs.', 2, NULL, '2021-01-18 05:31:17', '2021-01-19 03:26:33', 1),
(31, 'Dr. Tin Zar Naing', NULL, '1107212', NULL, '$2y$10$Qput7oauKpTL8CbLdStVOu0o.Smn70ZY8Y0uNCg5WnWTlMxFXevnW', 2, NULL, '2021-01-18 05:39:31', '2021-01-21 02:52:02', 1),
(32, 'U Aung Nyein Htun', NULL, '1103213', NULL, '$2y$10$fh.ERahDSXXWEB2mfJ0VFOZxKaj9AWpyp8ZGBYgYKLSGqUo8peyHy', 2, NULL, '2021-01-18 05:52:11', '2021-01-18 07:29:37', 1),
(33, 'Daw Thin Thin Oo', NULL, '1103214', NULL, '$2y$10$pHcP7TNUINQbacCRLH2dFO58E9NhJMd.E2SVeoTyt4u4q9N9JLR6a', 2, NULL, '2021-01-18 05:59:17', '2021-01-18 07:29:17', 1),
(34, 'Ma Wyut Yee San', NULL, '1103215', NULL, '$2y$10$KNTo0qQvUHgLe7sMHdlqaerBd1/MNTvHqAmdgqySgIO7UA3kyBCYe', 2, NULL, '2021-01-18 06:08:54', '2021-01-18 07:29:12', 1),
(35, 'Ma win win', NULL, '1103216', NULL, '$2y$10$YIoEcsbAhvh77b6L1QwdZ.6AgDkjjxDbiEjPykBRF4joBp7enlmQy', 2, NULL, '2021-01-18 08:36:27', '2021-01-19 07:02:49', 1),
(36, 'Daw Tin Hlaing', NULL, '1143117', NULL, '$2y$10$YpyXWCFjg1GQzIFTV5U5yetZeMVtxO1cvrec09Fc1fqcwP5euOrMe', 2, NULL, '2021-01-18 08:44:17', '2021-01-21 02:56:13', 1),
(37, 'Ko Min Zaw', NULL, '1143118', NULL, '$2y$10$/sXH6rvSoj8YEFFPHIL6HezwJ8Srrqo1Bt8GrLKs8xNwFu8Qtjgo6', 2, NULL, '2021-01-18 08:54:49', '2021-01-21 02:56:23', 1),
(38, 'Ko Nay Linn Phyo', NULL, '1143119', NULL, '$2y$10$.ckI17IPNdvr3eSt7tp.Oe73ZsujN2dUKfBuOaaDnK5viEhWIy90.', 2, NULL, '2021-01-18 09:00:01', '2021-01-21 02:56:31', 1),
(39, 'Daw May Thu Aung', NULL, '1120120', NULL, '$2y$10$Gq7GtgvdeeCHLZFq6xFifOLwXHnO2b2UJCC8Al1UWmZsXHhWtB7S2', 2, NULL, '2021-01-19 02:40:05', '2021-01-21 02:56:41', 1),
(40, 'Daw May Thu Aung', NULL, '1120121', NULL, '$2y$10$dszRYOpUCEiQgFRsNsFM.e5xjEP3ymbJdJaGs4wHRVQLyZTjlh.1.', 2, NULL, '2021-01-19 02:44:49', '2021-01-19 07:05:47', 1),
(41, 'Sett Paing', NULL, '0504122', NULL, '$2y$10$vqLvO3mlbXkm1P6lDu9u0ucIc6yfNTUEr0Jw3V4Calgg0T9mUl60S', 2, NULL, '2021-01-19 08:56:07', '2021-01-19 08:56:20', 1),
(42, 'Daw Thin Thin', NULL, '1137323', NULL, '$2y$10$cTTMFfcOjxylgieep71LFudMHH5eUE0PASJL8iGwvo0yaR6UEWeT.', 2, NULL, '2021-01-20 02:41:16', '2021-01-21 02:52:15', 1),
(43, 'Daw San San Win', NULL, '1143124', NULL, '$2y$10$qtCuwM37n1aavWn/Rel0z.97fbC5h0mce2JQvWctvWJJPNWdghjQq', 2, NULL, '2021-01-20 02:54:32', '2021-01-21 02:52:24', 1),
(44, 'Daw Nyein Nyein Aye', NULL, '1143125', NULL, '$2y$10$80qIrZWJBUon5CTeuC0QyeCgvvI9KyY6lK3JMZCqc22dx7uNFI60m', 2, NULL, '2021-01-20 03:00:53', '2021-01-21 02:52:34', 1),
(45, 'Ma Thin Thin Kyu', NULL, '1103226', NULL, '$2y$10$eqIqnPXlBKrfaHR9C0W4B.y.6Qx28kJ4SXPiLwHw6XeV7ylKEeu1a', 2, NULL, '2021-01-20 03:16:37', '2021-01-21 02:52:42', 1),
(46, 'Ko Khin Mg', NULL, '1103227', NULL, '$2y$10$9/S.WPiX82jg2wvSLe.PsOv.w/XQPIhZbzgFqtbVimYkv0zLqSRku', 2, NULL, '2021-01-20 03:26:45', '2021-01-21 02:55:49', 1),
(47, 'Daw Sandar Myint', NULL, '1103228', NULL, '$2y$10$nQdUHOQl51CrH7J3gmzZU.bFQ5gfThdCD9DHyrOK0R4gYnfML0b7S', 2, NULL, '2021-01-20 03:34:34', '2021-01-21 02:55:56', 1),
(48, 'Daw Than Than Shwe', NULL, '1103229', NULL, '$2y$10$p21Pu.nqtxZxmBJiYQRAmOvPPxqmNQdlZ4xV6qo4vZWHgIXzXViny', 2, NULL, '2021-01-20 03:41:25', '2021-01-21 02:56:01', 1),
(49, 'Kyaw Thet', NULL, '1104130', NULL, '$2y$10$LEEtFrc3ebtVdEgysGCDG.C9gRt.QeEBmAch7GfcddyVkwzLvtGli', 2, NULL, '2021-01-20 04:59:31', '2021-01-20 05:00:38', 1),
(50, 'Kyaw', 'kyawthetkhaing@dhps.com.mm', 'DHPS00005', NULL, '$2y$10$tQlaR441ObPqi3gPVGFExe7BXgogw5MQzsczgHrNmL6oCIceadABq', 3, NULL, '2021-01-20 08:42:13', '2021-01-20 08:42:13', 0),
(51, 'Daw Chi', NULL, '1143131', NULL, '$2y$10$FGSdMLATDPTXA6L7lC8ASuOQ4J.mQs8HaAoN7iw869UMDOhmaGtJ6', 2, NULL, '2021-01-21 03:11:25', '2021-01-21 03:15:53', 1),
(52, 'Daw Ya min Thu', NULL, '1143432', NULL, '$2y$10$lLmc4KIp9hvdVMXub7wCwuaNtkKcodOXDZYWkJ8JkxID/s3WvcJ/K', 2, NULL, '2021-01-21 03:17:00', '2021-01-21 03:17:00', 0),
(53, 'Ko Soe Naing', NULL, '1143433', NULL, '$2y$10$iCa35atqsCABq8g0OQXKtOlHq.oOMcq6T27nf3LtfFB3RclCm4YpW', 2, NULL, '2021-01-21 03:22:29', '2021-01-21 03:22:29', 0),
(54, 'Daw Sandar Aye', NULL, '1109134', NULL, '$2y$10$cDywHfW1Phz8qeFvUPaElOOMfKibX92qJ3xaZXwLSCKXsCwK93/xm', 2, NULL, '2021-01-21 03:28:02', '2021-01-21 03:28:02', 0),
(55, 'U Zaw Zaw Oo', NULL, '1143135', NULL, '$2y$10$qEYhiOtMuCMAyLUxhGHrOexxQCaYBUwvEYCdLzVI/QTEptJmud0na', 2, NULL, '2021-01-21 03:35:30', '2021-01-21 03:35:30', 0),
(56, 'Daw Thida zwin', NULL, '1123136', NULL, '$2y$10$cdDlzAxN1E6BhG0Nlq.fb.WGSuE6KI4MzRQqfk.rxPHc/e7BLWHZK', 2, NULL, '2021-01-21 03:52:12', '2021-01-21 03:52:12', 0),
(57, 'U Than Myint', NULL, '1123137', NULL, '$2y$10$F3QUMeQEzm/LLCo8TcByCeASF.MztwxVDl6pAyJa9uN6a56wLNR2G', 2, NULL, '2021-01-21 04:00:37', '2021-01-21 04:00:38', 0),
(58, 'Daw Su Su Naing', NULL, '1109138', NULL, '$2y$10$CeQWr9uxxA8yBEFzW9uZvOebnE6dJMmUotVcZ3siF2/Gp5sziEim6', 2, NULL, '2021-01-21 04:31:50', '2021-01-21 04:31:50', 0),
(60, 'Ko Nanda Aung Hlaing', NULL, '1103240', NULL, '$2y$10$PCfQkPmnkf7itgOp5xV6PeBsrYbLoIGA5INQ9XFpOyruVurCFikaS', 2, NULL, '2021-01-21 04:44:48', '2021-01-27 07:41:18', 1),
(61, 'Daw kyi kyi win', NULL, '1141141', NULL, '$2y$10$kxojjuZwI.dbLzslkVyqo.P9dMq.iWDpgdT1vguace7lNkIeI.5uy', 2, NULL, '2021-01-25 03:41:18', '2021-01-25 04:00:22', 1),
(65, 'U Hla Thein', NULL, '1133143', NULL, '$2y$10$YDRFTU7PKMhzGmkgJ7cRD.fU4JIzX9FdXt8zc0NPPHMdAChkGffGa', 2, NULL, '2021-01-26 04:33:48', '2021-01-27 07:36:57', 1),
(66, 'Daw Aye Than', NULL, '1107244', NULL, '$2y$10$NPiL82rtkuU21/1sUA2IGOkRR9SOT1eBCJ3LbljXXWVHDKFEz8wBS', 2, NULL, '2021-01-26 04:53:49', '2021-01-27 07:34:37', 1),
(68, 'Ko Myo Thant', NULL, '1109146', NULL, '$2y$10$FWm4JQKytMAxqbR2t9rvEuhgM8vNV/ayDDEFvwHZmgOgokhSXCitS', 2, NULL, '2021-01-26 08:26:13', '2021-01-27 07:47:52', 1),
(71, '​Ko Win Zaw Htwe', NULL, '1139249', NULL, '$2y$10$cKu9yhGb8Or342plgiz.yOGhTVr5cI7D0xhyRlTwYc4m9dgg3wrr6', 2, NULL, '2021-01-27 08:24:41', '2021-01-27 08:26:45', 1),
(72, 'Ma Mi Nge', NULL, '1103251', NULL, '$2y$10$6AR9B4EHu0ZVIYojLvcpoOMlnkKNkl.HFvAzxWMIE8P8AkJ47Vuy2', 2, NULL, '2021-01-27 08:26:17', '2021-01-27 08:27:42', 1),
(73, '​Ko Thet Min Soe', NULL, '1139250', NULL, '$2y$10$ze8.ATwqBClsRyT4p/ZOoekxCaQiG2Y1hxvHDgN.Ke9IytLPgF3um', 2, NULL, '2021-01-27 08:26:17', '2021-01-27 08:26:34', 1),
(74, 'Ma Khin Htay yee', NULL, '1103252', NULL, '$2y$10$WuAMaFUABu0r7E/B3Hzc7uvFU2Vt.DvliLZ8TvBq7f5qBlTeiirOq', 2, NULL, '2021-01-27 08:54:46', '2021-01-27 08:54:47', 0),
(75, 'Daw Yu Yu Swe', NULL, '1143453', NULL, '$2y$10$HzZPdnI750BbXWYD44n0hOjmHRq2WgscXF8f0jsMdmQEgrVDq988u', 2, NULL, '2021-01-27 08:58:39', '2021-01-27 08:58:39', 0),
(76, 'Ko Zaw Moe Thu', NULL, 'Pyay54', NULL, '$2y$10$ockEzEYOEO2xC8HpLV5lg.tbfppTS0LfFaSeLUW0yG2W074/C7Wge', 2, NULL, '2021-01-27 09:07:16', '2021-01-27 09:07:17', 0),
(77, 'Daw Mya Sandar', NULL, '1136155', NULL, '$2y$10$h/rY8BA8DFtz7Jm1uwMO.OTuPTR2DpLYo2ggWoNevDSsOfZOEzsPi', 2, NULL, '2021-01-28 07:30:09', '2021-01-28 08:52:13', 1),
(78, 'Ma Ei Zin Mar Lwin', NULL, '1143456', NULL, '$2y$10$74BHnujCnjkKHpy6Hiy4GuC8WlZ0mDu9gG7JApU3FBe1oW8MmYami', 2, NULL, '2021-01-28 08:07:26', '2021-01-28 08:52:06', 1),
(79, 'Daw Htet Htet khing', NULL, '1143157', NULL, '$2y$10$DCrV8rv1qtQ.obJ1bX2VqucPcS61VYgnWHwVa/2jmtD./J6QUCxM.', 2, NULL, '2021-01-28 08:50:09', '2021-01-29 04:20:27', 1),
(80, 'U Thein Htike San', NULL, '1024158', NULL, '$2y$10$j/Maxcryz.NiPPGGusyxlO6woG/cl1u/oVOpUE3swOGceCvkfrh8O', 2, NULL, '2021-01-28 12:27:06', '2021-01-28 12:27:08', 0),
(81, 'Ko Tin Hein Aung', NULL, '1109159', NULL, '$2y$10$mEtr1PzukqMaWjYxnYGQyO50GfMMKPm9y6m7L0AxXV0luF4rzt3Ji', 2, NULL, '2021-01-29 02:53:30', '2021-01-29 06:34:50', 1),
(82, 'Daw Nyo Nyo Nwae', NULL, '1109160', NULL, '$2y$10$fTs5po8glR5TcvyzA3n3jOoEsiNd2IMBod/dXfZr7l6zp3gMJNIC2', 2, NULL, '2021-01-29 03:03:42', '2021-01-29 05:06:59', 1),
(83, 'Ko Myo Mon Thein', NULL, '1129161', NULL, '$2y$10$VncAkjMQpHWbl33SWB/GxuW9aQtmeUzak2LPMu.pYBY5OUPQLhpL.', 2, NULL, '2021-01-29 03:40:00', '2021-01-29 05:08:15', 1),
(84, 'Ko La Min Htun', NULL, '1129162', NULL, '$2y$10$ITXamqFSNCgHwq1dY3/ti.p8oE6Ek4KiVatUlqVhj.tIV7K12DpvW', 2, NULL, '2021-01-29 04:47:49', '2021-01-29 05:07:54', 1),
(85, 'Ko Taw Htet', NULL, '1109163', NULL, '$2y$10$WaOFYOCCqp1dZj0DQKCGnuhwcAu3r3JtgRRqPFerjJ8zSn1kEMOdS', 2, NULL, '2021-01-29 05:00:12', '2021-01-29 05:07:32', 1),
(86, 'Ma Moe Thu San', NULL, '1103264', NULL, '$2y$10$apiSfcB8UcxjKTW87dAtxeLN4VgwHkrwKz8mRl6T1lTNAhzLHEsyW', 2, NULL, '2021-01-29 05:20:24', '2021-01-29 05:21:30', 1),
(87, 'Daw Tin Htwe Latt', NULL, '1106265', NULL, '$2y$10$D/wMC99vlqdb5cnhiMdNmOKFbrLuP16pLFeN7Fi3qt7QtbxUTLGQy', 2, NULL, '2021-01-29 05:51:51', '2021-01-29 05:53:55', 1),
(88, 'Hnin Ei Ei Wyne', 'admin@hostmyanmar.net', '1111166', NULL, '$2y$10$kGhH.whdn0O8SV6/e3l6EeVLd/JYRgmaNGJ/aOw.35bz9L7voYDcu', 2, NULL, '2021-01-29 09:17:07', '2021-01-29 09:17:08', 0),
(89, 'Ko Kyaw Naing Oo', NULL, '1143167', NULL, '$2y$10$Y7xR5bu14nnnKIWiD5NJfejAK7806.SDzNR0oSSOykkuLQprMi2y6', 2, NULL, '2021-01-29 09:33:49', '2021-01-29 09:33:50', 0),
(90, 'Ma Soe Thidar Win', NULL, '1123168', NULL, '$2y$10$muokiPmkQszaXyVVXFSMC.Ykq64JWkG9BDjamI6elPyAE09xP25Vq', 2, NULL, '2021-01-29 09:44:16', '2021-01-29 09:44:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `name`, `city_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'YGN', 1, '2020-09-06 21:37:43', '2020-09-06 21:37:43', NULL),
(2, 'YGN 1', 1, '2020-09-06 21:37:54', '2020-09-06 21:37:54', NULL),
(3, 'YGN 2', 1, '2020-09-06 21:38:17', '2020-09-06 21:38:17', NULL),
(4, 'YGN 3', 1, '2020-09-06 21:38:28', '2020-09-06 21:38:28', NULL),
(5, 'YGN 4', 1, '2020-09-06 21:38:38', '2020-09-06 21:38:38', NULL),
(6, 'Area 1 (Mandalay/Monywa)', 2, '2020-09-06 21:39:04', '2020-09-06 22:08:03', NULL),
(7, 'Area 2  (Mandalay/Monywa)', 2, '2020-09-06 21:39:16', '2020-09-06 22:08:19', NULL),
(8, 'Area 3  (Mandalay/Monywa)', 2, '2020-09-06 21:39:29', '2020-09-06 22:08:37', NULL),
(9, 'Area 1 (Ayeyarwaddy)', 3, '2020-09-06 21:39:49', '2020-09-06 22:08:58', NULL),
(10, 'Area 2  (Ayeyarwaddy)', 3, '2020-09-06 21:39:59', '2020-09-06 22:09:11', NULL),
(11, 'Area 1 (Bago-E)', 4, '2020-09-06 21:40:21', '2020-09-06 22:09:37', NULL),
(12, 'Area 2 (Bago-E)', 4, '2020-09-06 21:40:32', '2020-09-06 22:09:52', NULL),
(13, 'Area 1 (Bago-W)', 5, '2020-09-06 21:40:54', '2020-09-06 22:10:07', NULL),
(14, 'Area 1 (Mon-kayin)', 6, '2020-09-06 21:41:15', '2020-09-06 22:10:27', NULL),
(15, 'Area 1 (Shan)', 7, '2020-09-06 21:41:36', '2020-09-06 22:10:41', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consigemts_has_extra_user`
--
ALTER TABLE `consigemts_has_extra_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consigemts_has_extra_user_consigment_id_foreign` (`consigment_id`),
  ADD KEY `consigemts_has_extra_user_extra_user_id_foreign` (`extra_user_id`);

--
-- Indexes for table `consigments`
--
ALTER TABLE `consigments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consigments_user_id_foreign` (`user_id`);

--
-- Indexes for table `credit_returns`
--
ALTER TABLE `credit_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_returns_customer_order_id_foreign` (`customer_order_id`),
  ADD KEY `credit_returns_return_reason_id_foreign` (`return_reason_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`),
  ADD KEY `customers_customer_type_id_foreign` (`customer_type_id`),
  ADD KEY `customers_outlet_type_id_foreign` (`outlet_type_id`);

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_orders_has_order_requests`
--
ALTER TABLE `customer_orders_has_order_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_orders_has_order_requests_customer_order_id_foreign` (`customer_order_id`),
  ADD KEY `customer_orders_has_order_requests_order_request_id_foreign` (`order_request_id`);

--
-- Indexes for table `customer_types`
--
ALTER TABLE `customer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emergency_contact_team_member_id_foreign` (`team_member_id`);

--
-- Indexes for table `extra_users`
--
ALTER TABLE `extra_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_customer_orders`
--
ALTER TABLE `member_customer_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_customer_orders_customer_id_foreign` (`customer_id`),
  ADD KEY `member_customer_orders_customer_order_id_foreign` (`customer_order_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_requests`
--
ALTER TABLE `order_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outlet_types`
--
ALTER TABLE `outlet_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_orders_has_order_requests`
--
ALTER TABLE `customer_orders_has_order_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `customer_types`
--
ALTER TABLE `customer_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `extra_users`
--
ALTER TABLE `extra_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_customer_orders`
--
ALTER TABLE `member_customer_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_requests`
--
ALTER TABLE `order_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `outlet_types`
--
ALTER TABLE `outlet_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `townships`
--
ALTER TABLE `townships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
