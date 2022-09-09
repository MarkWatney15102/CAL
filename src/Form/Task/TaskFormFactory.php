<?php

namespace src\Form\Task;

use src\Model\Task\Mapper\TaskMapper;
use src\Model\Task\Task;
use src\Model\Project\Mapper\ProjectMapper;
use src\Model\Project\Project;

class TaskFormFactory
{
    public static function makeWithoutModel(int $projectId): TaskForm
    {
        $formData = new TaskFormData();

        $project = ProjectMapper::getInstance()->read($projectId);
        if (!$project instanceof Project) {
            throw new \Exception('Project dosent exist');
        }
        $formData->addModel($project, 'project');

        $task = new Task();
        $task->setProjectId($projectId);
        $formData->addModel($task, 'task');

        $formData->initStructure();

        return new TaskForm('taskForm', $formData);
    }

    public static function make(int $projectId, int $taskId): TaskForm
    {
        $project = ProjectMapper::getInstance()?->read($projectId);
        $task = TaskMapper::getInstance()?->read($taskId);

        $formData = new TaskFormData();

        if ($project instanceof Project) {
            $formData->addModel($project, 'project');
        }

        if ($task instanceof Task) {
            $task->setTimestamp('0000-00-00 00:00:00');
            $formData->addModel($task, 'task');
        }

        $formData->initStructure();

        return new TaskForm('taskForm', $formData);
    }
}