<?php
include_once ROOT . '\мodels\User.php';
//include_once ROOT. '\models\Advertisement.php';

class IndexController
{
    public function actionIndex()
    {
        $usersList = [];
        $userModel = new User();
        $usersList = $userModel->UsersList();
        echo "<pre>";
        var_dump($usersList);
        exit;
//        $adv = [];
//        $adv = Advertisement::getAdvertisementList();
        return true;
    }

    public function actionUser($parameters)
    {
//        $userValues = [];
//        $userValues = User::UserById($parameters[0]);
        return true;
    }

}

