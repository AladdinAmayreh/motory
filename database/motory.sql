-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2025 at 09:49 PM
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
-- Database: `motory`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `views`, `created_at`, `updated_at`) VALUES
(2, 'خدمات المساعدة والضمان', 'خدمات المساعدة والضمان', 3, '2025-01-23 21:47:28', '2025-01-25 20:49:08'),
(3, 'خدمات الحماية', 'خدمات الحماية', 0, '2025-01-23 22:25:58', '2025-01-25 20:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `change_logs`
--

CREATE TABLE `change_logs` (
  `id` int(11) NOT NULL,
  `entity` varchar(50) NOT NULL COMMENT 'services or categories',
  `entity_id` int(11) NOT NULL COMMENT 'ID of the service or category',
  `action` varchar(50) NOT NULL COMMENT 'create, update, delete',
  `changes` text NOT NULL COMMENT 'JSON format of changes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `change_logs`
--

INSERT INTO `change_logs` (`id`, `entity`, `entity_id`, `action`, `changes`, `created_at`) VALUES
(70, 'Service', 16, 'create', '{\n    \"id\": 16,\n    \"name\": \"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0637\\u0631\\u064a\\u0642(\\u0627\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n    \"description\": \"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0637\\u0631\\u064a\\u0642(\\u0627\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n    \"price\": \"230\",\n    \"discount_price\": \"0\",\n    \"insurance_years\": \"3\",\n    \"image_url\": null,\n    \"status\": \"1\",\n    \"category_id\": \"2\",\n    \"views\": null,\n    \"created_at\": null,\n    \"updated_at\": null\n}', '2025-01-25 20:14:41'),
(71, 'Service', 17, 'create', '{\n    \"id\": 17,\n    \"name\": \"\\u0627\\u0644\\u0636\\u0645\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0645\\u062a\\u062f(\\u0644\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n    \"description\": \"\\u0627\\u0644\\u0636\\u0645\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0645\\u062a\\u062f(\\u0644\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n    \"price\": \"2000\",\n    \"discount_price\": \"1725\",\n    \"insurance_years\": \"3\",\n    \"image_url\": null,\n    \"status\": \"1\",\n    \"category_id\": \"2\",\n    \"views\": null,\n    \"created_at\": null,\n    \"updated_at\": null\n}', '2025-01-25 20:15:44'),
(72, 'Service', 18, 'create', '{\n    \"id\": 18,\n    \"name\": \"\\u0627\\u0644\\u0636\\u0645\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0645\\u062a\\u062f(\\u0644\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u062a\\u0639\\u0645\\u0644\\u0629)\",\n    \"description\": \"\\u0627\\u0644\\u0636\\u0645\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0645\\u062a\\u062f(\\u0644\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u062a\\u0639\\u0645\\u0644\\u0629)\",\n    \"price\": \"2000\",\n    \"discount_price\": \"1610\",\n    \"insurance_years\": \"3\",\n    \"image_url\": null,\n    \"status\": \"1\",\n    \"category_id\": \"2\",\n    \"views\": null,\n    \"created_at\": null,\n    \"updated_at\": null\n}', '2025-01-25 20:16:31'),
(73, 'Service', 19, 'create', '{\n    \"id\": 19,\n    \"name\": \"\\u0627\\u0644\\u062d\\u0645\\u0627\\u064a\\u0629 \\u0627\\u0644\\u0642\\u064a\\u0627\\u0633\\u064a\\u0629\",\n    \"description\": \"\\u0627\\u0644\\u062d\\u0645\\u0627\\u064a\\u0629 \\u0627\\u0644\\u0642\\u064a\\u0627\\u0633\\u064a\\u0629\",\n    \"price\": \"3000\",\n    \"discount_price\": \"2300\",\n    \"insurance_years\": \"10\",\n    \"image_url\": null,\n    \"status\": \"1\",\n    \"category_id\": \"3\",\n    \"views\": null,\n    \"created_at\": null,\n    \"updated_at\": null\n}', '2025-01-25 20:17:23'),
(74, 'Service', 20, 'create', '{\n    \"id\": 20,\n    \"name\": \"\\u0627\\u0644\\u062d\\u0645\\u0627\\u064a\\u0629 \\u0627\\u0644\\u0643\\u0627\\u0645\\u0644\\u0629 \\u0644\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0633\\u064a\\u062f\\u0627\\u0646\",\n    \"description\": \"\\u0627\\u0644\\u062d\\u0645\\u0627\\u064a\\u0629 \\u0627\\u0644\\u0643\\u0627\\u0645\\u0644\\u0629 \\u0644\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0633\\u064a\\u062f\\u0627\\u0646\",\n    \"price\": \"10350\",\n    \"discount_price\": \"0\",\n    \"insurance_years\": \"10\",\n    \"image_url\": null,\n    \"status\": \"1\",\n    \"category_id\": \"3\",\n    \"views\": null,\n    \"created_at\": null,\n    \"updated_at\": null\n}', '2025-01-25 20:18:24'),
(75, 'Service', 16, 'update', '{\n    \"new\": {\n        \"id\": 16,\n        \"name\": \"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0637\\u0631\\u064a\\u0642(\\u0627\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n        \"description\": \"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0637\\u0631\\u064a\\u0642(\\u0627\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n        \"price\": \"230.00\",\n        \"discount_price\": \"0.00\",\n        \"insurance_years\": 3,\n        \"image_url\": null,\n        \"status\": false,\n        \"category_id\": 2,\n        \"views\": 0,\n        \"created_at\": \"2025-01-25 23:14:41\",\n        \"updated_at\": \"2025-01-25 23:14:41\"\n    }\n}', '2025-01-25 20:28:49'),
(76, 'Service', 16, 'update', '{\n    \"new\": {\n        \"id\": 16,\n        \"name\": \"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0637\\u0631\\u064a\\u0642(\\u0627\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n        \"description\": \"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0637\\u0631\\u064a\\u0642(\\u0627\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n        \"price\": \"230.00\",\n        \"discount_price\": \"0.00\",\n        \"insurance_years\": 3,\n        \"image_url\": null,\n        \"status\": 0,\n        \"category_id\": 2,\n        \"views\": 1,\n        \"created_at\": \"2025-01-25 23:14:41\",\n        \"updated_at\": \"2025-01-25 23:28:49\"\n    }\n}', '2025-01-25 20:30:54'),
(77, 'Category', 2, 'update', '{\n    \"new\": {\n        \"id\": 2,\n        \"name\": \"\\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0648\\u0627\\u0644\\u0636\\u0645\\u0627\\u0646\",\n        \"description\": \"\\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0648\\u0627\\u0644\\u0636\\u0645\\u0627\\u0646\",\n        \"views\": 1,\n        \"created_at\": \"2025-01-24 00:47:28\",\n        \"updated_at\": \"2025-01-25 23:10:18\"\n    }\n}', '2025-01-25 20:30:54'),
(78, 'Service', 16, 'update', '{\n    \"new\": {\n        \"id\": 16,\n        \"name\": \"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0637\\u0631\\u064a\\u0642(\\u0627\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n        \"description\": \"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0637\\u0631\\u064a\\u0642(\\u0627\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n        \"price\": \"230.00\",\n        \"discount_price\": \"0.00\",\n        \"insurance_years\": 3,\n        \"image_url\": null,\n        \"status\": 0,\n        \"category_id\": 2,\n        \"views\": 2,\n        \"created_at\": \"2025-01-25 23:14:41\",\n        \"updated_at\": \"2025-01-25 23:30:54\"\n    }\n}', '2025-01-25 20:31:41'),
(79, 'Category', 2, 'update', '{\n    \"new\": {\n        \"id\": 2,\n        \"name\": \"\\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0648\\u0627\\u0644\\u0636\\u0645\\u0627\\u0646\",\n        \"description\": \"\\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0648\\u0627\\u0644\\u0636\\u0645\\u0627\\u0646\",\n        \"views\": 2,\n        \"created_at\": \"2025-01-24 00:47:28\",\n        \"updated_at\": \"2025-01-25 23:30:54\"\n    }\n}', '2025-01-25 20:31:41'),
(80, 'Service', 16, 'update', '{\n    \"new\": {\n        \"id\": 16,\n        \"name\": \"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0637\\u0631\\u064a\\u0642(\\u0627\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n        \"description\": \"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0637\\u0631\\u064a\\u0642(\\u0627\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n        \"price\": \"230.00\",\n        \"discount_price\": \"0.00\",\n        \"insurance_years\": 3,\n        \"image_url\": null,\n        \"status\": true,\n        \"category_id\": 2,\n        \"views\": 2,\n        \"created_at\": \"2025-01-25 23:14:41\",\n        \"updated_at\": \"2025-01-25 23:31:41\"\n    }\n}', '2025-01-25 20:38:07'),
(81, 'Service', 17, 'update', '{\n    \"new\": {\n        \"id\": 17,\n        \"name\": \"\\u0627\\u0644\\u0636\\u0645\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0645\\u062a\\u062f(\\u0644\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n        \"description\": \"\\u0627\\u0644\\u0636\\u0645\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0645\\u062a\\u062f(\\u0644\\u0644\\u0633\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629)\",\n        \"price\": \"2000.00\",\n        \"discount_price\": \"1725.00\",\n        \"insurance_years\": 3,\n        \"image_url\": null,\n        \"status\": 1,\n        \"category_id\": 2,\n        \"views\": 1,\n        \"created_at\": \"2025-01-25 23:15:44\",\n        \"updated_at\": \"2025-01-25 23:15:44\"\n    }\n}', '2025-01-25 20:49:08'),
(82, 'Category', 2, 'update', '{\n    \"new\": {\n        \"id\": 2,\n        \"name\": \"\\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0648\\u0627\\u0644\\u0636\\u0645\\u0627\\u0646\",\n        \"description\": \"\\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0629 \\u0648\\u0627\\u0644\\u0636\\u0645\\u0627\\u0646\",\n        \"views\": 3,\n        \"created_at\": \"2025-01-24 00:47:28\",\n        \"updated_at\": \"2025-01-25 23:31:41\"\n    }\n}', '2025-01-25 20:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1737661475),
('m250123_194107_create_categories_table', 1737661477),
('m250123_194124_create_services_table', 1737661477),
('m250123_194133_create_change_logs_table', 1737661477),
('m250124_194745_create_services_images_table', 1737748113);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `insurance_years` int(11) DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '1: Published, 0: Unpublished',
  `category_id` int(11) NOT NULL,
  `views` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `discount_price`, `insurance_years`, `image_url`, `status`, `category_id`, `views`, `created_at`, `updated_at`) VALUES
(16, 'المساعدة على الطريق(السيارات الجديدة)', 'المساعدة على الطريق(السيارات الجديدة)', 230.00, 0.00, 3, NULL, 1, 2, 2, '2025-01-25 20:14:41', '2025-01-25 20:38:07'),
(17, 'الضمان الممتد(للسيارات الجديدة)', 'الضمان الممتد(للسيارات الجديدة)', 2000.00, 1725.00, 3, NULL, 1, 2, 1, '2025-01-25 20:15:44', '2025-01-25 20:49:08'),
(18, 'الضمان الممتد(للسيارات المستعملة)', 'الضمان الممتد(للسيارات المستعملة)', 2000.00, 1610.00, 3, NULL, 1, 2, 0, '2025-01-25 20:16:31', '2025-01-25 20:16:31'),
(19, 'الحماية القياسية', 'الحماية القياسية', 3000.00, 2300.00, 10, NULL, 1, 3, 0, '2025-01-25 20:17:23', '2025-01-25 20:17:23'),
(20, 'الحماية الكاملة للسيارات السيدان', 'الحماية الكاملة للسيارات السيدان', 10350.00, 0.00, 10, NULL, 1, 3, 0, '2025-01-25 20:18:24', '2025-01-25 20:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `services_images`
--

CREATE TABLE `services_images` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services_images`
--

INSERT INTO `services_images` (`id`, `service_id`, `image_url`, `created_at`, `updated_at`) VALUES
(10, 16, '/uploads/6795463106557.png', '2025-01-25 20:14:41', '2025-01-25 20:14:41'),
(11, 17, '/uploads/67954670cc368.png', '2025-01-25 20:15:44', '2025-01-25 20:15:44'),
(12, 18, '/uploads/6795469f34749.png', '2025-01-25 20:16:31', '2025-01-25 20:16:31'),
(13, 19, '/uploads/679546d34d79b.png', '2025-01-25 20:17:23', '2025-01-25 20:17:23'),
(14, 20, '/uploads/679547100f126.png', '2025-01-25 20:18:24', '2025-01-25 20:18:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `change_logs`
--
ALTER TABLE `change_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-services-category_id` (`category_id`);

--
-- Indexes for table `services_images`
--
ALTER TABLE `services_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-services_images-service_id` (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `change_logs`
--
ALTER TABLE `change_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `services_images`
--
ALTER TABLE `services_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk-services-category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services_images`
--
ALTER TABLE `services_images`
  ADD CONSTRAINT `fk-services_images-service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
