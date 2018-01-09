<?php

/**
 * Class User
 */
class User
{
    
    /**
     * get list of all users
     * 
     * @return mixed
     */
    public static function usersList()
    {
        $db = Db::getConnection();
        $res = [];
        try {
            $sql = 'SELECT `name`,email,territory AS area FROM `user` AS u';
            $resultUsers = $db->query($sql) or die('Error - models/user/userList');
            $i=1;
            while($row = $resultUsers->fetch(PDO::FETCH_ASSOC)){
                $res[$i] = $row;
                $i++;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $res;
    }

    /**
     * get exist user consider an email
     *
     * @param $email
     * @return mixed
     */
    public static function checkUnique($email){
        $db = Db::getConnection();
        $smtp = $db->prepare('SELECT * FROM `user` WHERE email = :em');
        $smtp->bindParam(':em', $email,PDO::PARAM_STR);
        $smtp->execute();
        return $smtp->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * save a new user
     *
     * @param $params
     * @return string
     */
    public static function save($params)
    {
        //TODO set table row into json and save territory as {'area':232134,'city':23432,'district':'-'}
        $db = Db::getConnection();
        $res = '';
        try {
            $all_address= '';

            $smtp = $db->prepare('SELECT ter_name FROM t_koatuu_tree  WHERE ter_id = :aid');
            $smtp->bindParam(':aid', $params['area'],PDO::PARAM_INT);
            $smtp->execute();
            $all_address.= $smtp->fetch(PDO::FETCH_ASSOC)['ter_name'];

            if(isset($params['city']) && !empty($params['city'])){
                $all_address.= ' ';
                $smtp2 = $db->prepare('SELECT ter_name FROM t_koatuu_tree  WHERE ter_id = :cid');
                $smtp2->bindParam(':cid', $params['city'],PDO::PARAM_INT);
                $smtp2->execute();
                $all_address.= $smtp2->fetch(PDO::FETCH_ASSOC)['ter_name'];

            }
            if(isset($params['district'])&& !empty($params['district'])){
                $all_address.= ' ';
                $smtp3 = $db->prepare('SELECT ter_name FROM t_koatuu_tree  WHERE ter_id = :did');
                $smtp3->bindParam(':did', $params['district'],PDO::PARAM_INT);
                $smtp3->execute();
                $all_address.= $smtp3->fetch(PDO::FETCH_ASSOC)['ter_name'];
            }

            $smtp4 = $db->prepare('INSERT INTO `user` (`name`,email,territory) VALUES (:n,:e,:t)');
            $smtp4->bindParam(':n', $params['name'],PDO::PARAM_STR);
            $smtp4->bindParam(':e', $params['email'],PDO::PARAM_STR);
            $smtp4->bindParam(':t', $all_address,PDO::PARAM_STR);
            $res = $smtp4->execute();
            if($res){
                return 'success';
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}