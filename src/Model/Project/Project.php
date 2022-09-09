<?php

declare(strict_types=1);

namespace src\Model\Project;

use lib\Model\AbstractEntity;

class Project extends AbstractEntity
{
    protected $title;
    protected $description;
    protected $start;
    protected $end;
    protected $creator_user_id;
    protected $current_worker_user_id;
    protected $status;
    protected $sollCount = 0;
    protected $istCount = 0;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getCurrent_worker_user_id()
    {
        return $this->current_worker_user_id;
    }

    public function setCurrent_worker_user_id($current_worker_user_id)
    {
        $this->current_worker_user_id = $current_worker_user_id;
        return $this;
    }

    public function getCreator_user_id()
    {
        return $this->creator_user_id;
    }

    public function setCreator_user_id($creator_user_id)
    {
        $this->creator_user_id = $creator_user_id;
        return $this;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function setEnd($end)
    {
        $this->end = $end;
        return $this;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setStart($start)
    {
        $this->start = $start;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getSollCount()
    {
        return (int)$this->sollCount;
    }

    public function setSollCount($sollCount): void
    {
        $this->sollCount = (int)$sollCount;
    }

    public function getIstCount()
    {
        return (int)$this->istCount;
    }

    public function setIstCount($istCount): void
    {
        $this->istCount = (int)$istCount;
    }


}
