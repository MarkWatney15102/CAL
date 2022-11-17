<?php

declare(strict_types=1);

namespace src\Form\Login;

class LoginFormFactory
{
    public static function make(): LoginForm
    {
        $formData = new LoginFormData();

        $formData->initStructure();

        return new LoginForm('loginForm', $formData);
    }
}
