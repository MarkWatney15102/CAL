<?php

namespace src\Controller\Admin\User;

use lib\Controller\AbstractController;
use src\Helper\Redirect;
use src\Model\User\Mapper\UserMapper;
use src\Model\User\User;

class UserDeleteController extends AbstractController
{
    public function deleteAction(): void
    {
        $userId = (int)$this->urlParams[0];

        $mapper = UserMapper::getInstance();

        $user = $mapper->read($userId);

        if ($user instanceof User) {
            $user->setStatus('0');
            UserMapper::getInstance()->update($user);
            Redirect::to('/admin/dashboard');
        }
    }
}