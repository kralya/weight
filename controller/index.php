<?php
include_once('config.php');

Auth::redirectUnlogged();

$toGetPastWeekValues = DAYS_AGO_INDEX;
$weights = Weight::getForDaysAgo(2 * DAYS_AGO_INDEX);
$weights = array_slice($weights, DAYS_AGO_INDEX);
$email = Auth::getEmail();

Core::loadTemplate('header', array('title' => 'Дневник веса'));
Core::loadTemplate('index', array('weights' => $weights, 'email' => $email));
Core::loadTemplate('footer', array('link' => GRAPH_PAGE, 'linkText' => 'Посмотреть график:'));