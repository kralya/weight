<?php
include_once('config.php');
Auth::redirectUnlogged();
$weights = Weight::getForDaysAgo(DAYS_AGO_GRAPH);

Core::loadTemplate('header', array('weights' => $weights, 'useChartScript' => true, 'title' => '��������� ����'));
Core::loadTemplate('graph');
Core::loadTemplate('footer');