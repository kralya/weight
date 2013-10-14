<?php
session_start();

$username = 'alex';
$password = '';
$db = 'weight';
$server = 'localhost';

mysql_connect($server, $username, $password) or die('failed to connect');
mysql_select_db($db);

define('WELCOME_PAGE', '/welcome');
define('INDEX_PAGE', '/');
define('GRAPH_PAGE', '/graph');
define('LOGOUT_PAGE', '/logout');
define('DAYS_AGO_INDEX', 5);

function __autoload($class_name) {
	include './class/'.strtolower($class_name) . '.class.php';
}

date_default_timezone_set('Europe/Moscow');