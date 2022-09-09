<?php

namespace src\Model\AccessControlGroup\AccessControlGroupToAccessControlRole;

use lib\Model\AbstractEntity;

class AccessControlGroupToAccessControlRole extends AbstractEntity
{
    protected $groupId;
    protected $roleId;

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param mixed $groupId
     */
    public function setGroupId($groupId): void
    {
        $this->groupId = $groupId;
    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * @param mixed $roleId
     */
    public function setRoleId($roleId): void
    {
        $this->roleId = $roleId;
    }
}