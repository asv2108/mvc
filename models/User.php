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
    public function UsersList()
    {
        $db = Db::getConnection();
        $res = [];
        try {
            $sql = 'SELECT id, `name` FROM users ';
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