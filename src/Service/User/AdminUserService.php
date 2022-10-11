<?php

namespace src\Service\User;

use lib\Auth\Level;
use src\Model\AccessControlRole\AccessControlRole;
use src\Model\AccessControlRole\Mapper\AccessControlRoleContainer;

class AdminUserService
{
    public function getLevelOption(): array
    {
        return [
            ['value' => Level::ADMIN->getLevel(), 'text' => Level::ADMIN->name],
            ['value' => Level::MANAGEMENT->getLevel(), 'text' => Level::MANAGEMENT->name],
            ['value' => Level::WORKER->getLevel(), 'text' => Level::WORKER->name],
            ['value' => Level::NO_LEVEL->getLevel(), 'text' => Level::NO_LEVEL->name],
        ];
    }

    public function getRoleOptions(): array
    {
        $options = [];

        /** @var AccessControlRole[] $roles */
        $roles = AccessControlRoleContainer::getInstance()?->findBy([]);

        foreach ($roles as $role) {
            $options[] = ['value' => $role->getID(), 'text' => $role->getName()];
        }

        return $options;
    }
}