<?php

declare(strict_types=1);

namespace src\Model\User\Mapper;

use lib\Model\AbstractMapper;
use src\Helper\User\UserHelper;
use src\Model\User\User;

class UserMapper extends AbstractMapper
{
    public function getCurrentUser(): User
    {
        $userId = UserHelper::getUid();

        $user = $this->read($userId);

        if (!$user instanceof User) {
            throw new \Exception('Login Required');
        }

        return $user;
    }
}
