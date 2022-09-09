<?php

namespace lib\Message;

use lib\Singleton\Singleton;

class MessageGroup extends Singleton
{
    private array $messages;

    public function addMessage(Message $messageType, string $title, string $message = ""): void
    {
        $concreteClass = $messageType->getMessage();

        $concreteClass->setTitle($title);
        $concreteClass->setMessage($message);

        $this->messages[] = $concreteClass;

        $_SESSION['messages'][$concreteClass->getId()] = [
            'type' => $messageType->name,
            'title' => $title,
            'message' => $message
        ];
    }

    public function reAddMessage(AbstractMessage $message): void
    {
        $this->messages[] = $message;
    }

    public static function getInstance(string $className = '')
    {
        /** @var MessageGroup $messageGroup */
        $messageGroup = parent::getInstance($className);

        if (!empty($_SESSION['messages'])) {
            $messages = $_SESSION['messages'];
            foreach ($messages as $id => $message) {
                if (!empty($message['type'])) {
                    $messageClass = Message::getMessageClass($message['type']);

                    if (!empty($message['title']) && !empty($message['message'])) {
                        $messageClass->setTitle($message['title']);
                        $messageClass->setMessage($message['message']);
                    }
                    $messageGroup->reAddMessage($messageClass);
                    unset($_SESSION['messages'][$id]);
                }
            }
        }

        return $messageGroup;
    }

    public function printMessages(): string
    {
        $html = "";

        /** @var AbstractMessage $message */
        if (!empty($this->messages)) {
            foreach ($this->messages as $message) {
                $html .= $message->getHtml();
            }
        }

        return $html;
    }
}