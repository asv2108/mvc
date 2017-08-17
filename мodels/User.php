<?php

/**
 * Class User
 */
class User
{
    /**
     * @var PDO
     */
    private $db;

    /**
     * preparing work with db
     * 
     * User constructor.
     */
    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'mvc';
        $user = 'root';
        $password = '';
        $this->db = new PDO("mysql:$host;dbname=$dbname",$user,$password);
    }

    /**
     * get list users
     * 
     * @return mixed
     */
    public  function UsersList()
    {
        $resultUsers = $this->db->query('SELECT id, `name` FROM users ') or die('Error get users list');
        return $resultUsers->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param $id
     */
    public static function UserById($id)
    {

    }
}