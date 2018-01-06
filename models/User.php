<?php

/**
 * Class User
 */
class User
{
    
    /**
     * get list of users
     * 
     * @return mixed
     */
    public static function usersList()
    {
        $db = Db::getConnection();
        $res = [];
        try {
            $sql = 'SELECT `name`,email, 
                    (SELECT ter_address FROM t_koatuu_tree AS t  WHERE t.ter_id = u.territory_area)AS area 
                    FROM `user` AS u';
            $resultUsers = $db->query($sql) or die('Error user model string 37');;
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
     * @param $id
     */
    public static function UserById($id)
    {

    }
}