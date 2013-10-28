<?php
session_start();

include_once('db-config.php');
include_once('vendor/autoload.php');

mysql_connect($server, $username, $password) or die('failed to connect');
mysql_select_db($db);

define('WELCOME_PAGE', '/welcome');
define('INDEX_PAGE', '/');
define('GRAPH_PAGE', '/graph');
define('LOGOUT_PAGE', '/logout');
define('DAYS_AGO_INDEX', 7);
define('ROOT', $root);

date_default_timezone_set('Europe/Moscow');

$loader = new \Composer\Autoload\ClassLoader();
$loader->add(false, __DIR__ . '/class');
$loader->register();


// routes
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

$route = new Route('/graph', array('controller' => 'GraphController'));
$routes = new RouteCollection();
$routes->add('route_name', $route);

$context = new RequestContext($_SERVER['REQUEST_URI']);
$matcher = new UrlMatcher($routes, $context);

$path = $_SERVER['REQUEST_URI'];

try{
    $parameters = $matcher->match($path);
    $controller = $parameters['controller'];
} catch (\Symfony\Component\Routing\Exception\ResourceNotFoundException $e){
    $controller = 'inputController';
}

//var_dump($controller);