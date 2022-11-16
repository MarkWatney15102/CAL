<?php

namespace src\Model\StoragePlace;

use lib\Model\AbstractEntity;

class StoragePlace extends AbstractEntity
{
    protected $name = "";

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}