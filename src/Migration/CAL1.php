<?php

namespace src\Migration;

use lib\Migration\AbstractMigrationStep;

class CAL1 extends AbstractMigrationStep
{
    public const ORDER = 1000;

    public function run(): void
    {
        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS `access_control_group` (
                `ID` INT(11) NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
                PRIMARY KEY (`ID`) USING BTREE,
                UNIQUE INDEX `name` (`name`) USING BTREE
            )
            COLLATE='utf8mb4_general_ci'
            ENGINE=InnoDB
            ;
        SQL;

        $this->database->medoo->query($sql);

        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS `access_control_role` (
                `ID` INT(11) NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
                PRIMARY KEY (`ID`) USING BTREE,
                UNIQUE INDEX `name` (`name`) USING BTREE
            )
            COLLATE='utf8mb4_general_ci'
            ENGINE=InnoDB
            ;
        SQL;

        $this->database->medoo->query($sql);

        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS `access_control_permission` (
                `ID` INT(11) NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
                PRIMARY KEY (`ID`) USING BTREE,
                UNIQUE INDEX `name` (`name`) USING BTREE
            )
            COLLATE='utf8mb4_general_ci'
            ENGINE=InnoDB
            ;
        SQL;

        $this->database->medoo->query($sql);

        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS `access_control_permission_to_access_control_group` (
                `ID` INT(11) NOT NULL AUTO_INCREMENT,
                `permissionId` INT(11) NOT NULL,
                `groupId` INT(11) NOT NULL,
                PRIMARY KEY (`ID`) USING BTREE,
                UNIQUE INDEX `permissionId_groupId` (`permissionId`, `groupId`) USING BTREE
            )
            COLLATE='utf8mb4_general_ci'
            ENGINE=InnoDB
            ;
        SQL;
        $this->database->medoo->query($sql);

        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS `access_control_group_to_access_control_role` (
                `ID` INT(11) NOT NULL AUTO_INCREMENT,
                `roleId` INT(11) NOT NULL,
                `groupId` INT(11) NOT NULL,
                PRIMARY KEY (`ID`) USING BTREE,
                UNIQUE INDEX `roleId_groupId` (`roleId`, `groupId`) USING BTREE
            )
            COLLATE='utf8mb4_general_ci'
            ENGINE=InnoDB
            ;
        SQL;
        $this->database->medoo->query($sql);


        $sql = <<<SQL
            ALTER TABLE `user` ADD COLUMN `role` int NOT NULL
        SQL;
        $this->database->medoo->query($sql);
    }
}