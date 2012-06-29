<?php
include_once('config.php');
Auth::redirectUnlogged();
$weights = Weight::getForDaysAgo(DAYS_AGO_GRAPH);

Core::loadTemplate('menu');
Core::loadTemplate('graph', array('weights' => $weights));