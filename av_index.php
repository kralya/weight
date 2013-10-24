<?php
include_once('config.php');
Auth::redirectUnlogged();

$toGetPastWeekValues = 7;
$weights = Weight::getForDaysAgo(DAYS_AGO_INDEX + $toGetPastWeekValues);
$email = Auth::getEmail();

Core::loadTemplate('av_header', array('title' => 'Дневник веса'));
Core::loadTemplate('av_index', array('weights' => $weights, 'email' => $email));
Core::loadTemplate('av_footer', array('link' => GRAPH_PAGE, 'linkText' => 'Посмотреть график:'));