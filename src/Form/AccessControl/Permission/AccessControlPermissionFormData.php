<?php

namespace src\Form\AccessControl\Permission;

use lib\Element\Element;
use lib\Form\AbstractFormData;
use src\Model\AccessControlPermission\AccessControlPermission;

class AccessControlPermissionFormData extends AbstractFormData
{
    public function initStructure(): void
    {
        /** @var AccessControlPermission $permission */
        $permission = $this->getModel('permission');

        $this->addElement(
            [
                'id' => 'permissionName',
                'type' => Element::TEXT,
                'label' => "Name der Gruppe",
                'read' => function () use ($permission) {
                    if ($permission instanceof AccessControlPermission && !empty($permission->getName())) {
                        return $permission->getName();
                    }

                    return "";
                },
                'write' => function ($value) use ($permission) {
                    if ($permission instanceof AccessControlPermission) {
                        $permission->setName($value);
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