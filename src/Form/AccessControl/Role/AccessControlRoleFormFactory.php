<?php

namespace src\Form\AccessControl\Role;

use src\Model\AccessControlRole\AccessControlRole;
use src\Model\AccessControlRole\Mapper\AccessControlRoleMapper;

class AccessControlRoleFormFactory
{
    public static function makeWithoutModel(): AccessControlRoleForm
    {
        $formData = new AccessControlRoleFormData();

        $accessControlRole = new AccessControlRole();
        $accessControlRole->setName("");

        $formData->addModel($accessControlRole, 'role');

        $formData->initStructure();

        return new AccessControlRoleForm('accessControlRoleForm', $formData);
    }

    public static function make(int $roleId): AccessControlRoleForm
    {
        $formData = new AccessControlRoleFormData();

        $accessControlRole = AccessControlRoleMapper::getInstance()?->read($roleId);
        if (!$accessControlRole instanceof AccessControlRole) {
            throw new \Exception('Role not found');
        }
        $formData->addModel($accessControlRole, 'role');

        $formData->initStructure();

        return new AccessControlRoleForm('accessControlRoleForm', $formData);
    }
}