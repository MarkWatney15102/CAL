<?php

declare(strict_types=1);

namespace lib\Database;

use Medoo\Medoo;

class Database
{
    public Medoo $medoo;

    public function __construct()
    {
        $this->medoo = self::getDatabaseConnection();
    }

    public static function getDatabaseConnection(string $configPath = ""): Medoo
    {
        if (!empty($configPath)) {
            require $configPath;
        } else {
            require $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";
        }

        return new Medoo(
            [
                'type' => 'mysql',
                'host' => $host,
                'database' => $database,
                'username' => $username,
                'password' => $password,
                'port' => $port
            ]
        );
    }
}
