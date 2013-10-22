<?php
include_once('config.php');
Auth::redirectUnlogged();
$period = $_GET['trend'];

$days       = array('week' => 7, 'month' => 30, 'year' => 365);
$totalDaysZ = array_key_exists($period, $days) ? $days[$period] : 10000;
$totalDays  = array_key_exists($period, $days) ? $days[$period] : 0;
$weights    = Weight::getForDaysAgo($totalDaysZ);

if ($totalDays) {
    $points      = Weight::getPositiveWeightForDaysAgo($totalDays);
    $trendPoints = Weight::getTrendFor($points, $totalDays);
} else {
    $trendPoints = null;
}

$counter = 0;
foreach ($weights as $key => $weight) {
    if (!empty($weights[$key]['weight'])) {
        $counter++;
    }
}

$bullet = new Bullet();

Core::loadTemplate('av_header', array('weights'        => $weights,
                                      'useChartScript' => true,
                                      'title'          => 'График веса',
                                      'trendPoints'    => $trendPoints,
                                      'bulletSize'     => $bullet->getSizeFor($weights)));
Core::loadTemplate('graph', array('displayWeight' => ($counter > 1),
                                  'period'        => $period));
Core::loadTemplate('av_footer', array('link'     => INDEX_PAGE,
                                      'linkText' => 'Ввести вес:'));