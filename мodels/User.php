<?php
class User
{
    private $db;
    
    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'mvc';
        $user = 'root';
        $password = '';
        $this->db = new PDO("mysql:$host;dbname=$dbname",$user,$password);
    }

    public  function UsersList()
    {
        $resultUsers = $this->db->query('SELECT id, `name` FROM users ') or die('Error get users list');
        return $resultUsers->fetch(PDO::FETCH_ASSOC);
    }

    public static function UserById($id)
    {

    }
}