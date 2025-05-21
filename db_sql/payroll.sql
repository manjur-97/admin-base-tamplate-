-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 12:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_bn` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `meta_title` varchar(500) DEFAULT NULL,
  `meta_description` varchar(2000) DEFAULT NULL,
  `meta_keyword` varchar(1000) DEFAULT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title_en`, `title_bn`, `photo`, `slug`, `meta_title`, `meta_description`, `meta_keyword`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Honorable Education Minister Mahibul Hasan Chowdhury at Bhashamela 2024', 'ভাষামেলা ২০২৪-এ মাননীয় শিক্ষামন্ত্রী মহিবুল হাসান চৌধুরী', '../storage/gallery/gallery-14.jpeg', 'language-day-celebration', 'Language Diversity Event', 'Celebrate linguistic diversity on International Mother Language Day.', 'languages, cultural diversity, celebration', 'Active', NULL, NULL, NULL),
(2, 'Dr. is presenting the main article in National Seminar 2024. Muhammad Zafar Iqbal', 'জাতীয় সেমিনার ২০২৪-এ মূল প্রবন্ধ উপস্থাপন করছেন ড. মুহম্মদ জাফর ইকবাল', '../storage/gallery/gallery-13.jpeg', 'multilingual-symposium', 'Exploring Language Varieties', 'An event discussing the richness of languages across the globe.', 'symposium, languages, diversity', 'Active', NULL, NULL, NULL),
(3, 'Honourable Education Minister Mahibul Hasan Chowdhury is delivering the chief guest address at the National Seminar 2024', 'জাতীয় সেমিনার ২০২৪-এ প্রধান অতিথির ভাষণ দিচ্ছেন মাননীয় শিক্ষামন্ত্রী মহিবুল হাসান চৌধুরী', '../storage/gallery/gallery-12.jpeg', 'language-diversity-workshop', 'Interactive Language Session', 'Engage in discussions and activities promoting language diversity.', 'workshop, language diversity, interactive session', 'Active', NULL, NULL, NULL),
(4, 'Amais Director General Prof. Dr. Hakim Arif', 'জাতীয় সেমিনার ২০২৪-এ সভাপতির বক্তব্য দিচ্ছেন আমাই-এর মহাপরিচালক প্রফেসর ড. হাকিম আরিফ', '../storage/gallery/gallery-11.jpeg', 'cultural-exchange-program', 'Connecting Through Culture', 'A program fostering understanding through cultural exchange.', 'cultural exchange, cultural diversity, global connections', 'Active', NULL, NULL, NULL),
(5, 'Question and answer session at National Seminar 2024', 'জাতীয় সেমিনার ২০২৪-এ প্রশ্নোত্তর পর্ব', '../storage/gallery/gallery-10.jpeg', 'global-language-symposium', 'Exploring Worldwide Linguistics', 'An event delving into languages spoken across the globe.', 'symposium, global languages, linguistic exploration', 'Active', NULL, NULL, NULL),
(6, 'Stalls of Bhashamela 2024', 'ভাষামেলা ২০২৪-এর স্টলসমূহ', '../storage/gallery/gallery-9.jpeg', 'youth-language-exchange', 'Empowering Youth Through Language', 'An initiative for young people to exchange linguistic experiences.', 'youth, language exchange, empowerment', 'Active', NULL, NULL, NULL),
(7, 'International seminar 2024, the speaker. Sishir Bhattacharya', 'আন্তর্জাতিক সেমিনার ২০২৪-এ আলোচক ড. শিশির ভট্টাচার্য্য', '../storage/gallery/gallery-8.jpeg', 'language-education-symposium', 'Advancing Language Education', 'A symposium focusing on innovations in language education.', 'language education, symposium, innovations', 'Active', NULL, NULL, NULL),
(8, 'Question and Answer Session at International Seminar 2024', 'আন্তর্জাতিক সেমিনার ২০২৪-এ প্রশ্নোত্তর পর্ব', '../storage/gallery/gallery-1.jpeg', 'linguistic-heritage-exhibition', 'Preserving Linguistic Heritage', 'An exhibition showcasing the rich linguistic heritage of different cultures.', 'linguistic heritage, exhibition, cultural diversity', 'Active', NULL, NULL, NULL),
(9, 'The chief guest of the closing ceremony of the International Seminar 2024, Vice Chancellor of Dhaka University. S. M. Maqsood Kamal', 'আন্তর্জাতিক সেমিনার ২০২৪-এর সমাপনী অনুষ্ঠানের প্রধান অতিথি ঢাকা বিশ্ববিদ্যালয়ের উপাচার্য এ. এস. এম. মাকসুদ কামাল', '../storage/gallery/gallery-2.jpeg', 'linguistic-innovation-hackathon', 'Promoting Creative Language Solutions', 'A hackathon challenging participants to come up with innovative solutions in language-related fields.', 'hackathon, linguistic innovation, creative solutions', 'Active', NULL, NULL, NULL),
(10, 'Professor Dr. is presenting the main article in the international seminar 2024. Holy government', 'আন্তর্জাতিক সেমিনার ২০২৪-এ মূল প্রবন্ধ উপস্থাপন করছেন অধ্যাপক ড. পবিত্র সরকার', '../storage/gallery/gallery-3.jpeg', 'online-language-learning-fair', 'Explore Diverse Language Learning Platforms', 'A virtual fair showcasing various online platforms for language learning and education.', 'language learning, online fair, education platforms', 'Active', NULL, NULL, NULL),
(11, 'Minority group performance for Bhashamela 2024 audience', 'ভাষামেলা ২০২৪-এর দর্শকদের জন্য ক্ষুদ্র নৃগোষ্ঠীর পরিবেশনা', '../storage/gallery/gallery-4.jpeg', 'language-technology-symposium', 'Exploring Technological Advancements in Language', 'A symposium focusing on the latest technological developments in the field of language.', 'language technology, symposium, technological advancements', 'Active', NULL, NULL, NULL),
(12, 'Children drawing competition organized on the occasion of Great Martyrs Day and International Mother Language Day 2024', 'মহান শহিদ দিবস ও আন্তর্জাতিক মাতৃভাষা দিবস ২০২৪ উপলক্ষ্যে আয়োজিত শিশু চিত্রাঙ্কন প্রতিযোগিতা', '../storage/gallery/gallery-5.jpeg', 'multilingual-literature-festival', 'Celebrating Diversity Through Literature', 'A literary festival showcasing the richness of literature in multiple languages.', 'literature, multilingual, cultural diversity', 'Active', NULL, NULL, NULL),
(13, 'Participation of children with special needs in childrens drawing competition organized on the occasion of Great Martyrs Day and International Mother Language Day 2024', 'মহান শহিদ দিবস ও আন্তর্জাতিক মাতৃভাষা দিবস ২০২৪ উপলক্ষ্যে আয়োজিত শিশু চিত্রাঙ্কন প্রতিযোগিতায় বিশেষ চাহিদাসম্পন্ন শিশুদের অংশগ্রহণ', '../storage/gallery/gallery-6.jpeg', 'language-preservation-symposium', 'Preserving Endangered Languages', 'A symposium discussing strategies for the preservation of endangered languages.', 'language preservation, symposium, endangered languages', 'Active', NULL, NULL, NULL),
(14, 'Participation of foreign children in childrens drawing competition organized on the occasion of Great Martyrs Day and International Mother Language Day 2024', 'মহান শহিদ দিবস ও আন্তর্জাতিক মাতৃভাষা দিবস ২০২৪ উপলক্ষ্যে আয়োজিত শিশু চিত্রাঙ্কন প্রতিযোগিতায় বিদেশি শিশুদের অংশগ্রহণ', '../storage/gallery/gallery-7.jpeg', 'global-language-diversity-forum', 'Fostering Global Language Collaboration', 'A forum bringing together experts to discuss and promote global language diversity.', 'language diversity, forum, global collaboration', 'Active', NULL, NULL, NULL),
(15, 'Minority Language Education Evaluation Workshop', 'ক্ষুদ্র নৃ-গোষ্ঠীর ভাষা শিক্ষা মূল্যায়ন কর্মশালা', '../storage/gallery/gallery-16.jpeg', 'global-language-diversity-forum', 'Fostering Global Language Collaboration', 'A forum bringing together experts to discuss and promote global language diversity.', 'language diversity, forum, global collaboration', 'Active', NULL, NULL, NULL),
(16, 'Question and answer session at the workshop on “Mother Tongue Based Multilingual Education”.', ' “মাতৃভাষাভিত্তিক বহুভাষী শিক্ষা” বিষয়ক কর্মশালায় প্রশ্নোত্তর পর্ব', '../storage/gallery/gallery-17.jpeg', 'global-language-diversity-forum', 'Fostering Global Language Collaboration', 'A forum bringing together experts to discuss and promote global language diversity.', 'language diversity, forum, global collaboration', 'Active', NULL, NULL, NULL),
(17, 'Workshop on “Sign Language as Mother Language”.', '“মাতৃভাষা হিসেবে ইশারা ভাষা” শীর্ষক কর্মশালা', '../storage/gallery/gallery-18.jpeg', 'global-language-diversity-forum', 'Fostering Global Language Collaboration', 'A forum bringing together experts to discuss and promote global language diversity.', 'language diversity, forum, global collaboration', 'Active', NULL, NULL, NULL),
(18, 'Paper presented at the Workshop on “Mother Tongue Based Multilingual Education”.', '“মাতৃভাষাভিত্তিক বহুভাষী শিক্ষা” বিষয়ক কর্মশালায় প্রবন্ধ উপস্থাপন', '../storage/gallery/gallery-19.jpeg', 'global-language-diversity-forum', 'Fostering Global Language Collaboration', 'A forum bringing together experts to discuss and promote global language diversity.', 'language diversity, forum, global collaboration', 'Active', NULL, NULL, NULL),
(19, 'Workshop on Translation', 'অনুবাদ বিষয়ক কর্মশালা', '../storage/gallery/gallery-20.jpeg', 'global-language-diversity-forum', 'Fostering Global Language Collaboration', 'A forum bringing together experts to discuss and promote global language diversity.', 'language diversity, forum, global collaboration', 'Active', NULL, NULL, NULL),
(20, 'Introduction phase of Amai officials with researchers', 'গবেষকদের সঙ্গে আমাই কর্মকর্তাদের পরিচিতি পর্ব', '../storage/gallery/gallery-21.jpeg', 'global-language-diversity-forum', 'Fostering Global Language Collaboration', 'A forum bringing together experts to discuss and promote global language diversity.', 'language diversity, forum, global collaboration', 'Active', NULL, NULL, NULL),
(21, 'Honorable Secretary of Secondary and Higher Education Department of Ministry of Education Soleman Khan is speaking as the chief guest in the seminar titled \"Bangla Banan: Present Situation, Future Actions\".', ' “বাংলা বানান: বর্তমান পরিস্থিতি, ভবিষ্যত করণীয়” শীর্ষক সেমিনারে প্রধান অতিথির বক্তব্য দিচ্ছেন শিক্ষা মন্ত্রণালয়ের মাধ্যমিক ও উচ্চ শিক্ষা বিভাগের সম্মানিত সচিব সোলেমান খান', '../storage/gallery/gallery-22.jpeg', 'global-language-diversity-forum', 'Fostering Global Language Collaboration', 'A forum bringing together experts to discuss and promote global language diversity.', 'language diversity, forum, global collaboration', 'Active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(228) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `address` varchar(2000) DEFAULT NULL,
  `sorting` int(11) NOT NULL DEFAULT 1,
  `status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `role_id`, `photo`, `address`, `sorting`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Software ', 'Developer ', 'admin@gmail.com', '01612423280', '$2y$10$rqQNq7t8GbzK8eCB2g.S6.sc0.khaDYyNwihzFDE4uYrz2v/DduoK', 1, NULL, 'Head Office', 1, 'Active', NULL, '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(2, 'Manjur', 'Rahman', 'monjur.rahman.1422@gmail.com', '01632480646', '$2y$10$BeyIz8AJjEJ54aXVthUVSeSpaDY1AoL9I5hspzhWy2sJyOde.rTpa', 2, 'users/1728282652.jpg', 'Dhaka Cantonment', 1, 'Active', NULL, '2024-10-07 00:30:52', '2024-10-07 00:30:52', NULL);
(2, 'Ishrat', 'Zahan', 'ishratjahan260@gmail.com', '01799217813', '$2y$10$BeyIz8AJjEJ54aXVthUVSeSpaDY1AoL9I5hspzhWy2sJyOde.rTpa', 2, 'users/1728282652.jpg', 'Mirpur', 1, 'Active', NULL, '2024-10-07 00:30:52', '2024-10-07 00:30:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE `commands` (
  `id` int(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `database_table` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commands`
--

INSERT INTO `commands` (`id`, `model`, `controller`, `database_table`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'Model', 'Controller', 'Table name', '2024-03-17', '2024-03-17 05:42:21', '2024-03-17 05:42:21', 'Deleted'),
(2, 'P', 'PController', 'ps', '2024-03-17', '2024-03-17 01:21:06', '2024-03-17 01:21:06', 'Deleted'),
(6, 'xxx', 'xxxx', 'xxx', '2024-03-17', '2024-03-17 05:42:18', '2024-03-17 05:42:18', 'Deleted'),
(7, 'fsdf', 'sdfsdf', 'sdfsd', '2024-03-17', '2024-03-17 05:42:16', '2024-03-17 05:42:16', 'Deleted'),
(8, 'Menu', 'MenuController', 'menus', '2024-03-17', '2024-03-17 05:55:21', NULL, 'Active'),
(9, 'Researche', 'ResearcheController', 'researches', '2024-03-17', '2024-03-17 05:56:55', NULL, 'Active'),
(10, 'Research', 'ResearchController', 'researches', '2024-03-17', '2024-03-17 06:04:10', NULL, 'Active'),
(11, 'Student', 'StudentController', 'students', '2024-03-17', '2024-03-17 09:22:38', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sorting` int(11) NOT NULL DEFAULT 1,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `permission_name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `icon`, `route`, `description`, `sorting`, `parent_id`, `permission_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dashboard', 'home', 'backend.dashboard', NULL, 1, NULL, 'dashboard', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(2, 'User Manage', 'list', NULL, NULL, 1, NULL, 'user-management', 'Inactive', '2024-03-17 05:43:00', '2024-03-17 05:43:00', NULL),
(3, 'User Add', 'plus-circle', 'backend.user.create', NULL, 1, 2, 'admin-add', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(4, 'User List', 'list', 'backend.user.index', NULL, 1, 2, 'admin-list', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(5, 'Permission Manage', 'unlock', NULL, NULL, 1, NULL, 'permission-management', 'Inactive', '2024-03-17 05:43:07', '2024-03-17 05:43:07', NULL),
(6, 'Permission Add', 'plus-circle', 'backend.permission.create', NULL, 1, 5, 'permission-add', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(7, 'Permission List', 'list', 'backend.permission.index', NULL, 1, 5, 'permission-list', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(8, 'Role Manage', 'layers', NULL, NULL, 1, NULL, 'role-management', 'Inactive', '2024-03-17 05:43:14', '2024-03-17 05:43:14', NULL),
(9, 'Role Add', 'plus-circle', 'backend.role.create', NULL, 1, 8, 'role-add', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(10, 'Role List', 'list', 'backend.role.index', NULL, 1, 8, 'role-list', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(11, 'Front Menu Manage', 'layers', NULL, NULL, 1, NULL, 'front-menu-management', 'Inactive', '2024-03-16 07:41:12', '2024-03-16 07:41:12', NULL),
(12, 'Front Menu Add', 'plus-circle', 'backend.front-menu.create', NULL, 1, 11, 'role-add', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(13, 'Front Menu List', 'list', 'backend.front-menu.index', NULL, 1, 11, 'role-list', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(14, 'Slider Manage', 'layers', NULL, NULL, 1, NULL, 'front-menu-management', 'Inactive', '2024-03-16 07:41:03', '2024-03-16 07:41:03', NULL),
(15, 'Slider Add', 'plus-circle', 'backend.slider.create', NULL, 1, 14, 'role-add', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(16, 'Slider List', 'list', 'backend.slider.index', NULL, 1, 14, 'role-list', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(17, 'Activity Manage', 'layers', NULL, NULL, 1, NULL, 'front-menu-management', 'Inactive', '2024-03-16 07:40:56', '2024-03-16 07:40:56', NULL),
(18, 'Activity Add', 'plus-circle', 'backend.activity.create', NULL, 1, 17, 'role-add', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(19, 'Activity List', 'list', 'backend.activity.index', NULL, 1, 17, 'role-list', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(38, 'Page Manage', 'layers', NULL, NULL, 1, NULL, 'front-menu-management', 'Inactive', '2024-03-16 07:40:04', '2024-03-16 07:40:04', NULL),
(39, 'Page Add', 'plus-circle', 'backend.page.create', NULL, 1, 38, 'role-add', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(40, 'Page List', 'list', 'backend.page.index', NULL, 1, 38, 'role-list', 'Active', '2024-03-08 15:40:36', '2024-03-08 15:40:36', NULL),
(53, 'Menu', 'layers', '', '', 1, NULL, 'front-menu-management', 'Inactive', '2024-03-17 08:37:44', '2024-03-17 08:37:44', NULL),
(54, 'Menu List', 'list', 'backend.menu.index', '', 1, 53, 'role-list', 'Active', '2024-03-17 05:55:21', '2024-03-17 05:55:21', NULL),
(55, 'Menu Add', 'list', 'backend.menu.create', '', 1, 53, 'role-add', 'Active', '2024-03-17 05:55:21', '2024-03-17 05:55:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2020_05_21_100000_create_teams_table', 1),
(8, '2020_05_21_200000_create_team_user_table', 1),
(9, '2020_05_21_300000_create_team_invitations_table', 1),
(10, '2024_01_14_082419_create_sessions_table', 1),
(11, '2024_01_14_111722_create_permission_tables', 1),
(12, '2024_01_18_050956_create_menus_table', 1),
(13, '2024_01_18_051132_create_companies_table', 1),
(14, '2024_01_22_202539_create_system_error_logs_table', 1),
(15, '2024_01_30_051133_create_admins_table', 1),
(16, '2024_02_28_081625_create_sliders_table', 1),
(17, '2024_02_28_082702_create_front_menus_table', 1),
(18, '2024_02_29_043437_create_activities_table', 1),
(19, '2024_02_29_043822_create_descriptions_table', 1),
(20, '2024_03_02_041618_create_publications_table', 1),
(21, '2024_03_02_062603_create_research_table', 1),
(22, '2024_03_03_101903_create_journals_table', 1),
(23, '2024_03_03_102527_create_seminars_table', 1),
(24, '2024_03_03_104713_create_training_workshops_table', 1),
(25, '2024_03_05_050731_create_books_table', 1),
(26, '2024_03_05_053450_create_pages_table', 1),
(27, '2024_03_05_054056_create_galleries_table', 1),
(28, '2025_01_22_202706_create_system_logs_table', 1),
(29, '2024_10_05_042216_create_role_permissions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `parent_id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'dashboard', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(2, NULL, 'permission-management', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(3, 2, 'permission-add', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(4, 3, 'permission-create', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(5, 2, 'permission-list', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(6, 5, 'permission-edit', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(7, 5, 'permission-update', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(8, 5, 'permission-delete', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(9, NULL, 'role-management', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(10, 9, 'role-add', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(11, 10, 'role-create', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(12, 9, 'role-list', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(13, 12, 'role-edit', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(14, 12, 'role-update', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(15, 12, 'role-delete', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(16, NULL, 'user-management', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(17, 16, 'user-add', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(18, 17, 'user-create', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(19, 16, 'user-list', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(20, 19, 'user-status-change', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(21, 19, 'user-edit', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(22, 19, 'user-update', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36'),
(23, 19, 'user-delete', 'admin', '2024-03-08 15:40:36', '2024-03-08 15:40:36');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', '2024-10-04 14:01:01', '2024-10-04 14:01:01'),
(2, 'Admin', 'admin', '2024-10-07 04:53:47', '2024-10-07 04:53:47'),
(4, 'manjur', 'admin', '2024-10-07 03:28:31', '2024-10-07 03:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `uri` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `controller_function` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `controller_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `uri`, `name`, `controller_function`, `method`, `controller_name`, `created_at`, `updated_at`) VALUES
(43, 2, 'backend.role.index', 'Role Index', 'index', 'GET|HEAD', 'RoleController', '2024-10-07 04:53:47', '2024-10-07 04:53:47'),
(44, 2, 'backend.role.create', 'Role Create', 'create', 'GET|HEAD', 'RoleController', '2024-10-07 04:53:47', '2024-10-07 04:53:47'),
(45, 2, 'backend.role.store', 'Role Store', 'store', 'POST', 'RoleController', '2024-10-07 04:53:47', '2024-10-07 04:53:47'),
(46, 2, 'backend.role.show', 'Role Show', 'show', 'GET|HEAD', 'RoleController', '2024-10-07 04:53:47', '2024-10-07 04:53:47'),
(47, 2, 'backend.role.edit', 'Role Edit', 'edit', 'GET|HEAD', 'RoleController', '2024-10-07 04:53:47', '2024-10-07 04:53:47'),
(48, 2, 'backend.role.update', 'Role Update', 'update', 'PUT|PATCH', 'RoleController', '2024-10-07 04:53:47', '2024-10-07 04:53:47'),
(49, 2, 'backend.role.destroy', 'Role Destroy', 'destroy', 'DELETE', 'RoleController', '2024-10-07 04:53:47', '2024-10-07 04:53:47'),
(50, 2, 'backend.dashboard', 'Dashboard', 'index', 'GET|HEAD', 'DashboardController', '2024-10-07 04:53:47', '2024-10-07 04:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section` int(11) DEFAULT NULL,
  `block` int(11) DEFAULT NULL,
  `section_type` text DEFAULT NULL,
  `attendence_bonus` text DEFAULT NULL,
  `attendence_basic` text DEFAULT NULL,
  `medical` text DEFAULT NULL,
  `medical_basic` text DEFAULT NULL,
  `house_rent` text DEFAULT NULL,
  `house_rent_basic` text DEFAULT NULL,
  `no_work` text DEFAULT NULL,
  `no_work_basic` text DEFAULT NULL,
  `overtime` text DEFAULT NULL,
  `overtime_basic` text DEFAULT NULL,
  `convince` text DEFAULT NULL,
  `convince_basic` text DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('mOp0YIsn3jBV0hD6iOgxTcCwyFhjNUWEFtH630OT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia1pHWlNNNGVqUnBoU00xTWZHek52dEpTUEZwYVFBS0QwRGJ0ZHpzcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYmFja2VuZC9yb2xlIjt9fQ==', 1728298446);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `roll` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'Active',
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `roll`, `mobile`, `address`, `updated_at`, `created_at`, `deleted_at`, `status`, `image`) VALUES
(1, 'Manjur Rahman', '100', '01366501365', 'Dhaka', '2024-03-17 15:40:47', '2024-03-17 09:40:47', NULL, 'Active', 'students/1710689056.jpg'),
(2, 'Ishrat', '100', '01366501365', 'asdasdasd', '2024-03-17 16:05:09', '2024-03-17 10:05:09', NULL, 'Active', 'students/1710691509.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `system_error_logs`
--

CREATE TABLE `system_error_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namespace` enum('Backend') NOT NULL DEFAULT 'Backend',
  `controller` varchar(255) DEFAULT NULL,
  `function` varchar(255) DEFAULT NULL,
  `log` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_error_logs`
--

INSERT INTO `system_error_logs` (`id`, `namespace`, `controller`, `function`, `log`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Backend', 'ResearchController', 'changeStatus', 'Add [status] to fillable property to allow mass assignment on [App\\Models\\Research].', '2024-03-10 13:32:38', '2024-03-10 13:32:38', NULL),
(2, 'Backend', 'ResearchController', 'changeStatus', 'Add [status] to fillable property to allow mass assignment on [App\\Models\\Research].', '2024-03-10 13:32:47', '2024-03-10 13:32:47', NULL),
(3, 'Backend', 'ResearchController', 'changeStatus', 'Add [status] to fillable property to allow mass assignment on [App\\Models\\Research].', '2024-03-10 13:33:00', '2024-03-10 13:33:00', NULL),
(4, 'Backend', 'ResearchController', 'update', 'Add [title_en] to fillable property to allow mass assignment on [App\\Models\\Research].', '2024-03-10 13:33:56', '2024-03-10 13:33:56', NULL),
(5, 'Backend', 'ResearchController', 'update', 'Add [title_en] to fillable property to allow mass assignment on [App\\Models\\Research].', '2024-03-10 13:34:12', '2024-03-10 13:34:12', NULL),
(6, 'Backend', 'ResearchController', 'update', 'Add [title_en] to fillable property to allow mass assignment on [App\\Models\\Research].', '2024-03-10 13:36:59', '2024-03-10 13:36:59', NULL),
(7, 'Backend', 'ResearchController', 'store', 'Add [title_en] to fillable property to allow mass assignment on [App\\Models\\Research].', '2024-03-10 13:39:34', '2024-03-10 13:39:34', NULL),
(8, 'Backend', 'ResearchController', 'store', 'Add [title_en] to fillable property to allow mass assignment on [App\\Models\\Research].', '2024-03-10 13:42:23', '2024-03-10 13:42:23', NULL),
(9, 'Backend', 'TestController', 'changeStatus', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'status\' in \'field list\' (SQL: update `tests` set `created_at` = 2024-03-11 07:09:28, `status` = Active, `tests`.`updated_at` = 2024-03-11 07:09:28 where `id` = 2)', '2024-03-11 01:09:28', '2024-03-11 01:09:28', NULL),
(10, 'Backend', 'TestController', 'destroy', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'status\' in \'field list\' (SQL: update `tests` set `created_at` = 2024-03-11 07:09:41, `deleted_at` = 2024-03-11 07:09:41, `status` = Deleted, `tests`.`updated_at` = 2024-03-11 07:09:41 where `id` = 2)', '2024-03-11 01:09:41', '2024-03-11 01:09:41', NULL),
(11, 'Backend', 'TestController', 'destroy', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'status\' in \'field list\' (SQL: update `tests` set `created_at` = 2024-03-11 07:09:48, `deleted_at` = 2024-03-11 07:09:48, `status` = Deleted, `tests`.`updated_at` = 2024-03-11 07:09:48 where `id` = 2)', '2024-03-11 01:09:48', '2024-03-11 01:09:48', NULL),
(12, 'Backend', 'TestController', 'store', 'Add [name] to fillable property to allow mass assignment on [App\\Models\\Test].', '2024-03-11 12:24:04', '2024-03-11 12:24:04', NULL),
(13, 'Backend', 'TestController', 'store', 'SQLSTATE[HY000]: General error: 1364 Field \'status\' doesn\'t have a default value (SQL: insert into `tests` (`name`, `mobile`, `image`, `address`, `created_at`, `updated_at`) values (manjur, 013665, tests/1710181777.jpg, aasdasdsad, 2024-03-11 18:29:37, 2024-03-11 18:29:37))', '2024-03-11 12:29:37', '2024-03-11 12:29:37', NULL),
(14, 'Backend', 'TestController', 'store', 'SQLSTATE[22007]: Invalid datetime format: 1366 Incorrect integer value: \'aasdasdsad\' for column `imli`.`tests`.`address` at row 1 (SQL: insert into `tests` (`name`, `mobile`, `image`, `address`, `created_at`, `updated_at`) values (manjur, 013665, tests/1710182028.jpg, aasdasdsad, 2024-03-11 18:33:48, 2024-03-11 18:33:48))', '2024-03-11 12:33:48', '2024-03-11 12:33:48', NULL),
(15, 'Backend', 'TestController', 'store', 'SQLSTATE[23000]: Integrity constraint violation: 1048 Column \'address\' cannot be null (SQL: insert into `tests` (`name`, `mobile`, `image`, `address`, `created_at`, `updated_at`) values (manjur, 013665, tests/1710182052.jpg, ?, 2024-03-11 18:34:12, 2024-03-11 18:34:12))', '2024-03-11 12:34:12', '2024-03-11 12:34:12', NULL),
(16, 'Backend', 'TestController', 'store', 'SQLSTATE[22007]: Invalid datetime format: 1366 Incorrect integer value: \'aasdasdsad\' for column `imli`.`tests`.`address` at row 1 (SQL: insert into `tests` (`name`, `mobile`, `image`, `address`, `created_at`, `updated_at`) values (manjur, 013665, tests/1710252113.jpg, aasdasdsad, 2024-03-12 14:01:53, 2024-03-12 14:01:53))', '2024-03-12 08:01:54', '2024-03-12 08:01:54', NULL),
(17, 'Backend', 'CommandController', 'store', 'SQLSTATE[HY000]: General error: 1364 Field \'id\' doesn\'t have a default value (SQL: insert into `commands` (`model`, `controller`, `database_table`, `created_at`, `updated_at`) values (Model, Controller, Table name, 2024-03-17 07:02:54, 2024-03-17 07:02:54))', '2024-03-17 01:02:54', '2024-03-17 01:02:54', NULL),
(18, 'Backend', 'CommandController', 'store', 'SQLSTATE[22007]: Invalid datetime format: 1366 Incorrect integer value: \'\' for column `imli`.`menus`.`parent_id` at row 1 (SQL: insert into `menus` (`name`, `icon`, `route`, `description`, `sorting`, `parent_id`, `permission_name`, `status`, `created_at`, `updated_at`) values (xxx, layers, , , 1, , front-menu-management, Active, 2024-03-17 07:39:39, 2024-03-17 07:39:39))', '2024-03-17 01:39:39', '2024-03-17 01:39:39', NULL),
(19, 'Backend', 'CommandController', 'store', 'SQLSTATE[22007]: Invalid datetime format: 1366 Incorrect integer value: \'\' for column `imli`.`menus`.`parent_id` at row 1 (SQL: insert into `menus` (`name`, `icon`, `route`, `description`, `sorting`, `parent_id`, `permission_name`, `status`, `created_at`, `updated_at`) values (xxx, layers, , , 1, , front-menu-management, Active, 2024-03-17 07:46:50, 2024-03-17 07:46:50))', '2024-03-17 01:46:50', '2024-03-17 01:46:50', NULL),
(20, 'Backend', 'CommandController', 'store', 'SQLSTATE[22007]: Invalid datetime format: 1366 Incorrect integer value: \'\' for column `imli`.`menus`.`parent_id` at row 1 (SQL: insert into `menus` (`name`, `icon`, `route`, `description`, `sorting`, `parent_id`, `permission_name`, `status`, `created_at`, `updated_at`) values (xxx, layers, , , 1, , front-menu-management, Active, 2024-03-17 07:50:48, 2024-03-17 07:50:48))', '2024-03-17 01:50:48', '2024-03-17 01:50:48', NULL),
(21, 'Backend', 'SectionController', 'store', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'created_at\' in \'field list\' (SQL: insert into `sections` (`section`, `block`, `section_type`, `attendence_bonus`, `attendence_basic`, `medical`, `medical_basic`, `house_rent`, `house_rent_basic`, `no_work`, `no_work_basic`, `overtime`, `overtime_basic`, `convince`, `convince_basic`, `created_at`, `updated_at`) values (a, s, d, f, g, a, f, a, d, a, f, a, d, a, d, 2024-10-07 05:22:35, 2024-10-07 05:22:35))', '2024-10-06 23:22:35', '2024-10-06 23:22:35', NULL),
(22, 'Backend', 'SectionController', 'store', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'updated_at\' in \'field list\' (SQL: insert into `sections` (`section`, `block`, `section_type`, `attendence_bonus`, `attendence_basic`, `medical`, `medical_basic`, `house_rent`, `house_rent_basic`, `no_work`, `no_work_basic`, `overtime`, `overtime_basic`, `convince`, `convince_basic`, `created_at`, `updated_at`) values (a, s, d, f, g, a, f, a, a, s, f, a, d, a, d, 2024-10-07 05:23:41, 2024-10-07 05:23:41))', '2024-10-06 23:23:41', '2024-10-06 23:23:41', NULL),
(23, 'Backend', 'SectionController', 'store', 'SQLSTATE[22007]: Invalid datetime format: 1366 Incorrect integer value: \'fsdf\' for column `payroll`.`sections`.`section` at row 1 (SQL: insert into `sections` (`section`, `block`, `section_type`, `attendence_bonus`, `attendence_basic`, `medical`, `medical_basic`, `house_rent`, `house_rent_basic`, `no_work`, `no_work_basic`, `overtime`, `overtime_basic`, `convince`, `convince_basic`, `created_at`, `updated_at`) values (fsdf, s, s, s, s, s, s, s, s, s, s, s, s, s, s, 2024-10-07 05:25:00, 2024-10-07 05:25:00))', '2024-10-06 23:25:00', '2024-10-06 23:25:00', NULL),
(24, 'Backend', 'RoleController', 'update', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'role-id\' in \'where clause\' (SQL: select * from `role_permissions` where `role-id` = 2)', '2024-10-07 03:54:28', '2024-10-07 03:54:28', NULL),
(25, 'Backend', 'RoleController', 'update', 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'role-id\' in \'where clause\' (SQL: select * from `role_permissions` where `role-id` = 2)', '2024-10-07 03:54:39', '2024-10-07 03:54:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'no of id of table',
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'done by who',
  `user_type` enum('admin') NOT NULL DEFAULT 'admin',
  `reference_table` varchar(255) DEFAULT NULL COMMENT 'data table name',
  `note` varchar(1000) DEFAULT NULL COMMENT 'data transaction details',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`id`, `data_id`, `admin_id`, `user_type`, `reference_table`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 1, 'admin', 'researches', 'Research deleted successfully', '2024-03-10 13:15:52', '2024-03-10 13:15:52', NULL),
(2, 7, 1, 'admin', 'seminars', 'Slider Inactive Successfully', '2024-03-10 13:35:21', '2024-03-10 13:35:21', NULL),
(3, 7, 1, 'admin', 'seminars', 'Seminar updated successfully', '2024-03-10 13:35:31', '2024-03-10 13:35:31', NULL),
(4, 7, 1, 'admin', 'seminars', 'Seminar updated successfully', '2024-03-10 13:35:35', '2024-03-10 13:35:35', NULL),
(5, 6, 1, 'admin', 'researches', 'Research created successfully', '2024-03-10 13:45:52', '2024-03-10 13:45:52', NULL),
(6, 6, 1, 'admin', 'researches', 'Research updated successfully', '2024-03-10 13:46:42', '2024-03-10 13:46:42', NULL),
(7, 7, 1, 'admin', 'researches', 'Research created successfully', '2024-03-10 15:28:37', '2024-03-10 15:28:37', NULL),
(8, 7, 1, 'admin', 'researches', 'Research updated successfully', '2024-03-10 21:07:39', '2024-03-10 21:07:39', NULL),
(9, 7, 1, 'admin', 'researches', 'Research Inactive Successfully', '2024-03-10 21:16:25', '2024-03-10 21:16:25', NULL),
(10, 7, 1, 'admin', 'researches', 'Research Inactive Successfully', '2024-03-10 21:16:42', '2024-03-10 21:16:42', NULL),
(11, 7, 1, 'admin', 'researches', 'Research Inactive Successfully', '2024-03-10 21:22:54', '2024-03-10 21:22:54', NULL),
(12, 6, 1, 'admin', 'researches', 'Research Inactive Successfully', '2024-03-10 21:23:06', '2024-03-10 21:23:06', NULL),
(13, 7, 1, 'admin', 'researches', 'Research Inactive Successfully', '2024-03-10 21:37:14', '2024-03-10 21:37:14', NULL),
(14, 6, 1, 'admin', 'researches', 'Research Inactive Successfully', '2024-03-10 21:41:35', '2024-03-10 21:41:35', NULL),
(15, 6, 1, 'admin', 'researches', 'Research deleted successfully', '2024-03-10 21:41:40', '2024-03-10 21:41:40', NULL),
(16, 7, 1, 'admin', 'researches', 'Research Active Successfully', '2024-03-10 21:41:49', '2024-03-10 21:41:49', NULL),
(17, 2, 1, 'admin', 'tests', 'Test Inactive Successfully', '2024-03-11 01:13:06', '2024-03-11 01:13:06', NULL),
(18, 2, 1, 'admin', 'tests', 'Test deleted successfully', '2024-03-11 01:13:10', '2024-03-11 01:13:10', NULL),
(19, 1, 1, 'admin', 'tests', 'Test Inactive Successfully', '2024-03-11 03:22:59', '2024-03-11 03:22:59', NULL),
(20, 1, 1, 'admin', 'tests', 'Test Active Successfully', '2024-03-11 03:23:02', '2024-03-11 03:23:02', NULL),
(21, 1, 1, 'admin', 'tests', 'Test deleted successfully', '2024-03-11 03:23:05', '2024-03-11 03:23:05', NULL),
(22, 4, 1, 'admin', 'tests', 'Test deleted successfully', '2024-03-11 03:34:00', '2024-03-11 03:34:00', NULL),
(23, 2, 1, 'admin', 'tests', 'Test Inactive Successfully', '2024-03-11 03:34:20', '2024-03-11 03:34:20', NULL),
(24, 2, 1, 'admin', 'tests', 'Test Active Successfully', '2024-03-11 03:34:24', '2024-03-11 03:34:24', NULL),
(25, 3, 1, 'admin', 'tests', 'Test Active Successfully', '2024-03-11 03:34:26', '2024-03-11 03:34:26', NULL),
(26, 3, 1, 'admin', 'tests', 'Test Inactive Successfully', '2024-03-11 03:37:26', '2024-03-11 03:37:26', NULL),
(27, 2, 1, 'admin', 'tests', 'Test Inactive Successfully', '2024-03-11 03:37:29', '2024-03-11 03:37:29', NULL),
(28, 3, 1, 'admin', 'tests', 'Test Active Successfully', '2024-03-11 03:37:32', '2024-03-11 03:37:32', NULL),
(29, 3, 1, 'admin', 'tests', 'Test deleted successfully', '2024-03-11 03:37:34', '2024-03-11 03:37:34', NULL),
(30, 2, 1, 'admin', 'tests', 'Test Active Successfully', '2024-03-11 03:46:37', '2024-03-11 03:46:37', NULL),
(31, 1, 1, 'admin', 'tests', 'Test Inactive Successfully', '2024-03-11 03:46:39', '2024-03-11 03:46:39', NULL),
(32, 1, 1, 'admin', 'tests', 'Test deleted successfully', '2024-03-11 03:46:44', '2024-03-11 03:46:44', NULL),
(33, 5, 1, 'admin', 'tests', 'Test created successfully', '2024-03-11 12:34:25', '2024-03-11 12:34:25', NULL),
(34, 5, 1, 'admin', 'tests', 'Test Inactive Successfully', '2024-03-11 12:34:38', '2024-03-11 12:34:38', NULL),
(35, 5, 1, 'admin', 'tests', 'Test Active Successfully', '2024-03-11 12:34:41', '2024-03-11 12:34:41', NULL),
(36, 5, 1, 'admin', 'tests', 'Test updated successfully', '2024-03-11 12:34:48', '2024-03-11 12:34:48', NULL),
(37, 6, 1, 'admin', 'tests', 'Test created successfully', '2024-03-12 08:02:35', '2024-03-12 08:02:35', NULL),
(38, 2, 1, 'admin', 'tests', 'Test updated successfully', '2024-03-12 08:03:12', '2024-03-12 08:03:12', NULL),
(39, 1, 1, 'admin', 'members', 'Member created successfully', '2024-03-12 08:15:16', '2024-03-12 08:15:16', NULL),
(40, 1, 1, 'admin', 'members', 'Member Active Successfully', '2024-03-12 08:16:40', '2024-03-12 08:16:40', NULL),
(41, 1, 1, 'admin', 'members', 'Member updated successfully', '2024-03-12 08:16:55', '2024-03-12 08:16:55', NULL),
(42, 1, 1, 'admin', 'members', 'Member Inactive Successfully', '2024-03-12 10:18:51', '2024-03-12 10:18:51', NULL),
(43, 1, 1, 'admin', 'members', 'Member Active Successfully', '2024-03-12 10:18:54', '2024-03-12 10:18:54', NULL),
(44, 46, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:39:25', '2024-03-16 07:39:25', NULL),
(45, 45, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:39:32', '2024-03-16 07:39:32', NULL),
(46, 44, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:39:36', '2024-03-16 07:39:36', NULL),
(47, 41, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:39:49', '2024-03-16 07:39:49', NULL),
(48, 38, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:40:04', '2024-03-16 07:40:04', NULL),
(49, 35, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:40:19', '2024-03-16 07:40:19', NULL),
(50, 32, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:40:24', '2024-03-16 07:40:24', NULL),
(51, 29, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:40:32', '2024-03-16 07:40:32', NULL),
(52, 26, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:40:40', '2024-03-16 07:40:40', NULL),
(53, 23, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:40:44', '2024-03-16 07:40:44', NULL),
(54, 20, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:40:53', '2024-03-16 07:40:53', NULL),
(55, 17, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:40:56', '2024-03-16 07:40:56', NULL),
(56, 14, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:41:03', '2024-03-16 07:41:03', NULL),
(57, 11, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-16 07:41:12', '2024-03-16 07:41:12', NULL),
(58, 1, 1, 'admin', 'commands', 'Command created successfully', '2024-03-17 01:03:19', '2024-03-17 01:03:19', NULL),
(59, 2, 1, 'admin', 'commands', 'Command created successfully', '2024-03-17 01:19:08', '2024-03-17 01:19:08', NULL),
(60, 2, 1, 'admin', 'commands', 'Command deleted successfully', '2024-03-17 01:21:06', '2024-03-17 01:21:06', NULL),
(61, 6, 1, 'admin', 'commands', 'Command created successfully', '2024-03-17 01:51:43', '2024-03-17 01:51:43', NULL),
(62, 7, 1, 'admin', 'commands', 'Command created successfully', '2024-03-17 01:57:08', '2024-03-17 01:57:08', NULL),
(63, 7, 1, 'admin', 'commands', 'Command deleted successfully', '2024-03-17 05:42:16', '2024-03-17 05:42:16', NULL),
(64, 6, 1, 'admin', 'commands', 'Command deleted successfully', '2024-03-17 05:42:18', '2024-03-17 05:42:18', NULL),
(65, 1, 1, 'admin', 'commands', 'Command deleted successfully', '2024-03-17 05:42:21', '2024-03-17 05:42:21', NULL),
(66, 2, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-17 05:43:00', '2024-03-17 05:43:00', NULL),
(67, 5, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-17 05:43:07', '2024-03-17 05:43:07', NULL),
(68, 8, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-17 05:43:14', '2024-03-17 05:43:14', NULL),
(69, 8, 1, 'admin', 'commands', 'Command created successfully', '2024-03-17 05:55:21', '2024-03-17 05:55:21', NULL),
(70, 9, 1, 'admin', 'commands', 'Command created successfully', '2024-03-17 05:56:55', '2024-03-17 05:56:55', NULL),
(71, 10, 1, 'admin', 'commands', 'Command created successfully', '2024-03-17 06:04:10', '2024-03-17 06:04:10', NULL),
(72, 7, 1, 'admin', 'researches', 'Research deleted successfully', '2024-03-17 06:04:26', '2024-03-17 06:04:26', NULL),
(73, 53, 1, 'admin', 'menus', 'Menu Inactive Successfully', '2024-03-17 08:37:44', '2024-03-17 08:37:44', NULL),
(74, 11, 1, 'admin', 'commands', 'Command created successfully', '2024-03-17 09:22:38', '2024-03-17 09:22:38', NULL),
(75, 1, 1, 'admin', 'students', 'Student created successfully', '2024-03-17 09:24:16', '2024-03-17 09:24:16', NULL),
(76, 1, 1, 'admin', 'students', 'Student updated successfully', '2024-03-17 09:40:15', '2024-03-17 09:40:15', NULL),
(77, 1, 1, 'admin', 'students', 'Student Inactive Successfully', '2024-03-17 09:40:43', '2024-03-17 09:40:43', NULL),
(78, 1, 1, 'admin', 'students', 'Student Active Successfully', '2024-03-17 09:40:47', '2024-03-17 09:40:47', NULL),
(79, 2, 1, 'admin', 'students', 'Student created successfully', '2024-03-17 10:05:09', '2024-03-17 10:05:09', NULL),
(80, 1, 1, 'admin', 'roles', 'Role updated successfully', '2024-10-04 14:01:01', '2024-10-04 14:01:01', NULL),
(81, 2, 1, 'admin', 'admins', 'User created successfully', '2024-10-07 00:30:52', '2024-10-07 00:30:52', NULL),
(82, 3, 1, 'admin', 'roles', 'Role created successfully', '2024-10-07 03:24:05', '2024-10-07 03:24:05', NULL),
(83, 3, 1, 'admin', 'roles', 'Role deleted successfully', '2024-10-07 03:28:10', '2024-10-07 03:28:10', NULL),
(84, 4, 1, 'admin', 'roles', 'Role created successfully', '2024-10-07 03:28:31', '2024-10-07 03:28:31', NULL),
(85, 2, 1, 'admin', 'roles', 'Role updated successfully', '2024-10-07 04:34:47', '2024-10-07 04:34:47', NULL),
(86, 2, 1, 'admin', 'roles', 'Role updated successfully', '2024-10-07 04:36:53', '2024-10-07 04:36:53', NULL),
(87, 2, 1, 'admin', 'roles', 'Role updated successfully', '2024-10-07 04:39:08', '2024-10-07 04:39:08', NULL),
(88, 2, 1, 'admin', 'roles', 'Role updated successfully', '2024-10-07 04:40:00', '2024-10-07 04:40:00', NULL),
(89, 2, 1, 'admin', 'roles', 'Role updated successfully', '2024-10-07 04:53:47', '2024-10-07 04:53:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_role_id_foreign` (`role_id`);

--
-- Indexes for table `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  ADD KEY `permissions_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_error_logs`
--
ALTER TABLE `system_error_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `system_logs_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

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
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `commands`
--
ALTER TABLE `commands`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_error_logs`
--
ALTER TABLE `system_error_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD CONSTRAINT `system_logs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
