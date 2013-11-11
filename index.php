<?php
// routes
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

include_once('config.php');

$routes = new RouteCollection();

$routes->add('index', new Route('/', array('controller' => 'IndexController')));
$routes->add('graph', new Route('/graph', array('controller' => 'GraphController')));
$routes->add('graph_term', new Route('/graph-for-{graph}/{term}', array('controller' => 'GraphController')));
$routes->add('graph_trend', new Route('/graph-trend-{trend}/{term}', array('controller' => 'TrendController')));
$routes->add('graph_trend', new Route('/graph-trend-{trend}', array('controller' => 'TrendController')));
$routes->add('welcome', new Route('/welcome', array('controller' => 'WelcomeController')));
$routes->add('logout', new Route('/logout', array('controller' => 'LogoutController')));
$routes->add('save', new Route('/save', array('controller' => 'SaveController')));


$context = new RequestContext($_SERVER['REQUEST_URI']);
$matcher = new UrlMatcher($routes, $context);

try {
    $parameters = $matcher->match($_SERVER['REQUEST_URI']);
    $controller = $parameters['controller'];
} catch (ResourceNotFoundException $e) {
    Utility::redirect('/');
}
$file      = strtolower(str_replace('Controller', '', $controller));
$inclusion = file_exists('controller/' . $file . '.php') ? $file : 'index';

Core::loadController($inclusion, $parameters);
