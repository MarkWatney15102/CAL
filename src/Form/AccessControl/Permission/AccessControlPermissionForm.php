<?php

namespace src\Form\AccessControl\Permission;

use lib\Element\AbstractElement;
use lib\Element\Elements\ElementSubmit;
use lib\Form\AbstractForm;
use src\Model\AccessControlPermission\AccessControlPermission;
use src\Model\AccessControlPermission\Mapper\AccessControlPermissionMapper;

class AccessControlPermissionForm extends AbstractForm
{
    public function save(): void
    {
        $elements = $this->formData->getElements();
        /** @var AccessControlPermission $permission */
        $permission = $this->formData->getModel('permission');

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

        if ($permission->getID() !== null) {
            $permissionId = AccessControlPermissionMapper::getInstance()?->update($permission);
        } else {
            $permissionId = AccessControlPermissionMapper::getInstance()?->create($permission);
        }

        header('Location: /admin/ac/permission/edit/' . $permissionId);
    }
}