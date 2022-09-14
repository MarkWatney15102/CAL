<?php

namespace src\Form\AccessControl\Role;

use lib\Element\Element;
use lib\Form\AbstractFormData;
use src\Model\AccessControlRole\AccessControlRole;

class AccessControlRoleFormData extends AbstractFormData
{
    public function initStructure(): void
    {
        /** @var AccessControlRole $role */
        $role = $this->getModel('role');

        $this->addElement(
            [
                'id' => 'roleName',
                'type' => Element::TEXT,
                'label' => "Name der Rolle",
                'read' => function () use ($role) {
                    if ($role instanceof AccessControlRole && !empty($role->getName())) {
                        return $role->getName();
                    }

                    return "";
                },
                'write' => function ($value) use ($role) {
                    if ($role instanceof AccessControlRole) {
                        $role->setName($value);
                    }
                }
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