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

        // get unordered array $x[date] = weight
        $weights = array();
        while($row = mysql_fetch_assoc($res)){
            $weights[$row['created_at']] = $row['weight'];
        }

        // order it, limit to DAYS_AGO_INDEX values, fill with empty values for absent dates.
        $results = array();
        for($i=0; $i < $daysAgo; $i++){
            $date = new DateTime(sprintf(' -%s days', ($daysAgo-$i) ));
            $results[$date->format('Y-m-d')] = isset($weights[$date->format('Y-m-d')]) ? $weights[$date->format('Y-m-d')] : '';
        }

        return $results;
    }

    public static function set($date)
    {
        $email = Auth::getEmail();

    }
}