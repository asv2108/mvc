<?php

/**
 * Class Route
 */
class Router
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
        // I can include new files into a variable to!!!
        $this->routes = include(ROOT . '\config\routes.php');
    }

    /**
     * get request from browser address bar and return request string
     * 
     * @return string
     */
    private function getUri(){
        // return without first /  (is ltrim() more good for it?)
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

        }else{
            // Verify the received url with our routes list
            $wrong_way = false;
            foreach ($this->routes as $url => $path){
                if(preg_match("~$url~",$request)){
                    // If a match is found
                    // prepare a parameter
                    $internalRoute = preg_replace("~$url~",$path,$request);
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
                        if(count($parameters>1)){
                            //TODO to a method add next parameter
                            $result = call_user_func_array(array($controllerObject,$actionName),$parameters);
                        }else
                            $result = $controllerObject->$actionName($parameters);
                    }else
                        $result = $controllerObject->$actionName();

                    if($result != null){
                        $wrong_way = false;
                        break;
                    }
                    //TODO working with view
                }else{
                    $wrong_way = true;
                }
            }
            if($wrong_way){
                //echo 'Such page does not find - error 404 ';
            }
        }
    }
}