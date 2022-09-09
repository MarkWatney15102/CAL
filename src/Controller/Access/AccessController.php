<?php

namespace src\Controller\Access;

use lib\Controller\AbstractController;

class AccessController extends AbstractController
{
    public function noAccess(): void
    {
        $this->render(
            'layout/errors/no-access',
            [
                'renderWithBasicBody' => true
            ]
        );
    }
}