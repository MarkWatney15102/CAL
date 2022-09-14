<?php

namespace src\Controller\Migration;

use lib\Controller\AbstractController;
use lib\Migration\MigrationHelper;
use lib\Migration\Migrator;

class MigrationController extends AbstractController
{
    public function runMigrationAction(): void
    {
        $migrator = new Migrator();

        $migrationSteps = $migrator->runMigrationSteps($this->database);

        $this->renderJson($migrationSteps);
    }
}