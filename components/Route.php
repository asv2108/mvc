<?php

class Route
{
    private $routes;

    public function __construct(){
        $this->routes = include(ROOT . '/config/routes.php');
    }

    private function getUri(){
        return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function run(){

        $request = $this->getUri();
        foreach ($this->routes as $url => $path){
            if(preg_match("~$url~",$request)){
                $segments = explode('/', $path);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName  = 'action' . ucfirst(array_shift($segments));
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if(file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if($result != null){
                    break;
                }
            }
        }
    }
}