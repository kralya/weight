<?php

$username = 'root';
$password = '';
$db = 'time_db';
$server = 'localhost';

mysql_connect($server, $username, $password);
mysql_select_db($db);

function __autoload($class_name) {
	include 'class\\'.$class_name . '.class.php';
}