<?php

class Weight
{
    public static function get($date)
    {
        $email = Auth::getEmail();
        $query = 'SELECT weight FROM weight w, user u WHERE u.id = w.id_user AND email="%s" AND w.created_at="%s"';
        $res = mysql_query(sprintf($query, $email, $date));
        if(0 == mysql_num_rows($res)){
            return 0;
        }

        $row = mysql_fetch_assoc($res);
        return $row['weight'];
    }

    public static function getForDaysAgo($daysAgo)
    {
        $email = Auth::getEmail();
        $finish = new DateTime("-$daysAgo days");

        $query = 'SELECT weight, w.created_at FROM weight w, user u WHERE u.id = w.id_user AND u.email = "%s" AND w.created_at > "%s"';
        $res = mysql_query(sprintf($query, $email, $finish->format('Y-m-d')));

        if (mysql_num_rows($res) === 0) {
            return array();
        }

        $weights = array();
        while ($row = mysql_fetch_assoc($res)) {
            $weights[$row['created_at']] = $row['weight'];
        }

        return self::orderAndLimit($weights, $daysAgo);
    }

    protected static function orderAndLimit($weights, $limit)
    {
        $results = array();
        for ($i = 0; $i < $limit; $i++) {
            $date = new DateTime(sprintf(' -%s days', ($limit - $i)));
            $results[$date->format('Y-m-d')] = isset($weights[$date->format('Y-m-d')]) ? $weights[$date->format('Y-m-d')] : '';
        }

        return $results;
    }

    public static function set($date, $weight)
    {
        $id = User::getIdByEmail(Auth::getEmail());

        if(self::get($date) > 0){
            $query = 'UPDATE weight SET weight="%s" WHERE id_user = "%s" AND created_at = "%s"';
            mysql_query(sprintf($query, $weight, $id, $date));
            return;
        }

        $query = 'INSERT INTO weight (id_user, weight, created_at) VALUES("%s", "%s", "%s")';
        mysql_query(sprintf($query, $id, $weight, $date));
    }
}