<?php
include_once('config.php');
Auth::redirectUnlogged();
$weights = Weight::getForDaysAgo(10000);

$period = $_GET['trend'];

$days = array('week' => 7, 'month' => 30, 'year' => 365);
$totalDays = array_key_exists($period, $days) ? $days[$period] : 0;

if($totalDays){
$points = Weight::getPositiveWeightForDaysAgo($totalDays);
$trendPoints = Weight::getTrendFor($points);
}else{
    $trendPoints = null;
}

$counter = 0;
foreach($weights as $key=>$weight){
    if(!empty($weights[$key]['weight'])){
        $counter++;
    }
    if($counter % 2 ==0){
        $weights[$key]['color'] = ($counter % 4 == 0)? '#CC0000' : '#fd813c';
    }
}

Core::loadTemplate('av_header', array('weights' => $weights, 'useChartScript' => true, 'title' => '������ ����', 'trendPoints' => $trendPoints));
Core::loadTemplate('graph', array('displayWeight' => ($counter > 1) ));
Core::loadTemplate('av_footer', array('link' => INDEX_PAGE, 'linkText' => '������ ���:'));