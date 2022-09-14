<?php

namespace src\Model\Migration;

use lib\Model\AbstractEntity;

class Migration extends AbstractEntity
{
    protected $migrationName;
    protected $status;
    protected $message;
    protected $timestamp;

    /**
     * @return mixed
     */
    public function getMigrationName()
    {
        return $this->migrationName;
    }

    /**
     * @param mixed $migrationName
     */
    public function setMigrationName($migrationName): void
    {
        $this->migrationName = $migrationName;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp): void
    {
        $this->timestamp = $timestamp;
    }
}