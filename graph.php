<?php
include_once('config.php');
Auth::redirectUnlogged();

$term = (int)$_GET['term'];
$type = $_GET['graph'];

if ($type == 'month' && $term > 0 && $term < 13) {
    $dates   = new Dates();
    $weights = Weight::getForDaysAgo($dates->getMonthStartByNumber($term), $dates->getMonthEndByNumber($term));
}

if ($type == 'week' && $term > 0 && $term < 53) {
    $dates   = new Dates();
    $weights = Weight::getForDaysAgo($dates->getWeekStartByNumber($term), $dates->getWeekEndByNumber($term));
}

if ($type == 'weekday' && $term > 0 && $term < 8) {
    $weights = Weight::getForWeekday($term, 10000);
}

if (!isset($_GET['graph'])) {
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