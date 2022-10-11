<?php

declare(strict_types=1);

namespace lib\Database;

use Dotenv\Dotenv;
use Medoo\Medoo;

class Database
{
    public Medoo $medoo;

    public function __construct()
    {
        $this->medoo = self::getDatabaseConnection();
    }

    public static function getDatabaseConnection(): Medoo
    {
        $dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
        $dotenv->load();

        return new Medoo(
            [
                'type' => 'mysql',
                'host' => $_ENV['DB_HOST'],
                'database' => $_ENV['DB_DB'],
                'username' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
                'port' => $_ENV['DB_PORT']
            ]
        );
    }
}
