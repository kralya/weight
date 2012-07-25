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

        $weights = array();
        while ($row = mysql_fetch_assoc($res)) {
            $weights[$row['created_at']] = $row['weight'];
        }

        $result = self::orderAndLimit($weights, $daysAgo);

        return self::prepareForJavascript($result);
    }

    protected static function orderAndLimit($weights, $limit)
    {
        $results = array();
        for ($i = 1; $i <= $limit; $i++) {
            $date = new DateTime(sprintf(' -%s days', ($limit - $i)));
            $results[$date->format('Y-m-d')] = isset($weights[$date->format('Y-m-d')]) ? $weights[$date->format('Y-m-d')] : '';
        }

        return $results;
    }

    // months in JS are zero-based, 0 means January.
    // in PHP 1 means January. Decrease month number by one.
    protected static function prepareForJavascript($input){
        $results = array();
        foreach($input as $date => $value){
            $parts = explode('-', $date);
            $month  = ($parts[1] - 1 < 10)  ? '0'.($parts[1] - 1) : ($parts[1] - 1);

            $results[$date]['weight'] = $value;
            $results[$date]['js-date'] = $parts[0].'-'.$month.'-'.$parts[2];
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