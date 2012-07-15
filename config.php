<?php
session_start();

$username = 'root';
$password = '';
$db = 'weight';
$server = 'localhost';

//$username = 'u280846612_root';
//$password = 'yTKfENMEYM';
//$db = 'u280846612_weight';
//$server = 'mysql.hostinger.com.ua';

mysql_connect($server, $username, $password);
mysql_select_db($db);

define('WELCOME_PAGE', 'welcome.php');
define('DAYS_AGO_INDEX', 5);
define('DAYS_AGO_GRAPH', 15);


function __autoload($class_name) {
	include './class/'.strtolower($class_name) . '.class.php';
}