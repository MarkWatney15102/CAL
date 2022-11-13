<?php

declare(strict_types=1);

namespace src\Form;

use Exception;
use lib\Element\Element;
use lib\Form\AbstractFormData;

class RegisterFormData extends AbstractFormData
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
                'id' => 'firstname',
                'type' => Element::TEXT,
                'label' => 'Vorname'
            ]
        )->addElement(
            [
                'id' => 'lastname',
                'type' => Element::TEXT,
                'label' => 'Nachname'
            ]
        )->addElement(
            [
                'id' => 'email',
                'type' => Element::EMAIL,
                'label' => 'E-Mail'
            ]
        )->addElement(
            [
                'id' => 'password',
                'type' => Element::PASSWORD,
                'label' => 'Passwort'
            ]
        )->addElement(
            [
                'id' => 'register',
                'type' => Element::SUBMIT,
                'label' => 'Registrieren'
            ]
        );
    }
}