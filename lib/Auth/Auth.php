<?php

namespace lib\Auth;

class Auth
{
    public function isPasswordValid(string $passwordHash, string $passwordInput): bool
    {
        return password_verify($passwordInput, $passwordHash);
    }

    public function setUidCookie(string $uid): void
    {
        setcookie('UID', $uid, time() + 3600 * 12);
    }
}