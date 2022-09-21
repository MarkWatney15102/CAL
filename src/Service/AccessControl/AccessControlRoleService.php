<?php

namespace src\Service\AccessControl;

use src\Model\AccessControlGroup\AccessControlGroup;
use src\Model\AccessControlGroup\Mapper\AccessControlGroupContainer;
use src\Model\AccessControlGroupToAccessControlRole\AccessControlGroupToAccessControlRole;
use src\Model\AccessControlGroupToAccessControlRole\Mapper\AccessControlGroupToAccessControlRoleContainer;

class AccessControlRoleService
{
    public function __construct(private int $roleId)
    {
    }

    public function getGroupsWithStatus(): array
    {
        $groupList = [];

        /** @var AccessControlGroup[] $groups */
        $groups = AccessControlGroupContainer::getInstance()?->findBy([]);

        foreach ($groups as $group) {
            $roleGroupAssignment = AccessControlGroupToAccessControlRoleContainer::getInstance()?->findOne(
                [
                    'groupId' => $group->getID(),
                    'roleId' => $this->roleId
                ]
            );

            $status = 0;
            if ($roleGroupAssignment instanceof AccessControlGroupToAccessControlRole) {
                $status = 1;
            }

            $groupList[] = ['group' => $group, 'status' => $status];
        }

        return $groupList;
    }
}