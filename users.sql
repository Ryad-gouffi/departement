-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 06:23 AM
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
CREATE DATABASE IF NOT EXISTS `users` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `users`;

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
(55, 'certificat', '2025-05-11', 'ryad@gmail.com', '05512345679', 'Hello mister!', 1, '2025-05-14', NULL, 'inprocess', 31216713),
(56, 'attestation', '2025-05-14', 'ryad55a@gmail.com', '05512345679', 'pls hurry i need it asap', 1, '2025-05-12', 'come and get your document', 'ready', 31216713),
(57, 'releve', '2025-05-14', 'rran@gmail.com', '', 'nabil salhi loves couscous', 0, NULL, 'few informations are missing! come to departement', 'refused', 31216713),
(58, 'attestation', '2025-05-12', 'example@gmail.com', '05512345679', 'hellooooooooooooooooo', 0, NULL, NULL, 'inprocess', 31216714),
(59, 'releve', '2025-05-14', 'example@gmail.com', '05512345679', '', 0, NULL, 'Good!', 'ready', 31216714),
(60, 'certificat', '2025-05-16', 'example2@gmail.com', '', 'jajaja!!', 1, '2025-05-15', NULL, 'inprocess', 31216715),
(61, 'releve', '2025-05-14', 'example@gmail.com', '', 'printf(\"Error\") // am Joking there is no error', 0, NULL, 'Refusé !!!', 'refused', 31216715),
(62, 'certificat', '2025-05-12', 'example4@gmail.com', '', '', 0, NULL, NULL, 'inprocess', 31216716),
(63, 'attestation', '2025-05-13', 'example@gmail.com', '', 'cristiano Suiiiiiiiiiiii', 1, '2025-05-11', NULL, 'inprocess', 31216716);

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
(10, 'AI Competition', 'تنظيم المسابقة الوطنية الجامعية في البرمجة باستخدام تقنيات الذكاء الاصطناعي – طبعة جزائرية تونسية، في جامعة الشاذلي بن جديد – الطارف، وذلك خلال الفترة الممتدة من 17 إلى 19 ماي 2025\r\n\r\nhttps://www.facebook.com/share/p/16NQ373ta5/', 'event1.jpg', '2025-05-11'),
(11, 'Nouveau Recteur de UMBB', 'تم اليوم الإثنين 21 أفريل 2025  تنصيب المدير الجديد لجامعة أمحمد بوقرة بومرداس البروفيسور نورالدين عبد الباقي خلفا للبروفيسور مصطفى ياحي  من طرف المفتش العام لوزارة التعليم العالي والبحث العلمي البروفيسور حسين فوزاري وبحضور مدير ديوان الوالي لولاية بومرداس والأسرة الجامعية\r\n\r\nInstallation du nouveau Recteur de l\'Université de Boumerdès, Professeur Noureddine ABDELBAKI  .en remplacement du Professeur Mostepha Yahi, et ce par le Inspecteur Général du Ministère de l’Enseignement Supérieur et de la Recherche Scientifique professeur Hocine FOUZARI , en présence du chef de cabinet de la Wilaya de Boumerdès, et des responsables de l’Université de Boumerdès.', 'event2.jpg', '2025-05-11'),
(12, 'IA et Programmation', 'Appel à participation\r\nOlympiades nationales sur la programmation informatique et Intelligence Artificielle\r\nOrganisées par le Ministre de l’enseignement supérieur et de la recherche scientifique:\r\nVous trouverez en pièce jointe les documents nécessaires relatifs à cet événement, incluant le fichier des conditions de participation et les échéances suivantes à respecter :\r\n· Période d’inscription : du 18 au 27 mars 2025\r\n· Sélection locale : Deux représentants par domaine (Intelligence Artificielle et Programmation) pour chaque établissement universitaire – 30 avril 2025\r\n· Sélection régionale : Deux représentants par domaine (Intelligence Artificielle et Programmation) pour chaque conférence régionale (Est, Ouest, Centre) – 10 mai 2025\r\n· Sélection nationale : Trois lauréats pour chaque domaine (Intelligence Artificielle et Programmation)\r\n· Annonce des résultats : 15 mai 2025\r\nLa compétition est ouverte aux étudiants inscrits dans les établissements universitaires, tous niveaux académ', 'event3.jpg', '2025-05-11'),
(13, 'Séance de préparation', 'Dans le cadre des préparations aux concours académiques en informatique et intelligence artificielle, une séance de travail a été organisée ce lundi 12 mai 2025 au niveau du département d’informatique. Les étudiants participants ont profité de cette occasion pour réviser les concepts clés en algorithmique, programmation, et bases de données, en vue des sélections locales prévues à la fin du mois.\r\nCette initiative s’inscrit dans les efforts du département pour accompagner et encadrer ses étudiants dans les compétitions universitaires nationales, notamment les Olympiades en IA et en programmation.', 'event4.jpg', '2025-05-11'),
(14, 'Robotics Future!', 'The future is robotic, and it\'s already unfolding around us. From automated assistants to intelligent machines that can learn, adapt, and perform complex tasks, robotics is rapidly transforming every industry — and computer science is at the heart of this evolution.\r\n\r\nAt our Computer Science Department, we believe in preparing students not just for today\'s technologies, but for the innovations of tomorrow. That’s why we proudly support and encourage student-led robotics clubs and workshops. These groups provide hands-on experience in designing, building, and programming robots, integrating knowledge from multiple domains like artificial intelligence, machine learning, embedded systems, and mechanical design.\r\n\r\nWhether you\'re a beginner interested in learning how sensors work or an advanced student exploring humanoid movement algorithms, the department offers the space and mentorship to turn ideas into real-world prototypes. The future is being built — quite literally — and we invite ', 'event9.jpg', '2025-05-11'),
(15, 'Study Sprint', 'With exams approaching and project deadlines looming, the department is buzzing with focused energy. Students gather in study groups, balancing laptops and textbooks, merging theory with application.\r\n\r\nIn Computer Science, learning doesn\'t stop at lectures. It thrives in collaborative environments — discussing algorithms over coffee, debugging code with a peer, or diving into documentation late at night. The department encourages this active academic life by providing dedicated study spaces, labs, and access to digital resources.\r\n\r\nAs we enter the final stretch of the semester, we wish all our students the best. Remember, persistence beats panic. Your efforts now will shape your opportunities tomorrow.', 'event5.jpg', '2025-05-11'),
(16, 'Code in Action', 'Behind every sleek application or powerful AI model lies thousands of lines of code — precise, logical, and alive with potential. Coding is more than just syntax; it’s the language of innovation.\r\n\r\nOur department organizes regular coding workshops, hackathons, and challenges to keep students sharp and creative. These events aren’t just about solving problems — they’re about exploring possibilities, optimizing logic, and discovering elegant solutions.\r\n\r\nStay tuned for upcoming programming competitions and collaborative projects where you can put your skills to the test and learn from others in the community. Because in this field, the best way to grow is to keep coding.', 'event6.jpg', '2025-05-11'),
(17, 'Focus Mode', 'Computer Science is a discipline of detail. From tracing bugs to refining logic, every line matters. That’s why focus is one of the most important skills our students develop.\r\n\r\nThis photo represents the many quiet hours spent in “deep work” — where concepts are absorbed, code is written, and problems are solved. It’s this focused effort that transforms understanding into mastery.\r\n\r\nTo encourage this, the department offers quiet zones and solo workspaces designed for uninterrupted thought. We also organize \"Deep Dive\" sessions, where students can explore specific tech stacks or tools under guided mentorship, away from distractions. Success in this field begins with clarity — both in thought and in vision.', 'event8.jpg', '2025-05-11'),
(19, 'Bon courage', '𝗕𝗢𝗡𝗡𝗘 𝗖𝗛𝗔𝗡𝗖𝗘 À 𝗧𝗢𝗨𝗦 𝗡𝗢𝗦 É𝗧𝗨𝗗𝗜𝗔𝗡𝗧𝗦 𝗣𝗢𝗨𝗥 𝗟𝗘𝗦 𝗘𝗫𝗔𝗠𝗘𝗡𝗦\r\n\r\nA l\'occasion du début des  examens des semestres pairs  , nous souhaitons bon courage et beaucoup de réussite et de succès pour l\'ensemble des étudians DI.\r\n\r\nPuisse ces examens  se passer dans les meilleures conditions pour tous.', 'event10.jpg', '2025-05-11');

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
(17, 'Groupe1.PDF', 'file', 'edt/L1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:38:43'),
(18, 'Groupe2.PDF', 'file', 'edt/L1', 'Refada ImadEddin', '', '2025-05-11 05:42:05'),
(19, 'Groupe3.PDF', 'file', 'edt/L1', 'Salhi nabil', '', '2025-05-11 05:41:28'),
(20, 'Groupe4.PDF', 'file', 'edt/L1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:41:06'),
(23, 'Groupe5.PDF', 'file', 'edt/L1', 'Refada ImadEddin', '', '2025-05-11 05:42:00'),
(25, 'Groupe6.PDF', 'file', 'edt/L1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:40:35'),
(26, 'Groupe7.PDF', 'file', 'edt/L1', 'Salhi nabil', '', '2025-05-11 05:41:32'),
(28, 'Groupe8.PDF', 'file', 'edt/L1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:41:00'),
(29, 'groupe1.PDF', 'file', 'edt/L2', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:45:53'),
(30, 'groupe2.PDF', 'file', 'edt/L2', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:46:02'),
(31, 'autreGroupe.PDF', 'file', 'edt/L2', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:46:13'),
(32, 'ISIL.PDF', 'file', 'edt/L3', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:46:36'),
(33, 'SI.PDF', 'file', 'edt/L3', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:46:45'),
(34, 'groupe1.PDF', 'file', 'edt/M1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:47:29'),
(35, 'groupe2.PDF', 'file', 'edt/M1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:47:42'),
(36, 'section1.PDF', 'file', 'exams/L1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:48:44'),
(37, 'section2.PDF', 'file', 'exams/L1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:48:53'),
(38, 'section3.PDF', 'file', 'exams/L1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:49:02'),
(39, 'groupe1.PDF', 'file', 'exams/L2', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:49:15'),
(40, 'groupe2 (2).PDF', 'file', 'exams/L2', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:49:36'),
(41, 'groupe3.PDF', 'file', 'exams/L2', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:49:48'),
(42, 'SI.PDF', 'file', 'exams/L3', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:50:02'),
(43, 'ISIL.PDF', 'file', 'exams/L3', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:50:12'),
(44, 'ILTI.PDF', 'file', 'exams/M1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:50:26'),
(45, 'TI.PDF', 'file', 'exams/M1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:50:35'),
(46, 'groupe1.PDF', 'file', 'edt/M2', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:51:39'),
(47, 'groupe2.PDF', 'file', 'edt/M2', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:52:00'),
(48, 'all_groupes.PDF', 'file', 'exams/M2', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:52:56'),
(49, 'section1.PDF', 'file', 'notes/L1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:48:44'),
(50, 'section2.PDF', 'file', 'notes/L1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:48:53'),
(51, 'section3.PDF', 'file', 'notes/L1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:49:02'),
(52, 'groupe1.PDF', 'file', 'notes/L2', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:49:15'),
(53, 'groupe2 (2).PDF', 'file', 'notes/L2', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:49:36'),
(54, 'groupe3.PDF', 'file', 'notes/L2', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:49:48'),
(55, 'SI.PDF', 'file', 'notes/L3', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:50:02'),
(56, 'ISIL.PDF', 'file', 'notes/L3', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:50:12'),
(57, 'ILTI.PDF', 'file', 'notes/M1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:50:26'),
(58, 'TI.PDF', 'file', 'notes/M1', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:50:35'),
(59, 'chapitre1.PDF', 'file', 'courses\\L3\\S1\\ASI\\Cours', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:38:43'),
(60, 'chapitre2.PDF', 'file', 'courses\\L3\\S1\\ASI\\Cours', 'Refada ImadEddin', '', '2025-05-11 05:42:05'),
(61, 'chapitre3.PDF', 'file', 'courses\\L3\\S1\\ASI\\Cours', 'Salhi nabil', '', '2025-05-11 05:41:28'),
(62, 'examen2022.PDF', 'file', 'courses\\L3\\S1\\ASI\\Examens', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:41:06'),
(63, 'examen2021.PDF', 'file', 'courses\\L3\\S1\\ASI\\Examens', 'Refada ImadEddin', '', '2025-05-11 05:42:00'),
(64, 'Examen2020.PDF', 'file', 'courses\\L3\\S1\\ASI\\Examens', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:40:35'),
(65, 'td_et_tp1.PDF', 'file', 'courses\\L3\\S1\\ASI\\TD-TP', 'Salhi nabil', '', '2025-05-11 05:41:32'),
(66, 'section1.PDF', 'file', 'courses\\L3\\S1\\ASI\\TD-TP', 'Gouffi Mohamed Ryad', '', '2025-05-11 05:48:44'),
(67, 'S1', 'folder', 'courses/L1', '', '', '2025-05-11 06:20:26'),
(68, 'S2', 'folder', 'courses/L1', '', '', '2025-05-11 06:20:29'),
(69, 'S1', 'folder', 'courses/L3', '', '', '2025-05-11 06:20:45'),
(70, 'S2', 'folder', 'courses/L3', '', '', '2025-05-11 06:20:54'),
(71, 'GL', 'folder', 'courses/L3/S1', '', '', '2025-05-11 06:21:01'),
(72, 'ASI', 'folder', 'courses/L3/S1', '', '', '2025-05-11 06:21:09'),
(73, 'PAW', 'folder', 'courses/L3/S1', '', '', '2025-05-11 06:21:15'),
(74, 'SAD', 'folder', 'courses/L3/S1', '', '', '2025-05-11 06:21:18'),
(75, 'Cours', 'folder', 'courses/L3/S1/GL', '', '', '2025-05-11 06:21:41'),
(76, 'TD-TP', 'folder', 'courses/L3/S1/GL', '', '', '2025-05-11 06:21:47'),
(77, 'Examens', 'folder', 'courses/L3/S1/GL', '', '', '2025-05-11 06:21:52'),
(78, 'chapitre1.PDF', 'file', 'courses/L3/S1/GL/Cours', 'Alouane Besma', 'this is chapter 1', '2025-05-11 06:22:27'),
(79, 'chapitre2.PDF', 'file', 'courses/L3/S1/GL/Cours', 'Alouane Besma', '', '2025-05-11 06:22:43'),
(80, 'chapitre3.PDF', 'file', 'courses/L3/S1/GL/Cours', 'Alouane Besma', '', '2025-05-11 06:22:56'),
(81, 'td1.PDF', 'file', 'courses/L3/S1/GL/TD-TP', 'Alouane Besma', '', '2025-05-11 06:23:09'),
(82, 'td2.PDF', 'file', 'courses/L3/S1/GL/TD-TP', 'Alouane Besma', '', '2025-05-11 06:23:19'),
(83, 'td3.PDF', 'file', 'courses/L3/S1/GL/TD-TP', 'Alouane Besma', '', '2025-05-11 06:23:26'),
(84, 'tp1.PDF', 'file', 'courses/L3/S1/GL/TD-TP', 'Sabba Sabba', '', '2025-05-11 06:24:40'),
(85, 'tp2.PDF', 'file', 'courses/L3/S1/GL/TD-TP', 'Sabba Sabba', '', '2025-05-11 06:25:04'),
(86, 'examen2022.PDF', 'file', 'courses/L3/S1/GL/Examens', 'Alouane Besma', '', '2025-05-11 06:31:01'),
(87, 'examen2020.PDF', 'file', 'courses/L3/S1/GL/Examens', 'Alouane Besma', '', '2025-05-11 06:31:10'),
(89, 'Cours', 'folder', 'courses/L3/S1/ASI', '', '', '2025-05-11 06:21:41'),
(90, 'TD-TP', 'folder', 'courses/L3/S1/ASI', '', '', '2025-05-11 06:21:47'),
(91, 'Examens', 'folder', 'courses/L3/S1/ASI', '', '', '2025-05-11 06:21:52'),
(92, 'chapitre1.PDF', 'file', 'courses/L3/S1/ASI/Cours', 'Alouane Besma', 'this is chapter 1', '2025-05-11 06:22:27'),
(93, 'chapitre2.PDF', 'file', 'courses/L3/S1/ASI/Cours', 'Alouane Besma', '', '2025-05-11 06:22:43'),
(94, 'chapitre3.PDF', 'file', 'courses/L3/S1/ASI/Cours', 'Alouane Besma', '', '2025-05-11 06:22:56'),
(95, 'td1.PDF', 'file', 'courses/L3/S1/ASI/TD-TP', 'Alouane Besma', '', '2025-05-11 06:23:09'),
(96, 'td2.PDF', 'file', 'courses/L3/S1/ASI/TD-TP', 'Alouane Besma', '', '2025-05-11 06:23:19'),
(97, 'td3.PDF', 'file', 'courses/L3/S1/ASI/TD-TP', 'Alouane Besma', '', '2025-05-11 06:23:26'),
(98, 'tp1.PDF', 'file', 'courses/L3/S1/ASI/TD-TP', 'Sabba Sabba', '', '2025-05-11 06:24:40'),
(99, 'tp2.PDF', 'file', 'courses/L3/S1/ASI/TD-TP', 'Sabba Sabba', '', '2025-05-11 06:25:04'),
(100, 'examen2022.PDF', 'file', 'courses/L3/S1/ASI/Examens', 'Alouane Besma', '', '2025-05-11 06:31:01'),
(101, 'examen2020.PDF', 'file', 'courses/L3/S1/ASI/Examens', 'Alouane Besma', '', '2025-05-11 06:31:10'),
(102, 'Cours', 'folder', 'courses/L3/S1/PAW', '', '', '2025-05-11 06:21:41'),
(103, 'TD-TP', 'folder', 'courses/L3/S1/PAW', '', '', '2025-05-11 06:21:47'),
(104, 'Examens', 'folder', 'courses/L3/S1/PAW', '', '', '2025-05-11 06:21:52'),
(105, 'chapitre1.PDF', 'file', 'courses/L3/S1/PAW/Cours', 'Alouane Besma', 'this is chapter 1', '2025-05-11 06:22:27'),
(106, 'chapitre2.PDF', 'file', 'courses/L3/S1/PAW/Cours', 'Alouane Besma', '', '2025-05-11 06:22:43'),
(107, 'chapitre3.PDF', 'file', 'courses/L3/S1/PAW/Cours', 'Alouane Besma', '', '2025-05-11 06:22:56'),
(108, 'td1.PDF', 'file', 'courses/L3/S1/PAW/TD-TP', 'Alouane Besma', '', '2025-05-11 06:23:09'),
(109, 'td2.PDF', 'file', 'courses/L3/S1/PAW/TD-TP', 'Alouane Besma', '', '2025-05-11 06:23:19'),
(110, 'td3.PDF', 'file', 'courses/L3/S1/PAW/TD-TP', 'Alouane Besma', '', '2025-05-11 06:23:26'),
(111, 'tp1.PDF', 'file', 'courses/L3/S1/PAW/TD-TP', 'Sabba Sabba', '', '2025-05-11 06:24:40'),
(112, 'tp2.PDF', 'file', 'courses/L3/S1/PAW/TD-TP', 'Sabba Sabba', '', '2025-05-11 06:25:04'),
(113, 'examen2022.PDF', 'file', 'courses/L3/S1/PAW/Examens', 'Alouane Besma', '', '2025-05-11 06:31:01'),
(114, 'examen2020.PDF', 'file', 'courses/L3/S1/PAW/Examens', 'Alouane Besma', '', '2025-05-11 06:31:10'),
(115, 'SI', 'folder', 'courses/L3/S2', '', '', '2025-05-11 06:43:21'),
(116, 'RI', 'folder', 'courses/L3/S2', '', '', '2025-05-11 06:43:26'),
(117, 'Examens', 'folder', 'courses/L3/S2/SI', '', '', '2025-05-11 06:43:40'),
(118, 'Cours', 'folder', 'courses/L3/S2/SI', '', '', '2025-05-11 06:43:44'),
(119, 'Td-tp', 'folder', 'courses/L3/S2/SI', '', '', '2025-05-11 06:43:53'),
(120, 'examen2019.pdf', 'file', 'courses/L3/S2/SI/Examens', 'Alouane Besma', '', '2025-05-11 06:45:16'),
(121, 'examen2023.pdf', 'file', 'courses/L3/S2/SI/Examens', 'Alouane Besma', '', '2025-05-11 06:45:29'),
(122, 'chapitre1.pdf', 'file', 'courses/L3/S2/SI/Cours', 'Alouane Besma', '', '2025-05-11 06:45:41'),
(123, 'chapitre2.pdf', 'file', 'courses/L3/S2/SI/Cours', 'Alouane Besma', '', '2025-05-11 06:45:46'),
(124, 'chapitre3.pdf', 'file', 'courses/L3/S2/SI/Cours', 'Alouane Besma', '', '2025-05-11 06:45:50'),
(125, 'td1.pdf', 'file', 'courses/L3/S2/SI/Td-tp', 'Alouane Besma', '', '2025-05-11 06:46:01'),
(126, 'td2.pdf', 'file', 'courses/L3/S2/SI/Td-tp', 'Alouane Besma', '', '2025-05-11 06:46:06'),
(127, 'tp1.pdf', 'file', 'courses/L3/S2/SI/Td-tp', 'Alouane Besma', '', '2025-05-11 06:46:11'),
(128, 'S1', 'folder', 'courses/M2', '', '', '2025-05-11 06:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `target_level` varchar(100) NOT NULL DEFAULT 'all',
  `news_content` varchar(1000) DEFAULT NULL,
  `news_date_posted` date DEFAULT current_timestamp(),
  `news_publisher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `target_level`, `news_content`, `news_date_posted`, `news_publisher`) VALUES
(17, 'l2', '#Groupe1_6\r\nLes étudiants Li16 sont informés que les tests de remplacement THL sont prévus pour le :\r\n       Lundi  05/05/2025 / salle 5.303 \r\n - Test de remplacement TD de 13h15 à 13h55 (40 minutes)\r\n - Test de remplacement TP de 14h00 à 14h40 (40 minutes)\r\n\r\nTous les étudiants absents ayant déposé un justificatif d\'absence, sont autorisés à passer les tests TD et TP.', '2025-05-11', 18),
(22, 'l2', '#Groupe2_4_5\r\nSalem\r\nSaha Ramdhankoum\r\nLa consultation des copies d\'examens est programmé demain matin  (05/02/2025) à 9H30  bloc 4 RDC', '2025-05-11', 21),
(24, 'l3', '#Groupe1_5\r\nSalem\r\nVous allez faire l\'exercice Exercice 3 (tableau multidimensionnel) TP3\r\net Exercice 4  TP4', '2025-05-11', 21),
(25, 'l3', 'Les étudiants absents à l\'examen du module Reseau et disposant d\'un justificatif valable sont informés que l\'examen de remplacement aura lieu le mercredi 14 mai à 08h30 au niveau de la salle 4.102 (bloc4)', '2025-05-11', 18),
(27, 'm1', 'A l\'attention des étudiants en Master 1:\n\n Pour la préparation du deuxième Comité pédagogique du S2 pour les Master 1, les étudiants  des spécialité ILTI et TI ayant des remarques à exprimer sont invité à remplir le formulaire suivant :\nhttps://docs.google.com/forms/d/e/1FAIpQLSfn43jspAb3QCzZdHuW6r2LwfTG0IbJN0PKaCIkdQPt56r0LQ/viewform?usp=dialog\n\nLes délégués des groupes Master 1 sont invités à assister au CP2 qui aura lieu le mardi 29/04/2024 à 13h30 à la salle de conférence du département d\'informatique.', '2025-05-11', 18),
(28, 'l1 l2', '#Groupe3_4_5\r\nPréparation\r\nVous trouverez en attachement les support TP du module OPM et Veuillez préparer le TP 3 \r\nCordialement', '2025-05-11', 19),
(29, 'm2', 'Salem\nLes étudiants sont invités à constituer des groupes pour le mini-projet.\nUne fois le groupe créé, le projet doit être déposé sur Classroom en respectant les consignes suivantes : contenant votre projet. selon le nom du groupe indiqué dans le fichier Excel (ex. : Groupe 1, Groupe 2, etc.).À l\'intérieur du dossier :\n\n    Ajouter une capture d\'écran de votre projet intitulée .\n    Inclure un fichier texte contenant la liste des membres du groupe\n\nLe dernier délai est fixé pour le 01/12/2024\n\nLe test 2 est prévu le 11/12/ à 14h15 aprés le cours pour une durée de 45 min', '2025-05-11', 21);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `role` enum('admin','teacher') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `password`, `role`) VALUES
(15, 'Gouffi Mohamed Ryad', 'ryadgouffi@gmail.com', 'pass', 'admin'),
(16, 'Salhi nabil', 'salhi@gmail.com', 'pass', 'admin'),
(17, 'Refada ImadEddin', 'refada@gmail.com', 'pass', 'admin'),
(18, 'Alouane Besma', 'alouane@gmail.com', 'pass', 'teacher'),
(19, 'Sabba Sabba', 'sabba@gmail.com', 'pass', 'teacher'),
(20, 'Guenadiz Safia', 'guenadiz@gmail.com', 'pass', 'teacher'),
(21, 'yahiaten youcef', 'yahiaten@gmail.com', 'pass', 'teacher');

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
-- Indexes for table `user`
--
ALTER TABLE `user`
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
-- AUTO_INCREMENT for table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
