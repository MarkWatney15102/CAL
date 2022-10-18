<?php

namespace src\Migration;

use lib\Migration\AbstractMigrationStep;

class CAL13 extends AbstractMigrationStep
{
    public const ORDER = 13000;

    public function run(): void
    {
        $sql = <<<SQL
        CREATE TABLE `storage_place` (
            `ID` INT(11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
            PRIMARY KEY (`ID`) USING BTREE,
            UNIQUE INDEX `name` (`name`) USING BTREE
        )
        COLLATE='utf8mb4_general_ci'
        ENGINE=InnoDB
        ;
        SQL;

        $this->database->medoo->query($sql);

        $sql = <<<SQL
        CREATE TABLE `storage_item` (
            `ean` BIGINT(20) NOT NULL AUTO_INCREMENT COLLATE 'utf8mb4_general_ci',
            `name` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
            `description` TEXT NOT NULL COLLATE 'utf8mb4_general_ci',
            PRIMARY KEY (`ean`) USING BTREE
        )
        COLLATE='utf8mb4_general_ci'
        ENGINE=InnoDB
        AUTO_INCREMENT=1000000000001
        ;
        SQL;

        $this->database->medoo->query($sql);

        $sql = <<<SQL
        CREATE TABLE `storage_item_to_place` (
            `ID` INT(11) NOT NULL AUTO_INCREMENT,
            `ean` BIGINT(20) NOT NULL,
            `placeId` INT(11) NOT NULL,
            `amount` INT(11) NOT NULL,
            `row` INT(11) NOT NULL,
            `position` INT(11) NOT NULL,
            PRIMARY KEY (`ID`) USING BTREE
        )
        COLLATE='utf8mb4_general_ci'
        ENGINE=InnoDB
        ;
        SQL;

        $this->database->medoo->query($sql);
    }
}