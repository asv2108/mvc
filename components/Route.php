<?php

class Route
{
    private $routes;

    public function __construct(){
        $this->routes = include(ROOT . '\config\routes.php');
    }

    private function getUri(){
        return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function run(){

        $request = $this->getUri();
        foreach ($this->routes as $url => $path){
            if(preg_match("~$url~",$request)){
                $internalRoute = preg_replace("~$url~",$path,$request);
                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName  = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;
                $controllerFile = ROOT . '\controllers\\' . $controllerName . '.php';

                var_dump($controllerFile);

                if(file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                $controllerObject = new $controllerName;
                // for send parameters as variables $result = call_user_func_array(array($controllerObject,$actionName),$parameters);
                $result = null;
                if($parameters){
                    $result = $controllerObject->$actionName($parameters);
                }else
                    $result = $controllerObject->$actionName();
                if($result != null){
                    break;
                }
            }
        }
    }
}