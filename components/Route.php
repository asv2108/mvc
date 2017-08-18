<?php

/**
 * Class Route
 */
class Route
{
    /**
     * @var mixed
     */
    private $routes;

    /**
     *  get routes list
     *
     * Route constructor.
     */
    public function __construct(){
        $this->routes = include(ROOT . '\config\routes.php');
    }

    /**
     * get request from browser address bar
     * 
     * @return string
     */
    private function getUri(){
        return trim($_SERVER['REQUEST_URI'], '/');
    }


    /**
     * consider the uri identify a controller
     *
     */
    public function run(){
        $request = $this->getUri();
        if($request==''){ // base path
            include_once ROOT . '\controllers\IndexController.php';
            $controllerObject = new IndexController();
            $controllerObject->actionIndex();

        }else{ // Verify the received url with our routes list
            foreach ($this->routes as $url => $path){
                if(preg_match("~$url~",$request)){ // If a match is found 
                    $internalRoute = preg_replace("~$url~",$path,$request); // prepare a parameter 
                    $segments = explode('/', $internalRoute);
                    $controllerName = array_shift($segments) . 'Controller';
                    $controllerName = ucfirst($controllerName);
                    $actionName  = 'action' . ucfirst(array_shift($segments));
                    $parameters = $segments;
                    // get path to a controller
                    $controllerFile = ROOT . '\controllers\\' . $controllerName . '.php';
                    // include a controller
                    if(file_exists($controllerFile)){
                        include_once ($controllerFile);
                    }
                    $controllerObject = new $controllerName;
                    $result = null;
                    if($parameters){
                        $result = $controllerObject->$actionName($parameters);
                    }else
                        $result = $controllerObject->$actionName();
                    //TODO working with view
                }
            }
        }
    }
}