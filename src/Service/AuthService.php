<?php

namespace src\Service\Auth;

use lib\Auth\Access;
use lib\Auth\Level;
use src\Helper\Redirect;
use src\Model\User\Mapper\UserMapper;
use src\Model\User\User;

class AuthService
{
    public function isLoggedInOrNoLoginRequired(bool $isLoginRequired, int $requiredLevel = 0): Access
    {
        $access = Access::NO_ACCESS;

        if ($isLoginRequired) {
            $user = $this->getUserIfLoggedIn();
            if ($user instanceof User) {
                if ($user->getLevel() >= $requiredLevel) {
                    $access = Access::ACCESS;
                }
            } else {
                $access = Access::LOGIN_REQUIRED;
            }
        } else {
            $access = Access::ACCESS;
        }

        return $access;
    }

    private function getUserIfLoggedIn(): User|null
    {
        $return = null;

        if (isset($_COOKIE['UID'])) {
            $user = UserMapper::getInstance()?->read((int)$_COOKIE['UID']);

            if ($user instanceof User) {
                $return = $user;
            }
        }

        return $return;
    }
}