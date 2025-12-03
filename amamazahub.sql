-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2025 at 06:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amamazahub`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE `aboutus` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'About Us 1', 'This is about us paragraph #1', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(2, 'About Us 2', 'This is about us paragraph #2', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(3, 'About Us 3', 'This is about us paragraph #3', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(4, 'About Us 4', 'This is about us paragraph #4', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(5, 'About Us 5', 'This is about us paragraph #5', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(6, 'About Us 6', 'This is about us paragraph #6', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(7, 'About Us 7', 'This is about us paragraph #7', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(8, 'About Us 8', 'This is about us paragraph #8', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(9, 'About Us 9', 'This is about us paragraph #9', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(10, 'About Us 10', 'This is about us paragraph #10', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(11, 'About Us 1', 'This is about us paragraph #1', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(12, 'About Us 2', 'This is about us paragraph #2', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(13, 'About Us 3', 'This is about us paragraph #3', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(14, 'About Us 4', 'This is about us paragraph #4', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(15, 'About Us 5', 'This is about us paragraph #5', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(16, 'About Us 6', 'This is about us paragraph #6', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(17, 'About Us 7', 'This is about us paragraph #7', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(18, 'About Us 8', 'This is about us paragraph #8', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(19, 'About Us 9', 'This is about us paragraph #9', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(20, 'About Us 10', 'This is about us paragraph #10', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(21, 'About Us 1', 'This is about us paragraph #1', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(22, 'About Us 2', 'This is about us paragraph #2', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(23, 'About Us 3', 'This is about us paragraph #3', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(24, 'About Us 4', 'This is about us paragraph #4', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(25, 'About Us 5', 'This is about us paragraph #5', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(26, 'About Us 6', 'This is about us paragraph #6', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(27, 'About Us 7', 'This is about us paragraph #7', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(28, 'About Us 8', 'This is about us paragraph #8', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(29, 'About Us 9', 'This is about us paragraph #9', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(30, 'About Us 10', 'This is about us paragraph #10', '2025-11-17 07:13:09', '2025-11-17 07:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `advertiser_id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `media_urls` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`media_urls`)),
  `target_url` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `advertiser_id`, `title`, `description`, `media_urls`, `target_url`, `start_date`, `end_date`, `created_at`) VALUES
(1, 1, 'Flash Sale', NULL, NULL, 'https://example.com/sale', NULL, NULL, '2025-11-05 16:53:41'),
(2, 1, 'Ad Title 1', 'Description for ad 1', NULL, 'https://example.com/ad1', NULL, NULL, '2025-11-17 07:13:09'),
(3, 1, 'Ad Title 2', 'Description for ad 2', NULL, 'https://example.com/ad2', NULL, NULL, '2025-11-17 07:13:09'),
(4, 1, 'Ad Title 3', 'Description for ad 3', NULL, 'https://example.com/ad3', NULL, NULL, '2025-11-17 07:13:09'),
(5, 1, 'Ad Title 4', 'Description for ad 4', NULL, 'https://example.com/ad4', NULL, NULL, '2025-11-17 07:13:09'),
(6, 1, 'Ad Title 5', 'Description for ad 5', NULL, 'https://example.com/ad5', NULL, NULL, '2025-11-17 07:13:09'),
(7, 1, 'Ad Title 6', 'Description for ad 6', NULL, 'https://example.com/ad6', NULL, NULL, '2025-11-17 07:13:09'),
(8, 1, 'Ad Title 7', 'Description for ad 7', NULL, 'https://example.com/ad7', NULL, NULL, '2025-11-17 07:13:09'),
(9, 1, 'Ad Title 8', 'Description for ad 8', NULL, 'https://example.com/ad8', NULL, NULL, '2025-11-17 07:13:09'),
(10, 1, 'Ad Title 9', 'Description for ad 9', NULL, 'https://example.com/ad9', NULL, NULL, '2025-11-17 07:13:09'),
(11, 1, 'Ad Title 10', 'Description for ad 10', NULL, 'https://example.com/ad10', NULL, NULL, '2025-11-17 07:13:09'),
(12, 1, 'Ad Title 1', 'Description for ad 1', NULL, 'https://example.com/ad1', NULL, NULL, '2025-11-17 07:13:09'),
(13, 1, 'Ad Title 2', 'Description for ad 2', NULL, 'https://example.com/ad2', NULL, NULL, '2025-11-17 07:13:09'),
(14, 1, 'Ad Title 3', 'Description for ad 3', NULL, 'https://example.com/ad3', NULL, NULL, '2025-11-17 07:13:09'),
(15, 1, 'Ad Title 4', 'Description for ad 4', NULL, 'https://example.com/ad4', NULL, NULL, '2025-11-17 07:13:09'),
(16, 1, 'Ad Title 5', 'Description for ad 5', NULL, 'https://example.com/ad5', NULL, NULL, '2025-11-17 07:13:09'),
(17, 1, 'Ad Title 6', 'Description for ad 6', NULL, 'https://example.com/ad6', NULL, NULL, '2025-11-17 07:13:09'),
(18, 1, 'Ad Title 7', 'Description for ad 7', NULL, 'https://example.com/ad7', NULL, NULL, '2025-11-17 07:13:09'),
(19, 1, 'Ad Title 8', 'Description for ad 8', NULL, 'https://example.com/ad8', NULL, NULL, '2025-11-17 07:13:09'),
(20, 1, 'Ad Title 9', 'Description for ad 9', NULL, 'https://example.com/ad9', NULL, NULL, '2025-11-17 07:13:09'),
(21, 1, 'Ad Title 10', 'Description for ad 10', NULL, 'https://example.com/ad10', NULL, NULL, '2025-11-17 07:13:09'),
(22, 1, 'Ad Title 1', 'Description for ad 1', NULL, 'https://example.com/ad1', NULL, NULL, '2025-11-17 07:13:09'),
(23, 1, 'Ad Title 2', 'Description for ad 2', NULL, 'https://example.com/ad2', NULL, NULL, '2025-11-17 07:13:09'),
(24, 1, 'Ad Title 3', 'Description for ad 3', NULL, 'https://example.com/ad3', NULL, NULL, '2025-11-17 07:13:09'),
(25, 1, 'Ad Title 4', 'Description for ad 4', NULL, 'https://example.com/ad4', NULL, NULL, '2025-11-17 07:13:09'),
(26, 1, 'Ad Title 5', 'Description for ad 5', NULL, 'https://example.com/ad5', NULL, NULL, '2025-11-17 07:13:09'),
(27, 1, 'Ad Title 6', 'Description for ad 6', NULL, 'https://example.com/ad6', NULL, NULL, '2025-11-17 07:13:09'),
(28, 1, 'Ad Title 7', 'Description for ad 7', NULL, 'https://example.com/ad7', NULL, NULL, '2025-11-17 07:13:09'),
(29, 1, 'Ad Title 8', 'Description for ad 8', NULL, 'https://example.com/ad8', NULL, NULL, '2025-11-17 07:13:09'),
(30, 1, 'Ad Title 9', 'Description for ad 9', NULL, 'https://example.com/ad9', NULL, NULL, '2025-11-17 07:13:09'),
(31, 1, 'Ad Title 10', 'Description for ad 10', NULL, 'https://example.com/ad10', NULL, NULL, '2025-11-17 07:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `ad_impressions`
--

CREATE TABLE `ad_impressions` (
  `id` bigint(20) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `impression_type` enum('view','click') NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ad_impressions`
--

INSERT INTO `ad_impressions` (`id`, `ad_id`, `user_id`, `impression_type`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 1, 2, 'view', '127.0.0.1', 'seed-agent/1', '2025-11-17 07:13:09'),
(2, 1, 3, 'view', '127.0.0.2', 'seed-agent/2', '2025-11-17 07:13:09'),
(3, 1, 1, 'view', '127.0.0.3', 'seed-agent/3', '2025-11-17 07:13:09'),
(4, 1, 2, 'view', '127.0.0.4', 'seed-agent/4', '2025-11-17 07:13:09'),
(5, 1, 3, 'view', '127.0.0.5', 'seed-agent/5', '2025-11-17 07:13:09'),
(6, 1, 1, 'view', '127.0.0.6', 'seed-agent/6', '2025-11-17 07:13:09'),
(7, 1, 2, 'view', '127.0.0.7', 'seed-agent/7', '2025-11-17 07:13:09'),
(8, 1, 3, 'view', '127.0.0.8', 'seed-agent/8', '2025-11-17 07:13:09'),
(9, 1, 1, 'view', '127.0.0.9', 'seed-agent/9', '2025-11-17 07:13:09'),
(10, 1, 2, 'view', '127.0.0.10', 'seed-agent/10', '2025-11-17 07:13:09'),
(11, 1, 2, 'view', '127.0.0.1', 'seed-agent/1', '2025-11-17 07:13:09'),
(12, 1, 3, 'view', '127.0.0.2', 'seed-agent/2', '2025-11-17 07:13:09'),
(13, 1, 1, 'view', '127.0.0.3', 'seed-agent/3', '2025-11-17 07:13:09'),
(14, 1, 2, 'view', '127.0.0.4', 'seed-agent/4', '2025-11-17 07:13:09'),
(15, 1, 3, 'view', '127.0.0.5', 'seed-agent/5', '2025-11-17 07:13:09'),
(16, 1, 1, 'view', '127.0.0.6', 'seed-agent/6', '2025-11-17 07:13:09'),
(17, 1, 2, 'view', '127.0.0.7', 'seed-agent/7', '2025-11-17 07:13:09'),
(18, 1, 3, 'view', '127.0.0.8', 'seed-agent/8', '2025-11-17 07:13:09'),
(19, 1, 1, 'view', '127.0.0.9', 'seed-agent/9', '2025-11-17 07:13:09'),
(20, 1, 2, 'view', '127.0.0.10', 'seed-agent/10', '2025-11-17 07:13:09'),
(21, 1, 2, 'view', '127.0.0.1', 'seed-agent/1', '2025-11-17 07:13:09'),
(22, 1, 3, 'view', '127.0.0.2', 'seed-agent/2', '2025-11-17 07:13:09'),
(23, 1, 1, 'view', '127.0.0.3', 'seed-agent/3', '2025-11-17 07:13:09'),
(24, 1, 2, 'view', '127.0.0.4', 'seed-agent/4', '2025-11-17 07:13:09'),
(25, 1, 3, 'view', '127.0.0.5', 'seed-agent/5', '2025-11-17 07:13:09'),
(26, 1, 1, 'view', '127.0.0.6', 'seed-agent/6', '2025-11-17 07:13:09'),
(27, 1, 2, 'view', '127.0.0.7', 'seed-agent/7', '2025-11-17 07:13:09'),
(28, 1, 3, 'view', '127.0.0.8', 'seed-agent/8', '2025-11-17 07:13:09'),
(29, 1, 1, 'view', '127.0.0.9', 'seed-agent/9', '2025-11-17 07:13:09'),
(30, 1, 2, 'view', '127.0.0.10', 'seed-agent/10', '2025-11-17 07:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `thumbnail_url` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `thumbnail_url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Category 1', 'category-1', 'Description for category 1', NULL, 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(2, 'Category 2', 'category-2', 'Description for category 2', NULL, 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(3, 'Category 3', 'category-3', 'Description for category 3', NULL, 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(4, 'Category 4', 'category-4', 'Description for category 4', NULL, 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(5, 'Category 5', 'category-5', 'Description for category 5', NULL, 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(6, 'Category 6', 'category-6', 'Description for category 6', NULL, 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(7, 'Category 7', 'category-7', 'Description for category 7', NULL, 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(8, 'Category 8', 'category-8', 'Description for category 8', NULL, 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(9, 'Category 9', 'category-9', 'Description for category 9', NULL, 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(10, 'Category 10', 'category-10', 'Description for category 10', NULL, 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `chat_name` varchar(100) DEFAULT NULL,
  `is_group` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `chat_name`, `is_group`, `created_at`) VALUES
(1, 'Chat 1', 0, '2025-11-17 07:13:09'),
(2, 'Chat 2', 0, '2025-11-17 07:13:09'),
(3, 'Chat 3', 1, '2025-11-17 07:13:09'),
(4, 'Chat 4', 0, '2025-11-17 07:13:09'),
(5, 'Chat 5', 0, '2025-11-17 07:13:09'),
(6, 'Chat 6', 1, '2025-11-17 07:13:09'),
(7, 'Chat 7', 0, '2025-11-17 07:13:09'),
(8, 'Chat 8', 0, '2025-11-17 07:13:09'),
(9, 'Chat 9', 1, '2025-11-17 07:13:09'),
(10, 'Chat 10', 0, '2025-11-17 07:13:09'),
(11, 'Chat 1', 0, '2025-11-17 07:13:09'),
(12, 'Chat 2', 0, '2025-11-17 07:13:09'),
(13, 'Chat 3', 1, '2025-11-17 07:13:09'),
(14, 'Chat 4', 0, '2025-11-17 07:13:09'),
(15, 'Chat 5', 0, '2025-11-17 07:13:09'),
(16, 'Chat 6', 1, '2025-11-17 07:13:09'),
(17, 'Chat 7', 0, '2025-11-17 07:13:09'),
(18, 'Chat 8', 0, '2025-11-17 07:13:09'),
(19, 'Chat 9', 1, '2025-11-17 07:13:09'),
(20, 'Chat 10', 0, '2025-11-17 07:13:09'),
(21, NULL, 0, '2025-11-17 17:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `chat_participants`
--

CREATE TABLE `chat_participants` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_participants`
--

INSERT INTO `chat_participants` (`id`, `chat_id`, `user_id`, `joined_at`) VALUES
(1, 2, 2, '2025-11-17 07:13:09'),
(2, 3, 3, '2025-11-17 07:13:09'),
(3, 4, 1, '2025-11-17 07:13:09'),
(4, 5, 2, '2025-11-17 07:13:09'),
(5, 6, 3, '2025-11-17 07:13:09'),
(6, 7, 1, '2025-11-17 07:13:09'),
(7, 8, 2, '2025-11-17 07:13:09'),
(8, 9, 3, '2025-11-17 07:13:09'),
(9, 10, 1, '2025-11-17 07:13:09'),
(10, 1, 2, '2025-11-17 07:13:09'),
(11, 2, 2, '2025-11-17 07:13:09'),
(12, 3, 3, '2025-11-17 07:13:09'),
(13, 4, 1, '2025-11-17 07:13:09'),
(14, 5, 2, '2025-11-17 07:13:09'),
(15, 6, 3, '2025-11-17 07:13:09'),
(16, 7, 1, '2025-11-17 07:13:09'),
(17, 8, 2, '2025-11-17 07:13:09'),
(18, 9, 3, '2025-11-17 07:13:09'),
(19, 10, 1, '2025-11-17 07:13:09'),
(20, 1, 2, '2025-11-17 07:13:09'),
(21, 10, 1, '2025-11-17 17:07:49'),
(22, 10, 2, '2025-11-17 17:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `text` text NOT NULL,
  `media_url` text DEFAULT NULL,
  `media_type` enum('none','photo','video','audio') DEFAULT 'none',
  `likes_count` int(11) DEFAULT 0,
  `replies_count` int(11) DEFAULT 0,
  `status` enum('active','hidden','deleted','reported') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content_id`, `user_id`, `parent_id`, `text`, `media_url`, `media_type`, `likes_count`, `replies_count`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 'opihpp\'y90yioph;', 'yee', 'none', 1, 0, 'active', '2025-11-14 21:17:46', '2025-11-14 21:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Contact 1', 'contact1@example.com', 'Subject 1', 'Message body 1', '2025-11-17 07:13:09'),
(2, 'Contact 2', 'contact2@example.com', 'Subject 2', 'Message body 2', '2025-11-17 07:13:09'),
(3, 'Contact 3', 'contact3@example.com', 'Subject 3', 'Message body 3', '2025-11-17 07:13:09'),
(4, 'Contact 4', 'contact4@example.com', 'Subject 4', 'Message body 4', '2025-11-17 07:13:09'),
(5, 'Contact 5', 'contact5@example.com', 'Subject 5', 'Message body 5', '2025-11-17 07:13:09'),
(6, 'Contact 6', 'contact6@example.com', 'Subject 6', 'Message body 6', '2025-11-17 07:13:09'),
(7, 'Contact 7', 'contact7@example.com', 'Subject 7', 'Message body 7', '2025-11-17 07:13:09'),
(8, 'Contact 8', 'contact8@example.com', 'Subject 8', 'Message body 8', '2025-11-17 07:13:09'),
(9, 'Contact 9', 'contact9@example.com', 'Subject 9', 'Message body 9', '2025-11-17 07:13:09'),
(10, 'Contact 10', 'contact10@example.com', 'Subject 10', 'Message body 10', '2025-11-17 07:13:09'),
(11, 'Contact 1', 'contact1@example.com', 'Subject 1', 'Message body 1', '2025-11-17 07:13:09'),
(12, 'Contact 2', 'contact2@example.com', 'Subject 2', 'Message body 2', '2025-11-17 07:13:09'),
(13, 'Contact 3', 'contact3@example.com', 'Subject 3', 'Message body 3', '2025-11-17 07:13:09'),
(14, 'Contact 4', 'contact4@example.com', 'Subject 4', 'Message body 4', '2025-11-17 07:13:09'),
(15, 'Contact 5', 'contact5@example.com', 'Subject 5', 'Message body 5', '2025-11-17 07:13:09'),
(16, 'Contact 6', 'contact6@example.com', 'Subject 6', 'Message body 6', '2025-11-17 07:13:09'),
(17, 'Contact 7', 'contact7@example.com', 'Subject 7', 'Message body 7', '2025-11-17 07:13:09'),
(18, 'Contact 8', 'contact8@example.com', 'Subject 8', 'Message body 8', '2025-11-17 07:13:09'),
(19, 'Contact 9', 'contact9@example.com', 'Subject 9', 'Message body 9', '2025-11-17 07:13:09'),
(20, 'Contact 10', 'contact10@example.com', 'Subject 10', 'Message body 10', '2025-11-17 07:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `media_url` text DEFAULT NULL,
  `media_type` enum('reel','photo','gallery','video','post','blog','audio') NOT NULL DEFAULT 'post',
  `thumbnail_url` text DEFAULT NULL,
  `likes_count` int(11) DEFAULT 0,
  `comments_count` int(11) DEFAULT 0,
  `shares_count` int(11) DEFAULT 0,
  `views_count` int(11) DEFAULT 0,
  `visibility` enum('public','private','friends','unlisted') DEFAULT 'public',
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `location` varchar(255) DEFAULT NULL,
  `language` varchar(20) DEFAULT 'en',
  `status` enum('active','hidden','deleted','reported') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `user_id`, `title`, `description`, `media_url`, `media_type`, `thumbnail_url`, `likes_count`, `comments_count`, `shares_count`, `views_count`, `visibility`, `tags`, `location`, `language`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'title', 'describes here', 'url/more', 'gallery', NULL, 0, 0, 0, 0, 'public', NULL, NULL, 'en', 'active', '2025-11-10 19:54:58', '2025-11-10 19:54:58'),
(2, 2, 'Content Title 1', 'Content description 1', 'media/url/1', 'gallery', NULL, 1, 1, 1, 101, 'public', NULL, 'City 1', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(3, 3, 'Content Title 2', 'Content description 2', 'media/url/2', 'gallery', NULL, 2, 2, 0, 102, 'public', NULL, 'City 2', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(4, 1, 'Content Title 3', 'Content description 3', 'media/url/3', 'gallery', NULL, 3, 0, 1, 103, 'public', NULL, 'City 3', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(5, 2, 'Content Title 4', 'Content description 4', 'media/url/4', 'post', NULL, 4, 1, 0, 104, 'public', NULL, 'City 4', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(6, 3, 'Content Title 5', 'Content description 5', 'media/url/5', 'gallery', NULL, 0, 2, 1, 105, 'public', NULL, 'City 5', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(7, 1, 'Content Title 6', 'Content description 6', 'media/url/6', 'gallery', NULL, 1, 0, 0, 106, 'public', NULL, 'City 6', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(8, 2, 'Content Title 7', 'Content description 7', 'media/url/7', 'gallery', NULL, 2, 1, 1, 107, 'public', NULL, 'City 7', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(9, 3, 'Content Title 8', 'Content description 8', 'media/url/8', 'post', NULL, 3, 2, 0, 108, 'public', NULL, 'City 8', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(10, 1, 'Content Title 9', 'Content description 9', 'media/url/9', 'gallery', NULL, 4, 0, 1, 109, 'public', NULL, 'City 9', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(11, 2, 'Content Title 10', 'Content description 10', 'media/url/10', 'gallery', NULL, 0, 1, 0, 110, 'public', NULL, 'City 10', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(12, 2, 'Content Title 1', 'Content description 1', 'media/url/1', 'gallery', NULL, 1, 1, 1, 101, 'public', NULL, 'City 1', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(13, 3, 'Content Title 2', 'Content description 2', 'media/url/2', 'gallery', NULL, 2, 2, 0, 102, 'public', NULL, 'City 2', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(14, 1, 'Content Title 3', 'Content description 3', 'media/url/3', 'gallery', NULL, 3, 0, 1, 103, 'public', NULL, 'City 3', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(15, 2, 'Content Title 4', 'Content description 4', 'media/url/4', 'post', NULL, 4, 1, 0, 104, 'public', NULL, 'City 4', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(16, 3, 'Content Title 5', 'Content description 5', 'media/url/5', 'gallery', NULL, 0, 2, 1, 105, 'public', NULL, 'City 5', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(17, 1, 'Content Title 6', 'Content description 6', 'media/url/6', 'gallery', NULL, 1, 0, 0, 106, 'public', NULL, 'City 6', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(18, 2, 'Content Title 7', 'Content description 7', 'media/url/7', 'gallery', NULL, 2, 1, 1, 107, 'public', NULL, 'City 7', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(19, 3, 'Content Title 8', 'Content description 8', 'media/url/8', 'post', NULL, 3, 2, 0, 108, 'public', NULL, 'City 8', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(20, 1, 'Content Title 9', 'Content description 9', 'media/url/9', 'gallery', NULL, 4, 0, 1, 109, 'public', NULL, 'City 9', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(21, 2, 'Content Title 10', 'Content description 10', 'media/url/10', 'gallery', NULL, 0, 1, 0, 110, 'public', NULL, 'City 10', 'en', 'active', '2025-11-17 07:13:09', '2025-11-17 07:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `content_categories`
--

CREATE TABLE `content_categories` (
  `id` bigint(20) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_categories`
--

INSERT INTO `content_categories` (`id`, `content_id`, `category_id`) VALUES
(10, 1, 1),
(1, 2, 2),
(2, 3, 3),
(3, 4, 4),
(4, 5, 5),
(5, 6, 6),
(6, 7, 7),
(7, 8, 8),
(8, 9, 9),
(9, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `explore_feed`
--

CREATE TABLE `explore_feed` (
  `id` bigint(20) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `rank_score` double DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `explore_feed`
--

INSERT INTO `explore_feed` (`id`, `content_id`, `category_id`, `rank_score`, `created_at`) VALUES
(1, 2, 2, 99.5, '2025-11-17 07:13:09'),
(2, 3, 3, 99, '2025-11-17 07:13:09'),
(3, 4, 4, 98.5, '2025-11-17 07:13:09'),
(4, 5, 5, 98, '2025-11-17 07:13:09'),
(5, 6, 6, 97.5, '2025-11-17 07:13:09'),
(6, 7, 7, 97, '2025-11-17 07:13:09'),
(7, 8, 8, 96.5, '2025-11-17 07:13:09'),
(8, 9, 9, 96, '2025-11-17 07:13:09'),
(9, 10, 10, 95.5, '2025-11-17 07:13:09'),
(10, 1, 1, 95, '2025-11-17 07:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'How to do 1?', 'Answer for 1', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(2, 'How to do 2?', 'Answer for 2', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(3, 'How to do 3?', 'Answer for 3', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(4, 'How to do 4?', 'Answer for 4', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(5, 'How to do 5?', 'Answer for 5', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(6, 'How to do 6?', 'Answer for 6', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(7, 'How to do 7?', 'Answer for 7', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(8, 'How to do 8?', 'Answer for 8', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(9, 'How to do 9?', 'Answer for 9', '2025-11-17 07:13:09', '2025-11-17 07:13:09'),
(10, 'How to do 10?', 'Answer for 10', '2025-11-17 07:13:09', '2025-11-17 07:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_name`, `email`, `message`, `created_at`) VALUES
(1, 'User 1', 'user1@example.com', 'Feedback message 1', '2025-11-17 07:13:09'),
(2, 'User 2', 'user2@example.com', 'Feedback message 2', '2025-11-17 07:13:09'),
(3, 'User 3', 'user3@example.com', 'Feedback message 3', '2025-11-17 07:13:09'),
(4, 'User 4', 'user4@example.com', 'Feedback message 4', '2025-11-17 07:13:09'),
(5, 'User 5', 'user5@example.com', 'Feedback message 5', '2025-11-17 07:13:09'),
(6, 'User 6', 'user6@example.com', 'Feedback message 6', '2025-11-17 07:13:09'),
(7, 'User 7', 'user7@example.com', 'Feedback message 7', '2025-11-17 07:13:09'),
(8, 'User 8', 'user8@example.com', 'Feedback message 8', '2025-11-17 07:13:09'),
(9, 'User 9', 'user9@example.com', 'Feedback message 9', '2025-11-17 07:13:09'),
(10, 'User 10', 'user10@example.com', 'Feedback message 10', '2025-11-17 07:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` bigint(20) NOT NULL,
  `follower_id` bigint(20) NOT NULL,
  `following_id` bigint(20) NOT NULL,
  `status` enum('active','blocked','removed') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `follower_id`, `following_id`, `status`, `created_at`) VALUES
(15, 1, 4, 'active', '2025-11-18 15:47:02'),
(16, 5, 3, 'active', '2025-11-18 15:47:18'),
(17, 2, 3, 'active', '2025-11-18 15:47:33'),
(18, 1, 2, 'removed', '2025-11-18 15:55:06'),
(21, 4, 3, 'removed', '2025-11-18 19:53:54'),
(22, 4, 2, 'removed', '2025-11-21 09:55:52'),
(23, 4, 1, 'removed', '2025-11-21 09:55:57'),
(28, 4, 5, 'removed', '2025-11-21 09:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE `help` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language_name` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `target_type` enum('content','comment') NOT NULL,
  `target_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','removed') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `target_type`, `target_id`, `created_at`, `status`) VALUES
(3, 3, 'comment', 2, '2025-11-10 18:20:02', 'active'),
(7, 1, 'content', 1, '2025-11-13 13:57:59', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `sender_id` bigint(11) NOT NULL,
  `receiver_id` bigint(20) NOT NULL,
  `message_type` enum('text','image','video','audio','voice_note','video_note','gallery','poll','contact','location','emoji','document') DEFAULT 'text',
  `message_text` text DEFAULT NULL,
  `media_url` varchar(255) DEFAULT NULL,
  `poll_options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`poll_options`)),
  `location` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`location`)),
  `reply_to` bigint(20) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `chat_id`, `sender_id`, `receiver_id`, `message_type`, `message_text`, `media_url`, `poll_options`, `location`, `reply_to`, `is_read`, `sent_at`) VALUES
(4, 13, 4, 2, 'image', 'this kind of image is interested to look', '/content/', NULL, NULL, NULL, 0, '2025-11-17 09:30:57'),
(6, 12, 3, 1, 'text', 'hi', NULL, NULL, NULL, NULL, 0, '2025-11-17 14:45:22'),
(7, 13, 1, 2, 'text', 'Hello, this is a test', NULL, NULL, NULL, NULL, 0, '2025-11-17 17:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `moderation_logs`
--

CREATE TABLE `moderation_logs` (
  `id` bigint(20) NOT NULL,
  `content_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) NOT NULL,
  `recipient_id` bigint(20) NOT NULL,
  `actor_id` bigint(20) DEFAULT NULL,
  `type` enum('like','comment','follow','mention','reply','repost','system','custom') NOT NULL DEFAULT 'system',
  `content_id` bigint(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `link_url` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `recipient_id`, `actor_id`, `type`, `content_id`, `message`, `link_url`, `is_read`, `created_at`) VALUES
(1, 2, 4, 'repost', 6, 'ooh pole san', NULL, 0, '2025-11-17 15:17:21');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','shipped','delivered','cancelled') DEFAULT 'pending',
  `payment_method_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shop_id`, `total_amount`, `status`, `payment_method_id`, `created_at`) VALUES
(1, 1, 1, 19.98, 'paid', 1, '2025-11-05 16:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`) VALUES
(1, 1, 1, 2, 9.99, '2025-11-05 16:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `status` enum('pending','completed','failed','refunded') DEFAULT 'pending',
  `transaction_id` varchar(100) DEFAULT NULL,
  `gateway_response` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `method_type` enum('card','paypal','bank','upi','wallet') NOT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `account_details` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `user_id`, `method_type`, `provider`, `account_details`, `is_default`, `added_at`) VALUES
(1, 1, 'card', 'Visa', '**** **** **** 1234', 1, '2025-11-05 16:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `category` varchar(50) DEFAULT NULL,
  `media_urls` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`media_urls`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `shop_id`, `product_name`, `description`, `price`, `stock`, `category`, `media_urls`, `created_at`) VALUES
(1, 1, 'Coffee Mug', NULL, 9.99, 100, NULL, NULL, '2025-11-05 16:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `full_name`, `phone`, `profile_pic`, `bio`, `address`, `created_at`) VALUES
(1, 1, 'Alice', '1234567890', NULL, 'Shop owner', NULL, '2025-11-05 16:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `search_logs`
--

CREATE TABLE `search_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `search_query` varchar(255) NOT NULL,
  `search_results_count` int(11) DEFAULT NULL,
  `searched_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `search_logs`
--

INSERT INTO `search_logs` (`id`, `user_id`, `search_query`, `search_results_count`, `searched_at`) VALUES
(1, 1, 'Wireless Mouse', 15, '2025-11-05 16:22:25'),
(2, 2, 'Coffee Mug', 8, '2025-11-05 16:22:25'),
(3, 1, 'Bluetooth Speaker', 12, '2025-11-05 16:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `sellonamamazahub`
--

CREATE TABLE `sellonamamazahub` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `provider_id` bigint(20) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `media_urls` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`media_urls`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `provider_id`, `service_name`, `description`, `price`, `duration_minutes`, `media_urls`, `created_at`) VALUES
(1, 1, 'Home Cleaning', NULL, 50.00, NULL, NULL, '2025-11-05 16:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `service_bookings`
--

CREATE TABLE `service_bookings` (
  `id` bigint(20) NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `provider_id` bigint(20) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','in_progress','completed','cancelled','rejected') DEFAULT 'pending',
  `special_requests` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_reviews`
--

CREATE TABLE `service_reviews` (
  `id` bigint(20) NOT NULL,
  `service_id` int(11) NOT NULL,
  `booking_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` bigint(20) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `owner_id` bigint(20) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `shop_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `owner_id`, `shop_name`, `description`, `shop_logo`, `created_at`) VALUES
(1, 1, 'Alice Shop', 'Best products online', NULL, '2025-11-05 16:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `termsandconditions`
--

CREATE TABLE `termsandconditions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `theme_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `profile_pic_url` text DEFAULT NULL,
  `banner_url` text DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `followers_count` int(11) DEFAULT 0,
  `following_count` int(11) DEFAULT 0,
  `posts_count` int(11) DEFAULT 0,
  `likes_received` int(11) DEFAULT 0,
  `verified` tinyint(1) DEFAULT 0,
  `account_type` enum('creator','viewer','business','admin') DEFAULT 'viewer',
  `is_private` tinyint(1) DEFAULT 0,
  `language` varchar(20) DEFAULT 'en',
  `region` varchar(100) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `theme` enum('light','dark','system') DEFAULT 'system',
  `status` enum('active','suspended','banned','deleted') DEFAULT 'active',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verification_code` varchar(6) DEFAULT NULL,
  `verification_code_expires` datetime DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `display_name`, `email`, `phone_number`, `password`, `bio`, `profile_pic_url`, `banner_url`, `website_url`, `followers_count`, `following_count`, `posts_count`, `likes_received`, `verified`, `account_type`, `is_private`, `language`, `region`, `timezone`, `theme`, `status`, `last_login`, `created_at`, `updated_at`, `verification_code`, `verification_code_expires`, `email_verified`) VALUES
(1, 'alice', NULL, 'alice@example.com', NULL, '$2y$10$yqRChbcR7lhkODr7bml7VO30zglVkQYZUrUQ0ik.a9GwYOJev3CBG', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'viewer', 0, 'en', NULL, NULL, 'system', 'active', '2025-11-17 11:38:04', '2025-11-05 16:53:41', '2025-11-21 12:19:22', NULL, NULL, 0),
(2, 'patrick', NULL, 'ppatcreator@gmail.com', NULL, '$2y$10$3/iprN9rfzh5MfrV3.FWo.qW.1BQ/m8uD.IMPNRshXkhICjeULrpG', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'viewer', 0, 'en', NULL, NULL, 'system', 'active', NULL, '2025-11-10 11:48:35', '2025-11-21 09:55:56', NULL, NULL, 0),
(3, 'shalom', NULL, 'shalomo@gmail.com', NULL, '$2y$10$.tBB9KtDuMqD1U2JskLeNeZPB96D4y2tLMxJoN5tmK7E5xDwEaJCy', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'viewer', 0, 'en', NULL, NULL, 'system', 'active', NULL, '2025-11-10 11:49:59', '2025-11-21 09:55:55', NULL, NULL, 0),
(4, 'test1', NULL, 'test1@gmail.com', NULL, '$2y$10$MuRKTzMlvl9pItIaiuwG.eppNVBUARM2xTw/1gwleK0pG6VwW.HNu', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'viewer', 0, 'en', NULL, NULL, 'system', 'active', NULL, '2025-11-17 08:49:30', '2025-11-21 12:19:22', NULL, NULL, 0),
(5, 'test2', NULL, 'niyonkurushalom2003@gmail.com', NULL, '$2y$10$nNtHa6HG0cnp9ytHj8pK/.6/uaj7KxUZCM7qlI1XRqwQ/Vqw04Wo6', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'viewer', 0, 'en', NULL, NULL, 'system', 'active', NULL, '2025-11-18 14:24:49', '2025-12-03 17:23:59', '9b8fca', '2025-12-03 20:23:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','not-active') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_categories`
--

CREATE TABLE `user_categories` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `interest_level` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar_url` varchar(500) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT 'other',
  `date_of_birth` date DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_links`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','not-active') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `first_name`, `last_name`, `username`, `email`, `phone`, `avatar_url`, `bio`, `gender`, `date_of_birth`, `country`, `city`, `state`, `zip_code`, `social_links`, `created_at`, `updated_at`, `status`) VALUES
(1, 0, 'big', '', 'big', 'big@gmail.com', '', '', '', '', '0000-00-00', '', '', '', '', NULL, '2025-11-07 07:37:40', '2025-11-07 07:37:40', 'active'),
(4, 4009, 'patrick', 'Nshimiyimana', 'patrick', 'ppatcreator@gmail.com', '0783999980', 'avatar_4009_1760361980.png', 'I\'m developer', '', '0000-00-00', '', '', '', '', '{\"fb\":\"fb.com\"}', '2025-10-05 14:09:57', '2025-10-13 13:26:20', 'active'),
(5, 4010, 'Nshimiyimana', 'Patrick', 'admin', 'admin@gmail.com', '0783999980', 'avatar_4010_1759824110.png', 'I\'m admin', '', '0000-00-00', '', '', '', '', '{\"facebook\":\"htpps:facebook.com\"}', '2025-10-07 07:58:58', '2025-10-07 08:01:50', 'active'),
(6, 4011, 'admin1', 'Nshimiyimana Patrick', 'admin1', 'admin1@gmail.com', '0783999980', 'avatar_4011_1761910942.png', 'I\'m programmer', '', '0000-00-00', '', '', '', '', '{}', '2025-10-16 07:15:42', '2025-10-31 11:42:22', 'active'),
(7, 3, 'shalom', '', 'shalom', 'shalomo@gmail.com', '', '', '', '', '0000-00-00', '', '', '', '', NULL, '2025-11-10 11:49:59', '2025-11-10 11:49:59', 'active'),
(8, 4, 'test1', '', 'test1', 'test1@gmail.com', '', '', '', '', '0000-00-00', '', '', '', '', NULL, '2025-11-17 08:49:30', '2025-11-17 08:49:30', 'active'),
(9, 5, 'test2', '', 'test2', 'niyonkurushalom2003@gmail.com', '', '', '', '', '0000-00-00', '', '', '', '', NULL, '2025-11-18 14:24:49', '2025-11-18 14:24:49', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `type` enum('deposit','withdrawal','payment','refund') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `status` enum('pending','completed','failed') DEFAULT 'pending',
  `description` text DEFAULT NULL,
  `transaction_ref` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertiser_id` (`advertiser_id`);

--
-- Indexes for table `ad_impressions`
--
ALTER TABLE `ad_impressions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_id` (`ad_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_participants`
--
ALTER TABLE `chat_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id` (`content_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `status` (`status`);
ALTER TABLE `comments` ADD FULLTEXT KEY `text` (`text`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `media_type` (`media_type`),
  ADD KEY `status` (`status`);
ALTER TABLE `contents` ADD FULLTEXT KEY `title` (`title`,`description`);

--
-- Indexes for table `content_categories`
--
ALTER TABLE `content_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_content_category` (`content_id`,`category_id`),
  ADD KEY `content_id` (`content_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `explore_feed`
--
ALTER TABLE `explore_feed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_explore_content` (`content_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `rank_score` (`rank_score`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_follow` (`follower_id`,`following_id`),
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `following_id` (`following_id`);

--
-- Indexes for table `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`user_id`,`target_type`,`target_id`),
  ADD KEY `target_type` (`target_type`,`target_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `moderation_logs`
--
ALTER TABLE `moderation_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id` (`content_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notification_content` (`content_id`),
  ADD KEY `recipient_id` (`recipient_id`),
  ADD KEY `actor_id` (`actor_id`),
  ADD KEY `type` (`type`),
  ADD KEY `is_read` (`is_read`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `payment_method_id` (`payment_method_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_method_id` (`payment_method_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `search_logs`
--
ALTER TABLE `search_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellonamamazahub`
--
ALTER TABLE `sellonamamazahub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `service_bookings`
--
ALTER TABLE `service_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `service_reviews`
--
ALTER TABLE `service_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_booking_review` (`booking_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id` (`content_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `termsandconditions`
--
ALTER TABLE `termsandconditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD KEY `username_2` (`username`),
  ADD KEY `email_2` (`email`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_categories`
--
ALTER TABLE `user_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_category` (`user_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_method_id` (`payment_method_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ad_impressions`
--
ALTER TABLE `ad_impressions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `chat_participants`
--
ALTER TABLE `chat_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `content_categories`
--
ALTER TABLE `content_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `explore_feed`
--
ALTER TABLE `explore_feed`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `help`
--
ALTER TABLE `help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `moderation_logs`
--
ALTER TABLE `moderation_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `search_logs`
--
ALTER TABLE `search_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sellonamamazahub`
--
ALTER TABLE `sellonamamazahub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_bookings`
--
ALTER TABLE `service_bookings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_reviews`
--
ALTER TABLE `service_reviews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `termsandconditions`
--
ALTER TABLE `termsandconditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_categories`
--
ALTER TABLE `user_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`advertiser_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ad_impressions`
--
ALTER TABLE `ad_impressions`
  ADD CONSTRAINT `ad_impressions_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ad_impressions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `chat_participants`
--
ALTER TABLE `chat_participants`
  ADD CONSTRAINT `chat_participants_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_participants_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comment_content` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comment_parent` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `fk_contents_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `content_categories`
--
ALTER TABLE `content_categories`
  ADD CONSTRAINT `fk_cc_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cc_content` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `explore_feed`
--
ALTER TABLE `explore_feed`
  ADD CONSTRAINT `fk_explore_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_explore_content` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `fk_follower` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_following` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_like_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `moderation_logs`
--
ALTER TABLE `moderation_logs`
  ADD CONSTRAINT `moderation_logs_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `moderation_logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notification_actor` FOREIGN KEY (`actor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_notification_content` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_notification_recipient` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_bookings`
--
ALTER TABLE `service_bookings`
  ADD CONSTRAINT `service_bookings_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_bookings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_bookings_ibfk_3` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_reviews`
--
ALTER TABLE `service_reviews`
  ADD CONSTRAINT `service_reviews_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_reviews_ibfk_2` FOREIGN KEY (`booking_id`) REFERENCES `service_bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_reviews_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`),
  ADD CONSTRAINT `shares_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_categories`
--
ALTER TABLE `user_categories`
  ADD CONSTRAINT `user_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `wallet_transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wallet_transactions_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
