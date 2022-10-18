<?php

declare(strict_types=1);

namespace lib\Model;

use lib\Database\Database;
use function Symfony\Component\String\s;

class LazyLoader
{
    public function load(string $modelName, int $id): array
    {
        $db = Database::getDatabaseConnection();

        $json = $this->loadJson($modelName);

        $sql = $this->buildSql($json, $id);

        $data = $db->query($sql)->fetchAll();

        return $data;
    }

    private function buildSql(object $json, int $id): string
    {
        $table = $json->table;
        $primaryKeyField = $json->primaryKey;

        $fields = [];
        $fields[] = "`$primaryKeyField` ID";
        foreach ($json->fields as $field) {
            $fields[] = "`{$field->name}`";
        }

        $selectFields = implode(", ", $fields);

        return <<<SQL
            SELECT $selectFields FROM `$table` WHERE `$primaryKeyField` = $id
        SQL;
    }

    public function loadJson(string $modelName): object
    {
        $fileName = $_SERVER['DOCUMENT_ROOT'] . "/src/Model/{$modelName}/Mapper/schema.json";
        $jsonFile = file_get_contents($fileName);
        
        return json_decode($jsonFile);
    }
}
