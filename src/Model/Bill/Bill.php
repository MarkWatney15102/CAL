<?php

use lib\Model\AbstractEntity;

class Bill extends AbstractEntity
{
    protected $title;
    protected $creator_user_id;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getCreator_user_id()
    {
        return $this->creator_user_id;
    }

    public function setCreator_user_id($creator_user_id): void
    {
        $this->creator_user_id = $creator_user_id;
    }
}