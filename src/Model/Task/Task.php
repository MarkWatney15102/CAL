<?php

namespace src\Model\Task;

use lib\Model\AbstractEntity;

class Task extends AbstractEntity
{
    protected $name;
    protected $creator;
    protected $assignedUserId;
    protected $projectId;
    protected $childOf;
    protected $timestamp;
    protected $status;
    protected $orderNeeded;
    protected $orderId;
    protected $orderInformation;
    protected $description;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator): void
    {
        $this->creator = $creator;
    }

    /**
     * @return mixed
     */
    public function getAssignedUserId()
    {
        return $this->assignedUserId;
    }

    /**
     * @param mixed $assignedUserId
     */
    public function setAssignedUserId($assignedUserId): void
    {
        $this->assignedUserId = $assignedUserId;
    }

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @param mixed $projectId
     */
    public function setProjectId($projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * @return mixed
     */
    public function getChildOf()
    {
        return $this->childOf;
    }

    /**
     * @param mixed $childOf
     */
    public function setChildOf($childOf): void
    {
        $this->childOf = $childOf;
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
    public function getOrderNeeded()
    {
        return $this->orderNeeded;
    }

    /**
     * @param mixed $orderNeeded
     */
    public function setOrderNeeded($orderNeeded): void
    {
        $this->orderNeeded = $orderNeeded;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getOrderInformation()
    {
        return $this->orderInformation;
    }

    /**
     * @param mixed $orderInformation
     */
    public function setOrderInformation($orderInformation): void
    {
        $this->orderInformation = $orderInformation;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }
}