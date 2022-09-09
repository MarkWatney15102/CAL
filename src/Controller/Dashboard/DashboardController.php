<?php

namespace src\Controller\Dashboard;

use lib\Controller\AbstractController;

class DashboardController extends AbstractController
{
    public function dashboardAction(): void
    {
        $this->render(
            'layout/dashboard',
            [
                'renderWithBasicBody' => true
            ]
        );
    }
}