<?php

namespace src\Service\AccessControl;

use src\Model\AccessControlGroupToAccessControlRole\AccessControlGroupToAccessControlRole;
use src\Model\AccessControlGroupToAccessControlRole\Mapper\AccessControlGroupToAccessControlRoleContainer;
use src\Model\AccessControlGroupToAccessControlRole\Mapper\AccessControlGroupToAccessControlRoleMapper;
use src\Model\AccessControlPermissionToAccessControlGroup\AccessControlPermissionToAccessControlGroup;
use src\Model\AccessControlPermissionToAccessControlGroup\Mapper\AccessControlPermissionToAccessControlGroupContainer;
use src\Model\AccessControlPermissionToAccessControlGroup\Mapper\AccessControlPermissionToAccessControlGroupMapper;

class AccessControlService
{
    public function addGroupToRole(int $roleId, int $groupId): void
    {
        $assigment = new AccessControlGroupToAccessControlRole();
        $assigment->setGroupId($groupId);
        $assigment->setRoleId($roleId);

        AccessControlGroupToAccessControlRoleMapper::getInstance()?->create($assigment);
    }

    public function addPermissionToGroup(int $permissionId, int $groupId): void
    {
        $assigment = new AccessControlPermissionToAccessControlGroup();
        $assigment->setGroupId($groupId);
        $assigment->setPermissionId($permissionId);

        AccessControlPermissionToAccessControlGroupMapper::getInstance()?->create($assigment);
    }

    public function removeGroupFromRole(int $roleId, int $groupId): void
    {
        $assigment = AccessControlGroupToAccessControlRoleContainer::getInstance()?->findOne(
            [
                'roleId' => $roleId,
                'groupId' => $groupId
            ]
        );

        if ($assigment instanceof AccessControlGroupToAccessControlRole) {
            AccessControlGroupToAccessControlRoleMapper::getInstance()?->delete($assigment);
        }
    }

    public function removePermissionFromGroup(int $permissionId, int $groupId): void
    {
        $assigment = AccessControlPermissionToAccessControlGroupContainer::getInstance()?->findOne(
            [
                'permissionId' => $permissionId,
                'groupId' => $groupId
            ]
        );

        if ($assigment instanceof AccessControlPermissionToAccessControlGroup) {
            AccessControlPermissionToAccessControlGroupMapper::getInstance()?->delete($assigment);
        }
    }
}