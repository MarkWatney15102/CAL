<?php

namespace src\Form\User\Profile;

use Exception;
use src\Model\User\Mapper\UserMapper;
use src\Model\User\User;

class ProfileFormFactory
{
    /**
     * @throws Exception
     */
    public static function make(User $user): ProfileForm
    {
        $formData = new ProfileFormData();

        $formData->addModel($user, 'user');

        $formData->initStructure();

        return new ProfileForm('profileForm', $formData);
    }
}