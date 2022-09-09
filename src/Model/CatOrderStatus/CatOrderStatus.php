<?php

namespace src\Model\CatOrderStatus;

use lib\Model\AbstractEntity;

class CatOrderStatus extends AbstractEntity
{
    protected $text;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }
}