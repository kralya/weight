<?php

class Auth
{
    protected static $user;
    public static function isLogged()
    {
        return isset($_SESSION[self::$user]);
    }

    public static function logout()
    {
        unset($_SESSION[self::$user]);
    }

    public static function login($email)
    {
        $_SESSION[self::$user] = $email;
    }

    public static function redirectUnlogged()
    {
        if (!self::isLogged()) {
            Utility::redirect(WELCOME_PAGE);
        }
    }

    public static function getEmail()
    {
        return $_SESSION[self::$user];
    }
}