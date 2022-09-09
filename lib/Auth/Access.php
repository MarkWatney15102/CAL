<?php

namespace lib\Auth;

enum Access
{
    CASE ACCESS;
    CASE NO_ACCESS;
    CASE LOGIN_REQUIRED;

    public function redirect(): string
    {
        return match ($this) {
            self::ACCESS => '',
            self::NO_ACCESS => '/no-access',
            self::LOGIN_REQUIRED => '/login'
        };
    }
}