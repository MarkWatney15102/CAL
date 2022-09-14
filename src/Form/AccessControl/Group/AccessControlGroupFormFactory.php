<?php

namespace src\Form\AccessControl\Group;

use src\Model\AccessControlGroup\AccessControlGroup;
use src\Model\AccessControlGroup\Mapper\AccessControlGroupMapper;

class AccessControlGroupFormFactory
{
    public static function makeWithoutModel(): AccessControlGroupForm
    {
        $formData = new AccessControlGroupFormData();

        $accessControlGroup = new AccessControlGroup();
        $accessControlGroup->setName("");

        $formData->addModel($accessControlGroup, 'group');

        $formData->initStructure();

        return new AccessControlGroupForm('accessControlGroupForm', $formData);
    }

    public static function make(int $GroupId): AccessControlGroupForm
    {
        $formData = new AccessControlGroupFormData();

        $accessControlGroup = AccessControlGroupMapper::getInstance()?->read($GroupId);
        if (!$accessControlGroup instanceof AccessControlGroup) {
            throw new \Exception('Group not found');
        }
        $formData->addModel($accessControlGroup, 'group');

        $formData->initStructure();

        return new AccessControlGroupForm('accessControlGroupForm', $formData);
    }
}