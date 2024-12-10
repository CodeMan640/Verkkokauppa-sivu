-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 11.11.2024 klo 08:07
-- Palvelimen versio: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jesse_projekti`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `korituotteet`
--

DROP TABLE IF EXISTS `korituotteet`;
CREATE TABLE IF NOT EXISTS `korituotteet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ostoskori_id` int NOT NULL,
  `tuote_id` int NOT NULL,
  `maara` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ostoskori_id` (`ostoskori_id`,`tuote_id`),
  KEY `tuote_id` (`tuote_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `korituotteet`
--

INSERT INTO `korituotteet` (`id`, `ostoskori_id`, `tuote_id`, `maara`) VALUES
(5, 1, 2, 1),
(4, 1, 1, 1),
(8, 2, 1, 1),
(9, 2, 2, 1),
(20, 3, 2, 2),
(19, 3, 1, 2),
(21, 3, 3, 2),
(22, 3, 4, 4),
(30, 4, 4, 1),
(29, 4, 1, 1),
(27, 4, 2, 1),
(28, 4, 3, 1),
(35, 5, 2, 16),
(37, 5, 4, 28),
(38, 5, 7, 18),
(36, 5, 3, 26),
(39, 6, 3, 3),
(40, 6, 2, 3),
(41, 6, 4, 4),
(42, 6, 7, 1);

-- --------------------------------------------------------

--
-- Rakenne taululle `ostoskori`
--

DROP TABLE IF EXISTS `ostoskori`;
CREATE TABLE IF NOT EXISTS `ostoskori` (
  `ostoskori_id` int NOT NULL AUTO_INCREMENT,
  `SessionID` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ostoskori_id`),
  UNIQUE KEY `SessionID` (`SessionID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `ostoskori`
--

INSERT INTO `ostoskori` (`ostoskori_id`, `SessionID`, `created_at`) VALUES
(1, 'bbdd3t74d5a7i1cas3v9shr78s', '2024-10-22 09:10:21'),
(2, 'dmkdeuemv91rh3pjd86igbka9p', '2024-10-23 05:46:47'),
(3, 'v7vjqhrmnprs1frufm11knf8pp', '2024-10-24 05:41:42'),
(4, 'onjg6sqfoo9g33s646a1krgqks', '2024-11-01 06:38:18'),
(5, 'ei882v8onf6u1ueqk31jfk6f3f', '2024-11-01 10:24:54'),
(6, 'j6vh3smvalksniu48hkhh1adek', '2024-11-07 07:19:54'),
(7, '89ct6oq84bm8cge2ao8sjboo83', '2024-11-07 07:52:23'),
(8, '', '2024-11-07 08:24:57');

-- --------------------------------------------------------

--
-- Rakenne taululle `tuotteet`
--

DROP TABLE IF EXISTS `tuotteet`;
CREATE TABLE IF NOT EXISTS `tuotteet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nimi` varchar(255) NOT NULL,
  `Kuvaus` text,
  `Hinta` decimal(10,2) NOT NULL,
  `kuva` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `tuotteet`
--

INSERT INTO `tuotteet` (`id`, `Nimi`, `Kuvaus`, `Hinta`, `kuva`) VALUES
(2, 'Kotimainen banaani', 'Aito suomalainen banaani', '1.99', 'banaani.jpg'),
(3, 'Mandariini', 'Aito mandariini', '0.70', 'mandariini.jpg'),
(4, 'Päärynä', 'Aito päärynä', '1.50', 'päärynä.jpg'),
(7, 'Omena', 'Hyvänmakuinen omena', '9.99', 'omena.jpg');

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'jesse@gmail.com', '$2y$10$EDFmCjWAu21X/QzW6LPjc.LbhMhzpLf5WydXIKrWwx2rgeCei3mUW', '2024-11-07 07:18:40'),
(2, 'jesse2@gmail.com', '$2y$10$5YBwS38yrrEqk94.WSsWQunNTUOfcP0qpNVAl7dZLExoG3LwRKuh6', '2024-11-07 10:24:43');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
