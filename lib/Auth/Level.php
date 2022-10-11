<?php

namespace lib\Auth;

enum Level
{
    case NO_LEVEL;
    case WORKER;
    case MANAGEMENT;
    case ADMIN;

    public function getLevel(): int
    {
        return match ($this) {
            self::NO_LEVEL => 5,
            self::WORKER => 10,
            self::MANAGEMENT => 50,
            self::ADMIN => 100
        };
    }
}