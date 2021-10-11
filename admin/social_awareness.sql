-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 08:15 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_awareness`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_type` enum('mail','phone') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mail',
  `contact_detail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` enum('2','1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` enum('2','1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_featured` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `excerpt` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `name`, `slug`, `image`, `is_published`, `is_featured`, `excerpt`, `description`, `location`, `start_date`, `end_date`, `created_by`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Blood Donation Edited', 'blood-donation-edited-3853983907', 'campaign-1633886459-7010df981b737c7935b649a2973cd61a.jpg', '1', '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat...', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat...</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat...</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat...</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat...</p>', 'Kathmandu', '2021-10-10 00:00:00', '2021-10-13 00:00:00', 5, NULL, '2021-10-10 11:36:00', '2021-10-10 12:17:44', NULL),
(3, 'Lorem Ipsum Dolor Sit Consectetur Adipisicing Elit', 'lorem-ipsum-dolor-sit-consectetur-adipisicing-elit-3459388015', 'campaign-1633886582-5d79627c581122c699027ecbbba327e2.jpg', '1', '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat...', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat...</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat...</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat...</p>', 'Kathmandu', NULL, NULL, 5, NULL, '2021-10-10 11:38:02', '2021-10-10 11:38:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Crime', '1', '2021-10-10 11:32:59', '2021-10-10 11:32:59'),
(2, 'Health', '1', '2021-10-10 11:33:03', '2021-10-10 11:33:03'),
(3, 'Climate', '1', '2021-10-10 11:33:06', '2021-10-10 11:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(6, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(8, '2016_06_01_000004_create_oauth_clients_table', 2),
(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(25, '2021_10_02_175249_create_categories_table', 3),
(26, '2021_10_03_083133_create_campaigns_table', 3),
(27, '2021_10_10_050800_create_advertisements_table', 3),
(28, '2021_10_10_052746_create_banners_table', 3),
(29, '2021_10_10_053424_create_settings_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('047206f119060e596c4d8d3cec6647eb9513f26dc194e2eead998c11bfb8eeee6f0cc2f3fbd54652', 1, 2, NULL, '[]', 0, '2021-10-06 02:49:13', '2021-10-06 02:49:13', '2022-10-06 08:34:13'),
('053e04c5239a89fdde67f3f05244501ff44680301a79da355aaee4657df6834f12ab5a303f071353', 1, 2, NULL, '[]', 0, '2021-10-05 23:03:43', '2021-10-05 23:03:43', '2022-10-06 04:48:43'),
('06ad7965fa075e091c98360f7e62c777828a56454a30784a22385fd6a082493625e4a5d3aef2a939', 1, 2, NULL, '[]', 0, '2021-10-03 06:32:36', '2021-10-03 06:32:36', '2022-10-03 12:17:36'),
('0dde5c50899fc0dd691ae8254cd951953520db58206a8a481042bc1c9cea62ffde0c0f3243157ce1', 1, 2, NULL, '[]', 0, '2021-10-04 21:53:30', '2021-10-04 21:53:30', '2022-10-05 03:38:30'),
('13784df9f18a669e053c68807123a1bf2e1e388f51c25e4a32b6e2624f1e9f99d9beb770543d6265', 1, 2, NULL, '[]', 0, '2021-10-05 23:03:43', '2021-10-05 23:03:43', '2022-10-06 04:48:43'),
('19fb4a08ed19bb979d753fb717d601b46be646db6a2726552cb8da01e9977ae9a7a9e8e68e7eb3d7', 1, 2, NULL, '[]', 0, '2021-10-03 00:48:43', '2021-10-03 00:48:43', '2022-10-03 06:33:43'),
('1ffe44b043b9f95c2856099962ac390030f704850ec41c7ea8d12326c3506ffa58d51bb4535e2b0b', 1, 2, NULL, '[]', 0, '2021-10-03 05:57:14', '2021-10-03 05:57:14', '2022-10-03 11:42:14'),
('2124ea9fbb016d24cbfa52c968ea3204c2f6b9c8725dcbcaba3f1c6cd631fbe16e2961ea5f450ed2', 1, 2, NULL, '[]', 0, '2021-10-03 02:27:07', '2021-10-03 02:27:07', '2022-10-03 08:12:07'),
('26d5e1e974138bfc1034473a97b77bf384350623cbd6aa620d2061ac7d5c2d9757f7b31324f73736', 1, 2, NULL, '[]', 0, '2021-10-05 01:33:41', '2021-10-05 01:33:41', '2022-10-05 07:18:41'),
('2a27a4abf3f26abe0151b586cef5dc978fbf69a71182c3d83ef024905298d2b780c3c81d102d41b0', 1, 2, NULL, '[]', 0, '2021-10-03 00:09:15', '2021-10-03 00:09:15', '2022-10-03 05:54:15'),
('310bf2f5a1cf3bdce7f77826e03bf6360a7f187fd0034c72b44a5e2e9e0306f161446f1b7cefd426', 1, 2, NULL, '[]', 0, '2021-10-06 02:29:19', '2021-10-06 02:29:19', '2022-10-06 08:14:19'),
('36cd7ef0549009e3873929bde8d85fa8cbbfccfc1721410b30caf095be6e8bfbc4ddc0d112db9e96', 1, 2, NULL, '[]', 0, '2021-10-07 12:14:15', '2021-10-07 12:14:15', '2022-10-07 17:59:15'),
('4add43efc5850f048220bc410f305964e50ca66bab54869f6504746ffeb7b699876cb482eadb5b47', 1, 2, NULL, '[]', 0, '2021-10-02 11:43:15', '2021-10-02 11:43:15', '2022-10-02 17:28:15'),
('52dee9b4ed40e8cf527542a34bb973939b3a32265979657f8b74ce41d24a4ebf862da6c747255983', 1, 2, NULL, '[]', 0, '2021-10-02 22:37:44', '2021-10-02 22:37:44', '2022-10-03 04:22:44'),
('5b619b24e1fbfdfe6dd2c471de94d620bc03c23ad58eb48d8c4848e6e38b6cede5ff535d90a98d98', 1, 2, NULL, '[]', 0, '2021-10-04 21:53:30', '2021-10-04 21:53:30', '2022-10-05 03:38:30'),
('6411656b7fa64470246bc86915dcf17c3ed2ce842bd810df8df75f8cf18a14344a8ebb0cd1a5a108', 1, 2, NULL, '[]', 0, '2021-10-05 01:33:42', '2021-10-05 01:33:42', '2022-10-05 07:18:42'),
('7b5d8407e88ca44fdc187cce8c0bc73d629b3e243ea1dc3356f5ab26a36d5863eb1ab8313bc361e8', 2, 2, NULL, '[]', 0, '2021-10-03 01:56:38', '2021-10-03 01:56:38', '2022-10-03 07:41:38'),
('83aac210df6b26f662fe35c707bff76cabd54c58e9fb0fcff3c42139ef59a732228c2fb179c5c2b4', 1, 2, NULL, '[]', 0, '2021-10-03 01:14:49', '2021-10-03 01:14:49', '2022-10-03 06:59:49'),
('905dc8b6fae83dfa0ebcf1f12307f39794d9422d45cee20e2977763795e40e5f50f28a72df2e9ff9', 1, 2, NULL, '[]', 0, '2021-10-07 12:15:01', '2021-10-07 12:15:01', '2022-10-07 18:00:01'),
('9e4f2404dd59c4441a0a6aadf5f93e6f22b73259e485ebed5c6d1bcba554b9cd6ad20e1c2ebaee71', 1, 2, NULL, '[]', 0, '2021-10-03 00:10:08', '2021-10-03 00:10:08', '2022-10-03 05:55:08'),
('a684bcb59429eba1b0ead68a9684369bfa95a919eb3ae058e64326f7ad16fc4b87f7c78d3135e1dd', 5, 2, NULL, '[]', 0, '2021-10-10 11:30:02', '2021-10-10 11:30:02', '2022-10-10 17:15:02'),
('b27863efee84456068bffa1dafe8f5cde682f401b897d23470aa03969a2d10ed4105fdf94a3f9fb7', 1, 2, NULL, '[]', 0, '2021-10-04 21:53:30', '2021-10-04 21:53:30', '2022-10-05 03:38:30'),
('b70154de25d4734a860086d36a210096ae731dff672ba81940776972f4fff04d476dc34c9142c73c', 1, 2, NULL, '[]', 0, '2021-10-09 21:59:42', '2021-10-09 21:59:42', '2022-10-10 03:44:42'),
('b8a0af34f0af16305e4be1db49b4e345192a68bcddf3841960f003b230d7723ad6e9aa6f11396e56', 1, 2, NULL, '[]', 0, '2021-10-02 22:37:09', '2021-10-02 22:37:09', '2022-10-03 04:22:09'),
('c1d35dd3a505b2590428f17a05922e51e437f5177df30e181c27ada6fedc7b1cb192c0b449625bbc', 1, 2, NULL, '[]', 0, '2021-10-03 01:05:38', '2021-10-03 01:05:38', '2022-10-03 06:50:38'),
('c349c6ad73bb016c31ae3a5c63a854251daffa3d3da51c4ca73f0115e8aceb791f94b283e7f4029d', 1, 2, NULL, '[]', 0, '2021-10-07 12:14:15', '2021-10-07 12:14:15', '2022-10-07 17:59:15'),
('c6571e22948bbe9c701eb7e7e19acb983ccce56f49a9c5f3e012cec60ab6eec9c942fadea02e2106', 1, 2, NULL, '[]', 0, '2021-10-02 23:25:18', '2021-10-02 23:25:18', '2022-10-03 05:10:18'),
('c7da638fb865192082385f3f6065760035f49d162a53fe27f13c27f0e89ccdc21002410c9e53ac62', 1, 2, NULL, '[]', 0, '2021-10-06 00:16:36', '2021-10-06 00:16:36', '2022-10-06 06:01:36'),
('dcddebf45b3fc367dc6114509160d3a30d63bb2df438c802fc270265e8f4b65381e055e78d95783f', 1, 2, NULL, '[]', 0, '2021-10-09 21:59:42', '2021-10-09 21:59:42', '2022-10-10 03:44:42'),
('e20af7a340aee39eaa0ffb1a2adb4af82fbfa77aa3735277562ac730dce57fd092991501e2c3ad55', 1, 2, NULL, '[]', 0, '2021-10-03 01:02:51', '2021-10-03 01:02:51', '2022-10-03 06:47:51'),
('e3e7d3a7f224fe2e5d2f46407ed4ccb50fad02a1cd2ebed3efece848ed91bb426d9d3b6cb5c1fbae', 3, 2, NULL, '[]', 0, '2021-10-10 09:34:07', '2021-10-10 09:34:07', '2022-10-10 15:19:07'),
('edc70c26565ce1cfb9b9ebb4335acbf2c7d8d44026ccf81cd59ad33006316b13d28c2566c3e77c4a', 1, 2, NULL, '[]', 0, '2021-10-07 12:25:31', '2021-10-07 12:25:31', '2022-10-07 18:10:31'),
('f5edd435a59bbf51b3faadc97965e1dd7aeec630da4cb94b426f7a14d5901ce01fa8f631c624c82a', 1, 2, NULL, '[]', 0, '2021-10-04 22:01:42', '2021-10-04 22:01:42', '2022-10-05 03:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', '3g8xYcwkDgmHjV269hkeBfgIh666Wmmivvh2ukBT', NULL, 'http://localhost', 1, 0, 0, '2021-10-02 09:18:37', '2021-10-02 09:18:37'),
(2, NULL, 'Laravel Password Grant Client', 'osyXMHxau0k0ReAeYTCy8WZlxu1zHcvgZRFvL9Om', 'users', 'http://localhost', 0, 1, 0, '2021-10-02 09:18:38', '2021-10-02 09:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-10-02 09:18:37', '2021-10-02 09:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('015b1faac7ec0358fbf8f3ab52bfa82a87229a6b06ca14e596f9e82af0303025055b7d9e72b80e79', 'c1d35dd3a505b2590428f17a05922e51e437f5177df30e181c27ada6fedc7b1cb192c0b449625bbc', 0, '2022-10-03 06:50:38'),
('18e885d03ef880570acfc50dcfaf19d3d3f2058e3016415b5fdb9246b138f2dd78dc65d58753174b', '4add43efc5850f048220bc410f305964e50ca66bab54869f6504746ffeb7b699876cb482eadb5b47', 0, '2022-10-02 17:28:15'),
('1a7906315e813d5b52757b38d68124dc6e2fdbc7e6cdc93f80fa2b6257415b0eb911bf221806e504', '13784df9f18a669e053c68807123a1bf2e1e388f51c25e4a32b6e2624f1e9f99d9beb770543d6265', 0, '2022-10-06 04:48:44'),
('1b948e72831fd24ec3d2738acd65d05015c0fc7222a25649398c062e0142fb306b4518f9202ebf8f', 'b8a0af34f0af16305e4be1db49b4e345192a68bcddf3841960f003b230d7723ad6e9aa6f11396e56', 0, '2022-10-03 04:22:10'),
('1dcb0032c4f9448a56e23d7a4985656c590b1dc3b370e231cba3ba74cbf8da6428499319ac0975cf', '1ffe44b043b9f95c2856099962ac390030f704850ec41c7ea8d12326c3506ffa58d51bb4535e2b0b', 0, '2022-10-03 11:42:14'),
('38b83030d0597f021773a07301bb2cdf269b759675baef1e137e20ca00fbf3597ea87e76ef4d7029', '36cd7ef0549009e3873929bde8d85fa8cbbfccfc1721410b30caf095be6e8bfbc4ddc0d112db9e96', 0, '2022-10-07 17:59:16'),
('3b050b5fe72594901a759612ab605152fe4eaf0bf11dac15d6a99e567da4e7fd086fff34bd8d14e9', 'e20af7a340aee39eaa0ffb1a2adb4af82fbfa77aa3735277562ac730dce57fd092991501e2c3ad55', 0, '2022-10-03 06:47:51'),
('4a2de32859469c80e6f625e11a9beba3a046f53735ac3d2c399b43cb59f311d3f840fc50e8df6359', 'f5edd435a59bbf51b3faadc97965e1dd7aeec630da4cb94b426f7a14d5901ce01fa8f631c624c82a', 0, '2022-10-05 03:46:42'),
('4c75ac0d91932ac9ecf48a1e60be9d82aecd92fb0b97127ca7b8d8881422646350014f2f1a146329', 'b27863efee84456068bffa1dafe8f5cde682f401b897d23470aa03969a2d10ed4105fdf94a3f9fb7', 0, '2022-10-05 03:38:32'),
('595a0b9e4d71b02a14f314aaaa867dd5c9012d99ab6bf388e365379af473f860af0b2b5ad6a72d03', '52dee9b4ed40e8cf527542a34bb973939b3a32265979657f8b74ce41d24a4ebf862da6c747255983', 0, '2022-10-03 04:22:44'),
('5ae47f8f89047def7cbdc6de60166b828401828cde4a68d700749248316a31037e28dff5873a79d0', '6411656b7fa64470246bc86915dcf17c3ed2ce842bd810df8df75f8cf18a14344a8ebb0cd1a5a108', 0, '2022-10-05 07:18:42'),
('5c4c997c4235f655e882327912c6ad3d7de6969d6fbdfbc1f0f5161d64f5fff2f853fe45ebe5598b', 'c349c6ad73bb016c31ae3a5c63a854251daffa3d3da51c4ca73f0115e8aceb791f94b283e7f4029d', 0, '2022-10-07 17:59:16'),
('5cec31d72a53c9ccc8b78abe1192aee49fd9d360a2a0ce511fef8b626f65d7ad33146d0091ef42c0', 'c6571e22948bbe9c701eb7e7e19acb983ccce56f49a9c5f3e012cec60ab6eec9c942fadea02e2106', 0, '2022-10-03 05:10:18'),
('6356120a2a5aef8db5dd2a2de4ddb5da2e3b350802503e24a05a3e94a644f72484d688a911843d09', '2a27a4abf3f26abe0151b586cef5dc978fbf69a71182c3d83ef024905298d2b780c3c81d102d41b0', 0, '2022-10-03 05:54:16'),
('69f5864daddc07a1b26b7951bc7b762038748daeecaa7dea721a9b220563972aa56144f72dbab8a4', '0dde5c50899fc0dd691ae8254cd951953520db58206a8a481042bc1c9cea62ffde0c0f3243157ce1', 0, '2022-10-05 03:38:32'),
('7af7ed69f430ffaff8eabd86a7a0a74f632d8b11c3beeb57e259f05b5b3f91b034fa36d1fb146d2e', 'edc70c26565ce1cfb9b9ebb4335acbf2c7d8d44026ccf81cd59ad33006316b13d28c2566c3e77c4a', 0, '2022-10-07 18:10:32'),
('8ce2be11949db80bb0a1f78e959c7646783da38462f8124b1e2d33de1045ada1a80ac6fe24d8df27', '83aac210df6b26f662fe35c707bff76cabd54c58e9fb0fcff3c42139ef59a732228c2fb179c5c2b4', 0, '2022-10-03 06:59:49'),
('9c3a0ff2b8208f6c5bb28ad422b1127686f13124b57998a6ce65360e1e805f9f4dc179b8ff97558d', 'b70154de25d4734a860086d36a210096ae731dff672ba81940776972f4fff04d476dc34c9142c73c', 0, '2022-10-10 03:44:42'),
('a3dc8d59a8d8a3dd7108ec1e9e6723284ad55b6b16f8b7de643c5a92b74215c734b7f165839a087f', 'c7da638fb865192082385f3f6065760035f49d162a53fe27f13c27f0e89ccdc21002410c9e53ac62', 0, '2022-10-06 06:01:36'),
('aa99539e0d8e2bddb219a555c94380898a7a4f7c5959ff9f111de1698c132f43a3f64126bf972ad7', '053e04c5239a89fdde67f3f05244501ff44680301a79da355aaee4657df6834f12ab5a303f071353', 0, '2022-10-06 04:48:44'),
('b459d54c61b971708369d8a5a4ed38ba46122b27e00c2a850d189f1876a0d07df3d90f691a5ae3b5', '26d5e1e974138bfc1034473a97b77bf384350623cbd6aa620d2061ac7d5c2d9757f7b31324f73736', 0, '2022-10-05 07:18:42'),
('b4b4f3daa58e1b07506a0e32cc8135a037b8c091e8db93b455b8bce16156d90d136d6d15f6ae936e', '310bf2f5a1cf3bdce7f77826e03bf6360a7f187fd0034c72b44a5e2e9e0306f161446f1b7cefd426', 0, '2022-10-06 08:14:20'),
('b643e3ac413009bf29c16d767ad0b6d547e702e54be26034dd8a2bff69be3405b40340783fa46b18', 'a684bcb59429eba1b0ead68a9684369bfa95a919eb3ae058e64326f7ad16fc4b87f7c78d3135e1dd', 0, '2022-10-10 17:15:02'),
('bfbb236809bacb02b0e9b9206252ad3828c36e51025f97aa4a060edff21a2992e990dc1de83a24e0', '7b5d8407e88ca44fdc187cce8c0bc73d629b3e243ea1dc3356f5ab26a36d5863eb1ab8313bc361e8', 0, '2022-10-03 07:41:38'),
('c8c75f214c89c47e06966a63cf82e68b36c3350246405b5aa7aafbd19eb01fb77bcf8894633cb713', '9e4f2404dd59c4441a0a6aadf5f93e6f22b73259e485ebed5c6d1bcba554b9cd6ad20e1c2ebaee71', 0, '2022-10-03 05:55:08'),
('da73d3611e70c5af7dc5d4cc91dae034e901fc05743ccc8e8ee2cb6deb87e19299025b29798abc19', 'dcddebf45b3fc367dc6114509160d3a30d63bb2df438c802fc270265e8f4b65381e055e78d95783f', 0, '2022-10-10 03:44:42'),
('dea92deba1fa6f738531e49f8c9868c4cd7431970a18fda610a09a3509ecde2069e8f6e557829e69', '06ad7965fa075e091c98360f7e62c777828a56454a30784a22385fd6a082493625e4a5d3aef2a939', 0, '2022-10-03 12:17:36'),
('f0dfaf53ce920aba133fe61504c5bd739497171470ba334978bdecd2af0945f53bffa639b66ee607', '2124ea9fbb016d24cbfa52c968ea3204c2f6b9c8725dcbcaba3f1c6cd631fbe16e2961ea5f450ed2', 0, '2022-10-03 08:12:07'),
('f0fbc314e963cff1be587ad9317d164f2109a074713d7bbb9d9a0f339bdb00c94e5d4bd26e091709', '5b619b24e1fbfdfe6dd2c471de94d620bc03c23ad58eb48d8c4848e6e38b6cede5ff535d90a98d98', 0, '2022-10-05 03:38:32'),
('f285d9739151092d8b7c98122fa30835d660bd41a54a2b6eaabf6eab32521f22ca6112d80f10abb1', '905dc8b6fae83dfa0ebcf1f12307f39794d9422d45cee20e2977763795e40e5f50f28a72df2e9ff9', 0, '2022-10-07 18:00:01'),
('f51d6c01746642a2da59b11f3647908c0f4684dbf3b5968470670924dd325372706639ae8c2a06ca', '19fb4a08ed19bb979d753fb717d601b46be646db6a2726552cb8da01e9977ae9a7a9e8e68e7eb3d7', 0, '2022-10-03 06:33:43'),
('f852c1477985244f2b06452a33a2455ae1f28e4a727ba987fcf7b8baf2c54f5337db26265077b4da', 'e3e7d3a7f224fe2e5d2f46407ed4ccb50fad02a1cd2ebed3efece848ed91bb426d9d3b6cb5c1fbae', 0, '2022-10-10 15:19:07'),
('fd3c0ee4b72513653b75435c69718770d731a9cdfcc5d1e7cc24a5896c7bf9dda75960c69d496ef2', '047206f119060e596c4d8d3cec6647eb9513f26dc194e2eead998c11bfb8eeee6f0cc2f3fbd54652', 0, '2022-10-06 08:34:13');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_admin` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `last_login_time` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `phone_no`, `is_active`, `is_admin`, `last_login_time`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'User', 'user@gmail.com', NULL, '$2y$10$jW6fyXiZ8Q9QvCPgHP6SEuOKXdStgU3/POat59oRJJE2677vujl3a', 'profile-1633505119-80c6e412f5643d3d89fde2e7d8538ca3.png', '9849576958', '1', '0', NULL, NULL, '2021-10-02 11:28:16', '2021-10-06 01:40:48', NULL),
(5, 'Admin', 'admin@gmail.com', NULL, '$2y$10$jW6fyXiZ8Q9QvCPgHP6SEuOKXdStgU3/POat59oRJJE2677vujl3a', '', '9849576958', '1', '1', NULL, NULL, '2021-10-02 11:28:16', '2021-10-06 01:40:48', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertisements_name_index` (`name`),
  ADD KEY `advertisements_created_by_index` (`created_by`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_is_active_index` (`is_active`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaigns_name_index` (`name`),
  ADD KEY `campaigns_slug_index` (`slug`),
  ADD KEY `campaigns_created_by_index` (`created_by`),
  ADD KEY `campaigns_category_id_index` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_is_active_index` (`is_active`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_meta_key_index` (`meta_key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_is_active_index` (`is_active`),
  ADD KEY `users_is_admin_index` (`is_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `advertisements_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `campaigns_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
