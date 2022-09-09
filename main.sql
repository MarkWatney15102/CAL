-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Exportiere Datenbank Struktur für shop
CREATE DATABASE IF NOT EXISTS `shop` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `shop`;

-- Exportiere Struktur von Tabelle shop.cat_project_status
CREATE TABLE IF NOT EXISTS `cat_project_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.cat_project_status: ~4 rows (ungefähr)
INSERT INTO `cat_project_status` (`ID`, `text`) VALUES
	(1, 'Aktive'),
	(2, 'Inaktive'),
	(3, 'In bearbeitung'),
	(4, 'Abgeschlossen');

-- Exportiere Struktur von Tabelle shop.order
CREATE TABLE IF NOT EXISTS `order` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `supplier` varchar(255) NOT NULL,
  `trackingCode` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.order: ~0 rows (ungefähr)

-- Exportiere Struktur von Tabelle shop.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL,
  `creator_user_id` int(11) NOT NULL DEFAULT 0,
  `current_worker_user_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL,
  `sollCount` int(11) NOT NULL,
  `istCount` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.projects: ~0 rows (ungefähr)
INSERT INTO `projects` (`ID`, `title`, `description`, `start`, `end`, `creator_user_id`, `current_worker_user_id`, `status`, `sollCount`, `istCount`, `timestamp`) VALUES
	(1, 'Test Projekt', 'Test', '2022-04-20 19:08:30', '2022-04-20 19:08:31', 1, 2, 1, 10, 5, '2022-04-20 19:08:34'),
	(13, 'Rollenwagen', 'Soll gebaut werden', NULL, '2022-12-08 23:00:00', 1, 2, 1, 3, 0, '2022-08-09 16:05:36');

-- Exportiere Struktur von Tabelle shop.task
CREATE TABLE IF NOT EXISTS `task` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `creator` int(11) NOT NULL DEFAULT 0,
  `assignedUserId` int(11) NOT NULL DEFAULT 0,
  `projectId` int(11) NOT NULL DEFAULT 0,
  `childOf` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `orderNeeded` int(11) NOT NULL DEFAULT 0,
  `orderId` int(11) NOT NULL DEFAULT 0,
  `orderInformation` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.task: ~4 rows (ungefähr)
INSERT INTO `task` (`ID`, `name`, `creator`, `assignedUserId`, `projectId`, `childOf`, `status`, `orderNeeded`, `orderId`, `orderInformation`, `timestamp`) VALUES
	(4, 'Bodenplatte', 1, 2, 13, -1, 1, 2, 0, '', '2022-08-09 21:47:30'),
	(5, 'Bodenplatte bestellen', 1, 3, 13, 4, 1, 1, -1, '', '2022-08-09 21:49:28'),
	(6, 'Bodenplatte zuschneiden', 1, 3, 13, 4, 1, 0, 0, '', '2022-08-09 21:50:16'),
	(7, 'Sichtprüfung', 1, 3, 13, 6, 1, -1, 0, '', '2022-08-10 20:07:10');

-- Exportiere Struktur von Tabelle shop.user
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.user: ~3 rows (ungefähr)
INSERT INTO `user` (`ID`, `mail`, `username`, `level`, `firstname`, `lastname`, `password`, `createTime`) VALUES
	(1, 'eikewientjes882@gmail.com', 'EikeWientjes', 100, 'Eike', 'Wientjes', '$2a$10$C2wK774R1vIBFfH3qqxqZeUSqA8IilBlND7WF8YnEyUBgU1TSeaiq', '2022-04-10 18:33:03'),
	(2, 'eikewientjes882@gmail.com', 'awd', 0, 'Reiner', 'Wientjes', 'awd', '2022-04-10 18:33:03'),
	(3, 'eikewientjes882@gmail.com', 'awd', 0, 'Karsten', 'Wientjes', 'awd', '2022-04-10 18:33:03');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
