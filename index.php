<?php
include_once('config.php');
Auth::redirectUnlogged();

$weights = Weight::getForDaysAgo(DAYS_AGO_INDEX);
$email = Auth::getEmail();

Core::loadTemplate('header');
Core::loadTemplate('index', array('weights' => $weights, 'email' => $email));