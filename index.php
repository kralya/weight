<?php
include_once('config.php');

Auth::redirectUnlogged();

$weights = Weight::getForDaysAgo(DEPTH_SHOW);

// + write AJAX scripts for data update (not in this file)


include('menu.php');
include('form.php');