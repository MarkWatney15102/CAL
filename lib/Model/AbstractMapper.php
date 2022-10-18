<?php

declare(strict_types=1);

namespace lib\Model;

use lib\Database\Database;
use lib\Singleton\Singleton;
use ReflectionClass;
use src\Model\Order\Mapper\OrderMapper;

abstract class AbstractMapper extends Singleton
{
    public function read(int $id): AbstractEntity|null
    {
        $className = new ReflectionClass(get_called_class());
        $model = str_replace('Mapper', '', $className->getShortName());
        $modelClassName = str_replace([$model . 'Mapper', 'Mapper\\'], '', $className->getName());

        $loader = new LazyLoader();
        $data = $loader->load($model, $id);

        $modelClassName = $modelClassName . $model;

        $modelObject = new $modelClassName();

        if (!empty($data)) {
            foreach ($data[0] as $key => $fields) {
                if (is_string($key)) {
                    $functionName = "set" . ucfirst($key);
                    $modelObject->$functionName($fields);
                }
            }
        }

        return $modelObject ?? null;
    }

    public function update(AbstractEntity $model): int
    {
        $db = Database::getDatabaseConnection();

        $className = new ReflectionClass(get_called_class());
        $modelName = str_replace('Mapper', '', $className->getShortName());

        $loader = new LazyLoader();
        $json = $loader->loadJson($modelName);

        $tableName = $json->table;
        $primaryKeyField = $json->primaryKey;
        $primaryId = $model->getID();

        $fields = [];
        foreach ($json->fields as $field) {
            $functionName = "get" . ucfirst($field->name);
            $value = $model->$functionName();

            if (isset($value)) {
                $fields[] = $field->name . " = '{$value}'";
            }
        }
        $fieldsString = implode(", ", $fields);

        if (!empty($fieldsString)) {
            $sql = <<<SQL
                UPDATE {$tableName} SET {$fieldsString} WHERE {$primaryKeyField} = {$primaryId}
            SQL;

            $db->query($sql);
        }

        return $primaryId;
    }

    public function create(AbstractEntity $model): int
    {
        $id = 0;

        $className = new ReflectionClass(get_called_class());
        $modelName = str_replace('Mapper', '', $className->getShortName());

        $loader = new LazyLoader();
        $json = $loader->loadJson($modelName);

        $reflectionClass = new ReflectionClass($model);

        $values = [];
        foreach ($reflectionClass->getProperties() as $prop) {
            $property = $reflectionClass->getProperty($prop->getName());
            if ($property->getName() !== 'ID') {
                $values[$property->getName()] =  $property->getValue($model); //"'" . $property->getValue($model) . "'";
            } else {
                $values[$json->primaryKey] = $property->getValue($model) ?? 'NULL';
            }
        }

        if (!empty($values)) {
    
            $db = Database::getDatabaseConnection();

            $db->insert($json->table, [$values]);
            $id = (int)$db->id();
        }

        return $id;
    }

    public function delete(AbstractEntity $entity): void
    {
        $id = $entity->getID();

        $className = new ReflectionClass(get_called_class());
        $modelName = str_replace('Mapper', '', $className->getShortName());

        $loader = new LazyLoader();
        $json = $loader->loadJson($modelName);

        $tableName = $json->table;
        $pk = $json->primaryKey;

        $sql = <<<SQL
            DELETE FROM `{$tableName}` WHERE `{$pk}` = '{$id}'
        SQL;

        $db = Database::getDatabaseConnection();

        $db->query($sql);
    }
}
