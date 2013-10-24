<?php
include_once('config.php');
Auth::redirectUnlogged();

//var_dump($_GET['graph'], $_GET['term']);
if ($_GET['graph'] == 'weekday') {
    $weights = Weight::getForWeekday($_GET['term'], 10000);
} else {
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