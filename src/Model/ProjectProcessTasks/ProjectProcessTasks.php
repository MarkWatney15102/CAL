<?php

namespace src\Model\ProjectProcessTasks;

use lib\Model\AbstractEntity;

class ProjectProcessTasks extends AbstractEntity
{
    protected int $projectProcessId = 0;
    protected int $taskId = 0;
    protected int $status = 0;

    /**
     * @return int
     */
    public function getProjectProcessId(): int
    {
        return $this->projectProcessId;
    }

    /**
     * @param int $projectProcessId
     */
    public function setProjectProcessId(int $projectProcessId): void
    {
        $this->projectProcessId = $projectProcessId;
    }

    /**
     * @return int
     */
    public function getTaskId(): int
    {
        return $this->taskId;
    }

    /**
     * @param int $taskId
     */
    public function setTaskId(int $taskId): void
    {
        $this->taskId = $taskId;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}