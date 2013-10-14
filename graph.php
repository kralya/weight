<?php
include_once('config.php');
Auth::redirectUnlogged();
$weights = Weight::getForDaysAgo(10000);

$counter = 0;
foreach($weights as $key=>$weight){
    if(!empty($weights[$key]['weight'])){
        $counter++;
    }
    if($counter % 2 ==0){
        $weights[$key]['color'] = ($counter % 4 == 0)? '#CC0000' : '#fd813c';
    }
}

Core::loadTemplate('av_header', array('weights' => $weights, 'useChartScript' => true, 'title' => 'График веса'));
Core::loadTemplate('graph', array('displayWeight' => ($counter > 1) ));
Core::loadTemplate('av_footer', array('link' => INDEX_PAGE, 'linkText' => 'Ввести вес:'));