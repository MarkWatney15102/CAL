<?php

namespace src\Model\JobHistory;

use lib\Model\AbstractEntity;

class JobHistory extends AbstractEntity
{
    protected string $jobId = "0";
    protected string $userId = "0";
    protected string $message = "";
    protected string $type = "0";
    protected string $timestamp;

    public function getJobId(): int
    {
        return (int)$this->jobId;
    }

    public function setJobId(int $jobId): void
    {
        $this->jobId = (string)$jobId;
    }

    public function getUserId(): int
    {
        return (int)$this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = (string)$userId;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getType(): int
    {
        return (int)$this->type;
    }

    public function setType(int $type): void
    {
        $this->type = (string)$type;
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    public function setTimestamp(string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }
}