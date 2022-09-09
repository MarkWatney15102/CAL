<?php
declare(strict_types=1);

namespace lib\Template;

use lib\ValueObject\ValueObject;

class Template extends ValueObject
{
    private string $path;

    public function __construct(private bool $withBasicBody = true)
    {
    }

    public function setContent(string $path): void
    {
        $this->path = $path;
    }

    public function render(array $params = []): void
    {
        if ($this->withBasicBody) {
            $this->initParams($params);
            $this->renderWithBasicBody();
        } else {
            $this->initParams($params);
            $this->renderWithoutBasicBody();
        }
    }

    private function renderWithBasicBody(): void
    {
        require $_SERVER['DOCUMENT_ROOT'] . '/views/layout/body/basic-start.php';
        require $this->path;
        require $_SERVER['DOCUMENT_ROOT'] . '/views/layout/body/basic-end.php';
    }

    private function renderWithoutBasicBody(): void
    {
        require $_SERVER['DOCUMENT_ROOT'] . '/views/layout/no-body/basic-start.php';
        require $this->path;
        require $_SERVER['DOCUMENT_ROOT'] . '/views/layout/no-body/basic-end.php';
    }

    private function initParams(array $params): void
    {
        foreach ($params as $key => $param) {
            $this->$key = $param;
        }
    }
}