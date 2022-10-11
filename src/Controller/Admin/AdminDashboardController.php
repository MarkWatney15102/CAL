<?php

namespace src\Controller\Admin;

use lib\Controller\AbstractController;
use src\Model\User\Mapper\UserContainer;

class AdminDashboardController extends AbstractController
{
    public function adminDashboardAction(): void
    {
        $userList = UserContainer::getInstance()?->findBy([]);

        $this->render(
            'admin/dashboard',
            [
                'renderWithBasicBody' => true,
                'userList' => $userList
            ]
        );
    }
}