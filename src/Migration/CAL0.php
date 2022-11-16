<?php

namespace src\Migration;

use lib\Migration\AbstractMigrationStep;

class CAL0 extends AbstractMigrationStep
{
    public const ORDER = 100;

    public function run(): void
    {
        $sql = <<<SQL
        CREATE TABLE `resource` (
            `ID` INT(11) NOT NULL AUTO_INCREMENT,
            `taskId` INT(11) NOT NULL,
            `name` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
            `amount` INT(11) NOT NULL DEFAULT '0',
            PRIMARY KEY (`ID`) USING BTREE
        )
        COLLATE='utf8mb4_general_ci'
        ENGINE=InnoDB
        ;
        SQL;

        $this->database->medoo->query($sql);
    }
}