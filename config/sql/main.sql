CREATE TABLE IF NOT EXISTS `cat_order_status` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `cat_order_status` (`ID`, `text`) VALUES
	(1, 'Aufgenommen'),
	(2, 'Bestellt'),
	(3, 'In Zustellung'),
	(4, 'Im Lager'),
	(5, 'Abgeschlossen');

CREATE TABLE IF NOT EXISTS `cat_project_status` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `cat_project_status` (`ID`, `text`) VALUES
	(1, 'Aktive'),
	(2, 'Inaktive'),
	(3, 'In bearbeitung'),
	(4, 'Abgeschlossen');
CREATE TABLE IF NOT EXISTS `order` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `supplier` varchar(255) NOT NULL,
  `trackingCode` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `taskId` int NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `order` (`ID`, `supplier`, `trackingCode`, `status`, `taskId`, `timestamp`) VALUES
	(1, 'DHL', '122', 1, 8, '2022-08-25 20:12:19');

CREATE TABLE IF NOT EXISTS `projects` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL,
  `creator_user_id` int NOT NULL DEFAULT '0',
  `current_worker_user_id` int NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `sollCount` int NOT NULL,
  `istCount` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `projects` (`ID`, `title`, `description`, `start`, `end`, `creator_user_id`, `current_worker_user_id`, `status`, `sollCount`, `istCount`, `timestamp`) VALUES
	(1, 'Test Projekt', 'Test', '2022-04-20 21:08:30', '2022-04-20 21:08:31', 1, 2, 1, 10, 5, '2022-04-20 21:08:34'),
	(13, 'Rollenwagen', 'Soll gebaut werden', NULL, '2022-12-09 00:00:00', 1, 2, 1, 3, 0, '2022-08-09 18:05:36');

CREATE TABLE IF NOT EXISTS `task` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `creator` int NOT NULL DEFAULT '0',
  `assignedUserId` int NOT NULL DEFAULT '0',
  `projectId` int NOT NULL DEFAULT '0',
  `childOf` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `orderNeeded` int NOT NULL DEFAULT '0',
  `orderId` int NOT NULL DEFAULT '0',
  `orderInformation` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `task` (`ID`, `name`, `creator`, `assignedUserId`, `projectId`, `childOf`, `status`, `orderNeeded`, `orderId`, `orderInformation`, `timestamp`) VALUES
	(4, 'Bodenplatte', 1, 2, 13, -1, 1, 2, 0, '', '2022-08-09 23:47:30'),
	(5, 'Bodenplatte bestellen', 1, 3, 13, 4, 1, 1, -1, '', '2022-08-09 23:49:28'),
	(6, 'Bodenplatte zuschneiden', 1, 3, 13, 4, 1, 0, 0, '', '2022-08-09 23:50:16'),
	(7, 'Sichtprüfung', 1, 3, 13, 6, 1, -1, 0, '', '2022-08-10 22:07:10'),
	(8, 'sfsf', -1, -1, 13, -1, -1, 1, 0, '', '0000-00-00 00:00:00');

-- Dumping structure for table shop.user
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `level` int NOT NULL DEFAULT '0',
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `user` (`ID`, `mail`, `username`, `level`, `firstname`, `lastname`, `password`, `createTime`) VALUES
	(1, 'eikewientjes882@gmail.com', 'EikeWientjes', 100, 'Eike', 'Wientjes', '$2a$10$C2wK774R1vIBFfH3qqxqZeUSqA8IilBlND7WF8YnEyUBgU1TSeaiq', '2022-04-10 20:33:03'),
	(2, 'eikewientjes882@gmail.com', 'awd', 0, 'Reiner', 'Wientjes', 'awd', '2022-04-10 20:33:03'),
	(3, 'eikewientjes882@gmail.com', 'awd', 0, 'Karsten', 'Wientjes', 'awd', '2022-04-10 20:33:03');

CREATE TABLE `resource` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,
    `taskId` INT(11) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `amount` INT(11) NOT NULL,
PRIMARY KEY (`ID`) USING BTREE
)ENGINE=InnoDB;
