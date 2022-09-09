<?php
declare(strict_types=1);

namespace lib\Controller;

use lib\Database\Database;

interface ControllerInterface
{
    public function render(string $view, array $args = []): void;
    public function renderJson(string|array $jsonData): void;
    public function setDatabase(Database $database): void;
}