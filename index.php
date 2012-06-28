<?php
include_once('config.php');

Auth::redirectUnlogged();

$weights = Weight::getForDaysAgo(DAYS_AGO_INDEX);
$email = Auth::getEmail();

// + write AJAX scripts for data update (not in this file)

Core::loadTemplate('menu');
Core::loadTemplate('index', array('weights' => $weights, 'email' => $email));