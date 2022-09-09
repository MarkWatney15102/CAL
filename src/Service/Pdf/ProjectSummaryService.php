<?php

namespace src\Service\Pdf;

use src\Model\Task\Mapper\TaskContainer;
use src\Model\Task\Task;

class ProjectSummaryService
{
    public function getTasksByProject(int $projectId): array
    {
        $taskList = [];

        /** @var Task[] $mainTasks */
        $mainTasks = TaskContainer::getInstance()?->findBy(['projectId' => $projectId, 'childOf' => [-1, 0]]);

        foreach ($mainTasks as $task) {
            $taskList[] = [
                'mainTask' => $task,
                'subTasks' => $this->getSubTasks($task->getID())
            ];
        }

        return $taskList;
    }

    private function getSubTasks(int $mainTaskId): array
    {
        $taskList = [];

        /** @var Task[] $parentTasks */
        $parentTasks = TaskContainer::getInstance()?->findBy(['childOf' => $mainTaskId]);

        foreach ($parentTasks as $parentTask) {
            $taskList[] = [
                'mainTask' => $parentTask,
                'subTasks' => $this->getSubTasks($parentTask->getID())
            ];
        }

        return $taskList;
    }

    public function buildTaskList(array $tasks): string
    {
        $html = "<ul>";

        foreach ($tasks as $task) {
            $mainTask = $task['mainTask'];
            $subTasks = $task['subTasks'];

            $html .= <<<HTML
                {$this->buildMainChildList($mainTask, $subTasks)}
            HTML;

        }

        $html .= "</ul>";

        return $html;
    }

    private function buildMainChildList(Task $mainTask, array $subTasks): string
    {
        $orderNeeded = ((int)$mainTask->getOrderNeeded() === 1) ? 'Ja [' . $mainTask->getOrderId() . ']' : 'Nein';

        $string = <<<HTML
            <li>Aufgabe: [{$mainTask->getID()}] {$mainTask->getName()} | Bestellung Notendig: {$orderNeeded}<li>
        HTML;

        $html = "<ul>";

        foreach ($subTasks as $subTask) {
            $html .= <<<HTML
                {$this->buildMainChildList($subTask['mainTask'],  $subTask['subTasks'])}
            HTML;

        }

        $html .= "</ul>";

        $string .= $html;

        return $string;
    }
}