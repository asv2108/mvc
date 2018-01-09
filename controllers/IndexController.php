<?php
require_once ROOT . '\models\User.php';
require_once ROOT . '\models\Territory.php';
/**
 * Class IndexController
 */
class IndexController
{

    /**
     * show the start page with all users
     * 
     * @return bool
     */
    public function actionIndex()
    {
        $usersList = User::usersList();
        $title = 'Main page';
        require_once ROOT . '\views\index\index.php';
        return true;
    }


    /**
     * show the page with a register form
     * 
     * @return bool
     */
    public function actionAdd()
    {
        $title = 'Register page';
        $areaList = Territory::areaList();
        require_once ROOT . '\views\index\add.php';
        return true;
    }
    

    /**
     * get city's list consider selected area for ajax request from main.js
     * 
     * @return bool
     */
    public function actionGetCity()
    {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id = $_POST['id'];
            $areaCity = Territory::cityList($id);
            echo json_encode($areaCity);
        }
        return false;
    }

    /**
     * get districts's list consider selected city for ajax request from main.js
     * 
     * @return bool
     */
    public function actionGetDistrict()
    {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id = $_POST['id'];
            $areaCity = Territory::districtList($id);
            echo json_encode($areaCity);
        }
        return false;
    }

    /**
     * check an email unique and get user/- for ajax request from main.js
     * 
     * @return bool
     */
    public function actionCheckUnique(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $res = User::checkUnique($_POST['email']);
            if($res !== false){
                echo json_encode($res);
            }else{
                echo json_encode('error');
            }
            
        }
        return false;
    }

    /**
     * save a new user
     * 
     * @return bool|string
     */
    public function actionSave()
    {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $res = User::save($_POST);
            if($res=='success'){
                setcookie("res", "Add the new row - success!", time()+5);
                ob_start();
                $redirect = "Location: ".$_SERVER['HTTP_ORIGIN'] ."\\index";
                header($redirect);
                return ob_get_contents();
            }else{
                //show error message
            }
        }
        return false;
    }
    
}

