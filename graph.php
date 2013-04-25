<?php
include_once('config.php');
Auth::redirectUnlogged();
$weights = Weight::getForDaysAgo(10000);

$counter = 0;
foreach($weights as $weight){
    if(!empty($weight['weight'])){
        $counter++;
    }
}
Core::loadTemplate('av_header', array('weights' => $weights, 'useChartScript' => true, 'title' => 'Изменение веса'));
Core::loadTemplate('graph', array('displayWeight' => ($counter > 1) ));
Core::loadTemplate('av_footer', array('link' => INDEX_PAGE, 'linkText' => 'Ввести вес:'));