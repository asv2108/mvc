<?php
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
        $title = 'Main page';
        require_once ROOT . '\views\index\index.php';
        return true;
    }

    /**
     * get values for a selected user
     * 
     * @param $parameters
     * @return bool
     */
    public function actionUser($parameters)
    {
        return true;
    }

}

