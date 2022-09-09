<?php

namespace lib\View;

use Skunkbad\ViewLoader\View as ViewLoader;

class View
{
    public static function load(string $path, array $params = []): string
    {
        $viewLoader = new ViewLoader();
        $viewLoader->addPath($_SERVER['DOCUMENT_ROOT'] . '/views/');

        return $viewLoader->load($path, $params, true);
    }
}