<?php

declare(strict_types=1);

namespace src\Model\ProjectStatus;

use lib\Model\AbstractEntity;

class ProjectStatus extends AbstractEntity
{
    protected string $text;

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}
