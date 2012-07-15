<?php
include_once('config.php');
Auth::redirectUnlogged();

$weights = Weight::getForDaysAgo(DAYS_AGO_INDEX);
$email = Auth::getEmail();

$dates = array_keys($weights);
$today = end($dates);
$yesterday = prev($dates);

$show[$today] = '�������,';
$show[$yesterday] = '�����,';

$weights = array_reverse($weights);

Core::loadTemplate('header', array('title' => '������� ����'));
Core::loadTemplate('index', array('weights' => $weights, 'email' => $email, 'show' => $show));
Core::loadTemplate('footer', array('link' => 'graph.php', 'linkText' => '���������� ������:'));