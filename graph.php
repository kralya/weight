<?php
include_once('config.php');

Auth::redirectUnlogged();

$weights = Weight::getForDaysAgo(DAYS_AGO_GRAPH);

// if user is not logged in, redirect to welcome
// get and pass to template data for user

Core::loadTemplate('menu');
Core::loadTemplate('graph');