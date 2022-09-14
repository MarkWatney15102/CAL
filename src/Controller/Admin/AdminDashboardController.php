<?php

namespace src\Controller\Admin;

use lib\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    public function adminDashboardAction(): void
    {
        $this->render(
            'admin/dashboard',
            [
                'renderWithBasicBody' => true
            ]
        );
    }
}