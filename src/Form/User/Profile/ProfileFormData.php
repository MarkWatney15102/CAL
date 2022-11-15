<?php

namespace src\Form\User\Profile;

use Exception;
use lib\Element\Element;
use lib\Form\AbstractFormData;

class ProfileFormData extends AbstractFormData
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
                'id' => 'email',
                'type' => Element::EMAIL,
                'label' => 'Email'
            ]
        )->addElement(
            [
                'id' => 'password',
                'type' => Element::PASSWORD,
                'label' => 'Passwort'
            ]
        )->addElement(
            [
                'id' => 'sure',
                'type' => Element::CHECKBOX,
                'label' => 'Soll das Password gespeichert werden?'
            ]
        )->addElement(
            [
                'id' => 'save',
                'type' => Element::SUBMIT,
                'label' => 'Speichern'
            ]
        );
    }
}