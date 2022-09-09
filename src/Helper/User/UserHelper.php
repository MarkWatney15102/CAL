<?php

namespace src\Helper\User;

use lib\Auth\Level;
use lib\Message\Message;
use lib\Message\MessageGroup;
use src\Helper\Redirect;
use src\Model\User\Mapper\UserMapper;
use src\Model\User\User;

class UserHelper
{
    public static function getUsername(): string
    {
        $name = "";

        $user = UserMapper::getInstance()?->read((int)$_COOKIE['UID']);

        if ($user instanceof User) {
            $name = $user->getFirstname() . " " . $user->getLastname();
        }

        return $name;
    }

    public static function getUid(): int
    {
        if (empty($_COOKIE['UID'])) {
            MessageGroup::getInstance()?->addMessage(Message::ERROR, 'Es ist ein Problem aufgetreten', 'Nutzer nicht eingeloggt');
            Redirect::to('/login');
        }

        return (int)$_COOKIE['UID'];
    }

    public static function hasUserRequiredLevel(Level $level): bool
    {
        $access = false;

        /** @var User $user */
        $user = UserMapper::getInstance()?->getCurrentUser();

        if ($user->getLevel() >= $level->getLevel()) {
            $access = true;
        }

        return $access;
    }
}