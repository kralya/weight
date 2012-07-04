<?php
include_once('config.php');
Auth::redirectUnlogged();

$weights = Weight::getForDaysAgo(DAYS_AGO_INDEX);
$email = Auth::getEmail();

$dates = array_keys($weights);
$today = end($dates);
$yesterday = prev($dates);

$show[$today] = 'Сегодня,';
$show[$yesterday] = 'Вчера,';

$weights = array_reverse($weights);

Core::loadTemplate('header', array('title' => 'Дневник веса'));
Core::loadTemplate('index', array('weights' => $weights, 'email' => $email, 'show' => $show));
Core::loadTemplate('footer');