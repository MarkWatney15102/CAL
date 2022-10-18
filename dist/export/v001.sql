-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Exportiere Struktur von Tabelle shop.access_control_group
CREATE TABLE IF NOT EXISTS `access_control_group` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.access_control_group: ~1 rows (ungefähr)
INSERT INTO `access_control_group` (`ID`, `name`) VALUES
	(1, 'project'),
	(2, 'task');

-- Exportiere Struktur von Tabelle shop.access_control_group_to_access_control_role
CREATE TABLE IF NOT EXISTS `access_control_group_to_access_control_role` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `roleId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE KEY `roleId_groupId` (`roleId`,`groupId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.access_control_group_to_access_control_role: ~4 rows (ungefähr)
INSERT INTO `access_control_group_to_access_control_role` (`ID`, `roleId`, `groupId`) VALUES
	(14, 1, 1),
	(13, 1, 2),
	(10, 2, 1),
	(11, 2, 2);

-- Exportiere Struktur von Tabelle shop.access_control_permission
CREATE TABLE IF NOT EXISTS `access_control_permission` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.access_control_permission: ~1 rows (ungefähr)
INSERT INTO `access_control_permission` (`ID`, `name`) VALUES
	(1, 'project-list'),
	(2, 'task-list');

-- Exportiere Struktur von Tabelle shop.access_control_permission_to_access_control_group
CREATE TABLE IF NOT EXISTS `access_control_permission_to_access_control_group` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `permissionId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE KEY `permissionId_groupId` (`permissionId`,`groupId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.access_control_permission_to_access_control_group: ~0 rows (ungefähr)

-- Exportiere Struktur von Tabelle shop.access_control_role
CREATE TABLE IF NOT EXISTS `access_control_role` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.access_control_role: ~1 rows (ungefähr)
INSERT INTO `access_control_role` (`ID`, `name`) VALUES
	(1, 'Management'),
	(2, 'Worker');

-- Exportiere Struktur von Tabelle shop.cat_order_status
CREATE TABLE IF NOT EXISTS `cat_order_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.cat_order_status: ~0 rows (ungefähr)

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

-- Exportiere Struktur von Tabelle shop.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `migrationName` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.migration: ~3 rows (ungefähr)
INSERT INTO `migration` (`ID`, `migrationName`, `status`, `message`, `timestamp`) VALUES
	(11, 'CAL1', 'ERROR', 'SQLSTATE[42000]: Syntax error or access violation: 1072 Key column \'permissionId\' doesn\'t exist in table', '2022-09-14 18:50:22'),
	(12, 'CAL1', 'ERROR', 'SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'EXITS `access_control_group` (\r\n        `ID` INT(11) NOT NULL AUTO_INCREMENT,...\' at line 1', '2022-09-14 18:51:08'),
	(13, 'CAL1', 'OK', '', '2022-09-14 18:51:29'),
	(14, 'CAL13', 'OK', '', '2022-09-14 18:51:29'),
	(15, 'CAL0', 'OK', '', '2022-09-14 18:51:29');

-- Exportiere Struktur von Tabelle shop.order
CREATE TABLE IF NOT EXISTS `order` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `supplier` varchar(255) NOT NULL,
  `trackingCode` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `taskId` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.order: ~0 rows (ungefähr)
INSERT INTO `order` (`ID`, `supplier`, `trackingCode`, `status`, `timestamp`, `taskId`) VALUES
	(1, 'DHL', 'pkepksg', -1, '2022-10-18 16:39:31', 10);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.projects: ~1 rows (ungefähr)
INSERT INTO `projects` (`ID`, `title`, `description`, `start`, `end`, `creator_user_id`, `current_worker_user_id`, `status`, `sollCount`, `istCount`, `timestamp`) VALUES
	(15, 'Tisch', 'Es soll ein Tisch gebaut werden', '2022-10-17 22:00:00', '2022-12-29 23:00:00', 1, 3, 1, 0, 0, '2022-10-18 16:30:28');

-- Exportiere Struktur von Tabelle shop.resource
CREATE TABLE IF NOT EXISTS `resource` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `taskId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.resource: ~0 rows (ungefähr)

-- Exportiere Struktur von Tabelle shop.storage_item
CREATE TABLE IF NOT EXISTS `storage_item` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `ean` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ean` (`ean`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.storage_item: ~2 rows (ungefähr)
INSERT INTO `storage_item` (`ID`, `name`, `description`, `ean`) VALUES
	(1, 'M5 Schrauben', '', '100000'),
	(2, 'M5 Muttern', '', '100001');

-- Exportiere Struktur von Tabelle shop.storage_item_to_place
CREATE TABLE IF NOT EXISTS `storage_item_to_place` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `itemId` int(11) NOT NULL,
  `placeId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.storage_item_to_place: ~2 rows (ungefähr)
INSERT INTO `storage_item_to_place` (`ID`, `itemId`, `placeId`, `amount`, `row`, `position`) VALUES
	(1, 1, 1, 5, 1, 1),
	(2, 2, 1, 5, 1, 2);

-- Exportiere Struktur von Tabelle shop.storage_place
CREATE TABLE IF NOT EXISTS `storage_place` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.storage_place: ~2 rows (ungefähr)
INSERT INTO `storage_place` (`ID`, `name`) VALUES
	(1, 'Lagerhalle #1'),
	(2, 'Lagerhalle #2');

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
  `description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.task: ~7 rows (ungefähr)
INSERT INTO `task` (`ID`, `name`, `creator`, `assignedUserId`, `projectId`, `childOf`, `status`, `orderNeeded`, `orderId`, `orderInformation`, `timestamp`, `description`) VALUES
	(4, 'Bodenplatte', 1, 2, 13, -1, 1, 2, 0, '', '2022-08-09 19:47:30', ''),
	(5, 'Bodenplatte bestellen', 1, 3, 13, 4, 1, 1, -1, '', '2022-08-09 19:49:28', ''),
	(6, 'Bodenplatte zuschneiden', 1, 3, 13, 4, 1, 0, 0, '', '2022-08-09 19:50:16', ''),
	(7, 'Sichtprüfung', 1, 3, 13, 6, 1, -1, 0, '', '2022-08-10 18:07:10', ''),
	(8, 'sf', 1, 1, 14, -1, 1, -1, 0, '', '0000-00-00 00:00:00', ''),
	(9, 'Tischplatte', -1, -1, 15, -1, -1, -1, 0, '', '0000-00-00 00:00:00', 'Es muss eine Tischplatte gebaut werden'),
	(10, 'Holz bestellen', 1, 3, 15, 9, -1, 1, 1, '', '0000-00-00 00:00:00', '');

-- Exportiere Struktur von Tabelle shop.user
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `createTime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle shop.user: ~4 rows (ungefähr)
INSERT INTO `user` (`ID`, `mail`, `username`, `level`, `firstname`, `lastname`, `password`, `role`, `createTime`) VALUES
	(1, 'eikewientjes882@gmail.com', 'EikeWientjes', 100, 'Eike', 'Wientjes', '$2a$10$C2wK774R1vIBFfH3qqxqZeUSqA8IilBlND7WF8YnEyUBgU1TSeaiq', 1, '2022-04-10 16:33:03'),
	(2, 'eikewientjes882@gmail.com', 'awd', 5, 'Reiner', 'Wientjes', 'awd', 1, '2022-04-10 16:33:03'),
	(3, 'eikewientjes882@gmail.com', 'awd', 0, 'Karsten', 'Wientjes', 'awd', 0, '2022-04-10 16:33:03'),
	(4, 'tes@tes.de', 'test123', -1, 'awd', 'dawd', '', -1, '0000-00-00 00:00:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
