<?php

namespace lib\Auth;

use src\Helper\User\UserHelper;
use src\Model\AccessControlGroupToAccessControlRole\AccessControlGroupToAccessControlRole;
use src\Model\AccessControlGroupToAccessControlRole\Mapper\AccessControlGroupToAccessControlRoleContainer;
use src\Model\AccessControlPermission\AccessControlPermission;
use src\Model\AccessControlPermission\Mapper\AccessControlPermissionMapper;
use src\Model\AccessControlPermissionToAccessControlGroup\AccessControlPermissionToAccessControlGroup;
use src\Model\AccessControlPermissionToAccessControlGroup\Mapper\AccessControlPermissionToAccessControlGroupContainer;
use src\Model\User\Mapper\UserMapper;
use src\Model\User\User;

class AccessControl
{
    public static function hasPermission(string $permissionName): bool
    {
        $access = false;

        $user = UserMapper::getInstance()?->read(UserHelper::getUid());

        if ($user instanceof User) {
            $roleId = $user->getRole();

            /** @var AccessControlGroupToAccessControlRole[] $roles */
            $roles = AccessControlGroupToAccessControlRoleContainer::getInstance()?->findBy(['roleId' => $roleId]);

            foreach ($roles as $role) {
                /** @var AccessControlPermissionToAccessControlGroup[] $groups */
                $groups = AccessControlPermissionToAccessControlGroupContainer::getInstance()?->findBy(['groupId' => $role->getGroupId()]);

                foreach ($groups as $group) {
                    $permissionId = $group->getPermissionId();

                    $permission = AccessControlPermissionMapper::getInstance()?->read($permissionId);

                    if ($permission instanceof AccessControlPermission) {
                        if ($permission->getName() === $permissionName) {
                            $access = true;
                        }
                    }
                }
            }
        }

        return $access;
    }
}