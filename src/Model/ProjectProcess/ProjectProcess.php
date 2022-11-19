<?php

namespace src\Model\ProjectProcess;

use lib\Model\AbstractEntity;

class ProjectProcess extends AbstractEntity
{
    protected int $projectId = 0;
    protected int $creatorUserId = 0;
    protected int $amountToBuild = 0;
    protected string $timestamp = "";

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     */
    public function setProjectId(int $projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * @return int
     */
    public function getCreatorUserId(): int
    {
        return $this->creatorUserId;
    }

    /**
     * @param int $creatorUserId
     */
    public function setCreatorUserId(int $creatorUserId): void
    {
        $this->creatorUserId = $creatorUserId;
    }

    /**
     * @return int
     */
    public function getAmountToBuild(): int
    {
        return $this->amountToBuild;
    }

    /**
     * @param int $amountToBuild
     */
    public function setAmountToBuild(int $amountToBuild): void
    {
        $this->amountToBuild = $amountToBuild;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     */
    public function setTimestamp(string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }
}