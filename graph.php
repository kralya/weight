<?php
include_once('config.php');
Auth::redirectUnlogged();
$weights = Weight::getForDaysAgo(DAYS_AGO_GRAPH);

Core::loadTemplate('header');
Core::loadTemplate('graph', array('weights' => $weights));