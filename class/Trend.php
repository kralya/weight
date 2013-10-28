<?php

class Trend
{
    public static function getFor($weight, $daysAgo)
    {
        $total = count($weight);

// if amount of points < 2, return;
        if (2 > $total) {
            return;
        }

// split array to two halves: left (up to middle, including it if there is even amount) and right, from middle to end element
        if ($total % 2 === 0) {
            $weightFirst  = array_slice($weight, 0, $total / 2);
            $weightSecond = array_slice($weight, $total / 2, $total / 2);
        } else {
            $weightFirst  = array_slice($weight, 0, ceil($total / 2));
            $weightSecond = array_slice($weight, floor($total / 2), ceil($total / 2));
        }

// count two sums: sum of 'left' and sum of 'right' sub-arrays.
        function countZ($value)
        {
            return $value['weight'];
        }

//        $countFunctionY = function($value){return $value['weight'];};
        $sumFirstY  = array_sum(array_map('countZ', $weightFirst));
        $sumSecondY = array_sum(array_map('countZ', $weightSecond));

// count arithmetical means of these sums. It is two Y ordinate values.
        $yFirst  = $sumFirstY / ceil($total / 2);
        $ySecond = $sumSecondY / ceil($total / 2);

// count two sums of dates of 'left' and 'right' of 'left' and 'right' sub-arrays.

//        $countFunctionX = function($value){return (new DateTime($value['js-date']))->getTimestamp();};
        function countZZ($value)
        {
            $dt = new MyDateTime($value['js-date']);
            return $dt->getTimestamp();
        }

        $sumFirstX  = array_sum(array_map('countZZ', $weightFirst));
        $sumSecondX = array_sum(array_map('countZZ', $weightSecond));

// count arithmetical means of these sums. It is two X ordinate values.
        $xFirstTimestamp  = $sumFirstX / ceil($total / 2);
        $xSecondTimestamp = $sumSecondX / ceil($total / 2);

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

        $dt                  = (new MyDateTime('-1 month'));
        $xTodayTimestamp     = $dt->getTimestamp();
        $dt                  = (new MyDateTime('-1month -' . $daysAgo . ' days'));
        $xVeryFirstTimestamp = $dt->getTimestamp();

// according to previous ratio calculation, get equations for today X and Y, and for -$daysAgo point X and Y
#        $ratio = ($yFirst - $yToday) / ($xFirstTimestamp - $xTodayTimestamp);
#        $ratio * ($xFirstTimestamp - $xTodayTimestamp) = $yFirst - $yToday;
        $yToday = $yFirst - $ratio * ($xFirstTimestamp - $xTodayTimestamp);
#        $ratio = ($yVeryFirst - $yFirst) / ($xVeryFirstTimestamp - $xFirstTimestamp);
        $yVeryFirst = $ratio * ($xVeryFirstTimestamp - $xFirstTimestamp) + $yFirst;

        $dt             = new MyDateTime();
        $xVeryFirstDate = $dt->setTimestamp($xVeryFirstTimestamp);
        $dt             = new MyDateTime();
        $xTodayDate     = $dt->setTimestamp($xTodayTimestamp);

        return (array(
            array($xVeryFirstDate->format('Y, m,d, H'), round($yVeryFirst, 1)),
            array($xTodayDate->format('Y, m, d, H'), round($yToday, 1))
        ));
    }

}