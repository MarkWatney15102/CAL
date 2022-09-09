<?php

namespace src\Model\AccessControlPermissionToAccessControlGroup;

use lib\Model\AbstractEntity;

class AccessControlPermissionToAccessControlGroup extends AbstractEntity
{
    protected $permissionId;
    protected $groupId;

    /**
     * @return mixed
     */
    public function getPermissionId()
    {
        return $this->permissionId;
    }

    /**
     * @param mixed $permissionId
     */
    public function setPermissionId($permissionId): void
    {
        $this->permissionId = $permissionId;
    }

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
}