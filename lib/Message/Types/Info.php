<?php

namespace lib\Message\Types;

use lib\Message\AbstractMessage;

class Info extends AbstractMessage
{
    public function getHtml(): string
    {
        return <<<HTML
            <div class="alert alert-primary notification" role="alert">
                <b>{$this->getTitle()}</b>
                <br>
                {$this->getMessage()}
            </div>       
        HTML;
    }
}