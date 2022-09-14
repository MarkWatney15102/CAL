<?php

namespace src\Form\AccessControl\Role;

use lib\Element\AbstractElement;
use lib\Element\Elements\ElementSubmit;
use lib\Form\AbstractForm;
use src\Model\AccessControlRole\AccessControlRole;
use src\Model\AccessControlRole\Mapper\AccessControlRoleMapper;

class AccessControlRoleForm extends AbstractForm
{
    public function save(): void
    {
        $elements = $this->formData->getElements();
        /** @var AccessControlRole $role */
        $role = $this->formData->getModel('role');

        foreach ($elements as $element) {
            if ($element instanceof AbstractElement && !$element instanceof ElementSubmit) {
                if (array_key_exists($element->getId(), $_POST)) {
                    $newValue = $_POST[$element->getId()];
                    if (!empty($element->getWrite())) {
                        call_user_func($element->getWrite(), $newValue);
                    }
                }
            }
        }

        if ($role->getID() !== null) {
            $roleId = AccessControlRoleMapper::getInstance()?->update($role);
        } else {
            $roleId = AccessControlRoleMapper::getInstance()?->create($role);
        }

        header('Location: /admin/ac/role/edit/' . $roleId);
    }
}