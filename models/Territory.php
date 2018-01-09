<?php

/**
 * Class Territory
 */
class Territory
{
    
    /**
     * get area's list
     * 
     * @return array
     */
    public static function areaList()
    {
        $db = Db::getConnection();
        $res = [];
        try {
            $sql = 'SELECT ter_id AS id, ter_address as area FROM t_koatuu_tree WHERE ter_type_id=0';
            $resultUsers = $db->query($sql) or die('Error  models/territory/areaList ');;
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
     * get city's list consider selected area
     * 
     * @param $id
     * @return array
     */
    public static function cityList($id)
    {
        //TODO verify $id
        $db = Db::getConnection();
        $res = [];
        // ter_level 2 - has own district, 3 - not  I select all area's cities now
        try {
            $sql = "SELECT ter_id AS id, ter_address as city 
            FROM t_koatuu_tree 
            WHERE ter_type_id=1  AND reg_id = (SELECT reg_id FROM t_koatuu_tree WHERE ter_id = $id)";
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
     * get district's list consider selected city
     * 
     * @param $id
     * @return array
     */
    public static function districtList($id)
    {
        //TODO verify $id
        $db = Db::getConnection();
        $res = [];
        //a city has {$res_area['ter_level']}=2/3  2 - area's district 
        try {
            $sql = "SELECT reg_id,ter_level,ter_mask FROM  t_koatuu_tree WHERE ter_id = $id";
            $area = $db->query($sql) or die('Error user model string 37');
            $res_area = $area->fetch(PDO::FETCH_ASSOC);
            // TODO if($res_area) $sql2
            $sql2 = "SELECT ter_id AS id, ter_address as district 
            FROM t_koatuu_tree 
            WHERE reg_id = {$res_area['reg_id']}
            AND ter_type_id = 3";
            $resultUsers = $db->query($sql2) or die('Error user model string 37');;
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