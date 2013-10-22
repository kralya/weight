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

$bul = new Bullet();

Core::loadTemplate('av_header', array('weights'        => $weights,
                                      'useChartScript' => true,
                                      'title'          => 'График веса',
                                      'trendPoints'    => array(),
                                      'bulletSize'     => $bul->getSizeFor($weights)));
Core::loadTemplate('graph', array('displayWeight' => ($counter > 1),
                                  'period'        => 0));
Core::loadTemplate('av_footer', array('link'     => INDEX_PAGE,
                                      'linkText' => 'Ввести вес:'));