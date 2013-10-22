<?php
include_once('config.php');
Auth::redirectUnlogged();

$weights    = Weight::getForDaysAgo(10000);

$counter = 0;
foreach ($weights as $key => $weight) {
    if (!empty($weights[$key]['weight'])) {
        $counter++;
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
                                      'trendPoints'    => array(),
                                      'bulletSize'     => $bulletSize));
Core::loadTemplate('graph', array('displayWeight' => ($counter > 1),
                                  'period'        => 0));
Core::loadTemplate('av_footer', array('link'     => INDEX_PAGE,
                                      'linkText' => '������ ���:'));