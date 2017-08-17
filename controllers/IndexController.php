<?php

include_once ROOT. "/models/User.php";
include_once ROOT. "/models/Advertisement.php";

class IndexController
{
    public function actionIndex()
    {
        $usersList = [];
        $usersList = User::UsersList();
        $adv = [];
        $adv = Advertisement::getAdvertisementList();
        return true;
    }

    public function actionUser($parameters)
    {
        $userValues = [];
        $userValues = User::UserById($parameters[0]);
    }

}

