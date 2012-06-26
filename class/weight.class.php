<?php

class Weight
{
    public static function get($date)
    {
        $email = Auth::getEmail();

    }

    public static function getForDaysAgo($daysAgo)
    {
        $email = Auth::getEmail();
        $start = new DateTime('now');
        $finish = new DateTime("-$daysAgo days");
    }

    public static function set($date)
    {
        $email = Auth::getEmail();

    }
}