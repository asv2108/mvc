<?php

class Territory
{
    public static function areaList()
    {
        $db = Db::getConnection();
        $res = [];
        try {
            $sql = 'SELECT ter_id AS id, ter_address as area FROM t_koatuu_tree WHERE ter_type_id=0';
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
}