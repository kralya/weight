<?php

class Auth
{
    public static function isLogged()
    {
    }

    public static function logout()
    {
    }

    public static function login($email)
    {
    }

    public static function redirectUnlogged()
    {
        if (!self::isLogged()) {
            Utility::redirect(WELCOME_PAGE);
        }
    }

    public static function getEmail()
    {
    }
}