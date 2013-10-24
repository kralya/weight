<?php

class Dates
{
    public function getWeekStartByNumber($number)
    {
        $firstMondayTimestamp = strtotime("first monday of january 2013");
        $startTimestamp       = $firstMondayTimestamp + 60 * 60 * 24 * 7 * $number;

        return date('Y-m-d', $startTimestamp);
    }

    public function getWeekEndByNumber($number)
    {
        $firstMondayTimestamp = strtotime("first monday of january 2013");
        $startTimestamp       = $firstMondayTimestamp + 60 * 60 * 24 * 7 * $number;
        $endTimestamp         = $startTimestamp + 60 * 60 * 24 * 7;

        return date('Y-m-d', $endTimestamp);
    }

    public function getMonthStartByNumber($number)
    {
        return date('Y') . '-' . $number . '-01';
    }

    public function getMonthEndByNumber($number)
    {
        return date('Y') . '-' . $number . '-30';
    }

}