<?php
session_start();

include_once('db-config.php');

mysql_connect($server, $username, $password) or die('failed to connect');
mysql_select_db($db);

define('WELCOME_PAGE', '/welcome');
define('INDEX_PAGE', '/');
define('GRAPH_PAGE', '/graph');
define('LOGOUT_PAGE', '/logout');
define('DAYS_AGO_INDEX', 7);

function __autoload($class_name) {
	include './class/'.strtolower($class_name) . '.class.php';
}

date_default_timezone_set('Europe/Moscow');