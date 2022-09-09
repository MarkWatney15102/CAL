<?php

namespace src\Model\CatJobHistoryTypes;

use lib\Model\AbstractEntity;

class CatJobHistoryTypes extends AbstractEntity
{
    protected string $text;

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}