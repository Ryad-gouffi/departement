-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 12:32 AM
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
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fullname`, `email`, `password`) VALUES
(1, 'g', 'g', 'g'),
(3, 'a', 'a@gmail.com', 'aaa'),
(4, 'eee', 'aa@gmail.com', 'eee'),
(5, 'yahiaten Said', 'yahiaten@gmail.com', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `demandes`
--

CREATE TABLE `demandes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `typefichier` varchar(255) NOT NULL,
  `addon` date NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `numerotlfn` varchar(255) DEFAULT NULL,
  `descriptions` varchar(255) DEFAULT NULL,
  `urgent` tinyint(1) DEFAULT NULL,
  `urgentdate` date DEFAULT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `statu` varchar(100) NOT NULL,
  `foreign_key` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `demandes`
--

INSERT INTO `demandes` (`id`, `typefichier`, `addon`, `email`, `numerotlfn`, `descriptions`, `urgent`, `urgentdate`, `observation`, `statu`, `foreign_key`) VALUES
(39, 'releve', '2024-11-25', '', '', '', 1, '2024-01-01', NULL, 'inprocess', 31216717),
(49, 'releve', '2024-11-29', '', '', '', 1, '2024-01-31', '', 'ready', 31216713),
(51, 'releve', '2024-11-29', 'sqdf', 'sf', 'sqdf', 0, NULL, NULL, 'inprocess', 31216713),
(53, 'certificat', '2025-04-16', 'katia@gmqi.com', '', '', 1, '2025-04-16', 'arwah departement', 'ready', 31216713);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_title` varchar(255) DEFAULT NULL,
  `event_content` varchar(1000) DEFAULT NULL,
  `image_path` varchar(1000) DEFAULT NULL,
  `event_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_title`, `event_content`, `image_path`, `event_date`) VALUES
(1, 'RIGLEMENT DE DEPARTEMENT', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.', NULL, '2025-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('file','folder') NOT NULL,
  `path` text NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `upload_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `type`, `path`, `author`, `description`, `upload_date`) VALUES
(3, 'algebre', 'folder', 'courses/L1', '', '', '2025-04-23 15:42:16'),
(4, 'analyse', 'folder', 'courses/L1', '', '', '2025-04-23 15:42:25'),
(5, 'THEMES.txt', 'file', 'courses/L1', 'ryad', '', '2025-04-23 15:42:56'),
(6, 'THL', 'folder', 'courses/L2', '', '', '2025-04-23 15:43:07'),
(7, 'licence.txt', 'file', 'edt/L1', 'ryad', '', '2025-04-23 15:43:26'),
(8, 'structure machine', 'folder', 'courses/L1', '', '', '2025-04-23 16:07:42'),
(9, 'THEMES.txt', 'file', 'courses/L1/structure machine', 'ryad', '', '2025-04-23 16:08:03'),
(10, 'a', 'folder', 'courses/L1/algebre', '', '', '2025-04-23 16:08:50'),
(11, 'TP', 'folder', 'courses/L1', '', '', '2025-04-23 17:07:46'),
(12, 'New Text Document.txt', 'file', 'edt/L1', 'ryad', '', '2025-04-29 20:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `target_level` int(5) NOT NULL DEFAULT 1,
  `news_content` varchar(1000) DEFAULT NULL,
  `news_date_posted` date DEFAULT current_timestamp(),
  `news_publisher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `target_level`, `news_content`, `news_date_posted`, `news_publisher`) VALUES
(1, 1, 'Salem Saha Ramdhankoum La consultation des copies d\'examens est programmé demain matin (05/02/2025) à 9H30 bloc 4 RDC ', '2025-04-28', 1),
(2, 2, 'Bonsoir, Voici le détail de vos notes de contrôle continu (CC) : Mini-projet : /20 CC : /10 Moyenne : (mini-projet + 2 × CC) / 2 Seuls les étudiants qui n\'ont pas passé le deuxième contrôle continu et qui ont fourni une justification auront le droit de passer un test de remplacement après les examens.', '2025-04-28', 3),
(3, 1, 'Salem Saha Ramdhankoum La consultation des copies d\'examens est programmé demain matin (05/02/2025) à 9H30 bloc 4 RDC ', '2025-04-28', 1),
(4, 2, 'Bonsoir, Voici le détail de vos notes de contrôle continu (CC) : Mini-projet : /20 CC : /10 Moyenne : (mini-projet + 2 × CC) / 2 Seuls les étudiants qui n\'ont pas passé le deuxième contrôle continu et qui ont fourni une justification auront le droit de passer un test de remplacement après les examens.', '2025-04-28', 3),
(5, 5, 'good job', '2025-04-28', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matricule` bigint(20) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `styear` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `matricule`, `password`, `name`, `surname`, `styear`) VALUES
(1, 31216713, 'password', 'Gouffi', 'mohamed ryad', 3),
(2, 31216714, 'password', 'salhi', 'nabil', 3),
(4, 31216715, 'password', 'anis', 'boussaha', 2),
(7, 31216716, 'password', 'BOUCHMOUKHA', 'RAID', 1),
(8, 31216717, 'password', 'OUZIA', 'ALI', 4),
(9, 31216718, 'password', 'YAHIAOUI', 'MOHAMED', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `demandes`
--
ALTER TABLE `demandes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
