<?php

namespace src\Service\Project;

use src\Model\Project\Mapper\ProjectMapper;
use src\Model\Project\Project;
use src\Model\ProjectProcess\Mapper\ProjectProcessMapper;
use src\Model\ProjectProcess\ProjectProcess;
use src\Model\ProjectProcessTasks\Mapper\ProjectProcessTasksMapper;
use src\Model\ProjectProcessTasks\ProjectProcessTasks;
use src\Model\Task\Mapper\TaskContainer;
use src\Model\Task\Task;
use src\Model\User\User;

class ProjectProcessService
{
    public function createNewProcess(int $projectId, User $currentUser): int
    {
        $process = new ProjectProcess();

        $process->setProjectId($projectId);
        $process->setCreatorUserId($currentUser->getID());
        $process->setAmountToBuild(1);

        $this->updateProjectSollCount($projectId, 1);

        return ProjectProcessMapper::getInstance()?->create($process);
    }

    public function createNewProcessTasks(int $projectId, int $processId): void
    {
        /** @var Task[] $tasks */
        $tasks = $this->getProjectTasks($projectId);

        foreach ($tasks as $task) {
            $processTask = new ProjectProcessTasks();
            $processTask->setTaskId($task->getID());
            $processTask->setProjectProcessId($processId);
            $processTask->setStatus(0);

            ProjectProcessTasksMapper::getInstance()?->create($processTask);
        }
    }

    private function getProjectTasks(int $projectId): array
    {
        return TaskContainer::getInstance()?->findBy(['projectId' => $projectId]) ?? [];
    }

    private function updateProjectSollCount(int $projectId, int $addCount): void
    {
        $project = ProjectMapper::getInstance()?->read($projectId);

        if ($project instanceof Project) {
            $project->setSollCount($project->getSollCount() + $addCount);

            ProjectMapper::getInstance()?->update($project);
        }
    }
}