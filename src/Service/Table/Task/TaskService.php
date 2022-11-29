<?php

namespace src\Service\Table\Task;

use src\Model\ProjectProcess\Mapper\ProjectProcessContainer;
use src\Model\Task\Task;

class TaskService
{
    public function buildTableBody(array $tasks): string
    {
        $html = "";

        /** @var Task $task */
        foreach ($tasks as $task) {
            $id = $task->getID();
            $title = $task->getName();
            $projectId = $task->getProjectId();

            $html .= <<<HTML
                <tr>
                    <td>$id</td>
                    <td>$title</td>
                    <td><a href="/task/$projectId/$id" class="btn btn-outline-primary">Öffnen</a></td>
                </tr>
            HTML;

        }

        return $html;
    }

    public function getActiveProcesses(int $projectId): array
    {
        return ProjectProcessContainer::getInstance()?->findBy(['projectId' => $projectId]);
    }
}