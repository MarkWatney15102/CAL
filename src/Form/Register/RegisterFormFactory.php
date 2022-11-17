<?php

namespace src\Form\Register;

class RegisterFormFactory
{
    public static function make(): RegisterForm
    {
        $formData = new RegisterFormData();

        $formData->initStructure();

        return new RegisterForm('registerForm', $formData);
    }
}