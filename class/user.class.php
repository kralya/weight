<?php

class User
{
    public static function create($email)
    {
        $query = 'INSERT INTO user SET email="%s", created_at=NOW()';
        mysql_query(sprintf($query, $email));
    }

    public static function exists($email)
    {
        $query = 'SELECT 1 FROM user WHERE email = "%s" LIMIT 1';
        $res = mysql_query(sprintf($query, $email));
        return mysql_num_rows($res) > 0;
    }
}