<?php
// the bootstrap file
// set constanta with first part absolute address to files
define('ROOT', dirname(__FILE__));
require_once(ROOT . '\components\Route.php');
$route = new Route();
$route->run();
