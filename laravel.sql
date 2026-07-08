-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Jul 08, 2026 at 02:59 AM
-- Server version: 8.0.46
-- PHP Version: 8.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `address`, `created_at`, `updated_at`) VALUES
(32, 28, '45 Tran Duy Hung, Quan Cau Giay, Ha Noi', '2026-06-28 01:25:13', '2026-06-28 01:25:13'),
(33, 29, '88 Nguyen Van Linh, Quan Thanh Khe, Da Nang', '2026-06-28 01:25:13', '2026-06-28 01:25:13'),
(34, 30, '72 Nguyen Thi Minh Khai, Quan 1, TP Ho Chi Minh', '2026-06-28 01:25:13', '2026-06-28 01:25:13'),
(35, 31, '50 Mau Than, Quan Ninh Kieu, Can Tho', '2026-06-28 01:25:13', '2026-06-28 01:25:13'),
(36, 32, '102 To Hieu, Quan Le Chan, Hai Phong', '2026-06-28 01:25:13', '2026-06-28 01:25:13'),
(37, 33, '64 Le Loi, TP Hue, Thua Thien Hue', '2026-06-28 01:25:13', '2026-06-28 01:25:13'),
(38, 34, '99 Nguyen Thien Thuat, TP Nha Trang, Khanh Hoa', '2026-06-28 01:25:13', '2026-06-28 01:25:13'),
(39, 35, '120 Le Hong Phong, TP Vung Tau, Ba Ria Vung Tau', '2026-06-28 01:25:13', '2026-06-28 01:25:13'),
(40, 36, '56 Phu Loi, TP Thu Dau Mot, Binh Duong', '2026-06-28 01:25:13', '2026-06-28 01:25:13'),
(41, 37, '28 Vo Thi Sau, TP Bien Hoa, Dong Nai', '2026-06-28 01:25:13', '2026-06-28 01:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` decimal(15,0) NOT NULL DEFAULT '0',
  `product_quantity` int NOT NULL DEFAULT '1',
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `product_id`, `product_name`, `product_price`, `product_quantity`, `product_image`, `created_at`, `updated_at`) VALUES
(379, 27, 42, 'Nokia C32 4GB/128GB', 2790000, 1, 'nokia_can_nhac_tim_kiem_doi_tac.png', '2026-06-26 05:04:41', '2026-06-26 05:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Iphone', '1782607050_2023_9_16_638304536466753948_iphone-15-plus-den-1.jpg', 1, NULL, NULL),
(4, 'Sam sung', '1782607289_s24-ultra-den-removebg-preview-2.png', 1, NULL, NULL),
(17, 'Tai nghe', '1782607371_Tai-nghe-Airpods-Pro-3.png', 1, NULL, NULL),
(19, 'Sạc & cáp', '1782607382_cap-type-c-to-lightning-cuktech-1m-al870_2_.webp', 1, NULL, NULL),
(22, 'Oppo', '1782607447_oppo1.jpg', 1, NULL, NULL),
(23, 'Vertu', '1782607633_vertu1.jpg', 1, NULL, NULL),
(24, 'Phụ kiện', '1782607748_1854426483.jpeg', 1, NULL, NULL),
(25, 'Danh mục mới', '1782920900_airpods-4-2.jpg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `content`, `date`, `status`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(27, 'Oki lun', '2026-05-06 09:12:00', 1, 8, 32, NULL, NULL),
(37, 'tốt', '2026-06-26 09:16:27', 1, 26, 41, '2026-06-26 09:16:27', '2026-06-26 09:16:27'),
(38, 'San pham dung mo ta, dong goi can than.', '2026-06-07 23:27:23', 1, 28, 36, '2026-06-07 23:27:23', '2026-06-07 23:27:23'),
(39, 'May chay muot, pin on, minh kha hai long.', '2026-06-12 09:58:36', 1, 28, 29, '2026-06-12 09:58:36', '2026-06-12 09:58:36'),
(40, 'Gia hop ly so voi cau hinh, se ung ho tiep.', '2026-06-10 02:54:20', 1, 29, 39, '2026-06-10 02:54:20', '2026-06-10 02:54:20'),
(41, 'Man hinh dep, cam ung nhay va mau sac ro.', '2026-06-25 01:10:32', 1, 29, 36, '2026-06-25 01:10:32', '2026-06-25 01:10:32'),
(42, 'Shop tu van nhiet tinh, giao hang nhanh.', '2026-06-09 06:14:50', 1, 30, 36, '2026-06-09 06:14:50', '2026-06-09 06:14:50'),
(43, 'San pham con moi, phu kien day du.', '2026-06-03 01:26:52', 1, 30, 41, '2026-06-03 01:26:52', '2026-06-03 01:26:52'),
(44, 'Hieu nang tot, dung hang ngay rat on dinh.', '2026-06-04 07:00:45', 1, 31, 35, '2026-06-04 07:00:45', '2026-06-04 07:00:45'),
(45, 'Thiet ke dep, cam nam chac tay.', '2026-06-19 03:43:50', 1, 31, 41, '2026-06-19 03:43:50', '2026-06-19 03:43:50'),
(46, 'Camera chup anh ro, dung tot trong tam gia.', '2026-06-03 17:29:57', 1, 32, 41, '2026-06-03 17:29:57', '2026-06-03 17:29:57'),
(47, 'Da mua va trai nghiem vai ngay, rat dang tien.', '2026-06-13 15:06:11', 1, 32, 40, '2026-06-13 15:06:11', '2026-06-13 15:06:11'),
(48, 'May phu hop nhu cau hoc tap va lam viec.', '2026-06-06 21:29:20', 1, 33, 30, '2026-06-06 21:29:20', '2026-06-06 21:29:20'),
(49, 'Dong goi ky, nhan hang khong bi tray xuoc.', '2026-06-15 21:45:19', 1, 33, 38, '2026-06-15 21:45:19', '2026-06-15 21:45:19'),
(50, 'Chat luong tot hon mong doi.', '2026-06-17 16:09:24', 1, 34, 38, '2026-06-17 16:09:24', '2026-06-17 16:09:24'),
(51, 'Pin su dung du lau, sac cung kha nhanh.', '2026-06-23 23:44:42', 1, 34, 30, '2026-06-23 23:44:42', '2026-06-23 23:44:42'),
(52, 'San pham dep, shop ho tro rat nhanh.', '2026-06-08 02:49:51', 1, 35, 40, '2026-06-08 02:49:51', '2026-06-08 02:49:51'),
(53, 'Mua lam qua tang, nguoi nhan rat thich.', '2026-06-11 18:25:45', 1, 35, 32, '2026-06-11 18:25:45', '2026-06-11 18:25:45'),
(54, 'Hang dung nhu thong tin tren website.', '2026-06-25 01:13:11', 1, 36, 35, '2026-06-25 01:13:11', '2026-06-25 01:13:11'),
(55, 'Gia tot, tinh nang day du, dang can nhac mua them.', '2026-06-15 14:54:38', 1, 36, 36, '2026-06-15 14:54:38', '2026-06-15 14:54:38'),
(56, 'Trai nghiem on dinh, khong gap loi khi su dung.', '2026-06-20 08:37:52', 1, 37, 1, '2026-06-20 08:37:52', '2026-06-20 08:37:52'),
(58, 'sp pham', '2026-06-28 06:47:11', 1, 38, 43, '2026-06-28 06:47:11', '2026-06-28 06:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '0003_01_01_000000_create_categories_table', 2),
(5, '0003_01_01_000001_create_products_table', 2),
(6, '0003_01_01_000002_create_carts_table', 2),
(7, '0003_01_01_000003_create_orders_table', 2),
(8, '0003_01_01_000004_create_orderdetails_table', 2),
(9, '0003_01_01_000005_create_address_table', 2),
(10, '0003_01_01_000006_create_post_categories_table', 3),
(11, '0003_01_01_000007_create_posts_table', 3),
(12, '0003_01_01_000008_create_comments_table', 3),
(13, '0003_01_01_000009_add_legacy_columns_to_existing_tables', 3),
(14, '0003_01_01_000010_add_legacy_columns_to_users_table', 4),
(15, '0003_01_01_000011_fix_legacy_user_foreign_keys', 5),
(16, '0003_01_01_000012_create_warehouse_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(15,0) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(215, 104, 31, 1, 1100000, '2026-06-25 10:16:29', '2026-06-25 10:16:29'),
(217, 106, 31, 2, 1100000, '2026-06-25 13:38:54', '2026-06-25 13:38:54'),
(218, 107, 30, 1, 500000, '2026-06-25 13:42:38', '2026-06-25 13:42:38'),
(221, 110, 31, 2, 1100000, '2026-06-25 19:27:54', '2026-06-25 19:27:54'),
(222, 111, 40, 1, 18990000, '2026-06-26 04:36:02', '2026-06-26 04:36:02'),
(223, 112, 42, 1, 2790000, '2026-06-26 04:36:33', '2026-06-26 04:36:33'),
(224, 113, 42, 2, 2790000, '2026-06-26 05:12:40', '2026-06-26 05:12:40'),
(225, 114, 41, 1, 40990000, '2026-06-27 13:07:40', '2026-06-27 13:07:40'),
(226, 115, 39, 2, 199999999, '2026-06-12 15:54:57', '2026-06-12 15:54:57'),
(227, 116, 38, 2, 3990000, '2026-06-22 02:33:00', '2026-06-22 02:33:00'),
(228, 117, 6, 2, 70000, '2026-06-03 21:26:56', '2026-06-03 21:26:56'),
(229, 117, 43, 2, 20453000, '2026-06-03 21:26:56', '2026-06-03 21:26:56'),
(230, 118, 32, 1, 400000, '2026-06-24 14:54:10', '2026-06-24 14:54:10'),
(231, 118, 36, 1, 9490000, '2026-06-24 14:54:10', '2026-06-24 14:54:10'),
(232, 119, 29, 2, 90000, '2026-06-24 08:26:28', '2026-06-24 08:26:28'),
(233, 120, 43, 1, 20453000, '2026-06-11 23:41:26', '2026-06-11 23:41:26'),
(234, 120, 39, 1, 199999999, '2026-06-11 23:41:26', '2026-06-11 23:41:26'),
(235, 121, 40, 1, 18990000, '2026-06-04 23:52:44', '2026-06-04 23:52:44'),
(236, 121, 38, 1, 3990000, '2026-06-04 23:52:44', '2026-06-04 23:52:44'),
(237, 121, 41, 1, 40990000, '2026-06-04 23:52:44', '2026-06-04 23:52:44'),
(238, 122, 30, 2, 500000, '2026-06-03 00:02:38', '2026-06-03 00:02:38'),
(239, 123, 43, 1, 20453000, '2026-06-23 04:20:20', '2026-06-23 04:20:20'),
(240, 123, 39, 2, 199999999, '2026-06-23 04:20:20', '2026-06-23 04:20:20'),
(241, 124, 32, 2, 400000, '2026-06-23 22:23:11', '2026-06-23 22:23:11'),
(242, 125, 43, 2, 20453000, '2026-06-11 14:33:11', '2026-06-11 14:33:11'),
(243, 126, 35, 1, 29990000, '2026-06-10 10:11:10', '2026-06-10 10:11:10'),
(244, 126, 32, 1, 400000, '2026-06-10 10:11:10', '2026-06-10 10:11:10'),
(245, 126, 29, 1, 90000, '2026-06-10 10:11:10', '2026-06-10 10:11:10'),
(246, 127, 36, 1, 9490000, '2026-06-17 22:47:10', '2026-06-17 22:47:10'),
(247, 127, 29, 1, 90000, '2026-06-17 22:47:10', '2026-06-17 22:47:10'),
(248, 127, 38, 2, 3990000, '2026-06-17 22:47:10', '2026-06-17 22:47:10'),
(249, 128, 41, 1, 40990000, '2026-06-12 19:52:19', '2026-06-12 19:52:19'),
(250, 129, 40, 2, 18990000, '2026-06-24 17:01:48', '2026-06-24 17:01:48'),
(251, 129, 29, 1, 90000, '2026-06-24 17:01:48', '2026-06-24 17:01:48'),
(252, 130, 43, 1, 20453000, '2026-06-25 20:11:22', '2026-06-25 20:11:22'),
(253, 130, 37, 2, 8990000, '2026-06-25 20:11:22', '2026-06-25 20:11:22'),
(254, 130, 1, 2, 90000, '2026-06-25 20:11:22', '2026-06-25 20:11:22'),
(255, 131, 33, 2, 34990000, '2026-06-23 19:42:08', '2026-06-23 19:42:08'),
(256, 131, 41, 2, 40990000, '2026-06-23 19:42:08', '2026-06-23 19:42:08'),
(257, 132, 31, 1, 1100000, '2026-06-20 09:05:16', '2026-06-20 09:05:16'),
(258, 132, 1, 1, 90000, '2026-06-20 09:05:16', '2026-06-20 09:05:16'),
(259, 132, 30, 2, 500000, '2026-06-20 09:05:16', '2026-06-20 09:05:16'),
(260, 133, 29, 1, 90000, '2026-06-12 11:49:51', '2026-06-12 11:49:51'),
(261, 133, 30, 2, 500000, '2026-06-12 11:49:51', '2026-06-12 11:49:51'),
(262, 133, 34, 2, 22990000, '2026-06-12 11:49:51', '2026-06-12 11:49:51'),
(263, 134, 1, 2, 90000, '2026-06-06 07:44:39', '2026-06-06 07:44:39'),
(264, 134, 40, 2, 18990000, '2026-06-06 07:44:39', '2026-06-06 07:44:39'),
(265, 134, 32, 1, 400000, '2026-06-06 07:44:39', '2026-06-06 07:44:39'),
(266, 135, 43, 2, 20453000, '2026-06-28 01:33:02', '2026-06-28 01:33:02'),
(267, 136, 43, 1, 20453000, '2026-06-28 02:43:11', '2026-06-28 02:43:11'),
(268, 137, 43, 1, 20453000, '2026-06-28 06:45:14', '2026-06-28 06:45:14'),
(269, 138, 43, 1, 20453000, '2026-07-01 16:09:44', '2026-07-01 16:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total` decimal(15,0) NOT NULL DEFAULT '0',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '0',
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total`, `address`, `phone`, `note`, `status`, `date`, `created_at`, `updated_at`) VALUES
(41, 8, 800000, 'Anh Khánh, Ninh Kiều, Cần Thơ', '0336246546', 'Gói hàng kĩ', 4, '2026-05-19 09:55:33', NULL, '2026-06-28 00:53:48'),
(104, 26, 1100000, 'Hà Nôi', '0985555555', NULL, 4, '2026-06-18 23:06:40', '2026-06-25 10:16:29', '2026-06-28 00:53:56'),
(106, 26, 2200000, 'Hà Nôi', '0985555555', NULL, 4, '2026-06-19 14:04:26', '2026-06-25 13:38:54', '2026-06-28 00:54:04'),
(107, 26, 500000, 'Hà Nôi', '0985555555', NULL, 0, '2026-06-20 05:02:13', '2026-06-25 13:42:38', '2026-06-25 13:56:43'),
(110, 27, 2200000, 'Hà Nôi', '0900002004', NULL, 4, '2026-06-20 20:00:00', '2026-06-25 19:27:54', '2026-06-28 00:53:36'),
(111, 27, 18990000, 'Hà Nôi', '0900002004', NULL, 4, '2026-06-26 04:36:02', '2026-06-26 04:36:02', '2026-06-28 00:53:28'),
(112, 26, 2790000, 'Hà Nôi', '0985555555', NULL, 0, '2026-06-26 04:36:33', '2026-06-26 04:36:33', '2026-06-26 04:36:47'),
(113, 26, 5580000, 'Hà Nôi', '0985555555', NULL, 4, '2026-06-26 05:12:40', '2026-06-26 05:12:40', '2026-06-28 00:53:18'),
(114, 26, 40990000, 'Hà Nôi', '0985555555', NULL, 4, '2026-06-27 13:07:40', '2026-06-27 13:07:40', '2026-06-28 00:52:41'),
(115, 28, 399999998, 'Ha Noi', '0901000001', 'Seed order for user2026 accounts', 1, '2026-06-12 15:54:57', '2026-06-12 15:54:57', '2026-06-12 15:54:57'),
(116, 29, 7980000, 'Da Nang', '0901000002', 'Seed order for user2026 accounts', 1, '2026-06-22 02:33:00', '2026-06-22 02:33:00', '2026-06-22 02:33:00'),
(117, 30, 41046000, 'TP Ho Chi Minh', '0901000003', 'Seed order for user2026 accounts', 1, '2026-06-03 21:26:56', '2026-06-03 21:26:56', '2026-06-03 21:26:56'),
(118, 31, 9890000, 'Can Tho', '0901000004', 'Seed order for user2026 accounts', 1, '2026-06-24 14:54:10', '2026-06-24 14:54:10', '2026-06-24 14:54:10'),
(119, 32, 180000, 'Hai Phong', '0901000005', 'Seed order for user2026 accounts', 1, '2026-06-24 08:26:28', '2026-06-24 08:26:28', '2026-06-24 08:26:28'),
(120, 33, 220452999, 'Hue', '0901000006', 'Seed order for user2026 accounts', 3, '2026-06-11 23:41:26', '2026-06-11 23:41:26', '2026-06-11 23:41:26'),
(121, 34, 63970000, 'Nha Trang', '0901000007', 'Seed order for user2026 accounts', 3, '2026-06-04 23:52:44', '2026-06-04 23:52:44', '2026-06-04 23:52:44'),
(122, 35, 1000000, 'Vung Tau', '0901000008', 'Seed order for user2026 accounts', 3, '2026-06-03 00:02:38', '2026-06-03 00:02:38', '2026-06-03 00:02:38'),
(123, 36, 420452998, 'Binh Duong', '0901000009', 'Seed order for user2026 accounts', 3, '2026-06-23 04:20:20', '2026-06-23 04:20:20', '2026-06-23 04:20:20'),
(124, 37, 800000, 'Dong Nai', '0901000010', 'Seed order for user2026 accounts', 3, '2026-06-23 22:23:11', '2026-06-23 22:23:11', '2026-06-23 22:23:11'),
(125, 28, 40906000, 'Ha Noi', '0901000001', 'Seed order for user2026 accounts', 4, '2026-06-11 14:33:11', '2026-06-11 14:33:11', '2026-06-11 14:33:11'),
(126, 29, 30480000, 'Da Nang', '0901000002', 'Seed order for user2026 accounts', 4, '2026-06-10 10:11:10', '2026-06-10 10:11:10', '2026-06-10 10:11:10'),
(127, 30, 17560000, 'TP Ho Chi Minh', '0901000003', 'Seed order for user2026 accounts', 4, '2026-06-17 22:47:10', '2026-06-17 22:47:10', '2026-06-17 22:47:10'),
(128, 31, 40990000, 'Can Tho', '0901000004', 'Seed order for user2026 accounts', 4, '2026-06-12 19:52:19', '2026-06-12 19:52:19', '2026-06-12 19:52:19'),
(129, 32, 38070000, 'Hai Phong', '0901000005', 'Seed order for user2026 accounts', 4, '2026-06-24 17:01:48', '2026-06-24 17:01:48', '2026-06-24 17:01:48'),
(130, 33, 38613000, 'Hue', '0901000006', 'Seed order for user2026 accounts', 0, '2026-06-25 20:11:22', '2026-06-25 20:11:22', '2026-06-25 20:11:22'),
(131, 34, 151960000, 'Nha Trang', '0901000007', 'Seed order for user2026 accounts', 0, '2026-06-23 19:42:08', '2026-06-23 19:42:08', '2026-06-23 19:42:08'),
(132, 35, 2190000, 'Vung Tau', '0901000008', 'Seed order for user2026 accounts', 0, '2026-06-20 09:05:16', '2026-06-20 09:05:16', '2026-06-20 09:05:16'),
(133, 36, 47070000, 'Binh Duong', '0901000009', 'Seed order for user2026 accounts', 0, '2026-06-12 11:49:51', '2026-06-12 11:49:51', '2026-06-12 11:49:51'),
(134, 37, 38560000, 'Dong Nai', '0901000010', 'Seed order for user2026 accounts', 0, '2026-06-06 07:44:39', '2026-06-06 07:44:39', '2026-06-06 07:44:39'),
(135, 26, 40906000, 'Hà Nôi', '0985555555', NULL, 1, '2026-06-28 01:33:02', '2026-06-28 01:33:02', '2026-06-28 01:33:02'),
(136, 38, 20453000, 'Đại học Công nghệ Đông Á', '0876453421', NULL, 4, '2026-06-28 02:43:11', '2026-06-28 02:43:11', '2026-06-28 02:44:26'),
(137, 38, 20453000, 'Đại học Công nghệ Đông Á', '0876453421', NULL, 2, '2026-06-28 06:45:14', '2026-06-28 06:45:14', '2026-07-01 15:42:27'),
(138, 38, 20453000, 'Đại học Công nghệ Đông Á', '0876453421', NULL, 1, '2026-07-01 16:09:44', '2026-07-01 16:09:44', '2026-07-01 16:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admin',
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `views` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `category_id`, `title`, `image`, `author`, `content`, `views`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Microsoft ra mắt nhân vật ảo Copilot với khả năng tương tác thời gian thực', 'microsoft_ra_mat_nhan_vat_ao_cop.png', 'Admin', '<p>Không còn là một giao diện văn bản khô khan hay hình ảnh 2D đơn điệu, Copilot Appearance được phát triển để có khả năng phản hồi cảm xúc theo thời gian thực, từ đó tạo nên một trải nghiệm giao tiếp gần gũi như giữa con người với nhau.</p><h2><strong>Tính năng thể hiện cảm xúc nâng cao trải nghiệm người dùng</strong></h2><p>Một trong những điểm nổi bật của Copilot Appearance chính là khả năng thể hiện nhiều biểu cảm như cười, gật đầu, ngạc nhiên hoặc phản ứng linh hoạt tùy theo nội dung cuộc trò chuyện. Đây là yếu tố giúp người dùng cảm thấy thoải mái và dễ dàng hơn khi tương tác với trợ lý ảo, vì họ không còn trò chuyện với một phần mềm lạnh lùng mà là một “người bạn đồng hành” có cảm xúc.</p><p>Theo Mustafa Suleyman, CEO AI của Microsoft, Copilot sẽ được xây dựng với một “danh tính vĩnh viễn” và sẽ “già đi” theo thời gian, tạo nên sự gắn bó lâu dài và một cảm giác phát triển cùng người dùng trong hành trình sử dụng công nghệ.</p><p><img src=\"https://cdn2.fptshop.com.vn/unsafe/microsoft_ra_mat_nhan_vat_ao_copilot_voi_kha_nang_tuong_tac_thoi_gian_thuc_1_e8c69278a4.jpg\" alt=\"Microsoft ra mắt nhân vật ảo Copilot với khả năng tương tác thời gian thực\" width=\"750\" height=\"500\"></p><p><i>Giao diện Copilot sẽ biết mỉm cười, gật đầu và thể hiện sự ngạc nhiên. Ảnh: Microsoft</i></p><p>Không chỉ dừng lại ở việc thêm biểu cảm, Microsoft đang hướng tới một mô hình AI mang tính cá nhân hóa sâu rộng hơn. Suleyman nhấn mạnh ý tưởng về một “digital patina”, một lớp tuổi tác kỹ thuật số được hình thành theo thời gian, nhằm khiến Copilot không chỉ trở nên thông minh hơn mà còn đáng tin cậy và thân quen hơn trong mắt người dùng.</p><p>Việc xây dựng mối liên kết cảm xúc giữa người và máy đang trở thành chiến lược trung tâm trong hành trình phát triển các trợ lý AI của Microsoft, khi họ muốn AI không chỉ là công cụ mà còn là một thực thể đồng hành.</p><p>Hiện tại, Copilot Appearance mới chỉ được cung cấp cho một nhóm người dùng thử nghiệm tại Mỹ, Anh và Canada. Microsoft cho biết họ đang thu thập phản hồi để tinh chỉnh tính năng này trước khi mở rộng ra toàn cầu trong thời gian tới. Cùng với đó, công ty cũng tiết lộ rằng giao diện làm việc trên Windows sẽ được cải tiến theo hướng tối giản hơn, nhằm giảm thiểu sự phân tâm và tối ưu hóa trải nghiệm người dùng. Những thay đổi này hứa hẹn sẽ khiến môi trường sử dụng AI trở nên hiệu quả và thân thiện hơn.</p><p>&nbsp;<img src=\"https://platform.theverge.com/wp-content/uploads/sites/2/2025/07/copilot-appearance-video.gif?quality=90&amp;strip=all&amp;crop=0%2C0%2C100%2C100&amp;w=2400\" alt=\"Microsoft ra mắt nhân vật ảo Copilot với khả năng tương tác thời gian thực - hình 1\" width=\"800\" height=\"450\"></p><p><i>Tính năng Giao diện Copilot hiện đã được kích hoạt cho một số người dùng. Ảnh: Microsoft</i></p><p>Việc ra mắt Copilot Appearance là một bước tiến đáng chú ý trong nỗ lực định hình lại mối quan hệ giữa người dùng và trí tuệ nhân tạo. Microsoft không còn chỉ tập trung vào khả năng xử lý ngôn ngữ hay tốc độ phản hồi, mà đang đầu tư mạnh mẽ vào yếu tố cảm xúc và cá nhân hóa, nhằm biến Copilot thành một người bạn đồng hành thực sự trong thế giới số.</p><p>Với định hướng này, người dùng có thể kỳ vọng vào một thế hệ trợ lý ảo không chỉ hữu ích mà còn đáng mến, từ đó tạo nên một cách tiếp cận hoàn toàn mới trong tương tác giữa con người và công nghệ.</p>', 3, 1, '2026-05-01 08:00:00', '2026-06-28 03:07:04'),
(5, 2, 'Màn hình Galaxy Z Fold7 có độ bền lên tới 500.000 lần gập, cao hơn 150% so với thế hệ cũ', 'man_hinh_galaxy_z_fold7_co_do_be.png', 'Admin', '<p>Đây được xem là cột mốc đáng chú ý, đưa dòng Galaxy Z Fold tiến gần hơn đến chuẩn mực độ bền lâu dài, đáp ứng tốt nhu cầu của cả người dùng phổ thông lẫn người dùng cường độ cao.</p><h2><strong>Chuẩn độ bền mới gấp 2.5 lần thế hệ trước</strong></h2><p>Trong các thế hệ trước, Samsung từng công bố mức độ bền của màn hình gập ở ngưỡng 200.000 lần, tương đương khoảng 5 năm sử dụng nếu gập mở 100 lần mỗi ngày. Tuy nhiên, mức này vẫn bị đánh giá là kém cạnh tranh so với những đối thủ như OnePlus Open, thiết bị được ra mắt năm 2023 với độ bền lên tới 1.000.000 lần gập. Thực tế từ các thử nghiệm cũng cho thấy Galaxy Z Fold 5 từng vượt qua 400.000 lần gập mà vẫn hoạt động bình thường, cho thấy con số 200.000 trước đây chỉ là một mức tiêu chuẩn an toàn hơn là giới hạn thực tế.</p><p><img src=\"https://cdn2.fptshop.com.vn/unsafe/man_hinh_galaxy_z_fold7_co_do_ben_len_toi_500000_lan_gap_cao_hon_150percent_so_voi_the_he_cu_13a14a9ac5.jpg\" alt=\"Màn hình Galaxy Z Fold7 có độ bền lên tới 500.000 lần gập, cao hơn 150% so với thế hệ cũ\" width=\"750\" height=\"500\"></p><p>Với Galaxy Z Fold 7, Samsung đã nâng chuẩn chính thức lên 500.000 lần gập, tức cao gấp 2.5 lần so với thế hệ trước và tăng 150% so với ngưỡng công bố ban đầu. Đây là một sự cải thiện đáng kể, đặc biệt trong bối cảnh độ bền luôn là một yếu tố then chốt khiến người dùng cân nhắc khi lựa chọn điện thoại gập.</p><p>Con số 500.000 không chỉ là tuyên bố đơn phương từ Samsung mà đã được xác nhận bởi tổ chức kiểm định quốc tế Bureau Veritas. Thử nghiệm được thực hiện trong điều kiện phòng với nhiệt độ tiêu chuẩn 25 độ C, kéo dài liên tục trong vòng 13 ngày. Kết quả cho thấy màn hình Galaxy Z Fold 7 vẫn hoạt động bình thường sau khi trải qua 500.000 lần gập.</p><p><img src=\"https://cdn2.fptshop.com.vn/unsafe/man_hinh_galaxy_z_fold7_co_do_ben_len_toi_500000_lan_gap_cao_hon_150percent_so_voi_the_he_cu_1_e827cb6075.jpg\" alt=\"Màn hình Galaxy Z Fold7 có độ bền lên tới 500.000 lần gập, cao hơn 150% so với thế hệ cũ - hình 1\" width=\"750\" height=\"500\"></p><p>Theo Samsung, điều này tương đương hơn 10 năm sử dụng với người dùng thông thường, tức khoảng 100 lần gập mỗi ngày. Ngay cả với những người sử dụng với cường độ cao khoảng 200 lần mỗi ngày, thiết bị vẫn có thể duy trì hiệu năng trong hơn 6 năm.</p><p>Tuy nhiên, hãng cũng lưu ý rằng con số 500.000 chỉ phản ánh độ bền của phần màn hình, chưa bao gồm các thành phần khác như bản lề, vốn cũng đóng vai trò quan trọng trong tổng thể độ bền của thiết bị.</p><p><img src=\"https://cdn2.fptshop.com.vn/unsafe/man_hinh_galaxy_z_fold7_co_do_ben_len_toi_500000_lan_gap_cao_hon_150percent_so_voi_the_he_cu_2_a677e3dd45.jpg\" alt=\"Màn hình Galaxy Z Fold7 có độ bền lên tới 500.000 lần gập, cao hơn 150% so với thế hệ cũ - hình 2\" width=\"750\" height=\"500\"></p><p>Samsung cho biết chuẩn độ bền vượt trội lần này đến từ một loạt cải tiến đáng chú ý trong thiết kế màn hình. Đầu tiên là việc tăng độ dày của lớp kính siêu mỏng Ultra Thin Glass lên 50%, mang lại khả năng chống chịu tốt hơn trước các lực gập liên tục. Bên cạnh đó, một loại keo đàn hồi mới được phủ trong từng lớp OLED giúp tăng khả năng phục hồi gấp 4 lần so với thế hệ trước. Nhờ vậy, màn hình có thể hấp thụ va chạm tốt hơn, giảm thiểu nguy cơ nứt vỡ hay lỗi cảm ứng sau thời gian dài sử dụng.</p><p>Những cải tiến này không chỉ mang lại độ bền vật lý cao hơn mà còn góp phần đảm bảo trải nghiệm cảm ứng mượt mà và ổn định suốt vòng đời của thiết bị.</p><p>Không chỉ nâng cao độ bền phần cứng, Galaxy Z Fold 7 còn được hỗ trợ cập nhật phần mềm lên đến 7 năm, một cam kết hiếm thấy trong ngành công nghệ di động. Kết hợp với màn hình chịu được 500.000 lần gập, thiết bị mới của Samsung đang hướng đến mục tiêu trở thành chiếc điện thoại gập bền bỉ nhất mà hãng từng sản xuất.</p>', 0, 1, '2026-05-11 10:24:00', '2026-05-11 12:24:00'),
(8, 9, 'WhatsApp ngừng phát triển ứng dụng Windows để chuyển sang phiên bản web', 'whatsapp_chinh_thuc_ngung_phat_t.png', 'Admin', '<p>Thông tin này nhanh chóng gây ra làn sóng phản ứng tiêu cực từ những người dùng vốn đã quen thuộc với trải nghiệm mượt mà của ứng dụng gốc.</p><h2><strong>Những thay đổi lớn được tiết lộ trong bản beta mới nhất</strong></h2><p>Trong bản cập nhật beta mới nhất, WhatsApp trên Windows đã có sự thay đổi đáng kể cả về giao diện lẫn cách thức hoạt động. Thay cho ứng dụng gốc được thiết kế riêng cho hệ điều hành Windows, người dùng giờ đây sẽ tiếp cận với một phiên bản web được đóng gói lại dưới dạng ứng dụng desktop.</p><p>Sự thay đổi này không chỉ khiến giao diện trông khác đi mà còn tác động đến cơ chế thông báo cũng như cách cài đặt trong ứng dụng. Giao diện mới trở nên đơn giản hơn, ít tùy chọn hơn và mang cảm giác như đang sử dụng một trình duyệt thu nhỏ hơn là một ứng dụng tích hợp sâu với hệ điều hành.</p><p>Phiên bản beta lần này vẫn mang đến một số cải tiến như việc tích hợp WhatsApp Channels và mở rộng thêm nhiều chức năng cho các tính năng Status và Communities. Tuy nhiên, đối với phần đông người dùng, những thay đổi này không đủ để bù đắp cho cảm giác hụt hẫng khi ứng dụng không còn mang lại trải nghiệm liền mạch như một phần tự nhiên của Windows 11. Việc thiếu đi các đặc điểm đặc trưng của ứng dụng gốc khiến trải nghiệm sử dụng trở nên thiếu đồng nhất và không còn mang lại sự tiện lợi như trước.</p><p><img src=\"https://cdn2.fptshop.com.vn/unsafe/whatsapp_chinh_thuc_ngung_phat_trien_ung_dung_windows_goc_khien_nguoi_dung_that_vong_1_86cb8c06f1.jpg\" alt=\"WhatsApp ngừng phát triển ứng dụng Windows để chuyển sang phiên bản web\" width=\"750\" height=\"500\"></p><p><i>Phiên bản gốc của WhatsApp</i></p><p><img src=\"https://cdn2.fptshop.com.vn/unsafe/whatsapp_chinh_thuc_ngung_phat_trien_ung_dung_windows_goc_khien_nguoi_dung_that_vong_2_3c8f66f6b3.jpg\" alt=\"WhatsApp ngừng phát triển ứng dụng Windows để chuyển sang phiên bản web - hình 1\" width=\"750\" height=\"500\"></p><p><i>Ứng dụng WhatsAppmới dạng web wrapper</i></p><p>Meta đã lựa chọn công nghệ Edge WebView2 của Microsoft để hiện thực hóa phiên bản mới của WhatsApp trên Windows. Đây là công nghệ cho phép các nhà phát triển dễ dàng đóng gói một trang web thành ứng dụng desktop mà không cần xây dựng một ứng dụng hoàn toàn riêng biệt.</p><p>Theo phân tích từ trang Windows Latest, động thái này giúp Meta chỉ cần duy trì một mã nguồn duy nhất cho WhatsApp, thay vì phải phát triển song song hai phiên bản cho nền tảng web và ứng dụng Windows gốc. Điều này giúp tiết kiệm chi phí và nguồn lực cho công ty nhưng lại đặt ra nhiều lo ngại về chất lượng trải nghiệm của người dùng cuối.</p><p>Không ít người dùng đã bày tỏ sự thất vọng trước quyết định của Meta. Trước đây, ứng dụng WhatsApp gốc trên Windows cho phép người dùng hoạt động độc lập mà không cần điện thoại kết nối liên tục, mang lại sự tiện lợi và cảm giác ổn định hơn so với các giải pháp dựa trên web. Khi chuyển sang phiên bản mới, nhiều người lo ngại rằng hiệu suất và độ tin cậy sẽ bị ảnh hưởng, nhất là trong các tình huống cần làm việc lâu dài trên máy tính mà không muốn phụ thuộc vào điện thoại. Chính điều này khiến nhiều người cảm thấy đây là một bước lùi thay vì là một cải tiến như kỳ vọng.</p><p>Việc chuyển từ ứng dụng Windows gốc sang phiên bản web là một quyết định mang tính kỹ thuật nhưng lại có tác động sâu rộng đến trải nghiệm người dùng. Dù Meta đã bổ sung một số tính năng mới, nhưng sự thay đổi này vẫn chưa thể đáp ứng kỳ vọng của nhóm người dùng trung thành với ứng dụng gốc.</p><p>Trong thời gian tới, giới công nghệ sẽ tiếp tục theo dõi xem liệu Meta có thể cải thiện chất lượng của phiên bản web để phù hợp hơn với nhu cầu thực tế hay không. Những phản hồi hiện tại cho thấy người dùng vẫn mong muốn có một ứng dụng desktop thực sự thay vì một bản sao của trình duyệt.</p>', 0, 1, '2026-05-21 12:48:00', '2026-05-21 14:48:00'),
(9, 9, 'Nokia cân nhắc tìm kiếm đối tác mới để hồi sinh thương hiệu smartphone', 'nokia_can_nhac_tim_kiem_doi_tac.png', 'Admin', '<p>Động thái này diễn ra trong bối cảnh công ty bắt đầu tách rời khỏi mối quan hệ đối tác kéo dài nhiều năm với HMD Global, đơn vị đã nắm quyền phát triển và sản xuất các sản phẩm mang thương hiệu Nokia từ năm 2016 đến nay.</p><h2><strong>Bước chuyển mình sau thời kỳ hợp tác với HMD Global</strong></h2><p>Trong suốt thời gian hợp tác, HMD Global đã giữ vai trò chính trong việc hồi sinh tên tuổi Nokia trên thị trường điện thoại thông minh. Tuy nhiên, kể từ năm ngoái, cả hai bên đã bắt đầu quá trình tách rời. Một trong những động thái rõ ràng nhất là việc HMD Global gỡ bỏ toàn bộ các mẫu điện thoại mang thương hiệu Nokia khỏi trang web chính thức của mình và thay thế bằng các sản phẩm mang thương hiệu HMD.</p><p>Điều này khiến nhiều người đặt câu hỏi về tương lai của thương hiệu Nokia trong ngành di động, dù thực tế cho thấy Nokia vẫn để ngỏ khả năng hợp tác với một đối tác mới nhằm tiếp tục duy trì sự hiện diện trên thị trường smartphone.</p><p>Thông tin về việc Nokia tìm kiếm đối tác mới xuất hiện trên diễn đàn Reddit chính thức của Nokia, nơi một quản lý cộng đồng đã xác nhận rằng công ty đang sẵn sàng hợp tác với một nhà sản xuất di động có quy mô lớn. Dù đây chỉ là phát biểu từ một đại diện mạng xã hội, nhưng thông tin này vẫn cho thấy Nokia đang chủ động tìm kiếm cơ hội hợp tác để tiếp tục phát triển mảng smartphone dưới hình thức cấp phép thương hiệu. Quyết định này có thể giúp Nokia giữ vững sự hiện diện của mình trên thị trường mà không cần trực tiếp tham gia sản xuất phần cứng.</p><p><img src=\"https://cdn2.fptshop.com.vn/unsafe/nokia_co_the_tim_kiem_doi_tac_moi_de_cap_phep_thuong_hieu_smartphone_14a1c3537e.jpg\" alt=\"Nokia cân nhắc tìm kiếm đối tác mới để hồi sinh thương hiệu smartphone\" width=\"750\" height=\"91\"></p><p>Việc cấp phép thương hiệu không phải là điều mới mẻ đối với Nokia. Trước đây, công ty đã từng cho phép các đối tác sử dụng thương hiệu của mình để sản xuất nhiều sản phẩm khác nhau. Streamview từng sản xuất các dòng TV mang thương hiệu Nokia, trong khi RichGo sản xuất tai nghe và các phụ kiện smartphone. Ngoài ra, OFF Global cũng từng được cấp phép để sản xuất laptop mang nhãn hiệu Nokia. Tuy nhiên, các thỏa thuận này đã kết thúc trong thời gian gần đây, khiến Nokia cần phải tìm kiếm những hướng đi mới để tận dụng sức mạnh thương hiệu vốn đã ăn sâu vào tâm trí người tiêu dùng toàn cầu.</p><p>Trong khi đó, HMD Global hiện đang đối mặt với không ít khó khăn. Công ty này đã thông báo về kế hoạch thu hẹp quy mô hoạt động tại thị trường Mỹ, đồng thời phải đối diện với sự cạnh tranh gay gắt từ các đối thủ lớn trong ngành smartphone. Về phía Nokia, ngoài những thay đổi trong mảng điện thoại, công ty còn phải đối mặt với những tin đồn liên quan đến mảng kinh doanh mạng. Có thông tin cho rằng Samsung đang xem xét việc mua lại mảng thiết bị viễn thông của Nokia, tuy nhiên, hãng đã nhanh chóng lên tiếng phủ nhận điều này, khẳng định vẫn tiếp tục duy trì hoạt động một cách độc lập.</p><p>Nokia dự kiến sẽ công bố báo cáo tài chính quý hai vào thứ Năm tới. Trong quý đầu tiên của năm 2025, công ty ghi nhận lợi nhuận hoạt động đạt 156 triệu EUR (khoảng 4.7 nghìn tỷ đồng) trên tổng doanh thu 4.39 tỷ EUR (khoảng 113.7 nghìn tỷ đồng). Những con số này cho thấy dù phải đối mặt với nhiều thử thách, nhưng Nokia vẫn duy trì được hiệu quả kinh doanh nhất định trong các lĩnh vực cốt lõi, đặc biệt là mảng thiết bị mạng và viễn thông.</p><p>Câu hỏi lớn nhất hiện nay là đối tác nào sẽ được Nokia lựa chọn để tiếp quản thương hiệu smartphone trong thời gian tới. Liệu đó có phải là một trong những nhà sản xuất lớn đã có chỗ đứng vững chắc trên thị trường hay là một công ty khởi nghiệp mới nổi tương tự như cách HMD Global từng làm trong quá khứ? Câu trả lời cho vấn đề này sẽ định hình tương lai của thương hiệu Nokia trong ngành di động.</p><p>Dù vẫn còn nhiều ẩn số, sự quay trở lại của Nokia trong lĩnh vực smartphone là điều mà người tiêu dùng và giới công nghệ trên toàn thế giới đặc biệt quan tâm. Thương hiệu này từng ghi dấu ấn đậm nét với những sản phẩm mang tính biểu tượng về thiết kế, độ bền và sự đổi mới. Nếu tìm được đối tác phù hợp, Nokia hoàn toàn có thể tái khẳng định vị thế trên thị trường smartphone trong những năm tới.</p>', 0, 1, '2026-05-31 15:12:00', '2026-05-31 17:12:00'),
(13, 2, 'Chính sách đổi trả', 'R.jpg', 'Admin', '<p><strong>1. Mục đích</strong><br>Chính sách này được thiết lập để bảo vệ quyền lợi mua sắm của khách hàng khi sản phẩm gặp lỗi hoặc không phù hợp với yêu cầu.</p><p><strong>2. Thời hạn hỗ trợ</strong><br>Khách hàng được yêu cầu đổi hoặc trả sản phẩm trong vòng <strong>X ngày</strong> tính từ ngày nhận hàng (tuỳ bạn chọn 3 – 7 – 14 ngày). Sau thời hạn này, giao dịch được xem là hoàn tất.</p><p><strong>3. Điều kiện chấp nhận đổi/trả</strong><br>Sản phẩm được hỗ trợ khi đáp ứng một trong các trường hợp sau:</p><p>Giao sai mẫu, sai màu hoặc sai số lượng.</p><p>Sản phẩm bị lỗi kỹ thuật, lỗi sản xuất hoặc hư hỏng do vận chuyển.</p><p>Sản phẩm không đúng mô tả trên website.</p><p>Sản phẩm phải giữ nguyên tình trạng ban đầu:</p><p>Chưa qua sử dụng</p><p>Còn tem/nhãn, mã vạch đầy đủ</p><p>Nguyên hộp và phụ kiện kèm theo (nếu có)</p><p><strong>Không áp dụng đổi trả cho:</strong></p><p>Thực phẩm, sữa, vitamin và sản phẩm dinh dưỡng đã mở nắp.</p><p>Đồ lót, bình sữa, núm ti và các sản phẩm liên quan tới vệ sinh cá nhân sau khi mở bao bì.</p><p>Sản phẩm nằm trong chương trình thanh lý/giảm sâu và đã thông báo trước.</p><p><strong>4. Quy trình thực hiện</strong><br>Khách hàng cần cung cấp thông tin để xác minh:</p><p>Mã đơn hàng</p><p>Tên sản phẩm</p><p>Hình chụp sản phẩm và lỗi phát sinh</p><p>Sau khi xác nhận, website sẽ hỗ trợ:</p><p><strong>Đổi sản phẩm mới</strong> cùng loại (ưu tiên)</p><p><strong>Trả hàng hoàn tiền</strong> nếu sản phẩm không còn hàng để đổi</p><p><strong>5. Hình thức hoàn tiền</strong><br>Tiền được hoàn qua một trong các phương thức:</p><p>Chuyển khoản ngân hàng</p><p>Hoàn qua ví điện tử (nếu có)</p><p>Hoàn trực tiếp khi giao hàng trả (với COD)</p><p>Thời gian xử lý hoàn tiền từ <strong>X – Y ngày làm việc</strong> tùy hệ thống ngân hàng.</p><p><strong>6. Phí đổi trả</strong></p><p>Trường hợp lỗi từ nhà cung cấp hoặc đơn vị vận chuyển: miễn phí toàn bộ.</p><p>Trường hợp đổi do nhu cầu cá nhân (không thích/đổi size/mẫu): phí vận chuyển do khách hàng chi trả.</p><p><strong>7. Từ chối xử lý</strong><br>Website có quyền từ chối hỗ trợ nếu sản phẩm không đáp ứng điều kiện hoặc phát sinh hư hỏng do sử dụng sai cách, bảo quản không đúng theo hướng dẫn.</p>', 0, 1, '2026-06-10 17:36:00', '2026-06-10 19:36:00'),
(14, 2, 'Giới thiệu cửa hàng', 'homee.png', 'Admin', '<p>Cửa hàng mẹ và bé của chúng tôi ra đời với mong muốn đồng hành cùng hành trình nuôi dạy con khỏe mạnh, an toàn và tiện lợi hơn. Tại đây, khách hàng có thể dễ dàng tìm thấy đầy đủ các sản phẩm dành cho mẹ bầu, trẻ sơ sinh và trẻ nhỏ, từ đồ dùng hằng ngày, thực phẩm dinh dưỡng, đồ chơi phát triển trí tuệ cho đến các sản phẩm chăm sóc sức khỏe.</p><p>Chúng tôi luôn chú trọng lựa chọn hàng hóa từ những thương hiệu uy tín, có nguồn gốc rõ ràng, chất liệu an toàn và đạt tiêu chuẩn chất lượng. Bên cạnh đó, đội ngũ nhân viên am hiểu sản phẩm và nhiệt tình hỗ trợ sẽ giúp quý khách tư vấn đúng nhu cầu, tiết kiệm thời gian và yên tâm khi mua sắm.</p><p>Không chỉ là nơi cung cấp sản phẩm, cửa hàng còn hướng đến việc xây dựng một không gian thân thiện để các mẹ chia sẻ kinh nghiệm, cập nhật kiến thức chăm sóc con và tạo nên một cộng đồng nhỏ đầy yêu thương.</p><p>Với tiêu chí <strong>“An toàn – Chất lượng – Đồng hành”</strong>, chúng tôi tin rằng từng sản phẩm trao đến tay khách hàng sẽ góp phần mang lại sự thoải mái cho mẹ và khởi đầu tốt cho bé. Rất hân hạnh được phục vụ và đồng hành cùng gia đình bạn trong từng giai đoạn phát triển của bé yêu.</p>', 2, 1, '2026-06-20 20:00:00', '2026-06-28 03:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Chưa có chuyên mục', NULL, NULL),
(2, 'Tin mới', NULL, NULL),
(9, 'Sản phẩm tốt', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price` decimal(15,0) NOT NULL DEFAULT '0',
  `price` decimal(15,0) NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `sell_quantity` int NOT NULL DEFAULT '0',
  `views` int NOT NULL DEFAULT '0',
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `details` longtext COLLATE utf8mb4_unicode_ci,
  `create_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `image`, `sale_price`, `price`, `status`, `category_id`, `quantity`, `sell_quantity`, `views`, `short_description`, `details`, `create_date`, `created_at`, `updated_at`) VALUES
(1, 'iPad Pro 11 inch M4 2024 Wifi', '2024_5_10_638509364496951753_ipa.png', 90000, 100000, 1, 4, 99, 1, 12, '<p><img src=\"https://theme.hstatic.net/200001043757/1001385501/14/km_product1.png?v=1617\" alt=\"Phiếu mua hàng trị giá 500,000d (Áp dụng mua sản phẩm Máy lọc nước, Gia dụng lắp đặt giá niêm yết từ 5,000,000đ)\" width=\"20\" height=\"20\">Phiếu mua hàng trị giá 500,000d (Áp dụng mua sản phẩm Máy lọc nước, Gia dụng lắp đặt giá niêm yết từ 5,000,000đ)</p><p><img src=\"https://theme.hstatic.net/200001043757/1001385501/14/km_product2.png?v=1617\" alt=\"Phiếu mua hàng Quạt bàn/hộp/sạc/đứng/lửng/treo trị giá 100.000đ (Áp dụng tùy sản phẩm)\" width=\"20\" height=\"20\">Phiếu mua hàng Quạt bàn/hộp/sạc/đứng/lửng/treo trị giá 100.000đ (Áp dụng tùy sản phẩm)</p><p><img src=\"https://theme.hstatic.net/200001043757/1001385501/14/km_product3.png?v=1617\" alt=\"Phiếu mua hàng Đồng hồ Định vị trẻ em trị giá 100.000đ\" width=\"20\" height=\"20\">Phiếu mua hàng Đồng hồ Định vị trẻ em trị giá 100.000đ</p>', '<p><img src=\"https://theme.hstatic.net/200001043757/1001385501/14/km_product1.png?v=1617\" alt=\"Phiếu mua hàng trị giá 500,000d (Áp dụng mua sản phẩm Máy lọc nước, Gia dụng lắp đặt giá niêm yết từ 5,000,000đ)\" width=\"20\" height=\"20\">Phiếu mua hàng trị giá 500,000d (Áp dụng mua sản phẩm Máy lọc nước, Gia dụng lắp đặt giá niêm yết từ 5,000,000đ)</p><p><img src=\"https://theme.hstatic.net/200001043757/1001385501/14/km_product2.png?v=1617\" alt=\"Phiếu mua hàng Quạt bàn/hộp/sạc/đứng/lửng/treo trị giá 100.000đ (Áp dụng tùy sản phẩm)\" width=\"20\" height=\"20\">Phiếu mua hàng Quạt bàn/hộp/sạc/đứng/lửng/treo trị giá 100.000đ (Áp dụng tùy sản phẩm)</p><p><img src=\"https://theme.hstatic.net/200001043757/1001385501/14/km_product3.png?v=1617\" alt=\"Phiếu mua hàng Đồng hồ Định vị trẻ em trị giá 100.000đ\" width=\"20\" height=\"20\">Phiếu mua hàng Đồng hồ Định vị trẻ em trị giá 100.000đ</p>', '2026-05-01 08:00:00', '2026-05-01 08:00:00', '2026-05-01 10:00:00'),
(6, 'OPPO Reno14 F 5G 8GB', 'oppo_reno14_f_xanh_0a5b091f91_b1.png', 70000, 80000, 1, 22, 493, 7, 10, '<p><img src=\"https://theme.hstatic.net/200001043757/1001385501/14/km_product1.png?v=1617\" alt=\"Phiếu mua hàng trị giá 500,000d (Áp dụng mua sản phẩm Máy lọc nước, Gia dụng lắp đặt giá niêm yết từ 5,000,000đ)\" width=\"20\" height=\"20\">Phiếu mua hàng trị giá 500,000d (Áp dụng mua sản phẩm Máy lọc nước, Gia dụng lắp đặt giá niêm yết từ 5,000,000đ)</p><p><img src=\"https://theme.hstatic.net/200001043757/1001385501/14/km_product2.png?v=1617\" alt=\"Phiếu mua hàng Quạt bàn/hộp/sạc/đứng/lửng/treo trị giá 100.000đ (Áp dụng tùy sản phẩm)\" width=\"20\" height=\"20\">Phiếu mua hàng Quạt bàn/hộp/sạc/đứng/lửng/treo trị giá 100.000đ (Áp dụng tùy sản phẩm)</p><p><img src=\"https://theme.hstatic.net/200001043757/1001385501/14/km_product3.png?v=1617\" alt=\"Phiếu mua hàng Đồng hồ Định vị trẻ em trị giá 100.000đ\" width=\"20\" height=\"20\">Phiếu mua hàng Đồng hồ Định vị trẻ em trị giá 100.000đ</p>', '<p><img src=\"https://theme.hstatic.net/200001043757/1001385501/14/km_product1.png?v=1617\" alt=\"Phiếu mua hàng trị giá 500,000d (Áp dụng mua sản phẩm Máy lọc nước, Gia dụng lắp đặt giá niêm yết từ 5,000,000đ)\" width=\"20\" height=\"20\">Phiếu mua hàng trị giá 500,000d (Áp dụng mua sản phẩm Máy lọc nước, Gia dụng lắp đặt giá niêm yết từ 5,000,000đ)</p><p><img src=\"https://theme.hstatic.net/200001043757/1001385501/14/km_product2.png?v=1617\" alt=\"Phiếu mua hàng Quạt bàn/hộp/sạc/đứng/lửng/treo trị giá 100.000đ (Áp dụng tùy sản phẩm)\" width=\"20\" height=\"20\">Phiếu mua hàng Quạt bàn/hộp/sạc/đứng/lửng/treo trị giá 100.000đ (Áp dụng tùy sản phẩm)</p><p><img src=\"https://theme.hstatic.net/200001043757/1001385501/14/km_product3.png?v=1617\" alt=\"Phiếu mua hàng Đồng hồ Định vị trẻ em trị giá 100.000đ\" width=\"20\" height=\"20\">Phiếu mua hàng Đồng hồ Định vị trẻ em trị giá 100.000đ</p>', '2026-05-04 19:35:10', '2026-05-04 19:35:10', '2026-05-04 21:35:10'),
(29, 'OPPO A5i 6GB', 'oppo_a5i_tim_5_c476e20e16_76de97.png', 90000, 160000, 1, 4, 190, 14, 52, '<ol><li>Miễn phí vận chuyển toàn quốc, đồng kiểm trực tiếp khi giao nhận.</li><li>Giao hàng hỏa tốc (áp dụng đối với hàng có sẵn tại cửa hàng gần nhất)</li></ol>', '<ol><li>Miễn phí vận chuyển toàn quốc, đồng kiểm trực tiếp khi giao nhận.</li><li>Giao hàng hỏa tốc (áp dụng đối với hàng có sẵn tại cửa hàng gần nhất)</li></ol>', '2026-05-29 04:41:22', '2026-05-29 04:41:22', '2026-05-29 06:41:22'),
(30, 'iPad Air 11 inch M3 2025 WiFi', 'ipad_air_11_inch_m3_2025_wifi_xa.png', 500000, 600000, 1, 4, 140, 20, 57, '<ol><li>Miễn phí vận chuyển toàn quốc, đồng kiểm trực tiếp khi giao nhận.</li><li>Giao hàng hỏa tốc (áp dụng đối với hàng có sẵn tại cửa hàng gần nhất)</li></ol>', '<ol><li>Miễn phí vận chuyển toàn quốc, đồng kiểm trực tiếp khi giao nhận.</li><li>Giao hàng hỏa tốc (áp dụng đối với hàng có sẵn tại cửa hàng gần nhất)</li></ol>', '2026-05-30 22:28:57', '2026-05-30 22:28:57', '2026-05-31 00:28:57'),
(31, 'iPhone 15 Pro Max', '2023_9_20_638307992305419305_iph.png', 1100000, 1400000, 1, 2, 85, 27, 125, '<p><img src=\"https://file.hstatic.net/200000725895/file/icon-policy-1_e82fce8de2dc49e88773312c626983e3.svg\" alt=\"Cam kết hàng chính hãng\" width=\"24\" height=\"24\"> Cam kết hàng chính hãng</p><p><img src=\"https://file.hstatic.net/200000725895/file/icon-policy-2_15fd172a6d1d4adda3edc9d8f759bae5.svg\" alt=\"Giao Hàng Miễn Phí Toàn Quốc\" width=\"24\" height=\"24\"> Giao Hàng Miễn Phí Toàn Quốc</p>', '<p><img src=\"https://file.hstatic.net/200000725895/file/icon-policy-1_e82fce8de2dc49e88773312c626983e3.svg\" alt=\"Cam kết hàng chính hãng\" width=\"24\" height=\"24\">Cam kết hàng chính hãng</p><p><img src=\"https://file.hstatic.net/200000725895/file/icon-policy-2_15fd172a6d1d4adda3edc9d8f759bae5.svg\" alt=\"Giao Hàng Miễn Phí Toàn Quốc\" width=\"24\" height=\"24\">Giao Hàng Miễn Phí Toàn Quốc</p><p><img src=\"https://file.hstatic.net/200000725895/file/icon-policy-3_c7e12e941d0a4caea876fb19f55d2140.svg\" alt=\"Đổi trả trong vòng 14 ngày.\" width=\"24\" height=\"24\">Đổi trả trong vòng 14 ngày.</p><p><img src=\"https://file.hstatic.net/200000725895/file/icon-policy-4_17f423e3228240abab366c2d11a5efd0.svg\" alt=\"Giao hàng ngay\" width=\"24\" height=\"24\">Giao hàng ngay</p>', '2026-06-01 16:16:33', '2026-06-01 16:16:33', '2026-06-01 18:16:33'),
(32, 'Apple Watch SE 2024 GPS', 'apple_watch_se_gps_40mm_starligh.png', 400000, 500000, 1, 24, 20, 15, 107, '<p><img src=\"https://file.hstatic.net/200000725895/file/icon-policy-1_e82fce8de2dc49e88773312c626983e3.svg\" alt=\"Cam kết hàng chính hãng\" width=\"24\" height=\"24\">Cam kết hàng chính hãng</p><p><img src=\"https://file.hstatic.net/200000725895/file/icon-policy-2_15fd172a6d1d4adda3edc9d8f759bae5.svg\" alt=\"Giao Hàng Miễn Phí Toàn Quốc\" width=\"24\" height=\"24\">Giao Hàng Miễn Phí Toàn Quốc</p>', '<p><img src=\"https://file.hstatic.net/200000725895/file/icon-policy-1_e82fce8de2dc49e88773312c626983e3.svg\" alt=\"Cam kết hàng chính hãng\" width=\"24\" height=\"24\">Cam kết hàng chính hãng</p><p><img src=\"https://file.hstatic.net/200000725895/file/icon-policy-2_15fd172a6d1d4adda3edc9d8f759bae5.svg\" alt=\"Giao Hàng Miễn Phí Toàn Quốc\" width=\"24\" height=\"24\">Giao Hàng Miễn Phí Toàn Quốc</p>', '2026-06-03 10:04:08', '2026-06-03 10:04:08', '2026-06-03 12:04:08'),
(33, 'iPhone 17 Pro Max 256GB', 'iPhone-17-Pro-Max-256GB-Xanh-Chinh-hang-VNA.webp', 34990000, 37990000, 1, 2, 45, 0, 0, '<p>iPhone 17 Pro Max 256GB, thiáº¿t káº¿ cao cáº¥p, hiá»‡u nÄƒng máº¡nh máº½.</p>', '<p>iPhone 17 Pro Max 256GB chÃ­nh hÃ£ng, mÃ&nbsp;n hÃ¬nh Ä‘áº¹p, camera sáº¯c nÃ©t, phÃ¹ há»£p nhu cáº§u giáº£i trÃ­ vÃ&nbsp; cÃ´ng viá»‡c.</p>', '2026-06-05 03:51:43', '2026-06-05 03:51:43', '2026-06-05 05:51:43'),
(34, 'iPhone 17 128GB', 'iphone-17-xanh-lam-khoi.jpg', 22990000, 24990000, 1, 2, 60, 0, 0, '<p>iPhone 17 128GB mÃ&nbsp;u xanh, hiá»‡u nÄƒng á»•n Ä‘á»‹nh, pin tá»‘t.</p>', '<p>iPhone 17 128GB vá»›i thiáº¿t káº¿ hiá»‡n Ä‘áº¡i, camera cháº¥t lÆ°á»£ng vÃ&nbsp; tráº£i nghiá»‡m iOS mÆ°á»£t mÃ&nbsp;.</p>', '2026-06-06 21:39:18', '2026-06-06 21:39:18', '2026-06-06 23:39:18'),
(35, 'Samsung Galaxy S26 Ultra 256GB', 'samsung-galaxy-s26-ultra-tim.webp', 29990000, 32990000, 1, 4, 35, 0, 0, '<p>Galaxy S26 Ultra 256GB, mÃ&nbsp;n hÃ¬nh lá»›n, camera cao cáº¥p.</p>', '<p>Samsung Galaxy S26 Ultra sá»Ÿ há»¯u mÃ&nbsp;n hÃ¬nh sáº¯c nÃ©t, hiá»‡u nÄƒng máº¡nh vÃ&nbsp; cá»¥m camera linh hoáº¡t.</p>', '2026-06-08 15:26:53', '2026-06-08 15:26:53', '2026-06-08 17:26:53'),
(36, 'Samsung Galaxy A56 5G 8GB/128GB', 'Samsung-Galaxy-A56-5G-8GB128GB-1-e1778490733236.jpg', 9490000, 10990000, 1, 4, 80, 0, 0, '<p>Galaxy A56 5G, RAM 8GB, bá»™ nhá»› 128GB.</p>', '<p>Samsung Galaxy A56 5G phÃ¹ há»£p ngÆ°á»i dÃ¹ng cáº§n mÃ¡y á»•n Ä‘á»‹nh, mÃ&nbsp;n hÃ¬nh Ä‘áº¹p vÃ&nbsp; pin bá»n.</p>', '2026-06-10 09:14:28', '2026-06-10 09:14:28', '2026-06-10 11:14:28'),
(37, 'OPPO Reno14 F 5G 8GB/256GB', 'oppo_reno14_f_xanh_0a5b091f91_b1.png', 8990000, 9990000, 1, 22, 70, 0, 0, '<p>OPPO Reno14 F 5G, thiáº¿t káº¿ tráº» trung, camera Ä‘áº¹p.</p>', '<p>OPPO Reno14 F 5G cÃ³ thiáº¿t káº¿ má»ng nháº¹, camera tá»‘i Æ°u chÃ¢n dung vÃ&nbsp; hiá»‡u nÄƒng á»•n Ä‘á»‹nh.</p>', '2026-06-12 03:02:04', '2026-06-12 03:02:04', '2026-06-12 05:02:04'),
(38, 'OPPO A5i 6GB/128GB', 'oppo_a5i_tim_5_c476e20e16_76de97.png', 3990000, 4590000, 1, 22, 130, 0, 0, '<p>OPPO A5i 6GB, giÃ¡ tá»‘t, pin bá»n.</p>', '<p>OPPO A5i lÃ&nbsp; lá»±a chá»n há»£p lÃ½ cho nhu cáº§u nghe gá»i, há»c táº­p, giáº£i trÃ­ cÆ¡ báº£n.</p>', '2026-06-13 20:49:39', '2026-06-13 20:49:39', '2026-06-13 22:49:39'),
(39, 'Signature S Rose Gold 2017', '1782607613_vertu1.jpg', 199999999, 200000000, 1, 23, 23, 0, 0, '<p><strong>Tặng gói bảo hành máy 5 năm toàn quốc.</strong></p><p><strong>Bao test 15 ngày ở bất kỳ đâu, lỗi 1 đổi 1.</strong></p><p><strong>Cam kết CHÍNH HÃNG 100%.</strong></p><ul><li><strong>KẾT NỐI: SÓNG 3G, 4G</strong></li></ul><p><strong>Miễn phí vệ sinh, đánh bóng máy 1 năm.</strong></p><p><strong>Khung máy được chế tác từ vàng nguyên khối 18k.</strong></p><p><strong>Nắp lưng được chế tác từ gốm&nbsp;Ceramic&nbsp;và ốc vàng khối&nbsp;18k.</strong></p><p><strong>Màn hình từ Sapphire nguyên khối siêu chống xước.</strong></p><p><strong>4.75 carats đá Ruby nâng đỡ cho các phím</strong></p><p><strong>Được chế tác hoàn toàn thủ công và đạt độ cân bằng tuyệt đối</strong></p>', '<p><strong>Vertu Signature S Rose Gold 2017</strong> mang đậm bản lĩnh phái mạnh với điểm nhấn từ bộ khung vàng 18k đẳng cấp và sang trọng.&nbsp;</p><p><img src=\"https://cdn0585.cdn4s.com/media/vertu%20signature%20s/rose%20gold%202017/z3775753040640_2f1fad223e8cf7c649c595a12aa13542.jpg\" alt=\"Signature S Vàng Khối - Mới 90%\" width=\"600\" height=\"452\"></p><p><i><strong>So Sánh Vertu Signature S Năm 2017 Và 2016:&nbsp;</strong></i></p><p>Nếu như ở bản 2016, bộ lưu trữ danh bạ hoạt động tối đa là 2000 thông tin và không hỗ trợ wifi hay tiếng Việt. Thì ở bản Vertu mới năm 2017, các Sếp có thể lưu tới 5000 thông tin danh bạ và được hỗ trợ wifi, ngôn ngữ tiếng Việt. Ngoài ra, phần thiết kế của Vertu Signature S Stainless 2017 cũng có phần nâng cấp hơn với nút Concierge được thay thế bằng đá Ruby đỏ tự nhiên, tạo nên giá trị riêng đẳng cấp hơn cho dòng máy huyền thoại.</p>', '2026-06-15 14:37:14', '2026-06-15 14:37:14', '2026-06-15 16:37:14'),
(40, 'iPhone 15 Plus 128GB', '2023_9_16_638304536466753948_iphone-15-plus-den-1.jpg', 18990000, 20990000, 1, 2, 54, 1, 2, '<p>iPhone 15 Plus 128GB, mÃ&nbsp;n hÃ¬nh lá»›n, pin tá»‘t.</p>', '<p>iPhone 15 Plus phÃ¹ há»£p ngÆ°á»i dÃ¹ng thÃ­ch mÃ&nbsp;n hÃ¬nh lá»›n, hiá»‡u nÄƒng á»•n Ä‘á»‹nh vÃ&nbsp; camera tá»‘t.</p>', '2026-06-17 08:24:49', '2026-06-17 08:24:49', '2026-06-17 10:24:49'),
(41, 'Samsung Galaxy Z Fold7 256GB', 'man_hinh_galaxy_z_fold7_co_do_be.png', 40990000, 44990000, 1, 4, 19, 1, 3, '<p>Galaxy Z Fold7 mÃ&nbsp;n hÃ¬nh gáº­p, tráº£i nghiá»‡m Ä‘a nhiá»‡m cao cáº¥p.</p>', '<p>Samsung Galaxy Z Fold7 mang Ä‘áº¿n tráº£i nghiá»‡m mÃ&nbsp;n hÃ¬nh gáº­p rá»™ng rÃ£i, phÃ¹ há»£p cÃ´ng viá»‡c vÃ&nbsp; giáº£i trÃ­.</p>', '2026-06-19 02:12:24', '2026-06-19 02:12:24', '2026-06-19 04:12:24'),
(42, 'Apple iPhone 17 Pro Max 2TB Chính hãng ZP/A', '1782606981_1_dien_tho_95cf000ae7.jpeg', 6369000, 70000000, 1, 2, 32, 2, 0, '<p>Tái định nghĩa trải nghiệm di động, iPhone 17 Pro Max 2TB không chỉ là một chiếc smartphone, mà còn là một siêu phẩm công nghệ bùng nổ. Với Chip A19 Pro mạnh mẽ tích hợp Apple Intelligence, hệ thống camera Pro Fusion 48MP đột phá cùng khả năng sạc 50% pin chỉ trong 20 phút, chiếc iPhone cao cấp này hứa hẹn sẽ mang đến những trải nghiệm chưa từng có.</p>', '<p>Dung lượng lưu trữ đột phá</p><p>Apple đã&nbsp;loại bỏ hoàn toàn phiên bản 128GB&nbsp;trên các phiên bản iPhone mới 2025, khởi đầu từ mức 256GB để đáp ứng nhu cầu ngày càng cao của người dùng hiện đại. Đặc biệt, lần đầu tiên trong lịch sử iPhone, phiên bản&nbsp;iPhone 17 Pro Max&nbsp;2TB&nbsp;ra mắt tùy chọn dung lượng lên tới 2TB.</p><p>Với không gian lưu trữ khổng lồ này, bạn có thể thoải mái ghi lại hàng ngàn video&nbsp;ProRes&nbsp;chất lượng cao, lưu trữ hàng triệu bức ảnh&nbsp;ProRAW, và tải về mọi ứng dụng hay trò chơi mà không cần lo lắng về việc hết bộ nhớ, biến chiếc điện thoại thành một thư viện di động mạnh mẽ và không giới hạn.</p>', '2026-06-20 20:00:00', '2026-06-20 20:00:00', '2026-06-20 22:00:00'),
(43, 'iPhone 17 256GB | Chính hãng', '1782565874_iphone_17_256gb-3_2.webp', 20453000, 23690000, 1, 2, 15, 5, 4, '<p>trả góp 0% lãi suất, tối đa 12 tháng, trả trước từ 10% qua CTTC hoặc 0đ qua thẻ tín dụng</p>', '<figure class=\"table\"><table><tbody><tr><td>Hệ điều hành</td><td>iOS 26</td></tr><tr><td>Chipset</td><td>Apple A19</td></tr><tr><td>Bộ nhớ trong</td><td>256 GB</td></tr><tr><td>Loại CPU</td><td>6 lõi (2 hiệu năng + 4 tiết kiệm điện)</td></tr><tr><td>GPU</td><td>GPU 5 lõi với Neural Accelerator</td></tr><tr><td>Kích thước màn hình</td><td>6.3 inches</td></tr><tr><td>Công nghệ màn hình</td><td><a href=\"https://cellphones.com.vn/sforum/man-hinh-super-retina-xdr-la-gi\">Super Retina XDR OLED</a></td></tr><tr><td>Độ phân giải màn hình</td><td>2622 x 1206 pixels</td></tr><tr><td>Tính năng màn hình</td><td>Dynamic Island<br>Màn hình luôn bật<br>HDR<br>460 ppi<br>True Tone<br>Dải màu rộng (P3)<br>Haptic Touch<br>Tỷ lệ tương phản 2.000.000:1<br>Độ sáng 1000 nit (typ)<br>Đỉnh 1600 nit (HDR)<br>Đỉnh 3000 nit (ngoài trời)<br>Lớp phủ chống vân tay, chống phản chi</td></tr><tr><td>Camera sau</td><td>48MP Fusion Main f/1.6 OIS<br>12MP Tele 2x f/1.6 OIS<br>48MP Ultra Wide f/2.2 120°</td></tr><tr><td>Camera trước</td><td>18MP Center Stage, f/1.9, PDAF</td></tr><tr><td>Pin</td><td>Xem video: 30 giờ<br>Xem video trực tuyến: 27 giờ</td></tr><tr><td>Hỗ trợ mạng</td><td><a href=\"https://cellphones.com.vn/sforum/mang-5g-la-gi\">5G</a></td></tr><tr><td>Thẻ SIM</td><td>Sim kép (nano-Sim và e-Sim) - Hỗ trợ 2 e-Sim</td></tr><tr><td>Công nghệ NFC</td><td>Có</td></tr><tr><td>Thời điểm ra mắt</td><td>09/2025</td></tr></tbody></table></figure>', NULL, NULL, NULL),
(44, 'spdemo', '1782629531_cap-type-c-to-lightning-cuktech-1m-al870_2_.jpg', 22300099, 12344213123, 1, 2, 23, 0, 1, '<p>sampam moi</p>', '<p>sampham moi</p>', NULL, NULL, NULL),
(45, 'spmoi', '1782921331_1854426483.jpeg', 1000000, 9999999, 1, 25, 12, 0, 0, '<p>demo</p>', '<p>demo</p>', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0o3SCUOYhV8wlqCq6boJp3beXSwqXOgKeAMjdqkh', NULL, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.120.0 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDNQYklIaFNFU0Y4VElBZWZCYzJzWmVwNHA2eTgwcE1FZTZlbWpMcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jdWEtaGFuZyI7czo1OiJyb3V0ZSI7czoxMDoiZnJvbnQuc2hvcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1779460706),
('4HzsPviU9wWjsK3gpp3EmuOpBWZmWe3A7KF6bBvM', NULL, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDcxY1FEelgwN2NVWHRCRlJINFE1RXRTTnZYalN4QUtwMHc3Vkt2VSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiZnJvbnQuaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1782112355),
('DDQUBkRTgXDJc3gWosBEHaMcUeEm1j5qvRZnk9ze', NULL, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicE9YMmJsVXdvQ1hialAzUDNlZTcyelh2UFV1YmRuc1hNYk0wcEJPRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiZnJvbnQuaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1779447709),
('luqnhEnhmUGu4jT3opQOMTUqbgtRgCsspoxQBv9J', NULL, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicnVCTEs2dERBSnZkN2xxalFVUlZHMDF0N21lTjUydGx2U2FuUFNwaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiZnJvbnQuaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1779438129),
('nLNpmx1H8usp1yx2TyAepJEUhcJdA5XL1mGD2xWG', NULL, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiclZYYkZ2M0FiVW05bkdBbzN5Ykt6MnNxcVlHUUpQV2o4NUd2dXJNYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jdWEtaGFuZyI7czo1OiJyb3V0ZSI7czoxMDoiZnJvbnQuc2hvcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1779511329),
('uUOjZ72EnaUOSWWaveN44syAV7GW0ENigSOsGuAZ', NULL, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTnZCUUpVYko4ZXFnU3hSdkphUUtPaG1vMGpFMk85bW55Y3h5RzFsSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiZnJvbnQuaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1779463105),
('WjlHBdRrjgUBlsUfHRuqMtipfsCrDg88gGup3Pqr', NULL, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiREZ3azQ0ZmZ5MjBldVZWdTVuWDFsUnpRQ0NGcVpYd1VIM3Njbnl6MiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1779220690);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `name`, `full_name`, `image`, `email`, `phone`, `address`, `email_verified_at`, `password`, `role`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 8, 'admin', 'Admin', 'Admin', 'user-default.png', 'thangvu04@gmail.com', '0336216111', 'Đại học Công nghệ Đông Á', NULL, '$2y$10$Cm.2KiZ85WRGUTBk8vhMaOIQt46A53HKuzPfZh2jS.fdZzAr33dTi', 1, 1, NULL, NULL, NULL),
(96, 26, 'thang2004', 'VU DUC KHANH', 'VU DUC KHANH', 'user-default.png', 'thang205@gmail.com', '0985555555', 'Hà Nôi', NULL, '$2y$12$YEFOCBLMcFeiW3NQ2dVcZu5RodpKfzZPL.xIUfXCfSb.lyoG2CYbm', 0, 1, NULL, '2026-06-25 05:46:46', '2026-06-25 09:27:28'),
(110, 27, 'thang', 'thang', 'thang', 'user-default.png', 'thang@example.local', '0900002004', '', NULL, '$2y$12$WAankQwRIB9hdwZUHK3DQOeaIYCQ.riTR0VhjhozjNXmXcDIlElr.', 1, 1, NULL, '2026-06-25 18:56:00', '2026-06-26 04:26:16'),
(111, 28, 'user2026_01', 'Nguyen Van An', 'Nguyen Van An', NULL, 'user2026_01@example.com', '0901000001', '12 Nguyen Trai, Quan Thanh Xuan, Ha Noi', '2026-05-27 14:54:10', '$2y$12$/ALbpbaPp3/00B6IcCrkju94ire4EMn.e7h1LbcIew2W40EriVr/6', 0, 1, 'kRlP58AlGu', '2026-05-27 14:54:10', '2026-06-28 01:25:13'),
(112, 29, 'user2026_02', 'Tran Thi Bich', 'Tran Thi Bich', NULL, 'user2026_02@example.com', '0901000002', '26 Bach Dang, Quan Hai Chau, Da Nang', '2026-05-19 19:17:54', '$2y$12$/ALbpbaPp3/00B6IcCrkju94ire4EMn.e7h1LbcIew2W40EriVr/6', 0, 1, 'LW3KSuwdnE', '2026-05-19 19:17:54', '2026-06-28 01:25:13'),
(113, 30, 'user2026_03', 'Le Minh Chau', 'Le Minh Chau', NULL, 'user2026_03@example.com', '0901000003', '135 Le Van Sy, Quan 3, TP Ho Chi Minh', '2026-06-21 00:02:59', '$2y$12$/ALbpbaPp3/00B6IcCrkju94ire4EMn.e7h1LbcIew2W40EriVr/6', 0, 1, 'kgnlRnZ5QX', '2026-06-21 00:02:59', '2026-06-28 01:25:13'),
(114, 31, 'user2026_04', 'Pham Quoc Dung', 'Pham Quoc Dung', NULL, 'user2026_04@example.com', '0901000004', '18 Tran Phu, Quan Ninh Kieu, Can Tho', '2026-05-09 10:06:47', '$2y$12$/ALbpbaPp3/00B6IcCrkju94ire4EMn.e7h1LbcIew2W40EriVr/6', 0, 1, 'aiSCy7IPMq', '2026-05-09 10:06:47', '2026-06-28 01:25:13'),
(115, 32, 'user2026_05', 'Hoang Gia Han', 'Hoang Gia Han', NULL, 'user2026_05@example.com', '0901000005', '39 Lach Tray, Quan Ngo Quyen, Hai Phong', '2026-05-31 03:11:54', '$2y$12$/ALbpbaPp3/00B6IcCrkju94ire4EMn.e7h1LbcIew2W40EriVr/6', 0, 1, 'mGC9VTR7F6', '2026-05-31 03:11:54', '2026-06-28 01:25:13'),
(116, 33, 'user2026_06', 'Vo Thanh Khoa', 'Vo Thanh Khoa', NULL, 'user2026_06@example.com', '0901000006', '21 Hung Vuong, TP Hue, Thua Thien Hue', '2026-05-19 07:52:30', '$2y$12$/ALbpbaPp3/00B6IcCrkju94ire4EMn.e7h1LbcIew2W40EriVr/6', 0, 1, 'xoPqjNtARZ', '2026-05-19 07:52:30', '2026-06-28 01:25:13'),
(117, 34, 'user2026_07', 'Dang Ngoc Linh', 'Dang Ngoc Linh', NULL, 'user2026_07@example.com', '0901000007', '14 Tran Phu, TP Nha Trang, Khanh Hoa', '2026-05-05 07:07:33', '$2y$12$/ALbpbaPp3/00B6IcCrkju94ire4EMn.e7h1LbcIew2W40EriVr/6', 0, 1, 'CU7DlthbFu', '2026-05-05 07:07:33', '2026-06-28 01:25:13'),
(118, 35, 'user2026_08', 'Bui Tuan Minh', 'Bui Tuan Minh', NULL, 'user2026_08@example.com', '0901000008', '7 Ba Cu, TP Vung Tau, Ba Ria Vung Tau', '2026-05-17 13:59:22', '$2y$12$/ALbpbaPp3/00B6IcCrkju94ire4EMn.e7h1LbcIew2W40EriVr/6', 0, 1, 'Xf5C5TcvHb', '2026-05-17 13:59:22', '2026-06-28 01:25:13'),
(119, 36, 'user2026_09', 'Do Phuong Nhi', 'Do Phuong Nhi', NULL, 'user2026_09@example.com', '0901000009', '33 Dai Lo Binh Duong, TP Thu Dau Mot, Binh Duong', '2026-06-14 15:26:41', '$2y$12$/ALbpbaPp3/00B6IcCrkju94ire4EMn.e7h1LbcIew2W40EriVr/6', 0, 1, 'ZzjPVtMWqh', '2026-06-14 15:26:41', '2026-06-28 01:25:13'),
(120, 37, 'user2026_10', 'Mai Duc Phat', 'Mai Duc Phat', NULL, 'user2026_10@example.com', '0901000010', '91 Pham Van Thuan, TP Bien Hoa, Dong Nai', '2026-06-20 23:28:03', '$2y$12$/ALbpbaPp3/00B6IcCrkju94ire4EMn.e7h1LbcIew2W40EriVr/6', 0, 1, '8Qc37vaWrs', '2026-06-20 23:28:03', '2026-06-28 01:25:13'),
(121, 38, 'thangv204', 'Vũ Đức Thắng', 'Vũ Đức Thắng', 'user-default.png', 'thangtv23@gmail.com', '0876453421', 'Đại học Công nghệ Đông Á', NULL, '$2y$12$CPmgPVNBZP5abQp65gN28e5TGsuhmCxu1xrAj0UoQ2/hV8U/K8lFG', 0, 1, NULL, '2026-06-28 02:42:53', '2026-06-28 06:48:45'),
(122, 39, 'thangv207', 'Vũ Đức Khánh', 'Vũ Đức Khánh', 'user-default.png', 'thang24@gmail.com', '0985555557', 'Đại học Công nghệ Đông Á', NULL, '$2y$12$ii6w.zFU4up1qoMX9EyCMOPNKguMWJbbuylzAisa5hGnA.9oBlr76', 0, 1, NULL, '2026-06-28 06:49:39', '2026-06-28 06:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `sell` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `price`, `quantity`, `sell`, `created_at`, `updated_at`) VALUES
(1, 'Laptop Acer Aspire 7 A715-76-728X i7 12650H', 1500000, 1, 0, '2026-06-26 09:17:33', '2026-06-26 09:17:33'),
(2, 'OPPO A5i 6GB/128GB', 4590000, 10, 0, '2026-06-28 06:55:15', '2026-06-28 06:55:15'),
(3, 'Apple iPhone 17 Pro Max 2TB Chính hãng ZP/A', 70000000, 20, 0, '2026-07-01 16:02:21', '2026-07-01 16:02:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_user_id_index` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `carts_user_id_product_id_index` (`user_id`,`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comments_product_id_status_index` (`product_id`,`status`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderdetails_product_id_foreign` (`product_id`),
  ADD KEY `orderdetails_order_id_product_id_index` (`order_id`,`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_user_id_order_id_index` (`user_id`,`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_user_id_unique` (`user_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderdetails_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
