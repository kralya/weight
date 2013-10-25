<?php

class Weight
{
    private static $weekdays = array(1 => 'Пн', 2 => 'Вт', 3 => 'Ср', 4 => 'Чт', 5 => 'Пт', 6 => 'Сб', 7 => 'Вс');
    private static $dayTexts = array('Сегодня, ', 'Вчера, ', 'Позавчера, ', '', '', '', '');
    private static $months = array(
        'Jan' => 'Января', 'Feb' => 'Февраля', 'Mar' => 'Марта',
        'Apr' => 'Апреля', 'May' => 'Мая', 'Jun' => 'Июня',
        'Jul' => 'Июля', 'Aug' => 'Августа', 'Sep' => 'Сентября',
        'Oct' => 'Октября', 'Nov' => 'Ноября', 'Dec' => 'Декабря');

    public static function getWeeksWithGraph()
    {
        $weights = self::getPositiveWeightForDaysAgo('2013-01-01', date('Y-m-d'));

        $dates  = new Dates();
        $result = array();

        for ($week = 1; $week < 53; $week++) {
            $firstWeekDay  = $dates->getWeekStartByNumber($week);
            $totalThisWeek = 0;
            for ($day = 0; $day < 7; $day++) {
                $checkDate = date('Y-m-d', strtotime($firstWeekDay) + $day * 24 * 60 * 60);
                if (array_key_exists($checkDate, $weights) && !empty($weights[$checkDate]['weight'])) {
                    $totalThisWeek++;
                }

                if (1 < $totalThisWeek) {
                    $result[$week] = true;
                    break;
                }
            }
        }

        return $result;
    }

    public static function getForWeekday($weekday, $daysAgo)
    {
        $weekday = self::$weekdays[(int)$weekday];
        $weights = self::getForDaysAgo($daysAgo);

        foreach ($weights as $key => $weight) {
            if ($weight['display-date']['weekday'] !== $weekday) {
                unset($weights[$key]);
            }
        }

        return $weights;
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

    public static function get($date)
    {
        $email = Auth::getEmail();
        $query = 'SELECT weight FROM weight w, user u WHERE u.id = w.id_user AND email="%s" AND w.created_at="%s"';
        $res   = mysql_query(sprintf($query, $email, $date));
        if (0 == mysql_num_rows($res)) {
            return 0;
        }

        $row = mysql_fetch_assoc($res);
        return $row['weight'];
    }

    public static function getPositiveWeightForDaysAgo($daysAgo, $offset=0)
    {
        $weights = self::getForDaysAgo($daysAgo, $offset);
        foreach ($weights as $key => $weight) {
            if ($weight['weight'] == '') {
                unset($weights[$key]);
            }
        }

        return $weights;
    }

    /**
     * @static
     * @param $daysAgo, from
     * @param int $offset, to
     * @return array
     */
    public static function getForDaysAgo($daysAgo, $offset = 0)
    {
        if ((is_integer($daysAgo))) {
            $start = new DateTime("-$daysAgo days");
            $finish = new DateTime("-$offset days");
        } else {
            $start = new DateTime($daysAgo);
            $finish = new DateTime($offset);
        }

        $query = 'SELECT weight, w.created_at FROM weight w, user u
        WHERE u.id = w.id_user AND u.email = "%s" AND w.created_at >= "%s" AND w.created_at <= "%s" AND w.weight <> ""';

        $res = mysql_query(sprintf($query, Auth::getEmail(), $start->format('Y-m-d'), $finish->format('Y-m-d')));

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
            $date                            = new DateTime(sprintf(' -%s days', ($limit - $i)));
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
        $texts    = self::$dayTexts;
        $total    = count($input);
        for ($i = 0; $i < $total; $i++) {
            $times                               = strtotime('-' . $i . ' day');
            $weekAgoTimes                        = strtotime('-' . ($i + 7) . ' day');
            $weekAgoValue                        = isset($input[date('Y-m-d', $weekAgoTimes)]) ? $input[date('Y-m-d', $weekAgoTimes)] : '';
            $currentDates[date('Y-m-d', $times)] = array('weekday'      => $weekdays[date(('N'), $times)],
                                                         'weekend'      => in_array(date(('N'), $times), array(6, 7)),
                                                         'text'         => array_key_exists($i, $texts) ? $texts[$i] : '',
                                                         'date'         => date(('d M'), $times),
                                                         'valueWeekAgo' => $weekAgoValue);
        }

        $results = array();
        foreach ($input as $date => $value) {
            $parts = explode('-', $date);
            $month = ($parts[1] - 1 < 10) ? '0' . ($parts[1] - 1) : ($parts[1] - 1);

            $results[$date]['weight']       = $value;
            $results[$date]['js-date']      = $parts[0] . '-' . $month . '-' . $parts[2];
            $results[$date]['display-date'] = $parts[0] . '-' . $parts[1] . '-' . $parts[2];

            if (isset($currentDates[$parts[0] . '-' . $parts[1] . '-' . $parts[2]])) {
                $results[$date]['display-date']         = $currentDates[$parts[0] . '-' . $parts[1] . '-' . $parts[2]];
                $results[$date]['display-date']['date'] = self::replaceMonths($results[$date]['display-date']['date']);
            }
        }

        return $results;
    }

    // TODO: move it out
    protected static function replaceMonths($input)
    {
        return str_replace(array_keys(self::$months), array_values(self::$months), $input);
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