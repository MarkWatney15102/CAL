<?php

declare(strict_types=1);

namespace src\Form\Login;

use Exception;
use lib\Element\Element;
use lib\Form\AbstractFormData;

class LoginFormData extends AbstractFormData
{
    /**
     * @throws Exception
     */
    public function initStructure(): void
    {
        $this->addElement(
            [
                'id' => 'username',
                'type' => Element::TEXT,
                'label' => 'Benutzername'
            ]
        )->addElement(
            [
                'id' => 'password',
                'type' => Element::PASSWORD,
                'label' => 'Passwort'
            ]
        )->addElement(
            [
                'id' => 'login',
                'type' => Element::SUBMIT,
                'label' => 'Login'
            ]
        );
    }
}
