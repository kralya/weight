<?php
include_once('config.php');
Auth::redirectUnlogged();

if ($_GET['graph'] == 'month' && (int)$_GET['term'] > 0 && (int)$_GET['term'] < 13) {
    $from = date('Y').'-'.$_GET['term'].'-01';
    $to = date('Y').'-'.$_GET['term'].'-30';
    $weights = Weight::getForDaysAgo($from, $to);
}

if ($_GET['graph'] == 'weekday') {
    $weights = Weight::getForWeekday($_GET['term'], 10000);
}

if(!isset($_GET['graph'])){
    $weights = Weight::getForDaysAgo(10000);
}

$bullet = new Bullet();

Core::loadTemplate('av_header', array('weights'        => $weights,
                                      'useChartScript' => true,
                                      'title'          => 'График веса',
                                      'trendPoints'    => array(),
                                      'bulletSize'     => $bullet->getSizeFor($weights)));
Core::loadTemplate('graph', array('displayWeight' => Weight::isDisplayed($weights),
                                  'period'        => ''));
Core::loadTemplate('av_footer', array('link'     => INDEX_PAGE,
                                      'linkText' => 'Ввести вес:'));