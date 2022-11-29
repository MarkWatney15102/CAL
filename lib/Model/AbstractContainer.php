<?php

declare(strict_types=1);

namespace lib\Model;

use lib\Database\Database;
use lib\Singleton\Singleton;
use ReflectionClass;

abstract class AbstractContainer extends Singleton
{
    public function findBy(array $search = []): array
    {
        $db = Database::getDatabaseConnection();

        $className = new ReflectionClass(get_called_class());
        $modelName = str_replace('Container', '', $className->getShortName());
        $mapperName = str_replace('Container', 'Mapper', $className->getName());

        $lazyLoader = new LazyLoader();
        $json = $lazyLoader->loadJson($modelName);

        $primaryKey = $json->primaryKey;

        try {
            $data = $db->select($json->table, [$primaryKey], $search);
        } catch (\PDOException $exception) {
            throw new \Exception('Error in Mapper class ' . $mapperName . " - {$exception->getMessage()}");
        }

        $entity = [];
        foreach ($data as $element) {
            $entity[] = $mapperName::getInstance()?->read($element[$primaryKey]);
        }

        return $entity;
    }

    public function findOne(array $search = []): AbstractEntity|null
    {
        $entities = $this->findBy($search);

        if (!empty($entities)) {
            return $entities[0];
        }

        return null;
    }
}
