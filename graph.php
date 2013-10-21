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
    if ($counter % 2 == 0) {
        $weights[$key]['color'] = ($counter % 4 == 0) ? '#CC0000' : '#fd813c';
    }
}

$bulletSize = 7;
if (count($weight) > 100) {
    $bulletSize = 3;
} elseif (count($weight) > 10) {
    $bulletSize = 5;
}

Core::loadTemplate('av_header', array('weights'        => $weights,
                                      'useChartScript' => true,
                                      'title'          => '������ ����',
                                      'trendPoints'    => $trendPoints,
                                      'bulletSize'     => $bulletSize));
Core::loadTemplate('graph', array('displayWeight' => ($counter > 1),
                                  'period'        => $period));
Core::loadTemplate('av_footer', array('link'     => INDEX_PAGE,
                                      'linkText' => '������ ���:'));