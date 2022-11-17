<?php

namespace src\Migration;

use lib\Migration\AbstractMigrationStep;

class CAL26 extends AbstractMigrationStep
{
    public const ORDER = 26000;

    public function run(): void
    {
        $sql = <<<SQL
            ALTER TABLE user ADD COLUMN `status` int(11) NOT NULL DEFAULT 0
        SQL;

        $this->database->medoo->query($sql);
    }
}