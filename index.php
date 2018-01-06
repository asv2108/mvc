<?php
// the bootstrap file

// for development
//TODO comment it for live version
ini_set('display_errors',1);
error_reporting(E_ALL);

// set first part absolute address to files
define('ROOT', dirname(__FILE__));
require_once(ROOT . '\components\Router.php');
require_once ROOT . '\components\Db.php';
$route = new Router();
$route->run();
