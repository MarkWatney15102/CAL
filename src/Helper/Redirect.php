<?php

namespace src\Helper;

class Redirect
{
    public static function to(string $uri): void
    {
        header('Location: ' . $uri);
    }
}