<?php

namespace lib\Migration;

use DateTime;
use Exception;
use lib\Database\Database;
use src\Model\Migration\Mapper\MigrationContainer;
use src\Model\Migration\Mapper\MigrationMapper;
use src\Model\Migration\Migration;

class Migrator
{
    public function runMigrationSteps(Database $database): array
    {
        $migrationStepStatusList = [];
        $migrationStepQueue = [];

        $files = $this->getFiles($_SERVER['DOCUMENT_ROOT'] . "/src/Migration/");

        foreach ($files as $file) {
            $className = str_replace(".php", "", $file);
            if (!in_array($className, $this->getMigrationStepsFromDatabase())) {
                $class = "\\src\\Migration\\" . str_replace(".php", "", $className);

                $migration = new $class($database);

                if ($migration instanceof AbstractMigrationStep) {
                    $order = $migration::ORDER;
                    $migration->setName($className);
                    $migrationStepQueue[$order] = $migration;
                }
            }
        }

        ksort($migrationStepQueue);

        foreach ($migrationStepQueue as $migrationStep) {
            $migrationStepStatusList[] = $this->executeMigrationStep($migrationStep, $migrationStep->getName());
        }

        return $migrationStepStatusList;
    }

    private function getFiles(string $path): array
    {
        $files = scandir($path);

        unset($files[0]);
        unset($files[1]);

        return $files;
    }

    public function getMigrationStepsFromDatabase(): array
    {
        $migrationList = [];

        /** @var Migration[] $migrations */
        $migrations = MigrationContainer::getInstance()?->findBy([]);

        foreach ($migrations as $migration) {
            if ($migration->getStatus() === 'OK') {
                $migrationList[] = $migration->getMigrationName();
            }
        }

        return $migrationList;
    }

    public function setMigrationStepAsExecuted(string $name, string $status, string $message = ""): void
    {
        $dateTime = new DateTime();

        $migration = new Migration();
        $migration->setMigrationName($name);
        $migration->setStatus($status);
        $migration->setMessage($message);
        $migration->setTimestamp($dateTime->format('Y-m-d H:i:s'));

        MigrationMapper::getInstance()?->create($migration);
    }

    public function executeMigrationStep(AbstractMigrationStep $migration, mixed $className): array
    {
        try {
            $migration->run();
            $status = "OK";
            $message = "";
        } catch (Exception $exception) {
            $status = "ERROR";
            $message = $exception->getMessage();
        } finally {
            $this->setMigrationStepAsExecuted($className, $status, $message);
            $migrationSteps = ['name' => $className, 'status' => $status, 'message' => $message];
        }

        return $migrationSteps;
    }
}