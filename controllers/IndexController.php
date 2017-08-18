<?php
//require_once ROOT . '\мodels\User.php';  // I GOT FAULT HERE!!!!!!!!!!!!
require_once ROOT . '\models\User.php';
/**
 * Class IndexController
 */
class IndexController
{
    
    public function actionIndex()
    {
        $usersList = [];
        $userModel = new User();
        $usersList = $userModel->UsersList();
        echo "I am here";
        exit;

    }

    /**
     * get values for a selected user
     * 
     * @param $parameters
     * @return bool
     */
//    public function actionUser($parameters)
//    {
//        return true;
//    }

}

