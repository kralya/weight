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

    public static function getIdByEmail($email)
    {
        $query = 'SELECT id FROM user WHERE email = "%s" LIMIT 1';
        $res = mysql_query(sprintf($query, $email));
        $row = mysql_fetch_assoc($res);
        return $row['id'];
    }
}