<?php
include_once('config.php');

Auth::redirectUnlogged();

$weights = Weight::getForDaysAgo(DAYS_AGO_INDEX);

// + write AJAX scripts for data update (not in this file)

Core::loadTemplate('menu');
Core::loadTemplate('form');
