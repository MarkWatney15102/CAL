<?php
declare(strict_types=1);

namespace src\Service\Form\ProjectFormDataService;

use src\Model\ProjectStatus\Mapper\ProjectStatusContainer;
use src\Model\ProjectStatus\ProjectStatus;
use src\Model\User\Mapper\UserContainer;
use src\Model\User\User;

class ProjectFormDataService
{
    public function makeSelectOptions(): array
    {
        $options = [];

        $users = UserContainer::getInstance()->findBy();

        foreach ($users as $user) {
            if ($user instanceof User && $user->getStatus() !== 0) {
                $text = "[" . $user->getId() . "] " . $user->getFirstname() . " " . $user->getLastname() . " (" . $user->getUsername() . ")";

                $options[] = ['value' => $user->getId(), 'text' => $text];
            }
        }

        return $options;
    }

    public function makeStatusSelectOptions(): array
    {
        $options = [];

        $projectStatusList = ProjectStatusContainer::getInstance()?->findBy();

        foreach ($projectStatusList as $projectStatus) {
            if ($projectStatus instanceof ProjectStatus) {
                $options[] = ['value' => $projectStatus->getID(), 'text' => $projectStatus->getText()];
            }
        }

        return $options;
    }
}
