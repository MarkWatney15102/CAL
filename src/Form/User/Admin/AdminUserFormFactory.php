<?php

namespace src\Form\User\Admin;

use src\Model\User\Mapper\UserMapper;
use src\Model\User\User;

class AdminUserFormFactory
{
    public static function makeWithoutModel(): AdminUserForm
    {
        $formData = new AdminUserFormData();

        $user = new User();
        $user->setRole(0);
        $user->setLevel(0);
        $formData->addModel($user, 'user');

        $formData->initStructure();

        return new AdminUserForm('adminUserForm', $formData);
    }

    public static function make(int $userId): AdminUserForm
    {
        $user = UserMapper::getInstance()?->read($userId);

        $formData = new AdminUserFormData();

        if ($user instanceof User) {
            $formData->addModel($user, 'user');
        }

        $formData->initStructure();

        return new AdminUserForm('adminUserForm', $formData);
    }
}