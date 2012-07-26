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
Core::loadTemplate('header', array('weights' => $weights, 'useChartScript' => true, 'title' => '��������� ����'));
Core::loadTemplate('graph', array('displayWeight' => ($counter > 1) ));
Core::loadTemplate('footer', array('link' => 'index.php', 'linkText' => '������ ���:'));