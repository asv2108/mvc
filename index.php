<?php
define('ROOT', dirname(__FILE__));
require_once(ROOT . '\components\Route.php');
$route = new Route();
$route->run();
