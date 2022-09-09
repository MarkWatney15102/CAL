<?php

namespace lib\Message;

use lib\Message\Types\Error;
use lib\Message\Types\Info;
use lib\Message\Types\Success;
use lib\Message\Types\Warning;

enum Message
{
    case INFO;
    case WARNING;
    case ERROR;
    case SUCCESS;

    public function getMessage(): AbstractMessage
    {
        $abstractMessage = self::getMessageClass($this->name);

        $abstractMessage->generateId();

        return $abstractMessage;
    }

    public static function getMessageClass(string $type): AbstractMessage
    {
        return match($type) {
            'INFO' => new Info(),
            'WARNING' => new Warning(),
            'ERROR' => new Error(),
            'SUCCESS' => new Success(),
            default => throw new \Exception('Type does not exist')
        };
    }
}