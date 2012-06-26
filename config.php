<?php

$username = 'root';
$password = '';
$db = 'weight';
$server = 'localhost';

mysql_connect($server, $username, $password);
mysql_select_db($db);

define('WELCOME_PAGE', 'welcome.php');
define('DEPTH_SHOW', 5);


function __autoload($class_name) {
	include 'class\\'.$class_name . '.class.php';
}