<?php
require_once ROOT . '\models\User.php';
require_once ROOT . '\models\Territory.php';
/**
 * Class IndexController
 */
class IndexController
{
    
    public function actionIndex()
    {

        $usersList = User::usersList();
        $title = 'Main page';
        require_once ROOT . '\views\index\index.php';
        return true;
    }

    
    public function actionAdd()
    {
        $title = 'Register page';
        require_once ROOT . '\views\index\add.php';
        return true;
    }

    public function actionGetArea()
    {
        $areaList = Territory::areaList();
        echo json_encode($areaList);
        return false;
    }

}

