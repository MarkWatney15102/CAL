<?php

namespace src\Service\AccessControl;

use src\Model\AccessControlPermission\AccessControlPermission;
use src\Model\AccessControlPermission\Mapper\AccessControlPermissionContainer;
use src\Model\AccessControlPermissionToAccessControlGroup\AccessControlPermissionToAccessControlGroup;
use src\Model\AccessControlPermissionToAccessControlGroup\Mapper\AccessControlPermissionToAccessControlGroupContainer;

class AccessControlGroupService
{
    public function __construct(private int $groupId)
    {
    }

    public function getPermissionsWithStatus(): array
    {
        $permissionList = [];

        /** @var AccessControlPermission[] $permissions */
        $permissions = AccessControlPermissionContainer::getInstance()?->findBy([]);

        foreach ($permissions as $permission) {
            $assignment = AccessControlPermissionToAccessControlGroupContainer::getInstance()?->findOne(
                [
                    'permissionId' => $permission->getID(),
                    'groupId' => $this->groupId
                ]
            );

            $status = 0;
            if ($assignment instanceof AccessControlPermissionToAccessControlGroup) {
                $status = 1;
            }

            $permissionList[] = ['permission' => $permission, 'status' => $status];
        }

        return $permissionList;
    }
}