<?php

namespace src\Form\AccessControl\Permission;

use src\Model\AccessControlPermission\AccessControlPermission;
use src\Model\AccessControlPermission\Mapper\AccessControlPermissionMapper;

class AccessControlPermissionFormFactory
{
    public static function makeWithoutModel(): AccessControlPermissionForm
    {
        $formData = new AccessControlPermissionFormData();

        $accessControlPermission = new AccessControlPermission();
        $accessControlPermission->setName("");

        $formData->addModel($accessControlPermission, 'permission');

        $formData->initStructure();

        return new AccessControlPermissionForm('accessControlPermissionForm', $formData);
    }

    public static function make(int $PermissionId): AccessControlPermissionForm
    {
        $formData = new AccessControlPermissionFormData();

        $accessControlPermission = AccessControlPermissionMapper::getInstance()?->read($PermissionId);
        if (!$accessControlPermission instanceof AccessControlPermission) {
            throw new \Exception('Permission not found');
        }
        $formData->addModel($accessControlPermission, 'permission');

        $formData->initStructure();

        return new AccessControlPermissionForm('accessControlPermissionForm', $formData);
    }
}