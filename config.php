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
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

$routes = new RouteCollection();
//$route = new Route('/graph', array('controller' => 'GraphController'));

//$routes->add(
//    new Route(
//        '/membersnewmail/:e/:k',
//        array(
//            'controller' => 'Members', 'action' => 'changeEmail', 'module' => 'FrontEnd'
//        )
//    )
//);

// 1. htaccess should redirect to index
// 2. index should include Core
// 3. Core should select controller, and call it.

$routes->add('graph', new Route('/graph', array('controller' => 'GraphController')));
$routes->add('graph', new Route('/graph-for-month/:month', array('controller' => 'GraphController')));

$context = new RequestContext($_SERVER['REQUEST_URI']);
$matcher = new UrlMatcher($routes, $context);

$path = $_SERVER['REQUEST_URI'];

try{
    $parameters = $matcher->match($path);
    $controller = $parameters['controller'];
} catch (ResourceNotFoundException $e){
    $controller = 'inputController';
}
