<?php

namespace src\Migration;

use lib\Migration\AbstractMigrationStep;

class CAL21 extends AbstractMigrationStep
{
    public const ORDER = 21000;

    public function run(): void
    {
        $sql = <<<SQL
            CREATE TABLE `projectProcess` (
                `ID` INT(11) NOT NULL AUTO_INCREMENT,
                `projectId` INT(11) NOT NULL DEFAULT '0',
                `creatorUserId` INT(11) NOT NULL DEFAULT '0',
                `amountToBuild` INT(11) NOT NULL DEFAULT '0',
                `timestamp` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
                PRIMARY KEY (`ID`) USING BTREE
            )
            COLLATE='utf8mb4_general_ci'
            ENGINE=InnoDB
        SQL;

        $this->database->medoo->query($sql);

        $sql = <<<SQL
            CREATE TABLE `projectProcessTasks` (
                `ID` INT NOT NULL AUTO_INCREMENT,
                `projectProcessId` INT NOT NULL DEFAULT '0',
                `taskId` INT NOT NULL DEFAULT '0',
                `status` INT NOT NULL DEFAULT '0',
                PRIMARY KEY (`ID`),
                UNIQUE INDEX `projectProcessId_taskId` (`projectProcessId`, `taskId`)
            )
            COLLATE='utf8mb4_general_ci'
        SQL;

        $this->database->medoo->query($sql);
    }
}