<?php

declare(strict_types=1);

namespace lib\Singleton;

abstract class Singleton
{
    protected static $instance = [];

    public static function getInstance(string $className = '')
    {
        if ($className === '') {
            $class = get_called_class();
        } else {
            $class = $className;
        }
        if (!isset(self::$instance[$class]) || !self::$instance[$class] instanceof $class) {
            self::$instance[$class] = new static();
        }
        return static::$instance[$class];
    }

    private function __construct()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }
}
