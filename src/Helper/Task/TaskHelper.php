<?php

namespace src\Helper\Task;

use src\Model\Resource\Mapper\ResourceContainer;
use src\Model\Resource\Resource;
use src\Model\Task\Mapper\TaskContainer;
use src\Model\Task\Task;
use src\Model\User\Mapper\UserContainer;
use src\Model\User\User;

class TaskHelper
{
    public function getUserList(): array
    {
        $options = [];

        /** @var User[] $users */
        $users = UserContainer::getInstance()?->findBy([]);

        foreach ($users as $user) {
            $text = "[" . $user->getId() . "] " . $user->getFirstname() . " " . $user->getLastname() . " (" . $user->getUsername() . ")";

            $options[] = ['value' => $user->getID(), 'text' => $text];
        }

        return $options;
    }

    public function getTaskList(int $projectId, int $taskId): array
    {
        $options = [];

        /** @var Task[] $tasks */
        $tasks = TaskContainer::getInstance()?->findBy(['projectId' => $projectId, 'ID[!]' => $taskId]);

        foreach ($tasks as $task) {
            $text = "[" . $task->getID() . "] " . $task->getName();

            $options[] = ['value' => $task->getID(), 'text' => $text];
        }

        return $options;
    }

    public function getTaskStatus(): array
    {
        return [
          ['value' => 1, 'text' => 'Offen'],
          ['value' => 2, 'text' => 'In Bearbeitung'],
          ['value' => 3, 'text' => 'Abgeschlossen']
        ];
    }

    public function getSubTasks(int $taskId): array
    {
        return TaskContainer::getInstance()?->findBy(['childOf' => $taskId]);
    }

    public function getResourcesFields(int $taskId): string
    {
        $html = "";

        /** @var Resource[] $resources */
        $resources = ResourceContainer::getInstance()?->findBy(['taskId' => $taskId]);

        foreach ($resources as $resource) {
            $html .= <<<HTML
                <div class='row'>
                    <div class='col-lg-4'>
                        <input type='text' class='form-control' name='resourceType[{$resource->getID()}]' value="{$resource->getName()}">
                    </div>
                    <div class='col-lg-4'>
                        <input type='number' class='form-control' name='resourceAmount[{$resource->getID()}]' value="{$resource->getAmount()}">
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-outline-info saveResource" name="saveResource" data-resource-id="{$resource->getID()}">
                            Speichern
                        </button>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-outline-info deleteResource" name="deleteResource" data-resource-id="{$resource->getID()}">
                            Löschen
                        </button>
                    </div>
                </div><br>
            HTML;
        }

        return $html;
    }
}