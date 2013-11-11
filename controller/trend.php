<?php
include_once('config.php');
Auth::redirectUnlogged();
$period = isset($trend) ? $trend : '';

$days       = array('week' => 7, 'month' => 30, 'year' => 365);
$totalDaysZ = array_key_exists($period, $days) ? $days[$period] : 10000;
$totalDays  = array_key_exists($period, $days) ? $days[$period] : 0;
$weights    = Weight::getForDaysAgo($totalDaysZ);

if ($totalDays) {
    $points      = Weight::getPositiveWeightForDaysAgo($totalDays);
    $trendPoints = Trend::getFor($points, $totalDays);
} else {
    $trendPoints = null;
}

$bullet = new Bullet();

Core::loadTemplate('header', array('weights'        => $weights,
                                      'useChartScript' => true,
                                      'title'          => 'График веса',
                                      'trendPoints'    => $trendPoints,
                                      'bulletSize'     => $bullet->getSizeFor($weights)));
Core::loadTemplate('graph', array('displayWeight' => Weight::isDisplayed($weights),
                                  'period'        => $period,
                                  'weeks'         => Weight::getWeeksWithGraph()));
Core::loadTemplate('footer', array('link'     => INDEX_PAGE,
                                      'linkText' => 'Ввести вес:'));