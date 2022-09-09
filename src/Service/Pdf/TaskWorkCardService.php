<?php

namespace src\Service\Pdf;

use src\Model\Resource\Mapper\ResourceContainer;
use src\Model\Resource\Resource;
use src\Model\Task\Task;

class TaskWorkCardService
{
    private Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getStatus(): string
    {
        return match ($this->task->getStatus()) {
            1 => 'Offen',
            2 => 'In Bearbeitung',
            3 => 'Abgeschlossen',
            default => '',
        };
    }

    public function getResourceList(): string
    {
        /** @var Resource[] $resources */
        $resources = ResourceContainer::getInstance()?->findBy(['taskId' => $this->task->getID()]);

        $html = "<table class='resources'>";

        foreach ($resources as $resource) {
            $html .= <<<HTML
                <tr>
                    <td style="width: 50%;">{$resource->getName()}</td>
                    <td style="width: 25%;">{$resource->getAmount()}x</td>
                    <td style="width: 25%;"><input type="checkbox" class="checkbox"></td>
                </tr>
                <br>
            HTML;
        }

        $html .= "</table>";

        return $html;
    }
}