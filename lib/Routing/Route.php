<?php
declare(strict_types=1);

namespace lib\Routing;

class Route
{
    public function __construct(
        private readonly string      $uri,
        private readonly string      $controller,
        private readonly string      $action,
        private readonly RouteMethod $method,
        private readonly int         $level,
        private readonly bool        $requiresLogin = false
    ) {}

    public function getUri(): string 
    {
        return $this->uri;
    }

    public function getController(): string 
    {
        return $this->controller;
    }

    public function getAction(): string 
    {
        return $this->action;
    }

    public function getMethod(): RouteMethod 
    {
        return $this->method;
    }

    public function isRequiresLogin(): bool
    {
        return $this->requiresLogin;
    }

    public function getLevel(): int
    {
        return $this->level;
    }
}