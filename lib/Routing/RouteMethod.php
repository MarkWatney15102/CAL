<?php
declare(strict_types=1);

namespace lib\Routing;

enum RouteMethod
{
    case POST;
    case GET;

    public function method (): string
    {
        return match($this) {
            self::GET => 'GET',
            self::POST => 'POST'
        };
    }
}