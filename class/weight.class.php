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
        $finish = new DateTime("-$daysAgo days");

        $query = 'SELECT weight, w.created_at FROM weight w, user u WHERE u.id = w.id_user AND u.email = "%s" AND w.created_at > "%s"';
        $res = mysql_query(sprintf($query, $email, $finish->format('Y-m-d')));

        if(mysql_num_rows($res) === 0){
            return array();
        }

        $result = array();
        while($row = mysql_fetch_assoc($res)){
            $result[] = $row;
        }

        return $result;
    }

    public static function set($date)
    {
        $email = Auth::getEmail();

    }
}