<?php

class Weight
{
    private static $weekdays = array(1 => 'Пн', 2 => 'Вт', 3 => 'Ср', 4 => 'Чт', 5 => 'Пт', 6 => 'Сб', 7 => 'Вс');
    private static $todayTexts = array('Сегодня, ', 'Вчера, ', 'Позавчера, ', '', '', '', '');

    public static function getForWeekday($weekday, $daysAgo)
    {

    }

    public static function isDisplayed($weights)
    {
        $counter = 0;
        foreach ($weights as $key => $weight) {
            if (!empty($weights[$key]['weight'])) {
                $counter++;
            }
        }
        return $counter > 1;
    }

    public static function getTrendFor($weight, $daysAgo)
    {
        $total = count($weight);

// if amount of points < 2, return;
        if(2 > $total){
            return;
        }

// split array to two halves: left (up to middle, including it if there is even amount) and right, from middle to end element
        if($total % 2 === 0){
            $weightFirst = array_slice($weight, 0, $total/2);
            $weightSecond = array_slice($weight, $total/2, $total/2);
        }else{
            $weightFirst = array_slice($weight, 0, ceil($total/2));
            $weightSecond = array_slice($weight, floor($total/2), ceil($total/2));
        }

// count two sums: sum of 'left' and sum of 'right' sub-arrays.
        function countZ($value){
            return $value['weight'];
        }

//        $countFunctionY = function($value){return $value['weight'];};
        $sumFirstY = array_sum( array_map( 'countZ', $weightFirst) );
        $sumSecondY = array_sum( array_map( 'countZ', $weightSecond) );

// count arithmetical means of these sums. It is two Y ordinate values.
        $yFirst = $sumFirstY / ceil($total/2);
        $ySecond = $sumSecondY / ceil($total/2);

// count two sums of dates of 'left' and 'right' of 'left' and 'right' sub-arrays.

//        $countFunctionX = function($value){return (new DateTime($value['js-date']))->getTimestamp();};
        function countZZ($value){
            $dt = new MyDateTime($value['js-date']);
            return $dt->getTimestamp();
        }

        $sumFirstX = array_sum( array_map( 'countZZ', $weightFirst) );
        $sumSecondX = array_sum( array_map( 'countZZ', $weightSecond) );

// count arithmetical means of these sums. It is two X ordinate values.
        $xFirstTimestamp = $sumFirstX / ceil($total/2);
        $xSecondTimestamp = $sumSecondX / ceil($total/2);

// format dates to usual format
        $xdFirst = new MyDateTime();
        $xdFirst->setTimestamp($xFirstTimestamp);
        $xdSecond = new MyDateTime();
        $xdSecond->setTimestamp($xSecondTimestamp);

// At this point we got two points. Unfortunately, these are in the middle. We need points at the edge of screen.
// First end of interval is Today-$daysAgo, second is today.

// count coefficient:
        $ratio = ($yFirst - $ySecond) / ($xFirstTimestamp - $xSecondTimestamp);
// -1 month is because we used javascript to operate, there is 1 month difference
// TODO: check edge values of month for bugs.

        $dt = (new MyDateTime('-1 month'));
        $xTodayTimestamp = $dt->getTimestamp();
        $dt = (new MyDateTime('-1month -'.$daysAgo.' days'));
        $xVeryFirstTimestamp = $dt->getTimestamp();

// according to previous ratio calculation, get equations for today X and Y, and for -$daysAgo point X and Y
#        $ratio = ($yFirst - $yToday) / ($xFirstTimestamp - $xTodayTimestamp);
#        $ratio * ($xFirstTimestamp - $xTodayTimestamp) = $yFirst - $yToday;
        $yToday = $yFirst - $ratio * ($xFirstTimestamp - $xTodayTimestamp);
#        $ratio = ($yVeryFirst - $yFirst) / ($xVeryFirstTimestamp - $xFirstTimestamp);
        $yVeryFirst = $ratio *  ($xVeryFirstTimestamp - $xFirstTimestamp) + $yFirst;

        $dt = new MyDateTime();
        $xVeryFirstDate = $dt->setTimestamp($xVeryFirstTimestamp);
        $dt = new MyDateTime();
        $xTodayDate = $dt->setTimestamp($xTodayTimestamp);

        return (array(
            array($xVeryFirstDate->format('Y, m,d, H'), round($yVeryFirst, 1)),
            array($xTodayDate->format('Y, m, d, H'), round($yToday, 1))
        ));
    }

    public static function get($date)
    {
        $email = Auth::getEmail();
        $query = 'SELECT weight FROM weight w, user u WHERE u.id = w.id_user AND email="%s" AND w.created_at="%s"';
        $res = mysql_query(sprintf($query, $email, $date));
        if (0 == mysql_num_rows($res)) {
            return 0;
        }

        $row = mysql_fetch_assoc($res);
        return $row['weight'];
    }

    public static function getPositiveWeightForDaysAgo($daysAgo)
    {
        $weights = self::getForDaysAgo($daysAgo);
        foreach($weights as $key => $weight){
            if($weight['weight'] == ''){
                unset($weights[$key]);
            }
        }

        return $weights;
    }

    public static function getForDaysAgo($daysAgo)
    {
        $daysAgo +=7; // it is to have past week value
        $email = Auth::getEmail();
        $finish = new DateTime("-$daysAgo days");

        $query = 'SELECT weight, w.created_at FROM weight w, user u WHERE u.id = w.id_user AND u.email = "%s" AND w.created_at > "%s" AND w.weight <> ""';
        $res = mysql_query(sprintf($query, $email, $finish->format('Y-m-d')));

        $weights = array();
        while ($row = mysql_fetch_assoc($res)) {
            $weights[$row['created_at']] = $row['weight'];
        }

        $result = self::orderAndLimit($weights, $daysAgo);

        return self::prepareJavascriptAndDisplayDates($result);
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

    //TODO: refactor it. Now output is formatted both here in model and in view.

    // months in JS are zero-based, 0 means January.
    // in PHP 1 means January. Decrease month number by one.
    protected static function prepareJavascriptAndDisplayDates($input)
    {
        $weekdays = self::$weekdays;
        $texts    = self::$todayTexts;
        $total    = count($input);
        for ($i = 0; $i < $total; $i++) {
            $times        = strtotime('-' . $i . ' day');
            $weekAgoTimes = strtotime('-' . ($i + 7) . ' day');
            $weekAgoValue = isset($input[date('Y-m-d', $weekAgoTimes)]) ? $input[date('Y-m-d', $weekAgoTimes)] : '';
            $currentDates[date('Y-m-d', $times)] = array('weekday' => $weekdays[date(('N'), $times)],
                                                         'weekend' => in_array(date(('N'), $times), array(6, 7)),
                                                         'text'    => array_key_exists($i, $texts) ? $texts[$i] : '',
                                                         'date'    => date(('d M'), $times),
                                                         'valueWeekAgo' =>  $weekAgoValue);
        }

        $results = array();
        foreach ($input as $date => $value) {
            $parts = explode('-', $date);
            $month = ($parts[1] - 1 < 10) ? '0' . ($parts[1] - 1) : ($parts[1] - 1);

            $results[$date]['weight']       = $value;
            $results[$date]['js-date']      = $parts[0] . '-' . $month . '-' . $parts[2];
            $results[$date]['display-date'] = $parts[0] . '-' . $parts[1] . '-' . $parts[2];

            if (isset($currentDates[$parts[0] . '-' . $parts[1] . '-' . $parts[2]])) {
                $results[$date]['display-date'] = $currentDates[$parts[0] . '-' . $parts[1] . '-' . $parts[2]];
                $results[$date]['display-date']['date'] = self::replaceMonths($results[$date]['display-date']['date']);
            }
        }

        // delete first 7 results
        $results = array_slice($results, 7);

        return $results;
    }

    // TODO: move it out
    public static function replaceMonths($input){
        $months = array(
            'Jan' => 'Января', 'Feb' => 'Февраля', 'Mar' => 'Марта',
            'Apr' => 'Апреля', 'May' => 'Мая', 'Jun' => 'Июня',
            'Jul' => 'Июля', 'Aug' => 'Августа', 'Sep' => 'Сентября',
            'Oct' => 'Октября', 'Nov' => 'Ноября', 'Dec' => 'Декабря');
        return str_replace(array_keys($months), array_values($months), $input);
    }

    public static function set($date, $weight)
    {
        $id = User::getIdByEmail(Auth::getEmail());

        if (self::get($date) > 0) {
            $query = 'UPDATE weight SET weight="%s" WHERE id_user = "%s" AND created_at = "%s"';
            mysql_query(sprintf($query, $weight, $id, $date));
            return;
        }

        $query = 'INSERT INTO weight (id_user, weight, created_at) VALUES("%s", "%s", "%s")';
        mysql_query(sprintf($query, $id, $weight, $date));
    }
}