<?php
require_once ROOT . '\models\User.php';
/**
 * Class IndexController
 */
class IndexController
{
    
    public function actionIndex()
    {
        $userModel = new User();
        $usersList = $userModel->UsersList();
        $title = 'Main page';
        require_once ROOT . '\views\index\index.php';
        return true;
    }

    
    public function actionAdd()
    {
        require_once ROOT . '\views\index\add.php';
        return true;
    }

}

